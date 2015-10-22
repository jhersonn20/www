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
				<label><input type="radio" name="win_option1" id="win_option3" /> Spool No. </label>
				<label><input type="radio" name="win_option1" id="win_option4" /> Spool Type </label>
				<label><input type="radio" name="win_option1" id="win_option5" /> Item Code </label>
				<label><input type="radio" name="win_option1" id="win_option6" /> Comm. Code </label>
			</div>
            <span class="k-textbox k-space-right">
                <input type="text" value="" name="win_win_search" id="win_search" />
                <a href="#" class="k-icon k-i-search">&nbsp;</a>
            </span>
			
		</fieldset>
	</div>
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
		<div id="tempSHead" style="min-height: 290px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 27.9%;float:right;height: auto;display: block;">
				<fieldset>
					<legend> JMIF Detail Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title short" for="win_chk1" style="float: none !important;margin-left: 20px;"><input type="checkbox" name="win_chk1" id="win_chk1" /> Direct Withdraw</label>
						</li>
						<li>
							<label class="title" for="win_txt1" style="width: 112px;">Item Code:</label><input type="text" name="win_txt1" id="win_txt1" class="k-textbox k-state-disabled" disabled style="width: 138px;" />
						</li>
						<li>
							<label class="title" for="win_txt2" style="width: 112px;">Comm. Code:</label><input type="text" name="win_txt2" id="win_txt2" class="k-textbox k-state-disabled" disabled style="width: 138px;" />
						</li>
						<li>
							<label class="title" for="win_textarea" style="width: 112px;">Mat. Desc.:</label><textarea name="win_textarea" id="win_textarea" cols="20" rows="3" style="resize: none;width: 126px;margin: 0;"></textarea>
						</li>
						<li>
							<label class="title" for="win_txt3" style="width: 112px;">Unit of Measure:</label><input type="text" name="win_txt3" id="win_txt3" class="k-textbox k-state-disabled" disabled style="width: 50px;" />
							<label class="title short" for="win_txt4" style="width: 40px;">Size:</label><input type="text" name="win_txt4" id="win_txt4" class="k-textbox k-state-disabled" disabled style="width: 49px;" />
						</li>
						<li>
							<label class="title" for="win_txt5" style="width: 112px;">Activity Code:</label><input type="text" name="win_txt5" id="win_txt5" class="k-textbox" style="width: 138px;" />
						</li>
						<li>
							<label class="title" for="win_txt6" style="width: 112px;">Mat. Util.:</label><input type="text" required name="win_txt6" required id="win_txt6" style="width: 138px;"/>
						</li>
						<li>
							<label class="title" for="win_txt7" style="width: 112px;">Measurement:</label><input type="text" name="win_txt7" id="win_txt7" style="width: 138px;"/>
						</li>
						<li>
							<label class="title" for="win_txt8" style="width: 112px;">Requested Qty.:</label><input type="text" required name="win_txt8" id="win_txt8" style="width: 138px;"/>
						</li>
						<li>
							<label class="title" for="win_txt9" style="width: 112px;">Plant No.:</label><input type="text" name="win_txt9" id="win_txt9" class="k-textbox k-state-disabled" disabled style="width: 40px;" />
							<label class="title short" for="win_txt10" style="width: 40px;">Area No.:</label><input type="text" name="win_txt10" id="win_txt10" class="k-textbox k-state-disabled" disabled style="width: 31px;" />
						</li>
						<li>
							<label class="title" for="win_textarea2" style="width: 112px;">Drawing No.:</label><textarea name="win_textarea2" required id="win_textarea2" cols="20" rows="3" class="k-state-disabled" disabled style="resize: none;width: 126px;margin: 0;"></textarea>
						</li>
						<li>
							<label class="title" for="win_txt11" style="width: 112px;">Sheet No.:</label><input type="text" name="win_txt11" id="win_txt11" class="k-textbox k-state-disabled" disabled style="width: 37px;" />
							<label class="title short" for="win_txt12" style="width: 40px;">Rev. No.:</label><input type="text" name="win_txt12" id="win_txt12" class="k-textbox k-state-disabled" disabled style="width: 36px;" />
						</li>
						<li>
							<label class="title" for="win_txt13" style="width: 112px;">Spool No.:</label><input type="text" class="k-textbox k-state-disabled" disabled name="win_txt13" id="win_txt13" style="width: 138px;"/>
						</li>
						<li>
							<label class="title" for="win_txt14" style="width: 112px;">System:</label><input type="text" name="win_txt14" id="win_txt14" class="k-textbox" style="width: 49px;" />
							<label class="title short" for="win_txt15" style="width: 40px;">Sub.:</label><input type="text" name="win_txt15" id="win_txt15" class="k-textbox" style="width: 48px;" />
						</li>
						<li>
							<label class="title" for="win_txt16" style="width: 112px;">Testpack No.:</label><input type="text" name="win_txt16" id="win_txt16" class="k-textbox k-state-disabled" disabled style="width: 138px;"/>
						</li>
						<li style="text-align: right;">
							<hr style="margin-bottom: 5px;" />
							<button class="k-button" disabled id="saveButt2">Apply</button>						
						</li>
					</ul>
				</fieldset>
			</div>
		    <div class="wrap-grid demo-section" style="width: 69%;margin-left: 0;height: auto;">
		        <div id="tempS_rs"></div>
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
		    $("#win_chk1").prop("checked", (dataItem3.direct_with == 1));
		    $("#win_txt1").val(dataItem3.item_code);
		    $("#win_txt2").val(dataItem3.commodity_code);
		    $("#win_textarea").val(dataItem3.mat_desc);
		    $("#win_txt3").val(dataItem3.uom);
		    $("#win_txt4").val(dataItem3.size);
		    $("#win_txt5").val(dataItem3.activity_code);
		    $("#win_txt6").data("kendoComboBox").value((dataItem3.mat_util == null) ? '' : dataItem3.mat_util);
		    $("#win_txt7").data("kendoNumericTextBox").value((dataItem3.measurement == null) ? 0 : dataItem3.measurement);
		    $("#win_txt8").data("kendoNumericTextBox").value((dataItem3.req_qty == null) ? 0 : dataItem3.req_qty);
		    $("#win_txt9").val(dataItem3.plant_no);
		    $("#win_txt10").val(dataItem3.area_no);
		    $("#win_textarea2").val(dataItem3.drawing_no);
		    $("#win_txt11").val(dataItem3.sheet_no);
		    $("#win_txt12").val(dataItem3.rev_no);
		    $("#win_txt13").val(dataItem3.spool_no);
		    $("#win_txt14").val(dataItem3.system_no);
		    $("#win_txt15").val(dataItem3.sub_system);
		    $("#win_txt16").val(dataItem3.testpack_no);
	    }
	}
	function forDiv(){
		var container = $("#tempNS_rs");
		var container2 = $("#tempS_rs");
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
							// $("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
							// $("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
							// $("#tempNS_rs").data("kendoGrid").dataSource.read();
				    		// if (isFailed)
				    			// return true;
							// $(".tempNS_phase .wrap-form input, .tempNS_phase .wrap-form textarea, .tempNS_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
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
							// // $("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
							// // $("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
							// // $("#tempNS_rs").data("kendoGrid").dataSource.read();
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
							// // // $("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
							// // // $("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
							// // // $("#tempNS_rs").data("kendoGrid").dataSource.read();
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
                        item_code: { type: "string" },
                        commodity_code: { type: "string" },
                        category: { type: "string" },
                        size: { type: "string" },
                        itemno: { type: "string" },
                        req_qty: { type: "number" },
                        drawing_no: { type: "string" },
                        spool_no: { type: "string" },
                        spool_type: { type: "string" },
                        sheet_no: { type: "string" },
                        rev_no: { type: "string" }
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
			// toolbar: ["save","cancel"],
            resizable: true,
            filterable: {
                extra: false
            },
            columns: [
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
           change: function(e){
           		currRow = this;
			    selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        jmif_di = this.dataItem(selectedRows[i]);
			    }
			    $(".tempNS_phase .wrap-form input, .tempNS_phase .wrap-form textarea, .tempS_phase .wrap-form input, .tempS_phase .wrap-form textarea").val("");
			    // grid_change(currRow,"#tempNS_rs");
			    // jmifdtl_ds.read();
           },
           dataBound: addExtraStylingToGrid
        });
		// $("#tempNS_rs .k-grid-toolbar").hide();
        insertGridTitle('#tempNS_rs','Material Take-Off');
                    
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
                        // req_qty: { type: "number" },
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
                        item_code: { type: "string" },
                        commodity_code: { type: "string" },
                        size: { type: "string" },
                        req_qty: { type: "number" },
                        drawing_no: { type: "string" },
                        spool_no: { type: "string" },
                        spl_type: { type: "string" },
                        sheet_no: { type: "string" },
                        rev_no: { type: "string" },
                        mat_desc: { type: "string" },
                        itemno: { type: "string" }
                    }
                },
                total: function(response) {
				   	return parseInt(($(response).length > 0) ? $(response).length : 0);
			    }
            }
        });
                                
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
            editable: false,
            resizable: true,
            filterable: false,
            columns: [
               {field: "item_code",title: "Item Code", width: 117},
               {field: "commodity_code",title: "Comm. Code", width: 89},
               {field: "size",title: "Size", width: 79},
               {field: "req_qty",title: "Quantity", width: 110},
               {field: "drawing_no",title: "Drawing No.",width: 85},
               {field: "spool_no",title: "Spool No.", width: 89},
               {field: "spl_type",title: "Spool Type", width: 89},
               {field: "sheet_no",title: "Sheet No.", width: 89},
               {field: "rev_no",title: "Rev. No.", width: 110},
               {field: "mat_desc",title: "Material Description", width: 110},
               {field: "itemno",title: "PT No.", width: 110}
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
			    grid_change(currRow2,"#tempS_rs");
           },
           dataBound: addExtraStylingToGrid2
        });
        insertGridTitle('#tempS_rs','Material Request');        	    	            
	    //$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		// $("#txt2").removeClass('k-state-disabled').kendoDatePicker({
			// format: "MM/dd/yyyy",
			// enable: false
		// });
		$("#win_txt7, #win_txt8").removeClass('k-state-disabled').kendoNumericTextBox({
			format: "n",
			enable: true
		});
		// $("#win_txt1").removeClass('k-state-disabled').kendoComboBox({
			// enable: false,
            // filter: "contains",
            // placeholder: "Select item...",
            // dataTextField: "item_code",
            // dataValueField: "stock_desc",
			// autoBind: true,
            // dataSource: {
                // transport: {
                    // read: crudService + "directCall/item",
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
            		// $(".k-input").eq(0).val("").select().focus();
            		// $("#win_textarea").val("");
				// }else{
            		// $("#win_textarea").val(this.value().split(",")[0]);
            		// $("#win_txt4").val(this.value().split(",")[1]);
            		// $("#win_txt5").val(this.value().split(",")[2]);
            	// }
            // }
		// });
		$("#win_txt6").removeClass('k-state-disabled').kendoComboBox({
			enable: true,
            filter: "contains",
            placeholder: "Select utilization...",
            dataTextField: "util_dtl",
            dataValueField: "util_code",
			autoBind: true,
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
				if (this.selectedIndex < 0)
            		$("input[name=win_txt6_input]").val("").select().focus();
            }
		});
		// var jmif_date = $("#txt2").data("kendoDatePicker");
		var mat_util = $("#win_txt6").data("kendoComboBox");
		var measurement = $("#win_txt7").data("kendoNumericTextBox");
		var req_qty = $("#win_txt8").data("kendoNumericTextBox");
		// var supp_code = $("#txt3").data("kendoComboBox");
		// var stock_no = $("#win_txt1").data("kendoComboBox");
        
        var processOnClose = function(){
        	if ($("#win2_txt1").val() != "")
        		treqDtl_ds.read();
        	else
        		$("#window").data("kendoWindow").close();
        		// if (confirm("Do you want to CLEAR the existing records?")){
        			// twjrr_engg_ds.remove({PROGRESS_RECID: 0});
        			// twjrr_engg_ds.sync();
        		// }
        		// // open_preloader();
        		// $.post(crudService + "manage/ttMTO",{drawing_no: $("#win2_txt1").val(), sheet_no: $("#win2_txt2").val(), loguser: $("#hidden_user").val(), setType: "add"},
        			// function(data){
        				// showNotif("Information",data,"info");
        				// twjrr_engg_ds.read();
        				// // close_preloader();
        			// });
        	// }
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
		
							jmifdtl_ds.push(down_di);
							indexArr.push(down_di);
					        $.post(crudService + "remove/tjmif",{PROGRESS_RECID: down_di.PROGRESS_RECID},
					       	    function(data){
									treqDtl_ds.sync();
									$("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
									$("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
									$("#tempNS_rs").data("kendoGrid").dataSource.read();
					       	    });
						}
						jmifdtl_ds2.sync();
						$("#tempS_rs").data("kendoGrid").dataSource.data(jmifdtl_ds);
						$("#tempS_rs").data("kendoGrid").dataSource.page($("#tempS_rs").data("kendoGrid").dataSource.page());
						$("#tempS_rs").data("kendoGrid").dataSource.read();
						
						req_qty.enable(true);
						$("#win_textarea1").prop("disabled", false).removeClass("k-state-disabled");
						$(".tempS_phase .wrap-form button, .wrap-button .buttonLeft button").prop("disabled", false).removeClass("k-state-disabled");
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

							//console.log(postInfo);
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
						$("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
						$("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
						$("#tempNS_rs").data("kendoGrid").dataSource.read();

						jmifdtl_ds2.read();
        			break;
        		}
        	}
        });
        
	    $(".tempS_phase .wrap-button .buttonLeft button").bind({
	    	click: function(e){
	    		$.post(crudService + "manage/setTREQ",{jsonData: JSON.stringify({item: jmifdtl_ds2.data()}), jmif_no: $("#txt1").val(), disc_code: disc_code, log_user: $("#hidden_user").val(), module: "jmif", req_qty_old: 0},
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
    					// $("#tempNS_rs").data("kendoGrid").dataSource.remove(dataRow);
						// treqDtl_ds.sync();
						// $("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
						// $("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
						// $("#tempNS_rs").data("kendoGrid").dataSource.read();
	    				// return true;
	    			// break;
	    			// case "delButt2":
	    				// if (!confirm("Do you really want to delete this item?")){
	    					// e.preventDefault();
	    					// return true;
	    				// }
// 	    				
						// dataRow = grid2.data("kendoGrid").dataSource.getByUid(jmifdtl_di.uid);
    					// $("#tempS_rs").data("kendoGrid").dataSource.remove(dataRow);
						// jmifdtl_ds.sync();
						// $("#tempS_rs").data("kendoGrid").setDataSource(jmifdtl_ds);
						// $("#tempS_rs").data("kendoGrid").dataSource.page($("#tempS_rs").data("kendoGrid").dataSource.page());
						// $("#tempS_rs").data("kendoGrid").dataSource.read();
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
								// $("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
								// $("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
								// $("#tempNS_rs").data("kendoGrid").dataSource.read();
	    					// });
	    			// break;
	    			// default:
	    				// if (this.id.indexOf("2") < 0){
							// $(".tempNS_phase .wrap-form input, .tempNS_phase .wrap-form textarea, .tempNS_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							// jmif_date.enable(true);
							// supp_code.enable(true);
			    			// if (this.id == "addButt"){
			    				// isFailed = false;
								// $(".tempNS_phase .wrap-form input, .tempNS_phase .wrap-form textarea").val("");
								// $(".tempNS_phase .wrap-form input").eq(1).select().focus();
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
											// // $(".tempNS_phase .wrap-form input, .tempNS_phase .wrap-form textarea").eq(index).prop("value", value);
										// // });
										// cMode = "add";
									// });
			    			// }else {
								// $("#txt1").prop("disabled", true).addClass("k-state-disabled");
								// $("#textarea").prop("disabled", true).addClass("k-state-disabled");
								// $(".tempNS_phase .wrap-form input").eq(1).select().focus();
								// cMode = "edit";
							// }
						// }else {
							// if (dataItem.length == 0)
								// return true;
							// $(".tempS_phase .wrap-form input, .tempS_phase .wrap-form textarea, .tempS_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							// po_qty.enable(true);
							// stock_no.enable(true);
			    			// if (this.id == "addButt2"){
								// stock_no.enable(true);
			    				// isFailed = false;
								// $(".tempS_phase .wrap-form input, .tempS_phase .wrap-form textarea").val("");
								// $(".tempS_phase .wrap-form input").eq(0).select().focus();
								// $('input[name=win_option1], input[name=win_option2], #win_search').prop("disabled", true);
								// $("#textarea2, #txt8, #txt9, #txt10, #txt11").prop("disabled", true).addClass("k-state-disabled");
								// cMode = "add";
			    			// }else {
								// $(".tempS_phase .wrap-form textarea").select().focus();
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
	    // $(".tempNS_phase .wrap-form button").bind({
	    	// click: function(e){
				// $(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
	    		// switch(this.id){
	    			// case "saveButt":
	    				// if (!confirm("Are you sure you want to save this data?")){
	    					// e.preventDefault();
	    					// return true;
	    				// }
// 	    				
	    				// isFailed = verifyThisInput(".tempNS_phase");
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
							// // $("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
							// // $("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
							// // $("#tempNS_rs").data("kendoGrid").dataSource.read();
						// }else
					        // $.post(crudService + "manage/tjmif",{PROGRESS_RECID: dataItem.PROGRESS_RECID, jmif_no: $("#txt1").val(), jmif_date: kendo.toString(jmif_date.value(),"yyyy-MM-dd"), supp_code: supp_code.value(), supp_desc: $("#textarea").val(), pl_dn_inv: $("#txt4").val(), po_no: $("#txt5").val(), deliv_by: $("#txt6").val(), remarks: $("#textarea1").val()},
					       	    // function(data){
									// $("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
									// $("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
									// $("#tempNS_rs").data("kendoGrid").dataSource.read();
					       	    // });
	    			// break;
	    			// default:
	    				// $(".thisIsRequired").removeClass('thisIsRequired');
		    			// isFailed = false;
			    		// grid_change(currRow,"#tempNS_rs");
	    			// break;
	    		// }
	    		// if (isFailed)
	    			// return true;
				// $(".tempNS_phase .wrap-form input, .tempNS_phase .wrap-form textarea, .tempNS_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		        // $("#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
				// $('input[name=win_option1], input[name=win_option2], #win_search').prop("disabled", false);
				// jmif_date.enable(false);
				// supp_code.enable(false);
				// $("#coverDiv").remove();
	    	// }
	    // });
	    $(".tempS_phase .wrap-form button").bind({
	    	click: function(e){	    				
				isFailed = verifyThisInput(".tempS_phase");
	    		if (isFailed)
	    			return true;
	    			
	    		var conf = confirm("Apply common fields to other items?\n (Activity Code, Mat. Utilization, System & Sub-System)");
				$.each(jmifdtl_ds, function(index3, value3){
		        	// value3.measurement = (value3.measurement == '') ? 0 : measurement.value() 
		        	// value3.req_qty = (value3.req_qty == '') ? 0 : req_qty.value()
					if (conf){
			        	value3.activity_code = $("#win_txt5").val();
			        	value3.mat_util = mat_util.value();			
			        	value3.system_no = $("#win_txt14").val();
			        	value3.sub_system = $("#win_txt15").val();
					}
					if (value3.uid == jmifdtl_di.uid){				
						// var data = $("#tempNS_rs").data("kendoGrid").dataSource.at(index3);
						// data.set("name", "John Doe");
						if (req_qty.value() > jmifdtl_di.qty)
							req_qty.value(jmifdtl_di.qty);
			        	value3.direct_with = ($("#win_chk1").is(":checked") ? 1 : 0);
			        	value3.mat_desc = $("#win_textarea").val();
			        	value3.activity_code = $("#win_txt5").val();
			        	value3.measurement = measurement.value();
			        	value3.req_qty = req_qty.value();
			        	value3.system_no = $("#win_txt14").val();
			        	value3.sub_system = $("#win_txt15").val();
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
	    				// isFailed = verifyThisInput(".tempS_phase");
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
											// req_qty: po_qty.value(),
											// spl_type: ($("#rad3").is(":checked") ? "" : ($("#rad1").is(":checked") ? "spool" : "em")),
											// remarks: $("#textarea3").val()});
							// jmifdtl_ds.sync();
							// $("#tempS_rs").data("kendoGrid").setDataSource(jmifdtl_ds);
							// $("#tempS_rs").data("kendoGrid").dataSource.page($("#tempS_rs").data("kendoGrid").dataSource.page());
							// $("#tempS_rs").data("kendoGrid").dataSource.read();
						// }else
					        // $.post(crudService + "manage/tjmifDtl",{PROGRESS_RECID: jmifdtl_di.PROGRESS_RECID, stock_no: stock_no.value(), stock_desc: $("#textarea2").val(), item_code: $("#txt8").val(), commodity_code: $("#txt9").val(), uom: $("#txt10").val(), size: $("#txt11").val(), req_qty: po_qty.value(), spl_type: ($("#rad3").is(":checked") ? "" : ($("#rad1").is(":checked") ? "spool" : "em")), remarks: $("#textarea3").val()},
					       	    // function(data){
									// $("#tempS_rs").data("kendoGrid").setDataSource(jmifdtl_ds);
									// $("#tempS_rs").data("kendoGrid").dataSource.page($("#tempS_rs").data("kendoGrid").dataSource.page());
									// $("#tempS_rs").data("kendoGrid").dataSource.read();
					       	    // });
	    			// break;
	    			// default:
	    				// $(".thisIsRequired").removeClass('thisIsRequired');
		    			// isFailed = false;
			    		// grid_change(currRow2,"#tempS_rs");
	    			// break;
	    		// }
	    		// if (isFailed)
	    			// return true;
				// $(".tempS_phase .wrap-form input, .tempS_phase .wrap-form textarea, .tempS_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		        // $("#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
				// $('input[name=win_option1], input[name=win_option2], #win_search').prop("disabled", false);
				// stock_no.enable(false);
				// po_req_qty.enable(false);
				// $("#coverDiv").remove();
	    	}
	    });
		// $(".wrap-header input[name=win_option2]").bind({
			// click: function(e){
				// sentValue = ($('input[name=win_option2]:checked').index('input[name=win_option2]') == 2) ? 1 : ($('input[name=win_option2]:checked').index('input[name=win_option2]') == 1) ? 0 : "";
				// $("#tempNS_rs").data("kendoGrid").dataSource.read();
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
		// $("#tempNSHead").css({"min-height": ((parseInt($("#tempNSHead .wrap-form").height()) + 12) + "px")});
		$("#tempSHead").css({"min-height": ((parseInt($("#tempSHead .wrap-form").height()) + 12) + "px")});
	});
</script>