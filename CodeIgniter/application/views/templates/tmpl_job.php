<style>	
	#windowJob .k-grid-header {
		padding-right: 17px !important;
	}
	#windowJob .k-grid-content {
		overflow-y: scroll !important;
	}
</style>
<div id="windowMain-wrapper" style="width: 100%;">
	<!--<ul class="windowFormLeft">
		<li>
			<label class="title chk" for="windowChk1_job"><input type="checkbox" name="windowChk1_job" id="windowChk1_job"> Select All</label>
		</li>
	</ul>-->
	<div class="windowWrap-grid demo-section">
	    <div id="rowSelection_job"></div>
	</div>
	<div class="windowWrap-button demo-section">
		<div class="buttonRight">
        	<button class="k-button mainEve" id="applyButt">Apply</button>
       	</div>				
	</div>
</div>
<input type="hidden" name="window_hidd_userID" id="window_hidd_userID" value="<?php echo (isset($_POST['userID'])) ? $_POST['userID'] : ""; ?>">
<script type="text/javascript">
	jQuery(document).ready(function(){
		/*var systemCode = "", systemDesc = "", cMode = "";
        var pTypeComboBoxEditor = function(container, options) {
            $('<input required data-text-field="text" data-value-field="value" data-bind="value:' + options.field + '" />')
                .appendTo(container)
                .kendoDropDownList({ //kendoComboBox
                    placeHolder: "Select Type...",
                    filter: "contains",
                    suggest: true,
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
        }*/
		var checkedIds = {};
		var crudService = crudServiceBaseUrl + "templateLoader/";
		    dataSource_job = new kendo.data.DataSource({
			transport: {
				read: {
					url: crudService + "directCall/job",
                    contentType: "application/json"
				}
				/*,
	            create: {
	                url: crudService + "manage/job",
	                type: "POST"
	            },
	            update: {
	                url: crudService + "manage/job",
	                type: "POST"
	            },
	            destroy: {
	                url: crudService + "remove/job",
	                type: "POST"
	            }*/
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
            //pageSize: 10,
			schema: {
				data: function(data){
                    return data.rows || [];
				},
               model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: {type: "number", editable: false},
                        job_no: {type: "string"},
                        job_desc: {type: "string"}
                    }
               },
               total: function(response) {
				   return $(response.rows).length;
			   }
			}
		});
                                             
        // defined function to add hover effect and remove it when row is clicked
	    var addExtraStylingToGrid = function () {
			$("#rowSelection_job").data("kendoGrid").select("tr:eq(1)"); //highlight the first row of the table
	        $(".k-grid-content > table > tbody > tr").hover( //use k-grid only when scrollable is set to false			          
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
	    };

		//on dataBound event restore previous selected rows:
		var onDataBound = function (e) {
			var view = this.dataSource.view();
			/*$.each(checkedIds, function(index,value){
				alert(index + ", " + value);
			});*/
			for(var i = 0; i < view.length;i++){
				if (checkedIds[view[i].PROGRESS_RECID] == undefined)
					checkedIds[view[i].PROGRESS_RECID] = $("#windowChk1_job").is(":checked");
			    //alert("View: " + view[i].id + ", " + view[i].PROGRESS_RECID);
				if(checkedIds[view[i].PROGRESS_RECID]){
					this.tbody.find("tr[data-uid='" + view[i].uid + "']")
						.addClass("k-state-selected")
						.find("input[type=checkbox]")
						.prop("checked","checked");
				}
			}			
		}
	    var checkObject = function () {
	        $(".k-grid-content > table > tbody > tr").on('click', //use k-grid only when scrollable is set to false			          
	            function() {
	            	/*$.each(this,function(index,value){
	            		alert(index + ", " + value);
	            	});*/
	                alert($(this).find('input').attr("checked")); //, true);
	            }			        
	        );
	    };
		var grid = $("#rowSelection_job").kendoGrid({
			dataSource: dataSource_job,
            selectable: "multiple, row",
            height: "325px",
            /*pageable: {
                buttonCount: 5
                //,
                //input: true,
                //refresh: true,
                //pageSizes: true
            },*/
            pageable: false,
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            resizable: true,
			columns: [
				{
					field: 'job_no',
					title: 'Code',
					width: 60
				},
				{
					field: 'job_desc',
					title: 'Description'
				},
				{
					headerTemplate:'<input id="windowChk1_job" name="windowChk1_job" type="checkbox" />',
					title: ' ',
                    template: kendo.template("<input type='checkbox' name='#= PROGRESS_RECID #' id='#= PROGRESS_RECID #' disabled />"),
					width: 28
				}
			],
			change: function(e){
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
				    var rowIndex = $("tr", this.tbody).index(selectedRows[i]),
				        row = this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
					checkedIds[dataItem.PROGRESS_RECID] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").is(":checked");
					if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").is(":checked") == false)
						$("#windowChk1_job").prop("checked",false);
	           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").is(":checked"));
	           		
	           		/*if (this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").is(":checked") == false)
						$('tr.k-state-selected','#rowSelection_job').removeClass('k-state-selected');*/
				}
			},
           dataBound: onDataBound
		});
		$("#windowJob").data("kendoWindow").center();
		$('#rowSelection_job tbody').on('click',':checkbox',function(){
			if (this.checked){
				var grid2 = $('#rowSelection_job').data("kendoGrid");
			    //var row = grid2.dataItem($(this).closest('tr'));
			    var row = $(this).closest('tr'),
			        rowIndex = $("tr", grid2.tbody).index(row),
			        row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
			    grid2.select(row);
			}else
				$('tr.k-state-selected','#rowSelection_job').removeClass('k-state-selected');
		    //alert($("tr", grid2.tbody).index(row)); //$(this).is(':checked')
		    /*if($(this).is(':checked')){        
		        array[id] = true;
		    }else{
		    	array[id] = false;
		    }*/
		});
		$("#windowChk1_job").click(function () {
			var grid2 = $('#rowSelection_job').data("kendoGrid")
			    currStat = this.checked;
		    $("#rowSelection_job tbody input:checkbox").each(function(index,value){
		    	$(this).prop("checked", currStat);
			    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
			    var dataItem2 = grid2.dataItem(row);
				checkedIds[dataItem2.PROGRESS_RECID] = currStat;
				if (currStat){
				    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#rowSelection_job').addClass('k-state-selected');
					//grid2.select(row);
				}else
					$('tr.k-state-selected','#rowSelection_job').removeClass('k-state-selected');
			});
		});
		
		$("#applyButt").click(function(e){
			var listOfSelected = "";
		    $("#rowSelection_job tbody input[type=checkbox]:checked").each(function(index,value){
		        listOfSelected += ((listOfSelected != "") ? "," : "") + this.id;
		    });
		    $.post(crudService + "manage/job_user",{PROGRESS_RECID: 0,user_id: $("#window_hidd_userID").val(),listOfSelected: listOfSelected},
		    	function(data){
		    		$("#windowJob").data("kendoWindow").close();
					$("#windowRowSelection").data("kendoGrid").dataSource.page($("#windowRowSelection").data("kendoGrid").dataSource.page());
					$("#windowRowSelection").data("kendoGrid").dataSource.read();
		    	});
		});

		/*var row_details = function(){
			alert("Clicked!");
			$(grid.tbody).on("click", "td", function (e) {
		        var row = $(this).closest("tr");
		        var rowIdx = $("tr", grid.tbody).index(row);
		        var colIdx = $("td", row).index(this);
		        alert(rowIdx + '-' + colIdx);
		    });
		};
		*/
		/*var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	//alert("$(this)." + ((index <= 2) ? vis : ((vis == "show") ? "hide" : "show")) + "();");
	        	eval("$(this)." + ((index <= 2) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");*/
		
        /*var addNewRow = function () {
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
	    });*/
	});
</script>