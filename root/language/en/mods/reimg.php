<?php
/**
*
* reimg [English]
*
* @package language
* @version $Id: reimg.php 8775 2009-06-05 09:30:12Z DavidIQ $
* @copyright (c) 2009 DavidIQ.com
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
	'LOADING_TEXT'					=> 'Loading...',
	'LOADING_TITLE'					=> 'Click to cancel',
	'FOCUS_TITLE'					=> 'Click to bring to front',
	'FULL_EXPAND_TITLE'				=> 'Expand to actual size (f)',
	'CREDITS_TEXT'					=> 'Powered by <i>Highslide JS</i>',
	'CREDITS_TITLE'					=> 'Go to the Highslide JS homepage',
	'PREVIOUS_TEXT'					=> 'Previous',
	'NEXT_TEXT'						=> 'Next',
	'MOVE_TEXT'						=> 'Move',
	'CLOSE_TEXT'					=> 'Close',
	'CLOSE_TITLE'					=> 'Close (esc)',
	'RESIZE_TITLE' 					=> 'Resize',
	'PLAY_TEXT' 					=> 'Play',
	'PLAY_TITLE' 					=> 'Play slideshow (spacebar)',
	'PAUSE_TEXT' 					=> 'Pause',
	'PAUSE_TITLE' 					=> 'Pause slideshow (spacebar)',
	'PREVIOUS_TITLE' 				=> 'Previous (arrow left)',
	'NEXT_TITLE' 					=> 'Next (arrow right)',
	'MOVE_TITLE' 					=> 'Move',
	'IMAGE_NUMBER' 					=> 'Image %1 of %2',
	'RESTORE_TITLE' 				=> 'Click to close image, click and drag to move. Use arrow keys for next and previous.',
	
	'REIMG_SETTINGS'				=> 'Image resize settings',
	'REIMG_MAX_SIZE'				=> 'Maximum image dimensions',
	'REIMG_MAX_SIZE_EXPLAIN'		=> 'When an image is larger than this it will be resized. Set to 0 to disable horizontal and/or vertical resizing.',
	'REIMG_REL_WIDTH'				=> 'Maximum relative image width',
	'REIMG_REL_WIDTH_EXPLAIN'		=> 'When an image is wider than this it will be resized. Set to 0 to ignore the relative width.',
	'REIMG_SWAP_PORTRAIT'			=> 'Normalize landscape/portrait',
	'REIMG_SWAP_PORTRAIT_EXPLAIN'	=> 'If set to yes the maximum dimensions are loosely applied, so landscape and portrait images are equally resized. If set to no the maximum width and/or height are strictly enforced.',
	'REIMG_LINK_METHOD'				=> 'Zooming link',
	'REIMG_LINK_METHOD_EXPLAIN'		=> 'Select the method that is used to link to the original, larger image.',
	'REIMG_LINK_BUTTON'				=> 'Zooming button',
	'REIMG_LINK_IMAGE'				=> 'Link resized image',
	'REIMG_LINK_BOTH'				=> 'Both',
	'REIMG_ZOOM_BLANK'				=> 'New window',
	'REIMG_ZOOM_DEFAULT'			=> 'Normal link',
	'REIMG_ZOOM_EXTURL'				=> 'External link',
	'REIMG_ZOOM_LITEBOX'			=> 'Lightbox',
	'REIMG_ZOOM_LITEBOX_1_1'		=> 'Lightbox 1:1',
	'REIMG_ZOOM_LITEBOX_RESIZED'	=> 'Lightbox resized',
	'REIMG_ZOOM_HIGHSLIDE'			=> 'Highslide',
	'REIMG_ZOOM_METHOD'				=> 'Zooming method',
	'REIMG_ZOOM_METHOD_EXPLAIN'		=> 'Select the method that is used to view the original, larger image.<br /><br />NOTE on Highslide: If you wish to use Highslide please note that you must first download the Highslide JS ZIP package from <a href="http://highslide.com/download.php">here</a> and place the downloaded zip file’s <em>highslide</em> directory in your forum’s <em>reimg/highslide</em> directory.',
	'REIMG_IGNORE_SIG_IMG'			=> 'Ignore images in signatures',
	'REIMG_IGNORE_SIG_IMG_EXPLAIN'	=> 'If set to yes then images in signatures will not be resized.',
	
	'IMG_ICON_REIMG_LOADING'		=> 'Loading',
	'IMG_ICON_REIMG_ZOOM_IN'		=> 'Zoom in',
	'IMG_ICON_REIMG_ZOOM_OUT'		=> 'Zoom out',
	
	'REIMG_ZOOM_IN'					=> 'Zoom in (real dimensions: %1$d x %2$d)',
	'REIMG_ZOOM_OUT'				=> 'Zoom out',
));

?>