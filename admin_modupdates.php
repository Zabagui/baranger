<?php
// Mod Manager Options written by Ken Roy to incorporate current mods to Mod Manager into the TNG code
//			and support additional processing options
// Based on the TNG v10.0.3 admin_modmgroptions.php module
/*
   Mod Manager v13
      * Updates code/styling for new TNGv13 Admin pages no longer using iframes.
      * Removes JavaScript positioning of heading and body elements.
      * No changes to core (OOP classes) functionality from TNGv12.
*/
include("begin.php");
include("adminlib.php");
$textpart = "mods";
include("getlang.php");

include("$mylanguage/admintext.php");

//tng_db_connect($database_host,$database_name,$database_username,$database_password) or exit;
$admin_login = 1;
include("checklogin.php");
include("version.php");
$admvers="TNG13 V4.0 ";

require 'classes/mmtabs.inc';

// prevent direct URL access to Mod Manager if not the TNG Administrator
if( $assignedtree || !$allow_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

//suppress PHP notices
if( !isset( $modspath) ) $modspath = '';
if( !isset( $extspath) ) $extspath = '';

// USER PREFERENCES
require_once $subroot.'mmconfig.php';

define( "YES", 1 );
define( "NO",  0 );

/***************************************************************
    1. OUTPUT STD ADMIN PAGE HTML HEADER + ADDITIONS
***************************************************************/

$flags['modmgr'] = true;
tng_adminheader( $admtext['modmgr'], $flags );


$min_width = $sitever == 'mobile' ? '0' : '640px';

// explicitly close head section
echo "</head>
";

/***************************************************************
    2. OUTPUT TNG ADMIN TOP BANNER AND LEFT SIDE MENUS
***************************************************************/
echo tng_adminlayout();

/***************************************************************
    3. OUTPUT MOD MANAGER PAGE TITLE, TABS AND HORZ MENU
***************************************************************/

$helplang = findhelp("modhandler_help.php");

if (!isset($options['show_analyzer'])) $options['show_analyzer'] = "0";
if (!isset($options['show_developer'])) $options['show_developer'] = "0";
if (!isset($options['show_updates'])) $options['show_updates'] = "0";

$modtabs = set_horizontal_tabs( $options['show_analyzer'], $options['show_developer'], $options['show_updates']);
$innermenu = set_innermenu_links( $tng_version );

$menu = doMenu($modtabs,"updates",$innermenu);

if(!isset($message)) $message = "";
echo displayHeadline($admtext['modmgr'],"img/modmgr_icon.gif",$menu,$message);

/***************************************************************
    4. PAGE CONTENT AND FUNCTIONALITY
***************************************************************/
$message = '';
if( !is_writable( $rootpath ) )
   $message .= "{$admtext['checkwrite']} {$admtext['cantwrite']} $rootpath ";

//echo $message;exit;
if( !empty( $message ) ) {
   $message = "<span class=\"msgerror\">$message</span>";
}

echo "
<div class='admin-main'>
  <div class='tableFixedHead rounded top'>
    <table id=\"mmtable\">
      <thead>
        <tr>
          <th class='fieldnameback fieldname roundtop' style='border:0;'>
            <h2>{$admtext['recommendedfixes']}</h2>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
        <td class='databack'>";
/***************************************************************
  TEXT FOR RECOMMENDED UPDATES STARTS HERE
***************************************************************/
echo "
<h3>{$admtext['updcusttext']}</h3>
<p>The updated Mod Guidelines recommend that custom text be inserted before the comments at the beginning of the cust_text.php file so that mods do not impact user manual changes made after the comment lines.</p>

<p>If you have not run the cust_text_update.php script as part of the TNG v12 upgrade, you need to update your cust_text.php files to add a new line to the files andalso update out-of-date line in your existing cust_text.php files which are not replaced during TNG upgrades.</p>

<p>The new comment line should not be translated in the language files so that it can be used as an anchor to insert custom text before this new comment line by the mod developers</p>.

<p>If you translate the new comment line, mod installs will fail.</p>
<p>If you click on the button below your updates will be done for you automatically.";
/***************************************************************
  END OF RECOMMENDED UPDATE TEXT
***************************************************************/
  echo "
          </td>
        </tr>

        <tr>
          <td>&nbsp;</td>
        </tr>

        <tr>
          <td>
            <form action=\"\">
               <input class=\"button space msgapproved\" type=\"button\" value=\"{$admtext['update']}\" onClick=\"if( confirm('{$admtext['confirmupdcusttext']}'))window.open('admin_cust_text_update.php','_blank');\" />
            </form>
         </td>
      </tr>
    </table><!-- mmtable -->
   </div><!-- tableFixedHead -->
</div><!-- admin-main -->";

echo tng_adminfooter();
exit;

/*************************************************************************
FUNCTIONS
*************************************************************************/
function set_innermenu_links( $tng_version, $pageID='recommended' ) {
   global $text, $admtext;

   $parts = explode( ".", $tng_version );		// added to determine TNG vNN for
   $tngmodver = "{$admtext['tngmods']} v{$parts[0]}";	// Mods for TNG vNN text display
   $tngmodurl = "Mods_for_TNG_v{$parts[0]}";	// Mods for TNG vNN URL
   $helplang = findhelp("modhandler_help.php");

   // inner menu help
   $innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/modhandler_help.php#$pageID');\" class=\"lightlink\">{$admtext['help']}</a>";

   // toggle sections open/close
   $innermenu .= " &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('on');\">{$text['expandall']}</a> &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('off');\">{$text['collapseall']}</a>";

   // MM syntax
   $innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_Syntax\" target=\"_blank\" class=\"lightlink\">{$admtext['modsyntax']}</a>";

   // mod guidelines
   $innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Mod_Guidelines\" target=\"_blank\" class=\"lightlink\">{$admtext['modguidelines']}</a>";

   // mods for TNGv10
   $innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Category:$tngmodurl\" target=\"_blank\" class=\"lightlink\">$tngmodver</a>";
   return $innermenu;
}

