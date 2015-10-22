<div id="application">
	<!--<div class="system-proper">
		<img src="/assets/images/webapps/systemIcon.png">
		<p>Manpower</p>
		<p>This is a sample description of the above subject.</p>
	</div>
	<ul>
		<li><button type="button" name="persis" <?php echo ((!$is_logged_in) ? "disabled" : ""); ?> id="persis">Manpower Persis</button></li>
		<li><button type="button" name="payroll" <?php echo ((!$is_logged_in) ? "disabled" : ""); ?> id="payroll">Payroll System</button></li>
		<li><button type="button" name="abc" <?php echo ((!$is_logged_in) ? "disabled" : ""); ?> id="abc">Activity Based Costing</button></li>
		<li><button type="button" name="edtr" <?php echo ((!$is_logged_in) ? "disabled" : ""); ?> id="edtr">Equipment Daily Time Report</button></li>
		<li><button type="button" name="ap" <?php echo ((!$is_logged_in) ? "disabled" : ""); ?> id="ap">Accounts Payable</button></li>
		<li><button type="button" name="tms" <?php echo ((!$is_logged_in) ? "disabled" : ""); ?> id="tms">Tools Monitoring System</button></li>
		<li><button type="button" name="cems" <?php echo ((!$is_logged_in) ? "disabled" : ""); ?> id="cems">Central Equipment Management System</button></li>
		<li><button type="button" name="itms" <?php echo ((!$is_logged_in) ? "disabled" : ""); ?> id="itms">IT Management System</button></li>
	</ul>
	<ul>
		<li><button type="button" name="hsep" <?php echo ((!$is_logged_in) ? "disabled" : ""); ?> id="hsep">HSE Performance / Highlights & News</button></li>
		<li><button type="button" name="hsem" <?php echo ((!$is_logged_in) ? "disabled" : ""); ?> id="hsem">HSE Management System Procedures, Training & Incidents</button></li>
		<li><button type="button" name="hsec" <?php echo ((!$is_logged_in) ? "disabled" : ""); ?> id="hsec">HSE CAIR</button></li>
		<li><button type="button" name="ogmr" <?php echo ((!$is_logged_in) ? "disabled" : ""); ?> id="ogmr">OGMR</button></li>
		<li><button type="button" name="scaff" <?php echo ((!$is_logged_in) ? "disabled" : ""); ?> id="scaff">Scaffolding</button></li>
		<li><button type="button" name="formworks" <?php echo ((!$is_logged_in) ? "disabled" : ""); ?> id="formworks">Form Works</button></li>
		<li><button type="button" name="sysadmin" <?php echo ((!$is_logged_in) ? "disabled" : ""); ?> id="sysadmin">System Administrator</button></li>
	</ul>-->
    <div id="tabstrip" class="login">
        <!-- <ul>
            <li class="k-state-active login">
            	Support
            </li>
            <li class="login">
            	Construction
            </li>
        </ul>
        <div class="login">
			<div class="wrap-system">
				<?php
					if (isset($rowArrayRights)){
						foreach ($rowArrayRights as $arr):
							if ($arr['type'] == "Support"){
								echo "<div class='system-proper'>";
								echo "<a href='#' id='" . $arr['appl_code'] . "'><img src='/assets/images/webapps/" . $arr['appl_code'] . "Icon.png'></a>";
								echo "<a href='#' id='" . $arr['appl_code'] . "'>" . $arr['appl_name_short'] . "</a>";
								echo "<p>This is a sample description of the above subject.</p>";
								echo "</div>";
							}
						endforeach;
					} 
				?>
			</div>
		</div>
        <div class="login">
			<div class="wrap-system">
				<?php					
					if (isset($rowArrayRights)){
						foreach ($rowArrayRights as $arr):
							if ($arr['type'] == "Const"){
								echo "<div class='system-proper'>";
								echo "<a href='#' id='" . $arr['appl_code'] . "'><img src='/assets/images/webapps/" . $arr['appl_code'] . "Icon.png'></a>";
								echo "<a href='#' id='" . $arr['appl_code'] . "'>" . $arr['appl_name_short'] . "</a>";
								echo "<p>This is a sample description of the above subject.</p>";
								echo "</div>";
							}
						endforeach;
					}					 
				?>
			</div>
		</div> -->
		<?php
		
			if (isset($rowArrayRights)){
				if (sizeof($rowArrayRights) == 1){
					header("Location: " . $_SERVER['HTTP_POST'] . "/codeIgniter/index.php/webapps/index/directTo/" . $rowArrayRights[0]['appl_code']);
					exit;
				}
			
				$i = 0;
				$i2 = 0;
				$type = array();
				
				echo "<ul>";
				foreach ($rowArrayRights as $arr):
					if (!in_array($arr['type'], $type)){
						array_push($type, $arr['type']);
			            echo "<li class='" . ($i2 == 0 ? "k-state-active" : "") . " login'>";
			            echo ($arr['type'] == "Support") ? $arr['type'] : "Construction";
			            echo "</li>";
						$i2++;
					}
				endforeach;
	        	echo "</ul>"; 
				
				do {
			        echo "<div class='login'>";
					echo "	<div class='wrap-system'>";
								foreach ($rowArrayRights as $arr):
									if ($arr['type'] == (($i == 0) ? "Support" : "Const")){
										echo "<div class='system-proper'>";
										echo "<a href='#' id='" . $arr['appl_code'] . "'><img src='/assets/images/webapps/" . $arr['appl_code'] . "Icon.png'></a>";
										echo "<a href='#' id='" . $arr['appl_code'] . "'>" . $arr['appl_name_short'] . "</a>";
										echo "<p>This is a sample description of the above subject.</p>";
										echo "</div>";
									}
								endforeach;
					echo "  </div>";
					echo "</div>";
					
					$i++;
				} while($i < $i2);
			}				 
		?>
	</div>
</div>