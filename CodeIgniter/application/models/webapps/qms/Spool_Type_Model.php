<?php
    class Spool_Type_Model extends CI_Model {
    	private $tblName = "spool_type";
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
        }
		
		public function get_all_dd(){
			$this->piping->select('spltype_code, spltype_desc');
			$this->piping->where('flg_status', 1);
			return $this->piping->get($this->tblName)->result_array();
		}
		public function get_all_dd3(){
			$this->piping->select('spltype_code, spltype_desc');
			$this->piping->where('active', 1);
			return $this->piping->get($this->tblName)->result_array();
		}
		public function get_all_dd2(){
			$sql = "select t1.spltype_code,t1.spltype_desc from {$this->tblName} t1 join (SELECT RTRIM(LTRIM(spltype_code)) as spltype_code from {$this->tblName} where RTRIM(LTRIM(spltype_code)) <> '' group by RTRIM(LTRIM(spltype_code))) t2 on t1.spltype_code = t2.spltype_code";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
        
        public function get_all($where = ""){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			if ($_GET['value'] == ""){					
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
				$rowArr = $this->piping->query($sql)->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){					
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				}else{
					$sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,* FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$rowArr = $this->piping->query($sql)->result_array();
				}
			}
			return $rowArr;
        }
        
        public function set(){		
			$postInfo = array();
			foreach ($_POST as $key => $value) {
				if ($key == "PROGRESS_RECID")
					continue;
				$postInfo[$key] = $value;
			}
			$postInfo['logupdate'] = $_POST['loguser'] . " " . mdate("%Y-%m-%d %H:%i:%s");
			$postInfo['logdate'] = mdate("%Y-%m-%d %H:%i:%s");

            if ($_POST['PROGRESS_RECID'] == "0"){
            	$query = $this->is_entry_unique(array('spltype_code' => $_POST['spltype_code']));
            	if (gettype($query) == 'boolean'){
            		if (!$query){
	            		$query = "Failed! Duplicate 'spltype_code' found for '{$_POST['spltype_code']}' item!";
	            		return $query;
	            	}
            	}else
            		return $query;
            		
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}else{
            	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->piping->update($this->tblName, $postInfo);
			}
			
			return $query;
        }
		
		public function remove(){
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
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
    }
?>