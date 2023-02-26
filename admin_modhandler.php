<?php
/*
Mod Manager Mod Handler v14.0.0.1
  Brian McFadyen: Original concept
  Rick Bisbee: Main script, Mod List, Analyzer, OOP class library
  Ken Roy: View Log, Options, Test Manager
  Robin Richmond: View Log
  Jeff Robison: Affected Files Display
  Michel Kirsch: Mod Analyzer updates
  Michel Kirsch and Ron Krzmarzick: Page Display Positioning

  This is the Mod Manager controller. It uses class objects to
  acheive various functional ends - verifying, listing, installing
  removing, and editing 'mods'.

  This version is the Final refactoring to separate validation
  functions (Modvalidator) from Modlister.
*/
$mmversion = 'mmv14.0.0.1';
include "begin.php";
if( empty( $rootpath ) )
{
  echo 'Error ',__LINE__,': $rootpath missing! Please contact your system administrator.';exit;
}

include "adminlib.php";
$textpart = "mods";
include "getlang.php";

include $mylanguage."/admintext.php";
if( !$alltextloaded )
{
  require $mylanguage."/alltext.php";
}

$admin_login = true;
include "checklogin.php";
include "version.php";
include "classes/version.php";
require "classes/mmtabs.inc";

/* prevent direct URL access to Mod Manager if not the TNG Administrator. */
if( $assignedtree || !$allow_edit ) {
  $message = $admtext['norights'];
  header( "Location: admin_login.php?message=" . urlencode($message) );
  exit;
}

/* Suppress PHP notices.*/
if( !isset( $modspath) ) $modspath = '';
if( !isset( $extspath) ) $extspath = '';

define( 'NAMECOL',   1 );
define( 'FILECOL',   0 );
define( 'YES',      "1" );
define( 'NO',       "0" );
define( 'ON_ERROR',  0 );
define( 'ON_ALL',    1 );

define( 'ALL',       0 );
define( 'INSTALL',   1 );
define( 'REMOVE',    2 );
define( 'DELETE',    3 );
define( 'CLEANUP',   4 );

define( 'F_SELECT',  5 );

// USER PREFERENCES
require_once $subroot.'mmconfig.php';

// ADJUSTMENTS TO USER PREFERENCES (OPTIONS)
if( isset( $_GET['sort'] ) ) $_SESSION['sortby'] = $_GET['sort'];
if( isset( $_SESSION['sortby'] ) ) $options['sortby'] = $_SESSION['sortby'];
if (!isset($options['show_analyzer'])) $options['show_analyzer'] = "0";
if (!isset($options['show_developer'])) $options['show_developer'] = "0";
if (!isset($options['show_updates'])) $options['show_updates'] = "0";
if (!isset($options['compress_log'])) $options['compress_log'] = "0";

$message = '';
if( !is_writable( $rootpath ) )
   $message .= "{$admtext['checkwrite']} {$admtext['cantwrite']} $rootpath ";

//echo $message;exit;
if( !empty( $message ) ) {
   $message = "<span class=\"msgerror\">$message</span>";
}

$cfgfolder = rtrim( $rootpath, "/" ).'/'.trim( $modspath, "/" ).'/';
$mhuser = isset( $_SESSION['currentuserdesc'] )
  ? $_SESSION['currentuser'] : "";

/*************************************************************************
BATCH MOD PROCESSING
*************************************************************************/
$modlist = array();
if( !empty( $_POST ) )
{
  foreach( $_POST as $key => $value )
  {
    ${$key} = $value;
  }

  // APPLY FILTER TO MODLIST FOR BATCH OPS
  if( !empty( $submit ) )
  {
    if( !empty( $mods ) )
    {
      foreach( $mods as $mod )
      {
              if( isset( $mod['selected'] ) )
        {
          $modlist[] = $cfgfolder.$mod['file'];
              }
      }
    }

    // INSTALL BATCH
    if( $submit == "installall" )
    {
      include_once 'classes/modinstaller.class.php';
      // $oInstaller = new modinstaller( $objinits );
      $oInstaller = new_modinstaller();
      if(!$oInstaller->batch_install( $modlist )
        || $options['redirect2log'] == ON_ALL )
      {
        header("Location:admin_showmodslog.php");
        exit;
      }
      header('location:admin_modhandler.php');
      exit;
      /* Given the redirect, don't think this this will be a problem anymore.
      */
      if( function_exists( 'opcache_invalidate' ) )
      {
        opcache_invalidate($mylanguage."/cust_text.php");
      }
      include $mylanguage."/cust_text.php";
    }

    // REMOVE BATCH
    elseif( $submit == "removeall" )
    {
      include_once 'classes/modremover.class.php';
      $oRemover = new_modremover( );
      if( !$oRemover->batch_remove( $modlist )
        || $options['redirect2log'] == ON_ALL )
      {
        header("Location:admin_showmodslog.php");
        exit;
      }
      header('location:admin_modhandler.php');
      exit;
    }
    // CLEANUP BATCH
    elseif( $submit == "cleanupall" )
    {
      include_once 'classes/modremover.class.php';
      $oRemover = new_modremover();
      if( !$oRemover->batch_remove( $modlist )
        || $options['redirect2log'] == ON_ALL )
      {
        header("Location:admin_showmodslog.php");
        exit;
      }
      header('location:admin_modhandler.php');
      exit;
    }
    // DELETE BATCH
    elseif( $submit == "deleteall" )
    {
      include_once 'classes/moddeleter.class.php';
      $oDeleter = new_moddeleter();
      if( !$oDeleter->batch_delete( $modlist )
        || $options['redirect2log'] == ON_ALL )
      {
        header( "Location:admin_showmodslog.php");
        exit;
      }
      header('location:admin_modhandler.php');
      exit;
    }
  }
}
/*************************************************************************
SINGLE MOD PROCESSING
*************************************************************************/
elseif( !empty( $_GET ) || !empty( $_SESSION['got'] ) )
{
  /* Remove URL parameter string to prevent duplicate processing if
  ** page is refreshed.
  */
  if( !empty( $_GET ) )
  {
    $_SESSION['got'] = $_GET;
    header('Location:admin_modhandler.php');
    die;
  }
  elseif (!empty($_SESSION['got']))
  {
    $_GET = $_SESSION['got'];
    unset($_SESSION['got']);
  }

  foreach( $_GET as $key => $value )
  {
    ${$key} = $value;
  }
  if( isset( $a ) )
  {
    $action = isset( $a ) ? $a : '';
    $cfgpath = isset( $m ) ? $cfgfolder.$m : '';

    // INSTALL SINGLE
    if( $action == INSTALL )
    {
      require 'classes/modinstaller.class.php';
      /* Get initialized modinstaller */
      $oInstaller = new_modinstaller();

      if( !$oInstaller->install( $cfgpath )
        || $options['redirect2log'] == ON_ALL )
      {
        header( "Location:admin_showmodslog.php");
        exit;
      }
      else
      {
        if( function_exists( 'opcache_invalidate' ) )
        {
          opcache_invalidate($mylanguage."/cust_text.php");
        }
        include $mylanguage."/cust_text.php";
        /* Mod Installed - return to modlisting */
        header( "Location:admin_modhandler.php#flinka".($id-1));
        exit;
      }

    }
    // REMOVE SINGLE
    elseif( $action == REMOVE )
    {
      include_once 'classes/modremover.class.php';
      $oRemover = new_modremover( );
      if( !$oRemover->remove( $cfgpath )
        || $options['redirect2log'] == ON_ALL )
      {
        header( "Location:admin_showmodslog.php ");
        exit;
      }
      else
      {
        /* Mod Removed - return to modListing */
        header( "Location:admin_modhandler.php#flinka".($id-1));
        exit;
      }
    }
    // DELETE SINGLE
    elseif( $action == DELETE )
    {
      $error = false;
      include_once 'classes/moddeleter.class.php';
      $oDeleter = new_moddeleter();
      if( !$oDeleter->delete_mod( $cfgpath )
        || $options['redirect2log'] == ON_ALL )
      {
        header( "Location:admin_showmodslog.php");
        exit;
      }
      else
      {
        /* Mod Deleted - return to modlisting */
        header( "Location:admin_modhandler.php" );
        exit;
      }
    }
    // CLEANUP SINGLE
    elseif( $action == CLEANUP )
    {
      include_once 'classes/modremover.class.php';
      $oRemover = new_modremover();
      $oRemover->classID = "cleaner";
      if( !$oRemover->remove( $cfgpath )
        || $options['redirect2log'] == ON_ALL )
      {
        header( "Location:admin_showmodslog.php");
        exit;
      }
      else
      {
        /* Mod Cleaned UP - return to modlister */
        header( "Location:admin_modhandler.php#flinka".($id-1));
        exit;
      }
    }
  }
}

$fbox_checked = false;

// Requesting a new filter listing
if( isset( $newlist ) ) {
    unset( $_SESSION['filter'] );
    unset( $_SESSION['modlist'] );
}
// submitting with locked filter
elseif( isset( $_SESSION['filter'] ) ) {
    $filter = $_SESSION['filter'];
    $fbox_checked = true;
}
// submitted using temporary filter
elseif( !empty( $filter ) ) {
    $filter = 0;
}
// no filter applied
elseif( !isset( $filter ) )
{
    $filter = 0;
}

/***************************************************************
    OUTPUT STD ADMIN PAGE HTML HEADER + ADDITIONS
***************************************************************/
include 'classes/version.php';
$flags['modmgr'] = true;
tng_adminheader( $admtext['modmgr'], $flags );

/* Adjust default tint where template databack is also gray */
switch($templatenum)
{
  case 5:
    $tint = "#97cba9";
    break;
  case 7:
    $margin_top = "0px";
  case 8:
    $tint = "#c3b091";
    break;
  case 13:
  case 19:
  case 20:
    $tint = "#435E95";
    break;
  default:
    $tint = "#ddd";
    $margin_top = "162px";
    break;
}

// explicitly close head section
echo "
<script type='text/javascript' src='js/modmanager.js'></script>
<style>
  .tableFixedHead {
    height:calc( 100vh - 250px ) !important;
  }
</style>";
echo "
<!-- mm$mm_version -->
</head>
";

/***************************************************************
    OUTPUT TNG ADMIN TOP BANNER AND LEFT SIDE MENUS
***************************************************************/
/* Argument sets Listener for key click to scroll mod beginning
** with entered Letter into view */
echo tng_adminlayout('onkeydown="scrollto(event);"');

/***************************************************************
    OUTPUT MOD MANAGER PAGE TITLE, TABS AND HORZ MENU
***************************************************************/
$modtabs = set_horizontal_tabs( $options['show_analyzer'], $options['show_developer'],
                                $options['show_updates']);

$innermenu = set_innermenu_links( $tng_version );
$menu = doMenu($modtabs,"modlist",$innermenu);

echo displayHeadline($admtext['modmgr'],"img/modmgr_icon.gif",$menu,$message);

/*************************************************************************
DISPLAY LIST OF MODS
*************************************************************************/
echo "
<div class='admin-main whiteback'>
";

/* Handle the "Select" filter.
** case 1: VIEW SELECT (NO SELECTIONS YET) */
if( $filter == F_SELECT && !empty( $modlist ) ) {
  $_SESSION['modlist'] = $modlist;
}
/* case 2: VIEW SELECT (SELECTED SUBSET)*/
elseif( $filter == F_SELECT && isset( $_SESSION['modlist']) )
{
  $modlist = $_SESSION['modlist'];
}
else
{
  unset( $_SESSION['modlist'] );
  $modlist = array();
}

require_once 'classes/modlister.class.php';
/* Get initialized modlister object */
$oModlist = new_modlister();
$oModlist->filter = $filter;
$oModlist->fbox_checked = $fbox_checked;
$oModlist->modlist = $modlist;
$oModlist->list_mods();

echo "
<br /><br />
</div><!-- admin-main-->
";

/*************************************************************************
SUPPORTING FUNCTIONS
*************************************************************************/
function set_innermenu_links( $tng_version )
{
  global $text, $admtext;

  /* Break out major release component of TNG version */
  $parts = explode( ".", $tng_version );
  $tngmodver = "{$admtext['tngmods']} v{$parts[0]}";

  $tngmodurl = "Mods_for_TNG_v{$parts[0]}";

  $helplang = findhelp("modhandler_help.php");

  // inner menu help
  $innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/modhandler_help.php');\" class=\"lightlink\">{$admtext['help']}</a>
";

  // expand & collapse all
  $innermenu .= " &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" id=\"expandall\"> {$text['expandall']}</a>
";
  $innermenu .= " &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" id=\"collapseall\">{$text['collapseall']}</a>
";

  // MM syntax
  $innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_Syntax\" target=\"_blank\" class=\"lightlink\">{$admtext['modsyntax']}</a>
";

  // mod guidelines
  $innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Mod_Guidelines\" target=\"_blank\" class=\"lightlink\">{$admtext['modguidelines']}</a>
";

  // mods for this TNG Version
  $innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Category:$tngmodurl\" target=\"_blank\" class=\"lightlink\">$tngmodver</a>
";
  return $innermenu;
}

/*************************************************************************
JQUERY/JAVASCRIPT FUNCTIONS

*************************************************************************/
$confirm = empty( $options['delete_support'] ) ?
  $admtext['confdelmod1'] :
  $admtext['confdelmod'];
echo "
<script type=\"text/javascript\">
jQuery(document).ready(function() {
";

echo"
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
  jQuery('#collapseall').click(function()
  {
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
      return confirm(\"{$confirm}\");
    }
    else {
       alert(\"{$admtext['noselected']}\" );
       return false;
    }
  });
  jQuery('#btnInstall, #btnRemove, #btnClean, #btnChoose').click(function(){
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
?>
<?php
echo tng_adminfooter();
?>