<?php
function tng_db_connect($dbhost,$dbname,$dbusername,$dbpassword,$dbport = null,$dbsocket = null) {
	global $textpart, $session_charset, $tng_notinstalled;

	$dbport = !empty($dbport) ? trim($dbport) : null;
	$dbsocket = !empty($dbsocket) ? trim($dbsocket) : null;
	$link = tng_connect($dbhost, $dbusername, $dbpassword, $dbname, $dbport, $dbsocket);
	//mysqli_report(MYSQLI_REPORT_OFF);
	if($link && tng_select_db($link, $dbname)) {
		mysqli_query($link, "SET SESSION sql_mode = ''");
		if($session_charset == 'UTF-8') {
			$query = "SELECT @@collation_database AS collation";
			$result = mysqli_query($link, $query);

			$collation = tng_fetch_assoc($result);
			$collation = $collation['collation'];
			tng_free_result($result);

			if( strpos($collation, "utf8mb4") !== false ) {
				tng_set_charset($link, 'utf8mb4');
			} else {
				tng_set_charset($link, 'utf8');
			}
		}
		return $link;
	}
	else if( $textpart != "setup" && $textpart != "index" ) {
		if(isset($tng_notinstalled) && $tng_notinstalled){
			header("Location:readme.html");
			exit;
		}
		else
			echo "Error: TNG is not communicating with your database. Please check your database settings and try again. Settings can be found under Admin/Setup/General Settings/Database, or at the top of your config.php file.";
		exit;
	}
	return( FALSE );
}

function tng_affected_rows() {
	global $link;
	try {
		$return = mysqli_affected_rows($link);
	} catch (mysqli_sql_exception $e) {
		$return = 0;
	}
	return $return;
}

function tng_stmt_affected_rows($stmt) {
	try {
		$return = mysqli_stmt_affected_rows($stmt);
	} catch (mysqli_sql_exception $e) {
		$return = 0;
	}
	return $return;
}

function tng_connect($dbhost, $dbusername, $dbpassword, $dbname, $dbport = null, $dbsocket = null) {
	try {
		$link = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname, $dbport, $dbsocket);
	} catch (mysqli_sql_exception $e) {
		$link = false;
	}
	return $link;
}

function tng_data_seek($result, $offset) {
	try {
		$return = mysqli_data_seek($result, $offset);
	} catch (mysqli_sql_exception $e) {
		$return = false;
	}
	return $return;
}

function tng_error() {
	global $link;
	return mysqli_error($link);
}

function tng_fetch_assoc($result) {
	return mysqli_fetch_assoc($result);
}

function tng_fetch_array($result, $resulttype = null) {
	if($resulttype == 'assoc')
		$usetype = MYSQLI_ASSOC;
	elseif($resulttype == 'num')
		$usetype = MYSQLI_NUM;
	else
		$usetype = null;
	return $usetype ? mysqli_fetch_array($result, $usetype) : mysqli_fetch_array($result);
}

function tng_field_info($result, $fieldnr, $info) {
	$fielddef = mysqli_fetch_field_direct($result, $fieldnr);

	return $fielddef->$info;
}

function tng_get_client_info() {
	global $link;
	return mysqli_get_client_info($link);
}

function tng_get_server_info() {
	global $link;
	return mysqli_get_server_info($link);
}

function tng_free_result($result) {
	return mysqli_free_result($result);
}

function tng_insert_id() {
	global $link;
	return mysqli_insert_id($link);
}

function tng_real_escape_string($escapestr) {
	global $link;

	if(isset($escapestr)) {
		$return = mysqli_real_escape_string($link, $escapestr);
	} else {
		$return = "";
	}
	return $return;
}

function tng_num_fields($result) {
	try {
		$return = mysqli_num_fields($result);
	} catch (mysqli_sql_exception $e) {
		$return = 0;
	}
	return $return;
}

function tng_num_rows($result) {
	try {
		$return = mysqli_num_rows($result);
	} catch (mysqli_sql_exception $e) {
		$return = 0;
	}
	return $return;
}

function tng_set_charset($link, $charset) {
	try {
		$return = mysqli_set_charset($link, $charset);
	} catch (mysqli_sql_exception $e) {
		$return = false;
	}
	return $return;
}

function tng_select_db($link, $dbname) {
	try {
		$return = mysqli_select_db($link, $dbname);
	} catch (mysqli_sql_exception $e) {
		$return = false;
	}
	return $return;
}

//first arg of $params must be template, ie, 'sssd'
//use for insert or update queries
//params must be passed by reference (includes template)
function tng_execute($query,$params) {
    $stmt = tng_prepare($query);
	if(!$stmt) {
		$error = mysqli_error($link);
		$errorstr = $error ? "<br /><br />$error" : "";
		echo $text['problem'] . "<br /><br />{$text['query']}: $query<br />" . implode(" | ", $params) . " " . $errorstr;
		exit;
	}
    return tng_execute_only($stmt,$query,$params);
}

function tng_execute_noerror($query,$params) {
    $stmt = tng_prepare($query);
	if(!$stmt) {
		return 0;
	}
    return tng_execute_only_noerror($stmt,$params);
}

function tng_prepare($query) {
	global $link;

	try {
		$result = mysqli_prepare($link, $query);
	} catch (mysqli_sql_exception $e) {
		$result = false;
	}
	return $result;
}

function tng_execute_only($stmt,$query,$params) {
	global $link, $text;

	try {
		call_user_func_array(array($stmt,'bind_param'),$params);
	} catch (Error $e) {
		$errorstr = $e->getMessage();
		echo $text['problem'] . "<br /><br />{$text['query']}: $query<br />" . implode(" | ", $params) . "<br /><br />" . $errorstr;
		exit;
	}
	try {
		mysqli_stmt_execute($stmt);
		$affected_rows = tng_stmt_affected_rows($stmt);
		mysqli_stmt_close($stmt);
	} catch (mysqli_sql_exception $e) {
		mysqli_stmt_close($stmt);
		$errorstr = $e->getMessage();
		echo $text['problem'] . "<br /><br />{$text['query']}: $query<br />" . implode(" | ", $params) . "<br /><br />" . $errorstr;
		exit;
	}

	return $affected_rows;
}

function tng_execute_only_noerror($stmt,$params) {
	try {
		call_user_func_array(array($stmt,'bind_param'),$params);
	} catch (Error $e) {
		return 0;
	}
	try {
		mysqli_stmt_execute($stmt);
		$affected_rows = tng_stmt_affected_rows($stmt);
		mysqli_stmt_close($stmt);
	} catch (mysqli_sql_exception $e) {
		mysqli_stmt_close($stmt);
		$affected_rows = -1;
	}

	return $affected_rows;
}

function tng_query($query) {
	global $link, $text;

	try {
		$result = mysqli_query($link, $query);
	} catch (mysqli_sql_exception $e) {
		$result = false;
	}
	if(!$result) {
		$error = mysqli_error($link);
		$errorstr = $error ? "<br /><br />$error" : "";
		echo $text['problem'] . "<br /><br />{$text['query']}: $query$errorstr";
		exit;
	}
	return $result;
}

function tng_query_noerror($query) {
	global $link;

	try {
		$result = mysqli_query($link, $query);
	} catch (mysqli_sql_exception $e) {
		$result = false;
	}
	return $result;
}
?>