<div id="main-wrapper">
	<div class="wrap-button demo-section" style="width: 100%;min-height: 50px;">
		<fieldset>
		<legend>Filter Option </legend>
			<input type="radio" name="option" checked id="rad1"  /><label class="title short" for="rad1">ALL</label>
        	<input type="radio" name="option" id="rad2" /><label class="title short" for="rad2">Drawing</label>
        	<input type="radio" name="option" id="rad3" /><label class="title short" for="rad3">Piece Mark</label>
        </fieldset>
	</div>
	<div class="wrap-form demo-section apply8" style="width: 100%;display: block; margin-bottom: 20px; min-height: 600px;">
			<div id="isoDwg_grid"></div>
	</div>
	<div class="wrap-button demo-section" style="width: 100%;">
		<div class="buttonLeft">
			<button class="k-button mainEve" id="exportButt">Export</button>
		</div>
        	
       			
	</div>
	<div class="wrap-form demo-section apply8" style="width: 100%;display: block; margin-bottom: 20px; min-height: 300px;">
			<div id="priorSetup_grid"></div>
	</div>
	
	<div class="wrap-button demo-section" style="width: 100%;">
			Total ISO:</label><input type="text" name="txt2" id="txt2" class="k-textbox" style="width: 10%;" />
        	Total PC mark:</label><input type="text" name="txt3" id="txt3" class="k-textbox" style="width: 12%;" />
        	Length:</label><input type="text" name="txt4" id="txt4" class="k-textbox" style="width: 12%;" />
        	Length:</label><input type="text" name="txt5" id="txt5" class="k-textbox" style="width: 12%;" />
        	Weight Per ISO:</label><input type="text" name="txt6" id="txt6" class="k-textbox" style="width: 12%;" />		
	</div>
	<div class="wrap-button demo-section" style="width: 100%;">
		<div class="buttonRight">
        	<button class="k-button mainEve" id="closeButt">Close</button>
        	
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
			
			$("#txt6").val(dataItem.weight);
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
                    url: crudService + "directCall/p_iso_struc",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_isoDwg[index] = ("t2." + this.field) + ";" + valForm + ";" + this.operator;
				      		filterOArr_isoDwg[index] = this.operator;
				      		filterVArr_isoDwg[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "area_no");
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_isoDwg,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "area_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_isoDwg : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_isoDwg : priorArealoc_di.aname),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    rsOption: $('input[name=option]:checked').index('input[name=option]')
					    
					    
			        }
			      }else
			      	  return data;
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
                        supp_code: { type: "string" },
                        area_no: { type: "string" },
                        area_loc: { type: "string" },
                        drawing_no: { type: "string" },
                        sheet_no: { type: "string" },
                        rev_no: { type: "string" },
                        workable_pct: { type: "string" }
                       
                    }
                },
                total: function(response) {
				   	return (($(response.rows[0]).length > 0) ? response.rows[0].total : 0); //$(response.rows).length;				   	
			    }
            },
            change: function(e) {
            	if ($(e.items).length == 0)
            		return true;
            		
           		var totSWDia = 0;
            	$(e.items).each(function(index,value){
            		totSWDia += parseFloat(value['sw_diainch']);
            		spoolDia =  parseFloat(value['sw_diainch']+(e.items[0]['iTotSpool']))
            	});
            	
            	$("#txt2").val(e.items[0]['totiso']);
            	$("#txt3").val($(e.items).length);
            	$("#txt4").val(e.items[0]['totLength']);
            	$("#txt5").val(e.items[0]['totWeight']);
            	
            	//$("#txt5").val(spoolDia);
            	
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
               
               {field: "supp_code",title: "Supplier Code",width: 130},
               {field: "area_no",title: "Area No",width: 140},
               {field: "area_loc",title: "Area Location.",width: 180},
               {field: "drawing_no",title: "Drawing No",width: 161},
               {field: "sheet_no",title: "Sheet No",width: 161},
               {field: "rev_no",title: "Rev No",width: 100},
               {field: "workable_pct",title: "Workable Percent", width: 150}
                      
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        isoDwg_di = this.dataItem(selectedRows[i]);
			        priorSetup_ds.read();
			        //mat_takeoff_perspool_ds.read();
			        // splLst_ds.read();
			        // jointLst_ds.read();
			        // erecmat_ds.read();
			        // pipeLst_ds.read();

			    }grid_change(currRow, "#isoDwg_grid");
           },
           dataBound: addExtraStylingToGrid1
        });
        insertGridTitle('#isoDwg_grid','ISO/Drawing');  
		
				// -- PROGRAMMING CODE/PRIOR_SETUP DATASOURSE -- //
				
        var priorSetup_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/p_piece_struc",
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
					    fieldS: ($(data.sort).length ? data.sort[0].field : "piece_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_splLst : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_splLst : "piece_no"),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    plant_no: isoDwg_di.plant_no,
					    area_no: isoDwg_di.area_no,
					    area_loc: isoDwg_di.area_loc,
					    drawing_no: isoDwg_di.drawing_no,
					    sheet_no: isoDwg_di.sheet_no,
					    rev_no: isoDwg_di.rev_no,
					    
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 7,
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
                        piece_no: { type: "string" },
                        piece_desc: { type: "string" },
                        location: { type: "string" },
                        qty: { type: "string" },
                        length: { type: "string" },
                        weight: { type: "string" },
                        um: { type: "string" },
                        workable_pct: { type: "string" },
                        received_dt: { type: "string" },
                        issued_dt: { type: "string" },
                        assembly_dt: { type: "string" },
                        erection_dt: { type: "string" }
                       
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
               {field: "piece_no",title: "Piece No",width: 100},
               {field: "piece_desc",title: "Piece Desc",width: 100},
               {field: "location",title: "Location",width: 100},
               {field: "qty",title: "Quantity",width: 100},
               {field: "length",title: "Length",width: 100},
               {field: "weight",title: "Weight",width: 100},
               {field: "um",title: "UM",width: 100},
               {field: "workable_pct",title: "Workable PCT",width: 120},
               {field: "received_dt",title: "Received Date",width: 120},
               {field: "issued_dt",title: "Issued Date",width: 120},
               {field: "assembly_dt",title: "Assembly Date",width: 120},
               {field: "erection_dt",title: "Erection Date",width: 120}
           ],
           change: function(e){
           		currRow2 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        priorSetup_di = this.dataItem(selectedRows[i]);
			        grid_change(this,"priorSetup_grid"); //display of data into fields
			        
					
			    }
           },
           dataBound: addExtraStylingToGrid2
        });
        insertGridTitle('#priorSetup_grid','Spool');  
        
                   // -- MAT_TAKEOFF_SPOOL DATASOURCE -- //

        var mat_takeoff_perspool_ds = new kendo.data.DataSource({
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
					    fieldS: ($(data.sort).length ? data.sort[0].field : "erection_start"),
					    operator: (($(data.filter).length > 0) ? filterOArr_splmat : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_splmat : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    plant_no: isoDwg_di.plant_no,
					    area_no: isoDwg_di.area_no,
					    drawing_no: isoDwg_di.drawing_no,
					    sheet_no: isoDwg_di.sheet_no,
					    rev_no: isoDwg_di.rev_no,
					    spool_no: isoDwg_di.spool_no
					    
					    
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
                        spool_no: { type: "string" },
                        isc_no: { type: "string" },
                        item_code: { type: "string" },
                        size_: { type: "string" },
                        qty: { type: "string" },
                        description : { type: "string" }
                        
                       
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
			$("#splmat_rs").data("kendoGrid").select("tr:eq(" + (  isoDwg_ds._data.length + priorSetup_ds._data.length + 3) + ")");
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
               {field: "erection_start",title: "Erection Start",width: 120},
               {field: "issddt",title: "Issued Date",width: 102},
               {field: "fog_submitted_dt",title: "Requisitioner Date",width: 153},
               {field: "reqd_dt",title: "Required Date",width: 131},
               {field: "client_submitted_dt",title: "Client Submitted",width: 129},
               {field: "item_code",title: "Item Code",width: 86},
               {field: "spool_no",title: "Spool No",width: 80},
               {field: "commodity_code",title: "Commodity Code",width: 125},
               {field: "size_",title: "Size",width: 72},
               {field: "qty",title: "Quantity",width: 86},
               {field: "mrr_qty",title: "MRR Quantity",width: 106},
               {field: "category",title: "Category",width: 115},
               {field: "length",title: "Length",width: 80},
               {field: "lineclass",title: "Line Class",width: 80},
               {field: "testpack_no",title: "Testpack No",width: 128}
                    
           ],
           change: function(e){
           		currRow5 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        splmat_di = this.dataItem(selectedRows[i]);
			        //$("#txt1").val.dataItem(selectedRows[description])
			    }
				grid_change(currRow5, "#splmat_rs" );
           },
           dataBound: addExtraStylingToGrid5
        });
        insertGridTitle('#splmat_rs','Material Takeoff'); 
        
       
      // -- Event Handler -- //
            
	  var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");
	     $("input[name=option]").change(function(){
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
	    				var conF = confirm('Do you want to export files?');
	    					if(!conF)
	    					return true;
	    						var rsOption = $('input[name=option]:checked').index('input[name=option]')
						    	open_preloader();
						    	var link = document.createElement('a');
					        	link.href = crudService + "directCall/export_p_iso_struc/?";
					        	link.href += ("fieldS=" + fieldSort + "&");
					        	link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
					        	link.href += ("dir=" + dirSort + "&rsOption=" + rsOption);
					        	// link.href += ("&tbAdvance=" + ($("#chk1").is(":checked") ? "1" : "0") );
					        	// link.href += ("&cbper1=" + percentF.value() + "&cbper2=" + percentT.value());
					        	// link.href += ("&aname=" + priorSetup_di.aname + "&cArealoc=" + priorSetup_di.aname + "&pno=" + priorSetup_di.pno.substr(0,2) );
					        	// // link.href += ("&drawing_no=" + isoDwg_di.drawing_no + "&ps_code=" + isoDwg_di.ps_code + "&item_code=" + isoDwg_di.com_code );
					        	// link.href += ("&addSpl=" + addSpl);
					        	
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