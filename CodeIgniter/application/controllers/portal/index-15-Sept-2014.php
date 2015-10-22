<?php

//error_reporting(0);

//ini_set('memory_limit','-1');

if (!defined('RANDOMNO'))
	define('RANDOMNO','64ec17e1e68f');
	class Index extends CI_Controller{		
        private $result = array("rows"=>"");
		private $operatorArr = array("eq"=>" = '","neq"=>" != '","endswith"=>" LIKE '%","startswith"=>" LIKE '",
							 "contains"=>" LIKE '%","doesnotcontain"=>" NOT LIKE '%","gte"=>" >= '","gt"=>" > '",
							 "lte"=>" <= '","lt"=>" < '","in"=>" is null","inn"=>" is not null");
		private $blankThis = array("eq","neq","endswith","in","inn");
		
		public function __construct(){
			parent::__construct();
            $this->load->helper(array('form','url','file','date','csv_helper'));
            $this->load->library(array('zip','portal/email','session','form_validation'));
		}
		
		public function index(){
			$data['is_logged_in'] = $this->session->userdata('is_logged_in');
			$data['user_id'] = $this->session->userdata('user_id');
			$data['dynamicBody'] = "index";
	        if ($data['is_logged_in']){
	        	$data['name'] = $this->session->userdata('name');
	        	$data['client_id'] = $this->session->userdata('client_id');
	        	$data['department'] = $this->session->userdata('department');
	        	$data['user_pk'] = $this->session->userdata('id');
	        	$data['client_name'] = $this->session->userdata('client_name');
				if ($data['client_id'] != 15){
					$data['expiry'] = $this->session->userdata('expiry');
					$data['dynamicBody'] = "profile";
				}
		        // // $data['currLeftNav'] = "index";
		        // // $data['mainContent'] = "index";
		        // // $data['title'] = "ARCC - Content Management System";
		        // // $data['formAction'] = 'webapps/';
	            // $data['dynamicBody'] = "index";
		        // // $this->globalView($data);
				// $data['client'] = $this->rclient_model->get_all(array("fieldS"=>"log_time","dir"=>"desc","page"=>1,"pageSize"=>4));
	        }else {
	        	if ($this->session->flashdata('user') != "")
	        		$data['user'] = $this->session->flashdata('user');
	        	if ($this->session->flashdata('error') != "")
	        		$data['error'] = $this->session->flashdata('error');
				
				if ($this->session->flashdata('expiry') != "")
		        	if (new DateTime($this->session->flashdata('expiry')) <= new DateTime("now"))
		        		$data['error'] = "Login Expired!";						
	            // $data['title'] = "Login";
	            // $data['dynamicBody'] = "index";
	            // $data['attributes'] = array("id" => "myForm");

				// $this->load->model('portal/rclient_model');
				// if ($this->uri->segment(4) != ""){
					// $data['dynamicBody'] = $this->uri->segment(4);
	            	// if ($this->uri->segment(4) == "profile"){
						// $query = $this->rclient_model->get_all(array("fieldS"=>"log_time","dir"=>"desc","page"=>1,"pageSize"=>4,"where"=>("where id = " . $this->uri->segment(5))));
						// $data['client'] = $query[0]['name'];
	            		// $this->load->view('portal/index.php', $data);
					// }else
	            	// $this->load->view('portal/' . $this->uri->segment(4));
				// }else {
// 									
				// }
				// if ($this->input->cookie('tries_' . $user)){
					// $data['user'] = $user;
					// $data['error'] = "Couldn't find user using username and password combination!";
					// if (intval($this->input->cookie('tries_' . $user)) >= 3){
						// $data['error'] = "Account is temporarily disabled.\n Kindly go to the nearest MIS Department with your request to enable your account!";
		            	// delete_cookie('tries_' . trim($this->input->post('userName')));
					// }
				// }
				// if ($status > 0){
					// $data['user'] = $user;
					// if ($status == 1){
						// $data['error'] = "Account is temporarily disabled.\n Kindly go to the nearest MIS Department with your request to enable your account!";
		            	// delete_cookie('tries_' . trim($this->input->post('userName')));
					// }else
						// $data['error'] = "Couldn't find user using username and password combination!";
				// }
	            // $this->load->view('portal/login/login_temp', $data);
	        }
	        $this->load->view('portal/home.php', $data);
		}

		public function direct_to(){
				// $this->load->model('portal/rclient_model');
				if ($this->uri->segment(4) != ""){
					$data['dynamicBody'] = $this->uri->segment(4);
	            	// if ($this->uri->segment(4) == "profile"){
						// $query = $this->rclient_model->get_all(array("fieldS"=>"log_time","dir"=>"desc","page"=>1,"pageSize"=>4,"where"=>("where id = " . $this->uri->segment(5))));
						// $data['client'] = $query[0]['name'];
	            		// $this->load->view('portal/index.php', $data);
					// }else
	            	$this->load->view('portal/' . $this->uri->segment(4));
				}
		}
		
		public function save_upload($type = 'document', $client_id = ''){
		    // $uploadRoot = "C:/wamp/www/assets/uploads/";
		    if ($type == "image"){
		    	$fileParam = "files_sub";
		    	$uploadRoot = "E:/www/assets/images/portal/logo/";
			}else {
				$fileParam = "files";
		    	$uploadRoot = "E:/portal/documents/" . $client_id . "/";
			}
		    $files = $_FILES[$fileParam];
		    if (isset($files['name'])){
		        $error = $files['error'];
		        if ($error == UPLOAD_ERR_OK) {
		            $targetPath = $uploadRoot . basename($files["name"]);
		            $uploadedFile = $files["tmp_name"];
		 
		            if (is_uploaded_file($uploadedFile)) {
		                if (!move_uploaded_file($uploadedFile, $targetPath)) {
		                    echo "Error moving uploaded file";
		                }else {
		                	if ($type == "image")
								$this->manage("client",array("id"=>$client_id, "path"=>("/assets/images/portal/logo/" . basename($files["name"])), "log_user"=>$this->session->userdata('user_id'), "log_date" =>mdate("%Y-%m-%d"), "log_time"=>mdate("%Y-%m-%d %H:%i:%s")));
							else {
								$email_adds = "";
								if (!isset($_POST['email_adds'])){
									$this->load->model('portal/ruser_model');
						            $rows = $this->ruser_model->get_by_id($this->session->userdata('creator'));
									// $filepath = 'e:\portal\pref.txt';
									// if (file_exists($filepath)){
										// $string = read_file($filepath);
										// $string = explode(";",$email_adds);
									$email_adds = $rows[0]['email_add'];
									// }
								}else
									$email_adds = $_POST['email_adds'];
								return $this->manage("files",array("id"=>0, 
															"user_id"=>$this->session->userdata('user_id'),
															"name"=>basename($files["name"]),
															"client_id"=>$this->session->userdata('client_id'),
															"log_user"=>$this->session->userdata('user_id'),
															"log_date" =>mdate("%Y-%m-%d"), 
															"log_time"=>mdate("%Y-%m-%d %H:%i:%s"),
															"log_created"=>$this->session->userdata('user_id') . " " . mdate("%Y-%m-%d %H:%i:%s"),
															"recipients"=>(isset($_POST['client_ids']) ? $_POST['client_ids'] : "15,"),
															"users"=>(isset($_POST['user_ids']) ? $_POST['user_ids'] : ($this->session->userdata('creator') . ",")),
															"remarks"=>(isset($_POST['remarks']) ? $_POST['remarks'] : ""),
															"email_adds"=>$email_adds,
															"send_this"=>(isset($_POST['send_this']) ? $_POST['send_this'] : "")));
							}
						}
		            }
		        } else {
		            // See http://php.net/manual/en/features.file-upload.errors.php
		            echo "Error code " . $error;
		        }
		    }
		
		     // Return an empty string to signify success
		     echo "";
		}
		
		public function remove_upload($type = 'document', $client_id = ''){
			$fileParam = "files";
		    // $uploadRoot = "C:/wamp/www/assets/uploads/";
		    if ($type == "image")
		    	$uploadRoot = "E:/www/assets/images/portal/logo/";
			else
		    	$uploadRoot = "E:/portal/documents/" . $client_id . "/";
		    $targetPath = $uploadRoot . basename($_POST["fileNames"]);
		 						
		    unlink($targetPath);
		 
		    // Return an empty string to signify success
		    echo "";
		}
		
		public function file_ref(){
			$filepath = 'e:\portal\file_ref.txt';
			$string = '';
			if ($_POST['type'] == "get"){
				if (file_exists($filepath))
					$string = read_file($filepath);
				if ($string != "")
					echo $string;
				else
					echo "";
			}else {			
				if (!write_file($filepath, $_POST['file_types']))
				     echo 'Unable to write the file';
				echo "1";		
			}
		}
		
		public function pref(){
			$filepath = 'e:\portal\pref.txt';
			$string = '';
			if ($_POST['type'] == "get"){
				if (file_exists($filepath))
					$string = read_file($filepath);
				if ($string != "")
					echo $string;
				else
					echo "";
			}else {
				$string = $_POST['to'] . ";" . $_POST['cc'] . ";" . $_POST['bcc'];
			
				if (!write_file($filepath, $string))
				     echo 'Unable to write the file';
				echo "1";		
			}
		}
		
		public function read($table, $method = "get_all", &$fieldVal = "", &$dbArr = array()){
			if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
				foreach ($_GET['fieldF'] as $field => $val):
					$res = explode(";",$val);
					$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $this->operatorArr[$res[2]] . $res[1] . (in_array($res[2], $this->blankThis) ? "" : "%") . ($res[2] == 'in' ? "" : "'");
					
					// if ($res[2] == "neq")
						// $fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " OR " : "") . $res[0] . " is null";
				endforeach;
			
			// $result_array = eval("\$this->" . $table . "_model->" . $method . "((isset(\$fieldVal) ? \$fieldVal : ''))");
			$str = '\$this->' . $table . '_model->' . $method . '((isset(\$fieldVal) ? \$fieldVal : \'\'))';
			eval("\$result_array = \"$str\";");
			eval("\$result_array = $result_array;");
			
            foreach ($result_array as $r):
				if (isset($r['total']) && ($r['total'] == 0))
					break;
				if (!isset($r['total']))
					$r['total'] = sizeof($result_array);
					
				foreach ($r as $r2 => $v2):
					if (is_object($v2)){
						$date_array = (array) $v2;
						$date_time = $date_array['date'];
						$date_only = explode(" ", $date_time);
						$r[$r2] = $date_only[0];
					}else if (is_string($v2))
						$r[$r2] = stripslashes($v2);
				endforeach;
				
                array_push($dbArr, $r);
            endforeach;
						
            // $this->result['rows'] = $dbArr;
            // $this->output->set_content_type('application/json')->set_output(json_encode($this->result));
		}
		
		public function directCall($item = "",$param = ""){
            $dbArr = array();
			
			switch($item){
				case "export":
					if ($_GET['area_no'] != "" && $_GET['area_no'] != "'<ALL>'")
						$isoWhere = "AND area_no in ({$_GET['area_no']})";
					if ($_GET['rsOption'] > 0)
						$spoolWhere = "AND spool.workable_dt " . (($_GET['rsOption'] == 1) ? "!= NULL" : "= NULL");

					$fieldVal = "";
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							$fieldVal .= " AND " . $res[0] . $this->operatorArr[$res[2]] . $res[1] . (in_array($res[2], $this->blankThis) ? "" : "%") . "'";
						endforeach;
		            foreach ($this->iso_model->area_query_export((isset($fieldVal) ? $fieldVal : ""),(isset($isoWhere) ? $isoWhere : ""),(isset($spoolWhere) ? $spoolWhere : "")) as $r):
							
						foreach ($r as $r2 => $v2):
							if (is_object($v2)){
								$date_array = (array) $v2;
								$date_time = $date_array['date'];
								$date_only = explode(" ", $date_time);
								$r[$r2] = $date_only[0];
							}
						endforeach;
						
		                array_push($dbArr, $r);
		            endforeach;
				    // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "area_query.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="area_query.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "export_insTo":
					$this->read("inst_takeoff", "get_all_export", $fieldVal, $dbArr);
				    // ------ Create and download csv ----
					$csv = array_to_csv($dbArr, "insto.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="insto.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "client":
					$fieldVal = ($this->session->userdata('department') == "MIS" ? "1" : "short_desc != 'ARCC'");
					$this->load->model('portal/rclient_model');
					$this->read("rclient", "get_all", $fieldVal, $dbArr);
					break;
				case "files":
					$fieldVal = " ";
					if (isset($_GET['type_of_trans']) && $_GET['type_of_trans'] == "download")
						$fieldVal = " find_in_set({$_GET['client_id']},recipients) > 0 AND find_in_set({$this->session->userdata('id')},users) > 0";
					else
						$fieldVal = " t.log_created like '{$this->session->userdata('user_id')}%'";
					$this->load->model('portal/files_model');
					$this->read("files", "get_all", $fieldVal, $dbArr);
					break;
				case "user":
					$fieldVal = ($this->session->userdata('department') == "MIS" ? "1" : ("t.log_created like '" . $this->session->userdata('user_id') . "%'"));
					$this->load->model('portal/ruser_model');
					$this->read("ruser", "get_all", $fieldVal, $dbArr);
					break;
				case "user_by_id":
					$fieldVal = $this->session->userdata('creator');
					$this->load->model('portal/ruser_model');
					$this->read("ruser", "get_by_id", $fieldVal, $dbArr);
					break;
				case "user_dd":
					$this->load->model('portal/ruser_model');
					$this->read("ruser", "get_all_dd", $fieldVal, $dbArr);
					break;
				case "expired":
					$this->load->model('portal/ruser_model');
					$this->read("ruser", "get_expired", $fieldVal, $dbArr);
					break;
				case "pieceStruc":
					$fieldVal = "plant_no = '{$_GET['plant_no']}' and area_no = '{$_GET['area_no']}' and drawing_no = '{$_GET['drawing_no']}' and sheet_no = '{$_GET['sheet_no']}' and rev_no = '{$_GET['rev_no']}' and area_loc = '{$_GET['area_loc']}'";
					$this->read("piece_struc", "get_all", $fieldVal, $dbArr);
					break;
				default:
					break;
			}
            $this->result['rows'] = $dbArr;
            $this->output->set_content_type('application/json')->set_output(json_encode($this->result));
		}

		public function compress(){
			$dbArr = array();
			$this->load->model('portal/files_model');
			$fieldVal = " find_in_set(t.id,'{$_GET['ids']}') > 0 ";
			$this->read("files", "get_all", $fieldVal, $dbArr);
			$data = array();
			$ids = "";
			foreach ($dbArr as $key => $value) {
				// array_push($data, ('e:/portal/documents/' . $value['client_id'] . "/" . $value['name']));
				// echo 'e:/portal/documents/' . $value['client_id'] . "/" . $value['name'] . "<br />";
				$ids .= $value['id'] . ",";
				if (sizeof($dbArr) - 1 == $key)
					$this->manage("files", array("id"=>$ids,"log_user"=>$this->session->userdata('user_id'),"date_open"=>mdate("%Y-%m-%d")));
				$this->zip->read_file('e:/portal/documents/' . $value['client_id'] . "/" . $value['name']);
			} 
			$this->zip->download('ARCC_PORTAL_' . mdate("%Y-%m-%d"));
			// if (!write_file('e:\ids.txt', $ids))
			     // echo 'Unable to write the file';
			// else
			     // echo 'File written!';
			$this->manage("files", array("id"=>$ids,"log_user"=>$this->session->userdata('user_id'),"date_open"=>mdate("%Y-%m-%d")));		
			// $this->zip->read_file($data);
			// $zipname = 'ARCC_PORTAL_' . mdate("%Y-%m-%d") . '.zip';
			// $this->zip->archive('e:/portal/documents/' . $zipname);
			// header('Content-Type: application/zip');
			// header('Content-disposition: attachment; filename='.$zipname);
			// header('Content-Length: ' . filesize($zipname));
			// // $zipname = urldecode($zipname);
// //            
            // // echo $zipname;
// 
			// readfile('http://localhost/documents/' . $zipname);
		    // header('Content-Type: application/zip');
			// header('Content-Disposition: attachment; filename="ARCC_PORTAL_' . mdate("%Y-%m-%d") . '.zip"');
			// $csv = urldecode($csv);
//            
            // echo $csv;
			// return true;
			// $this->zip->clear_data();
		}

		public function manage($item = "",$postInfo = array()){
			// foreach( $postInfo as $r => $val){
                // $data .= $r . ": " . $val . " ";
			// }
			// if (!write_file('e:\upload.txt', $data))
			     // echo 'Unable to write the file';
			// else
			     // echo 'File written!';
			switch($item){
				case "client":
					$this->load->model('portal/rclient_model');
					$this->callback($this->rclient_model->set($postInfo));
					break;
				case "files":
					$this->load->model('portal/files_model');
					$this->callback($this->files_model->set($postInfo));
					break;
				case "file_users":
					$this->load->model('portal/files_model');
					$this->callback($this->files_model->reactivate($postInfo));
					break;
				case "user":
					$this->load->model('portal/ruser_model');
					$this->callback($this->ruser_model->set($postInfo));
					break;
				default:
					break;
			}
		}

		private function callback($return_value){
			if(is_array($return_value))
				echo $return_value[0]['return_value'];
			else
				echo $return_value;
		}
	
		public function remove($item = ""){
			switch($item){
				case "client":
					$this->load->model('portal/rclient_model');
					$this->callback($this->rclient_model->remove());
					break;
				case "files":
					$this->load->model('portal/files_model');
					$this->callback($this->files_model->remove());
					break;	
				case "user":
					$this->load->model('portal/ruser_model');
					$this->callback($this->ruser_model->remove());
					break;			
				default:
					$this->iso_model->remove_iso();
					break;
			}
		}
    
	    public function validateCredentials(){
	        $this->form_validation->set_rules("userName","Username","trim|required");
	        $this->form_validation->set_rules("passWord","Password","trim|required");
	
	        if (!$this->form_validation->run()){
	            $data['username'] = $this->input->post('userName');
	            $data['passWord'] = $this->input->post('passWord');
	            redirect("portal");
	        }else{
				$this->load->model('portal/ruser_model');
	            $data['users_item'] = $this->ruser_model->getUser(array(trim($this->input->post('userName')),trim($this->input->post('passWord'))));
	            if (!empty($data['users_item'])){
	            	if (new DateTime($data['users_item']['expiry']) >= new DateTime("now")){
	            		$this->load->model('portal/rclient_model');
						$data['client_item'] = $this->rclient_model->get_by_id($data['users_item']['client_id']);
		            	// if ($this->input->cookie('tries_' . trim($this->input->post('userName'))))
		            		// delete_cookie('tries_' . trim($this->input->post('userName')));
	
		                $newData = array("user_id"=>$data['users_item']['user_id'],"expiry"=>$data['users_item']['expiry'],"name"=>($data['users_item']['first_name'] . " " . $data['users_item']['last_name']),
		                				 "id"=>$data['users_item']['id'],"client_id"=>$data['users_item']['client_id'],"is_logged_in"=>1,"client_name"=>$data['client_item'][0]['name'],"creator"=>$data['users_item']['creator'],
		                				 "department"=>$data['users_item']['department']); //
		                $this->session->set_userdata($newData);
					}else {
	            		$this->session->set_flashdata("user",$this->input->post('userName'));
	            		$this->session->set_flashdata("is_logged_in",0);
	            		$this->session->set_flashdata("expiry",$data['users_item']['expiry']);
						// $data['error'] = "Login Expired!";
						// // $this->index();
						// // return true;
					}
	            }else{
	            	$this->session->set_flashdata("error","Login failed!");
	            	$data['users_item'] = $this->ruser_model->get_by_user(trim($this->input->post('userName')));
	            	if (!empty($data['users_item'])){
	            		$this->session->set_flashdata("user",$this->input->post('userName'));
	            		$this->session->set_flashdata("error","Password does not match!");
					}
					// if ($data['users_item']['date_expiry'] <= mdate("%Y-%m-%d")){
		            	// $tries = 0;
		            	// if ($this->input->cookie('tries_' . trim($this->input->post('userName')))){
		            		// $tries = intval($this->input->cookie('tries_' . trim($this->input->post('userName'))));
		            		// delete_cookie('tries_' . trim($this->input->post('userName')));
						// }
	// 					
						// $tries += 1;
		            	// $cookie = array(
						    // 'name'   => trim($this->input->post('userName')),
						    // 'value'  => $tries,
						    // 'expire' => 0, //'86400',
						    // 'domain' => "", //base_url(),
						    // 'path'   => '/',
						    // 'prefix' => 'tries_',
						    // 'secure' => false
						// );
	// 					
						// $this->input->set_cookie($cookie);
						// /*setcookie('tries', '1', time()+3600*24,'/', base_url(),0);*/
		                // //$this->index(trim($this->input->post('userName')), 2); //"error","Couldn't find the user."
		            	// redirect("portal/index/index/" . trim($this->input->post('userName')));
					// }else
						// $this->index($this->input->post('userName'),intval($data['users_item'][0]['inactive']));
				}
	            redirect("portal");
	        }
	    }
    
	    public function offCredentials(){            
	        // $this->session->unset_userdata("is_logged_in");
	        $this->session->sess_destroy();
	        redirect("portal/");
	    }
	}
?>