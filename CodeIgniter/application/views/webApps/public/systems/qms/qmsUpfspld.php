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
        	uplList = [], disImport, errCounter,fileName = "";
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
                   	    PROGRESS_RECID: {type: "number", editable: false},
                   	    release_date: {type: "date"},
                   	    qc_release_date: {type: "date"},
                   	    qc_fwhse_recvd_date: {type: "date"},
                   	    fwhse_pntg_recvd_date: {type: "date"},
                   	    pntg_blasting_date: {type: "date"},
                   	    pntg_primer_date: {type: "date"},
                   	    pntg_intermediate_date: {type: "date"},
                   	    pntg_painted_date: {type: "date"},
                   	    pntg_release_date: {type: "date"}                   	    
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
		       {field: "pip_iso_no",width: 114,title: "Piping ISO No."},          
		       {field: "spool_no",width: 90,title: "Spool No."},          
		       {field: "release_no",width: 131,title: "NDE Release No."},          
		       {field: "release_date",width: 140,title: "NDE Release Date"},          
		       {field: "qc_release_no",width: 121,title: "QC Release No"},          
		       {field: "qc_release_date",width: 132,title: "QC Release Date"},          
		       {field: "qc_fwhse_recvd_date",width: 191,title: "QC-FABWHSE Recvd. Date"},          
		       {field: "fwhse_pntg_recvd_date",width: 205,title: "FABWHSE-PNTG Recvd. Date"},          
		       {field: "pntg_blasting_date",width: 148,title: "PNTG Blasting Date"},          
		       {field: "pntg_primer_date",width: 136,title: "PNTG Primer Date"},          
		       {field: "pntg_intermediate_date",width: 181,title: "PNTG Intermediate Date"},          
		       {field: "pntg_painted_date",width: 146,title: "PNTG Painted Date"},          
		       {field: "pntg_release_no",width: 135,title: "PNTG Release No"},          
		       {field: "pntg_release_date",width: 147,title: "PNTG Release Date"},          
		       {field: "spool_category",width: 124,title: "Spool Category"},  
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
					if ($.trim(this.pip_iso_no) == "" || $.trim(this.pip_iso_no).indexOf("DRAWING") == 0)
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
							row['logupdate'] = "Upload WENDS Fabricated Spool Data";
							row['PROGRESS_RECID'] = 0;
							row['index'] = index;
							row['file_origin'] = fileName;
							postInfo = JSON.stringify(row);
							postInfo = eval("(" + postInfo + ")");

							$.post(crudService + "manage/fsplMto",postInfo,
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
						//$("#files").data("kendoUpload").disable();
						close_preloader();
					break;
				}
			}
		});
	});
</script>