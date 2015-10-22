<div class="windowWrap-grid demo-section">
    <div id="windowRowSelection"></div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var systemCode = "", systemDesc = "", cMode = "",
			crudService = crudServiceBaseUrl + "templateLoader/";
        var pTypeComboBoxEditor = function(container, options) {
            $('<input required data-text-field="text" data-value-field="value" data-bind="value:' + options.field + '" />')
                .appendTo(container)
                .kendoDropDownList({ //kendoComboBox
                    placeHolder: "Select Type...",
                    filter: "contains",
                    suggest: true,
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: [
                        { text: "Select...", value: "0" },
                        { text: "Character", value: "1" },
                        { text: "Integer", value: "2" },
                        { text: "Decimal", value: "3" },
                        { text: "Date", value: "4" },
                        { text: "Logical", value: "5" }
                    ]
                });
        }
        var flagStatRadioEditor = function(container, options) {
            $('<label><input type="radio" name="status" value="1" data-bind="checked: ' + options.field + '" /> Active</label>'); //(options.model.flg_status < 2)
            $('<label><input type="radio" name="status" value="0" data-bind="checked: ' + options.field + '" /> In-Active</label>'); //(options.model.flg_status == 2)
        }
		var dataSource = new kendo.data.DataSource({
			transport: {
				read: {
					url: crudService + "directCall/programmer",
                    contentType: "application/json"
				},
	            create: {
	                url: crudService + "manage/programmer",
	                type: "POST"
	            },
	            update: {
	                url: crudService + "manage/programmer",
	                type: "POST"
	            },
	            destroy: {
	                url: crudService + "remove/programmer",
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
	            alert("Response: " + e.responseText);
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
                        prog_code: {type: "string"},
                        prog_type: {type: "string"},
                        prog_type_desc: {type: "string", editable: false},
                   	    p_char1: {type: "string"},
                        p_char2: {type: "string"},
                        p_char3: {type: "string"},
                        p_char4: {type: "string"},
                        p_char5: {type: "string"},
                        p_char6: {type: "string"},
                        p_char7: {type: "string"},
                        p_char8: {type: "string"},
                        p_char9: {type: "string"},
                        p_char10: {type: "string"}
                        //,
                        //flg_status: {type: "number"}
                    }
               },
               total: function(response) {
				   return $(response.rows).length;
			   }
			}
		});
                                             
        // defined function to add hover effect and remove it when row is clicked
	    var addExtraStylingToGrid = function () {
			$("#windowRowSelection").data("kendoGrid").select("tr:eq(1)"); //highlight the first row of the table
	        $(".k-grid-content > table > tbody > tr").hover( //use k-grid only when scrollable is set to false			          
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
	    };
		var grid = $("#windowRowSelection").kendoGrid({
			dataSource: dataSource,
            selectable: "row",
            pageable: {
                buttonCount: 5
                //,
                //refresh: true,
                //pageSizes: true
            },
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: "popup",
            toolbar: ["create","edit","destroy",
            {
			    text: "View",
			    className: "k-grid-custom"
			    //,
			    //imageClass: "k-icon k-edit"
            }
            ], //,"save","cancel"
			columns: [
				//{
				//	field: 'progress_recid',
				//	title: 'ID',
				//	width: "50px"
				//},
				{
					field: 'prog_code',
					title: 'Code'
				},
				{
					field: 'prog_type',
					title: 'Type',
					hidden: true, 
					editor: pTypeComboBoxEditor
				},
				{
					field: 'prog_type_desc',
					title: 'Type',
					width: "90px"
					//, 
					//editor: pTypeComboBoxEditor
				},
				{
					field: 'p_char1',
					title: 'Char Field 1',
					hidden: true
				},
				{
					field: 'p_char2',
					title: 'Char Field 2',
					hidden: true
				},
				{
					field: 'p_char3',
					title: 'Char Field 3',
					hidden: true
				},
				{
					field: 'p_char4',
					title: 'Char Field 4',
					hidden: true
				},
				{
					field: 'p_char5',
					title: 'Char Field 5',
					hidden: true
				},
				{
					field: 'p_char6',
					title: 'Char Field 6',
					hidden: true
				},
				{
					field: 'p_char7',
					title: 'Char Field 7',
					hidden: true
				},
				{
					field: 'p_char8',
					title: 'Char Field 8',
					hidden: true
				},
				{
					field: 'p_char9',
					title: 'Char Field 9',
					hidden: true
				},
				{
					field: 'p_char10',
					title: 'Char Field 10',
					hidden: true
				//},
				//{
				//	field: 'flg_status',
				//	title: 'Status',
				//	hidden: true, 
				//	editor: flagStatRadioEditor
				}
			],
            edit: function(e) {
			    //e.container.find(".k-edit-label:gt(9)").remove();
			    //e.container.find(".k-edit-field:gt(9)").remove();
			    //e.container.find("input:gt(10)").remove();
			    
			    e.container.find(".k-edit-label:eq(2)").css({display: "none"});
			    e.container.find(".k-edit-field:eq(2)").css({display: "none"});
			    if (e.container.find("input:eq(0)").val() != ""){
			    	if (cMode == "edit")
			    		e.container.find("input:eq(0)").attr("disabled",true);
			    	else {
			    		$(".k-window .k-window-titlebar .k-window-title").text("View");
			    		$.each(e.container.find("input"), function(index, value){
			    			$(this).attr("disabled",true);
			    		});
			    		$(".k-dropdown-wrap").removeClass("k-state-default").addClass("k-state-disabled");
			    		//$(".k-popup-edit-form").find(".k-edit-form-container").find(".k-edit-buttons").find(".k-grid-update").addClass("k-state-disabled");
			    		$(".k-popup-edit-form").find(".k-edit-form-container").find(".k-edit-buttons").find(".k-grid-update").css({display: "none"});
			    	}
			    }else {
			    	$(".k-window .k-window-titlebar .k-window-title").text("Add");
			    }
			},
           change: function(e){
			    selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++){
			        dataItem = this.dataItem(selectedRows[i]);
			    }
           },
           dataBound: addExtraStylingToGrid
		});
		
		/*var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	//alert("$(this)." + ((index <= 2) ? vis : ((vis == "show") ? "hide" : "show")) + "();");
	        	eval("$(this)." + ((index <= 2) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");*/
		
        var addNewRow = function () {
		    $("#windowRowSelection").data("kendoGrid").addRow();
		    //toggleButt("hide");
		}
			
		var editSelectedRow = function() {
		    $("#windowRowSelection").data("kendoGrid").editRow($("#windowRowSelection").data("kendoGrid").select());
		    //toggleButt("hide");
		}
			
		var removeSelectedRow = function() {
		    $("#windowRowSelection").data("kendoGrid").removeRow($("#windowRowSelection").data("kendoGrid").select());
		    dataSource.sync();
		}
			
	    $("#windowRowSelection .k-grid-toolbar .k-grid-add").on("click", function (e) {
	        e.preventDefault();
	        cMode = "add";
	        addNewRow();
	    });
			
	    $("#windowRowSelection .k-grid-toolbar .k-grid-edit").on("click", function (e) {
	        e.preventDefault();
	        cMode = "edit";
	        editSelectedRow();
	    });
			
	    $("#windowRowSelection .k-grid-toolbar .k-grid-delete").on("click", function (e) {
	        e.preventDefault();
	        removeSelectedRow(e);
	    });
			
	    $("#windowRowSelection .k-grid-toolbar .k-grid-custom").on("click", function (e) {
	        e.preventDefault();
	        cMode = "view";
	        editSelectedRow();
	    });
			
	    $("#windowRowSelection .k-grid-toolbar .k-grid-save-changes").on("click", function (e) {
			e.preventDefault();
	        if (confirm("Are you sure you want to save all changes?"))
		    	toggleButt("show");	        	
	        else
	        	return false;
	    });
			
	    $("#windowRowSelection .k-grid-toolbar .k-grid-cancel-changes").on("click", function (e) {
			e.preventDefault();
	        if (confirm("Are you sure you want to cancel all changes?"))
		    	toggleButt("show");
			else
				return false;
	    });
	});
</script>