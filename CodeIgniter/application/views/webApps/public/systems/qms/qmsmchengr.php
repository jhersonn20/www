<style>
	.mech_spl .wrap-form ul li input[type="text"] {
		width: 73px !important;
	}
</style>
<div id="main-wrapper">
	<div class="mech_spl">
		<div style="min-height: 316px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 37.9%;float:right;height: auto;display: block;">
				<fieldset>
					<legend> ISO Drawing Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="txt1" style="width: 90px;">Area No.:</label><input type="text" name="txt1" id="txt1" class="k-textbox" style="width: 100px !important;" />
							<label class="title short" for="txt2" style="width: 62px;">Plant No.:</label><input type="text" name="txt2" id="txt2" class="k-textbox" style="width: 100px !important;" />
						</li>
						<li>
							<label class="title" for="txt3" style="width: 90px;">Drawing No.:</label><input type="text" name="txt3" id="txt3" class="k-textbox" style="width: 74% !important;"/>
						</li>
						<li>
							<label class="title" for="txt4" style="width: 90px;">Sheet No.:</label><input type="text" name="txt4" id="txt4" class="k-textbox" style="width: 100px !important;" />
							<label class="title short" for="txt5" style="width: 62px !important;">Rev. No.:</label><input type="text" name="txt5" id="txt5" class="k-textbox" style="width: 100px !important;float:right;" />
						</li>
						<li>
							<label class="title" for="txt6" style="width: 90px;">Priority No.:</label><input type="text" name="txt6" id="txt6" style="width: 100px !important;" />
							<label class="title short" for="txt7" style="width: 62px !important;">Total Wt.:</label><input type="text" name="txt7" id="txt7" style="width: 100px !important;" />
						</li>
						<li>
							<label class="title" for="txt8" style="width: 90px;">Doc No.:</label><input type="text" name="txt8" id="txt8" class="k-textbox" style="width: 74% !important;" />
						</li>
						<li>
							<label class="title" for="textarea" style="width: 90px;">Remarks:</label><textarea name="textarea" id="textarea" cols="20" rows="3" style="resize: none;width: 73%;margin: 0;padding: 0;"></textarea>
						</li>
						<li>
							<label class="title" for="sel1" style="width: 90px;">ISO Status:</label>
							<select name="sel1" id="sel1" style="width: 100px;">
								<option selected value="ACTIVE">Active</option>
								<option value="CANCELLED">Cancelled</option>
								<option value="SUPERSEDED">Superseded</option>							
							</select>
							<label class="title short" for="txt9" style="width: 62px !important;">Vendor:</label><input type="text" name="txt9" id="txt9" class="k-textbox" style="width: 100px !important;float:right;" />
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
	        	<button class="k-button mainEve" id="editButt">Edit</button>
	        	<button class="k-button mainEve" id="delButt">Delete</button>
	       	</div>
			<!-- <div class="buttonRight">
	        	<button class="k-button mainEve" id="closeButt">Close</button>
	       	</div> -->				
		</div>
	</div>
	<div class="equip_spl" style="margin-top: 5px;">
		<div style="min-height: 305px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 37.9%;float:right;height: auto;display: block;">
				<fieldset>
					<legend> Equipment Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="txt10" style="width: 95px;">Equip. No.:</label><input type="text" name="txt10" id="txt10" class="k-textbox" style="width: 72.5% !important;" />
						</li>
						<li>
							<label class="title" for="textarea1" style="width: 95px;">Equip. Desc.:</label><textarea name="textarea1" id="textarea1" cols="20" rows="3" style="resize: none;width: 72%;margin: 0;padding: 0;"></textarea>
						</li>
						<li>
							<label class="title" for="txt11" style="width: 95px;">Jet Nos.:</label><input type="text" name="txt11" id="txt11" class="k-textbox" style="width: 72.5% !important;" />
						</li>
						<li>
							<label class="title" for="txt12" style="width: 95px;">Location:</label><input type="text" name="txt12" id="txt12" class="k-textbox" style="width: 72.5% !important;" />
						</li>
						<li>
							<label class="title" for="txt13" style="width: 95px;">Date Received:</label><input type="text" name="txt13" id="txt13" style="width: 110px;" />
						</li>
						<li>
							<label class="title" for="textarea2" style="width: 95px;">Remarks:</label><textarea name="textarea2" id="textarea2" cols="20" rows="3" style="resize: none;width: 72%;margin: 0;padding: 0;"></textarea>
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
		        <div id="equip_rs"></div>
		    </div>
		</div>
		<div class="wrap-button demo-section">
			<div class="buttonLeft">
	        	<button class="k-button mainEve" id="addButt2">Add</button>
	        	<button class="k-button mainEve" id="editBut2t">Edit</button>
	        	<button class="k-button mainEve" id="delButt2">Delete</button>
        		<button class="k-button mainEve" id="exportButt">Export</button>
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
		    $("#txt2").val(dataItem.plant_no);
		    $("#txt3").val(dataItem.drawing_no);
		    $("#txt4").val(dataItem.sheet_no);
		    $("#txt5").val(dataItem.rev_no);
		    $("#txt6").data("kendoNumericTextBox").value(dataItem.priority_no);
		    $("#txt7").data("kendoNumericTextBox").value(dataItem.tot_weight);
		    $("#txt8").val(dataItem.docno);
		    $("#txt9").val(dataItem.supp_code);
		    $("#textarea").val(dataItem.remarks);
		    $("#sel1").data("kendoDropDownList").value(dataItem.iso_stat);
		  }else {
		    $("#txt10").val(dataItem.equip_no);
		    $("#txt11").val(dataItem.jet_nos);
		    $("#txt12").val(dataItem.location);
		    $("#txt13").val(kendo.toString(dataItem.received_dt,"MM/dd/yyyy"));
		    $("#textarea1").val(dataItem.equip_desc);
		    $("#textarea2").val(dataItem.remarks);
		  }
	    }   
	}
	function forDiv(){
		var container = $("#rowSelection");
		var container2 = $("#equip_rs");
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
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", cMode = "",
		    filterFArr_equip = [], filterOArr_equip = [], filterVArr_equip = [], sentValue_equip = "", fieldSort = "", dirSort = "", query = "";
                    
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/isoMech",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/isoMech",
                    type: "POST"
                },
                update: {
                    url: crudService + "manage/isoMech",
                    type: "POST"
                },
                destroy: {
                    url: crudService + "remove/isoMech",
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
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			    // console.log(type);
			    // console.log(response);
			},
            pageSize: 10,
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
                        drawing_no: { type: "string" },
                        sheet_no: { type: "string" },
                   	    rev_no: { type: "string" },
                        iso_stat: { type: "string" },
                        priority_no: { type: "number"},
                        tot_weight: { type: "number"}
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
               {field: "area_no",title: "Area No.",width: 66},
               {field: "drawing_no",title: "Drawing",width: 66},
               {field: "sheet_no",title: "Sheet",width: 125},
               {field: "rev_no",title: "Revision",width: 63},
               {field: "iso_stat",title: "Status",width: 77}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
			    grid_change(currRow,"#rowSelection");
			    equip_ds.read();
           },
           dataBound: addExtraStylingToGrid
        });
                    
        var equip_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/equipMech",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/equipMech",
                    type: "POST"
                },
                update: {
                    url: crudService + "manage/equipMech",
                    type: "POST"
                },
                destroy: {
                    url: crudService + "remove/equipMech",
                    type: "POST"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_equip[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_equip[index] = this.operator;
				      		filterVArr_equip[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "log_date");
				    query = filterFArr_equip;
				    dirSort = ($(data.sort).length ? data.sort[0].dir : "desc")
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_equip,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    operator: (($(data.filter).length > 0) ? filterOArr_equip : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_equip : sentValue_equip),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    plant_no: dataItem.plant_no,
					    area_no: dataItem.area_no,
					    drawing_no: dataItem.drawing_no,
					    sheet_no: dataItem.sheet_no,
					    rev_no: dataItem.rev_no
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			    // console.log(type);
			    // console.log(response);
			},
            pageSize: 10,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_equip.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue_equip = "";
					    filterFArr_equip = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        equip_no: { type: "string" },
                        equip_desc: { type: "string" },
                        location: { type: "string" },
                        received_dt: { type: "date"}
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
                                
	    // var addExtraStylingToGrid2 = function () {
			// $("#equip_rs").data("kendoGrid").select("tr:eq(1)");
	        // $("#equip_rs > .k-grid-content > table > tbody > tr").hover(
	            // function() {
	                // $(this).toggleClass("k-state-hover");
	            // }			        
	        // );
        	// filterFArr_equip = [];
	    // };
        
        var grid2 = $("#equip_rs").kendoGrid({
            dataSource: equip_ds,
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
               {field: "equip_no",title: "Equip. No.",width: 66},
               {field: "equip_desc",title: "Description",width: 125},
               {field: "location",title: "Location",width: 125}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
			    grid_change(currRow,"#equip_rs");
           }
           // ,dataBound: addExtraStylingToGrid2
        });
	    	            
	    $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
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
	    				
						dataRow = grid2.data("kendoGrid").dataSource.getByUid(dataItem.uid);
    					$("#equip_rs").data("kendoGrid").dataSource.remove(dataRow);
						equip_ds.sync();
						$("#equip_rs").data("kendoGrid").setDataSource(equip_ds);
						$("#equip_rs").data("kendoGrid").dataSource.page($("#equip_rs").data("kendoGrid").dataSource.page());
						$("#equip_rs").data("kendoGrid").dataSource.read();
	    				return true;
	    			break;
                	case "exportButt":
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_equipMech/?";
				        link.href += ("fieldS=" + fieldSort + "&");
				        link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
				        link.href += ("dir=" + dirSort + "&");
					    link.href += ("plant_no=" + dataItem.plant_no + "&");
					    link.href += ("area_no=" + dataItem.area_no + "&");
					    link.href += ("drawing_no=" + dataItem.drawing_no + "&");
					    link.href += ("sheet_no=" + dataItem.sheet_no + "&");
					    link.href += ("rev_no=" + dataItem.rev_no);
				 
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
							$(".mech_spl .wrap-form input, .mech_spl .wrap-form textarea, .mech_spl .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							priority_no.enable(true);
							tot_weight.enable(true);
							iso_stat.enable(true);
			    			if (this.id == "addButt"){
								$(".mech_spl .wrap-form input, .mech_spl .wrap-form textarea").val("");
								$(".mech_spl .wrap-form input").eq(0).select().focus();
								cMode = "add";
			    			}else {
								for(i=1;i<6;i++){
									$("#txt" + i).prop("disabled", true).addClass("k-state-disabled");
								}
								$(".mech_spl .wrap-form input").eq(5).select().focus();
								cMode = "edit";
							}
						}else {
							$(".equip_spl .wrap-form input, .equip_spl .wrap-form textarea, .equip_spl .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							received_dt.enable(true);
			    			if (this.id == "addButt2"){
								$(".equip_spl .wrap-form input, .equip_spl .wrap-form textarea").val("");
								$(".equip_spl .wrap-form input").eq(0).select().focus();
								cMode = "add";
			    			}else {
								$("#txt10").prop("disabled", true).addClass("k-state-disabled");
								$(".equip_spl.wrap-form input").eq(1).select().focus();
								cMode = "edit";
							}
						}
						$(".wrap-button button").prop("disabled", true).addClass("k-state-disabled");
						forDiv();
	    			break;
	    		}
	    	}
	    });
	    $(".mech_spl .wrap-form button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "saveButt":
	    				if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
						if (cMode == "add"){
							dataSource.add({PROGRESS_RECID: 0,
											area_no: $("#txt1").val(),
											plant_no: $("#txt2").val(),
											drawing_no: $("#txt3").val(),
											sheet_no: $("#txt4").val(),
											rev_no: $("#txt5").val(),
											priority_no: priority_no.value(),
											tot_weight: tot_weight.value(),
											docno: $("#txt8").val(),
											supp_code: $("#txt9").val(),
											remarks: $("#textarea").val(),
											iso_stat: $("#sel1").val(),
											log_user: $("#hidden_user").val()});
							dataSource.sync();
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/isoMech",{PROGRESS_RECID: dataItem.PROGRESS_RECID, area_no: $("#txt1").val(), plant_no: $("#txt2").val(), drawing_no: $("#txt3").val(), sheet_no: $("#txt4").val(), rev_no: $("#txt5").val(), priority_no: priority_no.value(), tot_weight: tot_weight.value(), docno: $("#txt8").val(), supp_code: $("#txt9").val(), remarks: $("#textarea").val(), iso_stat: $("#sel1").val(), log_user: $("#hidden_user").val()},
					       	    function(data){
									$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
									$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									$("#rowSelection").data("kendoGrid").dataSource.read();
					       	    });
	    			break;
	    			default:
			    		grid_change(currRow,"#rowSelection");
	    			break;
	    		}
				$(".mech_spl .wrap-form input, .mech_spl .wrap-form textarea, .mech_spl .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				priority_no.enable(false);
				tot_weight.enable(false);
				iso_stat.enable(false);
				$("#coverDiv").remove();
	    	}
	    });
	    $(".equip_spl .wrap-form button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "saveButt2":
	    				if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
						if (cMode == "add"){
							equip_ds.add({PROGRESS_RECID: 0,
											plant_no: dataItem.plant_no,
											area_no: dataItem.area_no,
											drawing_no: dataItem.drawing_no,
											sheet_no: dataItem.sheet_no,
											rev_no: dataItem.rev_no,
											equip_no: $("#txt10").val(),
											equip_desc: $("#textarea1").val(),
											jet_nos: $("#txt11").val(),
											location: $("#txt2").val(),
											received_dt: kendo.toString(received_dt.value(),"yyyy-MM-dd"),
											remarks: $("#textarea2").val(),
											log_user: $("#hidden_user").val()});
							equip_ds.sync();
							$("#equip_rs").data("kendoGrid").setDataSource(equip_ds);
							$("#equip_rs").data("kendoGrid").dataSource.page($("#equip_rs").data("kendoGrid").dataSource.page());
							$("#equip_rs").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/equipMech",{PROGRESS_RECID: dataItem.PROGRESS_RECID, plant_no: dataItem.plant_no, area_no: dataItem.area_no, drawing_no: dataItem.drawing_no, sheet_no: dataItem.sheet_no, rev_no: dataItem.rev_no, equip_no: $("#txt10").val(), equip_desc: $("#textarea1").val(), jet_nos: $("#txt11").val(), location: $("#txt2").val(), received_dt: kendo.toString(received_dt.value(),"yyyy-MM-dd"), remarks: $("#textarea2").val(), log_user: $("#hidden_user").val()},
					       	    function(data){
									$("#equip_rs").data("kendoGrid").setDataSource(equip_ds);
									$("#equip_rs").data("kendoGrid").dataSource.page($("#equip_rs").data("kendoGrid").dataSource.page());
									$("#equip_rs").data("kendoGrid").dataSource.read();
					       	    });
	    			break;
	    			default:
			    		grid_change(currRow,"#equip_rs");
	    			break;
	    		}
				$(".equip_spl .wrap-form input, .equip_spl .wrap-form textarea, .equip_spl .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				received_dt.enable(false);
				$("#coverDiv").remove();
	    	}
	    });
        var priority_no = $("#txt6").removeClass("k-state-disabled").kendoNumericTextBox({
        	enable: false
        }).data("kendoNumericTextBox");
        var tot_weight = $("#txt7").removeClass("k-state-disabled").kendoNumericTextBox({
        	enable: false
        }).data("kendoNumericTextBox");
        
        var iso_stat = $("#sel1").removeClass("k-state-disabled").kendoDropDownList({
        	enable: false
        }).data("kendoDropDownList");
                
        $("#txt13").removeClass("k-state-disabled").kendoDatePicker({
        	enable: false,
        	format: "MM/dd/yyyy"
        }).closest(".k-widget")
          .attr("id", "datepicker_wrapper");
          
        var received_dt = $("#txt13").data("kendoDatePicker");
	});
</script>