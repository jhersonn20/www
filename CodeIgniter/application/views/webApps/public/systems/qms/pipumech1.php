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
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", fileName = "";
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
					    fieldS: ($(data.sort).length ? data.sort[0].field : "acctcode"),
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
	            {field: "acctcode",width: 113,title: "Account Code"},
				{field: "cphase",width: 105,title: "Cntrn Phase"},
				{field: "area",width: 92,title: "Area"},
				{field: "eqpt_tag",width: 120,title: "Equipment Tag"},
				{field: "eqpt_name",width: 133,title: "Equipment Name"},
				{field: "vendor",width: 92,title: "Vendor"},
				{field: "drawingno",width: 103,title: "Drawing No."},
				{field: "revno",width: 99,title: "Rev No."},
				{field: "eqpt_type",width: 130,title: "Equipment Type"},
				{field: "qty",width: 92,title: "Qty"},
				{field: "eqpt_w_boq",width: 174,title: "Equipment Weight BOQ"},
				{field: "eqpt_w_vendor",width: 192,title: "Equipment Weight Vendor"},
				{field: "insul_thk",width: 155,title: "Insulation Thickness"},
				{field: "insul_od_dia",width: 167,title: "Insulation Skirt OD Dia"},
				{field: "insul_length",width: 138,title: "Insulation Length"},
				{field: "insul_head",width: 164,title: "Insulation No of Head"},
				{field: "type",width: 92,title: "Type"},
				{field: "head",width: 109,title: "Head"},
				{field: "surface_area",width: 169,title: "Surface Area"},
				{field: "fp_thk",width: 92,title: "Fireproofing Thickness"},
				{field: "fp_od_dia",width: 149,title: "Fireproofing OD Dia"},
				{field: "fp_length",width: 149,title: "Fireproofing Length"},
				{field: "fp_volume",width: 153,title: "Fireproofing Volume"},
				{field: "remarks",width: 92,title: "Remarks"},
				{field: "remarks1",title: "Upload Status Remarks"}
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
					if ($.trim(this.cphase) == "")
						return;
						
					if ($.trim(this.drawingno) == "")
						this.drawingno = "NO DWG";
						
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
							row['PROGRESS_RECID'] = 0;
							row['index'] = index;
							row['lastIndex'] = (ds_total - 1);
							row['file_origin'] = fileName;
							postInfo = JSON.stringify(row);
							postInfo = eval("(" + postInfo + ")");

							$.post(crudService + "manage/mechMto",postInfo,
								function(data){
									if ((ds_total - 1) == index)
										showNotif((data.rows[0].return_value == 1) ? "Information" : "Warning",(data.rows[0].return_value == 1) ? "Upload Successful!" : "Upload Failed!",(data.rows[0].return_value == 1) ? "info" : "warning");
								});
						});
						 						
			    		var raw = dataSource.data();
					    var length = raw.length;
						
						$("#txtUpl1").val(length);
						$(this).prop("disabled", true).addClass("k-state-disabled");
						close_preloader();
					break;
				}
			}
		});
	});
</script>