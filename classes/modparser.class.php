<?php /*//220926 18:52*/
/*
  Mod Manager 14

  Class extends modbase and is extended by other MM processing classes
  that need parse table data to perform their tasks.

  This class parses a mod config file and creates a table containing
  the directives and associated data as found in the cfg file. If a fatal
  parse error occurs, class returns a global error array
  ($this->parse_error) with details.

  End user classes like modvalidator, modlister, modinstaller and
  modremover use the parse table to perform their designed functions.

  All directives and their processing functions are listed in the Proclist
  array in Modbase.

  If a new directive is added to the parser, processing functions for it
  must be added to Modparser, Modvalidator, Modliser, Modinstaller and
  Modremover using the same function names listed, but with each programmed
  to provide its own processing according to purpose.

  Directive functions are private to prevent name clashes with functions
  of the same name within other processing scripts.

  Public Methods:
    $this->parse();

  Terms and concepts:

    Token - an array containing raw data about a directive from a mod
    configuration file. It must be processed into a parse table of
    directive datapacks to be useable.

    Directive - A Mod Manager keyword that informs or edits, creates or
    manipulates target files.

    Directive datapack - A small array containing all the information
    necessary for Mod Manager to validate, list, install and uninstall an
    individual Directive.

    Parse table - An array of all Directive datapacks from a mod
    configuration file. Modparser creates the parse table Mod Manager uses
    it to validate, list, install and remove mods.

    Dispatcher - We use a feature of PHP that allows us to dispatch each
    directive from a mod configuration file to its own function specifically
    designed to turn it into a directive datapack and add it to the mod's
    parse table.  The main processing loop is very small and very fast.
    All the code to process a given directive can be found (and understood)
    in a single function.

    File modifier - Formerly known as an "optag" it is a type of directive
    that changes the content of a target file. An example would be %insert:
    before. File modifiers are grouped because processing them into
    directive datapacks uses a common code for all of them.

    Proclist - A list of all valid Mod Manager directives and the name of
    their individual processing functions is defined in Modbase.  Processing
    is automatic - for each token we look up its processing function, then
    dispatch it for conversion into a directive datapack and inclusion into
    the parse table.

    Conditional directives - Perform a test on a file or on the TNG
    environment and guides Modparser processing of tokens, depending on the
    result of the test. Modparser handles all condtional testing and it only
    includes in the parse table those directives that meet the criteria of
    the tests. The result of conditional testing is added to the parse table
    for information only, to help developers understand the program flow of
    their mods.

    How Modparser Works

    Modparser splits the mod cfg file into sections, each beginning with a
    directive and including everything up to the next directive.

    It then creates tokens from the sections, each containing the cfg line
    number, name, args and blob. Args is everything after the directive name
    up to the terminator (%).

    The Blob is everything that follows directive args up to the beginning
    of the next directive.

    Finally, Modparser uses _directive() functions to turn the tokens into
    datapacks and collect them into a parse table available for use by other
    mod classes.
*/

/* File management */
$modparser_version = '14.0.0.1 220812-2305';

require_once 'classes/modbase.class.php';

class modparser extends modbase
{
  function __construct( $objinits ) {
    parent::__construct( $objinits );

    if( empty( $objinits['admtext']['badchar'] ) )
    {
      $this->admtext['badchar'] = "char ".$this->admtext['errors'];
    }
  }

  protected $modname;
  protected $modversion;
  protected $open_target;
  protected $is_target;
  protected $parse_error = array();
  protected $parse_table = array();

  /* Function returns a parse table containing processable directive datapacks. */
  public function parse( $cfgpath )
  {  
    $this->cfgpath = $cfgpath;
    $this->cfgfile = pathinfo( $cfgpath, PATHINFO_BASENAME );
    $this->is_target = false;
    $this->parse_error = array();
    $this->parse_table = array();

    /* Set these up for the listing in case they are missing from the cfg file */
    $this->modname = "[{$this->admtext['missing']}]";
    $this->version = "[???]";

    /* Begin processing the cfg file. The WHILE loop controls exit from
    ** processing with a BREAK when finished or if errors are encountered.
    */
    while( true )
    {
      $buffer = "";

      /* Read in the mod configuration file */
      $buffer = $this->read_cfgfile( $cfgpath );
      if( !empty($this->parse_error) ) break;

      /****************************************************************
      A token is an array containing the name of a directive, line
      number where found in the cfg file, an argument string and
      a "blob" - that is, content from the end of the directive
      argument string to the beginning of the next directive. Each
      token will be converted into a "directive datapack" (array).

      Token map
      $token['line'] -- directive line number from mod cfg file
      $token['name'] -- name of directive, e.g., 'version'
      $token['args'] -- everything between the first colon (:) and the
                        arguments terminator (%)
      $token['blob'] -- everything between the arguments terminator and the
                        beginning of the next directive.
      *****************************************************************/
      $tokens = $this->get_tokens( $buffer );

      if( !empty($this->parse_error) ) break;

      /***************************************************************
      MAIN PARSING ROUTINE
        Process tokens into directive datapacks and add them to the
        parse table for output to executive Mod Manager classes.
      ***************************************************************/
      for($i=0; isset( $tokens[$i] ); $i++ )
      {

        /* If this is a file modifier and the location is missing this
        ** we have a critical error and must stop processing this one. */
        if( in_array( $tokens[$i]['name'], $this->file_modifiers ) )
        {
          if( $tokens[($i-2)]['name'] != "location")
          {
            $this->parse_error['line'] = $tokens[$i]['line'];
            $this->parse_error['tag']  = 'p'.__LINE__.' %location :';
            $this->parse_error['text'] = self::MISSING;
            return;
          }
        }

        /* Lookup directive by name and get its processing function. */
        if( isset( $this->proclist[$tokens[$i]['name']] ) )
        {
          /* PHP allows assignment of a function name to a variable
          ** and then executing the "variaable" with arguments, so get
          ** the function name associated with this directive from
          ** $proclist.
          */

          $function = $this->proclist[$tokens[$i]['name']];

          /* Bypass delimiter directives (e.g. %end:%) that require no
          ** processing and are not needed in the parse table.
          */
          if( $function == 'no_op' ) continue;

          /* Use the proclist function to construct a directive datapack from
          ** this token. */
          $datapack = $this->$function( $tokens, $i );

          /* Parsing Error result? Emit and stop parsing. */
          if( !empty($this->parse_error ) ) break;

          /* If conditional directive, jump to token label at index $i
          ** to continue processing.
          */
          if( !empty( $datapack['goto'] ) ) $i = $datapack['goto'];

          /* Add this directive datapack to the parse table. */
          if( !empty( $datapack ) ) $this->parse_table[] = $datapack;

          continue; // to the next token
        }
        else
        { // Directive name not found in proclist
          $this->parse_error['line'] = $tokens[$i]['line'];
          $this->parse_error['tag']  = 'p'.__LINE__.' %'.$tokens[$i]['name'].':';
          $this->parse_error['text'] = self::TAGUNK;
          break; // abandon further processing
        }
      } // token processing loop

      break;
    } // Parse table assembly loop

    if( !empty( $this->parse_error ) )
      return false;

    $this->required_tags_check( $this->parse_table );

    if( !empty( $this->parse_error ) )
      return false;

    /* Mod configuration file exists, has content, but no mm directives. */
    if( empty( $this->parse_error ) && empty( $this->parse_table ) )
    {
      $this->parse_error['line'] = ':::';
      $this->parse_error['tag']  = 'p'.__LINE__.' '.$this->cfgfile;
      $this->parse_error['text'] = self::UNXEND;
      return false;
    }

    return true;
  } // End of parse function

/***************************************************************
  PRIVATE FUNCTIONS TO TURN TOKENS INTO DIRECTIVE RECORDS
  Each function returns a directive.
***************************************************************/
  private function _author( $tokens, $i )
  {
    /* Simple directive with one or two arguments.
    ** Returns a directive datapack. Individual author
    ** records will be combined in the mod listing.
    */
    return $this->simple2( $tokens, $i );
  }

  private function _copyfile( $tokens, $i)
  {
    /*  %copyfile directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == copyfile or copyfile2
    **  $datapack['arg1'] == full server path to source file
    **  $datapack['arg2'] == full server path to destination file
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == flag (if any)
    **  $datapack['goto'] == empty (not a conditional directive)
    */

    $datapack = $this->simple2( $tokens, $i );

    if( empty( $datapack['arg1'] ) )
    {
      $this->parse_error['line'] = $datapack['line'];
      $this->parse_error['tag']  = 'p'.__LINE__.' '.$datapack['name'];
      $this->parse_error['text'] = self::NOSOURCE;

      return $datapack;
    }

    /* Use full server path for source file copy. */
    $datapack['arg1'] = $this->resolve_file_path( $datapack['arg1'],
                                                  self::MODS_DIR );

    /* Use full server path for destination file copy. */
    if( !empty( $datapack['arg2'] ) )
    {
      $datapack['arg2'] = $this->resolve_file_path( $datapack['arg2'] );
    }
    else
    {
      /* Should never happen, but...
      ** Destination file missing - copy file to root using same name as
      ** source file. */
      $datapack['arg2'] = $this->rootpath.
        pathinfo( $datapack['arg1'], PATHINFO_BASENAME );
    }
    return $datapack;
  } // _copyfile()

  private function _desc( $tokens, $i )
  {
    /*  %desc directive map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == desc
    **  $datapack['arg1'] == description including default value in parens
    **  $datapack['arg2'] == default value for preceding %parameter directive
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty
    */

    /* Must directly follow a %parameter directive */
    if( $tokens[$i-1]['name'] != 'parameter' )
    {
      $this->parse_error['line'] = $tokens[$i]['line'];
      $this->parse_error['tag']  = 'p'.__LINE__.' %desc:';
      $this->parse_error['text'] = self::NOPARAM; // index into admtext[]
      return;
    }

    $datapack = $this->simple1( $tokens, $i );

    /* Get get all parenthetical expressions from arg1 */
    preg_match_all( "#\(([^\)]*)\)#sm", $datapack['arg1'], $matches,
      PREG_SET_ORDER );

    /* Use data from the LAST set of parens inside the desc for the
    ** default value.
    */
    $arg2 = end( $matches );

    if( isset( $arg2[1] ) )
    {
      $datapack['arg2'] = $arg2[1];
    }

    return $datapack;
  } // _desc()

  private function _description( $tokens, $i )
  {
    return $this->simple1( $tokens, $i );
  }

  /* We are processing $tokens in order and creating parse table directive
  ** records. When conditionally testing for a file, if the file exists we
  ** jump over tokens and begin processing again from the label given in the
  ** %fileexists args.
  */
  private function _fileexists( $tokens, $i )
  {
    /*  %fileexists directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == fileexists
    **  $datapack['arg1'] == filename to be tested
    **  $datapack['arg2'] == label to jump to if file exists
    **  $datapack['arg3'] == message - parse table information only
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == $tokens array index to jump to continue
    **  processing
    */

    /* For modremover, a conditional jump such as this one is ignored -
    ** modremover will get a parse table with all possible installs for
    ** removal.
    */
    if( !empty( $this->classID ) && $this->classID == 'remover' ) return;

    $datapack = $this->simple2( $tokens, $i );

    /* Must have exactly two arguments: a file name and a goto label. */
    if( !$datapack['arg1'] || !$datapack['arg2'] )
    {
      $this->parse_error['line'] = $calling_line;
      $this->parse_error['tag'] = 'p'.__LINE__.' %fileexists: args';
      $this->parse_error['text'] = self::ERRORS;
      return false;
    }

    $filepath = trim( $datapack['arg1'] );
    $filepath = ltrim( $filepath, " /" );

    /* make the path absolute:
    ** $filepath = $this->rootpath.$filepath;*/
    $datapack['arg1'] = $filepath = $this->resolve_file_path( $filepath );

    $label = $datapack['arg2'];

    $n = $this->find_label( $tokens, $i, $label );
    if( !empty($this->parserr ) )
      return $false;

    if( !file_exists( $filepath ) )
    {
      $datapack['arg2'] = 'false';
      $datapack['arg3'] = lcfirst( $this->admtext['text_continue'] );
      return $datapack;
    }

    /* Set the segments table index to continue
     * processing from the label, skipping directives
     * in between. */
    $datapack['arg2'] = 'true';
    $datapack['arg3'] = 'goto line '.$tokens[$n]['line'].' ('.$label.')';

    /*  The segments table "for-loop" will increment past the label.
     *  To include the label in the parse table, back up the segment
     *  pointer (index) to just before the 'goto' label. */
    $datapack['goto'] = $n - 1;
    return $datapack;

  } // fileexists()

  private function _goto( $tokens, $i )
  {
    /*  %goto directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == goto
    **  $datapack['arg1'] == name of label to jump to
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == message - parse table information only
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == index of label to goto
    */
    /*  Modremover class ignores conditional jumps. */
    if( !empty( $this->classID ) && $this->classID == 'remover' ) return;

    /* goto is a simple directive with one argument - label name */
    $datapack = $this->simple1( $tokens, $i );

    /* Must have exactly one arguments */
    if( empty( $datapack['arg1'] ) )
    {
      $this->parse_error['line'] = $datapack['line'];
      $this->parse_error['tag'] = 'p'.__LINE__.
              ' %goto label arg';
      $this->parse_error['text'] = self::MISSING;
      return false;
    }

    $label = $datapack['arg1'];

    $n = $this->find_label( $tokens, $i, $label );
    if( !empty($this->parserr ) )
      return false;

    /* Display the line number and label for the goto jump */
    $datapack['arg3'] = 'goto line '.$tokens[$n]['line'].' ('.$label.')';

     /* don't skip next cfg segment */
    $datapack['goto'] = $n-1;

    return $datapack;

  } // goto()

  private function _insert( $tokens, $i )
  {
    /* Returns 'insert' optag directive with code block as arg1 */
    return $this->file_editor( $tokens, $i );
  }

  private function _label( $tokens, $i )
  {
    $aValid = array('-', '_');
    if( !ctype_alnum( str_replace( $aValid, '', $tokens[$i]['args'] ) ) )
    {
      //$this->labels[$tokens[$i]['args']] = $i;
      /* Label name has non-alphanumeric character.
      ** Case 1: an extra colon was inserted in the
      ** %label Directive -- %label:done:%
      ** The second colon would become part of the
      **name -- invalid character. */
      $this->parse_error['line'] = $tokens[$i]['line'];
      $this->parse_error['tag']  = 'p'.__LINE__.
        ' %label [<strong>'.$tokens[$i]['args'].'</strong>] ';
      $this->parse_error['text'] = 'badchar';
    }
    return $this->simple1( $tokens, $i );
  }

  private function _location( $tokens, $i )
  {
    /*  %location directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == location
    **  $datapack['arg1'] == code/text in target file
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == optional note
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty
    */

    /* Must have a target file in the cfg. */
    if( !$this->is_target )
    {
      $this->parse_error['line'] = $tokens[$i]['line'];
      $this->parse_error['tag']  = 'p'.__LINE__.
              ' %location:';
      $this->parse_error['text'] = self::NOTARGET; // index into admtext[]
      return;
    }

    if( empty( trim( $tokens[$i]['blob'] ) ) )
    {
      $this->parse_error['line'] = $tokens[$i]['line'];
      $this->parse_error['tag']  = 'p'.__LINE__.
              ' '.$tokens[$i]['name'];
      $this->parse_error['text'] = self::NOCOMPS; // index into admtext[]
      return;
    }

    $datapack = $this->simple1( $tokens, $i );
    $datapack['arg3'] = $datapack['arg1']; // This would be a note
    $datapack['arg1'] = $tokens[$i]['blob'];
    $datapack['arg1'] = substr( $datapack['arg1'], 2 );
    $datapack['arg1'] = substr( $datapack['arg1'], 0, -2 );

    /* NOT A PARSING ISSUE BUT HANDLE IT HERE TO AVOID DOING IT IN ALL
    ** CLASSES.
    **
    ** If %location code has leading blank line (CRLF) when there is none in
    ** the target file, it won't show a bad location error because the leading
    ** CRLF matches the CRLF at the end of the previous line which is not
    ** blank. So if there is a leading blank line or lines in the location
    ** code, we must prepend a CRLF to it to match the one in the previous
    ** non-blank line in order to get a valid bad target error if there
    ** is one in the listing.
    */

    /* Look ahead to verify presence of %end:% tag. */
    $i++;
    if( $tokens[$i]['name'] != 'end')
    {
      $this->parse_error['line'] = $datapack['line'];
      $this->parse_error['tag']  = 'p'.__LINE__.
        ' '. $datapack['name'];
      $this->parse_error['text'] = self::NOEND;
      return;
    }

    /* Look ahead again to see if we have a valid file modifier directive
    ** following location. Sometimes they get mistyped.
    */
    $file_modifier_directive = $tokens[$i + 1]['name'];
    if( !in_array( $file_modifier_directive, $this->file_modifiers ) )
    {
      $this->parse_error['line'] = $datapack['line'];
      $this->parse_error['tag']  = 'p'.__LINE__.
              ' '.$datapack['name'];
      $this->parse_error['text'] = self::NOACT;
      return;
    }

    return $datapack;
  } // _location()

  private function _mkdir( $tokens, $i )
  {
    /*  $mkdir directive map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == mkdir
    **  $datapack['arg1'] == server path to create new directory
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == optional flag
    **  $datapack['goto'] == empty
    */
    $datapack = $this->simple1( $tokens, $i );

    if( !isset( $datapack['arg1'] ) )
    {
      $this->parse_error['line'] = $datapack['line'];
      $this->parse_error['tag']  = 'p'.__LINE__.
              ' '.$datapack['name']." arg";
      $this->parse_error['text'] = self::MISSING;
      return $datapack;
    }

    /* Resolve file path to complete server path */
    $datapack['arg1'] = $this->resolve_file_path( $datapack['arg1'] );

    return $datapack;
  }  // _mkdir()

  private function _name( $tokens, $i )
  {
    $datapack = $this->simple1( $tokens, $i );
    $this->modname = $datapack['arg1'];
    return $datapack;
  }

  /* Consumes %newfile and following %fileversion tokens. */
  private function _newfile( $tokens, $i  )
  {
    /*  %newfile directive map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == newfile
    **  $datapack['arg1'] == filepath for new file
    **  $datapack['arg2'] == content of new file
    **  $datapack['arg3'] == version number of new file
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty
    */

    /* Break out single file path argument and flag */
    $datapack = $this->simple1( $tokens, $i );

    if( empty( $datapack['arg1'] ) )
    {
      $this->parse_error['line'] = $datapack['line'];
      $this->parse_error['tag']  = 'p'.__LINE__.
              ' '.$datapack['name']." path";
      $this->parse_error['text'] = self::MISSING;
      return $datapack;
    }

    $datapack['arg1'] = $this->resolve_file_path( $datapack['arg1'] );

    /* Look ahead to get the file version and code block */
    $i++;

    $datapack['arg2'] = $tokens[$i]['blob'];
    /* Remove leading and trailing CRLF from code block */
    $datapack['arg2'] = substr( $datapack['arg2'], 2 );
    $datapack['arg2'] = substr( $datapack['arg2'], 0, -2 );

    $datapack['arg3'] = $tokens[$i]['args'];

    /* Verify that version number was provided in the directive */
    if( empty( $datapack['arg3'] ) )
    {
      $this->parse_error['line'] = $version['line'];
      $this->parse_error['tag']  = 'p'.__LINE__.
              ' '.$version['name']." version";
      $this->parse_error['text'] = self::MISSING;
    }

    return $datapack;
  } // _newfile()

  private function _note( $tokens, $i )
  {
    return $this->simple1( $tokens, $i );
  }

  private function _parameter( $tokens, $i )
  {
    /*  %parameter directive map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == parameter
    **  $datapack['arg1'] == target variable
    **  $datapack['arg2'] == target value
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty
    */
    /* There must be a target file in the cfg. */
    if( !$this->is_target )
    {
      $this->parse_error['line'] = $tokens[$i]['line'];
      $this->parse_error['tag']  = 'p'.__LINE__.
              ' %parameter:';
      $this->parse_error['text'] = self::NOTARGET; // index into admtext[]
      return;
    }

    /* Next token must be a 'desc' */
    if( $tokens[$i+1]['name'] != 'desc' ) {
      $this->parse_error['line'] = $tokens[$i]['line'];
      $this->parse_error['tag']  = 'p'.__LINE__.
              ' %desc:';
      $this->parse_error['text'] = self::REQTAG; // index into admtext[]
      return;
    }

    return $this->simple2( $tokens, $i );
  } // _parameter()

  private function _private( $tokens, $i )
  {
    return $this->simple1( $tokens, $i );
  }

  private function _replace( $tokens, $i )
  {
    return $this->file_editor( $tokens, $i );
  }

  private function _target( $tokens, $i )
  {
    /*  %target directive map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == target
    **  $datapack['arg1'] == filepath to target file
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == optional note
    **  $datapack['flag'] == optional flag (@)
    **  $datapack['goto'] == empty
    */

    /* Can have two args - file path and optional note. */
    $datapack = $this->simple2( $tokens, $i );

    $datapack['arg1'] = $this->resolve_file_path( $datapack['arg1'] );

    /* Move arg2 (note) to arg3 for backward compatibility. */
    if( !empty( $datapack['arg2'] ) )
    {
      $datapack['arg3'] = $datapack['arg2'];
      $datapack['arg2'] = '';
    }

    /* Look ahead for fileoptional directive */
    if( isset( $tokens[$i+1] ) )
    {
      if( $tokens[$i+1]['name'] == 'fileoptional' )
      {
        $datapack['flag'] = self::FLAG_OPTIONAL;
      }
    }

    /* Set name of new open target globally */
    $this->open_target = $datapack['arg1'];
    $this->is_target = true;
    return( $datapack );
  } // _target()

  /* We are processing $tokens in order and creating parse table directive
  ** records. When conditionally testing for a TNG version, if we have the
  ** correct version we jump over tokens and begin processing again from the
  ** label given in the %tngversion args.
  */
   private function _tngversion( $tokens, $i )
  {
    /*  %tngversion directive map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == tngversion
    **  $datapack['arg1'] == low-range:low-range:label
    **  $datapack['arg2'] == in-range true or false message - info only
    **  $datapack['arg3'] == goto label or continue message - info only
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == $tokens processing index if test is true
    */

    /*  Modremover class ignores conditionals. */
    if( !empty( $this->classID ) && $this->classID == 'remover' ) return;

    $datapack = $this->simple3( $tokens, $i );

    /* Must have exactly three arguments - range low, range-high & label */
    if( !$datapack['arg1'] || !$datapack['arg2'] || !$datapack['arg3'] )
    {
      $this->parse_error['line'] = $datapack['line'];
      $this->parse_error['tag'] = 'p'.__LINE__.
              ' %tngverson args';
      $this->parse_error['text'] = self::MISSING;
      return false;
    }

    // remove dots from versions and turn into 4-digit integers
    $start = $this->version2integer( $datapack['arg1'] );
    $end = $this->version2integer( $datapack['arg2'] );

    $label = $datapack['arg3'];
    $n = $this->find_label( $tokens, $i, $label );
    if( !empty($this->parserr ) )
      return false;

    /* Assemble arg1 */
    $datapack['arg1'] = $start.':'.$end.':'.$label;
    $datapack['arg2'] = '';

    /* if current TNG version is wrong - continue sequential processing */
    if( $start > $this->int_version || $end < $this->int_version )
    {
      $datapack['arg2'] = 'false ('.$this->tng_version.')';
      $datapack['arg3'] = lcfirst( $this->admtext['text_continue'] );
      return $datapack;
    }

    /* Current TNG version is correct - goto label */
    $datapack['arg2'] = 'true ('.$this->tng_version.')';
    $datapack['arg3'] = 'goto line '.$tokens[$n]['line'].' ('.$label.')';

     /* don't skip next cfg segment */
    $datapack['goto'] = $n - 1 ;
    return $datapack;
  } // _tngversion()

  /* We are processing $tokens in order and creating parse table directive
  ** records. When conditionally testing for existence of text in currently
  ** open file, if found we jump over tokens and begin processing again from
  ** the label token given in the %textexists arguments. */
  private function _textexists( $tokens, $i )
  {
    /*  %textexists directive datapack map
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == textexists
    **  $datapack['arg1'] == text to search for in currently open file
    **  $datapack['arg2'] == result true or false
    **  $datapack['arg3'] == "goto label" or "continue" message - info only
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == $tokens processing index if test is true
    */

    /*  Modremover class ignores conditional jumps */
    if( !empty( $this->classID ) && $this->classID == 'remover' ) return;

    $datapack = $this->init_tag();
    $datapack['line'] = $tokens[$i]['line'];
    $datapack['name'] = $tokens[$i]['name'];

    while(true)
    {
      /* Is there an %end:% directive next? */
      if( $tokens[$i+1]['name'] != 'end' )
      {
        $this->parse_error['line'] = $tokens[$i]['line'];
        $this->parse_error['tag']  = "P".__LINE__." %textexists: ";
        $this->parse_error['text'] = self::NOEND; // index into admtext[]
        return false;
      }

      /* Must have exactly one arguments - goto label */
      if( empty( $tokens[$i]['args'] ) )
      {
        $this->parse_error['line'] = $tokens[$i]['line'];
        $this->parse_error['tag'] = "P".__LINE__." %textexists: label";
        $this->parse_error['text'] = self::MISSING;
        return false;
      }

      /* Is there a target file specified in cfg file? */
      if( empty( $this->open_target ) )
      {
        $this->parse_error['line'] = $tokens[$i]['line'];
        $this->parse_error['tag']  = "P".__LINE__." %textexists: %target: ";
        $this->parse_error['text'] = self::MISSING; // index into admtext[]
        return false;
      }

      $label = $tokens[$i]['args'];

      /* Get index in tokens table containing this $label. */
      $n = $this->find_label( $tokens, $i, $label );
      if( !empty( $this->parserr ) )
        return false;

      /* Assemble and add the code block removing the final CRlf */
      $datapack['arg1'] = $tokens[$i]['blob'];
      $datapack['arg1'] = substr( $datapack['arg1'], 0, -2 );
      $datapack['arg1'] = substr( $datapack['arg1'], 2 );

      /* Does target file exist? */
      if( !file_exists( $this->open_target ) )
      {
        // return textexists = false
        $datapack['arg2'] = 'false - '.$this->admtext['tgtmissing'];
        $datapack['arg3'] = lcfirst( $this->admtext['text_continue'] );
        break;
      }

      $buffer = $this->read_file_buffer( $this->open_target );

      /*  If target text is ambiguous the mod listing should catch it
      **  so just check for presence here.
      */
      $p = strpos( $buffer, trim($datapack['arg1']) );

      unset( $buffer );

      if( false === $p )
      {
        /* Text not found */
        //$datapack['arg1'] = $datapack['arg2'];
        $datapack['arg2'] = 'false';
        $datapack['arg3'] = lcfirst( $this->admtext['text_continue'] );
        break;
      }

      /* Text found */
      //$datapack['arg1'] = $datapack['arg2'];
      $datapack['arg2'] = 'true';
      $datapack['arg3'] = 'goto line '.$tokens[$n]['line'].' ('.$label.')';

      /*  The segments table for-loop will increment past label.
       *  To list label in parse table, back up the segments table
       *  index.
       */
      $datapack['goto'] = $n - 1 ;
      break;
    } // while(true)

    return $datapack;
  } // _textexists

  private function _triminsert( $tokens, $i )
  {
    return $this->file_editor( $tokens, $i );
  }

  private function _trimreplace( $tokens, $i )
  {
    return $this->file_editor( $tokens, $i );
  }

  private function _version( $tokens, $i )
  {
    return $this->simple1( $tokens, $i );
  }

  private function _vinsert( $tokens, $i )
  {
    $datapack = $this->file_editor($tokens, $i);

    //Remove all but the variables, then send it to _insert() for removal. */
    ;
    $lines = explode( "\r\n", $datapack['arg1'] );

    //echo basename(__FILE__),': ',__LINE__,'<br/>';var_dump($lines);exit;
    foreach( $lines as $line )
    {
      if( preg_match( "#^\s*\\$\w+#", $line ) )
      {
        $temp[] = $line;
      }
    }

    $datapack['arg1'] = implode( "\r\n", $temp );

    return $datapack;
  }

  private function _wikipage( $tokens, $i )
  {
    return $this->simple1( $tokens, $i );
  }

/***************************************************************
  OTHER SUPPORTING FUNCTIONS
***************************************************************/
  private function read_cfgfile($cfgpath)
  {
      $buffer = $this->read_file_buffer( $cfgpath );

      /* Handle errors from cgf buffer read */
      if( is_numeric( $buffer ) )
      {
        // CFG file is missing; quit with parsing error
        if($buffer == self::NOFILE)
        {
          $this->parse_error['line'] = '::';
          $this->parse_error['tag']  = 'p'.__LINE__.
              ' '.$this->cfgfile;
          $this->parse_error['text'] = self::NOCFGFILE; // index into admtext[]
          return; // leave the processing loop and return to caller
        }
        elseif( $buffer == self::ISEMPTY )
        {
          // CFG file has no content; quit with parsing error
          $this->parse_error['line'] = '::';
          $this->parse_error['tag']  = 'p'.__LINE__.
              ' '.$this->cfgfile;
          $this->parse_error['text'] = self::EMPTYFILE; // index into admtext[]
          return; // leave the processing loop and return to caller
        }
      }

      /* Allows % inside info tags without terminating them. */
      $buffer = str_replace( "\%", '&#037;', $buffer );

      /* Deprecated and unnecessary -- delete it. */
      $buffer = str_replace( '%target:files%', '', $buffer );

      /* Capture mod name for listing in case parser errors out early */
      preg_match( "#^\s*%name:([^%]+)%#m", $buffer, $matches );
      $this->modname = $matches[1];

      /* Capture mod version for listing in case parser errors out early */
      preg_match( "#^\s*%version:([^%]+)%#m", $buffer, $matches );
      $this->version = $matches[1];

      return $buffer;
  } // read_cfgfile()

  private function get_tokens( $buffer )
  {
      /* Use a single preg_split() function to split cfg into an array of
      ** sections, each containing the directive name, arguments line, and
      ** the "blob" -
      ** the rest of the section content up to the next directive. The blob
      ** contains code from the "%location" directive and all the file
      ** content modifier directives like "%replace."
      */
      $sections = preg_split( "#^[ \t]*%(\w+):([^%]*)#m", $buffer, -1, PREG_SPLIT_OFFSET_CAPTURE|PREG_SPLIT_DELIM_CAPTURE );

      /*
      ** Combine essential information from each segment into raw tokens
      ** for final processing into directive records (sub-arrays) per
      ** specific functions for each.
      */

      $tokens = array();
      for($i=1;isset($sections[$i]);$i+=3)
      {
        $token = array();
        $token['line'] = substr_count( $buffer, "\n", 0, $sections[$i][1] ) + 1;
        $token['name'] = $sections[$i][0];
        $token['args'] = $sections[$i+1][0];
        $token['blob'] = $sections[$i+2][0];

        /* CHECK FOR / PREVENT DIRECTIVE TERMINATION ERROR
        ** The $sections regex above adds the directive teriminating
        ** '%' char to the blob. If the blob does not start with a '%' char
        ** we have a directive termination error.
        **
        ** If the terminated block contains a % character in its text,
        ** user can use double terminator (%%) at the end of the
        ** argument to prevent the directive text from being cut off at
        ** the first % character in the text. In other words,
        ** a double terminator takes precedenct over a single one.
        */
        if( false !== $p = strpos( $token['blob'], '%%%' ) )
        {
          /* Yes, a triple terminator to protect a double %%. */
          $token['args'] .= substr( $token['blob'], 0, $p );
          $token['blob'] = substr( $token['blob'], $p+3 );
        }
        elseif( false !== $p = strpos( $token['blob'], '%%' ) )
        {
          $token['args'] .= substr( $token['blob'], 0, $p );
          $token['blob'] = substr( $token['blob'], $p+2 );
        }
        elseif( false !== $p = strpos( $token['blob'], '%' ) )
        {
          $token['args'] .= substr( $token['blob'], 0, $p );
          $token['blob'] = substr( $token['blob'], $p+1 );
        }
        else {
          $this->parse_error['line'] = $token['line'];
          $this->parse_error['tag']  = 'p'.__LINE__.
              ' '.$token['name'];
          $this->parse_error['text'] = self::TAGNOTERM;
        break;
        }

        $tokens[] = $token;

      } // Tokens created

      return $tokens;

  } // get_tokens()

  private function init_tag()
  {
    $datapack['line'] = '';
    $datapack['name'] = '';
    $datapack['arg1'] = '';
    $datapack['arg2'] = '';
    $datapack['arg3'] = '';
    $datapack['flag'] = '';
    $datapack['goto'] = '';
    $datapack['statkey'] = '';
    $datapack['eline'] = '';
    return $datapack;
  }

  /* Parse a token as directive with only one argument. Argument can contain
  ** colons. */
  private function simple1( $tokens, $i )
  {
    /* Because we assign the whole $token['args'] line to $datapack[arg1],
    ** directives like %description are allowed to contain colons without
    ** causing parsing problems.  If we were to explode the line as we do in
    ** simple2 and simple3, the description could be at least truncated, and
    ** possibly crash the mod listing.
    */
    $datapack = $this->init_tag();
    $datapack['line'] = $tokens[$i]['line'];
    $datapack['name'] = $tokens[$i]['name'];
    $datapack['arg1'] = $tokens[$i]['args'];
    $datapack['flag'] = $this->extract_flag( $datapack['arg1'] );
    return $datapack;
  }

    /* Parse a token as directive with only two arguments. Only second
    ** argument can contain colons.
    */
  private function simple2( $tokens, $i )
  {
    /* Use simple2 to protect colons in the second argument
    ** (for example %authors).
    ** Becuase it only splits on the first colon in the arg string, colons in
    ** the second arguments are safe (will not be split).
    */
    $datapack = $this->init_tag();
    $datapack['line'] = $tokens[$i]['line'];
    $datapack['name'] = $tokens[$i]['name'];


    $args = explode( ":", $tokens[$i]['args'], 2 );

    $datapack['arg1'] = isset( $args[0] ) ? $args[0] : '';
    $datapack['arg2'] = isset( $args[1] ) ? $args[1] : '';

    $datapack['flag'] = $this->extract_flag( $datapack['arg1'] );

    return $datapack;
  }

  /* Parse a token as directive with one, two or three arguments. Only third
  ** argument can contain colons.
  */
  private function simple3( $tokens, $i )
  {
    /* Do not use this to parse $token['args'] if the directive arguments
    ** themselves might contain text with colons (:) as they will not split
    ** correctly. Examples would include %description or %desc
    ** (use simple1()).
    */
    $datapack = $this->init_tag();
    $datapack['line'] = $tokens[$i]['line'];
    $datapack['name'] = $tokens[$i]['name'];

    $args = explode( ":", $tokens[$i]['args'], 3 );

    $datapack['arg1'] = isset( $args[0] ) ? $args[0] : '';
    $datapack['arg2'] = isset( $args[1] ) ? $args[1] : '';
    $datapack['arg3'] = isset( $args[2] ) ? $args[2] : '';

    $datapack['flag'] = $this->extract_flag( $datapack['arg1'] );

    return $datapack;
  }

/* file_modifiers are directives that change the content of a file.
** They share common traits (the instruction and code to replace or
** insert text into the file) and can all be processed using the same
** code in this function.
 */
  private function file_editor( $tokens, $i )
  {
    /*  map for all file editing directives
    **  $datapack['line'] == line number where found in the cfg file
    **  $datapack['name'] == name of the file editing directive
    **  $datapack['arg1'] == new code to replace or be inserted
    **  $datapack['arg2'] == empty
    **  $datapack['arg3'] == empty
    **  $datapack['flag'] == empty
    **  $datapack['goto'] == empty
    */

    switch( $tokens[$i]['name'] )
    {
      case'insert':
      case 'vinsert':
      case 'triminsert':
        if( empty( $tokens[$i]['args'] ) )
        {
          $this->parse_error['line'] = $tokens[$i]['line'];
          $this->parse_error['tag']  = 'p'.__LINE__.
              ' '.$tokens[$i]['name'];
          $this->parse_error['text'] = 'nocomps';
          return;
        }
        if( $tokens[$i]['args'] != 'before' && $tokens[$i]['args'] != 'after')
        {
          $this->parse_error['line'] = $tokens[$i]['line'];
          $this->parse_error['tag']  = 'p'.__LINE__.
              ' '.$tokens[$i]['name'];
          $this->parse_error['text'] = 'badchar';
          return;
        }
      default:
        break;
    }

    $datapack = $this->simple1( $tokens, $i  );

    /* Check that certain file_editor directives have positional
    ** argument 'before' or 'after' */
    if( $datapack['name'] == 'insert' || $datapack['name'] == 'triminsert'
        || $datapack['name'] == 'vinsert' )
    {
      if( empty( $datapack['arg1'] ) )
      {
        $this->parse_error['line'] = $datapack['line'];
        $this->parse_error['tag']  = 'p'.__LINE__.
              ' '.$datapack['name'];
        $this->parse_error['text'] = self::NOCOMPS;
        return;
      }
    }

    /* For backward compatibility: Combine file_editor directive name and
    ** directional indicator from token in 'name' and always place blob
    ** in 'arg1'
    */
    if( !empty( $datapack['arg1'] ) )
    {
      $datapack['name'] .= ':'.$datapack['arg1'];
    }

    if( empty( trim( $tokens[$i]['blob'] ) ) )
    {
      $this->parse_error['line'] = $tokens[$i]['line'];
      $this->parse_error['tag']  = 'p'.__LINE__.' '.$datapack['name'];
      $this->parse_error['text'] = self::NOCOMPS; // index into admtext[]
      return;
    }

    /* Simple1() does not return blob.  Add blob (code to edit into
    ** target file.) */
    $datapack['arg1'] = $tokens[$i]['blob'];

    /* Remove one leading and one trailing CRLF from blob */
    $datapack['arg1'] = substr( $datapack['arg1'], 2 );
    $datapack['arg1'] = substr( $datapack['arg1'], 0, -2 );

    /* Look ahead to verify presence of an %end:% directive */
    if( $tokens[$i+1]['name'] != 'end')
    {
      $this->parse_error['line'] = $datapack['line'];
      $this->parse_error['tag']  = 'p'.__LINE__.
              ' '.$datapack['name'];
      $this->parse_error['text'] = self::NOEND;
      return;
    }

    return $datapack;
  }

  /* Returns index for %label in the tokens table for parser conditional jumps */
  protected function find_label( $tokens, $i, $label )
  {
    $aValid = array('-', '_');
    if( !ctype_alnum( str_replace( $aValid, '', $label ) ) )
    {
      /* Label name has non-alphanumeric character.
      ** Case 1: an extra colon was unintentionally inserted in the
      **    %label Directive -- %label:done:%
      **    The second colon would become part of the name -- invalid
      **    character. */
      $this->parse_error['line'] = $tokens[$i]['line'];
      $this->parse_error['tag']  = 'p'.__LINE__.
        ' %label [<strong>'.$label.'</strong>] ';
      $this->parse_error['text'] = "badchar";
      return false;
    }
    else
    {
      for( $k=$i+1; isset($tokens[$k]); $k++ )
      {
        if( $tokens[$k]['name'] == 'label' )
        {
          if( $tokens[$k]['args'] == $label )
          {
            return $k;
          }
        }
      }
    }
    /* label not found. We only search from the label
    ** call, if label is placed before the call in the
    ** mod config file, it will also not be found */
    $this->parse_error['line'] = $tokens[$i]['line'];
    $this->parse_error['tag'] = 'p'.__LINE__.
            " label: $label";
    $this->parse_error['text'] = self::MISSING;
    return false;
  } // find_label()

  protected function __arrange_table( $parse_table )
  {
    $new_table = array();

    // make new directories available for file copies
    for( $i=0; isset($parse_table[$i]); $i++ ) {
      /* Info directives go to beginning of table.
      ** When installing mod, mkdir moves to beginning of table.
      ** When removing mod, mkdir goes after file copies so we can
      ** remove the files first (PHP rmdir cannot delete a directory with
      ** content.)
      */
      switch ( $parse_table[$i]['name'] ) {
        // Only for installation
        case 'mkdir':
          if( isset( $this->classID ) && $this->classID == 'remover' )
          {
            break;
          }
        case 'name':
        case 'version':
        case 'description':
        case 'note':
        case 'private':
        case 'author':
        case 'wikipage':
          $new_table[] = $parse_table[$i];
          $table[$i]['name'] = '';
          break;
        default:
          break;
      }
    }

    // next come file copies and newfile
    for( $i=0; isset($parse_table[$i]); $i++ )
    {
      if( $parse_table[$i]['name'] == 'copyfile' ||
        $parse_table[$i]['name'] == 'copyfile2' ||
        $parse_table[$i]['name'] == 'newfile')
      {
        $new_table[] = $parse_table[$i];
        $parse_table[$i]['name'] = '';
      }
    }

    // finally all the file modifiers, mkdirs and others
    for( $i=0; isset($parse_table[$i]); $i++ ) {
      if( empty( $parse_table[$i]['name'] ) ) continue;
      $new_table[] = $parse_table[$i];
    }

    return $new_table;
  }

  private function extract_flag( &$string )
  {
    // look for flag anywhere in the string - should be at beginning, but...
    if( $parts = preg_match( "#([@|^|~]+)#", $string, $matches, PREG_OFFSET_CAPTURE ) )
    {
      $flag = $matches[1][0];

      /* Remove flag from string -- removes all. */
      $string = str_replace( $flag, '', $string );

      return $flag;
    }
    return '';
  }

  protected function find_tagname_value( $name, $value )
  {
    foreach( $this->parse_table as $datapack )
    {
      if( $datapack[$name] == $value )
      {
        if( empty( $datapack['arg1'] ) )
          return false;
        else
          return $datapack['arg1'];
      }
    }
    return false;
  }

  protected function required_tags_check( )
  {
    if( false === $this->find_tagname_value( 'name', 'name' ) )
    {
       $this->parse_error['line'] = 'n/a';
       $this->parse_error['tag']  = 'p'.__LINE__.
              ' %name:';
       $this->parse_error['text'] = self::REQTAG; // index into admtext[]
    }
    elseif( false === $this->find_tagname_value( 'name', 'version' ) )
    {
      $this->parse_error['line'] = 'n/a';
      $this->parse_error['tag']  = 'p'.__LINE__.
              ' %version:';
      $this->parse_error['text'] = self::REQTAG; // index into admtext[]
    }
    elseif( false === $this->find_tagname_value( 'name', 'description' ) )
    {
      $this->parse_error['line'] = 'n/a';
      $this->parse_error['tag']  = 'p'.__LINE__.
              ' %description:';
      $this->parse_error['text'] = self::NOCOMPS; // index into admtext[]
    }
  }
} // modparser class

?>