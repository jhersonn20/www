<?php
    class LN_RAPPL extends CI_Controller {
        private $rowArray = array();
        
        public function __construct(){
            parent::__construct();
            $this->load->helper('form');
            $this->load->model('webapps/rappl_model');
        }
        
        public function index(){
            $data['mainContent'] = "system/index";

            return $data;
        }
        
        public function output(){
            //$idArr = array("id"=>"","data"=>"");
            $idArr = array("data"=>"");
            $dbArr = array();
            $output = array("rows"=>"");
            foreach ($this->get_rowArray() as $r):
                //$idArr["id"] = $r['id'];
                $idArr["data"] = array($r['appl_name'], $r['appl_code']);
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
            $this->rowArray = $this->RAPPL_model->$modelMethod();
        }
    }
?>