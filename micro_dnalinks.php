<?php
	if( empty($tngconfig) ) exit;
	$linkrows = "";
	$usetree = $row['gedcom'];
	if( $result2 ) {
		$oldlinks = 0;
		while( $plink = tng_fetch_assoc( $result2 ) )
		{
			$oldlinks++;
			$rights = determineLivingPrivateRights($plink);
			$plink['allow_living'] = $rights['living'];
			$plink['allow_private'] = $rights['private'];
			$name = getName( $plink );

			$linkrows .= "<tr id=\"alink_{$plink['mlinkID']}\"><td class=\"lightback\" align=\"center\">";
			$linkrows .= "<a href=\"#\" title=\"{$admtext['removelink']}\" onclick=\"return deleteDnaLink({$plink['mlinkID']});\" class=\"smallicon admin-delete-icon\"></a>";
			$linkrows .= "</td>\n";
			$linkrows .= "<td class=\"lightback normal\">$name ({$plink['personID']})&nbsp;</td>\n";
			$linkrows .= "<td class=\"lightback normal\">{$plink['treename']}</td></tr>\n";
		}
		tng_free_result($result2);
	}
?>
	<div id="links" style="margin:0px;padding-top:12px">
	<table cellspacing="2">
		<tr>
			<td class="normal"><?php echo $admtext['tree']; ?></td>
			<td class="normal" colspan="3"><?php echo $admtext['id']; ?></td>
		</tr>
		<tr>
			<td>
				<select name="tree1" id="microtree">
<?php
				for( $j = 1; $j <= $treenum; $j++ ) {
					echo "	<option value=\"{$trees[$j]}\"";
					if($trees[$j] == $usetree) echo " selected";
					echo ">$treename[$j]</option>\n";
				}
?>
				</select>
			</td>
			<td><input type="text" name="newlink1" id="newlink" value="" onkeypress="return newlinkEnter(findform,this,event);"></td>
			<td class="normal"><input type="button" value="<?php echo $admtext['add']; ?>" onclick="return addDnaLink(findform);"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;</td>
			<td><a href="#" onclick="return findItem('I','newlink',null,findform.tree1.options[findform.tree1.selectedIndex].value,'<?php echo $assignedbranch; ?>');" title="<?php echo $admtext['find']; ?>" class="smallicon admin-find-icon"></a></td>
		</tr>
	</table>
	<div id="alink_error" style="display:none;" class="normal red"></div>

	<p class="normal">&nbsp;<strong><?php echo $admtext['existlinks']; ?>:</strong> <?php echo $admtext['eloptions']; ?></p>
	<table cellpadding="3" cellspacing="1" id="linktable" class="normal rounded-table">
	<tbody>
		<tr>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['name'] . " (" . $admtext['id'] . ")"; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['tree']; ?></b>&nbsp;</td>
		</tr>
<?php
	echo $linkrows;
?>
	</tbody>
	</table>
	<div id="nolinks" class="normal" style="margin-left:3px">
<?php
	if(!$oldlinks) echo $admtext['nolinks'];
?>
	</div>
	</div>
