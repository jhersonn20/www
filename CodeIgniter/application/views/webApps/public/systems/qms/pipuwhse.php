<div id="main-wrapper">
	<div class="wrap-header demo-section">
		<fieldset>
			<legend> Filter Option: </legend>
            <span class="k-textbox k-space-right" style="width: 100%;">
                <input type="text" value="" name="search" id="search" />
                <a href="#" class="k-icon k-i-search">&nbsp;</a>
            </span>			
		</fieldset>
	</div>
	<div class="jmif_phase">
		<div id="jmifHead" style="min-height: 260px;margin-bottom: 5px;">
		    <div class="wrap-grid demo-section" style="width: 98.8%;margin-left: 0;height: auto;">
		        <div id="rowSelection"></div>
		    </div>
		</div>
		<div class="wrap-button demo-section">
			<div class="buttonRight">
	        	<button class="k-button mainEve" id="genButt">Generate Workable</button>
	       	</div>
		</div>
	</div>
	<div class="jmifdtl_phase" style="margin-top: 5px;">
		<div id="jmifDtlHead" style="min-height: 290px;margin-bottom: 5px;">
		    <div class="wrap-grid demo-section" style="width: 98.8%;margin-left: 0;height: auto;">
		        <div id="jmifdtl_rs"></div>
		    </div>
		</div>
		<div class="wrap-button demo-section">
			<div class="buttonLeft">
	        	<button class="k-button mainEve k-state-disabled" disabled id="exportButt">Export</button>
	       	</div>
			<div class="buttonRight">
	        	<button class="k-button mainEve" id="closeButt">Close</button>
	       	</div>				
		</div>
	</div>
</div>
<script type="text/javascript">
	var processMatTO = false;
	function grid_change(e,grid){
		// if (!$("#saveButt").hasClass('k-state-disabled') || !$("#saveButt2").hasClass('k-state-disabled'))
			// return true;
		if (typeof e == "undefined")
			e = grid;
		var selectedRows = e.select();
		var selectedDataItems = [];
	    // $("#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
		for (var i = 0; i < selectedRows.length; i++) {
			dataItem3 = e.dataItem(selectedRows[i]);
			// if (grid == "#rowSelection"){							
			    // $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea, .jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea").val("");	
        		// $("#editButt, #delButt").prop("disabled", true).addClass("k-state-disabled");		        
				// if ((dataItem3.finalized == 0 || dataItem3.finalized == null)){	        	
					// $("#editButt, #delButt, #addButt2, #enggButt").prop("disabled", false).removeClass("k-state-disabled");
					// $("#finButt").text("Finalize");
				// }else {
					// $("#editButt, #delButt, #addButt2, #editButt2, #delButt2, #enggButt").prop("disabled", true).addClass("k-state-disabled");
					// $("#finButt").text("Unfinalize");
				// }
				// if (dataItem3.whse_prep == 1 || (dataItem3.finalized == 1 && dataItem3.sub_date_client != null))			        			
        			// $("#finButt, #addButt2, #enggButt").prop("disabled", true).addClass("k-state-disabled");
// 		
				// $("#txt1").val(dataItem3.jmif_no);
				// $("#txt2").data("kendoDatePicker").value(dataItem3.jmif_date);
				// $("#textarea").val(dataItem3.remarks);
				// $("#txt3").val(dataItem3.req_by);
				// $("#txt4").data("kendoDatePicker").value(dataItem3.sub_date_fog);
				// $("#txt5").data("kendoDatePicker").value(dataItem3.date_reqd);
			// }else {		
			    // $(".jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea").val("");
		    // // $("#txt12").data("kendoComboBox").value($.trim(dataItem3.stock_no));
		// // // $("#txt12").val($.trim(dataItem3.stock_no));
		// // // alert(dataItem3.stock_no + " " + $("#txt12").val());
		// // $("#textarea3").val(dataItem3.stock_desc);
		// // $("#txt13").val(dataItem3.item_code);
		// // $("#txt14").val(dataItem3.commodity_code);
		// // $("#txt15").val(dataItem3.uom);
		// // $("#txt16").val(dataItem3.size);
		// // $("#txt17").data("kendoNumericTextBox").value(dataItem3.jmif_qty);
		// // $("#textarea4").val(dataItem3.remarks);
		// // if (dataItem3.spl_type != null){
		// // $("#" + ((dataItem3.spl_type.toLowerCase() == "spool") ? "rad1" : "rad3")).prop("checked", true);
		// // if (dataItem3.spl_type.toLowerCase() != "spool")
		// // $("#" + ((dataItem3.spl_type.toLowerCase() == "em") ? "rad2" : "rad3")).prop("checked", true);
		// // }else
		// // $("#rad3").prop("checked", true);
		// // $("#txt21").val(dataItem3.spl_type);
		  	// }
	    }   
	    // if (!ruserWA)
	    	// $("#enggButt").prop("disabled", true);
	}
	function forDiv(){
		var container = $("#rowSelection");
		var container2 = $("#jmifdtl_rs");
		var position = container.offset();	
		var offsetHeight = container.height();	
		var offsetHeight2 = container2.height();	
		var offsetWidth = container.width();
		var newDiv = $("<div id = 'coverDiv'>").appendTo($("body"));
		newDiv.offset(position);
		newDiv.height((offsetHeight + offsetHeight2) + 87);
		newDiv.width(offsetWidth - 17);
	}
	// function afterSave(grid){
		// $(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
		// $('input[name=option1], input[name=option2], input[name=option3], #search').prop("disabled", false);
		// if (grid == "#rowSelection"){
			// $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea, .jmif_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
			// $("#txt2").data("kendoDatePicker").enable(false);
			// $("#txt4").data("kendoDatePicker").enable(false);
			// $("#txt5").data("kendoDatePicker").enable(false);
		// }else {
			// $(".jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea, .jmifdtl_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
			// $("#txt12").data("kendoComboBox").enable(false);
			// $("#txt13").data("kendoNumericTextBox").enable(false);
			// $("#txt14").data("kendoNumericTextBox").enable(false);
		// }
		// $("#coverDiv").remove();
	// }
	$(document).ready(function(){
		$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
		var crudService = crudServiceBaseUrl + "qms/index/",
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", currRow2 = "", dataItem = '', jmifdtl_di = '', isFailed = false,
		    filterFArr_jmifdtl = [], filterOArr_jmifdtl = [], filterVArr_jmifdtl = [], sentValue_jmifdtl = "", fieldSort = "", dirSort = "", query = "";
			
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/whseGW",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      		filterFArr[] = '';
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr[index] = this.operator;
				      		filterVArr[index] = valForm;
				      	});
				    }
				    if ($.trim(sentValue) != "")
				     	filterFArr[filterFArr.length] = "commodity_code;" + sentValue + ";eq";
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "commodity_code"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : sentValue),
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
            pageSize: 8,
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
                        commodity_code: { type: "string" },
                        size: { type: "string" },
                        itemdesc: { type: "string" },
                        qty: { type: "number" },
                        alloc_qty: { type: "number" },
                        balance: { type: "number" }
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

	    var addExtraStylingToGrid = function(){
			$("#rowSelection").data("kendoGrid").select("tr:eq(1)");
	        $("#rowSelection > .k-grid-content > table > tbody > tr").hover(
	            function(){
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
               {field: "commodity_code",title: "Commodity",width: 154},
               {field: "size",title: "Size", width: 58},
               {field: "itemdesc",title: "Item Desc.", width: 386},
               {field: "qty",title: "Qty.", width: 114,filterable: false},
               {field: "alloc_qty",title: "Allocated Qty.", width: 114,filterable: false},
               {field: "balance",title: "Balance", width: 114,filterable: false}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle('#rowSelection','Material File');                    

        var jmifdtl_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/whseGW_dtl",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_jmifdtl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_jmifdtl[index] = this.operator;
				      		filterVArr_jmifdtl[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_jmifdtl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "drawing_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_jmifdtl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_jmifdtl : sentValue_jmifdtl),
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
            pageSize: 8,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_jmifdtl.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue_jmifdtl = "";
					    filterFArr_jmifdtl = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        plant_no: { type: "string" },
                        area_no: { type: "string" },
                        drawing_no: { type: "string" },
                        sheet_no: { type: "string" },
                        rev_no: { type: "string" },
                        spool_no: { type: "string" },
                        commodity_code: { type: "string" },
                        size: { type: "string" },
                        qty: { type: "number" },
                        alloc_qty: { type: "number" }
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
                                
	    var addExtraStylingToGrid2 = function () {
			$("#jmifdtl_rs").data("kendoGrid").select("tr:eq(" + (dataSource._data.length + 2) + ")");
	        $("#jmifdtl_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_jmifdtl = [];
	    };
        
        var grid2 = $("#jmifdtl_rs").kendoGrid({
            dataSource: jmifdtl_ds,
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
               {field: "plant_no",title: "Plant No.",width: 92, filterable: false},
               {field: "area_no",title: "Area No.", width: 92},
               {field: "drawing_no",title: "Drawing No.", width: 206},
               {field: "sheet_no",title: "Sheet No.", width: 92},
               {field: "rev_no",title: "Rev. No.", width: 92},
               {field: "spool_no",title: "Spool No.", width: 92},
               {field: "commodity_code",title: "Commodity", width: 100},
               {field: "size",title: "Size", width: 58},
               {field: "qty",title: "Quantity", width: 114, filterable: false},
               {field: "alloc_qty",title: "Allocated", width: 114, filterable: false}
           ],
           change: function(e){
           		currRow2 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        jmifdtl_di = this.dataItem(selectedRows[i]);		        
			    }
           },
           dataBound: addExtraStylingToGrid2
        });
	    $(".wrap-button button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "genButt":
	    				open_preloader();
	    				$.post(crudService + "manage/whseGW_proc",{sp: "gen_work", module: "whse", filename: ''},
		    				function(data){
		    					if ($.trim(data) == "1"){
		    						showNotif("Information",data,"info");
									jmifdtl_ds.read();
									$("#exportButt").prop("disabled", false).removeClass('k-state-disabled');
								}
	    						close_preloader();
		    				});
	    			break;	
					case "exportButt":
					    // Create and download csv
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_work/?";
				        link.href += ("fieldS=plant_no,area_no,drawing_no,sheet_no,rev_no,spool_no&");
				        link.href += ("value=&");
				        link.href += ("dir=asc");
				 
				        //Dispatching click event.
				        if (document.createEvent) {
				            var e = document.createEvent('MouseEvents');
				            e.initEvent('click' ,true ,true);
				            link.dispatchEvent(e);
					    	close_preloader();
				            return true;
				        }
					break;
	    		}
	    	}
	    });
		$(".k-i-search").click(function(e){
			e.preventDefault();
			
			sentValue = $("#search").val();
			dataSource.page(1);
			dataSource.read();
		});
		$("#search").bind({
			keyup: function(e){
				if (e.keyCode == 13){
					sentValue = this.value;
					dataSource.page(1);
					dataSource.read();
				}
			}
		});
	});
</script>