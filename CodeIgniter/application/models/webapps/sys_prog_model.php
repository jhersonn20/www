<?php
class SYS_PROG_Model extends CI_Model {
	private $tblName = "sys_prog";
	private $GLOBAL;
	public function __construct(){
		parent::__construct();
        $this->projdb = $this->load->database('projdb', true);
	}
	
	public function getAll(){
		$sql = "SELECT * FROM " . $this->tblName;
		return $this->projdb->query($sql)->result_array();
	}
	
	public function getAllPlus(){
		$sql = "CREATE TEMPORARY TABLE tmp_ogmr5 like ogmr;\n"
		    . " INSERT INTO tmp_ogmr5 SELECT * FROM ogmr;\n"
		    . "";
		return $this->projdb->query($sql); //->result_array();
	}
	
	public function getAllBooklet(){
		$sql = "SELECT booklet_no FROM " . $this->tblName . " GROUP BY booklet_no";
		return $this->projdb->query($sql)->result_array();
	}
	
	public function get_by_prog($prog = ""){
		$sql = "SELECT * FROM {$this->tblName} WHERE prog_code = '{$prog}'";
		return $this->projdb->query($sql)->result_array();
	}
        
    public function getUser($filters){
    	$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ?";
		$query = $this->projdb->query($sql, $filters[0]);
		if ($query->num_rows() > 0){
			$row = $query->row();
			//echo "Orig: " . $row->password . " Substr: " . substr($row->password, 0, 64) . " Keyed: " . $filters[1] . "<br />";
			$salt = substr($row->password, 0, 64);
			$hash = $this->makeHash($salt, $filters[1]);
	
			//echo "Orig: " . $row->password . " Keyed: " . $hash;
        	$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ? AND password = ?";
            $query = $this->projdb->query($sql, array($row->user_id,$hash)); //$row->password
			if ($query->num_rows() > 0)
				return array("user_id"=>$query->row()->user_id,"user_name"=>$query->row()->user_name,"PROGRESS_RECID"=>$query->row()->PROGRESS_RECID);
			else
				return false;
		}else
			return false;            
    }
	
	public function set_sysProg(){
		if ($_POST['PROGRESS_RECID'] > 0){
	        $postInfo = array("prog_code"=>mysql_real_escape_string($_POST['prog_code']),
	        				  "prog_type"=>$_POST['prog_type'],
	        				  "p_char1"=>mysql_real_escape_string($_POST['p_char1']),
	        				  "p_char2"=>mysql_real_escape_string($_POST['p_char2']),
	        				  "p_char3"=>mysql_real_escape_string($_POST['p_char3']),
	        				  "p_char4"=>mysql_real_escape_string($_POST['p_char4']),
	        				  "p_char5"=>mysql_real_escape_string($_POST['p_char5']),
	        				  "p_char6"=>mysql_real_escape_string($_POST['p_char6']),
	        				  "p_char7"=>mysql_real_escape_string($_POST['p_char7']),
	        				  "p_char8"=>mysql_real_escape_string($_POST['p_char8']),
	        				  "p_char9"=>mysql_real_escape_string($_POST['p_char9']),
	        				  "p_char10"=>mysql_real_escape_string($_POST['p_char10']),
	        				  "log_date"=>mdate("%Y-%m-%d"));
							  
        	$query = $this->projdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->projdb->update($this->tblName, $postInfo);
		}else {
	        $postInfo = array("prog_code"=>mysql_real_escape_string($_POST['prog_code']),
	        				  "prog_type"=>$_POST['prog_type'],
	        				  "p_char1"=>mysql_real_escape_string($_POST['p_char1']),
	        				  "p_char2"=>mysql_real_escape_string($_POST['p_char2']),
	        				  "p_char3"=>mysql_real_escape_string($_POST['p_char3']),
	        				  "p_char4"=>mysql_real_escape_string($_POST['p_char4']),
	        				  "p_char5"=>mysql_real_escape_string($_POST['p_char5']),
	        				  "p_char6"=>mysql_real_escape_string($_POST['p_char6']),
	        				  "p_char7"=>mysql_real_escape_string($_POST['p_char7']),
	        				  "p_char8"=>mysql_real_escape_string($_POST['p_char8']),
	        				  "p_char9"=>mysql_real_escape_string($_POST['p_char9']),
	        				  "p_char10"=>mysql_real_escape_string($_POST['p_char10']),
	        				  "flg_status"=>1,
	        				  //"log_user"=>mysql_real_escape_string($_POST['user_id']),
	        				  "log_date"=>mdate("%Y-%m-%d")
	        				  //,
	        				  //"log_update"=>mysql_real_escape_string($_POST['user_id']) . " " . mdate("%Y-%m-%d")
							  );
			
			$query = $this->projdb->set($postInfo);
			$query = $this->projdb->insert($this->tblName);
		}
		return $query;
	}
		
	public function remove_sysProg(){
        $query = $this->projdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
    	$query = $this->projdb->delete($this->tblName);
		return $query;
	}
}
?>