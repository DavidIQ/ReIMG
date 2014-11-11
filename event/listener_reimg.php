<?php
/**
* ReIMG extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 DavidIQ.com
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace davidiq\reimg\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Constructor
	*
	* @param \phpbb\config\config        $config             Config object
	* @param \phpbb\template\template    $template           Template object
	* @param \phpbb\user                 $user               User object
	* @return \davidiq\reimg\event\listener
	* @access public
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->config = $config;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header'					=> 'load_reimg',
		);
	}

	/**
	* Load ReIMG JS variables
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function load_reimg($event)
	{
		$this->user->add_lang_ext('davidiq/reimg', 'reimg');

		//Standard template variables
		$this->template->assign_vars(array(
			'REIMG_MAX_WIDTH'			=> $this->config['reimg_max_width'],
			'REIMG_MAX_HEIGHT'			=> $this->config['reimg_max_height'],
			'REIMG_REL_WIDTH'			=> $this->config['reimg_rel_width'],
			'S_REIMG_SWAP_PORTRAIT'		=> $this->config['reimg_swap_portrait'],
			'S_REIMG_BUTTON'			=> strpos($this->config['reimg_link'], 'button') !== false,
			'S_REIMG_LINK'				=> strpos($this->config['reimg_link'], 'link') !== false,
			'S_REIMG_ZOOM'				=> (strpos($this->config['reimg_zoom'], '_litebox') !== false) ? '_litebox' : $this->config['reimg_zoom'],
			'S_REIMG_ATTACHMENTS'		=> $this->config['img_create_thumbnail'],
			'S_REIMG_ZOOM_METHOD'		=> $this->config['reimg_zoom'],

			'REIMG_AJAX_URL'			=> generate_board_url() . "/reimg/reimg_ajax.$phpEx",
		));
	}

#TODO: INVESTIGATE IF WE REMOVE THESE
/** DEPRECATED?
* Get the applicable image properties
*/
function reimg_properties()
{
	return 'class="reimg" ' . ((reimg_get_config('reimg_xhtml', false) == false) ? 'onload="reimg(this);" onerror="reimg(this);" ' : '');
}

/** DEPRECATED?
* Add the ReIMG properties to image tags in text
*/
function insert_reimg_properties($display_text)
{
	global $phpbb_root_path;

	preg_match_all("/(<img\/?[^>]*?\/>)/e", $display_text, $images);

	if (is_array($images))
	{
		$images_path = 'src="' . ((defined('PHPBB_USE_BOARD_URL_PATH') && PHPBB_USE_BOARD_URL_PATH) ? generate_board_url() . '/' : $phpbb_root_path) . 'images/';

		foreach ($images as $images_list)
		{
			$images_list = array_unique($images_list);
			foreach ($images_list as $image)
			{
				//If image is in the images directory or the replacements were already done we skip replacements
				if (strstr($image, 'src="' . $images_path) !== false || strstr($image, 'src="images/') !== false || strstr($image, reimg_properties()) !== false)
				{
					continue;
				}

				$image_reimg = str_replace('/>', reimg_properties() . '/>', $image);

				if (reimg_get_config('img_create_thumbnail', false) == false)
				{
					//Will be present for attachments
					$image_reimg = str_replace('onclick="viewableArea(this);"', 'style="border: none;"', $image_reimg);
				}

				$display_text = str_replace($image, $image_reimg, $display_text);
			}
		}
	}

	return $display_text;
}

/** DEPRECATED?
* Process template blocks
*/
function process_template_block_reimg($block_name, $block_section)
{
	global $template;
	$sub_block = '';
	if (is_array($block_name))
	{
		$sub_block = $block_name[1];
		$block_name = $block_name[0];
	}

	if (!empty($block_name) && !empty($block_section) && !empty($template->_tpldata[$block_name]))
	{
		foreach ($template->_tpldata[$block_name] as $row => $data)
		{
			// Alter the array
			if (!empty($sub_block) && isset($data[$sub_block]))
			{
				for ($i=0; $i < sizeof($data[$sub_block]); $i++)
				{
					$data[$sub_block][$i][$block_section] = insert_reimg_properties($data[$sub_block][$i][$block_section]);

					$template->alter_block_array($block_name, $data, $row, 'change');
				}
			}
			else if (isset($data[$block_section]))
			{
				$template->alter_block_array($block_name, array(
					$block_section 	=> insert_reimg_properties($data[$block_section]),
				), $row, 'change');
			}
		}
	}

	if (!empty($block_section))
	{
		if (isset($template->_tpldata['.'][0][$block_section]))
		{
			$template->assign_var($block_section, insert_reimg_properties($template->_tpldata['.'][0][$block_section]));
		}
	}
}

}
