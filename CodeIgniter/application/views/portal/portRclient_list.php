<style>
	#win_main-wrapper {
		margin-top: 0;
		padding: 0;
	}
	.buttonLeft {width: 50%;}
</style>
<div id="win_main-wrapper">
    <div class="wrap-grid demo-section">
        <div id="client_rs"></div>
    </div>
	<div class="taClass">
		<label class="title" for="remarks">Remarks:</label><textarea name="remarks" id="remarks"  cols="20" rows="5" style="width: 97%;height: 83px;resize: none;"></textarea>
	</div>    
	<hr style="margin: 3px 0;" />
	<button name="applyButt" id="applyButt" class="k-button" style="float: right;">Apply</button>    
</div>

<script type="text/javascript">
	$(document).ready(function(){ 
		var crudService = '/codeigniter/index.php/portal/' + "index/",
		    filterFArr_cl = [], filterOArr_cl = [], filterVArr_cl = [], client_di = "";
			
        var client_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/user",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
				    // filterFArr_cl[0] = "client_id;15;neq";
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : (typeof this.value == "boolean" ? (this.value ? 1 : 0) : this.value);
				      		filterFArr_cl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_cl[index] = this.operator;
				      		filterVArr_cl[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_cl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_time"),
					    operator: (($(data.filter).length > 0) ? filterOArr_cl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_cl : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    follows: follows
			        }
			      }
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 20,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_cl.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue = "";
					    filterFArr_cl = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "id",
                    fields: {
                   	    id: { type: "number", editable: false },
                        user_id: { type: "string", editable: false },
                        client_short: { type: "string", editable: false },
                        email_add: { type: "string", editable: false },
                        last_name: { type: "string", editable: false }
                    }
                },
                total: function(response) {
				   	return (($(response.rows[0]).length > 0) ? response.rows[0].total : 0);
			    }
            },
            change: function(e) {
            	if ($(e.items).length == 0)
            		return true;
            }
        });

	    var addExtraStylingToGrid_cl = function(){
			$("#client_rs").data("kendoGrid").select("tr:eq(" + <?php echo $_POST['dl_ds_length']; ?> + ")");
	        $("#client_rs > .k-grid-content > table > tbody > tr").hover(
	            function(){
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_cl = [];
	    };

        var client_grid = $("#client_rs").kendoGrid({
            dataSource: client_ds,
            selectable: "multiple, row",
            pageable: {
                buttonCount: 3
    			// input: true
            },
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: false,
            resizable: true,
            filterable: {
            	extra: false
            },
            // height: 220,
            columns: [
               {field: "last_name",title: "Name", width: 255, template: kendo.template("#= (last_name + ', ' + first_name) + ' (' + client_short + ')' #")}
           ],
           change: function(e){			    	
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        client_di = this.dataItem(selectedRows[i]);
			    }
			    // this_grid = $("#client_rs").data("kendoGrid");
			    // rows = this_grid.select();	
			    // client_ids = "";
			    // $.each(rows,function(index,value){
			    	// this_row = this_grid.dataItem(value);
			    	// client_ids = client_ids + (this_row.id + ",");
			    // }); 

           },
           dataBound: addExtraStylingToGrid_cl
        });
        
        $("#applyButt").click(function(){
		    this_grid = $("#client_rs").data("kendoGrid");
		    rows = this_grid.select();	
		    client_ids = "";
		    remarks_txt = "";
		    email_adds = "";
		    $.each(rows,function(index,value){
		    	this_row = this_grid.dataItem(value);
		    	client_ids = client_ids + (this_row.client_id + ",");
		    	user_ids = user_ids + (this_row.id + ",");
		    	email_adds += (email_adds == "" ? "" : ",") + this_row.email_add;
		    });
		    remarks_txt = $("#remarks").val();
		    $("#window").data("kendoWindow").close();
        });
	});
</script>
