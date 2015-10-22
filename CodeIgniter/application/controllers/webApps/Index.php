<?php
require_once("application/controllers/webapps/req_admin.php");
if (!defined('RANDOMNO'))
	define('RANDOMNO','64ec17e1e68f');
class Index extends CI_Controller {
    private $LN_System; 
    private $LN_Project;
    private $LN_Utilities; 
    private $LN_Nav;
    private $selSys = "";
    private $selProj = "";
    
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url','file','cookie'));
        $this->load->library(array('form_validation','session'));
        $this->load->model('webapps/ruser_model');
        $this->load->model('webapps/appl_user_model');
        $this->load->library('session');
        $this->selSys = ((isset($_POST['selSys'])) ? $this->input->post('selSys') : $this->session->userdata('selSys'));
        $this->selProj = ((isset($_POST['selProj'])) ? $this->input->post('selProj') : $this->session->userdata('selProj'));
        $this->LN_Nav = new Nav();
        
        $this->LN_RAPPL = new LN_RAPPL();
        $this->LN_RAPPL->set_rowArray();
        
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
    
    public function index($user = "",$status = 0){					
		// if (!write_file('e:\index.txt', $this->session->userdata('is_logged_in')))
		     // echo 'Unable to write the file';
		// else
		     // echo 'File written!';
        if ($this->session->userdata('is_logged_in')){
	        // if (isset($_POST["selSys"])){
	            // $newData = array("selSys"=>$this->input->post('selSys'),"selProj"=>$this->input->post('selProj'),"is_logged_in"=>true);
	            // $this->session->set_userdata($newData);
	        // }
	        $data['currLeftNav'] = "index";
	        $data['mainContent'] = "index";
	        $data['title'] = "ARCC - Content Management System";
	        $data['formAction'] = 'webapps/';
            $data['dynamicBody'] = "index";
	        $this->globalView($data);
        }else {
	        $data['is_logged_in'] = false;
            $data['title'] = "Login";
            $data['dynamicBody'] = "index";
            $data['attributes'] = array("id" => "myForm");
			if ($this->input->cookie('tries_' . $user)){ //trim($this->input->post('userName'))
				$data['user'] = $user;
				$data['error'] = "Couldn't find user using username and password combination!";
				if (intval($this->input->cookie('tries_' . $user)) >= 3){
					$data['error'] = "Account is temporarily disabled.\n Kindly go to the nearest MIS Department with your request to enable your account!";
					$this->ruser_model->toggle_status($user,1);
	            	delete_cookie('tries_' . trim($this->input->post('userName')));
				}
			}
			if ($status > 0){
				$data['user'] = $user;
				if ($status == 1){
					$data['error'] = "Account is temporarily disabled.\n Kindly go to the nearest MIS Department with your request to enable your account!";
	            	delete_cookie('tries_' . trim($this->input->post('userName')));
				}else
					$data['error'] = "Couldn't find user using username and password combination!";
			}
            $this->load->view('webapps/login/login_temp', $data);
        }
    }
	
	public function directTo($system){
        $newData = array("system"=>$system,"user"=>$this->session->userdata('user'),"user_name"=>$this->session->userdata('user_name'),"PROGRESS_RECID"=>$this->session->userdata('PROGRESS_RECID'),"access"=>$this->session->userdata('access'),"is_logged_in"=>$this->session->userdata('is_logged_in')); //
        $this->session->set_userdata($newData);
		// var_dump(array($this->session->userdata('user'),$this->uri->segment(4)));
		$page_init = $this->appl_user_model->get_page_init(array($this->session->userdata('user'),$this->uri->segment(4)));
		$page_progname = explode(".",$page_init[0]['page_init']);
		// var_dump($page_init);
		// return true;
		redirect(($system == "admin") ? "webapps/admin/" : (trim($page_progname[0]) == "" ? ("webapps/pub/index/" . $system) : ("webapps/pub/page/" . $system . "/" . $page_progname[0] . "/" . $page_init[0]['param'])));
	}
    
    /*public function system(){
        if (!$this->session->userdata('is_logged_in'))
        	redirect('webapps/admin/');
        if (isset($_POST["selSys"])){
            redirect("http://localhost/codeIgniter/index.php/webapps/admin/index/");
        }
        foreach ($this->LN_RAPPL->index() as $key => $value):
            $data[$key] = $value;
        endforeach;
	    $data['currLeftNavRef'] = current_url();
        $data['formAction'] = 'webapps/admin/system/';
        $data['title'] = "ARCC - Content Management System";
        $this->globalView($data);
    }
    
    public function project(){
        if (!$this->session->userdata('is_logged_in'))
        	redirect('webapps/admin/');
        if (isset($_POST["selProj"]))
            redirect("http://localhost/codeIgniter/index.php/webapps/admin/index/");
        foreach ($this->LN_Project->index() as $key => $value):
            $data[$key] = $value;
        endforeach;
        $data['formAction'] = 'webapps/admin/project/';
        $data['title'] = "ARCC - Content Management System";
		$data['sess_selSys'] = $this->session->userdata('selSys');
        $this->globalView($data);
    }
    
    public function reference(){
        if (!$this->session->userdata('is_logged_in'))
        	redirect('webapps/admin/');
        $refModelName = (($this->uri->segment(4) == "") ? "index" : "util_hdr");
        foreach ($this->LN_Reference->$refModelName($this->uri->segment(4)) as $key => $value):
            $data[$key] = $value;
        endforeach;
        $data['formAction'] = 'webapps/admin/reference/' . $this->uri->segment(4);
        $data['title'] = "ARCC - Content Management System";
        $this->globalView($data);
    }
    
    public function setup(){
        if (!$this->session->userdata('is_logged_in'))
        	redirect('webapps/admin/');
        $setupModelName = (($this->uri->segment(4) == "") ? "index" : $this->uri->segment(4));
        foreach ($this->LN_Setup->$setupModelName($this->uri->segment(5),$this->uri->segment(6)) as $key => $value):
            $data[$key] = $value;
        endforeach;
        $data['formAction'] = 'webapps/admin/setup/' . $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . $this->uri->segment(6);
        $data['title'] = "ARCC - Content Management System";
        $this->globalView($data);
    }
    
    public function utilities(){
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
    }
    
    public function navManage(){
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
        if (!$this->session->userdata('is_logged_in'))
        	redirect('webapps/admin/');
        $outputObj = $this->uri->segment(4);
        $output = new $outputObj();
        $output->set_rowArray($this->uri->segment(5), $this->selSys);
        $output->output();
    }*/
    
    public function directCall($item = ""){
        $dbArr = array();
        $output = array("rows"=>"");
    	switch($item){
			case "user":
	            foreach ($this->ruser_model->getByUserOnly() as $r):
	                array_push($dbArr, array("user_id"=>$r['user_id'],"user_name"=>$r['user_name'], "PROGRESS_RECID"=>$r['PROGRESS_RECID'], "needChange"=>($r['password'] == "" ? 1 : 0)));
	            endforeach;
				break;
    	}
        $output['rows'] = $dbArr;
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    
    private function globalView($data){
					
		// if (!write_file('e:\globalView.txt', $this->session->userdata('is_logged_in')))
		     // echo 'Unable to write the file';
		// else
		     // echo 'File written!';
        if (!$this->session->userdata('is_logged_in'))
        	redirect('webapps');
        $data['rowArraySystem'] = $this->LN_RAPPL->get_rowArray();
        $data['rowArrayRef'] = $this->LN_Reference->get_rowArray();
        $data['rowArraySet'] = $this->LN_Setup->get_rowArray();
        $data['rowArrayRights'] = $this->LN_Setup->get_rowArray("rights",$this->session->userdata('user'));
        $data['rowArrayUtil'] = $this->LN_Utilities->get_rowArray();
        /*$data['rowArrayProject'] = $this->LN_Project->get_rowArray();
        $data['selProj'] = $this->selProj;*/
        $data['selSys'] = $this->selSys;
		$data['user'] = $this->session->userdata('user');
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['user_name'] = $this->session->userdata('user_name');
		$data['PROGRESS_RECID'] = $this->session->userdata('PROGRESS_RECID');
		$data['access'] = $this->session->userdata('access');
        
        $this->load->view('webapps/login/login_temp', $data);
        //$this->load->view('webapps/admin/adminTemp', $data);        
    }
    
    public function offCredentials(){            
        //$this->session->unset_userdata("is_logged_in");
        $this->session->sess_destroy();
        redirect("webapps/");
    }
	
	public function verify_session(){
		//echo "romel";
		echo ($this->session->userdata('is_logged_in') == 0);
		/*if ($this->session->userdata('is_logged_in') == 0)
			redirect("webapps");
			echo "Session Expired!";
			$this->offCredentials();*/
	}
    
    public function validateCredentials(){
        $this->form_validation->set_rules("userName","Username","trim|required");
        $this->form_validation->set_rules("passWord","Password","trim|required");

        if (!$this->form_validation->run()){
            $data['username'] = $this->input->post('userName');
            $data['passWord'] = $this->input->post('passWord');
            redirect("webapps");
        }else{
            $data['users_item'] = $this->ruser_model->getUser(array(trim($this->input->post('userName')),trim($this->input->post('passWord'))));
            if (!empty($data['users_item'])){
            	if (intval($data['users_item']['inactive']) == 0){
	            	if ($this->input->cookie('tries_' . trim($this->input->post('userName'))))
	            		delete_cookie('tries_' . trim($this->input->post('userName')));
					
	                $newData = array("system"=>"","user"=>$this->input->post('userName'),"user_name"=>$data['users_item']['user_name'],"PROGRESS_RECID"=>$data['users_item']['PROGRESS_RECID'],"access"=>($data['users_item']['sa'] . $data['users_item']['jsa'] . $data['users_item']['auditor']),"is_logged_in"=>true); //
	                $this->session->set_userdata($newData);
					
					// if (!write_file('e:\validate.txt', $newData['is_logged_in']))
					     // echo 'Unable to write the file';
					// else
					     // echo 'File written!';
			
            		redirect("webapps");
				}else
					$this->index($this->input->post('userName'),intval($data['users_item']['inactive']));
            }else{
            	$data['users_item'] = $this->ruser_model->getByUserOnly(trim($this->input->post('userName')));
				if (intval($data['users_item'][0]['inactive']) == 0){
	            	$tries = 0;
	            	if ($this->input->cookie('tries_' . trim($this->input->post('userName')))){
	            		$tries = intval($this->input->cookie('tries_' . trim($this->input->post('userName'))));
	            		delete_cookie('tries_' . trim($this->input->post('userName')));
					}
					
					$tries += 1;
	            	$cookie = array(
					    'name'   => trim($this->input->post('userName')),
					    'value'  => $tries,
					    'expire' => 0, //'86400',
					    'domain' => "", //base_url(),
					    'path'   => '/',
					    'prefix' => 'tries_',
					    'secure' => false
					);
					
					$this->input->set_cookie($cookie);
					/*setcookie('tries', '1', time()+3600*24,'/', base_url(),0);*/
	                //$this->index(trim($this->input->post('userName')), 2); //"error","Couldn't find the user."
	            	redirect("webapps/index/index/" . trim($this->input->post('userName')));
				}else
					$this->index($this->input->post('userName'),intval($data['users_item'][0]['inactive']));
			}
        }
    }
}
?>