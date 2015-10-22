<!DOCTYPE html>
<html>
    <head>
        <base href="<?=base_url();?>">
        <title> <?php echo $title; ?> </title>
		<link href="/kendoui/examples/content/shared/styles/examples-offline.css" type="text/css" rel="stylesheet"></link>
		<link href="/kendoui/styles/kendo.common.min.css" type="text/css" rel="stylesheet"></link>
		<link href="/kendoui/styles/kendo.default.min.css" type="text/css" rel="stylesheet"></link>
		
        <script type="text/javascript" src="/assets/js/jQuery1.7.js"></script>
		<script type="text/javascript" src="/kendoui/js/jquery.min.js"></script>
		<script type="text/javascript" src="/kendoui/js/kendo.web.min.js"></script>	
		<style type="text/css">
			* {
			    padding: 0;
			    margin: 0;
			}
			/*html {
				background: url('/assets/images/webapps/login.png') no-repeat #000000 !important;
				font: 11px "Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
				color: #777;
    			background:#e2e2e2 url("/assets/images/webApps/const.png") no-repeat fixed 45% 365px;
			}*/
			body {
				margin: 0 auto;
				width: 100%;
				height: 100%;
				/*font-family: 'Verdana','Open Sans Condensed','Arial Narrow', serif;
    			background:#e2e2e2 url("/assets/images/webApps/const.png") no-repeat fixed 45% 365px;*/
				font-family: "Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif !important;
				font-weight: 400;
				font-size: 12px;
				color: #333;
				-webkit-font-smoothing: antialiased;
			}
			label {
				display: block;
			}
			fieldset {
				width: 160px;
			}
			#arccHead a, input[type='submit'] {
				/*text-decoration: none;
				padding: 1px 5px;
				border: 1px solid #707070;
				border-radius: 3px;
				color: #000;
				background: #D4D4D4;
				font-family: inherit;
				font-size: 11.6pt;
				height: 21px;
				cursor: default;*/
				padding: 0 0 0 4px;
				margin: 0;
				font-size: 14px;
				font-weight: bold;
				color: #0e5fc2;
				text-decoration: none;
			}
			/*#arccHead a:hover, input[type='submit']:hover {
				border: 1px solid #3c7fb1;
				background: #afdef8;
			}*/
			#arccHead {
				margin: 0 auto;
				width: 74.35%;
				height: 125px;
			}
			.header-left {
				width: 100%;
				height: 100px;
				float: left;
				background: url('/assets/images/webapps/indexHeader.png') no-repeat;
			}
			.header-right {
				float: right;
			}
			#main-wrapper {
				margin: 0 auto 0 auto;
				width: 74.35%;
			}
			.wrap-system ul {
				display:table;
				list-style-type: none;
			}
			.wrap-system ul li {
				display:table-cell;
			}
			.system-proper {
				margin: 0 5px 10px 5px;
				width: 190px;
				height: 148px;
				float: left;
			}
			ul {
				list-style-type: none;				
			}
			#window ul li label.title {
				width: 28%;
				text-align: right;
				margin-right: 5px;
				display: inline-block;
			}
			#window ul li {
				margin-bottom: 5px;
			}
			#window .formRight, #window .windowFormRight {
				width: 49.5%;
				height: 111px;
				display: block;
				float: right;
			}
			.buttonRight {
				text-align: right;
				height: 25px;
			}
			.buttonRight span, .buttonRight label {
				line-height: 2.2;
			}
			.system-proper img {
				margin: 0 auto;
				width: 156px;
				display: block;
			}
			.system-proper a {
				padding: 0 0 0 4px;
				margin: 0;
				font-size: 14px;
				font-weight: bold;
				color: #0e5fc2;
				text-decoration: none;
			}
			.system-proper p {
				padding: 0 0 0 4px;
				margin: 0;
				font-size: 14px;
				font-weight: bold;
				color: #0e5fc2;
				font-size: 11px;
				font-weight: normal;
				color: #0e5fc2;
			}
			.login-header {
				margin: 0 auto;
				width: 664px; /*535*/
				height: 96px; /*100*/
				background: url('/assets/images/webapps/loginHeader.png') no-repeat;
			}
			.login-form {
				margin: 0 auto;
				width: 326px;
				height: 254px;
				background: url('/assets/images/webapps/loginBox.png') no-repeat;
			}
			.login-form ul {
				padding: 40px 0 0 0 !important;
				width: 248px;
				margin: 0 auto 0 auto;
				list-style-type: none;
			}
			.login-form ul li {
				margin-bottom: 10px;
			}
			.login-form ul li:last-child {
				margin-bottom: 0;
			}
			.login-form ul li label.title {
				text-align: right;
				margin-right: 5px;
				display: inline-block;
			}
			.login-form ul li input {
				font-size: 20px;
			}
			#footer {
				position:absolute;
   				bottom:0;
   				width: 100%;
				height: 80px;
			}
			.footer-content {
				margin: 0 auto;
				width: 74.35%;
				height: 59px;
			}
			.footer-left {
				font-family: 'Berlin Sans FB';
				font-size: 12px;
				float: left;
				text-align: left;
				color: #0e5fc2;
			}
			.footer-left p {
				padding: 0;
				margin: 0;
			}
			.footer-left p:first-child {
				font-size: 15px;
				font-weight: bold;
			}
		</style>
		<script>
			//$(document).ready(function(){
			//});
		</script>
    </head>
    <body>
		<div id="window"></div>
		<div class="customErrors"><?php echo (isset($error)) ? $error : ""; ?></div>
		<div id="arccHead">
			<div class="header-left" style="display: <?php echo ((isset($user_name)) ? "block" : "none"); ?>"></div>
			<div class="header-right" style="display: <?php echo ((isset($user_name)) ? "block" : "none"); ?>">
				<span class="user"> <?php echo (isset($user_name)) ? $user_name : ""; ?> | <a href="/codeIgniter/index.php/webapps/index/offCredentials/"> Sign-Out </a> </span> <!--http://localhost-->
			</div>			
		</div>