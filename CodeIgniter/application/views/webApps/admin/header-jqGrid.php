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
		<script type="text/javascript" src="/kendoui/js/kendo.web.min.js"></script>
			
		<script type="text/javascript" src="/assets/js/jQuery1.3.js"></script>
        <script type="text/javascript" src="/assets/js/jQuery1.7.js"></script>
        <script type="text/javascript" src="/assets/js/jQueryUI1.7.2.js"></script>
        <script type="text/javascript" src="/assets/js/function.js"></script>
        <script type="text/javascript" src="/assets/js/transit.js"></script>	
		<script type="text/javascript" src="/assets/js/olympics/printElement.js"></script>
        <script type="text/javascript" src="/assets/js/olympics/function.js"></script>

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
				overflow-y: scroll;
				overflow-x: hidden;
			}
			#main-wrapper {
				width: 90%;
				height: auto;
				margin: 10px auto;
			}
			#main-wrapper div.wrap-header, #main-wrapper div.wrap-grid, #main-wrapper div.wrap-form {
				margin-bottom: 5px;
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
			.demo-section {
				padding: 5px;
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
		</style>
		<!--
        
	    <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/jqSuite/themes/redmond/jquery-ui-custom.css" />
	    <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/jqSuite/themes/ui.jqgrid.css" />
	    <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/jqSuite/themes/ui.multiselect.css" />
	    <script src="/assets/js/jqSuite/jquery.js" type="text/javascript"></script>
	    <script src="/assets/js/jqSuite/i18n/grid.locale-en.js" type="text/javascript"></script>
		<script type="text/javascript">
			$.jgrid.no_legacy_api = true;
			$.jgrid.useJSON = true;
		</script>
	    <script src="/assets/js/jqSuite/jquery.jqGrid.min.js" type="text/javascript"></script>-->
	    <!--<script src="/assets/js/jqGrid/src/grid.custom.js" type="text/javascript"></script>-->
	    <!--<script src="/assets/js/jqSuite/grid.common.js" type="text/javascript"></script>-->
	    <!--<script src="/assets/js/jqSuite/jquery-ui-custom.min.js" type="text/javascript"></script>-->
		<!--<link type="text/css" rel="stylesheet" href="/assets/css/jqGrid/themes/redmond/jquery-ui-custom.css" />
		<link type="text/css" rel="stylesheet" href="/assets/css/jqGrid/ui.jqgrid.css" />
		<link type="text/css" rel="stylesheet" href="/assets/css/jqGrid/ui.multiselect.css" />
		
		<script type="text/javascript" src="/assets/js/jqGrid/jquery.js"></script>
		<script type="text/javascript" src="/assets/js/jqGrid/jquery-ui-custom.min.js"></script>
		<script type="text/javascript" src="/assets/js/jqGrid/jquery.layout.js"></script>
		<script type="text/javascript" src="/assets/js/jqGrid/i18n/grid.locale-en.js"></script>
		<script type="text/javascript">
			$.jgrid.no_legacy_api = true;
			$.jgrid.useJSON = true;
		</script>
		<script type="text/javascript" src="/assets/js/jqGrid/ui.multiselect.js"></script>
		<script type="text/javascript" src="/assets/js/jqGrid/jquery.jqGrid.js"></script>
		<script type="text/javascript" src="/assets/js/jqGrid/jquery.tablednd.js"></script>
		<script type="text/javascript" src="/assets/js/jqGrid/jquery.contextmenu.js"></script>-->
    </head>
    <body>
		<div id="arccHead">
			<span class="user"> <?php echo (isset($user)) ? $user : ""; ?> | <a href="http://localhost/codeIgniter/index.php/webapps/admin/offCredentials/"> Sign-Out </a> </span>			
		</div>
		<?php
			$attributes = array("name" => "navForm");
			echo form_open($formAction, $attributes);
		?>		
		<div id="arccWrapper">
			<div id="leftNav">
				<div id="leftSysPhase" class="leftNav">
					<span class="title"> Reference </span>
					<!--<select name="selSys" id="selSys" onchange="document.navForm.submit();">
						<option value="default">*****Choose System First*****</option>
						<?php
							/*if (isset($rowArraySystem) && $rowArraySystem != ""){
								foreach ($rowArraySystem as $value):*/
						?>
						<option <?php //echo (($selSys == $value['appl_code']) ? "selected" : ""); ?> value="<?php //echo $value['appl_code']; ?>"> <?php //echo $value['appl_name']; ?> </option>
						<?php
								/*endforeach;
							}*/
						?>
					</select>-->
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
						<a class="likeButt" href="http://localhost/codeIgniter/index.php/webapps/admin/reference/">Maintenance</a>
					</div>
				</div>
				<div id="leftProjPhase" class="leftNav">
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
				</div>
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
						<a class="likeButt" href="http://localhost/codeIgniter/index.php/webapps/admin/utilities/">Maintenance</a>
					</div>
				</div>
				<div id="leftPhyPhase" class="leftNav">
					<span class="title"> Appearance </span>
					<ul>
						<li <?php echo ((isset($currLeftNav) && $currLeftNav == "index") ? "class='currLeftNav'" : ""); ?>> <a href="http://localhost/codeIgniter/index.php/webapps/admin/index/"> Dashboard </a> </li>
						<li <?php echo ((isset($currLeftNav) && $currLeftNav == "menu") ? "class='currLeftNav'" : ""); ?>> <a href="http://localhost/codeIgniter/index.php/webapps/admin/navManage/"> Menus </a> </li>
						<li> <a href="#"> Background </a> </li>
					</ul>
				</div>
			</div>
			<div id="mainContent">
				<div class='notif'>
					<?php echo (isset($notification) && $notification != "") ? $notification : ""; ?>
				</div>