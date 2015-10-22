        </div>
        <div id="arccFooter">
            <span>&reg;&trade; Al Rushaid Construction Company, Limited | &copy; All Rights Reserved 2013</span>
        </div>
        <input type="hidden" name="hidden_user" id="hidden_user" value="<?php echo (isset($user)) ? $user : ''; ?>" />
        <input type="hidden" name="hidd_userName" id="hidd_userName" value="<?php echo (isset($user_name)) ? $user_name : ""; ?>">
        <input type="hidden" name="hidd_PROGRESS_RECID" id="hidd_PROGRESS_RECID" value="<?php echo (isset($PROGRESS_RECID)) ? $PROGRESS_RECID : ""; ?>">
        <script>
        	$(document).ready(function(){
        		var pathArray = window.location.href.split("/");
				check_browser();        		
				
			    constructNav($("#mainNav"), "jMenu");
			    $("#jMenu").jMenu({
			        ulWidth : "auto",
			        effects : {
			            effectSpeedOpen : 150,
			            effectSpeedClose : 150,
			            effectTypeOpen : 'slide',
			            effectTypeClose : 'slide',
			            effectOpen : 'linear',
			            effectClose : 'linear'
			        },
			        TimeBeforeOpening : 100,
			        TimeBeforeClosing : 400,
			        animatedText : false,
			        paddingLeft: 1,
					openClick : false
			    });
			    
				$("ul#jMenu").find("a").click(function(e){ //> li > 
        			if ($(this).prop("href").indexOf("MAIN") > 0)
        				e.preventDefault();
				});
        		$("ul#jMenu > li > ul > li").find("a").click(function(e){
        			if ($(this).text() == "Change Password" || $(this).text() == "Programmer Code" || $(this).text() == "System File Attachment" || $(this).text() == "User's Guide"){
	        			e.preventDefault();
					/*templateLoader.loadExtTemplate("/codeIgniter/index.php/webApps/templateLoader/index/tmpl_changePassword");

			        //Subscribe to event triggered when templates loaded
			        //(Don't load use templates before they are available)
			        $(document).bind("TEMPLATE_LOADED", function(e, path) {
			            //console.log('Templates loaded');            
			
			            //Compile and cache templates
			            var _itemTemplate = kendo.template($("#changePassword").html()); //,{useWithBlock:false}
			
			            //Using the template (assuming "data" is collection loaded elsewhere)
			            //_itemTemplate(data);
			            $("#window").html(_itemTemplate({userName: $("#hidd_userName").val(), userID: $("#hidd_userID")}));
			        });*/
			       		if ($(this).text() == "Change Password" || $(this).text() == "Programmer Code" || $(this).text() == "System File Attachment"){
				       		var tmpl = "", tmpl_width = "", tmpl_height = "";
				       		switch($(this).text()){
				       			case "Programmer Code":
				       				tmpl = "/codeIgniter/index.php/webapps/templateLoader/index/tmpl_programmerCode";
				       				tmpl_width = "500px";
				       				if ($.browser.firefox)
				       					tmpl_height = "560px";
				       				else
				       					tmpl_height = "536px";
				       				break;
				       			case "System File Attachment":
				       				tmpl = "/codeIgniter/index.php/webapps/templateLoader/index/tmpl_sysFileAtt";
				       				tmpl_width = "900px";
				       				if ($.browser.firefox)
				       					tmpl_height = "538px";
				       				else
				       					tmpl_height = "523px";
				       				break;
				       			default:
				       				tmpl = "/codeIgniter/index.php/webapps/templateLoader/index/tmpl_changePassword";
				       				tmpl_width = "500px";
				       				if ($.browser.firefox)
				       					tmpl_height = "173px";
				       				else
				       					tmpl_height = "165px";
				       				break;
				       		}
				       		//alert($("#hidd_PROGRESS_RECID").val());
							$("#window").data("kendoWindow").setOptions({
							    title: $(this).text(),
							    width: tmpl_width,
							    height: tmpl_height
							});
					        /*$.post(tmpl,{userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()},
					        	function(data){
					            	$("#window").html(data);
					        	});*/
							$("#window").data("kendoWindow").refresh({
								url: tmpl,
								type: "POST",
								data: {userName: $("#hidd_userName").val(), userID: $("#hidden_user").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()}
							});
						}else {
							$("#window").data("kendoWindow").setOptions({
							    title: $(this).text(),
							    width: "900px",
							    height: "600px"
							});
							$("#window").data("kendoWindow").refresh({
							    url: "http://" + $(location).attr('hostname') + "/assets/pdf/apps-attachment/central/ogmr/USERS_GUIDE/OGMR_Users_Guide.pdf",
							    contentType: "application/pdf"
							});
						}
	        			$("#window").data("kendoWindow").center().open();
        			}else if ($(this).text() == "Update Eng'r PIP MTO/JMIF" || $(this).text() == "Update PIPE SPL MTO/JWRR/JMIF" ||
        					  $(this).text() == "Update Eng'r STRL MTO / JMIF"){
	        			e.preventDefault();
						var call_sp = "";
						switch($(this).text()){
							case "Update Eng'r PIP MTO/JMIF":
								if (!confirm("Do you want to Validate Warehouse MTO/JMIF ?"))
			        				return true;
			        			
			        			call_sp = "qms/index/directCall/update/whseMtoJmif";
								break;
							case "Update PIPE SPL MTO/JWRR/JMIF":
								if (!confirm("Do you want to Update Warehouse SPOOL MTO/JMIF/JWRR ?"))
			        				return true;
			        			
			        			call_sp = "qms/index/directCall/update/whseSplMtoJmif";
								break;
							case "Update Eng'r STRL MTO / JMIF":
								if (!confirm("Do you want to Validate Warehouse STR-MTO/JMIF ?"))
			        				return true;
			        			
			        			call_sp = "qms/index/directCall/update/strlMto";
								break;
							default:
								showNotif("Warning","Module under construction!","warning");
								return true;
								break;
						}
			        	
						open_preloader();
		    			$.post(crudServiceBaseUrl + call_sp, {},
		    				function(data){
								showNotif((data.rows[0].return_value == 1) ? "Information" : "Warning",(data.rows[0].return_value == 1) ? "Update Successful!" : "Update Failed!",(data.rows[0].return_value == 1) ? "info" : "warning");
								close_preloader();
		    				});
        			}
        		});
        	});
        </script>
    </body>
</html>