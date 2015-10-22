<div id="main-wrapper">
	<div class="wrap-button demo-section" style="width: 35%;min-height: 132px;position: fixed;top: 150px;left: 400px;">
		<fieldset>
		<legend>Stock on hand Printing </legend>
		<div>
			<label class="title" for="txt1" style="width: 100px;">Stock No:</label><input type="text" name="txt2" id="txt2" value="*" class="k-textbox" style="width: 55%;" 
		</div>
		<div >
			<label class="title" for="chk1" style="width: 100px;"></label><input type="checkbox" name="chk1" id="chk1"><label class="title short" for="chk1">w/ Zero Stock on Hand</label>
		</div>
		<div>
			<label class="title" for="chk2" style="width: 100px;"></label><input type="checkbox" name="chk2" id="chk2"><label class="title short" for="chk2">w/ Zero MTO Quantity</label>
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
							    url: "http://" + $(location).attr('hostname') + ":8080/JavaBridge/executeReport.php?xmlFile=qms/material_inventory&StockNo=" + $("#txt2").val() + "&tbMTO=" + ($("#chk1").is(":checked") ? "YES" : "NO") + "&tbStock=" + ($("#chk2").is(":checked") ? "YES" : "NO"),
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