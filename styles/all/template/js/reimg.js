/**
 * Resize too large images
 * (c) DavidIQ 2010-2020
 * https://www.davidiq.com/
 **/

function ReIMG(altLabels, settings) {
    const reimg = this;

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
            case ZoomMethods.NewWindow:  //Full sized image in new window
                $(imageSelector).on('click', function (event) {
                    event.preventDefault();
                    window.open($(this).attr("href"));
                });
                break;

            case ZoomMethods.Lightbox:  //Use Image Lightbox plugin
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

            case ZoomMethods.ColorBox:  //Use Colorbox plugin
                const $window = $(window);
                $(imageSelector).colorbox({
                    current: reimg.AltLabels.Current,
                    previous: reimg.AltLabels.Previous,
                    next: reimg.AltLabels.Next,
                    close: reimg.AltLabels.Close,
                    xhrError: reimg.AltLabels.XhrError,
                    imgError: reimg.AltLabels.ImgError,
                    rel: 'gal', //Show as gallery
                    photo: true,
                    scalePhotos: true,
                    returnFocus: false,
                    maxWidth: $window.width(),
                    maxHeight: $window.height(),
                    onComplete: function () {
                        reimg.ZoomMoreRemove();
                        reimg.ZoomMoreAdd("img.cboxPhoto");
                    },
                    onClosed: function () {
                        reimg.ZoomMoreRemove();
                    }
                });

                break;

            case ZoomMethods.Magnific:  //Use Magnific Popup plugin
                $(imageSelector).magnificPopup({
                    type: 'image',
                    verticalFit: true,
                    cursor: null,
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        tPrev: reimg.AltLabels.PreviousTitle,
                        tNext: reimg.AltLabels.NextTitle,
                        tCounter: reimg.AltLabels.Counter,
                        tClose: reimg.AltLabels.CloseTitle
                    },
                    callbacks: {
                        open: function () {
                            reimg.ZoomMoreRemove();
                            reimg.ZoomMoreAdd('img.mfp-img');
                        },
                        close: function () {
                            reimg.ZoomMoreRemove();
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
        if (reimg.Settings.reimgForAll || (realWidth !== $(image).width() || realHeight !== $(image).height())) {
            const zoomText = reimg.AltLabels.ZoomIn.replace(/%1\$d/, realWidth).replace(/%2\$d/, realHeight),
                  anchorHtml = `<a href="${t.src}" data-reimgwidth="${realWidth}" data-reimgheight="${realHeight}" title="${zoomText}" class="ReIMG-Anchor"></a>`,
                  $reimgButton = $('<span class="ReIMG-ZoomIn"></span>');

            $reimgButton.wrap(anchorHtml);
            $reimgButton.data('realWidth', realWidth);
            $reimgButton.data('realHeight', realHeight);
            $(image).before($reimgButton);

            //Check if the parent is an anchor link first
            if ($(image).parent().is("a")) {
                const href = $(image).parent().attr("href");
                const $userlink = $(`<div class="ReIMG-UserLink"><a href="${href}" title="${reimg.AltLabels.UserLink}">${href}</a></div>`);

                //Add original link to after the image
                $(image).after($userlink);
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
        $(`<button type="button" id="imagelightbox-close" title="${reimg.AltLabels.Close}"></button>`).appendTo('body').on('click touchend', function () {
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
              $reimgClicked = $('<div/>', {id: 'ReIMG-Clicked'});

        let $addContainer = (element) => $('#ReIMG-Overlay').after(element),
            positiontop = $image.css('top');

        switch (reimg.Settings.zoomMethod) {
            case ZoomMethods.ColorBox:
                $addContainer = (element) => $('#cboxLoadedContent').before(element);
                break;

            case ZoomMethods.Magnific:
                positiontop = $('.mfp-close').height();
                $addContainer = (element) => $('img.mfp-img').before(element);
                break;
        }

        if (!!$addContainer && $image.width() < reimgwidth || $image.height() < reimgheight) {
            //Grab the image that was enlarged
            const $zoomMoreButton = $(`<a id="ReIMG-ZoomMore" class="ReIMG-ZoomMore" href="${$image.attr("src")}"><span class="ReIMG-ZoomIn ReIMG-ZoomMore"></span></a>`);

            $zoomMoreButton.data('reimgheight', reimgheight);
            $zoomMoreButton.data('reimgwidth', reimgwidth);
            $zoomMoreButton.data('reimgtop', positiontop);
            $zoomMoreButton.data('reimgleft', positionleft);

            $zoomMoreButton.on('click', function (event) {
                reimg.ZoomMoreClick(event, this);
                event.preventDefault();
                event.stopPropagation();
            });

            $zoomMoreButton.appendTo($reimgClicked);
        }

        if (!!$addContainer) {
            $reimgClicked.css({
                'width': $image.css('width'),
                'height': $image.css('height'),
                'top': positiontop,
                'left': positionleft
            });

            $reimgClicked.data('origwidth', $image.css('width'));
            $reimgClicked.data('origheight', $image.css('height'));

            if (reimg.Settings.zoomMethod !== ZoomMethods.Magnific) {
                $image.appendTo($reimgClicked);
            }

            $addContainer($reimgClicked);
        }
    };

    reimg.ZoomMoreRemove = function () {
        $('#ReIMG-ZoomMore').remove();
        $('#ReIMG-Clicked').remove();
    };

    reimg.ZoomMoreClick = function (e, zoomButton) {
        let imageIdentifier = '#ReIMG-Clicked img.ReIMG-Anchor',
            reimgheight = '',
            reimgwidth = '',
            imgposition = reimg.Settings.zoomMethod === ZoomMethods.Magnific ? 'inherit' : 'fixed',
            reimgleft = '0px',
            reimgtop = '0px';

        const $zoomBtn = $(zoomButton),
              $zoomImg = $zoomBtn.find('span'),
              $reimgClicked = $('#ReIMG-Clicked');

        switch (reimg.Settings.zoomMethod) {
            case ZoomMethods.ColorBox:
                imageIdentifier = 'img.cboxPhoto';
                reimgheight = parseInt($zoomBtn.data("reimgheight"));
                reimgwidth = parseInt($zoomBtn.data("reimgwidth"));
                break;

            case ZoomMethods.Magnific:
                imageIdentifier = 'img.mfp-img';
                break;
        }

        const $image = $(imageIdentifier);

        if ($zoomImg.hasClass('ReIMG-ZoomOut')) {
            $zoomImg.removeClass('ReIMG-ZoomOut');
            reimgleft = $zoomBtn.data('reimgleft');
            reimgtop = $zoomBtn.data('reimgtop');
            reimgwidth = $reimgClicked.data('origwidth');
            reimgheight = $reimgClicked.data('origheight');
            $reimgClicked.css({
                'width': reimgwidth,
                'left': $zoomBtn.data('reimgleft')
            });
            $zoomBtn.css({
                'left': $zoomBtn.data('reimgleft')
            });
        } else {
            if (reimg.Settings.zoomMethod === ZoomMethods.Magnific) {
                reimgtop = $zoomBtn.data('reimgtop');
                reimgleft = $zoomBtn.data('reimgleft');
            } else if ([ZoomMethods.ColorBox, ZoomMethods.Magnific].indexOf(reimg.Settings.zoomMethod) < 0) {
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
                imgposition = 'absolute';
            }
            $zoomImg.addClass('ReIMG-ZoomOut');
        }

        $image.css({
            'width': reimgwidth,
            'height': reimgheight,
            'left': reimgleft,
            'top': reimgtop,
            'position': imgposition
        });
    };

    $(window).on('resize', () => {
        const $img = $('img.ReIMG-Anchor');
        if (!!$img && $img.length > 0) {
            $('a.ReIMG-ZoomMore').css({
                'left': $img.css('left'),
                'top': $img.css('top')
            });
        }
    });

    const ZoomMethods = {
        NewWindow: '_blank',
        Lightbox: '_imglightbox',
        ColorBox: '_colorbox',
        Magnific: '_magnific'
    }
}
