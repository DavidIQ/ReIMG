<?php
/**
*
* reimg [Croatian]
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
	'LOADING_TEXT'			=> 'Učitavanje...',
	'LOADING_TITLE'			=> 'Kliknite za prekid',
	'FOCUS_TITLE'			=> 'Kliknite za povećanje',
	'FULL_EXPAND_TITLE'		=> 'Povećaj na originalnu veličinu (f)',
	'CREDITS_TEXT'			=> 'Powered by <i>Highslide JS</i>',
	'CREDITS_TITLE'			=> 'Idi na Highslide JS stranicu',
	'PREVIOUS_TEXT'			=> 'Prethodni',
	'NEXT_TEXT'				=> 'Slijedeći',
	'MOVE_TEXT'				=> 'Premjesti',
	'CLOSE_TEXT'			=> 'Zatvori',
	'CLOSE_TITLE'			=> 'Zatvori (esc)',
	'RESIZE_TITLE' 			=> 'Promijeni veličinu',
	'PLAY_TEXT' 			=> 'Pokreni',
	'PLAY_TITLE' 			=> 'Pokreni slideshow (spacebar)',
	'PAUSE_TEXT' 			=> 'Pauza',
	'PAUSE_TITLE' 			=> 'Zaustavi slideshow (spacebar)',
	'PREVIOUS_TITLE' 		=> 'Prethodni (arrow left)',
	'NEXT_TITLE' 			=> 'Slijedeći (arrow right)',
	'MOVE_TITLE' 			=> 'Premjesti',
	'IMAGE_NUMBER' 			=> 'Slika %1 of %2',
	'RESTORE_TITLE' 		=> 'Klikni za zatvaranje slike, klikni i pomakni za premještanje. Koristi strelice za prethodnu i slijedeću sliku.',
	
	'REIMG_SETTINGS'				=> 'Postavke promijene veličine slike',
	'REIMG_MAX_SIZE'				=> 'Maksimalne dimenzije slike',
	'REIMG_MAX_SIZE_EXPLAIN'		=> 'Slika će biti smanjena ukoliko je veća od navedenih dimenzija. Postavi na 0 kako bi isključio horizontalnu i/ili vertikalnu promjenu veličine.',
	'REIMG_REL_WIDTH'				=> 'Maksimalna relativna širina slike',
	'REIMG_REL_WIDTH_EXPLAIN'		=> 'Slika će biti smanjena ukoliko je šira od navedenih dimenzija. Postavi na 0 kako bi isključio relativnu širinu.',
	'REIMG_SWAP_PORTRAIT'				=> 'Normaliziraj landscape/portrait',
	'REIMG_SWAP_PORTRAIT_EXPLAIN'		=> 'Ukoliko je postavljeno na Da, maksimalne dimenzije nisu striktno postavljene tako da se dimenzije landscape i portrait jednako mijenjaju. Ukoliko je postavljeno na Ne, maksimalne dimenzije su striktno postavljene i kao takve primijenjene na sliku.',
	'REIMG_LINK_METHOD'				=> 'Zooming link',
	'REIMG_LINK_METHOD_EXPLAIN'		=> 'Select the method that is used to link to the original, larger image.',
	'REIMG_LINK_BUTTON'				=> 'Zooming button',
	'REIMG_LINK_IMAGE'				=> 'Link resized image',
	'REIMG_LINK_BOTH'				=> 'Both',
	'REIMG_ZOOM_BLANK'				=> 'Novi prozor',
	'REIMG_ZOOM_DEFAULT'				=> 'Normalni link',
	'REIMG_ZOOM_EXTURL'				=> 'Eksterni link',
	'REIMG_ZOOM_LITEBOX'				=> 'Lightbox',
	'REIMG_ZOOM_LITEBOX_1_1'			=> 'Lightbox 1:1',
	'REIMG_ZOOM_LITEBOX_RESIZED'			=> 'Lightbox promijenjene veličine',
	'REIMG_ZOOM_HIGHSLIDE'			=> 'Highslide',
	'REIMG_ZOOM_METHOD'				=> 'Zoom metoda',
	'REIMG_ZOOM_METHOD_EXPLAIN'		=> 'Odaberi metodu koja se koristi za povezivanje sa originalnom, većom slikom.<br/>NAPOMENA za Highslide: Ukoliko želiš koristiti Highslide moraš skinuti Highslide JS ZIP paket koji možeš pronaći <a href="http://highslide.com/download.php">ovdje</a> i postaviti <em>highslide</em> direktorij koji se nalazi u skinutom ZIP fileu u forumov <em>reimg/highslide</em> direktorij.',
	'REIMG_IGNORE_SIG_IMG'			=> 'Ignoriraj slike u potpisima',
	'REIMG_IGNORE_SIG_IMG_EXPLAIN'	=> 'Ukoliko je postavljeno na Da, dimenzije slika u potpisima neće biti mijenjane.',
	
	'IMG_ICON_REIMG_LOADING'		=> 'Loading',
	'IMG_ICON_REIMG_ZOOM_IN'	=> 'Povećaj',
	'IMG_ICON_REIMG_ZOOM_OUT'	=> 'Smanji',
	
	'REIMG_ZOOM_IN'				=> 'Povećaj (stvarne dimenzije: %1$d x %2$d)',
	'REIMG_ZOOM_OUT'			=> 'Smanji',
));

?>