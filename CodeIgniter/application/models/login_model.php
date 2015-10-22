<?php
    class Login_Model extends CI_Model {
        public function __construct(){
            parent::__construct();
            $this->load->database();
        }
        
        public function get_user(){
            $query = $this->db->get_where("login",array("user" => $this->input->post("userName"), "pWord" => $this->input->post("passWord")));
            return $query->row_array();            
        }
        
        public function set_user(){
            $query = $this->db->get_where("login",array("user" => $this->input->post("userName")));
            if (!$query->row_array()){
                $data = array(
                                "user"=>$this->input->post("userName"),
                                "pWord"=>$this->input->post("passWord")
                              );
                
                return $this->db->insert("login",$data);
            }else
                return false;
        }
    }
?>