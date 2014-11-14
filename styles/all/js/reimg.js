/**
* Resize too large images
* (c) DavidIQ 2010-2014
* http://www.davidiq.com/
* Past Contributor(s):
* Tale 2008-2009
* http://www.taletn.com/
*/

$(function() {
	var reimg = new ReIMG(window.reimgAltLabels, window.reimgSettings);
	reimg.ApplyResize();
});

function ReIMG(altlabels, settings) {
	var version = "2.0.0",
		reimg = this;

	reimg.AltLabels = altlabels;
	reimg.Settings = settings;

	reimg.ApplyResize = function() {
		//#TODO
	};
}