<?php
/**
*
* reimg [Croatian]
*
* @package language
* @copyright (c) 2011 phpbb.com.hr
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
	'ACP_CAT_REIMG'					=> 'ReIMG Image Resizer',
	'ACP_REIMG_CONFIG'				=> 'ReIMG Image Resizer konfiguracija',
	'ACP_REIMG_CONFIG_EXPLAIN'		=> 'ReIMG Image Resizer će promjeniti veličinu slike pomoću JavaScript koristeći jedan od efekata za povećanje slike pomoću JavaScript efekta.',

	'REIMG_VERSION'					=> 'ReIMG verzija',
	'REIMG_ENABLE'					=> 'Omogući ReIMG Image Resizer',
	'REIMG_OPTIONS'					=> 'ReIMG Image Resizer opcije',
	'REIMG_SETTINGS'				=> 'Image resize podešenje',
	'REIMG_MAX_SIZE'				=> 'Najveće dimenzije slika',
	'REIMG_MAX_SIZE_EXPLAIN'		=> 'Kada je slika veća od toga bit će omogućena promjena veličine. Postavite na 0 kako bi onemogućili promjenu širine i visine slike.',
	'REIMG_REL_WIDTH'				=> 'Maksimalna relativna širina slike',
	'REIMG_REL_WIDTH_EXPLAIN'		=> 'Kada je slika šira od ovoga bit će omogućena promjena širine. Postavite na 0 da se ignorira relativna širina.',
	'REIMG_SWAP_PORTRAIT'			=> 'Normalizacija Pejzaž / Portret',
	'REIMG_SWAP_PORTRAIT_EXPLAIN'	=> 'Ako je postavljeno na Da maksimalna dimenzija se labavo primjenjuje, tako su slike krajolkai portreta jednako izmjenjene. Ako se postavi NE maksimalna širina i/ili visina bit će strogo primjenjene.',
	'REIMG_LINK_METHOD'				=> 'Link zumiranja',
	'REIMG_LINK_METHOD_EXPLAIN'		=> 'Odaberite metodu koja se koristi za povezivanje sa originalom, veće slika.',

	'reimg_linking_methods'			=> array(
		'button'			=> 'Zum gumb',
		'link'				=> 'Link za promjenu veličine slike',
		'button_link'		=> 'Oba',
	),

	'REIMG_ZOOM_METHOD'				=> 'Metoda zumiranja',
	'REIMG_ZOOM_METHOD_EXPLAIN'		=> 'Odaberite metodu koja se koristi za prikaz originala, veće slike..<br /><br />NAPOMENA: Ako želite koristiti isključen izbor sljedite upute prikazane uz odabrane isključene opcije',

	'reimg_zooming_methods'			=> array(
		'_blank' 		=> 'Novi prozor',
		'_default' 		=> 'Normalan link',
		'_exturl' 		=> 'Vanjski link',
		'_litebox' 		=> 'Litebox',
		'_litebox1'		=> array(
								'Zum na sliku u punoj veličini na početni klik.',
								'Litebox 1:1',
							),
		'_highslide'	=> array(
								'High slide - Koristite download link Highslide JS ZIP paketa. Zatim stavite zip pakete  highslide direktorij u vašem forum direktoriju.',
								'<a href="http://highslide.com/download.php" style="text-decoration: underline;">Highslide</a>',
							),
		'_lytebox'		=> array(
								'Lytebox - Koristite download link Lytebox ZIP paketa. Otpakirajte zip sadržaj u prazan lytebox direktorij i prebaci u pripadajući folder direktorij na forumu. Ne radi dobro sa Internet Explorer 9 UNLESS X-UA-Compatible TAG IS CHANGED IN overall_header.html.',
								'<a href="http://www.dolem.com/lytebox/" style="text-decoration: underline;">Lytebox</a>',
							),
	),

	'REIMG_IGNORE_SIG_IMG'			=> 'Zanemari slike u potpisima',
	'REIMG_IGNORE_SIG_IMG_EXPLAIN'	=> 'Ako je postavljeno na Da onda slike u potpisima neće se mijenjati.',
	'REIMG_ATTACHMENTS'				=> 'Primjeni ReIMG na slike u privitcima',
	'REIMG_ATTACHMENTS_EXPLAIN'		=> 'Onemogućuje stvaranje mini slika u privicima. (NE retro-aktivno, primjenjuje se i na stare slike privitaka)',

	'REIMG_UPDATED'					=> 'ReIMG Image Resizer postavke su uspješno spremljene.',

	'LOG_REIMG_UPDATED'				=> '<strong>Ažurirano ReIMG Image Resizer Postavke</strong>',
));

$lang = array_merge($lang, array(
	'acl_a_reimg'	=> array('lang' => 'Upravljanje ReIMG Image Resizer postavkama', 'cat' => 'postavke')
));

