<?php
    class Mat_takeoff_perspool_Model extends CI_Model {
    	private $tblName = "mat_takeoff_perspool";
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
        }
        
        public function get_all($where = ""){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			// if ($_GET['value'] == ""){
				// $sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum >= {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->piping->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} where {$where}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();				
				// }else{
					// $sql = "SELECT (select count(*) FROM {$this->tblName} where {$_GET['value']}) as total,* FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			// }
			return $rowArr;
        }		
          public function get_all_export2($where = ""){
			if ($where != "")
				$where = ("WHERE " . $where);
			
			$sql = "select TOP 500 t2.plant_no,t2.area_no,t2.drawing_no,t2.sheet_no, t2.rev_no,t.spool_no,t.isc_no,t.item_code,t.size_,t.qty,t.mat_desc,t2.piping_class,t2.priority_timing,t2.area_loc,t2.priority_code
					from dbo.mat_takeoff_perspool t
					inner join dbo.iso t2
				    on  t2.plant_no = t.plant_no and 
				    	t2.area_no = t.area_no and 
				    	t2.drawing_no = t.drawing_no and 
				    	t2.sheet_no = t.sheet_no and 
				    	t2.rev_no = t.rev_no
				   		 WHERE t.spool_no <> 'EM' ";
					
			$rowArr = $this->piping->query($sql)->result_array();
			return $rowArr;
        }
        public function get_allexport3($where = ""){
			if ($where != "")
				$where = ("WHERE " . $where);
			
			$sql = "select TOP 500 t2.plant_no,t2.area_no,t2.drawing_no,t2.sheet_no, t2.rev_no,t.spool_no,t.isc_no,t.item_code,t.size_,t.qty,t.mat_desc,t2.piping_class,t2.priority_timing,t2.area_loc,t2.priority_code
					from dbo.mat_takeoff_perspool t
					inner join dbo.iso t2
				    on  t2.plant_no = t.plant_no and 
				    	t2.area_no = t.area_no and 
				    	t2.drawing_no = t.drawing_no and 
				    	t2.sheet_no = t.sheet_no and 
				    	t2.rev_no = t.rev_no
				   		 WHERE t.spool_no = 'EM' ";
					
			$rowArr = $this->piping->query($sql)->result_array();
			return $rowArr;
        }
        public function get_dd_category(){
			$sql = "select category from {$this->tblName} group by category order by category ";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
        
        public function getAll($criteria = array()){
        	return $this->piping->get_where($this->tblName, $criteria)->result_array();        	
        }
		
		public function for_request(){
			$sql = "exec piping.dbo.matrequest_sp;";
			return $this->piping->query($sql)->result_array();			
		}
        
        public function set_material(){
            $postInfo = array("plant_no"=>mysql_real_escape_string($_POST['plant_no']),"area_no"=>mysql_real_escape_string($_POST['area_no']),
            				  "drawing_no"=>mysql_real_escape_string($_POST['drawing_no']),"sheet_no"=>mysql_real_escape_string($_POST['sheet_no']),
            				  "rev_no"=>mysql_real_escape_string($_POST['rev_no']),"spool_no"=>mysql_real_escape_string($_POST['spool_no']),
            				  "item_code"=>mysql_real_escape_string($_POST['item_code']),"loguser"=>mysql_real_escape_string($_POST['loguser']),
            				  "logdate"=>mdate("%Y-%m-%d"),"qty"=>$_POST['qty'],
            				  "length"=>$_POST['length'],"mat_type"=>mysql_real_escape_string($_POST['mat_type']),
            				  "size"=>mysql_real_escape_string($_POST['size']),"category"=>mysql_real_escape_string($_POST['category']),
            				  "painting_specs"=>mysql_real_escape_string($_POST['painting_specs']),"commodity_code"=>mysql_real_escape_string($_POST['commodity_code']),
            				  "logupdate"=>$_POST['loguser'] . " " . mdate("%Y-%m-%d"));
            if ($_POST['PROGRESS_RECID'] == "0"){
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}else{
            	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->piping->update($this->tblName, $postInfo);
			}
			
			return $query;
        }
        
        public function update($postInfo = array(), $criteria = array()){
        	if (sizeof($postInfo) == 0){
				foreach ($_POST as $key => $value) {
					if ($key == "PROGRESS_RECID" || $key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_time'] = mdate("%H:%i:%s");
				$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
			}

        	$query = $this->piping->where($criteria);
        	$query = $this->piping->update($this->tblName, $postInfo);
			
			return $query;        	
        }

		public function call_sp($item = ""){
			$sql = "declare @result int = 0;";			
			$sql .= "exec @result = piping.dbo." . $item . "_sp;";
			$sql .= "select @result as return_value;";
			$query = $this->piping->query($sql)->result_array();
			
			return $query;
		}
		
	    public function is_entry_unique($criteria = '') {
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
		
		public function remove_material($postInfo = array()){
			if (sizeof($postInfo) == 0)
				$postInfo['PROGRESS_RECID'] = $_POST['PROGRESS_RECID'];
			
        	$query = $this->piping->where($postInfo);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
    }
?>