<div id="main-wrapper">
	<!-- MRS HEADER PHASE -->
	<div class="wrap-header demo-section">
		<fieldset>
			<legend> Filter Option: </legend>
			<div style="float: left;">
				<label><input type="radio" name="option1" id="option1" checked /> All </label>
				<label><input type="radio" name="option1" id="option2" /> MRS No. </label>
				<label><input type="radio" name="option1" id="option3" /> MRS Date </label>
				<label><input type="radio" name="option1" id="option4" /> Return By </label>
				<label><input type="radio" name="option1" id="option5" /> Remarks </label>
				
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
	<div class="mrs_phase">
		<div id="mrsHead" style="min-height: 260px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 27.9%;float:right;min-height: 255px;display: block;">
				<fieldset>
				<legend> MRS Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="txt1" style="width: 100px;">MRS No:</label><input required type="text" name="txt1" id="txt1" class="k-textbox" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt2" style="width: 100px;">MRS Date:</label><input required type="text" name="txt2" disabled id="txt2" style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt3" style="width: 100px;">Return Type:</label><input required type="text" name="txt3" id="txt3" disabled class="k-textbox"  style="width: 155px;" />
						</li>
						<li>
							<label class="title" for="txt4" style="width: 100px;">Return By:</label><input  type="text" name="txt4" id="txt4" class="k-textbox"  style="width: 155px;" />
						</li>
						 <li>
							<label class="title" for="textarea" style="width: 100px;">Remarks:</label><textarea name="textarea" id="textarea" cols="20" rows="3" style="resize: none;width: 142px;margin: 0;"></textarea>
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
	
	<!-- MRS DETAIL PHASE  -->
	
	<div class="mrsdtl_phase" style="margin-top: 5px;">
		<div id="mrsDtlHead" style="min-height: 290px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 27.9%;float:right;height: auto;display: block;">
			<fieldset>
				<legend> MRS Entry: </legend>
				<ul class="formLeft_qms" style="width: 100%;">
					<li>
							<label class="title" for="txt5" style="width: 100px;">Stock No:</label><input required type="text" name="txt5" id="txt5" class="k-textbox"  style="width: 155px;" />
							
					</li>
					<li>
							<label class="title" for="textarea2" style="width: 100px;">Stock Desc:</label><textarea name="textarea" id="textarea2" cols="20" rows="3" style="resize: none;width: 142px;margin: 0;"></textarea>
							
					</li>
					<li>
							<label class="title" for="txt6" style="width: 100px;">Item Code:</label><input type="text" name="txt6" id="txt6" disabled class="k-textbox k-state-disabled" style="width: 155px;" />
					</li>
					<li>
							<label class="title" for="txt7" style="width: 100px;">Comm Code:</label><input type="text" name="txt7" id="txt7" class="k-textbox" style="width: 155px;" />
					</li>
					<li>
							<label class="title" for="txt8" style="width: 105px;">Unit of Measure:</label><input type="text" name="txt8" id="txt8" class="k-textbox" style="width: 55px;" />
							<label class="title short" for="txt9" style="width: 40px;">Size:</label><input type="text" name="txt9" id="txt9" class="k-textbox" style="width: 56px;" />
					</li>
					<li>
							<label class="title" for="txt10" style="width: 100px;">MRS Qty:</label><input required type="text" name="txt10" id="txt10"  disabled  style="width: 155px;" />
					</li>
					<li>
							<label class="title" for="txt11" style="width: 100px;">MRS Qty Acpt:</label><input required type="text" name="txt11" id="txt11" disabled style="width: 155px;" />
					</li>
					<li>
							<label class="title" for="txt12" style="width: 100px;">Measurement:</label><input required type="text" name="txt12" id="txt12" disabled style="width: 155px;" />
					</li>
					<li>
							<label class="title" for="textarea3" style="width: 100px;">Remarks:</label><textarea name="textarea" id="textarea3" cols="20" rows="3" style="resize: none;width: 142px;margin: 0;"></textarea>
							
					</li>
					<li style="text-align: right;">
							<hr style="margin-bottom: 5px;" />
							<button class="k-button" disabled id="saveButt2">Save</button>
							<button class="k-button" disabled id="canButt2">Cancel</button>						
						</li>
					
				</ul>
			</fieldset>
			</div>
			<div class="wrap-grid demo-section" style="width: 69%;margin-left: 0;min-height: 400px;">
		        <div id="mrsDtl_grid"></div>
		    </div>
		    <fieldset style="margin-top: 5px;width: 69%;">
					<ul style="float: right;">
						<li>
							<label class="title" for="txt13" style="width: auto;">Log User:</label><input type="text" name="txt13" id="txt13" class="k-textbox k-state-disabled" disabled style="width: 150px;" />
							<label class="title" for="txt14" style="width: auto;">Log Date:</label><input type="text" name="txt14" id="txt14" class="k-textbox k-state-disabled" disabled style="width: 85px;" />
							<label class="title" for="txt15" style="width: auto;">Log Update:</label><input type="text" name="txt15" id="txt15" class="k-textbox k-state-disabled" disabled style="width: 215px;" />
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
	        $("#txt1").val(dataItem3.mrs_no);
	        $("#txt2").data("kendoDatePicker").value(dataItem3.mrs_date);
	        $("#txt3").data("kendoComboBox").text(dataItem3.return_to);
	        $("#txt4").val(dataItem3.ret_by);
	        $("#textarea").val(dataItem3.remarks);
	        $("#txt4").val(dataItem3.ret_by);
	        $("#txt13").val(dataItem3.log_user);
		    $("#txt14").val(kendo.toString(dataItem3.log_date,"MM/dd/yyyy"));
		    $("#txt15").val(dataItem3.log_update);
	      }else{
	      	$("#txt5").data("kendoComboBox").value(dataItem3.stock_no);
	      	$("#textarea2").val(dataItem3.stock_desc);
		    $("#txt6").val(dataItem3.item_code);
		    $("#txt7").val(dataItem3.commodity_code);
		    $("#txt8").val(dataItem3.uom);
		    $("#txt9").val(dataItem3.size_);
		    $("#txt10").data("kendoNumericTextBox").value(dataItem3.mrs_qty);
		    $("#txt11").data("kendoNumericTextBox").value(dataItem3.mrs_qty_acpt);
		    $("#txt12").data("kendoNumericTextBox").value(dataItem3.measurement);
		    $("#textarea3").val(dataItem3.remarks);
	      } 
	        
		  
	    } // --end of forloop -- //  
	} // -- end of function grid_change
	function forDiv(){
		var container = $("#rowSelection");
		var container2 = $("#mrsDtl_grid");
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
        	filterFArr_mrsDtl = [], filterOArr_mrsDtl = [], filterVArr_mrsDtl = [], sentValue_mrsDtl = "", currRow2 = "", dataItem = "", mrsDtl_di = "",
        	filterFArr_matFile = [], filterOArr_matFile = [], filterVArr_matFile = [], sentValue_matFile = "", currRow3 = "", matFile_di = "",
        	optionArr = ["","mrs_no","mrs_date","ret_by","remarks"];
        
      
        	// -- MRS HDR DataSource & Grid //
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/tmrsRef",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/tmrsRef",
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
							$(".mrs_phase .wrap-form input, .mrs_phase .wrap-form textarea, .mrs_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
							$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
							$('input[name=option1], input[name=option2], #search').prop("disabled", false);
							stock_no.enable(false);
							mrsQty.enable(false);
							mrsQtyAcpt.enable(false);
							measurement.enable(false);
							$("#coverDiv").remove();
						}
	                }
                },
                update: {
                    url: crudService + "manage/tmrsRef",
                    type: "POST",
	                 complete: function(jqXHR, textStatus) {
						// showNotif('Warning',jqXHR.responseText,'warning');
						console.log(jqXHR.responseText);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                destroy: {
                    url: crudService + "remove/tmrsRef",
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
					    fieldS: ($(data.sort).length ? data.sort[0].field : "mrs_no"),
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
                        mrs_no: { type: "string" },
                        mrs_date: { type: "date" },
                        ret_by: { type: "string" },
                        remarks: { type: "string" },
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
               {field: "mrs_no",title: "MRS No",width: 107},
               {field: "mrs_date",title: "MRS Date",format:"{0:MM/dd/yyyy}"},
               {field: "ret_by",title: "Returned By"},
               {field: "remarks",title: "Remarks",width: 300},
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			        $("#mrsDtl_grid").data("kendoGrid").dataSource.read();
			      
			        
			    }
			   	grid_change(currRow,"#rowSelection");
			    
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle("#rowSelection","MRS Header");
        
        // -- MRS DTL DataSource & Grid //
        var mrsdtl_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/tmrsDtlRef",
                    contentType: "application/json",
                    type: "GET"
                    
                },
                create: {
                    url: crudService + "manage/tmrsDtlRef",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	console.log(jqXHR);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else{
							$("#mrsDtl_grid").data("kendoGrid").setDataSource(mrsdtl_ds);
							$("#mrsDtl_grid").data("kendoGrid").dataSource.page($("#mrsDtl_grid").data("kendoGrid").dataSource.page());
							$("#mrsDtl_grid").data("kendoGrid").dataSource.read();
							if (isFailed)
				    			return true;
				    		$(".mrsdtl_phase .wrap-form input, .mrsdtl_phase .wrap-form textarea, .mrsdtl_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
			  				
							$('input[name=option1], input[name=option2], #search').prop("disabled", false);
							stock_no.enable(false);
							mrsQty.enable(false);
							measurement.enable(false);
							$("#coverDiv").remove(); 
						}
	                }
                },
                update: {
                    url: crudService + "manage/tmrsDtlRef",
                    type: "POST"
                    
	                // complete: function(jqXHR, textStatus) {
	                	// console.log(jqXHR);
						// showNotif('Warning',jqXHR.responseText,'warning');
	                	// if (jqXHR.responseText != '1')
							// showNotif('Warning',jqXHR.responseText,'warning');

	                
                },
                destroy: {
                    url: crudService + "remove/tmrsDtlRef",
                    type: "POST"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_mrsDtl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_mrsDtl[index] = this.operator;
				      		filterVArr_mrsDtl[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_mrsDtl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    operator: (($(data.filter).length > 0) ? filterOArr_mrsDtl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_mrsDtl : sentValue_mrsDtl),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    mrs_no: dataItem.mrs_no
					    
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
               	    if (filterFArr_mrsDtl.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue_mrsDtl = "";
					    filterFArr_mrsDtl = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        stock_no: { type: "string" },
                        stock_desc: { type: "string" },
                        item_code: { type: "string" },
                        commodity_code: { type: "string" },
                        uom: { type: "string" },
                        size_: { type: "string" },
                        mrs_qty: { type: "string" },
                        mrs_qty_acpt: { type: "number" },
                        remarks: { type: "string" },
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
			$("#mrsDtl_grid").data("kendoGrid").select("tr:eq(" + (dataSource._data.length + 2) + ")");
	        $("#mrsDtl_grid > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr = [];
	    };
        
        var grid2 = $("#mrsDtl_grid").kendoGrid({
            dataSource: mrsdtl_ds,
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
               {field: "stock_no",title: "Stock No",width: 130},
               {field: "item_code",title: "Item Code",width: 107},
               {field: "commodity_code",title: "Commodity Code",width: 132},
               {field: "uom",title: "UOM",width: 100},
               {field: "size_",title: "size",width: 100},
               {field: "mrs_qty",title: "MRS Qty",width: 100},
               {field: "mrs_qty_acpt",title: "MRS Qty Actp",width: 120},
               {field: "measurement",title: "Measurement",width: 120},
               {field: "remarks",title: "Remarks",width: 200}
           ],
           change: function(e){
           		currRow2 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        mrsDtl_di = this.dataItem(selectedRows[i]);
			    }
			    grid_change(currRow2);
           },
           dataBound: addExtraStylingToGrid2
        });
        insertGridTitle("#mrsDtl_grid","MRS Detail");
        
        	//-- event handler -- //
        
           $("#txt2").removeClass('k-state-disabled').kendoDatePicker({
			format: "MM/dd/yyyy",
			enable: false
		   });
	       
		 $("#txt3").removeClass('k-state-disabled').kendoComboBox({
			enable: false,
			filter: "contains",
	        dataTextField: "p_char1",
	        dataValueField: "p_char1",
			autoBind: false,
	        dataSource: {
	            transport: {
	                read: crudService + "directCall/dd_RETURN_TYPE",
	        		contentType: "application/json"
	            },
	            schema: {
					data: function(data){
	                    return data.rows || [];
					}	                    	
	            }
	        },        
		});
        $("#txt10, #txt11, #txt12").removeClass('k-state-disabled').kendoNumericTextBox({
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
		$("#txt5").removeClass('k-state-disabled').kendoComboBox({
			enable: false,
            filter: "contains",
            placeholder: "Select material...",
            dataTextField: "stock_no",
            dataValueField: "stock_desc",
			autoBind: false,
            dataSource: {
                transport: {
                    read: crudService + "directCall/matFileItem",
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
            		 $("#textarea2").val(this.value().split(",")[0]);
            		 $("#txt9").val(this.value().split(",")[1]);
            		 $("#txt8").val(this.value().split(",")[2]);
            		 $("#txt7").val(this.value().split(",")[3]);
            		 $("#txt6").val(this.value().split(",")[3]);
            	}
            }
		});
		var mrsDate = $("#txt2").data("kendoDatePicker");
		var retBy =  $("#txt3").data("kendoComboBox");
		var stock_no = $("#txt5").data("kendoComboBox");
		var mrsQty =  $("#txt10").data("kendoNumericTextBox");
		var mrsQtyAcpt =  $("#txt11").data("kendoNumericTextBox");
		var measurement =  $("#txt12").data("kendoNumericTextBox");
		
		
        $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
        $(".mrs_phase .wrap-form button").bind({
        	click: function(e){
  				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
  				switch(this.id){
  				case "saveButt":
  					if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    			isFailed = verifyThisInput(".mrs_phase .formLeft_qms");
			    		if (isFailed)
			    			return true;
			    		
			    		if (cMode == "add"){
							dataSource.add({PROGRESS_RECID: 0,
											mrs_no: $("#txt1").val(),
											mrs_date: kendo.toString(mrsDate.value(),"yyyy-MM-dd"),
											return_to: retBy.value(),
											ret_by: $("#txt4").val(),
											remarks: $("#textarea").val()});
							dataSource.sync();
							return true;
							// $("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							// $("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							// $("#rowSelection").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/tmrsRef",{PROGRESS_RECID: dataItem.PROGRESS_RECID,mrs_no: $("#txt1").val(),mrs_date: kendo.toString(mrsDate.value(),"yyyy-MM-dd"),return_to: retBy.value(),ret_by: $("#txt4").val(),remarks: $("#textarea").val()},
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
  				$(".mrs_phase .wrap-form input, .mrs_phase .wrap-form textarea, .mrs_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
				$(".mrs_phase .buttonLeft").prop("disabled",false).removeClass("k-state-disabled");
				$(".mrsdtl_phase .buttonLeft").prop("disabled",false).removeClass("k-state-disabled");
				$("#addButt2,#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
		        $("#editButt, #delButt").prop("disabled", true).addClass("k-state-disabled");
				$('input[name=option1], input[name=option2], #search').prop("disabled", false);
				mrsDate.enable(false);
				retBy.enable(false);
				$("#coverDiv").remove();   
        	}
      }); //-- end of bind -- //
        $(".mrsdtl_phase .wrap-form button").bind({
        	click: function(e){
  				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
  				switch(this.id){
  				case "saveButt2":
  					if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    			isFailed = verifyThisInput(".mrsdtl_phase .formLeft_qms");
			    		if (isFailed)
			    			return true;
			    		
			    		if (cMode == "add"){
							mrsdtl_ds.add({PROGRESS_RECID: 0,
											   mrs_no: dataItem.mrs_no,
											   stock_no: $("#txt6").val(),
											   stock_desc: $("#textarea2").val(),	
											   item_code: $("#txt6").val(),
											   commodity_code: $("#txt7").val() ,
											   uom : $("#txt8").val(),
											   size_: $("#txt").val(),
											   mrs_qty: mrsQty.value(),
											   mrs_qty_acpt: mrsQtyAcpt.value(),
											   measurement: measurement.value(),
											   remarks: $("#textarea3").val()});
							mrsdtl_ds.sync();
							return true;
						}else
					        $.post(crudService + "manage/tmrsDtlRef",{PROGRESS_RECID: mrsDtl_di.PROGRESS_RECID,mrs_no:dataItem.mrs_no,stock_no: $("#txt6").val(),stock_desc: $("#textarea2").val(),item_code: $("#txt6").val(),commodity_code: $("#txt7").val() ,uom : $("#txt8").val(),size_: $("#txt").val(),mrs_qty: mrsQty.value(),mrs_qty_acpt: mrsQtyAcpt.value(),measurement: measurement.value(),remarks: $("#textarea3").val()},
					       	    function(data){
									$("#mrsDtl_grid").data("kendoGrid").setDataSource(mrsdtl_ds);
									$("#mrsDtl_grid").data("kendoGrid").dataSource.page($("#mrsDtl_grid").data("kendoGrid").dataSource.page());
									$("#mrsDtl_grid").data("kendoGrid").dataSource.read();
					       	    });
			    			
  				break;
  				default:
	    				$(".thisIsRequired").removeClass('thisIsRequired');
		    			isFailed = false;
			    		grid_change(currRow2,"#mrsDtl_grid");
	    		break;
  				} 
  				$(".mrsdtl_phase .wrap-form input, .mrsdtl_phase .wrap-form textarea, .mrsdtl_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
  				//$("#addButt2,#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
		        //$("#editButt, #delButt").prop("disabled", true).addClass("k-state-disabled");
				$('input[name=option1], input[name=option2], #search').prop("disabled", false);
				stock_no.enable(false);
				mrsQty.enable(false);
				measurement.enable(false);
				$("#coverDiv").remove();     	
        	}
       });
         $(".wrap-button .buttonLeft button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "finButt":
	    				if (!confirm("Do you want to finalize/unfinalize this transaction?"))
	    					return true;
	    					
	    				$.post(crudService + "manage/tmrsRef_fin",{PROGRESS_RECID: dataItem.PROGRESS_RECID, finalized: ($(this).text() == "Finalize") ? 1 : 0, log_user: $("#hidden_user").val()},
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
						mrsdtl_ds.sync();
						$("#mrsDtl_grid").data("kendoGrid").setDataSource(mrsdtl_ds);
						$("#mrsDtl_grid").data("kendoGrid").dataSource.page($("#mrsDtl_grid").data("kendoGrid").dataSource.page());
						$("#mrsDtl_grid").data("kendoGrid").dataSource.read();
	    				return true;
	    			break;
	    			case "delButt2":
	    				if (!confirm("Do you really want to delete this item?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
						dataRow = grid2.data("kendoGrid").dataSource.getByUid(mrsDtl_di.uid);
    					$("#mrsDtl_grid").data("kendoGrid").dataSource.remove(dataRow);
						mrsdtl_ds.sync();
						$("#mrsDtl_grid").data("kendoGrid").setDataSource(mrsdtl_ds);
						$("#mrsDtl_grid").data("kendoGrid").dataSource.page($("#mrsDtl_grid").data("kendoGrid").dataSource.page());
						$("#mrsDtl_grid").data("kendoGrid").dataSource.read();
	    				return true;
	    			break;
	    			default:
	    				if (this.id.indexOf("2") < 0){
		    				$(".mrs_phase .wrap-form input, .mrs_phase .wrap-form textarea, .mrs_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
		    				mrsDate.enable(true);
		    				retBy.enable(true);
		    				
		    				$(".mrs_phase .wrap-form input").eq(1).select().focus();
		    				if (this.id == "addButt"){
				    				isFailed = false;
				    				
									$(".mrs_phase .wrap-form input, .mrs_phase .wrap-form textarea").val("");
									$(".mrs_phase .wrap-form input").eq(1).select().focus();
									$('input[name=option1], input[name=option2], #search').prop("disabled", true);
									$("#txt4").prop("disabled", true).addClass("k-state-disabled").val($("#hidden_user").val().toUpperCase());
		    				$.get(crudService + "directCall/rcontrol", {trancode: "MRS", disc_code: ""},
										function(data){
											
											$("#txt1").prop("disabled", true).addClass("k-state-disabled").val(data.rows[0].pono);
											cMode = "add";
										});
							}else{
								$("#txt1").prop("disabled", true).addClass("k-state-disabled");
								//$("#textarea").prop("disabled", true).addClass("k-state-disabled");
								$(".mrs_phase .wrap-form input").eq(1).select().focus();
								$(".mrs_phase .buttonLeft").prop("disabled",true).addClass("k-state-disabled");
								$(".mrsdtl_phase .buttonLeft").prop("disabled",true).addClass("k-state-disabled");
								cMode = "edit";
							}
						}else{
							if (dataItem.length == 0)
								return true;
							
							$(".mrsdtl_phase .wrap-form input, .mrsdtl_phase .wrap-form textarea, .mrsdtl_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							stock_no.enable(true);
							mrsQty.enable(true);
							
							measurement.enable(true);
							if (this.id == "addButt2"){
								stock_no.enable(true);
								stock_no.value();
			    				isFailed = false;
								$(".mrsdtl_phase .wrap-form input, .mrsdtl_phase .wrap-form textarea").val("");
								$(".mrsdtl_phase .wrap-form input").eq(0).select().focus();
								mrsQty.value("0.0000");
								mrsQtyAcpt.value("0.0000");
								measurement.value("0.0000");
								$('input[name=option1], input[name=option2], #search').prop("disabled", true);
								$("#textarea2, #txt6, #txt7, #txt8, #txt9").prop("disabled", true).addClass("k-state-disabled");
								$("#addButt,#editButt,#delButt,#finButt,#addButt2,#editButt2,#delButt2").prop("disabled",true).addClass("k-state-disabled");
								cMode = "add";
			    			}else {
								$(".mrsdtl_phase .wrap-form input").eq(6).select().focus();
								$("#textarea2, #txt6, #txt7, #txt8, #txt9").prop("disabled", true).addClass("k-state-disabled");
								$("#addButt,#editButt,#delButt,#finButt").prop("disabled",true).addClass("k-state-disabled");
								cMode = "edit";
							}
						}
						$(".wrap-button button").prop("disabled", true).addClass("k-state-disabled");
						forDiv();
	    			break;
	    	  }
	    	} // --end of switch //
	    }); // -- end of bind -- //
	    
	});// -- end of document.ready function -- //
</script>