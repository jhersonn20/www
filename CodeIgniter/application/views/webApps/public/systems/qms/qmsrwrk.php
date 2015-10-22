<div id="main-wrapper" style="min-height: 1000px">
	<div class="wrap-button demo-section" style="width: 168px;min-height: 220px;">
		<fieldset style="min-height: 205px;">
			<legend> Piping Workability: </legend>
            <div style="float: left;line-height: 25px;margin-bottom: 10px">
            	<fieldset>
            	<label><input type="radio" name="option" checked id="option1" /> Per Spool </label>
				<label><input type="radio" name="option" id="option2" /> Per ISO </label>
				</fieldset>
			</div>
			<div style="line-height: 25px;width: 100%px;">
            	
            	<label><input type="radio" name="option2" checked id="option1" /> All </label><br />
				<label><input type="radio" name="option2" id="option2" /> Completed </label> <br />
				<label><input type="radio" name="option2" id="option3" /> Partial </label> <br />
				<hr/>
				<center><input type="checkbox" name="chk1" id="chk1"><label class="title short" for="chk1">Detailed</label> </center> 
			</div>
			<div class="wrap-button demo-section">
				<div class="buttonLeft">
		        	<button class="k-button mainEve" id="printButt">Print</button>
		        	
		       	</div>
				<div class="buttonRight">
		        	<button class="k-button mainEve" id="closeButt">Close</button>
		       	</div>				
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
			//$("#txt2").val(dataItem.osd_no);
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
			
						// --event handler section -- //
			
			$(".wrap-button .buttonLeft button").bind({
		    	click: function(e){
		    		switch(this.id){
		    			case "printButt":
		    				if($('input[name=option]:checked').index('input[name=option]') == 0){
		    					if(($("#chk1").is(":checked") ? 1 : 0) == 0){
		    						if (confirm("Do you really want to print this item?")){	    					
									$("#window").data("kendoWindow").setOptions({
									    title: "",
									    width: "900px",
									    height: "600px"
									});
									$("#window").data("kendoWindow").refresh({
									    url: "http://" + $(location).attr('hostname') + ":8080/JavaBridge/executeReport.php?xmlFile=qms/QMS Workability Per Spool" +"progname="+"Per Spool" +"&rsOption=" + $('input[name=option]:checked').index('input[name=option]') +"&rsOption2=" + $('input[name=option2]:checked').index('input[name=option2]') +"&tg1=" + ($("#chk1").is(":checked") ? 1 : 0), 
									    contentType: "application/pdf"
									});
							        $("#window").data("kendoWindow").center().open();
							        }
		    					}else{
		    						if (confirm("Do you really want to print this item?")){	
		    						$("#window").data("kendoWindow").setOptions({
									    title: "",
									    width: "900px",
									    height: "600px"
									});
									$("#window").data("kendoWindow").refresh({
									    url: "http://" + $(location).attr('hostname') + ":8080/JavaBridge/executeReport.php?xmlFile=qms/QMS Workability Per Spool Detailed" +"progname="+"Per Spool" +"&rsOption=" + $('input[name=option]:checked').index('input[name=option]') +"&rsOption2=" + $('input[name=option2]:checked').index('input[name=option2]') +"&tg1=" + ($("#chk1").is(":checked") ? 1 : 0), 
									    contentType: "application/pdf"
									});
							        $("#window").data("kendoWindow").center().open();
							       }
		    					}
		    				}else{
		    					if(($("#chk1").is(":checked") ? 1 : 0) == 0){
		    						if (confirm("Do you really want to print this item?")){	    					
									$("#window").data("kendoWindow").setOptions({
									    title: "",
									    width: "900px",
									    height: "600px"
									});
									$("#window").data("kendoWindow").refresh({
									    url: "http://" + $(location).attr('hostname') + ":8080/JavaBridge/executeReport.php?xmlFile=qms/QMS Workability Per ISO" +"progname="+"Per Spool" +"&rsOption=" + $('input[name=option]:checked').index('input[name=option]') +"&rsOption2=" + $('input[name=option2]:checked').index('input[name=option2]') +"&tg1=" + ($("#chk1").is(":checked") ? 1 : 0), 
									    contentType: "application/pdf"
									});
							        $("#window").data("kendoWindow").center().open();
							        }
		    					}else{
		    						if (confirm("Do you really want to print this item?")){	
		    						$("#window").data("kendoWindow").setOptions({
									    title: "",
									    width: "900px",
									    height: "600px"
									});
									$("#window").data("kendoWindow").refresh({
									    url: "http://" + $(location).attr('hostname') + ":8080/JavaBridge/executeReport.php?xmlFile=qms/QMS Workability Per ISO Detailed" +"progname="+"Per Spool" +"&rsOption=" + $('input[name=option]:checked').index('input[name=option]') +"&rsOption2=" + $('input[name=option2]:checked').index('input[name=option2]') +"&tg1=" + ($("#chk1").is(":checked") ? 1 : 0), 
									    contentType: "application/pdf"
									});
							        $("#window").data("kendoWindow").center().open();
							       }
		    					}
		    				}
		    			
		    			break;
		    	  }
		      }
			});

	});
</script>