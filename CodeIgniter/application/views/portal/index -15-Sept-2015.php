<div class="signup">
	<h1> Sign Up </h1> | <a href="#"> User Reference</a> <?php echo ($department == "MIS") ? "| <a href='#'> File Reference</a>" : ""; ?> <!--| <a href="#"> Preferences </a>-->
	<hr style="margin: 3px 0;" />
	<ul>			
		<li> <label class="title" for="client" style="width: 36%;">Client:</label><input required type="text" name="client" id="client" style="width: 53%" />
			<button type="button" name="client_ref" id="client_ref" class="k-button">...</button>
		</li>
		<li> <label class="title" for="dept" style="width: 36%;">Department:</label><input type="text" name="dept" id="dept" style="width: 62%" /></li>
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
	<button name="connect" id="connect" class="k-button" style="float: left;">Connect</button>
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
					<label class="title" for="tot_dl" style="width: 36%;">Total Filesize:</label><input type="text" id="tot_dl" disabled name="tot_dl" style="width: 150px;" />
		<button name="download" id="download" class="k-button k-state-disabled" disabled> Bulk Download </button>
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
					<label class="title" for="tgHist"><input type="checkbox" checked name="tgHist" id="tgHist" /> Show All |</label>
					<label class="title" for="tot_dl2" style="width: 9%;">Total Filesize:</label><input type="text" id="tot_dl2" disabled name="tot_dl2" style="width: 150px;" />
					<button name="download2" id="download2" class="k-button k-state-disabled" disabled> Bulk Download </button>
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
		var crudService = '/codeigniter/index.php/portal/' + "index/", 
			isFailed = false, client = <?php echo (isset($client_id)) ? $client_id : 0; ?>, fileNames = "", var_cds = {},
			dept = "<?php echo (isset($department)) ? $department : ""; ?>",
			filterFArr = [], filterOArr = [], filterVArr = [], 
			filterFArr_upl = [], filterOArr_upl = [], filterVArr_upl = [], 
			filterFArr_dl = [], filterOArr_dl = [], filterVArr_dl = [],
			filterFArr_react = [], filterOArr_react = [], filterVArr_react = [],
			dataItem = {}, upl_di = {}, dl_di = {}, react_di = {}, checkedIds = {}, checkedIds2 = {}, checkedIds3 = {},
			currRow = "", currRow_upl = "", currRow_dl = "", upload_count = 0, log_user = '<?php echo $user_id; ?>', file_types = [], user_pk = "<?php echo $user_pk; ?>";

		if ("<?php echo $error; ?>" != "")
			showNotif("Warning","<?php echo $error; ?>","warning");

		follows = "<?php echo $follows; ?>";			
        // $("#arccMenu").append("<a href='/codeIgniter/index.php/portal/index/offCredentials'> Sign-Out </a>");
		$("#tot_dl, #tot_dl2").kendoNumericTextBox({
			format: "#.00 KB",
			enable: false
		});
	    $.post("<?php echo '/codeigniter/index.php/portal'; ?>/index/file_ref",{type: "get"},
	    	function(data){
	    		if (data != ""){
	    			data = data.split(";");
	    			file_types = data[0].split(",");
	    		}
	    	}); 				 
		var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/files",
                    contentType: "application/json",
                    type: "GET"
                },
			    parameterMap: function(data, type) {
			      if (type == "read") {
				    // filterFArr[0] = "client_id;15;neq";
				    filterFArr[0] = "date_open;;in";
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
            pageSize: 6,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
               },
               errors: function(data){
               	if (filterFArr.length > 1 && $(data.rows).length == 0){
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
				        size: {type: "number", editable: false},
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
				{
					title: ' ',
                    template: kendo.template("<a alt='Download' href='" + crudService + "direct_dl?id=#= id #&client_id=#= client_id #&name=#= name #'><img src='/assets/images/portal/dl.png' width='16' height='16' /></a>"),
                    // template: kendo.template("<a alt='Download' href=\"javascript:direct_dl(#= id #,#= client_id #,'#= name #')\"><img src='/assets/images/portal/dl.png' width='16' height='16' /></a>"),
					width: 28
				},
	    	   {field: "client_name",title: "Client Name", width: 100},
		       {field: "name",width: 290,title: "Name"},
		       {field: "size",width: 90,title: "Size (KB)",format : "{0:n}"},
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
	           	total_bytes(dataSource._pristineData,checkedIds,"#tot_dl");
           },
           dataBound: onDataBound
           // dataBound: addExtraStylingToGrid
        });
		$('#rowSelection tbody').on('click',':checkbox',function(){
			// var grid2 = $('#rowSelection').data("kendoGrid"),
			    // currStat = this.checked,
		    	// row = $(this).closest('tr'),
		        // rowIndex = $("tr", grid2.tbody).index(row),
		        // row = grid2.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex);
			// var dataItem2 = grid2.dataItem(row);
				// checkedIds[dataItem2.id] = currStat;
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
	        // total_bytes(dataSource._pristineData,checkedIds,"#tot_dl");
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
	        total_bytes(dataSource._pristineData,checkedIds,"#tot_dl");
		});
		$('#rowSelection tbody').on('click','a',function(){
			setTimeout(function(){dataSource.read()},100);
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
               	if (filterFArr_upl.length > 1 && $(data.rows).length == 0){
               		if ($("#upl_rs").is(":visible"))
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
				        size: {type: "number", editable: false},
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
		       {field: "size",width: 90,title: "Size (KB)",format : "{0:n}"},
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
				    // filterFArr_dl[0] = "client_id;15;" + (client == 15 ? "neq" : "eq");
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
					    client_id: client,
					    tgHist: ($("#tgHist").is(":checked") ? 1 : 0)
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
               		if ($("#dl_rs").is(":visible"))
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
				        size: {type: "number", editable: false},
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
				{
					title: ' ',
                    template: kendo.template("<a alt='Download' href='" + crudService + "direct_dl?id=#= id #&client_id=#= client_id #&name=#= name #'><img src='/assets/images/portal/dl.png' width='16' height='16' /></a>"),
					width: 28
				},
				{field: "client_name",title: "Client Name", width: 100},
		        {field: "name",width: 290,title: "Name"},
		        {field: "size",width: 90,title: "Size (KB)",format : "{0:n}"},
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
	           	total_bytes(dl_ds._pristineData,checkedIds2,"#tot_dl2");
           },
           dataBound: onDataBound_dl
           // dataBound: addExtraStylingToGrid_dl
        });
        insertGridTitle("#dl_rs","List of Files");
        
		$('#dl_rs tbody').on('click',':checkbox',function(){
			// var grid3 = $('#dl_rs').data("kendoGrid"),
			    // currStat = this.checked,
		    	// row_dl = $(this).closest('tr'),
		        // rowIndex_dl = $("tr", grid3.tbody).index(row_dl),
		        // row_dl = grid3.tbody.find(">tr:not(.k-grouping-row)").eq(rowIndex_dl);
			// var dataItem2 = grid3.dataItem(row_dl);
				// checkedIds2[dataItem2.id] = currStat;
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
	        // total_bytes(dl_ds._pristineData,checkedIds2,"#tot_dl2");
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
	        total_bytes(dl_ds._pristineData,checkedIds2,"#tot_dl2");
		});
		$('#dl_rs tbody').on('click','a',function(){
			setTimeout(function(){dataSource.read()},100);
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
               		if ($("#react_rs").is(":visible"))
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
        	var is_valid_file = true;
        	$.each(e.files,function(index,value){
	        	if ($.inArray(value.extension.replace(".","").toLowerCase(),file_types) < 0){
	        		//console.log(file_types);
					showNotif("Warning","Upload failed. Selected file type is not part of the acceptable file types!\n {Allowed File Types: " + file_types.join(", ") + "}","warning");
					//showNotif("Warning","Upload failed. Selected file type is not part of the acceptable file types!\n {Allowed File Types: }","warning");
	        		e.preventDefault();
	        		is_valid_file = false;
	        		return false;
	        	}
	        	if (((value.size / 1024) / 1024) > <?php echo (int)(ini_get('upload_max_filesize')); ?>){
					showNotif("Warning","Upload failed. Selected file size is greater than the maximum upload file size!","warning");
	        		e.preventDefault();
	        		is_valid_file = false;
	        		return false; 		
	        	}
			    fileNames += value.name + ",";
        	});
			if (!is_valid_file)
				return true;
			
			if (client == 15){
				$("#window").data("kendoWindow").setOptions({
				    title: "List of Recipients",
				    width: "450px",
				    height: "auto",
			        activate: function(){
			        	this.wrapper.css({top: ((parseInt($(window).height()) - this.wrapper[0]["offsetHeight"]) / 2) + "px"});
			        },
				    close: function(){}
				});
				$("#window").data("kendoWindow").refresh({
					url: "<?php echo '/codeigniter/index.php/portal'; ?>/index/direct_to/portRclient_list",
					type: "POST",
					data: {dl_ds_length: dataSource._data.length + upl_ds._data.length + dl_ds._data.length + react_ds._data.length + 5, follows: follows}
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
            	//console.log(file);
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
		    	e.data = {client_ids: client_ids, remarks: remarks_txt, email_adds: email_adds, user_ids: user_ids, send_this: ((upload_count == 0) ? 1 : 0), fileNames: fileNames};	
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
            	
            	if (this.text() == "ARCC"){
            		$("#dept").parent().parent().find("label").append("<font style='color: red';>*</font>");
        			// $("#dept").removeClass("k-state-disabled").prop("disabled", false);
        			$("#dept").prop("required", true);
        			$("#dept").data("kendoComboBox").enable(true);
            	}else {            		
            		$("#dept").parent().parent().find("label").html($("#dept").parent().parent().find("label").text().replace("*",""));
        			// $("#dept").addClass("k-state-disabled").prop("disabled", true);
        			$("#dept").prop("required", false);
        			$("#dept").data("kendoComboBox").enable(false);
            	}
            }
        }).data("kendoComboBox");
        
        var dept_cb = $("#dept").kendoComboBox({
	        highlightFirst: false,
            filter: "contains",
            placeholder: "Select department...",
		    dataTextField: "option",
		    dataValueField: "value",
		    enable: false,
		    dataSource: [
		        { option: "Marketing", value: "MKTG" },
		        { option: "Purchasing", value: "PUR" },
		        { option: "Accounting", value: "ACCTG" },
		        { option: "Quality Control", value: "QA/QC" },
		        { option: "Administration", value: "ADMIN" },
		        { option: "Admin-Site", value: "ADMIN-Site" },
		        { option: "Project Control", value: "PCD" },
		        { option: "MIS", value: "MIS" },
		        { option: "MIS-Site", value: "MIS-Site" }
		    ],
            change: function(e){
				if (this.selectedIndex < 0)
            		$(".k-input").eq(1).val("").select().focus();
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
            dataSource: expired_users_ds,
            change: function(e){
				$("#exp_users").parent().removeClass("thisIsRequired");
            }
        }).data("kendoMultiSelect");
        
		var expiry = $("#expiry_date").removeClass('k-state-disabled').kendoDateTimePicker({
			// format: "MM/dd/yyyy hh:mm:ss",
			timeFormat: "h:mm tt",
			enable: false,
			value: new Date(),
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
		        activate: function(){
		        	this.wrapper.css({top: ((parseInt($(window).height()) - this.wrapper[0]["offsetHeight"]) / 2) + "px"});
		        },
			    close: function(){}
			});
			$("#window").data("kendoWindow").refresh({
				url: "<?php echo '/codeigniter/index.php/portal'; ?>/index/direct_to/portRuser",
				type: "POST",
				data: {dl_ds_length: (dataSource._data.length + upl_ds._data.length + dl_ds._data.length + react_ds._data.length + 4), log_user: log_user, follows: follows}
			});
        	$("#window").data("kendoWindow").center().open();
		});
			
		$(".signup a").eq(1).click(function(e){
			e.preventDefault();
			$("#window").data("kendoWindow").setOptions({
			    title: "Reference File",
			    width: "400px",
			    height: "auto",
		        activate: function(){
		        	this.wrapper.css({top: ((parseInt($(window).height()) - this.wrapper[0]["offsetHeight"]) / 2) + "px"});
		        },
			    close: function(){
				    $.post("<?php echo '/codeigniter/index.php/portal'; ?>/index/file_ref",{type: "get"},
				    	function(data){
				    		if (data != ""){
				    			data = data.split(";");
				    			file_types = data[0].split(",");
				    		}
				    	}); 			    	
			    }
			});
			$("#window").data("kendoWindow").refresh({
				url: "<?php echo '/codeigniter/index.php/portal'; ?>/index/direct_to/portRfile",
				type: "POST",
				data: {dept: dept}
			});
        	$("#window").data("kendoWindow").center().open();
		});    
			
		$(".signup a").eq(2).click(function(e){
			e.preventDefault();
			$("#window").data("kendoWindow").setOptions({
			    title: "Preferences",
			    width: "400px",
			    height: "auto",
		        activate: function(){
		        	this.wrapper.css({top: ((parseInt($(window).height()) - this.wrapper[0]["offsetHeight"]) / 2) + "px"});
		        },
			    close: function(){}
			});
			$("#window").data("kendoWindow").refresh({
				url: "<?php echo '/codeigniter/index.php/portal'; ?>/templateLoader/index/direct_to/portRpref",
				type: "POST"
			});
        	$("#window").data("kendoWindow").center().open();
		});        
		
		$("#tgHist").click(function(){
			dl_ds.read();			
		});
		
		var download_file = function(id,col,col_ctr){
			// var col = {}, col_ctr = 0;
			// $.each((id == "download" ? checkedIds : checkedIds2), function(index,value){
				// if (value)
					// col[index] = value;
			// });
			setTimeout(function(){
				var link = document.createElement('a');
			        link.href = crudService + "compress/?";
			        link.href += ("ids=" + col[col_ctr] + "&");
			        link.href += ("page=" + dataSource.page() + "&");
			        link.href += ("pageSize=" + dataSource.pageSize() + "&");
			        link.href += ("fieldS=log_time&dir=desc");
			 
		        //Dispatching click event.
		        if (document.createEvent) {
		            var e = document.createEvent('MouseEvents');
		            e.initEvent('click' ,true ,true);
		            link.dispatchEvent(e);
			    	// close_preloader();
			    	if (id == "download")
			    		setTimeout(function(){dataSource.read()},100);
			    		// dataSource.read();
		            // return true;
		        }
		        if ((col.length - 1) != col_ctr){
		        	++col_ctr;
		        	download_file(id,col,col_ctr);
		        }
			},1500);
		}
		
		$("#arccWrap button").bind({
			click: function(){
				switch(this.id){
					case "open":
						$("#window").data("kendoWindow").setOptions({
						    title: dataItem.name,
						    width: "900px",
						    height: "",
					        activate: function(){
					        	this.wrapper.css({top: ((parseInt($(window).height()) - this.wrapper[0]["offsetHeight"]) / 2) + "px"});
					        },
						    close: function(){
						    	dataSource.read();
						    }
						});
						$("#window").data("kendoWindow").refresh({
						    url: "https://" + $(location).attr('hostname') + "/documents/" + dataItem.client_id + "/" + dataItem.name,
						    contentType: "application/pdf"
						});
				        $("#window").data("kendoWindow").center().open();
				        $.post("<?php echo '/codeigniter/index.php/portal'; ?>/index/manage/files",{id: dataItem.id, log_user: log_user, date_open: kendo.toString(new Date(),"yyyy-MM-dd")},
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
				        $.post("<?php echo '/codeigniter/index.php/portal'; ?>/index/manage/files",{id: dl_di.id, log_user: log_user, date_open: kendo.toString(new Date(),"yyyy-MM-dd")},
				        	function(data){
				       	    	if (data != '1')
									showNotif('Warning',data,'warning');
				        	});
						break;
					case "download":
					case "download2":						
						// download_file(this.id);
						// return true;
						 var files_in_zip = "",
							 this_button = this.id;
						 $.each((this.id == "download" ? checkedIds : checkedIds2), function(index,value){
							 if (value)
								 files_in_zip += index + ",";
						 });
						
						 if (files_in_zip == ""){
							showNotif('Warning',"Please select a file first!",'warning');
							 return true;
						}
						open_preloader();
 						
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
					    	 // if (this_button == "download")
					    	 setTimeout(function(){dataSource.read()},100);
					    		 // dataSource.read();
				             return true;
				         }
				        // var col = [], col_ctr = 0;
						// $.each((this.id == "download" ? checkedIds : checkedIds2), function(index,value){
							// if (value){
								// col[col_ctr] = index;
								// ++col_ctr;
							// }
						// });		
						// download_file(this.id,col,0);
					    	// close_preloader();
						break;
					case "client_ref":
		    			$("#window").data("kendoWindow").setOptions({
						    title: "Reference File",
						    width: "700px",
						    height: "auto",
					        activate: function(){
					        	this.wrapper.css({top: ((parseInt($(window).height()) - this.wrapper[0]["offsetHeight"]) / 2) + "px"});
					        },
						    close: function(){
								client_cb.dataSource.read();
						    }
						});
						$("#window").data("kendoWindow").refresh({
							url: "<?php echo '/codeigniter/index.php/portal'; ?>/index/direct_to/portRclient",
							type: "POST",
							data: {dl_ds_length: (dataSource._data.length + upl_ds._data.length + dl_ds._data.length + react_ds._data.length + 5), log_user: log_user}
						});
			        	$("#window").data("kendoWindow").center().open();
						break;
					case "gen_pw":
						$("#pword").val(Math.random().toString(36).slice(5));
						break;
					case "apply":
						if (exp_users.value() == ""){
							showNotif('Warning',"Kindly, select user/s first.",'error');
							$("#exp_users").parent().addClass("thisIsRequired");
							return true;
						}
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
					case "connect":
						$("#window").data("kendoWindow").setOptions({
						    title: "User's File",
						    width: "975px",
						    height: "auto",
					        activate: function(){
					        	this.wrapper.css({top: ((parseInt($(window).height()) - this.wrapper[0]["offsetHeight"]) / 2) + "px"});
					        },
						    close: function(){}
						});
						$("#window").data("kendoWindow").refresh({ 
							url: "<?php echo '/codeigniter/index.php/portal'; ?>/index/direct_to/portTCon",
							type: "POST",
							data: {dl_ds_length: (dataSource._data.length + upl_ds._data.length + dl_ds._data.length + react_ds._data.length + 4), log_user: log_user, follows: follows, user_pk: user_pk}
						});
			        	$("#window").data("kendoWindow").center().open();
						break;
					default:
						isFailed = verifyThisInput(".signup");
			    		if (isFailed)
			    			return true;
			    			
			    		if ((expiry.value().getHours() + expiry.value().getMinutes() + expiry.value().getSeconds()) == 0)
			    			expiry.value().setHours(1);
				        $.post('/codeigniter/index.php/portal/index/' + "manage/user",{id: 0, client_id: client_cb.value(), first_name: $("#first_name").val(), last_name: $("#last_name").val(), 
				        									email_add: $("#email_add").val(), user_id: $("#user_id").val(), password: $("#pword").val(), 
				        									expiry: kendo.toString(expiry.value(),"yyyy-MM-dd HH:mm:ss"), log_user: log_user, department: dept_cb.value(), follows: user_pk},
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
