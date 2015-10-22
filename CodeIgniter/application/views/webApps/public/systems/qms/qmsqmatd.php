<div id="main-wrapper">
	<div style="min-height: 493px;margin-bottom: 5px;">
		<div class="wrap-form demo-section apply8" style="width: 37.1%;float:right;height: 481px;display: block;">
			<fieldset>
				<legend> Spool type Reference: </legend>
				<ul class="formLeft_qms" style="width: 100%;">
					<li>
						<label class="title" for="txt1" style="width: 130px;">Stock No:</label><input type="text" required name="txt1" id="txt1" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="textarea" style="width: 130px;">Description:</label><textarea name="textarea" id="textarea" cols="20" rows="3" style="resize: none;width: 57%;margin: 0;"></textarea>
					</li>
					<li>
						<label class="title" for="txt2" style="width: 130px;">Item Code:</label><input type="text" required name="txt2" id="txt2" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt3" style="width: 130px;">Comm Code:</label><input type="text" required name="txt3" id="txt3" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt4" style="width: 130px;">UOM:</label><input type="text" required name="txt4" id="txt4" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt5" style="width: 130px;">Size:</label><input type="text" required name="txt5" id="txt5" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt6" style="width: 130px;">Schedule:</label><input type="text" required name="txt6" id="txt6" class="k-textbox" style="width: 61%;" />
					</li>
					
					<li>
						<label class="title" for="txt7" style="width: 130px;">MTO Qty:</label><input type="text" required name="txt7" id="txt7" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt8" style="width: 130px;">MRR Qty:</label><input type="text" required name="txt8" id="txt8" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt9" style="width: 130px;">Issued Qty:</label><input type="text" required name="txt9" id="txt9" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt10" style="width: 130px;">RTTS Qty:</label><input type="text" required name="txt10" id="txt10" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt11" style="width: 130px;">RTS Qty:</label><input type="text" required name="txt11" id="txt11" class="k-textbox" style="width: 61%;" />
					</li>
					<li>
						<label class="title" for="txt12" style="width: 130px;">On Hand Qty:</label><input type="text" required name="txt12" id="txt12" class="k-textbox" style="width: 61%;" />
					</li>				
				</ul>
			</fieldset>
		</div>
	    <div class="wrap-grid demo-section" style="width: 60%;margin-left: 0;height: auto;">
	        <div id="rowSelection"></div>
	    </div>
	   <!--  <div class="jmifdtl_phase" style="margin-top: 5px; ">
		<div id="jmifDtlHead" style="margin-bottom: 5px; ">
		    <div class="wrap-grid demo-section" style="width: 100%;margin-left: 0;height: auto;">
		        <div id="jmifdtl_rs"></div>
		        	<div class="wrap-grid demo-section" style="width: 50%;margin-left: 0;height: auto;">
	       			 <div id="rowSelection2"></div>
	    			</div>
	    			<div class="wrap-grid demo-section" style="width: 47%;margin-right: 0;height: auto;">
	       			 <div id="rowSelection3"></div>
	    			</div>
				<fieldset style="margin-top: 5px;">
					<ul style="float: left;">
						<li>
							<label class="title" for="txt25" style="width: auto;">Log User:</label><input type="text" name="txt2" id="txt2" class="k-textbox k-state-disabled" disabled style="width: 85px;" />
							<label class="title" for="txt26" style="width: auto;">Log Date:</label><input type="text" name="txt3" id="txt3" class="k-textbox k-state-disabled" disabled style="width: 85px;" />
							<label class="title" for="txt27" style="width: auto;">Log Update:</label><input type="text" name="txt4" id="txt4" class="k-textbox k-state-disabled" disabled style="width: 200px;" />
						</li>
					</ul>
				</fieldset>
		    </div>
		</div> -->
	</div>
	<div style="min-height: 212px;margin-bottom: 8px;">
		<div class="wrap-grid demo-section" style="width: 100%;float:right;width:47%;display: block;">
	        <div id="treqissdtl_rs"></div>
	    </div>
		<div class="wrap-grid demo-section" style="width: 50%;margin-left: 0;display: block;">
	        <div id="jwrrdtl_rs"></div>
	    </div>	
    </div>
	<div class="wrap-button demo-section style="width: 100%;">		
		<div class="buttonRight">
        	<button class="k-button mainEve" id="closeButt">Close</button>
       	</div>				
	</div>	
</div>

<script type="text/javascript">
	var processMatTO = false;
	function grid_change(e,grid){
		if (typeof e == "undefined")
			e = grid;
		var selectedRows = e.select();
		var selectedDataItems = [];
		for (var i = 0; i < selectedRows.length; i++) {
			dataItem3 = e.dataItem(selectedRows[i]);
			$("#txt1").val(dataItem3.stock_no);
			$("#textarea").val(dataItem3.description);
			$("#txt2").val(dataItem3.item_code);
			$("#txt3").val(dataItem3.commodity_code);
			$("#txt4").val(dataItem3.uom);
			$("#txt5").val(dataItem3.size);
			$("#txt6").val(dataItem3.schedule);
			$("#txt7").val(dataItem3.qty_takeoff);
			$("#txt8").val(dataItem3.qty_mrr);
			$("#txt9").val(dataItem3.qty_mrr);
			$("#txt10").val(dataItem3.qty_issued);
			$("#txt11").val(dataItem3.qty_rts);
			$("#txt12").val(dataItem3.qty_onhand);                      
			
	    }
	}
	function forDiv(div){
		var container = $("#" + div);
		var position = container.offset();	
		var offsetHeight = container.height();
		var offsetWidth = container.width();
		var newDiv = $("<div id = 'coverDiv' style='z-index: 10000;position: absolute;'>").appendTo($("body"));
		newDiv.offset(position);
		newDiv.height(offsetHeight + 87);
		newDiv.width(offsetWidth);
	}
	$(document).ready(function(){
		$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
		var crudService = crudServiceBaseUrl + "qms/index/",
		    filterFArr = [], filterOArr = [], filterVArr = [], currRow = "", dataItem = '', 
		    filterFArr_jwrrdtl = [], filterOArr_jwrrdtl = [], filterVArr_jwrrdtl = [], currRow2 = "", jwrrdtl_di = '', 
		    filterFArr_jmifdtl = [], filterOArr_jmifdtl = [], filterVArr_jmifdtl = [], currRow3 = "", jmifdtl_di = '',
		    isFailed = false, fieldSort = "", dirSort = "", query = "";
		
		$(".wrap-button button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();
		});
		
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/materialRef",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/materialRef",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                update: {
                    url: crudService + "manage/materialRef",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                destroy: {
                    url: crudService + "remove/materialRef",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
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
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "commodity_code"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "asc") 
			        }
			      }else {
			      	data.flg_status = (data.flg_status ? 1 : 0)
			      	return data;
			      }
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 14,
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
					    filterFArr = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        stock_no: { type: "string" },
                        size: { type: "string" },
                        mat_type: { type: "string" },
                        description: { type: "string" },
                        item_code: { type: "string" },
                        commodity_code: { type: "string" },
                        uom: { type: "string" },
                        schedule: { type: "string" },
                        qty_takeoff: { type: "number" },
                        qty_mrr: { type: "number" },
                        qty_issued: { type: "number" },
                        qty_returned: { type: "number" },
                        qty_rts: { type: "number" },
                        qty_onhand: { type: "number" }
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

	    var addExtraStylingToGrid = function(){
			$("#rowSelection").data("kendoGrid").select("tr:eq(1)");
	        $("#rowSelection > .k-grid-content > table > tbody > tr").hover(
	            function(){
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr = [];
	    };

        var grid = $("#rowSelection").kendoGrid({
            dataSource: dataSource,
            selectable: "row",
            pageable: {
                buttonCount: 5,
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
            columns: [ //display on textbox
               {field: "stock_no",title: "Stock No.",width: 154},
               {field: "size",title: "Size", width: 72},
               {field: "mat_type",title: "Material Type", width: 111},
               {field: "description",title: "Description", width: 386},
               {field: "commodity_code",title: "Commodity",width: 154},
               {field: "uom",title: "UOM",width: 55},
               {field: "schedule",title: "Schedule",width: 85},
               {field: "qty_takeoff",title: "MTO Qty.", width: 103,filterable: false},
               {field: "qty_mrr",title: "MRR Qty.", width: 103,filterable: false},
               {field: "qty_issued",title: "Issued Qty.", width: 103,filterable: false},
               {field: "qty_returned",title: "Returned Qty.", width: 103,filterable: false},
               {field: "qty_rts",title: "RTS Qty.", width: 103,filterable: false},
               {field: "qty_onhand",title: "On-Hand Qty.", width: 103,filterable: false}
              
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			        grid_change(this,"rowSelection"); //display of data into fields
					jwrrdtl_ds.read();
					treqissdtl_ds.read();	//calling the other browser
			    }
           },
           dataBound: addExtraStylingToGrid
        });
		$("#rowSelection .k-grid-toolbar").hide();
        insertGridTitle('#rowSelection','Material File');  
        
        //-- jwrr grid --                  

        var jwrrdtl_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/tjwrrDtl_stock",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_jwrrdtl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_jwrrdtl[index] = this.operator;
				      		filterVArr_jwrrdtl[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_jwrrdtl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "disc_code"),
					    operator: (($(data.filter).length > 0) ? filterOArr_jwrrdtl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_jwrrdtl : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    stock_no: dataItem.stock_no
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
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
               	    if (filterFArr_jwrrdtl.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_jwrrdtl = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        disc_code: { type: "string" },
                        jwrr_no: { type: "string" }
                       
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
                                
	    var addExtraStylingToGrid2 = function () {
			$("#jwrrdtl_rs").data("kendoGrid").select("tr:eq(" + (dataSource._data.length + 2) + ")");
	        $("#jwrrdtl_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_jmifdtl = [];
	    };
        
        var grid2 = $("#jwrrdtl_rs").kendoGrid({
            dataSource: jwrrdtl_ds,
            selectable: "row",
            pageable: {
                buttonCount: 3,
    			input: true
            },
            autoBind: false,
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
               {field: "disc_code",title: "Code",width: 170},
               {field: "jwrr_no",title: "JWRR No."}
                    
           ],
           change: function(e){
           		currRow2 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        jwrrdtl_di = this.dataItem(selectedRows[i]);
			    }
           },
           dataBound: addExtraStylingToGrid2
        });
        		// -- treqissDtl_stock --
        
        
        var treqissdtl_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/treqissDtl_stock",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_jmifdtl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_jmifdtl[index] = this.operator;
				      		filterVArr_jmifdtl[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_jmifdtl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "disc_code"),
					    operator: (($(data.filter).length > 0) ? filterOArr_jmifdtl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_jmifdtl : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    stock_no: dataItem.stock_no
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 4,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_jmifdtl.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_jmifdtl = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        disc_code: { type: "string" },
                        jmif_no: { type: "string" }
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
                                
	    var addExtraStylingToGrid3 = function () {
			$("#treqissdtl_rs").data("kendoGrid").select("tr:eq(" + (dataSource._data.length + 2) + ")");
	        $("#treqissdtl_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_jmifdtl = [];
	    };
        
        var grid3 = $("#treqissdtl_rs").kendoGrid({
            dataSource: treqissdtl_ds,
            selectable: "row",
            pageable: {
                buttonCount: 3,
    			input: true
            },
            autoBind: false,
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
               {field: "disc_code",title: "Code",width: 170},
               {field: "jmif_no",title: "JMIF No."}
                    
           ],
           change: function(e){
           		currRow3 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        jmifdtl_di = this.dataItem(selectedRows[i]);
			    }
           },
           dataBound: addExtraStylingToGrid3
        });
                 
	    $(".wrap-button button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "delButt":
	    				if (!confirm("Do you really want to delete this item?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
    					$("#rowSelection").data("kendoGrid").dataSource.remove(dataItem);
						dataSource.sync();
						dataSource.page(dataSource.page());
						dataSource.read();
	    				return true;
	    			break;
	    			case "delButt2":
	    				if (!confirm("Do you really want to delete this item?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
    					$("#jwrrdtl_rs").data("kendoGrid").dataSource.remove(jmifdtl_di);
						jwrrdtl_ds.sync();
						jwrrdtl_ds.page(jwrrdtl_ds.page());
	    				return true;
	    			break;
	    			case "viewButt":
						showDetails("template","JMIF Details",merge(dataItem,jmifdtl_di));
	    			break;
	    			case "finButt":			      	
	    				if (!confirm("Do you want to finalize this transaction?"))
	    					return true;
	    					
	    				$.post(crudService + "manage/treq_fin",{PROGRESS_RECID: dataItem.PROGRESS_RECID, finalized: ($(this).text() == "Finalize") ? 1 : 0, log_user: $("#hidden_user").val(), jmif_no: dataItem.jmif_no, disc_code: disc_code, iss_by: ($(this).text() == "Finalize") ? $("#hidden_user").val() : '', whse_prep: 1, jmif_date: kendo.toString(dataItem.jmif_date,"yyyy-MM-dd"), sub_date_fog: kendo.toString(dataItem.sub_date_fog,"yyyy-MM-dd"), sub_date_client: kendo.toString(dataItem.sub_date_client,"yyyy-MM-dd")},
	    					function(data){
	    						if ($.trim(data) != 1)				
									showNotif('Warning',data,'warning');
								dataSource.page(dataSource.page());
	    					});
	    			break;	   
	    			case "enggButt":			
						$.post(crudService + "directCall/verifyRUD",{log_user: $("#hidden_user").val(), disc_code: disc_code},
							function(data){
								if (data != 1){
					    			$("#window").data("kendoWindow").setOptions({
									    title: "Eng'g Material Take-Off List Help",
									    width: "991px",
									    height: "auto",
									    close: function(){
									    	jwrrdtl_ds.page(1);
									    	jwrrdtl_ds.read();
									    }
									});
									$("#window").data("kendoWindow").refresh({
										url: "/codeIgniter/index.php/webapps/qms/index/index/qmsteng",
										type: "POST",
										data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
									});
						        	$("#window").data("kendoWindow").center().open();									
								}
							});
	    			break;
	    			case "issButt":
	    				if ((dataItem.sub_date_fog == null || dataItem.sub_date_client == null) && disc_code == "pip"){
	    					showNotif("Notice","FOG Submitted Date/Client Submitted Date must not be blank prior to issuance.","notice");
	    					return true;
	    				}
	    				
				        $.post(crudService + "manage/qc_inspec",{jmif_no: dataItem.jmif_no},
				       	    function(data){
				       	    	if (data != '0'){
									showNotif('Warning',data,'warning');
									return true;
								}else {
					    			$("#window").data("kendoWindow").setOptions({
									    title: "Material File Issuance",
									    width: "991px",
									    height: "auto",
									    close: function(){
									    	jwrrdtl_ds.page(1);
									    	jwrrdtl_ds.read();
									    }
									});
									$("#window").data("kendoWindow").refresh({
										url: "/codeIgniter/index.php/webapps/qms/index/index/qmstciss_pip",
										type: "POST",
										data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
									});
						        	$("#window").data("kendoWindow").center().open();									
								}
				       	    });
	    			break;
	    			case "saveButt":
	    			case "canButt":
	    				if (this.id == "saveButt"){
		    				if (!confirm("Are you sure you want to save this data?"))
		    					return true;
	
		    				$("#rowSelection .k-grid-toolbar .k-grid-save-changes").trigger( "click" );
	    				}else
	    					$( "#rowSelection .k-grid-toolbar .k-grid-cancel-changes" ).trigger( "click" );
	    						    				
						$(".wrap-button button").each(function(index,value){
							if ($(this).parent().parent().parent().prop("class") == "jmif_phase"){
								if ($(this).hasClass("mainEve"))
									$(this).show();
								else
									$(this).hide();
							}else
								$(this).prop("disabled", false).removeClass("k-state-disabled");
								
							if (($(".wrap-button button").length - 1) == index)
								dataSource.read();
						});
						$("#coverDiv").remove();
	    			break;
	    			case "saveButt2":
	    			case "canButt2":
	    				if (this.id == "saveButt2"){
		    				if (!confirm("Are you sure you want to save this data?")){
		    					e.preventDefault();
		    					return true;
		    				}
				    			
				    		if ($("#jwrrdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(3).text().indexOf("pipe") < 0 || jmifdtl_di.excess){
				    			if (jmifdtl_di.iss_qty > jmifdtl_di.req_qty){
									showNotif('Warning',"Issued Qty. must not be greater than the Requested Qty.",'warning');
				    				return true;
				    			}
				    		}
		    				
		    				if (($.trim(jmifdtl_di.drawing_no) != $.trim(drawing_no_old)) || ($.trim(jmifdtl_di.spool_no) != $.trim(spool_no_old)))
		    					hasChange = true;
	
		    				$("#jwrrdtl_rs .k-grid-toolbar .k-grid-save-changes").trigger( "click" );
	    				}else {
	    					$( "#jwrrdtl_rs .k-grid-toolbar .k-grid-cancel-changes" ).trigger( "click" );
	    						    				
							$(".wrap-button button").each(function(index,value){
								if ($(this).parent().parent().parent().prop("class") == "jmifdtl_phase"){
									if ($(this).hasClass("mainEve"))
										$(this).show();
									else
										$(this).hide();
								}else
									$(this).prop("disabled", false).removeClass("k-state-disabled");
									
								if (($(".wrap-button button").length - 1) == index)
									dataSource.read();
							});						
							$("#coverDiv").remove();
						}
	    			break;
	    			default:
	    				if (this.id.indexOf("2") < 0){
			    			if (this.id == "addButt"){
								cMode = "add";
			    				$("#rowSelection").data("kendoGrid").addRow();
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).find("input").focus();
			    			}else {
			    				if (typeof dataItem == "string")
			    					return true;
								cMode = "edit";
			    				$("#rowSelection").data("kendoGrid").editRow($("#rowSelection").data("kendoGrid").select());
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(7).html(dataItem.qty_takeoff);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(8).html(dataItem.qty_mrr);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(9).html(dataItem.qty_issued);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(10).html(dataItem.qty_returned);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(11).html(dataItem.qty_rts);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(12).html(dataItem.qty_onhand);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).find("input").select().focus();
			    			}
		    				
							$(".wrap-button button").each(function(index,value){
								if ($(this).parent().parent().parent().prop("class") == "jmif_phase"){
									if ($(this).hasClass("mainEve"))
										$(this).hide();
									else
										$(this).show();
								} else
									$(this).prop("disabled", true).addClass("k-state-disabled");
							});
						}else {
							if (dataItem.length == 0)
								return true;
			    			if (this.id == "addButt2")
			    				$("#rowSelection").data("kendoGrid").addRow();
			    			else {
			    				$("#rowSelection").data("kendoGrid").editRow($("#rowSelection").data("kendoGrid").select());
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(7).html(dataItem.qty_takeoff);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(8).html(dataItem.qty_mrr);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(9).html(dataItem.qty_issued);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(10).html(dataItem.qty_returned);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(11).html(dataItem.qty_rts);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(12).html(dataItem.qty_onhand);
			    			}
	    
							$(".wrap-button button").each(function(index,value){
								if ($(this).parent().parent().parent().prop("class") == "jmifdtl_phase"){
									if ($(this).hasClass("mainEve"))
										$(this).hide();
									else
										$(this).show();
								} else
									$(this).prop("disabled", true).addClass("k-state-disabled");
							});
						}
						forDiv((this.id.indexOf("2") < 0) ? "jwrrdtl_rs" : "rowSelection");
	    			break;
	    		}
	    	}
	    });
	});
</script>