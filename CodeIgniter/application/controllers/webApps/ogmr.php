<?php	
    require_once("application/controllers/webapps/To_Pdf.php");
	class ogmr extends CI_Controller {
		private $tblName = "ogmr";
		
		public function __construct(){
			parent::__construct();
            $this->load->helper(array('form','url','file','date','csv_helper'));
			$this->load->model('webapps/tempdb_ogmr_model');
			$this->load->model('webapps/ogmr_model');
			$this->load->model('webapps/job_tbl_model');
		}
		
		public function index(){
			echo "OGMR Index";
		}
		
		public function save_upload(){
			$fileParam = "files";
		    $uploadRoot = "C:/wamp/www/assets/uploads/";
		    $files = $_FILES[$fileParam];
		 
		    if (isset($files['name']))
		    {
		        $error = $files['error'];
		 
		        if ($error == UPLOAD_ERR_OK) {
		            $targetPath = $uploadRoot . basename($files["name"]);
		            $uploadedFile = $files["tmp_name"];
		 
		            if (is_uploaded_file($uploadedFile)) {
		                if (!move_uploaded_file($uploadedFile, $targetPath)) {
		                    echo "Error moving uploaded file";
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
		
		public function directCall($item = "",$param = ""){
            $dbArr = array();
            $output = array("rows"=>"");
			switch($item){
				case "transact":  
					/*foreach( $_GET as $r => $val){
		                $data .= $r . ": " . $val . " ";
					}
					$start = ($_GET['page'] - 1) * $_GET['pageSize'];
					$data = "SELECT (select count(*) FROM ogmr) as total,PROGRESS_RECID,job_no,booklet_no,ogmr_no,requisitioner,trans_date,addressee,description,dept,remarks,file_attach,upload_no,loguser,logdate,logupdate FROM {$this->tblName} where {$_GET['field']} like '% {$_GET['value']} %' order by ogmr_no LIMIT {$start},{$_GET['pageSize']}";
					if (!write_file('e:\postData3.txt', $data))
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
		            foreach ($this->ogmr_model->getAll((isset($fieldVal) ? $fieldVal : "" /*array()*/)) as $r):
						if (isset($r['total']) && ($r['total'] == 0))
							break;
						
						$r['exists'] = ($r['file_attach'] != "" && file_exists("c:/wamp/www/assets/pdf/documents/" . $r['file_attach']) ? "&#10003" : "");
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "export":
		            /*foreach ($this->ogmr_model->getAll_export() as $r):
						$r['exists'] = ($r['file_attach'] != "" && file_exists("c:/wamp/www/assets/pdf/documents/" . $r['file_attach']) ? "&#10003" : "");
		                array_push($dbArr, $r);
		            endforeach;*/
				    //------ Create and download csv ----
					$csv = query_to_csv($this->ogmr_model->getAll_export(), true, "ogmr_registers.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="ogmr_registers.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;
					return true;
					break;
				case "query":
		            foreach ($this->tempdb_ogmr_model->getAllPlus() as $r):
						$r['exists'] = ($r['file_attach'] != "" && file_exists("c:/wamp/www/assets/pdf/documents/" . $r['file_attach']) ? "&#10003" : "");
		                array_push($dbArr, $r);
		            endforeach;
		            //var_dump($this->tempdb_ogmr_model->getAllPlus());
					break;
				case "booklet":
		            foreach ($this->ogmr_model->get_all_filtered_booklet() as $r): //getAllBooklet
		                array_push($dbArr, $r);
		            endforeach;
					break;
				case "job":
		            // foreach ($this->job_tbl_model->get_all_dd() as $r):
		                // array_push($dbArr, $r);
		            // endforeach;
		            $dbArr = $this->job_tbl_model->get_all_dd();
					break;
				case "jobNo":
		            foreach ($this->job_tbl_model->getAllJob() as $r):
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
				case "transact":  
					// foreach( $_POST as $r => $val){
		                // $data .= $r . ": " . $val . " ";
					// }
					// if (!write_file('e:\postData3.txt', $data))
					     // echo 'Unable to write the file';
					// else
					     // echo 'File written!';
					$this->ogmr_model->set_ogmr();
					break;
				case "justNow":
					echo $this->ogmr_model->call_proc();
					break;
				default:
					break;
			}
		}
		
		public function remove($item = ""){ 
			switch($item){
				case "transact":
					$this->output->set_content_type('application/json')->set_output($this->ogmr_model->remove_ogmr());
					break;
				default:
					$this->output->set_content_type('application/json')->set_output($this->ogmr_model->remove_ogmr_br());
					break;
			}
		}
		
		public function print_to_csv($item = ""){        
	        $this->To_Pdf = new To_Pdf();
			switch($item){
				case "register": 
					/*foreach( $_POST as $r => $val){
		                $data .= $r . ": " . $val . " ";
					}
					$start = ($_GET['page'] - 1) * $_GET['pageSize'];
					$data = "SELECT (select count(*) FROM ogmr) as total,PROGRESS_RECID,job_no,booklet_no,ogmr_no,requisitioner,trans_date,addressee,description,dept,remarks,file_attach,upload_no,loguser,logdate,logupdate FROM {$this->tblName} where {$_GET['field']} like '% {$_GET['value']} %' order by ogmr_no LIMIT {$start},{$_GET['pageSize']}";
					if (!write_file('e:\postData3.txt', $data))
					     echo 'Unable to write the file';
					else
					     echo 'File written!';*/
					//$this->load->dbutil();*/
					/*$csv = $this->ogmr_model->rpt_register();
					header("Content-type: application/csv-tab-delimited-table" );
		           header("Content-Disposition: attachment filename='romel.csv'" );
		           header("Content-Description: fichier binaire" );
		           header("Content-Transfer-Encoding: binary" );*/
				    //------ Create and download csv ----
					/*$csv = query_to_csv($this->ogmr_model->rpt_register(), true, "romel.csv");
				    header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="romel.csv"');
					$csv = urldecode($csv);
		           
		            echo $csv;*/
		           
		           //echo $this->ogmr_model->rpt_register();
		           $param = array("prepBy"=>$_POST['prepBy'],"submitBy"=>$_POST['submitBy']);
	        	   $this->To_Pdf->index($this->ogmr_model->rpt_register(),$param,"projdb");
			//header('Content-Type: text/csv; charset=utf-8');
			//header('Content-Disposition: attachment; filename=romel.csv');
		           //echo $this->ogmr_model->rpt_register();  
		           //var_dump($this->ogmr_model->rpt_register()); //query_to_csv($this->ogmr_model->rpt_register(),"romel.csv"));
		           //query_to_csv($this->ogmr_model->rpt_register(),true,"e:\\romel.csv");
		           //query_to_csv($this->ogmr_model->rpt_register(),true,"romel.csv");
				   //if (!write_file('e:\csv.csv', $data))
				//	     echo 'Unable to write the file';
				//	else
				//	     echo 'File written!';
				   //write_file('e:\\csv_file.csv',$csv);
		           //var_dump(array("romel"=>"romel"));
					break;
				case "register_wa":
			            $param = array("prepBy"=>$_POST['prepBy'],"submitBy"=>$_POST['submitBy']);
						//echo $_POST['fijob'] . " " . $_POST['fibooklet'] . " " . $this->ogmr_model->rpt_register_wa();
		        	    $this->To_Pdf->index($this->ogmr_model->rpt_register_wa(),$param,"projdb");
					break;
			}
		}
	}
?>