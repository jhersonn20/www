<div id="main-wrapper" style="width: 45%;">
	<div class="wrap-form-small demo-section"></div>
	<div class="wrap-button demo-section">
		<div class="buttonRight">
        	<button class="k-button mainEve" id="closeButt">Close</button>
       	</div>				
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("body").css({"background": "url('/assets/images/webapps/<?php echo $system; ?>_bg_blur_1.jpg') no-repeat fixed center top #222", "background-size": "100% 100%"});
		var crudService = crudServiceBaseUrl + "qms/index/",
			listArr = ["Create ISO Mapping Quantifications (1st Process)",
					   "Create ISO Mapping Quantifications (2nd Process)",
					   "Create Weld/Joint Quantifications (1st Process)",
					   "Create Weld/Joint Quantifications (2nd Process)",
					   "Create Pipe Support Quantifications",
					   "Update Spool Quantification form WENDS Spool Progress Data",
					   "Update Spool Quantification from Warehouse Spool Progress Data",
					   "Update Spool Quantification from Fabrication Spool Progress Data",
					   "Update Progress of Work - Spool Data [ENGG]",
					   "Update Progress of Work - Spool Data [QAQC]",
					   "Update Progress of Work - Spool Data [WHSE]",
					   "Update Progress of Work - Spool Data [FAB]",
					   "Update Piping Materials from Warehouse Materials Data"];
		
		htmlObj = "<ul style='margin-top: 5px;'>";
		$.each(listArr,function(index,value){
			htmlObj += "<li style='margin-bottom: 5px;'><label class='title' for='butt" + index + "'>" + (index + 1) + ".)</label> <button name='butt" + index + "' id='butt" + index + "' class='k-button' style='width: 538px;'>" + value + "</button> <input type='checkbox' name='chk" + index + "' id='chk" + index + "' disabled /></li>";
		});
		htmlObj += "</ul>";
		
		$(htmlObj).appendTo(".wrap-form-small");
		
		$(".wrap-form-small button").bind({
			click: function(){
				var call_sp = "";
				switch(this.id){
					case "butt0":
						if (!confirm("Do you want to Create Isometric Mapping Quantification 1st Process\n " +
	        						 "base from Uploaded Piping MTO Data\n Proceed create isometric mapping and quantification ?"))
	        				return true;
	        			
	        			call_sp = "directCall/update/mto1";
						break;
					case "butt1":
						if (!confirm("Do you want to Create Isometric Mapping Quantification 2nd Process\n " +
	        						 "base from Uploaded Piping MTO Data\n Proceed create isometric mapping and quantification ?"))
	        				return true;
	        			
	        			call_sp = "directCall/update/mto2";
						break;
					case "butt2":
						if (!confirm("Do want to Create Piping Weld/Joint Quantification 1st Process\n " +
	        						 "base from Uploaded Piping Weld/Joint Data\n Proceed create piping weld/joint quantification 1st process ?"))
	        				return true;
	        			
	        			call_sp = "directCall/update/weld1";
						break;
					case "butt3":
						if (!confirm("Do want to Create Piping Weld/Joint Quantification 2nd Process\n " +
	        						 "base from Uploaded Piping Weld/Joint Data\n Proceed create piping weld/joint quantification 2nd process ?"))
	        				return true;
	        			
	        			call_sp = "directCall/update/weld2";
						break;
					case "butt4":
						if (!confirm("Do want to Create Pipe Support Quantification\n " +
	        						 "base from Uploaded Pipe Support Data\n Proceed create pipe support quantification ?"))
	        				return true;
	        			
	        			call_sp = "directCall/update/ps1";
						break;
					case "butt5":
						if (!confirm("Do want to Update Spool Quantification\n " +
	        						 "base from Uploaded WENDS Spool Data\n Proceed update spool quantification ?"))
	        				return true;
	        			
	        			call_sp = "directCall/update/wends";
						break;
					case "butt6":
						if (!confirm("Do want to Update Spool Quantification\n " +
	        						 "base from Uploaded Warehouse Spool Data\n Proceed update spool quantification ?"))
	        				return true;
	        			
	        			call_sp = "directCall/update/whseSpl";
						break;
					case "butt7":
						if (!confirm("Do want to Update Spool Quantification\n " +
	        						 "base from Uploaded Fabrication Spool Data\n Proceed update spool quantification ?"))
	        				return true;
	        			
	        			call_sp = "directCall/update/fabSpl";
						break;
					case "butt8":
						if (!confirm("Do want to Create/Update PROGRESS OF WORK base from\n " +
	        						 "Uploaded Piping MTO Data and Piping Weld/Joint Data\n Proceed create/update progress of work ?"))
	        				return true;
	        			
	        			call_sp = "directCall/update/pwEngg";
						break;
					case "butt9":
						if (!confirm("Do want to Create/Update PROGRESS OF WORK base from\n " +
	        						 "Uploaded WENDS Spool Data\n Proceed create/update progress of work ?"))
	        				return true;
	        			
	        			call_sp = "directCall/update/pwQaqc";
						break;
					case "butt10":
						if (!confirm("Do want to Create/Update PROGRESS OF WORK base from\n " +
	        						 "Uploaded Warehouse Spool Data\n Proceed create/update progress of work ?"))
	        				return true;
	        			
	        			call_sp = "directCall/update/pwWhse";
						break;
					case "butt11":
						if (!confirm("Do want to Create/Update PROGRESS OF WORK base from\n " +
	        						 "Uploaded Fabrication Spool Data\n Proceed create/update progress of work ?"))
	        				return true;
	        			
	        			call_sp = "directCall/update/pwFab";
						break;
					case "butt12":
						if (!confirm("Do want to Update Spool Quantification\n " +
	        						 "base from Uploaded Warehouse Materials Data\n Proceed update spool quantification ?"))
	        				return true;
	        			
	        			call_sp = "directCall/update/pmWm";
						break;
					default:
						showNotif("Warning","Module under construction!","warning");
						return true;
						break;
				}
	        	
				open_preloader();
	        	var thisButt = this.id;
    			$.post(crudService + call_sp, {},
    				function(data){
    					if (data.rows[0].return_value == 1){
							showNotif((data.rows[0].return_value == 1) ? "Information" : "Warning",(data.rows[0].return_value == 1) ? "Update Successful!" : "Update Failed!",(data.rows[0].return_value == 1) ? "info" : "warning");
							if (data.rows[0].return_value == 1){
								$("#" + thisButt).parent().find("input").prop("checked", true);
								if (thisButt == 'butt8'){
								    var link = document.createElement('a');
							        link.href = crudService + "directCall/export_ttspl/";
							 
							        //Dispatching click event.
							        if (document.createEvent) {
							            var e = document.createEvent('MouseEvents');
							            e.initEvent('click' ,true ,true);
							            link.dispatchEvent(e);
							        }
								}
							}
    					}else{
							showNotif("Warning","Please Create Isometric Mapping and Quantification first.","warning");
						}
						close_preloader();
    				});
			}
		});
	});
</script>