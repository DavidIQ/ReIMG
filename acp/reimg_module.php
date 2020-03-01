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

    /** @var \phpbb\language\language */
    protected $lang;

    /** @var string */
    public $u_action;

    /** @var string */
    public $tpl_name;

    /** @var string */
    public $page_title;

    function main($id, $mode)
    {
        global $user, $template, $config, $phpbb_container, $request;

        $this->config = $config;
        $this->phpbb_container = $phpbb_container;
        $this->log = $this->phpbb_container->get('log');
        $this->lang = $phpbb_container->get('language');
        $this->request = $request;
        $this->template = $template;
        $this->user = $user;

        $this->lang->add_lang('reimg_acp', 'davidiq/reimg');

        $this->tpl_name = 'reimg';
        $this->page_title = 'ACP_REIMG_SETTINGS';

        $form_name = 'acp_reimg';
        add_form_key($form_name);

        $reimg_swap_portrait = $this->request->variable('reimg_swap_portrait', (bool)$this->config['reimg_swap_portrait']);
        $reimg_resize_sig_img = $this->request->variable('reimg_resize_sig_img', (bool)$this->config['reimg_resize_sig_img']);
        $reimg_link = $this->request->variable('reimg_link', $this->config['reimg_link']);
        $reimg_zoom = $this->request->variable('reimg_zoom', $this->config['reimg_zoom']);
        $reimg_attachments = $this->request->variable('reimg_attachments', (bool)$this->config['reimg_attachments']);
        $reimg_for_all = $this->request->variable('reimg_for_all', (bool)$this->config['reimg_for_all']);

        if ($this->request->is_set_post('submit'))
        {
            if (!check_form_key($form_name))
            {
                trigger_error($this->lang->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
            }

            //Update configuration now
            $this->config->set('reimg_swap_portrait', $reimg_swap_portrait);
            $this->config->set('reimg_resize_sig_img', $reimg_resize_sig_img);
            $this->config->set('reimg_link', $reimg_link);
            $this->config->set('reimg_zoom', $reimg_zoom);
            $this->config->set('reimg_attachments', $reimg_attachments);
            $this->config->set('reimg_for_all', $reimg_for_all);

            $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_REIMG_UPDATED');
            trigger_error($this->lang->lang('REIMG_UPDATED') . adm_back_link($this->u_action));
        }

        $this->template->assign_vars([
            'S_REIMG_SWAP_PORTRAIT' => $reimg_swap_portrait,
            'S_REIMG_RESIZE_SIG_IMG' => $reimg_resize_sig_img,
            'S_REIMG_ATTACHMENTS' => $reimg_attachments,
            'S_REIMG_FOR_ALL' => $reimg_for_all,
            'U_ACTION' => $this->u_action,
        ]);

        $this->template->assign_block_vars_array('reimg_links', $this->select_reimg_link_method($reimg_link));
        $this->template->assign_block_vars_array('reimg_zoom_options', $this->select_reimg_zoom_method($reimg_zoom));
    }

    /**
     * Select re-sized image link method
     * @param $selected_value string  The selected value
     * @return array
     */
    private function select_reimg_link_method($selected_value)
    {
        $link_options = array();
        $link_method_ary = array();

        //Make sure we have the language key
        if (count($this->lang->lang_raw('reimg_linking_methods')))
        {
            $link_method_ary = $this->lang->lang_raw('reimg_linking_methods');
        }

        foreach ($link_method_ary as $link_method => $method)
        {
            $link_options[] = [
                'text'    => $method,
                'value'   => $link_method,
                'selected' => ($selected_value == $link_method)
            ];
        }

        return $link_options;
    }

    /**
     * Select re-sized image zoom method
     * @param $selected_value string  The selected value
     * @return array
     */
    private function select_reimg_zoom_method($selected_value)
    {
        $zoom_options = array();
        $zoom_method_ary = array();

        //Make sure we have the language key
        if (count($this->lang->lang_raw('reimg_zooming_methods')))
        {
            $zoom_method_ary = $this->lang->lang_raw('reimg_zooming_methods');
        }

        foreach ($zoom_method_ary as $zoom_method => $entry)
        {
            $zoom_options[] = [
                'name'      => $entry['name'],
                'desc'      => $entry['description'],
                'value'     => $zoom_method,
                'checked'   => ($selected_value == $zoom_method)
            ];
        }

        return $zoom_options;
    }

}
