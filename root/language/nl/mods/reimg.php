<?php
/**
*
* reimg [Dutch]
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
	// Highslide translation originally copied partly from the Highslide JS forum
	// <http://highslide.com/forum/viewtopic.php?p=9402#p9402>
	'LOADING_TEXT'					=> 'Laden...',
	'LOADING_TITLE'					=> 'Klik om te annuleren',
	'FOCUS_TITLE'					=> 'Klik om naar voren te brengen',
	'FULL_EXPAND_TITLE'				=> 'Vergroot naar origineel (f)',
	'CREDITS_TEXT'					=> 'Powered bij <i>Highslide JS</i>',
	'CREDITS_TITLE'					=> 'Ga naar de homepage van Highslide JS',
	'PREVIOUS_TEXT'					=> 'Vorige',
	'NEXT_TEXT'						=> 'Volgende',
	'MOVE_TEXT'						=> 'Verplaats',
	'CLOSE_TEXT'					=> 'Sluiten',
	'CLOSE_TITLE'					=> 'Sluiten (esc)',
	'RESIZE_TITLE'	 				=> 'Verander grootte',
	'PLAY_TEXT' 					=> 'Afspelen',
	'PLAY_TITLE' 					=> 'Speel slidshow af (spatiebalk)',
	'PAUSE_TEXT' 					=> 'Pauze',
	'PAUSE_TITLE' 					=> 'Slideshow pauze (spatiebalk)',
	'PREVIOUS_TITLE' 				=> 'Vorige (linker pijl toets)',
	'NEXT_TITLE' 					=> 'Volgende (rechter pijl toets)',
	'MOVE_TITLE' 					=> 'Verplaats',
	'IMAGE_NUMBER' 					=> 'Afbeelding %1 van %2',
	'RESTORE_TITLE' 				=> 'Klik om te sluiten, Klik en sleep om te verplaatsen. Gebruik pijltjes toetsen voor volgende vorige.',
	
	'REIMG_SETTINGS'				=> 'Afbeeldingen verkleinen',
	'REIMG_MAX_SIZE'				=> 'Maximum afbeeldinggrootte',
	'REIMG_MAX_SIZE_EXPLAIN'		=> 'Als een afbeelding groter is dan dit, dan zal deze worden verkleind. Stel op 0 in om het horizontaal en/of verticaal verkleinen uit te schakelen.',
	'REIMG_REL_WIDTH'				=> 'Maximum relatieve afbeeldingbreedte',
	'REIMG_REL_WIDTH_EXPLAIN'		=> 'Als een afbeelding breder is dan dit, dan zal deze worden verkleind. Stel op 0 in om de relatieve breedte te negeren.',
	'REIMG_SWAP_PORTRAIT'			=> 'Standariseer staand/liggend',
	'REIMG_SWAP_PORTRAIT_EXPLAIN'	=> 'Indien ja wordt de maximum afbeeldinggrootte losjes toegepast, waardoor liggende en staande afbeeldingen in dezelfde mate worden verkleind. Indien nee worden de maximum breedte en/of hoogte strict gehandhaafd.',
	'REIMG_IGNORE_SIG_IMG'			=> 'Negeer afbeeldingen in onderschriften',
	'REIMG_IGNORE_SIG_IMG_EXPLAIN'	=> 'Indien ja worden afbeeldingen in onderschriften niet verkleind.',
	'REIMG_LINK_METHOD'				=> 'Zoom link',
	'REIMG_LINK_METHOD_EXPLAIN'		=> 'Kies de methode die zal worden gebruikt om naar de originele, grotere afbeelding te linken.',
	'REIMG_LINK_BUTTON'				=> 'Zoom knop',
	'REIMG_LINK_IMAGE'				=> 'Link verkleinde afbeelding',
	'REIMG_LINK_BOTH'				=> 'Allebei',
	'REIMG_ZOOM_METHOD'				=> 'Zoom methode',
	'REIMG_ZOOM_METHOD_EXPLAIN'		=> 'Kies de methode die zal worden gebruikt om de originele, grotere afbeelding weer te geven.<br/><br/>OPMERKING over Highslide: Als je Highslide wilt gebruiken, dan moet je eerst het Highslide JS ZIP-pakket <a href="http://highslide.com/download.php">hier downloaden</a>. De <em>highslide</em> map uit dit ZIP pakket moet je opslaan in de <em>reimg/highslide</em> map van je forum.',
	'REIMG_ZOOM_DEFAULT'			=> 'Gewone link',
	'REIMG_ZOOM_BLANK'				=> 'Nieuw venster',
	'REIMG_ZOOM_EXTURL'				=> 'Externe link',
	'REIMG_ZOOM_LITEBOX'			=> 'Lightbox',
	'REIMG_ZOOM_LITEBOX_1_1'		=> 'Lightbox 1:1',
	'REIMG_ZOOM_LITEBOX_RESIZED'	=> 'Lightbox verkleind',
	'REIMG_ZOOM_HIGHSLIDE'			=> 'Highslide',
	
	'IMG_ICON_REIMG_LOADING'		=> 'Laden',
	'IMG_ICON_REIMG_ZOOM_IN'		=> 'Zoom in',
	'IMG_ICON_REIMG_ZOOM_OUT'		=> 'Zoom uit',
	
	'REIMG_ZOOM_IN'					=> 'Zoom in (werkelijke afmetingen: %1$d x %2$d)',
	'REIMG_ZOOM_OUT'				=> 'Zoom uit',
));

?>