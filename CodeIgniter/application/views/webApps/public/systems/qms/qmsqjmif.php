<div id="main-wrapper">
	<div class="jmif_phase">
		<div class="wrap-button demo-section" style="width: 98.8%;margin-left: 0;height: auto;">
			<div id="jmifHead" style="min-height: 10px;margin-bottom: 2px;">
		    	<div class="buttonLeft" style="min-height: 30px;margin-bottom: 3px;width: 70%;">
	        		<input type="text" name="txt1" id="txt1" style="width: 200px; margin-left: 0;" />
	        		<input type="radio" disabled name="option" checked id="rad1"  /><label class="title short" for="rad1">ALL</label>
		        	<input type="radio" disabled name="option" id="rad2" /><label class="title short" for="rad2">FOG Handover to WHSE</label>
		        	<input type="radio" disabled name="option" id="rad3" /><label class="title short" for="rad3">WHSE Handover to Client</label>
	       		</div>
	       		<div class="buttonRight" style="min-height: 10px;margin-bottom: 0px;">
	        		
		        	<input type="checkbox" disabled name="chk1" id="chk1"><label class="title short" for="chk1">Balance Issued Request</label>
	       		</div>
	   	    </div>  
	    </div> 	
	    <div class="wrap-grid demo-section" style="width: 98.8%;margin-left: 0;height: auto;">
	        <div id="rowSelection"></div>
	    </div>
		<div class="wrap demo-section">
	        	<label class="title" for="txt2" style="width: 145px;margin-left: 0;">Material Description:</label><input type="text" name="txt2" id="txt2" class="k-textbox k-state-disabled" disabled style="width: 170px;" />
	       		<label class="title" for="txt3" style="width: 110px;margin-left: 0;">Support Number:</label><input type="text" name="txt3" id="txt3" class="k-textbox k-state-disabled" disabled style="width: 105px;" />
	    </div>
		<div class="wrap-button demo-section" style="width: 99%;">
			<div class="buttonLeft" style="width: 100%;">
        		<button  class="k-button mainEve k-state-disabled"  id="exportButt" >Export</button>
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
			$("#txt2").val(dataItem.mat_desc);
			$("#txt3").val(dataItem.support_no);
			// $("#txt1").val(dataItem3.stock_no);
			// $("#txt2").val(dataItem3.item_code);
			// $("#txt3").val(dataItem3.commodity_code);
			// $("#txt4").val(dataItem3.uom);
			// $("#txt5").val(dataItem3.size);
			// $("#txt6").val(dataItem3.schedule);
			// $("#txt7").val(dataItem3.qty_takeoff);
			// $("#txt8").val(dataItem3.qty_mrr);
			// $("#txt9").val(dataItem3.qty_mrr);
			// $("#txt10").val(dataItem3.qty_issued);
			// $("#txt11").val(dataItem3.qty_rts);
			// $("#txt12").val(dataItem3.qty_onhand);   	
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
		var crudService = crudServiceBaseUrl + "qms/index/", isFailed = false, query = "",
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", cMode = "", fieldSort = "", dirSort = "";
        
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/treqissDtl_stock2",
                    contentType: "application/json",
                    type: "GET"
					
                },
                create: {
                    url: crudService + "manage/treqissDtl_stock2",
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
                    url: crudService + "manage/treqissDtl_stock2",
                    type: "POST"
                },
                destroy: {
                    url: crudService + "remove/treqissDtl_stock2",
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
				    
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "disc_code");
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
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    disc_code: disc_code.value(),
					    chkOption: $("#chk1").is(":checked") ? 1 : 0,
					    rsOption: $('input[name=option]:checked').index('input[name=option]')
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
                        jmif_no: { type: "string" },
                        stock_no: { type: "string" },
                        item_code: { type: "string" },
                        commodity_code: { type: "string" },
                        size: { type: "string" },
                        req_qty: { type: "string" }
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
            autoBind: false,
            filterable: {
                extra: false
            },
            columns: [
               {field: "jmif_no",title: "JMIF",width: 144},
               {field: "jmif_date",title: "JMIF Date",width: 101},
               {field: "stock_no",title: "Stock",width: 101},
               {field: "item_code",title: "item_code.",width: 101},
               {field: "commodity_code",title: "Commodity",width: 101},
               {field: "size",title: "size",width: 144},
               {field: "req_qty",title: "Request Qty",width: 101},
               {field: "iss_qty",title: "Issued Quantity",width: 125},
               {field: "area_no",title: "Area No",width: 101},
               {field: "drawing_no",title: "Drawing No",width: 145},
               {field: "sheet_no",title: "Sheet no",width: 101},
               {field: "uom",title: "UOM",width: 101},
               {field: "measurement",title: "Measurement",width: 101},
               {field: "mat_util",title: "Material Utilization",width: 144},
               {field: "item_no",title: "Item No"},
               {field: "mat_desc",title: "Material Description",width: 164}
               
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }grid_change(currRow, "#rowSelection" );
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle("#rowSelection","  ");
        
        var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");
	   $("#chk1").change(function(){
	     	 dataSource.read();	   
	     }); 
	    $("input[name=option]").change(function(){
	     	dataSource.read();									
	    });   
       var disc_code = $("#txt1").kendoComboBox({
        	enable: true,
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
            },
		    change: function(e){
		        //grid_change(this,"rowSelection"); //display of data into fields
				dataSource.read();
				 $("#rad1,#rad2,#rad3,#exportButt,#chk1").prop("disabled", false).removeClass("k-state-disabled");
				//treqissdtl_ds.read();	//calling the other browser
		    
       		}
         }).data("kendoComboBox");
	    $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
	    $("#exportButt").prop("disabled", true).addClass("k-state-disabled");
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
	    
	    $(".wrap-button button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "exportButt":
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_treqissDtl_stock/?";
				        link.href += ("fieldS=" + fieldSort + "&");
				        link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
				        link.href += ("dir=" + dirSort + "&chkOption="+ $("#chk1").is(":checked") ? 1 : 0);
				 		link.href += ("&rsOption="+ $('input[name=option]:checked').index('input[name=option]') + "&disc_code=" + disc_code.value());
				        //Dispatching click event.
				        if (document.createEvent) {
				            var e = document.createEvent('MouseEvents');
				            e.initEvent('click' ,true ,true);
				            link.dispatchEvent(e);
					    	close_preloader();
				            return true;
				        }
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


	
