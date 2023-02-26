<?php
	include("begin.php");
	include("adminlib.php");
	$textpart = "setup";
	//include("getlang.php");
	include("$mylanguage/admintext.php");

	if(!count($_POST)) {
		header("Location: admin.php");
		exit;
	}
	
	if( $link ) {
		$admin_login = 1;
		include("checklogin.php");

		if( $assignedtree || !$allow_edit ) {
			$message = $admtext['norights'];
			header( "Location: admin_login.php?message=" . urlencode($message) );
			exit;
		}
	}

	require("adminlog.php");

	$fp = @fopen( $subroot . "importconfig.php", "w",1 );
	if( !$fp ) { die ( $admtext['cannotopen'] . " importconfig.php" ); }

	$localphotopathdisplay = addslashes( $localphotopathdisplay );
	$localhistorypathdisplay = addslashes( $localhistorypathdisplay );
	$localdocumentpathdisplay = addslashes( $localdocumentpathdisplay );
	$localotherpathdisplay = addslashes( $localotherpathdisplay );
	$localhspathdisplay = addslashes( $localhspathdisplay );
	
	if(!$readmsecs) $readmsecs = 750;
	//if(!$checksecs) $checksecs = 20;
	if(!$rrnum) $rrnum = 100;
	if(!isset($saveimport)) $saveimport = "";
	if(!isset($assignnames)) $assignnames = "";
	if(!isset($saveconfig) ) $saveconfig = "";

	flock( $fp, LOCK_EX );

	fwrite( $fp, "<?php\n" );
	fwrite( $fp, "\$gedpath = \"$gedpath\";\n" );
	fwrite( $fp, "\$tngimpcfg['saveconfig'] = \"$saveconfig\";\n" );
	fwrite( $fp, "\$saveimport = \"1\";\n" );
	fwrite( $fp, "\$tngimpcfg['rrnum'] = \"$rrnum\";\n" );
	fwrite( $fp, "\$tngimpcfg['readmsecs'] = \"$readmsecs\";\n" );
	//fwrite( $fp, "\$tngimpcfg[checksecs] = \"$checksecs\";\n" );
	fwrite( $fp, "\$assignnames = \"$assignnames\";\n" );
	fwrite( $fp, "\$tngimpcfg['defimpopt'] = \"$defimpopt\";\n" );
	fwrite( $fp, "\$tngimpcfg['chdate'] = \"$blankchangedt\";\n" );
	fwrite( $fp, "\$tngimpcfg['livingreqbirth'] = \"$livingreqbirth\";\n" );
	fwrite( $fp, "\$tngimpcfg['maxlivingage'] = \"$maxlivingage\";\n" );
	fwrite( $fp, "\$tngimpcfg['maxprivyrs'] = \"$maxprivyrs\";\n" );
	fwrite( $fp, "\$tngimpcfg['maxdecdyrs'] = \"$maxdecdyrs\";\n" );
	fwrite( $fp, "\$tngimpcfg['maxmarriedage'] = \"$maxmarriedage\";\n" );
	fwrite( $fp, "\$locimppath['photos'] = \"$localphotopathdisplay\";\n" );
	fwrite( $fp, "\$locimppath['histories'] = \"$localhistorypathdisplay\";\n" );
	fwrite( $fp, "\$locimppath['documents'] = \"$localdocumentpathdisplay\";\n" );
	fwrite( $fp, "\$locimppath['headstones'] = \"$localhspathdisplay\";\n" );
	fwrite( $fp, "\$locimppath['other'] = \"$localotherpathdisplay\";\n" );
	fwrite( $fp, "\$wholepath = \"$wholepath\";\n" );
	fwrite( $fp, "\$tngimpcfg['privnote'] = \"$privnote\";\n" );
	fwrite( $fp, "\$tngimpcfg['coerce'] = \"$coerce\";\n" );
	fwrite( $fp, "?>" );

	flock( $fp, LOCK_UN );
	fclose( $fp );

	adminwritelog( $admtext['modifyimportsettings'] );

	if( !empty($submitx) ) {
		header( "Location: admin_importconfig.php" );
	}
	else {
		header( "Location: admin_setup.php" );
	}
?>