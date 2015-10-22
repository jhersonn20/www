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
			    addEditrulesPassword={required:true /*some other settings can follow*/},
			    editEditrulesPassword={required:false /*some other settings can follow*/};
	function validate_add(posdata, obj){
	    if(posdata.password != posdata.password_Conf)
	    	return [false, "Password don't match!"];
	
		return [true, ""];
	}
	function hideObj(formid){
		$("tr#tr_user_id", formid).show();
		$("tr#tr_user_name", formid).show();
		$("tr#tr_group_code", formid).show();
		
		$("tr#tr_password_Old", formid).hide();
		$("tr#tr_password", formid).hide();
	}
	function hideObj2(formid){
		$("tr#tr_password", formid).show();
		$("tr#tr_password_Old", formid).show();
		$("tr#tr_password_Conf", formid).show();
		
		$("tr#tr_user_id", formid).hide();
		$("tr#tr_user_name", formid).hide();
		$("tr#tr_group_code", formid).hide();
		$("tr#tr_group_code", formid).hide();
	}
	function dispObj(formid){
		$("tr#tr_user_id", formid).show();
		$("tr#tr_user_name", formid).show();
		$("tr#tr_group_code", formid).show();
		$("tr#tr_group_code", formid).show();
		$("tr#tr_password_Conf", formid).show();
		$("tr#tr_password", formid).show();
		$("tr#tr_password_Old", formid).hide();
	}
	function setChangePW(gid,pid,pgTitle){		
		// setup print button in the grid top navigation bar.
		$('#'+gid).jqGrid('navSeparatorAdd','#'+gid+'_toppager_left', {sepclass :'ui-separator'});
		$('#'+gid).jqGrid('navButtonAdd','#'+gid+'_toppager_left', {caption: '',
																	title: pgTitle,
																	position: "last",
																	buttonicon: 'ui-icon-key',
																	onClickButton: function() {
																	}
		});
		
		// setup print button in the grid bottom navigation bar.
		$('#'+gid).jqGrid('navSeparatorAdd','#'+pid, {sepclass : "ui-separator"});
		$('#'+gid).jqGrid('navButtonAdd','#'+pid, {caption: '',
												   title: pgTitle,
												   position: "last",
												   buttonicon: 'ui-icon-key',
												   onClickButton: function() {
												   	   if (jQuery('#'+gid).jqGrid('getGridParam','selrow') == null){
	    												   //return [false, "Please select Row!"];
												   	   	   alert("Please select Row");
												   	   }else {
													       jQuery('#'+gid).jqGrid('editGridRow',"new",{
													       	   height:145,
													       	   reloadAfterSubmit:true,
															   closeAfterAdd: true,
													       	   beforeShowForm: hideObj2,
																beforeCheckValues: function(postdata, formid, mode) {
														            // get reference to the item of colModel which correspond
														            // to the column 'Password' which we want to change
														            var colArr = ['user_id','user_name','group_code'];
														            $.each(colArr, function(index, value){
															            var cm = grid[0].p.colModel[getColumnIndexByName(value)];
															            cm.editrules = editEditrulesPassword;														            	
														            });
														            var colArr2 = ['password_Old','password','password_Conf'];
														            $.each(colArr2, function(index, value){
															            var cm = grid[0].p.colModel[getColumnIndexByName(value)];
															            cm.editrules = addEditrulesPassword;														            	
														            });
																},
														        onclickSubmit:function(ge,postdata) {
														            // get reference to the item of colModel which correspond
														            // to the column 'Password' which we want to change
														            var colArr = ['user_id','user_name','group_code'];
														            $.each(colArr, function(index, value){
															            var cm = grid[0].p.colModel[getColumnIndexByName(value)];
															            cm.editrules = editEditrulesPassword;
														            });
														            var colArr2 = ['password_Old','password','password_Conf'];
														            $.each(colArr2, function(index, value){
															            var cm = grid[0].p.colModel[getColumnIndexByName(value)];
															            cm.editrules = addEditrulesPassword;														            	
														            });
		        												},
																beforeSubmit:validate_add,
														        serializeEditData: function(data){
																    return $.param($.extend({}, data, {oper:"edit","editType":"pw","id":jQuery('#'+gid).jqGrid('getGridParam','selrow')}));
																},
		        												recreateForm: true
													       });
												   	   }
												   }
		});
	}
	jQuery(document).ready(function(){
		$.each($("#leftUtilPhase ul").children(), function(index, value){
			if (value.className == "currLeftNav")
				$(".utilitiesBox span.title").html($(value).text());
		});
		jQuery("#grid").jqGrid({
			url:"../../../../../../grid/models/q_ruser.php?vEvent=view",
			datatype:"json",
            mtype : 'POST',
            colNames : [ 'ID', 'User ID', 'User Name', 'Group Code', 'Old Password', 'Password', 'Confirm Password' ],
			colModel:[
			     {name:"id",label:"ID", hidden: true,width:10,editable:true, editoptions:{disabled: true}},
			     {name:"user_id",label:"User ID", width: 50,editable:true,editoptions:{size:30},editrules:{required:true}},
			     {name:"user_name",label:"User Name",editable:true,editoptions:{size:50},editrules:{required:true}},
			     {name:"group_code",label:"Group Code", width: 50,editable:true,edittype: "select",editoptions:{size:1,dataUrl:'http://localhost/codeIgniter/index.php/webapps/userAccounts/setSelect'},editrules:{required:true}},
			     {name:"password_Old",label:"Old Password", hidden: true,width:10,editable:true,edittype: "password", editoptions:{size:30}, editrules:{edithidden:true}},
			     {name:"password",label:"Password", hidden: true,width:10,editable:true,edittype: "password", editoptions:{size:30}, editrules:{edithidden:true,required: true}},
			     {name:"password_Conf",label:"Confirm Password", hidden: true,width:10,editable:true,edittype: "password", editoptions:{size:30}, editrules:{edithidden:true,required: true}}
			],
			jsonReader:{
				repeatitems:false
			},
			width: 700,
			height: 'auto',
            rowNum : 10,
            rowList : [10,20,30],
			pager:"#pager",
            sortname : 'user_id',
            viewrecords : true,
            sortorder : 'asc',
            shrinkToFit : true,
			editurl:"../../../../../../grid/models/q_ruser.php?vEvent=event",
			altRows: true,
			emptyrecords: "Empty Set."
		});
		// Set navigator with search enabled.
		//jQuery("#grid").jqGrid('navGrid','#pager',{add:false,edit:false,del:false});
		jQuery("#grid").jqGrid('navGrid','#pager',
			{}, //options
			//{height:280,reloadAfterSubmit:false}, // edit options
			{
				height: 165,
				width: 600,
				reloadAfterSubmit: true,
				modal: true,
				processData: 'Updating the User list...',
				editCaption: 'Edit a User',
				//beforeSubmit:validate_edit,
				beforeShowForm: hideObj,
				closeAfterEdit: true,
				//checkOnSubmit: true,
				checkOnUpdate: true,
				beforeCheckValues: function(postdata, formid, mode) {
		            // get reference to the item of colModel which correspond
		            // to the column 'Password' which we want to change
		            var cm = grid[0].p.colModel[getColumnIndexByName('password_Conf')];
		            cm.editrules = editEditrulesPassword;
				},
		        onclickSubmit:function(ge,postdata) {
		            // get reference to the item of colModel which correspond
		            // to the column 'Password' which we want to change
		            var cm = grid[0].p.colModel[getColumnIndexByName('password_Conf')];
		            cm.editrules = editEditrulesPassword;
		        },
		        recreateForm: true
			},
			//{height:280,reloadAfterSubmit:false}, // add options
			{
				height: 193,
				width: 600,
				reloadAfterSubmit: true,
				modal: true,
				processData: 'Inserting the User...',
				editCaption: 'Add a User',
				beforeSubmit:validate_add,
				beforeShowForm: dispObj,
				closeAfterAdd: true,
				checkOnUpdate: true,
		        recreateForm: true
			},
			{reloadAfterSubmit:false}, // del options
			{} // search options
		);
		setChangePW('grid','pager','Change Password');
	});
</script>