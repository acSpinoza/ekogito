!function(context,factory){"use strict";if("function"==typeof define&&define.amd)define([],factory);else if("object"==typeof exports)module.exports=factory();else{var namespace="hopscotch";if(context[namespace])return;context[namespace]=factory()}}(this,function(){var Hopscotch,HopscotchBubble,HopscotchCalloutManager,HopscotchI18N,customI18N,customRenderer,customEscape,utils,callbacks,helpers,winLoadHandler,defaultOpts,winHopscotch,templateToUse="bubble_default",Sizzle=window.Sizzle||null,undefinedStr="undefined",waitingToStart=!1,hasJquery=typeof jQuery!==undefinedStr,hasSessionStorage=!1,isStorageWritable=!1,document=window.document,validIdRegEx=/^[a-zA-Z]+[a-zA-Z0-9_-]*$/,rtlMatches={left:"right",right:"left"};try{typeof window.sessionStorage!==undefinedStr&&(hasSessionStorage=!0,sessionStorage.setItem("hopscotch.test.storage","ok"),sessionStorage.removeItem("hopscotch.test.storage"),isStorageWritable=!0)}catch(err){}return defaultOpts={smoothScroll:!0,scrollDuration:1e3,scrollTopMargin:200,showCloseButton:!0,showPrevButton:!1,showNextButton:!0,bubbleWidth:280,bubblePadding:15,arrowWidth:20,skipIfNoElement:!0,isRtl:!1,cookieName:"hopscotch.tour.state"},Array.isArray||(Array.isArray=function(obj){return"[object Array]"===Object.prototype.toString.call(obj)}),winLoadHandler=function(){waitingToStart&&winHopscotch.startTour()},utils={addClass:function(domEl,classToAdd){var domClasses,classToAddArr,i,len;if(domEl.className){for(classToAddArr=classToAdd.split(/\s+/),domClasses=" "+domEl.className+" ",i=0,len=classToAddArr.length;len>i;++i)domClasses.indexOf(" "+classToAddArr[i]+" ")<0&&(domClasses+=classToAddArr[i]+" ");domEl.className=domClasses.replace(/^\s+|\s+$/g,"")}else domEl.className=classToAdd},removeClass:function(domEl,classToRemove){var domClasses,classToRemoveArr,i,len;for(classToRemoveArr=classToRemove.split(/\s+/),domClasses=" "+domEl.className+" ",i=0,len=classToRemoveArr.length;len>i;++i)domClasses=domClasses.replace(" "+classToRemoveArr[i]+" "," ");domEl.className=domClasses.replace(/^\s+|\s+$/g,"")},hasClass:function(domEl,classToCheck){var classes;return domEl.className?(classes=" "+domEl.className+" ",-1!==classes.indexOf(" "+classToCheck+" ")):!1},getPixelValue:function(val){var valType=typeof val;return"number"===valType?val:"string"===valType?parseInt(val,10):0},valOrDefault:function(val,valDefault){return typeof val!==undefinedStr?val:valDefault},invokeCallbackArrayHelper:function(arr){var fn;return Array.isArray(arr)&&(fn=helpers[arr[0]],"function"==typeof fn)?fn.apply(this,arr.slice(1)):void 0},invokeCallbackArray:function(arr){var i,len;if(Array.isArray(arr)){if("string"==typeof arr[0])return utils.invokeCallbackArrayHelper(arr);for(i=0,len=arr.length;len>i;++i)utils.invokeCallback(arr[i])}},invokeCallback:function(cb){return"function"==typeof cb?cb():"string"==typeof cb&&helpers[cb]?helpers[cb]():utils.invokeCallbackArray(cb)},invokeEventCallbacks:function(evtType,stepCb){var i,len,cbArr=callbacks[evtType];if(stepCb)return this.invokeCallback(stepCb);for(i=0,len=cbArr.length;len>i;++i)this.invokeCallback(cbArr[i].cb)},getScrollTop:function(){var scrollTop;return scrollTop=typeof window.pageYOffset!==undefinedStr?window.pageYOffset:document.documentElement.scrollTop},getScrollLeft:function(){var scrollLeft;return scrollLeft=typeof window.pageXOffset!==undefinedStr?window.pageXOffset:document.documentElement.scrollLeft},getWindowHeight:function(){return window.innerHeight||document.documentElement.clientHeight},addEvtListener:function(el,evtName,fn){return el?el.addEventListener?el.addEventListener(evtName,fn,!1):el.attachEvent("on"+evtName,fn):void 0},removeEvtListener:function(el,evtName,fn){return el?el.removeEventListener?el.removeEventListener(evtName,fn,!1):el.detachEvent("on"+evtName,fn):void 0},documentIsReady:function(){return"complete"===document.readyState},evtPreventDefault:function(evt){evt.preventDefault?evt.preventDefault():event&&(event.returnValue=!1)},extend:function(obj1,obj2){var prop;for(prop in obj2)obj2.hasOwnProperty(prop)&&(obj1[prop]=obj2[prop])},getStepTargetHelper:function(target){var result=document.getElementById(target);if(result)return result;if(hasJquery)return result=jQuery(target),result.length?result[0]:null;if(Sizzle)return result=new Sizzle(target),result.length?result[0]:null;if(document.querySelector)try{return document.querySelector(target)}catch(err){}return/^#[a-zA-Z][\w-_:.]*$/.test(target)?document.getElementById(target.substring(1)):null},getStepTarget:function(step){var queriedTarget;if(!step||!step.target)return null;if("string"==typeof step.target)return utils.getStepTargetHelper(step.target);if(Array.isArray(step.target)){var i,len;for(i=0,len=step.target.length;len>i;i++)if("string"==typeof step.target[i]&&(queriedTarget=utils.getStepTargetHelper(step.target[i])))return queriedTarget;return null}return step.target},getI18NString:function(key){return customI18N[key]||HopscotchI18N[key]},setState:function(name,value,days){var date,expires="";if(hasSessionStorage&&isStorageWritable)try{sessionStorage.setItem(name,value)}catch(err){isStorageWritable=!1,this.setState(name,value,days)}else hasSessionStorage&&sessionStorage.removeItem(name),days&&(date=new Date,date.setTime(date.getTime()+24*days*60*60*1e3),expires="; expires="+date.toGMTString()),document.cookie=name+"="+value+expires+"; path=/"},getState:function(name){var i,c,state,nameEQ=name+"=",ca=document.cookie.split(";");if(hasSessionStorage&&(state=sessionStorage.getItem(name)))return state;for(i=0;i<ca.length;i++){for(c=ca[i];" "===c.charAt(0);)c=c.substring(1,c.length);if(0===c.indexOf(nameEQ)){state=c.substring(nameEQ.length,c.length);break}}return state},clearState:function(name){hasSessionStorage?sessionStorage.removeItem(name):this.setState(name,"",-1)},normalizePlacement:function(step){!step.placement&&step.orientation&&(step.placement=step.orientation)},flipPlacement:function(step){if(step.isRtl&&!step._isFlipped){var prop,i,props=["orientation","placement"];step.xOffset&&(step.xOffset=-1*this.getPixelValue(step.xOffset));for(i in props)prop=props[i],step.hasOwnProperty(prop)&&rtlMatches.hasOwnProperty(step[prop])&&(step[prop]=rtlMatches[step[prop]]);step._isFlipped=!0}}},utils.addEvtListener(window,"load",winLoadHandler),callbacks={next:[],prev:[],start:[],end:[],show:[],error:[],close:[]},helpers={},HopscotchI18N={stepNums:null,nextBtn:"Next",prevBtn:"Back",doneBtn:"Done",skipBtn:"Skip",closeTooltip:"Close"},customI18N={},HopscotchBubble=function(opt){this.init(opt)},HopscotchBubble.prototype={isShowing:!1,currStep:void 0,setPosition:function(step){var bubbleBoundingHeight,bubbleBoundingWidth,boundingRect,top,left,arrowOffset,verticalLeftPosition,targetEl=utils.getStepTarget(step),el=this.element,arrowEl=this.arrowEl,arrowPos=step.isRtl?"right":"left";if(utils.flipPlacement(step),utils.normalizePlacement(step),bubbleBoundingWidth=el.offsetWidth,bubbleBoundingHeight=el.offsetHeight,utils.removeClass(el,"fade-in-down fade-in-up fade-in-left fade-in-right"),boundingRect=targetEl.getBoundingClientRect(),verticalLeftPosition=step.isRtl?boundingRect.right-bubbleBoundingWidth:boundingRect.left,"top"===step.placement)top=boundingRect.top-bubbleBoundingHeight-this.opt.arrowWidth,left=verticalLeftPosition;else if("bottom"===step.placement)top=boundingRect.bottom+this.opt.arrowWidth,left=verticalLeftPosition;else if("left"===step.placement)top=boundingRect.top,left=boundingRect.left-bubbleBoundingWidth-this.opt.arrowWidth;else{if("right"!==step.placement)throw new Error("Bubble placement failed because step.placement is invalid or undefined!");top=boundingRect.top,left=boundingRect.right+this.opt.arrowWidth}arrowOffset="center"!==step.arrowOffset?utils.getPixelValue(step.arrowOffset):step.arrowOffset,arrowOffset?"top"===step.placement||"bottom"===step.placement?(arrowEl.style.top="","center"===arrowOffset?arrowEl.style[arrowPos]=Math.floor(bubbleBoundingWidth/2-arrowEl.offsetWidth/2)+"px":arrowEl.style[arrowPos]=arrowOffset+"px"):("left"===step.placement||"right"===step.placement)&&(arrowEl.style[arrowPos]="","center"===arrowOffset?arrowEl.style.top=Math.floor(bubbleBoundingHeight/2-arrowEl.offsetHeight/2)+"px":arrowEl.style.top=arrowOffset+"px"):(arrowEl.style.top="",arrowEl.style[arrowPos]=""),"center"===step.xOffset?left=boundingRect.left+targetEl.offsetWidth/2-bubbleBoundingWidth/2:left+=utils.getPixelValue(step.xOffset),"center"===step.yOffset?top=boundingRect.top+targetEl.offsetHeight/2-bubbleBoundingHeight/2:top+=utils.getPixelValue(step.yOffset),step.fixedElement||(top+=utils.getScrollTop(),left+=utils.getScrollLeft()),el.style.position=step.fixedElement?"fixed":"absolute",el.style.top=top+"px",el.style.left=left+"px"},render:function(step,idx,callback){var tourSpecificRenderer,customTourData,unsafe,currTour,totalSteps,totalStepsI18n,nextBtnText,isLast,opts,el=this.element;if(step?this.currStep=step:this.currStep&&(step=this.currStep),this.opt.isTourBubble?(currTour=winHopscotch.getCurrTour(),currTour&&(customTourData=currTour.customData,tourSpecificRenderer=currTour.customRenderer,step.isRtl=step.hasOwnProperty("isRtl")?step.isRtl:currTour.hasOwnProperty("isRtl")?currTour.isRtl:this.opt.isRtl,unsafe=currTour.unsafe,Array.isArray(currTour.steps)&&(totalSteps=currTour.steps.length,totalStepsI18n=this._getStepI18nNum(this._getStepNum(totalSteps-1)),isLast=this._getStepNum(idx)===this._getStepNum(totalSteps-1)))):(customTourData=step.customData,tourSpecificRenderer=step.customRenderer,unsafe=step.unsafe,step.isRtl=step.hasOwnProperty("isRtl")?step.isRtl:this.opt.isRtl),nextBtnText=isLast?utils.getI18NString("doneBtn"):step.showSkip?utils.getI18NString("skipBtn"):utils.getI18NString("nextBtn"),utils.flipPlacement(step),utils.normalizePlacement(step),this.placement=step.placement,opts={i18n:{prevBtn:utils.getI18NString("prevBtn"),nextBtn:nextBtnText,closeTooltip:utils.getI18NString("closeTooltip"),stepNum:this._getStepI18nNum(this._getStepNum(idx)),numSteps:totalStepsI18n},buttons:{showPrev:utils.valOrDefault(step.showPrevButton,this.opt.showPrevButton)&&this._getStepNum(idx)>0,showNext:utils.valOrDefault(step.showNextButton,this.opt.showNextButton),showCTA:utils.valOrDefault(step.showCTAButton&&step.ctaLabel,!1),ctaLabel:step.ctaLabel,showClose:utils.valOrDefault(this.opt.showCloseButton,!0)},step:{num:idx,isLast:utils.valOrDefault(isLast,!1),title:step.title||"",content:step.content||"",isRtl:step.isRtl,placement:step.placement,padding:utils.valOrDefault(step.padding,this.opt.bubblePadding),width:utils.getPixelValue(step.width)||this.opt.bubbleWidth,customData:step.customData||{}},tour:{isTour:this.opt.isTourBubble,numSteps:totalSteps,unsafe:utils.valOrDefault(unsafe,!1),customData:customTourData||{}}},"function"==typeof tourSpecificRenderer)el.innerHTML=tourSpecificRenderer(opts);else if("string"==typeof tourSpecificRenderer){if(!winHopscotch.templates||"function"!=typeof winHopscotch.templates[tourSpecificRenderer])throw new Error('Bubble rendering failed - template "'+tourSpecificRenderer+'" is not a function.');el.innerHTML=winHopscotch.templates[tourSpecificRenderer](opts)}else if(customRenderer)el.innerHTML=customRenderer(opts);else{if(!winHopscotch.templates||"function"!=typeof winHopscotch.templates[templateToUse])throw new Error('Bubble rendering failed - template "'+templateToUse+'" is not a function.');el.innerHTML=winHopscotch.templates[templateToUse](opts)}for(children=el.children,numChildren=children.length,i=0;i<numChildren;i++)node=children[i],utils.hasClass(node,"hopscotch-arrow")&&(this.arrowEl=node);return el.style.zIndex="number"==typeof step.zindex?step.zindex:"",this._setArrow(step.placement),this.hide(!1),this.setPosition(step),callback&&callback(!step.fixedElement),this},_getStepNum:function(idx){var stepIdx,i,skippedStepsCount=0,skippedSteps=winHopscotch.getSkippedStepsIndexes(),len=skippedSteps.length;for(i=0;len>i;i++)stepIdx=skippedSteps[i],idx>stepIdx&&skippedStepsCount++;return idx-skippedStepsCount},_getStepI18nNum:function(idx){var stepNumI18N=utils.getI18NString("stepNums");return stepNumI18N&&idx<stepNumI18N.length?idx=stepNumI18N[idx]:idx+=1,idx},_setArrow:function(placement){utils.removeClass(this.arrowEl,"down up right left"),"top"===placement?utils.addClass(this.arrowEl,"down"):"bottom"===placement?utils.addClass(this.arrowEl,"up"):"left"===placement?utils.addClass(this.arrowEl,"right"):"right"===placement&&utils.addClass(this.arrowEl,"left")},_getArrowDirection:function(){return"top"===this.placement?"down":"bottom"===this.placement?"up":"left"===this.placement?"right":"right"===this.placement?"left":void 0},show:function(){var self=this,fadeClass="fade-in-"+this._getArrowDirection(),fadeDur=1e3;return utils.removeClass(this.element,"hide"),utils.addClass(this.element,fadeClass),setTimeout(function(){utils.removeClass(self.element,"invisible")},50),setTimeout(function(){utils.removeClass(self.element,fadeClass)},fadeDur),this.isShowing=!0,this},hide:function(remove){var el=this.element;return remove=utils.valOrDefault(remove,!0),el.style.top="",el.style.left="",remove?(utils.addClass(el,"hide"),utils.removeClass(el,"invisible")):(utils.removeClass(el,"hide"),utils.addClass(el,"invisible")),utils.removeClass(el,"animate fade-in-up fade-in-down fade-in-right fade-in-left"),this.isShowing=!1,this},destroy:function(){var el=this.element;el&&el.parentNode.removeChild(el),utils.removeEvtListener(el,"click",this.clickCb)},_handleBubbleClick:function(evt){function findMatchRecur(el){return el===evt.currentTarget?null:utils.hasClass(el,"hopscotch-cta")?"cta":utils.hasClass(el,"hopscotch-next")?"next":utils.hasClass(el,"hopscotch-prev")?"prev":utils.hasClass(el,"hopscotch-close")?"close":findMatchRecur(el.parentElement)}var action;evt=evt||window.event;var targetElement=evt.target||evt.srcElement;if(action=findMatchRecur(targetElement),"cta"===action)this.opt.isTourBubble||winHopscotch.getCalloutManager().removeCallout(this.currStep.id),this.currStep.onCTA&&utils.invokeCallback(this.currStep.onCTA);else if("next"===action)winHopscotch.nextStep(!0);else if("prev"===action)winHopscotch.prevStep(!0);else if("close"===action){if(this.opt.isTourBubble){var currStepNum=winHopscotch.getCurrStepNum(),currTour=winHopscotch.getCurrTour(),doEndCallback=currStepNum===currTour.steps.length-1;utils.invokeEventCallbacks("close"),winHopscotch.endTour(!0,doEndCallback)}else this.opt.onClose&&utils.invokeCallback(this.opt.onClose),this.opt.id&&!this.opt.isTourBubble?winHopscotch.getCalloutManager().removeCallout(this.opt.id):this.destroy();utils.evtPreventDefault(evt)}},init:function(initOpt){var onWinResize,appendToBody,currTour,opt,el=document.createElement("div"),self=this,resizeCooldown=!1;this.element=el,opt={showPrevButton:defaultOpts.showPrevButton,showNextButton:defaultOpts.showNextButton,bubbleWidth:defaultOpts.bubbleWidth,bubblePadding:defaultOpts.bubblePadding,arrowWidth:defaultOpts.arrowWidth,isRtl:defaultOpts.isRtl,showNumber:!0,isTourBubble:!0},initOpt=typeof initOpt===undefinedStr?{}:initOpt,utils.extend(opt,initOpt),this.opt=opt,el.className="hopscotch-bubble animated",opt.isTourBubble?(currTour=winHopscotch.getCurrTour(),currTour&&utils.addClass(el,"tour-"+currTour.id)):utils.addClass(el,"hopscotch-callout no-number"),onWinResize=function(){!resizeCooldown&&self.isShowing&&(resizeCooldown=!0,setTimeout(function(){self.setPosition(self.currStep),resizeCooldown=!1},100))},utils.addEvtListener(window,"resize",onWinResize),this.clickCb=function(evt){self._handleBubbleClick(evt)},utils.addEvtListener(el,"click",this.clickCb),this.hide(),utils.documentIsReady()?document.body.appendChild(el):(document.addEventListener?(appendToBody=function(){document.removeEventListener("DOMContentLoaded",appendToBody),window.removeEventListener("load",appendToBody),document.body.appendChild(el)},document.addEventListener("DOMContentLoaded",appendToBody,!1)):(appendToBody=function(){"complete"===document.readyState&&(document.detachEvent("onreadystatechange",appendToBody),window.detachEvent("onload",appendToBody),document.body.appendChild(el))},document.attachEvent("onreadystatechange",appendToBody)),utils.addEvtListener(window,"load",appendToBody))}},HopscotchCalloutManager=function(){var callouts={},calloutOpts={};this.createCallout=function(opt){var callout;if(!opt.id)throw new Error("Must specify a callout id.");if(!validIdRegEx.test(opt.id))throw new Error("Callout ID is using an invalid format. Use alphanumeric, underscores, and/or hyphens only. First character must be a letter.");if(callouts[opt.id])throw new Error("Callout by that id already exists. Please choose a unique id.");if(!utils.getStepTarget(opt))throw new Error("Must specify existing target element via 'target' option.");return opt.showNextButton=opt.showPrevButton=!1,opt.isTourBubble=!1,callout=new HopscotchBubble(opt),callouts[opt.id]=callout,calloutOpts[opt.id]=opt,callout.render(opt,null,function(){callout.show(),opt.onShow&&utils.invokeCallback(opt.onShow)}),callout},this.getCallout=function(id){return callouts[id]},this.removeAllCallouts=function(){var calloutId;for(calloutId in callouts)callouts.hasOwnProperty(calloutId)&&this.removeCallout(calloutId)},this.removeCallout=function(id){var callout=callouts[id];callouts[id]=null,calloutOpts[id]=null,callout&&callout.destroy()},this.refreshCalloutPositions=function(){var calloutId,callout,opts;for(calloutId in callouts)callouts.hasOwnProperty(calloutId)&&calloutOpts.hasOwnProperty(calloutId)&&(callout=callouts[calloutId],opts=calloutOpts[calloutId],callout&&opts&&callout.setPosition(opts))}},Hopscotch=function(initOptions){var bubble,calloutMgr,opt,currTour,currStepNum,cookieTourId,cookieTourStep,_configure,self=this,skippedSteps={},cookieSkippedSteps=[],getBubble=function(setOptions){return bubble&&bubble.element&&bubble.element.parentNode||(bubble=new HopscotchBubble(opt)),setOptions&&utils.extend(bubble.opt,{bubblePadding:getOption("bubblePadding"),bubbleWidth:getOption("bubbleWidth"),showNextButton:getOption("showNextButton"),showPrevButton:getOption("showPrevButton"),showCloseButton:getOption("showCloseButton"),arrowWidth:getOption("arrowWidth"),isRtl:getOption("isRtl")}),bubble},destroyBubble=function(){bubble&&(bubble.destroy(),bubble=null)},getOption=function(name){return"undefined"==typeof opt?defaultOpts[name]:utils.valOrDefault(opt[name],defaultOpts[name])},getCurrStep=function(){var step;return step=!currTour||0>currStepNum||currStepNum>=currTour.steps.length?null:currTour.steps[currStepNum]},targetClickNextFn=function(){self.nextStep()},adjustWindowScroll=function(cb){var scrollEl,yuiAnim,yuiEase,direction,scrollIncr,scrollTimeoutFn,bubble=getBubble(),bubbleEl=bubble.element,bubbleTop=utils.getPixelValue(bubbleEl.style.top),bubbleBottom=bubbleTop+utils.getPixelValue(bubbleEl.offsetHeight),targetEl=utils.getStepTarget(getCurrStep()),targetBounds=targetEl.getBoundingClientRect(),targetElTop=targetBounds.top+utils.getScrollTop(),targetElBottom=targetBounds.bottom+utils.getScrollTop(),targetTop=targetElTop>bubbleTop?bubbleTop:targetElTop,targetBottom=bubbleBottom>targetElBottom?bubbleBottom:targetElBottom,windowTop=utils.getScrollTop(),windowBottom=windowTop+utils.getWindowHeight(),scrollToVal=targetTop-getOption("scrollTopMargin");targetTop>=windowTop&&(targetTop<=windowTop+getOption("scrollTopMargin")||windowBottom>=targetBottom)?cb&&cb():getOption("smoothScroll")?typeof YAHOO!==undefinedStr&&typeof YAHOO.env!==undefinedStr&&typeof YAHOO.env.ua!==undefinedStr&&typeof YAHOO.util!==undefinedStr&&typeof YAHOO.util.Scroll!==undefinedStr?(scrollEl=YAHOO.env.ua.webkit?document.body:document.documentElement,yuiEase=YAHOO.util.Easing?YAHOO.util.Easing.easeOut:void 0,yuiAnim=new YAHOO.util.Scroll(scrollEl,{scroll:{to:[0,scrollToVal]}},getOption("scrollDuration")/1e3,yuiEase),yuiAnim.onComplete.subscribe(cb),yuiAnim.animate()):hasJquery?jQuery("body, html").animate({scrollTop:scrollToVal},getOption("scrollDuration"),cb):(0>scrollToVal&&(scrollToVal=0),direction=windowTop>targetTop?-1:1,scrollIncr=Math.abs(windowTop-scrollToVal)/(getOption("scrollDuration")/10),(scrollTimeoutFn=function(){var scrollTop=utils.getScrollTop(),scrollTarget=scrollTop+direction*scrollIncr;return direction>0&&scrollTarget>=scrollToVal||0>direction&&scrollToVal>=scrollTarget?(scrollTarget=scrollToVal,cb&&cb(),void window.scrollTo(0,scrollTarget)):(window.scrollTo(0,scrollTarget),utils.getScrollTop()===scrollTop?void(cb&&cb()):void setTimeout(scrollTimeoutFn,10))})()):(window.scrollTo(0,scrollToVal),cb&&cb())},goToStepWithTarget=function(direction,cb){var target,step,goToStepFn;currStepNum+direction>=0&&currStepNum+direction<currTour.steps.length?(currStepNum+=direction,step=getCurrStep(),goToStepFn=function(){target=utils.getStepTarget(step),target?(skippedSteps[currStepNum]&&delete skippedSteps[currStepNum],cb(currStepNum)):(skippedSteps[currStepNum]=!0,utils.invokeEventCallbacks("error"),goToStepWithTarget(direction,cb))},step.delay?setTimeout(goToStepFn,step.delay):goToStepFn()):cb(-1)},changeStep=function(doCallbacks,direction){var step,origStep,wasMultiPage,changeStepCb,bubble=getBubble(),self=this;if(bubble.hide(),doCallbacks=utils.valOrDefault(doCallbacks,!0),step=getCurrStep(),step.nextOnTargetClick&&utils.removeEvtListener(utils.getStepTarget(step),"click",targetClickNextFn),origStep=step,wasMultiPage=direction>0?origStep.multipage:currStepNum>0&&currTour.steps[currStepNum-1].multipage,changeStepCb=function(stepNum){var doShowFollowingStep;if(-1===stepNum)return this.endTour(!0);if(doCallbacks&&(doShowFollowingStep=direction>0?utils.invokeEventCallbacks("next",origStep.onNext):utils.invokeEventCallbacks("prev",origStep.onPrev)),stepNum===currStepNum){if(wasMultiPage)return void setStateHelper();doShowFollowingStep=utils.valOrDefault(doShowFollowingStep,!0),doShowFollowingStep?this.showStep(stepNum):this.endTour(!1)}},!wasMultiPage&&getOption("skipIfNoElement"))goToStepWithTarget(direction,function(stepNum){changeStepCb.call(self,stepNum)});else if(currStepNum+direction>=0&&currStepNum+direction<currTour.steps.length){if(currStepNum+=direction,step=getCurrStep(),!utils.getStepTarget(step)&&!wasMultiPage)return utils.invokeEventCallbacks("error"),this.endTour(!0,!1);changeStepCb.call(this,currStepNum)}else if(currStepNum+direction===currTour.steps.length)return this.endTour();return this},loadTour=function(tour){var prop,tourState,tourStateValues,tmpOpt={};for(prop in tour)tour.hasOwnProperty(prop)&&"id"!==prop&&"steps"!==prop&&(tmpOpt[prop]=tour[prop]);return _configure.call(this,tmpOpt,!0),tourState=utils.getState(getOption("cookieName")),tourState&&(tourStateValues=tourState.split(":"),cookieTourId=tourStateValues[0],cookieTourStep=tourStateValues[1],tourStateValues.length>2&&(cookieSkippedSteps=tourStateValues[2].split(",")),cookieTourStep=parseInt(cookieTourStep,10)),this},findStartingStep=function(startStepNum,savedSkippedSteps,cb){var step,target;if(currStepNum=startStepNum||0,skippedSteps=savedSkippedSteps||{},step=getCurrStep(),target=utils.getStepTarget(step))return void cb(currStepNum);if(!target){if(utils.invokeEventCallbacks("error"),skippedSteps[currStepNum]=!0,getOption("skipIfNoElement"))return void goToStepWithTarget(1,cb);currStepNum=-1,cb(currStepNum)}},showStepHelper=function(stepNum){function showBubble(){bubble.show(),utils.invokeEventCallbacks("show",step.onShow)}var step=currTour.steps[stepNum],bubble=getBubble(),targetEl=utils.getStepTarget(step);currStepNum!==stepNum&&getCurrStep().nextOnTargetClick&&utils.removeEvtListener(utils.getStepTarget(getCurrStep()),"click",targetClickNextFn),currStepNum=stepNum,bubble.hide(!1),bubble.render(step,stepNum,function(adjustScroll){adjustScroll?adjustWindowScroll(showBubble):showBubble(),step.nextOnTargetClick&&utils.addEvtListener(targetEl,"click",targetClickNextFn)}),setStateHelper()},setStateHelper=function(){var cookieVal=currTour.id+":"+currStepNum,skipedStepIndexes=winHopscotch.getSkippedStepsIndexes();skipedStepIndexes&&skipedStepIndexes.length>0&&(cookieVal+=":"+skipedStepIndexes.join(",")),utils.setState(getOption("cookieName"),cookieVal,1)},init=function(initOptions){initOptions&&this.configure(initOptions)};this.getCalloutManager=function(){return typeof calloutMgr===undefinedStr&&(calloutMgr=new HopscotchCalloutManager),calloutMgr},this.startTour=function(tour,stepNum){var bubble,currStepNum,skippedSteps={},self=this;if(!currTour){if(!tour)throw new Error("Tour data is required for startTour.");if(!tour.id||!validIdRegEx.test(tour.id))throw new Error("Tour ID is using an invalid format. Use alphanumeric, underscores, and/or hyphens only. First character must be a letter.");currTour=tour,loadTour.call(this,tour)}if(typeof stepNum!==undefinedStr){if(stepNum>=currTour.steps.length)throw new Error("Specified step number out of bounds.");currStepNum=stepNum}if(!utils.documentIsReady())return waitingToStart=!0,this;if("undefined"==typeof currStepNum&&currTour.id===cookieTourId&&typeof cookieTourStep!==undefinedStr){if(currStepNum=cookieTourStep,cookieSkippedSteps.length>0)for(var i=0,len=cookieSkippedSteps.length;len>i;i++)skippedSteps[cookieSkippedSteps[i]]=!0}else currStepNum||(currStepNum=0);return findStartingStep(currStepNum,skippedSteps,function(stepNum){var target=-1!==stepNum&&utils.getStepTarget(currTour.steps[stepNum]);return target?(utils.invokeEventCallbacks("start"),bubble=getBubble(),bubble.hide(!1),self.isActive=!0,void(utils.getStepTarget(getCurrStep())?self.showStep(stepNum):(utils.invokeEventCallbacks("error"),getOption("skipIfNoElement")&&self.nextStep(!1)))):void self.endTour(!1,!1)}),this},this.showStep=function(stepNum){var step=currTour.steps[stepNum];if(utils.getStepTarget(step))return step.delay?setTimeout(function(){showStepHelper(stepNum)},step.delay):showStepHelper(stepNum),this},this.prevStep=function(doCallbacks){return changeStep.call(this,doCallbacks,-1),this},this.nextStep=function(doCallbacks){return changeStep.call(this,doCallbacks,1),this},this.endTour=function(clearState,doCallbacks){var currentStep,bubble=getBubble();return clearState=utils.valOrDefault(clearState,!0),doCallbacks=utils.valOrDefault(doCallbacks,!0),currTour&&(currentStep=getCurrStep(),currentStep&&currentStep.nextOnTargetClick&&utils.removeEvtListener(utils.getStepTarget(currentStep),"click",targetClickNextFn)),currStepNum=0,cookieTourStep=void 0,bubble.hide(),clearState&&utils.clearState(getOption("cookieName")),this.isActive&&(this.isActive=!1,currTour&&doCallbacks&&utils.invokeEventCallbacks("end")),this.removeCallbacks(null,!0),this.resetDefaultOptions(),destroyBubble(),currTour=null,this},this.getCurrTour=function(){return currTour},this.getCurrTarget=function(){return utils.getStepTarget(getCurrStep())},this.getCurrStepNum=function(){return currStepNum},this.getSkippedStepsIndexes=function(){var stepIds,skippedStepsIdxArray=[];for(stepIds in skippedSteps)skippedStepsIdxArray.push(stepIds);return skippedStepsIdxArray},this.refreshBubblePosition=function(){var currStep=getCurrStep();return currStep&&getBubble().setPosition(currStep),this.getCalloutManager().refreshCalloutPositions(),this},this.listen=function(evtType,cb,isTourCb){return evtType&&callbacks[evtType].push({cb:cb,fromTour:isTourCb}),this},this.unlisten=function(evtType,cb){var i,len,evtCallbacks=callbacks[evtType];for(i=0,len=evtCallbacks.length;len>i;++i)evtCallbacks[i]===cb&&evtCallbacks.splice(i,1);return this},this.removeCallbacks=function(evtName,tourOnly){var cbArr,i,len,evt;for(evt in callbacks)if(!evtName||evtName===evt)if(tourOnly)for(cbArr=callbacks[evt],i=0,len=cbArr.length;len>i;++i)cbArr[i].fromTour&&(cbArr.splice(i--,1),--len);else callbacks[evt]=[];return this},this.registerHelper=function(id,fn){"string"==typeof id&&"function"==typeof fn&&(helpers[id]=fn)},this.unregisterHelper=function(id){helpers[id]=null},this.invokeHelper=function(id){var i,len,args=[];for(i=1,len=arguments.length;len>i;++i)args.push(arguments[i]);helpers[id]&&helpers[id].call(null,args)},this.setCookieName=function(name){return opt.cookieName=name,this},this.resetDefaultOptions=function(){return opt={},this},this.resetDefaultI18N=function(){return customI18N={},this},this.getState=function(){return utils.getState(getOption("cookieName"))},_configure=function(options,isTourOptions){var bubble,eventPropName,i,len,events=["next","prev","start","end","show","error","close"];for(opt||this.resetDefaultOptions(),utils.extend(opt,options),options&&utils.extend(customI18N,options.i18n),i=0,len=events.length;len>i;++i)eventPropName="on"+events[i].charAt(0).toUpperCase()+events[i].substring(1),options[eventPropName]&&this.listen(events[i],options[eventPropName],isTourOptions);return bubble=getBubble(!0),this},this.configure=function(options){return _configure.call(this,options,!1)},this.setRenderer=function(render){var typeOfRender=typeof render;return"string"===typeOfRender?(templateToUse=render,customRenderer=void 0):"function"===typeOfRender&&(customRenderer=render),this},this.setEscaper=function(esc){return"function"==typeof esc&&(customEscape=esc),this},init.call(this,initOptions)},winHopscotch=new Hopscotch,function(){var _={};_.escape=function(str){return customEscape?customEscape(str):null==str?"":(""+str).replace(new RegExp("[&<>\"']","g"),function(match){return"&"==match?"&amp;":"<"==match?"&lt;":">"==match?"&gt;":'"'==match?"&quot;":"'"==match?"&#x27;":void 0})},this.templates=this.templates||{},this.templates.bubble_default=function(obj){function optEscape(str,unsafe){return unsafe?_.escape(str):str}obj||(obj={});var __t,__p="";_.escape,Array.prototype.join;with(obj)__p+='\n<div class="hopscotch-bubble-container" style="width: '+(null==(__t=step.width)?"":__t)+"px; padding: "+(null==(__t=step.padding)?"":__t)+'px;">\n  ',tour.isTour&&(__p+='<span class="hopscotch-bubble-number">'+(null==(__t=i18n.stepNum)?"":__t)+"</span>"),__p+='\n  <div class="hopscotch-bubble-content">\n    ',""!==step.title&&(__p+='<h3 class="hopscotch-title">'+(null==(__t=optEscape(step.title,tour.unsafe))?"":__t)+"</h3>"),__p+="\n    ",""!==step.content&&(__p+='<div class="hopscotch-content">'+(null==(__t=optEscape(step.content,tour.unsafe))?"":__t)+"</div>"),__p+='\n  </div>\n  <div class="hopscotch-actions">\n    ',buttons.showPrev&&(__p+='<button class="hopscotch-nav-button prev hopscotch-prev">'+(null==(__t=i18n.prevBtn)?"":__t)+"</button>"),__p+="\n    ",buttons.showCTA&&(__p+='<button class="hopscotch-nav-button next hopscotch-cta">'+(null==(__t=buttons.ctaLabel)?"":__t)+"</button>"),__p+="\n    ",buttons.showNext&&(__p+='<button class="hopscotch-nav-button next hopscotch-next">'+(null==(__t=i18n.nextBtn)?"":__t)+"</button>"),__p+="\n  </div>\n  ",buttons.showClose&&(__p+='<button class="hopscotch-bubble-close hopscotch-close">'+(null==(__t=i18n.closeTooltip)?"":__t)+"</button>"),__p+='\n</div>\n<div class="hopscotch-bubble-arrow-container hopscotch-arrow">\n  <div class="hopscotch-bubble-arrow-border"></div>\n  <div class="hopscotch-bubble-arrow"></div>\n</div>';return __p}}.call(winHopscotch),winHopscotch});