<!DOCTYPE html>
<html>
    <head>    	    	
        <base href="<?=base_url();?>">
        <title> ARCC Portal </title>
		<link href="/kendoui/examples/content/shared/styles/examples-offline.css" type="text/css" rel="stylesheet"></link>
		<link href="/kendoui/styles/kendo.common.min.css" type="text/css" rel="stylesheet"></link>
		<link href="/kendoui/styles/kendo.default.min.css" type="text/css" rel="stylesheet"></link>
		<link href="/assets/css/jquery.pnotify.default.css" type="text/css" rel="stylesheet"></link>
		<link href="/assets/css/jquery.pnotify.default.icons.css" type="text/css" rel="stylesheet"></link>
		<link href="/assets/css/jquery-ui.css" type="text/css" rel="stylesheet"></link>
		<link href="/assets/css/portal/marquee.css" type="text/css" rel="stylesheet"></link>		
		<link href="/assets/css/portal/styles.css" type="text/css" rel="stylesheet"></link>		
        <script type="text/javascript" src="/assets/js/jQuery1.7.js"></script>
        <script type="text/javascript" src="/assets/js/portal/events.js"></script>	
        <script type="text/javascript" src="/assets/js/function.js"></script>        
		<script type="text/javascript" src="/kendoui/js/jquery.min.js"></script>
		<script type="text/javascript" src="/kendoui/js/kendo.web.min.js"></script>
		<script type="text/javascript" src="/assets/js/jquery.pnotify.js"></script>
        <script type="text/javascript" src="/assets/js/jQuery.browser.min.js"></script>
    </head>
    <body>
		<div id="window" data-role="window" data-bind="kendoWindow: { async: true, isOpen: false}"></div>
		<div id="subWindow" data-role="window" data-bind="kendoWindow: { async: true, isOpen: false}"></div>
		<div id="preload" data-role="window" data-bind="kendoWindow: { async: true, isOpen: false}"></div>
		<div id="arccHead">
			<div class="imageARCC screenshot"></div>
			<div class="logoName"></div>
			<ul id="logDesc" class="marquee" style="display: none;">
				<li class="marquee-showing"><img src="/assets/images/portal/weAre.png" width="699" height="15" /></li>	
				<li class="marquee-showing"><img src="/assets/images/portal/weAre.png" width="699" height="15" /></li>	
			</ul>			
		</div>
		<div id="arccMenu">			
			<span>Welcome, <?php echo $name . "." . (isset($expiry) ? " (Login Expires " . date_format(new DateTime($expiry), 'g:ia \o\n l jS F Y') . ")" : ""); ?></span>
			<a href='/codeIgniter/index.php/portal/index/offCredentials'> Sign-Out </a>
		</div>
		<div id="arccWrap">