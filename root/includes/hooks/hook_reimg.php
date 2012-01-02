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
	global $template, $phpEx, $phpbb_root_path, $user;

	$page_name = substr($user->page['page_name'], 0, strpos($user->page['page_name'], '.'));

	if (!defined('LOAD_REIMG') && in_array($page_name, array('memberlist', 'posting', 'ucp', 'mcp', 'viewtopic')))
	{
		define('LOAD_REIMG', true);
	}

	//This will prevent further loading of this hook.  If you need this hook loaded on a page other than
	//the ones in the above array then add a define('LOAD_REIMG', true) to the top of your page.
	if (!defined('LOAD_REIMG') || LOAD_REIMG == false)
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
		'S_REIMG_BUTTON'			=> (strpos(reimg_get_config('reimg_link'), 'button') !== false) ? true : false,
		'S_REIMG_LINK'				=> (strpos(reimg_get_config('reimg_link'), 'link') !== false) ? true : false,
		'S_REIMG_ZOOM'				=> (strpos(reimg_get_config('reimg_zoom'), '_litebox') !== false) ? '_litebox' : reimg_get_config('reimg_zoom'),
		'S_REIMG_ATTACHMENTS'		=> (reimg_get_config('img_create_thumbnail', 0) ? false : true),
		'S_REIMG_ZOOM_METHOD'		=> reimg_get_config('reimg_zoom'),
		'S_REIMG_XHTML'				=> reimg_get_config('reimg_xhtml'),

		'REIMG_AJAX_URL'			=> generate_board_url() . "/reimg/reimg_ajax.$phpEx",
	));

	//Handle posts

	//Message preview
	process_template_block_reimg('', 'PREVIEW_MESSAGE');

	//Post preview
	process_template_block_reimg('', 'POST_PREVIEW');

	//The actual message
	process_template_block_reimg('', 'MESSAGE');

	//Topic review area shown when posting a reply
	process_template_block_reimg('topic_review_row', 'MESSAGE');

	//Message history section
	process_template_block_reimg('history_row', 'MESSAGE');

	//Handle attachments
	if (reimg_get_config('img_create_thumbnail', false) == false)
	{
		process_template_block_reimg('attachment', 'DISPLAY_ATTACHMENT');
	}

	//postrow needs some special handling
	if (!empty($template->_tpldata['postrow']))
	{
		foreach ($template->_tpldata['postrow'] as $row => $data)
		{
			if (isset($data['MESSAGE']))
			{
				// Alter the array
				$template->alter_block_array('postrow', array(
					'MESSAGE' 	=> insert_reimg_properties($data['MESSAGE']),
				), $row, 'change');
			}

			if (isset($data['SIGNATURE']) && reimg_get_config('reimg_ignore_sig_img', false) == true)
			{
				// Alter the array
				$template->alter_block_array('postrow', array(
					'SIGNATURE'	=> insert_reimg_properties($data['SIGNATURE']),
				), $row, 'change');
			}

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

	//If there is some REIMG post block definition let's take care of it.
	//REIMG_POST_ROW must be of the format: postrow.BLOCK_NAME
	if (defined('REIMG_POST_ROW'))
	{
		$reimg_post_row = explode('.', REIMG_POST_ROW);
		if (sizeof($reimg_post_row) == 2)
		{
			process_template_block_reimg($reimg_post_row[0], $reimg_post_row[1]);
		}
		else
		{
			process_template_block_reimg('', $reimg_post_row[0]);
		}
	}

	//Handle signatures
	if (reimg_get_config('reimg_ignore_sig_img', false) == false)
	{
		//Viewing profile
		process_template_block_reimg('', 'SIGNATURE');

		//Signature in post preview
		process_template_block_reimg('', 'PREVIEW_SIGNATURE');

		//Signature preview area
		process_template_block_reimg('', 'SIGNATURE_PREVIEW');
	}
}

// Register
if (isset($config['reimg_enabled']) && $config['reimg_enabled'])
{
	$phpbb_hook->register(array('template', 'display'), 'reimg_template_hook');
}