<div id="main-wrapper">
	<div style="margin-bottom: 5px;">
		<div class="wrap-form demo-section apply8" style="width: 37.1%;float:right;height: auto;display: block;">
			<fieldset>
				<legend> Rules of Credit Entry: </legend>
				<ul class="formLeft_qms" style="width: 100%;">
					<li>
						<label class="title" for="txt1" style="width: 130px;">ROC Code:</label><input type="text" required name="txt1" id="txt1" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="textarea" style="width: 130px;">Description:</label><textarea name="textarea" id="textarea" cols="20" rows="3" style="resize: none;width: 57%;margin: 0;"></textarea>
					</li>
					<li>
						<label class="title" for="txt2" style="width: 130px;">Short Desc.:</label><input type="text" name="txt2" id="txt2" class="k-textbox" style="width: 61%;" />
					</li>
					<li>						
	    				<label class="title" for="sel2" style="width: 130px;text-align: right;margin-right: 5px;">ROC Type:</label><select required name="sel2" id="sel2" style="width: 61%;"><option></option></select>
					</li>
					<li>
						<label class="title" for="txt3" style="width: 130px;">Percent Wt.:</label><input type="text" name="txt3" id="txt3" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt4" style="width: 130px;">Seq. No.:</label><input type="text" name="txt4" id="txt4" style="width: 61%;" />
					</li>
					<li>
						<fieldset>
							<label class="title" for="rad1" style="width: 123px;">Compute Basis:</label><input type="radio" name="option" checked id="rad1" /><label class="title short" for="rad1">Weight</label>
																										<input type="radio" name="option" id="rad2" /><label class="title short" for="rad2">Foundation</label>
						</fieldset>
					</li>
					<li>
						<fieldset>
							<ul>
								<li>
									<label class="title" for="chk1" style="width: 123px;">&nbsp;</label><input type="checkbox" name="chk1" id="chk1" /><label class="title short" for="chk1">Billing ROC</label>									
								</li>
								<li>
									<label class="title" for="txt5" style="width: 123px;">Percent Wt.:</label><input type="text" name="txt5" id="txt5" style="width: 62%;" />
								</li>
								<li>
									<label class="title" for="txt6" style="width: 123px;">Seq. No.:</label><input type="text" name="txt6" id="txt6" style="width: 62%;" />
								</li>
							</ul>
						</fieldset>
					</li>
					<li>
						<label class="title" for="rad3" style="width: 130px;">Status:</label><input type="radio" name="option1" checked id="rad3" /><label class="title short" for="rad3">Active</label>
																							 <input type="radio" name="option1" id="rad4" /><label class="title short" for="rad4">Inactive</label>
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
	    	<label class="title" for="sel1" style="width: 130px;text-align: right;margin-right: 5px;">ROC Type:</label><select required name="sel1" id="sel1" style="width: 61%;"><option></option></select>
	        <div id="rowSelection"></div>
			<label class="title" for="txt7" style="width: 476px;text-align: right;margin: 0 5px 0 0;">Total Percent (%) Wt.:</label><input type="text" name="txt7" id="txt7" disabled style="width: 20%;" />
	    </div>
	</div>
	<div class="wrap-button demo-section">
		<div class="buttonLeft">
        	<button class="k-button mainEve k-state-disabled" disabled id="addButt">Add</button>
        	<button class="k-button mainEve k-state-disabled" disabled id="editButt">Edit</button>
        	<button class="k-button mainEve k-state-disabled" disabled id="delButt">Delete</button>
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
		    $("#txt1").val(dataItem.roc_code);
		    $("#textarea").val(dataItem.roc_desc);
		    $("#txt2").val(dataItem.roc_sdesc);
		    //discipline_code.value(dataItem.discipline);
		    $("#sel2").data("kendoDropDownList").value(dataItem.discipline);
		    $("#txt3").data("kendoNumericTextBox").value(dataItem.pct_wt);
		    $("#txt4").data("kendoNumericTextBox").value(dataItem.seq_no);
		    $("#rad1").prop("checked",(dataItem.comp_basis == 1));
		    $("#rad2").prop("checked",(dataItem.comp_basis != 1));
		    $("#chk1").prop("checked",(dataItem.billing_roc == 1));
		    $("#txt5").data("kendoNumericTextBox").value(dataItem.pct_wt_bill);
		    $("#txt6").data("kendoNumericTextBox").value(dataItem.seq_no_bill);
		    $("#rad3").prop("checked",(dataItem.flg_status == 1));
		    $("#rad4").prop("checked",(dataItem.flg_status != 1));
		    $("#txt7").data("kendoNumericTextBox").value(dataItem.totalPct);
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
        
	    var roc_type = $("#sel1").removeClass('k-state-disabled').kendoDropDownList({
	    	optionLabel: 'Select ROC Type...',
	    	enable: true,
            dataTextField: "type_desc",
            dataValueField: "roc_type",
            autoBind: false,
            dataSource: {   	
		    	transport: {
		    		read: crudService + "directCall/rocDD"		    		
		    	},
		    	schema: {
	                data: function(data) {
	                    return data.rows || [];
	                }	    		
		    	}
		    },
		    change: function(e){
		    	if (this.value() == "")
		    		$("#addButt").prop("disabled", true).addClass("k-state-disabled");
		    	else
		    		$("#addButt").prop("disabled", false).removeClass("k-state-disabled");
		    		
		    	$("#editButt, #delButt").prop("disabled", true).addClass("k-state-disabled");
		    	dataSource.read();
		    },
		    dataBound: function(e){
		    	if (this.value() == "")
		    		$("#addButt, #editButt, #delButt").prop("disabled", true).addClass("k-state-disabled");
		    	else
		    		$("#addButt").prop("disabled", false).removeClass("k-state-disabled");
		    				    		
		    	$("#editButt, #delButt").prop("disabled", true).addClass("k-state-disabled");
		    	dataSource.read();		    	
		    }
	    }).data("kendoDropDownList");
        
	    var discipline_code = $("#sel2").removeClass('k-state-disabled').kendoDropDownList({
	    	optionLabel: 'Select Discipline...',
	    	enable: false,
            dataTextField: "discipline_desc",
            dataValueField: "discipline_code",
            autoBind: false,
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
	    
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/rocTbl",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/rocTbl",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                update: {
                    url: crudService + "manage/rocTbl",
                    type: "POST"
                },
                destroy: {
                    url: crudService + "remove/rocTbl",
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
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    roc_type: roc_type.value() 
			        }
			      }else {
			      	  data['loguser'] = $("#hidden_user").val();
			      	  data['roc_type'] = roc_type.value();
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
                   	    pct_wt: { type: "number"},
                   	    totalPct: { type: "number"}
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
               {field: "roc_code",title: "Code",width: 102},
               {field: "roc_desc",title: "Description"},
               {field: "pct_wt",title: "PCT% Wt.",width: 100}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			        
			    	$("#editButt, #delButt").prop("disabled", false).removeClass("k-state-disabled");
			    }
			    grid_change(currRow);
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle("#rowSelection","Rules of Credit Listing");
        
        var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");
	    $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
	    $("#txt3, #txt4, #txt5, #txt6, #txt7").removeClass("k-state-disabled").kendoNumericTextBox({
	    	format: 'n',
	    	enable: false
	    });
	    var pct_wt = $("#txt3").data("kendoNumericTextBox");
	    var seq_no = $("#txt4").data("kendoNumericTextBox");
	    var pct_wt_bill = $("#txt5").data("kendoNumericTextBox");
	    var seq_no_bill = $("#txt6").data("kendoNumericTextBox");
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
	    				roc_type.enable(false);
	    				discipline_code.enable(true);
	    				pct_wt.enable(true);
	    				seq_no.enable(true);
	    				pct_wt_bill.enable(true);
	    				seq_no_bill.enable(true);
						$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
		    			if (this.id == "addButt"){
		    				isFailed = false;
							$(".wrap-form input, .wrap-form textarea").val("");
							$(".wrap-form input").eq(0).select().focus();
							$('#rad3').prop("checked", true);
							$('input[name=option1]').prop("disabled", true);
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
	    				
	    				isFailed = verifyThisInput(".wrap-form");
			    		if (isFailed)
			    			return true;
	    				
						if (cMode == "add"){
							dataSource.add({PROGRESS_RECID: 0,
											roc_code: $("#txt1").val(),
											roc_desc: $("#textarea").val(),
											roc_sdesc: $("#txt2").val(),
											discipline: discipline_code.value(),
											pct_wt: $("#txt3").val(),
											seq_no: $("#txt4").val(),
											comp_basis: ($("#rad1").is(":checked") ? 1 : 0),
											billing_roc: ($("#chk1").is(":checked") ? 1 : 0),
											pct_wt_bill: $("#txt5").val(),
											seq_no_bill: $("#txt6").val(),
											flg_status: ($("#rad3").is(":checked") ? 1 : 0)});
							dataSource.sync();
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/rocTbl",{PROGRESS_RECID: dataItem.PROGRESS_RECID, roc_code: $("#txt1").val(),	roc_desc: $("#textarea").val(),	roc_sdesc: $("#txt2").val(), discipline: discipline_code.value(), pct_wt: $("#txt3").val(), seq_no: $("#txt4").val(), comp_basis: ($("#rad1").is(":checked") ? 1 : 0), billing_roc: ($("#chk1").is(":checked") ? 1 : 0), pct_wt_bill: $("#txt5").val(), seq_no_bill: $("#txt6").val(), flg_status: ($("#rad3").is(":checked") ? 1 : 0)},
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
	    		roc_type.enable(true);
	    		discipline_code.enable(false);
				pct_wt.enable(false);
				seq_no.enable(false);
				pct_wt_bill.enable(false);
				seq_no_bill.enable(false);
				$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				$("#coverDiv").remove();
	    	}
	    });
  
		$("#main-wrapper > div").eq(0).css({"min-height": ((parseInt($(".wrap-form").height()) + 12) + "px")});
	});
</script>