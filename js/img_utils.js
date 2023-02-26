<script type="text/javascript">
var browser;
if (parseInt(navigator.appVersion) > 3) 
    if (navigator.appName == 'Netscape') 
        // Firefox
        if (navigator.userAgent.indexOf('Firefox') != -1) 
            browser = 'ff';

	// Safari
	else if (navigator.userAgent.indexOf('Safari') != -1) 
	    browser = 'safari';

        // Mozilla
        else 
            browser = 'moz';

    // IE
    else if (navigator.appName.indexOf('Microsoft') != -1) 
        browser = 'ie';

    // Opera
    else if (navigator.appName == 'Opera') 
	browser = 'opera';

function calcHeight(maxHeight) {
    var iframe = document.getElementById('iframe1');

    // call the resizer to size the image based on the actual dimensions of the iframe
    iframe.contentWindow.document.getElementById('imgviewer').resize(maxHeight);

    var titleHeight = 0;
    if(iframe.contentWindow.document.getElementById('img_desc'))
    	titleHeight += iframe.contentWindow.document.getElementById('img_desc').clientHeight;  //title
    if(iframe.contentWindow.document.getElementById('img_notes'))
    	titleHeight += iframe.contentWindow.document.getElementById('img_notes').clientHeight;  //description
    if(titleHeight) 
    	titleHeight += 30;  //this is for the space between the title and description paragraphs

    // now that the width of the image has been determined, we can set the height
    imgHeight = iframe.contentWindow.document.getElementById('theimage').height + 60 + titleHeight;

    // set the height of the iframe
    if (maxHeight == 1)
		iframe.height = imgHeight;
    else
		iframe.height = maxHeight + 25;

    // erase the 'please wait' message
    document.getElementById('loadingdiv2').style.display = 'none';
}
</script>