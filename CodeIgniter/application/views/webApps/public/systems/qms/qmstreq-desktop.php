<div id="main-wrapper">
	<div class="wrap-header demo-section">
		<fieldset>
			<legend> Filter Option: </legend>
			<div style="float:right;">
				<div style="line-height: 24px;">
					<label><input type="radio" name="option2" id="option11" checked /> All </label>
					<label><input type="radio" name="option2" id="option12" /> Unfinalized </label>
					<label><input type="radio" name="option2" id="option13" /> Finalize </label>
				</div>
				<div style="line-height: 24px;">
					<label><input type="radio" name="option3" id="option21" checked /> All </label>
					<label><input type="radio" name="option3" id="option22" /> Balance </label>
					<label><input type="radio" name="option3" id="option23" /> Served </label>
				</div>
			</div>
			<div>
				<label><input type="radio" name="option1" id="option1" checked /> All </label>
				<label><input type="radio" name="option1" id="option2" /> JMIF No. </label>
				<label><input type="radio" name="option1" id="option3" /> JMIF Date </label>
				<label><input type="radio" name="option1" id="option4" /> Requested By </label>
				<label><input type="radio" name="option1" id="option5" /> Remarks </label>
			</div>
            <span class="k-textbox k-space-right" style="width: 77%;">
                <input type="text" value="" name="search" id="search" />
                <a href="#" class="k-icon k-i-search">&nbsp;</a>
            </span>
			
		</fieldset>
	</div>
	<div class="jmif_phase">
		<div id="jmifHead" style="min-height: 260px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 27.9%;float:right;height: auto;display: block;">
				<fieldset>
					<legend> JMIF Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="txt1" style="width: 105px;">JMIF No.:</label><input required type="text" name="txt1" id="txt1" class="k-textbox" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt2" style="width: 105px;">JMIF Date:</label><input required type="text" name="txt2" id="txt2" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt3" style="width: 105px;">Requested By:</label><input type="text" name="txt3" id="txt3" class="k-textbox" style="width: 155px;"/>
						</li>
						<li>
							<label class="title" for="textarea" style="width: 105px;">Remarks:</label><textarea name="textarea" id="textarea" cols="20" rows="3" style="resize: none;width: 142px;margin: 0;"></textarea>
						</li>
						<li class="liSubDate">
							<label class="title" for="txt4" style="width: 105px;">Sub. Date:</label><input type="text" name="txt4" id="txt4" style="width: 155px;"/>
						</li>
						<li class="liDateReq">
							<label class="title" for="txt5" style="width: 105px;">Date Required:</label><input required type="text" name="txt5" id="txt5" style="width: 155px;"/>
						</li>
						<li style="text-align: right;">
							<hr style="margin-bottom: 5px;" />
							<button class="k-button" disabled id="saveButt">Save</button>
							<button class="k-button" disabled id="canButt">Cancel</button>						
						</li>
					</ul>
				</fieldset>
			</div>
		    <div class="wrap-grid demo-section" style="width: 69%;margin-left: 0;height: auto;">
		        <div id="rowSelection"></div>
		    </div>
		</div>
		<div class="wrap-button demo-section apply8">
			<div class="buttonLeft">
	        	<button class="k-button mainEve" id="addButt">Add</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="editButt">Edit</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="delButt">Delete</button>
	        	<button class="k-button mainEve" id="finButt">Finalized</button>
	        	<button class="k-button mainEve" id="uplButt">Upload</button>
	       	</div>
			<div class="buttonRight">
	        	<!-- <button class="k-button mainEve" id="enggButt">ENGG MTO</button>
	        	<button class="k-button mainEve" id="updButt">Update Bulk Receiving</button>
	        	<button class="k-button mainEve" id="uplButt">Bulk Upload Receiving</button> -->
				<label class="title" for="txt24" style="width: auto;">Client Sub. Date:</label><input type="text" name="txt24" id="txt24" class="k-textbox k-state-disabled" disabled style="width: 155px;"/>
	       	</div>
		</div>
	</div>
	<div class="jmifdtl_phase" style="margin-top: 5px;">
		<div id="jmifDtlHead" style="min-height: 290px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 27.9%;float:right;height: auto;display: block;">
				<fieldset>
					<legend> JMIF Detail Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="txt6" style="width: 111px;">Stock No.:</label><input type="text" name="txt6" id="txt6" class="k-textbox" style="width: 147px;" />
						</li>
						<li class="liChk">
							<label class="title short" for="chk1" style="float: none !important;margin-left: 20px;"><input type="checkbox" name="chk1" id="chk1" /> Direct Withdraw</label>
							<label class="title short" for="chk2" style="float: none !important;"><input type="checkbox" name="chk2" id="chk2" /> No Reqd ISO</label>
						</li>
						<li>
							<label class="title" for="txt7" style="width: 111px;">Item Code:</label><input type="text" required name="txt7" id="txt7" style="width: 147px;" />
						</li>
						<li class="liComCode">
							<label class="title" for="txt8" style="width: 111px;">Comm. Code:</label><input type="text" required name="txt8" id="txt8" class="k-textbox" style="width: 147px;" />
						</li>
						<li>
							<label class="title" for="textarea2" style="width: 111px;">Mat. Desc.:</label><textarea name="textarea2" id="textarea2" cols="20" rows="3" style="resize: none;width: 134px;margin: 0;"></textarea>
						</li>
						<li class="liSuppNo">
							<label class="title" for="textarea3" style="width: 111px;">Support No.:</label><textarea name="textarea3" id="textarea3" cols="20" rows="3" style="resize: none;width: 134px;margin: 0;"></textarea>
						</li>
						<li>
							<label class="title" for="txt9" style="width: 111px;">UOM:</label><input type="text" name="txt9" id="txt9" class="k-textbox" style="width: 50px;" />
							<label class="title short" for="txt10" style="width: 40px;">Size:</label><input type="text" name="txt10" required id="txt10" class="k-textbox" style="width: 50px;" />
						</li>
						<li>
							<label class="title" for="txt11" style="width: 111px;">Activity Code:</label><input type="text" class="k-textbox" name="txt11" id="txt11" style="width: 147px;"/>
						</li>
						<li>
							<label class="title" for="txt12" style="width: 111px;">Mat. Util.:</label><input type="text" required name="txt12" id="txt12" style="width: 147px;"/>
						</li>
						<li>
							<label class="title" for="txt13" style="width: 111px;">Measurement:</label><input type="text" name="txt13" id="txt13" style="width: 147px;"/>
						</li>
						<li>
							<label class="title" for="txt14" style="width: 111px;">Requested Qty.:</label><input type="text" required name="txt14" id="txt14" style="width: 147px;"/>
						</li>
						<li>
							<label class="title" for="txt15" style="width: 111px;">Issued Qty.:</label><input type="text" name="txt15" id="txt15" style="width: 147px;"/>
						</li>
						<li class="liPlant">
							<label class="title" for="txt16" style="width: 111px;">Plant No.:</label><input type="text" name="txt16" required id="txt16" class="k-textbox" style="width: 35px;" />
							<label class="title short" for="txt17" style="width: 40px;">Area No.:</label><input type="text" name="txt17" required id="txt17" class="k-textbox" style="width: 35px;" />
						</li>
						<li>
							<label class="title" for="textarea4" style="width: 111px;">Drawing No.:</label><textarea name="textarea4" required id="textarea4" cols="20" rows="3" style="resize: none;width: 134px;margin: 0;"></textarea>
						</li>
						<li class="liSheet">
							<label class="title" for="txt18" style="width: 111px;">Sheet No.:</label><input type="text" name="txt18" required id="txt18" class="k-textbox" style="width: 36px;" />
							<label class="title short" for="txt19" style="width: 40px;">Rev. No.:</label><input type="text" name="txt19" required id="txt19" class="k-textbox" style="width: 36px;" />
						</li>
						<li class="liSpool">
							<label class="title" for="txt20" style="width: 111px;">Spool No.:</label><input type="text" class="k-textbox" required name="txt20" id="txt20" style="width: 147px;"/>
						</li>
						<li class="liSystem">
							<label class="title" for="txt21" style="width: 111px;">System:</label><input type="text" name="txt21" id="txt21" class="k-textbox" style="width: 53px;" />
							<label class="title short" for="txt22" style="width: 40px;">Sub.:</label><input type="text" name="txt22" id="txt22" class="k-textbox" style="width: 53px;" />
						</li>
						<li>
							<label class="title" for="txt23" style="width: 111px;">Testpack No.:</label><input type="text" name="txt23" id="txt23" class="k-textbox" style="width: 147px;"/>
						</li>
						<li class="liRad">
							<label class="title" for="rad1" style="width: 111px;">Type:</label><input type="radio" name="option" checked id="rad1" /><label class="title short" for="rad1">Spool</label>
																								<input type="radio" name="option" id="rad2" /><label class="title short" for="rad2" style="margin-right: 1px !important;">EM</label>
																								<input type="radio" name="option" id="rad3" /><label class="title short" for="rad3" style="margin-right: 0 !important;">Others</label>
						</li>
						<li class="liType" style="display: none;">
							<label class="title" for="txt24" style="width: 111px;">Type:</label><input type="text" name="txt24" id="txt24" class="k-textbox" style="width: 147px;"/>
						</li>
						<li style="text-align: right;">
							<hr style="margin-bottom: 5px;" />
							<button class="k-button" id="saveButt2">Save</button>
							<button class="k-button" id="canButt2">Cancel</button>						
						</li>
					</ul>
				</fieldset>
			</div>
		    <div class="wrap-grid demo-section" style="width: 69%;margin-left: 0;height: auto;">
		        <div id="jmifdtl_rs"></div>
				<fieldset style="margin-top: 5px;">
					<ul style="float: right;">
						<li>
							<label class="title" for="txt25" style="width: auto;">Log User:</label><input type="text" name="txt25" id="txt25" class="k-textbox k-state-disabled" disabled style="width: 150px;" />
							<label class="title" for="txt26" style="width: auto;">Log Date:</label><input type="text" name="txt26" id="txt26" class="k-textbox k-state-disabled" disabled style="width: 85px;" />
							<label class="title" for="txt27" style="width: auto;">Log Update:</label><input type="text" name="txt27" id="txt27" class="k-textbox k-state-disabled" disabled style="width: 215px;" />
						</li>
					</ul>
				</fieldset>
		    </div>
		</div>
		<div class="wrap-button demo-section apply8">
			<div class="buttonLeft">
	        	<button class="k-button mainEve k-state-disabled" disabled id="addButt2">Add</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="editButt2">Edit</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="delButt2">Delete</button>
<!-- 	        	<button class="k-button mainEve" id="exportButt">Export</button> -->
	        	<button class="k-button mainEve" id="enggButt">ENGG</button>
	       	</div>
			<div class="buttonRight">
	        	<button class="k-button mainEve" id="closeButt">Close</button>
	       	</div>				
		</div>
	</div>
</div>
<script type="text/javascript">
	var processMatTO = false,
		disc_code = pathname.split('/')[pathname.split('/').length - 1];
	function grid_change(e,grid){
		// if (!$("#saveButt").hasClass('k-state-disabled') || !$("#saveButt2").hasClass('k-state-disabled'))
			// return true;
		if (typeof e == "undefined")
			e = grid;
		var selectedRows = e.select();
		var selectedDataItems = [];
	    $("#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
		for (var i = 0; i < selectedRows.length; i++) {
			dataItem3 = e.dataItem(selectedRows[i]);
			if (grid == "#rowSelection"){							
			    $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea, .jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea").val("");	
        		$("#editButt, #delButt").prop("disabled", true).addClass("k-state-disabled");		        
				if ((dataItem3.finalized == 0 || dataItem3.finalized == null)){	        	
					$("#editButt, #delButt, #addButt2, #enggButt").prop("disabled", false).removeClass("k-state-disabled");
					$("#finButt").text("Finalize");
				}else {
					$("#editButt, #delButt, #addButt2, #editButt2, #delButt2, #enggButt").prop("disabled", true).addClass("k-state-disabled");
					$("#finButt").text("Unfinalize");
				}
				if (dataItem3.whse_prep == 1 || (dataItem3.finalized == 1 && dataItem3.sub_date_client != null))			        			
        			$("#finButt, #addButt2, #enggButt").prop("disabled", true).addClass("k-state-disabled");		
				$("#txt1").val(dataItem3.jmif_no);
				$("#txt2").data("kendoDatePicker").value(dataItem3.jmif_date);
				$("#textarea").val(dataItem3.remarks);
				$("#txt3").val(dataItem3.req_by);
				$("#txt4").data("kendoDatePicker").value(dataItem3.sub_date_fog);
				$("#txt5").data("kendoDatePicker").value(dataItem3.date_reqd);
				$("#txt25").val(dataItem3.LOG_user);
				$("#txt26").val(dataItem3.LOG_date);
				$("#txt27").val(dataItem3.LOG_update);
			}else {		
			    $(".jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea").val("");
			    if (!$("#addButt2").is(":disabled"))
	    			$("#editButt2, #delButt2").prop("disabled", false).removeClass("k-state-disabled");
			    $("#txt6").val($.trim(dataItem3.stock_no));
			    $("#chk1").prop("checked",(dataItem3.direct_with == 1));
			    if (disc_code != "INST")
					$("#txt7").data("kendoComboBox").text($.trim(dataItem3.item_code));
				else
					$("#txt7").val($.trim(dataItem3.item_code));
				$("#txt8").val(dataItem3.commodity_code);
				$("#textarea2").val(dataItem3.mat_desc);
				$("#textarea3").val(dataItem3.support_no);
				$("#txt9").val(dataItem3.uom);
				$("#txt10").val(dataItem3.size);
				$("#txt11").val(dataItem3.activity_code);
				$("#txt12").data("kendoComboBox").text(dataItem3.mat_util);
				$("#txt13").data("kendoNumericTextBox").value((dataItem3.measurement == null) ? 0 : dataItem3.measurement);
				$("#txt14").data("kendoNumericTextBox").value((dataItem3.req_qty == null) ? 0 : dataItem3.req_qty);
				$("#txt15").data("kendoNumericTextBox").value((dataItem3.iss_qty == null) ? 0 : dataItem3.iss_qty);
				$("#txt16").val(dataItem3.plant_no);
				$("#txt17").val(dataItem3.area_no);
				$("#textarea4").val(dataItem3.drawing_no);
				$("#txt18").val(dataItem3.sheet_no);
				$("#txt19").val(dataItem3.rev_no);
				$("#txt20").val(dataItem3.spool_no);
				$("#txt21").val(dataItem3.system_no);
				$("#txt22").val(dataItem3.sub_system);
				$("#txt23").val(dataItem3.testpack_no);
				if (dataItem3.spl_type != null){
					$("#" + ((dataItem3.spl_type.toLowerCase() == "spool") ? "rad1" : "rad3")).prop("checked", true);
					if (dataItem3.spl_type.toLowerCase() != "spool")
						$("#" + ((dataItem3.spl_type.toLowerCase() == "em") ? "rad2" : "rad3")).prop("checked", true);
				}else
					$("#rad3").prop("checked", true);
				$.post(crudServiceBaseUrl + "qms/index/directCall/verifyLISO",{commodity_code: dataItem3.commodity_code, size: dataItem3.size},
					function(data){ 
			    		$("#chk2").prop("checked",(data.length > 0) ? (data[0]['lisoreqd'] == 1) : false);
					});
		  	}
	    }   
	    // if (!ruserWA)
	    	// $("#enggButt").prop("disabled", true).addClass("k-state-disabled");
	}
	function forDiv(){
		var container = $("#rowSelection");
		var container2 = $("#jmifdtl_rs");
		var position = container.offset();	
		var offsetHeight = container.height();	
		var offsetHeight2 = container2.height();	
		var offsetWidth = container.width();
		var newDiv = $("<div id = 'coverDiv'>").appendTo($("body"));
		newDiv.offset(position);
		newDiv.height((offsetHeight + offsetHeight2) + 87);
		newDiv.width(offsetWidth - 17);
	}
	function afterSave(grid){
		$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
		$('input[name=option1], input[name=option2], input[name=option3], #search').prop("disabled", false);
		if (grid == "#rowSelection"){
			$(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea, .jmif_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
			$("#txt2").data("kendoDatePicker").enable(false);
			$("#txt4").data("kendoDatePicker").enable(false);
			$("#txt5").data("kendoDatePicker").enable(false);
		}else {
			$(".jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea, .jmifdtl_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
			if (disc_code != 'INST')
				$("#txt7").data("kendoComboBox").enable(false);
			$("#txt12").data("kendoComboBox").enable(false);
			$("#txt13").data("kendoNumericTextBox").enable(false);
			$("#txt14").data("kendoNumericTextBox").enable(false);
			$("#txt15").data("kendoNumericTextBox").enable(false);
		}
		$("#coverDiv").remove();
	}
	$(document).ready(function(){
		$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
		var crudService = crudServiceBaseUrl + "qms/index/",
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", currRow2 = "", cMode = "", dataItem = '', jmifdtl_di = '', isFailed = false,
		    filterFArr_jmifdtl = [], filterOArr_jmifdtl = [], filterVArr_jmifdtl = [], sentValue_jmifdtl = "", fieldSort = "", dirSort = "", query = "",
			optionArr = ["","jmif_no","jmif_date","req_by","remarks"],
			cond_skip_field = ['txt10','txt16','txt17','txt18','txt19','txt20','textarea4'],
			skip_this_field = cond_skip_field;
			
		set_skip_field(cond_skip_field);
		
		// $("ul > li.liTxt, ul > li.liTxt2").hide();
		//if ($.inArray(disc_code.toLowerCase(), ["pip","strl","spl","ps"]) >= 0){
			// $(".jmif_phase > .wrap-button > .buttonRight").show();
			// if (disc_code.toLowerCase() == "strl")
				// $("#enggButt").hide();
			// else if (disc_code.toLowerCase() == "spl")
				// $("#enggButt, #updButt").hide();
			// else if (disc_code.toLowerCase() == "ps"){
				// $("ul > li.liTxt").show();
				// $("ul > li.liRad").hide();
			// }
		//}else {
			// $(".jmif_phase > .wrap-button > .buttonRight").hide();
			// if ($.inArray(disc_code.toLowerCase(), ["inst","ele"]) >= 0){
				// $("ul > li.liTxt").show();
				// $("ul > li.liRad").hide();
			// }else if (disc_code.toLowerCase() == "psf"){
				// $("ul > li.liTxt").hide();
				// $("ul > li.liTxt2").show();				
			// }
		//}
		switch(disc_code.toLowerCase()){
			case "cvl":
				$("#uplButt, .buttonRight, ul > li.liSubDate, ul > li.liDateReq, label[for=chk2], ul > li.liSuppNo, ul > li.liPlant, ul > li.liSheet, ul > li.liSpool, ul > li.liRad").hide();
			break;
			case "strl":
				$("#uplButt, label[for=chk2], ul > li.liComCode, ul > li.liPlant, ul > li.liSystem, ul > li.liRad").hide();
				$("#txt7").parent().find("label").html($("#txt7").parent().find("label").html().replace("Item Code","Piece Mark"));
				$("#textarea3").parent().find("label").html($("#textarea3").parent().find("label").html().replace("Support No","Area No"));
				$("#txt20").parent().find("label").html($("#txt20").parent().find("label").html().replace("Spool No","RFI No"));
				$("#txt23").parent().find("label").html($("#txt23").parent().find("label").html().replace("Testpack No","QCMRIR No"));
			break;	
			case "mech":
				$("#uplButt, ul > li.liDateReq, label[for=chk2], ul > li.liComCode, ul > li.liPlant, ul > li.liSystem, ul > li.liRad").hide();
				$("#txt7").parent().find("label").html($("#txt7").parent().find("label").html().replace("Item Code","Tag No."));
				$("#textarea3").parent().find("label").html($("#textarea3").parent().find("label").html().replace("Support No","Area No"));
				$("#txt20").parent().find("label").html($("#txt20").parent().find("label").html().replace("Spool No","RFI No"));
				$("#txt23").parent().find("label").html($("#txt23").parent().find("label").html().replace("Testpack No","QCMRIR No"));
			break;	
			case "ps":
				$("#uplButt, .buttonRight, ul > li.liSubDate, ul > li.liDateReq, label[for=chk2], ul > li.liSuppNo, ul > li.liComCode, ul > li.liPlant, ul > li.liSheet, ul > li.liSpool, ul > li.liRad").hide();
				$("#txt7").parent().find("label").html($("#txt7").parent().find("label").html().replace("Item Code","PS No."));
				$("ul > li.liType").show();
			break;
			case "inst":
			case "ele":
				$("#uplButt, .buttonRight, ul > li.liSubDate, ul > li.liChk, ul > li.liPlant, ul > li.liSystem, ul > li.liRad").hide();
				$("#txt6").parent().find("label").html($("#txt6").parent().find("label").html().replace("Stock No","Tag No"));
				$("#txt7").addClass("k-textbox");
				$("#textarea3").parent().find("label").html($("#textarea3").parent().find("label").html().replace("Support No","Area No"));
				$("#txt20").parent().find("label").html($("#txt20").parent().find("label").html().replace("Spool No","RFI No"));
				$("#txt23").parent().find("label").html($("#txt23").parent().find("label").html().replace("Testpack No","QCMRIR No"));
				$("ul > li.liType").show();
			break;
			case "spl":
				$("#uplButt").hide();
			break;
			case "psf":
				$("#uplButt, .buttonRight, ul > li.liSubDate, ul > li.liDateReq, label[for=chk2], ul > li.liSuppNo, ul > li.liComCode, ul > li.liPlant, ul > li.liSheet, ul > li.liSpool, ul > li.liRad").hide();
				$("#txt7").parent().find("label").html($("#txt7").parent().find("label").html().replace("Item Code","PS No."));
			break;
			default:
			break;		
		}
			
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/treq",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/treq",
                    type: "POST",
	                complete: function(jqXHR, textStatus){
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else {
							dataSource.page(dataSource.page());
							afterSave("#rowSelection");
						}
						dataSource.read();
	                }
                },
                update: {
                    url: crudService + "manage/treq",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                destroy: {
                    url: crudService + "remove/treq",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	// if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr[index] = this.operator;
				      		filterVArr[index] = valForm;
				      	});
				    }
				    if ($('input[name=option1]:checked').index('input[name=option1]') > 0)
				     	filterFArr[filterFArr.length] = optionArr[$('input[name=option1]:checked').index('input[name=option1]')] + ";" + sentValue + ";eq";
				    if ($('input[name=option2]:checked').index('input[name=option2]') > 0)
				     	filterFArr[filterFArr.length] = "finalized;1;" + (($('input[name=option2]:checked').index('input[name=option2]') == 1) ? "neq" : "eq" );
				    if ($('input[name=option3]:checked').index('input[name=option3]') > 0)
				     	filterFArr[filterFArr.length] = "jmif_status;CLOSED;" + (($('input[name=option3]:checked').index('input[name=option3]') == 1) ? "neq" : "eq" );
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    disc_code : disc_code
			        }
			      }else {
			      	data['whse_prep'] = 0;
			      	data['log_user'] = $("#hidden_user").val();
			      	data['disc_code'] = disc_code;
			      	data['jmif_date'] = kendo.toString(data.jmif_date,"yyyy-MM-dd");
			      	data['sub_date_fog'] = kendo.toString(data.sub_date_fog,"yyyy-MM-dd");
			      	data['date_reqd'] = kendo.toString(data.date_reqd,"yyyy-MM-dd");
			      	return data;
			      }
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 8,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue = "";
					    filterFArr = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        jmif_no: { type: "string" },
                        jmif_date: { type: "date" },
                        req_by: { type: "string" },
                        iss_by: { type: "string" },
                        finalized: { type: "number" },
                        jmif_status: { type: "string" },
                        sub_date_fog: { type: "date"},
                        date_reqd: { type: "date"}
                    }
                },
                total: function(response) {
				   	return (($(response.rows[0]).length > 0) ? response.rows[0].total : 0);
			    }
            },
            change: function(e) {
            	if ($(e.items).length == 0)
            		return true;
            }
        });

	    var addExtraStylingToGrid = function(){
			$("#rowSelection").data("kendoGrid").select("tr:eq(1)");
	        $("#rowSelection > .k-grid-content > table > tbody > tr").hover(
	            function(){
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr = [];
	    };

        var grid = $("#rowSelection").kendoGrid({
            dataSource: dataSource,
            selectable: "row",
            pageable: {
                buttonCount: 3,
    			input: true
            },
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: false,
            resizable: true,
            filterable: {
                extra: false
            },
            columns: [
               {field: "jmif_no",title: "JMIF No.",width: 85},
               {field: "jmif_date",title: "JMIF Date", width: 89, format: "{0:MM/dd/yyyy}"},
               {field: "req_by",title: "Requested By", width: 117},
               {field: "iss_by",title: "Issued By", width: 89},
               {field: "finalized",title: "Finalized", width: 79},
               {field: "jmif_status",title: "JMIF Status", width: 110}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
			    grid_change(currRow,"#rowSelection");
			    jmifdtl_ds.read();
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle('#rowSelection','JMIF Header');                    
        var jmifdtl_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/treqDtl",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/treqDtl",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1'){
							showNotif('Warning',jqXHR.responseText,'warning');
						}else {
							jmifdtl_ds.page(jmifdtl_ds.page());
							afterSave("#jmifdtl_rs");
						}
						jmifdtl_ds.read();
	                }
                },
                update: {
                    url: crudService + "manage/treqDtl",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                destroy: {
                    url: crudService + "remove/treqDtl",
                    type: "POST"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_jmifdtl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_jmifdtl[index] = this.operator;
				      		filterVArr_jmifdtl[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "log_date");
				    query = filterFArr_jmifdtl;
				    dirSort = ($(data.sort).length ? data.sort[0].dir : "desc");
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_jmifdtl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    operator: (($(data.filter).length > 0) ? filterOArr_jmifdtl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_jmifdtl : sentValue_jmifdtl),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    jmif_no: dataItem.jmif_no,
					    disc_code: disc_code
			        }
			      }else{
			      	  data['log_user'] = $("#hidden_user").val();
					  data['jmif_no'] = dataItem.jmif_no;
			      	  data['disc_code'] = disc_code;
			      	  return data;
			      }
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 8,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_jmifdtl.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue_jmifdtl = "";
					    filterFArr_jmifdtl = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        stock_no: { type: "string" },
                        item_code: { type: "string" },
                        commodity_code: { type: "string" },
                        uom: { type: "string" },
                        size: { type: "string" },
                        req_qty: { type: "number" },
                        iss_qty: { type: "number" },
                        measurement: { type: "number" },
                        drawing_no: { type: "string" },
                        testpack_no: { type: "string" },
                        system_no: { type: "string" },
                        sub_system: { type: "string" },
                        activity_code: { type: "string" },
                        direct_with: { type: "number" },
                        mat_status: { type: "string" }
                    }
                },
                total: function(response) {
				   	return (($(response.rows[0]).length > 0) ? response.rows[0].total : 0); //$(response.rows).length;				   	
			    }
            },
            change: function(e) {
            	if ($(e.items).length == 0)
            		return true;
            }
        });
                                
	    var addExtraStylingToGrid2 = function () {
			$("#jmifdtl_rs").data("kendoGrid").select("tr:eq(" + (dataSource._data.length + 2) + ")");
	        $("#jmifdtl_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_jmifdtl = [];
	    };
        
        var grid2 = $("#jmifdtl_rs").kendoGrid({
            dataSource: jmifdtl_ds,
            selectable: "row",
            pageable: {
                buttonCount: 3,
    			input: true
            },
            autoBind: false,
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: false,
            resizable: true,
            filterable: {
                extra: false
            },
            columns: [
               {field: "stock_no",title: "Stock No.",width: 150},
               {field: "item_code",title: "Item Code", width: 150},
               {field: "commodity_code",title: "Commodity Code", width: 150},
               {field: "uom",title: "Unit of Measure", width: 125},
               {field: "size",title: "Size", width: 51},
               {field: "req_qty",title: "Request Qty.", width: 101},
               {field: "iss_qty",title: "Issued Qty.", width: 150},
               {field: "measurement",title: "Measurement", width: 140},
               {field: "drawing_no",title: "Drawing No.", width: 67},
               {field: "testpack_no",title: "Testpack No.", width: 67},
               {field: "system_no",title: "System", width: 67},
               {field: "sub_system",title: "Sub System", width: 67},
               {field: "activity_code",title: "Activity Code", width: 67},
               {field: "direct_with",title: "Direct Withdraw", width: 67},
               {field: "mat_status",title: "Material Req. Status", width: 67}
           ],
           change: function(e){
           		currRow2 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
		        $("#editButt2, #delButt2").prop("disabled", false).removeClass("k-state-disabled");
			    for (var i = 0; i < selectedRows.length; i++) {
			        jmifdtl_di = this.dataItem(selectedRows[i]);
			        if (dataItem.finalized == 0 || dataItem.finalized == null)
			        	$("#editButt2, #delButt2, #jmifButt").prop("disabled", false).removeClass("k-state-disabled");			        
			    }
			    grid_change(currRow2,"#jmifdtl_rs");
           },
           dataBound: addExtraStylingToGrid2
        });
        insertGridTitle('#jmifdtl_rs','JMIF Detail');
	    $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		$("#txt2,#txt4,#txt5").removeClass('k-state-disabled').kendoDatePicker({
			format: "MM/dd/yyyy",
			enable: false
		});
		$("#txt13, #txt14, #txt15").removeClass('k-state-disabled').kendoNumericTextBox({
			format: "n",
			enable: false
		});
		var item_code = "";
		if (disc_code != "INST")
			item_code = $("#txt7").removeClass('k-state-disabled').kendoComboBox({
				enable: false,
	            filter: "contains",
	            placeholder: "Select item...",
	            dataTextField: "item_code",
	            dataValueField: "stock_desc",
				autoBind: false,
	            dataSource: {
	                transport: {
	                    read: crudService + "directCall/item?disc_code=" + disc_code,
	            		contentType: "application/json"
	                },
	                schema: {
						data: function(data){
		                    return data.rows || [];
						}
	                }
	            },
	            change: function(e){
					if (this.selectedIndex < 0)
	            		$(".k-input").eq(3).val("").select().focus();
	            	else {
	            		$("#txt6").val(this.value().split(",")[5]);
	            		$("#txt8").val(this.value().split(",")[4]);
	            		$("#textarea2").val(this.value().split(",")[0]);
	            		$("#txt9").val(this.value().split(",")[2]);
	            		$("#txt10").val(this.value().split(",")[1]);
	            	}
	            }
			}).data("kendoComboBox");
		else
			item_code = $("#txt7").val();
		$("#txt12").removeClass('k-state-disabled').kendoComboBox({
			enable: false,
            filter: "contains",
            placeholder: "Select utilization...",
            dataTextField: "util_dtl",
            dataValueField: "util_code",
			autoBind: false,
            dataSource: {
                transport: {
                    read: crudService + "directCall/matUtil_dd",
            		contentType: "application/json"
                },
                schema: {
					data: function(data){
	                    return data.rows || [];
					}	                    	
                }
            },
            change: function(e){
				if (this.selectedIndex < 0)
            		$(".k-input").eq(4).val("").select().focus();
            }
		});
		var jmif_date = $("#txt2").data("kendoDatePicker");
		var sub_date_fog = $("#txt4").data("kendoDatePicker");
		var date_reqd = $("#txt5").data("kendoDatePicker");
		var measurement = $("#txt13").data("kendoNumericTextBox");
		var req_qty = $("#txt14").data("kendoNumericTextBox");
		var iss_qty = $("#txt15").data("kendoNumericTextBox");
		var mat_util = $("#txt12").data("kendoComboBox");
		processMatTO = true;
				
		// $("#window").data("kendoWindow").setOptions({
		    // title: "Eng'g Material Take-Off List Help",
		    // width: "991px",
		    // height: "auto"
		// });
		// $("#window").data("kendoWindow").refresh({
			// url: "/codeIgniter/index.php/webapps/qms/index/index/qmsteng",
			// type: "POST",
			// data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
		// });
    	// $("#window").data("kendoWindow").center().open();
	    $(".wrap-button .buttonLeft button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "delButt":
	    				if (!confirm("Do you really want to delete this item?")){
	    					e.preventDefault();	    					
	    					return true;
	    				}
	    				
						// dataRow = $("#rowSelection").data("kendoGrid").dataSource.getByUid(dataItem.uid);
    					// $("#rowSelection").data("kendoGrid").dataSource.remove(dataRow);
    					$("#rowSelection").data("kendoGrid").dataSource.remove(dataItem);
						dataSource.sync();
						dataSource.page(dataSource.page());
						dataSource.read();
						// $("#rowSelection").data("kendoGrid").setDataSource(dataSource);
						// $("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
						// $("#rowSelection").data("kendoGrid").dataSource.read();
	    				return true;
	    			break;
	    			case "delButt2":
	    				if (!confirm("Do you really want to delete this item?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
						dataRow = $("#jmifdtl_rs").data("kendoGrid").dataSource.getByUid(jmifdtl_di.uid);
    					$("#jmifdtl_rs").data("kendoGrid").dataSource.remove(dataRow);
						jmifdtl_ds.sync();
						$("#jmifdtl_rs").data("kendoGrid").setDataSource(jmifdtl_ds);
						$("#jmifdtl_rs").data("kendoGrid").dataSource.page($("#jmifdtl_rs").data("kendoGrid").dataSource.page());
						$("#jmifdtl_rs").data("kendoGrid").dataSource.read();
	    				return true;
	    			break;
	    			case "finButt":
	    				if (!confirm("Do you want to finalize this transaction?"))
	    					return true;
	    					
	    				$.post(crudService + "manage/treq_fin",{PROGRESS_RECID: dataItem.PROGRESS_RECID, finalized: ($(this).text() == "Finalize") ? 1 : 0, log_user: $("#hidden_user").val(), jmif_no: dataItem.jmif_no, disc_code: disc_code, whse_prep: 0},
	    					function(data){
	    						if ($.trim(data) != 1)				
									showNotif('Warning',data,'warning');
								dataSource.page(dataSource.page());
								dataSource.read();								
								// $("#rowSelection").data("kendoGrid").setDataSource(dataSource);
								// $("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
								// $("#rowSelection").data("kendoGrid").dataSource.read();
	    					});
	    			break;
	    			case "enggButt":			
						$.post(crudService + "directCall/verifyRUD",{log_user: $("#hidden_user").val(), disc_code: disc_code},
							function(data){
								//ruserWA = (data != 1);
								if (data != 1){
					    			$("#window").data("kendoWindow").setOptions({
									    title: "Eng'g Material Take-Off List Help",
									    width: "991px",
									    height: "auto",
									    close: function(){
									    	jmifdtl_ds.page(1);
									    	jmifdtl_ds.read();
									    }
									});
									$("#window").data("kendoWindow").refresh({
										url: "/codeIgniter/index.php/webapps/qms/index/index/qmsteng",
										type: "POST",
										data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val(), jmif_no: dataItem.jmif_no, disc_code: disc_code, }
									});
						        	$("#window").data("kendoWindow").center().open();									
								}
							});
	    			break;	    		
	    			// case "jmifButt":	    			
		    			// $("#window").data("kendoWindow").setOptions({
						    // title: "JMIF Help",
						    // width: "991px",
						    // height: "auto"
						// });
						// $("#window").data("kendoWindow").refresh({
							// url: "/codeIgniter/index.php/webapps/qms/index/index/qmshjmif",
							// type: "POST",
							// data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
						// });
			        	// $("#window").data("kendoWindow").center().open();
	    			// break;	    			
					// case "exportButt":
					    // // Create and download csv
					    // open_preloader();
					    // var link = document.createElement('a');
				        // link.href = crudService + "directCall/export_jmif/?";
				        // link.href += ("fieldS=jmif_no&");
				        // link.href += ("value=t2.disc_code='" + disc_code + "'&");
				        // link.href += ("dir=asc");
// 				 
				        // //Dispatching click event.
				        // if (document.createEvent) {
				            // var e = document.createEvent('MouseEvents');
				            // e.initEvent('click' ,true ,true);
				            // link.dispatchEvent(e);
					    	// close_preloader();
				            // return true;
				        // }
					// break;
	    			case "uplButt":
						$("#window").data("kendoWindow").setOptions({
						    title: "Upload Bulk Request",
						    width: "991px",
						    height: "auto",
						    close: winClose
						});
						$("#window").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/webapps/qms/index/index/pipUReq",
							type: "POST",
							data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
						});
			        	$("#window").data("kendoWindow").center().open();
	    			break;
	    			default:
	    				if (this.id.indexOf("2") < 0){
			    			if (this.id == "addButt"){
								cMode = "add";
			    				isFailed = false;
								$(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea").val("");
								$.get(crudService + "directCall/rcontrol", {trancode: "jmif", disc_code: disc_code},
									function(data){
										$("#txt1").prop("disabled", true).addClass("k-state-disabled").val(data.rows[0].pono);
									});
			    			} else {
			    				if (typeof dataItem == "string")
			    					return true;
								cMode = "edit";
							}
							$(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea, .jmif_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							$('input[name=option1], input[name=option2], input[name=option3], #search').prop("disabled", true);
							$("#txt1").prop("disabled", true).addClass("k-state-disabled");
							$(".jmif_phase .wrap-form input").eq(1).select().focus();
							jmif_date.enable(true);
							sub_date_fog.enable(true);
							date_reqd.enable(true);
						}else {
							if (dataItem.length == 0)
								return true;
							$(".jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea, .jmifdtl_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							req_qty.enable(true);
							item_code.enable(true);
							mat_util.enable(true);
			    			if (this.id == "addButt2"){
			    				isFailed = false;
			    				measurement.enable(false);
								$(".jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea").val("");
								$(".jmifdtl_phase .wrap-form input[type=checkbox]").eq(0).select().focus();
								$('input[name=option1], input[name=option2], input[name=option3], #search').prop("disabled", true);
								$("#txt6, #textarea2, #textarea3, #txt8, #txt9, #txt10, #txt11, #txt23").prop("disabled", true).addClass("k-state-disabled");
								cMode = "add";
			    			}else {
								measurement.enable(true);
								$(".jmifdtl_phase .wrap-form input").select().focus();
								$("#txt6, #txt8, #txt9, #txt10, #txt16, #txt17, #textarea4, #txt18, #txt19, #txt20, #txt23").prop("disabled", true).addClass("k-state-disabled");
								cMode = "edit";
							}
						}
						$(".wrap-button button").prop("disabled", true).addClass("k-state-disabled");
						forDiv();
	    			break;
	    		}
	    	}
	    });
	    var winClose = function(){
	    	dataSource.read();
	    };

	    // $(".wrap-button .buttonRight button").bind({
	    	// click: function(e){
	    		// switch(this.id){
	    			// case "enggButt":	    
						// $("#window").data("kendoWindow").setOptions({
						    // title: "ENGG MTO (PIPING)",
						    // width: "991px",
						    // height: "auto",
						    // close: winClose
						// });
						// $("#window").data("kendoWindow").refresh({
							// url: "/codeIgniter/index.php/webapps/qms/index/index/qmsUemto_" + disc_code,
							// type: "POST",
							// data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val(), totalRows: ((dataSource._data.length + jmifdtl_ds._data.length) + 2)}
						// });
						// $("#window").data("kendoWindow").center().open();
	    			// break;
	    			// case "updButt":
						// $("#window").data("kendoWindow").setOptions({
						    // title: "Update Bulk Receiving (PIPING)",
						    // width: "991px",
						    // height: "auto",
						    // close: winClose
						// });
						// $("#window").data("kendoWindow").refresh({
							// url: "/codeIgniter/index.php/webapps/qms/index/index/qmsUbru_pip",
							// type: "POST",
							// data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
						// });
			        	// $("#window").data("kendoWindow").center().open();
	    			// break;
	    			// default:
						// $("#window").data("kendoWindow").setOptions({
						    // title: "Upload Bulk Receiving (PIPING)",
						    // width: "991px",
						    // height: "auto",
						    // close: winClose
						// });
						// $("#window").data("kendoWindow").refresh({
							// url: "/codeIgniter/index.php/webapps/qms/index/index/qmsUbr_pip",
							// type: "POST",
							// data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
						// });
			        	// $("#window").data("kendoWindow").center().open();
	    			// break;
	    		// }
	    	// }
	    // });
	    $(".jmif_phase .wrap-form button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "saveButt":
	    				if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
	    				isFailed = verifyThisInput(".jmif_phase");
			    		if (isFailed)
			    			return true;
	    				
						if (cMode == "add"){
							dataSource.add({PROGRESS_RECID: 0,
											jmif_no: $("#txt1").val(),
											jmif_date: kendo.toString(jmif_date.value(),"yyyy-MM-dd"),
											sub_date_fog: kendo.toString(sub_date_fog.value(),"yyyy-MM-dd"),
											date_reqd: kendo.toString(date_reqd.value(),"yyyy-MM-dd"),
											req_by: $("#txt3").val(),
											remarks: $("#textarea").val()});
							dataSource.sync();
							return true;
							// $("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							// $("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							// $("#rowSelection").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/treq",{PROGRESS_RECID: dataItem.PROGRESS_RECID, jmif_no: $("#txt1").val(), jmif_date: kendo.toString(jmif_date.value(),"yyyy-MM-dd"), sub_date_fog: kendo.toString(sub_date_fog.value(),"yyyy-MM-dd"), date_reqd: kendo.toString(date_reqd.value(),"yyyy-MM-dd"), req_by: $("#txt3").val(), remarks: $("#textarea").val(), log_user: $("#hidden_user").val(), disc_code: disc_code},
					       	    function(data){
					       	    	if (data != '1')
										showNotif('Warning',data,'warning');
									else {
										afterSave("#rowSelection");
										dataSource.page(dataSource.page());
										dataSource.read();
									}
									// $("#rowSelection").data("kendoGrid").setDataSource(dataSource);
									// $("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									// $("#rowSelection").data("kendoGrid").dataSource.read();
					       	    });
	    			break;
	    			default:
	    				$(".thisIsRequired").removeClass('thisIsRequired');
		    			isFailed = false;
			    		afterSave("#rowSelection");
					    grid_change(currRow,"#rowSelection");
	    			break;
	    		}
	    		// if (isFailed)
	    			// return true;
				// $(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				// $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea, .jmif_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		        // $("#editButt, #delButt, #finButt").prop("disabled", true).addClass("k-state-disabled");
				// $('input[name=option1], input[name=option2], input[name=option3], #search').prop("disabled", false);
				// jmif_date.enable(false);
				// $("#coverDiv").remove();
	    	}
	    });
	    $(".jmifdtl_phase .wrap-form button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "saveButt2":
	    				if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
	    				isFailed = verifyThisInput(".jmifdtl_phase");
			    		if (isFailed)
			    			return true;
	    				
						if (cMode == "add"){
							jmifdtl_ds.add({PROGRESS_RECID: 0,
											plant_no: $("#txt16").val(),
											area_no: $("#txt17").val(),
											drawing_no: $("#textarea4").val(),
											sheet_no: $("#txt18").val(),
											rev_no: $("#txt19").val()});
							jmifdtl_ds.sync();
							return true;
							// $("#jmifdtl_rs").data("kendoGrid").setDataSource(jmifdtl_ds);
							// $("#jmifdtl_rs").data("kendoGrid").dataSource.page($("#jmifdtl_rs").data("kendoGrid").dataSource.page());
							// $("#jmifdtl_rs").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/treqDtl",{PROGRESS_RECID: jmifdtl_di.PROGRESS_RECID, stock_no: stock_no.text(), stock_desc: $("#textarea3").val(), item_code: $("#txt13").val(), commodity_code: $("#txt14").val(), uom: $("#txt15").val(), size: $("#txt16").val(), jmif_qty: jmif_qty.value(), spl_type: (($.inArray(disc_code, ["PS","INST","ELE"]) < 0) ? ($("#rad3").is(":checked") ? "" : ($("#rad1").is(":checked") ? "spool" : "em")) : $("#txt21").val()), remarks: $("#textarea4").val(), log_user: $("#hidden_user").val(), disc_code: disc_code},
					       	    function(data){					       	    	
					       	    	if (data != '1')
										showNotif('Warning',data,'warning');
									else {
										afterSave("#jmifdtl_rs");
										jmifdtl_ds.page(jmifdtl_ds.page());
										jmifdtl_ds.read();
									}
									// $("#jmifdtl_rs").data("kendoGrid").setDataSource(jmifdtl_ds);
									// $("#jmifdtl_rs").data("kendoGrid").dataSource.page($("#jmifdtl_rs").data("kendoGrid").dataSource.page());
									// $("#jmifdtl_rs").data("kendoGrid").dataSource.read();
					       	    });
	    			break;
	    			default:
	    				$(".thisIsRequired").removeClass('thisIsRequired');
		    			isFailed = false;
			    		afterSave("#jmifdtl_rs");
					    grid_change(currRow2,"#jmifdtl_rs");
	    			break;
	    		}
	    		// if (isFailed)
	    			// return true;
				// $(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				// $(".jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea, .jmifdtl_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		        // $("#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
				// $('input[name=option1], input[name=option2], #search').prop("disabled", false);
				// stock_no.enable(false);
				// jmif_qty.enable(false);
				// $("#coverDiv").remove();
	    	}
	    });
	    $(".jmifdtl_phase .wrap-form input[type=checkbox]").bind({
	    	click: function(e){
	    		if (this.id == "chk2"){
	    			if (this.checked)
	    				set_skip_field([]);
	    			else
	    				set_skip_field(cond_skip_field);
	    		}
	    	}
	    });
		$(".wrap-header input[name=option2], .wrap-header input[name=option3]").bind({
			click: function(e){
				dataSource.page(1);
				dataSource.read();
			}
		});
		$(".wrap-header input[name=option1]").bind({
			click: function(e){
				switch(this.id){
					case "option1":
						if ($("#search").val() != ""){
							$("#search").val("").select().focus();
							sentValue = "";
							grid.data("kendoGrid").dataSource.page(1);
							grid.data("kendoGrid").dataSource.read();
						}
					break;
					default:
						$("#search").select().focus();
					break;
				}
			}
		});
		$(".k-i-search").click(function(e){
			e.preventDefault();
			
			sentValue = $("#search").val();
			grid.data("kendoGrid").dataSource.page(1);
			grid.data("kendoGrid").dataSource.read();
		});
		$("#search").bind({
			keyup: function(e){
				if (e.keyCode == 13){
					sentValue = this.value;
					grid.data("kendoGrid").dataSource.page(1);
					grid.data("kendoGrid").dataSource.read();
				}
			}
		});
		$("#jmifHead").css({"min-height": ((parseInt($("#jmifHead .wrap-form").height()) + 12) + "px")});
		$("#jmifDtlHead").css({"min-height": ((parseInt($("#jmifDtlHead .wrap-form").height()) + 12) + "px")});
	});
</script>