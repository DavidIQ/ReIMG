<?php
/**
* @package ReIMG Image Resizer AJAX
* @copyright (c) 2011 DavidIQ.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

define('IN_PHPBB', true);
$phpbb_root_path = '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'includes/functions.' . $phpEx);

//Session management not needed.  We're only returning image height and width

$width = 0;
$height = 0;
$imgsrc = request_var('img', '');

if ($imgsrc)
{
	//We use getimagesize to get the height and width of the image
	list($width, $height) = @getimagesize(urldecode($imgsrc));
}

echo (int) $width . '||' . (int) $height;

