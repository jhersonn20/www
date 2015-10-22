<?php
    class Billing_invoice_Model extends CI_Model {
		private $tblName = "billing_invoice";
        public function __construct(){
            parent::__construct();
            //$this->load->database();
        	$this->projdb = $this->load->database('projdb', true);
        }
        
        public function getAll($where = ""){
        	// $query = $this->projdb->get($this->tblName)->result_array();
			// $query[0]['total'] = $this->projdb->count_all_results($this->tblName);
            // return $query;			
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			if ($_GET['value'] == ""){
				//$sql = "SELECT (select count(*) FROM ogmr) as total,PROGRESS_RECID,job_no,booklet_no,ogmr_no,requisitioner,trans_date,addressee,description,dept,remarks,file_attach,upload_no,loguser,logdate,logupdate FROM {$this->tblName} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
				//$query = $this->projdb->select("(select count(*) FROM {$this->tblName} where {$where}) as total,PROGRESS_RECID,trans_date,pay_type,invoice_date,invoice_no,invoice_amt,client_bankref,bankref_date,proj_remarks,file_origin,letter_no,invoice_letter,acctg_confirmed,acctg_remarks,invoice_confirmed")->from($this->tblName)->where($where)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
				$query = $this->projdb->select("(select count(*) FROM {$this->tblName} where {$where}) as total,t.*")->from($this->tblName . ' as t')->where($where)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
				$query = $this->projdb->get();
				$rowArr = $query->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$query = $this->projdb->select('count(*) as total')->from($this->tblName)->where($where); //->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
					$query = $this->projdb->get();
					$result = $query->result();
					$total = $result[0]->total;
					
					$query = $this->projdb->select()->from($this->tblName)->where($where)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
					$query = $this->projdb->get();
					$rowArr = $query->result_array();
					$rowArr[0]['total'] = $total;
				}else{
					//$sql = "SELECT (select count(*) FROM {$this->tblName} where {$_GET['value']}) as total,PROGRESS_RECID,trans_date,pay_type,invoice_date,invoice_no,invoice_amt,client_bankref,bankref_date,proj_remarks,file_origin,letter_no,invoice_letter,acctg_confirmed,acctg_remarks,invoice_confirmed FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$sql = "SELECT (select count(*) FROM {$this->tblName} where {$_GET['value']}) as total,t.* FROM {$this->tblName} as t where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$rowArr = $this->projdb->query($sql)->result_array();
				}
			}
			return $rowArr;
        }

		public function get_bill_wpay(){
			$this->projdb->from($this->tblName)->where('pay_type', $_POST['pay_type']);
			$rowArr[0]['isExist'] = $this->projdb->count_all_results();
			return $rowArr;
		}
		
		public function returnTime(){			
			return mdate("%Y-%m-%d %H:%i:%s");
		}
        
        public function set(){		
	        $ci =& get_instance();
            $ci->load->model('webapps/job_tbl_model');
			
			$postInfo = array();
			foreach ($_POST as $key => $value) {
				if ($key == "PROGRESS_RECID" || $key == "total" || $key == "cmode" || $key == "err_remarks" || $key == "idField" || $key == "_defaultId" || $key == "isLast" || $key == "errCounter")
					continue;
				if ($value == 'NULL' || $value == '')
					continue;
				$postInfo[$key] = $value;
			}
			$postInfo['logupdate'] = $_POST['loguser'] . " " . mdate("%Y-%m-%d") . " " . mdate("%H:%i:%s");
			$postInfo['logdate'] = mdate("%Y-%m-%d") . " " . mdate("%H:%i:%s");
			
			// var_dump($postInfo);
			// return true;
            if ($_POST['PROGRESS_RECID'] > 0){
            	if ($_POST['cmode'] == 'reedit'){
            		$sql = "INSERT INTO h_billing_invoice select * from {$this->tblName} where PROGRESS_RECID = {$_POST['PROGRESS_RECID']}";
					$this->projdb->query($sql);
					            		
					$query = $this->projdb->select('invoice_amt')->from($this->tblName)->where('PROGRESS_RECID',$_POST['PROGRESS_RECID']);
					$query = $this->projdb->get();
					$result = $query->result();
					$invoice_amt = $result[0]->invoice_amt;
					
		        	$ci->job_tbl_model->update_bill('update',(intval($_POST['invoice_amt']) - $invoice_amt));
            	}else {
		            if (strtolower($_POST['acctg_confirmed']) == 'null' || strtolower($_POST['acctg_confirmed']) == '' || substr($_POST['acctg_confirmed'],0,2) == '00'){
						$query = $this->projdb->select('invoice_amt')->from($this->tblName)->where('PROGRESS_RECID',$_POST['PROGRESS_RECID']);
						$query = $this->projdb->get();
						$result = $query->result();
						$invoice_amt = $result[0]->invoice_amt;
						
			        	$ci->job_tbl_model->update_bill('update',(intval($_POST['invoice_amt']) - $invoice_amt));
					}else
			        	$ci->job_tbl_model->update_bill('transfer',intval($_POST['invoice_amt']),$_POST['trans_date']);
				}    
								
            	$query = $this->projdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->projdb->update($this->tblName, $postInfo);				
			}else{
	        	$ci->job_tbl_model->update_bill('update',intval($_POST['invoice_amt']));
				$query = $this->projdb->set($postInfo);
				$query = $this->projdb->insert($this->tblName);
			}
			
			return $query;
        }

		public function get_query($where = ""){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];			
    		$query = $this->projdb->query("select @where_stm:=\"{$where}\", @baseDate:='{$_GET['baseDate']}', @user_id:='{$_GET['user_id']}', @type:='{$_GET['type']}', @module:='{$_GET['module']}', @page:='{$_GET['page']}', @pageSize:='{$_GET['pageSize']}', @start:={$start}");
			if ($_GET['query'] != 'status')
				$query = $this->projdb->query("CALL projdb.outRec_q()")->result_array();
			else
				$query = $this->projdb->query("CALL projdb.bcStatus_q()")->result_array();
			
			return $query;
		}

		public function process(){
			$sql = "call projdb.proc_pd()";
			
			return $this->projdb->query($sql);
		}

		public function processAgain(){
			$sql = "call projdb.procAgain()";
			
			return $this->projdb->query($sql);
		}
		
		public function remove(){
	        $ci =& get_instance();
            $ci->load->model('webapps/job_tbl_model');
			
			$query = $this->projdb->select('invoice_amt')->from($this->tblName)->where('PROGRESS_RECID',$_POST['PROGRESS_RECID']);
			$query = $this->projdb->get();
			$result = $query->result();
			$invoice_amt = $result[0]->invoice_amt;
			
        	$query = $this->projdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->projdb->delete($this->tblName);
			
	        $ci->job_tbl_model->update_bill('destroy',$invoice_amt);
				
			return $query;
		}
    }
?>