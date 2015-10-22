<style>
	#rowSelection > .k-grid-content {height: 172px;}
	.clients .k-upload-files {width: 605px !important;}
	#upl_rs > .k-grid-content, #dl_rs > .k-grid-content {height: 405px;}
</style>
<div class="signup">
	<h1> Sign Up </h1> | <a href="#"> User Reference </a> <!--| <a href="#"> Preferences </a>-->
	<hr style="margin: 3px 0;" />
	<ul>			
		<li> <label class="title" for="client" style="width: 36%;">Client:</label><input required type="text" name="client" id="client" style="width: 53%" />
			<button type="button" name="client_ref" id="client_ref" class="k-button">...</button>
		</li>
		<li> <label class="title" for="first_name" style="width: 36%;">First Name:</label><input required type="text" name="first_name" id="first_name" class="k-textbox" style="width: 62%;" /> </li>
		<li> <label class="title" for="last_name" style="width: 36%;">Last Name:</label><input required type="text" name="last_name" id="last_name" class="k-textbox" style="width: 62%;" /> </li>
		<li> <label class="title" for="email_add" style="width: 36%;">Email Address:</label><input required type="text" name="email_add" id="email_add" class="k-textbox" style="width: 62%;" /> </li>
		<li> <label class="title" for="user_id" style="width: 36%;">User ID:</label><input required type="text" name="user_id" id="user_id" class="k-textbox" style="width: 62%;" /> </li>
		<li> <label class="title" for="pword" style="width: 36%;">Password:</label><input required type="text" name="pword" id="pword" class="k-textbox" style="width: 53%;" />
			<button type="button" name="gen_pw" id="gen_pw" class="k-button">...</button> </li>
<!-- 		<li> <label class="title" for="conf_pword" style="width: 36%;">Confirm Password:</label><input required type="password" name="conf_pword" id="conf_pword" class="k-textbox" style="width: 62%;" /> </li> -->
		<li> <label class="title" for="expiry_date" style="width: 36%;">Expiry Date:</label><input required type="text" name="expiry_date" id="expiry_date" style="width: 62%;" /> </li>
	</ul>
	<hr style="margin: 3px 0;" />
	<button name="create" id="create" class="k-button" style="float: right;">Create</button>
</div>
<div class="latest">
	<h1> Latest / Un-Open Uploads </h1>
	<hr style="margin: 3px 0;" />
    <div class="wrap-grid" style="width: 100%;">
        <div id="rowSelection"></div>
    </div>
    <div class="module_footer">
		<hr style="margin: 3px 0;" />
		<button name="open" id="open" class="k-button k-state-disabled" disabled style="display: none;"> Open </button>
		<button name="download" id="download" class="k-button k-state-disabled" disabled> Download </button>
    </div>
</div>
<div class="clients">
	<h1> Files </h1>
	<hr style="margin: 3px 0;" />
    <div id="tabstrip" class="login">
		<ul>
		    <li class="k-state-active login">
		    	Upload
		    </li>
		    <li class="login">
		    	Download
		    </li>
		    <li class="login">
		    	Re-activate
		    </li>
		</ul>
		<div class="login">
			<div class="wrap-system">
				<form method="post" action="submit" style="width: 100%;margin-bottom: 5px;">
			        <div class="demo-section">
			            <input name="files" id="files" type="file" />
			        </div>
			    </form>	
			    <div class="wrap-grid demo-section" style="width: 98.8%;">
			        <div id="upl_rs"></div>
			    </div>
			</div>
		</div>
		<div class="login">
			<div class="wrap-system">
			    <div class="wrap-grid demo-section" style="width: 98.8%;">
			        <div id="dl_rs"></div>
			    </div>
			    <div class="module_footer">
					<hr style="margin: 3px 0;" />
					<button name="open2" id="open2" class="k-button k-state-disabled" disabled style="display: none;"> Open </button>
					<button name="download2" id="download2" class="k-button k-state-disabled" disabled> Download </button>
			    </div>
			</div>
		</div>
		<div class="login">
			<div class="wrap-system">
			    <div class="wrap-grid demo-section" style="width: 98.8%;">
			        <div id="react_rs"></div>
			    </div>
			    <div class="module_footer">
					<hr style="margin: 3px 0;" />
					<input required type="text" name="exp_users" id="exp_users" disabled style="width: 99.8%;margin-bottom: 3px;" />
					<button type="button" name="apply" id="apply" class="k-button k-state-disabled" disabled> Apply </button>
			    </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){   
		var crudService = crudServiceBaseUrl + "index/", 
			isFailed = false, client = <?php echo (isset($client_id)) ? $client_id : 0; ?>, fileName = "", var_cds = {},
			filterFArr = [], filterOArr = [], filterVArr = [], 
			filterFArr_upl = [], filterOArr_upl = [], filterVArr_upl = [], 
			filterFArr_dl = [], filterOArr_dl = [], filterVArr_dl = [],
			filterFArr_react = [], filterOArr_react = [], filterVArr_react = [],
			dataItem = {}, upl_di = {}, dl_di = {}, react_di = {}, checkedIds = {}, checkedIds2 = {}, checkedIds3 = {},
			currRow = "", currRow_upl = "", currRow_dl = "", upload_count = 0, log_user = '<?php echo $user_id; ?>';
			
        // $("#arccMenu").append("<a href='/codeIgniter/index.php/portal/index/offCredentials'> Sign-Out </a>");
			 
		var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/files",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
				    filterFArr[0] = "client_id;15;neq";
				    filterFArr[1] = "date_open;;in";
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
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_time"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    type_of_trans: "download",
					    client_id: client
					    
			        }
			      }
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 15,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
               },
               errors: function(data){
               	if (filterFArr.length > 0 && $(data.rows).length == 0){
               		showNotif("Information","No records found!","information");
					filterFArr = [];
					$("#rowSelection form.k-filter-menu button[type='reset']").trigger("click");
               	}
               },
               model: {
               		id: "id",
                    fields: {
                   	    id: {type: "number", editable: false},
				        name: {type: "string", editable: false},
				        remarks: {type: "string", editable: false},
				        log_created: {type: "string", editable: false},
				        client_id: {type: "number", editable: false}
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
	        $("#rowSelection > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr = [];
	    };

		//on dataBound event restore previous selected rows:
		var onDataBound = function (e) {
			var view = this.dataSource.view();
			/*$.each(checkedIds, function(index,value){
				alert(index + ", " + value);
			});*/
			for(var i = 0; i < view.length;i++){
				if (checkedIds[view[i].id] == undefined)
					checkedIds[view[i].id] = $("#file_chk").is(":checked");
			    //alert("View: " + view[i].id + ", " + view[i].PROGRESS_RECID);
				if(checkedIds[view[i].id]){
					this.tbody.find("tr[data-uid='" + view[i].uid + "']")
						.addClass("k-state-selected")
						.find("input[type=checkbox]")
						.prop("checked","checked");
				}
			}			
		}
        
        var grid = $("#rowSelection").kendoGrid({
            dataSource: dataSource,
            selectable: "multiple,row",
            pageable: {
                buttonCount: 3
                // refresh: true,
                // pageSizes: true,
    			// input: true
            },
            autoBind: true,
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: false,
            resizable: true,
            editable: false,
            filterable: {
                extra: false
            },
            columns: [
				{
					headerTemplate:'<input id="file_chk" name="file_chk" type="checkbox" />',
					title: ' ',
                    template: kendo.template("<input type='checkbox' name='#= id #' id='#= id #' disabled />"),
					width: 28
				},
	    	   {field: "client_name",title: "Client Name", width: 100},
		       {field: "name",width: 290,title: "Name"},
		       // {field: "remarks",width: 350,title: "Remarks"},
		       {field: "log_created",title: "Logs"}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			        typeArr = dataItem.name.split(".");
			        if (typeArr[typeArr.length - 1].toLowerCase() != "pdf")
			        	$("#open").addClass("k-state-disabled").prop("disabled", true);
			        else
			        	$("#open").removeClass("k-state-disabled").prop("disabled", false);
			        	
				    var rowIndex = $("tr", this.tbody).index(selectedRows[i]),
				        row = this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
					checkedIds[dataItem.id] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").is(":checked");
					if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").is(":checked") == false)
						$("#file_chk").prop("checked",false);
	           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").is(":checked"));
	           		
	           		$.each(checkedIds,function(index,value){
	           			if (value){
							$('#download').removeClass('k-state-disabled').prop("disabled", false);
							return false;	
						}           			
						$('#download').addClass('k-state-disabled').prop("disabled", true);
	           		});
			    }
           },
           dataBound: onDataBound
           // dataBound: addExtraStylingToGrid
        });
		$('#rowSelection tbody').on('click',':checkbox',function(){
			if (this.checked){
				var grid2 = $('#rowSelection').data("kendoGrid");
			    //var row = grid2.dataItem($(this).closest('tr'));
			    var row = $(this).closest('tr'),
			        rowIndex = $("tr", grid2.tbody).index(row),
			        row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
			    grid2.select(row);
				$('#download').removeClass('k-state-disabled').prop("disabled", false);
			}else{
				$('tr.k-state-selected','#rowSelection').removeClass('k-state-selected');
				$('#download').addClass('k-state-disabled').prop("disabled", true);
			}
		    //alert($("tr", grid2.tbody).index(row)); //$(this).is(':checked')
		    /*if($(this).is(':checked')){        
		        array[id] = true;
		    }else{
		    	array[id] = false;
		    }*/
		});
		$("#file_chk").click(function () {
			var grid2 = $('#rowSelection').data("kendoGrid")
			    currStat = this.checked;
		    $("#rowSelection tbody input:checkbox").each(function(index,value){
		    	$(this).prop("checked", currStat);
			    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
			    var dataItem2 = grid2.dataItem(row);
				checkedIds[dataItem2.id] = currStat;
				if (currStat){
				    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#rowSelection').addClass('k-state-selected');
					$('#download').removeClass('k-state-disabled').prop("disabled", false);
					//grid2.select(row);
				}else {
					$('tr.k-state-selected','#rowSelection').removeClass('k-state-selected');
					$('#download').addClass('k-state-disabled').prop("disabled", true);
				}
			});
		});
        // insertGridTitle("#rowSelection","List of Files");
        var upl_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/files",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
				    filterFArr_upl[0] = "client_id;" + client + ";eq";
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_upl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_upl[index] = this.operator;
				      		filterVArr_upl[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_upl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_time"),
					    operator: (($(data.filter).length > 0) ? filterOArr_upl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_upl : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        }
			      }
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 15,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
               },
               errors: function(data){
               	if (filterFArr_upl.length > 0 && $(data.rows).length == 0){
               		showNotif("Information","No records found!","information");
					filterFArr_upl = [];
					$("#upl_rs form.k-filter-menu button[type='reset']").trigger("click");
               	}
               },
               model: {
               		id: "id",
                    fields: {
                   	    id: {type: "number", editable: false},
				        name: {type: "string", editable: false},
				        remarks: {type: "string", editable: false},
				        log_created: {type: "string", editable: false}
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
                                
	    var addExtraStylingToGrid_upl = function () {
			$("#upl_rs").data("kendoGrid").select("tr:eq(" + (dataSource._data.length + 2) + ")");
	        $("#upl_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_upl = [];
	    };
        
        var upl_rs = $("#upl_rs").kendoGrid({
            dataSource: upl_ds,
            selectable: "row",
            pageable: {
                buttonCount: 5,
                refresh: true,
                pageSizes: true,
    			input: true
            },
            autoBind: true,
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: false,
            resizable: true,
            editable: false,
            filterable: {
                extra: false
            },
            columns: [
		       {field: "name",width: 234,title: "Name"},
		       {field: "remarks",width: 480,title: "Remarks"},
		       {field: "log_created",title: "Logs"}
           ],
           change: function(e){
           		currRow_upl = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        upl_di = this.dataItem(selectedRows[i]);
			    }
           },
           dataBound: addExtraStylingToGrid_upl
        });
        insertGridTitle("#upl_rs","List of Files");
        
        var dl_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/files",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
				    filterFArr_dl[0] = "client_id;15;" + (client == 15 ? "neq" : "eq");
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_dl[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_dl[index] = this.operator;
				      		filterVArr_dl[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_dl,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_time"),
					    operator: (($(data.filter).length > 0) ? filterOArr_dl : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_dl : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    type_of_trans: "download",
					    client_id: client
			        }
			      }
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 15,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
               },
               errors: function(data){
               	if (filterFArr_dl.length > 0 && $(data.rows).length == 0){
               		showNotif("Information","No records found!","information");
					filterFArr_dl = [];
					$("#dl_rs form.k-filter-menu button[type='reset']").trigger("click");
               	}
               },
               model: {
               		id: "id",
                    fields: {
                   	    id: {type: "number", editable: false},
				        name: {type: "string", editable: false},
				        remarks: {type: "string", editable: false},
				        log_created: {type: "string", editable: false}
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
                                
	    var addExtraStylingToGrid_dl = function () {
			$("#dl_rs").data("kendoGrid").select("tr:eq(" + (dataSource._data.length + upl_ds._data.length + 3) + ")");
	        $("#dl_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr_dl = [];
	    };

		//on dataBound event restore previous selected rows:
		var onDataBound_dl = function (e) {
			var view = this.dataSource.view();
			/*$.each(checkedIds, function(index,value){
				alert(index + ", " + value);
			});*/
			for(var i = 0; i < view.length;i++){
				if (checkedIds2[view[i].id] == undefined)
					checkedIds2[view[i].id] = $("#file_chk2").is(":checked");
			    //alert("View: " + view[i].id + ", " + view[i].PROGRESS_RECID);
				if(checkedIds2[view[i].id]){
					this.tbody.find("tr[data-uid='" + view[i].uid + "']")
						.addClass("k-state-selected")
						.find("input[type=checkbox]")
						.prop("checked","checked");
				}
			}			
		};
        
        var dl_rs = $("#dl_rs").kendoGrid({
            dataSource: dl_ds,
            selectable: "row",
            pageable: {
                buttonCount: 5,
                refresh: true,
                pageSizes: true,
    			input: true
            },
            autoBind: true,
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: false,
            resizable: true,
            editable: false,
            filterable: {
                extra: false
            },
            columns: [
				{
					headerTemplate:'<input id="file_chk2" name="file_chk2" type="checkbox" />',
					title: ' ',
                    template: kendo.template("<input type='checkbox' name='#= id #' id='#= id #' disabled />"),
					width: 28
				},
				{field: "client_name",title: "Client Name", width: 100},
		        {field: "name",width: 290,title: "Name"},
		        {field: "remarks",width: 350,title: "Remarks"},
		        {field: "log_created",title: "Logs"}
           ],
           change: function(e){
           		currRow_dl = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dl_di = this.dataItem(selectedRows[i]);
			        typeArr = dl_di.name.split(".");
			        if (typeArr[typeArr.length - 1] != "pdf")
			        	$("#open2").addClass("k-state-disabled").prop("disabled", true);
			        else
			        	$("#open2").removeClass("k-state-disabled").prop("disabled", false);
			        	
				    var rowIndex = $("tr", this.tbody).index(selectedRows[i]),
				        row = this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
					checkedIds2[dl_di.id] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").is(":checked");
					if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").is(":checked") == false)
						$("#file_chk2").prop("checked",false);
	           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").is(":checked"));
	           		
	           		$.each(checkedIds2,function(index,value){
	           			if (value){
							$('#download2').removeClass('k-state-disabled').prop("disabled", false);
							return false;	
						}           			
						$('#download2').addClass('k-state-disabled').prop("disabled", true);
	           		});
			    }
           },
           dataBound: onDataBound_dl
           // dataBound: addExtraStylingToGrid_dl
        });
        insertGridTitle("#dl_rs","List of Files");
        
		$('#dl_rs tbody').on('click',':checkbox',function(){
			if (this.checked){
				var grid3 = $('#dl_rs').data("kendoGrid");
			    //var row = grid2.dataItem($(this).closest('tr'));
			    var row_dl = $(this).closest('tr'),
			        rowIndex_dl = $("tr", grid3.tbody).index(row_dl),
			        row_dl = grid3.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex_dl);
			    grid3.select(row_dl);
				$('#download2').removeClass('k-state-disabled').prop("disabled", false);
			}else{
				$('tr.k-state-selected','#dl_rs').removeClass('k-state-selected');
				$('#download2').addClass('k-state-disabled').prop("disabled", true);
			}
		    //alert($("tr", grid2.tbody).index(row)); //$(this).is(':checked')
		    /*if($(this).is(':checked')){        
		        array[id] = true;
		    }else{
		    	array[id] = false;
		    }*/
		});
		$("#file_chk2").click(function () {
			var grid2 = $('#dl_rs').data("kendoGrid")
			    currStat = this.checked;
		    $("#dl_rs tbody input:checkbox").each(function(index,value){
		    	$(this).prop("checked", currStat);
			    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
			    var dataItem2 = grid2.dataItem(row);
				checkedIds2[dataItem2.id] = currStat;
				if (currStat){
				    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#dl_rs').addClass('k-state-selected');
					$('#download2').removeClass('k-state-disabled').prop("disabled", false);
					//grid2.select(row);
				}else {
					$('tr.k-state-selected','#dl_rs').removeClass('k-state-selected');
					$('#download2').addClass('k-state-disabled').prop("disabled", true);
				}
			});
		});
			 
		var react_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/files",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
				    filterFArr_react[0] = "client_id;" + client + ";eq";
				    filterFArr_react[1] = "expired_users;;neq";
			      	if ($(data.filter).length > 0){
				      	$.each(data.filter.filters,function(index,value){
				      		var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		filterFArr_react[index] = this.field + ";" + valForm + ";" + this.operator;
				      		filterOArr_react[index] = this.operator;
				      		filterVArr_react[index] = valForm;
				      	});
				    }
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr_react,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "log_time"),
					    operator: (($(data.filter).length > 0) ? filterOArr_react : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr_react : ""),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        }
			      }
			    }
            },
			requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			},
            pageSize: 15,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
               },
               errors: function(data){
               	if (filterFArr_react.length > 0 && $(data.rows).length == 0){
               		showNotif("Information","No records found!","information");
					filterFArr_react = [];
					$("#react_rs form.k-filter-menu button[type='reset']").trigger("click");
               	}
               },
               model: {
               		id: "id",
                    fields: {
                   	    id: {type: "number", editable: false},
				        name: {type: "string", editable: false},
				        remarks: {type: "string", editable: false},
				        log_created: {type: "string", editable: false},
				        client_id: {type: "number", editable: false},
				        expired_users: {type: "number", editable: false}
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
                                
	    var addExtraStylingToGrid_react = function () {
			$("#react_rs").data("kendoGrid").select("tr:eq(" + (dataSource._data.length + upl_ds._data.length + dl_ds._data.length + 4) + ")");
	        $("#react_rs > .k-grid-content > table > tbody > tr").hover(
	            function() {
	                $(this).toggleClass("k-state-hover");
	            }			        
	        );
        	filterFArr = [];
	    };

		//on dataBound event restore previous selected rows:
		var onDataBound_react = function (e) {
			var view = this.dataSource.view();
			/*$.each(checkedIds, function(index,value){
				alert(index + ", " + value);
			});*/
			for(var i = 0; i < view.length;i++){
				if (checkedIds3[view[i].id] == undefined)
					checkedIds3[view[i].id] = $("#file_chk3").is(":checked");
			    //alert("View: " + view[i].id + ", " + view[i].PROGRESS_RECID);
				if(checkedIds3[view[i].id]){
					this.tbody.find("tr[data-uid='" + view[i].uid + "']")
						.addClass("k-state-selected")
						.find("input[type=checkbox]")
						.prop("checked","checked");
				}
			}			
		}
        
        var react_rs = $("#react_rs").kendoGrid({
            dataSource: react_ds,
            selectable: "multiple,row",
            pageable: {
                buttonCount: 3
                // refresh: true,
                // pageSizes: true,
    			// input: true
            },
            autoBind: true,
            groupable: false,
            sortable: true,
            scrollable: true,
            navigatable: true,
            editable: false,
            resizable: true,
            editable: false,
            filterable: {
                extra: false
            },
            columns: [
				{
					headerTemplate:'<input id="file_chk3" name="file_chk3" type="checkbox" />',
					title: ' ',
                    template: kendo.template("<input type='checkbox' name='#= id #' id='#= id #' disabled />"),
					width: 28
				},
	    	   {field: "client_name",title: "Client Name", width: 100},
		       {field: "name",width: 290,title: "Name"},
		       // {field: "remarks",width: 350,title: "Remarks"},
		       {field: "log_created",title: "Logs"}
           ],
           change: function(e){
           		currRow_react = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        react_di = this.dataItem(selectedRows[i]);
			        // typeArr_react = react_di.name.split(".");
			        // if (typeArr_react[typeArr_react.length - 1].toLowerCase() != "pdf")
			        	// $("#open").addClass("k-state-disabled").prop("disabled", true);
			        // else
			        	// $("#open").removeClass("k-state-disabled").prop("disabled", false);
			        	
				    var rowIndex = $("tr", this.tbody).index(selectedRows[i]),
				        row = this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
					checkedIds3[react_di.id] = !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").is(":checked");
					if (!this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").is(":checked") == false)
						$("#file_chk3").prop("checked",false);
	           		this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").prop("checked", !this.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex).find("td").eq(0).find("input").is(":checked"));
	           		
	           		$.each(checkedIds3,function(index,value){
	           			if (value){
							$('#apply').removeClass('k-state-disabled').prop("disabled", false);
							$('#exp_users').data("kendoMultiSelect").enable(true);
							return false;	
						}           			
						$('#exp_users, #apply').addClass('k-state-disabled').prop("disabled", true);
						$('#exp_users').data("kendoMultiSelect").enable(false);
	           		});
	           		
	           		// $("#exp_user").data("kendoComboBox").dataSource.data([{text: "i1", value: "1"}, {text: "i2", value: "2"}, {text: "i3", value: "3"}]);
					// $("#Well").data("kendoComboBox").dataSource.query();
					expired_users_ds.read();
			    }
           },
           dataBound: onDataBound_react
           // dataBound: addExtraStylingToGrid
        });
		$('#react_rs tbody').on('click',':checkbox',function(){
			if (this.checked){
				var grid2 = $('#react_rs').data("kendoGrid");
			    //var row = grid2.dataItem($(this).closest('tr'));
			    var row = $(this).closest('tr'),
			        rowIndex = $("tr", grid2.tbody).index(row),
			        row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
			    grid2.select(row);
				$('#apply').removeClass('k-state-disabled').prop("disabled", false);
				$('#exp_users').data("kendoMultiSelect").enable(true);
			}else{
				$('tr.k-state-selected','#react_rs').removeClass('k-state-selected');
				$('#apply').addClass('k-state-disabled').prop("disabled", true);
				$('#exp_users').data("kendoMultiSelect").enable(false);
			}
		    //alert($("tr", grid2.tbody).index(row)); //$(this).is(':checked')
		    /*if($(this).is(':checked')){        
		        array[id] = true;
		    }else{
		    	array[id] = false;
		    }*/
		});
		$("#file_chk3").click(function () {
			var grid2 = $('#react_rs').data("kendoGrid")
			    currStat = this.checked;
		    $("#react_rs tbody input:checkbox").each(function(index,value){
		    	$(this).prop("checked", currStat);
			    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
			    var dataItem2 = grid2.dataItem(row);
				checkedIds3[dataItem2.id] = currStat;
				if (currStat){
				    var row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(index);
				    $('tr','#react_rs').addClass('k-state-selected');
					$('#apply').removeClass('k-state-disabled').prop("disabled", false);
					$('#exp_users').data("kendoMultiSelect").enable(true);
					//grid2.select(row);
				}else {
					$('tr.k-state-selected','#react_rs').removeClass('k-state-selected');
					$('#apply').addClass('k-state-disabled').prop("disabled", true);
					$('#exp_users').data("kendoMultiSelect").enable(false);
				}
			});
		});
			 
		var expired_users_ds = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/user_dd",
                    contentType: "application/json",
                    type: "GET"
                }
            },
            schema: {
                data: function(data) {
                    return data.rows || [];
               }
            }
        });
        				
        $("#tabstrip").kendoTabStrip({
        	activate: function(e){
        		var tabStrip = $("#tabstrip").data("kendoTabStrip");
        		// if ($('ul.k-tabstrip-items > li').index($("li.k-state-active")) == 0)
        			// upl_ds.read();
        		// else
        			// dl_ds.read();
        		//alert(tabStrip.select());
        		//console.log();
        	},
            animation:  {
                open: {
                    effects: "fadeIn"
                }
            }
        });		
        
        var onSelect = function(e){
        	// if (e.files[0].extension != ".csv"){
				// showNotif("Information","Select failed. Upload accepts '.csv' files only!","info");
        		// e.preventDefault();
        		// return true;
        	// }
		    fileName = e.files[0].name;
			
			if (client == 15){
				$("#window").data("kendoWindow").setOptions({
				    title: "List of Recipients",
				    width: "450px",
				    close: function(){}
				});
				$("#window").data("kendoWindow").refresh({
					url: "/codeIgniter/index.php/portal/index/direct_to/portRclient_list",
					type: "POST",
					data: {dl_ds_length: dataSource._data.length + upl_ds._data.length + dl_ds._data.length + react_ds._data.length + 5}
				});
		        $("#window").data("kendoWindow").center().open();
		    }
        		
			$(".k-upload").css({"min-height": (((e.files.length * 30) + 10) + "px")});
			upload_count = e.files.length;
        	if ($(".k-upload-files > li").length == 0)
        		return true;

        	$(".k-upload-files > li").remove();
    		// var raw = dataSource.data();
		    // var length = raw.length;
		    // var item, i;
// 		
		    // for(i=length-1; i>=0; i--){
		        // item = raw[i];
		        // dataSource.remove(item);
		    // }

			$("#importButt, #updateButt").prop("disabled", true).addClass("k-state-disabled");
			// alert($(".k-upload-files").is(":visible"));
			// alert(parseInt($(".k-upload-files").height()));
        }

        var getFileInfo = function (e) {
            return $.map(e.files, function(file) {
            	console.log(file);
                var info = file.name;

                // File size is not available in all browsers
                if (file.size > 0) {
                    info  += " (" + Math.ceil(file.size / 1024) + " KB)";
                }
                return info;
            }).join(", ");
        };
        
        var onSuccess = function(e){
        	showNotif("Information","Success","information");
			open_preloader();
			upl_ds.read();
			close_preloader();
        }
        
		$("#files").kendoUpload({
			async: {
				saveUrl: crudService + "save_upload/document/" + client,
				removeUrl: crudService + "remove_upload/document/" + client,
				autoUpload: false
			},
			localization: {
				dropFilesHere: "| Drop here..."
			},
			multiple: true,
			select: onSelect,
			success: onSuccess,
			upload: function(e){
				upload_count = upload_count - 1;
		    	e.data = {client_ids: client_ids, remarks: remarks_txt, email_adds: email_adds, user_ids: user_ids, send_this: (upload_count == 0)};	
			},
			remove: function(e){
				$(".k-upload").css({"min-height": (((($(".k-upload-files > li").length - 1) * 30) + 10) + "px")});
			},
			error: function(e){
				showNotif("Warning",e.XMLHttpRequest.responseText,"warning");
			}
		});
        
        var client_cb = $("#client").kendoComboBox({
	        highlightFirst: false,
            filter: "contains",
            placeholder: "Select client...",
            dataTextField: "short_desc",
            dataValueField: "id",
            autoBind: false,
            dataSource: {
                transport: {
                    read: crudService + "directCall/client",
            		contentType: "application/json"
                },
                schema: {
					data: function(data){
	                    return data.rows || [];
					}	                    	
                }
            },
            change: function(e){
				if (this.selectedIndex < 0)
            		$(".k-input").eq(0).val("").select().focus();
            }
        }).data("kendoComboBox");
        
        // var exp_users = $("#exp_users").kendoComboBox({
	        // highlightFirst: false,
            // filter: "contains",
            // placeholder: "Select user...",
            // dataTextField: "name",
            // dataValueField: "id",
            // autoBind: false,
            // dataSource: expired_users_ds,
            // change: function(e){
				// if (this.selectedIndex < 0)
            		// $(".k-input").eq(2).val("").select().focus();
            // }
        // }).data("kendoComboBox");
        
        var exp_users = $("#exp_users").kendoMultiSelect({
	        highlightFirst: false,
            filter: "contains",
            placeholder: "Select user/s that you want to reactivate access with the selected files above...",
            dataTextField: "name",
            dataValueField: "id",
            autoBind: false,
            dataSource: expired_users_ds
        }).data("kendoMultiSelect");
        
		var expiry = $("#expiry_date").removeClass('k-state-disabled').kendoDateTimePicker({
			// format: "MM/dd/yyyy hh:mm:ss",
			timeFormat: "HH:mm",
			enable: false,
			change: function(){
				// alert(kendo.toString(this.value(),"MM/dd/yyyy hh:mm:ss"));
			}
		}).data("kendoDateTimePicker");
			
		$(".signup a").eq(0).click(function(e){
			e.preventDefault();
			$("#window").data("kendoWindow").setOptions({
			    title: "Reference File",
			    width: "975px",
			    height: "auto",
			    close: function(){}
			});
			$("#window").data("kendoWindow").refresh({
				url: "/codeIgniter/index.php/portal/index/direct_to/portRuser",
				type: "POST",
				data: {dl_ds_length: (dataSource._data.length + upl_ds._data.length + dl_ds._data.length + react_ds._data.length + 4)}
			});
        	$("#window").data("kendoWindow").center().open();
		});
			
		$(".signup a").eq(1).click(function(e){
			e.preventDefault();
			$("#window").data("kendoWindow").setOptions({
			    title: "Preferences",
			    width: "400px",
			    height: "auto",
			    close: function(){}
			});
			$("#window").data("kendoWindow").refresh({
				url: "/codeIgniter/index.php/portal/index/direct_to/portRpref",
				type: "POST"
			});
        	$("#window").data("kendoWindow").center().open();
		});    
		
		$("#arccWrap button").bind({
			click: function(){
				switch(this.id){
					case "open":
						$("#window").data("kendoWindow").setOptions({
						    title: dataItem.name,
						    width: "900px",
						    height: "600px",
						    close: function(){
						    	dataSource.read();
						    }
						});
						$("#window").data("kendoWindow").refresh({
						    url: "http://" + $(location).attr('hostname') + "/documents/" + dataItem.client_id + "/" + dataItem.name,
						    contentType: "application/pdf"
						});
				        $("#window").data("kendoWindow").center().open();
				        $.post("/codeIgniter/index.php/portal/index/manage/files",{id: dataItem.id, log_user: log_user, date_open: kendo.toString(new Date(),"yyyy-MM-dd")},
				        	function(data){
				       	    	if (data != '1')
									showNotif('Warning',data,'warning');
				        	});
						break;
					case "open2":
						$("#window").data("kendoWindow").setOptions({
						    title: dl_di.name,
						    width: "900px",
						    height: "600px"
						});
						$("#window").data("kendoWindow").refresh({
						    url: "http://" + $(location).attr('hostname') + "/documents/15/" + dl_di.name,
						    contentType: "application/pdf"
						});
				        $("#window").data("kendoWindow").center().open();
				        $.post("/codeIgniter/index.php/portal/index/manage/files",{id: dl_di.id, log_user: log_user, date_open: kendo.toString(new Date(),"yyyy-MM-dd")},
				        	function(data){
				       	    	if (data != '1')
									showNotif('Warning',data,'warning');
				        	});
						break;
					case "download":
					case "download2":
						open_preloader();
						var files_in_zip = "",
							this_button = this.id;
						$.each((this.id == "download" ? checkedIds : checkedIds2), function(index,value){
							if (value)
								files_in_zip += index + ",";
						});
						
						if (files_in_zip == "")
							return true;
						
					    var link = document.createElement('a');
				        link.href = crudService + "compress/?";
				        link.href += ("ids=" + files_in_zip + "&");
				        link.href += ("page=" + dataSource.page() + "&");
				        link.href += ("pageSize=" + dataSource.pageSize() + "&");
				        link.href += ("fieldS=log_time&dir=desc");
				 
				        //Dispatching click event.
				        if (document.createEvent) {
				            var e = document.createEvent('MouseEvents');
				            e.initEvent('click' ,true ,true);
				            link.dispatchEvent(e);
					    	close_preloader();
					    	if (this_button == "download")
					    		dataSource.read();
				            return true;
				        }
						break;
					case "client_ref":
		    			$("#window").data("kendoWindow").setOptions({
						    title: "Reference File",
						    width: "700px",
						    height: "auto",
						    close: function(){
								client_cb.dataSource.read();
						    }
						});
						$("#window").data("kendoWindow").refresh({
							url: "/codeIgniter/index.php/portal/index/direct_to/portRclient",
							type: "POST",
							data: {dl_ds_length: (dataSource._data.length + upl_ds._data.length + dl_ds._data.length + react_ds._data.length + 5)}
						});
			        	$("#window").data("kendoWindow").center().open();
						break;
					case "gen_pw":
						$("#pword").val(Math.random().toString(36).slice(5));
						break;
					case "apply":
						if (exp_users.value() == "")
							return true;
			    		var idx = 0, files_id = "", users_id = "";
						$.each(checkedIds3,function(index,value){							
							if (value)
								files_id += (index + ",");
						});
						$.each(exp_users.value(),function(index,value){
							users_id += (value + ",");
						});
						// console.log({ids: files_id, users_id: users_id, log_user: log_user});
				        $.post(crudService + "manage/file_users",{ids: files_id, users_id: users_id, log_user: log_user},
				       	    function(data){
				       	    	if (data != '1')
									showNotif('Warning',data,'warning');
								else {
									showNotif('Information',"File/s successfully re-activated!",'information');
									react_ds.read();
								}
				       	    });
						break;
					default:
						isFailed = verifyThisInput(".signup");
			    		if (isFailed)
			    			return true;
			    			
				        $.post(crudService + "manage/user",{id: 0, client_id: client_cb.value(), first_name: $("#first_name").val(), last_name: $("#last_name").val(), 
				        									email_add: $("#email_add").val(), user_id: $("#user_id").val(), password: $("#pword").val(), 
				        									expiry: kendo.toString(expiry.value(),"yyyy-MM-dd HH:mm:ss"), log_user: log_user},
				       	    function(data){
				       	    	if (data != '1')
									showNotif('Warning',data,'warning');
								else {
									showNotif('Information',"User successfully created!",'information');
									$(".signup input").each(function(index,value){
										this.value = "";										
									});
								}
				       	    });
					break;
				}
	    	}
		});
	});
</script>
