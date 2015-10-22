<div id="jwrrWindow">
	<div class="wrap-grid demo-section" style=" width: 100%;margin-left: 0; min-height: 300px;">
	        <div id="jwrr_grid" style="width: 100%;margin-bottom: 2px;"></div>  
	</div>      
	<div class="buttonRight">
		<button class="k-button mainEve" id="applyButt">Apply</button>
	</div>
	
</div>

<div id="main-wrapper">
	<div class="tosdhdr_phase">
		<div id="tosdhdrHead" style="min-height: 260px;margin-bottom: 5px;">
			<div class="wrap-form demo-section apply8" style="width: 27.9%;float:right;min-height: 580px;display: block;">
				<div style="margin-bottom: 20px;">
					<fieldset style="min-height: 250px;">
					<legend> JMIF Entry</legend>
						<ul class="formLeft_qms" style="width: 100%;">
							<li><br /></li>
							<li>
								<label class="title" for="txt2" style="width: 100px;">Date:</label><input required type="text" name="txt2" disabled class = "k-state-disabled" id="txt2" style="width: 155px;" />
							</li>
							<li>
								<label class="title" for="txt3" style="width: 100px;">Prepared By:</label><input required type="text" name="txt3" disabled id="txt3" class="k-textbox k-state-disabled" style="width: 155px;" />
							</li>
							<li>
								<label class="title" for="txt4" style="width: 100px;">Approved By:</label><input required type="text" name="txt4" disabled  id="txt4" class="k-textbox k-state-disabled" style="width: 155px;" />
							</li>
							<li>
								<label class="title" for="txt5" style="width: 100px;">Issued By:</label><input required type="text" name="txt5" disabled id="txt5" class="k-textbox k-state-disabled" style="width: 155px;" />
							</li>
							<li>
								<label class="title" for="txt6" style="width: 100px;">Received By:</label><input required type="text" name="txt6" disabled id="txt6" class="k-textbox k-state-disabled" style="width: 155px;" />
							</li>
							
						</ul>
					</fieldset>
				</div>
				
				<div>
					<fieldset style="min-height: 280px;">
					<legend> MWIR Entry</legend>
						<ul class="formLeft_qms" style="width: 98%;">
							<li><br /></li>
							<li>
								<label class="title" for="txt7" style="width: 100px;">Date:</label><input required type="text" disabled name="txt7" id="txt7" style="width: 155px;" />
							</li>
							<li>
								<label class="title" for="txt8" style="width: 100px;">Area Loc:</label><input required type="text" class="k-textbox k-state-disabled" disabled name="txt8" id="txt8" style="width: 155px;" />
							</li>
							<li>
								<label class="title" for="textarea" style="width: 100px;">Remarks:</label><textarea disabled name="textarea" id="textarea" cols="10" rows="3" class="" style="resize: none;width: 140px;margin: 0;"></textarea>
							</li>
							<li>
								<label class="title" for="txt9" style="width: 100px;">Requested By:</label><input required type="text" disabled name="txt9" id="txt9" class="k-textbox k-state-disabled" style="width: 155px;" />
							</li>
							<li>
								<label class="title" for="txt10" style="width: 100px;">Received By:</label><input required type="text" value="<?php echo (isset($user)) ? strtoupper($user) : ''; ?>" disabled name="txt10" id="txt10" class="k-textbox k-state-disabled" style="width: 155px;" />
							</li>
							<li>
								<label class="title" for="txt11" style="width: 100px;">Authorize By:</label><input required type="text" value="VICTOR TORRES (WPAL)" disabled name="txt11" id="txt11" class="k-textbox k-state-disabled" style="width: 155px;" />
							</li>
							<li>
								<label class="title" for="txt12" style="width: 100px;">Issued By:</label><input required type="text" name="txt12" disabled id="txt12" class="k-textbox k-state-disabled" style="width: 155px;" />
							</li>
									
						</ul>
					</fieldset>
				</div>
			</div>
			<div class="wrap-grid demo-section" style="width: 69%;margin-left: 0;min-height: 580px;">
		        <div class="wrap demo-section apply8" style="width: 60.9%;display: block;">
					<fieldset>
					
						<ul class="formLeft_qms" style="width: 100%;">
							<li>
								<label class="title" for="txt1" style="width: 100px;">Discipline:</label><input required type="text" name="txt1" id="txt1" style="width: 155px;" />
							</li>
					
							<li style="text-align: right;">
								<br />
							</li>
							<li style=" margin-left: auto;margin-right: auto;width: 40%;">
								
								<label><input type="radio" name="option" id="option1" checked /> JMIF </label>
								<label><input type="radio" name="option" id="option2" /> MWIR </label>
							</li>
						</ul>
					</fieldset>
				</div>
		        <div id="rowSelection"></div>
		    </div>
		</div>
		<div class="wrap-button demo-section">
			<div class="buttonLeft">
	        	<button class="k-button k-state-disabled" disabled id="addButt">Add</button>
	        	<button class="k-button k-state-disabled" disabled id="delButt">Delete</button>
	       	</div>
	       	<div class="buttonRight">
	       		<button class="k-button k-state-disabled" disabled id="printButt">Print</button>
	        	<button class="k-button mainEve" id="closeButt">Close</button>
	       	</div>	
		</div>
	</div>
	
	<!-- TOSD DETAIL PHASE  -->
	
	
</div>
<script type="text/javascript">
	var processMatTO = false;
	var dataItem = '';
	function grid_change(e,grid){
		if (typeof e == "undefined")
			e = grid;
		var selectedRows = e.select();
		var selectedDataItems = [];
		var dataItem = [];
		for (var i = 0; i < selectedRows.length; i++) {
			dataItem = e.dataItem(selectedRows[i]);
			$("#txt9").val();
			
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


	$(document).ready(function() {
			$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
			var crudService = crudServiceBaseUrl + "qms/index/",
			    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", currRow2 = "", cMode = "", dataItem = '', podtl_di = '', isFailed = false,
			    filterFArr_jwrr = [], filterOArr_jwrr = [], filterVAr_jwrr = [], currRow = "", jwrr_di = '', fieldSort = "", dirSort = "", query = ""
			    fieldSort = "", dirSort = "", query = "",result = '', sample_ds = [], result_ds = [];
			
			// --grid section-- //
			
			  var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/temp",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/rcontrolRef",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	console.log(jqXHR);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
						else {
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();							
						}
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
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "jmif_no");
				    query = filterFArr;
				    dirSort = ($(data.sort).length ? data.sort[0].dir : "desc")
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "logdate"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc")
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
            pageSize: 6,
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
                        disc_code: { type: "string" },
                        trancode: { type: "string" },
                        prefix: { type: "string" },
                        control_no: { type: "string" },
                        suffix: { type: "string" },
                        control_desc: { type: "string" }
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
            // dataSource: dataSource,
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
			// toolbar: ["save","cancel"],
            resizable: true,
            filterable: {
                extra: false
            },
            columns: [
               {field: "jmif_no",title: "JMIF No.",width: 85},
               {field: "jmif_date",title: "JMIF Date", width: 89, format: "{0:MM/dd/yyyy}"},
               {field: "req_by",title: "Requested By",width: 85},
               
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
			    grid_change(currRow,"#rowSelection");
			   
           },
           dataBound: addExtraStylingToGrid
        });
		// $("#rowSelection .k-grid-toolbar").hide();
        insertGridTitle('#rowSelection','Jobsite Material Insuance Form');
		 
		// -- jmif_grid section-- //
			var checkedIds = {};
			var jwrr_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/jmif_print_rep",
                    contentType: "application/json",
                    type: "GET",
	               
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_jwrr[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_jwrr[index] = this.operator;
				      		filterVArr_jwrr[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "jmif_no");
				    
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_jwrr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_date"),
					    operator: (($(data.filter).length > 0) ? filterOArr_jwrr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_jwrr : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    disc_code: disc_code.value(),
					    finalized: 1
					    
			        }
			      }else
			      	  return data;
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 10,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
					for(var i = 0; i < data.rows.length; i++) {
					    var obj = data.rows[i];
						
						for(var i2 = 0; i2 < sample_ds.length; i2++) {
						    var obj2 = sample_ds[i2];
						    
						    if(obj2.PROGRESS_RECID == obj.PROGRESS_RECID) {
						        data.rows.splice(i, 1);
						    }
					    }
					}
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_jwrr.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    filterFArr_jwrr = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        jmif_no: { type: "string" },
                        jmif_date: { type: "date" },
                        req_by: { type: "string" }
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
			$("#jwrr_grid").data("kendoGrid").select("tr:eq(1)");
	        $("#jwrr_grid > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_jwrr = [];
	    };
	    
	    var onDataBound = function (e) {
			var view = this.dataSource.view();
			/*$.each(checkedIds, function(index,value){
				alert(index + ", " + value);
			});*/
			for(var i = 0; i < view.length;i++){
				if (checkedIds[view[i].PROGRESS_RECID] == undefined)
					checkedIds[view[i].PROGRESS_RECID] = $("#windowChk1_job").is(":checked");
			    //alert("View: " + view[i].id + ", " + view[i].testpack_no);
				if(checkedIds[view[i].PROGRESS_RECID]){
					this.tbody.find("tr[data-uid='" + view[i].uid + "']")
						.addClass("k-state-selected")
						.find("input[type=checkbox]")
						.prop("checked","checked");
				}
			}			
		}
	    var checkObject = function () {
	        $(".k-grid-content > table > tbody > tr").on('click', //use k-grid only when scrollable is set to false			          
	            function() {
	            	/*$.each(this,function(index,value){
	            		alert(index + ", " + value);
	            	});*/
	                alert($(this).find('input').attr("checked")); //, true);
	            }			        
	        );
	    };
        
        var grid2 = $("#jwrr_grid").kendoGrid({
            dataSource: jwrr_ds,
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
               {field: "jmif_no",title: "JMIF No",width: 80},
               {field: "jmif_date",title: "JMIF Date",width: 80,format:'{0:MM/dd/yyyy}'},
               {field: "req_by",title: "Requested BY",width: 120},
               {
					headerTemplate:'<input id="windowChk1_job" name="windowChk1_job" type="checkbox" />',
					title: ' ',
                    template: kendo.template("<input type='checkbox' name='#= PROGRESS_RECID #' id='#= PROGRESS_RECID #' DISABLED  />"),
					width: 28
				}
           ],
           change: function(e){
           		
			    var selectedRows = this.select();
			    var selectedDataItems = [];			    
			    for (var i = 0; i < selectedRows.length; i++) {
			        jwrr_di = this.dataItem(selectedRows[i]);
				    var rowIndex = $("tr", this.tbody).index(selectedRows[i]),
				        row = this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
					checkedIds[jwrr_di.PROGRESS_RECID] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(3).find("input").is(":checked");
					if (this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(3).find("input").is(":checked")){
						$("#windowChk1_job").prop("checked",false);
						for(var i = 0; i < sample_ds.length; i++) {
						    var obj = sample_ds[i];
							
						    if(jwrr_di.PROGRESS_RECID == obj.PROGRESS_RECID) {
						        sample_ds.splice(i, 1);
						    }
						}
					}else{
						isFailed = false;
						for(var i = 0; i < sample_ds.length; i++) {
						    var obj = sample_ds[i];
							
						    if(jwrr_di.PROGRESS_RECID == obj.PROGRESS_RECID)
						    	isFailed = true;
						}
						
						if (!isFailed)
							sample_ds.push({"jmif_no": jwrr_di.jmif_no, "jmif_date": kendo.toString(jwrr_di.jmif_date,"MM/dd/yyyy"), "req_by": jwrr_di.req_by, "PROGRESS_RECID": jwrr_di.PROGRESS_RECID, "uid": jwrr_di.uid});
					}
	    			this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(3).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(3).find("input").is(":checked"));			       	
					console.log(sample_ds); 
					 	
			    }
			    // sample_ds.push(result);
			   // grid_change(currRow, "#jwrr_grid" );
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle('#jwrr_grid','JMIF NO'); 
		
		$('#jwrr_grid tbody').on('click',':checkbox',function(){
			if (this.checked){
				var grid2 = $('#jwrr_grid').data("kendoGrid");
			    //var row = grid2.dataItem($(this).closest('tr'));
			    var row = $(this).closest('tr'),
			        rowIndex = $("tr", grid2.tbody).index(row),
			        row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
			    grid2.select(row);
			}else
				$('tr.k-state-selected','#jwrr_grid').removeClass('k-state-selected');
		    
		});
		$("#windowChk1_job").click(function () {
			var grid2 = $('#jwrr_grid').data("kendoGrid")
			    currStat = this.checked;
			    
		    $("#jwrr_grid tbody input:checkbox").each(function(index,value){
		    	$(this).prop("checked", currStat);
			    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
			    var dataItem2 = grid2.dataItem(row);
				checkedIds[dataItem2.PROGRESS_RECID] = currStat;
				sample_ds.push({"jmif_no": dataItem2.jmif_no, "jmif_date":kendo.toString(dataItem2.jmif_date,"MM/dd/yyyy") , "req_by": dataItem2.req_by, "PROGRESS_RECID": dataItem2.PROGRESS_RECID, "uid": dataItem2.uid});
	           			
				if (currStat){
				    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#jwrr_grid').addClass('k-state-selected');
				    
					//grid2.select(row);
				}else
					$('tr.k-state-selected','#jwrr_grid').removeClass('k-state-selected');
			});
		});		
			// -- event handler -- //
			
			// -- kendowindow section -- //
			$("#jwrrWindow").kendoWindow({ 
	            width: "800px",
	            height: "auto",
	            title: "JMIF No",
	            modal: true,
	            visible: false,
	            resizable: false,
	            scrollable: true,
	            open: function(){
	            	sample_ds = [];
	            	for (var i=0; i < $("#rowSelection").data("kendoGrid").dataSource._data.length; i++) {	            		
					    sample_ds.push({"jmif_no": $("#rowSelection").data("kendoGrid").dataSource._data[i].jmif_no, "jmif_date":kendo.toString($("#rowSelection").data("kendoGrid").dataSource._data[i].jmif_date,"MM/dd/yyyy") , "req_by": $("#rowSelection").data("kendoGrid").dataSource._data[i].req_by, "PROGRESS_RECID": $("#rowSelection").data("kendoGrid").dataSource._data[i].PROGRESS_RECID, "uid": $("#rowSelection").data("kendoGrid").dataSource._data[i].uid});
					};
					console.log(sample_ds);
	            }
	        });
	         // -- date section -- //
			$("#txt2,#txt7").removeClass('k-state-disabled').kendoDatePicker({
			format: "MM/dd/yyyy",
			enable: false
	  		});
	  		var jmif_date = $("#txt2").data("kendoDatePicker");
	  		var mwir_date = $("#txt7").data("kendoDatePicker");
	  		var disc_code = $("#txt1").kendoComboBox({
	        	enable: true,
	            filter: "contains",
	            placeholder: "Select Discipline",
	            dataTextField: "disc_desc",
	            dataValueField: "disc_code",
				autoBind: true,
	            dataSource: {
	                transport: {
	                    read: crudService + "directCall/discRef",
	            		contentType: "application/json"
	                },
	                schema: {
						data: function(data){
		                    return data.rows || [];
		                }
				    }                    	
	            },
			    change: function(e){
			    	
			       $(".wrap-button .buttonLeft button,.wrap-button .buttonRight button").prop("disabled", false).removeClass("k-state-disabled");
			       $(".tosdhdr_phase .wrap-form input,.tosdhdr_phase .wrap-form textarea").prop("disabled", false).removeClass("k-state-disabled");
			       jmif_date.enable(true);
			       mwir_date.enable(true);
			       $("#delButt").prop("disabled", true).addClass("k-state-disabled");
			       jmif_date.enable(true);
	       		}
       	    }).data("kendoComboBox");
       	    
       	    $(".wrap-button .buttonLeft button").bind({
			    	click: function(e){
			    		switch(this.id){
		    			case "addButt":
		    				$("#jwrrWindow").data("kendoWindow").center().open();
		    				jwrr_ds.read();
		    			break;
		    			default:
		    				dataRow = grid.data("kendoGrid").dataSource.getByUid(dataItem.uid);
    						$("#rowSelection").data("kendoGrid").dataSource.remove(dataRow);
    						// $("#rowSelection").data("kendoGrid").dataSource.read();
							// dataSource.sync();
		    			break;
		    		}
		    	}
			});
			$("#jwrrWindow .buttonRight button").bind({
				click: function(e){
					switch(this.id){
					case "applyButt":
						// listOfSelected = '';
						// $("#jwrr_grid tbody input[type=checkbox]:checked").each(function(index,value){
								 // listOfSelected += ((listOfSelected != "") ? "," : "") + this.id;
						// });
						// console.log(listOfSelected);
						// result_ds.push(sample_ds);						// result_ds = result_ds.concat(sample_ds);
						sample_ds = JSON.stringify({rows: sample_ds});
						sample_ds = eval("(" + sample_ds + ")");
						$("#rowSelection").data("kendoGrid").dataSource.data(sample_ds.rows);						//alert(listOfSelected);
						// $.get(crudService + "directCall/jmif_printRpt",{listOfSelected:listOfSelected},
					       	    // function(data){
									// // console.log(data);
									// // showNotif("warning",data,"warning");
									// //var result = data;
					    // });
						$("#jwrrWindow").data("kendoWindow").close();
		    			 $("#delButt").prop("disabled", false).removeClass("k-state-disabled");
		    		break;
					
					}
				}
			});
			$(".wrap-button .buttonRight button").bind({
				click: function(e){
					switch(this.id){
					case "printButt":
						var listOfSelected = "";
						var listOfDate = "";
					    for (var i=0; i < $("#rowSelection").data("kendoGrid").dataSource._data.length; i++) {
						    //jmif_ds.push({"jmif_no": });
						   listOfSelected += ((listOfSelected != "") ? "," : "") + $("#rowSelection").data("kendoGrid").dataSource._data[i].jmif_no;
						   listOfDate += ((listOfDate != "") ? "," : "") + $("#rowSelection").data("kendoGrid").dataSource._data[i].jmif_date;
						};
						if($('input[name=option]:checked').index('input[name=option]') == 0){
							if (confirm("Do you really want to print this item?")){	    					
									$("#window").data("kendoWindow").setOptions({
									    title: "",
									    width: "900px",
									    height: "600px"
									});
									$("#window").data("kendoWindow").refresh({
									    url: "http://" + $(location).attr('hostname') + ":8080/JavaBridge/executeReport.php?xmlFile=qms/JOBSITE MATERIAL ISSUE FORM" +"&aprvdby="+ $("#txt4").val() +"&issuedby="+ $("#txt5").val() +"&jmif_date="+ kendo.toString(jmif_date.value(),"yyyy-MM-dd") + "&jmif_no="+ listOfSelected + "&prepby="+ $("#txt3").val() + "&recvby="+ $("#txt6").val(), 
									    contentType: "application/pdf"
									});
							        $("#window").data("kendoWindow").center().open();
							        }
						}else{
							if (confirm("Do you really want to print this item?")){	    					
									$("#window").data("kendoWindow").setOptions({
									    title: "",
									    width: "900px",
									    height: "600px"
									});
									$("#window").data("kendoWindow").refresh({
									    url: "http://" + $(location).attr('hostname') + ":8080/JavaBridge/executeReport.php?xmlFile=qms/MWIF" + "&arealoc=" + $("#txt8").val() + "&authorizeby=" + $("#txt11").val() + "&edremarks=" + $("#textarea").val() + "&issuedby=" + $("#txt12").val() +"&jmif_date="+ kendo.toString(mwir_date.value(),"yyyy-MM-dd") + "&jmif_no="+ listOfSelected  + "&prepby="+ $("#txt3").val() + "&recvby=" + $("#txt10").val() + "&reqstby=" + $("#txt9").val(), 
									    contentType: "application/pdf"
									});
							        $("#window").data("kendoWindow").center().open();
							        }
							
						}
					break;
					}
				}
			});

	});
</script>