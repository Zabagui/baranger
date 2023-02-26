<?php
/*
   Mod Manager 12 Display Parser Tables
/*************************************************************************
    TNGv13 admin_modtables.php by William (Rick) Bisbee.

    Displays the parser table for a selected Mod for debugging

    Does not implement fixed page header by design

    v13 updated by Rick Bisbee to integrate with new TNG Admin pages
    without iframes

*************************************************************************/
ob_start();
include 'begin.php';
include 'adminlib.php';
$textpart = 'mods';

include "$mylanguage/admintext.php";

$admin_login = 1;
include 'checklogin.php';
include 'version.php';


// User preferences
include $subroot.'mmconfig.php';
include 'classes/version.php';
require 'classes/mmtabs.inc';

// prevent direct URL access to Mod Manager if not the TNG Administrator
if( $assignedtree || !$allow_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

if( isset( $_GET['modfile'] ) )
{
  $modfile = $_GET['modfile'];
}
else  $modfile = '';

$thisfile = $_SERVER['PHP_SELF'];

define( 'YES',      "1" );
define( 'NO',       "0" );

// Adjustments
if( isset( $_GET['sort'] ) ) $_SESSION['sortby'] = $_GET['sort'];
if( isset( $_SESSION['sortby'] ) ) $options['sortby'] = $_SESSION['sortby'];
if (!isset($options['compress_log'])) $options['compress_log'] = "0";
if (!isset($options['show_analyzer'])) $options['show_analyzer'] = "0";
if (!isset($options['show_developer'])) $options['show_developer'] = "0";
if (!isset($options['show_updates'])) $options['show_updates'] = "0";

/***************************************************************
    1. OUTPUT STD ADMIN PAGE HTML HEADER + ADDITIONS
***************************************************************/
$flags['modmgr'] = true;
tng_adminheader( $admtext['modmgr'], $flags );

// Adjust width for mobile devices
$min_width = $sitever == 'mobile' ? '0' : '640px';

/* Height of the table display must be set for
** each page to account for differences in
** heading heights.
**
** The <head> tag must be explicitly closed. */
echo "
<script type='text/javascript' src='js/modmanager.js'></script>
<style>
  .tableFixedHead {
    height:calc( 100vh - 280px ) !important;
  }
</style>
</head>
";

/***************************************************************
    2. OUTPUT TNG ADMIN TOP BANNER AND LEFT SIDE MENUS
***************************************************************/
/* Scroll to first file name beginning with keyclick event
** letter into view in the left file listing panel. */
echo tng_adminlayout('onkeydown="scrollto(event);"');

/***************************************************************
    3. PREPARE MOD MANAGER PAGE TITLE, TABS AND HORZ MENU
***************************************************************/
$modtabs = set_horizontal_tabs( $options['show_analyzer'], $options['show_developer'], $options['show_updates']);
$innermenu = set_innermenu_links( $tng_version );
$menu = doMenu($modtabs,"parser",$innermenu);

if(!isset($message)) $message = "";
echo displayHeadline($admtext['modmgr'],"img/modmgr_icon.gif",$menu,$message);
$first_menu=TRUE;

$cfgfolder = rtrim( $rootpath, "/" ).'/'.trim( $modspath, "/" ).'/';
$mhuser = isset( $_SESSION['currentuserdesc'] ) ? $_SESSION['currentuser'] : "";

/***************************************************************
    4. MOD MANAGER PAGE CONTENT
***************************************************************/

// Create a mod parser object
//require_once 'classes/modobjinits.php';
include_once 'classes/modvalidator.class.php';
$oVal = new_modvalidator();

/*************************************************************************
  DISPLAY MOD LISTING
*************************************************************************/
if( empty( $modfile ) )
{
  echo "
<div class='admin-main'>";
  $modlist = $oVal->get_modfile_names();
  if( is_numeric( $modlist ) )
  {
    header("location:admin_modhandler.php");
    exit;
  }
  natcasesort($modlist);// sort MM lists mod
  $modnum = 1;

  echo "
  <div class='tableFixedHead roundtop'>
    <table class='mmtable'>
      <thead>
        <tr>
          <th class='fieldnameback fieldname mmround'>
            {$admtext['selectmod']}
          </th>
        </tr>
      </thead>
      ";

  foreach( $modlist as $modfile )
  {
    $fl = strtoupper(substr($modfile,0,1));
    echo "
    <tr class=\"clink_{$fl}\">
      <td class='flink databack tngshadow mmrounded' onClick=\"window.location.href='". basename(__FILE__) . "?modfile=$modfile'\">"
        .$modnum++. "&nbsp;&nbsp;&nbsp;$modfile
      </td>
    </tr>";
  }

  echo "
    </table><!-- mmtable -->
  </div><!-- tableFixedHead -->
</div><!-- admin-main (1) -->
";

  echo tng_adminfooter();
   exit;
}

/*************************************************************************
  DISPLAY TABLE
*************************************************************************/
  echo "
<div class='admin-main'>";

  $table = $oVal->validate( $modfile );

  if( !empty( $oVal->parse_error) )
  {
    $idx = $oVal->parse_error['text'];
    echo "$modfile <strong style='color:red'>{$admtext['parsererror']}</strong> Line: ", $oVal->parse_error['line']," ", $oVal->parse_error['tag'], " <span class='mmhighlight'>", $admtext[$idx];
  exit;
  }

    $hdrs = array
    (
      'line' => '4%',
      'name' => '10%',
      'arg1' => '24%',
      'arg2' => '22%',
      'arg3' => '22%',
      'flag' => '4%',
      'statkey' => '8%',
      'eline'=> '4%'
    );

    $mod_stat_header = $oVal->get_modstatus_header();
    $mod_name = $oVal->get_modname();
    $mod_ver = $oVal->get_modversion();

    echo "
    <h1>$mod_name $mod_ver $admtext[$mod_stat_header] </h1>";

    if( !empty( $table ) )
    {
      echo "
  <div class='tableFixedHead'>
  <table class='mmtable'>
    <thead>
      <tr>
";

      foreach( $hdrs as $hdr => $width )
      {
        echo "
        <th class='fieldnameback fieldname' style='width:$width;'>
          <div>
            $hdr
          </div>
        </th>
";
      }

      echo "
      </tr>
    </thead>
";
    }

    foreach( $table as $row )
    {
      foreach( $row as $key => $val )
      {
        if( is_string($val) )
        {
          $row[$key] = html_entity_decode( foldable_string( $val ) );
        }
      }
      // STYLE STYLES FOR VARIOUS TAG TYPES
      switch( $row['name'] )
      {
        case 'target':
          $row_style = "style='background-color:#C0EEC0;'";
          break;
        case 'name':
          $row_style = "style='font-weight:bold;font-size:1.2em;'";
          break;
        case 'textexists':
        case 'fileexists':
        case 'tngversion':
        case 'goto':
        case 'label':
          $row_style = "style='color:#0000f7;'";
          break;
        default:
          $row_style = NULL;
          break;
      }

      echo "
    <tr $row_style>";

      foreach( $hdrs as $hdr => $width )
      {
        $value = isset($row[$hdr]) ? $row[$hdr] : '';

        echo "
      <td class='grayborder'>
";
        switch( $hdr )
        {
          case 'line':
            echo "
        <div style='text-align:center'>";
            break;
          default:
            echo "
        <div style='padding:5px'>";
          break;
        }

        echo nl2br(htmlentities( $value ));
        echo "
      </div>
      </td>";
      }

    /* Close the row */
        echo "
    </tr>";
    } // foreach row

    /* Close the table */
      echo "
  </table>
  <div><!-- tableFixedHead -->";

echo "
  <script>
    document.write('<a href=\"' + document.referrer + '\"><button>".$admtext['backtoprevious']."</button></a>');
  </script>
</div><!-- admin-main (2) -->";

echo tng_adminfooter();
exit;

/*************************************************************************
FUNCTIONS
*************************************************************************/
function set_innermenu_links( $tng_version, $pageID='parser' ) {
   global $text, $admtext;

   $parts = explode( ".", $tng_version );		// added to determine TNG vNN for
   $tngmodver = "{$admtext['tngmods']} v{$parts[0]}";	// Mods for TNG vNN text display
   $tngmodurl = "Mods_for_TNG_v{$parts[0]}";	// Mods for TNG vNN URL
   $helplang = findhelp("modhandler_help.php");

   // inner menu help
   $innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/modhandler_help.php#$pageID');\" class=\"lightlink\">{$admtext['help']}</a>";

   // MM syntax
   $innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_Syntax\" target=\"_blank\" class=\"lightlink\">{$admtext['modsyntax']}</a>";

   // mod guidelines
   $innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Mod_Guidelines\" target=\"_blank\" class=\"lightlink\">{$admtext['modguidelines']}</a>";

   // mods for TNGv10
   $innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Category:$tngmodurl\" target=\"_blank\" class=\"lightlink\">$tngmodver</a>";
   return $innermenu;
}


function foldable_string( $string ) {
  return preg_replace('@([\./_])@', '&#8203;$1', $string );
}

/*************************************************************************
JQUERY/JAVASCRIPT FUNCTIONS
*************************************************************************/
echo "
<script type=\"text/javascript\">
jQuery(document).ready(function() {
";

echo "
   // toggle mod status from other fields
   jQuery('.flink').click(function() {
      var flinkID = jQuery(this).attr('id');
      var linknum = flinkID.match(/\d+/);
      var linkID = 'link'+linknum;
      toggleStatus(linkID);
   });

   // toggle mod status from status field header
   jQuery('.modlink').click(function() {
      var linkID = jQuery(this).attr('id');
      toggleStatus(linkID);
   });

   function toggleStatus( linkID ) {
      var divID = linkID + 'div';
      if( jQuery('#' + linkID).hasClass('closed') ) {
         jQuery('#' + linkID).addClass('opened').removeClass('closed');
         jQuery('#' + divID).show();
      }
      else {
         jQuery('#' + linkID).addClass('closed').removeClass('opened');
         jQuery('#' + divID).hide();
      }
   }

   // close all
   jQuery('#collapseall').click(function() {
      jQuery('.modlink').addClass('closed').removeClass('opened');
      jQuery('.moddiv').hide();
   });

   // open all
   jQuery('#expandall').click(function() {
      jQuery('.modlink').addClass('opened').removeClass('closed');
      jQuery('.moddiv').show();
   });

   jQuery('#selectAll').click(function(){
      jQuery('input.sbox').prop('checked',true);
   });

   jQuery('#clearAll').click(function(){
      jQuery('input.sbox').prop('checked',false);
   });

   jQuery('#btnDelete').click(function(){
      if(jQuery('input.sbox:checkbox:checked').length>0 ) {
         return confirm(\"{$admtext['nomodundo']}\");
      }
      else {
         alert(\"{$admtext['noselected']}\" );
         return false;
      }
   });
   jQuery('#btnInstall, #btnRemove, #btnClean').click(function(){
      if( jQuery('input.sbox:checkbox:checked').length>0 ) {
         return true;
      }
      else {
         alert(\"{$admtext['noselected']}\" );
         return false;
      }
   });
   jQuery('#stayon').change(function() {
      if(this.checked) {
         jQuery.post('classes/ajax_filter.php', {filter:\"$oModlist->filter\"});
         }
      else {
         jQuery.post('classes/ajax_filter.php', {filter:\"0\"});
      }
   });
});

</script>";

echo "
<div align=\"right\"><span class=\"normal\">$tng_title, v.$tng_version ($mm_version)</span></div>
</body>
</html>";
ob_end_fllush();
?>