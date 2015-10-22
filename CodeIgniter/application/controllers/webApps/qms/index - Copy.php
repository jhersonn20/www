<?php
	class Index extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
            $this->load->helper(array('form','url','file','date','csv_helper'));
			$this->load->model('webapps/qms/iso_model');
			$this->load->model('webapps/qms/spool_model');
			$this->load->model('webapps/qms/joints_model');
			$this->load->model('webapps/qms/mat_takeoff_perspool_model');
			$this->load->model('webapps/qms/random_pipes_model');
			$this->load->model('webapps/qms/material_file_model');
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
			// $this->load->model('webapps/qms/tpo_dtl_model');
		}
		
		public function index(){
            $this->load->view('webApps/public/systems/qms/' . $this->uri->segment(5));
		}
		
		public function save_upload(){
			$fileParam = "files";
		    $uploadRoot = "C:/wamp/www/assets/uploads/";
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
		
		public function read($table, $method = "get_all", &$fieldVal = "", &$dbArr = array()){
            $rowArr = array();
            // $dbArr = array();
            $output = array("rows"=>"");
			$operatorArr = array("eq"=>" = '","neq"=>" != '","endswith"=>" LIKE '%","startswith"=>" LIKE '",
								 "contains"=>" LIKE '%","doesnotcontain"=>" NOT LIKE '%","gte"=>" >= '","gt"=>" > '",
								 "lte"=>" <= '","lt"=>" < '");
			$blankThis = array("eq","neq","endswith");
			
			if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
				foreach ($_GET['fieldF'] as $field => $val):
					$res = explode(";",$val);
					$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
				endforeach;

			// $result_array = eval("\$this->" . $table . "_model->" . $method . "((isset(\$fieldVal) ? \$fieldVal : ''))");
			$str = '\$this->' . $table . '_model->' . $method . '((isset(\$fieldVal) ? \$fieldVal : \'romel\'))';
			eval("\$result_array = \"$str\";");
			eval("\$result_array = $result_array;");

            foreach ($result_array as $r):
				if (isset($r['total']) && ($r['total'] == 0))
					break;
					
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
						
            // $output['rows'] = $dbArr;
            // $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		
		public function directCall($item = "",$param = ""){
            $rowArr = array();
            $dbArr = array();
            $output = array("rows"=>"");
			$operatorArr = array("eq"=>" = '","neq"=>" != '","endswith"=>" LIKE '%","startswith"=>" LIKE '",
								 "contains"=>" LIKE '%","doesnotcontain"=>" NOT LIKE '%","gte"=>" >= '","gt"=>" > '",
								 "lte"=>" <= '","lt"=>" < '");
			$blankThis = array("eq","neq","endswith");
			
			switch($item){
				case "tpo":
					$this->read("tpo_hdr", "get_all");
					break;
				case "spool":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}'";
					// if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						// foreach ($_GET['fieldF'] as $field => $val):
							// $res = explode(";",$val);
							// $fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						// endforeach;
// 					
					// $result_array = $this->spool_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            // foreach ($result_array as $r):
						// if (isset($r['total']) && ($r['total'] == 0))
							// break;
// 							
						// foreach ($r as $r2 => $v2):
							// if (is_object($v2)){
								// $date_array = (array) $v2;
								// $date_time = $date_array['date'];
								// $date_only = explode(" ", $date_time);
								// $r[$r2] = $date_only[0];
							// }
						// endforeach;
// 						
		                // array_push($dbArr, $r);
		            // endforeach;
					$this->read("spool", "get_all", $fieldVal, $dbArr);
					break;
				case "joints":
					if (isset($_GET['spool_no'])){
						$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and spool_no = '{$_GET['spool_no']}'";
						if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
							foreach ($_GET['fieldF'] as $field => $val):
								$res = explode(";",$val);
								$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
							endforeach;
						
						$result_array = $this->joints_model->get_all((isset($fieldVal) ? $fieldVal : ""));
			            foreach ($result_array as $r):
							if (isset($r['total']) && ($r['total'] == 0))
								break;
								
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
			        }
					break;
				case "random":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}'";
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->random_pipes_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
				case "material":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}'";
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->mat_takeoff_perspool_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
				case "item":
		            array_push($dbArr, array("item_code"=>"","description"=>""));
		            foreach ($this->material_file_model->get_all_dd() as $r):
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
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->area_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
				case "subarea":
					$fieldVal = "area_no = '{$_GET['area_no']}'";
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->sub_area_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
				case "fwbs":
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->ref_fwbs_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
				case "discTbl":
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->ref_discipline_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
				case "refJnt":
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->ref_jointtype_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
				case "roc":
					$fieldVal = "discipline_code = '{$_GET['discipline_code']}'";
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->ref_roctype_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
				case "rocTbl":
					$fieldVal = "roc_type = '{$_GET['roc_type']}'";
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->ref_roc_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
				case "work":
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->ref_workability_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
							$fieldVal .= " AND " . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
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
						//$isoWhere = "AND area_no = '{$_GET['area_no']}'";
					//$isoWhere = "spool.plant_no = '{$_POST['plant_no']}' AND spool.area_no = '{$_POST['area_no']}' AND spool.drawing_no = '{$_POST['drawing_no']}' AND spool.sheet_no = '{$_POST['sheet_no']}' AND spool.rev_no = '{$_POST['rev_no']}'";
					if ($_GET['rsOption'] > 0)
						$spoolWhere = "AND spool.workable_dt " . (($_GET['rsOption'] == 1) ? "!= NULL" : "= NULL");

					$fieldVal = "";
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal .= " AND " . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
		            /*foreach ($this->ogmr_model->getAll_export() as $r):
						$r['exists'] = ($r['file_attach'] != "" && file_exists("c:/wamp/www/assets/pdf/documents/" . $r['file_attach']) ? "&#10003" : "");
		                array_push($dbArr, $r);
		            endforeach;*/
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
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->inst_takeoff_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
				case "export_insTo":
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
						
		            foreach ($this->inst_takeoff_model->get_all_export((isset($fieldVal) ? $fieldVal : "")) as $r):
							
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
					$csv = array_to_csv($dbArr, "insto.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="insto.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;

					return true;
					break;
				case "elecTo":
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->elec_takeoff_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
				case "export_elecTo":
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
						
		            foreach ($this->elec_takeoff_model->get_all_export((isset($fieldVal) ? $fieldVal : "")) as $r):
							
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
				case "disc":
					$dbArr = $this->ref_discipline_model->get_all_dd();
					break;
				case "rocDD":
					$dbArr = $this->ref_roctype_model->get_all_dd();
					break;
				case "isoMech":
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->iso_mech_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
				case "equipMech":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}'";
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->equip_mech_model->get_all((isset($fieldVal) ? $fieldVal : ""));
					// echo $result_array;
					// return true;
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
				case "export_equipMech":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}'";
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
						
		            foreach ($this->equip_mech_model->get_all_export((isset($fieldVal) ? $fieldVal : "")) as $r):
							
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
					$csv = array_to_csv($dbArr, "equipMech.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="equipMech.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;

					return true;
					break;
				case "isoStruc":
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->iso_struc_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
				case "pieceStruc":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and area_loc = '{$_GET['area_loc']}'";
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->piece_struc_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
				case "export_pieceStruc":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and area_loc = '{$_GET['area_loc']}'";
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
						
		            foreach ($this->piece_struc_model->get_all_export((isset($fieldVal) ? $fieldVal : "")) as $r):
							
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
					$csv = array_to_csv($dbArr, "pieceStruc.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="pieceStruc.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;

					return true;
					break;
				case "psTo":
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
					
					$result_array = $this->ps_mto_model->get_all((isset($fieldVal) ? $fieldVal : ""));
		            foreach ($result_array as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
				case "export_pipTo":
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
						
		            foreach ($this->ps_mto_model->get_all_export((isset($fieldVal) ? $fieldVal : "")) as $r):
							
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
					$csv = array_to_csv($dbArr, "pipTo.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="pipTo.csv"');
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
				default:
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
							//$fieldVal[$res[0] . $operatorArr[$res[2]]] = $res[1] . (in_array($res[2], $blankThis) ? "" : "%");
						endforeach;
					/*echo $fieldVal;
					return true;
					var_dump($this->ogmr_model->getAll((isset($fieldVal) ? $fieldVal : array())));*/
		            foreach ($this->iso_model->get_all((isset($fieldVal) ? $fieldVal : "" /*array()*/)) as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
							
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
			}
            $output['rows'] = $dbArr;
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
			
			// if ($param == 'pwEngg'){
				// $csv = query_to_csv($this->tt_ttspl_model->get_all_query(), true, "invalid_engg_spl_asof_2013-11-14.csv");
			    // header('Content-Type: application/csv');
				// header('Content-Disposition: attachment; filename="invalid_engg_spl_asof_2013-11-14.csv"');
				// $csv = urldecode($csv);
// 	           
	            // echo $csv;
				// return true;
			// }
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
		            $output['rows'] = $dbArr;
		            $this->output->set_content_type('application/json')->set_output(json_encode($output));
					break;
				case "strMto":
					$dbArr = $this->str_pm_data_model->set();
		            $output['rows'] = $dbArr;
		            $this->output->set_content_type('application/json')->set_output(json_encode($output));
					break;
				case "areaTbl":		            										echo $this->area_model->set();
					//var_dump($this->area_model->is_entry_unique(array('area_no' => $_GET['area_no'])));
					break;
				case "subarea":
					echo $this->sub_area_model->set();
					break;
				case "fwbs":
					echo $this->ref_fwbs_model->set();
					break;
				case "discTbl":
					echo $this->ref_discipline_model->set();
					break;
				case "refJnt":
					echo $this->ref_jointtype_model->set();
					break;
				case "roc":
					echo $this->ref_roctype_model->set();
					break;
				case "rocTbl":
					echo $this->ref_roc_model->set();
					break;
				case "work":
					echo $this->ref_workability_model->set();
					break;
				default:
					$data = $this->iso_model->set_iso();
			}
		}
	
		public function remove($item = ""){
			switch($item){
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
				default:
					$this->iso_model->remove_iso();
					break;
			}
		}
	}
?>