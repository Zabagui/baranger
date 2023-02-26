<?php
include("begin.php");
include("adminlib.php");
$textpart = "mods";
include("getlang.php");
include("$mylanguage/admintext.php");

include("version.php");

function scan($dir) {
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
            (is_dir("$dir/$file")) ? scan("$dir/$file") : modify($dir,$file);
    }
}

function modify($dir,$file) {
   global $key, $insert, $oldm, $newm, $mess, $modded;
   $changed=0;
   if ($file == "cust_text.php") {
      $a = file_get_contents("$dir/$file");
      if (strpos($a, "\r\n", 2)) $eol = "\r\n";	//check eol status
      else $eol = "\n";
      if (!strpos($a, $insert)) {	//don't repeat the update
      	if (!strpos($a, $key)) 		//Spanish etc has translated key text
      		$a = str_replace("<?php", "<?php$eol$insert$eol$key$eol$newm$mess", $a);
      	else $a = str_replace($key, "$insert$eol$key", $a);
      	$changed=1;
      }
      if (strpos($a, $oldm)) {
		  $a = str_replace($oldm, $newm, $a);
		  $changed=1;
      }
      if ($changed) {
      	if (file_exists("$dir/cust_text.bak")) unlink("$dir/cust_text.bak");
      	if (!rename("$dir/cust_text.php", "$dir/cust_text.bak")) 
      		echo "Can't make backup of $dir/cust_text.php. <br/>\n";
      	if (!file_put_contents("$dir/cust_text.php", $a))
      		echo "Can't create new $dir/cust_text.php. <br/>\n";
      	else echo "changed $dir <br/>\n";
      	$modded++;
      }
   }
}

$key = "//Put your own custom messages here, like this:";
$insert = "//Mods should put their changes before this line, local changes should come after it.";
$oldm = '//$text[messagename]';
$newm = '//$text[\'messagename\']';
$mess = ' = "This is the message"';

$modded=0;
echo "<h3>Updating cust_text.php files with standard comments</h3>\n";

scan("languages");
if ($modded) echo "Modified $modded files. <br/>\n";
else echo "No changes required. <br/>\n";
$eol = "\r\n";
if(file_exists("languages/Greek-UTF8") && !file_exists("languages/Greek-UTF8/cust_text.php")) {
	file_put_contents("languages/Greek-UTF8/cust_text.php", "<?php$eol$insert$eol$key$eol$newm$mess$eol$eol?>");
	echo "Created languages/Greek-UTF8 <br/>\n";
}
echo "All cust_text.php files are now up to v{$tng_version} standard. <br/>\n";
echo "The originals of files that have been changed are at cust_text.bak in the original directory. <br>\n";

// admin_cust_text_update.php created from cust_text_update.php  by Ken Roy 
//		and following coded added to turn off Mod Manager options to display the Recommended Updates tab
//	echo " Updating the Mod Manager Options to turn off the Recommended Updates tab.<br>\n";
	require("adminlog.php");

	$optionsfile = $subroot.'mmconfig.php';
	include $optionsfile;
	$options['show_updates'] = "0";		// Turn off to not show the Recommended Updates tab  - added by Ken
	$optionstring = "<?php";
		foreach( $options as $key => $value ) {
			$optionstring .= "\n\$options['$key'] = \"$value\";";
		}
		$optionstring .= "\n?>";
		
		file_put_contents( $optionsfile, $optionstring );	
		
	adminwritelog( $admtext['modifyoptions'] );
	echo " Updated the Mod Manager Options. <br>\n";
?>
<input type="button" class="btn" value="Click to close" onclick="self.close()">