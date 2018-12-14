(function (window, undefined){
	"use strict";
	
	var document = window.document;
	
	function log() {
		if (window.console && window.console.log) {
			for (var x in arguments) {
				if (arguments.hasOwnProperty(x)) {
					window.console.log(arguments[x]);
				}
			}
		}
	}
	
	function DialogBox() {
		if (!(this instanceof DialogBox)) {
			return new DialogBox();
		}
				
		this.init.call(this);
		
		return this;
	}
	
	DialogBox.prototype = {
		
		init: function () {
			var self = this;
			
			if(self.readCookie('pjDialogBox') == null)
			{
				self.appendCss();
				
				setTimeout(function(){self.loadDialog();}, 2000);
			}
			
			var clear_cookie_arr = self.getElementsByClass("pjDbClearCookie", null, "a");
			if(clear_cookie_arr.length > 0)
			{
				self.addEvent(clear_cookie_arr[0], "click", function (e) {
					if (e.preventDefault) {
						e.preventDefault();
					}
					self.eraseCookie('pjDialogBox');
					document.location.reload();
					return false;
				});
			}
		},
		addClass: function (ele, cls) {
			if (!this.hasClass(ele, cls)) {
				ele.className += ele.className.match(/\S/) !== null ? " " + cls : cls;
			}
		},
		removeClass: function (ele, cls) {
			if (this.hasClass(ele, cls)) {
				var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
				ele.className = ele.className.match(/\s/) !== null ? ele.className.replace(reg, '') : "";
			}
		},
		hasClass: function (ele, cls) {
			return ele.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
		},
		getElementsByClass: function (searchClass, node, tag) {
			var classElements = new Array();
			if (node == null) {
				node = document;
			}
			if (tag == null) {
				tag = '*';
			}
			var els = node.getElementsByTagName(tag);
			var elsLen = els.length;
			var pattern = new RegExp("(^|\\s)"+searchClass+"(\\s|$)");
			for (var i = 0, j = 0; i < elsLen; i++) {
				if (pattern.test(els[i].className)) {
					classElements[j] = els[i];
					j++;
				}
			}
			return classElements;
		},
		addEvent: function (obj, type, fn) {
			if (obj.addEventListener) {
				obj.addEventListener(type, fn, false);
			} else if (obj.attachEvent) {
				obj["e" + type + fn] = fn;
				obj[type + fn] = function() { obj["e" + type + fn](window.event); };
				obj.attachEvent("on" + type, obj[type + fn]);
			} else {
				obj["on" + type] = obj["e" + type + fn];
			}
		},
		createCookie: function (name, value, days){
			var expires;
		    if (days) {
		        var date = new Date();
		        date.setTime(date.getTime()+(days*24*60*60*1000));
		        expires = "; expires="+date.toGMTString();
		    } else {
		        expires = "";
		    }
		    document.cookie = name+"="+value+expires+"; path=/";
		},
		readCookie: function (name) {
		    var nameEQ = name + "=";
		    var ca = document.cookie.split(';');
		    for(var i=0;i < ca.length;i++) {
		        var c = ca[i];
		        while (c.charAt(0) === ' ') {
		            c = c.substring(1,c.length);
		        }
		        if (c.indexOf(nameEQ) === 0) {
		            return c.substring(nameEQ.length,c.length);
		        }
		    }
		    return null;
		},
		eraseCookie: function (name) {
			var self = this;
			self.createCookie(name,"",-1);
		},
		appendCss: function()
		{
			var self = this;
			var cssId = 'pjDialogBoxCss';
			if (!document.getElementById(cssId))
			{
			    var head  = document.getElementsByTagName('head')[0];
			    var link  = document.createElement('link');
			    link.id   = cssId;
			    link.rel  = 'stylesheet';
			    link.type = 'text/css';
			    link.href = 'https://fonts.googleapis.com/css?family=Open+Sans';
			    link.media = 'all';
			    head.appendChild(link);
			}
			
			var cssCode = "";
			cssCode += ".pjDbPopup .pjDbPopupBtn,";
			cssCode += ".pjDbPopup .pjDbPopupBtnPrimary:before,";
			cssCode += ".pjDbPopup .pjDbPopupContent { -webkit-transition: all .5s ease-in-out; -moz-transition: all .5s ease-in-out; -ms-transition: all .5s ease-in-out; -o-transition: all .5s ease-in-out; transition: all .5s ease-in-out; }";
			cssCode += ".pjDbPopup * { padding: 0; margin: 0; outline: 0; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }";
			cssCode += ".pjDbPopup a[href^=tel] { color: inherit; }";
			cssCode += ".pjDbPopup a:focus,";
			cssCode += ".pjDbPopup button:focus { outline: unset; outline: none; }";
			cssCode += ".pjDbPopup img { border: 0; vertical-align: middle; }";
			cssCode += ".pjDbPopup ol,";
			cssCode += ".pjDbPopup ul { list-style-position: inside; }";
			cssCode += ".pjDbPopup,";
			cssCode += ".pjDbPopup input,";
			cssCode += ".pjDbPopup select,";
			cssCode += ".pjDbPopup textarea,";
			cssCode += ".pjDbPopup button { font-family: inherit; }";
			cssCode += ".pjDbPopup textarea { overflow: auto; resize: none; }";
			cssCode += '.pjDbPopup input[type="text"],.pjDbPopup input[type="email"],.pjDbPopup input[type="submit"],.pjDbPopup input[type="button"],.pjDbPopup input[type="password"],.pjDbPopup textarea,';
			cssCode += ".pjDbPopup select {-webkit-appearance: none;-webkit-border-radius: 0;}";
			cssCode += ".pjDbPopup button { background: none; }";
			cssCode += ".pjDbPopup table { width: 100%; border-collapse: collapse; border-spacing: 0; }";
			cssCode += ".pjDbPopup a[href^=tel] { color: inherit; }";
			cssCode += ".pjDbPopup { font-family: 'Open Sans', sans-serif; position: fixed; top: 0; left: 0; z-index: 9999; overflow: hidden; width: 0; height: 0; background: rgba(0, 0, 0, .8); }";
			cssCode += ".pjDbPopup.pjDbPopupAutoLoad.pjDbPopupDisabled { display: none !important; }";
			cssCode += ".pjDbPopup .pjDbPopupInner { position: absolute; top: 50%; left: 50%; width: 420px; max-width: 98%; max-height: 98%; -webkit-transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); -o-transform: translate(-50%, -50%); transform: translate(-50%, -50%); }";
			cssCode += ".pjDbPopup .pjDbPopupContent { overflow-y: auto; width: 100%; background: #fff; -webkit-transform: scale(0); -ms-transform: scale(0); -o-transform: scale(0); transform: scale(0); }";
			cssCode += ".pjDbPopupActive .pjDbPopupContent { -webkit-transform: scale(1); -ms-transform: scale(1); -o-transform: scale(1); transform: scale(1); }";
			cssCode += ".pjDbPopup .pjDbPopupActions { position: absolute; top: -20px; right: -20px; width: 44px; height: 44px; background: #fff; font-size: 0; border-radius: 50%; }";
			cssCode += ".pjDbPopup .pjDbPopupBtn { display: inline-block; vertical-align: middle; cursor: pointer; }";
			cssCode += ".pjDbPopup .pjDbPopupBtn:hover,.pjDbPopup .pjDbPopupBtn:focus { text-decoration: none; }";
			cssCode += ".pjDbPopup .pjDbPopupBtnPrimary { position: relative; height: 44px; padding: 0 30px; border: 0; background: #4e4e4e; font-size: 20px; line-height: 44px; color: #fff; font-weight: 400; text-transform: uppercase; -webkit-transform: translateZ(0); transform: translateZ(0); -webkit-backface-visibility: hidden; backface-visibility: hidden; -moz-osx-font-smoothing: grayscale; }";
			cssCode += ".pjDbPopup .pjDbPopupBtnPrimary:before { position: absolute; top: 0; right: 52%; bottom: 0; left: 52%; z-index: -1; border-bottom: 4px solid #000; background: rgba(0, 0, 0, .5); content: ''; }";
			cssCode += ".pjDbPopup .pjDbPopupBtnPrimary:hover:before,.pjDbPopup .pjDbPopupBtnPrimary:focus:before { right: 0; left: 0; }";
			cssCode += ".pjDbPopup .pjDbPopupForm { padding: 15px 20px; }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbPopupFormHead { padding: 5px 0 15px; }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbPopupFormBody { padding: 5px 0; }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbPopupFormHead .pjDbPopupFormTitle { font-size: 24px; line-height: 1.4; color: #000; font-weight: 700; }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbPopupFormRow { padding-bottom: 20px; }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbPopupFormLabel { font-size: 18px; line-height: 1.4; color: #000; font-weight: 400; }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbPopupFormControls { padding-top: 2px; }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbPopupFormField,.pjDbPopup .pjDbPopupForm .pjDbPopupSelectCustom,.pjDbPopup .pjDbPopupForm .pjDbPopupFormTextarea { width: 100%; border: 1px solid #000; background: #fff; }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbPopupFormField,.pjDbPopup .pjDbPopupForm .pjDbPopupSelectCustom { height: 44px; }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbPopupFormField { padding: 0 15px; }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbPopupFormTextarea { height: 100px; padding: 10px 15px; }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbPopupFormField:focus,.pjDbPopup .pjDbPopupForm .pjDbPopupFormTextarea:focus { -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, .3); box-shadow: 0 0 10px rgba(0, 0, 0, .3); }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbPopupSelectCustom { position: relative; }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbPopupSelectCustom:after { position: absolute; top: 50%; right: 15px; z-index: 1; margin-top: -4px; border-top: 8px solid #000; border-right: 5px solid transparent; border-left: 5px solid transparent; content: ''; }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbPopupSelectCustom select { position: relative; z-index: 2; width: 100%; height: 100%; padding: 0 30px 0 15px; border: 0; background: transparent; cursor: pointer; border-radius: 0; -webkit-appearance: none; -moz-appearance: none; appearance: none; }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbPopupSelectCustom select::-ms-expand { display: none; }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbPopupFormFoot { padding: 15px 0 5px; }";
			cssCode += ".pjDbPopup .pjDbPopupForm .pjDbFieldError{display: none; color: #ef2136; font-size: 15px;}";
			
			var styleElement = document.createElement("style");
			styleElement.type = "text/css";
			if (styleElement.styleSheet) {
			    styleElement.styleSheet.cssText = cssCode;
			} else {
				styleElement.appendChild(document.createTextNode(cssCode));
			}
			document.getElementsByTagName("head")[0].appendChild(styleElement);
		},
		appendTransitionCSS: function(){
			var self = this;
			
		},
		loadDialog: function(){
			var self = this;
			var htmlDialog = '';
			
			htmlDialog += '<div class="pjDbPopupInner">';
			htmlDialog += '<div class="pjDbPopupContent">';
			htmlDialog += '<div class="pjDbPopupContentInner">';
			htmlDialog += '<div class="pjDbPopupForm">';
			htmlDialog += '<form id="pjDbDialogForm" action="#" method="post">';
			htmlDialog += '<header class="pjDbPopupFormHead">';
			htmlDialog += '<p class="pjDbPopupFormTitle">Enter your email and name to continue reading.</p>';
			htmlDialog += '</header>';
			htmlDialog += '<div class="pjDbPopupFormBody">';
			htmlDialog += '<div class="pjDbPopupFormRow">';
			htmlDialog += '<label for="" class="pjDbPopupFormLabel">Name: </label>';
			htmlDialog += '<div class="pjDbPopupFormControls">';
			htmlDialog += '<input type="text" name="name" class="pjDbPopupFormField required" placeholder="Name" />';
			htmlDialog += '<label class="pjDbFieldError"></label>';
			htmlDialog += '</div>';
			htmlDialog += '</div>';
			htmlDialog += '<div class="pjDbPopupFormRow">';
			htmlDialog += '<label for="" class="pjDbPopupFormLabel">Email: </label>';
			htmlDialog += '<div class="pjDbPopupFormControls">';
			htmlDialog += '<input type="email" name="email" class="pjDbPopupFormField required email" placeholder="Email" />';
			htmlDialog += '<label class="pjDbFieldError"></label>';
			htmlDialog += '</div>';
			htmlDialog += '</div>';
			htmlDialog += '</div>';
			htmlDialog += '<footer class="pjDbPopupFormFoot">';
			htmlDialog += '<div class="pjDbPopupFormActions">';
			htmlDialog += '<button type="button" class="pjDbPopupBtn pjDbPopupBtnPrimary pjDbBtnSubmit">Submit form</button>';
			htmlDialog += '</div>';
			htmlDialog += '</footer>';
			htmlDialog += '</form>';
			htmlDialog += '</div>';
			htmlDialog += '</div>';
			htmlDialog += '</div>';
			htmlDialog += '</div>';
			
			var dialogDiv = document.createElement('div');
			dialogDiv.id = "pjDbPopup";
			dialogDiv.className = "pjDbPopup pjDbPopupAutoLoad";
			document.body.appendChild(dialogDiv);
			dialogDiv.innerHTML = htmlDialog;
			
			self.bindDialog();
		},
		bindDialog: function(){
			var self = this;
			var dialog_wrapper = self.getElementsByClass("pjDbPopupAutoLoad", null, "DIV");
			if(dialog_wrapper.length > 0)
			{
				var popupActiveClass = 'pjDbPopupActive';
				var $popup = dialog_wrapper[0];
				
				if (self.hasClass($popup, 'pjDbPopupAutoLoad')) {
					var $currentPopup = $popup;
					var $currentPopupContent = null;
					var $currentPopupContentInner = null;
					var $currentPopupContent_arr = self.getElementsByClass("pjDbPopupContent", $currentPopup, "DIV");
					if($currentPopupContent_arr.length > 0)
					{
						$currentPopupContent = $currentPopupContent_arr[0];
						var $currentPopupContentInner_arr =self.getElementsByClass("pjDbPopupContentInner", $currentPopupContent, "DIV");
						if($currentPopupContentInner_arr.length > 0)
						{
							$currentPopupContentInner = $currentPopupContentInner_arr[0];
						}
					}
					if($currentPopupContent != null && $currentPopupContentInner != null)
					{
						if (!self.hasClass($currentPopup, 'pjDbPopupDisabled')) 
						{
							var htmlElement = document.querySelector("html");
							var w = window,
						    	d = document,
						    	e = d.documentElement,
						    	g = d.getElementsByTagName('body')[0],
						    	win_width = w.innerWidth || e.clientWidth || g.clientWidth,
						    	win_heigth = w.innerHeight|| e.clientHeight|| g.clientHeight;
							
							htmlElement.style.overflow = "hidden";
							$currentPopup.setAttribute("style","width:"+win_width+"px; height:"+win_heigth+"px");
							
							if ((win_heigth) < ($currentPopupContentInner.offsetHeight + 90)) {
								
								$currentPopupContentInner.setAttribute("style","height:"+(win_heigth - 90)+"px");
							};
							self.addClass($currentPopup, popupActiveClass);
						}
						
					}
				}
				
				var btn_arr = self.getElementsByClass("pjDbBtnSubmit", $popup, "button");
				if(btn_arr.length > 0)
				{
					self.addEvent(btn_arr[0], "click", function (e) {
						if (e.preventDefault) {
							e.preventDefault();
						}
						if(self.validateForm() == true)
						{
							var formData = self.getFormData();
							var xmlHttp = new XMLHttpRequest();
							xmlHttp.onreadystatechange = function()
					        {
					            if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
					            {
					                if(xmlHttp.responseText == '200')
					                {
					                	self.createCookie('pjDialogBox', 'YES', 365);
					                	self.addClass($popup, 'pjDbPopupDisabled');
										var htmlElement = document.querySelector("html");
					                	htmlElement.style.overflow = "";
					                }
					            }
					        }
					        xmlHttp.open("get", "dialog/data.php?" + formData); 
					        xmlHttp.send();
						}
						return false;
					});
				}
			}
		},
		validateForm: function()
		{
			var self = this;
			var formValid = true;
			var $frm = document.getElementById("pjDbDialogForm");
			var $name = $frm.elements["name"];
			var $email = $frm.elements["email"];
			
			var $nameErrorMessage = $name.nextSibling;
			var $emailErrorMessage = $email.nextSibling;
			
			while($nameErrorMessage && $nameErrorMessage.nodeType != 1) {
				$nameErrorMessage = $nameErrorMessage.nextSibling;
			}
			while($emailErrorMessage && $emailErrorMessage.nodeType != 1) {
				$emailErrorMessage = $emailErrorMessage.nextSibling;
			}
			
			if($name.value == '')
			{
				$nameErrorMessage.innerHTML = 'This field is required';
				$nameErrorMessage.style.display = 'block';
				formValid = false;
			}else{
				$nameErrorMessage.style.display = 'none';
			}
			if($email.value == '')
			{
				$emailErrorMessage.innerHTML = 'This field is required';
				$emailErrorMessage.style.display = 'block';
				formValid = false;
			}else{
				var reg = /([0-9a-zA-Z\.\-\_]+)@([0-9a-zA-Z\.\-\_]+)\.([0-9a-zA-Z\.\-\_]+)/;
				if($email.value.match(reg) == null)
				{
					$emailErrorMessage.innerHTML = 'Email is not valid';
					$emailErrorMessage.style.display = 'block';
					formValid = false;
				}else{
					$emailErrorMessage.style.display = 'none';
				}
			}
			return formValid;
		},
		getFormData: function()
		{
			var self = this;
			var $frm = document.getElementById("pjDbDialogForm");
			var $name = $frm.elements["name"];
			var $email = $frm.elements["email"];
			var data = [];
			
			data.push("name=" + $name.value);
			data.push("email=" + $email.value);
			
			return data.join("&");
		}
	};
	
	window.DialogBox = DialogBox;	
})(window);

window.onload = function() {
	DialogBox = DialogBox();
}