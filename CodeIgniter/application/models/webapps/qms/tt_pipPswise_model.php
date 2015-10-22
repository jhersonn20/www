<?php
    class Tt_PipPswise_Model extends CI_Model {
    	private $tblName = "tt_pipPswise";
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
		public function call_procQuery_pipPswise($tbadvance,$rswork,$cbper1, $cbper2, $aname, $cArealoc,$pno,$detail){
			$sql = "declare @result int;";
			$sql .= "exec @result = tempdb_sql.dbo.proc_query_pipPswise @tbadvance = {$tbadvance}, @rswork = {$rswork}, @cbper1 = {$cbper1}, @cbper2 = {$cbper2},@aname = '{$aname}',@cArealoc = '{$cArealoc}',@pno = '{$pno}',@detail = '{$detail}';";
			$sql .= "select @result as return_value;";
			$query = $this->tempdb_sql->query($sql)->result_array();
			
			return $query;
		} // -- end of function
		public function export_pswise_wDetail($where){
			$sql = "SELECT TOP 100 percent_stat,ps_drawing,ps_code,ref_rec_date,ref_iss_date,ps_type,plant_no,area_no,drawing_no,rev_no,sheet_no,lbsb,matl_type,piping_class,p_timing,area_desc, mat_tag,spool_no,p_no,paint_reqd,mat_tag2,com_code,ps_class,ps_specs,category,wt_fab,ref_rec_qty,ref_rec_result,supp_desc,cjmifno FROM {$this->tblName}";
			return $this->tempdb_sql->query($sql)->result_array();
		}
		public function export_pswise_wOdetail($where){
			$sql = "SELECT TOP 100 percent_stat,ps_drawing,percent_stat,ref_rec_date,ref_iss_date,ps_type,plant_no,area_no,drawing_no,rev_no,sheet_no,lbsb,matl_type,piping_class,p_timing,area_desc, mat_tag,spool_no,p_no,paint_reqd FROM {$this->tblName}";
			return $this->tempdb_sql->query($sql)->result_array();
		}
	}