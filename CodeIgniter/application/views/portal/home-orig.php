<style>
	.k-grid-content {height: 172px;}
</style>
<div class="signup">
	<h1> Sign Up </h1> | <a href="#"> User Reference </a>
	<hr style="margin: 3px 0;" />
	<ul>			
		<li> <label class="title" for="client" style="width: 36%;">Client:</label><input required type="text" name="client" id="client" style="width: 53%" />
			<button name="client_ref" id="client_ref" class="k-button">...</button>
		</li>
		<li> <label class="title" for="first_name" style="width: 36%;">First Name:</label><input required type="text" name="first_name" id="first_name" class="k-textbox" style="width: 62%;" /> </li>
		<li> <label class="title" for="last_name" style="width: 36%;">Last Name:</label><input required type="text" name="last_name" id="last_name" class="k-textbox" style="width: 62%;" /> </li>
		<li> <label class="title" for="email_add" style="width: 36%;">Email Address:</label><input type="text" name="email_add" id="email_add" class="k-textbox" style="width: 62%;" /> </li>
		<li> <label class="title" for="user_id" style="width: 36%;">User ID:</label><input required type="text" name="user_id" id="user_id" class="k-textbox" style="width: 62%;" /> </li>
		<li> <label class="title" for="pword" style="width: 36%;">Password:</label><input required type="password" name="pword" id="pword" class="k-textbox" style="width: 62%;" /> </li>
		<li> <label class="title" for="conf_pword" style="width: 36%;">Confirm Password:</label><input required type="password" name="conf_pword" id="conf_pword" class="k-textbox" style="width: 62%;" /> </li>
		<li> <label class="title" for="expiry_date" style="width: 36%;">Expiry Date:</label><input required type="text" name="expiry_date" id="expiry_date" style="width: 35%;" /> </li>
	</ul>
	<hr style="margin: 3px 0;" />
	<button name="create" id="create" class="k-button" style="float: right;">Create</button>
</div>
<div class="latest">
	<h1> Latest / Un-Open Uploads </h1>
	<hr style="margin: 3px 0;" />
    <div class="wrap-grid" style="width: 100%;">
        <div id="rowSelection"></div>
    </div>
    <div class="module_footer">
		<hr style="margin: 3px 0;" />
		<button name="open" id="open" class="k-button"> Open </button>
		<button name="Download" id="Download" class="k-button"> Download </button>
    </div>
</div>
<div class="clients">
	<h1> Clients </h1>
	<hr style="margin: 3px 0;" />
	<?php
		foreach ($client as $arr):
			echo "<div class='client-proper'>";
			echo "<a href='/codeIgniter/index.php/portal/index/index/profile/" . $arr['id'] . "' id='" . $arr['short_desc'] . "'><img src='" . $arr['path'] . "'></a>";
			echo "<a href='/codeIgniter/index.php/portal/index/index/profile/" . $arr['id'] . "' id='" . $arr['short_desc'] . "'>" . $arr['name'] . "</a>";
			echo "</div>";
		endforeach;
	?>
    <div class="module_footer">
		<hr style="margin: 3px 0;" />
		<button name="more" id="more" class="k-button"> More... </button>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){   
		var crudService = crudServiceBaseUrl + "index/", 
			isFailed = false, filterFArr_ds = [], filterOArr_ds = [], filterVArr_ds = [];
			 
		var dl_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/files",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
				    filterFArr_ds[0] = "client_id;15;neq";
				    filterFArr_ds[1] = "date_open;;in";
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_ds[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_ds[index] = this.operator;
				      		filterVArr_ds[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_ds,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_time"),
					    operator: (($(data.filter).length > 0) ? filterOArr_ds : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_ds : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc")
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
               	if (filterFArr_ds.length > 0 && $(data.rows).length == 0){
               		showNotif("Information","No records found!","information");
					filterFArr_ds = [];
					$("form.k-filter-menu button[type='reset']").trigger("click");
               	}
               },
               model: {
               		id: "id",
                    fields: {
                   	    id: {type: "number", editable: false},
				        name: {type: "string", editable: false},
				        remarks: {type: "string", editable: false},
				        log_created: {type: "string", editable: false},
				        client_id: {type: "number", editable: false}
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
                                
	    var addExtraStylingToGrid_dl = function () {
			$("#rowSelection").data("kendoGrid").select("tr:eq(1)");
	        $(".k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_ds = [];
	    };
        
        var dl_rs = $("#rowSelection").kendoGrid({
            dataSource: dl_ds,
            selectable: "row",
            pageable: {
                buttonCount: 3
                // refresh: true,
                // pageSizes: true,
    			// input: true
            },
            autoBind: true,
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
	    	   {field: "client_name",title: "Client Name", width: 100},
		       {field: "name",width: 290,title: "Name"},
		       // {field: "remarks",width: 350,title: "Remarks"},
		       {field: "log_created",title: "Logs"}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dl_di = this.dataItem(selectedRows[i]);
			        typeArr = dl_di.name.split(".");
			        if (typeArr[typeArr.length - 1].toLowerCase() != "pdf")
			        	$("#open").addClass("k-state-disabled").prop("disabled", true);
			        else
			        	$("#open").removeClass("k-state-disabled").prop("disabled", false);
			    }
           },
           dataBound: addExtraStylingToGrid_dl
        });
        // insertGridTitle("#rowSelection","List of Files");
        
        var client = $("#client").kendoComboBox({
	        highlightFirst: false,
            filter: "contains",
            placeholder: "Select client...",
            dataTextField: "short_desc",
            dataValueField: "id",
            autoBind: false,
            dataSource: {
                transport: {
                    read: crudService + "directCall/client",
            		contentType: "application/json"
                },
                schema: {
					data: function(data){
	                    return data.rows || [];
					}	                    	
                }
            },
            change: function(e){
				if (this.selectedIndex < 0)
            		$(".k-input").eq(0).val("").select().focus();
            }
        }).data("kendoComboBox");
        
		var expiry = $("#expiry_date").removeClass('k-state-disabled').kendoDatePicker({
			format: "MM/dd/yyyy",
			enable: false
		}).data("kendoDatePicker");
			
		$(".signup a").click(function(e){
			e.preventDefault();
			$("#window").data("kendoWindow").setOptions({
			    title: "Reference File",
			    width: "975px",
			    height: "auto",
			    close: function(){}
			});
			$("#window").data("kendoWindow").refresh({
				url: "/codeIgniter/index.php/portal/index/index/portRuser",
				type: "POST",
				data: {dl_ds_length: dl_ds._data.length}
			});
        	$("#window").data("kendoWindow").center().open();
		});   
		
		$("#arccWrap button").bind({
			click: function(){
				switch(this.id){
					case "open":
						$("#window").data("kendoWindow").setOptions({
						    title: dl_di.name,
						    width: "900px",
						    height: "600px",
						    close: function(){
						    	dl_ds.read();
						    }
						});
						$("#window").data("kendoWindow").refresh({
						    url: "http://" + $(location).attr('hostname') + "/documents/" + dl_di.client_id + "/" + dl_di.name,
						    contentType: "application/pdf"
						});
				        $("#window").data("kendoWindow").center().open();
				        $.post("/codeIgniter/index.php/portal/index/manage/files",{id: dl_di.id, log_user: "rcgomez", date_open: kendo.toString(new Date(),"yyyy-MM-dd")},
				        	function(data){
				       	    	if (data != '1')
									showNotif('Warning',data,'warning');
				        	});
						break;
					case "client_ref":
		    			$("#window").data("kendoWindow").setOptions({
						    title: "Reference File",
						    width: "700px",
						    height: "auto",
						    close: function(){}
						});
						$("#window").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/portal/index/index/portRclient",
							type: "POST",
							data: {}
						});
			        	$("#window").data("kendoWindow").center().open();
					break;
					default:
						isFailed = verifyThisInput(".signup");
			    		if (isFailed)
			    			return true;
			    			
				        $.post(crudService + "manage/user",{id: 0, client_id: client.value(), first_name: $("#first_name").val(), last_name: $("#last_name").val(), 
				        									email_add: $("#email_add").val(), user_id: $("#user_id").val(), password: $("#pword").val(), 
				        									expiry: kendo.toString(expiry.value(),"yyyy-MM-dd"), log_user: "rcgomez"},
				       	    function(data){
				       	    	if (data != '1')
									showNotif('Warning',data,'warning');
								else {
									showNotif('Information',"User successfully created!",'information');
									$(".signup input").each(function(index,value){
										this.value = "";										
									});
								}
				       	    });
					break;
				}
	    	}
		});
	});
</script>
