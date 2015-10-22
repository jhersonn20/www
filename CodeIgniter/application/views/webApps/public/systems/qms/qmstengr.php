<style>
	.struc_spl .wrap-form ul li input[type="text"] {
		width: 70px !important;
	}
	.piece_spl .wrap-form ul li input[type="text"] {
		width: 100px !important;
	}
</style>
<div id="main-wrapper">
	<div class="struc_spl">
		<div style="min-height: 353px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 37.9%;float:right;height: auto;display: block;">
				<fieldset>
					<legend> ISO Drawing Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="txt1" style="width: 90px;">Area No.:</label><input type="text" name="txt1" id="txt1" class="k-textbox" style="width: 30px !important;" />
							<input type="text" name="txt2" id="txt2" class="k-textbox" style="width: 237px !important;" />
						</li>
						<li>
							<label class="title" for="txt3" style="width: 90px;">FAB DWG No.:</label><input type="text" name="txt3" id="txt3" class="k-textbox" style="width: 95px !important;"/>
							<label class="title short" for="txt4" style="width: 30px !important;">Sht.:</label><input type="text" name="txt4" id="txt4" class="k-textbox" style="width: 50px !important;" />
							<label class="title short" for="txt5" style="width: 30px !important;">Rev.:</label><input type="text" name="txt5" id="txt5" class="k-textbox" style="width: 50px !important;" />
						</li>
						<li>
							<label class="title" for="txt6" style="width: 90px;">ERE DWG No.:</label><input type="text" name="txt6" id="txt6" class="k-textbox" style="width: 95px !important;"/>
							<label class="title short" for="txt7" style="width: 30px !important;">Sht.:</label><input type="text" name="txt7" id="txt7" class="k-textbox" style="width: 50px !important;" />
							<label class="title short" for="txt8" style="width: 30px !important;">Rev.:</label><input type="text" name="txt8" id="txt8" class="k-textbox" style="width: 50px !important;" />
						</li>
						<li>
							<label class="title" for="txt9" style="width: 90px;">DES DWG No.:</label><input type="text" name="txt9" id="txt9" class="k-textbox" style="width: 95px !important;"/>
							<label class="title short" for="txt10" style="width: 30px !important;">Sht.:</label><input type="text" name="txt10" id="txt10" class="k-textbox" style="width: 50px !important;" />
							<label class="title short" for="txt11" style="width: 30px !important;">Rev.:</label><input type="text" name="txt11" id="txt11" class="k-textbox" style="width: 50px !important;" />
						</li>
						<li>
							<label class="title" for="txt12" style="width: 90px;">Priority No.:</label><input type="text" name="txt12" id="txt12" style="width: 95px !important;" />
							<label class="title short" for="txt13" style="width: 63px !important;">Str. No.:</label><input type="text" name="txt13" id="txt13" class="k-textbox" style="width: 105px !important;float:right;" />
						</li>
						<li>
							<label class="title" for="txt14" style="width: 90px;">Doc. No.:</label><input type="text" name="txt14" id="txt14" class="k-textbox" style="width: 95px !important;" />
							<label class="title short" for="txt15" style="width: 63px !important;">Plant No.:</label><input type="text" name="txt15" id="txt15" class="k-textbox" style="width: 105px !important;" />
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
							<label class="title short" for="txt16" style="width: 57px !important;">Vendor:</label><input type="text" name="txt16" id="txt16" class="k-textbox" style="width: 105px !important;float:right;" />
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
	<div class="piece_spl" style="margin-top: 5px;">
		<div style="min-height: 414px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 47.9%;float:right;height: auto;display: block;">
				<fieldset>
					<legend> Piece Mark Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="txt31" style="width: 105px;">Piece Mark No.:</label><input type="text" name="txt31" id="txt31" class="k-textbox" style="width: 134px !important;" />
							<label class="title short" for="txt17" style="width: 88px !important;">Struc. Type.:</label><input type="text" name="txt17" id="txt17" class="k-textbox" style="width: 126px !important;" />
						</li>
						<li>
							<label class="title" for="txt18" style="width: 105px;">Description:</label><input type="text" name="txt18" id="txt18" class="k-textbox" style="width: 76.4% !important;" />
						</li>
						<li>
							<label class="title" for="txt19" style="width: 105px;">Quantity:</label><input type="text" name="txt19" id="txt19" style="width: 126px !important;" />
							<label class="title short" for="sel2" style="width: 96px !important;">Unit Measure:</label>
							<select name="sel2" id="sel2" style="width: 122px;">
								<option selected value="KGS">KGS</option>
								<option value="TONS">TONS</option>
								<option value="G">G</option>							
							</select>
						</li>
						<li>
							<label class="title" for="txt20" style="width: 105px;">Length:</label><input type="text" name="txt20" id="txt20" style="width: 126px !important;" />
							<label class="title short" for="txt21" style="width: 96px !important;">Unit Weight:</label><input type="text" name="txt21" id="txt21" style="width: 126px !important;" />
						</li>
						<li>
							<label class="title" for="txt22" style="width: 105px;">Location:</label><input type="text" name="txt22" id="txt22" style="width: 126px !important;" />
							<label class="title short" for="txt23" style="width: 96px !important;">Elevation:</label><input type="text" name="txt23" id="txt23" style="width: 126px !important;" />
						</li>
						<li>
							<label class="title" for="txt24" style="width: 105px;">FWBS No.:</label><input type="text" name="txt24" id="txt24" class="k-textbox" style="width: 134px !important;" />
							<input type="text" name="txt25" id="txt25" class="k-textbox" style="width: 218px !important;" />
						</li>
						<li>
							<label class="title" for="txt26" style="width: 105px;">Designation:</label><input type="text" name="txt26" id="txt26" class="k-textbox" style="width: 134px !important;" />
							<label class="title short" for="txt27" style="width: 88px !important;">Category:</label><input type="text" name="txt27" id="txt27" class="k-textbox" style="width: 126px !important;" />
						</li>
						<li>
							<label class="title" for="textarea1" style="width: 105px;">Remarks:</label><textarea name="textarea1" id="textarea1" cols="20" rows="3" style="resize: none;width: 75.8%;margin: 0;padding: 0;"></textarea>
						</li>
						<li>
							<label class="title" for="chk1" style="width: 105px;">&nbsp;</label><input type="checkbox" name="chk1" id="chk1" style="margin-right: 5px;" /><label class="title short" for="chk1" style="margin-right: 41px !important;">FP Required</label>
							<label class="title short" for="txt28" style="width: 88px !important;">Perimeter:</label><input type="text" name="txt28" id="txt28" style="width: 126px !important;" />
						</li>
						<li>
							<label class="title" for="txt29" style="width: 105px;">Pyrocrete:</label><input type="text" name="txt29" id="txt29" style="width: 126px !important;" />
							<label class="title short" for="txt30" style="width: 96px !important;">Gunite:</label><input type="text" name="txt30" id="txt30" style="width: 126px !important;" />
						</li>
						<li style="text-align: right;">
							<hr style="margin-bottom: 5px;" />
							<button class="k-button" disabled id="saveButt2">Save</button>
							<button class="k-button" disabled id="canButt2">Cancel</button>						
						</li>
					</ul>
				</fieldset>
			</div>
		    <div class="wrap-grid demo-section" style="width: 49%;margin-left: 0;height: auto;">
		        <div id="piece_rs"></div>
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
		    $("#txt2").val(dataItem.area_loc);
		    $("#txt3").val(dataItem.drawing_no);
		    $("#txt4").val(dataItem.sheet_no);
		    $("#txt5").val(dataItem.rev_no);
		    $("#txt6").val(dataItem.drawing_no2);
		    $("#txt7").val(dataItem.sheet_no2);
		    $("#txt8").val(dataItem.rev_no2);
		    $("#txt9").val(dataItem.drawing_no3);
		    $("#txt10").val(dataItem.sheet_no3);
		    $("#txt11").val(dataItem.rev_no3);
		    $("#txt12").data("kendoNumericTextBox").value(dataItem.priority_no);
		    $("#txt13").val(dataItem.rack_no);
		    $("#txt14").val(dataItem.docno);
		    $("#txt15").val(dataItem.plant_no);
		    $("#txt16").val(dataItem.supp_code);
		    $("#textarea").val(dataItem.remarks);
		    $("#sel1").data("kendoDropDownList").value(dataItem.iso_stat);
		  }else {
		    $("#txt31").val(dataItem.piece_no);
		    $("#txt17").val(dataItem.struc_type);
		    $("#txt18").val(dataItem.piece_desc);
		    $("#txt19").data("kendoNumericTextBox").value(dataItem.qty);
		    $("#sel1").data("kendoDropDownList").value(dataItem.um);
		    $("#txt20").data("kendoNumericTextBox").value(dataItem.length);
		    $("#txt21").data("kendoNumericTextBox").value(dataItem.weight);
		    $("#txt22").data("kendoNumericTextBox").value(dataItem.location);
		    $("#txt23").data("kendoNumericTextBox").value(dataItem.elevation);
		    $("#txt24").val(dataItem.fwbs_no);
		    $("#txt25").val("");
		    $("#txt26").val(dataItem.designation);
		    $("#txt27").val("");
		    $("#chk1").prop("checked",(dataItem.fp_required == 1));
		    $("#txt28").data("kendoNumericTextBox").value(dataItem.fp_perimeter);
		    $("#txt29").data("kendoNumericTextBox").value(dataItem.fp_pyrocrete);
		    $("#txt30").data("kendoNumericTextBox").value(dataItem.fp_gunite);
		    $("#textarea1").val(dataItem.remarks);
		  }
	    }   
	}
	function forDiv(){
		var container = $("#rowSelection");
		var container2 = $("#piece_rs");
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
		    filterFArr_pieceStr = [], filterOArr_pieceStr = [], filterVArr_pieceStr = [], sentValue_pieceStr = "", fieldSort = "", dirSort = "", query = "";
                    
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/isoStruc",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/isoStruc",
                    type: "POST"
                },
                update: {
                    url: crudService + "manage/isoStruc",
                    type: "POST"
                },
                destroy: {
                    url: crudService + "remove/isoStruc",
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
                        area_loc: { type: "string" },
                        drawing_no: { type: "string" },
                        sheet_no: { type: "string" },
                   	    rev_no: { type: "string" },
                        iso_stat: { type: "string" },
                        priority_no: { type: "number"}
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
               {field: "area_loc",title: "Area Loc.",width: 66},
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
			    piece_ds.read();
           },
           dataBound: addExtraStylingToGrid
        });
                    
        var piece_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/pieceStruc",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/pieceStruc",
                    type: "POST"
                },
                update: {
                    url: crudService + "manage/pieceStruc",
                    type: "POST"
                },
                destroy: {
                    url: crudService + "remove/pieceStruc",
                    type: "POST"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_pieceStr[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_pieceStr[index] = this.operator;
				      		filterVArr_pieceStr[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "log_date");
				    query = filterFArr_pieceStr;
				    dirSort = ($(data.sort).length ? data.sort[0].dir : "desc")
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_pieceStr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    operator: (($(data.filter).length > 0) ? filterOArr_pieceStr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_pieceStrp : sentValue_pieceStr),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    plant_no: dataItem.plant_no,
					    area_no: dataItem.area_no,
					    drawing_no: dataItem.drawing_no,
					    sheet_no: dataItem.sheet_no,
					    rev_no: dataItem.rev_no,
					    area_loc: dataItem.area_loc
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
               	    if (filterFArr_pieceStr.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue_pieceStr = "";
					    filterFArr_pieceStr = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        piece_no: { type: "string" },
                        piece_desc: { type: "string" },
                        location: { type: "string" },
					    qty: { type: "number" },
					    um: { type: "number" },
					    LENGTH: { type: "number" },
					    weight: { type: "number" },
					    location: { type: "number" },
					    elevation: { type: "number" },
					    fp_perimeter: { type: "number" },
					    fp_pyrocrete: { type: "number" },
					    fp_gunite: { type: "number" }
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
			// $("#piece_rs").data("kendoGrid").select("tr:eq(1)");
	        // $("#piece_rs > .k-grid-content > table > tbody > tr").hover(
	            // function() {
	                // $(this).toggleClass("k-state-hover");
	            // }			        
	        // );
        	// filterFArr_equip = [];
	    // };
        
        var grid2 = $("#piece_rs").kendoGrid({
            dataSource: piece_ds,
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
               {field: "piece_no",title: "Piece Mark No.",width: 66},
               {field: "piece_desc",title: "Piece Mark Desc.",width: 125},
               {field: "location",title: "Location",width: 125}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
			    grid_change(currRow,"#piece_rs");
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
    					$("#piece_rs").data("kendoGrid").dataSource.remove(dataRow);
						piece_ds.sync();
						$("#piece_rs").data("kendoGrid").setDataSource(piece_ds);
						$("#piece_rs").data("kendoGrid").dataSource.page($("#piece_rs").data("kendoGrid").dataSource.page());
						$("#piece_rs").data("kendoGrid").dataSource.read();
	    				return true;
	    			break;
                	case "exportButt":
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_pieceStruc/?";
				        link.href += ("fieldS=" + fieldSort + "&");
				        link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
				        link.href += ("dir=" + dirSort + "&");
					    link.href += ("plant_no=" + dataItem.plant_no + "&");
					    link.href += ("area_no=" + dataItem.area_no + "&");
					    link.href += ("drawing_no=" + dataItem.drawing_no + "&");
					    link.href += ("sheet_no=" + dataItem.sheet_no + "&");
					    link.href += ("rev_no=" + dataItem.rev_no + "&");
					    link.href += ("area_loc=" + dataItem.area_loc);
				 
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
							$(".struc_spl .wrap-form input, .struc_spl .wrap-form textarea, .struc_spl .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							priority_no.enable(true);
							iso_stat.enable(true);
			    			if (this.id == "addButt"){
								$(".struc_spl .wrap-form input, .struc_spl .wrap-form textarea").val("");
								$(".struc_spl .wrap-form input").eq(0).select().focus();
								cMode = "add";
			    			}else {
								for(i=1;i<6;i++){
									$("#txt" + i).prop("disabled", true).addClass("k-state-disabled");
								}
								$("#txt15").prop("disabled", true).addClass("k-state-disabled");
								$(".struc_spl .wrap-form input").eq(5).select().focus();
								cMode = "edit";
							}
						}else {
							$(".piece_spl .wrap-form input, .piece_spl .wrap-form textarea, .piece_spl .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");							
							qty.enable(false);
							um.enable(true);
					        length.enable(true);
					        weight.enable(true);
					        location.enable(true);
					        elevation.enable(true);
					        fp_perimeter.enable(true);
					        fp_pyrocrete.enable(true);
					        fp_gunite.enable(true);
							$("#txt25").prop("disabled", true).addClass("k-state-disabled");
							$("#txt27").prop("disabled", true).addClass("k-state-disabled");
			    			if (this.id == "addButt2"){
								$(".piece_spl .wrap-form input, .piece_spl .wrap-form textarea").val("");
								$(".piece_spl .wrap-form input").eq(0).select().focus();
								cMode = "add";
			    			}else {
								$("#txt31").prop("disabled", true).addClass("k-state-disabled");
								//$("#txt19").parent().find("input").prop("disabled", true).addClass("k-state-disabled");
								$(".piece_spl.wrap-form input").eq(1).select().focus();
								cMode = "edit";
							}
							qty.value(1);
						}
						$(".wrap-button button").prop("disabled", true).addClass("k-state-disabled");
						forDiv();
	    			break;
	    		}
	    	}
	    });
	    $(".struc_spl .wrap-form button").bind({
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
											area_loc: $("#txt2").val(),
											drawing_no: $("#txt3").val(),
											sheet_no: $("#txt4").val(),
											rev_no: $("#txt5").val(),
											drawing_no2: $("#txt6").val(),
											sheet_no2: $("#txt7").val(),
											rev_no2: $("#txt8").val(),
											drawing_no3: $("#txt9").val(),
											sheet_no3: $("#txt10").val(),
											rev_no3: $("#txt11").val(),
											priority_no: priority_no.value(),
											rack_no: $("#txt13").val(),
											docno: $("#txt14").val(),
											plant_no: $("#txt15").val(),
											supp_code: $("#txt16").val(),
											remarks: $("#textarea").val(),
											iso_stat: $("#sel1").val(),
											log_user: $("#hidden_user").val()});
							dataSource.sync();
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/isoStruc",{PROGRESS_RECID: dataItem.PROGRESS_RECID, area_no: $("#txt1").val(),	area_loc: $("#txt2").val(),	drawing_no: $("#txt3").val(), sheet_no: $("#txt4").val(), rev_no: $("#txt5").val(), drawing_no2: $("#txt6").val(), sheet_no2: $("#txt7").val(), rev_no2: $("#txt8").val(), drawing_no3: $("#txt9").val(), sheet_no3: $("#txt10").val(), rev_no3: $("#txt11").val(),	priority_no: priority_no.value(), rack_no: $("#txt13").val(),	docno: $("#txt14").val(), plant_no: $("#txt15").val(), supp_code: $("#txt16").val(), remarks: $("#textarea").val(), iso_stat: $("#sel1").val(),	log_user: $("#hidden_user").val()},
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
				$(".struc_spl .wrap-form input, .struc_spl .wrap-form textarea, .struc_spl .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				priority_no.enable(false);
				//tot_weight.enable(false);
				iso_stat.enable(false);
				$("#coverDiv").remove();
	    	}
	    });
	    $(".piece_spl .wrap-form button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "saveButt2":
	    				if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
						if (cMode == "add"){
							piece_ds.add({PROGRESS_RECID: 0,
											plant_no: dataItem.plant_no,
											area_no: dataItem.area_no,
											area_loc: dataItem.area_loc,
											drawing_no: dataItem.drawing_no,
											sheet_no: dataItem.sheet_no,
											rev_no: dataItem.rev_no,
											piece_no: $("#txt31").val(),
											piece_desc: $("#txt18").val(),
											qty: qty.value(),
											um: $("#sel2").val(),
											length: length.value(),
											weight: weight.value(),
											location: location.value(),
											elevation: elevation.value(),
											fwbs_no: $("#txt24").val(),
											designation: $("#txt26").val(),
											struc_type: $("#txt17").val(),
											remarks: $("#textarea1").val(),
											fp_required: ($("#chk1").is(":checked") ? 1 : 0),
											fp_perimeter: fp_perimeter.value(),
											fp_pyrocrete: fp_pyrocrete.value(),
											fp_gunite: fp_gunite.value(),
											log_user: $("#hidden_user").val()});
							piece_ds.sync();
							$("#piece_rs").data("kendoGrid").setDataSource(piece_ds);
							$("#piece_rs").data("kendoGrid").dataSource.page($("#piece_rs").data("kendoGrid").dataSource.page());
							$("#piece_rs").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/pieceStruc",{PROGRESS_RECID: dataItem.PROGRESS_RECID, plant_no: dataItem.plant_no, area_no: dataItem.area_no,drawing_no: dataItem.drawing_no, sheet_no: dataItem.sheet_no, rev_no: dataItem.rev_no, piece_no: $("#txt31").val(), piece_desc: $("#txt18").val(), qty: qty.value(),um: $("#sel2").val(),length: length.value(),weight: weight.value(), location: location.value(),	elevation: elevation.value(), fwbs_no: $("#txt24").val(),	designation: $("#txt26").val(), struc_type: $("#txt17").val(), remarks: $("#textarea1").val(), fp_required: ($("#chk1").is(":checked") ? 1 : 0), fp_perimeter: fp_perimeter.value(),	fp_pyrocrete: fp_pyrocrete.value(), fp_gunite: fp_gunite.value(), log_user: $("#hidden_user").val()},
					       	    function(data){
									$("#piece_rs").data("kendoGrid").setDataSource(piece_ds);
									$("#piece_rs").data("kendoGrid").dataSource.page($("#piece_rs").data("kendoGrid").dataSource.page());
									$("#piece_rs").data("kendoGrid").dataSource.read();
					       	    });
	    			break;
	    			default:
			    		grid_change(currRow,"#piece_rs");
	    			break;
	    		}
				$(".piece_spl .wrap-form input, .piece_spl .wrap-form textarea, .piece_spl .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				um.enable(true);
		        length.enable(false);
		        weight.enable(false);
		        location.enable(false);
		        elevation.enable(false);
		        fp_perimeter.enable(false);
		        fp_pyrocrete.enable(false);
		        fp_gunite.enable(false);
				$("#coverDiv").remove();
	    	}
	    });
        var priority_no = $("#txt12").removeClass("k-state-disabled").kendoNumericTextBox({
        	enable: false
        }).data("kendoNumericTextBox");
        var iso_stat = $("#sel1").removeClass("k-state-disabled").kendoDropDownList({
        	enable: false
        }).data("kendoDropDownList");
        
        var um = $("#sel2").removeClass("k-state-disabled").kendoDropDownList({
        	enable: false
        }).data("kendoDropDownList");
        var qty = $("#txt19").removeClass("k-state-disabled").kendoNumericTextBox({
        	enable: false,
        	value: 1
        }).data("kendoNumericTextBox");
        var length = $("#txt20").removeClass("k-state-disabled").kendoNumericTextBox({
        	enable: false
        }).data("kendoNumericTextBox");
        var weight = $("#txt21").removeClass("k-state-disabled").kendoNumericTextBox({
        	enable: false
        }).data("kendoNumericTextBox");
        var location = $("#txt22").removeClass("k-state-disabled").kendoNumericTextBox({
        	enable: false
        }).data("kendoNumericTextBox");
        var elevation = $("#txt23").removeClass("k-state-disabled").kendoNumericTextBox({
        	enable: false
        }).data("kendoNumericTextBox");
        var fp_perimeter = $("#txt28").removeClass("k-state-disabled").kendoNumericTextBox({
        	enable: false
        }).data("kendoNumericTextBox");
        var fp_pyrocrete = $("#txt29").removeClass("k-state-disabled").kendoNumericTextBox({
        	enable: false
        }).data("kendoNumericTextBox");
        var fp_gunite = $("#txt30").removeClass("k-state-disabled").kendoNumericTextBox({
        	enable: false
        }).data("kendoNumericTextBox");
	});
</script>