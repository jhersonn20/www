<div class="utilitiesBox mainContent">
    <span class="title"></span>
	<table id="grid"></table>
	<div id="pager"></div>
</div>
<div id="hidDiv"></div>
<script type="text/javascript">
	var grid = $("#grid"),
			    getColumnIndexByName = function(columnName) {
			        var cm = grid.jqGrid('getGridParam','colModel'), // grid[0].p.colModel
			            i = 0,
			            l = cm.length;
			        for (; i<l; i++) {
			            if (cm[i].name===columnName) {
			                return i; // return the index
			            }
			        }
			        return -1;
			    },
			    addEditrulesCode={required:true},
			    editEditrulesCode={required:false};
	jQuery(document).ready(function(){
		$.each($("#leftUtilPhase ul").children(), function(index, value){
			if (value.className == "currLeftNav")
				$(".utilitiesBox span.title").html($(value).text());
		});
		jQuery("#grid").jqGrid({
			url:"../../../../../../grid/models/q_group_tbl.php?vEvent=view",
			datatype:"json",
            mtype : 'POST',
            colNames : [ 'ID', 'Code', 'Description' ],
			colModel:[
			     {name:"id",label:"ID", hidden: true,width: 10,editable:true, editoptions:{disabled: true}},
			     {name:"group_code",label:"Code", width: 50,editable:true,editoptions:{readonly:true,size:30},editrules:{required:true}},
			     {name:"group_desc",label:"Description",editable:true,editoptions:{size:50},editrules:{required:true}}
			],
			jsonReader:{
				repeatitems:false
			},
			width: 700,
			height: 'auto',
            rowNum : 10,
            rowList : [10,20,30],
			pager:"#pager",
            sortname : 'group_code',
            viewrecords : true,
            sortorder : 'asc',
            shrinkToFit : true,
			editurl:"../../../../../../grid/models/q_group_tbl.php?vEvent=event",
			altRows: true,
			emptyrecords: "Empty Set."
		});
		jQuery("#grid").jqGrid('navGrid','#pager',
			{}, //options
			{
				height: 120,
				width: 600,
				reloadAfterSubmit: true,
				modal: true,
				processData: 'Updating the Group list...',
				editCaption: 'Edit a Group',
				closeAfterEdit: true,
				checkOnUpdate: true,
				beforeCheckValues: function(postdata, formid, mode) {
		            var cm = grid[0].p.colModel[getColumnIndexByName('group_code')];
		            cm.editrules = editEditrulesCode;
				},
		        onclickSubmit:function(ge,postdata) {
		            var cm = grid[0].p.colModel[getColumnIndexByName('group_code')];
		            cm.editrules = editEditrulesCode;
		        },
		        beforeShowForm : function(formid) {
		            $("#group_code").attr('readonly', true);
		        },
		        afterShowForm: function(formid){
		            $("#group_desc").select().focus();		        	
		        },
		        recreateForm: true
			},
			{
				height: 120,
				width: 600,
				reloadAfterSubmit: true,
				modal: true,
				processData: 'Inserting the Group...',
				editCaption: 'Add a Group',
				closeAfterAdd: true,
				checkOnUpdate: true,
				beforeCheckValues: function(postdata, formid, mode) {
		            var cm = grid[0].p.colModel[getColumnIndexByName('group_code')];
		            cm.editrules = addEditrulesCode;
				},
		        onclickSubmit:function(ge,postdata) {
		            var cm = grid[0].p.colModel[getColumnIndexByName('group_code')];
		            cm.editrules = addEditrulesCode;
		        },
		        beforeShowForm : function(formid) {
		            $("#group_code").attr('readonly', false);  
		        },
		        recreateForm: true
			},
			{reloadAfterSubmit:false}, // del options
			{} // search options
		);
	});
</script>