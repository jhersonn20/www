<?php
    $this->load->view('webapps/public/nav/header');
    $this->load->view('webapps/public/' . $mainContent);
	if (isset($mainContent2))
    	$this->load->view('webapps/public/' . $mainContent2);
    $this->load->view('webapps/public/nav/footer');
?>