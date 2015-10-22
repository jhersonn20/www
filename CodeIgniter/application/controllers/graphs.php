<?php
		function __construct(){
			parent::__construct();
		}
			$this->highchart->includeExtraScripts();
			
			$this->highchart->chart->renderTo = 'container';
			$this->highchart->chart->polar = true;
			$this->highchart->chart->type = 'line';
			$this->highchart->title->text = 'Maximum Usage vs. Actual Total Usage';
			$this->highchart->pane->size = '93%';
			$this->highchart->pane->endAngle = 360;
			$this->highchart->xAxis->categories = $cat;
			$this->highchart->xAxis->tickmarkPlacement = 'on';
			$this->highchart->xAxis->lineWidth = 0;
			$this->highchart->yAxis->gridLineInterpolation = 'polygon';
			$this->highchart->yAxis->lineWidth = 0;
			$this->highchart->yAxis->min = 0;
			$this->highchart->tooltip->shared = true;
			$this->highchart->tooltip->pointFormat = '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f} copies</b><br/>';
			$this->highchart->legend->align = 'left';
			$this->highchart->legend->verticalAlign = 'top';
			$this->highchart->legend->y = 40;
			$this->highchart->legend->layout = 'vertical';
			$this->highchart->series = $series;
			$data['jsFiles'] = $this->highchart->printScripts();
			$data['chart1'] = $this->highchart->render("chart1");
			$this->load->view('graphs', $data);
		}
	}
?>