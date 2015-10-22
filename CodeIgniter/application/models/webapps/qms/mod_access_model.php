<?php
    class Mod_Access_Model extends CI_Model {
		private $tblName = "mod_access";
		public function __construct(){
            parent::__construct();
        	$this->piping = $this->load->database('piping', true);
        }
		
		public function verifyGroupAccess(){
				// $sql = "select count(t.prog_object) as ctr from {$this->tblName} t";
				$sql = "select t.prog_object from {$this->tblName} t
						inner join ruser t2
						on t.group_code = t2.group_code 
						where t2.user_id = '{$_GET['user_id']}' and
							  t.obj_flag = 1 and
							  t.prog_object = '{$_GET['objButt']}'";
				
				 $result = $this->piping->query($sql)->result_array();
				 //echo sizeof($result);
				//return sizeof($result);
				if(sizeof($result) == 0){
					 echo "Access Denied! Please Contact MIS Department";
				} else {
					// return "pass";
					echo $result;
				}
			}
		public function is_entry_unique($criteria = array()) {
            $this->piping->select('count(*) as counter')->from($this->tblName)->where($criteria);
			$query = $this->piping->get();
			$result = $query->result();

	        if ($result !== FALSE) {
	            if ($result[0]->counter > 0) {
	                return FALSE;
	            } else {
	                return TRUE;
	            }
	        } else {
	            return 'Error in retrieving criteria.';
	        }
	    }
		
	} //--end line