<?php
    class USER_JOB_Model extends CI_Model {
		private $tblName = "user_job";
        public function __construct(){
            parent::__construct();
            //$this->load->database();
        	$this->gendb = $this->load->database('gendb', true);
        	$this->projdb = $this->load->database('projdb', true);
        }
        
        /*public function getAll(){
            return $this->gendb->get($this->tblName)->result_array();
        }*/
	
		public function getAll($where = ""){
			/*$sql = "SELECT * FROM " . $this->tblName;
			return $this->gendb->query($sql)->result_array();*/
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			if ($_GET['value'] == ""){
				//$sql = "SELECT (select count(*) FROM {$this->tblName}) as total ,PROGRESS_RECID,prog_code,sys_app,sys_trans,attach_path,modules FROM {$this->tblName} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
				$query = $this->gendb->select("(select count(*) FROM {$this->tblName}) as total ,PROGRESS_RECID,job_no,job_desc,job_init,enable_stat")->from($this->tblName)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
				$query = $this->gendb->get();
				$rowArr = $query->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					//$sql = "SELECT (select count(*) FROM {$this->tblName} where {$_GET['fieldF']} like '%{$_GET['value']}%') as total,PROGRESS_RECID,prog_code,sys_app,sys_trans,attach_path,modules FROM {$this->tblName} where {$_GET['fieldF']} like '%{$_GET['value']}%' order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$query = $this->gendb->select('count(*) as total')->from($this->tblName)->where($where); //->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
					$query = $this->gendb->get();
					$total = $query->result();
					$total = $total[0]->total;
					
					$query = $this->gendb->select('PROGRESS_RECID,job_no,job_desc,job_init,enable_stat')->from($this->tblName)->where($where)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
					$query = $this->gendb->get();
					$rowArr = $query->result_array();
					$rowArr[0]['total'] = $total;
				}else
					$sql = "SELECT (select count(*) FROM {$this->tblName} where {$_GET['value']}) as total,PROGRESS_RECID,job_no,job_desc,job_init,enable_stat FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
			}
			return $rowArr; //$this->gendb->query($sql)->result_array();
		}
        
        public function getAllJob(){
        	$sql = "SELECT job_no FROM " . $this->tblName;
            return $this->gendb->query($sql)->result_array();
        }
		
		public function getByJob($user_id = ""){
			//$sql = "SELECT * FROM $this->tblName WHERE user_id = ?";
			$sql = "SELECT " . $this->tblName2 . ".appl_code," . $this->tblName2 . ".appl_name_short FROM " . $this->tblName . "," . $this->tblName2 . " where " . $this->tblName . ".appl_code = " . $this->tblName2 . ".appl_code and " . $this->tblName . ".user_id = ? and " . $this->tblName2 . ".publish = 1";
			return $this->gendb->query($sql, $user_id)->result_array();
		}
        
        public function set_user_job(){			
            if ($_POST['PROGRESS_RECID'] > 0){
	            $postInfo = array("job_init"=>$_POST['job_init']);
            	$query = $this->gendb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->gendb->update($this->tblName, $postInfo);
			}else{
				if (!isset($_POST['CENTRAL'])){
			        // Load First_model
			        $ci =& get_instance();
		            $ci->load->model('webapps/job_tbl_model');
					
					$sql = "SELECT job_no, job_desc FROM job_tbl WHERE find_in_set(PROGRESS_RECID,'{$_POST['listOfSelected']}')";
					$result = $this->projdb->query($sql);
					if ($result->num_rows() > 0){
						$sql = "INSERT INTO {$this->tblName} (user_id,job_no,job_desc,enable_stat) values(?,?,?,1) on duplicate key update logtime = now()";
						foreach ($result->result() as $row){
							$query = $this->gendb->query($sql,array($_POST['user_id'],$row->job_no,$row->job_desc));
						}
					}
				}else {
					$sql = "INSERT INTO {$this->tblName} (user_id,job_no,job_desc,enable_stat) values(?,?,?,1) on duplicate key update logtime = now()";
					$query = $this->gendb->query($sql,array($_POST['user_id'],"CENTRAL","CENTRAL"));
				}
			}
			
			return $query;
        }
		
		public function remove_job(){
        	$query = $this->gendb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->gendb->delete($this->tblName);
			return $query;
		}
    }
?>