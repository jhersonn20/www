<?php
    class Joints_Model extends CI_Model {
    	private $tblName = "joints";
        public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
        }
        
        public function get_all($where = ""){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			// $end = ($start + $_GET['pageSize']) - 1;
			// if ($_GET['value'] == ""){
				// $sql = "SELECT (select count(*) FROM {$this->tblName} where {$where}) as total,* FROM {$this->tblName} where {$where} order by {$_GET['fieldS']} {$_GET['dir']}"; // and {$end}
				// $rowArr = $this->piping->query($sql)->result_array();
			// }else {
				// if (isset($_GET['fieldF']) && $_GET['fieldF'] != ""){
					$sql = "SELECT top {$_GET['pageSize']} * FROM (select (select count(*) FROM {$this->tblName} where {$where}) as total,*,row_number() over (order by {$_GET['fieldS']} {$_GET['dir']}) as rownum FROM {$this->tblName} where {$where}) t where {$where} AND rownum > {$start} order by {$_GET['fieldS']} {$_GET['dir']}";
					$rowArr = $this->piping->query($sql)->result_array();					
				// }else{
					// $sql = "SELECT (select count(*) FROM {$this->tblName} where {$_GET['value']}) as total,* FROM {$this->tblName} where {$_GET['value']} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
					// $rowArr = $this->piping->query($sql)->result_array();
				// }
			// }
			return $rowArr;
        }
        public function get_all_export2($where = ""){
			if ($where != "")
				$where = ("WHERE " . $where);
			
			$sql = "select t2.plant_no,t2.area_no,t2.drawing_no,t2.sheet_no,t2.rev_no, t.spool_no,t.joint_no,t.joint_type,t.mat_type,t.diainch,t.lbsb,t2.priority_code,t2.priority_timing,t2.area_loc
					from dbo.joints t
					inner join dbo.iso t2
	                on  t2.plant_no = t.plant_no and 
				        t2.area_no = t.area_no and 
				        t2.drawing_no = t.drawing_no and 
				        t2.sheet_no = t.sheet_no and 
				        t2.rev_no = t.rev_no";
			$rowArr = $this->piping->query($sql)->result_array();
			return $rowArr;
        }
        public function set_joints(){
            $postInfo = array("plant_no"=>mysql_real_escape_string($_POST['plant_no']),"area_no"=>mysql_real_escape_string($_POST['area_no']),
                 			  "drawing_no"=>mysql_real_escape_string($_POST['drawing_no']),"sheet_no"=>mysql_real_escape_string($_POST['sheet_no']),
                 			  "rev_no"=>mysql_real_escape_string($_POST['rev_no']),"spool_no"=>mysql_real_escape_string($_POST['spool_no']),
                 			  "joint_no"=>mysql_real_escape_string($_POST['joint_no']),"weld_loc"=>$_POST['weld_loc'],
                 			  "loguser"=>mysql_real_escape_string($_POST['loguser']),"logdate"=>mdate("%Y-%m-%d"),
                 			  "joint_type"=>mysql_real_escape_string($_POST['joint_type']),"diainch"=>$_POST['diainch'],
                 			  "size"=>$_POST['size'],"location"=>mysql_real_escape_string($_POST['location']),
                 			  "logupdate"=>mysql_real_escape_string($_POST['loguser'] . " " . mdate("%Y-%m-%d")));
            if ($_POST['PROGRESS_RECID'] == "0"){
				$query = $this->piping->set($postInfo);
				$query = $this->piping->insert($this->tblName);
			}else{
            	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->piping->update($this->tblName, $postInfo);
			}
			
			return $query;
        }
		
		public function remove_joints(){
        	$query = $this->piping->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->piping->delete($this->tblName);
			return $query;
		}
    }
?>