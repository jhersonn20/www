<style>
	.k-upload-files {
		width: 655px;
	}
</style>
<div id="main-wrapper">
	<form method="post" action="submit" style="width: 100%;margin-bottom: 5px;">
        <div class="demo-section">
            <input name="files" id="files" type="file" accept=".csv" />
        </div>
    </form>	
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
	        	<button class="k-button mainEve k-state-disabled" disabled id="uploadButt">Upload</button>
	       	</div>
			<div class="buttonRight">
				<label class="title" for="txt1" style="width: auto;">Total Diainch:</label><input type="text" name="txt1" id="txt1" class="k-state-disabled" disabled style="width: 155px;"/>
	        	<button class="k-button mainEve" id="closeButt">Close</button>
	       	</div>				
		</div>
	</div>
</div>
<script type="text/javascript">
	var processMatTO = false;
	function grid_change(e,grid){
		if (typeof e == "undefined")
			e = grid;
		var selectedRows = e.select();
		var selectedDataItems = [];
		for (var i = 0; i < selectedRows.length; i++) {
			dataItem3 = e.dataItem(selectedRows[i]);
	    }
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
	$(document).ready(function(){
		$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
		var crudService = crudServiceBaseUrl + "qms/index/",
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", currRow2 = "", dataItem = '', jmifdtl_di = '', isFailed = false,
		    filterFArr_jmifdtl = [], filterOArr_jmifdtl = [], filterVArr_jmifdtl = [], sentValue_jmifdtl = "", fieldSort = "", dirSort = "", query = "", fileName = "";
		
		var totDia = $("#txt1").removeClass('k-state-disabled').kendoNumericTextBox({
			format: "n",
			enable: false
		}).data("kendoNumericTextBox");
		
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/whseGW",
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
            // serverPaging: true,
			// serverFiltering: true,
			// serverSorting: true,
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
                        remarks1: { type: "string" }
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
               {field: "commodity_code",title: "Commodity",width: 154},
               {field: "size",title: "Size", width: 58},
               {field: "itemdesc",title: "Item Desc.", width: 230},
               {field: "qty",title: "Qty.", width: 114,filterable: false},
               {field: "alloc_qty",title: "Allocated Qty.", width: 114,filterable: false},
               {field: "remarks1",title: "Upload Status Remarks", width: 212,filterable: false}
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
        insertGridTitle('#rowSelection','Text File Uploading');                    

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
                        qty: { type: "number" },
                        alloc_qty: { type: "number" },
                        totDia: { type: "number" }
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
        	
        	var sumDia = 0;
			$.each(jmifdtl_ds.data(),function(index,value){
				$.each(value,function(index2,value2){
					if (index2 == "totDia")
						sumDia = sumDia + value2;
        				// console.log(value2);
				});
			});
        	totDia.value(sumDia);
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
               {field: "qty",title: "Quantity", width: 114, filterable: false},
               {field: "alloc_qty",title: "Allocated", width: 114, filterable: false},
               {field: "totDia",title: "Diainch", width: 114, filterable: false}
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
	    				$.post(crudService + "manage/whseGW_proc",{sp: "gen_work", module: "client", filename: fileName},
		    				function(data){
		    					if ($.trim(data) == "1"){
		    						showNotif("Information",data,"info");
									jmifdtl_ds.read();
									$("#exportButt, #uploadButt").prop("disabled", false).removeClass("k-state-disabled");
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
					case "uploadButt":
						open_preloader();
						$.post(crudService + "directCall/callSP_upl_req",{disc_code: 'PIP', loguser: $("#hidden_user").val(), fileNames: ''},
							function(data){
								showNotif("Information",($.trim(data) == "") ? "Upload Successful!" : data,"info");
									
					    		// var raw = ubrpip_ds.data();
							    // var length = raw.length;						
								// $("#txtUpl1").val(length);
								$("#uploadButt").prop("disabled", true).addClass("k-state-disabled");
								$("#files").data("kendoUpload").disable();
								close_preloader();
								// $("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
								// $("#rowSelection").data("kendoGrid").dataSource.read();
							});
					break;
	    		}
	    	}
	    });
        
        var onSelect = function(e){
        	if (e.files[0].extension != ".csv"){
				showNotif("Information","Select failed. Upload accepts '.csv' files only!","info");
        		e.preventDefault();
        		return true;
        	}
			$(".k-upload-files").css({"width": "655px"});
		    fileName = e.files[0].name;
        		
        	if ($(".k-upload-files > li").length == 0)
        		return true;

        	$(".k-upload-files > li").eq(0).remove();
    		var raw = dataSource.data();
		    var length = raw.length;
		    var item, i;
		
		    for(i=length-1; i>=0; i--){
		        item = raw[i];
		        dataSource.remove(item);
		    }

			$("#exportButt, #uploadButt").prop("disabled", true).addClass("k-state-disabled");
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
					if ($.trim(this.commodity_code) == "")
						return;
						
					disImport = false;
					uplList.push(this);
				});

				data = JSON.stringify({rows: uplList});
				data = eval("(" + data + ")");
			
				$("#exportButt, #uploadButt").prop("disabled", disImport);
				if (!disImport)
					$("#exportButt, #uploadButt").removeClass("k-state-disabled");
	
				$("#rowSelection").data("kendoGrid").dataSource.data(data.rows);
				close_preloader();
			});
			$(".k-upload-files").css({"width": "770px"});
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
	});
</script>