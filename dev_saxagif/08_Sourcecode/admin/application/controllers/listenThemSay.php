<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  listen them say
 */
class ListenThemSay extends MY_Controller {

    var $_user_login;

    public function __construct() {
        parent::__construct();
        $this->check_login();
        $this->_user_login = $this->session->userdata('user_id');
        $this->load->model('mYourSay');
    }

    /**
     * show list 
     */
    public function index() {
        $data = array(
            'page_title' => 'SAXA Gifts - Lắng nghe họ nói',
            'typeCategory' => $this->config->item('typeCategory'),
            'language_type' => $this->config->item('language_type'),
        );
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'Home',
                base_url('listenThemSay') => 'Lắng nghe họ nói'),
        );
        $item = $this->input->get(); // get param search
        $param = array(); // param new category

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
        $data['list_data'] = $this->mYourSay->listAll($item, $total_records, $offset, $page_config['per_page']);
        if (!empty($data['list_data'])) { // pagination
            $this->load->library('pagination');
            $page_config["total_rows"] = $total_records;
            $this->pagination->initialize($page_config);
            $data["pagination"] = $this->pagination->create_links();
        }
        $data['offset'] = $offset;
        $data['sParam'] = $item;
        $data['param'] = $param;
        $tpl["main_content"] = $this->load->view('yoursay/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }

    /**
     * add new listn them say
     */
    public function add() {
        $data = array(
            'page_title' => 'SAXA Gifts - thêm mới lắng nghe họ nói',
            'language_type' => $this->config->item('language_type'),
            'type_listen'   =>  $this->config->item('type_listen'),
        );
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'Home',
                base_url('listThemSay') => 'Lắng nghe họ nói',
                base_url('listenThemSay/add') => 'Tạo mới'),
        );

        // post form
        if ($this->isPostMethod()) {
            $param = $this->input->post();
            $error = array();

            $this->_validate($param, $error);
            if (empty($error)) { // new category
                if (!empty($_FILES['logo']['name'])) {
                    
                    $checkUpload = $this->uploadPhoto($_FILES['logo'], 'logo', URL_IMAGE_YOUR_SAY, TRUE, 1366, 768, $maxSize = 200000);
                    
                    if ($checkUpload) {
                        $param['logo'] = $checkUpload; // Get logo name:
                        
                        // resize image
                        if ($param['type'] == 1){
                            $is_resize_image = $this->resizePhoto($checkUpload, 295, 516,URL_IMAGE_YOUR_SAY);
                        } else {
                            $is_resize_image = $this->resizePhoto($checkUpload, 393, 513,URL_IMAGE_YOUR_SAY);
                        }
                        // create thumb
                        $is_resize_thumb = $this->resizePhoto($checkUpload, 140, 140,URL_IMAGE_YOUR_SAY, URL_IMAGE_YOUR_SAY_THUMB);
                        
                        if ($is_resize_thumb != TRUE || $is_resize_image != TRUE ) { // not resize
                            $error[] = 'Không xử lý được file ảnh <br/> vui lòng kiểm tra lại';
                        }
                    } else {
                        $error[] = 'File ảnh chưa được up <br/> vui lòng kiểm tra lại';
                    }
                } else {
                    $error[] = 'Hãy chọn ảnh đại diện';
                }

                if (empty($error)) {
                    $this->db->trans_off();
                    $this->db->trans_begin();
                    $this->mYourSay->add($param);

                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        $error[] = 'Hệ thống chưa thêm được danh mục<br/> Vui lòng thử lại';
                    } else {
                        $this->db->trans_commit();
                        redirect(base_url('listenThemSay'));
                    }
                }
            }
            $data['error'] = $error;
            $data['params'] = $param;
        }
        
        $tpl["main_content"] = $this->load->view('yoursay/new', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }

    /**
     * edit
     * @param type $id
     */
    public function edit($id) {
        if (!is_numeric($id)){
            redirect(base_url('listenThemSay'));
        }
        
        $param = $this->mYourSay->getRowById($id);
        
        if (empty($param)){
            redirect(base_url('listenThemSay'));
        }
        
        $old_logo = $param['logo'];
        
        $data = array(
            'page_title' => 'SAXA Gifts - thêm mới lắng nghe họ nói',
            'language_type' => $this->config->item('language_type'),
            'type_listen'   =>  $this->config->item('type_listen'),
        );
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'Home',
                base_url('listThemSay') => 'Lắng nghe họ nói',
                base_url('listenThemSay/edit') => 'Cập nhật'),
        );
        
        // post form
        if ($this->isPostMethod()) {
            $param = $this->input->post();
            $error = array();

            $this->_validate($param, $error);
            if (empty($error)) { // new category
                if (!empty($_FILES['logo']['name'])) {
                    
                    $checkUpload = $this->uploadPhoto($_FILES['logo'], 'logo', URL_IMAGE_YOUR_SAY, TRUE, 1366, 768, $maxSize = 200000);
                    
                    if ($checkUpload) {
                        $param['logo'] = $checkUpload; // Get logo name:
                        
                        // resize image
                        if ($param['type'] == 1){
                            $is_resize_image = $this->resizePhoto($checkUpload, 295, 516,URL_IMAGE_YOUR_SAY);
                        } else {
                            $is_resize_image = $this->resizePhoto($checkUpload, 393, 513,URL_IMAGE_YOUR_SAY);
                        }
                        // create thumb
                        $is_resize_thumb = $this->resizePhoto($checkUpload, 140, 140,URL_IMAGE_YOUR_SAY, URL_IMAGE_YOUR_SAY_THUMB);
                        
                        if ($is_resize_thumb != TRUE || $is_resize_image != TRUE ) { // not resize
                            $error[] = 'Không xử lý được file ảnh <br/> vui lòng kiểm tra lại';
                        } else {
                            unlink(URL_IMAGE_YOUR_SAY.$old_logo);
                            unlink(URL_IMAGE_YOUR_SAY_THUMB.$old_logo);
                        }
                    } 
                }

                if (empty($error)) {
                    $this->db->trans_off();
                    $this->db->trans_begin();
                    $this->mYourSay->edit($param, $id);

                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        $error[] = 'Hệ thống chưa thêm được danh mục<br/> Vui lòng thử lại';
                    } else {
                        $this->db->trans_commit();
                        redirect(base_url('listenThemSay'));
                    }
                }
            }
            $data['error'] = $error;
        }
        
        $data['params'] = $param;
        $data['id'] = $id;
        
        $tpl["main_content"] = $this->load->view('yoursay/edit', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    /**
     * delete 
     */
    public function delete() {
        
        $this->db->trans_off();
        $this->db->trans_begin();
        
        $this->mYourSay->delete($id);
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    /**
     * check validate form
     * @param array $param
     * @param array $error
     */
    private function _validate(&$data, &$error) {
        //Trim
        foreach ($data as $k => $item) {
            if (is_string($item)) {
                $data[$k] = trim(htmlspecialchars($item));
            }
        }
        //Load
        $this->load->library('form_validation');
        // Set rules:
        $this->form_validation->set_rules("name", 'Nhập tên', "required|trim|xss_clean");
        $this->form_validation->set_rules("comment", 'Nhập nội dung họ muốn nói', "required|trim");
        
        // Set Message:
        $this->form_validation->set_message('required', '%s');
        //Validate
        if ($this->form_validation->run() == FALSE) {
            $error = $this->form_validation->error_array();
        }
    }

}
