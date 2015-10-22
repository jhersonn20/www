<style>
	#subWindow .k-grid-header {
		padding-right: 17px !important;
	}
	#subWindow .k-grid-content {
		overflow-y: scroll !important;
		height: 286px;
	}
</style>
<div id="windowMain-wrapper" style="width: 100%;">	
    <div class="demo-section" style="width: 98.2%;margin-left: 0;height: auto;">
        <div id="twjrr_engg_rs2"></div>
		<fieldset style="margin-top: 5px;">
			<ul style="width: 100%;list-style: none;">
				<li>
					<label for="win2_textarea" style="width: 100%;">Material Description</label>
				</li>
				<li>
					<ul style="width: 170px;float: right;">									
						<li>
							<label class="title" for="win2_txt1" style="width: 115px;">Total Item Count:</label><input type="text" name="win2_txt1" id="win2_txt1" disabled class="k-textbox k-state-disabled" style="width: 50px;"/>
							<label class="title" for="win2_txt2" style="width: 115px;">Total Selected:</label><input type="text" name="win2_txt2" id="win2_txt2" disabled class="k-textbox k-state-disabled" style="width: 50px;"/>
						</li>
					</ul>
					<textarea name="win2_textarea" id="win2_textarea" disabled class="k-state-disabled" cols="20" rows="3" style="resize: none;width: 475px;margin: 0;"></textarea>
				</li>
			</ul>
		</fieldset>
    </div>
	<div class="windowWrap-button demo-section">
		<div class="buttonLeft">
        	<button class="k-button mainEve" id="insButt">Insert</button>
        	<label for="win2_chk1" style="display: inline-block;line-height: 25px;vertical-align: middle;"><input type="checkbox" name="win2_chk1" id="win2_chk1" style="vertical-align: middle;" /> Check All</label>
       	</div>
	</div>
</div>
<input type="hidden" name="window_hidd_userID" id="window_hidd_userID" value="<?php echo (isset($_POST['userID'])) ? $_POST['userID'] : ""; ?>">
<input type="hidden" name="totalRows_sw" id="totalRows_sw" value="<?php echo (isset($_POST['totalRows'])) ? $_POST['totalRows'] : ""; ?>" />
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
	jQuery(document).ready(function(){	
		var crudService = crudServiceBaseUrl + "qms/index/", objLen = 0,
			disc_code = pathname.split('/')[pathname.split('/').length - 1],
			filterFArr_enggMTO = [], filterOArr_enggMTO = [], filterVArr_enggMTO = [], sentValue_enggMTO = "", checkedIds_enggMTO = {};
                            
        var twjrr_engg_ds2 = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/ttMTO1",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/ttMTO1",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						// showNotif('Warning',jqXHR.responseText,'warning');
						console.log(jqXHR.responseText);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						// else {
							// // alert("romel");
							// // enggMTO_ds.sync();
							// $("#twjrr_engg_rs22").data("kendoGrid").setDataSource(enggMTO_ds);
							// $("#twjrr_engg_rs22").data("kendoGrid").dataSource.page($("#twjrr_engg_rs22").data("kendoGrid").dataSource.page());
							// $("#twjrr_engg_rs22").data("kendoGrid").dataSource.read();
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
                    url: crudService + "manage/ttMTO1",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						showNotif('Warning',jqXHR.responseText,'warning');
	                	// if (jqXHR.responseText != '1')
							// showNotif('Warning',jqXHR.responseText,'warning');
						// else {
							// alert("romel");
							// // enggMTO_ds.sync();
							// // $("#twjrr_engg_rs22").data("kendoGrid").setDataSource(enggMTO_ds);
							// // $("#twjrr_engg_rs2").data("kendoGrid").dataSource.page($("#twjrr_engg_rs2").data("kendoGrid").dataSource.page());
							// // $("#twjrr_engg_rs2").data("kendoGrid").dataSource.read();
						// }
	                }
                },
                destroy: {
                    url: crudService + "remove/ttMTO1",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						showNotif('Warning',jqXHR.responseText,'warning');
	                	// // if (jqXHR.responseText != '1')
							// // showNotif('Warning',jqXHR.responseText,'warning');
						// // else {
							// // alert("romel");
							// // // enggMTO_ds.sync();
							// // // $("#twjrr_engg_rs2").data("kendoGrid").setDataSource(enggMTO_ds);
							// // // $("#twjrr_engg_rs2").data("kendoGrid").dataSource.page($("#twjrr_engg_rs2").data("kendoGrid").dataSource.page());
							// // // $("#twjrr_engg_rs2").data("kendoGrid").dataSource.read();
						// // }
	                }
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_enggMTO[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_enggMTO[index] = this.operator;
				      		filterVArr_enggMTO[index] = valForm;
				      	});
				    }
				    // if ($('input[name=win_option1]:checked').index('input[name=win_option1]') > 0)
				     	// filterFArr_enggMTO[filterFArr_enggMTO.length] = optionArr[$('input[name=win_option1]:checked').index('input[name=win_option1]')] + ";" + sentValue_enggMTO + ";eq";
				    // if ($('input[name=win_option2]:checked').index('input[name=win_option2]') > 0)
				     	// filterFArr_enggMTO[filterFArr_enggMTO.length] = "finalized;1;" + (($('input[name=win_option2]:checked').index('input[name=win_option2]') == 1) ? "neq" : "eq" );				     
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_enggMTO,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "logdate"),
					    operator: (($(data.filter).length > 0) ? filterOArr_enggMTO : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_enggMTO : sentValue_enggMTO),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    disc_code: disc_code,
					    loguser: $("#hidden_user").val()
			        }
			      }else {
			      	data['loguser'] = $("#hidden_user").val();
			      	data['disc_code'] = disc_code;
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
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_enggMTO.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue = "";
					    filterFArr_enggMTO = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        area_no: { type: "string" },
                        drawing_no: { type: "string" },
                        sheet_no: { type: "string" },
                        rev_no: { type: "string" },
                        mat_tag: { type: "string" },
                        ps_code: { type: "string" },
                        ps_type: { type: "string" },
                        wt_fab: { type: "number" },
                        ref_rec_qty: { type: "number" }
                    }
                },
                total: function(response) {
				   	return (($(response.rows[0]).length > 0) ? response.rows[0].total : 0);
			    }
            },
            change: function(e) {
            	$("#win2_txt1").val($(e.items).length);
            	if ($(e.items).length == 0)
            		return true;            		
            }
        });

	    var addExtraStylingToGrid_subWindow = function () {
			$("#twjrr_engg_rs2").data("kendoGrid").select("tr:eq(" + (parseInt($("#totalRows_sw").val()) + 1) + ")");
	        $("#twjrr_engg_rs2 > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }
	        );
        	filterFArr_enggMTO = [];
	    };

        var twjrr_engg_rs2 = $("#twjrr_engg_rs2").kendoGrid({
            dataSource: twjrr_engg_ds2,
            selectable: "row",
            pageable: false,
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
               {field: "area_no",title: "Area No.", width: 89},
               {field: "drawing_no",title: "ISO No.", width: 117},
               {field: "sheet_no",title: "Sht. No.", width: 89},
               {field: "rev_no",title: "Rev. No.", width: 79},
               {field: "mat_tag",title: "Mat. Tag", width: 110},
               {field: "ps_code",title: "PS Code", width: 110},
               {field: "ps_type",title: "PS Type", width: 110},
               {field: "wt_fab",title: "MTO Qty.", width: 110},
               {field: "ref_rec_qty",title: "Already Received", width: 128},
			   {
					headerTemplate:'<input id="win2_Chk1" name="win2_Chk1" type="checkbox" />',
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
			        twjrr_engg2_di = this.dataItem(selectedRows[i]);
				    var rowIndex = $("tr", this.tbody).index(selectedRows[i]),
				        row = this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
						checkedIds_enggMTO[twjrr_engg2_di.PROGRESS_RECID] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(9).find("input").is(":checked");
						if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(9).find("input").is(":checked") == false)
							$("#win2_Chk1").prop("checked",false);
		           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(9).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(9).find("input").is(":checked"));
		           	
					objLen = 0;
					$.each(checkedIds_enggMTO, function(index,value){
						if (checkedIds_enggMTO[index])
							objLen++;
					});
            		$("#win2_txt2").val(objLen);
			    }
			    // $(".jmif_phase .wrap-form input, .jmif_phase .wrap-form textarea, .jmifdtl_phase .wrap-form input, .jmifdtl_phase .wrap-form textarea").val("");
			    // grid_change(currRow,"#twjrr_engg_rs2");
			    // jmifdtl_ds.read();
           },
           dataBound: addExtraStylingToGrid_subWindow
        });
		// $("#twjrr_engg_rs2 .k-grid-toolbar").hide();
        insertGridTitle('#twjrr_engg_rs2','Engineering MTO (Piping)');
		$('#twjrr_engg_rs2 tbody').on('click',':checkbox',function(){
			if (this.checked){
				var grid2 = $('#twjrr_engg_rs2').data("kendoGrid");
			    var row = $(this).closest('tr'),
			        rowIndex = $("tr", grid2.tbody).index(row),
			        row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
			    grid2.select(row);
			}else
				$('tr.k-state-selected','#twjrr_engg_rs2').removeClass('k-state-selected');
		});
		$("#win2_Chk1, #win2_chk1").click(function () {
			$("#win2_Chk1").prop("checked", this.checked);
			$("#win2_chk1").prop("checked", this.checked);
			var grid2 = $('#twjrr_engg_rs2').data("kendoGrid")
			    currStat = this.checked;
		    $("#twjrr_engg_rs2 tbody input:checkbox").each(function(index,value){
		    	$(this).prop("checked", currStat);
			    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
			    var dataItem2 = grid2.dataItem(row);
				checkedIds_enggMTO[dataItem2.PROGRESS_RECID] = currStat;
				if (currStat){
				    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#twjrr_engg_rs2').addClass('k-state-selected');
				}else
					$('tr.k-state-selected','#twjrr_engg_rs2').removeClass('k-state-selected');
			});
			objLen = 0;
			$.each(checkedIds_enggMTO, function(index,value){
				if (checkedIds_enggMTO[index])
					objLen++;
			});
    		$("#win2_txt2").val(objLen);
		});
		$("#subWindow button").click(function(){
			// console.log(checkedIds_enggMTO);
			if (parseInt($("#win2_txt2").val()) > 0){
				if (confirm("Do you want to INSERT all selected records?")){
					var pRecid = "";
					$.each(checkedIds_enggMTO,function(index,value){
						pRecid = ($.trim(pRecid) == "") ? index : ($.trim(pRecid) + "," + index);
					});
					$.post(crudService + "manage/ttMTO1",{pRecid: pRecid, setType: "temp"},
						function(data){
							if ($.trim(data) != "1")
								showNotif("Information",data,"info");
						});
					$("#subWindow").data("kendoWindow").close();
				}
			}else
				showNotif("Information","Nothing seems to be selected!","info");
		});
	});
</script>