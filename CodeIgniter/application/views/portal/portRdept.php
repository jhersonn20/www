<style>
	#win_sub2-wrapper {
		margin-top: 0;
		padding: 0;
	}
	#win_sub2-wrapper .k-upload-files {width: 67%;}
	.buttonLeft {width: 50%;}
</style>
<div id="win_sub2-wrapper">
	<div class="wrap-form" style="width: 37.1%;float:right;height: auto;display: block;">
			<fieldset>
				<legend>Department Reference: </legend>
				<ul class="formRight_portal" style="width: 100%;">
					<li>
						<label class="title" for="txt1" style="width: 130px;">Department Code:</label><input type="text" required name="txt1" id="txt1" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt2" style="width: 130px;">Department Name:</label><input type="text" required name="txt2" id="txt2" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title"  style="width: 130px;">Status:</label><input type="radio" name="option" checked id="rad1" /><label class="title short" for="rad1" style="text-align: left;width: 50px;">Active</label>
																							<input type="radio" name="option" id="rad2" /><label class="title short" for="rad2" style="text-align: left;width: 50px;">Inactive</label>
					</li>
					<li style="text-align: right;">
						<hr style="margin-bottom: 5px;" />
						<div class="buttonRight">
				        	<button class="k-button" id="saveButt">Save</button>
				        	<button class="k-button" id="canButt">Cancel</button>
				        	<button class="k-button mainEve" id="addButt">Add</button>
				        	<button class="k-button mainEve" id="editButt">Edit</button>
				        	<button class="k-button mainEve" id="delButt">Delete</button>
					    </div>
											
					</li>
				</ul>
			</fieldset>
	</div>
	<div class="wrap-grid demo-section" style="width: 600px; float: left; height: auto;">
        <div id="dept_rs"></div>
    </div>
	
</div>

<script type="text/javascript">
	function grid_change(e){
		if (typeof e == "undefined")
			e = grid;
	    var selectedRows = e.select();
	    var selectedDataItems = [];
	    for (var i = 0; i < selectedRows.length; i++) {
	      dataItem = e.dataItem(selectedRows[i]);
		    $("#txt1").val(dataItem.dept_code);
		    $("#txt2").val(dataItem.dept_name);
		    $("#rad1").prop("checked",(dataItem.flg_status == 1));
		    $("#rad2").prop("checked",(dataItem.flg_status != 1));
		    
	    }   
	}
	function forDiv(){
		var container = $("#dept_rs");
		var position = container.offset();	
		var offsetHeight = container.height();	
		var offsetWidth = container.width();
		var newDiv = $("<div id = 'coverDiv' style = 'position: inital;'>").appendTo($("#dept_rs"));
		newDiv.offset(position);
		newDiv.height(offsetHeight);	
		newDiv.width(offsetWidth - 17);
	}
		
	$(document).ready(function(){ 
		var crudService = '/codeigniter/index.php/portal/' + "index/",
		    filterFArr_dept = [], filterOArr_dept = [], filterVArr_dept = [], log_user = '<?php echo $_POST['log_user']; ?>', department = '<?php echo $_POST['department']; ?>', isFailed = false;
		
		
		
		$("#win_sub2-wrapper .buttonRight button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();
		});
		
		$("#win_sub2-wrapper .buttonRight button").each(function(index,value){	
			if (department != 'MIS')
				$("#win_sub2-wrapper .buttonRight button").css({"display": "none"});
		});
			
        var dept_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/get_department",
                    contentType: "application/json",
                    type: "GET"
                    // complete: function(jqXHR, textStatus) {
	                	// if (jqXHR.responseText != '1')
							// showNotif('Warning',jqXHR.responseText,'warning');
	                // }				},
                create: {
                    url: crudService + "manage/department",
                    type: "POST",
	                complete: function(jqXHR, textStatus){
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else {
							dept_ds.page(dept_ds.page());
							$("#coverDiv").remove();
						}
						dept_ds.read();
	                }
                },
                update: {
                    url: crudService + "manage/department",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else {
							dept_ds.page(dept_ds.page());
							$("#coverDiv").remove();
						}
						dept_ds.read();
	                }
                },
                destroy: {
                    url: crudService + "remove/department",
                    type: "POST",
	                complete: function(jqXHR, textStatus){
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else
							dept_ds.page(dept_ds.page());
						dept_ds.read();
	                }
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : (typeof this.value == "boolean" ? (this.value ? 1 : 0) : this.value);
				      		filterFArr_dept[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_dept[index] = this.operator;
				      		filterVArr_dept[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_dept,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "dept_name"),
					    operator: (($(data.filter).length > 0) ? filterOArr_dept : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_dept : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "asc")
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
            pageSize: 10,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_dept.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_dept = [];
					    $("#dept_rs form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "id",
                    fields: {
                   	    id: { type: "number", editable: false },
                        dept_code:{ type: "string" },
                        dept_name:{ type: "string" }
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
	    	$("#dept_rs").data("kendoGrid").select("tr:eq(" + <?php echo $_POST['dl_ds_length']; ?> + ")");			$("#dept_rs > .k-grid-content > table > tbody > tr").hover(
	            function(){
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
			filterFArr_dept = [];
	    };

        var dept_rs = $("#dept_rs").kendoGrid({
            dataSource: dept_ds,
            selectable: "row",
            pageable: {
                buttonCount: 3,
    			input: true
            },
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: false,
			resizable: true,
            filterable: {
                extra: false
            },
            // height: 220,
            columns: [
               {field: "dept_code",title: "Department Code",width: 150},
               {field: "dept_name",title: "Department Name", width: 255}
           ],
           change: function(e){
			    if (!$("#saveButt").is(":hidden"))
			    	return true;
			    	
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			       dept_di = this.dataItem(selectedRows[i]);
			        
			    }
			    grid_change(currRow);			},
            dataBound: addExtraStylingToGrid		});
		insertGridTitle('#dept_rs','Departments');
        
        var toggleButt = function(vis){
	        $.each($("#dept_rs .k-grid-toolbar").find("a"),function(index, value){
	        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
        toggleButt("show");
        
        $(".wrap-form input").prop("disabled", true).addClass("k-state-disabled");		$(".wrap-form .buttonRight button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "delButt":
	    				if (!confirm("Do you really want to delete this item?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
						dataRow = dept_rs.data("kendoGrid").dataSource.getByUid(dataItem.uid);
						$("#dept_rs").data("kendoGrid").dataSource.remove(dataRow);
						dept_ds.sync();
						$("#dept_rs").data("kendoGrid").setDataSource(dept_ds);
						$("#dept_rs").data("kendoGrid").dataSource.page($("#dept_rs").data("kendoGrid").dataSource.page());
						$("#dept_rs").data("kendoGrid").dataSource.read();
	    				return true;
	    			break;
	    			case "canButt":
	    			case "saveButt":
						if(this.id == "saveButt"){
	    					if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
		    				}
		    				
		    				isFailed = verifyThisInput(".formRight_portal");
				    		if (isFailed)
				    			return true;
		    				
							if (cMode == "add"){
								dept_ds.add({	id: 0,
												dept_code: $("#txt1").val(),
												dept_name: $("#txt2").val(),
												flg_status: ($("#rad1").is(":checked") ? 1 : 0)});
								dept_ds.sync();
								$("#dept_rs").data("kendoGrid").setDataSource(dept_ds);
								$("#dept_rs").data("kendoGrid").dataSource.page($("#dept_rs").data("kendoGrid").dataSource.page());
								$("#dept_rs").data("kendoGrid").dataSource.read();
	
							}else
								$.post(crudService + "manage/department",{id: dataItem.id,dept_code: $("#txt1").val(), dept_name: $("#txt2").val(), flg_status: ($("#rad1").is(":checked") ? 1 : 0)},
						       	    function(data){
										$("#dept_rs").data("kendoGrid").setDataSource(dept_ds);
										$("#dept_rs").data("kendoGrid").dataSource.page($("#dept_rs").data("kendoGrid").dataSource.page());
										$("#dept_rs").data("kendoGrid").dataSource.read();
						       	    });							}else{
		    					$(".thisIsRequired").removeClass('thisIsRequired');
				    			isFailed = false;
					    		grid_change(currRow);
		    				}
		    				
							$("#win_sub2-wrapper .buttonRight button").each(function(index,value){
										if ($(this).hasClass("mainEve"))
											$(this).show();
										else
											$(this).hide();
									});
							$("#coverDiv").remove();
							if (isFailed)
			    			return true;
		    		break;
	    			default:
						$(".wrap-form input, .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");						if (this.id == "addButt"){
		    				isFailed = false;
		    				$(".wrap-form input").val("");
							$(".wrap-form input").eq(0).select().focus();
							$('#rad1').prop("checked", true);
							$('input[name=option]').prop("disabled", true);
							cMode = "add";
		    			}else {
							$("#txt1").prop("disabled", true).addClass("k-state-disabled");
							$("#txt2").select().focus();
							cMode = "edit";
						}
						forDiv();
						// $(".wrap-button button").prop("disabled", true).addClass("k-state-disabled");						$("#win_sub2-wrapper .buttonRight button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).hide();
							else
								$(this).show();
						});
					break;
	    		}
	    	}
	    });
        // $("#win_sub2-wrapper button").bind({
			// click: function(){
				// switch(this.id){
	    			// case "delButt":
	    				// if (!confirm("Do you really want to delete this item?")){
	    					// e.preventDefault();
	    					// return true;
	    				// }
// 	    				
    					// $("#client_rs").data("kendoGrid").dataSource.remove(client_di);
						// client_ds.sync();
						// client_ds.page(client_ds.page());
						// client_ds.read();
	    				// return true;
	    			// break;
	    			// case "saveButt":
	    			// case "canButt":			    			
	    				// if (this.id == "saveButt"){
		    				// if (!confirm("Are you sure you want to save this data?"))
		    					// return true;
// 	
		    				// $("#client_rs .k-grid-toolbar .k-grid-save-changes").trigger( "click" );
	    				// }else
	    					// $( "#client_rs .k-grid-toolbar .k-grid-cancel-changes" ).trigger( "click" );
// 	    						    				
						// $(".wrap-button button").each(function(index,value){
							// if ($(this).hasClass("mainEve"))
								// $(this).show();
							// else
								// $(this).hide();
// 								
							// if (($(".wrap-button button").length - 1) == index)
								// client_ds.read();
						// });
						// $("#coverDiv").remove();
	    			// break;
					// case "uplButt":
						// $("#win_sub2-wrapper #upload").css({"display": "block"});
// 						
						// $("#files_sub").kendoUpload({
							// async: {
								// saveUrl: crudService + ("save_upload/image/" + client_di['id']),
								// removeUrl: crudService + "remove_upload",
								// autoUpload: true
							// },
							// localization: {
								// dropFilesHere: "| Drop here..."
							// },
							// multiple: false,
							// select: onSelect,
							// success: onSuccess
						// });
					// break;
					// default:
		    			// if (this.id == "addButt"){
		    				// $("#client_rs").data("kendoGrid").addRow();
							// $("#client_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).find("input").focus();
		    			// }else {
		    				// if (typeof client_di == "string")
		    					// return true;
		    				// $("#client_rs").data("kendoGrid").editRow($("#client_rs").data("kendoGrid").select());
							// $("#client_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).find("input").select().focus();
		    			// }
// 	    				
						// $("#win_sub2-wrapper .wrap-button button").each(function(index,value){
							// if ($(this).hasClass("mainEve"))
								// $(this).hide();
							// else
								// $(this).show();
						// });
					// break;
				// }
	    	// }
		// });
	});
</script>
