<?php
class MakeDir extends CI_Controller {
	private $structure = "application/views/webApps/admin/nav/";
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		if (!is_dir($this->structure . (isset($_GET['parent']) ? strtoupper($_GET['parent']) . "/" : "") . strtoupper($_GET['folderName'])))
			mkdir($this->structure . (isset($_GET['parent']) ? strtoupper($_GET['parent']) . "/" : "") . strtoupper($_GET['folderName']), 0, true);
		//if (!mkdir($this->structure . (isset($_GET['parent']) ? strtoupper($_GET['parent']) . "/" : "") . strtoupper($_GET['folderName']), 0, true))
		//	die("Can't create this folder.");
	}
}
?>