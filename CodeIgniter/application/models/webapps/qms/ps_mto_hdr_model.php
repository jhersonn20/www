<?php
    class Ps_mto_hdr_Model extends CI_Model {
    	private $tblName = "ps_mto_hdr";
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
        }
        
        public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;

			// if ($_GET['value'] == ""){
				// $sql = "SELECT (select count(*) FROM {$this->tblName} where {$where}) as total,* FROM {$this->tblName} where {$where} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->piping->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} where {$where}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,* FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			// }
			return $rowArr;
        }
        
        public function get_all_export($where = ""){
        	if ($where == "")
				$sql = "select (select count(*) FROM {$this->tblName}) as total,* FROM {$this->tblName} order by {$_GET['fieldS']} {$_GET['dir']}";
			else
				$sql = "select (select count(*) FROM {$this->tblName} where {$where}) as total,* FROM {$this->tblName} where {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
			$rowArr = $this->piping->query($sql)->result_array();
			return $rowArr;
        }
        public function get_all_export2($where = ""){
			if ($where != "")
				$where = ("WHERE " . $where);
			
			$sql = "select plant_no,area_no,drawing_no,sheet_no,rev_no,(drawing_no + '-' + ps_code + '-' + ps_type) as PS_CODE,lbsb,matl_type,piping_class,p_no,p_timing,area_desc FROM {$this->tblName} {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
			$rowArr = $this->piping->query($sql)->result_array();
			return $rowArr;
        }
        public function set(){			$postInfo = array();
			foreach ($_POST as $key => $value) {
				if ($key == "PROGRESS_RECID")
					continue;
				$postInfo[$key] = mysql_real_escape_string($value);
			}
			$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d");
			$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
            if ($_GET['PROGRESS_RECID'] == "0"){
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}else{
            	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->piping->update($this->tblName, $postInfo);
			}
			
			return $query;
        }

		public function call_sp($sql_insert = "", $type = ""){
			$sql = "declare @result int, @sqlString as varchar(max);";
			$sql .= "set @sqlString = '" . str_replace("'", "''", $sql_insert) . "';";
			switch ($type) {
				case 'psFogMto':
					$sql .= "exec @result = piping.dbo.psFogMTO_sp @sqlString;";
					break;
				case 'psPcdMto':
					$sql .= "exec @result = piping.dbo.psPcdMTO_sp @sqlString;";
					break;
				case 'psGlobalMto':
					$sql .= "exec @result = piping.dbo.psGlobalMTO_sp @sqlString;";
					break;
				case 'psFabMto':
					$sql .= "exec @result = piping.dbo.psFabMTO_sp @sqlString;";
					break;
				default:
					$sql .= "exec @result = piping.dbo.psMTO_sp @sqlString;";
					break;
			}
			$sql .= "select  @result as return_value;";
			$query = $this->piping->query($sql)->result_array();
			
			return $query;
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
        
        public function update($postInfo = array(), $criteria = array()){
        	if (sizeof($postInfo) == 0){
				foreach ($_POST as $key => $value) {
					if ($key == "PROGRESS_RECID" || $key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_time'] = mdate("%H:%i:%s");
				$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
			}

        	$query = $this->piping->where($criteria);
        	$query = $this->piping->update($this->tblName, $postInfo);
			
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
		
		public function remove($postInfo = array()){
			if (sizeof($postInfo) == 0){
				foreach ($_POST as $key => $value) {
					if ($key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId" || $key == "total" || $key == "rownum" || $key == "module")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_time'] = mdate("%H:%i:%s");
				$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				// $postInfo['PROGRESS_RECID'] = $_POST['PROGRESS_RECID'];
			}
			
        	$query = $this->piping->where('PROGRESS_RECID', $postInfo['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
    }
?>