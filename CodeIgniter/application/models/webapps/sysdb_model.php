<?php
    class Sysdb_Model extends CI_Model {
		private $tblName = "sysdb";
        public function __construct(){
            parent::__construct();
            //$this->load->database();
        	$this->gendb = $this->load->database('gendb', true);
        }
        
        public function getAll(){
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			$sql = "SELECT (select count(*) FROM {$this->tblName}) as total,PROGRESS_RECID,sys_name,sys_dbname,sys_param,on_line FROM {$this->tblName} order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
            return $this->gendb->query($sql)->result_array();
        }
		
		public function getBySystem($selSys){
			settype($selSys, "string");
			$sql = "SELECT * FROM $this->tblName WHERE appl_code = ?";
			return $this->gendb->query($sql, $selSys)->result_array();
		}
        
        public function set_param(){
            $postInfo = array("PROGRESS_RECID"=>$_POST['PROGRESS_RECID'],"sys_name"=>mysql_real_escape_string($_POST['sys_name']),"sys_dbname"=>mysql_real_escape_string($_POST['sys_dbname']),"sys_param"=>mysql_real_escape_string($_POST['sys_param']),"on_line"=>mysql_real_escape_string($_POST['on_line']));
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
		
		public function remove_param(){
        	$query = $this->gendb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->gendb->delete($this->tblName);
			return $query;
		}
	
		public function rpt_param(){
			$sql = " {{$this->tblName}.company_code} = 'ARCC'";
			
			return $sql;
		}
    }
?>