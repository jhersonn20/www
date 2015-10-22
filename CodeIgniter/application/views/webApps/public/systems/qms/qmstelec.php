<div id="main-wrapper">
	<div style="min-height: 487px;margin-bottom: 5px;">
		<div class="wrap-form demo-section apply8" style="width: 37.1%;float:right;height: auto;display: block;">
			<fieldset>
				<legend> Instrument Take-Off Entry: </legend>
				<ul class="formLeft_qms" style="width: 100%;">
					<li style="margin-bottom: 0;">
						<label class="title" for="rad1" style="width: 95px;">Type:</label><input type="radio" name="option" id="rad1" /><label class="title short" for="rad1">Cable</label>
					</li>
					<li style="margin-bottom: 0;">
						<label class="title" for="rad2" style="width: 95px;">&nbsp;</label><input type="radio" name="option" id="rad2" /><label class="title short" for="rad2">Cable Drum</label>
					</li>
					<li>
						<label class="title" for="rad3" style="width: 95px;">&nbsp;</label><input type="radio" name="option" id="rad3" /><label class="title short" for="rad3">Equipment</label>
					</li>
					<li style="margin-bottom: 0;">
						<label class="title" for="rad4" style="width: 95px;">Equipment:</label><input type="radio" name="option1" id="rad4" /><label class="title short" for="rad4">Electrical Equipment</label>
					</li>
					<li>
						<label class="title" for="rad5" style="width: 95px;">&nbsp;</label><input type="radio" name="option1" id="rad5" /><label class="title short" for="rad5">Non-Electrical Equipment</label>
					</li>
					<li>
						<label class="title" for="txt1" style="width: 95px;">Tag No.:</label><input type="text" name="txt1" id="txt1" class="k-textbox" style="width: 72%;" />
					</li>
					<li>
						<label class="title" for="textarea" style="width: 95px;">Service Desc.:</label><textarea name="textarea" id="textarea" cols="20" rows="5" style="resize: none;width: 68%;margin: 0;"></textarea>
					</li>
					<li>
						<label class="title" for="txt2" style="width: 95px;">Sys. ID(Elect):</label><input type="text" name="txt2" id="txt2" class="k-textbox" style="width: 72%;" />
					</li>
					<li>
						<label class="title" for="txt3" style="width: 95px;">Sys. ID(Cable):</label><input type="text" name="txt3" id="txt3" class="k-textbox" style="width: 72%;" />
					</li>
					<li>
						<label class="title" for="txt5" style="width: 95px;">Drawing No.:</label><input type="text" name="txt5" id="txt5" class="k-textbox" style="width: 72%;"/>
					</li>
					<li>
						<label class="title" for="txt4" style="width: 95px;">Revision No.:</label><input type="text" name="txt4" id="txt4" class="k-textbox" style="width: 72%;" />
					</li>
					<li>
						<label class="title" for="txt6" style="width: 95px;">Sheet No:</label><input type="text" name="txt6" id="txt6" class="k-textbox" style="width: 72%;"/>
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
	</div>
	<div class="wrap-button demo-section">
		<div class="buttonLeft">
        	<button class="k-button mainEve" id="addButt">Add</button>
        	<button class="k-button mainEve" id="editButt">Edit</button>
        	<button class="k-button mainEve" id="delButt">Delete</button>
        	<button class="k-button mainEve" id="exportButt">Export</button>
       	</div>
		<div class="buttonRight">
        	<button class="k-button mainEve" id="closeButt">Close</button>
       	</div>				
	</div>
</div>
<script type="text/javascript">
	var cCable = "", cCableDrum = "", cEquipment = "", prog_arr = [];
	function grid_change(e){
		if (typeof e == "undefined")
			e = grid;
	    var selectedRows = e.select();
	    var selectedDataItems = [];
	    for (var i = 0; i < selectedRows.length; i++) {
	      dataItem = e.dataItem(selectedRows[i]);
		    $("#rad1").prop("checked",(dataItem.ele_type == cCable));
		    $("#rad2").prop("checked",(dataItem.ele_type == cCableDrum));
		    $("#rad3").prop("checked",(dataItem.ele_type != cCable && dataItem.ele_type != cCableDrum));
		    $("#rad4").prop("checked",(dataItem.elec_equip == 1));
		    $("#rad5").prop("checked",(dataItem.elec_equip == 0));
		    $("#txt1").val(dataItem.tag_no);
		    $("#textarea").val(dataItem.tag_desc);
		    $("#txt2").val(dataItem.elec_sys_id);
		    $("#txt3").val(dataItem.cab_sys_id);
		    $("#txt4").val(dataItem.drawing_no);
		    $("#txt5").val(dataItem.rev_no);
		    $("#txt6").val(dataItem.sheet_no);
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
		var crudService = crudServiceBaseUrl + "qms/index/",
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", cMode = "", fieldSort = "", dirSort = "";
        
        $.post(crudService + "directCall/pc_ELECT-TYPE",{},
        	function(data){
			    cCable = data.rows[0].p_char1;
			    cCableDrum = data.rows[0].p_char2;
			    cEquipment = data.rows[0].p_char3;
			    $.each(data.rows[0],function(index,value){
			    	if (index.indexOf("p_char") >= 0)
			    		prog_arr.push(value);
			    });
        	});
        
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/elecTo",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/elecTo",
                    type: "POST"
                },
                update: {
                    url: crudService + "manage/elecTo",
                    type: "POST"
                },
                destroy: {
                    url: crudService + "remove/elecTo",
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
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "drawing_no");
				    query = filterFArr;
				    dirSort = ($(data.sort).length ? data.sort[0].dir : "desc")
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			    // console.log(type);
			    // console.log(response);
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
                        ele_type: { type: "string" },
                        tag_no: { type: "string" },
                        drawing_no: { type: "string" },
                   	    sheet_no: { type: "string" },
                        rev_no: { type: "string" }
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
               {field: "ele_type",title: "Elect. Type",width: 66},
               {field: "tag_no",title: "Tag No.",width: 66},
               {field: "drawing_no",title: "Drawing",width: 125},
               {field: "sheet_no",title: "Sheet",width: 63},
               {field: "rev_no",title: "Revision",width: 77}
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
        
        var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");
	    
	    $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
	    $(".wrap-form input[type=radio]").css({"margin-right": "5px"});
	    $(".wrap-form input[name=option]").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "rad3":
						$('input[name=option1]').prop("disabled", false);
	    			break;
	    			default:
						$('input[name=option1]').prop("disabled", true);
	    			break;
	    		}
	    	}
	    });
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
                	case "exportButt":
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_elecTo/?";
				        link.href += ("fieldS=" + fieldSort + "&");
				        link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
				        link.href += ("dir=" + dirSort);
				 
				        //Dispatching click event.
				        if (document.createEvent) {
				            var e = document.createEvent('MouseEvents');
				            e.initEvent('click' ,true ,true);
				            link.dispatchEvent(e);
					    	close_preloader();
				            return true;
				        }
                	break;
	    			default:
						$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
						$(".wrap-form input").eq(0).select().focus();
		    			if (this.id == "addButt"){
							$(".wrap-form input, .wrap-form textarea").val("");
							$('input[name=option1]').prop("disabled", true);
							cMode = "add";
		    			}else {
							$("#txt1").prop("disabled", true).addClass("k-state-disabled");
							if (dataItem.ele_type != cEquipment)
								$('input[name=option1]').prop("disabled", true);
							cMode = "edit";
						}
						$(".wrap-button button").prop("disabled", true).addClass("k-state-disabled");
						forDiv();
	    			break;
	    		}
	    	}
	    });
	    $(".wrap-form button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "saveButt":
	    				if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
						if (cMode == "add"){
							dataSource.add({PROGRESS_RECID: 0,
											ele_type: prog_arr[$('input[name=option]:checked').index('input[name=option]')],
											elec_equip: ($('input[name=option1]:checked').index('input[name=option1]') == 1 ? 0 : 1),
											tag_no: $("#txt1").val(),
											elec_sys_id: $("#txt2").val(),
											cab_sys_id: $("#txt3").val(),
											drawing_no: $("#txt4").val(),
											rev_no: $("#txt5").val(),
											sheet_no: $("#txt6").val(),
											tag_desc: $("#textarea").val(),
											log_user: $("#hidden_user").val()});
							dataSource.sync();
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/elecTo",{PROGRESS_RECID: dataItem.PROGRESS_RECID,ele_type: prog_arr[$('input[name=option]:checked').index('input[name=option]')], elec_equip: ($('input[name=option1]:checked').index('input[name=option1]') == 1 ? 0 : 1), tag_no: $("#txt1").val(), elec_sys_id: $("#txt2").val(), cab_sys_id: $("#txt3").val(), drawing_no: $("#txt4").val(), rev_no: $("#txt5").val(), sheet_no: $("#txt6").val(),	tag_desc: $("#textarea").val(),	log_user: $("#hidden_user").val()},
					       	    function(data){
									$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
									$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									$("#rowSelection").data("kendoGrid").dataSource.read();
					       	    });
	    			break;
	    			default:
			    		grid_change(currRow);
	    			break;
	    		}
				$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				$("#coverDiv").remove();
	    	}
	    });
	});
</script>