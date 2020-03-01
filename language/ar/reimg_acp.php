<?php
/**
* ReIMG extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 DavidIQ.com
* @license GNU General Public License, version 2 (GPL-2.0)
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
// NOTE TO TRANSLATORS:  Text in parenthesis refers to keys on the keyboard

$lang = array_merge($lang, array(
	'ACP_REIMG_SETTINGS_EXPLAIN'	=> 'ReIMG Image Resizer will resize images on the client side using JavaScript and using one of various selectable effects to expand the images when user clicks on a resized image.',

	'REIMG_VERSION'					=> 'رقم الإصدار :',
	'REIMG_ENABLE'					=> 'تفعيل ',
	'REIMG_OPTIONS'					=> 'الخيارات',
	'REIMG_SETTINGS'				=> 'اعدادات تصغير الصور',
	'REIMG_SWAP_PORTRAIT'			=> 'ضبط الصور العرضية / الطولية ',
	'REIMG_SWAP_PORTRAIT_EXPLAIN'	=> 'اختيارك "نعم" يعني تطبيق الحد الأقصى لأبعاد الصور من أجل تصغير الصور العرضية أو الطولية بشكل متساوي. اختيارك "لا" يعني تطبيق الحد الأقصى للعرض أو الطول للصور.',
	'REIMG_LINK_METHOD'				=> 'طربقة التكبير ',
	'REIMG_LINK_METHOD_EXPLAIN'		=> 'تكبير الصورة سيكون بواسطة النقر على : "زر التكبير" الموجود في أعلى زاوية الصورة / الصورة نفسها / كلا الخيارين السابقين.',

	'reimg_linking_methods'			=> array(
		'button'			=> 'زر التكبير',
		'link'				=> 'الصورة نفسها',
		'button_link'		=> 'معاً',
	),

	'REIMG_ZOOM_METHOD'				=> 'طريقة العرض ',
	'REIMG_ZOOM_METHOD_EXPLAIN'		=> 'اختار طريقة العرض التي تريدها عند تكبير الصورة.',

	'reimg_zooming_methods'			=> array(
		'_default' 		=> array (
								'name'			=> 	'رابط مُباشر',
								'description'	=>	'فتح الصورة بحجمها الطبيعي في نفس الصفحة.',
							),
		'_blank' 		=> array (
								'name'			=>	'صغحة جديدة',
								'description'	=>	'فتح الصورة بحجمها الطبيعي في صفحة جديدة.',
							),
		'_imglightbox' 		=> array (
								'name'			=>	'<a href="http://osvaldas.info/image-lightbox-responsive-touch-friendly" target="_blank">Image Lightbox</a>',
								'description'	=>	'فتح الصورة بحجم أكبر باستخدام الـ Image Lightbox.',
							),
		'_colorbox'		=> array(
								'name'			=>	'<a href="http://www.jacklmoore.com/colorbox/" target="_blank">Colorbox</a>',
								'description'	=>	'فتح الصورة بحجم أكبر باستخدام الـ Colorbox.',
							),
		'_magnific'		=> array(
								'name'			=>	'<a href="http://dimsemenov.com/plugins/magnific-popup/" target="_blank">Magnific Popup</a>',
								'description'	=>	'فتح الصورة بحجم أكبر باستخدام الـ Magnific Popup.',
							),
	),

	'REIMG_RESIZE_SIG_IMG'			=> 'التواقيع ',
	'REIMG_RESIZE_SIG_IMG_EXPLAIN'	=> 'اختيارك "نعم" يعني تصغير الصور في التواقيع أيضاً.',
	'REIMG_ATTACHMENTS'				=> 'تطبيق تصغير الصور في المرفقات',
	'REIMG_ATTACHMENTS_EXPLAIN'		=> 'اختيارك "نعم" يعني استخدام تصغير الصور عند فتح الصور بالمرفقات.',
	'REIMG_FOR_ALL'					=> 'تطبيق تصغير الصور على جميع صور المشاركات ',
	'REIMG_FOR_ALL_EXPLAIN'			=> 'اختيارك "نعم" يعني تصغير جميع الصور الموجودة مُسبقاً في المشاركات , بغض النظر عن حجمها ( كبير أو صغير ).',

	'REIMG_UPDATED'					=> 'تم تحديث الإعدادات بنجاح.',

));
