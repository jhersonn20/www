<div class="systemBox mainContent">
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
			hostname = $(location).attr('hostname');
		var dataSource = new kendo.data.DataSource({
			transport: {
				read: {
					url: "http://localhost/codeIgniter/index.php/webapps/ln_rappl/directCall",
                    contentType: "application/json"
				},
	            create: {
	                url: "http://localhost/codeIgniter/index.php/webapps/ln_rappl/manage",
	                type: "POST"
	            },
	            update: {
	                url: "http://localhost/codeIgniter/index.php/webapps/ln_rappl/manage",
	                type: "POST"
	            },
	            destroy: {
	                url: "http://localhost/codeIgniter/index.php/webapps/ln_rappl/remove",
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
                        appl_name: {type: "string"},
                        appl_name_short: {type: "string"},
                        publish: {type: "number"}
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
            editable: "inline",
            toolbar: ["create","edit","destroy",
            {
			    text: "Publish",
			    className: "k-grid-custom",
			    imageClass: "k-icon k-edit"
			},"save","cancel"],
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
				},
				{
					field: 'appl_name_short',
					title: 'Short Description',
					width: 100
				},
				{
					field: 'publish',
					title: 'Publish',
					width: 50
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
	        if (confirm("Are you sure you want to " + ((dataItem.publish) ? "Depublish" : "Publish") + " this application?")){
		        $.post("/codeIgniter/index.php/webapps/ln_rappl/manage/publish/",{PROGRESS_RECID: dataItem.PROGRESS_RECID},
		       	    function(data){
	        			dataSource.getByUid(dataItem.uid).set("publish",(dataItem.publish == 1 ? 0 : 1));
		  		 		dataSource.sync();
		       	    });
	        }
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