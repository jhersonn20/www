<?php
	class Project_Model extends CI_Model {
		public function __construct(){
			parent::__construct();	
            $this->load->database();		
		}
        
        public function getAll($sysCode){
        	settype($sysCode, "string");
        	$sql = "SELECT * FROM project where system_code = ?";
            return $this->db->query($sql,$sysCode)->result_array();
        }
	}
?>