<?php
//Purpose of this file: To allow you to make new media pages that conform to the same look-and-feel and privacy settings as the rest of your site.
//NOTE: The instructions below assume you will place your new page in one of your media subfolders (for example, "histories" or "documents").

//NOTE: Histories created this way may function differently that other histories when placed in an "album". If that is annoying to you, consider creating
//your history by pasting the text into Admin/Media/Body Text instead.

//Instructions:
//STEP 1: Make a copy of this file with a different name, keeping the .php extension (for example: mynewhistory.php). Make
//  the changes described below in the copy, not the original.
//STEP 2: Remove the following two lines. They are here to prevent the template from being used for malicious purposes.
echo "Please remove this line and the \"exit\" line that follows before deploying this file to the \"histories\" folder.";
exit;

//1a: If you want to skip the login check when displaying this page, remove the comment marks from this line:
//$nologin = 1;

$cms['tngpath'] = "../";
include( "../tng_begin.php");
if( !$cms['support'] )
	$cms['tngpath'] = "../";

//STEP 3: Replace "Your Title Here" in the next line with the title of your page. Keep it surrounded with double quotes. 
//  Do not include any double quotes within your title. This creates the primary headline at the top of the page.
$yourtitle = "Your Title Here";

//STEP 4: Replace "/path_to_your_page/mynewhistory.php" in the next line with the path and file name of your page. 
//  The path is the folder structure above your file. For example, if your TNG files are in a subfolder called "tng" and
//  your new page will be a "history", you would enter "/tng/histories/mynewhistory.php". If your TNG files are not in a
//  subfolder, your path should just start with the media folder (e.g., "/histories/mynewhistory.php").
//  Keep it surrounded with double quotes. It must start with a slash. 
$yourlink = "/path_to_your_page/mynewhistory.php";

$logstring = "<a href=\"$yourlink\">$yourtitle</a>";
writelog($logstring);
preparebookmark($logstring);

//STEP 5: Remove the comments (leading slashes) on the next line if you *DON'T* want the TNG menu bar to show on your page.
//$flags['noicons'] = true;

tng_header( $yourtitle, $flags ); 
echo "<h1 class=\"header\">$yourtitle</h1><br clear=\"left\"/>\n";

//STEP 6: Replace the text below with your own text (do not include the headline). 
//  Use HTML tags to create paragraph breaks and other formatting. 
?>

<p>Your body text or HTML goes here. Do not include a BODY tag.</p>

<p>Surround each paragraph with the "p" tags used here. Doing that creates a paragraph break.</p>

<p>For other basic HTML instructions, please do an Internet search for "basic html".</p>

<p>For additional information see the TNG Wiki article on creating User Pages or histories using this file at
https://tng.lythgoes.net/wiki/index.php?title=User_Pages_-_Getting_Started</p>

<?php 
tng_footer( "" ); 
//STEP 7: Read the rest of the instructions below, then if you prefer a cleaner file, delete all of the commented lines.
//STEP 8: Use FTP or the File Manager on your site control panel to upload your new file. Place it in the appropriate media collection folder.
//  For example, if this is a "history", place the file in the "histories" folder.
//STEP 9: When linking to your new page from your TNG home page, header or footer, use the complete path you entered above.
//  For example: <a href="/path_to_your_page/mynewhistory.php">This is a link to my new history</a>
?>
