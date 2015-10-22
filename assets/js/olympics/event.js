var totalRec,
	currRank,
	loadComp = false,
	tabularType = 1;
var timer,
	rankVar = 0,
	paused_sec;
var lastsel,
	divArr = ["#leftNav", "#rightNav"],
	classArr = [["firstChild", "secondChild", "thirdChild", "fourthChild"], ["fourthChild", "thirdChild", "secondChild", "firstChild"]],
	insertCounter = 0;

function timerFunc(elapsed_seconds){
	timer = setInterval(function() {
		elapsed_seconds = elapsed_seconds + 1;
		paused_sec = elapsed_seconds;
		timeResult = get_elapsed_time_string(elapsed_seconds);
		$(".hours").html(timeResult.hours);
		$(".colon").html(":");
		$(".minutes").html(timeResult.minutes);
		$(".colon1").html(":");
		$(".seconds").html(timeResult.seconds);
		$(".colon2").html(":");
		$(".minSeconds").html(timeResult.minseconds);
	}, 100);
}
function controlFunc(control){
	$("#play").removeClass().addClass("play" + ((control == "play" || control == "restart" || control == "complete") ? "_disabled" : ""));
	$("#pause").removeClass().addClass("pause" + ((control == "pause" || control == "init" || control == "complete") ? "_disabled" : ""));
	$("#restart").removeClass().addClass("restart" + ((control == "init" || control == "complete") ? "_disabled" : ""));
}
function saveTimer(rowID, currObj){
	if (currObj.className == "currDivTeam")
		return true;
	if ($.trim($(".minSeconds").html()) == "00" && $.trim($(".seconds").html()) == "00" && $.trim($(".minutes").html()) == "00" && $.trim($(".hours").html()) == "00"){
		if ($("#skillsSel").val() == "0"){
			highlight(".selectDiv", 0);
			return true;
		}
		highlight("#timer", 0);
		return true;
	}
	currRank = rankFunc();
	$("#groupGrid").jqGrid('setRowData',
							rowID,
							{'group-code': $.trim($(".hours").html() + " : " + $(".minutes").html() + " : " + $(".seconds").html() + " : " + $(".minSeconds").html()),
							 'rank': currRank});
	$("#groupGrid").jqGrid('setGridParam',{sortname:"rank",sortorder:"asc"}).trigger("reloadGrid");
	if (totalRec == currRank){
		clearInterval(timer);
		controlFunc("complete");
		highlight("#grid", 1);
	}
	
	$(currObj).removeClass().addClass("currDivTeam");
}
function rankFunc(){
	return parseInt(rankVar += 1);
}
$(document).ready(function(){			
	controlFunc("init");
	
	$("#groupGrid").empty().jqGrid({
		datatype: "json",
		url: "/assets/json/teams.json",
		colNames:['Team', 'Time', 'Rank'],
		colModel:[
			{name:'group', index:'group', width:40, editable: true, editoptions:{size:25}, formoptions:{ rowpos:1, label: "Team: ", elmprefix:"(*)"},editrules:{required:true}},
			{name:'group-code',index:'group-code', width:20, align:"center"},
			{name:'rank',index:'rank asc', width:20, align:"center"}
		],
		rowNum:10,
		rowList:[10,20,30],
		jsonReader: {
			repeatitems: false
		},
		pager: '#nav_groupGrid',
		sortname: 'rank',
		viewrecords: false,
		sortorder: "asc",
		caption:"Tabulation",
		width: 350,
		height: "100%",
		editurl:"teams.php",
		loadonce: true,
		afterInsertRow: function(){
			insertCounter += 1;
			if (insertCounter <= 7 || loadComp || $.trim($('.minSeconds').html()) != "00" && $.trim($(".seconds").html()) != "00" && $.trim($(".minutes").html()) != "00" && $.trim($(".hours").html()) != "00")
				return true;
			
			var ids = $(this).jqGrid('getDataIDs');						
			totalRec = ids.length;
			$.each(divArr, function(index, value){
				$(this).empty();
			});
			for(var i=0;i<totalRec;i++){
				retVal = $(this).jqGrid('getRowData',ids[i]);
				$(divArr[(i < Math.ceil(totalRec / 2)) ? 0 : 1]).append("<div onclick='saveTimer(\"" + ids[i] + "\",this);' class='" + classArr[(i > 3) ? 1 : 0][(i > 3) ? (i - 4) : i] + "'>" + retVal.group + "</div>");
			}
			loadComp = true;
		}
	});
	$("#groupGrid").jqGrid('navGrid','#nav_groupGrid',{edit:false,add:false,del:false});
	// setup grid print capability. Add print button to navigation bar and bind to click.
	setPrintGrid('groupGrid','nav_groupGrid','Game Results');
	
	$("#skillsSel").change(function(){
		highlight(".selectDiv", ((this.value != 0) ? 1 : this.value));
	});
	
	$(".controller span").bind({
		click: function(){
			if (this.className.indexOf("_") != -1)
				return true;
			var timeResult = "";
			switch(this.id){
				case "play":
					if ($("#skillsSel").val() == "0"){
						highlight(".selectDiv", 0);
						return true;
					}
					if ($("#groupGrid").jqGrid('getDataIDs').length <= 0){
						highlight("#grid", 0);
						return true;
					}
					highlight("#timer", 1);
					
					if ($.trim($('.minSeconds').html()) == "00" && $.trim($(".seconds").html()) == "00" && $.trim($(".minutes").html()) == "00" && $.trim($(".hours").html()) == "00")
						timerFunc(0);
					else
						timerFunc(paused_sec);
					break;
				case "pause":
					clearInterval(timer);
					break;
				case "restart":
					clearInterval(timer);
					$.each('.counter div', function(index, value){
						$(this).empty();
					});
					timerFunc(0);
					break;
				default:
					alert("default");
					break;
			}
			controlFunc(this.id);
		}
	});
});