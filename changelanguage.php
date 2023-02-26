<?php
$textpart = "language";
include("tng_begin.php");

if(!empty($cms['events'])){include('cmsevents.php'); cms_register();}

$currentuser = isset($_SESSION['currentuser']) ? $_SESSION['currentuser'] : "";
$currentuserdesc = isset($_SESSION['currentuserdesc']) ? $_SESSION['currentuserdesc'] : "";

$query = "SELECT languageID, display, folder FROM $languages_table ORDER BY display";
$result = tng_query($query);

$numrows = tng_num_rows( $result );

tng_header( $text['changelanguage'], $flags );
?>

<p class="header"><?php echo $text['changelanguage']; ?></p><br clear="all" />

<?php 
if( $numrows ) {
	echo getFORM( "savelanguage", "post", "", "" );
?>
	<select name="newlanguage">
<?php
	while( $row = tng_fetch_assoc($result)) {
		echo "<option value=\"{$row['languageID']}\"";
		if( $languages_path . $row['folder'] == $mylanguage )
			echo " selected=\"selected\"";
		echo ">{$row['display']}</option>\n";
	}
	tng_free_result($result);
?>
	</select>
	<br/><br/>
	<input type="submit" class="btn" value="<?php echo $text['savechanges']; ?>">
	<br/><br/>
</form>
	<br/><br/>
	<br/><br/>

<?php
}
else
	echo $text['language'] . ": $mylanguage\n";

tng_footer( "" );
?>
