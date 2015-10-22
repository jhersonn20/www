<?php
    class Task_model extends CI_Model {
    	private $tblName = "task";
        public function __construct(){
            parent::__construct();
        	$this->pmdb = $this->load->database('PMDB', true);
        }

        public function get_all($where){
        	// if ($_GET['processMatTO'])
	        	// if (!$this->call_sp())
					// return array();
			
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			// if ($_GET['value'] == ""){
				// $sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->pmdb->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = ";with thisResult as (
								select t.wbs_short_name, t.proj_id, t.wbs_id, t2.task_code, t2.act_start_date 
									from {$this->tblName} t 
									inner join dbo.task t2
									on t.proj_id = t2.proj_id and
									   t.wbs_id = t2.wbs_id
							)
							SELECT top {$_GET['pageSize']} * 
								FROM (
									select (
											select count(*) FROM thisResult" . (($where != '') ? " where {$where}" : "") . "
										) as total,
										*,
										row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum 
									FROM thisResult" . (($where != '') ? " where {$where}" : "") . "
								) t 
								where" . (($where != '') ? " {$where} AND" : "") . " rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->pmdb->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->pmdb->query($sql)->result_array();
				// }
			// }
			return $rowArr;
        }

		public function call_sp($item = ""){
			$sql = "declare @result int = 0;";			
			$sql .= "exec @result = pmdb.dbo.matTakeOff_sp @ip_module = '{$_GET['module']}', @ip_loguser = '{$_GET['log_user']}', @ip_disc_code = '{$_GET['disc_code']}';";			
			$sql .= "select @result as return_value;";
			return $this->pmdb->query($sql)->result_array();
		}
        
        public function set(){
			foreach ($_POST as $key => $value) {
				if ($key == "wbs_id" || $key == "wbs_short_name" || $key == "index" || $key == "cmode" || $key == "idField" || $key == "_defaultId" || $key == "total" || $key == "rownum")
					continue;
				$postInfo[$key] = mysql_real_escape_string($value);
			}
			
            if ($_POST['wbs_id'] > 0){
            	$query = $this->pmdb->where('task_id', $_POST['task_id']);
            	$query = $this->pmdb->update($this->tblName, $postInfo);
			}else{
            	$query = $this->is_entry_unique(array("task_id" => $_POST['task_id']));
            	if (gettype($query) == 'boolean'){
					if (!$query)
						return "Record already exist!";
				}else
					return $query;
					
				$query = $this->pmdb->set($postInfo);
				$query = $this->pmdb->insert($this->tblName);
			}
						
			return $query;
        }
		
	    public function is_entry_unique($criteria = '') {
            $this->pmdb->select('count(*) as counter')->from($this->tblName)->where($criteria);
			$query = $this->pmdb->get();
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
			// if (!isset($_POST['task_id'])){
				// $sql = "select top 1 task_id from {$this->tblName} where wbs_id = {$_POST['wbs_id']}";			
				// $task_id = $this->pmdb->query($sql)->result_array();
				// $task_id = $task_id[0]['task_id']; 				
			// }else
				// $task_id = $_POST['task_id'];
			
        	$query = $this->pmdb->where('task_id', $task_id);
        	$query = $this->pmdb->delete($this->tblName);
			return $query;
		}
    }
?>