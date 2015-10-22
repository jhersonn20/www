<?php
	class To_Pdf extends CI_Controller {
		private $rpt_dir = "C:\\wamp\\www\\assets\\rpt\\";
		private $pdf_dir = "C:\\wamp\\www\\assets\\pdf\\";
		private $rpt_name;
		private $pdf_name;
		
		public function __construct(){
			parent::__construct();
            $this->load->helper(array('form','file'));
		}
		
		public function index($query = "", $param = array(), $db = ""){
			$this->rpt_name = $this->rpt_dir . $_POST['rpt_name'] . ".rpt";
			$this->pdf_name = $this->pdf_dir . $_POST['rpt_name'] . ".pdf";
			
			/*if (!write_file('e:\postData.txt', $this->rpt_name))
			     echo 'Unable to write the file';
			else
			     echo 'File written!';*/
			return $this->print_pdf($query, $param, $db);
		}
		
		private function print_pdf($query = "", $param = array(), $db){
		    if(file_exists($this->pdf_name))
		            if(!unlink($this->pdf_name))
		                    echo "Failed to clear temp.  please try again";
					
		    try{			
				$ObjectFactory= new COM("CrystalRunTime.Application") or die("cannot load cr com");
				$creport = $ObjectFactory->OpenReport($this->rpt_name, 1) or die("Couldn’t open report");
				
				$ObjectFactory->LogOnServer('PDSODBC.DLL','mysql_' . $db,$db,'root','mysql');
				
				//$creport->RecordSelectionFormula="{company.company_name}='AL RUSHAID CONSTRUCTION CO. LTD.'";
				//$creport->RecordSelectionFormula="{ogmr.job_no}='530'";
				$creport->RecordSelectionFormula=$query;
				//$creport->RecordSelectionFormula= mysql_real_escape_string($query);
                $creport->EnableParameterPrompting = 0;
				$creport->DiscardSavedData;
				$creport->ReadRecords();               
               
			    if (count($param) > 0)
	                for($i=1; $i<=count($param); $i++){
	                    $field = $creport->ParameterFields($i);
						$end = (strlen(substr($creport->ParameterFields($i)->Name, 2)) - 1);
						$paramName = substr($field->Name, 2, $end);
						
	                    $res = @$field->SetCurrentValue($param[$paramName]);
	                    if($res != 0)
	                        return "Failed to create report.  Failed to set parameter $i with value " . $param[$i];
	                }
				
				$creport->ExportOptions->DiskFileName = $this->pdf_name;
				$creport->ExportOptions->FormatType = 31;
				$creport->ExportOptions->DestinationType = 1;
				$creport->Export(false);
				
				$crapp = null;
				$creport = null;
				$ObjectFactory = null;
				
				if(file_exists($this->pdf_name)){
					echo "true";
				    /*$pdf = file_get_contents($this->pdf_name);
				    if(strlen($pdf) != filesize($this->pdf_name))
				            return "Error: filesize=".filesize($this->pdf_name)." strlen=".strlen($pdf);
					
				    header("Pragma: ");
				    header("Cache-Control: ");
				    header("Content-type: application/pdf");
				    //header("Content-Disposition: attachment;filename=" . extractName($this->rpt_name) . ".pdf"); // For IE
				    header("Content-Disposition: attachment;filename=localhost/assets/pdf/company.pdf"); // For IE
				    echo($pdf);
				    exit();*/
				}else
					echo "Failed to export";
					
			}catch(Exception $e){
		            echo "Failed to connect to Crystal Reports 2008: $e";
		    }
		}
	}
?>