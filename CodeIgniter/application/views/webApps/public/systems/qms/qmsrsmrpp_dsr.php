<div id="jwrrWindow">
	<div class="wrap-grid demo-section" style=" width: 100%;margin-left: 0; min-height: 300px;">
	        <div id="jwrr_grid" style="width: 100%;margin-bottom: 2px;"></div>  
	</div>      
	<div class="buttonRight">
		<button class="k-button mainEve" id="applyButt">Apply</button>
	</div>
	
</div>

<div id="priorWindow">
	<div class="wrap-grid demo-section" style=" width: 100%;margin-left: 0; min-height: 300px;">
	        <div id="prior_grid" style="width: 100%;margin-bottom: 2px;"></div>  
	</div>      
	<div class="buttonRight">
		<button class="k-button mainEve" id="applyButt2">Apply</button>
	</div>
	
</div>

<div id="areaWindow">
	<div class="wrap-grid demo-section" style=" width: 100%;margin-left: 0; min-height: 300px;">
	        <div id="area_grid" style="width: 100%;margin-bottom: 2px;"></div>  
	</div>      
	<div class="buttonRight">
		<button class="k-button mainEve" id="applyButt3">Apply</button>
	</div>
	
</div>

<div id="drawingWindow">
	<div class="wrap-grid demo-section" style=" width: 100%;margin-left: 0; min-height: 300px;">
	        <div id="drawing_grid" style="width: 100%;margin-bottom: 2px;"></div>  
	</div>      
	<div class="buttonRight">
		<button class="k-button mainEve" id="applyButt4">Apply</button>
	</div>
	
</div>

<div id="main-wrapper" style="min-height: 1000px">
	<div class="wrap-button demo-section" style="width: 516px;min-height: 730px;">
		<fieldset style="width: 500px;">
		<div><br /></div>
		<div>Start Date:</div>
		<div><br /></div>
		<div>
			<input type="text" name="txt1" id="txt1" style="width: 300px;"/> 
		</div>
		<div><br /></div>
		<div>End Date:</div>
		<div><br /></div>
		<div>
			<input type="text" name="txt2" id="txt2" style="width: 300px;"/> 
		</div>
		<div><br /></div>
		<div><label class="title" for="textarea">Priority No:</label></div>
		<div>
			<textarea name="textarea" id="textarea2" cols="6" rows="3"  class="k-textbox" style="resize: none;width: 59%;margin: 0;"></textarea>
			<button class="k-button mainEve" id="openWindow2">...</button>
		</div>
		<div><br /></div>
		<div><label class="title" for="textarea">Area No:</label></div>
		<div>
			<textarea name="textarea" id="textarea3" cols="6" rows="3" disabled="true" class="k-textbox" style="resize: none;width: 59%;margin: 0;"></textarea>
			<button class="k-button mainEve" id="openWindow3">...</button>
		</div>
		<div><br /></div>
		<div><label class="title" for="textarea">Drawing No:</label></div>
		<div>
			<textarea name="textarea" id="textarea4" cols="6" rows="3" disabled="true" class="k-textbox" style="resize: none;width: 59%;margin: 0;"></textarea>
			<button class="k-button mainEve" id="openWindow4">...</button>
		</div>
		<div><br /></div>
		<div><label class="title" for="textarea">JMIF:</label></div>
		<div>
			<textarea name="textarea" id="textarea" cols="6" rows="3" disabled="true" class="k-textbox" style="resize: none;width: 59%;margin: 0;"></textarea>
			<button class="k-button mainEve" id="openWindow">...</button>
		</div>
		<div><br /></div>
			<div><h3>Filter Option</h3></div>
		<div><br /></div>
		<div>
			<input type="radio" name="option" checked id="rad1" />ALL
		</div>
		<div><br /></div>
		<div>
			<input type="radio" name="option"  id="rad2" />FOG Handover to WHSE
		</div>
		<div><br /></div>
		<div>
			<input type="radio" name="option"  id="rad3" />WHSE Handover to Client
		</div>
		<div><br /></div>
		<div>
			<input type="checkbox" name="chk1" id="chk1">Export
		</div>
		<div><br /></div>
		<div class="buttonRight">
				
				<button class="k-button mainEve" id="printButt">Print</button>
        		<button class="k-button mainEve" id="closeButt">Close</button>
        </div>	
        <div><br /></div>
        </fieldset>
		
	</div>
</div>
<script type="text/javascript">
	var processMatTO = false;
	var dataItem = '';
	function grid_change(e,grid){
		if (typeof e == "undefined")
			e = grid;
		var selectedRows = e.select();
		var selectedDataItems = [];
		var dataItem = [];
		for (var i = 0; i < selectedRows.length; i++) {
			dataItem = e.dataItem(selectedRows[i]);
			//$("#txt2").val(dataItem.osd_no);
	    }
	}
	function forDiv(div){
		var container = $("#" + div);
		var position = container.offset();	
		var offsetHeight = container.height();
		var offsetWidth = container.width();
		var newDiv = $("<div id = 'coverDiv' style='z-index: 10000;position: absolute;'>").appendTo($("body"));
		newDiv.offset(position);
		newDiv.height(offsetHeight + 87);
		newDiv.width(offsetWidth);
	}
	
	

	$(document).ready(function() {
			$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
			var crudService = crudServiceBaseUrl + "qms/index/",
			    filterFArr_jwrr = [], filterOArr_jwrr = [], filterVAr_jwrr = [], currRow = "", jwrr_di = '', 
			    filterFArr_prior = [], filterOArr_prior = [], filterVAr_prior = [], currRow2 = "", prior_di = '', 
			    filterFArr_area = [], filterOArr_area = [], filterVArr_area = [], currRow3 = "", area_di = '', 
			    filterFArr_drawing = [], filterOArr_drawing = [], filterVArr_drawing = [], currRow4 = "", drawing_di = '', 
			    isFailed = false, fieldSort = "", dirSort = "", query = "";
			
			 $.post(crudService + "directCall/QCMRIR",{},
					       	    function(data){
					       	    	console.log(data);
					       	    	
									// $("#rowSelection").data("kendoGrid").setDataSource(dataSource);
									// $("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									// $("#rowSelection").data("kendoGrid").dataSource.read();

					       	    
			
			// -- Window event Section -- //
			$("#jwrrWindow").kendoWindow({ 
	            width: "800px",
	            height: "auto",
	            title: "JWRR No",
	            modal: true,
	            visible: false,
	            resizable: false,
	            scrollable: true,
	            open: function(){
	            	console.log(this);
	            }
	        });
	        
	        $("#priorWindow").kendoWindow({ 
	            width: "800px",
	            height: "auto",
	            title: "Prior No",
	            modal: true,
	            visible: false,
	            resizable: false,
	            scrollable: true,
	            open: function(){
	            	console.log(this);
	            }
	        });
	        
	         $("#areaWindow").kendoWindow({ 
	            width: "800px",
	            height: "auto",
	            title: "Area No",
	            modal: true,
	            visible: false,
	            resizable: false,
	            scrollable: true,
	            open: function(){
	            	console.log(this);
	            }
	        });
	        
	        $("#drawingWindow").kendoWindow({ 
	            width: "800px",
	            height: "auto",
	            title: "Drawing No",
	            modal: true,
	            visible: false,
	            resizable: false,
	            scrollable: true,
	            open: function(){
	            	console.log(this);
	            }
	        });
			
			// -- Date Section -- //
			
			function startChange() {
                        var startDate = start.value(),
                        endDate = end.value();

                        if (startDate) {
                            startDate = new Date(startDate);
                            startDate.setDate(startDate.getDate());
                            end.min(startDate);
                        } else if (endDate) {
                            start.max(new Date(endDate));
                        } else {
                            endDate = new Date();
                            start.max(endDate);
                            end.min(endDate);
                        }
                    }

                    function endChange() {
                        var endDate = end.value(),
                        startDate = start.value();

                        if (endDate) {
                            endDate = new Date(endDate);
                            endDate.setDate(endDate.getDate());
                            start.max(endDate);
                        } else if (startDate) {
                            end.min(new Date(startDate));
                        } else {
                            endDate = new Date();
                            start.max(endDate);
                            end.min(endDate);
                        }
                    }
			 
			 var today = new Date(kendo.format('{0:yyyy-MM-dd}', new Date()))
			 
			 var start = $("#txt1").kendoDatePicker({
                        value: today,
                        change: startChange,
                        parseFormats: ["yyyy/MM/dd"],
                        change: function(e){
		        			jwrr_ds.read();
       				    }
                    }).data("kendoDatePicker");
                    
			 var end = $("#txt2").kendoDatePicker({
                        value: today,
                        change: startChange,
                        parseFormats: ["yyyy/MM/dd"],
                        change: function(e){
		        			jwrr_ds.read();
       				    }
                    }).data("kendoDatePicker");
			
			
			
			
			// --grid section-- //
			
			var checkedIds = {};
			var jwrr_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/jmif_no_date_Ref",
                    contentType: "application/json",
                    type: "GET",
	               
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_jwrr[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_jwrr[index] = this.operator;
				      		filterVArr_jwrr[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "jmif_no");
				    
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_jwrr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "jmif_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_jwrr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_jwrr : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    start: (kendo.toString(start.value(),"yyyy-MM-dd")),
					    end: (kendo.toString(end.value(),"yyyy-MM-dd"))
					    
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
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
               	    if (filterFArr_jwrr.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_jwrr = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        jmif_no: { type: "string" },
                        jmif_date: { type: "date" }
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
			$("#jwrr_grid").data("kendoGrid").select("tr:eq(1)");
	        $("#jwrr_grid > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_jwrr = [];
	    };
	    
	    var onDataBound = function (e) {
			var view = this.dataSource.view();
			
			for(var i = 0; i < view.length;i++){
				if (checkedIds[view[i].jmif_no] == undefined)
					checkedIds[view[i].jmif_no] = $("#windowChk1_job").is(":checked");
			    //alert("View: " + view[i].id + ", " + view[i].testpack_no);
				if(checkedIds[view[i].jmif_no]){
					this.tbody.find("tr[data-uid='" + view[i].uid + "']")
						.addClass("k-state-selected")
						.find("input[type=checkbox]")
						.prop("checked","checked");
				}
			}			
		}
	    var checkObject = function () {
	        $(".k-grid-content > table > tbody > tr").on('click', //use k-grid only when scrollable is set to false			          
	            function() {
	            	/*$.each(this,function(index,value){
	            		alert(index + ", " + value);
	            	});*/
	                alert($(this).find('input').attr("checked")); //, true);
	            }			        
	        );
	    };
        
        var grid = $("#jwrr_grid").kendoGrid({
            dataSource: jwrr_ds,
            selectable: "row",
            pageable: {
                buttonCount: 3,
    			input: true
            },
            autoBind: true,
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
               {field: "jmif_no",title: "JMIF No",width: 120},
               {field: "jmif_date",title: "JMIF Date",width: 80},
               {
					headerTemplate:'<input id="windowChk1_job" name="windowChk1_job" type="checkbox" />',
					title: ' ',
                    template: kendo.template("<input type='checkbox' name='#= jmif_no #' id='#= jmif_no #' DISABLED  />"),
					width: 28
				}
           ],
           change: function(e){
           		// currRow = this;
			    // var selectedRows = this.select();
			    // var selectedDataItems = [];
			    // for (var i = 0; i < selectedRows.length; i++) {
			        // jwrr_di = this.dataItem(selectedRows[i]);

			        
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        jwrr_di = this.dataItem(selectedRows[i]);
				    var rowIndex = $("tr", this.tbody).index(selectedRows[i]),
				        row = this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
					checkedIds[jwrr_di.jmif_no] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").is(":checked");
					if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").is(":checked") == false)
						$("#windowChk1_job").prop("checked",false);
	           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").is(":checked"));
	           		
			    }
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle('#jwrr_grid','JMIF'); 
		
		$('#jwrr_grid tbody').on('click',':checkbox',function(){
			if (this.checked){
				var grid2 = $('#jwrr_grid').data("kendoGrid");
			    var row = $(this).closest('tr'),
			        rowIndex = $("tr", grid2.tbody).index(row),
			        row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
			    grid2.select(row);
			}else
				$('tr.k-state-selected','#jwrr_grid').removeClass('k-state-selected');
		    
		});
		
		
		$("#windowChk1_job").click(function () {
			var grid2 = $('#jwrr_grid').data("kendoGrid")
			    currStat = this.checked;
		    $("#jwrr_grid tbody input:checkbox").each(function(index,value){
		    	$(this).prop("checked", currStat);
			    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
			    var dataItem2 = grid2.dataItem(row);
				checkedIds[dataItem2.jmif_no] = currStat;
				if (currStat){
				    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#jwrr_grid').addClass('k-state-selected');
				}else
					$('tr.k-state-selected','#jwrr_grid').removeClass('k-state-selected');
			});
		});
		
		// -- grid prior -- //
			var checkedIds2 = {};
			var prior_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/dd_priorNo2",
                    contentType: "application/json",
                    type: "GET",
	               
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_prior[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_prior[index] = this.operator;
				      		filterVArr_prior[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "prior_no");
				    
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_prior,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "prior_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_prior : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_prior : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc")
					    
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
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
               	    if (filterFArr_prior.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_prior = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        prior_no: { type: "string" }
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
                                
	    var addExtraStylingToGrid2 = function () {
			$("#prior_grid").data("kendoGrid").select("tr:eq(1)");
	        $("#prior_grid > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_prior = [];
	    };
	    
	    var onDataBound2 = function (e) {
			var view = this.dataSource.view();
			
			for(var i = 0; i < view.length;i++){
				if (checkedIds2[view[i].prior_no] == undefined)
					checkedIds2[view[i].prior_no] = $("#windowChk2_job").is(":checked");
			    //alert("View: " + view[i].id + ", " + view[i].testpack_no);
				if(checkedIds2[view[i].prior_no]){
					this.tbody.find("tr[data-uid='" + view[i].uid + "']")
						.addClass("k-state-selected")
						.find("input[type=checkbox]")
						.prop("checked","checked");
				}
			}			
		}
	    var checkObject2 = function () {
	        $(".k-grid-content > table > tbody > tr").on('click', //use k-grid only when scrollable is set to false			          
	            function() {
	            	/*$.each(this,function(index,value){
	            		alert(index + ", " + value);
	            	});*/
	                alert($(this).find('input').attr("checked")); //, true);
	            }			        
	        );
	    };
        
        var grid3 = $("#prior_grid").kendoGrid({
            dataSource: prior_ds,
            selectable: "row",
            pageable: {
                buttonCount: 3,
    			input: true
            },
            autoBind: true,
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
               {field: "prior_no",title: "PRIOR No",width: 120},
               {
					headerTemplate:'<input id="windowChk2_job" name="windowChk2_job" type="checkbox" />',
					title: ' ',
                    template: kendo.template("<input type='checkbox' name='#= prior_no #' id='#= prior_no #' DISABLED  />"),
					width: 28
				}
           ],
           change: function(e){
           		// currRow = this;
			    // var selectedRows = this.select();
			    // var selectedDataItems = [];
			    // for (var i = 0; i < selectedRows.length; i++) {
			        // prior_di = this.dataItem(selectedRows[i]);

			        
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        prior_di = this.dataItem(selectedRows[i]);
				    var rowIndex = $("tr", this.tbody).index(selectedRows[i]),
				        row = this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
					checkedIds2[prior_di.prior_no] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(1).find("input").is(":checked");
					if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(1).find("input").is(":checked") == false)
						$("#windowChk2_job").prop("checked",false);
	           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(1).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(1).find("input").is(":checked"));
	           		
			    }
           },
           dataBound: addExtraStylingToGrid2
        });
        insertGridTitle('#prior_grid','PRIOR NO'); 
		
		$('#prior_grid tbody').on('click',':checkbox',function(){
			if (this.checked){
				var grid4 = $('#jwrr_grid').data("kendoGrid");
			    var row = $(this).closest('tr'),
			        rowIndex = $("tr", grid2.tbody).index(row),
			        row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
			    grid2.select(row);
			}else
				$('tr.k-state-selected','#prior_grid').removeClass('k-state-selected');
		    
		});
		
		
		$("#windowChk2_job").click(function () {
			var grid4 = $('#prior_grid').data("kendoGrid")
			    currStat = this.checked;
		    $("#prior_grid tbody input:checkbox").each(function(index,value){
		    	$(this).prop("checked", currStat);
			    var row = grid4.tbody.find(">tr:not(.k-grouping-row)").eq(index);
			    var dataItem3 = grid4.dataItem(row);
				checkedIds2[dataItem3.prior_no] = currStat;
				if (currStat){
				    var row = grid4.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#prior_grid').addClass('k-state-selected');
				}else
					$('tr.k-state-selected','#prior_grid').removeClass('k-state-selected');
			});
		});
		
		// -- area prior -- //
		
			var checkedIds3 = {};
			var area_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/dd_areaRef2",
                    contentType: "application/json",
                    type: "GET",
	               
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_area[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_area[index] = this.operator;
				      		filterVArr_area[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "area_no");
				    
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_area,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "area_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_area : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_area : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "asc")
					    
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
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
               	    if (filterFArr_area.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_area = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        area_no: { type: "string" }
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
                                
	    var addExtraStylingToGrid3 = function () {
			$("#area_grid").data("kendoGrid").select("tr:eq(1)");
	        $("#area_grid > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_area = [];
	    };
	    
	    var onDataBound3 = function (e) {
			var view = this.dataSource.view();
			
			for(var i = 0; i < view.length;i++){
				if (checkedIds3[view[i].area_no] == undefined)
					checkedIds3[view[i].area_no] = $("#windowChk3_job").is(":checked");
			    
				if(checkedIds3[view[i].area_no]){
					this.tbody.find("tr[data-uid='" + view[i].uid + "']")
						.addClass("k-state-selected")
						.find("input[type=checkbox]")
						.prop("checked","checked");
				}
			}			
		}
	    var checkObject3 = function () {
	        $(".k-grid-content > table > tbody > tr").on('click', //use k-grid only when scrollable is set to false			          
	            function() {
	            	/*$.each(this,function(index,value){
	            		alert(index + ", " + value);
	            	});*/
	                alert($(this).find('input').attr("checked")); //, true);
	            }			        
	        );
	    };
        
        var grid4 = $("#area_grid").kendoGrid({
            dataSource: area_ds,
            selectable: "row",
            pageable: {
                buttonCount: 3,
    			input: true
            },
            autoBind: true,
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
               {field: "area_no",title: "Area No",width: 120},
               {
					headerTemplate:'<input id="windowChk3_job" name="windowChk3_job" type="checkbox" />',
					title: ' ',
                    template: kendo.template("<input type='checkbox' name='#= area_no #' id='#= area_no #' DISABLED  />"),
					width: 28
				}
           ],
           change: function(e){
           		// currRow = this;
			    // var selectedRows = this.select();
			    // var selectedDataItems = [];
			    // for (var i = 0; i < selectedRows.length; i++) {
			        // prior_di = this.dataItem(selectedRows[i]);

			        
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        area_di = this.dataItem(selectedRows[i]);
				    var rowIndex = $("tr", this.tbody).index(selectedRows[i]),
				        row = this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
					checkedIds3[prior_di.area_no] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(1).find("input").is(":checked");
					if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(1).find("input").is(":checked") == false)
						$("#windowChk3_job").prop("checked",false);
	           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(1).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(1).find("input").is(":checked"));
	           		
			    }
           },
           dataBound: addExtraStylingToGrid3
        });
        insertGridTitle('#area_grid','AREA NO'); 
		
		$('#area_grid tbody').on('click',':checkbox',function(){
			if (this.checked){
				var grid5 = $('#area_grid').data("kendoGrid");
			    var row = $(this).closest('tr'),
			        rowIndex = $("tr", grid3.tbody).index(row),
			        row = grid3.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
			    grid3.select(row);
			}else
				$('tr.k-state-selected','#area_grid').removeClass('k-state-selected');
		    
		});
		
		
		$("#windowChk3_job").click(function () {
			var grid5 = $('#area_grid').data("kendoGrid")
			    currStat = this.checked;
		    $("#area_grid tbody input:checkbox").each(function(index,value){
		    	$(this).prop("checked", currStat);
			    var row = grid5.tbody.find(">tr:not(.k-grouping-row)").eq(index);
			    var dataItem4 = grid5.dataItem(row);
				checkedIds3[dataItem4.area_no] = currStat;
				if (currStat){
				    var row = grid5.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#area_grid').addClass('k-state-selected');
				}else
					$('tr.k-state-selected','#area_grid').removeClass('k-state-selected');
			});
		});
				// -- drawing Grid-- //
				
			var checkedIds4 = {};
			var drawing_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/dd_drawingRef2",
                    contentType: "application/json",
                    type: "GET",
	               
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_drawing[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_drawing[index] = this.operator;
				      		filterVArr_drawing[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "drawing_no");
				    
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_drawing,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "drawing_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_drawing : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_drawing : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "asc")
					    
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
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
               	    if (filterFArr_drawing.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_drawing = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        drawing_no: { type: "string" }
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
                                
	    var addExtraStylingToGrid4 = function () {
			$("#drawing_grid").data("kendoGrid").select("tr:eq(1)");
	        $("#drawing_grid > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_drawing = [];
	    };
	    
	    var onDataBound4 = function (e) {
			var view = this.dataSource.view();
			
			for(var i = 0; i < view.length;i++){
				if (checkedIds4[view[i].drawing_no] == undefined)
					checkedIds4[view[i].drawing_no] = $("#windowChk4_job").is(":checked");
			    
				if(checkedIds4[view[i].drawing_no]){
					this.tbody.find("tr[data-uid='" + view[i].uid + "']")
						.addClass("k-state-selected")
						.find("input[type=checkbox]")
						.prop("checked","checked");
				}
			}			
		}
	    var checkObject4 = function () {
	        $(".k-grid-content > table > tbody > tr").on('click', //use k-grid only when scrollable is set to false			          
	            function() {
	            	/*$.each(this,function(index,value){
	            		alert(index + ", " + value);
	            	});*/
	                alert($(this).find('input').attr("checked")); //, true);
	            }			        
	        );
	    };
        
        var grid5 = $("#drawing_grid").kendoGrid({
            dataSource: drawing_ds,
            selectable: "row",
            pageable: {
                buttonCount: 3,
    			input: true
            },
            autoBind: true,
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
               {field: "drawing_no",title: "DRAWING No",width: 120},
               {
					headerTemplate:'<input id="windowChk4_job" name="windowChk4_job" type="checkbox" />',
					title: ' ',
                    template: kendo.template("<input type='checkbox' name='#= drawing_no #' id='#= drawing_no #' DISABLED  />"),
					width: 28
				}
           ],
           change: function(e){
           		// currRow = this;
			    // var selectedRows = this.select();
			    // var selectedDataItems = [];
			    // for (var i = 0; i < selectedRows.length; i++) {
			        // prior_di = this.dataItem(selectedRows[i]);

			        
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        drawing_di = this.dataItem(selectedRows[i]);
				    var rowIndex = $("tr", this.tbody).index(selectedRows[i]),
				        row = this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
					checkedIds4[drawing_di.drawing_no] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(1).find("input").is(":checked");
					if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(1).find("input").is(":checked") == false)
						$("#windowChk4_job").prop("checked",false);
	           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(1).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(1).find("input").is(":checked"));
	           		
			    }
           },
           dataBound: addExtraStylingToGrid4
        });
        insertGridTitle('#drawing_grid','DRAWING NO'); 
		
		$('#drawing_grid tbody').on('click',':checkbox',function(){
			if (this.checked){
				var grid6 = $('#drawing_grid').data("kendoGrid");
			    var row = $(this).closest('tr'),
			        rowIndex = $("tr", grid4.tbody).index(row),
			        row = grid4.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
			    grid4.select(row);
			}else
				$('tr.k-state-selected','#drawing_grid').removeClass('k-state-selected');
		    
		});
		
		
		$("#windowChk4_job").click(function () {
			var grid6 = $('#drawing_grid').data("kendoGrid")
			    currStat = this.checked;
		    $("#drawing_grid tbody input:checkbox").each(function(index,value){
		    	$(this).prop("checked", currStat);
			    var row = grid6.tbody.find(">tr:not(.k-grouping-row)").eq(index);
			    var dataItem5 = grid6.dataItem(row);
				checkedIds4[dataItem5.drawing_no] = currStat;
				if (currStat){
				    var row = grid6.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#drawing_grid').addClass('k-state-selected');
				}else
					$('tr.k-state-selected','#drawing_grid').removeClass('k-state-selected');
			});
		});
	
			// --event handler section -- //
			
			var toggleButt = function(vis){
		        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
		        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
		        });
		    }
		   	 toggleButt("show");
	  	 
		
	   
		$("#applyButt").click(function(e){
			var listOfSelected = "";
		    $("#jwrr_grid tbody input[type=checkbox]:checked").each(function(index,value){
		        listOfSelected += ((listOfSelected != "") ? "," : "") + this.id;
		    });
		    $("#textarea").val(listOfSelected);
		    
		   $("#jwrrWindow").data("kendoWindow").close();
		});
		
		$("#applyButt2").click(function(e){
			var listOfSelected = "";
		    $("#prior_grid tbody input[type=checkbox]:checked").each(function(index,value){
		        listOfSelected += ((listOfSelected != "") ? "," : "") + this.id;
		    });
		    $("#textarea2").val(listOfSelected);
		    
		   $("#priorWindow").data("kendoWindow").close();
		});
		
		$("#applyButt3").click(function(e){
			var listOfSelected = "";
		    $("#area_grid tbody input[type=checkbox]:checked").each(function(index,value){
		        listOfSelected += ((listOfSelected != "") ? "," : "") + this.id;
		    });
		    $("#textarea3").val(listOfSelected);
		    
		   $("#areaWindow").data("kendoWindow").close();
		});
		
		$("#applyButt4").click(function(e){
			var listOfSelected = "";
		    $("#drawing_grid tbody input[type=checkbox]:checked").each(function(index,value){
		        listOfSelected += ((listOfSelected != "") ? "," : "") + this.id;
		    });
		    $("#textarea4").val(listOfSelected);
		    
		   $("#drawingWindow").data("kendoWindow").close();
		});
		
		$("#openWindow").click(function(e){
			$("#jwrrWindow").data("kendoWindow").center().open();
		});
		
		$("#openWindow2").click(function(e){
			$("#priorWindow").data("kendoWindow").center().open();
		});
		
        $("#openWindow3").click(function(e){
			$("#areaWindow").data("kendoWindow").center().open();
		});
	    $("#openWindow4").click(function(e){
			$("#drawingWindow").data("kendoWindow").center().open();
		});	
			
			$(".wrap-button .buttonRight button").bind({
		    	click: function(e){
		    		switch(this.id){
		    			case "printButt":
		    			var startDate = kendo.toString(start.value(),"yyyy-MM-dd");
		   				var endDate =  kendo.toString(end.value(),"yyyy-MM-dd");
						var getPrior = $("#textarea2").val();
						var getArea  = $("#textarea3").val();
						var getDrawing  = $("#textarea4").val();
						var getJmif = $("#textarea").val();
		    			var ladvance = confirm('Do you want to print this item?');
		    				if(!ladvance)	
		    					return true;
		    				else{
		    					if(($("#chk1").is(":checked") ? 1 : 0)==1){
		    						var link = document.createElement('a');
						        	link.href = crudService + "directCall/export_qmsrsmrpp/?";
						        	link.href += ("fieldS=" + fieldSort + "&");
						        	link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
						        	link.href += ("dir=" + dirSort + "&startD=" + startDate );
						        	link.href += ("&endD=" + endDate + "&prior_no=" + getPrior);
						        	link.href += ("&area_no=" + getArea + "&drawing_no=" + getDrawing);
						        	link.href += ("&jmif=" + getJmif + "&rsOption=" + $('input[name=option]:checked').index('input[name=option]'));
							        
						        	if (document.createEvent) {
						            var e = document.createEvent('MouseEvents');
						            e.initEvent('click' ,true ,true);
						            link.dispatchEvent(e);
							    	close_preloader();
						            return true;
						      	    }
		    						
		    						$("#window").data("kendoWindow").setOptions({
								    title: "",
								    width: "900px",
								    height: "600px"
									});
									$("#window").data("kendoWindow").refresh({
									    url: "http://" + $(location).attr('hostname') + ":8080/JavaBridge/executeReport.php?xmlFile=qms/Daily Structural Report" + "&cArea=" + getArea + "&cDrawNo=" + getDrawing + "&cJMIF_no=" + getJmif + "&cprior_no=" + getPrior + "&dtFrom=" + startDate + "&dtTo=" + endDate + "&iJMIF_option=" + $('input[name=option]:checked').index('input[name=option]'),
									    contentType: "application/pdf"
									});
							        $("#window").data("kendoWindow").center().open();
		    						
		    					}else{
		    						$("#window").data("kendoWindow").setOptions({
								    title: "",
								    width: "900px",
								    height: "600px"
									});
									$("#window").data("kendoWindow").refresh({
									    url: "http://" + $(location).attr('hostname') + ":8080/JavaBridge/executeReport.php?xmlFile=qms/Daily Structural Report" + "&cArea=" + getArea + "&cDrawNo=" + getDrawing + "&cJMIF_no=" + getJmif + "&cprior_no=" + getPrior + "&dtFrom=" + startDate + "&dtTo=" + endDate + "&iJMIF_option=" + $('input[name=option]:checked').index('input[name=option]'),
									    contentType: "application/pdf"
									});
							        $("#window").data("kendoWindow").center().open();
		    					 }
		    					
		    			    }
		    		}
		    	}
			});
		});

	});
</script>