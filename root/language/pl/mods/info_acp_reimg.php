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
	'ACP_CAT_REIMG'					=> 'ReIMG Image Resizer',
	'ACP_REIMG_CONFIG'				=> 'ReIMG Image Resizer konfiguracja',
	'ACP_REIMG_CONFIG_EXPLAIN'		=> 'ReIMG Image Resizer będzie zmniejszać rozmiar obrazów przy użyciu JavaScript i przy użyciu efektu do powiększnia obrazu, gdy użytkownik kliknie na pomniejszony obraz.',

	'REIMG_VERSION'					=> 'ReIMG wersja',
	'REIMG_ENABLE'					=> 'Włącz ReIMG Image Resizer',
	'REIMG_OPTIONS'					=> 'Opcje',
	'REIMG_SETTINGS'				=> 'Ustawienia skalowania grafiki',
	'REIMG_MAX_SIZE'				=> 'Maksymalny rozmiar obrazu',
	'REIMG_MAX_SIZE_EXPLAIN'		=> 'Gdy obraz jest większy niż ten będzie zmniejszany. Ustaw na 0, aby wyłączyć zmniejszanie poziomej lub pionowej.',
	'REIMG_REL_WIDTH'				=> 'Maksymalna szerokość obrazu',
	'REIMG_REL_WIDTH_EXPLAIN'		=> 'Gdy obraz jest szerszy niż ten będzie zmniejszany. Ustaw na 0, aby pominąć zmniejszanie szerokości.',
	'REIMG_SWAP_PORTRAIT'			=> 'Normalizacja krajobraz/portret',
	'REIMG_SWAP_PORTRAIT_EXPLAIN'	=> 'Jeśli jest ustawiony na tak maksymalne wymiary swobodnie stosować, więc krajobrazu i portretów są równie przeskalowane. Jeśli jest ustawione na nie maksymalną szerokość i/lub wysokość są ściśle egzekwowane.',
	'REIMG_LINK_METHOD'				=> 'Link do oryginalnego obrazu',
	'REIMG_LINK_METHOD_EXPLAIN'		=> 'Wybierz metodę, która służy do link do oryginału, większy obraz.',

	'reimg_linking_methods'			=> array(
		'button'			=> 'Przycisk powiększania',
		'link'				=> 'Link powiększonego obrazu',
		'button_link'		=> 'Oba',
	),

	'REIMG_ZOOM_METHOD'				=> 'Metoda powiększania',
	'REIMG_ZOOM_METHOD_EXPLAIN'		=> 'Wybierz metodę, która służy do wyświetlenia oryginalnej, większy obraz.<br /><br />UWAGA: Jeśli chcesz korzystać z dwóch ostatnich metod postępuj zgodnie z instrukcjami, które są wyświetlane obok danej metody.',

	'reimg_zooming_methods'			=> array(
		'_blank' 		=> 'Nowe okno',
		'_default' 		=> 'Normalny link',
		'_exturl' 		=> 'Zewnętrzny link',
		'_litebox' 		=> 'Litebox',
		'_litebox1'		=> array(
								'Powiększenie do obrazu w pełnym rozmiarze po kliknięciu na pomniejszony obraz.',
								'Litebox 1:1',
							),
		'_highslide'	=> array(
								'Użyj linku do pobrania pakietu Highslide JS ZIP. Rozpakuj zawartość do pustego katalogu <em>highslide</em> i wyślij do katalogu <em>reimg</em> (na serwerze forum).',
								'<a href="http://highslide.com/download.php" style="text-decoration: underline;">Highslide</a>',
							),
		'_lytebox'		=> array(
								'Użyj linku do pobrania pakietu Lytebox ZIP. Rozpakuj zawartość do pustego katalogu <em>lytebox</em> i wyślij do katalogu <em>reimg</em> (na serwerze forum). NIE DZIAŁA DOBRZE Z INTERNET EXPLORER 9, jeżeli UNLESS X-UA-Compatible TAG JEST ZMIENIONY W overall_header.html.',
								'<a href="http://www.dolem.com/lytebox/" style="text-decoration: underline;">Lytebox</a>',
							),
	),

	'REIMG_IGNORE_SIG_IMG'			=> 'Ignoruj sygnaturki (obrazy podpisów)',
	'REIMG_IGNORE_SIG_IMG_EXPLAIN'	=> 'Jeśli jest ustawiony na tak to sygnaturki nie zostanią zmniejszone.',
	'REIMG_ATTACHMENTS'				=> 'Zastosuj ReIMG do obrazów załączników',
	'REIMG_ATTACHMENTS_EXPLAIN'		=> 'Wyłącza tworzenie miniatur podczas dołączania zdjęć. (NIE DLA WCZEŚNIEJSZYCH, czyli nie wpłynie na zmianę ustawień starych załączników)',

	'REIMG_UPDATED'					=> 'ReIMG Image Resizer ustawienia zostały zaktualizowane.',

	'LOG_REIMG_UPDATED'				=> '<strong>Zaktualizowano ustawienia ReIMG Image Resizer</strong>',
));

$lang = array_merge($lang, array(
	'acl_a_reimg'	=> array('lang' => 'Może zarządzać ustawieniami ReIMG Image Resizer', 'cat' => 'settings')
));

