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
		<!--<link href="/assets/css/jquery.ui.theme.css" type="text/css" rel="stylesheet"></link>-->
		
		<link href="/assets/css/webapps/styles.css" type="text/css" rel="stylesheet"></link>
		
        <script type="text/javascript" src="/assets/js/jQuery1.7.js"></script>
        <script type="text/javascript" src="/assets/js/events.js"></script>	
        <script type="text/javascript" src="/assets/js/function.js"></script>
        
		<script type="text/javascript" src="/kendoui/js/jquery.min.js"></script>
		<script type="text/javascript" src="/kendoui/js/kendo.web.min.js"></script>
		<script type="text/javascript" src="/assets/js/jquery.pnotify.js"></script>
        <script type="text/javascript" src="/assets/js/jQuery.browser.min.js"></script>
    </head>
    <body>
		<div id="window" data-role="window" data-bind="kendoWindow: { async: true, isOpen: false}"></div>
		<div class="customErrors" style="display: none;"><?php echo (isset($error)) ? $error : ""; ?></div>
		<div id="arccHead">
			<div class="header-left" style="display: <?php echo ((isset($user_name)) ? "block" : "none"); ?>"></div>
			<div class="header-right" style="display: <?php echo ((isset($user_name)) ? "block" : "none"); ?>">
				<span class="user"> <?php echo (isset($user_name)) ? ucwords(strtolower($user_name)) : ""; ?> | <a href="/codeIgniter/index.php/webapps/index/offCredentials/"> Sign-Out </a> </span> <!--http://localhost-->
			</div>			
		</div>