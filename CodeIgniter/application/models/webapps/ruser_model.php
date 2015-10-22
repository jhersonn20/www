<?php
class RUSER_Model extends CI_Model {
	private $tblName = "ruser";
	private $GLOBAL;
	public function __construct(){
		//$this->load->database();
		//$this->GLOBAL = $this->load->database("default", TRUE);
		//$DB1 = $this->load->database('group_one', TRUE);
        $this->gendb = $this->load->database('gendb', true);
	}
	
	public function getAll($where = ""){
		$start = ($_GET['page'] - 1) * $_GET['pageSize'];
		//$sql = "SELECT (select count(*) FROM {$this->tblName}) as total,PROGRESS_RECID,user_id,user_name,jsa,sa,auditor,duration_day,expiry_date,inactive FROM {$this->tblName} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
		
		if ($_GET['value'] == ""){
			//$sql = "SELECT (select count(*) FROM ogmr) as total,PROGRESS_RECID,job_no,booklet_no,ogmr_no,requisitioner,trans_date,addressee,description,dept,remarks,file_attach,upload_no,loguser,logdate,logupdate FROM {$this->tblName} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
			$query = $this->gendb->select("(select count(*) FROM {$this->tblName}) as total,PROGRESS_RECID,user_id,user_name,jsa,sa,auditor,duration_day,expiry_date,inactive")->from($this->tblName)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
			$query = $this->gendb->get();
			$rowArr = $query->result_array();
		}else {
			if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
				/*$sql = "SELECT (select count(*) FROM ogmr where {$_GET['fieldF']} like '%{$_GET['value']}%') as total,PROGRESS_RECID,job_no,booklet_no,ogmr_no,requisitioner,trans_date,addressee,description,dept,remarks,file_attach,upload_no,loguser,logdate,logupdate FROM {$this->tblName} where {$_GET['fieldF']} like '%{$_GET['value']}%' order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$_GET['pageSize']},{$start}";*/
				/*$query = $this->projdb->select('count(*)','total')->from($this->tblName)->where($_GET['fieldF'], $_GET['value'])->order_by($_GET['dir'])->limit($_GET['pageSize'],$start);
				$query = $this->projdb->get();*/
				$query = $this->gendb->select('count(*) as total')->from($this->tblName)->where($where); //->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
				$query = $this->gendb->get();
				$total = $query->result();
				$total = $total[0]->total;
				
				$query = $this->gendb->select('PROGRESS_RECID,user_id,user_name,jsa,sa,auditor,duration_day,expiry_date,inactive')->from($this->tblName)->where($where)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
				$query = $this->gendb->get();
				$rowArr = $query->result_array();
				$rowArr[0]['total'] = $total;
			}else{
				$sql = "SELECT (select count(*) FROM {$this->tblName} where {$_GET['value']}) as total,PROGRESS_RECID,user_id,user_name,jsa,sa,auditor,duration_day,expiry_date,inactive FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
				$rowArr = $this->gendb->query($sql)->result_array();
			}
		}
		return $rowArr; //$this->gendb->query($sql)->result_array();
	}
	
	public function get_all_inactive(){
		$start = ($_GET['page'] - 1) * $_GET['pageSize'];
		$sql = "SELECT (select count(*) FROM {$this->tblName} WHERE inactive) as total,PROGRESS_RECID,user_id,user_name FROM " . $this->tblName . " where inactive order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
		return $this->gendb->query($sql)->result_array();
	}
	
	public function getByUserOnly($user_name = ""){
		$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ?";
		return $this->gendb->query($sql, (isset($_POST['user_id']) ? $_POST['user_id'] : $user_name))->result_array();
	}
        
    public function getUser($filters){
    	$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ?";
		$query = $this->gendb->query($sql, $filters[0]);
		if ($query->num_rows() > 0){
			$row = $query->row();
			//echo "Orig: " . $row->password . " Substr: " . substr($row->password, 0, 64) . " Keyed: " . $filters[1] . "<br />";
			$salt = substr($row->password, 0, 64);
			$hash = $this->makeHash($salt, $filters[1]);
	
			//echo "Orig: " . $row->password . " Keyed: " . $hash;
        	$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ? AND password = ?";
            $query = $this->gendb->query($sql, array($row->user_id,$hash)); //$row->password
			if ($query->num_rows() > 0)
				return array("inactive"=>$query->row()->inactive,"user_id"=>$query->row()->user_id,"user_name"=>$query->row()->user_name,"PROGRESS_RECID"=>$query->row()->PROGRESS_RECID,"sa"=>$query->row()->sa,"jsa"=>$query->row()->jsa,"auditor"=>$query->row()->auditor);
			else
				return false;
		}else
			return false;            
    }
	
	public function setUser(){
		if ($_POST['PROGRESS_RECID'] > 0){
	        $postInfo = array("sa"=>$_POST['sa'],
	        				  "jsa"=>$_POST['jsa'],
	        				  "auditor"=>$_POST['auditor'],
	        				  "user_name"=>mysql_real_escape_string($_POST['user_name']),
	        				  "duration_day"=>$_POST['duration_day'],
	        				  "expiry_date"=>$_POST['expiry_date'],
							  "logdate"=>mdate("%Y-%m-%d"),
							  "loguser"=>$_POST['loguser']);
							  
        	$query = $this->gendb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->gendb->update($this->tblName, $postInfo);
		}else {
			$salt = hash('sha256', uniqid(mt_rand(), true) . RANDOMNO . strtolower(mysql_real_escape_string($_POST['user_id'])));
			$hash = $this->makeHash($salt, $_POST['password']);
	        $postInfo = array("PROGRESS_RECID"=>$_POST['PROGRESS_RECID'],
	        				  "sa"=>$_POST['sa'],
	        				  "jsa"=>$_POST['jsa'],
	        				  "auditor"=>$_POST['auditor'],
	        				  "inactive"=>$_POST['inactive'],
	        				  "user_id"=>mysql_real_escape_string($_POST['user_id']),
	        				  "user_name"=>mysql_real_escape_string($_POST['user_name']),
	        				  "password"=>$hash,
	        				  "duration_day"=>$_POST['duration_day'],
	        				  "expiry_date"=>$_POST['expiry_date'],
							  "logdate"=>mdate("%Y-%m-%d"),
							  "loguser"=>$_POST['loguser']);
			
			$query = $this->gendb->set($postInfo);
			$query = $this->gendb->insert($this->tblName);
		}
		return $query;
	}
	
	public function toggle_status($user_id = "", $inactive = 0){
		$sql = "SELECT inactive FROM {$this->tblName} where user_id = '{$user_id}'";
		$query = $this->gendb->query($sql);
		if ($query->num_rows() > 0){
			$row = $query->row();
			
			$query = $this->gendb->where('user_id', $user_id);
	        $query = $this->gendb->update($this->tblName, array('inactive' => $inactive /*(($row->inactive) ? 0 : 1)*/));
		}
		
		return $query;
	}

	public function setUser_PW(){
		$sql = "SELECT * FROM " . $this->tblName . " WHERE PROGRESS_RECID = ?";
		$query = $this->gendb->query($sql, $_POST['recid']);
		if ($query->num_rows() > 0){	
			$row = $query->row();
			$salt = substr($row->password, 0, 64);
			$hash = $this->makeHash($salt, $_POST['currPass']);
			
			//$salt = hash('sha256', uniqid(mt_rand(), true) . RANDOMNO . strtolower($_POST['user_id']));
			//$hash = $this->makeHash($salt, $_POST['currPass']);
			
			$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ? and password = ?";
			$query = $this->gendb->query($sql, array($_POST['user_id'],$hash));
			if ($query->num_rows() > 0){
				
				$salt2 = hash('sha256', uniqid(mt_rand(), true) . RANDOMNO . strtolower($_POST['user_id']));
				$hash2 = $this->makeHash($salt2, $_POST['newPass']);
				
			    $sql = "UPDATE " . $this->tblName . " SET password = ? WHERE user_id = ? and password = ?";
			    $query = $this->gendb->query($sql, array($hash2,$_POST['user_id'],$hash));
				return array(true);
			}else
				return false;
		}else
			return false;
		/*else
			return array("user_id"=>$_POST['user_id'],"password"=>$_POST['currPass'],"encrypt"=>$hash);*/
    	/*$sql = "SELECT * FROM " . $this->tblName . " WHERE PROGRESS_RECID = ?";
		$query = $this->gendb->query($sql, $_POST['PROGRESS_RECID']);
		if ($query->num_rows() > 0){	
			$row = $query->row();
			$salt = substr($row->password, 0, 64);
			$hash = $this->makeHash($salt, $filters[1]);	
			
        	$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ? AND password = ?";
            $query = $this->gendb->query($sql, array($row->user_id,$hash));
			if ($query->num_rows() > 0){				
				$salt2 = hash('sha256', uniqid(mt_rand(), true) . RANDOMNO . strtolower($row->user_id));
				$hash2 = $this->makeHash($salt2, $filters[2]);
		
	        	$sql = "UPDATE " . $this->tblName . " SET password = ? WHERE user_id = ? AND password = ?";
	            return $this->gendb->query($sql, array($hash2,$row->user_id,$hash));
			}else
				return false;
		}*/
	}

	public function setUser_PW2(){
		$sql = "SELECT * FROM " . $this->tblName . " WHERE PROGRESS_RECID = ?";
		$query = $this->gendb->query($sql, $_POST['recid']);
		if ($query->num_rows() > 0){	
			/*$row = $query->row();
			$salt = substr($row->password, 0, 64);
			$hash = $this->makeHash($salt, $_POST['currPass']);
			
			$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ? and password = ?";
			$query = $this->gendb->query($sql, array($_POST['user_id'],$hash));
			if ($query->num_rows() > 0){*/
				
				$salt2 = hash('sha256', uniqid(mt_rand(), true) . RANDOMNO . strtolower($_POST['user_id']));
				$hash2 = $this->makeHash($salt2, $_POST['newPass']);
				
			    $sql = "UPDATE " . $this->tblName . " SET password = ? WHERE user_id = ? and PROGRESS_RECID = ?";
			    $query = $this->gendb->query($sql, array($hash2,$_POST['user_id'],$_POST['recid']));
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
		
	public function remove_user(){
    	$query = $this->gendb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
    	$query = $this->gendb->delete($this->tblName);
		return $query;
	}
		
	public function remove_user_inactive($param = ""){
        // Load First_model
        $ci =& get_instance();
        $ci->load->model('webapps/appl_user_model');
        
		if ($param == "all"){
			$sql = "SELECT * FROM {$this->tblName} where inactive";
			$row = $this->gendb->query($sql);
			if ($row->num_rows() > 0){
				$rows = $row->row();
				
				$ci->appl_user_model->remove_all_appl_byUser($rows->user_id);
				
		    	$query = $this->gendb->where('inactive', 1);
		    	$query = $this->gendb->delete($this->tblName);
			}
		}else {
			$sql = "SELECT * FROM {$this->tblName} where PROGRESS_RECID = {$_POST['PROGRESS_RECID']}";
			$row = $this->gendb->query($sql);
			if ($row->num_rows() > 0){
				$rows = $row->row();
				
				$ci->appl_user_model->remove_all_appl_byUser($rows->user_id);
				
		    	$query = $this->gendb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
		    	$query = $this->gendb->delete($this->tblName);
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