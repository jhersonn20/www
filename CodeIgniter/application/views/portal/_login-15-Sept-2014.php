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
		<link href="/assets/css/portal/styles_login.css" type="text/css" rel="stylesheet"></link>		
        <script type="text/javascript" src="/assets/js/jQuery1.7.js"></script>
        <script type="text/javascript" src="/assets/js/portal/events.js"></script>	
        <script type="text/javascript" src="/assets/js/function.js"></script>        
		<script type="text/javascript" src="/kendoui/js/jquery.min.js"></script>
		<script type="text/javascript" src="/kendoui/js/kendo.web.min.js"></script>
		<script type="text/javascript" src="/assets/js/jquery.pnotify.js"></script>
        <script type="text/javascript" src="/assets/js/jQuery.browser.min.js"></script>
    </head>
    <body>
		<div id="login_header"></div>
		<div id="login">
			<form action="/codeIgniter/index.php/portal/index/validateCredentials/" method="post" id="myForm"> <!--http://localhost/-->
				<ul>
					<li><label for="userName" class="title">User ID</label></li>
					<li><input type="text" class="k-textbox" name="userName" id="userName" value="<?php echo (isset($user) ? $user : ""); //$_POST['userName'] ?>"></li>
					<li><label for="passWord" class="title">Password</label></li>
					<li><input type="password" class="k-textbox" name="passWord" id="passWord"></li>
					<li><button class="k-button" name="buttLogin" id="buttLogin">Login</button></li>
				</ul>
			</form>
		</div>
	</body>
	<script type="text/javascript">
		$(document).ready(function(){
		if ($("#userName").val() == "")
	        $("#userName").select().focus();
	    else
	        $("#passWord").select().focus();
        
        if (<?php echo (isset($error)) ? ($error != "") : 0; ?>)
        	showNotif("Information",'<?php echo (isset($error)) ? $error : ""; ?>',"information");
    		// $("#userName").bind({
    			// blur: function(){
			        // $.post("/codeIgniter/index.php/portal/index/directCall/user_",{user_id: $("#userName").val()},
			        	// function(data){
			        		// if (data.rows.length == 0){
			        			// $("#buttLogin").prop("disabled", true).addClass("k-state-disabled");
			        			// //$("#passWord").prop("disabled", true).addClass("k-state-disabled");
			        			// $("#userName").select().focus();
			        		// }else{
			        			// //$("#passWord").prop("disabled", false).removeClass("k-state-disabled").select().focus();
			        			// //$("#buttLogin").prop("disabled", false).removeClass("k-state-disabled");
			        			// if (parseInt(data.rows[0]['needChange']) == 1){				        				
							        // $.post("/codeIgniter/index.php/webapps/templateLoader/index/tmpl_changePassword",{userID: data.rows[0]['user_id'],userName: data.rows[0]['user_name'],PROGRESS_RECID: data.rows[0]['PROGRESS_RECID'], needChange: 1},
							        	// function(data){
							            	// $("#window").html(data);
							        	// });
// 							        	
									// $("#window").data("kendoWindow").setOptions({
									    // title: "Change Password",
									    // width: "500px",
									    // height: "166px"
									// });
        							// $("#window").data("kendoWindow").center().open();
			        			// }
			        		// }				        		
			        	// });
    			// }
    		// });
    		$("#passWord").bind({
    			keyup: function(e){
    				if (this.value != "")
			        	$("#buttLogin").prop("disabled", false).removeClass("k-state-disabled");
			        else
			        	$("#buttLogin").prop("disabled", true).addClass("k-state-disabled");
    			}
    		})
		});
	</script>
</html>