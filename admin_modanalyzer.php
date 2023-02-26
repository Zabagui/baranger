<?php
/*************************************************************************
    TNGv13 modanalyzer.php by William (Rick) Bisbee.

    Analyze all .cfg files in current folder for conflicts

    v13 updated by Rick Bisbee to integrate with new TNG Admin pages
    without iframes

    v14 updated by Michael Kirsch to show MM links to install, uninstall,
    clean or delete the affecting mod right from the Modanalyzer screen.
    Also updated to filter list of affecting mods (Installed only).

*************************************************************************/
require 'begin.php';
require 'adminlib.php';
$textpart = "mods";

require "$mylanguage/admintext.php";

$admin_login = 1;
require 'checklogin.php';
require 'version.php';
require 'classes/mmtabs.inc';
require $subroot.'mmconfig.php';

define( 'ON_ERROR',  0 );
define( 'ON_ALL',    1 );

define( 'OK2INST',   0);
define( 'INSTALLED', 1);
define( 'PARTINST',  2);
define( 'CANTINST',  3);

/*************************************************************************
PROCESS ANALYZER MOD ACTION REQUEST
*************************************************************************/
if( !empty( $_GET['a'] ) )
{
  // possible actions
  // 1 - install
  // 2 - uninstall
  // 3 - delete
  // 4 - cleanup

  $action = $_GET['a'];

  /* Ensure all other components are present in URL Query String */
  if( !isset( $_GET['m'] ) ) $action = 9; // bail out
  elseif(!isset( $_GET['t'] ) ) $action = 9; // bail out
  else
  {
    $modpath = $modspath.'/'.$_GET['m'];
    $mtarget = $_GET['t'];
  }

  switch ( $action )
  {
    case 1: // install
      require 'classes/modinstaller.class.php';
      $oInstaller = new_modinstaller();
      if( !$oInstaller->install( $modpath ) || $options['redirect2log'] == ON_ALL )
        header( "Location:admin_showmodslog.php");
      else
        header("location:admin_modanalyzer.php?mtarget=$mtarget");
      break;

    case 2: // uninstall
      require 'classes/modremover.class.php';
      $oRemover = new_modremover();
      if( !$oRemover->remove( $modpath ) || $options['redirect2log'] == ON_ALL )
        header( "Location:admin_showmodslog.php");
      else
        header("location:admin_modanalyzer.php?mtarget=$mtarget");
      break;

    case 3: // delete
      require 'classes/moddeleter.class.php';
      $oDeleter = new_moddeleter();
      if( !$oDeleter->delete_mod( $modpath ) || $options['redirect2log'] == ON_ALL )
        header( "Location:admin_showmodslog.php");
      else
      {
        $whichmods = $_SESSION['whichmods'];
        require 'classes/modvalidator.class.php';
        $oValidator = new_modvalidator();
        $mm_data = $oValidator->check_status(false);
        $modFiles = $oValidator->get_modfile_names();
        $modFiles = filter_files( $modFiles, $mm_data );
        $targetFiles = get_targetfile_names( $modFiles );
        $_SESSION['modfiles'] = $modFiles;
        $_SESSION['targetfiles'] = $targetFiles;
        header("location:admin_modanalyzer.php?mtarget=$mtarget");
        exit;
      }
      break;

    case 4: // clean
      require 'classes/modremover.class.php';
      $oRemover = new_modremover();
      $oRemover->classID = "cleaner";
      if( !$oRemover->remove( $modpath ) || $options['redirect2log'] == ON_ALL )
        header( "Location:admin_showmodslog.php");
      else
        header("location:admin_modanalyzer.php?mtarget=$mtarget");
      break;
    default:
      header("location:admin_modanalyzer.php?mtarget=$mtarget");
      break;
  }
}

require 'classes/modvalidator.class.php';
$oValidator = new_modvalidator();
$mm_data = $oValidator->check_status(false);
if( empty( $mm_data ) )
{
  /* Either no mods or the modspath is faulty. */
  header("location:admin_modhandler.php");
}

/* Prevent direct URL access to Mod Manager if not the TNG Administrator */
if( $assignedtree || !$allow_edit )
{
  $message = $admtext['norights'];
  header( "Location: admin_login.php?message=" . urlencode($message) );
  exit;
}

define( 'YES', "1" );
define( 'NO', "0" );

$modspath .= '/';

/***************************************************************
    1. OUTPUT STD ADMIN PAGE HTML HEADER + ADDITIONS
***************************************************************/
$flags['modmgr'] = true;
tng_adminheader( $admtext['modmgr'], $flags );

include $subroot.'mmconfig.php';

/* Backward compatibility - these can be set from the newer options files */
if (!isset($options['show_analyzer'])) $options['show_analyzer'] = "0";
if (!isset($options['show_developer'])) $options['show_developer'] = "0";
if (!isset($options['show_updates'])) $options['show_updates'] = "0";

$min_width = $sitever == 'mobile' ? '0' : '640px';

/* explicitly close head section */
echo "
<script type='text/javascript' src='js/modmanager.js'></script>
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
$modtabs = set_horizontal_tabs( $options['show_analyzer'], $options['show_developer'],
                                $options['show_updates']);
$innermenu = set_innermenu_links( $tng_version );

$menu = doMenu($modtabs,"files",$innermenu);

if(!isset($message)) $message = "";

echo displayHeadline($admtext['modmgr'],"img/modmgr_icon.gif",$menu,$message);

if( empty( $admtext['modguidelines'] ) ) $admtext['modguidelines'] = "Mod Guidelines";

/***************************************************************
    4. MOD MANAGER MOD ANALYZER PAGE CONTENT
***************************************************************/
// When first time in the session or click on the "Analyze TNG files" Tab
if (!isset($_SESSION['whichmods']) || (!$_GET && !$_POST) )
  $_SESSION['whichmods'] = "all";

// When choosing a radio button
if (isset($_POST['whichmods']))
{
  $_SESSION['whichmods'] = $_POST['whichmods'];
  $mtarget = ""; // to empty the list at the right
}

/* $whichmods can be "all", "installed" or "partinst" */
$whichmods = $_SESSION['whichmods'];

echo "
<div class='admin-main'>
";

/***************************************************************
  CONTROL BAR
    Form for radio buttons and Submit button
      ALL - Installed mods - Installed & Partially Installed
***************************************************************/
echo "
  <form action='' method = 'POST'>
    <table id='cbar' class='mmtable'>
      <tr>
        <td class = 'fieldnameback fieldname roundtop mmpadtop5'>
          <div class = 'float-left'>
            <input type='radio' id='mods1' name='whichmods' value='all' checked>
              <label for='01'>{$admtext['allmods']}</label>
              &emsp;
            <input type='radio' id='mods2' name='whichmods' value='installed'";
              echo $whichmods == "installed" ? "checked>" : ">";
              echo "<label for='02'>{$admtext['installedmods']}</label>
              &emsp;
            <input type='radio' id='mods3' name='whichmods' value='partinst'";
              echo $whichmods == "partinst" ? "checked>" : ">";
              echo "<label for='03'>{$admtext['partinstmods']}</label>
              &emsp;
            <input type='submit' id='modschoice'>
          </div>
        </td>
      </tr>
    </table>
  </form>
";

/***************************************************************
  SCROLLING SETUP FOR LEFT COLUMN
***************************************************************/
echo "
<div class='tableFixedHead'>
<table id='outer' class='mmtable2'>
  <thead>
  <tr>
    <th class='fieldnameback fieldname'>{$admtext['filesel']}</th>
    <th class='fieldnameback fieldname'>{$admtext['potconf']}</th>
  </tr>
  </thead>
<tr>
<td class='mmleftcol' style='padding-left:0;'>";

/*************************************************************************
DISPLAY INDEX OF MODIFIED FILES (LEFT SIDE)
**************************************************************************/
echo " <table id='left' class='mmtable'>
";
/* this code avoids recreating the two lists each time admin_analyzer.php
** is called. The lists are created only when clicking on the "Analyze TNG files"
** Tab or when another radio button is choosen. */
if(!$_GET || $_POST)
{
  $modFiles = $oValidator->get_modfile_names();
  $modFiles = filter_files( $modFiles, $mm_data );
  $targetFiles = get_targetfile_names( $modFiles );
  $_SESSION['modfiles'] = $modFiles;
  $_SESSION['targetfiles'] = $targetFiles;
}
else
{
  $modFiles = isset($_SESSION['modfiles']) ? $_SESSION['modfiles'] : array();
  $targetFiles = isset($_SESSION['targetfiles']) ? $_SESSION['targetfiles'] : array();
}

display_targetfiles( $targetFiles );
echo "
</table><!--left-->
</td>";

/*************************************************************************
DISPLAY FILE MODIFICATIONS (RIGHT SIDE)
*************************************************************************/
echo "
<td class='databack mmrightcol mmrounded' style='border:1px solid #888'>
<table id='right' class='mmtable'>
";

if ($_GET && is_array ($_GET))
{
  if (!empty($mtarget))
  {
    $file_hdr = str_replace( 'xxx', "<span class='mmhighlight'>$mtarget</span>", $admtext['filemod'] );
    echo "
   <tr>
      <th colspan='5' class='databack'>
         <h2>$file_hdr:</h2>
      </th>
   </tr>";

    $id = 1;

    foreach ($modFiles as $file)
    {
      $buffer = file_get_contents( $modspath.$file);
      $buffer = htmlentities( $buffer, ENT_IGNORE );
      $buffer = preg_replace( '#([@^~])#', '', $buffer );
      $buffer = str_replace( '$modspath', $modspath, $buffer );
      $buffer = str_replace( '$extspath', $extspath, $buffer );

      preg_match_all("#^\s*%target:\s*$mtarget%#m", $buffer, $matches );
      if( $matches[0])
      {
        echo "
   <tr>
      <td colspan='2' class='hideoverflow'>";
            display_section_locations( $file, $buffer, $mtarget, "id$id" );
            $id++;
          echo "
      </td>
   </tr>";
      }
    }
  }
  else
    echo "
    <tr><td class='databack'>{$admtext['selectfile']}</td></tr>";
}
  else
    echo "
    <tr><td class='databack'>{$admtext['selectfile']}</td></tr>";

echo "
</table><!--right-->
</td>
</tr>
</table><!--outter-->
</div><!-- tableFixedHead -->
</div><!-- admin-main -->
";
/*************************************************************************
JAVASCRIPT SECTION
*************************************************************************/
echo "
<script type=\"text/javascript\">
function toggleSection(sectionName) {
   var section = document.getElementById(sectionName + 'div');
   var link = document.getElementById(sectionName + 'link');
   if(section.style.display == \"none\") {
      section.style.display = \"\";
      link.innerHTML = \"{$admtext['hide']}&nbsp;{$admtext['modifications']}\";
   }
   else {
      section.style.display = \"none\";
      link.innerHTML = \"{$admtext['show']}&nbsp;{$admtext['modifications']}\";
   }
   return false;
}
</script>";

echo tng_adminfooter();
exit;
/*************************************************************************
Functions
**************************************************************************/
function set_innermenu_links( $tng_version, $pageID='analyzer' )
{
  global $text, $admtext;

  $parts = explode( ".", $tng_version );    // added to determine TNG vNN for
  $tngmodver = "{$admtext['tngmods']} v{$parts[0]}";  // Mods for TNG vNN text display
  $tngmodurl = "Mods_for_TNG_v{$parts[0]}";  // Mods for TNG vNN URL
  $helplang = findhelp("modhandler_help.php");

  // inner menu help
  $innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/modhandler_help.php#$pageID');\" class=\"lightlink\">{$admtext['help']}</a>
";

  // MM syntax
  $innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_Syntax\" target=\"_blank\" class=\"lightlink\">{$admtext['modsyntax']}</a>
";

  // mod guidelines
  $innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Mod_Guidelines\" target=\"_blank\" class=\"lightlink\">{$admtext['modguidelines']}</a>";

  // mods for TNGv10
  $innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Category:$tngmodurl\" target=\"_blank\" class=\"lightlink\">$tngmodver</a>
";
  return $innermenu;
}

function filter_files( $modfiles, $mm_data )
{
  global $whichmods;

  $filtered_list = array();
  foreach( $modfiles as $modfile )
  {
    foreach( $mm_data as $mm_item )
    {
      if( $modfile == $mm_item['modfile'] )
      {
        if( $whichmods == 'all'
            || $mm_item['status'] == INSTALLED
            || ($mm_item['status'] == PARTINST
                && $whichmods == 'partinst') )
        {
          $filtered_list[] = $modfile;
          break;
        }
      }
    }
  }
  return $filtered_list;
}

/* Returns the mod's status.  Uses the array constructed
** by the Modvalidator class. Returns false if there is no status. */
function get_mod_status($mod)
{
  global $cms, $mm_data;

  /* Makes codes understandable for style and $admtext variables used in the
  ** right part of the screen (mods list).*/
  $clearstatus = array(0 =>'ok2inst', 1 => 'installed', 2 => 'partinst', 3 => 'cantinst');

  $toreturn = false;
  $modkey = basename($mod);

  $index = array_search($modkey, array_column($mm_data, 'modfile'));
  //$index = array_search($modkey,array_map('strtolower',array_column($mm_data, 'modfile')));

  if($index !== false)
  {
    $status = $mm_data[$index]['status'];
    $toreturn = $clearstatus[$status];
  }
  return $toreturn;
}

function get_targetfile_names ($modFileNames)
{
  global $modspath, $extspath;

  $targets = array ();
  foreach ($modFileNames as $fileName)
  {
    $buffer = file_get_contents($modspath.'/'.$fileName);
    $buffer = preg_replace( '#([@^~])#', '', $buffer );
    $buffer = str_replace( '$modspath', $modspath, $buffer );
    $buffer = str_replace( '$extspath', $extspath, $buffer );
    $parts = preg_split( "#^\s*\%target\:#m", $buffer );

    for ($i=1; $i < count($parts); $i++)
    {
      $element = substr($parts[$i], 0, (strpos($parts[$i], '%')));
      $args = explode( ':', $element, $limit=2 );
      $element = trim( $args[0] );
      if( $element == 'files' ) continue;
      if (strlen($element) > 0 && !in_array($element, $targets))
      {
        $targets[] = $element;
      }
    }
  }
   sort ($targets);
   return ($targets);
}

function display_targetfiles ($targetFiles)
{
  natcasesort($targetFiles); // sort MM lists mod
  foreach ($targetFiles as $mtarget)
  {
    $fl = strtoupper(substr($mtarget,0,1));
      echo "
  <tr class=\"clink_{$fl}\">
    <td class='flink databack mmrightalign mmrounded hideoverflow'
      onClick=\"window.location.href='admin_modanalyzer.php?mtarget=$mtarget'\">
        $mtarget
    </td>
  </tr>";
  }
}

function display_section_locations( $modfile, $contentstr, $mtarget, $id )
{
   global $admtext, $options, $rootpath, $modspath;

  $contentstr = nl2br( $contentstr);
  $sections = array_map( 'trim', explode( "%target:", $contentstr ) );
  $mod_status = get_mod_status($rootpath . $modspath . $modfile);
  $mod_style = "class=\"$mod_status" . " hideoverflow centerit\"";
  $show_modif_text = $admtext['show'] . "&nbsp;" . $admtext['modifications'];
  echo " <span class=\"mmfilenmfont hideoverflow\" title=\"$modfile\">$modfile</span></td>
      <td $mod_style>{$admtext[$mod_status]}</td>
      <td class=\"hideoverflow centerit\"> <a href=\"#\" id=\"{$id}link\" onclick=\"return toggleSection('$id');\" title=\"$show_modif_text\">$show_modif_text</a> </td>
";

  if($options['show_analyzeractions'])
  {
    $action = $action2 = "";
    switch($mod_status)
    {
      case "installed" :
        $action = 2;
        $actionmsg = $admtext['uninstall'];
        if($options['delete_installed'] == 1){
          $action2 = 3;
          $actionmsg2 = $admtext['delete'];
        }
        break;
      case "partinst":
        $action = 4;
        $actionmsg = $admtext['cleanup'];
        if($options['delete_partial'] == 1){
          $action2 = 3;
          $actionmsg2 = $admtext['delete'];
        }
        break;
      case "cantinst":
        $action = 3;
        $actionmsg = $admtext['delete'];
        break;
      case "ok2inst":
        $action = 1;
        $actionmsg = $admtext['install'];
        $action2 = 3;
        $actionmsg2 = $admtext['delete'];
        break;
      default:
        $action = "";
        $actionmsg = "";
    }

    /* Display mod action links in right column */
    if ($action != "")
      if($action != 3)
        /* Mod is viable, show the relevant action (1, 2, 4) */
        echo "<td><a href=\"?a=$action&m=$modfile&t=$mtarget\">$actionmsg</a>";
      else
        /* Can't install mod - just show 'delete' link */
        echo "<td><a href=\"?a=$action&m=$modfile&t=$mtarget\" onclick=\"return(confirm('{$admtext['confdelmod']}'));\">$actionmsg</a>";

    if ($action2 != "")
      /* Add second option - delete- to action links */
      echo "&emsp;<a href=\"?a=$action2&m=$modfile&t=$mtarget\" onclick=\"return(confirm('{$admtext['confdelmod']}'));\">$actionmsg2</a>";
    if ($action != "")
      echo"</td>";
  }
  echo"
    </tr>
    <tr>
      <td colspan=\"5\">
      <div id=\"{$id}div\" style=\"display:none\">
    ";

  for( $i=1; isset( $sections[$i] ); $i++ )
  {
      $target_file = trim(preg_replace("#([^%]*)%.*#s", "\${1}", $sections[$i]));
      if( trim( $target_file ) == trim( $mtarget ) )
      {
        $locations = array_map ('trim', explode ("%location:%", $sections[$i]));
        for ($j=1; isset($locations[$j]); $j++)
        {
          $locations[$j] = substr( $locations[$j], 0, strripos( $locations[$j], '%end:%' ) );
          $locations[$j] = str_replace ("%end:%", "</strong>%end:%", $locations[$j]);
          $locations[$j] .= "%end:%<br />";
          $locations[$j] = preg_replace("@((%location|%end|%trim|%insert|%replace)[^%]*%)@i", "<span class=\"mmkeyword\">$1</span>", $locations[$j]);
          echo "
          <span class=\"mmlochdr\">// Location $j</span><br />
          <span class=\"mmkeyword\">%location:%</span><strong>
          {$locations[$j]}";
         }
      }
  }
  echo "
    </div>";
} // display_selection_location
