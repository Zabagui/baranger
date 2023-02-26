<?php /*//220905 09:38*/
/*
   Mod Manager 12 Mod Remover Class

   Public Methods:
      $this->remove( $cfgpath );
      $this->batch_remove( $cfgpathlist );

*/

/* File management */
$modvalidator_version = '14.0.0.0 220718-1224';

require_once 'classes/modparser.class.php';

class modremover extends modparser
{

  public $classID = "remover";

  protected $locations_found = 0;
  protected $locations_removed = 0;
  protected $copyfiles_found = 0;
  protected $copyfiles_removed = 0;
  protected $copyfiles_protected = 0;
  protected $newfiles_found = 0;
  protected $newfiles_removed = 0;
  protected $newfiles_protected = 0;
  protected $directories_found = 0;
  protected $directories_removed = 0;
  protected $directories_not_empty = 0;
  protected $mod_status = '';


  protected $files_removed = 0;
  protected $num_errors = 0;

  public function __construct( $objinits )
  {
    parent::__construct( $objinits );
  }

  const REMOVED  = 'removed';

  protected $active_target_file = '';
  protected $target_file_contents = '';
  protected $istarget = false;

  public function remove( $cfgpath )
  {
    $this->cfgpath = $cfgpath;
    $this->cfgfile = $cfgfile = pathinfo( $cfgpath, PATHINFO_BASENAME );
    $this->parse_error = array();
    $this->mod_status = '';
    $newdirs = array();

    /* Get the parse table for this mod.*/
    $this->parse( $cfgpath );

    /* Arrange the directives in best order for removal.*/
    $this->arrange_parse_table( $this->parse_table );

    /* Starg logging the removal event.*/
    $this->new_logevent( "{$this->admtext['removing']} <strong>$cfgpath</strong>" );

    if( empty( $this->parse_table ) && empty( $this->parse_error ) )
    {
      $this->mod_status = self::CANTPROC;
      $this->add_logevent( "<span class='msgerror'> E".__LINE__." parse table {$this->admtext['missing']}</span>" );
      $this->write_eventlog( $error=true );
      return false;
    }

    // HANDLE FATAL ERROR
    if( !empty( $this->parse_error ) )
    {
      $this->modname = $cfgfile;
      $this->mod_status = self::ERRORS;
      $idx = $this->parse_error['text'];
      $this->add_logevent("<span class='msgerror'>$cfgfile</span> <span class='hilighterr msgbold'> E".__LINE__." {$this->admtext[$idx]}</span>");
      $this->write_eventlog();
      return false;
    }

    // INITIALIZE STATUS DATA
    $this->init_properties();

    /*************************************************************
      PROCESS PARSE TABLE DIRECTIVES TO INSTALL CURRENT MOD
        Each $this->parse_table[$i] is a single directive datapack.
    *************************************************************/
    for($i=0; isset( $this->parse_table[$i] ); $i++ )
    {
      /* File modifiers are processed by %location and should never show up here.
      ** If file modifiers are found here it is because they did not have an
      ** associated location directive and would not have been installed anyway. */
      if( in_array( $this->parse_table[$i]['name'], $this->file_modifiers ) )
        continue;

      /* PHP allows assignment of a function name to a variable
      ** and then executing the "variaable" with arguments. That lets
      ** us get the function name associated with this directive from
      ** $proclist found in the modparser.class.php.
      */
      $function = $this->proclist[$this->parse_table[$i]['name']];

      /***********************************************************/
      /* Use custom function to set status of this directive.
      ** If a function processes more than one tag it will advance
      ** index $i to skip the table entries already processed.
      */

      $j = $i; /* For debugging */

      /* Dispatcher - send directive datapack for processing */
      $i = $this->$function( $i );

      /* We pass the the $i index to processing functions and
      ** allow them to change it so the processing can skip over
      ** directives specified by conditional testing.
      **
      ** Debug: prevent bad behavior during modremover development;
      ** if the $i index gets unset or reset back to zero by a faulty
      ** function return, it will cause an infinite loop. Kill it.*/
      if(  $i < $j ) {
        echo basename(__FILE__),': ',__LINE__,'<pre>';print_r($this->cfgpath);echo '<br />';
        echo basename(__FILE__),': ',__LINE__,'<pre>';print_r("Index Error - \$i=$i < \$j=$j<br />");
        echo basename(__FILE__),': ',__LINE__,'<br/>';var_dump($this->parse_table[$j]);exit;
      }

    } /* Main modremover processing loop */

    /*************************************************************
      DONE PROCESSING - FLUSH LAST BUFFER BACK TO TARGET FILE
    *************************************************************/
    if( !empty( $this->active_target_file ) && !empty( $this->target_file_contents ) )
    {
      if( false === $this->write_file_buffer( $this->active_target_file,
                                              $this->target_file_contents ) )
      {
        $this->num_errors++;
        $logstring = "<span class='msgerror'> E".__LINE__." {$this->admtext['cantwrite']} %target:</span><span class='tgtfile'>$display_path</span><span class='tag'>%</span>&nbsp;";
        $this->add_logevent( $logstring );
      }
    }

    /*************************************************************
      COMPILE INFORMATION FOR THE MM REMOVAL LOG ENTRY
    *************************************************************/
    if( !$this->num_errors )
    {
      /* If all the stats add up we are removed */
      if( $this->copyfiles_removed == ( $this->copyfiles_found - $this->copyfiles_protected )
          && ( $this->newfiles_removed == ( $this->newfiles_found - $this->newfiles_protected ) )
          && ( $this->locations_removed == $this->locations_found )
          && ( $this->directories_removed == ( $this->directories_found - $this->directories_not_empty ) ) )
      {
        $status = self::MODREM;
        $class = "class='msgapproved'";
      }
      else // they don't add up //
      {
        $status = self::ERRORS;
        $class = "class='msgerror'";
        $this->batch_error = true;
      }
    }
    else
    {
      $status = self::ERRORS;
      $class = "class='msgerror'";
      $this->batch_error = true;
    }

    /* Summarize number of modifications, files, newfiles and directories removed. */
    $this->add_logevent("<span class='msgbold'>{$this->admtext['toterrors']}:</span> $this->num_errors");

    if( !empty( $this->locations_found ) )
    {
      $locations = sprintf( '%d %s &nbsp;&nbsp; %d %s',
                    $this->locations_found,
                    '%location:',
                    $this->locations_removed,
                    $this->admtext['removed'] );
      $this->add_logevent( $locations );
    }

    if( !empty( $this->copyfiles_found ) )
    {
      $copyfiles = sprintf( '%d %s &nbsp;&nbsp; %d %s &nbsp;&nbsp; %d %s',
                    $this->copyfiles_found,
                    '%copyfile:',
                    $this->copyfiles_removed,
                    $this->admtext['removed'],
                    $this->copyfiles_protected,
                    $this->admtext['protected'] );
      $this->add_logevent( $copyfiles );
    }

    if( !empty( $this->newfiles_found ) )
    {
      $newfiles = sprintf( '%d %s &nbsp;&nbsp; %d %s &nbsp;&nbsp; %d %s',
                    $this->newfiles_found,
                    '%newfile:',
                    $this->newfiles_removed,
                    $this->admtext['removed'],
                    $this->newfiles_protected,
                    $this->admtext['protected'] );
      $this->add_logevent( $newfiles );
    }

    if( !empty( $this->directories_found ) )
    {
      $mkdirs = sprintf( '%d %s &nbsp;&nbsp; %d %s &nbsp;&nbsp; %d %s &nbsp;&nbsp; %d %s',
                    $this->directories_found,
                    '%mkdir:',
                    $this->directories_removed,
                    $this->admtext['removed'],
                    $this->directories_protected,
                    $this->admtext['protected'],
                    $this->directories_not_empty,
                    $this->admtext['cantrem'] );
      $this->add_logevent( $mkdirs );
    }

    $this->add_logevent("{$this->admtext['status']}: <span $class>{$this->admtext[$status]}</span>");

    $this->mod_status = $status;
    $this->write_eventlog();

    /* Determines if modhandler opens the Log to view errors -- see mod options. */
    return ( $status == self::MODREM );

  } // remove()

  /*****************************************************************
  DIRECTIVE PROCESSING FUNCTIONS

  The modremover class must contain a private function for each
  mod directive that may appear in the parse table. Functions are
  named the same as the directive, but with a leading underscore.

  The processing loop in modremover dispatches each directive in
  parse table order to its corresponding function below for removal.
  *****************************************************************/
  private function _author( $i )
  {
    return $i;
  }

  private function _copyfile( $i  )
  {
    /*  %copyfile directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == copyfile or copyfile2
    **  $datapack['arg1'] == full server path to source file
    **  $datapack['arg2'] == full server path to destination file
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == flag (if any) optional or protected
    **  $datapack['goto'] == empty (not a conditional directive)
    */

    /* Break out the datapack to simplify processing.*/
    $copyfile_datapack = $this->parse_table[$i];

    $line = $copyfile_datapack['line'];
    $copyfile_op = $copyfile_datapack['name'];
    $flag = $copyfile_datapack['flag'];

    $destination_path = $copyfile_datapack['arg2'];
    $dest_path = str_replace( $this->rootpath, '', $destination_path );

    $logstring = "{$this->admtext['line']} $line: %<span class='tag'>$copyfile_op:</span><span class='tgtfile'>{$flag}$dest_path</span>%&nbsp;";

    while( true )
    {
      if( !file_exists( $destination_path ) )
      {
        $logstring .= "{$this->admtext['notinst']}&nbsp;<span class='msgapproved'>{$this->admtext['bypassed']}</span>";
        break;
      }

      $this->copyfiles_found ++;

      if( $flag == self::FLAG_PROTECTED )
      {
        $logstring .= "<span class='msgapproved'>{$this->admtext['protected']}</span>";
        $this->copyfiles_protected++;
        break;
      }

      if( false === unlink( $destination_path ) )
      {
        if( $flag == self::FLAG_OPTIONAL )
        {
          $logstring .= "<span class='msgapproved'>{$this->admtext['cantremok']}</span>";
          break;

          // failed to delete a copied file
          $this->num_errors++;
          $logstring .= "<span class='hilighterr msgbold'> E".__LINE__." {$this->admtext['cantdel']}</span>";
          break;
        }

     	}

      $this->copyfiles_removed++;
      $logstring .= "<span class='msgapproved'>{$this->admtext['removed']}</span>";
      break;
    } // while(true) processing loop

    $this->add_logevent( $logstring );
    return $i;
  } // _copyfile()

  private function _desc( $i  )
  {
    return $i;
  }

  private function _description( $i  )
  {
    return $i;
  }

  private function _end( $i  )
  {
    return $i;
  }

  private function _fileend( $i  )
  {
    return $i;
  }

  private function _fileexists( $i )
  {
    return $i;
  }

  private function _fileoptional( $i )
  {
    return $i;
  }

  private function _files( $i )
  {
    return $i;
  }

  private function _fileversion( $i )
  {
    return $i;
  }

  private function _goto( $i )
  {
    return $i;
  }

  /* Remove inserted code/text */
  private function _insert( $location_datapack, $insert_datapack, $logstring )
  {
    /*  %insert directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == insert:before or insert:after
    **  $datapack['arg1'] == text to be inserted into the target file
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty (not a conditional directive)
    */

    /*
    ** The log string ($logstring) has been started in the _location()
    ** function.  It will be completed and registered here.
    */

    $return_flag = true;

    /* insert:before, insert:after */
    $insert_op = $insert_datapack['name'];

    /* Trim spaces and tabs from each end of the
    ** Location snippet block to avoid unnecessary 'bad target' errors.
    */
    $location_block = trim( $location_datapack['arg1'], " \t" );

    $insertion_block = $insert_datapack['arg1'];

    $insertion_block = $insert_op == 'insert:before'
      ? $insertion_block."\r\n"  : "\r\n".$insertion_block;

    $logstring .= "(%$insert_op%)&nbsp;";

    /*
    ** Modlister has already analyzed the mod file.  The mod is installed
    ** and there is no non-unique codes, so we'll trust that and just
    ** uninstall the mod without testing those things again.
    */

    if( false !== $p = strpos( $this->target_file_contents, $insertion_block ) )
    {
      $this->locations_found++;
      $len = strlen( $insertion_block);
      $this->target_file_contents = substr_replace( $this->target_file_contents,'', $p, $len );

      if( false === strpos( $this->target_file_contents, $insertion_block ) )
      {
        $this->locations_removed++;
        $logstring .= "<span class='msgapproved'>{$this->admtext['removed']}</span>";
      }
      else
      {
        /* Suspect garbage duplicate entries in target file.  Cleaning the mod a
        ** second time might fix the problem.
        */
        $logstring .= "<span class='msgerror'> E".__LINE__." {$this->admtext['cantrem']}</span>";
        $this->num_errors++;
        $return_flag = false;
      }
    }
    else
    {
      /* Mod insertion not found - already removed. This might be the case for 
      ** conditional directives or when cleaning up a partially installed mod.
      */
      $logstring .= "<span class='msgapproved'>{$this->admtext['alreadyrem']}</span>";
    }

    $this->add_logevent( $logstring );
    return $return_flag;
  } // _insert()

  private function _label( $i )
  {
    return $i;
  }

  private function _location( $i )
  {
    /*  %location directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == insert:before or insert:after
    **  $datapack['arg1'] == code to be inserted into the target file
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == optional note
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty (not a conditional directive)

    /* Target file must be open to operate on it.*/
    if( !$this->istarget )
    {
      /* Skip over both location and editing directives */
      return $i+1;
    }

    /* Break out the location directive datapack from the parse table.*/
    $location_datapack = $this->parse_table[$i];
    $line = $location_datapack['line'];
    $flag = $location_datapack['flag'];

    /* A file editing directive always follows %location in the parse table.*/
    $i++;
    $modifier_datapack = $this->parse_table[$i];
    $modifier_op = $modifier_datapack['name'];

    while( true )
    {
      $logstring = "{$this->admtext['line']} $line: <span class='tag'>%location:%</span>&nbsp;";

      /* Dispatch modifier directive for processing */
      $function = $this->proclist[$modifier_op];

      $this->$function( $location_datapack, $modifier_datapack, $logstring );
      break;

    } // while(true) processing loop

    return $i;
  } // _location

  private function _mkdir( $i )
  {
    /*  %mkdir directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == mkdir
    **  $datapack['arg1'] == directory (folderpath) to be created
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == if any, optinal @
    **  $datapack['goto'] == empty (not a conditional directive)
    */

    /* Because we rearranged the parse table, any copyfiles and newfiles will
    ** have already been removed from this directory, so remove the directory if empty.
    */

    $mkdir_datapack = $this->parse_table[$i];

    $line = $mkdir_datapack['line'];

    $mkdir_directory = $mkdir_datapack['arg1'];

    if( file_exists( $mkdir_directory ) )
    {
      $this->directories_found++;
    }

    /* Use short display path for log */
    $display_path = str_replace( $this->rootpath, '', $mkdir_directory );

    $logstring = "{$this->admtext['line']} $line: %<span class='tag'>mkdir:</span><span class='tgtfile'>$display_path</span>%&nbsp;";

    /* Attempt to remove the directory */
    if( false !== rmdir( $mkdir_directory ) ) {
      $this->directories_removed++;
      $logstring .= "<span class='msgapproved'>{$this->admtext['removed']}</span>";
    }
    else {
      $this->directories_not_empty++;
      $logstring .= "<span class='msgapproved'>{$this->admtext['cantrem']}</span>";
    }

    $this->add_logevent( $logstring );
    return $i;
  }

  private function _name( $i )
  {
echo basename(__FILE__),': ',__LINE__,'<br/>';var_dump($this->parse_table[$i]);exit;
    return $i;
  }

  private function _newfile( $i )
  {
    /*  %newfile directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == newfile
    **  $datapack['arg1'] == filepath for new file
    **  $datapack['arg2'] == content of new file
    **  $datapack['arg3'] == version number of new file
    **  $datapack['flag'] == flag if any
    **  $datapack['goto'] == empty
    */

    /* Only current table entry needed so simplify code */
    $newfile_datapack = $this->parse_table[$i];

    $line = $newfile_datapack['line'];
    $flag = $newfile_datapack['flag'];

    /* Full server file path.*/
    $new_filepath = $newfile_datapack['arg1'];

    /* Short version of file name for display.*/
    $new_file = str_replace( $this->rootpath, '', $new_filepath );

    $logstring = "{$this->admtext['line']} $line: <span class='tag'>%newfile:</span><span class='tgtfile'>$flag$new_file</span><span class='tag'>%</span>&nbsp;";

    while( true )
    {
      if( !file_exists( $new_filepath ) )
      {
        /* Not installed */
        $logstring .= "<span class='msgapproved'>{$this->admtext['alreadyrem']}</span>";
        break;
      }

      $this->newfiles_found++;

      if( $flag == self::FLAG_PROTECTED )
      {
        $this->newfiles_protected++;
        $logstring .= "<span class='msgapproved'>{$this->admtext['protected']}</span>";
        break;
      }

      if( false === unlink( $new_filepath ) )
      {
        $this->num_errors++;
        $logstring .= "<span class='hilighterr msgbold'> E".__LINE__." {$this->admtext['cantdel']}</span>";
        break;
      }

      $this->newfiles_removed++;
      $logstring .= "<span class='msgapproved'>{$this->admtext['removed']}</span>";
      break;
    } // while(true)

    $this->add_logevent( $logstring );
    return $i;
  } // _newfile()

  private function _note( $i )
  {
    return $i;
  }

  private function _parameter( $i )
  {
    return $i;
  }

  private function _private( $i )
  {
    return $i;
  }

  private function _replace( $location_datapack, $replace_datapack, $logstring )
  {
    /*  %replace directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == replace
    **  $datapack['arg1'] == replacement text for location in target file
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty (not a conditional directive)
    */

    $return_flag = true;

    /* Function is called by _location(), not by the main program.
    **
    ** The log string ($logstring) has been started in the _location()
    ** function.  It will be completed and registered here.
    */

    /* Trim spaces and tabs from each end of the
    ** Location text block to avoid 'bad target' errors. Whatever white space
    ** leads or trails the location text will remian in the file.
    */
    $location_block = $location_datapack['arg1'];

    $replace_block = $replace_datapack['arg1'];

    $logstring .= "(%replace:)&nbsp;";

    /* If replacement text is found, replace it with the original location text. */
    while( true )
    {
      /* Find the replacement code and remove it */
      if( false !== strpos( $this->target_file_contents, $replace_block ) )
      {
        $this->locations_found++;
        $this->target_file_contents = str_replace( $replace_block, $location_block, $this->target_file_contents, $count );

        if( $count == 1 )
        {
          $this->locations_removed++;
          $logstring .= "<span class='msgapproved'>{$this->admtext['removed']}</span>";
          break;
        }

        $this->num_errors++;
        $logstring .= "<span class='msgerror'> E".__LINE__." {$this->admtext['errors']}</span>";
        $return_flag = false;
        break;
      }

      $logstring .= "<span class='msgapproved'>{$this->admtext['alreadyrem']}</span>";
      break;
    } // while(true) processing

    $this->add_logevent( $logstring );
    return $return_flag;
  } // _replace()

  private function _target( $i )
  {
    /*  %target directive map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == target
    **  $datapack['arg1'] == server filepath to target file
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == optional note
    **  $datapack['flag'] == optional flag (@)
    **  $datapack['goto'] == empty
    */

    /* Break out target directive datapack */
    $target_datapack = $this->parse_table[$i];

    $line = $target_datapack['line'];
    $flag = $target_datapack['flag'];
    $target_filepath = $target_datapack['arg1'];

    /* Remove rootpath portion of target file path for log display.*/
    $display_path = $flag . str_replace( $this->rootpath, '', $target_filepath );

    /* Target directive processing loop - gets target file content into string buffer. */
    while(true)
    {
      /* If previous target file open, save file contents before opening a new one.*/
      if( !empty( $this->active_target_file ) && !empty( $this->target_file_contents ) )
      {
        if( false === $this->write_file_buffer( $this->active_target_file, $this->target_file_contents ) )
        {
          $this->num_errors++;
          $logstring = "<span class='msgerror'> E".__LINE__." {$this->admtext['cantwrite']} %target:</span><span class='tgtfile'>$display_path</span><span class='tag'>%</span>&nbsp;";
          break;
        }
        else
        {
          unset( $this->target_file_contents );
        }
      }

      $logstring = "{$this->admtext['line']} $line: <span class='tag'>%target:</span><span class='tgtfile'>$display_path</span><span class='tag'>%</span>&nbsp;";

      /* init variables for new target file and contents.*/
      $this->target_file_contents = null;
      $this->active_target_file = '';
      $this->istarget = false;

      /* Read target file contents into a processing buffer.*/
      $this->target_file_contents = $this->read_file_buffer( $target_filepath, $flag );

      /* Check status code from file read operation */
      if( is_numeric( $this->target_file_contents ) )
      {
        $code = $this->target_file_contents;
        $this->target_file_contents = '';

        if( $code == self::BYPASS )
        {
          $logstring .= "{$this->admtext['optmissing']}&nbsp;<span class='msgapproved'>{$this->admtext['bypassed']}</span>";
          break;
        }
        elseif( $code == self::NOFOUL )
        {
          $logstring .= "<span class='msgapproved'>{$this->admtext['pronotfound']}</span>";
          break;
        }
        elseif( $code == self::NOFILE )
        {
          $this->num_errors--;
          $logstring .= "<span class='msgapproved'>{$this->admtext['tgtmissing']}</span>";
          break;
        }
        elseif( $code == self::NOWRITE )
        {
          $this->num_errors--;
          $logstring .= "<span class='msgapproved'>{$this->admtext['notwrite']}</span>";
          break;
        }
        elseif( $code == self::ISEMPTY )
        {
          $this->num_errors--;
          $logstring .= "<span class='msgapproved'>{$this->admtext['emptyfile']}</span>";
          break;
        }
        else
        {
          $this->num_errors--;
          $logstring .= "<span class='msgapproved'>{$this->admtext['errors']}</span>";
          break;
        }
      }
      else
      {
        $this->istarget = true;
        $this->active_target_file = $target_filepath;
        $logstring .= "{$this->admtext['opened']}";
      }
      break;
    } // while(true) processing loop

    $this->add_logevent( $logstring );
    return $i;
  }

  private function _tngversion( $i )
  {
    return $i;
  }

  private function _textexists( $i )
  {
    return $i;
  }

  private function _triminsert( $location_datapack, $triminsert_datapack, $logstring )
  {
    /*  %triminsert directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == trimreplace:before or triminsert:after
    **  $datapack['arg1'] == text for insertion into target file
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty (not a conditional directive)
    */

    $return_flag = true;

    /* Function is called by _location(), not by the main program.
    **
    ** The log string ($logstring) has been started in the _location()
    ** function.  It will be completed and registered here.
    */

    $location_snip = $location_datapack['arg1'];

    $triminsert_op = $triminsert_datapack['name']; // triminsert:before or triminsert:after
    $triminsert_snip = $triminsert_datapack['arg1'];

    $logstring .= "(%$triminsert_op:)&nbsp;";

    if( $triminsert_op == 'triminsert:after')
    {
      $composite_text = $location_snip.$triminsert_snip;
    }
    elseif( $triminsert_op == 'triminsert:before')
    {
      $composite_text = $triminsert_snip.$location_snip;
    }

    /* If composite replacement text is found, replace it with the original
    ** location text. */
    while( true )
    {

      /* Find location of the triminsert text.*/
      if( false !== $p = strpos( $this->target_file_contents, $composite_text ) )
      {
        $this->locations_found++;
        $this->target_file_contents = str_replace( $composite_text, $location_snip, $this->target_file_contents, $count );

        if( $count == 1 )
        {
          $this->locations_removed++;
          $logstring .= "<span class='msgapproved'>{$this->admtext['removed']}</span>";
          break;
        }

        $this->num_errors++;
        $logstring .= "<span class='msgerror'> E".__LINE__." {$this->admtext['cantrem']}</span>";
        $return_flag = false;
        break;
      }

      $logstring .= "<span class='msgapproved'>{$this->admtext['alreadyrem']}</span>";
      break;
    } // while(true) processing loop

    $this->add_logevent( $logstring );
    return $return_flag;
  } // _triminsert()

  private function _trimreplace( $location_datapack, $trimreplace_datapack, $logstring )
  {
    /*  %trimreplace directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == trimreplace
    **  $datapack['arg1'] == replacement text for location in target file
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty (not a conditional directive)
    */

    $return_flag = true;

    /* Function is called by _location(), not by the main program.
    **
    ** The log string ($logstring) has been started in the _location()
    ** function.  It will be completed and registered here.
    */

    /* Use location code and replacement exactly as given in mod config file.
    ** Trimreplace is not a block operations.
    */
    $location_snip = $location_datapack['arg1'];

    $trimreplace_snip = $trimreplace_datapack['arg1'];

    $logstring .= "(%trimreplace:)&nbsp;";


    /* If replacement text is found, replace it with the original location text. */
    while( true )
    {
      if( false !== strpos( $this->target_file_contents, $trimreplace_snip ) )
      {
        $this->locations_found++;
        $this->target_file_contents = str_replace( $trimreplace_snip, $location_snip, $this->target_file_contents, $count );

        if( $count == 1 )
        {
          $this->locations_removed++;
          $logstring .= "<span class='msgapproved'>{$this->admtext['removed']}</span>";
          break;
        }

        $this->num_errors++;
        $logstring .= "<span class='msgerror'> E".__LINE__." {$this->admtext['cantrem']}</span>";
        $return_flag = false;
        break;
      }

      $logstring .= "<span class='msgapproved'>{$this->admtext['alreadyrem']}</span>";
      break;
    } // while(true) processing loop

    $this->add_logevent( $logstring );
    return $return_flag;
  } // _trimreplace()

  private function _version( $i )
  {
    return $i;
  }

  private function _vinsert( $location_datapack, $vinsert_datapack, $logstring )
  {
    /*  %vinsert directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == vinsert:before or vinsert:after
    **  $datapack['arg1'] == text to be inserted into the target file
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty (not a conditional directive)
    */

    /*
    ** The log string ($logstring) has been started in the _location()
    ** function.  It will be completed and registered here.
    */

    $return_flag = true;

    /* Trim spaces and tabs from each end of the
    ** Location snippet block to avoid unnecessary 'bad target' errors.
    */
    $location_block = trim( $location_datapack['arg1'], " \t" );

    /* vinsert:before, vinsert:after */
    $vinsert_op = $vinsert_datapack['name'];

    $vinsert_block = $vinsert_datapack['arg1'];

    $vinsert_block = $vinsert_op == 'vinsert:before'
      ? $vinsert_block."\r\n"  : "\r\n".$vinsert_block;

    $logstring .= "(%$vinsert_op%)&nbsp;";

    /* Start by replacing variable values with originals in vinsert snippet. */
    preg_match_all( "#(\\$\w+\s*=\s*)[^;]+;#", $vinsert_block, $matches, PREG_SET_ORDER );
    $vars = $matches;

    foreach( $vars as $var )
    {
      $this->target_file_contents = preg_replace( "#\\".$var[1]."[^;]+;#m", $var[0], $this->target_file_contents, 1 );
    }

    /* Remove the original vinsert vars and values. */
    if( false !== $p = strpos( $this->target_file_contents, $vinsert_block ) )
    {
      $this->locations_found++;

      // remove $nippet
      $this->target_file_contents = str_replace( $vinsert_block, '', $this->target_file_contents, $count );

      /* Test success */
      if( $count == 1 )
      {
        $this->locations_removed++;
        $logstring .= "<span class='msgapproved'>{$this->admtext['modsrem']}</span>";
        $this->add_logevent( $logstring );
      }
      elseif( $count == 0 )
      {
      // unable to remove vinserted
        $this->num_errors++;
        $logstring .=  "<span class='msgerror'> E".__LINE__." {$this->admtext['cantdel']}</span>";
        $this->add_logevent( $logstrint );
        $return_flag = false;
      }
      else /* Something bad happened ... */
      {
        $this->num_errors++;
        $logstring .=  "<span class='msgerror'> E".__LINE__." {$this->admtext['cantdel']}</span>";
        $this->add_logevent( $logstrint );
        $return_flag = false;
      }
    }
    else
    {
      $this->locations_removed++;
      $logstring .= "<span class='msgapproved'>{$this->admtext['alreadyrem']}</span>";
      $this->add_logevent( $logstrint );
    }

    return $return_flag;
  } // _vinsert()

  private function _wikipage( $i )
  {
    return $i;
  }

/*************************************************************************
  SUPPORTING FUNCTIONS
*************************************************************************/
  private function init_properties()
  {
    $this->locations_found = 0;
    $this->locations_removed = 0;
    $this->copyfiles_found = 0;
    $this->copyfiles_removed = 0;
    $this->copyfiles_protected = 0;
    $this->newfiles_found = 0;
    $this->newfiles_removed = 0;
    $this->newfiles_protected = 0;
    $this->directories_found = 0;
    $this->directories_removed = 0;
    $this->directories_not_empty = 0;
    $this->num_errors = 0;
  }

  /* Order directives directives in the parse table to suit removal.
  ** For example, uncopy files to a mkdir folder before unmaking it.
  */
  private function arrange_parse_table( )
  {
    $mkdirs = array();
    $copyfiles = array();
    $others = array();

    // make new directories available for file copies
    for( $i=0; isset($this->parse_table[$i]); $i++ )
    {
      /* Info directives stay at the top of the table.
      ** When installing a mod mkdir comes before any file copies to it.
      ** When removing a mod we place the mkdir directives at the end of the table
      ** so that any files copied to them can be removed first -- (PHP rmdir cannot
      ** delete a directory with content.)
      */
      /* Keep info directives at beginning of table */

      switch( $this->parse_table[$i]['name'] )
      {
        /* Remove directives that won't need to be uninstalled */
        case 'name':
        case 'version':
        case 'description':
        case 'note':
        case 'private':
        case 'author':
        case 'wikipage':
          break;

        /* Collect the mkdir directives */
        case 'mkdir':
          $mkdirs[] = $this->parse_table[$i];
          break;

        /* Collect file copy and newfile directives */
          case 'copyfile':
          case 'copyfile2':
          case 'newfile':
            $copyfiles[] = $this->parse_table[$i];
            break;
        default:
            /* Collect all other directives in order found */
            $others[] = $this->parse_table[$i];
          break;
      }
    }

    /* Rebuild the parse table */
    $this->parse_table = array();
    foreach( $copyfiles as $copyfile )
      $this->parse_table[] = $copyfile;

    foreach( $mkdirs as $mkdir)
      $this->parse_table[] = $mkdir;

    foreach( $others as $other)
      $this->parse_table[] = $other;

    return $this->parse_table;
  } // arrange_parse_table()

  public function batch_remove( $cfgpathlist ) {
    $this->batch_error = false;
    foreach( $cfgpathlist as $cfgpath ) {
       if( !$this->remove( $cfgpath ) ) {
          $this->batch_error = true;
       };
    }
    return !$this->batch_error;
  }
} // class modremover

function new_modremover()
{
  global $admtext, $tngconfig;

  require $tngconfig['subroot'].'mmconfig.php';
  require $tngconfig['subroot'].'config.php';

  if( !isset( $admtext['modlist'] ) )
  {
    $textpart = 'mods';
    $mylanguage = $_SESSION['session_language'];
    require 'languages/'.$mylanguage.'/admintext.php';
    /* Force reload cust_text.php */
    require 'languages/'.$mylanguage.'/alltext.php';
  }
  require 'version.php';
  $sitever = getSiteVersion();
  $mhuser = isset( $_SESSION['currentuserdesc'] ) ? $_SESSION['currentuser'] : "";

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
    'tng_version'  => $tng_version
  );

  return new modremover( $objinits );
}