<div id="main-wrapper">
	<div class="area_phase">
		<div style="min-height: 260px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 37.9%;float:right;height: auto;display: block;">
				<fieldset>
					<legend> Area Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="txt1" style="width: 90px;">Area Code:</label><input required type="text" name="txt1" id="txt1" class="k-textbox" style="width: 74% !important;" />
						</li>
						<li>
							<label class="title" for="textarea" style="width: 90px;">Description:</label><textarea required name="textarea" id="textarea" cols="20" rows="3" style="resize: none;width: 70.5%;margin: 0;"></textarea>
						</li>
						<li>
							<label class="title" for="txt2" style="width: 90px;">Plan Qty.:</label><input type="text" name="txt2" id="txt2" style="width: 74% !important;" />
						</li>
						<li>
							<label class="title" for="txt3" style="width: 90px;">Actual Qty.:</label><input type="text" name="txt3" id="txt3" style="width: 74% !important;"/>
						</li>
						<li>
							<label class="title" for="rad1" style="width: 90px;">Status:</label><input type="radio" name="option" checked id="rad1" /><label class="title short" for="rad1">Active</label>
																								<input type="radio" name="option" id="rad2" /><label class="title short" for="rad2">Inactive</label>
						</li>
						<li style="text-align: right;">
							<hr style="margin-bottom: 5px;" />
							<button class="k-button" disabled id="saveButt">Save</button>
							<button class="k-button" disabled id="canButt">Cancel</button>						
						</li>
					</ul>
				</fieldset>
			</div>
		    <div class="wrap-grid demo-section" style="width: 59%;margin-left: 0;height: auto;">
		        <div id="rowSelection"></div>
		    </div>
		</div>
		<div class="wrap-button demo-section">
			<div class="buttonLeft">
	        	<button class="k-button mainEve" id="addButt">Add</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="editButt">Edit</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="delButt">Delete</button>
	       	</div>
		</div>
	</div>
	<div class="subarea_phase" style="margin-top: 5px;">
		<div style="min-height: 290px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 37.9%;float:right;height: auto;display: block;">
				<fieldset>
					<legend> Sub-Area Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="txt4" style="width: 90px;">Sub. Area:</label><input type="text" name="txt4" id="txt4" required class="k-textbox" style="width: 74% !important;" />
						</li>
						<li>
							<label class="title" for="textarea1" style="width: 90px;">Description:</label><textarea name="textarea1" id="textarea1" required cols="20" rows="3" style="resize: none;width: 70.5%;margin: 0;"></textarea>
						</li>
						<li>
							<label class="title" for="txt5" style="width: 90px;">Assign CM.:</label><input type="text" name="txt5" id="txt5" class="k-textbox" style="width: 74% !important;" />
						</li>
						<li>
							<label class="title" for="txt6" style="width: 90px;">Plan Qty.:</label><input type="text" name="txt6" id="txt6" style="width: 271px !important;" />
						</li>
						<li>
							<label class="title" for="txt7" style="width: 90px;">Actual Qty.:</label><input type="text" name="txt7" id="txt7" style="width: 74% !important;"/>
						</li>
						<li>
							<label class="title" for="rad3" style="width: 90px;">Status:</label><input type="radio" name="option1" checked id="rad3" /><label class="title short" for="rad3">Active</label>
																								<input type="radio" name="option1" id="rad4" /><label class="title short" for="rad4">Inactive</label>
						</li>
						<li style="text-align: right;">
							<hr style="margin-bottom: 5px;" />
							<button class="k-button" disabled id="saveButt2">Save</button>
							<button class="k-button" disabled id="canButt2">Cancel</button>						
						</li>
					</ul>
				</fieldset>
			</div>
		    <div class="wrap-grid demo-section" style="width: 59%;margin-left: 0;height: auto;">
		        <div id="subarea_rs"></div>
		    </div>
		</div>
		<div class="wrap-button demo-section">
			<div class="buttonLeft">
	        	<button class="k-button mainEve" id="addButt2">Add</button>
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
	      dataItem = e.dataItem(selectedRows[i]);
	      if (grid == "#rowSelection"){
		    $("#txt1").val(dataItem.area_no);
		    $("#textarea").val(dataItem.area_desc);
		    $("#txt2").data("kendoNumericTextBox").value(dataItem.plan_qty);
		    $("#txt3").data("kendoNumericTextBox").value(dataItem.actual_qty);
		    $("#rad1").prop("checked", (dataItem.flg_status == 1));
		    $("#rad2").prop("checked", (dataItem.flg_status == 0));
		  }else {
		    $("#txt4").val(dataItem.subarea_code);
		    $("#textarea1").val(dataItem.subarea_desc);
		    $("#txt5").val(dataItem.assign_cm);
		    $("#txt6").data("kendoNumericTextBox").value(dataItem.plan_qty);
		    $("#txt7").data("kendoNumericTextBox").value(dataItem.actual_qty);
		    $("#rad3").prop("checked", (dataItem.flg_status == 1));
		    $("#rad4").prop("checked", (dataItem.flg_status == 0));
		  }
	    }   
	}
	function forDiv(){
		var container = $("#rowSelection");
		var container2 = $("#subarea_rs");
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
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", cMode = "", dataItem = '', subarea_di = '', isFailed = false,
		    filterFArr_subarea = [], filterOArr_subarea = [], filterVArr_subarea = [], sentValue_subarea = "", fieldSort = "", dirSort = "", query = "";
                    
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/areaTbl",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/areaTbl",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                update: {
                    url: crudService + "manage/areaTbl",
                    type: "POST"
                },
                destroy: {
                    url: crudService + "remove/areaTbl",
                    type: "POST"
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
			      }else{
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
                        area_no: { type: "string" },
                        area_desc: { type: "string" },
                        flg_status: { type: "boolean" },
                        plan_qty: { type: "number" },
                        actual_qty: { type: "number" }
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
            resizable: true,
            filterable: {
                extra: false
            },
            columns: [
               {field: "area_no",title: "Area No.",width: 83},
               {field: "area_desc",title: "Description"}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			        
			        $("#editButt, #delButt").prop("disabled", false).removeClass("k-state-disabled");
			    }
			    grid_change(currRow,"#rowSelection");
			    subarea_ds.read();
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle('#rowSelection','Area Listing');
                    
        var subarea_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/subarea",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/subarea",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	console.log(jqXHR);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                update: {
                    url: crudService + "manage/subarea",
                    type: "POST"
                },
                destroy: {
                    url: crudService + "remove/subarea",
                    type: "POST"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_subarea[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_subarea[index] = this.operator;
				      		filterVArr_subarea[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "log_date");
				    query = filterFArr_subarea;
				    dirSort = ($(data.sort).length ? data.sort[0].dir : "desc")
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_subarea,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    operator: (($(data.filter).length > 0) ? filterOArr_subarea : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_subarea : sentValue_subarea),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    area_no: dataItem.area_no
			        }
			      }else{
			      	  data['log_user'] = $("#hidden_user").val();
					  data['area_no'] = dataItem.area_no;
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
               	    if (filterFArr_subarea.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue_subarea = "";
					    filterFArr_subarea = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        subarea_code: { type: "string" },
                        subarea_desc: { type: "string" },
                        assign_cm: { type: "string" },
                        plan_qty: { type: "number" },
                        actual_qty: { type: "number" },
                        flg_status: { type: "boolean" }
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
			$("#subarea_rs").data("kendoGrid").select("tr:eq(" + (dataSource._data.length + 2) + ")");
	        $("#subarea_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_subarea = [];
	    };
        
        var grid2 = $("#subarea_rs").kendoGrid({
            dataSource: subarea_ds,
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
               {field: "subarea_code",title: "Sub-Area Code",width: 123},
               {field: "subarea_desc",title: "Description"}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        subarea_di = this.dataItem(selectedRows[i]);
			        
			        $("#editButt2, #delButt2").prop("disabled", false).removeClass("k-state-disabled");
			    }
			    grid_change(currRow,"#subarea_rs");
           },
           dataBound: addExtraStylingToGrid2
        });
        insertGridTitle('#subarea_rs','Sub-Area Listing');
        	    	            
	    $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		$("#txt2, #txt3, #txt6, #txt7").removeClass('k-state-disabled').kendoNumericTextBox({
			format: "n",
			enable: false
		});
		var plan_qty = $("#txt2").data("kendoNumericTextBox");
		var actual_qty = $("#txt3").data("kendoNumericTextBox");
		var s_plan_qty = $("#txt6").data("kendoNumericTextBox");
		var s_actual_qty = $("#txt7").data("kendoNumericTextBox");
		
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
	    				
						dataRow = grid2.data("kendoGrid").dataSource.getByUid(subarea_di.uid);
    					$("#subarea_rs").data("kendoGrid").dataSource.remove(dataRow);
						subarea_ds.sync();
						$("#subarea_rs").data("kendoGrid").setDataSource(subarea_ds);
						$("#subarea_rs").data("kendoGrid").dataSource.page($("#subarea_rs").data("kendoGrid").dataSource.page());
						$("#subarea_rs").data("kendoGrid").dataSource.read();
	    				return true;
	    			break;
	    			default:
	    				if (this.id.indexOf("2") < 0){
							$(".area_phase .wrap-form input, .area_phase .wrap-form textarea, .area_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							plan_qty.enable(true);
							actual_qty.enable(true);
			    			if (this.id == "addButt"){
			    				isFailed = false;
								$(".area_phase .wrap-form input, .area_phase .wrap-form textarea").val("");
								$(".area_phase .wrap-form input").eq(0).select().focus();
								$('#rad1').prop("checked", true);
								$('input[name=option]').prop("disabled", true);
								cMode = "add";
			    			}else {
								$("#txt1").prop("disabled", true).addClass("k-state-disabled");
								$(".area_phase .wrap-form textarea").select().focus();
								cMode = "edit";
							}
						}else {
							$(".subarea_phase .wrap-form input, .subarea_phase .wrap-form textarea, .subarea_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							s_plan_qty.enable(true);
							s_actual_qty.enable(true);
			    			if (this.id == "addButt2"){
			    				isFailed = false;
								$(".subarea_phase .wrap-form input, .subarea_phase .wrap-form textarea").val("");
								$(".subarea_phase .wrap-form input").eq(0).select().focus();
								$('#rad3').prop("checked", true);
								$('input[name=option1]').prop("disabled", true);
								cMode = "add";
			    			}else {
								$("#txt4").prop("disabled", true).addClass("k-state-disabled");
								$(".subarea_phase.wrap-form textarea").select().focus();
								cMode = "edit";
							}
						}
						$(".wrap-button button").prop("disabled", true).addClass("k-state-disabled");
						forDiv();
	    			break;
	    		}
	    	}
	    });
	    $(".area_phase .wrap-form button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "saveButt":
	    				if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
	    				isFailed = verifyThisInput(".area_phase");
			    		if (isFailed)
			    			return true;
	    				
						if (cMode == "add"){
							dataSource.add({PROGRESS_RECID: 0,
											area_no: $("#txt1").val(),
											area_desc: $("#textarea").val(),
											plan_qty: plan_qty.value(),
											actual_qty: actual_qty.value(),
											flg_status: ($("#rad1").is(":checked") ? 1 : 0)});
							dataSource.sync();
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/areaTbl",{PROGRESS_RECID: dataItem.PROGRESS_RECID, area_no: $("#txt1").val(), area_desc: $("#textarea").val(), plan_qty: plan_qty.value(),	actual_qty: actual_qty.value(), flg_status: ($("#rad1").is(":checked") ? 1 : 0)},
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
				$(".area_phase .wrap-form input, .area_phase .wrap-form textarea, .area_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				plan_qty.enable(false);
				actual_qty.enable(false);
				$("#coverDiv").remove();
	    	}
	    });
	    $(".subarea_phase .wrap-form button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "saveButt2":
	    				if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
	    				isFailed = verifyThisInput(".subarea_phase");
			    		if (isFailed)
			    			return true;
	    				
						if (cMode == "add"){
							subarea_ds.add({PROGRESS_RECID: 0,
											area_no: dataItem.area_no,
											subarea_code: $("#txt4").val(),
											subarea_desc: $("#textarea1").val(),
											assign_cm: $("#txt5").val(),
											plan_qty: s_plan_qty.value(),
											actual_qty: s_actual_qty.value(),
											flg_status: ($("#rad3").is(":checked") ? 1 : 0)});
							subarea_ds.sync();
							$("#subarea_rs").data("kendoGrid").setDataSource(subarea_ds);
							$("#subarea_rs").data("kendoGrid").dataSource.page($("#subarea_rs").data("kendoGrid").dataSource.page());
							$("#subarea_rs").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/subarea",{PROGRESS_RECID: subarea_di.PROGRESS_RECID, area_no: dataItem.area_no, subarea_code: $("#txt4").val(), subarea_desc: $("#textarea1").val(), assign_cm: $("#txt5").val(), plan_qty: s_plan_qty.value(), actual_qty: s_actual_qty.value(), flg_status: ($("#rad3").is(":checked") ? 1 : 0)},
					       	    function(data){
									$("#subarea_rs").data("kendoGrid").setDataSource(subarea_ds);
									$("#subarea_rs").data("kendoGrid").dataSource.page($("#subarea_rs").data("kendoGrid").dataSource.page());
									$("#subarea_rs").data("kendoGrid").dataSource.read();
					       	    });
	    			break;
	    			default:
	    				$(".thisIsRequired").removeClass('thisIsRequired');
		    			isFailed = false;
			    		grid_change(currRow,"#subarea_rs");
	    			break;
	    		}
	    		if (isFailed)
	    			return true;
				$(".subarea_phase .wrap-form input, .subarea_phase .wrap-form textarea, .subarea_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				s_plan_qty.enable(false);
				s_actual_qty.enable(false);
				$("#coverDiv").remove();
	    	}
	    });
	});
</script>