<?php
	class templateLoader extends CI_Controller {
		
		public function __construct(){
			parent::__construct();
        	$this->load->helper(array('form','url','file','date'));
			// $this->load->model('webapps/sys_prog_model');
			// $this->load->model('webapps/sys_attach_model');
			// $this->load->model('webapps/user_job_model');
			// $this->load->model('webapps/job_tbl_model');
		}
		
		public function index(){
            // $this->load->view('templates/' . $this->uri->segment(2) . (($this->uri->segment(3) != "") ? "/" . $this->uri->segment(3) : ""));
			$this->load->view('templates/' . $this->uri->segment(2) . (($this->uri->segment(3) != "") ? "/" . $this->uri->segment(3) : ""));
		}
		
		public function directCall($item = ""){
            $dbArr = array();
            $output = array("rows"=>"");
			$operatorArr = array("eq"=>" = '","neq"=>" != '","endswith"=>" LIKE '%","startswith"=>" LIKE '","contains"=>" LIKE '%","doesnotcontain"=>" NOT LIKE '%");
			$blankThis = array("eq","neq","endswith");
			$progTypeDesc = array("","Character","Integer","Decimal","Date","Logical");
			switch($item){
				case "programmer":
		            foreach ($this->sys_prog_model->getAll() as $r):
						$r['prog_type_desc'] = $progTypeDesc[intval($r['prog_type'])];
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "job":
		            foreach ($this->job_tbl_model->get_all_dd() as $r):
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "job_user":
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							//$fieldVal[$res[0]] = $res[1];
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
						
		            foreach ($this->user_job_model->getAll((isset($fieldVal) ? $fieldVal : "")) as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
						
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "attach":
					if (isset($_GET['fieldF']) && is_array($_GET['fieldF']))
						foreach ($_GET['fieldF'] as $field => $val):
							$res = explode(";",$val);
							//$fieldVal[$res[0]] = $res[1];
							$fieldVal = ((isset($fieldVal) && trim($fieldVal) != "") ? $fieldVal . " AND " : "") . $res[0] . $operatorArr[$res[2]] . $res[1] . (in_array($res[2], $blankThis) ? "" : "%") . "'";
						endforeach;
						
		            foreach ($this->sys_attach_model->getAll((isset($fieldVal) ? $fieldVal : "")) as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
						
						$r['attach_path'] = stripslashes($r['attach_path']); 
		                array_push($dbArr, $r);
		            endforeach;
					break;
				default:
					break;
			}
            $output['rows'] = $dbArr;
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		
		public function manage($item = ""){
			switch ($item){
				case "programmer":
					$this->sys_prog_model->set_sysProg();
					break;
				case "attach":
					$this->sys_attach_model->set_sysAtt();
					break;
				case "job_user":
					//echo $_POST['PROGRESS_RECID'] . " " . $_POST['user_id'] . " " . $_POST['listOfSelected'];
					echo $this->user_job_model->set_user_job();
					break;
				case "job_user_init":
					//echo $_POST['PROGRESS_RECID'] . " " . $_POST['user_id'] . " " . $_POST['listOfSelected'];
					$this->user_job_model->set_user_job();
					break;
				default:
					break;
			}
		}
		
		public function remove($item = ""){
			switch($item){
				case "programmer":
					$this->output->set_content_type('application/json')->set_output($this->sys_prog_model->remove_sysProg());
					break;
				case "job_user":
					$this->user_job_model->remove_job();
					break;
				case "attach":
					/*foreach( $_POST as $r => $val){
		                $data .= $r . ": " . $val . " ";
					}
					if (!write_file('e:\postData3.txt', $data))
					     echo 'Unable to write the file';
					else
			     		echo 'File written!';*/
					$this->output->set_content_type('application/json')->set_output($this->sys_attach_model->remove_sysAtt());
					break;
				default:
					break;
			}
		}
	}
?>