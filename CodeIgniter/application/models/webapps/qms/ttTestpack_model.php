<?php
    class ttTestpack_Model extends CI_Model {
    	private $tblName = "tttestpack";
        public function __construct(){
            parent::__construct();
        	$this->qms_pip = $this->load->database('qms_pip', true);
        }
		
		public function get_all_dd(){
			$sql = "select t1.area_no,t1.area_desc from {$this->tblName} t1 join (SELECT RTRIM(LTRIM(area_no)) as area_no from {$this->tblName} where RTRIM(LTRIM(area_no)) <> '' group by RTRIM(LTRIM(area_no))) t2 on t1.area_no = t2.area_no";
			return $this->qms_pip->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
        
        public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			if ($_GET['value'] == ""){
				$sql = "SELECT (select count(*) FROM {$this->tblName} where {$where}) as total,* FROM {$this->tblName} where {$where} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				$rowArr = $this->qms_pip->query($sql)->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){					
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->qms_pip->query($sql)->result_array();					
				}else{
					$sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,* FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$rowArr = $this->qms_pip->query($sql)->result_array();
				}
			}
			return $rowArr;
        }

		public function get_count(){
			return $this->qms_pip->count_all($this->tblName);
		}
        
        public function set_spool(){
            $postInfo = array("plant_no"=>mysql_real_escape_string($_POST['plant_no']),"area_no"=>mysql_real_escape_string($_POST['area_no']),
            				  "drawing_no"=>mysql_real_escape_string($_POST['drawing_no']),"rev_no"=>mysql_real_escape_string($_POST['rev_no']),
            				  "sheet_no"=>mysql_real_escape_string($_POST['sheet_no']),"spool_id"=>mysql_real_escape_string($_POST['drawing_no'] . "-" . $_POST['sheet_no'] . "-" . $_POST['spool_no']),
            				  "subarea_no"=>mysql_real_escape_string($_POST['subarea_no']),"loguser"=>mysql_real_escape_string($_POST['loguser']),
            				  "logdate"=>mdate("%Y-%m-%d"),"lbsb"=>mysql_real_escape_string($_POST['lbsb']),
            				  "tot_diainch"=>$_POST['tot_diainch'],"tot_lm"=>$_POST['tot_lm'],
            				  "spool_cont"=>($_POST['spool_cont'] == "true" ? 1 : 0),"spl_type"=>mysql_real_escape_string($_POST['spl_type']),
            				  "testpack_no"=>mysql_real_escape_string($_POST['testpack_no']),"lengg"=>1,
            				  "logupdate"=>$_POST['loguser'] . " " . mdate("%Y-%m-%d"),"spool_no"=>mysql_real_escape_string($_POST['spool_no']));

            if ($_POST['PROGRESS_RECID'] == "0"){
				$query = $this->qms_pip->set($postInfo);
				$query = $this->qms_pip->insert($this->tblName);
			}else{
            	$query = $this->qms_pip->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->qms_pip->update($this->tblName, $postInfo);
			}
			
			return $query;
        }
		
		public function remove_spool(){
        	$query = $this->qms_pip->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->qms_pip->delete($this->tblName);
			return $query;
		}
    }
?>