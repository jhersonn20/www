<div class="utilitiesBox mainContent">
    <span class="title"></span>
    <div style="width: 100%;margin-bottom: 5px;">
        <fieldset style="padding-left: 5px;">
        	<?php
        		$js = 'id="sel_grpMenu" style="margin: 5px 0;"';
				//$options = array("1"=>"One","2"=>"Two","3"=>"Three");
        		echo validation_errors();
				echo form_label("Group Description: ", "sel_grpMenu");
				echo form_dropdown("sel_grpMenu",$selOptions,"2",$js);				
        	?>
        </fieldset>
        <fieldset style="padding: 3px;">
        	<div style="float: left;margin-right: 30px;">        	
				<table id="grid"></table>
				<div id="pager"></div>
			</div>        	
        	<div style="float: left;">
				<table id="grid2"></table>
				<div id="pager2"></div>
			</div>
        </fieldset>
    </div>
	<div class="utilBoxFooter">
		<a class="likeButt" href="http://localhost/codeIgniter/index.php/webapps/admin/system/">Exit</a>
		<a class="likeButt" href="http://localhost/codeIgniter/index.php/webapps/admin/system/">Access</a>
	</div>
</div>
<div id="hidDiv"></div>
<script type="text/javascript" src="/assets/js/webapps/qms/menuAss.js"></script>
<script type="text/javascript">	
	jQuery(document).ready(function(){
		$.each($("#leftUtilPhase ul").children(), function(index, value){
			if (value.className == "currLeftNav")
				$(".utilitiesBox span.title").html($(value).text());
		});
		jQuery("#grid").jqGrid({
			url:"../../../../../../grid/models/q_grpmenu.php?vEvent=view",
			datatype:"json",
            mtype : 'POST',
            colNames : [ 'ID', 'Description' ],
			colModel:[
			     {name:"id",label:"ID", hidden: true,width:10,editable:true, editoptions:{disabled: true}},
			     {name:"description",label:"Description", width: 50,editable:true,editoptions:{size:30},editrules:{required:true}}
			],
			jsonReader:{
				repeatitems:false
			},
			width: 350,
			height: 'auto',
            rowNum : 10,
            rowList : [10,20,30],
			pager:"#pager",
            sortname : 'description',
            sortorder : 'asc',
            shrinkToFit : true,
			altRows: true
		});
		$("#grid").css({float: 'left'});
		jQuery("#grid2").jqGrid({
			url:"../../../../../../grid/models/q_grpmenu.php?vEvent=view",
			datatype:"json",
            mtype : 'POST',
            colNames : [ 'ID', 'Description' ],
			colModel:[
			     {name:"id",label:"ID", hidden: true,width:10,editable:true, editoptions:{disabled: true}},
			     {name:"description",label:"Description", width: 50,editable:true,editoptions:{size:30},editrules:{required:true}}
			],
			jsonReader:{
				repeatitems:false
			},
			width: 350,
			height: 'auto',
            rowNum : 10,
            rowList : [10,20,30],
			pager:"#pager2",
            sortname : 'description',
            sortorder : 'asc',
            shrinkToFit : true,
			altRows: true
		});
		jQuery("#grid").jqGrid('gridDnD',{
			connectWith:'#grid2',
			ondrop: function (ev, ui, getdata) {
				jQuery("#grid2").jqGrid('setGridParam',{url:"../../../../../../assets/php/webapps/qms/menuAss_method.php?vEvent=edit&selected=0&id=" + $(ui.draggable).attr("id")}).trigger("reloadGrid");
			}
		});
		jQuery("#grid2").jqGrid('gridDnD',{
			connectWith:'#grid',
			ondrop: function (ev, ui, getdata) {
				jQuery("#grid").jqGrid('setGridParam',{url:"../../../../../../assets/php/webapps/qms/menuAss_method.php?vEvent=edit&selected=1&id=" + getdata["id"]}).trigger("reloadGrid");
			}
		});
	});
</script>