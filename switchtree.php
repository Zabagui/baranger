<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
$newtree = preg_replace("/[^A-Za-z0-9\._\-]/", '', $_GET['newtree']);
$return_page = $_GET['ret'];

$_SESSION['assignedtree'] = $newtree;
setcookie('activetree:' . $_SESSION['currentuser'], $newtree, 0, "/");

header( "Location: $return_page" );
?>