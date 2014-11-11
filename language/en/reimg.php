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
	'LOADING_TEXT'					=> 'Loading...',
	'LOADING_TITLE'					=> 'Click to cancel',
	'FOCUS_TITLE'					=> 'Click to bring to front',
	'FULL_EXPAND_TITLE'				=> 'Expand to actual size (f)',
	'CREDITS_TEXT'					=> 'Powered by <em>Highslide JS</em>',
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
	
	'IMG_ICON_REIMG_LOADING'		=> 'Loading',
	'IMG_ICON_REIMG_ZOOM_IN'		=> 'Zoom in',
	'IMG_ICON_REIMG_ZOOM_OUT'		=> 'Zoom out',
	
	'REIMG_ZOOM_IN'					=> 'Zoom in (real dimensions: %1$d x %2$d)',
	'REIMG_ZOOM_OUT'				=> 'Zoom out',
));

