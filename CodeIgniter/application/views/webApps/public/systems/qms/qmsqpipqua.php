<div id="main-wrapper">
	<div style="margin-bottom: 5px;float:right; width: 72%">
		<div class="wrap-button demo-section" style="width: 100%;">
			<input type="checkbox" name="chk1" id="chk1"><label class="title short" for="chk1">Advance</label>
		</div>
		<div class="wrap-form demo-section apply8" style="width: 100%;display: block; margin-bottom: 20px; min-height: 450px;">
			<div id="isoDwg_grid"></div>
		</div>
	</div>
	<div class="wrap-grid demo-section" style=" width: 25%;margin-left: 0; min-height: 470px;">
        <div id="priorSetup_grid" style="width: 100%;margin-bottom: 2px;"></div> 
        <div id="priorArealoc_grid" style="width: 100%"></div>
   	</div>
   	<div class="wrap-grid demo-section" style="min-height: 250px;width: 100%;margin-right: 0px; ">
   		<div style="margin-bottom: 2px;float: right; margin-right: 0px;margin-left: 1px;"><textarea name="textarea" disabled id="textarea" cols="20" rows="15" style="resize: none;width: %;margin: 0; height: 20%;"></textarea></div>
   		<div id="erecmat_rs" style="width: 35.5%;margin-bottom: 2px;float: right;margin-left: 1px;"></div>
   		<div style="margin-bottom: 2px;float: right; margin-right: 0px;"><textarea name="textarea" disabled id="textarea2" cols="20" rows="15" style="resize: none;width: %;margin: 0; height: 20%"></textarea></div>
   		<div id="splmat_rs" style="width: 30%;margin-bottom: 2px;"></div>
   	</div>
   	<div class="wrap-grid demo-section" style="min-height: 250px;width: 100%">
   		<div id="pipeLst_grid" style="width: 44%;margin-bottom: 2px;float: right;margin-left: 15px;"></div>
   		<div id="jointLst_grid" style="width: 27%;margin-bottom: 2px;float: right;"></div>
   		<div id="splLst_grid" style="width: 26%;margin-bottom: 2px;"></div>
   		
   	</div>
	<div class="wrap-button demo-section" style="width: 100%;">
		<div class="buttonLeft" style="width: 100%;">
        	<button class="k-button mainEve" id="exportButt">Export ISO</button>
        	<button class="k-button mainEve" id="exportButt2">Export SPL</button>
        	<button class="k-button mainEve" id="exportButt3">Export PS</button>
        	<button class="k-button mainEve" id="exportButt4">Export JNT</button>
        	<button class="k-button mainEve" id="exportButt5">Export SPLM</button>
        	<button class="k-button mainEve" id="exportButt6">Export EM</button>
        	<button class="k-button mainEve" id="exportButt">Print Summary Report </button>
        	<button class="k-button mainEve" id="closeButt" style="float: right;">Close</button>
   		</div>
	</div>	
</div>
<script type="text/javascript">
	var processMatTO = false;
	var dataItem3 = '';
	function grid_change(e,grid){
		if (typeof e == "undefined")
			e = grid;
		var selectedRows = e.select();
		var selectedDataItems = [];
		var dataItem = [];
		for (var i = 0; i < selectedRows.length; i++) {
			dataItem = e.dataItem(selectedRows[i]);
			if (grid == "#splmat_rs") {
				$("#textarea2").val(dataItem.mat_desc);
			}else{
				$("#textarea").val(dataItem.mat_desc);
					
			};
			
			// $("#txt1").val(dataItem3.stock_no);
			// $("#txt2").val(dataItem3.item_code);
			// $("#txt3").val(dataItem3.commodity_code);
			// $("#txt4").val(dataItem3.uom);
			// $("#txt5").val(dataItem3.size);
			// $("#txt6").val(dataItem3.schedule);
			// $("#txt7").val(dataItem3.qty_takeoff);
			// $("#txt8").val(dataItem3.qty_mrr);
			// $("#txt9").val(dataItem3.qty_mrr);
			// $("#txt10").val(dataItem3.qty_issued);
			// $("#txt11").val(dataItem3.qty_rts);
			// $("#txt12").val(dataItem3.qty_onhand);   	
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
	$(document).ready(function(){
		$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
		var crudService = crudServiceBaseUrl + "qms/index/",
		    filterFArr_isoDwg = [], filterOArr_isoDwg = [], filterVArr_isoDwg = [], currRow = "", isoDwg_di = '', 
		    filterFArr_priorSetup = [], filterOArr_priorSetup = [], filterVArr_priorSetup = [], currRow2 = "", priorSetup_di = '', 
		    filterFArr_priorArealoc = [], filterOArr_priorArealoc = [], filterVArr_priorArealoc = [], currRow3 = "", priorArealoc_di = '',
		    filterFArr_splmat = [], filterOArr_splmat = [], filterVArr_splmat = [], currRow4 = "", splmat_di = '',
		    filterFArr_erecmat = [], filterOArr_erecmat = [], filterVArr_erecmat = [], currRow5 = "", erecmat_di = '',
		    filterFArr_splLst = [], filterOArr_splLst = [], filterVArr_splLst = [], currRow6 = "", splLst_di = '',
		    filterFArr_jointLst = [], filterOArr_jointLst = [], filterVArr_jointLst = [], currRow7 = "", jointLst_di = '',
		    filterFArr_pipeLst = [], filterOArr_pipeLst = [], filterVArr_pipeLst = [], currRow8 = "", pipeLst_di = '',
		    isFailed = false, fieldSort = "", dirSort = "", query = ""; dataItem3 ='';
		
		$(".wrap-button button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();
		});
		
		// -- ISO/DWG DATASOURCE -- //
        
        
        var isoDwg_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/iso_engg_pip",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_isoDwg[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_isoDwg[index] = this.operator;
				      		filterVArr_isoDwg[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "area_loc");
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_isoDwg,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "area_loc"),
					    operator: (($(data.filter).length > 0) ? filterOArr_isoDwg : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_isoDwg : priorArealoc_di.aname),
					    dir: ($(data.sort).length ? data.sort[0].dir : "asc"),
					    aname: priorArealoc_di.aname,
					    pno: priorArealoc_di.pno,//.substr(0,2),
					    tbAdvance: ($("#chk1").is(":checked") ? "1" : "0")
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 11,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_isoDwg.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_isoDwg = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        plant_no: { type: "string" },
                        area_no: { type: "string" },
                        area_loc: { type: "string" },
                        drawing_no: { type: "string" },
                        sheet_no: { type: "string" },
                        rev_no: { type: "string" },
                        lbsb: { type: "string" },
                        matl: { type: "string" },
                        piping_class: { type: "string" },
                        priority_timing: { type: "string" },
                        priority_code: { type: "string" },
                        tot_lm: { type: "float" }
                        
                        
                        
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
                                
	    var addExtraStylingToGrid1 = function () {
			$("#isoDwg_grid").data("kendoGrid").select("tr:eq(1)");
	        $("#isoDwg_grid > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_isoDwg = [];
	    };
        
        var grid1 = $("#isoDwg_grid").kendoGrid({
            dataSource: isoDwg_ds,
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
               {field: "plant_no",title: "Plant No",width: 140},
               {field: "area_no",title: "Area No",width: 100},
               {field: "area_loc",title: "Area Loc.",width: 180},
               {field: "drawing_no",title: "Drawing No",width: 100},
               {field: "sheet_no",title: "Sheet No",width: 100},
               {field: "rev_no",title: "Rev No", width: 120},
               {field: "lbsb",title: "LB/SB", width: 120},
               {field: "matl",title: "EM/FAB", width: 120},
               {field: "piping_class",title: "Piping Class", width: 120},
               {field: "priority_timing",title: "Priority Timing", width: 120},
               {field: "priority_code",title: "Priority Code", width: 120},
               {field: "tot_lm",title: "Total LM", width: 120},   
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        isoDwg_di = this.dataItem(selectedRows[i]);
			        mat_takeoff_perspool_ds.read();
			        splLst_ds.read();
			        jointLst_ds.read();
			        erecmat_ds.read();
			        pipeLst_ds.read();
			    }
           },
           dataBound: addExtraStylingToGrid1
        });
        insertGridTitle('#isoDwg_grid','Reference');  
		
				// -- PROGRAMMING CODE/PRIOR_SETUP DATASOURSE -- //
				
        var priorSetup_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/prior_setup",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_priorSetup[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_priorSetup[index] = this.operator;
				      		filterVArr_priorSetup[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_priorSetup,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "commodity_code"),
					    operator: (($(data.filter).length > 0) ? filterOArr_priorSetup : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_priorSetup : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "asc") 
			        }
			      }else {
			      	data.flg_status = (data.flg_status ? 1 : 0)
			      	return data;
			      }
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 4,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_priorSetup.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_priorSetup = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        stock_no: { type: "string" },
                        
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

	    var addExtraStylingToGrid2 = function(){
			$("#priorSetup_grid").data("kendoGrid").select("tr:eq(" + (isoDwg_ds._data.length + 2) + ")");
	        $("#priorSetup_grid > .k-grid-content > table > tbody > tr").hover(
	            function(){
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_priorSetup = [];
	    };

        var grid2 = $("#priorSetup_grid").kendoGrid({
            dataSource: priorSetup_ds,
            selectable: "row",
            pageable: {
                buttonCount: 3,
    			input: false
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
            columns: [ //display on grid
               {field: "p_char1",title: "Priority",width: 154},
               {field: "p_char2",title: "Priority Name",width: 154}
               
              
           ],
           change: function(e){
           		currRow2 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        priorSetup_di = this.dataItem(selectedRows[i]);
			        grid_change(this,"priorSetup_grid"); //display of data into fields
			        priorArealoc_ds.read();
					
			    }
           },
           dataBound: addExtraStylingToGrid2
        });
        insertGridTitle('#priorSetup_grid','Priority');  
        
                   // -- PROGRAMMING CODE/AREA_LOC DATASOURCE -- //

        var priorArealoc_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/sp_arealoc",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_priorArealoc[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_priorArealoc[index] = this.operator;
				      		filterVArr_priorArealoc[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_priorArealoc,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "pseq"),
					    operator: (($(data.filter).length > 0) ? filterOArr_priorArealoc : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_priorArealoc : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    pno: priorSetup_di.p_char1.substr(0,2)
					    
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 5,
            serverPaging: false,
			serverFiltering: false,
			serverSorting: false,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_priorArealoc.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_priorArealoc = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        aname: { type: "string" },
                        pno: { type: "string" },
                        pseq: { type: "string" },
                        aseq: { type: "string" }
                       
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
                                
	    var addExtraStylingToGrid3 = function () {
			$("#priorArealoc_grid").data("kendoGrid").select("tr:eq(" + (isoDwg_ds._data.length + priorSetup_ds._data.length + 3) + ")");
	        $("#priorArealoc_grid > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_jmifdtl = [];
	    };
        
        var grid3 = $("#priorArealoc_grid").kendoGrid({
            dataSource: priorArealoc_ds,
            selectable: "row",
			pageable: {
                buttonCount: 3,
    			input: false
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
               {field: "aname",title: "Unit Name",width: 171},
               {field: "pno",title: "Prior",width: 72},
                {field: "pseq",title: "Prior Seq",width: 85},
               {field: "aseq",title: "Unit Seq",width: 85}
                    
           ],
           change: function(e){
           		currRow3 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        priorArealoc_di = this.dataItem(selectedRows[i]);
			        //filterFArr_jmifdtl[filterFArr_jmifdtl.length] = "area_loc;" + jwrrdtl_di.aname + ";eq" ;
			        isoDwg_ds.read();
			    }
           },
           dataBound: addExtraStylingToGrid3
        });
        insertGridTitle('#priorArealoc_grid','Contruction Unit');  
        
         
         		// -- ERECTION MATERIAL DATASOURCE -- //
        		
        var erecmat_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/mat_takeoff_perspoolRef2",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_erecmat[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_erecmat[index] = this.operator;
				      		filterVArr_erecmat[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_erecmat,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "isc_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_erecmat : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_erecmat : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    plant_no: isoDwg_di.plant_no,
					    area_no: isoDwg_di.area_no,
					    drawing_no: isoDwg_di.drawing_no,
					    sheet_no: isoDwg_di.sheet_no,
					    rev_no: isoDwg_di.rev_no
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 5,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_erecmat.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_erecmat = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        spool_no: { type: "string" },
                        isc_no: { type: "string" },
                        item_code: { type: "string" },
                        size_: { type: "string" },
                        qty: { type: "string" }
                       
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
                                
	    var addExtraStylingToGrid4 = function () {
			$("#erecmat_rs").data("kendoGrid").select("tr:eq(" + (priorSetup_ds._pageSize + priorArealoc_ds._pageSize + isoDwg_ds._data.length   + 4) + ")");
	        $("#erecmat_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_erecmat = [];
	    };
        
        var grid5 = $("#erecmat_rs").kendoGrid({
            dataSource: erecmat_ds,
            selectable: "row",
			pageable: {
                buttonCount: 3,
    			input: false
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
               {field: "isc_no",title: "Item No",width: 80},
               {field: "drawing_no",title: "Drawing No",width: 200},
               {field: "item_code",title: "Item No",width: 85},
               {field: "size_",title: "Size",width: 85},
               {field: "qty",title: "MTO QTY",width: 100}
                    
           ],
           change: function(e){
           		currRow4 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        erecmat_di = this.dataItem(selectedRows[i]);
			        
			    }grid_change(currRow4, "#erecmat_rs" );
           },
           dataBound: addExtraStylingToGrid4
        });
        insertGridTitle('#erecmat_rs','Erection Material'); 
        
        	// -- MAT_TAKEOFF_PERSPOOL DATASOURCE -- //
        		
        var mat_takeoff_perspool_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/mat_takeoff_perspoolRef",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_splmat[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_splmat[index] = this.operator;
				      		filterVArr_splmat[index] = valForm;
				      	});
				    }fieldSort = ($(data.sort).length ? data.sort[0].field : "drawing_no");
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_splmat,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "isc_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_splmat : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_splmat : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    plant_no: isoDwg_di.plant_no,
					    area_no: isoDwg_di.area_no,
					    drawing_no: isoDwg_di.drawing_no,
					    sheet_no: isoDwg_di.sheet_no,
					    rev_no: isoDwg_di.rev_no
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 5,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_splmat.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_splmat = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        spool_no: { type: "string" },
                        isc_no: { type: "string" },
                        item_code: { type: "string" },
                        size_: { type: "string" },
                        qty: { type: "string" }
                       
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
                                
	    var addExtraStylingToGrid5 = function () {
			$("#splmat_rs").data("kendoGrid").select("tr:eq(" + ( priorSetup_ds._pageSize + priorArealoc_ds._pageSize + isoDwg_ds._data.length + erecmat_ds._data.length + 5) + ")");
	        $("#splmat_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_splmat = [];
	    };
        
        var grid5 = $("#splmat_rs").kendoGrid({
            dataSource: mat_takeoff_perspool_ds,
            selectable: "row",
			pageable: {
                buttonCount: 3,
    			input: false
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
               {field: "spool_no",title: "Spool No",width: 80},
               {field: "isc_no",title: "Item No",width: 80},
               {field: "drawing_no",title: "Drawing No",width: 100},
               {field: "item_code",title: "Item No",width: 85},
               {field: "size_",title: "Size",width: 85},
               {field: "qty",title: "MTO QTY",width: 85}
                    
           ],
           change: function(e){
           		currRow5 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        splmat_di = this.dataItem(selectedRows[i]);
			        
			    }grid_change(currRow5, "#splmat_rs" );
           },
           dataBound: addExtraStylingToGrid5
        });
        insertGridTitle('#splmat_rs','Spool Type'); 
        
         // -- PIPE SUPPORT LIST DATASOURCE -- //
        		
        var pipeLst_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/pipeLstRef",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_pipeLst[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_pipeLst[index] = this.operator;
				      		filterVArr_pipeLst[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_pipeLst,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "stock_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_pipeLst : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_pipeLst : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    drawing_no: isoDwg_di.drawing_no
					    // sheet_no: isoDwg_di.sheet_no,
					    // rev_no: isoDwg_di.rev_no
					    // plant_no: isoDwg_di.plant_no,
					    // area_no: isoDwg_di.area_no,
				   }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 5,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_pipeLst.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_pipeLst = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        spool_no: { type: "string" },
                        isc_no: { type: "string" },
                        item_code: { type: "string" },
                        stock_no: { type: "string" },
                        iso_qty: { type: "string" },
                        lbsb: { type: "string" },
                        size_: { type: "string" }
                        
                       
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
                                
	    var addExtraStylingToGrid6 = function () {
			$("#pipeLst_grid").data("kendoGrid").select("tr:eq(" + (priorSetup_ds._pageSize + priorArealoc_ds._pageSize + isoDwg_ds._data.length + erecmat_ds._data.length + mat_takeoff_perspool_ds._data.length + 6) + ")");
	        $("#pipeLst_grid > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_pipeLst = [];
	    };
        
        var grid6 = $("#pipeLst_grid").kendoGrid({
            dataSource: pipeLst_ds,
            selectable: "row",
			pageable: {
                buttonCount: 3,
    			input: false
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
               {field: "stock_no",title: "DWG/PS Code/PS Type",width: 130},
               {field: "iso_qty",title: "MTO Qty",width: 40},
               {field: "lbsb",title: "LB/SB",width: 40}
         
                    
           ],
           change: function(e){
           		currRow6 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        pipeLst_di = this.dataItem(selectedRows[i]);
			        
			    }
           },
           dataBound: addExtraStylingToGrid6
        });
        insertGridTitle('#pipeLst_grid','Pipe Support List');
        
         // -- JOINTS LIST DATASOURCE -- //
        		
        var jointLst_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/jointLstRef",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_jointLst[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_jointLst[index] = this.operator;
				      		filterVArr_jointLst[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_jointLst,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "spool_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_jointLst : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_jointLst : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    plant_no: isoDwg_di.plant_no,
					    area_no: isoDwg_di.area_no,
					    drawing_no: isoDwg_di.drawing_no,
					    sheet_no: isoDwg_di.sheet_no,
					    rev_no: isoDwg_di.rev_no
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 5,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_jointLst.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_jointLst = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        spool_no: { type: "string" },
                        isc_no: { type: "string" },
                        item_code: { type: "string" },
                        size_: { type: "string" },
                        qty: { type: "string" }
                       
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
                                
	    var addExtraStylingToGrid7 = function () {
			$("#jointLst_grid").data("kendoGrid").select("tr:eq(" + (priorSetup_ds._pageSize + priorArealoc_ds._pageSize + isoDwg_ds._data.length +  mat_takeoff_perspool_ds.length + erecmat_ds.length + pipeLst_ds.length + 7) + ")");
	        $("#jointLst_grid > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_jointLst = [];
	    };
        
        var grid7 = $("#jointLst_grid").kendoGrid({
            dataSource: jointLst_ds,
            selectable: "row",
			pageable: {
                buttonCount: 3,
    			input: false
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
               {field: "spool_no",title: "Spool/EM",width: 80},
               {field: "mat_type",title: "Shp/Fld/Thrd",width: 120},
               {field: "joint_no",title: "Joint No",width: 85},
               {field: "joint_type",title: "Joint type",width: 85},
               {field: "lbsb",title: "LBSB",width: 85},
               {field: "diainch",title: "Diainch",width: 85},
         
                    
           ],
           change: function(e){
           		currRow7 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        splmat_di = this.dataItem(selectedRows[i]);
			        
			    }
           },
           dataBound: addExtraStylingToGrid7
        });
        insertGridTitle('#jointLst_grid','Joints List');  
        
       // -- SPOOL LIST DATASOURCE -- //
        		
        var splLst_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/spoolRef",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_splLst[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_splLst[index] = this.operator;
				      		filterVArr_splLst[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_splLst,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "spool_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_splLst : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_splLst : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    plant_no: isoDwg_di.plant_no,
					    area_no: isoDwg_di.area_no,
					    drawing_no: isoDwg_di.drawing_no,
					    sheet_no: isoDwg_di.sheet_no,
					    rev_no: isoDwg_di.rev_no
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 5,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_splLst.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_splLst = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        spool_no: { type: "string" },
                        isc_no: { type: "string" },
                        item_code: { type: "string" },
                        size_: { type: "string" },
                        qty: { type: "string" }
                       
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
                                
	    var addExtraStylingToGrid8 = function () {
			$("#splLst_grid").data("kendoGrid").select("tr:eq(" + (priorSetup_ds._pageSize + priorArealoc_ds._pageSize + isoDwg_ds._data.length + mat_takeoff_perspool_ds.length + erecmat_ds.length + pipeLst_ds.length + jointLst_ds + 7) + ")");
	        $("#splLst_grid > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_splLst = [];
	    };
        
        var grid8 = $("#splLst_grid").kendoGrid({
            dataSource: splLst_ds,
            selectable: "row",
			pageable: {
                buttonCount: 3,
    			input: false
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
               {field: "spool_no",title: "Spool No",width: 80},
               {field: "lbsb",title: "LBSB",width: 100},
               {field: "paint_reqd",title: "Paint Req",width: 85}
         
                    
           ],
           change: function(e){
           		currRow8 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        splmat_di = this.dataItem(selectedRows[i]);
			       	
			        
			    }
			    
           },
           	
           dataBound: addExtraStylingToGrid6
        });
        insertGridTitle('#splLst_grid','Spool List');  
        
        
       // -- event handler -- //
       $("#chk1").change(function(){
	     	isoDwg_ds.read();
	     });   
      var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");
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
	    			case "exportButt":
	    				var conF = confirm('Do you want to export files?');
	    					if(!conF)
	    					return true;
	    						var ladvance = confirm('Do you want to use advance tab?');
						    	open_preloader();
						    	var link = document.createElement('a');
					        	link.href = crudService + "directCall/export_isoDwg/?";
					        	link.href += ("fieldS=" + fieldSort + "&");
					        	link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
					        	link.href += ("dir=" + dirSort + "&ladvance=" + ladvance);
					 
						        //Dispatching click event.
						        if (document.createEvent) {
						            var e = document.createEvent('MouseEvents');
						            e.initEvent('click' ,true ,true);
						            link.dispatchEvent(e);
							    	close_preloader();
						            return true;
						        }
						        
						   // $.get(crudService + "directCall/export_isoDwg",{fieldS: fieldSort,fieldF: "",dir: dirSort},
					       	    // function(data){
// 									
									// showNotif("warning",data,"warning");
					       	    // });

						    
                	break;
                	case "exportButt2":
                	 // $.get(crudService + "directCall/export_spl",{fieldS: fieldSort,fieldF: "",dir: dirSort},
					       	    // function(data){
// 									
									// showNotif("warning",data,"warning");
					       	    // });
					   var conF2 = confirm('Do you want to export files?');
	    					if(!conF2)
	    					return true;
	    						var ladvance2 = confirm('Do you want to use advance tab?');
						    	open_preloader();
						    	var link = document.createElement('a');
					        	link.href = crudService + "directCall/export_spl/?";
					        	link.href += ("fieldS=" + fieldSort + "&");
					        	link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
					        	link.href += ("dir=" + dirSort + "&ladvance=" + ladvance2);
					 
						        //Dispatching click event.
						        if (document.createEvent) {
						            var e = document.createEvent('MouseEvents');
						            e.initEvent('click' ,true ,true);
						            link.dispatchEvent(e);
							    	close_preloader();
						            return true;
						        }


                	break;
                	case "exportButt3":
					   var conF3 = confirm('Do you want to export files?');
	    					if(!conF3)
	    					return true;
	    						var ladvance3 = confirm('Do you want to use advance tab?');
						    	open_preloader();
						    	var link = document.createElement('a');
					        	link.href = crudService + "directCall/export_ps_mto_hdr/?";
					        	link.href += ("fieldS=" + fieldSort + "&");
					        	link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
					        	link.href += ("dir=" + dirSort + "&ladvance=" + ladvance3);
					 
						        //Dispatching click event.
						        if (document.createEvent) {
						            var e = document.createEvent('MouseEvents');
						            e.initEvent('click' ,true ,true);
						            link.dispatchEvent(e);
							    	close_preloader();
						            return true;
						        }

// 						    

                	break;
                	case "exportButt4":
					    var conF4 = confirm('Do you want to export files?');
	    					if(!conF4)
	    					return true;
	    						var ladvance4 = confirm('Do you want to use advance tab?');
						    	open_preloader();
						    	var link = document.createElement('a');
					        	link.href = crudService + "directCall/export_joints/?";
					        	link.href += ("fieldS=" + fieldSort + "&");
					        	link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
					        	link.href += ("dir=" + dirSort + "&ladvance=" + ladvance4);
					 
						        //Dispatching click event.
						        if (document.createEvent) {
						            var e = document.createEvent('MouseEvents');
						            e.initEvent('click' ,true ,true);
						            link.dispatchEvent(e);
							    	close_preloader();
						            return true;
						        }
                	break;
                	case "exportButt5":
                		 // $.get(crudService + "directCall/export_mat_takeoff_perspool",{fieldS: fieldSort,fieldF: "",dir: dirSort},
					       	    // function(data){
// 									
									// showNotif("warning",data,"warning");
					       	    // });


					    var conF5 = confirm('Do you want to export files?');
	    					if(!conF5)
	    					return true;
	    						var ladvance5 = confirm('Do you want to use advance tab?');
						    	open_preloader();
						    	var link = document.createElement('a');
					        	link.href = crudService + "directCall/export_mat_takeoff_perspool/?";
					        	link.href += ("fieldS=" + fieldSort + "&");
					        	link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
					        	link.href += ("dir=" + dirSort + "&ladvance=" + ladvance5);
					 
						        //Dispatching click event.
						        if (document.createEvent) {
						            var e = document.createEvent('MouseEvents');
						            e.initEvent('click' ,true ,true);
						            link.dispatchEvent(e);
							    	close_preloader();
						            return true;
						        } 


                	break;
                	case "exportButt6":
					    var conF6 = confirm('Do you want to export files?');
	    					if(!conF6)
	    					return true;
	    						var ladvance6 = confirm('Do you want to use advance tab?');
						    	open_preloader();
						    	var link = document.createElement('a');
					        	link.href = crudService + "directCall/export_mat_takeoff_perspool2/?";
					        	link.href += ("fieldS=" + fieldSort + "&");
					        	link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
					        	link.href += ("dir=" + dirSort + "&ladvance=" + ladvance6);
					 
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
						$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
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
											disc_code: $("#txt1").val(),
											disc_desc: $("#textarea").val(),
											flg_status: ($("#rad1").is(":checked") ? 1 : 0)});
							dataSource.sync();
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/rdisc",{PROGRESS_RECID: dataItem.PROGRESS_RECID,disc_code: $("#txt1").val(), disc_desc: $("#textarea").val(), flg_status: ($("#rad1").is(":checked") ? 1 : 0)},
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
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				$("#coverDiv").remove();
	    	}
	    });
	});
</script>