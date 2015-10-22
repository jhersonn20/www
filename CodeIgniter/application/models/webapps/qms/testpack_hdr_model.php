<?php
    class Testpack_hdr_Model extends CI_Model {
    	private $tblName = "testpack_hdr";
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
		public function get_all2($where){
				$start = ($_GET['page'] - 1) * $_GET['pageSize'];
				$end = ($start + $_GET['pageSize']) - 1;
				
				$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName}) t where rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
				$rowArr = $this->piping->query($sql)->result_array();
			
			return $rowArr;
        }
		public function get_all_dd2(){
			$sql = "select t1.testpack_no,t1.sub_system from {$this->tblName} t1 join (SELECT RTRIM(LTRIM(testpack_no)) as testpack_no from {$this->tblName} where RTRIM(LTRIM(testpack_no)) <> '' group by RTRIM(LTRIM(testpack_no))) t2 on t1.testpack_no = t2.testpack_no";
			return $this->piping->query($sql)->result_array(); //get($this->tblName)->result_array();
		}
		
		public function verify_hydro(){
			$sql = "SELECT count(*) as counter from {$this->tblName} where testpack_no = '" . mysql_real_escape_string($_POST['testpack_no']) . "' AND hydrotest_date is not NULL";
			$query = $this->piping->query($sql);
			$counter = $query->result();
			return $counter[0]->counter;
		}
        
        public function set_tp(){
			$postInfo = array();
			foreach ($_POST as $key => $value) {
				if ($key == "PROGRESS_RECID")
					continue;
				$postInfo[$key] = mysql_real_escape_string($value);
			}
			$postInfo['log_update'] = $postInfo['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
			$postInfo['logdate'] = mdate("%Y-%m-%d %H:%i:%s");
			$postInfo['logtime'] = mdate("%H:%i:%s");
			
			if (intval($postInfo['errCounter']) == 0 && intval($postInfo['isLast']) == 0){
				$sql = "DELETE from {$this->tblName}";
				$query = $this->piping->query($sql);
			}
			
			$sql = "Merge {$this->tblName} As target
					Using (VALUES('{$postInfo['testpack_no']}')) as src (testpack_no)
					On (target.testpack_no = src.testpack_no)
					When Matched Then
						Update Set system_no = '{$postInfo['system_no']}', sub_system = '{$postInfo['sub_system']}', tp_type = '{$postInfo['tp_type']}', 
								   test_pressure = '{$postInfo['test_pressure']}', serv_line = '{$postInfo['serv_line']}', pid = '{$postInfo['pid']}', 
								   remarks = '{$postInfo['remarks']}', scope = '{$postInfo['scope']}', logdate = '{$postInfo['logdate']}', logtime = '{$postInfo['logtime']}'
					When Not Matched Then
						Insert
							(testpack_no, system_no, sub_system, tp_type, test_pressure, serv_line, pid, remarks, scope, logdate, logtime) 
						values
							('{$postInfo['testpack_no']}','{$postInfo['system_no']}','{$postInfo['sub_system']}','{$postInfo['tp_type']}','{$postInfo['test_pressure']}',
							 '{$postInfo['serv_line']}','{$postInfo['pid']}','{$postInfo['remarks']}','{$postInfo['scope']}','{$postInfo['logdate']}','{$postInfo['logtime']}');";
			$query = $this->piping->query($sql);
					
			if (intval($postInfo['errCounter']) == 0){
		        $ci =& get_instance();
	            $ci->load->model('webapps/qms/spool_model');
				
				$query = $ci->spool_model->set_spool_by_dtl(array('PROGRESS_RECID' => 0, 'area_no' => $postInfo['area_no'],'drawing_no' => $postInfo['drawing_no'],'sheet_no' => $postInfo['sheet_no'],'rev_no' => $postInfo['rev_no'], 'system_no' => $postInfo['system_no'], 'sub_system' => $postInfo['sub_system'], 'testpack_no' => $postInfo['testpack_no']));
			}else {
				if ($postInfo['isLast'] == "true"){
					$sql = "insert into system(system_no, system_desc) SELECT distinct t.system_no,t.system_no FROM (SELECT DISTINCT system_no from {$this->tblName} where CONVERT(VARCHAR(10),logdate,111) = CONVERT(VARCHAR(10),GETDATE(),111)) as t where t.system_no not in (select system_no from system)";
					$query = $this->piping->query($sql);
				}
			}
			
        	// $query = $ci->spool_model->where(array('area_no' => $postInfo['area_no'],'drawing_no' => $postInfo['drawing_no'],'sheet_no' => $postInfo['sheet_no'],'rev_no' => $postInfo['rev_no']));
        	// $query = $ci->spool_model->update($this->tblName, $postInfo);
			// $sql = "update spool set system_no = t.system_no, sub_system = t.sub_system, testpack_no = t.testpack_no where CONVERT(VARCHAR(10),logdate,111) = CONVERT(VARCHAR(10),GETDATE(),111)) as t where t.system_no not in (select system_no from system)";
            // if ($_POST['PROGRESS_RECID'] == "0"){
				// $query = $this->piping->set($postInfo);
				// $query = $this->piping->insert($this->tblName);
			// }else{
            	// $query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	// $query = $this->piping->update($this->tblName, $postInfo);
			// }
			
			return $query;
        }
		
		public function remove_iso(){
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
    }
?>