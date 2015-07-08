<?php

/**
 * @author vtcanglt@gmail.com
 * @date 20150706
 * Management User
 * create user
 * edit user
 * delete user
 * permission user
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MY_Controller {
    
    var $_user_login;
    public function __construct() {
        parent::__construct();
        $this->load->model('muser');
        $this->check_login();
        $this->_user_login = $this->session->userdata('user_id');
    }

    /**
     * load list user
     * load form add user
     */
    public function index() {
        $data = array(
            'page_title' => 'SAXA Gifts - Quản lý tài khoản',
        );
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'home',
                base_url('user') => 'Quản lý danh sách danh sách'),
        );
        if ($this->isPostMethod()) {
            $input = $this->input->post();
            $error = array();
            $upload_logo = '';
            $this->_validateForm($input,$error,$upload_logo);
            if (empty($error)){ // register user
                $data = array(
                    'username'      => html_escape($input['username']),
                    'email'         => html_escape($input['email']),
                    'first_name'    => html_escape($input['first_name']),
                    'last_name'     => html_escape($input['last_name']),
                    'password'      => pass_hash($input['password']),
                    'last_name'     => html_escape($input['last_name']),
                    'image'         => !empty($upload_logo['file_name']) ? $upload_logo['file_name'] :'' ,
                    'level'         => !empty($input['level']) ? $input['level'] :1 ,
                    'active'        =>  1,
                    'create_user'   =>  $this->_user_login,
                    'create_date'   =>  date('Y-m-d H:i:s'),
                    'update_date'   =>  date('Y-m-d H:i:s'),
                );
                $this->db->trans_off();
                $this->db->trans_begin();
                $this->muser->add($data);
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $data['error'][] = 'Hệ thống chưa đăng ký được thành viên này.<br/> Vui lòng thử lại'; 
                } else {
                    $this->db->trans_commit();
                    $input = array();
                }
            } else { // have error
                $data['error'] = $error;
            }
            $data['param'] = $input;
        }
        $list = $this->muser->listAccount(); // load all user
        $data['list'] = $list;
        $tpl["main_content"] = $this->load->view('user/list', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    /**
     * validate form
     * @param array $param
     * @param array $error
     */
    private function _validateForm(&$param,&$error,&$upload_logo) {
        trimStringArray($param);
        //Load
        $this->load->library('form_validation');
        // Set rules:
        $this->form_validation->set_rules("username", "Nhập username", "trim|xss_clean|max_length[255]|required");
        $this->form_validation->set_rules("password", "Nhập password", "trim|xss_clean|max_length[255]|required");
        $this->form_validation->set_rules("first_name", "Nhập họ", "trim|xss_clean|max_length[255]|required");
        $this->form_validation->set_rules("last_name", "Nhập tên", "trim|xss_clean|max_length[255]|required");
        $this->form_validation->set_rules("email", "Nhập email", "trim|xss_clean|max_length[255]|required");
        $this->form_validation->set_rules("email", "Email không đúng định dang", "trim|xss_clean|max_length[255]|valid_email");
        // Set Message:
        $this->form_validation->set_message('required', '%s');
        $this->form_validation->set_message('valid_email', '%s');
        //Validate
        if ($this->form_validation->run() == FALSE) {
            $error = $this->form_validation->error_array();
        }
        if (empty($error)){ // check username and email are exists
            $this->_checkFieldExist('username',$param['username'],'Username đã tồn tại',$error);
            $this->_checkFieldExist('email',$param['email'],'email đã tồn tại',$error);
        }
        if (empty($error) && !empty($_FILES['logo']['name'])){
            $this->_creatLogoUser($error,$upload_logo);
        }
    }
    
    /**
     * check field is exists
     * @param string $field_name
     * @param string $value
     * @param string $message
     * @param array $error
     */
    private function _checkFieldExist($field_name,$value,$message,&$error) {
        $is_exists = $this->muser->checkFieldExist($field_name,$value);
        if ($is_exists == TRUE ){
            $error[] = $message;
        }
    }
    
    /**
     * upload logo
     * @param array $error
     * @return boolean
     * @throws Exception
     */
    private function _creatLogoUser(&$error,&$upload_logo){
        $this->load->library('upload');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = CONST_MAXBYTE_IMAGE;
        $config['upload_path'] = COMMON_PATH.'img/logo_member/';
        $config['max_width'] = CONST_MAXWIDTH_LOGO;
        $config['max_height'] = CONST_MAXHEIGHT_LOGO;
        $this->upload->initialize($config);
        try{
            $upload = $this->upload->do_upload('logo');
            if (!$upload) {
                throw new Exception($this->upload->display_errors());
            }
            $upload_logo = $this->upload->data();
            if ($upload_logo['image_height'] > 100) {
                $image['image_library'] = 'gd2';
                $image['height'] = CONST_MAXHEIGHT_LOGO_USER;
                $image['source_image'] = $upload_logo['full_path'];
                $this->load->library('image_lib', $image);
                $is_resize = $this->image_lib->resize();
                if (!$is_resize) {
                    throw new Exception($this->image_lib->display_errors());
                }
            }
        } catch (Exception $ex) {
            $error[] = $ex->getMessage();
        }
    }
}
