<?php
    class Tt_uplps_Model extends CI_Model {
    	private $tblName = "tt_uplps";
        public function __construct(){
            parent::__construct();
        	$this->tempdb_sql = $this->load->database('tempdb_sql', true);
        }
        
        public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			if ($_GET['value'] == ""){
				$sql = "SELECT (select count(*) FROM {$this->tblName} where {$where}) as total,* FROM {$this->tblName} where {$where} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				$rowArr = $this->tempdb_sql->query($sql)->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){					
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->tempdb_sql->query($sql)->result_array();					
				}else{
					$sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,* FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$rowArr = $this->tempdb_sql->query($sql)->result_array();
				}
			}
			return $rowArr;
        }

		public function get_all_spool($where){
			$sql = "SELECT spool_no FROM {$this->tblName} where {$where}";
			return $this->tempdb_sql->query($sql)->result_array();
		}
		
		public function set_spool_by_dtl($postInfo = array()){
        	$query = $this->tempdb_sql->where(array('area_no' => $postInfo['area_no'],'drawing_no' => $postInfo['drawing_no'],'sheet_no' => $postInfo['sheet_no'],'rev_no' => $postInfo['rev_no']));
        	$query = $this->tempdb_sql->update($this->tblName, $postInfo);
        	return $query;
		}
        
        public function set($rowArr = array()){
			$postInfo = array();
			if (sizeof($rowArr) > 0)
				$postInfo = $rowArr;
			else {
				foreach ($_POST as $key => $value) {
					if ($key == "PROGRESS_RECID" || $key == "index" || $key == "lastIndex" || $key == "remarks1" || $key == "idField" || $key == "_defaultId")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				$postInfo['logupdate'] = $postInfo['loguser'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['logdate'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['logtime'] = mdate("%H:%i:%s");
			}
			if (intval($_POST['index']) == 0){
				$sql = "DELETE FROM {$this->tblName}";
				$query = $this->tempdb_sql->query($sql);
			}

            if ($_POST['PROGRESS_RECID'] == "0"){
				$query = $this->tempdb_sql->set($postInfo);
				$query = $this->tempdb_sql->insert($this->tblName);
			}else {
            	$query = $this->tempdb_sql->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->tempdb_sql->update($this->tblName, $postInfo);
			}
			
			if (intval($_POST['index']) == intval($_POST['lastIndex']))
				return $this->call_sp();
			else
				return $query;
        }

		public function call_sp(){
			$sql = "declare @result int;";
			$sql .= "exec @result = tempdb_sql.dbo.mechMTO_sp;";
			$sql .= "select @result as return_value;";
			$query = $this->tempdb_sql->query($sql)->result_array();
			
			return $query;
		}
		
		public function remove_spool(){
        	$query = $this->tempdb_sql->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->tempdb_sql->delete($this->tblName);
			return $query;
		}
    }
?>