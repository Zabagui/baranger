<?php
function set_horizontal_tabs( $show_analyzer = NO, $show_developer = NO, $show_updates = NO ) {
  global $admtext;

  $modtabs = array();
  $modtabs[] = array(1, "admin_modhandler.php", $admtext['modlist'],"modlist");
  $modtabs[] = array(1,"admin_showmodslog.php",$admtext['viewlog'],"viewlog");
  $modtabs[] = array(1,"admin_modoptions.php",$admtext['options'],"options");

  if ( $show_analyzer == YES)
  {
    $modtabs[] = array(1,"admin_modanalyzer.php",$admtext['analyzefiles'],'files');
  }

  if ( $show_developer == YES)
  {
    $modtabs[] = array(1,"admin_modtables.php",$admtext['parsetable'],'parser');
  }

  if ( $show_updates == YES)
  {
    $modtabs[] = array(1,"admin_modupdates.php",$admtext['recommendedfixes'],'updates');
  }

  return $modtabs;
}
