<?php
	if (isset($is_logged_in) && $is_logged_in){ 
		$this->load->view('portal/header.php');
		$this->load->view('portal/' . $dynamicBody);
		$this->load->view('portal/footer.php');
	}else 
		$this->load->view('portal/_login.php');
?>