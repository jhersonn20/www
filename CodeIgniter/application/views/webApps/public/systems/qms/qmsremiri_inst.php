<div id="jwrrWindow">
	<div class="wrap-grid demo-section" style=" width: 100%;margin-left: 0; min-height: 300px;">
	        <div id="jwrr_grid" style="width: 100%;margin-bottom: 2px;"></div>  
	</div>      
	<div class="buttonRight">
		<button class="k-button mainEve" id="applyButt">Apply</button>
	</div>
	
</div>

<div id="main-wrapper" style="height: auto">
	<div class="wrap-button demo-section" style="width: 516px;min-height: 500px;">
		<fieldset style="width: 500px;">
		<div><br /></div>
		<div>Start Date:</div>
		<div><br /></div>
		<div>
			<input type="text" name="txt1" id="txt1" style="width: 300px;"/> 
		</div>
		<div><br /></div>
		<div>End Date:</div>
		<div><br /></div>
		<div>
			<input type="text" name="txt2" id="txt2" style="width: 300px;"/> 
		</div>
		<div><br /></div>
		<div>
			<label class="title" for="sel2">Area No:</label><select name="sel2" id="sel2" style="width: 300px;"></select>
		</div>
		<div><br /></div>
		<div><h3>Filter Option</h3></div>
		<div><br /></div>
		<div>
			<input type="radio" name="option" checked id="rad1" />All
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
			<input type="radio" name="option"  id="rad6" />All Balance
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
			
			function startChange() {
                        var startDate = start.value(),
                        endDate = end.value();

                        if (startDate) {
                            startDate = new Date(startDate);
                            startDate.setDate(startDate.getDate());
                            end.min(startDate);
                        } else if (endDate) {
                            start.max(new Date(endDate));
                        } else {
                            endDate = new Date();
                            start.max(endDate);
                            end.min(endDate);
                        }
                    }

                    function endChange() {
                        var endDate = end.value(),
                        startDate = start.value();

                        if (endDate) {
                            endDate = new Date(endDate);
                            endDate.setDate(endDate.getDate());
                            start.max(endDate);
                        } else if (startDate) {
                            end.min(new Date(startDate));
                        } else {
                            endDate = new Date();
                            start.max(endDate);
                            end.min(endDate);
                        }
                    }
			 
			 var today = new Date(kendo.format('{0:yyyy-MM-dd}', new Date()))
			 
			 var start = $("#txt1").kendoDatePicker({
                        value: today,
                        change: startChange,
                        parseFormats: ["yyyy/MM/dd"],
                        change: function(e){
		        			jwrr_ds.read();
       				    }
                    }).data("kendoDatePicker");
                    
			 var end = $("#txt2").kendoDatePicker({
                        value: today,
                        change: startChange,
                        parseFormats: ["yyyy/MM/dd"],
                        change: function(e){
		        			jwrr_ds.read();
       				    }
                    }).data("kendoDatePicker");
			
			// -- Multi Select Section -- //
			
			var priorNo = $("#sel1").kendoMultiSelect({
            filter: "contains",
            placeholder: "Select Priority No...",
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
        
        var selectPrior = $("#sel1").data("kendoMultiSelect"),
            setValue = function(e) {
                if (e.type != "keypress" || kendo.keys.ENTER == e.keyCode) {
                    selectPrior.dataSource.filter({}); //clear applied filter before setting value

                    selectPrior.value($("#prior_no").val().split(","));
                }
            };
        
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
        
         var selectAreaNo = $("#sel2").data("kendoMultiSelect"),
            setValue = function(e) {
                if (e.type != "keypress" || kendo.keys.ENTER == e.keyCode) {
                    selectAreaNo.dataSource.filter({}); //clear applied filter before setting value

                    selectAreaNo.value($("#area_no").val().split(","));
                }
            };
        
        var drawingNo = $("#sel3").kendoMultiSelect({
            filter: "contains",
            placeholder: "Select Drawing No...",
            dataTextField: "drawing_no",
            dataValueField: "drawing_no",
            dataSource: {
                transport: {
                    read: {
                        url: crudService + "directCall/dd_iso_drawingno",
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
        var selectDrawingNo = $("#sel3").data("kendoMultiSelect"),
            setValue = function(e) {
                if (e.type != "keypress" || kendo.keys.ENTER == e.keyCode) {
                    selectDrawingNo.dataSource.filter({}); //clear applied filter before setting value

                    selectDrawingNo.value($("#drawing_no").val().split(","));
                }
            };
        
        var subSystem = $("#sel4").kendoMultiSelect({
            filter: "contains",
            placeholder: "area_no",
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
                    url: crudService + "directCall/jmif_no_date_Ref",
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
					    fieldS: ($(data.sort).length ? data.sort[0].field : "jmif_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_jwrr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_jwrr : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    start: (kendo.toString(start.value(),"yyyy-MM-dd")),
					    end: (kendo.toString(end.value(),"yyyy-MM-dd"))
					    
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
                        jmif_no: { type: "string" },
                        jmif_date: { type: "date" }
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
			
			for(var i = 0; i < view.length;i++){
				if (checkedIds[view[i].jmif_no] == undefined)
					checkedIds[view[i].jmif_no] = $("#windowChk1_job").is(":checked");
			    //alert("View: " + view[i].id + ", " + view[i].testpack_no);
				if(checkedIds[view[i].jmif_no]){
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
               {field: "jmif_no",title: "JMIF No",width: 120},
               {field: "jmif_date",title: "JMIF Date",width: 80},
               {
					headerTemplate:'<input id="windowChk1_job" name="windowChk1_job" type="checkbox" />',
					title: ' ',
                    template: kendo.template("<input type='checkbox' name='#= jmif_no #' id='#= jmif_no #' DISABLED  />"),
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
					checkedIds[jwrr_di.jmif_no] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").is(":checked");
					if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").is(":checked") == false)
						$("#windowChk1_job").prop("checked",false);
	           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(2).find("input").is(":checked"));
	           		
			    }
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle('#jwrr_grid','JMIF'); 
		
		$('#jwrr_grid tbody').on('click',':checkbox',function(){
			if (this.checked){
				var grid2 = $('#jwrr_grid').data("kendoGrid");
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
				checkedIds[dataItem2.jmif_no] = currStat;
				if (currStat){
				    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#jwrr_grid').addClass('k-state-selected');
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
		    				var startDate = kendo.toString(start.value(),"yyyy-MM-dd");
			   				var endDate =  kendo.toString(end.value(),"yyyy-MM-dd");
    						var getArea  = selectAreaNo.value();
    						
    						if (confirm("Do you really want to print this item?")){	    					
							$("#window").data("kendoWindow").setOptions({
							    title: "",
							    width: "900px",
							    height: "600px"
							});
							$("#window").data("kendoWindow").refresh({
							    url: "http://" + $(location).attr('hostname') + ":8080/JavaBridge/executeReport.php?xmlFile=qms/Instrumentation Item Request  Issuance Report" + "&cArea=" + getArea + "&dtFrom=" + startDate + "&dtTo=" + endDate + "&iOption=" + $('input[name=option]:checked').index('input[name=option]'),
							    contentType: "application/pdf"
							});
					        $("#window").data("kendoWindow").center().open();
					       }
					    break;
		    		}
		    	}
			});

	});
</script>