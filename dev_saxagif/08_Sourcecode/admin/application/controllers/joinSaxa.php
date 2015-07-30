<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/06/07
 * Management category
 */
class joinSaxa extends MY_Controller {

    var $_user_login;
    public function __construct() {
        parent::__construct();
        $this->check_login();
        $this->_user_login = $this->session->userdata('user_id');
        $this->load->model('mjoinSaxa');
    }
    
    
    public function index() {
        $data = array(
            'page_title' => 'SAXA Gifts - Quản lý danh mục',
            'typeCategory' => $this->config->item('typeCategory'),
            'language_type' => $this->config->item('language_type'),
        );
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'Home',
                base_url('category') => 'Danh mục'),
        );
        
        $item = $this->input->get();
        if (!empty($item['page']) && filter_var($item['page'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $page = $item['page'];
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
            'base_url' => base_url('category/?' . $queryString),
            'per_page' => NUMBER_PAGE,
            'use_page_numbers' => TRUE,
            'page_query_string' => TRUE,
            'query_string_segment' => $parmameter_page,
            'next_link' => BUTTON_NEXT,
            'prev_link' => BUTTON_PRE,
            'first_link' => BUTTON_FIRST,
            'last_link' => BUTTON_LAST,
            'cur_tag_open' => '<li class="active"><a href="#">',
            'cur_tag_close' => '</li></a>',
            'prev_tag_open' => '<li>',
            'prev_tag_close' => '</li>',
            'next_tag_open' => '<li>',
            'next_tag_close' => '</li>',
            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',
            'full_tag_open' => '<ul class="pagination pagination-centered">',
            'full_tag_close' => '</ul>',
        );
        $offset = max(($page - 1), 0) * $page_config['per_page'];
        $total_records = 0;
        $data['list_data'] = $this->mjoinSaxa->search($total_records, $offset, $page_config['per_page']);
        
        if (!empty($data['list_data'])) { // pagination
            $this->load->library('pagination');
            $page_config["total_rows"] = $total_records;
            $this->pagination->initialize($page_config);
            $data["pagination"] = $this->pagination->create_links();
        }
        $data['offset'] = $offset;
        $data['sParam'] = $item;
        
        $tpl["main_content"] = $this->load->view('joinsaxa/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    public function add() {
        $data = array(
            'page_title' => 'SAXA Gifts - Quản lý danh mục',
            'typeCategory' => $this->config->item('typeCategory'),
            'language_type' => $this->config->item('language_type'),
        );
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'Home',
                base_url('category') => 'Danh mục'),
        );
        
        if ($this->isPostMethod()){
            $input = $this->input->post();
            $checkUpload = $this->uploadPhoto($_FILES['logo'], 'logo', URL_IMAGE_JOINSAXA_CATEGORY, TRUE, 1366, 768, $maxSize = 200000);
            if ($checkUpload) {
                $input['logo'] = $checkUpload; // Get logo name:
                $is_resize = $this->resizePhoto($checkUpload, 832, 319, URL_IMAGE_JOINSAXA_CATEGORY);
                if ($is_resize != TRUE) { // not resize
                    $error[] = 'Không xử lý được file ảnh <br/> vui lòng kiểm tra lại';
                }
            } else {
                $error[] = 'File ảnh chưa được up <br/> vui lòng kiểm tra lại';
            }

            if (empty($error)){
                $is_insert = $this->mjoinSaxa->add($input);
               
                if ($is_insert == TRUE) {
                    redirect(base_url('joinSaxa'));
                    return;
                } else {
                    
                }
            }
            
        }
        
        $tpl["main_content"] = $this->load->view('joinsaxa/add', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
        
    }
    
    public function edit($param) {
       
    }
    
    public function delete($param) {
        
    }

}

