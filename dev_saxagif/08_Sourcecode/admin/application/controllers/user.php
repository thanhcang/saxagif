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
        $this->load->library('pagination');
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
        $filter = $this->input->get();
        if (!empty($filter['page']) && is_numeric(intval($filter['page']))) {
            $page = $filter['page'];
        } else {
            $page = 1;
        }
        // Config pagination:
        $parmameter_page = 'page';
        $queryString = $this->input->server('QUERY_STRING');
        //remove parameter page
        $queryString = preg_replace('/(\&|)page=[0-9]$/is', '', $queryString);
        $queryString = preg_replace('/(\&|)page=$/is', '', $queryString);
        $page_config = array(
            'base_url' => base_url('user/?' . $queryString),
            'per_page' => NUMBER_PAGE,
            'use_page_numbers' => TRUE,
            'page_query_string' => TRUE,
            'query_string_segment' => $parmameter_page,
            'next_link'      => BUTTON_NEXT,
            'prev_link'      => BUTTON_PRE,
            'first_link'     => BUTTON_FIRST,
            'last_link'      => BUTTON_LAST,
            'cur_tag_open'   => '<li class="active"><a href="#">',
            'cur_tag_close'  => '</li></a>',
            'prev_tag_open'  => '<li>',
            'prev_tag_close' => '</li>',
            'next_tag_open'  => '<li>',
            'next_tag_close' => '</li>',
            'num_tag_open'   => '<li>',
            'num_tag_close'  => '</li>',
            'full_tag_open'  => '<ul class="pagination pagination-centered">',
            'full_tag_close' => '</ul>',
        );
        $offset = max(($page - 1), 0) * $page_config['per_page'];
        $total_records = 0;
        $list = $this->muser->listAccount($filter,$total_records, $offset, $page_config['per_page']); // load all user
        if (!empty($list) && $total_records > NUMBER_PAGE) { // Pagination
            $page_config["total_rows"] = $total_records;
            $this->pagination->initialize($page_config);
            $data["pagination"] = $this->pagination->create_links();
        }
        $data['offset'] = $offset;
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
        if (empty($param['user_id'])){
            $this->form_validation->set_rules("password", "Nhập password", "trim|xss_clean|max_length[255]|required");
        } 
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
            if (empty($param['user_id'])) {
                $this->_checkFieldExist('username', $param['username'], 'Username đã tồn tại', $error, FALSE );
                $this->_checkFieldExist('email', $param['email'], 'email đã tồn tại', $error ,FALSE);
            } else {
                $this->_checkFieldExist('username', $param['username'], 'Username đã tồn tại', $error ,$param['user_id']);
                $this->_checkFieldExist('email', $param['email'], 'email đã tồn tại', $error , $param['user_id']);
            }
        }
        if (empty($error) && !empty($_FILES['logo']['name'])){
            $this->_creatLogoUser($error,$upload_logo,$param['image']);
        }
    }
    
    /**
     * check field is exists
     * @param string $field_name
     * @param string $value
     * @param string $message
     * @param array $error
     */
    private function _checkFieldExist($field_name,$value,$message,&$error,$user_id = '') {
        $is_exists = $this->muser->checkFieldExist($field_name,$value,$user_id);
        if ($is_exists == TRUE ){
            $error[] = $message;
        }
    }
    
    /**
     * upload logo
     * @param array $error
     * @param array $upload_logo
     * @param string $oldImage
     * @return boolean
     * @throws Exception
     */
    private function _creatLogoUser(&$error,&$upload_logo,$oldImage=''){
        $dirImage = COMMON_PATH.'img/logo_member';
        if (!is_dir($dirImage)){
            @mkdir($dirImage, 0777);
            @chmod($dirImage, 0777);
        }
        $this->load->library('upload');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = CONST_MAXBYTE_IMAGE;
        $config['upload_path'] = $dirImage.'/';
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
                $image['width'] =  $upload_logo['image_height'] * ( CONST_MAXHEIGHT_LOGO_USER/$upload_logo['image_height']);
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
    
    /**
     * update infomation for user
     * @param type $user_id
     */
    public function edit($user_id) {
        if (empty($user_id) || !is_numeric($user_id)){
            redirect(base_url('user'));
        }
        $param = $this->muser->getUserById($user_id);
        if ($param == FALSE){
            redirect(base_url('user'));
        }
        $data = array(
            'page_title' => 'SAXA Gifts - cập nhật thông tin',
        );
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'home',
                base_url('user') => 'Danh sách nhân viên',
                "javascript:;" => 'Cập nhật',
                "#" => $param['first_name'].' '.$param['last_name'],
                )
        );
        if ($this->isPostMethod()){ // upate information
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
                    'level'         => !empty($input['level']) ? $input['level'] :1 ,
                    'update_user'   =>  $this->_user_login,
                    'update_date'   =>  date('Y-m-d H:i:s'),
                );
                if (!empty($input['password']) && $input['password'] != 'system123456Abc'){
                    $data['password'] = pass_hash($input['password']);
                }
                if (!empty($upload_logo['file_name'])) {
                    $data['image'] = $upload_logo['file_name']; // update image
                    if (!empty($param['image']) && is_file(COMMON_PATH . 'img/logo_member' . '/' . $param['image'])) { // delete old image
                        unlink(COMMON_PATH . 'img/logo_member' . '/' . $param['image']);
                    }
                }
                $where = array(
                    'id' => $input['user_id']
                );
                $this->db->trans_off();
                $this->db->trans_begin();
                $this->muser->update($where,$data);
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $data['error'][] = 'Hệ thống chưa cập nhật được thành viên này.<br/> Vui lòng thử lại'; 
                } else {
                    $this->db->trans_commit();
                    redirect(base_url('user'));
                }
            } else { // have error
                $data['error'] = $error;
            }
            $data['param'] = $input;
        }
        $data['param'] = $param;
        $data['user_id'] = $user_id;
        $tpl["main_content"] = $this->load->view('user/edit', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
}
