<?php
    class Files_model extends CI_Model {
		private $tblName = "files";
    			
        public function __construct(){
            //$this->load->database();
        	$this->portal = $this->load->database('portal', true);
        	$this->load->library(array('portal/email'));
        }
        
        public function get_all($where = ""){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
        	$sql = "SELECT t.*,t2.name as client_name,(SELECT count(*) from {$this->tblName} t where {$where}) as total FROM {$this->tblName} t inner join rclient t2 on t.client_id = t2.id where {$where} order by {$_GET['fieldS']} {$_GET['dir']} limit {$start},{$_GET['pageSize']}";
            return $this->portal->query($sql)->result_array();
        }
        
        public function set($postInfo = array()){
        	// var_dump($postInfo);
        	// return true;
        	$id = 0;
			$log_client = 0;
			$email_adds = "";
			$send_this = false;
			$file_from = "";
        	if (sizeof($postInfo) == 0){
				foreach ($_POST as $key => $value) {
					if ($key == "id" || $key == "index" || $key == "idField" || $key == "_defaultId" || $key == "total" || $key == "rownum" || $key == "log_client" || $key == "email_adds" || $key == "send_this")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
					if (is_string($value))
						$postInfo[$key] = stripslashes($value);
				}
				$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_time'] = mdate("%H:%i:%s");
				$postInfo['log_created'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				if (isset($_POST['log_client']))
					$log_client = $_POST['log_client'];
				// if (isset($_POST['email_adds']))
					// $email_adds = $_POST['email_adds'];
				$filepath = 'e:\portal\pref.txt';
				if (file_exists($filepath)){
					$email_adds = read_file($filepath);
					$email_adds = explode(";",$email_adds);
				}
			}else {
				$id = $postInfo['id'];
				if (isset($postInfo['email_adds'])){					
					$email_adds = $postInfo['email_adds'];
					unset($postInfo['email_adds']);
				}
				if (isset($postInfo['file_from'])){					
					$file_from = $postInfo['file_from'];
					unset($postInfo['file_from']);
				}
				// $filepath = 'e:\portal\pref.txt';
				// if (file_exists($filepath)){
					// $email_adds = read_file($filepath);
					// $email_adds = explode(";",$email_adds);
				// }
				if (isset($postInfo['send_this'])){					
					$send_this = $postInfo['send_this'];
					unset($postInfo['send_this']);					
				}
			}
			
            if ($id > 0){
            	// $this->portal->where_in('id', $id);
            	unset($postInfo['id']);
				$this->portal->where("FIND_IN_SET(id, '{$id}')");
            	$query = $this->portal->update($this->tblName, $postInfo);
				if (!$query)
					return 'Update failed!';
							
            	$file_row = $this->portal->query("select * from {$this->tblName} where find_in_set(id,'{$id}') > 0")->result_array(); //$this->portal->get($this->tblName);
				$postInfo['name_array'] = array();
				$postInfo['remarks_array'] = array();
				$uploader = array();
				$email_adds = array();
				// echo "ID: " . $id;
				// var_dump($file_row->result_array());
				foreach ($file_row as $key => $value){
				    $postInfo['name_array'][$key] = $value['name'];
				    $postInfo['remarks_array'][$key] = $value['remarks'];
					if (!in_array($value['user_id'], $uploader)){
						$uploader[$key] = $value['user_id'];
											
						$ci =& get_instance();
						$ci->load->model('portal/ruser_model');
						$user_row = $ci->ruser_model->get_by_user($postInfo['log_user']); //$file_from
						if (!$user_row)
							return "User fetched failed!";					
						$file_orig = $ci->ruser_model->get_by_user($file_from); //$postInfo['log_user']
						if (!$file_orig)
							return "User fetched failed!";
						// echo $postInfo['log_user'] . "<br />";
						// var_dump($user_row);
						$postInfo['user_name'] = $user_row[0]['first_name'] . " " . $user_row[0]['last_name'];
						$email_adds[$key] = $file_orig[0]['email_add'];
							
						$ci =& get_instance();
						$ci->load->model('portal/rclient_model');
						$client_row = $ci->rclient_model->get_by_id($user_row[0]['client_id']);
						$postInfo['client_name'] = $client_row[0]['name'];
					}
				}
				// var_dump($postInfo['name_array']);
				// var_dump($email_adds);
				foreach ($email_adds as $key => $value) {						
					$query = $this->email->init(($file_row[0]['client_id'] == 15 ? "download_by_client" : "download"),'system@arcc-eei.com',$value,'','',$postInfo);
					if (!$query)
						return "Email Notification fails!";					
				}
				// $query = $this->auditTrail("MATERIAL REQUEST-PIPING (DTL)","EDIT");
			}else{
            	// $query = $this->is_entry_unique(array("name"=>$postInfo['name'],"log_date"=>$postInfo['log_date']));
            	// if (gettype($query) == 'boolean'){
					// if (!$query)
						// return "Record already exist!";
				// }else
					// return $query;
 				
				unset($postInfo['id']);
				unset($postInfo['email_adds']);
				$query = $this->portal->set($postInfo);
				$query = $this->portal->insert($this->tblName);
				if (!$query)
					return 'Insert failed!';
				else
					$id = $this->portal->insert_id();
				
				if ($send_this){
					$ci =& get_instance();
					$ci->load->model('portal/ruser_model');
					$user_row = $ci->ruser_model->get_by_user($postInfo['user_id']);
					$postInfo['user_name'] = $user_row[0]['first_name'] . " " . $user_row[0]['last_name'];
					$ci =& get_instance();
					
					$ci->load->model('portal/rclient_model');
					$client_row = $ci->rclient_model->get_by_id($user_row[0]['client_id']);
					$postInfo['client_name'] = $client_row[0]['name'];
					$query = $this->email->init(($postInfo['client_id'] == 15 ? "upload" : "upload_by_client"),'system@arcc-eei.com',(is_array($email_adds) ? $email_adds[0] : $email_adds),'','',$postInfo);
					if (!$query)
						return "Email Notification fails!";
				}
			}
			
			return $query;
        }

		public function reactivate($postInfo = array()){
			$sql = "update files set users = concat(users,'{$_POST['users_id']}') where find_in_set(id,'{$_POST['ids']}') > 0;";			
        	$query = $this->portal->query($sql);
			if (!$query)
				return 'Update failed!';
			$ci =& get_instance();
		    $ci->load->model("portal/audit_model");
			$ci->audit_model->set(array("tran_type"=>"Reactivation","user_id"=>$this->session->userdata('id'),"remarks"=>"Reactivated file/s for Users: " . $_POST['users_id'] . " with File ID's of " . $_POST['ids']));
			
			return $query;
		}
		
	    public function is_entry_unique($criteria = '') {
            $this->portal->select('count(*) as counter')->from($this->tblName)->where($criteria);
			$query = $this->portal->get();
			$result = $query->result();

	        if ($result !== FALSE) {
	            if ($result[0]->counter > 0) {
	                return FALSE;
	            } else{
	                return TRUE;
	            }
	        } else {
	            return 'Error in retrieving criteria.';
	        }
	    }
		
		public function remove(){			
			$query = $this->portal->where("id", $_POST['id']);
			$query = $this->portal->delete($this->tblName);			

			return $query;
		}
    }        
?>