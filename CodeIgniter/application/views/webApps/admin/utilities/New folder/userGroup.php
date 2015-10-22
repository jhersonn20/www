<div class="utilitiesBox mainContent">
    <span class="title"> User Groups </span>
	<table id="groupGrid"></table>
	<div id="nav_groupGrid"></div>
</div>
<div id="hidDiv"></div>
<script type="text/javascript">
    $(document).ready(function(){
		$("#groupGrid").empty().jqGrid({       
			datatype: "json",
			url: "/assets/json/teams.json",
			colNames:['Teams'],
			colModel:[
				{name:'group',
				 index:'group',
				 width:40,
				 align:'center',
				 editable: true,
				 editoptions:{size:42},
				 formoptions:{rowpos:1,
				 			  label: "Team: ",
				 			  elmprefix:"(*)"
				 },
				 editrules:{required:true}
				},
			],
			jsonReader: {
				repeatitems: false
			},
			pager: '#nav_groupGrid',
			sortname: 'group',
			viewrecords: true,
			sortorder: "asc",
			//caption:"Contestants",
			width: 100,
			height: "100%",
			editurl:"teams.php",
			afterInsertRow: function(){
				highlight(".groupGridProper", 1);
			}
		});
		$("#groupGrid").jqGrid('navGrid','#nav_groupGrid',
			{}, //options
			{height:100,reloadAfterSubmit:false}, // edit options
			{height:100,reloadAfterSubmit:false}, // add options
			{reloadAfterSubmit:false}, // del options
			{} // search options
		);
    });
</script>