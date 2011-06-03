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
	'LOADING_TEXT'					=> 'Ładowanie...',
	'LOADING_TITLE'					=> 'Kliknij, aby anulować',
	'FOCUS_TITLE'					=> 'Kliknij, aby doprowadzić do przodu',
	'FULL_EXPAND_TITLE'				=> 'Rozszerzenie do rzeczywistej wielkości (f)',
	'CREDITS_TEXT'					=> 'Powered by <i>Highslide JS</i>',
	'CREDITS_TITLE'					=> 'Przejdź do strony głównej JS Highslide',
	'PREVIOUS_TEXT'					=> 'Poprzedni',
	'NEXT_TEXT'						=> 'Następny',
	'MOVE_TEXT'						=> 'Przedź',
	'CLOSE_TEXT'					=> 'Zamknij',
	'CLOSE_TITLE'					=> 'Zamknij (esc)',
	'RESIZE_TITLE' 					=> 'Zmiana rozmiaru',
	'PLAY_TEXT' 					=> 'Odtwórz',
	'PLAY_TITLE' 					=> 'Odtwórz pokaz slajdów (spacja)',
	'PAUSE_TEXT' 					=> 'Wstrzymaj',
	'PAUSE_TITLE' 					=> 'Wstrzymaj pokaz (spacja)',
	'PREVIOUS_TITLE' 				=> 'Poprzednie (strzałka w lewo)',
	'NEXT_TITLE' 					=> 'Następne (strzałka w prawo',
	'MOVE_TITLE' 					=> 'Przedź',
	'IMAGE_NUMBER' 					=> 'Grafika %1 of %2',
	'RESTORE_TITLE' 				=> 'Kliknij aby zamknąć zdjęcie, kliknij i przeciągnij, aby przenieść. Używaj strzałek do poprzedniej i następnej.',
	
	'IMG_ICON_REIMG_LOADING'		=> 'Ładowanie',
	'IMG_ICON_REIMG_ZOOM_IN'		=> 'Powiększ',
	'IMG_ICON_REIMG_ZOOM_OUT'		=> 'Pomniejsz',
	
	'REIMG_ZOOM_IN'					=> 'Powiększ (rzeczywiste wymiary: %1$d x %2$d)',
	'REIMG_ZOOM_OUT'				=> 'Pomniejsz',
));

