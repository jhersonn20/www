<?php
    class Treqiss_hdr_model extends CI_Model {
    	private $tblName = "treqiss_hdr";
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
        	$this->qms_atrail = $this->load->database('qms_atrail', true);
        }
		  
        public function get_all($where){			
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			// if ($_GET['value'] == ""){
				// $sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->piping->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} WITH(INDEX(IDX_NC_Treqiss_hdr_disc_code)) where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} WITH(INDEX(IDX_NC_Treqiss_hdr_disc_code)) where {$where}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
					//$sql = "SELECT * FROM {$this->tblName} t where {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			// }
			return $rowArr;
        }
        public function get_all_mod($where){			
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			// if ($_GET['value'] == ""){
				// $sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->piping->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} where {$where} ) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
					//$sql = "SELECT * FROM {$this->tblName} t where {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			// }
			return $rowArr;
        }
        public function get_jmifInfo(){
        		$sql = "SELECT jmif_no,jmif_date,req_by FROM {$this->tblName}  WHERE PROGRESS_RECID IN ({$_GET['listOfSelected']})";
        		$rowArr = $this->piping->query($sql)->result_array();
        		
        		return $rowArr;
        }
        public function getAll($criteria){
        	if (isset($criteria)){
	        	if (is_array($criteria))
	        		return $this->piping->get_where($this->tblName, $criteria)->result_array();
	        	else {
		        	$sql = "select * from {$this->tblName} where {$criteria}";
		        	return $this->piping->query($sql)->result_array();
		        }
		    }
        }

		public function call_sp(){
			$sql = "declare @result int = 0;";			
			$sql .= "exec @result = piping.dbo.uplReq_sp @ip_loguser = '{$_POST['loguser']}', @ip_disc_code = '{$_POST['disc_code']}', @ip_module = 'request', @ip_filename = '{$_POST['fileNames']}';";
			$sql .= "select @result as return_value;";
			$query = $this->piping->query($sql)->result_array();
			
			return $query[0]['return_value'];
		}
        
        public function set($postInfo = array()){
        	$PROGRESS_RECID = 0;
        	if (sizeof($postInfo) == 0){
				foreach ($_POST as $key => $value) {
					if ($key == "PROGRESS_RECID" || $key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId" || $key == "total" || $key == "rownum")
						continue;
					$postInfo[$key] = (trim($value) == "" ? NULL : mysql_real_escape_string($value));
				}
				if (sizeof($_POST) > 3){			
					$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
					$postInfo['log_time'] = mdate("%H:%i:%s");
				}
				$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				$PROGRESS_RECID = $_POST['PROGRESS_RECID'];
			}else {
				foreach ($postInfo as $key => $value) {
					$postInfo[$key] = (trim($value) == "" ? NULL : mysql_real_escape_string($value));					
				}
				$PROGRESS_RECID = $postInfo['PROGRESS_RECID'];
			}
			
	        $ci =& get_instance();
	        $ci->load->model('webapps/qms/rdiscipline_model');
	        $returnValue = $ci->rdiscipline_model->get_by_field(array("disc_code"=>$postInfo['disc_code']));
			$postInfo['disc_desc'] = $returnValue[0]['disc_desc'];
			
            if ($PROGRESS_RECID > 0){				
            	$query = $this->is_entry_unique(array("PROGRESS_RECID" => $PROGRESS_RECID));
            	if (gettype($query) == 'boolean'){
					if ($query)
						return "Cannot update jmif.\nNo record found.";
				}else
					return $query;
				
            	if (sizeof($_POST) < 6){ 
	            	$query = $this->is_finalized(array("PROGRESS_RECID" => $PROGRESS_RECID));
	            	if (gettype($query) == 'boolean'){
						if ($query){
							// return "Cannot Update.\nPO is already finalized.";
							$ci =& get_instance();
		        			$ci->load->model('webapps/qms/treqiss_dtl_model');
							$query = $ci->treqiss_dtl_model->is_entry_unique(array("jmif_no"=>$postInfo['jmif_no'],"iss_qty >"=>"0","disc_code"=>$postInfo['disc_code']));
			            	if (gettype($query) == 'boolean'){
								if (!$query)
									return "Cannot Unfinalized.\nMaterial Issuance exists in detail.";
							}else
								return $query;
					        $postInfo['jmif_status'] = "";
						}else{
					        $postInfo['jmif_status'] = "OPEN";
						}
					}else
						return $query;					
				}
				
		        // $ci =& get_instance();
		        // $ci->load->model('webapps/qms/rcontrol_model');				
	            // $control_no = $ci->rcontrol_model->get_by_field(array("trancode"=>"JMIF", "disc_code"=>$postInfo['disc_code']));
// 				
				// if (strpos($control_no[0]['prefix'], $postInfo['jmif_no']) !== false)
					// return "Cannot finalize/unfinalize.\nMRR is on Direct Withdraw mode.";
										
            	if (sizeof($_POST) <= 6){        	
					$sql = "declare @result int = 0;";
					$sql .= "exec @result = piping.dbo.proc_whse_sp @PROGRESS_RECID = {$PROGRESS_RECID}, @disc_code = '{$postInfo['disc_code']}';";			
					$sql .= "select @result as return_value;";
					$query = $this->piping->query($sql)->result_array();
					if(!$query)
						return "Update Failed. Procedure Warehouse!";
            	}
				
            	$query = $this->piping->where('PROGRESS_RECID', $PROGRESS_RECID);
            	$query = $this->piping->update($this->tblName, $postInfo);
				if (!$query)
					return "Update failed!";
				
				$query = $this->auditTrail("MATERIAL REQUEST-PIPING (HDR)","EDIT");
            					
			}else{				
		        $ci =& get_instance();
		        $ci->load->model('webapps/qms/rcontrol_model');
	            $control_no = $ci->rcontrol_model->get_by_field(array("trancode"=>"JMIF", "disc_code"=>$postInfo['disc_code']));
	            if (sizeof($control_no) == 0)
	            	return "JMIF does not exists in 'Control #' reference.";
	            	
            	$query = $this->is_entry_unique(array("jmif_no" => $postInfo['jmif_no'], "disc_code" => $postInfo['disc_code']));
            	if (gettype($query) == 'boolean'){
					if (!$query)
						return "Record already exist!";
				}else
					return $query;
										
	            $control_no = $ci->rcontrol_model->update_control("inc", array("trancode"=>"JMIF", "disc_code"=>$postInfo['disc_code']));
            	if (gettype($control_no) == 'boolean'){
					if (!$control_no)
						return "'RControl': Record not exist!";
				}else
					return $control_no;
				
				// $postInfo['whse_prep'] = 0;
				// $postInfo['sub_date_client'] = ($postInfo['sub_date_client'] == "" ? NULL : $postInfo['sub_date_client']);
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
				if (!$query)
					return "Insert failed!";
				else 
					$PROGRESS_RECID = $this->piping->insert_id();
				
				$query = $this->auditTrail("MATERIAL REQUEST-PIPING (HDR)","ADD");
			}

			switch (strtolower($postInfo['disc_code'])) {
				case 'strl':					
					break;				
				default:
					if ($postInfo['whse_prep'] == 1){
				        // $ci =& get_instance();
				        // $ci->load->model('webapps/qms/mat_takeoff_perspool_model');
						$sql = "update t 
									set t.fog_submitted_dt = '{$postInfo['sub_date_fog']}', 
										t.client_submitted_dt = '{$postInfo['sub_date_client']}'
									from dbo.mat_takeoff_perspool t
									inner join dbo.treqiss_dtl t2
									on t.plant_no = t2.plant_no and
									   t.area_no = t2.area_no and
									   t.drawing_no = t2.drawing_no and
									   t.sheet_no = t2.sheet_no and
									   t.rev_no = t2.rev_no and
									   t.spool_no = t2.spool_no and
									   t.commodity_code = t2.commodity_code and
									   t.size = t2.size and
									   t.isc_no = t2.isc_no
								    where t2.jmif_no = '{$postInfo['jmif_no']}' and
								          t2.disc_code = '{$postInfo['disc_code']}'";
			            $query = $this->piping->query($sql);				
					}
					break;
			}
			
			return $query;
        }

		public function auditTrail($tranDesc = "", $type = ""){        	
			$sql = "declare @result int = 0;";
			$sql .= "exec @result = qms_atrail.dbo.auditTrail_sp @syscode = 'QMS', @userid = '{$_POST['log_user']}', @trandesc = '{$tranDesc}', @type = '{$type}';";			
			$sql .= "select @result as return_value;";
			$query = $this->qms_atrail->query($sql)->result_array();
			
			return $query[0]['return_value'];			
		}
		
	    public function is_entry_unique($criteria = '') {
            $this->piping->select('count(*) as counter')->from($this->tblName)->where($criteria);
			$query = $this->piping->get();
			$result = $query->result();

	        if ($result !== FALSE) {
	            if ($result[0]->counter > 0) {
	                return FALSE;
	            } else {
	                return TRUE;
	            }
	        }else {
	            return 'Error in retrieving criteria.';
	        }
	    }

	    public function is_finalized($criteria = '') {
            $this->piping->select('finalized')->from($this->tblName)->where($criteria);
			$query = $this->piping->get();
			$result = $query->result();

	        if ($result !== FALSE) {
	            if ($result[0]->finalized == 0 || $result[0]->finalized == null) {
	                return FALSE;
	            } else {
	                return TRUE;
	            }
	        } else {
	            return 'Error in retrieving criteria.';
	        }
	    }
		
		public function remove(){
			// $postInfo = array("loguser" => $_POST['loguser']);
			// if ($_POST['PROGRESS_RECID'] > 0)
				// $postInfo['PROGRESS_RECID'] = $_POST['PROGRESS_RECID'];
				
	        $ci =& get_instance();
	        $ci->load->model('webapps/qms/treqiss_dtl_model');
    		$query = $ci->treqiss_dtl_model->is_entry_unique(array("jmif_no"=>$_POST['jmif_no'], "iss_qty >"=>"0", "disc_code"=>$_POST['disc_code']));
        	if (gettype($query) == 'boolean'){
				if (!$query)
					return "Delete failed. Issued materials exist!";
			}else
				return $query;
			
	        $ci =& get_instance();
	        $ci->load->model('webapps/qms/rcontrol_model');
    		$query = $ci->rcontrol_model->is_entry_unique(array("trancode"=>"JMIF", "disc_code"=>$_POST['disc_code']));
        	if (gettype($query) == 'boolean'){
				if ($query)
					return "Delete failed. JMIF Control No. reference does not exist!";
			}else
				return $query;
			
            $control_no = $ci->rcontrol_model->get_by_field(array("trancode"=>"JMIF", "disc_code"=>$_POST['disc_code']));
			$post_control_no = (int)str_replace($control_no[0]['suffix'] . "-", "", str_replace($control_no[0]['prefix'] . "-", "", $_POST['jmif_no']));
			
			if ($post_control_no != ($control_no[0]['control_no'] - 1))
				return "Cannot Delete.\nA higher PO No. exist.";	
						
	        $ci =& get_instance();
	        $ci->load->model('webapps/qms/treqiss_dtl_model');
    		$query = $ci->treqiss_dtl_model->remove(array("jmif_no"=>$_POST['jmif_no'],"disc_code"=>$_POST['disc_code']));
			if (!$query)
				return "Cannot Delete. Failed on JMIF Detail.";
			
    		$query = $this->piping->where("PROGRESS_RECID", $_POST['PROGRESS_RECID']);        		
    		$query = $this->piping->delete($this->tblName);
			if (!$query)
				return "Delete failed!";
			
	        $query = $ci->rcontrol_model->update_control("dec", array("trancode"=>"JMIF", "disc_code"=>$_POST['disc_code']));
			if (!$query)
				return "Update failed. Control No.!";
				
			$query = $this->auditTrail("MATERIAL REQUEST-PIPING (HDR)","DELETE");
						
			return $query;
		}
    }
?>