function insertPlugins(scriptArr){
    var headtg = document.getElementsByTagName('head')[0];
    if (!headtg)
        return;
    $.each(scriptArr, function(index, value){
        var linktg = document.createElement((value.indexOf("css") != -1) ? 'link' : 'script');
        if (value.indexOf("css") != -1){
            linktg.type = 'text/css';
            linktg.rel = 'stylesheet';
            linktg.href = '/assets/css/' + value;
        }else {
            linktg.type = 'text/javascript';
            linktg.src = '/assets/js/' + value;
        }
        headtg.appendChild(linktg);				
    });		
}
function showNotif(title,message,type){
	if ($(".ui-pnotify").is(":visible"))
		if (stripTags($(".ui-pnotify-text").html()) == stripTags(message))
			return true;
			
	$.pnotify({
		title: title,
		text: message,
		type: type,
		icon: true,
		styling: 'jqueryui',
		history: false,
		closer: false,
		sticker: false,
		nonblock: true
	});
	// alert($(".k-window").css("z-index"));
	// if ($(".k-window").is(":visible"))
		// $("#pnotify").css({"z-index": ($(".k-window").css("z-index") + 5)});
}
function removejscssfile(filename, filetype){
    var targetelement=(filetype=="js")? "script" : (filetype=="css")? "link" : "none" //determine element type to create nodelist from
    var targetattr=(filetype=="js")? "src" : (filetype=="css")? "href" : "none" //determine corresponding attribute to test for
    var allsuspects=document.getElementsByTagName(targetelement)
    for (var i=allsuspects.length; i>=0; i--){ //search backwards within nodelist for matching elements to remove
        if (allsuspects[i] && allsuspects[i].getAttribute(targetattr)!=null && allsuspects[i].getAttribute(targetattr).indexOf(filename)!=-1)
            allsuspects[i].parentNode.removeChild(allsuspects[i]) //remove element by calling parentNode.removeChild()
    }
}
function constructNav(navDiv, objName){
    var divArr = [];
    $.each($("#hidDiv ul"), function(index, value){
        if ($.inArray(this.id, divArr) == -1){
            divArr.push(this.id);
            
            if (this.id == objName)
                $(navDiv).append(this);
            else{
                $(navDiv).find("li#" + this.id).append(this);
                if (objName == "jMenu"){
                    if ($(navDiv).find("li#" + this.id).children("span").length)
                        $(navDiv).find("li#" + this.id).find("span").eq(0).addClass("isParent");
                    else
                        $(navDiv).find("li#" + this.id).find("a").eq(0).addClass("isParent");
                }
            }
        }else {
            if (objName == "jMenu")
                $(navDiv).find("ul#" + this.id).append(((this.id == objName || $(this).find("li").length == 1) ? $(this).find("li") : $(this).find("li").eq(1)));
            else
                $(navDiv).find("ul#" + this.id).append($(this).find("li"));
        }
    });
}
function deleteNav(currObj){
    selectedLI = $(currObj).parent().parent().parent();
    parentUL = selectedLI.parent();
    childUL = 0;
    if ($(selectedLI).children("ul").length > 0)
        childUL = $(selectedLI).children("ul").eq(0).children("li");
        
    if (childUL.length > 0){
        $.each(childUL, function(index, value){
            $(this).find("div").eq(0).addClass("ui-droppable");
            $(this).find("dl").eq(0).addClass("ui-droppable");
        });
        $(parentUL).append(childUL);
    }
    
    $(selectedLI).remove();
    childUL = 0;    
}
function editNav(currObj){
    selectedLI = $(currObj).parent().parent();
    $(selectedLI).children("#menuDtls").transition({width: 'auto', height: 'auto', easing: 'snap', duration: '2000'}).css({display: (($(selectedLI).children("#menuDtls").is(":visible")) ? "none" : "block")});
    if ($(selectedLI).children("#menuDtls").is(":visible"))
        $(selectedLI).children("#menuDtls").find("input").focus().select();
}
function pubNav(currObj){
    selectedLI = $(currObj).parent().parent().parent();
    parentUL = selectedLI.parent();
    $.each($(selectedLI).find("." + currObj.className), function(index, value){        
        $(this).css({display: "none"});
        $(this).parent().children(((this.className == "sm2_pub") ? ".sm2_workFlow" : ".sm2_pub")).css({display: "block"});    
    });
    
    if (currObj.className == "sm2_workFlow"){
        for (i=0;i<20;i++){
            if (!$(parentUL).parent().children("dl").children("dd").children(".sm2_workFlow").length)
                break;
            
            $(parentUL).parent().find(".sm2_workFlow").eq(0).css({display: "none"});
            $(parentUL).parent().find(".sm2_pub").eq(0).css({display: "block"});
            parentUL = parentUL.parent().parent();
        }
    }
}
function notif(err){
    $(".notif").css({display: "block", margin: "0 5px 5px 0", padding: "3px"}).html(err);
    setTimeout(function(){
        $(".notif").hide("slow");
    }, 5000);
}
		
function JSON2CSV(objArray) {
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;

    var str = '';
    var line = '';

    //if ($("#labels").is(':checked')) {
        var head = array[0];
        //if ($("#quote").is(':checked')) {
            for (var index in array[0]) {
                var value = index + "";
                line += '"' + value.replace(/"/g, '""') + '",';
            }
        /*} else {
            for (var index in array[0]) {
                line += index + ',';
            }
        }*/

        line = line.slice(0, -1);
        str += line + '\r\n';
    //}

    for (var i = 0; i < array.length; i++) {
        var line = '';

        //if ($("#quote").is(':checked')) {
            for (var index in array[i]) {
                var value = array[i][index] + "";
                line += '"' + value.replace(/"/g, '""') + '",';
            }
        /*} else {
            for (var index in array[i]) {
                line += array[i][index] + ',';
            }
        }*/

        line = line.slice(0, -1);
        str += line + '\r\n';
    }
    return str;
}

function to_pdf(title, pdfName){
	$("#window").data("kendoWindow").setOptions({
	    title: title,
	    width: "900px",
	    height: "600px"
	});
	$("#window").data("kendoWindow").refresh({
	    url: "http://" + hostname + "/assets/pdf/" + pdfName + ".pdf",
	    contentType: "application/pdf"
	});
	$("#window").data("kendoWindow").center().open();
}

function get_cookies_array() {	 
    var cookies = {};
 
    if (document.cookie && document.cookie != '') {
        var split = document.cookie.split(';');
        for (var i = 0; i < split.length; i++) {
            var name_value = split[i].split("=");
            name_value[0] = name_value[0].replace(/^ /, '');
            cookies[decodeURIComponent(name_value[0])] = decodeURIComponent(name_value[1]);
        }
    }
 
    return cookies;
}

function check_browser(){
		var browserVersion = $.browser.version.split(".");
		if ($.browser.safari && browserVersion[0] >= 536){
		}else if ($.browser.firefox && browserVersion[0] >= 11){
		}else if ($.browser.chrome && browserVersion[0] >= 22){
		}else if ($.browser.msie && browserVersion[0] >= 9){
		}else {
			var notifTitle = ""
				notifText = "",
				notifType = "";
			//if ($.browser.msie && browserVersion[0] == 9){
			//	notifTitle = 'Warning';
			//	notifText = '<ul id="pUL"><li>Effects and animations might vary.</li></ul>';
			//	notifType = 'warning';
			//}else {
				notifTitle = 'Best viewed with...';
				notifText = '<ul id="pUL"><li><img src="/assets/images/browser/chrome.png" /><span>Google Chrome 20.0++</span></li><li><img src="/assets/images/browser/firefox.png" /> Firefox 11.0++</li><li><img src="/assets/images/browser/ie.png" /> Internet Explorer 9.0 </li></ul>';
				notifType = 'info';
			//}
			$.pnotify({
				title: notifTitle,
				text: notifText,
				type: notifType,
				before_close: function(pnotify){
					return false;
				},
				styling: "jqueryui",
				history: false,
				width: '230',
				nonblock: true
			});
		}
}
function var_dump(obj, level) {
    var dump = "(<i>" + (typeof obj) + "</i>) : ";
    var level_nbsp = "";
    if(typeof level == "undefined"){var level = 1;}
    for(i = 0; i < 5*level; i++){level_nbsp += "&nbsp;";}
    switch(typeof obj){
      case "string":
        dump += obj + "<br/>\n";
        break;
      case "boolean":
        dump += (obj?"true":"false") + "<br/>\n";
        break;
      case "number":
      case "function":
        dump += obj.toString() + "<br/>\n";
        break;
      default:
        dump += "<br>\n";
        for(var key in obj){dump += level_nbsp +"<b>" + key + "</b> " + var_dump(obj[key], level + 1);}
        break;
    }
    if(level == 1){
      var dump_area = document.createElement('dump_area');
      dump_area.innerHTML = dump;
      document.body.appendChild(dump_area);
    }
    else{return dump;}
  }

function var_dump3 () {
  // http://kevin.vanzonneveld.net
  // +   original by: Brett Zamir (http://brett-zamir.me)
  // +   improved by: Zahlii
  // +   improved by: Brett Zamir (http://brett-zamir.me)
  // -    depends on: echo
  // %        note 1: For returning a string, use var_export() with the second argument set to true
  // *     example 1: var_dump(1);
  // *     returns 1: 'int(1)'

  var output = '',
    pad_char = ' ',
    pad_val = 4,
    lgth = 0,
    i = 0,
    d = this.window.document;
  var _getFuncName = function (fn) {
    var name = (/\W*function\s+([\w\$]+)\s*\(/).exec(fn);
    if (!name) {
      return '(Anonymous)';
    }
    return name[1];
  };

  var _repeat_char = function (len, pad_char) {
    var str = '';
    for (var i = 0; i < len; i++) {
      str += pad_char;
    }
    return str;
  };
  var _getInnerVal = function (val, thick_pad) {
    var ret = '';
    if (val === null) {
      ret = 'NULL';
    } else if (typeof val === 'boolean') {
      ret = 'bool(' + val + ')';
    } else if (typeof val === 'string') {
      ret = 'string(' + val.length + ') "' + val + '"';
    } else if (typeof val === 'number') {
      if (parseFloat(val) == parseInt(val, 10)) {
        ret = 'int(' + val + ')';
      } else {
        ret = 'float(' + val + ')';
      }
    }
    // The remaining are not PHP behavior because these values only exist in this exact form in JavaScript
    else if (typeof val === 'undefined') {
      ret = 'undefined';
    } else if (typeof val === 'function') {
      var funcLines = val.toString().split('\n');
      ret = '';
      for (var i = 0, fll = funcLines.length; i < fll; i++) {
        ret += (i !== 0 ? '\n' + thick_pad : '') + funcLines[i];
      }
    } else if (val instanceof Date) {
      ret = 'Date(' + val + ')';
    } else if (val instanceof RegExp) {
      ret = 'RegExp(' + val + ')';
    } else if (val.nodeName) { // Different than PHP's DOMElement
      switch (val.nodeType) {
      case 1:
        if (typeof val.namespaceURI === 'undefined' || val.namespaceURI === 'http://www.w3.org/1999/xhtml') { // Undefined namespace could be plain XML, but namespaceURI not widely supported
          ret = 'HTMLElement("' + val.nodeName + '")';
        } else {
          ret = 'XML Element("' + val.nodeName + '")';
        }
        break;
      case 2:
        ret = 'ATTRIBUTE_NODE(' + val.nodeName + ')';
        break;
      case 3:
        ret = 'TEXT_NODE(' + val.nodeValue + ')';
        break;
      case 4:
        ret = 'CDATA_SECTION_NODE(' + val.nodeValue + ')';
        break;
      case 5:
        ret = 'ENTITY_REFERENCE_NODE';
        break;
      case 6:
        ret = 'ENTITY_NODE';
        break;
      case 7:
        ret = 'PROCESSING_INSTRUCTION_NODE(' + val.nodeName + ':' + val.nodeValue + ')';
        break;
      case 8:
        ret = 'COMMENT_NODE(' + val.nodeValue + ')';
        break;
      case 9:
        ret = 'DOCUMENT_NODE';
        break;
      case 10:
        ret = 'DOCUMENT_TYPE_NODE';
        break;
      case 11:
        ret = 'DOCUMENT_FRAGMENT_NODE';
        break;
      case 12:
        ret = 'NOTATION_NODE';
        break;
      }
    }
    return ret;
  };

  var _formatArray = function (obj, cur_depth, pad_val, pad_char) {
    var someProp = '';
    if (cur_depth > 0) {
      cur_depth++;
    }

    var base_pad = _repeat_char(pad_val * (cur_depth - 1), pad_char);
    var thick_pad = _repeat_char(pad_val * (cur_depth + 1), pad_char);
    var str = '';
    var val = '';

    if (typeof obj === 'object' && obj !== null) {
      if (obj.constructor && _getFuncName(obj.constructor) === 'PHPJS_Resource') {
        return obj.var_dump();
      }
      lgth = 0;
      for (someProp in obj) {
        lgth++;
      }
      str += 'array(' + lgth + ') {\n';
      for (var key in obj) {
        var objVal = obj[key];
        if (typeof objVal === 'object' && objVal !== null && !(objVal instanceof Date) && !(objVal instanceof RegExp) && !objVal.nodeName) {
          str += thick_pad + '[' + key + '] =>\n' + thick_pad + _formatArray(objVal, cur_depth + 1, pad_val, pad_char);
        } else {
          val = _getInnerVal(objVal, thick_pad);
          str += thick_pad + '[' + key + '] =>\n' + thick_pad + val + '\n';
        }
      }
      str += base_pad + '}\n';
    } else {
      str = _getInnerVal(obj, thick_pad);
    }
    return str;
  };

  output = _formatArray(arguments[0], 0, pad_val, pad_char);
  for (i = 1; i < arguments.length; i++) {
    output += '\n' + _formatArray(arguments[i], 0, pad_val, pad_char);
  }

  if (d.body) {
    this.echo(output);
  } else {
    try {
      d = XULDocument; // We're in XUL, so appending as plain text won't work
      this.echo('<pre xmlns="http://www.w3.org/1999/xhtml" style="white-space:pre;">' + output + '</pre>');
    } catch (e) {
      this.echo(output); // Outputting as plain text may work in some plain XML
    }
  }
}


function var_dump2(v) {
    switch (typeof v) {
        case "object":
            for (var i in v) {
                console.log(i+":"+v[i]);
            }
            break;
        default: //number, string, boolean, null, undefined 
            console.log(typeof v+":"+v);
            break;
    }
}

function open_preloader(){
	//var newDiv = $("<div id = 'preload'>").appendTo($("body"));
	$("#preload").kendoWindow({
	    title: "Please wait...",
	    width: "500px",
	    height: "90px",
        close: function(e){
        	if (!closeDialog)
        		e.preventDefault();
        	else
        		closeDialog = false;
        },
        actions: [],
        modal: true,
        visible: false,
        resizable: false,
        scrollable: false,
		content: crudServiceBaseUrl + "templateLoader/index/tmpl_preload",
		type: "POST",
		data: {}
	});
    $("#preload").data("kendoWindow").center().open();	
}
function close_preloader(){
	closeDialog = true;	
	$("#preload").data("kendoWindow").close();
	//$("#preload").remove();
}
function insertGridTitle(id,title){
	$(id).prepend("<div class='k-header gridTitle'>" + title + "</div>");
}
function replaceWith($str ,$replaceWhat, $replaceWith){
	return $str.replace($replaceWhat, $replaceWith);
}
function set_skip_field(skip_this){
	skip_this_field = skip_this;
}
function verifyThisInput(parent){
	var isFailed = false;
	$.each($(parent + " input[required], " + parent + " textarea[required], " + parent + " select[required]"), function(index,value){
		if ($.trim(this.value) == "" && $.inArray(this.id, skip_this_field) < 0){
			$(parent + (" #" + this.id)).addClass("thisIsRequired").select().focus();
			
			if ($(this).parent().hasClass("k-widget"))
				$(this).parent().addClass("thisIsRequired");
			else if ($(this).parent().parent().hasClass("k-widget"))
				$(this).parent().parent().addClass("thisIsRequired");
				
			if (!$(".ui-pnotify").is(":visible"))
				showNotif('Warning','Required fields need to be filled-out first!','warning');
			isFailed = true;
			return false;
		}
	});
	
	return isFailed;
}
function strpos (haystack, needle, offset) {
    var i = (haystack+'').indexOf(needle, (offset || 0));
    return i === -1 ? false : i;
}
function isset(target){	
}
function search(source, name) {
    
    var results = [];
    var index;
    var entry;

    name = name.toUpperCase();
    for (index = 0; index < source.length; ++index) {
        entry = source[index];
        if (entry && entry.name && entry.name.toUpperCase().indexOf(name) !== -1) {
            results.push(entry);
        }
    }

    return results;
}
function insertArrayAt(array, index, arrayToInsert) {
    Array.prototype.splice.apply(array, [index, 0].concat(arrayToInsert));
    return array;
}        
function total_bytes(obj_tbl,obj_sel,id){
	var totalBytes = 0;
	$.each(obj_sel,function(index,value){
		if (value){
			$.each(obj_tbl,function(index2,value2){
				if (value2.id == index)
					totalBytes += value2.size;
			});
		}        		        			
	});
	// console.log($(id).parent().parent().parent().find("button").eq(1));
	if (totalBytes >= 10)
		$(id).parent().parent().parent().find("button").eq(1).addClass("k-state-disabled").prop("disabled", true);
	else
		$(id).parent().parent().parent().find("button").eq(1).removeClass("k-state-disabled").prop("disabled", false);
	$(id).data("kendoNumericTextBox").value(parseFloat(totalBytes).toFixed(2));
}
