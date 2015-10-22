<input type="hidden" name="title" id="title" value="<?php echo (isset($_POST['title']) ? $title : ""); ?>" />
<input type="hidden" name="pdfName" id="pdfName" value="<?php echo (isset($_POST['pdfName']) ? $pdfName : ""); ?>" />
<script>
	$(document).ready(function(){
		$("#window").data("kendoWindow").setOptions({
		    title: $("#title").val(),
		    width: "900px",
		    height: "600px"
		});
		$("#window").data("kendoWindow").refresh({
		    url: "/assets/pdf/" + $("#pdfName").val() + ".pdf",
		    contentType: "application/pdf"
		});
		$("#window").data("kendoWindow").center().open();
	});
</script>