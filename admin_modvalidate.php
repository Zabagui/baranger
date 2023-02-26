<?php
/* read all mod files, determine their installation status and create
** an array of results in mm_data.php
*/
  //include 'begin.php';
  //include 'adminlib.php';

  $textpart = "mods";

  // if called directly just bail
  if( empty( $mylanguage ) ) die( 'sorry' );

  include_once $mylanguage."/admintext.php";

  // $admin_login = true;

  //include "checklogin.php";
  //include "version.php";
  //include "classes/version.php";

  require_once $subroot.'mmconfig.php';

  $mhuser = isset( $_SESSION['currentuserdesc'] ) ? $_SESSION['currentuser'] : "";

  require 'classes/modobjinits.php';

  if( file_exists( 'classes/modvalidator.class.php' ) )
  {
    require 'classes/modvalidator.class.php';
    $oValidator = new modvalidator( $objinits );
    $mm_data = $oValidator->check_status(false);
  }
  return;
?>