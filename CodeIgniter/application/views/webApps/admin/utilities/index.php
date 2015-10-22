<div class="utilitiesBox mainContent">
    <span class="title"> Utilities Maintenance </span>
    <div class="wrap-grid demo-section">
        <div id="rowSelection"></div>
    </div>
</div>
<div id="hidDiv"></div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var systemCode = "";
		var systemDesc = "";
		var dataSource = new kendo.data.DataSource({
			transport: {
				read: {
					url: "/codeIgniter/index.php/webapps/ln_utilities/directCall",
                    contentType: "application/json"
				},
	            create: {
	                url: "/codeIgniter/index.php/webapps/ln_utilities/manage",
	                type: "POST"
	            },
	            update: {
	                url: "/codeIgniter/index.php/webapps/ln_utilities/manage",
	                type: "POST"
	            },
	            destroy: {
	                url: "/codeIgniter/index.php/webapps/ln_utilities/remove",
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
            pageSize: 5,
			schema: {
				data: function(data){
                    return data.rows || [];
				},
               model: {
               		id: "id",
                    fields: {
                   	    id: {type: "number", editable: false},
                   	    util_desc: {type: "string"},
                        util_path: {type: "string"}
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
	        //$.each($("#rowSelection .k-grid-toolbar").find("a"), function(index, value){
	        //	alert($(this).text());
	        //});
	        //$("#rowSelection .k-grid-toolbar").find("a").eq(3).addClass("k-state-disabled");
	        //$("#rowSelection .k-grid-toolbar").find("a").eq(3).hide();
	        //$("#rowSelection .k-grid-toolbar").find("a").eq(4).hide();
	        //$("#rowSelection .k-grid-toolbar").find("a").eq(4).addClass("k-state-disabled");
	        //toggleButt("show");
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
            toolbar: ["create","edit","destroy","save","cancel"],
			columns: [
				/*{
					field: 'id',
					title: 'ID',
					width: "30px"
				},*/
				{
					field: 'util_desc',
					title: 'Description',
					width: "200px"
				},
				{
					field: 'util_path',
					title: 'File Path'
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
	        removeSelectedRow(e);
	    });
			
	    $("#rowSelection .k-grid-toolbar .k-grid-save-changes").on("click", function (e) {
			e.preventDefault();
	        if (confirm("Are you sure you want to save all changes?"))
		    	toggleButt("show");	        	
	        else
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