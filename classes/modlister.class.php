<?php
/*
   Mod Manager 14.0.0.1 Modlisting Class

   Construction: Modbase -> Modparser -> Modvalitator -> Modlister

   Class extends modvalidator.  It lists mod config files according to
   selectable filters, does basic error checking, shows identifying
   information, displays installation status and lists files affected.

   Incorporates 1) mod listing enhancements by Robin Richmond and 2)
   a button by Jeff Robison to show detailed status for Installed or
   OK to install mods (default is not to show any detail for them.)

   Class code refactored in 2022 by Rick Bisbee.

   Public Methods:
      $this->list_mods(); // list all mods
      $this->set_modfile(); // set mod list with just one file.

   PHP function new_modlister();
*/
if(!isset($id) AND !empty($_SESSION['actualmod']))
{
  $id = $_SESSION['actualmod'];
  $_SESSION['actualmod'] = "";
}

/* File management */
$modlister_version = '14.0.0.1 221107-0615';

include_once 'classes/modvalidator.class.php';

#[AllowDynamicProperties]
class modlister extends modvalidator
{
    function __construct( $objinits )
    {
      parent::__construct( $objinits );
    }

    protected $classID = "lister";

    public $filter = self::F_ALL;
    public $fbox_checked = false;
    public $modlist = array();
    public $session_sortby = 0;

    protected $target_file_contents = '';
    protected $active_target_file = '';
    protected $is_target = false;
    protected $affected_files = array();
    protected $target_location_count = 0;
    protected $authors = array();
    protected $isprivate = false;
    protected $author = array();
    protected $name = '';

    protected $borderleft = '';
    protected $borderbl = '';

    /* Status message templates - used with sprintf to centralize
    ** mod listing message styles for ease of maintenance.
    ** The digit in the name refers to the number of arguments
    ** required by sprintf(). */

    /* just the status word */
    protected $m_approved1 = "<span class='msgapproved'>%s</span>";

    protected $m_approved1h = "<span class='hilight'>%s</span>";

    protected $m_approved1p = "<span>%s</span>";

    /* status word & status word */
    protected $m_approved1x2 = "%s&nbsp;<span class='msgapproved'>%s</span>";

    /* Directive name & status word */
    protected $m_approved2 = "<span style='color:navy'>%%%s</span> <span class='msgapproved'>%s</span>";

    protected $m_approved2h = "<span style='color:navy'>%%%s</span> <span class='hilight'>%s</span>";

    protected $m_approved2p = "<span style='color:navy'>%%%s</span> <span>%s</span>";

    /* error number, status word */
    protected $m_error2 = "<span class='tag'>v%d&nbsp;</span><span class='hilighterr msgbold'>&nbsp; %s</span>";

    /* Error number, directive name & status word */
    protected $m_error3 = "<span class='tag'>v%d&nbsp;</span><span class='hilighterr msgbold'>%%%s %s</span>";
    protected $m_error3x2 = "<span class='tag'>v%d&nbsp;</span><span class='hilighterr msgbold'>%s %s</span>";

    public function list_mods()
    {
      $this->sysmsg = '';

      /* Verify that the TNG modspath and extspath are accessible
      ** and get the mods listing
      **/
      while(true)
      {
        // DISPLAY BIG SYSTEM MESSAGE IF NO MODFILES ARE FOUND
        if( empty( $this->modspath ) )
        {
          /* $modspath not defined/present in config.php */
          $this->sysmsg = "<span class='msgerror'>\$modspath {$this->admtext['missing']}";
          break;
        }

        if( empty( $this->extspath ) )
        {
          /* $extspath not defined/present in config.php */
          $this->sysmsg = "<span class='msgerror'>\$extspath {$this->admtext['missing']}";
          break;
        }

        /* Attempt to get mod file listing from mods directory */
        $modlisting = $this->get_modlisting();

        if( !is_numeric( $modlisting ) )
          /* Mod listing succeeded -- break exit the error testing loop */
          break;

        if( $modlisting == self::NOPATH )
        {
          $this->sysmsg = "{$this->admtext['cannotopendir']}: ".
                            rtrim($this->modspath, "/")."!";
          break;
        }

        if( $modlisting == self::NOMODS )
        {
          $this->admtext['nomods'] = str_replace( "xxx", "cfg",
                                      $this->admtext['nomods'] );
          $this->sysmsg = "{$this->admtext['nomods']} - ".
                            rtrim($this->modspath, "/");
          break;
        }

        if( $modlisting == self::NOREAD )
        {
          $this->sysmsg = "{$this->admtext['noaccess']} - ".
                            rtrim($this->modspath, "/" );
          break;
        }

        if( !empty( $this->sysmsg ) )
        {
          break;
        }

        $this->sysmsg = "Modlister:line ".__LINE__.' '.$this->admtext['errors'];
        break;
      } // verify access to modspath and extspath & and get modfile listing

      $this->display_filterbar();
      $this->display_headings();

      /* If mod folder or mod files inaccessible show system msg and quit */
      if( !empty( $this->sysmsg ) )
      {
        $this->sys_msg( $this->sysmsg );
        return;
      }

      /* Fix capitalization in admtext array. */
      $this->admtext['line'] = strtolower( $this->admtext['line'] );

      /* Set borders according to whether selection boxes are displayed. */
      if( !empty($_POST['filter'] ) )
      {
        $this->borderleft = '';
        $this->borderbl = '';
      }
      else
      {
        $this->borderleft = 'roundleft';
        $this->borderbl = 'roundbl';
      }

      /* Approved list of modfiles passed by filter for display. */
      $selected_mods = array();
      if( !empty( $this->modlist ) )
      {
         foreach( $this->modlist as $modfile ) {
            $selected_mods[] = pathinfo( $modfile, PATHINFO_BASENAME );
         }
      }

      //$modlisting = $this->get_modlisting();
      /*******************************************************************
      LIST STATUS OF EVERY MOD IN THE MOD DIRECTORY
      *******************************************************************/
      foreach( $modlisting as $cfgfile => $modname )
      {
        if( !empty( $selected_mods ) && !in_array( $cfgfile, $selected_mods ) ) continue;

        // INITIALIZE DYNAMIC ELEMENTS FOR THIS MOD
        // mod info
        $this->cfgfile = $cfgfile;
        $this->cfgpath = $this->rootpath.$this->modspath.'/'.$cfgfile;
        $this->init_class_properties();

        $this->parse_table = array();

        /* Single mod processing loop */
        while( true )
        {
          /* If mod does not validate, break and let display_modline()
          ** handle the parse error */
          if( !$this->validate( $this->cfgfile) ) break;

          /*************************************************************
          PROCESS PARSE TABLE DIRECTIVES TO LIST STATUS OF CURRENT MOD
          *************************************************************/
          for($i=0; isset( $this->parse_table[$i] ); $i++ )
          {
            $directive = $this->parse_table[$i];
            $directive_name = $directive['name'];

            /* The location directive processes all file modifying
            ** directives, so bypass them here*/
            if( in_array( $directive_name, $this->file_modifiers ) )
              continue;

            /* PHP allows assignment of a function name to a variable
            ** and then executing the "variaable" with arguments. We get
            ** the function name associated with this directive from
            ** $proclist.*/
            $function = $this->proclist[$this->parse_table[$i]['name']];

            /* If for some reason the function lookup fails, publish the
            ** error. This can happen if the $i index gets unsynched with
            ** the parse_table -- a definite MM error.*/
            if( !is_string( $function ) )
            {
              $statstring .= sprintf( $this->m_error2,
                                      __LINE__,
                                      "modlister ".$this->admtext['errors'] );
              $this->set_status( $statstring );
              break;
            }

            $refj = $i;
            /***********************************************************/
            /* Use preset function to set status of this directive.
            ** If function processes more than one tag it will advance
            ** index $i to skip the table entries already processed.
            **
            ** ALL FUNCTIONS MUST RETURN $i OR MODLISER WILL CRASH!
            */
            $i = $this->$function( $i );
            /***********************************************************/

            if(  $i < $refj )
            {
              $this->parse_error['line'] = $i;
              $this->parse_error['tag']  = 'L'.__LINE__.
                ' <strong>Index </strong>';
              $this->parse_error['text'] = 'errors';
            }

            /* Status Error result? Emit and stop listing. */
            if( !empty($this->parse_error ) )
            {
              break;
            }
          }
          break;
        } // while(true) - single mod processing loop

        /* Assign the final status and list the mod */
        $this->display_modline( $selected_mods );

      } // All mods processing loop

      $this->close_listing();
      return $this->parse_table;
   } // list_mods()

  /*************************************************************
    DIRECTIVE FUNCTIONS
  *************************************************************/
  protected function _author( $i )
  {
    /*  %author directive datapack map = $this->parse_table[$i]
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == author
    **  $datapack['arg1'] == name of author
    **  $datapack['arg2'] == optional link to author's page
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty (not a conditional directive)
    */

    /* Get the %author directive datapack from the parse table */
    $author_datapack = $this->parse_table[$i];

    /* Create an array item in case there are more authors. */
    $authors = !empty( $author_datapack['arg2'] )
      ? "<a href='{$author_datapack['arg2']}' target='_blank'>
          {$author_datapack['arg1']}</a>"
      : $author_datapack['arg1'];

    /* Add to global authors array. */
    $this->authors[] = $authors;

    return $i;
  }

  protected
  function _copyfile( $i )
  {
    /*  %copyfile directive datapack map = $parse_table($i)
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == copyfile or copyfile2
    **  $datapack['arg1'] == full server path to source file
    **  $datapack['arg2'] == full server path to destination file
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == flag (if any)
    **  $datapack['goto'] == empty (not a conditional directive)
    **  $datapack['statkey'] == status code
    **  $datapack['eline'] == validation error line if any
    */
    $datapack = $this->parse_table[$i];

    /* Extract listing elements from the datapack */
   $line = $datapack['line'];
    $name = $datapack['name'];
    $srcpath = $datapack['arg1'];
    $destpath = $datapack['arg2'];
    $flag = $datapack['flag'];
    $statkey = $datapack['statkey'];
    $eline = $datapack['eline'];

    /* Get the foldable, relative srcpath name for the MM display. */
    $relsrcpath = $this->foldable_string( str_replace( $this->rootpath, '', $srcpath ) );

    /* Get the foldable, short relative destpath name for the MM display. */
    $reldestpath = $this->foldable_string( str_replace( $this->rootpath, '', $destpath ) );

    if( $name == 'copyfile' )
    {
      $this->affected_files['afcopy'][] = $destpath;
    }
    elseif( $name == 'copyfile2' )
    {
      $this->affected_files['afcopy2'][] = $destpath;
    }

    $statstring = "<div class='list-indent'>
    {$this->admtext['line']} $line: <span class='tag'>%$name: </span>
    <span class='copyfile'>
       $flag$reldestpath
    </span>&nbsp;";

    switch( $statkey )
    {
      case self::vNOTINST:
        if( $this->modstatus_header == 'partinst' )
        {
          $template = $this->m_approved1h;
        }
        else
        {
          $template = $this->m_approved1p;
        }
        $statstring .= sprintf( $template,
                                $this->admtext['notcopied'] );
        break;

      case self::vNOTINST + self::vOPTIONAL:
        $statstring .= sprintf( $this->m_approved1x2,
                                $this->admtext['optional'],
                                $this->admtext['notcopied'] );
        break;

      case self::vNOTINST + self::vPROTECTED:
        $statstring .= sprintf( $this->m_approved1x2,
                                $this->admtext['protected'],
                                $this->admtext['notcopied'] );
        break;

      case self::vNOTINST + self::vPROVISIONAL:
        $statstring .= sprintf( $this->m_approved1x2,
                                $this->admtext['provisional'],
                                $this->admtext['notcopied'] );
        break;

      case self::vINSTALLED:
        $statstring .= sprintf( $this->m_approved1,
                                $this->admtext['copied'] );
        break;

      case self::vINSTALLED + self::vPROTECTED:
        $statstring .= sprintf( $this->m_approved1x2,
                                $this->admtext['copied'],
                                $this->admtext['protected'] );
          break;

      case self::vINSTALLED + self::vOPTIONAL:
        $statstring .= sprintf( $this->m_approved1x2,
                                $this->admtext['copied'],
                                $this->admtext['optional'] );
        break;

       case self::vINSTALLED + self::vPROVISIONAL:
        $statstring .= sprintf( $this->m_approved1x2,
                                $this->admtext['copied'],
                                $this->admtext['provisional'] );
        break;

      case self::vDSTFOLDER + self::vMISSING + self::vPROVISIONAL:
        $statstring .= sprintf( $this->m_approved1x2,
                                $this->admtext['nofolder'],
                                $this->admtext['provisional'] );
        break;

      case self::vDSTFOLDER + self::vMISSING + self::vERROR:
        $statstring .= sprintf( $this->m_error2,
                                $eline, $this->admtext['nofolder'] );
        break;

      case self::vSRCFILE + self::vMISSING + self::vERROR:
        $statstring .= sprintf( $this->m_error2,
                                $eline, $this->admtext['srcfilemissing'] );
        break;


      default:
        break;
    }

    $this->set_status( $statstring, $relsrcpath );
    return $i;
  } // _copyfile()

  protected function _desc( $i )
  {
    /* The %desc data is not displayed */
    return $i;
  }

  protected function _description( $i )
  {
    $datapack = $this->parse_table[$i];

    /* Sets global $this->description.*/
    $this->description = $datapack['arg1'];
    return $i;
  }

  protected function _fileexists( $i )
  {
    /* Modlister does nothing with this directive from the parse table.
    ** It is for user information only. */
    return $i;
  }

  protected function _goto( $i )
  {
    /* Modlister does nothing with this directive from the parse table.
    ** It is for user information only. */
    return $i;
  }

  /* File modifier functions called by %location: and not from $proclist */
  protected function _insert( $i, $statstring  )
  {
    /*  %insert directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == insert:before or insert:after
    **  $datapack['arg1'] == code to be inserted into the target file
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty (not a conditional directive)
    **  $datapack['statkey'] == valication status code
    **  $datapack['eline'] == error line if any
    */

    /* The status string ($statstring) has been started in the _location()
    ** function.  It will be completed and registered here.
    */

     /* Index $i points to the %insert datapack.
     ** Get datapack and extract listing elements */
    $datapack = $this->parse_table[$i];
    $name = $datapack['name'];
    $statkey = $datapack['statkey'];
    $eline = $datapack['eline'];

    switch( $statkey )
    {
      case self::vLOCCODE + self::vNOCONTENT + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline, "location",
                                $this->admtext['nocomps'] );
        break;

      case self::vCFGCODE + self::vNOCONTENT + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                $name,
                                $this->admtext['nocomps'] );
        break;

      case self::vINSTALLED:
        $statstring .= sprintf( $this->m_approved2,
                                $name,
                                $this->admtext['installed'] );
        break;

      case self::vBADTARGET + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,

                                $name,
                                $this->admtext['badtarget'] );
        break;

      case self::vLOCCODE + self::vNOTUNIQUE + self::vERROR:
        $statstring .= sprintf( $this->m_error3, $eline, "location", $this->admtext['notunique'] );
        break;

      case self::vCFGCODE + self::vNOTUNIQUE + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                $name,
                                $this->admtext['notunique'] );
        break;

      case self::vNOTINST:
        if( $this->modstatus_header == 'partinst' )
        {
          $template = $this->m_approved2h;
        }
        else
        {
          $template = $this->m_approved2p;
        }
        $statstring .= sprintf( $template,
                                $name,
                                $this->admtext['notinst'] );
        break;

      case self::vERROR:
        $statstring .= sprintf( $this->error3,
                                $eline,
                                $name,
                                $this->admtext['errors'] );
        break;

      default:
        break;
    }

    /* Add %insert directive status to the mod status display string.*/
    $this->set_status( $statstring );
    return $i;
  } // _insert()


  protected function _label( $i )
  {
    return $i;
  }

  protected function _location( $i )
  {
    /*  %location directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == location
    **  $datapack['arg1'] == code to be found in the target file
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == optional note
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty (not a conditional directive)
    **  $datapack['statkey'] == empty
    **  $datapack['eline'] == empty
    **
    **  If target file is not open (missing), the %location
    **  directives will not appear the the parse table, so no
    **  need to test for a target file here.
    **
    **  Errors in %location code are displayed with the file modifier
    **  directive in the parse table.*/

    /* Get the %location datapack and break out elements for the
    ** listing.*/

    if( !$this->is_target )
    {
      $i++;
      return $i;
    }
    $location_datapack = $this->parse_table[$i];
    $line = $location_datapack['line'];
    $note = $location_datapack['arg3'];

    /* Check for special note associated with this location. */
    $notestr = '';
    if( !empty( $note ) )
    {
      $notestr = "<br /><span class='location-note'>$note</span><br />";
    }

    /* A file modifying directive always follows %location in
    ** the parse table. Point to it here. */
    $i++;

    $modifier_datapack = $this->parse_table[$i];
    $modifier_op = $modifier_datapack['name'];

    /* Start the status string for this %location directive. */
    $statstring = "$notestr{$this->admtext['line']} $line: <span class='tag'>%location #$this->target_location_count</span>&nbsp;";

    /* Increment for next location # */
    $this->target_location_count++;

    /* Dispatch the location status string to the file editing
    ** directive function to finish breaking out and validating
    ** the location code.*/
    $function = $this->proclist[$modifier_op];

    /* Dispatch to modifier function for final processing.*/
    $i = $this->$function( $i, $statstring );

    return $i;
  } // _location()

  protected function _mkdir( $i )
  {
    /*  %mkdir directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == mkdir
    **  $datapack['arg1'] == directory (folderpath) to be created
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == if any, optinal @
    **  $datapack['goto'] == empty (not a conditional directive)
    **  $datapack['statkey'] == installation status
    **  $datapack['eline'] == validation error line if any
    */

    /* Get the datapack from the parse table and break out the
    ** display values.*/
    $datapack = $this->parse_table[$i];
    $line = $datapack['line'];
    $dest_path = $datapack['arg1'];
    $flag = $datapack['flag'];
    $statkey = $datapack['statkey'];
    $eline = $datapack['eline']; // not used here

    // USE RELATIVE DESTINATION PATH FOR STATUS DISPLAYS
    $reldestpath = $flag.str_replace( $this->rootpath, '', $dest_path );
    $reldestpath = $this->foldable_string( $reldestpath );

    /* Start the status string */
    $statstring = "<div class='list-indent'>{$this->admtext['line']} $line: <span class='tag'>%mkdir: </span><span class='mkdir'>$reldestpath</span>&nbsp;";

    // REPORT ON EXISTENCE OF FOLDER
    if( $statkey  == self::vNOTINST )
    {
      if( $this->modstatus_header == 'partinst' )
      {
        $template = $this->m_approved1h;
      }
      else
      {
        $template = $this->m_approved1p;
      }
      $statstring .= sprintf( $template,
                              $this->admtext['nocreated'] );
    }
    elseif ( $statkey ==  self::vINSTALLED )
    {
      $statstring .= sprintf( $this->m_approved1,
                              $this->admtext['exists'] );
    }
    $this->set_status( $statstring );
    return $i;
  } // _mkdir()


  protected function _name( $i )
  {
    /* Sets global $this->name for use in the listing.*/
    $datapack = $this->parse_table[$i];
    $this->name = $datapack['arg1'];
    return $i;
  }

 protected function _newfile( $i )
 {
    /*  %newfile directive map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == newfile
    **  $datapack['arg1'] == filepath for new file
    **  $datapack['arg2'] == content of new file
    **  $datapack['arg3'] == version number of new file
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty
    **  $datapack['statkey'] == installatiion status
    **  $datapack['eline'] == validation error line if any
    */

    /* Get datapack from the parse table and break out elements
    ** for listing the %newfile directive.*/
    $datapack = $this->parse_table[$i];
    $destpath = $datapack['arg1'];
    $line = $datapack['line'];
    $flag = $datapack['flag'];
    $statkey = $datapack['statkey'];
    $eline = $datapack['eline'];

    $this->affected_files['afcreate'][] = str_replace( $this->rootpath, '', $destpath );

    /* Use foldable relative destination path for display */
    $reldestpath = $this->foldable_string( str_replace( $this->rootpath, '', $destpath ) );

    /* Start the status string */
    $statstring = "<div class='list-indent'>{$this->admtext['line']} $line: <span class='tag'>%newfile </span><span class='newfile'>$flag$reldestpath</span>&nbsp;";

    switch( $statkey )
    {
      case self::vINSTALLED + self::vPROTECTED:
        $statstring .= sprintf( $this->m_approved2,
                                $this->admtext['created'],
                                $this->admtext['protected'] );
        break;

      case self::vINSTALLED:
        $statstring .= sprintf( $this->m_approved1,
                                $this->admtext['created'] );
        break;

      case self::vVERSION + self::vERROR:
        $statstring .= sprintf( $this->m_error2,
                                $eline,
                                $this->admtext['badversion'] );
        break;

      case self::vDSTFOLDER + self::vMISSING + self::vPROVISIONAL:
        $statstring .= sprintf( $this->m_approved1x2,
                                $this->admtext['nofolder'],
                                $this->admtext['provisional'] );
        break;

      case self::vDSTFOLDER + self::vMISSING + self::vERROR:
        $statstring .= sprintf( $this->m_error2, $eline,
                                $this->admtext['nofolder'] );
        break;

      case self::vNOTINST:
        if( $this->modstatus_header == 'partinst' )
        {
          $template = $this->m_approved1h;
        }
        else
        {
          $template = $this->m_approved1p;
        }
        $statstring .= sprintf( $template,
                                $this->admtext['nocreated'] );
        break;

      default:
        break;
    }

    $this->set_status( $statstring );
    return $i;
  } // _newfile()

  protected function _note( $i )
  {
    /* add note the global $this->note for use in the listing. */
    $datapack = $this->parse_table[$i];
    $this->note = $datapack['arg1'];
    return $i;
  }

  protected function _parameter( $i )
  {
    while(true)
    {
      if( !$this->is_target   )
      {
        $i++; // skip %desc also
        break;
      }

      $datapack = $this->parse_table[$i];
      $directive_name = $datapack['name'];
      $parameter = $datapack['arg1'];
      $value = $datapack['arg2'];
      $line= $datapack['line'];

      $this->parameters++;

      /* Start status string */
      $statstring = "<div class='list-indent'>{$this->admtext['line']} $line: ";

      $paramstr = $this->foldable_string( "$parameter:$value" );

      $statstring .= sprintf( $this->m_approved2, $directive_name, $paramstr );

      $this->set_status( $statstring );
      $i++; // skip 'desc' - nothing is done with it in the listing
      break;
    }
    return $i;
  } //_parameter()

  protected function _private( $i )
  {
    $datapack = $this->parse_table[$i];
    $this->private = $datapack['arg1'];
    $this->isprivate = true;
    return $i;
  }

  /* @ $i points to the %replace datapack in the parse table
  ** @ $statstring contains the status string started in the _location function */
  protected function _replace( $i, $statstring='' )
  {
    /*  %replace directive datapack map = $this->parse_table[$i]
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == replace
    **  $datapack['arg1'] == replacement code for location in target file
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty (not a conditional directive)
    **  $datapack['statkey'] == installation status
    **  $datapack['eline'] == validation error line if any
    */

    /* The status string ($statstring) has been started in the _location()
    ** function.  It will be completed and registered here.
    */

    $datapack = $this->parse_table[$i];
    $name = $datapack['name'];
    $statkey = $datapack['statkey'];
    $eline = $datapack['eline'];

    /* add display messages to the modlister class status string */
    switch( $statkey)
    {
      case self::vCFGCODE + self::vNOCONTENT + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                $name,
                                $this->admtext['nocomps'] );
        break;

      case self::vLOCCODE + self::vNOCONTENT + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                $name,
                                $this->admtext['nocomps'] );
        break;

      case self::vINSTALLED:
        $statstring .= sprintf( $this->m_approved2,
                                $name,
                                $this->admtext['installed'] );
        break;

      case self::vBADTARGET + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                $name,
                                $this->admtext['badtarget'] );
        break;

      case self::vLOCCODE + self::vNOTUNIQUE + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                $name,
                                $this->admtext['notunique'] );
        break;

      case self::vCFGCODE + self::vNOTUNIQUE + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                $name,
                                $this->admtext['notunique'] );
        break;

      case self::vNOTINST:
        if( $this->modstatus_header == 'partinst' )
        {
          $template = $this->m_approved2h;
        }
        else
        {
          $template = $this->m_approved2p;
        }
        $statstring .= sprintf( $template,
                                $name,
                                $this->admtext['notinst'] );
        break;

      case self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                $name,
                                $this->admtext['errors'] );
        break;

      default:
        break;
    }

    /* Register the complete status string for this mod. */
    $this->set_status( $statstring );
    return $i;
  } // _replace()

  protected function _target( $i )
  {
    /*  %target directive map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == target
    **  $datapack['arg1'] == server filepath to target file
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == optional note
    **  $datapack['flag'] == optional flag (@)
    **  $datapack['goto'] == empty
    **  $datapack['statkey'] == insatallation status code
    **  $datapack['eline'] == validation error line number if any
    */

    /* Get %target datapack from parse table and break out
    ** display values.*/
    $datapack = $this->parse_table[$i];
    $line = $datapack['line'];
    $name = $datapack['name'];
    $flag = $datapack['flag'];
    $statkey = $datapack['statkey'];
    $target_path = $datapack['arg1'];
    $note = $datapack['arg3'];
    $eline = $datapack['eline'];

    /* Re-init location # for each new target file */
    $this->target_location_count = 1;

    /* Only a foldable, relative path is needed for screen display. */
    $display_path = $this->foldable_string( str_replace( $this->rootpath, '', $target_path ) );

    /* Maintain affected files list.*/
    $this->affected_files['afchange'][] = $display_path;

    /* Handle optional note if one is associated with this target.*/
    $notestr = '';
    if( !empty( $note ) )
    {
      $notestr = "<div class='target-note'><br />$note</div><br />";
    }

    /* start the status display string for this target file. */
    $statstring = "$notestr<div class='list-indent'>{$this->admtext['line']} $line: <span class='target'><span class='tag'>%$name </span><span class='tgtfile'>$flag$display_path</span></span>&nbsp;";

    switch( $statkey )
    {
      case self::vMISSING + self::vOPTIONAL + self::vBYPASSED:
        $this->is_target = false;
        $statstring .= sprintf( $this->m_approved1x2,
                                $this->admtext['optmissing'],
                                $this->admtext['bypassed'] );
        break;

      case self::vMISSING + self::vOPTIONAL:
        $this->is_target = false;
        $statstring .= sprintf( $this->m_approved1x2,
                                $this->admtext['optmissing'],
                                $this->admtext['willbypass'] );
        break;

      case self::vMISSING + self::vPROVISIONAL + self::vERROR: // mod installed
        $this->is_target = false;
        $statstring .= sprintf( $this->m_error3x2,
                                $eline,
                                $this->admtext['tgtmissing'],
                                $this->admtext['provisional'] );
        break;

      case self::vMISSING + self::vPROVISIONAL: // mod not installed
        $this->is_target = false;
        $statstring .= sprintf( $this->m_approved1x2,
                                $this->admtext['tgtmissing'],
                                $this->admtext['provisional'] );
        break;

      case self::vMISSING + self::vERROR:
        $this->is_target = false;
        $statstring .= sprintf( $this->m_error2,
                                $eline,
                                $this->admtext['tgtmissing'] );
            break;

      case self::vNOWRITE + self::vERROR:
        $this->is_target = false;
        $statstring .= sprintf( $this->m_error2,
                                $eline,
                                $this->admtext['notwrite'] );
        break;

      case self::vNOCONTENT + self::vERROR:
        $this->is_target = false;
        $statstring .= sprintf( $this->m_error2,
                                $eline,
                                $this->admtext['emptyfile'] );
        break;

      case self::vVERIFIED:
        $this->is_target = true;
        $statstring .= sprintf( $this->m_approved1,
                                $this->admtext['verified'] );
        break;

      default:
        break;
    }

    $this->set_status( $statstring );
    return $i;

  } // _target()


  protected function _tngversion( $i )
  {
    return $i;
  }

  protected function _textexists( $i )
  {
    return $i;
  }

  protected function _triminsert( $i, $statstring )
  {
    /*  %triminsert directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == replace
    **  $datapack['arg1'] == code for insertion into target file
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty (not a conditional directive)
    **  $datapack['statkey'] == installation status
    **  $datapack['eline'] == validation error line if any
    */

    /* This funtion is called by _location() and not directly by the
    ** modlister processing loop.
    **
    ** The status string ($statstring) has been started in the _location()
    ** function.  It will be completed and registered here. */

    /* In spite of the directive name, no trimming or modification is done
    ** to the raw code. */

    /* Get %triminsert datapack from the parse table and extract
    ** status display parameters */
    $datapack = $this->parse_table[$i];
    $name = $datapack['name'];
    $statkey = $datapack['statkey'];
    $eline = $datapack['eline'];

    switch( $statkey )
    {
      case self::vCFGCODE + self::vNOCONTENT + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline, $name,
                                $this->admtext['nocomps'] );
        break;

      case self::vINSTALLED:
        $statstring .= sprintf( $this->m_approved2,
                                $name,
                                $this->admtext['installed'] );
        break;

      case self::vBADTARGET + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline, $name,
                                $this->admtext['badtarget'] );
        break;

      case self::vLOCCODE + self::vNOTUNIQUE + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                $name, $this->admtext['notunique'] );
        break;

      case self::vCFGCODE + self::vNOTUNIQUE + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                $name,
                                $this->admtext['notunique'] );
        break;

      case self::vNOTINST:
        if( $this->modstatus_header == 'partinst' )
        {
          $template = $this->m_approved2h;
        }
        else
        {
          $template = $this->m_approved2p;
        }
        $statstring .= sprintf( $template,
                                $name,
                                $this->admtext['notinst'] );
        break;

      case self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline, $name,
                                $this->admtext['errors'] );
        break;

      default:
        break;
    }

    $this->set_status( $statstring );
    return $i;
  } // _triminsert()

  private function _trimreplace( $i, $statstring )
  {
    /*  %trimreplace directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == replace
    **  $datapack['arg1'] == replacement code for location in target file
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty (not a conditional directive)
    **  $datapack['statkey'] == installation status
    **  $datapack['eline'] == validation error line if any
    */

   /* The status string ($statstring) has been started in the _location()
    ** function.  It will be completed and registered here.
    **
    ** This is a Non block operation - straight replacement, one for one.*/

    /* Get %trimreplace datapack from parse table and extract elements
    ** for displaying the directive status.*/
    $datapack = $this->parse_table[$i];
    $name = $datapack['name'];
    $statkey = $datapack['statkey'];
    $eline = $datapack['eline'];

    switch( $statkey )
    {
      case self::vCFGCODE + self::vNOCONTENT + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                $name,
                                $this->admtext['nocomps'] );
        break;
      case self::vVERIFIED:
        $statstring .= sprintf( $this->m_approved2,
                                $name,
                                $this->admtext['verified'] );
        break;
      case self::vINSTALLED:
        $statstring .= sprintf( $this->m_approved2,
                                $name,
                                $this->admtext['installed'] );
        break;
      case self::vBADTARGET + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                $name,
                                $this->admtext['badtarget'] );
        break;
      case self::vLOCCODE +  self::vNOTUNIQUE + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                'location',
                                $this->admtext['notunique'] );
        break;
      case self::vCFGCODE + self::vNOTUNIQUE + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                $name,
                                $this->admtext['notunique'] );
        break;
      case self::vNOTINST:
        if( $this->modstatus_header == 'partinst' )
        {
          $template = $this->m_approved2h;
        }
        else
        {
          $template = $this->m_approved2p;
        }
        $statstring .= sprintf( $template,
                                $name,
                                $this->admtext['notinst'] );
        break;
      case self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                $name,
                                $this->admtext['errors'] );
        break;

      default:
        break;
    }

    $this->set_status( $statstring );
    return $i;
  } // _trimreplace()

  protected function _version( $i )
  {
    /* Parse_table[$i] is the '%version' datapack. This code assigns the
    ** version number to $this->version to make it globally accessible.*/
    $datapack = $this->parse_table[$i];
    $this->version = $datapack['arg1'];
    return $i;
  }

  /* Function only works with variables. Text is ignored. Additional
  ** text/commentary can be added separately using the %insert directive.
  */
  protected function _vinsert( $i, $statstring )
  {
    /*  %vinsert directive datapack map == $this->parse_table[$i]
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == vinsert:before or vinsert:after
    **  $datapack['arg1'] == vinsert code (variable assignments)
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty (not a conditional directive)
    **  $datapack['statkey'] == installation status
    **  $datapack['eline'] == validation error line if any
    */

    /* Get %vinsert datapack from the parse table and extract
    ** values need to display the directive status.*/
    $datapack = $this->parse_table[$i];
    $name = $datapack['name'];
    $statkey = $datapack['statkey'];
    $eline = $datapack['eline'];

    switch( $statkey )
    {
      case self::vCFGCODE + self::vNOTUNIQUE + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                $name,
                                $this->admtext['notunique'] );
        break;

      case self::vINSTALLED:
        $statstring .= sprintf( $this->m_approved2,
                                $name,
                                $this->admtext['installed'] );
        break;

      case self::vPARTINST + self::vERROR:
        $statstring .= sprintf( $this->m_error3,
                                $eline,
                                $name,
                                $this->admtext['partinst'] );
        break;

      case self::vNOTINST:
        if( $this->modstatus_header == 'partinst' )
        {
          $template = $this->m_approved2h;
        }
        else
        {
          $template = $this->m_approved2p;
        }
        $statstring .= sprintf( $template,
                                $name,
                                $this->admtext['notinst'] );
        break;

      default:
        break;
    }

    $this->set_status( $statstring );
    return $i;
  } // _vinsert()

  protected function _wikipage( $i )
  {
    $datapack = $this->parse_table[$i];
    $this->wikipage = $datapack['arg1'];
    return $i;
  }

/**********************************************************************
  SUPPORTING FUNCTIONS
**********************************************************************/
  public function set_configs( $name, $value )
  {
    $this->$name = $value;
    if( $this->$name == $value )
      return true;
    return false;
  }

  protected function close_listing()
  {
    echo "
   </table><!-- mmtable -->
   </div><!-- tableFixedHead -->
</form>
";
  }

  protected function display_modline( $selected_mods )
  {
    static $id = 0;  // mod identifier
    static $ix = 0;  // mod form index
    static $dbx = 0; // modline background switching index

    $status = '';
    $error = '';

    // SET STATUS HEADER - set $this->status header ??
    $this->set_modstatus_header();

    /* use while loop to provide a single point of return */
    while(true)
    {
      /* Bypass filtered mods */
      if( !empty( $selected_mods ) && !in_array( $this->cfgfile, $selected_mods ) ) break;

      if( $this->filter == self::F_INSTALLED ) {
        if( $this->modstatus_header != self::INSTALLED ) break;
      }
      elseif( $this->filter == self::F_READY ) {
        if( $this->modstatus_header != self::OK2INST ) break;
      }
      elseif( $this->filter == self::F_CLEAN ) {
        if( $this->modstatus_header != self::PARTINST ) break;
      }
      elseif( $this->filter == self::F_BADCFG ) {
        if( $this->modstatus_header != self::CANTINST ) break;
      }
      $id++;

      /* Hide status detail for OK to Install and Installed */
      if( $this->modstatus_header == self::OK2INST || $this->modstatus_header == self::INSTALLED )
        $status .= "<div id='hiddenstatus$id' style='display:none;'>" . $this->get_status() . "</div>";
      else
        $status = $this->get_status();

      // SET STYLES PER STATUS TYPE
      if( $this->modstatus_header == self::PARTINST )
      {
        $status = str_replace(
           array( "NINST", "NCOPY", "NCREATE" ),
           array( "hilight", "hilight", "hilight" ),
           $status
        );
      }
      else
      {
        $status = str_replace(
           array( "NINST", "NCOPY", "NCREATE" ),
           array( "none", "none", "none" ),
           $status
        );
      }

      /* Create display string for mod author(s) */
      $author_str = '';
      $count = count( $this->authors );
      if( $count > 1 )
      {
        $author_str = "<strong>Authors</strong>: ";
      }
      elseif( $count == 1 )
      {
        $author_str = "<strong>Author</strong>: ";
      }

      if( !empty( $author_str ) )
      {
        foreach( $this->authors as $author )
        {
           $author_str .= $author.' & ';
        }
        $author_str = rtrim( $author_str, ' &' ) . '<br />';
      }

      /* Construct the complete folding status display */
      $fstatus = $this->format_status( $this->modstatus_header, $error, $status, $author_str,$id );

      $this->affected_files = $this->affected_files_listing( $id, $this->cfgfile, $this->modname );

      $wikilink = '';
      if( !empty( $this->wikipage ) ) {
        $wiki = $this->wikibase.$this->wikipage;

        $wikilink = "
        <div class='center'>
          <a href='$wiki' target='_blank'><img class='center' src='classes/wiki16.png' alt='W' style='position:relative;z-index:0;'></a>
        </div>";
      }

      /* Mod Line row background index for striping - persists accross all mods. */
      $dbx++;


      /****************************************************************
      DISPLAY A LISTING LINE FOR THE MOD
      ****************************************************************/
      /* Add link for scroll to mod starting with entered keyboard letter */
      $fl = substr($this->modname,0,1);
      echo "
    <tr  class='clink_{$fl} modline listhead'>";

      if ($this->filter != self::F_ALL)
      {
        echo "
      <td class='flink mmcell databack roundleft'>
        <div class='mminner mmrightalign checkpad'>
          <input class='sbox' type='checkbox' name='mods[$ix][selected]' value='1' />
          <input type='hidden' name='mods[$ix][file]' value='$this->cfgfile' />
        </div>
      </td>";
      $ix++;
      }

      echo "
      <td id='flinka{$id}' class='flink mmcell databack {$this->borderleft}'>
        <div class='mmcellpad'>
          $id. <strong>";

      if( !empty( $this->show_developer ) )
      {
        $modname = $this->foldable_string( $this->modname );
        $namestr = "<a style='text-decoration:none;' href='admin_modtables.php?modfile=$this->cfgfile' title='{$this->admtext['parsetable']}' >$modname</a>";
      }
      else
      {
        $namestr = $this->foldable_string( $this->modname );
      }

      echo "
          $namestr
          </strong>
        </div>
      </td>

      <td id='flinkb{$id}' class='flink mmcell databack'>
    <!-- only add admtext['show'] to title tooltip if Show Developer is enabled -->
        <div class='mmcellpad' title='$this->cfgfile'>";

      if( !empty( $this->show_developer ) )
      {
        $cfgfile = $this->foldable_string( $this->cfgfile );

        $filestr = "<a style='text-decoration:none;' href='showcfg.php?mod={$this->modspath}/$this->cfgfile'
          target='_blank' title='{$this->admtext['show']} $this->cfgfile'>$cfgfile</a>";
      }
      else
      {
        $filestr = $this->foldable_string( $this->cfgfile );
      }

      $version = $this->foldable_string( $this->version );
      echo "
          $filestr
        </div>
      </td>

      <td id='flinkc{$id}' class='flink mmcell databack center'>
        <div class='mmcellpad'>";
          echo ltrim( $version, "vV" );

      echo "
        </div>
      </td>
      <td class='mmcell databack flink center mmcellpad' >
         $wikilink
      </td>
";

if( $this->modstatus_header == self::INSTALLED ) {}

switch( $this->modstatus_header )
{
  case self::OK2INST:
    $status_class = 'ok2inst';
    break;
  case self::INSTALLED:
    $status_class = 'installed';
    break;
  case self::PARTINST:
    $status_class = 'partinst';
    break;
  case self::CANTINST:
    $status_class = 'cantinst';
    break;
  default:
    $status_classe = '';
}

echo "
      <td class='stcell $status_class'>
         $fstatus
      </td>

      <td class='afcell flink borderright'>
        $this->affected_files
      </td>
    </tr>";

      // Display modline
      break;
    }
    return;
  } // display_modline()

  protected function set_modstatus_header()
  {
    $this->modstatus_header = '';
    // IF PARSE ERROR COMPLAIN AND QUIT
    if( !empty( $this->parse_error ) ) {
      $this->num_errors++;
      $this->description = $this->admtext['cannotinstall'].". ".$this->admtext['needmodupdate'].'.';
      $error = "{$this->admtext['line']} {$this->parse_error['line']}: {$this->parse_error['tag']} <span class='msgerror'>
         {$this->admtext[$this->parse_error['text']]}</span><br />";
      $this->set_status( $error );
      $this->modstatus_header = self::CANTINST;
      $error = '';
    }

    // ANALYZE STATISTICS FOR STATUS (FOUR POSSIBLES)
    else
    {
      // Mod uninstalled - no mkdir errors
      // if the only thing installed is a directory which you may not
      // be able to remove --- show as uninstalled
      if( $this->num_installed == $this->newdirs_installed )
      {
        $this->num_installed = 0;
        $this->newdirs_installed = 0;
      }

      // Partially installed
      if( $this->num_installed > 0 && (
        $this->num_installed < $this->num_required ||
        $this->provisional_errors > 0 ) )
      {
        $this->num_errors += $this->provisional_errors;
        $this->modstatus_header = self::PARTINST;
      }

      // No errors - Installed or OK to Install
      elseif( !$this->num_errors )
      {
        if( $this->num_required > 0 )
        {
          if( $this->num_installed == $this->num_required )
          {
             $this->modstatus_header = self::INSTALLED;
          }
          elseif( $this->num_installed == 0 )
          {
             $this->modstatus_header = self::OK2INST;
          }
        }
      }

      // CAN'T INSTALL - WARNINGS OR ERRORS NOTED
      if( empty( $this->modstatus_header ) )
      {
        $this->modstatus_header = self::CANTINST;
        $filtered = array_filter( $this->affected_files );
        if( empty( $filtered ) && $this->num_required == 0 )
        {

        }
      }
    }
  } // set_modstatus_header()

  protected function init_class_properties()
  {
    $this->status_string = '';
    $this->description = $this->note = $this->private = $this->wikipage = $wikilink = '';
    $this->is_target   = false;

    // statistics
    $this->num_required = 0;
    $this->mods_required = 0;
    $this->copies_required = 0;
    $this->newfiles_required = 0;
    $this->newdirs_required = 0;
    $this->num_installed = 0;
    $this->mods_installed = 0;
    $this->copies_installed = 0;
    $this->newfiles_installed = 0;
    $this->newdirs_installed = 0;
    $this->parameters = 0;
    $this->num_errors = 0;
    $this->provisional_errors = 0;
    $this->init_status();
    $this->target_file_contents = '';
    $this->active_target_file = '';
    $this->is_target = false;
    $this->affected_files = array();
    $this->target_location_count = 0;

    // init data array for affected_files_listing() function
    $this->affected_files = array(
        'afchange'  => array(),
        'afcopy'    => array(),
        'afcopy2'   => array(),
        'afcreate'  => array(),
        'afnewfile' => array()
     );
    $this->warning='';
    $this->modstatus_header = '';
    $this->isprivate = false;

    $this->authors = array();
     return;
  } // init_class_properties()

  private function display_filterbar()
  {
    $lockit = "";

    // SET SELECTED VALUE FROM FILTER DROP DOWN LIST
    $s0 = $s1 = $s2 = $s3 = $s4 = $s5 = '';
    ${'s'.$this->filter} = "selected='selected'";

    // SET FILTER BAR ACTION BUTTONS
    $btnline = $this->setup_filter_line( $this->filter );

    // FILTER LOCK AND BATCH OPERATIONS FILE SELECTOR
    if( $this->filter != self::F_ALL )
    {
      // set lock on by default for this filter
      if( $this->filter == self::F_SELECT )
      {
         $cbchecked = 'checked';
         $_SESSION['filter'] = self::F_SELECT;
      }
      else
      {
        $cbchecked = $this->fbox_checked ? "checked" : "";
      }

      $lockit .= "
           {$this->admtext['stayon']}&nbsp;&nbsp;<input type='checkbox' id='stayon' $cbchecked/>";

        $selectboxes = "
        <button type='button' id='selectAll'>
           {$this->admtext['selectall']}
        </button>
        &nbsp;&nbsp;
        <button type='button' id='clearAll'>
           {$this->admtext['clearall']}
        </button>";
     }
     else
    {
       $selectboxes = '';
    }

    /*******************************************************************
    SHOW THE MOD FILTER BAR
    *******************************************************************/
    // MAKE ENGLISH CHOICES CONSISTENT IN FILTER STATUS DROPDOWN MENU
    $this->admtext['partinst'] = ucfirst( $this->admtext['partinst'] );
    $this->admtext['cantinst'] = ucfirst( $this->admtext['cantinst'] );

    // RETURN NEW FILTER STATUS TO MODHANDLER FOR REDISPLAY IF CHANGED BY USER
    echo "
<form action='admin_modhandler.php' method='post'>
<table id='fbar' class='lightback fbar'>
   <tr>
      <td class='fbar fieldnameback fieldname roundtop'>
        <div class='float-left'>
        &nbsp;{$this->admtext['statusfilter']}:&nbsp;
        <select name='filter' >
          <option value='".self::F_ALL."' $s0>{$this->admtext['all']}</option>
          <option value='".self::F_READY."' $s1>{$this->admtext['ready']}</option>
          <option value='".self::F_INSTALLED."' $s2>{$this->admtext['installed']}</option>
          <option value='".self::F_CLEAN."' $s3>{$this->admtext['partinst']}</option>
          <option value='".self::F_BADCFG."' $s4>{$this->admtext['cantinst']}</option>
          <option value='".self::F_SELECT."' $s5>{$this->admtext['choose']}</option>
        </select>
        <input type='submit' name='newlist' value='{$this->admtext['go']}' />
        &nbsp;&nbsp;$lockit&nbsp;&nbsp;$selectboxes &nbsp;&nbsp; $btnline
         </div>
    </td>
   </tr>
</table>";

  } // display_filterbar()

  private function display_headings()
  {
    // CONFIGURE COLUMN HEADER SORT ICONS
    if( $this->sortby == self::NAMECOL )
    {
      $filesort = "<a href='admin_modhandler.php?sort=".self::FILECOL."'><img src='img/tng_sort_asc.gif'
            width='15' height='8' alt='' title='{$this->admtext['text_sort']}' /></a>";
      $namesort = "<img src='img/tng_sort_desc.gif'
            width='15' height='8' alt='' />";
    }
    else
    {
      $namesort = "<a href='admin_modhandler.php?sort=".self::NAMECOL."'><img src='img/tng_sort_asc.gif'
            width='15' height='8' alt='' title='{$this->admtext['text_sort']}' /></a>";
      $filesort = "<img src='img/tng_sort_desc.gif'
            width='15' eight='8' alt='' />";
    }

    /*******************************************************************
    SHOW MOD LIST HEADINGS
    *******************************************************************/
    // uses bounding table to eliminate jumping during page load
    echo "
<div class='tableFixedHead'>
<table id='modlist' class='mmtable' style='position:relative;'>
  <thead>
   <tr>
";

    // SHOW LEFT-SIDE SELECTION BOX HEADING IF A FILTER IS APPLIED
    if ($this->filter != self::F_ALL)
    {
      echo "
    <th class='fieldnameback fieldname center colselct roundbl'>
      <div class='mminner mmrightalign'>&check;</div>
    </th>";
    }

    // DISPLAY THE MOD LISTING ROW HEADINGS
    echo "
      <th class='fieldnameback fieldname center colmodnm $this->borderbl'>{$this->admtext['modname']}&nbsp;&nbsp;$namesort</th>
      <th class='fieldnameback fieldname center colcfgnm'>{$this->admtext['cfgname']}&nbsp;&nbsp;$filesort</th>
      <th class='fieldnameback fieldname center colversn'>{$this->admtext['version']}</th>
      <th class='fieldnameback fieldname center colwiki'>
         <div class='mminner'>
            {$this->admtext['wiki']}
         </div>
      </th>
      <th class='fieldnameback fieldname center colstatus'>{$this->admtext['status']} v14 $this->modspath</th>
      <th class='fieldnameback fieldname center colaflist' style='z-index:10;'><strong>{$this->admtext['aflist']}</strong></th>
   </tr>
  </thead>
";
  } // display_headings()

  protected function get_modlisting()
  {
    $modlisting = $this->get_modlist_sorted();

    $this->sysmsg = '';

    if( isset( $_SESSION['err_msg'] ) )
    {
      $this->sysmsg = $_SESSION['err_msg'];
      unset( $_SESSION['err_msg'] );
    }

    // DISPLAY BIG SYSTEM MESSAGE IF NO MODFILES ARE FOUND
    if( empty( $this->modspath ) )
    {
      $this->sysmsg = "<span class='msgerror'>\$modspath {$this->admtext['missing']}";
    }
    elseif( empty( $this->extspath ) )
    {
      $this->sysmsg = "<span class='msgerror'>\$extspath {$this->admtext['missing']}";
    }
    elseif( $modlisting == self::NOPATH )
    {
      $this->sysmsg = "{$this->admtext['cannotopendir']}: ".rtrim($this->modspath, "/")."!";
    }
    elseif( $modlisting == self::NOMODS )
    {
      $this->admtext['nomods'] = str_replace( "xxx", "cfg", $this->admtext['nomods'] );
      $this->sysmsg = "{$this->admtext['nomods']} - ".rtrim($this->modspath, "/");
    }
    elseif( $modlisting == self::NOREAD )
    {
      $this->sysmsg = "{$this->admtext['noaccess']} - ".rtrim($this->modspath, "/" );
    }

    if( !empty( $this->sysmsg ) )
    {
      return;
    }

    return $modlisting;
  } // get_modlisting()

 protected function foldable_string( $string )
 {
    return preg_replace('@([\./_])@', '&#8203;$1', $string );
 }

 public function set_modfile( $modfile ) {
    $this->modlist = array( $modfile );
 }

 // SHOW FILTER LINE BUTTONS
 protected function setup_filter_line( $filter )
 {
    $buttons['installall'] = "\r\n<button type='submit' id='btnInstall'
      class='msgapproved' name='submit' value='installall'>{$this->admtext['installall']}</button>";
    $buttons['deleteall'] = "\r\n<button type='submit' id='btnDelete'
      class='msgerror' name='submit' value='deleteall'>{$this->admtext['deleteall']}</button>";;
    $buttons['removeall'] = "\r\n<button type='submit' id='btnRemove'
      class='msgapproved' name='submit' value='removeall'>{$this->admtext['removeall']}</button>";
    $buttons['cleanupall'] = "\r\n<button type='submit' id='btnClean'
      class='msgapproved' name='submit' value='cleanupall'>{$this->admtext['cleanupall']}</button>";
    $buttons['selectall'] = "\r\n<button type='submit' id='btnChoose'
      class='msgapproved' name='submit' value='selectall'>{$this->admtext['choose']}</button>";

    $btnline = "";
    switch( $filter ) {
      case self::F_READY:
        $btnline = $buttons['installall']."\r\n&nbsp;&nbsp;\r\n".$buttons['deleteall'];
        break;
      case self::F_INSTALLED:
        $btnline = $buttons['removeall'];
        break;
      case self::F_CLEAN:
        $btnline = $buttons['cleanupall'];
        if ($this->delete_partial ) {
           $btnline .= "\r\n&nbsp;&nbsp;\r\n".$buttons['deleteall'];
        }
        break;
      case self::F_BADCFG:
        $btnline = $buttons['deleteall'];
        break;
      case self::F_SELECT:
        $btnline = $buttons['selectall'];
        if( $this->delete_partial && $this->delete_installed ) {
           $btnline .= "\r\n&nbsp;&nbsp;\r\n".$buttons['deleteall'];
        }
        //$btnline = $buttons['selectall'];
        break;
      default:
        $btnline = "\r\n&nbsp;&nbsp;{$this->admtext['choosefilter']}";
        break;
    }
    return $btnline;
  }

  protected function set_status( $string, $relsrcpath='' )
  {

    // closes the status line div before inserting the table for the copyfile display
    if (substr($string,0,4)=='<div')
      $string .= '</div>';

      if( !empty( $relsrcpath ) )
      {

        // In the <table> tag, add a left margin to replace the left margin from the parent <div>
        $string .= "
      <table style='margin-left:1em;'>
         <tr>
            <td class='normal fieldnameback fieldname'>
               {$this->admtext['source']}: $relsrcpath
            </td>
         </tr>
      </table>";

      }

      // add <br /> tag to end of $string before finalizing it
      // code that closed the status line div is now above the copyfile source path table
      if (substr($string,0,4)!='<div')
        $string .= '<br />';
      $this->status_string .= $string;
  }

  protected function get_status()
  {
    $retstr = "<br /><br /><div style='padding-bottom:3px;border-bottom:1px solid #000;'><strong><i>flags:<br />@&nbsp;&nbsp;{$this->admtext['optional']}<br />^&nbsp;&nbsp;{$this->admtext['provisional']}<br />~&nbsp;&nbsp;protected<br /></i></strong></div><br style='line-height:6px' />";
    return $retstr.$this->status_string;
  }

  protected function init_status()
  {
    $this->status_string = '';
  }

  protected function format_status( $status_header, $error, $status, $author_str, $id )
  {
    //$this->status_header = $status_header;
    $btn_install = "<button class='msgapproved' type='button' onclick='window.location.href=\"?a=".self::INSTALL."&id=$id&m=$this->cfgfile\"'>{$this->admtext['install']}</button>";

    $confirm = empty( $this->delete_support ) ?
      $this->admtext['confdelmod1'] :
      $this->admtext['confdelmod'];

    // javascript messages must contain a single quote character
    $confirm = str_replace( "'", "\'", $confirm );

    $btn_delete = "<button class='msgerror' type='button' onclick=\"if(confirm('{$confirm}')) {window.location.href='?a=".self::DELETE."&id=$id&m=$this->cfgfile';}\">{$this->admtext['delete']}</button>";

    $btn_remove = "<button class='msgapproved' type='button' onclick='window.location.href=\"?a=".self::REMOVE."&id=$id&m=$this->cfgfile\"'>{$this->admtext['uninstall']}</button>";

    $btn_cleanup = "<button class='msgapproved' type='button' onclick='window.location.href=\"?a=".self::CLEANUP."&id=$id&m=$this->cfgfile\"'>{$this->admtext['cleanup']}</button>";

    $btn_edit = '';
    if( $this->parameters )
    {
       $btn_edit = "<button type='button' onclick='window.location.href=\"admin_modeditor.php?a=".self::EDITP."&id=$id&m=$this->cfgfile\"'>{$this->admtext['edopts']}</button>";
    }

    // SHOW AVAILABLE FUNCTION BUTTONS IN OPENED STATUS AREA
/*
      $btn_list = "<button class='smallbutton' type='button'  name='listlocation$id' onclick=\"jQuery('#hiddenstatus$id').show()\">{$this->admtext['detail']}</button>";
*/
    $btn_list = "<button class='smallbutton' type='button'  name='listlocation$id' onclick=\"if(document.getElementById('hiddenstatus$id').style.display=='none') document.getElementById('hiddenstatus$id').style.display='block'; else document.getElementById('hiddenstatus$id').style.display='none';\">{$this->admtext['detail']}</button>";
    $options_link = '';

    $buttons = '';
    if( $status_header == self::OK2INST )
    {
       $status_header = $this->admtext[$status_header];
       $style = "ready";
       $buttons = "<div>
                $btn_install
                $btn_delete
                $btn_list
             </div>";
    }
    elseif( $status_header == self::CANTINST )
    {
      $status_header = $this->admtext[$status_header];
      $style = "badcfg";
      $buttons = "<div>
              $btn_delete
           </div>";
    }
    elseif( $status_header == self::INSTALLED )
    {
      $status_header = $this->admtext[$status_header];
      if( !empty( $this->parameters ) )
      {
        $status_option = $this->admtext['hasoptions'];
        $status_header .= " [$status_option]";
      }
      $style = "installed";
      $buttons = "<div>
              $btn_remove
              $btn_edit";
      if( $this->delete_installed ) {
        $buttons .=  "
           $btn_delete";
      }
      $buttons .= " $btn_list";
      $buttons .= "</div>";
    }
    elseif( $status_header == self::PARTINST )
    {
      $status_header = $this->admtext[$status_header];
      $style = "partinst";
      $buttons = "<div>
                $btn_cleanup
                $btn_delete
             </div>";
    }

    if( isset($this->isprivate) && $this->isprivate )
    {
      $status_header .= "&nbsp;&nbsp;<span style='font-size:90%;'><strong>{$this->admtext['privatemod']}</strong> $this->private</span>";
    }

    if( !empty( $this->warning ) )
    {
      $status_header .= "&nbsp;&nbsp;<strong><span style='font-size:90%;color:#990000;'><strong>{$this->admtext['noeffect']}</strong></span>";
    }

    if( !empty( $this->note ) )
    {
      $status_header .= "&nbsp;&nbsp;<span style='font-size:90%;width:100%;'> $this->note</span>";
    }

    if( $this->num_required > 0 )
    {
      $summary = "<hr />
      <ul class='results fieldnameback fieldname'>
        <li>{$this->admtext['modsreq']}: $this->mods_required; {$this->admtext['modified']}: $this->mods_installed</li>
        <li>{$this->admtext['copiesreq']}: $this->copies_required; {$this->admtext['copied']}: $this->copies_installed</li>
        <li>{$this->admtext['newfilesreq']}: $this->newfiles_required; {$this->admtext['created']}: $this->newfiles_installed</li>
        <li>{$this->admtext['newdirsreq']}: $this->newdirs_required; {$this->admtext['created']}: $this->newdirs_installed</li>
        <li>{$this->admtext['errors']}: $this->num_errors</li>
      </ul>";
    }
    else
       $summary = '';

    return "
      <div class='$style'>
        <span class='modlink closed' id='link{$id}'>
          $status_header
        </span>
       </div>

       <div class='moddiv $style' id='link{$id}div' style='display:none'>
          $buttons
          <hr />
          $author_str
          $this->description
          $error
          $status
          $summary
       </div>";
  } // format status

  protected function affected_files_listing( $id, $cfgfile, $modname )
  {
    $retstr = "
         <div class='descpop1 nw imgcenter' title=''>

            <img src='img/tng_more.gif' width='16' alt='' />

            <div>
               <table class='mmpopuptable'>
                  <tr>
                     <td class='normal fieldnameback fieldname mmpopuphdr'>
                        $id. <strong>$modname - </strong>$cfgfile
                     </td>
                  </tr>
               </table>";

    $filestr = '';
    $filestr .= $this->format_affrows( $this->affected_files['afchange'], "{$this->admtext['target']}" );
    $filestr .= $this->format_affrows( $this->affected_files['afcreate'], "{$this->admtext['newfile']}" );
    $filestr .= $this->format_affrows( $this->affected_files['afcopy'], "{$this->admtext['copiesfile']}" );
    $filestr .= $this->format_affrows( $this->affected_files['afcopy2'], "{$this->admtext['copiesfile2']}" );

    if( !empty( $filestr ) )
    {
      $retstr .= "
               <table class='whiteback normal cellspace1 mmpad2'>
               $filestr
               </table>";
    }

    $retstr .= "
            </div>
         </div>"; // descpop
    return $retstr;
  } // affected_files_listing()

   // CALLED BY GET AFFECTED FILES FUNCTION
  private function format_affrows( $file_array, $label )
  {
    $retstr = '';
    if( empty( $file_array ) ) return $retstr;
    $retstr .= "
                  <tr>
                     <td class='normal fieldnameback fieldname aligntop nw'>$label</td>
                     <td class='normal databack w100 mmpadleft'>";
    foreach( $file_array as $listing )
    {
      if( $listing == 'files' ) continue;
      $retstr .= "
                        $listing<br />";
    }
    $retstr .= "
                     </td>
                  </tr>";
      return $retstr;
   }
  private function sys_msg( $msg )
  {
    echo "
    <tr>
      <td colspan='6' class='mmsysmsg'>
         $msg
      </td>
    </tr>
    </table>";
  }
} // MODLISTER CLASS

function new_modlister()
{
  global $admtext, $tngconfig;

  require $tngconfig['subroot'].'mmconfig.php';
  require $tngconfig['subroot'].'config.php';

  if( !isset( $admtext['modlist'] ) )
  {
    $textpart = 'mods';
    $mylanguage = $_SESSION['session_language'];
    require 'languages/'.$mylanguage.'/admintext.php';
    $session_charset = $charset;
    require 'languages/'.$mylanguage.'/alltext.php';
  }

  require 'version.php';
  $sitever = getSiteVersion();
  $mhuser = isset( $_SESSION['currentuserdesc'] ) ? $_SESSION['currentuser'] : "";
  $sortby = isset( $_SESSION['sortby'] ) ? $_SESSION['sortby'] : 0;

  $objinits = array (
    'rootpath'     => $rootpath,
    'subroot'      => $tngconfig['subroot'],
    'modspath'     => $modspath,
    'extspath'     => $extspath,
    'options'      => $options,
    'time_offset'  => $time_offset,
    'sitever'      => $sitever,
    'currentuserdesc' => $mhuser,
    'admtext'      => $admtext,
    'tng_version'  => $tng_version,
    'sortby'       => $sortby
  );

  return new modlister( $objinits );
}