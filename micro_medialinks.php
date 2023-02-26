<?php
	$linkrows = "";
	$usetree = $row['gedcom'];
	if( $result2 ) {
		$oldlinks = 0;
		while( $plink = tng_fetch_assoc( $result2 ) )
		{
			$oldlinks++;
			if(!$usetree) $usetree = $plink['gedcom'];
			if( $plink['linktype'] === "F" ) {
				$plink['husband'] = $plink['hpersonID'];
				$plink['wife'] = $plink['wpersonID'];
			}
			$rights = determineLivingPrivateRights($plink);
			$plink['allow_living'] = $rights['living'];
			$plink['allow_private'] = $rights['private'];
			if( $plink['personID2'] != NULL ) {
				$type = "person";
				$entityID = $plink['personID'];
				$id = " ($entityID)";
				$name = getName( $plink );
				$linktype = "I";
			}
			elseif( $plink['familyID'] != NULL ) {
				$type = "family";
				$husb['firstname'] = $plink['hfirstname'];
				$husb['lnprefix'] = $plink['hlnprefix'];
				$husb['lastname'] = $plink['hlastname'];
				$husb['prefix'] = $plink['hprefix'];
				$husb['suffix'] = $plink['hsuffix'];
				$husb['title'] = $plink['htitle'];
				$husb['nameorder'] = $plink['hnameorder'];
				$husb['allow_living'] = $husb['allow_private'] = 1;
				$name = getName( $husb );

				$wife['firstname'] = $plink['wfirstname'];
				$wife['lnprefix'] = $plink['wlnprefix'];
				$wife['lastname'] = $plink['wlastname'];
				$wife['prefix'] = $plink['wprefix'];
				$wife['suffix'] = $plink['wsuffix'];
				$wife['title'] = $plink['wtitle'];
				$wife['nameorder'] = $plink['wnameorder'];
				$wife['allow_living'] = $wife['allow_private'] = 1;
				$wifename = getName( $wife );

				if( $wifename ) {
					if( $name ) $name .= ", ";
					$name .= $wifename;
				}
				$entityID = $plink['familyID'];
				$id = " ($entityID)";
				$linktype = "F";
			}
			elseif( $plink['sourceID'] != NULL ) {
				$type = "source";
				$entityID = $plink['sourceID'];
				$id = " ($entityID)";
				$name = truncateIt($plink['sourcetitle'],100);
				$linktype = "S";
			}
			elseif( $plink['citationID'] != NULL ) {
				$type = "citation";
				$entityID = $plink['citationID'];
				$id = " ($entityID)";

				//look up title from source table
				$query = "SELECT title FROM $sources_table as s, $citations_table as c WHERE citationID = \"$entityID\" AND c.gedcom = s.gedcom AND c.sourceID = s.sourceID";
				$resultc = tng_query($query);
				$rowc = tng_fetch_assoc($resultc);
				tng_free_result($resultc);				

				$name = truncateIt($rowc['title'],100);
				$linktype = "C";
			}
			elseif( $plink['repoID'] != NULL ) {
				$type = "repository";
				$entityID = $plink['repoID'];
				$id = " ($entityID)";
				$name = truncateIt($plink['reponame'],100);
				$linktype = "R";
			}
			else { //place
				$type = "place";
				$entityID = $name = $plink['personID'];
				$id = "";
				$linktype = "L";
			}

			$dchecked = $plink['defphoto'] ? " checked=\"checked\"" : "";
			$schecked = $plink['dontshow'] ? "" : " checked=\"checked\"";
			$alttext = $plink['altdescription'] || $plink['altnotes'] ? $admtext['yes'] : "&nbsp;";

			include("eventmicro.php");

			$linkrows .= "<tr id=\"alink_{$plink['mlinkID']}\"><td class=\"lightback\" align=\"center\">";
			$linkrows .= "<a href=\"#\" title=\"{$admtext['edit']}\" onclick=\"return editMedia2EntityLink({$plink['mlinkID']});\" title=\"{$admtext['edit']}\" class=\"smallicon admin-edit-icon\"></a>";
			$linkrows .= "<a href=\"#\" title=\"{$admtext['removelink']}\" onclick=\"return deleteMedia2EntityLink({$plink['mlinkID']});\" title=\"{$admtext['removelink']}\" class=\"smallicon admin-delete-icon\"></a>";
			$linkrows .= "</td>\n";
			$linkrows .= "<td class=\"lightback normal\">" . $admtext[$type] . "</td><td class=\"lightback normal\" id=\"sort_{$plink['mlinkID']}\">$name$id";
			if($linktype != "C")
				$linkrows .= " (<a href=\"admin_ordermedia.php?tree1={$plink['gedcom']}&amp;linktype1=$linktype&amp;mediatypeID=$mediatypeID&amp;newlink1=$entityID&amp;event1=$eventID\">{$admtext['text_sort']}</a>)";
			$linkrows .= "&nbsp;</td>\n";
			$linkrows .= "<td class=\"lightback normal\">{$plink['treename']}</td>\n";
			$linkrows .= "<td class=\"lightback normal\" id=\"event_{$plink['mlinkID']}\">$eventstr&nbsp;</td>\n";
			$linkrows .= "<td class=\"lightback normal\" align=\"center\" id=\"alt_{$plink['mlinkID']}\">$alttext</td>\n";
			$linkrows .= "<td class=\"lightback normal\" align=\"center\" id=\"def_{$plink['mlinkID']}\">";
			if($linktype != "C")
				$linkrows .= "<input type=\"checkbox\" name=\"defc{$plink['mlinkID']}\" id=\"defc{$plink['mlinkID']}\" onclick=\"toggleDefault(this,'{$plink['gedcom']}','$entityID');\" value=\"1\"$dchecked\"/>";
			$linkrows .= "</td>\n";
			$linkrows .= "<td class=\"lightback normal\" align=\"center\" id=\"show_{$plink['mlinkID']}\"><input type=\"checkbox\" name=\"show{$plink['mlinkID']}\" id=\"show{$plink['mlinkID']}\" onclick=\"toggleShow(this);\" value=\"1\"$schecked\"/></td></tr>\n";
		}
		tng_free_result($result2);
	}
?>
	<div id="links" style="margin:0px;padding-top:12px">
	<table cellspacing="2">
		<tr>
			<td class="normal"><?php echo $admtext['tree']; ?></td>
			<td class="normal"><?php echo $admtext['linktype']; ?></td>
			<td class="normal" colspan="2"><?php echo $admtext['id']; ?></td>
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
			<td>
				<select name="linktype1">
					<option value="I"><?php echo $admtext['person']; ?></option>
					<option value="F"><?php echo $admtext['family']; ?></option>
					<option value="S"><?php echo $admtext['source']; ?></option>
					<option value="R"><?php echo $admtext['repository']; ?></option>
					<option value="C"><?php echo $admtext['citation']; ?></option>
					<option value="L"><?php echo $admtext['place']; ?></option>
				</select>
			</td>
			<td><input type="text" name="newlink1" id="newlink" value="" onkeypress="return newlinkEnter(findform,this,event);"></td>
			<!--<td class="normal"><input type="submit" value="<?php echo $admtext['add']; ?>"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;
			<input type="button" value="<?php echo $admtext['find']; ?>" name="find1" onClick="findopen=true;openFind(document.find.linktype1.options[document.find.linktype1.selectedIndex].value);$('newlines').innerHTML=resheremsg;"></td>-->
			<td class="normal"><input type="button" value="<?php echo $admtext['add']; ?>" onclick="return addMedia2EntityLink(findform);"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;</td>
			<td><a href="#" onclick="return findItem(findform.linktype1.options[findform.linktype1.selectedIndex].value,'newlink',null,findform.tree1.options[findform.tree1.selectedIndex].value,'<?php echo $assignedbranch; ?>','m_<?php echo $mediaID; ?>');" title="<?php echo $admtext['find']; ?>" class="smallicon admin-find-icon"></a></td>
		</tr>
	</table>
	<div id="alink_error" style="display:none;" class="normal red"></div>

	<p class="normal">&nbsp;<strong><?php echo $admtext['existlinks']; ?>:</strong> <?php echo $admtext['eloptions']; ?></p>
	<table cellpadding="3" cellspacing="1" id="linktable" class="normal rounded-table">
	<tbody>
		<tr>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['linktype']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['name'] . ", " . $admtext['id']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['tree']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['event']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['alttd']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['defphoto']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['show']; ?></b>&nbsp;</td>
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
