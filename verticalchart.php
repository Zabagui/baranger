<?php
$textpart = "pedigree";
include("tng_begin.php");

include($subroot . "pedconfig.php");
if(!$personID && !isset($needperson)) die("no args");

include $cms['tngpath'] . "pedbox.php";

$pedigree_url = getURL( "pedigree", 1 );
$getperson_url = getURL( "getperson", 1 );
$pedigreetext_url = getURL( "pedigreetext", 1 );
$ahnentafel_url = getURL( "ahnentafel", 1 );
$extrastree_url = getURL( "extrastree", 1 );
$pdfform_url = getURL( "rpt_pdfform", 1 );
$vertical_url = getURL( "verticalchart", 1 );
$fan_url = getURL( "fan", 1 );

if ($pedigree['inclphotos'] && (trim($photopath) == "" || trim($photosext) == "" )) $pedigree['inclphotos'] = false;

if(!isset($generations)) $generations = 0;
if( $generations > $pedigree['maxgen'] )
    $generations = intval($pedigree['maxgen']);
elseif( !$generations )
    $generations = $pedigree['initpedgens'] >= 2 ? intval($pedigree['initpedgens']) : 2;
else
	$generations = intval( $generations );

$result = getPersonFullPlusDates($tree, $personID);
if( !tng_num_rows($result) ) {
	tng_free_result($result);
	header( "Location: thispagedoesnotexist.html" );
	exit;
}

$row = tng_fetch_assoc( $result );
tng_free_result($result);
$righttree = checktree($tree);
$rightbranch = $righttree ? checkbranch($row['branch']) : false;
$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
$row['allow_living'] = $rights['living'];
$row['allow_private'] = $rights['private'];
$row['name'] = getName( $row );

$logname = $tngconfig['nnpriv'] && $row['private'] ? $admtext['text_private'] : ($nonames && $row['living'] ? $text['living'] : $row['name']);

$treeResult = getTreeSimple($tree);
$treerow = tng_fetch_assoc($treeResult);
$disallowgedcreate = $treerow['disallowgedcreate'];
$allowpdf = !$treerow['disallowpdf'] || ($allow_pdf && $rightbranch);
tng_free_result($treeResult);

if(!isset($display)) $display = "";
if(!isset($gentext)) $gentext = "";
if(!isset($pedname)) $pedname = "";
if(!isset($parentset)) $parentset = "";

writelog( "<a href=\"$vertical_url" . "personID=$personID&amp;tree=$tree&amp;generations=$generations&amp;display=$display\">" . xmlcharacters("{$text['pedigreefor']} $logname ($personID)") . "</a> $generations " . $gentext );
preparebookmark( "<a href=\"$vertical_url" . "personID=$personID&amp;tree=$tree&amp;generations=$generations&amp;display=$display\">" . xmlcharacters("{$text['pedigreefor']} $pedname ($personID)") . "</a> $generations " . $gentext );

$flags['scripting'] = "<script type=\"text/javascript\">var tnglitbox;</script>\n";
$flags['css'] = "<link href=\"{$cms['tngpath']}css/verticalchart.css?v=" . (filemtime($rootpath."css/verticalchart.css")) . "\" rel=\"stylesheet\" type=\"text/css\" />\n";
tng_header( $text['pedigreefor'] . " " . $row['name'], $flags );

$photostr = showSmallPhoto( $personID, $row['name'], $rights['both'], 0, false, $row['sex'] );
echo tng_DrawHeading( $photostr, $row['name'], getYears( $row ) );

$innermenu = $text['generations'] . ": &nbsp;";
$innermenu .= "<select name=\"generations\" class=\"verysmall\" onchange=\"window.location.href='$vertical_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;display=$display&amp;generations=' + this.options[this.selectedIndex].value\">\n";
   for( $i = 2; $i <= $pedigree['maxgen']; $i++ ) {
       $innermenu .= "<option value=\"$i\"";
       if( $i == $generations ) $innermenu .= " selected=\"selected\"";
       $innermenu .= ">$i</option>\n";
   }
	$innermenu .= "</select>&nbsp;&nbsp;&nbsp;\n";
	$innermenu .= "<a href=\"$pedigree_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;display=standard&amp;generations=$generations\" class=\"lightlink\" id=\"stdpedlnk\">{$text['pedstandard']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$vertical_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;display=vertical&amp;generations=$generations\" class=\"lightlink3\" id=\"pedchartlnk\">{$text['pedvertical']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$pedigree_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;display=compact&amp;generations=$generations\" class=\"lightlink\" id=\"compedlnk\">{$text['pedcompact']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$pedigree_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;display=box&amp;generations=$generations\" class=\"lightlink\" id=\"boxpedlnk\">{$text['pedbox']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$pedigreetext_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=$generations\" class=\"lightlink\">{$text['pedtextonly']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$ahnentafel_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=$generations\" class=\"lightlink\">{$text['ahnentafel']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$fan_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=$generations\" class=\"lightlink\">{$text['fanchart']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$extrastree_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;showall=1&amp;generations=$generations\" class=\"lightlink\">{$text['media']}</a>\n";
	if($generations <= 6 && $allowpdf)
		$innermenu .= " &nbsp;&nbsp; | &nbsp;&nbsp; <a href=\"#\" class=\"lightlink\" onclick=\"tnglitbox = new LITBox('$pdfform_url" . "pdftype=ped&amp;personID=$personID&amp;tree=$tree&amp;generations=$generations',{width:350,height:350});return false;\">PDF</a>\n";

echo getFORM( "pedigree", "", "form1", "form1" );
echo tng_menu( "I", "pedigree", $personID, $innermenu );
echo "</form>\n";

$height = $pedigree['vheight'] ? $pedigree['vheight'] : 150;
$width = $pedigree['vwidth'] ? $pedigree['vwidth'] : 90;
$spacing = $pedigree['vspacing'] ? $pedigree['vspacing'] : 20;
$fontsize = $pedigree['vfontsize'] ? $pedigree['vfontsize'] : 8;

$containerheight = ($generations * ($height+($spacing*2))) + $spacing;
$highestx = 0;

initChart();

function initChart () {
	global $width, $spacing, $height, $gens, $gedcom, $generations, $personID, $link;

	$gedcom = tng_real_escape_string($_GET['tree']);
	$gens[1][1] = $personID;
	get_details($gens, 1, $generations);
	close_parents($gens);
	remove_margins($gens);
	do_chart($gens, true);
}

function get_details (&$gens, $generation, $max_generations) {
	global $width, $spacing, $height, $person_count, $gedcom, $people_table, $families_table, $text, $allow_living, $allow_private;
	$delete_variables = array ('firstname', 'lnprefix', 'lastname', 'title', 'prefix', 'suffix', 'nameorder', 'allow_living', 'allow_private');
	foreach ($gens[$generation] as $num => $g) {
		if ($g) {
			$query = "SELECT personID, firstname, lnprefix, lastname, title, prefix, suffix, nameorder, sex, birthdate, birthdatetr,
				altbirthdate, altbirthdatetr, deathdate, deathdatetr, burialdate, burialdatetr, birthplace, altbirthplace, deathplace, burialplace,
				husband AS father, wife AS mother, {$people_table}.living, {$people_table}.private, {$people_table}.branch, {$people_table}.gedcom
				FROM {$people_table} LEFT JOIN {$families_table} ON {$people_table}.famc={$families_table}.familyID AND {$people_table}.gedcom={$families_table}.gedcom
				WHERE personID='{$g}' AND {$people_table}.gedcom='{$gedcom}'";
			$result = tng_query($query);
			if ($result && tng_num_rows($result)) {
				$result = tng_fetch_assoc($result);
				if(isset($result['personID'])) {
					$result['xpos'] = ($width+$spacing) * (pow(2, $max_generations-$generation)) * ($num-0.5);
					$result['spacer_xwidth'] = ($width+$spacing) * (pow(2, $max_generations-$generation-1));

					$rights = determineLivingPrivateRights($result);
					$result['display'] = $rights['both'];

					$result['allow_living'] = $rights['living'];
					$result['allow_private'] = $rights['private'];
					$result['name'] = getName($result);
					foreach($delete_variables as $var)
						unset($result[$var]); //Save memory by deleting variables no longer needed
					$gens[$generation][$num] = $result;
					if ($generation < $max_generations) {
						$gens[$generation+1][($num*2)-1] = $result ['father'];
						$gens[$generation+1][$num*2] = $result ['mother'];
					}
					$person_count++;
				}
			} else {
				echo $text['no_ancestors'];
				die();
			}
		}
		if(!isset($gens[$generation+1][$num*2]) && ($generation < $max_generations)) {
			$gens[$generation+1][$num*2] = '';
			$gens[$generation+1][($num*2)-1] = '';
		}
	}
	if($generation < $max_generations)
		get_details($gens, $generation+1, $max_generations);
}

function is_male ($num) {
	return (boolean)($num % 2);
}

function move_one_person (&$gens, $gen_num, $num) {
	global $width, $spacing;
	$max_generations = count ($gens);
	$previous = get_previous_person($gens[$gen_num], $num);
	if ($previous)
		$distance = $gens[$gen_num][$num]['xpos'] - ($gens[$gen_num][$previous]['xpos'] + $width + $spacing);
	else
		$distance = $gens[$gen_num][$num]['xpos'];
	// Now move everything on this row, plus their descendants
	if ($distance != 0) {
		if ($distance == 9999999999)
			$distance = $gens[$gen_num][$gen_num]['xpos'];
		for ($loop = $num; $loop <= pow(2, $gen_num-1); $loop++) {
			if (isset($gens[$gen_num][$loop]['xpos'])) {
				move_left ($gens, $gen_num, $loop, $distance);
				if (is_male($loop) && isset($gens[$gen_num][$loop+1]['personID']))
					move_left ($gens, $gen_num, $loop+1, $distance);
				$move_limit = move_descendant ($gens, $gen_num, $loop);					 // Move the descendants
				if ($move_limit !== NULL && $move_limit < $distance) {							 // Test whether the descendant move had to be limited to avoid overlapping
					move_left ($gens, $gen_num, $loop, $move_limit - $distance);		 // If so, move the person back
					if (is_male($loop) && isset($gens[$gen_num][$loop+1]['personID']))   // And his wife, if necessary
						move_left ($gens, $gen_num, $loop+1, $move_limit - $distance);
					$distance = $move_limit;
				}
			}
		}
	}
}

function close_parents (&$gens) {
	global $width, $spacing;
	$max_generations = count($gens);
	for ($gen_num = $max_generations; $gen_num > 1; $gen_num--) {
		$generation_exists = false;
		for ($num = count ($gens[$gen_num]); $num >= 1; $num--) {
			$person = &$gens[$gen_num][$num];
			if (isset ($person['personID'])) {
				$generation_exists = true;
				$child = &$gens[$gen_num-1][ceil($num/2)];
				$spouse = & $gens[$gen_num][$num + (is_male($num) ? 1 : -1)];
				if (!isset($spouse['personID'])) {
					move_left($gens, $gen_num, $num, $person['xpos'] - $child['xpos']);
					$child['spacer_xwidth'] = 0;
				} elseif (!is_male($num)) {
					// Move wife across
					// First, calculate the maximum distance she can be moved by going up the tree and calculating the maximum distance at every level
					$distance = 9999999999;
					$this_person = $num;
					for ($loop = $gen_num; $loop <= $max_generations; $loop++) {
						$left = get_previous_person ($gens[$loop], $this_person);
						$right = get_next_person ($gens[$loop], $this_person-1);
						if ($left && $right)
							$new_distance = $gens[$loop][$right]['xpos'] - $gens[$loop][$left]['xpos'] - $width - $spacing;
						elseif (!$left & $right)
							$new_distance = $gens[$loop][$right]['xpos'];
						if (isset($new_distance)) {
							if ($new_distance < $distance)
								$distance = $new_distance;
							unset ($new_distance);
						}
						if ($distance == 0) // If or we've already established we can't move this person, there's no point continuing
							break;
						if ($loop < $max_generations)
							$this_person = ($this_person * 2) - 1;
					}
					move_left($gens, $gen_num, $num, $distance);
					$child['spacer_xwidth'] = $child['spacer_xwidth'] - $distance;
				} elseif (is_male($num)) {
					// Move wife and husband back to above the centre of the child
					$distance = $child['xpos'] - (($spouse['xpos'] + $person ['xpos'])/2);
					move_left($gens, $gen_num, $num+1, -$distance);
					move_left($gens, $gen_num, $num, -$distance);
				}
			}
		}
		if (!$generation_exists) {
			unset ($gens[$gen_num]);
			$max_generations = count($gens);
		}
	}
}

function remove_margins (&$gens) {
	global $spacing;
	$left_most_xpos = 999999999;
	foreach ($gens as $gen_num => $generation) {
		$next = get_next_person($generation, 0);
		if (isset($generation[$next]['xpos']) && ($generation[$next]['xpos'] < $left_most_xpos))
			$left_most_xpos = $generation[$next]['xpos'];
	}
	move_left ($gens, 1, 1, $left_most_xpos-$spacing);
}

function get_previous_person ($generation, $num) {
	for ($previous = $num-1; $previous >= 1; $previous--)
		if (isset ($generation[$previous]['personID']))
			return $previous;
	return false;
}

function get_next_person ($generation, $num) {
	$num_generations = count($generation);
	for ($next = $num+1; $next <= $num_generations; $next++)
		if (isset ($generation[$next]['personID']))
			return $next;
	return false;
}
function move_left (&$gens, $gen_num, $num, $distance) {
	$gens[$gen_num][$num]['xpos'] = $gens[$gen_num][$num]['xpos'] - $distance;
	if (isset ($gens [$gen_num+1][($num*2)-1]['xpos']))
		move_left ($gens, $gen_num+1, ($num*2)-1, $distance);
	if (isset ($gens [$gen_num+1][$num*2]['xpos']))
		move_left ($gens, $gen_num+1, $num*2, $distance);
}

function move_descendant (&$gens, $gen_num, $num) {
	global $width, $spacing;
	if ($gen_num == 1)
		return;
	$child = &$gens[$gen_num-1][ceil($num/2)];
	$father = $gens[$gen_num][(ceil($num/2)*2)-1];
	$mother = $gens[$gen_num][ceil($num/2)*2];
	$orig_child_xpos = $child['xpos'];
	if ($father && $mother) {
		$child['xpos'] = ($father['xpos'] + $mother ['xpos'])/2;
		$child['spacer_xwidth'] = $mother ['xpos'] - $father['xpos'];
	} elseif ($father) {
		$child['xpos'] = $father['xpos'];
		$child['spacer_xwidth'] = 0;
	} elseif ($mother) {
		if ($mother['xpos'] < $child['xpos'])
			$child['xpos'] = $mother['xpos'];
		$child['spacer_xwidth'] = 0;
	}
	$limit = 9999999999;
	$previous_child = get_previous_person($gens[$gen_num-1], ceil($num/2));
	if ($previous_child) {
		$min_xpos = $gens[$gen_num-1][$previous_child]['xpos'] + $width + $spacing;
		if ($child['xpos'] < $min_xpos) {
			$limit = $orig_child_xpos - $min_xpos;
			$child['xpos'] = $min_xpos;
		}
	}
	//Repeat whole process for children
	if ($gen_num > 2)
		$new_limit = move_descendant ($gens, $gen_num-1, ceil($num/2));
	else
		$new_limit = NULL;
	if ($new_limit !== NULL && ($new_limit < $limit)) {
		$limit = $new_limit;
		$new_limit = NULL;
	}
	if ($limit == 9999999999)
		return NULL;
	else
		return $limit;
}


function do_chart($gens, $output = false) {
	global $width, $height, $spacing, $fontsize, $start_person, $session_charset, $cms, $templatepath, $text, $containerheight, $highestx, $pedigree, $vertical_url, $tngprint;
	$rows = sizeof ($gens);
	$ignore = isset($_GET['ignorestart']);
	foreach ($gens as $gen_num => $generation) {
		$row [$rows-$gen_num] = '';
		$ypos = ($rows-$gen_num)*($height+($spacing*2))+$spacing;
		$spacer_ypos = (($rows-$gen_num)*($height+($spacing*2)));
		$line_ypos = (($rows-$gen_num)*($height+($spacing*2)))+$height+$spacing;
		foreach ($generation as $num => $person) {
			if (isset($person['personID'])) {
				if (is_male($num)) {
					if (isset($gens[$gen_num][$num+1]['personID']))
						$type = 'husband';
					else
						$type = 'single';
				} else
					if (isset($gens[$gen_num][$num-1]['personID']))
						$type = 'wife';
					else
						$type = 'single';
				$person['xpos'] = round ($person['xpos']);
				if($person['xpos'] > $highestx)
					$highestx = $person['xpos'];
				$bio = '';
				if ($person['birthdate'] || $person['birthplace']) {
					$bio .= trim($text['born'] . ": " .  displayDate($person['birthdate']));
					if($person['birthdate'] && $person['birthplace']) $bio .= ", ";
					$bio .= $person['birthplace'];
				} elseif ($person['altbirthdate'] || $person['altbirthplace']) {
					$bio .= trim($text['christened'] . ": " . displayDate($person['altbirthdate']));
					if($person['altbirthdate'] && $person['altbirthplace']) $bio .= ", ";
					$bio .= $person['altbirthplace'];
				}
				if($person['deathdate'] || $person['deathplace']) {
					$bio .=  trim(($bio ? ' &#013;' : '').$text['died'] . ": " . displayDate($person['deathdate']));
					if($person['deathdate'] && $person['deathplace']) $bio .= ", ";
					$bio .= $person['deathplace'];
				} elseif ($person['burialdate'] || $person['burialplace']) {
					$bio .= trim(($bio ? ' &#013;' : '').$text['buried'] . ": " . displayDate($person['burialdate']));
					if($person['burialdate'] && $person['burialplace']) $bio .= ", ";
					$bio .= $person['burialplace'];
				}
				if($gen_num == count($gens) && ($person['father'] || $person['mother'])) {
					$row[$rows-$gen_num] .= "<a href=\"{$vertical_url}tree={$_GET['tree']}&personID={$person['personID']}\" title=\"{$text['pedigreefor']} {$person['name']}\" class=\"vpedlink\" style=\"left:" . ($person['xpos'] - 12 + ($width / 2)) . "px;top:" . ($ypos - 20) . "px\"><img src=\"img/ArrowUpYellow.gif\" /></a>";
				}

				if($spacer_ypos > 0 && (isset($gens[$gen_num+1][($num*2)-1]['name'])))
					$row [$rows-$gen_num] .= "\t\t<div class=\"ascender father\" style=\"left:".($person['xpos']-(($person['spacer_xwidth']-$width)/2))."px;top:{$spacer_ypos}px;width:".($person['spacer_xwidth']/2)."px\"></div>\r\n";
				if($spacer_ypos > 0 && (isset($gens[$gen_num+1][$num*2]['name'])))
					$row [$rows-$gen_num] .= "\t\t<div class=\"ascender mother\" style=\"left:".($person['xpos']+($width)/2)."px;top:".($ypos-$spacing)."px;width:".($person['spacer_xwidth']/2)."px\"></div>\r\n";
				if(!$ignore || $gen_num > 1) {
					$row [$rows-$gen_num] .= "\t\t<div class=\"box\" style=\"left:{$person['xpos']}px;top:{$ypos}px;width:{$width}px\">\r\n\t\t\t<div class=\"inner databack\">\r\n\t\t\t\t<div>\r\n\t\t\t\t\t";
					$url = htmlentities("getperson.php?personID={$person['personID']}&tree={$_GET['tree']}");
					//$row [$rows-$gen_num] .= "<a" . ($person['display'] ? " title=\"{$bio}\"" : "") . " href=\"{$url}\">{$person['name']}</a><br>" . getGenderIcon($person['sex'], -2);

					$rights = determineLivingPrivateRights($person);
					$photo_block = "";
					if($pedigree['inclphotos']) {
						$photo = getPhotoSrc($person['personID'], $rights['both'], $person['sex']);
						if ($photo['link'] != "") $photo_block .= "<a href=\"" . $cms['tngpath'] . $photo['link'] . "\" style=\"display:block\">";
						if ($photo['ref'] != "") $photo_block .= "<img src=\"" . $photo['ref'] . "\" alt=\"\"  class=\"vertphoto rounded4\" />";
						if ($photo['link'] != "") $photo_block .= "</a>";
					}

					$row [$rows-$gen_num] .= $photo_block . "<a" . ($person['display'] ? " title=\"{$bio}\"" : "") . " href=\"{$url}\">{$person['name']}</a><br>" . getGenderIcon($person['sex'], -2);

					if($person['display']) {
						if ($person['birthdatetr'] != '0000-00-00' || $person['altbirthdatetr'] != '0000-00-00' || $person['deathdatetr'] != '0000-00-00' || $person['burialdatetr'] != '0000-00-00' )
							$row [$rows-$gen_num] .= " ".(substr($person['birthdatetr'],0,4)!='0000' ? substr($person['birthdatetr'],0,4) : (substr($person['altbirthdatetr'],0,4)!='0000' ? substr($person['altbirthdatetr'],0,4) : '')).'-'.(substr($person['deathdatetr'],0,4) != '0000' ? substr($person['deathdatetr'],0,4) : (substr($person['burialdatetr'],0,4) != '0000' ? substr($person['burialdatetr'],0,4) : ''));
					}
					$row[$rows-$gen_num] .= "\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n\t\t</div>\r\n";
				}
				if ($gen_num > 1) {
					$row[$rows-$gen_num] .= "\t\t<div class=\"descender_container\" style=\"left:{$person['xpos']}px;top:{$line_ypos}px;height:{$spacing}px\">\r\n";
					$row[$rows-$gen_num] .= "\t\t\t<div class=\"descender {$type}\"></div>\r\n";
					$row[$rows-$gen_num] .= "\t\t</div>\r\n";
				}
			}
		}
	}
	ksort($row);

	$html = '<style type="text/css">
	#vcontainer {
		height:'.$containerheight.'px;
		width:'.($highestx+$width+2*$spacing).'px; //double the spacing to give a little padding on the end
	}
	#vcontainer div.ascender {
		height:'.$spacing.'px;
	}
	#vcontainer div.descender_container {
		height:'.$spacing.'px;
		width:'.$width.'px;
	}
	#vcontainer div.descender {
		height:'.$spacing.'px;
	}
	#vcontainer div.single {
		margin-left: '.($width/2).'px;
	}
	#vcontainer div.box {
		height:'.$height.'px;
		padding-right:'.(int)($spacing/2).'px;
	}
	#vcontainer div.box div.inner {
		font-size: '.$fontsize.'pt;
		width:'.$width.'px;
		height:'.($height-6).'px;
	}
	#vcontainer div.box div.inner div {
		width:'.$width.'px;
		height:'.($height-6).'px;
	}
	</style>';
	if(!$tngprint) {
		$html .= '<span class="normal">' . $text['scrollnote'] . '</span>
		<div id="mag-icons-div" class="mag-icons"><img src="img/zoomin.png" id="zoom-in" onclick="panzoom.zoomIn;" alt="' . $text['zoomin'] . '"/><img src="img/zoomreset.png" id="zoom-reset" alt="' . $text['tng_reset'] . '"/><img src="img/zoomout.png" id="zoom-out" alt="' . $text['zoomout'] . '"/></div>';
	}
	$html .= '<div align="left" style="position:relative;" id="outer">
	<div id="vcontainer" class="panzoom" style="overflow:visible">';
	$html .= implode ("\r\n", $row);
	$html .= '	</div></div>';
	if ($output)
		echo $html;
}
?>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function() {
	jQuery('#vcontainer').draggable();
	$("#vcontainer").on("mousedown touchstart", function(e) {
	    $(this).addClass('grabbing')
	})

	$("#vcontainer").on("mouseup touchend", function(e) {
	    $(this).removeClass('grabbing')
	})
});
//]]>
</script>
<script src="js/panzoom.min.js"></script>
<script src="js/tngzoom.js"></script>
<?php
tng_footer( $flags );
?>
