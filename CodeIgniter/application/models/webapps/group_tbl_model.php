<?php
class Group_Tbl_model extends CI_Model {
	private $tblName = "group_tbl";
	public function __construct(){
		$this->load->database();
	}
	
	pubLic function getAll(){
		$sql = "SELECT * FROM " . $this->tblName;
		return $this->db->query($sql)->result_array();
	}
}
?>