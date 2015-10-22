<?php
class TEMPDB_OGMR_Model extends CI_Model {
	private $tblName = "ogmr";
	private $GLOBAL;
	public function __construct(){
		parent::__construct();
		//$this->load->database();
		//$this->GLOBAL = $this->load->database("default", TRUE);
		//$DB1 = $this->load->database('group_one', TRUE);
        $this->tempdb = $this->load->database('tempdb', true);
	}
	
	public function getAll(){
		$start = ($_GET['page'] - 1) * $_GET['pageSize'];
		$sql = "SELECT (select count(*) FROM ogmr) as total,PROGRESS_RECID,job_no,booklet_no,ogmr_no,requisitioner,trans_date,addressee,description,dept,remarks,file_attach,upload_no,loguser,logdate,logupdate FROM " . $this->tblName . " order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
		return $this->tempdb->query($sql)->result_array();
	}
	
	public function getAllPlus(){
		$start = ($_GET['page'] - 1) * $_GET['pageSize'];
		$iUse = $_GET['iUse'] + 1;
		if ($iUse == 1){
			$sql = "SELECT (select count(*) FROM ogmr) as total,PROGRESS_RECID,job_no,";
			$sql .= "booklet_no,ogmr_no,requisitioner,trans_date,addressee,description,";
			$sql .= "dept,remarks,file_attach,upload_no,loguser,logdate,logupdate,iUse";
			$sql .= " FROM {$this->tblName}";
			$sql .= " order by ogmr_no";
			$sql .= " LIMIT {$start},{$_GET['pageSize']}";
		}else{
			$sql = "SELECT (select count(*) FROM ogmr where iUse = {$iUse}) as total,PROGRESS_RECID,job_no,";
			$sql .= "booklet_no,ogmr_no,requisitioner,trans_date,addressee,description,";
			$sql .= "dept,remarks,file_attach,upload_no,loguser,logdate,logupdate,iUse";
			$sql .= " FROM {$this->tblName}";
			$sql .= " where iUse = {$iUse}";
			$sql .= " order by ogmr_no";
			$sql .= " LIMIT {$start},{$_GET['pageSize']}";
		}
			
		return $query = $this->tempdb->query($sql)->result_array();
        //$query = $this->tempdb->query("select @y:=max(convert(ogmr_no,unsigned)) from (select * from tempdb.ogmr order by convert(ogmr_no,unsigned) limit 0, 1000) as max");
        //$query = $this->tempdb->query("CALL tempdb.query_ogmr()")->result_array();

		//return $query;
	}
	
	public function getAllBooklet(){
		$sql = "SELECT booklet_no FROM " . $this->tblName . " GROUP BY booklet_no";
		return $this->tempdb->query($sql)->result_array();
	}
        
    public function getUser($filters){
    	$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ?";
		$query = $this->tempdb->query($sql, $filters[0]);
		if ($query->num_rows() > 0){
			$row = $query->row();
			//echo "Orig: " . $row->password . " Substr: " . substr($row->password, 0, 64) . " Keyed: " . $filters[1] . "<br />";
			$salt = substr($row->password, 0, 64);
			$hash = $this->makeHash($salt, $filters[1]);
	
			//echo "Orig: " . $row->password . " Keyed: " . $hash;
        	$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ? AND password = ?";
            $query = $this->tempdb->query($sql, array($row->user_id,$hash)); //$row->password
			if ($query->num_rows() > 0)
				return array("user_id"=>$query->row()->user_id,"user_name"=>$query->row()->user_name,"PROGRESS_RECID"=>$query->row()->PROGRESS_RECID);
			else
				return false;
		}else
			return false;            
    }
	
	public function set_ogmr(){
		if ($_POST['PROGRESS_RECID'] > 0){
	        $postInfo = array("job_no"=>$_POST['job_no'],
	        				  "booklet_no"=>$_POST['booklet_no'],
	        				  "requisitioner"=>mysql_real_escape_string($_POST['requisitioner']),
	        				  "trans_date"=>$_POST['trans_date'],
	        				  "addressee"=>mysql_real_escape_string($_POST['addressee']),
	        				  "dept"=>$_POST['dept'],
	        				  "file_attach"=>mysql_real_escape_string($_POST['file_attach']),
	        				  "description"=>mysql_real_escape_string($_POST['description']),
	        				  "remarks"=>mysql_real_escape_string($_POST['remarks']));
							  
        	$query = $this->tempdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->tempdb->update($this->tblName, $postInfo);
		}else {
	        $postInfo = array("ogmr_no"=>$_POST['ogmr_no'],
	        				  "loguser"=>$_POST['loguser'],
	        				  "logdate"=>mdate("%Y-%m-%d"),
	        				  "job_no"=>$_POST['job_no'],
	        				  "booklet_no"=>$_POST['booklet_no'],
	        				  "requisitioner"=>mysql_real_escape_string($_POST['requisitioner']),
	        				  "trans_date"=>$_POST['trans_date'],
	        				  "addressee"=>mysql_real_escape_string($_POST['addressee']),
	        				  "dept"=>$_POST['dept'],
	        				  "upload_no"=>$_POST['upload_no'],
	        				  "file_attach"=>mysql_real_escape_string($_POST['file_attach']),
	        				  "description"=>mysql_real_escape_string($_POST['description']),
	        				  "remarks"=>mysql_real_escape_string($_POST['remarks']));
			
			$query = $this->tempdb->set($postInfo);
			$query = $this->tempdb->insert($this->tblName);
		}
		return $query;
	}
		
	public function remove_ogmr(){
        $query = $this->tempdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
    	$query = $this->tempdb->delete($this->tblName);
		return $query;
	}
}
?>