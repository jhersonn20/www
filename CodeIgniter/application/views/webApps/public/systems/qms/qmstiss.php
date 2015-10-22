<style>
	#header-container {width: 900px;font: 14px Arial,Helvetica,sans-serif;}
	#header-container label {font: 12px Arial,Helvetica,sans-serif;font-style: italic;font-weight: bold;}
	#header-container h2 {font:35px Arial,Helvetica,sans-serif;}
	#header, #stock, #iso {list-style-type: none;margin: 0 auto;padding: 0;width: 680px;}
	#stock {margin-top: 10px;}
	#stock h2 {float: left;margin-right: 5px;}
	#iso {margin: 10px 0 0 0;width: 100%;}
	#header li, #stock li, #stock_ext li, #header li ul li, #stock li ul li, #others li, #iso li {
		display: inline-block;
		margin: 0 !important;
		padding: 0 !important;
		line-height: 10px;
	}
	#header li {width: 350px;}
	#stock li {width: 95%;}
	#stock_ext li {width: 290px;}
	#header li:first-child {width: 320px;}
	#stock li:last-child {line-height: 17px;}
	#header li ul li {width: 400px !important;}
	#stock li ul li {width: 505px !important;}
	#iso li {width: 146px !important;text-align: center;}
	#iso li label {line-height: 18px;}
/*	#rowSelection, #jmifdtl_rs {height: 220px;}*/
	.k-grid-content {height: 124px;}
</style>
<script type="text/x-kendo-template" id="template">
    <div id="header-container">
    	<ul id="header">
    		<li>
        		<h2>#= (jmif_no == null) ? "" : jmif_no #</h2>    			
    		</li>
    		<li>
    			<ul>
					<li><em><label class="title" style="width: 67px;line-height: 18px;">JMIF Date:</label></em>#= (jmif_date == null) ? "" : kendo.toString(jmif_date, "MM/dd/yyyy") #
						<em><label class="title short" style="width: 100px;text-align: right;margin-left: 20px;line-height: 18px;">Requested By:</label></em> #= (req_by == null) ? "" : req_by #</li>
		            <li><em><label class="title" style="width: 67px;line-height: 18px;">FOG Date:</label></em>#= (sub_date_fog == null) ? "" : kendo.toString(sub_date_fog, "MM/dd/yyyy") #
		            	<em><label class="title short" style="width: 100px;text-align: right;margin-left: 20px;line-height: 18px;">Requested Date:</label></em> #= (date_reqd == null) ? "" : kendo.toString(date_reqd, "MM/dd/yyyy") #</li>
		        </ul>
	        </li>
        </ul>
        <hr style="width: 98%;" />
        <ul id="iso">
        	<li><em><label>Plant No.</label></em></li>
        	<li><em><label>Area No.</label></em></li>
        	<li><em><label>Drawing No.</label></em></li>
        	<li><em><label>Sheet No.</label></em></li>
        	<li><em><label>Revision No.</label></em></li>
        	<li><em><label>Spool No.</label></em></li>
        	<li>#= (plant_no == null) ? "" : plant_no #</li>
        	<li>#= (area_no == null) ? "" : area_no #</li>
        	<li>#= (drawing_no == null) ? "" : drawing_no #</li>
        	<li>#= (sheet_no == null) ? "" : sheet_no #</li>
        	<li>#= (rev_no == null) ? "" : rev_no #</li>
        	<li>#= (spool_no == null) ? "" : spool_no #</li>
        </ul>
        <hr style="width: 98%;" />
        <div style="float: right;width: 235px;margin: 10px 15px 0 0;">
        	<fieldset>
        		<legend>Other Information:</legend>
	        	<ul id="others">        		        		
		        	<li><em><label class="title" style="width: 110px;line-height: 18px;">Testpack No.:</label></em>#= (testpack_no == null) ? "" : testpack_no #</li>        		        		
		        	<li><em><label class="title" style="width: 110px;line-height: 18px;">System:</label></em>#= (system_no == null) ? "" : system_no #</li>        		        		
		        	<li><em><label class="title" style="width: 110px;line-height: 18px;">Sub System:</label></em>#= (sub_system == null) ? "" : sub_system #</li>        		        		
		        	<li><em><label class="title" style="width: 110px;line-height: 18px;">Activity Code:</label></em>#= (activity_code == null) ? "" : activity_code #</li>        		        		
		        	<li><em><label class="title" style="width: 110px;line-height: 18px;">Direct Withdrawal:</label></em>#= (direct_with == null) ? "" : direct_with #</li>        		        		
		        	<li><em><label class="title" style="width: 110px;line-height: 18px;">Spool Type:</label></em>#= (spl_type == null) ? "" : spl_type #</li>        		        		
	        	</ul>
	        </fieldset>
        </div>
        <div style="width: 650px;margin: 10px 0 0 0;">
	    	<ul id="stock">
	    		<li>
	        		<h2>#= (item_code == null) ? "" : item_code #</h2>
	        		<textbox name="tbox1" id="tbox1" style="font-style: italic;font-size: 12px;vertical-align: middle;" readonly>#= (mat_desc == null) ? "" : mat_desc #</textbox>    			
	    		</li>
	        </ul>
        	<hr style="width: 99%;" />
	        <ul id="stock_ext">
	        	<li><em><label class="title" style="width: 120px;line-height: 18px;">Stock No.:</label></em>#= (stock_no == null) ? "" : stock_no #</li>
				<li><em><label class="title" style="width: 100px;text-align: right;margin-left: 20px;line-height: 18px;">Unit of Measure:</label></em> #= (uom == null) ? "" : uom #</li>
				<li><em><label class="title" style="width: 120px;line-height: 18px;">Commodity Code:</label></em>#= (commodity_code == null) ? "" : commodity_code #</li>
				<li><em><label class="title" style="width: 100px;text-align: right;margin-left: 20px;line-height: 18px;">Size:</label></em> #= (size == null) ? "" : size #</li>
				<li><em><label class="title" style="width: 120px;line-height: 18px;">Support No.:</label></em>#= (support_no == null) ? "" : support_no #</li>
				<li><em><label class="title" style="width: 100px;text-align: right;margin-left: 20px;line-height: 18px;">Measurement:</label></em> #= (measurement == null) ? "" : measurement #</li>
				<li><em><label class="title" style="width: 120px;line-height: 18px;">Required Qty.:</label></em>#= (req_qty == null) ? "" : req_qty #</li>
				<li><em><label class="title" style="width: 100px;text-align: right;margin-left: 20px;line-height: 18px;">Issued Qty.:</label></em> #= (iss_qty == null) ? "" : iss_qty #</li>
				<li><em><label class="title" style="width: 120px;line-height: 18px;">Material Utilization:</label></em>#= (mat_util == null) ? "" : mat_util #</li>
				<li><em><label class="title" style="width: 100px;text-align: right;margin-left: 20px;line-height: 18px;">Material Status:</label></em> #= (mat_status == null) ? "" : mat_status #</li>
	        </ul>
	    </div>
    </div>
</script>
<script id="tooltip" type="text/x-kendo-template">
    <div class="k-widget k-tooltip k-tooltip-validation k-invalid-msg" data-for="#= Key #" role="alert">
        <span class="k-icon k-warning"> </span>
        #= Message #
        <div class="k-callout k-callout-n"></div>
    </div>
</script>

<div id="main-wrapper">
	<div class="jmif_phase">
		<div id="jmifHead" style="margin-bottom: 5px;">
		    <div class="wrap-grid demo-section" style="width: 98.8%;margin-left: 0;height: auto;">
		        <div id="rowSelection"></div>
		    </div>
		</div>
		<div class="wrap-button demo-section apply8">
			<div class="buttonLeft">
	        	<button class="k-button" id="saveButt">Save</button>
	        	<button class="k-button" id="canButt">Cancel</button>
	        	<button class="k-button mainEve" id="addButt">Add</button>
	        	<button class="k-button mainEve" id="editButt">Edit</button>
	        	<button class="k-button mainEve" id="delButt">Delete</button>
	        	<button class="k-button mainEve" id="finButt">Finalized</button>
	       	</div>
			<div class="buttonRight">
	        	<button class="k-button mainEve" id="uplButt">Upload Bulk Item Details</button>
	       	</div>
		</div>
	</div>
	<div class="jmifdtl_phase" style="margin-top: 5px;">
		<div id="jmifDtlHead" style="margin-bottom: 5px;">
		    <div class="wrap-grid demo-section" style="width: 98.8%;margin-left: 0;height: auto;">
		        <div id="jmifdtl_rs"></div>
				<fieldset style="margin-top: 5px;">
					<ul style="float: right;">
						<li>
							<label class="title" for="txt25" style="width: auto;">Log User:</label><input type="text" name="txt25" id="txt25" class="k-textbox k-state-disabled" disabled style="width: 150px;" />
							<label class="title" for="txt26" style="width: auto;">Log Date:</label><input type="text" name="txt26" id="txt26" class="k-textbox k-state-disabled" disabled style="width: 85px;" />
							<label class="title" for="txt27" style="width: auto;">Log Update:</label><input type="text" name="txt27" id="txt27" class="k-textbox k-state-disabled" disabled style="width: 215px;" />
						</li>
					</ul>
				</fieldset>
		    </div>
		</div>
		<div class="wrap-button demo-section apply8">
			<div class="buttonLeft">
	        	<button class="k-button" id="saveButt2">Save</button>
	        	<button class="k-button" id="canButt2">Cancel</button>
<!-- 	        	<button class="k-button mainEve k-state-disabled" disabled id="addButt2">Add</button> -->
	        	<button class="k-button mainEve k-state-disabled" disabled id="editButt2">Edit</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="delButt2">Delete</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="issButt">Issuance / Confirm All</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="enggButt">ENGG</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="viewButt">View Details</button>
	       	</div>
			<div class="buttonRight">
	        	<button class="k-button mainEve" id="closeButt">Close</button>
	       	</div>				
		</div>
	</div>
</div>
<script type="text/javascript">
	var processMatTO = false,
		disc_code = pathname.split('/')[pathname.split('/').length - 1],
		jmifdtl_ds
		tooltip = new kendo.template($("#tooltip").html());;
	function grid_change(e,grid){
		if (typeof e == "undefined")
			e = grid;
		var selectedRows = e.select();
		var selectedDataItems = [];
	    $("#delButt2, #editButt2, #addButt2, #issButt, #enggButt").prop("disabled", true).addClass("k-state-disabled");
		for (var i = 0; i < selectedRows.length; i++) {
			dataItem3 = e.dataItem(selectedRows[i]);
    		// $("#delButt").prop("disabled", true).addClass("k-state-disabled");		        
    		$("#viewButt").prop("disabled", true).addClass("k-state-disabled");
			if ((dataItem3.finalized == 0 || dataItem3.finalized == null)){	        	
				// $("#delButt, #enggButt").prop("disabled", false).removeClass("k-state-disabled");
				$("#delButt, #enggButt, #addButt2").prop("disabled", false).removeClass("k-state-disabled");
				$("#finButt").text("Finalize");
			}else {
				// $("#delButt2, #enggButt").prop("disabled", true).addClass("k-state-disabled");
				$("#delButt, #enggButt, #addButt2").prop("disabled", true).addClass("k-state-disabled");
				$("#finButt").text("Unfinalize");
			}
			if (dataItem3.whse_prep != 1)
    			$("#delButt, #delButt2, #finButt, #enggButt, #addButt2").prop("disabled", true).addClass("k-state-disabled");
			
			$("#txt25").val(dataItem3.log_user);
			$("#txt26").val(kendo.toString(dataItem3.log_date,"MM-dd-yyyy"));
			$("#txt27").val(dataItem3.log_update);
	    }
	}
    function showDetails(div, title, dataItem) {
    	var wnd, detailsTemplate;
        detailsTemplate = kendo.template($("#" + div).html());
        
		wnd = $("#window").data("kendoWindow");
        wnd.setOptions({
        	title: title,
        	width: 900
        });
        wnd.content(detailsTemplate(dataItem));
        wnd.center().open();
    }
	function forDiv(div){
		var container = $("#" + div);
		var position = container.offset();	
		var offsetHeight = container.height();
		var offsetWidth = container.width();
		var newDiv = $("<div id='coverDiv' style='z-index: 10000;position: absolute;'>").appendTo($("body"));
			newDiv.offset(position);
			newDiv.height(offsetHeight + 87);
			newDiv.width(offsetWidth);
	}
	$(document).ready(function(){
		$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
		var crudService = crudServiceBaseUrl + "qms/index/",
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", currRow2 = "", cMode = "", dataItem = '', jmifdtl_di = '', isFailed = false,
		    filterFArr_jmifdtl = [], filterOArr_jmifdtl = [], filterVArr_jmifdtl = [], sentValue_jmifdtl = "", fieldSort = "", dirSort = "", query = "",
			optionArr = ["","jmif_no","jmif_date","req_by","remarks"],
			cond_skip_field = ['txt10','txt16','txt17','txt18','txt19','txt20','textarea4'],
			skip_this_field = cond_skip_field, item_code, commodity_code, mat_desc, uom, size, hasChange = false, req_qty_old = 0, drawing_no_old, spool_no_old;
						
		set_skip_field(cond_skip_field);
	    
	    var spl_type_DDE = function(container, options) {
	        $('<input required data-text-field="text" data-value-field="value" id="spl_type" data-bind="value:' + options.field + '"/>')
	            .appendTo(container)
	            .kendoComboBox({
	                autoBind: false,
                    dataSource: [
                        { text: "Spool", value: "spool" },
                        { text: "EM", value: "em" },
                        { text: "Others", value: "" }
                    ],
                    filter: "contains",
                    suggest: true,
		            change: function(e){
						if (this.selectedIndex < 0)
		            		$(".k-input").eq(10).val("").select().focus();
		            }
	            });
        }
	    
	    var stock_no_DDE = function(container, options) {
	        $('<input name="' + options.field + '" data-text-field="item_size" data-value-field="stock_no" id="stock_no" data-bind="value:' + options.field + '"/>')
	            .appendTo(container)
	            .kendoComboBox({
	                autoBind: false,
	                dataSource: {
	                    transport: {
	                        read: crudService + "directCall/item?disc_code=" + disc_code,
                    		contentType: "application/json"
	                    },
	                    schema: {
							data: function(data){
			                    return data.rows || [];
							}	                    	
	                    }
	                },
                    filter: "contains",
                    suggest: true,
		            change: function(e){
						if (this.selectedIndex < 0)
		            		$(".k-input").eq(0).val("").select().focus();
		            	else {
			    			var selectedOpts = this.select();
		            		var optItem = this.dataItem(selectedOpts[0]);
		            		stock_no = optItem.stock_no; //this.value().split(",")[5];
		            		item_code = optItem.item_code; //this.value().split(",")[3];
		            		commodity_code = optItem.commodity_code; //this.value().split(",")[4];
		            		mat_desc = optItem.description; //this.value().split(",")[0];
		            		uom = optItem.uom; //this.value().split(",")[2];
		            		size = optItem.size; //this.value().split(",")[1];
							$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(1).html(item_code);
							$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(2).html(commodity_code);
							$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(3).html(mat_desc);
							$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(4).html(uom);
							$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(5).html(size);
							// $("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(4).find("input").focus();
		            	}
		            }
	            });
        }

	    var req_qty_NTE = function (container, options) {
	        $('<input name="' + options.field + '" data-bind="value:' + options.field + '" data-role="numerictextbox" />')
	            .appendTo(container)
	            .kendoNumericTextBox({
	            decimals: 3,
	            min: 0,
	            format: 'n3'
	        });
	    };

	    // var iss_qty_NTE = req_qty_NTE;
	    var iss_qty_NTE = function (container, options) {
	        $('<input data-bind="value:' + options.field + '"/>')
	            .appendTo(container)
	            .kendoNumericTextBox({
	            decimals: 3,
	            min: 0,
	            format: 'n3'
	        });
	    };
	    
	    var mat_util_DDE = function(container, options) {
	        $('<input data-text-field="util_dtl" name="' + options.field + '" data-value-field="util_code" id="mat_util" data-bind="value:' + options.field + '"/>')
	            .appendTo(container)
	            .kendoComboBox({
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
                    filter: "contains",
                    suggest: true,
		            change: function(e){
						if (this.selectedIndex < 0)
		            		$(".k-input").eq(3).val("").select().focus();
		            }
	            });
        }
        
        var merge = function() {
		    var obj = {},
		    	i = 0,
		        il = arguments.length,
		        key;
		    for (; i < il; i++) {
		        for (key in arguments[i]) {
		            if (arguments[i].hasOwnProperty(key)) {
			        	if (key == "_events" || key == "parent")
			        		continue;
			        		
		                obj[key] = arguments[i][key];
		            }
		        }
		    }
		    return obj;
		};
		
		var mdtl_col = [
               {field: "stock_no",title: "Stock No.",width: 132, editor: stock_no_DDE},
               {field: "item_code",title: "Item Code", width: 132},
               {field: "commodity_code",title: "Commodity Code", width: 132},
               {field: "mat_desc",title: "Material Description", width: 331},
               {field: "uom",title: "Unit of Measure", width: 125},
               {field: "size",title: "Size", width: 51},
               {field: "support_no",title: "Support No.", width: 101},
               {field: "activity_code",title: "Activity Code", width: 107},
               {field: "mat_util",title: "Material Utilization", width: 189, editor: mat_util_DDE},
               {field: "measurement",title: "Measurement", width: 112},
               {field: "req_qty",title: "Request Qty.", width: 107, editor: req_qty_NTE},
               {field: "iss_qty",title: "Issued Qty.", width: 99, editor: iss_qty_NTE},
               {field: "drawing_no",title: "Drawing No.", width: 123},
               {field: "sheet_no",title: "Sheet No.", width: 87},
               {field: "rev_no",title: "Rev. No.", width: 76},
               {field: "spool_no",title: "Spool No.", width: 84},
               {field: "testpack_no",title: "Testpack No.", width: 107},
               {field: "system_no",title: "System", width: 72},
               {field: "sub_system",title: "Sub System", width: 100},
               {field: "direct_with",title: "DW", width: 50},
               {field: "dlmr_jwrr",title: "DJ", width: 50},
               {field: "excess",title: "EX", width: 50},
               {field: "spl_type",title: "Spool Type", width: 97, editor: spl_type_DDE},
               {field: "mat_status",title: "Material Req. Status", width: 153}
           ];
		// var mdtl_col = [
               // {field: "stock_no",title: "Stock No.",width: 132, editor: stock_no_DDE},
               // {field: "item_code",title: "Item Code", width: 132},
               // {field: "commodity_code",title: "Commodity Code", width: 132},
               // {field: "mat_desc",title: "Material Description", width: 331},
               // {field: "uom",title: "Unit of Measure", width: 125},
               // {field: "size",title: "Size", width: 51},
               // {field: "activity_code",title: "Activity Code", width: 107},
               // {field: "mat_util",title: "Material Utilization", width: 189, editor: mat_util_DDE},
               // {field: "measurement",title: "Measurement", width: 112},
               // {field: "req_qty",title: "Request Qty.", width: 107, editor: req_qty_NTE},
               // {field: "iss_qty",title: "Issued Qty.", width: 99, editor: iss_qty_NTE},
               // {field: "area_no",title: "Area No.", width: 89},
               // {field: "drawing_no",title: "Drawing No.", width: 123},
               // {field: "sheet_no",title: "Sheet No.", width: 87},
               // {field: "rev_no",title: "Rev. No.", width: 76},
               // {field: "direct_with",title: "DW", width: 50},
               // {field: "dlmr_jwrr",title: "DJ", width: 50},
               // {field: "rfi_no",title: "RFI No.", width: 89},
               // {field: "qcmrir_no",title: "QCMRIR No.", width: 101}
           // ];
		
		switch(disc_code.toLowerCase()){
			case "cvl":
				$("<button class='k-button mainEve k-state-disabled' disabled id='addButt2'>Add</button>").prependTo(".jmifdtl_phase .buttonLeft");
				mdtl_col.splice(21,3);
				mdtl_col.splice(15,4);
				mdtl_col.splice(6,1);
				insertArrayAt(mdtl_col,11,{field: "area_no",title: "Area No.", width: 89});
				mdtl_col.push({field: "rfi_no",title: "RFI No.", width: 89},{field: "qcmrir_no",title: "QCMRIR No.", width: 101});
				// $("#uplButt, .buttonRight, ul > li.liSubDate, ul > li.liDateReq, label[for=chk2], ul > li.liSuppNo, ul > li.liPlant, ul > li.liSheet, ul > li.liSpool, ul > li.liRad").hide();
				// $("#addButt2").show();
				$("#enggButt").remove();
			break;
			case "strl":
				$("<button class='k-button mainEve k-state-disabled' disabled id='addButt2'>Add</button>").prependTo(".jmifdtl_phase .buttonLeft");
				mdtl_col.splice(21,2);
				mdtl_col.splice(13,3);
				mdtl_col.splice(6,1);
				insertArrayAt(mdtl_col,11,{field: "area_no",title: "Area No.", width: 89});
				mdtl_col.push({field: "rfi_no",title: "RFI No.", width: 89},{field: "qcmrir_no",title: "QCMRIR No.", width: 101});
				$("#enggButt").remove();
			break;
			case "mech":
				$("<button class='k-button mainEve k-state-disabled' disabled id='addButt2'>Add</button>").prependTo(".jmifdtl_phase .buttonLeft");
				mdtl_col[2].title = 'Tag No.';
				mdtl_col.splice(20,2);
				mdtl_col.splice(15,4);
				mdtl_col.splice(6,1);
				insertArrayAt(mdtl_col,11,{field: "area_no",title: "Area No.", width: 89});
				mdtl_col.push({field: "rfi_no",title: "RFI No.", width: 89},{field: "qcmrir_no",title: "QCMRIR No.", width: 101});
				$("#enggButt").remove();
			break;
			case "ps":
				$("<button class='k-button mainEve k-state-disabled' disabled id='addButt2'>Add</button>").prependTo(".jmifdtl_phase .buttonLeft");
				mdtl_col[2].title = 'Tag No.';
				mdtl_col.splice(21,2);
				mdtl_col.splice(15,4);
				mdtl_col.splice(6,1);
			break;
			case "inst":
			case "ele":
				$("<button class='k-button mainEve k-state-disabled' disabled id='addButt2'>Add</button>").prependTo(".jmifdtl_phase .buttonLeft");
				mdtl_col.splice(20,2);
				mdtl_col.splice(13,3);
				mdtl_col.splice(6,1);
			break;
			case "spl":
				$("#editButt2").remove();
			break;
			case "psf":
				$("<button class='k-button mainEve k-state-disabled' disabled id='addButt2'>Add</button>").prependTo(".jmifdtl_phase .buttonLeft");
				mdtl_col[2].title = 'Tag No.';
				mdtl_col.splice(20,3);
				mdtl_col.splice(13,3);
				mdtl_col.splice(6,1);
			break;
			default:
				// $("#addButt2").hide();
			break;
		}
		
		$(".wrap-button button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();
		});
			
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/treq",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/treq",
                    type: "POST",
	                complete: function(jqXHR, textStatus){
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else {
							dataSource.page(dataSource.page());
							$("#coverDiv").remove();
						}
						dataSource.read();
	                }
                },
                update: {
                    url: crudService + "manage/treq",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else {
							dataSource.page(dataSource.page());
							$("#coverDiv").remove();
						}
						dataSource.read();
	                }
                },
                destroy: {
                    url: crudService + "remove/treq",
                    type: "POST",
	                complete: function(jqXHR, textStatus){
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else
							dataSource.page(dataSource.page());
						dataSource.read();
	                }
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : (typeof this.value == "boolean" ? (this.value ? 1 : 0) : this.value);
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
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    disc_code : disc_code,
					    whse_prep : 1 
			        }
			      }else {
			      	data['whse_prep'] = 1;
			      	data['log_user'] = $("#hidden_user").val();
			      	data['disc_code'] = disc_code;
			      	data['jmif_date'] = kendo.toString(data.jmif_date,"yyyy-MM-dd");
			      	data['sub_date_fog'] = kendo.toString(data.sub_date_fog,"yyyy-MM-dd");
			      	data['sub_date_client'] = (data.sub_date_fog == null ? '' : kendo.toString(data.sub_date_client,"yyyy-MM-dd"));
			      	data['date_reqd'] = (data.date_reqd == null ? '' : kendo.toString(data.date_reqd,"yyyy-MM-dd"));
			      	data['finalized'] = (data.finalized ? 1 : 0);
			      	data['jmif_no'] = (type == "create" ? $("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).html() : data.jmif_no);
			      	return data;
			      }
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
                        jmif_no: { type: "string", editable: false },
                        jmif_date: { type: "date", nullable: false, validation: {required: true} },
                        req_by: { type: "string" },
                        iss_by: { type: "string", editable: false },
                        remarks: { type: "string" },
                        sub_date_fog: { type: "date" },
                        sub_date_client: { type: "date" },
                        finalized: { type: "boolean", editable: false },
                        jmif_status: { type: "string", editable: false },
                        whse_prep: { type: "boolean", editable: false},
                        log_user: { type: "string"},
                        log_date: { type: "date"},
                        log_update: { type: "string"},
                        date_reqd: { type: "date" }
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
                buttonCount: 3,
    			input: true
            },
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: 'inline',
			toolbar: ["save","cancel"],
            resizable: true,
            filterable: {
                extra: false
            },
            // height: 220,
            columns: [
               {field: "jmif_no",title: "JMIF No.",width: 121},
               {field: "jmif_date",title: "JMIF Date", width: 122, format: "{0:MM/dd/yyyy}", attributes: {style: "text-align: right;"}},
               {field: "req_by",title: "Requested By", width: 119},
               {field: "iss_by",title: "Issued By", width: 90},
               {field: "remarks",title: "Remarks", width: 161},
               {field: "sub_date_fog",title: "FOG Date", width: 122, format: "{0:MM/dd/yyyy}", attributes: {style: "text-align: right;"}},
               {field: "sub_date_client",title: "Client Sub.", width: 122, format: "{0:MM/dd/yyyy}", attributes: {style: "text-align: right;"}},
               {field: "finalized",title: "Finalized", width: 82},
               {field: "jmif_status",title: "JMIF Status", width: 98},
               {field: "whse_prep",title: "WHSE Prepared", width: 127}
           ],
           change: function(e){
			    if (!$("#saveButt").is(":hidden"))
			    	return true;
			    	
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
			    grid_change(currRow,"#rowSelection");
			    jmifdtl_ds.read();
           },
           dataBound: addExtraStylingToGrid
        });
		//$("#rowSelection .k-grid-toolbar").hide();
        insertGridTitle('#rowSelection','JMIF Header');                    
        jmifdtl_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/treqDtl",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/treqDtl",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else {	    						    				
							$(".wrap-button button").each(function(index,value){
								if ($(this).parent().parent().parent().prop("class") == "jmifdtl_phase"){
									if ($(this).hasClass("mainEve"))
										$(this).show();
									else
										$(this).hide();
								}else
									$(this).prop("disabled", false).removeClass("k-state-disabled");
							});						
							
							jmifdtl_ds.page(jmifdtl_ds.page());
							$("#coverDiv").remove();
						}
						jmifdtl_ds.read();
	                }
                },
                update: {
                    url: crudService + "manage/treqDtl",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else {
							$(".wrap-button button").each(function(index,value){
								if ($(this).parent().parent().parent().prop("class") == "jmifdtl_phase"){
									if ($(this).hasClass("mainEve"))
										$(this).show();
									else
										$(this).hide();
								}else
									$(this).prop("disabled", false).removeClass("k-state-disabled");
							});
							
							dataSource.page(dataSource.page());
							$("#coverDiv").remove();
						}
						dataSource.read();
	                }
                },
                destroy: {
                    url: crudService + "remove/treqDtl",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else
							jmifdtl_ds.page(jmifdtl_ds.page());
						jmifdtl_ds.read();
	                }
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : (typeof this.value == "boolean" ? (this.value ? 1 : 0) : this.value);
				      		filterFArr_jmifdtl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_jmifdtl[index] = this.operator;
				      		filterVArr_jmifdtl[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "log_date");
				    query = filterFArr_jmifdtl;
				    dirSort = ($(data.sort).length ? data.sort[0].dir : "desc");
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_jmifdtl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    operator: (($(data.filter).length > 0) ? filterOArr_jmifdtl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_jmifdtl : sentValue_jmifdtl),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    jmif_no: dataItem.jmif_no,
					    disc_code: disc_code
			        }
			      }else{
			      	  data['log_user'] = $("#hidden_user").val();
					  data['jmif_no'] = dataItem.jmif_no;
			      	  data['jmif_date'] = kendo.toString(dataItem.jmif_date,"yyyy-MM-dd");
			      	  data['disc_code'] = disc_code;
			      	  data['direct_with'] = (data.direct_with ? 1 : 0);
			      	  data['dlmr_jwrr'] = (data.dlmr_jwrr ? 1 : 0);
			      	  data['excess'] = (data.excess ? 1 : 0);
			      	  data['stock_no'] = (data['stock_no'] == "" ? stock_no : data['stock_no']);
			      	  data['item_code'] = (data['item_code'] == "" ? item_code : data['item_code']);
			      	  data['commodity_code'] = (data['commodity_code'] == "" ? commodity_code : data['commodity_code']);
			      	  data['mat_desc'] = (data['mat_desc'] == "" ? mat_desc : data['mat_desc']);
			      	  data['uom'] = (data['uom'] == "" ? uom : data['uom']);
			      	  data['size'] = (data['size'] == "" ? size : data['size']);
			      	  data['hasChange'] = hasChange;			      	  
					  data['mat_status'] = ((data.req_qty <= data.iss_qty) ? 'CLOSED' : ((data.iss_qty > 0) ? 'PARTIAL' : 'OPEN'));
					  data['spl_type'] = (($.inArray(disc_code, ["PS","INST","ELE"]) < 0) ? (data.excess ? "" : data.spl_type) : data.system);
					  data['hasChange'] = hasChange;
					  data['module'] = 'ISS';
					  data['req_qty_old'] = req_qty_old;
					  data['iss_qty'] = (data.iss_qty == null ? 0 : data.iss_qty);
					  data['remarks'] = dataItem.remarks;
					  data['plant_no'] = ($.inArray('plant_no',data) < 0) ? "": data['plant_no'];
			      	  return data;
			      }
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
					    sentValue_jmifdtl = "";
					    filterFArr_jmifdtl = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        item_code: { type: "string", editable: false, nullable: false, validation: {required: true} },
                        mat_desc: { type: "string", editable: false },
                        support_no: { type: "string" },
                        activity_code: { type: "string" },
                        measurement: { type: "number" },
                        req_qty: {
                            defaultValue: 0,
                            type: "number", 
                            format: "{0:c3}",
                            validation: {
                                required: true,
                                customReqQty: function (input) {
                                    if (input.attr("data-bind") == "value:req_qty" && input.val() == 0){
                                        input.attr("data-customReqQty-msg", "req_qty is required");
                                        input.parents("td").append(tooltip(Message = "", Key = input.attr("data-bind").split(":")[1]));
                                        return false;
                                    }
                                    return true;
                                }
                            }
                        },
                        // req_qty: { type: "number", format: "{0:c3}", validation: { required: true, min: 1}},
                        // req_qty: { type: "number", format: "{0:c3}", nullable: false, validation: {required: true, min: 1, qtyCheck: function(input){
                        		// if (input.attr("data-bind") == "value:req_qty"){
                        			// if (input.val() == 0){
	                        			// // showNotif('Warning',"Requested Qty must be greater than Zero (0).",'warning');
	                        			// input.attr("data-req_qty-msg", "Requested Qty must be greater than Zero (0).");
	                        			// return false;
	                        		// }
                        			// return true;
                        		// }
                        	// }}},
                        system_no: { type: "string" },
                        sub_system: { type: "string" },
                        testpack_no: { type: "string" },
                        spl_type: { type: "string" },
                        mat_util: { 
                        	type: "string",
                        	nullable: false,
                        	validation: {
                        		required: true,
                                customMatUtil: function (input) {
                                    if (input.attr("data-bind") == "value:mat_util" && input.val() == ""){
                                        input.attr("data-customMatUtil-msg", "mat_util is required");
                                        input.parents("td").append(tooltip(Message = "", Key = input.attr("data-bind").split(":")[1]));
                                        return false;
                                    }
                                    return true;
                                }
                        	}
                        },                                                
                        stock_no: { 
                        	type: "string",
                        	nullable: false,
                        	validation: {
                                required: true,
                                customStockNo: function (input) {
                                    if (input.attr("data-bind") == "value:stock_no" && input.val() == ""){
                                        input.attr("data-customStockNo-msg", "stock_no is required");
                                        input.parents("td").append(tooltip(Message = "", Key = input.attr("data-bind").split(":")[1]));
                                        return false;
                                    }
                                    return true;
                                }
                        	}
                        },
                        uom: { type: "string", editable: false },
                        size: { type: "string", editable: false },
                        iss_qty: { type: "number", format: "{0:c3}" },
                        area_no: { type: "string", editable: false },
                        drawing_no: { type: "string" , nullable: false, validation: {required: true} },
                        sheet_no: { type: "string" , nullable: false, validation: {required: true} },
                        rev_no: { type: "string" },
                        spool_no: { type: "string", editable: false },
                        direct_with: { type: "boolean" },
                        dlmr_jwrr: { type: "boolean" },
                        excess: { type: "boolean" },
                        commodity_code: { type: "string", editable: false, nullable: false, validation: {required: true} },
                        mat_status: { type: "string", editable: false },
                        qcmrir_no: { type: "string" },
                        rfi_no: { type: "string" }
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
			$("#jmifdtl_rs").data("kendoGrid").select("tr:eq(" + (dataSource._data.length + 2) + ")");
	        $("#jmifdtl_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_jmifdtl = [];
	    };
        
        var grid2 = $("#jmifdtl_rs").kendoGrid({
            dataSource: jmifdtl_ds,
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
            editable: 'inline',
			toolbar: ["save","cancel"],
            resizable: true,
            filterable: {
                extra: false
            },
            // columns: [
               // {field: "stock_no",title: "Stock No.",width: 132, editor: stock_no_DDE},
               // {field: "item_code",title: "Item Code", width: 132},
               // {field: "commodity_code",title: "Commodity Code", width: 132},
               // {field: "mat_desc",title: "Material Description", width: 331},
               // {field: "uom",title: "Unit of Measure", width: 125},
               // {field: "size",title: "Size", width: 51},
               // {field: "activity_code",title: "Activity Code", width: 107},
               // {field: "mat_util",title: "Material Utilization", width: 189, editor: mat_util_DDE},
               // {field: "measurement",title: "Measurement", width: 112},
               // {field: "req_qty",title: "Request Qty.", width: 107, editor: req_qty_NTE},
               // {field: "iss_qty",title: "Issued Qty.", width: 99, editor: iss_qty_NTE},
               // {field: "area_no",title: "Area No.", width: 89},
               // {field: "drawing_no",title: "Drawing No.", width: 123},
               // {field: "sheet_no",title: "Sheet No.", width: 87},
               // {field: "rev_no",title: "Rev. No.", width: 76},
               // {field: "direct_with",title: "DW", width: 50},
               // {field: "dlmr_jwrr",title: "DJ", width: 50},
               // {field: "rfi_no",title: "RFI No.", width: 89},
               // {field: "qcmrir_no",title: "QCMRIR No.", width: 101}
           // ],
            columns: mdtl_col,
            // columns: [
               // {field: "stock_no",title: "Stock No.",width: 132, editor: stock_no_DDE},
               // {field: "item_code",title: "Item Code", width: 132},
               // {field: "commodity_code",title: "Commodity Code", width: 132},
               // {field: "mat_desc",title: "Material Description", width: 331},
               // {field: "support_no",title: "Support No.", width: 101},
               // {field: "uom",title: "Unit of Measure", width: 125},
               // {field: "size",title: "Size", width: 51},
               // {field: "activity_code",title: "Activity Code", width: 107},
               // {field: "mat_util",title: "Material Utilization", width: 189, editor: mat_util_DDE},
               // {field: "measurement",title: "Measurement", width: 112},
               // {field: "req_qty",title: "Request Qty.", width: 107, editor: req_qty_NTE},
               // {field: "iss_qty",title: "Issued Qty.", width: 99, editor: iss_qty_NTE},
               // {field: "drawing_no",title: "Drawing No.", width: 123},
               // {field: "sheet_no",title: "Sheet No.", width: 87},
               // {field: "rev_no",title: "Rev. No.", width: 76},
               // {field: "spool_no",title: "Spool No.", width: 84},
               // {field: "testpack_no",title: "Testpack No.", width: 107},
               // {field: "system_no",title: "System", width: 72},
               // {field: "sub_system",title: "Sub System", width: 100},
               // {field: "direct_with",title: "DW", width: 50},
               // {field: "dlmr_jwrr",title: "DJ", width: 50},
               // {field: "excess",title: "EX", width: 50},
               // {field: "spl_type",title: "Spool Type", width: 97, editor: spl_type_DDE},
               // {field: "mat_status",title: "Material Req. Status", width: 153}
           // ],
           change: function(e){
			    if (!$("#saveButt").is(":hidden"))
			    	return true;
			    	
           		currRow2 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
				$("#editButt2, #issButt, #viewButt").prop("disabled", false).removeClass("k-state-disabled");
			    // if (selectedRows.length > 0)
		        	// $("#editButt2, #delButt2, #issButt").prop("disabled", false).removeClass("k-state-disabled");
			    for (var i = 0; i < selectedRows.length; i++) {
			        jmifdtl_di = this.dataItem(selectedRows[i]);
			        req_qty_old = jmifdtl_di.req_qty;
			        drawing_no_old = jmifdtl_di.drawing_no;
			        spool_no_old = jmifdtl_di.spool_no;
			        if (dataItem.finalized == 0 || dataItem.finalized == null)
			        	// $("#editButt2, #delButt2, #issButt, #jmifButt").prop("disabled", false).removeClass("k-state-disabled");
			        	$("#delButt2").prop("disabled", false).removeClass("k-state-disabled");
			        else
			        	// $("#editButt2, #delButt2, #issButt, #jmifButt").prop("disabled", true).addClass("k-state-disabled");
			        	$("#delButt2").prop("disabled", true).addClass("k-state-disabled");
			    }
			    $.each(jmifdtl_ds.data(),function(index,value){
			    	if (value.iss_qty > 0){
	        			$("#delButt, #delButt2").prop("disabled", true).addClass("k-state-disabled");
	        			if (dataItem.finalized == 1)
	        				$("#finButt").prop("disabled", true).addClass("k-state-disabled");
	        			return true;
	        		}else
	        			$("#delButt, #delButt2, #finButt").prop("disabled", false).removeClass("k-state-disabled");
			    });
			    if (dataItem.whse_prep != 1)
    				$("#delButt, #delButt2, #finButt, #enggButt").prop("disabled", true).addClass("k-state-disabled");
			    // grid_change(currRow2,"#jmifdtl_rs");
           },
           dataBound: addExtraStylingToGrid2
        });
		$("#jmifdtl_rs .k-grid-toolbar").hide();
        insertGridTitle('#jmifdtl_rs','JMIF Detail');
        
        // $("#jmifdtl_rs").kendoValidator({
            // rules: {
                // // custom rules
                // custom: function (input, params) {
                    // if (input.is("[name=req_qty]")) {
//  
                        // //If the input is StartDate or EndDate
                        // var container = $(input).closest("tr");
//  
                        // // var start = container.find("input[name=StartDate]").data("kendoDatePicker").value();
                        // // var end = container.find("input[name=EndDate]").data("kendoDatePicker").value(); 
                        // var qty = container.find("input[name=req_qty]").data("kendoDatePicker").value(); 
                        // // if (start > end) {
                       	// alert(qty);
                       	// if (qty == 0) {
                            // return false;
                        // }
                    // }
                    // //check for the rule attribute
                    // return true;
                // }
            // },
            // messages: {
                // custom: function (input) {
                    // // return the message text
                    // // return "Start Date must be greater than End Date!";
                    // return "Required Qty. must be greater than zero!";
                // }
            // }
        // });
        
		processMatTO = true;
	    $(".wrap-button .buttonLeft button").bind({
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
	    				
    					$("#jmifdtl_rs").data("kendoGrid").dataSource.remove(jmifdtl_di);
						jmifdtl_ds.sync();
						jmifdtl_ds.page(jmifdtl_ds.page());
						// jmifdtl_ds.read();
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
								// dataSource.read();
	    					});
	    			break;	   
	    			case "enggButt":			
						$.post(crudService + "directCall/verifyRUD",{log_user: $("#hidden_user").val(), disc_code: disc_code},
							function(data){
								//ruserWA = (data != 1);
								if (data != 1){
					    			$("#window").data("kendoWindow").setOptions({
									    title: "Eng'g Material Take-Off List Help",
									    width: "991px",
									    height: "auto",
									    close: function(){
									    	jmifdtl_ds.page(1);
									    	jmifdtl_ds.read();
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
									    	jmifdtl_ds.page(1);
									    	jmifdtl_ds.read();
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
		    				
                    		// var validator = $("#jmifdtl_rs").kendoValidator().data("kendoValidator");
		    				// if (!validator.validate()){		    					
								// showNotif('Warning',"Oooopppsss...",'warning');
			    				// return true;
		    				// }
		    				
		    				// isFailed = verifyThisInput(".jmifdtl_phase");
				    		// if (isFailed)
				    			// return true;
				    			
			    			// if (jmifdtl_di.req_qty == 0){
								// showNotif('Warning',"Requested Qty must be greater than Zero (0).",'warning');
			    				// return true;
			    			// }
			    			
			    			
						    // attach a validator to the container and get a reference
						    // var validatable = $("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected").kendoValidator().data("kendoValidator");
// 						
						    // validatable.bind("validate", function(e) {
						        // console.log("valid" + e.valid);
						    // });
						    // return true;
				    			
				    		if ($("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(3).text().indexOf("pipe") < 0 || jmifdtl_di.excess){
				    			if (jmifdtl_di.iss_qty > jmifdtl_di.req_qty){
									showNotif('Warning',"Issued Qty. must not be greater than the Requested Qty.",'warning');
				    				return true;
				    			}
				    		}
		    				
		    				if (($.trim(jmifdtl_di.drawing_no) != $.trim(drawing_no_old)) || ($.trim(jmifdtl_di.spool_no) != $.trim(spool_no_old)))
		    					hasChange = true;
	
		    				$("#jmifdtl_rs .k-grid-toolbar .k-grid-save-changes").trigger( "click" );
	    				}else {
	    					$( "#jmifdtl_rs .k-grid-toolbar .k-grid-cancel-changes" ).trigger( "click" );
	    						    				
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
			    				// isFailed = false;
			    				$("#rowSelection").data("kendoGrid").addRow();
								// $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea").val("");
								$.get(crudService + "directCall/rcontrol", {trancode: "jmif", disc_code: disc_code},
									function(data){
										$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).html(data.rows[0].pono);
										$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(1).find("input").focus();
										// $("#txt1").prop("disabled", true).addClass("k-state-disabled").val(data.rows[0].pono);
									});
			    			}else {
			    				if (typeof dataItem == "string")
			    					return true;
								cMode = "edit";
			    				$("#rowSelection").data("kendoGrid").editRow($("#rowSelection").data("kendoGrid").select());
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(1).html(kendo.toString(dataItem.jmif_date,"MM/dd/yyyy"));
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(2).html(dataItem.req_by);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(4).html(dataItem.remarks);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(5).find("input").select().focus();
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
							// $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea, .jmif_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							// $('input[name=option1], input[name=option2], input[name=option3], #search').prop("disabled", true);
							// $("#txt1").prop("disabled", true).addClass("k-state-disabled");
							// $(".jmif_phase .wrap-form input").eq(1).select().focus();
							// jmif_date.enable(true);
							// sub_date_fog.enable(true);
							// sub_date_client.enable(true);
						}else {
							if (dataItem.length == 0)
								return true;
			    			if (this.id == "addButt2")
			    				$("#jmifdtl_rs").data("kendoGrid").addRow();
			    			else {
			    				$("#jmifdtl_rs").data("kendoGrid").editRow($("#jmifdtl_rs").data("kendoGrid").select());
			    				if (dataItem.finalized != 1 || dataItem.whse_prep != 1){
									$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(4).html(jmifdtl_di.support_no);			    					
									$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(7).html(jmifdtl_di.activity_code);			    					
									// $("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(9).html(jmifdtl_di.measurement);
									// $("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(10).html(jmifdtl_di.req_qty);
									// $("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(17).html(jmifdtl_di.system_no);			    					
									// $("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(16).html(jmifdtl_di.testpack_no);
									$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(22).html(jmifdtl_di.spl_type);			    					
									$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(8).html(jmifdtl_di.mat_util);			    					
			    				}
			    				if (jmifdtl_di.iss_qty > 0)
									$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).html(jmifdtl_di.stock_no);
			    			}
		    					    
							$("input[type=checkbox]").bind({
								click: function(e){
									$("input[type=checkbox]").prop("checked", false);
									this.checked = !this.checked;
								}
							});
	    
							$(".wrap-button button").each(function(index,value){
								if ($(this).parent().parent().parent().prop("class") == "jmifdtl_phase"){
									if ($(this).hasClass("mainEve"))
										$(this).hide();
									else
										$(this).show();
								} else
									$(this).prop("disabled", true).addClass("k-state-disabled");
							});
							// if (dataItem.length == 0)
								// return true;
							// $(".jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea, .jmifdtl_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							// // req_qty.enable(true);
							// // item_code.enable(true);
							// // mat_util.enable(true);
			    			// if (this.id == "addButt2"){
			    				// isFailed = false;
			    				// measurement.enable(false);
								// $(".jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea").val("");
								// $(".jmifdtl_phase .wrap-form input[type=checkbox]").eq(0).select().focus();
								// // $('input[name=option1], input[name=option2], input[name=option3], #search').prop("disabled", true);
								// $("#txt6, #textarea2, #textarea3, #txt8, #txt9, #txt10, #txt11, #txt23").prop("disabled", true).addClass("k-state-disabled");
								// cMode = "add";
			    			// }else {
								// // measurement.enable(true);
								// $(".jmifdtl_phase .wrap-form input").select().focus();
								// // $("#txt8, #txt9, #txt10, #txt16, #txt17, #textarea2, #textarea4, #txt18, #txt19, #txt20, #txt23").prop("disabled", true).addClass("k-state-disabled");
								// $(".jmifdtl_phase .wrap-form input[name!=option4], .jmifdtl_phase .wrap-form input[name!=option4], .jmifdtl_phase .wrap-form textarea").prop("disabled", true).addClass("k-state-disabled");
								// $(".jmifdtl_phase .wrap-form input[type=checkbox]").prop("disabled", false).removeClass("k-state-disabled");
								// if (iss_qty.value() <= 0)
									// stock_no.enable(true);
								// iss_qty.enable(true);
								// cMode = "edit";
							// }
						}
						// $(".wrap-button button").prop("disabled", true).addClass("k-state-disabled");
						forDiv((this.id.indexOf("2") < 0) ? "jmifdtl_rs" : "rowSelection");
	    			break;
	    		}
	    	}
	    });

	    $(".wrap-button .buttonRight button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			default:
						$("#window").data("kendoWindow").setOptions({
						    title: "Upload Bulk Item Details (PIPING)",
						    width: "991px",
						    height: "auto",
						    close: function(){
						    	dataSource.page(1);
						    	// dataSource.read();
						    }
						});
						$("#window").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/webapps/qms/index/index/qmsUbi_pip1",
							type: "POST",
							data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
						});
			        	$("#window").data("kendoWindow").center().open();
	    			break;
	    		}
	    	}
	    });	    
	});
</script>