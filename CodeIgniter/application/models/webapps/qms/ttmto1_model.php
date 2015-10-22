<?php
    class Ttmto1_model extends CI_Model {
    	private $tblName = "ttmto1";
        public function __construct(){
            parent::__construct();
        	$this->tempdb_sql = $this->load->database('tempdb_sql', true);
        }

        public function get_all($where){			
			// $start = ($_GET['page'] - 1) * $_GET['pageSize'];
			// $end = ($start + $_GET['pageSize']) - 1;
			// if ($_GET['value'] == ""){
				// $sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->tempdb_sql->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT * FROM {$this->tblName} t where {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
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
			$sql .= "exec @result = tempdb_sql.dbo.matTakeOff_sp;";			
			$sql .= "select @result as return_value;";
			$query = $this->tempdb_sql->query($sql)->result_array();
			
			return $query;
		}
        
        public function set($item = ""){
        	if ($item == "add"){
		        $ci =& get_instance();
		        $ci->load->model('webapps/qms/iso_model');
				$query = $ci->iso_model->is_entry_unique(array("drawing_no" => $_POST['drawing_no'], "sheet_no" => $_POST['sheet_no']));
				var_dump($query); 
				return true;
            	if (gettype($query) == 'boolean'){
					if ($query)
						return "Drawing No./Sheet No. not found in ENGG PIPING MTO";
				}else
					return $query;
					
				$sql = "insert into {$this->tblName}(item_code, mat_desc, commodity_code, uom, size, area_no, drawing_no, sheet_no, rev_no, loguser, PROGRESS_RECID, lcm, sys_man) 
							select item_code, mat_desc, commodity_code, uom, size, area_no, drawing_no, sheet_no, rev_no, '{$_POST['loguser']}', PROGRESS_RECID, 0, 'SYS' from piping.dbo.mat_takeoff_perspool where drawing_no = '{$_POST['drawing_no']}' and sheet_no = '{$_POST['sheet_no']}' AND qty != 0 AND ref_rec_qty < qty AND PROGRESS_RECID NOT IN (SELECT PROGRESS_RECID from dbo.ttMTO);
						insert into ttMTO1(item_code, mat_desc, commodity_code, uom, size, area_no, drawing_no, sheet_no, rev_no, loguser, PROGRESS_RECID, lcm, sys_man) 
							select item_code, mat_desc, commodity_code, uom, size, area_no, drawing_no, sheet_no, rev_no, '{$_POST['loguser']}', PROGRESS_RECID, 1, 'SYS' from piping.dbo.mat_takeoff_perspool where drawing_no = '{$_POST['drawing_no']}' and sheet_no = '{$_POST['sheet_no']}' AND qty != 0 AND ref_rec_qty >= qty AND PROGRESS_RECID NOT IN (SELECT PROGRESS_RECID from dbo.ttMTO1)";
				$query = $this->tempdb_sql->query($sql);
				if (!$query)
					return "Insert failed!";
					
				$query = $this->tempdb_sql->query("select count(*) as counter from ttMTO1")->result_array();
				var_dump($query);
				return true;
				if (!$query)
					return "Find failed!";
				if ($query[0]['counter'] > 0)
					return "Completed Materials found under this ISO/DWG.";
        	}
        	
			// foreach ($_POST as $key => $value) {
				// if ($key == "PROGRESS_RECID" || $key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId" || $key == "total" || $key == "rownum")
					// continue;
				// $postInfo[$key] = mysql_real_escape_string($value);
			// }
			// $postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
			// $postInfo['log_time'] = mdate("%H:%i:%s");
			// $postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
// 			
            // if ($_POST['PROGRESS_RECID'] > 0){
            	// $query = $this->tempdb_sql->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	// $query = $this->tempdb_sql->update($this->tblName, $postInfo);
			// }else{
            	// $query = $this->is_entry_unique(array("PROGRESS_RECID" => $_POST['PROGRESS_RECID']));
            	// if (gettype($query) == 'boolean'){
					// if (!$query)
						// return "Record already exist!";
				// }else
					// return $query;					
				// $query = $this->tempdb_sql->set($postInfo);
				// $query = $this->tempdb_sql->insert($this->tblName);
			// }
						
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
			$postInfo = array("loguser" => $_POST['loguser']);
			if ($_POST['PROGRESS_RECID'] > 0)
				$postInfo['PROGRESS_RECID'] = $_POST['PROGRESS_RECID'];
			
    		$query = $this->tempdb_sql->where($postInfo);        		
    		$query = $this->tempdb_sql->delete($this->tblName);
			return $query;
		}
    }
?>