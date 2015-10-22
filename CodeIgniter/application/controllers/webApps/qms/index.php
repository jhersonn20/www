<?php
	class Index extends CI_Controller{		
        private $result = array("rows"=>"");
		private $operatorArr = array("eq"=>" = '","neq"=>" != '","endswith"=>" LIKE '%","startswith"=>" LIKE '",
							 "contains"=>" LIKE '%","doesnotcontain"=>" NOT LIKE '%","gte"=>" >= '","gt"=>" > '",
							 "lte"=>" <= '","lt"=>" < '","in"=>" is null","inn"=>" is not null");
		private $blankThis = array("eq","neq","endswith","in","inn");
		
		public function __construct(){
			parent::__construct();
            $this->load->helper(array('form','url','file','date','csv_helper'));
			$this->load->model('webapps/qms/iso_model');
			$this->load->model('webapps/qms/spool_model');
			$this->load->model('webapps/qms/joints_model');
			$this->load->model('webapps/qms/mat_takeoff_perspool_model');
			$this->load->model('webapps/qms/random_pipes_model');
			$this->load->model('webapps/qms/material_file_model');
			$this->load->model('webapps/qms/material_file_dtl_model');
			$this->load->model('webapps/qms/area_model');
			$this->load->model('webapps/qms/sub_area_model');
			$this->load->model('webapps/qms/inst_takeoff_model');
			$this->load->model('webapps/qms/elec_takeoff_model');
			$this->load->model('webapps/qms/sys_prog_model');
			$this->load->model('webapps/qms/iso_mech_model');
			$this->load->model('webapps/qms/equip_mech_model');
			$this->load->model('webapps/qms/iso_struc_model');
			$this->load->model('webapps/qms/piece_struc_model');
			$this->load->model('webapps/qms/ps_mto_model');
			$this->load->model('webapps/qms/testpack_hdr_model');
			$this->load->model('webapps/qms/pip_mto_data_model');
			$this->load->model('webapps/qms/pip_weld_data_model');
			$this->load->model('webapps/qms/pip_sup_data_model');
			$this->load->model('webapps/qms/pip_fspl_data_model');
			$this->load->model('webapps/qms/pip_fabspl_data_model');
			$this->load->model('webapps/qms/pip_wspl_data_model');
			$this->load->model('webapps/qms/pip_wmatl_data_model');
			$this->load->model('webapps/qms/tt_uplmech_model');
			$this->load->model('webapps/qms/str_pm_data_model');
			$this->load->model('webapps/qms/ttConstn_model');
			$this->load->model('webapps/qms/ttTestpack_model');
			$this->load->model('webapps/qms/tt_ttspl_model');
			$this->load->model('webapps/qms/ref_fwbs_model');
			$this->load->model('webapps/qms/ref_discipline_model');
			$this->load->model('webapps/qms/ref_jointtype_model');
			$this->load->model('webapps/qms/ref_roctype_model');
			$this->load->model('webapps/qms/ref_roc_model');
			$this->load->model('webapps/qms/ref_workability_model');
			$this->load->model('webapps/qms/tpo_hdr_model');
			$this->load->model('webapps/qms/tpo_dtl_model');
			$this->load->model('webapps/qms/rcontrol_model');
			$this->load->model('webapps/qms/rsupplier_model');
			$this->load->model('webapps/qms/tdlmr_hdr_model');
			$this->load->model('webapps/qms/tdlmr_dtl_model');
			$this->load->model('webapps/qms/tjwrr_hdr_model');
			$this->load->model('webapps/qms/tjwrr_dtl_model');
			$this->load->model('webapps/qms/treqiss_dtl_model');
			$this->load->model('webapps/qms/tttemps_model');
			$this->load->model('webapps/qms/ttmto_model');
			$this->load->model('webapps/qms/ttmto1_model');
			$this->load->model('webapps/qms/treqiss_hdr_model');
			$this->load->model('webapps/qms/rmat_util_model');
			$this->load->model('webapps/qms/ttiso_model');
			$this->load->model('webapps/qms/ruser_disc_model');
			// $this->load->model('webapps/qms/projwbs_model'); //***this models need pmdb connection in database config
			// $this->load->model('webapps/qms/task_model');
			
			$this->load->model('webapps/qms/Ttemp_conf_model');
			$this->load->model('webapps/qms/Twhse_pip_mat_model');
			$this->load->model('webapps/qms/ps_mto_hdr_model');
		}
		
		public function index(){
            $this->load->view('webApps/public/systems/qms/' . $this->uri->segment(5));
		}
		
		public function save_upload(){
			$fileParam = "files";
		     $uploadRoot = "C:/wamp/www/assets/uploads/";
		    //$uploadRoot = "D:/upload/";
		    $files = $_FILES[$fileParam];
		 	
		    if (isset($files['name'])){
		        $error = $files['error'];
		        if ($error == UPLOAD_ERR_OK) {
		            $targetPath = $uploadRoot . basename($files["name"]);
		            $uploadedFile = $files["tmp_name"];
		 
		            if (is_uploaded_file($uploadedFile)) {
		                if (!move_uploaded_file($uploadedFile, $targetPath)) {
		                    echo "Error moving uploaded file";
		                }
		            }
		        } else {
		            // See http://php.net/manual/en/features.file-upload.errors.php
		            echo "Error code " . $error;
		        }
		    }
		
		     // Return an empty string to signify success
		     echo "";
		}
		
		public function remove_upload(){			
		    $uploadRoot = "C:/wamp/www/assets/uploads/";
		    // $uploadRoot = "C:/www/assets/uploads/";
		    $targetPath = $uploadRoot . basename($_POST["fileNames"]);
		 						
		    unlink($targetPath);
		 
		    // Return an empty string to signify success
		    echo "";
		}
		
		public function read($table, $method = "get_all", &$fieldVal = "", &$dbArr = array(), $type = ""){			
			if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
				foreach ($_GET['fieldF'] as $field => $val):
					$res = explode(";",$val);
					$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . (" isnull(" . $res[0] . ",'') ") . $this->operatorArr[$res[2]] . $res[1] . (in_array($res[2], $this->blankThis) ? "" : "%") . "'";
					
					// if ($res[2] == "neq")
						// $fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " OR " : "") . $res[0] . " is null";
				endforeach;

			// $result_array = eval("\$this->" . $table . "_model->" . $method . "((isset(\$fieldVal) ? \$fieldVal : ''))");
			$str = '\$this->' . $table . '_model->' . $method . '((isset(\$fieldVal) ? \$fieldVal : \'\'))';
			eval("\$result_array = \"$str\";");
			eval("\$result_array = $result_array;");
			if($type == "export"){
				$ictr = 0;
		            foreach ($result_array[0] as $r => $v):
						$r2[$ictr] = $r;
						$ictr++;
		            endforeach;
		            array_push($dbArr, $r2);
			}
            foreach ($result_array as $r):
				if($type != "export"){
					if (isset($r['total']) && ($r['total'] == 0))
					break;
					if (!isset($r['total']))
						$r['total'] = sizeof($result_array);	
				}	
				foreach ($r as $r2 => $v2):
					if (is_object($v2)){
						$date_array = (array) $v2;
						$date_time = $date_array['date'];
						$date_only = explode(" ", $date_time);
						$r[$r2] = $date_only[0];
					}else if (is_string($v2))
						$r[$r2] = stripslashes($v2);
				endforeach;
				
                array_push($dbArr, $r);
            endforeach;
						
            // $this->result['rows'] = $dbArr;
            // $this->output->set_content_type('application/json')->set_output(json_encode($this->result));
		}
		
		public function directCall($item = "",$param = ""){
            $dbArr = array();
			
			switch($item){
				case "iso_engg_pip":
					// -- prior_setup lookup -- //
				   $this->load->model('webapps/qms/sys_prog_model');
				   $priorDbArr = $this->sys_prog_model->get_PROG_CODE("PRIOR_SETUP");
				   $p_char1 = array();
				   $p_char2 = array();
				   $p_char1 = explode(",", $priorDbArr[0]['p_char1']); // -- 
				   $p_char2 = explode(",", $priorDbArr[0]['p_char2']);
				   // -- area_loc lookup-- //
				   $this->load->model('webapps/qms/sys_prog_model');
				   $arealocDbArr = $this->sys_prog_model->get_PROG_CODE("AREA_LOC");
				   $area_loc = array(
									explode(',', $arealocDbArr[0]['p_char1']),
									explode(',', $arealocDbArr[0]['p_char2']),
									explode(',', $arealocDbArr[0]['p_char3']),
									explode(',', $arealocDbArr[0]['p_char4'])
									);
				   $areaArr = array();
				   $newValue = array();
				   //$new_p_char1 = array();
				   $this->load->model('webapps/qms/iso_model');
				   foreach ($p_char1 as $key => $value) {
					   	array_push($newValue, substr($value, 0,2));
						
				   } // -- end of foreach -- //
				  
				   if(in_array($_GET['pno'], $p_char1) >= 0 ){
				   		if(array_search($_GET['pno'], $newValue) == 1){
				   			if($_GET['tbAdvance']==1){
				   				$this->read("iso", "modified_getAll", $fieldVal, $dbArr);
				   			}else{
				   				if($_GET['aname'] == 'ALL'){
									foreach ($area_loc[1] as $key => $value) {
				   	  			  		$value = explode("_", $value);
				   	  			 		array_push($areaArr,$value[0]);					   
				   					}
									$area =str_replace(",", "','", str_replace("\'", "\"", implode(',', $areaArr)));
									//var_dump($area);
									$fieldVal = "priority_timing = '{$_GET['pno']}' and area_loc in ('{$area}')";
									$this->read("iso", "modified_getAll", $fieldVal, $dbArr);
								}else{
									$replace_aname = str_replace("'", '\"',$_GET['aname']);
									//echo $replace_aname;
									$fieldVal = "priority_timing = '{$_GET['pno']}' and area_loc = '{$replace_aname}'";
									$this->read("iso", "modified_getAll", $fieldVal, $dbArr);
								}
				   			}
				   		}else{
				   			if($_GET['tbAdvance']==1){
				   				$this->read("iso", "modified_getAll", $fieldVal, $dbArr);
				   			}else{
								if($_GET['aname'] == 'ALL'){
									foreach ($area_loc[array_search($_GET['pno'], $p_char1)] as $key => $value) {
						   	   			$value = explode("_", $value);
						   	   			array_push($areaArr,$value[0]);					   
						  		 	} 
									
									$area =str_replace(",", "','", str_replace("\'", "\\\"", implode(',', $areaArr)));
									//echo $area;
									$fieldVal = "priority_timing = '{$_GET['pno']}' and area_loc in ('{$area}')";
									$this->read("iso", "modified_getAll", $fieldVal, $dbArr);
								}else{
									
									$fieldVal = "priority_timing = '{$_GET['pno']}' and area_loc = '{$_GET['aname']}'";
									$this->read("iso", "modified_getAll", $fieldVal, $dbArr);
								}
							}
				   			
				   		}
				   }
				break;
				case "export_whse_query_iso":
					$this->load->model('webapps/qms/twhse_mat_iso_model');
					$this->read("twhse_mat_iso", "mod_export_iso_twhseMatIso", $fieldVal, $dbArr,"export");
					// ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "Whse Piping Query(ISO-Wise)");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="Whse Piping Query(ISO-Wise).csv"');
					$csv = urldecode($csv);
		            echo $csv;
					return true;
				break;
				case "thwseRef_iso":
					// -- prior_setup lookup -- //
				   $this->load->model('webapps/qms/sys_prog_model');
				   $priorDbArr = $this->sys_prog_model->get_PROG_CODE("PRIOR_SETUP");
				   $p_char1 = array();
				   $p_char2 = array();
				   $p_char1 = explode(",", $priorDbArr[0]['p_char1']); // -- 
				   $p_char2 = explode(",", $priorDbArr[0]['p_char2']);
				   // -- area_loc lookup-- //
				   $this->load->model('webapps/qms/sys_prog_model');
				   $arealocDbArr = $this->sys_prog_model->get_PROG_CODE("AREA_LOC");
				   $area_loc = array(
									explode(',', $arealocDbArr[0]['p_char1']),
									explode(',', $arealocDbArr[0]['p_char2']),
									explode(',', $arealocDbArr[0]['p_char3']),
									explode(',', $arealocDbArr[0]['p_char4'])
									);
				   $areaArr = array();
				   $newValue = array();
				   //$new_p_char1 = array();
				   $this->load->model('webapps/qms/twhse_mat_iso_model');
				   foreach ($p_char1 as $key => $value) {
					   	array_push($newValue, substr($value, 0,2));
						
				   } // -- end of foreach -- //
				  
				   if(in_array($_GET['pno'], $p_char1) >= 0 ){
				   		if(array_search($_GET['pno'], $newValue) == 1){
				   			if($_GET['tbAdvance']==1){
				   				$this->read("twhse_mat_iso", "modified_getAll", $fieldVal, $dbArr);
				   			}else{
				   				if($_GET['aname'] == 'ALL'){
									foreach ($area_loc[1] as $key => $value) {
				   	  			  		$value = explode("_", $value);
				   	  			 		array_push($areaArr,$value[0]);					   
				   					}
									$area =str_replace(",", "','", str_replace("\'", "\"", implode(',', $areaArr)));
									//var_dump($area);
									$fieldVal = "priority = '{$_GET['pno']}' and area_loc in ('{$area}')";
									$this->read("twhse_mat_iso", "modified_getAll", $fieldVal, $dbArr);
								}else{
									$replace_aname = str_replace("'", '\"',$_GET['aname']);
									//echo $replace_aname;
									$fieldVal = "priority = '{$_GET['pno']}' and area_loc = '{$replace_aname}'";
									$this->read("twhse_mat_iso", "modified_getAll", $fieldVal, $dbArr);
								}
				   			}
				   		}else{
				   			if($_GET['tbAdvance']==1){
				   				$this->read("twhse_mat_iso", "modified_getAll", $fieldVal, $dbArr);
				   			}else{
								if($_GET['aname'] == 'ALL'){
									foreach ($area_loc[array_search($_GET['pno'], $p_char1)] as $key => $value) {
						   	   			$value = explode("_", $value);
						   	   			array_push($areaArr,$value[0]);					   
						  		 	} 
									
									$area =str_replace(",", "','", str_replace("\'", "\\\"", implode(',', $areaArr)));
									//echo $area;
									$fieldVal = "priority = '{$_GET['pno']}' and area_loc in ('{$area}')";
									$this->read("twhse_mat_iso", "modified_getAll", $fieldVal, $dbArr);
								}else{
									
									$fieldVal = "priority = '{$_GET['pno']}' and area_loc = '{$_GET['aname']}'";
									$this->read("twhse_mat_iso", "modified_getAll", $fieldVal, $dbArr);
								}
							}
				   			
				   		}
				   }
				break;
				case "export_whse_query_pswise":
					$this->load->model('webapps/qms/twhse_mat_ps_model');
					$this->read("twhse_mat_ps", "mod_export_psmto_twhseMatPs", $fieldVal, $dbArr,"export");
					// ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "Whse Piping Query(PS-Wise)");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="Whse Piping Query(PS-Wise).csv"');
					$csv = urldecode($csv);
		            echo $csv;
					return true;
				break;
				case "export_thwseRef_mat_ps":
					 $this->load->model('webapps/qms/twhse_mat_spl_model');
					 $this->read("twhse_mat_spl", "mod_export_psmto_twhseMatSpl", $fieldVal, $dbArr,"export");
				
				// ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "Whse Piping Query(SPL-Wise)");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="Whse Piping Query(SPL-Wise).csv"');
					$csv = urldecode($csv);
		            echo $csv;
					return true;
				break;
				case "thwseRef_spl":
					// -- prior_setup lookup -- //
				   $this->load->model('webapps/qms/sys_prog_model');
				   $priorDbArr = $this->sys_prog_model->get_PROG_CODE("PRIOR_SETUP");
				   $p_char1 = array();
				   $p_char2 = array();
				   $p_char1 = explode(",", $priorDbArr[0]['p_char1']); // -- 
				   $p_char2 = explode(",", $priorDbArr[0]['p_char2']);
				   // -- area_loc lookup-- //
				   $this->load->model('webapps/qms/sys_prog_model');
				   $arealocDbArr = $this->sys_prog_model->get_PROG_CODE("AREA_LOC");
				   $area_loc = array(
									explode(',', $arealocDbArr[0]['p_char1']),
									explode(',', $arealocDbArr[0]['p_char2']),
									explode(',', $arealocDbArr[0]['p_char3']),
									explode(',', $arealocDbArr[0]['p_char4'])
									);
				   $areaArr = array();
				   $newValue = array();
				   //$new_p_char1 = array();
				   $this->load->model('webapps/qms/twhse_mat_spl_model');
				   foreach ($p_char1 as $key => $value) {
					   	array_push($newValue, substr($value, 0,2));
						
				   } // -- end of foreach -- //
				  
				   if(in_array($_GET['pno'], $p_char1) >= 0 ){
				   		if(array_search($_GET['pno'], $newValue) == 1){
				   			if($_GET['tbAdvance']==1){
				   				$this->read("twhse_mat_spl", "modified_getAll", $fieldVal, $dbArr);
				   			}else{
				   				if($_GET['aname'] == 'ALL'){
									foreach ($area_loc[1] as $key => $value) {
				   	  			  		$value = explode("_", $value);
				   	  			 		array_push($areaArr,$value[0]);					   
				   					}
									$area =str_replace(",", "','", str_replace("\'", "\"", implode(',', $areaArr)));
									//var_dump($area);
									$fieldVal = "priority = '{$_GET['pno']}' and area_loc in ('{$area}')";
									$this->read("twhse_mat_spl", "modified_getAll", $fieldVal, $dbArr);
								}else{
									$replace_aname = str_replace("'", '\"',$_GET['aname']);
									//echo $replace_aname;
									$fieldVal = "priority = '{$_GET['pno']}' and area_loc = '{$replace_aname}'";
									$this->read("twhse_mat_spl", "modified_getAll", $fieldVal, $dbArr);
								}
				   			}
				   		}else{
				   			if($_GET['tbAdvance']==1){
				   				$this->read("twhse_mat_spl", "modified_getAll", $fieldVal, $dbArr);
				   			}else{
								if($_GET['aname'] == 'ALL'){
									foreach ($area_loc[array_search($_GET['pno'], $p_char1)] as $key => $value) {
						   	   			$value = explode("_", $value);
						   	   			array_push($areaArr,$value[0]);					   
						  		 	} 									
									$area =str_replace(",", "','", str_replace("\'", "\\\"", implode(',', $areaArr)));
									//echo $area;
									$fieldVal = "priority = '{$_GET['pno']}' and area_loc in ('{$area}')";
									$this->read("twhse_mat_spl", "modified_getAll", $fieldVal, $dbArr);
								}else{
									
									$fieldVal = "priority = '{$_GET['pno']}' and area_loc = '{$_GET['aname']}'";
									$this->read("twhse_mat_spl", "modified_getAll", $fieldVal, $dbArr);
								}
							}
				   			
				   		}
				   }
				break;
				case "thwseRef_ps":
					// -- prior_setup lookup -- //
				   $this->load->model('webapps/qms/sys_prog_model');
				   $priorDbArr = $this->sys_prog_model->get_PROG_CODE("PRIOR_SETUP");
				   $p_char1 = array();
				   $p_char2 = array();
				   $p_char1 = explode(",", $priorDbArr[0]['p_char1']); // -- 
				   $p_char2 = explode(",", $priorDbArr[0]['p_char2']);
				   // -- area_loc lookup-- //
				   $this->load->model('webapps/qms/sys_prog_model');
				   $arealocDbArr = $this->sys_prog_model->get_PROG_CODE("AREA_LOC");
				   $area_loc = array(
									explode(',', $arealocDbArr[0]['p_char1']),
									explode(',', $arealocDbArr[0]['p_char2']),
									explode(',', $arealocDbArr[0]['p_char3']),
									explode(',', $arealocDbArr[0]['p_char4'])
									);
				   $areaArr = array();
				   $newValue = array();
				   //$new_p_char1 = array();
				   $this->load->model('webapps/qms/twhse_mat_ps_model');
				   foreach ($p_char1 as $key => $value) {
					   	array_push($newValue, substr($value, 0,2));
						
				   } // -- end of foreach -- //
				  
				   if(in_array($_GET['pno'], $p_char1) >= 0 ){
				   		if(array_search($_GET['pno'], $newValue) == 1){
				   			if($_GET['tbAdvance']==1){
				   				$this->read("twhse_mat_ps", "modified_getAll", $fieldVal, $dbArr);
				   			}else{
				   				if($_GET['aname'] == 'ALL'){
									foreach ($area_loc[1] as $key => $value) {
				   	  			  		$value = explode("_", $value);
				   	  			 		array_push($areaArr,$value[0]);					   
				   					}
									$area =str_replace(",", "','", str_replace("\'", "\"", implode(',', $areaArr)));
									//var_dump($area);
									$fieldVal = "priority = '{$_GET['pno']}' and area_loc in ('{$area}')";
									$this->read("twhse_mat_ps", "modified_getAll", $fieldVal, $dbArr);
								}else{
									$replace_aname = str_replace("'", '\"',$_GET['aname']);
									//echo $replace_aname;
									$fieldVal = "priority = '{$_GET['pno']}' and area_loc = '{$replace_aname}'";
									$this->read("twhse_mat_ps", "modified_getAll", $fieldVal, $dbArr);
								}
				   			}
				   		}else{
				   			if($_GET['tbAdvance']==1){
				   				$this->read("twhse_mat_ps", "modified_getAll", $fieldVal, $dbArr);
				   			}else{
								if($_GET['aname'] == 'ALL'){
									foreach ($area_loc[array_search($_GET['pno'], $p_char1)] as $key => $value) {
						   	   			$value = explode("_", $value);
						   	   			array_push($areaArr,$value[0]);					   
						  		 	} 
									
									$area =str_replace(",", "','", str_replace("\'", "\\\"", implode(',', $areaArr)));
									//echo $area;
									$fieldVal = "priority = '{$_GET['pno']}' and area_loc in ('{$area}')";
									$this->read("twhse_mat_ps", "modified_getAll", $fieldVal, $dbArr);
								}else{
									
									$fieldVal = "priority = '{$_GET['pno']}' and area_loc = '{$_GET['aname']}'";
									$this->read("twhse_mat_ps", "modified_getAll", $fieldVal, $dbArr);
								}
							}
				   			
				   		}
				   }
				break;
				case "area_loc":
					$this->load->model('webapps/qms/sys_prog_model');
				    $dbArr = $this->sys_prog_model->get_PROG_CODE("AREA_LOC");
					$area_loc = array(									explode(',', $dbArr[0]['p_char1']),
									explode(',', $dbArr[0]['p_char2']),
									explode(',', $dbArr[0]['p_char3']),
									explode(',', $dbArr[0]['p_char4'])
									);
					
					$a = 0;
					$v_pno = array();
					while ($a <= 3) {
						$b = 0;
						while ($b <= (sizeof($area_loc[$a]) - 1)) {
							$v_pno = explode("_", $area_loc[$a][$b]);
							if ($v_pno[1] == $_GET['pno']) {
								if (!in_array(array("pseq" => $a,"aname" => "ALL","pno" => $v_pno[1], "aseq" => 0, "total" => sizeof($area_loc[$a])), $dbArr))
					            	array_push($dbArr, array("pseq" => $a,"aname" => "ALL","pno" => $v_pno[1], "aseq" => 0, "total" => sizeof($area_loc[$a])));
					            
					            array_push($dbArr, array("pseq" => $a,"aname" => $v_pno[0],"pno" => $v_pno[1], "aseq" => $b, "total" => sizeof($area_loc[$a])));
							}
							$b++;						
						}
						$a++;						
					}
				array_splice($dbArr,0,-13);
				break;
				case "prior_setup":
				   $this->load->model('webapps/qms/sys_prog_model');
				   $dbArr = $this->sys_prog_model->get_PROG_CODE("PRIOR_SETUP");
				   $pno = array();
				   $pname = array();
				   $cntr = 0;
				   $a = 0;
				   $newDbArr = array();
				   $pno = explode(",", $dbArr[0]['p_char1']);
				   $pname = explode(",", $dbArr[0]['p_char2']);
				   $a = 0;
				   while ($a <= (sizeof($pno) - 1)) {
		               array_push($dbArr, array("p_char1" => $pno[$a], "total" => sizeof($pno), "pseq" =>$a+1,"p_char2" => $pname[$a]));
						
		                $a++;												
				   }
				array_splice($dbArr,0,-4);				//$dbArr = $newDbArr;				
			    break;
				case "export_pipTwhseStr":
					$this->load->model('webapps/qms/twhse_str_mat_model');
					$this->read("twhse_str_mat", "export_modified", $fieldVal, $dbArr,"export");
					// ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "Structural MTO/JMIF");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="Structural MTO/JMIF.csv"');
					$csv = urldecode($csv);
		            echo $csv;
					return true;
				break;
				case "pipTwhseStr":
					$this->load->model('webapps/qms/twhse_str_mat_model');
					$this->read("twhse_str_mat", "get_all", $fieldVal, $dbArr);
				break;
				case "export_pipTwhse":
					$this->load->model('webapps/qms/twhse_pip_mat_model');
					$this->read("twhse_pip_mat", "export_modified", $fieldVal, $dbArr,"export");
					// ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "Piping MTO/JMIF");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="Piping MTO/JMIF.csv"');
					$csv = urldecode($csv);
		            echo $csv;
					return true;
				break;
				case "pipTwhse":
					$this->load->model('webapps/qms/twhse_pip_mat_model');
					$this->read("twhse_pip_mat", "get_all", $fieldVal, $dbArr);
				break;
				case "jmif_printRpt":
					$this->load->model('webapps/qms/treqiss_hdr_model');
					$dbArr = $this->treqiss_hdr_model->get_jmifInfo($_GET['listOfSelected']);
					//$this->read("treqiss_hdr", "get_jmifInfo", $fieldVal, $dbArr);
				break;
				case "jmif_print_rep":
					$fieldVal = "disc_code = '{$_GET['disc_code']}' and finalized = '{$_GET['finalized']}'";
					$this->load->model('webapps/qms/treqiss_hdr_model');
					$this->read("treqiss_hdr", "get_all_mod", $fieldVal, $dbArr);
				break;
				case "export_Splwise":
				 $area_loc = array(
									 array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									 array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									 array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							    );
				    $prior_setup = array("P1","TA-2013","P2","P3");
				    $prior_setup2 = array("P1","TA","P2","P3");
				   	$areaArr = array();
				   
					if(in_array($_GET['pno'], $prior_setup) >= 0 ){				   	 
						if(array_search($_GET['pno'], $prior_setup) == 1){
							foreach ($area_loc[1] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							}						
						} else {
							foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							} 
							// $cArealoc = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
						}
					}
					$cArealoc = str_replace("','", "*!*", str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr)))));
				    $aname = str_replace(",", "','", str_replace("'", "\"", addslashes( $_GET['aname'])));
				    $pno = $_GET['pno'];
				    $this->load->model('webapps/qms/piping_spl_wise_model');
					$this->piping_spl_wise_model->proc_export($cArealoc);
		       	    $this->read("piping_spl_wise", "get_all_export", $fieldVal, $dbArr,"export");
					
					// ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "Whse Piping Query(SPL-Wise)");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="Whse Piping Query(SPL-Wise).csv"');
					$csv = urldecode($csv);
		            echo $csv;
					return true;
				break;
				case "export_PSwise":
				 $area_loc = array(
									 array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									 array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									 array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							    );
				    $prior_setup = array("P1","TA-2013","P2","P3");
				    $prior_setup2 = array("P1","TA","P2","P3");
				   	$areaArr = array();
				   
					if(in_array($_GET['pno'], $prior_setup) >= 0 ){				   	 
						if(array_search($_GET['pno'], $prior_setup) == 1){
							foreach ($area_loc[1] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							}						
						} else {
							foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							} 
							// $cArealoc = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
						}
					}
					$cArealoc = str_replace("','", "*!*", str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr)))));
				    $aname = str_replace(",", "','", str_replace("'", "\"", addslashes( $_GET['aname'])));
				    $pno = $_GET['pno'];
				    $this->load->model('webapps/qms/piping_ps_wise_model');
					$this->piping_ps_wise_model->proc_export_psWise($cArealoc);
		       	    $this->read("piping_ps_wise", "get_all_export", $fieldVal, $dbArr,"export");
					
					// ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "Whse Piping Query(PS-Wise)");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="Whse Piping Query(PS-Wise).csv"');
					$csv = urldecode($csv);
		            echo $csv;
					return true;
				break;
				case "export_Isowise":
				 $area_loc = array(
									 array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									 array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									 array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							    );
				    $prior_setup = array("P1","TA-2013","P2","P3");
				    $prior_setup2 = array("P1","TA","P2","P3");
				   	$areaArr = array();
				   
					if(in_array($_GET['pno'], $prior_setup) >= 0 ){				   	 
						if(array_search($_GET['pno'], $prior_setup) == 1){
							foreach ($area_loc[1] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							}						
						} else {
							foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							} 
							// $cArealoc = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
						}
					}
					$cArealoc = str_replace("','", "*!*", str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr)))));
				    $aname = str_replace(",", "','", str_replace("'", "\"", addslashes( $_GET['aname'])));
				    $pno = $_GET['pno'];
				    $this->load->model('webapps/qms/piping_iso_wise_model');
					$this->piping_iso_wise_model->proc_export($cArealoc);
		       	    $this->read("piping_iso_wise", "get_all_export", $fieldVal, $dbArr,"export");
					
					// ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "Whse Piping Query(ISO-Wise)");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="Whse Piping Query(ISO-Wise).csv"');
					$csv = urldecode($csv);
		            echo $csv;
					return true;
				break;
				case "ttisoStruc":
					//$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and area_loc = '{$_GET['area_loc']}'";
					$this->load->model('webapps/qms/tt_iso_struc_model');
					$this->read("tt_iso_struc", "get_all", $fieldVal, $dbArr);
					break;
				case "d_isoRef":
					
					$cDrawingNo = $_GET['drawing_no']. "-".$_GET['sheet_no']."-".$_GET['rev_no'];
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '$cDrawingNo' and rev_no = '{$_GET['rev_no']}'";
					
					$this->load->model('webapps/qms/dms_iso_model');
					$this->read("dms_iso", "getall_mod", $fieldVal, $dbArr);
					break;
				case "tosd_dtl_Ref":
					$fieldVal ="";
					$this->load->model('webapps/qms/tosd_dtl_model');
					$this->read("tosd_dtl", "get_all", $fieldVal, $dbArr);
					break;
				case "tosd_dtl_Ref2":
					$fieldVal = "osd_no = '{$_GET['osd_no']}'";
					$this->load->model('webapps/qms/tosd_dtl_model');
					$this->read("tosd_dtl", "get_all", $fieldVal, $dbArr);
					$cntr = 0;
						   $newDbArr = array();
							foreach ($dbArr as $key => $value) {
								$cntr = 0;
								foreach ($value as $key2 => $value2) {
									$newDbArr[$key][$key2] = $value2;
									++$cntr;
								}
								if($newDbArr[$key]['ins_claim'] == 0){
									$newDbArr[$key]['ins_claim'] = "NO";
								}else{
									$newDbArr[$key]['ins_claim'] = "YES";
								 }
									
							}
					$dbArr = $newDbArr;
					break;
				case "tosd_hdr_Ref":
					$this->load->model('webapps/qms/tosd_hdr_model');
					$this->read("tosd_hdr", "get_all", $fieldVal, $dbArr);
					break;
				case "spool":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}'";
					$this->read("spool", "get_all", $fieldVal, $dbArr);
					break;
				case "joints":
					if (isset($_GET['spool_no'])){
						$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and spool_no = '{$_GET['spool_no']}'";						
						$this->read("joints", "get_all", $fieldVal, $dbArr);
			        }
					break;
				case "random":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}'";						
					$this->read("random_pipes", "get_all", $fieldVal, $dbArr);
					break;
				case "material":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}'";						
						$this->read("mat_takeoff_perspool", "get_all", $fieldVal, $dbArr);
					break;
				case "mat_takeoff_perspoolRef":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and spool_no <> 'EM'";	
						$this->load->model('webapps/qms/mat_takeoff_perspool_model');
						$this->read("mat_takeoff_perspool", "get_all", $fieldVal, $dbArr);
					break;
				
				
				case "mat_takeoff_perspoolRef2":
						
						$cntr = 0;
						$newDbArr = array();
						// $this->load->model('webapps/qms/material_file_model');
						// $this->read("material_file", "getAll",$fieldVal2, $dbArr2);
						// $dbArr2['description'];
						$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and spool_no = 'EM'";	
						$this->load->model('webapps/qms/mat_takeoff_perspool_model');
						$this->read("mat_takeoff_perspool", "get_all", $fieldVal, $dbArr);
						$this->load->model('webapps/qms/material_file_model');
						
						foreach ($dbArr as $key => $value) {
							$cntr = 0;
							foreach ($value as $key2 => $value2) {
								$newDbArr[$key][$key2] = $value2;
								++$cntr;
							}
							$dbArr2 = array();
							$fieldVal2 = "item_code = '{$value['item_code']}'  ";
							$this->read("material_file", "getall", $fieldVal2, $dbArr2);
							$newDbArr[$key]['description'] = $dbArr2[0]['description'];
							
						}
						$dbArr = $newDbArr;
						
						
					break;
				case "mat_takeoff_perspoolRef3":
						
						$cntr = 0;
						$newDbArr = array();
						// $this->load->model('webapps/qms/material_file_model');
						// $this->read("material_file", "getAll",$fieldVal2, $dbArr2);
						// $dbArr2['description'];
						$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and spool_no = '{$_GET['spool_no']}'";	
						$this->load->model('webapps/qms/mat_takeoff_perspool_model');
						$this->read("mat_takeoff_perspool", "get_all", $fieldVal, $dbArr);
						$this->load->model('webapps/qms/material_file_model');
						
						foreach ($dbArr as $key => $value) {
							$cntr = 0;
							foreach ($value as $key2 => $value2) {
								$newDbArr[$key][$key2] = $value2;
								++$cntr;
							}
							$dbArr2 = array();
							$fieldVal2 = "item_code = '{$value['item_code']}'  ";
							$this->read("material_file", "getall", $fieldVal2, $dbArr2);
							$newDbArr[$key]['description'] = $dbArr2[0]['description'];
							
							
							if ($newDbArr[$key]['ref_rec_qty'] > $newDbArr[$key]['qty'])
								$newDbArr[$key]['BALANCE_EXCESS'] = "EXCESS";
							else {
								if($newDbArr[$key]['qty'] - $newDbArr[$key]['ref_rec_qty'])
									$newDbArr[$key]['BALANCE_EXCESS'] = "BALANCE";
								else
									$newDbArr[$key]['BALANCE_EXCESS'] = "COMPLETED";
							}
							
						}
						
						$dbArr = $newDbArr;
						
						
					break;
				case "jwrr_info":	
					
					$this->load->model('webapps/qms/tjwrr_hdr_model');
					$this->read("tjwrr_hdr", "get_all2", $fieldVal, $dbArr);
					break;
				case "testpackRef":	
					$this->load->model('webapps/qms/testpack_hdr_model');
					$this->read("testpack_hdr", "get_all2", $fieldVal, $dbArr);
					break;
				case "jmif_no_date_Ref":	
					$fieldVal = "disc_code = 'STRL' and jmif_date >= '{$_GET['start']}' and jmif_date <= '{$_GET['end']}'";
					$this->load->model('webapps/qms/treqiss_hdr_model');
					$this->read("treqiss_hdr", "get_all_mod", $fieldVal, $dbArr);
					break;
				
				
				case "mat_takeoff_perspoolRef_Ttiso":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and spool_no = '{$_GET['spool_no']}'";	
						$this->load->model('webapps/qms/mat_takeoff_perspool_model');
						$this->read("mat_takeoff_perspool", "get_all", $fieldVal, $dbArr);
					break;
				case "spoolRef":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and spool_no <> 'EM'";	
						$this->load->model('webapps/qms/spool_model');
						$this->read("spool", "get_all", $fieldVal, $dbArr);
					break;
				case "ttisoSpool":
					 $area_loc = array(
									 array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									 array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									 array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							    );
				    $prior_setup = array("P1","TA-2013","P2","P3");
				    $prior_setup2 = array("P1","TA","P2","P3");
				   	$areaArr = array();
				   
					if(in_array($_GET['pno'], $prior_setup) >= 0 ){				   	 
						if(array_search($_GET['pno'], $prior_setup) == 1){
							foreach ($area_loc[1] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							}						
						} else {
							foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							} 
							// $cArealoc = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
						}
					}
					$cArealoc = "'". str_replace("','", "*!*", str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr)))))."'";
				    $aname = "'".str_replace(",", "','", str_replace("'", "\"", addslashes( $_GET['aname'])))."'";
				    $pno = "'".$_GET['pno']."'";
				
					 $this->load->model('webapps/qms/ttisoSpool_model');
					 $this->ttisoSpool_model->call_sp_query_ttisoSpool((int) $_GET['tbAdvance'],(int)$_GET['rswork'],$aname,$cArealoc,$pno);
		       	     $this->read("ttisoSpool", "get_all", $fieldVal, $dbArr);
			         // $cntr = 0;
						 // $newDbArr = array();
							// foreach ($dbArr as $key => $value) {
								// $cntr = 0;
								// foreach ($value as $key2 => $value2) {
									// $newDbArr[$key][$key2] = $value2;
									// ++$cntr;
								// }
// 								
								// if ($newDbArr[$key]['sw_diainch'] <> 0 && $newDbArr[$key]['tot_diainch'] >= $newDbArr[$key]['sw_diainch'] )
									// $newDbArr[$key]['fab_stat'] = "YES";
// 									
								// else 
									// $newDbArr[$key]['fab_stat'] = "NO";
// 								
							// }
// 						
				// $dbArr = $newDbArr;
				// // $this->load->model('webapps/qms/iso_model');
		        // // $this->read("iso", "get_all2", $fieldVal, $dbArr);
				// // echo "Advance: " . (int)$_GET['tbAdvance'] . "<br />";
				// // echo "RSWork: " . (int)$_GET['rswork'] . "<br />";
				// // echo "Aname: " . $aname . "<br />";
				// // echo "cArealoc: " . $cArealoc . "<br />";
				// // echo "pno: " . $pno . "<br />";
				// // return true; 
				break;
				case "tfabSplwise":
					 $area_loc = array(
									 array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									 array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									 array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							    );
				    $prior_setup = array("P1","TA-2013","P2","P3");
				    $prior_setup2 = array("P1","TA","P2","P3");
				   	$areaArr = array();
				   
					if(in_array($_GET['pno'], $prior_setup) >= 0 ){				   	 
						if(array_search($_GET['pno'], $prior_setup) == 1){
							foreach ($area_loc[1] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							}						
						} else {
							foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							} 
							// $cArealoc = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
						}
					}
					$cArealoc = "'". str_replace("','", "*!*", str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr)))))."'";
				    $aname = "'".str_replace(",", "','", str_replace("'", "\"", addslashes( $_GET['aname'])))."'";
				    $pno = "'".$_GET['pno']."'";
					 $this->load->model('webapps/qms/tt_tfabSplwise_model');
					 $this->tt_tfabSplwise_model->call_sp_query_tfabSplwise((int) $_GET['tbAdvance'],(int)$_GET['rswork'],$aname,$cArealoc,$pno);
		       	     $this->read("tt_tfabSplwise", "get_all", $fieldVal, $dbArr);
				
				break;
				case "export_ttisoSpool":
					  $area_loc = array(
									 array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									 array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									 array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							    );
				    $prior_setup = array("P1","TA-2013","P2","P3");
				    $prior_setup2 = array("P1","TA","P2","P3");
				   	$areaArr = array();
				   
					if(in_array($_GET['pno'], $prior_setup) >= 0 ){				   	 
						if(array_search($_GET['pno'], $prior_setup) == 1){
							foreach ($area_loc[1] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							}						
						} else {
							foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							} 
							// $cArealoc = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
						}
					}
					$cArealoc = "'". str_replace("','", "*!*", str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr)))))."'";
				    $aname = "'".str_replace(",", "','", str_replace("'", "\"", addslashes( $_GET['aname'])))."'";
				    $pno = "'".$_GET['pno']."'";
				
					 $this->load->model('webapps/qms/ttisoSpool_model');
					 $this->ttisoSpool_model->call_sp_query_ttisoSpool((int) $_GET['tbAdvance'],(int)$_GET['rswork'],$aname,$cArealoc,$pno);
		       	     $this->read("ttisoSpool", "get_all_export", $fieldVal, $dbArr,"export");
			         // $cntr = 0;
						 // $newDbArr = array();
							// foreach ($dbArr as $key => $value) {
								// $cntr = 0;
								// if($key > 0){
									// if ($value['spool_id'] == "" || !isset($value['spool_id']))
										// continue;
								// }
// 								
								// foreach ($value as $key2 => $value2) {
									// if($key > 0){
// 									
									// }
									// $newDbArr[$key][$key2] = $value2;
									// ++$cntr;
								// }
								// if ($cntr == (sizeof($value) - 1)){
									// if ($newDbArr[$key]['sw_diainch'] <> 0 && $newDbArr[$key]['tot_diainch'] >= $newDbArr[$key]['sw_diainch'] )
										// $newDbArr[$key]['fab_stat'] = "YES";
// 										
									// else 
										// $newDbArr[$key]['fab_stat'] = "NO";
								// }else {									
									// $newDbArr[$key][$cntr] = 'fab_stat';		
									// //$newDbArr[$key][$cntr + 1] = 'remarks';								
								// }	
							// }
// 						
				// $dbArr = $newDbArr;
				// ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "Fabshop Progress Workability.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="Fabshop Progress Workability.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
				break;
				
				case "export_tfabSplwise":
					  $area_loc = array(
									 array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									 array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									 array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							    );
				    $prior_setup = array("P1","TA-2013","P2","P3");
				    $prior_setup2 = array("P1","TA","P2","P3");
				   	$areaArr = array();
				   
					if(in_array($_GET['pno'], $prior_setup) >= 0 ){				   	 
						if(array_search($_GET['pno'], $prior_setup) == 1){
							foreach ($area_loc[1] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							}						
						} else {
							foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							} 
							// $cArealoc = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
						}
					}
					$cArealoc = "'". str_replace("','", "*!*", str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr)))))."'";
				    $aname = "'".str_replace(",", "','", str_replace("'", "\"", addslashes( $_GET['aname'])))."'";
				    $pno = "'".$_GET['pno']."'";
				
					 $this->load->model('webapps/qms/tt_tfabSplwise_model');
					 $this->tt_tfabSplwise_model->call_sp_query_tfabSplwise((int) $_GET['tbAdvance'],(int)$_GET['rswork'],$aname,$cArealoc,$pno);
		       	     $this->read("tt_tfabSplwise", "export_TfabSplwise", $fieldVal, $dbArr,"export");
			         
				// ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "Fabshop Progress Workability.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="Fabshop Progress Workability.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
				break;
				case "pipeLstRef":
					$fieldVal = "drawing_no = '{$_GET['drawing_no']}'";	
						$this->load->model('webapps/qms/ps_mto_hdr_model');
						$this->read("ps_mto_hdr", "get_all", $fieldVal, $dbArr);
					break;
				case "export_tpntg_mat_spl":
						$this->load->model('webapps/qms/tpntg_mat_spl_model');
						$this->read("tpntg_mat_spl", "export_tpntg_mat_spl", $fieldVal, $dbArr,"export");
						 $cntr = 0;
						$pntg_stat  = '';
						
						 $newDbArr = array();
							foreach ($dbArr as $key => $value) {
								if($key > 0){
									if ($value['topcoat_s_area'] == "" || !isset($value['topcoat_s_area']))
										continue;
									if ($value['pntg_topcoat_qty'] == "" || !isset($value['pntg_topcoat_qty']))
										continue;
									
								}
								$cntr = 0;
								foreach ($value as $key2 => $value2) {
									if ($key2 == 37){
										continue;
									}
									
									$newDbArr[$key][$key2] = $value2;
									++$cntr;
								if ($cntr == (sizeof($value) - 1)){
									if ($key > 0){
										if($_GET['ladvance'] == "true"){
											if($newDbArr[$key]['topcoat_s_area'] <> 0 && $newDbArr[$key]['pntg_topcoat_qty'] >= $newDbArr[$key]['topcoat_s_area']){
												$pntg_stat = "SPOOL PAINT COMPLETED";
											}else{
												if($newDbArr[$key]['pntg_topcoat_qty'] < $newDbArr[$key]['topcoat_s_area'])
													$pntg_stat = "SPOOL PAINT NOT COMPLETED";
											}
												
										}else{
											if($_GET['rswork'] == 0){
												$fieldVal = "topcoat_s_area <> 0 AND pntg_topcoat_qty >= topcoat_s_area";
												$this->load->model('webapps/qms/tpntg_mat_spl_model');
												$this->read("tpntg_mat_spl", "export_tpntg_mat_spl", $fieldVal, $dbArr);
												$pntg_stat = "SPOOL PAINT COMPLETED";
											}else{
												$fieldVal ="pntg_topcoat_qty < topcoat_s_area";
												$this->load->model('webapps/qms/tfab_mat_spl_model');
												$this->read("tfab_mat_spl", "export_tpntg_mat_spl", $fieldVal, $dbArr);
												$pntg_stat = "SPOOL PAINT NOT COMPLETED";
											 }
										}
										$newDbArr[$key]['plant_no'] = $pntg_stat;
									}else{
										$newDbArr[$key][0] = 'pntg_stat';
									 }
								}
							  }	
							}
						$dbArr = $newDbArr;
						 // -- ..
						 	
					// var_dump($newDbArr);
					// return true;
						// ------ Create and download csv ----
					$csv = array_to_csv($newDbArr, "Painting Progress Workability SPL.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="Painting Progress Workability SPL.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "tpntg_mat_spl":
						if($_GET['rsComplete'] == 0)
							$fieldVal = "topcoat_s_area <> 0 AND pntg_topcoat_qty >= topcoat_s_area";
						else
							$fieldVal ="pntg_topcoat_qty < topcoat_s_area";
						$this->load->model('webapps/qms/tpntg_mat_spl_model');
						$this->read("tpntg_mat_spl", "get_all", $fieldVal, $dbArr);
						
						   $cntr = 0;
						   $newDbArr = array();
							foreach ($dbArr as $key => $value) {
								$cntr = 0;
								foreach ($value as $key2 => $value2) {
									$newDbArr[$key][$key2] = $value2;
									++$cntr;
								}
								if($newDbArr[$key]['topcoat_s_area'] <> "0" && $newDbArr[$key]['pntg_topcoat_qty'] >= $newDbArr[$key]['topcoat_s_area'] ){
									$newDbArr[$key]['pntg_stat'] = "YES";
								}else
									$newDbArr[$key]['pntg_stat'] = "NO";
								
							}
						$dbArr = $newDbArr;
						
						
					break;
				case "tfab_mat_spl_ref":
						if($_GET['rsComplete'] == 0)
							$fieldVal = "tot_jnt_dia <> 0 AND tot_jnt_fw_dia >= tot_jnt_dia";
						else
							$fieldVal ="tot_jnt_fw_dia < tot_jnt_dia";
						$this->load->model('webapps/qms/tfab_mat_spl_model');
						$this->read("tfab_mat_spl", "get_all", $fieldVal, $dbArr);
					break;
				case "export_tfab_mat_spl_ref":
						$this->load->model('webapps/qms/tfab_mat_spl_model');
						$this->read("tfab_mat_spl", "export_tfab_mat_spl", $fieldVal, $dbArr,"export");
						$cntr = 0;
						$newDbArr = array();
						$fab_stat = '';
						   
							foreach ($dbArr as $key => $value) {
								$cntr = 0;
								if($key > 0){
									// if ($value['PROGRESS_RECID'] == "" || !isset($value['PROGRESS_RECID']))
										// continue;
									// if ($value['pntg_topcoat_qty'] == "" || !isset($value['pntg_topcoat_qty']))
										// continue;
								}
								foreach ($value as $key2 => $value2) {
									if ($key2 == 36){
										continue;
									}
									
									$newDbArr[$key][$key2] = $value2;
									++$cntr;
									if ($cntr == (sizeof($value) - 1)){
										if($key > 0){
											if($_GET['ladvance'] == "true"){
												if($newDbArr[$key]['tot_jnt_dia'] <> 0 && $newDbArr[$key]['tot_jnt_fw_dia'] >= $newDbArr[$key]['tot_jnt_dia']){
													$fab_stat = "SPOOL FABRICATED COMPLETED";
												}else{
													if($newDbArr[$key]['tot_jnt_fw_dia'] < $newDbArr[$key]['tot_jnt_dia'])
														$fab_stat = "SPOOL FABRICATED NOT-COMPLETED";
												}
													
												}else{
													if($_GET['rswork'] == 0){
														$fieldVal = "tot_jnt_dia <> 0 AND tot_jnt_fw_dia >= tot_jnt_dia";
														$this->load->model('webapps/qms/tfab_mat_spl_model');
														$this->read("tfab_mat_spl", "export_tfab_mat_spl", $fieldVal, $dbArr);
														$fab_stat = "SPOOL FABRICATED COMPLETED";
													}else{
														$fieldVal ="tot_jnt_fw_dia < tot_jnt_dia";
														$this->load->model('webapps/qms/tfab_mat_spl_model');
														$this->read("tfab_mat_spl", "export_tfab_mat_spl", $fieldVal, $dbArr);
														$fab_stat = "SPOOL FABRICATED NOT-COMPLETED";
													 }
												 }
												
										$newDbArr[$key]['plant_no']	= $fab_stat;
										}else{
											$newDbArr[$key][0] = 'fab_stat';
										}
									}
								}	
							}
						$dbArr = $newDbArr;					
						// ------ Create and download csv ----
					$csv = array_to_csv($newDbArr, "FABSHOP Progress Update.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="FABSHOP Progress Update.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "jointLstRef":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}'";	
						$this->load->model('webapps/qms/joints_model');
						$this->read("joints", "get_all", $fieldVal, $dbArr);
					break;
				case "materialRef":
					$fieldVal = "";						
						$this->read("material_file", "get_all", $fieldVal, $dbArr);
					break;
				case "material_dtlRef":
					$fieldVal = "stock_no = '{$_GET['stock_no']}'";						
						$this->read("material_file_dtl", "get_all", $fieldVal, $dbArr);
					break;
				case "item":
		            array_push($dbArr, array("item_code"=>"","description"=>""));
		            foreach ($this->material_file_dtl_model->get_all_dd() as $r):
		                array_push($dbArr, $r);
		               
		            endforeach;
					break;
				case "item2":
		            array_push($dbArr, array("item_code"=>"","description"=>""));
		            foreach ($this->material_file_dtl_model->getAll_dd_mod() as $r):
		                array_push($dbArr, $r);
		               
		            endforeach;
					break;
				case "matFileItem":
		            //array_push($dbArr, array("item_code"=>"","description"=>""));
		            foreach ($this->material_file_model->get_all_dd() as $r):
		                array_push($dbArr, $r);
		               
		            endforeach;
					break;
				case "matUtil_dd":
		            // array_push($dbArr, array("flg_status"=>1));
		            foreach ($this->rmat_util_model->get_all_dd() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "area":
		            array_push($dbArr, array("area_no"=>"<ALL>","area_desc"=>""));
		            foreach ($this->area_model->get_all_dd() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "areaTbl":						
					$this->read("area", "get_all", $fieldVal, $dbArr);
					break;
				case "subarea":
					$fieldVal = "area_no = '{$_GET['area_no']}'";						
					$this->read("sub_area", "get_all", $fieldVal, $dbArr);
					break;
				case "fwbs":
					$this->read("ref_fwbs", "get_all", $fieldVal, $dbArr);
					break;
				case "discTbl":
					$this->read("ref_discipline", "get_all", $fieldVal, $dbArr);
					break;
				case "refJnt":
					$this->read("ref_jointtype", "get_all", $fieldVal, $dbArr);
					break;
				case "tran_acvty_ref":
					
					$fieldVal = "user_id = '{$_GET['user_id']}'";
					$this->load->model('webapps/qms/tran_acvty_ctr_model');
					$this->read("tran_acvty_ctr", "get_all", $fieldVal, $dbArr);
				break;
				case "ruser_ref":
					$this->load->model('webapps/qms/ruser_model');
					$this->read("ruser", "get_all", $fieldVal, $dbArr);
					$newDbArr = array();
					$cntr = 0;
					$newDbArr = array();
							
							foreach ($dbArr as $key => $value) {
								$cntr = 0;
								foreach ($value as $key2 => $value2) {
									$newDbArr[$key][$key2] = $value2;
									++$cntr;
								}
								
								$newDbArr[$key]['user_id'] = strtoupper($newDbArr[$key]['user_id']);
								
							}
						
					$dbArr = $newDbArr;
					break;
				case "roc":
					$fieldVal = "discipline_code = '{$_GET['discipline_code']}'";
					$this->read("ref_roctype", "get_all", $fieldVal, $dbArr);
					break;
				case "rocTbl":
					$fieldVal = "roc_type = '{$_GET['roc_type']}'";
					$this->read("ref_roc", "get_all", $fieldVal, $dbArr);
					break;
				case "work":
					$this->read("ref_workability", "get_all", $fieldVal, $dbArr);
					break;
				case "updWeek":
		            $dbArr = $this->ref_workability_model->call_sp($item);
					break;
				case "spool_no_only":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}'";
		            array_push($dbArr, array("spool_no"=>""));
		            foreach ($this->spool_model->get_all_spool($fieldVal) as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "area_query":
					//$isoWhere = "iso.stat = 'A' ";
					if ($_GET['area_no'] != "" && $_GET['area_no'] != "'<ALL>'")
						$isoWhere = "AND area_no in ({$_GET['area_no']})";
						//$isoWhere = "AND area_no = '{$_GET['area_no']}'";
					//$isoWhere = "spool.plant_no = '{$_POST['plant_no']}' AND spool.area_no = '{$_POST['area_no']}' AND spool.drawing_no = '{$_POST['drawing_no']}' AND spool.sheet_no = '{$_POST['sheet_no']}' AND spool.rev_no = '{$_POST['rev_no']}'";
					if ($_GET['rsOption'] > 0)
						$spoolWhere = "AND spool.workable_dt " . (($_GET['rsOption'] == 1) ? "!= NULL" : "= NULL");
					$fieldVal = "";
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal .= " AND " . $res[0] . $this->operatorArr[$res[2]] . $res[1] . (in_array($res[2], $this->blankThis) ? "" : "%") . "'";
						endforeach;
					//	echo $fieldVal;
					//echo $this->iso_model->area_query((isset($fieldVal) ? $fieldVal : ""),(isset($isoWhere) ? $isoWhere : ""),(isset($spoolWhere) ? $spoolWhere : ""));
					//return true;
		            foreach ($this->iso_model->area_query((isset($fieldVal) ? $fieldVal : ""),(isset($isoWhere) ? $isoWhere : ""),(isset($spoolWhere) ? $spoolWhere : "")) as $r):
							
						foreach ($r as $r2 => $v2):
							if (is_object($v2)){
								$date_array = (array) $v2;
								$date_time = $date_array['date'];
								$date_only = explode(" ", $date_time);
								$r[$r2] = $date_only[0];
							}
						endforeach;
						
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "export":
					if ($_GET['area_no'] != "" && $_GET['area_no'] != "'<ALL>'")
						$isoWhere = "AND area_no in ({$_GET['area_no']})";
					if ($_GET['rsOption'] > 0)
						$spoolWhere = "AND spool.workable_dt " . (($_GET['rsOption'] == 1) ? "!= NULL" : "= NULL");

					$fieldVal = "";
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal .= " AND " . $res[0] . $this->operatorArr[$res[2]] . $res[1] . (in_array($res[2], $this->blankThis) ? "" : "%") . "'";
						endforeach;
		            foreach ($this->iso_model->area_query_export((isset($fieldVal) ? $fieldVal : ""),(isset($isoWhere) ? $isoWhere : ""),(isset($spoolWhere) ? $spoolWhere : "")) as $r):
							
						foreach ($r as $r2 => $v2):
							if (is_object($v2)){
								$date_array = (array) $v2;
								$date_time = $date_array['date'];
								$date_only = explode(" ", $date_time);
								$r[$r2] = $date_only[0];
							}
						endforeach;
						
		                array_push($dbArr, $r);
						
		            endforeach;
				    // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "area_query.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="area_query.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "insTo":
					$this->read("inst_takeoff", "get_all", $fieldVal, $dbArr);
					break;
				case "isoTTiso":
					if ($_GET['rsOption'] == 0){
						$fieldVal = "t2.iso_workable_pct = 100 AND t2.fab_end_dt is not null";
						$this->load->model('webapps/qms/iso_model');
						$this->read("iso", "get_all_ttiso", $fieldVal, $dbArr);
					}else {
						$fieldVal ="t2.workable_pct = 100 AND t2.iso_workable_pct <> 100 AND t2.fab_end_dt is not null";
						$this->load->model('webapps/qms/iso_model');
						$this->read("iso", "get_all_ttiso", $fieldVal, $dbArr);
					}						
					break;
					
				case "p_iso_struc":
					if ($_GET['rsOption'] == 0)
						$fieldVal = "t2.workable_pct = 100 and t2.assembly_dt is null";	
					elseif($_GET['rsOption'] == 1)
						$fieldVal ="t.workable_pct = 100 and t2.assembly_dt is null and t2.workable_pct = 100";		
					else
						$fieldVal ="t.workable_pct <> 100 and t2.workable_pct = 100 and t2.assembly_dt is null";
					$this->load->model('webapps/qms/iso_struc_model');
					$this->read("iso_struc", "get_all_iso_struc", $fieldVal, $dbArr);	
					break;
				case "p_piece_struc":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and area_loc = '{$_GET['area_loc']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and workable_pct = 100 and issued_dt is not null";
					$this->load->model('webapps/qms/piece_struc_model');
					$this->read("piece_struc", "get_all", $fieldVal, $dbArr);
					
				break;
				case "p_iso_struc2":
					if ($_GET['rsOption'] == 0)
						$fieldVal = "t2.workable_pct = 100 and issued_dt is not null and t2.assembly_dt is null and erection_dt is null";	
					elseif($_GET['rsOption'] == 1)
						$fieldVal ="t.workable_pct = 100 and t2.workable_pct = 100 and issued_dt is not null and t2.assembly_dt is null and erection_dt is null";		
					else
						$fieldVal ="t.workable_pct <> 100 and t2.workable_pct = 100 and issued_dt is not null and t2.assembly_dt is null and erection_dt is null";
					$this->load->model('webapps/qms/iso_struc_model');
					$this->read("iso_struc", "get_all_iso_struc", $fieldVal, $dbArr);	
					break;
				case "p_piece_struc":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and area_loc = '{$_GET['area_loc']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and workable_pct = 100 and issued_dt is not null";
					$this->load->model('webapps/qms/piece_struc_model');
					$this->read("piece_struc", "get_all", $fieldVal, $dbArr);
					
				break;
				case "p_piece_struc2":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and area_loc = '{$_GET['area_loc']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and workable_pct = 100 and issued_dt is not null and assembly_dt is null and erection_dt is null";
					$this->load->model('webapps/qms/piece_struc_model');
					$this->read("piece_struc", "get_all", $fieldVal, $dbArr);
					
				break;
				case "export_p_iso_struc":
					if ($_GET['rsOption'] == 0)
						$fieldVal = "t2.workable_pct = 100 and t2.assembly_dt is null";	
					elseif($_GET['rsOption'] == 1)
						$fieldVal ="t.workable_pct = 100 and t2.assembly_dt is null and t2.workable_pct = 100";		
					else
						$fieldVal ="t.workable_pct <> 100 and t2.workable_pct = 100 and t2.assembly_dt is null";
					$this->read("iso_struc", "export_iso_piece_struc", $fieldVal, $dbArr,"export");	
					$this->load->model('webapps/qms/iso_struc_model');
					
					$csv = array_to_csv($dbArr, "WhseRecWorkFront_struct.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="WhseRecWorkFront_struct.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;			
					break;
				case "export_p_iso_struc2":
					if ($_GET['rsOption'] == 0)
						$fieldVal = "t2.workable_pct = 100 and issued_dt is not null and t2.assembly_dt is null and erection_dt is null";	
					elseif($_GET['rsOption'] == 1)
						$fieldVal ="t.workable_pct = 100 and t2.workable_pct = 100 and issued_dt is not null and t2.assembly_dt is null and erection_dt is null";		
					else
						$fieldVal ="t.workable_pct <> 100 and t2.workable_pct = 100 and issued_dt is not null and t2.assembly_dt is null and erection_dt is null";
					$this->read("iso_struc", "export_iso_piece_struc", $fieldVal, $dbArr,"export");	
					$this->load->model('webapps/qms/iso_struc_model');
					
					$csv = array_to_csv($dbArr, "FogWorkFront_Struc.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="FogWorkFront_Struc.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;			
					break;
				case "isoTTiso2":
					if ($_GET['rsOption'] == 0){
						$fieldVal = "t2.iso_workable_pct = 100 ";
						$this->load->model('webapps/qms/iso_model');
						$this->read("iso", "get_all_ttiso", $fieldVal, $dbArr);
					}else {
						$fieldVal ="t2.workable_pct = 100 AND t2.iso_workable_pct <> 100";
						$this->load->model('webapps/qms/iso_model');
						$this->read("iso", "get_all_ttiso", $fieldVal, $dbArr);
					}						
					break;
				case "piping_iso":
						$this->load->model('webapps/qms/iso_model');
						$this->read("iso", "get_all3", $fieldVal, $dbArr);
					break;
				
				case "spoolTTiso":
					$fieldVal = "area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and workable_pct = 100 and fab_end_dt is null and spool_no <> 'EM'";
					$this->load->model('webapps/qms/spool_model');
					$this->read("spool", "get_all", $fieldVal, $dbArr);
					break;
				case "export_insTo":
					$this->read("inst_takeoff", "get_all_export", $fieldVal, $dbArr,"export");
				    // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "insto.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="insto.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "export_isoPieceStruc":
					$this->load->model('webapps/qms/iso_struc_model');
					$this->read("iso_struc", "get_all_export2", $fieldVal, $dbArr,"export");
				    // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "Progress Update STR.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="Progress Update STR.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "export_twhse_matspl":
					$this->load->model('webapps/qms/twhse_mat_spl_model');
					$this->read("twhse_mat_spl", "get_all_export", $fieldVal, $dbArr);
				    // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "insto.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="insto.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "elecTo":
					$this->read("elec_takeoff", "get_all", $fieldVal, $dbArr);
					break;
				case "export_elecTo":
					$this->read("elec_takeoff", "get_all_export", $fieldVal, $dbArr);
				    // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "elecTo.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="elecTo.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "pc_ELECT-TYPE":
					$dbArr = $this->sys_prog_model->get_by_prog("ELECT-TYPE");
					break;
				case "dd_RETURN_TYPE":
					$this->load->model('webapps/qms/sys_prog_model');
				    
		            foreach ($this->sys_prog_model->get_by_prog("RETURN_TYPE") as $r):
		                array_push($dbArr, $r);
						array_push($dbArr, array("p_char1"=>$r['p_char2']));
						array_push($dbArr, array("p_char1"=>$r['p_char3']));
		            endforeach;
					break;
				case "defaultDisc":
					$this->load->model('webapps/qms/sys_prog_model');
					$dbArr = $this->sys_prog_model->get_by_DEFAULT_DISC("DEFAULT_DISC");
					break;
				case "testpack_dd":
		            array_push($dbArr, array("testpack_no"=>"<ALL>","sub_system"=>""));
		            foreach ($this->testpack_hdr_model->get_all_dd2() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "disc":
					$dbArr = $this->ref_discipline_model->get_all_dd();
					break;
				case "treqissDisc":
					$this->load->model('webapps/qms/treqiss_dtl_model');
					$dbArr = $this->treqiss_dtl_model->get_all_dd();
					break;
				case "rocDD":
					$dbArr = $this->ref_roctype_model->get_all_dd();
					break;
				case "isoMech":
					$this->read("iso_mech", "get_all", $fieldVal, $dbArr);
					break;
				case "equipMech":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}'";
					$this->read("equip_mech", "get_all", $fieldVal, $dbArr);
					break;
				case "export_equipMech":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}'";
					$this->read("equip_mech", "get_all_export", $fieldVal, $dbArr,"export");
				    // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "equipMech.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="equipMech.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "isoStruc":
					$this->read("iso_struc", "get_all", $fieldVal, $dbArr);
					break;
				
				case "pieceStruc":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and area_loc = '{$_GET['area_loc']}'";
					$this->read("piece_struc", "get_all", $fieldVal, $dbArr);
					break;
					
				case "export_pieceStruc":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and area_loc = '{$_GET['area_loc']}'";
					$this->read("piece_struc", "get_all_export", $fieldVal, $dbArr,"export");
				    // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "pieceStruc.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="pieceStruc.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "export_isoDwg":
					$area_loc = array(
									array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
								);
								
					$prior_setup = array("P1","TA-2013","P2","P3");
					$prior_setup2 = array("P1","TA","P2","P3");
					$this->load->model('webapps/qms/iso_model');
					$this->read("iso", "get_all_export", $fieldVal, $dbArr,"export");
					$resultPt = '';
					$priorResult= '';
					$newArr = array();
					$cntr = 0;
					
					//lans1
					
					foreach ($dbArr as $key => $value) {
						$cntr = 0;
						if ($key > 0){
							if ($value['plant_no'] == "" || !isset($value['plant_no']))
								continue;
						}
						foreach ($value as $key2 => $value2) { 
							if ($key > 0) {
								if($key2 == 'priority_timing'){
										if(array_search($value2, $prior_setup)== 1)
											$resultPt = 'TA';
										else{
											if(isset($value['priority_code'])){
												if($value['priority_code'] <> "")
													$resultPt = substr($value['priority_code'],0,2);
												else 
													$resultPt = "";
											}else {
												$resultPt = "";
											}
											
										}
								}elseif ($key2 == 'priority_code') 
									continue;
							}else {
								if ($key2 == 11)
									continue;
							}
							$newArr[$key][$key2] = $value2;		
							++$cntr;
							if ($cntr == (sizeof($value) - 1)){ //determine CSV column
								if ($key > 0){
									if (array_search($value2, $prior_setup)== 1) {
										if (array_search($value['area_loc']."_".substr($value['priority_code'],0,2),$area_loc[1]) <> 0) {
											$priorResult='';
										
										}else
											$priorResult='by-pass the category of Priority and Construction Unit';
										
									}else{
										if(isset($value['priority_code'])){
											if($value['priority_code'] <> "" && array_search(substr($value['priority_code'],0,2),$prior_setup2) <> 0 )	{
												if (array_search($value['area_loc']."_".substr($value['priority_code'],0,2),$area_loc[array_search(substr($value['priority_code'],0,2),$prior_setup2)]) <> 0) {
													$priorResult='';
												}else
													$priorResult='by-pass the category of Priority and Construction Unit';
											}else
												$priorResult='by-pass the category of Priority and Construction Unit';
										}else{
											$priorResult='by-pass the category of Priority and Construction Unit';
										}
										
									 }
									
									$newArr[$key]['priority'] = $resultPt;		
									$newArr[$key]['remarks'] = $priorResult;
								} else {									
									$newArr[$key][$cntr] = 'priority';		
									$newArr[$key][$cntr + 1] = 'remarks';								
								}			
							}	
						}
						
					}
					// var_dump($newArr);
					// return true;
					$dbArr = $newArr;
				    // ------ Create and download csv ----
					$csv = array_to_csv($newArr, "ISO.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="ISO.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "export_spl":
					$area_loc = array(
									array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
								);
								
					$prior_setup = array("P1","TA-2013","P2","P3");
					$prior_setup2 = array("P1","TA","P2","P3");
					$this->load->model('webapps/qms/spool_model');
					$this->read("spool", "get_all_export2", $fieldVal, $dbArr,"export");
					$resultPt = '';
					$priorResult= '';
					$newArr = array();
					$cntr = 0;
					
					//lans1
					
					foreach ($dbArr as $key => $value) {
						$cntr = 0;
						if ($key > 0){
							if ($value['priority_code'] == "" || !isset($value['priority_code']) || $value['priority_timing'] == "" || !isset($value['priority_timing']))
								continue;
						}
						foreach ($value as $key2 => $value2) { 
							if ($key > 0) {
								if($key2 == 'priority_timing'){
										if(array_search($value2, $prior_setup)== 1)
											$resultPt = 'TA';
										else{
											if(isset($value['priority_code'])){
												if($value['priority_code'] <> "")
													$resultPt = substr($value['priority_code'],0,2);
												else 
													$resultPt = "";
											}else {
												$resultPt = "";
											}
											
										}
								}elseif ($key2 == 'priority_code') 
									continue;
							}else {
								if ($key2 == 11)
									continue;
							}
							$newArr[$key][$key2] = $value2;		
							++$cntr;
							if ($cntr == (sizeof($value) - 1)){ //determine CSV column
								if ($key > 0){
									if (array_search($value2, $prior_setup)== 1) {
										if (array_search($value['area_loc']."_".substr($value['priority_code'],0,2),$area_loc[1]) <> 0) {
											$priorResult='';
										
										}else
											$priorResult='by-pass the category of Priority and Construction Unit';
										
									}else{
										if(isset($value['priority_code'])){
											if($value['priority_code'] <> "" && array_search(substr($value['priority_code'],0,2),$prior_setup2) <> 0 )	{
												if (array_search($value['area_loc']."_".substr($value['priority_code'],0,2),$area_loc[array_search(substr($value['priority_code'],0,2),$prior_setup2)]) <> 0) {
													$priorResult='';
												}else
													$priorResult='by-pass the category of Priority and Construction Unit';
											}else
												$priorResult='by-pass the category of Priority and Construction Unit';
										}else{
											$priorResult='by-pass the category of Priority and Construction Unit';
										}
										
									 }
									
									$newArr[$key]['priority_timing'] = $resultPt;		
									$newArr[$key]['remarks'] = $priorResult;
								} else {									
									$newArr[$key][10] = 'priority_code';		
									$newArr[$key][$cntr + 1] = 'remarks';								
								}			
							}	
						}
						
					}
					 $dbArr = $newArr;
					// ------ Create and download csv ----
					$csv = array_to_csv($newArr, "spool.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="spool.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
					case "export_qmsqwpisow":
					$area_loc = array(
									 array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									 array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									 array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							    );
				    $prior_setup = array("P1","TA-2013","P2","P3");
				    $prior_setup2 = array("P1","TA","P2","P3");
				   	$areaArr = array();
					if(in_array($_GET['pno'], $prior_setup) >= 0 ){				   	 
						if(array_search($_GET['pno'], $prior_setup) == 1){
							foreach ($area_loc[1] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							}						
						} else {
							foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							} 
						}
					}
				$cArealoc = "'". str_replace("','", "*!*", str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr)))))."'";
			    $aname = "'".$_GET['aname']."'";
			    $pno = "'".$_GET['pno']."'";
			    
			    $this->load->model('webapps/qms/ttupl_model');
				$this->ttupl_model->export_sp_query_spl_wise((int)$_GET['tbAdvance'],(int)$_GET['rswork'],(int)$_GET['cbper1'],(int) $_GET['cbper2'],$aname,$cArealoc,$pno);
		        $this->read("ttupl", "export_ttupl", $fieldVal, $dbArr);
				break;
					case "export_twhse_mat_ps2":
					$area_loc = array(
									array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
								);
								
					$prior_setup = array("P1","TA-2013","P2","P3");
					$prior_setup2 = array("P1","TA","P2","P3");
					$this->load->model('webapps/qms/twhse_mat_ps_model');
					$this->read("twhse_mat_ps", "get_all_export2", $fieldVal, $dbArr);
					$resultPt = '';
					$priorResult= '';
					$newArr = array();
					$cntr = 0;
					
					//lans1
					
					foreach ($dbArr as $key => $value) {
						$cntr = 0;
						foreach ($value as $key2 => $value2) {
							
							if($key2 == 'priority'){
									if(array_search($value2, $prior_setup)== 1)
										$resultPt = 'TA';
									else{
										if($value['priority'] <> "")
												$resultPt = $value['priority'];
											else 
												$resultPt = "";
									}
							}elseif ($key2 == 'priority') 
								continue;
							$newArr[$key][$key2] = $value2;		
							++$cntr;
							if ($cntr == (sizeof($value) - 1)){ //determine CSV column
								if (array_search($value2, $prior_setup)== 1) {
									if (array_search($value['area_loc']."_".substr($value['priority'],0,2),$area_loc[1]) <> 0) {
										$priorResult='';
									
									}else
										$priorResult='by-pass the category of Priority and Construction Unit';
									
								}else{
									if($value['priority'] <> "" && array_search(substr($value['priority'],0,2),$prior_setup2) <> 0 )	{
										if (array_search($value['area_loc']."_".substr($value['priority'],0,2),$area_loc[array_search(substr($value['priority'],0,2),$prior_setup2)]) <> 0) {
											$priorResult='';
										}else
											$priorResult='by-pass the category of Priority and Construction Unit';
									}else
										$priorResult='by-pass the category of Priority and Construction Unit';
								 }
								
								$newArr[$key]['priority'] = $resultPt;		
								$newArr[$key]['remarks'] = $priorResult;
							}					
						}
						
					}
				    // ------ Create and download csv ----
					$csv = array_to_csv($newArr, "Pip_Query_PSwise.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="Pip_Query_PSwise.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "export_joints":
					$area_loc = array(
									array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
								);
								
					$prior_setup = array("P1","TA-2013","P2","P3");
					$prior_setup2 = array("P1","TA","P2","P3");
					$this->load->model('webapps/qms/joints_model');
					$this->read("joints", "get_all_export2", $fieldVal, $dbArr,"export");
					$resultPt = '';
					$priorResult= '';
					$newArr = array();
					$cntr = 0;
					
					//lans1
					
					foreach ($dbArr as $key => $value) {
						$cntr = 0;
						if ($key > 0){
							if ($value['priority_code'] == "" || !isset($value['priority_code']) || $value['priority_timing'] == "" || !isset($value['priority_timing']))
								continue;
						}
						foreach ($value as $key2 => $value2) { 
							if ($key > 0) {
								if($key2 == 'priority_timing'){
										if(array_search($value2, $prior_setup)== 1)
											$resultPt = 'TA';
										else{
											if(isset($value['priority_code'])){
												if($value['priority_code'] <> "")
													$resultPt = substr($value['priority_code'],0,2);
												else 
													$resultPt = "";
											}else {
												$resultPt = "";
											}
											
										}
								}elseif ($key2 == 'area_loc') 
									continue;
								 
							}else {
								if ($key2 == 11)
									continue;
							}
							$newArr[$key][$key2] = $value2;		
							++$cntr;
							if ($cntr == (sizeof($value) - 1)){ //determine CSV column
								if ($key > 0){
									if (array_search($value2, $prior_setup)== 1) {
										if (array_search($value['area_loc']."_".substr($value['priority_code'],0,2),$area_loc[1]) <> 0) {
											$priorResult='';
										
										}else
											$priorResult='by-pass the category of Priority and Construction Unit';
										
									}else{
										if(isset($value['priority_code'])){
											if($value['priority_code'] <> "" && array_search(substr($value['priority_code'],0,2),$prior_setup2) <> 0 )	{
												if (array_search($value['area_loc']."_".substr($value['priority_code'],0,2),$area_loc[array_search(substr($value['priority_code'],0,2),$prior_setup2)]) <> 0) {
													$priorResult='';
												}else
													$priorResult='by-pass the category of Priority and Construction Unit';
											}else
												$priorResult='by-pass the category of Priority and Construction Unit';
										}else{
											$priorResult='by-pass the category of Priority and Construction Unit';
										}
										
									 }
									
									$newArr[$key]['priority_code'] = $resultPt;		
									$newArr[$key]['priority_timing'] = $priorResult;
								
								} else {
									$newArr[$key][13] = 'remarks';	
									$newArr[$key][12] = 'priority_code';
									
								}			
							}	
						}
						
					}
					$dbArr = $newArr;
					
				    // ------ Create and download csv ----
					$csv = array_to_csv($newArr, "joints.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="joints.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "export_twhse_mat_iso":
					$area_loc = array(
									array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
								);
								
					$prior_setup = array("P1","TA-2013","P2","P3");
					$prior_setup2 = array("P1","TA","P2","P3");
					$this->load->model('webapps/qms/twhse_mat_iso_model');
					$this->read("twhse_mat_iso", "get_all_export", $fieldVal, $dbArr);
					$resultPt = '';
					$priorResult= '';
					$newArr = array();
					$cntr = 0;
					
					//lans1
					
					foreach ($dbArr as $key => $value) {
						$cntr = 0;
						foreach ($value as $key2 => $value2) {
							
							if($key2 == 'priority'){
									if(array_search($value2, $prior_setup)== 1)
										$resultPt = 'TA';
									else{
										if($value['priority'] <> "")
												$resultPt = $value['priority'];
											else 
												$resultPt = "";
									}
							}elseif ($key2 == 'priority') 
								continue;
							$newArr[$key][$key2] = $value2;		
							++$cntr;
							if ($cntr == (sizeof($value) - 1)){ //determine CSV column
								if (array_search($value2, $prior_setup)== 1) {
									if (array_search($value['area_loc']."_".substr($value['priority'],0,2),$area_loc[1]) <> 0) {
										$priorResult='';
									
									}else
										$priorResult='by-pass the category of Priority and Construction Unit';
									
								}else{
									if($value['priority'] <> "" && array_search(substr($value['priority'],0,2),$prior_setup2) <> 0 )	{
										if (array_search($value['area_loc']."_".substr($value['priority'],0,2),$area_loc[array_search(substr($value['priority'],0,2),$prior_setup2)]) <> 0) {
											$priorResult='';
										}else
											$priorResult='by-pass the category of Priority and Construction Unit';
									}else
										$priorResult='by-pass the category of Priority and Construction Unit';
								 }
								
								$newArr[$key]['priority'] = $resultPt;		
								$newArr[$key]['remarks'] = $priorResult;
							}					
						}
						
					}
				    // ------ Create and download csv ----
					$csv = array_to_csv($newArr, "Pip_Query_ISOwise.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="Pip_Query_ISOwise.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "export_mat_takeoff_perspool":
					$area_loc = array(
									array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
								);
								
					$prior_setup = array("P1","TA-2013","P2","P3");
					$prior_setup2 = array("P1","TA","P2","P3");
					$this->load->model('webapps/qms/mat_takeoff_perspool_model');
					$this->read("mat_takeoff_perspool", "get_all_export2", $fieldVal, $dbArr,"export");
					$resultPt = '';
					$priorResult= '';
					$newArr = array();
					$cntr = 0;
					
					foreach ($dbArr as $key => $value) {
						$cntr = 0;
						if ($key > 0){
							if ($value['priority_code'] == "" || !isset($value['priority_code']) || $value['priority_timing'] == "" || !isset($value['priority_timing']))
								continue;
						}
						foreach ($value as $key2 => $value2) { 
							if ($key > 0) {
								if($key2 == 'priority_timing'){
										if(array_search($value2, $prior_setup)== 1)
											$resultPt = 'TA';
										else{
											if(isset($value['priority_code'])){
												if($value['priority_code'] <> "")
													$resultPt = substr($value['priority_code'],0,2);
												else 
													$resultPt = "";
											}else {
												$resultPt = "";
											}
											
										}
								}elseif ($key2 == 'priority_code') 
									continue;
							}else {
								if ($key2 == 13)
									continue;
							}
							$newArr[$key][$key2] = $value2;		
							++$cntr;
							if ($cntr == (sizeof($value) - 1)){ //determine CSV column
								if ($key > 0){
									if (array_search($value2, $prior_setup)== 1) {
										if (array_search($value['area_loc']."_".substr($value['priority_code'],0,2),$area_loc[1]) <> 0) {
											$priorResult='';
										
										}else
											$priorResult='by-pass the category of Priority and Construction Unit';
										
									}else{
										if(isset($value['priority_code'])){
											if($value['priority_code'] <> "" && array_search(substr($value['priority_code'],0,2),$prior_setup2) <> 0 )	{
												if (array_search($value['area_loc']."_".substr($value['priority_code'],0,2),$area_loc[array_search(substr($value['priority_code'],0,2),$prior_setup2)]) <> 0) {
													$priorResult='';
												}else
													$priorResult='by-pass the category of Priority and Construction Unit';
											}else
												$priorResult='by-pass the category of Priority and Construction Unit';
										}else{
											$priorResult='by-pass the category of Priority and Construction Unit';
										}
										
									 }
									
									$newArr[$key]['priority_timing'] = $resultPt;		
									$newArr[$key]['remarks'] = $priorResult;
								} else {									
									$newArr[$key][14] = 'area_loc';	
									$newArr[$key][15] = 'priority_timing';	
									$newArr[$key][$cntr + 1] = 'remarks';								
								}			
							}	
						}
						
					}
					 $dbArr = $newArr;
				    // ------ Create and download csv ----
					$csv = array_to_csv($newArr, "matTakeoffPerSpool.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="matTakeoffPerSpool.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "export_mat_takeoff_perspool2":
					$area_loc = array(
									array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
								);
								
					$prior_setup = array("P1","TA-2013","P2","P3");
					$prior_setup2 = array("P1","TA","P2","P3");
					$this->load->model('webapps/qms/mat_takeoff_perspool_model');
					$this->read("mat_takeoff_perspool", "get_allexport3", $fieldVal, $dbArr,"export");
					$resultPt = '';
					$priorResult= '';
					$newArr = array();
					$cntr = 0;
					
					foreach ($dbArr as $key => $value) {
						$cntr = 0;
						if ($key > 0){
							if ($value['priority_code'] == "" || !isset($value['priority_code']) || $value['priority_timing'] == "" || !isset($value['priority_timing']))
								continue;
						}
						foreach ($value as $key2 => $value2) { 
							if ($key > 0) {
								if($key2 == 'priority_timing'){
										if(array_search($value2, $prior_setup)== 1)
											$resultPt = 'TA';
										else{
											if(isset($value['priority_code'])){
												if($value['priority_code'] <> "")
													$resultPt = substr($value['priority_code'],0,2);
												else 
													$resultPt = "";
											}else {
												$resultPt = "";
											}
											
										}
								}elseif ($key2 == 'priority_code') 
									continue;
							}else {
								if ($key2 == 13)
									continue;
							}
							$newArr[$key][$key2] = $value2;		
							++$cntr;
							if ($cntr == (sizeof($value) - 1)){ //determine CSV column
								if ($key > 0){
									if (array_search($value2, $prior_setup)== 1) {
										if (array_search($value['area_loc']."_".substr($value['priority_code'],0,2),$area_loc[1]) <> 0) {
											$priorResult='';
										
										}else
											$priorResult='by-pass the category of Priority and Construction Unit';
										
									}else{
										if(isset($value['priority_code'])){
											if($value['priority_code'] <> "" && array_search(substr($value['priority_code'],0,2),$prior_setup2) <> 0 )	{
												if (array_search($value['area_loc']."_".substr($value['priority_code'],0,2),$area_loc[array_search(substr($value['priority_code'],0,2),$prior_setup2)]) <> 0) {
													$priorResult='';
												}else
													$priorResult='by-pass the category of Priority and Construction Unit';
											}else
												$priorResult='by-pass the category of Priority and Construction Unit';
										}else{
											$priorResult='by-pass the category of Priority and Construction Unit';
										}
										
									 }
									
									$newArr[$key]['priority_timing'] = $resultPt;		
									$newArr[$key]['remarks'] = $priorResult;
								} else {									
									$newArr[$key][14] = 'area_loc';	
									$newArr[$key][15] = 'priority_timing';	
									$newArr[$key][$cntr + 1] = 'remarks';								
								}			
							}	
						}
						
					}
					 $dbArr = $newArr;
				    // ------ Create and download csv ----
					$csv = array_to_csv($newArr, "matTakeoffPerSpool.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="matTakeoffPerSpool.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "export_ps_mto_hdr":
					$area_loc = array(
									array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
								);
								
					$prior_setup = array("P1","TA-2013","P2","P3");
					$prior_setup2 = array("P1","TA","P2","P3");
					$this->load->model('webapps/qms/ps_mto_hdr_model');
					$this->read("ps_mto_hdr", "get_all_export2", $fieldVal, $dbArr,"export");
					$resultPt = '';
					$priorResult= '';
					$newArr = array();
					$cntr = 0;
					
					//lans1
					
					foreach ($dbArr as $key => $value) {
						$cntr = 0;
						if ($key > 0){
							if ($value['p_no'] == "" || !isset($value['p_no']) || $value['p_timing'] == "" || !isset($value['p_timing']))
								continue;
						}
						foreach ($value as $key2 => $value2) { 
							if ($key > 0) {
								if($key2 == 'p_timing'){
										if(array_search($value2, $prior_setup)== 1)
											$resultPt = 'TA';
										else{
											if(isset($value['p_no'])){
												if($value['p_no'] <> "")
													$resultPt = substr($value['p_no'],0,2);
												else 
													$resultPt = "";
											}else {
												$resultPt = "";
											}
											
										}
								}elseif ($key2 == 'p_no') 
									continue;
							}else {
								if ($key2 == 11)
									continue;
							}
							$newArr[$key][$key2] = $value2;		
							++$cntr;
							if ($cntr == (sizeof($value) - 1)){ //determine CSV column
								if ($key > 0){
									if (array_search($value2, $prior_setup)== 1) {
										if (array_search($value['area_desc']."_".substr($value['p_no'],0,2),$area_loc[1]) <> 0) {
											$priorResult='';
										
										}else
											$priorResult='by-pass the category of Priority and Construction Unit';
										
									}else{
										if(isset($value['p_no'])){
											if($value['p_no'] <> "" && array_search(substr($value['p_no'],0,2),$prior_setup2) <> 0 )	{
												if (array_search($value['area_desc']."_".substr($value['p_no'],0,2),$area_loc[array_search(substr($value['p_no'],0,2),$prior_setup2)]) <> 0) {
													$priorResult='';
												}else
													$priorResult='by-pass the category of Priority and Construction Unit';
											}else
												$priorResult='by-pass the category of Priority and Construction Unit';
										}else{
											$priorResult='by-pass the category of Priority and Construction Unit';
										}
										
									 }
									
									$newArr[$key]['p_timing'] = $resultPt;		
									$newArr[$key]['remarks'] = $priorResult;
								} else {									
									$newArr[$key][10] = 'p_no';		
									$newArr[$key][$cntr + 1] = 'remarks';								
								}			
							}	
						}
						
					}
					 $dbArr = $newArr;
				    // ------ Create and download csv ----
					$csv = array_to_csv($newArr, "Pipe_Support.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="Pipe_Support.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
					
					case "export_twhse_mat_spl2":
					$area_loc = array(
									array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
								);
								
					$prior_setup = array("P1","TA-2013","P2","P3");
					$prior_setup2 = array("P1","TA","P2","P3");
					$this->load->model('webapps/qms/twhse_mat_spl_model');
					$this->read("twhse_mat_spl", "get_all_export2", $fieldVal, $dbArr,"export");
					$resultPt = '';
					$priorResult= '';
					$newArr = array();
					$cntr = 0;
					
					//lans1
					
					foreach ($dbArr as $key => $value) {
						$cntr = 0;
						if ($key > 0){
							if ($value['plant_no'] == "" || !isset($value['plant_no']))
								continue;
						}
						foreach ($value as $key2 => $value2) { 
							if ($key > 0) {
								if($key2 == 'priority_timing'){
										if(array_search($value2, $prior_setup)== 1)
											$resultPt = 'TA';
										else{
											if(isset($value['priority_code'])){
												if($value['priority_code'] <> "")
													$resultPt = substr($value['priority_code'],0,2);
												else 
													$resultPt = "";
											}else {
												$resultPt = "";
											}
											
										}
								}elseif ($key2 == 'priority_code') 
									continue;
							}else {
								if ($key2 == 11)
									continue;
							}
							$newArr[$key][$key2] = $value2;		
							++$cntr;
							if ($cntr == (sizeof($value) - 1)){ //determine CSV column
								if ($key > 0){
									if (array_search($value2, $prior_setup)== 1) {
										if (array_search($value['area_loc']."_".substr($value['priority_code'],0,2),$area_loc[1]) <> 0) {
											$priorResult='';
										
										}else
											$priorResult='by-pass the category of Priority and Construction Unit';
										
									}else{
										if(isset($value['priority_code'])){
											if($value['priority_code'] <> "" && array_search(substr($value['priority_code'],0,2),$prior_setup2) <> 0 )	{
												if (array_search($value['area_loc']."_".substr($value['priority_code'],0,2),$area_loc[array_search(substr($value['priority_code'],0,2),$prior_setup2)]) <> 0) {
													$priorResult='';
												}else
													$priorResult='by-pass the category of Priority and Construction Unit';
											}else
												$priorResult='by-pass the category of Priority and Construction Unit';
										}else{
											$priorResult='by-pass the category of Priority and Construction Unit';
										}
										
									 }
									
									$newArr[$key]['priority'] = $resultPt;		
									$newArr[$key]['remarks'] = $priorResult;
								} else {									
									$newArr[$key][$cntr] = 'priority';		
									$newArr[$key][$cntr + 1] = 'remarks';								
								}			
							}	
						}
						
					}
					$dbArr = $newArr;
				    // ------ Create and download csv ----
					$csv = array_to_csv($newArr, "Whse_Query_SplWise.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="Whse_Query_SplWise.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "export_qmsqpwsplw":
					 $area_loc = array(
									 array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									 array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									 array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							    );
				    $prior_setup = array("P1","TA-2013","P2","P3");
				    $prior_setup2 = array("P1","TA","P2","P3");
				   	$areaArr = array();
					if(in_array($_GET['pno'], $prior_setup) >= 0 ){				   	 
						if(array_search($_GET['pno'], $prior_setup) == 1){
							foreach ($area_loc[1] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							}						
						} else {
							foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							} 
						}
					}
				$cArealoc = "'". str_replace("','", "*!*", str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr)))))."'";
			    $aname = "'".$_GET['aname']."'";
			    $pno = "'".$_GET['pno']."'";
			    $this->load->model('webapps/qms/ttupl_model');
				$this->ttupl_model->export_sp_query_spl_wise((int)$_GET['tbAdvance'],(int)$_GET['rswork'],(int)$_GET['cbper1'],(int) $_GET['cbper2'],$aname,$cArealoc,$pno,(int)$_GET['detail']);		        if($_GET['detail'] == 0)
					$this->read("ttupl", "export_splwise_wOdetail", $fieldVal, $dbArr,"export");
				else
					$this->read("ttupl", "export_splwise_wDetail", $fieldVal, $dbArr,"export");
				 // ------ Create and download csv ----
				$csv = array_to_csv($dbArr, "MATL Workability SPL Wise.csv");
			    header('Content-Type: application/csv');
				header('Content-Disposition: attachment; filename="MATL Workability SPL Wise.csv"');
				$csv = urldecode($csv);
	           
	            echo $csv;
				return true;
				break;
				case "psTo":
					$this->read("ps_mto", "get_all", $fieldVal, $dbArr);
					break;
				case "export_psTo":
					$this->load->model('webapps/qms/ps_mto_model');
					$this->read("ps_mto", "all_export", $fieldVal, $dbArr,"export");
					
					 // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "pipTo.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="pipTo.csv"');
					$csv = urldecode($csv);
		            echo $csv;
					return true;
					break;
				case "export_pipTo":
					$this->read("ps_mto", "get_all_export", $fieldVal, $dbArr);
				    // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "pipTo.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="pipTo.csv"');
					$csv = urldecode($csv);
		            echo $csv;
					return true;
					break;
				case "export_matExcess":
					$this->load->model('webapps/qms/mat_excess_model');
					$this->read("mat_excess", "get_all_export", $fieldVal, $dbArr,"export");
					
				    // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "MatExcess.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="MatExcess.csv"');
					$csv = urldecode($csv);
		            echo $csv;
					return true;
					break;
				case "export_treqissDtl_stock":
					$this->treqiss_dtl_model->export_with_inner((int) $_GET['rsOption'],(int)$_GET['disc_code']);
					$this->read("treqiss_dtl", "export_procJwrr", $fieldVal, $dbArr,"export");
					foreach ($dbArr as $key => $value) {
						$cntr = 0;
						
						foreach ($value as $key2 => $value2) { 
							if ($key2 == 40)
									continue;
							}
							$newArr[$key][$key2] = $value2;		
							++$cntr;
						}
						
					
				    // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "jmif.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="jmif.csv"');
					$csv = urldecode($csv);
		            echo $csv;
					return true;
					break;
				case "verifyHydro":
					echo (intval($this->testpack_hdr_model->verify_hydro()) == 1) ? "true" : "false";
					return true;
					break;
				case "callSP":
		            $dbArr = $this->pip_mto_data_model->call_sp();
					break;
				case "callSP_weld":
		            $dbArr = $this->pip_weld_data_model->call_sp();
					break;
				case "callSP_str":
		            $dbArr = $this->str_pm_data_model->call_sp();
					break;
				case "callSP_ps":
		            $dbArr = $this->ps_mto_model->call_sp();
					break;
				case "psMto":
				case "psFogMto":
				case "psPcdMto":
				case "psGlobalMto":
				case "psFabMto":
		            $data = $_GET['rows'];
		            $json = str_replace('\\','',$data);
		            $newdata = json_decode($json);
					
					$sql = "";
					foreach ($newdata->rows as $key => $value) {
						$sql .= "insert into ##ttfile(";
						for ($i=0; $i < 2; $i++) { //1: for table field, 2: for table value
							if ($i == 1)
								$sql .= ") values(";
							$keyCounter = 0;
							foreach ($value as $key2 => $value2) {
								$sql .= ($i == 0) ? $key2 : ("'" . $value2 . "'");
								if ($keyCounter < (sizeof((array) $value) - 1))
									$sql .= ", ";
								$keyCounter++;
							}
						}
						$sql .= ");";
					}
					// echo $sql;
					// return true;
					$dbArr = $this->ps_mto_model->call_sp($sql,$item);
					break;
				case "verifyPipe":
					echo (intval($this->ps_mto_model->verify_pipe()) == 1) ? "true" : "false";
					return true;
					break;
				case "update":
					switch ($param) {
						case 'mto2':
							if ($this->ttConstn_model->get_count() == 0 || $this->ttTestpack_model->get_count() == 0)
								$dbArr = array("return_value" => "2");
							break;
						case 'weld1':
						case 'weld2':
						case 'ps1':
						case 'wends':
						case 'whseSpl':
						case 'fabSpl':
						case 'pmWm':
							if ($this->ttConstn_model->get_count() == 0)
								$dbArr = array("return_value" => "2");
							break;
						default:
							break;
					}		
					if (sizeOf($dbArr) == 0){
						switch ($param) {
							case 'whseMtoJmif': case 'whseSplMtoJmif':
		            			$dbArr = $this->mat_takeoff_perspool_model->call_sp($param);
								break;
							case 'strlMto':
		            			$dbArr = $this->piece_struc_model->call_sp($param);
								break;
							case 'mtoWeld':
		            			$dbArr = $this->pip_mto_data_model->call_sp($param);
								break;
							default:
		            			$dbArr = $this->pip_mto_data_model->call_sp($param);
								break;
						}
					}
					
					break;
				case "export_ttspl":
					$csv = query_to_csv($this->tt_ttspl_model->get_all_query(), true, "invalid_engg_spl_asof_" + mdate("%Y-%m-%d") + ".csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="invalid_engg_spl_asof_' . mdate("%Y-%m-%d") . '.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "tpo":
					$this->read("tpo_hdr", "get_all", $fieldVal, $dbArr);
					break;
				case "tpoDtl":
					$fieldVal = "po_no = '{$_GET['po_no']}'";
					$this->read("tpo_dtl", "get_all", $fieldVal, $dbArr);
					break;
				case "rcontrol":
					$dbArr = $this->rcontrol_model->get_by_field(array("trancode"=>$_GET['trancode'], "disc_code"=>(isset($_GET['disc_code']) ? $_GET['disc_code'] : "")));
					break;
				case "verifyUSER":
					$dbArr = $this->ruser_model->verifyUser(array("user_id"=>$_GET['user_id'] ));
					break;
				case "supplier":
					$this->read("rsupplier", "get_for_dd", $fieldVal, $dbArr);
					break;
				case "supplierRef":
					$this->read("rsupplier", "get_all", $fieldVal, $dbArr);
					break;
				case "tdlmr":					
					$this->read("tdlmr_hdr", "get_all", $fieldVal, $dbArr);
					break;
				case "tdlmrDtl":
					$fieldVal = "dlmr_no = '{$_GET['dlmr_no']}'";
					$this->read("tdlmr_dtl", "get_all", $fieldVal, $dbArr);
					break;
				case "tjwrr":
					$fieldVal = "disc_code = '{$_GET['disc_code']}'";
					$this->read("tjwrr_hdr", "get_all", $fieldVal, $dbArr);
					break;
				case "tjwrrDtl":
					$fieldVal = "jwrr_no = '{$_GET['jwrr_no']}'";
					$this->read("tjwrr_dtl", "get_all", $fieldVal, $dbArr);
					break;
				case "tjwrrDtl_stock":
					$fieldVal = "stock_no = '{$_GET['stock_no']}'";
					$this->read("tjwrr_dtl", "get_all", $fieldVal, $dbArr);
					break;
				case "treqissDtl_stock":
					$fieldVal = "stock_no = '{$_GET['stock_no']}'";
					$this->read("treqiss_dtl", "get_all", $fieldVal, $dbArr);
					break;
				case "treqissDtl_stock2":
					if($_GET['chkOption'] == 0){
						if($_GET['rsOption'] == 2){
							$fieldVal = "t.disc_code = '{$_GET['disc_code']}' AND t2.sub_date_client IS NOT NULL";
							$this->read("treqiss_dtl", "get_all_with_inner", $fieldVal, $dbArr);
						}elseif($_GET['rsOption'] == 1){
							$fieldVal = "t.disc_code = '{$_GET['disc_code']}' AND t2.sub_date_fog IS NOT NULL";
							$this->read("treqiss_dtl", "get_all_with_inner", $fieldVal, $dbArr);
						}else{
							$fieldVal = "t.disc_code = '{$_GET['disc_code']}'";
							$this->read("treqiss_dtl", "get_all_with_inner", $fieldVal, $dbArr);
						}	
					}else{
						if($_GET['rsOption'] == 2){
							$fieldVal = "t.disc_code = '{$_GET['disc_code']}' AND t2.sub_date_client IS NOT NULL AND t.iss_qty <> t.req_qty";
							$this->read("treqiss_dtl", "get_all_with_inner", $fieldVal, $dbArr);
						}elseif($_GET['rsOption'] == 1){
							$fieldVal = "t.disc_code = '{$_GET['disc_code']}' AND t2.sub_date_fog IS NOT NULL AND t.iss_qty <> t.req_qty";
							$this->read("treqiss_dtl", "get_all_with_inner", $fieldVal, $dbArr);
						}else{
							$fieldVal = "t.disc_code = '{$_GET['disc_code']} AND t.iss_qty <> t.req_qty'";
							$this->read("treqiss_dtl", "get_all_with_inner", $fieldVal, $dbArr);
						}	
					}
					break;				
				case "treqissDisc":
					$fieldVal = "disc_code = '{$_GET['desc_code']}'";
					$this->read("treqiss_dtl", "get_dd", $fieldVal, $dbArr);
					break;
				case "treqissDtl_stock3":
					$fieldVal = "disc_code = '{$_GET['disc_code']}' and drawing_no = '{$_GET['drawing_no']}' and spool_no = '{$_GET['spool_no']}' and stock_no = '{$_GET['stock_no']}' and item_code = '{$_GET['item_code']}' and commodity_code = '{$_GET['commodity_code']}' and size = '{$_GET['size']}' ";
					// echo $fieldVal ;
					// return true;
					$this->read("treqiss_dtl", "get_all_mod3", $fieldVal, $dbArr);
					break;	
				case "treqissDtl_stock4":
					$fieldVal = "disc_code = '{$_GET['disc_code']}' and drawing_no = '{$_GET['drawing_no']}' and stock_no = '{$_GET['stock_no']}' and item_code = '{$_GET['item_code']}' and commodity_code = '{$_GET['commodity_code']}'";
					// echo $fieldVal ;
					// return true;
					$this->read("treqiss_dtl", "get_all_mod3", $fieldVal, $dbArr);
					break;	
				case "tjwrr_upd":					
					$fieldVal = "disc_code = '{$_GET['disc_code']}' AND (finalized = {$_GET['finalized']}" . ($_GET['finalized'] == 0 ? " OR finalized is null" : "") . ")";					
					$this->read("tjwrr_hdr", "get_all", $fieldVal, $dbArr);
					break;
				case "tjmif":
					$fieldVal = "disc_code = '{$_GET['disc_code']}'";
					$this->read("tttemps", "get_all", $fieldVal, $dbArr);
		            // $dbArr = $this->tttemps_model->call_sp();
					break;
				case "issconf":
					$this->read("Ttemp_conf", "get_all", $fieldVal, $dbArr);
					break;
				case "export_jwrr":
		            /*foreach ($this->ogmr_model->getAll_export() as $r):
						$r['exists'] = ($r['file_attach'] != "" && file_exists("c:/wamp/www/assets/pdf/documents/" . $r['file_attach']) ? "&#10003" : "");
		                array_push($dbArr, $r);
		            endforeach;*/
				    //------ Create and download csv ----
				    foreach ($this->tjwrr_dtl_model->getAll_export() as $r):							
						foreach ($r as $r2 => $v2):
							if (is_object($v2)){
								$date_array = (array) $v2;
								$date_time = $date_array['date'];
								$date_only = explode(" ", $date_time);
								$r[$r2] = $date_only[0];
							}
						endforeach;
		                array_push($dbArr, $r);
		            endforeach;
				    // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "jwrr_hdr_dtl.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="jwrr_hdr_dtl.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "ttMTO":
					$fieldVal = "loguser = '{$_GET['loguser']}' AND disc_code = '{$_GET['disc_code']}'";
					$this->read("ttmto", "get_all", $fieldVal, $dbArr);
					break;
				case "ttMTO1":
					$fieldVal = "loguser = '{$_GET['loguser']}' AND disc_code = '{$_GET['disc_code']}'";
					$this->read("ttmto1", "get_all", $fieldVal, $dbArr);
					break;
				case "treq":
					$fieldVal = "disc_code = '{$_GET['disc_code']}' and whse_prep = {$_GET['whse_prep']}";
					$this->read("treqiss_hdr", "get_all", $fieldVal, $dbArr);
					break;
				case "treqDtl":
					$fieldVal = "jmif_no = '{$_GET['jmif_no']}'"; // AND disc_code = '{$_GET['disc_code']}'";
					$this->read("treqiss_dtl", "get_all", $fieldVal, $dbArr);
					break;
				case "callSP_treq":
		            $dbArr = $this->treqiss_hdr_model->call_sp();
					if ($dbArr == 1)
						$this->remove_upload();
					return true;
					break;
				case "callSP_prio":
		            $dbArr = $this->iso_model->call_sp();
					if ($dbArr == 1)
						$this->remove_upload();
					return true;
					break;
				case "callSP_upl_isoPiece":
					$this->load->model('webapps/qms/iso_struc_model');
		            $dbArr = $this->iso_struc_model->call_sp_isoPiece($_POST['fileNames']);
					if ($dbArr == 1)
						$this->remove_upload();
					return true;
					break;
				case "callSP_upl_inst":
					$this->load->model('webapps/qms/inst_takeoff_model');
		            $dbArr = $this->inst_takeoff_model->call_upl_inst($_POST['fileNames']);
					if ($dbArr == 1)
						$this->remove_upload();
					return true;
					break;
				case "callSP_upl_ele":
					$this->load->model('webapps/qms/inst_takeoff_model');
		            $dbArr = $this->inst_takeoff_model->call_upl_inst($_POST['fileNames']);
					if ($dbArr == 1)
						$this->remove_upload();
					return true;
					break;
				case "call_upl_isoEquip":
					$this->load->model('webapps/qms/iso_mech_model');
		            $dbArr = $this->iso_mech_model->call_sp_isoEquip($_POST['fileNames']);
					if ($dbArr == 1)
						$this->remove_upload();
					return true;
					break;
				case "callSP_upl_pntg":
					$this->load->model('webapps/qms/tpntg_mat_spl_model');
		            $dbArr = $this->tpntg_mat_spl_model->call_upl_tpntg();
					if ($dbArr == 1)
						$this->remove_upload();
					return true;
					break;
				case "callSP_upl_tfab":
					$this->load->model('webapps/qms/tfab_mat_spl_model');
		            $dbArr = $this->tfab_mat_spl_model->call_upl_tfab();
					if ($dbArr == 1)
						$this->remove_upload();
					return true;
					break;
				case "callSP_upl_req":
		            $dbArr = $this->ttiso_model->call_sp_upl();
					// if ($dbArr == 1)
						// $this->remove_upload();
					return true;
					break;
				case "whseGW":
					$this->read("material_file", "gen_work", $fieldVal, $dbArr);
					break;
				case "whseGW_dtl":
					$this->read("ttiso", "get_all", $fieldVal, $dbArr);
					break;
				case "export_work":
				    //------ Create and download csv ----
				    foreach ($this->ttiso_model->getAll_export() as $r):
						foreach ($r as $r2 => $v2):
							if (is_object($v2)){
								$date_array = (array) $v2;
								$date_time = $date_array['date'];
								$date_only = explode(" ", $date_time);
								$r[$r2] = $date_only[0];
							}
						endforeach;
						
		                array_push($dbArr, $r);
		            endforeach;
				    // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "workability.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="workability.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "verifyRUD":
					echo $this->ruser_disc_model->is_entry_unique(array("user_id"=>$_POST['log_user'],"disc_code"=>$_POST['disc_code'],"flg_status"=>1));
					return true;
					break;
				case "p6":
					$this->read("projwbs", "get_all", $fieldVal, $dbArr);
					break;
				case "verifyLISO":
					var_dump($this->material_file_dtl_model->getAll(array("commodity_code"=>$_POST['commodity_code'],"size"=>$_POST['size'])));
					return true;
					break;
				case "spool_type":
				   $this->load->model('webapps/qms/spool_type_model'); // --
		           $this->read("spool_type", "get_all", $fieldVal, $dbArr);
					break;
				case "priority_ref":
				   $this->load->model('webapps/qms/iso_model');
				   array_push($dbArr, array("priority_code"=>"<ALL>","priority_no"=>""));
		            foreach ($this->iso_model->get_all_dd2() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "spltype_ref":
				   $this->load->model('webapps/qms/spool_type_model');
				   array_push($dbArr, array("spltype_code"=>"<ALL>","spltype_desc"=>""));
		            foreach ($this->spool_type_model->get_all_dd3() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "dd_areaRef":
				   $this->load->model('webapps/qms/iso_model');
				   array_push($dbArr, array("area_no"=>"<ALL>"));
		            foreach ($this->iso_model->get_dd_area() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "dd_category":
				   $this->load->model('webapps/qms/mat_takeoff_perspool_model');
				   array_push($dbArr, array("category"=>"<ALL>","plant_no"=>""));
		            foreach ($this->mat_takeoff_perspool_model->get_dd_category() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "dd_drawing":
				   $this->load->model('webapps/qms/treqiss_dtl_model');
				   array_push($dbArr, array("drawing_no"=>"<ALL>","stock_no"=>""));
		            foreach ($this->treqiss_dtl_model->get_dd_drawing() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "dd_iso_drawingno":
				   $this->load->model('webapps/qms/iso_model');
				   array_push($dbArr, array("drawing_no"=>"<ALL>","plant_no"=>""));
		            foreach ($this->iso_model->get_dd_Drawingno() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "dd_priorNo":
				   $this->load->model('webapps/qms/piece_struc_model');
				   array_push($dbArr, array("prior_no"=>"<ALL>","drawing_no"=>""));
		            foreach ($this->piece_struc_model->get_dd_priorNo() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "dd_areaRef2":
				   $fieldVal = "area_no";
				   $this->load->model('webapps/qms/iso_model');
				   $this->read("iso", "get_all_groupBy", $fieldVal, $dbArr);
					break;
				case "dd_drawingRef2":
				   $fieldVal= "drawing_no";
				   $this->load->model('webapps/qms/iso_model');
				   $this->read("iso", "get_all_groupBy", $fieldVal, $dbArr);
					break;
				
				case "dd_priorNo2":
				   $this->load->model('webapps/qms/iso_model');
				   $this->read("piece_struc", "get_dd_priorNo", $fieldVal, $dbArr);
					break;
				case "dd_plant_no":
				   $this->load->model('webapps/qms/piece_struc_model');
				   array_push($dbArr, array("plant_no"=>"<ALL>","drawing_no"=>""));
		            foreach ($this->piece_struc_model->get_dd_piecePlantno() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "dd_pieceStruct_areaNo":
				   $this->load->model('webapps/qms/piece_struc_model');
				   array_push($dbArr, array("area_no"=>"<ALL>","drawing_no"=>""));
		            foreach ($this->piece_struc_model->get_dd_pieceAreaNo() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "dd_subPriorityCode":
					
					$this->load->model('webapps/qms/iso_model');
				   array_push($dbArr, array("priority_code"=>"<ALL>","priority_no"=>""));
		            foreach ($this->iso_model->get_dd_subStringPriorityCode() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
					break;
				case "dd_arealocRef":
				   $this->load->model('webapps/qms/iso_model');
				   array_push($dbArr, array("area_loc"=>"<ALL>"));
		            foreach ($this->iso_model->get_dd_arealoc() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "dd_plantNo":
				   $this->load->model('webapps/qms/iso_model');
				   array_push($dbArr, array("plant_no"=>"<ALL>","area_no"=>""));
		            foreach ($this->iso_model->get_dd_plantno() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "priorityNo_ref":
				   $this->load->model('webapps/qms/spool_type_model');
				   array_push($dbArr, array("spltype_code"=>"<ALL>","spltype_desc"=>""));
		            foreach ($this->spool_type_model->get_all_dd2() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "subsystemNo_ref":
				   $this->load->model('webapps/qms/sub_system_model');
				   array_push($dbArr, array("system_no"=>"<ALL>","sub_system"=>"<ALL>"));
		            foreach ($this->sub_system_model->get_all_dd2() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "areano_ref":
				   $this->load->model('webapps/qms/iso_struc_model');
				    array_push($dbArr, array("area_no"=>"<ALL>","area_desc"=>""));
		            foreach ($this->iso_struc_model->get_all_dd2() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "reason":
				   $this->load->model('webapps/qms/reason_model');
		           $this->read("reason", "get_all", $fieldVal, $dbArr);
					break;
				case "action":
				   $this->load->model('webapps/qms/action_model');
		           $this->read("action", "get_all", $fieldVal, $dbArr);
					break;
				case "reasonDesc":
				   $this->load->model('webapps/qms/reason_model');
		           $this->read("reason", "get_all_dd", $fieldVal, $dbArr);
				   $cntr = 0;
						   $newDbArr = array();
							foreach ($dbArr as $key => $value) {
								$cntr = 0;
								foreach ($value as $key2 => $value2) {
									$newDbArr[$key][$key2] = $value2;
									++$cntr;
								}
								$newDbArr[$key]['reason_desc'] = $newDbArr[$key]['reason_code']."-".$newDbArr[$key]['reason_desc'];
							}
						$dbArr = $newDbArr;
				break;
				case "actionDesc":
				   $this->load->model('webapps/qms/action_model');
		           $this->read("action", "get_all_dd", $fieldVal, $dbArr);
				   $cntr = 0;
						   $newDbArr = array();
							foreach ($dbArr as $key => $value) {
								$cntr = 0;
								foreach ($value as $key2 => $value2) {
									$newDbArr[$key][$key2] = $value2;
									++$cntr;
								}
								$newDbArr[$key]['action_desc'] = $newDbArr[$key]['action_code']."-".$newDbArr[$key]['action_desc'];
							}
						$dbArr = $newDbArr;
				break;
				case "matUtil":
				   $this->load->model('webapps/qms/rmat_util_model');
		           $this->read("rmat_util", "get_all", $fieldVal, $dbArr);
					break;
				case "rdisc":
				   $this->load->model('webapps/qms/rdiscipline_model');
		           $this->read("rdiscipline", "get_all", $fieldVal, $dbArr);
					break;
					
				case "discRef":
					$this->load->model('webapps/qms/rdiscipline_model');
					$this->read("rdiscipline", "get_all_dd", $fieldVal, $dbArr);
					break;
				case "tmrsRef":
					$this->load->model('webapps/qms/tmrs_hdr_model');
					$this->read("tmrs_hdr", "get_all_mod", $fieldVal, $dbArr);
					break;
				case "tmrsDtlRef":
					$fieldVal = "mrs_no = '{$_GET['mrs_no']}'";
					$this->load->model('webapps/qms/tmrs_dtl_model');
					$this->read("tmrs_dtl", "get_all", $fieldVal, $dbArr);
					break;
				case "export_tmrsRef":
					$this->load->model('webapps/qms/tmrs_hdr_model');
					$this->read("tmrs_hdr", "get_all_export", $fieldVal, $dbArr);
					
				    // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "tmrs_hdr.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="tmrs_hdr.csv"');
					$csv = urldecode($csv);
		            echo $csv;
					return true;
					break;
				case "rcontrolRef":
				   $this->load->model('webapps/qms/rcontrol_model');
		           $this->read("rcontrol", "get_all", $fieldVal, $dbArr);
					break;
				case "matExcess":
				   $this->load->model('webapps/qms/mat_excess_model');
		           $this->read("mat_excess", "get_all", $fieldVal, $dbArr);
					break;
				case "twhse_mat_spl":
					
				   $area_loc = array(
									array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							   );
				   $areaArr = array();
				   foreach ($area_loc[0] as $key => $value) {
				   	   $value = explode("_", $value);
				   	   array_push($areaArr,$value[0]);					   
				   }
				   $area = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
				   if($_GET['area_loc'] == 'ALL')
					   $fieldVal = "area_loc in ('{$area}') and priority = '{$_GET['priority']}'";
				   else
			   		   $fieldVal = "area_loc = '{$_GET['area_loc']}' and priority = '{$_GET['priority']}'";
				   
				   // if($_GET['area_no'] = "'<ALL>'")
				   		// $fieldVal = "area_loc = '{$_GET['area_loc']}'";
				   $this->load->model('webapps/qms/twhse_mat_spl_model');
		           $this->read("twhse_mat_spl", "get_all", $fieldVal, $dbArr);
					break;
				case "isoDwgRef":
					$area_loc = array(
									array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							   );
				   $prior_setup = array("P1","TA-2013","P2","P3");
				   $prior_setup2 = array("P1","TA","P2","P3");
				   $areaArr = array();
				   foreach ($area_loc[1] as $key => $value) {
				   	   $value = explode("_", $value);
				   	   array_push($areaArr,$value[0]);					   
				   }
				   
				   if(in_array($_GET['pno'], $prior_setup) >= 0 ){
				   	  if(array_search($_GET['pno'], $prior_setup) == 1){
				   	 	foreach ($area_loc[1] as $key => $value) {
				   	   		$value = explode("_", $value);
				   	   		array_push($areaArr,$value[0]);					   
				  		 } 
						$area = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
					   	 	if($_GET['aname'] == 'ALL'){
					   	 		foreach ($area_loc[1] as $key => $value) {
					   	  			 $value = explode("_", $value);
					   	  			 array_push($areaArr,$value[0]);					   
					   			}
								$area = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
						   		$fieldVal = "t.priority_timing = '{$_GET['pno']}' and t.area_loc in ('{$area}') and t2.percent_workable = 100 ";
							}
					   		else{
					   			// foreach ($area_loc[1] as $key => $value) {
					   	  			 // $value = explode("_", $value);
					   	  			 // array_push($areaArr,$value[0]);					   
					  			 // }
								$area = str_replace(",", "','", str_replace("'", "\"", addslashes($_GET['aname'])));
								$fieldVal = "t.priority_timing = '{$_GET['pno']}' and t.area_loc in ('{$area}') and t2.percent_workable = 100 ";
							}
				   	 }
					  	 else{
					   	 	foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
					   	   			$value = explode("_", $value);
					   	   			array_push($areaArr,$value[0]);					   
					  		 	} 
								
						 			if($_GET['aname'] == 'ALL'){
						 				foreach ($area_loc[1] as $key => $value) {
					   	   					$value = explode("_", $value);
					   	   					array_push($areaArr,$value[0]);					   
					  					} 
	
					  					$area = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
						 				$fieldVal = "priority_timing <> '{$prior_setup[1]}' and priority_code LIKE  '{$_GET['pno']}%' and area_loc in ('{$area}')";
									}
					   				else{
					   					// foreach ($area_loc[1] as $key => $value) {
					   	  					 // $value = explode("_", $value);
					   	  			 		// array_push($areaArr,$value[0]);					   
					  					// }
	
										$area = str_replace(",", "','", str_replace("'", "\"", addslashes($_GET['aname'])));
				   		   				$fieldVal = "priority_timing <> '{$prior_setup[1]}' and priority_code LIKE  '{$_GET['pno']}%' and area_loc = '{$area}'";
									}
						 } 	 
				     }
					   
				 

			    $this->load->model('webapps/qms/iso_model');
		        $this->read("iso", "get_all", $fieldVal, $dbArr);
				break;
				case "isoDwg_qmsqpipqua":
					$area_loc = array(
									array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							   );
				   $prior_setup = array("P1","TA-2013","P2","P3");
				   $prior_setup2 = array("P1","TA","P2","P3");
				   $areaArr = array();
				   foreach ($area_loc[1] as $key => $value) {
				   	   $value = explode("_", $value);
				   	   array_push($areaArr,$value[0]);					   
				   }
				   
				   if(in_array($_GET['pno'], $prior_setup) >= 0 ){
				   	  if(array_search($_GET['pno'], $prior_setup) == 1){
				   	 	foreach ($area_loc[1] as $key => $value) {
				   	   		$value = explode("_", $value);
				   	   		array_push($areaArr,$value[0]);					   
				  		 } 
						$area = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
					   	 	if($_GET['aname'] == 'ALL'){
					   	 		foreach ($area_loc[1] as $key => $value) {
					   	  			 $value = explode("_", $value);
					   	  			 array_push($areaArr,$value[0]);					   
					   			}
								$area = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
						   		$fieldVal = "priority_timing = '{$_GET['pno']}' and area_loc in ('{$area}')";
							}
					   		else{
					   			// foreach ($area_loc[1] as $key => $value) {
					   	  			 // $value = explode("_", $value);
					   	  			 // array_push($areaArr,$value[0]);					   
					  			 // }
								$area = str_replace(",", "','", str_replace("'", "\"", addslashes($_GET['aname'])));
								$fieldVal = "priority_timing = '{$_GET['pno']}' and area_loc in ('{$area}')";
							}
				   	 }
					  	 else{
					   	 	foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
					   	   			$value = explode("_", $value);
					   	   			array_push($areaArr,$value[0]);					   
					  		 	} 
								
						 			if($_GET['aname'] == 'ALL'){
						 				foreach ($area_loc[1] as $key => $value) {
					   	   					$value = explode("_", $value);
					   	   					array_push($areaArr,$value[0]);					   
					  					} 
	
					  					$area = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
						 				$fieldVal = "priority_timing <> '{$prior_setup[1]}' and priority_code LIKE  '{$_GET['pno']}%' and area_loc in ('{$area}')";
									}
					   				else{
					   					// foreach ($area_loc[1] as $key => $value) {
					   	  					 // $value = explode("_", $value);
					   	  			 		// array_push($areaArr,$value[0]);					   
					  					// }
	
										$area = str_replace(",", "','", str_replace("'", "\"", addslashes($_GET['aname'])));
				   		   				$fieldVal = "priority_timing <> '{$prior_setup[1]}' and priority_code LIKE  '{$_GET['pno']}%' and area_loc = '{$area}'";
									}

						 } 	 
				     }

					   
				 

			    $this->load->model('webapps/qms/iso_model');
		        $this->read("iso", "get_all", $fieldVal, $dbArr);
				break;
				case "isoDwgRef2":
					 $area_loc = array(
									 array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									 array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									 array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							    );
				    $prior_setup = array("P1","TA-2013","P2","P3");
				    $prior_setup2 = array("P1","TA","P2","P3");
				   	$areaArr = array();
				   	// foreach ($area_loc[1] as $key => $value) {
				   	    // $value = explode("_", $value);
				   	    // array_push($areaArr,$value[0]);					   
				    // }
				   // $cArealoc = "'". str_replace("','", "*!*", str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr)))))."'";
				    
					if(in_array($_GET['pno'], $prior_setup) >= 0 ){				   	 
						if(array_search($_GET['pno'], $prior_setup) == 1){
							foreach ($area_loc[1] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							}						
						} else {
							foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							} 
							// $cArealoc = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
						}
					}
					$cArealoc = "'". str_replace("','", "*!*", str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr)))))."'";
				    $aname = "'".str_replace(",", "','", str_replace("'", "\"", addslashes( $_GET['aname'])))."'";
				    $pno = "'".$_GET['pno']."'";
					// echo "pno ".$pno;
					// echo "<br>aname ".$aname;
					// echo "<br>carealoc  ".$cArealoc;
					// return true;
			    $this->load->model('webapps/qms/ttupl_model');
				$this->ttupl_model->call_sp_query_spl_wise((int) $_GET['tbAdvance'],(int)$_GET['rswork'],(int)$_GET['cbper1'],(int) $_GET['cbper2'],$aname,$cArealoc,$pno,(int)$_GET['detail']);
		        $this->read("ttupl", "get_all", $fieldVal, $dbArr);
		       $cntr = 0;
						$newDbArr = array();
						foreach ($dbArr as $key => $value) {
							$cntr = 0;
							foreach ($value as $key2 => $value2) {
								$newDbArr[$key][$key2] = $value2;
								++$cntr;
							}
						
						}
					
				$dbArr = $newDbArr;
				break;
				
				case "proc_ps_mto_hdr":
					 $area_loc = array(
									 array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									 array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									 array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							    );
				    $prior_setup = array("P1","TA-2013","P2","P3");
				    $prior_setup2 = array("P1","TA","P2","P3");
				   	$areaArr = array();
					if(in_array($_GET['pno'], $prior_setup) >= 0 ){				   	 
						if(array_search($_GET['pno'], $prior_setup2) == 1){
							foreach ($area_loc[1] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							}						
						} else {
							foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							} 
							 
						}
					}
					$cArealoc = str_replace("','", "*!*", str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr)))));
				    $aname = str_replace(",", "','", str_replace("'", "\"", addslashes( $_GET['aname'])));
				    $pno = $_GET['pno'];
					 $this->load->model('webapps/qms/tt_pipPswise_model');
			   		 $this->tt_pipPswise_model->call_procQuery_pipPswise((int) $_GET['tbAdvance'],(int)$_GET['rswork'],(int)$_GET['cbper1'],(int) $_GET['cbper2'],$aname,$cArealoc,$pno,(int)$_GET['detail']);				
			   		 $this->read("tt_pipPswise", "get_all", $fieldVal, $dbArr);
					
							
				break;
				case "QCMRIR":
					$this->load->model('webapps/qms/sys_prog_model');
					$dbArr = $this->sys_prog_model->get_by_DEFAULT_DISC("DEFAULT_DISC");
					break;
				break;
				case "ps_mto_Ref":
					$fieldVal = "drawing_no = '{$_GET['drawing_no']}' and ps_code = '{$_GET['ps_code']}' and ps_type = '{$_GET['ps_type']}'";
					$this->load->model('webapps/qms/ps_mto_model');
					$this->read("ps_mto", "get_all2", $fieldVal, $dbArr);
					
						$cntr = 0;
						$newDbArr = array();
						foreach ($dbArr as $key => $value) {
							$cntr = 0;
							foreach ($value as $key2 => $value2) {
								$newDbArr[$key][$key2] = $value2;
								++$cntr;
							}
							$newDbArr[$key]['ref_rec_result'] = $newDbArr[$key]['wt_fab'] - $newDbArr[$key]['ref_rec_qty'];
							
							if ($newDbArr[$key]['ref_rec_qty'] > $newDbArr[$key]['wt_fab'])
								$newDbArr[$key]['BALANCE_EXCESS'] = "EXCESS";
							else {
								if($newDbArr[$key]['wt_fab'] - $newDbArr[$key]['ref_rec_qty'] <> 0)
									$newDbArr[$key]['BALANCE_EXCESS'] = "BALANCE";
								else
									$newDbArr[$key]['BALANCE_EXCESS'] = "COMPLETED";
							}
							
							
						}
						
						$dbArr = $newDbArr;
					break;
				case "export_qmsrsmrpp":
						
						$startDate = $_GET['startD'];
						$endDate = $_GET['endD'];
						$priorno = str_replace(",", "*!*", $_GET['prior_no']);
						$areano = str_replace(",", "*!*", $_GET['area_no']);;
						$drawingno =  str_replace(",", "*!*", $_GET['drawing_no']);
						$jmifno =str_replace(",", "*!*", $_GET['jmif']);
						
						if($priorno == 'undefined')
							$priorno = 'NULL';
						if($areano == 'undefined')
							$areano = "NULL";
						if($drawingno == 'undefined')
							$drawingno = "NULL";
						if($jmifno == 'undefined')
							$jmifno = "NULL";
					$this->load->model('webapps/qms/tt_export_qmsrsmrpp_dsr_model');
			   		$this->tt_export_qmsrsmrpp_dsr_model->call_sp_query_export_structDR($startDate,$endDate,$priorno,$areano,$drawingno,$jmifno,$_GET['rsOption']);				
			   		$this->read("tt_export_qmsrsmrpp_dsr", "export_structDR", $fieldVal, $dbArr,"export");
					
					 // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "qmsrsmrpp_dsr.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="qmsrsmrpp_dsr.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
				break;
				case "export_qmsqpwpsw":
					 $area_loc = array(
									 array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									 array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									 array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							    );
				    $prior_setup = array("P1","TA-2013","P2","P3");
				    $prior_setup2 = array("P1","TA","P2","P3");
				   	$areaArr = array();
					if(in_array($_GET['pno'], $prior_setup) >= 0 ){				   	 
						if(array_search($_GET['pno'], $prior_setup2) == 1){
							foreach ($area_loc[1] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							}						
						} else {
							foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
								$value = explode("_", $value);
								array_push($areaArr,$value[0]);					   
							} 
							 
						}
					}
					$cArealoc = str_replace("','", "*!*", str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr)))));
				    $aname = str_replace(",", "','", str_replace("'", "\"", addslashes( $_GET['aname'])));
				    $pno = $_GET['pno'];
					 			
			   		 if($_GET['detail'] == 0){
			   		 	$this->load->model('webapps/qms/tt_pipPswise_model');
			   		    $this->tt_pipPswise_model->call_procQuery_pipPswise((int) $_GET['tbAdvance'],(int)$_GET['rswork'],(int)$_GET['cbper1'],(int) $_GET['cbper2'],$aname,$cArealoc,$pno,(int)$_GET['detail']);	
					 	$this->read("tt_pipPswise", "export_pswise_wOdetail", $fieldVal, $dbArr,"export");
			   		 }else{
			   		 	$this->load->model('webapps/qms/tt_pipPswise_model');
			   		    $this->tt_pipPswise_model->call_procQuery_pipPswise((int) $_GET['tbAdvance'],(int)$_GET['rswork'],(int)$_GET['cbper1'],(int) $_GET['cbper2'],$aname,$cArealoc,$pno,(int)$_GET['detail']);	
					 	$this->read("tt_pipPswise", "export_pswise_wDetail", $fieldVal, $dbArr,"export");
			   		 }
				 // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "MATL Workability PS Wise.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="MATL Workability PS Wise.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
				break;
				case "twhse_mat_iso":
					$area_loc = array(
									array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							   );
				   $prior_setup = array("P1","TA-2013","P2","P3");
				   $prior_setup2 = array("P1","TA","P2","P3");
				   $areaArr = array();
				   
				   if(in_array($_GET['pno'], $prior_setup2) >= 0 ){
				   	 
				   	 if(array_search($_GET['pno'], $prior_setup2) == 1){
				   	 	if($_GET['aname'] == 'ALL'){
				   	 		foreach ($area_loc[1] as $key => $value) {
				   	  			 $value = explode("_", $value);
				   	  			 array_push($areaArr,$value[0]);					   
				   			}
							$area = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
					   		$fieldVal = "priority = '{$_GET['pno']}' and area_loc in ('{$area}') ";
						}
				   		else{
				   			foreach ($area_loc[1] as $key => $value) {
				   	  			 $value = explode("_", $value);
				   	  			 array_push($areaArr,$value[0]);					   
				  			 }
							$area = str_replace(",", "','", str_replace("'", "\"", addslashes($_GET['aname'])));
							$fieldVal = "priority = '{$_GET['pno']}' and area_loc = '{$area}'";
						}
				   	 }
				  	 else{
				   	 	foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
				   	   			$value = explode("_", $value);
				   	   			array_push($areaArr,$value[0]);					   
				  		 	} 
							
					 			if($_GET['aname'] == 'ALL'){
					 				foreach ($area_loc[1] as $key => $value) {
				   	   					$value = explode("_", $value);
				   	   					array_push($areaArr,$value[0]);					   
				  					} 

				  					$area = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
					 				$fieldVal = "priority <> '{$prior_setup2[1]}' and area_loc in ('{$area}')";
								}
				   				else{
				   					// foreach ($area_loc[1] as $key => $value) {
				   	  					 // $value = explode("_", $value);
				   	  			 		// array_push($areaArr,$value[0]);					   
				  					// }

									$area = str_replace(",", "','", str_replace("'", "\"", addslashes($_GET['aname'])));
			   		   				$fieldVal = "priority <> '{$prior_setup2[1]}' and area_loc = '{$area}'";
								}
					} 
			    }
				   $this->load->model('webapps/qms/twhse_mat_iso_model');
		           $this->read("twhse_mat_iso", "get_all", $fieldVal, $dbArr);
				   break;
				 case "twhse_mat_ps":
					$area_loc = array(
									array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							   );
				   $prior_setup = array("P1","TA-2013","P2","P3");
				   $prior_setup2 = array("P1","TA","P2","P3");
				   $areaArr = array();
				   
				   if(in_array($_GET['pno'], $prior_setup2) >= 0 ){
				   	 
				   	 if(array_search($_GET['pno'], $prior_setup2) == 1){
				   	 	if($_GET['aname'] == 'ALL'){
				   	 		foreach ($area_loc[1] as $key => $value) {
				   	  			 $value = explode("_", $value);
				   	  			 array_push($areaArr,$value[0]);					   
				   			}
							$area = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
					   		$fieldVal = "priority = '{$_GET['pno']}' and area_loc in ('{$area}') ";
						}
				   		else{
				   			foreach ($area_loc[1] as $key => $value) {
				   	  			 $value = explode("_", $value);
				   	  			 array_push($areaArr,$value[0]);					   
				  			 }
							$area = str_replace(",", "','", str_replace("'", "\"", addslashes($_GET['aname'])));
							$fieldVal = "priority = '{$_GET['pno']}' and area_loc = '{$area}'";
						}
				   	 }
				  	 else{
				   	 	foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
				   	   			$value = explode("_", $value);
				   	   			array_push($areaArr,$value[0]);					   
				  		 	} 
							
					 			if($_GET['aname'] == 'ALL'){
					 				foreach ($area_loc[1] as $key => $value) {
				   	   					$value = explode("_", $value);
				   	   					array_push($areaArr,$value[0]);					   
				  					} 

				  					$area = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
					 				$fieldVal = "priority <> '{$prior_setup2[1]}' and area_loc in ('{$area}')";
								}
				   				else{
				   					// foreach ($area_loc[1] as $key => $value) {
				   	  					 // $value = explode("_", $value);
				   	  			 		// array_push($areaArr,$value[0]);					   
				  					// }

									$area = str_replace(",", "','", str_replace("'", "\"", addslashes($_GET['aname'])));
			   		   				$fieldVal = "priority <> '{$prior_setup2[1]}' and area_loc = '{$area}'";
								}
					 
					} 
								
					 
			    }
				   
				   
				   // if($_GET['area_no'] = "'<ALL>'")
				   		// $fieldVal = "area_loc = '{$_GET['area_loc']}'";

				   $this->load->model('webapps/qms/twhse_mat_ps_model');
		           $this->read("twhse_mat_ps", "get_all", $fieldVal, $dbArr);
				   break;
				case "twhse_mat_spl2":
					$area_loc = array(
									array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
							   );
				   $prior_setup = array("P1","TA-2013","P2","P3");
				   $prior_setup2 = array("P1","TA","P2","P3");
				   $areaArr = array();
				   
				   if(in_array($_GET['pno'], $prior_setup2) >= 0 ){
				   	 
				   	 if(array_search($_GET['pno'], $prior_setup2) == 1){
				   	 	if($_GET['aname'] == 'ALL'){
				   	 		foreach ($area_loc[1] as $key => $value) {
				   	  			 $value = explode("_", $value);
				   	  			 array_push($areaArr,$value[0]);					   
				   			}
							$area = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
					   		$fieldVal = "priority = '{$_GET['pno']}' and area_loc in ('{$area}') ";
						}
				   		else{
				   			foreach ($area_loc[1] as $key => $value) {
				   	  			 $value = explode("_", $value);
				   	  			 array_push($areaArr,$value[0]);					   
				  			 }
							$area = str_replace(",", "','", str_replace("'", "\"", addslashes($_GET['aname'])));
							$fieldVal = "priority = '{$_GET['pno']}' and area_loc = '{$area}'";
						}
				   	 }
				  	 else{
				   	 	foreach ($area_loc[array_search($_GET['pno'], $prior_setup2)] as $key => $value) {
				   	   			$value = explode("_", $value);
				   	   			array_push($areaArr,$value[0]);					   
				  		 	} 
							
					 			if($_GET['aname'] == 'ALL'){
					 				foreach ($area_loc[1] as $key => $value) {
				   	   					$value = explode("_", $value);
				   	   					array_push($areaArr,$value[0]);					   
				  					} 

				  					$area = str_replace(",", "','", str_replace("'", "\"", addslashes(implode(",", $areaArr))));
					 				$fieldVal = "priority <> '{$prior_setup2[1]}' and area_loc in ('{$area}')";
								}
				   				else{
				   					// foreach ($area_loc[1] as $key => $value) {
				   	  					 // $value = explode("_", $value);
				   	  			 		// array_push($areaArr,$value[0]);					   
				  					// }

									$area = str_replace(",", "','", str_replace("'", "\"", addslashes($_GET['aname'])));
			   		   				$fieldVal = "priority <> '{$prior_setup2[1]}' and area_loc = '{$area}'";
								}
					 
					} 
								
					 
			    }
				   
		 
				   $this->load->model('webapps/qms/twhse_mat_ps_model');
		           $this->read("twhse_mat_ps", "get_all", $fieldVal, $dbArr);
				   break;
				case "verifyButt":
					$this->load->model('webapps/qms/mod_access_model');
					return $this->mod_access_model->verifyGroupAccess();
					 
				break;
			    case 'priorSetup':
					//PRIOR_SETUP
					$prior_setup = array("P1","TA-2013","P2","P3");
					$prior_setup2 = array("P1R","TURN AROUND-2013","P2R","P3R");
					$a = 0;
					while ($a <= (sizeof($prior_setup) - 1)) {
		                array_push($dbArr, array("pno" => $prior_setup[$a], "total" => sizeof($prior_setup), "pseq" =>$a+1,"pname" => $prior_setup2[$a]));
		                $a++;												
					}
					break;
				case 'sp_arealoc':
					//AREA_LOC
					$area_loc = array(
									array("CHD UNIT-032 (LP)_P1","NHT UNIT-021 & 022_P1","MHFO UNIT-011_P1","SGP UNIT-062_P1","JETTY UNIT-240_P1","TANKAGE UNIT-232_P1","ICP UNIT-110-BROWN_P1","SULPHUR UNIT-092_P1","AMINE REGEN UNIT-091_P1","FLARE MITG'N-894_P1","SGP UNIT-061_P1","SWS-093_P1"),
									array("CHD UNIT-032 (LP)_TA","CHD UNIT-032 (HP)_TA","FLARE MITG'N-894_TA","FLARE SYSTEM-220_TA","ICP UNIT-110-BROWN_TA","MHFO UNIT-011_TA","NHT UNIT-021 & 022_TA","TANKAGE UNIT-232_TA","SGP UNIT-062_TA","SULPHUR UNIT-092_TA","AMINE REGEN UNIT-091_TA","SGP UNIT-061_TA","SWS-093_TA","CW UNIT-163_TA"),
									array("FLARE SYSTEM-220_P2","ICP UNIT-110-GREEN_P2","ICP UNIT-110-BROWN_P2","CW UNIT-163_P2","MDU UNIT-066_P2","RAIN WATER-130_P2","INSTRU AIR-200_P2"),
									array("CHD UNIT-032 (HP)_P3","ARU-913_P3","HRU-031_P3","SRU-923_P3","FLARE MITG'N-894_P3","NPF-562_P3")
								);
					$a = 0;
					$v_pno = array();
					while ($a <= 3) {
						$b = 0;
						while ($b <= (sizeof($area_loc[$a]) - 1)) {
							$v_pno = explode("_", $area_loc[$a][$b]);
							if ($v_pno[1] == $_GET['pno']) {
								if (!in_array(array("pseq" => $a,"aname" => "ALL","pno" => $v_pno[1], "aseq" => 0, "total" => sizeof($area_loc[$a])), $dbArr))
					            	array_push($dbArr, array("pseq" => $a,"aname" => "ALL","pno" => $v_pno[1], "aseq" => 0, "total" => sizeof($area_loc[$a])));
					            
					            array_push($dbArr, array("pseq" => $a,"aname" => $v_pno[0],"pno" => $v_pno[1], "aseq" => $b, "total" => sizeof($area_loc[$a])));
							}
							$b++;						
						}
						$a++;						
					}
					break;
				 default:
					$this->read("iso", "get_all", $fieldVal, $dbArr);
					break;
			}
            $this->result['rows'] = $dbArr;
            $this->output->set_content_type('application/json')->set_output(json_encode($this->result));
		}
			
		
		public function manage($item = ""){
			// foreach( $_POST as $r => $val){
                // $data .= $r . ": " . $val . " ";
			// }
			// if (!write_file('e:\postData.txt', $data))
			     // echo 'Unable to write the file';
			// else
			     // echo 'File written!';
			switch($item){
				case "psTo":					$this->load->model('webapps/qms/ps_mto_model');
					$this->callback($this->ps_mto_model->set_pieceStruc());
					break;
				case "tosdDtlRef":
					$this->load->model('webapps/qms/tosd_dtl_model');
					$this->callback($this->tosd_dtl_model->set());
					break;
				case "tosd_hdr_Ref":
				case "tosd_hdr_Ref_fin":
					$this->load->model('webapps/qms/tosd_hdr_model');
					$this->callback($this->tosd_hdr_model->set());
					break;
				case "tmrsDtlRef":
					$this->load->model('webapps/qms/tmrs_dtl_model');
					$this->callback($this->tmrs_dtl_model->set());
					break;
				case "tmrsRef":
				case "tmrsRef_fin":
					$this->load->model('webapps/qms/tmrs_hdr_model');
					$this->callback($this->tmrs_hdr_model->set());
					break;
				case "updPieceStruct":
					$this->load->model('webapps/qms/piece_struc_model');
					$this->piece_struc_model->upd_pieceStruc();
					break;
				case "ttisoStruc":
					$this->load->model('webapps/qms/tt_iso_struc_model');
					$this->tt_iso_struc_model->create_ttisoStruc();
					
					break;
				case "UpdPieceStruct":
					
					$this->load->model('webapps/qms/piece_struc_model');
			   		$dbArr = $this->piece_struc_model->call_update_pieceStruct($_POST['haul'],$_POST['chipping'],$_POST['packer'],$_POST['assembly'],$_POST['erection'],$_POST['alignment'],$_POST['bolt']); 		
			   		return $dbArr;
					break;
				case "UpdatePieceStruct":
					// $haul = $_POST['haul'];
					// $chipping = $_POST['chipping'];
				    // $packer = $_POST['packer'];
					// $assembly = $_POST['assembly'];
					// $erection = $_POST['erection'];
					// $alignment = $_POST['alignment'];
					// $bolt = $_POST['bolt'];
					// $procRecid = $_POST['procRecid'];
					//var_dump($haul,$chipping,$packer,$assembly,$erection,$alignment,$procRecid);
					//$haul,$chipping,$packer,$assembly,$erection,$alignment,$bolt,$procRecid
					$this->load->model('webapps/qms/piece_struc_model');
			   		$dbArr = $this->piece_struc_model->call_sp_update_pieceStruct($_POST['haul'],$_POST['chipping'],$_POST['packer'],$_POST['assembly'],$_POST['erection'],$_POST['alignment'],$_POST['bolt'],$_POST['procRecid']); 		
			   		return $dbArr;
					break;
				case "UpdatePieceStruct2":
					$this->callback($this->piece_struc_model->set());
					break;
				case "spool":
					$this->spool_model->set_spool();
					break;
				case "joints":
					$this->joints_model->set_joints();
					break;
				case "random":
					$this->random_pipes_model->set_random();
					break;
				case "material":
					$this->mat_takeoff_perspool_model->set_material();
					break;
				case "insTo":
					$this->inst_takeoff_model->set_ins();
					break;
				case "elecTo":
					$this->elec_takeoff_model->set_elec();
					break;
				case "isoMech":
					$this->iso_mech_model->set_isoMech();
					break;
				case "equipMech":
					$this->equip_mech_model->set_equipMech();
					break;
				case "isoStruc":
					$this->iso_struc_model->set_isoStruc();
					break;
				case "pieceStruc":
					$this->piece_struc_model->set_pieceStruc();
					break;
				case "tp":
					$this->testpack_hdr_model->set_tp();
					break;
				case "pipMto":
					$this->pip_mto_data_model->set_pip();
					break;
				case "weldMto":
					$this->pip_weld_data_model->set_weld();
					break;
				case "psMto":
					$this->pip_sup_data_model->set();
					break;
				case "fsplMto":
					$this->pip_fspl_data_model->set();
					break;
				case "fabMto":
					$this->pip_fabspl_data_model->set();
					break;
				case "whseMto":
					$this->pip_wspl_data_model->set();
					break;
				case "whseMatMto":
					$this->pip_wmatl_data_model->set();
					break;
				case "mechMto":
					$dbArr = $this->tt_uplmech_model->set();
		            $this->result['rows'] = $dbArr;
		            $this->output->set_content_type('application/json')->set_output(json_encode($this->result));
					break;
				case "strMto":
					$dbArr = $this->str_pm_data_model->set();
		            $this->result['rows'] = $dbArr;
		            $this->output->set_content_type('application/json')->set_output(json_encode($this->result));
					break;
				case "areaTbl":		            										$this->callback($this->area_model->set());
					break;
				case "subarea":
					$this->callback($this->sub_area_model->set());
					break;
				case "fwbs":
					$this->callback($this->ref_fwbs_model->set());
					break;
				case "discTbl":
					$this->callback($this->ref_discipline_model->set());
					break;
				case "refJnt":
					$this->callback($this->ref_jointtype_model->set());
					break;
				case "roc":
					$this->callback($this->ref_roctype_model->set());
					break;
				case "rocTbl":
					$this->callback($this->ref_roc_model->set());
					break;
				case "work":
					$this->callback($this->ref_workability_model->set());
					break;
				case "tpo":
				case "tpo_fin":
					$this->callback($this->tpo_hdr_model->set());
					break;
				case "tpoDtl":
					$this->callback($this->tpo_dtl_model->set());
					break;
				case "tdlmr":
				case "tdlmr_fin":
					$this->callback($this->tdlmr_hdr_model->set());
					break;
				case "tdlmrDtl":
					$this->callback($this->tdlmr_dtl_model->set());
					break;
				case "tjwrr":
				case "tjwrr_fin":
					$this->callback($this->tjwrr_hdr_model->set());
					break;
				case "UbrPip":
					$this->callback($this->tjwrr_hdr_model->set_from_upl());
					break;
				case "UbiPip1":
					$this->callback($this->treqiss_dtl_model->set_from_upl());
					break;
				case "tjwrrDtl":
					$this->callback($this->tjwrr_dtl_model->set());
					break;
				case "tjmif":
					$this->callback($this->tttemps_model->set());
					break;
				case "setTJWRR":
					$this->callback($this->tjwrr_dtl_model->showJSon());
					break;
				case "tjwrr_upd":
					$this->callback($this->tjwrr_hdr_model->call_sp($_POST['sp']));
					break;
				case "ttMTO":
				case "ttMTO1":
					$this->callback($this->ttmto_model->set($_POST['setType']));
					break;
				case "treq":
				case "treq_fin":
					$this->callback($this->treqiss_hdr_model->set());
					break;
				case 'treqDtl':
					$this->callback($this->treqiss_dtl_model->set());
					break;
				case 'qc_inspec':
					$this->callback($this->treqiss_dtl_model->qc_inspec($_POST['jmif_no']));
					break;
				case "whseGW_proc":
		            $this->callback($this->ttiso_model->call_sp($_POST['sp']));					// var_dump($this->ttiso_model->call_sp($_POST['sp']));
					break;
				case "callSP_prio":
		            $this->callback($this->iso_model->call_upd_sp());
					break;
				case "callSP_upl_tfab":
					$this->load->model('webapps/qms/tfab_mat_spl_model');
		            $this->callback($this->tfab_mat_spl_model->call_upl_tfab());
					break;
				case "callSP_UpdFabShop":
		            $this->callback($this->tfab_mat_spl_model->call_upd_sp2());
					break;
				case 'p6':
					if ($_POST['cmode'] == "add")
						$this->callback($this->projwbs_model->set());
					else
						$this->callback($this->task_model->set());
					break;
				case "setTREQ":
					$this->callback($this->treqiss_dtl_model->showJSon());
					break;
				case "issConf":
					$this->callback($this->Ttemp_conf_model->set());
					break;
				case "issConf_eve":
					$this->callback($this->Ttemp_conf_model->call_sp());
					break;
				case "materialRef":						
					$this->callback($this->material_file_model->set());
					break;
				case "spool_type":		
					$this->load->model('webapps/qms/spool_type_model');				
					$this->callback($this->spool_type_model->set());
					break;
				case "supplierRef":	
								
					$this->callback($this->rsupplier_model->set());
					break;
				case "reason":		
					$this->load->model('webapps/qms/reason_model');			
					$this->callback($this->reason_model->set());
					break;
				case "action":		
					$this->load->model('webapps/qms/action_model');			
					$this->callback($this->action_model->set());
					break;
				case "matUtil":		
					$this->load->model('webapps/qms/rmat_util_model');		
					$this->callback($this->rmat_util_model->set());
					break;
				case "rdisc":		
					$this->load->model('webapps/qms/rdiscipline_model');		
					$this->callback($this->rdiscipline_model->set());
					break;
				case "rcontrolRef":		
					$this->load->model('webapps/qms/rcontrol_model');		
					$this->callback($this->rcontrol_model->set());
					break;		
								
				default:
					$data = $this->iso_model->set_iso();
					break;
				
			}
		}

		private function callback($return_value){
			if(is_array($return_value))
				echo $return_value[0]['return_value'];
			else
				echo $return_value;
		}
	
		public function remove($item = ""){
			switch($item){
				case "psTo":
					$this->load->model('webapps/qms/ps_mto_model');
					$this->callback($this->ps_mto_model->remove_pieceStruc());
					break;
				case "tosdDtlRef":
					$this->load->model('webapps/qms/tosd_dtl_model');
					$this->callback($this->tosd_dtl_model->remove());
					break;
				case "tosd_hdr_Ref":
					$this->load->model('webapps/qms/tosd_hdr_model');
					$this->callback($this->tosd_hdr_model->remove());
					break;
				case "tmrsRef":
					$this->load->model('webapps/qms/tmrs_hdr_model');
					$this->callback($this->tmrs_hdr_model->remove());
					break;
				case "tmrsDtlRef":
					$this->load->model('webapps/qms/tmrs_dtl_model');
					$this->callback($this->tmrs_dtl_model->remove());
					break;
				
				case "spool":
					$this->spool_model->remove_spool();
					break;
				case "joints":
					$this->joints_model->remove_joints();
					break;
				case "random":
					$this->random_pipes_model->remove_random();
					break;
				case "material":
					$this->mat_takeoff_perspool_model->remove_material();
					break;
				case "insTo":
					$this->inst_takeoff_model->remove_ins();
					break;
				case "elecTo":
					$this->elec_takeoff_model->remove_elec();
					break;
				case "isoMech":
					$this->iso_mech_model->remove_isoMech();
					break;
				case "equipMech":
					$this->equip_mech_model->remove_equipMech();
					break;
				case "isoStruc":
					$this->iso_struc_model->remove_isoStruc();
					break;
				case "pieceStruc":
					$this->piece_struc_model->remove_pieceStruc();
					break;
				case "areaTbl":
					$this->area_model->remove();
					break;
				case "subarea":
					$this->sub_area_model->remove();
					break;
				case "fwbs":
					$this->ref_fwbs_model->remove();
					break;
				case "discTbl":
					$this->ref_discipline_model->remove();
					break;
				case "refJnt":
					$this->ref_jointtype_model->remove();
					break;
				case "roc":
					$this->ref_roctype_model->remove();
					break;
				case "rocTbl":
					$this->ref_roc_model->remove();
					break;
				case "work":
					$this->ref_workability_model->remove();
					break;
				case "tpo":
					$this->callback($this->tpo_hdr_model->remove());
					break;
				case "tpoDtl":
					$this->callback($this->tpo_dtl_model->remove());
					break;
				case "tdlmr":
					$this->callback($this->tdlmr_hdr_model->remove());
					break;
				case "tdlmrDtl":
					$this->callback($this->tdlmr_dtl_model->remove());
					break;
				case "tjwrr":
					$this->callback($this->tjwrr_hdr_model->remove());
					break;
				case "tjwrrDtl":
					$this->callback($this->tjwrr_dtl_model->remove());
					break;
				case "tjmif":
					$this->callback($this->tttemps_model->remove());
					break;
				case "tjwrr_upd":
					$this->callback($this->tjwrr_hdr_model->remove_upl());
					break;
				case "ttMTO":
					$this->callback($this->ttmto_model->remove());
					break;	
				case "treq":
					$this->callback($this->treqiss_hdr_model->remove());
					break;	
				case "treqDtl":
					$this->callback($this->treqiss_dtl_model->remove());
					break;
				case "p6":
					$this->callback($this->projwbs_model->remove());
					break;	
				case "materialRef":
					$this->callback($this->material_file_model->remove());
					break;
				case "spool_type":
					$this->load->model('webapps/qms/spool_type_model');
					$this->callback($this->spool_type_model->remove());
					break;	
				case "supplierRef":
					$this->callback($this->rsupplier_model->remove());
					break;	
				case "reason":
					 $this->load->model('webapps/qms/reason_model');
					$this->callback($this->reason_model->remove());
					break;	
				case "action":
					$this->load->model('webapps/qms/action_model');
					$this->callback($this->action_model->remove());
					break;
				case "matUtil":
					$this->load->model('webapps/qms/rmat_util_model');
					$this->callback($this->rmat_util_model->remove());
					break;
				case "rdisc":
					$this->load->model('webapps/qms/rdiscipline_model');
					$this->callback($this->rdiscipline_model->remove());
					break;
				case "rcontrolRef":
					$this->load->model('webapps/qms/rcontrol_model');
					$this->callback($this->rcontrol_model->remove());
					break;
				case "autoDel_ttisoStruc":
					$this->load->model('webapps/qms/tt_iso_struc_model');
					$this->callback($this->tt_iso_struc_model->autoDelete());
					break;
				case "ttisoStruc":
					$this->load->model('webapps/qms/tt_iso_struc_model');
					$this->callback($this->tt_iso_struc_model->remove_isoStruc());
					break;
				default:
					$this->iso_model->remove_iso();
					break;
			}
		}
	}
?>