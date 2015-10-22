<?php
    class Ps_mto_Model extends CI_Model {
    	private $tblName = "ps_mto";
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
				}
			}
			
			$sql = "select count(*) as total_set, (select COUNT(*) as total_pcs from {$this->tblName}) as total_pcs from (select {$this->tblName}.mat_tag from {$this->tblName} group by {$this->tblName}.mat_tag) t;";
			$query = $this->piping->query($sql);
			$res = $query->result();
			$total_pcs = $res[0]->total_pcs;
			$total_set = $res[0]->total_set;
			$rowArr[0]['total_pc'] = $total_pcs;
			$rowArr[0]['total_set'] = $total_set;
			
			return $rowArr;
        }

		public function get_all2($where){
        	//$this->call_sp_query_spl_wise((int) $_GET['tbAdvance'], $_GET['rswork'],$_GET['aname'],$area);
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;

			// if ($_GET['value'] == ""){
				// $sql = "SELECT (select count(*) FROM {$this->tblName} where {$where}) as total,* FROM {$this->tblName} where {$where} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->tempdb_sql->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){				

					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();							
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,* FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->tempdb_sql->query($sql)->result_array();
				// }
			// }

			return $rowArr;
        }
        public function get_all3($where){
        	$sql = "SELECT TOP 100 * FROM {$this->tblName}";
			$rowArr = $this->piping->query($sql)->result_array();	

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
		public function all_export(){
			$sql = "select TOP 100
					job_no,system_no,sub_system,testpack_no,area_no,fwbs,serv_line,drawing_no,
					line_no,sheet_no,spool_no,rev_no,line_specs,line_size,mat_tag,com_code,ps_matl,
					ps_code,supp_desc,ps_type,ps_specs,category,assembly,um,uwt,uqty,wt_client,
					wt_fab,ps_length,scope_fab,scope_supply,scope_of_work,paint_code,ps_class,
					pwht_req,roc_type,plant_no,deliv_to_paint,paint_date,qc_releasePaint,
					deliv_at_site,issued_date,deliv_to_fab,fab_dt,fab_released,fogfitup_date,
					fog_installed,fog_remarks,pcdfitup_date,pcd_installed,pcd_remarks
					FROM {$this->tblName}";
			
			$rowArr = $this->piping->query($sql)->result_array();
			return $rowArr;
		}
		public function verify_pipe(){
			//$sql = "SELECT count(*) as counter from {$this->tblName} where rev_no = '" . mysql_real_escape_string($_POST['rev_no']) . "' AND area_no = '" . mysql_real_escape_string($_POST['area_no']) . "'";
			//$query = $this->piping->select('SELECT count(*) as counter')->from($this->tblName)->where($this->tblName,);
			$query = $this->piping->select('count(*) as counter')->from($this->tblName)->where(array('rev_no' => $_GET['rev_no'], 'area_no' => $_GET['area_no'], 'drawing_no' => $_GET['drawing_no'], 'spool_no' => $_GET['spool_no'], 'sheet_no' => $_GET['sheet_no'], 'mat_tag' => $_GET['mat_tag'])); //->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
			$query = $this->piping->get();
			$total = $query->result();
			$total = $total[0]->counter;
		}
        
        public function set_pieceStruc(){			$postInfo = array();
			foreach ($_POST as $key => $value) {
				if ($key == "PROGRESS_RECID")
					continue;
				$postInfo[$key] = mysql_real_escape_string($value);
			}
			$postInfo['logupdate'] = $_POST['loguser'] . " " . mdate("%Y-%m-%d");
			$postInfo['logdate'] = mdate("%Y-%m-%d %H:%i:%s");
            if ($_POST['PROGRESS_RECID'] == "0"){
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

		// public function call_sp($sql_insert = ""){
			// $sql = "declare @result int, @sqlString as varchar(max);";
			// $sql .= "set @sqlString = '" . str_replace("'", "''", $sql_insert) . "';";
			// $sql .= "exec @result = piping.dbo.psMTO_sp @sqlString;";
			// $sql .= "select  @result as return_value, count(*) as counter from ##ttfile;";
			// $sql .= "drop table ##ttfile;";
			// $query = $this->piping->query($sql)->result_array();
// 			
			// return $query;
		// }
// 
		// public function call_sp_fog($sql_insert = ""){
			// $sql = "declare @result int, @sqlString as varchar(max);";
			// $sql .= "set @sqlString = '" . str_replace("'", "''", $sql_insert) . "';";
			// $sql .= "exec @result = piping.dbo.psFogMTO_sp @sqlString;";
			// $sql .= "select  @result as return_value, count(*) as counter from ##ttfile;";
			// $sql .= "drop table ##ttfile;";
			// $query = $this->piping->query($sql)->result_array();
// 			
			// return $query;
		// }
// 
		// public function call_sp_pcd($sql_insert = ""){
			// $sql = "declare @result int, @sqlString as varchar(max);";
			// $sql .= "set @sqlString = '" . str_replace("'", "''", $sql_insert) . "';";
			// $sql .= "exec @result = piping.dbo.psPcdMTO_sp @sqlString;";
			// $sql .= "select  @result as return_value, count(*) as counter from ##ttfile;";
			// $sql .= "drop table ##ttfile;";
			// $query = $this->piping->query($sql)->result_array();
// 			
			// return $query;
		// }
// 
		// public function call_sp_global($sql_insert = ""){
			// $sql = "declare @result int, @sqlString as varchar(max);";
			// $sql .= "set @sqlString = '" . str_replace("'", "''", $sql_insert) . "';";
			// $sql .= "exec @result = piping.dbo.psGlobalMTO_sp @sqlString;";
			// $sql .= "select  @result as return_value, count(*) as counter from ##ttfile;";
			// $sql .= "drop table ##ttfile;";
			// $query = $this->piping->query($sql)->result_array();
// 			
			// return $query;
		// }
// 
		// public function call_sp_fab($sql_insert = ""){
			// $sql = "declare @result int, @sqlString as varchar(max);";
			// $sql .= "set @sqlString = '" . str_replace("'", "''", $sql_insert) . "';";
			// $sql .= "exec @result = piping.dbo.psFabMTO_sp @sqlString;";
			// $sql .= "select  @result as return_value, count(*) as counter from ##ttfile;";
			// $sql .= "drop table ##ttfile;";
			// $query = $this->piping->query($sql)->result_array();
// 			
			// return $query;
		// }
		
		public function remove_pieceStruc(){
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
    }
?>