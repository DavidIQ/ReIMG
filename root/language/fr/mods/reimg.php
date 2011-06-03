<?php
/**
*
* reimg [French]
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
	'LOADING_TEXT'					=> 'Chargement...',
	'LOADING_TITLE'					=> 'Annuler',
	'FOCUS_TITLE'					=> 'Cliquez pour mettre au premier plan',
	'FULL_EXPAND_TITLE'				=> 'Taille originale (f)',
	'CREDITS_TEXT'					=> 'DÃ©velopper par <em>Highslide JS</em>',
	'CREDITS_TITLE'					=> 'Page d\'accueil Highslide JS',
	'PREVIOUS_TEXT'					=> 'PrÃ©cÃ©dent',
	'NEXT_TEXT'						=> 'Suivant',
	'MOVE_TEXT'						=> 'DÃ©placer',
	'CLOSE_TEXT'					=> 'Fermer',
	'CLOSE_TITLE'					=> 'Fermer tout (esc)',
	'RESIZE_TITLE' 					=> 'Redimensionner',
	'PLAY_TEXT' 					=> 'Lancer',
	'PLAY_TITLE' 					=> 'Lancer le slideshow (spacebar)',
	'PAUSE_TEXT' 					=> 'Pause',
	'PAUSE_TITLE' 					=> 'Pause slideshow (spacebar)',
	'PREVIOUS_TITLE' 				=> 'PrÃ©cÃ©dent (arrow left)',
	'NEXT_TITLE' 					=> 'Suivant (arrow right)',
	'MOVE_TITLE' 					=> 'DÃ©placer',
	'IMAGE_NUMBER' 					=> 'Image de %1 à %2',
	'RESTORE_TITLE' 				=> 'Click to close image, click and drag to move. Use arrow keys for next and previous.',
	
	'IMG_ICON_REIMG_LOADING'		=> 'Chargement',
	'IMG_ICON_REIMG_ZOOM_IN'		=> 'Zoom avant',
	'IMG_ICON_REIMG_ZOOM_OUT'		=> 'Zoom arrière',
	
	'REIMG_ZOOM_IN'					=> 'Zoom avant (dimensions réelles: %1$d x %2$d)',
	'REIMG_ZOOM_OUT'				=> 'Zoom arrière',
));

