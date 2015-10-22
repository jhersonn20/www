<style>	
	.k-upload-files {
		width: 630px;
	}
	.buttonLeft {
		width: 50%;
	}
</style>
<div id="main-wrapper" <?php echo (isset($_POST['inWindow'])) ? "style='width: 100%;margin-top: 0;padding: 0;'" : ""; ?>>
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
		var crudService = crudServiceBaseUrl + "qms/index/",
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
	            {field: "plant_no",width: 92,title: "Plant No"},
				{field: "area_no",width: 92,title: "Area No"},        
				{field: "drawing_no",width: 110,title: "Drawing No"},     
				{field: "sheet_no",width: 92,title: "Sheet No"},       
				{field: "rev_no",width: 92,title: "Rev. No"},         
				{field: "line_no",width: 92,title: "Line No"},
				{field: "spool_no",width: 92,title: "Spool No"},       
				{field: "line_size",width: 92,title: "Line Size"},
				{field: "uqty",width: 92,title: "Unit Qty"},           
				{field: "ps_code",width: 92,title: "PS Code"},        
				{field: "ps_type",width: 127,title: "PS Type Fig No"},
				{field: "com_code",width: 97,title: "Commodity"},      
				{field: "supp_desc",width: 246,title: "Supp.Desc"},      
				{field: "mat_tag1",width: 92,title: "Mat Tag1"},       
				{field: "mat_tag2",width: 92,title: "Mat Tag2"},       
				{field: "ps_matl",width: 92,title: "PS Matl"},        
				{field: "ps_class",width: 92,title: "PS Class"},
				{field: "ps_specs",width: 92,title: "PS Specs"},       
				{field: "category",width: 92,title: "Category"},       
				{field: "wt_fab",width: 92,title: "WT Fag"},         
				{field: "um",width: 92,title: "UM"},             
				{field: "uwt",width: 92,title: "Unit Wt"},
				{field: "wt_client",width: 97,title: "WT Client"},      
				{field: "scope_supply",width: 123,title: "Scope Supply"},   
				{field: "scope_of_work",width: 138,title: "Scope Of Work"},
				{field: "tp_no",width: 138,title: "Testpack No"},
				{field: "p_no",width: 138,title: "Priority No"},
				{field: "p_timing",width: 138,title: "Priority Timing"},
				{field: "tp_ptiming",width: 138,title: "TP Priority Timing"},
				{field: "tp_pno",width: 138,title: "TP Priority No."},
				{field: "unit_area",width: 138,title: "Unit Area"},
				{field: "area_desc",width: 138,title: "Area Desciprtion"},
				{field: "lbsb",width: 138,title: "LB/SB"},
				{field: "piping_class",width: 138,title: "Piping Class"},
				{field: "err_remarks",title: "Erorr Remarks"}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
           }
           // ,
           // dataBound: addExtraStylingToGrid
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

				$("#importButt, #updateButt").prop("disabled", disImport);
				if (!disImport)
					$("#importButt, #updateButt").removeClass("k-state-disabled");

				$("#uploadBrowse").data("kendoGrid").dataSource.data(data.rows);
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
		$(".wrap-button button").bind({
			click: function(){
				switch(this.id){
					case "uploadButt":
						upload = $("#files").data("kendoUpload");
					break;
					default:
						open_preloader();
						var ds_total = dataSource.data().length;

						var rowList = [], columnList = [];
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
					        rowList.push(object);
						});

						postInfo = JSON.stringify({rows: rowList});
						$("#objStr").val(postInfo);
						postInfo = eval("(" + postInfo + ")");
						$.get(crudService + "directCall/psMto",{rows: $("#objStr").val()},
							function(data){
								showNotif((data.rows[0].return_value == 1) ? "Information" : "Warning",(data.rows[0].return_value == 1) ? "Upload Successful!" : "Upload Failed!",(data.rows[0].return_value == 1) ? "info" : "warning");
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