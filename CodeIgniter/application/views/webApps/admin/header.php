<!DOCTYPE html>
<html>
    <head>
        <base href="<?=base_url();?>">
        <title> <?php echo $title; ?> </title>        
		<link href="/kendoui/examples/content/shared/styles/examples-offline.css" type="text/css" rel="stylesheet"></link>
		<link href="/kendoui/styles/kendo.common.min.css" type="text/css" rel="stylesheet"></link>
		<link href="/kendoui/styles/kendo.default.min.css" type="text/css" rel="stylesheet"></link>
		<link href="/assets/css/jquery.pnotify.default.css" type="text/css" rel="stylesheet"></link>
		<link href="/assets/css/jquery.pnotify.default.icons.css" type="text/css" rel="stylesheet"></link>
		<link href="/assets/css/jquery-ui.css" type="text/css" rel="stylesheet"></link>
		
		<link href="/assets/css/webapps/styles.css" type="text/css" rel="stylesheet"></link>
        <link href="/assets/css/webapps/admin/styles.css" type="text/css" rel="stylesheet" media="screen" />
		
		<script type="text/javascript" src="/kendoui/js/jquery.min.js"></script>		
		<!--<script type="text/javascript" src="/assets/js/jQuery1.3.js"></script>-->
        <script type="text/javascript" src="/assets/js/jQuery1.7.js"></script>
        <script type="text/javascript" src="/assets/js/jQueryUI1.7.2.js"></script>
		<script type="text/javascript" src="/kendoui/js/kendo.web.min.js"></script>
        <script type="text/javascript" src="/assets/js/transit.js"></script>
        <script type="text/javascript" src="/assets/js/templateLoader.js"></script>	
		<!--<script type="text/javascript" src="/assets/js/olympics/printElement.js"></script>
        <script type="text/javascript" src="/assets/js/olympics/function.js"></script>-->		
        <script type="text/javascript" src="/assets/js/jqueryi18Now140.js"></script>
        <script type="text/javascript" src="/assets/js/twFile.js"></script>
        <script type="text/javascript" src="/assets/js/events.js"></script>	
        <script type="text/javascript" src="/assets/js/function.js"></script>
		<script type="text/javascript" src="/assets/js/jquery.pnotify.js"></script>
        <script type="text/javascript" src="/assets/js/jQuery.browser.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){				
				var notifStr = "<?php echo (isset($notification) && $notification != '') ? $notification : ''; ?>";
				if (notifStr != '')
					showNotif("Information",notifStr,"info");
			});
		</script>
    </head>
    <body>
		<div id="window" data-role="window" data-bind="kendoWindow: { async: true, isOpen: false}"></div>
		<div id="preload" data-role="window" data-bind="kendoWindow: { async: true, isOpen: false}"></div>
		<div id="arccHead">
<!-- 			<span class="user"> <?php //echo (isset($user_name)) ? ucwords(strtolower($user_name)) : ""; ?> | <a href="/codeIgniter/index.php/webapps/admin/offCredentials/"> Sign-Out </a> </span> -->
			<ul style="float: right;width: 10%;">
				<li style="text-align: center;"><?php echo (isset($user_name)) ? ucwords(strtolower($user_name)) : ""; ?></li>
				<li style="text-align: center;color: #80C4DF;"><a href="/codeIgniter/index.php/webapps/" style="font-size: 12px !important;font-weight: normal;color: #84E3F4;"> Home </a> | <a href="/codeIgniter/index.php/webapps/admin/offCredentials/" style="padding: 0;font-weight: normal;font-size: 12px !important;color: #84E3F4;"> Sign-Out </a></li>
			</ul>
		</div>
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
				<!-- <div class='notif'>
					<?php echo (isset($notification) && $notification != "") ? $notification : ""; ?>
				</div> -->