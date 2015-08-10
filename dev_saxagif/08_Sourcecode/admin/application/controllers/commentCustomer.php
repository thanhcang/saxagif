<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  class customer comment
 */
class CommentCustomer extends MY_Controller {

    var $_user_login;
    public function __construct() {
        parent::__construct();
        $this->check_login();
        $this->_user_login = $this->session->userdata('user_id');
        $this->load->model('mcomment');
    }
    
    public function index() {
        $data = array(
            'page_title' => 'SAXA Gifts - Quản lý danh mục',
            'language_type' => $this->config->item('language_type'),
        );
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'Home',
                base_url('commentCustomer') => 'Khách hàng hỏi - saxa trả lời'),
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
            'base_url' => base_url('commentCustomer/?' . $queryString),
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
        $data['list_data'] = $this->mcomment->listAllComment($item, $total_records, $offset, $page_config['per_page']);
        if (!empty($data['list_data'])) { // pagination
            $this->load->library('pagination');
            $page_config["total_rows"] = $total_records;
            $this->pagination->initialize($page_config);
            $data["pagination"] = $this->pagination->create_links();
        }
        $data['offset'] = $offset;
        $data['sParam'] = $item;
        
        $tpl["main_content"] = $this->load->view('comment/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    /**
     * create new comment
     * @param type $param
     */
    public function add() {
        $data = array(
            'page_title' => 'SAXA Gifts - Quản lý danh mục',
            'language_type' => $this->config->item('language_type'),
        );
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'Home',
                base_url('commentCustomer') => 'Khách hàng hỏi - saxa trả lời',
                base_url('commentCustomer/new') => 'Tạo mới'),
        );
        
        if ($this->isPostMethod()) {
            $error = array();
            $params = $this->input->post();
            // Check validation input
            
            $this->_validateForm($params, $error);
            if (empty($error)) {
                if (!empty($_FILES['logo']['name'])) {
                    $checkUpload = $this->uploadPhoto($_FILES['logo'], 'logo', IMAGE_COMMENT_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000);
                    if ($checkUpload) {
                        $params['logo'] = $checkUpload; // Get logo name:
                        $is_resize = $this->resizePhoto($checkUpload, 112, 112 , IMAGE_COMMENT_PATH);
                        if ($is_resize != TRUE) { // not resize
                            $error[] = 'Không xử lý được file ảnh <br/> vui lòng kiểm tra lại';
                        }
                    } else {
                        $error[] = 'File ảnh chưa được up <br/> vui lòng kiểm tra lại';
                    }
                }
            }

            // update child category
            if (empty($error)) {
                $this->db->trans_off();
                $this->db->trans_begin();
                $this->mcomment->addComment($params);
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $error[] = 'Hệ thống chưa cập nhật <br/> Vui lòng thử lại';
                } else {
                    $this->db->trans_commit();
                    redirect(base_url('commentCustomer'));
                }
            }
            $data['error'] = $error;
            $data['params'] = $params;
        }

        $tpl["main_content"] = $this->load->view('comment/new', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    /**
     * validate update category
     * @param type $data
     * @param type $errors
     */
    private function _validateForm(&$data, &$errors) {
        //Trim
        foreach ($data as $k => $item) {
            if (is_string($item)) {
                $data[$k] = trim($item);
            }
        }
        //Load
        $this->load->library('form_validation');
        // Set rules:
        $this->form_validation->set_rules("customer_name",'Nhập tên khách hàng', "required|trim|xss_clean|max_length[255]");
        $this->form_validation->set_rules("question",'Nhập câu hỏi', "required|trim|max_length[255]|");
        
        // Set Message:
        $this->form_validation->set_message('required', '%s');
        
        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
        }
    }
}

