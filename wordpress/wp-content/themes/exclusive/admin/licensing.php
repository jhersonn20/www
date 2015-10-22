<?php 

/// licensing 

class expert_licensing_page_class{

	public function web_dorado_licensing_admin_scripts(){
	
		wp_enqueue_style('web_dorado_licensing_admin_scripts',get_template_directory_uri().'/admin/css/licensing.css');	
	}

	
function dorado_theme_admin_licensing(){
global $exclusive_web_dor;
?>

<div id="main_licensing_page" style="width: 95%;margin: 0 auto;"> 
<p>
<?php echo __("This theme is the non-commercial version of the Web-Business theme. You will be able to use it free of charge. It comes with a large number of features. Some of the advanced features are not available for this option. If you want to use those features, you are required to purchase a license.","wd_exclusive"); ?></p>
<table class="data-bordered" style="width:543px;color: #555;text-align:center;margin: 10px 24px;">
<thead>
<tr> <th scope="col" class="top first" nowrap="nowrap"><?php echo __("Features of the Theme","wd_exclusive"); ?></th>
<th scope="col" class="top notranslate" nowrap="nowrap"><?php echo __("Free","wd_exclusive"); ?></th>
<th scope="col" class="top notranslate" nowrap="nowrap"><?php echo __("Pro Version","wd_exclusive"); ?></th>
</tr>
</thead>
<tbody>
<tr class="">
<td><?php echo __("WordPress 3.4+ ready +","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
</tr>
<tr class="alt">
<td><?php echo __("SEO-friendly","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
</tr>
<tr class="">
<td><?php echo __("Custom favicon and logo","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
</tr>
<tr class="alt">
<td><?php echo __("Possibility to add custom CSS","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
</tr>
<tr class="">
<td><?php echo __("Featured animated slider","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
</tr>
<tr class="alt">
<td><?php echo __("30 pre-installed fonts","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
</tr>
<tr class="">
<td><?php echo __("Widgets for AdSense, Advertisements and Random posts","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
</tr>
<tr class="alt">
<td><?php echo __("Child theme support","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
</tr>
<tr class="">
<td><?php echo __("6 built in customizable layouts","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
</tr>
<tr class="alt">
<td><?php echo __("Social sharing integration","wd_exclusive"); ?></td>
<td class="icon-replace no"><?php echo __("no","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
</tr>
<tr class="">
<td><?php echo __("Possibility to add custom codes","wd_exclusive"); ?></td>
<td class="icon-replace no"><?php echo __("no","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
</tr>
<tr class="alt">
<td><?php echo __("Full SEO management","wd_exclusive"); ?></td>
<td class="icon-replace no"><?php echo __("no","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
</tr>
<tr class="">
<td><?php echo __("Color customization possibility","wd_exclusive"); ?></td>
<td class="icon-replace no"><?php echo __("no","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
</tr>
<tr class="alt">
<td><?php echo __("10 different page templates","wd_exclusive"); ?></td>
<td class="icon-replace no"><?php echo __("no","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
</tr>
<tr class="">
<td><?php echo __("Built-in shortcodes for Editor","wd_exclusive"); ?></td>
<td class="icon-replace no"><?php echo __("no","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
</tr>

<tr class="alt">
<td><?php echo __("Support upon request in 24 hours","wd_exclusive"); ?></td>
<td class="icon-replace no"><?php echo __("no","wd_exclusive"); ?></td>
<td class="icon-replace yes"><?php echo __("yes","wd_exclusive"); ?></td>
</tr>

<tr class="">
<td><?php echo __("Buy using PayPal or Credit Card","wd_exclusive"); ?></td>
<td class="price" style="text-align:center; color:#FF7721; text-shadow: 1px 1px #aaa; font-size:20px;"><?php echo __("Free","wd_exclusive"); ?></td>
<td>
<div class="buy_theme" style="float:left;"><a href="<?php echo $exclusive_web_dor.'/wordpress-themes/exclusive.html'; ?>" target="_blank"><div></div></a></div>
</td>
</tr>
</tbody>
</table>
	</div >

<?php
}



}


?>