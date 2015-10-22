<?php
class UserAccounts extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('webapps/group_tbl_model');
	}
	
	public function index(){
		echo "Index";
	}
	
	public function setSelect(){
		$selectVar = "<select>";
		foreach($this->group_tbl_model->getAll() as $key => $value):			
			$selectVar .= "<option value='" . $value['group_code'] . "'>" . $value['group_desc'] . "</option>";
		endforeach;
		$selectVar .= "</select>";
		
		echo trim($selectVar);
	}
}
?>