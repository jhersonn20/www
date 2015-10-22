<div id="main-wrapper">
    <div class="wrap-grid demo-section">
        <div id="rowSelection"></div>
    </div>
	<div class="wrap-button demo-section">
		<div class="buttonRight">
        	<button class="k-button mainEve" id="closeButt">Close</button>
       	</div>				
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var crudService = crudServiceBaseUrl + "qms/index/",
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "";
        
        // var dataSource = new kendo.data.DataSource({
            // transport: {
                // read: {
                    // url: crudService + "directCall/isoTO",
                    // contentType: "application/json",
                    // type: "GET"
                // },
                // create: {
                    // url: crudService + "manage/isoTO",
                    // type: "POST"
                // },
                // update: {
                    // url: crudService + "manage/isoTO",
                    // type: "POST"
                // },
                // destroy: {
                    // url: crudService + "remove/isoTO",
                    // type: "POST"
                // },
			    // parameterMap: function(data, type) {
			      // if (type == "read") {
			      	// if ($(data.filter).length > 0){
				      	// $.each(data.filter.filters,function(index,value){
				      		// var valForm = ((typeof this.value) == "object") ? kendo.toString(this.value,"yyyy-MM-dd") : this.value;
				      		// filterFArr[index] = this.field + ";" + valForm + ";" + this.operator;
				      		// filterOArr[index] = this.operator;
				      		// filterVArr[index] = valForm;
				      	// });
				    // }
			        // return {
			            // page: data.page,
			            // pageSize: data.pageSize,
			            // top: data.take,
			            // skip: data.skip,
					    // fieldF: filterFArr,
					    // fieldS: ($(data.sort).length ? data.sort[0].field : "area_no"),
					    // operator: (($(data.filter).length > 0) ? filterOArr : "contains"),
					    // value: (($(data.filter).length > 0) ? filterVArr : sentValue),
					    // dir: ($(data.sort).length ? data.sort[0].dir : "desc")
			        // }
			      // }else {
			      	  // data['loguser'] = $("#hidden_user").val();
			      	  // data['discipline'] = "";
			      	  // return data;
			      // }
			    // }
            // },
			  // requestEnd: function(e) {
			    // var response = e.response;
			    // var type = e.type;
			    // // console.log(type);
			    // // console.log(response);
			  // },
            // pageSize: 5,
            // serverPaging: true,
			// serverFiltering: true,
			// serverSorting: true,
            // schema: {
                // data: function(data) {
                    // return data.rows || [];
               // },
               // errors: function(data){
               	// if (filterFArr.length > 0 && $(data.rows).length == 0){
               		// alert("No records found!");
					// sentValue = "";
					// filterFArr = [];
					// $("form.k-filter-menu button[type='reset']").trigger("click");
               	// }
               // },
               // model: {
               		// id: "PROGRESS_RECID",
                    // fields: {
                   	    // PROGRESS_RECID: {type: "number", editable: false},
                        // area_no: { type: "string"},
                        // drawing_no: { type: "string" },
                   	    // sheet_no: { type: "string"},
                        // rev_no: { type: "string"},
                        // stat: { type: "string"},
                        // line_size: { type: "number"},
                        // line_no: { type: "string"},
                        // lineclass: { type: "string"},
                        // matl: { type: "string"},
                        // fluid_code: { type: "string"},
                        // insulation: { type: "string"},
                        // insulation_thickness: { type: "string"},
                        // lbsb: { type: "string"},
                        // painting: { type: "string"},
                        // pid: { type: "string"},
                        // transmittal: { type: "string"},
                        // remarks: { type: "string"},
                        // document: { type: "string"},
                        // subarea_no: { type: "string"},
                        // plant_no: { type: "string"}
                    // }
               // },
               // total: function(response) {
				   	// return (($(response.rows[0]).length > 0) ? response.rows[0].total : 0); //$(response.rows).length;				   	
			   // }
            // },
            // change: function(e) {
            	// if ($(e.items).length == 0)
            		// return true;
            // }
        // });
//                                 
	    // var addExtraStylingToGrid = function () {
			// $("#rowSelection").data("kendoGrid").select("tr:eq(1)");
	        // $(".k-grid-content > table > tbody > tr").hover(
	            // function() {
	                // $(this).toggleClass("k-state-hover");
	            // }			        
	        // );
        	// filterFArr = [];
	    // };
//         
        // var grid = $("#rowSelection").kendoGrid({
            // dataSource: dataSource,
            // selectable: "row",
            // pageable: {
                // buttonCount: 5,
                // refresh: true,
                // pageSizes: true,
    			// input: true
            // },
            // groupable: false,
            // sortable: true,
            // scrollable: true,
            // navigatable: true,
            // editable: false,
            // resizable: true,
            // editable: {
            	// mode: "popup",
		        // template: $("#_temp_iso").html(),
		        // update  : true
		        // // ,
		        // // add     : true,
		        // // destroy : true,
		        // // confirmation: "Are you sure you want to remove ?",
		    // },
		    // edit : function (e) {
		        // if (!e.model.id) {
		            // $(e.container).parent().find('.k-window-title').html("Add ISO");
		            // $(e.container).parent().find('.k-grid-update').html("Save");
		        	// $(e.container).find("input:first-child").select().focus();
		        // }else{
		        	// if (cMode == "edit"){
			            // $(e.container).parent().find('.k-window-title').html("Edit ISO");
			    		// $.each($(e.container).find("input"), function(index, value){
			    			// if (index <= 4)
			    				// $(this).attr("disabled",true).addClass('k-state-disabled');
			    		// });
			        	// $(e.container).find("input").eq(5).select().focus();
			        // }else
			    		// $.each($(e.container).find("input"), function(index, value){
			    			// $(this).attr("disabled",true).addClass('k-state-disabled');
			    		// });
		        // }
		    // },
			// save: function(e) {
			    // if (!confirm("Are you sure you want to save all changes?")) {
			        // e.preventDefault();
			    // }
// 			    
				// $("#rowSelection").data("kendoGrid").setDataSource(dataSource);
				// $("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
				// $("#rowSelection").data("kendoGrid").dataSource.read();
			// },
			// remove: function(e) {
			    // if (!confirm("Are you sure you want to delete this record?\n Drawing: " + e.model.drawing_no)) {
			        // e.preventDefault();
			    // }
				// $("#rowSelection").data("kendoGrid").setDataSource(dataSource);
				// $("#rowSelection").data("kendoGrid").dataSource.page($("#rowSelection").data("kendoGrid").dataSource.page());
				// $("#rowSelection").data("kendoGrid").dataSource.read();
			// },
            // toolbar: [
	            // {
				    // text: "Add",
				    // className: "k-grid-add",
				    // imageClass: "k-icon k-add"
				// },
				// {
				    // text: "Edit",
				    // className: "k-grid-edit",
				    // imageClass: "k-icon k-edit"
				// },
				// {
				    // text: "Delete",
				    // className: "k-grid-delete",
				    // imageClass: "k-icon k-delete"
				// },
				// {
				    // text: "View",
				    // className: "k-grid-view",
				    // imageClass: "k-icon k-edit"
				// },
				// {
				    // text: "View Attachment",
				    // className: "k-grid-viewAtt",
				    // imageClass: "k-icon k-edit"
				// },"save","cancel"
			// ],
            // filterable: {
                // extra: false
            // },
            // columns: [
               // {field: "area_no",title: "Area",width: 52},
               // {field: "drawing_no",title: "Drawing",width: 125},
               // {field: "sheet_no",title: "Sheet",width: 63},
               // {field: "rev_no",title: "Revision",width: 77},
               // {field: "stat",title: "Status",width: 66},
               // {field: "line_size",title: "Line Size",width: 80},
               // {field: "line_no",title: "Line No",width: 158},
               // {field: "lineclass",title: "Line Class",width: 89},
               // {field: "matl",title: "Material",width: 77},
               // {field: "fluid_code",title: "Fluid Code",width: 93},
               // {field: "insulation",title: "Insulation",width: 89},
               // {field: "insulation_thickness",title: "Insulation Thickness",width: 154},
               // {field: "lbsb",title: "Bore Type",width: 89},
               // {field: "painting",title: "Painting",width: 79},
               // {field: "pid",title: "PID",width: 50},
               // {field: "transmittal",title: "Transmittal",width: 99},
               // {field: "remarks",title: "Remarks",width: 78},
               // {field: "document",title: "Document",width: 90},
               // {field: "subarea_no",title: "Sub-Area No",width: 104},
               // {field: "plant_no",title: "Plant No",width: 76}
           // ],
           // change: function(e){
           		// currRow = this;
			    // var selectedRows = this.select();
			    // var selectedDataItems = [];
			    // for (var i = 0; i < selectedRows.length; i++) {
			        // dataItem = this.dataItem(selectedRows[i]);
        			// filterFArr_spool = [];
        			// spool_ds.read();
        			// filterFArr_random = [];
        			// random_ds.read();
        			// filterFArr_material = [];
        			// material_ds.read();
			    // }
           // },
           // dataBound: addExtraStylingToGrid
        // });
//         
        // var toggleButt = function(vis){
	        // $.each($("#rowSelection .k-grid-toolbar").find("a"),function(index, value){
	        	// eval("$(this)." + ((index <= 3) ? vis : ((vis == "show") ? "hide" : "show")) + "();")
	        // });
	    // }
	    // toggleButt("show");
	});
</script>