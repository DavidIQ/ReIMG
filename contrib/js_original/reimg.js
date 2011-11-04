/**
* Resize too large images
* (c) DavidIQ 2010-2011
* (c) Tale 2008-2009
* http://www.taletn.com/
* Contributor(s):
* DavidIQ
* http://www.davidiq.com/
*/

var reimg_version = 1.000005; // 1.0.5

/* To use this script you need to define the following javascript variables
*before* including this javascript file into your HTML file:

<script type="text/javascript">
// <![CDATA[
var reimg_maxWidth = 640, reimg_maxHeight = 480, reimg_relWidth = 0;
var reimg_swapPortrait = true;

var reimg_loadingImg = "./images/spacer.gif";
var reimg_loadingStyle = "width: 16px; height: 16px; background: url(./styles/prosilver/imageset/icon_reimg_loading.gif) top left no-repeat;";
var reimg_loadingAlt = "Loading...";

var reimg_zoomImg = "./images/spacer.gif";
var reimg_zoomStyle = "width: 20px; height: 20px; background: url(./styles/prosilver/imageset/icon_reimg_zoom_in.gif) top left no-repeat; filter: Alpha(Opacity=50); opacity: .50;";
var reimg_zoomHover = "background-position: 0 100%; cursor: pointer; filter: Alpha(Opacity=100); opacity: 1.00;";
var reimg_zoomAlt = "Zoom in (real dimensions: %1$d x %2$d)";
var reimg_zoomTarget = "_blank";
	
function reimg(img, width, height)
{
	if (window.reimg_version)
	{
		reimg_resize(img, width, height);
	}
}
// ]]>
</script>
<script type="text/javascript" src="./reimg/reimg.js"></script>

All of the variables are optional, if you leave them out you will simply get
less functionality.

After having loaded the script, you can route images through it using the
onload and onerror events:

<img src="http://www.taletn.com/rats/lefty/menu-huge.jpg" class="reimg" onload="reimg(this);" onerror="reimg(this);" />
*/


/* Automatically generate stylesheet rules to prehide and then resize
images.

Hint: You could define more (other) rules for these class names in your
template's stylesheet file. If e.g. you want to give all resized images a
red border you could add this rule to your stylesheet:

.reimg-width, .reimg-height, .reimg-rel, .reimg-both { border: 2px solid red; }
*/
document.writeln('<style type="text/css" media="screen, projection"><!--');

// Hide images that may need to be resized until they've loaded. Opera'
// doesn't like "display: none" here, hence the 1x1 hidden style, which is
// almost the same anyway.)
document.writeln('.reimg { width: 1px; height: 1px; visibility: hidden; }');

// Resize images.
if (window.reimg_maxWidth)
{
	document.writeln('.reimg-width { width: ' + reimg_maxWidth + 'px; height: auto; vertical-align: top; }');
	if (window.reimg_swapPortrait)
	{
		document.writeln('.reimg-width-portrait { width: auto; height: ' + reimg_maxWidth + 'px; }');
	}
}
if (window.reimg_maxHeight)
{
	document.writeln('.reimg-height { width: auto; height: ' + reimg_maxHeight + 'px; }');
	if (window.reimg_swapPortrait)
	{
		document.writeln('.reimg-height-portrait { width: ' + reimg_maxHeight + 'px; height: auto; }');
	}
}
//document.writeln('.reimg-both { }');
if (window.reimg_relWidth)
{
	document.writeln('.reimg-rel { width: ' + reimg_relWidth + '%; height: auto; }');
	//if (window.reimg_swapPortrait)
	//	document.writeln('.reimg-rel-portrait { }');
	//document.writeln('.reimg-rel-force { }');
}

// Link the resized picture to the original original sized picture.
if (window.reimg_autoLink)
{
	document.writeln('.reimg-link { cursor: pointer !important; }');
}

// Put the zoom image in the top left corner.
if (window.reimg_zoomImg)
{
	document.writeln('span.reimg-zoom { position: absolute; margin: 1px; }');
	document.writeln('img.reimg-zoom { border: none !important; cursor: pointer !important;' + (window.reimg_zoomStyle ? ' ' + reimg_zoomStyle : '') + ' }');
	if (window.reimg_zoomHover)
	{
		document.writeln('img.reimg-zoom:hover { ' + reimg_zoomHover + ' }');
	}
}

// The optional "loading..." image, which is displayed while the actual
// image is still loading.
document.writeln('.reimg-loading { border: none !important;' + (window.reimg_loadingStyle ? ' ' + reimg_loadingStyle : '') +' }');

document.write('--></style>');


// Older Opera versions can cause a "blinking images loop", so we need to
// know Opera's version number.
var reimg_opera = 0;
if (window.opera && window.navigator && window.navigator.userAgent)
{
	var reimg_opera_match = window.navigator.userAgent.match(/\bOpera\/([\d.]+)/);
	if (reimg_opera_match)
	{
		reimg_opera = reimg_opera_match[1];
	}
}

// Determine MSIE version.  IE9 is way different...
var reimg_msie = 0;
if (window.navigator && window.navigator.userAgent)
{
	var reimg_msie_match = window.navigator.userAgent.match(/\bMSIE ([\d.]+)/);
	if (reimg_msie_match)
	{
		reimg_msie = reimg_msie_match[1];
	}
}

// Show the original sized picture when the zoom image is clicked.
var reimg_zoomLink = null;
var reimg_realSize = new Array();

function reimg_zoomIn(e)
{
	if (!e)
	{
		e = window.event;
	}
	target = this;
	if (e)
	{
		if (target == window)
		{
			target = e.target ? e.target : e.srcElement;
		}
		if (typeof(e.stopPropagation) != "undefined")
		{
			e.stopPropagation();
		}
		else
		{
			e.cancelBubble = true;
		}
	}
	if (!target)
	{
		return false;
	}

	// Create a dummy <a href="..."> element.
	if (!reimg_zoomLink)
	{
		reimg_zoomLink = document.createElement("a");
		reimg_zoomLink.style.display = "none";
		if (window.reimg_zoomTarget == "_blank")
		{
			try
			{
				reimg_zoomLink.target = "_blank";
			}
			catch (err)
			{
			}
		}
		document.body.appendChild(reimg_zoomLink);
	}
	// Where did the click come from?
	if (target.className.match(/(^|\s)reimg-zoom(\s|$)/))
	{
		// The click came from the zoom button.
		reimg_zoomLink.href = target.parentNode.nextSibling.src;
	}
	else
	{
		// The click came from the image itself.
		reimg_zoomLink.href = target.src;
	}

	// Open the image in a new window.
	if (window.reimg_zoomTarget == "_blank")
	{
		if (reimg_zoomLink.target && typeof(reimg_zoomLink.click) != "undefined")
		{
			reimg_zoomLink.click();
		}
		else
		{
			window.open(reimg_zoomLink.href);
		}

	}
	// Open the image in a litebox.
	else if (window.reimg_zoomTarget == "_litebox" && window.litebox_version)
	{
		var width, height;
		if (reimg_realSize[reimg_zoomLink.href])
		{
			width = reimg_realSize[reimg_zoomLink.href][0];
			height = reimg_realSize[reimg_zoomLink.href][1];
		}
		else
		{
			width = target.parentNode.nextSibling.width;
			height = target.parentNode.nextSibling.height;
		}
		litebox_show(reimg_zoomLink.href, width, height, window.reimg_zoomLevel);
	}
	// Open the image using highslide.
	else if (window.reimg_zoomTarget == "_highslide" && window.hs)
	{
		return hs.expand(reimg_zoomLink);
	}
	// Open the image using Lytebox
	else if (window.reimg_zoomTarget == "_lytebox" && myLytebox)
	{
		reimg_zoomLink.setAttribute("rel", "lytebox");
		return myLytebox.start(reimg_zoomLink, false, false);
	}
	// Open the image as if it were any normal URL, ...
	else
	{
		window.location.href = reimg_zoomLink.href;
	}

	return false;
}


/* Resize an image that has just finished loading using these two methods:

1. Setting the CSS class name (reimg-width, reimg-height or reimg-both)
   which may already resize it automatically.
2. Setting the image's width and height attributes, which will resize it for
   sure.

Method 1 takes precedence over 2, although both are always applied. Method 1
won't work if both width and height are too large, but method 2 will.

This function can also be "forced" upon an image by specifying the original
width and/or height, e.g.:

<img src="image.jpg" style="width: 320px;" onload="reimg(this, 640);" onerror="reimg(this);" />

If the maximum image width is smaller than 320, then the image would still
be resized. Because 320 is smaller than 640, a zoom button will appear. If
the lightbox zooming method is selected, then the picture would be openend
in a lightbox of 640 pixels wide. The height of the lightbox would be
caclulated automatically.

The optional passLevel parameter defines the current pass level, which
defaults to 0. During the 1st pass (pass level 0) images are resized when
onload fires, but only if the image dimensions are known at that moment. If
the dimensions are not known, then the image is pushed unto the to-do list,
so we can retry to resize the image during the 2nd pass (pass level 1). The
2nd pass starts after the full HTML document has loaded.  There is a third
method in place to make an AJAX call to a PHP file in order to retrieve the
dimensions as a last resort.  This usually happens when images are between
another div or span. */

reimg_toDo = null;

function reimg_resize(img, realWidth, realHeight, passLevel)
{
	if (!reimg_toDo)
	{
		reimg_toDo = new Array();
	}

	if (!img)
	{
		return;
	}
	// Ignore looping animations in MSIE. Does not apply to MSIE 9.0+
	if (img.readyState == "complete" && img.complete && !passLevel && reimg_msie < 9.0)
	{
		return;
	}

	if (!passLevel)
	{
		passLevel = 0; // 1st pass
	}

	// Measure the maximum relative width.
	var maxWidth = window.reimg_maxWidth;
	var maxHeight = window.reimg_maxHeight;
	var relWidth = 0;
	if (window.reimg_relWidth && !realWidth && !realHeight)
	{
		var div = document.createElement("div");
		div.style.width = reimg_relWidth+"%";
		div.style.height = "1px";
		div.style.visibility = "hidden";
		img.parentNode.insertBefore(div, img);
		relWidth = div.offsetWidth;
		img.parentNode.removeChild(div);
	}

	// Unhide the image, using its real (full) dimensions.
	img.style.visibility = "hidden";
	var className = img.className;
	if (className)
	{
		img.className = className.replace(/(^|.*\s)reimg(\s+(.*)|$)/, '$1$3');
	}
	// Fetch the real (full) image dimensions.
	var width = img.width;
	var height = img.height;

	//Still don't know the image dimensions? Let's try using PHP via AJAX as a last resort...
	if (!(width && height) && passLevel >= 1 && reimg_ajax_url && img.src)
	{
		var dimensions = get_dimensions_ajax(img.src);
		if (dimensions)
		{
			if (dimensions.length == 2)
			{
				realWidth = width = dimensions[0];
				realHeight = height = dimensions[1];
			}
		}
	}

	// Skip this image if the dimensions couldn't be determined at this
	// moment. The image may still be resizes later on during the 2nd pass.
	if (!(width && height))
	{
		if (passLevel < 1) // < 2nd pass
		{
			// Add the image to the to-do list.
			reimg_toDo[reimg_toDo.length] = [img, realWidth, realHeight];
			if (className)
			{
				img.className = className;
			}
		}
		else
		{
			// Remove the "loading..." image.
			if (img.previousSibling && img.previousSibling.className && img.previousSibling.className.match(/(^|\s)reimg-loading(\s|$)/))
			{
				img.parentNode.removeChild(img.previousSibling);
			}
		}
		img.style.visibility = "";
		return;
	}

	// Remove the "loading..." image.
	if (img.previousSibling && img.previousSibling.className && img.previousSibling.className.match(/(^|\s)reimg-loading(\s|$)/))
	{
		img.parentNode.removeChild(img.previousSibling);
	}

	// Keep track of the real dimensions.
	if (img.src && window.reimg_zoomTarget == "_litebox" && !reimg_realSize[img.src])
	{
		if (realWidth && !realHeight)
		{
			realHeight = Math.round(realWidth / (width / height));
		}
		else if (realHeight && !realWidth)
		{
			realWidth = Math.round(realHeight / (height / width));
		}
		if (realWidth && realHeight)
		{
			reimg_realSize[img.src] = [realWidth, realHeight];
		}
		else
		{
			reimg_realSize[img.src] = [width, height];
		}
	}

	// Swap width and height for portrait images.
	var swap;
	if (window.reimg_swapPortrait && height > width)
	{
		swap = true;
		if (!(img.height && img.width))
		{
			var width_tmp = width;
			var height_tmp = height;
			width = height_tmp;
			height = width_tmp;
		}
		else
		{
			width = img.height;
			height = img.width;
		}
	}
	else
	{
		swap = false;
	}

	// Apply the maximum relative width.
	var relForce = false;
	if (relWidth)
	{
		// Try the maximum relative width directly on the image
		// (works for prosilver, doesn't work for subsilver2).
		img.style.width = reimg_relWidth + "%";
		// Somehow this causes a "blinking images loop" in Opera 9.27, in
		// Opera 9.5 this bug(?) has been fixed.
		if (!reimg_opera || reimg_opera >= 9.5)
		{
			if (img.offsetWidth && img.offsetWidth > relWidth)
			{
				relForce = true;
			}
		}
		else
		{
			relForce = true;
		}
		img.style.width = "";
		if (!maxWidth || relWidth < maxWidth)
		{
			maxWidth = relWidth;
		}
		else
		{
			relWidth = 0;
		}
	}

	// Make sure maximum width > maximum height if we're to swap width
	// and height for portrait images.
	if (window.reimg_swapPortrait && maxWidth && maxHeight && maxHeight > maxWidth)
	{
		maxWidth += maxHeight;
		maxHeight = maxWidth - reimg_maxHeight;
		maxWidth -= maxHeight;
	}

	className = "";
	// Is the image too wide?
	if (maxWidth && width > maxWidth)
	{
		height = Math.round(height / (width / maxWidth));
		width = maxWidth;
		// The resized image might still also be too high.
		if (height && maxHeight && height > maxHeight)
		{
			width = Math.round(width / (height / maxHeight));
			height = maxHeight;
			className = "reimg-both";
			relWidth = 0;
		}
		else if (relForce)
		{
			className = "reimg-rel-force";
			relWidth = 0;
		}
		else
		{
			className = "reimg-" + (relWidth ? "rel" : "width") + (swap ? "-portrait" : "");
		}
	}
 	// Is the image too high?
	else if (maxHeight && height > maxHeight)
	{
		width = Math.round(width / (height / maxHeight));
		height = maxHeight;
		// The resized image might still also be too wide.
		if (width && maxWidth && width > maxWidth)
		{
			height = Math.round(height / (width / maxWidth));
			width = maxWidth;
			className = "reimg-both";
		}
		else if (relForce)
		{
			className = "reimg-rel-force";
		}
		else
		{
			className = "reimg-height" + (swap ? "-portrait" : "");
		}
		relWidth = 0;
	}

	// Swap back width and height for portrait images.
	if (swap)
	{
		width += height;
		height = width - height;
		width -= height;
	}

	// If the image isn't too large, then abort the mission.
	if (!(className || (realWidth && realWidth > width) || (realHeight && realHeight > height)))
	{
		img.style.visibility = "";
		return;
	}

	// Method 1: Resize the image by setting its CSS class.
	if (!realWidth)
	{
		realWidth = img.width;
	}
	if (!realHeight)
	{
		realHeight = img.height;
	}
	if (relWidth)
	{
		img.style.maxWidth = ((window.reimg_maxWidth && reimg_maxWidth < img.width) ? reimg_maxWidth : realWidth) + "px";
	}
	if (className)
	{
		if (img.style.width)
		{
			img.style.width = "";
		}
		if (img.style.height)
		{
			img.style.height = "";
		}
		img.className = (img.className ? img.className + " " : "") + className;
	}
	// Method 2: Resize the image by setting its width and height attributes.
	img.width = width;
	img.height = height;
	img.style.visibility = "";

	// Make the resized image clickable.
	if (window.reimg_autoLink)
	{
		var parent = img.parentNode;
		while (parent && parent.tagName)
		{
			var tag = parent.tagName.toLowerCase();
			// If any parent is an <a href> tag, then the image is already
			// clickable, so cancel the auto linking for this image.
			if (tag == "a" && parent.href)
			{
				break;
			}
			// We only need to search inside the containing element (<div>
			// for prosilver, <td> for subsilver2; ultimately <body>).
			if (tag == "div" || tag == "td" || tag == "body")
			{
				parent = null;
				break;
			}
			parent = parent.parentNode;
		}
		if (!parent)
		{
			if (window.reimg_zoomAlt)
			{
				img.title = reimg_zoomAlt.replace(/%1\$d/, realWidth).replace(/%2\$d/, realHeight);
			}
			img.className = (img.className ? img.className + " " : "") + "reimg-link";
			if (typeof(img.addEventListener) != "undefined") // DOM
			{
				img.addEventListener("click", reimg_zoomIn, false);
			}
			else if (typeof(img.attachEvent) != "undefined") // MSIE
			{
				img.attachEvent("onclick", reimg_zoomIn);
			}
		}
	}

	// Add a zoom image on top of the resized image.
	if (window.reimg_zoomImg)
	{
		// Force a <br /> before the image.
		if (img.previousSibling && (!img.previousSibling.tagName || img.previousSibling.tagName.toLowerCase() != "br"))
		{
			var br = document.createElement("br");
			img.parentNode.insertBefore(br, img);
		}
		// Add the zoom image.
		var span = document.createElement("span");
		var zoom = document.createElement("img");
		zoom.src = reimg_zoomImg;
		if (window.reimg_zoomAlt)
		{
			zoom.alt = zoom.title = reimg_zoomAlt.replace(/%1\$d/, realWidth).replace(/%2\$d/, realHeight);
		}
		else
		{
			zoom.alt = "";
		}
		zoom.className = span.className = "reimg-zoom";
		zoom.onclick = reimg_zoomIn;
		span.appendChild(zoom);
		img.parentNode.insertBefore(span, img);
	}

	// If the user is already viewing an image in the lightbox, then
	// recalculate (resize) the shadowy background.
	if (window.litebox_version && litebox_background && litebox_background.style.display != "none")
	{
		litebox_calc();
	}
}


// Inserts a "loading..." image before each large image that currently is
// still loading.
var reimg_preLoadLoadingImg;

function reimg_loading(imgOrPassLevel)
{
	if (!window.reimg_loadingImg)
	{
		return;
	}

	// 1st pass:
	if (imgOrPassLevel != 1)
	{
		// Pre-load the "loading..." image (doesn't work in MSIE 8).
		if (imgOrPassLevel && !reimg_preLoadLoadingImg)
		{
			reimg_preLoadLoadingImg = document.createElement("img");
			reimg_preLoadLoadingImg.src = imgOrPassLevel;
		}

		// Postpone inserting "loading..." images a short while, so smaller
		// images still have a chance to load within the given time.
		if (window.reimg_loadingImg && typeof(window.setTimeout) != "undefined")
		{
			window.setTimeout("reimg_loading(1);", 1000);
		}
		return;
	}

	// 2nd pass:
	var images = document.getElementsByTagName("img");
	if (images)
	{
		// Find all resizable images that are still loading.
		var loading = new Array();
		for (var i = 0; i < images.length; i++)
		{
			if (images[i].className.match(/(^|\s)reimg(\s|$)/))
			{
				loading[loading.length] = images[i];
			}
		}
		// Insert a "loading..." image before each of the images that are
		// still loading.
		for (var i = 0; i < loading.length; i++)
		{
			var img = document.createElement("img");
			img.src = reimg_loadingImg;
			if (window.reimg_loadingAlt)
			{
				img.alt = img.title = reimg_loadingAlt;
			}
			else
			{
				img.alt = "";
			}
			img.className = "reimg-loading";
			loading[i].parentNode.insertBefore(img, loading[i]);
		}
	}
}

// The HTML document onload handler that starts the 2nd resizing pass.
function reimg_onLoad(e)
{
	// If there's a to-do list, then resize the images (if any) on the list.
	if (reimg_toDo)
	{
		for (var i = 0; i < reimg_toDo.length; i++)
		{
			reimg_resize(reimg_toDo[i][0], reimg_toDo[i][1], reimg_toDo[i][2], 1);
		}
		reimg_toDo = null;
	}

	// There is no to-do list, so either there were no resizable images, or
	// we're in XHTML very Strict mode (without onload/onerror on images).
	else
	{
		// Find resizable images...
		var images = document.getElementsByTagName("img");
		if (images)
		{
			for (var i = 0; i < images.length; i++)
			{
				if (images[i].className.match(/(^|\s)reimg(\s|$)/))
				{
					// ... and resize them.
					reimg_resize(images[i], null, null, 1);
				}
			}
		}
	}

	return true;
}

function get_dimensions_ajax(imgsrc)
{
	var returnary = false;
	var dimensions_request = false;

	if (window.XMLHttpRequest)
	{
		dimensions_request = new XMLHttpRequest();
	}
	else if (window.ActiveXObject)
	{
		try
		{
			dimensions_request = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				dimensions_request = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{}
		}
	}
	if (!dimensions_request)
	{
		return false;
	}
	dimensions_request.onreadystatechange = function () {
		if (dimensions_request.readyState == 4)
		{
			if (dimensions_request.status == 200)
			{
				//If we got a response back we split and return it
				returnary = dimensions_request.responseText.split('||');
			}
		}
	};
	dimensions_request.open('GET', reimg_ajax_url + '?img=' + escape(imgsrc), false);
	dimensions_request.send(null);

	return returnary;
}


// Install the safety net to catch any images that were somehow not resized.
if (window.onload_functions) // prosilver
{
	onload_functions[onload_functions.length] = "reimg_onLoad();";
}
else if (typeof(window.addEventListener) != "undefined") // DOM
{
	window.addEventListener("load", reimg_onLoad, false);
}
else if (typeof(window.attachEvent) != "undefined") // MSIE
{
	window.attachEvent("onload", reimg_onLoad);
}