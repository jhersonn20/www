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
		height: 260px;
	}
</style>
<div id="win_main-wrapper" style="width: 100%;">
	<div class="jmifdtl_phase" style="width: 49%;float: right;margin-right: 5px;">
		<div id="jmifDtlHead" style="min-height: 268px;margin-bottom: 5px;">
		    <div class="wrap-grid demo-section" style="width: 98.8%;margin-left: 0;height: auto;">
		        <div id="jwrrT2_rs"></div>
		    </div>
		</div>
		<div class="wrap-button demo-section" style="width: 98.8% !important;">
			<div class="buttonLeft" style="width: 80% !important;">
	        	<!-- <button class="k-button mainEve" id="addButt"> Add (Unfinalized JWRR) </button>
	        	<button class="k-button mainEve" id="delButt"> Delete </button> -->
	        	<button class="k-button mainEve" id="finButt2"> Bulk Finalize </button>
	        	<button class="k-button mainEve" id="remButt"> Bulk Remove </button>
	       	</div>
			<!-- <div class="buttonRight">
	        	<button class="k-button mainEve" id="closeButt">Close</button>
	       	</div> -->		
		</div>
	</div>
	<div class="jmif_phase" style="width: 49%;">
		<div id="jmifHead" style="min-height: 260px;margin-bottom: 5px;">
		    <div class="wrap-grid demo-section" style="width: 98.8%;margin-left: 0;height: auto;">
		        <div id="jwrrT1_rs"></div>
		    </div>
		</div>
		<div class="wrap-button demo-section" style="width: 98.8% !important;">
			<div class="buttonLeft" style="width: 100% !important;">
	        	<!-- <button class="k-button mainEve" id="addButt"> Add (Finalized JWRR) </button>
	        	<button class="k-button mainEve" id="delButt"> Delete </button> -->
	        	<button class="k-button mainEve" id="finButt"> Bulk Unfinalize </button>
	       	</div>
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
	    }   
	}
	function forDiv(){
		var container = $("#jwrrT1_rs");
		var container2 = $("#jwrrT2_rs");
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
		    filterFArr_treqDtl = [], filterOArr_treqDtl = [], filterVArr_treqDtl = [], sentValue = "", currRow = "", currRow2 = "", cMode = "", jwrrT1_di = '', jwrrT2_di = '', isFailed = false,
		    filterFArr_jmifdtl = [], filterOArr_jmifdtl = [], filterVArr_jmifdtl = [], sentValue_jmifdtl = "", fieldSort = "", dirSort = "", query = "", down_di = '', up_di = '',
			optionArr = ["","jmif_no","jmif_date","supp_code","pl_dn_inv","po_no","deliv_by"],			
			indexArr = [], checkedIds = {}, checkedIds2 = {};
                    
        var jwrrT1_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/tjwrr_upd",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/tjwrr_upd",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						console.log(jqXHR.responseText);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                update: {
                    url: crudService + "manage/tjwrr_upd",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                destroy: {
                    url: crudService + "remove/tjwrr_upd",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						showNotif('Warning',jqXHR.responseText,'warning');
	                }
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
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_treqDtl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "jwrr_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_treqDtl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_treqDtl : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    disc_code: disc_code,
					    finalized: 1
			        }
			      }else
			      	console.log(data);
			      	data['log_user'] = $("#hidden_user").val();
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
                        jwrr_no: { type: "string" },
                        jwrr_date: { type: "date" },
                        pr_po_no: { type: "string" }
                    }
                },
                total: function(response) {
				   	return (($(response.rows[0]).length > 0) ? response.rows[0].total : 0);
			    }
            },
            change: function(e) {
            	jwrrT2_ds.read();
            	if ($(e.items).length == 0)
            		return true;
            }
        });

	    var addExtraStylingToGrid = function () {
			$("#jwrrT1_rs").data("kendoGrid").select("tr:eq(1)");
	        $("#jwrrT1_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }
	        );
        	filterFArr_treqDtl = [];        	
        	
			var view = this.dataSource.view();
			for(var i = 0; i < view.length;i++){
				if (checkedIds[view[i].PROGRESS_RECID] == undefined)
					checkedIds[view[i].PROGRESS_RECID] = $("#windowChk1_job").is(":checked");
				if(checkedIds[view[i].PROGRESS_RECID]){
					this.tbody.find("tr[data-uid='" + view[i].uid + "']")
						.addClass("k-state-selected")
						.find("input[type=checkbox]")
						.prop("checked","checked");
				}
			}
	    };

        var jwrrT1_rs = $("#jwrrT1_rs").kendoGrid({
            dataSource: jwrrT1_ds,
            selectable: "multiple, row",
            pageable: false,
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
               {field: "jwrr_no",title: "JWRR No.",width: 85},
               {field: "jwrr_date",title: "JWRR Date", width: 89, format: "{0:MM/dd/yyyy}"},
               {field: "pr_po_no",title: "PR/PO No.", width: 79},
			   {
					headerTemplate:'<input id="windowChk1_job" name="windowChk1_job" type="checkbox" />',
					title: ' ',
                    template: kendo.template("<input type='checkbox' name='#= PROGRESS_RECID #' id='#= PROGRESS_RECID #' disabled />"),
					width: 16
			   }
           ],
           change: function(e){
           		currRow = this;
			    selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        jwrrT1_di = this.dataItem(selectedRows[i]);
				    var rowIndex = $("tr", this.tbody).index(selectedRows[i]),
				        row = this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
					checkedIds[jwrrT1_di.PROGRESS_RECID] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(3).find("input").is(":checked");
					if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(3).find("input").is(":checked") == false)
						$("#windowChk1_job").prop("checked",false);
	           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(3).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(3).find("input").is(":checked"));
			    }
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle('#jwrrT1_rs','JWRR List (Finalized)');
		$('#jwrrT1_rs tbody').on('click',':checkbox',function(){
			if (this.checked){
				var grid2 = $('#jwrrT1_rs').data("kendoGrid");
			    var row = $(this).closest('tr'),
			        rowIndex = $("tr", grid2.tbody).index(row),
			        row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
			    grid2.select(row);
			}else
				$('tr.k-state-selected','#jwrrT1_rs').removeClass('k-state-selected');
		});
		$("#windowChk1_job").click(function () {
			var grid2 = $('#jwrrT1_rs').data("kendoGrid")
			    currStat = this.checked;
		    $("#jwrrT1_rs tbody input:checkbox").each(function(index,value){
		    	$(this).prop("checked", currStat);
			    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
			    var dataItem2 = grid2.dataItem(row);
				checkedIds[dataItem2.PROGRESS_RECID] = currStat;
				if (currStat){
				    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#jwrrT1_rs').addClass('k-state-selected');
				}else
					$('tr.k-state-selected','#jwrrT1_rs').removeClass('k-state-selected');
			});
		});
                    
        var jwrrT2_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/tjwrr_upd",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/tjwrr_upd",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	console.log(jqXHR);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                update: {
                    url: crudService + "manage/tjwrr_upd",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	console.log(jqXHR);
						showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                destroy: {
                    url: crudService + "remove/tjwrr_upd",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
						showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_jmifdtl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_jmifdtl[index] = this.operator;
				      		filterVArr_jmifdtl[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "jwrr_no");
				    query = filterFArr_jmifdtl;
				    dirSort = ($(data.sort).length ? data.sort[0].dir : "desc");
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_jmifdtl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "jwrr_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_jmifdtl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_jmifdtl : sentValue_jmifdtl),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    disc_code: disc_code,
					    finalized: 0
			        }
			      }else{
			      	  data['log_user'] = $("#hidden_user").val();
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
                        jwrr_no: { type: "string" },
                        jwrr_date: { type: "date" },
                        pr_po_no: { type: "string" }
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
                                
	    var addExtraStylingToGrid2 = function () {
			$("#jwrrT2_rs").data("kendoGrid").select("tr:eq(" + (jwrrT1_ds._data.length + 2) + ")");
	        $("#jwrrT2_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_jmifdtl = [];    	
        	
			var view = this.dataSource.view();
			for(var i = 0; i < view.length;i++){
				if (checkedIds2[view[i].PROGRESS_RECID] == undefined)
					checkedIds2[view[i].PROGRESS_RECID] = $("#windowChk2_job").is(":checked");
				if(checkedIds2[view[i].PROGRESS_RECID]){
					this.tbody.find("tr[data-uid='" + view[i].uid + "']")
						.addClass("k-state-selected")
						.find("input[type=checkbox]")
						.prop("checked","checked");
				}
			}
	    };
        
        var jwrrT2_rs = $("#jwrrT2_rs").kendoGrid({
            dataSource: jwrrT2_ds,
            selectable: "multiple, row",
            pageable: false,
            autoBind: false,
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: false,
            resizable: true,
            filterable: false,
            columns: [
               {field: "jwrr_no",title: "JWRR No.",width: 85},
               {field: "jwrr_date",title: "JWRR Date", width: 89, format: "{0:MM/dd/yyyy}"},
               {field: "pr_po_no",title: "PR/PO No.", width: 79},
			   {
					headerTemplate:'<input id="windowChk2_job" name="windowChk2_job" type="checkbox" />',
					title: ' ',
                    template: kendo.template("<input type='checkbox' name='#= PROGRESS_RECID #' id='#= PROGRESS_RECID #' disabled />"),
					width: 16
			   }
           ],
           change: function(e){
           		currRow2 = this;
			    selectedRows2 = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows2.length; i++) {
			        jwrrT2_di = this.dataItem(selectedRows2[i]);
				    var rowIndex = $("tr", this.tbody).index(selectedRows2[i]),
				        row = this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
					checkedIds2[jwrrT2_di.PROGRESS_RECID] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(3).find("input").is(":checked");
					if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(3).find("input").is(":checked") == false)
						$("#windowChk2_job").prop("checked",false);
	           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(3).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(3).find("input").is(":checked"));
			    }
           },
           dataBound: addExtraStylingToGrid2
        });
        insertGridTitle('#jwrrT2_rs','JWRR List (Unfinalized)');  
		$('#jwrrT2_rs tbody').on('click',':checkbox',function(){
			if (this.checked){
				var grid2 = $('#jwrrT2_rs').data("kendoGrid");
			    var row = $(this).closest('tr'),
			        rowIndex = $("tr", grid2.tbody).index(row),
			        row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
			    grid2.select(row);
			}else
				$('tr.k-state-selected','#jwrrT2_rs').removeClass('k-state-selected');
		});
		$("#windowChk2_job").click(function () {
			var grid2 = $('#jwrrT2_rs').data("kendoGrid")
			    currStat = this.checked;
		    $("#jwrrT2_rs tbody input:checkbox").each(function(index,value){
		    	$(this).prop("checked", currStat);
			    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
			    var dataItem2 = grid2.dataItem(row);
				checkedIds2[dataItem2.PROGRESS_RECID] = currStat;
				if (currStat){
				    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#jwrrT2_rs').addClass('k-state-selected');
				}else
					$('tr.k-state-selected','#jwrrT2_rs').removeClass('k-state-selected');
			});
		});     	    	            

		$("#window button").bind({
        	click: function(e){
        		var buttID = this.id;
        		var selectedDS = ((buttID == "finButt") ? jwrrT1_ds : jwrrT2_ds);
        		var selectedDS_d = selectedDS.data();
        		var selectedID = ((buttID == "finButt") ? checkedIds : checkedIds2);
        		// var selectedEve = ((buttID == "remButt") ? selectedDS_d : selectedID);
				$.each(selectedDS_d, function(index, value){
					if (selectedID[selectedDS_d[index].PROGRESS_RECID]){
						if (buttID == "remButt"){
							selectedDS.remove(selectedDS_d[index]);
							selectedDS.sync();
						}else {
							// selectedDS.add({PROGRESS_RECID: selectedDS_d[index].PROGRESS_RECID,
											// jwrr_no: 'ROMEL-C-GOMEZ',
											// sp: ((buttID == "finButt") ? "bulkUpd" : "bulkUpd2")});
							// selectedDS.sync();
							$.post(crudService + "manage/tjwrr_upd",{PROGRESS_RECID: selectedDS_d[index].PROGRESS_RECID, sp: ((buttID == "finButt") ? "bulkUpd" : "bulkUpd2"), log_user: $("#hidden_user").val()},
								function(data){
									if (data != '1')
										showNotif("Information",data,"info");
										
									jwrrT1_ds.read();									
								});
						}
					}
				});
				jwrrT1_ds.read();
        	}
        });
		
	    // $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");

		// $("#txt2").removeClass('k-state-disabled').kendoDatePicker({
			// format: "MM/dd/yyyy",
			// enable: false
		// });
		// $("#win_txt1, #win_txt2").removeClass('k-state-disabled').kendoNumericTextBox({
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
		// var jmif_date = $("#txt2").data("kendoDatePicker");
		// var total1 = $("#win_txt1").data("kendoNumericTextBox");
		// var total2 = $("#win_txt2").data("kendoNumericTextBox");
		// var supp_code = $("#txt3").data("kendoComboBox");
		// var stock_no = $("#win_txt1").data("kendoComboBox");
		
		// $(".jmif_phase .wrap-button button").bind({
        	// click: function(e){
        		// switch(buttID){
        			// case "downButt":
						// for (var i = 0; i < selectedRows.length; i++) {
				        	// down_di = currRow.dataItem(selectedRows[i]);
				        	// down_di['jwrr_qty'] = down_di.req_qty;
				        	// down_di['remarks'] = '';
// 		
							// jwrrT2_ds.push(down_di);
							// indexArr.push(down_di);
					        // $.post(crudService + "remove/tjmif",{PROGRESS_RECID: down_di.PROGRESS_RECID},
					       	    // function(data){
									// jwrrT1_ds.sync();
									// $("#jwrrT1_rs").data("kendoGrid").setDataSource(jwrrT1_ds);
									// $("#jwrrT1_rs").data("kendoGrid").dataSource.page($("#jwrrT1_rs").data("kendoGrid").dataSource.page());
									// $("#jwrrT1_rs").data("kendoGrid").dataSource.read();
					       	    // });
						// }
						// jwrrT2_ds.sync();
						// $("#jwrrT2_rs").data("kendoGrid").dataSource.data(jwrrT2_ds);
						// $("#jwrrT2_rs").data("kendoGrid").dataSource.page($("#jwrrT2_rs").data("kendoGrid").dataSource.page());
						// $("#jwrrT2_rs").data("kendoGrid").dataSource.read();
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
						// $.each(jwrrT2_ds.data(),function(index,value){
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
							// jwrrT1_ds.add(postInfo);
	    					// var removeThis;
	    					// $.each(jwrrT2_ds, function(index3, value3){
	    						// if (value3.uid == value.uid){
	    							// removeThis = index3;
	    							// return;
	    						// }
	    					// });
	    					// jwrrT2_ds.splice(removeThis,1);
						// });
						// jwrrT1_ds.sync();
						// $("#jwrrT1_rs").data("kendoGrid").setDataSource(jwrrT1_ds);
						// $("#jwrrT1_rs").data("kendoGrid").dataSource.page($("#jwrrT1_rs").data("kendoGrid").dataSource.page());
						// $("#jwrrT1_rs").data("kendoGrid").dataSource.read();
// 
						// jwrrT2_ds.read();
        			// break;
        		// }
        	// }
        // });
        
	    // $(".jmifdtl_phase .wrap-button .buttonLeft button").bind({
	    	// click: function(e){
	    		// $.post(crudService + "manage/setTJWRR",{jsonData: JSON.stringify({item: jwrrT2_ds.data()}), jwrr_no: $("#txt1").val(), disc_code: "pip", jmif_no: $("#textarea1").val(), log_user: $("#hidden_user").val()},
		    		// function(data){
		    			// if ($.trim(data) != "1")
		    				// showNotif("Information",data,"info");
		    			// else
		    				// $("#window").data("kendoWindow").close();
		    		// });
	    	// }
	    // });
	    // $(".jmifdtl_phase .wrap-form button").bind({
	    	// click: function(e){
				// $.each(jwrrT2_ds, function(index3, value3){
					// if (value3.uid == jwrrT2_di.uid){
			        	// value3.jwrr_qty = jmif_qty.value();
			        	// value3.remarks = $("#win_textarea1").val();
						// jwrrT2_ds.read();
						// showNotif("Information","Record successfully updated.","info")
						// return;
					// }
				// });
	    	// }
	    // });
		// $("#jmifDtlHead").css({"min-height": ((parseInt($("#jmifDtlHead .wrap-form").height()) + 12) + "px")});
	});
</script>