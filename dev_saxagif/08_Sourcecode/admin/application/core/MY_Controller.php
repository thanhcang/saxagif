<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    private $_request_params;
    private $_ajax = false;
    protected $_language = array();
    public function __construct()
    {
        parent::__construct();
        //check ajax request?
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->_ajax = true;
        }

        $this->init();
        $this->_language = $this->config->item('language_type');
        $this->lang->load('common');
        $this->session->set_userdata('ses_user_id', 1);
        //$this->config->load('setting');
    }

    private function init()
    {
        $this->set_request();
    }

    public function get_request()
    {
        return $this->request_params;
    }

    private function set_request()
    {
        $get_params = array();

        $get_params = $this->input->post();
        if ( ! $get_params) {
            $get_params = $this->input->get();
        }

        $this->request_params = $get_params;
    }
}