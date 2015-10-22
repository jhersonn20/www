function showDown(evt){
	evt = (evt) ? evt : ((event) ? event : null);
	if (evt){
		if (window.event.keyCode == 8 && (window.event.srcElement.type != "text" && window.event.srcElement.type != "textarea" && window.event.srcElement.type != "password")){
			// When backspace is pressed but not in form element
			//alert("When backspace is pressed but not in form element");
			cancelKey(evt);
		}else if (window.event.keyCode == 116){
			// When F5 is pressed
			//alert("When F5 is pressed")
			cancelKey(evt);
		}else if (window.event.keyCode == 17){
			// When ctrl is pressed
			//alert("When ctrl is pressed");
			cancelKey(evt);
		}else if (window.event.keyCode == 18){
			// When ctrl is pressed
			//alert("When ctrl is pressed");
			cancelKey(evt);
		}
	}
}

function cancelKey(evt){
	//alert("Button you pressed is Disabled");
	if (evt.preventDefault){
		evt.preventDefault();
		return false;
	}else{
		evt.keyCode = 0;
		evt.returnValue = false;
	}
}

function pretty_time_string(num) {
	return ( num < 10 ? "0" : "" ) + num;
}
function get_elapsed_time_string(total_seconds) {	
	var hours = Math.floor(total_seconds / 36000);
	total_seconds = total_seconds % 36000;
	
	var minutes = Math.floor(total_seconds / 600);
	total_seconds = total_seconds % 600;
	
	var seconds = Math.floor(total_seconds / 10);
	total_seconds = total_seconds % 10;
	
	var minseconds = Math.floor(total_seconds);
	
	// Pad the minutes and seconds with leading zeros, if required
	hours = pretty_time_string(hours);
	minutes = pretty_time_string(minutes);
	seconds = pretty_time_string(seconds);
	minseconds = pretty_time_string(minseconds);
	
	// Compose the string for display
	var currentTimeString = hours + ":" + minutes + ":" + seconds + ":" + minseconds;
	
	//return currentTimeString;
	return {
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds,
        'minseconds': minseconds
    };
}

function highlight(obj, cssIdx){
	var cssArr = ["0 0 0 8px #fd8403, 0 1px 1px 8px rgba(255,255,255,0.8)","0 0 0 8px #ddd, 0 1px 1px 8px rgba(255,255,255,0.8)"];
	$(obj).css({"box-shadow": cssArr[cssIdx]});
	if (obj == ".selectDiv" || cssIdx == 0)
		$("#skillsSel").focus().select();
}
function setPrintGrid(gid,pid,pgTitle){
	// print button title.
	var btnTitle = 'Print Grid';
	
	// setup print button in the grid top navigation bar.
	$('#'+gid).jqGrid('navSeparatorAdd','#'+gid+'_toppager_left', {sepclass :'ui-separator'});
	$('#'+gid).jqGrid('navButtonAdd','#'+gid+'_toppager_left', {caption: '',
																title: btnTitle,
																position: 'last',
																buttonicon: 'ui-icon-print',
																onClickButton: function() {
																	PrintGrid();
																}
	});
	
	// setup print button in the grid bottom navigation bar.
	//$('#'+gid).jqGrid('navSeparatorAdd','#'+pid, {sepclass : "ui-separator"});
	$('#'+gid).jqGrid('navButtonAdd','#'+pid, {caption: '',
											   title: btnTitle,
											   position: 'last',
											   buttonicon: 'ui-icon-print',
											   onClickButton: function() {
												if ($.trim($(".minSeconds").html()) == "00" && $.trim($(".seconds").html()) == "00" && $.trim($(".minutes").html()) == "00" && $.trim($(".hours").html()) == "00"){
													if ($("#skillsSel").val() == "0"){
														highlight(".selectDiv", 0);
														return true;
													}
													highlight("#timer", 0);
													return true;
												}
												if(tabularType == 1 && $("#leftNav").find("div[class='currDivTeam']").length < 4 && $("#rightNav").find("div[class='currDivTeam']").length < 4){													
													highlight("#grid", 0);
													return true;
												}
												if(tabularType == 2 && $("#groupGrid").jqGrid('getDataIDs').length <= 0){
													highlight("#groupGrid", 0);
													return true;
												}
												PrintGrid();
											   }
	});
	
	function PrintGrid(){
		// empty the print div container.
		$('#prt-container').empty().html("<span id='categ' style='display: none;'>" + $("#skillsSel").val() + "</span>");
		
		// copy and append grid view to print div container.
		$('#gview_'+gid).clone().appendTo('#prt-container').css({'page-break-after':'auto'});
		
		// remove navigation div.
		$('#prt-container div').remove('.ui-jqgrid-toppager,.ui-jqgrid-titlebar,.ui-jqgrid-pager');
		
		// print the contents of the print container.
		$('#prt-container').printElement({pageTitle:pgTitle,
										  overrideElementCSS:[{ href:'print-grid.css',
															    media:'print'}]
		});
	}
}