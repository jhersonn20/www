<?php
    class Spool_Model extends CI_Model {
    	private $tblName = "spool";
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
        }
        
        
		public function get_all_spootiso($spoolWhere = ''){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			
			$sql = "select TOP 100 *
					from piping.dbo.spool t
					inner join piping.dbo.iso t2
					on t.area_no = t2.area_no and
					   t.drawing_no = t2.drawing_no and
					   t.sheet_no = t.sheet_no";
					
		return $this->piping->query($sql)->result_array();
		}
         public function get_all($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;

			// if ($_GET['value'] == ""){
				// $sql = "SELECT (select count(*) FROM {$this->tblName} where {$where}) as total,* FROM {$this->tblName} where {$where} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->piping->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} where {$where}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,* FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			// }
			return $rowArr;
        }
        public function get_all_from_query($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;

			// if ($_GET['value'] == ""){
				// $sql = "SELECT (select count(*) FROM {$this->tblName} where {$where}) as total,* FROM {$this->tblName} where {$where} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->piping->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) from {$where}  ) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$where}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM ogmr where {$_GET['value']}) as total,* FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			// }
			return $rowArr;
        }
        
        public function get_all_export($where = ""){
			if ($where != "")
				$where = ("WHERE " . $where);
			
			$sql = "select top 100 plant_no,area_no,drawing_no,sheet_no,rev_no,lbsb,piping_class FROM {$this->tblName} {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
			
			$rowArr = $this->piping->query($sql)->result_array();
			return $rowArr;
        }
         public function get_all_export2($where = ""){
			if ($where != "")
				$where = ("WHERE " . $where);
			
			$sql = "select  t2.plant_no,t2.area_no,t2.drawing_no,t2.sheet_no,t2.rev_no,t.spool_no,t.lbsb,t.mat_type,t2.piping_class,t2.area_loc,t2.priority_code,t2.priority_timing
					from dbo.spool t
					inner join dbo.iso t2
					on   t2.plant_no = t.plant_no and
						 t2.area_no = t.area_no and
						 t2.drawing_no = t.drawing_no and
						 t2.sheet_no = t.sheet_no and
						 t2.rev_no = t.rev_no
					WHERE t.spool_no <> 'EM' ";
			$rowArr = $this->piping->query($sql)->result_array();
			return $rowArr;
        }
        
        
        public function getAll($criteria){
        	if (isset($criteria)){
	        	if (is_array($criteria))
	        		return $this->piping->get_where($this->tblName, $criteria)->result_array();
	        	else {
		        	$sql = "select * from {$this->tblName} where {$criteria}";
		        	return $this->piping->query($sql)->result_array();
		        }
		    }
        }

		public function get_all_spool($where){
			$sql = "SELECT spool_no FROM {$this->tblName} where {$where}";
			return $this->piping->query($sql)->result_array();
		}
		
		public function set_spool_by_dtl($postInfo = array()){
        	$query = $this->piping->where(array('area_no' => $postInfo['area_no'],'drawing_no' => $postInfo['drawing_no'],'sheet_no' => $postInfo['sheet_no'],'rev_no' => $postInfo['rev_no']));
        	$query = $this->piping->update($this->tblName, $postInfo);
        	return $query;
		}
        
        public function set_spool($postInfo = array()){
        	$PROGRESS_RECID = 0;
			if (sizeof($postInfo) > 0){
				$PROGRESS_RECID = $postInfo['PROGRESS_RECID'];
				unset($postInfo['PROGRESS_RECID']);
			}else {
				foreach ($_POST as $key => $value) {
					if ($key == "PROGRESS_RECID")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				$postInfo['spool_id'] = $postInfo['drawing_no'] . "-" . $postInfo['sheet_no'] . "-" . $postInfo['spool_no'];
				$postInfo['spool_cont'] = ($postInfo['spool_cont'] == "true" ? 1 : 0);
				$postInfo['lengg'] = 1;
				$postInfo['logupdate'] = $postInfo['loguser'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['logdate'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['logtime'] = mdate("%H:%i:%s");
				$PROGRESS_RECID = $_POST['PROGRESS_RECID'];
			} 
            // $postInfo = array("plant_no"=>mysql_real_escape_string($_POST['plant_no']),"area_no"=>mysql_real_escape_string($_POST['area_no']),
            				  // "drawing_no"=>mysql_real_escape_string($_POST['drawing_no']),"rev_no"=>mysql_real_escape_string($_POST['rev_no']),
            				  // "sheet_no"=>mysql_real_escape_string($_POST['sheet_no']),"spool_id"=>mysql_real_escape_string($_POST['drawing_no'] . "-" . $_POST['sheet_no'] . "-" . $_POST['spool_no']),
            				  // "subarea_no"=>mysql_real_escape_string($_POST['subarea_no']),"loguser"=>mysql_real_escape_string($_POST['loguser']),
            				  // "logdate"=>mdate("%Y-%m-%d"),"lbsb"=>mysql_real_escape_string($_POST['lbsb']),
            				  // "tot_diainch"=>$_POST['tot_diainch'],"tot_lm"=>$_POST['tot_lm'],
            				  // "spool_cont"=>($_POST['spool_cont'] == "true" ? 1 : 0),"spl_type"=>mysql_real_escape_string($_POST['spl_type']),
            				  // "testpack_no"=>mysql_real_escape_string($_POST['testpack_no']),"lengg"=>1,
            				  // "logupdate"=>$_POST['loguser'] . " " . mdate("%Y-%m-%d"),"spool_no"=>mysql_real_escape_string($_POST['spool_no']));

            if ((int)$PROGRESS_RECID == 0){
				$this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}else {
            	$this->piping->where('PROGRESS_RECID', $PROGRESS_RECID);
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
			}

        	$query = $this->piping->where($criteria);
        	$query = $this->piping->update($this->tblName, $postInfo);
			
			return $query;        	
        }
        
		
	    public function is_entry_unique($criteria = '') {
            $this->piping->select('count(*) as counter')->from($this->tblName)->where($criteria);
			$query = $this->piping->get();
			$result = $query->result();

	        if ($result !== FALSE) {
	            if ($result[0]->counter > 0) {
	                return FALSE;
	            } else {
	                return TRUE;
	            }
	        } else {
	            return 'Error in retrieving criteria.';
	        }
	    }
		
		public function remove_spool($postInfo = array()){
			if (sizeof($postInfo) == 0){
				foreach ($_POST as $key => $value) {
					if ($key == "index" || $key == "remarks1" || $key == "idField" || $key == "_defaultId" || $key == "total" || $key == "rownum" || $key == "module")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
				}
				$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_time'] = mdate("%H:%i:%s");
				$postInfo['log_update'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				// $postInfo['PROGRESS_RECID'] = $_POST['PROGRESS_RECID'];
			}
			
        	$query = $this->piping->where('PROGRESS_RECID', $postInfo['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
    }
?>