<style>
	#win_main-wrapper {margin-top: 0;padding: 0;}
	.k-upload-files {width: 630px;}
	.buttonLeft {width: 50%;}
	.editable {background-color:rgb(239,239,239);}
    .k-alt .editable {background-color: #ccc;}
    tr.k-state-selected .editable {background-color: initial;}
</style>
<div id="win_main-wrapper" style="width: 100%;">
	<div class="tempNS_phase" style="width: 100%;">
		<div id="tempNSHead" style="min-height: 260px;margin-bottom: 5px;">
		    <div class="wrap-grid demo-section" style="width: 98.8%;margin-left: 0;height: auto;">
		        <div id="tempNS_rs"></div>
		    </div>
		</div>
		<div class="wrap-button demo-section">
			<div class="buttonLeft">
	        	<button class="k-button mainEve" id="upButt"> Up </button>
	       	</div>
			<div class="buttonRight">
	        	<button class="k-button mainEve" id="downButt"> Down </button>
	       	</div>
		</div>
	</div>
	<div class="tempS_phase" style="margin-top: 5px !important;">
		<div id="tempSHead" style="margin-bottom: 5px;">
		    <div class="wrap-grid demo-section" style="width: 98.8%;margin-left: 0;height: auto;">
		        <div id="tempS_rs"></div>
		    </div>
		</div>
		<div class="wrap-button demo-section">
			<div class="buttonLeft">
	        	<button class="k-button mainEve k-state-disabled" disabled id="doneButt">Done</button>
	       	</div>
			<div class="buttonRight">
	        	<button class="k-button" disabled id="saveButt2">Apply</button>
	       	</div>				
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var crudService = crudServiceBaseUrl + "qms/index/",
			disc_code = pathname.split('/')[pathname.split('/').length - 1],
		    filterFArr_treqDtl = [], filterOArr_treqDtl = [], filterVArr_treqDtl = [], sentValue = "", currRow = "", currRow2 = "", cMode = "", jmif_di = '', jmifdtl_di = '', isFailed = false,
		    filterFArr_jmifdtl = [], filterOArr_jmifdtl = [], filterVArr_jmifdtl = [], sentValue_jmifdtl = "", fieldSort = "", dirSort = "", query = "", down_di = '', up_di = '',
			optionArr = ["","jmif_no","jmif_date","supp_code","pl_dn_inv","po_no","deliv_by"],			
			indexArr = [], jmifdtl_ds = [], jmifdtl_ds3 = [];   
	   
	    $("input[required], textarea[required], select[required]").bind({
	    	blur: function(e){
	    		if ($.trim(this.value) != ""){
	    			$(this).removeClass("thisIsRequired");
	    			$(this).parent().removeClass("thisIsRequired");
	    			$(this).parent().parent().removeClass("thisIsRequired");
	    		}
	    	}
	    });	    
	    $.each($("#window input[required], #window textarea[required], #window select[required]"), function(index,value){
	    	$(this).parent().find("label[for=" + this.id + "]").append("<span style='color: red;'>*</span>");
	    });
	    var mat_util_DDE = function(container, options) {
	        $('<input required data-text-field="util_dtl" data-value-field="util_code" id="mat_util" data-bind="value:' + options.field + '"/>')
	            .appendTo(container)
	            .kendoComboBox({
                    placeHolder: "Select Mat. Utilization...",
                    filter: "contains",
                    suggest: true,	            	
                    autoBind: false,
	                dataSource: {
	                    transport: {
	                        read: crudService + "directCall/matUtil_dd",
                    		contentType: "application/json"
	                    },
	                    schema: {
							data: function(data){
			                    return data.rows || [];
							}	                    	
	                    }
	                },
		            change: function(e){
		            	console.log(this);
						if (this.selectedIndex < 0)
		            		$(".k-input").eq(4).val("").select().focus();
		            }
	            });
        };
        
        var grid_col = [
               {field: "item_code",title: "Item Code", width: 117},
               {field: "commodity_code",title: "Comm. Code", width: 89},
               {field: "category",title: "Category", width: 89},
               {field: "size",title: "Size", width: 79},
               {field: "itemno",title: "PT No.",width: 85},
               {field: "req_qty",title: "Quantity", width: 110},
               {field: "drawing_no",title: "Drawing No.", width: 89},
               {field: "spool_no",title: "Spool No.", width: 89},
               {field: "spool_type",title: "Spool Type", width: 89},
               {field: "sheet_no",title: "Sheet No.", width: 89},
               {field: "rev_no",title: "Rev No.", width: 89}
           ],
        	grid2_col = [
	           {field: "item_code",title: "Item Code", width: 132},
	           {field: "commodity_code",title: "Commodity Code", width: 132},
	           {field: "mat_desc",title: "Mat. Desc.", width: 327, attributes: { "class": "editable" }},
	           {field: "uom",title: "UOM", width: 55},
	           {field: "size",title: "Size", width: 51},
	           {field: "req_qty",title: "Request Qty.", width: 105, attributes: { "class": "editable" }},
	           {field: "mat_util",title: "Material Utilization", width: 189, editor: mat_util_DDE, attributes: { "class": "editable" }},
	           {field: "measurement",title: "Measurement", width: 112, attributes: { "class": "editable" }},
	           {field: "plant_no",title: "Plant No.", width: 81},
	           {field: "area_no",title: "Area No.", width: 81},
	           {field: "drawing_no",title: "Drawing No.", width: 123},
	           {field: "sheet_no",title: "Sheet No.", width: 85},
	           {field: "rev_no",title: "Rev. No.", width: 81},
	           {field: "spool_no",title: "Spool No.", width: 85},
	           {field: "testpack_no",title: "Testpack No.", width: 105},
	           {field: "system_no",title: "System", width: 72, attributes: { "class": "editable" }},
	           {field: "sub_system",title: "Sub System", width: 100, attributes: { "class": "editable" }},
	           {field: "activity_code",title: "Activity Code", width: 107, attributes: { "class": "editable" }},
	           {field: "direct_with",title: "DW", width: 50, attributes: { "class": "editable" }}
	       ];
           
		switch(disc_code.toLowerCase()){
			case "psf":
				grid_col = [
	                {field: "stock_no",title: "Stock No.", width: 89},
	                {field: "commodity_code",title: "PS Code", width: 89},
	                {field: "qty",title: "FAB Qty.",width: 85},
	                {field: "uom",title: "UOM", width: 117},
	                {field: "drawing_no",title: "Drawing No.", width: 89},
	                {field: "sheet_no",title: "Sheet No.", width: 89},
	                {field: "rev_no",title: "Rev No.", width: 89},
	                {field: "spool_no",title: "Spool No.", width: 79}
	            ];
				grid2_col.splice(14,3);
				grid2_col.splice(8,1);
				grid2_col.splice(0,1);
				grid2_col.push({field: "rfi_no",title: "RFI No.", width: 89},{field: "qcmrir_no",title: "QCMRIR No.", width: 89});
				insertArrayAt(grid2_col,0,{field: "stock_no",title: "Stock No.", width: 89});
				break;
			case "spl":
				grid_col[5].field = "qty";
				grid_col.splice(4,1);
				grid_col.splice(2,1);
				grid_col.splice(0,1);	
				grid2_col.splice(8,2);
				grid2_col.push({field: "spool_type",title: "Spool Type", width: 89});			
				break;
			case "ele":
				grid_col = [
	                {field: "stock_no",title: "Stock No.", width: 89},
	                {field: "uom",title: "UOM", width: 117},
	                {field: "qty",title: "FAB Qty.",width: 85},
	                {field: "drawing_no",title: "Drawing No.", width: 89},
	                {field: "sheet_no",title: "Sheet No.", width: 89},
	                {field: "rev_no",title: "Rev No.", width: 89},
	                {field: "spool_type",title: "PS Class", width: 79},
	                {field: "designation",title: "Category", width: 79}
	            ];
				grid2_col.splice(13,4);
				grid2_col.splice(8,1);
				grid2_col.push({field: "spool_type",title: "Inst. Type", width: 89},{field: "rfi_no",title: "RFI No.", width: 89},{field: "qcmrir_no",title: "QCMRIR No.", width: 89});
				insertArrayAt(grid2_col,0,{field: "stock_no",title: "Tag No.", width: 89});
				break;
			case "inst":
				grid_col = [
	                {field: "stock_no",title: "Stock No.", width: 89},
	                {field: "uom",title: "UOM", width: 117},
	                {field: "qty",title: "FAB Qty.",width: 85},
	                {field: "area_no",title: "Area No.", width: 110},
	                {field: "drawing_no",title: "Drawing No.", width: 89},
	                {field: "sheet_no",title: "Sheet No.", width: 89},
	                {field: "rev_no",title: "Rev No.", width: 89},
	                {field: "spool_type",title: "PS Class", width: 79},
	                {field: "designation",title: "Category", width: 79}
	            ];
				grid2_col.splice(13,4);
				grid2_col.splice(8,1);
				grid2_col.push({field: "spool_type",title: "Inst. Type", width: 89},{field: "rfi_no",title: "RFI No.", width: 89},{field: "qcmrir_no",title: "QCMRIR No.", width: 89});
				insertArrayAt(grid2_col,0,{field: "stock_no",title: "Tag No.", width: 89});
				break;
			case "ps":
				grid_col = [
	                {field: "commodity_code",title: "Comm. Code", width: 89},
	                {field: "size",title: "Size", width: 79},
	                {field: "mat_prof",title: "Matl Profile", width: 79},
	                {field: "spool_type",title: "PS Class", width: 79},
	                {field: "designation",title: "Category", width: 79},
	                {field: "mat_tag",title: "Item", width: 79},
	                {field: "qty",title: "FAB Qty.",width: 85},
	                {field: "uom",title: "UOM", width: 117},
	                {field: "plant_no",title: "Plant No.", width: 89},
	                {field: "area_no",title: "Area No.", width: 110},
	                {field: "drawing_no",title: "Drawing No.", width: 89},
	                {field: "sheet_no",title: "Sheet No.", width: 89},
	                {field: "rev_no",title: "Rev No.", width: 89},
	                {field: "spool_no",title: "Spool No.", width: 89},
	                {field: "support_no",title: "Support No.", width: 89},
	                {field: "ps_type",title: "PS Type", width: 89}
	            ];
				grid2_col.splice(13,4);
				grid2_col.splice(8,1);
				grid2_col.splice(0,1);
				grid2_col.push({field: "rfi_no",title: "RFI No.", width: 89},{field: "qcmrir_no",title: "QCMRIR No.", width: 89});
				break;
			case "mech":
				grid_col[2].field = "uom";
				grid_col[2].title = "UOM";
				grid_col[5].field = "qty";
				grid_col.splice(7,2);
				grid_col.splice(4,1);
				grid_col.splice(0,1);
				insertArrayAt(grid_col,3,{field: "designation", title: "Eqpt. Type", width: 89});
				grid2_col.splice(13,4);
				grid2_col.splice(8,1);
				grid2_col.splice(0,1);
				grid2_col.push({field: "rfi_no",title: "RFI No.", width: 89},{field: "qcmrir_no",title: "QCMRIR No.", width: 89});
				break;
			case "strl":				grid_col = [
	                {field: "spool_no",title: "Spool No.", width: 89},
	                {field: "commodity_code",title: "Comm. Code", width: 89},
	                {field: "size",title: "Size", width: 79},
	                {field: "uom",title: "UOM", width: 117},
	                {field: "measurement",title: "Measurement", width: 89},
	                {field: "qty",title: "Quantity",width: 85},
	                {field: "req_qty",title: "Requested Qty.", width: 110},
	                {field: "location",title: "Location", width: 110},
	                {field: "elevation",title: "Elevation", width: 110},
	                {field: "area_no",title: "Area No.", width: 110},
	                {field: "area_loc",title: "Area Loc.", width: 110},
	                {field: "drawing_no",title: "Drawing No.", width: 89},
	                {field: "sheet_no",title: "Sheet No.", width: 89},
	                {field: "rev_no",title: "Rev No.", width: 89},
	                {field: "drawing_no2",title: "ERE DWG No.", width: 89},
	                {field: "sheet_no2",title: "Sheet No.", width: 89},
	                {field: "rev_no2",title: "Rev No.", width: 89},
	                {field: "drawing_no3",title: "DES DWG No.", width: 89},
	                {field: "sheet_no3",title: "Sheet No.", width: 89},
	                {field: "rev_no3",title: "Rev No.", width: 89}
	            ];
				grid2_col.splice(13,4);
				grid2_col.splice(8,1);
				grid2_col.splice(0,1);
				grid2_col.push({field: "rfi_no",title: "RFI No.", width: 89},{field: "qcmrir_no",title: "QCMRIR No.", width: 89});
				break;
			default:
				break;
		}
        
        var treqDtl_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/tjmif",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/tjmif",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                update: {
                    url: crudService + "manage/tjmif",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                destroy: {
                    url: crudService + "remove/tjmif",
                    type: "POST"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_treqDtl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_treqDtl[index] = this.operator;
				      		filterVArr_treqDtl[index] = valForm;
				      	});
				    }				     
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_treqDtl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "jmif_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_treqDtl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_treqDtl : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    disc_code: disc_code,
					    processMatTO: (processMatTO) ? 1 : 0,
					    module: 'jmif',
					    log_user: $("#hidden_user").val(),
					    drawing_no: $("#win2_txt1").val(),
					    sheet_no: $("#win2_txt2").val()
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
               	    if (filterFArr_treqDtl.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue = "";
					    filterFArr_treqDtl = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        stock_no: { type: "string", editable: false },
                        item_code: { type: "string", editable: false },
                        commodity_code: { type: "string", editable: false },
                        category: { type: "string" },
                        mat_util: { type: "string", nullable: false, validation: {required: true} },
                        uom: { type: "string", editable: false },
                        size: { type: "string", editable: false },
                        itemno: { type: "string" },
	                    measurement: { type: "number" },
	                    qty: { type: "number", editable: false },
                        req_qty: { type: "number", nullable: false, validation: {required: true} },
                        plant_no: { type: "string", editable: false },
                        area_no: { type: "string", editable: false },
                        drawing_no: { type: "string", editable: false },
                        sheet_no: { type: "string", editable: false },
                        rev_no: { type: "string", editable: false },
                        spool_no: { type: "string", editable: false },
                        testpack_no: { type: "string", editable: false },
                        spool_type: { type: "string" },
                        direct_with: { type: "boolean" }
                    }
                },
                total: function(response) {
				   	return (($(response.rows[0]).length > 0) ? response.rows[0].total : 0);
			    }
            },
            change: function(e) {
            	if ($(e.items).length == 0)
            		return true;
            	if (processMatTO)
            		processMatTO = false;
            }
        });

	    var addExtraStylingToGrid = function () {
			$("#tempNS_rs").data("kendoGrid").select("tr:eq(1)");
	        $("#tempNS_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }
	        );
        	filterFArr_treqDtl = [];
	    };

        var grid = $("#tempNS_rs").kendoGrid({
            dataSource: treqDtl_ds,
            selectable: "multiple",
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
            columns: grid_col,
            // columns: [
               // {field: "item_code",title: "Item Code", width: 117},
               // {field: "commodity_code",title: "Comm. Code", width: 89},
               // {field: "category",title: "Category", width: 89},
               // {field: "size",title: "Size", width: 79},
               // {field: "itemno",title: "PT No.",width: 85},
               // {field: "req_qty",title: "Quantity", width: 110},
               // {field: "drawing_no",title: "Drawing No.", width: 89},
               // {field: "spool_no",title: "Spool No.", width: 89},
               // {field: "spool_type",title: "Spool Type", width: 89},
               // {field: "sheet_no",title: "Sheet No.", width: 89},
               // {field: "rev_no",title: "Rev No.", width: 89}
           // ],
           change: function(e){
           		currRow = this;
			    selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        jmif_di = this.dataItem(selectedRows[i]);
			    }
			    $(".tempNS_phase .wrap-form input, .tempNS_phase .wrap-form textarea, .tempS_phase .wrap-form input, .tempS_phase .wrap-form textarea").val("");
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle('#tempNS_rs','Material Take-Off');
        
        var jmifdtl_ds2 = function(ds){
        	jmifdtl_ds = ds;
        	return new kendo.data.DataSource({
	            data: ds,
	            // batch: true,
	            pageSize: 11,
	            schema: {
	                data: function(data) {
	                    return data || [];
	                },
	                errors: function(data){
	               	    if (filterFArr_treqDtl.length > 0 && $(data.rows).length == 0){
	               		    notif("info","Information","No records found!");
						    sentValue = "";
						    filterFArr_treqDtl = [];
						    $("form.k-filter-menu button[type='reset']").trigger("click");
	               	    }
	                },
	                model: {
	               		id: "PROGRESS_RECID",
	                    fields: {
	                   	    PROGRESS_RECID: { type: "number", editable: false },
	                        item_code: { type: "string", editable: false },
	                        commodity_code: { type: "string", editable: false },
	                        mat_desc: { type: "string" },
	                        uom: { type: "string", editable: false },
	                        size: { type: "string", editable: false },
	                        qty: { type: "number", editable: false },
	                        req_qty: { type: "number", nullable: false, validation: {required: true} },
	                        mat_util: { type: "string", nullable: false, validation: {required: true} },
	                        measurement: { type: "number" },
	                        plant_no: { type: "string", editable: false },
	                        area_no: { type: "string", editable: false },
	                        drawing_no: { type: "string", editable: false, nullable: false, validation: {required: true} },
	                        sheet_no: { type: "string", editable: false },
	                        rev_no: { type: "string", editable: false },
	                        spool_no: { type: "string", editable: false },
	                        testpack_no: { type: "string", editable: false },
	                        system_no: { type: "string" },
	                        sub_system: { type: "string" },
	                        activity_code: { type: "string" },
	                        direct_with: { type: "boolean" },
	                        location: { type: "string" },
	                        area_loc: { type: "string" },
	                        drawing_no2: { type: "string" },
	                        sheet_no2: { type: "string" },
	                        rev_no2: { type: "string" },
	                        drawing_no3: { type: "string" },
	                        sheet_no3: { type: "string" },
	                        rev_no3: { type: "string" },
	                        rfi_no: { type: "string" },
	                        qcmrir_no: { type: "string" },
	                        mat_prof: { type: "string" },
	                        spool_type: { type: "string" },
	                        designation: { type: "string" },
	                        mat_tag: { type: "string" },
	                        stock_no: { type: "string" },
	                        support_no: { type: "string" },
	                        ps_type: { type: "string" }
	                    }
	                },
	                total: function(response) {
					   	return parseInt(($(response).length > 0) ? $(response).length : 0);
				    }
	            }
	        });
	    };
                                
	    var addExtraStylingToGrid2 = function () {
			$("#tempS_rs").data("kendoGrid").select("tr:eq(" + (treqDtl_ds._data.length + 2) + ")");
	        $("#tempS_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_jmifdtl = [];
	    };
        
        var grid2 = $("#tempS_rs").kendoGrid({
            dataSource: jmifdtl_ds2,
            selectable: "multiple",
            pageable: {
                buttonCount: 3,
    			input: true
            },
            autoBind: false,
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: true,
			toolbar: ["save","cancel"],
            resizable: true,
            filterable: false,
            columns: grid2_col,
            // columns: [
               // {field: "item_code",title: "Item Code", width: 132},
               // {field: "commodity_code",title: "Commodity Code", width: 132},
               // {field: "mat_desc",title: "Mat. Desc.", width: 327, attributes: { "class": "editable" }},
               // {field: "uom",title: "UOM", width: 55},
               // {field: "size",title: "Size", width: 51},
               // {field: "req_qty",title: "Request Qty.", width: 105, attributes: { "class": "editable" }},
               // {field: "mat_util",title: "Material Utilization", width: 189, editor: mat_util_DDE, attributes: { "class": "editable" }},
               // {field: "measurement",title: "Measurement", width: 112, attributes: { "class": "editable" }},
               // {field: "plant_no",title: "Plant No.", width: 81},
               // {field: "area_no",title: "Area No.", width: 81},
               // {field: "drawing_no",title: "Drawing No.", width: 123},
               // {field: "sheet_no",title: "Sheet No.", width: 85},
               // {field: "rev_no",title: "Rev. No.", width: 81},
               // {field: "spool_no",title: "Spool No.", width: 85},
               // {field: "testpack_no",title: "Testpack No.", width: 105},
               // {field: "system_no",title: "System", width: 72, attributes: { "class": "editable" }},
               // {field: "sub_system",title: "Sub System", width: 100, attributes: { "class": "editable" }},
               // {field: "activity_code",title: "Activity Code", width: 107, attributes: { "class": "editable" }},
               // {field: "direct_with",title: "DW", width: 50, attributes: { "class": "editable" }}
           // ],
           change: function(e){
           		currRow2 = this;
			    selectedRows2 = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows2.length; i++) {
			        jmifdtl_di = this.dataItem(selectedRows2[i]);
			    }
           },
           dataBound: addExtraStylingToGrid2
        });
		$("#tempS_rs .k-grid-toolbar").hide();
        insertGridTitle('#tempS_rs','Material Request');
        
        var processOnClose = function(){
        	if ($("#win2_txt1").val() != "")
        		treqDtl_ds.read();
        	else
        		$("#window").data("kendoWindow").close();
        };
				
		$("#subWindow").data("kendoWindow").setOptions({
		    title: "Input Drawing No.",
		    width: "278px",
		    height: "auto",
		    close: processOnClose
		});
		$("#subWindow").data("kendoWindow").refresh({
       		url: "/codeIgniter/index.php/webapps/templateLoader/index/qms/drawSheet",
			type: "POST",
			data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
		});
		$("#subWindow").data("kendoWindow").center().open();
		
		$(".tempNS_phase .wrap-button button").bind({
        	click: function(e){
        		switch(this.id){
        			case "downButt":
						for (var i = 0; i < selectedRows.length; i++) {
				        	down_di = currRow.dataItem(selectedRows[i]);
							
							down_di['direct_with'] = false;
							down_di['measurement'] = (down_di['measurement'] == null ? 0 : down_di['measurement']);
							down_di['mat_util'] = (down_di['mat_util'] == null ? '' : down_di['mat_util']);
							jmifdtl_ds.push(down_di);
							indexArr.push(down_di);
					        $.post(crudService + "remove/tjmif",{PROGRESS_RECID: down_di.PROGRESS_RECID},
					       	    function(data){
					       	    	if (data != "1"){
               		    				notif("info","Information",data);
               		    				return true;
               		    			}
               		    				
					       	    	if (selectedRows.length == i)
										treqDtl_ds.read();
					       	    });
						}
						$("#tempS_rs").data("kendoGrid").setDataSource(jmifdtl_ds2(jmifdtl_ds));
						$("#tempS_rs").data("kendoGrid").dataSource.page($("#tempS_rs").data("kendoGrid").dataSource.page());
						$("#tempS_rs").data("kendoGrid").dataSource.read();
						
						$(".tempS_phase .wrap-form button, .wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
        			break;
        			default:
						var ds_total = selectedRows2.length;
    					var removeThis;
						for (var i = 0; i < selectedRows2.length; i++) {
				        	up_di = currRow2.dataItem(selectedRows2[i]);
							var row = [];
							$.each(up_di,function(index2,value2){
								if (typeof value2 == "object")
									return;
	
								row[index2] = value2;
							});
							row['PROGRESS_RECID'] = 0;
							row['direct_with'] = (row['direct_with'] ? 1 : 0); 
							postInfo = JSON.stringify(row);
							postInfo = eval("(" + postInfo + ")");

							treqDtl_ds.add(postInfo);
	    					$.each(jmifdtl_ds, function(index3, value3){
	    						if (value3.uid == up_di.uid){
	    							removeThis = index3;
	    							return;
	    						}
	    					});
	    					jmifdtl_ds.splice(removeThis,1);
						}
						treqDtl_ds.sync();
						$("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
						$("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
						$("#tempNS_rs").data("kendoGrid").dataSource.read();

						$("#tempS_rs").data("kendoGrid").setDataSource(jmifdtl_ds2(jmifdtl_ds));
						$("#tempS_rs").data("kendoGrid").dataSource.page($("#tempS_rs").data("kendoGrid").dataSource.page());
						$("#tempS_rs").data("kendoGrid").dataSource.read();
        			break;
        		}
        	}
        });
        
	    $(".tempS_phase .wrap-button button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "doneButt":
	    				isFailed = false;
	    				$.each(jmifdtl_ds, function(index,value){
	    					if ($.trim(value.mat_util) == ""){
				    			showNotif("Information","Material Utilization must not be blank.","info");
	    						isFailed = true;
	    						return true;
	    					}
	    					if (value.req_qty <= 0){
				    			showNotif("Information","Request Qty must be greater than zero(0)","info");
	    						isFailed = true;
	    						return true;
	    					}
	    					if (disc_code.toLowerCase() != 'ele'){
		    					if ($.trim(value.drawing_no) == ""){
					    			showNotif("Information","Drawing No. must not be blank.","info");
		    						isFailed = true;
		    						return true;
		    					}
		    				}
	    					if ($.trim(value.commodity_code) == ""){
	    						value.item_code = value.stock_no;
	    						value.commodity_code = value.stock_no;
	    					}
	    				});
	    				if (isFailed)
	    					return true;
	    					
			    		$.post(crudService + "manage/setTREQ",{jsonData: JSON.stringify({item: jmifdtl_ds}), jmif_no: $("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).text(), disc_code: disc_code, log_user: $("#hidden_user").val(), module: "jmif", req_qty_old: 0},
				    		function(data){
				    			if ($.trim(data) != "1")
				    				showNotif("Information",data,"info");
				    			else
				    				$("#window").data("kendoWindow").close();
				    		});
	    			break;
	    			default:	    			
						isFailed = verifyThisInput(".tempS_phase");
			    		if (isFailed)
			    			return true;
			    			
			    		var conf = confirm("Apply common fields to other items?\n (Activity Code, Mat. Utilization, System & Sub-System)");
			    		jmifdtl_ds3 = [];
						$.each(jmifdtl_ds, function(index3, value3){
							if (conf){
					        	value3.activity_code = jmifdtl_di.activity_code;
					        	value3.mat_util = jmifdtl_di.mat_util;			
					        	value3.system_no = jmifdtl_di.system_no;
					        	value3.sub_system = jmifdtl_di.sub_system;
							}							jmifdtl_ds3.push(value3);
						});
						$("#tempS_rs").data("kendoGrid").setDataSource(jmifdtl_ds2(jmifdtl_ds3));
						$("#tempS_rs").data("kendoGrid").dataSource.page($("#tempS_rs").data("kendoGrid").dataSource.page());
						$("#tempS_rs").data("kendoGrid").dataSource.read();
						showNotif("Information","Record successfully updated.","info");
	    			break;
	    		}
	    	}
	    });
	});
</script>