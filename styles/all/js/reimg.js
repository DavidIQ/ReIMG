/**
* Resize too large images
* (c) DavidIQ 2010-2014
* http://www.davidiq.com/
* Past Contributor(s):
* Tale 2008-2009
* http://www.taletn.com/
*/

function ReIMG(altLabels, settings) {
	var version = "3.0.0",
		reimg = this;

	reimg.AltLabels = altLabels;
	reimg.Settings = settings;

	reimg.ApplyResize = function() {
		//#TODO: Selectors need reviewing
		var $postimages = $('.content > img.postimage'),
			$attachedImages =  (reimg.Settings.handleAttached) ? $('.attach-image') : null,
			$inlineAttachedImages = (reimg.Settings.handleAttached) ? $('.inline-attachment') : null;

		//The plugin setup depending on which one is in use
		switch (reimg.Settings.zoomMethod)
		{
			case "_blank":  //Full sized image in new window
			case "_default":  //Full sized image in same window

			break;

			case "_imglightbox":  //Use Image Lightbox plugin

			break;

			case "_colorbox":  //Use Colorbox plugin

			break;

			case "_magnific":  //Use Magnific Popup plugin

			break;
		}
	};
}