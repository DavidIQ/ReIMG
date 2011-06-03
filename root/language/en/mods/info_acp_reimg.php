<?php
/**
*
* reimg [English]
*
* @package language
* @copyright (c) 2011 DavidIQ.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
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
	'ACP_CAT_REIMG'					=> 'ReIMG Image Resizer',
	'ACP_REIMG_CONFIG'				=> 'ReIMG Image Resizer configuration',
	'ACP_REIMG_CONFIG_EXPLAIN'		=> 'ReIMG Image Resizer will resize images on the client side using JavaScript and using one of various selectable effects to expand the images when user clicks on a resized image.',

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
	'REIMG_ZOOM_METHOD_EXPLAIN'		=> 'Select the method that is used to view the original, larger image.<br /><br />NOTE: If you wish to use a disabled selection follow the instructions that are shown next to the disabled selection description.',

	'reimg_zooming_methods'			=> array(
		'_blank' 		=> 'New window',
		'_default' 		=> 'Normal link',
		'_litebox' 		=> 'Litebox',
		'_litebox1'		=> array(
								'Zoom to image full size on initial click.',
								'Litebox 1:1',
							),
		'_highslide'	=> array(
								'Use link to download Highslide JS ZIP package. Then place zip package’s <em>highslide</em> directory in your forum’s <em>reimg</em> directory.',
								'<a href="http://highslide.com/download.php" style="text-decoration: underline;">Highslide</a>',
							),
		'_lytebox'		=> array(
								'Use link to download Lytebox ZIP package. Unzip contents to an empty <em>lytebox</em> directory and place folder in your forum’s <em>reimg</em> directory. DOES NOT WORK WELL WITH INTERNET EXPLORER 9 UNLESS X-UA-Compatible TAG IS CHANGED IN overall_header.html TO JUST HAVE "EmulateIE7" AS THE VALUE FOR "content".',
								'<a href="http://www.dolem.com/lytebox/" style="text-decoration: underline;">Lytebox</a>',
							),
	),

	'REIMG_IGNORE_SIG_IMG'			=> 'Ignore images in signatures',
	'REIMG_IGNORE_SIG_IMG_EXPLAIN'	=> 'If set to yes then images in signatures will not be resized.',
	'REIMG_ATTACHMENTS'				=> 'Apply ReIMG to image attachments',
	'REIMG_ATTACHMENTS_EXPLAIN'		=> 'Disables thumbnail creation when attaching images. (NOT retro-active, i.e. older attachments will not be affected if you change this setting)',
	'REIMG_XHTML'					=> 'Stay XHTML compliant',
	'REIMG_XHTML_EXPLAIN'			=> 'Removes "onload" and "onerror" attributes that would normally be added to resized images.  The side-effect is that images will not resize as seamlessly.',

	'REIMG_UPDATED'					=> 'ReIMG Image Resizer settings have been updated.',

	'LOG_REIMG_UPDATED'				=> '<strong>Updated ReIMG Image Resizer Settings</strong>',
));

$lang = array_merge($lang, array(
	'acl_a_reimg'	=> array('lang' => 'Can manage ReIMG Image Resizer settings', 'cat' => 'settings')
));

