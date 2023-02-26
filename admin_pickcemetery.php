<?php
include("begin.php");
include("adminlib.php");
$textpart = "findplace";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

header("Content-type:text/html; charset=" . $session_charset);

$query = "SELECT cemeteryID, cemname, city, county, state, country FROM $cemeteries_table WHERE place = \"\" ORDER BY country, state, county, city, cemname";
$result = tng_query($query);
?>

<div class="databack ajaxwindow" id="cemdiv">
<?php
if(tng_num_rows($result)) {
?>
	<h1 class="subhead"><strong><?php echo $admtext['choosecem']; ?></strong></h1>
	<p><?php echo $admtext['cemsavail']; ?></p>
	<form action="" name="findcemetery" id="findcemetery" onsubmit="return addCemLink(this.cemeteryID.options[this.cemeteryID.selectedIndex].value);">
	<table border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td>
				<select name="cemeteryID" id="cemeteryID">
					<option value=""></option>
	<?php
		while( $cemrow = tng_fetch_assoc($result) ) {
			$location = $cemrow['country'];
			if($cemrow['state']) {
				if($location) $location .= ", ";
				$location .= $cemrow['state'];
			}
			if($cemrow['county']) {
				if($location) $location .= ", ";
				$location .= $cemrow['county'];
			}
			if($cemrow['city']) {
				if($location) $location .= ", ";
				$location .= $cemrow['city'];
			}
			if($cemrow['cemname']) {
				if($location) $location .= ", ";
				$location .= $cemrow['cemname'];
			}
			echo "<option value=\"{$cemrow['cemeteryID']}\">$location</option>\n";
		}
	?>
				</select>
			</td>
			<td><input type="submit" value="<?php echo $admtext['go']; ?>"></td>
		</tr>
	</table>
	</form>
<?php
}
else {
?>
	<p><?php echo $admtext['nocemsavail']; ?></p>
<?php
}
tng_free_result($result);
?>	
</div>