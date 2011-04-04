<?php
/**
*
* @package ReIMG Image Resizer
* @copyright (c) 2011 DavidIQ.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package module_install
*/
class acp_reimg_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_reimg',
			'title'		=> 'ACP_REIMG_CONFIG',
			'version'	=> '2.0.0',
			'modes'		=> array(
				'main'		=> array(
						'title' => 'ACP_REIMG_CONFIG',
						'auth'	=> 'acl_a_reimg',
						'cat' 	=> array('ACP_CAT_REIMG'),
				),
			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}

?>