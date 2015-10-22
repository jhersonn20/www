<?php
    class Iso_Model extends CI_Model {
    	private $tblName = "iso";
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
				//if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// echo $sql;
					// return true;
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			}
			return $rowArr;
        }
		public function modified_getAll($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			if ($where != ""){
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} where {$where}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
				$rowArr = $this->piping->query($sql)->result_array();		
			}else{
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} ) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} ) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
				$rowArr = $this->piping->query($sql)->result_array();
			}
			return $rowArr;
        }
		 public function get_all_groupBy($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;			
			
			$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(DISTINCT({$where})) FROM {$this->tblName}) as total,{$where},row_number() over ( order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} group by {$where}) t  where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();	
			
			return $rowArr;
        }
		
		 public function get_all2($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;			
			
			$sql ="select t2.percent_workable,t2.ref_rec_date,t2.ref_iss_date,t2.spool_no,
				   t.plant_no,t.area_no,t.area_loc,t.drawing_no,t.sheet_no,t.rev_no,t2.lbsb,
				   t2.mat_type,t.piping_class,t.priority_timing,t.priority_code,t2.paint_reqd
				   from piping.dbo.iso t
				   inner join piping.dbo.spool t2
				   on t.area_no = t2.area_no and
  				   t.drawing_no = t2.drawing_no and
   				   t.sheet_no = t2.sheet_no and
  				   t.rev_no = t2.rev_no
  				   where {$where}" ;
			$rowArr = $this->piping->query($sql)->result_array();	
			
			return $rowArr;
        }
        public function get_all_dd2(){
			$sql = "select priority_code from {$this->tblName} group by priority_code order by priority_code ";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
		public function get_dd_area(){
			$sql = "select area_no from {$this->tblName} group by area_no order by area_no ";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
		public function get_dd_area2(){
			$sql = "select TOP {$_GET['pageSize']} area_no from {$this->tblName} group by area_no order by area_no ";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
		public function get_dd_subStringPriorityCode(){
			$sql = "select substring(priority_code,0,4) as priority_code from {$this->tblName} group by priority_code order by priority_code  ";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
		public function get_dd_arealoc(){
			$sql = "select area_loc from {$this->tblName} group by area_loc order by area_loc ";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
		public function get_dd_plantno(){
			$sql = "select plant_no from {$this->tblName} group by plant_no order by plant_no ";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
		public function get_dd_Drawingno(){
			$sql = "select drawing_no from {$this->tblName} group by drawing_no order by drawing_no ";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
		 public function get_all3($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;			
			
			$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
				$rowArr = $this->piping->query($sql)->result_array();
			
			return $rowArr;
        }

		public function get_all_export($where = ""){
			if ($where != "")
				$where = ("WHERE " . $where);
			
			$sql = "select top 100 plant_no,area_no,drawing_no,sheet_no,rev_no,lbsb,matl,piping_class,priority_timing,area_loc,tot_lm,priority_code FROM {$this->tblName} {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
			$rowArr = $this->piping->query($sql)->result_array();
				
			return $rowArr;
        }
		public function get_all_ttiso($spoolWhere = ''){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			
			$sql = "select t.PROGRESS_RECID,t.plant_no,t.area_no,t2.spool_no,t.area_loc,t.drawing_no,t.stat,
                        t.sheet_no,t.rev_no,t.lbsb,t.matl,t.piping_class,t.priority_timing, t.priority_code,
                        t.line_size,t.line_no,t.tot_lm,t.lineclass,t.tot_spl,t.workable_pct,workable_spl,
                        t.erect_workable_pct,t.fluid_code,t.insulation,t.insulation_thickness,t.painting,
                        t.pid,t.transmittal,t.remarks,t.document,t.loguser,t.logdate,t.logupdate,t.subarea_no,tot_spldia,
                        t2.sw_diainch,(select count(*) from dbo.spool t2 where {$spoolWhere}) as iTotSpool
				from piping.dbo.spool t2
				inner join piping.dbo.iso t
					on t2.plant_no = t.plant_no and
  				    t2.area_no = t.area_no and
  				    t2.drawing_no = t.drawing_no and
      				t2.sheet_no = t.sheet_no and
  				    t2.rev_no = t.rev_no
  				    WHERE {$spoolWhere}";
		return $this->piping->query($sql)->result_array();
		}
		
		public function area_query($where = "",$isoWhere = "",$spoolWhere = ""){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			$sql = "with this_query as (
						select t3.fluid_code,t3.fitotiso,spool.*,count(t3.fluid_code) over () as total,row_number() over (order by spool.{$_GET['fieldS']} {$_GET['dir']}) as rownum from (
							select {$this->tblName}.fluid_code,t2.*,COUNT(*) over () as fitotiso from (
								select spool.plant_no, spool.area_no, spool.drawing_no, spool.sheet_no, spool.rev_no, spool.spool_no from (select * from {$this->tblName} where {$this->tblName}.stat = 'A' {$isoWhere} {$where}) t 
									inner join dbo.spool on t.plant_no   = dbo.spool.plant_no   AND
															t.area_no    = dbo.spool.area_no    AND 
															t.drawing_no = dbo.spool.drawing_no AND
															t.sheet_no   = dbo.spool.sheet_no   AND 
															t.rev_no     = dbo.spool.rev_no     AND
															dbo.spool.weld_loc = 1 {$spoolWhere} group BY spool.plant_no, spool.area_no, spool.drawing_no, spool.sheet_no, spool.rev_no, spool.spool_no
							) t2
								inner join {$this->tblName} on t2.plant_no   = {$this->tblName}.plant_no   AND
															   t2.area_no    = {$this->tblName}.area_no    AND 
															   t2.drawing_no = {$this->tblName}.drawing_no AND
															   t2.sheet_no   = {$this->tblName}.sheet_no   AND 
															   t2.rev_no     = {$this->tblName}.rev_no
						) t3
							inner join spool on t3.plant_no   = spool.plant_no   AND
												t3.area_no    = spool.area_no    AND 
												t3.drawing_no = spool.drawing_no AND
												t3.sheet_no   = spool.sheet_no   AND 
												t3.rev_no     = spool.rev_no     AND
												t3.spool_no   = spool.spool_no
					)
					select top {$_GET['pageSize']} *,(select count(workable_dt) as fitotworkable from this_query) as fitotworkable,
													 (select count(spool_no) as fitotisoworkable from this_query where workable_dt != NULL group by rev_no) as fitotisoworkable,
													 (select count(fab_start_dt) as fitotstart from this_query) as fitotstart,
													 (select count(fab_end_dt) as fitotend from this_query) as fitotend,
													 (select count(painted_date) as fitotpainted from this_query) as fitotpainted,
													 (select count(whse_recvd_dt) as fitotwhsrecv from this_query) as fitotwhsrecv,
													 (select count(whse_issue_dt) as fitotwhsiss from this_query) as fitotwhsiss,
													 (select count(pcdrigup_date) as fitotrigup from this_query) as fitotrigup,
													 (select count(pcdfitup_date) as fitotfitup from this_query) as fitotfitup,
													 (select count(installed_date) as fitotwelded from this_query) as fitotwelded,
													 (select count(hydrotest_date) as fitothydro from this_query) as fitothydro,
													 (select count(pcdreinstate_date) as fitotresto from this_query) as fitotresto,
													 (select count(accepted_date) as fitotaccepted from this_query) as fitotaccepted from this_query where rownum > {$start}";
			//return $sql;
			return $this->piping->query($sql)->result_array();
		}

		public function area_query_export($where = "",$isoWhere = "",$spoolWhere = ""){
			$sql = "with this_query as (
						select t3.fluid_code,t3.fitotiso,spool.*,count(t3.fluid_code) over () as total,row_number() over (order by spool.{$_GET['fieldS']} {$_GET['dir']}) as rownum from (
							select {$this->tblName}.fluid_code,t2.*,COUNT(*) over () as fitotiso from (
								select spool.plant_no, spool.area_no, spool.drawing_no, spool.sheet_no, spool.rev_no, spool.spool_no from (select * from {$this->tblName} where {$this->tblName}.stat = 'A' {$isoWhere} {$where}) t 
									inner join dbo.spool on t.plant_no   = dbo.spool.plant_no   AND
															t.area_no    = dbo.spool.area_no    AND 
															t.drawing_no = dbo.spool.drawing_no AND
															t.sheet_no   = dbo.spool.sheet_no   AND 
															t.rev_no     = dbo.spool.rev_no     AND
															dbo.spool.weld_loc = 1 {$spoolWhere} group BY spool.plant_no, spool.area_no, spool.drawing_no, spool.sheet_no, spool.rev_no, spool.spool_no
							) t2
								inner join {$this->tblName} on t2.plant_no   = {$this->tblName}.plant_no   AND
															   t2.area_no    = {$this->tblName}.area_no    AND 
															   t2.drawing_no = {$this->tblName}.drawing_no AND
															   t2.sheet_no   = {$this->tblName}.sheet_no   AND 
															   t2.rev_no     = {$this->tblName}.rev_no
						) t3
							inner join spool on t3.plant_no   = spool.plant_no   AND
												t3.area_no    = spool.area_no    AND 
												t3.drawing_no = spool.drawing_no AND
												t3.sheet_no   = spool.sheet_no   AND 
												t3.rev_no     = spool.rev_no     AND
												t3.spool_no   = spool.spool_no
					)
					select *,(select count(workable_dt) as fitotworkable from this_query) as fitotworkable,
							 (select count(spool_no) as fitotisoworkable from this_query where workable_dt != NULL group by rev_no) as fitotisoworkable,
							 (select count(fab_start_dt) as fitotstart from this_query) as fitotstart,
							 (select count(fab_end_dt) as fitotend from this_query) as fitotend,
							 (select count(painted_date) as fitotpainted from this_query) as fitotpainted,
							 (select count(whse_recvd_dt) as fitotwhsrecv from this_query) as fitotwhsrecv,
							 (select count(whse_issue_dt) as fitotwhsiss from this_query) as fitotwhsiss,
							 (select count(pcdrigup_date) as fitotrigup from this_query) as fitotrigup,
							 (select count(pcdfitup_date) as fitotfitup from this_query) as fitotfitup,
							 (select count(installed_date) as fitotwelded from this_query) as fitotwelded,
							 (select count(hydrotest_date) as fitothydro from this_query) as fitothydro,
							 (select count(pcdreinstate_date) as fitotresto from this_query) as fitotresto,
							 (select count(accepted_date) as fitotaccepted from this_query) as fitotaccepted from this_query";
			//return $sql;
			return $this->piping->query($sql)->result_array();
		}
        
        public function set_iso(){
            $postInfo = array("plant_no"=>mysql_real_escape_string($_POST['plant_no']),"area_no"=>mysql_real_escape_string($_POST['area_no']),
            				  "drawing_no"=>mysql_real_escape_string($_POST['drawing_no']),"sheet_no"=>mysql_real_escape_string($_POST['sheet_no']),
            				  "rev_no"=>mysql_real_escape_string($_POST['rev_no']),"loguser"=>mysql_real_escape_string($_POST['loguser']),
            				  "logdate"=>mdate("%Y-%m-%d"),"stat"=>"A",
            				  "discipline"=>mysql_real_escape_string($_POST['discipline']),"document"=>mysql_real_escape_string($_POST['document']),
            				  "insulation"=>mysql_real_escape_string($_POST['insulation']),"insulation_thickness"=>mysql_real_escape_string($_POST['insulation_thickness']),
            				  "lbsb"=>mysql_real_escape_string($_POST['lbsb']),"lineclass"=>mysql_real_escape_string($_POST['lineclass']),
            				  "line_no"=>mysql_real_escape_string($_POST['line_no']),"painting"=>mysql_real_escape_string($_POST['painting']),
            				  "pid"=>mysql_real_escape_string($_POST['pid']),"subarea_no"=>mysql_real_escape_string($_POST['subarea_no']),
            				  "transmittal"=>mysql_real_escape_string($_POST['transmittal']),"matl"=>mysql_real_escape_string($_POST['matl']),
            				  "line_size"=>$_POST['line_size'],"logupdate"=>mysql_real_escape_string($_POST['loguser'] . " " . mdate("%Y-%m-%d")));
            if ($_POST['PROGRESS_RECID'] == "0"){
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}else{
            	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->piping->update($this->tblName, $postInfo);
			}
			
			return $query;
        }

		public function call_sp(){
			$sql = "declare @result int = 0;";			
			$sql .= "exec @result = piping.dbo.uplPrio_sp @ip_filename = 'priority - Copy';";
			$sql .= "select @result as return_value;";
			return $this->piping->query($sql)->result_array();
		}

		public function call_upd_sp(){
			$sql = "declare @result int = 0;";			
			$sql .= "exec @result = piping.dbo.updPrio_sp;";
			$sql .= "select @result as return_value;";
			return $this->piping->query($sql)->result_array();
		}
		
	    public function is_entry_unique($criteria = array()) {
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
		
		public function remove_iso(){
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
    }
?>