<?php
include("begin.php");
$tngconfig['maint'] = "";
include("adminlib.php");
$textpart = "setup";
//include("getlang.php");
include("$mylanguage/admintext.php");

$maintenance_mode = true;
include("checklogin.php");
include("version.php");

tng_adminheader( $admtext['maintmode'], '' );
?>
</head>

<?php
	echo tng_adminlayout();
?>
<div width="100%" class="lightback">
	<div style="padding:10px" class="databack normal">
	<p class="plainheader"><?php echo $admtext['maintmode']; ?></p>

	<p class="normal"><?php echo $admtext['maintexp']; ?>
	</p><br /><br />
	</div>
</div>
<?php 
echo tng_adminfooter();
?>