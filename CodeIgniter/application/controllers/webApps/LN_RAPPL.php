<?php
    class LN_Rappl extends CI_Controller {
        private $rowArray = array();
        
        public function __construct(){
            parent::__construct();
            $this->load->helper(array('form','url','file'));
            $this->load->model('webapps/rappl_model');
        }
        
        public function index(){
            $data['mainContent'] = "system/index";

            return $data;
        }
		
		public function group(){
            $data['mainContent'] = "system/group";
	    	$data['currLeftNavSet'] = current_url();

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
		
		public function directCall($item = ""){
            $idArr = array("data"=>"");
            $dbArr = array();
            $output = array("rows"=>"");
			switch($item){
				case "group":
		            foreach ($this->rgroup_model->getAll() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				default:
		            foreach ($this->rappl_model->getAll() as $r):
		                array_push($dbArr, array("PROGRESS_RECID"=>$r['PROGRESS_RECID'], "appl_name"=>$r['appl_name'], "appl_code"=>$r['appl_code'], "publish"=>$r['publish'], "appl_name_short"=>$r['appl_name_short']));
		            endforeach;
					break;
			}
            $output['rows'] = $dbArr;
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
        
        public function get_rowArray(){
            return $this->rowArray;
        }
        
        public function set_rowArray($modelMethod = "getAll", $modelFilter = ""){
            if ($modelMethod == "")
                $modelMethod = "getAll";
            $this->rowArray = $this->rappl_model->$modelMethod();
        }
		
		public function manage($item = ""){
			switch($item){
				case "publish":
            		$this->output->set_content_type('application/json')->set_output($this->rappl_model->set_systemP()); //$this->uri->segment(5,"")
					break;
				case "setAu":
            		$this->output->set_content_type('application/json')->set_output($this->rappl_model->set_au());
					break;
				default: 
            		$this->output->set_content_type('application/json')->set_output($this->rappl_model->set_system());
					break;
			}
			//if ($this->uri->segment(4,"") == "")
			//else
		}
		
		public function remove($item = ""){
			switch($item){
				case "group":
					break;
				default:
					$this->output->set_content_type('application/json')->set_output($this->rappl_model->remove_system());
					break;
			}
		}
    }
?>