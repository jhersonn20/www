<?php
    class Rmenu_model extends CI_Model {
		private $tblName = "rmenu";
    			
        public function __construct(){
            //$this->load->database();
        	$this->gendb = $this->load->database('gendb', true);
        }
        
        public function get_nav($sysCode){
            //$this->db->order_by('menu_code','asc');
            //$query = $this->db->get_where('menu', array("system_code" => $sysCode));
            //return $query->result_array();
			settype($sysCode, "string");
            $sql = "SELECT * FROM rmenu WHERE system_code = ? AND project_code = ?"; 
            return $this->db->query($sql, array($sysCode))->result_array();            
        }
        
        public function get_nav2(){
            $this->db->order_by('menu_code','asc');
            $query = $this->db->get('nav');
            return $query->result_array();            
        }
		
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
		
		public function get_menu_name($progname,$param){
			$sql = "SELECT * from {$this->tblName} WHERE progname LIKE '{$progname}%' AND ifnull(param,'') = '{$param}'";
			return $this->gendb->query($sql)->result_array();
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
                                "param" => mysql_real_escape_string($newDtls->param),
                                "PROGRESS_RECID" => $newDtls->PROGRESS_RECID
                             );
                //$query = $this->gendb->get_where('rmenu', array('menucode' => $newDtls->menucode, 'subcode' => $newDtls->subcode, 'description' => $newDtls->description));
                //$retVal = $query->row_array();
                //if (empty($retVal))
                //    array_push($dataArr, $data);
                //$this->gendb->insert("rmenu", $data);
                $sql = "INSERT INTO " . $this->tblName . " (appl_code,menucode,subcode,description,mtitle,progname,publish,just_label,param,PROGRESS_RECID)" .
                	   "VALUE('{$data['appl_code']}','{$data['menucode']}','{$data['subcode']}','{$data['description']}','{$data['mtitle']}','{$data['progname']}',{$data['publish']},{$data['just_label']},'{$data['param']}',{$data['PROGRESS_RECID']})" . 
                	   "on duplicate key update menucode=?,subcode=?,description=?,mtitle=?,progname=?,publish=?,just_label=?,param=?";
                //$query = $this->gendb->query($sql,array("menucode" => $newDtls->menucode,"subcode" => $newDtls->subcode,"description" => $newDtls->description,"mtitle" => $newDtls->mtitle,"progname" => $newDtls->progname,"publish" => $newDtls->publish,"just_label" => $newDtls->just_label,"param" => $newDtls->param));
                $query = $this->gendb->query($sql,array($newDtls->menucode,$newDtls->subcode,$newDtls->description,$newDtls->mtitle,$newDtls->progname,$newDtls->publish,$newDtls->just_label,$newDtls->param));
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
		
		public function remove_nav(){
	        $ci =& get_instance();
            $ci->load->model('webapps/group_menu_model');
			
			$query = $this->gendb->where("PROGRESS_RECID", $_POST['PROGRESS_RECID']);
			$query = $this->gendb->delete($this->tblName);
			
	        $ci->group_menu_model->remove_gmenu();
			return $query;
		}
		
		public function remove_nav_by_appl(){			
			$query = $this->gendb->where("appl_code", $_POST['appl_code']);
			$query = $this->gendb->delete($this->tblName);
			return $query;
		}
	
		public function rpt_menu(){
			$sql = " {{$this->tblName}.company_code} = 'ARCC' AND
					 {{$this->tblName}.appl_code} = '" . $_POST['appl_code'] . "'";
			
			return $sql;
		}
    }        
?>