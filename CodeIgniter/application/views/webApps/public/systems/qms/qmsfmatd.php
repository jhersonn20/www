<div id="main-wrapper">
	<div class="jmif_phase">
		<div id="jmifHead" style="min-height: 260px;margin-bottom: 5px;">
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
	       	</div>
			<div class="buttonRight">
	        	<button class="k-button mainEve" id="uplButt">Upload Bulk Materials</button>
	        	<button class="k-button mainEve" id="calButt">MTO Cal.</button>
	       	</div>
		</div>
	</div>
	<div class="jmifdtl_phase" style="margin-top: 5px;">
		<div id="jmifDtlHead" style="min-height: 290px;margin-bottom: 5px;">
		    <div class="wrap-grid demo-section" style="width: 98.8%;margin-left: 0;height: auto;">
		        <div id="jmifdtl_rs"></div>
		    </div>
		</div>
		<div class="wrap-button demo-section apply8">
			<div class="buttonLeft">
	        	<button class="k-button" id="saveButt2">Save</button>
	        	<button class="k-button" id="canButt2">Cancel</button>
	        	<button class="k-button mainEve k-state-disabled" id="addButt2">Add</button>
	        	<button class="k-button mainEve k-state-disabled" id="editButt2">Edit</button>
	        	<button class="k-button mainEve k-state-disabled" id="delButt2">Delete</button>
	       	</div>
			<div class="buttonRight">
	        	<button class="k-button mainEve" id="closeButt">Close</button>
	       	</div>				
		</div>
	</div>
</div>
<script type="text/javascript">
	var processMatTO = false;
	function grid_change(e,grid){
		if (typeof e == "undefined")
			e = grid;
		var selectedRows = e.select();
		var selectedDataItems = [];
		for (var i = 0; i < selectedRows.length; i++) {
			dataItem3 = e.dataItem(selectedRows[i]);
	    }
	}
	function forDiv(div){
		var container = $("#" + div);
		var position = container.offset();	
		var offsetHeight = container.height();
		var offsetWidth = container.width();
		var newDiv = $("<div id = 'coverDiv' style='z-index: 10000;position: absolute;'>").appendTo($("body"));
		newDiv.offset(position);
		newDiv.height(offsetHeight + 87);
		newDiv.width(offsetWidth);
	}
	$(document).ready(function(){
		$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
		var crudService = crudServiceBaseUrl + "qms/index/",
		    filterFArr = [], filterOArr = [], filterVArr = [], currRow = "", currRow2 = "", dataItem = '', jmifdtl_di = '', isFailed = false,
		    filterFArr_jmifdtl = [], filterOArr_jmifdtl = [], filterVArr_jmifdtl = [], fieldSort = "", dirSort = "", query = "";
		
		$(".wrap-button button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();
		});
		
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/materialRef",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/materialRef",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                update: {
                    url: crudService + "manage/materialRef",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                destroy: {
                    url: crudService + "remove/materialRef",
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
					    fieldS: ($(data.sort).length ? data.sort[0].field : "commodity_code"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "asc") 
			        }
			      }else {
			      	data.flg_status = (data.flg_status ? 1 : 0)
			      	return data;
			      }
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 8,
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
					    filterFArr = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        stock_no: { type: "string" },
                        size: { type: "string" },
                        mat_type: { type: "string" },
                        description: { type: "string" },
                        item_code: { type: "string" },
                        commodity_code: { type: "string" },
                        uom: { type: "string" },
                        schedule: { type: "string" },
                        qty_takeoff: { type: "number" },
                        qty_mrr: { type: "number" },
                        qty_issued: { type: "number" },
                        qty_returned: { type: "number" },
                        qty_rts: { type: "number" },
                        qty_onhand: { type: "number" },
                        flg_status: { type: "boolean" }
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
            columns: [
               {field: "stock_no",title: "Stock No.",width: 154},
               {field: "size",title: "Size", width: 72},
               {field: "mat_type",title: "Material Type", width: 111},
               {field: "description",title: "Description", width: 386},
               {field: "commodity_code",title: "Commodity",width: 154},
               {field: "uom",title: "UOM",width: 55},
               {field: "schedule",title: "Schedule",width: 85},
               {field: "qty_takeoff",title: "MTO Qty.", width: 103,filterable: false},
               {field: "qty_mrr",title: "MRR Qty.", width: 103,filterable: false},
               {field: "qty_issued",title: "Issued Qty.", width: 103,filterable: false},
               {field: "qty_returned",title: "Returned Qty.", width: 103,filterable: false},
               {field: "qty_rts",title: "RTS Qty.", width: 103,filterable: false},
               {field: "qty_onhand",title: "On-Hand Qty.", width: 103,filterable: false},
               {field: "flg_status",title: " ", width: 26,filterable: false, 
                    template: kendo.template("<input type='checkbox' name='stat_#= flg_status #' id='stat_#= flg_status #' disabled #= flg_status ? checked='checked' : '' # />")},
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
					jmifdtl_ds.read();
			    }
           },
           dataBound: addExtraStylingToGrid
        });
		$("#rowSelection .k-grid-toolbar").hide();
        insertGridTitle('#rowSelection','Material File');                    

        var jmifdtl_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/material_dtlRef",
                    contentType: "application/json",
                    type: "GET"
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
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_jmifdtl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "disc_code"),
					    operator: (($(data.filter).length > 0) ? filterOArr_jmifdtl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_jmifdtl : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    stock_no: dataItem.stock_no
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 8,
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
					    filterFArr_jmifdtl = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        disc_code: { type: "string" },
                        disc_desc: { type: "string" },
                        flg_status: { type: "boolean" }
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
            editable: false,
            resizable: true,
            filterable: {
                extra: false
            },
            columns: [
               {field: "disc_code",title: "Code",width: 170},
               {field: "disc_desc",title: "Description"},
               {field: "flg_status",title: " ", width: 26, filterable: false, 
                    template: kendo.template("<input type='checkbox' name='stat2_#= flg_status #' id='stat2_#= flg_status #' disabled #= flg_status ? checked='checked' : '' # />")},
           ],
           change: function(e){
           		currRow2 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        jmifdtl_di = this.dataItem(selectedRows[i]);		        
			    }
           },
           dataBound: addExtraStylingToGrid2
        });
	    $(".wrap-button button").bind({
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
			    				$("#rowSelection").data("kendoGrid").addRow();
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).find("input").focus();
			    			}else {
			    				if (typeof dataItem == "string")
			    					return true;
								cMode = "edit";
			    				$("#rowSelection").data("kendoGrid").editRow($("#rowSelection").data("kendoGrid").select());
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(7).html(dataItem.qty_takeoff);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(8).html(dataItem.qty_mrr);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(9).html(dataItem.qty_issued);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(10).html(dataItem.qty_returned);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(11).html(dataItem.qty_rts);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(12).html(dataItem.qty_onhand);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).find("input").select().focus();
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
						}else {
							if (dataItem.length == 0)
								return true;
			    			if (this.id == "addButt2")
			    				$("#rowSelection").data("kendoGrid").addRow();
			    			else {
			    				$("#rowSelection").data("kendoGrid").editRow($("#rowSelection").data("kendoGrid").select());
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(7).html(dataItem.qty_takeoff);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(8).html(dataItem.qty_mrr);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(9).html(dataItem.qty_issued);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(10).html(dataItem.qty_returned);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(11).html(dataItem.qty_rts);
								$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(12).html(dataItem.qty_onhand);
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