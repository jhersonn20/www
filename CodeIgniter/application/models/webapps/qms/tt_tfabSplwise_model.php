<?php
    class TT_TfabSplwise_Model extends CI_Model {
    	private $tblName = "tfab_splwise";
        public function __construct(){
            parent::__construct();
        	$this->tempdb_sql = $this->load->database('tempdb_sql', true);
        }
		public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			
			if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
				$rowArr = $this->piping->query($sql)->result_array();	
			}else{
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
				$rowArr = $this->tempdb_sql->query($sql)->result_array();
			}
			return $rowArr;
			
		} // -- end of get_all function -- //
		public function export_TfabSplwise($where){
			$sql = "SELECT TOP 100 * FROM {$this->tblName}";
			return $this->tempdb_sql->query($sql)->result_array();
		} // -- end of export_TfabSplwise function -- //
		public function call_sp_query_tfabSplwise($tbadvance,$rswork,$aname,$cArealoc,$pno){
			$sql = "declare @result int;";
			$sql .= "exec @result = tempdb_sql.dbo.proc_tfab_splwise @tbadvance = {$tbadvance}, @rswork = '{$rswork}',@aname = {$aname},@cArealoc = {$cArealoc},@pno = {$pno};";
			$sql .= "select @result as return_value;";
			$query = $this->tempdb_sql->query($sql)->result_array();
			
			return $query;
		} // -- call_sp_query_tfabSplwise function -- //
	
	}