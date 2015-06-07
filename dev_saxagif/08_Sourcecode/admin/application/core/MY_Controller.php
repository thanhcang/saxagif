<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    var $request_params;
    var $_ajax = false;
    public function __construct()
    {
        parent::__construct();
        //check ajax request?
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->_ajax = true;
        }

        $this->init();

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