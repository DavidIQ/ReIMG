<?php
/**
* ReIMG extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 DavidIQ.com
* @license GNU General Public License, version 2 (GPL-2.0)
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package acp
*/
class acp_reimg
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $phpbb_root_path, $phpEx;
		include($phpbb_root_path . 'includes/functions_reimg.' . $phpEx);
		
		$this->tpl_name = 'acp_reimg';
		$this->page_title = 'ACP_REIMG_CONFIG';

		$form_name = 'acp_reimg';
		add_form_key($form_name);

		$submit = (isset($_POST['submit'])) ? true : false;
		$reimg_enabled = request_var('reimg_enabled', reimg_get_config('reimg_enabled', false));
		$reimg_max_width = request_var('reimg_max_width', reimg_get_config('reimg_max_width', ''));
		$reimg_max_height = request_var('reimg_max_height', reimg_get_config('reimg_max_height', ''));
		$reimg_rel_width = request_var('reimg_rel_width', reimg_get_config('reimg_rel_width', ''));
		$reimg_swap_portrait = request_var('reimg_swap_portrait', reimg_get_config('reimg_swap_portrait', false));
		$reimg_ignore_sig_img = request_var('reimg_ignore_sig_img', reimg_get_config('reimg_ignore_sig_img', false));
		$reimg_link = request_var('reimg_link', reimg_get_config('reimg_link', ''));
		$reimg_zoom = request_var('reimg_zoom', reimg_get_config('reimg_zoom', ''));
		$reimg_attachments = (request_var('reimg_attachments', reimg_get_config('img_create_thumbnail', 0)) ? false : true); //Backwards on purpose
		$reimg_xhtml = request_var('reimg_xhtml', reimg_get_config('reimg_xhtml', false));

		if ($submit)
		{
			if (!check_form_key($form_name))
			{
				trigger_error($user->lang['FORM_INVALID']. adm_back_link($this->u_action), E_USER_WARNING);
			}

			//Update configuration now
			set_config('reimg_enabled', $reimg_enabled);
			set_config('reimg_max_width', $reimg_max_width);
			set_config('reimg_max_height', $reimg_max_height);
			set_config('reimg_rel_width', $reimg_rel_width);
			set_config('reimg_swap_portrait', $reimg_swap_portrait);
			set_config('reimg_ignore_sig_img', $reimg_ignore_sig_img);
			set_config('reimg_link', $reimg_link);
			set_config('reimg_zoom', $reimg_zoom);
			set_config('img_create_thumbnail', $reimg_attachments);
			set_config('reimg_xhtml', $reimg_xhtml);

			add_log('admin', 'LOG_REIMG_UPDATED');
			trigger_error($user->lang['REIMG_UPDATED'] . adm_back_link($this->u_action));
		}

		$template->assign_vars(array(
			'S_REIMG_ENABLED'			=> $reimg_enabled,
			'S_REIMG_VERSION'			=> reimg_get_config('reimg_version', '2.0.2'),

			'S_REIMG_MAX_WIDTH'			=> $reimg_max_width,
			'S_REIMG_MAX_HEIGHT'		=> $reimg_max_height,
			'S_REIMG_REL_WIDTH'			=> $reimg_rel_width,
			'S_REIMG_SWAP_PORTRAIT'		=> $reimg_swap_portrait,
			'S_REIMG_IGNORE_SIG_IMG'	=> $reimg_ignore_sig_img,
			'S_REIMG_LINK'				=> select_reimg_link_method($reimg_link),
			'S_REIMG_ZOOM'				=> select_reimg_zoom_method($reimg_zoom),
			'S_REIMG_ATTACHMENTS'		=> $reimg_attachments,
			'S_REIMG_XHTML'				=> $reimg_xhtml,

			'U_ACTION'					=> $this->u_action,
		));
	}
	
	/**
	* Select resized image link method
	*/
	function select_reimg_link_method($selected_value)
	{
		global $user;

		$link_options = '';
		$link_method_ary = array();

		//Make sure we have the language key
		if (isset($user->lang['reimg_linking_methods']))
		{
			$link_method_ary = $user->lang['reimg_linking_methods'];
		}

		foreach ($link_method_ary as $link_mehod => $lang)
		{
			$selected = ($selected_value == $link_mehod) ? ' selected="selected"' : '';
			$link_options .= '<option value="' . $link_mehod . '"' . $selected . '>' . $lang . '</option>';
		}

		return $link_options;
	}

	/**
	* Select resized image zoom method
	*/
	function select_reimg_zoom_method($selected_value)
	{
		global $user, $phpbb_root_path;

		$zoom_options = '';
		$zoom_method_ary = array();

		//Make sure we have the language key
		if (isset($user->lang['reimg_zooming_methods']))
		{
			$zoom_method_ary = $user->lang['reimg_zooming_methods'];
		}

		foreach ($zoom_method_ary as $zoom_method => $lang)
		{
			$instructions = '';

			//For instructions
			if (is_array($lang))
			{
				$instructions = $lang[0];
				$lang = $lang[1];
			}

			$disabled = '';

			//Check to see if zoom method is available
			switch ($zoom_method)
			{
				case '_highslide':
					//We need one of the highslide js libraries
					if (!file_exists($phpbb_root_path . 'reimg/highslide/highslide-full.packed.js'))
					{
						$disabled = ' disabled';
						$lang = '<em>' . $lang . (($instructions) ? ' - ' . $instructions : '') . '</em>';
					}
				break;

				case '_lytebox':
					//We need the Lytebox library
					if (!file_exists($phpbb_root_path . 'reimg/lytebox/lytebox.js'))
					{
						$disabled = ' disabled';
						$lang = '<em>' . $lang . (($instructions) ? ' - ' . $instructions : '') . '</em>';
					}
				break;
			}

			$checked = ($selected_value == $zoom_method) ? ' checked="checked"' : '';
			$zoom_options .= '<label style="white-space: normal;"><input type="radio" name="reimg_zoom" ' . (!strpos($zoom_options, 'id="reimg_zoom"') ? 'id="reimg_zoom" ' : '') . 'value="' . $zoom_method . '" class="radio"' . $checked . $disabled . ' /> ' . $lang . "</label><br />\n";
		}

		return $zoom_options;
	}

}

?>