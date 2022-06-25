var sDocumentFileName="";var oAskWebHR;var sMessenger_ActiveChats="";$(window).scroll(function(){var sticky=$(".whrtn"),scroll=$(window).scrollTop();if(scroll>=1)sticky.addClass("whrtn_sticky");else sticky.removeClass("whrtn_sticky");});function jsOpenWindow(filename,width,height)
{window.open(filename,"Window_"+Math.floor(Math.random()*110),"toolbar=no,width="+width+",height="+height+",directories=no,status=yes,location=no,scrollbars=yes,resizable=yes,menubar=no");}
function Drawer(sURL,sDirection)
{dDrawer=document.getElementById("divDrawer");if((sDirection!="")&&(sDirection!="bottom"))
dDrawer.placement=sDirection;dDrawer.show();AjaxPage2(sURL,"divDrawerContents");}
function DrawerClose()
{dDrawer=document.getElementById("divDrawer");dDrawer.hide();}
function SAlert(sMessage,sFieldName)
{$("#"+sFieldName).focus();Swal.fire("",sMessage,"error");return(false);}
function NavMenu(sPage,sData="")
{$(".whrsb_icon").removeClass("whrsb_open whr_theme_bg_Dark");$("#nav"+sPage+"_Icon").addClass("whrsb_open whr_theme_bg_Dark");sPage="../get/?t="+cAccessToken+"&page="+sPage+sData;AjaxPage(sPage,"divMain");}
function NavSubMenu(sLink,sKey)
{$(".whrsb2_menu").removeClass("whrsb2_menu_active whr_theme_bg whr_theme_Button");$("#"+sKey+"_sm").addClass("whrsb2_menu_active whr_theme_bg whr_theme_Button");sPage="../get/?t="+cAccessToken+sLink;AjaxPage(sPage,"divContainer");}
function Open(sLink,sContainerId,sType="",sPage="")
{Pace.restart();if(sType=="SubModule")
NavMenu(sPage,sLink);else
$("#"+sContainerId).load("../get/?t="+cAccessToken+"&"+sLink);}
function SAlertSuccess(sMessage)
{Swal.fire("",sMessage,"success");}
function ColorBox(sURL,sWidth,sHeight,sCallbackFunction)
{if(sWidth==undefined)sWidth="700px";if(sHeight==undefined)sHeight="620px";$.colorbox({href:sURL,width:sWidth,height:sHeight,trapFocus:false,onComplete:function(){sCallbackFunction();},});}
function ei(iEmployeeId)
{$.colorbox({href:"../pages/?page=Employees_EmployeeInfo&id="+iEmployeeId,width:"700px;",height:"620px;"});}
function SAlertInfo(sMessage)
{Swal.fire("",sMessage,"info");}
function UIElements(aParams)
{sReturn="";switch(aParams["Type"])
{case "Flag":sReturn=`<sl-tooltip content="`+aParams["CountryName"]+`"><i class="flag flag-`+aParams["Value"]+`" title="`+aParams["CountryName"]+`"></i></sl-tooltip>`;break;case "5Stars":for(i=1;i<=5;i++)
sReturn+=`<i style="color:`+((aParams["Value"]>=i)?`#2179c0`:`#d7d7d7`)+`;" class="fa fa-star"></i>`;break;case "5Lines":aColors=['#d7d7d7','#29a94d','#93bf42','#f4e22c','#ea922b','#e62c29'];sLines="";for(i=1;i<=5;i++)
sLines+=`<td><div style="height:3px; width:100%; background-color:`+((aParams["Value"]>=i)?aColors[i]:`#d7d7d7`)+`;"></div></td>`;sReturn=`<table border="0" style="width:100%;"><tr>`+sLines+`</tr></table>`;break;case "Panels_Organization":sReturn=">>"+aParams["Value"];break;}
return(sReturn);}
function MAlert(sTitle,sMessage)
{iziToast.show({title:sTitle,message:sMessage,position:"bottomLeft",iconColor:"rgb(255, 255, 255)",backgroundColor:"rgb(255,255,255)",transitionIn:"flipInX",transitionOut:"flipOutX",progressBarColor:"rgb(7, 66, 108)",layout:2,onClosing:function(){},onClosed:function(instance,toast,closedBy){},});}
function WebHRMessage(sTitle,sMessage,sPosition)
{iziToast.show({title:sTitle,message:sMessage,position:sPosition,iconColor:"rgb(255, 255, 255)",backgroundColor:"rgb(255,255,255)",transitionIn:"flipInX",transitionOut:"flipOutX",progressBarColor:"rgb(7, 66, 108)",image:cCDN+"/images/Logo/Variations/WebHR_320x320.jpg",imageWidth:120,layout:2,onClosing:function(){},onClosed:function(instance,toast,closedBy){},});}
function Encode(sString)
{if(sString=="0")return(0);if(sString==null)return("");if(sString=="")return("");if(typeof sString==='string'||sString instanceof String)
{sString=sString.replace(/'/g,"&#39;");sString=sString.replace(/"/g,"&#34;");sString=sString.replace(/</g,"&#60;");sString=sString.replace(/>/g,"&#62;");}
sString=encodeURIComponent(sString);return(sString);}
function MessengerPopUp(sTitle,sMessage,sType,sPosition,sIcon)
{if(sPosition=="")sPosition="topRight";if(sIcon=="")sIcon="fa fa-bell";if(sType=="")sType="info";if(sType=="info")
{iziToast.info({title:sTitle,message:sMessage,position:sPosition,layout:2,icon:sIcon});}
else if(sType=="success")
{iziToast.success({title:sTitle,message:sMessage,layout:2,position:sPosition});}
else if(sType=="warning")
{iziToast.warning({title:sTitle,message:sMessage,layout:2,position:sPosition});}
else if(sType=="error")
{iziToast.error({title:sTitle,message:sMessage,layout:2,position:sPosition});}}
function SearchEmployees(sTargetListBoxName,sSearch,iMultiple,iFilters_CompanyId,iFilters_StationId,iFilters_DepartmentId)
{if(iMultiple=="")iMultiple=0;$.colorbox({href:"../get/?t="+cAccessToken+"&page=Employees&type=SearchEmployees&target="+Encode(sTargetListBoxName)+"&search="+Encode(sSearch)+"&multiple="+iMultiple+"&f_c="+iFilters_CompanyId+"&f_s="+iFilters_StationId+"&f_d="+iFilters_DepartmentId,width:"700px;",height:"620px;",onComplete:function(){$("#empsearch").focus();}});return(false);}
function AlertFocus(sMessage,sControl)
{SAlert(sMessage);$("#"+sControl).focus();return(false);}
function Modal(sURL,bBgClick=true)
{$.magnificPopup.open({type:"ajax",closeOnBgClick:bBgClick,items:{src:sURL},overflowY:"scroll"});$.magnificPopup.instance._onFocusIn=function(e){if($(e.target).hasClass('select2-search__field')){return true;}
$.magnificPopup.proto._onFocusIn.call(this,e);};}
function ModalClose()
{$.magnificPopup.close();}
function Help_FullScreen()
{var elem=document.getElementById("divHelp");if(elem.requestFullscreen)
elem.requestFullscreen();else if(elem.webkitRequestFullscreen)
elem.webkitRequestFullscreen();else if(elem.msRequestFullscreen)
elem.msRequestFullscreen();}
function isValidUserName(val){if(val.match(/^[a-z0-9_.@-]+$/))
return true;else
return false;}
var sSpeakVoice;var bWebHRBot_WindowOpen=false;var bWebHRBot_FirstMessage=true;function WebHRBot()
{if(bWebHRBot_WindowOpen==true)
{WebHRBot_Close();return("");}
$("#whbotn").hide();WebHRBot_Open();$("#whbotc").slimScroll({height:"434px"});bWebHRBot_WindowOpen=true;}
function WebHRBot_Open()
{$("#whbot").fadeIn();$("#whbota").focus();}
function WebHRBot_Ask(sPhoto,sTime,sConversationId)
{$("#whbotc").append('<div style="float:left; width:70px;"><img src="'+sPhoto+'" style="width:60px; height:60px; background-repeat: no-repeat; background-position: 50%; border-radius: 50%;" /></div><div style="margin-left:70px;" class="WebHR_ChatBubble2"><strong>You</strong>&nbsp;&nbsp;&nbsp;<span style="color:#a1a1a1;">'+sTime+'</span><br />'+$("#whbota").val()+'</div><div style="clear:both; height:10px;"></div>');AjaxPage2("../get/?page=WebHRBot&type=Ask&a="+Encode($("#whbota").val())+"&cid="+Encode(sConversationId)+"&t="+cAccessToken,"divExecute");return(false);}
function WebHRBot_Close()
{bWebHRBot_WindowOpen=false;$("#whbot").fadeOut();}
function Speak(text,callback)
{var u=new SpeechSynthesisUtterance();u.text=text;u.lang="en-US";u.voice=sSpeakVoice;u.onend=function(){if(callback)callback();};u.onerror=function(e){if(callback)callback(e);};speechSynthesis.speak(u);}
function AskWebHR_Start()
{oAskWebHR=new webkitSpeechRecognition();oAskWebHR.onstart=function(event){AskWebHR_UpdateMic();};oAskWebHR.onresult=function(event)
{var text="";for(var i=event.resultIndex;i<event.results.length;++i){text+=event.results[i][0].transcript;}
AskWebHRProcess(text);AskWebHR_Stop();};oAskWebHR.onend=function(){AskWebHR_Stop();};oAskWebHR.lang="en-US";oAskWebHR.start();}
function AskWebHRProcess(text)
{AjaxPage2("../pages/?page=AskWebHR&type=Ask&a="+Encode(text),"divExecute");}
function AskWebHR_Stop()
{if(oAskWebHR)
{oAskWebHR.stop();oAskWebHR=null;}
AskWebHR_UpdateMic();}
function AskWebHR()
{if(oAskWebHR)
AskWebHR_Stop();else
AskWebHR_Start();}
function AskWebHR_UpdateMic()
{if(oAskWebHR)
$("#awhrmic").css("color","#ff0000");else
$("#awhrmic").css("color","#ff8a00");}
function number_format(number,decimals,decPoint,thousandsSep)
{number=(number+'').replace(/[^0-9+\-Ee.]/g,'')
const n=!isFinite(+number)?0:+number
const prec=!isFinite(+decimals)?0:Math.abs(decimals)
const sep=(typeof thousandsSep==='undefined')?',':thousandsSep
const dec=(typeof decPoint==='undefined')?'.':decPoint
let s=''
const toFixedFix=function(n,prec){if((''+n).indexOf('e')===-1){return+(Math.round(n+'e+'+prec)+'e-'+prec)}else{const arr=(''+n).split('e')
let sig=''
if(+arr[1]+prec>0){sig='+'}
return(+(Math.round(+arr[0]+'e'+sig+(+arr[1]+prec))+'e-'+prec)).toFixed(prec)}}
s=(prec?toFixedFix(n,prec).toString():''+Math.round(n)).split('.')
if(s[0].length>3){s[0]=s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g,sep)}
if((s[1]||'').length<prec){s[1]=s[1]||''
s[1]+=new Array(prec-s[1].length+1).join('0')}
return s.join(dec);}
function WebHRSearch(sSearch)
{AjaxPage("../get/?t="+cAccessToken+"&page=Search&type=Search&search="+Encode(sSearch),"divMain");return(false);}
$(function()
{$("#whrsearch").on("click",function(){$(this).select();});$("#whrsearch").autocomplete({source:function(request,response){$.ajax({url:"../get/?t="+cAccessToken+"&page=Search&type=QuickSearch",dataType:"json",data:{term:Encode(request.term)},success:function(data){response(data);}});},minLength:1,select:function(event,ui)
{var aReturn=ui.item.value.split(",");if(aReturn[0]=="Employee")
Open("page=Profile&u="+aReturn[1],"divMain");else if(aReturn[0]=="Module")
Open("&cmp="+aReturn[2].trim(),"divMain","SubModule",aReturn[1].trim());else if(aReturn[0]=="Help")
{$("#divBlur").show();$("#divNavigationDrawer").drawer("toggle");AjaxPage("../pages/?page=Help"+aReturn[1],"divNavigationDrawerContents");}
return(false);}}).data("ui-autocomplete")._renderItem=function(ul,item){return $("<li></li>").data("item.autocomplete",item).append("<a>"+item.label+"</a>").appendTo(ul);};});function OpenLeftNav()
{$("#tdLeftPanel").hide();$("#tdLeftPanelWithText").show();}
function CloseLeftNav()
{$("#tdLeftPanel").show();$("#tdLeftPanelWithText").hide();}
function Menu_Mobile(sPage,sType,sTheme)
{if(!$("#mnav_"+sPage).is(":visible"))
$(".mNav").hide();$("[id$=_Icon]").removeClass("Menu-Enabled_"+sTheme);$("#nav"+sPage+"_Icon").addClass("Menu-Enabled_"+sTheme);$("#mnav"+sPage+"_Icon").addClass("Menu-Enabled_"+sTheme);if(sPage=="More")
$("#mnav_"+sPage).slideToggle(200);else
AjaxPage("../get/?t="+cAccessToken+"&page=Navigation&m="+sPage+"","WebHRMain");}
function isAlphaNumeric(val)
{if(val.match(/^[a-zA-Z0-9]+$/))
return true;else
return false;}
function isNumeric(val){if(val.match(/^[0-9|.]+$/))
return true;else
return false;}
function isDate(val){if(val.match(/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/))
return true;else
return false;}
function isDateTime(val){if(val.match(/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}$/))
return true;else
return false;}
function isTime(val){if(val.match(/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/))
return true;else
return false;}
function IsEmail(email){var regex=/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;return regex.test(email);}
function isEmailAddress(val){if(val.match(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9- ]+)*(\.[a-z]{2,3})+/))
return true;else
return false;}
function MultiDimensionalArray(iRows,iCols){var i;var j;var a=new Array(iRows);for(i=0;i<iRows;i++)
{a[i]=new Array(iCols);for(j=0;j<iCols;j++)
a[i][j]="";}
return(a);}
function addCommas(nStr){nStr+='';x=nStr.split('.');x1=x[0];x2=x.length>1?'.'+x[1]:'';var rgx=/(\d+)(\d{3})/;while(rgx.test(x1)){x1=x1.replace(rgx,'$1'+','+'$2');}
return x1+x2;}
function AjaxPage(url,containerid)
{Pace.restart();$("#"+containerid).load(url);}
function AjaxPage2(url,containerid){$("#"+containerid).load(url);}
function AjaxPage3(url,containerid,buttonid)
{}
var aConferenceRoomUsers=[];function ConferenceRoom_Message(sUserName,iEmployeeId,sEmployeeName,sEmployeePhoto,sMessage,bNotify,sCDN,iConferenceRoomId)
{if(sCurrentPage=="ConferenceRoom")
{if(iConferenceRoom_CurrentRoomId==iConferenceRoomId)
{$("#divConferenceRoomChat").append('<table style="width:95%;"><tr><td style="width:60px;"><img src="'+sEmployeePhoto+'" style="background-repeat: no-repeat; background-position: 50%; border-radius: 50%; width: 50px; height: 50px;" /></td><td><div style="width:100%; font-size:12px;" class="WebHR_ChatBubble"><strong>'+sEmployeeName+'</strong> | <span style="color:#a1a1a1;">'+moment().format("MMMM D, Y - h:mm a")+'</span><br />'+sMessage+'</td></tr></table><div style="height:4px; clear:both;"></div>');var scrollTo_val=$("#divConferenceRoomChat").prop("scrollHeight")+"px";$("#divConferenceRoomChat").slimScroll({scrollTo:scrollTo_val,railVisible:true,alwaysVisible:true});}}
else
{$("#nConferenceRoomMessages").show();$("#nConferenceRoomMessages").append('<audio src="'+sCDN+'/audio/Message.mp3" type="audio/mpeg" autoplay></audio>');}
if(bNotify)
{}}
function ConferenceRoom_Announce(iEmployeeId,sAnnouncement)
{}
function ConferenceRoom_Users(data)
{aConferenceRoomUsers=data;if(sCurrentPage=="ConferenceRoom")
{$("#divCR_Online").html("");for(i=0;i<data.length;i++)
{$("#divCR_Online").append('<div style="margin-left:4px;"><i class="fa fa-dot-circle WebHR_Green"></i><span class="WebHR_Green" style="margin-left:6px; font-size:14px;">'+data[i]["n"]+'</span></div>');}}}
function ConferenceRoom_SendMessage(sOrganizationCode,sOrganizationToken,sUserName,iEmployeeId,sEmployeeName,sEmployeePhoto,iConferenceRoomId){var sMessage=$("#crm").val();ConferenceRoom_Message(sUserName,iEmployeeId,sEmployeeName,sEmployeePhoto,sMessage,false,"",iConferenceRoomId);socket.emit("cr",{org:sOrganizationCode,token:sOrganizationToken,e:sUserName,e:iEmployeeId,n:sEmployeeName,p:sEmployeePhoto,m:sMessage,r:iConferenceRoomId});$("#crm").val("");return(false);}
var iMessenger_CurrentWindow=0;var bMessenger_WindowOpen=false;function Messenger_SendMessage(iMessengerId,aMessageFrom,aMessageTo,sMessage)
{if($("#whmsgrc"+aMessageTo["EmployeeId"]+"_cm").html().indexOf("images/Characters/Character1_Speak.png")>0)
$("#whmsgrc"+aMessageTo["EmployeeId"]+"_cm").html("");$("#whmsgrc"+aMessageTo["EmployeeId"]+"_cm").append('<table style="width:95%;"><tr><td style="width:60px;"><img src="'+cAssets+'/ep/'+sOrganizationCode+'_'+aMessageFrom["Photo"]+'.jpg" style="background-repeat: no-repeat; background-position: 50%; border-radius: 50%; width: 50px; height: 50px;" /></td><td><div style="width:100%; font-size:12px;" class="WebHR_ChatBubble"><strong>'+aMessageFrom["EmployeeName"]+'</strong> | <span class="WebHRColor2">'+$("#whmsgrc"+aMessageTo["EmployeeId"]+"_cmt").val()+'</span><br />'+sMessage+'</div></td></tr></table><div style="height:4px; clear:both;"></div>');var scrollTo_val=$("#whmsgrc"+aMessageTo["EmployeeId"]+"_cm").prop("scrollHeight")+"px";$("#whmsgrc"+aMessageTo["EmployeeId"]+"_cm").slimScroll({scrollTo:scrollTo_val,railVisible:true,alwaysVisible:true});socket.emit("m",{org:sOrganizationCode,token:sOrganizationToken,f:aMessageFrom,t:aMessageTo,msg:sMessage,mid:iMessengerId});$("#whmsgrc"+aMessageTo["EmployeeId"]+"_cmt").val(moment().format("MMMM D, Y - h:mm a"));$("#whmsgrc"+aMessageTo["EmployeeId"]+"_cb").val("");return(false);}
function Messenger_Open()
{Messenger_CloseWindows();$("#whmsgr").fadeIn();Messenger_GetChatHistory();}
function Messenger_Close()
{bMessenger_WindowOpen=false;Messenger_CloseWindows();$("#whmsgr").fadeOut();}
function Messenger_Chat(iEmployeeId,iRemove)
{AjaxPage2("../pages/?page=Messenger&type=Messenger_Chat&e="+iEmployeeId+"&ac="+sMessenger_ActiveChats+"&r="+iRemove,"divExecute");}
function Messenger_OpenChat(iEmployeeId)
{if(iMessenger_CurrentWindow==iEmployeeId)
{Messenger_Close();Messenger_CloseWindows();Messenger_CloseChat(iEmployeeId);}
else
{Messenger_Close();Messenger_CloseWindows();$("#whmsgr"+iEmployeeId).fadeIn();iMessenger_CurrentWindow=iEmployeeId;}}
function Messenger_CloseChat(iEmployeeId)
{iMessenger_CurrentWindow=0;$("#whmsgr"+iEmployeeId).fadeOut();}
function Messenger_CloseWindows()
{iMessenger_CurrentWindow=0;aTemp=sMessenger_ActiveChats.split(",");for(i=0;i<aTemp.length;i++)
Messenger_CloseChat(aTemp[i]);}
function EmployeePhoto(sPhoto,iGender)
{var sReturn="";if(sPhoto=="")
sReturn='<img style="background-repeat: no-repeat; background-position: 50%; border-radius: 50%; height:40px; width: 40px;" src="'+cCDN+'/images/Photo/NoPhoto.png">';else
sReturn='<img style="background-repeat: no-repeat; background-position: 50%; border-radius: 50%; height:40px; width: 40px;" src="'+cAssets+'/ep/'+sOrganizationCode+'_'+sPhoto+'.jpg">';return(sReturn);}
function Messenger_OnlineClick()
{if(bMessenger_WindowOpen==true)
{Messenger_Close();return("");}
$("#whmsgrn").hide();Messenger_Open();$("#whmsgrc").slimScroll({height:"434px"});bMessenger_WindowOpen=true;}
function Messenger_Online(iEmployeeId)
{var sMessengerUsers="";if(bMessenger_WindowOpen==true)
{Messenger_Close();return("");}
$("#whmsgrn").hide();Messenger_Open();let iActiveUsers=0;for(i=0;i<aConferenceRoomUsers.length;i++)
{aTemp=aConferenceRoomUsers[i];if(aTemp["e"]==iEmployeeId)
continue;iActiveUsers+=1;sMessengerUsers+="<a href=\"#\" onclick=\"Messenger_Chat("+aTemp["e"]+", 0);\" id=\"mcou_"+aTemp["e"]+"\"><li class=\"list-group-item borderless\"><div style=\"display: flex;\"> <div> "+EmployeePhoto(aTemp["p"])+" <div style=\"width: 14px;height: 14px;background-color: #62bd19;border-radius: 50%;position: absolute;top: 12px;left: 20px;border: 2px solid #fff;\"></div> </div> <div style=\"padding-left: 1em; align-items: center;\" class=\"d-flex w-100 justify-content-between\"> <h5 class=\"mb-1\" style=\"font-size: 16px !important;color: #3F3D56;\">"+aTemp["n"]+"</h5></div> </div> </li></a>";}
if(sMessengerUsers=="")
{sMessengerUsers="<div style=\"margin-top:20px; font-size:15px;\" align=\"center\"><img src=\""+cCDN+"/images/Characters/Character1_Lost.png\" style=\"height:200px;\" /><br />Looks like no one is Online right now!</div>";}
$("#whmsgrc").html(sMessengerUsers);$("#au").html(iActiveUsers);$("#whmsgrc").slimScroll({height:"434px"});bMessenger_WindowOpen=true;}
function Messenger(aMessageFrom,aMessageTo,sMessage,bNotify)
{if(iMessenger_CurrentWindow==aMessageFrom["EmployeeId"])
{$("#whmsgrc"+aMessageFrom["EmployeeId"]+"_cm").append('<table style="width:95%;"><tr><td style="width:60px;"><img src="'+cAssets+'/ep/'+sOrganizationCode+'_'+aMessageFrom["Photo"]+'.jpg" style="background-repeat: no-repeat; background-position: 50%; border-radius: 50%; width: 50px; height: 50px;" /></td><td><div style="width:100%; font-size:12px;" class="WebHR_ChatBubble2"><strong>'+aMessageFrom["EmployeeName"]+'</strong> | <span class="WebHRColor2">'+$("#whmsgrc"+aMessageFrom["EmployeeId"]+"_cmt").val()+'</span><br />'+sMessage+'</div></td></tr></table><div style="height:4px; clear:both;"></div>');var scrollTo_val=$("#whmsgrc"+aMessageFrom["EmployeeId"]+"_cm").prop("scrollHeight")+"px";$("#whmsgrc"+aMessageFrom["EmployeeId"]+"_cm").slimScroll({scrollTo:scrollTo_val,railVisible:true,alwaysVisible:true});}
else
{$("#whmsgrn").show();$("#divExecute").append('<audio src="'+cCDN+'/audio/Message.mp3" type="audio/mpeg" autoplay></audio>');}
if(bNotify)
{var myNotification=new Notify("WebHR Messenger",{body:sMessage,tag:"WebHR",timeout:4});myNotification.show();}}
function Messenger_GetChatHistory()
{AjaxPage2("../pages/?page=Messenger&type=GetMessengerChatHistory","whmsgr_ch");}
function Messenger_GetOnlineUsers()
{AjaxPage2("../pages/?page=Messenger&type=Messenger_GetOnlineUsers","whmsgrc_ou");}
if(Notify.needsPermission){if(Notify.isSupported())Notify.requestPermission();}
function WebHRAlerts()
{AjaxPage2("../get/?t="+cAccessToken+"&page=Alerts&type=Alerts","divAlerts");}
function WebHRAlerts_Counter(iAlerts)
{iWebHR_Notifications=iAlerts;$("#nNotifications").html(iAlerts);}
function WebHRAlerts_MarkAsRead(sModuleName,iModuleId,ev)
{AjaxPage2("../get/?t="+cAccessToken+"&page=Alerts&type=Alerts&action=MarkAsRead&mod="+Encode(sModuleName)+"&id="+Encode(iModuleId),"divAlerts");ev.stopPropagation();}
function WebHRAlert_MarkAllAsRead(ev)
{AjaxPage2("../get/?t="+cAccessToken+"&page=Alerts&type=Alerts&action=MarkAllAsRead","divAlerts");ev.stopPropagation();}
function WebHRAlert(sData,bSound)
{aData=sData.split("~");iWebHR_Notifications++;sMessage=aData[3];sAlertLink=aData[4];sTimeSince=aData[5];iAlertId=aData[6];sEmployeeName=aData[7];sPhoto=atob(aData[8]);WebHRAlerts_Counter(iWebHR_Notifications);if(bSound==true)
$("#divExecute").append('<audio src="'+sCDN+'/audio/Notification.mp3" type="audio/mpeg" autoplay></audio>');var myNotification=new Notify("WebHR",{body:sMessage,tag:"WebHR",icon:"https://cdn.webhr.co/images/logo.png",timeout:4});myNotification.show();}
function UserIdle(sUserName,sToken)
{AjaxPage2("../pages/?page=Security&type=EmployeeIsIdle","divExecute");Swal.fire({title:"<div class=\"WebHR_Title\" align=\"center\"><img style=\"height:60px;\" src=\""+cCDN+"/images/Logo/WebHR.png\" /><br /><br />System Locked due to Inactivity<div style=\"margin-top:8px; font-size:15px; font-family:Tahoma, Arial;\">We've temporarily locked the screen for your security. Please re-enter your password to continue or refresh the screen and log in again.</div></div>",input:"password",inputPlaceholder:"Please enter your password...",showLoaderOnConfirm:true,width:600,allowEscapeKey:false,allowOutsideClick:false,backdrop:'url("https://cdn.webhr.co/images/Backgrounds/Blur.png") 100% 100%',confirmButtonText:"Login",preConfirm:(login)=>{return fetch("../login/?action=ValidateEmployee&u="+Encode(sUserName)+"&t="+Encode(sToken)+"&p="+btoa(login)).then(response=>{if(!response.ok){throw new Error("Invalid Password...")}
return response.json()}).catch(error=>{Swal.showValidationMessage(error);})},})}
function UserIdle2()
{AjaxPage2("../pages/?page=Security&type=EmployeeIsIdle","divExecute");Swal.fire({title:"<div class=\"WebHR_Title\" align=\"center\"><img style=\"height:60px;\" src=\""+cCDN+"/images/Logo/WebHR.png\" /><br /><br />System Locked due to Inactivity<div style=\"margin-top:8px; font-size:15px; font-family:Tahoma, Arial;\">We've temporarily locked the screen for your security.<br /><br />Please click Login button below to log back in.</div></div>",width:600,allowEscapeKey:false,allowOutsideClick:false,backdrop:'url("https://cdn.webhr.co/images/Backgrounds/Blur.png") 100% 100%',confirmButtonText:"Login",preConfirm:(login)=>{Swal.showValidationMessage("Please Wait...");window.location.href="../login/?action=logout";},});}
function Reports_LocalValue(sReportName,sValueName,bMultiple)
{if(bMultiple==null)bMultiple=false;lf.getItem("WebHR_Reports_"+sReportName,function(err,value)
{if(value!=null)
{sResult=decodeURI(QueryConvert(value)[sValueName]);if(sResult!=undefined)
{if(bMultiple==true)
$("#"+sValueName).val(sResult.split(",")).trigger("change");else
$("#"+sValueName).val(sResult);}}});}
function Reports_ResetFilters(sReportType,sReportName,sReportTitle)
{lf.setItem("WebHR_Reports_"+sReportName,null);AjaxPage("../get/?t="+cAccessToken+"&page=ReportsFilters&type="+sReportType+"&report="+sReportName+"&rt="+sReportTitle+"&action=ResetFilters","divMenusContainer");}
function QueryConvert(sQueryString)
{queryArr=sQueryString.replace('?','').split('&'),queryParams=[];for(var q=0,qArrLength=queryArr.length;q<qArrLength;q++)
{var qArr=queryArr[q].split('=');queryParams[qArr[0]]=qArr[1];}
return queryParams;}
function AddNewEmployees(sMultipleEmployees,sListBoxName)
{sAddEmployeesString=sMultipleEmployees;aMultipleEmployees=sMultipleEmployees.split("~");for(i=0;i<aMultipleEmployees.length;i++)
{aEmployeeInfo=aMultipleEmployees[i].split("|");if(aEmployeeInfo.length>2)
{iEmployeeId=aEmployeeInfo[0];sEmployeeName=aEmployeeInfo[1];AddEmployeeToList(iEmployeeId,sEmployeeName,sListBoxName);}}}
function RemoveSelectedEmployees(sListBoxName)
{if(document.getElementById(sListBoxName).selectedIndex<0)
{}
else
{var options=document.getElementById(sListBoxName).options;for(var i=options.length-1;i>=0;i--)
if(options[i].selected)
options[i]=null;return false;}}
function AddEmployees(sListBoxName)
{var listLength=document.getElementById(sListBoxName).length;for(i=0;i<listLength;i++)
document.getElementById(sListBoxName).options[i].selected=true;document.getElementById('EmployeesString').value=sAddEmployeesString;return(true);}
function AddEmployeeToList(iEmployeeId,sEmployeeName,sListBoxName)
{maxLength=100;list=document.getElementById(sListBoxName);var listLength=list.length;if((listLength+1)>maxLength)
{alert("Cannot add more than "+maxLength+" employees!");return false;}
var targetIndex=listLength;for(x=0;x<list.length;x++)
if(list.options[x].value==iEmployeeId)
return false;list.options[targetIndex]=new Option(iEmployeeId);list.options[targetIndex].value=iEmployeeId;list.options[targetIndex].text=sEmployeeName;return true;}
function SelectEmployee(selListBoxName,iEmployeeId)
{document.getElementById(selListBoxName).value=iEmployeeId;}
function StatusHistory_ChangeAction(sAction)
{if(sAction=="Forward")
ShowDiv("divForwardTo");else
HideDiv("divForwardTo");}
function ShowHideMCQAnswers()
{iQuestionType=$("#selQuestionType").val();if(iQuestionType==0)$("#divAddMCQAnswers").slideDown(800);else if(iQuestionType==1)$("#divAddMCQAnswers").slideUp(800);}
function ThingsToDo_ShowEditTask(iTaskId)
{$("#divUpdateTask1_"+iTaskId).hide();$("#divUpdateTask2_"+iTaskId).css("display","inline");}
function ThingsToDo_EditTask(iTaskId)
{if($("#txtEditTask_"+iTaskId).val()=="")return(false);AjaxPage("../home/pages.php?page=ThingsToDo_Tasks&action=EditTask&id="+Encode(iTaskId)+"&task="+Encode($("#txtEditTask_"+iTaskId).val()),"divThingsToDo_Tasks");return(false);}
function ThingsToDo_AddNewTask()
{if($("#txtAddNewTask").val()=="")return(false);AjaxPage("../home/pages.php?page=ThingsToDo_Tasks&action=AddTask&id=0&task="+Encode($("#txtAddNewTask").val()),"divThingsToDo_Tasks");$("#txtAddNewTask").val("");$("#divAddNewTask").hide();return(false);}
function ChangePayslipType(iPayslipType)
{$("#divMonthlySalary").hide();$("#divHourlyWages").hide();if(iPayslipType==0)
$("#divMonthlySalary").show();else
$("#divHourlyWages").show();}
function EmployeeLeavesQuota()
{var iEmployeeId=$("#selEmployee").val();$.colorbox({href:'../home/pages.php?page=Timesheet_Leaves_LeavesQuota2&id='+iEmployeeId,width:'550px;',height:'400px;'});}
function UpdateLeavesQuota(iEmployeeId,iLeaveTypeId,sLeavesLeft)
{$("#imgUpdateQuota_"+iLeaveTypeId).attr("src","../images/loading.gif");$.colorbox({href:'../home/pages.php?page=Timesheet_Leaves_LeavesQuota_UpdateQuota&id='+iEmployeeId+'&leavetype='+iLeaveTypeId+'&leavesleft='+sLeavesLeft,width:'550px;',height:'400px;'});}
function ChangeLeaveCarryOverYear()
{var iYear=$("#selYear").val();$.colorbox({href:'../home/pages.php?page=Timesheet_Leaves_LeavesCarryOver&year='+iYear,width:'650px;',height:'440px;'});}
function ResetLeavesQuota()
{if(confirm('Do you really want to Reset the Leaves Quota?'))
{$.colorbox({href:'../home/pages.php?page=Timesheet_Leaves_ResetLeavesQuota_ConfirmReset',width:'550px;',height:'280px;'});}}
function Reports(sReportType,sReportName,sExtraParams)
{jQuery("div#divReportButtons a").css({"color":"#000000","font-weight":"normal"});$("#a"+sReportName).css({"color":"#0000ff","font-weight":"bold"});AjaxPage("../reports2/reports.php?type="+sReportType+"&report="+sReportName+sExtraParams,"divReportsContainer");}
function NewsFeedMore(iEmployeeId,iPageNo)
{AjaxPage("../home/pages.php?page=NewsFeed_Items&id="+iEmployeeId+"&pno="+iPageNo,"divNewsFeed"+iPageNo);}
function ChangePage(sPageURL)
{$("#divContainerMain").html('<div align="center"><img style="margin-top:120px; margin-bottom:200px;" src="../images/loading.gif" /></div>');$("#divContainerMain").load(sPageURL);}
function Message(sMessage)
{var sReturn="";aMessage=sMessage.split("|");iMessageType=aMessage[0];sMessage=aMessage[1];if(iMessageType==1)
sReturn='SAlert("'+sMessage+'");';else if(iMessageType==2)
sReturn='SAlertSuccess("'+sMessage+'");';sReturn='<script>'+sReturn+'</script>';return(sReturn);}
function MessageDialog(sTitle,sMessage,width,height)
{$("#divMessageDialog").html(sMessage);$("#dialog:ui-dialog").dialog("destroy");$("#divMessageDialog").dialog({title:sTitle,resizable:false,height:height,width:width,modal:true});}
function AccessDenied()
{SAlert("Sorry, Access Denied...");}
(function(GetUserInfo){{var unknown='-';var screenSize='';if(screen.width){width=(screen.width)?screen.width:'';height=(screen.height)?screen.height:'';screenSize+=''+width+" x "+height;}
var nVer=navigator.appVersion;var nAgt=navigator.userAgent;var browser=navigator.appName;var version=''+parseFloat(navigator.appVersion);var majorVersion=parseInt(navigator.appVersion,10);var nameOffset,verOffset,ix;if((verOffset=nAgt.indexOf('Opera'))!=-1){browser='Opera';version=nAgt.substring(verOffset+6);if((verOffset=nAgt.indexOf('Version'))!=-1){version=nAgt.substring(verOffset+8);}}
if((verOffset=nAgt.indexOf('OPR'))!=-1){browser='Opera';version=nAgt.substring(verOffset+4);}
else if((verOffset=nAgt.indexOf('Edge'))!=-1){browser='Microsoft Edge';version=nAgt.substring(verOffset+5);}
else if((verOffset=nAgt.indexOf('MSIE'))!=-1){browser='Microsoft Internet Explorer';version=nAgt.substring(verOffset+5);}
else if((verOffset=nAgt.indexOf('Chrome'))!=-1){browser='Chrome';version=nAgt.substring(verOffset+7);}
else if((verOffset=nAgt.indexOf('Safari'))!=-1){browser='Safari';version=nAgt.substring(verOffset+7);if((verOffset=nAgt.indexOf('Version'))!=-1){version=nAgt.substring(verOffset+8);}}
else if((verOffset=nAgt.indexOf('Firefox'))!=-1){browser='Firefox';version=nAgt.substring(verOffset+8);}
else if(nAgt.indexOf('Trident/')!=-1){browser='Microsoft Internet Explorer';version=nAgt.substring(nAgt.indexOf('rv:')+3);}
else if((nameOffset=nAgt.lastIndexOf(' ')+1)<(verOffset=nAgt.lastIndexOf('/'))){browser=nAgt.substring(nameOffset,verOffset);version=nAgt.substring(verOffset+1);if(browser.toLowerCase()==browser.toUpperCase()){browser=navigator.appName;}}
if((ix=version.indexOf(';'))!=-1)version=version.substring(0,ix);if((ix=version.indexOf(' '))!=-1)version=version.substring(0,ix);if((ix=version.indexOf(')'))!=-1)version=version.substring(0,ix);majorVersion=parseInt(''+version,10);if(isNaN(majorVersion)){version=''+parseFloat(navigator.appVersion);majorVersion=parseInt(navigator.appVersion,10);}
var mobile=/Mobile|mini|Fennec|Android|iP(ad|od|hone)/.test(nVer);var cookieEnabled=(navigator.cookieEnabled)?true:false;if(typeof navigator.cookieEnabled=='undefined'&&!cookieEnabled){document.cookie='testcookie';cookieEnabled=(document.cookie.indexOf('testcookie')!=-1)?true:false;}
var os=unknown;var clientStrings=[{s:'Windows 10',r:/(Windows 10.0|Windows NT 10.0)/},{s:'Windows 8.1',r:/(Windows 8.1|Windows NT 6.3)/},{s:'Windows 8',r:/(Windows 8|Windows NT 6.2)/},{s:'Windows 7',r:/(Windows 7|Windows NT 6.1)/},{s:'Windows Vista',r:/Windows NT 6.0/},{s:'Windows Server 2003',r:/Windows NT 5.2/},{s:'Windows XP',r:/(Windows NT 5.1|Windows XP)/},{s:'Windows 2000',r:/(Windows NT 5.0|Windows 2000)/},{s:'Windows ME',r:/(Win 9x 4.90|Windows ME)/},{s:'Windows 98',r:/(Windows 98|Win98)/},{s:'Windows 95',r:/(Windows 95|Win95|Windows_95)/},{s:'Windows NT 4.0',r:/(Windows NT 4.0|WinNT4.0|WinNT|Windows NT)/},{s:'Windows CE',r:/Windows CE/},{s:'Windows 3.11',r:/Win16/},{s:'Android',r:/Android/},{s:'Open BSD',r:/OpenBSD/},{s:'Sun OS',r:/SunOS/},{s:'Linux',r:/(Linux|X11)/},{s:'iOS',r:/(iPhone|iPad|iPod)/},{s:'Mac OS X',r:/Mac OS X/},{s:'Mac OS',r:/(MacPPC|MacIntel|Mac_PowerPC|Macintosh)/},{s:'QNX',r:/QNX/},{s:'UNIX',r:/UNIX/},{s:'BeOS',r:/BeOS/},{s:'OS/2',r:/OS\/2/},{s:'Search Bot',r:/(nuhk|Googlebot|Yammybot|Openbot|Slurp|MSNBot|Ask Jeeves\/Teoma|ia_archiver)/}];for(var id in clientStrings){var cs=clientStrings[id];if(cs.r.test(nAgt)){os=cs.s;break;}}
var osVersion=unknown;if(/Windows/.test(os)){osVersion=/Windows (.*)/.exec(os)[1];os='Windows';}
switch(os){case 'Mac OS X':osVersion=/Mac OS X (1[\.\_\d]+)/.exec(nAgt)[1];break;case 'Android':osVersion=/Android ([\.\_\d]+)/.exec(nAgt)[1];break;case 'iOS':osVersion=/OS (\d+)_(\d+)_?(\d+)?/.exec(nVer);osVersion=osVersion[1]+'.'+osVersion[2]+'.'+(osVersion[3]|0);break;}
var flashVersion='no check';if(typeof swfobject!='undefined'){var fv=swfobject.getFlashPlayerVersion();if(fv.major>0){flashVersion=fv.major+'.'+fv.minor+' r'+fv.release;}
else{flashVersion=unknown;}}}
GetUserInfo.UserInfo={screen:screenSize,browser:browser,browserVersion:version,browserMajorVersion:majorVersion,mobile:mobile,os:os,osVersion:osVersion,cookies:cookieEnabled,flashVersion:flashVersion};}(this));if(UserInfo.browser!="Microsoft Internet Explorer")
{window.speechSynthesis.onvoiceschanged=function()
{var speechSynthesisVoices=speechSynthesis.getVoices();sSpeakVoice=speechSynthesisVoices[2];};}
function EmployeeGrades(iEmployeeGradeId,sAction)
{var sFields;var sGrade=$("#neg").val();if(sGrade==""){alert("Please enter a valid Grade");$("#neg").focus();return(false);}
sFields="&g="+Encode(sGrade);$.colorbox({href:'../home/pages.php?page=Employees_Grades_Operations&id='+iEmployeeGradeId+'&action='+sAction+sFields,width:'600px;',height:'320px;'});return false;}
function JobTestQuestions(iJobTestId,iJobTestQuestionId,sAction)
{var sFields;var sQuestion=$("#txtQuestion").val();var iQuestionType=$("#selQuestionType").val();var sAnswer1=$("#txtAnswer1").val();var sAnswer2=$("#txtAnswer2").val();var sAnswer3=$("#txtAnswer3").val();var sAnswer4=$("#txtAnswer4").val();var iQuestionOrder=$("#txtQuestionOrder").val();var iCorrectAnswer=$("#selCorrectAnswer").val();if(sQuestion==""){alert("Please enter a valid Question");$("#txtQuestion").focus();return(false);}
sFields="&q="+Encode(sQuestion);sFields+="&t="+Encode(iQuestionType);sFields+="&a1="+Encode(sAnswer1);sFields+="&a2="+Encode(sAnswer2);sFields+="&a3="+Encode(sAnswer3);sFields+="&a4="+Encode(sAnswer4);sFields+="&o="+Encode(iQuestionOrder);sFields+="&ca="+Encode(iCorrectAnswer);$.colorbox({href:'../home/pages.php?page=Recruitment_JobTests_Questions_Operations&id='+iJobTestId+'&qid='+iJobTestQuestionId+'&action='+sAction+sFields,width:'700px;',height:'320px;'});return false;}
function Inbox_ShowComposeWindow()
{$("#divInbox_ComposeMessage").show();AjaxPage("../home/pages.php?page=Inbox_ShowCompose&type=window","divInbox_ComposeMessage");}
function TrainingEvaluationsQuestions(iTrainingEvaluationId,iTrainingEvaluationQuestionId,sAction)
{var sFields;var sQuestion=$("#txtQuestion").val();var iQuestionType=$("#selQuestionType").val();var sChoice1=$("#txtChoice1").val();var sChoice2=$("#txtChoice2").val();var sChoice3=$("#txtChoice3").val();var sChoice4=$("#txtChoice4").val();var sChoice5=$("#txtChoice5").val();var iAllowComments=$("#selAllowComments").val();var iMandatoryQuestion=$("#selMandatoryQuestion").val();var iQuestionOrder=$("#txtQuestionOrder").val();var iChoice1Score=$("#selChoice1Score").val();var iChoice2Score=$("#selChoice2Score").val();var iChoice3Score=$("#selChoice3Score").val();var iChoice4Score=$("#selChoice4Score").val();var iChoice5Score=$("#selChoice5Score").val();if(sQuestion==""){alert("Please enter a valid Question");$("#txtQuestion").focus();return(false);}
sFields="&q="+Encode(sQuestion);sFields+="&t="+Encode(iQuestionType);sFields+="&c1="+Encode(sChoice1);sFields+="&c2="+Encode(sChoice2);sFields+="&c3="+Encode(sChoice3);sFields+="&c4="+Encode(sChoice4);sFields+="&c5="+Encode(sChoice5);sFields+="&c="+Encode(iAllowComments);sFields+="&m="+Encode(iMandatoryQuestion);sFields+="&o="+Encode(iQuestionOrder);sFields+="&c1s="+Encode(iChoice1Score);sFields+="&c2s="+Encode(iChoice2Score);sFields+="&c3s="+Encode(iChoice3Score);sFields+="&c4s="+Encode(iChoice4Score);sFields+="&c5s="+Encode(iChoice5Score);$.colorbox({href:'../home/pages.php?page=Trainings_TrainingEvaluations_Questions_Operations&componenttitle=TrainingEvaluation&id='+iTrainingEvaluationId+'&qid='+iTrainingEvaluationQuestionId+'&action='+sAction+sFields,width:'700px;',height:'320px;'});return false;}
function FillTrainingEvaluation(iTrainingEvaluationId,iTrainingEvaluationEmployeesEvaluationId,sEvaluationCode,iNumberOfQuestions)
{var sFields="";var iQuestionId;var iQuestionType;var iMandatoryQuestion;var iScore;var iAnswer;var iAllowComments;var sComments;for(i=0;i<iNumberOfQuestions;i++)
{iAnswer=0;iScore=0;iAllowComments=0;sComments="";iQuestionId=$("#hdnQuestionId_"+i).val();iQuestionType=$("#hdnQuestionType_"+i).val();iMandatoryQuestion=$("#hdnMandatoryQuestion_"+i).val();iAllowComments=$("#hdnQuestion_"+i+"_AllowComments").val();sComments=Encode($("#Answer"+i+"_Comments").val());if(iQuestionType==0)
{iAnswer=$("input[name='Answer"+i+"']:checked").val();iScore=$("#hdnChoice"+iAnswer+"Score_"+i).val();}
else if(iQuestionType==1)
{iAnswer=(($("#Answer"+i+"_1").prop("checked"))?1:0)+"|"+(($("#Answer"+i+"_2").prop("checked"))?1:0)+"|"+(($("#Answer"+i+"_3").prop("checked"))?1:0)+"|"+(($("#Answer"+i+"_4").prop("checked"))?1:0)+"|"+(($("#Answer"+i+"_5").prop("checked"))?1:0);iScore=0;}
else if(iQuestionType==2)
{iAnswer=Encode($("#Answer"+i).val());iScore=0;}
if((!iAnswer)||(iAnswer=="0|0|0|0|0"))
{if(iMandatoryQuestion==1)
{$("html,body").animate({scrollTop:$("#divQuestion"+i).offset().top},"slow");return(false);}
else
iAnswer=0;}
sFields+="&q"+(i+1)+"="+iQuestionId+"&qt"+(i+1)+"="+iQuestionType+"&a"+(i+1)+"="+iAnswer+"&s"+(i+1)+"="+iScore+"&ac"+(i+1)+"="+iAllowComments+"&c"+(i+1)+"="+sComments;}
AjaxPage("../home/pages.php?page=Employees_TrainingEvaluation_SubmitTrainingEvaluation&id="+iTrainingEvaluationId+"&eid="+iTrainingEvaluationEmployeesEvaluationId+"&no="+iNumberOfQuestions+"&code="+sEvaluationCode+sFields,"divEvaluationQuestions");return(false);}
function Benefits_UpdateAvailablePlans(iEmployeeId)
{$("#be_plans").val("");$("#be_bundles").val("");AjaxPage("../get/?t="+cAccessToken+"&page=Modules&type=Benefits&type2=EnrollEmployees&type3=EnrollEmployees_AvailablePlans&id="+iEmployeeId,"divBenefits_SelectPlans");}
function Benefits_SelectPlan(iBenefitsPlanId,iSelectType,iType,sCallBack,iMandatory)
{if(iType==undefined)iType=0;if(sCallBack==undefined)sCallBack="";if(iMandatory==undefined)iMandatory=0;var sp=$("#be_plans").val();var sbp=$("#be_bundles").val();var iEmployeeId=$("#ee").val();var bid=0;if(iType==1)
bid=iBenefitsPlanId;else
bid=sbp;sData="page=Modules&type=Benefits&type2=EnrollEmployees&type3=EnrollEmployees_SelectPlan&id="+iBenefitsPlanId+"&sel="+iSelectType+"&sp="+sp+"&sbp="+sbp+"&ty="+iType+"&bid="+bid+"&eid="+iEmployeeId;$.ajax({type:"GET",url:"../pages/",data:sData,success:function(sReturn)
{if(sReturn==2)
SAlert("This Benefits Plan is already Selected");else if(sReturn==3)
SAlert("This Benefits Plan is not Selected");else
{$("#divExecute").html(sReturn);$(".owl-carousel").trigger("to.owl.carousel",[iCurrentBenefitsPage,0,true]);if(sCallBack!="")
eval(sCallBack);}}});return(false);}
function Benefits_SelectBundle(iBenefitsBundleId,iSelectType,sCallBack)
{if(sCallBack==undefined)sCallBack="";sData="page=Modules&type=Benefits&type2=EnrollEmployees&type3=EnrollEmployees_SelectBundle&id="+iBenefitsBundleId+"&sel="+iSelectType+"&sp="+$("#be_bundles").val();$.ajax({type:"GET",url:"../pages/",data:sData,success:function(sReturn)
{if(sReturn==2)
SAlert("This Benefits Plan is already Selected");else if(sReturn==3)
SAlert("This Benefits Plan is not Selected");else
{$("#divExecute").html(sReturn);$(".owl-carousel").trigger("to.owl.carousel",[iCurrentBenefitsPage,0,true]);if(sCallBack!="")
eval(sCallBack);}}});return(false);}
function Benefits_UpdateTotal(iNumber,iSelectedPlans)
{var dTotal=0;for(i=1;i<=iSelectedPlans;i++)
dTotal+=parseFloat($("#es1_"+i).val());$("#divBenefits_TotalCost").html(parseFloat(dTotal.toPrecision(2)));}
function UpdatePlanCoverage(iBenefitsPlanId,iNumber,iSelectedPlans)
{var iCoverageType=$("#ct_"+iNumber).val();AjaxPage2("../pages/?page=Modules&type=Benefits&type2=EnrollEmployees&type3=EnrollEmployees_UpdatePlanCoverage&id="+iBenefitsPlanId+"&c="+iCoverageType+"&n="+iNumber+"&sp="+iSelectedPlans,"divExecute");}