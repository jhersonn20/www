<!--<script type="text/x-kendo-template" id="changePassword">-->
	<ul>
		<li>
			<label class="title" for="user">User Name:</label><input type="text" name="user" id="user" class="k-textbox" disabled style="width: 67%;" value="<?php echo $_POST['userName']; ?>">
		</li>
		<li>
			<label class="title" for="currPass">Current Password:</label><input type="password" name="currPass" id="currPass" class="k-textbox" <?php echo ((isset($_POST['pword']) || isset($_POST['needChange'])) ? "disabled" : ""); ?> style="width: 67%;" value="<?php echo (isset($_POST['pword']) ? $_POST['pword'] : ""); ?>">
		</li>
		<li>
			<label class="title" for="newPass">New Password:</label><input type="password" name="newPass" id="newPass" class="k-textbox"  <?php (isset($_POST['needChange']) ? "" : "disabled"); ?> style="width: 67%;">
		</li>
		<li>
			<label class="title" for="confPass">Confirm Password:</label><input type="password" name="confPass" id="confPass" class="k-textbox" <?php echo ((isset($_POST['pword']) || isset($_POST['needChange'])) ? "" : "disabled"); ?> style="width: 67%;">
		</li>
	</ul>
	<input type="hidden" name="hidd_w_userID" id="hidd_w_userID" value="<?php echo $_POST['userID']; ?>">
	<input type="hidden" name="hidd_w_PROGRESS_RECID" id="hidd_w_PROGRESS_RECID" value="<?php echo $_POST['PROGRESS_RECID']; ?>">
	<hr style="margin-bottom: 5px;" />
	<div class="buttonRight">
		<button type="button" class="k-button mainEve k-state-disabled" id="applyButt" disabled>Apply</button>
	</div>
	<script type="text/javascript" src="/assets/js/webapps/changePassword.js"></script>
<!--</script>-->