<style>
	.k-upload-files {width: 625px;}
	.buttonLeft {width: 50%;}
	.k-grid-content {height: 285px;}
</style>
    <div class="client_name">
    	<?php echo $client_name; ?>
	</div>
    <div id="tabstrip" class="login">
		<ul>
		    <li class="k-state-active login">
		    	Upload
		    </li>
		    <li class="login">
		    	Download
		    </li>
		</ul>
		<div class="login">
			<div class="wrap-system">
				<form method="post" action="submit" style="width: 100%;margin-bottom: 5px;">
			        <div class="demo-section">
			            <input name="files" id="files" type="file" />
			        </div>
			    </form>	
			    <div class="wrap-grid demo-section" style="width: 98.8%;">
			        <div id="rowSelection"></div>
			    </div>
			    <div class="module_footer">
					<hr style="margin: 3px 0;" />
					<button name="delButt" id="delButt" class="k-button k-state-disabled" disabled> Delete </button>
			    </div>
			</div>
		</div>
		<div class="login">
			<div class="wrap-system">
			    <div class="wrap-grid demo-section" style="width: 98.8%;">
			        <div id="dl_rs"></div>
			    </div>
			    <div class="module_footer">
					<hr style="margin: 3px 0;" />
					<button name="open" id="open" class="k-button k-state-disabled" disabled style="display: none;"> Open </button>
					<button name="download" id="download" class="k-button k-state-disabled" disabled> Download </button>
			    </div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){	
		var crudService = crudServiceBaseUrl + "index/",
			// client = pathname.split('/')[pathname.split('/').length - 1],
			client = <?php echo (isset($client_id)) ? $client_id : 0; ?>, user = <?php echo (isset($user_pk)) ? $user_pk : 0; ?>,
		    filterFArr = [], filterOArr = [], filterVArr = [], checkedIds = {}, log_user = '<?php echo $user_id; ?>',
		    filterFArr_ds = [], filterOArr_ds = [], filterVArr_ds = [], fileName = "", var_cds = {}, file_types = "";		
        				
        // $("#arccMenu").append("<a href='/codeIgniter/index.php/portal'> Home </a>");
        
	    $.post("/codeIgniter/index.php/portal/index/file_ref",{type: "get"},
	    	function(data){
	    		if (data != ""){
	    			file_types = data.split(",");
	    		}
	    	}); 
        				
        $("#tabstrip").kendoTabStrip({
        	activate: function(e){
        		var tabStrip = $("#tabstrip").data("kendoTabStrip");
        		if ($('ul.k-tabstrip-items > li').index($("li.k-state-active")) == 0)
        			dataSource.read();
        		else
        			dl_ds.read();
        		//alert(tabStrip.select());
        		//console.log();
        	},
            animation:  {
                open: {
                    effects: "fadeIn"
                }
            }
        });		
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/files",
                    contentType: "application/json",
                    type: "GET"
                },
                destroy: {
                    url: crudService + "remove/files",
                    type: "POST",
	                complete: function(jqXHR, textStatus){
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else
							dataSource.page(dataSource.page());
						dataSource.read();
	                }
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
				    filterFArr[0] = "client_id;" + client + ";eq";
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
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_time"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        }
			      }else
			      	return data;
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
               		showNotif("Information","No records found!","information");
					filterFArr = [];
					$("form.k-filter-menu button[type='reset']").trigger("click");
               	}
               },
               model: {
               		id: "id",
                    fields: {
                   	    id: {type: "number", editable: false},
				        name: {type: "string", editable: false},
				        remarks: {type: "string", editable: false},
				        log_created: {type: "string", editable: false}
                    }
               },
               total: function(response) {
				   	return (($(response.rows[0]).length > 0) ? response.rows[0].total : 0); //$(response.rows).length;				   	
			   }
            },
            change: function(e) {
            	if ($(e.items).length == 0)
            		return true;
			    $("#delButt").addClass('k-state-disabled').prop("disabled",true);
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
        
        var rowSelection = $("#rowSelection").kendoGrid({
            dataSource: dataSource,
            selectable: "row",
            pageable: {
                buttonCount: 5,
                refresh: true,
                pageSizes: true,
    			input: true
            },
            autoBind: true,
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
		       {field: "name",width: 234,title: "Name"},
		       {field: "remarks",width: 480,title: "Remarks"},
		       {field: "log_created",title: "Logs"}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			        $("#delButt").removeClass('k-state-disabled').prop("disabled",false);
			    }
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle("#rowSelection","List of Files");
        
        var dl_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/files",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
				    filterFArr_ds[0] = "client_id;15;" + (client == 15 ? "neq" : "eq");
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_ds[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_ds[index] = this.operator;
				      		filterVArr_ds[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_ds,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_time"),
					    operator: (($(data.filter).length > 0) ? filterOArr_ds : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_ds : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    type_of_trans: (client == 15 ? "" : "download"),
					    client_id: client,
					    user_id: user
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
               	if (filterFArr_ds.length > 0 && $(data.rows).length == 0){
               		showNotif("Information","No records found!","information");
					filterFArr_ds = [];
					$("form.k-filter-menu button[type='reset']").trigger("click");
               	}
               },
               model: {
               		id: "id",
                    fields: {
                   	    id: {type: "number", editable: false},
				        name: {type: "string", editable: false},
				        remarks: {type: "string", editable: false},
				        log_created: {type: "string", editable: false}
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
                                
	    var addExtraStylingToGrid_dl = function () {
			$("#dl_rs").data("kendoGrid").select("tr:eq(" + (dataSource._data.length + 2) + ")");
	        $(".k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_ds = [];
	    };

		//on dataBound event restore previous selected rows:
		var onDataBound = function (e) {
			var view = this.dataSource.view();
			/*$.each(checkedIds, function(index,value){
				alert(index + ", " + value);
			});*/
			for(var i = 0; i < view.length;i++){
				if (checkedIds[view[i].id] == undefined)
					checkedIds[view[i].id] = $("#file_chk").is(":checked");
			    //alert("View: " + view[i].id + ", " + view[i].PROGRESS_RECID);
				if(checkedIds[view[i].id]){
					this.tbody.find("tr[data-uid='" + view[i].uid + "']")
						.addClass("k-state-selected")
						.find("input[type=checkbox]")
						.prop("checked","checked");
				}
			}			
		}
	    
	    var columns_rs = [
				{
					headerTemplate:'<input id="file_chk" name="file_chk" type="checkbox" />',
					title: ' ',
                    template: kendo.template("<input type='checkbox' name='#= id #' id='#= id #' />"),
					width: 28
				},
		       {field: "name",width: 290,title: "Name"},
		       {field: "remarks",width: 350,title: "Remarks"},
		       {field: "log_created",title: "Logs"}
        ];
           
        if (client == 15){
			insertArrayAt(columns_rs,0,{field: "client_name",title: "Client Name", width: 100});
        }
        
        var dl_rs = $("#dl_rs").kendoGrid({
            dataSource: dl_ds,
            selectable: "multiple,row",
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
            columns: columns_rs,
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dl_di = this.dataItem(selectedRows[i]);
			        	
				    var rowIndex = $("tr", this.tbody).index(selectedRows[i]),
				        row = this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
					checkedIds[dl_di.id] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").is(":checked");
					if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").is(":checked") == false) {
						$("#file_chk").prop("checked",false);
				        $("#open").addClass("k-state-disabled").prop("disabled", true);
					}else {	
				        typeArr = dl_di.name.split(".");
				        // alert(typeArr[typeArr.length - 1] + " " + (typeArr[typeArr.length - 1] != "pdf"));
				        if (typeArr[typeArr.length - 1] != "pdf")
				        	$("#open").addClass("k-state-disabled").prop("disabled", true);
				        else
				        	$("#open").removeClass("k-state-disabled").prop("disabled", false);					
					}
	           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").is(":checked"));
	           		
	           		var disable_dl = true, cids_cnt = 0;	           		
	           		$.each(checkedIds,function(index,value){
	           			if (value){
							$('#download').removeClass('k-state-disabled').prop("disabled", false);
							disable_dl = false;
					        typeArr = dl_di.name.split(".");
					        // alert(typeArr[typeArr.length - 1] + " " + (typeArr[typeArr.length - 1] != "pdf"));
					        if (typeArr[typeArr.length - 1] != "pdf")
					        	$("#open").addClass("k-state-disabled").prop("disabled", true);					        	
					        else {
								++cids_cnt;
								if (cids_cnt > 1)
					        		$("#open").addClass("k-state-disabled").prop("disabled", true);
					        	else
					        		$("#open").removeClass("k-state-disabled").prop("disabled", false);
					        }		
							// return false;
						}
						if (disable_dl)
							$('#download').addClass('k-state-disabled').prop("disabled", true);
	           		});
			    }
           },
           // dataBound: addExtraStylingToGrid_dl
           dataBound: onDataBound
        });
        insertGridTitle("#dl_rs","List of Files");
		$('#dl_rs tbody').on('click',':checkbox',function(){
			if (this.checked){
				var grid2 = $('#dl_rs').data("kendoGrid");
			    //var row = grid2.dataItem($(this).closest('tr'));
			    var row = $(this).closest('tr'),
			        rowIndex = $("tr", grid2.tbody).index(row),
			        row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
			    grid2.select(row);
				$('#download').removeClass('k-state-disabled').prop("disabled", false);
			}else{
				$('tr.k-state-selected','#dl_rs').removeClass('k-state-selected');
				$('#download').addClass('k-state-disabled').prop("disabled", true);
			}
		    //alert($("tr", grid2.tbody).index(row)); //$(this).is(':checked')
		    /*if($(this).is(':checked')){        
		        array[id] = true;
		    }else{
		    	array[id] = false;
		    }*/
		});
		$('input[type=checkbox]').on('click',function(){
			if (this.checked){
				var grid2 = $('#dl_rs').data("kendoGrid");
			    //var row = grid2.dataItem($(this).closest('tr'));
			    var row = $(this).closest('tr'),
			        rowIndex = $("tr", grid2.tbody).index(row),
			        row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
			    grid2.select(row);
				$('#download').removeClass('k-state-disabled').prop("disabled", false);
			}else{
				$('tr.k-state-selected','#dl_rs').removeClass('k-state-selected');
				$('#download').addClass('k-state-disabled').prop("disabled", true);
			}
			$('#open').addClass('k-state-disabled').prop("disabled", true);
		    //alert($("tr", grid2.tbody).index(row)); //$(this).is(':checked')
		    /*if($(this).is(':checked')){        
		        array[id] = true;
		    }else{
		    	array[id] = false;
		    }*/
		});		
		$("#file_chk").click(function () {
			var grid2 = $('#dl_rs').data("kendoGrid")
			    currStat = this.checked;
		    $("#dl_rs tbody input:checkbox").each(function(index,value){
		    	$(this).prop("checked", currStat);
			    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
			    var dataItem2 = grid2.dataItem(row);
				checkedIds[dataItem2.id] = currStat;
				if (currStat){
				    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#dl_rs').addClass('k-state-selected');
					$('#download').removeClass('k-state-disabled').prop("disabled", false);
					//grid2.select(row);
				}else {
					$('tr.k-state-selected','#dl_rs').removeClass('k-state-selected');
					$('#download').addClass('k-state-disabled').prop("disabled", true);
				}
			});
		});
        
        var onSelect = function(e){        	
        	if (((e.files[0].size / 1024) / 2014) > <?php echo (int)(ini_get('upload_max_filesize')); ?>){
				showNotif("Information","Select failed. Selected file size is greater than the maximum upload file size!","info");
        		e.preventDefault();
        		return true;        		
        	}
        	if ($.inArray(e.files[0].extension.replace(".",""),file_types) < 0){
				showNotif("Information","Select failed. Selected file type is not part of the acceptable file types!","info");
        		e.preventDefault();
        		return true;
        	}
		    fileName = e.files[0].name;		
			
			// if (client == 15){
				$("#window").data("kendoWindow").setOptions({
				    title: "Client's Remarks",
				    width: "450px",
				    close: function(){}
				});
				$("#window").data("kendoWindow").refresh({
					url: "/codeIgniter/index.php/portal/index/direct_to/portRclient_rem",
					type: "POST",
					data: {}
				});
		        $("#window").data("kendoWindow").center().open();
		    // }
        		
			$(".k-upload").css({"min-height": (((e.files.length * 30) + 10) + "px")});
			upload_count = e.files.length;
        	if ($(".k-upload-files > li").length == 0)
        		return true;

        	$(".k-upload-files > li").remove();
        		
        	// if ($(".k-upload-files > li").length == 0)
        		// return true;
// 
        	// $(".k-upload-files > li").eq(0).remove();
    		// var raw = dataSource.data();
		    // var length = raw.length;
		    // var item, i;
// 		
		    // for(i=length-1; i>=0; i--){
		        // item = raw[i];
		        // dataSource.remove(item);
		    // }

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
        	showNotif("Information","Success","information");
			open_preloader();
			dataSource.read();
			close_preloader();
        }
        
		$("#files").kendoUpload({
			async: {
				saveUrl: crudService + "save_upload/document/" + client,
				removeUrl: crudService + "remove_upload",
				autoUpload: false
			},
			localization: {
				dropFilesHere: "| Drop here..."
			},
			multiple: true,
			select: onSelect,
			success: onSuccess,
			upload: function(e){	
		    	e.data = {client_ids: '15,', remarks: remarks_txt};	
			},
			remove: function(e){
				$(".k-upload").css({"min-height": (((($(".k-upload-files > li").length - 1) * 30) + 10) + "px")});
			},
			error: function(e){
				showNotif("Warning",e.XMLHttpRequest.responseText,"warning");
			}
		});
		
		$("#arccWrap button").bind({
			click: function(e){
				switch(this.id){
					case "open":
						$("#window").data("kendoWindow").setOptions({
						    title: dl_di.name,
						    width: "900px",
						    height: "600px"
						});
						$("#window").data("kendoWindow").refresh({
						    url: "http://" + $(location).attr('hostname') + "/documents/15/" + dl_di.name,
						    contentType: "application/pdf"
						});
				        $("#window").data("kendoWindow").center().open();
				        $.post("/codeIgniter/index.php/portal/index/manage/files",{id: dl_di.id, log_client: client, log_user: log_user, date_open: kendo.toString(new Date(),"yyyy-MM-dd")},
				        	function(data){
				       	    	if (data != '1')
									showNotif('Warning',data,'warning');
				        	});
						break;
	    			case "delButt":
	    				if (!confirm("Do you really want to delete this item?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
    					$("#rowSelection").data("kendoGrid").dataSource.remove(dataItem);
						dataSource.sync();
						dataSource.page(dataSource.page());
						dataSource.read();
	    				return true;
	    			break;
					default:
						open_preloader();
						var files_in_zip = "",
							this_button = this.id;
						$.each(checkedIds, function(index,value){
							if (value)
								files_in_zip += index + ",";
						});
						
						if (files_in_zip == "")
							return true;
						
					    var link = document.createElement('a');
				        link.href = crudService + "compress/?";
				        link.href += ("ids=" + files_in_zip + "&");
				        link.href += ("page=" + dataSource.page() + "&");
				        link.href += ("pageSize=" + dataSource.pageSize() + "&");
				        link.href += ("fieldS=log_time&dir=desc");
				 
				        //Dispatching click event.
				        if (document.createEvent) {
				            var e = document.createEvent('MouseEvents');
				            e.initEvent('click' ,true ,true);
				            link.dispatchEvent(e);
					    	close_preloader();
					    	if (this_button == "download")
					    		dataSource.read();
				            return true;
				        }
						break;					
				}
			}
		});
	});
</script>
