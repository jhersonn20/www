<?php
	class SMA extends CI_Controller {
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){
			$data['title'] = "Systems Management Administration";
			$this->load->view("webApps/SMA/index", $data);
		}
	}
?>
