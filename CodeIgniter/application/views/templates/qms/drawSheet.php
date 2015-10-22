<div id="windowMain-wrapper" style="width: 100%;">	
	<div class="wrap-form demo-section apply8" style="height: auto;">
		<fieldset>
			<ul style="width: 100%;">
				<li>
					<label class="title" for="win2_txt1" style="width: 85px;">Drawing No.:</label><input type="text" name="win2_txt1" id="win2_txt1" class="k-textbox" style="width: 148px;" />
				</li>
				<li>
					<label class="title" for="win2_txt2" style="width: 85px;">Sheet No.:</label><input type="text" name="win2_txt2" id="win2_txt2" class="k-textbox" style="width: 148px;" />
				</li>
			</ul>
		</fieldset>
	</div>
	<div class="windowWrap-button demo-section">
		<div class="buttonLeft">
        	<button class="k-button mainEve" id="okButt">Ok</button>
       	</div>				
	</div>
</div>
<input type="hidden" name="window_hidd_userID" id="window_hidd_userID" value="<?php echo (isset($_POST['userID'])) ? $_POST['userID'] : ""; ?>">
<script type="text/javascript">
	$(document).ready(function(){
		var disc_code = pathname.split('/')[pathname.split('/').length - 1];		
		// var disc_code = "<?php //echo $_POST['disc_code']; ?>";
		switch(disc_code.toLowerCase()){
			case "strl":
			case "mech":
			case "ps":
			case "inst":
			case "ele":
			case "spl":
			case "psf":
				$("#windowMain-wrapper").find("ul > li:eq(1)").hide();
			break;
			case "ps":
				$($("#windowMain-wrapper").find("label")[0]).text("PS Code:");
				$($("#windowMain-wrapper").find("label")[1]).text("PS Type:");
			break;
			default:
			break;
		}
		$("#subWindow button").click(function(){
			if ($("#win2_txt1").val() == "")
				$("#subWindow input").val("<ALL>");
			$("#subWindow").data("kendoWindow").close();
		});
	});
</script>