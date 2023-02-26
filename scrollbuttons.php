<?php
// Author - Steven Davis
$scrdelay = 20;
$scrreset = 90;
// Variables for scroll button behavior
$scrollmode = 0;
$scroll_hide = 0;
$noindexpage = 0;
$scroll_delay = 20;
$scroll_adjuster = 95;

// Pages that DO NOT display four scroll buttons
// Note: pages in this array are ignored by the $scr_all array
$scroll_none = array(
// add or delete files below this line
'bookmarks.php',
'browsebranches.php',
'browsetrees.php',
'cemeteries.php',
'famsearchform.php',
'firstnames.php',
'firstnames100.php',
'gedform.php',
'login.php',
'places.php',
'places-oneletter.php',
'relateform.php',
'reports.php',
'search.php',
'searchform.php',
'searchsite.php',
'statistics.php',
'suggest.php',
// add or delete files above this line
);

// Pages that display six scroll buttons that scroll vertically and horizontally
// Pages listed below have priority and always display when the inner menu loads
$scroll_all = array(
// add or delete files below this line
'descend.php',
'pedigree.php',
);
// add or delete files above this line

if (($scroll_delay < 0) || ($scroll_delay > 800)) $scroll_delay = $scrdelay;
if (($scroll_adjuster < 10) || ($scroll_adjuster > 100)) $scroll_adjuster = $scrreset;
$scrpageaccess = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

if (in_array($scrpageaccess, $scroll_none)) {
	$no_btn_pages = 1;
}

if (($noindexpage) && ($scrpageaccess == 'index.php')){
	$no_btn_pages = 1;
}

if (in_array($scrpageaccess, $scroll_all)) {
	$show_all_btns= 1;
} else {
	$show_all_btns= 0;
}
?>

<style>
.scroll-container {
	z-index: 10;
	display: block;
	position: fixed;
	transform: translate3d(0,0,0);
	right: 2%;
	bottom: 4%;
}

.scroll_show {
	display: block;
}

.toggle-buttons {
	display: none;
	opacity: 1.0;
	transition: opacity 300ms;
}

.scale_svg {
	height: 26px;
}

.scrbtn-offset {
	margin-left: 18px;
}

.scrbtn {
	margin-bottom: 8px;
	border-radius: 50%;
	padding: 4px;
	background-color: #555555;
	opacity: 0.2;
	transition: opacity 300ms;
}

.scrbtn:hover {
	background-color: #555555;
	opacity: 1;
}

.menu-label {
	z-index: 99;
}
</style>

<script type="text/javascript">'use strict';
window.addEventListener("load", pageFullyLoaded, false);

function pageFullyLoaded(e) {
	jQuery("a").scroll(function() {
	event.preventDefault();
	});
	if (jQuery(document).height() > jQuery(window).height()) {
		jQuery('.scroll-container').css('display', 'block')
	} else {
		jQuery('.scroll-container').css('display', 'none')
	}
	window.onscroll = function() { show_buttons() };
}

function pgtop() {
	jQuery('html,body').animate({ scrollTop: 0 }, 'slow',
	function() { return false; });
}

function pgup() {
	var y = jQuery(window).scrollTop() - jQuery(window).height() * (<?php echo $scroll_adjuster; ?>) / 100;
	jQuery("html,body").animate({ scrollTop: y }, 'slow',
	function() { return false; });
}

function pgleft() {
	var x = jQuery('#outer').scrollLeft() - jQuery(window).width() * 0.7;
	jQuery('#outer').animate({ scrollLeft: x }, 'slow',
		function() { return false; });
}

function pgright() {
	var x = jQuery('#outer').scrollLeft() + jQuery(window).width() * 0.7;
	jQuery('#outer').animate({ scrollLeft: x }, 'slow',
		function() { return false; });
}

function pgdown() {
	var y = jQuery(window).scrollTop() + jQuery(window).height() * (<?php echo $scroll_adjuster; ?>) /100;
	jQuery("html,body").animate({ scrollTop: y }, 'slow',
	function() { return false; });
}

function pgend() {
	jQuery("html,body").animate({
		scrollTop: document.body.scrollHeight }, 'slow',
		function() { return false; });
}

function show_buttons() {
	if (document.body.scrollTop > <?php echo $scroll_delay; ?> || document.documentElement.scrollTop > <?php echo $scroll_delay; ?>) {
		jQuery('.toggle-buttons').css('display', 'block')
	} else {
		jQuery('.toggle-buttons').css('display', 'none')
	}
}
</script>

<div class="scroll-container">
	<?php if ($scrollmode) { ?><div class="toggle-buttons">
	<?php } else { ?><div class="scroll_show">
		<?php } if ((!$scroll_hide) && (!$no_btn_pages)) { ?>
			<div><input type="image" src="img/top.svg" class="scale_svg scrbtn-offset scrbtn" onclick="pgtop()"/></div>
			<div><input type="image" src="img/up.svg" class="scale_svg scrbtn-offset scrbtn" onclick="pgup()"/></div>
			<?php if ($show_all_btns) { ?>
			<div><input type="image" src="img/left.svg" class="scale_svg scrbtn" onclick="pgleft()"/>
				<input type="image" src="img/right.svg" class="scale_svg scrbtn" onclick="pgright()"/></div>
			<?php } ?>
			<div><input type="image" src="img/down.svg" class="scale_svg scrbtn-offset scrbtn" onclick="pgdown()"/></div>
			<div><input type="image" src='img/end.svg' class="scale_svg scrbtn-offset scrbtn" onclick="pgend()"/></div>
			<?php }
			elseif ($show_all_btns) { ?>
			<div><input type="image" src="img/top.svg" class="scale_svg scrbtn-offset scrbtn" onclick="pgtop()"/></div>
			<div><input type="image" src="img/up.svg" class="scale_svg scrbtn-offset scrbtn" onclick="pgup()"/></div>
			<div><input type="image" src="img/left.svg" class="scale_svg scrbtn" onclick="pgleft()"/>
				<input type="image" src="img/right.svg" class="scale_svg scrbtn" onclick="pgright()"/></div>
			<div><input type="image" src="img/down.svg" class="scale_svg scrbtn-offset scrbtn" onclick="pgdown()"/></div>
			<div><input type="image" src='img/end.svg' class="scale_svg scrbtn-offset scrbtn" onclick="pgend()"/></div>
			<?php } ?>
		</div>
</div>