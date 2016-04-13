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
		//Get the various images types within posts
		var $postImages = $('img.postimage:not(dt.attach-image img.postimage)'),
			$attachImages =  (reimg.Settings.handleAttached) ? $('dt.attach-image img.postimage') : null;

		//Add ReIMG zooming to each non-attachment image
		$postImages.each(function () {
			reimg.AddZoom(this, false);
		});

		//Add ReIMG zooming to each image attachment
		if ($attachImages) {
			$attachImages.each(function () {
				reimg.AddZoom(this, true);
			});
		}

		//The plugin setup depending on which one is in use
		switch (reimg.Settings.zoomMethod)
		{
			case "_blank":  //Full sized image in new window
				$(".ReIMG-Anchor").click(function (event) {
					event.preventDefault();
					window.open($(this).attr("href"));
				});
			break;

			case "_imglightbox":  //Use Image Lightbox plugin

				//Attachments are done via a PHP file so let's add that if we have any
				var types = "png|jpg|jpeg|gif" + ($attachImages) ? "|" + reimg.Settings.phpExt : "";

				var reimgAnchor = $(".ReIMG-Anchor").imageLightbox({
					quitOnDocClick:	false,
					selector: 		"class='ReIMG-Anchor'",
					allowedTypes:	types,
					onStart:		function() { reimg.OverlayShow(); reimg.NavigationOn(reimgAnchor, 'a.ReIMG-Anchor'); },
					onEnd:			function() { reimg.NavigationOff(); reimg.ZoomMoreRemove(); reimg.OverlayRemove(); },
					onLoadStart: 	function() { reimg.ZoomMoreRemove(); reimg.Loading(); },
					onLoadEnd:	 	function() {
										reimg.LoadingDone();
										setTimeout(reimg.ZoomMoreAdd("img.ReIMG-Anchor"), 400);
									}
				});

			break;

			case "_colorbox":  //Use Colorbox plugin

			break;

			case "_magnific":  //Use Magnific Popup plugin

			break;
		}
	};

	reimg.AddZoom = function (image, attachment) {
		var realWidth = 0,
			realHeight = 0,
			t = new Image();

		if (attachment && $(image).parent().is("a")) {
			t.src = $(image).parent().attr("href");
		}
		else {
			t.src = $(image).attr("src");
		}
		realWidth = (t.width) ? t.width : $(image).width();
		realHeight = (t.height) ? t.height : $(image).height();

		//Check to see if real dimensions differ from current dimensions
		if (reimg.Settings.reimgForAll || (realWidth != $(image).width() || realHeight != $(image).height())) {
			var anchorHtml = '<a href="%1$s" data-reimgwidth="%2$d" data-reimgheight="%3$d" title="%4$s" class="ReIMG-Anchor"></a>',
				zoomText = reimg.AltLabels.ZoomIn.replace(/%1\$d/, realWidth).replace(/%2\$d/, realHeight),
				$reimgButton = null;
			anchorHtml = anchorHtml.replace(/%1\$s/, t.src);
			anchorHtml = anchorHtml.replace(/%2\$d/, realWidth);
			anchorHtml = anchorHtml.replace(/%3\$d/, realHeight);
			anchorHtml = anchorHtml.replace(/%4\$s/, zoomText);

			//Check to see if we need to add the zoom button
			if (reimg.Settings.showButton) {
				$reimgButton = $('<span class="ReIMG-ZoomIn"></span>');
				if (!reimg.Settings.autoLink) {
					$reimgButton.wrap(anchorHtml);
					$(image).before($reimgButton);
				}
			}

			if (reimg.Settings.autoLink) {
				//Check if the parent is an anchor link first
				if ($(image).parent().is("a")) {
					var href = $(image).parent().attr("href"),
						userLinkHtml = '<div class="ReIMG-UserLink"><a href="%1$s" title="%2$s">%1$s</a></div>';
					userLinkHtml = userLinkHtml.replace(/%1\$s/g, href);
					userLinkHtml = userLinkHtml.replace(/%2\$s/, reimg.AltLabels.UserLink);
					var $userlink = $(userLinkHtml);
					$userlink.width($(image).width() - 2);

					//Add original link to after the image
					$(image).parent().after($userlink);
					//Update the parent's properties
					$(image).parent().attr("href", t.src);
					$(image).parent().data("reimgwidth", realWidth);
					$(image).parent().data("reimgheight", realHeight);
					$(image).parent().attr("title", zoomText);
					$(image).parent().removeClass();
					$(image).parent().addClass("ReIMG-Anchor");
				}
				else {
					$(image).wrap(anchorHtml);
				}
				if ($reimgButton != null) {
					$(image).before($reimgButton);
				}
			}
		}
	};

	reimg.Loading = function()
	{
		$('<div id="ReIMG-Loading"><div></div></div>').appendTo('body');
	};

	reimg.LoadingDone = function()
	{
		$('#ReIMG-Loading').remove();
		$('.imagelightbox-arrow').css('display', 'block');
	};

	reimg.NavigationOn = function(instance, selector)
	{
		$('<button type="button" id="imagelightbox-close" title="Close"></button>').appendTo('body').on('click touchend', function(){ $(this).remove(); instance.quitImageLightbox(); return false; });

		var $arrows = $('<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"></button>');

		$arrows.appendTo('body');

		$arrows.on('click touchend', function(e)
		{
			e.preventDefault();

			var $this	= $(this),
				$target = $(selector + "[href='" + $('img.ReIMG-Anchor').attr("src") + "']")
				index	= $target.index(selector);

			if($this.hasClass('imagelightbox-arrow-left'))
			{
				index = index - 1;
				if(!$(selector).eq(index).length )
					index = $(selector).length;
			}
			else
			{
				index = index + 1;
				if(!$(selector).eq(index).length)
					index = 0;
			}

			instance.switchImageLightbox(index);
			return false;
		});
	};

	reimg.NavigationOff = function()
	{
		$('#imagelightbox-close').remove();
		$('.imagelightbox-arrow').remove();
	};

	reimg.OverlayShow = function()
	{
		$('<div id="ReIMG-Overlay"></div>').appendTo('body');
	};

	reimg.OverlayRemove = function()
	{
		$('#ReIMG-Overlay').remove();
	};

	reimg.ZoomMoreAdd = function(imageselector)
	{
		var $image = $(imageselector),
			$imgAnchor = $("a.ReIMG-Anchor[href='" + $image.attr("src") + "']"),
			reimgheight = parseInt($imgAnchor.data("reimgheight")),
			reimgwidth = parseInt($imgAnchor.data("reimgwidth")),
			positionleft = $image.css('left'),
			positiontop = $image.css('top'),
			$reimgClicked = $('<div/>', { id: 'ReIMG-Clicked' });

		$reimgClicked.css({
			'width': 	$image.css('width'),
			'height': 	$image.css('height'),
			'top'	:	positiontop,
			'left'	:	positionleft
		});
		$image.appendTo($reimgClicked);

		if ($image.width() < reimgwidth || $image.height() < reimgheight) {
			//Grab the image that was enlarged
			var $zoomMoreButton = $('<a id="ReIMG-ZoomMore" class="ReIMG-ZoomMore" href="' + $image.attr("src") + '"><span class="ReIMG-ZoomIn ReIMG-ZoomMore"></span></a>');

			$zoomMoreButton.data('reimgheight', $image.css('height'));
			$zoomMoreButton.data('reimgwidth', $image.css('width'));
			$zoomMoreButton.data('reimgtop', positiontop);
			$zoomMoreButton.data('reimgleft', positionleft);

			$zoomMoreButton.select("span").css(
				{
					'top'	:	positiontop,
					'left'	:	positionleft
				});

			$zoomMoreButton.click(function (event) {
				reimg.ZoomMoreClick(event, this);
				event.preventDefault();
				event.stopPropagation();
			});

			$image.before($zoomMoreButton);
		}

		$('#ReIMG-Overlay').after($reimgClicked);
	};

	reimg.ZoomMoreRemove = function()
	{
		$('#ReIMG-ZoomMore').remove();
		$('#ReIMG-Clicked').remove();
	};

	reimg.ZoomMoreClick = function (e, zoomButton)
	{
		var $zoomBtn = $(zoomButton),
			$zoomImg = $zoomBtn.find('span'),
			$image = $('#ReIMG-Clicked img.ReIMG-Anchor'),
			reimgheight = '',
			reimgwidth = '',
			imgposition = 'fixed',
			reimgleft = '0px',
			reimgtop = '0px';

		if ($zoomImg.hasClass('ReIMG-ZoomOut'))
		{
			$zoomImg.removeClass('ReIMG-ZoomOut');
			reimgheight = parseInt($zoomBtn.data("reimgheight"));
			reimgwidth = parseInt($zoomBtn.data("reimgwidth"));
			reimgleft = $zoomBtn.data('reimgleft');
			reimgtop = $zoomBtn.data('reimgtop');
		}
		else
		{
			$zoomImg.addClass('ReIMG-ZoomOut');
			imgposition = 'absolute';
		}

		$image.css({
			'width': reimgwidth,
			'height': reimgheight,
			'left': reimgleft,
			'top': reimgtop,
			'position': imgposition
		});
	}
}
