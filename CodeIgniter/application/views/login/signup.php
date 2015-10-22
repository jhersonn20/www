<?php
    $inputs = array("userName","passWord");
    echo validation_errors();
    echo form_open("login/addCredentials/", $attributes);
    echo form_fieldset("Signup:");
    echo form_label("Username:",$inputs[0]);
    echo form_input(array("name"=>$inputs[0],"id"=>$inputs[0],"value"=>set_value('userName')));
    echo form_label("Password:",$inputs[1]);
    echo form_password(array("name"=>$inputs[1],"id"=>$inputs[1]));
    echo form_label("Confirm Password:",$inputs[1] . "1");
    echo form_password(array("name"=>$inputs[1] . "1","id"=>$inputs[1] . "1"));
    echo form_submit("buttSignup","Signup");
    echo anchor("login/","Login");
    echo form_fieldset_close();
?>
</form>
<script type="text/javascript"></script>