<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/06/15
 * Screen partners management
 */
class Partners extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->lang->load('partners');

        // Load model:
        $this->load->model(array('mpartners'));
    }

    /**
     *  show list partners
     */
    public function index() {
        $params = array();
        $data = array(
            'page_title' => $this->lang->line('PAR_TITLE'),
            'language_type' => $this->_language,
        );
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'Home',
                'javascript:;' => 'Danh sách đối tác'),
        );
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = array();
            $params = $this->input->post();
            // Check validation input
            $this->_validate($params, $error);
            //echo '<pre>';            print_r($_FILES['logo']);exit;
            if (empty($error)) {
                $checkUpload = $this->uploadPhoto($_FILES['logo'], 'logo', IMAGE_PARTNERS_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000);
                if ($checkUpload) {
                    // Get logo name:
                    $params['logo'] = $checkUpload;
                    $is_resize = $this->resizePhoto($checkUpload, IMAGE_WIDTH_150, IMAGE_HEIGHT_150, IMAGE_PARTNERS_PATH, FALSE);
                    if ($is_resize != TRUE) {
                        $error[] = 'Không xử lý được file ảnh <br/> vui lòng kiểm tra lại'; 
                    } 
                } else {
                    $error[] = 'Ảnh đối tác chưa được up <br/> vui lòng kiểm tra lại';
                }
                if (empty($error)) {
                    $isInsert = $this->mpartners->save($params); // upload image
                    if ($isInsert) {
                        $params = array();
                    } else {
                        $error[] = 'Hệ thống chưa cập nhật được thông tin <br /> vui lòng kiểm tra lại.';
                    }
                }
            }
            $data['params'] = $params;
            $data['par_errors'] = $error;
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
            'base_url' => base_url('partners/?' . $queryString),
            'per_page' => NUMBER_PAGE_PARTNERS,
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
        $list_partners = $this->mpartners->listAll($filter,$total_records, $offset, $page_config['per_page']); // load all user
        if (!empty($list_partners) && $total_records > NUMBER_PAGE_PARTNERS) { // Pagination
            $this->load->library('pagination');
            $page_config["total_rows"] = $total_records;
            $this->pagination->initialize($page_config);
            $data["pagination"] = $this->pagination->create_links();
        }
        $data['offset'] = $offset;
        $data['list_partners'] = $list_partners;
        $tpl["main_content"] = $this->load->view('partners/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    /**
     *  show detail partner
     * @param type $id
     */
    public function detail($id = '') {
        if (!empty($id) && filter_var($id, FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $partner = $this->mpartners->detail($id);
            if (empty($partner)){
                redirect(base_url('partners'));
            }
            $data = array(
                'page_title' => $this->lang->line('PAR_EDIT'),
                'detailPar' => $partner ,
            );
            $tpl = array(
                'breadcrumb' => array(
                    base_url() => 'Home',
                    base_url('partners') => 'Danh sách đối tác',
                    'javascript:;' => $partner['name'] ,
                    ),
            );
            $tpl["main_content"] = $this->load->view('partners/detail', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        } else {
            redirect(base_url('partners'));
        }
    }

    /**
     * edit partners
     * @param type $id
     */
    public function edit($id = '') {
        if (!empty($id) && filter_var($id, FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $partner = $this->mpartners->detail($id);
            if (empty($partner)) {
                redirect(base_url('partners'));
            }
            $tpl = array(
                'breadcrumb' => array(
                    base_url() => 'Home',
                    base_url('partners') => 'Danh sách đối tác',
                    'javascript:;' => 'Cập nhật'),
            );
            $data = array(
                'page_title' => $this->lang->line('PAR_DETAIL'),
                'detailPar' => $partner,
                'language_type' => $this->_language,
            );
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $error = array();
                $params = $this->input->post();
                // Check validation input
                $this->_validate($params, $error);
                //echo '<pre>';            print_r($error);exit;
                if (empty($error)) {
                    if (!empty($_FILES['logo']['name'])) { // edit logo
                        $checkUpload = $this->uploadPhoto($_FILES['logo'], 'logo', IMAGE_PARTNERS_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000);
                        if ($checkUpload) {
                            $params['logo'] = $checkUpload; // Get logo name:
                            $is_resize = $this->resizePhoto($checkUpload, IMAGE_WIDTH_150, IMAGE_HEIGHT_150, IMAGE_PARTNERS_PATH, FALSE);
                            if ($is_resize != TRUE) {
                                $error[] = 'Không xử lý được file ảnh <br/> vui lòng kiểm tra lại';
                            }
                            if ($is_resize == TRUE && !empty($partner['logo']) && is_file(IMAGE_PARTNERS_PATH.$partner['logo'])){
                                unlink(IMAGE_PARTNERS_PATH.$partner['logo']);
                            }
                        } else {
                            $error[] = 'Ảnh đối tác chưa được up <br/> vui lòng kiểm tra lại';
                        }
                    }
                    if (empty($error)){
                        $isUpdate = $this->mpartners->save($params);
                        if ($isUpdate){
                            redirect(base_url('partners'));
                        } else {
                            $error[] = 'Hệ thống chưa cập nhật được dữ liệu <br/> vui lòng kiểm tra lại';
                        }
                        
                    }                    
                }
                $data['params'] = $params;
                $data['par_errors'] = $error;
            }
            $tpl["main_content"] = $this->load->view('partners/edit', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        } else {
            redirect(base_url('partners'));
        }
    }

    /**
     * delete partner
     */
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])) {
            $par_id = base64_decode($_POST['id']);
            if ($this->mpartners->delete($par_id)) {
                echo 1;
            } else {
                echo '';
            }
        } else {
            echo '';
        }
    }

    /**
     * validate form
     * @param type $data
     * @param type $errors
     */
    private function _validate(&$data, &$errors) {
        //Trim
        foreach ($data as $k => $item) {
            if (is_string($item)) {
                $data[$k] = trim($item);
            }
        }
        //Load
        $this->load->library('form_validation');
        // Set rules:
        $this->form_validation->set_rules("name", $this->lang->line('PAR_MISSING_NAME_EMPTY'), "required|trim|max_length[255]|callback__checkExistName");
        $this->form_validation->set_rules("address", $this->lang->line('ADDRESS'), "trim|max_length[255]");
        $this->form_validation->set_rules("email", $this->lang->line('EMAIL_INVALID'), "trim|valid_email");
        $this->form_validation->set_rules("phone", $this->lang->line('PHONE'), "trim|integer|max_length[20]");
        $this->form_validation->set_rules("logo", $this->lang->line('LOGO'), "trim|max_length[255]");
        $this->form_validation->set_rules("url", $this->lang->line('URL'), "trim|max_length[255]");
        $this->form_validation->set_rules("note", $this->lang->line('NOTE'), "trim|max_length[300]");
        $this->form_validation->set_rules("language_type", $this->lang->line('LANGUAGE_MISSING_EMPTY'), "required|integer|trim|max_length[2]");
        // Set Message:
        $this->form_validation->set_message('required', '%s');
        //Validate
        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
        }
    }

    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/14
     * Check exist category name
     */
    public function _checkExistName() {
        if (empty($_POST['partners_id'])) {
            if ($this->mpartners->checkExistName($_POST['name'])) {
                $this->form_validation->set_message('_checkExistName', $this->lang->line('PAR_MISSING_EXIST_NAME'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }

}
