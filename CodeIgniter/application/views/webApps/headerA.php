<!DOCTYPE html>
<html>
    <head>
        <base href="<?=base_url();?>">
        <title> <?php echo $title; ?> </title>        
        <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/codeIgniter/admin/style.css" />
		<link href="/kendoui/examples/content/shared/styles/examples-offline.css" type="text/css" rel="stylesheet"></link>
		<link href="/kendoui/styles/kendo.common.min.css" type="text/css" rel="stylesheet"></link>
		<link href="/kendoui/styles/kendo.default.min.css" type="text/css" rel="stylesheet"></link>
		
		<script type="text/javascript" src="/kendoui/js/jquery.min.js"></script>		
		<script type="text/javascript" src="/assets/js/jQuery1.3.js"></script>
        <script type="text/javascript" src="/assets/js/jQuery1.7.js"></script>
        <script type="text/javascript" src="/assets/js/jQueryUI1.7.2.js"></script>
		<script type="text/javascript" src="/kendoui/js/kendo.web.min.js"></script>	
        <script type="text/javascript" src="/assets/js/function.js"></script>
        <script type="text/javascript" src="/assets/js/transit.js"></script>	
		<script type="text/javascript" src="/assets/js/olympics/printElement.js"></script>
        <script type="text/javascript" src="/assets/js/olympics/function.js"></script>		
        <script type="text/javascript" src="/assets/js/templateLoader.js"></script>
        <script type="text/javascript" src="/assets/js/jqueryi18Now140.js"></script>
        <script type="text/javascript" src="/assets/js/twFile.js"></script>

		<style rel="stylesheet" type="text/css">
			* {
			    padding: 0;
			    margin: 0;
			}
			body{
				font-family: 'Verdana','Open Sans Condensed','Arial Narrow', serif;
				font-weight: 400;
				font-size: 12px;
				color: #333;
				-webkit-font-smoothing: antialiased;
				overflow-y: hidden;
				overflow-x: hidden;
			}
			#main-wrapper {
				width: 90%;
				height: auto;
				margin: 10px auto;
			}
			#main-wrapper div.wrap-header, #main-wrapper div.wrap-grid, #main-wrapper div.wrap-form, #mainContent div.wrap-selection {
				margin-bottom: 5px;
			}
			#mainContent div.wrap-form, #mainContent div.wrap-button {
				width: 70%;
			}
			fieldset {
				padding: 5px;
			}
			legend {
				padding: 0 5px;
				font-weight: bold;
			}
			ul {
				list-style-type: none;				
			}
			a {
				text-decoration: none;
			}
			.demo-section {
				padding: 5px;
				margin-bottom: 5px !important;
			}
			.demo-section:last-child {
				padding: 5px;
				margin-bottom: 2px !important;
			}
			.wrap-selection {
				width: 100%;
				height: 390px;
			}
			.wrap-form {
				height: auto;
			}
			.wrap-form ul {
				width: 70%;
				margin: 0 auto;
			}
			.wrap-form ul li, .utilitiesBox ul li {
				margin-bottom: 5px;
			}
			.wrap-form ul li:last-child {
				margin-bottom: 0;
			}
			.wrap-form ul li label.title {
				width: 80px;
				text-align: right;
				margin-right: 5px;
				display: inline-block;
			}
			#window ul li label.title, .utilitiesBox ul li label.title {
				width: 28%;
				text-align: right;
				margin-right: 5px;
				display: inline-block;
			}
			#window ul li {
				margin-bottom: 5px;
			}
			label.chk {
				width: auto !important;
			}
			.wrap-form ul li input[type="checkbox"],.wrap-form ul li input[type="radio"] {
				line-height: 2.2;
				vertical-align: middle;
				margin-right: 5px;
			}
			/*.wrap-form ul li input[type="textbox"] {
				width: 50%;
			}*/
			.formRight {
				width: 49.5%;
				height: 195px;
				display: block;
				float: right;
			}
			.wrap-button {
				height: 25px;
			}
			.buttonLeft {
				width: 30%;
				float: left;
			}
			.buttonRight {
				text-align: right;
				height: 25px;
			}
			.buttonRight span, .buttonRight label {
				line-height: 2.2;
			}
			#mainContent div.buttonLeft {
				width: 50%;
				float: left;
			}
			#mainContent div.buttonRight {
				text-align: right;
				height: 25px;
			}
			#mainContent div.buttonRight span, #mainContent div.buttonRight label {
				line-height: 2.2;
			}
			.taClass {
				width: 100%;
				margin-bottom: 5px;
			}
			.taClass:last-child {
				margin-bottom: 0;
			}
			.taClass label {
				display: block;
				padding: 3px;
				position: absolute;
				z-index: 1;
				background: #e2e2e2;
				border: 1px solid #abadb3;
				-moz-border-radius: 0 0 4px 0;
				-webkit-border-radius: 0 0 4px 0;
				border-radius: 0 0 4px 0;  
			}
			.taClass textarea {
				width: 100%;
				height: 88px;
				position: relative;
				padding-top: 25px;				
			}
			#window {
				display: none;
			}
			#window .demo-section {
				margin: 0 !important;
			}
			.k-dropzone {
				width: 190px;
				height: 25px;
				float: left;
			}
			.k-dropzone em {
				visibility: visible;
			}
			.k-upload-button {
				width: 100px;
			}
			.k-upload-files {
				width: 508px;
				float: left;
				margin: .8em 0 .8em 0;
				line-height: 1.4 !important;
			}
			.k-upload {
				height: 45px;
			}
			.k-upload-selected {
				float: right;
				margin: .8em;
			}
			.k-upload-status {
				top: 0;
			}
			.k-upload-status-total {
				display: none;
			}
			.k-button {
				height: 25px !important;
			}
			.k-grid tbody tr{
			    height: 27px;
			}			 
			.k-grid td{
			    white-space: nowrap;
			}
		</style>
		<script>
			function to_pdf(title, pdfName){
				$("#window").data("kendoWindow").setOptions({
				    title: title,
				    width: "900px",
				    height: "600px"
				});
				$("#window").data("kendoWindow").refresh({
				    url: "http://" + $(location).attr('hostname') + "/assets/pdf/" + pdfName + ".pdf",
				    contentType: "application/pdf"
				});
				$("#window").data("kendoWindow").center().open();
			}
			$(document).ready(function(){
		        var onClose = function() {
		        	var conf = confirm("Are you sure you want to close this dialog?");
		        	if (!conf)
		        		e.preventDefault();
		        }
		        $("#window").kendoWindow({ 
		            width: "500px",
		            height: "auto",
		            title: "Change Password",
		            close: onClose,
		            modal: true,
		            visible: false,
		            resizable: false,
		            scrollable: true
		        });
			});
		</script>
    </head>
    <body>
		<div id="window"></div>
		<div id="arccHead">
			<span class="user"> <?php echo (isset($user_name)) ? $user_name : ""; ?> | <a href="/codeIgniter/index.php/webapps/admin/offCredentials/"> Sign-Out </a> </span> <!--http://localhost-->
		</div>
		<?php 
			$attributes = array("name" => "navForm");
			echo form_open($formAction, $attributes);
		?>		
		<div id="arccWrapper">
			<div id="leftNav">
				<div id="leftSysPhase" class="leftNav">
					<span class="title"> Reference </span>
					<ul>
						<?php
							if (isset($rowArrayRef) && is_array($rowArrayRef) || !$rowArrayRef){								
								foreach ($rowArrayRef as $value):
						?>
						<li <?php echo ((isset($currLeftNavRef) && trim($currLeftNavRef) == trim($value['ref_path'])) ? "class='currLeftNav'" : ""); ?>> <a href="<?php echo $value['ref_path']; ?>"> <?php echo $value['ref_desc']; ?> </a> </li>
						<?php
								endforeach;
							}
						?>
					</ul>
					<span class="menuSeparator"><br /></span>
					<div class="leftSysFooter">
						<a class="likeButt" href="/codeIgniter/index.php/webapps/admin/reference/">Maintenance</a> <!--http://localhost-->
					</div>
				</div>
				<div id="leftSetupPhase" class="leftNav">
					<span class="title"> Setup </span>
					<ul>
						<?php
							if (isset($rowArraySet) && is_array($rowArraySet) || !$rowArraySet){								
								foreach ($rowArraySet as $value):
						?>
						<li <?php echo ((isset($currLeftNavSet) && trim($currLeftNavSet) == trim($value['setup_path'])) ? "class='currLeftNav'" : ""); ?>> <a href="<?php echo $value['setup_path']; ?>"> <?php echo $value['setup_desc']; ?> </a> </li>
						<?php
								endforeach;
							}
						?>
					</ul>
					<span class="menuSeparator"><br /></span>
					<div class="leftSetupFooter">
						<a class="likeButt" href="/codeIgniter/index.php/webapps/admin/setup/">Maintenance</a> <!--http://localhost-->
					</div>
				</div>
				<!--<div id="leftProjPhase" class="leftNav">
					<span class="title"> Project / Site </span>
					<select name="selProj" id="selProj" onchange="document.navForm.submit();">
						<option value="default">*****Choose System First*****</option>
						<?php
							if (isset($rowArrayProject) && $rowArrayProject != ""){								
								foreach ($rowArrayProject as $value):
						?>
						<option <?php echo (($selProj == $value['project_code']) ? "selected" : ""); ?> value="<?php echo $value['project_code']; ?>"> <?php echo $value['project_desc']; ?> </option>
						<?php
								endforeach;
							}
						?>
					</select>
					<span class="menuSeparator"><br /></span>
					<div class="leftProjFooter">
						<a class="likeButt" href="http://localhost/codeIgniter/index.php/webapps/admin/project/">Maintenance</a>
					</div>
				</div>-->
				<div id="leftUtilPhase" class="leftNav">
					<span class="title"> Utilities </span>
					<ul>
						<?php
							if (isset($rowArrayUtil) && is_array($rowArrayUtil) || !$rowArrayUtil){								
								foreach ($rowArrayUtil as $value):
						?>
						<li <?php echo ((isset($currLeftNav) && $currLeftNav == $value['util_path']) ? "class='currLeftNav'" : ""); ?>> <a href="<?php echo $value['util_path']; ?>"> <?php echo $value['util_desc']; ?> </a> </li>
						<?php
								endforeach;
							}
						?>
					</ul>
					<span class="menuSeparator"><br /></span>
					<div class="leftUtilFooter">
						<a class="likeButt" href="/codeIgniter/index.php/webapps/admin/utilities/">Maintenance</a> <!--http://localhost-->
					</div>
				</div>
				<div id="leftPhyPhase" class="leftNav" style="display: none;">
					<span class="title"> Appearance </span>
					<ul>
						<li <?php echo ((isset($currLeftNav) && $currLeftNav == "index") ? "class='currLeftNav'" : ""); ?>> <a href="/codeIgniter/index.php/webapps/admin/index/"> Dashboard </a> </li> <!--http://localhost-->
						<li <?php echo ((isset($currLeftNav) && $currLeftNav == "menu") ? "class='currLeftNav'" : ""); ?>> <a href="/codeIgniter/index.php/webapps/admin/navManage/"> Menus </a> </li> <!--http://localhost-->
						<li> <a href="#"> Background </a> </li>
					</ul>
				</div>
			</div>
			<div id="mainContent">
				<div class='notif'>
					<?php echo (isset($notification) && $notification != "") ? $notification : ""; ?>
				</div>