<?php
/**
*
* reimg [Deutsch]
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
	'LOADING_TEXT'					=> 'Laden...',
	'LOADING_TITLE'					=> 'Klicken um abzubrechen',
	'FOCUS_TITLE'					=> 'Klicken um nach vorne zu bringen', //Click to bring to front
	'FULL_EXPAND_TITLE'				=> 'Auf aktuelle Größe erweitern (f)',
	'CREDITS_TEXT'					=> 'Powered by <i>Highslide JS</i>',
	'CREDITS_TITLE'					=> 'Zur Highslide JS homepage',
	'PREVIOUS_TEXT'					=> 'Voriges',
	'NEXT_TEXT'						=> 'Nächstes',
	'MOVE_TEXT'						=> 'Bewegen',
	'CLOSE_TEXT'					=> 'Schließen',
	'CLOSE_TITLE'					=> 'Schließen (esc)',
	'RESIZE_TITLE' 					=> 'Größe anpassen',
	'PLAY_TEXT' 					=> 'Play',
	'PLAY_TITLE' 					=> 'Play Slideshow (spacebar)',
	'PAUSE_TEXT' 					=> 'Pause',
	'PAUSE_TITLE' 					=> 'Slideshow pausieren (spacebar)',
	'PREVIOUS_TITLE' 				=> 'Vorheriges (linker Pfeil)',
	'NEXT_TITLE' 					=> 'Nächstes (rechter Pfeil)',
	'MOVE_TITLE' 					=> 'Bewegen',
	'IMAGE_NUMBER' 					=> 'Bild %1 von %2',
	'RESTORE_TITLE' 				=> 'Klicken um Bild zu schließen, Klicken und ziehen zum Bewegen. Pfeiltasten für nächstes und vorheriges benutzen.',
	
	'REIMG_SETTINGS'				=> 'Image Resize Einstellungen',
	'REIMG_MAX_SIZE'				=> 'Maximale Bilddimensionen',
	'REIMG_MAX_SIZE_EXPLAIN'		=> 'Wenn ein Bild größer als dies ist, wird die Größe angepasst. Auf 0 setzen um horizontales und/oder vertikales Anpassen zu deaktivieren.',
	'REIMG_REL_WIDTH'				=> 'Maximale relative Bildbreite',
	'REIMG_REL_WIDTH_EXPLAIN'		=> 'Wenn ein Bild breiter als dies ist, wird die Größe angepasst. Auf 0 setzten um die relative Breite zu ignorieren.',
	'REIMG_SWAP_PORTRAIT'			=> 'Landschaft/Portrait normalisieren',
	'REIMG_SWAP_PORTRAIT_EXPLAIN'	=> 'Falls auf Ja gesetzt, sind die maximalen Abmessungen lose übernommen. Dadurch sind Landschafts- und Portraitbilder gleichermaßen angepasst. Falls auf Nein gesetzt, werden die maximale Breite und/oder Höhe strikt angewendet.',
	'REIMG_LINK_METHOD'				=> 'Zoomlink',
	'REIMG_LINK_METHOD_EXPLAIN'		=> 'Wähle die Methode aus, die genutzt wird um zum originalen, größeren Bild zu verlinken.', 
	'REIMG_LINK_BUTTON'				=> 'Zoombutton',
	'REIMG_LINK_IMAGE'				=> 'Link angepasstes Bild',
	'REIMG_LINK_BOTH'				=> 'Beide',
	'REIMG_ZOOM_BLANK'				=> 'Neues Fenster',
	'REIMG_ZOOM_DEFAULT'			=> 'Normaler Link',
	'REIMG_ZOOM_EXTURL'				=> 'Externer Link',
	'REIMG_ZOOM_LITEBOX'			=> 'Lightbox',
	'REIMG_ZOOM_LITEBOX_1_1'		=> 'Lightbox 1:1',
	'REIMG_ZOOM_LITEBOX_RESIZED'	=> 'Lightbox resized',
	'REIMG_ZOOM_HIGHSLIDE'			=> 'Highslide',
	'REIMG_ZOOM_METHOD'				=> 'Zoommethode',
	'REIMG_ZOOM_METHOD_EXPLAIN'		=> 'Wähle die Methode aus, die genutzt wird um das originale, größere Bild zu sehen.<br /><br />WICHTIG bei Highslide: Falls du Highslide nutzen möchtest, beachte, dass du zuerst das Highslide JS ZIP Packet von <a href="http://highslide.com/download.php">hier</a> herunter laden und die ZIP-Datei im <em>highslide</em>-Verzeichnis deines Forums <em>reimg/highslide</em>-Verzeichnis plazieren musst.',
	'REIMG_IGNORE_SIG_IMG'			=> 'Ignoriere Bilder in Signaturen',
	'REIMG_IGNORE_SIG_IMG_EXPLAIN'	=> 'Falls auf Ja gesetzt werden Bildgrößen in Signaturen nicht angepasst.',
	
	'IMG_ICON_REIMG_LOADING'		=> 'Laden',
	'IMG_ICON_REIMG_ZOOM_IN'		=> 'Reinzoom',
	'IMG_ICON_REIMG_ZOOM_OUT'		=> 'Rauszoomen',
	
	'REIMG_ZOOM_IN'					=> 'Reinzoom (reale Abmessungen: %1$d x %2$d)',
	'REIMG_ZOOM_OUT'				=> 'Rauszoomen',
));

?>