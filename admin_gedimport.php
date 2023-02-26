<?php
@ini_set('zlib.output_compression', 0);
@ini_set('implicit_flush', 1);
@ini_set( "magic_quotes_runtime", "0" );
@ini_set( "auto_detect_line_endings", "1" );
@ini_set( 'memory_limit' , '200M' );
@ob_end_clean();
$umfs = substr(ini_get("upload_max_filesize"),0,-1);
if($umfs < 15) {
	@ini_set( "upload_max_filesize", "15M" );
	@ini_set( "post_max_size", "15M" );
}

include("begin.php");
include("adminlib.php");
$textpart = "gedimport";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( empty($tree) && empty($tree1) ) 
	exit;

if( !$allow_add || !$allow_edit || $assignedbranch ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

include($subroot . "importconfig.php");
require( "datelib.php" );
require( "gedimport_trees.php" );
require( "gedimport_families.php" );
require( "gedimport_sources.php" );
require( "gedimport_people.php" );
require( "gedimport_misc.php" );
require("adminlog.php");
$today = date( "Y-m-d H:i:s" );

$readmsecs = $tngimpcfg['readmsecs'] && is_numeric($tngimpcfg['readmsecs']) ? $tngimpcfg['readmsecs'] : 750;  //every 750 milliseconds
$writeinterval = $tngimpcfg['rrnum'] && is_numeric($tngimpcfg['rrnum']) ? $tngimpcfg['rrnum'] : 100;  //every 100 records

$fullgedpath = !empty($tngimpcfg['saveconfig']) ? $subroot . $gedpath : $rootpath . $gedpath;

global $prefix, $medialinks, $albumlinks;
$medialinks = $albumlinks = array();
$num_medialinks= $num_albumlinks = 0;
$ldsOK = determineLDSRights();
if(!isset($del)) $del = "";

//added in 9.0.3
@ob_implicit_flush(true);

function initEvent() {
	$event = array();
	$event['DATE'] = "";
	$event['PLAC'] = "";
	$event['TEMP'] = "";
	$event['SOUR'] = "";
	$event['FAMC'] = "";
	$event['TYPE'] = "";
	$event['DATETR'] = "0000-00-00";
	$event['parent'] = "";

	return $event;
}

function initEventHolder() {
	$event = array();
	$event['INFO'] = initCustomEvent();
	$event['TAG'] = "";
	$event['TYPE'] = "";

	return $event;
}

function initCustomEvent() {
	$event = initEvent();

	$event['AGE'] = "";
	$event['AGNC'] = "";
	$event['CAUS'] = "";
	$event['ADDR'] = "";

	return $event;
}

function getMediaLinksToSave() {
	global $admtext, $events_table, $tree, $medialinks_table;

	$medialinks = array();
	$query = "SELECT medialinkID, mediaID, $medialinks_table.eventID, persfamID, eventtypeID, eventdate, eventplace, info
		FROM ($medialinks_table,$events_table)
		WHERE $medialinks_table.gedcom = \"$tree\" AND $medialinks_table.eventID != \"\" AND $medialinks_table.eventID = $events_table.eventID";
	$result = @tng_query($query);
	while($row = tng_fetch_assoc($result)) {
		$key = $row['persfamID'] . "::" . $row['eventtypeID'] . "::" . $row['eventdate'] . "::" . substr($row['eventplace'],0,40) . "::" . substr($row['info'],0,40);
		$key = preg_replace("/[^A-Za-z0-9:]/","",$key);
		$value = $row['medialinkID'];
		$medialinks[$key][] = $value;
		//$eventlinks[$value] = $row['eventID'];
	}
	return $medialinks;
}

function getAlbumLinksToSave() {
	global $admtext, $events_table, $tree, $album2entities_table, $medialinks_table, $link;

	$albumlinks = array();
	$query = "SELECT alinkID, albumID, $album2entities_table.eventID, entityID, eventtypeID, eventdate, eventplace, info
		FROM ($album2entities_table,$events_table)
		WHERE $album2entities_table.gedcom = \"$tree\" AND $album2entities_table.eventID != \"\" AND $album2entities_table.eventID = $events_table.eventID";
	$result = @tng_query($query);
	while($row = tng_fetch_assoc($result)) {
		$key = $row['entityID'] . "::" . $row['eventtypeID'] . "::" . $row['eventdate'] . "::" . substr($row['eventplace'],0,40) . "::" . substr($row['info'],0,40);
		$key = preg_replace("/[^A-Za-z0-9:]/","",$key);
		$value = $row['alinkID'];
		$albumlinks[$key][] = $value;
	}
	return $albumlinks;
}

tng_adminheader( $admtext['datamaint'], $flags );
?>
</head>

<?php
	if(!empty($old)) {
		echo tng_adminlayout();
		$helplang = findhelp("data_help.php");
		
		$allow_export = 1;
		if( !$allow_ged && $assignedtree ) {
			$query = "SELECT disallowgedcreate FROM $trees_table WHERE gedcom = \"$assignedtree\"";
			$disresult = tng_query($query);
			$row = tng_fetch_assoc( $disresult );
			if($row['disallowgedcreate'])
				$allow_export = 0;
			tng_free_result($disresult);
		}
		$datatabs['0'] = array(1,"admin_dataimport.php",$admtext['import'],"import");
		$datatabs['1'] = array($allow_export,"admin_export.php",$admtext['export'],"export");
		$datatabs['2'] = array(1,"admin_secondmenu.php",$admtext['secondary'],"second");
		$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/data_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
		$menu = doMenu($datatabs,"import",$innermenu);
		echo displayHeadline($admtext['datamaint'] . " &gt;&gt; " . $admtext['gedimport'],"img/data_icon.gif",$menu,$message);

		echo "<div class=\"lightback\" style=\"padding:2px\">\n";
		echo "<div class=\"databack normal\" style=\"padding:5px\">\n";
	}
	else {
		echo "<body>\n";
		echo "<div id=\"maincontent\">\n";
	}
?>
<!--<div class="lightback pad2">
<div class="databack normal pad5">-->

<?php 
$stdevents = array("BIRT","SEX","DEAT","BURI","MARR","SLGS","SLGC","NICK","NSFX","TITL","BAPL","CONL","INIT","ENDL","CHAN","CALN","AUTH","PUBL","ABBR","TEXT" );
$pciteevents = array("NAME","BIRT","ALTBE","DEAT","BURI","BAPL","CONL","INIT","ENDL","SLGC");
$fciteevents = array("MARR","DIV","SLGS");

if(!empty($importmedia))
	initMediaTypes();

function tng_extract($gedfilename) {
	global $rootpath, $fullgedpath, $savegedfilename, $basefilename, $photopath, $importmedia, $mediatypes_assoc, $tree, $tngconfig;

	$newgedfilename = $gedfilename;
	$treestr = $tngconfig['mediatrees'] && $tree ? ("/" . $tree) : "";
	if(class_exists('ZipArchive')) {
		$zip = new ZipArchive; 
		if($zip->open($gedfilename)) {
			for($i = 0; $i < $zip->numFiles; $i++) {
				$zfile = $zip->getNameIndex($i);
				if(strtolower(pathinfo($zfile, PATHINFO_EXTENSION)) == "ged") {
					$zip->extractTo($fullgedpath, $zfile);
					$basefilename = $savegedfilename = $zfile;
					$newgedfilename = "$fullgedpath/$zfile";
					if(empty($importmedia))
						break;
				}
				elseif(!empty($importmedia)) { //send all others to photos path as media
					$found = array_search(strtok($zfile,"/"), $mediatypes_assoc);
					$destination = $found ? $rootpath : $rootpath . $photopath . $treestr;
					$zip->extractTo($destination, $zfile);
				}
			}
			if($zip->numFiles) $zip->close();
		} 
	}
	return $newgedfilename;
}

//read first line into $line
@set_time_limit(0);
$fp = false;
$savestate['filename'] = "";
$errormsg = "";
$gedfilename = "";
$clearedtogo = false;

if($saveimport && empty($resuming)) {
	$query = "DELETE from $saveimport_table";
	$result = tng_query($query);
}

if( !empty($remotefile) && $remotefile != "none" ) {
	$basefilename = preg_replace("/[^a-zA-Z0-9\._-]/", "_",basename($_FILES['remotefile']['name']));
	$gedfilename = "$fullgedpath/$basefilename";
	$savegedfilename = $basefilename;

	if( @move_uploaded_file($remotefile, $gedfilename) ) {
		@chmod( $gedfilename, 0644 );

		$gedfilename = tng_extract($gedfilename);

		$fp = @fopen($gedfilename,"r");
		//$fp = @fopen("xxx","r");
		if( $fp === false ) {
			$errormsg = $admtext['cannotopen'] . " $basefilename. " . $admtext['umps'];
		}
		else {
			$fstat = fstat($fp);
			$savestate['filename'] = $gedfilename;
			$clearedtogo = true;
			if(!empty($old))
				echo "<strong>$remotefile {$admtext['opened']}</strong><br/>\n";
		}
	}
	else {
		$errormsg = $admtext['cannotupload'] . " " . $_FILES['remotefile']['name']. ". " . $admtext['invfperms'];
	}
}
elseif( !empty($database) ) {
	$gedfilename = $gedpath == "admin" || $gedpath == "" ? $database : "$fullgedpath/$database";
	$savegedfilename = $database;

	$orgname = $gedfilename;
	$gedfilename = tng_extract($gedfilename);
	//echo "opening $gedfilename ";

	$fp = @fopen($gedfilename,"r");
	if( $fp === false ) {
		$errormsg = $admtext['cannotopen'] . " $database";
	}
	else {
		$fstat = fstat($fp);
		$savestate['filename'] = $gedfilename;
		$clearedtogo = true;
		if(!empty($old))
			echo "<strong>$database {$admtext['opened']}</strong><br/>\n";
	}
}
elseif(!empty($resuming) && !$resuming)
	$errormsg = $admtext['cannotopen'] . ". " . $admtext['umps'];

$allcount = 0;
if( $savestate['filename'] ) {
	$tree = $tree1; //selected
	$query = "UPDATE $trees_table SET lastimportdate=\"$today\", importfilename=\"$savegedfilename\" WHERE gedcom=\"$tree\"";
	$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
		
	if( $del == "append" ) {
		//calculate offsets
		if( $offsetchoice == "auto" ) {
			$savestate['ioffset'] = getNewNumericID( "person", "person", $people_table );
			$savestate['foffset'] = getNewNumericID( "family", "family", $families_table );
			$savestate['soffset'] = getNewNumericID( "source", "source", $sources_table );
			$savestate['noffset'] = getNewNumericID( "note", "note", $xnotes_table );
			$savestate['roffset'] = getNewNumericID( "repo", "repo", $repositories_table );
		}		
		else
			$savestate['ioffset'] = $savestate['foffset'] = $savestate['soffset'] = $savestate['noffset'] = $savestate['roffset'] = $useroffset;
		$savestate['del'] = "match";
	}
	else {
		$savestate['del'] = $del;
		$savestate['ioffset'] = $savestate['foffset'] = $savestate['soffset'] = $savestate['noffset'] = $savestate['roffset'] = 0;
	}

	$savestate['icount'] = 0;
	$savestate['fcount'] = 0;
	$savestate['scount'] = 0;
	$savestate['mcount'] = 0;
	$savestate['ncount'] = 0;
	$savestate['pcount'] = 0;
	$savestate['fileoffset'] = 0;
	$savestate['ucaselast'] = !empty($ucaselast) ? 1 : 0;
	$savestate['norecalc'] = !empty($norecalc) ? 1 : 0;
	$savestate['neweronly'] = !empty($neweronly) ? 1 : 0;
	$savestate['allevents'] = !empty($allevents) ? 1 : 0;
	$savestate['media'] = !empty($importmedia) ? 1 : 0;
	$savestate['latlong'] = !empty($importlatlong) ? 1 : 0;
	$savestate['branch'] = !empty($branch1) ? $branch1 : "";
	$allcount = 0;
	$mll = $savestate['media'] * 10 + $savestate['latlong'];

	if( $saveimport ) {
		$sql = "INSERT INTO $saveimport_table (filename, icount, ioffset, fcount, foffset, scount, soffset, mcount, pcount, ncount, noffset, roffset, fileoffset, delvar, ucaselast, norecalc, neweronly, allevents, media, gedcom, branch)  
			VALUES(\"{$savestate['filename']}\", 0, \"{$savestate['ioffset']}\", 0, \"{$savestate['foffset']}\", 0, \"{$savestate['soffset']}\", 0, 0, 0, \"{$savestate['noffset']}\", \"{$savestate['roffset']}\", 0, \"$del\", {$savestate['ucaselast']}, {$savestate['norecalc']}, {$savestate['neweronly']}, {$savestate['allevents']}, $mll, \"$tree\", \"{$savestate['branch']}\")";
		$result = @tng_query( $sql ) or die ($admtext['cannotexecutequery'] . ": $sql");
	}
}
elseif( $saveimport && !$errormsg ){
	$checksql = "SELECT filename, icount, ioffset, fcount, foffset, scount, soffset, mcount, pcount, ncount, noffset, roffset, fileoffset, ucaselast, norecalc, neweronly, allevents, media, branch, delvar from $saveimport_table WHERE gedcom = \"$tree\"";
	$result = @tng_query( $checksql ) or die ($admtext['cannotexecutequery'] . ": $checksql");
	$found = tng_num_rows( $result );
	if( $found ) {
		$row = tng_fetch_assoc($result);
		$savestate['icount'] = $row['icount'];
		$savestate['fcount'] = $row['fcount'];
		$savestate['scount'] = $row['scount'];
		$savestate['mcount'] = $row['mcount'];
		$savestate['ncount'] = $row['ncount'];
		$savestate['pcount'] = $row['pcount'];
		$allcount = $savestate['icount'] + $savestate['fcount'] + $savestate['scount'] + $savestate['ncount'] + $savestate['mcount'] + $savestate['pcount'];
		$savestate['ioffset'] = $row['ioffset'];
		$savestate['foffset'] = $row['foffset'];
		$savestate['soffset'] = $row['soffset'];
		$savestate['noffset'] = $row['noffset'];
		$savestate['roffset'] = $row['roffset'];
		$savestate['filename'] = $row['filename'];
		$savestate['fileoffset'] = $row['fileoffset'];
		$savestate['del'] = $row['delvar'];
		$savestate['ucaselast'] = $row['ucaselast'];
		$savestate['norecalc'] = $row['norecalc'];
		$savestate['neweronly'] = $row['neweronly'];
		$savestate['allevents'] = $row['allevents'];
		$savestate['media'] = ($row['media'] > 9) ? 1 : 0;
		$savestate['latlong'] = $row['media'] % 2;
		$savestate['branch'] = $row['branch'];
		if( $savestate['del'] == "yes" )
			$savestate['del'] = "match";
		$gedfilename = $savestate['filename'];
		$fp = fopen($savestate['filename'],"r");
		if($fp !== false) {
			$fstat = fstat($fp);
			fseek( $fp, $savestate['fileoffset'] );
			$clearedtogo = true;
		}
		else {
			$errormsg = $admtext['cannotopen'] . " " . $savestate['filename'] . " " . $admtext['toresume'];
		}
	}
	else {
		$errormsg = $admtext['notresumed'] . " " . $admtext['maybedone'];
	}
}
elseif(!$clearedtogo) {
	$errormsg = $admtext['notresumed'] . " " . $admtext['turnonsis'];
}

if(!empty($old)) {
    echo "<p class=\"normal\">$openmsg</p>\n";
    if($clearedtogo && $saveimport && (!$remotefile || $remotefile == "none") )
        echo "<p class=\"normal\">{$admtext['ifimportfails']} <a href=\"admin_gedimport.php?tree=$tree&amp;old=1\">{$admtext['clickresume']}</a>.</p>\n";
}
else {
?>
<script type="text/javascript">
	parent.started = <?php echo $clearedtogo; ?>;
<?php
	if($errormsg) {
?>
		clearTimeout('timecheck');
		var msgdiv = parent.document.getElementById('importmsg');
		msgdiv.innerHTML = "<?php echo $errormsg; ?>";
		parent.done = true;
<?php
	}
?>
</script>

<?php
	//kill the process intentionally when upload is finished
	if($errormsg || (!empty($remotefile) && $remotefile != "none")) {
		exit;
	}
}

if($fp !== false) {
	@flush();
	//get all medialinks+events where eventID is not blank
	//if it's the first time or the first resume
	if($del != "append" && $del != "no") {
		$medialinks = getMediaLinksToSave();
		$num_medialinks = count($medialinks);
			
		$albumlinks = getAlbumLinksToSave();
		$num_albumlinks = count($albumlinks);
	}
	if( (empty($resuming) || !empty($first)) && $del == "yes" )
		ClearData( $tree );

	$savestate['livingstr'] = $savestate['norecalc'] ? "" : ", living";
	if( !$tngimpcfg['maxlivingage'] ) $tngimpcfg['maxlivingage'] = 110;

	//get custom event types
	$query = "SELECT eventtypeID, tag, description, keep, type, display FROM $eventtypes_table";
	$result = @tng_query($query);
	$custeventlist = array();
	while( $row = tng_fetch_assoc($result)) {
		$eventtype = strtoupper($row['type'] . "_" . $row['tag'] . "_" . $row['description']);
		$custevents[$eventtype]['keep'] = $row['keep'];
		$custevents[$eventtype]['display'] = $row['display'];
		$custevents[$eventtype]['eventtypeID'] = $row['eventtypeID'];
		if( $row['keep'] && !in_array( $eventtype, $custeventlist ) ) {
			array_push( $custeventlist, $eventtype );  //used to be $row['tag']
		}
	}
	tng_free_result($result);

	$custnametypes = array("ALIA", "_ADPN", "_HEBN", "_CENS", "_MARNM", "_FRKA", "_RELN", "_CALL", "_OTHN");
	$stdnotes = array();
	$notecount = 0;

	$lineinfo = getLine( );
	while( $lineinfo['tag'] ) {
		if( $lineinfo['level'] == 0 ) {
			preg_match( "/^@(\S+)@/", $lineinfo['tag'], $matches );
			$id = isset($matches[1]) ? $matches[1] : "";
			$rest = trim($lineinfo['rest']);
			switch ( $rest ) {
				case "FAM":
					getFamilyRecord( $id, 0 );
					break;
				case "INDI":
					getIndividualRecord( $id, 0 );
					break;
				case "SOUR":
					getSourceRecord( $id, 0 );
					break;
				case "REPO":
					getRepoRecord( $id, 0 );
					break;
				case "SNOTE":
				case "NOTE":
					getNoteRecord( $id, 0, $rest );
					break;
				case "_LOC":  //alternate place name structure
					getPlaceRecord( $id, 0 );
					break;
				case "OBJE":
					if( $savestate['media'] ) {
						$mminfo = array();
						getMultimediaRecord( $id, 0 );
					}
					else
						$lineinfo = getLine( );
					break;
				default:
					$token = strtok( $rest, " " );
					if( $token == "NOTE" || $token == "SNOTE" )
						getNoteRecord( $id, 0, $token );
					else {
						if($id) {
							$nextpart = strtok($rest," ");
							$len = strlen($nextpart);
							$rest = substr($rest,$len+1);
						}
						else
							$nextpart = $lineinfo['tag'];
						if($nextpart == "_PLAC" || $nextpart == "_PLAC_DEFN" || $nextpart == "PLAC")
							getPlaceRecord( $rest, 0 );
						else
							$lineinfo = getLine( );
					}
					break;
			}
		}
		else
			$lineinfo = getLine();
		@flush();
	}
	@fclose( $fp );

	//blank out remaining event-based media links
	//foreach($medialinks as $medialinkarr) {
		//foreach($medialinkarr as $medialinkID) {
			//$query = "UPDATE $medialinks_table SET eventID = \"\" WHERE medialinkID = \"$medialinkID\"";
			//$result = @tng_query($query);
			//if(!tng_affected_rows()) {
				//$query = "DELETE FROM $medialinks_table WHERE medialinkID = \"$medialinkID\"";
				//$result = @tng_query($query);
			//}
		//}
	//}
	//delete remaining holdover events (used for media link preservation)
	//$query = "DELETE from $events_table WHERE gedcom = \"$tree\" AND persfamID = \"XXX\"";
	//$result = @tng_query($query);

	//if( $saveimport ) {
	//	$sql = "DELETE from $saveimport_table WHERE gedcom = \"$tree\"";
	//	$result = @tng_query($sql) or die ($admtext['cannotexecutequery'] . ": $query");
	//}
	$treemsg = $tree ? ", " . $admtext['tree'] . ": $tree" : "";
	adminwritelog( "{$admtext['gedimport']}: " . $admtext['filename'] . ": " . basename($savestate['filename']) . "$treemsg; {$savestate['icount']} {$admtext['people']}, {$savestate['fcount']} {$admtext['families']}, {$savestate['scount']} {$admtext['sources']}, {$savestate['ncount']} {$admtext['notes']}, {$savestate['mcount']} {$admtext['media']}, {$savestate['pcount']} {$admtext['places']}" );
    if(!empty($old)) {
    	echo "<p>{$admtext['finishedimporting']}<br/>" . number_format($savestate['icount']) . " {$admtext['people']} &nbsp; " . number_format($savestate['fcount']) . " {$admtext['families']} &nbsp; " . number_format($savestate['scount']) . " {$admtext['sources']} &nbsp; " . number_format($savestate['ncount']) . " {$admtext['notes']} &nbsp; " . number_format($savestate['mcount']) . " {$admtext['media']} &nbsp; " . number_format($savestate['pcount']) . " {$admtext['places']}</p>";
    }
    else
    	$finalmsg = $admtext['finishingimporting'];
}
else
	$finalmsg = $admtext['fileuploadfailed'];

if(!empty($old)) {
	echo "<p><a href=\"admin_secondary.php?secaction={$admtext['tracklines']}&amp;tree=$tree\">{$admtext['tracklines']}</a></p>";
	echo "<p><a href=\"admin_dataimport.php\">{$admtext['backtodataimport']}</a></p>\n";
	echo "</div></div>\n";
}
else {
?>
<script type="text/javascript">
	clearTimeout('timecheck');
	var msgdiv = parent.document.getElementById('importmsg');
	msgdiv.innerHTML = "<?php echo $finalmsg; ?>";
	parent.done = true;
</script>
<?php

}
?>
<?php 
echo tng_adminfooter();
?>