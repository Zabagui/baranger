<?php
/*Purpose of this file: To allow you to make new family or feature pages that conform to the same look-and-feel and privacy settings as the rest of your site.

NOTE: The instructions below assume you will place your new page in one of your media subfolders (for example, "histories" or "documents", or create a extrapgs subfolder to your TNG root folder) 
and use copy and paste this file to your preferred subfolder and edit the file in that subfolder.

Instructions:
STEP 1: Make a copy of this file with a different name, keeping the .php extension (for example: myfamily1.php). Make the changes described below in the copy, not the original.
STEP 2: Remove the following two lines. They are here to prevent the template from being used for malicious purposes.  */

echo "Please remove this line and the \"exit\" line that follows before deploying this file to the \"histories\" folder or your new \"extrapgs\" folder";
exit;

$cms['tngpath'] = "../";
include( "../tng_begin.php");
if( !$cms['support'] )
	$cms['tngpath'] = "../";

/*  $logstring should contain the URL for your family stories
	writelog creates an entry in the Access Log
	preparebookmark creates the bookmark link on the page  */

$logstring = "<a href=\"histories/family1.php\">Your Family 1 Story</a>";
writelog($logstring);
preparebookmark($logstring);

// The following $flags can be passed on the family story pages.  The $flags can either be true or false 

$flags['noheader'] = false; // set to true to not include the template Custom Header
	// set to false to include the template Custom Header - normally topmenu.php
$flags['nobody'] = true;  	// set to true to not generate the <body> tag if the tag is in the topmenu.php
	// set to false to generate the <body> tag
$flags['noicons'] = false; 	// set to true to not generate the TNG menu bar 
	// set to false to generates the TNG menu bar
$flags['nologon'] = false; 	// set to true to bypass the checklogin and allow the page to be viewed by visitors even though your site requires Login 
	// set to false to require login to view the page

// for multi-language pages, you can use $text variables for your Feature Story Title

tng_header( "Your Family 1 Story Title", $flags ); 

/*  For multi-language pages, you can cut everything that follows the ending php tag ?> through the starting php tag before the tng_footer( "" ) function call and paste it in a new file in your language folder, for example English-UTF8/family1.php and remove the comments on the next line. 

	If you use a different file name, you need to also update the family1.php file name in the include accordingly
*/

// include($cms['tngpath'] . "$mylanguage/family1.php");

?>


<?php tng_footer( "" ); ?>
