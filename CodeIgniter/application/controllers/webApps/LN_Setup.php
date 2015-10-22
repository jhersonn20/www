<?php
    require_once("application/controllers/webapps/To_Pdf.php");
	if (!defined('RANDOMNO'))
		define('RANDOMNO','64ec17e1e68f');
    class LN_Setup extends CI_Controller {
        private $rowArray = array();
        private $notification = "";
        
        public function __construct(){
            parent::__construct();
            $this->load->helper(array('form','url','file','date'));
            $this->load->model('webapps/setup_model');
            $this->load->model('webapps/ruser_model');
            $this->load->model('webapps/rmenu_model');
            $this->load->model('webapps/group_menu_model');
            $this->load->model('webapps/appl_user_model');
            $this->load->model('webapps/rgroup_model');
        }
        
        public function index(){
            $data['mainContent'] = "setup/index";

            return $data;
        }
		
		public function users(){
            $data['mainContent'] = "setup/users";
	    	$data['currLeftNavSet'] = "/codeIgniter/index.php/" . uri_string(); //current_url();

            return $data;
		}
		
		public function menu($ulObj = "ulOrig", $modelFilter = ""){
            if (isset($_POST['jsonData']) && $_POST['jsonData'] != ""){
                $this->rmenu_model->set_nav();
                $this->notification = "Success! Menu list has just been updated!";
            }
            $this->load->helper('form');
	        $data['title'] = "Navigation";
            $data['notification'] = $this->notification;
            $data['mainContent'] = "setup/menu";
	    	$data['currLeftNavSet'] = "/codeIgniter/index.php/" . uri_string(); //current_url();
            $data['selSys'] = $modelFilter;
			if ($modelFilter != ""){
	            //$data['map'] = directory_map('application/views/webapps/admin/nav/' . $modelFilter[0] . "/" . $modelFilter[1] . "/");
	            //$data['map'] = directory_map('application/views/webapps/admin/nav/' . $modelFilter . "/");
	            $data['map'] = directory_map('application/views/webapps/public/systems/' . $modelFilter . "/");
	            //$data['nav'] = $this->nav_model->get_nav($modelFilter);
	            //$navRow = $this->nav_model->get_nav($modelFilter['selSys']);
	            $navRow = $this->rmenu_model->getBySystem($modelFilter);
	            if (empty($navRow))
	                $data['nav'] = array(array("description" => " "));
				else 
					$data['nav'] = $navRow; //$this->nav_model->get_nav($modelFilter);
	            /*$data['currLeftNav'] = "menu";
	            $data['mainContent'] = "nav/" . $ulObj;*/
			}else {
	            $data['nav'] = array(array("description" => " "));
	            //$data['map'] = directory_map('application/views/webapps/admin/nav/');
	            $data['map'] = directory_map('application/views/webapps/public/systems/');
			}

            return $data;
		}

		public function gmenu(){
            $data['mainContent'] = "setup/gmenu";
	    	$data['currLeftNavSet'] = "/codeIgniter/index.php/" . uri_string(); //current_url();

            return $data;
		}

		public function rights(){
            $data['mainContent'] = "setup/rights";
	    	$data['currLeftNavSet'] = "/codeIgniter/index.php/" . uri_string(); //current_url();

            return $data;
		}
        
        public function output(){
            //$idArr = array("id"=>"","data"=>"");
            $idArr = array("data"=>"");
            $dbArr = array();
            $output = array("rows"=>"");
            foreach ($this->get_rowArray() as $r):
                //$idArr["id"] = $r['id'];
                $idArr["data"] = array($r['setup_path'], $r['setup_desc']);
                array_push($dbArr, $idArr);
            endforeach;
            $output['rows'] = $dbArr;       
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
		
		public function directCall($item = ""){
            /*$idArr = array("data"=>"");*/
            $dbArr = array();
            $output = array("rows"=>"");
			switch ($item){
				case "users":
					/*foreach( $_POST as $r => $val){
		                $data .= $r . ": " . $val . " ";
					}
					if (!write_file('e:\postData.txt', $data))
					     echo 'Unable to write the file';
					else
					     echo 'File written!';*/
					$operatorArr = array("eq"=>" = '","neq"=>" != '","endswith"=>" LIKE '%","startswith"=>" LIKE '",
										 "contains"=>" LIKE '%","doesnotcontain"=>" NOT LIKE '%","gte"=>" >= '","gt"=>" > '",
										 "lte"=>" <= '","lt"=>" < '");
					$blankThis = array("eq","neq","endswith");
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
							//$fieldVal[$res[0] . $operatorArr[$res[2]]] = $res[1] . (in_array($res[2], $blankThis) ? "" : "%");
						endforeach;
					/*echo $fieldVal;
					return true;
					var_dump($this->ogmr_model->getAll((isset($fieldVal) ? $fieldVal : array())));*/
		            foreach ($this->ruser_model->getAll((isset($fieldVal) ? $fieldVal : "" /*array()*/)) as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
		            //foreach ($this->ruser_model->getAll() as $r):
		                array_push($dbArr, $r); //array("progress_recid"=>$r['PROGRESS_RECID'],"user_id"=>$r['user_id'], "user_name"=>$r['user_name']));
		            endforeach;
					break;
				case "userOnly":
		            foreach ($this->ruser_model->getByUserOnly() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "gmenu":
		            foreach ($this->group_menu_model->getAllBySelected($this->uri->segment(5),$this->uri->segment(6),$this->uri->segment(7)) as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "rightsApp":
					$userInfo = $this->uri->segment(5,((isset($_POST['user_id'])) ? $_POST['user_id'] : ""));
		            foreach ($this->appl_user_model->getByUser($userInfo) as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				default:
		            foreach ($this->setup_model->getAll() as $r):
		                array_push($dbArr, array("id"=>$r['id'],"setup_path"=>$r['setup_path'],"setup_desc"=>$r['setup_desc']));
		            endforeach;
					break;
			}
            $output['rows'] = $dbArr;
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
        
        public function get_rowArray($item = "",$user_id = ""){
			switch ($item){
				case "users":
					echo $this->ruser_model->getUser(array($_POST['user_id'],$_POST['password']));
					break;
				case "rights":
					return $this->appl_user_model->getByUserMenu($user_id);
					break;
				default:
            		return $this->rowArray;
					break;
			}
        }
        
        public function set_rowArray($modelMethod = "getAll", $modelFilter = ""){
            if ($modelMethod == "")
                $modelMethod = "getAll";
            $this->rowArray = $this->setup_model->$modelMethod();
        }
		
		public function manage($item = "",$ulObj = "ulOrig", $modelFilter = array()){
			switch ($item){
				case "users":
					/*var_dump($_POST);
		            $data['postData'] = $_POST;
		            $data['mainContent'] = "setup/users";
			    	$data['currLeftNavSet'] = current_url();
        			$this->load->view('webapps/admin/adminTemp', $data)*/;     
					$this->ruser_model->setUser(); //array($_POST['txt1'],$_POST['txt3'])
					break;
				case "users_status":
					$this->ruser_model->toggle_status($_POST['user_id'],$_POST['inactive']);
					break;
				case "usersPW":					
					//var_dump($_POST);
					if ($_POST['needChange'])
						echo $this->ruser_model->setUser_PW2();
					else
						echo $this->ruser_model->setUser_PW();
					break;
				case "gmenu":
					//var_dump($_POST);  
					//$data = $_POST;
					//$data .= " Romel " . count($data);
					//if (!write_file('e:\postData.txt', $data))
					//     echo 'Unable to write the file';
					//else
					//     echo 'File written!';
					$this->group_menu_model->set_group_menu(); //$this->uri->segment(5),$this->uri->segment(6)
					break;
				case "group":
					echo $this->rgroup_model->set_group_page();
					// var_dump($_POST);
					// echo $_POST['group_code'] . " " . $_POST['page_init'];
					break;
				case "verify_group_page":
					echo $this->rgroup_model->verify_group_page();
					// var_dump($_POST);
					// echo $_POST['group_code'] . " " . $_POST['page_init'];
					break;
				case "menu":
		            if (isset($_POST['jsonData']) && $_POST['jsonData'] != ""){
		                $this->rmenu_model->set_nav();
		                $this->notification = "Data Saved.";
		            }
		            $this->load->helper('form');
		            $data['map'] = directory_map('application/views/webapps/admin/nav/' . $modelFilter[0] . "/" . $modelFilter[1] . "/");
		            $data['title'] = "Navigation";
		            //$data['nav'] = $this->nav_model->get_nav($modelFilter);
		            //$navRow = $this->nav_model->get_nav($modelFilter['selSys']);
		            $navRow = $this->rmenu_model->getByProject($modelFilter);
		            if (empty($navRow))
		                $data['nav'] = array(array("description" => " "));
					else 
						$data['nav'] = $navRow; //$this->nav_model->get_nav($modelFilter);
		            $data['notification'] = $this->notification;
		            $data['currLeftNav'] = "menu";
		            $data['mainContent'] = "nav/" . $ulObj;
		                
		            return $data;
					break;
				case "rightsApp":
					//foreach($_POST as $r => $val){
		            //    $data .= $r . ": " . $val . " ";
					//}
					//$data .= "URI: " . $this->uri->segment(5,"");
					/*$data = $item;
					if (!write_file('e:\postData.txt', $data))
					     echo 'Unable to write the file';
					else
					     echo 'File written!';*/
					$this->appl_user_model->set_appl();
					break;
				case "rightsAppD":
					$this->appl_user_model->set_applD(); //$this->uri->segment(5,"")
					break;
				default:
            		$this->output->set_content_type('application/json')->set_output($this->setup_model->set_setup());
					break;
			}
		}
		
		public function remove($item = ""){
			switch($item){
				case "users":
					$this->output->set_content_type('application/json')->set_output($this->ruser_model->remove_user());
					break;
				case "usersAU":
					$this->output->set_content_type('application/json')->set_output($this->appl_user_model->remove_all_appl_byUser());
					break;
				case "menu":
					$this->output->set_content_type('application/json')->set_output($this->rmenu_model->remove_nav());
					break;
				case "rightsApp":
					$this->output->set_content_type('application/json')->set_output($this->appl_user_model->remove_appl());
					break;
				default:
					$this->output->set_content_type('application/json')->set_output($this->setup_model->remove_setup());
					break;
			}
		}
		
		public function print_to_csv($item = ""){
			$param = array();
	        $this->To_Pdf = new To_Pdf();
			switch ($item) {
				case 'ruser':
					$this->To_Pdf->index($this->ruser_model->rpt_user(),$param,"gendb");
					break;
				case 'rmenu':
					$this->To_Pdf->index($this->rmenu_model->rpt_menu(),$param,"gendb");
					break;
				default:
					$this->To_Pdf->index($this->rappl_model->rpt_appl(),$param,"gendb");
					break;
			}
		}
    }
?>