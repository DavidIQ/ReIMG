<?php
/**
*
* @package ReIMG Image Resizer
* @copyright (c) 2011 DavidIQ.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* Retrieve configuration value
*
* @param string $config_name The configuration value to retrieve
* @param string $default Default value to return if config value does not exist
*/
function reimg_get_config($config_name, $default = '')
{
	global $config;

	if (isset($config[$config_name]) && !empty($config[$config_name]))
	{
		return $config[$config_name];
	}
	else
	{
		return $default;
	}
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

/**
* Get the applicable image properties
*/
function reimg_properties()
{
	return 'class="reimg" ' . ((reimg_get_config('reimg_xhtml', false) == false) ? 'onload="reimg(this);" onerror="reimg(this);" ' : '');
}

/**
* Add the ReIMG properties to image tags in text
*/
function insert_reimg_properties($display_text)
{
	global $phpbb_root_path;

	preg_match_all("/(<img\/?[^>]*?\/>)/e", $display_text, $images);

	$images = array_unique($images);
	$smileys_path = 'src="' . ((defined('PHPBB_USE_BOARD_URL_PATH') && PHPBB_USE_BOARD_URL_PATH) ? generate_board_url() . '/' : $phpbb_root_path) . reimg_get_config('smilies_path');

	foreach ($images as $images_list)
	{
		$images_list = array_unique($images_list);
		foreach ($images_list as $image)
		{
			//If this is a smiley we skip replacements
			if (strstr($image, $smileys_path) !== false)
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

	return $display_text;
}

/**
* Process template blocks
*/
function process_template_block_reimg($block_name, $block_section)
{
	global $template;

	if (!empty($block_name) && !empty($block_section))
	{
		if (!empty($template->_tpldata[$block_name]))
		{
			foreach ($template->_tpldata[$block_name] as $row => $data)
			{
				// Alter the array
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

