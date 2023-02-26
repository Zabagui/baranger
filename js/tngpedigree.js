for( var h = 1; h < slotceiling; h++ ) {
	eval( 'var timer' + h + '=false' );
}
var timerleft = false;

function setPopup(slot, tall, high) {
	eval( "timer" + slot + "=setTimeout(\"showPopup(" + slot + ","+tall+","+high+")\",150);");
}

function showPopup( slot, tall, high ){
// hide any other currently visible popups
	if( lastpopup ) {
		cancelTimer(lastpopup);
		hidePopup(lastpopup);
	}
	lastpopup = slot;

// show current
	var ref = jQuery("#popup" + slot);
	var box = jQuery("#box" + slot);
	ref.html(getPopup(slot));

	var vOffset, hOffset, hDisplace;

	if(tall + high < 0)
		vOffset = 0;
	else {
		vOffset = tall + high + pedborderwidth;
		var vDisplace = box.position().top + high + pedborderwidth + ref.height() - jQuery('#outer').height() + 20; //20 is for the scrollbar
		if(vDisplace > 0)
			vOffset -= vDisplace;
	}
	hDisplace = box.position().left + ref.width() - jQuery('#outer').width();
	if(hDisplace > 0) {
		if(vDisplace > 0) {
			ref.offset({left: box.offset().left - ref.width() - pedborderwidth});
			if(box.position().top < vOffset)
				vOffset = box.position().top;
		}
		else
			ref.offset({left: box.offset().left - hDisplace});
	}
	else {
		if(vDisplace > 0) {
			hDisplace = box.position().left + box.width() + ref.width() - jQuery('#outer').width();
			if(hDisplace > 0)
				ref.offset({left: box.offset().left - ref.width() - pedborderwidth});
			else
				ref.offset({left: box.offset().left + box.width() + (2 * pedborderwidth)});
			if(box.position().top < vOffset)
				vOffset = box.position().top;
		}
	}
	ref.css('top',vOffset);
	ref.css('z-index',8);
   	ref.css('visibility','visible');
}

function hidePopup(slot) {
	var ref = jQuery("#popup" + slot);
	if (ref.length) { ref.css('visibility','hidden'); }
	eval("timer" + slot + "=false;");
}

function showBackPopup() {
	if( lastpopup ) {
		cancelTimer(lastpopup);
		hidePopup(lastpopup);
	}
	lastpopup = '';

	var ref = jQuery("#popupleft");
	ref.html(getBackPopup());

	if ( ref.css('visibility') != "show" && ref.css('visibility') != "visible" ) {
		ref.css('z-index',8);
    	ref.css('visibility','visible');
	}
}

function setTimer(slot) {
	eval( "timer" + slot + "=setTimeout(\"hidePopup('" + slot + "')\",popuptimer);");
}

function cancelTimer(slot) {
	eval( "clearTimeout(timer" + slot + ");" );
	eval( "timer" + slot + "=false;" );
}

function setFirstPerson(newperson) {
	if(newperson != firstperson) {
		firstperson = newperson;
		if( !tngprint ) {
			var params = 'personID=' + newperson + '&tree=' + tree + '&parentset=' + parentset + '&generations=' + generations;
			jQuery("#stdpedlnk").attr('href',pedigree_url + params + '&display=standard');
			jQuery("#compedlnk").attr('href',pedigree_url + params + '&display=compact');
			jQuery("#boxpedlnk").attr('href',pedigree_url + params + '&display=box');
			jQuery("#textlnk").attr('href',pedigreetext_url + params);
			jQuery("#ahnlnk").attr('href',ahnentafel_url + params);
			jQuery("#extralnk").attr('href',extrastree_url + params + '&showall=1');
		}
	}
}

function fetchData(famParams,newgens) {
   	var loading = jQuery("#loading");
	loading.show();

	var strParams = "generations=" + newgens + "&tree=" + tree + '&display=' + display + famParams;
 	var loader1 = new net.ContentLoader(pedjsonfile,FillChart,null,"POST",strParams);
}

function getNewChart(personID,newgens,newparentset) {
	setFirstPerson(personID);
	fetchData('&personID=' + personID + '&parentset=' + newparentset, newgens );
}

function getNewFamilies(famParams,newgens,gender) {
	//set first person
	var nextfamily = people[firstperson].famc;
	if( gender == "F" )
		setFirstPerson(families[nextfamily].wife);
	else
		setFirstPerson(families[nextfamily].husband);

	if( famParams )
		fetchData(famParams,newgens);
	else
		DisplayChart();
}

function goBack(backperson) {
	setFirstPerson( backperson );
	DisplayChart();
}

function addNewPeople(incoming) {
	var vars = eval('('+incoming+')');
	if(vars.people) {
		for(var i=0; i < vars.people.length; i++) {
			//var p = new Person(vars.people[i]);
			var p = vars.people[i];
			var pID = vars.people[i].personID;
			people[pID] = p;
		}
	}
	if(vars.families) {
		for(var i=0; i < vars.families.length; i++){
			var family = vars.families[i];
			var famID = vars.families[i].famID;
			families[famID] = family;
		}
	}
}

function getGenderIcon(gender) {
	var genderstr, icon = "";
	var valign = display == "compact" ? -2 : -1;
	if(gender) {
		if(gender == "M") genderstr = "male";
		else if(gender == "F") genderstr = "female";
		if(genderstr)
			icon = " <img src=\"" + cmstngpath + "img/tng_" + genderstr + ".gif\" width=\"11\" height=\"11\" border=\"0\" alt=\"" + genderstr + "\" style=\"vertical-align: " + valign + "px;\"/>";
	}

	return icon;
}

function FillChart() {
	addNewPeople(this.req.responseText);
   	var loading = jQuery("#loading");
	DisplayChart();
	loading.hide();
}

function DisplayChart() {
	toplinks = "";
	botlinks = "";
	endslotctr = 0;
	endslots = new Array();

	var slot = 1;
	FillSlot(slot,firstperson,0);

	var offpage;
	var leftarrow = jQuery('#leftarrow');
	if(people[firstperson].backperson) {
		leftarrow.html('<a href="javascript:goBack(' + "'" + people[firstperson].backperson + "'" + ');">' + leftarrowimg + '</a>');
		leftarrow.css('visibility','visible');
	}
	else {
		var gotkids = 0;
		var activeperson = people[firstperson];
		var spFamID;
		if( activeperson.spfams) {
			for( var i = 0; i < activeperson.spfams.length; i++ ) {
				spFamID = activeperson.spfams[i].spFamID;
				if( families[spFamID].children ) {
					gotkids = 1;
					break;
				}
			}
		}
		if( gotkids ) {
			leftarrow.html('<a href="javascript:showBackPopup();">' + leftarrowimg + '</a>');
			leftarrow.css('visibility','visible');
		}
		else {
			leftarrow.html('');
			leftarrow.css('visibility','hidden');
		}
	}

	topparams = getParams( toplinks );
	botparams = getParams( botlinks );

	for( var i = 0; i < endslots.length; i++ ) {
		offpage = jQuery('#offpage'+endslots[i]);
		offpage.css('visibility','visible');
	}
}

function FillSlot(slot,currperson,lastperson) {
	var currentBox = document.getElementById('box'+slot);
	var content = "";
	var slotperson, husband, wife;

	if( people[currperson] )
		slotperson = people[currperson];
	else {
		slotperson = new Object;
		slotperson.famc = -1;
		slotperson.personID = 0;
	}
	slots[slot] = slotperson;
   	var dnarrow = jQuery('#downarrow'+slot);
   	var popup = jQuery('#popup'+slot);
	var popupcontent = "";
	var shadow, border, icons = "";

	if( slotperson.personID ) {
		//save primary marriage
		if( lastperson )
			slotperson.famID = people[lastperson].famc;
		else
			slotperson.famID = "";
		if( hideempty ) {
			currentBox.style.visibility = 'visible';
			toggleLines(slot,slotperson.famc,'visible');
		}
		if( slotperson.photosrc && slotperson.photosrc != "-1" ) {
			content = '<img src="' + slotperson.photosrc + '" id="img' + slot + '" border="0"' + ' class="smallimg" />';
			if( slotperson.photolink && slotperson.photolink != "-1" )
				content = '<a href="' + slotperson.photolink + '">' + content + '</a>';
			content = '<td class="lefttop">' + content + '</td>';
		}
		content += '<td class="pboxname" id="td' + slot + '">' + namepad + '<a href="' + getperson_url + 'personID=' + slotperson.personID + '&amp;tree=' + slotperson.tree + '" id="tdlink' + slot + '">' + slotperson.name + '</a>';
		if( display == "standard" )
			content += '<br/>' + getGenderIcon(slotperson.gender) + ' <span class="pedyears">' + slotperson.years + ' </span>';
		else
			content += getGenderIcon(slotperson.gender);

		//put small pedigree link in every box except for primary individual
		if(!tngprint) {
			if( popupchartlinks && slotperson.famc != -1 && slotperson.personID != personID)
				icons += pedIcon(slotperson.personID);
			if(allow_edit)
				icons += editIcon('P',slot,slotperson.personID,'',slotperson.gender);
			if(display != "box") {
				var w = parseInt(currentBox.style.width) - 35;
				var h = parseInt(currentBox.style.height) - 15;
				icons = '<div class="floverlr" id="ic'+slot+'" style="left:' + w + 'px;top:' + h + 'px;display:none;background-color:'+currentBox.oldcolor+'">'+icons+'</div>';
			}
			else {
				content += icons;
				icons = "";
			}
		}
		if( display == "box" ) {
			var bmd = doBMD(slot,slotperson);
			if( bmd ) content += '<table border="0" cellpadding="0" cellspacing="0">' + bmd + '</table>';
		}
		content += '</td>';
		currentBox.style.backgroundColor = currentBox.oldcolor;

		if( usepopups ) {
			if( slotperson.spfams || slotperson.bdate || slotperson.bplace || slotperson.ddate || slotperson.dplace || slotperson.parents ) {
				dnarrow.css('visibility','visible');
				popup.html(popupcontent);
			}
			else
				dnarrow.css('visibility','hidden');
		}
	}
	//no person
	else {
		if( hideempty ) {
			content = '';
			currentBox.style.visibility = "hidden";
			toggleLines(slot,0,'hidden');
		}
		else {
			if( allow_edit && lastperson && people[lastperson].famc != -1 ) {
				var twoback = people[lastperson].backperson
				var twobackfam = people[twoback] ? people[twoback].famc : "";
				content = '<td class="pboxname" id="td' + slot + '" align="' + pedboxalign + '">' + namepad + '<a href="#" onclick="return editFamily(\'' + people[lastperson].famc + '\', ' + slot + ',\'' + people[lastperson].personID + '\',\'' + twobackfam + '\');">' + txt_editfam + '</a></td>';
			}
			else if( allow_add && lastperson && people[lastperson].famc == -1 )
				content = '<td class="pboxname" id="td' + slot + '" align="' + pedboxalign + '">' + namepad + '<a href="#" onclick="return newFamily(' + slot + ',\'' + people[lastperson].personID + '\');">' + txt_addfam + '</a></td>';
			else
				content = '<td class="pboxname" id="td' + slot + '" align="' + pedboxalign + '">' + namepad + unknown + '</td>';
			currentBox.style.backgroundColor = emptycolor;
		}
		if( usepopups ) {
			dnarrow.css('visibility','hidden');
			popup.html("");
		}
	}
	currentBox.innerHTML = content ? icons + '<table border="0" class="pedboxtable" cellpadding="' + pedcellpad + '" cellspacing="0" align="' + pedboxalign + '"><tr>' + content + '</tr></table>' : "";

	var nextslot = slot * 2;
	if( slotperson.famc != -1 && families[slotperson.famc] ) {
		husband = families[slotperson.famc].husband;
		wife = families[slotperson.famc].wife;
	}
	else {
		husband = 0;
		wife = 0;
	}
	if( nextslot < slotceiling ) {
		FillSlot(nextslot,husband,slotperson.personID);
		nextslot++;
		FillSlot(nextslot,wife,slotperson.personID);
	}
	else if( slotperson.famc != "-1" ) {
		if( slot < (slotceiling_minus1 * 3 / 2) )
			toplinks = addToList(toplinks,slotperson.personID);
		else
			botlinks = addToList(botlinks,slotperson.personID);
		endslots[endslotctr] = slot;
		endslotctr++;
	}
	else {
		offpage = jQuery('#offpage'+slot);
		offpage.css('visibility','hidden');
	}
}

function toggleLines(slot,nextperson,visibility) {
	var newvis;

	for( var i = 1; i <= 5; i++ ) {
		shadow = jQuery('#shadow'+slot+'_'+i);
		border = jQuery('#border'+slot+'_'+i);
		newvis = ( i == 3 && nextperson <= 0) ? "hidden" : visibility;
		if( shadow.length )
			shadow.css('visibility',newvis);
		if( border.length )
			border.css('visibility',newvis);
	}
}

function addToList(linklist,backperson) {
	var listarray = linklist.split(",");
	if(jQuery.inArray(backperson,listarray) < 0) {
		if( linklist ) linklist += ",";
		linklist += backperson;
	}
	return linklist;
}

function getParams( personstr ) {
	var params = "", currperson, nextfamily;

	if( personstr ) {
		var pers = personstr.split(",");
		ctr = 0;
		for( var i = 0; i < pers.length; i++ ) {
			currperson = pers[i];
			nextfamily = people[currperson].famc;
			if( !families[nextfamily] || needspouses(nextfamily)) {
				ctr++;
				params += "&backpers" + ctr + "=" + currperson + "&famc" + ctr + "=" + people[currperson].famc;
			}
		}
		params += "&l=" + pers.length;
	}
	return params;
}

function needspouses( nextfamily ) {
	var husb = families[nextfamily].husband;
	var wife = families[nextfamily].wife;

	return (!husb || !wife || !people[husb] || !people[wife]) ? true : false;
}

var tdclasstxt = 'class="normal pboxpopup" valign="top"';
var divtxt = '<div class="pboxpopupdiv">\n<table cellspacing="0" cellpadding="1" border="0" width="100%">\n';
var tabletxt = '<table cellspacing="0" cellpadding="1" border="0" width="100%">\n';
function doRow(slot,slotabbr,slotevent1,slotevent2) {
	var rstr = "";
	slotabbr += ":";
	if( slotevent1 )
		rstr += '<tr><td ' + tdclasstxt + ' align="right" id="popabbr' + slot + '">' + slotabbr + '</td><td ' + tdclasstxt + ' colspan="3" id="pop' + slot + '">' + slotevent1 + '</td></tr>';
	if( slotevent2 ) {
		if( slotevent1 ) slotabbr = '&nbsp;';
		rstr += '<tr><td ' + tdclasstxt + ' align="right" id="popabbr' + slot + '">' + slotabbr + '</td><td ' + tdclasstxt + ' colspan="3" id="pop' + slot + '">' + slotevent2 + '</td></tr>';
	}
	return rstr;
}

function getBackPerson(nxtpersonID) {
	hidePopup('left');
	getNewChart(nxtpersonID, generations, 0);
}

function getBackPopup() {
	var popupcontent = "", spouselink, count, kidlink;

	var slotperson = slots[1];

	if( slotperson.spfams ) {
		popupcontent += divtxt;
		for( var i = 0; i < slotperson.spfams.length; i++ ) {
			var fam = slotperson.spfams[i];
			var children = families[fam.spFamID].children;
			count = i + 1;

			//do each spouse
			if( fam.spID && fam.spID != -1)
				spouselink = fam.spname;
			else
				spouselink = unknown;

		    popupcontent += '<tr><td ' + tdclasstxt + ' id="popabbrleft"><b>' + count + '</b></td>';
			popupcontent += '<td ' + tdclasstxt + ' colspan="2" id="popleft">' + spouselink + '</td></tr>';

			if( popupkids && children ) {
				//these might not need nowrap
   				popupcontent += '<tr><td ' + tdclasstxt + ' align="right" id="popabbrleft">&nbsp;</td><td ' + tdclasstxt + ' colspan="3" id="popleft"><b>' + txt_children + ':</b></td></tr>\n';
				for( var j = 0; j < children.length; j++ ) {
					var spchild = children[j];

					kidlink = '<a href="javascript:getBackPerson(' + "'" + spchild.childID + "'" + ')">';
				    	popupcontent += '<tr><td ' + tdclasstxt + ' id="popabbrleft">' + kidlink + '<img src="' + cmstngpath + 'img/ArrowLeft.gif" width="10" height="16" border="0"></a></td>';
					popupcontent += '<td ' + tdclasstxt + ' id="popleft">' + kidlink + spchild.name + '</a></td></tr>';
				}
			}
		}
		popupcontent += "</table></div>\n";
	}
	if( popupcontent )
	 	popupcontent = '<div><div class="tngshadow popinner">' + popupcontent + '</div></div>\n';
	return popupcontent;
}

function doBMD(slot,slotperson) {
	var famID = slotperson.famID != null ? slotperson.famID : false;
	var content = "";
	var icons = "";
	if( popupchartlinks && slotperson.famc != -1 && slotperson.personID != personID)
		icons += pedIcon(slotperson.personID);
	if(allow_edit)
		editIcon('P',slot,slotperson.personID,'',slotperson.gender);
	if(display == "standard")
		content += divtxt + '<tr><td ' + tdclasstxt + ' colspan="4"><b>'+slotperson.name+'</b>'+icons+'</td></tr>\n';
	else
		content += tabletxt;
	content += doRow(slot,slotperson.babbr,slotperson.bdate,slotperson.bplace);
	if( famID )
		content += doRow(slot,families[famID].mabbr,families[famID].mdate,families[famID].mplace);
	content += doRow(slot,slotperson.dabbr,slotperson.ddate,slotperson.dplace);
	content += '</table>';
	if(display == "standard")
		content += '</div>';
	return content;
}

function getPopup(slot) {
	var popupcontent = "", spouselink, sppedlink, count, kidlink, kidpedlink, parpedlink, parentlink;

	var slotperson = slots[slot];

	if( display == "standard" )
		popupcontent += doBMD(slot,slotperson);

	if( slotperson.parents ) {
		if(popupcontent) popupcontent += '<div class="popdivider"></div>\n';
		popupcontent += divtxt;
   		popupcontent += '<tr><td class="normal pboxpopup" valign="top" colspan="4" id="pop' + slot + '"><b>' + txt_parents + ':</b></td></tr>\n';
		for( var i = 0; i < slotperson.parents.length; i++ ) {
			var par = slotperson.parents[i];
			count = i + 1;
			parentlink = '';

			if( par.fatherID )
				parentlink += '<a href="' + getperson_url + 'personID=' + par.fatherID + '&amp;tree=' + tree + '">' + par.fathername + '</a>';
			if( par.motherID ) {
				if( parentlink ) parentlink += ", ";
				parentlink += '<a href="' + getperson_url + 'personID=' + par.motherID + '&amp;tree=' + tree + '">' + par.mothername + '</a>';
			}
			if( par.famID != slotperson.famc )
				parpedlink = '<a href="' + pedigree_url + 'personID=' + slotperson.personID + '&amp;tree=' + tree + '&amp;parentset=' + count + '&amp;display=' + display + '&amp;generations=' + generations + '">' + chartlink + '</a>';
			else
				parpedlink = '';
		    popupcontent += '<tr><td ' + tdclasstxt + ' id="popabbr' + slot + '"><b>' + count + '</b></td>';
			popupcontent += '<td ' + tdclasstxt + ' colspan="2" id="pop' + slot + '">' + parentlink + '</td>';
			popupcontent += '<td ' + tdclasstxt + ' align="right">&nbsp;' + parpedlink + '</td></tr>';
		}
		popupcontent += '</table></div>\n';
	}

	if( popupspouses && slotperson.spfams ) {
		for( var i = 0; i < slotperson.spfams.length; i++ ) {
			var fam = slotperson.spfams[i];
			var children = families[fam.spFamID].children;
			count = i + 1;

			//this one might not need "nowrap"
			if(popupcontent) popupcontent += '<div class="popdivider"></div>';
			popupcontent += divtxt;
			popupcontent += '<tr><td ' + tdclasstxt + ' colspan="4" id="pop' + slot + '"><B>' + txt_family + ':</B> [<a href=\"' + familygroup_url + 'familyID=' + fam.spFamID + '&amp;tree=' + tree + '">' + txt_groupsheet + '</a>]';
			if(allow_edit)
				popupcontent += editIcon('F',slot,slotperson.backperson,fam.spFamID,slotperson.gender);
			popupcontent += '</td></tr>';
			//do each spouse
			sppedlink = '';
			if( fam.spID && fam.spID != -1) {
				spouselink = '<a href="' + getperson_url + 'personID=' + fam.spID + '&amp;tree=' + tree + '">' + fam.spname + '</a>';
				if( popupchartlinks )
					sppedlink = pedIcon(fam.spID);
			}
			else
				spouselink = unknown;

		    popupcontent += '<tr><td ' + tdclasstxt + ' id="popabbr' + slot + '"><b>' + count + '</b></td>';
			popupcontent += '<td ' + tdclasstxt + ' colspan="2" id="pop' + slot + '">' + spouselink + '</td>';
			popupcontent += '<td ' + tdclasstxt + ' align="right">' + sppedlink + '</td></tr>';

			if( popupkids && children && children.length ) {
   				popupcontent += '<tr><td class="normal pboxpopup" align="right" valign="top" id="popabbr' + slot + '">&nbsp;</td><td class="normal pboxpopup" valign="top" colspan="3" id="pop' + slot + '"><B>' + txt_children + ':</B></td></tr>\n';
				for( var j = 0; j < children.length; j++ ) {
					var spchild = children[j];

					kidlink = '<a href="' + getperson_url + 'personID=' + spchild.childID + '&amp;tree=' + tree + '">' + spchild.name + '</a>';
					if( popupchartlinks )
						kidpedlink = pedIcon(spchild.childID);
					else
						kidpedlink = '';
				    popupcontent += '<tr><td ' + tdclasstxt + ' id="popabbr' + slot + '">&nbsp;</td>';
					popupcontent += '<td ' + tdclasstxt + ' id="pop' + slot + '">' + pedbullet + '</td>';
					popupcontent += '<td ' + tdclasstxt + ' id="pop' + slot + '">' + kidlink + '</td>';
					popupcontent += '<td ' + tdclasstxt + ' align="right" id="pop' + slot + '">' + kidpedlink + '</td></tr>';
				}
			}
			popupcontent += '</table></div>\n';
		}
	}

	if( popupcontent )
	 	popupcontent = '<div><div class="tngshadow popinner">' + popupcontent + '</div></div>\n';
	return popupcontent;
}

function editIcon(type,slot,personID,familyID,gender) {
	var iconlink;
	var editicon = '<img src="' + cmstngpath + 'img/tng_edit2.gif" width="10" height="10" border="0"/>';

	if(type == "P")
		iconlink = ' <a href="#" onclick="return editPerson(\'' + personID + '\',' + slot + ',\'' + gender + '\');" title="' + txt_editperson + '">' + editicon + '</a>';
	else {
		var famc = personID ? people[personID].famc : familyID;
		iconlink = ' <a href="#" onclick="return editFamily(\'' + familyID + '\',' + slot + ',\'' + personID + '\',\'' + famc + '\');" title="' + txt_editfam + '">' + editicon + '</a>';
	}
	return iconlink;
}

function pedIcon(personID) {
	return ' <a href="' + pedigree_url + 'personID=' + personID + '&amp;tree=' + tree + '&amp;display=' + display + '&amp;generations=' + generations + '" title="' + txt_newped + '">' + chartlink + '</a>';
}