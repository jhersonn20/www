<?php
class Group_Menu_model extends CI_Model {
	private $tblName = "group_menu";
	public function __construct(){
        $this->gendb = $this->load->database('gendb', true);
	}
	
	pubLic function getAll(){
		$sql = "SELECT * FROM " . $this->tblName;
		return $this->gendb->query($sql)->result_array();
	}	
	
	pubLic function getAllBySelected($appl_code="",$group_code="",$selected=""){ //$isSelected = false
		// $sql = "SELECT t.*, t2.description as parentMenu FROM {$this->tblName} t 
				// inner join (
					// select menucode, description, group_code from gendb.group_menu where menucode < 2000 and appl_code = '$appl_code' and group_code = '{$group_code}'
				// ) t2
				// on (convert(concat('100', substring(t.menucode,1,1)), unsigned) - 1) = t2.menucode and
				   // t.group_code = t2.group_code WHERE t.appl_code = ? and t.group_code = ? and t.selected = ?
				// union all
				// select *, '' as parentMenu from gendb.group_menu where menucode < 2000 and appl_code = '$appl_code' and group_code = '{$group_code}' and selected = '{$selected}'";
		$sql = "SELECT t.*, if(lower(progname) like '%.%', progname, '') as parentMenu FROM {$this->tblName} t WHERE t.appl_code = ? and t.group_code = ? and t.selected = ?";
		return $this->gendb->query($sql,array($appl_code,$group_code,$selected))->result_array();
		//return $this->gendb->query($sql)->result_array();
	}
	
	public function set_group_menu(){ //$PROGRESS_RECID="",$selected=""
    	$query = $this->gendb->where('PROGRESS_RECID', $_POST['PROGRESS_RECID']);
    	$query = $this->gendb->update($this->tblName, array("selected"=>$_POST['selected']));
		return $query;
	}	
        
    public function verify_module($filters){
		foreach ($filters as $key => $val):
			settype($filters[$key], "string");
		endforeach;
        $sql = "select * from appl_user, group_menu where appl_user.user_id = ? and appl_user.appl_code = ? and group_menu.progname LIKE ? and group_menu.appl_code = appl_user.appl_code and group_menu.group_code = appl_user.group_code and group_menu.selected and group_menu.publish order by group_menu.menucode, group_menu.subcode";
        return $this->gendb->query($sql, $filters)->result_array();            
    }	
        
    public function get_menu($filters){
		foreach ($filters as $key => $val):
			settype($filters[$key], "string");
		endforeach;
        //$this->db->order_by('menu_code','asc');
        //$query = $this->db->get_where('menu', array('publish' => 1, 'system_code' => $sysCode));
        //$sql = "SELECT * FROM rmenu WHERE publish = ? AND system_code = ? AND project_code = ?";
        $sql = "select * from appl_user, group_menu where appl_user.user_id = ? and appl_user.appl_code = ? and group_menu.appl_code = appl_user.appl_code and group_menu.group_code = appl_user.group_code and group_menu.selected and group_menu.publish order by group_menu.menucode, group_menu.subcode";
        //$sql = "SELECT * FROM " . $this->tblName . " WHERE publish = ? AND appl_code = ? AND group_code = ?";
        //return $query->result_array();
        return $this->gendb->query($sql, $filters)->result_array();            
    }
        
    public function get_menu_by_group($filters){
		foreach ($filters as $key => $val):
			settype($filters[$key], "string");
		endforeach;
        $sql = "select t4.* from appl_user t3 
        			inner join (
		        		SELECT t.progname, t.appl_code, t.group_code, t.menucode, concat(t.description, ' (', upper(substring(t2.description,1,1)), ')') as description FROM gendb.group_menu t 
						inner join (
							select menucode, description, group_code from gendb.group_menu where menucode < 2000 and appl_code = '{$filters[1]}' and group_code = '{$filters[2]}'
						) t2
						on (convert((concat('100', substring(t.menucode,1,1))), unsigned) - 1) = t2.menucode and
						   t.group_code = t2.group_code where t.selected = 1
					) t4 WHERE t3.user_id = ? and t4.appl_code = ? and t4.group_code = ? group by t4.menucode order by t4.menucode";
        return $this->gendb->query($sql, $filters)->result_array();            
    }
	
	public function setMenu($values, $value = ""){
        // Load First_model
        /*$ci =& get_instance();
        $ci->load->model('webapps/rgroup_model');
		
		$rgroup = $ci->rgroup_model->getAll();
		foreach($rgroup as $row){
			$sql = "INSERT INTO " . $this->tblName . "(description, group_code, menucode, selected, subcode, app_name, progname, mtitle) " . 
										 "VALUES('{$values['description']}', '{$row['group_code']}', {$values['menucode']}, 0, {$values['subcode']}, '{$values['app_name']}', '{$values['progname']}', '{$values['mtitle']}')";
			$this->gendb->query($sql);
		}*/
		$sql = "SELECT * FROM " . $this->tblName . " where appl_code = '{$values['appl_code']}'";
		$row = $this->gendb->query($sql);
		if ($row->num_rows() == 0){
			$sql = "INSERT INTO " . $this->tblName . "(description, group_code, menucode, selected, subcode, appl_code, progname, mtitle, rmenu_recid, publish, just_label, param) select ?,rgroup.group_code,?,0,?,?,?,?,?,?,?,? from rgroup where rgroup.appl_code = '{$values['appl_code']}'";
			$query = $this->gendb->query($sql,array($values['description'],$values['menucode'],$values['subcode'],$values['appl_code'],$values['progname'],$values['mtitle'],$values['PROGRESS_RECID'],$values['publish'],$values['just_label'],$values['param']));
		}else {
			if ($value == "add"){
				if (isset($values['group_code']))
					$sql = "INSERT INTO " . $this->tblName . "(description, group_code, menucode, selected, subcode, appl_code, progname, mtitle, rmenu_recid, publish, just_label, param) select ?,rgroup.group_code,?,0,?,?,?,?,?,?,?,? from rgroup where rgroup.appl_code = '{$values['appl_code']}' and rgroup.group_code = '{$values['group_code']}'";
				else
					$sql = "INSERT INTO " . $this->tblName . "(description, group_code, menucode, selected, subcode, appl_code, progname, mtitle, rmenu_recid, publish, just_label, param) select ?,rgroup.group_code,?,0,?,?,?,?,?,?,?,? from rgroup where rgroup.appl_code = '{$values['appl_code']}'";
				$query = $this->gendb->query($sql,array($values['description'],$values['menucode'],$values['subcode'],$values['appl_code'],$values['progname'],$values['mtitle'],$values['PROGRESS_RECID'],$values['publish'],$values['just_label'],$values['param']));
			}else {
		    	$query = $this->gendb->where('rmenu_recid', $values['PROGRESS_RECID']);
		    	$query = $this->gendb->update($this->tblName, array("menucode"=>$values['menucode'],"subcode"=>$values['subcode'],"description"=>$values['description'],"mtitle"=>$values['mtitle'],"progname"=>$values['progname'],"publish"=>$values['publish'],"just_label"=>$values['just_label'],"param"=>$values['param']));
			}
		}
		
		return $query;
	}
	
	public function remove_gmenu(){
		$query = $this->gendb->where("rmenu_recid", $_POST['PROGRESS_RECID']);
		$query = $this->gendb->delete($this->tblName);
		
		return $query;
	}
	
	public function remove_gmenu2($appl_code = "",$group_code = ""){
		$whereArr = array("appl_code"=>$appl_code,"group_code"=>$group_code);
		$query = $this->gendb->where($whereArr);
		$query = $this->gendb->delete($this->tblName);
		
		return $query;
	}
	
	public function remove_gmenu_by_appl(){
		$query = $this->gendb->where("appl_code", $_POST['appl_code']);
		$query = $this->gendb->delete($this->tblName);
		
		return $query;
	}
}
?>