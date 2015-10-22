<?php

class RUSER_Model extends CI_Model {
	private $tblName = "ruser";
	private $GLOBAL;
	public function __construct(){
		//$this->load->database();
		//$this->GLOBAL = $this->load->database("default", TRUE);
		//$DB1 = $this->load->database('group_one', TRUE);
        $this->portal = $this->load->database('portal', true);
        $this->load->library(array('portal/email'));
	}
	
	public function get_all($where = ""){
		$start = ($_GET['page'] - 1) * $_GET['pageSize'];
		if ($where != "")
    		$sql = "SELECT t.id,t.client_id,t.first_name,t.middle_name,t.last_name,t.expiry,t.log_user,t.log_date,t.log_time,t.log_created,t.user_id,t.email_add,t2.name as client_name,t2.short_desc as client_short,(SELECT count(*) from {$this->tblName} t inner join rclient t2 on t.client_id = t2.id where {$where}) as total FROM {$this->tblName} t inner join rclient t2 on t.client_id = t2.id where {$where} order by {$_GET['fieldS']} {$_GET['dir']} limit {$start},{$_GET['pageSize']}";
		else
    		$sql = "SELECT t.id,t.client_id,t.first_name,t.middle_name,t.last_name,t.expiry,t.log_user,t.log_date,t.log_time,t.log_created,t.user_id,t.email_add,t2.name as client_name,t2.short_desc as client_short,(SELECT count(*) from {$this->tblName} t inner join rclient t2 on t.client_id = t2.id) as total FROM {$this->tblName} t inner join rclient t2 on t.client_id = t2.id order by {$_GET['fieldS']} {$_GET['dir']} limit {$start},{$_GET['pageSize']}";
        return $this->portal->query($sql)->result_array();
	}

	public function get_expired($files_id){
		$sql = "SELECT id,concat(last_name, ', ', first_name) as name FROM {$this->tblName} WHERE find_in_set(id,(select expired_users from files where id = {$_GET['file_id']})) > 0";
        return $this->portal->query($sql)->result_array();
	}
	
	public function get_all_inactive(){
		$start = ($_GET['page'] - 1) * $_GET['pageSize'];
		$sql = "SELECT (select count(*) FROM {$this->tblName} WHERE inactive) as total,PROGRESS_RECID,user_id,user_name FROM " . $this->tblName . " where inactive order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
		return $this->portal->query($sql)->result_array();
	}
	
	public function get_by_user($user_id){
		$sql = "SELECT * FROM {$this->tblName} WHERE user_id = '{$user_id}' limit 1";
		return $this->portal->query($sql)->result_array();
	}
	
	public function get_by_id($id){
		$sql = "SELECT * FROM {$this->tblName} WHERE id = {$id} limit 1";
		return $this->portal->query($sql)->result_array();
	}
	
	public function get_all_dd($user_id){
		$sql = "SELECT t.id,concat(last_name,', ',first_name,' (',t2.short_desc,')') as name FROM {$this->tblName} t inner join rclient t2 on t.client_id = t2.id";
		return $this->portal->query($sql)->result_array();
	}
        
    public function getUser($filters){
    	$sql = "SELECT * FROM {$this->tblName} WHERE user_id = ?";
		$query = $this->portal->query($sql, $filters[0]);
		if ($query->num_rows() > 0){
			$row = $query->row();
			
			//echo "Orig: " . $row->password . " Substr: " . substr($row->password, 0, 64) . " Keyed: " . $filters[1] . "<br />";
			$salt = substr($row->password, 0, 64);
			$hash = $this->makeHash($salt, $filters[1]);
	
			//echo "Orig: " . $row->password . " Keyed: " . $hash;
        	$sql = "SELECT *,(select group_concat(t2.id) from ruser t2 where t2.user_id = SUBSTRING_INDEX(t.log_created, ' ', 1)) as creator FROM {$this->tblName} t WHERE user_id = ? AND password = ?";
            $query = $this->portal->query($sql, array($row->user_id,$hash)); //$row->password
			if ($query->num_rows() > 0)
				return array("user_id"=>$query->row()->user_id,"id"=>$query->row()->id,"first_name"=>$query->row()->first_name,"last_name"=>$query->row()->last_name,"expiry"=>$query->row()->expiry,"client_id"=>$query->row()->client_id,"creator"=>$query->row()->creator);
			else
				return false;
		}else
			return false;            
    }
	
	public function set($postInfo = array()){
		$id = 0;
    	if (sizeof($postInfo) == 0){
			foreach ($_POST as $key => $value) {
				if ($key == "id" || $key == "index" || $key == "idField" || $key == "_defaultId" || $key == "total" || $key == "rownum" || $key == "client_name" || $key == "client_short")
					continue;
				$postInfo[$key] = mysql_real_escape_string($value);
				if (is_string($value))
					$postInfo[$key] = stripslashes($value);
			}
			$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
			$postInfo['log_time'] = mdate("%Y-%m-%d %H:%i:%s");
			$postInfo['log_created'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
			$id = $_POST['id'];
		}else
			$id = $postInfo['id'];
		
		if ($id > 0){
			if (isset($postInfo['password'])){			
				$salt = hash('sha256', uniqid(mt_rand(), true) . RANDOMNO . strtolower(mysql_real_escape_string($postInfo['user_id'])));
				$hash = $this->makeHash($salt, $postInfo['password']);
		        $postInfo['password'] = $hash;				
			}
			
        	$query = $this->portal->where('id', $id);
        	$query = $this->portal->update($this->tblName, $postInfo);
		}else {
        	$query = $this->is_entry_unique(array("user_id"=>$postInfo['user_id'],"client_id"=>$postInfo['client_id']));
        	if (gettype($query) == 'boolean'){
				if (!$query)
					return "Record already exist!";
			}else
				return $query;
			
			$salt = hash('sha256', uniqid(mt_rand(), true) . RANDOMNO . strtolower(mysql_real_escape_string($postInfo['user_id'])));
			$pword = $postInfo['password'];
			$hash = $this->makeHash($salt, $postInfo['password']);
	        $postInfo['password'] = $hash;
			
			unset($postInfo['id']);
			$query = $this->portal->set($postInfo);
			$query = $this->portal->insert($this->tblName);			
					
			$postInfo['pword'] = $pword;	
			$query = $this->email->init('login_credential','system@arcc-eei.com',$postInfo['email_add'],'','',$postInfo);
			if (!$query)
				return "Email Notification fails!";
		}
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
	
	public function toggle_status($user_id = "", $inactive = 0){
		$sql = "SELECT inactive FROM {$this->tblName} where user_id = '{$user_id}'";
		$query = $this->portal->query($sql);
		if ($query->num_rows() > 0){
			$row = $query->row();
			
			$query = $this->portal->where('user_id', $user_id);
	        $query = $this->portal->update($this->tblName, array('inactive' => $inactive /*(($row->inactive) ? 0 : 1)*/));
		}
		
		return $query;
	}

	public function setUser_PW(){
		$sql = "SELECT * FROM " . $this->tblName . " WHERE PROGRESS_RECID = ?";
		$query = $this->portal->query($sql, $_POST['recid']);
		if ($query->num_rows() > 0){	
			$row = $query->row();
			$salt = substr($row->password, 0, 64);
			$hash = $this->makeHash($salt, $_POST['currPass']);
			
			//$salt = hash('sha256', uniqid(mt_rand(), true) . RANDOMNO . strtolower($_POST['user_id']));
			//$hash = $this->makeHash($salt, $_POST['currPass']);
			
			$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ? and password = ?";
			$query = $this->portal->query($sql, array($_POST['user_id'],$hash));
			if ($query->num_rows() > 0){
				
				$salt2 = hash('sha256', uniqid(mt_rand(), true) . RANDOMNO . strtolower($_POST['user_id']));
				$hash2 = $this->makeHash($salt2, $_POST['newPass']);
				
			    $sql = "UPDATE " . $this->tblName . " SET password = ? WHERE user_id = ? and password = ?";
			    $query = $this->portal->query($sql, array($hash2,$_POST['user_id'],$hash));
				return array(true);
			}else
				return false;
		}else
			return false;
		/*else
			return array("user_id"=>$_POST['user_id'],"password"=>$_POST['currPass'],"encrypt"=>$hash);*/
    	/*$sql = "SELECT * FROM " . $this->tblName . " WHERE PROGRESS_RECID = ?";
		$query = $this->portal->query($sql, $_POST['PROGRESS_RECID']);
		if ($query->num_rows() > 0){	
			$row = $query->row();
			$salt = substr($row->password, 0, 64);
			$hash = $this->makeHash($salt, $filters[1]);	
			
        	$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ? AND password = ?";
            $query = $this->portal->query($sql, array($row->user_id,$hash));
			if ($query->num_rows() > 0){				
				$salt2 = hash('sha256', uniqid(mt_rand(), true) . RANDOMNO . strtolower($row->user_id));
				$hash2 = $this->makeHash($salt2, $filters[2]);
		
	        	$sql = "UPDATE " . $this->tblName . " SET password = ? WHERE user_id = ? AND password = ?";
	            return $this->portal->query($sql, array($hash2,$row->user_id,$hash));
			}else
				return false;
		}*/
	}

	public function setUser_PW2(){
		$sql = "SELECT * FROM " . $this->tblName . " WHERE PROGRESS_RECID = ?";
		$query = $this->portal->query($sql, $_POST['recid']);
		if ($query->num_rows() > 0){	
			/*$row = $query->row();
			$salt = substr($row->password, 0, 64);
			$hash = $this->makeHash($salt, $_POST['currPass']);
			
			$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ? and password = ?";
			$query = $this->portal->query($sql, array($_POST['user_id'],$hash));
			if ($query->num_rows() > 0){*/
				
				$salt2 = hash('sha256', uniqid(mt_rand(), true) . RANDOMNO . strtolower($_POST['user_id']));
				$hash2 = $this->makeHash($salt2, $_POST['newPass']);
				
			    $sql = "UPDATE " . $this->tblName . " SET password = ? WHERE user_id = ? and PROGRESS_RECID = ?";
			    $query = $this->portal->query($sql, array($hash2,$_POST['user_id'],$_POST['recid']));
				return "Array"; //array(true);
			/*}else
				return false;*/
		}else
			return false;
	}
	
	private	function makeHash($salt, $pword){	
		// Prefix the password with the salt
		$hash = $salt . $pword;
		
		// Hash the salted password a bunch of times
		for ( $i = 0; $i < 10; $i ++ ) {
		  $hash = hash('sha256', $hash);
		}
		
		// Prefix the hash with the salt so we can find it back later
		$hash = $salt . $hash;
		return $hash;	
	}
		
	public function remove(){
    	$query = $this->portal->where('id', $_POST['id']);
    	$query = $this->portal->delete($this->tblName);
		return $query;
	}
		
	public function remove_user_inactive($param = ""){
        // Load First_model
        $ci =& get_instance();
        $ci->load->model('webapps/appl_user_model');
        
		if ($param == "all"){
			$sql = "SELECT * FROM {$this->tblName} where inactive";
			$row = $this->portal->query($sql);
			if ($row->num_rows() > 0){
				$rows = $row->row();
				
				$ci->appl_user_model->remove_all_appl_byUser($rows->user_id);
				
		    	$query = $this->portal->where('inactive', 1);
		    	$query = $this->portal->delete($this->tblName);
			}
		}else {
			$sql = "SELECT * FROM {$this->tblName} where PROGRESS_RECID = {$_POST['PROGRESS_RECID']}";
			$row = $this->portal->query($sql);
			if ($row->num_rows() > 0){
				$rows = $row->row();
				
				$ci->appl_user_model->remove_all_appl_byUser($rows->user_id);
				
		    	$query = $this->portal->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
		    	$query = $this->portal->delete($this->tblName);
			}
	    }
		return $query;
	}
	
	public function rpt_user(){
		$sql = " {{$this->tblName}.company_code} = 'ARCC'";
		
		return $sql;
	}
}
?>