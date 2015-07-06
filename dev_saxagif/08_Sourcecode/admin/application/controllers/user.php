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

    public function __construct() {
        parent::__construct();
        $this->load->model('muser');
        $this->check_login();
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
        if ($this->isPostMethod()){
            $input = $this->input->post();
            $error = array();
            
        }
        $list = $this->muser->listAccount(); // load all user
        $data['list'] = $list;
        $tpl["main_content"] = $this->load->view('user/list', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }

}
