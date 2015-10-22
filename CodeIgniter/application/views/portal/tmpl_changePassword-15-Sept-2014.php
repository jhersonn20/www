<!--<script type="text/x-kendo-template" id="changePassword">-->
	<ul>
		<li>
			<label class="title" for="user">User Name:</label><input type="text" name="user" id="user" class="k-textbox" disabled style="width: 67%;" value="<?php echo $_POST['userName']; ?>">
		</li>
		<!-- <li>
			<label class="title" for="currPass">Current Password:</label><input type="password" name="currPass" id="currPass" class="k-textbox" <?php //echo ((isset($_POST['pword']) || isset($_POST['needChange'])) ? "disabled" : ""); ?> style="width: 67%;" value="<?php //echo (isset($_POST['pword']) ? $_POST['pword'] : ""); ?>">
		</li> -->
		<li>
			<label class="title" for="newPass">New Password:</label><input type="password" name="newPass" id="newPass" class="k-textbox"  <?php //(isset($_POST['needChange']) ? "" : "disabled"); ?> style="width: 67%;">
		</li>
		<li>
			<label class="title" for="confPass">Confirm Password:</label><input type="password" name="confPass" id="confPass" class="k-textbox" <?php //echo ((isset($_POST['pword']) || isset($_POST['needChange'])) ? "" : "disabled"); ?> style="width: 67%;">
		</li>
	</ul>
	<hr style="margin-bottom: 5px;" />
	<div class="buttonRight">
		<button type="button" class="k-button mainEve k-state-disabled" id="applyButt" disabled>Apply</button>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
		    //$("#currPass").select().focus();
		    //var pathArray = window.location.href.split("/");
			$("#subWindow input").bind({
				blur: function(){
					if (this.id == "currPass"){
						if (!$("#currPass").is(":disabled")){
							$.post("http://" + $(location).attr("hostname") + "/codeIgniter/index.php/webApps/ln_setup/get_rowArray/users",{user_id: $("#hidd_w_userID").val(), password: $("#currPass").val()},
							function(data){
								if (data == "Array"){
									$("#currPass").prop("disabled", true);
									$("#newPass").prop("disabled", false).select().focus();
								}
							});
						}
					}
				},
				keyup: function(){
					if (this.id == "newPass" && this.value != ""){
						if ($("#confPass").val() != ""){
							$("#applyButt").prop("disabled", !(this.value == $("#confPass").val()));
							if (this.value == $("#confPass").val())
								$("#applyButt").removeClass("k-state-disabled");
							else
								$("#applyButt").addClass("k-state-disabled");
						}
						$("#confPass").prop("disabled", false);
					}else if (this.id == "confPass"){
						$("#applyButt").prop("disabled", !(this.value == $("#newPass").val()));
						if (this.value == $("#newPass").val())
							$("#applyButt").removeClass("k-state-disabled");
						else
							$("#applyButt").addClass("k-state-disabled");
					}
				}
			});
			$("#applyButt").click(function(){
				//alert($(location).attr("hostname"));
				$.post("http://" + $(location).attr("hostname") + "/codeIgniter/index.php/portal/index/manage/user",{user_id: $("#user").val(), currPass: $("#currPass").val(), password: $("#newPass").val(), id: <?php echo $_POST['id']; ?>, log_user: "rcgomez"},
				function(data){
					if (data != 1){
						showNotif("Warning",data,"warning");
					}else {
						showNotif("Information","Password successfully changed!","information");
						$("#subWindow").data("kendoWindow").close();
					}
				});
			});
		});
	</script>