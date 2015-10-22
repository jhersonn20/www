	<div id="jwrrWindow">
	<div class="wrap-grid demo-section" style=" width: 100%;margin-left: 0; min-height: 300px;">
	        <div id="jwrr_grid" style="width: 100%;margin-bottom: 2px;"></div>   
	</div>
	<div class="buttonRight">
		<button class="k-button mainEve" id="closeWindow">Close</button>
	</div>
</div>
<div id="main-wrapper">
	<div class="wrap-button demo-section" style="width: 40%;min-height: 250px;position: fixed;top: 150px;left: 400px;">
		<fieldset style="width: 500px;">
		<legend>Transaction Slip</legend>
		<div>
			<label class="title" for="txt2" style="width: 100px;">Control No:</label><input type="text" name="txt2" id="txt2" disabled class="k-textbox k-state-disabled" style="width: 33%;"/>
			<button class="k-button mainEve" id="jwrrView">...</button>
		</div>
			<label class="title" for="txt3" style="width: 100px;">Date:</label><input type="text" name="txt3" id="txt3" style="width: 33%;"/> 
		<div >
			<label class="title" for="txt4" style="width: 100px;">Prepared By:</label><input type="text" name="txt4" id="txt4" class="k-textbox" style="width: 33%;"/> 
		</div>
		<div>
			<label class="title" for="txt5" style="width: 100px;">Check By:</label><input type="text" name="txt5" id="txt5" class="k-textbox" style="width: 33%;"/> 
		</div>
		<div>
			<label class="title" for="txt6" style="width: 100px;">Returned By:</label><input type="text" name="txt6" id="txt6" class="k-textbox" style="width: 33%;"/>
		</div>
		<div>
			<label class="title" for="txt7" style="width: 100px;">Received By:</label><input type="text" name="txt7" id="txt7" class="k-textbox" style="width: 33%;"/>
		</div>
		
		<div><br /></div>
		<div class="buttonRight">
			
				<button class="k-button mainEve" id="exportButt">Export</button>
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
			$("#txt2").val(dataItem.mrs_no);
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
                    url: crudService + "directCall/tmrsRef",
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
				      		filterVAr_jwrr[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "mrs_no");
				    
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_jwrr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "mrs_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr_jwrr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVAr_jwrr : ""),
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
                        mrs_no: { type: "string" },
                        mrs_date: { type: "string" },
                        ret_by: { type: "string" }
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
               {field: "mrs_no",title: "Mrs no",width: 120},
               {field: "mrs_date",title: "MRS Date",width: 80},
               {field: "ret_by",title: "Returned By",width: 80}
               

	
                      
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
         var today = new Date(kendo.format('{0:MM-dd-yyyy}', new Date()))
         var start = $("#txt3").kendoDatePicker({
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
	    				if (confirm("Do you really want to print this item?")){	    					
							$("#window").data("kendoWindow").setOptions({
							    title: "JWRR Printing",
							    width: "900px",
							    height: "600px"
							});
							$("#window").data("kendoWindow").refresh({
							    url: "http://" + $(location).attr('hostname') + ":8080/JavaBridge/executeReport.php?xmlFile=qms/MATERIAL RETURN SLIP&checkby=" + $("#txt5").val() + "&mrs_date=" + kendo.toString(start.value(),"yyyy-MM-dd") + "&mrs_no=" + $("#txt2").val() + "&prepby=" + $("#txt4").val() + "&recvdby=" + $("#txt7").val() + "&retrnby=" + $("#txt6").val(),
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
		    			case "exportButt":
		    			var conF = confirm("Do you want to export all Records?");
		    			if(!conF)
		    				return true;
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_tmrsRef/?";
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
		    			default:
		    			break;
		    		}
		    	}
			});

	});
</script>