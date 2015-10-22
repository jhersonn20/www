<?php
require_once("application/controllers/webapps/req_admin.php");
if (!defined('RANDOMNO'))
	define('RANDOMNO','64ec17e1e68f');
class Admin extends CI_Controller {
    private $LN_System; 
    private $LN_Project;
    private $LN_Utilities; 
    private $LN_Nav;
    private $selSys = "";
    private $selProj = "";
    
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('form_validation','session'));
        $this->load->model('webapps/ruser_model');
        $this->load->library('session');
        $this->selSys = ((isset($_POST['selSys'])) ? $this->input->post('selSys') : $this->session->userdata('selSys'));
        $this->selProj = ((isset($_POST['selProj'])) ? $this->input->post('selProj') : $this->session->userdata('selProj'));
        $this->LN_Nav = new Nav();
        
        /*$this->LN_RAPPL = new LN_RAPPL();
        $this->LN_RAPPL->set_rowArray();*/
        
        $this->LN_Setup = new LN_Setup();
        $this->LN_Setup->set_rowArray();
        
        /*$this->LN_Project = new LN_Project();        
		echo "4<br />";
        $this->LN_Project->set_rowArray("getAll", $this->selSys);        
		echo "5<br />";*/
        
        $this->LN_Reference = new LN_Reference();
        $this->LN_Reference->set_rowArray();
        
        $this->LN_Utilities = new LN_Utilities();
        //$this->LN_Utilities->set_rowArray("getBySystem", array($this->selSys, $this->selProj));
        $this->LN_Utilities->set_rowArray();
    }
    
    public function index(){
		//echo "Session: " . $this->session->userdata('is_logged_in');
		$sessSys = $this->session->userdata('system');
		// if ($this->session->userdata('system') != "")
			// if (!($sessSys == $this->uri->segment(2)))
				// redirect("webapps/");
				
        if ($this->session->userdata('is_logged_in')){
	        if (isset($_POST["selSys"])){
	            $newData = array("selSys"=>$this->input->post('selSys'),"selProj"=>$this->input->post('selProj'),"is_logged_in"=>true);
	            $this->session->set_userdata($newData);
	        }
			$newData = $this->session->userdata('rcgomez');
			$newData['system'] = $this->uri->segment(2);
			$this->session->set_userdata($newData);
	        $data['currLeftNav'] = "index";
	        $data['mainContent'] = "index";
	        $data['title'] = "ARCC - Content Management System";
	        $data['formAction'] = 'webapps/admin/index/';
	        $this->globalView($data);
        }else {
            /*$data['title'] = "Login";
            $data['dynamicBody'] = "index";
            $data['attributes'] = array("id" => "myForm");
            $this->load->view('webapps/admin/login/login_temp', $data);*/
	        $data['is_logged_in'] = false;
            $data['title'] = "Login";
            $data['dynamicBody'] = "index";
            $data['attributes'] = array("id" => "myForm");
            $this->load->view('webapps/login/login_temp', $data);
        }
    }
    
    public function system(){
		$sessSys = $this->session->userdata('system');	
		// if (!($sessSys == $this->uri->segment(2)))
			// redirect("webapps/");
        if (!$this->session->userdata('is_logged_in'))
        	redirect('webapps/admin/');
        if (isset($_POST["selSys"])){
            redirect("webapps/admin/index/"); //http://localhost
        }
        $setupModelName = (($this->uri->segment(4) == "") ? "index" : $this->uri->segment(4));
        foreach ($this->LN_Reference->$setupModelName() as $key => $value):
            $data[$key] = $value;
        endforeach;
	    $data['currLeftNavRef'] = current_url();
        $data['formAction'] = 'webapps/admin/system/';
        $data['title'] = "ARCC - Content Management System";
        $this->globalView($data);
    }
    
    public function project(){
		$sessSys = $this->session->userdata('system');	
		// if (!($sessSys == $this->uri->segment(2)))
			// redirect("webapps/");
        if (!$this->session->userdata('is_logged_in'))
        	redirect('webapps/admin/');
        if (isset($_POST["selProj"]))
            redirect("webapps/admin/index/"); //http://localhost/codeIgniter/index.php/
        foreach ($this->LN_Project->index() as $key => $value):
            $data[$key] = $value;
        endforeach;
        $data['formAction'] = 'webapps/admin/project/';
        $data['title'] = "ARCC - Content Management System";
		$data['sess_selSys'] = $this->session->userdata('selSys');
        $this->globalView($data);
    }
    
    public function reference(){
		$sessSys = $this->session->userdata('system');	
		// if (!($sessSys == $this->uri->segment(2)))
			// redirect("webapps/");
        if (!$this->session->userdata('is_logged_in'))
        	redirect('webapps/admin/');
        $refModelName = (($this->uri->segment(4) == "") ? "index" : $this->uri->segment(4)); //"util_hdr"
        foreach ($this->LN_Reference->$refModelName($this->uri->segment(4)) as $key => $value):
            $data[$key] = $value;
        endforeach;
        $data['formAction'] = 'webapps/admin/reference/' . $this->uri->segment(4);
        $data['title'] = "ARCC - Content Management System";
        $this->globalView($data);
    }
    
    public function setup(){
		$sessSys = $this->session->userdata('system');	
		// if (!($sessSys == $this->uri->segment(2)))
			// redirect("webapps/");
        if (!$this->session->userdata('is_logged_in'))
        	redirect('webapps/admin/');
        $setupModelName = (($this->uri->segment(4) == "") ? "index" : $this->uri->segment(4));
        foreach ($this->LN_Setup->$setupModelName($this->uri->segment(5),$this->uri->segment(6,"")) as $key => $value):
            $data[$key] = $value;
        endforeach;
        $data['formAction'] = 'webapps/admin/setup/' . $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . $this->uri->segment(6);
        $data['title'] = "ARCC - Content Management System";
        $this->globalView($data);
    }
    
    public function utilities(){
		$sessSys = $this->session->userdata('system');	
		// if (!($sessSys == $this->uri->segment(2)))
			// redirect("webapps/");
        if (!$this->session->userdata('is_logged_in'))
        	redirect('webapps/admin/');
        $utilModelName = (($this->uri->segment(4) == "") ? "index" : $this->uri->segment(4));
        foreach ($this->LN_Utilities->$utilModelName() as $key => $value):
            $data[$key] = $value;
        endforeach;
        $data['formAction'] = 'webapps/admin/utilities/' . $this->uri->segment(4);
        $data['title'] = "ARCC - Content Management System";
        $this->globalView($data);
    }
    
    /*public function utilities(){
		$sessSys = $this->session->userdata('system');	
		if (!($sessSys == $this->uri->segment(2)))
			redirect("webapps/");
        if (!$this->session->userdata('is_logged_in'))
        	redirect('webapps/admin/');
        if (isset($_POST["buttSave"])){
	        $this->form_validation->set_rules("passWord_old","Old Password","trim|required");
	        $this->form_validation->set_rules("passWord","New Password","trim|required|matches[passWord_conf]");
	        $this->form_validation->set_rules("passWord_conf","Confirm Password","trim|required|matches[passWord]");
	        
	        if (!$this->form_validation->run()){
	            $data['passWord_old'] = $this->input->post('passWord_old');
	            $data['passWord'] = $this->input->post('passWord');
	            $data['passWord_conf'] = $this->input->post('passWord_conf');
	            redirect("webapps/admin/utilities/chgPWord");
	        }else{
	        	$data['users_item'] = $this->ruser_model->setUser(array($this->session->userdata('user'),$this->input->post('passWord_old'),$this->input->post('passWord')));
	            if (!empty($data['users_item'])){
	                $this->index("error","User successfully changes its password.");
				}else
	                $this->index("error","Couldn't find the user.");
	        }
        }
        //if (isset($_POST["selSys"]))
        //    redirect("http://localhost/codeIgniter/index.php/webapps/admin/index/");
        $utilModelName = (($this->uri->segment(4) == "") ? "index" : "util_hdr");
        foreach ($this->LN_Utilities->$utilModelName($this->uri->segment(4)) as $key => $value):
            $data[$key] = $value;
        endforeach;
        $data['formAction'] = 'webapps/admin/utilities/' . $this->uri->segment(4);
        $data['title'] = "ARCC - Content Management System";
        $this->globalView($data);
    }*/
    
    public function navManage(){
		$sessSys = $this->session->userdata('system');	
		// if (!($sessSys == $this->uri->segment(2)))
			// redirect("webapps/");
        if (!$this->session->userdata('is_logged_in'))
        	redirect('webapps/admin/');
        //if (isset($_POST["selSys"])){
        //    redirect("http://localhost/codeIgniter/index.php/webapps/admin/index/");
        //}
        $ulArr = $this->LN_Nav->manage("ul", array($this->selSys,$this->selProj));
        foreach ($ulArr as $key => $value): 
            $data[$key] = $value;
        endforeach;
        $data['formAction'] = 'webapps/admin/navManage';
        $data['title'] = "ARCC - Content Management System";
        $this->globalView($data);
    }
    
    public function output(){
		$sessSys = $this->session->userdata('system');	
		// if (!($sessSys == $this->uri->segment(2)))
			// redirect("webapps/");
        if (!$this->session->userdata('is_logged_in'))
        	redirect('webapps/admin/');
        $outputObj = $this->uri->segment(4);
        $output = new $outputObj();
        $output->set_rowArray($this->uri->segment(5), $this->selSys);
        $output->output();
    }
    
    private function globalView($data){
		$sessSys = $this->session->userdata('system');	
		// if (!($sessSys == $this->uri->segment(2)))
			// redirect("webapps/");
        if (!$this->session->userdata('is_logged_in'))
        	redirect('webapps/admin/');
        $data['rowArraySystem'] = $this->LN_Reference->get_appArray(); //$this->LN_RAPPL->get_rowArray();
        $data['rowArrayRef'] = $this->LN_Reference->get_rowArray();
        $data['rowArraySet'] = $this->LN_Setup->get_rowArray();
        $data['rowArrayUtil'] = $this->LN_Utilities->get_rowArray();
        /*$data['rowArrayProject'] = $this->LN_Project->get_rowArray();
        $data['selProj'] = $this->selProj;
        $data['selSys'] = $this->selSys;*/
		$data['user'] = $this->session->userdata('user');
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['user_name'] = $this->session->userdata('user_name');
		$data['PROGRESS_RECID'] = $this->session->userdata('PROGRESS_RECID');
		$data['access'] = $this->session->userdata('access');
        
        $this->load->view('webapps/admin/adminTemp', $data);        
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
            redirect("webapps/admin/");
        }else{
            $data['users_item'] = $this->ruser_model->getUser(array($this->input->post('userName'),$this->input->post('passWord')));
            if (!empty($data['users_item'])){
                $newData = array("user"=>$this->input->post('userName'),"is_logged_in"=>true);
                $this->session->set_userdata($newData); 
            	redirect("webapps/admin/");
            }else
                $this->index("error","Couldn't find the user.");
        }
    }
}
?>