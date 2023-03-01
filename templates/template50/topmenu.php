<?php 
    global $text, $cms, $subroot, $tmp; 

    $dadlabel = getTemplateMessage('t10_dadside');
    $momlabel = getTemplateMessage('t10_momside');
?>
<style>
div.art-headerobject {
  background-image: url('<?php echo $cms['tngpath'] . $templatepath . $tmp['t10_headimg']; ?>');
  background-repeat: no-repeat;
  width: 420px;
  height: 150px;
}
</style>
<body id="bodytop" class="<?php echo pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME); ?>">
<div id="art-main">
    <div class="cleared reset-box"></div>
    <div id="art-header-bg">
        <div class="art-header-center">
            <div class="art-header-jpeg"></div>
        </div>
    </div>
    <div class="cleared"></div>
    <div id="art-hmenu-bg">
    	<div class="art-nav-l"></div>
    	<div class="art-nav-r"></div>
    </div>
    <div class="cleared"></div>
    <div class="art-sheet">
        <div class="art-sheet-tl"></div>
        <div class="art-sheet-tr"></div>
        <div class="art-sheet-bl"></div>
        <div class="art-sheet-br"></div>
        <div class="art-sheet-tc"></div>
        <div class="art-sheet-bc"></div>
        <div class="art-sheet-cl"></div>
        <div class="art-sheet-cr"></div>
        <div class="art-sheet-cc"></div>
        <div class="art-sheet-body">
            <div class="art-header">
                <div class="art-header-clip">
                <div class="art-header-center">
                    <div class="art-header-jpeg"></div>
                </div>
                </div>
                <div class="art-headerobject"></div>
                <div class="art-logo">
                                 <h1 class="art-logo-name"><a href="<?php echo $cms['tngpath']; ?>index.php"><?php echo getTemplateMessage('t10_maintitle'); ?></a></h1>
                                                 <h2 class="art-logo-text"><?php echo getTemplateMessage('t10_headsubtitle'); ?></h2>
                                </div>
            </div>
            <div class="cleared reset-box"></div>
<div class="art-nav">
	<div class="art-nav-l"></div>
	<div class="art-nav-r"></div>
<div class="art-nav-outer">
	<ul class="art-hmenu">
<?php
    if($dadlabel) {
?>
		<li>
			<a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t10_dadperson']; ?>&amp;tree=<?php echo $tmp['t10_dadtree']; ?>"><span class="l"></span><span class="t"><?php echo $dadlabel; ?></span></a>
		</li>
<?php       
    }
    if($momlabel) {
?>
		<li>
			<a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t10_momperson']; ?>&amp;tree=<?php echo $tmp['t10_momtree']; ?>"><span class="l"></span><span class="t"><?php echo $momlabel; ?></span></a>
		</li>
<?php       
    }
?>
		<li>
			<a href="<?php echo $cms['tngpath']; ?>suggest.php?page=<?php echo urlencode(str_replace("?", "", $title)); ?>"><span class="l"></span><span class="t"><?php echo $text['contactus']; ?></span></a>
		</li>
	</ul>
</div>
</div>
<div class="cleared reset-box"></div>
<div class="art-content-layout">
                <div class="art-content-layout-row">
                    <div class="art-layout-cell art-content">
<div class="art-post">
    <div class="art-post-body">