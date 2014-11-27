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

	/** @var string phpEx */
	protected $php_ext;

	/**
	* Constructor
	*
	* @param \phpbb\config\config        	$config             Config object
	* @param \phpbb\template\template    	$template           Template object
	* @param \phpbb\user                 	$user               User object
	* @param string							$php_ext			phpEx
	* @return \davidiq\reimg\event\listener
	* @access public
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\template\template $template, \phpbb\user $user, $php_ext)
	{
		$this->config = $config;
		$this->template = $template;
		$this->user = $user;
		$this->php_ext = $php_ext;
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
			'S_REIMG_SWAP_PORTRAIT'		=> $this->config['reimg_swap_portrait'],
			'S_REIMG_BUTTON'			=> strpos($this->config['reimg_link'], 'button') !== false,
			'S_REIMG_LINK'				=> strpos($this->config['reimg_link'], 'link') !== false,
			'S_REIMG_ZOOM'				=> (strpos($this->config['reimg_zoom'], '_litebox') !== false) ? '_litebox' : $this->config['reimg_zoom'],
			'S_REIMG_ATTACHMENTS'		=> $this->config['reimg_attachments'],
			'S_REIMG_ZOOM_METHOD'		=> $this->config['reimg_zoom'],
			'S_REIMG_RESIZE_SIG_IMG'	=> $this->config['reimg_resize_sig_img'],
			'S_REIMG_FOR_ALL'			=> $this->config['reimg_for_all'],
			'S_REIMG_PHP_EXT'			=> strtolower($this->php_ext),
		));
	}

}
