<div class="usersBox mainContent">
    <span class="title"> Users Maintenance </span>
    <div class="wrap-grid demo-section">
        <div id="rowSelection"></div>
    </div>
	<div class="wrap-form demo-section">
		<ul class="formLeft" style="width: 100%;">
			<li style="text-align: center;">
				<input type="radio" name="rad1" id="rad1" checked disabled><label class="title chk" for="rad1">Normal Access</label>
				<input type="radio" name="rad1" id="rad2" disabled><label class="title chk" for="rad2">Junior System Administrator</label>
				<input type="radio" name="rad1" id="rad3" disabled><label class="title chk" for="rad3">System Administrator</label>
				<input type="radio" name="rad1" id="rad4" disabled><label class="title chk" for="rad4">Auditor</label>
			</li>
			<li>
				<label class="title" for="txt1">User ID:</label><input type="text" required name="txt1" id="txt1" class="k-textbox" disabled style="width: 13%;">
				<label class="title" for="txt2">User Name:</label><input type="text" required name="txt2" id="txt2" class="k-textbox" disabled style="width: 27%;">
				<label class="title" for="txt4">Duration:</label><input type="text" name="txt4" id="txt4" disabled style="width: 11%;">
				<input type="checkbox" name="chk1" id="chk1" disabled><label class="title chk" for="chk1">Never Expires</label>
			</li>
			<li>
				<label class="title" for="txt3">Password:</label><input type="password" required name="txt3" id="txt3" class="k-textbox" disabled style="width: 13%;">
				<label class="title" for="txt6">Confirm:</label><input type="password" required name="txt6" id="txt6" class="k-textbox" disabled style="width: 13%;margin-right: 14%;">
				<label class="title" for="txt5">Expiry Date:</label><input type="text" name="txt5" id="txt5" disabled style="width: 14%;">
				<input type="checkbox" name="chk2" id="chk2"><label class="title chk" for="chk2">Inactive</label>
			</li>
		</ul>
	</div>
	<div class="wrap-button demo-section">
		<div class="buttonLeft">
        	<button type="button" class="k-button" id="saveButt">Save</button>
        	<button type="button" class="k-button" id="canButt">Cancel</button>
        	<button type="button" class="k-button mainEve" id="addButt">Add</button>
        	<button type="button" class="k-button mainEve" id="editButt">Edit</button>
        	<button type="button" class="k-button mainEve" id="delButt">Delete</button>
       	</div>
		<div class="buttonRight">
        	<button type="button" class="k-button mainEve" id="printButt">Print</button>
        	<button type="button" class="k-button mainEve" id="changeButt">Change Password</button>
        	<!--<button type="button" class="k-button mainEve" id="viewButt">View File</button>-->
       	</div>				
	</div>
</div>
<div id="hidDiv"></div>
<div id="dialog"></div>
<script type="text/javascript">
	$(document).ready(function(){
		var systemCode = "", systemDesc = "", currRow, cMode = "",
		    //dateToday = ((new Date()).getFullYear() + "-" + ('0' + ((new Date()).getMonth() + 1)).substr(-2,2) + "-" + ('0' + (new Date()).getDate()).substr(-2,2)),
		    dateToday = (('0' + ((new Date()).getMonth() + 1)).substr(-2,2) + "/" + ('0' + (new Date()).getDate()).substr(-2,2) + "/" + (new Date()).getFullYear()),
		    deleteAU = false, selectedAccess = "",
		    crudService = crudServiceBaseUrl + "ln_setup/",
			sentValue = "";
        
		var grid_change = function(e){
			if (typeof e == "undefined")
				e = grid;
		    var selectedRows = e.select();
		    var selectedDataItems = [];
		    for (var i = 0; i < selectedRows.length; i++) {
		      dataItem = e.dataItem(selectedRows[i]);
		      //alert(dataItem.PROGRESS_RECID);
		      $("#rad2").prop("checked",(dataItem.jsa == 1));
		      $("#rad3").prop("checked",(dataItem.sa == 1));
		      $("#rad4").prop("checked",(dataItem.auditor == 1));
		      //$("#chk1").prop("checked",(dataItem.expiry_date == "0000-00-00"));
		      $("#chk2").prop("checked",(dataItem.inactive == 1));
		      $("#txt1").val(dataItem.user_id);
		      $("#txt2").val(dataItem.user_name);
		      $("#txt4").data("kendoNumericTextBox").value(dataItem.duration_day);
			  $("#txt5").data("kendoDatePicker").value(kendo.toString(dataItem.expiry_date,"MM/dd/yyyy"));
		      //$("#txt5").val(kendo.toString(dataItem.expiry_date,"dd/MM/yyyy"));
		    }   
			$("#uploadButt").removeAttr("disabled");
		}
		var dataSource = new kendo.data.DataSource({
			transport: {
				read: {
					url: crudService + "directCall/users",
                    contentType: "application/json",
	                type: "GET"
				},
	            create: {
	                url: crudService + "manage/users",
	                type: "POST"
	            },
	            update: {
	                url: crudService + "manage/users",
	                type: "POST"
	            },
	            destroy: {
	                url: crudService + "remove/users",
	                type: "POST"
	            },
			    parameterMap: function(data, type) {
			      if (type == "read") {
		      		var filterFArr = [],
		      		    filterOArr = [],
		      		    filterVArr = [];
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr[index] = this.operator;
				      		filterVArr[index] = valForm;
				      	});
				      	/*if (filterFArr.length){
				      		$.each(filterFArr,function(index,value){
								alert(index + ", " + value);
				      		});
				      	}
				      	return false;*/
				    }
				    if ($('input[name=option]:checked').index('input[name=option]') > 0)
				     	filterFArr[filterFArr.length] = optionArr[$('input[name=option]:checked').index('input[name=option]')] + ";" + sentValue + ";eq";
			        return {
			          page: data.page,
			          pageSize: data.pageSize,
			          top: data.take,
			          skip: data.skip,
					  fieldF: filterFArr,
					  fieldS: ($(data.sort).length ? data.sort[0].field : "user_id"),
					  operator: (($(data.filter).length > 0) ? filterOArr /*data.filter.filters[0].operator*/ : "contains"),
					  value: (($(data.filter).length > 0) ? filterVArr /*data.filter.filters[0].value*/ : sentValue),
					  dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        }
			      }else {
			      	return data;
			      }
			    }
            },
            pageSize: 10,
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
	            //alert(e.responseText);
               	if (filterFArr.length > 0 && $(data.rows).length == 0){
               		alert("No records found!");
					sentValue = "";
					$("form.k-filter-menu button[type='reset']").trigger("click");
               		//grid.data("kendoGrid").dataSource.read();
               	}
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
                        user_name: {type: "string"},
                        expiry_date: { type: "date"}
                    }
               },
               total: function(response) {
				   	return (($(response.rows[0]).length > 0) ? parseInt(response.rows[0].total) : 0);
			   }
			},
            change: function(e) {
           		currRow = this;
				var data = e.items[0];
		        $("#rad2").prop("checked",(data.jsa == 1));
		        $("#rad3").prop("checked",(data.sa == 1));
		        $("#rad4").prop("checked",(data.auditor == 1));
		        $("#chk2").prop("checked",(data.inactive == 1));
		        $("#txt1").val(data.user_id);
		        $("#txt2").val(data.user_name);
		        $("#txt4").data("kendoNumericTextBox").value(data.duration_day);
				$("#txt5").data("kendoDatePicker").value(kendo.toString(data.expiry_date,"MM/dd/yyyy"));
		        //$("#txt5").val(kendo.toString(data.expiry_date,"dd/MM/yyyy"));
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
                pageSizes: true,
                input: true
            },
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            filterable: {
                extra: false
                /*,
                operators: {
                    string: {
                        startswith: "Starts with",
                        eq: "Is equal to",
                        neq: "Is not equal to"
                    }
                }*/
            },
            editable: "inline",
            //toolbar: ["create","edit","destroy","save","cancel"],
			columns: [
				//{
				//	field: 'PROGRESS_RECID',
				//	title: 'ID',
				//	width: "10px"
				//},
				{
					field: 'user_id',
					title: 'User ID',
					width: "100px"
				},
				{
					field: 'user_name',
					title: 'Name'
				}
			],
           change: function(e){
           		currRow = this;
           		grid_change(this);
			    /*selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			      dataItem = this.dataItem(selectedRows[i]);
			      $("#rad2").prop("checked",(dataItem.sa == 1));
			      $("#rad3").prop("checked",(dataItem.jsa == 1));
			      $("#rad4").prop("checked",(dataItem.auditor == 1));
			      $("#chk2").prop("checked",(dataItem.inactive == 1));
			      $("#txt1").val(dataItem.user_id);
			      $("#txt2").val(dataItem.user_name);
			      $("#txt4").data("kendoNumericTextBox").value(dataItem.duration_day);
			      $("#txt5").val(kendo.toString(dataItem.expiry_date,"dd/MM/yyyy"));
			    }
			    $("#uploadButt").removeAttr("disabled");*/
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

        // create NumericTextBox from input HTML element using custom format
        var days = $("#txt4").kendoNumericTextBox({
            format: "# day/s",
            change: function(e){
			    $("#txt5").i18Now({format : "%m/%d/%Y"});
			    $("#txt5").i18Now('setCustomDate', new Date( + new Date + ((parseInt(this.value()) * 24) * 60 * 60 * 1000)));
				$("#txt5").data("kendoDatePicker").value($("#txt5").val()); //kendo.toString(,"MM/dd/yyyy")
            	//$("#txt5").val();
            }
        }).data("kendoNumericTextBox");
        
        $("#txt5").kendoDatePicker({
			format: "MM/dd/yyyy",
			enable: false
        }).closest(".k-widget")
          .attr("id", "datepicker_wrapper");
        var expire = $("#txt5").data("kendoDatePicker");
		
		var forDiv = function (){
			var container = $("#rowSelection");
			var position = container.offset();	
			var offsetHeight = container.height();	
			var offsetWidth = container.width();
			var newDiv = $("<div id = 'coverDiv'>").appendTo($("body"));
			newDiv.offset(position);
			newDiv.height(offsetHeight);	
			newDiv.width(offsetWidth - 17);
		}

		$(".wrap-form input[type=checkbox]").bind({
			click: function(){
				switch (this.id){
					case "chk2":
						//alert($('input[name=rad1]:checked').index('input[name=rad1]'));
						//alert($(".wrap-form > .formLeft > li > input[type=radio][checked]").index());
						if (parseInt(dataItem.inactive) == 1){
							if (!confirm("Are you sure you want to ACTIVATE User?")){
								$(this).prop("checked", true);
								return true;
							}
						}else {
							if (parseInt($("#hid_access").val()) > 0 && //check if access is greater than normal
								$("$hid_access").val() == "010" && //check if access if junior sa
								$("input[name=rad1]:checked").index("input[name=rad1]") > 1){
									
								alert("Sorry, you are not authorized to deactivate users with higher access!");	
								$(this).prop("checked", false);
								return true;
							}
							
							if (!confirm("This procedure will remove the rights of the user\n on all systems that was assigned to him.\n Continue deactivating user?")){
								$(this).prop("checked", false);
								return true;
							}
						}
				        $.post(crudService + "manage/users_status/",{PROGRESS_RECID: dataItem.PROGRESS_RECID, user_id: dataItem.user_id,inactive: ((parseInt(dataItem.inactive) == 1) ? 0 : 1)},
				       	    function(data){
				  		 		//dataSource.sync();						  		 		
								$("#rowSelection").data("kendoGrid").setDataSource(dataSource);	  
								$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
								$("#rowSelection").data("kendoGrid").dataSource.read();
				       	    });
						/*dataSource.getByUid(dataItem.uid).set("inactive", ((parseInt(dataItem.inactive) == 1) ? 0 : 1));
						dataSource.sync();
						$("#rowSelection").data("kendoGrid").setDataSource(dataSource);*/
					break;
					default:
						if (this.checked){
							days.value(0);
							$("#txt5").data("kendoDatePicker").value(dateToday);
						}else
							days.focus();
						days.enable(!this.checked);
					break;
				}
			}
		});
		$(".wrap-form input[type=password]").bind({
			blur: function(){
				if ($.trim(this.value) == ""){
					$(this).select().focus();
					return true;
				}
				switch (this.id){
					case "txt3":
						if ($("#txt6").val() != "" && $("#txt6").val() != this.value){
							$(this).select().focus();
							return true;
						}
					break;
					case "txt6":
						if ($("#txt3").val() != "" && $("#txt3").val() != this.value){
							$(this).select().focus();
							return true;
						}
					break;
				}
			}
		});
		$(".wrap-form input[type=radio]").bind({
			click: function(){
				if (cMode != "edit")
					return true;
					
				deleteAU = (selectedAccess == this.id);
			}
		});
		/*days.blur(function(){
			dataSource.fetch(function(){
			    dataRow = grid.data("kendoGrid").dataSource.getByUid(dataItem.uid);
				dataRow.set("duration_day", this.value());
			});
		});
		expire.blur(function(){
			dataSource.fetch(function(){
			    dataRow = grid.data("kendoGrid").dataSource.getByUid(dataItem.uid);
				dataRow.set("expiry_date", kendo.toString(this.value(),"yyyy/MM/dd"));
			});
		});*/
		$(".wrap-button button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();									
		});
		$(".wrap-button button").bind({
			click: function(){
				switch (this.id){
					case "addButt":
						var exceptThis = ["txt5","chk2"];
						$(".wrap-form input").each(function(index, value){
							$(this).val("");
							$(this).prop("checked", false);
							$(this).prop("disabled", ($.inArray(this.id,exceptThis) >= 0));
						});
						$(".wrap-form ul li input[type='radio']").eq(0).select().focus().prop("checked", true);
						$(".wrap-button button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).hide();
							else
								$(this).show();
						});
						days.enable(true);
						//expire.enable(false);
						$("#txt5").data("kendoDatePicker").value(dateToday);
						forDiv();
						cMode = "add";
					break;
					case "editButt":
						var exceptThis = ["txt1","txt3","txt5","txt6","chk2"];
						$(".wrap-form input").each(function(index, value){
							$(this).prop("disabled", ($.inArray(this.id,exceptThis) >= 0));
						});
						$(".wrap-form ul li:first-child input").select().focus();
						$(".wrap-button button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).hide();
							else
								$(this).show();									
						});		
						days.enable(true);		
						//expire.enable(false);
						forDiv();
						cMode = "edit",
						selectedAccess = $('input[name=rad1]').eq($('input[name=rad1]:checked').index('input[name=rad1]')).attr("id");
					break;
					case "delButt":
						if (confirm("Are you sure you want to delete this record?")){
					        $.post(crudService + "directCall/rightsApp",{user_id: dataItem.user_id},
					       	    function(data){
					       	    	if (parseInt(data['rows'].length) > 0){
					       	    		alert("Cannot delete this user, application rights has been set-up.\n You can only tag this user as inactive, in order to trap system entry.");
					       	    		return true;
					       	    	}			
					       	    			       	    	
					      			dataRow = grid.data("kendoGrid").dataSource.getByUid(dataItem.uid);
		        					grid.data("kendoGrid").dataSource.remove(dataRow);
					  		 		dataSource.sync(); 	    	
									$("#rowSelection").data("kendoGrid").setDataSource(dataSource);	  
									$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									$("#rowSelection").data("kendoGrid").dataSource.read();
							        /*$.post(crudService + "remove/users",{PROGRESS_RECID: dataItem.PROGRESS_RECID},
							       	    function(data){
											dataRow = grid.data("kendoGrid").dataSource.getByUid(dataItem.uid);
				        					grid.data("kendoGrid").dataSource.remove(dataRow);
							  		 		dataSource.sync();
							       	    });*/
							       	    
					       	    });
        				}								
					break;
					case "saveButt":
	        			if (confirm("Are you sure you want to save all changes?")){
	        				if (cMode == "add"){
						        $.post(crudService + "directCall/userOnly",{user_id: $("#txt1").val()},
						       	    function(data){
						       	    	if (parseInt(data['rows'].length) > 0){
						       	    		alert("User ID Already Exist!");
						       	    		$("#txt1").select().focus();
						       	    		return true;
						       	    	}								       	    
						       	    });
						       	    
								  dataSource.add({sa: ($("#rad3").is(":checked") ? 1 : 0),
								  				  jsa: ($("#rad2").is(":checked") ? 1 : 0),
								  				  auditor: ($("#rad4").is(":checked") ? 1 : 0),
								  				  inactive: ($("#chk2").is(":checked") ? 1 : 0),
								  				  user_id: $("#txt1").val(),
								  				  user_name: $("#txt2").val(),
								  				  password: $.trim($("#txt3").val()),
								  				  duration_day: parseInt(days.value()),
								  				  expiry_date: kendo.toString(expire.value(),"yyyy-MM-dd"),
								  				  loguser: $("#hidd_userID").val(),
								  				  PROGRESS_RECID: 0});
								  dataSource.sync();
								  //$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
								  
								  if ($('input[name=rad1]:checked').index('input[name=rad1]') > 1){
								        $.post(crudServiceBaseUrl + "ln_reference/manage/setAu",{},
								       	    function(data){
								  		 		dataSource.sync();
								       	    });							  	
								  }						  		 		
									$("#rowSelection").data("kendoGrid").setDataSource(dataSource);	  
									$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									$("#rowSelection").data("kendoGrid").dataSource.read();
							}else {
						        $.post(crudService + "manage/users",{PROGRESS_RECID: dataItem.PROGRESS_RECID, sa: ($("#rad3").is(":checked") ? 1 : 0), jsa: ($("#rad2").is(":checked") ? 1 : 0), auditor: ($("#rad4").is(":checked") ? 1 : 0), user_name: $("#txt2").val(), duration_day: parseInt(days.value()), expiry_date: kendo.toString(expire.value(),"yyyy-MM-dd"), loguser: $("#hidd_userID").val()},
						       	    function(data){
						  		 		//dataSource.sync();						  		 		
										$("#rowSelection").data("kendoGrid").setDataSource(dataSource);	  
										$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
										$("#rowSelection").data("kendoGrid").dataSource.read();
										
										showNotif("Information","Success! It is recommended that all users that is being updated must re-login to sync their updated data to the system!","info");
						       	    });
						       	    
								if (deleteAU)
							        $.post(crudService + "remove/usersAU",{user_id: dataItem.user_id},
							       	    function(data){
							  		 		//dataSource.sync();						  		 		
											$("#rowSelection").data("kendoGrid").setDataSource(dataSource);	  
											$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
											$("#rowSelection").data("kendoGrid").dataSource.read();
							       	    });
							    
							}   	    
							$(".wrap-form input, .wrap-form textarea, .wrap-form select").each(function(index, value){
								$(this).prop("disabled", true);
							});
							$(".wrap-button button").each(function(index,value){
								if ($(this).hasClass("mainEve"))
									$(this).show();
								else
									$(this).hide();									
							});
							grid_change(currRow);
							days.enable(false);
							//expire.enable(false);
							$("#coverDiv").remove();
							selectedAccess = "";
						}
					break;
					case "canButt":
	        			if (confirm("Are you sure you want to cancel all changes?")){
							$(".wrap-form input, .wrap-form textarea, .wrap-form select").each(function(index, value){
								$(this).prop("disabled", true);
							});
							$(".wrap-button button").each(function(index,value){
								if ($(this).hasClass("mainEve"))
									$(this).show();
								else
									$(this).hide();									
							});
							grid_change(currRow);
							days.enable(false);
							//expire.enable(false);
							$("#coverDiv").remove();
						}
					break;
					case "changeButt":
						/*window.data("kendoWindow").setOptions({
						    title: "Attachment File"
						});
						window.data("kendoWindow").refresh({
						    url: "http://localhost/assets/pdf/documents/" + dataItem.file_attach
						});
						templateLoader.loadExtTemplate("/codeIgniter/index.php/webApps/templateLoader/index/tmpl_changePassword");

				        //Subscribe to event triggered when templates loaded
				        //(Don't load use templates before they are available)
				        $(document).bind("TEMPLATE_LOADED", function(e, path) {
				            //console.log('Templates loaded');            
				
				            //Compile and cache templates
				            _itemTemplate = kendo.template($("#changePassword").html()); //,{useWithBlock:false}
				
				            //Using the template (assuming "data" is collection loaded elsewhere)
				            //_itemTemplate(data);
				            $("#window").html(_itemTemplate({userName: dataItem.user_name,userID: dataItem.user_id}));
				        });*/
				        $.post(crudServiceBaseUrl + "templateLoader/index/tmpl_changePassword",{userName: dataItem.user_name,userID: dataItem.user_id, PROGRESS_RECID: dataItem.PROGRESS_RECID},
				        	function(data){
				            	$("#window").html(data);
				        	});
            			$("#window").data("kendoWindow").center().open(); 
					break;
					case "printButt":
					    var rpt_name = "ruser";
						open_preloader();
						$.post(crudService + "print_to_csv/" + rpt_name,{rpt_name: rpt_name},
							function(data){
								//alert(data);
								close_preloader();
								setTimeout(function(){
									if (data == "true")
										to_pdf("User's Listing",rpt_name);
									else
										$.pnotify({
											title: "Warning",
											text: data,
											type: "error",
											icon: true,
											styling: 'jqueryui',
											history: false,
											closer: false,
											sticker: false
										});
								},2000);
							});
					break;
				}
			}
		});
		
		$(document).keyup(function(e){
			if (e.keyCode == 120){
				if (!$("#window").is(":visible"))
			        $.post("/codeIgniter/index.php/webapps/templateLoader/index/tmpl_jobPerUser",{userName: dataItem.user_name, userID: dataItem.user_id, PROGRESS_RECID: dataItem.PROGRESS_RECID},
			        	function(data){
							$("#window").data("kendoWindow").setOptions({
							    title: "Assigned Job Number per User",
							    width: "500px",
							    height: "580px"
							});
			            	$("#window").html(data);
	    					$("#window").data("kendoWindow").center().open();
			        	});
			}
		});
	});
</script>