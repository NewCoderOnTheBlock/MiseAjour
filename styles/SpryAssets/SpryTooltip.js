var Spry;if(!Spry){Spry={}}if(!Spry.Widget){Spry.Widget={}}Spry.Widget.BrowserSniff=function(){var i=navigator.appName.toString();var e=navigator.platform.toString();var c=navigator.userAgent.toString();this.mozilla=this.ie=this.opera=this.safari=false;var g=/Opera.([0-9\.]*)/i;var d=/MSIE.([0-9\.]*)/i;var f=/gecko/i;var h=/(applewebkit|safari)\/([\d\.]*)/i;var a=false;if((a=c.match(g))){this.opera=true;this.version=parseFloat(a[1])}else{if((a=c.match(d))){this.ie=true;this.version=parseFloat(a[1])}else{if((a=c.match(h))){this.safari=true;if(parseFloat(a[2])<420){this.version=2}else{this.version=3}}else{if(c.match(f)){var j=/rv:\s*([0-9\.]+)/i;a=c.match(j);this.mozilla=true;this.version=parseFloat(a[1])}}}}this.windows=this.mac=this.linux=false;this.Platform=c.match(/windows/i)?"windows":(c.match(/linux/i)?"linux":(c.match(/mac/i)?"mac":c.match(/unix/i)?"unix":"unknown"));this[this.Platform]=true;this.v=this.version;if(this.safari&&this.mac&&this.mozilla){this.mozilla=false}};Spry.is=new Spry.Widget.BrowserSniff();Spry.Widget.Tooltip=function(c,b,a){a=Spry.Widget.Utils.firstValid(a,{});this.init(b,c,a);if(Spry.Widget.Tooltip.onloadDidFire){this.attachBehaviors()}Spry.Widget.Tooltip.loadQueue.push(this)};Spry.Widget.Tooltip.prototype.init=function(d,e,a){var c=Spry.Widget.Utils;this.triggerElements=c.getElementsByClassName(d);this.tooltipElement=c.getElement(e);a.showDelay=parseInt(c.firstValid(a.showDelay,0),10);a.hideDelay=parseInt(c.firstValid(a.hideDelay,0),10);if(typeof this.triggerElements=="undefined"||!(this.triggerElements.length>0)){this.showError('The element(s) "'+d+'" do not exist in the page');return false}if(typeof this.tooltipElement=="undefined"||!this.tooltipElement){this.showError('The element "'+e+'" do not exists in the page');return false}this.listenersAttached=false;this.hoverClass="";this.followMouse=false;this.offsetX=15;this.offsetY=15;this.closeOnTooltipLeave=false;this.useEffect=false;c.setOptions(this,a);this.animator=null;for(var b=0;b<this.triggerElements.length;b++){if(!this.triggerElements[b].className){this.triggerElements[b].className=""}}if(this.useEffect){switch(this.useEffect.toString().toLowerCase()){case"blind":this.useEffect="Blind";break;case"fade":this.useEffect="Fade";break;default:this.useEffect=false}}this.visibleTooltip=false;this.tooltipElement.offsetHeight;if(Spry.Widget.Utils.getStyleProperty(this.tooltipElement,"display")!="none"){this.tooltipElement.style.display="none"}if(typeof this.offsetX!="numeric"){this.offsetX=parseInt(this.offsetX,10)}if(isNaN(this.offsetX)){this.offsetX=0}if(typeof this.offsetY!="numeric"){this.offsetY=parseInt(this.offsetY,10)}if(isNaN(this.offsetY)){this.offsetY=0}this.tooltipElement.style.position="absolute";this.tooltipElement.style.top="0px";this.tooltipElement.style.left="0px"};Spry.Widget.Tooltip.onloadDidFire=false;Spry.Widget.Tooltip.loadQueue=[];Spry.Widget.Tooltip.addLoadListener=function(a){if(typeof window.addEventListener!="undefined"){window.addEventListener("load",a,false)}else{if(typeof document.addEventListener!="undefined"){document.addEventListener("load",a,false)}else{if(typeof window.attachEvent!="undefined"){window.attachEvent("onload",a)}}}};Spry.Widget.Tooltip.processLoadQueue=function(c){Spry.Widget.Tooltip.onloadDidFire=true;var d=Spry.Widget.Tooltip.loadQueue;var a=d.length;for(var b=0;b<a;b++){if(!d[b].listenersAttached){d[b].attachBehaviors()}}};Spry.Widget.Tooltip.addLoadListener(Spry.Widget.Tooltip.processLoadQueue);Spry.Widget.Tooltip.prototype.addClassName=function(b,a){if(!b||!a){return}if(b.className.indexOf(a)==-1){b.className+=(b.className?" ":"")+a}};Spry.Widget.Tooltip.prototype.removeClassName=function(b,a){if(!b||!a){return}b.className=b.className.replace(new RegExp("\\s*\\b"+a+"\\b","g"),"")};Spry.Widget.Tooltip.prototype.showTooltip=function(){if(!this.visibleTooltip){this.tooltipElement.style.visibility="hidden";this.tooltipElement.style.zIndex="9999";this.tooltipElement.style.display="block"}Spry.Widget.Utils.putElementAt(this.tooltipElement,this.pos,{x:this.offsetX,y:this.offsetY},true);if(Spry.is.ie&&Spry.is.version=="6"){this.createIframeLayer(this.tooltipElement)}if(!this.visibleTooltip){if(this.useEffect){if(typeof this.showEffect=="undefined"){this.showEffect=new Spry.Widget.Tooltip[this.useEffect](this.tooltipElement,{from:0,to:1})}this.showEffect.start()}else{this.tooltipElement.style.visibility="visible"}}this.visibleTooltip=true};Spry.Widget.Tooltip.prototype.hideTooltip=function(b){if(this.useEffect&&!b){if(typeof this.hideEffect=="undefined"){this.hideEffect=new Spry.Widget.Tooltip[this.useEffect](this.tooltipElement,{from:1,to:0})}this.hideEffect.start()}else{if(typeof this.showEffect!="undefined"){this.showEffect.stop()}this.tooltipElement.style.display="none"}if(Spry.is.ie&&Spry.is.version=="6"){this.removeIframeLayer(this.tooltipElement)}if(this.hoverClass&&!this.hideTimer){for(var a=0;a<this.triggerElements.length;a++){this.removeClassName(this.triggerElements[a],this.hoverClass)}}this.visibleTooltip=false};Spry.Widget.Tooltip.prototype.displayTooltip=function(a){if(this.tooltipElement){if(this.hoverClass){for(var c=0;c<this.triggerElements.length;c++){this.removeClassName(this.triggerElements[c],this.hoverClass)}}if(a){if(this.hideTimer){clearInterval(this.hideTimer);delete (this.hideTimer)}if(this.hoverClass){if(typeof this.triggerHighlight!="undefined"){this.addClassName(this.triggerHighlight,this.hoverClass)}}var b=this;this.showTimer=setTimeout(function(){b.showTooltip()},this.showDelay)}else{if(this.showTimer){clearInterval(this.showTimer);delete (this.showTimer)}var b=this;this.hideTimer=setTimeout(function(){b.hideTooltip()},this.hideDelay)}}this.refreshTimeout()};Spry.Widget.Tooltip.prototype.onMouseOverTrigger=function(d){var c="";if(Spry.is.ie){c=d.srcElement}else{c=d.target}var b=Spry.Widget.Utils.contains;for(var a=0;a<this.triggerElements.length;a++){if(b(this.triggerElements[a],c)){c=this.triggerElements[a];break}}if(a==this.triggerElements.length){return}if(this.visibleTooltip&&this.triggerHighlight&&this.triggerHighlight==c){if(this.hideTimer){clearInterval(this.hideTimer);delete (this.hideTimer)}if(this.hoverClass){if(typeof this.triggerHighlight!="undefined"){this.addClassName(this.triggerHighlight,this.hoverClass)}}return}var f=Spry.Widget.Utils.getAbsoluteMousePosition(d);this.pos={x:f.x+this.offsetX,y:f.y+this.offsetY};this.triggerHighlight=c;Spry.Widget.Tooltip.closeAll();this.displayTooltip(true)};Spry.Widget.Tooltip.prototype.onMouseMoveTrigger=function(a){var b=Spry.Widget.Utils.getAbsoluteMousePosition(a);this.pos={x:b.x+this.offsetX,y:b.y+this.offsetY};if(this.visibleTooltip){this.showTooltip()}};Spry.Widget.Tooltip.prototype.onMouseOutTrigger=function(d){var c="";if(Spry.is.ie){c=d.toElement}else{c=d.relatedTarget}var b=Spry.Widget.Utils.contains;for(var a=0;a<this.triggerElements.length;a++){if(b(this.triggerElements[a],c)){return}}this.displayTooltip(false)};Spry.Widget.Tooltip.prototype.onMouseOutTooltip=function(c){var b="";if(Spry.is.ie){b=c.toElement}else{b=c.relatedTarget}var a=Spry.Widget.Utils.contains;if(a(this.tooltipElement,b)){return}this.displayTooltip(false)};Spry.Widget.Tooltip.prototype.onMouseOverTooltip=function(a){if(this.hideTimer){clearInterval(this.hideTimer);delete (this.hideTimer)}if(this.hoverClass){if(typeof this.triggerHighlight!="undefined"){this.addClassName(this.triggerHighlight,this.hoverClass)}}};Spry.Widget.Tooltip.prototype.refreshTimeout=function(){if(Spry.Widget.Tooltip.refreshTimeout!=null){clearTimeout(Spry.Widget.Tooltip.refreshTimeout);Spry.Widget.Tooltip.refreshTimeout=null}Spry.Widget.Tooltip.refreshTimeout=setTimeout(Spry.Widget.Tooltip.refreshAll,100)};Spry.Widget.Tooltip.prototype.destroy=function(){for(var a in this){try{if(typeof this.k=="object"&&typeof this.k.destroy=="function"){this.k.destroy()}delete this.k}catch(b){}}};Spry.Widget.Tooltip.prototype.checkDestroyed=function(){if(!this.tooltipElement||this.tooltipElement.parentNode==null){return true}return false};Spry.Widget.Tooltip.prototype.attachBehaviors=function(){var a=this;var c=Spry.Widget.Utils.addEventListener;for(var b=0;b<this.triggerElements.length;b++){c(this.triggerElements[b],"mouseover",function(d){a.onMouseOverTrigger(d||event);return true},false);c(this.triggerElements[b],"mouseout",function(d){a.onMouseOutTrigger(d||event);return true},false);if(this.followMouse){c(this.triggerElements[b],"mousemove",function(d){a.onMouseMoveTrigger(d||event);return true},false)}}if(this.closeOnTooltipLeave){c(this.tooltipElement,"mouseover",function(d){a.onMouseOverTooltip(d||event);return true},false);c(this.tooltipElement,"mouseout",function(d){a.onMouseOutTooltip(d||event);return true},false)}this.listenersAttached=true};Spry.Widget.Tooltip.prototype.createIframeLayer=function(b){if(typeof this.iframeLayer=="undefined"){var a=document.createElement("iframe");a.tabIndex="-1";a.src='javascript:"";';a.scrolling="no";a.frameBorder="0";a.className="iframeTooltip";b.parentNode.appendChild(a);this.iframeLayer=a}this.iframeLayer.style.left=b.offsetLeft+"px";this.iframeLayer.style.top=b.offsetTop+"px";this.iframeLayer.style.width=b.offsetWidth+"px";this.iframeLayer.style.height=b.offsetHeight+"px";this.iframeLayer.style.display="block"};Spry.Widget.Tooltip.prototype.removeIframeLayer=function(a){if(this.iframeLayer){this.iframeLayer.style.display="none"}};Spry.Widget.Tooltip.prototype.showError=function(a){alert("Spry.Widget.Tooltip ERR: "+a)};Spry.Widget.Tooltip.refreshAll=function(){var c=Spry.Widget.Tooltip.loadQueue;var a=c.length;for(var b=0;b<a;b++){if(c[b].checkDestroyed()){c[b].destroy();c.splice(b,1);b--;a=c.length}}};Spry.Widget.Tooltip.closeAll=function(){var c=Spry.Widget.Tooltip.loadQueue;var a=c.length;for(var b=0;b<a;b++){if(c[b].visibleTooltip){c[b].hideTooltip(true)}if(c[b].showTimer){clearTimeout(c[b].showTimer)}if(c[b].hideTimer){clearTimeout(c[b].hideTimer)}}};Spry.Widget.Tooltip.Animator=function(a,b){this.timer=null;this.fps=60;this.duration=500;this.startTime=0;this.transition=Spry.Widget.Tooltip.Animator.defaultTransition;this.onComplete=null;if(typeof a=="undefined"){return}this.element=Spry.Widget.Utils.getElement(a);Spry.Widget.Utils.setOptions(this,b,true);this.interval=this.duration/this.fps};Spry.Widget.Tooltip.Animator.defaultTransition=function(d,b,a,c){d/=c;return b+((2-d)*d*a)};Spry.Widget.Tooltip.Animator.prototype.start=function(){var a=this;this.startTime=(new Date).getTime();this.beforeStart();this.timer=setInterval(function(){a.stepAnimation()},this.interval)};Spry.Widget.Tooltip.Animator.prototype.stop=function(){if(this.timer){clearTimeout(this.timer)}this.timer=null};Spry.Widget.Tooltip.Animator.prototype.stepAnimation=function(){};Spry.Widget.Tooltip.Animator.prototype.beforeStart=function(){};Spry.Widget.Tooltip.Animator.prototype.destroy=function(){for(var a in this){try{delete this.k}catch(b){}}};Spry.Widget.Tooltip.Fade=function(a,b){Spry.Widget.Tooltip.Animator.call(this,a,b);if(Spry.is.ie){this.origOpacity=this.element.style.filter}else{this.origOpacity=this.element.style.opacity}};Spry.Widget.Tooltip.Fade.prototype=new Spry.Widget.Tooltip.Animator();Spry.Widget.Tooltip.Fade.prototype.constructor=Spry.Widget.Tooltip.Fade;Spry.Widget.Tooltip.Fade.prototype.stepAnimation=function(){var e=(new Date).getTime();var a=e-this.startTime;var c,f;if(a>=this.duration){this.beforeStop();this.stop();return}var b=this.transition(a,this.from,this.to-this.from,this.duration);if(Spry.is.ie){var d=this.element.style.filter.replace(/alpha\s*\(\s*opacity\s*=\s*[0-9\.]{1,3}\)/,"");this.element.style.filter=d+"alpha(opacity="+parseInt(b*100,10)+")"}else{this.element.style.opacity=b}this.element.style.visibility="visible";this.element.style.display="block"};Spry.Widget.Tooltip.Fade.prototype.beforeStop=function(){if(this.from>this.to){this.element.style.display="none"}if(Spry.is.mozilla){this.element.style.filter=this.origOpacity}else{this.element.style.opacity=this.origOpacity}};Spry.Widget.Tooltip.Blind=function(a,b){this.from=0;this.to=100;Spry.Widget.Tooltip.Animator.call(this,a,b);this.element.style.visibility="hidden";this.element.style.display="block";this.origHeight=parseInt(Spry.Widget.Utils.getStyleProperty(this.element,"height"),10);if(isNaN(this.origHeight)){this.origHeight=this.element.offsetHeight}if(this.to==0){this.from=this.origHeight}else{this.to=this.origHeight}};Spry.Widget.Tooltip.Blind.prototype=new Spry.Widget.Tooltip.Animator();Spry.Widget.Tooltip.Blind.prototype.constructor=Spry.Widget.Tooltip.Blind;Spry.Widget.Tooltip.Blind.prototype.beforeStart=function(){this.origOverflow=Spry.Widget.Utils.getStyleProperty(this.element,"overflow");this.element.style.overflow="hidden"};Spry.Widget.Tooltip.Blind.prototype.stepAnimation=function(){var d=(new Date).getTime();var a=d-this.startTime;var c,e;if(a>=this.duration){this.beforeStop();this.stop();return}var b=this.transition(a,this.from,this.to-this.from,this.duration);this.element.style.height=Math.floor(b)+"px";this.element.style.visibility="visible";this.element.style.display="block"};Spry.Widget.Tooltip.Blind.prototype.beforeStop=function(){this.element.style.overflow=this.origOverflow;if(this.from>this.to){this.element.style.display="none"}this.element.style.height=this.origHeight+"px"};if(!Spry.Widget.Utils){Spry.Widget.Utils={}}Spry.Widget.Utils.setOptions=function(d,c,a){if(!c){return}for(var b in c){if(a&&c[b]==undefined){continue}d[b]=c[b]}};Spry.Widget.Utils.getElement=function(a){if(a&&typeof a=="string"){return document.getElementById(a)}return a};Spry.Widget.Utils.getElementsByClassName=function(a){if(!a.length>0){return null}var p=a.split(",");var b=[];for(var f=0;f<p.length;f++){var g=p[f];var n=g.split(" ");var o=[];o[0]=[];o[0][0]=document.body;for(var e=0;e<n.length;e++){var m=Spry.Widget.Utils.getSelectorTokens(n[e]);for(var d=0;d<o[e].length;d++){var h=o[e][d].getElementsByTagName("*");o[e+1]=[];for(var c=0;c<h.length;c++){if(Spry.Widget.Utils.hasSelector(h[c],m)){o[e+1].push(h[c])}}}}if(o[e]){for(var d=0;d<o[e].length;d++){b.push(o[e][d])}}}return b};Spry.Widget.Utils.firstValid=function(){var c=null;var b=Spry.Widget.Utils.firstValid;for(var d=0;d<b.arguments.length;d++){if(typeof(b.arguments[d])!="undefined"){c=b.arguments[d];break}}return c};Spry.Widget.Utils.getSelectorTokens=function(a){a=a.replace(/\./g," .");a=a.replace(/\#/g," #");a=a.replace(/^\s+|\s+$/g,"");return a.split(" ")};Spry.Widget.Utils.hasSelector=function(b,c){for(var a=0;a<c.length;a++){switch(c[a].charAt(0)){case".":if(!b.className||b.className.indexOf(c[a].substr(1))==-1){return false}break;case"#":if(!b.id||b.id!=c[a].substr(1)){return false}break;default:if(b.nodeName.toLowerCase!=c[a]){return false}break}}return true};Spry.Widget.Utils.addEventListener=function(c,b,d,a){try{if(c.addEventListener){c.addEventListener(b,d,a)}else{if(c.attachEvent){c.attachEvent("on"+b,d)}}}catch(f){}};Spry.Widget.Utils.getStyleProperty=function(b,g){var d;var c=Spry.Widget.Utils.camelize(g);try{if(b.style){d=b.style[c]}if(!d){if(document.defaultView&&document.defaultView.getComputedStyle){var a=document.defaultView.getComputedStyle(b,null);d=a?a.getPropertyValue(g):null}else{if(b.currentStyle){d=b.currentStyle[c]}}}}catch(f){}return d=="auto"?null:d};Spry.Widget.Utils.camelize=function(f){if(f.indexOf("-")==-1){return f}var d=f.split("-");var a=true;var b="";for(var c=0;c<d.length;c++){if(d[c].length>0){if(a){b=d[c];a=false}else{var e=d[c];b+=e.charAt(0).toUpperCase()+e.substring(1)}}}return b};Spry.Widget.Utils.getPixels=function(a,c){var b=Spry.Widget.Utils.getStyleProperty(a,c);if(b=="medium"){b=2}else{b=parseInt(b,10)}b=isNaN(b)?0:b;return b};Spry.Widget.Utils.getAbsoluteMousePosition=function(a){var b={x:0,y:0};if(a.pageX){b.x=a.pageX}else{if(a.clientX){b.x=a.clientX+(document.documentElement.scrollLeft?document.documentElement.scrollLeft:document.body.scrollLeft)}}if(isNaN(b.x)){b.x=0}if(a.pageY){b.y=a.pageY}else{if(a.clientY){b.y=a.clientY+(document.documentElement.scrollTop?document.documentElement.scrollTop:document.body.scrollTop)}}if(isNaN(b.y)){b.y=0}return b};Spry.Widget.Utils.getBorderBox=function(c,i){i=i||document;if(typeof c=="string"){c=i.getElementById(c)}if(!c){return false}if(c.parentNode===null||Spry.Widget.Utils.getStyleProperty(c,"display")=="none"){return false}var g={x:0,y:0,width:0,height:0};var j=null;var e;if(c.getBoundingClientRect){e=c.getBoundingClientRect();var b=i.documentElement.scrollTop||i.body.scrollTop;var d=i.documentElement.scrollLeft||i.body.scrollLeft;g.x=e.left+d;g.y=e.top+b;g.width=e.right-e.left;g.height=e.bottom-e.top}else{if(i.getBoxObjectFor){e=i.getBoxObjectFor(c);g.x=e.x;g.y=e.y;g.width=e.width;g.height=e.height;var h=Spry.Widget.Utils.getPixels(c,"border-top-width");var f=Spry.Widget.Utils.getPixels(c,"border-left-width");g.x-=f;g.y-=h}else{g.x=c.offsetLeft;g.y=c.offsetTop;g.width=c.offsetWidth;g.height=c.offsetHeight;j=c.offsetParent;if(j!=c){while(j){g.x+=j.offsetLeft;g.y+=j.offsetTop;j=j.offsetParent}}var f=Spry.Widget.Utils.getPixels(c,"border-left-width");var h=Spry.Widget.Utils.getPixels(c,"border-top-width");g.x-=f;g.y-=h;var a=navigator.userAgent.toLowerCase();if(Spry.is.opera||Spry.is.safari&&Spry.Widget.Utils.getStyleProperty(c,"position")=="absolute"){g.y-=i.body.offsetTop}}}if(c.parentNode){j=c.parentNode}else{j=null}while(j&&j.tagName!="BODY"&&j.tagName!="HTML"){g.x-=j.scrollLeft;g.y-=j.scrollTop;if(j.parentNode){j=j.parentNode}else{j=null}}return g};Spry.Widget.Utils.setBorderBox=function(b,c){var e=Spry.Widget.Utils.getBorderBox(b,b.ownerDocument);if(e===false){return false}var d={x:Spry.Widget.Utils.getPixels(b,"left"),y:Spry.Widget.Utils.getPixels(b,"top")};var a={x:0,y:0,w:0,h:0};if(typeof c.x=="number"){a.x=c.x-e.x+d.x}if(typeof c.y=="number"){a.y=c.y-e.y+d.y}if(typeof c.x=="number"){b.style.left=a.x+"px"}if(typeof c.y=="number"){b.style.top=a.y+"px"}return true};Spry.Widget.Utils.putElementAt=function(b,c,e,a){a=Spry.Widget.Utils.firstValid(a,true);var d=Spry.Widget.Utils.getBorderBox(b,b.ownerDocument);Spry.Widget.Utils.setBorderBox(b,c);if(a){Spry.Widget.Utils.bringIntoView(b)}return true};Spry.Widget.Utils.bringIntoView=function(d){var j=Spry.Widget.Utils.getBorderBox(d,d.ownerDocument);if(j===false){return false}var k={x:Spry.Widget.Utils.getPixels(d,"left"),y:Spry.Widget.Utils.getPixels(d,"top")};var o={x:0,y:0};var h={x:0,y:0};var e=d.ownerDocument.compatMode=="CSS1Compat";var n=(Spry.is.ie&&e||Spry.is.mozilla)?d.ownerDocument.documentElement:d.ownerDocument.body;h.x=Spry.Widget.Utils.getPixels(n,"border-left-width");h.y=Spry.Widget.Utils.getPixels(n,"border-top-width");var q=n.scrollTop;var c=self.innerHeight?self.innerHeight:n.clientHeight;var p=j.y+(Spry.is.ie?-h.y:h.y);var m=j.y+j.height+(Spry.is.ie?-h.y:h.y);if(m-q>c){o.y=c-(m-q);if(p+o.y<q){o.y=q-p}}else{if(p<q){o.y=q-p}}if(o.y!=0){d.style.top=(k.y+o.y)+"px"}var g=n.scrollLeft;var i=n.clientWidth;var f=j.x+(Spry.is.ie?-h.x:h.x);var a=j.x+j.width+(Spry.is.ie?-h.x:h.x);if(a-g>i){o.x=i-(a-g);if(f+o.x<g){o.x=g-f}}else{if(f<g){o.x=g-f}}if(o.x!=0){d.style.left=(k.x+o.x)+"px"}};Spry.Widget.Utils.contains=function(d,e){if(typeof d.contains=="object"){return e&&d&&(d==e||d.contains(e))}else{var c=e;while(c){try{if(c==d){return true}c=c.parentNode}catch(b){return false}}return false}};