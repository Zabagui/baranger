<?php
/*Purpose of this file: To allow you to make new family or feature pages that conform to the same look-and-feel and privacy settings as the rest of your site.

NOTE: The instructions below assume you will place your new page in one of your media subfolders (for example, "histories" or "documents", or create a extrapgs subfolder to your TNG root folder) 
and use copy and paste this file to your preferred subfolder and edit the file in that subfolder.

Instructions:
STEP 1: Make a copy of this file with a different name, keeping the .php extension (for example: mymaternal.php). Make the changes described below in the copy, not the original.
STEP 2: Remove the following two lines. They are here to prevent the template from being used for malicious purposes.  */

echo "Please remove this line and the \"exit\" line that follows before deploying this file to the \"histories\" folder or your new \"extrapgs\" folder";
exit;


//If you want to skip the login check and allow the page to be viewed by visitors even though your site requires Login, remove the comment marks from the following line:
//$nologin = 1;

$cms['tngpath'] = "../";
include( "../tng_begin.php");
if( !$cms['support'] )
	$cms['tngpath'] = "../";

/*  $logstring should contain the URL for your family stories
	writelog creates an entry in the Access Log
	preparebookmark creates the bookmark link on the page  */

$logstring = "<a href=\"histories/maternal.php\">Your Maternal Family Story</a>";
writelog($logstring);
preparebookmark($logstring);

// The following $flags can be passed on the family story pages.  The $flags can either be true or false 

$flags['noheader'] = false; // set to true to not include the template Custom Header
	// set to false to include the template Custom Header - normally topmenu.php
$flags['nobody'] = true;  	// set to true to not generate the <body> tag if the tag is in the topmenu.php
	// set to false to generate the <body> tag
$flags['noicons'] = false; 	// set to true to not generate the TNG menu bar 
	// set to false to generates the TNG menu bar

// for multi-language pages, you can use $text variables for your Feature Story Title

tng_header( "Your Family 1 Story Title", $flags ); 

/*  For multi-language pages, you can cut everything that follows the ending php tag ?> through the starting php tag before the tng_footer( "" ) function call and paste it in a new file in your language folder, for example English-UTF8/maternal.php and remove the comments on the next line. 

	If you use a different file name, you need to also update the maternal.php file name in the include accordingly
*/

// include($cms['tngpath'] . "$mylanguage/maternal.php");

?>

<h1>Maternal Family</h1>

<p>
Your maternal family story goes here.  You can use HTML tags within the body of the story.  You can also use PHP code by inserting the code within a < ? php   ? > section (note that blanks were inserted in between the php starting and ending characters so the php start and end tags would display on the page.
</p>
<h2>Heading 2 tags</h2>
<p>Additional subheadings can be added for content</p>
<h2>Using tables</h2>
<p>You can use tables or css classes to format the layout of your page</p>
<h2>Multi-language pages</h2>
<p>
If you are creating a story that you will translate and want to display in the language the user has selected when viewing your site, then you can place the content that starts with the heading 1 (< h1 >) line to everything in the line before the tng_footer.php function call in your language folder and use a PHP 
</p>
<p>
include($mylanguage/maternal.php) to include the content from you language folder for each language you support on your site.    
<br />
For additional information see the TNG Wiki article on creating User Pages or histories using the historytemplate.php file at https://tng.lythgoes.net/wiki/index.php?title=User_Pages_-_Getting_Started and https://tng.lythgoes.net/wiki/index.php?title=User_Pages_-_Multi-Language
</p>
<p>
This maternal.php file was created from the historytemplate.php and saved in the template20/histories folder as an example of how to create such a file.
</p>

<!-- CAUTION : your files must have the call to the tng_footer.php function for the left sidebar to be collapsible -->

<?php tng_footer( "" ); ?>
