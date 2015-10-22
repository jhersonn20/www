<style>
	#win_main-wrapper {
		margin-top: 0;
		padding: 0;
	}
	.k-upload-files {
		width: 630px;
	}
	.buttonLeft {
		width: 50%;
	}
</style>
<div id="win_main-wrapper" style="width: 100%;">
	<form method="post" action="submit" style="width: 100%;margin-bottom: 5px;">
        <div class="demo-section">
            <input name="files" id="files" type="file" accept=".csv" />
        </div>
    </form>	
    <div class="wrap-grid demo-section" style="width: 98.8%;">
        <div id="win_rowSelection"></div>
    </div>
	<div class="wrap-button demo-section">
		<div class="buttonLeft">
        	<button type="button" class="k-button k-state-disabled" id="importButt" disabled>Import</button>
<!--         	<button type="button" class="k-button k-state-disabled" id="updateButt" disabled>Update in related to Piping MTO Data</button> -->
			<label class="title">Loaded: </label><input type="text" name="txtUpl1" id="txtUpl1" class="k-textbox" style="width: 100px;" disabled>
       	</div>
		<div class="buttonRight">
        	<span>Noted: Must have the same column order following the displayed list above.</span>
        	<!-- <button class="k-button mainEve" id="closeButt">Close</button> -->
       	</div>				
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
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
			    // console.log(type);
			    // console.log(response);
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
				        plant_no: {type: "string", editable: false},
				        area_no: {type: "string", editable: false},
				        drawing_no: {type: "string", editable: false},                    
				        sheet_no: {type: "string", editable: false},               
				        rev_no: {type: "string", editable: false},        
				        spool_no: {type: "string", editable: false}
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
			$("#win_rowSelection").data("kendoGrid").select("tr:eq(1)");
	        $(".k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr = [];
	    };
        
        var ubrpip_rs = $("#win_rowSelection").kendoGrid({
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
		       {field: "plant_no",width: 150,title: "Plant No."},
		       {field: "area_no",width: 150,title: "Area No."},
		       {field: "drawing_no",width: 150,title: "Drawing NO."},                    
		       {field: "sheet_no",width: 150,title: "Sheet No."},               
		       {field: "rev_no",width: 150,title: "Rev. No."},        
		       {field: "spool_no",width: 170,title: "Spool No."}
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
        //$("#win_rowSelection").find("thead").first().prepend("<tr><th colspan='18'>Upload Ulitity - Test Package</th></tr>");
        //$("#win_rowSelection").prepend("<div class='k-header' style='width: 100%;text-align: center;border-bottom: 1px solid #C5C5C5;padding: 3px 0;font-size: 12px;font-weight: bold;'>Upload Utility - Test Package</div>");
        insertGridTitle("#win_rowSelection","Text File Uploading");
        
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
					if ($.trim(this.plant_no) == "" ||
						$.trim(this.plant_no) == "plantno" ||
						$.trim(this.area_no) == "" ||
						$.trim(this.drawing_no) == "")
						return;
						
					disImport = false;
					uplList.push(this);				});
				data = JSON.stringify({rows: uplList});
				data = eval("(" + data + ")");
			
				$("#importButt, #updateButt").prop("disabled", disImport);
				if (!disImport)
					$("#importButt, #updateButt").removeClass("k-state-disabled");
	
				$("#win_rowSelection").data("kendoGrid").dataSource.data(data.rows);
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
		
		$("#win_main-wrapper button").bind({
			click: function(){
				switch(this.id){
					case "uploadButt":
						upload = $("#files").data("kendoUpload");
		                //uploadBrowse = $("#uploadBrowse").data("kendoGrid");
		                //uploadBrowse.dataSource.read();
            			//$("#uplWindow").data("kendoWindow").center().open();
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
						open_preloader();
						$.post(crudService + "directCall/callSP_treq",{disc_code: disc_code, loguser: $("#hidden_user").val(), fileNames: fileName},
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
							});
						// // if (errCounter > 0 && !confirm(errCounter + " Errors Found, Proceed anyway?"))
							// // return true;
						// // var uploadNo = 0, totUpload = 0;
						// // $.each(dataSourceUpl.data(),function(index,value){
							// // if (parseInt(this.upload_no) > uploadNo)
								// // uploadNo = parseInt(this.upload_no);
						// // });
						// // if (uploadNo == 0)
							// // uploadNo = 1;
						// open_preloader();
						// var tempData = [];
						// var ds_total = ubrpip_ds.data().length;
						// $.each(ubrpip_ds.data(),function(index,value){
							// var row = [];
							// $.each(value,function(index2,value2){
								// if (typeof value2 == "object")
									// return;
// 																		
								// row[index2] = value2;
							// });
// 
							// row['loguser'] = $("#hidden_user").val();
							// row['PROGRESS_RECID'] = 0;
							// row['disc_code'] = disc_code;
							// tempData.push(row);
							// // postInfo = JSON.stringify(row);
							// // postInfo = eval("(" + postInfo + ")");
// 
							// // $.post(crudService + "manage/UbrPip",postInfo,
								// // function(data){
									// // if ($.trim(data) == "1" && (ds_total - 1) == index)
										// // showNotif("Information","Upload Successful!","info");
								// // });
						// });
// 						
						// postInfo = JSON.stringify(tempData);
						// postInfo = eval("(" + postInfo + ")");
						// console.log(postInfo);
						// // // ubrpip_ds.sync();
						// // // $("#win_rowSelection").data("kendoGrid").setDataSource(ubrpip_ds);
						// // // $("#win_rowSelection").data("kendoGrid").dataSource.page($("#win_rowSelection").data("kendoGrid").dataSource.page());
						// // // $("#win_rowSelection").data("kendoGrid").dataSource.read();
// // // 						
			    		// // var raw = ubrpip_ds.data();
					    // // var length = raw.length;
					    // // // var item, i;
// // // 					    		
					    // // // for(i=length-1; i>=0; i--){
					      // // // item = raw[i];
					      // // // ubrpip_ds.remove(item);			
					    // // // }
// // // 
						// // // $(".k-upload-files").eq(0).remove();
// // 						
						// // $("#txtUpl1").val(length);
						// // $(this).prop("disabled", true).addClass("k-state-disabled");
						// // $("#files").data("kendoUpload").disable();
						// // close_preloader();
						// // $("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
						// // $("#rowSelection").data("kendoGrid").dataSource.read();
					break;
				}
			}
		});
	});
</script>