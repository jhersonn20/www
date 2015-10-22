<style>
	.k-upload-files {
		width: 655px;
	}
</style>
<div id = "uplFabShop">
	<div id="main-wrapper">
	<form method="post" action="submit" style="width: 100%;margin-bottom: 5px;">
        <div class="demo-section">
            <input name="files" id="files" type="file" accept=".csv" />
        </div>
    </form>	
    <div class="wrap-grid demo-section" style="width: 98.8%;">
        <div id="rowSelection"></div>
    </div>
	<div class="wrap-button demo-section">
		<div class="buttonLeft">
        	<button type="button" class="k-button k-state-disabled" id="importButt" disabled>Import</button>
			<label class="title">Loaded: </label><input type="text" name="txtUpl1" id="txtUpl1" class="k-textbox" style="width: 100px;" disabled>
       	</div>
		<div class="buttonRight">
        	<span>Noted: Must have the same column order following the displayed list above.</span>
       	</div>				
	</div>
</div>
	
</div>

<div id="main-wrapper">
	<div style="margin-bottom: 5px;float:right; width: 72%;">
		<div class="wrap-button demo-section" style="width: 100%;">
			<input type="checkbox" name="chk1" id="chk1"><label class="title short" for="chk1">Advance</label>
			<input type="radio" name="option" checked id="rad1"  /><label class="title short" for="rad1">Completed</label>
        	<input type="radio" name="option" id="rad2" /><label class="title short" for="rad2">Not Completed</label>
		</div>
		<div class="wrap-form demo-section apply8" style="width: 100%;display: block; margin-bottom: 20px; min-height: 457px;">
			<div id="isoDwg_grid"></div>
		</div>
		<div class="wrap-button demo-section" style="width: 100%;">
			<div class="buttonLeft" >
				<button class="k-button mainEve" id="exportButt">Export Engg SPL</button>
			</div>
		</div>
	</div>
	<div class="wrap-grid demo-section" style=" width: 25%;margin-left: 0; min-height: 545px;">
        <div id="priorSetup_grid" style="width: 100%;margin-bottom: 2px;"></div> 
        <div id="priorArealoc_grid" style="width: 100%"></div>
   	</div>
   	<div class="wrap-form demo-section apply8" style="width: 100%;display: block; margin-bottom: 20px; min-height: 280px;"> 
			<div id="splmat_rs"></div>
	</div>
   	
	<div class="wrap-button demo-section" style="width: 100%;">
		<div class="buttonLeft" style="width: 100%;">
        	<button class="k-button mainEve" id="exportButt2">Export FABshop SPL</button>
        	<button class="k-button mainEve" id="uploadButt">Upload</button>
        	<input type="radio" name="option2" checked id="rad1"  /><label class="title short" for="rad1" style="color: #C8C8C8 ;font-weight: bold;">Completed</label>
        	<input type="radio" name="option2" id="rad2" /><label class="title short" for="rad2" style="color: #C8C8C8 ;font-weight: bold;">Not Completed</label>
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
			filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "",
        	uplList = [], disImport, errCounter, fileName = "",dataItem ='',
		    filterFArr_isoDwg = [], filterOArr_isoDwg = [], filterVArr_isoDwg = [], currRow = "", isoDwg_di = '', 
		    filterFArr_priorSetup = [], filterOArr_priorSetup = [], filterVArr_priorSetup = [], currRow2 = "", priorSetup_di = '', 
		    filterFArr_priorArealoc = [], filterOArr_priorArealoc = [], filterVArr_priorArealoc = [], currRow3 = "", priorArealoc_di = '',
		    filterFArr_splmat = [], filterOArr_splmat = [], filterVArr_splmat = [], currRow4 = "", splmat_di = '',
		    filterFArr_erecmat = [], filterOArr_erecmat = [], filterVArr_erecmat = [], currRow5 = "", erecmat_di = '',
		    filterFArr_splLst = [], filterOArr_splLst = [], filterVArr_splLst = [], currRow6 = "", splLst_di = '',
		    filterFArr_jointLst = [], filterOArr_jointLst = [], filterVArr_jointLst = [], currRow7 = "", jointLst_di = '',
		    filterFArr_pipeLst = [], filterOArr_pipeLst = [], filterVArr_pipeLst = [], currRow8 = "", pipeLst_di = '', percent_ds = [],percent_ds2 = [],
		    isFailed = false, fieldSort = "", dirSort = "", query = "", dataItem3 ='', percentF = '', percentT = '';
		    
			// -- fabUpload grid -- //
		
		var ubrpip_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/ttUpdateFab",
                    contentType: "application/json",
                    type: "GET"
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
					    fieldS: ($(data.sort).length ? data.sort[0].field : "area_loc"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        }
			      }
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
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
               		alert("No records found!");
					sentValue = "";
					filterFArr = [];
					$("form.k-filter-menu button[type='reset']").trigger("click");
               	}
               },
               model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: {type: "number", editable: false},
				        area_no: {type: "string", editable: false},
				        area_loc: {type: "string", editable: false},
				        spool_id: {type: "string", editable: false},                    
				        tot_jnt: {type: "string", editable: false},               
				        tot_jnt_dia: {type: "string", editable: false},        
				        tot_jnt_fu: {type: "string", editable: false},        
				        tot_jnt_fu_dia: {type: "string", editable: false},
				        spl_fu_remarks: {type: "string", editable: false},
				        tot_jnt_fw: {type: "string", editable: false},
				        tot_jnt_fw_dia: {type: "string", editable: false},                    
				        tot_jnt_fw_remarks: {type: "string", editable: false},               
				        fab_cut_date: {type: "string", editable: false},        
				        fab_fitup_date: {type: "string", editable: false},        
				        fab_weld_date: {type: "string", editable: false},
				        fab_qcrel_date: {type: "string", editable: false},
				        remarks1: {type: "string", editable: false}
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
                                
	    var addExtraStylingToGrid9 = function () {
			$("#rowSelection").data("kendoGrid").select("tr:eq(1)");
	        $(".k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr = [];
	    };
        
        var ubrpip_rs = $("#rowSelection").kendoGrid({
            dataSource: ubrpip_ds,
            selectable: "row",
            pageable: {
                buttonCount: 5,
                refresh: true,
                pageSizes: true,
    			input: true
            },
            autoBind: false,
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: false,
            resizable: true,
            editable: false,
            filterable: {
                extra: false
            },
            columns: [
		       {field: "area_no",width: 150,title: "Area No."},
		       {field: "area_loc",width: 150,title: "Area Loc."},
		       {field: "spool_id",width: 150,title: "Spool ID."},                    
		       {field: "tot_jnt",width: 150,title: "Total Joint."},               
		       {field: "tot_jnt_dia",width: 150,title: "Total Joint  Inch."},        
		       {field: "tot_jnt_fu",width: 170,title: "Total Joint FU."},        
		       {field: "tot_jnt_fu_dia",width: 170,title: "Total Joint FU Ø Inch"},
		       {field: "spl_fu_remarks",width: 150,title: "Complete Fit-up Remarks."},
		       {field: "tot_jnt_fw",width: 150,title: "Total Jnt FW"},
		       {field: "tot_jnt_fw_dia",width: 150,title: "Total Joint FW Ø Inch"},                    
		       {field: "tot_jnt_fw_remarks",width: 150,title: "Complete Weld-up Remarks"},               
		       {field: "fab_cut_date",width: 150,title: "FAB Cut Date"},        
		       {field: "fab_fitup_date",width: 170,title: "FAB Fitup Date"},        
		       {field: "fab_weld_date",width: 170,title: "FAB Weld Date"},
		       {field: "fab_qcrel_date",width: 150,title: "Fab QC Rel Date"},
		       {field: "remarks1",width: 150,title: "Upload Status Remarks"}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
           },
           dataBound: addExtraStylingToGrid9
        });
        insertGridTitle("#rowSelection","Text File Uploading");
		
		// --ttisoSpool DATASOURCE -- //
        
        
        var isoDwg_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/tfabSplwise",
                    contentType: "application/json",
                    type: "GET",
	                complete: function(jqXHR, textStatus) {
	                	// console.log(jqXHR);
						// showNotif('Warning',jqXHR.responseText,'warning');
	                }
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
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "spool_id");
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_isoDwg,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "spool_id"),
					    operator: (($(data.filter).length > 0) ? filterOArr_isoDwg : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_isoDwg : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    aname: priorArealoc_di.aname,
					    pno: priorSetup_di.pno,
					    priority: priorArealoc_di.pno,
					    rswork: $('input[name=option]:checked').index('input[name=option]'),
					    tbAdvance: ($("#chk1").is(":checked") ? 1 : 0)
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 12,
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
                        spool_id: { type: "string" },
                        fab_stat: { type: "string" },
                        fab_start_dt: { type: "date" },
                        fitup_date: { type: "date" },
                        fab_end_dt: { type: "date" },
                        fab_qc_release_dt: { type: "date" },
                        tot_diainch: { type: "float" },
                        sw_diainch: { type: "float" },
                        fab_remarks: { type: "string" },
                        spool_no: { type: "string" },
                        drawing_no: { type: "string" },
                        sheet_no: { type: "string" },
                        rev_no: { type: "string" },
                        plant_no: { type: "string" },
                        area_no: { type: "string" },
                        area_loc: { type: "string" },
                        lbsb: { type: "string" },
                        mat_type: { type: "string" },
                        piping_class: { type: "string" },
                        priority_timing: { type: "string" },
                        priority_code: { type: "string" },
                        paint_reqd: { type: "string" }
                        

                        
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
               {field: "spool_id",title: "Spool ID",width: 140},
               {field: "fab_stat",title: "Fab Stat",width: 140},
               {field: "fab_start_dt",title: "FAB Start Date",width: 140},
               {field: "fitup_date",title: "Fitup Date",width: 140},
               {field: "fab_end_dt",title: "Fab End Date",width: 140},
               {field: "fab_qc_release_dt",title: "Fab QC Release Date",width: 140},
               {field: "tot_diainch",title: "Total Joint FW Inch",width: 140},
               {field: "sw_diainch",title: "Total Joint Inch",width: 140},
               {field: "fab_remarks",title: "Fab Remarks",width: 140},
               {field: "spool_no",title: "Spool No",width: 140},
               {field: "drawing_no",title: "Drawing No",width: 140},
               {field: "sheet_no",title: "Sheet No",width: 140},
               {field: "rev_no",title: "Revision No",width: 140},
               {field: "plant_no",title: "Plant No",width: 140},
               {field: "area_no",title: "Area No",width: 140},
               {field: "area_loc",title: "Area Loc",width: 140},
               {field: "lbsb",title: "LB/SB",width: 140},
               {field: "mat_type",title: "EM/SPL/RDM/OTHR",width: 140},
               {field: "piping_class",title: "Piping Class",width: 140},
               {field: "priority_timing",title: "Priority Timing",width: 140},
               {field: "priority_code",title: "Priority Code",width: 140},
               {field: "paint_reqd",title: "Paint Reqd",width: 140}
               
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        isoDwg_di = this.dataItem(selectedRows[i]);
			       
			    }
           },
           dataBound: addExtraStylingToGrid1
        });
        insertGridTitle('#isoDwg_grid','Engg Spool');  
		
				// -- PROGRAMMING CODE/PRIOR_SETUP DATASOURSE -- //
				
        var priorSetup_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/priorSetup",
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
            autobind: false,
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
               {field: "pno",title: "Priority",width: 154},
               {field: "pname",title: "Priority Name",width: 154}
               
              
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
					    pno: priorSetup_di.pno.substr(0,2)
					    
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
        
        
        	// -- MAT_TAKEOFF_PERSPOOL DATASOURCE -- //
        		
        var mat_takeoff_perspool_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/tfab_mat_spl_ref",
                    contentType: "application/json",
                    type: "GET"
                },
                update: {
                    url: crudService + "manage/callSP_upl_tfab",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
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
				    }fieldSort = ($(data.sort).length ? data.sort[0].field : "spool_id");
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_splmat,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "spool_id"),
					    operator: (($(data.filter).length > 0) ? filterOArr_splmat : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_splmat : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    rsComplete: $('input[name=option2]:checked').index('input[name=option2]')
					    
					    
			        }
			      }else
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
                        spool_id: { type: "string" },
                        tot_jnt: { type: "string" },
                        tot_jnt_dia: { type: "string" },
                        tot_jnt_fu: { type: "string" },
                        tot_jnt_fu_dia: { type: "string" },
                        spl_fu_remarks : { type: "string" },
                        tot_jnt_fw: { type: "string" },
                        tot_jnt_fw_dia: { type: "string" },
                        spl_fw_remarks: { type: "string" },
                        fab_cut_date: { type: "date" },
                        fab_fitup_date: { type: "date" },
                        fab_weld_date : { type: "date" },
                        fab_qcrel_date : { type: "date" }
                       
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
			$("#splmat_rs").data("kendoGrid").select("tr:eq(1)");
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
               {field: "spool_id",title: "Spool No",width: 180},
               {field: "tot_jnt",title: "Total Jnt",width: 102},
               {field: "tot_jnt_dia",title: "Total JntØ Inch",width: 153},
               {field: "tot_jnt_fu",title: "Total Jnt FU",width: 131},
               {field: "tot_jnt_fu_dia",title: "Total Jnt FU!Ø Inch",width: 155},
               {field: "spl_fu_remarks",title: "Complete Fit-up Remarks",width: 190},
               {field: "tot_jnt_fw",title: "Total Jnt FW",width: 155},
               {field: "tot_jnt_fw_dia",title: "Total Jnt FW Ø Inch",width: 155},
               {field: "spl_fw_remarks",title: "Complete Weld-up Remarks",width: 220},
               {field: "fab_cut_date",title: "FAB!CUT!DATE",width: 180,format: "{0:MM/dd/yyyy}"},
               {field: "fab_fitup_date",title: "FAB FITUP DATE",width: 182,format: "{0:MM/dd/yyyy}"},
               {field: "fab_weld_date",title: "FAB WELD DATE",width: 180,format: "{0:MM/dd/yyyy}"},
               {field: "fab_qcrel_date",title: "FAB QC REL DATE",width: 180,format: "{0:MM/dd/yyyy}"}
           ],
           change: function(e){
           		currRow5 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        splmat_di = this.dataItem(selectedRows[i]);
			       
			    }
				grid_change(currRow5, "#splmat_rs" );
           },
           dataBound: addExtraStylingToGrid4
        });
        insertGridTitle('#splmat_rs','FABshop Spool'); 
        
 
      // -- Event Handler -- //
            
	  var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");
	     
	      var onSelect = function(e){
        	if (e.files[0].extension != ".csv"){
				showNotif("Information","Select failed. Upload accepts '.csv' files only!","info");
        		e.preventDefault();
        		return true;
        	}
		    fileName = e.files[0].name;
        		
        	if ($(".k-upload-files > li").length == 0)
        		return true;

        	$(".k-upload-files > li").eq(0).remove();
    		var raw = ubrpip_ds.data();
		    var length = raw.length;
		    var item, i;
		
		    for(i=length-1; i>=0; i--){
		        item = raw[i];
		        ubrpip_ds.remove(item);
		    }

			$("#importButt, #updateButt").prop("disabled", true).addClass("k-state-disabled");
        }

        var getFileInfo = function (e) {
                    return $.map(e.files, function(file) {
                    	console.log(file);
                        var info = file.name;

                        // File size is not available in all browsers
                        if (file.size > 0) {
                            info  += " (" + Math.ceil(file.size / 1024) + " KB)";
                        }
                        return info;
                    }).join(", ");
                };
        
        var onSuccess = function(e){
			open_preloader();
        	disImport = true;
			uplList = [];
			errCounter = 0;
			$.get("/assets/uploads/" + e.files[0].name, function(data) {
				data = $.csv.toObjects(data);
				data = JSON.stringify({rows: data});
				data = eval("(" + data + ")");
				rows = data.rows;
				
				$.each(data.rows, function(index,value){
					if ($.trim(this.spool_id) == "") //||$.trim(this.spool_id).indexOf('draw') >= 0 -- $.trim(this.remarks1) == "" ||
						return;
						
					disImport = false;
					uplList.push(this);
				});

				data = JSON.stringify({rows: uplList});
				data = eval("(" + data + ")");
			
				$("#importButt, #updateButt").prop("disabled", disImport);
				if (!disImport)
					$("#importButt, #updateButt").removeClass("k-state-disabled");
	
				$("#rowSelection").data("kendoGrid").dataSource.data(data.rows);
				close_preloader();
			});
        }
        
		$("#files").kendoUpload({
			async: {
				saveUrl: crudService + "save_upload",
				removeUrl: crudService + "remove_upload",
				autoUpload: false
			},
			localization: {
				dropFilesHere: "| Drop here..."
			},
			multiple: false,
			select: onSelect,
			success: onSuccess
		});
		
		
	     $("input[name=option]").change(function(){
	     	if($("#rad1").prop("checked")){
	     		
	    		isoDwg_ds.read();
	     	}else {
	    		isoDwg_ds.read();
				
	    		
	     	}									
	    });  
	    
	    $("input[name=option2]").change(function(){
	     	if($("#rad1").prop("checked")){
	     		mat_takeoff_perspool_ds.read();
	    		
	     	}else {
	    	 	mat_takeoff_perspool_ds.read();
				
	    		
	     	}									
	    });   
	    
	    $("#chk1").change(function(){
	     	isoDwg_ds.read();
				    
	     });
	     
	      $("#uplFabShop").kendoWindow({ 
            width: "1015px",
            height: "auto",
            title: "Upload Piping PAINTING Progress Workability [SPL Wise]",
            modal: true,
            visible: false,
            resizable: false,
            scrollable: true,
            open: function(){
            	//console.log(this);
            }
        });
        
        $("#main-wrapper button").bind({
			click: function(){
				switch(this.id){
					case "uploadButt":
						upload = $("#files").data("kendoUpload");
					break;
					default:
						open_preloader();
						$.post(crudService + "directCall/callSP_upl_tfab",
							function(data){
								showNotif("Information",($.trim(data) == "") ? "Upload Successful!" : data,"info");
									
					    		var raw = ubrpip_ds.data();
							    var length = raw.length;						
								$("#txtUpl1").val(length);
								$("#importButt").prop("disabled", true).addClass("k-state-disabled");
								$("#files").data("kendoUpload").disable();
								close_preloader();
								$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
								$("#rowSelection").data("kendoGrid").dataSource.read();
								$("#splmat_rs").data("kendoGrid").dataSource.read();
								$("#uplFabShop").data("kendoWindow").close();
								
								
							});
					break;
				}
			}
		});
	     
	    $(".wrap-form input, .wrap-form textarea, .wrap-form button, .kendoComboBox ").prop("disabled", true).addClass("k-state-disabled");
	    $(".wrap-button .buttonLeft button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "uploadButt":
	    				$("#uplFabShop").data("kendoWindow").center().open();
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
	    				return true;
	    			break;
	    			case "exportButt2":
	    				var conF = confirm('Do you want to export files?');
	    					if(!conF)
	    					return true;
	    						var ladvance = confirm('Do you want to export both Completed/Non-Completed?\n [YES] - Both Completed/Non-Completed \n [NO] - Base on Selected Option \n [x] - Close');
						    	// $.get(crudService + "directCall/export_tfab_mat_spl_ref",{fieldS: fieldSort,fieldF: "",dir: dirSort,rswork: $('input[name=option2]:checked').index('input[name=option2]'),ladvance: ladvance},
					       	    // function(data){
// 									
									// showNotif("warning",data,"warning");
					       	    // });
						    	open_preloader();
						    	var link = document.createElement('a');
					        	link.href = crudService + "directCall/export_tfab_mat_spl_ref/?";
					        	link.href += ("fieldS=" + fieldSort + "&");
					        	link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF="));
					        	link.href += ("&dir=" + dirSort);
					        	link.href += ("&rswork=" + $('input[name=option2]:checked').index('input[name=option2]') + "&ladvance=" + ladvance);
					        	
					        	
						        //Dispatching click event.
						        if (document.createEvent) {
						            var e = document.createEvent('MouseEvents');
						            e.initEvent('click' ,true ,true);
						            link.dispatchEvent(e);
							    	close_preloader();
						            return true;
						        }
                	break;
                	case "exportButt":
					    var conF = confirm('Do you want to export files?');
	    					 if(!conF)
	    					 return true;
						     var aname = priorArealoc_di.aname;
			  			     var pno = priorSetup_di.pno;
			  			     var priority = priorArealoc_di.pno;
			   			     var rswork = $('input[name=option]:checked').index('input[name=option]');
			  			     var tbAdvance = ($("#chk1").is(":checked") ? 1 : 0);
					  	 		 
				  			 var conF = confirm('Do you want to export files?');
    						 if(!conF)
    						 return true;
    						 var ladvance = confirm('Do you want to export both Completed/Non-Completed?\n [YES] - Both Completed/Non-Completed \n [NO] - Base on Selected Option \n [x] - Close');
						    	
						    	
						    	var link = document.createElement('a');
					        	link.href = crudService + "directCall/export_tfabSplwise/?";
					        	link.href += ("fieldS=" + fieldSort + "&");
					        	link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
					        	link.href += ("dir=" + dirSort + "&aname=" + aname);
					        	link.href += ("&pno=" + pno + "&tbAdvance=" + tbAdvance);
					        	link.href += ("&rswork=" + rswork + "&ladvance=" + ladvance);
					        	
					        	
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