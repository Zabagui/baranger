<?php
/*
   Mod Manager 14.0.0.1 parameter editor

   Instantiates modeditor class to do the editing.
*/
ob_start('ob_gzhandler');
 const YES = "1";
 const NO = "0";

define( 'EDITP',     5 );

require 'begin.php';
require 'adminlib.php';
$textpart = "mods";
require $mylanguage.'/admintext.php';
$helplang = findhelp("modhandler_help.php");
$thisfile = $_SERVER['PHP_SELF'];

$admin_login = 1;
require 'checklogin.php';
require 'version.php';

require $subroot.'mmconfig.php';
require 'classes/version.php';
require 'classes/mmtabs.inc';

/* save modlisting mod id for return to modhandler */
if($id)
	$_SESSION['actualmod'] = $id;
else
	$_SESSION['actualmod'] = "";

// prevent direct URL access to Mod Manager if not the TNG Administrator
if( $assignedtree || !$allow_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$cfgfolder = rtrim( $rootpath, "/" ).'/'.trim( $modspath, "/" ).'/';
$mhuser = isset( $_SESSION['currentuserdesc'] ) ? $_SESSION['currentuser'] : "";

/***************************************************************
    1. OUTPUT STD ADMIN PAGE HTML HEADER + ADDITIONS
***************************************************************/
$flags['modmgr'] = true;
tng_adminheader( $admtext['modmgr'], $flags );

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

  .forme:before {
    display:block;
    height:34px;
    margin-top:-34px;
    content:'';
  }
</style>
</head>
";

/***************************************************************
    2. OUTPUT TNG ADMIN TOP BANNER AND LEFT SIDE MENUS
***************************************************************/
echo tng_adminlayout();

/***************************************************************
    3. PREPARE MOD MANAGER PAGE TITLE, TABS AND HORZ MENU
***************************************************************/
$modtabs = set_horizontal_tabs( $options['show_analyzer'], $options['show_developer'], $options['show_updates'] );
$innermenu = set_innermenu_links( $tng_version );

$menu = doMenu($modtabs,"modlist",$innermenu);

if(!isset($message)) $message = "";
echo $headline = displayHeadline($admtext['modmgr'].' - '.ucwords($admtext['edparams']),"img/modmgr_icon.gif",$menu,$message);

/***************************************************************
    4. MOD EDITOR PAGE CONTENT
***************************************************************/

// Inits for mod objects
//require 'classes/modobjinits.php';

// PROCESS POSTED FORM DATA
if( !empty( $_POST ) ) {
   foreach( $_POST as $key => $value )
   {
      ${$key} = $value;
   }
   if( $submit == "pUpdate" )
   {
      include_once 'classes/modeditor.class.php';
      $oEdit = new_modeditor();
      if( $oEdit->update_parameter( $param ) )
      {
        $action = EDITP;
        $cfgpath = $param['cfg'];

        $qs = $_SERVER['QUERY_STRING'];
        if( false !== $pos = strpos( $qs, "#forme_" ) )
        {
          $qs = substr( $qs, $pos);
        }

        $qs .= "#{$param['forme']}";
        header("Location:admin_modeditor.php?$qs");

      }
      else {
         header("Location:admin_showmodslog.php");
         exit;
      }
   }
   elseif( $submit == "pRestore" )
   {
      include_once 'classes/modeditor.class.php';
      $oEdit = new_modeditor();
      if( $oEdit->restore_parameter( $param ) )
      {
         $action = EDITP;
         $cfgpath = $param['cfg'];
        $qs = $_SERVER['QUERY_STRING'];
        if( false !== $pos = strpos( $qs, "#forme_" ) )
        {
          $qs = substr( $qs, $pos);
        }
        $qs .= "#{$param['forme']}";
        header("Location:admin_modeditor.php?$qs");
      }
      else
      {
         header("Location:admin_showmodslog.php");
         exit;
      }
   }
   elseif( $submit == "pCancel" )
   {
      /* should not reach here - modeditor cancels directly to
      ** admin_modhandler.*/
      header("Location:admin_modhandler.php");
   }
}

// PROCESS QUERY LINE ARGS
elseif( !empty( $_GET ) ) {
   foreach( $_GET as $key => $value )
   {
      ${$key} = $value;
   }
   if( isset( $a ) ) {
      $action = isset( $a ) ? $a : '';
      $cfgfile = isset( $m ) ? $m : '';
      $cfgpath = isset( $m ) ? $cfgfolder.$m : '';
   }
}

$min_width = $sitever == 'mobile' ? '0' : '640px';

// SHOW EDIT FORM
if( !empty( $action ) && $action == EDITP )
{

   if( !class_exists( "modeditor" ) )
   {
      require_once 'classes/modeditor.class.php';
      $oEdit = new_modeditor();
   }

   if( !$oEdit->show_editor( $cfgpath ) ) {
      ?>
      <script>
         window.location.href="admin_showmodslog.php";
      </script>
      <?php
   };
}

echo tng_adminfooter();

ob_end_flush();

/*************************************************************************
FUNCTIONS
*************************************************************************/
function set_innermenu_links( $tng_version, $pageID='editor' ) {
   global $text, $admtext;

   $parts = explode( ".", $tng_version );		// added to determine TNG vNN for
   $tngmodver = "{$admtext['tngmods']} v{$parts[0]}";	// Mods for TNG vNN text display
   $tngmodurl = "Mods_for_TNG_v{$parts[0]}";	// Mods for TNG vNN URL
   $helplang = findhelp("modhandler_help.php");

   // inner menu help
   $innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/modhandler_help.php#$pageID');\" class=\"lightlink\">{$admtext['help']}</a>
";

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
?>