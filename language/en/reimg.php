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

$lang = array_merge($lang, array(
	'LOADING_TEXT'					=> 'Loading...',
	'FULL_EXPAND_TITLE'				=> 'Expand to actual size (f)',
	'PREVIOUS_TEXT'					=> 'Previous',
	'PREVIOUS_TITLE' 				=> 'Previous (arrow left)',
	'NEXT_TEXT'						=> 'Next',
	'NEXT_TITLE' 					=> 'Next (arrow right)',
	'CLOSE_TEXT'					=> 'Close',
	'CLOSE_TITLE'					=> 'Close (esc)',
	'PLAY_TEXT' 					=> 'Play',
	'PLAY_TITLE' 					=> 'Play slideshow (spacebar)',
	'PAUSE_TEXT' 					=> 'Pause',
	'PAUSE_TITLE' 					=> 'Pause slideshow (spacebar)',
	'CURRENT_TEXT'                  => 'Image {current} of {total}',
    'XHRERROR_TEXT'                 => 'This content failed to load.',
    'IMGERROR_TEXT'                 => 'This image failed to load.',

	'REIMG_ZOOM_IN'					=> 'Zoom in (real dimensions: %1$d x %2$d)',
	'REIMG_ZOOM_OUT'				=> 'Zoom out',
	'REIMG_USER_LINK'				=> 'User-assigned image link',
));

