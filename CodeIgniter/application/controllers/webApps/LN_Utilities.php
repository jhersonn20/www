<?php
    require_once("application/controllers/webapps/To_Pdf.php");
    class LN_Utilities extends CI_Controller {
        private $rowArray = array();
        
        public function __construct(){
            parent::__construct();
            $this->load->library('session');
            $this->load->helper('form');
            $this->load->model('webapps/group_tbl_model');
            $this->load->model('webapps/utilities_model');
            $this->load->model('webapps/company_model');
            $this->load->model('webapps/sysdb_model');
            $this->load->model('webapps/ruser_model');
            $this->load->model('webapps/rgroup_model');
            $this->load->model('webapps/rmenu_model');
            $this->load->model('webapps/group_menu_model');
            $this->load->model('webapps/appl_user_model');
            $this->load->model('webapps/rappl_model');
        }
        
        public function index($hdrName = ""){
            $data['mainContent'] = "utilities/index";
            
            return $data;
        }
        
        public function comp($hdrName = ""){
            $data['mainContent'] = "utilities/comp";
	    	$data['currLeftNav'] = "/codeIgniter/index.php/" . uri_string(); //current_url();
            
            return $data;
        }
        
        public function param($hdrName = ""){
            $data['mainContent'] = "utilities/param";
	    	$data['currLeftNav'] = "/codeIgniter/index.php/" . uri_string(); //current_url();
            
            return $data;
        }
        
        public function purge($hdrName = ""){
            $data['mainContent'] = "utilities/purge";
	    	$data['currLeftNav'] = "/codeIgniter/index.php/" . uri_string(); //current_url();
            
            return $data;
        }
        
        public function init($hdrName = ""){
            $data['mainContent'] = "utilities/init";
	    	$data['currLeftNav'] = "/codeIgniter/index.php/" . uri_string(); //current_url();
            
            return $data;
        }
        
        public function util_hdr($hdrName){
            $data['mainContent'] = "utilities/" . $hdrName;
            $data['currLeftNav'] = current_url();
			switch($hdrName){
				case "menuAss":
					$grpTbl = $this->group_tbl_model->getAll();
					$selValOptions = array("0");
					$selOptions = array("");
					foreach($grpTbl as $key):
						array_push($selValOptions, $key['group_code']);
						array_push($selOptions, $key['group_desc']);
					endforeach;
					$data['selOptions'] = array_combine($selValOptions, $selOptions);
				break;
			}
            return $data;
        }
        
        public function output(){
            $idArr = array("id"=>"","data"=>"");
            $dbArr = array();
            $output = array("rows"=>"");
            foreach ($this->get_rowArray() as $r):
                //$idArr["id"] = $r['id'];
                //$idArr["data"] = array($r['system_code'], $r['util_desc'], $r['util_path'], $r['util_sort']);
                //$idArr["data"] = array($r['id'], $r['util_desc'], $r['util_path']);
                //array_push($dbArr, $idArr);
                array_push($dbArr, array("id"=>$r['id'],"util_path"=>$r['util_path'], "util_desc"=>$r['util_desc']));
            endforeach;
            $output['rows'] = $dbArr;       
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
		
		public function directCall($item = ""){			
            $idArr = array("data"=>"");
            $dbArr = array();
            $output = array("rows"=>"");
			switch($item){
				case "param":
		            foreach ($this->sysdb_model->getAll() as $r):
		            	$r['on_line'] = ($r['on_line'] == 1) ? "Online" : "Offline";
						array_push($dbArr, $r);
					endforeach;
					break;
				case "comp":
					array_push($dbArr, $this->company_model->get_info());
					break;
				case "purge":
		            foreach ($this->ruser_model->get_all_inactive() as $r):
						array_push($dbArr, $r);
					endforeach;
					break;
				default:
		            foreach ($this->utilities_model->getAll() as $r):
		                //$idArr["id"] = $r['id'];
		                //$idArr["data"] = array($r['appl_name'], $r['appl_code']);
		                //array_push($dbArr, $idArr);
		                array_push($dbArr, array("id"=>$r['id'],"util_path"=>$r['util_path'], "util_desc"=>$r['util_desc']));
		            endforeach;
					break;
			}
            $output['rows'] = $dbArr;
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
        
        public function get_rowArray(){
            return $this->rowArray;
        }
        
        public function set_rowArray($modelMethod = "getAll"){ //$modelFilter
            if ($modelMethod == "")
                $modelMethod = "getAll";
            //$this->rowArray = $this->utilities_model->$modelMethod($modelFilter);
            $this->rowArray = $this->utilities_model->$modelMethod();
        }
		
		public function getUtilDetails($modelFilter){
			return $this->utilities_model->getByUtilities($modelFilter);			
		}
		
		public function manage($item = ""){
			switch($item){
				case "comp":
					$this->output->set_content_type('application/json')->set_output($this->company_model->set_info());
					break;
				case "param":
					$this->output->set_content_type('application/json')->set_output($this->sysdb_model->set_param());
					break;
				default:
            		$this->output->set_content_type('application/json')->set_output($this->utilities_model->set_util());
					break;
			}
		}
		
		public function remove($item = "", $param = ""){
			switch($item){
				case "param":
					$this->output->set_content_type('application/json')->set_output($this->sysdb_model->remove_param());
					break;
				case "purge":
					$this->output->set_content_type('application/json')->set_output($this->ruser_model->remove_user_inactive($param));
					break;
				case "init":
					$this->output->set_content_type('application/json')->set_output($this->rgroup_model->remove_group_by_appl());
					$this->output->set_content_type('application/json')->set_output($this->rmenu_model->remove_nav_by_appl());
					$this->output->set_content_type('application/json')->set_output($this->group_menu_model->remove_gmenu_by_appl());
					$this->output->set_content_type('application/json')->set_output($this->appl_user_model->remove_appl_by_appl());
					$this->output->set_content_type('application/json')->set_output($this->rappl_model->remove_system_by_appl());
					break;
				default:
					$this->output->set_content_type('application/json')->set_output($this->utilities_model->remove_util());
					break;
			}
		}
		
		public function print_to_csv($item = ""){
			$param = array();
	        $this->To_Pdf = new To_Pdf();
			switch ($item) {
				case 'sysdb':
					$this->To_Pdf->index($this->sysdb_model->rpt_param(),$param,"gendb");
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