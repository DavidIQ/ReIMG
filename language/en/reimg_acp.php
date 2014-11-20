<?php
/**
* ReIMG extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 DavidIQ.com
* @license GNU General Public License, version 2 (GPL-2.0)
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// NOTE TO TRANSLATORS:  Text in parenthesis refers to keys on the keyboard

$lang = array_merge($lang, array(
	'ACP_REIMG_SETTINGS_EXPLAIN'	=> 'ReIMG Image Resizer will resize images on the client side using JavaScript and using one of various selectable effects to expand the images when user clicks on a resized image.',

	'REIMG_VERSION'					=> 'ReIMG version',
	'REIMG_ENABLE'					=> 'Enable ReIMG Image Resizer',
	'REIMG_OPTIONS'					=> 'ReIMG Image Resizer options',
	'REIMG_SETTINGS'				=> 'Image resize settings',
	'REIMG_MAX_SIZE'				=> 'Maximum image dimensions',
	'REIMG_MAX_SIZE_EXPLAIN'		=> 'When an image is larger than this it will be resized. Set to 0 to disable horizontal and/or vertical resizing.',
	'REIMG_REL_WIDTH'				=> 'Maximum relative image width',
	'REIMG_REL_WIDTH_EXPLAIN'		=> 'When an image is wider than this it will be resized. Set to 0 to ignore the relative width.',
	'REIMG_SWAP_PORTRAIT'			=> 'Normalize landscape/portrait',
	'REIMG_SWAP_PORTRAIT_EXPLAIN'	=> 'If set to yes the maximum dimensions are loosely applied, so landscape and portrait images are equally resized. If set to no the maximum width and/or height are strictly enforced.',
	'REIMG_LINK_METHOD'				=> 'Zooming link',
	'REIMG_LINK_METHOD_EXPLAIN'		=> 'Select the method that is used to link to the original, larger image.',

	'reimg_linking_methods'			=> array(
		'button'			=> 'Zooming button',
		'link'				=> 'Link resized image',
		'button_link'		=> 'Both',
	),

	'REIMG_ZOOM_METHOD'				=> 'Zooming method',
	'REIMG_ZOOM_METHOD_EXPLAIN'		=> 'Select the method that is used to view the original, larger image.',

	'reimg_zooming_methods'			=> array(
		'_blank' 		=> array (
								'name'			=>	'New window',
								'description'	=>	'Opens the full-size image in a new window.',
							),
		'_default' 		=> array (
								'name'			=> 	'Normal link',
								'description'	=>	'Opens the full-size image in the same window.',
							),
		'_imglightbox' 		=> array (
								'name'			=>	'<a href="http://osvaldas.info/image-lightbox-responsive-touch-friendly">Image Lightbox</a>',
								'description'	=>	'View a larger version of the image using Image Lightbox, a basic responsive lightbox.',
							),
		'_colorbox'		=> array(
								'name'			=>	'<a href="http://www.jacklmoore.com/colorbox/">Colorbox</a>',
								'description'	=>	'View a larger version of the image using Colorbox, a jQuery lightbox.',
							),
		'_magnific'		=> array(
								'name'			=>	'<a href="http://dimsemenov.com/plugins/magnific-popup/">Magnific Popup</a>',
								'description'	=>	'View a larger version of the image using Magnific Popup, a responsive lightbox.',
							),
	),

	'REIMG_RESIZE_SIG_IMG'			=> 'Resize images in signatures',
	'REIMG_RESIZE_SIG_IMG_EXPLAIN'	=> 'If set to yes then images in signatures will be resized.',
	'REIMG_ATTACHMENTS'				=> 'Apply ReIMG to image attachments',
	'REIMG_ATTACHMENTS_EXPLAIN'		=> 'If set to yes then ReIMG will be used to open image attachments.',

	'REIMG_UPDATED'					=> 'ReIMG Image Resizer settings have been updated.',

));
