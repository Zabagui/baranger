/*
url-loading object and a request queue built on top of it
*/

/* namespacing object */
var net=new Object();

net.READY_STATE_UNINITIALIZED=0;
net.READY_STATE_LOADING=1;
net.READY_STATE_LOADED=2;
net.READY_STATE_INTERACTIVE=3;
net.READY_STATE_COMPLETE=4;


/*--- content loader object for cross-browser requests ---*/
net.ContentLoader=function(url,onload,onerror,method,params,contentType){
  this.req=null;
  this.onload=onload;
  this.onerror=(onerror) ? onerror : this.defaultError;
  this.loadXMLDoc(url,method,params,contentType);
}

net.ContentLoader.prototype.loadXMLDoc=function(url,method,params,contentType){
  if (!method){
    method="GET";
  }
  if (!contentType && method=="POST"){
    contentType='application/x-www-form-urlencoded';
  }
  if (window.XMLHttpRequest){
    this.req=new XMLHttpRequest();
  } else if (window.ActiveXObject){
    this.req=new ActiveXObject("Microsoft.XMLHTTP");
  }
  if (this.req){
    try{
      var loader=this;
      this.req.onreadystatechange=function(){
        net.ContentLoader.onReadyState.call(loader);
      }
      this.req.open(method,url,true);
      if (contentType){
        this.req.setRequestHeader('Content-Type', contentType);
      }
      this.req.send(params);
    }catch (err){
      this.onerror.call(this);
    }
  }
}


net.ContentLoader.onReadyState=function(){
  var req=this.req;
  var ready=req.readyState;
  if (ready==net.READY_STATE_COMPLETE){
    var httpStatus=req.status;
    if (httpStatus==200 || httpStatus==0){
      this.onload.call(this);
    }else{
      this.onerror.call(this);
    }
  }
}

net.ContentLoader.prototype.defaultError=function(){
  alert("There was a problem returning data from the server. This may be temporary, so please try again later. Here is some information about the status of this request:"
    +"\n\nreadyState:"+this.req.readyState
    +"\nstatus: "+this.req.status
    +"\nheaders: "+this.req.getAllResponseHeaders());
}

function showPreview(mediaID,medialinkID,path,entitystr,sitever) {
	if(jQuery('#prev'+entitystr).html() == "") {
		var caption_div = sitever != "mobile" ? '<div class=\"prev-caption\" id=\"capt' + entitystr + '\"></div>' : '<div class=\"prev-close\"><img id=\"close-' + entitystr + '\" src='+ cmstngpath + '"img/tng_close.gif"/></div>';
		jQuery('#prev'+entitystr).html('<div id="ld'+entitystr+'"><img src="' + cmstngpath + 'img/spinner.gif" style="border:0px"> '+loadingmsg+'</div><a href="' + cmstngpath + 'showmedia.php?mediaID=' + mediaID + '&amp;medialinkID=' + medialinkID + '"><img src="' + smallimage_url + 'mediaID=' + mediaID + '&amp;path=' + encodeURIComponent(path) + '" style="display:none" onload="jQuery(\'#ld\'+\'' + entitystr + '\').hide(); this.style.display=\'\';"/></a>' + caption_div);
		pageWidth = jQuery(window).width();
		parent = jQuery('#prev'+entitystr).parent();
		currX = parent.position().left;
		if(sitever == "mobile")
			jQuery('#prev'+entitystr).css('background-image','none')
		else if(currX + 490 > pageWidth) {
			width = parent.next().width() - 4;
			jQuery('#prev'+entitystr).css('right',width + 'px');
			jQuery('#prev'+entitystr).css('background-image','url(img/media-prevbg-rotated.png)')
		}
		if(sitever != "mobile" && (mediaID || medialinkID)) {
			//ajax call to get title & description 
			var params = {mediaID:mediaID,medialinkID:medialinkID};
			jQuery.ajax({
				url: cmstngpath + 'ajx_caption.php',
				data: params,
				dataType: 'html',
				success: function(req){
					jQuery('#capt'+ entitystr).html(req);
				}
			});
		}
	}
	jQuery('#prev'+entitystr).fadeIn(100);
}

function closePreview(entitystr) {
	jQuery('#prev'+entitystr).fadeOut(100);
}

var loginOverlay;
function openLogin(url) {
	loginOverlay = new LITBox(url,{width:370, height:500, doneLoading:function(){setFocus('tngusername');}});
	return false;
}

function setFocus(field) {
	if(jQuery('#'+field).length)
		jQuery('#'+field).focus();
}

function sendLogin(form, url) {
	var params = jQuery(form).serialize();
	jQuery.ajax({
		url: url,
		data: params,
		dataType: 'json',
		success: function(vars){
			if(jQuery('#'+vars.div).length) {
				jQuery('#'+vars.div).html(vars.msg);
				jQuery('#'+vars.div).effect('highlight',{},400);
			}
		}
	});
	return false;
}

var newuserok = false;
function checkNewUser(userfield, olduserfield, submitform) {
	if(olduserfield && userfield.value == olduserfield.value) {
		jQuery('#checkmsg').html('');
		newuserok = true;
		return true;
	}
	else {
		var params = {checkuser: userfield.value};
		jQuery.ajax({
			url: 'ajx_checknewuser.php',
			data: params,
			dataType: 'json',
			success: function(vars){
				newuserok = vars.rval;
				if(newuserok) {
					if(submitform)
						document.editprofile.submit();
					else
						jQuery('#checkmsg').html('<span class=\"msgapproved\">' + vars.html + '</span>');
				}
				else
					jQuery('#checkmsg').html('<span class=\"msgerror\">' + vars.html + '</span>');
			}
		});
		return false;
	}
}

function checkEmail(email) {
	var domains = ",AC,AD,AE,AERO,AF,AG,AI,AL,AM,AN,AO,AQ,AR,ARPA,AS,AT,AU,AW,AX,AZ,BA,BB,BD,BE,BF,BG,BH,BI,BIZ,BJ,BM,BN,BO,BR,BS,BT,BV,BW,BY,BZ,CA,CAT,CC,CD,CF,CG,CH,CI,CK,CL,CM,CN,CO,COM,COOP,CR,CU,CV,CX,CY,CZ,DE,DEV,DJ,DK,DM,DO,DZ,EC,EDU,EE,EG,EMAIL,ER,ES,ET,EU,FAMILY,FI,FJ,FK,FM,FO,FR,GA,GB,GD,GE,GF,GG,GH,GI,GL,GM,GMX,GN,GOV,GP,GQ,GR,GS,GT,GU,GW,GY,HK,HM,HN,HR,HT,HU,ID,IE,IL,IM,IN,INFO,INT,IO,IQ,IR,IS,IT,JE,JM,JO,JOBS,JP,KE,KG,KH,KI,KIWI,KM,KN,KR,KW,KY,KZ,LA,LB,LC,LI,LIMO,LK,LR,LS,LT,LU,LV,LY,MA,MC,MD,ME,MG,MH,MIL,MK,ML,MM,MN,MO,MOBI,MP,MQ,MR,MS,MT,MU,MUSEUM,MV,MW,MX,MY,MZ,NA,NAME,NC,NE,NET,NF,NG,NI,NL,NO,NP,NR,NU,NZ,OM,ONE,ONLINE,ORG,PA,PE,PF,PG,PH,PK,PL,PM,PN,PR,PRO,PS,PT,PW,PY,QA,RE,RO,RU,RW,SA,SB,SC,SD,SE,SG,SH,SI,SJ,SK,SL,SM,SN,SO,SR,ST,SU,SV,SY,SZ,TC,TD,TEL,TF,TG,TH,TJ,TK,TL,TM,TN,TO,TP,TR,TRAVEL,TT,TV,TW,TZ,UA,UG,UK,UM,US,UY,UZ,VA,VC,VE,VG,VI,VN,VU,WF,WORLD,WS,YE,YT,YU,ZA,ZM,ZW,";
	var rval = /^\w+([\.\+-]*\w+)*@\w+([\.\+-]*\w+)*(\.\w{2,6})+$/.test(email);
	if(rval) {
		var thisdomain = email.substr(email.lastIndexOf(".")+1);
		rval = domains.indexOf(','+thisdomain.toUpperCase()+',') >= 0 ? true : false;
	}
	return rval;
}


if (!Array.prototype.indexOf) {
	Array.prototype.indexOf = function(obj, start) {
	     for (var i = (start || 0), j = this.length; i < j; i++) {
	         if (this[i] === obj) { return i; }
	     }
	     return -1;
	}
}

function openSearch() {
	jQuery('#searchdrop').slideToggle(200);
	jQuery('#searchfirst').focus();
	return false;
}

function goToPage(button, address, tree, perpage) {
	var pagenum = jQuery(button).prev(".tngpage").val();
	if(!isNaN(pagenum) && pagenum >= 1) {
		offset = (pagenum - 1) * perpage;
		window.location.href = address + '=' + offset + '&tree=' + tree + '&tngpage=' + pagenum;
	}
}

function pageEnter(field,e) {
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return false;
	if(keycode == 13)
		return true;
	else
		return false;
}

function toggleMobileMenu(menuName) {
	var menu = jQuery('ul#m' + menuName + 'menu');
	if(menu.hasClass('on'))
		menu.removeClass('on');
	else {
		jQuery('.mhead ul').removeClass('on');
		menu.addClass('on'); 
	}
	return false;
}

function toggleCollapsed(collapsing) {
	jQuery('.toggleicon').each(function(index,item) {
		var targetId = $(item).attr('id');
		var affectedRows = jQuery('.' + targetId);
		if(!collapsing && $(item).attr('src').indexOf('desc') > 0) {
			$(item).attr('src',cmstngpath + "img/tng_sort_asc.gif");
			$(item).attr('title',collapse_msg);
			jQuery('.l' + targetId).attr('rowspan',affectedRows.length + 1);
			if(targetId.substring(0,1) == "m") {
				//jQuery('#dr'+targetId).show();
				jQuery('#ss'+targetId).show();
			}
			affectedRows.toggle();
		}
		else if(collapsing && $(item).attr('src').indexOf('asc') > 0) {
			$(item).attr('src',cmstngpath + "img/tng_sort_desc.gif");
			$(item).attr('title',expand_msg);
			jQuery('.l' + targetId).removeAttr('rowspan');
			if(targetId.substring(0,1) == "m") {
				//jQuery('#dr'+targetId).hide();
				jQuery('#ss'+targetId).hide();
			}
			affectedRows.toggle();
		}
	});
	return false;
}

function toggleSection(section,img,display) {
	if(display == 'on') {
		jQuery('#'+img).attr('src','img/tng_collapse.gif');
		var doit = true;
		if(section == "modifyexisting") {
			var agent = navigator.userAgent.toLowerCase();
			if(agent.indexOf('safari')!=-1) doit = false;
		}
		if(doit)
			jQuery('#'+section).fadeIn(300);
		else
			jQuery('#'+section).show();
	}
	else if(display == 'off') {
		jQuery('#'+img).attr('src','img/tng_expand.gif');
		jQuery('#'+section).fadeOut(300);
	}
	else {
		jQuery('#'+img).attr('src', jQuery('#'+img).attr('src').indexOf('collapse') > 0 ? 'img/tng_expand.gif' : 'img/tng_collapse.gif');
		var doit = true;
		if(section == "addmedia") {
			var agent = navigator.userAgent.toLowerCase();
			if(agent.indexOf('safari')!=-1 && agent.indexOf('version/3') == -1) doit = false;
		}
		if(doit)
			jQuery('#'+section).toggle(300);
		else
			jQuery('#'+section.css('display', jQuery('#'+section).css('display') == 'none' ? '' : 'none'));
	}
	return false;
}

function togglePwd(fieldname,button) {
	if($('#'+fieldname).prop('type') == 'password') {
		$('#'+fieldname).prop('type','text');
		$('#'+button).attr('src','img/pwdoff.png');
	}
	else {
		$('#'+fieldname).prop('type','password');
		$('#'+button).attr('src','img/pwdon.png');
	}
}

var fileTimeoutId = 0;
function fpFilterChanged(event, searchTerm) {
	clearTimeout(fileTimeoutId);		

	var keycode;
	if(event) keycode = event.keyCode;
	else if(e) keycode = e.which;
	else return true;

	if(keycode == 9 || keycode == 13) return false;
	fileTimeoutId = setTimeout(function() {
		applyFileFilter(searchTerm)
	},500);
}

function applyFileFilter(searchTerm) {
	//use jQuery to get all file rows
	var termlen = searchTerm.length;
	jQuery('tr.filerow').each(function(index, item){
		if(jQuery(item).find('td.lightback.filecell').html().toLowerCase().includes(searchTerm.toLowerCase()))
			jQuery(item).show();
		else
			jQuery(item).hide();
	});

	return false;
}

function searchGoogleWebSite(sitedir)  {
    window.open("https://www.google.com/search?q=site:" + sitedir + " " + document.getElementById("GoogleText").value) ;
    return false;
}

window.initMap = function(){};

jQuery(document).ready(function() {
	jQuery('li a.mobileicon').click(function() {
		jQuery('ul.on').each(function(index,item){
			jQuery(item).removeClass('on');
		})
	});
	jQuery('.toggleicon').click(function(e) {
		var target = jQuery(e.target);
		var targetId = target.attr('id');
		var affectedRows = jQuery('.' + targetId);
		if(target.attr('src').indexOf('desc') > 0) {
			target.attr('src',cmstngpath + "img/tng_sort_asc.gif");
			target.attr('title',collapse_msg);
			jQuery('.l' + targetId).attr('rowspan',affectedRows.length + 1);
		}
		else {
			target.attr('src',cmstngpath + "img/tng_sort_desc.gif");
			target.attr('title',expand_msg);
			jQuery('.l' + targetId).removeAttr('rowspan');
		}
		if(targetId.substring(0,1) == "m") {
			//jQuery('#dr'+targetId).toggle();
			jQuery('#ss'+targetId).toggle();
		}
		affectedRows.toggle();
	});
	$('.scroll-to-top').hide();
		//Check to see if the window is top if not then display button
		$(window).scroll(function () {
		if ($(this).scrollTop() > 300) {
			$('.scroll-to-top').fadeIn();
		} else {
			$('.scroll-to-top').fadeOut();
		}
	});
	$('.scroll-to-top').click(function () {
		$('html, body').animate({ scrollTop: 0 }, 800);
		return false;
	});
});