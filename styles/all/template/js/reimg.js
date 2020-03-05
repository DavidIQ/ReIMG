/**
 * Resize too large images
 * (c) DavidIQ 2010-2020
 * https://www.davidiq.com/
 **/

function ReIMG(altLabels, settings) {
    const version = "3.0.0",
        reimg = this;

    reimg.AltLabels = altLabels;
    reimg.Settings = settings;

    reimg.ApplyResize = function () {
        //Get the various images types within posts
        const $postImages = $('img.postimage:not(dt.attach-image img.postimage)'),
            $attachImages = (reimg.Settings.handleAttached) ? $('dt.attach-image img.postimage') : null,
            imageSelector = ".ReIMG-Anchor";

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
        switch (reimg.Settings.zoomMethod) {
            case "_blank":  //Full sized image in new window
                $(imageSelector).on('click', function (event) {
                    event.preventDefault();
                    window.open($(this).attr("href"));
                });
                break;

            case "_imglightbox":  //Use Image Lightbox plugin
                const reimgAnchor = $(imageSelector).imageLightbox({
                    quitOnDocClick: false,
                    selector: "class='ReIMG-Anchor'",
                    //Attachments are done via a PHP file so let's add that if we have any
                    allowedTypes: "png|jpg|jpeg|gif" + ($attachImages) ? "|" + reimg.Settings.phpExt : "",
                    onStart: function () {
                        reimg.OverlayShow();
                        reimg.NavigationOn(reimgAnchor, 'a.ReIMG-Anchor');
                    },
                    onEnd: function () {
                        reimg.NavigationOff();
                        reimg.ZoomMoreRemove();
                        reimg.OverlayRemove();
                    },
                    onLoadStart: function () {
                        reimg.ZoomMoreRemove();
                        reimg.Loading();
                    },
                    onLoadEnd: function () {
                        reimg.LoadingDone();
                        setTimeout(() => reimg.ZoomMoreAdd("img.ReIMG-Anchor"), 400);
                    }
                });

                break;

            case "_colorbox":  //Use Colorbox plugin
                const $window = $(window);
                $(imageSelector).colorbox({
                    rel: 'gal', //Show as gallery
                    photo: true,
                    scalePhotos: true,
                    returnFocus: false,
                    maxWidth: $window.width(),
                    maxHeight: $window.height(),
                    onComplete: function () {
                        //reimg.ZoomMoreAdd("img.cboxPhoto");
                    }
                });

                break;

            case "_magnific":  //Use Magnific Popup plugin
                $(imageSelector).magnificPopup({
                    type: 'image',
                    verticalFit: true,
                    cursor: null,
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true
                    },
                    callbacks: {
                        open: function () {
                            //reimg.ZoomMoreAdd('img.mfp-img');
                        }
                    }
                });

                break;
        }
    };

    reimg.AddZoom = function (image, attachment) {
        let realWidth = 0,
            realHeight = 0;
        const t = new Image();

        if (attachment && $(image).parent().is("a")) {
            t.src = $(image).parent().attr("href");
        } else {
            t.src = $(image).attr("src");
        }
        realWidth = (t.width) ? t.width : $(image).prop('naturalWidth');
        realHeight = (t.height) ? t.height : $(image).prop('naturalHeight');

        //Check to see if real dimensions differ from current dimensions
        if (reimg.Settings.reimgForAll || (realWidth != $(image).width() || realHeight != $(image).height())) {
            let anchorHtml = '<a href="%1$s" data-reimgwidth="%2$d" data-reimgheight="%3$d" title="%4$s" class="ReIMG-Anchor"></a>';
            const zoomText = reimg.AltLabels.ZoomIn.replace(/%1\$d/, realWidth).replace(/%2\$d/, realHeight);
            anchorHtml = anchorHtml.replace(/%1\$s/, t.src);
            anchorHtml = anchorHtml.replace(/%2\$d/, realWidth);
            anchorHtml = anchorHtml.replace(/%3\$d/, realHeight);
            anchorHtml = anchorHtml.replace(/%4\$s/, zoomText);

            const $reimgButton = $('<span class="ReIMG-ZoomIn"></span>');
            $reimgButton.wrap(anchorHtml);
            $reimgButton.data('realWidth', realWidth);
            $reimgButton.data('realHeight', realHeight);
            $(image).before($reimgButton);

            //Check if the parent is an anchor link first
            if ($(image).parent().is("a")) {
                const href = $(image).parent().attr("href");
                let userLinkHtml = '<div class="ReIMG-UserLink"><a href="%1$s" title="%2$s">%1$s</a></div>';
                userLinkHtml = userLinkHtml.replace(/%1\$s/g, href);
                userLinkHtml = userLinkHtml.replace(/%2\$s/, reimg.AltLabels.UserLink);
                const $userlink = $(userLinkHtml);
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
            } else {
                $(image).wrap(anchorHtml);
            }
            if (!!$reimgButton) {
                $(image).before($reimgButton);
            }
        }
    };

    reimg.Loading = function () {
        $('<div id="ReIMG-Loading"><div></div></div>').appendTo('body');
    };

    reimg.LoadingDone = function () {
        $('#ReIMG-Loading').remove();
        $('.imagelightbox-arrow').css('display', 'block');
    };

    reimg.NavigationOn = function (instance, selector) {
        $('<button type="button" id="imagelightbox-close" title="Close"></button>').appendTo('body').on('click touchend', function () {
            $(this).remove();
            instance.quitImageLightbox();
            return false;
        });

        const $arrows = $('<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"></button>');

        $arrows.appendTo('body');

        $arrows.on('click touchend', function (e) {
            e.preventDefault();

            const $this = $(this),
                $target = $(selector + "[href='" + $('img.ReIMG-Anchor').attr("src") + "']")
            let index = $target.index(selector);

            if ($this.hasClass('imagelightbox-arrow-left')) {
                index = index - 1;
                if (!$(selector).eq(index).length)
                    index = $(selector).length;
            } else {
                index = index + 1;
                if (!$(selector).eq(index).length)
                    index = 0;
            }

            instance.switchImageLightbox(index);
            return false;
        });
    };

    reimg.NavigationOff = function () {
        $('#imagelightbox-close').remove();
        $('.imagelightbox-arrow').remove();
    };

    reimg.OverlayShow = function () {
        $('<div id="ReIMG-Overlay"></div>').appendTo('body');
    };

    reimg.OverlayRemove = function () {
        $('#ReIMG-Overlay').remove();
    };

    reimg.ZoomMoreAdd = function (imageselector) {
        const $image = $(imageselector),
            $imgAnchor = $("a.ReIMG-Anchor[href='" + $image.attr("src") + "']"),
            reimgheight = parseInt($imgAnchor.data("reimgheight")),
            reimgwidth = parseInt($imgAnchor.data("reimgwidth")),
            positionleft = $image.css('left'),
            positiontop = $image.css('top'),
            $reimgClicked = $('<div/>', {id: 'ReIMG-Clicked'});

        if (reimg.Settings.zoomMethod !== '_colorbox' && reimg.Settings.zoomMethod !== '_magnific') {
            $reimgClicked.css({
                'width': $image.css('width'),
                'height': $image.css('height'),
                'top': positiontop,
                'left': positionleft
            });

            $reimgClicked.data('origwidth', $image.css('width'));
            $image.appendTo($reimgClicked);
        }

        if ($image.width() < reimgwidth || $image.height() < reimgheight) {
            //Grab the image that was enlarged
            const $zoomMoreButton = $(`<a id="ReIMG-ZoomMore" class="ReIMG-ZoomMore" href="${$image.attr("src")}"><span class="ReIMG-ZoomIn ReIMG-ZoomMore"></span></a>`);

            $zoomMoreButton.data('reimgheight', $image.css('height'));
            $zoomMoreButton.data('reimgwidth', $image.css('width'));
            $zoomMoreButton.data('reimgtop', positiontop);
            $zoomMoreButton.data('reimgleft', positionleft);

            $zoomMoreButton.on('click', function (event) {
                reimg.ZoomMoreClick(event, this);
                event.preventDefault();
                event.stopPropagation();
            });

            $(window).on('resize', function () {
                const $img = $('img.ReIMG-Anchor');
                console.log($img.css('left'), $img.css('top'));
                $('a.ReIMG-ZoomMore').css({
                    'left': $img.css('left'),
                    'top': $img.css('top')
                });
            });
            $zoomMoreButton.appendTo($reimgClicked);
        }

        $('#ReIMG-Overlay').after($reimgClicked);
    };

    reimg.ZoomMoreRemove = function () {
        $('#ReIMG-ZoomMore').remove();
        $('#ReIMG-Clicked').remove();
    };

    reimg.ZoomMoreClick = function (e, zoomButton) {
        let imageIdentifier = '#ReIMG-Clicked img.ReIMG-Anchor';

        switch (reimg.Settings.zoomMethod) {
            case '_colorbox':
                imageIdentifier = 'img.cboxPhoto';
                break;

            case '_magnific':
                imageIdentifier = 'img.mfp-img';
                break;
        }

        const $zoomBtn = $(zoomButton),
            $zoomImg = $zoomBtn.find('span'),
            $image = $(imageIdentifier),
            $reimgClicked = $('#ReIMG-Clicked');

        let reimgheight = '',
            reimgwidth = '',
            imgposition = 'fixed',
            reimgleft = '0px',
            reimgtop = '0px';

        if ($zoomImg.hasClass('ReIMG-ZoomOut')) {
            $zoomImg.removeClass('ReIMG-ZoomOut');
            reimgheight = parseInt($zoomBtn.data("reimgheight"));
            reimgwidth = parseInt($zoomBtn.data("reimgwidth"));
            reimgleft = $zoomBtn.data('reimgleft');
            reimgtop = $zoomBtn.data('reimgtop');
            $reimgClicked.css({
                'width': $reimgClicked.data('origwidth'),
                'left': $zoomBtn.data('reimgleft')
            });
            $zoomBtn.css({
                'left': $zoomBtn.data('reimgleft')
            });
        } else {
            //Let's make the image panel a little wider
            const naturalWidth = $image[0].naturalWidth,
                screenWidth = $(window).width();

            let newWidth = 0,
                screenOffset = 400;

            if (naturalWidth - screenOffset >= screenWidth) {
                newWidth = screenWidth - screenOffset;
            } else if (naturalWidth - screenOffset < screenWidth - screenOffset) {
                newWidth = naturalWidth;
            } else {
                newWidth = naturalWidth - screenOffset;
            }
            $reimgClicked.width(newWidth);
            //Figure out left position
            const newLeft = (screenWidth - newWidth) / 2;
            $reimgClicked.css({
                'left': newLeft
            });
            $zoomBtn.css({
                'left': newLeft
            });
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
