<?php
$textpart = "search";
include("tng_begin.php");

$cookie_name = $type == "people" ? "tng_search_people_post" : "tng_search_families_post";
$saved_cust_events = isset($_COOKIE[$cookie_name]['cust_events']) ? explode(",",stripslashes($_COOKIE[$cookie_name]['cust_events'])) : [];

$new_list = [];
foreach($saved_cust_events as $saved) {
	if($saved != $eventtypeID)
		array_push($new_list,$saved);
}

$saved_cust_events = implode(",",array_unique($new_list));
setcookie("tng_search_people_post[cust_events]", $saved_cust_events, time()+31536000, "/");

header("Content-type:text/html; charset=" . $session_charset);

echo "1";
?>