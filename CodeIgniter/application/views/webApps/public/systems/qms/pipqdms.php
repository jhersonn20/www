<div id="uplWindow">
	
	<ul>
		<li><label class="title" for="plant_no">Plant No.:</label><input name="plant_no" disabled="true" class="k-input k-textbox" style="text-align: left;width: 100px;"
                        id="plant_no" data-bind="value:plant_no" /> <!-- required validationMessage="Please Enter Plant No"  -->
			<label class="title short" style="width: 69px !important;" for="area_no">Area No.:</label><input name="area_no" disabled="true" class="k-input k-textbox" style="text-align: left;width: 100px;"
                        id="area_no" data-bind="value:area_no" /></li> <!-- required validationMessage="Please Enter Area No"  -->
		<li><label class="title" for="drawing_no">Drawing No.:</label><input name="drawing_no" disabled="true" class="k-input k-textbox" style="text-align: left;width: 277px;"
                        id="drawing_no" data-bind="value:drawing_no" /></li> <!-- required validationMessage="Please Enter Drawing No"  -->
		<li><label class="title" for="sheet_no">Sheet No.:</label><input name="sheet_no" disabled="true" class="k-input k-textbox" style="text-align: left;width: 100px;"
                        id="sheet_no" data-bind="value:sheet_no" /> <!-- required validationMessage="Please Enter Sheet No" --> 
			<label class="title short" style="width: 69px !important;" for="rev_no">Rev. No.:</label><input name="rev_no" disabled="true" class="k-input k-textbox" style="text-align: left;width: 100px;"
                        id="rev_no" data-bind="value:rev_no" /></li> <!-- required validationMessage="Please Enter Revision No" --> 
		<li><label class="title" for="subarea_no">Sub-Area No.:</label><input name="subarea_no" disabled="true" class="k-input k-textbox" style="text-align: left;width: 100px;"
                        id="subarea_no" data-bind="value:subarea_no" /> <!-- required validationMessage="Please Enter Sub-Area No"  -->
			<label class="title short" style="width: 69px !important;" for="pid">P & ID:</label><input name="pid" disabled="true" class="k-input k-textbox" style="text-align: left;width: 100px;"
                        id="pid" data-bind="value:pid" /></li> <!--required validationMessage="Please Enter Property ID" -->
		<li><label class="title" for="line_no">Line No.:</label><input name="line_no" disabled="true" class="k-input k-textbox" style="text-align: left;width: 277px;"
                        id="line_no" data-bind="value:line_no" /></li> <!--required validationMessage="Please Enter Line No" -->
		<li><label class="title" for="document">Document:</label><input name="document" disabled="true" class="k-input k-textbox" style="text-align: left;width: 277px;"
                        id="document" data-bind="value:document" /></li> <!--required validationMessage="Please Enter Document" -->
		<li><label class="title" for="line_size">Line Size:</label><input name="line_size" disabled="true" style="text-align: left;width: 100px;"
                        id="line_size" data-bind="value:line_size" data-role="numerictextbox" /> <!--required validationMessage="Please Enter Line Size" -->
			<label class="title short" for="lineclass">Line Class:</label><input name="lineclass" disabled="true" class="k-input k-textbox" style="text-align: left;width: 100px;"
                        id="lineclass" data-bind="value:lineclass" /></li> <!--required validationMessage="Please Enter Line Class" -->
		<li><label class="title" for="painting">Painting:</label><input name="painting" disabled="true" class="k-input k-textbox" style="text-align: left;width: 277px;"
                        id="painting" data-bind="value:painting" /></li> <!--required validationMessage="Please Enter Painting" -->
		<li><label class="title" for="insulation">Insulation:</label><input name="insulation" disabled="true" class="k-input k-textbox" style="text-align: left;width: 277px;"
                        id="insulation" data-bind="value:insulation" /></li> <!--required validationMessage="Please Enter Insulation" -->
		<li><label class="title" for="insulation_thickness">Insulation Thick.:</label><input name="insulation_thickness" disabled="true" class="k-input k-textbox" style="text-align: left;width: 277px;"
                        id="insulation_thickness" data-bind="value:insulation_thickness" /></li> <!--required validationMessage="Please Enter Insulation Thickness" -->
		<li><label class="title" for="transmittal">Transmittal:</label><input name="transmittal" disabled="true" class="k-input k-textbox" style="text-align: left;width: 277px;"
                        id="transmittal" data-bind="value:transmittal" /></li> <!--required validationMessage="Please Enter Transmittal" -->
		<li><label class="title" for="matl">Material:</label><input name="matl" disabled="true" class="k-input k-textbox" style="text-align: left;width: 100px;"
                        id="matl" data-bind="value:matl" /> <!--required validationMessage="Please Enter Material" -->
			<label class="title short" style="width: 69px !important;" for="lbsb">LB/SB:</label>
			<input name="lbsb" class="k-input k-textbox" style="text-align: left;width: 100px;" id="lbsb" data-bind="value:lbsb" /> 
	</ul>
</div>



<div id="main-wrapper">
	
	<div class="wrap-form demo-section apply8" style="width: 100%;display: block; margin-bottom: 20px; min-height: 390px;">
			<div id="isoDwg_grid"></div>
	</div>
	<div class="wrap-button demo-section" style="width: 100%;">
		<div class="buttonLeft">
        	<button class="k-button mainEve" id="">View Attachment</button>
        	<button class="k-button mainEve" id="isoView">View</button>
       	</div>				
	</div>
	<div class="wrap-form demo-section apply8" style="width: 100%;display: block; margin-bottom: 20px; min-height: 300px;">
			<div id="priorSetup_grid"></div>
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
		$(plant_no).val(dataItem.plant_no);	
		$(area_no).val(dataItem.area_no);
		$(sheet_no).val(dataItem.sheet_no);
		$(rev_no).val(dataItem.rev_no);
		$(drawing_no).val(dataItem.drawing_no);
		$(subarea_no).val(dataItem.subarea_no);
		$(pid).val(dataItem.pid);
		$(line_no).val(dataItem.line_no);
		$(document).val(dataItem.document);
		$(line_size).val(dataItem.line_size);
		$(lineclass).val(dataItem.lineclass);
		$(painting).val(dataItem.painting);
		$(insulation).val(dataItem.insulation);
		$(insulation_thinkness).val(dataItem.insulation_thinkness);
		$(transmittal).val(dataItem.transmittal);
		$(matl).val(dataItem.matl);
		$(lbsb).val(dataItem.lbsb);
		
		
		
				// {field: "area_no",title: "Area No.",width: 100},
               // {field: "drawing_no",title: "Drawing No",width: 140},
               // {field: "sheet_no",title: "Sheet No.",width: 180},
               // {field: "rev_no",title: "Rev No",width: 161},
               // {field: "stat",title: "Status",width: 100},
               // {field: "line_size",title: "Line Size", width: 100},
               // {field: "line_no",title: " Line No", width: 204},
               // {field: "lineclass",title: "Line Class", width: 100},
               // {field: "matl",title: "MATL", width: 120},
               // {field: "fluid_code",title: "Fluid Code", width: 120},
               // {field: "insulation",title: "Insulation", width: 100},
               // {field: "insulation_thinkness",title: "Insulation Thickness", width: 120},
               // {field: "lbsb",title: "Bore Type", width: 120},
               // {field: "painting",title: "Painting", width: 100},
               // {field: "pid",title: "PID", width: 120},
               // {field: "transmittal",title: "Transmittal", width: 120},
               // {field: "remarks",title: "Remarks", width: 100},
               // {field: "document",title: "Document", width: 100},
               // {field: "subarea_no",title: " Subarea No", width: 100},
               // {field: "plant_no",title: "Plant No", width: 100},
               // {field: "loguser",title: "Log User", width: 120},
               // {field: "logdate",title: "Log Date", width: 120},
               // {field: "logupdate",title: "Log Update", width: 183
		
				
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
                    url: crudService + "directCall/piping_iso",
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
					    value: (($(data.filter).length > 0) ? filterVArr_isoDwg : ""),
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
                        spool_no: { type: "string" },
                        area_loc: { type: "string" },
                        drawing_no: { type: "string" },
                        sheet_no: { type: "string" },
                        rev_no: { type: "string" },
                        lbsb: { type: "string" },
                        matl: { type: "string" },
                        piping_class: { type: "string" },
                        priority_timing: { type: "string" },
                        priority_code: { type: "string" },
                        tot_lm: { type: "string" }
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
            	$("#txt2").val($(e.items).length);
            	$("#txt3").val(e.items[0]['iTotSpool']);
            	$("#txt4").val(totSWDia);
            	$("#txt5").val(spoolDia);
            	
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
               
               {field: "area_no",title: "Area No.",width: 100},
               {field: "drawing_no",title: "Drawing No",width: 140},
               {field: "sheet_no",title: "Sheet No.",width: 180},
               {field: "rev_no",title: "Rev No",width: 161},
               {field: "stat",title: "Status",width: 100},
               {field: "line_size",title: "Line Size", width: 100},
               {field: "line_no",title: " Line No", width: 204},
               {field: "lineclass",title: "Line Class", width: 100},
               {field: "matl",title: "MATL", width: 120},
               {field: "fluid_code",title: "Fluid Code", width: 120},
               {field: "insulation",title: "Insulation", width: 100},
               {field: "insulation_thinkness",title: "Insulation Thickness", width: 120},
               {field: "lbsb",title: "Bore Type", width: 120},
               {field: "Painting",title: "Painting", width: 100},
               {field: "pid",title: "PID", width: 120},
               {field: "transmittal",title: "Transmittal", width: 120},
               {field: "remarks",title: "Remarks", width: 100},
               {field: "document",title: "Document", width: 100},
               {field: "subarea_no",title: " Subarea No", width: 100},
               {field: "plant_no",title: "Plant No", width: 100},
               {field: "loguser",title: "Log User", width: 120},
               {field: "logdate",title: "Log Date", width: 120},
               {field: "logupdate",title: "Log Update", width: 183}
               
                      
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        isoDwg_di = this.dataItem(selectedRows[i]);
			        
			        priorSetup_ds.read();
			        // splLst_ds.read();
			        // jointLst_ds.read();
			        // erecmat_ds.read();
			        // pipeLst_ds.read();

			    }
			    grid_change(currRow, "#isoDwg_grid" );
           },
           dataBound: addExtraStylingToGrid1
        });
        insertGridTitle('#isoDwg_grid','ISO/Drawing');  
		
			// -- PROGRAMMING CODE/PRIOR_SETUP DATASOURSE -- //
				
        var priorSetup_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/d_isoRef",
                    contentType: "application/json",
                    type: "GET",
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
					    fieldS: ($(data.sort).length ? data.sort[0].field : "area_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_priorSetup : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_priorSetup : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"), 
					    area_no: isoDwg_di.area_no,
					    drawing_no: isoDwg_di.drawing_no,
					    sheet_no: isoDwg_di.sheet_no,
					    rev_no: isoDwg_di.rev_no,
					    plant_no: isoDwg_di.plant_no
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
                        plant_no: { type: "string" },
                        area_no: { type: "string" },
                        rev_no: { type: "string" }
                        
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
            columns: [ //display on grid
               {field: "area_no",title: "Spool No",width: 100},
               {field: "drawing_no",title: "Spool type",width: 100},
               {field: "rev_no",title: "Bore type",width: 100},
               {field: "issued_date",title: "Spool Cont",width: 100},
               {field: "arccref_date",title: "Spool ID",width: 100},
               {field: "index_no",title: "Material Issued Date",width: 100},
               {field: "doc_no",title: "Workable Percentage",width: 100},
               {field: "doc_status",title: "Workable PCT",width: 100}
               
              
           ],
           change: function(e){
           		currRow2 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        priorSetup_di = this.dataItem(selectedRows[i]);
			        
			       
					
			    }
           },
           dataBound: addExtraStylingToGrid2
        });
        insertGridTitle('#priorSetup_grid','Document Control System');  
        
      // -- Event Handler -- //
                 
	  var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");
	    $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
	    $("input[name=option]").change(function(){
	    	//alert($('input[name=option]:checked').index('input[name=option]'));
						isoDwg_ds.read();
	    }); 
	    
	   $("#uplWindow").kendoWindow({ 
            width: "868px",
            height: "auto",
            title: "View ISO",
            modal: true,
            visible: false,
            resizable: false,
            scrollable: true,
            open: function(){
            	console.log(this);
            }
        });
	        	
	   
	    $(".wrap-button .buttonLeft button  ").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "isoView":
	    				$("#uplWindow").data("kendoWindow").center().open();
	    				
	    			break
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