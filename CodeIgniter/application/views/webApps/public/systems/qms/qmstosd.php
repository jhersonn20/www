<div id="main-wrapper">
	<!-- TOSD HEADER PHASE -->
	<div class="wrap-header demo-section">
		<fieldset>
			<legend> Filter Option: </legend>
			<div style="float: left;">
				<label><input type="radio" name="option1" id="option1" checked /> All </label>
				<label><input type="radio" name="option1" id="option2" /> OSD No. </label>
				<label><input type="radio" name="option1" id="option3" /> OSD Date </label>
				<label><input type="radio" name="option1" id="option4" /> Supplier </label>
				<label><input type="radio" name="option1" id="option5" /> QCIR No </label>
				<label><input type="radio" name="option1" id="option5" /> PO No </label>
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
	<div class="tosdhdr_phase">
		<div id="tosdhdrHead" style="min-height: 260px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 27.9%;float:right;min-height: 580px;display: block;">
				<fieldset>
				<legend> Transaction Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="txt1" style="width: 100px;">OSD No:</label><input required type="text" name="txt1" id="txt1" class="k-textbox" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt2" style="width: 100px;">OSD Date:</label><input required type="text" name="txt2" disabled id="txt2"  style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt3" style="width: 100px;">Ship No:</label><input required type="text" name="txt3" id="txt3" class="k-textbox" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt4" style="width: 100px;">Vessel Name:</label><input required type="text" name="txt4" id="txt4" class="k-textbox" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt5" style="width: 100px;">Ship Inv.No:</label><input required type="text" name="txt5" id="txt5" class="k-textbox" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt6" style="width: 100px;">QCIR No:</label><input required type="text" name="txt6" id="txt6" class="k-textbox" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt7" style="width: 100px;">QCIR Date:</label><input required type="text" name="txt7" disabled id="txt7"  style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt8" style="width: 100px;">PO No:</label><input required type="text" name="txt8" id="txt8" class="k-textbox" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt9" style="width: 100px;">Supp Code:</label><input required type="text" name="txt9" id="txt9" class="k-textbox" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="textarea" style="width: 100px;">Supplier Desc:</label><textarea name="textarea" id="textarea" cols="10" rows="3" style="resize: none;width: 142px;margin: 0;"></textarea>
					    </li>
					    <li>
							<label class="title" for="txt10" style="width: 100px;">Requitioner:</label><input required type="text" name="txt10" id="txt10" class="k-textbox" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt11" style="width: 100px;">Transport By:</label><input required type="text" name="txt11" id="txt11" class="k-textbox" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt12" style="width: 100px;">Received Dt:</label><input required type="text" disabled name="txt12" id="txt12"  style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt13" style="width: 100px;">Received At:</label><input required type="text" name="txt13" id="txt13" class="k-textbox" style="width: 155px;" />
						</li>
						<li style="text-align: right;">
							<hr style="margin-bottom: 5px;" />
							<button class="k-button" disabled id="saveButt">Save</button>
							<button class="k-button" disabled id="canButt">Cancel</button>						
						</li>
					</ul>
				</fieldset>
			</div>
			<div class="wrap-grid demo-section" style="width: 69%;margin-left: 0;min-height: 580px;">
		        <div id="rowSelection"></div>
		    </div>
		</div>
		<div class="wrap-button demo-section">
			<div class="buttonLeft">
	        	<button class="k-button mainEve" id="addButt">Add</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="editButt">Edit</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="delButt">Delete</button>
	        	<button class="k-button mainEve" id="finButt">Finalized</button>
	       	</div>
		</div>
	</div>
	
	<!-- TOSD DETAIL PHASE  -->
	
	<div class="tosddtl_phase" style="margin-top: 5px;">
		<div id="tosddtlHead" style="min-height: 290px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 27.9%;float:right;height: auto;display: block;">
			<fieldset>
				<legend> Package Entry: </legend>
				<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="txt14" style="width: 100px;">Package No:</label><input required type="text" name="txt14" id="txt14" class="k-textbox" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt15" style="width: 100px;">ID/ME No:</label><input required type="text" name="txt15" id="txt15" class="k-textbox" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="textarea2" style="width: 100px;">Description:</label><textarea name="textarea" id="textarea2" cols="10" rows="3" style="resize: none;width: 142px;margin: 0;"></textarea>
					    </li>
						<li>
							<label class="title" for="txt16" style="width: 100px;">OSD Qty:</label><input required type="text" name="txt16" id="txt16" disabled style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt17" style="width: 100px;">Received Qty:</label><input required type="text" name="txt17" id="txt17" disabled style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt18" style="width: 100px;">Discrepancy:</label><input required type="text" name="txt18" id="txt18" disabled style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt19" style="width: 100px;">Reason:</label><input required type="text" name="txt19" id="txt19" class="k-textbox" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt20" style="width: 100px;">Action:</label><input required type="text" name="txt20" id="txt20" class="k-textbox" style="width: 155px;" />
						</li>
						<li class="liRad">
							<label class="title" for="rad1" style="width: 90px;">Insurance:</label><input type="radio" name="option" checked id="rad1" /><label class="title short" for="rad1">YES</label>
																								<input type="radio" name="option" id="rad2" /><label class="title short" for="rad2">NO</label>
																								
						</li>
					<li style="text-align: right;">
							<hr style="margin-bottom: 5px;" />
							<button class="k-button" disabled id="saveButt2">Save</button>
							<button class="k-button" disabled id="canButt2">Cancel</button>						
						</li>
					
				</ul>
			</fieldset>
			</div>
			<div class="wrap-grid demo-section" style="width: 69%;margin-left: 0;min-height: 370px;">
		        <div id="tosddtl_grid"></div>
		    </div>
		    <fieldset style="margin-top: 5px;width: 69%;">
					<ul style="float: right;">
						<li>
							<label class="title" for="txt21" style="width: auto;">Log User:</label><input type="text" name="txt21" id="txt21" class="k-textbox k-state-disabled" disabled style="width: 150px;" />
							<label class="title" for="txt22" style="width: auto;">Log Date:</label><input type="text" name="txt22" id="txt22" class="k-textbox k-state-disabled" disabled style="width: 85px;" />
							<label class="title" for="txt23" style="width: auto;">Log Update:</label><input type="text" name="txt23" id="txt23" class="k-textbox k-state-disabled" disabled style="width: 215px;" />
						</li>
					</ul>
				</fieldset>
		</div>
		<div class="wrap-button demo-section">
			<div class="buttonLeft">
	        	<button class="k-button mainEve k-state-disabled" disabled id="addButt2">Add</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="editButt2">Edit</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="delButt2">Delete</button>
        		<!-- <button class="k-button mainEve" id="exportButt">Export</button> -->
	       	</div>
			<div class="buttonRight">
	        	<button class="k-button mainEve" id="closeButt">Close</button>
	       	</div>				
		</div>
	</div>
</div>
<script type="text/javascript">
function grid_change(e,grid){
		if (typeof e == "undefined")
			e = grid;
	    var selectedRows = e.select();
	    var selectedDataItems = [];
	    for (var i = 0; i < selectedRows.length; i++) {
	      dataItem3 = e.dataItem(selectedRows[i]);
		  if (grid == "#rowSelection"){
	        if (dataItem3.finalized == 0 || dataItem3.finalized == null){	        	
	        	$("#editButt, #editButt2, #delButt, #delButt2, #addButt2 ").prop("disabled", false).removeClass("k-state-disabled");
	        	$("#finButt").text("Finalize");
	        }else {
	        	$("#editButt, #delButt, #addButt2, #editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
	        	$("#finButt").text("Unfinalize");
	        }
	        $("#txt1").val(dataItem3.osd_no);
	        $("#txt2").data("kendoDatePicker").value(dataItem3.osd_date);
	        $("#txt3").val(dataItem3.ship_no);
	        $("#txt4").val(dataItem3.vessel_name);
	        $("#txt5").val(dataItem3.ship_inv_no);
	        $("#txt6").val(dataItem3.qcir_no);
	        $("#txt7").data("kendoDatePicker").value(dataItem3.qcir_date);
	        $("#txt8").val(dataItem3.po_no);
	        $("#txt9").data("kendoComboBox").value(dataItem3.supp_code);
	        $("#textarea").val(dataItem3.supp_desc);
	        $("#txt10").val(dataItem3.requ_no);
	        $("#txt11").val(dataItem3.transport_by);
	        $("#txt12").data("kendoDatePicker").value(dataItem3.rcvd_date);
	         $("#txt13").val(dataItem3.rcvd_at);
	        $("#txt21").val(dataItem3.log_user);
		    $("#txt22").val(kendo.toString(dataItem3.log_date,"MM/dd/yyyy"));
		    $("#txt23").val(dataItem3.log_update);
	        
	      }else{
	      	$("#txt14").val(dataItem3.package_no);
	      	$("#txt15").val(dataItem3.idme_no);
	      	$("#textarea2").val(dataItem3.stock_desc);
	      	$("#txt16").data("kendoNumericTextBox").value(dataItem3.osd_qty);
	      	$("#txt17").data("kendoNumericTextBox").value(dataItem3.rcvd_qty);
	      	$("#txt18").data("kendoNumericTextBox").value(dataItem3.discrepancy);
	      	$("#txt19").data("kendoComboBox").value(dataItem3.reason_code);
	      	$("#txt20").data("kendoComboBox").value(dataItem3.action_code);
	      	if(dataItem3.ins_claim == "YES")
	      		$("#rad1").prop("checked", true);
	      	else
	      		$("#rad2").prop("checked", true);
	      } 
	        
		  
	    } // --end of forloop -- //  
	} // -- end of function grid_change
	function forDiv(){
		var container = $("#rowSelection");
		var container2 = $("#tosddtl_grid");
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
		var crudService = crudServiceBaseUrl + "qms/index/", isFailed = false, dataItem3 = "",
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", cMode = "", fieldSort = "", dirSort = "",
        	filterFArr_tosddtl = [], filterOArr_tosddtl = [], filterVArr_tosddtl = [], sentValue_tosddtl = "", currRow2 = "", dataItem = "", tosddtl_di = "",
        	optionArr = ["","osd_no","osd_date","supp_code","qcir_no","po_no"];
		
		// -- TOSD HDR DataSource & Grid //
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/tosd_hdr_Ref",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/tosd_hdr_Ref",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						// showNotif('Warning',jqXHR.responseText,'warning');
						console.log(jqXHR.responseText);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else {
							
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
				    		if (isFailed)
				    			return true;
							$(".tosdhdr_phase .wrap-form input, .tosdhdr_phase .wrap-form textarea, .tosdhdr_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
							$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
							$('input[name=option1], input[name=option2], #search').prop("disabled", false);
							//stock_no.enable(false);
							//mrsQty.enable(false);
							//mrsQtyAcpt.enable(false);
							//measurement.enable(false);
							$("#coverDiv").remove();
						}
	                }
                },
                update: {
                    url: crudService + "manage/tosd_hdr_Ref",
                    type: "POST",
	                 complete: function(jqXHR, textStatus) {
						// showNotif('Warning',jqXHR.responseText,'warning');
						console.log(jqXHR.responseText);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                destroy: {
                    url: crudService + "remove/tosd_hdr_Ref",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	 if (jqXHR.responseText != '1')
							 showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	filterFArr = [];
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
				     	filterFArr[filterFArr.length] = "finalized;" + (($('input[name=option2]:checked').index('input[name=option2]') == 1) ? 0 : 1 ) + ";eq";
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "asc")
					    
			        }
			      }else {
			      	  data['log_user'] = $("#hidden_user").val();
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
            pageSize: 6,
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
                        osd_no: { type: "string" },
                        osd_date: { type: "date" },
                        ship_no: { type: "string" },
                        vessel_name: { type: "string" },
                        ship_inv_no: { type: "string" },
                        qcir_no: { type: "string" },
                        qcir_date: { type: "date" },
                        po_no: { type: "string" },
                        supp_code: { type: "string" },
                        supp_desc: { type: "string" },
                        requ_no: { type: "string" },
                        transport_by: { type: "string" },
                        rcvd_date: { type: "date" },
                        recv_at: { type: "string" },
                        finalized: { type: "number" }
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
                                
	    var addExtraStylingToGrid = function () {
			$("#rowSelection").data("kendoGrid").select("tr:eq(1)");
	        $(".k-grid-content > table > tbody > tr").hover(
	            function() {
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
               {field: "osd_no",title: "OSD No",width: 107},
               {field: "osd_date",title: "OSD Date",format:"{0:MM/dd/yyyy}"},
               {field: "ship_no",title: "Ship No",width: 107},
               {field: "vessel_name",title: "Vessel Name",width: 107},
               {field: "ship_inv_no",title: "Ship Inv No",width: 107},
               {field: "qcir_no",title: "QCIR No",width: 160},
               {field: "qcir_date",title: "QCIR Date",format:"{0:MM/dd/yyyy}"},
               {field: "po_no",title: "PO No",width: 140},
               {field: "supp_code",title: "Supplier",width: 107},
               {field: "supp_desc",title: "Supplier Desc",width: 107},
               {field: "requ_no",title: "Requitioner",width: 107},
               {field: "transport_by",title: "Transport By",width: 107},
               {field: "rcvd_date",title: "Recieved Date",format:"{0:MM/dd/yyyy}"},
               {field: "rcvd_at",title: "Received At",width: 107}
               
               
                
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			      tosddtl_ds.read();
			      
			        
			    }
			   	grid_change(currRow,"#rowSelection");
			    
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle("#rowSelection","OSD Header");
        
     	 // -- TOSD DTL DataSource & Grid //
        var tosddtl_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/tosd_dtl_Ref2",
                    contentType: "application/json",
                    type: "GET",
                    // complete: function(jqXHR, textStatus) {
                    	// showNotif('Warning',jqXHR.responseText,'warning');
                    // }
                },
                create: {
                    url: crudService + "manage/tosdDtlRef",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	console.log(jqXHR);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else{
							$("#tosddtl_grid").data("kendoGrid").setDataSource(tosddtl_ds);
							$("#tosddtl_grid").data("kendoGrid").dataSource.page($("#tosddtl_grid").data("kendoGrid").dataSource.page());
							$("#tosddtl_grid").data("kendoGrid").dataSource.read();
							if (isFailed)
				    			return true;
				    		$(".tosddtl_phase .wrap-form input, .tosddtl_phase .wrap-form textarea, .tosddtl_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
			  				
							$('input[name=option1], input[name=option2], #search').prop("disabled", false);
							osdQty.enable(false);
							rcvdQty.enable(false);
							discrepancy.enable(false);
							reason.enable(false);
							action.enable(false);
							$("#coverDiv").remove(); 
						}
	                }
                },
                update: {
                    url: crudService + "manage/tosdDtlRef",
                    type: "POST"
                },
                destroy: {
                    url: crudService + "remove/tosdDtlRef",
                    type: "POST"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_tosddtl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_tosddtl[index] = this.operator;
				      		filterVArr_tosddtl[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_tosddtl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    operator: (($(data.filter).length > 0) ? filterOArr_tosddtl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_tosddtl : sentValue_tosddtl),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    osd_no: dataItem.osd_no
					    
			        }
			      }else {
			      	  data['log_user'] = $("#hidden_user").val();
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
            pageSize: 15,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_tosddtl.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue_tosddtl = "";
					    filterFArr_tosddtl = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        package_no: { type: "string" },
                        idme_no: { type: "string" },
                        stock_desc: { type: "string" },
                        osd_qty: { type: "number" },
                        rcvd_qty: { type: "number" },
                        discrepancy: { type: "number" },
                        reason: { type: "string" },
                        action: { type: "string" },
                        ins_claim: { type: "string" },
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
			$("#tosddtl_grid").data("kendoGrid").select("tr:eq(" + (dataSource._data.length + 2) + ")");
	        $("#tosddtl_grid > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_tosddtl = [];
	    };
        
        var grid2 = $("#tosddtl_grid").kendoGrid({
            dataSource: tosddtl_ds,
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
               {field: "package_no",title: "Package No",width: 130},
               {field: "idme_no",title: "IDME No",width: 107},
               {field: "stock_desc",title: "Description",width: 132},
               {field: "osd_qty",title: "OSD Qty",width: 100},
               {field: "rcvd_qty",title: "Received Qty",width: 100},
               {field: "discrepancy",title: "Discrepancy",width: 100},
               {field: "reason_code",title: "Reason Code",width: 120},
               {field: "action_code",title: "Action Code",width: 120},
               {field: "ins_claim",title: "Insurance Claim",width: 200}
           ],
           change: function(e){
           		currRow2 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        tosddtl_di = this.dataItem(selectedRows[i]);
			    }
			    grid_change(currRow2);
           },
           dataBound: addExtraStylingToGrid2
        });
        insertGridTitle("#tosddtl_grid","TOSD Detail");
	
		// -- event handler -- //
		
	   $("#txt2, #txt7, #txt12").removeClass('k-state-disabled').kendoDatePicker({
			format: "MM/dd/yyyy",
			enable: false
	   });
	   $("#txt19").removeClass('k-state-disabled').kendoComboBox({
			enable: false,
            filter: "contains",
            placeholder: "Select Reason",
            dataTextField: "reason_desc",
            dataValueField: "reason_code",
			autoBind: false,
            dataSource: {
                transport: {
                    read: crudService + "directCall/reasonDesc",
            		contentType: "application/json"
                },
                schema: {
					data: function(data){
	                    return data.rows || [];
					}	                    	
                }
            }
		});
		$("#txt20").removeClass('k-state-disabled').kendoComboBox({
			enable: false,
            filter: "contains",
            placeholder: "Select Action",
            dataTextField: "action_desc",
            dataValueField: "action_code",
			autoBind: false,
            dataSource: {
                transport: {
                    read: crudService + "directCall/actionDesc",
            		contentType: "application/json"
                },
                schema: {
					data: function(data){
	                    return data.rows || [];
					}	                    	
                }
            }
		});
		$("#txt9").removeClass('k-state-disabled').kendoComboBox({
			enable: false,
            filter: "contains",
            placeholder: "Select material...",
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
            		// $(".k-input").eq(5).val("").select().focus();
            		// $("#textarea3").val("");

				}else{
            		 $("#textarea").val(this.value().split(",")[0]);
            		
            	}
            }
		});
		$("#txt16, #txt17, #txt18").removeClass('k-state-disabled').kendoNumericTextBox({
         	min: 0,
         	enable:false,
         	format: "#.0000"
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
		var osdDate = $("#txt2").data("kendoDatePicker");
		var qcirDate = $("#txt7").data("kendoDatePicker");
		var rcvdDate = $("#txt12").data("kendoDatePicker");
		var supplier =  $("#txt9").data("kendoComboBox");
		var osdQty = $("#txt16").data("kendoNumericTextBox");
		var rcvdQty = $("#txt17").data("kendoNumericTextBox");
		var discrepancy = $("#txt18").data("kendoNumericTextBox");
		var reason = $("#txt19").data("kendoComboBox");
		var action = $("#txt20").data("kendoComboBox");
		$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		$(".wrap-button .buttonLeft button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			
	    			case "finButt":
	    				if (!confirm("Do you want to finalize/unfinalize this transaction?"))
	    					return true;
	    					
	    				$.post(crudService + "manage/tosd_hdr_Ref",{PROGRESS_RECID: dataItem.PROGRESS_RECID, finalized: ($(this).text() == "Finalize") ? 1 : 0, log_user: $("#hidden_user").val()},
	    					function(data){	    		
	    						if ($.trim(data) != 1)				
									showNotif('Warning',data,'warning');
								$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
								$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
								$("#rowSelection").data("kendoGrid").dataSource.read();
	    					});
	    			break;
	    			case "delButt":
	    				if (!confirm("Do you really want to delete this item?")){
	    					e.preventDefault();	    					
	    					return true;
	    				}
	    				
						dataRow = grid.data("kendoGrid").dataSource.getByUid(dataItem.uid);
    					$("#rowSelection").data("kendoGrid").dataSource.remove(dataRow);
						dataSource.sync();
						$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
						$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
						$("#rowSelection").data("kendoGrid").dataSource.read();
						tosddtl_ds.sync();
						$("#tosddtl_grid").data("kendoGrid").setDataSource(tosddtl_ds);
						$("#tosddtl_grid").data("kendoGrid").dataSource.page($("#tosddtl_grid").data("kendoGrid").dataSource.page());
						$("#tosddtl_grid").data("kendoGrid").dataSource.read();
	    				return true;
	    			break;
	    			case "delButt2":
	    				if (!confirm("Do you really want to delete this item?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
						dataRow = grid2.data("kendoGrid").dataSource.getByUid(tosddtl_di.uid);
    					$("#tosddtl_grid").data("kendoGrid").dataSource.remove(dataRow);
						tosddtl_ds.sync();
						$("#tosddtl_grid").data("kendoGrid").setDataSource(tosddtl_ds);
						$("#tosddtl_grid").data("kendoGrid").dataSource.page($("#tosddtl_grid").data("kendoGrid").dataSource.page());
						$("#tosddtl_grid").data("kendoGrid").dataSource.read();
	    				return true;
	    			break;
	    			default:
	    				if (this.id.indexOf("2") < 0){
		    				$(".tosdhdr_phase .wrap-form input, .tosdhdr_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
		    				supplier.enable(true);
		    				osdDate.enable(true);
		    				qcirDate.enable(true);
		    				rcvdDate.enable(true);
		    				$(".mrs_phase .wrap-form input").eq(1).select().focus();
		    				if (this.id == "addButt"){
				    				isFailed = false;
				    				
									$(".tosdhdr_phase .wrap-form input, .tosdhdr_phase .wrap-form textarea").val("");
									$(".tosdhdr_phase .wrap-form input").eq(1).select().focus();
									$('input[name=option1], input[name=option2], #search').prop("disabled", true);
									
		    				$.get(crudService + "directCall/rcontrol", {trancode: "OSD", disc_code: ""},
										function(data){
											
											$("#txt1").prop("disabled", true).addClass("k-state-disabled").val(data.rows[0].pono);
											cMode = "add";
										});
							}else{
								$("#txt1").prop("disabled", true).addClass("k-state-disabled");
								//$("#textarea").prop("disabled", true).addClass("k-state-disabled");
								$(".tosdhdr_phase .wrap-form input").eq(1).select().focus();
								$(".tosdhdr_phase .buttonLeft").prop("disabled",true).addClass("k-state-disabled");
								$(".tosdhdr_phase .buttonLeft").prop("disabled",true).addClass("k-state-disabled");
								cMode = "edit";
							 }
						}else{
							if (dataItem.length == 0)
								return true;
							$(".tosddtl_phase .wrap-form input, .tosddtl_phase .wrap-form textarea, .tosddtl_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							osdQty.enable(true);
							rcvdQty.enable(true);
							discrepancy.enable(true);
							reason.enable(true);
		    				action.enable(true);
							if (this.id == "addButt2"){
								
			    				isFailed = false;
								$(".tosddtl_phase .wrap-form input, .tosddtl_phase .wrap-form textarea").val("");
								$(".tosddtl_phase .wrap-form input").eq(0).select().focus();
								osdQty.enable(true);
								rcvdQty.enable(true);
								discrepancy.enable(true);
								$('input[name=option1], input[name=option2], #search').prop("disabled", true);
								$("#txt6, #txt7, #txt8, #txt9").prop("disabled", true).addClass("k-state-disabled");
								$("#addButt,#editButt,#delButt,#finButt,#addButt2,#editButt2,#delButt2").prop("disabled",true).addClass("k-state-disabled");
								cMode = "add";
			    			}else {
			    				$("#txt14").prop("disabled",true).addClass("k-state-disabled");
								$(".tosddtl_phase .wrap-form input").eq(1).select().focus();
								$("#txt6, #txt7, #txt8, #txt9").prop("disabled", true).addClass("k-state-disabled");
								$("#addButt,#editButt,#delButt,#finButt").prop("disabled",true).addClass("k-state-disabled");
								cMode = "edit";
							}
						}
						$(".wrap-button button").prop("disabled", true).addClass("k-state-disabled");
						forDiv();
	    			break;
	    	  }
	    	} // --end of switch //
	    }); // --end of bind -- //
	    $(".tosdhdr_phase .wrap-form button").bind({
        	click: function(e){
  				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
  				switch(this.id){
  				case "saveButt":
  					if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    			isFailed = verifyThisInput(".tosdhdr_phase .formLeft_qms");
			    		if (isFailed)
			    			return true;
			    		
			    		if (cMode == "add"){
							dataSource.add({PROGRESS_RECID: 0,
											osd_no: $("#txt1").val(),
											osd_date: kendo.toString(osdDate.value(),"yyyy-MM-dd"),
											ship_no: $("#txt3").val(),
											vessel_name: $("#txt4").val(),
											ship_inv_no: $("#txt5").val(),
											qcir_no: $("#txt6").val(),
											qcir_date: kendo.toString(qcirDate.value(),"yyyy-MM-dd"),
											po_no: $("#txt8").val(),
											supp_code: $("#txt9").data("kendoComboBox").value(),
											supp_desc: $("#textarea").val(),
											requ_no: $("#txt10").val(),
											transport_by: $("#txt11").val(),
											rcvd_date: kendo.toString(rcvdDate.value(),"yyyy-MM-dd"),
											rcvd_at: $("#txt13").val()});
							dataSource.sync();
							return true;
						}else
					        $.post(crudService + "manage/tosd_hdr_Ref",{PROGRESS_RECID:dataItem.PROGRESS_RECID,osd_no: $("#txt1").val(),osd_date: kendo.toString(osdDate.value(),"yyyy-MM-dd"),ship_no: $("#txt3").val(),vessel_name: $("#txt4").val(),ship_inv_no: $("#txt5").val(),qcir_no: $("#txt6").val(),qcir_date: kendo.toString(qcirDate.value(),"yyyy-MM-dd"),po_no: $("#txt8").val(),supp_code: $("#txt9").data("kendoComboBox").value(),supp_desc: $("#textarea").val(),requ_no: $("#txt10").val(),transport_by: $("#txt11").val(),rcvd_date: kendo.toString(rcvdDate.value(),"yyyy-MM-dd"),rcvd_at: $("#txt13").val()},
					       	    function(data){
									$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
									$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									$("#rowSelection").data("kendoGrid").dataSource.read();
					       	    });
  				break;
  				default:
	    				$(".thisIsRequired").removeClass('thisIsRequired');
		    			isFailed = false;
			    		grid_change(currRow,"#rowSelection");
	    		break;
  				} 
  				$(".tosdhdr_phase .wrap-form input, .tosdhdr_phase .wrap-form textarea, .tosdhdr_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
				$(".tosdhdr_phase .buttonLeft").prop("disabled",false).removeClass("k-state-disabled");
				$(".tosdhdr_phase .buttonLeft").prop("disabled",false).removeClass("k-state-disabled");
				$("#addButt2,#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
		        $("#editButt, #delButt").prop("disabled", true).addClass("k-state-disabled");
				$('input[name=option1], input[name=option2], #search').prop("disabled", false);
				supplier.enable(false);
		    	osdDate.enable(false);
		    	qcirDate.enable(false);
		    	rcvdDate.enable(false);
				$("#coverDiv").remove();   
        	} // --end of switch
        }); // -- end of bind -- //
        $(".tosddtl_phase .wrap-form button").bind({
        	click: function(e){
  				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
  				switch(this.id){
  				case "saveButt2":
					if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    			isFailed = verifyThisInput(".tosddtl_phase .formLeft_qms");
			    		if (isFailed)
			    			return true;
			    		
			    		if (cMode == "add"){
							tosddtl_ds.add({PROGRESS_RECID: 0,
											   osd_no: dataItem.osd_no,
											   package_no: $("#txt14").val(),
											   idme_no: $("#txt15").val(),	
											   stock_desc: $("#textarea2").val(),
											   osd_qty: osdQty.value(),
											   rcvd_qty: rcvdQty.value(),
											   discrepancy: discrepancy.value(),
											   reason_code: reason.value(),
											   action_code: action.value(),
											   ins_claim: ($("#rad1").is(":checked") ? 1 : 0)});
							tosddtl_ds.sync();
							return true;
						}else
					        $.post(crudService + "manage/tosdDtlRef",{PROGRESS_RECID: tosddtl_di.PROGRESS_RECID, osd_no: dataItem.osd_no, package_no: $("#txt14").val(), idme_no: $("#txt15").val(), stock_desc: $("#textarea2").val(), osd_qty: osdQty.value(), rcvd_qty: rcvdQty.value(), discrepancy: discrepancy.value(), reason_code: reason.value(), action_code: action.value(), ins_claim: ($("#rad1").is(":checked") ? 1 : 0)},
					       	    function(data){
									$("#tosddtl_grid").data("kendoGrid").setDataSource(tosddtl_ds);
									$("#tosddtl_grid").data("kendoGrid").dataSource.page($("#tosddtl_grid").data("kendoGrid").dataSource.page());
									$("#tosddtl_grid").data("kendoGrid").dataSource.read();
					       	    });
					        
			    			
  				break;
  				default:
	    				$(".thisIsRequired").removeClass('thisIsRequired');
		    			isFailed = false;
			    		grid_change(currRow2,"#tosddtl_grid");
	    		break;
  				} 
  				$(".tosddtl_phase .wrap-form input, .tosddtl_phase .wrap-form textarea, .tosddtl_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
  				//$("#addButt2,#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
		        //$("#editButt, #delButt").prop("disabled", true).addClass("k-state-disabled");
				$('input[name=option1], input[name=option2], #search').prop("disabled", false);
				osdQty.enable(false);
				rcvdQty.enable(false);
				discrepancy.enable(false);
				reason.enable(false);
				action.enable(false);
				$("#coverDiv").remove();     	
        	} // -- end of switch -- //
       }); // -- end of bind -- //
	}); // --end of doc.readyFunction-- //
</script>