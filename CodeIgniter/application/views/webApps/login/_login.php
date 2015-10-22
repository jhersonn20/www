<?php
	/*$inputs = array("userName","passWord");
		    echo validation_errors();
		    echo form_open("webapps/index/validateCredentials/", $attributes);
		    echo form_fieldset("Login:");
		    echo form_label("Username:",$inputs[0]);
		    echo form_input(array("name"=>$inputs[0],"id"=>$inputs[0]));
		    echo form_label("Password:",$inputs[1]);
		    echo form_password(array("name"=>$inputs[1],"id"=>$inputs[1]));
		    echo form_submit("buttLogin","Login");
		    echo form_fieldset_close();
			echo "</form>";*/
?>
<div class="login-header"></div>
<div class="login-form">
	<form action="/codeIgniter/index.php/webapps/index/validateCredentials/" method="post" id="myForm"> <!--http://localhost/-->
		<ul>
			<li><label for="userName" class="title">User ID</label></li>
			<li><input type="text" class="k-textbox" name="userName" id="userName" value="<?php echo (isset($user) ? $user : ""); //$_POST['userName'] ?>"></li>
			<li><label for="passWord" class="title">Password</label></li>
			<li><input type="password" class="k-textbox" name="passWord" id="passWord"></li>
			<li><button class="k-button k-state-disabled" name="buttLogin" id="buttLogin" disabled style="float: right;">Login</button></li>
		</ul>
	</form>
</div>