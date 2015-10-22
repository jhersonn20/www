<?php
    class RClient_model extends CI_Model {
		private $tblName = "rclient";
    			
        public function __construct(){
            //$this->load->database();
        	$this->portal = $this->load->database('portal', true);
        }
        
        public function get_all($postParam){
			$postInfo = $postParam;
			if (is_array($postParam))
				$postInfo = $postParam;
        	if (sizeof($_GET) > 0 || is_array($postInfo)){
        		if (!is_array($postInfo))
					$postInfo = array();
	        	if (sizeof($postInfo) == 0){
					unset($_GET['fieldF']);
					if ($postParam != "")
						$postInfo['where'] = "where " . $postParam;
					foreach ($_GET as $key => $value) {
						$postInfo[$key] = mysql_real_escape_string($value);
						if (is_string($value))
							$postInfo[$key] = stripslashes($value);
					}        		
	        	}
				$start = ($postInfo['page'] - 1) * $postInfo['pageSize'];
				if (isset($postInfo['where']))
	            	$sql = "SELECT *,(SELECT count(*) from {$this->tblName}) as total FROM {$this->tblName} {$postInfo['where']} order by {$postInfo['fieldS']} {$postInfo['dir']} limit {$start},{$postInfo['pageSize']}";
				else 
	            	$sql = "SELECT *,(SELECT count(*) from {$this->tblName}) as total FROM {$this->tblName} order by {$postInfo['fieldS']} {$postInfo['dir']} limit {$start},{$postInfo['pageSize']}"; 
			}else {
				if ($postParam != "")
	            	$sql = "SELECT * FROM {$this->tblName} WHERE {$postParam}";
				else
	            	$sql = "SELECT * FROM {$this->tblName} WHERE 1";
			}
            return $this->portal->query($sql)->result_array();
        }

		public function get_by_id($id){
	    	$sql = "SELECT * FROM {$this->tblName} WHERE id = {$id} limit 1";
            return $this->portal->query($sql)->result_array();			
		}
        
        public function set($postInfo = array()){
        	$id = 0;
        	if (sizeof($postInfo) == 0){
				foreach ($_POST as $key => $value) {
					if ($key == "id" || $key == "index" || $key == "idField" || $key == "_defaultId" || $key == "total" || $key == "rownum")
						continue;
					$postInfo[$key] = mysql_real_escape_string($value);
					if (is_string($value))
						$postInfo[$key] = stripslashes($value);
				}
				$postInfo['log_date'] = mdate("%Y-%m-%d %H:%i:%s");
				$postInfo['log_time'] = mdate("%H:%i:%s");
				$postInfo['log_created'] = $_POST['log_user'] . " " . mdate("%Y-%m-%d %H:%i:%s");
				$id = $_POST['id'];
			}else
				$id = $postInfo['id'];
			
			$ci =& get_instance();
		    $ci->load->model("portal/audit_model");
            if ($id > 0){
            	$this->portal->where('id', $id);
            	$query = $this->portal->update($this->tblName, $postInfo);
				if (!$query)
					return 'Update failed!';
				
				$ci->audit_model->set(array("tran_type"=>"Client Update","user_id"=>$this->session->userdata('id'),"remarks"=>"Updated client profile for " . $id));
				// $query = $this->auditTrail("MATERIAL REQUEST-PIPING (DTL)","EDIT");
			}else{				
            	$query = $this->is_entry_unique(array("short_desc"=>$postInfo['short_desc'],"name"=>$postInfo['name']));
            	if (gettype($query) == 'boolean'){
					if (!$query)
						return "Record already exist!";
				}else
					return $query;
 				
				unset($postInfo['id']);
				$query = $this->portal->set($postInfo);
				$query = $this->portal->insert($this->tblName);
				if (!$query)
					return 'Insert failed!';
				else
					$id = $this->portal->insert_id();
				$ci->audit_model->set(array("tran_type"=>"Client Update","user_id"=>$this->session->userdata('id'),"remarks"=>"Created client profile for " . $postInfo['name'] . " with ID: " . $this->portal->insert_id()));
			}
			$path = "D:/portal/documents/" . $id;
		    if(!is_dir($path))
		    	mkdir($path,0777,TRUE);
			
			return $query;
        }
		
	    public function is_entry_unique($criteria = '') {
            $this->portal->select('count(*) as counter')->from($this->tblName)->where($criteria);
			$query = $this->portal->get();
			$result = $query->result();

	        if ($result !== FALSE) {
	            if ($result[0]->counter > 0) {
	                return FALSE;
	            } else{
	                return TRUE;
	            }
	        } else {
	            return 'Error in retrieving criteria.';
	        }
	    }

		// public function auditTrail($tranDesc = "", $type = ""){        	
			// $sql = "declare @result int = 0;";
			// $sql .= "exec @result = qms_atrail.dbo.auditTrail_sp @syscode = 'QMS', @userid = '{$_POST['log_user']}', @trandesc = '{$tranDesc}', @type = '{$type}';";			
			// $sql .= "select @result as return_value;";
			// $query = $this->qms_atrail->query($sql)->result_array();
// 			
			// return $query[0]['return_value'];			
		// }
		
		/*public function getByProject($filters){
			foreach ($filters as $key => $val):
				settype($filters[$key], "string");
			endforeach;
			$sql = "SELECT * FROM menu WHERE system_code = ? AND project_code = ?";
			return $this->db->query($sql, $filters)->result_array();
		}*/
		
		public function getBySystem($filters){
			settype($filters, "string");
			$sql = "SELECT * FROM rmenu WHERE appl_code = ? order by menucode,subcode";
			return $this->gendb->query($sql, $filters)->result_array();
		}
        
        public function get_menu($filters){
			foreach ($filters as $key => $val):
				settype($filters[$key], "string");
			endforeach;
            //$this->db->order_by('menu_code','asc');
            //$query = $this->db->get_where('menu', array('publish' => 1, 'system_code' => $sysCode));
            //$sql = "SELECT * FROM rmenu WHERE publish = ? AND system_code = ? AND project_code = ?"; 
            $sql = "SELECT * FROM rmenu WHERE publish = ? AND appl_code = ?";
            //return $query->result_array();
            return $this->gendb->query($sql, $filters)->result_array();            
        }
        
        public function get_menu2(){
            $this->db->order_by('menu_code','asc');
            $query = $this->db->get_where('nav', array('publish' => 1));
            return $query->result_array();            
        }
        
        /*public function set_nav(){
            $data = $_POST['jsonData'];
            $json = str_replace('\\','',$data);
            $newdata = json_decode($json);
            $dataArr = array();
            $this->db->delete('menu', array("system_code" => $newdata->item[0]->system_code, "project_code" => $newdata->item[0]->project_code));
            foreach($newdata->item as $newDtls):
                $data = array(
                                "system_code" => $newDtls->system_code,
                                "project_code" => $newDtls->project_code,
                                "menu_code" => $newDtls->menu_code,
                                "submenu_code" => $newDtls->submenu_code,
                                "label" => $newDtls->label,
                                "path" => $newDtls->path,
                                "publish" => $newDtls->publish,
                                "just_label" => $newDtls->just_label
                             );
                $query = $this->db->get_where('menu', array('menu_code' => $newDtls->menu_code, 'submenu_code' => $newDtls->submenu_code, 'label' => $newDtls->label));
                $retVal = $query->row_array();
                if (empty($retVal))
                    array_push($dataArr, $data);
                    $this->db->insert("menu", $data);
            endforeach;
            if (count($dataArr) > 0)
                //return $this->db->insert("menu", $dataArr);
                return true;
        }*/
        
        public function set_nav(){
	        // Load First_model
	        $ci =& get_instance();
            $ci->load->model('webapps/group_menu_model');
			
            $data = $_POST['jsonData'];
            $json = str_replace('\\','',$data);
            $newdata = json_decode($json);
            $dataArr = array();
            //$this->db->delete('rmenu', array("system_code" => $newdata->item[0]->system_code, "project_code" => $newdata->item[0]->project_code));
            //$this->gendb->delete('rmenu', array("appl_code" => $newdata->item[0]->appl_code));
            foreach($newdata->item as $newDtls):
                $data = array(
                                "appl_code" => $newDtls->appl_code,
                                //"project_code" => $newDtls->project_code,
                                "menucode" => $newDtls->menucode,
                                "subcode" => $newDtls->subcode,
                                "description" => mysql_real_escape_string($newDtls->description),
                                "mtitle" => mysql_real_escape_string($newDtls->mtitle),
                                //"app_name" => $newDtls->app_name,
                                "progname" => mysql_real_escape_string($newDtls->progname),
                                "publish" => $newDtls->publish,
                                "just_label" => $newDtls->just_label,
                                "PROGRESS_RECID" => $newDtls->PROGRESS_RECID
                             );
                //$query = $this->gendb->get_where('rmenu', array('menucode' => $newDtls->menucode, 'subcode' => $newDtls->subcode, 'description' => $newDtls->description));
                //$retVal = $query->row_array();
                //if (empty($retVal))
                //    array_push($dataArr, $data);
                //$this->gendb->insert("rmenu", $data);
                $sql = "INSERT INTO " . $this->tblName . " (appl_code,menucode,subcode,description,mtitle,progname,publish,just_label,PROGRESS_RECID)" .
                	   "VALUE('{$data['appl_code']}','{$data['menucode']}','{$data['subcode']}','{$data['description']}','{$data['mtitle']}','{$data['progname']}',{$data['publish']},{$data['just_label']},{$data['PROGRESS_RECID']})" . 
                	   "on duplicate key update menucode=?,subcode=?,description=?,mtitle=?,progname=?,publish=?,just_label=?";
                //$query = $this->gendb->query($sql,array("menucode" => $newDtls->menucode,"subcode" => $newDtls->subcode,"description" => $newDtls->description,"mtitle" => $newDtls->mtitle,"progname" => $newDtls->progname,"publish" => $newDtls->publish,"just_label" => $newDtls->just_label));
                $query = $this->gendb->query($sql,array($newDtls->menucode,$newDtls->subcode,$newDtls->description,$newDtls->mtitle,$newDtls->progname,$newDtls->publish,$newDtls->just_label));
				if ($newDtls->PROGRESS_RECID == "0")
	                $data['PROGRESS_RECID'] = $this->gendb->insert_id();
				
	            //$ci->group_menu_model->setMenu($data,"add");
	            $ci->group_menu_model->setMenu($data,(($newDtls->PROGRESS_RECID == "0") ? "add" : "edit"));
            endforeach;
            //if (count($dataArr) > 0)
                //return $this->db->insert("menu", $dataArr);
            return true;
        }
        
        public function set_nav2(){
            $this->db->empty_table('nav');
            $data = $_POST['jsonData'];
            $json = str_replace('\\','',$data);
            $newdata = json_decode($json);
            $dataArr = array();
            foreach($newdata->item as $newDtls):
                $data = array(
                                "menu_code" => $newDtls->menu_code,
                                "submenu_code" => $newDtls->submenu_code,
                                "label" => $newDtls->label,
                                "path" => $newDtls->path,
                                "publish" => $newDtls->publish
                             );
                $query = $this->db->get_where('nav', array('menu_code' => $newDtls->menu_code, 'submenu_code' => $newDtls->submenu_code, 'label' => $newDtls->label));
                $retVal = $query->row_array();
                if (empty($retVal))
                    array_push($dataArr, $data);
            endforeach;
            if (count($dataArr) > 0)
                return $this->db->insert_batch("nav", $dataArr);
        }
		
		public function remove(){			
			$ci =& get_instance();
		    $ci->load->model("portal/ruser_model");				
        	$query = $ci->ruser_model->is_entry_unique(array("client_id"=>$_POST['id'],"expiry >="=>mdate("%Y-%m-%d %H:%i:%s")));
        	if (gettype($query) == 'boolean'){
				if (!$query){
					$ci =& get_instance();
				    $ci->load->model("portal/audit_model");
					$ci->audit_model->set(array("tran_type"=>"Client Update","user_id"=>$this->session->userdata('id'),"remarks"=>"Delete attempt for client profile of " . $_POST['name']));
					return "Delete failed! Active users still in this group.";
				}
			}else
				return $query;
			$query = $this->portal->where("id", $_POST['id']);
			$query = $this->portal->delete($this->tblName);				
			$path = "D:/portal/documents/" . $_POST['id'];
			$ci =& get_instance();
		    $ci->load->model("portal/audit_model");
			$ci->audit_model->set(array("tran_type"=>"Client Update","user_id"=>$this->session->userdata('id'),"remarks"=>"Deleted client profile for " . $_POST['name']));
			if (is_dir($path)){
				$this->rrmdir($path);				
				// if (!@rmdir($path))
					// return "Directory not empty!";
			}

			return $query;
		}
		
		function rrmdir($dir) {
		   if (is_dir($dir)) {
		     $objects = scandir($dir);
		     foreach ($objects as $object) {
		       if ($object != "." && $object != "..") {
		         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
		       }
		     }
		     reset($objects);
		     rmdir($dir);
		   }
		}
    }        
?>