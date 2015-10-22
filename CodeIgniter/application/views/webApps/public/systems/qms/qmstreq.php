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
	#header li {width: 355px;}
	#stock li {width: 95%;}
	#stock_ext li {width: 290px;}
	#header li:first-child {width: 320px;}
	#stock li:last-child {line-height: 17px;}
	#header li ul li {width: 400px !important;}
	#stock li ul li {width: 505px !important;}
	#iso li {width: 146px !important;text-align: center;}
	#iso li label {line-height: 18px;}
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
	        		<h2>#= (item_code == null || item_code == "") ? ((commodity_code == null || commodity_code == "") ? "" : commodity_code) : item_code #</h2>
<!-- 	        		<h2>#= (item_code == "" || item_code == null) ? commodity_code : item_code #</h2> -->
<!-- 	        		<h2>#= (commodity_code == null) ? "" : commodity_code #</h2> -->
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
	        	<button class="k-button mainEve" id="uplButt">Upload</button>
	       	</div>
			<div class="buttonRight">
				<label class="title" for="txt24" style="width: auto;">Client Sub. Date:</label><input type="text" name="txt24" id="txt24" class="k-textbox k-state-disabled" disabled style="width: 85px;"/>
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
	        	<button class="k-button mainEve k-state-disabled" disabled id="addButt2">Add</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="editButt2">Edit</button>
	        	<button class="k-button mainEve k-state-disabled" disabled id="delButt2">Delete</button>
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
		disc_code = pathname.split('/')[pathname.split('/').length - 1];
	function grid_change(e,grid){
		if (typeof e == "undefined")
			e = grid;
		var selectedRows = e.select();
		var selectedDataItems = [];
	    // $("#addButt2, #editButt2, #delButt2, #enggButt").prop("disabled", false).removeClass("k-state-disabled");
		for (var i = 0; i < selectedRows.length; i++) {
			dataItem3 = e.dataItem(selectedRows[i]);	
    		// $("#editButt, #delButt").prop("disabled", true).addClass("k-state-disabled");		        
    		$("#viewButt").prop("disabled", true).addClass("k-state-disabled");
			if ((dataItem3.finalized == 0 || dataItem3.finalized == null)){
				// $("#editButt, #delButt, #addButt2, #editButt2, #delButt2, #enggButt").prop("disabled", false).removeClass("k-state-disabled");
				$("#editButt, #delButt, #addButt2, #editButt2, #delButt2, #enggButt").prop("disabled", false).removeClass("k-state-disabled");
				$("#finButt").text("Finalize");
			}else {
				$("#editButt, #delButt, #addButt2, #editButt2, #delButt2, #enggButt").prop("disabled", true).addClass("k-state-disabled");
				$("#finButt").text("Unfinalize");
			}
			// if (dataItem3.whse_prep == 1 || (dataItem3.finalized == 1 && dataItem3.sub_date_client != null))			        			
    			// $("#finButt, #addButt2, #enggButt").prop("disabled", true).addClass("k-state-disabled");
			if (dataItem3.whse_prep == 1)			        			
    			$("#delButt, #finButt, #addButt2, #editButt2, #delButt2, #enggButt").prop("disabled", true).addClass("k-state-disabled");
    		if (dataItem3.sub_date_client != null)	        			
    			$("#finButt").prop("disabled", true).addClass("k-state-disabled");							
			$("#txt24").val(kendo.toString(dataItem3.sub_date_client,'MM/dd/yyyy'));
			$("#txt25").val(dataItem3.log_user);
			$("#txt26").val(kendo.toString(dataItem3.log_date,'MM/dd/yyyy'));
			$("#txt27").val(dataItem3.log_update);
	    }
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
    function showDetails(div, title, dataItem) {
    	console.log(dataItem);
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
	$(document).ready(function(){
		$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
		var crudService = crudServiceBaseUrl + "qms/index/",
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", currRow2 = "", cMode = "", dataItem = '', jmifdtl_di = '', isFailed = false,
		    filterFArr_jmifdtl = [], filterOArr_jmifdtl = [], filterVArr_jmifdtl = [], sentValue_jmifdtl = "", fieldSort = "", dirSort = "", query = "",
			optionArr = ["","jmif_no","jmif_date","req_by","remarks"], stock_no = "", item_code = "", commodity_code = "", mat_desc = "", uom = "", size = "";
        
		$(".wrap-button button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();
		});
	    
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
		            		$(".k-input").eq(14).val("").select().focus();
		            }
	            });
        }
	    
	    var stock_no_DDE = function(container, options) {
	        $('<input required data-text-field="stock_no" data-value-field="stock_no" id="stock_no" data-bind="value:' + options.field + '"/>')
	            .appendTo(container)
	            .kendoComboBox({
	                autoBind: false,
	                dataSource: {
	                    transport: {
	                        read: crudService + "directCall/item?disc_code=" + spltype_code,
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
							$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(2).find("input").val(commodity_code);
							$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(3).find("input").val(mat_desc);
							$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(4).find("input").val(uom);
							$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(5).find("input").val(size);
							$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(6).find("input").focus();
		            	}
		            }
	            });
        }
	    
	    var item_code_DDE = function(container, options) {
	        $('<input required data-text-field="item_code" data-value-field="item_code" id="item_code" data-bind="value:' + options.field + '"/>')
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
		            		// stock_no = this.value().split(",")[5];
		            		// item_code = this.value().split(",")[3];
		            		// commodity_code = this.value().split(",")[4];
		            		// mat_desc = this.value().split(",")[0];
		            		// uom = this.value().split(",")[2];
		            		// size = this.value().split(",")[1];
							$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).html(stock_no);
							$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(2).find("input").val(commodity_code);
							$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(3).find("input").val(mat_desc);
							$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(4).find("input").val(uom);
							$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(5).find("input").val(size);
							$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(6).find("input").focus();
		            	}
		            }
	            });
        }
	    
	    var mat_util_DDE = function(container, options) {
	        $('<input required data-text-field="util_dtl" data-value-field="util_code" id="mat_util" data-bind="value:' + options.field + '"/>')
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
		            		$(".k-input").eq(4).val("").select().focus();
		            }
	            });
       };
        
        var columns = [
               {field: "jmif_no",title: "JMIF No.",width: 120},
               {field: "jmif_date",title: "JMIF Date", width: 123, format: "{0:MM/dd/yyyy}"},
               {field: "req_by",title: "Requested By", width: 112},
               {field: "iss_by",title: "Issued By", width: 89},
               {field: "sub_date_fog",title: "FOG Date", width: 123, format: "{0:MM/dd/yyyy}" },
               {field: "date_reqd",title: "Req. Date", width: 123, format: "{0:MM/dd/yyyy}" },
               {field: "remarks",title: "Remarks", width: 221},
               {field: "finalized",title: "Finalized", width: 81},
               {field: "jmif_status",title: "JMIF Status", width: 98},
               {field: "whse_prep",title: "WHSE. Prepared", width: 132}
           ],
           columns_dtl = [
               {field: "stock_no",title: "Stock No.",width: 132, editor: stock_no_DDE},
               {field: "item_code",title: "Item Code", width: 132, editor: item_code_DDE},
               {field: "commodity_code",title: "Commodity Code", width: 132},
               {field: "mat_desc",title: "Mat. Desc.", width: 327},
               {field: "uom",title: "UOM", width: 55},
               {field: "size",title: "Size", width: 51},
               {field: "req_qty",title: "Request Qty.", width: 105},
               {field: "iss_qty",title: "Issued Qty.", width: 105},
               {field: "mat_util",title: "Material Utilization", width: 189, editor: mat_util_DDE},
               {field: "measurement",title: "Measurement", width: 112},
               {field: "support_no",title: "Supp. No.", width: 88},
               {field: "plant_no",title: "Plant No.", width: 81},
               {field: "area_no",title: "Area No.", width: 81},
               {field: "drawing_no",title: "Drawing No.", width: 123},
               {field: "sheet_no",title: "Sheet No.", width: 85},
               {field: "rev_no",title: "Rev. No.", width: 81},
               {field: "spool_no",title: "Spool No.", width: 85},
               {field: "testpack_no",title: "Testpack No.", width: 105},
               {field: "system_no",title: "System", width: 72},
               {field: "sub_system",title: "Sub System", width: 100},
               {field: "activity_code",title: "Activity Code", width: 107},
               {field: "direct_with",title: "DW", width: 50},
               {field: "lisoreqd",title: "ISO Reqd.", width: 89},
               {field: "spl_type",title: "Spool Type", width: 96, editor: spl_type_DDE},
               {field: "mat_status",title: "Material Req. Status", width: 154}
           ],
           fields_dtl = {
           	    PROGRESS_RECID: { type: "number", editable: false },
                stock_no: { type: "string" },
                commodity_code: { type: "string", nullable: false, validation: {required: true} },
                plant_no: { type: "string", nullable: false, validation: {required: true} },
                area_no: { type: "string", nullable: false, validation: {required: true} },
                drawing_no: { type: "string", nullable: false, validation: {required: true} },
                sheet_no: { type: "string", nullable: false, validation: {required: true} },
                rev_no: { type: "string", nullable: false, validation: {required: true} },
                spool_no: { type: "string", nullable: false, validation: {required: true} },
                mat_desc: { type: "string" },
                uom: { type: "string", nullable: false, validation: {required: true} },
                size: { type: "string", nullable: false, validation: {required: true} },                        
                item_code: { type: "string", nullable: false, validation: {required: true} },                        
                support_no: { type: "string" },
                activity_code: { type: "string" },
                measurement: { type: "number" },                        
                req_qty: { type: "number", nullable: false, validation: {required: true} },
                system_no: { type: "string" },
                sub_system: { type: "string" },
                testpack_no: { type: "string" },
                direct_with: { type: "boolean" },
                lisoreqd: { type: "boolean" },
                spl_type: { type: "string" },
                mat_util: { type: "string", nullable: false, validation: {required: true} },                        
                iss_qty: { type: "number", editable: false },
                mat_status: { type: "string", editable: false }
            };
			
		switch(disc_code.toLowerCase()){
			case "cvl":
				// $("#uplButt, .buttonRight, ul > li.liSubDate, ul > li.liDateReq, label[for=chk2], ul > li.liSuppNo, ul > li.liPlant, ul > li.liSheet, ul > li.liSpool, ul > li.liRad").hide();
				$("#uplButt, .buttonRight").hide();
				columns.splice(4,2);
				columns_dtl[23].editor = "";
				columns_dtl.splice(22,1);
				columns_dtl.splice(14,3);
				columns_dtl.splice(10,3);
			break;
			case "strl":
				// $("#uplButt, label[for=chk2], ul > li.liComCode, ul > li.liPlant, ul > li.liSystem, ul > li.liRad").hide();
				$("#uplButt").hide();
				columns_dtl[23].editor = "";
				columns_dtl.splice(22,1);
				columns_dtl.splice(18,2);
				columns_dtl.splice(11,1);
				columns_dtl.splice(2,1);
				columns_dtl[1].title = 'Piece Mark';
				columns_dtl.push({field: "rfi_no",title: "RFI No.", width: 154},{field: "qcmrir_no",title: "QCMRIR No.", width: 154});
				// $("#txt7").parent().find("label").html($("#txt7").parent().find("label").html().replace("Item Code","Piece Mark"));
				// $("#textarea3").parent().find("label").html($("#textarea3").parent().find("label").html().replace("Support No","Area No"));
				// $("#txt20").parent().find("label").html($("#txt20").parent().find("label").html().replace("Spool No","RFI No"));
				// $("#txt23").parent().find("label").html($("#txt23").parent().find("label").html().replace("Testpack No","QCMRIR No"));
			break;
			case "mech":
				$("#uplButt").hide();
				columns.splice(5,1);
				columns_dtl[23].editor = "";
				columns_dtl.splice(22,1);
				columns_dtl.splice(18,2);
				columns_dtl.splice(11,1);
				columns_dtl.splice(2,1);
				columns_dtl[1].title = 'Tag No.';
				columns_dtl.push({field: "rfi_no",title: "RFI No.", width: 154},{field: "qcmrir_no",title: "QCMRIR No.", width: 154});
				// $("#uplButt, ul > li.liDateReq, label[for=chk2], ul > li.liComCode, ul > li.liPlant, ul > li.liSystem, ul > li.liRad").hide();
				// $("#txt7").parent().find("label").html($("#txt7").parent().find("label").html().replace("Item Code","Tag No."));
				// $("#textarea3").parent().find("label").html($("#textarea3").parent().find("label").html().replace("Support No","Area No"));
				// $("#txt20").parent().find("label").html($("#txt20").parent().find("label").html().replace("Spool No","RFI No"));
				// $("#txt23").parent().find("label").html($("#txt23").parent().find("label").html().replace("Testpack No","QCMRIR No"));
			break;
			case "ps":
				$("#uplButt, .buttonRight").hide();
				columns.splice(4,2);
				columns_dtl[23].editor = "";
				columns_dtl.splice(22,1);
				columns_dtl.splice(14,3);
				columns_dtl.splice(10,3);
				columns_dtl.splice(2,1);
				columns_dtl[1].title = 'PS No.';
				// $("#uplButt, .buttonRight, ul > li.liSubDate, ul > li.liDateReq, label[for=chk2], ul > li.liSuppNo, ul > li.liComCode, ul > li.liPlant, ul > li.liSheet, ul > li.liSpool, ul > li.liRad").hide();
				// $("#txt7").parent().find("label").html($("#txt7").parent().find("label").html().replace("Item Code","PS No."));
				// $("ul > li.liType").show();
			break;
			case "inst":
			case "ele":
				$("#uplButt, .buttonRight").hide();
				columns.splice(4,1); //liSubDate
				columns_dtl[23].editor = ""; //liRad
				columns_dtl.splice(22,1); //liChk
				columns_dtl.splice(18,2); //liSystem
				columns_dtl.splice(11,1); //liPlant
				columns_dtl[0].title = 'Tag No.';
				columns_dtl.push({field: "rfi_no",title: "RFI No.", width: 154},{field: "qcmrir_no",title: "QCMRIR No.", width: 154});
				// $("#uplButt, .buttonRight, ul > li.liSubDate, ul > li.liChk, ul > li.liPlant, ul > li.liSystem, ul > li.liRad").hide();
				// $("#txt6").parent().find("label").html($("#txt6").parent().find("label").html().replace("Stock No","Tag No"));
				// $("#txt7").addClass("k-textbox");
				// $("#textarea3").parent().find("label").html($("#textarea3").parent().find("label").html().replace("Support No","Area No"));
				// $("#txt20").parent().find("label").html($("#txt20").parent().find("label").html().replace("Spool No","RFI No"));
				// $("#txt23").parent().find("label").html($("#txt23").parent().find("label").html().replace("Testpack No","QCMRIR No"));
				// $("ul > li.liType").show();
			break;
			case "spl":
				$("#uplButt").hide();
			break;
			case "psf":
				$("#uplButt, .buttonRight").hide();
				columns.splice(4,2); //liSubDate and liDateReq
				columns_dtl[23].editor = ""; //liRad
				columns_dtl.splice(22,1); //liChk
				columns_dtl.splice(10,3); //liSuppno and liPlant
				columns_dtl.splice(14,3); //liSheet and liSpool
				columns_dtl.splice(2,1); //liComCode
				columns_dtl[1].title = 'PS No.';
				// $("#uplButt, .buttonRight, ul > li.liSubDate, ul > li.liDateReq, label[for=chk2], ul > li.liSuppNo, ul > li.liComCode, ul > li.liPlant, ul > li.liSheet, ul > li.liSpool, ul > li.liRad").hide();
				// $("#txt7").parent().find("label").html($("#txt7").parent().find("label").html().replace("Item Code","PS No."));
			break;		
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
	                }
                },
                destroy: {
                    url: crudService + "remove/treq",
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
					    whse_prep : 0 
			        }
			      }else {
			      	data['whse_prep'] = 0;
			      	data['finalized'] = (data.finalized ? 1 : 0);
			      	data['log_user'] = $("#hidden_user").val();
			      	data['disc_code'] = disc_code;
			      	data['jmif_no'] = (type == "create" ? $("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).html() : data.jmif_no);
			      	data['jmif_date'] = kendo.toString(data.jmif_date,"yyyy-MM-dd");
			      	data['sub_date_fog'] = kendo.toString(data.sub_date_fog,"yyyy-MM-dd");
			      	data['sub_date_client'] = kendo.toString(data.sub_date_client,"yyyy-MM-dd");
			      	data['date_reqd'] = kendo.toString(data.date_reqd,"yyyy-MM-dd");
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
                        finalized: { type: "boolean", editable: false },
                        whse_prep: { type: "boolean", editable: false },
                        jmif_status: { type: "string", editable: false },
                        sub_date_fog: { type: "date"},
                        sub_date_client: { type: "date" },
                        date_reqd: { type: "date", nullable: false, validation: {required: true}},
                        log_user: { type: "string"},
                        log_date: { type: "date"},
                        log_update: { type: "string"}
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
            columns: columns,
            // columns: [
               // {field: "jmif_no",title: "JMIF No.",width: 120},
               // {field: "jmif_date",title: "JMIF Date", width: 123, format: "{0:MM/dd/yyyy}"},
               // {field: "req_by",title: "Requested By", width: 112},
               // {field: "iss_by",title: "Issued By", width: 89},
               // {field: "sub_date_fog",title: "FOG Date", width: 123, format: "{0:MM/dd/yyyy}", hidden: (disc_code == "CVL")},
               // {field: "date_reqd",title: "Req. Date", width: 123, format: "{0:MM/dd/yyyy}", hidden: (disc_code == "CVL")},
               // {field: "remarks",title: "Remarks", width: 221},
               // {field: "finalized",title: "Finalized", width: 81},
               // {field: "jmif_status",title: "JMIF Status", width: 98},
               // {field: "whse_prep",title: "WHSE. Prepared", width: 132}
           // ],
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
		$("#rowSelection .k-grid-toolbar").hide();
        insertGridTitle('#rowSelection','JMIF Header');                    
        var jmifdtl_ds = new kendo.data.DataSource({
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
	                	if (jqXHR.responseText != '1'){
							showNotif('Warning',jqXHR.responseText,'warning');
						}else {
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
			      	  data['disc_code'] = disc_code;
			      	  data['module'] = "";
			      	  data['stock_no'] = (data['stock_no'] == "" ? stock_no : data['stock_no']);
			      	  data['item_code'] = (data['item_code'] == "" ? item_code : data['item_code']);
			      	  data['commodity_code'] = (data['commodity_code'] == "" ? commodity_code : data['commodity_code']);
			      	  data['mat_desc'] = (data['mat_desc'] == "" ? mat_desc : data['mat_desc']);
			      	  data['uom'] = (data['uom'] == "" ? uom : data['uom']);
			      	  data['size'] = (data['size'] == "" ? size : data['size']);
			      	  data['direct_with'] = (data['direct_with'] ? 1 : 0);
			      	  data['req_qty_old'] = ((data['req_qty_old'] == undefined) ? 0 : data['req_qty_old']);			      	  return data;
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
                    fields: fields_dtl
                    // fields: {
                   	    // PROGRESS_RECID: { type: "number", editable: false },
                        // stock_no: { type: "string" },
                        // commodity_code: { type: "string", nullable: false, validation: {required: true} },
                        // plant_no: { type: "string", nullable: false, validation: {required: true} },
                        // area_no: { type: "string", nullable: false, validation: {required: true} },
                        // drawing_no: { type: "string", nullable: false, validation: {required: true} },
                        // sheet_no: { type: "string", nullable: false, validation: {required: true} },
                        // rev_no: { type: "string", nullable: false, validation: {required: true} },
                        // spool_no: { type: "string", nullable: false, validation: {required: true} },
                        // mat_desc: { type: "string" },
                        // uom: { type: "string", nullable: false, validation: {required: true} },
                        // size: { type: "string", nullable: false, validation: {required: true} },                        
                        // item_code: { type: "string", nullable: false, validation: {required: true} },                        
                        // support_no: { type: "string" },
                        // activity_code: { type: "string" },
                        // measurement: { type: "number" },                        
                        // req_qty: { type: "number", nullable: false, validation: {required: true} },
                        // system_no: { type: "string" },
                        // sub_system: { type: "string" },
                        // testpack_no: { type: "string", editable: false },
                        // direct_with: { type: "boolean" },
                        // lisoreqd: { type: "boolean" },
                        // spl_type: { type: "string" },
                        // mat_util: { type: "string", nullable: false, validation: {required: true} },                        
                        // iss_qty: { type: "number", editable: false },
                        // mat_status: { type: "string", editable: false }
                    // }
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
            columns: columns_dtl,
            // columns: [
               // {field: "stock_no",title: "Stock No.",width: 132, editor: stock_no_DDE},
               // {field: "item_code",title: "Item Code", width: 132, editor: item_code_DDE},
               // {field: "commodity_code",title: "Commodity Code", width: 132},
               // {field: "mat_desc",title: "Mat. Desc.", width: 327},
               // {field: "support_no",title: "Supp. No.", width: 88},
               // {field: "uom",title: "UOM", width: 55},
               // {field: "size",title: "Size", width: 51},
               // {field: "req_qty",title: "Request Qty.", width: 105},
               // {field: "iss_qty",title: "Issued Qty.", width: 105},
               // {field: "mat_util",title: "Material Utilization", width: 189, editor: mat_util_DDE},
               // {field: "measurement",title: "Measurement", width: 112},
               // {field: "plant_no",title: "Plant No.", width: 81},
               // {field: "area_no",title: "Area No.", width: 81},
               // {field: "drawing_no",title: "Drawing No.", width: 123},
               // {field: "sheet_no",title: "Sheet No.", width: 85},
               // {field: "rev_no",title: "Rev. No.", width: 81},
               // {field: "spool_no",title: "Spool No.", width: 85},
               // {field: "testpack_no",title: "Testpack No.", width: 105},
               // {field: "system_no",title: "System", width: 72},
               // {field: "sub_system",title: "Sub System", width: 100},
               // {field: "activity_code",title: "Activity Code", width: 107},
               // {field: "direct_with",title: "DW", width: 50},
               // {field: "lisoreqd",title: "ISO Reqd.", width: 89},
               // {field: "spl_type",title: "Spool Type", width: 96, editor: spl_type_DDE},
               // {field: "mat_status",title: "Material Req. Status", width: 154}
           // ],
           change: function(e){
			    if (!$("#saveButt").is(":hidden"))
			    	return true;
			    	
           		currRow2 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    // if ($("#saveButt").is(":hidden"))
		        	// $("#editButt2, #delButt2").prop("disabled", false).removeClass("k-state-disabled");
	        	$("#delButt").prop("disabled", true).addClass("k-state-disabled");
	        	$("#viewButt").prop("disabled", false).removeClass("k-state-disabled");
			    for (var i = 0; i < selectedRows.length; i++) {
			        jmifdtl_di = this.dataItem(selectedRows[i]);
			        // if ((dataItem.finalized == 0 || dataItem.finalized == null) && $("#saveButt").is(":hidden"))
			        	// $("#editButt2, #delButt2, #jmifButt").prop("disabled", false).removeClass("k-state-disabled");
			    }
			    $.each(jmifdtl_ds.data(),function(index,value){
			    	if (value.iss_qty > 0 && dataItem.finalized == 1){
	        			$("#finButt").prop("disabled", true).addClass("k-state-disabled");
	        			return true;
	        		}else
	        			$("#finButt").prop("disabled", false).removeClass("k-state-disabled");
			    });
           },
           dataBound: addExtraStylingToGrid2
        });
		$("#jmifdtl_rs .k-grid-toolbar").hide();
        insertGridTitle('#jmifdtl_rs','JMIF Detail');
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
	    				
						dataRow = $("#jmifdtl_rs").data("kendoGrid").dataSource.getByUid(jmifdtl_di.uid);
    					$("#jmifdtl_rs").data("kendoGrid").dataSource.remove(dataRow);
						jmifdtl_ds.sync();
						$("#jmifdtl_rs").data("kendoGrid").setDataSource(jmifdtl_ds);
						$("#jmifdtl_rs").data("kendoGrid").dataSource.page($("#jmifdtl_rs").data("kendoGrid").dataSource.page());
						$("#jmifdtl_rs").data("kendoGrid").dataSource.read();
	    				return true;
	    			break;
	    			case "finButt":
	    				if (!confirm("Do you want to finalize this transaction?"))
	    					return true;
	    					
	    				$.post(crudService + "manage/treq_fin",{PROGRESS_RECID: dataItem.PROGRESS_RECID, finalized: ($(this).text() == "Finalize") ? 1 : 0, log_user: $("#hidden_user").val(), jmif_no: dataItem.jmif_no, disc_code: disc_code, whse_prep: 0},
	    					function(data){
	    						if ($.trim(data) != 1)				
									showNotif('Warning',data,'warning');
								dataSource.page(dataSource.page());
								dataSource.read();
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
									    	jmifdtl_ds.page(1);
									    	jmifdtl_ds.read();
									    }
									});
									$("#window").data("kendoWindow").refresh({
										url: "/codeIgniter/index.php/webapps/qms/index/index/qmsteng",
										type: "POST",
										data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val(), jmif_no: dataItem.jmif_no, disc_code: disc_code, }
									});
						        	$("#window").data("kendoWindow").center().open();									
								}
							});
	    			break;
	    			case "uplButt":
						$("#window").data("kendoWindow").setOptions({
						    title: "Upload Bulk Request",
						    width: "991px",
						    height: "auto",
						    close: function(){
						    	dataSource.read();
						    }
						});
						$("#window").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/webapps/qms/index/index/pipUReq",
							type: "POST",
							data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
						});
			        	$("#window").data("kendoWindow").center().open();
	    			break;
	    			case "viewButt":
						showDetails("template","JMIF Details",merge(dataItem,jmifdtl_di));
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
		    				if (!confirm("Are you sure you want to save this data?"))
		    					return true;
	
		    				$("#jmifdtl_rs .k-grid-toolbar .k-grid-save-changes").trigger( "click" );
	    				}else
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
	    			break;
	    			default:
	    				if (this.id.indexOf("2") < 0){
			    			if (this.id == "addButt"){
			    				$("#rowSelection").data("kendoGrid").addRow();
								$.get(crudService + "directCall/rcontrol", {trancode: "jmif", disc_code: disc_code},
									function(data){
										$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).html(data.rows[0].pono);
										$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(1).find("input").focus();
									});
			    			} else
			    				$("#rowSelection").data("kendoGrid").editRow($("#rowSelection").data("kendoGrid").select());
		    				
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
			    			if (this.id == "addButt2") {
			    				$("#jmifdtl_rs").data("kendoGrid").addRow();
			    				switch(disc_code.toLowerCase()){
			    					case "cvl":
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).html(jmifdtl_di.stock_no);
			    					break;
			    					default:
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(1).html(jmifdtl_di.item_code);
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(10).html(jmifdtl_di.support_no);
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(20).html(jmifdtl_di.activity_code);
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(9).html(jmifdtl_di.measurement);
			    					break;
			    				}
			    			}else {
			    				$("#jmifdtl_rs").data("kendoGrid").editRow($("#jmifdtl_rs").data("kendoGrid").select());
			    				switch(disc_code.toLowerCase()){
			    					case "cvl":
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).html(jmifdtl_di.stock_no);
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(1).html(jmifdtl_di.item_code);
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(2).html(jmifdtl_di.commodity_code);
			    					break;
			    					default:
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).html(jmifdtl_di.stock_no);
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(2).html(jmifdtl_di.commodity_code);
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(4).html(jmifdtl_di.uom);
										// $("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(5).html(jmifdtl_di.size);
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(11).html(jmifdtl_di.plant_no);
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(12).html(jmifdtl_di.area_no);
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(13).html(jmifdtl_di.drawing_no);
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(14).html(jmifdtl_di.sheet_no);
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(15).html(jmifdtl_di.rev_no);
										$("#jmifdtl_rs > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(16).html(jmifdtl_di.spool_no);
			    					break;
			    				}
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
						forDiv((this.id.indexOf("2") < 0) ? "jmifdtl_rs" : "rowSelection");
	    			break;
	    		}
	    	}
	    });
	});
</script>