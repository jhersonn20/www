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
		<label class="title" for="file_type">File Types:</label><textarea name="file_type" id="file_type" <?php echo (isset($_POST['dept'])) ? ($_POST['dept'] == "MIS" ? "" : "disabled") : ""; ?> cols="20" rows="5" style="width: 97%;height: 30px;resize: none;"></textarea>
	</div>
	<ul>
		<li><label class="title" for="file_size" style="width: 45%;">Max. Upload File Size (MB):</label><input name="file_size" id="file_size" class="k-textbox" disabled value="<?php echo (int)(ini_get('upload_max_filesize')); ?>" style="width: 53.5%;" /></li>
		<li><label class="title" for="dl_speed" style="width: 45%;">Download Speed (KB):</label><input name="dl_speed" id="dl_speed" class="k-textbox" style="width: 53.5%;" /></li>
	</ul>
	<hr style="margin: 3px 0;" />
	<button name="save" id="save" class="k-button" style="float: right;" <?php echo (isset($_POST['dept'])) ? ($_POST['dept'] == "MIS" ? "" : "disabled") : ""; ?>>Save</button>
</div>	

<script type="text/javascript">
	$(document).ready(function(){ 		
	    $.post("/index/file_ref",{type: "get"},
	    	function(data){
	    		if (data != ""){
	    			$("#file_type").val(data.split(";")[0]);
	    			$("#dl_speed").val(data.split(";")[1]);
	    		}
	    	});
		$("#win_sub-wrapper button").bind({
			click: function(){
				switch(this.id){
					default:
					    $.post("/index/file_ref",{file_types: $("#file_type").val(), dl_speed: $("#dl_speed").val(), type: "set"},
					    	function(data){
					    		if (data != 1)
					    			showNotif("Warning",data,"warning");
					    		else					    		
					    			showNotif("Information","File References Saved!","information");					    		
					    	});
						break;
				}
	    	}
		});
	});
</script>
