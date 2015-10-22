<?php
    class Piece_struc_Model extends CI_Model {
    	private $tblName = "piece_struc";
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
        }
        
        public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			// if ($_GET['value'] == ""){
				// $sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->piping->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} where {$where}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,PROGRESS_RECID,area_no,drawing_no,sheet_no,rev_no,stat,line_size,line_no,lineclass,matl,fluid_code,insulation,insulation_thickness,lbsb,painting,pid,transmittal,remarks,document,subarea_no,plant_no FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			// }
			return $rowArr;
        }
		public function get_dd_priorNo(){
			$sql = "select prior_no from {$this->tblName} group by prior_no order by prior_no";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
		
		public function get_dd_piecePlantno(){
			$sql = "select plant_no from {$this->tblName} group by plant_no order by plant_no";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
		public function get_dd_pieceAreaNo(){
			$sql = "select area_no from {$this->tblName} group by area_no order by area_no";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}

        public function getAll($criteria = array()){
        	return $this->piping->get_where($this->tblName, $criteria)->result_array();        	
        }
        
        public function get_all_export($where){
			$sql = "select (select count(*) FROM {$this->tblName} where {$where}) as total,* FROM {$this->tblName} where {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
			$rowArr = $this->piping->query($sql)->result_array();
			return $rowArr;
        }
        
        public function set_pieceStruc(){
        				$postInfo = array();
			foreach ($_POST as $key => $value) {
				if ($key == "PROGRESS_RECID")
					continue;
				$postInfo[$key] = mysql_real_escape_string($value);
			}
			$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d");
			$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
            if ($_GET['PROGRESS_RECID'] == "0"){
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}else{
            	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->piping->update($this->tblName, $postInfo);
			}
			
			return $query;
        }
        public function upd_pieceStruc(){
			$postInfo = array();
			foreach ($_POST as $key => $value) {
				if ($key == "PROGRESS_RECID" || $key == "total" || $key == "rownum")
					continue;
				$postInfo[$key] = mysql_real_escape_string($value);
			}
			$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d");
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
        
        public function update($postInfo = array(), $criteria = array()){
        	if (sizeof($postInfo) == 0){
				foreach ($_POST as $key => $value) {
					if ($key == "PROGRESS_RECID" || $key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_time'] = mdate("%H:%i:%s");
				$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				//$postInfo['log_update'] = date_format($_POST['log_user'], 'Y-m-d');
			}

        	$query = $this->piping->where($criteria);
        	$query = $this->piping->update($this->tblName, $postInfo);
			
			return $query;        	
        }
		
		public function call_sp_update_pieceStruct($haul,$chipping,$packer,$assembly,$erection,$alignment,$bolt,$procRecid){
		
			$sql = "declare @result int;";
			$sql .= "exec @result = piping.dbo.update_PieceStruct @haul = '{$haul}',@chipping = '{$chipping}',@packer = '{$packer}',@assembly = '{$assembly}',@erection = '{$erection}',@alignment = '{$alignment}',@bolt = '{$bolt}',@procrecid = {$procRecid};";
			$sql .= "select @result as return_value;";
			$query = $this->piping->query($sql)->result_array();
			
			return $query;
		}
		public function call_update_pieceStruct($haul,$chipping,$packer,$assembly,$erection,$alignment,$bolt){
		
			$sql = "declare @result int;";
			$sql .= "exec @result = piping.dbo.upd_pieceStruc @haul = '{$haul}',@chipping = '{$chipping}',@packer = '{$packer}',@assembly = '{$assembly}',@erection = '{$erection}',@alignment = '{$alignment}',@bolt = '{$bolt}';";
			$sql .= "select @result as return_value;";
			$query = $this->piping->query($sql)->result_array();
			
			return $query;
		}

		public function call_sp($item = ""){
			$sql = "declare @result int = 0;";			
			$sql .= "exec @result = piping.dbo." . $item . "_sp;";
			$sql .= "select @result as return_value;";
			$query = $this->piping->query($sql)->result_array();
			
			return $query;
		}
		
		public function remove_pieceStruc(){
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
    }
?>