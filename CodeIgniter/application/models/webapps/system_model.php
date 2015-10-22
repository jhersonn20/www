<?php
    class RAPPL_Model extends CI_Model {
		private $tblName = "RAPPL";
        public function __construct(){
            parent::__construct();
            //$this->load->database();
        	$this->gendb = $this->load->database('gendb', true);
        }
        
        public function getAll(){
            return $this->gendb->get($tblName)->result_array();
        }
		
		public function getBySystem($selSys){
			settype($selSys, "string");
			$sql = "SELECT * FROM $tblName WHERE appl_code = ?";
			return $this->db->query($sql, $selSys)->result_array();
		}
    }
?>