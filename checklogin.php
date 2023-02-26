<?php
	$assignedtree = isset( $_SESSION['assignedtree'] ) ? $_SESSION['assignedtree'] : '';
	$assignedbranch = isset( $_SESSION['assignedbranch'] ) ? $_SESSION['assignedbranch'] : '';
	$currentuser = isset($_SESSION['currentuser']) ? $_SESSION['currentuser'] : '';
	$currentuserdesc = isset($_SESSION['currentuserdesc']) ? $_SESSION['currentuserdesc'] : '';
	$thispage = getScriptName(false);

	global $admin_login;
	$need_assigned_tree = (!isset($orgtree) || !$orgtree) && $defaulttree && $assignedtree && $assignedtree != "-x-guest-x-";

	if( isset($_SESSION['postvars']) && is_array( $_SESSION['postvars'] ) ) {
		foreach( $_SESSION['postvars'] as $key=>$value ) {
			${$key} = $value;
		}
		$postvars = $_SESSION['postvars'] = "";
	}
	elseif(!$admin_login) {
		$postvars = $_SESSION['postvars'] = $_POST;
		$nodest_array = array("admi","ajx_","rpt_","find","tngr","gedc","goog","img_");
		if( empty($tngprint) && !in_array(substr(basename($thispage),0,4),$nodest_array) && empty($maintenance_mode) ) {
			$protocol = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off" ? "https://" : "http://";
			$destinationpage = $_SESSION['destinationpage8'] = $protocol . $_SERVER['HTTP_HOST'];
			$destinationpage = $_SESSION['destinationpage8'] .= $thispage;
		}
	}

//echo "li=" . $_SESSION['logged_in'] . ", srp=" . $_SESSION['session_rp'] . ", rp=$rootpath, al=$admin_login, aadb=" . $_SESSION['allow_admin'] . ", cu=$currentuser";
//exit;
	if( isset( $_SESSION['logged_in'] ) && $_SESSION['session_rp'] == $rootpath && (!$admin_login || ($_SESSION['allow_admin'] && $currentuser))) {
		if ($currentuser == "Administrator-No-Users-Yet" ) {
			$query = "SELECT userID FROM $users_table";
			$result = @tng_query_noerror($query);
			if($result && tng_num_rows( $result )) {
				echo "$currentuser" . " is not a valid user";
				exit;
			}
			if($result) tng_free_result($result);
		}
		$allow_admin = $_SESSION['allow_admin'];
		$allow_edit = $_SESSION['allow_edit'];
		$allow_add = $_SESSION['allow_add'];
		$tentative_edit = $_SESSION['tentative_edit'];
		$allow_delete = $_SESSION['allow_delete'];
		$allow_media_edit = $_SESSION['allow_media_edit'];
		$allow_media_add = $_SESSION['allow_media_add'];
		$allow_media_delete = $_SESSION['allow_media_delete'];
		$allow_living = $_SESSION['allow_living'];
		$allow_private = $_SESSION['allow_private'];
		$allow_private_notes = $_SESSION['allow_private_notes'];
		$allow_ged = $_SESSION['allow_ged'];
		$allow_pdf = $_SESSION['allow_pdf'];
		$allow_lds = $_SESSION['allow_lds'];
		$allow_profile = $_SESSION['allow_profile'];
		$logged_in = 1;
	}
	else {
		$query = "SELECT userID FROM $users_table";
		$result = @tng_query_noerror($query);
		if(!$result || !tng_num_rows( $result )) {
			$allow_admin = 1;
			$allow_edit = 1;
			$allow_add = 1;
			$tentative_edit = 0;
			$allow_delete = 1;
			$allow_media_edit = 1;
			$allow_media_add = 1;
			$allow_media_delete = 1;
			$allow_living = 1;
			$allow_private = 1;
			$allow_private_notes = 1;
			$allow_ged = $allow_pdf = $allow_profile = 1;
			$allow_lds = 1;
			$_SESSION['currentuser'] = "Administrator-No-Users-Yet";
			$_SESSION['currentuserdesc'] = "Administrator";
			$_SESSION['assignedtree'] = "";
			$logged_in = $_SESSION['logged_in'] = 1;
			if(!$rootpath) {
				$rootpath = dirname(__FILE__) . "/";
				if (preg_match("/WIN/i",PHP_OS)) {
				    $rootpath = str_replace("\\","/",$rootpath);
				}
			}
			$_SESSION['session_rp'] = $rootpath;
			$_SESSION['tngrole'] = "admin";
		}
		else {
			if($admin_login == 1) {
				$postvars = $_SESSION['postvars'] = $_POST;
				$protocol = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off" ? "https://" : "http://";
				$destinationpage = $_SESSION['destinationpage8'] = $protocol . $_SERVER['HTTP_HOST'];
				$destinationpage = $_SESSION['destinationpage8'] .= $_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : $_SERVER['SCRIPT_NAME'] . "?" . $_SERVER['QUERY_STRING'];
			}
			$newroot = preg_replace( "/\//", "", $rootpath );
			$newroot = preg_replace( "/ /", "", $newroot );
			$newroot = preg_replace( "/\./", "", $newroot );
			$usercookiename = "tnguser_$newroot";
			if( isset( $_COOKIE[$usercookiename] ) ) { 
				$passcookiename = "tngpass_$newroot";
				$passtype = "tngpasstype_$newroot";
				$adminloginstr = $admin_login ? "admin_login=1&continue=1&" : "";
				header( "Location: " . $cms['tngpath'] . "processlogin.php?{$adminloginstr}tngusername=" . $_COOKIE[$usercookiename] . "&tngpassword=" . $_COOKIE[$passcookiename] . "&encrypted=encrypted" );
				exit;
			}
			if( $admin_login ) {
				header( "Location: admin_login.php?continue=1" );
				exit;
			}
			elseif( $requirelogin ) {
				if(!substr_count( $_SERVER['SCRIPT_NAME'], "/index." ) && !substr_count( $_SERVER['SCRIPT_NAME'], "/ajx_tnginstall.php" )) {
					header( "Location: " . getURL("login", 0));
					exit;
				}
			}
			else {
				$_SESSION['currentuser'] = "";
				$_SESSION['currentuserdesc'] = "";
				$_SESSION['mygedcom'] = "";
				$_SESSION['mypersonID'] = "";
				$_SESSION['assignedtree'] = "-x-guest-x-";
				$_SESSION['tngrole'] = "guest";

				$allow_admin = 0;
				$allow_edit = $allow_add = $tentative_edit = $allow_delete = $allow_media_add = $allow_media_edit = $allow_media_delete = 0;
				$allow_living = $livedefault == 2 ? 1 : 0;
        		$allow_private = 0;
        		$allow_private_notes = 0;
				$allow_ged = $allow_pdf = $allow_profile = 0;
				$allow_lds = $ldsdefault ? 0 : 1;

				$assignedtree = $_SESSION['assignedtree'];
				$currentuser = $_SESSION['currentuser'];
				$currentuserdesc = $_SESSION['currentuserdesc'];
				$_SESSION['session_rp'] = $rootpath;
			}
		}
		if($result) tng_free_result($result);

		//set session vars here if not previously logged in
		$_SESSION['allow_admin'] = isset($allow_admin) ? $allow_admin : 0;
		$_SESSION['allow_edit'] = isset($allow_edit) ? $allow_edit : 0;
		$_SESSION['allow_add'] = isset($allow_add) ? $allow_add : 0;
		$_SESSION['tentative_edit'] = isset($tentative_edit) ? $tentative_edit : 0;
		$_SESSION['allow_delete'] = isset($allow_delete) ? $allow_delete : 0;
		$_SESSION['allow_media_edit'] = isset($allow_media_edit) ? $allow_media_edit : 0;
		$_SESSION['allow_media_add'] = isset($allow_media_add) ? $allow_media_add : 0;
		$_SESSION['allow_media_delete'] = isset($allow_media_delete) ? $allow_media_delete : 0;
		$_SESSION['allow_living'] = isset($allow_living) ? $allow_living : 0;
		$_SESSION['allow_private'] = isset($allow_private) ? $allow_private : 0;
		$_SESSION['allow_private_notes'] = isset($allow_private_notes) ? $allow_private_notes : 0;
		$_SESSION['allow_ged'] = isset($allow_ged) ? $allow_ged : 0;
		$_SESSION['allow_pdf'] = isset($allow_pdf) ? $allow_pdf : 0;
		$_SESSION['allow_lds'] = isset($allow_lds) ? $allow_lds : 1;
		$_SESSION['allow_profile'] = isset($allow_profile) ? $allow_profile : 0;
	}

	if( $need_assigned_tree )
		$tree = $assignedtree;

	$postvars = $_SESSION['postvars'] = "";
	unset( $_SESSION['postvars'] );
?>