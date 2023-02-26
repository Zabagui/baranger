<?php
include("begin.php");
$textpart = "login";
include($cms['tngpath'] . "getlang.php");
//include($cms['tngpath'] . "$mylanguage/text.php");

$tngconfig['maint'] = "";
include($cms['tngpath'] . "genlib.php");
//include($cms['tngpath'] . "log.php" );

$tngusername = isset($tngusername) ? mysqli_real_escape_string($link, $tngusername) : "";
$tngpassword = isset($tngpassword) ? mysqli_real_escape_string($link, $tngpassword) : "";
$newpassword = isset($newpassword) ? mysqli_real_escape_string($link, $newpassword) : "";

if(!empty($admin_login)) {
	$home_url = "admin.php";
	$login_url = getURL("admin_login", 1);
	$dest_url = isset($_SESSION['destinationpage8']) && $continue ? $_SESSION['destinationpage8'] : $home_url;
}
else {
	$home_url = $homepage;
	$dest_url = isset($_SESSION['destinationpage8']) ? $_SESSION['destinationpage8'] : $home_url;
	$login_url = $requirelogin || !isset($_SESSION['destinationpage8']) || strpos($_SESSION['destinationpage8'], $home_url) !== false || substr($_SESSION['destinationpage8'],-1) == "/" ? getURL("login",1) . "message=loginfailed" : $dest_url;
}

$query = "SELECT * FROM $users_table WHERE username = \"$tngusername\"";
$result = tng_query($query) or die ("Cannot execute query: $query");
$row = tng_fetch_assoc($result);

if( tng_num_rows( $result ) === 1 && $tngusername == $row['username']) {
	$type = !empty($encrypted) ? $encrypted : $row['password_type'];
	$check = PasswordCheck( $tngpassword, $row['password'], $type );
	if($check == 2) {
	    // We have a match, an unencrypted $tngpassword, and it needs to be updated
	    $password_type = PasswordType();   // the current encryption setting
	    $password = PasswordEncode($tngpassword, $password_type);  // encrypt with the current encryption setting

	    $query2 = "UPDATE $users_table SET password=\"$password\", password_type=\"$password_type\" ";
	    $query2 .= "WHERE userID = \"{$row['userID']}\"";

	    $result2 = tng_query($query2) or die ("Cannot execute query: $query");
	}
}
else
	$check = 0;

$headerstr = $login_url;
$newroot = preg_replace( "/\//", "", $rootpath );
$newroot = preg_replace( "/ /", "", $newroot );
$newroot = preg_replace( "/\./", "", $newroot );

if($check) {
	if( $row['disabled'])
		setcookie("tngerror_$newroot", "disabled", 0, "/");
	elseif($row['allow_living'] == -1) 
		setcookie("tngerror_$newroot", "logininactive", 0, "/");
	else {
		$allow_admin = $row['allow_edit'] || $row['allow_add'] || $row['allow_delete'] ? 1 : 0;
		if(empty($admin_login) || $allow_admin) {
			$newdate = date ("Y-m-d H:i:s", time() + ( 3600 * $time_offset ) );
			if(!empty($resetpass) && $newpassword) {
				if(!$row['allow_profile'])
					$success = 2;    // inadequate permissions
				elseif($newpassword != $newpassword2)
					$success = 3;    // passwords did not match
				else {
					$row['password_type'] = PasswordType();
					$row['password'] = PasswordEncode($newpassword);
					$query = "UPDATE $users_table SET password=\"{$row['password']}\", lastlogin=\"$newdate\", password_type=\"{$row['password_type']}\" WHERE userID=\"{$row['userID']}\"";
					$uresult = tng_query($query);
					$success = tng_affected_rows();
				}
				$password_url = getURL( "pwdupdate", 1 ) . "success=" . $success;
			}
			else {
				$query = "UPDATE $users_table SET lastlogin=\"$newdate\" WHERE userID=\"{$row['userID']}\"";
				$uresult = tng_query($query) or die ("Cannot execute query: $query");
			}
			if( !empty($remember) ) {
				setcookie("tnguser_$newroot", $tngusername, time()+31536000, "/");
				setcookie("tngpass_$newroot", $row['password'], time()+31536000, "/");
				setcookie("tngpasstype_$newroot", $row['password_type'], time()+31536000, "/");
			}
			if(!empty($admin_login))
				setcookie("tngloggedin_$newroot", "1", 0, "/");

			$logged_in = $_SESSION['logged_in'] = 1;

			$allow_edit = $_SESSION['allow_edit'] = ($row['allow_edit'] == 1 ? 1 : 0);
			$allow_add = $_SESSION['allow_add'] = ($row['allow_add'] == 1 ? 1 : 0);
			$tentative_edit = $_SESSION['tentative_edit'] = $row['tentative_edit'];
			$allow_delete = $_SESSION['allow_delete'] = ($row['allow_delete'] == 1 ? 1 : 0);

			$allow_media_edit = $_SESSION['allow_media_edit'] = ($row['allow_edit'] ? 1 : 0);
			$allow_media_add = $_SESSION['allow_media_add'] = ($row['allow_add'] ? 1 : 0);
			$allow_media_delete = $_SESSION['allow_media_delete'] = ($row['allow_delete'] ? 1 : 0);

			$_SESSION['mygedcom'] = $row['mygedcom'];
			$_SESSION['mypersonID'] = $row['personID'];
			$_SESSION['allow_admin'] = $allow_admin;
			$_SESSION['tngrole'] = $row['role'];

			if( !$livedefault ) //depends on permissions
				$allow_living = $_SESSION['allow_living'] = $row['allow_living'];
			elseif( $livedefault == 2 ) //always do living
				$allow_living = $_SESSION['allow_living'] = 1;
			else //never do living
				$allow_living = $_SESSION['allow_living'] = 0;
            $allow_private = $_SESSION['allow_private'] = $row['allow_private'];
            $allow_private_notes = $_SESSION['allow_private_notes'] = $row['allow_private_notes'];

			$allow_ged = $_SESSION['allow_ged'] = $row['allow_ged'];
			$allow_pdf = $_SESSION['allow_pdf'] = $row['allow_pdf'];
			$allow_profile = $_SESSION['allow_profile'] = $row['allow_profile'];

			if( !$ldsdefault ) //always do lds
				$allow_lds = $_SESSION['allow_lds'] = 1;
			elseif( $ldsdefault == 2 )  //depends on permissions
				$allow_lds = $_SESSION['allow_lds'] = $row['allow_lds'];
			else  //never do lds
				$allow_lds = $_SESSION['allow_lds'] = 0;

			$_SESSION['availabletrees'] = $row['gedcom'];
			$trees = explode(',',$row['gedcom']);
			$numtrees = count($trees);
			if($numtrees > 1) {
				if(isset($_COOKIE['activetree:' . $tngusername]))
					$assignedtree = $_SESSION['assignedtree'] = $_COOKIE['activetree:' . $tngusername];
				else {
					$assignedtree = $_SESSION['assignedtree'] = $trees[0];
					setcookie('activetree:' . $tngusername, $assignedtree, 0, "/");
				}
			}
			else
				$assignedtree = $_SESSION['assignedtree'] = $row['gedcom'];
			$assignedbranch = $_SESSION['assignedbranch'] = $row['branch'];
			$currentuser = $_SESSION['currentuser'] = $row['username'];
			$currentuserdesc = $_SESSION['currentuserdesc'] = $row['description'];
			$session_rp = $_SESSION['session_rp'] = $rootpath;

			if($row['languageID']) {
				$_SESSION['destinationpage8'] = $dest_url;
				$dest_url = getURL("savelanguage2", 1) . "newlanguage=" . $row['languageID'];
			}
			$headerstr = !empty($password_url) ? $password_url . "&dest=$dest_url" : $dest_url;
		}
		else
			setcookie("tngerror_$newroot", "norights", 0, "/");
	}
}
else
	setcookie("tngerror_$newroot", "loginfailed", 0, "/");

tng_free_result($result);
header( "Location: $headerstr" );
?>