<div class="systemBox mainContent">
    <span class="title"> System Maintenance </span>
    <div id="mygrid_container" class="mainContentB" style="width:400px;height: 300px;"></div>
    <div class="systemBoxFooter mainContentF">
        <a class="likeButt" href="javascript:void(0);" onclick="addRow()"> Add </a>
        <a class="likeButt" href="javascript:void(0);" onclick="removeRow()"> Remove </a>
        <input type="button" name="commitButt" id="commitButt" onclick="myDataProcessor.sendData()" value="Commit Changes" />
    </div>
</div>
<div id="hidDiv"></div>
<script type="text/javascript">
    var mygrid;
    var scriptArr = ["dhtmlxSuite/dhtmlxGrid/codebase/dhtmlxcommon.js",
                     "dhtmlxSuite/dhtmlxGrid/codebase/dhtmlxgrid.js",
                     "dhtmlxSuite/dhtmlxGrid/codebase/dhtmlxgridcell.js",
                     "dhtmlxSuite/dhtmlxDataProcessor/codebase/dhtmlxdataprocessor.js",
                     "dhtmlxSuite/dhtmlxGrid/codebase/dhtmlxgrid.css",
                     "dhtmlxSuite/dhtmlxGrid/codebase/skins/dhtmlxgrid_dhx_web.css"];
    
    function doInitGrid(){
        mygrid = new dhtmlXGridObject('mygrid_container'); 
        mygrid.setImagePath("/assets/js/dhtmlxSuite/dhtmlxGrid/codebase/imgs/");     
        mygrid.setHeader("Name,Code");     
        mygrid.setInitWidths("*,150");     
        mygrid.setColAlign("left,center");     
        mygrid.setSkin("light");
        mygrid.setColSorting("str,str");
        mygrid.setColTypes("ed,ed");
        //mygrid.attachEvent("onRowSelect",doOnRowSelected);
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
        alert("Selected row ID is "+rowID+"\nUser clicked cell with index "+celInd); 
    }
    $(document).ready(function(){
        insertPlugins(scriptArr);
        
        setTimeout(function(){
            doInitGrid();
            mygrid.load("http://localhost/codeIgniter/index.php/qms_struc/admin/output/LN_System/","json");
            myDataProcessor = new dataProcessor("http://localhost/dbEvent/update_all.php"); //lock feed url
            myDataProcessor.setTransactionMode("POST",true); //set mode as send-all-by-post
            myDataProcessor.setUpdateMode("off"); //disable auto-update
            myDataProcessor.init(mygrid); //link dataprocessor to the grid
        }, 10);
    });
</script>