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
		<label for="connChk" style="display: inline-block;margin: 5px 0;"><input type="checkbox" name="connChk" id="connChk" /> Show current connections...</label>
		<!-- <div class="buttonLeft">
<!--        	<button class="k-button" id="saveButt">Save</button>
        	<button class="k-button" id="canButt">Cancel</button>
        	<button class="k-button mainEve" id="editButt">Edit</button>
        	<button class="k-button mainEve" id="delButt">Delete</button>
        	<button class="k-button mainEve" id="chgButt">Change Password</button>
       	</div>
		<div class="buttonRight">
       	</div> -->
     	<button class="k-button mainEve" id="applyButt" style="float: right;">Apply</button>
	</div>
</div>	

<script type="text/javascript">
	$(document).ready(function(){ 
		var crudService = '/codeigniter/index.php/portal/' + "index/",
		    filterFArr_user = [], filterOArr_user = [], filterVArr_user = [], user_di = "", log_user = '<?php echo $_POST['log_user']; ?>', checkedIds4 = {},checkedIds4_arr2 = [] , department = '<?php echo $_POST['department']; ?>'; //, follows = '<?php //echo $_POST['follows']; ?>'
		
		$(".wrap-button button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();
		});
			
        var user_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/modified_connect",
                    contentType: "application/json",
                    type: "GET"
	                // complete: function(jqXHR, textStatus) {
	                	// //console.log(jqXHR.responseText);
	                	// if (jqXHR.responseText != '1')
							// showNotif('Warning',jqXHR.responseText,'warning');
	                // }				},
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
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    follows: follows,
					    type: ($("#connChk").is(":checked") ? 1 : 0),
					    department: department
			        }
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
               		    notif("info","Information","No records founded!");
					    filterFArr_user = [];
					    $("#user_rs form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "id",
                    fields: {
                   	    id: { type: "number", editable: false },
                        client_name: { type: "string", editable: false },
                        department: { type: "string", nullable: false, validation: {required: true} },
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
            	if ($(e.items).length == 0){
			    	$("#win_main-wrapper button").addClass("k-state-disabled").prop("disabled", true);
            		return true;
            	}
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

		//on dataBound event restore previous selected rows:
		var onDataBound_user = function (e) {
			var view = this.dataSource.view();
			/*$.each(checkedIds, function(index,value){
				alert(index + ", " + value);
			});*/
			for(var i = 0; i < view.length;i++){
				if (checkedIds4[view[i].id] == undefined)
					checkedIds4[view[i].id] = $("#file_chk4").is(":checked");
			    //alert("View: " + view[i].id + ", " + view[i].PROGRESS_RECID);
				if(checkedIds4[view[i].id]){
					this.tbody.find("tr[data-uid='" + view[i].uid + "']")
						.addClass("k-state-selected")
						.find("input[type=checkbox]")
						.prop("checked","checked");
				}
			}			
		};

        var user_rs = $("#user_rs").kendoGrid({
            dataSource: user_ds,
            selectable: "multiple,row",
            pageable: {
                buttonCount: 3,
                pageSizes: [1,5,10,15,20],
    			input: true
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
				{
					headerTemplate:'<input id="file_chk4" name="file_chk4" type="checkbox" />',
					title: ' ',
                    template: kendo.template("<input type='checkbox' name='#= id #' id='#= id #' disabled />"),
					width: 28
				},
                {field: "client_name",title: "Client Name",width: 119},
                {field: "department",title: "Department",width: 119},
                {field: "user_id",title: "User ID",width: 110},
                {field: "last_name",title: "Last Name", width: 200},
                {field: "first_name",title: "First Name", width: 200},
                {field: "email_add",title: "Email Address", width: 214},
                {field: "expiry",title: "Login Expiry", width: 151, format: "{0:MM/dd/yyyy hh:mm:ss}", attributes: {style: "text-align: right;"}}
           ],
           change: function(e){			    	
           		currRow_user = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        user_di = this.dataItem(selectedRows[i]);
			        
				    var rowIndex = $("tr", this.tbody).index(selectedRows[i]),
				        row = this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
					checkedIds4[user_di.id] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").is(":checked");
					if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").is(":checked") == false)
						$("#file_chk4").prop("checked",false);
	           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").is(":checked"));
	           		$.each(checkedIds4,function(index,value){
	           			if (value){
							$('#applyButt').removeClass('k-state-disabled').prop("disabled", false);
							return false;	
						}           			
						$('#applyButt').addClass('k-state-disabled').prop("disabled", true);
	           		});
			    }
           },
           dataBound: onDataBound_user
           // dataBound: addExtraStylingToGrid_user
        });
        insertGridTitle('#user_rs','User Reference');
        
		$('#user_rs tbody').on('click',':checkbox',function(){
			if (this.checked){
				var grid3 = $('#user_rs').data("kendoGrid");
			    var row_dl = $(this).closest('tr'),
			        rowIndex_dl = $("tr", grid3.tbody).index(row_dl),
			        row_dl = grid3.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex_dl);
			    grid3.select(row_dl);
				$('#applyButt').removeClass('k-state-disabled').prop("disabled", false);
			}else{
				$('tr.k-state-selected','#user_rs').removeClass('k-state-selected');
				$('#applyButt').addClass('k-state-disabled').prop("disabled", true);
			}
		});
		$("#file_chk4").click(function () {
			var grid2 = $('#user_rs').data("kendoGrid")
			    currStat = this.checked;
		    $("#user_rs tbody input:checkbox").each(function(index,value){
		    	$(this).prop("checked", currStat);
			    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
			    var dataItem2 = grid2.dataItem(row);
				checkedIds4[dataItem2.id] = currStat;
				if (currStat){
				    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#user_rs').addClass('k-state-selected');
					$('#applyButt').removeClass('k-state-disabled').prop("disabled", false);
				}else {
					$('tr.k-state-selected','#user_rs').removeClass('k-state-selected');
					$('#applyButt').addClass('k-state-disabled').prop("disabled", true);
				}
			});
		});
		
		$("#connChk").click(function(){
			checkedIds4 = {};
			user_ds.page(user_ds.page());
			user_ds.read();
			
			$("#applyButt").text((this.checked) ? "Delete" : "Apply");			
		});
		
		$("#win_main-wrapper button").bind({
			click: function(){
				switch(this.id){
					// case "chgButt":
		    			// $("#subWindow").data("kendoWindow").setOptions({
						    // title: "Change Password",
						    // width: "440px",
						    // height: "auto",
					        // activate: function(){
					        	// this.wrapper.css({top: ((parseInt($(window).height()) - this.wrapper[0]["offsetHeight"]) / 2) + "px"});
					        // },
						    // close: function(){
						    	// user_ds.read();
						    // }
						// });
						// $("#subWindow").data("kendoWindow").refresh({
							// url: "<?php //echo PREURL; ?>/index/direct_to/tmpl_changePassword",
							// type: "POST",
							// data: {"userName": user_di.user_id, "id": user_di.id, "log_user": log_user}
						// });
			        	// $("#subWindow").data("kendoWindow").center().open();
					// break;
	    			// case "delButt":
	    				// if (!confirm("Do you really want to delete this item?")){
	    					// e.preventDefault();
	    					// return true;
	    				// }
// 	    				
    					// $("#user_rs").data("kendoGrid").dataSource.remove(user_di);
						// user_ds.sync();
						// user_ds.page(user_ds.page());
						// user_ds.read();
	    				// return true;
	    			// break;
	    			// case "saveButt":
	    			// case "canButt":			    			
	    				// if (this.id == "saveButt"){
		    				// if (!confirm("Are you sure you want to save this data?"))
		    					// return true;
// 	
		    				// $("#user_rs .k-grid-toolbar .k-grid-save-changes").trigger( "click" );
	    				// }else
	    					// $( "#user_rs .k-grid-toolbar .k-grid-cancel-changes" ).trigger( "click" );
// 	    						    				
						// $(".wrap-button button").each(function(index,value){
							// if ($(this).hasClass("mainEve"))
								// $(this).show();
							// else
								// $(this).hide();
// 								
							// if (($(".wrap-button button").length - 1) == index)
								// user_ds.read();
						// });
						// $("#coverDiv").remove();
	    			// break;
					default:
						var checkedIds4_arr = [], checkedIds4_arr1 = [];
						if (follows.split(",").length > 0)
							checkedIds4_arr2 = follows.split(",");
						else
							checkedIds4_arr2[0] = follows;
						$.each(checkedIds4,function(key,value){
							if (value){
								if ($("#connChk").is(":checked")){
									if ($.inArray(key,checkedIds4_arr2) >= 0){
										checkedIds4_arr2.splice( $.inArray(key, checkedIds4_arr2), 1 );
										checkedIds4_arr = checkedIds4_arr2;
									}
								}else
									checkedIds4_arr.push(key);
								checkedIds4_arr1.push(key);
							}
						});
						if (!$("#connChk").is(":checked"))
							checkedIds4_arr = checkedIds4_arr.concat(checkedIds4_arr2);
						$.post(crudService + "manage/connect",{"id": "<?php echo $_POST['user_pk']; ?>","follows": checkedIds4_arr.join(","), "log_user": log_user,"changes": checkedIds4_arr1.join(","),"type":($("#connChk").is(":checked") ? 1 : '')},
							function(data){
	    						if (data != 1){
               						showNotif("Warning",data,"warning");
               						return true;
               					}
               									
								follows = checkedIds4_arr.join(",");						
								checkedIds4 = {};
								user_ds.page(user_ds.page());
								user_ds.read();
           						showNotif("Information","Changes has been applied successfully!","information");
							});
						break;
				}
	    	}
		});
	});
</script>
