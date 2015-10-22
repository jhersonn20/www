<?php
    class Inst_takeoff_Model extends CI_Model {
    	private $tblName = "inst_takeoff";
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
        }
        
        public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			if ($_GET['value'] == ""){
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				$rowArr = $this->piping->query($sql)->result_array();
			}else {
				if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){					
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				}else{
					$sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					$rowArr = $this->piping->query($sql)->result_array();
				}
			}
			return $rowArr;
        }
        
        public function get_all_export($where = ""){
			if ($where != "")
				$where = ("WHERE " . $where);
			
			$sql = "select * FROM {$this->tblName} {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
			$rowArr = $this->piping->query($sql)->result_array();
				
			return $rowArr;
        }
        
        public function set_ins(){			$postInfo = array();
			foreach ($_POST as $key => $value) {
				if ($key == "PROGRESS_RECID")
					continue;
				$postInfo[$key] = mysql_real_escape_string($value);
			}
			$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
			$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
            if ($_POST['PROGRESS_RECID'] == "0"){
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}else{
            	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->piping->update($this->tblName, $postInfo);
			}
			
			return $query;
        }
		public function call_upl_inst($file){
			
			$sql = "declare @result int = 0;";			
			$sql .= "exec @result = piping.dbo.upl_instakeoff @ip_filename =" ."'" .str_replace(".csv", "", $file). "'". ";";
			$sql .= "select @result as return_value;";
			return $this->piping->query($sql)->result_array();
		}
		public function remove_ins(){
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
    }
?>