<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/06/23
 * Screen category news management
 */
class Saxa_everyday extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->lang->load('category_news');
        // Load model:
        $this->load->model(array('msaxa_everyday'));
    }

    public function index() {
        $params = array();
        $errors = array();
        $items = array();
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'home',
                base_url('saxa_everyday') => 'Danh mục tin tức'),
        );
        if (!empty($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $data = array(
            'page_title' => $this->lang->line(),
            'language_type' => $this->_language,
            'listAll' => $this->msaxa_everyday->listAll(),
            'position' => $this->config->item('position_saxa_everyday'),
        );

        if ($this->input->post()) {
            $params = $this->input->post();
            // Set rules:
            $this->_validate($params, $error);
            if (empty($error)) {

                // upload avatar
                if ($params['position'] == 1) {
                    if (!empty($_FILES['avatar']['name'])) {
                        $checkUpload = $this->uploadPhoto($_FILES['avatar'], 'avatar', URL_IMAGE_SLIDE_CATEGORY, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000);
                        if ($checkUpload) {
                            $params['avatar'] = $checkUpload; // Get logo name:
                            $is_resize = $this->resizePhoto($checkUpload, 923, 376, URL_IMAGE_SLIDE_CATEGORY);
                            if ($is_resize != TRUE) { // not resize
                                $error[] = 'Không xử lý được file ảnh <br/> vui lòng kiểm tra lại';
                            }
                        } else {
                            $error[] = 'File ảnh chưa được up <br/> vui lòng kiểm tra lại';
                        }
                    }
                } else {
                    if (!empty($_FILES['avatar']['name'])) {
                        $checkUpload = $this->uploadPhoto($_FILES['avatar'], 'avatar', IMAGE_CAT_NEWS_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000);
                        if ($checkUpload) {
                            $params['avatar'] = $checkUpload; // Get logo name:
                            $is_resize = $this->resizePhoto($checkUpload, 198, 97, IMAGE_CAT_NEWS_PATH);
                            if ($is_resize != TRUE) { // not resize
                                $error[] = 'Không xử lý được file ảnh <br/> vui lòng kiểm tra lại';
                            }
                        } else {
                            $error[] = 'File ảnh chưa được up <br/> vui lòng kiểm tra lại';
                        }
                    }
                }


                // check slug common
                if (empty($error)) {
                    if (!empty($param['slug'])) {
                        $slug = slug_convert($param['slug']);
                    } else if (!empty($param['name'])) {
                        $slug = slug_convert($param['name']);
                    } else if (!empty($param['title'])) {
                        $slug = slug_convert($param['title']);
                    } else {
                        $slug = '';
                    }

                    $is_check = $this->mcommon->checkSlug($slug);

                    if ($is_check == TRUE) {
                        $error[] = 'Slugs đã tồn tại, trong hệ thống, <br /> Hãy kiểm tra lại name hoặc slug';
                    }
                }

                if (empty($error)) {
                    $isInsert = $this->msaxa_everyday->save($params);
                    if ($isInsert) {
                        $slug_insert = !empty($params['slug']) ? slug_convert($params['slug']) : slug_convert($params['name']);
                        $this->mcommon->createSlug($slug_insert, 'd_news_category', 'news');
                        $params = array();
                    }
                }
            }
            $data['params'] = $params;
            $data['cat_news_errors'] = $error;
        }
        $items = $this->input->get();
        // Config pagination:
        $parmameter_page = 'page';
        $queryString = $this->input->server('QUERY_STRING');
        //remove parameter page

        $queryString = preg_replace('/(\&|)page=[0-9]$/is', '', $queryString);
        $queryString = preg_replace('/(\&|)page=$/is', '', $queryString);

        $page_config = array(
            'base_url' => base_url('saxa_everyday/?' . $queryString),
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
        $data['list_data'] = $this->msaxa_everyday->search($items, $total_records, $offset, $page_config['per_page']);
        if (!empty($data['list_data'])) {
            // Pagination
            $this->load->library('pagination');
            $page_config["total_rows"] = $total_records;
            $this->pagination->initialize($page_config);
            $data["pagination"] = $this->pagination->create_links();
        }
        $data['offset'] = $offset;
        $data['items'] = $items;
        $tpl["main_content"] = $this->load->view('saxa_everyday/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }

    /**
     * 
     * @param type $id
     * Edit category news
     */
    public function edit($id = '') {
        if (!empty($id) && filter_var($id, FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $params = array();
            $error = array();
            $params = $this->msaxa_everyday->getDetail($id);

            //Check exist category news by Id:
            if (empty($params)) {
                redirect(base_url('saxa_everyday'));
            }
            $data = array(
                'page_title' => $this->lang->line('CAT_NEWS_EDIT'),
                'language_type' => $this->_language,
                'position' => $this->config->item('position_saxa_everyday'),
            );
            $tpl = array(
                'breadcrumb' => array(
                    base_url() => 'home',
                    base_url('saxa_everyday') => 'Danh mục tin tức',
                    'javascript:;' => 'Cập nhật',
                    '#' => $params['name']),
            );
            $position = $params['position'];
            $avatar = $params['avatar'];
            $old_slug = $params['slug'];

            if ($this->input->post()) {
                $params = $this->input->post();
                $this->_validate($params, $error, TRUE);

                if (empty($error)) {

                    // upload avatar
                    if ($position == 1) {
                        if (!empty($_FILES['avatar']['name'])) {
                            $checkUpload = $this->uploadPhoto($_FILES['avatar'], 'avatar', URL_IMAGE_SLIDE_CATEGORY, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000);
                            if ($checkUpload) {
                                $params['avatar'] = $checkUpload; // Get logo name:
                                $is_resize = $this->resizePhoto($checkUpload, 923, 376, URL_IMAGE_SLIDE_CATEGORY);
                                if ($is_resize != TRUE) { // not resize
                                    $error[] = 'Không xử lý được file ảnh <br/> vui lòng kiểm tra lại';
                                } else {
                                    unlink(URL_IMAGE_SLIDE_CATEGORY . $avatar);
                                }
                            } else {
                                $error[] = 'File ảnh chưa được up <br/> vui lòng kiểm tra lại';
                            }
                        }
                    } else {
                        if (!empty($_FILES['avatar']['name'])) {
                            $checkUpload = $this->uploadPhoto($_FILES['avatar'], 'avatar', IMAGE_CAT_NEWS_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000);
                            if ($checkUpload) {
                                $params['avatar'] = $checkUpload; // Get logo name:
                                $is_resize = $this->resizePhoto($checkUpload, 198, 97, IMAGE_CAT_NEWS_PATH);
                                if ($is_resize != TRUE) { // not resize
                                    $error[] = 'Không xử lý được file ảnh <br/> vui lòng kiểm tra lại';
                                } else {
                                    unlink(IMAGE_CAT_NEWS_PATH . $avatar);
                                }
                            } else {
                                $error[] = 'File ảnh chưa được up <br/> vui lòng kiểm tra lại';
                            }
                        }
                    }

                    // check slug common    
                    if (empty($error)) {
                        if ($old_slug != $params['slug']) {

                            if (!empty($params['slug'])) {
                                $slug = slug_convert($params['slug']);
                            } else if (!empty($params['name'])) {
                                $slug = slug_convert($params['name']);
                            } else if (!empty($params['title'])) {
                                $slug = slug_convert($params['title']);
                            } else {
                                $slug = '';
                            }

                            $is_check = $this->mcommon->checkSlug($slug);

                            if ($is_check == TRUE) {
                                $error[] = 'Slugs đã tồn tại, trong hệ thống, <br /> Hãy kiểm tra lại name hoặc slug';
                            }
                        }
                    }
                    if (empty($error)) {
                        $params['cat_news_id'] = $id;
                        if ($this->msaxa_everyday->edit($params)) {
                            if ($old_slug != $params['slug']) {
                                $this->mcommon->delete($old_slug);
                                $slug_insert = !empty($params['slug']) ? slug_convert($params['slug']) : slug_convert($params['name']);
                                $this->mcommon->createSlug($slug_insert, 'd_saxa_everyday', 'saxaeveryday');
                            }
                            redirect(base_url('saxa_everyday'));
                        }
                    }
                }
                $data['cat_news_errors'] = $error;
            }

            $data['params'] = $params;
            $data['avatar'] = $params['avatar'];
            $tpl["main_content"] = $this->load->view('saxa_everyday/edit', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        } else {

            redirect(base_url('saxa_everyday'));
        }
    }

    public function detail($id = '') {
        if (!empty($id) && filter_var($id, FILTER_VALIDATE_INT, array('min_range' => 1))) {

            $detailCatNews = $this->msaxa_everyday->getDetail($id);
            //echo '<pre>';            print_r($detailCatNews);exit;
            //Check exist category news by Id:
            if (empty($detailCatNews)) {
                redirect(base_url('saxa_everyday'));
            }

            $tpl = array(
                'breadcrumb' => array(
                    base_url() => 'home',
                    base_url('saxa_everyday') => 'Danh mục tin tức',
                    'javascript:;' => 'Chi tiết',
                    '#' => $detailCatNews['name']),
            );

            $data = array(
                'page_title' => $this->lang->line('CAT_NEWS_DETAIL'),
                'detailCatNews' => $detailCatNews,
                'position' => $this->config->item('position'),
            );

            $tpl["main_content"] = $this->load->view('saxa_everyday/detail', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        } else {
            redirect(base_url('saxa_everyday'));
        }
    }

    //Category news detail popup
    public function detailCatNews() {
        $input = $this->input->post();
        if ($this->isPostMethod() && !empty($input) && !empty($input['is_ajax']) && ($input['is_ajax'] == 'ajax')) { // view detail category news
            $is_detailCat = $this->msaxa_everyday->getDetail($input['catNewsId']);
            if ($is_detailCat) {
                $positions = $this->config->item('position');
                $is_detailCat['position_name'] = '';
                if (!empty($is_detailCat['position'])){
                    $is_detailCat['position_name'] = $positions[$is_detailCat['position']];   
                }
                
                if (!empty($is_detailCat['des_seo'])){
                    $is_detailCat['des_seo'] = htmlspecialchars_decode($is_detailCat['des_seo']);   
                }
                
                $json_result = array(
                    'result' => 1,
                    'code' => 202,
                    'data' => $is_detailCat,
                );
                echo json_encode($json_result);
                return;
            } else { // not find profile
                $json_result = array(
                    'result' => 1,
                    'code' => 400,
                    'data' => 'không tìm thấy danh mục tin tức này',
                );
                echo json_encode($json_result);
                return;
            }
        } else { // is hack
            $json_result = array(
                'result' => 1,
                'code' => 500,
                'data' => 'is hack',
            );
            echo json_encode($json_result);
            return;
        }
    }

    /**
     * Delete Category news
     * @return type
     */
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])) {
            $cat_news_id = (int) $_POST['id'];
            if ($this->msaxa_everyday->del($cat_news_id)) {
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
        $this->form_validation->set_rules("name", $this->lang->line('CAT_NEWS_MISSING_NAME_EMPTY'), "required|trim|xss_clean|max_length[255]|callback__checkExistName");
        $this->form_validation->set_rules("title", 'Nhập mô tả ngắn', "required|trim|xss_clean|");
        $this->form_validation->set_rules("slug", $this->lang->line('MISSING_EMPTY_SLUG'), "trim|max_length[255]|callback__checkExistSlug");
        $this->form_validation->set_rules("language_type", $this->lang->line('PRO_MISSING_PRICE_INVALID'), "required|trim|integer|max_length[1]");
        $this->form_validation->set_rules("keyword_seo", $this->lang->line('PRO_DESCRIPTION'), "trim");
        $this->form_validation->set_rules("des_seo", $this->lang->line('PRO_CONTENT'), "trim");
        
        // Set Message:
        $this->form_validation->set_message('required', '%s');
        //Validate
        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
        }
    }

    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/22
     * Check exist product name
     */
    public function _checkExistName() {
        if (empty($_POST['id'])) {
            if ($this->msaxa_everyday->checkExistName($_POST['name'])) {
                $this->form_validation->set_message('_checkExistName', $this->lang->line('CAT_NEWS_MISSING_NAME_EXIST'));
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
        if (empty($_POST['id'])) {
            $slugName = slug_convert($_POST['slug']);
            if (!empty($_POST['slug']) && $this->msaxa_everyday->checkExistSlug($slugName)) {
                $this->form_validation->set_message('_checkExistSlug', $this->lang->line('CAT_NEWS_MISSING_SLUG_EXIST'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }

    /**
     * new category 
     * @param type $param
     */
    public function add() {
        $params = array();
        $errors = array();

        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'home',
                base_url('saxa_everyday') => 'Danh mục tin tức',
                base_url('saxa_everyday/add') => 'Thêm mới'),
        );

        $data = array(
            'page_title' => $this->lang->line(),
            'language_type' => $this->_language,
            'listAll' => $this->msaxa_everyday->listAll(),
            'position' => $this->config->item('position_saxa_everyday'),
        );

        if ($this->input->post()) {
            $params = $this->input->post();
            // Set rules:
            $this->_validate($params, $error);
            if (empty($error)) {
                
                // upload avatar
                if ($params['position'] == 1) {
                    if (!empty($_FILES['avatar']['name'])) {
                        $checkUpload = $this->uploadPhoto($_FILES['avatar'], 'avatar', URL_IMAGE_SLIDE_CATEGORY, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000);
                        if ($checkUpload) {
                            $params['avatar'] = $checkUpload; // Get logo name:
                            $is_resize = $this->resizePhoto($checkUpload, 923, 376, URL_IMAGE_SLIDE_CATEGORY);
                            if ($is_resize != TRUE) { // not resize
                                $error[] = 'Không xử lý được file ảnh <br/> vui lòng kiểm tra lại';
                            }
                        } else {
                            $error[] = 'File ảnh chưa được up <br/> vui lòng kiểm tra lại';
                        }
                    } else {
                        $error[] = 'File ảnh chưa được up <br/> vui lòng kiểm tra lại';
                    }
                } else {
                    if (!empty($_FILES['avatar']['name'])) {
                        $checkUpload = $this->uploadPhoto($_FILES['avatar'], 'avatar', IMAGE_CAT_NEWS_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000);
                        if ($checkUpload) {
                            $params['avatar'] = $checkUpload; // Get logo name:
                            $is_resize = $this->resizePhoto($checkUpload, 198, 97, IMAGE_CAT_NEWS_PATH);
                            if ($is_resize != TRUE) { // not resize
                                $error[] = 'Không xử lý được file ảnh <br/> vui lòng kiểm tra lại';
                            }
                        } else {
                            $error[] = 'File ảnh chưa được up <br/> vui lòng kiểm tra lại';
                        }
                    } else {
                        $error[] = 'File ảnh chưa được up <br/> vui lòng kiểm tra lại';
                    }
                }
                
                // check slug common
                if (empty($error)) {
                    if (!empty($param['slug'])) {
                        $slug = slug_convert($param['slug']);
                    } else if (!empty($param['name'])) {
                        $slug = slug_convert($param['name']);
                    } else if (!empty($param['title'])) {
                        $slug = slug_convert($param['title']);
                    } else {
                        $slug = '';
                    }

                    $is_check = $this->mcommon->checkSlug($slug);

                    if ($is_check == TRUE) {
                        $error[] = 'Slugs đã tồn tại, trong hệ thống, <br /> Hãy kiểm tra lại name hoặc slug';
                    }
                }

                if (empty($error)) {
                    $isInsert = $this->msaxa_everyday->save($params);
                    if ($isInsert) {
                        $slug_insert = !empty($params['slug']) ? slug_convert($params['slug']) : slug_convert($params['name']);
                        $this->mcommon->createSlug($slug_insert, 'd_saxa_everyday', 'saxaeveryday');
                        redirect(base_url('saxa_everyday'));
                    }
                }
            }
            $data['params'] = $params;
            $data['cat_news_errors'] = $error;
        }
        
        $parent = $this->uri->segment(3);
        
        if (!empty($parent)){
            $data['parent'] = $parent;
        }
        
        $tpl["main_content"] = $this->load->view('saxa_everyday/add', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }

}
