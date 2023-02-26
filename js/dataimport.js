var tnglitbox;
var timecheck;
var lastptr;
var treeval;
var lastcount = 0;
var currcount;

var done = false;
var started = false;
var suspended = false;
var submitted = false;
var needcheck = false;

var reset_restarts = 15;
var restarts_left = reset_restarts;
var tree = "";
var treeselect;
var already_checking = false;
var first_pause = true;
var data_interval = 3000;
var first_check = true;
var first_wait = 0;

function checkFile(form){
	var rval = true;
	if( form.remotefile.value.length == 0 && form.database.value.length == 0 ) {
		alert( selectimportfile );
		rval = false;
	}
	else if( form.tree1.selectedIndex == 0 && form.tree1.options[form.tree1.selectedIndex].value == "" && !form.eventsonly.checked) {
		alert( selectdesttree );
		rval = false;
	}

	if(rval && form.target) {
		if(form.action.indexOf("admin_gedimport.php") >=0) {
			tree = form.tree1.options[form.tree1.selectedIndex].value;
			treeselect = document.form1.tree1;
			resetimport();
			var popup = '<div class="impcontainer">\n';
			popup += '<div class="impheader"><strong><span id="importmsg" class="subhead">';
			var filename = '';
			if(form.remotefile.value.length) {
				filename = form.remotefile.value.split('\\').pop().split('/').pop();
				popup += uploading + ' ' + filename;
				implinksstyle = ' style="display:none"';
				form.database.value = "";
			}
			else {
				filename = form.database.value;
				popup += opening + ' ' + filename;
				implinksstyle = '';
			}
			popup += '... &nbsp;<img src="img/spinner.gif" /></span></strong></div>\n';
			popup += '<div id="impdata"">\n';
			popup += '<p id="recordcount">\n<span class="imp">&nbsp;<span class="implabel">'+ peoplelbl + ': </span><span id="personcount" class="impctr">0</span></span>\n';
			popup += '<div class="imp">&nbsp;<span class="implabel">'+ familieslbl + ': </span><span id="familycount" class="impctr">0</span></div>\n';
			popup += '<div class="imp">&nbsp;<span class="implabel">'+ sourceslbl + ': </span><span id="sourcecount" class="impctr">0</span></div>\n';
			popup += '<div class="imp">&nbsp;<span class="implabel">'+ noteslbl + ': </span><span id="notecount" class="impctr">0</span></div>\n';
			popup += '<div class="imp">&nbsp;<span class="implabel">'+ medialbl + ': </span><span id="mediacount" class="impctr">0</span></div>\n';
			popup += '<div class="imp">&nbsp;<span class="implabel">'+ placeslbl + ': </span><span id="placecount" class="impctr">0</span></div>\n</p><br/><br/>';
			popup += '<div class="progcontainer tngshadow"><div id="progress" class="emptybar">\n<div id="bar" class="colorbar"></div>\n</div>\n</div>\n';
			popup += '</div>\n';
			popup += '<br/><div id="implinks" class="subhead"' + implinksstyle + '><a href="#" onclick="return suspendimport();">'+stopmsg+'</a>';
			if(saveimport == "1") {
				treeval = treeselect.options[treeselect.selectedIndex].value;
				popup += ' |  <a href="admin_gedimport.php?resuming=1&tree=' + treeval + '" id="resumelink" target="results" onclick="resumeimport();">'+resumemsg+'</a>';
			}
			popup += '</div>\n';
			popup += '<div id="closelinks" class="subhead" style="display:none"><a href="admin_secondmenu.php?tree=' + tree + '">' + more_options + '</a> | <span id="toremove"><a href="#" onclick="return removeFile(' + "'" + filename + "'" + ');">' + removeged_msg + '</a></span>'
			popup += '<p><a href="#" onclick="tnglitbox.remove();return false;"><img src="img/tng_close.gif" border="0" align="left" style="margin-right:5px"/>' + close_msg + '</a></p></div>';
			popup += '</div>';
			tnglitbox = new LITBox(popup,{type:'alert',width:600,height:250,onremove:function(){if(!done) stopimport();}});
			lastptr = 0;

			if(form.database.value.length)
				first_wait = form.remotefile.value.split('.').pop().toLowerCase() == "zip" ? 10000 : 5000;
				//console.log('STARTING, wait' + first_wait);
				timecheck = setDataCheck(first_wait);
			//}
		}
		else
			document.form1.target = "main";
	}
	return rval;
}

function iframeLoaded() {
	if(started && !done && !suspended && !document.form1.database.value.length) {
		//restart if that is an option
		treeselect = document.form1.tree1;
		var del = $('input[name="del"]:checked').val();
		//console.log('starting over in iframeloaded, normal the first time');
		self.frames[0].location.href = "admin_gedimport.php?resuming=1&first=1&del="+del+"&tree="+treeselect.options[treeselect.selectedIndex].value;
		jQuery('#implinks').show();

		//timecheck = setDataCheck(data_interval);
	}
}

function resetimport() {
	done = false;
	started = false;
	suspended = false;
	submitted = true;
}

function resumeimport() {
	jQuery('#importmsg').html(reopenmsg + ' ' + treeval + '...');
	suspended = false;
	timecheck = setTimeout(getImportData, data_interval);
}

function stopimport() {
	suspendimport();
	done = true;
}

function suspendimport() {
	if(document.all)
		document.execCommand("stop");
	else
		window.stop();
	jQuery('#importmsg').html(stoppedmsg);
	clearTimeout(timecheck);
	suspended = true;
	return false;
}

function setDataCheck(time_interval) {
	clearTimeout(timecheck);
	return setTimeout(getImportData, time_interval);
}

function getImportData() {
	//console.log('do ajax call to get import data');
	if((first_check || !done) && !suspended && !already_checking) {
		already_checking = true;
		var params = {tree: tree};
		jQuery.ajax({
			url: 'ajx_getimportdata.php',
			data: params,
			dataType: 'json',
			success: function(vars){
				if(vars.error) {
					//console.log(vars.error);
					done = true;
					jQuery('#importmsg').html(vars.error);
				}
				else {
					currcount = vars.icount + vars.fcount + vars.scount + vars.ncount + vars.mcount + vars.pcount;
					needcheck = true;
					if(vars.barwidth == lastptr && currcount == lastcount && !done) { //no progress
						if(first_pause) {
							first_pause = false;
							wait = 10000;
						}
						else if(!done) {
							//console.log('second call to import data and no progress, hard restart');
							treeselect = document.form1.tree1;
							self.frames[0].location.href = "admin_gedimport.php?resuming=1&tree="+treeselect.options[treeselect.selectedIndex].value;
							if(restarts_left) {
								timecheck = setDataCheck(data_interval);
								first_pause = true;
								restarts_left--;
								needcheck = false;
							}
							else {
								done = true;
								jQuery('#importmsg').html("Import timed out, unable to restart");
							}
						}
					}
					else {
						jQuery('#importmsg').html(importing_msg);
						jQuery('#personcount').html(vars.icount);
						jQuery('#familycount').html(vars.fcount);
						jQuery('#sourcecount').html(vars.scount);
						jQuery('#notecount').html(vars.ncount);
						jQuery('#mediacount').html(vars.mcount);
						jQuery('#placecount').html(vars.pcount);

						jQuery('#bar').width(vars.barwidth);
						lastptr = vars.barwidth;
						lastcount = currcount;
						if(vars.barwidth == 500) 
							done = true;
						else {
							restarts_left = reset_restarts;
							wait = data_interval;
						}
						//console.log('counts updated, bar at ' + vars.barwidth + '. check again in 3 secs');
					}
					if(!suspended && needcheck) {
						if(!done)
							timecheck = setDataCheck(wait);
						else
							onComplete();
					}
				}
				already_checking = false;
			}
		});
	}
	if(done) 
		onComplete();
}

function onComplete() {
	jQuery('#bar').width(500);
	jQuery('#implinks').hide();
	jQuery('#closelinks').show();
	jQuery('#importmsg').html(finished_msg);
}

function removeFile(filename) {
	var params = {filename:filename};
	jQuery.ajax({
		url: 'admin_deletefile.php',
		data: params,
		dataType: 'html',
		success: function(req){
			jQuery('#toremove').html(req);
		}
	});
	return false;
}

function validateTreeForm(form) {
	if( form.gedcom.value.length == 0 ) {
		alert(entertreeid);
		rval = false;
	}
	else if( !alphaNumericCheck(form.gedcom.value) ) {
		alert(alphanum);
	}
	else if( form.treename.value.length == 0 ) {
		alert(entertreename);
	}
	else {
		var params = jQuery(form).serialize();
		jQuery.ajax({
			url: 'admin_addtree.php',
			data: params,
			dataType: 'html',
			success: function(req){
				if(req == "1") {
					tnglitbox.remove();
					treeselect = document.form1.tree1;
					var i = treeselect.options.length;
					if(navigator.appName == "Netscape") {
						treeselect.options[i] = new Option(form.treename.value,form.gedcom.value,false,false)
					}
					else if( navigator.appName == "Microsoft Internet Explorer") {
						treeselect.add(document.createElement("OPTION"));
						treeselect.options[i].text=form.treename.value;
						treeselect.options[i].value=form.gedcom.value;
					}
					treeselect.selectedIndex = i;
				}
				else
					jQuery('#treemsg').html(req);
			}
		});
	}
	return false;
}

function toggleAppenddiv(flag) {
	if(flag)
		jQuery('#appenddiv').fadeIn(200);
	else
		jQuery('#appenddiv').fadeOut(200);
}

function toggleNorecalcdiv(flag) {
	if(flag)
		jQuery('#norecalcdiv').fadeIn(200);
	else
		jQuery('#norecalcdiv').fadeOut(200);
}

function toggleSections(flag) {
	jQuery('#desttree').toggle(400);
	jQuery('#replace').toggle(400);
	jQuery('#ioptions').toggle(400);
	document.form1.action = flag ? 'admin_gedimport_eventtypes.php' :  document.form1.action = 'admin_gedimport.php';
	if(flag) document.form1.allevents.checked = "";
}

function alphaNumericCheck(string){
	var regex=/^[0-9A-Za-z_-]+$/; //^[a-zA-z]+$/
	return regex.test(string);
}

function getBranches(treeselect, selected) {
	if(selected) {
		var tree = treeselect.options[treeselect.selectedIndex].value;
		var treeidx = tree ? tree : 'none';

		if(branchcounts[treeidx] == -1) {
			var params = {tree: tree};
			jQuery.ajax({
				url: 'admin_branchoptions.php',
				data: params,
				dataType: 'html',
				success: function(req){
					branchcounts[treeidx] = req == "0" ? 0 : 1;
					if(branchcounts[treeidx]) {
						branches[treeidx] = req;
					}
					showBranches(treeidx);
				}
			});
		}
		else
			showBranches(treeidx);
	}
	else
		jQuery('#destbranch').fadeOut(200);
}

function showBranches(treeidx) {
	if(branchcounts[treeidx] == 1) {
		jQuery('#branch1div').html('<select name="branch1" id="branch1">' + branches[treeidx] + '</select>');
		jQuery('#destbranch').fadeIn(200);
	}
	else {
		jQuery('#destbranch').fadeOut(200);
	}
}

function toggleTarget(form) {
	if(form.target)
		form.target = "";
	else
		form.target = "results";
}