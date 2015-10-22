<?php
    class Login_Model extends CI_Model {
    	private $tblName = "ruser";
        public function __construct(){
            $this->load->database();
        }
        
        public function get_user($filters){
        	$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ?";
			$query = $this->db->query($sql, $filters[0]);
			if ($query->num_rows() > 0){
				if ($query->num_rows() == 1){
					$row = $query->row();
					$salt = substr($row->password, 0, 64);
					$hash = $this->makeHash($salt, $filters[1]);
			
		        	$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ? AND password = ?";
		            $query = $this->db->query($sql, array($row->user_id,$hash));
					if ($query->num_rows() > 0)
						return $query->row();
				}else {
					foreach ($query->result() as $row){
						$salt = substr($row->password, 0, 64);
						$hash = $this->makeHash($salt, $filters[1]);
				
			        	$sql = "SELECT * FROM " . $this->tblName . " WHERE user_id = ? AND password = ?";
			            $query = $this->db->query($sql, array($row->user_id,$hash));
						if ($query->num_rows() > 0)
							return $query->row();
					}
				}
			}else
				return false;            
        }
        
        /*public function set_user(){
            $query = $this->db->get_where("login",array("user" => $this->input->post("userName")));
            if (!$query->row_array()){
                $data = array(
                                "user"=>$this->input->post("userName"),
                                "pWord"=>$this->input->post("passWord")
                              );
                
                return $this->db->insert("login",$data);
            }else
                return false;
        }*/

	    private function makeHash($salt, $pword){	
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
    }
?>