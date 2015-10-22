<?php
    class Rdivision_Model extends CI_Model {
    	private $tblName = "rdivision";
        public function __construct(){
            parent::__construct();
            $this->gendb = $this->load->database('gendb', true);
        }
        
        public function getAll(){
			$sql = "SELECT * FROM {$this->tblName} order by logtime";
            return $this->gendb->query($sql)->result_array();
        }
		
		public function getByUtilities($filters){
			$sql = "SELECT * FROM $this->tblName where id = ? order by logtime";
			return $this->gendb->query($sql, $filters)->result_array();
		}
        
        public function getBySystem($filters){
			foreach ($filters as $key => $val):
				settype($filters[$key], "string");
			endforeach;
        	$sql = "SELECT * FROM $this->tblName where appl_code = ? AND job_no = ?";
			//return $this->db->query($sql, array($filters[0],$filters[1]))->result_array();
			return $this->gendb->query($sql, $filters)->result_array();
            //return $this->db->get_where("utilities", array("system_code" => $sysCode))->result_array();
        }
        
        public function set_div(){
            $postInfo = array("PROGRESS_RECID"=>$_POST['PROGRESS_RECID'],"div_code"=>mysql_real_escape_string($_POST['div_code']),"div_desc"=>mysql_real_escape_string($_POST['div_desc']));
            if ($_POST['PROGRESS_RECID'] == "0"){
				$query = $this->gendb->set($postInfo);
				$query = $this->gendb->insert($this->tblName);
			}else{
            	$query = $this->gendb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->gendb->update($this->tblName, $postInfo);
			}
			
			return $query;
            /*$retVal = $query->row_array();
            if (empty($retVal))
                array_push($dataArr, $postInfo);
            if (count($dataArr) > 0)
                return true;
			else
				return false;*/
        }
		
		public function remove_div(){
        	$query = $this->gendb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
        	$query = $this->gendb->delete($this->tblName);
			return $query;
		}
	
		public function rpt_div(){
			$sql = " {{$this->tblName}.company_code} = 'ARCC'";
			
			return $sql;
		}
    }
?>