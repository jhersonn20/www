<?php
    $inputs = array("userName","passWord");
    echo validation_errors();
    echo form_open("login/validateCredentials/", $attributes);
    echo form_fieldset("Login:");
    echo form_label("Username:",$inputs[0]);
    echo form_input(array("name"=>$inputs[0],"id"=>$inputs[0]));
    echo form_label("Password:",$inputs[1]);
    echo form_password(array("name"=>$inputs[1],"id"=>$inputs[1]));
    echo form_submit("buttLogin","Login");
    echo anchor("login/signup/","Sign-Up");
    echo form_fieldset_close();
?>
</form>
<script type="text/javascript">
</script>