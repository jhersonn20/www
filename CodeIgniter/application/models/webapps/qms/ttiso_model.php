<?php
    class Ttiso_model extends CI_Model {
    	private $tblName = "ttiso";
        public function __construct(){
            parent::__construct();
        	$this->tempdb_sql = $this->load->database('tempdb_sql', true);
        	$this->piping = $this->load->database('piping', true);
        }

        public function get_all($where){
        	// if ($_GET['processMatTO'])
	        	// if (!$this->call_sp())
					// return array();			
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			if ($_GET['value'] == ""){
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,(select sum(totdia) FROM {$this->tblName}) as diainch,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				$rowArr = $this->tempdb_sql->query($sql)->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,(select sum(totdia) FROM {$this->tblName}) as diainch,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->tempdb_sql->query($sql)->result_array();					
				}else{
					$sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$rowArr = $this->tempdb_sql->query($sql)->result_array();
				}
			}
			return $rowArr;
        }
	
		public function getAll_export(){
			$sql = "SELECT plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no, commodity_code, qty, alloc_qty, workable FROM {$this->tblName} order by {$_GET['fieldS']} {$_GET['dir']}";
			return $this->tempdb_sql->query($sql)->result_array();
		}

		public function call_sp($item = ""){
			$sql = "declare @result int = 0;";			
			$sql .= "exec @result = piping.dbo.workable_sp @ip_module = '{$_POST['module']}', @ip_filename = '{$_POST['filename']}';";
			$sql .= "select @result as return_value;";
			return $this->tempdb_sql->query($sql)->result_array();
		}

		public function call_sp_upl(){
			$sql = "declare @result int = 0;";			
			$sql .= "exec @result = piping.dbo.uplReq_sp @ip_disc_code = '{$_POST['disc_code']}', @ip_loguser = '{$_POST['loguser']}', @ip_module = 'pcd', @ip_filename = '';";
			$sql .= "select @result as return_value;";
			return $this->piping->query($sql)->result_array();
		}
        
        public function set(){
			foreach ($_POST as $key => $value) {
				if ($key == "PROGRESS_RECID" || $key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId" || $key == "total" || $key == "rownum")
					continue;
				$postInfo[$key] = mysql_real_escape_string($value);
			}
			$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
			$postInfo['log_time'] = mdate("%H:%i:%s");
			$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
			
            if ($_POST['PROGRESS_RECID'] > 0){
            	$query = $this->tempdb_sql->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->tempdb_sql->update($this->tblName, $postInfo);
			}else{
            	$query = $this->is_entry_unique(array("PROGRESS_RECID" => $_POST['PROGRESS_RECID']));
            	if (gettype($query) == 'boolean'){
					if (!$query)
						return "Record already exist!";
				}else
					return $query;
					
				$query = $this->tempdb_sql->set($postInfo);
				$query = $this->tempdb_sql->insert($this->tblName);
			}
						
			return $query;
        }
		
	    public function is_entry_unique($criteria = '') {
            $this->tempdb_sql->select('count(*) as counter')->from($this->tblName)->where($criteria);
			$query = $this->tempdb_sql->get();
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
		
		public function remove(){
        	$query = $this->tempdb_sql->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->tempdb_sql->delete($this->tblName);
			return $query;
		}
    }
?>