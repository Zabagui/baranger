<?php
/*
   Mod Manager v13 User options handler
      Written by Ken Roy, TNG Test Manager
      Updated for TNGv13 by Rick Bisbee

      * Updates code/styling for new TNGv13 Admin pages no longer using iframes.
      * No changes to core (OOP classes) functionality from TNGv12.
*/

include("begin.php");
include("adminlib.php");
$textpart = "mods";
include("$mylanguage/admintext.php");
$helplang = findhelp("modhandler_help.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");
require 'classes/mmtabs.inc';

// prevent direct URL access to Mod Manager if not the TNG Administrator
if( $assignedtree || !$allow_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}


define( "YES", "1" );
define( "NO",  "0" );

define( "MODNAME",  0 );
define( "CFGNAME",  1 );
define( "ON_ERROR", 0 );
define( "ON_ALL",   1 );

define( "ONE", 1 );
define( "TWO", 2 );
define( "THREE", 3 );
define( "FOUR", 4 );
define( "FIVE", 5 );

$optionsfile = $subroot.'mmconfig.php';
include $optionsfile;

/*
 * SET USER OPTION DEFAULTS IF VALUES ARE NOT IN THE OPTIONS FILE
*/
// Mod log file name
if (!isset($options['modlogfile'])) $options['modlogfile'] = "modmgrlog.txt";

// Log max transactions
if (!isset($options['maxloglines'])) $options['maxloglines'] = "200";

// Compress log option
if (!isset($options['compress_log'])) $options['compress_log'] = YES;

// Redirect to view log upon Mod processing error
if (!isset($options['redirect2log'])) $options['redirect2log'] = ON_ERROR;

// Sort by Mod Name column in Mod listing
if (!isset($options['sortby'])) $options['sortby'] = MODNAME;

// Allow Mod deletion in partially installed
if (!isset($options['delete_partial'])) $options['delete_partial'] = NO;

// Allow Mod deletion if status = installed
if (!isset($options['delete_installed'])) $options['delete_installed'] = NO;

// Log full TNG-relative path for file actions
if (!isset($options['log_full_path'])) $options['log_full_path'] = YES;

// Compress Mod names in listing (?)
if (!isset($options['compress_names'])) $options['compress_names'] = NO;

// Show the Mod Analyzer tab on MM pages
if (empty($options['show_analyzer'])) $options['show_analyzer'] = YES;

/*Analyze only installed mods Mod - #1 - MichelK */
// Show actions (install, delete,...) in the Mod Analyzer
if (!isset($options['show_analyzeractions'])) $options['show_analyzeractions'] = NO;
/*Analyze only installed mods Mod - MichelK */

// Show the View Parser Tab on MM pages
if (!isset($options['show_developer'])) $options['show_developer'] = NO;

// Show the MM Recommended Updates tab
if (!isset($options['show_updates'])) $options['show_updates'] = YES;

// When deleting a Mod also delete its support folder
if (!isset($options['delete_support'])) $options['delete_support'] = NO;

if( !isset($sub) ) $sub = "tables";

/***************************************************************
    1. OUTPUT STD ADMIN PAGE HTML HEADER + ADDITIONS
***************************************************************/
$flags['modmgr'] = true;
tng_adminheader( $admtext['modmgr'], $flags );

// Place some styling in the HTML head section
$min_width = $sitever == 'mobile' ? '0' : '640px';

/* Adjust positioning for problem templates */
switch($templatenum)
{
  case 7:
    $margin_top = "0px";
    break;
  default:
    $margin_top = "162px";
    break;
}

/* Height of the table display must be set for
** each page to account for differences in
** heading heights.
**
** The <head> tag must be explicitly closed. */
echo "
<style>
  .tableFixedHead {
    height:calc( 100vh - 220px ) !important;
  }
</style>
</head>
";

/***************************************************************
    2. OUTPUT TNG ADMIN TOP BANNER AND LEFT SIDE MENUS
***************************************************************/
echo tng_adminlayout();

/***************************************************************
    3. OUTPUT MOD MANAGER PAGE TITLE, TABS AND HORZ MENU
***************************************************************/
$modtabs = set_horizontal_tabs( $options['show_analyzer'], $options['show_developer'], $options['show_updates']);
$innermenu = set_innermenu_links( $tng_version );

$menu = doMenu($modtabs,"options",$innermenu);

if(!isset($message)) $message = "";

echo displayHeadline($admtext['modmgr'],"img/modmgr_icon.gif",$menu,$message);

$first_menu=TRUE;

/***************************************************************
    4. MOD OPTIONS PAGE CONTENT
***************************************************************/
echo "
<div class='admin-main'>
	<form action=\"admin_updatemodoptions.php\" method=\"post\" name=\"form1\">";
echo "
    <div class='tableFixedHead roundtop'>
      <table id='mmtable' class='mmtable'>
        <thead>
          <tr>
            <th class='fieldnameback fieldname mmrounded20 center' style='font-size:medium'>
              Mod Manager User Preferences
            </th>
          </tr>
        </thead>
        <tr>
         <td class=\"tngshadow databack mmrounded20\" style='height:20px;'>";

/***************************************************************
  MOD MANAGER LOGS
***************************************************************/
echo displayToggle("plus0",0,"log",$admtext['logoptions'],"");
echo "
	<div id=\"log\" style=\"display:none\">
		<table class=\"normal\">
		    <tr>
                  <td width=\"270px\">
                     <span class=\"normal\">{$admtext['mmlogfilename']}:</span>
                  </td>
                  <td>
                     <input type=\"text\" value=\"{$options['modlogfile']}\" name=\"options[modlogfile]\" size=\"20\">
                  </td>
               </tr>
		         <tr>
                  <td>
                     <span class=\"normal\">{$admtext['mmmaxloglines']}:</span>
                  </td>
                  <td>
                     <input type=\"text\" value=\"{$options['maxloglines']}\" name=\"options[maxloglines]\" size=\"5\">
                  </td>
               </tr>
         		<tr>
         			<td width=\"270px\">{$admtext['compresslog']}:</td>
         			<td>
         				<select name=\"options[compress_log]\">
         					<option value=".YES; if( $options['compress_log'] == YES ) echo " selected=\"selected\""; echo ">{$admtext['yes']}</option>
         					<option value=".NO; if( $options['compress_log'] == NO ) echo " selected=\"selected\""; echo ">{$admtext['no']}</option>
         				</select>
         			</td>
         		</tr>
         		<tr>
         			<td width=\"270px\">{$admtext['redirect2log']}:</td>
         			<td>
         				<select name=\"options[redirect2log]\">
                        <option value=".ON_ERROR; if( $options['redirect2log'] == ON_ERROR ) echo "  selected=\"selected\""; echo ">{$admtext['on_error']}</option>
                        <option value=".ON_ALL; if( $options['redirect2log'] == ON_ALL ) echo " selected=\"selected\""; echo ">{$admtext['on_all']}</option>
         				</select>
         			</td>
         		</tr>
				<tr>
					<td width=\"270px\">{$admtext['logfullpath']}:</td>
					<td>
						<select name=\"options[log_full_path]\">
						<option value=".YES; if( $options['log_full_path'] == YES ) echo " selected=\"selected\""; echo ">{$admtext['yes']}</option>
						<option value=".NO; if( $options['log_full_path'] == NO ) echo " selected=\"selected\""; echo ">{$admtext['no']}</option>
						</select>
					</td>
				</tr>
        <tr><td style='border:0;line-height:.5;'>&nbsp;</td></tr>

      </table>
      </div>
			</td>
		</tr>
      <tr>
         <td class=\"tngshadow databack mmrounded20\" style='height:20px;'>";
/***************************************************************
  DISPLAY SETTINGS
***************************************************************/
echo displayToggle("plus1",0,"display",$admtext['displayoptions'],"");
echo "
	<div id=\"display\" style=\"display:none\">
	            <table class=\"normal\">
		         <tr>
         			<td width=\"270px\">{$admtext['sortlistby']}:</td>
         			<td>
         				<select name=\"options[sortby]\">
         					<option value=".MODNAME; if( $options['sortby'] == MODNAME ) echo " selected=\"selected\""; echo ">{$admtext['modname']}</option>
         					<option value=".CFGNAME; if( $options['sortby'] == CFGNAME ) echo " selected=\"selected\""; echo ">{$admtext['cfgname']}</option>
         				</select>
         			</td>
         		</tr>

         		<tr>
         			<td width=\"270px\">{$admtext['compressnames']}:</td>
         			<td>
         				<select name=\"options[compress_names]\">
         					<option value=".YES; if( $options['compress_names'] == YES ) echo " selected=\"selected\""; echo ">{$admtext['yes']}</option>
         					<option value=".NO; if( $options['compress_names'] == NO ) echo " selected=\"selected\""; echo ">{$admtext['no']}</option>
         				</select>
         			</td>
         		</tr>
         		<tr>
         			<td width=\"270px\">{$admtext['showanalyzer']}:</td>
         			<td>
         				<select name=\"options[show_analyzer]\">
         					<option value=".YES; if( $options['show_analyzer'] == YES ) echo " selected=\"selected\""; echo ">{$admtext['yes']}</option>
         					<option value=".NO; if( $options['show_analyzer'] == NO ) echo " selected=\"selected\""; echo ">{$admtext['no']}</option>
         				</select>
         			</td>
         		</tr>
<!--/*Analyze only installed mods Mod - #2 - MichelK */!-->
         			<td width=\"270px\">{$admtext['showanalyzeractions']}:</td>
         			<td>
         				<select name=\"options[show_analyzeractions]\">
         					<option value=".YES; if( $options['show_analyzeractions'] == YES ) echo " selected=\"selected\""; echo ">{$admtext['yes']}</option>
         					<option value=".NO; if( $options['show_analyzeractions'] == NO ) echo " selected=\"selected\""; echo ">{$admtext['no']}</option>
         				</select>
         			</td>
         		</tr>
<!--/*Analyze only installed mods Mod - MichelK */!-->
         		<tr>
         			<td width=\"270px\">{$admtext['showdeveloper']}:</td>
         			<td>
         				<select name=\"options[show_developer]\">
         					<option value=".YES; if( $options['show_developer'] == YES ) echo " selected=\"selected\""; echo ">{$admtext['yes']}</option>
         					<option value=".NO; if( $options['show_developer'] == NO ) echo " selected=\"selected\""; echo ">{$admtext['no']}</option>
         				</select>
         			</td>
         		</tr>
         		<tr>
         			<td width=\"270px\">{$admtext['showupdates']}:</td>
         			<td>
         				<select name=\"options[show_updates]\">
         					<option value=".YES; if( $options['show_updates'] == YES ) echo " selected=\"selected\""; echo ">{$admtext['yes']}</option>
         					<option value=".NO; if( $options['show_updates'] == NO ) echo " selected=\"selected\""; echo ">{$admtext['no']}</option>
         				</select>
         			</td>
         		</tr>
            <tr><td style='border:0;line-height:.5;'>&nbsp;</td></tr>
         	   </table>
            </div>
         </td>
      </tr>
     <tr>
         <td class=\"databack tngshadow mmrounded20\" style='height:20px;'>";
/***************************************************************
  OTHER
***************************************************************/
echo displayToggle("plus2",0,"other",$admtext['othermmoptions'],"");
echo "
	<div id=\"other\" style=\"display:none\">
	    <table class=\"normal\">
         		<tr>
         			<td width=\"270px\">{$admtext['allowdeletepartial']}:</td>
         			<td>
         				<select name=\"options[delete_partial]\">
         					<option value=".YES; if( $options['delete_partial'] == YES ) echo " selected=\"selected\""; echo ">{$admtext['yes']}</option>
         					<option value=".NO; if( $options['delete_partial'] == NO ) echo " selected=\"selected\""; echo ">{$admtext['no']}</option>
         				</select>
         			</td>
                  <td>
                     <div style=\"padding-left:1em;width:80%;\">{$admtext['delpartinfo']}</div>
                  </td>
         		</tr>
         		<tr>
         			<td width=\"270px\">{$admtext['allowdeleteinstalled']}:</td>
         			<td>
         				<select name=\"options[delete_installed]\">
         					<option value=".YES; if( $options['delete_installed'] == YES ) echo " selected=\"selected\""; echo ">{$admtext['yes']}</option>
         					<option value=".NO; if( $options['delete_installed'] == NO ) echo " selected=\"selected\""; echo ">{$admtext['no']}</option>
         				</select>
         			</td>
                  <td>
                     <div style=\"padding-left:1em;width:80%;\">{$admtext['delinstinfo']}</div>
                  </td>
         		</tr>
               <tr>
         			<td width=\"270px\">{$admtext['allowdeletesupport']}:</td>
         			<td>
         				<select name=\"options[delete_support]\">
         					<option value=".YES; if( $options['delete_support'] == YES ) echo " selected=\"selected\""; echo ">{$admtext['yes']}</option>
         					<option value=".NO; if( $options['delete_support'] == NO ) echo " selected=\"selected\""; echo ">{$admtext['no']}</option>
         				</select>
         			</td>
                  <td>
                     <div style=\"padding-left:1em;width:80%;\">{$admtext['delrisk']}</div>
                  </td>
               </tr>
               <tr><td style='border:0;line-height:.5;'>&nbsp;</td></tr> 
			</table>
			</div>
		</td></tr>
		<tr>
			<td class=\"databack tngshadow mmrounded20\" style='height:20px;'>
            <input type=\"submit\" name=\"submit\" accesskey=\"s\" value=\"{$admtext['save']}\" />
			</td>
		</tr>
		</table>
    </div><!-- tableFixedHead --> 
	</form>

  </div><!-- admin-main -->";
/*************************************************************************
FUNCTIONS
*************************************************************************/
function set_innermenu_links( $tng_version, $pageID='options' ) {
   global $text, $admtext;

   $parts = explode( ".", $tng_version );		// added to determine TNG vNN for
   $tngmodver = "{$admtext['tngmods']} v{$parts[0]}";	// Mods for TNG vNN text display
   $tngmodurl = "Mods_for_TNG_v{$parts[0]}";	// Mods for TNG vNN URL
   $helplang = findhelp("modhandler_help.php");

   // inner menu help
   $innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/modhandler_help.php#$pageID');\" class=\"lightlink\">{$admtext['help']}</a>
";

   // toggle sections open/close
   $innermenu .= " &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('on');\">{$text['expandall']}</a> &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('off');\">{$text['collapseall']}</a>";

   // MM syntax
   $innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_Syntax\" target=\"_blank\" class=\"lightlink\">{$admtext['modsyntax']}</a>
";

   // mod guidelines
   $innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Mod_Guidelines\" target=\"_blank\" class=\"lightlink\">{$admtext['modguidelines']}</a>
";

   // mods for TNGv10
   $innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Category:$tngmodurl\" target=\"_blank\" class=\"lightlink\">$tngmodver</a>
";
   return $innermenu;
}

/*************************************************************************
JAVASCRIPT SUPPORT
*************************************************************************/
echo "
<script type=\"text/javascript\">
function toggleAll(display) {
	toggleSection('log','plus0',display);
	toggleSection('display','plus1',display);
	toggleSection('other','plus2',display);
	return false;
}
</script>";

echo tng_adminfooter();
?>
