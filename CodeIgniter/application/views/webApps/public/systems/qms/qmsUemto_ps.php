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
			disc_code = pathname.split('/')[pathname.split('/').length - 1],
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
					    disc_code: disc_code,
					    loguser: $("#hidden_user").val()
			        }
			      }else {
			      	data['loguser'] = $("#hidden_user").val();
			      	data['disc_code'] = disc_code;
			      	data['setType'] = (type == "update") ? type : data['setType']; 
			      	return data;
			      }
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
                        mat_tag: { type: "string", editable: false },
                        ps_code: { type: "string", editable: false },
                        ps_type: { type: "string", editable: false },
                        wt_fab: { type: "number", editable: false },
                        lcm: { type: "number", editable: false },
                        lselect: { type: "number", editable: false },
                        ref_rec_qty: { type: "number", editable: false },
                        qty: { type: "number", editable: false },
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
               {field: "mat_tag",title: "Mat. Tag", width: 110},
               {field: "ps_code",title: "PS Code", width: 110},
               {field: "ps_type",title: "PS Type", width: 110},
               {field: "wt_fab",title: "MTO Qty", width: 110},
               {field: "lcm",title: "CM", width: 110},
               {field: "lselect",title: " ", width: 110},
               {field: "ref_rec_qty",title: "Already Received", width: 128},
               {field: "qty",title: "Bal. To Receive", width: 110},
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
						checkedIds_engg[twjrr_engg_di.PROGRESS_RECID] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(15).find("input").is(":checked");
						if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(15).find("input").is(":checked") == false)
							$("#win_Chk1").prop("checked",false);
		           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(15).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(15).find("input").is(":checked"));
		           	
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
        			twjrr_engg_di['PROGRESS_RECID'] = 0;
    				$("#twjrr_engg_rs").data("kendoGrid").dataSource.remove(twjrr_engg_di);
        			twjrr_engg_ds.read();
        		}
        		// open_preloader();
        		$.post(crudService + "manage/ttMTO",{drawing_no: $("#win2_txt1").val(), sheet_no: $("#win2_txt2").val(), loguser: $("#hidden_user").val(), setType: "add", disc_code: disc_code},
        			function(data){
        				if (data != '1')
        					showNotif("Information",data,"info");
        					
        				twjrr_engg_ds.read();
        				// close_preloader();
        			});
        	}
        };
        
        var saveOnClose = function(){    
        	if ($("#win2_txt1").val() != ""){
        		if (disc_code.toLowerCase() == "pip")
	        		var addObj = {area_no: $("#win2_txt1").val(),
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
	    						  disc_code: disc_code,
	    						  PROGRESS_RECID: 0};
	    		else
	        		var addObj = {area_no: $("#win2_txt1").val(),
	    						  drawing_no: $("#win2_txt2").val(),
	    						  sheet_no: $("#win2_txt3").val(),
	    						  rev_no: $("#win2_txt4").val(),
	    						  ps_code: $("#win2_txt5").val(),
	    						  ps_type: $("#win2_txt6").val(),
	    						  ps_class: $("#win2_txt7").val(),
	    						  line_size: $("#win2_txt8").val(),
	    						  um: $("#win2_txt9").val(),
	    						  supp_desc: $("#win2_textarea").val(),
	    						  sys_man: "MAN",
	    						  setType: "manual",
	    						  disc_code: disc_code,
	    						  PROGRESS_RECID: 0};
	    						  
	    		twjrr_engg_ds.add(addObj);
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
							data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val(), disc_code: disc_code}
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
							url: "/codeIgniter/index.php/webapps/qms/index/index/qmsUemto_ps2",
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
							url: "/codeIgniter/index.php/webapps/qms/index/index/qmsUemto_ps1",
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
		$("#jmifDtlHead").css({"min-height": ((parseInt($("#jmifDtlHead .wrap-form").height()) + 12) + "px")});
	});
</script>