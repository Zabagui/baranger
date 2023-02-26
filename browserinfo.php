<?php
// minimal browser detection (Netscape and Internet Explorer)

$br = strtolower(getenv("HTTP_USER_AGENT"));

if (
 (ereg("netscape6",  $br)) ||
 (ereg("netscape 6", $br)) ) 
 $browser = "NS6";

elseif (
 (ereg("netscape7",  $br)) ||
 (ereg("netscape/7",  $br)) ||
 (ereg("netscape 7", $br)) )
 $browser = "NS7";

elseif  (ereg("msie", $br)) {
if(ereg("msie 7.0", $br)) $browser = "IE7";
elseif(ereg("msie 6.0", $br)) $browser = "IE6";}

elseif(
 (ereg("nav", $br)) ||
 (ereg("netscape", $br)) ||
 (ereg("/4\.", $br)) )
 $browser = "NS4";

else $browser = "NA";
?>
