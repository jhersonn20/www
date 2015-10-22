<style>
	#win_main-wrapper {
		margin-top: 0;
		padding: 0;
	}
	.k-upload-files {width: 100px;}
	.buttonLeft {width: 50%;}
</style>
<div id="win_main-wrapper">
    <div class="wrap-grid demo-section">
        <div id="user_rs"></div>
    </div>
	<div class="wrap-button demo-section apply8">
		<div class="buttonLeft">
        	<button class="k-button" id="saveButt">Save</button>
        	<button class="k-button" id="canButt">Cancel</button>
<!--         	<button class="k-button mainEve" id="addButt">Add</button> -->
        	<button class="k-button mainEve" id="editButt">Edit</button>
        	<button class="k-button mainEve" id="delButt">Delete</button>
        	<button class="k-button mainEve" id="chgButt">Change Password</button>
       	</div>
	</div>
</div>	

<script type="text/javascript">
	$(document).ready(function(){ 
		var crudService = crudServiceBaseUrl + "index/",
		    filterFArr_user = [], filterOArr_user = [], filterVArr_user = [], user_di = "";
		
		$(".wrap-button button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();
		});
		 
		var expiry_DT = function (container, options) {
		    $('<input data-text-field="' + options.field + '" data-value-field="' + options.field + '" data-bind="value:' + options.field + '"/>')
		            .appendTo(container)
		            .kendoDateTimePicker({
						timeFormat: "HH:mm"
					});
		}
			
        var user_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/user",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/user",
                    type: "POST",
	                complete: function(jqXHR, textStatus){
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else {
							user_ds.page(user_ds.page());
							$("#coverDiv").remove();
						}
						user_ds.read();
	                }
                },
                update: {
                    url: crudService + "manage/user",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else {
							user_ds.page(user_ds.page());
							$("#coverDiv").remove();
						}
						user_ds.read();
	                }
                },
                destroy: {
                    url: crudService + "remove/user",
                    type: "POST",
	                complete: function(jqXHR, textStatus){
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else
							user_ds.page(user_ds.page());
						user_ds.read();
	                }
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : (typeof this.value == "boolean" ? (this.value ? 1 : 0) : this.value);
				      		filterFArr_user[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_user[index] = this.operator;
				      		filterVArr_user[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_user,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_time"),
					    operator: (($(data.filter).length > 0) ? filterOArr_user : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_user : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        }
			      }else {
			      	data['log_user'] = "rcgomez";
			      	data['expiry'] = kendo.toString(data.expiry,"yyyy-MM-dd HH:mm:ss");
			      	return data;
			      }
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 8,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_user.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_user = [];
					    $("#user_rs form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "id",
                    fields: {
                   	    id: { type: "number", editable: false },
                        client_name: { type: "string", nullable: false, validation: {required: true} },
                        user_id: { type: "string", nullable: false, validation: {required: true} },
                        last_name: { type: "string", nullable: false, validation: {required: true} },
                        first_name: { type: "string", nullable: false, validation: {required: true} },
                        email_add: { type: "string", nullable: false, validation: {required: true} },
                        expiry: { type: "datetime", nullable: false, validation: {required: true} }
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

	    var addExtraStylingToGrid_user = function(){
			$("#user_rs").data("kendoGrid").select("tr:eq(" + (<?php echo $_POST['dl_ds_length']; ?>) + ")");
	        $("#user_rs > .k-grid-content > table > tbody > tr").hover(
	            function(){
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_user = [];
	    };

        var user_rs = $("#user_rs").kendoGrid({
            dataSource: user_ds,
            selectable: "row",
            pageable: {
                buttonCount: 3,
    			input: true
            },
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: 'inline',
			toolbar: ["save","cancel"],
            resizable: true,
            filterable: {
                extra: false
            },
            // height: 220,
            columns: [
               {field: "client_name",title: "Client Name",width: 119},
               {field: "user_id",title: "User ID",width: 110},
               {field: "last_name",title: "Last Name", width: 200},
               {field: "first_name",title: "First Name", width: 200},
               {field: "email_add",title: "Email Address", width: 214},
               {field: "expiry",title: "Login Expiry", width: 208, format: "{0:MM/dd/yyyy hh:mm:ss}", attributes: {style: "text-align: right;"}, editor: expiry_DT}
           ],
           change: function(e){
			    if (!$("#saveButt").is(":hidden"))
			    	return true;
			    	
           		currRow_user = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        user_di = this.dataItem(selectedRows[i]);
			        if (user_di.short_desc == "ARCC")			        	
			        	$("#editButt, #delButt").addClass("k-state-disabled").prop("disabled", true);			        	
			        else			        	
			        	$("#editButt, #delButt").removeClass("k-state-disabled").prop("disabled", false);
			    }
           },
           dataBound: addExtraStylingToGrid_user
        });
		$("#user_rs .k-grid-toolbar").hide();
        insertGridTitle('#user_rs','User Reference');
		
		$("#win_main-wrapper button").bind({
			click: function(){
				switch(this.id){
					case "chgButt":
		    			$("#subWindow").data("kendoWindow").setOptions({
						    title: "Change Password",
						    width: "440px",
						    height: "auto",
						    close: function(){
						    	user_ds.read();
						    }
						});
						$("#subWindow").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/portal/index/direct_to/tmpl_changePassword",
							type: "POST",
							data: {"userName": user_di.user_id, "id": user_di.id}
						});
			        	$("#subWindow").data("kendoWindow").center().open();
					break;
	    			case "delButt":
	    				if (!confirm("Do you really want to delete this item?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
    					$("#user_rs").data("kendoGrid").dataSource.remove(user_di);
						user_ds.sync();
						user_ds.page(user_ds.page());
						user_ds.read();
	    				return true;
	    			break;
	    			case "saveButt":
	    			case "canButt":			    			
	    				if (this.id == "saveButt"){
		    				if (!confirm("Are you sure you want to save this data?"))
		    					return true;
	
		    				$("#user_rs .k-grid-toolbar .k-grid-save-changes").trigger( "click" );
	    				}else
	    					$( "#user_rs .k-grid-toolbar .k-grid-cancel-changes" ).trigger( "click" );
	    						    				
						$(".wrap-button button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).show();
							else
								$(this).hide();
								
							if (($(".wrap-button button").length - 1) == index)
								user_ds.read();
						});
						$("#coverDiv").remove();
	    			break;
					default:
		    			if (this.id == "addButt"){
			    			$("#subWindow").data("kendoWindow").setOptions({
							    title: "Create User",
							    width: "370px",
							    height: "auto",
							    close: function(){
							    	user_ds.read();
							    }
							});
							$("#subWindow").data("kendoWindow").refresh({
								url: "/codeIgniter/index.php/portal/index/direct_to/portRuser_add",
								type: "POST",
								data: {dl_ds_length: (<?php echo $_POST['dl_ds_length']; ?> + user_ds._data.length + 1)}
							});
				        	$("#subWindow").data("kendoWindow").center().open();
		    			}else {
		    				if (typeof user_di == "string")
		    					return true;
		    				$("#user_rs").data("kendoGrid").editRow($("#user_rs").data("kendoGrid").select());
							$("#user_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).find("input").select().focus();
	    				
							$(".wrap-button button").each(function(index,value){
								if ($(this).hasClass("mainEve"))
									$(this).hide();
								else
									$(this).show();
							});
		    			}
					break;
				}
	    	}
		});
	});
</script>
