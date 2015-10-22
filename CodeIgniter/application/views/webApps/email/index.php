<!DOCTYPE html>
<html>
    <head>
        <title> Email Notification </title>
        <style type="text/css">
			* {
			    padding: 0;
			    margin: 0;
			    font-size: 100%;
			}
			html {
				background-color: #e2e2e2;
				background-image: none;
			}
			body {
				margin: 0 auto;
				width: 100%;
				height: 100%;
				font-family: 'Verdana','Open Sans Condensed','Arial Narrow', serif;
				font-weight: 400;
				font-size: 12px;
				color: #333;
				-webkit-font-smoothing: antialiased;
			}
        	#arccHead {
			    width: 100%;
			    height: 40px;
			    font-weight: bold;
			    background: #D9D9D9;
			    border-bottom: #C6C6C6 1px solid;
			    position: fixed;
			    z-index: 1000;   		
        	}
			#arccHead span {
			    color: #333;
			    padding: 8px 0 0 15px;
			    height: 40px;
			    line-height: 40px;
			    margin: 0;
			    padding: 0 10px;
			    float: left;
			    font-size: 15px;
			}
			#arccWrapper {
			    width: 100%;
			    height: 100%;
			    min-height: 610px;
			    padding: 0;
			    margin: 40px 0 30px 0;
			    display: inline-block;
			}
			#mainNav {
			    width: 100%;
			    text-align: center;
			    background: #e5e3e3;
			    border-bottom: #D9D9D9 1px solid;
			    border-top: #C6C6C6 1px solid;
			    position: fixed;
			    z-index: 1000;
			    height: 5px;
			}
			#arccFooter {
				position:absolute;
				position:fixed;
				bottom:0;
			    width: 100%;
			    height: 30px;
			    background: #D9D9D9;
			    border-top: #C6C6C6 1px solid;
			    text-align: center;
			    z-index: 1000;
			}
			#arccFooter span {
			    height: 30px;
			    line-height: 30px;
			    font-weight: bold;
			}
        </style>
    </head>
    <body>
		<div id="arccHead">
			<span class="app"> Billing and Collection System </span>
		</div>
		<div id="arccWrapper">
			<div id="mainNav"></div>
	    	<p>
	    		Please do not reply to this mail as it is automated and cannot be responded to. 
	    		To send feedback please use the feedback form on our website. 
	    		This email was sent by: Management Group of Al Rushaid Construction Company, Limited.
	    	</p>
	    </div>
        <div id="arccFooter">
            <span>&reg;&trade; Al Rushaid Construction Company, Limited | &copy; All Rights Reserved 2013</span>
        </div>
    </body>
</html>