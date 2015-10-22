<div class="utilitiesBox mainContent">
    <span class="title"> Utilities Maintenance </span>
	<!--<div>
		<?php //include ("/../../../../../../grid/models/utilMt.php");?>
	</div>-->
	<table id="grid"></table>
	<div id="pager"></div>
</div>
<div id="hidDiv"></div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		// Craeate the grid manually
		jQuery("#grid").jqGrid({
			url:"../../../../../../grid/models/utilMt.php?sysCode=" + $("#selSys").val() + "&projCode=" + $("#selProj").val() + "&vEvent=view",
			datatype:"json",
            mtype : 'POST',
            colNames : [ 'ID', 'system_code', 'project_code', 'Decription', 'File Path' ],
			colModel:[
			     {name:"id",label:"ID", hidden: true,width:10,editable:true, editoptions:{disabled: true}},
			     {name:"system_code",label:"System", hidden: true,width:60,editable:true, editoptions:{disabled: true}},
			     {name:"project_code",label:"Project", hidden: true,width:60,editable:true, editoptions:{disabled: true}},
			     {name:"util_desc",label:"Description:", width: 50,editable:true,editoptions:{size:50},editrules:{required:true}},
			     {name:"util_path",label:"File Path:",editable:true,editoptions:{size:100},editrules:{required:true}}
			],
			jsonReader:{
				repeatitems:false
			},
			width: 700,
			height: 'auto',
            rowNum : 10,
            rowList : [10,20,30],
			pager:"#pager",
            sortname : 'system_code',
            viewrecords : true,
            sortorder : 'asc',
            shrinkToFit : true,
			editurl:"../../../../../../grid/models/utilMt.php?vEvent=event",
			altRows: true,
			emptyrecords: "Empty Set.",
			gridComplete: function(){
				if ($.trim($("#util_path").val()) == "")
					return true;
				
				var addThis = true;
				$.each($("#leftUtilPhase ul").children(), function(index, value){
					if ($.trim($(value).children("a").text()) == $.trim($("#util_desc").val()))
						addThis = false;
				});

				if (addThis)
					$("#leftUtilPhase ul").append("<li><a href='" + $("#util_path").val() + "'>" + $("#util_desc").val() + "</a></li>");
				$("#util_path").val('')
			}
		});
		// Set navigator with search enabled.
		//jQuery("#grid").jqGrid('navGrid','#pager',{add:false,edit:false,del:false});
		jQuery("#grid").jqGrid('navGrid','#pager',
			{}, //options
			//{height:280,reloadAfterSubmit:false}, // edit options
			{
				height: 120,
				width: 600,
				reloadAfterSubmit: true,
				modal: true,
				processData: 'Updating the Utility...',
				editCaption: 'Edit a Utility',
				beforeShowForm: function(formid) {	
					//objActivitiesDropDown.removeOption(/./).ajaxAddOption(getProjectsList( iCustomerID ), null, false).addOption({ '': '--Select activites--' });
					$("#system_code").val($("#selSys").val());
					$("#project_code").val($("#selProj").val());			
				},
				closeAfterEdit: true,
				//checkOnSubmit: true,
				checkOnUpdate: true
			},
			//{height:280,reloadAfterSubmit:false}, // add options
			{
				height: 120,
				width: 600,
				reloadAfterSubmit: true,
				modal: true,
				processData: 'Inserting the Utility...',
				editCaption: 'Add a Utility',
				beforeShowForm: function(formid) {
					//objActivitiesDropDown.removeOption(/./).ajaxAddOption(getProjectsList( iCustomerID ), null, false).addOption({ '': '--Select activites--' });
					$("#system_code").val($("#selSys").val());
					$("#project_code").val($("#selProj").val());			
				},
				closeAfterAdd: true,
				checkOnUpdate: true
			},
			{reloadAfterSubmit:false}, // del options
			{} // search options
		);
	});
</script>