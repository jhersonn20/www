<div id="main-wrapper" style="width: 31%;">
	<div class="wrap-formUpl demo-section"></div>
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
			listArr = ["Piping MTO","Piping Weld / Joint","Pipe Support","WENDS Spool","Fabrication Spool","Warehouse Spool","Warehouse Materials"],
			tmpl = "", tmpl_title = "", tmpl_width = "", tmpl_height = "";
		
		htmlObj = "<ul style='margin-top: 5px;'>";
		$.each(listArr,function(index,value){
			htmlObj += "<li style='margin-bottom: 5px;'><label class='title' for='butt" + index + "'>" + (index + 1) + ".)</label> <button name='butt" + index + "' id='butt" + index + "' class='k-button' style='width: 360px;'>" + ("Upload " + value + " Data") + "</button> <input type='checkbox' name='chk" + index + "' id='chk" + index + "' disabled /></li>";
		});
		htmlObj += "<li style='margin-bottom: 5px;'><label class='title' for='butt7'>8.)</label> <button name='butt7' id='butt7' class='k-button' style='width: 360px;'>Update Piping MTO Data & Piping Weld Data</button> <input type='checkbox' name='chk7' id='chk7' disabled /></li>";
		htmlObj += "<li style='margin-bottom: 5px;'><label class='title' for='butt8'>9.)</label> <button name='butt8' id='butt8' class='k-button k-state-disabled' style='width: 360px;' disabled>Update Piping Material Workability (ISO,SPL,PS)</button> <input type='checkbox' name='chk8' id='chk8' disabled /></li>";
		htmlObj += "</ul>";
		
		$(htmlObj).appendTo(".wrap-formUpl");
		
		$("button").bind({
			click: function(e){
				tmpl_width = "991px";
	       		tmpl_height = "auto";
	       		tmpl = "/codeIgniter/index.php/webapps/qms/index/index/";
				switch(this.id){
					case "butt0":
						tmpl_title = "Upload Piping MTO Data (qmsUpmtod-n)";
						tmpl += "qmsUpmtod-n";
					break;
					case "butt1":
						tmpl_title = "Upload Piping Weld Data (qmsUpweldd-n)";
						tmpl += "qmsUpweldd-n";
					break;
					case "butt2":
						tmpl_title = "Upload Pipe Support Data (qmsUpsupd)";
						tmpl += "qmsUpsupd";
					break;
					case "butt3":
						tmpl_title = "Upload WENDS Support Data (qmsUpfspld)";
						tmpl += "qmsUpfspld";
					break;
					case "butt4":
						tmpl_title = "Upload Fabrication Support Data (qmsUpfabspld)";
						tmpl += "qmsUpfabspld";
					break;
					case "butt5":
						tmpl_title = "Upload Warehouse Support Data (qmsUpwspld)";
						tmpl += "qmsUpwspld";
					break;
					case "butt6":
						tmpl_title = "Upload Warehouse Materials Data (qmsUpwmatld)";
						tmpl += "qmsUpwmatld";
					break;
					case "butt7":
						if (!confirm("Do you want to update the following database table in related to\n " +
	        						 "Piping MTO Data and Piping Weld Data ?\n" +
	        						 "MAT_TAKEOFF_PERSPOOL\nSPOOL\nISO\nTESTPACK_HDR\nSYSTEM\nJOINTS\nTRA_JOINTS_PIP\nH_JOINTS\nH_TRA_JOINTS-PIP\nH_MAT_TAKEOFF_PERSPOOL\nH_SPOOL\nH_ISO"))
	        				return true;
	        			
	        			call_sp = "directCall/update/mtoWeld";
						break;
					default:
						return true;
					break;
				}
				
				$("#window").data("kendoWindow").setOptions({
				    title: tmpl_title,
				    width: tmpl_width,
				    height: tmpl_height
				});
				$("#window").data("kendoWindow").refresh({
					url: tmpl,
					type: "POST",
					data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
				});
	        	$("#window").data("kendoWindow").center().open();
			}
		});
	});
</script>