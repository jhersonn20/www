<div id="main-wrapper">
	<div class="wrap-header demo-section">
		<fieldset>
			<legend> Filter Option: </legend>
			<div style="float: left;">
				<label><input type="radio" name="option1" id="option1" checked /> All </label>
				<label><input type="radio" name="option1" id="option2" /> JWRR No. </label>
				<label><input type="radio" name="option1" id="option3" /> JWRR Date </label>
				<label><input type="radio" name="option1" id="option4" /> Supplier </label>
				<label><input type="radio" name="option1" id="option5" /> PL/DN/INV. No. </label>
				<label><input type="radio" name="option1" id="option6" /> PO No. </label>
			</div>
			<div style="text-align: right;">
				<label><input type="radio" name="option2" id="option11" checked /> All </label>
				<label><input type="radio" name="option2" id="option12" /> Unfinalized </label>
				<label><input type="radio" name="option2" id="option13" /> Finalize </label>
			</div>
            <span class="k-textbox k-space-right">
                <input type="text" value="" name="search" id="search" />
                <a href="#" class="k-icon k-i-search">&nbsp;</a>
            </span>
			
		</fieldset>
	</div>
	<div class="jwrr_phase">
		<div id="jwrrHead" style="min-height: 260px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 27.9%;float:right;height: auto;display: block;">
				<fieldset>
					<legend> JWRR Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="txt8" style="width: 100px;">QCMRIR No.:</label><input type="text" name="txt8" id="txt8" class="k-textbox" style="width: 155px;"/>
						</li>
						<li>
							<label class="title" for="txt9" style="width: 100px;">QCMRIR Date:</label><input type="text" name="txt9" id="txt9" style="width: 155px;"/>
						</li>
						<li>
							<label class="title" for="textarea2" style="width: 100px;">QC Remarks:</label><textarea name="textarea2" id="textarea2" cols="20" rows="3" style="resize: none;width: 142px;margin: 0;"></textarea>
						</li>
						<li>
							<label class="title" for="txt1" style="width: 100px;">JWRR No.:</label><input required type="text" name="txt1" id="txt1" class="k-textbox" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt2" style="width: 100px;">JWRR Date:</label><input required type="text" name="txt2" id="txt2" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt3" style="width: 100px;">Supplier Code:</label><input type="text" name="txt3" id="txt3" style="width: 155px;"/>
						</li>
						<li>
							<label class="title" for="textarea" style="width: 100px;">Supplier Desc.:</label><textarea name="textarea" id="textarea" cols="20" rows="3" style="resize: none;width: 142px;margin: 0;"></textarea>
						</li>
						<li>
							<label class="title" for="txt4" style="width: 100px;">PR/PO No.:</label><input type="text" name="txt4" id="txt4" class="k-textbox" style="width: 155px;"/>
						</li>
						<li>
							<label class="title" for="txt5" style="width: 100px;">PL/DN/INV:</label><input type="text" name="txt5" id="txt5" class="k-textbox" style="width: 155px;"/>
						</li>
						<li>
							<label class="title" for="txt6" style="width: 100px;">Rcvd By:</label><input type="text" name="txt6" id="txt6" class="k-textbox" style="width: 155px;"/>
						</li>
						<li>
							<label class="title" for="txt7" style="width: 100px;">Rcvd Date:</label><input type="text" name="txt7" id="txt7" style="width: 155px;"/>
						</li>
						<li>
							<label class="title" for="txt10" style="width: 100px;">RFI No.:</label><input type="text" name="txt10" id="txt10" class="k-textbox" style="width: 155px;"/>
						</li>
						<li>
							<label class="title" for="txt11" style="width: 100px;">RFI Date:</label><input type="text" name="txt11" id="txt11" style="width: 155px;"/>
						</li>
						<li>
							<label class="title" for="textarea1" style="width: 100px;">JMIF Nos.:</label><textarea name="textarea1" id="textarea1" cols="20" rows="3" style="resize: none;width: 142px;margin: 0;"></textarea>
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
		<div class="wrap-button demo-section">
			<div class="buttonLeft">
	        	<button class="k-button mainEve"  id="editButt">Edit</button>
	       	</div>
		</div>
	</div>
	<div class="jwrrdtl_phase" style="margin-top: 5px;">
		<div id="jwrrDtlHead" style="min-height: 290px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 27.9%;float:right;height: auto;display: block;">
				<fieldset>
					<legend> JWRR Detail Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="txt12" style="width: 105px;">Stock No.:</label><input type="text" name="txt12" id="txt12" required style="width: 150px;" />
						</li>
						<li>
							<label class="title" for="textarea3" style="width: 105px;">Stock Desc.:</label><textarea name="textarea3" id="textarea3" cols="20" rows="3" style="resize: none;width: 137px;margin: 0;"></textarea>
						</li>
						<li>
							<label class="title" for="txt13" style="width: 105px;">Item Code:</label><input type="text" name="txt13" id="txt13" class="k-textbox" style="width: 150px;" />
						</li>
						<li>
							<label class="title" for="txt14" style="width: 105px;">Comm. Code:</label><input type="text" name="txt14" id="txt14" class="k-textbox" style="width: 150px;" />
						</li>
						<li>
							<label class="title" for="txt15" style="width: 105px;">Unit of Measure:</label><input type="text" name="txt15" id="txt15" class="k-textbox" style="width: 55px;" />
							<label class="title short" for="txt16" style="width: 40px;">Size:</label><input type="text" name="txt16" id="txt16" class="k-textbox" style="width: 56px;" />
						</li>
						<li class="liTxt2">
							<label class="title" for="txt21" style="width: 105px;">Mat'l Type:</label><input type="text" class="k-textbox" name="txt22" id="txt22" style="width: 150px;"/>
						</li>
						<li>
							<label class="title" for="txt17" style="width: 105px;">JWRR Qty.:</label><input type="text" required name="txt17" id="txt17" style="width: 150px;"/>
						</li>
						<li>
							<label class="title" for="textarea4" style="width: 105px;">Remarks:</label><textarea name="textarea4" id="textarea4" cols="20" rows="3" style="resize: none;width: 137px;margin: 0;"></textarea>
						</li>
						<li class="liRad">
							<label class="title" for="rad1" style="width: 90px;">Type:</label><input type="radio" name="option" checked id="rad1" /><label class="title short" for="rad1">Spool</label>
																								<input type="radio" name="option" id="rad2" /><label class="title short" for="rad2">EM</label>
																								<input type="radio" name="option" id="rad3" /><label class="title short" for="rad3">Others</label>
						</li>
						<li class="liTxt">
							<label class="title" for="txt21" style="width: 105px;">Type:</label><input type="text" class="k-textbox" name="txt21" id="txt21" style="width: 150px;"/>
						</li>
					</ul>
				</fieldset>
			</div>
		    <div class="wrap-grid demo-section" style="width: 69%;margin-left: 0;height: auto;">
		        <div id="jwrrdtl_rs"></div>
				<fieldset style="margin-top: 5px;">
					<ul style="float: right;">
						<li>
							<label class="title" for="txt18" style="width: auto;">Log User:</label><input type="text" name="txt18" id="txt18" class="k-textbox k-state-disabled" disabled style="width: 150px;" />
							<label class="title" for="txt19" style="width: auto;">Log Date:</label><input type="text" name="txt19" id="txt19" class="k-textbox k-state-disabled" disabled style="width: 85px;" />
							<label class="title" for="txt20" style="width: auto;">Log Update:</label><input type="text" name="txt20" id="txt20" class="k-textbox k-state-disabled" disabled style="width: 215px;" />
						</li>
					</ul>
				</fieldset>
		    </div>
		</div>
		<div class="wrap-button demo-section">
			<div class="buttonRight">
	        	<button class="k-button mainEve" id="closeButt">Close</button>
	       	</div>				
		</div>
	</div>
</div>
<script type="text/javascript">
	var processMatTO = false;
	function grid_change(e,grid){
		if (typeof e == "undefined")
			e = grid;
	    var selectedRows = e.select();
	    var selectedDataItems = [];
	    for (var i = 0; i < selectedRows.length; i++) {
	      dataItem3 = e.dataItem(selectedRows[i]);
	      if (grid == "#rowSelection"){
			        
	        if (dataItem3.finalized == 0 || dataItem3.finalized == null){	        	
	        	$("#editButt, #delButt, #addButt2, #jmifButt").prop("disabled", false).removeClass("k-state-disabled");
	        	$("#finButt").text("Finalize");

	        }else {
	        	$(" #delButt, #addButt2, #editButt2, #delButt2, #jmifButt").prop("disabled", true).addClass("k-state-disabled");
	        	$("#finButt").text("Unfinalize");

	        }        
	        
		    $("#txt1").val(dataItem3.jwrr_no);
		    $("#txt2").data("kendoDatePicker").value(dataItem3.jwrr_date);
		    $("#txt3").data("kendoComboBox").text(dataItem3.supp_code);
		    $("#textarea").val(dataItem3.supp_desc);
		    $("#txt4").val(dataItem3.pr_po_no);
		    $("#txt5").val(dataItem3.pl_dn_inv);
		    $("#txt6").val(dataItem3.rcvd_by);
		    $("#txt7").data("kendoDatePicker").value(dataItem3.rcvd_date);
		    $("#txt8").val(dataItem3.qcmrir_no);
		    $("#txt9").data("kendoDatePicker").value(dataItem3.qcmrir_date);
		    $("#txt10").val(dataItem3.rfi_no);
		    $("#txt11").data("kendoDatePicker").value(dataItem3.rfi_date);
		    $("#textarea1").val(dataItem3.jmif_no);
		    $("#textarea2").val(dataItem3.qcremarks);
		    $("#txt18").val(dataItem3.log_user);
		    $("#txt19").val(kendo.toString(dataItem3.log_date,"MM/dd/yyyy"));
		    $("#txt20").val(dataItem3.log_update);
		  }else {
		    $("#txt12").data("kendoComboBox").text($.trim(dataItem3.stock_no));
		    // $("#txt12").val($.trim(dataItem3.stock_no));
		  	// alert(dataItem3.stock_no + " " + $("#txt12").val());
		    $("#textarea3").val(dataItem3.stock_desc);
		    $("#txt13").val(dataItem3.item_code);
		    $("#txt14").val(dataItem3.commodity_code);
		    $("#txt15").val(dataItem3.uom);
		    $("#txt16").val(dataItem3.size);
		    $("#txt17").data("kendoNumericTextBox").value(dataItem3.jwrr_qty);
		    $("#textarea4").val(dataItem3.remarks);
		    if (dataItem3.spl_type != null){
			    $("#" + ((dataItem3.spl_type.toLowerCase() == "spool") ? "rad1" : "rad3")).prop("checked", true);
			    if (dataItem3.spl_type.toLowerCase() != "spool")
			    	$("#" + ((dataItem3.spl_type.toLowerCase() == "em") ? "rad2" : "rad3")).prop("checked", true);
			}else
			  	$("#rad3").prop("checked", true);
			$("#txt21").val(dataItem3.spl_type);
		  }
	    }   
	}
	function forDiv(){
		var container = $("#rowSelection");
		var container2 = $("#jwrrdtl_rs");
		var position = container.offset();	
		var offsetHeight = container.height();	
		var offsetHeight2 = container2.height();	
		var offsetWidth = container.width();
		var newDiv = $("<div id = 'coverDiv'>").appendTo($("body"));
		newDiv.offset(position);
		newDiv.height((offsetHeight + offsetHeight2) + 87);
		newDiv.width(offsetWidth - 17);
	}
	$(document).ready(function(){
		$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
		var crudService = crudServiceBaseUrl + "qms/index/",
			disc_code = pathname.split('/')[pathname.split('/').length - 1],
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", currRow2 = "", cMode = "", dataItem = '', jwrrdtl_di = '', isFailed = false,
		    filterFArr_jwrrdtl = [], filterOArr_jwrrdtl = [], filterVArr_jwrrdtl = [], sentValue_jwrrdtl = "", fieldSort = "", dirSort = "", query = "",
			optionArr = ["","jwrr_no","jwrr_date","supp_code","pl_dn_inv","po_no","deliv_by"];
			
		$("ul > li.liTxt, ul > li.liTxt2").hide();
		if ($.inArray(disc_code.toLowerCase(), ["pip","strl","spl","ps"]) >= 0){
			$(".jwrr_phase > .wrap-button > .buttonRight").show();
			if (disc_code.toLowerCase() == "strl")
				$("#enggButt").hide();
			else if (disc_code.toLowerCase() == "spl")
				$("#enggButt, #updButt").hide();
			else if (disc_code.toLowerCase() == "ps"){
				$("ul > li.liTxt").show();
				$("ul > li.liRad").hide();
			}
		}else {
			$(".jwrr_phase > .wrap-button > .buttonRight").hide();
			if ($.inArray(disc_code.toLowerCase(), ["inst","ele"]) >= 0){
				$("ul > li.liTxt").show();
				$("ul > li.liRad").hide();
			}else if (disc_code.toLowerCase() == "psf"){
				$("ul > li.liTxt").hide();
				$("ul > li.liTxt2").show();				
			}
		}
			
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/tjwrr",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/tjwrr",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						// showNotif('Warning',jqXHR.responseText,'warning');
						console.log(jqXHR.responseText);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else {
							// alert("romel");
							// dataSource.sync();
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
				    		if (isFailed)
				    			return true;
							$(".jwrr_phase .wrap-form input, .jwrr_phase .wrap-form textarea, .jwrr_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
							$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
							$('input[name=option1], input[name=option2], #search').prop("disabled", false);
							jwrr_date.enable(false);
							supp_code.enable(false);
							rcvd_date.enable(false);
							qcmrir_date.enable(false);
							rfi_date.enable(false);
							$("#coverDiv").remove();
						}
	                }
                },
                update: {
                    url: crudService + "manage/tjwrr",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						showNotif('Warning',jqXHR.responseText,'warning');
	                	// if (jqXHR.responseText != '1')
							// showNotif('Warning',jqXHR.responseText,'warning');
						// else {
							// alert("romel");
							// // dataSource.sync();
							// // $("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							// // $("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							// // $("#rowSelection").data("kendoGrid").dataSource.read();
						// }
	                }
                },
                destroy: {
                    url: crudService + "remove/tjwrr",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						showNotif('Warning',jqXHR.responseText,'warning');
	                	// if (jqXHR.responseText != '1')
							// showNotif('Warning',jqXHR.responseText,'warning');
						// else {
							// alert("romel");
							// // dataSource.sync();
							// // $("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							// // $("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							// // $("#rowSelection").data("kendoGrid").dataSource.read();
						// }
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
			      }else
			      	data['log_user'] = $("#hidden_user").val();
			      	data['disc_code'] = disc_code;
			      	data['jwrr_date'] = kendo.toString(data.jwrr_date,"yyyy-MM-dd");
			      	data['rcvd_date'] = kendo.toString(data.rcvd_date,"yyyy-MM-dd");
			      	data['qcmrir_date'] = kendo.toString(data.qcmrir_date,"yyyy-MM-dd");
			      	data['rfi_date'] = kendo.toString(data.rfi_date,"yyyy-MM-dd");
			      	return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 18,
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
                        jwrr_no: { type: "string" },
                        jwrr_date: { type: "date" },
                        supp_code: { type: "string" },
                        pd_dn_inv: { type: "string" },
                        pr_po_no: { type: "string" },
                        remarks: { type: "string" },
                        log_date: { type: "date" },
                        rcvd_date: { type: "date" }, 
                        qcmrir_date: { type: "date" }, 
                        rfi_date: { type: "date" }
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
			// toolbar: ["save","cancel"],
            resizable: true,
            filterable: {
                extra: false
            },
            columns: [
               {field: "jwrr_no",title: "JWRR No.",width: 185},
               {field: "jwrr_date",title: "JWRR Date", width: 93, format: "{0:MM/dd/yyyy}"},
               {field: "pl_dn_inv",title: "PL/DN/INV No.", width: 110},
               {field: "pr_po_no",title: "PR/PO No.", width: 89},
               {field: "qcmrir_no",title: "QC No", width: 89},
                {field: "qcmrir_date",title: "QC Date", width: 89},
               {field: "qcremarks",title: "QC Remarks", width: 110}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
			    $(".jwrr_phase .wrap-form input, .jwrr_phase .wrap-form textarea, .jwrrdtl_phase .wrap-form input, .jwrrdtl_phase .wrap-form textarea").val("");
			    grid_change(currRow,"#rowSelection");
			     jwrrdtl_ds.read();    
					                },
           dataBound: addExtraStylingToGrid
        });
		// $("#rowSelection .k-grid-toolbar").hide();
        insertGridTitle('#rowSelection','JWRR Header');
                    
        var jwrrdtl_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/tjwrrDtl",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/tjwrrDtl",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	console.log(jqXHR);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                update: {
                    url: crudService + "manage/tjwrrDtl",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	console.log(jqXHR);
						showNotif('Warning',jqXHR.responseText,'warning');
	                	// if (jqXHR.responseText != '1')
							// showNotif('Warning',jqXHR.responseText,'warning');

	                }
                },
                destroy: {
                    url: crudService + "remove/tjwrrDtl",
                    type: "POST"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_jwrrdtl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_jwrrdtl[index] = this.operator;
				      		filterVArr_jwrrdtl[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "log_date");
				    query = filterFArr_jwrrdtl;
				    dirSort = ($(data.sort).length ? data.sort[0].dir : "desc");
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_jwrrdtl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    operator: (($(data.filter).length > 0) ? filterOArr_jwrrdtl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_jwrrdtl : sentValue_jwrrdtl),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    jwrr_no: (typeof dataItem == "string" ? '' : dataItem.jwrr_no)
			        }
			      }else{
			      	  data['log_user'] = $("#hidden_user").val();
					  data['jwrr_no'] = dataItem.jwrr_no;
			      	  data['disc_code'] = disc_code;
			      	  return data;
			      	 }
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			    // console.log(type);
			    // console.log(response);
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
               	    if (filterFArr_jwrrdtl.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue_jwrrdtl = "";
					    filterFArr_jwrrdtl = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        stock_no: { type: "string" },
                        uom: { type: "string" },
                        size: { type: "string" },
                        jwrr_qty: { type: "number" },
                        stock_desc: { type: "string" },
                        remarks: { type: "string" },
                        drawing_no: { type: "string" },
                        sheet_no: { type: "string" },
                        spool_no: { type: "string" }
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
			$("#jwrrdtl_rs").data("kendoGrid").select("tr:eq(" + (dataSource._data.length + 2) + ")");
	        $("#jwrrdtl_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_jwrrdtl = [];
	    };
        
        var grid2 = $("#jwrrdtl_rs").kendoGrid({
            dataSource: jwrrdtl_ds,
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
               {field: "uom",title: "Unit", width: 56},
               {field: "size",title: "Size", width: 80},
               {field: "jwrr_qty",title: "JWRR Qty.", width: 90},
               {field: "stock_desc",title: "Stock Desc.", width: 101},
               {field: "remarks",title: "Remarks", width: 150},
               {field: "drawing_no",title: "Drawing", width: 140},
               {field: "sheet_no",title: "Sheet", width: 67},
               {field: "spool_no",title: "Spool", width: 67}
           ],
           change: function(e){
           		currRow2 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        jwrrdtl_di = this.dataItem(selectedRows[i]);
			        
			        // $("#editButt2, #delButt2").prop("disabled", false).removeClass("k-state-disabled");
			        if (dataItem.finalized == 0 || dataItem.finalized == null)
			        	$("#editButt2, #delButt2, #jmifButt").prop("disabled", false).removeClass("k-state-disabled");
			    }
			    grid_change(currRow2,"#jwrrdtl_rs");
           },
           dataBound: addExtraStylingToGrid2
        });
        insertGridTitle('#jwrrdtl_rs','JWRR Detail');
        	    	            
	    $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		$("#txt2, #txt7, #txt9, #txt11").removeClass('k-state-disabled').kendoDatePicker({
			format: "MM/dd/yyyy",
			enable: false
		});
		$("#txt17").removeClass('k-state-disabled').kendoNumericTextBox({
			format: "n",
			enable: false
		});
		$("#txt3").removeClass('k-state-disabled').kendoComboBox({
			enable: false,
            filter: "contains",
            placeholder: "Select supplier...",
            dataTextField: "supp_code",
            dataValueField: "supp_desc",
			autoBind: false,
            dataSource: {
                transport: {
                    read: crudService + "directCall/supplier",
            		contentType: "application/json"
                },
                schema: {
					data: function(data){
	                    return data.rows || [];
					}	                    	
                }
            },
            change: function(e){
				if (this.selectedIndex < 0){
            		$(".k-input").eq(1).val("").select().focus();
            		$("#textarea").val("");
				}else
            		$("#textarea").val(this.value());
            }
		});
		$("#txt12").removeClass('k-state-disabled').kendoComboBox({
			enable: false,
            filter: "contains",
            placeholder: "Select material...",
            dataTextField: "stock_no",
            dataValueField: "stock_desc",
			autoBind: false,
            dataSource: {
                transport: {
                    read: crudService + "directCall/item",
            		contentType: "application/json"
                },
                schema: {
					data: function(data){
	                    return data.rows || [];
					}	                    	
                }
            },
            change: function(e){
				if (this.selectedIndex < 0){
            		$(".k-input").eq(5).val("").select().focus();
            		$("#textarea3").val("");
				}else{
            		$("#textarea3").val(this.value().split(",")[0]);
            		$("#txt13").val(this.value().split(",")[3]);
            		$("#txt14").val(this.value().split(",")[4]);
            		$("#txt15").val(this.value().split(",")[2]);
            		$("#txt16").val(this.value().split(",")[1]);
            	}
            }
		});
		var jwrr_date = $("#txt2").data("kendoDatePicker");
		var rcvd_date = $("#txt7").data("kendoDatePicker");
		var qcmrir_date = $("#txt9").data("kendoDatePicker");
		var rfi_date = $("#txt11").data("kendoDatePicker");
		var jwrr_qty = $("#txt17").data("kendoNumericTextBox");
		var supp_code = $("#txt3").data("kendoComboBox");
		var stock_no = $("#txt12").data("kendoComboBox");
		processMatTO = true;
	
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
						$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
						$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
						$("#rowSelection").data("kendoGrid").dataSource.read();
	    				return true;
	    			break;
	    			case "delButt2":
	    				if (!confirm("Do you really want to delete this item?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
						dataRow = $("#jwrrdtl_rs").data("kendoGrid").dataSource.getByUid(jwrrdtl_di.uid);
    					$("#jwrrdtl_rs").data("kendoGrid").dataSource.remove(dataRow);
						jwrrdtl_ds.sync();
						$("#jwrrdtl_rs").data("kendoGrid").setDataSource(jwrrdtl_ds);
						$("#jwrrdtl_rs").data("kendoGrid").dataSource.page($("#jwrrdtl_rs").data("kendoGrid").dataSource.page());
						$("#jwrrdtl_rs").data("kendoGrid").dataSource.read();
	    				return true;
	    			break;
	    			case "finButt":
	    				if (!confirm("Do you want to finalize this transaction?"))
	    					return true;
	    					
	    				$.post(crudService + "manage/tjwrr_fin",{PROGRESS_RECID: dataItem.PROGRESS_RECID, finalized: ($(this).text() == "Finalize") ? 1 : 0, log_user: $("#hidden_user").val(), jwrr_no: dataItem.jwrr_no, disc_code: disc_code},
	    					function(data){
	    						if ($.trim(data) != 1)				
									showNotif('Warning',data,'warning');
								$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
								$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
								$("#rowSelection").data("kendoGrid").dataSource.read();
	    					});
	    			break;
	    			case "jmifButt":	    			
		    			$("#window").data("kendoWindow").setOptions({
						    title: "JMIF Help",
						    width: "991px",
						    height: "auto"
						});
						$("#window").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/webapps/qms/index/index/qmshjmif",
							type: "POST",
							data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
						});
			        	$("#window").data("kendoWindow").center().open();
	    			break;	    			
					case "exportButt":
					    // Create and download csv
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_jwrr/?";
				        link.href += ("fieldS=jwrr_no&");
				        link.href += ("value=t2.disc_code='" + disc_code + "'&");
				        link.href += ("dir=asc");
				 
				        //Dispatching click event.
				        if (document.createEvent) {
				            var e = document.createEvent('MouseEvents');
				            e.initEvent('click' ,true ,true);
				            link.dispatchEvent(e);
					    	close_preloader();
				            return true;
				        }
					break;
	    			default:
	    				if (this.id.indexOf("2") < 0){
							$(".jwrr_phase .wrap-form input, .jwrr_phase .wrap-form textarea, .jwrr_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							
							jwrr_date.enable(false);
							rcvd_date.enable(false);
							qcmrir_date.enable(true);
							rfi_date.enable(false);
							supp_code.enable(true);
			    			if (this.id == "addButt"){
			    				isFailed = false;
								$(".jwrr_phase .wrap-form input, .jwrr_phase .wrap-form textarea").val("");
								$(".jwrr_phase .wrap-form input").eq(1).select().focus();
								$('input[name=option1], input[name=option2], #search').prop("disabled", true);
								// $('input[name=option2]').prop("disabled", true);
								$.get(crudService + "directCall/rcontrol", {trancode: "jwrr", disc_code: disc_code},
									function(data){
										// $("#txt1").prop("disabled", true).addClass("k-state-disabled").val(data.rows[0].prefix + (($.trim(data.rows[0].prefix) == "") ? "" : "-") + kendo.toString(data.rows[0].control_no,"99999") + (($.trim(data.rows[0].suffix) == "") ? "" : "-") + data.rows[0].suffix);
										$("#txt1").prop("disabled", true).addClass("k-state-disabled").val(data.rows[0].pono);
										$("#textarea").prop("disabled", true).addClass("k-state-disabled");
										// valueArr = [data.rows[0].pono, "12/20/2013", "12/19/2013", "12/18/2013", "ship_1", "vessel_1", "ship_inv_1", "", "", "port_1", "remarks_1"];
										// $.each(valueArr,function(index, value){
											// // $(this).val(valueArr[index]);
											// $(".jwrr_phase .wrap-form input, .jwrr_phase .wrap-form textarea").eq(index).prop("value", value);
										// });
										cMode = "add";
									});
			    			}else {
								$("#txt1").prop("disabled", true).addClass("k-state-disabled");
								$("#txt5").prop("disabled", true).addClass("k-state-disabled");
								$("#txt6").prop("disabled", true).addClass("k-state-disabled");
								$("#txt7").prop("disabled", true).addClass("k-state-disabled");
								$("#txt10").prop("disabled", true).addClass("k-state-disabled");
								rfi_date.enable(false);
								$("#textarea").prop("disabled", true).addClass("k-state-disabled");
								$("#textarea1").prop("disabled", true).addClass("k-state-disabled");
								$(".jwrr_phase .wrap-form input").eq(1).select().focus();
								cMode = "edit";
							}
						}else {
							if (dataItem.length == 0)
								return true;
							$(".jwrrdtl_phase .wrap-form input, .jwrrdtl_phase .wrap-form textarea, .jwrrdtl_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							// $(".jwrrdtl_phase .wrap-form input[type=radio]").prop("disabled", true);
							jwrr_qty.enable(true);
							stock_no.enable(true);
			    			if (this.id == "addButt2"){
								stock_no.enable(true);
			    				isFailed = false;
								$(".jwrrdtl_phase .wrap-form input, .jwrrdtl_phase .wrap-form textarea").val("");
								$(".jwrrdtl_phase .wrap-form input").eq(0).select().focus();
								$('input[name=option1], input[name=option2], #search').prop("disabled", true);
								$("#textarea3, #txt13, #txt14, #txt15, #txt16").prop("disabled", true).addClass("k-state-disabled");
								cMode = "add";
			    			}else {
								$(".jwrrdtl_phase .wrap-form input").select().focus();
								$("#textarea3, #txt13, #txt14, #txt15, #txt16").prop("disabled", true).addClass("k-state-disabled");
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

	    $(".wrap-button .buttonRight button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "enggButt":	    
						$("#window").data("kendoWindow").setOptions({
						    title: "ENGG MTO (PIPING)",
						    width: "991px",
						    height: "auto",
						    close: winClose
						});
						$("#window").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/webapps/qms/index/index/qmsUemto_" + disc_code,
							type: "POST",
							data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val(), totalRows: ((dataSource._data.length + jwrrdtl_ds._data.length) + 2)}
						});
						$("#window").data("kendoWindow").center().open();
	    			break;
	    			case "updButt":
						$("#window").data("kendoWindow").setOptions({
						    title: "Update Bulk Receiving (PIPING)",
						    width: "991px",
						    height: "auto",
						    close: winClose
						});
						$("#window").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/webapps/qms/index/index/qmsUbru_pip",
							type: "POST",
							data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
						});
			        	$("#window").data("kendoWindow").center().open();
	    			break;
	    			default:
						$("#window").data("kendoWindow").setOptions({
						    title: "Upload Bulk Receiving (PIPING)",
						    width: "991px",
						    height: "auto",
						    close: winClose
						});
						$("#window").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/webapps/qms/index/index/qmsUbr_pip",
							type: "POST",
							data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
						});
			        	$("#window").data("kendoWindow").center().open();
	    			break;
	    		}
	    	}
	    });
	    $(".jwrr_phase .wrap-form button").bind({
	    	click: function(e){
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
	    		switch(this.id){
	    			case "saveButt":
	    				if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
	    				isFailed = verifyThisInput(".jwrr_phase");
			    		if (isFailed)
			    			return true;
	    				
						if (cMode == "add"){
							dataSource.add({PROGRESS_RECID: 0,
											jwrr_no: $("#txt1").val(),
											jwrr_date: kendo.toString(jwrr_date.value(),"yyyy-MM-dd"),
											supp_code: supp_code.text(),
											supp_desc: $("#textarea").val(),
											pr_po_no: $("#txt4").val(),
											pl_dn_inv: $("#txt5").val(),
											rcvd_by: $("#txt6").val(),
											rcvd_date: kendo.toString(rcvd_date.value(),"yyyy-MM-dd"),
											qcmrir_no: $("#txt8").val(),
											qcmrir_date: kendo.toString(qcmrir_date.value(),"yyyy-MM-dd"),
											rfi_no: $("#txt10").val(),
											rfi_date: kendo.toString(rfi_date.value(),"yyyy-MM-dd"),
											jmif_no: $("#textarea1").val(),
											remarks: $("#textarea2").val()});
							dataSource.sync();
							return true;
							// $("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							// $("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							// $("#rowSelection").data("kendoGrid").dataSource.read();
						}else{						
					        $.post(crudService + "manage/tjwrr",{PROGRESS_RECID: dataItem.PROGRESS_RECID, jwrr_no: $("#txt1").val(), jwrr_date: kendo.toString(jwrr_date.value(),"yyyy-MM-dd"), supp_code: supp_code.text(), supp_desc: $("#textarea").val(), pr_po_no: $("#txt4").val(), pl_dn_inv: $("#txt5").val(), rcvd_by: $("#txt6").val(), rcvd_date: kendo.toString(rcvd_date.value(),"yyyy-MM-dd"), qcmrir_no: $("#txt8").val(), qcmrir_date: kendo.toString(qcmrir_date.value(),"yyyy-MM-dd"), rfi_no: $("#txt10").val(), rfi_date: kendo.toString(rfi_date.value(),"yyyy-MM-dd"), jmif_no: $("#textarea1").val(), qcremarks: $("#textarea2").val(), log_user: $("#hidden_user").val(), disc_code: disc_code},
					       	    function(data){
					       	    	if (data != '1'){
						       	    	showNotif("Information",data,"info");
						       	    	return true;
						       	     }
					       	    
									$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
									 $("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									 $("#rowSelection").data("kendoGrid").dataSource.read();
					       	    });
	    				  }
	    			break;
	    			default:
	    				$(".thisIsRequired").removeClass('thisIsRequired');
		    			isFailed = false;
			    		grid_change(currRow,"#rowSelection");
	    			break;
	    		}
	    		if (isFailed)
	    			return true;
				$(".jwrr_phase .wrap-form input, .jwrr_phase .wrap-form textarea, .jwrr_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		        $("#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
				$('input[name=option1], input[name=option2], #search').prop("disabled", false);
				jwrr_date.enable(false);
				rcvd_date.enable(false);
				qcmrir_date.enable(false);
				rfi_date.enable(false);
				supp_code.enable(false);
				$("#coverDiv").remove();
	    	}
	    });						
	    $(".jwrrdtl_phase .wrap-form button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "saveButt2":
	    				if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
	    				isFailed = verifyThisInput(".jwrrdtl_phase");
			    		if (isFailed)
			    			return true;
	    				
						if (cMode == "add"){
							jwrrdtl_ds.add({PROGRESS_RECID: 0,
											stock_no: stock_no.text(),
											stock_desc: $("#textarea3").val(),
											item_code: $("#txt13").val(),
											commodity_code: $("#txt14").val(),
											uom: $("#txt15").val(),
											size: $("#txt16").val(),
											jwrr_qty: jwrr_qty.value(),
											spl_type: (($.inArray(disc_code, ["PS","INST","ELE"]) < 0) ? ($("#rad3").is(":checked") ? "" : ($("#rad1").is(":checked") ? "spool" : "em")) : $("#txt21").val()),
											remarks: $("#textarea4").val()});
							jwrrdtl_ds.sync();
							$("#jwrrdtl_rs").data("kendoGrid").setDataSource(jwrrdtl_ds);
							$("#jwrrdtl_rs").data("kendoGrid").dataSource.page($("#jwrrdtl_rs").data("kendoGrid").dataSource.page());
							$("#jwrrdtl_rs").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/tjwrrDtl",{PROGRESS_RECID: jwrrdtl_di.PROGRESS_RECID, stock_no: stock_no.text(), stock_desc: $("#textarea3").val(), item_code: $("#txt13").val(), commodity_code: $("#txt14").val(), uom: $("#txt15").val(), size: $("#txt16").val(), jwrr_qty: jwrr_qty.value(), spl_type: (($.inArray(disc_code, ["PS","INST","ELE"]) < 0) ? ($("#rad3").is(":checked") ? "" : ($("#rad1").is(":checked") ? "spool" : "em")) : $("#txt21").val()), remarks: $("#textarea4").val(), log_user: $("#hidden_user").val(), disc_code: disc_code},
					       	    function(data){
									$("#jwrrdtl_rs").data("kendoGrid").setDataSource(jwrrdtl_ds);
									$("#jwrrdtl_rs").data("kendoGrid").dataSource.page($("#jwrrdtl_rs").data("kendoGrid").dataSource.page());
									$("#jwrrdtl_rs").data("kendoGrid").dataSource.read();
					       	    });
	    			break;
	    			default:
	    				$(".thisIsRequired").removeClass('thisIsRequired');
		    			isFailed = false;
			    		grid_change(currRow2,"#jwrrdtl_rs");
	    			break;
	    		}
	    		if (isFailed)
	    			return true;
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				$(".jwrrdtl_phase .wrap-form input, .jwrrdtl_phase .wrap-form textarea, .jwrrdtl_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		        $("#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
				$('input[name=option1], input[name=option2], #search').prop("disabled", false);
				stock_no.enable(false);
				jwrr_qty.enable(false);
				$("#coverDiv").remove();
	    	}
	    });
		$(".wrap-header input[name=option2]").bind({
			click: function(e){
				sentValue = ($('input[name=option2]:checked').index('input[name=option2]') == 2) ? 1 : ($('input[name=option2]:checked').index('input[name=option2]') == 1) ? 0 : "";
				$("#rowSelection").data("kendoGrid").dataSource.read();
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

		$("#jwrrHead").css({"min-height": ((parseInt($("#jwrrHead .wrap-form").height()) + 12) + "px")});
		$("#jwrrDtlHead").css({"min-height": ((parseInt($("#jwrrDtlHead .wrap-form").height()) + 12) + "px")});
	});
</script>