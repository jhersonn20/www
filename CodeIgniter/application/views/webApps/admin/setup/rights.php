<style>
	@-moz-document url-prefix() {
		.rightsBox, .rightsBox2 {
			width: 48.5% !important;
		}
		.wrap-selection {
			height: 410px;
		}
	}
</style>
<div class="wrap-selection">	
	<div class="rightsBox mainContent" style="float: left;width: 49.5%;">
	    <span class="title" style="margin-top: 5px;" disabled> Application Rights: Users </span>
	    <div class="wrap-grid demo-section">
	        <div id="rowSelection"></div>
	    </div>
	</div>
	<div class="rightsBox2 mainContent" style="float: right;width: 49.5%;">
	    <span class="title" style="margin-top: 5px;" disabled> Application Rights: Application/s </span>
	    <div class="wrap-grid demo-section">
	        <div id="rowSelection2"></div>
	    </div>
	</div>
</div>
<div class="wrap-form demo-section">
	<ul>
		<li style="text-align: center;">
			<input type="radio" name="rad1" id="rad1" checked disabled><label class="title chk" for="rad1">Normal Access</label>
			<input type="radio" name="rad1" id="rad2" disabled><label class="title chk" for="rad2">Junior System Administrator</label>
			<input type="radio" name="rad1" id="rad3" disabled><label class="title chk" for="rad3">System Administrator</label>
		</li>
		<li>
			<select name="appName" id="appName" style="width: 100%;" disabled></select>			
		</li>
		<li>
			<select name="grpName" id="grpName" style="width: 100%;" disabled></select>			
		</li>
	</ul>	
</div>
<div class="wrap-button demo-section">
	<div class="buttonLeft">
		<button type="button" class="k-button" id="saveButt">Save</button>
		<button type="button" class="k-button" id="canButt">Cancel</button>
		<button type="button" class="k-button mainEve" id="addButt">Add</button>
		<button type="button" class="k-button mainEve" id="editButt">Edit</button>
		<button type="button" class="k-button mainEve" id="delButt">Delete</button>
	</div>
	<div class="buttonRight">
		<button type="button" class="k-button mainEve" id="deButt">Change Status</button>
	</div>				
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var currRow, currRow2, appName, grpName, cMode,
		crudService = crudServiceBaseUrl + "ln_setup/",
		sentValue = "";
		
		appName = $("#appName").kendoComboBox({
			highlightFirst: false,
            filter: "contains",
            placeholder: "Application Name...",
            dataTextField: "appl_name",
            dataValueField: "appl_code",
            enable: false,
            dataSource: {
                transport: {
                    read: crudServiceBaseUrl + "ln_reference/directCall/appl"
                },
                schema: {
                    data: function(data) {
                        return data.rows || [];
                    }
                }
            },
            change: function(e){
            }
        }).data("kendoComboBox");
		
		grpName = $("#grpName").kendoComboBox({
			highlightFirst: false,
			autoBind: false,
            filter: "contains",
            cascadeFrom: "appName",
            placeholder: "Group Description...",
            dataTextField: "group_desc",
            dataValueField: "group_code",
            enable: false,
            dataSource: {
                transport: {
                    read: {
                    	url: crudServiceBaseUrl + "ln_rgroup/directCall/"
                    }
                },
                schema: {
                    data: function(data) {
                        return data.rows || [];
                    }
                }
            },
            change: function(e){},
            dataBound: function(e){}
        }).data("kendoComboBox");
        
		var grid_change = function(e){
			if (typeof e == "undefined")
				e = grid;
		    selectedRows = e.select();
		    var selectedDataItems = [];
		    for (var i = 0; i < selectedRows.length; i++) {
		        dataItem = e.dataItem(selectedRows[i]);
		        $("#appName").data("kendoComboBox").value(dataItem.appl_code);
		        $("#grpName").data("kendoComboBox").value(dataItem.group_code);
		        $("#rad2").prop("checked",dataItem.appl_jsu);
		        $("#rad3").prop("checked",dataItem.appl_su);
		    }   
		}
        
		var forDiv = function(){
			var container = $(".wrap-selection");
			var position = container.offset();
			var offsetHeight = container.height();
			var offsetWidth = container.width();
			var newDiv = $("<div id = 'coverDiv'>").appendTo($("body"));
			newDiv.offset(position);
			newDiv.height(offsetHeight);
			newDiv.width(offsetWidth - 17);
		}
		
	    var addExtraStylingToGrid = function () {
			$("#rowSelection").data("kendoGrid").select("tr:eq(1)"); //highlight the first row of the table
	        $("#rowSelection > .k-grid-content > table > tbody > tr").hover( //use k-grid only when scrollable is set to false			          
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
	    };
                
		var dataSource = new kendo.data.DataSource({
			transport: {
				read: {
					url: crudService + "directCall/users/",
                    contentType: "application/json",
                    type: "GET"
				},
			    parameterMap: function(data, type) {
			      if (type == "read") {
		      		var filterFArr = [],
		      		    filterOArr = [],
		      		    filterVArr = [];
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr[index] = this.operator;
				      		filterVArr[index] = valForm;
				      	});
				      	/*if (filterFArr.length){
				      		$.each(filterFArr,function(index,value){
								alert(index + ", " + value);
				      		});
				      	}
				      	return false;*/
				    }
				    if ($('input[name=option]:checked').index('input[name=option]') > 0)
				     	filterFArr[filterFArr.length] = optionArr[$('input[name=option]:checked').index('input[name=option]')] + ";" + sentValue + ";eq";
			        return {
			          page: data.page,
			          pageSize: data.pageSize,
			          top: data.take,
			          skip: data.skip,
					  fieldF: filterFArr,
					  fieldS: ($(data.sort).length ? data.sort[0].field : "logtime"),
					  operator: (($(data.filter).length > 0) ? filterOArr /*data.filter.filters[0].operator*/ : "contains"),
					  value: (($(data.filter).length > 0) ? filterVArr /*data.filter.filters[0].value*/ : sentValue),
					  dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        }
			      }
			    }
            },
            pageSize: 10,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
	        error: function(e) {
	        	//$.each(e, function(index,value){
	        	//	if (typeof value == "object"){
	        	//		$.each(this, function(index2,value2){
	        	//			alert(index2 + "," + value2);
	        	//		});
	        	//	}
	        	//});
	            //alert(e.responseText);
               	if (filterFArr.length > 0 && $(data.rows).length == 0){
               		alert("No records found!");
					sentValue = "";
					$("form.k-filter-menu button[type='reset']").trigger("click");
               		//grid.data("kendoGrid").dataSource.read();
               	}
	        },
			schema: {
				data: function(data){
                    return data.rows || [];
				},
               model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    user_id: {type: "string"},
                   	    user_name: {type: "string"}
                    }
               },
               total: function(response) {
				   	return (($(response.rows[0]).length > 0) ? parseInt(response.rows[0].total) : 0);
			   }
            }
		});
	    
		var grid = $("#rowSelection").kendoGrid({
			dataSource: dataSource,
            selectable: "row",
            pageable: {
                buttonCount: 5
            },
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: false,
            autoBind: true,
            filterable: {
                extra: false
                /*,
                operators: {
                    string: {
                        startswith: "Starts with",
                        eq: "Is equal to",
                        neq: "Is not equal to"
                    }
                }*/
            },
			columns: [
				{
					field: 'user_id',
					title: 'ID',
					width: "30px"
				},
				{
					field: 'user_name',
					title: 'Users',
					width: "100px"
				}
			],
           change: function(e){
           		currRow = this;
			    selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
			    dataSource2.transport.options.read.url = crudService + "directCall/rightsApp/" + dataItem.user_id;
				dataSource2.read();
           },
           dataBound: addExtraStylingToGrid
		});
		var dataSource2 = new kendo.data.DataSource({
			transport: {
				read: {
					url: crudService + "directCall/rightsApp",
                    contentType: "application/json"
				},
				create: {
					url: crudService + "manage/rightsApp",
                    type: "POST"
				},
				update: {
					url: crudService + "manage/rightsApp",
                    type: "POST"
				},
				destroy: {
					url: crudService + "remove/rightsApp",
                    type: "POST"
				},
			    parameterMap: function(data, type) {
			      if (type == "read") {
			        return {
			          page: data.page,
			          pageSize: data.pageSize,
			          top: data.take,
			          skip: data.skip,
					  //fieldF: optionArr[$('input[name=option]:checked').index('input[name=option]')],
					  fieldS: ($(data.sort).length ? data.sort[0].field : "logtime"),
					  //operator: "contains",
					  //value: sentValue,
					  dir: ($(data.sort).length ? data.sort[0].dir : "")
			        }
			      }else {
			      	return data;
			      }
			    }
            },
            pageSize: 10,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
	        error: function(e) {
	        	//$.each(e, function(index,value){
	        	//	if (typeof value == "object"){
	        	//		$.each(this, function(index2,value2){
	        	//			alert(index2 + "," + value2);
	        	//		});
	        	//	}
	        	//});
	            alert(e.responseText);
	        },
			schema: {
				data: function(data){
                    return data.rows || [];
				},
               model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: {type: "number", editable: false},
                   	    appl_code: {type: "string"},
                   	    group_code: {type: "string"},
                   	    appl_jsu: {type: "number"},
                   	    appl_su: {type: "number"},
                   	    appl_stat: {type: "number"}
                    }
               },
               total: function(response) {
				   	return (($(response.rows[0]).length > 0) ? parseInt(response.rows[0].total) : 0);
				   //return $(response.rows).length;
			   }
			}
		});
	    
		var grid2 = $("#rowSelection2").kendoGrid({
			dataSource: dataSource2,
            selectable: "row",
            pageable: {
                buttonCount: 5,
                refresh: true
            },
            groupable: false,
            autoBind: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: false,
			columns: [
				{
					field: 'appl_code',
					title: 'Application',
					width: "60px"
				},
				{
					field: 'group_code',
					title: 'Group',
					width: "60px"
				},
				{
					field: 'appl_jsu',
					title: 'JSA',
					width: "20px"
				},
				{
					field: 'appl_su',
					title: 'SA',
					width: "20px"
				},
				{
					field: 'appl_stat',
					title: 'Status',
					width: "20px"
				}
			],
           change: function(e){
           		currRow2 = this;
			    selectedRows2 = this.select();
			    var selectedDataItems = [];
			    grid_change(this);
			    grpName.enable(false);
           }
		});

		$(".wrap-button button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();									
		});
		$(".wrap-button button").bind({
			click: function(){
				switch (this.id){
					case "addButt":
						$(".wrap-form input, .wrap-form select").each(function(index, value){
							$(this).val("");
							$(this).prop("disabled", false);
						});								
						$(".wrap-form ul li input[type='radio']").eq(0).select().focus().prop("checked", true);
						$(".wrap-button button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).hide();
							else
								$(this).show();
						});
						appName.enable(true);
						grpName.enable(true);
						forDiv();
						cMode = "add";
					break;
					case "editButt":
						if (currRow2 == undefined)
							return true;
							
						$(".wrap-form input, .wrap-form select").each(function(index, value){
							$(this).prop("disabled", false);
						});								
						$(".wrap-form ul li input[type='radio']").eq(0).select().focus(); //.prop("checked", true);
						$(".wrap-button button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).hide();
							else
								$(this).show();									
						});		
						appName.enable(true);		
						grpName.enable(true);	
						forDiv();
						cMode = "edit";
					break;
					case "delButt":
						if (currRow2 == undefined)
							return true;
							
						var conf = confirm("Are you sure you want to delete this record?");
						if (conf){
							dataRow = grid2.data("kendoGrid").dataSource.getByUid(dataItem.uid);
        					grid2.data("kendoGrid").dataSource.remove(dataRow);
							dataSource2.sync(); 	    	
							$("#rowSelection2").data("kendoGrid").setDataSource(dataSource2);	  
							$("#rowSelection2").data("kendoGrid").dataSource.page($("#rowSelection2").data("kendoGrid").dataSource.page());
							$("#rowSelection2").data("kendoGrid").dataSource.read();
        				}								
					break;
					case "canButt":
						$(".wrap-form input, .wrap-form select").each(function(index, value){
							$(this).prop("disabled", true);
						});
						$(".wrap-button button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).show();
							else
								$(this).hide();									
						});
						if (!currRow2 == undefined)
							grid_change(currRow2);
						appName.enable(false);
						grpName.enable(false);
						$("#coverDiv").remove();
					break;
					case "saveButt":
	        			if (confirm("Are you sure you want to save all changes?")){
	        				//alert($("#rad3").is(":checked") + ", " + $("#rad2").is(":checked") + ", " + dataItem.user_id + ", " + appName.value() + ", " + grpName.value() + ", " + dataItem.PROGRESS_RECID);
	        				//alert(cMode + ", " + ((cMode == "add") ? 0 : dataItem.PROGRESS_RECID));
	        				if (cMode == "add"){
								dataSource2.add({appl_su: ($("#rad3").is(":checked") ? 1 : 0),
								 				 appl_jsu: ($("#rad2").is(":checked") ? 1 : 0),
								  				 user_id: dataItem.user_id,
								  				 appl_code: appName.value(),
								  				 group_code: grpName.value(),
								  				 PROGRESS_RECID: 0});
								dataSource2.sync();						  		 		
								$("#rowSelection2").data("kendoGrid").setDataSource(dataSource2);	  
								$("#rowSelection2").data("kendoGrid").dataSource.page($("#rowSelection2").data("kendoGrid").dataSource.page());
								$("#rowSelection2").data("kendoGrid").dataSource.read();
								//$("#rowSelection2").data("kendoGrid").setDataSource(dataSource2);
							}else {
						        $.post(crudService + "manage/rightsApp",{PROGRESS_RECID: dataItem.PROGRESS_RECID,appl_su: ($("#rad3").is(":checked") ? 1 : 0),appl_jsu: ($("#rad2").is(":checked") ? 1 : 0),appl_code: appName.value(),group_code: grpName.value()},
						       	    function(data){
					       	    		/*dataSource2.getByUid(dataItem.uid).set("group_code", grpName.value());
					       	    		dataSource2.getByUid(dataItem.uid).set("appl_su", ($("#rad3").is(":checked") ? 1 : 0));
					       	    		dataSource2.getByUid(dataItem.uid).set("appl_jsu", ($("#rad2").is(":checked") ? 1 : 0));
					       	    		dataSource2.getByUid(dataItem.uid).set("appl_code", appName.value());
						  		 		dataSource2.sync();*/						  		 		
										$("#rowSelection2").data("kendoGrid").setDataSource(dataSource2);	  
										$("#rowSelection2").data("kendoGrid").dataSource.page($("#rowSelection2").data("kendoGrid").dataSource.page());
										$("#rowSelection2").data("kendoGrid").dataSource.read();
						       	    });
							}
							$(".wrap-form input, .wrap-form select").each(function(index, value){
								$(this).prop("disabled", true);
							});
							$(".wrap-button button").each(function(index,value){
								if ($(this).hasClass("mainEve"))
									$(this).show();
								else
									$(this).hide();									
							});
							if (!currRow2 == undefined)
								grid_change(currRow2);
							appName.enable(false);
							grpName.enable(false);
							$("#coverDiv").remove();
						}
					break;
					case "deButt":
						if (currRow2 == undefined)
							return true;
							
						if (confirm("Are you sure you want to " + (dataItem.appl_stat == 1 ? "'Deactivate' " : "'Activate' ") + dataItem.appl_code.toUpperCase() + " [System] for this User?")){
					        $.post(crudService + "manage/rightsAppD",{PROGRESS_RECID: dataItem.PROGRESS_RECID, appl_stat: (dataItem.appl_stat == 1 ? 0 : 1)},
					       	    function(data){
					       	    	/*dataSource2.getByUid(dataItem.uid).set("appl_stat", (dataItem.appl_stat == 1 ? 0 : 1));
					  		 		dataSource2.sync();*/						  		 		
									$("#rowSelection2").data("kendoGrid").setDataSource(dataSource2);	  
									$("#rowSelection2").data("kendoGrid").dataSource.page($("#rowSelection2").data("kendoGrid").dataSource.page());
									$("#rowSelection2").data("kendoGrid").dataSource.read();
					       	    });
							//$("#rowSelection2").data("kendoGrid").setDataSource(dataSource2);
						    //dataSource2.transport.options.update.url = "/codeIgniter/index.php/webapps/ln_setup/manage/rightsAppD/" + dataItem.PROGRESS_RECID;
						    //dataSource2.at(selectedRows2[0].rowIndex).set("appl_stat", (dataItem.appl_stat == 1 ? 0 : 1));
							//dataSource2.sync();
						}
					break;
				}
			}					
		});
	});
</script>