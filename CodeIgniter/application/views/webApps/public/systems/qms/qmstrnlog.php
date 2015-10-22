<div id="main-wrapper">
	<div style="margin-bottom: 5px;float:right; width: 78%">
		<div class="wrap-form demo-section apply8" style="width: 100%;height: auto;display: block;padding-left: 0px;margin: 0px">
		<fieldset>
				<legend> Latest Activity: </legend>
				<div>
					<label class="title" for="username">User Name:</label><input name="username" class="k-input k-textbox" style="text-align: left;width: 150px;"
                       	    id="username"/>
	                <label class="title" for="trandate">Tran Date:</label><input name="trandate" class="k-input k-textbox" style="text-align: left;width: 100px;"
	                        id="trandate" />
	                <label class="title" for="trantime">Tran Time:</label><input name="trantime" class="k-input k-textbox" style="text-align: left;width: 100px;"
	                        id="trantime"/>
	                <label class="title" for="trantype">Tran type:</label><input name="trantype" class="k-input k-textbox" style="text-align: left;width: 96px;"
	                        id="trantype"/> 
				</div>
				<div><br /></div>
				<div>
					<label class="title" for="textarea" >Tran Desc:</label><textarea name="textarea" id="textarea" class="k-input k-textbox" cols="20" rows="3" style="resize: none;width: 90%;"></textarea>
				</div>
				
		</fieldset>
		</div>
		<div class="wrap-form demo-section apply8" style="width: 100%;display: block; margin-bottom: 20px; min-height: 730px;">
			<div id="acvty_grid"></div>
		</div>
	</div>
	<div class="wrap-grid demo-section" style=" width: 20%;margin-left: 0; min-height: 800px;">
        
        <div id="rowSelection" style="width: 100%"></div>
   	</div>
	<div class="wrap-button demo-section">
		<div class="buttonRight">
        	<button class="k-button mainEve" id="closeButt">Close</button>
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
	      dataItem = e.dataItem(selectedRows[i]);
	      	$("#username").val(dataItem.user_id);
	      	$("#trandate").val(dataItem.tran_dt);
	      	$("#trantime").val(dataItem.tran_dt);
	      	$("#trantype").val(dataItem.tran_type);
		  	$("#textarea").val(dataItem.tran_desc);
		  
			
				
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
		var crudService = crudServiceBaseUrl + "qms/index/", isFailed = false,
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", dataItem = "", 
		    filterFArr_actv = [], filterOArr_actv = [], filterVArr_actv = [],  currRow2 = "",actv_di = "",
		    cMode = "", fieldSort = "", dirSort = "";
        
		
		$(".wrap-button button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();
		});
				// -- ruser datasource -- //
				
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/ruser_ref",
                    contentType: "application/json",
                    type: "GET"
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
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "user_id");
				    query = filterFArr;
				    dirSort = ($(data.sort).length ? data.sort[0].dir : "desc")
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "user_id"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "asc")
			        }
			      }else {
			      	  data['log_user'] = $("#hidden_user").val();
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
            pageSize: 28,
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
                        user_id: { type: "string" }
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
			$("#rowSelection").data("kendoGrid").select("tr:eq(" + (acvty_ds._data.length + 2) + ")");
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
                buttonCount: 2
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
               {field: "user_id",title: "User ID",width: 107}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    	acvty_ds.read();
			    }
			  grid_change(currRow,rowSelection);
           },
           dataBound: addExtraStylingToGrid
        });
        insertGridTitle("#rowSelection","User Listing");
        
        // -- user-activity datasource -- //
				
        var acvty_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/tran_acvty_ref",
                    contentType: "application/json",
                    type: "GET"
                },                
			    parameterMap: function(data, type) {
			      if (type == "read") {
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_actv[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_actv[index] = this.operator;
				      		filterVArr_actv[index] = valForm;
				      	});
				    }
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "tran_type");
				    query = filterFArr_actv;
				    dirSort = ($(data.sort).length ? data.sort[0].dir : "desc")
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_actv,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "tran_type"),
					    operator: (($(data.filter).length > 0) ? filterOArr_actv : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_actv : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "asc"),
					    user_id : dataItem.user_id
			        }
			      }else {
			      	  data['log_user'] = $("#hidden_user").val();
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
            pageSize: 23,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
                },
                errors: function(data){
               	    if (filterFArr_actv.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue = "";
					    filterFArr_actv = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: { type: "number", editable: false },
                        user_id: { type: "string" },
                        tran_dt: { type: "date"},
                        tran_desc: { type: "string" },
                        tran_type: { type: "string" },
                        tran_count: { type: "string" }
                        
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
                                
	    var addExtraStylingToGrid2 = function(){
			$("#acvty_grid").data("kendoGrid").select("tr:eq(1)");
	        $("#acvty_grid > .k-grid-content > table > tbody > tr").hover(
	            function(){
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_actv = [];
	    };
        
        var grid2 = $("#acvty_grid").kendoGrid({
            dataSource: acvty_ds,
            selectable: "row",
            pageable: {
                buttonCount: 5
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
               {field: "user_id",title: "User ID",width: 60},
               {field: "tran_dt",title: "Tran Date",width: 80,format: "{0:MM/dd/yyyy}"},
               {field: "tran_desc",title: "Tran Desc",width: 157},
               {field: "tran_type",title: "Tran Type",width: 80},
               {field: "tran_count",title: "Tran Count",width: 90},
               
           ],
           change: function(e){
           		currRow2 = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        actv_di = this.dataItem(selectedRows[i]);
			    }
			    grid_change(currRow2,acvty_grid);
           },
           dataBound: addExtraStylingToGrid2
        });
        insertGridTitle("#acvty_grid","Activity Listing");
       
      // -- Event Handler -- //
                 
	  var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");
	    $(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
	    $(".wrap-button .buttonLeft button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "delButt":
	    				if (!confirm("Do you really want to delete this item?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
						dataRow = grid.data("kendoGrid").dataSource.getByUid(dataItem.uid);
    					$("#rowSelection").data("kendoGrid").dataSource.remove(dataRow);
						dataSource.sync();
						$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
						$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
						$("#rowSelection").data("kendoGrid").dataSource.read();
	    				return true;
	    			break;
	    			case "exportButt":
	    				var conF = confirm('Do you want to export files?');
	    					if(!conF)
	    					return true;
	    						var ladvance = confirm('Do you want to use advance tab?');
						    	open_preloader();
						    	var link = document.createElement('a');
					        	link.href = crudService + "directCall/export_twhse_mat_ps2/?";
					        	link.href += ("fieldS=" + fieldSort + "&");
					        	link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
					        	link.href += ("dir=" + dirSort + "&ladvance=" + ladvance);
					 
						        //Dispatching click event.
						        if (document.createEvent) {
						            var e = document.createEvent('MouseEvents');
						            e.initEvent('click' ,true ,true);
						            link.dispatchEvent(e);
							    	close_preloader();
						            return true;
						        }
						    
                	break;
                	case "exportButt2":
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_twhse_matspl/?";
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
                	case "exportButt3":
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_twhse_matspl/?";
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
                	case "exportButt4":
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_twhse_matspl/?";
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
                	case "exportButt5":
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_twhse_matspl/?";
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
                	case "exportButt6":
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export_twhse_matspl/?";
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
						$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", false).removeClass("k-state-disabled");
		    			if (this.id == "addButt"){
		    				isFailed = false;
							$(".wrap-form input, .wrap-form textarea").val("");
							$(".wrap-form input").eq(0).select().focus();
							$('#rad1').prop("checked", true);
							$('input[name=option]').prop("disabled", true);
							cMode = "add";
		    			}else {
							$("#txt1").prop("disabled", true).addClass("k-state-disabled");
							$(".wrap-form textarea").select().focus();
							cMode = "edit";
						}
						$(".wrap-button button").prop("disabled", true).addClass("k-state-disabled");
						forDiv();
	    			break;
	    		}
	    	}
	    });
	    $(".wrap-form button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "saveButt":
	    				if (!confirm("Are you sure you want to save this data?")){
	    					e.preventDefault();
	    					return true;
	    				}
	    				
	    				isFailed = verifyThisInput(".formLeft_qms");
			    		if (isFailed)
			    			return true;
	    				
						if (cMode == "add"){
							dataSource.add({PROGRESS_RECID: 0,
											disc_code: $("#txt1").val(),
											disc_desc: $("#textarea").val(),
											flg_status: ($("#rad1").is(":checked") ? 1 : 0)});
							dataSource.sync();
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
						}else
					        $.post(crudService + "manage/rdisc",{PROGRESS_RECID: dataItem.PROGRESS_RECID,disc_code: $("#txt1").val(), disc_desc: $("#textarea").val(), flg_status: ($("#rad1").is(":checked") ? 1 : 0)},
					       	    function(data){
									$("#rowSelection").data("kendoGrid").setDataSource(dataSource);
									$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
									$("#rowSelection").data("kendoGrid").dataSource.read();
					       	    });
	    			break;
	    			default:
	    				$(".thisIsRequired").removeClass('thisIsRequired');
		    			isFailed = false;
			    		grid_change(currRow);
	    			break;
	    		}
	    		if (isFailed)
	    			return true;
				$(".wrap-form input, .wrap-form textarea, .wrap-form button").prop("disabled", true).addClass("k-state-disabled");
				$(".wrap-button button").prop("disabled", false).removeClass("k-state-disabled");
				$("#coverDiv").remove();
	    	}
	    });
	});
</script>