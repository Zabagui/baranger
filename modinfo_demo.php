<?php
include 'begin.php';
include 'adminlib.php';
$textpart = "mods";
include 'getlang.php';

include "$mylanguage/admintext.php";

$admin_login = 1;
include 'checklogin.php';
include 'version.php';
include 'classes/version.php';
include $subroot.'mmconfig.php';

$mhuser = isset( $_SESSION['currentuserdesc'] ) ? $_SESSION['currentuser'] : "";

require 'classes/modobjinits.php';

/*
// INITIALIZATIONS FOR MOD OBJECTS
$fpaths = array (
   'rootpath'  => $rootpath,
   'subroot'   => $subroot,
   'modspath'  => $modspath,
   'extspath'  => $extspath
);

$objinits = array (
   'fpaths'       => $fpaths,
   'options'      => $options,
   'time_offset'  => $time_offset,
   'sitever'      => $sitever,
   'currentuserdesc' => $mhuser,
   'admtext'      => $admtext,
   'templatenum'  => $templatenum,
   'tng_version'  => $tng_version
);
*/

include 'classes/modinfo.class.php';

$modfile = 'add_dna_test_results_v11.1.1.8.cfg';
$oMod = new modinfo( $objinits );

$modlist = $oMod-> get_modlist_sorted();
$modnames = $oMod->get_modfile_names();

//print_r( $modlist );

$oMod->collect_info( $modfile );

$status = $oMod->get_status();
$name = $oMod->get_modname();
$version = $oMod->get_version();
$wikipage = $oMod->get_wikipage();
$authors = $oMod->get_authors();
$filenames = $oMod->get_modfile_names();
$private = $oMod->get_private();

$flags['modmgr'] = true;
tng_adminheader( $admtext['modmgr'], $flags );

$raw_table = $oMod->tags;
//print_r( $raw_table ); exit;

$targets = $oMod->get_target_files();
//print_r( $targets );exit;

echo "
<table>
   <tr>
      <td>filename</td>
      <td>{$modfile}</td>
   </tr>
   <tr>
      <td>modname</td>
      <td>$name</td>
   </tr>

   <tr>
      <td>version</td>
      <td>$version</td>
   </tr>";
   
if( !empty($authors) ) {
   foreach( $authors as $author) {
      echo "
         <tr>
            <td>author</td>
            <td>$author</td>
         </tr>";
   }
}

if( !empty( $private ) ) {

   echo "
   <tr>
      <td>private</td>
      <td>$private</td>
   </tr>";

}

if( !empty( $wikipage ) ) {

   echo "
   <tr>
      <td>wikipage</td>
      <td>$wikipage</td>
   </tr>";

}

echo "
   <tr>
      <td>status</td>
      <td>$status</td>
   </tr>
</table>";

$table = $oMod->get_parse_table();

?>