<div class="utilitiesBox mainContent">
    <span class="title"> Purge Inactive Users </span>
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
			crudService = crudServiceBaseUrl + "ln_utilities/";
		var dataSource = new kendo.data.DataSource({
			transport: {
				read: {
					url: crudService + "directCall/purge",
                    contentType: "application/json"
				},
	            create: {
	                url: crudService + "manage/purge",
	                type: "POST"
	            },
	            update: {
	                url: crudService + "manage/purge",
	                type: "POST"
	            },
	            destroy: {
	                url: crudService + "remove/purge/all",
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
					  fieldS: ($(data.sort).length ? data.sort[0].field : "user_id"),
					  //operator: "contains",
					  //value: sentValue,
					  dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        }
			      }else {
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
                   	    user_id: {type: "string"},
                        user_name: {type: "string"}
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
            selectable: "multiple",
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
            toolbar: [
            {
            	text: "Purge All",
            	name: "destroy"
            },
            {
			    text: "Purge Selected",
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
					field: 'user_id',
					title: 'ID',
					width: "30px"
				},
				{
					field: 'user_name',
					title: 'Name',
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
           },
           dataBound: addExtraStylingToGrid
		});
		
		var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	//alert("$(this)." + ((index <= 2) ? vis : ((vis == "show") ? "hide" : "show")) + "();");
	        	eval("$(this)." + ((index <= 2) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
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
	        if (confirm("Are you sure you want to remove all Inactive Users?"))
	        	removeSelectedRow(e);
	    });
			
	    $("#rowSelection .k-grid-toolbar .k-grid-custom").on("click", function (e) {
	        e.preventDefault();
	        if (confirm("Are you sure you want to remove all Selected Users?")){
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = currRow.dataItem(selectedRows[i]);
			        $.post(crudService + "remove/purge/selected",{PROGRESS_RECID: dataItem.PROGRESS_RECID},
			       	    function(data){
			  		 		dataSource.sync();
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);	  
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
			       	    });
			    }
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