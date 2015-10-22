<div class="projectBox mainContent">
    <span class="title"> System Maintenance </span>
	<!--<div>
		<?php
			//include ("/../../../../../../grid/models/projMt.php");
		?>
		</div>-->
	<table id="grid"></table>
	<div id="pager"></div>
</div>
<div id="hidDiv"></div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var pathArray = window.location.href.split("/");
		jQuery("#grid").jqGrid({
			url:"../../../../../../grid/models/projMt.php?sysCode=" + $("#selSys").val() + "&vEvent=view",
			datatype:"json",
            mtype : 'POST',
            colNames : [ 'ID', 'system_code', 'Code', 'Description' ],
			colModel:[
			     {name:"id",label:"ID", hidden: true,width:10,editable:true, editoptions:{disabled: true}},
			     {name:"system_code",label:"System", hidden: true,width:60,editable:true, editoptions:{disabled: true}},
			     {name:"project_code",label:"Code",width:20,editable:true, editoptions:{size:30},editrules:{required:true}},
			     {name:"project_desc",label:"Description", editable:true, editoptions:{size:50},editrules:{required:true}}
			],
			jsonReader:{
				repeatitems:false
			},
			width: 500,
			height: 'auto',
            rowNum : 10,
            rowList : [10,20,30],
			pager:"#pager",
            sortname : 'system_code',
            viewrecords : true,
            sortorder : 'asc',
            shrinkToFit : true,
			editurl:"../../../../../../grid/models/projMt.php?vEvent=event",
			altRows: true,
			emptyrecords: "Empty Set.",
			gridComplete: function(){
				if ($.trim($("#project_code").val()) == "")
					return true;
					
				var addThis = true;
				$.each($("#selProj").children(), function(index, value){
					if ($.trim($(value).val()) == $.trim($("#project_code").val()))
						addThis = false;
				});
				
				if (addThis){
					$.post("http://" + pathArray[2] + "/codeIgniter/index.php/webapps/makeDir/?parent=" + $("#system_code").val() + "&folderName=" + $("#project_code").val(), {},
						function(data){
							$("#selProj").append("<option value='" + $("#project_code").val() + "'>" + $("#project_desc").val() + "</option>");
							$("#project_code").val('')
							$("#hidDiv").html(data);
						}
					);
				}
			}
		});
		jQuery("#grid").jqGrid('navGrid','#pager',
			{}, //options
			{
				height: 120,
				width: 360,
				reloadAfterSubmit: true,
				modal: true,
				processData: 'Updating the Project...',
				editCaption: 'Edit a Project',
				beforeShowForm: function(formid) {
					$("#system_code").val($("#selSys").val());			
				},
				closeAfterEdit: true,
				//checkOnSubmit: true,
				checkOnUpdate: true
			},
			{
				height: 120,
				width: 360,
				reloadAfterSubmit: true,
				modal: true,
				processData: 'Inserting the Project...',
				editCaption: 'Add a Project',
				beforeShowForm: function(formid) {
					$("#system_code").val($("#selSys").val());			
				},
				closeAfterAdd: true,
				checkOnUpdate: true
			},
			{reloadAfterSubmit:false}, // del options
			{} // search options
		);
	});
</script>