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
    
    public function isPostMethod() {
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ){
            return TRUE;
        }
        return FALSE;
    }
    
    /**
     * Check user has logged-in or not
     * @return boolean
     */
    function is_logged_in() {
        $session_data = $this->session->all_userdata();
        if (empty($session_data['username'])) {
            // Not logged-in
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * set session user
     * @param type $data
     */
    function set_login($data) {
        $session_data = array(
            'user_id'      => $data['id'],
            'username'      => $data['username'],
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'level'         => $data['level'],
            'available_time'=> $data['available_time'],
        );
        $this->session->set_userdata($session_data);
    }
 
    /**
     * Auto redirect to login page if not logged-in
     */
    function check_login() {
        if (!$this->is_logged_in()) {
            redirect(base_url('login'));
        }
    }
}