<?php

/**
 * @author vtcanglt@gmail.com
 * @date 20152306
 * Management Login
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mlogin');
    }

    public function index() {
        $data = array(
            'page_title' => 'SAXA Gifts - Đăng nhập hệ thống',
        );
        $session_check_form_number = $this->session->userdata('form_user');
        if ($this->isPostMethod() && !empty($session_check_form_number) && $session_check_form_number == $_POST['form_user']) { // check valid
            $input = $this->input->post();
            $error = array();
            $this->_validateForm($input, $error);
            if (empty($error)) {
                foreach ($input as $key => $value) { // trim input
                    if (is_string($value)) {
                        $input[$key] = trim($value);
                    }
                }
                $is_login = $this->mlogin->checkLogin($input); // check login
                if ($is_login) {
                    
                }else{
                    $data['error'][] = 'username or password wrong, please try again.';
                }
            } else { // error form
                $data['error'] = $error;
            }
            $data['param'] = $input;
        } else {
            $sess_form_number = $this->session->userdata('form_user');
            if (!empty($sess_form_number)) { // destroy session
                $this->session->sess_destroy();
            }
            $form_number = md5(microtime() . 'aDminVtcangSaxagit'); // genaral random form submit
            $this->session->set_userdata('form_user', $form_number); // assign session
            $data['param']['form_user'] = $form_number;
        }
        $this->load->view('login/index', $data);
    }

    /**
     * check validate form 
     * @param array $data
     * @param array $error
     */
    public function _validateForm($data, &$error) {
        foreach ($data as $k => $item) {
            if (is_string($item)) {
                $data[$k] = trim($item);
            }
        }
        //Load
        $this->load->library('form_validation');
        // Set rules:
        $this->form_validation->set_rules("username", "Please enter Username", "trim|xss_clean|max_length[255]|required");
        $this->form_validation->set_rules("password", "Please enter password", "trim|xss_clean|max_length[255]|required");
        // Set Message:
        $this->form_validation->set_message('required', '%s');
        //Validate
        if ($this->form_validation->run() == FALSE) {
            $error = $this->form_validation->error_array();
        }
    }

    public function logOut() {
        
    }

}
