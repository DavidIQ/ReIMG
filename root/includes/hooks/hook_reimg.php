<?php
/**
* @package ReIMG Image Resizer
* @copyright (c) 2011 DavidIQ.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

//Don't load hook if not installed.
if (!isset($config['reimg_version']))
{
	return;
}

/**
 * A hook that is used to change the behavior of phpBB just before the templates
 * are displayed.
 * @param	phpbb_hook	$hook	the phpBB hook object
 * @return	void
 */
function reimg_template_hook(&$hook)
{
	global $template, $config, $phpEx, $phpbb_root_path, $user;

	$page_name = substr($user->page['page_name'], 0, strpos($user->page['page_name'], '.'));

	if (!defined('LOAD_REIMG') && in_array($page_name, array('memberlist', 'posting', 'ucp', 'viewtopic')))
	{
		define('LOAD_REIMG', true);
	}

	//This will prevent further loading of this hook.  If you need this hook loaded on a page other than
	//the ones in the above array then add a define('LOAD_REIMG', true) to the top of your page.
	if (!defined('LOAD_REIMG'))
	{
		return;
	}

	if (!function_exists('reimg_get_config'))
	{
		include($phpbb_root_path . 'includes/functions_reimg.' . $phpEx);
	}

	$user->add_lang('mods/reimg');

	//Standard template variables
	$template->assign_vars(array(
		'S_REIMG'					=> reimg_get_config('reimg_enabled', false) && (reimg_get_config('reimg_zoom') && (reimg_get_config('reimg_max_width') || reimg_get_config('reimg_max_height') || reimg_get_config('reimg_rel_width'))),
		'REIMG_MAX_WIDTH'			=> reimg_get_config('reimg_max_width', 0),
		'REIMG_MAX_HEIGHT'			=> reimg_get_config('reimg_max_height', 0),
		'REIMG_REL_WIDTH'			=> reimg_get_config('reimg_rel_width', 0),
		'S_REIMG_SWAP_PORTRAIT'		=> reimg_get_config('reimg_swap_portrait', 0),
		'S_REIMG_BUTTON'			=> (strpos(reimg_get_config('reimg_link'), 'button') !== false) ? 1 : 0,
		'S_REIMG_LINK'				=> (strpos(reimg_get_config('reimg_link'), 'link') !== false) ? 1 : 0,
		'S_REIMG_ZOOM'				=> (strpos(reimg_get_config('reimg_zoom'), '_litebox') !== false) ? '_litebox' : reimg_get_config('reimg_zoom'),
		'S_REIMG_ATTACHMENTS'		=> (reimg_get_config('img_create_thumbnail', 0) ? false : true),
		'S_REIMG_ZOOM_METHOD'		=> reimg_get_config('reimg_zoom'),

		'REIMG_AJAX_URL'			=> generate_board_url() . "/reimg/reimg_ajax.$phpEx",
	));

	//Now we need to handle some pages
	switch ($page_name)
	{
		case 'memberlist':
			//Viewing user profile
			if (request_var('mode', '') == 'viewprofile' && reimg_get_config('reimg_ignore_sig_img', false) == false)
			{
				if (isset($template->_tpldata['.'][0]['SIGNATURE']))
				{
					$template->assign_var('SIGNATURE', insert_reimg_properties($template->_tpldata['.'][0]['SIGNATURE']));
				}
			}
		break;

		case 'posting':
			//Topic review area shown when posting a reply
			if (!empty($template->_tpldata['topic_review_row']))
			{
				foreach ($template->_tpldata['topic_review_row'] as $row => $data)
				{
					// Alter the array
					$template->alter_block_array('topic_review_row', array(
						'MESSAGE' 	=> insert_reimg_properties($data['MESSAGE']),
					), $row, 'change');
				}
			}

			//Message preview
			if (isset($template->_tpldata['.'][0]['PREVIEW_MESSAGE']))
			{
				$template->assign_var('PREVIEW_MESSAGE', insert_reimg_properties($template->_tpldata['.'][0]['PREVIEW_MESSAGE']));
			}

			//Signature in post preview
			if (isset($template->_tpldata['.'][0]['PREVIEW_SIGNATURE']) && reimg_get_config('reimg_ignore_sig_img', false) == false)
			{
				$template->assign_var('PREVIEW_SIGNATURE', insert_reimg_properties($template->_tpldata['.'][0]['PREVIEW_SIGNATURE']));
			}
		break;

		case 'ucp':
			//Signature editing area
			if (request_var('mode', '') == 'signature' && reimg_get_config('reimg_ignore_sig_img', false) == false)
			{
				if (isset($template->_tpldata['.'][0]['SIGNATURE_PREVIEW']))
				{
					$template->assign_var('SIGNATURE_PREVIEW', insert_reimg_properties($template->_tpldata['.'][0]['SIGNATURE_PREVIEW']));
				}
			}

			$prefix = '';

			//Test to see if we're in preview mode
			if (isset($template->_tpldata['.'][0]['PREVIEW_MESSAGE']))
			{
				$prefix = 'PREVIEW_';
			}

			//The actual message
			if (isset($template->_tpldata['.'][0][$prefix . 'MESSAGE']))
			{
				$template->assign_var($prefix . 'MESSAGE', insert_reimg_properties($template->_tpldata['.'][0][$prefix . 'MESSAGE']));
			}

			//Message's signature
			if (isset($template->_tpldata['.'][0][$prefix . 'SIGNATURE']) && reimg_get_config('reimg_ignore_sig_img', false) == false)
			{
				$template->assign_var($prefix . 'SIGNATURE', insert_reimg_properties($template->_tpldata['.'][0][$prefix . 'SIGNATURE']));
			}

			//Handle attachments
			if (isset($template->_tpldata['attachment']) && reimg_get_config('img_create_thumbnail', false) == false)
			{
				foreach ($template->_tpldata['attachment'] as $row => $data)
				{
					// Alter the array
					$template->alter_block_array('attachment', array(
						'DISPLAY_ATTACHMENT' 	=> insert_reimg_properties($data['DISPLAY_ATTACHMENT']),
					), $row, 'change');
				}
			}

			//Message history section
			if (!empty($template->_tpldata['history_row']))
			{
				foreach ($template->_tpldata['history_row'] as $row => $data)
				{
					// Alter the array
					$template->alter_block_array('history_row', array(
						'MESSAGE' 	=> insert_reimg_properties($data['MESSAGE']),
					), $row, 'change');
				}
			}
		break;

		case 'viewtopic':
			if (!empty($template->_tpldata['postrow']))
			{
				foreach ($template->_tpldata['postrow'] as $row => $data)
				{
					// Alter the array
					$template->alter_block_array('postrow', array(
						'MESSAGE' 	=> insert_reimg_properties($data['MESSAGE']),
						'SIGNATURE'	=> (reimg_get_config('reimg_ignore_sig_img', false) ? $data['SIGNATURE'] : insert_reimg_properties($data['SIGNATURE'])),
					), $row, 'change');

					//Handle attachments
					if (isset($data['attachment']) && reimg_get_config('img_create_thumbnail', false) == false)
					{
						foreach ($data['attachment'] as $attachrow => $attachment)
						{
							$data['attachment'][$attachrow]['DISPLAY_ATTACHMENT'] = insert_reimg_properties($attachment['DISPLAY_ATTACHMENT']);
						}

						$template->alter_block_array('postrow', array(
							'attachment'	=> $data['attachment'],
						), $row, 'change');
					}
				}
			}
		break;
	}
}

// Register
if (isset($config['reimg_enabled']) && $config['reimg_enabled'])
{
	$phpbb_hook->register(array('template', 'display'), 'reimg_template_hook');
}