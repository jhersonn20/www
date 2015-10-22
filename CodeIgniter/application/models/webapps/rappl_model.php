<?php
    class RAPPL_Model extends CI_Model {
		private $tblName = "rappl";
        public function __construct(){
            parent::__construct();
            //$this->load->database();
        	$this->gendb = $this->load->database('gendb', true);
        }
        
        public function getAll(){
			$sql = "SELECT * FROM {$this->tblName} order by logtime";
			return $this->gendb->query($sql)->result_array();
        }
		        
        public function get_all_filtered(){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$sql = "SELECT (select count(*) FROM {$this->tblName}) as total,PROGRESS_RECID,appl_code,appl_name,appl_name_short,type,publish FROM {$this->tblName} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
            return $this->gendb->query($sql)->result_array();
        }
		
		public function getBySystem($selSys){
			settype($selSys, "string");
			$sql = "SELECT * FROM $this->tblName WHERE appl_code = ?";
			return $this->gendb->query($sql, $selSys)->result_array();
		}
        
        public function set_system(){
            $postInfo = array("PROGRESS_RECID"=>$_POST['PROGRESS_RECID'],"appl_code"=>mysql_real_escape_string($_POST['appl_code']),"appl_name"=>mysql_real_escape_string($_POST['appl_name']),"appl_name_short"=>mysql_real_escape_string($_POST['appl_name_short']),"type"=>$_POST['type'],"publish"=>$_POST['publish']);
            if ($_POST['PROGRESS_RECID'] == "0"){
				$query = $this->gendb->set($postInfo);
				$query = $this->gendb->insert($this->tblName);
			}else{
            	$query = $this->gendb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->gendb->update($this->tblName, $postInfo);
			}
			
			return $query;
        }
        
        public function set_systemP(){ //$PROGRESS_RECID = ""
			$sql = "SELECT * FROM " . $this->tblName . " WHERE PROGRESS_RECID = ?";
			$query = $this->gendb->query($sql, $_POST['PROGRESS_RECID']);
			if ($query->num_rows() > 0){	
				$row = $query->row();
            	$query = $this->gendb->where('PROGRESS_RECID', $row->PROGRESS_RECID);
        		$query = $this->gendb->update($this->tblName, array("publish"=>($row->publish == 1 ? 0 : 1)));
				return $query;
			}
			return false;
        }
		
		public function set_au(){
			$sql = "INSERT INTO appl_user(user_id, group_code, appl_su, appl_code) select ?, ?, ?, " . $this->tblName . ".appl_code from " . $this->tblName;
			return $query = $this->gendb->query($sql,array($_POST['user_id'],$_POST['group_code'],$_POST['appl_su']));
		}
		
		public function remove_system(){
        	$query = $this->gendb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->gendb->delete($this->tblName);
			return $query;
		}
		
		public function remove_system_by_appl(){
        	$query = $this->gendb->where('appl_code', $_POST['appl_code']);
        	$query = $this->gendb->delete($this->tblName);
			
			return $query;
		}
	
		public function rpt_appl(){
			$sql = " {{$this->tblName}.company_code} = 'ARCC'";
			
			return $sql;
		}
    }
?>