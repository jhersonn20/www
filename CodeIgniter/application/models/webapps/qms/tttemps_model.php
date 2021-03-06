<?php
    class Tttemps_model extends CI_Model {
    	private $tblName = "tttemps";
        public function __construct(){
            parent::__construct();
        	$this->tempdb_sql = $this->load->database('tempdb_sql', true);
        }

        public function get_all($where){
        	if ($_GET['processMatTO'])
	        	if (!$this->call_sp())
					return array();
			
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			// if ($_GET['value'] == ""){
				// $sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->tempdb_sql->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} where {$where}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->tempdb_sql->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->tempdb_sql->query($sql)->result_array();
				// }
			// }
			return $rowArr;
        }

		public function call_sp($item = ""){
			$sql = "declare @result int = 0;";			
			$sql .= "exec @result = tempdb_sql.dbo.matTakeOff_sp @ip_module = '{$_GET['module']}', @ip_loguser = '{$_GET['log_user']}', @ip_disc_code = '{$_GET['disc_code']}', @ip_drawing_no = '{$_GET['drawing_no']}', @ip_sheet_no = '{$_GET['sheet_no']}';";			
			$sql .= "select @result as return_value;";
			// if (!write_file('e:\sql.txt', $sql))
			     // echo 'Unable to write the file';
			// else
			     // echo 'File written!';
			$query = $this->tempdb_sql->query($sql)->result_array();
			
			// var_dump($query);
			return $query[0]['return_value'];
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