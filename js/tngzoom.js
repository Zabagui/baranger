const elem = document.getElementById('vcontainer');
const zoomIn = document.getElementById('zoom-in');
const zoomOut = document.getElementById('zoom-out');
const zoomReset = document.getElementById('zoom-reset');
var magIcons = $('#mag-icons-div');
var outer = $('#outer');
if(typeof zoomstep == 'undefined')
	zoomstep = 0.2;
const panzoom = Panzoom(elem, {step: zoomstep});
const parent = elem.parentElement;
//parent.addEventListener('wheel', panzoom.zoomWithWheel);
zoomIn.addEventListener('click', panzoom.zoomIn)
zoomOut.addEventListener('click', panzoom.zoomOut)
zoomReset.addEventListener('click', panzoom.reset)

$(window).scroll(function () {
	var diff = outer.offset().top - $(window).scrollTop();
	//console.log('outer: ' + outer.offset().top + ' win: ' + $(window).scrollTop() + ' diff: ' + diff);
	var hasClass = magIcons.hasClass('mag-fixed');
	if(diff < 102 && !hasClass) {
		magIcons.addClass("mag-fixed");
	} 
	else if(diff > 40 && hasClass) {
		magIcons.removeClass("mag-fixed");
	}
});