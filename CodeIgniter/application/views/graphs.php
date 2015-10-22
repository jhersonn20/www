<html> 
    <head>
        <title>Spiderweb</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="/kendoui/examples/content/shared/styles/examples-offline.css" type="text/css" rel="stylesheet"></link>
		<link href="/kendoui/styles/kendo.common.min.css" type="text/css" rel="stylesheet"></link>
		<link href="/kendoui/styles/kendo.default.min.css" type="text/css" rel="stylesheet"></link>
		<link href="/assets/css/jquery.pnotify.default.css" type="text/css" rel="stylesheet"></link>
		<link href="/assets/css/jquery.pnotify.default.icons.css" type="text/css" rel="stylesheet"></link>
		<link href="/assets/css/jquery-ui.css" type="text/css" rel="stylesheet"></link>
<!-- 		<script type="text/javascript" src="/kendoui/js/jquery.min19.js"></script> -->
		<script type="text/javascript" src="/kendoui/js/kendo.all.min.js"></script>
        <?php $jsFiles; ?>
        <style type="text/css">
        	body {
        		font-family: "Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
        		font-size: 12px;
        	}
        	.highcharts-title {
        		width: 100%;
        	}
        </style>
			
        <!-- <script type="text/javascript" src="/assets/js/highcharts/jQuery172.js"></script>
        <script type="text/javascript" src="/assets/js/highcharts/highcharts3010.js"></script>
        <script type="text/javascript" src="/assets/js/highcharts/highcharts-more.js"></script> -->
    </head>
    <body>
    	<select name="job_no" id="job_no" style="position: absolute;z-index: 1000;">
    		<?php
    			foreach ($job_no as $key => $value) {
    				echo "<option " . ($curr_job == $value ? "selected" : "") . " value='" . $value . "'>" . $value. "</option>";					
				}
    		?>
    	</select>
        <div id="container" style="height: 100%;width: 90%;"></div> <!-- style="height: <?php echo ($curr_job == "") ? "100%" : "50%" ?>;"-->
        <div id="container3" style="border: 1px solid #dadad6;width: 23%;height: 65px;position: fixed;top: 10px;float: right;right: 10px;border-radius: 4px;moz-border-radius: 4px;-webkit-border-radius: 4px;box-shadow: 0 8px 6px -6px silver;-webkit-box-shadow: 0 8px 6px -6px silver;moz-box-shadow: 0 8px 6px -6px silver;">
        	<span style="position: absolute;width: 100%;padding: 5px 0;color: #274B6D;text-align: center;font-size: 13px;"> Item Details </span>
        	<span style="position: absolute;width: 100%;margin-top: 30px;padding-left: 5px;color: #274B6D;text-align: left;font-size: 12px;"> Job No.: <?php echo  (isset($dtl_job_no) ? $dtl_job_no : ""); ?> </span><br />        	
        	<span style="position: absolute;width: 100%;margin-top: 30px;padding-left: 5px;color: #274B6D;text-align: left;font-size: 12px;"> Fixed Asset: <?php echo (isset($dtl_fix_asset) ? $dtl_fix_asset : ""); ?> </span>        	
        </div>
        <div id="container2" style="border: 1px solid #dadad6;width: 23%;height: 50%;position: fixed;float: right;top: 90px;right: 10px;border-radius: 5px;moz-border-radius: 5px;-webkit-border-radius: 5px;box-shadow: 0 8px 6px -6px silver;-webkit-box-shadow: 0 8px 6px -6px silver;moz-box-shadow: 0 8px 6px -6px silver;"></div>
        <script type="text/javascript">
          function setChart(name, categories, data, color) {
            chart.xAxis[0].setCategories(categories);
            chart.series[0].remove();
            chart.addSeries({
              name: name,
              data: data,
              color: color || 'white'
            });
          }
        	$(document).ready(function(){
				<?php echo $chart1; ?>
        		// $.post("localhost/codeIgniter/index.php/graphs/create_spider",
        			// function(data){
        			// });
        		$("#job_no").change(function(){ 
        			location.href = "/codeIgniter/index.php/graphs/index" + ((this.value == "All") ? "" : ("/" + this.value));
        		});
        		        		
	            $('#container2').highcharts(<?php echo (isset($chart2) ? $chart2 : ""); ?>);
	            // $('#container2').highcharts(<?php //echo $chart2; //$chart->renderOptions(); ?>,
	            // // Add some life
	            // function (chart) {
	                // if (!chart.renderer.forExport) {
	                    // setInterval(function () {
	                        // var point = chart.series[0].points[0],
	                            // newVal,
	                            // inc = Math.round((Math.random() - 0.5) * 20);
// 	
	                        // newVal = point.y + inc;
	                        // if (newVal < 0 || newVal > 200) {
	                            // newVal = point.y - inc;
	                        // }
// 	
	                        // point.update(newVal);
// 	
	                    // }, 3000);
	                // }
	            // });
	                    	            
	          // var colors = Highcharts.getOptions().colors,
	          // categories = ['MSIE', 'Firefox', 'Chrome', 'Safari', 'Opera'],
	          // name = 'Browser brands',
	          // data = [{
	              // y: 55.11,
	              // color: colors[0],
	              // drilldown: {
	                // name: 'MSIE versions',
	                // categories: ['MSIE 6.0', 'MSIE 7.0', 'MSIE 8.0', 'MSIE 9.0'],
	                // data: [10.85, 7.35, 33.06, 2.81],
	                // color: colors[0]
	              // }
	            // }, {
	              // y: 21.63,
	              // color: colors[1],
	              // drilldown: {
	                // name: 'Firefox versions',
	                // categories: ['Firefox 2.0', 'Firefox 3.0', 'Firefox 3.5', 'Firefox 3.6', 'Firefox 4.0'],
	                // data: [0.20, 0.83, 1.58, 13.12, 5.43],
	                // color: colors[1]
	              // }
	            // }, {
	              // y: 11.94,
	              // color: colors[2],
	              // drilldown: {
	                // name: 'Chrome versions',
	                // categories: ['Chrome 5.0', 'Chrome 6.0', 'Chrome 7.0', 'Chrome 8.0', 'Chrome 9.0',
	                  // 'Chrome 10.0', 'Chrome 11.0', 'Chrome 12.0'],
	                // data: [0.12, 0.19, 0.12, 0.36, 0.32, 9.91, 0.50, 0.22],
	                // color: colors[2]
	              // }
	            // }, {
	              // y: 7.15,
	              // color: colors[3],
	              // drilldown: {
	                // name: 'Safari versions',
	                // categories: ['Safari 5.0', 'Safari 4.0', 'Safari Win 5.0', 'Safari 4.1', 'Safari/Maxthon',
	                  // 'Safari 3.1', 'Safari 4.1'],
	                // data: [4.55, 1.42, 0.23, 0.21, 0.20, 0.19, 0.14],
	                // color: colors[3]
	              // }
	            // }, {
	              // y: 2.14,
	              // color: colors[4],
	              // drilldown: {
	                // name: 'Opera versions',
	                // categories: ['Opera 9.x', 'Opera 10.x', 'Opera 11.x'],
	                // data: [ 0.12, 0.37, 1.65],
	                // color: colors[4]
	              // }
	            // }];
				<?php //echo $chart3; ?>	
				
				var fieldName = $("#job_no").removeClass("k-state-disabled").kendoDropDownList({
					enable: true
				}).data("kendoDropDownList");    
        	});
        </script>
    </body>
</html>