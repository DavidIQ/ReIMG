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
	'LOADING_TEXT'					=> 'Uèitanje...',
	'LOADING_TITLE'					=> 'Klikni za izmjenu',
	'FOCUS_TITLE'					=> 'Click to bring to front',
	'FULL_EXPAND_TITLE'				=> 'Prikaz originalne slike (f)',
	'CREDITS_TEXT'					=> 'Powered by <em>Highslide JS</em>',
	'CREDITS_TITLE'					=> 'Go to the Highslide JS homepage',
	'PREVIOUS_TEXT'					=> 'Prije',
	'NEXT_TEXT'						=> 'Poslije',
	'MOVE_TEXT'						=> 'Move',
	'CLOSE_TEXT'					=> 'Zatvori',
	'CLOSE_TITLE'					=> 'Zatvori (esc)',
	'RESIZE_TITLE' 					=> 'Promjeni',
	'PLAY_TEXT' 					=> 'Pokreni',
	'PLAY_TITLE' 					=> 'Pokreni slideshow (razmaknica)',
	'PAUSE_TEXT' 					=> 'Pause',
	'PAUSE_TITLE' 					=> 'Pauza slideshow (razmaknica)',
	'PREVIOUS_TITLE' 				=> 'Prije(strelica ljevo)',
	'NEXT_TITLE' 					=> 'Sljedeæe (strelica desno)',
	'MOVE_TITLE' 					=> 'Film',
	'IMAGE_NUMBER' 					=> 'Slika %1 of %2',
	'RESTORE_TITLE' 				=> 'Klikni za zatvaranje slike, click and drag to move. Use arrow keys for next and previous.',
	
	'IMG_ICON_REIMG_LOADING'		=> 'Uèitanje',
	'IMG_ICON_REIMG_ZOOM_IN'		=> 'Zum poveèanje',
	'IMG_ICON_REIMG_ZOOM_OUT'		=> 'Zum smanjenje',
	
	'REIMG_ZOOM_IN'					=> 'Zum poveæanje (real dimensions: %1$d x %2$d)',
	'REIMG_ZOOM_OUT'				=> 'Zum smanjenje',
));

