<?php
class AUDIT_Model extends CI_Model {
	private $tblName = "audit";
	public function __construct(){
        $this->portal = $this->load->database('portal', true);
	}
	
	public function get_all($where = ""){
		$start = ($_GET['page'] - 1) * $_GET['pageSize'];
		if ($where != "")
    		$sql = "SELECT * from {$this->tblName} where {$where} order by {$_GET['fieldS']} {$_GET['dir']} limit {$start},{$_GET['pageSize']}";
		else
    		$sql = "SELECT * FROM {$this->tblName} order by {$_GET['fieldS']} {$_GET['dir']} limit {$start},{$_GET['pageSize']}";
        return $this->portal->query($sql)->result_array();
	}
	
	public function set($postInfo = array()){
    	if (sizeof($postInfo) == 0){
			foreach ($_POST as $key => $value) {
				if ($key == "id" || $key == "total")
					continue;
				$postInfo[$key] = mysql_real_escape_string($value);
				if (is_string($value))
					$postInfo[$key] = stripslashes($value);
			}
			$postInfo['logs'] = mdate("%Y-%m-%d %H:%i:%s");
		}
				
		$query = $this->portal->set($postInfo);
		$query = $this->portal->insert($this->tblName);
		return $query;
	}
}
?>