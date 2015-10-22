<div id="main-wrapper">
	<div class="wrap-header demo-section">
		<fieldset>
			<legend> Filter Option: </legend>
			<label><input type="radio" name="option1" id="option1" checked /> All </label>
			<label><input type="radio" name="option1" id="option2" /> Year </label>
			<label><input type="radio" name="option1" id="option3" /> Month </label>
            <span class="k-textbox k-space-right">
                <input type="text" value="" name="search" id="search" />
                <a href="#" class="k-icon k-i-search">&nbsp;</a>
            </span>
			
		</fieldset>
	</div>
	<div style="margin-bottom: 5px;">
		<div class="wrap-form demo-section apply8" style="width: 37.1%;float:right;height: auto;display: block;">
			<fieldset>
				<legend> Workability Entry: </legend>
				<ul class="formLeft_qms" style="width: 100%;">
					<li>
						<label class="title" for="txt1" style="width: 130px;">Year:</label><input required type="text" name="txt1" id="txt1" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="sel1" style="width: 130px;">Month:</label><select required name="sel1" id="sel1" style="width: 61%;">
							<option value="">Select Month...</option>
							<option value="January">January</option>
							<option value="February">February</option>
							<option value="March">March</option>
							<option value="April">April</option>
							<option value="May">May</option>
							<option value="June">June</option>
							<option value="July">July</option>
							<option value="August">August</option>
							<option value="September">September</option>
							<option value="October">October</option>
							<option value="November">November</option>
							<option value="December">December</option>
						</select>
					</li>
					<li>
						<label class="title" for="sel2" style="width: 130px;">Week:</label><select required name="sel2" id="sel2" style="width: 61%;">
							<option value="">Select Week...</option>
							<option value="Week 1">Week 1</option>
							<option value="Week 2">Week 2</option>
							<option value="Week 3">Week 3</option>
							<option value="Week 4">Week 4</option>
							<option value="Week 5">Week 5</option>
						</select>
					</li>
					<li>
						<label class="title" for="txt2" style="width: 130px;">Cut-Off:</label><input required type="text" name="txt2" id="txt2" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt3" style="width: 130px;">Plan Qty.:</label><input required type="text" name="txt3" id="txt3" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt4" style="width: 130px;">Productivity:</label><input required type="text" name="txt4" id="txt4" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt5" style="width: 130px;">Budget Mhrs.:</label><input type="text" name="txt5" id="txt5" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt6" style="width: 130px;">Plan Manpower:</label><input type="text" name="txt6" id="txt6" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt7" style="width: 130px;">Actual Manpower:</label><input type="text" name="txt7" id="txt7" class="k-state-disabled" disabled style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="rad1" style="width: 130px;">Status:</label><input type="radio" name="option" checked id="rad1" /><label class="title short" for="rad1">Fab</label>
																							<input type="radio" name="option" id="rad2" /><label class="title short" for="rad2">Field</label>
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
	        <label class="title" for="txt8" style="width: 62px;text-align: right;margin: 0 5px 0 0;">Log User:</label><input type="text" name="txt8" id="txt8" class="k-textbox k-state-disabled" disabled style="width: 100px;" />
	        <label class="title" for="txt9" style="width: 62px;text-align: right;margin: 0 5px 0 0;">Log Date:</label><input type="text" name="txt9" id="txt9" class="k-state-disabled" disabled style="width: 110px;" />
	        <label class="title" for="txt10" style="width: 78px;text-align: right;margin: 0 5px 0 0;">Log Update:</label><input type="text" name="txt10" id="txt10" class="k-textbox k-state-disabled" disabled style="width: 166px;" />
	    </div>
	</div>
	<div class="wrap-button demo-section">
		<div class="buttonLeft">
        	<button class="k-button mainEve" id="addButt">Add</button>
        	<button class="k-button mainEve" id="editButt">Edit</button>
        	<button class="k-button mainEve" id="delButt">Delete</button>
        	<button class="k-button mainEve" id="updButt">Update Week</button>
       	</div>
		<div class="buttonRight">
        	<button class="k-button mainEve" id="closeButt">Close</button>
       	</div>				
	</div>
</div>
<script type="text/javascript">
	function grid_change(e){
		if (typeof e == "undefined")
			e = grid;
	    var selectedRows = e.select();
	    var selectedDataItems = [];
	    for (var i = 0; i < selectedRows.length; i++) {
	      dataItem = e.dataItem(selectedRows[i]);
		    $("#txt1").data("kendoNumericTextBox").value(dataItem.year);
		    $("#sel1").data("kendoDropDownList").value(dataItem.month);
		    $("#sel2").data("kendoDropDownList").value(dataItem.week);
		    $("#txt2").data("kendoDatePicker").value(kendo.toString(dataItem.cut_off_date,"MM/dd/yyyy"));
		    $("#txt3").data("kendoNumericTextBox").value(dataItem.plan_qty);
		    $("#txt4").data("kendoNumericTextBox").value(dataItem.productivity);
		    $("#txt5").data("kendoNumericTextBox").value(dataItem.budget_mhrs);
		    $("#txt6").data("kendoNumericTextBox").value(dataItem.plan_manpower);
		    $("#txt7").data("kendoNumericTextBox").value(dataItem.actual_manpower);
		    $("#txt8").val(dataItem.log_user);
		    $("#txt9").data("kendoDatePicker").value(kendo.toString(dataItem.log_date,"MM/dd/yyyy"));
		    $("#txt10").val(dataItem.log_update);
		    $("#rad1").prop("checked",(dataItem.type == 1));
		    $("#rad2").prop("checked",(dataItem.type != 1));
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
                    url: crudService + "directCall/work",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/work",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	console.log(jqXHR);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                update: {
                    url: crudService + "manage/work",
                    type: "POST"
                },
                destroy: {
                    url: crudService + "remove/work",
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
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc")
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
                        year: { type: "number" },
                        cut_off_date: { type: "date" },
                        plan_qty: { type: "number" },
                        productivity: { type: "number" },
                        budget_mhrs: { type: "number" },
                        plan_manpower: { type: "number" },
                        actual_manpower: { type: "number" },
                        log_date: { type: "date" }
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
               {field: "year",title: "Year",width: 57},
               {field: "month",title: "Month",width: 86},
               {field: "week",title: "Week",width: 66},
               {field: "plan_qty",title: "Plan Qty.",width: 99},
               {field: "plan_manpower",title: "Plan Manhours",width: 117},
               {field: "actual_manpower",title: "Actual Manhours",width: 175}
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
        insertGridTitle("#rowSelection","Workability Listing");
        
        var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");
	    $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
	    $("#txt1").removeClass('k-state-disabled').kendoNumericTextBox({
	    	format: '0000',
	    	enable: false
	    });
	    $("#txt3, #txt4, #txt5, #txt6, #txt7").removeClass('k-state-disabled').kendoNumericTextBox({
	    	format: 'n',
	    	enable: false
	    });
	    $("#txt2, #txt9").removeClass('k-state-disabled').kendoDatePicker({
	    	format: 'MM/dd/yyyy',
	    	enable: false
	    });
	    $("#sel1, #sel2").removeClass('k-state-disabled').kendoDropDownList({
	    	enable: false
	    });
	    var year = $("#txt1").data("kendoNumericTextBox");
	    var month = $("#sel1").data("kendoDropDownList");
	    var week = $("#sel2").data("kendoDropDownList");
	    var cut_off_date = $("#txt2").data("kendoDatePicker");
	    var plan_qty = $("#txt3").data("kendoNumericTextBox");
	    var productivity = $("#txt4").data("kendoNumericTextBox");
	    var budget_mhrs = $("#txt5").data("kendoNumericTextBox");
	    var plan_manpower = $("#txt6").data("kendoNumericTextBox");
	    var actual_manpower = $("#txt7").data("kendoNumericTextBox");
	   	actual_manpower.value(0);
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
	    			case "updButt":
						open_preloader();
		    			$.post(crudService + "directCall/updWeek", {},
		    				function(data){
								showNotif((data.rows[0].return_value == 1) ? "Information" : "Warning",(data.rows[0].return_value == 1) ? "Update Successful!" : "Update Failed!",(data.rows[0].return_value == 1) ? "info" : "warning");
								if (data.rows[0].return_value == 1){
									$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
									$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									$("#rowSelection").data("kendoGrid").dataSource.read();									
								}
								close_preloader();
		    				});
	    			break;
	    			default:
	    				cut_off_date.enable(true);
	    				plan_qty.enable(true);
	    				productivity.enable(true);
	    				budget_mhrs.enable(true);
	    				plan_manpower.enable(true);
						$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
	    				actual_manpower.enable(false);
		    			if (this.id == "addButt"){
		    				isFailed = false;
		    				year.enable(true);
		    				month.enable(true);
		    				week.enable(true);
							$(".wrap-form input, .wrap-form textarea, .wrap-form select").val("");
							year.focus();
							$('#rad1').prop("checked", true);
							cMode = "add";
		    			}else {
							$("#txt1").prop("disabled", true).addClass("k-state-disabled");
							cut_off_date.focus();
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
											year: year.value(),
											month: month.value(),
											week: week.value(),
											cut_off_date: kendo.toString(cut_off_date.value(),"yyyy-MM-dd"),
											plan_qty: plan_qty.value(),
											productivity: productivity.value(),
											budget_mhrs: budget_mhrs.value(),
											plan_manpower: plan_manpower.value(),
											actual_manpower: actual_manpower.value(),
											type: ($("#rad1").is(":checked") ? 1 : 0)});
							dataSource.sync();
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/work",{PROGRESS_RECID: dataItem.PROGRESS_RECID, year: year.value(), month: month.value(), week: week.value(),	cut_off_date: kendo.toString(cut_off_date.value(),"yyyy-MM-dd"), plan_qty: plan_qty.value(),	productivity: productivity.value(),	budget_mhrs: budget_mhrs.value(), plan_manpower: plan_manpower.value(), actual_manpower: actual_manpower.value(), type: ($("#rad1").is(":checked") ? 1 : 0)},
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
				year.enable(false);
				month.enable(false);
				week.enable(false);
				cut_off_date.enable(false);
				plan_qty.enable(false);
				productivity.enable(false);
				budget_mhrs.enable(false);
				plan_manpower.enable(false);
				$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				$("#coverDiv").remove();
	    	}
	    });
		$(".wrap-header input[type=radio]").bind({
			click: function(e){
				switch(this.id){
					case "option1":
						if ($("#search").val() != ""){
							$("#search").val("").select().focus();
							$("#rowSelection").data("kendoGrid").dataSource.page(1);
							$("#rowSelection").data("kendoGrid").dataSource.read();
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
			$("#rowSelection").data("kendoGrid").dataSource.page(1);
			$("#rowSelection").data("kendoGrid").dataSource.read();
		});
		$("#search").bind({
			keyup: function(e){
				if (e.keyCode == 13){
					sentValue = this.value;
					$("#rowSelection").data("kendoGrid").dataSource.page(1);
					$("#rowSelection").data("kendoGrid").dataSource.read();
				}
			}
		});
  
		$("#main-wrapper > div").eq(1).css({"min-height": ((parseInt($(".wrap-form").height()) + 12) + "px")});
	});
</script>