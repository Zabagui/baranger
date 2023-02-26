<?php
// RM this file is called into the Admin pages where the map is going
// to appear, and includes the links for help, external Google maps
// that can be searched if the small built in map doesn't work.
// notable exception is UK locations which due to licensing issues can't be
// searched from within pages using the map API but can be searched from
// Google's own pages.
	echo "<input type=\"button\" onclick=\"return divbox('mapcontainer');\" value=\"{$admtext['showhidemap']}\" class=\"alignmiddle\"> <span class=\"normal\">{$admtext['getcoords']}</span>\n";

	echo "<div id=\"mapcontainer\" style=\"display:none; width:{$map['admw']};\" class=\"mappad5 rounded10\">\n";
	$searchstring = !empty($row['place']) ? $row['place'] : $admtext['searchstring'];
	echo "<span class=\"normal\">{$admtext['googleplace']}: ";

	echo "<input type=\"text\" size=\"60\" name=\"address\" id=\"location\" onkeypress=\"return keyHandlerEnter(this,event);\" value=\"$searchstring\"";
	if( empty($row['place']) )
		echo " onfocus=\"if(this.value=='$searchstring'){this.value='';}\"";
	echo ">\n";
	echo "<input type=\"button\" value=\"{$admtext['gobutton']}\" onclick=\"showAddress(document.form1.address.value); return false\" /><br /><br /></span>\n";

	echo "<div id=\"map\" style=\"width: {$map['admw']}; height: {$map['admh']}\" class=\"rounded10\"></div>\n";
	$maphelplang = findhelp("places_googlemap_help.php");
	$glang = isset($text['glang']) ? $text['glang'] : "en";
	echo "<span class=\"normal\"><br /><a href=\"javascript:newwindow=window.open('{$http}://maps.google.com/maps?f=q&amp;hl=" . $glang ."$mcharsetstr&amp;q=". (isset($row['place']) ? $row['place'] : "") . "', 'googlehelp'); newwindow.focus();\"> {$admtext['difficultmap']}</a> | <a href=\"javascript:newwindow=window.open('$maphelplang/places_googlemap_help.php', 'newwindow', 'height=500,width=600,resizable=yes,scrollbars=yes'); newwindow.focus();\">{$admtext['maphelp']}</a></span>\n";
	echo "</div>\n";
?>
