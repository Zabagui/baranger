jQuery(document).ready(init);
jQuery(window).resize(onResize);

var tl;
function init() {
    Timeline.GregorianDateLabeller.prototype.labelPrecise = function(tdate) {
        dateStr = "";
        return dateStr;
    }
	timeline_init();
}

function timeline_init() {
	var famEventSource = new Timeline.DefaultEventSource();
	var eventSource = new Timeline.DefaultEventSource();

    var theme = Timeline.ClassicTheme.create();

	var bandInfos = [
		Timeline.createBandInfo({
			eventSource:    famEventSource,
			date:           tlstartdate,
			width:          band1_pct,
			intervalUnit:   Timeline.DateTime.DECADE,
			intervalPixels: band1_interval,
			multiple: band1_multiple,
			layout: 'overview',
			theme: theme
		}),
		Timeline.createBandInfo({
			eventSource:    famEventSource,
			date:           tlstartdate,
			width:          band2_pct,
			intervalUnit:   Timeline.DateTime.YEAR,
			intervalPixels: band2_interval,
			multiple: band2_multiple,
			layout: 'original',
			theme: theme
		}),
		Timeline.createBandInfo({
			eventSource:    eventSource,
			date:           tlstartdate,
			width:          band3_pct,
			intervalUnit:   Timeline.DateTime.YEAR,
			intervalPixels: band3_interval,
			multiple: band3_multiple,
			layout: 'original',
			theme: theme
		}),
		Timeline.createBandInfo({
			eventSource:    eventSource,
			date:           tlstartdate,
			width:          band4_pct,
			intervalUnit:   Timeline.DateTime.DECADE,
			intervalPixels: band3_interval,
			multiple: band4_multiple,
			layout: 'overview',
			theme: theme
		})
	];
	bandInfos[0].syncWith = 1;
	bandInfos[0].highlight = true;
    bandInfos[2].syncWith = 1;
    bandInfos[3].syncWith = 2;
    bandInfos[3].highlight = true;

	tl = Timeline.create(document.getElementById("tngtimeline"), bandInfos);
	Timeline.loadXML(xmlfamfile, function(xml, url) { 
		famEventSource.loadXML(xml, url); 
	});
	Timeline.loadXML(xmleventfile, function(xml, url) { 
		eventSource.loadXML(xml, url); 
	});
}

var resizeTimerID = null;
function onResize() {
	if (resizeTimerID == null) {
		resizeTimerID = window.setTimeout(function() {
			resizeTimerID = null;
			tl.layout();
		}, 500);
	}
}