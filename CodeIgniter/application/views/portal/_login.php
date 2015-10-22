<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"> 
        <base href="<?=base_url();?>">
        <title> Official Web Portal of ARCC </title>
        <link rel="icon" type="image/ico" href="http://www.arcc-eei.com/assets/images/portal/favicon.ico"></link>
		<link href="/assets/css/portal/styles_all.css" type="text/css" rel="stylesheet"></link>
		<link href="/assets/css/portal/styles_login.css" type="text/css" rel="stylesheet" media="screen"></link>
        <script type="text/javascript" src="/assets/js/portal/events_all.js"></script>
    </head>
    <body>
		<div id="login_header"></div>
		<div id="login">
			<form action="<?php echo "/codeigniter/index.php/portal"; ?>/index/validateCredentials/" method="post" id="myForm"> <!--http://localhost/-->
				<ul>
					<li><label for="userName" class="title">User ID</label></li>
					<li><input type="text" class="k-textbox" name="userName" id="userName" value="<?php echo (isset($user) ? $user : ""); //$_POST['userName'] ?>"></li>
					<li><label for="passWord" class="title">Password</label></li>
					<li><input type="password" class="k-textbox" name="passWord" id="passWord"></li>
					<li><input type="hidden" name="browserDtls" id="browserDtls" /><button class="k-button" name="buttLogin" id="buttLogin">Login</button></li>
					<li>
						<table style="widht: 155px;height: 55px;margin: 150px auto 0 auto;" width="135" border="0" cellpadding="2" cellspacing="0" title="Click to Verify - This site chose GeoTrust SSL for secure e-commerce and confidential communications.">
							<tr>
								<td width="135" align="center" valign="top">
									<script type="text/javascript" src="https://seal.geotrust.com/getgeotrustsslseal?host_name=portal.arcc-eei.com&amp;size=S&amp;lang=en"></script><br />
									<a href="http://www.geotrust.com/ssl/" target="_blank"  style="color:#000000; text-decoration:none; font:bold 7px verdana,sans-serif; letter-spacing:.5px; text-align:center; margin:0px; padding:0px;"></a>
								</td>
							</tr>
						</table>
					</li>
				</ul>
			</form>
		</div>
	</body>
	<script type="text/javascript">
		$(document).ready(function(){
			check_browser();
	        if (<?php echo (isset($error)) ? ($error != "") : 0; ?>)
	        	showNotif("Information",'<?php echo (isset($error)) ? $error : ""; ?>',"information");
		});
	</script>
</html>