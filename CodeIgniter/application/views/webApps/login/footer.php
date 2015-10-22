        <div id="footer" style="display: <?php echo (($is_logged_in) ? "block" : "none"); ?>">
        	<div class="footer-content">
		        <!--<div class="footer-left" style="vertical-align: middle;width: 100%;">
		        	<img src="/assets/images/webapps/footerIcon.png" style="float: left;margin-right: 10px;" />
		        	<div style="height: 99px;">
			        	<p>www.arcc-eei.com</p>
			        	<p>2nd Floor, Tower B Almousa - Blue Tower King Faisal Bin Abdulaziz Road P.O. Box 31688</p>
			        	<p>Al Khobar 31952, Kingdom of Saudi Arabia</p>
			        	<p>Tel. No. +966 (013) 801-00-00; Fax No: +966 (013) 801-01-77</p>
			        </div>
		        </div>-->
		    </div>
        </div>
	    <script>			
			/*$(window).unload(function(evt){
			    if(!confirm('Do you really want to leave'))
			        evt.preventDefault();
		    });*/
		   /*var _isset = 0;
		   window.onbeforeunload = function(e) {
		   	if (_isset==0) {
		         _isset=1;  // This will only be seen elsewhere if the user cancels.
		         return "This is a demonstration, you won't leave the page whichever option you select.";
		      }
		       _isset=0;
		   window.location.reload();
		   return false;
			return '';
		   };*/
        </script>
    </body>
    <script>
    	$(document).ready(function(){
			var //cookies  = get_cookies_array()
			    titleArr = ['Information','Notification','Warning'],
			    typeArr  = ['notice','notice','error'];
			    
			check_browser();
						
            $("#tabstrip").kendoTabStrip({
                animation:  {
                    open: {
                        effects: "fadeIn"
                    }
                }
            });
			/*for (i=0; i!=10; i++) {
				$.pnotify({
					title: 'Information',
					text: 'Check me out! I\'m a notice.',
					history: false,
					styling: 'jqueryui',
					delay: 60000
				});
			}
			
			$.pnotify({
				title: 'Notice',
				text: 'Right now I\'m a notice.',
				styling: 'jqueryui',
				before_close: function(pnotify){
					pnotify.pnotify({
						title: 'Error',
						text: 'Uh oh. Now I\'ve become an error.',
						type: 'error',
						styling: 'jqueryui',
						before_close: function(pnotify){
							pnotify.pnotify({
								title: 'Success',
								text: 'I fixed the error!',
								type: 'success',
								styling: 'jqueryui',
								before_close: function(pnotify){
									pnotify.pnotify({
										title: 'Info',
										text: 'Everything\'s cool now.',
										type: 'info',
										styling: 'jqueryui',
										before_close: null
									});
									pnotify.pnotify_queue_remove();
									pnotify.effect('bounce');
									return false;
								}
							});
							pnotify.pnotify_queue_remove();
							pnotify.effect('bounce');
							return false;
						}
					});
					pnotify.pnotify_queue_remove();
					pnotify.effect('bounce');
					return false;
				}
			});*/
			
			
    		//alert(cookies['is_logged_in']);    
			//for(var name in cookies) {
			//    alert(name + " : " + cookies[name]);
			//}
			//alert(cookies['tries_' + $("#userName").val()]);
			//alert($(".customErrors").html() + ", " + $(".customErrors").html().indexOf("MIS"));
			if ($(".customErrors").html() != "")
				$.pnotify({
					title: ($(".customErrors").html().indexOf("MIS") > 0) ? "Warning" : (cookies['tries_' + $("#userName").val()] == 1) ? "Information" : (cookies['tries_' + $("#userName").val()] == 2) ? "Notification" : "Warning",
					text: $(".customErrors").html(),
					type: ($(".customErrors").html().indexOf("MIS") > 0) ? "error" : (cookies['tries_' + $("#userName").val()] <= 2) ? "notice" : "error",
					icon: true,
					styling: 'jqueryui',
					history: false,
					closer: false,
					sticker: false
				});
    		
	        var onClose = function() {
	        	var conf = confirm("Are you sure you want to close this dialog?");
	        	if (!conf)
	        		e.preventDefault();
	        }
	        $("#window").kendoWindow({ 
	            width: "500px",
	            height: "auto",
	            title: "Change Password",
	            close: onClose,
	            modal: true,
	            visible: false,
	            resizable: false,
	            scrollable: true
	        });
	        $("#userName").select().focus();
    		$("#userName").bind({
    			blur: function(){
			        $.post("/codeIgniter/index.php/webapps/index/directCall/user",{user_id: $("#userName").val()},
			        	function(data){
			        		if (data.rows.length == 0){
			        			$("#buttLogin").prop("disabled", true).addClass("k-state-disabled");
			        			//$("#passWord").prop("disabled", true).addClass("k-state-disabled");
			        			$("#userName").select().focus();
			        		}else{
			        			//$("#passWord").prop("disabled", false).removeClass("k-state-disabled").select().focus();
			        			//$("#buttLogin").prop("disabled", false).removeClass("k-state-disabled");
			        			if (parseInt(data.rows[0]['needChange']) == 1){				        				
							        $.post("/codeIgniter/index.php/webapps/templateLoader/index/tmpl_changePassword",{userID: data.rows[0]['user_id'],userName: data.rows[0]['user_name'],PROGRESS_RECID: data.rows[0]['PROGRESS_RECID'], needChange: 1},
							        	function(data){
							            	$("#window").html(data);
							        	});
							        	
									$("#window").data("kendoWindow").setOptions({
									    title: "Change Password",
									    width: "500px",
									    height: "166px"
									});
        							$("#window").data("kendoWindow").center().open();
			        			}
			        		}				        		
			        	});
    			}
    		});
    		$("#passWord").bind({
    			keyup: function(e){
    				if (this.value != "")
			        	$("#buttLogin").prop("disabled", false).removeClass("k-state-disabled");
			        else
			        	$("#buttLogin").prop("disabled", true).addClass("k-state-disabled");
    			}
    		})
		});
    </script>
</html>