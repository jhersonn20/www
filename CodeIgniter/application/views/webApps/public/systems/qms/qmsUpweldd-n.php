<style>
	#main-wrapper {
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
<div id="main-wrapper" style="width: 100%;">
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
        	<button type="button" class="k-button k-state-disabled" id="updateButt" disabled>Update in related to Piping Weld Data</button>
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
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "",
        	uplList = [], disImport, errCounter, fileName = "";
        var dataSource = new kendo.data.DataSource({
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
                   	    PROGRESS_RECID: {type: "number", editable: false}
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
        
        var grid = $("#rowSelection").kendoGrid({
            dataSource: dataSource,
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
		       {field: "serv_line_code",width: 138,title: "Service Line Code"},
		       {field: "serv_line_desc",width: 177,title: "Service Line Description"},
		       {field: "p_id",width: 85,title: "P&ID"},                    
		       {field: "unit_area",width: 85,title: "Unit Area"},               
		       {field: "area_desc",width: 128,title: "Area Description"},        
		       {field: "pip_iso_no",width: 114,title: "Piping ISO No."},          
		       {field: "client_dwg_no",width: 120,title: "Client DWG No."},          
		       {field: "tie_in_joints",width: 120,title: "Tie-In Joints"},             
		       {field: "lb_sb",width: 85,title: "LB/SB"},
		       {field: "sheet_no",width: 85,title: "Sheet No."},                     
		       {field: "total_sheets",width: 108,title: "Total Sheets"},            
		       {field: "rev_no",width: 85,title: "Rev No."},                     
		       {field: "line_no",width: 85,title: "Line No."},
		       {field: "constn_area",width: 105,title: "Constn Area"},
		       {field: "line_class",width: 91,title: "Line Class"},              
		       {field: "material",width: 85,title: "Material"},                  
		       {field: "joint_category",width: 117,title: "Joint Category"},          
		       {field: "spool_no",width: 90,title: "Spool No."},               
		       {field: "spool_no1",width: 99,title: "Spool No. 1"},         
		       {field: "joint_no",width: 90,title: "Joint No."},                         
		       {field: "SIZE",width: 95,title: "Size"},              
		       {field: "bolt_up_support",width: 128,title: "Bolt-Up Support"},
		       {field: "schedule",width: 95,title: "Schedule"},    
		       {field: "joint_type",width: 95,title: "Joint Type"},    
		       {field: "weld_location",width: 117,title: "Weld Location"},     
		       {field: "test_pressure",width: 151,title: "Test Pressure"},           
		       {field: "tp_no",width: 107,title: "Testpack No."},            
		       {field: "tp_type_of_test",width: 165,title: "Testpack Type of Test"},   
		       {field: "tp_f_s",width: 153,title: "Testpack Field/Shop"},     
		       {field: "priority_timing",width: 114,title: "Priority Timing"},         
		       {field: "priority_no",width: 95,title: "Priority No."},            
		       {field: "tp_priority_timing",width: 134,title: "TP Priority Timing"},      
		       {field: "tp_priority_no",width: 114,title: "TP Priority No."},    
		       {field: "piping_class",width: 102,title: "Piping Class"},            
		       {field: "FIELD_desc",width: 130,title: "Field Description"},      
		       {field: "iso_lb_sb",width: 133,title: "ISO LB/SB"},               
			   {field: "remarks1",width: 179,title: "Upload Status Remarks"}
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
        //$("#rowSelection").find("thead").first().prepend("<tr><th colspan='18'>Upload Ulitity - Test Package</th></tr>");
        //$("#rowSelection").prepend("<div class='k-header' style='width: 100%;text-align: center;border-bottom: 1px solid #C5C5C5;padding: 3px 0;font-size: 12px;font-weight: bold;'>Upload Utility - Test Package</div>");
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
    		var raw = dataSource.data();
		    var length = raw.length;
		    var item, i;
		
		    for(i=length-1; i>=0; i--){
		        item = raw[i];
		        dataSource.remove(item);
		    }
			$("#importButt, #updateButt").prop("disabled", true).addClass("k-state-disabled");
        }
        
        var onUpload = function(e) {
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
					if ($.trim(this.piping_class) == "")
						return;
					disImport = false;
					uplList.push(this);				});
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
		
		$("button").bind({
			click: function(){
				switch(this.id){
					case "uploadButt":
						upload = $("#files").data("kendoUpload");
		                //uploadBrowse = $("#uploadBrowse").data("kendoGrid");
		                //uploadBrowse.dataSource.read();
            			//$("#uplWindow").data("kendoWindow").center().open();
					break;
					case "updateButt":
						if (!confirm("Do you want to update the following database table in related to Piping MTO Data ?\nMAT_TAKEOFF_PERSPOOL\nSPOOL\nISO\nTESTPACK_HDR\nSYSTEM\nH_MAT_TAKEOFF_PERSPOOL\nH_SPOOL\nH_ISO"))
							return true;
							
						open_preloader();
						$.post(crudService + "directCall/callSP_weld",{},
							function(data){
								showNotif((data.rows[0].return_value == 1) ? "Information" : "Warning",(data.rows[0].return_value == 1) ? "Update Successful!" : "Update Failed!",(data.rows[0].return_value == 1) ? "info" : "warning");
							});
							
						$(this).prop("disabled", true).addClass("k-state-disabled");
						$("#files").data("kendoUpload").enable();
						close_preloader();
					break;
					default:
						// if (errCounter > 0 && !confirm(errCounter + " Errors Found, Proceed anyway?"))
							// return true;
						// var uploadNo = 0, totUpload = 0;
						// $.each(dataSourceUpl.data(),function(index,value){
							// if (parseInt(this.upload_no) > uploadNo)
								// uploadNo = parseInt(this.upload_no);
						// });
						// if (uploadNo == 0)
							// uploadNo = 1;
						open_preloader();
						var ds_total = dataSource.data().length;
						$.each(dataSource.data(),function(index,value){
							var row = [];
							$.each(value,function(index2,value2){
								if (typeof value2 == "object")
									return;
																		
								row[index2] = value2;
							});

							row['loguser'] = $("#hidden_user").val();
							row['logupdate'] = "Upload Piping Weld/Joint Data";
							row['PROGRESS_RECID'] = 0;
							row['index'] = index;
							row['file_origin'] = fileName;
							postInfo = JSON.stringify(row);
							postInfo = eval("(" + postInfo + ")");

							$.post(crudService + "manage/weldMto",postInfo,
								function(data){
									if ((ds_total - 1) == index)
										showNotif("Information","Upload Successful!","info");
								});
						});
						// dataSource.sync();
						// $("#rowSelection").data("kendoGrid").setDataSource(dataSource);
						// $("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
						// $("#rowSelection").data("kendoGrid").dataSource.read();
// 						
			    		var raw = dataSource.data();
					    var length = raw.length;
					    // var item, i;
// 					    		
					    // for(i=length-1; i>=0; i--){
					      // item = raw[i];
					      // dataSource.remove(item);			
					    // }
// 
						// $(".k-upload-files").eq(0).remove();
						
						$("#txtUpl1").val(length);
						$(this).prop("disabled", true).addClass("k-state-disabled");
						$("#files").data("kendoUpload").disable();
						close_preloader();
					break;
				}
			}
		});
	});
</script>