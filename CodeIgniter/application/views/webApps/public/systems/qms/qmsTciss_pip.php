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
	<!-- <div class="wrap-header demo-section">
		<fieldset>
			<legend> Filter Option: </legend>
			<div style="float: left;">
				<label><input type="radio" name="win_option1" id="win_option1" checked /> All </label>
				<label><input type="radio" name="win_option1" id="win_option2" /> Stock </label>
				<label><input type="radio" name="win_option1" id="win_option3" /> Drawing </label>
			</div>
            <span class="k-textbox k-space-right">
                <input type="text" value="" name="win_win_search" id="win_search" />
                <a href="#" class="k-icon k-i-search">&nbsp;</a>
            </span>			
		</fieldset>
	</div> -->
	<div class="tempNS_phase" style="width: 100%;">
		<div id="tempNSHead" style="min-height: 260px;margin-bottom: 5px;">
		    <div class="wrap-grid demo-section" style="width: 98.8%;margin-left: 0;height: auto;">
		        <div id="tempNS_rs"></div>
		    </div>
		</div>
	</div>
	<div class="tempS_phase" style="margin-top: 5px !important;">
		<div id="tempSHead" style="margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="height: auto;display: block;">
				<fieldset style="width: 23.5%;float: left;">
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="win_txt1" style="width: 90px;">Issued Date:</label><input type="text" name="win_txt1" id="win_txt1" required style="width: 129px;" />
						</li>
						<li>
							<label class="title" for="win_txt2" style="width: 90px;">Issued By:</label><input type="text" name="win_txt2" id="win_txt2" class="k-textbox" style="width: 129px;" />
						</li>
					</ul>
				</fieldset>
				<fieldset style="width: 73.6%;">
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<ul class="formLeft_qms" style="width: 14%;height: 56px;">
								<li>
									<span>Applied Only For Auto-JWRR When Checked</span>
								</li>
							</ul>
							<ul class="formLeft_qms" style="width: 50.2%;">
								<li>
									<label class="title" for="win_txt3" style="width: 150px;">Supplier Code:</label><input type="text" name="win_txt3" id="win_txt3" class="k-textbox" style="width: 138px;" />
								</li>
								<li>
									<label class="title" for="win_txt5" style="width: 150px;">PR/PO No.:</label><input type="text" name="win_txt5" id="win_txt5" class="k-textbox" style="width: 138px;" />
								</li>
							</ul>
							<ul class="formLeft_qms" style="width: 33.6%;">
								<li>
									<label class="title" for="win_txt4" style="width: 95px;">Received By:</label><input type="text" name="win_txt4" id="win_txt4" class="k-textbox" style="width: 138px;" />
								</li>
								<li>
									<label class="title" for="win_txt6" style="width: 95px;">PL/DN/INV No.:</label><input type="text" name="win_txt6" id="win_txt6" class="k-textbox" style="width: 138px;"/>
								</li>
							</ul>
						</li>
					</ul>
				</fieldset>
			</div>
		</div>
		<div class="wrap-button demo-section">
			<div class="buttonLeft">
	        	<button class="k-button mainEve" id="confButt">Confirm</button>
	       	</div>
			<!-- <div class="buttonRight">
	        	<button class="k-button mainEve" id="closeButt">Close</button>
	       	</div> -->				
		</div>
	</div>
</div>
<script type="text/javascript">
	// function grid_change(e,grid){
		// if (typeof e == "undefined")
			// e = grid;
	    // var selectedRows3 = e.select();
	    // var selectedDataItems = [];
	    // for (var i = 0; i < selectedRows3.length; i++) {
	      // dataItem3 = e.dataItem(selectedRows3[i]);
		    // $("#win_chk1").prop("checked", (dataItem3.direct_with == 1));
		    // $("#win_txt1").val(dataItem3.item_code);
		    // $("#win_txt2").val(dataItem3.commodity_code);
		    // $("#win_textarea").val(dataItem3.mat_desc);
		    // $("#win_txt3").val(dataItem3.uom);
		    // $("#win_txt4").val(dataItem3.size);
		    // $("#win_txt5").val(dataItem3.activity_code);
		    // $("#win_txt6").data("kendoComboBox").value((dataItem3.mat_util == null) ? '' : dataItem3.mat_util);
		    // $("#win_txt7").data("kendoNumericTextBox").value((dataItem3.measurement == null) ? 0 : dataItem3.measurement);
		    // $("#win_txt8").data("kendoNumericTextBox").value((dataItem3.req_qty == null) ? 0 : dataItem3.req_qty);
		    // $("#win_txt9").val(dataItem3.plant_no);
		    // $("#win_txt10").val(dataItem3.area_no);
		    // $("#win_textarea2").val(dataItem3.drawing_no);
		    // $("#win_txt11").val(dataItem3.sheet_no);
		    // $("#win_txt12").val(dataItem3.rev_no);
		    // $("#win_txt13").val(dataItem3.spool_no);
		    // $("#win_txt14").val(dataItem3.system_no);
		    // $("#win_txt15").val(dataItem3.sub_system);
		    // $("#win_txt16").val(dataItem3.testpack_no);
	    // }
	// }
	// function forDiv(){
		// var container = $("#tempNS_rs");
		// var container2 = $("#tempS_rs");
		// var position = container.offset();	
		// var offsetHeight = container.height();	
		// var offsetHeight2 = container2.height();	
		// var offsetWidth = container.width();
		// var newDiv = $("<div id = 'coverDiv'>").appendTo($("body"));
		// newDiv.offset(position);
		// newDiv.height((offsetHeight + offsetHeight2) + 87);
		// newDiv.width(offsetWidth - 17);
	// }
	$(document).ready(function(){
		var crudService = crudServiceBaseUrl + "qms/index/",
			disc_code = pathname.split('/')[pathname.split('/').length - 1],
		    filterFArr_treqDtl = [], filterOArr_treqDtl = [], filterVArr_treqDtl = [], sentValue = "", currRow = "", currRow2 = "", cMode = "", jmif_di = '', jmifdtl_di = '', isFailed = false,
		    filterFArr_jmifdtl = [], filterOArr_jmifdtl = [], filterVArr_jmifdtl = [], sentValue_jmifdtl = "", fieldSort = "", dirSort = "", query = "", down_di = '', up_di = '',
			optionArr = ["","stock_no","drawing_no"],			
			indexArr = [], jmifdtl_ds = [], processThis = true;   
	   
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
        
        var issConf_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/issconf",
                    contentType: "application/json",
                    type: "GET"
                },
                // create: {
                    // url: crudService + "manage/tjmif",
                    // type: "POST",
	                // complete: function(jqXHR, textStatus) {
						// // showNotif('Warning',jqXHR.responseText,'warning');
						// console.log(jqXHR.responseText);
	                	// if (jqXHR.responseText != '1')
							// showNotif('Warning',jqXHR.responseText,'warning');
						// // else {
							// // // alert("romel");
							// // // treqDtl_ds.sync();
							// // $("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
							// // $("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
							// // $("#tempNS_rs").data("kendoGrid").dataSource.read();
				    		// // if (isFailed)
				    			// // return true;
							// // $(".tempNS_phase .wrap-form input, .tempNS_phase .wrap-form textarea, .tempNS_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
							// // $(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
							// // $('input[name=win_option1], input[name=win_option2], #win_search').prop("disabled", false);
							// // // jmif_date.enable(false);
							// // // supp_code.enable(false);
							// // $("#coverDiv").remove();
						// // }
	                // }
                // },
                update: {
                    url: crudService + "manage/issConf",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						// showNotif('Warning',jqXHR.responseText,'warning');
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else {
							// treqDtl_ds.sync();
							$("#tempNS_rs").data("kendoGrid").setDataSource(issConf_ds);
							$("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
							$("#tempNS_rs").data("kendoGrid").dataSource.read();
						}
	                }
                },
                // destroy: {
                    // url: crudService + "remove/tjmif",
                    // type: "POST"
                    // // ,
	                // // complete: function(jqXHR, textStatus) {
						// // showNotif('Warning',jqXHR.responseText,'warning');
	                	// // // if (jqXHR.responseText != '1')
							// // // showNotif('Warning',jqXHR.responseText,'warning');
						// // // else {
							// // // alert("romel");
							// // // // treqDtl_ds.sync();
							// // // // $("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
							// // // // $("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
							// // // // $("#tempNS_rs").data("kendoGrid").dataSource.read();
						// // // }
	                // // }
                // },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : (typeof this.value == "boolean" ? (this.value ? 1 : 0) : this.value);
				      		filterFArr_treqDtl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_treqDtl[index] = this.operator;
				      		filterVArr_treqDtl[index] = valForm;
				      	});
				    }
				    // if ($('input[name=win_option1]:checked').index('input[name=win_option1]') > 0)
				     	// filterFArr_treqDtl[filterFArr_treqDtl.length] = optionArr[$('input[name=win_option1]:checked').index('input[name=win_option1]')] + ";" + sentValue + ";eq";
				    // if ($('input[name=win_option2]:checked').index('input[name=win_option2]') > 0)
				     	// filterFArr_treqDtl[filterFArr_treqDtl.length] = "finalized;1;" + (($('input[name=win_option2]:checked').index('input[name=win_option2]') == 1) ? "neq" : "eq" );				     
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_treqDtl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "drawing_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_treqDtl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_treqDtl : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    disc_code: disc_code,
					    jmif_no: $("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).text(),
					    processThis: (processThis) ? 1 : 0
					    // module: 'jmif',
					    // log_user: $("#hidden_user").val(),
					    // drawing_no: $("#win2_txt1").val(),
					    // sheet_no: $("#win2_txt2").val()
			        }
			      }else {
			      	data['log_user'] = $("#hidden_user").val();
			      	data['remarks'] = data.remarks;
			      	data['dlmr_jwrr'] = (data.dlmr_jwrr ? 1 : 0); 
			      	data['direct_with'] = (data.direct_with ? 1 : 0); 
			      	data['old_dj'] = (data.old_dj ? 1 : 0); 
			      	data['old_iss'] = (data.old_dj ? 1 : 0); 
			      	data['old_ex'] = (data.old_dj ? 1 : 0); 
			      	data['excess'] = (data.old_dj ? 1 : 0); 
			      	data['liss'] = (data.liss ? 1 : 0); 
			      	data['valid'] = (data.valid ? 1 : 0);
			      	data['issue_date'] = kendo.toString(data.issue_date,"yyyy-MM-dd");
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
                        jmif_no: { type: "string", editable: false },
                        stock_no: { type: "string", editable: false },
                        size: { type: "string", editable: false },
                        req_qty: { type: "number" },
                        liss: { type: "boolean" },
                        dlmr_jwrr: { type: "boolean" },
                        old_dj: { type: "boolean" },
                        old_iss: { type: "boolean" },
                        old_ex: { type: "boolean" },
                        excess: { type: "boolean" },
                        iss_qty: { type: "number" },
                        issue_date: { type: "date", editable: false },
                        issued_by: { type: "string", editable: false },
                        recvd_by: { type: "string", editable: false },
                        drawing_no: { type: "string", editable: false },
                        direct_with: { type: "boolean" },
                        isc_no: { type: "string", editable: false }
                    }
                },
                total: function(response) {
				   	return (($(response.rows[0]).length > 0) ? response.rows[0].total : 0);
			    }
            },
            change: function(e) {
            	if ($(e.items).length == 0)
            		return true;
            	if (processThis)
            		processThis = false;
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
            dataSource: issConf_ds,
            selectable: "multiple",
            pageable: {
                buttonCount: 3,
    			input: true
            },
            autoBind: true,
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: true,
			toolbar: ["save","cancel"],
            resizable: true,
            filterable: {
                extra: false
            },
            columns: [
               {field: "jmif_no",title: "JMIF No.", width: 122},
               {field: "stock_no",title: "Stock No.", width: 89},
               {field: "size",title: "Size", width: 79},
               {field: "req_qty",title: "Requested Qty", width: 119},
               {field: "liss",title: "For UPD.", width: 79, 
                    template: kendo.template("<input type='checkbox' name='liss_#= PROGRESS_RECID #' id='liss_#= PROGRESS_RECID #' disabled #= liss ? checked='checked' : '' # />")},
               {field: "dlmr_jwrr",title: "DLMR/JWRR",width: 100},
                    //template: kendo.template("<input type='checkbox' name='#= PROGRESS_RECID #' id='#= PROGRESS_RECID #' #= dlmr_jwrr ? checked='checked' : '' # />")},
               {field: "iss_qty",title: "Issued Qty.", width: 98},
               {field: "issue_date",title: "Issued Date", width: 104, format: "{0:MM/dd/yyyy}"},
               {field: "issued_by",title: "Issued By", width: 89},
               {field: "recvd_by",title: "Recvd By", width: 89},
               {field: "drawing_no",title: "Drawing No.", width: 121},
               {field: "direct_with",title: "Direct Withdraw", width: 127},
                    //template: kendo.template("<input type='checkbox' name='#= PROGRESS_RECID #' id='#= PROGRESS_RECID #' #= direct_with ? checked='checked' : '' # />")},
               {field: "isc_no",title: "Item No.", width: 89}
           ],
           change: function(e){
           		currRow = this;
			    selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        jmif_di = this.dataItem(selectedRows[i]);
			    }
			    // $(".tempNS_phase .wrap-form input, .tempNS_phase .wrap-form textarea, .tempS_phase .wrap-form input, .tempS_phase .wrap-form textarea").val("");
			    // grid_change(currRow,"#tempNS_rs");
			    // jmifdtl_ds.read();
           },
           dataBound: addExtraStylingToGrid
        });
		$("#tempNS_rs .k-grid-toolbar").hide();
        insertGridTitle('#tempNS_rs','Material File Issuance');                    
        // // var jmifdtl_ds = new kendo.data.DataSource({
            // // transport: {
                // // read: {
                    // // url: crudService + "directCall/tjmifDtl",
                    // // contentType: "application/json",
                    // // type: "GET"
                // // },
                // // create: {
                    // // url: crudService + "manage/tjmifDtl",
                    // // type: "POST",
	                // // complete: function(jqXHR, textStatus) {
	                	// // console.log(jqXHR);
	                	// // if (jqXHR.responseText != '1')
							// // showNotif('Warning',jqXHR.responseText,'warning');
	                // // }
                // // },
                // // update: {
                    // // url: crudService + "manage/tjmifDtl",
                    // // type: "POST",
	                // // complete: function(jqXHR, textStatus) {
	                	// // console.log(jqXHR);
						// // showNotif('Warning',jqXHR.responseText,'warning');
	                	// // // if (jqXHR.responseText != '1')
							// // // showNotif('Warning',jqXHR.responseText,'warning');
// // 
	                // // }
                // // },
                // // destroy: {
                    // // url: crudService + "remove/tjmifDtl",
                    // // type: "POST"
                // // },
			    // // parameterMap: function(data, type) {
			      // // if (type == "read") {
			      	// // if ($(data.filter).length > 0){
				      	// // $.each(data.filter.filters,function(index,value){
				      		// // var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		// // filterFArr_jmifdtl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		// // filterOArr_jmifdtl[index] = this.operator;
				      		// // filterVArr_jmifdtl[index] = valForm;
				      	// // });
				    // // }
				    // // fieldSort = ($(data.sort).length ? data.sort[0].field : "log_date");
				    // // query = filterFArr_jmifdtl;
				    // // dirSort = ($(data.sort).length ? data.sort[0].dir : "desc");
			        // // return {
			            // // page: data.page,
			            // // pageSize: data.pageSize,
			            // // top: data.take,
			            // // skip: data.skip,
					    // // fieldF: filterFArr_jmifdtl,
					    // // fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    // // operator: (($(data.filter).length > 0) ? filterOArr_jmifdtl : "contains"),
					    // // value: (($(data.filter).length > 0) ? filterVArr_jmifdtl : sentValue_jmifdtl),
					    // // dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    // // jmif_no: dataItem.jmif_no
			        // // }
			      // // }else{
			      	  // // data['log_user'] = $("#hidden_user").val();
					  // // data['jmif_no'] = dataItem.jmif_no;
			      	  // // return data;
			      	 // // }
			    // // }
            // // },
			// // requestEnd: function(e) {
			    // // var response = e.response;
			    // // var type = e.type;
			    // // // console.log(type);
			    // // // console.log(response);
			// // },
            // // pageSize: 6,
            // // serverPaging: true,
			// // serverFiltering: true,
			// // serverSorting: true,
            // // schema: {
                // // data: function(data) {
                    // // return data.rows || [];
                // // },
                // // errors: function(data){
               	    // // if (filterFArr_jmifdtl.length > 0 && $(data.rows).length == 0){
               		    // // notif("info","Information","No records found!");
					    // // sentValue_jmifdtl = "";
					    // // filterFArr_jmifdtl = [];
					    // // $("form.k-filter-menu button[type='reset']").trigger("click");
               	    // // }
                // // },
                // // model: {
               		// // id: "PROGRESS_RECID",
                    // // fields: {
                   	    // // PROGRESS_RECID: { type: "number", editable: false },
                        // // stock_no: { type: "string" },
                        // // stock_desc: { type: "string" },
                        // // uom: { type: "string" },
                        // // req_qty: { type: "number" },
                        // // remarks: { type: "string" }
                    // // }
                // // },
                // // total: function(response) {
				   	// // return (($(response.rows[0]).length > 0) ? response.rows[0].total : 0); //$(response.rows).length;				   	
			    // // }
            // // },
            // // change: function(e) {
            	// // if ($(e.items).length == 0)
            		// // return true;
            // // }
        // // });
//         
        // var jmifdtl_ds2 = new kendo.data.DataSource({
            // data: jmifdtl_ds,
            // pageSize: 11,
            // schema: {
                // data: function(data) {
                    // return data || [];
                // },
                // errors: function(data){
               	    // if (filterFArr_treqDtl.length > 0 && $(data.rows).length == 0){
               		    // notif("info","Information","No records found!");
					    // sentValue = "";
					    // filterFArr_treqDtl = [];
					    // $("form.k-filter-menu button[type='reset']").trigger("click");
               	    // }
                // },
                // model: {
               		// id: "PROGRESS_RECID",
                    // fields: {
                   	    // PROGRESS_RECID: { type: "number", editable: false },
                        // item_code: { type: "string" },
                        // commodity_code: { type: "string" },
                        // size: { type: "string" },
                        // req_qty: { type: "number" },
                        // drawing_no: { type: "string" },
                        // spool_no: { type: "string" },
                        // spl_type: { type: "string" },
                        // sheet_no: { type: "string" },
                        // rev_no: { type: "string" },
                        // mat_desc: { type: "string" },
                        // itemno: { type: "string" }
                    // }
                // },
                // total: function(response) {
				   	// return parseInt(($(response).length > 0) ? $(response).length : 0);
			    // }
            // }
        // });
//                                 
	    // var addExtraStylingToGrid2 = function () {
			// $("#tempS_rs").data("kendoGrid").select("tr:eq(" + (treqDtl_ds._data.length + 2) + ")");
	        // $("#tempS_rs > .k-grid-content > table > tbody > tr").hover(
	            // function() {
	                // $(this).toggleClass("k-state-hover");
	            // }			        
	        // );
        	// filterFArr_jmifdtl = [];
	    // };
//         
        // var grid2 = $("#tempS_rs").kendoGrid({
            // dataSource: jmifdtl_ds2,
            // selectable: "multiple",
            // pageable: {
                // buttonCount: 3,
    			// input: true
            // },
            // autoBind: false,
            // groupable: false,
            // sortable: true,
            // scrollable: true,
            // navigatable: true,
            // editable: false,
            // resizable: true,
            // filterable: false,
            // columns: [
               // {field: "item_code",title: "Item Code", width: 117},
               // {field: "commodity_code",title: "Comm. Code", width: 89},
               // {field: "size",title: "Size", width: 79},
               // {field: "req_qty",title: "Quantity", width: 110},
               // {field: "drawing_no",title: "Drawing No.",width: 85},
               // {field: "spool_no",title: "Spool No.", width: 89},
               // {field: "spl_type",title: "Spool Type", width: 89},
               // {field: "sheet_no",title: "Sheet No.", width: 89},
               // {field: "rev_no",title: "Rev. No.", width: 110},
               // {field: "mat_desc",title: "Material Description", width: 110},
               // {field: "itemno",title: "PT No.", width: 110}
           // ],
           // change: function(e){
           		// currRow2 = this;
			    // selectedRows2 = this.select();
			    // var selectedDataItems = [];
			    // for (var i = 0; i < selectedRows2.length; i++) {
			        // jmifdtl_di = this.dataItem(selectedRows2[i]);
// 			        
			        // // $("#editButt2, #delButt2").prop("disabled", false).removeClass("k-state-disabled");
			        // // if (dataItem.finalized == 0 || dataItem.finalized == null)
			        	// // $("#editButt2, #delButt2").prop("disabled", false).removeClass("k-state-disabled");
			    // }
			    // grid_change(currRow2,"#tempS_rs");
           // },
           // dataBound: addExtraStylingToGrid2
        // });
        // insertGridTitle('#tempS_rs','Material Request');        	    	            
// 
	    // //$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		$("#win_txt1").removeClass('k-state-disabled').kendoDatePicker({
			format: "MM/dd/yyyy",
			enable: false
		});
		// $("#win_txt7, #win_txt8").removeClass('k-state-disabled').kendoNumericTextBox({
			// format: "n",
			// enable: true
		// });
		// // $("#win_txt1").removeClass('k-state-disabled').kendoComboBox({
			// // enable: false,
            // // filter: "contains",
            // // placeholder: "Select item...",
            // // dataTextField: "item_code",
            // // dataValueField: "stock_desc",
			// // autoBind: true,
            // // dataSource: {
                // // transport: {
                    // // read: crudService + "directCall/item",
            		// // contentType: "application/json"
                // // },
                // // schema: {
					// // data: function(data){
	                    // // return data.rows || [];
					// // }	                    	
                // // }
            // // },
            // // change: function(e){
				// // if (this.selectedIndex < 0){
            		// // $(".k-input").eq(0).val("").select().focus();
            		// // $("#win_textarea").val("");
				// // }else{
            		// // $("#win_textarea").val(this.value().split(",")[0]);
            		// // $("#win_txt4").val(this.value().split(",")[1]);
            		// // $("#win_txt5").val(this.value().split(",")[2]);
            	// // }
            // // }
		// // });
		// $("#win_txt6").removeClass('k-state-disabled').kendoComboBox({
			// enable: true,
            // filter: "contains",
            // placeholder: "Select utilization...",
            // dataTextField: "util_dtl",
            // dataValueField: "util_code",
			// autoBind: true,
            // dataSource: {
                // transport: {
                    // read: crudService + "directCall/matUtil_dd",
            		// contentType: "application/json"
                // },
                // schema: {
					// data: function(data){
	                    // return data.rows || [];
					// }	                    	
                // }
            // },
            // change: function(e){
				// if (this.selectedIndex < 0)
            		// $("input[name=win_txt6_input]").val("").select().focus();
            // }
		// });
		var issue_date = $("#win_txt1").data("kendoDatePicker");
		// var mat_util = $("#win_txt6").data("kendoComboBox");
		// var measurement = $("#win_txt7").data("kendoNumericTextBox");
		// var req_qty = $("#win_txt8").data("kendoNumericTextBox");
		// // var supp_code = $("#txt3").data("kendoComboBox");
		// // var stock_no = $("#win_txt1").data("kendoComboBox");
//         
        // var processOnClose = function(){
        	// if ($("#win2_txt1").val() != "")
        		// treqDtl_ds.read();
        	// else
        		// $("#window").data("kendoWindow").close();
        		// // if (confirm("Do you want to CLEAR the existing records?")){
        			// // twjrr_engg_ds.remove({PROGRESS_RECID: 0});
        			// // twjrr_engg_ds.sync();
        		// // }
        		// // // open_preloader();
        		// // $.post(crudService + "manage/ttMTO",{drawing_no: $("#win2_txt1").val(), sheet_no: $("#win2_txt2").val(), loguser: $("#hidden_user").val(), setType: "add"},
        			// // function(data){
        				// // showNotif("Information",data,"info");
        				// // twjrr_engg_ds.read();
        				// // // close_preloader();
        			// // });
        	// // }
        // };
// 				
		// $("#subWindow").data("kendoWindow").setOptions({
		    // title: "Input Drawing No.",
		    // width: "278px",
		    // height: "auto",
		    // close: processOnClose
		// });
		// $("#subWindow").data("kendoWindow").refresh({
       		// url: "/codeIgniter/index.php/webapps/templateLoader/index/qms/drawSheet",
			// type: "POST",
			// data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
		// });
		// $("#subWindow").data("kendoWindow").center().open();
// 		
		// $(".tempNS_phase .wrap-button button").bind({
        	// click: function(e){
        		// switch(this.id){
        			// case "downButt":
						// for (var i = 0; i < selectedRows.length; i++) {
				        	// down_di = currRow.dataItem(selectedRows[i]);
// 		
							// jmifdtl_ds.push(down_di);
							// indexArr.push(down_di);
					        // $.post(crudService + "remove/tjmif",{PROGRESS_RECID: down_di.PROGRESS_RECID},
					       	    // function(data){
									// treqDtl_ds.sync();
									// $("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
									// $("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
									// $("#tempNS_rs").data("kendoGrid").dataSource.read();
					       	    // });
						// }
						// jmifdtl_ds2.sync();
						// $("#tempS_rs").data("kendoGrid").dataSource.data(jmifdtl_ds);
						// $("#tempS_rs").data("kendoGrid").dataSource.page($("#tempS_rs").data("kendoGrid").dataSource.page());
						// $("#tempS_rs").data("kendoGrid").dataSource.read();
// 						
						// req_qty.enable(true);
						// $("#win_textarea1").prop("disabled", false).removeClass("k-state-disabled");
						// $(".tempS_phase .wrap-form button, .wrap-button .buttonLeft button").prop("disabled", false).removeClass("k-state-disabled");
        			// break;
        			// default:
        				// var uidArr = [];
						// for (var i = 0; i < selectedRows2.length; i++) {
				        	// up_di = currRow2.dataItem(selectedRows2[i]);
				        	// uidArr.push(up_di.uid);
				        // }
						// var ds_total = selectedRows2.length;
						// $.each(jmifdtl_ds2.data(),function(index,value){
							// var row = [];
							// if ($.inArray(value.uid,uidArr) < 0)
								// return;
							// $.each(value,function(index2,value2){
								// if (typeof value2 == "object")
									// return;
// 	
								// row[index2] = value2;
							// });
// 
							// row['PROGRESS_RECID'] = 0;
							// postInfo = JSON.stringify(row);
							// postInfo = eval("(" + postInfo + ")");
// 
							// //console.log(postInfo);
							// treqDtl_ds.add(postInfo);
	    					// var removeThis;
	    					// $.each(jmifdtl_ds, function(index3, value3){
	    						// if (value3.uid == value.uid){
	    							// removeThis = index3;
	    							// return;
	    						// }
	    					// });
	    					// jmifdtl_ds.splice(removeThis,1);
						// });
						// treqDtl_ds.sync();
						// $("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
						// $("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
						// $("#tempNS_rs").data("kendoGrid").dataSource.read();
// 
						// jmifdtl_ds2.read();
        			// break;
        		// }
        	// }
        // });
        
	    $(".tempS_phase .wrap-button .buttonLeft button").bind({
	    	click: function(e){
	    				
				isFailed = verifyThisInput(".tempS_phase");
	    		if (isFailed)
	    			return true;
	    			
	    		$.each(issConf_ds.data(),function(index,value){
	    			if (parseFloat(value['req_qty']) == 0) {
	    				alert("Request Qty must be greater than Zero (0).");
	    				isFailed = true;
	    				return true;
	    			}
	    			
	    			if ((parseFloat(value['iss_qty']) > parseFloat(value['req_qty'])) && (parseFloat(value['excess'])) == 1 || value['mat_desc'].indexOf("pipe") >= 0){
	    				alert("Issued Qty must not be greater than Request Qty.");
	    				isFailed = true;
	    				return true;
	    			}
	    			
	    			if (value['drawing_no'] == ""){
	    				alert("Drawing No. must not be blank.");
	    				isFailed = true;
	    				return true;
	    			}
	    			
	    			if ((parseFloat(value['direct_with']) == 1 && parseFloat(value['dlmr_jwrr']) == 1) || 
	    				(parseFloat(value['direct_with']) == 1 && parseFloat(value['excess']) == 1) || 
	    				(parseFloat(value['dlmr_jwrr']) == 1 && parseFloat(value['excess']) == 1)){
	    				alert("Invalid Entry.\n Direct Withdraw/JWRR/DLMR/Excess must not be true at the same.");
	    				isFailed = true;
	    				return true;
	    			}
	    			
	    			if ((issConf_ds.data().length - 1) == index){ //after verification of all records
		    			$("#tempNS_rs .k-grid-toolbar .k-grid-save-changes").trigger("click");
	    			}	    			
	    		});
	    		if (isFailed)
	    			return true;
				grid.data("kendoGrid").setDataSource(issConf_ds);
				grid.data("kendoGrid").dataSource.page(1);
				grid.data("kendoGrid").dataSource.read();
				
	    		$.post(crudService + "manage/issConf_eve",{jmif_no: $("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).text(), disc_code: disc_code, nsuserid: $("#hidden_user").val(), issue_date: kendo.toString(issue_date.value(),"yyyy-MM-dd"), 
	    				issued_by: $("#win_txt2").val(), recvd_by: $("#win_txt4").val(), supp_code: $("#win_txt3").val(), pr_po_no: $("#win_txt5").val(), pl_dn_inv: $("#win_txt6").val()},
		    		function(data){
		    			if ($.trim(data) != "1")
		    				showNotif("Information",data,"info");
		    			else
		    				$("#window").data("kendoWindow").close();
		    		});
	    		// // switch(this.id){
	    			// // case "delButt":
	    				// // if (!confirm("Do you really want to delete this item?")){
	    					// // e.preventDefault();	    					
	    					// // return true;
	    				// // }
// // 	    				
						// // dataRow = grid.data("kendoGrid").dataSource.getByUid(dataItem.uid);
    					// // $("#tempNS_rs").data("kendoGrid").dataSource.remove(dataRow);
						// // treqDtl_ds.sync();
						// // $("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
						// // $("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
						// // $("#tempNS_rs").data("kendoGrid").dataSource.read();
	    				// // return true;
	    			// // break;
	    			// // case "delButt2":
	    				// // if (!confirm("Do you really want to delete this item?")){
	    					// // e.preventDefault();
	    					// // return true;
	    				// // }
// // 	    				
						// // dataRow = grid2.data("kendoGrid").dataSource.getByUid(jmifdtl_di.uid);
    					// // $("#tempS_rs").data("kendoGrid").dataSource.remove(dataRow);
						// // jmifdtl_ds.sync();
						// // $("#tempS_rs").data("kendoGrid").setDataSource(jmifdtl_ds);
						// // $("#tempS_rs").data("kendoGrid").dataSource.page($("#tempS_rs").data("kendoGrid").dataSource.page());
						// // $("#tempS_rs").data("kendoGrid").dataSource.read();
	    				// // return true;
	    			// // break;
	    			// // case "finButt":
	    				// // if (!confirm("Do you want to finalize this transaction?"))
	    					// // return true;
// // 	    					
	    				// // $.post(crudService + "manage/tjmif_fin",{PROGRESS_RECID: dataItem.PROGRESS_RECID, finalized: ($(this).text() == "Finalize") ? 1 : 0, log_user: $("#hidden_user").val()},
	    					// // function(data){	    		
	    						// // if ($.trim(data) != 1)				
									// // showNotif('Warning',data,'warning');
								// // $("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
								// // $("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
								// // $("#tempNS_rs").data("kendoGrid").dataSource.read();
	    					// // });
	    			// // break;
	    			// // default:
	    				// // if (this.id.indexOf("2") < 0){
							// // $(".tempNS_phase .wrap-form input, .tempNS_phase .wrap-form textarea, .tempNS_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							// // jmif_date.enable(true);
							// // supp_code.enable(true);
			    			// // if (this.id == "addButt"){
			    				// // isFailed = false;
								// // $(".tempNS_phase .wrap-form input, .tempNS_phase .wrap-form textarea").val("");
								// // $(".tempNS_phase .wrap-form input").eq(1).select().focus();
								// // $('input[name=win_option1], input[name=win_option2], #win_search').prop("disabled", true);
								// // // $('input[name=win_option2]').prop("disabled", true);
								// // $.get(crudService + "directCall/rcontrol", {trancode: "jmif"},
									// // function(data){
										// // // $("#txt1").prop("disabled", true).addClass("k-state-disabled").val(data.rows[0].prefix + (($.trim(data.rows[0].prefix) == "") ? "" : "-") + kendo.toString(data.rows[0].control_no,"99999") + (($.trim(data.rows[0].suffix) == "") ? "" : "-") + data.rows[0].suffix);
										// // $("#txt1").prop("disabled", true).addClass("k-state-disabled").val(data.rows[0].pono);
										// // $("#textarea").prop("disabled", true).addClass("k-state-disabled");
										// // // valueArr = [data.rows[0].pono, "12/20/2013", "12/19/2013", "12/18/2013", "ship_1", "vessel_1", "ship_inv_1", "", "", "port_1", "remarks_1"];
										// // // $.each(valueArr,function(index, value){
											// // // // $(this).val(valueArr[index]);
											// // // $(".tempNS_phase .wrap-form input, .tempNS_phase .wrap-form textarea").eq(index).prop("value", value);
										// // // });
										// // cMode = "add";
									// // });
			    			// // }else {
								// // $("#txt1").prop("disabled", true).addClass("k-state-disabled");
								// // $("#textarea").prop("disabled", true).addClass("k-state-disabled");
								// // $(".tempNS_phase .wrap-form input").eq(1).select().focus();
								// // cMode = "edit";
							// // }
						// // }else {
							// // if (dataItem.length == 0)
								// // return true;
							// // $(".tempS_phase .wrap-form input, .tempS_phase .wrap-form textarea, .tempS_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							// // po_qty.enable(true);
							// // stock_no.enable(true);
			    			// // if (this.id == "addButt2"){
								// // stock_no.enable(true);
			    				// // isFailed = false;
								// // $(".tempS_phase .wrap-form input, .tempS_phase .wrap-form textarea").val("");
								// // $(".tempS_phase .wrap-form input").eq(0).select().focus();
								// // $('input[name=win_option1], input[name=win_option2], #win_search').prop("disabled", true);
								// // $("#textarea2, #txt8, #txt9, #txt10, #txt11").prop("disabled", true).addClass("k-state-disabled");
								// // cMode = "add";
			    			// // }else {
								// // $(".tempS_phase .wrap-form textarea").select().focus();
								// // $("#textarea2, #txt8, #txt9, #txt10, #txt11").prop("disabled", true).addClass("k-state-disabled");
								// // cMode = "edit";
							// // }
						// // }
						// // $(".wrap-button button").prop("disabled", true).addClass("k-state-disabled");
						// // forDiv();
	    			// // break;
	    		// // }
	    	}
	    });
	    // // $(".tempNS_phase .wrap-form button").bind({
	    	// // click: function(e){
				// // $(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
	    		// // switch(this.id){
	    			// // case "saveButt":
	    				// // if (!confirm("Are you sure you want to save this data?")){
	    					// // e.preventDefault();
	    					// // return true;
	    				// // }
// // 	    				
	    				// // isFailed = verifyThisInput(".tempNS_phase");
			    		// // if (isFailed)
			    			// // return true;
// // 	    				
						// // if (cMode == "add"){
							// // treqDtl_ds.add({PROGRESS_RECID: 0,
											// // jmif_no: $("#txt1").val(),
											// // jmif_date: kendo.toString(jmif_date.value(),"yyyy-MM-dd"),
											// // supp_code: supp_code.value(),
											// // supp_desc: $("#textarea").val(),
											// // pl_dn_inv: $("#txt4").val(),
											// // po_no: $("#txt5").val(),
											// // deliv_by: $("#txt6").val(),
											// // remarks: $("#textarea1").val()});
							// // treqDtl_ds.sync();
							// // return true;
							// // // $("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
							// // // $("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
							// // // $("#tempNS_rs").data("kendoGrid").dataSource.read();
						// // }else
					        // // $.post(crudService + "manage/tjmif",{PROGRESS_RECID: dataItem.PROGRESS_RECID, jmif_no: $("#txt1").val(), jmif_date: kendo.toString(jmif_date.value(),"yyyy-MM-dd"), supp_code: supp_code.value(), supp_desc: $("#textarea").val(), pl_dn_inv: $("#txt4").val(), po_no: $("#txt5").val(), deliv_by: $("#txt6").val(), remarks: $("#textarea1").val()},
					       	    // // function(data){
									// // $("#tempNS_rs").data("kendoGrid").setDataSource(treqDtl_ds);
									// // $("#tempNS_rs").data("kendoGrid").dataSource.page($("#tempNS_rs").data("kendoGrid").dataSource.page());
									// // $("#tempNS_rs").data("kendoGrid").dataSource.read();
					       	    // // });
	    			// // break;
	    			// // default:
	    				// // $(".thisIsRequired").removeClass('thisIsRequired');
		    			// // isFailed = false;
			    		// // grid_change(currRow,"#tempNS_rs");
	    			// // break;
	    		// // }
	    		// // if (isFailed)
	    			// // return true;
				// // $(".tempNS_phase .wrap-form input, .tempNS_phase .wrap-form textarea, .tempNS_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		        // // $("#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
				// // $('input[name=win_option1], input[name=win_option2], #win_search').prop("disabled", false);
				// // jmif_date.enable(false);
				// // supp_code.enable(false);
				// // $("#coverDiv").remove();
	    	// // }
	    // // });
	    // $(".tempS_phase .wrap-form button").bind({
	    	// click: function(e){	    				
				// isFailed = verifyThisInput(".tempS_phase");
	    		// if (isFailed)
	    			// return true;
// 	    			
	    		// var conf = confirm("Apply common fields to other items?\n (Activity Code, Mat. Utilization, System & Sub-System)");
				// $.each(jmifdtl_ds, function(index3, value3){
		        	// // value3.measurement = (value3.measurement == '') ? 0 : measurement.value() 
		        	// // value3.req_qty = (value3.req_qty == '') ? 0 : req_qty.value()
					// if (conf){
			        	// value3.activity_code = $("#win_txt5").val();
			        	// value3.mat_util = mat_util.value();			
			        	// value3.system_no = $("#win_txt14").val();
			        	// value3.sub_system = $("#win_txt15").val();
					// }
					// if (value3.uid == jmifdtl_di.uid){				
						// // var data = $("#tempNS_rs").data("kendoGrid").dataSource.at(index3);
						// // data.set("name", "John Doe");
						// if (req_qty.value() > jmifdtl_di.qty)
							// req_qty.value(jmifdtl_di.qty);
			        	// value3.direct_with = ($("#win_chk1").is(":checked") ? 1 : 0);
			        	// value3.mat_desc = $("#win_textarea").val();
			        	// value3.activity_code = $("#win_txt5").val();
			        	// value3.measurement = measurement.value();
			        	// value3.req_qty = req_qty.value();
			        	// value3.system_no = $("#win_txt14").val();
			        	// value3.sub_system = $("#win_txt15").val();
						// jmifdtl_ds2.read();
						// showNotif("Information","Record successfully updated.","info")
						// return;
					// }
				// });
				// // $(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
	    		// // switch(this.id){
	    			// // case "saveButt2":
	    				// // if (!confirm("Are you sure you want to save this data?")){
	    					// // e.preventDefault();
	    					// // return true;
	    				// // }
// // 	    				
	    				// // isFailed = verifyThisInput(".tempS_phase");
			    		// // if (isFailed)
			    			// // return true;
// // 	    				
						// // if (cMode == "add"){
							// // jmifdtl_ds.add({PROGRESS_RECID: 0,
											// // stock_no: stock_no.value(),
											// // stock_desc: $("#textarea2").val(),
											// // item_code: $("#txt8").val(),
											// // commodity_code: $("#txt9").val(),
											// // uom: $("#txt10").val(),
											// // size: $("#txt11").val(),
											// // req_qty: po_qty.value(),
											// // spl_type: ($("#rad3").is(":checked") ? "" : ($("#rad1").is(":checked") ? "spool" : "em")),
											// // remarks: $("#textarea3").val()});
							// // jmifdtl_ds.sync();
							// // $("#tempS_rs").data("kendoGrid").setDataSource(jmifdtl_ds);
							// // $("#tempS_rs").data("kendoGrid").dataSource.page($("#tempS_rs").data("kendoGrid").dataSource.page());
							// // $("#tempS_rs").data("kendoGrid").dataSource.read();
						// // }else
					        // // $.post(crudService + "manage/tjmifDtl",{PROGRESS_RECID: jmifdtl_di.PROGRESS_RECID, stock_no: stock_no.value(), stock_desc: $("#textarea2").val(), item_code: $("#txt8").val(), commodity_code: $("#txt9").val(), uom: $("#txt10").val(), size: $("#txt11").val(), req_qty: po_qty.value(), spl_type: ($("#rad3").is(":checked") ? "" : ($("#rad1").is(":checked") ? "spool" : "em")), remarks: $("#textarea3").val()},
					       	    // // function(data){
									// // $("#tempS_rs").data("kendoGrid").setDataSource(jmifdtl_ds);
									// // $("#tempS_rs").data("kendoGrid").dataSource.page($("#tempS_rs").data("kendoGrid").dataSource.page());
									// // $("#tempS_rs").data("kendoGrid").dataSource.read();
					       	    // // });
	    			// // break;
	    			// // default:
	    				// // $(".thisIsRequired").removeClass('thisIsRequired');
		    			// // isFailed = false;
			    		// // grid_change(currRow2,"#tempS_rs");
	    			// // break;
	    		// // }
	    		// // if (isFailed)
	    			// // return true;
				// // $(".tempS_phase .wrap-form input, .tempS_phase .wrap-form textarea, .tempS_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		        // // $("#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
				// // $('input[name=win_option1], input[name=win_option2], #win_search').prop("disabled", false);
				// // stock_no.enable(false);
				// // po_req_qty.enable(false);
				// // $("#coverDiv").remove();
	    	// }
	    // });
		// // $(".wrap-header input[name=win_option2]").bind({
			// // click: function(e){
				// // sentValue = ($('input[name=win_option2]:checked').index('input[name=win_option2]') == 2) ? 1 : ($('input[name=win_option2]:checked').index('input[name=win_option2]') == 1) ? 0 : "";
				// // $("#tempNS_rs").data("kendoGrid").dataSource.read();
			// // }
		// // });
		// $(".wrap-header input[name=win_option1]").bind({
			// click: function(e){
				// switch(this.id){
					// case "win_option1":
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
		// // $("#tempNSHead").css({"min-height": ((parseInt($("#tempNSHead .wrap-form").height()) + 12) + "px")});
		// $("#tempSHead").css({"min-height": ((parseInt($("#tempSHead .wrap-form").height()) + 12) + "px")});
	});
</script>