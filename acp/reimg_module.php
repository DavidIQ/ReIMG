<?php
/**
* ReIMG extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 DavidIQ.com
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace davidiq\reimg\acp;

class reimg_module
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/** @var \phpbb\log\log */
	protected $log;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var ContainerInterface */
	protected $phpbb_container;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/** @var string */
	public $u_action;

	function main($id, $mode)
	{
		global $user, $template, $cache, $config, $phpbb_root_path, $phpEx, $phpbb_container, $request;

		$this->config = $config;
		$this->phpbb_container = $phpbb_container;
		$this->config_text = $this->phpbb_container->get('config_text');
		$this->log = $this->phpbb_container->get('log');
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;

		$this->user->add_lang_ext('davidiq/reimg', 'reimg_acp');

		$this->tpl_name = 'reimg';
		$this->page_title = 'ACP_REIMG_SETTINGS';

		$form_name = 'acp_reimg';
		add_form_key($form_name);

		$reimg_max_width = $this->request->variable('reimg_max_width', (int)$this->config['reimg_max_width']);
		$reimg_max_height = $this->request->variable('reimg_max_height', (int)$this->config['reimg_max_height']);
		$reimg_rel_width = $this->request->variable('reimg_rel_width', (int)$this->config['reimg_rel_width']);
		$reimg_swap_portrait = $this->request->variable('reimg_swap_portrait', (bool)$this->config['reimg_swap_portrait']);
		$reimg_ignore_sig_img = $this->request->variable('reimg_ignore_sig_img', (bool)$this->config['reimg_ignore_sig_img']);
		$reimg_link = $this->request->variable('reimg_link', $this->config['reimg_link']);
		$reimg_zoom = $this->request->variable('reimg_zoom', $this->config['reimg_zoom']);
		$reimg_attachments = ($this->request->variable('reimg_attachments', $this->config['img_create_thumbnail']) ? false : true); //Backwards on purpose
		$reimg_xhtml = $this->request->variable('reimg_xhtml', (bool)$this->config['reimg_xhtml']);

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key($form_name))
			{
				trigger_error($this->user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}

			//Update configuration now
			$this->config->set('reimg_max_width', $reimg_max_width);
			$this->config->set('reimg_max_height', $reimg_max_height);
			$this->config->set('reimg_rel_width', $reimg_rel_width);
			$this->config->set('reimg_swap_portrait', $reimg_swap_portrait);
			$this->config->set('reimg_ignore_sig_img', $reimg_ignore_sig_img);
			$this->config->set('reimg_link', $reimg_link);
			$this->config->set('reimg_zoom', $reimg_zoom);
			$this->config->set('img_create_thumbnail', $reimg_attachments);

			$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_REIMG_UPDATED');
			trigger_error($user->lang['REIMG_UPDATED'] . adm_back_link($this->u_action));
		}

		$template->assign_vars(array(
			'S_REIMG_MAX_WIDTH'			=> $reimg_max_width,
			'S_REIMG_MAX_HEIGHT'		=> $reimg_max_height,
			'S_REIMG_REL_WIDTH'			=> $reimg_rel_width,
			'S_REIMG_SWAP_PORTRAIT'		=> $reimg_swap_portrait,
			'S_REIMG_IGNORE_SIG_IMG'	=> $reimg_ignore_sig_img,
			'S_REIMG_LINK'				=> $this->select_reimg_link_method($reimg_link),
			'S_REIMG_ZOOM'				=> $this->select_reimg_zoom_method($reimg_zoom),
			'S_REIMG_ATTACHMENTS'		=> $reimg_attachments,

			'U_ACTION'					=> $this->u_action,
		));
	}
	
	/**
	* Select resized image link method
	*/
	function select_reimg_link_method($selected_value)
	{
		$link_options = '';
		$link_method_ary = array();

		//Make sure we have the language key
		if (isset($this->user->lang['reimg_linking_methods']))
		{
			$link_method_ary = $this->user->lang['reimg_linking_methods'];
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
		$zoom_options = '';
		$zoom_method_ary = array();

		//Make sure we have the language key
		if (isset($this->user->lang['reimg_zooming_methods']))
		{
			$zoom_method_ary = $this->user->lang['reimg_zooming_methods'];
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
					if (!file_exists($this->phpbb_root_path . 'reimg/highslide/highslide-full.packed.js'))
					{
						$disabled = ' disabled';
						$lang = '<em>' . $lang . (($instructions) ? ' - ' . $instructions : '') . '</em>';
					}
				break;

				case '_lytebox':
					//We need the Lytebox library
					if (!file_exists($this->phpbb_root_path . 'reimg/lytebox/lytebox.js'))
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
