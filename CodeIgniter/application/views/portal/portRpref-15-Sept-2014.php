<style>
	#win_main-wrapper {
		margin-top: 0;
		padding: 0;
	}
	.k-upload-files {width: 100px;}
	.buttonLeft {width: 50%;}
</style>
<div id="win_sub-wrapper">
	<div class="taClass">
		<label class="title" for="email_to">To:</label><textarea name="email_to" id="email_to"  cols="20" rows="5" style="width: 97%;height: 30px;resize: none;"></textarea>
	</div>
	<div class="taClass">
		<label class="title" for="email_cc">CC:</label><textarea name="email_cc" id="email_cc"  cols="20" rows="5" style="width: 97%;height: 30px;resize: none;"></textarea>
	</div>
	<div class="taClass">
		<label class="title" for="email_bcc">BCC:</label><textarea name="email_bcc" id="email_bcc"  cols="20" rows="5" style="width: 97%;height: 30px;resize: none;"></textarea>
	</div>
	<hr style="margin: 3px 0;" />
	<button name="save" id="save" class="k-button" style="float: right;">Save</button>
</div>	

<script type="text/javascript">
	$(document).ready(function(){ 		
	    $.post("/codeIgniter/index.php/portal/index/pref",{type: "get"},
	    	function(data){
	    		if (data != ""){
	    			$("#email_to").val(data.split(";")[0]);
	    			$("#email_cc").val(data.split(";")[1]);
	    			$("#email_bcc").val(data.split(";")[2]);
	    		}
	    	});
		$("#win_sub-wrapper button").bind({
			click: function(){
				switch(this.id){
					default:
					    $.post("/codeIgniter/index.php/portal/index/pref",{to: $("#email_to").val(), cc: $("#email_cc").val(), bcc: $("#email_bcc").val(), type: "set"},
					    	function(data){
					    		if (data != 1)
					    			showNotif("Warning",data,"warning");
					    		else					    		
					    			showNotif("Information","Preferences Saved!","information");					    		
					    	});
						break;
				}
	    	}
		});
	});
</script>
