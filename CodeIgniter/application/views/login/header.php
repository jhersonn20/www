<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <base href="<?=base_url();?>">
        <title> <?php echo $title; ?> </title>
        <script type="text/javascript" src="/assets/js/jQuery1.7.js"></script>
		<style type="text/css">
			label {
				display: block;
			}
			fieldset {
				width: 160px;
			}
			a, input[type='submit'] {
				text-decoration: none;
				padding: 1px 5px;
				border: 1px solid #707070;
				border-radius: 3px;
				color: #000;
				background: #D4D4D4;
				font-family: inherit;
				font-size: 11.6pt;
				height: 21px;
				cursor: default;
			}
			a:hover, input[type='submit']:hover {
				border: 1px solid #3c7fb1;
				background: #afdef8;
			}
		</style>
    </head>
    <body>
		<div class="customErrors">
			<?php echo (isset($error)) ? $error : ""; ?>
		</div>