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
	#window .k-grid-header {
		padding-right: 17px !important;
	}
	#window .k-grid-content {
		overflow-y: scroll !important;
		height: 316px;
	}
</style>
<div id="win_main-wrapper" style="width: 100%;">
	<div class="jmifdtl_phase" style="margin-top: 5px !important;">
		<div id="jmifDtlHead" style="min-height: 290px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 27.9%;float:right;height: auto;display: block;">
				<fieldset>
					<legend> Engg. MTO Entry: </legend>
					<ul class="formLeft_qms" style="width: 100%;">
						<li>
							<label class="title" for="win_txt1" style="width: 105px;">Ref. Rec. No.:</label><input type="text" name="win_txt1" id="win_txt1" class="k-textbox" required style="width: 145px;" />
						</li>
						<li>
							<label class="title" for="win_txt2" style="width: 105px;">Ref. Rec. Date:</label><input type="text" name="win_txt2" id="win_txt2" required style="width: 145px;" />
						</li>
						<li>
							<label class="title" for="win_txt3" style="width: 105px;">Supp. Code:</label><input type="text" name="win_txt3" id="win_txt3" class="k-textbox" required style="width: 145px;" />
						</li>
						<li>
							<label class="title" for="win_txt4" style="width: 105px;">Supp. Desc.:</label><input type="text" name="win_txt4" id="win_txt4" class="k-textbox" required style="width: 145px;" />
						</li>
						<li>
							<label class="title" for="win_txt5" style="width: 105px;">PR/PO No.:</label><input type="text" name="win_txt5" id="win_txt5" class="k-textbox" style="width: 145px;"/>
						</li>
						<li>
							<label class="title" for="win_txt6" style="width: 105px;">PL/DN/INV No.:</label><input type="text" name="win_txt6" id="win_txt6" class="k-textbox" style="width: 145px;"/>
						</li>
						<li>
							<label class="title" for="win_txt7" style="width: 105px;">Rec. By:</label><input type="text" name="win_txt7" id="win_txt7" class="k-textbox" style="width: 145px;"/>
						</li>
						<li>
							<label class="title" for="win_txt8" style="width: 105px;">Rec. Date:</label><input type="text" name="win_txt8" id="win_txt8" style="width: 145px;"/>
						</li>
						<li>
							<label class="title" for="win_txt9" style="width: 105px;">QC MRIR No.:</label><input type="text" name="win_txt9" id="win_txt9" class="k-textbox" style="width: 145px;"/>
						</li>
						<li>
							<label class="title" for="win_txt10" style="width: 105px;">QC MRIR Date:</label><input type="text" name="win_txt10" id="win_txt10" style="width: 145px;"/>
						</li>
						<li>
							<label class="title" for="win_txt11" style="width: 105px;">RFI No.:</label><input type="text" name="win_txt11" id="win_txt11" class="k-textbox" style="width: 145px;"/>
						</li>
						<li>
							<label class="title" for="win_txt12" style="width: 105px;">RFI Date:</label><input type="text" name="win_txt12" id="win_txt12" style="width: 145px;"/>
						</li>
						<li>
							<label class="title" for="win_txt16" style="width: 105px;">Ref. Iss. No.:</label><input type="text" name="win_txt16" id="win_txt16" class="k-textbox" style="width: 145px;"/>
						</li>
						<li>
							<label class="title" for="win_txt13" style="width: 105px;">Ref. Remarks:</label><input type="text" name="win_txt13" id="win_txt13" class="k-textbox" style="width: 145px;"/>
						</li>
						<li style="text-align: right;">
							<hr style="margin-bottom: 5px;" />
							<button class="k-button" id="clearButt2">Clear</button>						
						</li>
					</ul>
				</fieldset>
			</div>
		    <div class="wrap-grid demo-section" style="width: 69%;margin-left: 0;height: auto;">
		        <div id="twjrr_engg_rs"></div>
				<fieldset style="margin-top: 5px;">
					<ul style="width: 100%;list-style: none;">
						<li>
							<label for="win_textarea" style="width: 100%;">Material Description</label>
						</li>
						<li>
							<ul style="width: 170px;float: right;">									
								<li>
									<label class="title" for="win_txt14" style="width: 115px;">Total Item Count:</label><input type="text" name="win_txt14" id="win_txt14" disabled class="k-textbox k-state-disabled" style="width: 50px;"/>
									<label class="title" for="win_txt15" style="width: 115px;">Total Selected:</label><input type="text" name="win_txt15" id="win_txt15" disabled class="k-textbox k-state-disabled" style="width: 50px;"/>
								</li>
							</ul>
							<textarea name="win_textarea" id="win_textarea" disabled class="k-state-disabled" cols="20" rows="3" style="resize: none;width: 475px;margin: 0;"></textarea>
						</li>
					</ul>
				</fieldset>
		    </div>
		</div>
		<div class="wrap-button demo-section">
			<div class="buttonLeft">
	        	<button class="k-button mainEve" id="addButt">Add</button>
	        	<button class="k-button mainEve" id="manButt">Manual</button>
	        	<button class="k-button mainEve" id="clearButt">Clear</button>
	        	<button class="k-button mainEve" id="compButt">Completed Materials</button>
	        	<button class="k-button mainEve" id="confButt">Confirm</button>
	        	<label for="win_chk1" style="display: inline-block;line-height: 25px;vertical-align: middle;"><input type="checkbox" name="win_chk1" id="win_chk1" style="vertical-align: middle;" /> Check All</label>
	       	</div>
			<!-- <div class="buttonRight">
	        	<button class="k-button mainEve" id="closeButt">Close</button>
	       	</div> -->				
		</div>
	</div>
	<input type="hidden" name="totalRows_w" id="totalRows_w" value="<?php echo (isset($_POST['totalRows'])) ? $_POST['totalRows'] : ""; ?>" />
</div>
<script type="text/javascript">
	function grid_change(e,grid){
		if (typeof e == "undefined")
			e = grid;
	    var selectedRows3 = e.select();
	    var selectedDataItems = [];
	    for (var i = 0; i < selectedRows3.length; i++) {
	      dataItem3 = e.dataItem(selectedRows3[i]);
		    // $("#win_txt1").data("kendoComboBox").value(dataItem3.stock_no);
		    // $("#win_textarea").val(dataItem3.stock_desc);
		    // $("#win_txt2").val(dataItem3.item_code);
		    // $("#win_txt3").val(dataItem3.commodity_code);
		    // $("#win_txt4").val(dataItem3.uom);
		    // $("#win_txt5").val(dataItem3.size);
		    // $("#win_txt6").data("kendoNumericTextBox").value(dataItem3.jwrr_qty);
		    // $("#win_textarea1").val(dataItem3.remarks);
		    // $("#" + ((dataItem3.spl_type.toLowerCase() == "spool") ? "win_rad1" : "win_rad3")).prop("checked", true);
		    // if (dataItem3.spl_type.toLowerCase() != "spool")
		    	// $("#" + ((dataItem3.spl_type.toLowerCase() == "em") ? "win_rad2" : "win_rad3")).prop("checked", true);
	    }   
	}
	function forDiv(){
		var container = $("#twjrr_engg_rs");
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
		    filterFArr_twjrr_engg = [], filterOArr_twjrr_engg = [], filterVArr_twjrr_engg = [], sentValue_twjrr_engg = "", currRow = "", currRow2 = "", cMode = "", twjrr_engg_di = '', isFailed = false,
		    fieldSort = "", dirSort = "", query = "", checkedIds_engg = {},			
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
	    
        var twjrr_engg_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/ttMTO",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/ttMTO",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						// showNotif('Warning',jqXHR.responseText,'warning');
						console.log(jqXHR.responseText);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						// else {
							// // alert("romel");
							// // twjrr_engg_ds.sync();
							// $("#twjrr_engg_rs").data("kendoGrid").setDataSource(twjrr_engg_ds);
							// $("#twjrr_engg_rs").data("kendoGrid").dataSource.page($("#twjrr_engg_rs").data("kendoGrid").dataSource.page());
							// $("#twjrr_engg_rs").data("kendoGrid").dataSource.read();
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
                    url: crudService + "manage/ttMTO",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						showNotif('Warning',jqXHR.responseText,'warning');
	                	// if (jqXHR.responseText != '1')
							// showNotif('Warning',jqXHR.responseText,'warning');
						// else {
							// alert("romel");
							// // twjrr_engg_ds.sync();
							// // $("#twjrr_engg_rs").data("kendoGrid").setDataSource(twjrr_engg_ds);
							// // $("#twjrr_engg_rs").data("kendoGrid").dataSource.page($("#twjrr_engg_rs").data("kendoGrid").dataSource.page());
							// // $("#twjrr_engg_rs").data("kendoGrid").dataSource.read();
						// }
	                }
                },
                destroy: {
                    url: crudService + "remove/ttMTO",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						showNotif('Warning',jqXHR.responseText,'warning');
	                	// // if (jqXHR.responseText != '1')
							// // showNotif('Warning',jqXHR.responseText,'warning');
						// // else {
							// // alert("romel");
							// // // twjrr_engg_ds.sync();
							// // // $("#twjrr_engg_rs").data("kendoGrid").setDataSource(twjrr_engg_ds);
							// // // $("#twjrr_engg_rs").data("kendoGrid").dataSource.page($("#twjrr_engg_rs").data("kendoGrid").dataSource.page());
							// // // $("#twjrr_engg_rs").data("kendoGrid").dataSource.read();
						// // }
	                }
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_twjrr_engg[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_twjrr_engg[index] = this.operator;
				      		filterVArr_twjrr_engg[index] = valForm;
				      	});
				    }
				    // if ($('input[name=win_option1]:checked').index('input[name=win_option1]') > 0)
				     	// filterFArr_twjrr_engg[filterFArr_twjrr_engg.length] = optionArr[$('input[name=win_option1]:checked').index('input[name=win_option1]')] + ";" + sentValue + ";eq";
				    // if ($('input[name=win_option2]:checked').index('input[name=win_option2]') > 0)
				     	// filterFArr_twjrr_engg[filterFArr_twjrr_engg.length] = "finalized;1;" + (($('input[name=win_option2]:checked').index('input[name=win_option2]') == 1) ? "neq" : "eq" );				     
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_twjrr_engg,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "logdate"),
					    operator: (($(data.filter).length > 0) ? filterOArr_twjrr_engg : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_twjrr_engg : sentValue_twjrr_engg),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    loguser: $("#hidden_user").val()
			        }
			      }else
			      	data['loguser'] = $("#hidden_user").val();
			      	data['setType'] = (type == "update") ? type : data['setType']; 
			      	return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            // pageSize: 6,
            // serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
			autoSync: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_twjrr_engg.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue = "";
					    filterFArr_twjrr_engg = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        sys_man: { type: "string", editable: false },
                        area_no: { type: "string", editable: false },
                        drawing_no: { type: "string", editable: false },
                        sheet_no: { type: "string", editable: false },
                        rev_no: { type: "string", editable: false },
                        spool_no: { type: "string", editable: false },
                        spl_type: { type: "string", editable: false },
                        isc_no: { type: "string", editable: false },
                        item_code: { type: "string", editable: false },
                        size: { type: "string", editable: false },
                        qty: { type: "number", editable: false },
                        lcm: { type: "number", editable: false },
                        lselect: { type: "number", editable: false },
                        ref_rec_qty: { type: "number", editable: false },
                        qty_comp: { type: "number", editable: false },
                        rec_qty: { type: "number" },
                        dtl_rem: { type: "string" }
                    }
                },
                total: function(response) {
				   	return (($(response.rows[0]).length > 0) ? response.rows[0].total : 0);
			    }
            },
            change: function(e) {
            	if ($(e.items).length == 0)
            		return true;
            		
            	$("#win_txt14").val($(e.items).length);
            }
        });

	    var addExtraStylingToGrid_window = function () {
			$("#twjrr_engg_rs").data("kendoGrid").select("tr:eq(" + (parseInt($("#totalRows_w").val()) + 1) + ")");
	        $("#twjrr_engg_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }
	        );
        	filterFArr_twjrr_engg = [];
	    };

        var twjrr_engg_rs = $("#twjrr_engg_rs").kendoGrid({
            dataSource: twjrr_engg_ds,
            selectable: "row",
            pageable: false,
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: true,
			// toolbar: ["save","cancel"],
            resizable: true,
            filterable: {
                extra: false
            },
            columns: [
               {field: "sys_man",title: "S/M",width: 49},
               {field: "area_no",title: "Area No.", width: 89},
               {field: "drawing_no",title: "ISO No.", width: 117},
               {field: "sheet_no",title: "Sht. No.", width: 89},
               {field: "rev_no",title: "Rev. No.", width: 79},
               {field: "spool_no",title: "Spool No.", width: 110},
               {field: "spl_type",title: "Spool Type", width: 110},
               {field: "isc_no",title: "Item No.", width: 110},
               {field: "item_code",title: "Item Code", width: 110},
               {field: "size",title: "Size", width: 110},
               {field: "qty",title: "MTO Qty.", width: 110},
               {field: "lcm",title: "CM", width: 110},
               {field: "lselect",title: " ", width: 110},
               {field: "ref_rec_qty",title: "Already Received", width: 128},
               {field: "qty_comp",title: "Bal. To Receive", width: 128},
               {field: "rec_qty",title: "Qty. To Receive", width: 128},
               {field: "dtl_rem",title: "Dtl. Remarks", width: 110},
			   {
					headerTemplate:'<input id="win_Chk1" name="win_Chk1" type="checkbox" />',
					title: ' ',
                    template: kendo.template("<input type='checkbox' name='#= PROGRESS_RECID #' id='#= PROGRESS_RECID #' disabled />"),
					width: 24
			   }
           ],
           change: function(e){
           		currRow = this;
			    selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        twjrr_engg_di = this.dataItem(selectedRows[i]);
				    var rowIndex = $("tr", this.tbody).index(selectedRows[i]),
				        row = this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
						checkedIds_engg[twjrr_engg_di.PROGRESS_RECID] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(17).find("input").is(":checked");
						if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(17).find("input").is(":checked") == false)
							$("#win_Chk1").prop("checked",false);
		           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(17).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(17).find("input").is(":checked"));
		           	
					objLen = 0;
					$.each(checkedIds_engg, function(index,value){
						if (checkedIds_engg[index])
							objLen++;
					});
            		$("#win_txt15").val(objLen);
		    		// $("#twjrr_engg_rs .k-grid-toolbar .k-grid-save-changes").trigger( "click" );
			    }
			    // $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea, .jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea").val("");
			    // grid_change(currRow,"#twjrr_engg_rs");
			    // jmifdtl_ds.read();
           },
           dataBound: addExtraStylingToGrid_window
        });
		// $("#twjrr_engg_rs .k-grid-toolbar").hide();
        insertGridTitle('#twjrr_engg_rs','Engineering MTO (Piping)');
		$('#twjrr_engg_rs tbody').on('click',':checkbox',function(){
			if (this.checked){
				var grid2 = $('#twjrr_engg_rs').data("kendoGrid");
			    var row = $(this).closest('tr'),
			        rowIndex = $("tr", grid2.tbody).index(row),
			        row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
			    grid2.select(row);
			}else
				$('tr.k-state-selected','#twjrr_engg_rs').removeClass('k-state-selected');
		});
		$("#win_Chk1, #win_chk1").click(function () {
			$("#win_Chk1").prop("checked", this.checked);
			$("#win_chk1").prop("checked", this.checked);
			var grid2 = $('#twjrr_engg_rs').data("kendoGrid")
			    currStat = this.checked;
		    $("#twjrr_engg_rs tbody input:checkbox").each(function(index,value){
		    	$(this).prop("checked", currStat);
			    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
			    var dataItem2 = grid2.dataItem(row);
				checkedIds_engg[dataItem2.PROGRESS_RECID] = currStat;
				if (currStat){
				    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#twjrr_engg_rs').addClass('k-state-selected');
				}else
					$('tr.k-state-selected','#twjrr_engg_rs').removeClass('k-state-selected');
			});
			objLen = 0;
			$.each(checkedIds_engg, function(index,value){
				if (checkedIds_engg[index])
					objLen++;
			});
    		$("#win_txt15").val(objLen);
		});
        
        var processOnClose = function(){
        	if ($("#win2_txt1").val() != ""){
        		if (confirm("Do you want to CLEAR the existing records?")){
        			twjrr_engg_ds.remove({PROGRESS_RECID: 0});
        			twjrr_engg_ds.sync();
        		}
        		// open_preloader();
        		$.post(crudService + "manage/ttMTO",{drawing_no: $("#win2_txt1").val(), sheet_no: $("#win2_txt2").val(), loguser: $("#hidden_user").val(), setType: "add"},
        			function(data){
        				showNotif("Information",data,"info");
        				twjrr_engg_ds.read();
        				// close_preloader();
        			});
        	}
        };
        
        var saveOnClose = function(){    
        	if ($("#win2_txt1").val() != ""){
	    		twjrr_engg_ds.add({area_no: $("#win2_txt1").val(),
	    						   drawing_no: $("#win2_txt2").val(),
	    						   sheet_no: $("#win2_txt3").val(),
	    						   rev_no: $("#win2_txt4").val(),
	    						   spool_no: $("#win2_txt5").val(),
	    						   spl_type: $("#win2_txt6").val(),
	    						   item_code: $("#win2_txt7").val(),
	    						   commodity_code: $("#win2_txt8").val(),
	    						   size: $("#win2_txt9").val(),
	    						   uom: $("#win2_txt10").val(),
	    						   mat_desc: $("#win2_textarea").val(),
	    						   sys_man: "MAN",
	    						   setType: "manual",
	    						   PROGRESS_RECID: 0});
	    		twjrr_engg_ds.sync();
	    	}
        }
        
        var procOnClose2 = function(){
        	twjrr_engg_ds.read();
        }
		$("#win_txt2, #win_txt8, #win_txt10, #win_txt12").kendoDatePicker({
			format: "MM/dd/yyyy",
			enable: false
		});
		var ref_rec_date = $("#win_txt2").data("kendoDatePicker");
		var rec_date = $("#win_txt8").data("kendoDatePicker");
		var qcmrir_date = $("#win_txt10").data("kendoDatePicker");
		var rfi_date = $("#win_txt12").data("kendoDatePicker");
		$("#window button").bind({
        	click: function(e){
        		switch(this.id){
        			case "clearButt2":
        				// if ($("#window .formLeft_qms input[value]").length > 0)
        				if (confirm("Clear above fields?"))
        					$("#window .formLeft_qms input").val("");
        				break;
        			case "addButt":	    
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
        				break;
        			case "manButt":	    
						$("#subWindow").data("kendoWindow").setOptions({
						    title: "Manual Reference",
						    width: "314px",
						    height: "auto",
						    close: saveOnClose
						});
						$("#subWindow").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/webapps/qms/index/index/qmsUemto_pip2",
							type: "POST",
							data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
						});
						$("#subWindow").data("kendoWindow").center().open();
        				break;
        			case "clearButt":
		        		if (confirm("Do you want to CLEAR the existing records?")){
		        			// twjrr_engg_ds.remove({PROGRESS_RECID: 0});
		        			// twjrr_engg_ds.sync();							$.post(crudService + "remove/ttMTO",{PROGRESS_RECID: 0, loguser: $("#hidden_user").val()},
								function(data){
									showNotif("Information",data,"info");
		        					twjrr_engg_ds.read();		        					
            						$("#win_txt14").val(0);
								});
		        		}
        				break;
        			case "compButt":	    
						$("#subWindow").data("kendoWindow").setOptions({
						    title: "ENGG PIPING MTO (Completed Matarials)",
						    width: "700px",
						    height: "auto",
						    close: procOnClose2
						});
						$("#subWindow").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/webapps/qms/index/index/qmsUemto_pip1",
							type: "POST",
							data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val(), totalRows: ((parseInt($("#totalRows_w").val()) + twjrr_engg_ds._data.length) + 1)}
						});
						$("#subWindow").data("kendoWindow").center().open();
        				break;
        			default:
	        			isFailed = verifyThisInput("#jmifDtlHead > .wrap-form");
				    		if (isFailed)
				    			return true;
						var pRecid = "";				    			
						if (parseInt($("#win_txt15").val()) > 0){
				    		if (confirm("Do you want to CONFIRM all selected records?")){
				    			$.each(checkedIds_engg, function(index,value){
				    				if (value){
										pRecid = ($.trim(pRecid) == "") ? index : ($.trim(pRecid) + "," + index);
				    					$.each(twjrr_engg_ds.data(), function(index2, value2){					    						
				    						if (index == value2.PROGRESS_RECID && (parseInt(value2.rec_qty) == 0 || value2.rec_qty == null)){
												showNotif("Information","Zero quantity found in QTY TO RECEIVED column!","info");
												isFailed = true;
				    							return false;
				    						}else
				    							isFailed = false;
				    					});
				    				}
				    				if (isFailed)
				    					return false;
				    			});
				    		}
				    	}else{
							showNotif("Information","Nothing seems to be selected!","info");
							isFailed = true;
						}
							
			    		if (isFailed)
			    			return true;
						$.post(crudService + "manage/ttMTO",{setType: "ps", ip_refrecno: $("#win_txt1").val(), ip_refrecdate: kendo.toString(ref_rec_date.value(),"yyyy-MM-dd"), ip_suppcode: $("#win_txt3").val(), ip_suppdesc: $("#win_txt4").val(), ip_prpono: $("#win_txt5").val(), ip_pldninv: $("#win_txt6").val(), ip_recby: $("#win_txt7").val(), ip_recdate: kendo.toString(rec_date.value(),"yyyy-MM-dd"), ip_qcmrirno: $("#win_txt9").val(), ip_qcmrirdate: kendo.toString(qcmrir_date.value(),"yyyy-MM-dd"), ip_rfino: $("#win_txt11").val(), ip_rfidate: kendo.toString(rfi_date.value(),"yyyy-MM-dd"), ip_refissno: $("#win_txt16").val(), ip_refrem: $("#win_txt13").val(), ip_loguser: $("#hidden_user").val(), pRecid: pRecid},
							function(data){
								if (data != '1')
									showNotif("Information",data,"info");
								twjrr_engg_ds.read();
							});
        				break;
        		}
        	}
        });
                    
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
        
        // var jmifdtl_ds2 = new kendo.data.DataSource({
            // data: jmifdtl_ds,
            // pageSize: 11,
            // schema: {
                // data: function(data) {
                    // return data || [];
                // },
                // errors: function(data){
               	    // if (filterFArr_twjrr_engg.length > 0 && $(data.rows).length == 0){
               		    // notif("info","Information","No records found!");
					    // sentValue = "";
					    // filterFArr_twjrr_engg = [];
					    // $("form.k-filter-menu button[type='reset']").trigger("click");
               	    // }
                // },
                // model: {
               		// id: "PROGRESS_RECID",
                    // fields: {
                   	    // PROGRESS_RECID: { type: "number", editable: false },
                        // jmif_no: { type: "string" },
                        // stock_no: { type: "string" },
                        // item_code: { type: "string" },
                        // commodity_code: { type: "string" },
                        // size: { type: "string" },
                        // req_qty: { type: "string" }
                    // }
                // },
                // total: function(response) {
				   	// return parseInt(($(response).length > 0) ? $(response).length : 0);
			    // }
            // }
        // });
//                                 
	    // var addExtraStylingToGrid2 = function () {
			// $("#jmifdtl_rs").data("kendoGrid").select("tr:eq(" + (twjrr_engg_ds._data.length + 2) + ")");
	        // $("#jmifdtl_rs > .k-grid-content > table > tbody > tr").hover(
	            // function() {
	                // $(this).toggleClass("k-state-hover");
	            // }			        
	        // );
        	// filterFArr_jmifdtl = [];
	    // };
//         
        // var grid2 = $("#jmifdtl_rs").kendoGrid({
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
               // {field: "jmif_no",title: "JMIF No.",width: 85},
               // {field: "stock_no",title: "Stock No.", width: 89},
               // {field: "item_code",title: "Item Code", width: 117},
               // {field: "commodity_code",title: "Comm. Code", width: 89},
               // {field: "size",title: "Size", width: 79},
               // {field: "req_qty",title: "Quantity", width: 110}
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
			    // grid_change(currRow2,"#jmifdtl_rs");
           // },
           // dataBound: addExtraStylingToGrid2
        // });
        // insertGridTitle('#jmifdtl_rs','Material Request');        	    	            
// 
	    // $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		// $("#win_txt6").removeClass('k-state-disabled').kendoNumericTextBox({
			// format: "n",
			// enable: false
		// });
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
		// $("#win_txt1").removeClass('k-state-disabled').kendoComboBox({
			// enable: false,
            // filter: "contains",
            // placeholder: "Select material...",
            // dataTextField: "stock_no",
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
            		// $(".k-input").eq(3).val("").select().focus();
            		// $("#win_textarea").val("");
				// }else{
            		// $("#win_textarea").val(this.value().split(",")[0]);
            		// $("#win_txt4").val(this.value().split(",")[1]);
            		// $("#win_txt5").val(this.value().split(",")[2]);
            	// }
            // }
		// });
		// var jmif_qty = $("#win_txt6").data("kendoNumericTextBox");
		// // var supp_code = $("#txt3").data("kendoComboBox");
		// var stock_no = $("#win_txt1").data("kendoComboBox");
// 		
		// $(".jmif_phase .wrap-button button").bind({
        	// click: function(e){
        		// switch(this.id){
        			// case "downButt":
						// for (var i = 0; i < selectedRows.length; i++) {
				        	// down_di = currRow.dataItem(selectedRows[i]);
				        	// down_di['jwrr_qty'] = down_di.req_qty;
				        	// down_di['remarks'] = '';
// 		
							// jmifdtl_ds.push(down_di);
							// indexArr.push(down_di);
					        // $.post(crudService + "remove/tjmif",{PROGRESS_RECID: down_di.PROGRESS_RECID},
					       	    // function(data){
									// twjrr_engg_ds.sync();
									// $("#twjrr_engg_rs").data("kendoGrid").setDataSource(twjrr_engg_ds);
									// $("#twjrr_engg_rs").data("kendoGrid").dataSource.page($("#twjrr_engg_rs").data("kendoGrid").dataSource.page());
									// $("#twjrr_engg_rs").data("kendoGrid").dataSource.read();
					       	    // });
						// }
						// jmifdtl_ds2.sync();
						// $("#jmifdtl_rs").data("kendoGrid").dataSource.data(jmifdtl_ds);
						// $("#jmifdtl_rs").data("kendoGrid").dataSource.page($("#jmifdtl_rs").data("kendoGrid").dataSource.page());
						// $("#jmifdtl_rs").data("kendoGrid").dataSource.read();
// 						
						// jmif_qty.enable(true);
						// $("#win_textarea1").prop("disabled", false).removeClass("k-state-disabled");
						// $(".jmifdtl_phase .wrap-form button, .wrap-button .buttonLeft button").prop("disabled", false).removeClass("k-state-disabled");
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
							// twjrr_engg_ds.add(postInfo);
	    					// var removeThis;
	    					// $.each(jmifdtl_ds, function(index3, value3){
	    						// if (value3.uid == value.uid){
	    							// removeThis = index3;
	    							// return;
	    						// }
	    					// });
	    					// jmifdtl_ds.splice(removeThis,1);
						// });
						// twjrr_engg_ds.sync();
						// $("#twjrr_engg_rs").data("kendoGrid").setDataSource(twjrr_engg_ds);
						// $("#twjrr_engg_rs").data("kendoGrid").dataSource.page($("#twjrr_engg_rs").data("kendoGrid").dataSource.page());
						// $("#twjrr_engg_rs").data("kendoGrid").dataSource.read();
// 
						// jmifdtl_ds2.read();
        			// break;
        		// }
        	// }
        // });
//         
	    // $(".jmifdtl_phase .wrap-button .buttonLeft button").bind({
	    	// click: function(e){
	    		// $.post(crudService + "manage/setTJWRR",{jsonData: JSON.stringify({item: jmifdtl_ds2.data()}), jwrr_no: $("#txt1").val(), disc_code: "pip", jmif_no: $("#textarea1").val(), log_user: $("#hidden_user").val()},
		    		// function(data){
		    			// if ($.trim(data) != "1")
		    				// showNotif("Information",data,"info");
		    			// else
		    				// $("#window").data("kendoWindow").close();
		    		// });
// 
	    		// // switch(this.id){
	    			// // case "delButt":
	    				// // if (!confirm("Do you really want to delete this item?")){
	    					// // e.preventDefault();	    					
	    					// // return true;
	    				// // }
// // 	    				
						// // dataRow = grid.data("kendoGrid").dataSource.getByUid(dataItem.uid);
    					// // $("#twjrr_engg_rs").data("kendoGrid").dataSource.remove(dataRow);
						// // twjrr_engg_ds.sync();
						// // $("#twjrr_engg_rs").data("kendoGrid").setDataSource(twjrr_engg_ds);
						// // $("#twjrr_engg_rs").data("kendoGrid").dataSource.page($("#twjrr_engg_rs").data("kendoGrid").dataSource.page());
						// // $("#twjrr_engg_rs").data("kendoGrid").dataSource.read();
	    				// // return true;
	    			// // break;
	    			// // case "delButt2":
	    				// // if (!confirm("Do you really want to delete this item?")){
	    					// // e.preventDefault();
	    					// // return true;
	    				// // }
// // 	    				
						// // dataRow = grid2.data("kendoGrid").dataSource.getByUid(jmifdtl_di.uid);
    					// // $("#jmifdtl_rs").data("kendoGrid").dataSource.remove(dataRow);
						// // jmifdtl_ds.sync();
						// // $("#jmifdtl_rs").data("kendoGrid").setDataSource(jmifdtl_ds);
						// // $("#jmifdtl_rs").data("kendoGrid").dataSource.page($("#jmifdtl_rs").data("kendoGrid").dataSource.page());
						// // $("#jmifdtl_rs").data("kendoGrid").dataSource.read();
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
								// // $("#twjrr_engg_rs").data("kendoGrid").setDataSource(twjrr_engg_ds);
								// // $("#twjrr_engg_rs").data("kendoGrid").dataSource.page($("#twjrr_engg_rs").data("kendoGrid").dataSource.page());
								// // $("#twjrr_engg_rs").data("kendoGrid").dataSource.read();
	    					// // });
	    			// // break;
	    			// // default:
	    				// // if (this.id.indexOf("2") < 0){
							// // $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea, .jmif_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							// // jmif_date.enable(true);
							// // supp_code.enable(true);
			    			// // if (this.id == "addButt"){
			    				// // isFailed = false;
								// // $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea").val("");
								// // $(".jmif_phase .wrap-form input").eq(1).select().focus();
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
											// // // $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea").eq(index).prop("value", value);
										// // // });
										// // cMode = "add";
									// // });
			    			// // }else {
								// // $("#txt1").prop("disabled", true).addClass("k-state-disabled");
								// // $("#textarea").prop("disabled", true).addClass("k-state-disabled");
								// // $(".jmif_phase .wrap-form input").eq(1).select().focus();
								// // cMode = "edit";
							// // }
						// // }else {
							// // if (dataItem.length == 0)
								// // return true;
							// // $(".jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea, .jmifdtl_phase .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
							// // po_qty.enable(true);
							// // stock_no.enable(true);
			    			// // if (this.id == "addButt2"){
								// // stock_no.enable(true);
			    				// // isFailed = false;
								// // $(".jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea").val("");
								// // $(".jmifdtl_phase .wrap-form input").eq(0).select().focus();
								// // $('input[name=win_option1], input[name=win_option2], #win_search').prop("disabled", true);
								// // $("#textarea2, #txt8, #txt9, #txt10, #txt11").prop("disabled", true).addClass("k-state-disabled");
								// // cMode = "add";
			    			// // }else {
								// // $(".jmifdtl_phase .wrap-form textarea").select().focus();
								// // $("#textarea2, #txt8, #txt9, #txt10, #txt11").prop("disabled", true).addClass("k-state-disabled");
								// // cMode = "edit";
							// // }
						// // }
						// // $(".wrap-button button").prop("disabled", true).addClass("k-state-disabled");
						// // forDiv();
	    			// // break;
	    		// // }
	    	// }
	    // });
	    // // $(".jmif_phase .wrap-form button").bind({
	    	// // click: function(e){
				// // $(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
	    		// // switch(this.id){
	    			// // case "saveButt":
	    				// // if (!confirm("Are you sure you want to save this data?")){
	    					// // e.preventDefault();
	    					// // return true;
	    				// // }
// // 	    				
	    				// // isFailed = verifyThisInput(".jmif_phase");
			    		// // if (isFailed)
			    			// // return true;
// // 	    				
						// // if (cMode == "add"){
							// // twjrr_engg_ds.add({PROGRESS_RECID: 0,
											// // jmif_no: $("#txt1").val(),
											// // jmif_date: kendo.toString(jmif_date.value(),"yyyy-MM-dd"),
											// // supp_code: supp_code.value(),
											// // supp_desc: $("#textarea").val(),
											// // pl_dn_inv: $("#txt4").val(),
											// // po_no: $("#txt5").val(),
											// // deliv_by: $("#txt6").val(),
											// // remarks: $("#textarea1").val()});
							// // twjrr_engg_ds.sync();
							// // return true;
							// // // $("#twjrr_engg_rs").data("kendoGrid").setDataSource(twjrr_engg_ds);
							// // // $("#twjrr_engg_rs").data("kendoGrid").dataSource.page($("#twjrr_engg_rs").data("kendoGrid").dataSource.page());
							// // // $("#twjrr_engg_rs").data("kendoGrid").dataSource.read();
						// // }else
					        // // $.post(crudService + "manage/tjmif",{PROGRESS_RECID: dataItem.PROGRESS_RECID, jmif_no: $("#txt1").val(), jmif_date: kendo.toString(jmif_date.value(),"yyyy-MM-dd"), supp_code: supp_code.value(), supp_desc: $("#textarea").val(), pl_dn_inv: $("#txt4").val(), po_no: $("#txt5").val(), deliv_by: $("#txt6").val(), remarks: $("#textarea1").val()},
					       	    // // function(data){
									// // $("#twjrr_engg_rs").data("kendoGrid").setDataSource(twjrr_engg_ds);
									// // $("#twjrr_engg_rs").data("kendoGrid").dataSource.page($("#twjrr_engg_rs").data("kendoGrid").dataSource.page());
									// // $("#twjrr_engg_rs").data("kendoGrid").dataSource.read();
					       	    // // });
	    			// // break;
	    			// // default:
	    				// // $(".thisIsRequired").removeClass('thisIsRequired');
		    			// // isFailed = false;
			    		// // grid_change(currRow,"#twjrr_engg_rs");
	    			// // break;
	    		// // }
	    		// // if (isFailed)
	    			// // return true;
				// // $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea, .jmif_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		        // // $("#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
				// // $('input[name=win_option1], input[name=win_option2], #win_search').prop("disabled", false);
				// // jmif_date.enable(false);
				// // supp_code.enable(false);
				// // $("#coverDiv").remove();
	    	// // }
	    // // });
	    // $(".jmifdtl_phase .wrap-form button").bind({
	    	// click: function(e){
				// $.each(jmifdtl_ds, function(index3, value3){
					// if (value3.uid == jmifdtl_di.uid){				
						// // var data = $("#twjrr_engg_rs").data("kendoGrid").dataSource.at(index3);
						// // data.set("name", "John Doe");
			        	// value3.jwrr_qty = jmif_qty.value();
			        	// value3.remarks = $("#win_textarea1").val();
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
	    				// // isFailed = verifyThisInput(".jmifdtl_phase");
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
											// // jmif_qty: po_qty.value(),
											// // spl_type: ($("#rad3").is(":checked") ? "" : ($("#rad1").is(":checked") ? "spool" : "em")),
											// // remarks: $("#textarea3").val()});
							// // jmifdtl_ds.sync();
							// // $("#jmifdtl_rs").data("kendoGrid").setDataSource(jmifdtl_ds);
							// // $("#jmifdtl_rs").data("kendoGrid").dataSource.page($("#jmifdtl_rs").data("kendoGrid").dataSource.page());
							// // $("#jmifdtl_rs").data("kendoGrid").dataSource.read();
						// // }else
					        // // $.post(crudService + "manage/tjmifDtl",{PROGRESS_RECID: jmifdtl_di.PROGRESS_RECID, stock_no: stock_no.value(), stock_desc: $("#textarea2").val(), item_code: $("#txt8").val(), commodity_code: $("#txt9").val(), uom: $("#txt10").val(), size: $("#txt11").val(), jmif_qty: po_qty.value(), spl_type: ($("#rad3").is(":checked") ? "" : ($("#rad1").is(":checked") ? "spool" : "em")), remarks: $("#textarea3").val()},
					       	    // // function(data){
									// // $("#jmifdtl_rs").data("kendoGrid").setDataSource(jmifdtl_ds);
									// // $("#jmifdtl_rs").data("kendoGrid").dataSource.page($("#jmifdtl_rs").data("kendoGrid").dataSource.page());
									// // $("#jmifdtl_rs").data("kendoGrid").dataSource.read();
					       	    // // });
	    			// // break;
	    			// // default:
	    				// // $(".thisIsRequired").removeClass('thisIsRequired');
		    			// // isFailed = false;
			    		// // grid_change(currRow2,"#jmifdtl_rs");
	    			// // break;
	    		// // }
	    		// // if (isFailed)
	    			// // return true;
				// // $(".jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea, .jmifdtl_phase .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
		        // // $("#editButt2, #delButt2").prop("disabled", true).addClass("k-state-disabled");
				// // $('input[name=win_option1], input[name=win_option2], #win_search').prop("disabled", false);
				// // stock_no.enable(false);
				// // po_qty.enable(false);
				// // $("#coverDiv").remove();
	    	// }
	    // });
		// $(".wrap-header input[name=win_option2]").bind({
			// click: function(e){
				// sentValue = ($('input[name=win_option2]:checked').index('input[name=win_option2]') == 2) ? 1 : ($('input[name=win_option2]:checked').index('input[name=win_option2]') == 1) ? 0 : "";
				// $("#twjrr_engg_rs").data("kendoGrid").dataSource.read();
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