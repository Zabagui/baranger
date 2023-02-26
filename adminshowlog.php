<?php
include("begin.php");
include("adminlib.php");
$textpart = "login";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

require($subroot . "logconfig.php");

if( $adminmaxloglines )
	$loglines = $adminmaxloglines;
else 
	$loglines = "";

tng_adminheader( $admtext['adminlogfile'], "" );
if(!isset($selected_user)) $selected_user = "";

$query = "SELECT username, realname FROM $users_table ORDER BY username";
$result = tng_query($query);
?>
</head>

<?php
	echo tng_adminlayout();
?>
<div class="admin-main" style="border-radius:20px">
	<div class="databack admin-block">
	<p class="plainheader"><?php echo "$loglines " . $admtext['mostrecentactions']; ?></p>
	<form action="adminshowlog.php" method="post"  id="form1" name="form1">
	<?php echo $admtext['user']; ?>:
	<select name="selected_user" id="selected_user">
		<option value=""></option>
<?php
while( $row = tng_fetch_assoc($result) ) {
	echo "		<option value=\"{$row['username']}\"";
	if($selected_user == $row['username'])
		echo " selected=\"selected\"";
	echo ">{$row['username']} | {$row['realname']}</option>\n";
}
?>
	</select>
	<input type="submit" name="submit" value="<?php echo $admtext['go']; ?>" class="aligntop">
	</form>
	<br/>
	<table cellpadding="3" cellspacing="1" border="0" class="normal rounded-table">	
		<tr><td class="fieldnameback fieldname" colspan="3"><?php echo $admtext['mostrecentactions']; ?></td></tr>
<?php
	$lines = file( $adminlogfile );
	
	foreach ( $lines as $line ) {
		if(!$selected_user || strpos($line,$selected_user . " |") !== false) {
			if(strpos($line,"<tr>") !== 0)
				echo "<tr><td colspan=\"3\" class=\"lightback\">$line</td></tr>\n";
			else
				echo "$line\n";
		}
	}
?>			
	</table>
	</div>
</div>
	
<?php 
echo tng_adminfooter();
?>