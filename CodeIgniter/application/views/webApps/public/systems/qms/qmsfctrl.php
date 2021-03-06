<div id="main-wrapper">
	<div style="min-height: 198px;margin-bottom: 5px;">
		<div class="wrap-form demo-section apply8" style="width: 37.1%;float:right;height: auto;display: block;">
			<fieldset>
				<legend>Discipline Reference: </legend>
				<ul class="formLeft_qms" style="width: 100%;">
					<li>
						<label class="title" for="txt1" style="width: 130px;">Trans Code:</label><input type="text" required name="txt1" id="txt1" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt2" style="width: 130px;">Discipline:</label><input type="text" required name="txt2" id="txt2" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="textarea" style="width: 130px;">Description:</label><textarea name="textarea" id="textarea" cols="20" rows="3" style="resize: none;width: 57%;margin: 0;"></textarea>
					</li>
					<li>
						<label class="title" for="txt3" style="width: 130px;">Prefix Code:</label><input type="text" required name="txt3" id="txt3" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt4" style="width: 130px;">Control No.:</label><input type="text" required name="txt4" id="txt4" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt5" style="width: 130px;">Suffix:</label><input type="text" required name="txt5" id="txt5" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="rad1" style="width: 130px;">Status:</label><input type="radio" name="option" checked id="rad1" /><label class="title short" for="rad1">Active</label>
																							<input type="radio" name="option" id="rad2" /><label class="title short" for="rad2">Inactive</label>
					</li>
					<li style="text-align: right;">
						<hr style="margin-bottom: 5px;" />
						<button class="k-button" id="saveButt">Save</button>
						<button class="k-button" id="canButt">Cancel</button>						
					</li>
				</ul>
			</fieldset>
		</div>
	    <div class="wrap-grid demo-section" style="width: 60%;margin-left: 0;height: auto;">
	        <div id="rowSelection"></div>
	    </div>
	    <div class="jmifdtl_phase" style="margin-top: 5px;">
		<div id="jmifDtlHead" style="margin-bottom: 5px;">
		    <div class="wrap-grid demo-section" style="width: 61%;margin-left: 0;height: auto;">
		        <div id="rowSelection"></div>
				<fieldset style="margin-top: 5px;">
					<ul style="float: left;">
						<li>
							<label class="title" for="txt6" style="width: auto;">Log User:</label><input type="text" name="txt6" id="txt6" class="k-textbox k-state-disabled" disabled style="width: 85px;" />
							<label class="title" for="txt7" style="width: auto;">Log Date:</label><input type="text" name="txt7" id="txt7" class="k-textbox k-state-disabled" disabled style="width: 85px;" />
							<label class="title" for="txt8" style="width: auto;">Log Update:</label><input type="text" name="txt8" id="txt8" class="k-textbox k-state-disabled" disabled style="width: 200px;" />
						</li>
					</ul>
				</fieldset>
		    </div>
		</div>
	</div>
	<div class="wrap-button demo-section">
		<div class="buttonLeft">
        	<button class="k-button mainEve" id="addButt">Add</button>
        	<button class="k-button mainEve" id="editButt">Edit</button>
        	<button class="k-button mainEve" id="delButt">Delete</button>
       	</div>
		<div class="buttonRight">
        	<button class="k-button mainEve" id="closeButt">Close</button>
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
		    $("#txt1").val(dataItem.trancode);
		    $("#txt2").data("kendoComboBox").value(dataItem.disc_code);
		    $("#textarea").val(dataItem.control_desc);
		    $("#txt3").val(dataItem.prefix);
		    $("#txt4").val(dataItem.control_no);
		    $("#txt5").val(dataItem.suffix);
		    $("#txt6").val(dataItem.loguser);
			$("#txt7").val(kendo.toString(dataItem.logdate,'MM/dd/yyyy'));
			$("#txt8").val(dataItem.logupdate);
			$("#rad1").prop("checked",(dataItem.flg_status == 1));
		    $("#rad2").prop("checked",(dataItem.flg_status != 1));
	    }   
	}
	function forDiv(){
		var container = $("#rowSelection");
		var position = container.offset();	
		var offsetHeight = container.height();	
		var offsetWidth = container.width();
		var newDiv = $("<div id = 'coverDiv'>").appendTo($("body"));
		newDiv.offset(position);
		newDiv.height(offsetHeight);	
		newDiv.width(offsetWidth - 17);
	}
	$(document).ready(function(){
		$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
		var crudService = crudServiceBaseUrl + "qms/index/", isFailed = false,
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", cMode = "", fieldSort = "", dirSort = "";
        
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/rcontrolRef",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/rcontrolRef",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	console.log(jqXHR);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else {
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();							
						}
	                }
                },
                update: {
                    url: crudService + "manage/rcontrolRef",
                    type: "POST"
                },
                destroy: {
                    url: crudService + "remove/rcontrolRef",
                    type: "POST"
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
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "trancode");
				    query = filterFArr;
				    dirSort = ($(data.sort).length ? data.sort[0].dir : "desc")
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "logdate"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        }
			      }else {
			      	  data['loguser'] = $("#hidden_user").val();
			      	  return data;
			      }
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			    // console.log(type);
			    // console.log(response);
			},
            pageSize: 6,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue = "";
					    filterFArr = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        disc_code: { type: "string" },
                        trancode: { type: "string" },
                        prefix: { type: "string" },
                        control_no: { type: "string" },
                        suffix: { type: "string" },
                        control_desc: { type: "string" }
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
        
        var grid = $("#rowSelection").kendoGrid({
            dataSource: dataSource,
            selectable: "row",
            pageable: {
                buttonCount: 3,
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
            columns: [
               {field: "disc_code",title: "Code",width: 102},
               {field: "trancode",title: "Transac"},
               {field: "prefix",title: "Prefix"},
               {field: "control_no",title: "Control No."},
               {field: "suffix",title: "Suffix"},
               {field: "control_desc",title: "Description"}
               
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
			    grid_change(currRow);
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle("#rowSelection","Discipline Listing");
        
        var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");
	    
        var disc_code = $("#txt2").kendoComboBox({
        	enable: false,
            filter: "contains",
            placeholder: "Select Discipline",
            dataTextField: "disc_desc",
            dataValueField: "disc_code",
			autoBind: true,
            dataSource: {
                transport: {
                    read: crudService + "directCall/discRef",
            		contentType: "application/json"
                },
                schema: {
					data: function(data){
	                    return data.rows || [];
	                }
			    }	                    	
            }
         }).data("kendoComboBox");
         
	    $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
	    $(".wrap-button .buttonLeft button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "delButt":
	    				if (!confirm("Do you really want to delete this item?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
						dataRow = grid.data("kendoGrid").dataSource.getByUid(dataItem.uid);
    					$("#rowSelection").data("kendoGrid").dataSource.remove(dataRow);
						dataSource.sync();
						$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
						$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
						$("#rowSelection").data("kendoGrid").dataSource.read();
	    				return true;
	    			break;
	    			default:
						$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
		    			if (this.id == "addButt"){
		    				isFailed = false;
		    				disc_code.enable(true);
							$(".wrap-form input, .wrap-form textarea").val("");
							$(".wrap-form input").eq(0).select().focus();
							$('#rad1').prop("checked", true);
							$('input[name=option]').prop("disabled", true);
							cMode = "add";
		    			}else {
							$("#txt1").prop("disabled", true).addClass("k-state-disabled");
							$(".wrap-form textarea").select().focus();
							cMode = "edit";
						}
						$(".wrap-button button").prop("disabled", true).addClass("k-state-disabled");
						forDiv();
	    			break;
	    		}
	    	}
	    });
	    // var disc_code = $("#txt2").data("kendoComboBox");
	    
	    $(".wrap-form button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "saveButt":
	    				if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
	    				isFailed = verifyThisInput(".formLeft_qms");
			    		if (isFailed)
			    			return true;
	    				
						if (cMode == "add"){
							dataSource.add({PROGRESS_RECID: 0,
											trancode: $("#txt1").val(),
											disc_code: disc_code.value(),
											control_desc: $("#textarea").val(),
											prefix: $("#txt3").val(),
											control_no: $("#txt4").val(),
											suffix: $("#txt5").val(),
											flg_status: ($("#rad1").is(":checked") ? 1 : 0)});
							dataSource.sync();							
						}else
					        $.post(crudService + "manage/rcontrolRef",{PROGRESS_RECID: dataItem.PROGRESS_RECID,trancode: $("#txt1").val(), disc_code: disc_code.value(), control_desc: $("#textarea").val(), prefix: $("#txt3").val(), control_no: $("#txt4").val(), suffix: $("#txt5").val(), flg_status: ($("#rad1").is(":checked") ? 1 : 0)},
					       	    function(data){
									$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
									$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									$("#rowSelection").data("kendoGrid").dataSource.read();
					       	    });
	    			break;
	    			default:
	    				$(".thisIsRequired").removeClass('thisIsRequired');
		    			isFailed = false;
			    		grid_change(currRow);
	    			break;
	    		}
	    		if (isFailed)
	    			return true;
		    	disc_code.enable(false);
				$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				$("#coverDiv").remove();
	    	}
	    });
	});
</script>