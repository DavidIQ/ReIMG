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

	$link_method_ary = array('button' => 'REIMG_LINK_BUTTON', 'link' => 'REIMG_LINK_IMAGE', 'button_link' => 'REIMG_LINK_BOTH');
	$link_options = '';
	foreach ($link_method_ary as $link_mehod => $lang)
	{
		$selected = ($selected_value == $link_mehod) ? ' selected="selected"' : '';
		$link_options .= '<option value="' . $link_mehod . '"' . $selected . '>' . $user->lang[$lang] . '</option>';
	}

	return $link_options;
}

/**
* Select resized image zoom method
*/
function select_reimg_zoom_method($selected_value)
{
	global $user, $phpbb_root_path;

	$zoom_method_ary = array('_default' => 'REIMG_ZOOM_DEFAULT', '_exturl' => 'REIMG_ZOOM_EXTURL', '_blank' => 'REIMG_ZOOM_BLANK', '_litebox' => 'REIMG_ZOOM_LITEBOX', '_litebox1' => 'REIMG_ZOOM_LITEBOX_1_1', '_litebox0' => 'REIMG_ZOOM_LITEBOX_RESIZED', '_highslide' => 'REIMG_ZOOM_HIGHSLIDE');
	$zoom_options = '';
	foreach ($zoom_method_ary as $zoom_method => $lang)
	{
		$disabled = '';
		//We need to check and see if the Highslide library actually exists before allowing the option to be selectable
		if ($zoom_method == '_highslide')
		{
			//We need one of the highslide js libraries
			if (!file_exists($phpbb_root_path . 'reimg/highslide/highslide-full.packed.js'))
			{
				$disabled = ' disabled';
			}
		}
		$selected = ($selected_value == $zoom_method) ? ' selected="selected"' : '';
		$zoom_options .= '<option value="' . $zoom_method . '"' . $selected . $disabled . '>' . $user->lang[$lang] . '</option>';
	}

	return $zoom_options;
}

/**
* Get the applicable image properties
*/
function reimg_properties()
{
	return 'class="reimg" onload="reimg(this);" onerror="reimg(this);" ';
}

/**
* Add the ReIMG properties to image tags in text
*/
function insert_reimg_properties($display_text)
{
	preg_match("/(<img\/?[^>]*?\/>)/e", $display_text, $images);

	$images = array_unique($images);

	foreach ($images as $image)
	{
		$image_reimg = str_replace('/>', reimg_properties() . '/>', $image);

		$display_text = str_replace($image, $image_reimg, $display_text);
	}

	return $display_text;
}