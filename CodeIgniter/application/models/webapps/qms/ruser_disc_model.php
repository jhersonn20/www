<?php
    class Ruser_disc_model extends CI_Model {
    	private $tblName = "ruser_disc";
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
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} where {$where}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
					// $sql = "SELECT * FROM {$this->tblName} t where {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			// }
			return $rowArr;
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
					if ($key == "PROGRESS_RECID" || $key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				if (sizeof($_POST) > 3){			
					$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
					$postInfo['log_time'] = mdate("%H:%i:%s");
				}
				$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				$PROGRESS_RECID = $_POST['PROGRESS_RECID'];
			}else
				$PROGRESS_RECID = $postInfo['PROGRESS_RECID'];
						
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
				
            	if (sizeof($_POST) == 5){ 
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
					
            	$query = $this->piping->where('PROGRESS_RECID', $PROGRESS_RECID);
            	$query = $this->piping->update($this->tblName, $postInfo);
				if (!$query)
					return "Update failed!";
					
            	if (sizeof($_POST) == 5){        	
					$sql = "declare @result int = 0;";
					$sql .= "exec @result = piping.dbo.proc_whse_sp @PROGRESS_RECID = {$PROGRESS_RECID}, @disc_code = '{$postInfo['disc_code']}';";			
					$sql .= "select @result as return_value;";
					$query = $this->piping->query($sql)->result_array();
					if(!$query)
						return "Update Failed. Procedure Warehouse!";
            	}
				
				$query = $this->auditTrail("MATERIAL REQUEST-PIPING (HDR)","EDIT");
            					
			}else{				
		        $ci =& get_instance();
		        $ci->load->model('webapps/qms/rcontrol_model');
	            $control_no = $ci->rcontrol_model->get_by_field(array("trancode"=>"JMIF", "disc_code"=>$postInfo['disc_code']));
	            if (sizeof($control_no) == 0)
	            	return "PO does not exists in 'Control #' reference.";
	            	
            	$query = $this->is_entry_unique(array("jmif_no" => $_POST['jmif_no'], "disc_code" => $postInfo['disc_code']));
            	if (gettype($query) == 'boolean'){
					if (!$query)
						return "Record already exist!";
				}else
					return $query;
				
				return "Record already exist!Sample";
						
	            $control_no = $ci->rcontrol_model->update_control("inc", array("trancode"=>"JMIF", "disc_code"=>$postInfo['disc_code']));
            	if (gettype($control_no) == 'boolean'){
					if (!$control_no)
						return "'RControl': Record not exist!";
				}else
					return $control_no;
				
				$postInfo['whse_prep'] = 0;
					
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
				if (!$query)
					return "Insert failed!";
				
				$query = $this->auditTrail("MATERIAL REQUEST-PIPING (HDR)","ADD");
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