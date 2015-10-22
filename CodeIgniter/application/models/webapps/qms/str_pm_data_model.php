<?php
    class Str_pm_data_Model extends CI_Model {
    	private $tblName = "str_pm_data";
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
        }
        
        public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			if ($_GET['value'] == ""){
				$sql = "SELECT (select count(*) FROM {$this->tblName} where {$where}) as total,* FROM {$this->tblName} where {$where} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				$rowArr = $this->piping->query($sql)->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){					
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				}else{
					$sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,* FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$rowArr = $this->piping->query($sql)->result_array();
				}
			}
			return $rowArr;
        }

		public function get_all_spool($where){
			$sql = "SELECT spool_no FROM {$this->tblName} where {$where}";
			return $this->piping->query($sql)->result_array();
		}
		
		public function set_spool_by_dtl($postInfo = array()){
        	$query = $this->piping->where(array('area_no' => $postInfo['area_no'],'drawing_no' => $postInfo['drawing_no'],'sheet_no' => $postInfo['sheet_no'],'rev_no' => $postInfo['rev_no']));
        	$query = $this->piping->update($this->tblName, $postInfo);
        	return $query;
		}
        
        public function set($rowArr = array()){
			$postInfo = array();
			if (sizeof($rowArr) > 0)
				$postInfo = $rowArr;
			else {
				foreach ($_GET as $key => $value) {
					if ($key == "PROGRESS_RECID" || $key == "index" || $key == "lastIndex" || $key == "remarks1" || $key == "idField" || $key == "_defaultId")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				$postInfo['logupdate'] = $postInfo['loguser'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['logdate'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['logtime'] = mdate("%H:%i:%s");
			}
			if (intval($_GET['index']) == 0){
				$sql = "DELETE FROM {$this->tblName}";
				$query = $this->piping->query($sql);
			}

            if ($_GET['PROGRESS_RECID'] == "0"){
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}else {
            	$query = $this->piping->where('PROGRESS_RECID', $_GET['PROGRESS_RECID']);
            	$query = $this->piping->update($this->tblName, $postInfo);
			}
        }

		public function call_sp(){
			$sql = "declare @result int;";
			$sql .= "exec @result = piping.dbo.strMTO_sp;";
			$sql .= "select @result as return_value;";
			$query = $this->piping->query($sql)->result_array();
			
			return $query;
		}
		
		public function remove_spool(){
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
    }
?>