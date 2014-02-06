/**
 * Altair
 *
 * A neat SASS-based, and gruntified, front-end starter package build on top of file-based Kirby CMS.
 *
 * @authors	Jonathan van Wunnik <jonathan@studiodumbar.com>, Marijn Tijhuis <marijn@studiodumbar.com>
 * @license	MIT
 * @link	http://altair.studiodumbar.info
 * @version	0.1.11
 * @generated	2014-02-06:02:02
 */
function whichTransitionEvent(){var t,el=document.createElement("fakeelement"),transitions={transition:"transitionend",OTransition:"oTransitionEnd",MozTransition:"transitionend",WebkitTransition:"webkitTransitionEnd"};for(t in transitions)if(void 0!==el.style[t])return transitions[t]}"document"in self&&!("classList"in document.createElement("_"))&&!function(view){"use strict";if("Element"in view){var classListProp="classList",protoProp="prototype",elemCtrProto=view.Element[protoProp],objCtr=Object,strTrim=String[protoProp].trim||function(){return this.replace(/^\s+|\s+$/g,"")},arrIndexOf=Array[protoProp].indexOf||function(item){for(var i=0,len=this.length;len>i;i++)if(i in this&&this[i]===item)return i;return-1},DOMEx=function(type,message){this.name=type,this.code=DOMException[type],this.message=message},checkTokenAndGetIndex=function(classList,token){if(""===token)throw new DOMEx("SYNTAX_ERR","An invalid or illegal string was specified");if(/\s/.test(token))throw new DOMEx("INVALID_CHARACTER_ERR","String contains an invalid character");return arrIndexOf.call(classList,token)},ClassList=function(elem){for(var trimmedClasses=strTrim.call(elem.getAttribute("class")||""),classes=trimmedClasses?trimmedClasses.split(/\s+/):[],i=0,len=classes.length;len>i;i++)this.push(classes[i]);this._updateClassName=function(){elem.setAttribute("class",this.toString())}},classListProto=ClassList[protoProp]=[],classListGetter=function(){return new ClassList(this)};if(DOMEx[protoProp]=Error[protoProp],classListProto.item=function(i){return this[i]||null},classListProto.contains=function(token){return token+="",-1!==checkTokenAndGetIndex(this,token)},classListProto.add=function(){var token,tokens=arguments,i=0,l=tokens.length,updated=!1;do token=tokens[i]+"",-1===checkTokenAndGetIndex(this,token)&&(this.push(token),updated=!0);while(++i<l);updated&&this._updateClassName()},classListProto.remove=function(){var token,tokens=arguments,i=0,l=tokens.length,updated=!1;do{token=tokens[i]+"";var index=checkTokenAndGetIndex(this,token);-1!==index&&(this.splice(index,1),updated=!0)}while(++i<l);updated&&this._updateClassName()},classListProto.toggle=function(token,forse){token+="";var result=this.contains(token),method=result?forse!==!0&&"remove":forse!==!1&&"add";return method&&this[method](token),!result},classListProto.toString=function(){return this.join(" ")},objCtr.defineProperty){var classListPropDesc={get:classListGetter,enumerable:!0,configurable:!0};try{objCtr.defineProperty(elemCtrProto,classListProp,classListPropDesc)}catch(ex){-2146823252===ex.number&&(classListPropDesc.enumerable=!1,objCtr.defineProperty(elemCtrProto,classListProp,classListPropDesc))}}else objCtr[protoProp].__defineGetter__&&elemCtrProto.__defineGetter__(classListProp,classListGetter)}}(self),function(){for(var lastTime=0,vendors=["webkit","moz"],x=0;x<vendors.length&&!window.requestAnimationFrame;++x)window.requestAnimationFrame=window[vendors[x]+"RequestAnimationFrame"],window.cancelAnimationFrame=window[vendors[x]+"CancelAnimationFrame"]||window[vendors[x]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(callback){var currTime=(new Date).getTime(),timeToCall=Math.max(0,16-(currTime-lastTime)),id=window.setTimeout(function(){callback(currTime+timeToCall)},timeToCall);return lastTime=currTime+timeToCall,id}),window.cancelAnimationFrame||(window.cancelAnimationFrame=function(id){clearTimeout(id)})}();var transitionEnd=whichTransitionEvent();window.smoothScroll=function(window,document){"use strict";if("querySelector"in document&&"addEventListener"in window&&Array.prototype.forEach){for(var scrollToggles=document.querySelectorAll("[data-scroll]"),runSmoothScroll=function(anchor,duration,easing,url){var percentage,position,startLocation=window.pageYOffset,scrollHeader=document.querySelector("[data-scroll-header]"),headerHeight=null===scrollHeader?0:scrollHeader.offsetHeight,timeLapsed=0,easingPattern=function(type,time){return"easeInQuad"==type?time*time:"easeOutQuad"==type?time*(2-time):"easeInOutQuad"==type?.5>time?2*time*time:-1+(4-2*time)*time:"easeInCubic"==type?time*time*time:"easeOutCubic"==type?--time*time*time+1:"easeInOutCubic"==type?.5>time?4*time*time*time:(time-1)*(2*time-2)*(2*time-2)+1:"easeInQuart"==type?time*time*time*time:"easeOutQuart"==type?1- --time*time*time*time:"easeInOutQuart"==type?.5>time?8*time*time*time*time:1-8*--time*time*time*time:"easeInQuint"==type?time*time*time*time*time:"easeOutQuint"==type?1+--time*time*time*time*time:"easeInOutQuint"==type?.5>time?16*time*time*time*time*time:1+16*--time*time*time*time*time:time},updateURL=function(url,anchor){"true"===url&&history.pushState&&history.pushState({pos:anchor.id},"","#"+anchor.id)},getEndLocation=function(anchor){var location=0;if(anchor.offsetParent)do location+=anchor.offsetTop,anchor=anchor.offsetParent;while(anchor);return location-=headerHeight,location>=0?location:0},endLocation=getEndLocation(anchor),distance=endLocation-startLocation,stopAnimation=function(){var currentLocation=window.pageYOffset;(currentLocation==endLocation||window.innerHeight+currentLocation>=document.body.scrollHeight)&&clearInterval(runAnimation)},animateScroll=function(){timeLapsed+=16,percentage=timeLapsed/duration,percentage=percentage>1?1:percentage,position=startLocation+distance*easingPattern(easing,percentage),window.scrollTo(0,position),stopAnimation()};updateURL(url,anchor);var runAnimation=setInterval(animateScroll,16)},handleToggleClick=function(event){var dataID=this.getAttribute("href"),dataTarget=document.querySelector(dataID),dataSpeed=this.getAttribute("data-speed"),dataEasing=this.getAttribute("data-easing"),dataURL=this.getAttribute("data-url");event.preventDefault(),dataTarget&&runSmoothScroll(dataTarget,dataSpeed||500,dataEasing||"easeInOutCubic",dataURL||"false")},i=scrollToggles.length;i--;){var toggle=scrollToggles[i];toggle.addEventListener("click",handleToggleClick,!1)}window.onpopstate=function(event){null===event.state&&""===window.location.hash&&window.scrollTo(0,0)}}}(window,document);var extend={object:function(out){out=out||{};for(var i=1;i<arguments.length;i++)if(arguments[i])for(var key in arguments[i])arguments[i].hasOwnProperty(key)&&(out[key]=arguments[i][key]);return out}},alerts={settings:{dismiss:"Dismiss"},options:{type:"bar"},init:function(push_message){if("undefined"!=typeof LANG_MESSAGE_DISMISS&&(this.settings.dismiss=LANG_MESSAGE_DISMISS),"undefined"!=typeof push_message)for(var i=0;i<push_message.length;i++)alerts.addMessage({status:push_message[i].status,content:push_message[i].text,timeout:push_message[i].timeout,type:push_message[i].type});var dismissbutton=document.querySelector("[data-dismiss]");null!==dismissbutton&&dismissbutton.addEventListener("click",this.hideNotification,!1)},addMessage:function(options){var message_element;extend.object(alerts.options,options),message_element=document.createElement("div"),"bar"===alerts.options.type&&(message_element.className="Alert Alert--bar Alert--"+alerts.options.status+" js-alert",message_element.setAttribute("data-element-type","bar"),message_element.innerHTML='<div class="Alert-message">'+alerts.options.content+'</div><button type="button" class="Alert-close" data-dismiss="Alert" aria-hidden="true" role="presentation">&times;</button>',document.body.insertBefore(message_element,document.body.firstChild)),"modal"===alerts.options.type&&(backdrop_element=document.createElement("div"),backdrop_element.className="Backdrop js-backdrop",message_element.className="Alert Alert--modal Alert--"+alerts.options.status+" js-alert",message_element.setAttribute("data-element-type","modal"),message_element.innerHTML='<div class="Alert-message">'+alerts.options.content+'</div><button class="Button Button--primary" data-dismiss="Alert">'+this.settings.dismiss+"</button>",document.body.appendChild(backdrop_element),document.body.appendChild(message_element)),this.showNotification(message_element),"undefined"!=typeof alerts.options.timeout&&0!==alerts.options.timeout&&setTimeout(function(){alerts.onTimeoutNotification(message_element)},alerts.options.timeout)},showNotification:function(element){var notification=element;if(setTimeout(function(){notification.classList.add("is-visible")},10),"modal"===alerts.options.type){var backdrops=document.querySelectorAll(".Backdrop");Array.prototype.forEach.call(backdrops,function(el){el.classList.add("is-visible")})}},hideNotification:function(event){var dismissselector=event.target.getAttribute("data-dismiss"),notification=document.querySelector("."+dismissselector);if(notification.classList.remove("is-visible"),notification.classList.remove("is-hidden"),"modal"===alerts.options.type){var backdrop=document.querySelector(".Backdrop");backdrop.classList.remove("is-visible"),backdrop.classList.add("is-hidden")}var notificationHasTransformSet=null,notificationHasWebkitTransformSet=null;return window.getComputedStyle&&(notificationHasTransformSet=window.getComputedStyle(notification,null).getPropertyValue("transform"),notificationHasWebkitTransformSet=window.getComputedStyle(notification,null).getPropertyValue("-webkit-transform")),Modernizr.csstransitions&&"none"!==notificationHasTransformSet&&"none"!==notificationHasWebkitTransformSet?notification.addEventListener(transitionEnd,function(){alerts.removeNotificationElements(this)},!1):alerts.removeNotificationElements(notification),!1},removeNotificationElements:function(element){var elementtype=element.getAttribute("data-element-type");if(element.parentNode.removeChild(element),"modal"===elementtype){var backdrop=document.querySelector(".Backdrop");backdrop.parentNode.removeChild(backdrop)}},onTimeoutNotification:function(element){var dismiss=element.querySelector("[data-dismiss]");clickevent=document.createEvent("HTMLEvents"),clickevent.initEvent("click",!0,!1),dismiss.dispatchEvent(clickevent)}},navMain={elements:{banner:document.querySelector(".Banner"),html:document.querySelector("html")},init:function(){var navMainShow=document.querySelector(".js-navMainShow"),navMainHide=document.querySelector(".js-navMainHide");navMainShow.addEventListener("click",navMain.open,!1),navMainHide.addEventListener("click",navMain.close,!1)},setNavHandlers:function(){document.addEventListener("keyup",navMain.handleNavClick,!1)},unsetNavHandlers:function(){document.removeEventListener("keyup",navMain.handleNavClick,!1)},handleNavClick:function(event){var target=event.target;(target.classList.contains("js-navMain")||27===event.keyCode)&&navMain.close(event)},open:function(event){event.preventDefault(),navMain.elements.html.classList.add("is-openMainNav"),navMain.setNavHandlers()},close:function(event){event.preventDefault(),navMain.elements.html.classList.remove("is-openMainNav"),navMain.unsetNavHandlers()}},popup={openWindow:function(event){var url=event.currentTarget.getAttribute("href");"undefined"==typeof event.data.h&&(event.data.h=400),"undefined"==typeof event.data.w&&(event.data.w=650),window.open(url,"popupwin","height="+event.data.h+",width="+event.data.w+",resizable=1,toolbar=0,menubar=0,status=0,location=0,scrollbars=1"),event.preventDefault()}};cutsthemustard&&document.addEventListener("DOMContentLoaded",function(){alerts.init(push_message),navMain.init();var popuplink=document.querySelector(".js-popup");popuplink.addEventListener("click",popup.openWindow,!1)},!1);