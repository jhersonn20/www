<div id="windowMain-wrapper" style="width: 100%;">
	<div class="windowWrap-header demo-section">
		<fieldset>
			<legend> Filter Option: </legend>
			<label><input type="radio" name="windowOption" id="windowOption1" checked /> All </label>
			<label><input type="radio" name="windowOption" id="windowOption2" /> Program Code </label>
			<label><input type="radio" name="windowOption" id="windowOption3" /> System Application </label>
			<label><input type="radio" name="windowOption" id="windowOption4" /> System Transaction </label>
			<label><input type="radio" name="windowOption" id="windowOption5" /> Attachment Path </label>
			<label><input type="radio" name="windowOption" id="windowOption6" /> Modules </label>
            <span class="k-textbox k-space-right">
                <input type="text" value="" name="windowSearch" id="windowSearch" />
                <a href="#" class="k-icon k-i-search">&nbsp;</a>
            </span>
			
		</fieldset>
	</div>
    <div class="windowWrap-grid demo-section">
        <div id="windowRowSelection"></div>
    </div>
	<div class="windowWrap-form demo-section">
		<ul class="windowFormLeft">
			<li>
				<label class="title" for="windowTxt1">Program Code:</label><input type="text" name="windowTxt1" id="windowTxt1" class="k-textbox" style="width: 70%;">
			</li>
			<li>
				<label class="title" for="windowTxt2">System Apps.:</label><input type="text" name="windowTxt2" id="windowTxt2" class="k-textbox" style="width: 70%;">
			</li>
			<li>
				<label class="title" for="windowTxt3">System Trans.:</label><input type="text" name="windowTxt3" id="windowTxt3" class="k-textbox" style="width: 70%;">
			</li>
			<li>
				<label class="title" for="option21">Status:</label><input type="radio" name="option2" id="option21" /><label class="title short" for="option21">Active</label><input type="radio" name="option2" id="option22" /><label class="title short" for="option22">In-Active</label>
			</li>
		</ul>
		<div class="windowFormRight">
			<div class="taClass">
				<label class="title" for="windowTextarea">Attachment Path</label><textarea name="windowTextarea" id="windowTextarea" cols="20" rows="2" ></textarea>
			</div>
			<div class="taClass">
				<label class="title" for="windowTextarea">Modules</label><textarea name="windowTextarea1" id="windowTextarea1" cols="20" rows="2" ></textarea>
			</div>
		</div>
	</div>
	<div class="windowWrap-button demo-section">
		<div class="windowButtonLeft">
        	<button class="k-button" id="saveButt">Save</button>
        	<button class="k-button" id="canButt">Cancel</button>
        	<button class="k-button mainEve" id="addButt">Add</button>
        	<button class="k-button mainEve" id="editButt">Edit</button>
        	<button class="k-button mainEve" id="delButt">Delete</button>
       	</div>				
	</div>
</div>
<script type="text/javascript">
	function grid_change(e){
		if (typeof e == "undefined")
			e = grid;
	    var selectedRows = e.select();
	    var selectedDataItems = [];
	    for (var i = 0; i < selectedRows.length; i++) {
	      dataItem = e.dataItem(selectedRows[i]);
		  $("#windowTxt1").val(dataItem.prog_code);
		  $("#windowTxt2").val(dataItem.sys_app);
		  $("#windowTxt3").val(dataItem.sys_trans);
		  $("#windowTextarea").val(dataItem.attach_path);
		  $("#windowTextarea1").val(dataItem.modules);
		  $("#option21").prop("checked",(dataItem.flg_status == 1))
		  $("#option22").prop("checked",(dataItem.flg_status == 0))
	    }   
	}
	function forDiv(){
		var container = $("#windowRowSelection");
		var position = container.offset();
		var offsetHeight = container.height();
		var offsetWidth = container.width();
		var newDiv = $("<div id='windowCoverDiv'>").appendTo($("#window"));
		newDiv.offset(position);
		newDiv.height(offsetHeight);
		newDiv.width(offsetWidth - 17);
		$("#windowRowSelection").css({"z-index": 0});
	}
	$(document).ready(function(){
        var currRow, dataRow, dataItem, ekCode, windowOptions, cMode,
        	crudService = crudServiceBaseUrl + "templateLoader/",
			optionArr = ["","prog_code","sys_app","sys_trans","attach_path","modules"],
			sentValue = "";
    
        var onClose = function() {
        	var conf = confirm("Are you sure you want to close this dialog?");
        	if (!conf)
        		e.preventDefault();

			$(document.body).find(".k-upload-files").remove();
			$(document.body).find(".k-upload-selected").remove();
        }
        
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/attach",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/attach",
                    type: "POST"
                },
                update: {
                    url: crudService + "manage/attach",
                    type: "POST"
                },
                destroy: {
                    url: crudService + "remove/attach",
                    type: "POST"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
		      		var filterFArr = [],
		      		    filterOArr = [],
		      		    filterVArr = [];
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		filterFArr[index] = this.field + ";" + this.value + ";" + this.operator;
				      		filterOArr[index] = this.operator;
				      		filterVArr[index] = this.value;
				      	});
				      }
				      if ($('input[name=windowOption]:checked').index('input[name=windowOption]') > 0)
				      	  filterFArr[filterFArr.length] = optionArr[$('input[name=windowOption]:checked').index('input[name=windowOption]')] + ";" + sentValue;
			        return {
			          page: data.page,
			          pageSize: data.pageSize,
			          top: data.take,
			          skip: data.skip,
					  fieldF: filterFArr, //optionArr[$('input[name=windowOption]:checked').index('input[name=windowOption]')],
					  fieldS: ($(data.sort).length ? data.sort[0].field : "logtime"),
					  operator: ($(data.filter).length ? filterOArr : "contains"),
					  value: ($(data.filter).length ? filterVArr : sentValue),
					  dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        }
			      }else 
			      	return data;
			    }
            },
            pageSize: 5,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
               },
               errors: function(data){
               	if ($(data.rows).length == 0){
               		alert("No records found!");
					sentValue = "";
					$("form.k-filter-menu button[type='reset']").trigger("click");
               		//grid.data("kendoGrid").dataSource.read();
               	}
               },
               model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: {type: "number", editable: false},
                        prog_code: { type: "string" },
                   	    sys_app: { type: "string"},
                        sys_trans: { type: "string"},
                        attach_path: { type: "string"},
                        modules: { type: "string"}
                    }
               },
               total: function(response) {
				   	return (($(response.rows[0]).length > 0) ? response.rows[0].total : 0);
			   }
            },
            change: function(e) {
            	if ($(e.items).length == 0)
            		return true;
           		currRow = this;
				var data = e.items[0];
				$("#windowTxt1").val(data.prog_code);
				$("#windowTxt2").val(data.sys_app);
				$("#windowTxt3").val(data.sys_trans);
				$("#windowTextarea").val(data.attach_path);
				$("#windowTextarea1").val(data.modules);
				$("#option21").prop("checked",(data.flg_status == 1));
				$("#option22").prop("checked",(data.flg_status == 0));
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
                buttonCount: 5,
                refresh: true,
                pageSizes: true
            },
            groupable: true,
            sortable: true,
            scrollable: true,
            navigatable: true,
            filterable: {
                extra: false
            },
            editable: false,
            columns: [
               {
                   field: "prog_code",
                   title: "Code",
                   width: 50
               },
               {
                   field: "sys_app",
                   title: "System Application",
                   width: 100
               },
               {
                   field: "sys_trans",
                   title: "System Transaction",
                   width: 100
               },
               {
                   field: "attach_path",
                   title: "Attachment Path",
                   width: 200
               },
               {
                   field: "modules",
                   title: "Module",
                   width: 100
               }
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			      dataItem = this.dataItem(selectedRows[i]);
			      oObj = new kendo.data.ObservableObject({
										item: dataItem
									});
				  
				  $("#windowTxt1").val(dataItem.prog_code);
				  $("#windowTxt2").val(dataItem.sys_app);
				  $("#windowTxt3").val(dataItem.sys_trans);
				  $("#windowTextarea").val(dataItem.attach_path);
				  $("#windowTextarea1").val(dataItem.modules);
				  $("#option21").prop("checked",(dataItem.flg_status == 1));
				  $("#option22").prop("checked",(dataItem.flg_status == 0));
			    }
           },
		  saveChanges: function(e) {
		    // if (confirm("Are you sure you want to save all changes?")) {
		       //e.preventDefault();
		       
					/*
					var newObj = {PROGRESS_RECID: dataItem.PROGRESS_RECID,
													  sys_app: $("#windowTxt2").val(),
													  sys_trans: $("#windowTxt3").val(),
													  attach_path: $("#windowTextarea").val(),
													  modules: $("#windowTextarea1").val(),
													  flg_status: (($("#option21").is(":checked")) ? 1 : 0),
													  user_id: $("#hidden_user").val()};*/
					
				$.each(this.dataSource, function(index,value){
					alert(index + ", " + value);
					/*if (value == "model"){
						$.each(this,function(index2,value2){
							alert("Child: " + index2 + ", " + value2);
						});
					}*/
				});
			   // alert($("#windowTextarea").val());
		       // data.model.set("attach_path", $("#windowTextarea").val());
		    // }
		  }
           //,
           //dataBound: addExtraStylingToGrid
        });
        
		$(".windowWrap-form input, .windowWrap-form textarea, .windowWrap-form select").each(function(index, value){
			$(this).prop("disabled", true);
		});

        $(document.body).bind({
			keydown: function (e){
				ekCode = e.keyCode;
                if (e.altKey && e.keyCode == 87) {
                    $("#windowRowSelection").data("kendoGrid").table.focus();
                }
                /*if (e.keyCode == 13){
                	$("#windowRowSelection").data("kendoGrid").saveChanges();
                	$.each(oObj.item,function(index,value){
						alert(index + ", " + value);
					});
					
					dataSource.getByUid(dataItem.uid).set("prog_code", "MDR-RCGomez");
					dataSource.getByUid(dataItem.uid).set("attach_path", "\\\\eeisahq1\\ITMS\\IT-MDR\\rcgomez");
					oObj.item.set("PROGRESS_RECID",dataItem.PROGRESS_RECID);
					oObj.item.set("prog_code",dataItem.prog_code);
					oObj.item.set("attach_path","\\\\eeisahq1\\ITMS\\IT-MDR\\");
					oObj.item.set("sys_app","ITMS-RCGomez");
					//dataSource.data(oObj.item);
					var newObj = {PROGRESS_RECID: dataItem.PROGRESS_RECID,
								  sys_app: $("#windowTxt2").val(),
								  sys_trans: $("#windowTxt3").val(),
								  attach_path: $("#windowTextarea").val(),
								  modules: $("#windowTextarea1").val(),
								  flg_status: (($("#option21").is(":checked")) ? 1 : 0),
								  user_id: $("#hidden_user").val()};
					/*oObj.item.set("PROGRESS_RECID",dataItem.PROGRESS_RECID);
					oObj.item.set("prog_code",dataItem.prog_code);
					oObj.item.set("sys_app",$("#windowTxt2").val());
					//oObj.item.set("sys_trans",$("#windowTxt3").val());
					oObj.item.set("attach_path",$("#windowTextarea").val());
					//oObj.item.set("modules",$("#windowTextarea1").val());
					//oObj.item.set("flg_status",($("#option21").is(":checked")) ? 1 : 0);
					//oObj.item.set("user_id",$("#hidden_user").val());
			      oObj = new kendo.data.ObservableObject({
						item: newObj
					});
                	$.each(oObj.item,function(index,value){
						alert("After: " + index + ", " + value);
					});
					/*dataSource.sync();
					$("#windowRowSelection").data("kendoGrid").setDataSource(oObject.);	  
					$("#windowRowSelection").data("kendoGrid").dataSource.page($("#windowRowSelection").data("kendoGrid").dataSource.page());
					$("#windowRowSelection").data("kendoGrid").dataSource.read();
                }*/
			}
		});

		$(".windowWrap-button button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();									
		});
		$(".windowWrap-button button").bind({
			click: function(){
				switch (this.id){
					case "addButt":
						$(".windowWrap-form input, .windowWrap-form textarea, .windowWrap-form select").each(function(index, value){
							$(this).val("");
							$(this).prop("disabled", false);
						});								
						$(".windowWrap-form ul li:first-child input").select().focus();
						$(".windowWrap-button button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).hide();
							else
								$(this).show();
						});
						forDiv();
						cMode = "add";
					break;
					case "editButt":
						$(".windowWrap-form input, .windowWrap-form textarea, .windowWrap-form select").each(function(index, value){
							$(this).prop("disabled", (this.id == "windowTxt1"));
						});	
						$(".windowWrap-form ul li:first-child input").select().focus();
						$(".windowWrap-button button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).hide();
							else
								$(this).show();									
						});	
						forDiv();
						cMode = "edit";
					break;
					case "delButt":
						if (confirm("Are you sure you want to delete this record?")){
							alert(dataItem.PROGRESS_RECID);
							dataRow = grid.data("kendoGrid").dataSource.getByUid(dataItem.uid);
        					grid.data("kendoGrid").dataSource.remove(dataRow);
							dataSource.sync();
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
        				}								
					break;
					case "saveButt":
						if (confirm("Are you sure you want to save this data?")) {
							if (cMode == "add"){
								dataSource.add({PROGRESS_RECID: 0,
												prog_code: $("#windowTxt1").val(),
												sys_app: $("#windowTxt2").val(),
												sys_trans: $("#windowTxt3").val(),
												attach_path: $("#windowTextarea").val(),
												modules: $("#windowTextarea1").val(),
												flg_status: (($("#option21").is(":checked")) ? 1 : 0),
												user_id: $("#hidden_user").val()});
								dataSource.sync();
								$("#windowRowSelection").data("kendoGrid").setDataSource(dataSource);
								$("#windowRowSelection").data("kendoGrid").dataSource.page($("#windowRowSelection").data("kendoGrid").dataSource.page());
								$("#windowRowSelection").data("kendoGrid").dataSource.read();
							}else {
								$.post(crudService + "manage/attach",{PROGRESS_RECID: dataItem.PROGRESS_RECID, sys_app: $("#windowTxt2").val(),	sys_trans: $("#windowTxt3").val(), attach_path: $("#windowTextarea").val(),	modules: $("#windowTextarea1").val(), flg_status: (($("#option21").is(":checked")) ? 1 : 0), user_id: $("#hidden_user").val()},
								   function(data){
										$("#windowRowSelection").data("kendoGrid").setDataSource(dataSource);
										$("#windowRowSelection").data("kendoGrid").dataSource.page($("#windowRowSelection").data("kendoGrid").dataSource.page());
										$("#windowRowSelection").data("kendoGrid").dataSource.read();
								});								
							}
							//$("#windowRowSelection").data("kendoGrid").setDataSource(dataSource);
							
							$(".windowWrap-form input, .windowWrap-form textarea, .windowWrap-form select").each(function(index, value){
								$(this).prop("disabled", true);
							});
							$(".windowWrap-button button").each(function(index,value){
								if ($(this).hasClass("mainEve"))
									$(this).show();
								else
									$(this).hide();									
							});
							grid_change(currRow);
							$("#windowCoverDiv").remove();
						}
					break;
					case "canButt":
						$(".windowWrap-form input, .windowWrap-form textarea, .windowWrap-form select").each(function(index, value){
							$(this).prop("disabled", true);
						});
						$(".windowWrap-button button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).show();
							else
								$(this).hide();									
						});
						grid_change(currRow);
						$("#windowCoverDiv").remove();
					break;
				}
			}					
		});
		$(".k-i-search").click(function(e){
			e.preventDefault();
			
			sentValue = $("#windowSearch").val();
			grid.data("kendoGrid").dataSource.page(1);
			grid.data("kendoGrid").dataSource.read();
		});
		$("#windowSearch").bind({
			keyup: function(e){
				if (e.keyCode == 13){
					sentValue = this.value;
					grid.data("kendoGrid").dataSource.page(1);
					grid.data("kendoGrid").dataSource.read();
				}
			//},
			//blur: function(){
			//	sentValue = this.value;
			//	grid.data("kendoGrid").dataSource.page(1);
			//	grid.data("kendoGrid").dataSource.read();
			}
		});
		/*$("#windowSearch").bind({
			keyup: function(){
				if (this.value != ""){
					switch ($(".windowWrap-header input[type=radio]:checked").attr("id")){
						case "windowOption2":
							grid.data("kendoGrid").dataSource.filter({ field: "prog_code", operator: "contains", value: this.value });
							break;
						case "windowOption3":
							grid.data("kendoGrid").dataSource.filter({ field: "sys_app", operator: "contains", value: this.value });
							break;
						case "windowOption4":
							grid.data("kendoGrid").dataSource.filter({ field: "sys_trans", operator: "contains", value: this.value });									
							break;
						case "windowOption5":
							grid.data("kendoGrid").dataSource.filter({ field: "attach_path", operator: "contains", value: this.value });
							break;
						case "windowOption6":
							grid.data("kendoGrid").dataSource.filter({ field: "modules", operator: "contains", value: this.value });
							break;
					}
				}else
					grid.data("kendoGrid").dataSource.filter({});
				grid.data("kendoGrid").select("tr:eq(1)");
			},
			blur: function(){
				if (this.value != ""){
					switch ($(".windowWrap-header input[type=radio]:checked").attr("id")){
						case "windowOption2":
							grid.data("kendoGrid").dataSource.filter({ field: "prog_code", operator: "contains", value: this.value });
							break;
						case "windowOption3":
							grid.data("kendoGrid").dataSource.filter({ field: "sys_app", operator: "contains", value: this.value });
							break;
						case "windowOption4":
							grid.data("kendoGrid").dataSource.filter({ field: "sys_trans", operator: "contains", value: this.value });
							break;
						case "windowOption5":
							grid.data("kendoGrid").dataSource.filter({ field: "attach_path", operator: "contains", value: this.value });
							break;
						case "windowOption6":
							grid.data("kendoGrid").dataSource.filter({ field: "modules", operator: "contains", value: this.value });
							break;
					}
				}else
					grid.data("kendoGrid").dataSource.filter({});
				grid.data("kendoGrid").select("tr:eq(1)");
			}					
		});*/
	});
</script>