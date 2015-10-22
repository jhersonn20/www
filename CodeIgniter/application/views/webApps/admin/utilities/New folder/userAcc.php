<div class="utilitiesBox mainContent">
    <span class="title"> User Accounts </span>
    <div id="mygrid_container" class="mainContentB" style="width:800px;height: 327px;"></div>
	<!--<div id="combo_zone2" style="width:200px; height:30px;"></div>-->
    <div class="utilitiesBoxFooter mainContentF">
        <a class="likeButt" href="javascript:void(0)" onclick="mygrid.addRow((new Date()).valueOf(),[$('#selSys').val(),'',''],mygrid.getRowIndex(mygrid.getSelectedId()))"> Add </a>
        <a class="likeButt" href="javascript:void(0)" onclick="mygrid.deleteSelectedItem()"> Remove </a>
        <input type="button" name="commitButt" id="commitButt" onclick="myDataProcessor.sendData()" value="Commit Changes" />
    </div>
</div>
<div id="hidDiv"></div>
<script type="text/javascript">
    var mygrid;
    var scriptArr = ["dhtmlxSuite/dhtmlxGrid/codebase/dhtmlxcommon.js",
                     "dhtmlxSuite/dhtmlxGrid/codebase/dhtmlxgrid.js",
                     "dhtmlxSuite/dhtmlxGrid/codebase/dhtmlxgridcell.js",
                     "dhtmlxSuite/dhtmlxCombo/codebase/dhtmlxcombo.js",
                     "dhtmlxSuite/dhtmlxDataProcessor/codebase/dhtmlxdataprocessor.js",
                     "dhtmlxSuite/dhtmlxGrid/codebase/dhtmlxgrid.css",
                     "dhtmlxSuite/dhtmlxCombo/codebase/dhtmlxcombo.css",
                     "dhtmlxSuite/dhtmlxGrid/codebase/skins/dhtmlxgrid_dhx_web.css"];
    
    function doInitGrid(){
        mygrid = new dhtmlXGridObject('mygrid_container'); 
        mygrid.setImagePath("/assets/js/dhtmlxSuite/dhtmlxGrid/codebase/imgs/");     
        mygrid.setHeader("ID,Name,Group Code");     
        mygrid.setInitWidths("100px,*,100px");     
        mygrid.setColAlign("left,left,left");     
        mygrid.setSkin("light");
        mygrid.setColSorting("str,str,str");
        mygrid.setColTypes("ed,ed,co");		
        mygrid.attachEvent("onRowSelect",doOnRowSelected);
        mygrid.init();
    }
    function addRow(){
        var newId = (new Date()).valueOf()
        mygrid.addRow(newId,"",mygrid.getRowsNum())
        mygrid.selectRow(mygrid.getRowIndex(newId),false,false,true);
    }
    function removeRow(){
        var selId = mygrid.getSelectedId()
        mygrid.deleteRow(selId);
    }
    function doOnRowSelected(rowID,celInd){
		
		var combo = mygrid.getCombo(celInd);
		combo.load("http://localhost/cgi-bin/cgiip.exe/WService=mainBroker/model/qms_str/index.html?contentType=xml");
		//combo.restore();
		//combo.clear();
		//combo.save();
		//alert("first: " + combo.size());
		//combo.put("romel","gomez");
        //alert("Selected row ID is " + rowID + "\nUser clicked cell with index " + celInd);
		//alert("second: " + combo.size());
		//combo.remove("PCD-M");
		//combo.save();
		//alert("third: " + combo.size());
    }
    $(document).ready(function(){
        insertPlugins(scriptArr);
        
        setTimeout(function(){
			//var z = new dhtmlXCombo("combo_zone2", "alfa2", 200);
			//z.readonly(1);
			//z.loadXML("http://localhost/cgi-bin/cgiip.exe/WService=mainBroker/model/qms_str/index.html?contentType=xml");
			
            doInitGrid();
            mygrid.load("http://localhost/cgi-bin/cgiip.exe/WService=mainBroker/model/qms_str/index.html?contentType=json","json");
            myDataProcessor = new dataProcessor("http://localhost/dbEvent/update_all_util.php"); //lock feed url
            myDataProcessor.setTransactionMode("POST",true); //set mode as send-all-by-post
            myDataProcessor.setUpdateMode("off"); //disable auto-update
            myDataProcessor.init(mygrid); //link dataprocessor to the grid
			
        }, 10);
    });
</script>