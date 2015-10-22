var crudServiceBaseUrl = "/codeIgniter/index.php/webapps/",
    hostname = $(location).attr('hostname'),
    pathname = $(location).attr('pathname'),
    onClose, cookies, oObj = {},
    closeDialog = false, notif,
    skip_this_field = [];
    
$(document).ready(function(){
	cookies = get_cookies_array();
    onClose = function() {
    	var conf = confirm("Are you sure you want to close this dialog?");
    	if (!conf)
    		e.preventDefault();
    }
    
	notif = function(type,title,text){
		$.pnotify({
			title: title,
			text: text,
			type: type,
			icon: true,
			styling: 'jqueryui',
			history: false,
			closer: false,
			sticker: false
		});
	}
    
    $("#window").kendoWindow({ 
        width: "500px",
        height: "auto",
        title: "Change Password",
        //close: onClose,
        modal: true,
        visible: false,
        resizable: false,
        scrollable: true,
        activate: function(){
        	this.wrapper.css({top: (($("#main-wrapper").height() > this.wrapper.height()) ? (parseInt($("#main-wrapper").height()) - parseInt(this.wrapper.height())) / 2 : 0)});
        	//this.wrapper.css({top: 100});
        	//this.center();
            //$("#window").data("kendoWindow").center();
        }
    });
    $("#window").unbind('keydown');
    
    $("#subWindow").kendoWindow({ 
        width: "868px",
        height: "auto",
        // close: processOnClose,
        modal: true,
        visible: false,
        resizable: false,
        scrollable: true,
        activate: function(){
        	this.wrapper.css({top: (($("#main-wrapper").height() > this.wrapper.height()) ? (parseInt($("#main-wrapper").height()) - parseInt(this.wrapper.height())) / 2 : 0)});
        }
    });
    $("#subWindow").unbind('keydown');
    
    $("button").bind({
    	click: function(){
	    	switch(this.id){
	    		case "closeButt":
	    			// $("#main-wrapper").fadeOut(800); //.html("");					$( "#main-wrapper" ).animate({
						opacity: 0.25,
						left: "+=50",
						height: "toggle"
					}, 500, function() {
	    				$("#main-wrapper").html("");
					});
					$("body").css({"background": $("body").css("background").replace("_blur_1",""), "background-size": "100% 100%"});
	    		break;
	    	}
	    }
    });
    
    // setInterval(function() {   
		// //for(var name in cookies) {
		// //    alert(name + " : " + cookies[name]);
		// //}
	    // // Do something after 5 seconds
	    // //alert(cookies['ci_session'].indexOf('is_logged_in') < 0);
	    // if (pathname.indexOf("/index/") < 0 && pathname != "/codeIgniter/index.php/webapps")
		    // $.post(crudServiceBaseUrl + "index/verify_session",{},
		    	// function(data){
		    		// if (data){
						// $.pnotify({
							// title: "Warning",
							// text: "Session Expired!\n You will be redirected to the login page!",
							// type: "error",
							// icon: true,
							// styling: 'jqueryui',
							// history: false,
							// closer: false,
							// sticker: false
						// });
			    		// setTimeout(function() {
			    			// document.location.href = "/codeIgniter/index.php/webapps";
			    		// }, 3000);
			    	// }
		    	// });
// 	    	
	// }, 3000);
	    /*if (cookies['ci_session'].indexOf('is_logged_in') < 0){
	    	if (pathname != "/codeIgniter/index.php/webapps")
	    		document.location.href = "/codeIgniter/index.php/webapps";
	    }*/
	   
    $("input[required], textarea[required], select[required]").bind({
    	blur: function(e){
    		if ($.trim(this.value) != ""){
    			$(this).removeClass("thisIsRequired");
    			$(this).parent().removeClass("thisIsRequired");
    			$(this).parent().parent().removeClass("thisIsRequired");
    		}
    	}
    });
    
    $.each($("input[required], textarea[required], select[required]"), function(index,value){
    	$(this).parent().find("label[for=" + this.id + "]").append("<span style='color: red;'>*</span>");
    });
});

//window.URL = window.URL || window.webkitURL;
// var link = document.createElement('a');
// link.href = "http://" + hostname + "/assets/text/invalid_engg_spl_asof_" + kendo.toString(new Date(),"yyyy-MM-dd") + ".csv";
// // var blob = new Blob(["http://" + hostname + "/assets/text/invalid_engg_spl_asof_" + kendo.toString(new Date(),"yyyy-MM-dd") + ".csv"], {'type':'application\/octet-stream'});
// // link.href = window.URL.createObjectURL(blob);
// 
// link.download = "invalid_engg_spl_asof_" + kendo.toString(new Date(),"yyyy-MM-dd") + ".csv";
// 							 
// //Dispatching click event.
// if (document.createEvent) {
    // var e = document.createEvent('MouseEvents');
    // e.initEvent('click' ,true ,true);
    // link.dispatchEvent(e);
	// close_preloader();
    // return true;
// }
// var $idown;  // Keep it outside of the function, so it's initialized once.
// var downloadURL = function(url) {
  // if ($idown && $idown.length > 0)
    // $idown.attr('src',url);
  // else
    // $idown = $('<iframe>', { id:'idown', src:url }).hide().appendTo('body');
// };
// downloadURL("http://" + hostname + "/assets/text/invalid_engg_spl_asof_" + kendo.toString(new Date(),"yyyy-MM-dd") + ".csv"); //... How to use it:
