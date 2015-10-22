<style>
	.k-upload-files {
		width: 655px;
	}
</style>
<div id="main-wrapper">	
    <div class="wrap-grid demo-section" style="width: 98.8%;">
        <div id="rowSelection"></div>
    </div>
	<div class="wrap-button demo-section">
		<div class="buttonLeft">
        	<button type="button" class="k-button k-state-disabled" id="updateButt" disabled>Update</button>
       	</div>
		<div class="buttonRight">
        	<button class="k-button mainEve" id="closeButt">Close</button>
       	</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
		var crudService = crudServiceBaseUrl + "qms/index/",
			disc_code = pathname.split('/')[pathname.split('/').length - 1],
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "",
        	uplList = [], disImport, errCounter, fileName = "";
        var ubrpip_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/isoTO",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr[index] = this.operator;
				      		filterVArr[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr,
					    fieldS: (($(data.sort).length > 0) ? data.sort[0].field : "logdate"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : sentValue),
					    dir: (($(data.sort).length > 0) ? data.sort[0].dir : "desc")
			        }
			      }
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 15,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
               },
               errors: function(data){
               	if (filterFArr.length > 0 && $(data.rows).length == 0){
               		alert("No records found!");
					sentValue = "";
					filterFArr = [];
					$("form.k-filter-menu button[type='reset']").trigger("click");
               	}
               },
               model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: {type: "number", editable: false},
				        plant_no: {type: "string", editable: false},
				        area_no: {type: "string", editable: false},
				        drawing_no: {type: "string", editable: false},                    
				        sheet_no: {type: "string", editable: false},               
				        rev_no: {type: "string", editable: false},        
				        priority_no: {type: "string", editable: false}
                    }
               },
               total: function(response) {
				   	return (($(response.rows[0]).length > 0) ? response.rows[0].total : 0); //$(response.rows).length;				   	
			   }
            },
            change: function(e) {
            	if ($(e.items).length == 0)
            		return true;
            }
        });
                                
	    var addExtraStylingToGrid = function () {
			$("#rowSelection").data("kendoGrid").select("tr:eq(1)");
	        $(".k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr = [];
	    };
        
        var ubrpip_rs = $("#rowSelection").kendoGrid({
            dataSource: ubrpip_ds,
            selectable: "row",
            pageable: {
                buttonCount: 5,
                refresh: true,
                pageSizes: true,
    			input: true
            },
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: false,
            resizable: true,
            editable: false,
            filterable: {
                extra: false
            },
            columns: [
		       {field: "plant_no",width: 150,title: "Plant No."},
		       {field: "area_no",width: 150,title: "Area No."},
		       {field: "drawing_no",width: 150,title: "Drawing No."},                    
		       {field: "sheet_no",width: 150,title: "Sheet No."},               
		       {field: "rev_no",width: 150,title: "Rev. No."},        
		       {field: "priority_no",width: 170,title: "Priority No."}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			        $("#updateButt").prop("disabled", false).removeClass("k-state-disabled");
			    }
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle("#rowSelection","ISO Listing");
		
		$("#main-wrapper button").bind({
			click: function(){
				switch(this.id){
					case "updateButt":
						if (!confirm("Do you want to continue ?"))
							return true;
							
						open_preloader();
						$.post(crudService + "manage/callSP_prio",{},
							function(data){
								showNotif((data == 1) ? "Information" : "Warning",(data == 1) ? "Update Successful!" : "Update Failed!",(data == 1) ? "info" : "warning");
								
								$(this).prop("disabled", true).addClass("k-state-disabled");
								ubrpip_ds.read();
								close_preloader();
							});							
					break;
					default:
					break;
				}
			}
		});
	});
</script>