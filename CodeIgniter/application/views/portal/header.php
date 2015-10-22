<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>    	    	
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"> 
        <base href="<?=base_url();?>">
        <title> Official Web Portal of ARCC </title>
        <link rel="icon" type="image/ico" href="/assets/images/portal/favicon.ico"></link>
		<link href="/assets/css/portal/styles_all.css" type="text/css" rel="stylesheet"></link>
		<link href="/assets/css/portal/styles/kendo.blueopal.min.css" type="text/css" rel="stylesheet"></link>
		<script type="text/javascript" src="/assets/js/portal/events_all.js"></script>
        <!--[if IE]>
		     <link rel="stylesheet" href="/assets/css/portal/styles_ie.css" type="text/css"/>
		<![endif]-->
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
			<span>Welcome, <?php echo $name . "." . (isset($expiry) ? " (Login Expires " . date_format(new DateTime($expiry), 'g:ia \o\n l jS F Y') . ")" : ""); ?> </span>
			  <a href='<?php echo '/codeigniter/index.php/portal'; ?>/index/offCredentials'> Sign-Out </a>  <a href='<?php echo '/codeigniter/index.php/portal'; ?>/index/direct_dl?id=<?php echo $user_pk; ?>&client_id=user_guide&name=user_guide.pdf'> User's Guide  |&nbsp;</a>
		</div>
		<div id="arccWrap">