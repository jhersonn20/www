<div id="main-wrapper">
	<div style="min-height: 629px;margin-bottom: 5px;">
		<div class="wrap-form demo-section apply8" style="width: 37.1%;float:right;height: auto;display: block;">
			<fieldset>
				<legend> FWBS Entry: </legend>
				<ul class="formLeft_qms" style="width: 100%;">
					<li>
						<label class="title" for="txt1" style="width: 130px;">FWBS No.:</label><input type="text" required name="txt1" id="txt1" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="textarea" style="width: 130px;">Description:</label><textarea name="textarea" id="textarea" cols="20" rows="3" style="resize: none;width: 57%;margin: 0;"></textarea>
					</li>
					<li>
						<label class="title" for="txt2" style="width: 130px;">Short Desc.:</label><input type="text" name="txt2" id="txt2" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt3" style="width: 130px;">Activity Code:</label><input type="text" name="txt3" id="txt3" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt4" style="width: 130px;">Group:</label><input type="text" name="txt4" id="txt4" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt5" style="width: 130px;">Unit Rate:</label><input type="text" name="txt5" id="txt5" style="width: 61%;"/>
					</li>
					<li>
						<label class="title" for="txt6" style="width: 130px;">Parameter:</label><input type="text" name="txt6" id="txt6" style="width: 61%;"/>
					</li>
					<li>
						<label class="title" for="txt7" style="width: 130px;">Plan Qty.:</label><input type="text" name="txt7" id="txt7" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt8" style="width: 130px;">Actual Qty.:</label><input type="text" name="txt8" id="txt8" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt9" style="width: 130px;">Budget Mhrs.:</label><input type="text" name="txt9" id="txt9" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt10" style="width: 130px;">Earned Qty.:</label><input type="text" name="txt10" id="txt10" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt11" style="width: 130px;">Actual Mhrs.:</label><input type="text" name="txt11" id="txt11" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt12" style="width: 130px;">Productivity:</label><input type="text" name="txt12" id="txt12" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt13" style="width: 130px;">Erection Start:</label><input type="text" name="txt13" id="txt13" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt14" style="width: 130px;">Erection Complete:</label><input type="text" name="txt14" id="txt14" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="sel1" style="width: 130px;">Discipline:</label><select required name="sel1" id="sel1" style="width: 61%;"><option></option></select>
					</li>
					<li>
						<label class="title" for="rad1" style="width: 130px;">Status:</label><input type="radio" name="option" checked id="rad1" /><label class="title short" for="rad1">Active</label>
																							<input type="radio" name="option" id="rad2" /><label class="title short" for="rad2">Inactive</label>
					</li>
					<li style="text-align: right;">
						<hr style="margin-bottom: 5px;" />
						<button class="k-button" id="saveButt">Save</button>
						<button class="k-button" id="canButt">Cancel</button>						
					</li>
				</ul>
			</fieldset>
		</div>
	    <div class="wrap-grid demo-section" style="width: 60%;margin-left: 0;height: auto;">
	        <div id="rowSelection"></div>
	    </div>
	</div>
	<div class="wrap-button demo-section">
		<div class="buttonLeft">
        	<button class="k-button mainEve" id="addButt">Add</button>
        	<button class="k-button mainEve" id="editButt">Edit</button>
        	<button class="k-button mainEve" id="delButt">Delete</button>
       	</div>
		<div class="buttonRight">
        	<button class="k-button mainEve" id="closeButt">Close</button>
       	</div>				
	</div>
</div>
<script type="text/javascript">
	var discipline_code = $("#sel1").data("kendoDropDownList");
	function grid_change(e){
		if (typeof e == "undefined")
			e = grid;
	    var selectedRows = e.select();
	    var selectedDataItems = [];
	    for (var i = 0; i < selectedRows.length; i++) {
	      dataItem = e.dataItem(selectedRows[i]);
		    $("#txt1").val(dataItem.fwbs_code);
		    $("#textarea").val(dataItem.fwbs_desc);
		    $("#txt2").val(dataItem.fwbs_sdesc);
		    $("#txt3").val(dataItem.activity);
		    $("#txt4").val(dataItem.group_code);
		    $("#txt5").data("kendoNumericTextBox").value(dataItem.unit_rate);
		    $("#txt6").data("kendoNumericTextBox").value(dataItem.parameters);
		    $("#txt7").data("kendoNumericTextBox").value(dataItem.plan_qty);
		    $("#txt8").data("kendoNumericTextBox").value(dataItem.actual_qty);
		    $("#txt9").data("kendoNumericTextBox").value(dataItem.budget_mhrs);
		    $("#txt10").data("kendoNumericTextBox").value(dataItem.earned_mhrs);
		    $("#txt11").data("kendoNumericTextBox").value(dataItem.actual_mhrs);
		    $("#txt12").data("kendoNumericTextBox").value(dataItem.productivity);
		    $("#txt13").data("kendoDatePicker").value(kendo.toString(dataItem.erection_start,"MM/dd/yyyy"));
		    $("#txt14").data("kendoDatePicker").value(kendo.toString(dataItem.erection_complete,"MM/dd/yyyy"));
		    discipline_code.value(dataItem.discipline_code);
		    $("#rad1").prop("checked",(dataItem.flg_status == 1));
		    $("#rad2").prop("checked",(dataItem.flg_status != 1));
	    }   
	}
	function forDiv(){
		var container = $("#rowSelection");
		var position = container.offset();	
		var offsetHeight = container.height();	
		var offsetWidth = container.width();
		var newDiv = $("<div id = 'coverDiv'>").appendTo($("body"));
		newDiv.offset(position);
		newDiv.height(offsetHeight);	
		newDiv.width(offsetWidth - 17);
	}
	$(document).ready(function(){
		$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
		var crudService = crudServiceBaseUrl + "qms/index/", isFailed = false,
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", cMode = "", fieldSort = "", dirSort = "";
        
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/fwbs",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/fwbs",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	console.log(jqXHR);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                update: {
                    url: crudService + "manage/fwbs",
                    type: "POST"
                },
                destroy: {
                    url: crudService + "remove/fwbs",
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
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "drawing_no");
				    query = filterFArr;
				    dirSort = ($(data.sort).length ? data.sort[0].dir : "desc")
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "logdate"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        }
			      }else {
			      	  data['loguser'] = $("#hidden_user").val();
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
                        fwbs_code: { type: "string" },
                        activity: { type: "string" },
                        fwbs_desc: { type: "string" },
                   	    unit_rate: { type: "number" },
                        loguser: { type: "string" },
                        logdate: { type: "date" },
                        logupdate: { type: "string" },
                        erection_start: { type: "date" },
                        erection_complete: { type: "date" }
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
               {field: "fwbs_code",title: "FWBS Code",width: 102},
               {field: "activity",title: "Activity",width: 88},
               {field: "fwbs_desc",title: "Description",width: 133},
               {field: "unit_rate",title: "Unit Rate",width: 85},
               {field: "loguser",title: "Log User",width: 82},
               {field: "logdate",title: "Log Date",width: 200},
               {field: "logupdate",title: "Log Update",width: 133}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
			    grid_change(currRow);
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle("#rowSelection","FWBS Listing");
        
        var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");
	    
	    $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
	    discipline_code = $("#sel1").removeClass('k-state-disabled').kendoDropDownList({
	    	optionLabel: 'Select Discipline...',
	    	enable: false,
            dataTextField: "discipline_desc",
            dataValueField: "discipline_code",
            autoBind: true,
            dataSource: {   	
		    	transport: {
		    		read: crudService + "directCall/disc"
		    	},
		    	schema: {
	                data: function(data) {
	                    return data.rows || [];
	                }	    		
		    	}
		    }
	    }).data("kendoDropDownList");
	    
	    $("#txt5, #txt6, #txt7, #txt8, #txt9, #txt10, #txt11, #txt12").removeClass('k-state-disabled').kendoNumericTextBox({
	    	format: 'n',
	    	enable: false
	    });
		var unit_rate = $("#txt5").data("kendoNumericTextBox");
		var parameters = $("#txt6").data("kendoNumericTextBox");
		var plan_qty = $("#txt7").data("kendoNumericTextBox");
		var actual_qty = $("#txt8").data("kendoNumericTextBox");
		var budget_mhrs = $("#txt9").data("kendoNumericTextBox");
		var earned_mhrs = $("#txt10").data("kendoNumericTextBox");
		var actual_mhrs = $("#txt11").data("kendoNumericTextBox");
		var productivity = $("#txt12").data("kendoNumericTextBox");
	    $("#txt13, #txt14").removeClass('k-state-disabled').kendoDatePicker({
	    	format: 'MM/dd/yyyy',
	    	enable: false
	    });
	    var erection_start = $("#txt13").data("kendoDatePicker");
	    var erection_complete = $("#txt14").data("kendoDatePicker");
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
	    			default:
						$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
						unit_rate.enable(true);
						parameters.enable(true);
						plan_qty.enable(true);
						actual_qty.enable(true);
						budget_mhrs.enable(true);
						earned_mhrs.enable(true);
						actual_mhrs.enable(true);
						productivity.enable(true);
						erection_start.enable(true);
						erection_complete.enable(true);
						discipline_code.enable(true);
		    			if (this.id == "addButt"){
		    				isFailed = false;
							$(".wrap-form input, .wrap-form textarea").val("");
							$(".wrap-form input").eq(0).select().focus();
							$('#rad1').prop("checked", true);
							$('input[name=option]').prop("disabled", true);
							cMode = "add";
		    			}else {
							$("#txt1").prop("disabled", true).addClass("k-state-disabled");
							$(".wrap-form textarea").select().focus();
							cMode = "edit";
						}
						$(".wrap-button button").prop("disabled", true).addClass("k-state-disabled");
						forDiv();
	    			break;
	    		}
	    	}
	    });
	    $(".wrap-form button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "saveButt":
	    				if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
	    				isFailed = verifyThisInput(".formLeft_qms");
			    		if (isFailed)
			    			return true;
	    				
						if (cMode == "add"){
							dataSource.add({PROGRESS_RECID: 0,
											fwbs_code: $("#txt1").val(),
											fwbs_desc: $("#textarea").val(),
											fwbs_sdesc: $("#txt2").val(),
											activity: $("#txt3").val(),
											group_code: $("#txt4").val(),
											unit_rate: unit_rate.value(),
											parameters: parameters.value(),
											plan_qty: plan_qty.value(),
											actual_qty: actual_qty.value(),
											budget_mhrs: budget_mhrs.value(),
											earned_mhrs: earned_mhrs.value(),
											actual_mhrs: actual_mhrs.value(),
											productivity: productivity.value(),
											erection_start: kendo.toString(erection_start.value(),"yyyy-MM-dd"),
											erection_complete: kendo.toString(erection_complete.value(),"yyyy-MM-dd"),
											discipline_code: discipline_code.value(),
											flg_status: ($("#rad1").is(":checked") ? 1 : 0)});
							dataSource.sync();
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/fwbs",{PROGRESS_RECID: dataItem.PROGRESS_RECID,fwbs_code: $("#txt1").val(), fwbs_desc: $("#textarea").val(), fwbs_sdesc: $("#txt2").val(), activity: $("#txt3").val(),	group_code: $("#txt4").val(), unit_rate: unit_rate.value(), parameters: parameters.value(),	plan_qty: plan_qty.value(), actual_qty: actual_qty.value(),	budget_mhrs: budget_mhrs.value(), earned_mhrs: earned_mhrs.value(), actual_mhrs: actual_mhrs.value(), productivity: productivity.value(),	erection_start: kendo.toString(erection_start.value(),"yyyy-MM-dd"), erection_complete: kendo.toString(erection_complete.value(),"yyyy-MM-dd"), discipline_code: discipline_code.value(), flg_status: ($("#rad1").is(":checked") ? 1 : 0)},
					       	    function(data){
									$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
									$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									$("#rowSelection").data("kendoGrid").dataSource.read();
					       	    });
	    			break;
	    			default:
	    				$(".thisIsRequired").removeClass('thisIsRequired');
		    			isFailed = false;
			    		grid_change(currRow);
	    			break;
	    		}
	    		if (isFailed)
	    			return true;
				$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
				unit_rate.enable(false);
				parameters.enable(false);
				plan_qty.enable(false);
				actual_qty.enable(false);
				budget_mhrs.enable(false);
				earned_mhrs.enable(false);
				actual_mhrs.enable(false);
				productivity.enable(false);
				erection_start.enable(false);
				erection_complete.enable(false);
				discipline_code.enable(false);
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				$("#coverDiv").remove();
	    	}
	    });
	});
</script>