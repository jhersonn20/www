<style>
	.k-upload-files {
		width: 655px;
	}
</style>
<div id="main-wrapper">
	<form method="post" action="submit" style="width: 100%;margin-bottom: 5px;">
        <div class="demo-section">
            <input name="files" id="files" type="file" />
        </div>
    </form>	
    <div class="wrap-grid demo-section">
        <div id="rowSelection"></div>
    </div>
	<div class="wrap-button demo-section">
		<div class="buttonLeft">
        	<button type="button" class="k-button k-state-disabled" id="importButt" disabled>Import</button>
        	<label class="title">Loaded: </label><input type="text" name="txtUpl1" id="txtUpl1" class="k-textbox" style="width: 100px;" disabled>
       	</div>
		<div class="buttonRight">
        	<span>Noted: Must have the same column order following the displayed list above.</span>
        	<button class="k-button mainEve" id="closeButt">Close</button>
       	</div>				
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
		var crudService = crudServiceBaseUrl + "qms/index/",
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "",
        	uplList = [], disImport, errCounter;
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/isoTO",
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
		                system_no: { type: "string"},
				        sub_system: { type: "string"},
				        testpack_no : { type: "string"},
				        tp_type: { type: "string"},
				        test_pressure: { type: "decimal"},
				        serv_line: { type: "string"},
				        pid  : { type: "string"},
				        area_no: { type: "string"},
				        drawing_no: { type: "string"},
				        sheet_no : { type: "string"},
				        spool_no : { type: "string"},
				        rev_no: { type: "string"},
				        diainch: { type: "decimal"},
				        lm: { type: "decimal"},
				        scope: { type: "string"},
				        remarks: { type: "string"},
				        err_remarks: { type: "string"},
				        plant_no: { type: "string"}
                    }
               },
               total: function(response) {
				   	return $(response.rows).length; //(($(response.rows[0]).length > 0) ? response.rows[0].total : 0);
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
               {field: "system_no",width: 92,title: "System No."},
		       {field: "sub_system",width: 116,title: "Subsystem No."},
		       {field: "testpack_no",width: 129,title: "Testpack No."},
		       {field: "tp_type",width: 84,title: "Test Type"},
		       {field: "test_pressure",width: 114,title: "Test Pressure"},
		       {field: "serv_line",width: 102,title: "Service Line"},
		       {field: "pid",width: 83,title: "P&ID"},
		       {field: "area_no",width: 52,title: "Area"},
		       {field: "drawing_no",width: 105,title: "Drawing"},
		       {field: "sheet_no ",width: 66,title: "Sheet"},
		       {field: "spool_no ",width: 83,title: "Spool No."},
		       {field: "rev_no",width: 77,title: "Revision"},
		       {field: "diainch",width: 105,title: "Diainch"},
		       {field: "lm",width: 50,title: "LM"},
		       {field: "scope",width: 114,title: "Scope of Work"},
		       {field: "remarks",width: 118,title: "Remarks"},
		       {field: "err_remarks",width: 185,title: "Upload Status"},
		       {field: "plant_no",width: 85,title: "Plant No"}
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
        insertGridTitle("#rowSelection","Upload Utility - Test Package");
        
        var onSelect = function(e){
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
			$("#importButt").prop("disabled", true).addClass("k-state-disabled");
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
					if ($.trim(this.testpack_no) == "")
						return;
						
					disImport = false;
					$.post(crudService + "directCall/verifyHydro",{testpack_no: this.testpack_no},
						function(callback){
							if (callback == "true"){
								rows[index]['err_remarks'] = "Test Date Already Updated";
								errCounter++;
							}
								
							uplList.push(rows[index]);
							
							if ((rows.length - 1) == index)
								success_ext();
						});
				});
			});
        }
        
        var success_ext = function(){
			data = JSON.stringify({rows: uplList});
			data = eval("(" + data + ")");
			
			$("#importButt").prop("disabled", disImport);
			if (!disImport)
				$("#importButt").removeClass("k-state-disabled");

			$("#rowSelection").data("kendoGrid").dataSource.data(data.rows);
			close_preloader();
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
					default:
						if (errCounter > 0 && !confirm(errCounter + " Errors Found, Proceed anyway?"))
							return true;
						// var uploadNo = 0, totUpload = 0;
						// $.each(dataSourceUpl.data(),function(index,value){
							// if (parseInt(this.upload_no) > uploadNo)
								// uploadNo = parseInt(this.upload_no);
						// });
						// if (uploadNo == 0)
							// uploadNo = 1;
						var ds_total = dataSource.data().length;
						$.each(dataSource.data(),function(index,value){
							$.post(crudService + "manage/tp", {PROGRESS_RECID: 0, testpack_no: this.testpack_no, system_no: this.system_no, sub_system: this.sub_system, tp_type: this.tp_type,
															   test_pressure: this.test_pressure, serv_line: this.serv_line, pid: this.pid, remarks: this.remarks, scope: this.scope,
															   log_user: $("#hidden_user").val(), isLast: (((ds_total - 1) == index) ? "true" : index), errCounter: errCounter},
								function(data){
									if ((ds_total - 1) == index)
										showNotif("Information","Upload Successful!","info");
								});
						});
												
			    		var raw = dataSource.data();
					    var length = raw.length;
					    var item, i;
					    		
					    for(i=length-1; i>=0; i--){
					      item = raw[i];
					      dataSource.remove(item);			
					    }
						$(".k-upload-files").eq(0).remove();
						
						$("#txtUpl1").val(length);
						$(this).prop("disabled", true).addClass("k-state-disabled");
					break;
				}
			}
		});
	});
</script>