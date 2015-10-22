<div id="main-wrapper">
	<div class="wrap-header demo-section">
		<fieldset>
			<legend> Filter Option: </legend>
			<div style="float: left;">
				<label><input type="radio" name="option1" id="option1" checked /> All </label>
				<label><input type="radio" name="option1" id="option2" /> PO No. </label>
				<label><input type="radio" name="option1" id="option3" /> PO Date </label>
				<label><input type="radio" name="option1" id="option4" /> ETA </label>
				<label><input type="radio" name="option1" id="option5" /> ATA </label>
				<label><input type="radio" name="option1" id="option6" /> Supplier </label>
				<label><input type="radio" name="option1" id="option7" /> Remarks </label>
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
	<div class="po_phase">
		<div id="poHead" style="min-height: 260px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 27.9%;float:right;height: auto;display: block;">
				<fieldset>
					<legend> PO Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="txt1" style="width: 100px;">PO No.:</label><input required type="text" name="txt1" id="txt1" class="k-textbox" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt2" style="width: 100px;">PO Date:</label><input required type="text" name="txt2" id="txt2" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt3" style="width: 100px;">ETA:</label><input type="text" name="txt3" id="txt3" style="width: 155px;"/>
						</li>
						<li>
							<label class="title" for="txt4" style="width: 100px;">ATA:</label><input type="text" name="txt4" id="txt4" style="width: 155px;"/>
						</li>
						<li>
							<label class="title" for="txt5" style="width: 100px;">Ship No.:</label><input type="text" name="txt5" id="txt5" class="k-textbox" style="width: 155px;"/>
						</li>
						<li>
							<label class="title" for="txt6" style="width: 100px;">Vessel Name:</label><input type="text" name="txt6" id="txt6" class="k-textbox" style="width: 155px;"/>
						</li>
						<li>
							<label class="title" for="txt7" style="width: 100px;">Ship Inv. No.:</label><input type="text" name="txt7" id="txt7" class="k-textbox" style="width: 155px;"/>
						</li>
						<li>
<!-- 							<label class="title" for="txt8" style="width: 100px;">Supplier Code:</label><input type="text" name="txt8" id="txt8" class="k-textbox" style="width: 155px;"/> -->
							<label class="title" for="txt8" style="width: 100px;">Supplier Code:</label><input type="text" name="txt8" id="txt8" style="width: 155px;"/>
						</li>
						<li>
							<label class="title" for="textarea" style="width: 100px;">Supplier Desc.:</label><textarea name="textarea" id="textarea" cols="20" rows="3" style="resize: none;width: 142px;margin: 0;"></textarea>
						</li>
						<li>
							<label class="title" for="txt9" style="width: 100px;">Port Area:</label><input type="text" name="txt9" id="txt9" class="k-textbox" style="width: 155px;"/>
						</li>
						<li>
							<label class="title" for="textarea1" style="width: 100px;">Remarks:</label><textarea name="textarea1" id="textarea1" cols="20" rows="3" style="resize: none;width: 142px;margin: 0;"></textarea>
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
	        	<button class="k-button mainEve" id="addButt">Add</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="editButt">Edit</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="delButt">Delete</button>
	        	<button class="k-button mainEve" id="finButt">Finalized</button>
	       	</div>
		</div>
	</div>
	<div class="podtl_phase" style="margin-top: 5px;">
		<div id="poDtlHead" style="min-height: 290px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 27.9%;float:right;height: auto;display: block;">
				<fieldset>
					<legend> PO Detail Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="txt10" style="width: 105px;">Stock No.:</label><input type="text" name="txt10" id="txt10" required style="width: 150px;" />
						</li>
						<li>
							<label class="title" for="textarea2" style="width: 105px;">Stock Desc.:</label><textarea name="textarea2" id="textarea2" cols="20" rows="3" style="resize: none;width: 137px;margin: 0;"></textarea>
						</li>
						<li>
							<label class="title" for="txt11" style="width: 105px;">Unit of Measure:</label><input type="text" name="txt11" id="txt11" class="k-textbox" style="width: 55px;" />
							<label class="title short" for="txt12" style="width: 40px;">Size:</label><input type="text" name="txt12" id="txt12" class="k-textbox" style="width: 56px;" />
						</li>
						<li>
							<label class="title" for="txt13" style="width: 105px;">PO Qty.:</label><input type="text" required name="txt13" id="txt13" style="width: 150px;"/>
						</li>
						<li>
							<label class="title" for="textarea3" style="width: 105px;">Remarks:</label><textarea name="textarea3" id="textarea3" cols="20" rows="3" style="resize: none;width: 137px;margin: 0;"></textarea>
						</li>
						<li style="text-align: right;">
							<hr style="margin-bottom: 5px;" />
							<button class="k-button" disabled id="saveButt2">Save</button>
							<button class="k-button" disabled id="canButt2">Cancel</button>						
						</li>
					</ul>
				</fieldset>
			</div>
		    <div class="wrap-grid demo-section" style="width: 69%;margin-left: 0;height: auto;">
		        <div id="podtl_rs"></div>
		    </div>
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
	        	$("#editButt, #delButt, #addButt2").prop("disabled", false).removeClass("k-state-disabled");
	        	$("#finButt").text("Finalize");
	        }else {
	        	$("#editButt, #delButt, #addButt2, #editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
	        	$("#finButt").text("Unfinalize");
	        }        
	        
		    $("#txt1").val(dataItem3.po_no);
		    $("#txt2").data("kendoDatePicker").value(dataItem3.po_date);
		    $("#txt3").data("kendoDatePicker").value(dataItem3.eta);
		    $("#txt4").data("kendoDatePicker").value(dataItem3.ata);
		    $("#txt5").val(dataItem3.ship_no);
		    $("#txt6").val(dataItem3.vessel_name);
		    $("#txt7").val(dataItem3.ship_inv_no);
		    $("#txt8").data("kendoComboBox").value(dataItem3.supp_code);
		    $("#textarea").val(dataItem3.supp_desc);
		    $("#txt9").val(dataItem3.port_area);
		    $("#textarea1").val(dataItem3.remarks);
		  }else {
		    $("#txt10").data("kendoComboBox").value(dataItem3.stock_no);
		    $("#textarea2").val(dataItem3.stock_desc);
		    $("#txt11").val(dataItem3.uom);
		    $("#txt12").val(dataItem3.size);
		    $("#txt13").data("kendoNumericTextBox").value(dataItem3.po_qty);
		    $("#textarea3").val(dataItem3.remarks);
		  }
	    }   
	}
	function forDiv(){
		var container = $("#rowSelection");
		var container2 = $("#podtl_rs");
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
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", currRow2 = "", cMode = "", dataItem = '', podtl_di = '', isFailed = false,
		    filterFArr_podtl = [], filterOArr_podtl = [], filterVArr_podtl = [], sentValue_podtl = "", fieldSort = "", dirSort = "", query = "",
			optionArr = ["","po_no","po_date","eta","ata","supp_desc","remarks"];
                    
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/tpo",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/tpo",
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
							$(".po_phase .wrap-form input, .po_phase .wrap-form textarea, .po_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
							$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
							$('input[name=option1], input[name=option2], #search').prop("disabled", false);
							po_date.enable(false);
							eta.enable(false);
							ata.enable(false);
							supp_code.enable(false);
							$("#coverDiv").remove();
						}
	                }
                },
                update: {
                    url: crudService + "manage/tpo",
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
                    url: crudService + "remove/tpo",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						
	                	 if (jqXHR.responseText != '1')
							 showNotif('Warning',jqXHR.responseText,'warning');
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
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        }
			      }else
			      	data['log_user'] = $("#hidden_user").val();
			      	return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
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
                        po_no: { type: "string" },
                        po_date: { type: "date" },
                        eta: { type: "date" },
                        ata: { type: "date" },
                        ship_no: { type: "string" },
                        vessel_name: { type: "string" },
                        ship_inv_no: { type: "string" },
                        supp_code: { type: "string" },
                        port_area: { type: "string" },
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
	        $("#rowSelection > .k-grid-content > table > tbody > tr").hover(
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
			// toolbar: ["save","cancel"],
            resizable: true,
            filterable: {
                extra: false
            },
            columns: [
               {field: "po_no",title: "PO No.",width: 85},
               {field: "po_date",title: "PO Date", width: 89, format: "{0:MM/dd/yyyy}"},
               {field: "eta",title: "ETA", width: 89, format: "{0:MM/dd/yyyy}"},
               {field: "ata",title: "ATA", width: 89, format: "{0:MM/dd/yyyy}"},
               {field: "ship_no",title: "Ship No.", width: 79},
               {field: "vessel_name",title: "Vessel Name", width: 110},
               {field: "ship_inv_no",title: "Ship. Inv. No.", width: 119},
               {field: "supp_code",title: "Supplier Code", width: 117},
               {field: "port_area",title: "Port Area", width: 89}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
			    grid_change(currRow,"#rowSelection");
			    podtl_ds.read();
           },
           dataBound: addExtraStylingToGrid
        });
		// $("#rowSelection .k-grid-toolbar").hide();
        insertGridTitle('#rowSelection','PO Header');
                    
        var podtl_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/tpoDtl",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/tpoDtl",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	console.log(jqXHR);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                update: {
                    url: crudService + "manage/tpoDtl",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	console.log(jqXHR);
						showNotif('Warning',jqXHR.responseText,'warning');
	                	// if (jqXHR.responseText != '1')
							// showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                destroy: {
                    url: crudService + "remove/tpoDtl",
                    type: "POST"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_podtl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_podtl[index] = this.operator;
				      		filterVArr_podtl[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "log_date");
				    query = filterFArr_podtl;
				    dirSort = ($(data.sort).length ? data.sort[0].dir : "desc")
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_podtl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    operator: (($(data.filter).length > 0) ? filterOArr_podtl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_podtl : sentValue_podtl),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    po_no: dataItem.po_no
			        }
			      }else{
			      	  data['log_user'] = $("#hidden_user").val();
					  data['po_no'] = dataItem.po_no;
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
               	    if (filterFArr_podtl.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue_podtl = "";
					    filterFArr_podtl = [];
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
                        po_qty: { type: "number" },
                        remarks: { type: "string" }
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
			$("#podtl_rs").data("kendoGrid").select("tr:eq(" + (dataSource._data.length + 2) + ")");
	        $("#podtl_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_podtl = [];
	    };
        
        var grid2 = $("#podtl_rs").kendoGrid({
            dataSource: podtl_ds,
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
               {field: "uom",title: "Unit", width: 80},
               {field: "size",title: "Size", width: 80},
               {field: "po_qty",title: "PO Qty.", width: 140},
               {field: "remarks",title: "Remarks"}
           ],
           change: function(e){
           		currRow2 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        podtl_di = this.dataItem(selectedRows[i]);
			        
			        // $("#editButt2, #delButt2").prop("disabled", false).removeClass("k-state-disabled");
			        if (dataItem.finalized == 0 || dataItem.finalized == null)
			        	$("#editButt2, #delButt2").prop("disabled", false).removeClass("k-state-disabled");
			    }
			    grid_change(currRow2,"#podtl_rs");
           },
           dataBound: addExtraStylingToGrid2
        });
        insertGridTitle('#podtl_rs','PO Detail');
        	    	            
	    $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		$("#txt2, #txt3, #txt4").removeClass('k-state-disabled').kendoDatePicker({
			format: "MM/dd/yyyy",
			enable: false
		});
		$("#txt13").removeClass('k-state-disabled').kendoNumericTextBox({
			format: "n",
			enable: false
		});
		$("#txt8").removeClass('k-state-disabled').kendoComboBox({
			enable: false,
            filter: "contains",
            placeholder: "Select supplier...",
            dataTextField: "supp_code",
            dataValueField: "supp_desc",
			autoBind: true,
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
            change: function(e){				if (this.selectedIndex < 0){
            		$(".k-input").eq(3).val("").select().focus();
            		$("#textarea").val("");
				}else
            		$("#textarea").val(this.value());
            }
		});
		$("#txt10").removeClass('k-state-disabled').kendoComboBox({
			enable: false,
            filter: "contains",
            placeholder: "Select material...",
            dataTextField: "stock_no",
            dataValueField: "stock_desc",
			autoBind: true,
            dataSource: {
                transport: {
                    read: crudService + "directCall/item2",
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
            		$(".k-input").eq(3).val("").select().focus();
            		$("#textarea2").val("");
				}else{
            		$("#textarea2").val(this.value().split(",")[0]);
            		$("#textarea11").val(this.value().split(",")[1]);
            		$("#textarea12").val(this.value().split(",")[2]);
            	}
            }
		});
		var po_date = $("#txt2").data("kendoDatePicker");
		var eta = $("#txt3").data("kendoDatePicker");
		var ata = $("#txt4").data("kendoDatePicker");
		var po_qty = $("#txt13").data("kendoNumericTextBox");
		var supp_code = $("#txt8").data("kendoComboBox");
		var stock_no = $("#txt10").data("kendoComboBox");
		
	    $(".wrap-button .buttonLeft button").bind({
	    	click: function(e){
	    		switch(this.id){
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
	    				return true;
	    			break;
	    			case "delButt2":
	    				if (!confirm("Do you really want to delete this item?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
						dataRow = grid2.data("kendoGrid").dataSource.getByUid(podtl_di.uid);
    					$("#podtl_rs").data("kendoGrid").dataSource.remove(dataRow);
						podtl_ds.sync();
						$("#podtl_rs").data("kendoGrid").setDataSource(podtl_ds);
						$("#podtl_rs").data("kendoGrid").dataSource.page($("#podtl_rs").data("kendoGrid").dataSource.page());
						$("#podtl_rs").data("kendoGrid").dataSource.read();
	    				return true;
	    			break;
	    			case "finButt":
	    				if (!confirm("Do you want to finalize this transaction?"))
	    					return true;
	    					
	    				$.post(crudService + "manage/tpo_fin",{PROGRESS_RECID: dataItem.PROGRESS_RECID, finalized: ($(this).text() == "Finalize") ? 1 : 0, log_user: $("#hidden_user").val()},
	    					function(data){	    		
	    						if ($.trim(data) != 1)				
									showNotif('Warning',data,'warning');
								$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
								$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
								$("#rowSelection").data("kendoGrid").dataSource.read();
	    					});
	    			break;
	    			default:
	    				if (this.id.indexOf("2") < 0){
							$(".po_phase .wrap-form input, .po_phase .wrap-form textarea, .po_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							po_date.enable(true);
							eta.enable(true);
							ata.enable(true);
							supp_code.enable(true);
			    			if (this.id == "addButt"){
			    				isFailed = false;
								$(".po_phase .wrap-form input, .po_phase .wrap-form textarea").val("");
								$(".po_phase .wrap-form input").eq(1).select().focus();
								$('input[name=option1], input[name=option2], #search').prop("disabled", true);
								// $('input[name=option2]').prop("disabled", true);
								$.get(crudService + "directCall/rcontrol", {trancode: "PO"},
									function(data){
										// $("#txt1").prop("disabled", true).addClass("k-state-disabled").val(data.rows[0].prefix + (($.trim(data.rows[0].prefix) == "") ? "" : "-") + kendo.toString(data.rows[0].control_no,"99999") + (($.trim(data.rows[0].suffix) == "") ? "" : "-") + data.rows[0].suffix);
										$("#txt1").prop("disabled", true).addClass("k-state-disabled").val(data.rows[0].pono);
										$("#textarea").prop("disabled", true).addClass("k-state-disabled");
										// valueArr = [data.rows[0].pono, "12/20/2013", "12/19/2013", "12/18/2013", "ship_1", "vessel_1", "ship_inv_1", "", "", "port_1", "remarks_1"];
										// $.each(valueArr,function(index, value){
											// // $(this).val(valueArr[index]);
											// $(".po_phase .wrap-form input, .po_phase .wrap-form textarea").eq(index).prop("value", value);
										// });
										cMode = "add";
									});
			    			}else {
								$("#txt1").prop("disabled", true).addClass("k-state-disabled");
								$("#textarea").prop("disabled", true).addClass("k-state-disabled");
								$(".po_phase .wrap-form input").eq(1).select().focus();
								cMode = "edit";
							}
						}else {
							if (dataItem.length == 0)
								return true;
							$(".podtl_phase .wrap-form input, .podtl_phase .wrap-form textarea, .podtl_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							po_qty.enable(true);
			    			if (this.id == "addButt2"){
								stock_no.enable(true);
								po_qty.enable(true);
			    				isFailed = false;
								$(".podtl_phase .wrap-form input, .podtl_phase .wrap-form textarea").val("");
								$(".podtl_phase .wrap-form input").eq(0).select().focus();
								$("#textarea2, #txt11, #txt12").prop("disabled", true).addClass("k-state-disabled");
								cMode = "add";
			    			}else {
								$(".podtl_phase .wrap-form textarea").select().focus();
								$("#textarea2, #txt11, #txt12").prop("disabled", true).addClass("k-state-disabled");
								cMode = "edit";
							}
						}
						$(".wrap-button button").prop("disabled", true).addClass("k-state-disabled");
						forDiv();
	    			break;
	    		}
	    	}
	    });
	    $(".po_phase .wrap-form button").bind({
	    	click: function(e){
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
	    		switch(this.id){
	    			case "saveButt":
	    				if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
	    				isFailed = verifyThisInput(".po_phase");
			    		if (isFailed)
			    			return true;
	    				
						if (cMode == "add"){
							dataSource.add({PROGRESS_RECID: 0,
											po_no: $("#txt1").val(),
											po_date: kendo.toString(po_date.value(),"yyyy-MM-dd"),
											eta: kendo.toString(eta.value(),"yyyy-MM-dd"),
											ata: kendo.toString(ata.value(),"yyyy-MM-dd"),
											ship_no: $("#txt5").val(),
											vessel_name: $("#txt6").val(),
											ship_inv_no: $("#txt7").val(),
											supp_code: supp_code.value(),
											supp_desc: $("#textarea").val(),
											port_area: $("#txt9").val(),
											remarks: $("#textarea1").val()});
							dataSource.sync();
							return true;
							// $("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							// $("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							// $("#rowSelection").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/tpo",{PROGRESS_RECID: dataItem.PROGRESS_RECID, po_no: $("#txt1").val(), po_date: kendo.toString(po_date.value(),"yyyy-MM-dd"), eta: kendo.toString(eta.value(),"yyyy-MM-dd"), ata: kendo.toString(ata.value(),"yyyy-MM-dd"), ship_no: $("#txt5").val(), vessel_name: $("#txt6").val(), ship_inv_no: $("#txt7").val(), supp_code: supp_code.value(), supp_desc: $("#textarea").val(), port_area: $("#txt9").val(), remarks: $("#textarea1").val(), log_user: $("#hidden_user").val()},
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
	    		if (isFailed)
	    			return true;
				$(".po_phase .wrap-form input, .po_phase .wrap-form textarea, .po_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		        $("#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
				$('input[name=option1], input[name=option2], #search').prop("disabled", false);
				po_date.enable(false);
				eta.enable(false);
				ata.enable(false);
				supp_code.enable(false);
				$("#coverDiv").remove();
	    	}
	    });
	    $(".podtl_phase .wrap-form button").bind({
	    	click: function(e){
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
	    		switch(this.id){
	    			case "saveButt2":
	    				if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
	    				isFailed = verifyThisInput(".podtl_phase");
			    		if (isFailed)
			    			return true;
	    				
						if (cMode == "add"){
							podtl_ds.add({PROGRESS_RECID: 0,
											stock_no: stock_no.value(),
											stock_desc: $("#textarea2").val(),
											uom: $("#txt11").val(),
											size: $("#txt12").val(),
											po_qty: po_qty.value(),
											remarks: $("#textarea3").val()});
							podtl_ds.sync();
							$("#podtl_rs").data("kendoGrid").setDataSource(podtl_ds);
							$("#podtl_rs").data("kendoGrid").dataSource.page($("#podtl_rs").data("kendoGrid").dataSource.page());
							$("#podtl_rs").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/tpoDtl",{PROGRESS_RECID: podtl_di.PROGRESS_RECID, stock_no: stock_no.value(), stock_desc: $("#textarea2").val(), uom: $("#txt11").val(), size: $("#txt12").val(), po_qty: po_qty.value(), remarks: $("#textarea3").val()},
					       	    function(data){
									$("#podtl_rs").data("kendoGrid").setDataSource(podtl_ds);
									$("#podtl_rs").data("kendoGrid").dataSource.page($("#podtl_rs").data("kendoGrid").dataSource.page());
									$("#podtl_rs").data("kendoGrid").dataSource.read();
					       	    });
	    			break;
	    			default:
	    				$(".thisIsRequired").removeClass('thisIsRequired');
		    			isFailed = false;
			    		grid_change(currRow2,"#podtl_rs");
	    			break;
	    		}
	    		if (isFailed)
	    			return true;
				$(".podtl_phase .wrap-form input, .podtl_phase .wrap-form textarea, .podtl_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		        $("#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
				$('input[name=option1], input[name=option2], #search').prop("disabled", false);
				stock_no.enable(false);
				po_qty.enable(false);
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
		$("#poHead").css({"min-height": ((parseInt($("#poHead .wrap-form").height()) + 12) + "px")});
		$("#poDtlHead").css({"min-height": ((parseInt($("#poDtlHead .wrap-form").height()) + 12) + "px")});
	});
</script>