<?php
    class Twhse_Str_Mat_Model extends CI_Model {
    	private $tblName = "twhse_str_mat";
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
        public function export_modified(){
        	$sql = "SELECT TOP 500 area_no,drawing_no,sheet_no,rev_no,um,piece_no,qty,piece_desc,client_refno,client_refdate,rcvd_date,rfi_no,rfi_date,qcmrir_no,qcmrir_date,iss_qty,issued_date,jmif_no,rcvd_by,direct_with,dlmr_jwrr,excess FROM {$this->tblName}";
			$rowArr = $this->piping->query($sql)->result_array();
			
			return $rowArr;
        }
        public function getFirst($criteria){
        	if (isset($criteria)){
	        	if (is_array($criteria))
	        		return $this->piping->get_where($this->tblName, $criteria)->result_array();
	        	else {
		        	$sql = "select top (1) * from {$this->tblName} where {$criteria}";
		        	return $this->piping->query($sql)->result_array();
		        }
		    }
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

		public function get_by_field($fields){
			$sql = "SELECT (prefix + (case when (prefix = '') then '' else '-' end) + RIGHT('00000' + convert(varchar, control_no),6) + (case when (suffix = '') then '' else '-' end) + suffix) as pono, control_no, prefix, suffix from {$this->tblName} where trancode = ? and disc_code = ?";
			return $this->piping->query($sql, $fields)->result_array();
		}
        
        public function set($postInfo = array()){
        	$PROGRESS_RECID = 0;
        	if (sizeof($postInfo) == 0){
				foreach ($_POST as $key => $value) {
					if ($key == "PROGRESS_RECID" || $key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
				$PROGRESS_RECID = $_POST['PROGRESS_RECID'];
			}else {
				$PROGRESS_RECID = $postInfo['PROGRESS_RECID'];
				unset($postInfo['PROGRESS_RECID']);
			}
			// $postInfo['logtime'] = mdate("%H:%i:%s");
			
            if ($_POST['PROGRESS_RECID'] == "0"){
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}else{
            	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->piping->update($this->tblName, $postInfo);
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
        
        public function update_control($type, $criteria = array()){
            $this->piping->select('control_no')->from($this->tblName)->where($criteria);
			$query = $this->piping->get();
			$result = $query->result();
			
	        if ($result !== FALSE) {
	            if ($result[0]->control_no > 0) {
		        	$query = $this->piping->where($criteria);
		        	$query = $this->piping->update($this->tblName, array("control_no" => ($result[0]->control_no + (($type == "inc") ? 1 : -1))));
	                return TRUE;
	            } else {
	                return FALSE;
	            }
	        } else {
	            return 'Error in retrieving criteria.';
	        }
        }
		
		public function remove(){
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
    }
?>