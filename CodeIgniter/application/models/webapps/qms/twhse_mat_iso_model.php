<?php
    class Twhse_mat_iso_Model extends CI_Model {
    	private $tblName = "twhse_mat_iso";
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('qms_pip', true);
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
        public function modified_getAll($where){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$end = ($start + $_GET['pageSize']) - 1;
			if ($where != ""){
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} where {$where}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
				$rowArr = $this->piping->query($sql)->result_array();		
			}else{
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} ) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} ) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
				$rowArr = $this->piping->query($sql)->result_array();
			}
			return $rowArr;
        }
		public function mod_export_iso_twhseMatIso($where = ""){
			
			
			$sql = "SELECT t.plant_no,t.area_no,t.drawing_no,t.sheet_no,t.bore_type,t.matl_type,t.piping_class,t.priority,t.area_loc,LTRIM(RTRIM(t.ref_no)) as ref_no,
				    (CASE WHEN(t.ref_date IS NOT NULL) THEN(CONVERT(varchar,t.ref_date,101)) ELSE('')END) as ref_date,LTRIM(RTRIM(t.tot_spl)) as tot_spl,LTRIM(RTRIM(t.tot_dia)) as tot_dia
					FROM dbo.twhse_mat_iso t
					LEFT JOIN(
									 SELECT t2.drawing_no, t2.spool_no
									 FROM piping.dbo.spool t2
									 INNER JOIN piping.dbo.iso t3
									 ON t2.plant_no = t3.plant_no AND
									   t2.area_no = t3.area_no AND
									   t2.drawing_no = t3.drawing_no AND
									   t2.sheet_no = t3.sheet_no
									  WHERE t2.spool_no <> 'EM'
									)t4
					ON t.drawing_no = t4.drawing_no 
					UNION ALL
					SELECT t.plant_no,t.area_no,t.drawing_no,t.sheet_no,t.lbsb as bore_type,t.matl as matl_type,t.piping_class,CONVERT(varchar,t.priority) as priority,t.area_loc,'' as ref_no,'' as ref_date,'' as tot_spl,'' as tot_dia
					FROM piping.dbo.iso t
					WHERE t.priority_timing in (
													SELECT p_char2 
													FROM piping.dbo.sys_prog
													WHERE prog_code = 'PRIOR_SETUP' AND
														  prog_type = 1
												) AND
						 t.area_loc in (
													SELECT (p_char1+p_char2+p_char3+p_char4) 
													FROM piping.dbo.sys_prog
													WHERE prog_code = 'AREA_LOC' AND
														  prog_type = 1
												)
				   ";
			$rowArr = $this->piping->query($sql)->result_array();
				
			return $rowArr;
        }
		public function get_all_export2($where = ""){
			if ($where != "")
				$where = ("WHERE " . $where);
			
			$sql = "select * FROM {$this->tblName} {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
			$rowArr = $this->piping->query($sql)->result_array();
				
			return $rowArr;
        }
		public function get_all_export($where = ""){
			if ($where != "")
				$where = ("WHERE " . $where);
			
			$sql = "select * FROM {$this->tblName} {$where} order by {$_GET['fieldS']} {$_GET['dir']}";
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
				$postInfo['log_update'] = $postInfo['loguser'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_time'] = mdate("%H:%i:%s");
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
		
		public function get_export_qmsqwpsplw($where = ""){
			if ($where != "")
				$where = ("WHERE " . $where);
			
			$sql = "select TOP 10 * FROM {$this->tblName}";
			$rowArr = $this->piping->query($sql)->result_array();
				
			return $rowArr;
        }
    }
?>