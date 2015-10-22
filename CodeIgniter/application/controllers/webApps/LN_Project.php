<?php
    class LN_Project extends CI_Controller {
        private $rowArray = array();
        
        public function __construct(){
            parent::__construct();
            $this->load->helper('form');
            $this->load->model('webapps/project_model');
        }
        
        public function index(){
            $data['mainContent'] = "project/index";

            return $data;
        }
        
        public function output(){
            $idArr = array("id"=>"","data"=>"");
            $dbArr = array();
            $output = array("rows"=>"");
            foreach ($this->get_rowArray() as $r):
                $idArr["id"] = $r['id'];
                $idArr["data"] = array($r['project_name'], $r['project_code']);
                array_push($dbArr, $idArr);
            endforeach;
            $output['rows'] = $dbArr;       
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
        
        public function get_rowArray(){
            return $this->rowArray;
        }
        
        public function set_rowArray($modelMethod = "getAll", $modelFilter = ""){
            if ($modelMethod == "")
                $modelMethod = "getAll";
            $this->rowArray = $this->project_model->$modelMethod($modelFilter);
        }
    }
?>