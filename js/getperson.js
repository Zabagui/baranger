function innerToggle(part,subpart,subpartlink) {
	if( part == subpart )
		turnOn(subpart,subpartlink);
	else
		turnOff(subpart,subpartlink);
}

function turnOn(subpart,subpartlink) {
	jQuery('#'+subpartlink).attr('class','lightlink3');
	jQuery('#'+subpart).show();
}

function turnOff(subpart,subpartlink) {
	jQuery('#'+subpartlink).attr('class','lightlink');
	jQuery('#'+subpart).hide();
}

function highlightChild(flag,child) {
	jQuery('#child'+child).attr('class',flag ? 'highlightedchild' : 'unhighlightedchild');
}