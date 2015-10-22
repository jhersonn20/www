<?php
    class RGROUP_Model extends CI_Model {
		private $tblName = "rgroup";
        public function __construct(){
            parent::__construct();
            //$this->load->database();
            $this->load->helper('file');
        	$this->gendb = $this->load->database('gendb', true);
        }
        
        public function getAll(){
			$sql = "SELECT * FROM {$this->tblName} order by logtime";
			return $this->gendb->query($sql)->result_array();
        }
		
		public function getByAppl($selSys = ""){
			settype($selSys, "string");
			$sql = "SELECT * FROM $this->tblName WHERE appl_code = ? order by logtime";
			return $this->gendb->query($sql, $selSys)->result_array();
		}
		
		public function get_all_filtered_by_appl(){ //$selSys = ""
			$start = ($_GET['page'] - 1) * $_GET['pageSize'];
			//settype($selSys, "string");
			$sql = "SELECT (select count(*) FROM {$this->tblName} WHERE appl_code = '{$_GET['value']}') as total,PROGRESS_RECID,group_code,group_desc,div_code,page_init,page_init_desc FROM {$this->tblName} WHERE appl_code = ? order by {$_GET['fieldS']} {$_GET['dir']} LIMIT {$start},{$_GET['pageSize']}";
			return $this->gendb->query($sql, $_GET['value'])->result_array();
		}
        
        public function set_group(){
	        // Load First_model
	        $ci =& get_instance();
            $ci->load->model('webapps/rmenu_model');
            $ci->load->model('webapps/group_menu_model');
			
            if ($_POST['PROGRESS_RECID'] == "0"){
            	$postInfo = array("PROGRESS_RECID"=>$_POST['PROGRESS_RECID'],"group_code"=>mysql_real_escape_string($_POST['group_code']),"group_desc"=>mysql_real_escape_string($_POST['group_desc']),"div_code"=>$_POST['div_code'],"appl_code"=>$_POST['appl_code'],"page_init"=>trim($_POST['page_init_desc']) == "" ? "" : $_POST['page_init'],"page_init_desc"=>$_POST['page_init_desc']);
				$query = $this->gendb->set($postInfo);
				$query = $this->gendb->insert($this->tblName);				
				
				//return $ci->rmenu_model->getBySystem($_POST['appl_code']);
		        foreach($ci->rmenu_model->getBySystem($_POST['appl_code']) as $newDtls):
		            $data = array(
		                            "appl_code" => $newDtls['appl_code'],
		                            "menucode" => $newDtls['menucode'],
		                            "subcode" => $newDtls['subcode'],
		                            "progname" => $newDtls['progname'],
		                            "description" => $newDtls['description'],
		                            "mtitle" => $newDtls['mtitle'],
		                            "page_init" => $newDtls['page_init'],
		                            "publish" => $newDtls['publish'],
		                            "just_label" => $newDtls['just_label'],
		                            "PROGRESS_RECID" => $newDtls['PROGRESS_RECID'],
		                            "group_code" => $_POST['group_code'],
		                            "page_init" => trim($_POST['page_init_desc']) == "" ? "" : $_POST['page_init'],
		                            "page_init_desc"=>$_POST['page_init_desc']
		                         );
				
	            	$ci->group_menu_model->setMenu($data,(($_POST['PROGRESS_RECID'] == "0") ? "add" : "edit"));
				endforeach;
			}else{
            	$postInfo = array("PROGRESS_RECID"=>$_POST['PROGRESS_RECID'],"group_desc"=>mysql_real_escape_string($_POST['group_desc']),"div_code"=>$_POST['div_code'],"appl_code"=>$_POST['appl_code'],"page_init"=>trim($_POST['page_init_desc']) == "" ? "" : $_POST['page_init'],"page_init_desc"=>$_POST['page_init_desc']);
            	$query = $this->gendb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
            	$query = $this->gendb->update($this->tblName, $postInfo);
			}
			
			return $query;
        }
	
		public function set_group_page(){
        	$query = $this->gendb->where(array('appl_code' => $_POST['appl_code'], 'group_code' => $_POST['group_code']));
        	$query = $this->gendb->update($this->tblName, array("page_init" => $_POST['page_init'], "page_init_desc" => $_POST['page_init_desc']));
        	
			return $query;
		}
		
		public function verify_group_page(){
			$sql = "update gendb.rgroup t inner join gendb.group_menu t2
					on t.appl_code = t2.appl_code and t.group_code = t2.group_code and t.page_init = t2.progname
					set t.page_init = if(t2.selected = 1, t.page_init, ''),
						t.page_init_desc = if(t2.selected = 1, t.page_init_desc, '')
					where t.appl_code = ? and t.group_code = ?;";
					
			return $this->gendb->query($sql, $_POST);
		}
		
		public function remove_group(){
	        $ci =& get_instance();
            $ci->load->model('webapps/group_menu_model');
			
			$sql = "SELECT * FROM " . $this->tblName . " where PROGRESS_RECID = {$_POST['PROGRESS_RECID']}";
			$row = $this->gendb->query($sql);
			if ($row->num_rows() > 0){
				$rows = $row->row();
				
		        $ci->group_menu_model->remove_gmenu2($rows->appl_code,$rows->group_code);
				
	        	$query = $this->gendb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
	        	$query = $this->gendb->delete($this->tblName);
			}
			
			return $query;
		}
		
		public function remove_group_by_appl(){				
        	$query = $this->gendb->where('appl_code', $_POST['appl_code']);
        	$query = $this->gendb->delete($this->tblName);
			
			return $query;
		}
	
		public function rpt_group(){
			$sql = " {{$this->tblName}.company_code} = 'ARCC' AND
					 {{$this->tblName}.appl_code} = '" . $_POST['appl_code'] . "'";
			
			return $sql;
		}
    }
?>