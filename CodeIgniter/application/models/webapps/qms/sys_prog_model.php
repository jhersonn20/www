<?php
class SYS_PROG_Model extends CI_Model {
	private $tblName = "sys_prog";
	private $GLOBAL;
	public function __construct(){
		parent::__construct();
        $this->piping = $this->load->database('piping', true);
	}
	
	public function getAll(){
		$sql = "SELECT * FROM " . $this->tblName;
		return $this->piping->query($sql)->result_array();
	}
	
	public function getAllPlus(){
		$sql = "CREATE TEMPORARY TABLE tmp_ogmr5 like ogmr;\n"
		    . " INSERT INTO tmp_ogmr5 SELECT * FROM ogmr;\n"
		    . "";
		return $this->piping->query($sql); //->result_array();
	}
	
	public function getAllBooklet(){
		$sql = "SELECT booklet_no FROM " . $this->tblName . " GROUP BY booklet_no";
		return $this->piping->query($sql)->result_array();
	}
	
	public function get_by_prog($prog = ""){
		$sql = "SELECT * FROM {$this->tblName} WHERE prog_code = '{$prog}'";
		return $this->piping->query($sql)->result_array();
	}
	
	public function get_by_DEFAULT_DISC($prog = ""){
		$sql = "SELECT * FROM {$this->tblName} WHERE prog_code = '{$prog}'";
		return $this->piping->query($sql)->result_array();
	}
    public function get_PROG_CODE($fields){
    		$sql = "SELECT p_char1,p_char2,p_char3,p_char4 from {$this->tblName} where prog_code = ?";
			return $this->piping->query($sql, $fields)->result_array();
    }    
    public function getUser($filters){
    	$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ?";
		$query = $this->piping->query($sql, $filters[0]);
		if ($query->num_rows() > 0){
			$row = $query->row();
			//echo "Orig: " . $row->password . " Substr: " . substr($row->password, 0, 64) . " Keyed: " . $filters[1] . "<br />";
			$salt = substr($row->password, 0, 64);
			$hash = $this->makeHash($salt, $filters[1]);
	
			//echo "Orig: " . $row->password . " Keyed: " . $hash;
        	$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ? AND password = ?";
            $query = $this->piping->query($sql, array($row->user_id,$hash)); //$row->password
			if ($query->num_rows() > 0)
				return array("user_id"=>$query->row()->user_id,"user_name"=>$query->row()->user_name,"PROGRESS_RECID"=>$query->row()->PROGRESS_RECID);
			else
				return false;
		}else
			return false;            
    }
	
	public function set_sysProg(){
		if ($_POST['PROGRESS_RECID'] > 0){
	        $postInfo = array("job_no"=>$_POST['job_no'],
	        				  "booklet_no"=>$_POST['booklet_no'],
	        				  "requisitioner"=>mysql_real_escape_string($_POST['requisitioner']),
	        				  "trans_date"=>$_POST['trans_date'],
	        				  "addressee"=>mysql_real_escape_string($_POST['addressee']),
	        				  "dept"=>$_POST['dept'],
	        				  "file_attach"=>$_POST['file_attach'],
	        				  "description"=>mysql_real_escape_string($_POST['description']),
	        				  "remarks"=>mysql_real_escape_string($_POST['remarks']));
							  
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->update($this->tblName, $postInfo);
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
	        				  //"flg_status"=>$_POST['flg_status'],
	        				  //"log_user"=>mysql_real_escape_string($_POST['user_id']),
	        				  "log_date"=>mdate("%Y-%m-%d")
	        				  //,
	        				  //"log_update"=>mysql_real_escape_string($_POST['user_id']) . " " . mdate("%Y-%m-%d")
							  );
			
			$query = $this->piping->set($postInfo);
			$query = $this->piping->insert($this->tblName);
		}
		return $query;
	}
		
	public function remove_sysProg(){
        $query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
    	$query = $this->piping->delete($this->tblName);
		return $query;
	}
}
?>