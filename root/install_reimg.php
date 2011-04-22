<?php
/**
*
* @author DavidIQ (David Colon) davidiq@phpbb.com
* @package umil
* @copyright (c) 2011 DavidIQ
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

$mod_name = 'ACP_CAT_REIMG';
$version_config_name = 'reimg_version';
$language_file = 'mods/info_acp_reimg';

$versions = array(
	'2.0.0' => array(
		'config_add' => array(
			array('reimg_enabled', true),
			array('reimg_max_width', 640),
			array('reimg_max_height', 480),
			array('reimg_rel_width', 0),
			array('reimg_swap_portrait', 1),
			array('reimg_ignore_sig_img', false),
			array('reimg_link', 'button_link'),
			array('reimg_zoom', '_litebox'),
		),

		'permission_add' => array(
			array('a_reimg', true),
		),

		'module_add' => array(
			array('acp', 'ACP_CAT_DOT_MODS', 'ACP_CAT_REIMG'),
			
			array('acp', 'ACP_CAT_REIMG', array(
					'module_basename'		=> 'reimg',
					'module_langname'		=> 'ACP_REIMG_CONFIG',
					'modes'					=> 'main',
					'module_auth'			=> 'acl_a_reimg',
				),
			),
		),
	),
	'2.0.1' => array(
		'config_add' => array(
			array('reimg_xhtml', false),
		),
	),
);

include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

//Clear cache
$umil->cache_purge(array(
	array(''),
	array('auth'),
	array('template'),
	array('theme'),
));