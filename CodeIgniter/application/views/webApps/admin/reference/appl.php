<div class="refBox mainContent">
    <span class="title"> Application Maintenance </span>
    <div class="wrap-grid demo-section">
        <div id="rowSelection"></div>
    </div>
</div>
<div id="hidDiv"></div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var systemCode = "",
			systemDesc = "",
			crudService = crudServiceBaseUrl + "ln_reference/";
			
		var dataSource = new kendo.data.DataSource({
			transport: {
				read: {
					url: crudService + "directCall/appl_grid",
                    contentType: "application/json",
	                type: "GET"
				},
	            create: {
	                url: crudService + "manage/appl",
	                type: "POST"
	            },
	            update: {
	                url: crudService + "manage/appl",
	                type: "POST"
	            },
	            destroy: {
	                url: crudService + "remove/appl",
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
					  dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        }
			      }else {
			      	if (type = "create")
			      		data['publish'] = 1;
			      	return data;
			      }
			    }
            },
            pageSize: 15,
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
                        appl_name: {type: "string"},
                        appl_name_short: {type: "string"},
                        type: {type: "string"},
                        publish: {type: "string", editable: false}
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
	    };
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
            editable: "inline",
            toolbar: ["create","edit","destroy",
            {
			    text: "Publish",
			    className: "k-grid-custom",
			    imageClass: "k-icon k-edit"
			},
            {
			    text: "Print",
			    className: "k-grid-print",
			    //imageClass: "k-icon k-edit"
			},"save","cancel"],
			columns: [
				{
					field: 'appl_code',
					title: 'Code',
					width: "30px"
				},
				{
					field: 'appl_name',
					title: 'Description',
					width: 250
				},
				{
					field: 'appl_name_short',
					title: 'Short Description',
					width: 100
				},
				{
					field: 'type',
					title: 'Type',
					width: 30
				},
				{
					field: 'publish',
					title: 'Publish',
					width: 23,
                    template: kendo.template("#= publish #")
				}
			],
           change: function(e){
			    selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
			    $("#uploadButt").removeAttr("disabled");
           },
           dataBound: addExtraStylingToGrid
		});
		
		var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	//alert("$(this)." + ((index <= 2) ? vis : ((vis == "show") ? "hide" : "show")) + "();");
	        	eval("$(this)." + ((index <= 4) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");
		
        var addNewRow = function () {
		    $("#rowSelection").data("kendoGrid").addRow();
		    toggleButt("hide");
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
			
	    $("#rowSelection .k-grid-toolbar .k-grid-custom").on("click", function (e) {
	        e.preventDefault();
	        if (confirm("Are you sure you want to " + ((dataItem.publish) ? "Depublish" : "Publish") + " this application?")){
		        $.post(crudService + "manage/publish/",{PROGRESS_RECID: dataItem.PROGRESS_RECID},
		       	    function(data){
						$("#rowSelection").data("kendoGrid").setDataSource(dataSource);	  
						$("#rowSelection").data("kendoGrid").dataSource.read();
		       	    });
	        }
	    });
			
	    $("#rowSelection .k-grid-toolbar .k-grid-print").on("click", function (e) {
	        e.preventDefault();
		    var rpt_name = "rappl";
			open_preloader();
			$.post(crudService + "print_to_csv/" + rpt_name,{rpt_name: rpt_name},
				function(data){
					//alert(data);
					close_preloader();
					setTimeout(function(){
						if (data == "true")
							to_pdf("Application Reference File Listing",rpt_name);
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