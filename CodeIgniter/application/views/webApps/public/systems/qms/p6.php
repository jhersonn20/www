<div id="main-wrapper">
	<div class="wrap-header demo-section">
		<fieldset>
			<legend> Filter Option: </legend>
            <span class="k-textbox k-space-right" style="width: 100%;">
                <input type="text" value="" name="search" id="search" />
                <a href="#" class="k-icon k-i-search">&nbsp;</a>
            </span>
		</fieldset>
	</div>
	<div class="jmif_phase">
		<div id="jmifHead" style="min-height: 260px;margin-bottom: 5px;">
		    <div class="wrap-grid demo-section" style="width: 98.8%;margin-left: 0;height: auto;">
		        <div id="rowSelection"></div>
		    </div>
		</div>
	</div>
	<div class="wrap-button demo-section">
		<div class="buttonLeft">
        	<button class="k-button" id="saveButt">Save</button>
        	<button class="k-button" id="canButt">Cancel</button>
        	<button class="k-button mainEve" id="addButt">Add</button>
        	<button class="k-button mainEve" id="editButt">Edit</button>
        	<button class="k-button mainEve" id="delButt">Delete</button>
       	</div>
		<div class="buttonRight">
        	<button class="k-button mainEve" id="closeButt">Close</button>
       	</div>				
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var crudService = crudServiceBaseUrl + "qms/index/",
			disc_code = pathname.split('/')[pathname.split('/').length - 1], cMode = "", dataRow = "",
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", dataItem = '';
				    
	    var actStartDate = function(container, options) {					    
	        $('<input required data-text-field="' + options.field + '" data-value-field="' + options.field + '" id="act_start_date" data-bind="value:' + options.field + '"/>')
	            .appendTo(container)
	            .kendoDatePicker({
	            	format: "MM/dd/yyyy",
	            	change: function(e){
	            		if (this.value() == null){
	            			this.value('');
	            			return false;
	            		}
	            	}
	            });
        }
				    
	    var earlyStartDate = function(container, options) {					    
	        $('<input required data-text-field="' + options.field + '" data-value-field="' + options.field + '" id="early_start_date" data-bind="value:' + options.field + '"/>')
	            .appendTo(container)
	            .kendoDatePicker({
	            	format: "MM/dd/yyyy",
	            	change: function(e){
	            		if (this.value() == null){
	            			this.value('');
	            			return false;
	            		}
	            	}
	            });
        }
				    
	    var cstrDate = function(container, options) {					    
	        $('<input required data-text-field="' + options.field + '" data-value-field="' + options.field + '" id="cstr_date" data-bind="value:' + options.field + '"/>')
	            .appendTo(container)
	            .kendoDatePicker({
	            	format: "MM/dd/yyyy",
	            	change: function(e){
	            		if (this.value() == null){
	            			this.value('');
	            			return false;
	            		}
	            	}
	            });
        }
        
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/p6",
                    contentType: "application/json",
                    type: "GET"
                },
                create: {
                    url: crudService + "manage/p6",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	console.log(jqXHR);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                update: {
                    url: crudService + "manage/p6",
                    type: "POST",
	                complete: function(jqXHR, textStatus) {
	                	console.log(jqXHR);
	                	if (jqXHR.responseText != '1')
							showNotif('Warning',jqXHR.responseText,'warning');
	                }
                },
                destroy: {
                    url: crudService + "remove/p6",
                    type: "POST"
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
				    if (sentValue != "")
				    	filterFArr[filterFArr.length] = "wbs_id;" + sentValue + ";eq";
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "proj_id"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        }
			      }else {
			      	if (type == 'create')
			      		data['task_id'] = Math.floor(Math.random()*999999);
			      	
			      	//alert(data.pay_type + ", " + $("#invoice_rs").find("input[id=pay_type]").val());
					data['cmode'] = cMode;
			      	data['act_start_date'] = kendo.toString(data.act_start_date,"yyyy-MM-dd");
			      	data['early_start_date'] = kendo.toString(data.early_start_date,"yyyy-MM-dd");
			      	data['cstr_date'] = kendo.toString(data.cstr_date,"yyyy-MM-dd");
			      	data['target_start_date'] = kendo.toString(data.cstr_date,"yyyy-MM-dd");
			      	data['restart_date'] = kendo.toString(data.cstr_date,"yyyy-MM-dd");
			      	return data;
			      }
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
               	    if (filterFArr.length > 0 && $(data.rows).length == 0){
               		    notif("info","Information","No records found!");
					    sentValue = "";
					    filterFArr = [];
					    $("form.k-filter-menu button[type='reset']").trigger("click");
               	    }
                },
                model: {
               		id: "wbs_id",
                    fields: {
                   	    wbs_id: { type: "number" },
                        wbs_short_name: { type: "string" },
                        proj_id: { type: "string" },
                        task_code: { type: "string" },
                        act_start_date: { type: "date" },
                        early_start_date: { type: "date" },
                        cstr_date: { type: "date" }
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
            editable: "inline",
			toolbar: ["save","cancel"],
            resizable: true,
            filterable: {
                extra: false
            },
            columns: [
               {field: "wbs_short_name",title: "WBS Short Name",width: 85},
               {field: "proj_id",title: "Project ID", width: 89},
               {field: "wbs_id",title: "WBS ID", width: 117},
               {field: "task_code",title: "Task/Act. Code", width: 89},
               {field: "act_start_date",title: "Act. Start Date", width: 79, format: "{0:MM/dd/yyyy}",editor: actStartDate},
               {field: "early_start_date",title: "Early Start Date", width: 79, format: "{0:MM/dd/yyyy}",editor: earlyStartDate},
               {field: "cstr_date",title: "CSTR Date", width: 79, format: "{0:MM/dd/yyyy}",editor: cstrDate}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			    }
           },
           dataBound: addExtraStylingToGrid
        });
		$("#rowSelection .k-grid-toolbar").hide();
        insertGridTitle('#rowSelection','P6 Data');
        
		$(".wrap-button button").each(function(index,value){
			if (!$(this).hasClass("mainEve"))
				$(this).hide();
		});
	    $(".wrap-button button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "delButt":
	    				if (!confirm("Do you really want to delete this item?"))
	    					return true;
	    				
						dataRow = $("#rowSelection").data("kendoGrid").dataSource.getByUid(dataItem.uid);
    					$("#rowSelection").data("kendoGrid").dataSource.remove(dataRow);
						dataSource.sync();

					    setTimeout(function(){
							$("#rowSelection").data("kendoGrid").setDataSource(dataSource);	  
							$("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
							$("#rowSelection").data("kendoGrid").dataSource.read();
					    }, 100);
	    				return true;
	    			break;
	    			case "canButt":
	    			case "saveButt":
	    				if (this.id == "saveButt"){
		    				if (!confirm("Are you sure you want to save this data?")){
		    					return true;
		    				}
		    				//dataSource.options.schema.model.fields.act_start_date.validation.required = false;//

		    				$("#rowSelection .k-grid-toolbar .k-grid-save-changes").trigger( "click" );
						}else {
		    				$( "#rowSelection .k-grid-toolbar .k-grid-cancel-changes" ).trigger( "click" );
		    				
							$(".wrap-button button").each(function(index,value){
								if ($(this).hasClass("mainEve"))
									$(this).show();
								else
									$(this).hide();
							});
						}
	    			break;
	    			default:
	    				if (this.id == "closeButt")
	    					return;
						cMode = (this.id == "addButt") ? "add" : "edit";
		    			if (this.id == "addButt")
		    				$("#rowSelection").data("kendoGrid").addRow();
		    			else{
		    				$("#rowSelection").data("kendoGrid").editRow($("#rowSelection").data("kendoGrid").select());
		    				
							$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(0).html(dataItem.wbs_short_name);
							$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(1).html(dataItem.proj_id);
							$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(2).html(dataItem.wbs_id);
							$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(3).html(dataItem.task_code);
							$("#rowSelection > div.k-grid-content > table > tbody > tr.k-state-selected > td").eq(4).find("input").focus();
		    			}
		    				
						$(".wrap-button button").each(function(index,value){
							if ($(this).hasClass("mainEve"))
								$(this).hide();
							else
								$(this).show();
						});
	    			break;
	    		}
	    	}
	    });
        
		$(".k-i-search").click(function(e){
			e.preventDefault();
			
			sentValue = $("#search").val();
			grid.data("kendoGrid").dataSource.page(1);
			grid.data("kendoGrid").dataSource.read();
		});
		$("#search").bind({
			keyup: function(e){
				if (e.keyCode == 13){
					sentValue = this.value;
					grid.data("kendoGrid").dataSource.page(1);
					grid.data("kendoGrid").dataSource.read();
				}
			}
		});
	});
</script>