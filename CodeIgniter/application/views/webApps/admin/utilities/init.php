<div class="utilitiesBox mainContent">
    <span class="title"> Initialize GENDB </span>
    <div class="wrap-grid demo-section">
        <div id="rowSelection"></div>
    </div>
</div>
<div id="hidDiv"></div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var systemCode = "",
			systemDesc = "",
			currRow,
			crudService = crudServiceBaseUrl + "ln_reference/";
		var dataSource = new kendo.data.DataSource({
			transport: {
				read: {
					url: crudService + "directCall/appl",
                    contentType: "application/json"
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
            pageSize: 15,
			schema: {
				data: function(data){
                    return data.rows || [];
				},
               model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: {type: "number", editable: false},
                   	    appl_code: {type: "string"},
                        appl_name: {type: "string"}
                    }
               },
               total: function(response) {
				   return $(response.rows).length;
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
            editable: false,
            toolbar: [
            {
			    text: "Initialize",
			    className: "k-grid-custom",
			    imageClass: "k-icon k-delete"
			}],
			columns: [
				//{
				//	field: 'progress_recid',
				//	title: 'ID',
				//	width: "50px"
				//},
				{
					field: 'appl_code',
					title: 'Code',
					width: "30px"
				},
				{
					field: 'appl_name',
					title: 'Description',
					width: 250
				}
			],
           change: function(e){
           		currRow = this;
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
	        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
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
	        var currentApp = dataItem.appl_code;
	        if (confirm("Are you sure you want to initialize the " + dataItem.appl_code + "?")){	        	
		        $.post(crudService + "remove/init/",{appl_code: dataItem.appl_code, user_recid: $("#hidd_PROGRESS_RECID").val()},
		       	    function(data){
		       	    	var msg = data;
		       	    	if (parseInt(data) == 1){
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);	  
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
		  		 			msg = "Records has been successfully cleared for '" + currentApp + "' System.";
		  		 		}
		  		 		if (data == null){
		  		 			msg = "Access elevation is needed to complete this transaction!";
		  		 		}
						$.pnotify({
							title: "Information",
							text: msg,
							type: "info",
							icon: true,
							styling: 'jqueryui',
							history: false,
							closer: false,
							sticker: false
						});
		       	    });
	        }
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