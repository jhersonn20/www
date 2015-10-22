<?php
    class Pay_type_Model extends CI_Model {
		private $tblName = "pay_type";
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
				$query = $this->projdb->select("(select count(*) FROM {$this->tblName}) as total,PROGRESS_RECID,pay_type, pay_desc, fieldName, flg_status")->from($this->tblName)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
				$query = $this->projdb->get();
				$rowArr = $query->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$query = $this->projdb->select('count(*) as total')->from($this->tblName)->where($where); //->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
					$query = $this->projdb->get();
					$total = $query->result();
					$total = $total[0]->total;
					
					$query = $this->projdb->select('PROGRESS_RECID,pay_type, pay_desc, flg_status')->from($this->tblName)->where($where)->order_by($_GET['fieldS'],$_GET['dir'])->limit($_GET['pageSize'],$start);
					$query = $this->projdb->get();
					$rowArr = $query->result_array();
					$rowArr[0]['total'] = $total;
				}else{
					$sql = "SELECT (select count(*) FROM {$this->tblName} where {$_GET['value']}) as total,PROGRESS_RECID,pay_type, pay_desc, flg_status FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$rowArr = $this->projdb->query($sql)->result_array();
				}
			}
			return $rowArr;
        }

        public function get_all_for_dd(){
        	$this->projdb->where('flg_status', 1);
        	return $this->projdb->get($this->tblName)->result_array();
		}
		
		public function get_by_payType(){
        	$this->projdb->where('pay_type', $_GET['pay_type']);
        	return $this->projdb->get($this->tblName)->result_array();			
		}
        
        public function set(){		
			$postInfo = array();
			foreach ($_POST as $key => $value) {
				if ($key == "PROGRESS_RECID" || $key == "err_remarks" || $key == "idField" || $key == "_defaultId" || $key == "isLast" || $key == "errCounter")
					continue;
				$postInfo[$key] = $value;
			}
			$postInfo['logupdate'] = $_POST['loguser'] . " " . mdate("%H:%i:%s");
			$postInfo['logdate'] = mdate("%H:%i:%s");
				
            if ($_POST['PROGRESS_RECID'] > 0){
            	$query = $this->projdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->projdb->update($this->tblName, $postInfo);
			}else{
				$postInfo['flg_status'] = 1;
				$query = $this->projdb->set($postInfo);
				$query = $this->projdb->insert($this->tblName);
			}
			
			return $query;
        }
		
		public function remove(){
        	$query = $this->projdb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->projdb->delete($this->tblName);
			return $query;
		}
    }
?>