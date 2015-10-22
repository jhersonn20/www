<?php
    class ttUpl2_Model extends CI_Model {
    	private $tblName = "ttUpl2";
        public function __construct(){
            parent::__construct();
        	$this->tempdb_sql = $this->load->database('tempdb_sql', true);
        }
        
        public function get_all($where){
        	//$this->call_sp_query_spl_wise((int) $_GET['tbAdvance'], $_GET['rswork'],$_GET['aname'],$area);
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;

			// if ($_GET['value'] == ""){
				// $sql = "SELECT (select count(*) FROM {$this->tblName} where {$where}) as total,* FROM {$this->tblName} where {$where} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->tempdb_sql->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){				

					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->tempdb_sql->query($sql)->result_array();
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,* FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->tempdb_sql->query($sql)->result_array();
				// }
			// }

			return $rowArr;
        }

		public function export_ttUpl2($where){
			$sql = "SELECT TOP 100 * FROM {$this->tblName}";
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
			$sql .= "exec @result = qms_pip.dbo.tempdb_sqlWeld_sp;";
			$sql .= "select @result as return_value;";
			$query = $this->qms_pip->query($sql)->result_array();
			
			return $query;
		}

		public function call_sp_query_ps_wise($tbadvance,$rswork,$cbper1, $cbper2, $aname, $cArealoc,$pno,$detail){
			$sql = "declare @result int;";
			$sql .= "exec @result = piping.dbo.proc_query_ps_wise @tbadvance = {$tbadvance}, @rswork = {$rswork}, @cbper1 = {$cbper1}, @cbper2 = {$cbper2},@aname = '{$aname}',@cArealoc = '{$cArealoc}',@pno = '{$pno}',@detail = '{$detail}';";
			$sql .= "select @result as return_value;";
			$query = $this->tempdb_sql->query($sql)->result_array();
			
			return $query;
		}
		public function export_sp_ps_wise($tbadvance,$rswork,$cbper1, $cbper2, $aname, $cArealoc,$pno){
			$sql = "declare @result int;";
			$sql .= "exec @result = piping.dbo.proc_query_ps_wise @tbadvance = {$tbadvance}, @rswork = {$rswork}, @cbper1 = {$cbper1}, @cbper2 = {$cbper2},@aname = '{$aname}',@cArealoc = '{$cArealoc}',@pno = '{$pno}';";
			$sql .= "select @result as return_value;";
			$query = $this->tempdb_sql->query($sql)->result_array();
			
			return $query;
		}
		
		public function remove_spool(){
        	$query = $this->qms_pip->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->qms_pip->delete($this->tblName);
			return $query;
		}
    }
?>