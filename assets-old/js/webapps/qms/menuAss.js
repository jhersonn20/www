$(document).ready(function(){
	$("#sel_grpMenu").change(function(){
		jQuery("#grid").jqGrid('setGridParam',{url:"../../../../../../assets/php/webapps/qms/menuAss_method.php?vEvent=view&groupCode=" + this.value.replace("&","@") + "&selected=0&appName=piping"}).trigger("reloadGrid");
		jQuery("#grid2").jqGrid('setGridParam',{url:"../../../../../../assets/php/webapps/qms/menuAss_method.php?vEvent=view&groupCode=" + this.value.replace("&","@") + "&selected=1&appName=piping"}).trigger("reloadGrid");
	});
});
