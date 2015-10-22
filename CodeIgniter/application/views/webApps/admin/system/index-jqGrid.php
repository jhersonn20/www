<div class="systemBox mainContent">
    <span class="title"> System Maintenance </span>
	<!--<div>
		<?php //include ("/../../../../../../grid/models/sysMt.php");?>
	</div>-->
	<table id="grid"></table>
	<div id="pager"></div>
</div>
<div id="hidDiv"></div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var systemCode = "";
		var systemDesc = "";
		jQuery("#grid").jqGrid({
			url:"../../../../../../grid/models/sysMt.php?vEvent=view",
			datatype:"json",
            mtype : 'POST',
            colNames : [ 'ID', 'Code', 'Description' ],
			colModel:[
			     {name:"id",label:"ID", hidden: true,width:10,editable:true, editoptions:{disabled: true}},
			     {name:"system_code",label:"Code",width:20,editable:true, editoptions:{size:30},editrules:{required:true}},
			     {name:"system_desc",label:"Description", editable:true, editoptions:{size:50},editrules:{required:true}}
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
			altRows: true,
			emptyrecords: "Empty Set.",
			editurl:"../../../../../../grid/models/sysMt.php?vEvent=event",
			gridComplete: function(){
				if ($.trim($("#system_code").val()) == "")
					return true;
										
				var addThis = true;
				$.each($("#selSys").children(), function(index, value){
					if ($.trim($(value).val()) == $.trim($("#system_code").val()))
						addThis = false;
				});
				
				if (addThis){
					$.post("http://localhost/codeIgniter/index.php/webapps/makeDir/?folderName=" + $("#system_code").val(), {},
						function(data){
							$("#selSys").append("<option value='" + $("#system_code").val() + "'>" + $("#system_desc").val() + "</option>");
							$("#system_code").val('');
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
				processData: 'Updating the System...',
				editCaption: 'Edit a System',
				closeAfterEdit: true,
				//checkOnSubmit: true,
				checkOnUpdate: true
			},
			{
				height: 120,
				width: 360,
				reloadAfterSubmit: true,
				modal: true,
				processData: 'Inserting the System...',
				editCaption: 'Add a System',
				closeAfterAdd: true,
				checkOnUpdate: true
			},
			{reloadAfterSubmit:false}, // del options
			{} // search options
		);
	});
</script>