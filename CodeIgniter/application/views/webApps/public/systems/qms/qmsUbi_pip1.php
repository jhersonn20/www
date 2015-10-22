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
			<label class="title">Loaded: </label><input type="text" name="txtUpl1" id="txtUpl1" class="k-textbox" style="width: 100px;" disabled>
       	</div>
		<div class="buttonRight">
        	<span>Noted: Must have the same column order following the displayed list above.</span>
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
               		id: "jmif_no",
                    fields: {
                   	    //PROGRESS_RECID: {type: "number", editable: false},
				        jmif_no: {type: "string", editable: false},				        
				        stock_no: {type: "string", editable: false},                  
				        item_code: {type: "string", editable: false}, 
				        commodity_code: {type: "string", editable: false},
				        mat_desc: {type: "string", editable: false},                
				        area_no: {type: "string", editable: false},    
				        uom: {type: "string", editable: false},          
				        size: {type: "string", editable: false},
				        act_code: {type: "string", editable: false},                    
				        mat_util: {type: "string", editable: false},               
				        measurement: {type: "string", editable: false},       
				        req_qty: {type: "number", editable: false},       
				        iss_qty: {type: "number", editable: false},                    
				        drawing_no: {type: "string", editable: false},              
				        sheet_no: {type: "string", editable: false},                     
				        rev_no: {type: "string", editable: false},
				        rfi_no: {type: "string", editable: false},               
				        qcmrir_no: {type: "string", editable: false},
				        dtl_matl_type: {type: "string", editable: false},                 
				        sched: {type: "string", editable: false},
				        direct_with: {type: "boolean", editable: false},
				        dlmr_jwrr: {type: "boolean", editable: false},
				        dtl_issue_date: {type: "date", editable: false},
				        issued_by: {type: "string", editable: false},
				        supp_code: {type: "string", editable: false},
				        received_by: {type: "string", editable: false},
				        pr_po_no: {type: "string", editable: false},
				        dtl_pl_dn_inv: {type: "string", editable: false},
				        jwrr_rem: {type: "string", editable: false},
				        priority: {type: "string", editable: false},				                  
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
		       {field: "jmif_no",width: 150,title: "HDR!JMIF No."},             
		       {field: "stock_no",width: 150,title: "DTL!Stock No."},   
		       {field: "item_code",width: 150,title: "DTL!Item Code"},
		       {field: "commodity_code",width: 150,title: "DTL!Commodity Code"},              
		       {field: "mat_desc",width: 150,title: "DTL!Mat. Desc."},                
		       {field: "area_no",width: 150,title: "DTL!Area No."},
		       {field: "uom",width: 150,title: "DTL!UOM"},          
		       {field: "size",width: 150,title: "DTL!Size"},
		       {field: "act_code",width: 150,title: "DTL!Activity Code"},       
		       {field: "mat_util",width: 150,title: "DTL!Material Util."},       
		       {field: "measurement",width: 150,title: "DTL!Measurement"},		               
		       {field: "req_qty",width: 150,title: "DTL!Requested Qty."},		               
		       {field: "iss_qty",width: 150,title: "DTL!Issued Qty."},                    
		       {field: "drawing_no",width: 150,title: "DTL!Drawing No."},              
		       {field: "sheet_no",width: 150,title: "DTL!Sheet No."},                     
		       {field: "rev_no",width: 150,title: "DTL!Rev No."},             
		       {field: "rfi_no",width: 150,title: "HDR!RFI No."},
		       {field: "qcmrir_no",width: 150,title: "HDR!QCMRIR No"},       
		       {field: "mat_type",width: 150,title: "DTL!Matl. Type"},       
		       {field: "sched",width: 150,title: "DTL!Schedule"},       
		       {field: "direct_with",width: 150,title: "DTL!Direct With."},       
		       {field: "dlmr_jwrr",width: 150,title: "DTL!DLMR/JWRR"},
		       {field: "issued_date",width: 150,title: "DTL!Issued Date", format: "{0:MM/dd/yyyy}"},       
		       {field: "issued_by",width: 150,title: "DTL!Issued By"},       
		       {field: "supp_code",width: 150,title: "DTL!Supplier Code"},       
		       {field: "received_by",width: 150,title: "DTL!Received By"},       
		       {field: "pr_po_no",width: 150,title: "DTL!PR/PO No."},       
		       {field: "pr_dn_inv",width: 150,title: "DTL!PL/DN/INV No."},       
		       {field: "jwrr_rem",width: 150,title: "DTL!JWRR Remarks"},       
		       {field: "priority",width: 150,title: "DTL!Priority"},          
		       {field: "remarks1",width: 170,title: "Upload Status Remarks"}
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
        
        var onUpload = function(e) {
			open_preloader();
        	disImport = true;
			uplList_hdr = [];
			uplList = [];
			errCounter = 0;
			$.get("/assets/uploads/" + e.files[0].name, function(data) {
				data = $.csv.toObjects(data);
				data = JSON.stringify({rows: data});
				data = eval("(" + data + ")");
				rows = data.rows;
				
				$.each(data.rows, function(index,value){
					if ($.trim(this.jmif_no) == "" || this.jmif_no.indexOf("jmifno") >= 0 ||
						this.jmif_no.indexOf("jmif_") >= 0 || this.jmif_no.indexOf("jmif ") >= 0)
						return;
						
					if ($.inArray(this.jmif_no, uplList_hdr) < 0)
						uplList_hdr.push(this.jmif_no);
						
					disImport = false;
					uplList.push(value);				});
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
				removeUrl: "remove.php",
				autoUpload: false
			},
			localization: {
				dropFilesHere: "| Drop here..."
			},
			multiple: false,
			upload: onUpload,
			select: onSelect
		});
		
		$("#win_main-wrapper button").bind({
			click: function(){
				switch(this.id){
					case "uploadButt":
						upload = $("#files").data("kendoUpload");
					break;
					case "updateButt":
						if (!confirm("Do you want to update the following database table in related to Piping MTO Data ?\nMAT_TAKEOFF_PERSPOOL\nSPOOL\nISO\nTESTPACK_HDR\nSYSTEM\nH_MAT_TAKEOFF_PERSPOOL\nH_SPOOL\nH_ISO"))
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
						var ds_total = ubrpip_ds.data().length;
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
							// row['isLast'] = ((ds_total - 1) == index ? 1 : 0);
							// row['deleteHdr'] = ($.inArray(row['jmif_no'],uplList_hdr) >= 0 ? 1 : 0);
							// if (row['deleteHdr'] == 1)
								// uplList_hdr.splice( $.inArray(row['jmif_no'], uplList_hdr), 1 );
							// postInfo = JSON.stringify(row);
							// postInfo = eval("(" + postInfo + ")");
// 
							// $.post(crudService + "manage/UbiPip1",postInfo,
								// function(data){
									// if ($.trim(data) == "1" && (ds_total - 1) == index)
										// showNotif("Information","Upload Successful!","info");
									// if ($.trim(data) != "1"){
										// showNotif("Warning",data,"warning");
										// errCounter++;
									// }
								// });
						// });
						var eve_import = function (index){							if (index <= ds_total){
								value = ubrpip_ds.data()[index];
								var row = [];
								$.each(value,function(index2,value2){
									if (typeof value2 == "object")
										return;
																			
									row[index2] = value2;
								});
	
								row['log_user'] = $("#hidden_user").val();
								row['PROGRESS_RECID'] = 0;
								row['disc_code'] = disc_code;
								row['isLast'] = ((ds_total - 1) == index ? 1 : 0);
								row['module'] = "jmif";
								row['deleteHdr'] = ($.inArray(row['jmif_no'],uplList_hdr) >= 0 ? 1 : 0);
								if (row['deleteHdr'] == 1)
									uplList_hdr.splice( $.inArray(row['jmif_no'], uplList_hdr), 1 );
								postInfo = JSON.stringify(row);
								postInfo = eval("(" + postInfo + ")");
	
								$.post(crudService + "manage/UbiPip1",postInfo,
									function(data){
										if ($.trim(data) == "1" && (ds_total - 1) == index){
											showNotif("Information","Upload Successful!","info");
											
								    		var raw = ubrpip_ds.data();
										    var length = raw.length;
											
											$("#txtUpl1").val(length);
											$(this).prop("disabled", true).addClass("k-state-disabled");
											$("#files").data("kendoUpload").disable();
											$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
											$("#rowSelection").data("kendoGrid").dataSource.read();											
											close_preloader();
		    								$("#window").data("kendoWindow").close();
										}
										if ($.trim(data) != "1"){
											showNotif("Warning",data,"warning");											
											close_preloader();
										} else
											eve_import(++index);
									});
							}
						};
						eve_import(0); 						
					break;
				}
			}
		});
	});
</script>