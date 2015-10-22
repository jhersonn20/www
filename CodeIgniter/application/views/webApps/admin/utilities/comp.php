<div class="utilitiesBox mainContent">
    <span class="title"> Company Set-up </span>
	<div class="wrap-form demo-section">
		<ul class="formLeft" style="width: 100%;">
	    	<li>
	    		<label class="title" for="txt1">Company Name:</label><input type="text" required name="txt1" id="txt1" class="k-textbox" disabled style="width: 500px;">
	    	</li>
			<li>
				<label class="title" for="txt2">Company Address:</label><input type="text" required name="txt2" id="txt2" class="k-textbox" disabled style="width: 500px;">
			</li>
			<li>
				<label class="title" for="txt3">Quantity Resource:</label><input type="text" name="txt3" id="txt3" class="k-textbox" disabled style="width: 500px;">
			</li>
		</ul>
	</div>
	<div class="wrap-button demo-section">
		<div class="buttonLeft">
        	<button type="button" class="k-button" id="saveButt">Save</button>
        	<button type="button" class="k-button" id="canButt">Cancel</button>
        	<!--<button type="button" class="k-button mainEve" id="addButt">Add</button>
        	<button type="button" class="k-button mainEve" id="delButt">Delete</button>-->
        	<button type="button" class="k-button mainEve" id="editButt">Edit</button>
       	</div>
		<div class="buttonRight">
        	<!--<button type="button" class="k-button mainEve" id="changeButt">Change Password</button>
        	<button type="button" class="k-button mainEve" id="printButt">Print</button>-->
       	</div>
	</div>
</div>
<div id="hidDiv"></div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var PROGRESS_RECID;
		$.get("/codeIgniter/index.php/webapps/ln_utilities/directCall/comp",{},
		function(data){
			$("#txt1").val(data.rows[0][0].company_name);
			$("#txt2").val(data.rows[0][0].address);
			$("#txt3").val(data.rows[0][0].res_code);
			PROGRESS_RECID = data.rows[0][0].PROGRESS_RECID;
		});
		$(".wrap-button button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();									
		});
		$(".wrap-button button").bind({
			click: function(){
				switch (this.id){
					case "editButt":
						$(".formLeft input").each(function(index,value){
							$(this).prop("disabled", false);
						});
						$(".wrap-form ul li:first-child input").select().focus();
						$(".wrap-button button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).hide();
							else
								$(this).show();									
						});
					break;
					case "saveButt":
	        			if (confirm("Are you sure you want to save all changes?")){
					        $.post("/codeIgniter/index.php/webapps/ln_utilities/manage/comp",{PROGRESS_RECID: PROGRESS_RECID, company_name: $("#txt1").val(), address: $("#txt2").val(), res_code: $("#txt3").val()},
					       	    function(data){
					       	    	alert("Record successfully saved!");
					       	    });
					       	    
							$(".formLeft input").each(function(index, value){
								$(this).prop("disabled", true);
							});
							$(".wrap-button button").each(function(index,value){
								if ($(this).hasClass("mainEve"))
									$(this).show();
								else
									$(this).hide();									
							});
						}
					break;
					case "canButt":
	        			if (confirm("Are you sure you want to cancel all changes?")){
							$(".formLeft input").each(function(index, value){
								$(this).prop("disabled", true);
							});
							$(".wrap-button button").each(function(index,value){
								if ($(this).hasClass("mainEve"))
									$(this).show();
								else
									$(this).hide();									
							});
						}
					break;
					case "printButt":
						var rpt_name = "company";
						$.post("/codeIgniter/index.php/webapps/to_pdf",{rpt_name: rpt_name},
							function(data){
								if (data == "true")
									to_pdf("Company",rpt_name);
								else
									alert(data);
							});
					break;
				}
			}
		});
	});
</script>