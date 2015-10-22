<?php
    class Reference_Model extends CI_Model {
    	private $tblName = "reference";
        public function __construct(){
            parent::__construct();
            $this->load->database();
        }
        
        public function getAll(){
            return $this->db->get($this->tblName)->result_array();
        }
		
		public function getByUtilities($filters){
			$sql = "SELECT * FROM $this->tblName where id = ?";
			return $this->db->query($sql, $filters)->result_array();
		}
        
        public function getBySystem($filters){
			foreach ($filters as $key => $val):
				settype($filters[$key], "string");
			endforeach;
        	$sql = "SELECT * FROM $this->tblName where appl_code = ? AND job_no = ?";
			//return $this->db->query($sql, array($filters[0],$filters[1]))->result_array();
			return $this->db->query($sql, $filters)->result_array();
            //return $this->db->get_where("utilities", array("system_code" => $sysCode))->result_array();
        }
        
        public function set_ref(){
            $postInfo = array("id"=>$_POST['id'],"ref_path"=>mysql_real_escape_string($_POST['ref_path']),"ref_desc"=>mysql_real_escape_string($_POST['ref_desc']));
            if ($_POST['id'] == "0"){
				$query = $this->db->set($postInfo);
				$query = $this->db->insert($this->tblName);
			}else{
            	$query = $this->db->where('id', $_POST['id']);
            	$query = $this->db->update($this->tblName, $postInfo);
			}
			
			return $query;
            /*$retVal = $query->row_array();
            if (empty($retVal))
                array_push($dataArr, $postInfo);
            if (count($dataArr) > 0)
                return true;
			else
				return false;*/
        }
		
		public function remove_ref(){
        	$query = $this->db->where('id', $_POST['id']);
        	$query = $this->db->delete($this->tblName);
			return $query;
		}
    }
?>