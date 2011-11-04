/**
* Light box for resized images
* (c) DavidIQ 2010-2011
* (c) Tale 2008-2009
* http://www.taletn.com/
* Contributor(s):
* DavidIQ
* http://www.davidiq.com/
*/

var litebox_version = 1.000002; // 1.0.2


// This script is loosely based on Lightbox 2
// <http://www.huddletogether.com/projects/lightbox2/> by Lokesh Dhakar. I
// "loaned" not only the abstract idea and solution, but also a few lines of
// actual code that determine screen dimensions cross-browser, which
// according to the Lightbox 2 source originally came from my favourite
// javascript website: QuirksMode <http://www.quirksmode.org/>.


// To use this script you need to define the following javascript variables
// *before* including this javascript file into your HTML file:
//
// <script type="text/javascript">
// // <![CDATA[
//
// var litebox_alt = "Image";
// 
// var litebox_zoomImg = "./images/spacer.gif";
// var litebox_zoomStyle = "width: 20px; height: 20px; background: url(./styles/prosilver/imageset/icon_reimg_zoom_in.gif) top left no-repeat; filter: Alpha(Opacity=50); opacity: .50;";
// var litebox_zoomHover = "background-position: 0 100%; cursor: pointer; filter: Alpha(Opacity=100); opacity: 1.00;";
// var litebox_zoomAlt = "Zoom in (real dimensions: %1$d x %2$d)";
// 
// var litebox_closeImg = "./images/spacer.gif";
// var litebox_closeStyle = "width: 20px; height: 20px; background: url(./styles/prosilver/imageset/icon_reimg_zoom_out.gif) top left no-repeat; filter: Alpha(Opacity=50); opacity: .50;";
// var litebox_closeHover = "background-position: 0 100%; cursor: pointer; filter: Alpha(Opacity=100); opacity: 1.00;";
// var litebox_closeAlt = "Zoom out";
//
// var litebox_ltr = false; // Left-to-right
// //var litebox_oldStyle = false; // True only for IE 6 (or older)
// //var litebox_newStyle = true; // True only for IE 7, Firefox 3 and Opera 9.5 (or newer)
//
// // ]]>
// </script>
// <script type="text/javascript" src="./styles/litebox.js"></script>
//
// All of these are optional, if you leave them out you will simply get less
// functionality. The latter two will be detected automatically if they are
// not specified.
//
// After having loaded the script, you can show an image in the lightbox by
// calling the litebox_show() function (or if you don't know the width and
// height the litebox_load() function):
//
// if (window.litebox_version)
// 	litebox_show("http://www.taletn.com/rats/lefty/20080421-broccoli.jpg", 600, 450);


// Although this script isn't written for a specific browser, some features
// are for certain browsers and versions only. So that's why we need to find
// out which browser and version we're running.
//
// This browser detection is based on code from my company (Martinic
// <http://www.martinic.com/>), and was used with permission.

var litebox_msie = 0, litebox_firefox = 0, litebox_opera = 0, litebox_safari = 0, litebox_mozilla = 0;

function litebox_detectBrowser()
{
	var browser = window.navigator.userAgent.match(/(^|\W)(MSIE)\s+(\d+)(\.\d+)?/);
	if (!browser)
	{
		browser = window.navigator.userAgent.match(/(^|\W)(Firefox|Opera|Safari)\/(\d+)(\.\d+)?/);
		if (!browser)
		{
			browser = window.navigator.userAgent.match(/(^|\W)(Mozilla)\/[\d.]+\s+\(.*?rv:(\d+)(\.\d+)?.*?\)/);
		}
	}
	if (!browser || browser.length < 5)
	{
		return;
	}
	var version = parseFloat(browser[3] + browser[4]);
	browser = browser[2];

	if (browser == "MSIE")
	{
		litebox_msie = version;
	}
	else if (browser == "Firefox")
	{
		litebox_firefox = version;
	}
	else if (browser == "Opera")
	{
		litebox_opera = version;
	}
	else if (browser == "Safari")
	{
		litebox_safari = version;
	}
	else if (browser == "Mozilla")
	{
		litebox_mozilla = version;
	}
}

litebox_detectBrowser();


// Add default style sheet rules.
//
// Hint: You could define more (other) rules for these class names in your
// template's stylesheet file. If e.g. you want a purple background you
// could add this rule to the stylesheet:
//
// .litebox-background {
// 	background-color: purple;
// }

// Use old style CSS positioning (absolute instead of fixed) for IE <7.
if (typeof(window.litebox_oldStyle) == "undefined")
{
	var litebox_oldStyle = (litebox_msie && litebox_msie < 7.0);
}
if (typeof(window.litebox_newStyle) == "undefined")
{
	var litebox_newStyle = (litebox_msie >= 7.0 || litebox_firefox >= 3.0 || litebox_opera >= 9.5);
}

document.writeln('<style type="text/css" media="screen, projection"><!--');
// The shadowy background.
document.writeln('.litebox-background { position: absolute; top: 0; left: 0; z-index: 98; background-color: black; filter: Alpha(Opacity=80); opacity: .80; }');
// The image.
document.writeln('span.litebox-image { position: '+(litebox_oldStyle ? 'absolute' : 'fixed')+'; z-index: 99; }');
document.writeln('div.litebox-image { position: relative; border: 4px solid white; background-color: white; margin: 24px; }');
document.writeln('img.litebox-image { border: none; '+(window.litebox_style ? ' '+litebox_style : '')+' }');

if (window.litebox_zoomImg || window.litebox_closeImg)
{
	// Detect right-to-left if it's not yet defined.
	if (typeof(window.litebox_rtl) == "undefined")
	{
		litebox_rtl = document.getElementsByTagName("html");
		if (litebox_rtl && litebox_rtl.length == 1 && litebox_rtl[0])
		{
			litebox_rtl = (litebox_rtl[0].dir == "rtl");
		}
		else
		{
			litebox_rtl = false;
		}
	}
	document.writeln('span.litebox-zoom { position: absolute; margin: 1px; }');
	// The zoom button in the top left corner.
	if (window.litebox_zoomImg)
	{
		document.writeln('img.litebox-zoom { margin-'+(litebox_rtl ? 'left' : 'right')+': 1px; border: none !important; cursor: pointer !important;'+(window.litebox_zoomStyle ? ' '+litebox_zoomStyle : '')+' }');
		if (window.litebox_zoomHover)
		{
			document.writeln('img.litebox-zoom:hover { '+litebox_zoomHover+' }');
		}
	}
	// The close button in the top left corner.
	if (window.litebox_closeImg)
	{
		document.writeln('img.litebox-close { border: none !important; cursor: pointer !important;'+(window.litebox_closeStyle ? ' '+litebox_closeStyle : '')+' }');
		if (window.litebox_closeHover)
		{
			document.writeln('img.litebox-close:hover { '+litebox_closeHover+' }');
		}
	}
}
document.writeln('--></style>');


// The background, image and close button elements.
var litebox_background = null, litebox_image, litebox_zoom = null, litebox_closer = null;

// The maximum dimensions of the light box (which correspond to the
// dimensions of the visible part of the browser window).
var litebox_maxWidth, litebox_maxHeight;

// The real dimensions of the current displayed image.
var litebox_imgWidth, litebox_imgHeight;

// The current zoom level.
var litebox_zoomLevel;


// Unhide the image when it has fully loaded.

function litebox_unhide(e)
{
	if (litebox_image.parentNode.parentNode.style.visibility == "hidden")
	{
		litebox_image.parentNode.parentNode.style.visibility = "";
	}
}


// Hide the background and image (including the zoom and close buttons).

function litebox_close(e)
{
	litebox_background.style.display = litebox_image.parentNode.parentNode.style.display = "none";
	return false;
}


// Zoom in to real dimensions, adding scroll bars if necessary.

function litebox_zoomIn()
{
	// Zoom in 1:1.
	if (parseInt(litebox_image.style.width) >= litebox_imgWidth && parseInt(litebox_image.style.height) >= litebox_imgHeight)
	{
		return;
	}
	litebox_image.style.width = litebox_imgWidth+"px";
	litebox_image.style.height = litebox_imgHeight+"px";
	var div = litebox_image.parentNode;
	var span = div.parentNode;
	var border = div.offsetWidth-div.clientWidth;
	div.style.overflow = "auto";
	if (litebox_zoom)
	{
		litebox_zoom.style.display = "none";
	}
	// Fixate the close button.
	if (litebox_closer && litebox_newStyle)
	{
		litebox_closer.style.position = "fixed";
		litebox_closer.style.left = litebox_closer.style.top = "auto";
		litebox_closer.style.display = "none";
		if (typeof(window.setTimeout) != "undefined") // IE 7 fix
		{
			window.setTimeout("litebox_closer.style.display = '';", 1);
		}
		else
		{
			litebox_closer.style.display = "";
		}
	}

	// Maximize the litebox.
	div.style.left = div.style.top = span.style.height = "";
	if (!litebox_oldStyle)
	{
		div.style.width = "auto";
	}
	else
	{
		div.style.width = (litebox_maxWidth-2*litebox_image.parentNode.offsetLeft-border)+"px";
		if (span.offsetWidth > litebox_maxWidth)
		{
			div.style.width = (litebox_maxWidth-(span.offsetWidth-litebox_maxWidth))+"px";
		}
	}
	div.style.height = litebox_maxHeight+"px";
	if (span.offsetHeight > litebox_maxHeight)
	{
		if (litebox_imgHeight > litebox_maxHeight)
		{
			div.style.height = (litebox_maxHeight-(span.offsetHeight-litebox_maxHeight))+"px";
		}
		else
		{
			div.style.height = (litebox_maxHeight-litebox_imgHeight)+"px";
		}
	}
	if (litebox_opera)
	{
		div.style.width = div.clientWidth+"px";
	}

	// If the image is smaller than the maximized litebox then shrink
	// the width of the litebox.
	if (div.clientWidth > litebox_imgWidth)
	{
		div.style.width = litebox_imgWidth+"px";
		if (!litebox_opera)
		{
			div.style.width = (litebox_imgWidth+(litebox_imgWidth-div.clientWidth))+"px";
		}
		div.style.left = Math.floor((span.offsetWidth-div.offsetWidth)/2-div.offsetLeft)+"px";
	}

	// Reset the scroll position.
	if (div.scrollLeft)
	{
		div.scrollLeft = 0;
	}
	if (div.scrollTop)
	{
		div.scrollTop = 0;
	}

	// We're zoomed in all the way now.
	litebox_zoomLevel = 100;
}

function litebox_zoomClick(e)
{
	litebox_zoomIn();

	if (e && typeof(e.stopPropagation) != "undefined")
	{
		e.stopPropagation();
	}
	else if (window.event)
	{
		window.event.cancelBubble = true;
	}
	return false;
}


// Create the background, image and close button elements.

function litebox_init()
{
	if (litebox_background)
	{
		return;
	}

	// Create the background element (div).
	litebox_background = document.createElement("div");
	litebox_background.className = "litebox-background";
	litebox_background.style.display = "none";
	litebox_background.onclick = litebox_close;
	document.body.insertBefore(litebox_background, document.body.firstChild);

	// Create the image elements (span, div and img).
	var image_span = document.createElement("span");
	image_span.style.display = "none";
	image_span.onclick = litebox_close;
	var image_div = document.createElement("div");
	litebox_image = document.createElement("img");
	if (window.litebox_alt)
	{
		litebox_image.alt = litebox_image.title = litebox_alt;
	}
	else
	{
		litebox_image.alt = "";
	}
	litebox_image.className = image_div.className = image_span.className = "litebox-image";
	litebox_image.onload = litebox_image.onerror = litebox_unhide;
	image_div.appendChild(litebox_image);
	image_span.appendChild(image_div);

	// Create the zoom and close button elements (span and 2 x img).
	if (window.litebox_zoomImg || window.litebox_closeImg)
	{
		var zoom_span = document.createElement("span");
		zoom_span.className = "litebox-zoom";
		if (window.litebox_zoomImg)
		{
			litebox_zoom = document.createElement("img");
			litebox_zoom.src = litebox_zoomImg;
			litebox_zoom.alt = "";
			litebox_zoom.className = "litebox-zoom";
			litebox_zoom.onclick = litebox_zoomClick;
			zoom_span.appendChild(litebox_zoom);
		}
		if (window.litebox_closeImg)
		{
			litebox_closer = document.createElement("img");
			litebox_closer.src = litebox_closeImg;
			if (window.litebox_closeAlt)
			{
				litebox_closer.alt = litebox_closer.title = litebox_closeAlt;
			}
			else
			{
				litebox_closer.alt = "";
			}
			litebox_closer.className = "litebox-close";
			zoom_span.appendChild(litebox_closer);
		}
		image_div.insertBefore(zoom_span, litebox_image);
	}

	document.body.appendChild(image_span);
}


// Create the background, image and close button elements, and (re)calculate
// dimensions and positions.

function litebox_calc()
{
	// Determine the visible dimensions of the browser window (the
	// "viewport").
	if (document.documentElement && document.documentElement.clientWidth && document.documentElement.clientHeight && !litebox_opera)
	{
		litebox_maxWidth = document.documentElement.clientWidth;
		litebox_maxHeight = document.documentElement.clientHeight;
	}
	else if (window.innerWidth && window.innerHeight)
	{
		litebox_maxWidth = window.innerWidth;
		litebox_maxHeight = window.innerHeight;
	}
	else
	{
		litebox_maxWidth = document.body.clientWidth;
		litebox_maxHeight = document.body.clientHeight;
	}
	// The image span will get (but not just now) the dimensions of the
	// visible window, so it will exactly fit in the viewport.

  	// Determine the current scroll position within the document.
	var span = litebox_image.parentNode.parentNode;
  	var left, top;
  	if (!litebox_oldStyle)
	{
  		left = top = 0;
	}
  	else if (typeof(window.pageXOffset) != "undefined" && typeof(window.pageYOffset) != "undefined")
	{
		left = window.pageXOffset;
		top = window.pageYOffset;
	}
	else if (document.documentElement && document.documentElement.scrollTop && typeof(document.documentElement.scrollLeft) != "undefined")
	{
		left = document.documentElement.scrollLeft;
		top = document.documentElement.scrollTop;
	}
	else
	{
		left = document.body.scrollLeft;
		top = document.body.scrollTop;
	}
	// Position the image span at the current scroll position.
	span.style.left = left+"px";
	span.style.top = top+"px";

	// Determine the dimensions of the entire document.
	var width, height;
	if (typeof(window.scrollMaxX) != "undefined" && typeof(window.scrollMaxY) != "undefined")
	{
		width = litebox_maxWidth+window.scrollMaxX;
		height = litebox_maxHeight+window.scrollMaxY;
	}
	else if (document.body.scrollHeight >= document.body.offsetHeight)
	{
		width = document.body.scrollWidth;
		height = document.body.scrollHeight;
	}
	else if (document.all && !litebox_opera)
	{
		width = document.body.clientWidth;
		height = document.body.clientHeight;
		if (document.body.offsetHeight > height)
		{
			height = document.body.offsetHeight;
		}

	}
	else
	{
		width = document.body.offsetWidth;
		height = document.body.offsetHeight;
	}
	// Extend the document's dimensions if they are smaller than the
	// browser window.
	if (width < litebox_maxWidth) // Impossible? but harmless
	{
		width = litebox_maxWidth;
	}
	if (height < litebox_maxHeight)
	{
		height = litebox_maxHeight;
	}
	// The background gets the document's dimensions, so a shadow can be
	// cast over the entire document.
	litebox_background.style.width = width+"px";
	litebox_background.style.height = height+"px";
}


// Show an image using the light box, downsize the image if necessary.

function litebox_show(url, width, height, zoomLevel)
{
	litebox_init();
	litebox_calc();

	// Show the background overlay.
	litebox_background.style.display = "";

	// Load the image.
	var div = litebox_image.parentNode;
	var span = div.parentNode;
	if (!litebox_opera)
	{
		span.style.visibility = "hidden";
	}
	div.style.overflow = "";
	litebox_image.src = ""; // Uncache
	litebox_image.src = url;
	if (typeof(window.setTimeout) != "undefined")
	{
		window.setTimeout("litebox_unhide();", 250); // Safety net
	}
	litebox_image.style.width = div.style.width = (litebox_imgWidth = width)+"px";
	litebox_image.style.height = div.style.height = (litebox_imgHeight = height)+"px";
	// Unfixate the close button.
	if (litebox_closer && litebox_newStyle)
	{
		litebox_closer.style.position = litebox_closer.style.left = litebox_closer.style.top = "";
	}
	// Show the image, zoom and close buttons included.
	span.style.display = "";

	// Optionally resize the image.
	span.style.width = span.style.height = div.style.left = div.style.top = "";
	var org = 0;
	if (span.offsetWidth > litebox_maxWidth && width)
	{
		org = width;
		// Opera fix: "+1" or image appears left instead of centered.
		width -= span.offsetWidth-litebox_maxWidth+1;
		height = Math.round(height*width/org);
		litebox_image.style.width = div.style.width = width+"px";
		litebox_image.style.height = div.style.height = height+"px";
	}
	if (span.offsetHeight > litebox_maxHeight && height)
	{
		org = height;
		height -= span.offsetHeight-litebox_maxHeight;
		width = Math.round(width*height/org);
		litebox_image.style.width = div.style.width = width+"px";
		litebox_image.style.height = div.style.height = height+"px";
		if (span.offsetWidth > litebox_maxWidth && width)
		{
			org = width;
			width -= span.offsetWidth-litebox_maxWidth;
			height = Math.round(height*width/org);
			litebox_image.style.width = div.style.width = width+"px";
			litebox_image.style.height = div.style.height = height+"px";
		}
	}
	if (litebox_zoom)
		if (org)
		{
			if (window.litebox_zoomAlt)
			{
				litebox_zoom.alt = litebox_zoom.title = litebox_zoomAlt.replace(/%1\$d/, litebox_imgWidth).replace(/%2\$d/, litebox_imgHeight);
			}
			litebox_zoom.style.display = "";
		}
		else
		{
			litebox_zoom.style.display = "none";
		}

	// As promised in litebox_calc(): The image span gets the dimensions
	// of the visible window, so it will exactly fit in the viewport.
	span.style.width = litebox_maxWidth+"px";
	span.style.height = litebox_maxHeight+"px";
	// Center the litebox.
	div.style.left = Math.floor((span.offsetWidth-div.offsetWidth)/2-div.offsetLeft)+"px";
	div.style.top = Math.floor((span.offsetHeight-div.offsetHeight)/2-div.offsetTop)+"px";

	// Optionally zoom in 1:1.
	litebox_zoomLevel = zoomLevel;
	if (zoomLevel >= 100)
	{
		litebox_zoomIn();
	}
}


// Preloads an image, and shows it in the lightbox after is has fully
// loaded.

function litebox_loaded(e)
{
	litebox_image.onload = litebox_image.onerror = null;
	litebox_show(litebox_image.src, litebox_image.width, litebox_image.height, litebox_zoomLevel);
}

function litebox_error(e)
{
	litebox_image.onload = litebox_image.onerror = null;
	litebox_calc();
	litebox_show(litebox_image.src, Math.floor(litebox_maxWidth/2), Math.floor(litebox_maxHeight/2), litebox_zoomLevel);
}

function litebox_load(url, zoomLevel)
{
	litebox_init();
	litebox_zoomLevel = zoomLevel;

	var div = litebox_image.parentNode;
	var span = div.parentNode;
	if (!litebox_opera)
	{
		span.style.visibility = "hidden";
	}
	div.style.overflow = "";
	litebox_image.style.width = litebox_image.style.height = div.style.width = div.style.height = "";
	span.style.display = "";

	litebox_image.onload = litebox_loaded;
	litebox_image.onerror = litebox_error;
	litebox_image.src = ""; // Uncache
	litebox_image.src = url;
}


// Recalculate dimensions and positions when the browser window is resized.

function litebox_reshow()
{
	litebox_close();
	litebox_show(litebox_image.src, litebox_imgWidth, litebox_imgHeight, litebox_zoomLevel);
}

function litebox_resize(e)
{
	if (!(litebox_background && litebox_background.style.display != "none"))
	{
		return;
	}

	if (typeof(window.setTimeout) != "undefined")
	{
		// MSIE 7? fix: N'm not sure what goes wrong, but this works.
		window.setTimeout("litebox_reshow();", 1);
	}
	else
	{
		litebox_reshow();
	}
}


// Close the light box when a (any) key is pressed.

function litebox_handleKey(e)
{
	if (litebox_background && litebox_background.style.display != "none")
	{
		litebox_close(e);
	}

	return true;
}


// Install resize and key press event handlers.
if (typeof(window.addEventListener) != "undefined") // DOM
{
	window.addEventListener("resize", litebox_resize, false);
	document.addEventListener("keydown", litebox_handleKey, false);
}
else if (typeof(window.attachEvent) != "undefined") // MSIE
{
	window.attachEvent("onresize", litebox_resize);
	document.attachEvent("onkeydown", litebox_handleKey);
}