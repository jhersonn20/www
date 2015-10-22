<style>
	@-moz-document url-prefix() {
		.navPhase {
			width: 77.5% !important;
			float: right;
		}
		.page_nav {
			height: 502px;
		}
	}
</style>
<?php 
	$attributes = array("name" => "navForm");
	echo form_open($formAction, $attributes);
?>		
	<div class="boxContainer">
	    <div class="sysPhase mainContent">
	        <span class="title">System</span>        
			<!--<select name="selSys" id="selSys" style="width: 100%;"></select>-->
			<select name="selSys" id="selSys" style="width: 210px;" onchange="window.location.href = '/codeIgniter/index.php/webapps/admin/setup/menu/ul/' + this.value;">
				<option value="default">Application Name...</option>
				<?php
					if (isset($rowArraySystem) && $rowArraySystem != ""){
						foreach ($rowArraySystem as $value):
				?>
				<option <?php echo (($selSys == $value['appl_code']) ? "selected" : ""); ?> value="<?php echo $value['appl_code']; ?>"> <?php echo $value['appl_name']; ?> </option>
				<?php
						endforeach;
					}
				?>
			</select>
	    </div>
	    <div class="viewPhase mainContent">
	        <span class="title">Views</span>
	        <input type="text" name="txtSrcView" id="txtSrcView" class="k-textbox" style="width: 210px;" />
	        <div class="dirPhase">
	            <ul>
	            <?php
	            	//if (isset($map) && $map){
	            	//	foreach($map as $key => $value):
	            	//		if (!is_array($value)){ ?>
<!-- 	                <li><label for="viewChk<?php echo $key; ?>"> <input type="checkbox" name="viewChk[]" id="viewChk<?php echo $key; ?>" value="<?php echo $value; ?>" /> <?php echo $value; ?> </label></li> -->
	            <?php
							//}
	            	//	endforeach;
					//}
	            ?>
	            </ul>
	        </div>
	        <div class="viewFooter mainContentF">
	            <span class="view"> Select All </span>
	            <input type="button" name="addButt" id="addButt" value="Add to Menu" />
	        </div>
	    </div>
	    <div class="custViewPhase mainContent">
	        <span class="title">Custom Views</span>
	        <div class="custViewBody">
	            <label for="txtLabel">Label: </label>
	            <input type="text" name="txtLabel" id="txtLabel" class="k-textbox" style="width: 165px;" />
	            <label for="txtPath">Path: </label>
	            <input type="text" name="txtPath" id="txtPath" class="k-textbox" style="width: 165px;" />
	        </div>
	        <div class="custViewFooter mainContentF">
	            <input type="button" name="custAddButt" id="custAddButt" value="Add to Menu" />
	        </div>
	    </div>
	</div>
	<div class="navPhase mainContent">        
	    <span class="title">Navigation List</span>
	    <div class="page_nav">
	        <div class="page_inner_nav">
	            <div class="col01"></div>
	        </div>
	    </div>
	    <div class="navFooter mainContentF">        
	        <input type="button" name="printButt" id="printButt" value="Print" />
	        <input type="button" name="saveButt" id="saveButt" value="Save" />
	    </div>
	</div>
	<input type="hidden" name="jsonData" id="jsonData" />
	<div id="hidDiv">
	    <?php
	        $menu = 0;
	        if (isset($nav['0']['mtitle']) && ltrim($nav['0']['mtitle']) != ""){
	            foreach($nav as $navList):
	                echo "<ul id='" . (($navList['subcode'] != 0) ? $navList['subcode'] : "sitemap") . "'>";
	    ?>
	        <li id="<?php echo $navList['menucode']; ?>">
	            <dl class="sm2_s_published">
	                <dt>
	                    <span class="sm2_title"><?php echo ucfirst($navList['mtitle']); ?></span>
	                </dt>
	                <dd class="sm2_actions">
	                    <span class="sm2_delete <?php echo $navList['PROGRESS_RECID']; ?>" title="Delete">Delete</span>
	                    <span class="sm2_edit" title="Edit">Edit</span>
	                </dd>
	                <dd class="sm2_status">
	                    <span class="sm2_pub" title="Published" style="display: <?php echo (($navList['publish'] != 0) ? "block" : "none"); ?>">Published</span>
	                    <span class="sm2_workFlow" title="Draft Exists" style="display: <?php echo (($navList['publish'] != 0) ? "none" : "block"); ?>">Draft Exists</span>
	                </dd>
	                <div id="menuDtls">
	                    <label for="txtLabel">Label: </label><input type="text" name="txtLabel" id="txtLabel" class="k-textbox" value="<?php echo ucfirst($navList['mtitle']); ?>" />
	                    <label for="txtPath">Path: </label><input type="text" name="txtPath" id="txtPath" class="k-textbox" value="<?php echo $navList['progname']; ?>" />
	                    <label for="txtParam">Parameter: </label><input type="text" name="txtParam" id="txtParam" class="k-textbox" value="<?php echo $navList['param']; ?>" />
	                </div>
	            </dl>
	        </li>
	    <?php
	                echo "</ul>";
	            endforeach;
	        }
	    ?>
	</div>
</form>
<script type="text/javascript" src="/assets/js/ul.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var isArr = eval("(" + '<?php echo json_encode($map); ?>' + ")");
		$.each(isArr, function(index,value){
			if (typeof value != "object")
				$(".dirPhase > ul").append("<li><label for='viewChk" + index + "'> <input type='checkbox' name='viewChk[]' id='viewChk" + index + "' value='" + value + "' /> " + value + " </label></li>");
		});
		
		$("#txtSrcView").keyup(function(){
			var searchChar = this.value;
			$(".dirPhase > ul").html("");
			$.each(isArr, function(index,value){
				if (typeof value != "object")
					if (strpos(value, $.trim(searchChar)) !== false)
						$(".dirPhase > ul").append("<li><label for='viewChk" + index + "'> <input type='checkbox' name='viewChk[]' id='viewChk" + index + "' value='" + value + "' /> " + value + " </label></li>");
			});
		});
	});
</script>
