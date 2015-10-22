<div class="refBox mainContent">
    <span class="title"> Group Reference </span>
	<select name="appName" id="appName" style="width: 100%;"></select>
    <div class="wrap-grid demo-section" style="margin-top: 5px;">
        <div id="rowSelection"></div>
    </div>
</div>
<div id="hidDiv"></div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var systemCode = "",
			systemDesc = "",
			dataItem = "",
			crudService = crudServiceBaseUrl + "ln_reference/";
		
		var appName = $("#appName").kendoComboBox({
			highlightFirst: false,
            filter: "contains",
            placeholder: "Application Name...",
            dataTextField: "appl_name",
            dataValueField: "appl_code",
            dataSource: {
                transport: {
                    read: crudService + "directCall/appl"
                },
                schema: {
                    data: function(data) {
                        return data.rows || [];
                    }
                }
            },
            change: function(e){
				//dataSource.transport.options.read.url = crudService + ("directCall/group/" + appName.value());
				dataSource.read();
            }
        }).data("kendoComboBox");	
		$(".k-input").select().focus();
		
		var dataSource = new kendo.data.DataSource({
			transport: {
				read: {
					url: crudService + "directCall/group",
                    contentType: "application/json",
	                type: "GET"
				},
	            create: {
	                url: crudService + "manage/group",
	                type: "POST"
	            },
	            update: {
	                url: crudService + "manage/group",
	                type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
	            },
	            destroy: {
	                url: crudService + "remove/group",
	                type: "POST"
	            },
	            parameterMap: function(data, type){
					if (type == "read")
						return {
							page: data.page,
							pageSize: data.pageSize,
							top: data.take,
							skip: data.skip,
							fieldS: ($(data.sort).length ? data.sort[0].field : "logtime"),
							value: appName.value(),
							dir: ($(data.sort).length ? data.sort[0].dir : "desc")
						};
					else if (type == "create")
						return {
							appl_code: appName.value(),
							PROGRESS_RECID: data.PROGRESS_RECID,
							group_code: data.group_code,
							group_desc: data.group_desc,
							div_code: data.div_code,
							page_init_desc: data.page_init_desc
						};
					else if (type == "update")
						return {
							appl_code: appName.value(),
							PROGRESS_RECID: data.PROGRESS_RECID,
							group_code: data.group_code,
							group_desc: data.group_desc,
							div_code: data.div_code,
							page_init_desc: data.page_init_desc
						};
					else if (type == "destroy")
						return data;
	            }
			},
	        error: function(e) {
	        	/*$.each(e, function(index,value){
	        		if (typeof value == "object"){
	        			$.each(this, function(index2,value2){
	        				alert("Sub: " + index2 + "," + value2);
	        			});
	        		}
	        		alert("Main: " + index2 + "," + value2);
	        	});*/
	            // alert(e.responseText);
	        },
            pageSize: 15,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
			schema: {
				data: function(data){
                    return data.rows || [];
				},
               model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: {type: "number", editable: false},
                   	    group_code: {type: "string"},
                        group_desc: {type: "string"},
                        div_code: {type: "string"},
                        page_init_desc: {type: "string"}
                    }
               },
               total: function(response) {
				   	return (($(response.rows[0]).length > 0) ? parseInt(response.rows[0].total) : 0);
			   }
			}
		});
                                             
        // defined function to add hover effect and remove it when row is clicked
	    var addExtraStylingToGrid = function () {
			$("#rowSelection").data("kendoGrid").select("tr:eq(1)"); //highlight the first row of the table
	        $(".k-grid-content > table > tbody > tr").hover( //use k-grid only when scrollable is set to false			          
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
	        //$.each($("#rowSelection .k-grid-toolbar").find("a"), function(index, value){
	        //	alert($(this).text());
	        //});
	        //$("#rowSelection .k-grid-toolbar").find("a").eq(3).addClass("k-state-disabled");
	        //$("#rowSelection .k-grid-toolbar").find("a").eq(3).hide();
	        //$("#rowSelection .k-grid-toolbar").find("a").eq(4).hide();
	        //$("#rowSelection .k-grid-toolbar").find("a").eq(4).addClass("k-state-disabled");
	        //toggleButt("show");
	    };
	    
	    var categoryDropDownEditor = function(container, options) {
	        $('<input required data-text-field="div_desc" data-value-field="div_code" data-bind="value:' + options.field + '"/>')
	            .appendTo(container)
	            .kendoDropDownList({
	                autoBind: false,
	                dataSource: {
	                    transport: {
	                        read: crudService + "directCall/div",
                    		contentType: "application/json"
	                    },
	                    schema: {
							data: function(data){
			                    return data.rows || [];
							}	                    	
	                    }
	                }
	            });
        }
	    
	    var pageInitDropDownEditor = function(container, options) {
	         $('<input required data-text-field="description" data-value-field="progname" data-bind="value:' + options.field + '"/>')
	            .appendTo(container)
	            .kendoDropDownList({
	                autoBind: false,
	                dataSource: {
	                    transport: {
	                        read: crudService + ("directCall/menu/" + appName.value() + "/" + dataItem.group_code),
	                        contentType: "application/json"
	                    },
	                    schema: {
							data: function(data){
			                    return data.rows || [];
							}	                    	
	                    }
	                }
	            });
        }
	    
		var grid = $("#rowSelection").kendoGrid({
			dataSource: dataSource,
            selectable: "row",
            pageable: {
                buttonCount: 5,
                refresh: true,
                pageSizes: true
            },
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            autoBind: false,
            editable: "inline",
            toolbar: ["create","edit","destroy",
            {
			    text: "Print",
			    className: "k-grid-print",
			    //imageClass: "k-icon k-edit"
			},"save","cancel"],
			columns: [
				{field: 'group_code', title: 'Code', width: "50px"},
				{field: 'group_desc',title: 'Description'},
				{field: 'div_code', title: 'Division', width: "170px", editor: categoryDropDownEditor},
				{field: 'page_init_desc', title: 'Initial Page', width: "200px"} //, editor: pageInitDropDownEditor}
			],
            change: function(e){
			    selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
			    //$("#uploadButt").removeAttr("disabled");
            },
            dataBound: addExtraStylingToGrid
		});
		
		var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	//alert("$(this)." + ((index <= 2) ? vis : ((vis == "show") ? "hide" : "show")) + "();");
	        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");
		
        var addNewRow = function () {
		    $("#rowSelection").data("kendoGrid").addRow();
		    toggleButt("hide");
			$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(3).html("");
		}
			
		var editSelectedRow = function() {
		    $("#rowSelection").data("kendoGrid").editRow($("#rowSelection").data("kendoGrid").select());
		    toggleButt("hide");
		}
			
		var removeSelectedRow = function() {
		    $("#rowSelection").data("kendoGrid").removeRow($("#rowSelection").data("kendoGrid").select());
		}
			
	    $("#rowSelection .k-grid-toolbar .k-grid-add").on("click", function (e) {
	        e.preventDefault();
	        addNewRow();
	    });
			
	    $("#rowSelection .k-grid-toolbar .k-grid-edit").on("click", function (e) {
	        e.preventDefault();
	        editSelectedRow();
	    });
			
	    $("#rowSelection .k-grid-toolbar .k-grid-delete").on("click", function (e) {
	        e.preventDefault();
	        removeSelectedRow(e);
	    });
			
	    $("#rowSelection .k-grid-toolbar .k-grid-print").on("click", function (e) {
	        e.preventDefault();
		    var rpt_name = "rgroup";
			open_preloader();
			$.post(crudService + "print_to_csv/" + rpt_name,{rpt_name: rpt_name, appl_code: appName.value()},
				function(data){
					//alert(data);
					close_preloader();
					setTimeout(function(){
						if (data == "true")
							to_pdf("Group Reference File Listing",rpt_name);
						else
							$.pnotify({
								title: "Warning",
								text: data,
								type: "error",
								icon: true,
								styling: 'jqueryui',
								history: false,
								closer: false,
								sticker: false
							});
					},2000);
				});
	    });
			
	    $("#rowSelection .k-grid-toolbar .k-grid-save-changes").on("click", function (e) {
			e.preventDefault();
	        if (confirm("Are you sure you want to save all changes?")){
		    	toggleButt("show");
				$("#rowSelection").data("kendoGrid").setDataSource(dataSource);	  
				$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
				$("#rowSelection").data("kendoGrid").dataSource.read();
	        }else
	        	return false;
	    });
			
	    $("#rowSelection .k-grid-toolbar .k-grid-cancel-changes").on("click", function (e) {
			e.preventDefault();
	        if (confirm("Are you sure you want to cancel all changes?"))
		    	toggleButt("show");
			else
				return false;
	    });
	});
</script>