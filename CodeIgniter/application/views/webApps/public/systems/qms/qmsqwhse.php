<div id="main-wrapper">
	<div class="jmif_phase">
		<div id="jmifHead" style="min-height: 260px;margin-bottom: 5px;">
		    <div class="wrap-grid demo-section" style="width: 98.8%;margin-left: 0;height: auto;">
		        <div id="rowSelection"></div>
		    </div>
		</div>
		<div class="wrap demo-section apply8" style="min-height: 50px;">
			<div class="buttonLeft" style="width: 100%;"  >
			<ul>
				<li>
					<label class="title" for="txt1" style="width: 60px;margin-left: 0;">Area No:</label><input type="text" name="txt1" id="txt1" class="k-textbox k-state-disabled" disabled style="width: 100px;margin-right: 0px;" />
	       			<label class="title" for="txt2" style="width: 30px;margin-left: 0;">ISO:</label><input type="text" name="txt2" id="txt2" class="k-textbox k-state-disabled" disabled style="width: 155px;margin-right: 0px;" />
	       			<label class="title" for="txt3" style="width: 75px;margin-left: 0;">Item Code:</label><input type="text" name="txt3" id="txt3" class="k-textbox k-state-disabled" disabled style="width: 120px;margin-right: 0px;" />
	       			<label class="title" for="txt4" style="width: 30px;margin-left: 0;">Size:</label><input type="text" name="txt4" id="txt4" class="k-textbox k-state-disabled" disabled style="width: 85px;margin-right: 0px;" />
	       			<label class="title" for="txt5" style="width: 30px;margin-left: 0;">Spool:</label><input type="text" name="txt5" id="txt5" class="k-textbox k-state-disabled" disabled style="width: 85px;margin-right: 0px;" />
	       			<label class="title" for="txt6" style="width: 60px;margin-left: 0;">Item No:</label><input type="text" name="txt6" id="txt6" class="k-textbox k-state-disabled" disabled style="width: 100px;margin-right: 0px;" />
	       		</li>
				<li>
					<label class="title" for="txt7" style="width: 130px;margin-left: 0;">Material Description:</label><input type="text" name="txt7" id="txt7" class="k-textbox k-state-disabled" disabled style="width: 845px;" />
	       		</li>
			</ul>
	        </div>
			
		</div>
		<div class="wrap-button demo-section" style="width: 100%;">
			<div class="buttonLeft" style="width: 100%;">
        	<button class="k-button mainEve" id="exportButt">Export</button>
        	<button class="k-button mainEve" id="closeButt" style="float: right;">Close</button>
        
   			</div>
  			
	    </div>	
	</div>
	
</div>

<script type="text/javascript">
	var processMatTO = false;
	var dataItem3 = '';
	function grid_change(e,grid){
		if (typeof e == "undefined")
			e = grid;
		var selectedRows = e.select();
		var selectedDataItems = [];
		var dataItem = [];
		for (var i = 0; i < selectedRows.length; i++) {
			dataItem = e.dataItem(selectedRows[i]);
			$("#txt1").val(dataItem.area_no);
			$("#txt2").val(dataItem.drawing_no);
			$("#txt3").val(dataItem.item_code);
			$("#txt4").val(dataItem.size);
			$("#txt5").val(dataItem.spool_no);
			$("#txt6").val(dataItem.item_no);
			$("#txt7").val(dataItem.mat_desc);
			
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
                    url: crudService + "directCall/pipTwhse",
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
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "log_date");
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
			      }else {
			      	  data['log_user'] = $("#hidden_user").val();
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
            pageSize: 10,
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
                        area_no: { type: "string" },
                        drawing_no: { type: "string" },
                        sheet_no: { type: "string" },
                        rev_no: { type: "string" },
                        item_code: { type: "string" },
                        size: { type: "string" },
                        uom: { type: "string" },
                        spool_no: { type: "string" },
                        spl_type: { type: "string" },
                        category: { type: "string" },
                        item_no: { type: "string" },
                        qty: { type: "float" },
                        mat_desc: { type: "string" },
                        client_refno: { type: "string" },
                        client_refdate: { type: "string" },
                        rcvd_by: { type: "string" },
                        rcvd_date: { type: "date" },
                        iss_qty: { type: "float" },
                        issued_date: { type: "date" },
                        qcmrir_no: { type: "string" },
                        qcmrir_date: { type: "date" },
                        rfi_no: { type: "string" },
                        rfi_date: { type: "date" },
                        jmif_no: { type: "string" },
                        req_qty: { type: "float" },
                        stock_no: { type: "string" },
                        commodity_code: { type: "string" }
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
               {field: "area_no",title: "Area No",width: 120},
               {field: "drawing_no",title: "Drawing No",width: 140},
               {field: "sheet_no",title: "Sheet No",width: 120},
               {field: "rev_no",title: "Rev No",width: 120},
               {field: "item_code",title: "Item Code",width: 120},
               {field: "size",title: "Size",width: 120},
               {field: "uom",title: "UOM",width: 120},
               {field: "spool_no",title: "Spool No",width: 120},
               {field: "spl_type",title: "Spool Type",width: 120},
               {field: "category",title: "Category"},
               {field: "item_no",title: "Item No",width: 120},
               {field: "qty",title: "Quantity",width: 120},
               {field: "mat_desc",title: "Description",width: 120},
               {field: "client_refno",title: "Client Ref No",width: 120},
               {field: "client_refdate",title: "Client Ref Date",width: 120,format: "{0:MM/dd/yyyy}"},
               {field: "rcvd_by",title: "Received By",width: 120},
               {field: "rcvd_date",title: "Received Date",width: 120,format: "{0:MM/dd/yyyy}"},
               {field: "iss_qty",title: "Issued Qty",width: 120},
               {field: "issued_date",title: "Issued Date",width: 120,format: "{0:MM/dd/yyyy}"},
               {field: "qcmrir_no",title: "QCMRIR",width: 120},
               {field: "qcmrir_date",title: "QCMRIR Date",width: 120,format: "{0:MM/dd/yyyy}"},
               {field: "rfi_no",title: "RFI No",width: 120},
               {field: "rfi_date",title: "RFI Date",width: 120,format: "{0:MM/dd/yyyy}"},
               {field: "jmif_no",title: "JMIF No",width: 120},
               {field: "req_qty",title: "Request Qty",width: 120},
               {field: "stock_no",title: "Stock No",width: 120},
               {field: "commodity_code",title: "Commodity Code",width: 140},
               
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    } grid_change(currRow, "#rowSelection" )
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle("#rowSelection","ENGG Material Take Off");
        
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
	    			case "exportButt":
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_pipTwhse/?";
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
											spltype_code: $("#txt1").val(),
											spltype_desc: $("#textarea").val(),
											active: ($("#rad1").is(":checked") ? 1 : 0)});
							dataSource.sync();
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/spool_type",{PROGRESS_RECID: dataItem.PROGRESS_RECID,spltype_code: $("#txt1").val(), spltype_desc: $("#textarea").val(), active: ($("#rad1").is(":checked") ? 1 : 0)},
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
				$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				$("#coverDiv").remove();
	    	}
	    });
	});
</script>