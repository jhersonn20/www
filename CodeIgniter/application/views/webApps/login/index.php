<div id="main-wrapper">
	<?php require_once((!$is_logged_in) ? "_login.php" : "_index.php"); ?>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(".system-proper a").bind({
			click: function(e){
				e.preventDefault();
				window.location.href = "/codeIgniter/index.php/webapps/index/directTo/" + (this.id.toLowerCase() == "sys" ? "admin" : this.id.toLowerCase()); //http://localhost
				/*switch (this.id.toLowerCase()){
					case "sys":
						window.location.href = "http://localhost/codeIgniter/index.php/webapps/admin/";
					break;
					default:
						window.location.href = "http://localhost/codeIgniter/index.php/webapps/pub/index/" + this.id;
					break;
				}*/
			}
		});
	});
</script>