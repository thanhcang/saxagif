<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/06/07
 * Management category
 */
class Category extends MY_Controller {

    var $_user_login;
    public function __construct() {
        parent::__construct();
        $this->check_login();
        $this->_user_login = $this->session->userdata('user_id');
        $this->load->model('mcategory');
        $this->lang->load('category');
    }

    /**
     * load  category
     */
    public function index() {
        $data = array(
            'page_title' => 'SAXA Gifts - Quản lý danh mục',
            'typeCategory' => $this->config->item('typeCategory'),
            'language_type' => $this->config->item('language_type'),
        );
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'Home',
                base_url('user') => 'Danh mục'),
        );
        $item = $this->input->get(); // get param search
        $param = array(); // param new category
        if ($this->isPostMethod()){
            $param = $this->input->post();
            $error = array();
            $this->_validate($param, $error);
            if (empty($error)) { // new category
                $this->db->trans_off();
                $this->db->trans_begin();
                $this->mcategory->addParentCategory($param);
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $error[] = 'Hệ thống chưa thêm được danh mục<br/> Vui lòng thử lại';
                } else {
                    $this->db->trans_commit();
                    $item = array(); // reset form search
                    $param = array(); // reset form new category
                }
            }
            $data['error'] = $error;
        }
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
        $data['list_data'] = $this->mcategory->listAllCategory($item, $total_records, $offset, $page_config['per_page']);
        if (!empty($data['list_data'])) { // pagination
            $this->load->library('pagination');
            $page_config["total_rows"] = $total_records;
            $this->pagination->initialize($page_config);
            $data["pagination"] = $this->pagination->create_links();
        }
        $data['offset'] = $offset;
        $data['sParam'] = $item;
        $data['param'] = $param;
        $tpl["main_content"] = $this->load->view('category/listcategory', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    /**
     * show detail parent category
     * @param type $id
     * @return type
     */
    public function viewCategory($id) {
        if (empty($id) || !is_numeric($id) || $id < 1) {
            redirect(base_url('category'));
            return;
        }
        $detail = $this->mcategory->getDetail($id);
        if (empty($detail)) {
            redirect(base_url('category'));
            return;
        }
        $data = array(
            'page_title' => 'SAXA Gifts - chi tiết danh mục',
            'typeCategory' => $this->config->item('typeCategory'),
            'language_type' => $this->config->item('language_type'),
        );
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'Home',
                base_url('category') => 'Danh mục',
                'javascriipt:;' => $detail['name']),
        );
        $data['catDetail'] = $detail;
        $tpl["main_content"] = $this->load->view('category/viewCategory', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    /**
     * update category
     * @param type $id
     * @return type
     */
    public function updateCategory($id) {
        if (empty($id) || !is_numeric($id) || $id < 1) {
            redirect(base_url('category'));
            return;
        }
        $param = $this->mcategory->getDetail($id);
        if (empty($param)) {
            redirect(base_url('category'));
            return;
        }
        $data = array(
            'page_title' => 'SAXA Gifts - cập nhật danh mục',
            'typeCategory' => $this->config->item('typeCategory'),
            'language_type' => $this->config->item('language_type'),
        );
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'Home',
                base_url('user') => 'Danh mục',
                '#' => 'Cập nhật',
                'javascriipt:;' => $param['name']),
        );
        if ($this->isPostMethod()){
            $param = $this->input->post();
            $error = array();
            $this->_validateUpdateCategory($param, $error);
            if (empty($error)){
                $this->db->trans_off();
                $this->db->trans_begin();
                $this->mcategory->updateCategory($param);
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $error[] = 'Hệ thống chưa cập nhật <br/> Vui lòng thử lại';
                } else {
                    $this->db->trans_commit();
                    redirect(base_url('category/viewCategory'.'/'.$param['id']));
                    return;
                }
            }
            $data['error'] = $error;
        }
        $data['param'] = $param;
        $data['catId'] = $id;
        $tpl["main_content"] = $this->load->view('category/updateCategory', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    /**
     * list children category
     * @param type $id
     * @return type
     */
    public function childrenCategory($id) {
        if (empty($id) || !is_numeric($id) || $id < 1) {
            redirect(base_url('category'));
            return;
        }
        $parent = $this->mcategory->getDetail($id);
        if (empty($parent)) {
            redirect(base_url('category'));
            return;
        }
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'home',
                base_url('category') => 'Danh mục',
                base_url('category/viewCategory' . '/' . $parent['id']) => $parent['name'],
                'javascript:;' => 'Danh mục con',
            ),
        );
        $items = $this->input->get();
        if (!empty($items['page']) && filter_var($items['page'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $page = $items['page'];
        } else {
            $page = 1;
        }
        $data = array(
            'language_type' => $this->_language,
        );
        /**
         * Insert, update category
         */
        if ($this->isPostMethod()) {
            $error = array();
            $params = $this->input->post();
            $this->_validateChildren($params, $error); // Check validation input
            if (empty($error)) {
                if (!empty($_FILES['logo']['name'])) {
                    $checkUpload = $this->uploadPhoto($_FILES['logo'], 'logo', IMAGE_CATEGORY_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000);
                    if ($checkUpload) {
                        $params['logo'] = $checkUpload; // Get logo name:
                        $is_resize = $this->resizePhoto($checkUpload, $width = IMAGE_WIDTH_400, $height = IMAGE_HEIGHT_400, IMAGE_CATEGORY_PATH);
                        if ($is_resize != TRUE) { // not resize
                            $error[] = 'Không xử lý được file ảnh <br/> vui lòng kiểm tra lại';
                        }
                    } else {
                        $error[] = 'File ảnh chưa được up <br/> vui lòng kiểm tra lại';
                    }
                }
                if (empty($error)) {
                    $this->db->trans_off();
                    $this->db->trans_begin();
                    $this->mcategory->create($params,$parent['id']); // new children category
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        $error[] = 'Hệ thống chưa cập nhật được dữ liệu <br/> vui lòng kiểm tra lại';
                    } else {
                        $this->db->trans_commit();
                        $params = array();
                    }
                }
            }
            $data['params'] = $params;
            $data['cat_errors'] = $error;
        }
        // Config pagination:
        $parmameter_page = 'page';
        $queryString = $this->input->server('QUERY_STRING');
        //remove parameter page
        $queryString = preg_replace('/(\&|)page=[0-9]$/is', '', $queryString);
        $queryString = preg_replace('/(\&|)page=$/is', '', $queryString);
        $page_config = array(
            'base_url' => base_url('category/childrenCategory' . '/' . $parent['id'] . '?' . $queryString),
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
        $data['list_data'] = $this->mcategory->listAllChildrenCategory($items, $total_records, $offset, $page_config['per_page'], $parent['id']);
        if (!empty($data['list_data'])) {
            // Pagination
            $this->load->library('pagination');
            $page_config["total_rows"] = $total_records;
            $this->pagination->initialize($page_config);
            $data["pagination"] = $this->pagination->create_links();
        }
        $data['offset'] = $offset;
        $data['items'] = $items;
        $data['parent'] = $parent['id'];
        $tpl["main_content"] = $this->load->view('category/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }

    /**
     *  new category
     */
    public function create() {

        $data = array(
            'page_title' => $this->lang->line('CAT_TITLE_CREATE'),
            'language_type' => $this->_language,
            'parent' => $this->mcategory->listParent(),
        );

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = array();
            $params = $this->input->post();
            if (!empty($_FILES['logo'])) {
                //echo '<pre>';                print_r($_FILES['logo']);
                $fileTmpName = date('YmdHis') . '_' . $_FILES['logo']['name'];
                $fileName = str_replace(' ', '_', $fileTmpName);
                $config_upload = array(
                    'upload_path' => './common/multidata/cat_logo/',
                    'allowed_types' => 'png|jpg|jpeg|gif|bmp|tiff|raw',
                    'max_size' => 192600,
                    'max_width' => 1450,
                    'max_height' => 1400,
                    'overwrite' => TRUE,
                    'file_name' => $fileName,
                );

                $this->upload->initialize($config_upload);
                if (!$this->upload->do_upload('logo')) {
                    //$error[] = $this->lang->line('CAT_MISSING_UPLOAD_ERR');
                } else {
                    $params['logo'] = $config_upload['file_name'];
                }
            }
            // Check validation input
            $this->_validate($params, $error);
            //echo '<pre>';            print_r($params);exit;
            if (empty($error)) {
                if ($this->mcategory->create($params)) {
                    redirect(base_url('category'));
                }
            }
            $data['params'] = $params;
            $data['cat_errors'] = $error;
        }

        $tpl["main_content"] = $this->load->view('category/create', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }

    /**
     * edit category
     * @param int $cat_id
     */
    public function edit($cat_id = '') {
        $cat_id = (int) $cat_id;
        if (empty($cat_id)) {
            redirect(base_url('category'));
        }
        $detail_cat = $this->mcategory->getDetail($cat_id);
        if (empty($detail_cat)) {
            redirect(base_url('category'));
        }
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'home',
                base_url('category') => 'Danh mục',
                'javascript:;' => 'Cập nhật',
                '#' => htmlspecialchars($detail_cat['name']),
            ),
        );
        $data = array(
            'page_title' => $this->lang->line('CAT_TITLE_EDIT'),
            'language_type' => $this->_language,
            'parent' => $this->mcategory->listParent(),
        );

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = array();
            $params = $this->input->post();
            $checkUpload = $this->uploadPhoto($_FILES['logo'], 'logo', TEMP_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000);
            if ($checkUpload) {
                // Get logo name:
                $params['logo'] = $checkUpload;
                if ($this->resizePhoto($checkUpload, $width = IMAGE_WIDTH_400, $height = IMAGE_HEIGHT_400, TEMP_PATH, IMAGE_CATEGORY_PATH)) {
                    // Add watermarking photo:
                    // Remove tmp file:
                    $tmpFile = TEMP_PATH . $checkUpload;
                    if (file_exists($tmpFile)) {
                        $fh = fopen($tmpFile, "rb");
                        $imgData = fread($fh, filesize($tmpFile));
                        fclose($fh);
                        unlink($tmpFile);
                    }
                }
                // Remove file:
                if (!empty($detail_cat['logo'])) {
                    $imgFile = IMAGE_CATEGORY_PATH . $detail_cat['logo'];
                    if (file_exists($imgFile)) {
                        $fh = fopen($imgFile, "rb");
                        $imgData = fread($fh, filesize($imgFile));
                        fclose($fh);
                        unlink($imgFile);
                    }
                }
            }
            // Check validation input
            $this->_validate($params, $error);
            //echo '<pre>';            print_r($params);exit;
            if (empty($error)) {
                if ($this->mcategory->create($params)) {
                    redirect(base_url('category'));
                }
            }
            $data['params'] = $params;
            $data['cat_errors'] = $error;
        }
        $data['detail_cat'] = $detail_cat;
        //echo '<pre>';        print_r($data['detail_cat']);exit;
        $tpl["main_content"] = $this->load->view('category/edit', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }

    /*
     * categroy detail
     */
    public function detail($cat_id = '') {
        if (!empty($cat_id) && filter_var($cat_id, FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $data = array(
                'page_title' => $this->lang->line('CAT_DETAIL'),
                'catDetail' => $this->mcategory->getDetail($cat_id, $parent = TRUE),
            );
            if (empty($data['catDetail'])) {
                redirect(base_url('category'));
            }
            $tpl = array(
                'breadcrumb' => array(
                    base_url() => 'home',
                    base_url('category') => 'Danh mục',
                    'javascript:;' => $data['catDetail']['name']),
            );
            $tpl["main_content"] = $this->load->view('category/detail', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        } else {
            redirect(base_url('category'));
        }
    }

    /**
     * delete category
     * @return type
     */
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])) {
            $cat_id = (int) $_POST['id'];
            if ($this->mcategory->delCat($cat_id)) {
                $json_result = array(
                    'result' => 1,
                    'code' => 202,
                    'data' => 'success',
                );
                echo json_encode($json_result);
                return;
            } else {
                echo '';
            }
        } else {
            echo '';
        }
    }

    /*
     * edit category
     */
    public function editCat() {
        $data = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = base64_decode($_POST['id']);
            $catDetail = $this->mcategory->getDetail($id);
            if ($catDetail) {
                $data['catDetail'] = $catDetail;
                echo json_encode($data);
            } else {
                echo '';
            }
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
        $this->form_validation->set_rules("name", $this->lang->line('CAT_MISSING_EMPTY_NAME'), "required|trim|xss_clean|max_length[255]|callback__checkExistName");
        $this->form_validation->set_rules("slug", $this->lang->line('MISSING_EMPTY_SLUG'), "trim|max_length[255]|callback__checkExistSlug");
        $this->form_validation->set_rules("bg_color", $this->lang->line('CAT_MISSING_INVALID_BG_COLOR'), "trim|xss_clean");
        $this->form_validation->set_rules("language_type", $this->lang->line('CHOOSE_LANGUAGE'), "integer|trim|xss_clean");
        $this->form_validation->set_rules("parent", 'Parent', "trim|integer");
        $this->form_validation->set_rules("keyword_seo", $this->lang->line('KEYWORD_SEO'), "trim|max_length[255]");
        $this->form_validation->set_rules("des_seo", $this->lang->line('DESCRIPTION_SEO'), "trim|max_length[255]");
        $this->form_validation->set_rules("is_home", $this->lang->line('CAT_CHOOSE_HOME'), "trim|max_length[1]|interger");
        // Set Message:
        $this->form_validation->set_message('required', '%s');
        //Validate
        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
        }
    }
    
    /**
     * validate update category
     * @param type $data
     * @param type $errors
     */
    private function _validateUpdateCategory(&$data, &$errors) {
        //Trim
        foreach ($data as $k => $item) {
            if (is_string($item)) {
                $data[$k] = trim($item);
            }
        }
        //Load
        $this->load->library('form_validation');
        // Set rules:
        $this->form_validation->set_rules("name", $this->lang->line('CAT_MISSING_EMPTY_NAME'), "required|trim|xss_clean|max_length[255]");
        $this->form_validation->set_rules("slug", $this->lang->line('MISSING_EMPTY_SLUG'), "trim|max_length[255]|");
        $this->form_validation->set_rules("keyword_seo", $this->lang->line('KEYWORD_SEO'), "trim|max_length[255]");
        $this->form_validation->set_rules("des_seo", $this->lang->line('DESCRIPTION_SEO'), "trim|max_length[255]");
        // Set Message:
        $this->form_validation->set_message('required', '%s');
        //Validate
        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
        }
        if (empty($errors)) {
            $isExistsName = $this->mcategory->checkExistName($data['name'], $data['id']);
            if ($isExistsName == TRUE) {
                $errors[] = 'Tên danh mục đã tồn tại';
            }
            if (!empty($data['slug'])) {
                $isExistsSlug = $this->mcategory->checkExistSlug($data['slug'], $data['id']);
                if ($isExistsSlug == TRUE) {
                    $errors[] = 'Slug đã tồn tại';
                }
            }
        }
    }
    
    /**
     * validate update category
     * @param type $data
     * @param type $errors
     */
    private function _validateChildren(&$data, &$errors) {
        //Trim
        foreach ($data as $k => $item) {
            if (is_string($item)) {
                $data[$k] = trim($item);
            }
        }
        //Load
        $this->load->library('form_validation');
        // Set rules:
        $this->form_validation->set_rules("name", $this->lang->line('CAT_MISSING_EMPTY_NAME'), "required|trim|xss_clean|max_length[255]");
        $this->form_validation->set_rules("slug", $this->lang->line('MISSING_EMPTY_SLUG'), "trim|max_length[255]|");
        $this->form_validation->set_rules("keyword_seo", $this->lang->line('KEYWORD_SEO'), "trim|max_length[255]");
        $this->form_validation->set_rules("des_seo", $this->lang->line('DESCRIPTION_SEO'), "trim|max_length[255]");
        // Set Message:
        $this->form_validation->set_message('required', '%s');
        //Validate
        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
        }
        if (empty($errors)) {
            $isExistsName = $this->mcategory->checkExistName($data['name']);
            if ($isExistsName == TRUE) {
                $errors[] = 'Tên danh mục đã tồn tại';
            }
            if (!empty($data['slug'])) {
                $isExistsSlug = $this->mcategory->checkExistSlug($data['slug']);
                if ($isExistsSlug == TRUE) {
                    $errors[] = 'Slug đã tồn tại';
                }
            }
        }
    }

    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/14
     * Check exist category name
     */
    public function _checkExistName() {
        if (empty($_POST['category_id'])) {
            if ($this->mcategory->checkExistName($_POST['name'])) {
                $this->form_validation->set_message('_checkExistName', $this->lang->line('CAT_MISSING_EXIST_NAME'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }

    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/14
     * Check exist category slug
     */
    public function _checkExistSlug() {
        if (empty($_POST['category_id'])) {
            if ($this->mcategory->checkExistSlug($_POST['slug'])) {
                $this->form_validation->set_message('_checkExistSlug', $this->lang->line('CAT_MISSING_EXIST_SLUG'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }

}
