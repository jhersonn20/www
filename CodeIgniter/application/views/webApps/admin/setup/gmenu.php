<style>
	@-moz-document url-prefix() {
		.gmenuBox, .gmenuBox2 {
			width: 46.5% !important;
		}
		.gmenu {
			width: 3.5% !important;
			margin-right: 5px;
		}
	}
</style>
<div class="gmenuBox mainContent" style="float: left;width: 47%;">
	<select name="appName" id="appName" style="width: 100%;"></select>
    <span class="title" style="margin-top: 5px;"> Grouping Maintenance: Available </span>
    <div class="wrap-grid demo-section">
        <div id="rowSelection"></div>
    </div>
</div>
<ul class="gmenu" style="float: left;width: 4.7%;text-align: center;">
	<li><button type="button" class="k-button" id="toRight">&#62;&#62;</button></li>
	<li><button type="button" class="k-button" id="toLeft">&#60;&#60;</button></li>
</ul>
<div class="gmenuBox2 mainContent" style="float: right;width: 47%;">
	<select name="grpName" id="grpName" style="width: 100%;"></select>
    <span class="title" style="margin-top: 5px;"> Grouping Maintenance: Selected </span>
    <div class="wrap-grid demo-section">
        <div id="rowSelection2"></div>
    </div>
	<div class="demo-section" style="text-align: right;font-style: italic;">
    	<p>*Double-click row to set initial page for the selected group.</p>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var currRow, appName, grpName, dataItem = "", dataItem2 = "",
		    crudService = crudServiceBaseUrl + "ln_setup/";
                
		var dataSource = new kendo.data.DataSource({
			transport: {
				read: {
					url: crudService + "directCall/gmenu/",
                    contentType: "application/json",
                    type: "GET"
				},
				create: {
					url: crudService + "manage/gmenu/",
                    type: "POST"
				},
				update: {
					url: crudService + "manage/gmenu/",
                    type: "POST"
				}
			},
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
            pageSize: 100,
			schema: {
				data: function(data){
                    return data.rows || [];
				},
               model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: {type: "number", editable: false},
                   	    description: {type: "string"},
                   	    selected: {type: "number"}
                    }
               },
               total: function(response) {
				   return $(response.rows).length;
			   }
			//},
            //change: function(e) {
           	//	currRow = this;
			//	var data = e.items[0];
            }
		});
	    
		var grid = $("#rowSelection").kendoGrid({
			dataSource: dataSource,
            selectable: "multiple",
            //pageable: {
            //    buttonCount: 5,
            //    refresh: true,
            //    pageSizes: true
            //},
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: false,
            autoBind: false,
			columns: [
				//{
				//	field: 'PROGRESS_RECID',
				//	title: 'ID',
				//	width: "10px"
				//},
				{
					field: 'description',
					title: 'Description',
					width: "100px",
					template: '#= description + ((parentMenu == "") ? "" : (" (" + parentMenu + ")")) #'
				//},
				//{
				//	field: 'selected',
				//	title: 'Selected',
				//	width: "20px"
				}
			],
           change: function(e){
           		currRow = this;
			    selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			      dataItem = this.dataItem(selectedRows[i]);
			    }
           }
		});
		var dataSource2 = new kendo.data.DataSource({
			transport: {
				read: {
					url: crudService + "directCall/gmenu",
                    contentType: "application/json"
				},
				create: {
					url: crudService + "manage/gmenu/",
                    type: "POST"
				},
				update: {
					url: crudService + "manage/gmenu/",
                    type: "POST"
				}
			},
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
            pageSize: 100,
			schema: {
				data: function(data){
                    return data.rows || [];
				},
               model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: {type: "number", editable: false},
                   	    description: {type: "string"},
                   	    selected: {type: "number"}
                    }
               },
               total: function(response) {
				   return $(response.rows).length;
			   }
			//},
            //change: function(e) {
           	//	currRow2 = this;
			//	var data = e.items[0];
            }
		});
	    
		var grid2 = $("#rowSelection2").kendoGrid({
			dataSource: dataSource2,
            selectable: "multiple",
            //pageable: {
            //    buttonCount: 5,
            //    refresh: true,
            //    pageSizes: true
            //},
            groupable: false,
            autoBind: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: false,
			columns: [
				//{
				//	field: 'PROGRESS_RECID',
				//	title: 'ID',
				//	width: "10px"
				//},
				{
					field: 'description',
					title: 'Description',
					width: "100px",
					template: '#= description + ((parentMenu == "") ? "" : (" (" + parentMenu + ")")) #'
				//},
				//{
				//	field: 'selected',
				//	title: 'Selected',
				//	width: "20px"
				}
			],
           change: function(e){
           		currRow2 = this;
			    selectedRows2 = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows2.length; i++) {
			      dataItem2 = this.dataItem(selectedRows2[i]);
			    }
           }
		});
		
		appName = $("#appName").kendoComboBox({
			highlightFirst: false,
            filter: "contains",
            placeholder: "Application Name...",
            dataTextField: "appl_name",
            dataValueField: "appl_code",
            dataSource: {
                transport: {
                    read: crudServiceBaseUrl + "ln_reference/directCall/appl"
                },
                schema: {
                    data: function(data) {
                        return data.rows || [];
                    }
                }
            /*},
            change: function(e){
            	$.each(e,function(index,value){
            		if (typeof value == "object"){
            			$.each(this,function(index,value){
            				alert(index + "," + value);
            			});
            		}
            	});
            	alert(this.value());
				$("#grpName").data("kendoComboBox").refresh({
				    url:"http://" + pathArray[2] + "/codeIgniter/index.php/webapps/ln_rgroup/directCall/" + this.value()
				});*/
            }
        }).data("kendoComboBox");
		$(".k-input").select().focus();
		
		grpName = $("#grpName").kendoComboBox({
			highlightFirst: false,
			autoBind: false,
            filter: "contains",
            cascadeFrom: "appName",
            placeholder: "Group Description...",
            dataTextField: "group_desc",
            dataValueField: "group_code",
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
            change: function(e){
				dataSource.transport.options.read.url = crudService + "directCall/gmenu/" + appName.value() + "/" + grpName.value() + "/0";
				dataSource.read();
				dataSource2.transport.options.read.url = crudService + "directCall/gmenu/" + appName.value() + "/" + grpName.value() + "/1";
				dataSource2.read();
            }
        }).data("kendoComboBox");
        
        $("#rowSelection2").delegate("tbody>tr", "dblclick", function(){
        	$.post(crudService + "manage/group",{appl_code: appName.value(), group_code: grpName.value(), page_init: dataItem2.progname, page_init_desc: dataItem2.description + ("(" + dataItem2.parentMenu + ")")},
        		function(data){
        			// showNotif("Information", data, "notice");
					showNotif(($.trim(data) == "1") ? "Information" : 'Warning',($.trim(data) == "1") ? ("Initial page for '" + grpName.value() + "' group of '" + appName.value() + "' system has been succesfully set.") : ("Initial page for '" + grpName.value() + "' group of '" + appName.value() + "' system has failed to set."),($.trim(data) == "1") ? "notice" : 'warning');
        		});
        });
        
        $("ul button").bind({
        	click: function(e){
        		var selectedGrid = ((this.id == "toRight") ? selectedRows : selectedRows2);
        		var selectedItems = ((this.id == "toRight") ? currRow : currRow2);
        		var selectedDS = ((this.id == "toRight") ? dataSource : dataSource2);
        		
				for (i = 0; i < selectedGrid.length; i++) {
		        	dataItem = selectedItems.dataItem(selectedGrid[i]);
					var item = selectedDS.getByUid(dataItem.uid);
			        $.post(crudService + "manage/gmenu/",{PROGRESS_RECID: dataItem.PROGRESS_RECID, selected: ((this.id == "toRight") ? 1 : 0)},
			       	    function(data){
			  		 		selectedDS.sync();
			  				
							//dataSource.transport.options.read.url = "http://" + pathArray[2] + "/codeIgniter/index.php/webapps/ln_setup/directCall/gmenu/" + appName.value() + "/" + grpName.value() + "/0";
							dataSource.read();
							//dataSource2.transport.options.read.url = "http://" + pathArray[2] + "/codeIgniter/index.php/webapps/ln_setup/directCall/gmenu/" + appName.value() + "/" + grpName.value() + "/1";
							dataSource2.read();
			       	    });
				}
				if (this.id != "toRight")
					$.post(crudService + "manage/verify_group_page", {appl_code: appName.value(), group_code: grpName.value()},
						function(data){
							if ($.trim(data) != "1")
								showNotif(($.trim(data) == "1") ? "Information" : 'Warning',data,($.trim(data) == "1") ? "notice" : 'warning');							
						});
        		/*switch(this.id){
        			case "toRight":
	        			//var dataSource = $("#rowSelection").data("kendoGrid").dataSource;
						//var data = dataSource.data();
						for (i = 0; i < selectedRows.length; i++) {
				        	dataItem = currRow.dataItem(selectedRows[i]);
							var item = dataSource.getByUid(dataItem.uid);
						//$.each(data, function (index, rowItem) {
						    //var checkbox = $("#checkbox_" + rowItem.RoomTypeId + "_" + rowItem.Date.getTime());
						    //if (checkbox != null && checkbox.is(':checked')) {
								//alert("Status: " + item.description);
						        //$.ajax({
						        //    url: "http://" + pathArray[2] + "/codeIgniter/index.php/webapps/ln_setup/manage/gmenu/",
						        //    type: "POST",
						        //    data: {PROGRESS_RECID: dataItem.PROGRESS_RECID, selected: 1},
						        //    success: function (result) {
						            	//alert(result);
						                //data[index].set('RoomRate', result);
						        //        item.set("selected",1);
						                //$('tr[data-uid="' + dataItem.uid + '"] .rowSelection-selected').prepend('<span class="k-dirty"></span>');
						        //    }
						        //});
						       $.post("http://" + pathArray[2] + "/codeIgniter/index.php/webapps/ln_setup/manage/gmenu/",{PROGRESS_RECID: dataItem.PROGRESS_RECID, selected: 1},
						       	   function(data){
						  				dataSource.sync();
						  				
										dataSource.transport.options.read.url = "http://" + pathArray[2] + "/codeIgniter/index.php/webapps/ln_setup/directCall/gmenu/" + appName.value() + "/" + grpName.value() + "/0";
										dataSource.read();
										dataSource2.transport.options.read.url = "http://" + pathArray[2] + "/codeIgniter/index.php/webapps/ln_setup/directCall/gmenu/" + appName.value() + "/" + grpName.value() + "/1";
										dataSource2.read();
						       	   });
						    //}
						//});
						}        			
						  //dataSource.update({PROGRESS_RECID: dataItem.PROGRESS_RECID});
						  //dataSource.sync();
						//dataSource.fetch(function() {
							//var items = $("#rowSelection").data("kendoGrid").dataSource.data();
							//var items = dataSource.data();
							//for (i = 0; i < selectedRows.length; i++) {
					        //	dataItem = currRow.dataItem(selectedRows[i]);
								//var item = items[i];
								//var item = dataSource.at(i);
								//var item = dataSource.getByUid(dataItem.uid);
								//alert("Status: " + item.description);
								//item.set("selected",1);
								//alert(i);
							//}
							//dataSource.sync(); //{"PROGRESS_RECID": dataItem.PROGRESS_RECID}
						//});
				    	//$("#rowSelection").data("kendoGrid").dataSource.sync();
					    //for (var i = 0; i < selectedRows.length; i++) {
					    //    dataItem = currRow.dataItem(selectedRows[i]);
					    //    alert("ToRight: " + dataItem.description);
						//	dataSource.transport.options.update.url = "http://" + pathArray[2] + "/codeIgniter/index.php/webapps/ln_setup/manage/gmenu/" + dataItem.PROGRESS_RECID + "/1";
					    //    dataSource.getByUid(dataItem.uid).set("selected",1);
						//	dataSource.sync();
					    //}
        			break;
        			case "toLeft":
						for (i = 0; i < selectedRows2.length; i++) {
				        	dataItem = currRow2.dataItem(selectedRows2[i]);
							var item = dataSource2.getByUid(dataItem.uid);
					        $.post("http://" + pathArray[2] + "/codeIgniter/index.php/webapps/ln_setup/manage/gmenu/",{PROGRESS_RECID: dataItem.PROGRESS_RECID, selected: 0},
					       	    function(data){
					  		 		dataSource2.sync();
					  				
									dataSource.transport.options.read.url = "http://" + pathArray[2] + "/codeIgniter/index.php/webapps/ln_setup/directCall/gmenu/" + appName.value() + "/" + grpName.value() + "/0";
									dataSource.read();
									dataSource2.transport.options.read.url = "http://" + pathArray[2] + "/codeIgniter/index.php/webapps/ln_setup/directCall/gmenu/" + appName.value() + "/" + grpName.value() + "/1";
									dataSource2.read();
					       	    });
						}
        			break;
        		}
				//dataSource.sync();*/
        	}
        });
	});
</script>