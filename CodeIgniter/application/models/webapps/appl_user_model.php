<?php
    class APPL_USER_Model extends CI_Model {
		private $tblName = "appl_user";
		private $tblName2 = "rappl";
        public function __construct(){
            parent::__construct();
            //$this->load->database();
        	$this->gendb = $this->load->database('gendb', true);
        }
        
        public function getAll(){
			$sql = "SELECT * FROM {$this->tblName} order logtime";
            return $this->gendb->query($sql)->result_array();
        }
		
		public function getByUser($user_id = ""){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$sql = "SELECT (SELECT count(*) from {$this->tblName} where user_id = ?) as total,PROGRESS_RECID,appl_code,group_code,appl_jsu,appl_su,appl_stat FROM {$this->tblName} WHERE user_id = ? order by {$_GET['fieldS']} {$_GET['dir']} limit {$start},{$_GET['pageSize']}";
			//$sql = "SELECT " . $this->tblName2 . ".appl_code," . $this->tblName2 . ".appl_name_short FROM " . $this->tblName . "," . $this->tblName2 . " where " . $this->tblName . ".appl_code = " . $this->tblName2 . ".appl_code and " . $this->tblName . ".user_id = ? and " . $this->tblName2 . ".publish = 1";
			return $this->gendb->query($sql, array($user_id,$user_id))->result_array();
		}
		
		public function getByUserApp($user_id = "",$appl_code = ""){
			//$sql = "SELECT * FROM $this->tblName,$this->tblName2 WHERE user_id = ? and appl_code = ? and publish = 1";
			$sql = "SELECT * FROM " . $this->tblName . "," . $this->tblName2 . " where " . $this->tblName . ".user_id = ? and " . $this->tblName2 . ".appl_code = ? and " . $this->tblName . ".appl_code = " . $this->tblName2 . ".appl_code and " . $this->tblName2 . ".publish = 1";
			return $this->gendb->query($sql, array($user_id,$appl_code))->result_array();
		}
		
		public function getByUserMenu($user_id = ""){
			//$sql = "SELECT * FROM $this->tblName WHERE user_id = ?";
			$sql = "SELECT " . $this->tblName2 . ".appl_code," . $this->tblName2 . ".appl_name_short," . $this->tblName2 . ".type FROM " . $this->tblName . "," . $this->tblName2 . " where " . $this->tblName . ".appl_code = " . $this->tblName2 . ".appl_code and " . $this->tblName . ".user_id = ? and " . $this->tblName2 . ".publish = 1";
			return $this->gendb->query($sql, $user_id)->result_array();
		}
		
		public function get_page_init($filters = array()){
			foreach ($filters as $key => $val):
				settype($filters[$key], "string");
			endforeach;
			$sql = "SELECT t.page_init, t3.param from gendb.rgroup t
						inner join {$this->tblName} t2
						on t.appl_code = t2.appl_code and
						   t.group_code = t2.group_code
						inner join gendb.rmenu t3
						on t2.appl_code = t3.appl_code and
						   t.page_init = t3.progname
						where t2.user_id = ? and t2.appl_code = ?";
			return $this->gendb->query($sql,$filters)->result_array();
		}
        
        public function set_appl(){			
            if ($_POST['PROGRESS_RECID'] > 0){
	            $postInfo = array("appl_code"=>$_POST['appl_code'],
	            				  "group_code"=>$_POST['group_code'],
								  "appl_jsu"=>$_POST['appl_jsu'],
								  "appl_su"=>$_POST['appl_su'],
								  "loguser"=>$_POST['user_id'],
								  "logdate"=>mdate("%Y-%m-%d"));
            	$query = $this->gendb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->gendb->update($this->tblName, $postInfo);
			}else{
	            $postInfo = array("appl_code"=>$_POST['appl_code'],
	            				  "user_id"=>mysql_real_escape_string($_POST['user_id']),
	            				  "group_code"=>$_POST['group_code'],
								  "appl_jsu"=>$_POST['appl_jsu'],
								  "appl_su"=>$_POST['appl_su'],
								  "appl_stat"=>1,
								  "loguser"=>$_POST['user_id'],
								  "logdate"=>mdate("%Y-%m-%d"));
				$query = $this->gendb->set($postInfo);
				$query = $this->gendb->insert($this->tblName);
			}
			
			return $query;
        }
        
        public function set_applD(){ //$PROGRESS_RECID
			/*$sql = "SELECT * FROM " . $this->tblName . " WHERE PROGRESS_RECID = ?";
			$query = $this->gendb->query($sql, $_POST['PROGRESS_RECID']);
			if ($query->num_rows() > 0){	
				$row = $query->row();*/
            	$query = $this->gendb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']); //$row->PROGRESS_RECID
        		$query = $this->gendb->update($this->tblName, array("appl_stat"=>$_POST['appl_stat'])); //($row->appl_stat == 1 ? 0 : 1)
				return $query;
			/*}
			return false;*/
        }
		
		public function remove_appl(){
        	$query = $this->gendb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->gendb->delete($this->tblName);
			return $query;
		}
		
		public function remove_all_appl_byUser($user_id = ""){
        	$query = $this->gendb->where('user_id', (isset($user_id) ? $user_id : $_POST['user_id']));
        	$query = $this->gendb->delete($this->tblName);
			return $query;
		}
		
		public function remove_appl_by_appl(){
        	$query = $this->gendb->where('appl_code', $_POST['appl_code']);
        	$query = $this->gendb->delete($this->tblName);
			return $query;
		}
    }
?>