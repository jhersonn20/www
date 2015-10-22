<?php
    class Nav extends CI_Controller {
        private $notification = "";
        
        public function __construct(){
            parent::__construct();
            $this->load->helper('directory');
            $this->load->model('webapps/nav_model');
            $this->load->helper('url');
        }
        
        public function manage($ulObj = "ulOrig", $modelFilter){
            if (isset($_POST['jsonData']) && $_POST['jsonData'] != ""){
                $this->nav_model->set_nav();
                $this->notification = "Data Saved.";
            }
            $this->load->helper('form');
            $data['map'] = directory_map('application/views/webapps/admin/nav/' . $modelFilter[0] . "/" . $modelFilter[1] . "/");
            $data['title'] = "Navigation";
            //$data['nav'] = $this->nav_model->get_nav($modelFilter);
            //$emptyRow = $this->nav_model->get_nav($modelFilter['selSys']);
            $emptyRow = $this->nav_model->getByProject($modelFilter);
            if (empty($emptyRow))
                $data['nav'] = array(array("description" => " "));
			else 
				$data['nav'] = $emptyRow; //$this->nav_model->get_nav($modelFilter);
            $data['notification'] = $this->notification;
            $data['currLeftNav'] = "menu";
            $data['mainContent'] = "nav/" . $ulObj;
                
            return $data;
        }
        
        public function laydown(){
            $data['title'] = "Index";
            $data['nav'] = $this->nav_model->get_menu();
            if (empty($data['nav']))
                $data['nav'] = array(array("label" => " "));
                
            $this->load->view("webapps/public/nav/header", $data);
            $this->load->view("webapps/public/nav/index", $data);
            $this->load->view("webapps/public/nav/footer");
        }
        
        public function laydown2(){
            $data['title'] = "Index";
            $data['nav'] = $this->nav_model->get_menu();
            if (empty($data['nav']))
                $data['nav'] = array(array("label" => " "));
                
            $this->load->view("webapps/public/nav/header", $data);
            $this->load->view("webapps/public/nav/index", $data);
            $this->load->view("webapps/public/nav/footer");         
        }
    }
?>