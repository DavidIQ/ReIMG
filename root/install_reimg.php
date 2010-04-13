<?php
/**
*
* @package ReIMG Resizer MOD
* @version $Id: install_reimg.php 2009-08-18 12:00:00Z DavidIQ $
* @copyright (c) 2009 DavidIQ
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

$message = array();

if (!isset($config['reimg_max_width']))
{
	set_config('reimg_max_width', '640');
	$message[] = 'Image maximum width setting added';
}
if (!isset($config['reimg_max_height']))
{
	set_config('reimg_max_height', '480');
	$message[] = 'Image maximum height setting added';
}
if (!isset($config['reimg_rel_width']))
{
	set_config('reimg_rel_width', '0');
	$message[] = 'Image maximum relative width setting added';
}
if (!isset($config['reimg_swap_portrait']))
{
	set_config('reimg_swap_portrait', '1');
	$message[] = 'Image portrait setting added';
}
if (!isset($config['reimg_zoom']))
{
	set_config('reimg_zoom', '_litebox');
	$message[] = 'Image zoom method added (default is Litebox)';
}
if (!isset($config['reimg_ignore_sig_img']))
{
	set_config('reimg_ignore_sig_img', '0');
	$message[] = 'Ignore signature images setting added';
}
if (!isset($config['reimg_link']))
{
	set_config('reimg_link', 'button_link');
	$message[] = 'Link type setting added';
}

$message[] = '<p style="margin:10px">ReIMG Image Resizer MOD installed successfully.  Remember to delete this file via your FTP client/program.  Please note that this installer does <strong>NOT</strong> take care of modifying the files for you.  You must do that manually or use AutoMOD.';

page_header('ReIMG Image Resizer MOD Installation');

trigger_error(implode('<br />', $message));

page_footer();

?>