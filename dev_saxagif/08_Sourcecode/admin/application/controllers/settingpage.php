<?php

/**
 * @author vtcanglt@gmail.com
 * @date 20152306
 * Management Login
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Settingpage extends MY_Controller {

    public function __construct() {
        parent::__construct();
//        $this->load->model('mlogin');
//        $this->lang->load('login');
    }

    public function index() {
        $data = array();
        $tpl = array(
          'breadcrumb' => array(base_url('home')=> 'home',
                                base_url('settingpage')=>'cài đặt chung' ),  
        );
        $tpl["main_content"] = $this->load->view('setting/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);

    }

}
