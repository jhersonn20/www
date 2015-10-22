<?php
    class Tosd_Dtl_Model extends CI_Model {
    	private $tblName = "tosd_dtl";
        public function __construct(){
            parent::__construct();
        	$this->piping= $this->load->database('piping', true);
			
	
        }
    	 public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			 
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}  where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}  where {$where}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				
			return $rowArr;
        }
		public function set(){
			foreach ($_POST as $key => $value) {
				if ($key == "PROGRESS_RECID" || $key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId")
					continue;
				$postInfo[$key] = mysql_real_escape_string($value);
			}
			$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
			$postInfo['log_time'] = mdate("%H:%i:%s");
			$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
			
            if ($_POST['PROGRESS_RECID'] > 0){
            	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->piping->update($this->tblName, $postInfo);
			}else{				
            	$query = $this->is_entry_unique(array("osd_no" => $_POST['osd_no'], "package_no" => $_POST['package_no']));
            	if (gettype($query) == 'boolean'){
					if (!$query)
						return "Record already exist!";
				}else
					return $query;
					
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}
			
			return $query;
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
		public function remove(){
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
		public function removeDtl(){
        	$query = $this->piping->where('osd_no', $_POST['osd_no']);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
		public function remove_iso(){
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
    }
?>