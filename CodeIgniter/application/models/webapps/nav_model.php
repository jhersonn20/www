<?php
    class Nav_model extends CI_Model {
    			
        public function __construct(){
            $this->load->database();
        }
        
        public function get_nav($sysCode){
            //$this->db->order_by('menu_code','asc');
            //$query = $this->db->get_where('menu', array("system_code" => $sysCode));
            //return $query->result_array();
			settype($sysCode, "string");
            $sql = "SELECT * FROM menu WHERE system_code = ? AND project_code = ?"; 
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
		
		public function getByProject($filters){
			foreach ($filters as $key => $val):
				settype($filters[$key], "string");
			endforeach;
			$sql = "SELECT * FROM rmenu WHERE system_code = ? AND project_code = ?";
			return $this->db->query($sql, $filters)->result_array();
		}
        
        public function get_menu($filters){
			foreach ($filters as $key => $val):
				settype($filters[$key], "string");
			endforeach;
            //$this->db->order_by('menu_code','asc');
            //$query = $this->db->get_where('menu', array('publish' => 1, 'system_code' => $sysCode));
            $sql = "SELECT * FROM rmenu WHERE publish = ? AND system_code = ? AND project_code = ?"; 
            //return $query->result_array();
            return $this->db->query($sql, $filters)->result_array();            
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
            $this->db->delete('rmenu', array("system_code" => $newdata->item[0]->system_code, "project_code" => $newdata->item[0]->project_code));
            foreach($newdata->item as $newDtls):
                $data = array(
                                "system_code" => $newDtls->system_code,
                                "project_code" => $newDtls->project_code,
                                "menucode" => $newDtls->menucode,
                                "subcode" => $newDtls->subcode,
                                "description" => $newDtls->description,
                                "mtitle" => $newDtls->mtitle,
                                "app_name" => $newDtls->app_name,
                                "progname" => $newDtls->progname,
                                "publish" => $newDtls->publish,
                                "just_label" => $newDtls->just_label
                             );
                $query = $this->db->get_where('rmenu', array('menucode' => $newDtls->menucode, 'subcode' => $newDtls->subcode, 'description' => $newDtls->description));
                $retVal = $query->row_array();
                if (empty($retVal))
                    array_push($dataArr, $data);
            	$ci->group_menu_model->setMenu($data);
                $this->db->insert("rmenu", $data);
            endforeach;
            if (count($dataArr) > 0)
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
    }        
?>