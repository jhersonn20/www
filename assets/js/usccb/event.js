function zero(numParam){
	return ((numParam.toString().length < 2) ? ("0" + numParam) : numParam.toString());
}
function postFunc(obj){
	for (i = 0;i < obj.length; i++){
		$.post("http://localhost/codeIgniter/index.php/usccb/usccb/create",{usccb: JSON.stringify({usccb: obj[i]})},
				function(data){
					$("#hidDiv").html(data);
				}
		);
	}
}
function gatherReading(gatherToday){
	var readingDate;
	var usccbArr = [];
	var objName = "";
	var lastSunday = (((new Date()).getDay() != 0) ? Date.parse("last sunday") : new Date());
	var dateToGather = "";
	var selfCounter = 0;
	var contentStr = "";
	var dayLength = 6;
	
	if (gatherToday){
		for(i = 0;i < dayLength;i++){
			var first = "", second = "", psalm = "", gospel = "";
			var newDate = Date.parse("t + " + i + " d");
			if ((new Date()).getDay() == 0) {
				dateToGather = zero(newDate.getMonth() + 1) + zero(newDate.getDate()) + newDate.getFullYear().toString().substr(2);
			}else {
				if (Date.parse((lastSunday.getMonth() + 1) + "/" + (lastSunday.getDate() + i) + "/" + (lastSunday.getFullYear())))
					dateToGather = zero(lastSunday.getMonth() + 1) + zero(lastSunday.getDate() + i) + lastSunday.getFullYear().toString().substr(2);					
				else
					dateToGather = zero(lastSunday.getMonth() + 2) + zero(dayLength - i) + lastSunday.getFullYear().toString().substr(2);
			}
			$.ajax({
			  url: 'http://www.usccb.org/bible/readings/' + dateToGather + '.cfm',
			  type: 'GET',
			  success: function(res) {
				var usccb = [];
				$("h1", res.responseText).each(function (index, value) {
					readingDate = Date.parse($(value).html());
					readingDate = readingDate.getFullYear() + "-" + (readingDate.getMonth() + 1) + "-" + readingDate.getDate();
				});
				$("div[class='CS_Textblock_Text']", res.responseText).each(function(index, value){
					if (index < 2){
						switch(index){
							case 0:
								lectStr = $.trim($(value).children("h3").text().replace(/"/g,"'").replace(/\n/g," "));
								break;
							case 1:
								$("div[class='bibleReadingsWrapper']", value).each(function(subIdx, subVal){
									contentStr = $.trim($(subVal).children(".poetry").text().replace(/"/g,"'").replace(/\n/g," "));
									if ($(subVal).children("h4").text().indexOf("Reading 1") != -1)
										objName = "first";
									else if ($(subVal).children("h4").text().indexOf("Reading 2") != -1)
										objName = "second";
									else if ($(subVal).children("h4").text().indexOf("Gospel") != -1)
										objName = "gospel";
									else if ($(subVal).children("h4").text().indexOf("Responsorial Psalm") != -1){
										objName = "psalm";
										contentStr = $.trim($(subVal).children(".poetry").html().replace(/"/g,"'").replace(/<br>|\n|<p>|<\/p>/g,""));
									}
										
									if (objName != ""){
										eval(objName + " = {" +
											 "date: \"" + readingDate + "\"," +
											 "title: \"" + $.trim($(subVal).children("h4").text().replace(/"/g,"'").replace(/\n/g," ")) + "\"," +
											 "content: \"" + contentStr + "\"" +
											"};")
										objName = "";
									}
								});
								break;
						}
					}
				});
				var reading = {
						date: readingDate,
						lectionary: lectStr,
						dlDate: (new Date()).getFullYear() + "-" + ((new Date()).getMonth() + 1) + "-" + (new Date()).getDate(),
						reqDate: lastSunday.getFullYear() + "-" + (lastSunday.getMonth() + 1) + "-" + lastSunday.getDate()
					};
				
				usccb.push(reading);
				usccb.push(first);
				usccb.push(psalm);
				usccb.push(gospel);
				if ($.trim(second) != "")
					usccb.push(second);							
				
				usccbArr.push(usccb);
				
				if (selfCounter == (dayLength - 1))
					postFunc(usccbArr);
				selfCounter++;
			  }
			});
		}
	}
}
	
$(document).ready(function(){	
	$("ul li").bind({
		click: function(){
			if (this.className == "current")
				return true;
			var localDate = Date.parse($.trim($(this).text()));
			document.location.href = "http://localhost/codeIgniter/index.php/usccb/usccb/read/" + (localDate.getFullYear() + "-" + ((((localDate.getMonth() + 1).toString().length < 2) ? "0" : "") + (localDate.getMonth() + 1)) + "-" + (((localDate.getDate().toString().length < 2) ? "0" : "") + localDate.getDate()));
		}
	});
});