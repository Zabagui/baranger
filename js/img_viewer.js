// global settings
// by default, the background around the image will match the body color defined in your
// style sheet.  If you want this to be different, just define the color here
var canvasBackground = 'transparent';

// global variables
var lastLeft, lastTop, lastX, lastY;
var magzoom = 3;  // default zoom is 50% (for +/- usage)
var haveZoomed = false;

// don't modify these unless you're changing images
var shadowPadding = 17;
var magnifierSize = 150;

function popUp(URL, type, height, width) {
    var options;
    if (type == 'console') options = "resizable,scrollbars,width="+width;
    if (type == 'fixed') options = "status,width="+width;
    if (type == 'elastic') options = "toolbar,menubar,scrollbars,resizable,location,width="+width;

    // open the image in a new window... we put it in _blank so that we don't keep writing new images into the
    // same window
    window.open(URL, '_blank', options);
}

function determinePanning() {
    // if the user has set the height of the window, let's see if we can pan
    if (this.bodyh > 0) {
	if (this.height > this.bodyh) {
	    this.canPan = true;
	    this.panV = true;
	}
	else {
	    this.canPan = false;
	    this.panV = false;
	}
    }
    else {
	this.canPan = false;
	this.panV = false;
    }

    if (this.width <= this.bodyw) 
	this.panH = false;
    else {
	this.panH = true;
	this.canPan = true;
    }
}

function MagnifierPosition() {
    var half = this.size / 2;

    // determine position of the magnifier
    // -1s here to account for the border
    this.style.left = Math.round(this.xPosition - 1 - half) + 'px';
    this.style.top = Math.round(this.yPosition - 1 - half) + 'px';

    // determine position of the shadow
    this.shadow.style.left = Math.round(this.xPosition - half - shadowPadding) + 'px';
    this.shadow.style.top = Math.round(this.yPosition - half - shadowPadding) + 'px';
    
    // determine the coordinates that we want to magnify onto
	var canvas = document.getElementById('imageviewer');
	var halfcanv = Math.round(canvas.offsetWidth / 2);

	var theimage = document.getElementById('theimage');
	var halfimg = Math.round(theimage.offsetWidth / 2);

    var magnifierCenterX = Math.round((this.xPosition - lastLeft - halfcanv + halfimg) * this.xMultiplier - half);
    var magnifierCenterY = Math.round((this.yPosition - lastTop - 10) * this.yMultiplier - half);
	    
    this.style.backgroundPosition = -magnifierCenterX + 'px ' + -magnifierCenterY + 'px';
}

// handles pushing the zoom level up button
function ControllerMagUp(e) {
    var sel = this.parentNode.zoomsel;
    // removed this... but it requires that magzoom *always* be set correctly
    //if (sel.selectedIndex == 0 || sel.selectedIndex == 1) {
	//magzoom = this.parentNode.canvas.origZoom;
    //}

    magzoom += 1;
    if (magzoom == 10) magzoom = 9;

    checkZoomLevel(magzoom, this.parentNode);
    sel.selectedIndex = magzoom;
    ZoomImage(sel.options[sel.selectedIndex].value, this.parentNode.canvas);
    haveZoomed = true;

    // if the zoom is 100% or greater, we need to force pan mode
    if (magzoom >= 5) {
	this.parentNode.buttonPan.onclick();
    }
}

// handles pushing the zoom level down button
function ControllerMagDown(e) {
    var sel = this.parentNode.zoomsel;
    if (sel.selectedIndex == 0 || sel.selectedIndex == 1) {
	magzoom = this.parentNode.canvas.origZoom;
    }

    if (haveZoomed) 
	magzoom -= 1;
    if (magzoom <= 1) magzoom = 2;

    checkZoomLevel(magzoom, this.parentNode);
    sel.selectedIndex = magzoom;
    ZoomImage(sel.options[sel.selectedIndex].value, this.parentNode.canvas);
    haveZoomed = true;
}

// handles hitting the 'pan mode' button
function ControllerPanMode(e) {
    // set our cursor and canvas mode
    var img = this.parentNode.canvas.image;
    if (navigator.appName == 'Netscape') {
	img.style.cursor = '-moz-grab';
    }
    else {
	img.style.cursor = 'pointer';
    }
    this.parentNode.canvas.mode = 'pan';

    // enable/disable the buttons as appropriate
    this.parentNode.buttonMag.className = 'controllerMag';
    this.className = 'controllerPanSelected';
    this.parentNode.msg.innerHTML = pan_msg;

    scaleImageMap(this.parentNode.canvas);
}

// handles hitting the magnifier button
function ControllerMagMode(e) {
    if (this.enabled == true) {
	var img = this.parentNode.canvas.image;
	img.style.cursor = 'crosshair';
	this.parentNode.canvas.mode = 'mag';

	this.parentNode.buttonPan.className = 'controllerPan';
	this.className = 'controllerMagSelected';
	this.parentNode.msg.innerHTML = magnifyreg_msg;

	clearImageMap();
    }
}

function ControllerNewWin(e) {
    canvas = document.getElementById('imageviewer');
    var width = canvas.image.fitWidth > 600 ? canvas.image.fitWidth : 600;
    popUp(imgnewwin_url+"mediaID="+this.mediaID+"&medialinkID="+this.medialinkID+"&title="+this.newwintitle, 'console', 0, width);
}

function clearImageMap() {
    map = document.getElementById('imgMapViewer');
    for (var i = 0; i < map.areas.length; i++) {
	area = map.areas[i];
	var coords = area.coords.split(',');
	var newCoords = new Array;
	for (var j = 0; j < coords.length; j++) {
	    newCoords.push(0);
	}
	area.coords = newCoords.join(',');
    }
}

function scaleImageMap(canvas) {
    // we only support the image map if you are in pan mode
    if (canvas.mode == "pan") {
    	map = document.getElementById('imgMapViewer');
    	if (canvas.zoom == 0 || canvas.zoom == -1) {
    	    zoom = canvas.image.height / canvas.image.fullHeight;
    	}
    	else {
    	    zoom = canvas.zoom;
    	}
    	for (var i = 0; i < map.areas.length; i++) {
    	    area = map.areas[i];
    	    var coords = new Array;
    	    coords = canvas.origmap[i].split(',');
    	    var newCoords = new Array;
    	    for (var j = 0; j < coords.length; j++) {
    		newCoords.push(Math.floor(coords[j] * zoom));
    	    }
    	    area.coords = newCoords.join(',');
    	}
        var tags = canvas.tags;
        if(tags) {
            var newFontSize = tags.origFontSize * zoom;
            if(zoom < .75) 
                newFontSize = 8;
            else if(zoom < 1)
                newFontSize = 10;
            else if(zoom < 1.5)
                newFontSize = 12;
            else
                newFontSize = 14;
            tags.style.fontSize = newFontSize + 'px';
            var overhang, side;
            for(var i = 0; i < tags.childNodes.length; i++) {
                tag = tags.childNodes[i];
                tag.style.width = (tag.origWidth * zoom) + 'px';
                tag.style.height = (tag.origHeight * zoom) + 'px';
                tag.style.left = (tag.origLeft * zoom) + 'px';
                tag.style.top = ((tag.origTop - canvas.offset) * zoom + canvas.offset) + 'px';
                label = tag.childNodes[0];
                label_top = (tag.origHeight * zoom) + 1;
                label.style.top = label_top + 'px';
                overhang = 100 - parseInt(tag.origWidth * zoom);
                if(overhang > 0) {
                    side = -1 * Math.round(overhang/2);
                    label.style.left = side + 'px';
                    label.style.right = side + 'px';
                } 
            }
        }
    }
}

// zooms in on the image, based on the zoom value passed in.
function ZoomImage(zoom, canvas) {
    var img = canvas.image;
    var tmpzoom = 0;

    // this is the fit width option
    if (zoom == 0) {
	img.width = img.fitWidth;
	img.height = img.fitHeight;
	tmpzoom = img.bodyw / img.fullWidth;
	if (tmpzoom > 1) tmpzoom = 1;
    }

    // this is the fit height option
    else if (zoom == -1) {
	tmpzoom = img.bodyh / img.fullHeight;
	if (tmpzoom > 1) tmpzoom = 1;
	img.width = img.fullWidth * tmpzoom;
	img.height = img.fullHeight * tmpzoom;
    }
    
    // otherwise we already know the zoom level
    else {
	img.width = img.fullWidth * zoom;
	img.height = img.fullHeight * zoom;
    }
    // update our magzoom level
    if (tmpzoom > 0) {
	if	(tmpzoom < 0.25) magzoom = 1
	else if (tmpzoom < 0.50) magzoom = 2
	else if (tmpzoom < 0.75) magzoom = 3
	else if (tmpzoom < 1) magzoom = 4
	else magzoom = 5;
    }
    var tags = canvas.tags;
    if(tags) {
        tags.style.width = img.width + 'px';
        tags.style.height = img.height + 'px';
        tags.style.top = '38px';
        tags.style.left = 0;
    }

    img.findPan();

    // realign at the top left
	//lastLeft = -1 * Math.round(img.width/2);
	//img.style.left = lastLeft + 'px';
	//lastTop = -1 * Math.round((img.fullHeight - img.height)/2);
	//img.style.top = lastTop + 'px';
    img.style.left = img.style.top = '0px';
    lastLeft = lastTop = 0;
    
    var mag = canvas.magnifier;
    mag.xMultiplier = img.fullWidth / img.width;
    mag.yMultiplier = img.fullHeight / img.height;

    // need to modify the image map
    canvas.zoom = zoom;
    scaleImageMap(canvas);
}

// handles enabling/disabling zoom options depending on the current zoom level
function checkZoomLevel(level, controller) {
    // we need to disable the zoom up button now
    if (magzoom == 9) {
	controller.magup.src = cmstngpath + 'img/img_magupoff.gif';
	controller.magdown.src = cmstngpath + 'img/img_magdown.gif';
    }
    else if (magzoom == 2) {
	controller.magdown.src = cmstngpath + 'img/img_magdownoff.gif';
	controller.magup.src = cmstngpath + 'img/img_magup.gif';
    }
    else {
	controller.magdown.src = 'img/img_magdown.gif';
	controller.magup.src = cmstngpath + 'img/img_magup.gif';
    }

    if (magzoom > 4) {
	controller.buttonMag.src = cmstngpath + 'img/img_magoff.gif';
	controller.buttonMag.enabled = false;
    }
    else {
	controller.buttonMag.src = cmstngpath + 'img/img_mag.gif';
	controller.buttonMag.enabled = true;
    }
}

// handles the drop down box to select a zoom level
function ControllerZoomLevel(e) {
    var sel = this.parentNode.zoomsel;
    magzoom = sel.selectedIndex;
    checkZoomLevel(magzoom, this.parentNode);
    ZoomImage(sel.options[sel.selectedIndex].value, this.parentNode.canvas);
}

// this is called after the iframe has been filled out to allow for the proper 
// width and height of the image to be done
// we pass in the specified height of the frame as we need to know that information
// and it isn't available to us yet since the iframe isn't done being sized
// if frameHeight comes in as '1', the height of the iframe should be the height
// of the image
function sizeController(frameHeight) {
    canvas = document.getElementById('imageviewer');
    img = canvas.image;
    controllerContainer = document.getElementById('ctrlcontainer');
    enableContainer = document.getElementById('encontainer');
	
    // determine the height and width of our iframe first
    var subOffset = true;
    img.bodyw = document.body.offsetWidth;

    // if the frame height is specified, we can go ahead and set the height
    if (frameHeight > 1) {
	img.bodyh = frameHeight;
    }

    // now lets do one final resize of the image now that we know the actual iframe width
    zoom = img.bodyw / img.fullWidth;
    //zoom = (img.bodyh - canvas.offsetTop) / img.fullHeight;
    if (zoom > 1) {
	zoom = 1;
    }
    canvas.zoom = zoom;
    img.origZoom = zoom;
    img.width = Math.round(img.fullWidth * zoom);
    img.height = Math.round(img.fullHeight * zoom);
    img.fitWidth = img.width;
    img.fitHeight = img.height;
    var tags = canvas.tags;
    if(tags) {
        tags.style.width = img.width + 'px';
        tags.style.height = img.height  + 'px';
        tags.style.top = '38px';
        tags.style.left = 0;
    }
    
    if (frameHeight == 1) {
	subOffset = false;
	img.bodyh = img.height;
    }
    canvas.style.height = img.bodyh;

    // determine if we want to show the controller
    var showController = true;
    //if (img.origZoom == 1 && img.height <= img.bodyh) {
	//showController = false;
    //}

    if (!showController) {
	controllerContainer.style.display = "none";
	enableContainer.style.display = "";
    }
    else {
	enableContainer.style.display = "none";
	controllerContainer.style.display = "";
    }
    if (subOffset == true) img.bodyh -= canvas.offsetTop;

    // configure magnifier
    var mag = canvas.magnifier;
    mag.xMultiplier = img.fullWidth / img.width;
    mag.yMultiplier = img.fullHeight / img.height;

    // if we are zoomed in at 100%, let's say so
    if (zoom == 1) {
	document.getElementById('zoomsel').selectedIndex = 5;
	magzoom = 5;
	haveZoomed = true;
    }

    // otherwise, let's set our magzoom to the right value
    else {
	if	(zoom < 0.25) magzoom = 1
	else if (zoom < 0.50) magzoom = 2
	else if (zoom < 0.75) magzoom = 3
	else if (zoom < 1) magzoom = 4;
    }
    canvas.origZoom = magzoom;
    
    magimg = document.getElementById('buttonMag');
    if (zoom == 1) {
	magimg.enabled = false;
	magimg.src = cmstngpath + 'img/img_magoff.gif';
    }
    else {
	magimg.enabled = true;
	magimg.src = cmstngpath + 'img/img_mag.gif';
    }
    img.findPan();
    scaleImageMap(canvas);
}

// Creates the actual imageViewer object in the iframe
// Parameters:
//   fullWidth - original width of the image
//   fullHeight - original height of the image
//   standalone - running in its own window?
//   mediaID, medialinkID, title - link info for the image
function imageViewer(baseID, imgURL, fullWidth, fullHeight, standalone, mediaID, medialinkID, title, rectangles) {
    var base = document.getElementById(baseID);

    // create the image viewer itself
    var canvas = document.createElement('div');
    canvas.zoom = 1;
    canvas.id = 'imageviewer';
    canvas.className = 'canvas';
    //canvas.style.position = 'absolute';
    //canvas.style.overflow = 'hidden';
    //canvas.style.backgroundColor = canvasBackground;
    //canvas.style.backgroundImage = 'url(' + cmstngpath + 'img/bg.gif)';
    //canvas.style.width = '99.8%';
    canvas.beingDragged = false;
    canvas.mode = 'pan';
    lastLeft = lastTop = 0;
    if (standalone == true) {
        canvas.offset = 100;  //height of title at top of page
    }
    else {
        canvas.offset = 0;
    }

    if(rectangles.length) {
        var tags = document.createElement('div');

        tags.id = "tags";
        tags.style.width = fullWidth + 'px';
        tags.style.height = fullHeight + 'px';
        tags.origFontSize = 12;
        tags.style.fontSize = "12px";

        var box, label, label_top, overhang, side;
        for(var i=0; i < rectangles.length; i++) {
            rect = rectangles[i];

            label = document.createElement('div');
            label.className = "imagetag";
            label_top = parseInt(rect.height) + 1;
            label.style.top = label_top + 'px';
            //label.style.visibility = 'hidden';
            label.innerHTML = rect.text;
            overhang = 100 - parseInt(rect.width);
            if(overhang > 0) {
                side = -1 * Math.round(overhang/2);
                label.style.left = side + 'px';
                label.style.right = side + 'px';
            } 

            box = document.createElement('div');
            box.id = 'box_' + rect.id;
            box.className = "mlbox bunselected";
            if(rect.link)
                box.className += " pubbox";
            box.style.position = 'absolute';
            box.style.top = rect.top + 'px';
            box.style.left = rect.left + 'px';
            box.style.width = rect.width + 'px';
            box.style.height = rect.height + 'px';
            box.style.opacity = '0';
            box.origTop = rect.top;
            box.origLeft = rect.left;
            box.origWidth = rect.width;
            box.origHeight = rect.height;
            box.personid = rect.personid;
            box.tree = rect.tree;
            box.link = rect.link;
            box.onmouseover = handleTagMouseOver;
            box.onmouseout = handleTagMouseOut;
            box.onclick = handleTagClick;
            box.appendChild(label);
            tags.appendChild(box);
        }
    }

    // define the image
    var img = document.createElement('img');
    img.id = 'theimage';
    img.src = imgURL;
    img.useMap = '#imgMapViewer';
    img.style.position = 'relative';
    img.style.border = '0';
    img.style.left = img.style.top = '0px';
    if (navigator.appName == 'Netscape') {
	img.style.cursor = '-moz-grab';
    }
    else {
	img.style.cursor = 'pointer';
    }
    // these are just dummy values... we'll set the correctly later
    img.width = 1;
    img.height = 1;
    img.fitWidth = 1;
    img.fitHeight = 1;
    img.fullWidth = fullWidth;
    img.fullHeight = fullHeight;
    img.findPan = determinePanning;
    img.origZoom = 1;

 
    canvas.image = img;

    if(rectangles.length) {
        canvas.tags = tags;
        canvas.appendChild(tags);
    }
    //canvas.appendChild(test);

    // get the original coordinates for any image map
    var map = document.getElementById('imgMapViewer');
    canvas.origmap = new Array();
    for (var i = 0; i < map.areas.length; i++) {
    	area = map.areas[i];
    	canvas.origmap[i] = area.coords;
    	if (standalone == true) {
    	    area.target = '_blank';
    	}
    	else {
    	    area.target = '_parent';
    	}
    }

    // the magnifier
    var magnifier = document.createElement('div');
    magnifier.id = 'Magnifier';
    magnifier.className = 'magnifier';
    // dummy values to be setup later
    magnifier.xMultiplier = 1;
    magnifier.yMultiplier = 1;
    magnifier.size = magnifierSize;
    magnifier.style.backgroundImage = 'url(' + imgURL + ')';
    magnifier.position = MagnifierPosition;
    magnifier.style.display = "none";
    canvas.magnifier = magnifier;
	
    // controller
    var controller = document.createElement('span');
    controller.id = 'imgViewerController';
    controller.className = 'controller';
    controller.style.width = '100%';
	
    // controller - pan button
    var pan = document.createElement('img');
    pan.id = 'buttonPan';
    pan.className = 'controllerPanSelected';
    pan.src = cmstngpath + 'img/img_select.gif';
    pan.title = panmode_msg;
    pan.alt = panmode_msg;
    pan.onclick = ControllerPanMode;
    controller.appendChild(pan);
    controller.buttonPan = pan;

    var break1 = document.createElement('img');
    break1.className = 'breakLine';
    break1.src = cmstngpath + 'img/img_break.png';
    controller.appendChild(break1);

    // controller - magnify down button
    var magdown = document.createElement('img');
    magdown.id = 'magdown';
    magdown.className = 'controllerImage';
    magdown.src = cmstngpath + 'img/img_magdown.gif';
    magdown.onclick = ControllerMagDown;
    magdown.title = zoomout_msg;
    magdown.alt = zoomout_msg;
    controller.appendChild(magdown);
    controller.magdown = magdown;

    // controller - magnify up button
    var magup = document.createElement('img');
    magup.id = 'magup';
    magup.className = 'controllerImage';
    magup.src = cmstngpath + 'img/img_magup.gif';
    magup.onclick = ControllerMagUp;
    magup.title = zoomin_msg;
    magup.alt = zoomin_msg;
    controller.appendChild(magup);
    controller.magup = magup;

    // controller - zoom levels
    var sel = document.createElement('select');
    sel.id = 'zoomsel';
    sel.className = 'zoomSelector';
    var opt1 = document.createElement('option'); opt1.text = fw_msg; opt1.value = 0;
    var opt2 = document.createElement('option'); opt2.text = fh_msg; opt2.value = -1;
    var opt3 = document.createElement('option'); opt3.text = '25%'; opt3.value = 0.25;
    var opt4 = document.createElement('option'); opt4.text = '50%'; opt4.value = 0.50;
    var opt5 = document.createElement('option'); opt5.text = '75%'; opt5.value = 0.75;
    var opt6 = document.createElement('option'); opt6.text = '100%'; opt6.value = 1;
    var opt7 = document.createElement('option'); opt7.text = '125%'; opt7.value = 1.25;
    var opt8 = document.createElement('option'); opt8.text = '150%'; opt8.value = 1.5;
    var opt9 = document.createElement('option'); opt9.text = '175%'; opt9.value = 1.75;
    var opt10 = document.createElement('option'); opt10.text = '200%'; opt10.value = 2;
    // there goes DOM compliance in IE!
    if (document.all) {
	sel.add(opt1);
	sel.add(opt2);
	sel.add(opt3);
	sel.add(opt4);
	sel.add(opt5);
	sel.add(opt6);
	sel.add(opt7);
	sel.add(opt8);
	sel.add(opt9);
	sel.add(opt10);
    }
    else {
	sel.add(opt1, null);
	sel.add(opt2, null);
	sel.add(opt3, null);
	sel.add(opt4, null);
	sel.add(opt5, null);
	sel.add(opt6, null);
	sel.add(opt7, null);
	sel.add(opt8, null);
	sel.add(opt9, null);
	sel.add(opt10, null);
    }
    sel.onchange = ControllerZoomLevel;

    controller.appendChild(sel);
    controller.zoomsel = sel;

    // controller - magnifier button
    var magimg = document.createElement('img');
    magimg.id = 'buttonMag';
    magimg.className = 'controllerMag';
    magimg.onclick = ControllerMagMode;
    magimg.title = magmode_msg;
    magimg.alt = magmode_msg;
    controller.appendChild(magimg);
    controller.buttonMag = magimg;

    if (standalone == false) {
	// controller - second break line
	var break2 = document.createElement('img');
	break2.className = 'breakLine';
	break2.src = cmstngpath + 'img/img_break.png';
	controller.appendChild(break2);

	// controller - new window button
	var newbtn = document.createElement('button');
	newbtn.className = 'controllerButton';
	newbtn.innerHTML = nw_msg;
	newbtn.imgURL = escape(imgURL);
	newbtn.mediaID = mediaID;
	newbtn.medialinkID = medialinkID;
	newbtn.newwintitle = title;
	newbtn.title = opennw_msg;
	newbtn.onclick = ControllerNewWin;
	controller.appendChild(newbtn);

	// uncomment these lines for debug statements
	//var debug = document.createElement('span');
	//debug.innerHTML = "DEBUG: "+canvas.offsetTop;
	//debug.id = "debug";
	//controller.appendChild(debug);
    }

    // provide some status info
    // controller - third? break line
    var break3 = document.createElement('img');
    break3.className = 'breakLine';
    break3.src = cmstngpath + 'img/img_break.png';
    controller.appendChild(break3);
    var msg = document.createElement('span');
    msg.innerHTML = pan_msg;
    msg.className = 'controllerText';
    msg.id = "msg";
    controller.appendChild(msg);
    controller.msg = msg;

    // shadow
    var shadow = document.createElement('div');
    shadow.id = 'MagnifierShadow';
    shadow.className = 'magnifierShadow';
    shadow.style.display = 'none';
    magnifier.shadow = shadow;
	
    // point objects at each other
    canvas.controller = controller;
    controller.canvas = canvas;
	
    // Controller container... gives us some control over the visual of this area
    var controllerContainer = document.createElement('div');
    controllerContainer.id = 'ctrlcontainer';
    controllerContainer.className = 'controllerContainer';
    controllerContainer.style.display = "none";
    controllerContainer.style.height = "36px";

    var enableContainer = document.createElement('div');
    enableContainer.id = 'encontainer';
    enableContainer.style.backgroundColor = canvasBackground;
    //enableContainer.style.backgroundImage = 'url(' + cmstngpath + 'img/bg.gif)';
    enableContainer.style.height = "36px";

    // put a button at the bottom to turn on/off the controller
    var onoffbtn = document.createElement('button');
    onoffbtn.className = 'controllerButton';
    onoffbtn.innerHTML = imgctrls_msg;
    onoffbtn.title = vwrctrls_msg;
    onoffbtn.onclick = function() {
    	enableContainer.style.display = "none";
    	controllerContainer.style.display = "";
        if(rectangles.length)
            tags.style.display = "";
    }
    enableContainer.appendChild(onoffbtn);

    // controller - close button
    var closeimg = document.createElement('img');
    closeimg.id = 'buttonClose';
    closeimg.className = 'controllerClose';
    closeimg.title = close_msg;
    closeimg.alt = close_msg;
    closeimg.src = cmstngpath + 'img/img_close.gif';
    closeimg.onclick = function() {
	enableContainer.style.display = "";
	controllerContainer.style.display = "none";
    if(rectangles.length)
        tags.style.display = "none";

	// need to shrink (or expand) the image to fit height (which will 
	// automatically fit width if they are running with height=1)
	ZoomImage(0, canvas);
	controller.zoomsel.selectedIndex = 1;
    }
    controllerContainer.appendChild(closeimg);
    controllerContainer.appendChild(controller);

    canvas.appendChild(img);
    canvas.appendChild(shadow);
    canvas.appendChild(magnifier);

    base.appendChild(enableContainer);
    base.appendChild(controllerContainer);
    base.appendChild(canvas);

    base.resize = sizeController;

    // install our mouse handlers
    canvas.onmousedown = handleMouseDown;
    canvas.onmousemove = handleMouseMove;
    canvas.onmouseup = handleMouseUp;

    //scaleImageMap(canvas);

    return this;
}

function handleTagMouseOver(e) { 
    this.style.opacity = '1';
    //this.childNodes[0].style.visibility = 'visible';
}

function handleTagMouseOut(e) { 
    this.style.opacity = typeof(parent.toggle_off) == 'undefined' ? 0 : parent.toggle_off;
    //this.childNodes[0].style.visibility = 'hidden';
}

function handleTagClick(e) {
    if(this.link)
        parent.location.href = this.link;
}

// the following three functions are the mouse handlers for panning around the image
function handleMouseUp(e) { 
    this.beingDragged = false;
    if (this.mode == 'pan') {
	// save these so we don't need to compute it later
	var img = this.image;
        lastLeft = parseInt(img.style.left);
        lastTop  = parseInt(img.style.top);

	if (navigator.appName == 'Netscape') {
	    img.style.cursor = '-moz-grab';
	}
    }
    else {
	var mag = this.magnifier;
	mag.shadow.style.display = 'none';
	mag.style.display = 'none';
    }
}

function handleMouseDown(e){
    e = e || event;

    var img = this.image;

    // pan mode
    if (this.mode == 'pan') {
	if (img.canPan) { 
	    this.beingDragged = true; 
	    lastLeft = parseInt(img.style.left);
	    lastTop  = parseInt(img.style.top);
	    lastX = e.clientX;
	    lastY = e.clientY;
	}

	// Mozilla offers a nice grabbing hand, let's do it...
	if (navigator.appName == 'Netscape') {
	    img.style.cursor = '-moz-grabbing';
	}
    }

    // magnify mode
    else {
	this.beingDragged = true;
	var mag = this.magnifier;
	mag.startX = e.clientX;
	mag.startY = e.clientY;

	// the starting position of the magnifier... this places our cursor
	// right in the middle of the magnifier
	mag.xPosition = mag.startX;
	mag.yPosition = mag.startY - this.offsetTop;

	var shadow = mag.shadow;
	var shadowSize = mag.size + 2 * shadowPadding;
	    
	//// MSIE 5.x/6.x must be treated specially in order to make them use the PNG alpha channel
	var shadowImageSrc = cmstngpath + 'img/img_shadow.png';
	if (shadow.runtimeStyle)
	    shadow.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + shadowImageSrc + "', sizingMethod='scale')";
	else
	    shadow.style.backgroundImage = 'url(' + shadowImageSrc + ')';
	shadow.style.width = shadowSize + 'px';
	shadow.style.height = shadowSize + 'px';
	shadow.style.display = 'block';

	// msie counts the border as being part of the width
	if (mag.runtimeStyle) 
	    mag.size += 2;
	    
	mag.style.width = mag.size + 'px';
	mag.style.height = mag.size + 'px';
	mag.style.display = 'block';
	mag.position();

    }
    return false;
}
  
function handleMouseMove(e){
    e = e || event;
    
    if (this.beingDragged) {
	if (this.mode == 'pan') {
	    var img = this.image;
        var tags = this.tags;
	    if (img.canPan) {

    		// compute top and left coordinates
    		var top = lastTop + (e.clientY - lastY);
    		if (top > 0) { top = 0; }
    		var left = lastLeft + (e.clientX - lastX);
    		if (left > 0) { left = 0; }

    		if (img.panH == true) 
    		    if (img.width + left < img.bodyw) { left = img.bodyw - img.width; }

    		if (img.panV == true) 
    		    if (img.height + top < img.bodyh) { top = img.bodyh - img.height; }
    		//document.getElementById('debug').innerHTML = 'DEBUG: ('+top+')('+img.width+')('+img.height+')('+img.bodyw+')('+img.bodyh+')('+this.offsetTop+')';

    		// pan the image
    		if (img.panV) { 
                img.style.top  = top + 'px'; 
                if(tags)
                    tags.style.top = (top + 38) + 'px';
            }
    		if (img.panH) { 
                img.style.left = left + 'px'; 
                if(tags)
                    tags.style.left = left + 'px';
            }
	    }
	}
	else {
	    var magnifier = this.magnifier;
	    magnifier.xPosition += e.clientX - magnifier.startX;
	    magnifier.yPosition += e.clientY - magnifier.startY;
		    
	    magnifier.startX = e.clientX;
	    magnifier.startY = e.clientY;
		
	    magnifier.position();
	}
    }
    return false;
}