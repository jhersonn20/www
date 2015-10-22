$(document).ready(function(){
    //$("#currPass").select().focus();
    //var pathArray = window.location.href.split("/");
	$("#window input").bind({
		blur: function(){
			if (this.id == "currPass"){
				if (!$("#currPass").is(":disabled")){
					$.post("http://" + $(location).attr("hostname") + "/codeIgniter/index.php/webApps/ln_setup/get_rowArray/users",{user_id: $("#hidd_w_userID").val(), password: $("#currPass").val()},
					function(data){
						if (data == "Array"){
							$("#currPass").prop("disabled", true);
							$("#newPass").prop("disabled", false).select().focus();
						}
					});
				}
			}
		},
		keyup: function(){
			if (this.id == "newPass" && this.value != ""){
				if ($("#confPass").val() != ""){
					$("#applyButt").prop("disabled", !(this.value == $("#confPass").val()));
					if (this.value == $("#confPass").val())
						$("#applyButt").removeClass("k-state-disabled");
					else
						$("#applyButt").addClass("k-state-disabled");
				}
				$("#confPass").prop("disabled", false);
			}else if (this.id == "confPass"){
				$("#applyButt").prop("disabled", !(this.value == $("#newPass").val()));
				if (this.value == $("#newPass").val())
					$("#applyButt").removeClass("k-state-disabled");
				else
					$("#applyButt").addClass("k-state-disabled");
			}
		}
	});
	$("#applyButt").click(function(){
		//alert($(location).attr("hostname"));
		$.post("http://" + $(location).attr("hostname") + "/codeIgniter/index.php/webApps/ln_setup/manage/usersPW",{user_id: $("#hidd_w_userID").val(), currPass: $("#currPass").val(), newPass: $("#newPass").val(), recid: $("#hidd_w_PROGRESS_RECID").val(), needChange: ($("#currPass").val() == "")},
		function(data){
			//alert(data);
			if (data == "Array"){
				alert("Password successfully changed!");
				if ($("#currPass").is(":disabled") && $("#currPass").val() == ""){
					$("#passWord").val($("#newPass").val());
					if ($("#passWord").val() != "")
		        		$("#myForm").submit();
				}else
					$("#window").data("kendoWindow").close();
			}
		});
	});
});