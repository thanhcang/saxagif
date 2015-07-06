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
        $this->load->helper(array('cookie'));
    }

    public function index() {
        if ($this->is_logged_in()) { // is login
            redirect(base_url());
        }
        $data = array(
            'page_title' => 'SAXA Gifts - Đăng nhập hệ thống',
        );
        $data['remember'] = $this->checkCookieLogin();
        $session_check_form_number = $this->session->userdata('form_user');
        if ($this->isPostMethod() && !empty($session_check_form_number) && $session_check_form_number == $_POST['form_user']) { // check valid
            $input = $this->input->post();
            $remember = (isset($input['remember'])) ? $input['remember'] : 0;
            $error = array();
            $this->_validateForm($input, $error);
            if (empty($error)) {
                foreach ($input as $key => $value) { // trim input
                    if (is_string($value)) {
                        $input[$key] = trim($value);
                    }
                }
                $is_login_username = $this->mlogin->checkLogin($input); // check login
                if ($is_login_username) {
                    if ($is_login_username['password'] == pass_hash($input['password'])) { // check is login as password
                        // Empty is no limit, login OK
                        $this->set_login($is_login_username);
                        if ($remember) { // save login
                            $this->saveCookieLogin($is_login_username);
                        } else {
                            $getCookie = $this->input->cookie(LOGIN_COOKIE_REMEMBER_NAME, TRUE);
                            if ($getCookie) {
                                $this->input->set_cookie(LOGIN_COOKIE_REMEMBER_NAME, '', '', '', '/admin/login/', '', '');
                                delete_cookie(LOGIN_COOKIE_REMEMBER_NAME);
                            }
                        }
                        redirect(base_url());
                    } else {
                        $data['error'][] = 'username or password wrong, please try again.';
                    }
                } else { // password not true
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

    /**
     * logout
     */
    public function logOut() {
        $getCookie = $this->input->cookie(LOGIN_COOKIE_REMEMBER_NAME, TRUE);
        if ($getCookie) {
            delete_cookie(LOGIN_COOKIE_REMEMBER_NAME);
            $this->input->set_cookie(LOGIN_COOKIE_REMEMBER_NAME, '', '', '', '/admin/', '', '');
            $getCookie = base64_decode($getCookie);
            if ($getCookie) {
                $getCookie = json_decode($getCookie);
                if (is_object($getCookie)) {
                    $getCookie = get_object_vars($getCookie);
                }
                if (is_array($getCookie)) {
                    if ($getCookie['IP_ADDRESS'] == $this->input->ip_address()) {
                        $cookie_time = $getCookie['cookie_time'];
                        $time = $cookie_time * LOGIN_COOKIE_REMEMBER_HOUR;
                        $cookie = array(
                            'name' => LOGIN_COOKIE_REMEMBER_NAME,
                            'value' => base64_encode(json_encode(
                                            array(
                                                'STATUS' => 0,
                                                'user_id' => 'user_id',
                                                'username' => $getCookie['username'],
                                                'IP_ADDRESS' => $getCookie['IP_ADDRESS'],
                                                'cookie_time' => $cookie_time,
                                            )
                            )),
                            'expire' => $time,
                            'path' => '',
                        );
                        $this->input->set_cookie($cookie);
                    }
                }
            }
        }
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }

    /**
     * Save cookie login
     * @param type $rslogin
     */
    public function saveCookieLogin($rslogin) {
        $cookie_time = LOGIN_COOKIE_REMEMBER_TIME_DEFAULT;
        $time = $cookie_time * LOGIN_COOKIE_REMEMBER_HOUR;
        $cookie = array(
            'name' => LOGIN_COOKIE_REMEMBER_NAME,
            'value' => base64_encode(json_encode(array(
                'STATUS' => 1,
                'user_id' => $rslogin['id'],
                'username' => $rslogin['username'],                
                'IP_ADDRESS' => $this->input->ip_address(),
                'cookie_time' => $cookie_time,
            ))),
            'expire' => $time,
            'path' => '',
        );
        $this->input->set_cookie($cookie);
    }

    /**
     * Check cookie login
     * @return type
     */
    public function checkCookieLogin() {
        //get cookie
        $remember = array();
        $getCookie = $this->input->cookie(LOGIN_COOKIE_REMEMBER_NAME, TRUE);
        if ($getCookie) {
            $getCookie = base64_decode($getCookie);
            if ($getCookie) {
                $getCookie = json_decode($getCookie);
                if ($getCookie) {
                    if (is_object($getCookie)) {
                        $getCookie = get_object_vars($getCookie);
                    }
                    if (is_array($getCookie)) {
                        if ($getCookie['IP_ADDRESS'] == $this->input->ip_address()) {
                            if ($getCookie['STATUS'] == 1 && !empty($getCookie['user_id'])) {
                                //still exist login cookie
                                $rslogin = $this->mlogin->getLoginFromCookie($getCookie['user_id']);
                                if ($rslogin) {
                                    $this->set_login($rslogin);
                                    redirect(base_url());
                                }
                            } else {
                                //logout
                                $remember = array(
                                    'username' => $getCookie['username'],
                                    'cookie_time' => $getCookie['cookie_time'],
                                );
                            }
                        }
                    }
                }
            }
        }
        return $remember;
    }
    
    /**
     * forget password
     */
    public function forgetpassword() {
        $data = array(
            'page_title' => 'SAXA Gifts - Quên mật khẩu',
        );
        $param = array();
        $sess_form_email_forget = $this->session->userdata('sess_form_email_forget');
        if ($this->isPostMethod() && !empty($sess_form_email_forget) && $sess_form_email_forget == $_POST['form_email_forget']) { // check valid
            $error = array();
            $input = $this->input->post();
            $this->_validateForgetPasswordForm($input, $error);
            if (empty($error)) {
                $is_email = $this->mlogin->checkEmail($input);
                if ($is_email == FALSE) {
                $error[] = 'Email không tồn tại.';
                }
            }
            if (empty($error)) {
                $str_token = uniqid(rand(), true);
                $salt = urlencode(base64_encode(md5($str_token . 'aDminVtcangSaxagit')));
                $input['forgot_password'] = $salt;
                $this->db->trans_off($input);
                $this->db->trans_begin();
                $this->mlogin->resetPassword($input);
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $error[] = ' Đã có lỗi xảy ra trong quá trình cập nhật<br/> Hãy thử lại';
                } else {
                    $this->db->trans_commit();
                    try {
                        if ($this->_sendMailGetPassword($is_email) == FALSE) {
                            throw new Exception;
                        }
                        redirect(base_url('login/resetPassuccess'));
                    } catch (Exception $ex) {
                        $error[] = 'Hệ thống chưa gơi mail được, vui lòng thử lại';
                    }
                }
            }
            $param = $input;
        } else {
            if (!empty($sess_form_email_forget)) { // destroy session
                $this->session->unset_userdata('sess_form_email_forget');
            }
            $form_email_forget = md5(microtime() . 'aDminVtcangSaxagit'); // genaral random form submit
            $this->session->set_userdata('sess_form_email_forget', $form_email_forget); // assign session
            $param['form_email_forget'] = $form_email_forget; // assign new form number
        }
        if(!empty($error)){
            $data['error'] = $error;
        }
        $data['param'] = $param;
        $this->load->view('login/forgetpassword', $data);
    }
    
    /**
     * check valid email form
     * @param array $data
     * @param array $error
     */
    private function _validateForgetPasswordForm($data, $error) {
        trimStringArray($data);
        $this->load->library('form_validation');
        // Set rules:
        $this->form_validation->set_rules("email", "Nhap Email", "trim|xss_clean|max_length[255]|required");
        $this->form_validation->set_rules("reEmail", "Nhap Email", "trim|xss_clean|max_length[255]|required");
        // Set Message:
        $this->form_validation->set_message('required', '%s');
        //Validate
        if ($this->form_validation->run() == FALSE) {
            $error = $this->form_validation->error_array();
        }
        // check email same reEmail
        if ($data['email'] !== $data['reEmail']) {
            $error[] = 'Email không giống nhau';
        }
    }
    
    /**
     * send mail reset password
     * @param Array $param
     * @return \Exception
     */
    private function _sendMailGetPassword($param) {
        $template = $this->getTeamplateMail('email_reset_password');
        if (!empty($template)){
            try{
                $subject = $template['subject'];
                $body = $template['body'];
                $data_replace = array(
                    '\[DATE\]' => date('Y-m-d H:i:s'),
                    '\[NAME\]' => $param['first_name'].' '.$param['last_name'],
                    '\[LINK\]' => base_url('login/formResetPassword/'.$param['forgot_password']),
                );
                foreach ($data_replace as $key => $value) {
                    $body = mb_ereg_replace($key, $value, $body);
                }
                if ( $this->send_mail($param['email'], $subject, $body) !== TRUE ){
                    throw new Exception;
                }
                return TRUE;
            } catch (Exception $ex) {
                return FALSE;
            }
        }
    }
    
    /**
     * message reset success
     */
    public function resetPassuccess() {
        $sess_reset_password = $this->session->userdata('sess_form_email_forget');
        if (!empty($sess_reset_password)) {
            $this->session->unset_userdata('sess_form_email_forget');
            $data = array(
                'page_title' => 'SAXA Gifts - Quên mật khẩu',
            );
            $message = 'Check Email của bạn để reset lại password <br/>';
            $message .= '<a href="' . base_url() . '">trở về trang chủ</a>';
            $data['message'] = $message;
            $this->load->view('login/messageForm', $data);
        } else {
            redirect('category');
        }
    }
    
    /**
     * form reset password
     * @param string $token
     */
    public function formResetPassword($token) {
        $data = array(
            'page_title' => 'SAXA Gifts - cập nhật Password',
        );
        $is_token = $this->mlogin->checkToken($token);
        if (empty($is_token)){ // is hack server
            redirect(base_url());
        } elseif (!empty ($is_token) && $this->isPostMethod()) { // change password
            $input = $this->input->post();
            $error = array();
            $this->_validateUpdatePassword($input, $error);
            if (empty($error)) { // is update password
                $input['forgot_password'] = $token; 
                $this->db->trans_off();
                $this->db->trans_begin();
                $this->mlogin->updatePassword($input);
                $this->mlogin->removeTokenPasswordReset($input);
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $error[] = 'Hệ thống chưa cập nhật được password của bạn<br/> Hãy thử lại';
                } else {
                    $this->db->trans_commit();
                    redirect(base_url('login'));
                }
            }
        } else { // form change password
            // nothing
        }
        if (!empty($error)){
            $data['error'] = $error;
        }
        $data['list'] = $is_token;
        $data['token'] = $token;
        $this->load->view('login/updatepassword', $data);
    }
    
    /**
     * valide form update password
     * @param array $param
     * @param array $error
     */
    private function _validateUpdatePassword($param, &$error) {
        if (empty($param['password']) || empty($param['rePassword'])) {
            $error[] = 'Nhập Password';
        } elseif (strlen($param['password']) < 6) {
            $error[] = 'Password lớn 6 ký tự';
        } elseif (ctype_alpha($param['password']) == TRUE) {
            $error[] = 'Password phải co ít nhất một số';
        } elseif ($param['password'] != $param['rePassword']) {
            $error[] = 'Password không giống nhau';
        }
    }

}
