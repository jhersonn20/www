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
<script type="text/javascript">
	$(document).ready(function(){
		$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
		var crudService = crudServiceBaseUrl + "qms/index/",
			disc_code = pathname.split('/')[pathname.split('/').length - 1],
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "",
        	uplList = [], disImport, errCounter, fileName = "";
        	
        var ubrpip_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/pipMtoData",
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
					    fieldS: ($(data.sort).length ? data.sort[0].field : "drawno"),
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
				        areano: {type: "string", editable: false},
				        drawno: {type: "string", editable: false},
				        sheetno: {type: "string", editable: false},                    
				        revno: {type: "string", editable: false},               
				        pcmark: {type: "string", editable: false},        
				        loc: {type: "string", editable: false},        
				        elev: {type: "string", editable: false},
				        uwt: {type: "string", editable: false},
				        qty: {type: "string", editable: false},
				        strucid: {type: "string", editable: false},                    
				        rocktype: {type: "string", editable: false},               
				        priorno: {type: "string", editable: false},        
				        sclass: {type: "string", editable: false},        
				        leng: {type: "string", editable: false},
				        design: {type: "string", editable: false},
				        pcdesc: {type: "string", editable: false},
				        remarks: {type: "string", editable: false},                    
				        actcode: {type: "string", editable: false},               
				        fwbsno: {type: "string", editable: false}
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
		       {field: "areano",width: 150,title: "Area No."},
		       {field: "drawno",width: 150,title: "Drawing No."},
		       {field: "sheetno",width: 150,title: "Sheet No."},                    
		       {field: "revno",width: 150,title: "Rev No."},               
		       {field: "pcmark",width: 150,title: "Pc Mark"},        
		       {field: "loc",width: 170,title: "Loc"},        
		       {field: "elev",width: 170,title: "Elev"},
		       {field: "uwt",width: 150,title: "U.Wt"},
		       {field: "qty",width: 150,title: "Qty"},
		       {field: "strucid",width: 150,title: "Struct ID"},                    
		       {field: "roctype",width: 150,title: "Rock Type"},               
		       {field: "priorno",width: 150,title: "Prior No."},        
		       {field: "sclass",width: 170,title: "Struct Class"},        
		       {field: "leng",width: 170,title: "Length"},
		       {field: "design",width: 150,title: "Designation"},
		       {field: "pcdesc",width: 150,title: "PCMark Desc"},
		       {field: "remarks",width: 150,title: "Remarks"},                    
		       {field: "actcode",width: 150,title: "Act Code"},               
		       {field: "fwbsno",width: 150,title: "FWBS No"},        
		       {field: "plantno",width: 170,title: "Plant No."}
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
        insertGridTitle("#rowSelection","Text File Uploading");
        
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
					if ($.trim(this.drawno) == "" || $.trim(this.drawno).indexOf('draw') >= 0 || $.trim(this.areano) == "" || $.trim(this.areano).indexOf('area') >= 0)
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
		
		$("#main-wrapper button").bind({
			click: function(){
				switch(this.id){
					case "uploadButt":
						upload = $("#files").data("kendoUpload");
					break;
					case "updateButt":
						if (!confirm("Do you want to continue ?"))
							return true;
							
						open_preloader();
						$.post(crudService + "directCall/callSP",{},
							function(data){
								showNotif((data.rows[0].return_value == 1) ? "Information" : "Warning",(data.rows[0].return_value == 1) ? "Update Successful!" : "Update Failed!",(data.rows[0].return_value == 1) ? "info" : "warning");
							});
							
						$(this).prop("disabled", true).addClass("k-state-disabled");
						$("#files").data("kendoUpload").enable();
						close_preloader();
					break;
					default:
						var conF = confirm("Do you want to continue?");
						if(!conF){
							alert("Process Aborted!!");
							return true;
						}
						
							
					
						open_preloader();
						$.post(crudService + "directCall/callSP_upl_isoPiece",{loguser: $("#hidden_user").val(), fileNames: fileName},
							function(data){
								showNotif("Information",($.trim(data) == "") ? "Upload Successful!" : data,"info");
									
					    		var raw = ubrpip_ds.data();
							    var length = raw.length;						
								$("#txtUpl1").val(length);
								$("#importButt").prop("disabled", true).addClass("k-state-disabled");
								$("#files").data("kendoUpload").disable();
								close_preloader();
								setTimeout(function(){
							    window.location.reload(1);
								}, 5000);
								
							});
					break;
				}
			}
		});
	});
</script>