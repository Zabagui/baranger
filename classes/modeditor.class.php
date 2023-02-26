<?php /*//220926 18:52*/
/* Mod Manager 14 Editor for mod parameters

   Public Methods:
      $this->show_editor( $cfgpath );
      $this->update_parameter( $param = array() );
      $this->restore_parameter( $param = array() );

   Only the value of the first occurrence of a variable is now edited in each
   file. This applies to both target files and mod configuration file. Parameter
   names in mod configuration files must be unique.
*/

require_once 'classes/modparser.class.php';

class modeditor extends modparser {

protected $classID = 'editor';

  function __construct( $objinits ) {
    parent::__construct( $objinits );
  }

  protected $cfg_file_contents = '';
  protected $is_target = false;

  protected $active_target_file = '';
  protected $target_file = '';
  protected $mod_status = '';
  protected $target_file_contents = '';

  public function show_editor( $cfgpath )
  {
    $this->mod_status = '';

    /* Get a parse table for this mod. */
    $this->parse( $cfgpath );

    /* Handle fatal parse error. */
    if( !empty( $this->parse_error ) )
    {
      $this->modname = $cfgfile;
      $this->mod_status = self::ERRORS;
      $idx = $this->parse_error['text'];
      $this->add_logevent("<span class=\"msgerror\">$cfgfile</span> <span class=\"hilighterr msgbold\"> E".__LINE__." {$this->admtext[$idx]}</span>");
      $this->write_eventlog();
     return false;
    }

    /* Remove everything but target, parameter and desc directives. */
    $this->parse_table = $this->clean_parse_table( $this->parse_table);

    /* Get the mod config file name from the file path. */
    $cfgfile = pathinfo( $cfgpath, PATHINFO_BASENAME );

    /* log the mod parameter change. */
    $this->new_logevent( "{$this->admtext['editing']} <strong>$cfgpath</strong>" );

    if( !$this->open_mod_file( $cfgpath, $readonly=true) )
    {
      // Display error and exit
    }

    $params_table = array();

    /* Process parse_table. */
    for( $i=0; isset( $this->parse_table[$i] ); $i++ )
    {
      if( $this->parse_table[$i]['name'] == 'target' )
      {
        if( !$this->open_target_file( $this->parse_table[$i], $readonly=true ) )
        {
          continue;
        }
      }
      elseif( $this->parse_table[$i]['name'] == 'parameter' )
      {
        if( $this->is_target )
        {
          $parameter_datapack = $this->parse_table[$i];
          $i++;
          $desc_datapack = $this->parse_table[$i];
          $param = $this->combine_packs( $parameter_datapack, $desc_datapack );
          $params_table[] = $param;
        }
        else
        {
          continue;
        }
      }
    } // FOR processing loop

    $this->display_edit_panels( $params_table );
    return true;
  } // show_editor()

  public function update_parameter( $param )
  {
    /*  parameter-desc datapack map
    **  $param['val'] == current value of parameter in target file
    **  $param['mod'] == name of mod
    **  $param['version'] mod version
    **  $param['def'] == default value of paramete
    **  $param['tgt'] == target file path
    **  $param['cfg'] == mod file path
    **  $param['param'] == variable parameter
    **  $param['quot'] == quotes: 0 - none, 1 - single ('), 2 - double (")
    **  $param['label'] == description detail from %desc directive
    */

    while( empty($param['quot']))
    {
      if( is_numeric($param['val']) && is_numeric($param['def'])) {
        break;
      }

      /* Accommodate booleans true and false */
      $val = strtolower($param['val']);
      $def = strtolower($param['def']);

      if($def == 'true' || $def =='false')
        if($val =='true' || $val == 'false')
          break;

      if( $param['def'] != '' ) {
        $param['val'] = $param['def'];
        break;
      }
      return true;
    }

    $this->modname = $param['mod'];
    $this->version = $param['version'];

    $this->new_logevent( "{$this->admtext['updparam']} {$param['param']}: <span class=\"msgbold\">{$param['tgt']}</span> {$this->admtext['formodname']} <span class=\"msgbold\">{$param['mod']}</span>"  );

    $this->cfgpath = $param['cfg'];
    $this->cfgfile = pathinfo( $param['cfg'], PATHINFO_BASENAME );

    if( !is_writable( $param['cfg'] ) )
    {
      $this->mod_status = self::ERRORS;
      $this->add_logevent( "<span class=\"msgerror\"> E".__LINE__." {$this->admtext['cantupd']}</span> <span class=\"hilighterr msgbold\">{$param['cfg']} %parameter:% {$param['param']}</span>" );
      $this->add_logevent( "{$this->admtext['fileperms']} ({$param['cfg']})" );
      $this->write_eventlog();
      header( "Location: admin_showmodslog.php" );
      exit;
    }

    if( !is_writable( $param['tgt'] ) ) {
      $this->mod_status = self::ERRORS;
      $this->add_logevent( "<span class=\"msgerror\"> E".__LINE__." {$this->admtext['cantupd']}</span> <span class=\"hilighterr msgbold\">{$param['tgt']} %parameter:% {$param['param']}</span>" );
      $this->add_logevent( "{$this->admtext['fileperms']} ({$param['tgt']})" );
      $this->write_eventlog();
      header( "Location: admin_showmodslog.php" );
      exit;
    }
    $success = 0;
    /*******************************************************************
    UPDATE TARGET FILE WITH NEW PARAMETER VALUE
    *******************************************************************/
    /* Read target file into buffer to update parameter value. */
    $target_file_contents = $this->read_file_buffer( $param['tgt'] );

    // prepare original quoting around variable value
    $quotes = '';
    if( $param['quot'] == 1 ) $quotes = "'";
    elseif( $param['quot'] == 2 ) $quotes = '"';

    // replacing a numerical variable with nothing is FATAL ERROR
    // prevent it by replacing the 'nothing' with zero (0)
    if( $param['val'] !== 0 )
    {
      if( empty($quotes) && empty($param['val']) ) {
        $param['val'] = 0;
      }
    }

    // remove any surrounding single or double quotes from new parameter value
    $varval = trim( $param['val'], "\"'" );

    //escape internal single quotes
    $varval = str_replace( "'", "\\'", $varval );

    // add original quoting
    $varval = $quotes.$varval.$quotes;

    $varname = preg_quote( $param['param'] );

    $reg_exp = "#(".$varname."\\s*=\\s*)([^;]*)#";
    if( !preg_match( $reg_exp, $target_file_contents, $matches ) )
    {
      $this->add_logevent( "<span class=\"msgerror\"> E".__LINE__." {$this->admtext['cantupd']}</span> <span class=\"hilighterr msgbold\">{$param['tgt']} %parameter:% {$param['param']}</span>" );
      $this->mod_status = self::CANTUPD;
    }
    else
    {
      $success++;
      $this->add_logevent( "<span class=\"msgapproved\">{$param['param']} {$this->admtext['updated']}</span> ($varval)" );
      $this->mod_status = self::UPDATED;
    }

    /* Update the first occurance in the target file. */
    $targetstr = $matches[0];
    $updatestr = $matches[1] . $varval;
    $pos = strpos($target_file_contents, $targetstr);

    if( $pos !== false )
    {
      $target_file_contents = substr_replace($target_file_contents, $updatestr, $pos, strlen($targetstr) );
    }

    /* Save updated parameter to target file. */
    $this->write_file_buffer( $param['tgt'], $target_file_contents );
    unset( $target_file_contents );

    /*******************************************************************
    UPDATE MOD CONFIG FILE WITH NEW PARAMETER VALUE
    *******************************************************************/
    /* Read mod config file into buffer to update parameter. */
    $config_file_contents = $this->read_file_buffer( $param['cfg'] );

    /* If mod config file has inserted $var=val into target file, update mod config
    ** value to prevent bad target errors. */
    $config_file_contents = str_replace( $targetstr, $updatestr, $config_file_contents );

    // update the %parameter line val for backward compatibility
    $regex = '#%parameter:'.$varname.':\\s*[^%]*%#';
    $parval = trim( $param['val'], "\"'" );
    $replacement = "%parameter:".$param['param'].":".$parval."%";

    /* This will replace all occurrences, so it is important that the same $var name
    ** not be used for more than one parameter in the mod config file.
    */
    $config_file_contents = preg_replace( $regex, $replacement, $config_file_contents );

    /* Save updated parameter to the mod config file. */
    $this->write_file_buffer( $param['cfg'], $config_file_contents );

    $this->write_eventlog();

    return $success;
  } // update_parameter()

  public function restore_parameter( $param )
  {
    /*  parameter-desc datapack map
    **  $param['val'] == current value of parameter in target file
    **  $param['mod'] == name of mod
    **  $param['version'] mod version
    **  $param['def'] == default value of paramete
    **  $param['tgt'] == target file path
    **  $param['cfg'] == mod file path
    **  $param['param'] == variable parameter
    **  $param['quot'] == quotes: 0 - none, 1 - single ('), 2 - double (")
    **  $param['label'] == description detail from %desc directive
    */

    while( empty($param['quot']))
    {
      if( is_numeric($param['val']) && is_numeric($param['def']))
      {
        break;
      }
      $val = strtolower($param['val']);
      $def = strtolower($param['def']);

      if($def == 'true' || $def =='false')
        if($val =='true' || $val == 'false')
          break;

      if( $param['def'] != '' ) {
        $param['val'] = $param['def'];
        break;
      }
      return true;
    }

    $this->mod_status = self::ERRORS;
    $this->modname = $param['mod'];
    $this->version = $param['version'];

    $this->new_logevent( "{$this->admtext['restparam']} {$param['param']}: <span class=\"msgbold\">{$param['tgt']}</span> {$this->admtext['formodname']} <span class=\"msgbold\">{$param['mod']}</span>"  );

    $this->cfgpath = $param['cfg'];
    $this->cfgfile = pathinfo( $param['cfg'], PATHINFO_BASENAME );

    if( !is_writable( $param['cfg'] ) )
    {
      $this->add_logevent( "<span class=\"msgerror\"> E".__LINE__." {$this->admtext['cantupd']}</span> <span class=\"hilighterr msgbold\">{$param['cfg']} %parameter:% {$param['param']}</span>" );
      $this->add_logevent( "{$this->admtext['fileperms']} ({$param['cfg']})" );
      $this->write_eventlog();
      header( "Location: admin_showmodslog.php" );
      exit;
    }

    if( !is_writable( $param['tgt'] ) )
    {
      $this->add_logevent( "<span class=\"msgerror\"> E".__LINE__." {$this->admtext['cantupd']}</span> <span class=\"hilighterr msgbold\">{$param['tgt']} %parameter:% {$param['param']}</span>" );
      $this->add_logevent( "{$this->admtext['fileperms']} ({$param['tgt']})" );
      $this->write_eventlog();
      header( "Location: admin_showmodslog.php" );
      exit;
    }
    $success = 0;

    /*******************************************************************
    UPDATE TARGET FILE WITH DEFAULT PARAMETER VALUE
    *******************************************************************/
    /* Read target file into buffer. */
    $target_file_contents = $this->read_file_buffer( $param['tgt'] );

    // remove surrounding single or double quotes from default parameter value
    $varval = trim( $param['def'], "\"'" );

    // escape internal single quotes
    $varval = str_replace( "'", "\\'", $varval );

    // add original surrounding quotes if any
    $quotes = '';
    if( $param['quot'] == 1 ) $quotes = "'";
    elseif( $param['quot'] == 2 ) $quotes = '"';
    $varval = $quotes.$varval.$quotes;

    $varname = preg_quote( $param['param'] );

    $reg_exp = "#([^\w]".$varname."\\s*=\\s*)([^;]*)#";
    if( !preg_match( $reg_exp, $target_file_contents, $matches ) )
    {
      $this->add_logevent( "<span class=\"msgerror\"> E".__LINE__." {$this->admtext['cantupd']}</span> <span class=\"hilighterr msgbold\">{$param['param']}</span>" );
      $this->mod_status = self::CANTUPD;
    }
    else
    {
      $success++;
      $this->add_logevent( "<span class=\"msgapproved\">{$param['param']} {$this->admtext['updated']}</span> ($varval)" );
      $this->mod_status = self::UPDATED;
    }

    // RESTORE THE FIRST OCCURANCE TO DEFAULT VALUE
    $targetstr = $matches[0];
    $updatestr = $matches[1] . $varval;
    $pos = strpos($target_file_contents, $targetstr);
    if( $pos !== false )
    {
      $target_file_contents = substr_replace($target_file_contents, $updatestr, $pos, strlen($targetstr) );
    }
    // SAVE UPDATED BUFFER TO TARGET FILE
    $this->write_file_buffer( $param['tgt'], $target_file_contents );
    unset( $target_file_contents );

    /*******************************************************************
    UPDATE MOD CONFIG FILE WITH DEFAULT PARAMETER VALUE
    *******************************************************************/
    /* Read mod confuration file into buffer. */
    $config_file_contents = $this->read_file_buffer( $param['cfg'] );

    /* If mod config file inserter $var=val into target file, update mod config
    ** value to prevent bad target errors. */
    $config_file_contents = str_replace( $targetstr, $updatestr, $config_file_contents );

    // update the %parameter line val for backward compatibility
    $regex = '#%parameter:'.$varname.':'.'[^%]*%#';
    $varval = trim( $varval, "\"'" );
    $replacement = "%parameter:".$param['param'].":".$varval."%";

    // This will replace all occurrences, so it is important that the same $var name
    // not be used for more than one parameter in the mod config file.
    $config_file_contents = preg_replace( $regex, $replacement, $config_file_contents );

    /* Save default parameter value to mod config file. */
    $this->write_file_buffer( $param['cfg'], $config_file_contents );
    $this->write_eventlog();
    return $success;
  } // restore_parameter()

  protected function display_edit_panels( $params_table )
  {
    echo "
<div class='admin-main'>
<div class='tableFixedHead'>
<table id='mmtable' class='mmtable'>
	<thead> 
  	<tr>
      <th class='center'>
        <div class=\"fieldnameback fieldname\">{$this->admtext['edopts']}: $this->cfgfile</div>
      </th>
    </tr>
  </thead>
  <tr>
    <td>
";

    if( !is_writable( $this->cfgpath ) )
    {
      echo "
<span style=\"color:red;\">{$this->admtext['cfgnowrite']}</span>";
      exit;
    }
    // show the parameters editing form
    $index = 0;
    foreach( $params_table as $param )
    {
      $index++;
      $formindex = 'forme_'.$index;
      $relpath = str_replace( $this->rootpath, '', $param['tgt'] );
      echo "
<form method='post' action='' class='forme' id=$formindex>
<table class='nested'>
<tr>
   <td class=\"databack edpanel mmleftcol\">
      {$param['label']}
   </td>
   <td class=\"databack edpanel mmrightcol\">
      <div>$relpath: {$param['param']}</div>
      <textarea class=\"w99\" name=\"param[val]\">{$param['val']}</textarea>
      <input type='hidden' name='param[forme]' value='$formindex' />
      <input type=\"hidden\" name=\"param[mod]\" value=\"$this->modname\" />
      <input type=\"hidden\" name=\"param[version]\" value=\"$this->version\" />
      <input type=\"hidden\" name=\"param[def]\" value=\"{$param['def']}\" />
      <input type=\"hidden\" name=\"param[tgt]\" value=\"{$param['tgt']}\" />
      <input type=\"hidden\" name=\"param[cfg]\" value=\"{$param['cfg']}\" />
      <input type=\"hidden\" name=\"param[param]\" value=\"{$param['param']}\" />
      <input type=\"hidden\" name=\"param[quot]\" value=\"{$param['quot']}\" />
      <div class=\"edbuttonbar\">
         <button type=\"submit\" name=\"submit\" value=\"pUpdate\">{$this->admtext['update']}</button>&nbsp;&nbsp;
         <button type=\"submit\" name=\"submit\" value=\"pRestore\">{$this->admtext['restore']}</button>&nbsp;&nbsp;
      </div>
   </td>
</tr>
</table><!-- sub mmtable-->
</form>";
      } // each parameter

  $flinka = '';
  if( !empty( $_SESSION['actualmod'] ) )
  {
    $id = $_SESSION['actualmod'];
    unset( $_SESSION['actualmod'] );
    if( is_numeric( $id) )
    {
      $flinka = '#flinka'.($id-1);
    }
  }

      echo "
<tr>
<td>
<div class='lightback edreturn'>
   <form method='post' action='admin_modhandler.php$flinka'>
            <button type=\"submit\" name=\"submit\" value=\"pCancel\">{$this->admtext['return']}</button>
   </form>
</div>
</td>
</tr>

    </td>
  </tr>
</table><!-- master mmtable -->
</div><!-- tableFixedHead -->
</div><!-- admin-main -->
";
      return true;
  } // display_edit_panels()

  protected function open_target_file( $target_datapack, $readonly=false )
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
    //$target_datapack = $this->parse_table[$i];

    $line = $target_datapack['line'];
    $flag = $target_datapack['flag'];
    $target_filepath = $target_datapack['arg1'];

    /* Remove rootpath portion of target file path for log display.*/
    $display_path = $flag . str_replace( $this->rootpath, '', $target_filepath );

    while(true) /* Target directive processing loop */
    {
      /* If not readonly and previous target file open, save file contents before
      ** opening a new one.*/
      if( !$readonly && !empty( $this->active_target_file ) && !empty( $this->target_file_contents ) )
      {
        if( false === $this->write_file_buffer( $this->active_target_file, $this->target_file_contents ) )
        {
          $this->num_errors++;
          $logstring = "<span class='msgerror'>{$this->admtext['cantwrite']} %target:</span><span class='tgtfile'>$display_path  E".__LINE__."</span><span class='tag'>%</span>&nbsp;";
          $return_flag = false;
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

      /* Read target file contents into a processing buffer.*/
      $this->target_file_contents = $this->read_file_buffer( $target_filepath, $flag );

      /* Report file errors if any.*/
      if( is_numeric( $this->target_file_contents ) )
      {
        $code = $this->target_file_contents;
        $this->target_file_contents = '';
        $this->is_target = false;

        if( $code == self::BYPASS )
        {
          $logstring .= "{$this->admtext['optmissing']}&nbsp;<span class='msgapproved'>{$this->admtext['bypassed']}</span>";
          break;
        }
        elseif( $code == self::NOFOUL )
        {
          $this->num_errors++;
          $logstring .= "{$this->admtext['tgtmissing']}&nbsp;<span class='msgerror'>{$this->admtext['required']}</span>";
          break;
        }
        elseif( $code == self::NOFILE )
        {
          $this->num_errors++;
          $logstring .= "<span class='msgerror'> E".__LINE__." {$this->admtext['tgtmissing']}</span>";
          $return_flag = false;
          break;
        }
        elseif( $code == self::NOWRITE )
        {
          $this->num_errors++;
          $logstring .= "<span class='msgerror'> E".__LINE__." {$this->admtext['notwrite']}</span>";
          $return_flag = false;
          break;
        }
        elseif( $code == self::ISEMPTY )
        {
          $this->num_errors++;
          $logstring .= "<span class='msgerror'> E".__LINE__." {$this->admtext['emptyfile']}</span>";
          $return_flag = false;
          break;
        }
        else
        {
          $this->num_errors++;
          $logstring .= "<span class='msgerror'> E".__LINE__." {$this->admtext['errors']}</span>";
          $return_flag = false;
          break;
        }
      }
      else
      {
        $this->is_target = true;
        $this->active_target_file = $target_filepath;
        $logstring .= "{$this->admtext['opened']}";
      }
      break;
    } // while(true) processing loop

    $this->add_logevent( $logstring );


    return $this->is_target;
  }

  protected function open_mod_file( $cfgfile )
  {
    $file_state = true;

    /* Remove rootpath portion of target file path for log display.*/
    $display_path = str_replace( $this->rootpath, '', $cfgfile );

    $logstring = "<span class='tag'>mod file </span><span class='tgtfile'>$display_path</span>&nbsp;";

    /* Read mod config file contents into a processing buffer.*/
    $this->cfg_file_contents = $this->read_file_buffer( $cfgfile );

    /* Report file errors if any.*/
    if( is_numeric( $this->cfg_file_contents ) )
    {
      $this->cfg_file_contents = '';
      $logstring .= "<span class='msgerror'> E".__LINE__." {$this->admtext['cannotopen']} $display_path</span>";
      $file_state = false;
    }
    else
    {
      $logstring .= "{$this->admtext['opened']}";
    }

    $this->add_logevent( $logstring );

    return $file_state;
  }

  /* Combine parameter and desc directive data into one datapack for processing.
  */
  protected function combine_packs( $parameter_datapack, $desc_datapack )
  {
    $param = array();

    $varname = preg_quote( $parameter_datapack['arg1'] );

    /* Get actual targeted variable value from target file and see
    ** if it is a string - has quotes.
    */
    $reg_exp = "#(".$varname."\\s*=\\s*)(['\"]?)([^;]*);#";
    if( !preg_match( $reg_exp, $this->target_file_contents, $matches ) )
    {
      $this->mod_status = self::ERRORS;
      $this->show_log_errors = true;

      $this->add_logevent("<span class=\"msgerror\"> E".__LINE__." {$this->admtext['tgtfile']} $atf</span> <span class=\"hilighterr msgbold\">{$this->admtext['noparam']}: {$parm['var']}</span>");
      $this->write_eventlog();
      return false;
    }

    /* Manage surrounding quotes in target file string variabel value. */
    $quotes = 0;
    if( !empty( $matches[2]) )
    {
      if( $matches[2] == "'" ) $quotes = 1;
      elseif( $matches[2] == '"' ) $quotes = 2;
    }

    /* Remove quotes for processing. We'll add them back before updating file. */
    $matches[3] = trim( $matches[3], "'\"" );

    /* Escape internal single quotes. */
    $matches[3] = str_replace( "'", "\\'", $matches[3] );

    /* Combine the datapacks */
    $param['val'] = $matches[3];
    $param['def'] = $desc_datapack['arg2'];
    $param['tgt'] = $this->active_target_file;
    $param['cfg'] = $this->cfgpath;
    $param['param'] = $parameter_datapack['arg1'];
    $param['quot'] = $quotes;
    $param['label'] = $desc_datapack['arg1'];

    return $param;
  } // combine_packs()

  /* This function removes all but target - parameter - desc directives from
  ** parse table to simplify modeditor processing.
  */
  protected function clean_parse_table()
  {
    $temp_table = array();
    $target_hold = array();
    $target_set = false;

    // make new directories available for file copies
    for( $i=0; isset($this->parse_table[$i]); $i++ )
    {
      switch( $this->parse_table[$i]['name'] )
      {
        case 'target':
          /* Hold target aside until we see it has an associated parameter. */
          $target_hold = $this->parse_table[$i];
          $target_set = false;
          break;
        case 'parameter':
          if( !$target_set )
          {
            $temp_table[] = $target_hold;
            $target_set = true;
          }
          $temp_table[] = $this->parse_table[$i];
          break;
        case 'desc':
          $temp_table[] = $this->parse_table[$i];
          if( !empty( $target_hold['name'] ) )
          break;
        default:
          /* Discard the rest */
          break;;
      }
    }

    return $temp_table;
  } // clean_parse_table();

} // class modeditor

function new_modeditor()
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

  return new modeditor( $objinits );
}