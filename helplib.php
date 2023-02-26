<?php
function help_header($helptitle) {
	$relpath = "../../";
	include($relpath . "begin.php");
	include($relpath . "version.php");
	$header = $tngconfig['doctype'] ? $tngconfig['doctype'] . "\n\n" : "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \n\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n\n";
	$header .= "<!-- $tng_title, v.$tng_version ($tng_date), Written by Darrin Lythgoe, $tng_copyright -->\n";
	$header .= "<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"en\" xml:lang=\"en\">\n";
	$header .= "<head>\n";
	$header .= "<title>$helptitle</title>\n";
    $header .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$session_charset\" />\n";
	$header .= "<link href=\"{$relpath}css/genstyle.css?v=$tng_version\" rel=\"stylesheet\" type=\"text/css\" />\n";
	$header .= "<link href=\"{$relpath}{$templatepath}css/templatestyle.css?v=$tng_version\" rel=\"stylesheet\" type=\"text/css\" />\n";
	$header .= "<link href=\"{$relpath}{$templatepath}css/mytngstyle.css?v=$tng_version\" rel=\"stylesheet\" type=\"text/css\" />\n";
	$header .= file_get_contents($relpath . "adminmeta.php");
	$header .= "<style>p {margin-top: 0px;}</style>\n";
	$header .= "</head>\n";

	return $header;
}
global $link;
?>