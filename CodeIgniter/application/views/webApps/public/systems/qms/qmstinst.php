<div id="main-wrapper">
	<div style="min-height: 397px;margin-bottom: 5px;">
		<div class="wrap-form demo-section apply8" style="width: 37.1%;float:right;height: auto;display: block;">
			<fieldset>
				<legend> Instrument Take-Off Entry: </legend>
				<ul class="formLeft_qms" style="width: 100%;">
					<li>
						<label class="title" for="txt1" style="width: 90px;">Loop No.:</label><input type="text" name="txt1" id="txt1" class="k-textbox" style="width: 72%;" />
					</li>
					<li>
						<label class="title" for="txt2" style="width: 90px;">Tag No.:</label><input type="text" name="txt2" id="txt2" class="k-textbox" style="width: 72%;" />
					</li>
					<li>
						<label class="title" for="txt3" style="width: 90px;">Sheet No.:</label><input type="text" name="txt3" id="txt3" class="k-textbox" style="width: 72%;" />
					</li>
					<li>
						<label class="title" for="txt4" style="width: 90px;">Revision No.:</label><input type="text" name="txt4" id="txt4" class="k-textbox" style="width: 72%;" />
					</li>
					<li>
						<label class="title" for="txt5" style="width: 90px;">Drawing No.:</label><input type="text" name="txt5" id="txt5" class="k-textbox" style="width: 72%;"/>
					</li>
					<li>
						<label class="title" for="textarea" style="width: 90px;">Service Desc.:</label><textarea name="textarea" id="textarea" cols="20" rows="5" style="resize: none;width: 72%;margin: 0;padding: 0;"></textarea>
					</li>
					<li>
						<label class="title" for="txt6" style="width: 90px;">Location:</label><input type="text" name="txt6" id="txt6" class="k-textbox" style="width: 72%;"/>
					</li>
					<li>
						<label class="title" for="txt7" style="width: 90px;">Inst. Type:</label><input type="text" name="txt7" id="txt7" class="k-textbox" style="width: 72%;" />
					</li>
					<li>
						<label class="title" for="txt8" style="width: 90px;">P & ID No.:</label><input type="text" name="txt8" id="txt8" class="k-textbox" style="width: 72%;" />
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
	function grid_change(e){
		if (typeof e == "undefined")
			e = grid;
	    var selectedRows = e.select();
	    var selectedDataItems = [];
	    for (var i = 0; i < selectedRows.length; i++) {
	      dataItem = e.dataItem(selectedRows[i]);
		    $("#txt1").val(dataItem.lp_no);
		    $("#txt2").val(dataItem.tag_no);
		    $("#txt3").val(dataItem.sheet_no);
		    $("#txt4").val(dataItem.rev_no);
		    $("#txt5").val(dataItem.drawing_no);
		    $("#txt6").val(dataItem.loc_code);
		    $("#txt7").val(dataItem.tag_type);
		    $("#txt8").val(dataItem.pid_no);
		    $("#textarea").val(dataItem.tag_desc);
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
        
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/insTo",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/insTo",
                    type: "POST"
                },
                update: {
                    url: crudService + "manage/insTo",
                    type: "POST"
                },
                destroy: {
                    url: crudService + "remove/insTo",
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
                        lp_no: { type: "string" },
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
               {field: "lp_no",title: "Loop No.",width: 66},
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
				        link.href = crudService + "directCall/export_insTo/?";
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
		    			if (this.id == "addButt"){
							$(".wrap-form input, .wrap-form textarea").val("");
							$(".wrap-form input").eq(0).select().focus();
							cMode = "add";
		    			}else {
							$("#txt1").prop("disabled", true).addClass("k-state-disabled");
							$("#txt2").prop("disabled", true).addClass("k-state-disabled");
							$(".wrap-form input").eq(2).select().focus();
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
											lp_no: $("#txt1").val(),
											tag_no: $("#txt2").val(),
											sheet_no: $("#txt3").val(),
											rev_no: $("#txt4").val(),
											drawing_no: $("#txt5").val(),
											loc_code: $("#txt6").val(),
											tag_type: $("#txt7").val(),
											pid_no: $("#txt8").val(),
											tag_desc: $("#textarea").val(),
											log_user: $("#hidden_user").val()});
							dataSource.sync();
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/insTo",{PROGRESS_RECID: dataItem.PROGRESS_RECID,log_user: $("#hidden_user").val(),lp_no: $("#txt1").val(),tag_no: $("#txt2").val(),sheet_no: $("#txt3").val(),rev_no: $("#txt4").val(),drawing_no: $("#txt5").val(),loc_code: $("#txt6").val(),tag_type: $("#txt7").val(),pid_no: $("#txt8").val(),tag_desc: $("#textarea").val()},
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