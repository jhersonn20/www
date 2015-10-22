<!DOCTYPE html>
<html>
    <head>
        <base href="<?=base_url();?>">
        <title> <?php echo $title; ?> </title>
		<link href="/kendoui/examples/content/shared/styles/examples-offline.css" type="text/css" rel="stylesheet"></link>
		<link href="/kendoui/styles/kendo.common.min.css" type="text/css" rel="stylesheet"></link>
		<link href="/kendoui/styles/kendo.default.min.css" type="text/css" rel="stylesheet"></link>
		<link type="text/css" href="/assets/css/jMenu.css" rel="stylesheet" />
		<!--<link type="text/css" href="/assets/css/content.css" rel="stylesheet" />-->
			
		<!--<script type="text/javascript" src="/assets/js/jquery203.js"></script>-->	
		<script type="text/javascript" src="/kendoui/js/jquery.min.js"></script>	
		<!--<script type="text/javascript" src="/assets/js/migrate121.js"></script>-->
		<!--<script type="text/javascript" src="/assets/js/jQuery1.3.js"></script>
        <script type="text/javascript" src="/assets/js/jQuery1.7.js"></script>
        <script type="text/javascript" src="/assets/js/jQueryUI1.7.2.js"></script>-->
        <!--<script type="text/javascript" src="/assets/js/jQuery1.4.js"></script>
        <script type="text/javascript" src="/assets/js/jQueryUI1.8.js"></script>-->
		<script type="text/javascript" src="/kendoui/js/kendo.web.min.js"></script>
        <script type="text/javascript" src="/assets/js/jMenu.js"></script>
    	<!--<script type="text/javascript" src="/kendoui/examples/content/shared/js/console.js"></script>-->
		<script type="text/javascript" src="/assets/js/jquery.csv.js"></script>		
        <!--<script type="text/javascript" src="/assets/js/twFile.js"></script>-->
		
        <script type="text/javascript" src="/assets/js/function.js"></script>
		<link type="text/css" href="/assets/css/codeIgniter/public/style.css" rel="stylesheet" />

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
				width: 75%;
				height: auto;
				margin: 0 auto; /**/
				padding: 10px 0;
			}
			#main-wrapper div.wrap-header, #main-wrapper div.wrap-grid, #main-wrapper div.wrap-form, #main-wrapper div.wrap-formRpt {
				margin-bottom: 5px; /**/
			}
			#windowMain-wrapper div.windowWrap-header, #windowMain-wrapper div.windowWrap-grid, #windowMain-wrapper div.windowWrap-form, #windowMain-wrapper div.windowWrap-formRpt {
				margin-bottom: 5px; /**/
			}
			.demo-section, #window .demo-section {
				padding: 5px; /**/
				margin-bottom: 5px !important; /**/
			}
			.demo-section:last-child, #window .demo-section:last-child {
				margin-bottom: 0 !important; /**/
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
			.wrap-header label, .windowWrap-header label {
				margin-right: 10px;				
			}
			.wrap-header input[type="radio"], .windowWrap-header input[type="radio"] {
				margin-bottom: 10px;
			}
			.k-textbox {
				width: 100%;
			}
			.wrap-form {
				height: 236px;
			}
			#window .wrap-form {
				height: 114px;
			}
			#window .windowWrap-form {
				height: 111px;
			}
			.wrap-formRpt {
				display: block;
				height: auto;
			}
			.wrap-form ul, .windowWrap-form ul {
				width: 49.5%;
				float: left;
				margin-right: 5px;
			}
			.wrap-formRpt ul {
				width: 100%;
			}
			.wrap-form ul li, .wrap-formRpt ul li, .windowWrap-form ul li {
				margin-bottom: 5px;
			}
			.wrap-form ul li:last-child, .wrap-formRpt ul li:last-child, .windowWrap-form ul li:last-child {
				margin-bottom: 0;
			}
			.wrap-form ul li label.title, .windowWrap-form ul li label.title {
				width: 35%;
				float: left;
				text-align: right;
				margin-right: 5px;
			}
			.wrap-formRpt ul li label.title {
				width: 35%;
				float: left;
				text-align: right;
				margin-right: 5px;
			}
			.short {
				float: none !important;
				margin-right: 4px !important;
				width: auto !important;
			}
			.wrap-form ul li input[type="text"], .windowWrap-form ul li input[type="text"] {
				width: 50%;
			}
			.wrap-formRpt ul li input {
				width: 63%;
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
			label.chk {
				width: auto !important;
			}
			.formRight {
				width: 49.5%;
				height: 195px;
				display: block;
				float: right;
			}
			#window .formRight, #window .windowFormRight {
				width: 49.5%;
				height: 111px;
				display: block;
				float: right;
			}
			.wrap-button, .windowWrap-button {
				height: 25px;
			}
			.buttonLeft, .windowButtonLeft {
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
				resize: none;
				text-indent: 4px;
			}
			#window .taClass textarea {
				width: 100%;
				height: 24px;
				position: relative;
				padding-top: 25px;				
			}
			#window, #uplWindow {
				display: none;
				overflow: hidden !important;
			}
			/*#window .demo-section {
				margin: 0 !important;
			}*/
			.wrap-buttonUpl, .windowWrap-buttonUpl {
				margin-top: 5px;
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
			#jMenu li {
				width: 180px !important;
			}
			.k-grid tbody tr{
			    height: 27px;
			}			 
			.k-grid td{
			    white-space: nowrap;
			}
			.k-grid-header {
				padding-right: 0 !important;
			}
			.k-grid-content {
				overflow-y: hidden !important;
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
		        $("#closeButt").click(function(){
		        	$("#main-wrapper").html("");
		        });
			});
		</script>
    </head>
    <body>
		<div id="window" data-role="window" data-bind="kendoWindow: { async: true, isOpen: false}"></div>
		<div id="arccHead">
			<span class="app"> <?php echo (isset($header)) ? $header : ""; ?> </span>
			<span class="user"> <?php echo (isset($user_name)) ? $user_name : ""; ?> | <a href="/codeIgniter/index.php/webapps/pub/offCredentials/"> Sign-Out </a> </span> <!--http://localhost-->
		</div>
		<div id="arccWrapper">