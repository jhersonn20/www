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
	<label class="title" for="file_size">Max. Upload File Size (MB):</label><input name="file_size" id="file_size" class="k-textbox" disabled value="<?php echo (int)(ini_get('upload_max_filesize')); ?>" style="width: 54%;" />
	<hr style="margin: 3px 0;" />
	<button name="save" id="save" class="k-button" style="float: right;" <?php echo (isset($_POST['dept'])) ? ($_POST['dept'] == "MIS" ? "" : "disabled") : ""; ?>>Save</button>
</div>	

<script type="text/javascript">
	$(document).ready(function(){ 		
	    $.post("/codeIgniter/index.php/portal/index/file_ref",{type: "get"},
	    	function(data){
	    		if (data != ""){
	    			$("#file_type").val(data.split(";")[0]);
	    		}
	    	});
		$("#win_sub-wrapper button").bind({
			click: function(){
				switch(this.id){
					default:
					    $.post("/codeIgniter/index.php/portal/index/file_ref",{file_types: $("#file_type").val(), type: "set"},
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
