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
        <div id="uploadBrowse"></div>
    </div>
	<div class="wrap-button demo-section">
		<div class="buttonLeft">
        	<button type="button" class="k-button k-state-disabled" id="importButt" disabled>Import</button>
        	<label class="title">Loaded: </label><input type="text" name="txtUpl1" id="txtUpl1" class="k-textbox" style="width: 100px;" disabled>
       	</div>
		<div class="buttonRight">
        	<span>Noted: Must have the same column order following the displayed list above.</span>
        	<!-- <button class="k-button mainEve" id="closeButt">Close</button> -->
       	</div>				
	</div>
	<input type="hidden" name="objStr" id="objStr" />
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var crudService = crudServiceBaseUrl + "qms/index/", errCounter = 0,
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", fileName = "", uploadBrowse = "";
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
            pageSize: 5,
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
               		//id: "PROGRESS_RECID",
                    fields: {}
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
	    var addExtraStylingToGrid = function () {
			$("#uploadBrowse").data("kendoGrid").select("tr:eq(1)");
	        $(".k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr = [];
	    };
        
        var grid = $("#uploadBrowse").kendoGrid({
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
				{field: "err_remarks",width: 221,title: "Error Remarks"},
				{field: "area_no",width: 92,title: "Area No"},        
				{field: "drawing_no",width: 110,title: "Drawing No"},
				{field: "sheet_no",width: 92,title: "Sheet No"},
				{field: "rev_no",width: 92,title: "Rev. No"},
				{field: "spool_no",width: 92,title: "Spool No"},      
				{field: "mat_tag",width: 92,title: "Mat Tag"},
	            {field: "pcdfitup_date",width: 92,title: "FOG Fitup"},              
				{field: "pcd_installed",width: 114,title: "FOG Installed"},       
				{field: "pcd_remarks",title: "FOG Remarks"}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
           }
        });
        uploadBrowse = $("#uploadBrowse").data("kendoGrid");
        
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
				disImport = false;
				
				$.each(data.rows, function(index,value){
					if ($.trim(this.rev_no) == "" &&
					    $.trim(this.job_no) == "" &&
					    $.trim(this.area_no) == "" &&
					    $.trim(this.drawing_no) == "" &&
					    $.trim(this.spool_no) == "" &&
					    $.trim(this.sheet_no) == "")
						return;
						
					disImport = false;
					$.get(crudService + "directCall/verifyPipe",{rev_no: this.rev_no, area_no: this.area_no, drawing_no: this.drawing_no, spool_no: this.spool_no, sheet_no: this.sheet_no, mat_tag: this.mat_tag},
						function(callback){
							if (callback == "false"){
								rows[index]['err_remarks'] = "Pipe Support Materail Not Found";
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
		
			$("#importButt, #updateButt").prop("disabled", disImport);
			if (!disImport)
				$("#importButt, #updateButt").removeClass("k-state-disabled");

			$("#uploadBrowse").data("kendoGrid").dataSource.data(data.rows);
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
		
		$("#window button").bind({
			click: function(){
				switch(this.id){
					case "uploadButt":
						upload = $("#files").data("kendoUpload");
					break;
					default:
						if (errCounter > 0 && !confirm(errCounter + " Errors Found, Proceed anyway?"))
							return true;
							
						open_preloader();						
						var ds_total = dataSource.data().length;

						var navList = [], columnList = [];
						$.each(uploadBrowse.columns, function(index,value){
							columnList.push(this.field);
						});

						$.each(dataSource.data(), function(index,value){
					        var object = {};
					        $.each(columnList, function(index2, value2){
					          var rowValue = eval("value." + value2);
					          rowValue = (rowValue == undefined) ? "" : rowValue;
					          object[value2] = rowValue.replace('"',"''");
					        });
					        navList.push(object);
						});

						postInfo = JSON.stringify({rows: navList});
						$("#objStr").val(postInfo);
						postInfo = eval("(" + postInfo + ")");
						$.post(crudService + "directCall/psPcdMto",{rows: $("#objStr").val()},
							function(data){
								if (data.rows[0].return_value == 1) //(ds_total - 1) == index)
									showNotif("Information","Upload Successful!","info");
							});

			    		var raw = dataSource.data();
					    var length = raw.length;
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