<?php

class Login extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('form_validation','session'));
        $this->load->model('login_model');
    }
    
    public function index($addThisDataIdx = "", $addThisDataVal = ""){
        if (isset($addThisDataIdx))
            $data[$addThisDataIdx] = $addThisDataVal;
        if ($this->session->userdata('is_logged_in')){
            $data['users_item'] = $this->login_model->get_user();
            if (!empty($data['users_item'])){
                $data['title'] = "Welcome";
                $data['dynamicBody'] = "success";
                $data['attributes'] = array("id" => "myForm");
                
                $this->load->view('login/includes/login_temp.php', $data);                
            }              
        }else {   
            $data['title'] = "Login";
            $data['dynamicBody'] = "index";
            $data['attributes'] = array("id" => "myForm");
            $this->load->view('login/includes/login_temp.php', $data);         
        }
    }
    
    public function signUp($addThisDataIdx = "", $addThisDataVal = ""){
        if (isset($addThisDataIdx))
            $data[$addThisDataIdx] = $addThisDataVal;
        $data['title'] = "Sign-Up";
        $data['dynamicBody'] = "signup";
        $data['attributes'] = array("id" => "myForm");
        $this->load->view('login/includes/login_temp.php', $data);
    }
    
    public function addCredentials(){
        $this->form_validation->set_rules("userName","Username","trim|required");
        $this->form_validation->set_rules("passWord","Password","trim|required|min_length[5]|matches[passWord1]");
        $this->form_validation->set_rules("passWord1","Confirm Password","trim|required|min_length[5]|matches[passWord]");
        
        if (!$this->form_validation->run()){
            $data['username'] = $this->input->post('userName');
            $data['passWord'] = $this->input->post('passWord');
            $data['passWord1'] = $this->input->post('passWord1');
            $this->signup();
        }else{            
            if ($this->login_model->set_user())
                redirect("login/");
            else
                $this->signUp("error", "Username already exist.");
        }
    }
    
    public function offCredentials(){
        if ($this->input->post("buttLogout") != ""){            
            $this->session->unset_userdata("is_logged_in");
            redirect("login/");
        }else {
            $data['title'] = "Welcome";
            $data['dynamicBody'] = "success";
            $data['attributes'] = array("id" => "myForm");
            $data['users_item']['user'] = $this->input->post('userName');
            $data['users_item']['pWord'] = $this->input->post('passWord');
            
            $this->load->view('login/includes/login_temp.php', $data);
        }
    }
    
    public function validateCredentials(){
        $this->form_validation->set_rules("userName","Username","trim|required");
        $this->form_validation->set_rules("passWord","Password","trim|required");
        
        if (!$this->form_validation->run()){
            $data['username'] = $this->input->post('userName');
            $data['passWord'] = $this->input->post('passWord');
            redirect("login/");
        }else{
            $data['users_item'] = $this->login_model->get_user();
            if (!empty($data['users_item'])){
                $newData = array("user"=>$this->input->post('userName'),"is_logged_in"=>true);
                $this->session->set_userdata($newData);
                
                $data['title'] = "Welcome";
                $data['dynamicBody'] = "success";
                $data['attributes'] = array("id" => "myForm");
                
                $this->load->view('login/includes/login_temp.php', $data);                
            }else
                $this->index("error","Couldn't find the user.");
        }
    }
}