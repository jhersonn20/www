<style>
	#win_main-wrapper {
		margin-top: 0;
		padding: 0;
	}
	.buttonLeft {width: 50%;}
</style>
<div id="win_main-wrapper">
	<div class="taClass">
		<label class="title" for="remarks">Remarks:</label><textarea name="remarks" id="remarks"  cols="20" rows="5" style="width: 97%;height: 83px;resize: none;"></textarea>
	</div>    
	<hr style="margin: 3px 0;" />
	<button name="applyButt" id="applyButt" class="k-button" style="float: right;">Apply</button>    
</div>

<script type="text/javascript">
	$(document).ready(function(){        
        $("#applyButt").click(function(){  
		    remarks_txt = $("#remarks").val();
		    $("#window").data("kendoWindow").close();
        });
	});
</script>
