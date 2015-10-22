<div id="main-wrapper">
	<div style="margin-bottom: 5px;float:right; width: 72%">
		<div class="wrap-button demo-section" style="width: 100%;">
			<input type="checkbox" name="chk1" id="chk1"><label class="title short" for="chk1">Advance</label>
			<input type="radio" name="option" checked id="rad1"  /><label class="title short" for="rad1">Workable</label>
        	<input type="radio" name="option" id="rad2" /><label class="title short" for="rad2">Non-Workable</label>
			<div style="float: right;">
				<label>Percent From:</label><input type="text" name="txt1" id="txt1" style="width: 100px; margin-left: 0;" />
				<label>Percent To:</label><input type="text" name="txt2" id="txt2" style="width: 100px; margin-left: 0;" />
			</div>
		</div>
		<div class="wrap-form demo-section apply8" style="width: 100%;display: block; margin-bottom: 20px; min-height: 457px;">
			<div id="isoDwg_grid"></div>
		</div>
	</div>
	<div class="wrap-grid demo-section" style=" width: 25%;margin-left: 0; min-height: 482px;">
        <div id="priorSetup_grid" style="width: 100%;margin-bottom: 2px;"></div> 
        <div id="priorArealoc_grid" style="width: 100%"></div>
   	</div>
   	<div class="wrap-form demo-section apply8" style="width: 100%;display: block; margin-bottom: 20px; min-height: 250px;"> 
			<div id="splmat_rs"></div>
	</div>
   	<div class="wrap-grid demo-section" style="min-height: 250px;width: 100%;margin-right: 0px; ">
   		<div id="jointLst_grid" style="width: 48%;margin-bottom: 2px;float: right;"></div>
   		<div style="margin-bottom: 2px; margin-right: 0px;width: 100%">
		<div style="position: relative;left: 18px;right: 50px;top: 7px;;1px;margin-right: 0px;"><h3>Supplier Description</h3></div>
		<div style="position: relative;right: -195px;top: -8px;border: 0px;margin-right: 0px;"><h3>Pipe Support MATL</h3></div>
		<div style="position: relative;right: -356px;top: -22px;border: 1px;margin-right: 0px;"><h3>Pipe Support Category</h3></div>
		<textarea name="textarea" id="textarea2" cols="20" rows="13" disabled style="resize: none;margin: 0; height: 20%;"></textarea>
		<textarea name="textarea" id="textarea3" cols="20" rows="13" disabled style="resize: none;margin: 0; height: 20%;"></textarea>
		<textarea name="textarea" id="textarea4" cols="20" rows="13" disabled style="resize: none;margin: 0; height: 20%;"></textarea>			
   		</div>
   	</div>
	<div class="wrap-button demo-section" style="width: 100%;">
		<div class="buttonLeft" style="width: 100%;">
        	<button class="k-button mainEve" id="exportButt">Export</button>
        	<input type="checkbox" name="chk2" id="chk2"><label class="title short" for="chk2" style="">w/ SPL</label>
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
			//$("#textarea").val(dataItem.mat_desc);
			 $("#textarea2").val(dataItem.supp_desc);
			 $("#textarea3").val(dataItem.ps_matl);
			 $("#textarea4").val(dataItem.category);
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
		    filterFArr_pipeLst = [], filterOArr_pipeLst = [], filterVArr_pipeLst = [], currRow8 = "", pipeLst_di = '', percent_ds = [],percent_ds2 = [],
		    isFailed = false, fieldSort = "", dirSort = "", query = "", dataItem3 ='', percentF = '', percentT = '';
		    
		  
		    
		    for (var i=1; i <=101; i++) {
		     percent_ds[i-1] = {"percent_desc" : i-1 ,"percent" : i-1};
			};
			
		    for (var x=1; x <=101; x++) {
		      percent_ds2[x-1] = {"percent_desc" : 101-x ,"percent" : 101-x};
			};
		   	 
			  percentF = $("#txt1").kendoDropDownList({
	        	enable: false,
	            filter: "contains",
	            dataTextField: "percent_desc",
	            dataValueField: "percent",
	            dataSource: percent_ds,
	            change: function(e){
				isoDwg_ds.read();
				
		    
       		    }
	          }).data("kendoDropDownList");
	         
	           percentT = $("#txt2").kendoDropDownList({
	        	enable: false,
	            filter: "contains",
	            dataTextField: "percent_desc",
	            dataValueField: "percent",
	            dataSource: percent_ds2,
	            change: function(e){
	            isoDwg_ds.read();
		      
		    
       		    }
	          }).data("kendoDropDownList");  
	          
	        
		    
		   
		
		$(".wrap-button button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();
		});
		
		// -- ISO/DWG DATASOURCE -- //
        
        
        var isoDwg_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/proc_ps_mto_hdr",
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
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "area_desc");
				    
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_isoDwg,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "ps_code"),
					    operator: (($(data.filter).length > 0) ? filterOArr_isoDwg : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_isoDwg : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    aname: priorArealoc_di.aname,
					    priority: priorArealoc_di.pno,
					    pno: priorArealoc_di.pno,
					    rswork: $('input[name=option]:checked').index('input[name=option]'),
					    tbAdvance: $("#chk1").is(":checked") ? 1 : 0,
					    cbper1 : percentF.value(),
					    cbper2 : percentT.value(),
					    detail : 0
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
                        percent_workable: { type: "float" },
                        ref_rec_date: { type: "string" },
                        ref_iss_date: { type: "string" },
                        drawing_no: { type: "string" },
                        ps_code: { type: "string" },
                        ps_type: { type: "string" },
                        mat_tag: { type: "string" },
                        plant_no: { type: "string" },
                        area_no: { type: "string" },
                        area_desc: { type: "string" },
                        sheet_no: { type: "string" },
                        spool_no: { type: "string" },
                        lbsb: { type: "string" },
                        matl_type: { type: "string" },
                        piping_class: { type: "string" },
                        p_timing: { type: "string" },
                        p_no: { type: "string" },
                        paint_reqd: { type: "string" },
                        
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
               {field: "percent_workable",title: "MATL %",width: 140},
               {field: "ref_rec_date",title: "Whse Rec",width: 100},
               {field: "ref_iss_date",title: "Whse Iss",width: 140},
               {field: "drawing_no",title: "Drawing No",width: 150},
               {field: "ps_code",title: "PS Code",width: 140},
               {field: "ps_type",title: "PS Type.",width: 100},
               {field: "mat_tag",title: "Mat Type.",width: 100},
               {field: "plant_no",title: "Drawing No",width: 161},
               {field: "area_no",title: "Sheet No",width: 100},
               {field: "area_desc",title: "Description", width: 150},
               {field: "sheet_no",title: "Sheet No", width: 100},
               {field: "spool_no",title: "Spool No", width: 100},
               {field: "lbsb",title: "lbsb", width: 100},
               {field: "matl_type",title: "Mat Type", width: 100},
			   {field: "piping_class",title: "Piping Class", width: 100},
               {field: "p_timing",title: "Priority Timing", width: 120},
               {field: "p_no",title: "Priority Code", width: 110},
               {field: "paint_reqd",title: "Paint REQD", width: 100}
	
                      
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        isoDwg_di = this.dataItem(selectedRows[i]);
			        mat_takeoff_perspool_ds.read();
			        
			        //splLst_ds.read();
			        
			       // erecmat_ds.read();
			        //pipeLst_ds.read();
			    }
           },
           dataBound: addExtraStylingToGrid1
        });
        insertGridTitle('#isoDwg_grid','Pipe Support / ISO');  
		
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
                    url: crudService + "directCall/ps_mto_Ref",
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
					    fieldS: ($(data.sort).length ? data.sort[0].field : "ps_code"),
					    operator: (($(data.filter).length > 0) ? filterOArr_splmat : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_splmat : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    drawing_no: isoDwg_di.drawing_no,
					    ps_code: isoDwg_di.ps_code,
					    ps_type: isoDwg_di.ps_type
					    
					    
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
                        mat_tag: { type: "string" },
                        com_code: { type: "string" },
                        ps_class: { type: "string" },
                        ps_specs: { type: "string" },
                        wt_fab: { type: "float" },
                        ref_rec_qty : { type: "float" },
                        ref_rec_result : { type: "float" },
                        BALANCE_EXCESS : { type: "string" }
                       
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
			$("#splmat_rs").data("kendoGrid").select("tr:eq(" + (  (isoDwg_ds._data.length + priorSetup_ds._data.length + priorArealoc_ds._data.length + 4)) + ")");
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
               {field: "mat_tag",title: "Mat Tag",width: 120},
               {field: "com_code",title: "Item NO",width: 102},
               {field: "ps_class",title: "PS Class",width: 153},
               {field: "ps_specs",title: "PS Specs",width: 131},
               {field: "wt_fab",title: "MTO QTY",width: 129},
               {field: "ref_rec_qty",title: "Already Received",width: 131},
                {field: "ref_rec_result",title: "Quantity",width: 131},
               {field: "BALANCE_EXCESS",title: "BALANCE/EXCESS",width: 128}
                    
           ],
           change: function(e){
           		currRow5 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        splmat_di = this.dataItem(selectedRows[i]);
			        jointLst_ds.read();
			        //$("#txt1").val.dataItem(selectedRows[description])
			    }
				grid_change(currRow5, "#splmat_rs" );
           },
           dataBound: addExtraStylingToGrid4
        });
        insertGridTitle('#splmat_rs','Pipe Support Material Details'); 
        
         // -- TREQISS_DTL DATASOURCE -- //
        		
        var jointLst_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/treqissDtl_stock4",
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
					    disc_code: "PS",
					    drawing_no: isoDwg_di.drawing_no,
					    stock_no: splmat_di.com_code,
					    item_code : splmat_di.com_code,
					    commodity_code : splmat_di.com_code,
					    isc: splmat_di.mat_tag
					    //size: jointLst_di.size,
					    //spool_no: jointLst_di.spool_no
					    
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
			$("#jointLst_grid").data("kendoGrid").select("tr:eq(" + (priorSetup_ds._pageSize + priorArealoc_ds._pageSize + isoDwg_ds._data.length +  mat_takeoff_perspool_ds.length +  5) + ")");
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
               {field: "jmif_no",title: "JMIF No",width: 80},
               {field: "rev_no",title: "REV",width: 120},
               {field: "req_qty",title: "REQ QTY",width: 85},
               {field: "iss_qty",title: "ISS QTY",width: 85},
               {field: "isc_no",title: "PT No",width: 85},
               {field: "dlmr_jwrr",title: "AUTO JWRR",width: 85},
         
                    
           ],
           change: function(e){
           		currRow7 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        jointLst_di = this.dataItem(selectedRows[i]);
			        
			    }
           },
           dataBound: addExtraStylingToGrid7
        });
        insertGridTitle('#jointLst_grid','JMIF Reference (MATL DTL)');      

      // -- Event Handler -- //
            
	  var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");
	     $("input[name=option]").change(function(){
	     	if($("#rad1").prop("checked")){
	     		percentF.enable(false);
	    		percentT.enable(false);
	    		percentF.value('0');
	    		percentT.value('100');
	    		isoDwg_ds.read();
	     	}else {
	     		percentF.enable(true);
	    		percentT.enable(true);
	    		isoDwg_ds.read();

	    		
	     	}									
	    });   
	    
	    $("#chk1").change(function(){
	     	isoDwg_ds.read();
				    
	     });
	     
	    $(".wrap-form input, .wrap-form textarea, .wrap-form button, .kendoComboBox ").prop("disabled", true).addClass("k-state-disabled");
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
	    			// $.get(crudService + "directCall/export_qmsqpwpsw",{fieldS: fieldSort,fieldF: "",dir: dirSort,aname: priorSetup_di.aname,pno: priorSetup_di.pno,cArealoc:priorSetup_di.aname,
	    						// tbAdvance:($("#chk1").is(":checked") ? "1" : "0"),rswork: ($('input[name=option]:checked').index('input[name=option]')),ladvance:ladvance,cbper1:percentF.value(),cbper2:percentT.value(),addSpl:addSpl},
					       	    // function(data){
// 									
									// showNotif("warning",data,"warning");
					       	    // });
	    				   var conF = confirm('Do you want to export files?');
	    					if(!conF)
	    					return true;
	    						var ladvance = confirm('Do you want to export both Workable/Non Workable?');
						    	open_preloader();
						    	var link = document.createElement('a');
					        	link.href = crudService + "directCall/export_qmsqpwpsw/?";
					        	link.href += ("fieldS=" + fieldSort + "&");
					        	link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
					        	link.href += ("dir=" + dirSort + "&ladvance=" + ladvance);
					        	link.href += ("&tbAdvance=" + ($("#chk1").is(":checked") ? "1" : "0") + "&rswork=" + $('input[name=option]:checked').index('input[name=option]'));
					        	link.href += ("&cbper1=" + percentF.value() + "&cbper2=" + percentT.value());
					        	link.href += ("&aname=" +  priorArealoc_di.aname +  "&pno=" + priorSetup_di.pno + "&detail=" + ($("#chk2").is(":checked") ? "1" : "0"));
					        	
						        //Dispatching click event.
						        if (document.createEvent) {
						            var e = document.createEvent('MouseEvents');
						            e.initEvent('click' ,true ,true);
						            link.dispatchEvent(e);
							    	close_preloader();
						            return true;
						        }
                	break;
                	case "exportButt2":
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_twhse_matspl/?";
				        link.href += ("fieldS=" + fieldSort + "&");
				        link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
				        link.href += ("dir=" + dirSort);
				 
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
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_twhse_matspl/?";
				        link.href += ("fieldS=" + fieldSort + "&");
				        link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
				        link.href += ("dir=" + dirSort);
				 
				        //Dispatching click event.
				        if (document.createEvent) {
				            var e = document.createEvent('MouseEvents');
				            e.initEvent('click' ,true ,true);
				            link.dispatchEvent(e);
					    	close_preloader();
				            return true;
				        }
                	break;
                	case "exportButt4":
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_twhse_matspl/?";
				        link.href += ("fieldS=" + fieldSort + "&");
				        link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
				        link.href += ("dir=" + dirSort);
				 
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
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_twhse_matspl/?";
				        link.href += ("fieldS=" + fieldSort + "&");
				        link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
				        link.href += ("dir=" + dirSort);
				 
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
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_twhse_matspl/?";
				        link.href += ("fieldS=" + fieldSort + "&");
				        link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
				        link.href += ("dir=" + dirSort);
				 
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