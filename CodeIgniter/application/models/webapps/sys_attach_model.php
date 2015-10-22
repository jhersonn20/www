<?php
class SYS_ATTACH_Model extends CI_Model {
	private $tblName = "sys_attach";
	private $GLOBAL;
	public function __construct(){
		parent::__construct();
        $this->projdb = $this->load->database('projdb', true);
	}
	
	public function getAll($where = ""){
		/*$sql = "SELECT * FROM " . $this->tblName;
		return $this->projdb->query($sql)->result_array();*/
		$start = ($_GET['page'] - 1) * $_GET['pageSize'];
		if ($_GET['value'] == ""){
			//$sql = "SELECT (select count(*) FROM {$this->tblName}) as total ,PROGRESS_RECID,prog_code,sys_app,sys_trans,attach_path,modules FROM {$this->tblName} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
			$query = $this->projdb->select("(select count(*) FROM {$this->tblName}) as total ,PROGRESS_RECID,prog_code,sys_app,sys_trans,attach_path,modules,flg_status")->from($this->tblName)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
			$query = $this->projdb->get();
			$rowArr = $query->result_array();
		}else {
			if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
				//$sql = "SELECT (select count(*) FROM {$this->tblName} where {$_GET['fieldF']} like '%{$_GET['value']}%') as total,PROGRESS_RECID,prog_code,sys_app,sys_trans,attach_path,modules FROM {$this->tblName} where {$_GET['fieldF']} like '%{$_GET['value']}%' order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
				$query = $this->projdb->select('count(*) as total')->from($this->tblName)->where($where); //->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
				$query = $this->projdb->get();
				$total = $query->result();
				$total = $total[0]->total;
				
				$query = $this->projdb->select('prog_code,sys_app,sys_trans,attach_path,modules,flg_status')->from($this->tblName)->where($where)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
				$query = $this->projdb->get();
				$rowArr = $query->result_array();
				$rowArr[0]['total'] = $total;
			}else
				$sql = "SELECT (select count(*) FROM {$this->tblName} where {$_GET['value']}) as total,PROGRESS_RECID,prog_code,sys_app,sys_trans,attach_path,modules,flg_status FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
		}
		return $rowArr; //$this->projdb->query($sql)->result_array();
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
	
	public function set_sysAtt(){
		if ($_POST['PROGRESS_RECID'] > 0){
	        $postInfo = array("sys_app"=>mysql_real_escape_string($_POST['sys_app']),
	        				  "sys_trans"=>mysql_real_escape_string($_POST['sys_trans']),
	        				  "attach_path"=>mysql_real_escape_string($_POST['attach_path']),
	        				  "modules"=>mysql_real_escape_string($_POST['modules']),
	        				  "flg_status"=>$_POST['flg_status'],
	        				  "log_user"=>mysql_real_escape_string($_POST['user_id']),
	        				  "log_date"=>mdate("%Y-%m-%d"),
	        				  "log_update"=>mysql_real_escape_string($_POST['user_id']) . " " . mdate("%Y-%m-%d"));
							  
        	$query = $this->projdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->projdb->update($this->tblName, $postInfo);
		}else {
	        $postInfo = array("prog_code"=>mysql_real_escape_string($_POST['prog_code']),
	        				  "sys_app"=>mysql_real_escape_string($_POST['sys_app']),
	        				  "sys_trans"=>mysql_real_escape_string($_POST['sys_trans']),
	        				  "attach_path"=>mysql_real_escape_string($_POST['attach_path']),
	        				  "modules"=>mysql_real_escape_string($_POST['modules']),
	        				  "flg_status"=>$_POST['flg_status'],
	        				  "log_user"=>mysql_real_escape_string($_POST['user_id']),
	        				  "log_date"=>mdate("%Y-%m-%d"),
	        				  "log_update"=>mysql_real_escape_string($_POST['user_id']) . " " . mdate("%Y-%m-%d")
							  );
			
			$query = $this->projdb->set($postInfo);
			$query = $this->projdb->insert($this->tblName);
		}
		return $query;
	}
		
	public function remove_sysAtt(){
        $query = $this->projdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
    	$query = $this->projdb->delete($this->tblName);
		return $query;
	}
}
?>