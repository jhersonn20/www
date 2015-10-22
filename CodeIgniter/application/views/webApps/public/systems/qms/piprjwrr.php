<div id="jwrrWindow">
	<div class="wrap-grid demo-section" style=" width: 100%;margin-left: 0; min-height: 300px;">
	        <div id="jwrr_grid" style="width: 100%;margin-bottom: 2px;"></div>   
	</div>
	<div class="buttonRight">
		<button class="k-button mainEve" id="closeWindow">Close</button>
	</div>
</div>
<div id="main-wrapper">
	<div class="wrap-button demo-section" style="width: 35%;min-height: 132px;position: fixed;top: 150px;left: 400px;">
		<fieldset>
		<legend>Transaction Slip </legend>
		<div>
			<label class="title" for="txt1" style="width: 100px;">Control No:</label><input type="text"  name="txt1" id="txt1" disabled class="k-textbox k-state-disabled" style="width: 50%;"/>
			<button class="k-button mainEve" id="jwrrView">...</button>
		</div>
		<div >
			<label class="title" for="txt2" style="width: 100px;">Prepared By:</label><input type="text" name="txt2" id="txt2" class="k-textbox" style="width: 50%;"/>
		</div>
		<div>
			<label class="title" for="txt3" style="width: 100px;">Submitted By:</label><input type="text" name="txt3" id="txt3" class="k-textbox" style="width: 50%;"/>
		</div>
		<div class="buttonRight">
				<button class="k-button mainEve" id="printButt">Print</button>
        		<button class="k-button mainEve" id="closeButt">Close</button>
        </div>		
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
			$("#txt1").val(dataItem.jwrr_no);
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
			
			// --grid section-- //
			
			var jwrr_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/jwrr_info",
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
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "jwrr_no");
				    
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_jwrr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "jwrr_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_jwrr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_jwrr : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc")
					    
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
                        jwrr_no: { type: "string" },
                        rcvd_date: { type: "string" },
                        rcvd_by: { type: "string" }
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
        
        var grid = $("#jwrr_grid").kendoGrid({
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
               {field: "jwrr_no",title: "JWRR No",width: 120},
               {field: "rcvd_date",title: "JWRR Date",width: 80},
               {field: "rcvd_by",title: "Received By",width: 80}

	
                      
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        jwrr_di = this.dataItem(selectedRows[i]);
			        
			    }
			    grid_change(currRow, "#jwrr_grid" );
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle('#jwrr_grid','ISO/DWG'); 
		
			// --event handler section -- //
			
			var toggleButt = function(vis){
		        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
		        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
		        });
		    }
		   	 toggleButt("show");
	    
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
			$(".wrap-button button").bind({
				click: function(e){
					switch(this.id){
						case "jwrrView":
		    				$("#jwrrWindow").data("kendoWindow").center().open();
		    				jwrr_ds.read();
		    			break
		    			
		    			default:
		    			break
		    		}
		    	}
	    	});
			$("#jwrrWindow .buttonRight button").bind({
				click: function(e){
					switch(this.id){
					case "closeWindow":
						
		    			$("#jwrrWindow").data("kendoWindow").close();
		    			
		    		break;
					
					}
				}
			});
			
			$(".wrap-button .buttonRight button").bind({
		    	click: function(e){
		    		switch(this.id){
		    			
		    			case "printButt":
		    				case "printButt":
	    				if (confirm("Do you really want to print this item?")){	    					
							$("#window").data("kendoWindow").setOptions({
							    title: "JWRR Printing",
							    width: "900px",
							    height: "600px"
							});
							$("#window").data("kendoWindow").refresh({
							    url: "http://" + $(location).attr('hostname') + ":8080/JavaBridge/executeReport.php?xmlFile=qms/JWRR Printing&fiprepby=" + $("#txt2").val() + "&firefno=" + $("#txt1").val() + "&fisubby=" + $("#txt3").val(),
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
		    			default:
		    			break
		    		}
		    	}
			});

	});
</script>