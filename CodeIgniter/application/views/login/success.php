<?php
    $inputs = array("userName","passWord");
    echo validation_errors();
    echo form_open("login/offCredentials/", $attributes);
    echo form_fieldset("Information:");
    echo form_label("Username:",$inputs[0]);
    echo form_input(array("name"=>$inputs[0],"id"=>$inputs[0],"value"=>$users_item['user']));
    echo form_label("Password:",$inputs[1]);
    echo form_input(array("name"=>$inputs[1],"id"=>$inputs[1],"value"=>$users_item['pWord']));
    echo form_submit(array("name"=>"buttLogout","id"=>"buttLogout","value"=>"Log-out"));
    echo form_fieldset_close();
    echo form_fieldset("Email:");
    echo form_label("From:","txtFrom");
    echo form_input(array("name"=>"txtFrom","id"=>"txtFrom"));
    echo form_label("To:","txtTo");
    echo form_input(array("name"=>"txtTo","id"=>"txtTo"));
    echo form_label("Subject:","txtSubject");
    echo form_input(array("name"=>"txtSubject","id"=>"txtSubject"));
    echo form_label("Message:","txtMessage");
    echo form_input(array("name"=>"txtMessage","id"=>"txtMessage"));
    echo form_submit(array("name"=>"buttSend","id"=>"buttSend","value"=>"Send"));
    echo form_fieldset_close();
?>
</form>
<script type="text/javascript">
</script>