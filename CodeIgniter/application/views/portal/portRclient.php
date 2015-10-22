<style>
	#win_sub2-wrapper {
		margin-top: 0;
		padding: 0;
	}
	#win_sub2-wrapper .k-upload-files {width: 67%;}
	.buttonLeft {width: 50%;}
</style>
<div id="win_sub2-wrapper">
    <div class="wrap-grid demo-section">
        <div id="client_rs"></div>
    </div>
	<div class="wrap-button demo-section apply8">
		<div class="buttonLeft">
        	<button class="k-button" id="saveButt">Save</button>
        	<button class="k-button" id="canButt">Cancel</button>
        	<button class="k-button mainEve" id="addButt">Add</button>
        	<button class="k-button mainEve" id="editButt">Edit</button>
        	<button class="k-button mainEve" id="delButt">Delete</button>
        	<button class="k-button mainEve" id="uplButt">Upload</button>
       	</div>
	</div>
	<form method="post" action="submit" id="upload" style="width: 100%;margin-bottom: 5px;display: none;">
        <div class="demo-section">
            <input name="files_sub" id="files_sub" type="file" accept=".gif,.png,.jpg" />
        </div>
    </form>	
</div>

<script type="text/javascript">
	$(document).ready(function(){ 
		var crudService = '/codeigniter/index.php/portal/' + "index/",
		    filterFArr_cli = [], filterOArr_cli = [], filterVArr_cli = [], client_di = "", log_user = '<?php echo $_POST['log_user']; ?>', department = '<?php echo $_POST['department']; ?>';
		
		$("#win_sub2-wrapper .wrap-button button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();
		});
		
		$("#win_sub2-wrapper .wrap-button button").each(function(index,value){	
			if (department != 'MIS' )
				if (department != 'MKTG' )
					$("#win_sub2-wrapper .wrap-button").css({"display": "none"});
		});
			
        var client_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/client",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/client",
                    type: "POST",
	                complete: function(jqXHR, textStatus){
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else {
							client_ds.page(client_ds.page());
							$("#coverDiv").remove();
						}
						client_ds.read();
	                }
                },
                update: {
                    url: crudService + "manage/client",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else {
							client_ds.page(client_ds.page());
							$("#coverDiv").remove();
						}
						client_ds.read();
	                }
                },
                destroy: {
                    url: crudService + "remove/client",
                    type: "POST",
	                complete: function(jqXHR, textStatus){
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else
							client_ds.page(client_ds.page());
						client_ds.read();
	                }
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : (typeof this.value == "boolean" ? (this.value ? 1 : 0) : this.value);
				      		filterFArr_cli[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_cli[index] = this.operator;
				      		filterVArr_cli[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_cli,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_time"),
					    operator: (($(data.filter).length > 0) ? filterOArr_cli : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_cli : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        }
			      }else {
			      	data['log_user'] = log_user;
			      	return data;
			      }
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 4,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_cli.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_cli = [];
					    $("#client_rs form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "id",
                    fields: {
                   	    id: { type: "number", editable: false },
                        short_desc: { type: "string", nullable: false, validation: {required: true} },
                        name: { type: "string", nullable: false, validation: {required: true} },
                        path: { type: "string", editable: false }
                    }
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

	    var addExtraStylingToGrid = function(){
			$("#client_rs").data("kendoGrid").select("tr:eq(" + <?php echo $_POST['dl_ds_length']; ?> + ")");
	        $("#client_rs > .k-grid-content > table > tbody > tr").hover(
	            function(){
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_cli = [];
	    };

        var client_rs = $("#client_rs").kendoGrid({
            dataSource: client_ds,
            selectable: "row",
            pageable: {
                buttonCount: 3,
    			input: true
            },
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: 'inline',
			toolbar: ["save","cancel"],
            resizable: true,
            filterable: {
                extra: false
            },
            // height: 220,
            columns: [
               {field: "short_desc",title: "Short Desc.",width: 150},
               {field: "name",title: "Name", width: 255},
               {field: "path",title: "Logo Path", 
                    template: kendo.template("<img src='#= path #' alt='#= path #' />")},
           ],
           change: function(e){
			    if (!$("#saveButt").is(":hidden"))
			    	return true;
			    	
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        client_di = this.dataItem(selectedRows[i]);
			        if (client_di.short_desc == "ARCC")			        	
			        	$("#editButt, #delButt").addClass("k-state-disabled").prop("disabled", true);			        	
			        else			        	
			        	$("#editButt, #delButt").removeClass("k-state-disabled").prop("disabled", false);
			    }
           },
           dataBound: addExtraStylingToGrid
        });
		$("#client_rs .k-grid-toolbar").hide();
        insertGridTitle('#client_rs','Client Reference');
        
        var onSelect = function(e){
        	if ($.inArray(e.files[0].extension.toLowerCase(),['.gif','.png','.jpg']) < 0){
				showNotif("Information","Select failed. Upload accepts image files only!","info");
        		e.preventDefault();
        		return true;
        	}
		    fileName = e.files[0].name;
        		
        	if ($("#win_sub2-wrapper .k-upload-files > li").length == 0)
        		return true;

        	$("#win_sub2-wrapper .k-upload-files > li").eq(0).remove();

			$("#win_sub2-wrapper #importButt, #win_sub2-wrapper #updateButt").prop("disabled", true).addClass("k-state-disabled");
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
			client_ds.read();			
			close_preloader();
			$("#win_sub2-wrapper #upload").css({"display": "none"});
        }
		
		$("#win_sub2-wrapper button").bind({
			click: function(){
				switch(this.id){
	    			case "delButt":
	    				if (!confirm("Do you really want to delete this item?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
    					$("#client_rs").data("kendoGrid").dataSource.remove(client_di);
						client_ds.sync();
						client_ds.page(client_ds.page());
						client_ds.read();
	    				return true;
	    			break;
	    			case "saveButt":
	    			case "canButt":			    			
	    				if (this.id == "saveButt"){
		    				if (!confirm("Are you sure you want to save this data?"))
		    					return true;
	
		    				$("#client_rs .k-grid-toolbar .k-grid-save-changes").trigger( "click" );
	    				}else
	    					$( "#client_rs .k-grid-toolbar .k-grid-cancel-changes" ).trigger( "click" );
	    						    				
						$(".wrap-button button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).show();
							else
								$(this).hide();
								
							if (($(".wrap-button button").length - 1) == index)
								client_ds.read();
						});
						$("#coverDiv").remove();
	    			break;
					case "uplButt":
						$("#win_sub2-wrapper #upload").css({"display": "block"});
						
						$("#files_sub").kendoUpload({
							async: {
								saveUrl: crudService + ("save_upload/image/" + client_di['id']),
								removeUrl: crudService + "remove_upload",
								autoUpload: true
							},
							localization: {
								dropFilesHere: "| Drop here..."
							},
							multiple: false,
							select: onSelect,
							success: onSuccess
						});
					break;
					default:
		    			if (this.id == "addButt"){
		    				$("#client_rs").data("kendoGrid").addRow();
							$("#client_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).find("input").focus();
		    			}else {
		    				if (typeof client_di == "string")
		    					return true;
		    				$("#client_rs").data("kendoGrid").editRow($("#client_rs").data("kendoGrid").select());
							$("#client_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).find("input").select().focus();
		    			}
	    				
						$("#win_sub2-wrapper .wrap-button button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).hide();
							else
								$(this).show();
						});
					break;
				}
	    	}
		});
	});
</script>
