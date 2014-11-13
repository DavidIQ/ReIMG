<?php
/**
* ReIMG extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 DavidIQ.com
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace davidiq\reimg\acp;

class reimg_info
{
	function module()
	{
		return array(
			'filename'	=> '\davidiq\reimg\acp\reimg_module',
			'title'		=> 'ACP_REIMG_SETTINGS',
			'version'	=> '3.0.0',
			'modes'		=> array(
				'main'		=> array(
						'title' => 'ACP_REIMG_SETTINGS',
						'auth' => 'ext_davidiq/reimg && acl_a_board',
						'cat' 	=> array('ACP_CAT_REIMG'),
				),
			),
		);
	}
}
