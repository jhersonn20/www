<?php
    class Tdlmr_hdr_model extends CI_Model {
    	private $tblName = "Tdlmr_hdr";
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
        }

        public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			if ($_GET['value'] == ""){
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				$rowArr = $this->piping->query($sql)->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				}else{
					$sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$rowArr = $this->piping->query($sql)->result_array();
				}
			}
			return $rowArr;
        }

        public function set(){
			$postInfo = array();
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
			
            if ($_POST['PROGRESS_RECID'] > 0){
            	if (sizeof($_POST) > 3){				
	            	$query = $this->is_finalized(array("PROGRESS_RECID" => $_POST['PROGRESS_RECID']));
	            	if (gettype($query) == 'boolean'){
						if ($query)
							return "Cannot Update.\nPO is already finalized.";
					}else
						return $query;
				}
					
            	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->piping->update($this->tblName, $postInfo);
			}else{
		        $ci =& get_instance();
		        $ci->load->model('webapps/qms/rcontrol_model');
	            $control_no = $ci->rcontrol_model->get_by_field(array("trancode"=>"DLMR", "disc_code"=>""));
	            if (sizeof($control_no) == 0)
	            	return "PO does not exists in 'Control #' reference.";
				
            	$query = $this->is_entry_unique(array("dlmr_no" => $_POST['dlmr_no']));
            	if (gettype($query) == 'boolean'){
					if (!$query)
						return "Record already exist!";
				}else
					return $query;
				
	            $control_no = $ci->rcontrol_model->update_control("inc", "DLMR");
            	if (gettype($control_no) == 'boolean'){
					if (!$control_no)
						return "'RControl': Record not exist!";
				}else
					return $control_no;
				
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}
			
			return $query;
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
	        } else {
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
	        $ci =& get_instance();
	        $ci->load->model('webapps/qms/rcontrol_model');
            $control_no = $ci->rcontrol_model->get_by_field(array("trancode"=>"DLMR", "disc_code"=>""));
			// var_dump($control_no);
        	// $query = $this->piping->select('(control_no - 1) as control_no')->from($this->tblName)->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
			// $query = $this->piping->get();
			$post_control_no = intval(substr($_POST['dlmr_no'], 3,6));
			
			if ($post_control_no != ($control_no[0]['control_no'] - 1))
				return "Cannot Delete.\nA higher PO No. exist.";
			
	        $control_no = $ci->rcontrol_model->update_control("dec", "DLMR");
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
    }
?>