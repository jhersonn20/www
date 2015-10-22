<style>
	#win_main-wrapper {
		margin-top: 0;
		padding: 0;
	}
	.k-upload-files {
		width: 630px;
	}
	.buttonLeft {
		width: 50%;
	}
</style>
<div id="win_main-wrapper" style="width: 100%;">
	<div class="wrap-header demo-section">
		<fieldset>
			<legend> Filter Option: </legend>
			<div style="float: left;">
				<label><input type="radio" name="win_option1" id="win_option1" checked /> All </label>
				<label><input type="radio" name="win_option1" id="win_option2" /> JMIF No. </label>
				<label><input type="radio" name="win_option1" id="win_option3" /> Stock No. </label>
				<label><input type="radio" name="win_option1" id="win_option4" /> Item Code </label>
				<label><input type="radio" name="win_option1" id="win_option5" /> Size </label>
			</div>
            <span class="k-textbox k-space-right">
                <input type="text" value="" name="win_win_search" id="win_search" />
                <a href="#" class="k-icon k-i-search">&nbsp;</a>
            </span>
			
		</fieldset>
	</div>
	<div class="jmif_phase" style="width: 100%;">
		<div id="jmifHead" style="min-height: 260px;margin-bottom: 5px;">
		    <div class="wrap-grid demo-section" style="width: 98.8%;margin-left: 0;height: auto;">
		        <div id="treqDtl_rs"></div>
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
	<div class="jmifdtl_phase" style="margin-top: 5px !important;">
		<div id="jmifDtlHead" style="min-height: 290px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 27.9%;float:right;height: auto;display: block;">
				<fieldset>
					<legend> JMIF Detail Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="win_txt1" style="width: 105px;">Stock No.:</label><input type="text" name="win_txt1" id="win_txt1" required style="width: 148px;" />
						</li>
						<li>
							<label class="title" for="win_txt2" style="width: 105px;">Item Code:</label><input type="text" name="win_txt2" id="win_txt2" class="k-textbox" style="width: 148px;" />
						</li>
						<li>
							<label class="title" for="win_txt3" style="width: 105px;">Comm. Code:</label><input type="text" name="win_txt3" id="win_txt3" class="k-textbox" style="width: 148px;" />
						</li>
						<li>
							<label class="title" for="win_textarea" style="width: 105px;">Stock Desc.:</label><textarea name="win_textarea" id="win_textarea" cols="20" rows="3" style="resize: none;width: 135px;margin: 0;"></textarea>
						</li>
						<li>
							<label class="title" for="win_txt4" style="width: 105px;">Unit of Measure:</label><input type="text" name="win_txt4" id="win_txt4" class="k-textbox" style="width: 53px;" />
							<label class="title short" for="win_txt5" style="width: 40px;">Size:</label><input type="text" name="win_txt5" id="win_txt5" class="k-textbox" style="width: 54px;" />
						</li>
						<li>
							<label class="title" for="win_txt6" style="width: 105px;">JMIF Qty.:</label><input type="text" required name="win_txt6" id="win_txt6" style="width: 148px;"/>
						</li>
						<li>
							<label class="title" for="win_textarea1" style="width: 105px;">Remarks:</label><textarea name="win_textarea1" id="win_textarea1" cols="20" rows="3" style="resize: none;width: 135px;margin: 0;"></textarea>
						</li>
						<li>
							<label class="title" for="win_rad1" style="width: 90px;">Type:</label><input type="radio" name="win_option" checked id="win_rad1" /><label class="title short" for="rad1">Spool</label>
																								<input type="radio" name="win_option" id="win_rad2" /><label class="title short" for="rad2">EM</label>
																								<input type="radio" name="win_option" id="win_rad3" /><label class="title short" for="rad3">Others</label>
						</li>
						<li style="text-align: right;">
							<hr style="margin-bottom: 5px;" />
							<button class="k-button" disabled id="saveButt2">Apply</button>						
						</li>
					</ul>
				</fieldset>
			</div>
		    <div class="wrap-grid demo-section" style="width: 69%;margin-left: 0;height: auto;">
		        <div id="jmifdtl_rs"></div>
		    </div>
		</div>
		<div class="wrap-button demo-section">
			<div class="buttonLeft">
	        	<button class="k-button mainEve k-state-disabled" disabled id="doneButt">Done</button>
	       	</div>
			<!-- <div class="buttonRight">
	        	<button class="k-button mainEve" id="closeButt">Close</button>
	       	</div> -->				
		</div>
	</div>
</div>
<script type="text/javascript">
	function grid_change(e,grid){
		if (typeof e == "undefined")
			e = grid;
	    var selectedRows3 = e.select();
	    var selectedDataItems = [];
	    for (var i = 0; i < selectedRows3.length; i++) {
	      dataItem3 = e.dataItem(selectedRows3[i]);
		    $("#win_txt1").data("kendoComboBox").value(dataItem3.stock_no);
		    $("#win_textarea").val(dataItem3.stock_desc);
		    $("#win_txt2").val(dataItem3.item_code);
		    $("#win_txt3").val(dataItem3.commodity_code);
		    $("#win_txt4").val(dataItem3.uom);
		    $("#win_txt5").val(dataItem3.size);
		    $("#win_txt6").data("kendoNumericTextBox").value(dataItem3.jwrr_qty);
		    $("#win_textarea1").val(dataItem3.remarks);
		    $("#" + ((dataItem3.spl_type.toLowerCase() == "spool") ? "win_rad1" : "win_rad3")).prop("checked", true);
		    if (dataItem3.spl_type.toLowerCase() != "spool")
		    	$("#" + ((dataItem3.spl_type.toLowerCase() == "em") ? "win_rad2" : "win_rad3")).prop("checked", true);
	    }   
	}
	function forDiv(){
		var container = $("#treqDtl_rs");
		var container2 = $("#jmifdtl_rs");
		var position = container.offset();	
		var offsetHeight = container.height();	
		var offsetHeight2 = container2.height();	
		var offsetWidth = container.width();
		var newDiv = $("<div id = 'coverDiv'>").appendTo($("body"));
		newDiv.offset(position);
		newDiv.height((offsetHeight + offsetHeight2) + 87);
		newDiv.width(offsetWidth - 17);
	}
	$(document).ready(function(){
		var crudService = crudServiceBaseUrl + "qms/index/",
			disc_code = pathname.split('/')[pathname.split('/').length - 1],
		    filterFArr_treqDtl = [], filterOArr_treqDtl = [], filterVArr_treqDtl = [], sentValue = "", currRow = "", currRow2 = "", cMode = "", jmif_di = '', jmifdtl_di = '', isFailed = false,
		    filterFArr_jmifdtl = [], filterOArr_jmifdtl = [], filterVArr_jmifdtl = [], sentValue_jmifdtl = "", fieldSort = "", dirSort = "", query = "", down_di = '', up_di = '',
			optionArr = ["","jmif_no","jmif_date","supp_code","pl_dn_inv","po_no","deliv_by"],			
			indexArr = [], jmifdtl_ds = [];
        
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
						// showNotif('Warning',jqXHR.responseText,'warning');
						console.log(jqXHR.responseText);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						// else {
							// // alert("romel");
							// // treqDtl_ds.sync();
							// $("#treqDtl_rs").data("kendoGrid").setDataSource(treqDtl_ds);
							// $("#treqDtl_rs").data("kendoGrid").dataSource.page($("#treqDtl_rs").data("kendoGrid").dataSource.page());
							// $("#treqDtl_rs").data("kendoGrid").dataSource.read();
				    		// if (isFailed)
				    			// return true;
							// $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea, .jmif_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
							// $(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
							// $('input[name=win_option1], input[name=win_option2], #win_search').prop("disabled", false);
							// // jmif_date.enable(false);
							// // supp_code.enable(false);
							// $("#coverDiv").remove();
						// }
	                }
                },
                update: {
                    url: crudService + "manage/tjmif",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						showNotif('Warning',jqXHR.responseText,'warning');
	                	// if (jqXHR.responseText != '1')
							// showNotif('Warning',jqXHR.responseText,'warning');
						// else {
							// alert("romel");
							// // treqDtl_ds.sync();
							// // $("#treqDtl_rs").data("kendoGrid").setDataSource(treqDtl_ds);
							// // $("#treqDtl_rs").data("kendoGrid").dataSource.page($("#treqDtl_rs").data("kendoGrid").dataSource.page());
							// // $("#treqDtl_rs").data("kendoGrid").dataSource.read();
						// }
	                }
                },
                destroy: {
                    url: crudService + "remove/tjmif",
                    type: "POST"
                    // ,
	                // complete: function(jqXHR, textStatus) {
						// showNotif('Warning',jqXHR.responseText,'warning');
	                	// // if (jqXHR.responseText != '1')
							// // showNotif('Warning',jqXHR.responseText,'warning');
						// // else {
							// // alert("romel");
							// // // treqDtl_ds.sync();
							// // // $("#treqDtl_rs").data("kendoGrid").setDataSource(treqDtl_ds);
							// // // $("#treqDtl_rs").data("kendoGrid").dataSource.page($("#treqDtl_rs").data("kendoGrid").dataSource.page());
							// // // $("#treqDtl_rs").data("kendoGrid").dataSource.read();
						// // }
	                // }
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
				    if ($('input[name=win_option1]:checked').index('input[name=win_option1]') > 0)
				     	filterFArr_treqDtl[filterFArr_treqDtl.length] = optionArr[$('input[name=win_option1]:checked').index('input[name=win_option1]')] + ";" + sentValue + ";eq";
				    // if ($('input[name=win_option2]:checked').index('input[name=win_option2]') > 0)
				     	// filterFArr_treqDtl[filterFArr_treqDtl.length] = "finalized;1;" + (($('input[name=win_option2]:checked').index('input[name=win_option2]') == 1) ? "neq" : "eq" );				     
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
					    module: 'jwrr',
					    log_user: $("#hidden_user").val(),
					    drawing_no: '',
					    sheet_no: ''
			        }
			      }else
			      	data['log_user'] = $("#hidden_user").val();
			      	return data;
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
                        jmif_no: { type: "string" },
                        stock_no: { type: "string" },
                        item_code: { type: "string" },
                        commodity_code: { type: "string" },
                        size: { type: "string" },
                        req_qty: { type: "string" }
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
			$("#treqDtl_rs").data("kendoGrid").select("tr:eq(1)");
	        $("#treqDtl_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }
	        );
        	filterFArr_treqDtl = [];
	    };

        var grid = $("#treqDtl_rs").kendoGrid({
            dataSource: treqDtl_ds,
            selectable: "multiple",
            pageable: {
                buttonCount: 3,
    			input: true
            },
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: false,
			// toolbar: ["save","cancel"],
            resizable: true,
            filterable: {
                extra: false
            },
            columns: [
               {field: "jmif_no",title: "JMIF No.",width: 85},
               {field: "stock_no",title: "Stock No.", width: 89},
               {field: "item_code",title: "Item Code", width: 117},
               {field: "commodity_code",title: "Comm. Code", width: 89},
               {field: "size",title: "Size", width: 79},
               {field: "req_qty",title: "Quantity", width: 110}
           ],
           change: function(e){
           		currRow = this;
			    selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        jmif_di = this.dataItem(selectedRows[i]);
			    }
			    $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea, .jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea").val("");
			    // grid_change(currRow,"#treqDtl_rs");
			    // jmifdtl_ds.read();
           },
           dataBound: addExtraStylingToGrid
        });
		// $("#treqDtl_rs .k-grid-toolbar").hide();
        insertGridTitle('#treqDtl_rs','Material Take-Off');
                    
        // var jmifdtl_ds = new kendo.data.DataSource({
            // transport: {
                // read: {
                    // url: crudService + "directCall/tjmifDtl",
                    // contentType: "application/json",
                    // type: "GET"
                // },
                // create: {
                    // url: crudService + "manage/tjmifDtl",
                    // type: "POST",
	                // complete: function(jqXHR, textStatus) {
	                	// console.log(jqXHR);
	                	// if (jqXHR.responseText != '1')
							// showNotif('Warning',jqXHR.responseText,'warning');
	                // }
                // },
                // update: {
                    // url: crudService + "manage/tjmifDtl",
                    // type: "POST",
	                // complete: function(jqXHR, textStatus) {
	                	// console.log(jqXHR);
						// showNotif('Warning',jqXHR.responseText,'warning');
	                	// // if (jqXHR.responseText != '1')
							// // showNotif('Warning',jqXHR.responseText,'warning');
// 
	                // }
                // },
                // destroy: {
                    // url: crudService + "remove/tjmifDtl",
                    // type: "POST"
                // },
			    // parameterMap: function(data, type) {
			      // if (type == "read") {
			      	// if ($(data.filter).length > 0){
				      	// $.each(data.filter.filters,function(index,value){
				      		// var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		// filterFArr_jmifdtl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		// filterOArr_jmifdtl[index] = this.operator;
				      		// filterVArr_jmifdtl[index] = valForm;
				      	// });
				    // }
				    // fieldSort = ($(data.sort).length ? data.sort[0].field : "log_date");
				    // query = filterFArr_jmifdtl;
				    // dirSort = ($(data.sort).length ? data.sort[0].dir : "desc");
			        // return {
			            // page: data.page,
			            // pageSize: data.pageSize,
			            // top: data.take,
			            // skip: data.skip,
					    // fieldF: filterFArr_jmifdtl,
					    // fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    // operator: (($(data.filter).length > 0) ? filterOArr_jmifdtl : "contains"),
					    // value: (($(data.filter).length > 0) ? filterVArr_jmifdtl : sentValue_jmifdtl),
					    // dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    // jmif_no: dataItem.jmif_no
			        // }
			      // }else{
			      	  // data['log_user'] = $("#hidden_user").val();
					  // data['jmif_no'] = dataItem.jmif_no;
			      	  // return data;
			      	 // }
			    // }
            // },
			// requestEnd: function(e) {
			    // var response = e.response;
			    // var type = e.type;
			    // // console.log(type);
			    // // console.log(response);
			// },
            // pageSize: 6,
            // serverPaging: true,
			// serverFiltering: true,
			// serverSorting: true,
            // schema: {
                // data: function(data) {
                    // return data.rows || [];
                // },
                // errors: function(data){
               	    // if (filterFArr_jmifdtl.length > 0 && $(data.rows).length == 0){
               		    // notif("info","Information","No records found!");
					    // sentValue_jmifdtl = "";
					    // filterFArr_jmifdtl = [];
					    // $("form.k-filter-menu button[type='reset']").trigger("click");
               	    // }
                // },
                // model: {
               		// id: "PROGRESS_RECID",
                    // fields: {
                   	    // PROGRESS_RECID: { type: "number", editable: false },
                        // stock_no: { type: "string" },
                        // stock_desc: { type: "string" },
                        // uom: { type: "string" },
                        // jmif_qty: { type: "number" },
                        // remarks: { type: "string" }
                    // }
                // },
                // total: function(response) {
				   	// return (($(response.rows[0]).length > 0) ? response.rows[0].total : 0); //$(response.rows).length;				   	
			    // }
            // },
            // change: function(e) {
            	// if ($(e.items).length == 0)
            		// return true;
            // }
        // });
        
        var jmifdtl_ds2 = new kendo.data.DataSource({
            data: jmifdtl_ds,
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
                        jmif_no: { type: "string" },
                        stock_no: { type: "string" },
                        item_code: { type: "string" },
                        commodity_code: { type: "string" },
                        size: { type: "string" },
                        req_qty: { type: "string" }
                    }
                },
                total: function(response) {
				   	return parseInt(($(response).length > 0) ? $(response).length : 0);
			    }
            }
        });
                                
	    var addExtraStylingToGrid2 = function () {
			$("#jmifdtl_rs").data("kendoGrid").select("tr:eq(" + (treqDtl_ds._data.length + 2) + ")");
	        $("#jmifdtl_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_jmifdtl = [];
	    };
        
        var grid2 = $("#jmifdtl_rs").kendoGrid({
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
            editable: false,
            resizable: true,
            filterable: false,
            columns: [
               {field: "jmif_no",title: "JMIF No.",width: 85},
               {field: "stock_no",title: "Stock No.", width: 89},
               {field: "item_code",title: "Item Code", width: 117},
               {field: "commodity_code",title: "Comm. Code", width: 89},
               {field: "size",title: "Size", width: 79},
               {field: "req_qty",title: "Quantity", width: 110}
           ],
           change: function(e){
           		currRow2 = this;
			    selectedRows2 = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows2.length; i++) {
			        jmifdtl_di = this.dataItem(selectedRows2[i]);
			        
			        // $("#editButt2, #delButt2").prop("disabled", false).removeClass("k-state-disabled");
			        // if (dataItem.finalized == 0 || dataItem.finalized == null)
			        	// $("#editButt2, #delButt2").prop("disabled", false).removeClass("k-state-disabled");
			    }
			    grid_change(currRow2,"#jmifdtl_rs");
           },
           dataBound: addExtraStylingToGrid2
        });
        insertGridTitle('#jmifdtl_rs','Material Request');        	    	            
	    $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		// $("#txt2").removeClass('k-state-disabled').kendoDatePicker({
			// format: "MM/dd/yyyy",
			// enable: false
		// });
		$("#win_txt6").removeClass('k-state-disabled').kendoNumericTextBox({
			format: "n",
			enable: false
		});
		// $("#txt3").removeClass('k-state-disabled').kendoComboBox({
			// enable: false,
            // filter: "contains",
            // placeholder: "Select supplier...",
            // dataTextField: "supp_code",
            // dataValueField: "supp_desc",
			// autoBind: true,
            // dataSource: {
                // transport: {
                    // read: crudService + "directCall/supplier",
            		// contentType: "application/json"
                // },
                // schema: {
					// data: function(data){
	                    // return data.rows || [];
					// }	                    	
                // }
            // },
            // change: function(e){
				// if (this.selectedIndex < 0){
            		// $(".k-input").eq(3).val("").select().focus();
            		// $("#textarea").val("");
				// }else
            		// $("#textarea").val(this.value());
            // }
		// });
		$("#win_txt1").removeClass('k-state-disabled').kendoComboBox({
			enable: false,
            filter: "contains",
            placeholder: "Select material...",
            dataTextField: "stock_no",
            dataValueField: "stock_desc",
			autoBind: true,
            dataSource: {
                transport: {
                    read: crudService + "directCall/item",
            		contentType: "application/json"
                },
                schema: {
					data: function(data){
	                    return data.rows || [];
					}	                    	
                }
            },
            change: function(e){
				if (this.selectedIndex < 0){
            		$(".k-input").eq(3).val("").select().focus();
            		$("#win_textarea").val("");
				}else{
            		$("#win_textarea").val(this.value().split(",")[0]);
            		$("#win_txt4").val(this.value().split(",")[1]);
            		$("#win_txt5").val(this.value().split(",")[2]);
            	}
            }
		});
		// var jmif_date = $("#txt2").data("kendoDatePicker");
		var jmif_qty = $("#win_txt6").data("kendoNumericTextBox");
		// var supp_code = $("#txt3").data("kendoComboBox");
		var stock_no = $("#win_txt1").data("kendoComboBox");
		
		$(".jmif_phase .wrap-button button").bind({
        	click: function(e){
        		switch(this.id){
        			case "downButt":
						for (var i = 0; i < selectedRows.length; i++) {
				        	down_di = currRow.dataItem(selectedRows[i]);
				        	down_di['jwrr_qty'] = down_di.req_qty;
				        	down_di['remarks'] = '';
		
							jmifdtl_ds.push(down_di);
							indexArr.push(down_di);
					        $.post(crudService + "remove/tjmif",{PROGRESS_RECID: down_di.PROGRESS_RECID},
					       	    function(data){
									treqDtl_ds.sync();
									$("#treqDtl_rs").data("kendoGrid").setDataSource(treqDtl_ds);
									$("#treqDtl_rs").data("kendoGrid").dataSource.page($("#treqDtl_rs").data("kendoGrid").dataSource.page());
									$("#treqDtl_rs").data("kendoGrid").dataSource.read();
					       	    });
						}
						jmifdtl_ds2.sync();
						$("#jmifdtl_rs").data("kendoGrid").dataSource.data(jmifdtl_ds);
						$("#jmifdtl_rs").data("kendoGrid").dataSource.page($("#jmifdtl_rs").data("kendoGrid").dataSource.page());
						$("#jmifdtl_rs").data("kendoGrid").dataSource.read();
						
						jmif_qty.enable(true);
						$("#win_textarea1").prop("disabled", false).removeClass("k-state-disabled");
						$(".jmifdtl_phase .wrap-form button, .wrap-button .buttonLeft button").prop("disabled", false).removeClass("k-state-disabled");
        			break;
        			default:
        				var uidArr = [];
						for (var i = 0; i < selectedRows2.length; i++) {
				        	up_di = currRow2.dataItem(selectedRows2[i]);
				        	uidArr.push(up_di.uid);
				        }
						var ds_total = selectedRows2.length;
						$.each(jmifdtl_ds2.data(),function(index,value){
							var row = [];
							if ($.inArray(value.uid,uidArr) < 0)
								return;
							$.each(value,function(index2,value2){
								if (typeof value2 == "object")
									return;
	
								row[index2] = value2;
							});
							row['PROGRESS_RECID'] = 0;
							postInfo = JSON.stringify(row);
							postInfo = eval("(" + postInfo + ")");

							treqDtl_ds.add(postInfo);
	    					var removeThis;
	    					$.each(jmifdtl_ds, function(index3, value3){
	    						if (value3.uid == value.uid){
	    							removeThis = index3;
	    							return;
	    						}
	    					});
	    					jmifdtl_ds.splice(removeThis,1);
						});
						treqDtl_ds.sync();
						$("#treqDtl_rs").data("kendoGrid").setDataSource(treqDtl_ds);
						$("#treqDtl_rs").data("kendoGrid").dataSource.page($("#treqDtl_rs").data("kendoGrid").dataSource.page());
						$("#treqDtl_rs").data("kendoGrid").dataSource.read();

						jmifdtl_ds2.read();
        			break;
        		}
        	}
        });
        
	    $(".jmifdtl_phase .wrap-button .buttonLeft button").bind({
	    	click: function(e){
	    		$.post(crudService + "manage/setTJWRR",{jsonData: JSON.stringify({item: jmifdtl_ds2.data()}), jwrr_no: $("#txt1").val(), disc_code: disc_code, jmif_no: $("#textarea1").val(), log_user: $("#hidden_user").val()},
		    		function(data){
		    			if ($.trim(data) != "1")
		    				showNotif("Information",data,"info");
		    			else
		    				$("#window").data("kendoWindow").close();
		    		});
	    		// switch(this.id){
	    			// case "delButt":
	    				// if (!confirm("Do you really want to delete this item?")){
	    					// e.preventDefault();	    					
	    					// return true;
	    				// }
// 	    				
						// dataRow = grid.data("kendoGrid").dataSource.getByUid(dataItem.uid);
    					// $("#treqDtl_rs").data("kendoGrid").dataSource.remove(dataRow);
						// treqDtl_ds.sync();
						// $("#treqDtl_rs").data("kendoGrid").setDataSource(treqDtl_ds);
						// $("#treqDtl_rs").data("kendoGrid").dataSource.page($("#treqDtl_rs").data("kendoGrid").dataSource.page());
						// $("#treqDtl_rs").data("kendoGrid").dataSource.read();
	    				// return true;
	    			// break;
	    			// case "delButt2":
	    				// if (!confirm("Do you really want to delete this item?")){
	    					// e.preventDefault();
	    					// return true;
	    				// }
// 	    				
						// dataRow = grid2.data("kendoGrid").dataSource.getByUid(jmifdtl_di.uid);
    					// $("#jmifdtl_rs").data("kendoGrid").dataSource.remove(dataRow);
						// jmifdtl_ds.sync();
						// $("#jmifdtl_rs").data("kendoGrid").setDataSource(jmifdtl_ds);
						// $("#jmifdtl_rs").data("kendoGrid").dataSource.page($("#jmifdtl_rs").data("kendoGrid").dataSource.page());
						// $("#jmifdtl_rs").data("kendoGrid").dataSource.read();
	    				// return true;
	    			// break;
	    			// case "finButt":
	    				// if (!confirm("Do you want to finalize this transaction?"))
	    					// return true;
// 	    					
	    				// $.post(crudService + "manage/tjmif_fin",{PROGRESS_RECID: dataItem.PROGRESS_RECID, finalized: ($(this).text() == "Finalize") ? 1 : 0, log_user: $("#hidden_user").val()},
	    					// function(data){	    		
	    						// if ($.trim(data) != 1)				
									// showNotif('Warning',data,'warning');
								// $("#treqDtl_rs").data("kendoGrid").setDataSource(treqDtl_ds);
								// $("#treqDtl_rs").data("kendoGrid").dataSource.page($("#treqDtl_rs").data("kendoGrid").dataSource.page());
								// $("#treqDtl_rs").data("kendoGrid").dataSource.read();
	    					// });
	    			// break;
	    			// default:
	    				// if (this.id.indexOf("2") < 0){
							// $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea, .jmif_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							// jmif_date.enable(true);
							// supp_code.enable(true);
			    			// if (this.id == "addButt"){
			    				// isFailed = false;
								// $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea").val("");
								// $(".jmif_phase .wrap-form input").eq(1).select().focus();
								// $('input[name=win_option1], input[name=win_option2], #win_search').prop("disabled", true);
								// // $('input[name=win_option2]').prop("disabled", true);
								// $.get(crudService + "directCall/rcontrol", {trancode: "jmif"},
									// function(data){
										// // $("#txt1").prop("disabled", true).addClass("k-state-disabled").val(data.rows[0].prefix + (($.trim(data.rows[0].prefix) == "") ? "" : "-") + kendo.toString(data.rows[0].control_no,"99999") + (($.trim(data.rows[0].suffix) == "") ? "" : "-") + data.rows[0].suffix);
										// $("#txt1").prop("disabled", true).addClass("k-state-disabled").val(data.rows[0].pono);
										// $("#textarea").prop("disabled", true).addClass("k-state-disabled");
										// // valueArr = [data.rows[0].pono, "12/20/2013", "12/19/2013", "12/18/2013", "ship_1", "vessel_1", "ship_inv_1", "", "", "port_1", "remarks_1"];
										// // $.each(valueArr,function(index, value){
											// // // $(this).val(valueArr[index]);
											// // $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea").eq(index).prop("value", value);
										// // });
										// cMode = "add";
									// });
			    			// }else {
								// $("#txt1").prop("disabled", true).addClass("k-state-disabled");
								// $("#textarea").prop("disabled", true).addClass("k-state-disabled");
								// $(".jmif_phase .wrap-form input").eq(1).select().focus();
								// cMode = "edit";
							// }
						// }else {
							// if (dataItem.length == 0)
								// return true;
							// $(".jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea, .jmifdtl_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							// po_qty.enable(true);
							// stock_no.enable(true);
			    			// if (this.id == "addButt2"){
								// stock_no.enable(true);
			    				// isFailed = false;
								// $(".jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea").val("");
								// $(".jmifdtl_phase .wrap-form input").eq(0).select().focus();
								// $('input[name=win_option1], input[name=win_option2], #win_search').prop("disabled", true);
								// $("#textarea2, #txt8, #txt9, #txt10, #txt11").prop("disabled", true).addClass("k-state-disabled");
								// cMode = "add";
			    			// }else {
								// $(".jmifdtl_phase .wrap-form textarea").select().focus();
								// $("#textarea2, #txt8, #txt9, #txt10, #txt11").prop("disabled", true).addClass("k-state-disabled");
								// cMode = "edit";
							// }
						// }
						// $(".wrap-button button").prop("disabled", true).addClass("k-state-disabled");
						// forDiv();
	    			// break;
	    		// }
	    	}
	    });
	    // $(".jmif_phase .wrap-form button").bind({
	    	// click: function(e){
				// $(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
	    		// switch(this.id){
	    			// case "saveButt":
	    				// if (!confirm("Are you sure you want to save this data?")){
	    					// e.preventDefault();
	    					// return true;
	    				// }
// 	    				
	    				// isFailed = verifyThisInput(".jmif_phase");
			    		// if (isFailed)
			    			// return true;
// 	    				
						// if (cMode == "add"){
							// treqDtl_ds.add({PROGRESS_RECID: 0,
											// jmif_no: $("#txt1").val(),
											// jmif_date: kendo.toString(jmif_date.value(),"yyyy-MM-dd"),
											// supp_code: supp_code.value(),
											// supp_desc: $("#textarea").val(),
											// pl_dn_inv: $("#txt4").val(),
											// po_no: $("#txt5").val(),
											// deliv_by: $("#txt6").val(),
											// remarks: $("#textarea1").val()});
							// treqDtl_ds.sync();
							// return true;
							// // $("#treqDtl_rs").data("kendoGrid").setDataSource(treqDtl_ds);
							// // $("#treqDtl_rs").data("kendoGrid").dataSource.page($("#treqDtl_rs").data("kendoGrid").dataSource.page());
							// // $("#treqDtl_rs").data("kendoGrid").dataSource.read();
						// }else
					        // $.post(crudService + "manage/tjmif",{PROGRESS_RECID: dataItem.PROGRESS_RECID, jmif_no: $("#txt1").val(), jmif_date: kendo.toString(jmif_date.value(),"yyyy-MM-dd"), supp_code: supp_code.value(), supp_desc: $("#textarea").val(), pl_dn_inv: $("#txt4").val(), po_no: $("#txt5").val(), deliv_by: $("#txt6").val(), remarks: $("#textarea1").val()},
					       	    // function(data){
									// $("#treqDtl_rs").data("kendoGrid").setDataSource(treqDtl_ds);
									// $("#treqDtl_rs").data("kendoGrid").dataSource.page($("#treqDtl_rs").data("kendoGrid").dataSource.page());
									// $("#treqDtl_rs").data("kendoGrid").dataSource.read();
					       	    // });
	    			// break;
	    			// default:
	    				// $(".thisIsRequired").removeClass('thisIsRequired');
		    			// isFailed = false;
			    		// grid_change(currRow,"#treqDtl_rs");
	    			// break;
	    		// }
	    		// if (isFailed)
	    			// return true;
				// $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea, .jmif_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		        // $("#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
				// $('input[name=win_option1], input[name=win_option2], #win_search').prop("disabled", false);
				// jmif_date.enable(false);
				// supp_code.enable(false);
				// $("#coverDiv").remove();
	    	// }
	    // });
	    $(".jmifdtl_phase .wrap-form button").bind({
	    	click: function(e){
				$.each(jmifdtl_ds, function(index3, value3){
					if (value3.uid == jmifdtl_di.uid){				
						// var data = $("#treqDtl_rs").data("kendoGrid").dataSource.at(index3);
						// data.set("name", "John Doe");
			        	value3.jwrr_qty = jmif_qty.value();
			        	value3.remarks = $("#win_textarea1").val();
						jmifdtl_ds2.read();
						showNotif("Information","Record successfully updated.","info")
						return;
					}
				});
				// $(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
	    		// switch(this.id){
	    			// case "saveButt2":
	    				// if (!confirm("Are you sure you want to save this data?")){
	    					// e.preventDefault();
	    					// return true;
	    				// }
// 	    				
	    				// isFailed = verifyThisInput(".jmifdtl_phase");
			    		// if (isFailed)
			    			// return true;
// 	    				
						// if (cMode == "add"){
							// jmifdtl_ds.add({PROGRESS_RECID: 0,
											// stock_no: stock_no.value(),
											// stock_desc: $("#textarea2").val(),
											// item_code: $("#txt8").val(),
											// commodity_code: $("#txt9").val(),
											// uom: $("#txt10").val(),
											// size: $("#txt11").val(),
											// jmif_qty: po_qty.value(),
											// spl_type: ($("#rad3").is(":checked") ? "" : ($("#rad1").is(":checked") ? "spool" : "em")),
											// remarks: $("#textarea3").val()});
							// jmifdtl_ds.sync();
							// $("#jmifdtl_rs").data("kendoGrid").setDataSource(jmifdtl_ds);
							// $("#jmifdtl_rs").data("kendoGrid").dataSource.page($("#jmifdtl_rs").data("kendoGrid").dataSource.page());
							// $("#jmifdtl_rs").data("kendoGrid").dataSource.read();
						// }else
					        // $.post(crudService + "manage/tjmifDtl",{PROGRESS_RECID: jmifdtl_di.PROGRESS_RECID, stock_no: stock_no.value(), stock_desc: $("#textarea2").val(), item_code: $("#txt8").val(), commodity_code: $("#txt9").val(), uom: $("#txt10").val(), size: $("#txt11").val(), jmif_qty: po_qty.value(), spl_type: ($("#rad3").is(":checked") ? "" : ($("#rad1").is(":checked") ? "spool" : "em")), remarks: $("#textarea3").val()},
					       	    // function(data){
									// $("#jmifdtl_rs").data("kendoGrid").setDataSource(jmifdtl_ds);
									// $("#jmifdtl_rs").data("kendoGrid").dataSource.page($("#jmifdtl_rs").data("kendoGrid").dataSource.page());
									// $("#jmifdtl_rs").data("kendoGrid").dataSource.read();
					       	    // });
	    			// break;
	    			// default:
	    				// $(".thisIsRequired").removeClass('thisIsRequired');
		    			// isFailed = false;
			    		// grid_change(currRow2,"#jmifdtl_rs");
	    			// break;
	    		// }
	    		// if (isFailed)
	    			// return true;
				// $(".jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea, .jmifdtl_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		        // $("#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
				// $('input[name=win_option1], input[name=win_option2], #win_search').prop("disabled", false);
				// stock_no.enable(false);
				// po_qty.enable(false);
				// $("#coverDiv").remove();
	    	}
	    });
		// $(".wrap-header input[name=win_option2]").bind({
			// click: function(e){
				// sentValue = ($('input[name=win_option2]:checked').index('input[name=win_option2]') == 2) ? 1 : ($('input[name=win_option2]:checked').index('input[name=win_option2]') == 1) ? 0 : "";
				// $("#treqDtl_rs").data("kendoGrid").dataSource.read();
			// }
		// });
		// $(".wrap-header input[name=win_option1]").bind({
			// click: function(e){
				// switch(this.id){
					// case "option1":
						// if ($("#win_search").val() != ""){
							// $("#win_search").val("").select().focus();
							// sentValue = "";
							// grid.data("kendoGrid").dataSource.page(1);
							// grid.data("kendoGrid").dataSource.read();
						// }
					// break;
					// default:
						// $("#win_search").select().focus();
					// break;
				// }
			// }
		// });
		// $(".k-i-search").click(function(e){
			// e.preventDefault();
// 			
			// sentValue = $("#win_search").val();
			// grid.data("kendoGrid").dataSource.page(1);
			// grid.data("kendoGrid").dataSource.read();
		// });
		// $("#win_search").bind({
			// keyup: function(e){
				// if (e.keyCode == 13){
					// sentValue = this.value;
					// grid.data("kendoGrid").dataSource.page(1);
					// grid.data("kendoGrid").dataSource.read();
				// }
			// }
		// });
		// $("#jmifHead").css({"min-height": ((parseInt($("#jmifHead .wrap-form").height()) + 12) + "px")});
		$("#jmifDtlHead").css({"min-height": ((parseInt($("#jmifDtlHead .wrap-form").height()) + 12) + "px")});
	});
</script>