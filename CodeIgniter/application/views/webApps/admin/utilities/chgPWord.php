<div class="utilitiesBox mainContent">
    <span class="title"></span>
    <?php
	    $inputs = array("passWord_old","passWord","passWord_conf");
	    echo validation_errors();
	    echo form_label("Old Password:",$inputs[0]);
	    echo form_password(array("name"=>$inputs[0],"id"=>$inputs[0]));
	    echo form_label("New Password:",$inputs[1]);
	    echo form_password(array("name"=>$inputs[1],"id"=>$inputs[1]));
	    echo form_label("Confirm Password:",$inputs[2]);
	    echo form_password(array("name"=>$inputs[2],"id"=>$inputs[2]));
	    //echo form_submit("buttSave","Save");
	    echo form_submit(array("name"=>"buttSave","id"=>"buttSave","value"=>"Save"));
	?>
</div>
<div id="hidDiv"></div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		$.each($("#leftUtilPhase ul").children(), function(index, value){
			if (value.className == "currLeftNav")
				$(".utilitiesBox span.title").html($(value).text());
		});
	});
</script>