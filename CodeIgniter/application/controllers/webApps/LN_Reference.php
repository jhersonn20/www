<?php
    require_once("application/controllers/webapps/To_Pdf.php");
    class LN_Reference extends CI_Controller {
        private $rowArray = array();
		        
        public function __construct(){
            parent::__construct();
        	$this->load->library('session');
            $this->load->helper(array('form','url','file','date','csv_helper'));
            $this->load->model('webapps/reference_model');
            $this->load->model('webapps/rappl_model');
            $this->load->model('webapps/rgroup_model');
            $this->load->model('webapps/rdivision_model');        
            $this->load->model('webapps/ogmr_model');        
            $this->load->model('webapps/group_menu_model');
        }
        
        public function index(){
            $data['mainContent'] = "reference/index";

            return $data;
        }
        
        public function appl(){
            $data['mainContent'] = "reference/appl";
	    	$data['currLeftNavRef'] = "/codeIgniter/index.php/" . uri_string(); //current_url();

            return $data;
        }
		
		public function group(){
            $data['mainContent'] = "reference/group";
	    	$data['currLeftNavRef'] = "/codeIgniter/index.php/" . uri_string(); //current_url();

            return $data;
		}
		
		public function div(){
            $data['mainContent'] = "reference/div";
	    	$data['currLeftNavRef'] = "/codeIgniter/index.php/" . uri_string(); //current_url();

            return $data;
		}
        
        public function output(){
            //$idArr = array("id"=>"","data"=>"");
            $idArr = array("data"=>"");
            $dbArr = array();
            $output = array("rows"=>"");
            foreach ($this->get_rowArray() as $r):
                //$idArr["id"] = $r['id'];
                $idArr["data"] = array($r['ref_path'], $r['ref_desc']);
                array_push($dbArr, $idArr);
            endforeach;
            $output['rows'] = $dbArr;       
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
		
		public function directCall($item = "",$appl_code = ""){
            $idArr = array("data"=>"");
            $dbArr = array();
            $output = array("rows"=>"");
			switch($item){
				case "appl":
		            foreach ($this->rappl_model->getAll() as $r):
						$r['publish'] = ($r['publish'] == 1) ? "&#10003" : "";
		                array_push($dbArr, array("PROGRESS_RECID"=>$r['PROGRESS_RECID'], "appl_name"=>$r['appl_name'], "appl_code"=>$r['appl_code'], "type"=>$r['type'], "publish"=>$r['publish'], "appl_name_short"=>$r['appl_name_short']));
		            endforeach;
					break;
				case "appl_grid":
		            foreach ($this->rappl_model->get_all_filtered() as $r):
						$r['publish'] = ($r['publish'] == 1) ? "&#10003" : "";
		                array_push($dbArr, $r); //array("PROGRESS_RECID"=>$r['PROGRESS_RECID'], "appl_name"=>$r['appl_name'], "appl_code"=>$r['appl_code'], "publish"=>$r['publish'], "appl_name_short"=>$r['appl_name_short']));
		            endforeach;
					break;
				case "group":
		            foreach ($this->rgroup_model->get_all_filtered_by_appl() as $r): //$appl_code
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "div":
		            foreach ($this->rdivision_model->getAll() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "menu": 
		            array_push($dbArr, array("description"=>" ","progname"=>" "));
		            foreach ($this->group_menu_model->get_menu_by_group(array($this->session->userdata('user'), $this->uri->segment(5), $this->uri->segment(6))) as $r):
						if ($r['progname'] != "MAIN"){ 
		                	array_push($dbArr, $r);
						}
		            endforeach;
					break;
				default:
		            foreach ($this->reference_model->getAll() as $r):
		                array_push($dbArr, array("id"=>$r['id'],"ref_path"=>$r['ref_path'], "ref_desc"=>$r['ref_desc']));
		            endforeach;
					break;
			}
            $output['rows'] = $dbArr;
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}

		public function get_appArray(){
			return $this->rappl_model->getAll();
		}
        
        public function get_rowArray(){
            return $this->rowArray;
        }
        
        public function set_rowArray($modelMethod = "getAll", $modelFilter = ""){
            if ($modelMethod == "")
                $modelMethod = "getAll";
            $this->rowArray = $this->reference_model->$modelMethod();
        }
		
		public function manage($item = ""){
			switch($item){
				case "group":
					/*var_dump($this->rgroup_model->set_group());
					foreach($this->rgroup_model->set_group() as $row):
						if (!write_file('e:\postData.txt', $this->rgroup_model->set_group()))
						     echo 'Unable to write the file';
						else
						     echo 'File written!';
					//endforeach;
					foreach( $_POST as $r => $val){
		                $data .= $r . ": " . $val . " ";
					}
					if (!write_file('e:\postData3.txt', $data))
					     echo 'Unable to write the file';
					else
					     echo 'File written!';*/
					// var_dump($_POST);
            		echo $this->rgroup_model->set_group();
            		// $this->output->set_content_type('application/json')->set_output(); //$this->uri->segment(5,"")
					break;
				case "div":
					$this->output->set_content_type('application/json')->set_output($this->rdivision_model->set_div()); //$this->uri->segment(5,"")
					break;
				case "publish":
            		$this->output->set_content_type('application/json')->set_output($this->rappl_model->set_systemP()); //$this->uri->segment(5,"")
					break;
				case "setAu":
            		$this->output->set_content_type('application/json')->set_output($this->rappl_model->set_au());
					break;
				case "appl": 
            		$this->output->set_content_type('application/json')->set_output($this->rappl_model->set_system());
					break;
				default:
        			$this->output->set_content_type('application/json')->set_output($this->reference_model->set_ref());
					break;					
			}
		}
		
		public function remove($item = ""){
			switch($item){
				case "group":
					$this->output->set_content_type('application/json')->set_output($this->rgroup_model->remove_group());
					break;
				case "div":
					$this->output->set_content_type('application/json')->set_output($this->rdivision_model->remove_div());
					break;
				case "appl":
					$this->output->set_content_type('application/json')->set_output($this->rappl_model->remove_system());
					break;
				case "init":
					
					/*
					$this->load->library('email');
										
										$this->email->from('romel_gomez11@aol.com', 'Romel C. Gomez');
										$this->email->to('rcgomez11@arcc-eei.com'); 
										// $this->email->cc('romel_gomez11@yahoo.com'); 
										// $this->email->bcc('romelgomez11@gmail.com'); 										
										$this->email->subject('Email Test');
										$this->email->message('Testing the email class.');	
										
										$this->email->send();
										
										echo $this->email->print_debugger();*/					
					
					switch (strtolower($_POST['appl_code'])) {
						case 'ogmr_not_yet_enabled':
							$this->output->set_content_type('application/json')->set_output($this->ogmr_model->clear_content());
							break;
						default:
							echo "Initialization for this system is not yet enabled!";
							break;
					}					
					
					break;
				default:
					$this->output->set_content_type('application/json')->set_output($this->reference_model->remove_ref());
					break;
			}
		}
		
		public function print_to_csv($item = ""){
			$param = array();
	        $this->To_Pdf = new To_Pdf();
			switch ($item) {
				case 'rdivision':
					$this->To_Pdf->index($this->rdivision_model->rpt_div(),$param,"gendb");
					break;
				case 'rgroup':
					$this->To_Pdf->index($this->rgroup_model->rpt_group(),$param,"gendb");
					break;
				default:
					$this->To_Pdf->index($this->rappl_model->rpt_appl(),$param,"gendb");
					break;
			}
		}
		
    }
?>