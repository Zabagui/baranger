<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow" id="finddiv">
	<span class="subhead"><strong><?php echo $admtext['addlinks']; ?></strong></span><br/>
	<form name="find2" id="find2" style="margin-top:0px" onsubmit="return getPotentialLinks('<?php echo $linktype; ?>');">
<?php
	if($linktype == "I") {
?>
	<table cellspacing="2" id="findformI">
		<tr><td colspan="2" class="normal"><br /><strong><?php echo $admtext['findpersonid']; ?></strong> <span class="smaller">(<?php echo $admtext['enterinamepart']; ?>)</span></td></tr>
		<tr>
			<td class="normal"><?php echo $admtext['lastname']; ?></td>
			<td class="normal"><?php echo $admtext['firstname']; ?></td>
		</tr>
		<tr>
			<td><input type="text" name="mylastname" id="mylastname"></td>
			<td>
				<input type="text" name="myfirstname" id="myfirstname">
				<input type="submit" name="searchbutton" value="<?php echo $admtext['search']; ?>" class="aligntop">
				<span id="spinnerfind" style="display:none"><img src="img/spinner.gif" /></span>
			</td>
		</tr>
	</table>
<?php
	}
	elseif($linktype == "F") {
?>
	<table cellspacing="2" id="findformF">
		<tr><td colspan="2" class="normal"><br /><strong><?php echo $admtext['findfamilyid']; ?></strong> <span class="smaller">(<?php echo $admtext['enterfnamepart']; ?>)</span></td></tr>
		<tr>
			<td class="normal"><?php echo $admtext['husbname']; ?></td>
			<td class="normal"><?php echo $admtext['wifename']; ?></td>
		</tr>
		<tr>
			<td><input type="text" name="myhusbname" id="myhusbname"></td>
			<td>
				<input type="text" name="mywifename" id="mywifename">
				<input type="submit" name="searchbutton" value="<?php echo $admtext['search']; ?>" class="aligntop">
				<span id="spinnerfind" style="display:none"><img src="img/spinner.gif" /></span>
			</td>
		</tr>
	</table>
<?php
	}
	elseif($linktype == "S") {
?>
	<table cellspacing="2" id="findformS">
		<tr><td colspan="2" class="normal"><br /><strong><?php echo $admtext['findsourceid']; ?></strong> <span class="smaller">(<?php echo $admtext['entersourcepart']; ?>)</span></td></tr>
		<tr><td class="normal"><?php echo $admtext['title2']; ?></td></tr>
		<tr>
			<td>
				<input type="text" name="mysourcetitle" id="mysourcetitle">
				<input type="submit" name="searchbutton" value="<?php echo $admtext['search']; ?>" class="aligntop">
				<span id="spinnerfind" style="display:none"><img src="img/spinner.gif" /></span>
			</td>
		</tr>
	</table>
<?php
	}
	elseif($linktype == "R") {
?>
	<table cellspacing="2" id="findformR">
		<tr><td colspan="2" class="normal"><br /><strong><?php echo $admtext['findrepoid']; ?></strong> <span class="smaller">(<?php echo $admtext['enterrepopart']; ?>)</span></td></tr>
		<tr><td class="normal"><?php echo $admtext['title2']; ?></td></tr>
		<tr>
			<td>
				<input type="text" name="myrepotitle" id="myrepotitle">
				<input type="submit" name="searchbutton" value="<?php echo $admtext['search']; ?>" class="aligntop">
				<span id="spinnerfind" style="display:none"><img src="img/spinner.gif" /></span>
			</td>
		</tr>
	</table>
<?php
	}
	elseif($linktype == "L") {
?>
	<table cellspacing="2" id="findformL">
		<tr><td colspan="2" class="normal"><br /><strong><?php echo $admtext['findplace']; ?></strong> <span class="smaller">(<?php echo $admtext['enterplacepart']; ?>)</span></td></tr>
		<tr><td class="normal"><?php echo $admtext['place']; ?></td></tr>
		<tr>
			<td>
				<input type="text" name="myplace" id="myplace">
				<input type="submit" name="searchbutton" value="<?php echo $admtext['search']; ?>" class="aligntop">
				<span id="spinnerfind" style="display:none"><img src="img/spinner.gif" width="16" height="16" /></span>
			</td>
		</tr>
	</table>
<?php
	}
?>
	</form>
	<div id="newlines" style="width:605px;height:390px;overflow:auto"></div><br />
</div>
