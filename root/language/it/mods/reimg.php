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
	'LOADING_TITLE'					=> 'Click per cancellare',
	'FOCUS_TITLE'					=> 'Click per portare in primo piano',
	'FULL_EXPAND_TITLE'				=> 'Espandi alle dimensioni reali (tasto f)',
	'CREDITS_TEXT'					=> 'Powered by <i>Highslide JS</i>',
	'CREDITS_TITLE'					=> 'Vai alla Highslide JS homepage',
	'PREVIOUS_TEXT'					=> 'Precedente',
	'NEXT_TEXT'						=> 'Prossimo',
	'MOVE_TEXT'						=> 'Sposta',
	'CLOSE_TEXT'					=> 'Chiudi',
	'CLOSE_TITLE'					=> 'Chiudi (esc)',
	'RESIZE_TITLE' 					=> 'Ridimensiona',
	'PLAY_TEXT' 					=> 'Avvia',
	'PLAY_TITLE' 					=> 'Avvia slideshow (barra spazio)',
	'PAUSE_TEXT' 					=> 'Pausa',
	'PAUSE_TITLE' 					=> 'Pausa slideshow (barra spazio)',
	'PREVIOUS_TITLE' 				=> 'Precedente (freccia a sinistra)',
	'NEXT_TITLE' 					=> 'Prossimo (freccia a destra)',
	'MOVE_TITLE' 					=> 'Sposta',
	'IMAGE_NUMBER' 					=> 'Immagine %1$s di %2$s',
	'RESTORE_TITLE' 				=> 'Clicca l\'immagine per chiuderla, fare clic e trascinare per spostarla. Utilizzare i tasti freccia per la successiva o la precedente.',
	
	'REIMG_SETTINGS'				=> 'Impostazioni ridimensionamento immagine',
	'REIMG_MAX_SIZE'				=> 'Dimensioni massime immagine',
	'REIMG_MAX_SIZE_EXPLAIN'		=> 'Quando un\'immagine è più grande delle dimensioni impostate, sarà ridimensionata. Impostare a 0 per disabilitare orizzontale e/o il ridimensionamento verticale.',
	'REIMG_REL_WIDTH'				=> 'Larghezza massima relativa immagine',
	'REIMG_REL_WIDTH_EXPLAIN'		=> 'Quando un\'immagine è più ampia del valore impostato, sarà ridimensionata. Impostare a 0 per ignorare la larghezza relativa.',
	'REIMG_SWAP_PORTRAIT'			=> 'Normalizza paesaggio/ritratto',
	'REIMG_SWAP_PORTRAIT_EXPLAIN'	=> 'Se impostato a yes, le dimensioni massime sono liberamente applicata, per cui immagini orizzontali e verticali sono ugualmente ridimensionate. Se impostato a no la larghezza massima e/o l\'altezza massima sono rigorosamente rispettate.',
	'REIMG_LINK_METHOD'				=> 'Link zoom',
	'REIMG_LINK_METHOD_EXPLAIN'		=> 'Selezionare il metodo che viene utilizzato per il collegamento all\'immagine originale.',
	'REIMG_LINK_BUTTON'				=> 'Pulsante zoom',
	'REIMG_LINK_IMAGE'				=> 'Link immagine ridimensionata',
	'REIMG_LINK_BOTH'				=> 'Entrambe',
	'REIMG_ZOOM_BLANK'				=> 'Nuova finestra',
	'REIMG_ZOOM_DEFAULT'			=> 'Collegamento normale',
	'REIMG_ZOOM_EXTURL'				=> 'Collegamento esterno',
	'REIMG_ZOOM_LITEBOX'			=> 'Lightbox',
	'REIMG_ZOOM_LITEBOX_1_1'		=> 'Lightbox 1:1',
	'REIMG_ZOOM_LITEBOX_RESIZED'	=> 'Lightbox ridimensionato',
	'REIMG_ZOOM_HIGHSLIDE'			=> 'Highslide',
	'REIMG_ZOOM_METHOD'				=> 'MOdalità zoom',
	'REIMG_ZOOM_METHOD_EXPLAIN'		=> 'Selezionare il metodo che viene utilizzato per visualizzare l\'immagine originale.<br /><br />NOTE su Highslide: Se desideri usare Highslide prima devi scaricare il pacchetto Highslide JS ZIP da <a href="http://highslide.com/download.php">qui</a> e copiare i file della cartella <em>highslide</em> nella cartella <em>reimg/highslide</em> del vostro forum.',
	'REIMG_IGNORE_SIG_IMG'			=> 'Ignora le immagini nelle firme',
	'REIMG_IGNORE_SIG_IMG_EXPLAIN'	=> 'Se impostato su yes le immagini nelle firme non saranno ridimensionate.',
	
	'IMG_ICON_REIMG_LOADING'		=> 'Loading',
	'IMG_ICON_REIMG_ZOOM_IN'		=> 'Zoom +',
	'IMG_ICON_REIMG_ZOOM_OUT'		=> 'Zoom -',
	
	'REIMG_ZOOM_IN'					=> 'Zoom + (dimensioni reali: %1$d x %2$d)',
	'REIMG_ZOOM_OUT'				=> 'Zoom -',
));

?>
