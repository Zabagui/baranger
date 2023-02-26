<?php
include("tng_begin.php");

//  $logstring should contain the URL for your family stories
//	writelog creates an entry in the Access Log
//	preparebookmark creates the bookmark link on the page

$logstring = "<a href=\"histories/feature1.php\">Your Family 1 Story</a>";
writelog($logstring);
preparebookmark($logstring);

// The following $flags can be passed on the family story pages.  The $flags can either be 
//	true or false 
$flags['noheader'] = false; // set to true to not include the template Custom Header
							// set to false to include the template Custom Header - normally topmenu.php
$flags['nobody'] = true;  	// set to not generate the <body> tag if the tag is in the topmenu.php
							// set to false to generate the <body> tag
$flags['noicons'] = false; 	// set to true to not generate the TNG menu bar 
							// set to false to generates the TNG menu bar
// for multi-language pages, you can use $text variables for your Feature Story Title
tng_header( "Your Feature 1 Story Title", $flags ); 

/*  For multi-language pages, you can cut everything that follows the ending php tag ?> through the starting php tag before the tng_footer( "" ) function call and paste it in a new file in your language folder, for example English/family1.php and remove the comments on the next line. 

	If you use a different file name, you need to also update the family1.php file name accordingly
*/

// include($cms['tngpath'] . "$mylanguage/family1.php");
?>

<h1>Family 1 Story</h1>

<p>
Your Family 1 story goes here.  You can use HTML tags within the body of the story.  You can also use PHP code by inserting the code within a < ? php   ? > section (note that blanks were inserted in between the php starting and ending characters so the php start and end tags would display on the page.
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
include($mylanguage/family1.php) to include the content from you language folder for each language you support on your site.    
<br />
For additional information see the TNG Wiki article on creating User Pages or histories using the historytemplate.php file at https://tng.lythgoes.net/wiki/index.php?title=User_Pages_-_Getting_Started and https://tng.lythgoes.net/wiki/index.php?title=User_Pages_-_Multi-Language
</p>
<p>
This family1.php file was created from the historytemplate.php and saved in the histories folder as an example of how to create such a file.
</p>

<?php tng_footer( "" ); ?>
