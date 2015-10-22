                </div>
            </div>
        <div id="arccFooter">
            <span>&reg;&trade; Al Rushaid Construction Company, Limited | &copy; All Rights Reserved 2013</span>
        </div>
        <input type="hidden" name="hidd_userName" id="hidd_userName" value="<?php echo (isset($user_name)) ? $user_name : ""; ?>">
        <input type="hidden" name="hidd_userID" id="hidd_userID" value="<?php echo (isset($user)) ? $user : ""; ?>">
        <input type="hidden" name="hidd_PROGRESS_RECID" id="hidd_PROGRESS_RECID" value="<?php echo (isset($PROGRESS_RECID)) ? $PROGRESS_RECID : ""; ?>">
        <input type="hidden" name="hidd_access" id="hidd_access" value="<?php echo (isset($access)) ? $access : ""; ?>">
        <script>
        	$(document).ready(function(){
				check_browser();
        		$("#leftSetupPhase ul li").eq(1).find("a").click(function(e){
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
			        $.post("/codeIgniter/index.php/webapps/templateLoader/index/tmpl_changePassword",{userName: $("#hidd_userName").val(), userID: $("#hidd_userID").val(), PROGRESS_RECID: $("#hidd_PROGRESS_RECID").val()},
			        	function(data){
			            	$("#window").html(data);
        					$("#window").data("kendoWindow").center().open();
			        	});
        		});
        	});
        </script>
    </body>
</html>