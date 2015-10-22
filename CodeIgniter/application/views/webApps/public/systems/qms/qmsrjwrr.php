<div id="main-wrapper">
	<div class="wrap-button demo-section" style="width: 25%;min-height: 155px;position: fixed;top: 150px;left: 475px;">
		<fieldset>
		<legend>Filter Option </legend>
		<div>
			<label class="title" for="txt1" style="width: 100px;">Discipline:</label><input type="text" name="txt1" id="txt1" style="width: 155px;" />
		</div>
		<div >
			<label class="title" for="txt2" style="width: 100px;">Start Date:</label><input type="text" name="txt2" id="txt2" style="width: 155px;" />
		</div>
		<div >
			<label class="title" for="txt3" style="width: 100px;">End Date:</label><input type="text" name="txt3" id="txt3" style="width: 155px;" />
		</div>
		
		<div><br /></div>
		<div class="buttonRight" style="width: 90%;">
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
			//$("#textarea").val(dataItem.mat_desc);
			
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
			var crudService = crudServiceBaseUrl + "qms/index/", isFailed = false,
		    filterFArr = [], filterOArr = [], filterVArr = [], sentValue = "", currRow = "", cMode = "", fieldSort = "", dirSort = "";
			 
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
			 
			 var today = new Date(kendo.format('{0:MM-dd-yyyy}', new Date()))
			 
			 var start = $("#txt2").kendoDatePicker({
                        value: today,
                        change: startChange,
                        parseFormats: ["MM/dd/yyyy"]
                    }).data("kendoDatePicker");
                    
			 var end = $("#txt3").kendoDatePicker({
                        value: today,
                        change: startChange,
                        parseFormats: ["MM/dd/yyyy"]
                    }).data("kendoDatePicker");
			
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
							    url: "http://" + $(location).attr('hostname') + ":8080/JavaBridge/executeReport.php?xmlFile=qms/JOBSITE WHSE RECEIVING REPORT&cbDiscCode=" + disc_code.value() + "&cProgName=" + "sampleKendo.php" + "&fiFrom=" + kendo.toString(start.value,"yyyy-MM-dd")+ "&fiTo=" + kendo.toString(end.value,"yyyy-MM-dd"),
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
			
			var disc_code = $("#txt1").kendoComboBox({
	        	enable: true,
	            filter: "contains",
	            placeholder: "Select Discipline",
	            dataTextField: "disc_desc",
	            dataValueField: "disc_code",
				autoBind: true,
	            dataSource: {
	                transport: {
	                    read: crudService + "directCall/discRef",
	            		contentType: "application/json"
	                },
	                schema: {
						data: function(data){
		                    return data.rows || [];
		                }
				    }                    	
	            },
			    change: function(e){
			        //grid_change(this,"rowSelection"); //display of data into fields
					//dataSource.read();
					//treqissdtl_ds.read();	//calling the other browser
			    
	       		}
       	    }).data("kendoComboBox");

	});
</script>


