<style>
	#win_sub-wrapper {
		margin-top: 0;
		padding: 0;
	}
	.k-upload-files {width: 100px;}
	.buttonLeft {width: 50%;}
</style>
<div id="win_sub-wrapper">
	<ul>			
		<li> <label class="title" for="client" style="width: 36%;">Client:</label><input required type="text" name="client_mod" id="client_mod" style="width: 52%" />
			<button name="client_ref_mod" id="client_ref_mod" class="k-button">...</button>
		</li>
		<li> <label class="title" for="first_name" style="width: 36%;">First Name:</label><input required type="text" name="first_name_mod" id="first_name_mod" class="k-textbox" style="width: 62%;" /> </li>
		<li> <label class="title" for="last_name" style="width: 36%;">Last Name:</label><input required type="text" name="last_name_mod" id="last_name_mod" class="k-textbox" style="width: 62%;" /> </li>
		<li> <label class="title" for="email_add" style="width: 36%;">Email Address:</label><input type="text" name="email_add_mod" id="email_add_mod" class="k-textbox" style="width: 62%;" /> </li>
		<li> <label class="title" for="user_id" style="width: 36%;">User ID:</label><input required type="text" name="user_id_mod" id="user_id_mod" class="k-textbox" style="width: 62%;" /> </li>
		<li> <label class="title" for="pword" style="width: 36%;">Password:</label><input required type="password" name="pword_mod" id="pword_mod" class="k-textbox" style="width: 53%;" />
			<button type="button" name="gen_pw_mod" id="gen_pw_mod" class="k-button">...</button> </li>
<!-- 		<li> <label class="title" for="conf_pword" style="width: 36%;">Confirm Password:</label><input required type="password" name="conf_pword_mod" id="conf_pword" class="k-textbox" style="width: 62%;" /> </li> -->
		<li> <label class="title" for="expiry_date" style="width: 36%;">Expiry Date:</label><input required type="text" name="expiry_date_mod" id="expiry_date_mod" style="width: 35%;" /> </li>
	</ul>
	<hr style="margin: 3px 0;" />
	<button name="create" id="create" class="k-button" style="float: right;">Create</button>
</div>

<script type="text/javascript">
	$(document).ready(function(){ 
		var crudService = '/codeigniter/index.php/portal/' + "index/", log_user = '<?php echo $user_id; ?>';
        
        var client_mod = $("#client_mod").kendoComboBox({
	        highlightFirst: false,
            filter: "contains",
            placeholder: "Select client...",
            dataTextField: "short_desc",
            dataValueField: "id",
            autoBind: false,
            dataSource: {
                transport: {
                    read: crudService + "directCall/client",
            		contentType: "application/json"
                },
                schema: {
					data: function(data){
	                    return data.rows || [];
					}	                    	
                }
            },
            change: function(e){
				if (this.selectedIndex < 0)
            		$(".k-input").eq(0).val("").select().focus();
            }
        }).data("kendoComboBox");
        
		var expiry_mod = $("#expiry_date_mod").removeClass('k-state-disabled').kendoDateTimePicker({
			format: "MM/dd/yyyy hh:mm:ss",
			enable: false
		}).data("kendoDateTimePicker");
		
		$("#win_sub-wrapper button").bind({
			click: function(){
				switch(this.id){
					case "client_ref_mod":
		    			$("#window").data("kendoWindow").setOptions({
						    title: "Reference File",
						    width: "700px",
						    height: "auto",
						    close: function(){}
						});
						$("#window").data("kendoWindow").refresh({
							url: "<?php echo PREURL; ?>/index/direct_to/portRclient",
							type: "POST",
							data: {dl_ds_length: <?php echo $_POST['dl_ds_length']; ?>}
						});
			        	$("#window").data("kendoWindow").center().open();
					break;
					case "gen_pw_mod":
						$("#pword_mod").val(Math.random().toString(36).slice(5));
						break;
					default:
						isFailed = verifyThisInput("#win_sub-wrapper");
			    		if (isFailed)
			    			return true;
			    			
				        $.post(crudService + "manage/user",{id: 0, client_id: client_mod.value(), first_name: $("#first_name_mod").val(), last_name: $("#last_name_mod").val(), 
				        									email_add: $("#email_add_mod").val(), user_id: $("#user_id_mod").val(), password: $("#pword_mod").val(), 
				        									expiry: kendo.toString(expiry_mod.value(),"yyyy-MM-dd hh:mm:ss"), log_user: log_user},
				       	    function(data){
				       	    	if (data != '1')
									showNotif('Warning',data,'warning');
								else {
									showNotif('Information',"User successfully created!",'information');
									$("#win_main-wrapper input").each(function(index,value){
										this.value = "";										
									});
								}
				       	    });
					break;
				}
	    	}
		});
	});
</script>
