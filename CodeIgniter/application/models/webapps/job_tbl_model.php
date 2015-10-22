<?php
    class JOB_TBL_Model extends CI_Model {
		private $tblName = "job_tbl";
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
				$query = $this->projdb->select("(select count(*) FROM {$this->tblName} where {$where}) as total,PROGRESS_RECID,job_no,job_desc,cutoff_day,client_submission,client_review,pay_terms,contract_amt,billing_collected,billing_due,billing_for_col,billed_amt,contribution_rate,contribution_amt,budget,si_amt,miles_amt")->from($this->tblName)->where($where)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
				$query = $this->projdb->get();
				$rowArr = $query->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$query = $this->projdb->select('count(*) as total')->from($this->tblName)->where($where); //->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
					$query = $this->projdb->get();
					$total = $query->result();
					$total = $total[0]->total;
					
					$query = $this->projdb->select('PROGRESS_RECID,job_no,job_desc,cutoff_day,client_submission,client_review,pay_terms,contract_amt,billing_collected,billing_due,billing_for_col,billed_amt,contribution_rate,contribution_amt,budget,si_amt,miles_amt')->from($this->tblName)->where($where)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
					$query = $this->projdb->get();
					$rowArr = $query->result_array();
					$rowArr[0]['total'] = $total;
				}else{
					$sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,job_no,job_desc,cutoff_day,client_submission,client_review,pay_terms,contract_amt,billing_collected,billing_due,billing_for_col,billed_amt,contribution_rate,contribution_amt,budget,si_amt,miles_amt FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$rowArr = $this->projdb->query($sql)->result_array();
				}
			}
			return $rowArr;
			
        }
        
        public function get_all_per_user($where = ""){
        	// $query = $this->projdb->get($this->tblName)->result_array();
			// $query[0]['total'] = $this->projdb->count_all_results($this->tblName);
            // return $query;
			
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			if ($_GET['value'] == ""){
				//$sql = "SELECT (select count(*) FROM ogmr) as total,PROGRESS_RECID,job_no,booklet_no,ogmr_no,requisitioner,trans_date,addressee,description,dept,remarks,file_attach,upload_no,loguser,logdate,logupdate FROM {$this->tblName} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
				// $query = $this->projdb->select("(select count(*) FROM {$this->tblName} where {$where}) as total,PROGRESS_RECID,job_no,job_desc,cutoff_day,client_submission,client_review,pay_terms,contract_amt,billing_collected,billing_due,billing_for_col,billed_amt,contribution_rate,contribution_amt,budget,si_amt,miles_amt")->from($this->tblName)->where($where)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
				// $query = $this->projdb->get();				$sql = "SELECT (select count(*) from {$this->tblName} t inner join gendb.user_job t2 on t.job_no = t2.job_no where {$where}) as total, t.* FROM {$this->tblName} t inner join gendb.user_job t2 on t.job_no = t2.job_no where {$where} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
				$query = $this->projdb->query($sql);
				$rowArr = $query->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					// $query = $this->projdb->select('count(*) as total')->from($this->tblName)->where($where); //->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
					// $query = $this->projdb->get();
					// $total = $query->result();
					// $total = $total[0]->total;
					
					// $query = $this->projdb->select('PROGRESS_RECID,job_no,job_desc,cutoff_day,client_submission,client_review,pay_terms,contract_amt,billing_collected,billing_due,billing_for_col,billed_amt,contribution_rate,contribution_amt,budget,si_amt,miles_amt')->from($this->tblName)->where($where)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
					// $query = $this->projdb->get();					$sql = "select t.*, (select count(*) from {$this->tblName} t inner join gendb.user_job t2 on t.job_no = t2.job_no where {$where}) as total FROM {$this->tblName} t inner join gendb.user_job t2 on t.job_no = t2.job_no where {$where} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$query = $this->projdb->query($sql);
					$rowArr = $query->result_array();
					// $rowArr[0]['total'] = $total;
				}else{
					$sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,job_no,job_desc,cutoff_day,client_submission,client_review,pay_terms,contract_amt,billing_collected,billing_due,billing_for_col,billed_amt,contribution_rate,contribution_amt,budget,si_amt,miles_amt FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$rowArr = $this->projdb->query($sql)->result_array();
				}
			}
			return $rowArr;
			
        }
        
        public function get_all_dd(){
        	$sql = "SELECT PROGRESS_RECID, job_no, job_desc FROM " . $this->tblName;
            return $this->projdb->query($sql)->result_array();
        }
        
        public function getAllJob(){
        	$sql = "SELECT job_no FROM " . $this->tblName;
            return $this->projdb->query($sql)->result_array();
        }
		
		public function getByJob($user_id = ""){
			//$sql = "SELECT * FROM $this->tblName WHERE user_id = ?";
			$sql = "SELECT " . $this->tblName2 . ".appl_code," . $this->tblName2 . ".appl_name_short FROM " . $this->tblName . "," . $this->tblName2 . " where " . $this->tblName . ".appl_code = " . $this->tblName2 . ".appl_code and " . $this->tblName . ".user_id = ? and " . $this->tblName2 . ".publish = 1";
			return $this->projdb->query($sql, $user_id)->result_array();
		}
		
		public function get_by_job($user_id = ""){
			$sql = "SELECT * FROM {$this->tblName} WHERE job_no = ?";
			return $this->projdb->query($sql, $_GET['job_no'])->result_array();
		}
        
        public function set_job(){			
            if ($_POST['PROGRESS_RECID'] > 0){
	            $postInfo = array("appl_code"=>$_POST['appl_code'],
	            				  "group_code"=>$_POST['group_code'],
								  "appl_jsu"=>$_POST['appl_jsu'],
								  "appl_su"=>$_POST['appl_su'],
								  "loguser"=>$_POST['user_id'],
								  "logdate"=>mdate("%Y-%m-%d"));
            	$query = $this->projdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->projdb->update($this->tblName, $postInfo);
			}else{
	            $postInfo = array("PROGRESS_RECID"=>$_POST['PROGRESS_RECID'],
	            				  "appl_code"=>$_POST['appl_code'],
	            				  "user_id"=>mysql_real_escape_string($_POST['user_id']),
	            				  "group_code"=>$_POST['group_code'],
								  "appl_jsu"=>$_POST['appl_jsu'],
								  "appl_su"=>$_POST['appl_su'],
								  "appl_stat"=>1,
								  "loguser"=>$_POST['user_id'],
								  "logdate"=>mdate("%Y-%m-%d"));
				$query = $this->projdb->set($postInfo);
				$query = $this->projdb->insert($this->tblName);
			}
			
			return $query;
        }

		public function set_bill(){
			$postInfo = array();
			foreach ($_POST as $key => $value) {
				if ($key == "PROGRESS_RECID" || $key == "err_remarks" || $key == "idField" || $key == "_defaultId" || $key == "isLast" || $key == "errCounter")
					continue;
				$postInfo[$key] = $value;
			}
			$postInfo['logupdate'] = $_POST['loguser'] . " " . mdate("%Y-%m-%d %H:%i:%s");
			$postInfo['logdate'] = mdate("%Y-%m-%d %H:%i:%s");
			
        	$query = $this->projdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->projdb->update($this->tblName, $postInfo);		
			
			return $query;	
		}
		
		public function update_bill($event = "", $invoice_amt = 0, $trans_date = ''){
			$query = $this->projdb->select('billing_collected, billing_due, billing_for_col, billed_amt, si_amt, miles_amt, pay_terms')->from($this->tblName)->where('job_no',$_POST['job_no']);
			$query = $this->projdb->get();
			$result = $query->result();
			$billing_collected = $result[0]->billing_collected;
			$billing_due = $result[0]->billing_due;
			$billing_for_col = $result[0]->billing_for_col;
			$billed_amt = $result[0]->billed_amt;
			$si_amt = $result[0]->si_amt;
			$miles_amt = $result[0]->miles_amt;
			$pay_terms = $result[0]->pay_terms;
			
			$date=date_create($trans_date);
			date_add($date,date_interval_create_from_date_string("{$pay_terms} days"));
			
			$sql = "select fieldName from pay_type where pay_type.pay_type = '{$_POST['pay_type']}'";
			$result = $this->projdb->query($sql)->result_array();
			if ($event != 'transfer'){				
				$postInfo = array(
					'billing_for_col' => (($event == "update") ? ($billing_for_col + $invoice_amt) : ($billing_for_col - $invoice_amt)),
					'billed_amt' => (($event == "update") ? ($billed_amt + $invoice_amt) : ($billed_amt - $invoice_amt)),
					'si_amt' => (((empty($result[0]['fieldName']) ? "NULL" : $result[0]['fieldName']) == 'si_amt') ? (($event == "update") ? ($si_amt + $invoice_amt) : ($si_amt - $invoice_amt)) : $si_amt),
					'miles_amt' => (((empty($result[0]['fieldName']) ? "NULL" : $result[0]['fieldName']) == 'miles_amt') ? (($event == "update") ? ($miles_amt + $invoice_amt) : ($miles_amt - $invoice_amt)) : $miles_amt)
				);
			}else {
				$postInfo = array(
					'billing_collected' => (((empty($result[0]['fieldName']) ? "NULL" : $result[0]['fieldName']) == 'billing_collected') ? ($billing_collected + $invoice_amt) : $billing_collected),
					'billing_for_col' => ((mdate("%Y-%m-%d") > date_format($date,"Y-m-d")) ? $billing_for_col : ($billing_for_col - $invoice_amt)),
					'billing_due' => ((mdate("%Y-%m-%d") > date_format($date,"Y-m-d")) ? ($billing_due - $invoice_amt) : $billing_due)
				);
				// $sql = "select 1 from pay_type where pay_type.pay_type = '{$_POST['pay_type']}' and fieldName = 'billing_collected'";
				// $result = $this->projdb->query($sql)->result_array();
				// if (sizeof($result) > 0)
					// $postInfo['billing_collected'] = ($billing_collected + $invoice_amt);
			}
			
        	$query = $this->projdb->where('job_no', $_POST['job_no']);
        	$query = $this->projdb->update($this->tblName, $postInfo);
			
			return $query;
		}

		public function test(){
		}
		
		public function remove_job(){
        	$query = $this->projdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->projdb->delete($this->tblName);
			return $query;
		}
    }
?>