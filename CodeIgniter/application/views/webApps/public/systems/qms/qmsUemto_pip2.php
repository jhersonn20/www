<div id="windowMain-wrapper" style="width: 100%;">	
	<div class="wrap-form demo-section apply8" style="height: auto;">
		<fieldset>
			<ul style="width: 100%;">
				<li>
					<label class="title" for="win2_txt1" style="width: 120px;">Area No.:</label><input type="text" name="win2_txt1" id="win2_txt1" class="k-textbox" required style="width: 148px;" />
				</li>
				<li>
					<label class="title" for="win2_txt2" style="width: 120px;">Drawing No.:</label><input type="text" name="win2_txt2" id="win2_txt2" class="k-textbox" required style="width: 148px;" />
				</li>
				<li>
					<label class="title" for="win2_txt3" style="width: 120px;">Sheet No.:</label><input type="text" name="win2_txt3" id="win2_txt3" class="k-textbox" required style="width: 148px;" />
				</li>
				<li>
					<label class="title" for="win2_txt4" style="width: 120px;">Rev. No.:</label><input type="text" name="win2_txt4" id="win2_txt4" class="k-textbox" required style="width: 148px;" />
				</li>
				<li>
					<label class="title" for="win2_txt5" style="width: 120px;">Spool No.:</label><input type="text" name="win2_txt5" id="win2_txt5" class="k-textbox" required style="width: 148px;" />
				</li>
				<li>
					<label class="title" for="win2_txt6" style="width: 120px;">EM or Spool:</label><input type="text" name="win2_txt6" id="win2_txt6" class="k-textbox" required style="width: 148px;" />
				</li>
				<li>
					<label class="title" for="win2_txt7" style="width: 120px;">Item Code:</label><input type="text" name="win2_txt7" id="win2_txt7" class="k-textbox" required style="width: 148px;" />
				</li>
				<li>
					<label class="title" for="win2_txt8" style="width: 120px;">Commodity Code:</label><input type="text" name="win2_txt8" id="win2_txt8" class="k-textbox" required style="width: 148px;" />
				</li>
				<li>
					<label class="title" for="win2_txt9" style="width: 120px;">Size:</label><input type="text" name="win2_txt9" id="win2_txt9" class="k-textbox" style="width: 148px;" />
				</li>
				<li>
					<label class="title" for="win2_txt10" style="width: 120px;">UOM:</label><input type="text" name="win2_txt10" id="win2_txt10" class="k-textbox" style="width: 148px;" />
				</li>
				<li>
					<label class="title" for="win2_textarea" style="width: 120px;">Matl. Desc.:</label><textarea name="win2_textarea" id="win2_textarea" cols="20" rows="3" style="resize: none;width: 137px;margin: 0;"></textarea>
				</li>
			</ul>
		</fieldset>
	</div>
	<div class="windowWrap-button demo-section">
		<div class="buttonRight">
        	<button class="k-button mainEve" id="saveButt">Save</button>
        	<!-- <button class="k-button mainEve" id="canButt">Cancel</button> -->
       	</div>				
	</div>
</div>
<input type="hidden" name="window_hidd_userID" id="window_hidd_userID" value="<?php echo (isset($_POST['userID'])) ? $_POST['userID'] : ""; ?>">
<script type="text/javascript">
	jQuery(document).ready(function(){	    
	    // $("#subWindow input, #subWindow textarea").each(function(index,value){
	    	// this.value = $.trim($(this).parent().find("label").text().toLowerCase());
	    // });
		$("input[required], textarea[required], select[required]").bind({
	    	blur: function(e){
	    		if ($.trim(this.value) != ""){
	    			$(this).removeClass("thisIsRequired");
	    			$(this).parent().removeClass("thisIsRequired");
	    			$(this).parent().parent().removeClass("thisIsRequired");
	    		}
	    	}
	    });
	    
	    $.each($("#windowMain-wrapper input[required], #windowMain-wrapper textarea[required], #windowMain-wrapper select[required]"), function(index,value){
	    	$(this).parent().find("label[for=" + this.id + "]").append("<span style='color: red;'>*</span>");
	    });
		$("#subWindow button").click(function(){
			isFailed = verifyThisInput("#windowMain-wrapper > .wrap-form");
    		if (isFailed)
    			return true;
    			
			$("#subWindow").data("kendoWindow").close();
		});
	});
</script>