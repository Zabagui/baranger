<?php
if( !$cms['support'] )
	$tngscript = basename( $_SERVER['SCRIPT_NAME'], ".php" );
else
	$tngscript = $file;

//No index only
$NOI = "<meta name=\"robots\" content=\"noindex\" />\n";

//No follow only
$NOF = "<meta name=\"robots\" content=\"nofollow\" />\n";

//No index AND no follow
$NOINOF = "<meta name=\"robots\" content=\"noindex,nofollow\" />\n";

//each "case" is the name of the script file without the ".php" at the end
if(!empty($tngprint))
	$flags['norobots'] = $NOINOF;
else {
	switch( $tngscript ) {
		//no index, no follow
		case "addnewacct":
		case "ahnentafel":
		case "anniversaries":
		case "calendar":
		case "browsetrees":
		case "changelanguage":
		case "descend":
		case "descendtext":
		case "desctracker":
		case "gedform":
		case "login":
		case "newacctform":
		case "pdfform":
		case "pedigree":
		case "pedigreetext":
		case "places-all":
		case "places-oneletter":
		case "places":
		case "placesearch":
		case "places100":
		case "register":
		case "relateform":
		case "relationship":
		case "savelanguage2":
		case "searchform":
		case "sendlogin":
		case "showlog":
		case "suggest":
		case "timeline":
		case "timeline2":
		case "ultraped":
		case "familychart":
		case "heatmap":
		case "fan":
		case "img_viewer":
			$flags['norobots'] = $NOINOF;
			break;

		//no indexing, but allow link following
		case "browsemedia":
		case "browsedocs":
		case "browseheadstones":
		case "browsenotes":
		case "browsephotos":
		case "browserepos":
		case "browsesources":
		case "browsetrees-old":
		case "extrastree":
		case "reports":
		case "search":
		case "showreport":
		case "surnames100":
		case "whatsnew":
			$flags['norobots'] = $NOI;
			break;

		//allow full indexing
		case "cemeteries":
		case "getperson":
		case "familygroup":
		case "headstones":
		case "mostwanted":
		case "showmedia":
		case "showmap":
		case "showphoto":
		case "showrepo":
		case "showsource":
		case "showtree":
		case "surnames":
		case "surnames-all":
		case "surnames-oneletter":
			$flags['norobots'] = "";
			break;

		//all pages not named get full indexing as well
		//no pages come in here unless they include genlib.php
		default:
			//$flags['norobots'] = "";
			break;
	}
}
?>
