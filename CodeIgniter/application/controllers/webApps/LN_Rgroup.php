<?php
    class LN_Rgroup extends CI_Controller {
        private $rowArray = array();
        
        public function __construct(){
            parent::__construct();
            $this->load->helper('form');
            $this->load->model('webapps/rgroup_model');
        }
        
        public function index(){
            $data['mainContent'] = "system/group";

            return $data;
        }
        
        public function output(){
            //$idArr = array("id"=>"","data"=>"");
            $idArr = array("data"=>"");
            $dbArr = array();
            $output = array("rows"=>"");
            foreach ($this->get_rowArray() as $r):
                //$idArr["id"] = $r['id'];
                $idArr["data"] = array($r['group_desc'], $r['group_code']);
                array_push($dbArr, $idArr);
            endforeach;
            $output['rows'] = $dbArr;       
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
		
		public function directCall(){
            $idArr = array("data"=>"");
            $dbArr = array();
            $output = array("rows"=>"");
            foreach ($this->rgroup_model->getAll() as $r): //$this->uri->segment(4)
                //$idArr["id"] = $r['id'];
                //$idArr["data"] = array($r['appl_name'], $r['appl_code']);
                //array_push($dbArr, $idArr);
                array_push($dbArr, array("PROGRESS_RECID"=>$r['PROGRESS_RECID'], "group_desc"=>$r['group_desc'], "group_code"=>$r['group_code'], "appl_code"=>$r['appl_code']));
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
            $this->rowArray = $this->rgroup_model->$modelMethod();
        }
		
		public function manage(){
            $this->output->set_content_type('application/json')->set_output($this->rgroup_model->set_group());
		}
		
		public function remove(){
			$this->output->set_content_type('application/json')->set_output($this->rgroup_model->remove_group());
		}
    }
?>