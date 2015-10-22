<style>
	.k-multiselect {
		display: inline-block;
	}
	.wrap-form-big input {
		width: 80px;
	}
</style>
<div id="main-wrapper">
	<div class="wrap-header demo-section">
		<fieldset>
			<legend> Filter Option: </legend>
<!-- 			<label class="title" for="sel1">Area:</label> -->
			<select name="sel1" id="sel1" style="width: 525px;"></select>
            <div style="float: right;line-height: 25px;">
            	<button class="k-button" id="viewButt">View</button>
				<label><input type="radio" name="option" id="option1" checked /> All </label>
				<label><input type="radio" name="option" id="option2" /> Workable/Progress </label>
				<label><input type="radio" name="option" id="option3" /> Balance </label>
				<label><input type="radio" name="option" id="option4" /> ISO Workable </label>
			</div>		
		</fieldset>
	</div>
    <div class="wrap-grid demo-section">
        <div id="rowSelection"></div>
    </div>
	<div class="wrap-form-big demo-section apply8">
		<ul>
			<li>
				<label class="title" for="txt1">Total ISO:</label><input type="text" name="txt1" id="txt1" class="k-textbox k-state-disabled" disabled />
				<label class="title" for="txt2">Total Work. Spl:</label><input type="text" name="txt2" id="txt2" class="k-textbox k-state-disabled" disabled />
				<label class="title" for="txt3">Total Painted:</label><input type="text" name="txt3" id="txt3" class="k-textbox k-state-disabled" disabled />
				<label class="title" for="txt4">Total Rig-Up:</label><input type="text" name="txt4" id="txt4" class="k-textbox k-state-disabled" disabled />
				<label class="title" for="txt5">Total Hydro-Test:</label><input type="text" name="txt5" id="txt5" class="k-textbox k-state-disabled" disabled />
			</li>
			<li>
				<label class="title" for="txt6">Total ISO Work.:</label><input type="text" name="txt6" id="txt6" class="k-textbox k-state-disabled" disabled />
				<label class="title" for="txt7">Total Fab Start:</label><input type="text" name="txt7" id="txt7" class="k-textbox k-state-disabled" disabled />
				<label class="title" for="txt8">Total Received:</label><input type="text" name="txt8" id="txt8" class="k-textbox k-state-disabled" disabled />
				<label class="title" for="txt9">Total Fit-Up:</label><input type="text" name="txt9" id="txt9" class="k-textbox k-state-disabled" disabled />
				<label class="title" for="txt10">Total Restore:</label><input type="text" name="txt10" id="txt10" class="k-textbox k-state-disabled" disabled />
			</li>
			<li>
				<label class="title" for="txt11">Total Spool:</label><input type="text" name="txt11" id="txt11" class="k-textbox k-state-disabled" disabled />
				<label class="title" for="txt12">Total Fab End:</label><input type="text" name="txt12" id="txt12" class="k-textbox k-state-disabled" disabled />
				<label class="title" for="txt13">Total Issued:</label><input type="text" name="txt13" id="txt13" class="k-textbox k-state-disabled" disabled />
				<label class="title" for="txt14">Total Installed:</label><input type="text" name="txt14" id="txt14" class="k-textbox k-state-disabled" disabled />
				<label class="title" for="txt15">Total Accepted:</label><input type="text" name="txt15" id="txt15" class="k-textbox k-state-disabled" disabled />
			</li>
		</ul>
	</div>
	<div class="wrap-button demo-section">
		 <div class="buttonLeft">
            	<button class="k-button mainEve" id="exportButt">Export</button>
         </div>				
		<div class="buttonRight">
        	<button class="k-button mainEve" id="closeButt">Close</button>
       	</div>				
	</div>
</div>
<script type="text/javascript">
	$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
	$(document).ready(function(){
		var crudService = crudServiceBaseUrl + "qms/index/"
			filterFArr = [],
			filterOArr = [],
			filterVArr = [],
			sentValue = "",
			fieldSort = "",
	        query = "",
	        dirSort = "";

		var areaNo = $("#sel1").kendoMultiSelect({
            filter: "contains",
            placeholder: "Select Area...",
            dataTextField: "area_no",
            dataValueField: "area_no",
            dataSource: {
                transport: {
                    read: {
                        url: crudService + "directCall/area",
                    	type: "GET"
                    // },
				    // parameterMap: function(data, type) {
				      // if (type == "read") {
				        // return {
						  // fieldS: fieldSort,
						  // operator: "contains",
						  // value: query,
						  // dir: dirSort
				        // }
				      // }
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
		
		// .kendoComboBox({
            // filter: "contains",
            // placeholder: "Select Area...",
            // dataTextField: "area_no",
            // dataValueField: "area_no",
            // dataSource: {
                // transport: {
                    // read: crudService + "directCall/area"
                // },
                // schema: {
                    // data: function(data) {
                    	// //data = eval('(' + data + ')');
                        // return data.rows || [];
                    // }
                // }
            // }
        // }).data("kendoComboBox");
        
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: crudService + "directCall/area_query",
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
				    fieldSort = ($(data.sort).length ? data.sort[0].field : "area_no");
				    query = filterFArr;
				    dirSort = ($(data.sort).length ? data.sort[0].dir : "desc");
			        return {
			            page: data.page,
			            pageSize: data.pageSize,
			            top: data.take,
			            skip: data.skip,
					    fieldF: filterFArr,
					    fieldS: ($(data.sort).length ? data.sort[0].field : "area_no"),
					    operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    value: (($(data.filter).length > 0) ? filterVArr : sentValue),
					    dir: ($(data.sort).length ? data.sort[0].dir : "desc"),
					    rsOption: $('input[name=option]:checked').index('input[name=option]'),
					    area_no: ("'" + areaNo.value().join("','") + "'")
			        }
			      }
			    }
            },
			  requestEnd: function(e) {
			    var response = e.response;
			    var type = e.type;
			    // console.log(type);
			    // console.log(response);
			  },
            pageSize: 5,
            serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
            schema: {
                data: function(data) {
                    return data.rows || [];
               },
               errors: function(data){
               	if (filterFArr.length > 0 && $(data.rows).length == 0){
               		alert("No records found!");
					sentValue = "";
					filterFArr = [];
					$("form.k-filter-menu button[type='reset']").trigger("click");
               	}
               },
               model: {
               		id: "PROGRESS_RECID",
                    fields: {
                   	    PROGRESS_RECID: {type: "number", editable: false},
                   	    fluid_code: { type: "string"},
						area_no: { type: "string"},
						plant_no: { type: "string"},
						drawing_no: { type: "string"},
						sheet_no: { type: "string"},
						rev_no: { type: "string"},
						spool_no: { type: "string"},
						lbsb: { type: "string"},
						sw_diainch: { type: "number"},
						tot_lm: { type: "number"},
						workable_dt: { type: "date"},
						fab_start_dt: { type: "date"},
						fab_end_dt: { type: "date"},
						fab_qc_release_dt: { type: "date"},
						painted_date: { type: "date"},
						whse_recvd_dt: { type: "date"},
						whse_issue_dt: { type: "date"},
						rigup_date: { type: "date"},
						fitup_date: { type: "date"},
						installed_date: { type: "date"},
						hydrotest_date: { type: "date"},
						REINSTATE_date: { type: "date"},
						accepted_date: { type: "date"}
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
            dataSource: dataSource,
            autoBind: false,
            selectable: "row",
            pageable: {
                buttonCount: 5,
                refresh: true,
                pageSizes: true,
    			input: true
            },
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
               {field: "fluid_code",title: "Fluid",width: 55},
               {field: "area_no",title: "Area",width: 55},
               {field: "plant_no",title: "Plant",width: 77},
               {field: "drawing_no",title: "Drawing",width: 125},
               {field: "sheet_no",title: "Sheet",width: 63},
               {field: "rev_no",title: "Revision",width: 77},
               {field: "spool_no",title: "Spool",width: 80},
               {field: "lbsb",title: "LB/SB",width: 89},
               {field: "sw_diainch",title: "Dia-Inch",width: 77},
               {field: "tot_lm",title: "Total LM",width: 93},
               {field: "workable_dt",title: "Workable",width: 89, format: "{0:MM/dd/yyyy}"},
               {field: "fab_start_dt",title: "Fab Start",width: 154, format: "{0:MM/dd/yyyy}"},
               {field: "fab_end_dt",title: "Fab End",width: 89, format: "{0:MM/dd/yyyy}"},
               {field: "fab_qc_release_dt",title: "QC Release",width: 99, format: "{0:MM/dd/yyyy}"},
               {field: "painted_date",title: "Painted",width: 89, format: "{0:MM/dd/yyyy}"},
               {field: "whse_recvd_dt",title: "Whse Received",width: 123, format: "{0:MM/dd/yyyy}"},
               {field: "whse_issue_dt",title: "Whse Issued",width: 110, format: "{0:MM/dd/yyyy}"},
               {field: "rigup_date",title: "Rig-Up",width: 90, format: "{0:MM/dd/yyyy}"},
               {field: "fitup_date",title: "Fit-Up",width: 89, format: "{0:MM/dd/yyyy}"},
               {field: "installed_date",title: "Welded",width: 89, format: "{0:MM/dd/yyyy}"},
               {field: "hydrotest_date",title: "Hydro Test",width: 97, format: "{0:MM/dd/yyyy}"},
               {field: "reinstate_date",title: "Restoration",width: 100, format: "{0:MM/dd/yyyy}"},
               {field: "accepted_date",title: "Accepted",width: 89, format: "{0:MM/dd/yyyy}"}
           ],
           change: function(e){
           		currRow = this;
			    var selectedRows = this.select();
			    var selectedDataItems = [];
			    for (var i = 0; i < selectedRows.length; i++) {
			        dataItem = this.dataItem(selectedRows[i]);
			        $("#txt1").val(dataItem.fitotiso);
			        $("#txt2").val(dataItem.fitotworkable);
			        $("#txt3").val(dataItem.fitotpainted);
			        $("#txt4").val(dataItem.fitotrigup);
			        $("#txt5").val(dataItem.fitothydro);
			        $("#txt6").val(dataItem.fitotisoworkable);
			        $("#txt7").val(dataItem.fitotstart);
			        $("#txt8").val(dataItem.fitotwhsrecv);
			        $("#txt9").val(dataItem.fitotfitup);
			        $("#txt10").val(dataItem.fitotresto);
			        $("#txt11").val(dataItem.total);
			        $("#txt12").val(dataItem.fitotend);
			        $("#txt13").val(dataItem.fitotwhsiss);
			        $("#txt14").val(dataItem.fitotwelded);
			        $("#txt15").val(dataItem.fitotaccepted);
			    }
           },
           dataBound: addExtraStylingToGrid
        });
        
        var toggleButt = function(vis){
	        $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        });
	    }
	    toggleButt("show");
	    
	    $("button").bind({
	    	click: function(e){
	    		switch(this.id){
	    			case "viewButt":	    			
                		dataSource.read();
                	break;
                	case "exportButt":
					    open_preloader();
					    var link = document.createElement('a');
				        link.href = crudService + "directCall/export/?";
				        link.href += ("fieldS=" + fieldSort + "&");
				        link.href += ((query != "" ? ("fieldF[]=" + query) : "fieldF=") + "&");
				        link.href += ("dir=" + dirSort + "&");
				        link.href += ("rsOption=" + $('input[name=option]:checked').index('input[name=option]') + "&");
					    link.href += ("area_no=" + ("'" + areaNo.value().join("','") + "'"));
				 
				        //Dispatching click event.
				        if (document.createEvent) {
				            var e = document.createEvent('MouseEvents');
				            e.initEvent('click' ,true ,true);
				            link.dispatchEvent(e);
					    	close_preloader();
				            return true;
				        }
                	break;
	    		}
	    	}
	    })
	});
</script>