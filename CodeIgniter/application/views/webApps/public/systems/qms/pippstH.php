<style>
	@-moz-document url-prefix() {
		.wrap-form {
			height: 245px;
		}
	}
	.wrap-form_qms ul li {
		margin-bottom: 3px;
	}
</style>
<div id="main-wrapper">
	<div class="wrap-legend demo-section">
		<p>All date records follows the {mm/dd/yyyy} format.</p>
	</div>
	<div class="wrap-header demo-section">
		<fieldset style="width: 150px;float: left;margin-right: 5px;">
			<legend> Enter Job No.: </legend>
            <span class="k-textbox k-space-right">
                <input type="text" value="" name="jobSearch" id="jobSearch" />
                <a href="#" class="k-icon k-i-search">&nbsp;</a>
            </span>			
		</fieldset>
		<fieldset style="width: 808px;">
			<legend> Search: </legend>
            <span class="k-textbox k-space-right">
                <input type="text" value="" name="search" id="search" />
                <a href="#" class="k-icon k-i-search">&nbsp;</a>
            </span>			
		</fieldset>
	</div>
    <div class="wrap-grid demo-section">
        <div id="rowSelection"></div>
    </div>
	<div class="wrap-form_qms demo-section apply8" style="height: 615px;">
		<fieldset style="width: 475px;float: left;margin-right: 5px;">
			<legend>Details: </legend>
			<ul class="formLeft">
				<li>
					<label class="title" for="txt1" style="width: 115px !important;">System No.:</label><input type="text" name="txt1" id="txt1" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt2" style="width: 100px !important;">Support Specs:</label><input type="text" name="txt2" id="txt2" class="k-textbox" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt3" style="width: 115px !important;">Sub-System No.:</label><input type="text" name="txt3" id="txt3" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt4" style="width: 100px !important;">Category:</label><input type="text" name="txt4" id="txt4" class="k-textbox" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt5" style="width: 115px !important;">Testpack No.:</label><input type="text" name="txt5" id="txt5" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt6" style="width: 100px !important;">Assembly:</label><input type="text" disabled name="txt6" id="txt6" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt7" style="width: 115px !important;">Area No.:</label><input type="text" name="txt7" id="txt7" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt8" style="width: 100px !important;">Unit Meas.:</label><input type="text" name="txt8" disabled id="txt8" class="k-textbox" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt9" style="width: 115px !important;">FWBS:</label><input type="text" name="txt9" id="txt9" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt10" style="width: 100px !important;">Unit WT.:</label><input type="text" name="txt10" disabled id="txt10" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt11" style="width: 115px !important;">Service Line:</label><input type="text" name="txt11" id="txt11" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt12" style="width: 100px !important;">Unit Qty:</label><input type="text" name="txt12" disabled id="txt12" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt13" style="width: 115px !important;">Drawing No.:</label><input type="text" name="txt13" id="txt13" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt14" style="width: 100px !important;">Client WT:</label><input type="text" name="txt14" disabled id="txt14" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt15" style="width: 115px !important;">Line No:</label><input type="text" name="txt15" id="txt15" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt16" style="width: 100px !important;">Fab'n WT:</label><input type="text" name="txt16" disabled id="txt16" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt17" style="width: 115px !important;">Sheet No:</label><input type="text" name="txt17" id="txt17" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt18" style="width: 100px !important;">Length(m):</label><input type="text" name="txt18" disabled id="txt18" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt19" style="width: 115px !important;">Spool No:</label><input type="text" name="txt19" id="txt19" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt20" style="width: 100px !important;">Fab'n Scope:</label><input type="text" name="txt20" id="txt20" class="k-textbox" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt21" style="width: 115px !important;">Rev. No:</label><input type="text" name="txt21" id="txt21" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt22" style="width: 100px !important;">Supply Scope:</label><input type="text" name="txt22" id="txt22" class="k-textbox" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt23" style="width: 115px !important;">Line Specs:</label><input type="text" name="txt23" id="txt23" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt24" style="width: 100px !important;">Scope of Work:</label><input type="text" name="txt24" id="txt24" class="k-textbox" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt25" style="width: 115px !important;">Line Size:</label><input type="text" name="txt25" id="txt25" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt26" style="width: 100px !important;">Paint System:</label><input type="text" name="txt26" id="txt26" class="k-textbox" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt27" style="width: 115px !important;">Material Tag:</label><input type="text" name="txt27" id="txt27" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt28" style="width: 100px !important;">Support Class:</label><input type="text" name="txt28" id="txt28" class="k-textbox" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt29" style="width: 115px !important;">Commodity Code:</label><input type="text" name="txt29" id="txt29" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt30" style="width: 100px !important;">PWHT Req.:</label><input type="text" name="txt30" id="txt30" class="k-textbox" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt31" style="width: 115px !important;">Material:</label><input type="text" name="txt31" id="txt31" class="k-textbox" style="width: 353px;" />
				</li>
				<li>
					<label class="title" for="txt32" style="width: 115px !important;">Support Code:</label><input type="text" name="txt32" id="txt32" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt33" style="width: 100px !important;">Roc Type:</label><input type="text" name="txt33" id="txt33" class="k-textbox" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt34" style="width: 115px !important;">Support Desc:</label><input type="text" name="txt34" id="txt34" class="k-textbox" style="width: 120px;" />
					<label class="title short" for="txt35" style="width: 100px !important;">Plant No:</label><input type="text" name="txt35" id="txt35" class="k-textbox" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt36" style="width: 115px !important;">Support Type:</label><input type="text" name="txt36" id="txt36" class="k-textbox" style="width: 120px;" />
				</li>
			</ul>
		</fieldset>
		<div class="fogUpd">
		<fieldset style="width: 232px;margin: 6px 5px 0 0;float: left;">
			<ul>
				<li>
					<label class="title" for="txt37" style="width: 104px !important;">FOG Fitup Date:</label><input type="text" disabled name="txt37" id="txt37" style="width: 123px;" />
				</li>
				<li>
					<label class="title" for="txt38" style="width: 104px !important;">FOG Installed:</label><input type="text" disabled name="txt38" id="txt38" style="width: 123px;" />
				</li>
				<li>
						<div class="taClass" style="margin-top: 2px;">
						<label class="title" for="textarea">FOG Remarks</label><textarea name="textarea" id="textarea" cols="5" rows="5" style="width: 220px !important;height: 203px !important;"></textarea>
						</div>
				</li>
				<li>
					<hr style="margin-bottom: 5px;" />
				</li>
				<li>
					
						<button class="k-button" id="saveButt">Save</button>
		        	<button class="k-button" id="canButt">Cancel</button>
		        	<button class="k-button mainEve" id="updateButt1">Update</button>
		        	<button class="k-button mainEve" id="uplUpdButt1" style="float: right;">Upload Update</button>
					</div>
		        	
				</li>
			</ul>
		</fieldset>
		<div class = "pcdUpd">
		<fieldset style="width: 232px;margin-top: 6px;">
			<ul>
				<li>
					<label class="title" for="txt39" style="width: 104px !important;">PCD Fitup Date:</label><input type="text" disabled name="txt39" id="txt39" style="width: 123px;" />
				</li>
				<li>
					<label class="title" for="txt40" style="width: 104px !important;">PCD Installed:</label><input type="text" disabled name="txt40" id="txt40" style="width: 123px;" />
				</li>
				<li>
					<div class="taClass" style="margin-top: 2px;">
						<label class="title" for="textarea1">PCD Remarks</label><textarea name="textarea1" id="textarea1" cols="5" rows="5" style="width: 220px !important;height: 203px !important;"></textarea>
					</div>
				</li>
				<li>
					<hr style="margin-bottom: 5px;" />
				</li>
				<li>
						
						<button class="k-button" id="saveButt2">Save</button>
			        	<button class="k-button" id="canButt">Cancel</button>
			        	<button class="k-button mainEve" id="updateButt2">Update</button>
			        	<button class="k-button mainEve" id="uplUpdButt2" style="float: right;">Upload Update</button>
				</li>
			</ul>
		</fieldset>
		</div>
		<div class="globalUpd">
		<fieldset style="width: 232px;margin: 6px 5px 0 0;float: left;">
			<ul>
				<li>
					<label class="title" for="txt41" style="width: 123px !important;">Delivered @ Global:</label><input type="text" disabled name="txt41" id="txt41" style="width: 101px;" />
				</li>
				<li>
					<label class="title" for="txt42" style="width: 123px !important;">Painted:</label><input type="text" disabled name="txt42" id="txt42" style="width: 101px;" />
				</li>
				<li>
					<label class="title" for="txt43" style="width: 123px !important;">Global Released:</label><input type="text" disabled name="txt43" id="txt43" style="width: 101px;" />
				</li>
				<li>
					<label class="title" for="txt44" style="width: 123px !important;">Delivered @ Site:</label><input type="text" disabled name="txt44" id="txt44" style="width: 101px;" />
				</li>
				<li>
					<hr style="margin: 5px 0;" />
				</li>
				<li style="margin-top: 5px;">
						<button class="k-button" id="saveButt3">Save</button>
			        	<button class="k-button" id="canButt">Cancel</button>
			        	<button class="k-button mainEve" id="updateButt3">Update</button>
			        	<button class="k-button mainEve" id="uplUpdButt3" style="float: right;">Upload Update</button>		
				</li>
			</ul>
		</div>
		</fieldset>
		<div class="fabUpd">
		<fieldset style="width: 232px;margin: 6px 5px 0 0;">
			<ul>
				<li>
					<label class="title" for="txt45" style="width: 123px !important;">Date Issued:</label><input type="text" disabled name="txt45" id="txt45" style="width: 101px;" />
				</li>
				<li>
					<label class="title" for="txt46" style="width: 123px !important;">Delivered @ Fab'n:</label><input type="text" disabled name="txt46" id="txt46" style="width: 101px;" />
				</li>
				<li>
					<label class="title" for="txt47" style="width: 123px !important;">Fabricated:</label><input type="text" name="txt47" disabled id="txt47" style="width: 101px;" />
				</li>
				<li>
					<label class="title" for="txt48" style="width: 123px !important;">Fab'n Released:</label><input type="text" disabled name="txt48" id="txt48" style="width: 101px;" />
				</li>
				<li>
					<hr style="margin: 5px 0;" />
				</li>
				<li style="margin-top: 5px;">
					
						<button class="k-button" id="saveButt4">Save</button>
			        	<button class="k-button" id="canButt">Cancel</button>
			        	<button class="k-button mainEve" id="updateButt4">Update</button>
			        	<button class="k-button mainEve" id="uplUpdButt4" style="float: right;">Upload Update</button>
				</li>
			</ul>
		</fieldset>
		</div>
		<fieldset style="width: 483px;margin-top: 6px;">
			<ul>
				<li>
					<label class="title" for="txt49" style="width: 110px !important;">Total No. of Sets:</label><input type="text" disabled name="txt49" id="txt49" style="width: 125px;" />
					<label class="title short" for="txt50" style="width: 110px !important;">Total Wt of Sets:</label><input type="text" disabled name="txt50" id="txt50" style="width: 125px;" />
				</li>
				<li>
					<label class="title" for="txt51" style="width: 110px !important;">Total No. of PCS:</label><input type="text" disabled name="txt51" id="txt51" style="width: 125px;" />
					<label class="title short" for="txt52" style="width: 110px !important;">Total Wt of PCS:</label><input type="text" disabled name="txt52" id="txt52" style="width: 125px;" />
				</li>
			</ul>
		</fieldset>
	</div>
	<div class="wrap-button demo-section">
		<div class="buttonLeft">
        	<button class="k-button" id="saveButt">Save</button>
        	<button class="k-button" id="canButt">Cancel</button>
        	<button class="k-button mainEve" id="addButt">Add</button>
        	<button class="k-button mainEve" id="editButt">Edit</button>
        	<button class="k-button mainEve" id="delButt">Delete</button>
        	<button class="k-button mainEve" id="uploadButt">Upload</button>
        	<button class="k-button mainEve" id="exportButt">Export</button>
       	</div>
		<div class="buttonRight">
        	<button class="k-button mainEve" id="accessButt">Access</button>
        	<button class="k-button mainEve" id="closeButt">Close</button>
       	</div>				
	</div>
	<!-- <div id="uplWindow">
		<form method="post" action="submit" style="width: 100%;margin-bottom: 5px;">
            <div class="demo-section">
                <input name="files" id="files" type="file" accept=".csv" />
            </div>
        </form>	
        <div id="uploadBrowse"></div>	
		<div class="wrap-buttonUpl demo-section">
			<div class="buttonLeft">
            	<button type="button" class="k-button k-state-disabled" id="importButt" disabled>Import</button>
            	<label class="title">Loaded: </label><input type="text" name="txtUpl1" id="txtUpl1" class="k-textbox" style="width: 100px;" disabled>
           	</div>
			<div class="buttonRight">
        		<span>Noted: Must have the same column order following the displayed list above.</span>
           	</div>
		</div>		
	</div> -->
</div>
<script type="text/javascript">
	function grid_change(e){
		if (typeof e == "undefined")
			e = grid;
	    var selectedRows = e.select();
	    var selectedDataItems = [];
	    for (var i = 0; i < selectedRows.length; i++) {
	      dataItem = e.dataItem(selectedRows[i]);
		  $("#txt1").val(dataItem.system_no);
		  $("#txt2").val(dataItem.ps_specs);
		  $("#txt3").val(dataItem.sub_system);
		  $("#txt4").val(dataItem.category);
		  $("#txt5").val(dataItem.testpack_no);
		  $("#txt6").data("kendoNumericTextBox").value(dataItem.assembly);
		  $("#txt7").val(dataItem.area_no);
		  $("#txt8").val(dataItem.um);
		  $("#txt9").val(dataItem.fwbs);
		  $("#txt10").data("kendoNumericTextBox").value(dataItem.uwt);
		  $("#txt11").val(dataItem.serv_line);
		  $("#txt12").data("kendoNumericTextBox").value(dataItem.uqty);
		  $("#txt13").val(dataItem.drawing_no);
		  $("#txt14").data("kendoNumericTextBox").value(dataItem.wt_client);
		  $("#txt15").val(dataItem.line_no);
		  $("#txt16").data("kendoNumericTextBox").value(dataItem.wt_fab);
		  $("#txt17").val(dataItem.sheet_no);
		  $("#txt18").data("kendoNumericTextBox").value(dataItem.ps_length);
		  $("#txt19").val(dataItem.spool_no);
		  $("#txt20").val(dataItem.scope_fab);
		  $("#txt21").val(dataItem.rev_no);
		  $("#txt22").val(dataItem.scope_supply);
		  $("#txt23").val(dataItem.line_specs);
		  $("#txt24").val(dataItem.scope_of_work);
		  $("#txt25").val(dataItem.line_size);
		  $("#txt26").val(dataItem.paint_code);
		  $("#txt27").val(dataItem.mat_tag);
		  $("#txt28").val(dataItem.ps_class);
		  $("#txt29").val(dataItem.com_code);
		  $("#txt30").val(dataItem.pwht_req);
		  $("#txt31").val(dataItem.ps_matl);
		  $("#txt32").val(dataItem.ps_code);
		  $("#txt33").val(dataItem.roc_type);
		  $("#txt34").val(dataItem.supp_desc);
		  $("#txt35").val(dataItem.plant_no);
		  $("#jobSearch").val(dataItem.job_no);
		  $("#txt36").val(dataItem.ps_type);
		  $("#txt37").data("kendoDatePicker").value(kendo.toString(dataItem.fogfitup_date,"MM/dd/yyyy"));
		  $("#txt38").data("kendoDatePicker").value(kendo.toString(dataItem.fog_installed,"MM/dd/yyyy"));
		  $("#txt39").data("kendoDatePicker").value(kendo.toString(dataItem.pcdfitup_date,"MM/dd/yyyy"));
		  $("#txt40").data("kendoDatePicker").value(kendo.toString(dataItem.pcd_installed,"MM/dd/yyyy"));
		  $("#txt41").data("kendoDatePicker").value(kendo.toString(dataItem.deliv_to_paint,"MM/dd/yyyy"));
		  $("#txt42").data("kendoDatePicker").value(kendo.toString(dataItem.paint_date,"MM/dd/yyyy"));
		  //$("#txt43").data("kendoDatePicker").value(kendo.toString(dataItem.qc_releasepaint,"MM/dd/yyyy"));
		  $("#txt43").val(kendo.toString(dataItem.qc_releasepaint,"MM/dd/yyyy"));
		  $("#txt44").data("kendoDatePicker").value(kendo.toString(dataItem.deliv_at_site,"MM/dd/yyyy"));
		  $("#txt45").data("kendoDatePicker").value(kendo.toString(dataItem.issued_date,"MM/dd/yyyy"));
		  $("#txt46").data("kendoDatePicker").value(kendo.toString(dataItem.deliv_to_fab,"MM/dd/yyyy"));
		  $("#txt47").val(kendo.toString(dataItem.fab_dt,"MM/dd/yyyy"));
		  $("#txt48").val(kendo.toString(dataItem.fab_released,"MM/dd/yyyy"));
		  $("#textarea").val(dataItem.fog_remarks);
		  $("#textarea1").val(dataItem.pcd_remarks);
		  $("#txt49").data("kendoNumericTextBox").value(dataItem.total_set);
		  $("#txt51").data("kendoNumericTextBox").value(dataItem.total);
		  
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
        var window = $("#window"),
        	currRow, dataRow, dataItem, ekCode, windowOptions, cMode, jobList = [], disImport = false, dataItem2,
			optionArr = [],
			sentValue = "",	crudService = crudServiceBaseUrl + "qms/index/",
			filterFArr = [], filterOArr = [], filterVArr = [],
			fieldSort = "", dirSort = "", query = "", fileName = "";        
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/psTo",
                    contentType: "application/json",
                    type: "GET"  
                },
                create: {
                    url: crudService + "manage/psTo",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						// showNotif('Warning',jqXHR.responseText,'warning');
						console.log(jqXHR.responseText);
	                	if (jqXHR.responseText != '1'){
	                		showNotif('Warning',jqXHR.responseText,'warning');
	                		$(".wrap-form_qms input, .wrap-form_qms select, .wrap-form_qms button").prop("disabled", true).addClass("k-state-disabled")
							$(".wrap-button button").each(function(index,value){
								if ($(this).hasClass("mainEve"))
									$(this).show();
								else
									$(this).hide();									
							});
							assembly.enable(false);
							uwt.enable(false);
							uqty.enable(false);
							wt_client.enable(false);
							wt_fab.enable(false);
							fips_length.enable(false);
	                	}	
						else {
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
				    		
							$(".wrap-form_qms input, .wrap-form_qms select, .wrap-form_qms button").prop("disabled", true).addClass("k-state-disabled")
							$(".wrap-button button").each(function(index,value){
								if ($(this).hasClass("mainEve"))
									$(this).show();
								else
									$(this).hide();									
							});
							assembly.enable(false);
							uwt.enable(false);
							uqty.enable(false);
							wt_client.enable(false);
							wt_fab.enable(false);
							fips_length.enable(false);
							$(".wrap-form_qms button").prop("disabled", false).removeClass("k-state-disabled");
							grid_change(currRow);
							$("#coverDiv").remove();	
						}
	                }
                },
                update: {
                    url: crudService + "manage/psTo",
                    type: "POST",
                    complete: function(jqXHR, textStatus) {
	                	 if (jqXHR.responseText != '1')
							 showNotif('Warning',jqXHR.responseText,'warning');
	                }
                    
                },
                destroy: {
                    url: crudService + "remove/psTo",
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
					    fieldS: ($(data.sort).length ? data.sort[0].field : "logtime"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "asc")
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
                   	    PROGRESS_RECID: {type: "number", editable: false},
                        ps_code: { type: "string"},
                        supp_desc: { type: "string"},
                   	    ps_type: { type: "string"},
                        um: { type: "string"},
                        uqty: { type: "number"},
                        uwt: { type: "number"},
                        wt_client: { type: "number"},
                        wt_fab: { type: "number"},
                        ps_length: { type: "number"},
                        ps_matl: { type: "string"},
						pcdfitup_date: { type: "date"},
						pcd_installed: { type: "date"},
						fogfitup_date: { type: "date"},
						fog_installed: { type: "date"},
						deliv_to_paint: { type: "date"},
						paint_date: { type: "date"},
						qc_releasepaint: { type: "date"},
						deliv_at_site: { type: "date"},
						issued_date: { type: "date"},
						deliv_to_fab: { type: "date"},
						Fab_dt: { type: "date"},
						ab_released: { type: "date"}
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
            filterable: {
                extra: false
            },
            columns: [
               { field: "ps_code", title: "Support Code", width: 117 },
               { field: "supp_desc", title: "Support Description", width: 300 },
               { field: "ps_type", title: "PS Type", width: 74 },
               { field: "um", title: "Unit Measure", width: 108 },
               { field: "uqty", title: "Unit Quantity", width: 110 },
               { field: "uwt", title: "Unit Weight", width: 101 },
               { field: "wt_client", title: "Weight Client", width: 113 },
               { field: "wt_fab", title: "Weight Fab.", width: 104 },
               { field: "ps_length", title: "Length", width: 71 },
               { field: "ps_matl", title: "PS Material", width: 99 }
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem2 = this.dataItem(selectedRows[i]);
			       
			      
			        
			    }
			   	grid_change(currRow,"#rowSelection");
			    
           },
           dataBound: addExtraStylingToGrid
        });
        
        $("#txt10, #txt12, #txt14, #txt16, #txt18, #txt49, #txt50, #txt51, #txt52").removeClass("k-state-disabled").kendoNumericTextBox({
        	enable: false,
        	value: 0,
        	min: 0
        }).data("kendoNumericTextBox");
         $("#txt6").kendoNumericTextBox({
            enable: false,
        	value: 0,
        	min: 0 
         });
         
        var assembly = $("#txt6").data("kendoNumericTextBox");
        var uwt = $("#txt10").data("kendoNumericTextBox");
        var uqty = $("#txt12").data("kendoNumericTextBox");
        var wt_client = $("#txt14").data("kendoNumericTextBox");
        var wt_fab = $("#txt16").data("kendoNumericTextBox");
        var fips_length = $("#txt18").data("kendoNumericTextBox");
        
        $("#txt37, #txt38, #txt39, #txt40, #txt41, #txt42, #txt43, #txt44, #txt45, #txt46, #txt47, #txt48").removeClass('k-state-disabled').kendoDatePicker({
			format: "MM/dd/yyyy",
			enable: false
		   });
          
          
        var fogfitup_date = $("#txt37").data("kendoDatePicker");
        var fog_installed = $("#txt38").data("kendoDatePicker");
        var pcdfitup_date = $("#txt39").data("kendoDatePicker");
        var pcd_installed = $("#txt40").data("kendoDatePicker");
        var deliv_to_paint = $("#txt41").data("kendoDatePicker");
        var paint_date = $("#txt42").data("kendoDatePicker");
        var QC_releasePaint = $("#txt43").data("kendoDatePicker");
        var deliv_at_site = $("#txt44").data("kendoDatePicker");
        var issued_date = $("#txt45").data("kendoDatePicker");
        var deliv_to_fab = $("#txt46").data("kendoDatePicker");
        var Fab_dt = $("#txt47").data("kendoDatePicker");
        var Fab_released = $("#txt48").data("kendoDatePicker");
        
		$(".wrap-button button, .wrap-form_qms button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();									
		});
        $(".wrap-form_qms input, .wrap-form_qms textarea, .wrap-form_qms select, .wrap-form_qms button").prop("disabled", true).addClass("k-state-disabled");
		$(".wrap-form_qms button").prop("disabled", false).removeClass("k-state-disabled");
		$(".wrap-button button").bind({
			click: function(){
				switch (this.id){
					case "addButt":
						$.get(crudService + "directCall/verifyButt",{user_id: $("#hidden_user").val(),objButt: this.id},
						function(data){	    		
	    						if ($.trim(data) != "Array"){
	    							showNotif('Warning',data,'warning');
									return true;
	    						}else{
									$(".wrap-form_qms input, .wrap-form_qms select, .wrap-form_qms button").prop("disabled", false).removeClass("k-state-disabled").val("");
									$(".wrap-button button").each(function(index,value){
										if ($(this).hasClass("mainEve"))
											$(this).hide();
										else
											$(this).show();
									});
									assembly.enable();
									uwt.enable();
									uqty.enable();
									wt_client.enable();
									wt_fab.enable();
									fips_length.enable();
									$(".wrap-form_qms button").prop("disabled", true).addClass("k-state-disabled")
									forDiv();
									cMode = "add";
								}
						});
					    
					break;
					case "editButt":
						$.get(crudService + "directCall/verifyButt",{user_id: $("#hidden_user").val(),objButt: this.id},
						function(data){	    		
	    						if ($.trim(data) != "Array"){
	    							showNotif('Warning',data,'warning');
									return true;
	    						}else{
	    							$(".wrap-form_qms input, .wrap-form_qms select, .wrap-form_qms button").prop("disabled", false).removeClass("k-state-disabled");
									$(".wrap-button button").each(function(index,value){
										if ($(this).hasClass("mainEve"))
											$(this).hide();
										else
											$(this).show();
									});
									assembly.enable();
									uwt.enable();
									uqty.enable();
									wt_client.enable();
									wt_fab.enable();
									fips_length.enable();
									$(".wrap-form_qms button").prop("disabled", true).addClass("k-state-disabled")
									forDiv();
									$("#txt7,#txt13,#txt15,#txt17,#txt19,#txt21,#txt27,#txt30,#txt33,#txt35").prop("disabled", true).addClass("k-state-disabled")
									cMode = "edit";
	    						}
	    						});
						
					break;
					case "delButt":
					$.get(crudService + "directCall/verifyButt",{user_id: $("#hidden_user").val(),objButt: this.id},
						function(data){	    		
	    						if ($.trim(data) != "Array"){
	    							showNotif('Warning',data,'warning');
									return true;
	    						}else{
	    							if (!confirm("Do you really want to delete this item?")){
			    					e.preventDefault();	    					
			    					return true;
				    				}
									dataRow = grid.data("kendoGrid").dataSource.getByUid(dataItem2.uid);
			    					$("#rowSelection").data("kendoGrid").dataSource.remove(dataRow);
									dataSource.sync();
									$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
									$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									$("#rowSelection").data("kendoGrid").dataSource.read();					
	    						}
					});
						
					break;
					case "saveButt":
						if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
						if (cMode == "add"){
							dataSource.add({PROGRESS_RECID: 0,
											plant_no: $("#txt35").val(), sheet_no: $("#txt17").val(), rev_no:	$("#txt21").val() ,area_no: $("#txt7").val(), job_no: $("#jobSearch").val(),
											spool_no:  $("#txt19").val(), drawing_no:$("#txt13").val(), LINE_no: $("#txt15").val(), serv_line: $("#txt11").val(), LINE_specs:$("#txt23").val(),
											LINE_size: $("#txt25").val(), mat_tag: $("#txt27").val(), com_code:  $("#txt29").val(), supp_desc: $("#txt34").val(), ps_type: 	$("#txt36").val(),
											wt_client: wt_client.value(), wt_fab: wt_fab.value(), fwbs: $("#txt9").val(), scope_fab: $("#txt20").val(), scope_supply: $("#txt22").val(), pwht_req: $("#txt30").val(),
											roc_type: $("#txt33").val(), system_no: $("#txt1").val(), sub_system: $("#txt3").val(), testpack_no:  $("#txt5").val(), ps_code: $("#txt32").val(), ps_specs: $("#txt2").val(),
											ps_matl: $("#txt31").val(), category: $("#txt4").val(), ASSEMBLY: $("#txt6").val() ,um: $("#txt8").val(), uwt: uwt.value(),uqty: uqty.value(), ps_length:    fips_length.value(),
											scope_of_work: $("#txt24").val(), paint_code: $("#txt26").val(),ps_class: $("#txt28").val()});
							dataSource.sync();
							return true;
						}else{
							 $.post(crudService + "manage/psTo",{PROGRESS_RECID: dataItem2.PROGRESS_RECID,line_no: $("#txt15").val(),sub_system: $("#txt3").val(),
							 									serv_line: $("#txt11").val(),line_specs: $("#txt23").val(),testpack_no: $("#txt5").val(),
							 									line_size: $("#txt25").val(),com_code: $("#txt29").val(),fwbs: $("#txt9").val(),
							 									supp_desc: $("#txt34").val(),ps_type: $("#txt36").val(),
							 									wt_client: wt_client.value(),system_no: $("#txt1").val(),
							 									ps_code:$("#txt32").val(),ps_specs: $("#txt2").val(),
							 									ps_matl:$("#txt31").val(),category: $("#txt4").val(),
							 									assembly: assembly.value(),um: $("#txt8").val(),scope_fab: $("#txt20").val(),
							 									uwt: uwt.value(),uqty: uqty.value(),ps_length: fips_length.value(),scope_supply: $("#txt22").val(),
							 									scope_of_work: $("#txt24").val(),paint_code: $("#txt26").val(), ps_class: $("#txt28").val(),
							 									loguser: $("#hidden_user").val()},
					       	    function(data){
									$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
									$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									$("#rowSelection").data("kendoGrid").dataSource.read();
									
					       	    });
						}
						$(".wrap-form_qms input, .wrap-form_qms select, .wrap-form_qms button").prop("disabled", true).addClass("k-state-disabled")
						$(".wrap-button button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).show();
							else
								$(this).hide();									
						});
						$(".wrap-form_qms button").prop("disabled", false).removeClass("k-state-disabled");
						grid_change(currRow);
						
						
						$("#coverDiv").remove();	
						
					break;
					case "canButt":
						
						$(".wrap-form_qms input, .wrap-form_qms select, .wrap-form_qms button").prop("disabled", true).addClass("k-state-disabled")
						$(".wrap-button button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).show();
							else
								$(this).hide();									
						});
						$(".wrap-form_qms button").prop("disabled", false).removeClass("k-state-disabled");
						grid_change(currRow);
						$("#coverDiv").remove();
						assembly.enable(false);
						uwt.enable(false);
						uqty.enable(false);
						wt_client.enable(false);
						wt_fab.enable(false);
						fips_length.enable(false);
					break;
					case "uploadButt":
						upload = $("#files").data("kendoUpload");
		                // uploadBrowse = $("#uploadBrowse").data("kendoGrid");
		                
						$("#window").data("kendoWindow").setOptions({
						    title: "Upload Records (pipsplupH)",
				            width: "991px",
				            height: "auto"
						});
						$("#window").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/webapps/qms/index/index/pipsplupH",
							type: "POST",
							data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val(), inWindow: 1}
						});
            			$("#window").data("kendoWindow").center().open();						
            			//$("#uplWindow").data("kendoWindow").center()		.open();
					break;
                	case "exportButt":
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_psTo/?";
				        link.href += ("fieldS=" + fieldSort + "&");
				        link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
				        link.href += ("dir=" + dirSort);
				 
				        //Dispatching click event.
				        if (document.createEvent) {
				            var e = document.createEvent('MouseEvents');
				            e.initEvent('click' ,true ,true);
				            link.dispatchEvent(e);
					    	close_preloader();
				            return true;
				        }
                	break;
					
				}
			}					
		});
		$(".wrap-form_qms button").bind({
        	click: function(){
        		var uplModule = "";
        		$(".wrap-form_qms button").prop("disabled",true).addClass("k-state-disabled");
        		$(".wrap-button button").prop("disabled",true).addClass("k-state-disabled");
        		switch(this.id){
        			case 'saveButt':
        				$.post(crudService + "manage/psTo",{PROGRESS_RECID: dataItem2.PROGRESS_RECID,fog_remarks: $("textarea").val(),fogfitup_date: kendo.toString(fogfitup_date.value(),"yyyy-MM-dd"),fog_installed: kendo.toString(fog_installed.value(),"yyyy-MM-dd"),loguser: $("#hidden_user").val()},
					       	    function(data){
									$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
									$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									$("#rowSelection").data("kendoGrid").dataSource.read();
									
					       	    });
        				
        				$(".wrap-form_qms .fogUpd input, .wrap-form_qms .fogUpd button, .wrap-form_qms .fogUpd textarea").prop("disabled",true).addClass("k-state-disabled");
        				fogfitup_date.enable(false);
						fog_installed.enable(false);
						$(".wrap-form_qms .fogUpd button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).show();
							else
								$(this).hide();
						});
						$(".wrap-form_qms button").prop("disabled",false).removeClass("k-state-disabled");
						$(".wrap-button button").prop("disabled",false).removeClass("k-state-disabled");
        			break;
        			case 'updateButt1':
        					$(".wrap-form_qms .fogUpd button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).hide();
							else
								$(this).show();
						});
						
						
						$(".wrap-form_qms .fogUpd input, .wrap-form_qms .fogUpd button, .wrap-form_qms .fogUpd textarea").prop("disabled",false).removeClass("k-state-disabled");
						fogfitup_date.enable();
						fog_installed.enable();
        				break;
        			case 'saveButt2':
        				$.post(crudService + "manage/psTo",{PROGRESS_RECID: dataItem2.PROGRESS_RECID,pcdfitup_date: kendo.toString(pcdfitup_date.value(),"yyyy-MM-dd"),pcd_installed: kendo.toString(pcd_installed.value(),"yyyy-MM-dd"),pcd_remarks: $("#textarea1").val(),loguser: $("#hidden_user").val()},
					       	    function(data){
									$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
									$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									$("#rowSelection").data("kendoGrid").dataSource.read();
									
					       	    });
        				$(".wrap-form_qms .pcdUpd input, .wrap-form_qms .pcdUpd button, .wrap-form_qms .pcdUpd textarea").prop("disabled",true).addClass("k-state-disabled");
        				pcd_installed.enable(false);
						pcdfitup_date.enable(false);
						$(".wrap-form_qms .pcdUpd button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).show();
							else
								$(this).hide();
						});
						$(".wrap-form_qms button").prop("disabled",false).removeClass("k-state-disabled");
						$(".wrap-button button").prop("disabled",false).removeClass("k-state-disabled");
        			break;
        			case 'updateButt2':
        					$(".wrap-form_qms .pcdUpd button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).hide();
							else
								$(this).show();
						});
						
						$(".wrap-form_qms .pcdUpd button, .wrap-form_qms .pcdUpd textarea,.wrap-form_qms .pcdUpd input").prop("disabled",false).removeClass("k-state-disabled");
						pcd_installed.enable();
						pcdfitup_date.enable();
        				break;
        			case 'saveButt3':
        				$.post(crudService + "manage/psTo",{PROGRESS_RECID: dataItem2.PROGRESS_RECID,deliv_to_paint: kendo.toString(deliv_to_paint.value(),"yyyy-MM-dd"),paint_date: kendo.toString(paint_date.value(),"yyyy-MM-dd"),qc_releasepaint: kendo.toString(QC_releasePaint.value(),"yyyy-MM-dd"),deliv_at_site: kendo.toString(deliv_at_site.value(),"yyyy-MM-dd"),loguser: $("#hidden_user").val()},
					       	    function(data){
									$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
									$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									$("#rowSelection").data("kendoGrid").dataSource.read();
									
					       	    });
        				$(".wrap-form_qms button").prop("disabled",false).removeClass("k-state-disabled");
        				deliv_to_paint.enable(false);
						paint_date.enable(false);
						QC_releasePaint.enable(false);
						deliv_at_site.enable(false);
						$(".wrap-button button").prop("disabled",false).removeClass("k-state-disabled");
						$(".wrap-form_qms .globalUpd button").each(function(index,value){
						if ($(this).hasClass("mainEve"))
							$(this).show();
						else
							$(this).hide();
						});
        			break;
        			case 'updateButt3':
    					$(".wrap-form_qms .globalUpd button").each(function(index,value){
						if ($(this).hasClass("mainEve"))
							$(this).hide();
						else
							$(this).show();
							});
						$(".wrap-form_qms .globalUpd input,.wrap-form_qms .globalUpd button,.wrap-form_qms").prop("disabled",false).removeClass("k-state-disabled");
        				deliv_to_paint.enable();
						paint_date.enable();
						QC_releasePaint.enable();
						deliv_at_site.enable();
        				break;
        			case 'saveButt4':
        				$.post(crudService + "manage/psTo",{PROGRESS_RECID: dataItem2.PROGRESS_RECID,issued_date: kendo.toString(issued_date.value(),"yyyy-MM-dd"),deliv_to_fab: kendo.toString(deliv_to_fab.value(),"yyyy-MM-dd"),fab_dt: kendo.toString(Fab_dt.value(),"yyyy-MM-dd"),fab_released:kendo.toString(Fab_released.value(),"yyyy-MM-dd"),loguser: $("#hidden_user").val()},
					       	    function(data){
									$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
									$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									$("#rowSelection").data("kendoGrid").dataSource.read();
									
					       	    });
        				$(".wrap-form_qms button").prop("disabled",false).removeClass("k-state-disabled"); 
        				issued_date.enable(false);
						deliv_to_fab.enable(false);
						Fab_dt.enable(false);
						Fab_released.enable(false);
						$(".wrap-button button").prop("disabled",false).removeClass("k-state-disabled");
        				$(".wrap-form_qms .fabUpd button").each(function(index,value){
						if ($(this).hasClass("mainEve"))
							$(this).show();
						else
							$(this).hide();
						});
        				 break;
        			case 'updateButt4':
    					$(".wrap-form_qms .fabUpd button").each(function(index,value){
						if ($(this).hasClass("mainEve"))
							$(this).hide();
						else
							$(this).show();
						});
						
						$(".wrap-form_qms .fabUpd button").prop("disabled",false).removeClass("k-state-disabled");
						issued_date.enable();
						deliv_to_fab.enable();
						Fab_dt.enable();
						Fab_released.enable();
        				break;
        			case 'uplUpdButt1':
        				uplModule = "pipfogup";
        				upload = $("#files").data("kendoUpload");
						$("#window").data("kendoWindow").setOptions({
						    title: "Upload Records (" + uplModule + ")",
				            width: "991px",
				            height: "auto"
						});
						$("#window").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/webapps/qms/index/index/" + uplModule,
							type: "POST",
							data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val(), inWindow: 1}
						});
		    			$("#window").data("kendoWindow").center().open();
		    			//uplModule = "";
        				break
        			case 'uplUpdButt2':
        				uplModule = "pippcdup2";
        				upload = $("#files").data("kendoUpload");
						$("#window").data("kendoWindow").setOptions({
						    title: "Upload Records (" + uplModule + ")",
				            width: "991px",
				            height: "auto"
						});
						$("#window").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/webapps/qms/index/index/" + uplModule,
							type: "POST",
							data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val(), inWindow: 1}
						});
		    			$("#window").data("kendoWindow").center().open();
		    			uplModule = "";
        				break;
        			case 'uplUpdButt3':
        				uplModule = "pipglobalup";	
        				upload = $("#files").data("kendoUpload");
						$("#window").data("kendoWindow").setOptions({
						    title: "Upload Records (" + uplModule + ")",
				            width: "991px",
				            height: "auto"
						});
						$("#window").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/webapps/qms/index/index/" + uplModule,
							type: "POST",
							data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val(), inWindow: 1}
						});
		    			$("#window").data("kendoWindow").center().open();
		    			uplModule = "";
        				break;
        			case 'uplUpdButt4':
        				uplModule = "pipfabnup";
        				upload = $("#files").data("kendoUpload");
						$("#window").data("kendoWindow").setOptions({
						    title: "Upload Records (" + uplModule + ")",
				            width: "991px",
				            height: "auto"
						});
						$("#window").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/webapps/qms/index/index/" + uplModule,
							type: "POST",
							data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val(), inWindow: 1}
						});
		    			$("#window").data("kendoWindow").center().open();
		    			uplModule = "";
        				break;
        			default:
						$(".wrap-form_qms .fogUpd input, .wrap-form_qms .fogUpd button, .wrap-form_qms .fogUpd textarea, .wrap-form_qms .pcdUpd input, .wrap-form_qms .pcdUpd button, .wrap-form_qms .pcdUpd textarea").prop("disabled",true).addClass("k-state-disabled");
        				fogfitup_date.enable(false);
						fog_installed.enable(false);
						issued_date.enable(false);
						deliv_to_fab.enable(false);
						Fab_dt.enable(false);
						Fab_released.enable(false);
						pcd_installed.enable(false);
						pcdfitup_date.enable(false);
						deliv_to_paint.enable(false);
						paint_date.enable(false);
						QC_releasePaint.enable(false);
						deliv_at_site.enable(false);
						$(".wrap-button button").prop("disabled",false).removeClass("k-state-disabled");
        				$(".wrap-form_qms button").prop("disabled",false).removeClass("k-state-disabled"); 
        				$(".wrap-form_qms .fogUpd button, .wrap-form_qms .pcdUpd button, .wrap-form_qms .globalUpd button, .wrap-form_qms .fabUpd button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).show();
							else
								$(this).hide();
						});
        				$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
						$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
						$("#rowSelection").data("kendoGrid").dataSource.read();
        			break;
        		}
        	}
        });
		$(".k-i-search").click(function(e){
			e.preventDefault();
			
			sentValue = $("#search").val();
			dataSource.page(1);
			dataSource.read();
		});
				$("#search").bind({
			keyup: function(e){
				if (e.keyCode == 13){
					filterFArr = [];
					if ($.trim(this.value) != ""){
						 filterFArr[filterFArr.length] = "job_no;" + this.value + ";eq";
						 filterFArr[filterFArr.length] = "plant_no;" + this.value + ";eq";
						 filterFArr[filterFArr.length] = "rev_no;" + this.value + ";eq";
					     filterFArr[filterFArr.length] = "area_no;" + this.value + ";eq";
						 filterFArr[filterFArr.length] = "drawing_no;" + this.value + ";eq";
						 filterFArr[filterFArr.length] = "spool_no;" + this.value + ";eq";
						 filterFArr[filterFArr.length] = "sheet_no;" + this.value + ";eq";
					}
					dataSource.page(1);
					dataSource.read();
				}
			}
		});
	   $("#jobSearch").bind({
			keyup: function(e){
				if (e.keyCode == 13){
					filterFArr = [];
					if ($.trim(this.value) != ""){
						filterFArr[filterFArr.length] = "job_no;" + this.value + ";eq";
					}
					
					dataSource.page(1);
					dataSource.read();
				}
			}
		});
	});
</script>