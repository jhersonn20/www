<?php
    class Tpntg_Mat_Spl_Model extends CI_Model {
    	private $tblName = "tpntg_mat_spl";
        public function __construct(){
            parent::__construct();
        	$this->qms_pip = $this->load->database('qms_pip', true);
        }
        
        public function get_all($where){
        	//$this->call_sp_query_spl_wise((int) $_GET['tbAdvance'], $_GET['rswork'],$_GET['aname'],$area);
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;

			// if ($_GET['value'] == ""){
				// $sql = "SELECT (select count(*) FROM {$this->tblName} where {$where}) as total,* FROM {$this->tblName} where {$where} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->qms_pip->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){				

					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->qms_pip->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,* FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->qms_pip->query($sql)->result_array();
				// }
			// }

			return $rowArr;
        }

		public function export_ttupl($where){
			$sql = "SELECT TOP 100 * FROM {$this->tblName}";
			return $this->qms_pip->query($sql)->result_array();
		}
		
		public function export_tpntg_mat_spl($where = ""){
			if ($where != "")
				$where = ("WHERE " . $where);
			
			$sql = "SELECT TOP 100 * FROM {$this->tblName}";
			$rowArr = $this->qms_pip->query($sql)->result_array();
			return $rowArr;
        }
		
		public function set_spool_by_dtl($postInfo = array()){
        	$query = $this->qms_pip->where(array('area_no' => $postInfo['area_no'],'drawing_no' => $postInfo['drawing_no'],'sheet_no' => $postInfo['sheet_no'],'rev_no' => $postInfo['rev_no']));
        	$query = $this->qms_pip->update($this->tblName, $postInfo);
        	return $query;
		}
        
        public function set($rowArr = array()){
			$postInfo = array();
			if (sizeof($rowArr) > 0)
				$postInfo = $rowArr;
			else {
				foreach ($_POST as $key => $value) {
					if ($key == "PROGRESS_RECID" || $key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				//$postInfo['logupdate'] = $postInfo['loguser'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['logdate'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['logtime'] = mdate("%H:%i:%s");
			}
			if (intval($_POST['index']) == 0){
				$sql = "DELETE FROM {$this->tblName}";
				$query = $this->qms_pip->query($sql);
			}

            if ($_POST['PROGRESS_RECID'] == "0"){
				$query = $this->qms_pip->set($postInfo);
				$query = $this->qms_pip->insert($this->tblName);
			}else {
            	$query = $this->qms_pip->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->qms_pip->update($this->tblName, $postInfo);
			}
			
			return $query;
        }

		public function call_sp(){
			$sql = "declare @result int;";
			$sql .= "exec @result = qms_pip.dbo.ttUpdateFab;";
			$sql .= "select @result as return_value;";
			$query = $this->qms_pip->query($sql)->result_array();
			
			return $query;
		}
		
		public function call_upl_tpntg(){
			$sql = "declare @result int = 0;";			
			$sql .= "exec @result = qms_pip.dbo.upl_tpntg_mat_spl @ip_filename = 'sample';";
			$sql .= "select @result as return_value;";
			return $this->qms_pip->query($sql)->result_array();
		}

		public function call_sp_query_ttisoSpool($tbadvance,$rswork,$aname,$cArealoc,$pno){
			$sql = "declare @result int;";
			$sql .= "exec @result = tempdb_sql.dbo.call_sp_ttisoSpool @tbadvance = {$tbadvance}, @rswork = '{$rswork}',@aname = {$aname},@cArealoc = {$cArealoc},@pno = {$pno};";
			$sql .= "select @result as return_value;";
			$query = $this->qms_pip->query($sql)->result_array();
			
			return $query;
		}
		
		public function remove_spool(){
        	$query = $this->qms_pip->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->qms_pip->delete($this->tblName);
			return $query;
		}
    }
?>