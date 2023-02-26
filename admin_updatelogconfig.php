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
		include("version.php");

		if( $assignedtree || !$allow_edit ) {
			$message = $admtext['norights'];
			header( "Location: admin_login.php?message=" . urlencode($message) );
			exit;
		}
	}

	require("adminlog.php");

	$fp = @fopen( $subroot . "logconfig.php", "w",1 );
	if( !$fp ) { die ( $admtext['cannotopen'] . " logconfig.php" ); }

	if( !isset($logsaveconfig) ) $logsaveconfig = "";
	$logfile = $logsaveconfig ? "\$subroot . \$logname" : "\$rootpath . \$logname"; 

	flock( $fp, LOCK_EX );

	fwrite( $fp, "<?php\n" );
	fwrite( $fp, "\$logname = \"$logname\";\n" );
	fwrite( $fp, "\$logfile = $logfile;\n" );
	fwrite( $fp, "\$logsaveconfig = \"$logsaveconfig\";\n" );
	fwrite( $fp, "\$maxloglines = \"$maxloglines\";\n" );
	fwrite( $fp, "\$badhosts = \"$badhosts\";\n" );
	fwrite( $fp, "\$exusers = \"$exusers\";\n" );
	fwrite( $fp, "\$adminlogfile = \"$adminlogfile\";\n" );
	fwrite( $fp, "\$adminmaxloglines = \"$adminmaxloglines\";\n" );
	fwrite( $fp, "\$addr_exclude = \"$addr_exclude\";\n" );
	fwrite( $fp, "\$msg_exclude = \"$msg_exclude\";\n" );
	fwrite( $fp, "?>" );

	flock( $fp, LOCK_UN );
	fclose( $fp );

	$logfile = $logsaveconfig ? $subroot . $logname : $rootpath . $logname; 
	$fp = fopen( $logfile, "c" );
    if( !$fp ) { die ( "{$admtext['cannotopen']} $logname" ); }
    fclose( $fp );

	$adminlogfile = $logsaveconfig ? $subroot . $adminlogfile : $rootpath . $adminlogfile; 
	$fp = fopen( $adminlogfile, "c" );
    if( !$fp ) { die ( "{$admtext['cannotopen']} $adminlogfile" ); }
    fclose( $fp );

	adminwritelog( $admtext['modifylogsettings'] );

	if( !empty($submitx) ) {
		header( "Location: admin_logconfig.php" );
	}
	else {
		header( "Location: admin_setup.php" );
	}
?>
