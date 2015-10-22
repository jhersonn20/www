<!DOCTYPE html>
<html>
    <head>
        <base href="<?=base_url();?>">
        <title> <?php echo $title; ?> </title>
		<link href="/kendoui/examples/content/shared/styles/examples-offline.css" type="text/css" rel="stylesheet"></link>
		<link href="/kendoui/styles/kendo.common.min.css" type="text/css" rel="stylesheet"></link>
<!-- 		<link href="/kendoui/styles/kendo.default.min.css" type="text/css" rel="stylesheet"></link> -->
		<link href="/kendoui/styles/kendo.bootstrap.min.css" type="text/css" rel="stylesheet"></link>
		<link href="/assets/css/jquery.pnotify.default.css" type="text/css" rel="stylesheet"></link>
		<link href="/assets/css/jquery.pnotify.default.icons.css" type="text/css" rel="stylesheet"></link>
		<link href="/assets/css/jquery-ui.css" type="text/css" rel="stylesheet"></link>
		
		<!-- addtional jvc 
		 <base href="http://demos.telerik.com/kendo-ui/grid/editing-popup">
		<link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.429/styles/kendo.common-material.min.css" />
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.429/styles/kendo.material.min.css" />
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.429/styles/kendo.dataviz.min.css" />
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.429/styles/kendo.dataviz.material.min.css" /> -->
		
		<link href="/assets/css/jMenu.css" type="text/css" rel="stylesheet" />
		<link href="/assets/css/webapps/styles.css" type="text/css" rel="stylesheet"></link>
        <link href="/assets/css/webapps/public/styles.css" type="text/css" rel="stylesheet" media="screen" />
        <link href="/assets/css/webapps/public/<?php echo $system; ?>/styles.css" type="text/css" rel="stylesheet" media="screen" />
			
		<script type="text/javascript" src="/kendoui/js/jquery.min19.js"></script>
		<script type="text/javascript" src="/kendoui/js/kendo.all.min.js"></script>
		<!-- <script type="text/javascript" src="/kendoui_pro/js/jquery.min.js"></script>
		<script type="text/javascript" src="/kendoui_pro/js/kendo.all.min.js"></script> -->
        <script type="text/javascript" src="/assets/js/jMenu.js"></script>
		<script type="text/javascript" src="/assets/js/jquery.csv.js"></script>
		
        <script type="text/javascript" src="/assets/js/events.js"></script>
        <script type="text/javascript" src="/assets/js/function.js"></script>
		<script type="text/javascript" src="/assets/js/jquery.pnotify.js"></script>
        <script type="text/javascript" src="/assets/js/jQuery.browser.min.js"></script>
    </head>
    <body style="background: url('/assets/images/webapps/<?php echo $system; ?>_bg.jpg') no-repeat fixed center top #222;background-size: 100% 100%;">
		<div id="window" data-role="window" data-bind="kendoWindow: { async: true, isOpen: false}"></div>
		<div id="subWindow" data-role="window" data-bind="kendoWindow: { async: true, isOpen: false}"></div>
		<div id="preload" data-role="window" data-bind="kendoWindow: { async: true, isOpen: false}"></div>
		<div id="arccHead">
			<span class="app"> <?php echo (isset($header)) ? ($header . ((isset($menuDesc)) ? (" :: " . $menuDesc) : "")) : ""; ?> </span>
<!-- 			<span class="user"> <?php //echo (isset($user_name)) ? ucwords(strtolower($user_name)) : ""; ?> | <a href="/codeIgniter/index.php/webapps/pub/offCredentials/"> Sign-Out </a> </span> -->
			<ul style="float: right;width: 12%;">
				<li style="text-align: center;"><?php echo (isset($user_name)) ? ucwords(strtolower($user_name)) : ""; ?></li>
				<li style="text-align: center;color: #ffffff;"><a href="/codeIgniter/index.php/webapps/" style="font-size: 12px !important;color: #6E6F70;"> Home </a> | <a href="/codeIgniter/index.php/webapps/pub/offCredentials/" style="padding: 0;font-size: 12px !important;color: #6E6F70;"> Sign-Out </a></li>
			</ul>
		</div>
		<div id="arccWrapper">