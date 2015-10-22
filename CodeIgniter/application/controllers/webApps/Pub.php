<?php
require_once("application/controllers/webapps/nav.php");
class Pub extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url','file'));
        $this->load->library(array('form_validation','session'));
        $this->load->model('webapps/ruser_model');
        $this->load->model('webapps/rmenu_model');
        $this->load->model('webapps/group_menu_model');
        $this->load->library('session');
        $this->load->model('webapps/rappl_model');
        $this->load->model('webapps/appl_user_model');
        /*$this->load->model('webapps/nav_model');
        $this->load->model('webapps/system_model');*/        
    }
    
    public function index(){
        if ($this->session->userdata('is_logged_in')){
			$details = $this->rappl_model->getBySystem($this->uri->segment(4));
			if ($this->uri->segment(5) != "")
				$details2 = $this->rmenu_model->get_menu_name($this->uri->segment(5),$this->uri->segment(6));
			if (($this->session->userdata('system') != $this->uri->segment(4)))
				redirect("webapps/");
		
			if (sizeof($this->appl_user_model->getByUserApp($this->session->userdata('user'),$this->uri->segment(4))) == 0)
				redirect("webapps/");
			
	        $data['mainContent'] = "nav/index";
	        $data['title'] = "Al Rushaid Construction Company, Limited";
	        $data['header'] = $details[0]['appl_name'];
	        $data['user'] = $this->session->userdata('user');
	        $data['is_logged_in'] = $this->session->userdata('is_logged_in');
			$data['user_name'] = $this->session->userdata('user_name');
			$data['PROGRESS_RECID'] = $this->session->userdata('PROGRESS_RECID');
			$data['access'] = $this->session->userdata('access');
			$data['system'] = $this->uri->segment(4);
			if (isset($details2))
	        	$data['menuDesc'] = $details2[0]['mtitle'];
			$newData = $this->session->userdata($this->session->userdata('user'));
			$newData['system'] = $this->uri->segment(4);
			$this->session->set_userdata($newData);
	        //$data['nav'] = $this->nav_model->get_menu(array(1,"qms","1240"));
	        //$data['nav'] = $this->rmenu_model->get_menu(array(1,$this->uri->segment(4)));
	        $data['nav'] = $this->group_menu_model->get_menu(array($this->session->userdata('user'),$this->uri->segment(4)));
	        if (empty($data['nav']))
	            $data['nav'] = array(array("label" => " "));
	        $this->load->view('webapps/public/nav/publicTemp', $data);
        }else {
            /*$data['title'] = "Login";
            $data['dynamicBody'] = "index";
            $data['attributes'] = array("id" => "myForm");
            $this->load->view('webapps/public/login/login_temp', $data);*/
	        $data['is_logged_in'] = false;
            $data['title'] = "Login";
            $data['dynamicBody'] = "index";
            $data['attributes'] = array("id" => "myForm");
            $this->load->view('webapps/login/login_temp', $data);
        }
    }
	
	public function page($dir = "index",$content = "index"){
        if (!$this->session->userdata('is_logged_in'))
			redirect("webapps/");
		
		// if (($this->session->userdata('system') != $this->uri->segment(4)))
			// redirect("webapps/");
			
		if (sizeof($this->appl_user_model->getByUserApp($this->session->userdata('user'),$this->uri->segment(4))) == 0)
			redirect("webapps/"); //per system
		
		// if (sizeof($this->group_menu_model->verify_module(array($this->session->userdata('user'),$this->uri->segment(4),$content . ".w"))) == 0)
		if (sizeof($this->group_menu_model->verify_module(array($this->session->userdata('user'),$this->uri->segment(4),$content . ".%"))) == 0)
			redirect("webapps/"); //per module
		
		$details = $this->rappl_model->getBySystem($this->uri->segment(4));
		if ($this->uri->segment(5) != "")
			$details2 = $this->rmenu_model->get_menu_name($this->uri->segment(5),$this->uri->segment(6));
		
	    $data['mainContent'] = "nav/index";
        $data['mainContent2'] = "systems/" . $dir . "/" . $content;
        $data['title'] = "Al Rushaid Construction Company, Limited";
        $data['header'] = $details[0]['appl_name'];
        $data['user'] = $this->session->userdata('user');
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['user_name'] = $this->session->userdata('user_name');
		$data['PROGRESS_RECID'] = $this->session->userdata('PROGRESS_RECID');
		$data['access'] = $this->session->userdata('access');
		$data['system'] = $this->uri->segment(4);
		if (isset($details2))
	    	$data['menuDesc'] = $details2[0]['mtitle'];
        //$data['nav'] = $this->nav_model->get_menu(array(1,"qms","1240"));
        //$data['nav'] = $this->rmenu_model->get_menu(array(1,$dir));
	    $data['nav'] = $this->group_menu_model->get_menu(array($this->session->userdata('user'),$this->uri->segment(4)));
        if (empty($data['nav']))
            $data['nav'] = array(array("label" => " "));
            
        $this->load->view('webapps/public/nav/publicTemp', $data);
	}
        
    public function navLayDown(){
        $nav = new Nav();
        $nav->laydown();
    }
    
    public function offCredentials(){            
        $this->session->unset_userdata("is_logged_in");
        redirect("webapps/");
    }
    
    public function validateCredentials(){
        $this->form_validation->set_rules("userName","Username","trim|required");
        $this->form_validation->set_rules("passWord","Password","trim|required");
        
        if (!$this->form_validation->run()){
            $data['username'] = $this->input->post('userName');
            $data['passWord'] = $this->input->post('passWord');
            redirect("webapps/pub/");
        }else{
            $data['users_item'] = $this->ruser_model->getUser(array($this->input->post('userName'),$this->input->post('passWord')));
            if (!empty($data['users_item'])){
                $newData = array("user"=>$this->input->post('userName'),"is_logged_in"=>true);
                $this->session->set_userdata($newData); 
            	redirect("webapps/pub/");
            }else
                $this->index("error","Couldn't find the user.");
        }
    }
}
?>