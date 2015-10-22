<div id="jwrrWindow">
	<div class="wrap-grid demo-section" style=" width: 100%;margin-left: 0; min-height: 300px;">
	        <div id="jwrr_grid" style="width: 100%;margin-bottom: 2px;"></div>  
	</div>      
	<div class="buttonRight">
		<button class="k-button mainEve" id="applyButt">Apply</button>
	</div>
	
</div>

<div id="main-wrapper">
	<div class="wrap-button demo-section" style="width: 39.5%;min-height: 460px;position: fixed;top: 120px;left: 400px;">
		<fieldset style="width: 500px;">
		<div><br /></div>
		<div>Date:</div>
		<div><br /></div>
		<div>
			<input type="text" name="txt1" id="txt1" style="width: 300px;"/> 
		</div>
		<div><br /></div>
		<div>
		<label class="title" for="sel1" >Priority Code:</label><select name="sel1" id="sel1" style="width: 300px" ></select>
		</div>
		<div><br /></div>
		<div><h3>Report Option</h3></div>
		<div><br /></div>
		<div>
			<input type="radio" name="option" checked id="rad1" />ALL
		</div>
		<div><br /></div>
		<div>
			<input type="radio" name="option"  id="rad2" />Served
		</div>
		<div><br /></div>
		<div>
			<input type="radio" name="option"  id="rad3" />Fog Balance w/ Request
		</div>
		<div><br /></div>
		<div>
			<input type="radio" name="option"  id="rad4" />Client Balance w/ Request
		</div>
		<div><br /></div>
		<div>
			<input type="radio" name="option"  id="rad5" />Balance w/o Request
		</div>
		<div><br /></div>
		<div>
			<input type="radio" name="option"  id="rad6" />Balance
		</div>
		<div><br /></div>
		<div class="buttonRight">
				
				<button class="k-button mainEve" id="printButt">Print</button>
        		<button class="k-button mainEve" id="closeButt">Close</button>
        </div>	
        <div><br /></div>
        </fieldset>
		
	</div>
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
			//$("#txt2").val(dataItem.osd_no);
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
			    filterFArr_jwrr = [], filterOArr_jwrr = [], filterVAr_jwrr = [], currRow = "", jwrr_di = '', 
			    isFailed = false, fieldSort = "", dirSort = "", query = "";
			
			// -- Window event Section -- //
			$("#jwrrWindow").kendoWindow({ 
	            width: "800px",
	            height: "auto",
	            title: "JWRR No",
	            modal: true,
	            visible: false,
	            resizable: false,
	            scrollable: true,
	            open: function(){
	            	console.log(this);
	            }
	        });
			
			// -- Date Section -- //
			
			var today = new Date(kendo.format('{0:MM-dd-yyyy}', new Date()))
       	    var start = $("#txt1").kendoDatePicker({
                        value: today,
                        parseFormats: ["MM/dd/yyyy"]
                    }).data("kendoDatePicker");
        
			$(".wrap-button button").bind({
				click: function(e){
					switch(this.id){
						case "jwrrView":
		    				$("#jwrrWindow").data("kendoWindow").center().open();
		    			break
		    			
		    			default:
		    			break
		    		}
		    	}
	    	});
			
			// -- Multi Select Section -- //
			
			var priorityNo = $("#sel1").kendoMultiSelect({
            filter: "contains",
            placeholder: "Select Priority Code...",
            dataTextField: "prior_no",
            dataValueField: "prior_no",
            dataSource: {
                transport: {
                    read: {
                        url: crudService + "directCall/dd_priorNo",
                    	type: "GET"
				    }
                },
                //serverFiltering: true,
                schema: {
                    data: function(data) {
                        return data.rows || [];
                    }
                }
            },
            change: function(e){
            	if (this.value().length > 0 && this.value().indexOf("<ALL>") >= 0)
            		this.value("<ALL>");
            },
            select: function(e){
            	if (e.item.text() == "<ALL>")
            		this.value([]);
            }
        }).data("kendoMultiSelect");
        
        var areaNo = $("#sel2").kendoMultiSelect({
            filter: "contains",
            placeholder: "Select Area...",
            dataTextField: "area_no",
            dataValueField: "area_no",
            dataSource: {
                transport: {
                    read: {
                        url: crudService + "directCall/dd_areaRef",
                    	type: "GET"
				    }
                },
                //serverFiltering: true,
                schema: {
                    data: function(data) {
                        return data.rows || [];
                    }
                }
            },
            change: function(e){
            	if (this.value().length > 0 && this.value().indexOf("<ALL>") >= 0)
            		this.value("<ALL>");
            },
            select: function(e){
            	if (e.item.text() == "<ALL>")
            		this.value([]);
            }
        }).data("kendoMultiSelect");
        
        var areaLoc = $("#sel3").kendoMultiSelect({
            filter: "contains",
            placeholder: "Select Area Loc...",
            dataTextField: "area_loc",
            dataValueField: "area_loc",
            dataSource: {
                transport: {
                    read: {
                        url: crudService + "directCall/dd_arealocRef",
                    	type: "GET"
				    }
                },
                //serverFiltering: true,
                schema: {
                    data: function(data) {
                        return data.rows || [];
                    }
                }
            },
            change: function(e){
            	if (this.value().length > 0 && this.value().indexOf("<ALL>") >= 0)
            		this.value("<ALL>");
            },
            select: function(e){
            	if (e.item.text() == "<ALL>")
            		this.value([]);
            }
        }).data("kendoMultiSelect");
        
        var subSystem = $("#sel4").kendoMultiSelect({
            filter: "contains",
            placeholder: "Select Plant No...",
            dataTextField: "plant_no",
            dataValueField: "plant_no",
            dataSource: {
                transport: {
                    read: {
                        url: crudService + "directCall/dd_plantNo",
                    	type: "GET"
				    }
                },
                //serverFiltering: true,
                schema: {
                    data: function(data) {
                        return data.rows || [];
                    }
                }
            },
            change: function(e){
            	if (this.value().length > 0 && this.value().indexOf("<ALL>") >= 0)
            		this.value("<ALL>");
            },
            select: function(e){
            	if (e.item.text() == "<ALL>")
            		this.value([]);
            }
        }).data("kendoMultiSelect");
			
			// --grid section-- //
			var checkedIds = {};
			var jwrr_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/testpackRef",
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
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "testpack_no");
				    
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_jwrr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "testpack_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_jwrr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_jwrr : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "asc")
					    
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
                        testpack_no: { type: "string" },
                        sub_system: { type: "string" }
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
				if (checkedIds[view[i].testpack_no] == undefined)
					checkedIds[view[i].testpack_no] = $("#windowChk1_job").is(":checked");
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
        
        var grid = $("#jwrr_grid").kendoGrid({
            dataSource: jwrr_ds,
            selectable: "row",
            pageable: {
                buttonCount: 3,
    			input: true
            },
            autoBind: true,
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
               {field: "testpack_no",title: "JWRR No",width: 120},
               {field: "sub_system",title: "JWRR Date",width: 80},
               {
					headerTemplate:'<input id="windowChk1_job" name="windowChk1_job" type="checkbox" />',
					title: ' ',
                    template: kendo.template("<input type='checkbox' name='#= testpack_no #' id='#= testpack_no #' DISABLED  />"),
					width: 28
				}
           ],
           change: function(e){
           		// currRow = this;
			    // var selectedRows = this.select();
			    // var selectedDataItems = [];
			    // for (var i = 0; i < selectedRows.length; i++) {
			        // jwrr_di = this.dataItem(selectedRows[i]);

			        
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        jwrr_di = this.dataItem(selectedRows[i]);
				    var rowIndex = $("tr", this.tbody).index(selectedRows[i]),
				        row = this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
					checkedIds[jwrr_di.testpack_no] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").is(":checked");
					if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").is(":checked") == false)
						$("#windowChk1_job").prop("checked",false);
	           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").is(":checked"));
	           		
			        
			    }
			   // grid_change(currRow, "#jwrr_grid" );
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle('#jwrr_grid','TESTPACK'); 
		
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
				checkedIds[dataItem2.testpack_no] = currStat;
				if (currStat){
				    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#jwrr_grid').addClass('k-state-selected');
					//grid2.select(row);
				}else
					$('tr.k-state-selected','#jwrr_grid').removeClass('k-state-selected');
			});
		});


		
			// --event handler section -- //
			
			var toggleButt = function(vis){
		        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
		        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
		        });
		    }
		   	 toggleButt("show");
	  	 
		
	   
		$("#applyButt").click(function(e){
			var listOfSelected = "";
		    $("#jwrr_grid tbody input[type=checkbox]:checked").each(function(index,value){
		        listOfSelected += ((listOfSelected != "") ? "," : "") + this.id;
		    });
		    $("#textarea").val(listOfSelected);
		    
		   $("#jwrrWindow").data("kendoWindow").close();
		});
		
		
		$("#openWindow").click(function(e){
			$("#jwrrWindow").data("kendoWindow").center().open();
		});
        
			$(".wrap-button .buttonRight button").bind({
		    	click: function(e){
		    		switch(this.id){
		    			case "printButt":
		    				if (confirm("Do you really want to print this item?")){	    					
							$("#window").data("kendoWindow").setOptions({
							    title: "",
							    width: "900px",
							    height: "600px"
							});
							$("#window").data("kendoWindow").refresh({
							    url: "http://" + $(location).attr('hostname') + ":8080/JavaBridge/executeReport.php?xmlFile=qms/Structural Material Register Per Priority" + "&cprior_no=" + priorityNo.value() + "&fiAsofDt=" + kendo.toString(start.value(),"yyyy-MM-dd") + "&iOption=" + $('input[name=option]:checked').index('input[name=option]'),
							    contentType: "application/pdf"
							});
					        $("#window").data("kendoWindow").center().open();
	    					// e.preventDefault();
	    					// return true;
	    					// open_preloader();
// 	    					
							// //Dispatching click event.
					        // if (document.createEvent) {
					            // var e = document.createEvent('MouseEvents');
					            // e.initEvent('click' ,true ,true);
					            // link.dispatchEvent(e);
						    	// close_preloader();
					            // return true;
					        // }
	    				}
		    			break;
				   		case "openWindow":
				   				alert("sample");
				   				$("#jwrrWindow").data("kendoWindow").center().open();
				   		
		    			default:
		    			break;
		    		}
		    	}
			});

	});
</script>