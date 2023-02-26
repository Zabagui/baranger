	<tr><td><?php echo $admtext['shorttitle']; ?>:</td><td><input type="text" name="shorttitle" size="50"></td></tr>
	<tr><td><?php echo $admtext['longtitle']; ?>:</td><td><input type="text" name="title" size="50"></td></tr>
	<tr><td><?php echo $admtext['author']; ?>:</td><td><input type="text" name="author" size="40"></td></tr>
	<tr><td><?php echo $admtext['callnumber']; ?>:</td><td><input type="text" name="callnum" size="40"></td></tr>
	<tr><td><?php echo $admtext['publisher']; ?>:</td><td><input type="text" name="publisher" size="40"></td></tr>
	<tr>
		<td><?php echo $admtext['repository']; ?>:</td>
		<td>
			<select name="repoID">
				<option value=""></option>
<?php
$query = "SELECT repoID, reponame, gedcom FROM $repositories_table $wherestr ORDER BY reponame";
$reporesult = tng_query($query);
while( $reporow = tng_fetch_assoc($reporesult) ) {
	if( !$assignedtree && $numtrees > 1 )
		echo "		<option value=\"{$reporow['repoID']}\">{$reporow['reponame']} ({$admtext['tree']}: {$reporow['gedcom']})</option>\n";
	else
		echo "		<option value=\"{$reporow['repoID']}\">{$reporow['reponame']}</option>\n";
}
tng_free_result( $reporesult );
?>
			</select>
		</td>
	</tr>
	<tr><td valign="top"><?php echo $admtext['actualtext']; ?>:</td><td><textarea cols="80" rows="15" name="actualtext"></textarea></td></tr>
