<?php
/**
*
* reimg [Arabic]
*
* @package language
* @copyright (c) 2011 DavidIQ.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* 
* Translated By : Basil Taha Alhitary - www.alhitary.net
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
	'LOADING_TEXT'					=> 'جاري التحميل...',
	'FULL_EXPAND_TITLE'				=> 'التكبير للحجم الطبيعي (انقر زر الـ f)',
	'PREVIOUS_TEXT'					=> 'السابق',
	'PREVIOUS_TITLE' 				=> 'السابق (السهم اليسار)',
	'NEXT_TEXT'						=> 'التالي',
	'NEXT_TITLE' 					=> 'التالي (السهم اليمين)',
	'CLOSE_TEXT'					=> 'اغلاق',
	'CLOSE_TITLE'					=> 'اغلاق (انقر زر الـ esc)',
	'PLAY_TEXT' 					=> 'تشغيل',
	'PLAY_TITLE' 					=> 'تشغيل العرض (انقر زر المسافة space)',
	'PAUSE_TEXT' 					=> 'توقيف مؤقت',
	'PAUSE_TITLE' 					=> 'توقيف مؤقت للعرض (انقر زر المسافة space)',
	'IMAGE_NUMBER' 					=> 'الصورة رقم %1$d من %2$d',
	
	'REIMG_ZOOM_IN'					=> 'تكبير (الأبعاد الحقيقية : %1$d x %2$d)',
	'REIMG_ZOOM_OUT'				=> 'تصغير',
	'REIMG_USER_LINK'				=> 'رابط الصورة المُخصصة للعضو',
));

