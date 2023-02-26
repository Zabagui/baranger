<?php
function adminwritelog( $string ) {
	global $admtext, $currentuser, $currentuserdesc, $rootpath, $time_offset, $subroot;
	
	require($subroot . "logconfig.php");

	$string = "<td class=\"lightback\">$string</td>";

	$string .= "<td class=\"lightback\">{$admtext['user']}: <a href=\"admin_edituser.php?username=$currentuser\">$currentuser | $currentuserdesc</a>";
		
	$lines = file( $adminlogfile );
	if( $adminmaxloglines && sizeof( $lines ) >= $adminmaxloglines ) {
		array_pop( $lines );
	}
	$updated = date ("D d M Y H:i:s", time() + ( 3600 * intval($time_offset) ) );
	array_unshift( $lines, "<tr><td class=\"lightback adminlog\">$updated</td>" . trim($string) . "</tr>\n" );
	
	$fp = @fopen( $adminlogfile, "w" );
	if( !$fp ) { die ( "{$admtext['cannotopen']} $adminlogfile" ); }
	
	flock( $fp, LOCK_EX );
	$linecount = 0;
	foreach ( $lines as $line ) {
		trim( $line );
		if( $line )
			fwrite( $fp, $line );
		$linecount++;
		if( $linecount == $adminmaxloglines ) break;
	}
	flock( $fp, LOCK_UN );
	fclose( $fp );
}
?>
