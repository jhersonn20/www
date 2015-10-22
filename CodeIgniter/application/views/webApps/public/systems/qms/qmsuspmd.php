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
        	<button type="button" class="k-button k-state-disabled" id="updateButt" disabled>Update</button>
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
	            {field: "vendor",width: 92,title: "Vendor"},                    
				{field: "unit  ",width: 92,title: "Unit"},                      
				{field: "priority",width: 92,title: "Priority"},                  
				{field: "cphase",width: 104,title: "Cnstr Phase"},               
				{field: "strid ",width: 105,title: "Structural ID"             },
				{field: "strdesc",width: 166,title: "Structural Description"},    
				{field: "arealoc",width: 116,title: "Area Location"},             
				{field: "areasub",width: 92,title: "Sub Area"},                  
				{field: "des_dwg",width: 125,title: "Design Drawing"},            
				{field: "rev",width: 92,title: "Rev. No."},                  
				{field: "ere_dwg",width: 134,title: "Erection Drawing"},          
				{field: "sht",width: 92,title: "Sht. No."},                  
				{field: "fab_dwg",width: 153,title: "Fabrication Drawing"},       
				{field: "pcmark",width: 92,title: "PC Mark"},                   
				{field: "gl",width: 92,title: "GL"},                        
				{field: "pr",width: 92,title: "PR"},                        
				{field: "elev",width: 96,title: "ELEVATION"},                 
				{field: "stlprof",width: 129,title: "Structutal Profile"},        
				{field: "descrip",width: 95,title: "Description"},               
				{field: "qty",width: 92,title: "Qty"},                       
				{field: "zlength",width: 92,title: "Length"},                    
				{field: "w_asbly",width: 137,title: "Weight Assembly"},           
				{field: "tw_1",width: 136,title: "Total Weight(KG)"},          
				{field: "tw_2",width: 152,title: "Total Weight(TONS)"        },
				{field: "stlcateg",width: 151,title: "Structural Category"},       
				{field: "fpreq",width: 134,title: "Fireproof Require"},         
				{field: "fpperi",width: 113,title: "Fireproof Peri"},            
				{field: "fppyro",width: 113,title: "Fireproof Pyro"},            
				{field: "fpgunite",width: 126,title: "Fireproof Gunite"},          
				{field: "fastener",width: 92,title: "Fastener"},                  
				{field: "pntg_w_per",width: 203,title: "Painting Weight Percentage"},
				{field: "strl_remarks",width: 147,title: "Structural Remarks"},        
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
					if ($.trim(this.pcmark) == "" || $.trim(this.pcmark).indexOf('pcmark') == 0)
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
						if (!confirm("Do you want to update the following database table in related to Structural Piece Mark Data ?\nPIECE-STRUC\nISO-STRUC"))
							return true;
							
						open_preloader();
						$.post(crudService + "directCall/callSP_str",{},
							function(data){
								showNotif((data.rows[0].return_value == 1) ? "Information" : "Warning",(data.rows[0].return_value == 1) ? "Update Successful!" : "Update Failed!",(data.rows[0].return_value == 1) ? "info" : "warning");
							});
							
						$(this).prop("disabled", true).addClass("k-state-disabled");
						$("#files").data("kendoUpload").enable();
						close_preloader();
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
							row['file_origin'] = fileName;
							postInfo = JSON.stringify(row);
							postInfo = eval("(" + postInfo + ")");

							$.get(crudService + "manage/strMto",postInfo,
								function(data){
									if ((ds_total - 1) == index)
										showNotif((data.rows[0].return_value == 1) ? "Information" : "Warning",(data.rows[0].return_value == 1) ? "Upload Successful!" : "Upload Failed!",(data.rows[0].return_value == 1) ? "info" : "warning");
								});
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