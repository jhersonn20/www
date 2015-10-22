$(document).ready(function(){   
    var scriptArr = [];
    scriptArr = ["hs_draggable.js"];
    
	$("#selSys").kendoComboBox();
	$(".k-input").select().focus();
    insertPlugins(scriptArr);
    constructNav($(".col01"), "sitemap");
    
    if ($(".notif").is(":visible"))
        setTimeout(function(){
            $(".notif").hide("slow");
        }, 5000);
    $("input[type='button']").bind({
        click: function(){
            switch (this.id){
                case "addButt":
                    if (!$(".dirPhase").find("input[type='checkbox']:checked").length){
                        notif("There is no selected item, kindly select first...");
                        return true;
                    }
                    $.each($("#sitemap li").find(".dropzone"), function(index, value){
                        $(this).remove();
                    });
                    if (!$("#sitemap").length)
                        $(".col01").html("<ul id='sitemap'></ul>");
                    $.each($(".dirPhase").find("input[type='checkbox']:checked"), function(index, value){
                        $("#sitemap").append("<li>" +
                                             "  <dl class=\"sm2_s_published\">"  +
                                             "      <dt><span class=\"sm2_title\">" + ($(".dirPhase").find("input[type='checkbox']:checked").eq(index).val().split(".")[0].charAt(0).toUpperCase() + $(".dirPhase").find("input[type='checkbox']:checked").eq(index).val().split(".")[0].slice(1)) + "</span></dt>"  +
                                             "      <dd class=\"sm2_actions\">"  +
                                             "          <span class=\"sm2_delete 0\" title=\"Delete\" onclick=\"deleteNav(this);\">Delete</span>"  +
                                             "          <span class=\"sm2_edit\" title=\"Edit\" onclick=\"editNav(this);\">Edit</span>"  +
                                             "      </dd>"  +
                                             "      <dd class=\"sm2_status\">"  +
                                             "          <span class=\"sm2_pub\" title=\"Published\" onclick=\"pubNav(this);\">Published</span>"  +
                                             "          <span class=\"sm2_workFlow\" title=\"Draft Exists\" onclick=\"pubNav(this);\">Draft Exists</span>"  +
                                             "      </dd>"  +
                                             "      <div id=\"menuDtls\">" + 
                                             "          <label for=\"txtLabel\">Label:</label>" + 
                                             "          <input type=\"text\" name=\"txtLabel\" id=\"txtLabel\" class=\"k-textbox\" value=\"" + ($(".dirPhase").find("input[type='checkbox']:checked").eq(index).val().split(".")[0].charAt(0).toUpperCase() + $(".dirPhase").find("input[type='checkbox']:checked").eq(index).val().split(".")[0].slice(1)) + "\" />" +
                                         	 "          <label for=\"txtPath\">Path:</label>" +  
                                             "          <input type=\"text\" name=\"txtPath\" id=\"txtPath\" class=\"k-textbox\" value=\"" + $(".dirPhase").find("input[type='checkbox']:checked").eq(index).val() + "\" />" + 
                                         	 "          <label for=\"txtParam\">Parameter:</label>" +  
                                             "          <input type=\"text\" name=\"txtParam\" id=\"txtParam\" class=\"k-textbox\" value=\"" + $(".dirPhase").find("input[type='checkbox']:checked").eq(index).val() + "\" />" +
                                             "      </div>" + 
                                             "  </dl>"  +
                                             "</li>"
                                            );
                    });
					removejscssfile("hs_draggable.js","js");
                    scriptArr = ["hs_draggable.js"];
                    insertPlugins(scriptArr);
                break;
                case "custAddButt":
                    if ($("#txtLabel").val() == ""){
                        notif("\"Label:\" field must not be empty...");
                        return true;
                    }
                    $.each($("#sitemap li").find(".dropzone"), function(index, value){
                        $(this).remove();
                    });
                    if (!$("#sitemap").length)
                        $(".col01").html("<ul id='sitemap'></ul>");
                    $("#sitemap").append("<li>" +
                                         "  <dl class=\"sm2_s_published\">"  +
                                         "      <dt><span class=\"sm2_title\" href=\"#\">" + $("#txtLabel").val() + "</span></dt>"  +
                                         "      <dd class=\"sm2_actions\">"  +
                                         "          <span class=\"sm2_delete 0\" title=\"Delete\" onclick=\"deleteNav(this);\">Delete</span>"  +
                                         "          <span class=\"sm2_edit\" title=\"Edit\" onclick=\"editNav(this);\">Edit</span>"  +
                                         "      </dd>"  +
                                         "      <dd class=\"sm2_status\">"  +
                                         "          <span class=\"sm2_pub\" title=\"Published\" onclick=\"pubNav(this);\">Published</span>"  +
                                         "          <span class=\"sm2_workFlow\" title=\"Draft Exists\" onclick=\"pubNav(this);\">Draft Exists</span>"  +
                                         "      </dd>"  +
                                         "      <div id=\"menuDtls\">" + 
                                         "          <label for=\"txtLabel\">Label:</label>" + 
                                         "          <input type=\"text\" name=\"txtLabel\" id=\"txtLabel\" class=\"k-textbox\" value=\"" + $("#txtLabel").val() + "\" />" +
                                         "          <label for=\"txtPath\">Path:</label>" + 
                                         "          <input type=\"text\" name=\"txtPath\" id=\"txtPath\" class=\"k-textbox\" value=\"" + $("#txtPath").val() + "\" />" +  
                                     	 "          <label for=\"txtParam\">Parameter:</label>" +  
                                         "          <input type=\"text\" name=\"txtParam\" id=\"txtParam\" class=\"k-textbox\" value=\"" + $("#txtParam").val() + "\" />" +
                                         "      </div>" + 
                                         "  </dl>"  +
                                         "</li>"
                                        );
					removejscssfile("hs_draggable.js","js");
                    scriptArr = ["hs_draggable.js"];
                    insertPlugins(scriptArr);
                break;
                case "printButt":
				    var rpt_name = "rmenu";
					open_preloader();
					$.post("/codeIgniter/index.php/webapps/ln_setup/print_to_csv/" + rpt_name,{rpt_name: rpt_name,appl_code: $("#selSys").val()},
						function(data){
							//alert(data);
							close_preloader();
							setTimeout(function(){
								if (data == "true")
									to_pdf("Menu Listing",rpt_name);
								else
									$.pnotify({
										title: "Warning",
										text: data,
										type: "error",
										icon: true,
										styling: 'jqueryui',
										history: false,
										closer: false,
										sticker: false
									});
							},2000);
						});
                break;
                default:
                    var confSave = confirm("Save navigation?");
                    if (confSave){                        
                        var navList = [],
                            menuCode = 0,
                            submenuCode = 0;
                        $.each($(".col01").find("ul"), function(index, value){
                            $.each($(this).children("li"), function(subIdx, subVal){ 
                                if (value.id == "sitemap")
                                    menuCode = 1000;
                                else
                                    menuCode = (index + 1) * 1000;
                                menuCode += (subIdx + 1);
                                if (value.id == "sitemap")
                                    submenuCode = 0;
                                else {
                                    if ($(".col01").find("ul").eq($(".col01").find("ul").index($(this).parent().parent().parent()))[0].id == "sitemap")
                                        submenuCode = 1;
                                    else
                                        submenuCode = $(".col01").find("ul").index($(this).parent().parent().parent()) + 1;
                                    submenuCode = ((submenuCode * 1000) + ($(".col01").find("ul").eq($(".col01").find("ul").index($(this).parent().parent().parent())).children("li").index($(this).parent().parent()) + 1));                                    
                                }
                                //var item = {
                                //            system_code: $("#selSys").val(),
                                //            project_code: $("#selProj").val(),
                                //            menu_code: menuCode,
                                //            submenu_code: submenuCode,
                                //            //label: $.trim($(this).find(".sm2_title").eq(0).text()).split(".php")[0],
                                //            label: $.trim($(this).find("#txtLabel").eq(0).val()).split(".php")[0],
                                //            path: $(this).find("#txtPath").eq(0).val(),
                                //            publish: (($(this).find(".sm2_pub").eq(0).is(":visible") == false) ? 0 : 1),
                                //            just_label: (($(this).find("#txtPath").eq(0).val() != "") ? 0 : 1)
                                //           };
                                var item = {
                                            appl_code: $("#selSys").val(),
                                            //project_code: $("#selProj").val(),
                                            menucode: menuCode,
                                            subcode: submenuCode,
                                            //label: $.trim($(this).find(".sm2_title").eq(0).text()).split(".php")[0],
                                            description: $.trim($(this).find("#txtLabel").eq(0).val()).split(".php")[0],
                                            mtitle: $.trim($(this).find("#txtLabel").eq(0).val()).split(".php")[0],
                                            //app_name: "piping",
                                            progname: $(this).find("#txtPath").eq(0).val(),
                                            publish: (($(this).find(".sm2_pub").eq(0).is(":visible") == false) ? 0 : 1),
                                            just_label: (($(this).find("#txtPath").eq(0).val() != "") ? 0 : 1),
                                            param: $(this).find("#txtParam").eq(0).val(),
                                            PROGRESS_RECID: $.trim($(this).find(".sm2_delete").eq(0).attr("class")).split(" ")[1] //$(this).find("#txtPath").eq(0).attr("class").split(" ")[1]
                                           };
                                navList.push(item);
                            });
                        });
                        $("#jsonData").val(JSON.stringify({item: navList}));
                        document.navForm.submit();
                    }
                break;
            }
        }
    });
    $("input[id='txtSrcView']").bind({
        keyup: function(e){
            var txtVal = this.value;
            $.each($(".dirPhase ul").children("li"), function(index, value){
                if ($(value).text().indexOf(txtVal) == -1)
                    $(this).addClass('hideULView');
                else
                    $(this).removeClass('hideULView');
            });
        }
    });
    $("input[type=text]").keyup(function(){
    	if (this.id == "txtLabel")
    		$(this).parent().parent().find("dt > span").text(this.value);
    });
    $("span").bind({
        click:function(){
            switch(this.className.split(" ")[0]){
                case "sm2_delete":
                	if (!confirm("Are you sure you want to delete this record?"))
                		return true;
                		
                	deleteNav(this);
                	if (parseInt($(this).attr("class").split(" ")[1]) > 0){
				        $.post("http://localhost/codeIgniter/index.php/webapps/ln_setup/remove/menu",{PROGRESS_RECID: parseInt($(this).attr("class").split(" ")[1])},
				       	    function(data){});
                	}
                break;
                case "sm2_edit":
                    editNav(this);
                break;
                case "sm2_pub":
                    pubNav(this);
                break;
                case "sm2_workFlow":
                    pubNav(this);
                break;
                case "view":
                    $(".dirPhase").find("input[type='checkbox']").attr("checked", ($(".dirPhase").find("input[type='checkbox']:checked").length) ? false : true);
                break;
            }
        }
    });
});