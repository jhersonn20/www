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
				        loopno: {type: "string", editable: false},
				        tagno: {type: "string", editable: false},
				        drawno: {type: "string", editable: false},
				        sheetno: {type: "string", editable: false},                    
				        revno: {type: "string", editable: false},               
				        tagdesc: {type: "string", editable: false},        
				        loc: {type: "string", editable: false},        
				        pid: {type: "string", editable: false},
				        instype: {type: "string", editable: false},
				        qty: {type: "string", editable: false},
				        uom: {type: "string", editable: false},                    
				        uprice: {type: "string", editable: false},               
				        cat: {type: "string", editable: false}
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
		       {field: "loopno",width: 150,title: "Area No."},
		       {field: "tagno",width: 150,title: "Plant No."},
		       {field: "drawno",width: 150,title: "Drawing No."},
		       {field: "sheetno",width: 150,title: "Sheet No."},                    
		       {field: "revno",width: 150,title: "Rev No."},               
		       {field: "tagdesc",width: 150,title: "Priorirty No"},        
		       {field: "loc",width: 170,title: "Equip No"},        
		       {field: "pid",width: 170,title: "Equip Desc"},
		       {field: "instype",width: 150,title: "Total Weight"},
		       {field: "qty",width: 150,title: "Document No"},
		       {field: "uom",width: 150,title: "Supplier Code"},                    
		       {field: "uprice",width: 150,title: "ISO Remarks"},               
		       {field: "cat",width: 150,title: "Jet Nos."}
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
					if ($.trim(this.loopno) == "" || $.trim(this.drawno).indexOf('loopno') >= 0 || $.trim(this.tagno) == "" || $.trim(this.tagno).indexOf('area') >= 0)
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
						$.post(crudService + "directCall/callSP_upl_inst",{loguser: $("#hidden_user").val(), fileNames: fileName},
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