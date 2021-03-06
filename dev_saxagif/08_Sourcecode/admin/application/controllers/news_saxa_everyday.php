<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/07/05
 * Screen product management
 */
class News_saxa_everyday extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->lang->load('news');
        
        // Load model:
        $this->load->model(array('mnews_saxa_everyday', 'msaxa_everyday'));
    }
    
    public function index()
    {
        $params = array();
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'home',
                base_url('news') => 'Danh sách tin tức'),
        );
        if (!empty($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $data = array(
            'page_title'    => $this->lang->line('PAR_TITLE'),
            'language_type' => $this->_language,
            'listAllCatnews_saxa_everyday'=> $this->msaxa_everyday->listAll(),
            'position'      => $this->config->item('position_news'),
        );
        
        
        $filter = $this->input->get();
        // Config pagination:
        $parmameter_page = 'page';
        $queryString = $this->input->server('QUERY_STRING');
        //remove parameter page

        $queryString = preg_replace('/(\&|)page=[0-9]$/is', '', $queryString);
        $queryString = preg_replace('/(\&|)page=$/is', '', $queryString);
        
        $page_config = array(
            'base_url'    => base_url('news_saxa_everyday/?' . $queryString),
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
            'last_tag_open'=> '<li>',
            'last_tag_close'=> '</li>',
            'full_tag_open' => '<ul class="pagination pagination-centered">',
            'full_tag_close' => '</ul>',
        );
        
        $offset = max(($page - 1), 0) * $page_config['per_page'];
        $total_records = 0;
        $data['list_news'] = $this->mnews_saxa_everyday->search($filter, $total_records, $offset, $page_config['per_page']);
        if(!empty($data['list_news'])){
            // Pagination
            $this->load->library('pagination');
            $page_config["total_rows"] = $total_records;
            $this->pagination->initialize($page_config);
            $data["pagination"] = $this->pagination->create_links();
        }
        $data['offset'] = $offset;
        $data['filter']=  $filter;
        
        $tpl["main_content"] = $this->load->view('news_saxa_everyday/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    /*
     * Add news
     */
    public function add()
    {
        $data = array(
            'language_type' => $this->_language,
            'page_title' => $this->lang->line('NEWS_CREATE'),
            'listcategory'=> $this->msaxa_everyday->listAll(),
            'position'      => $this->config->item('position_news'),
        );
        
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'home',
                base_url('news') => 'Danh sách tin tức',
                'javascript:;' => 'Tạo mới'),
        );
        if ($this->input->post()) {
            $error = array();
            $params = $this->input->post();
            
            // Check validation input
            $this->_validate($params, $error);
            if(empty($error)){
                
                $checkUpload = $this->uploadPhoto($_FILES['avatar'], 'avatar', IMAGE_NEWS_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000 );
                if ($checkUpload) {
                    // Get logo name:
                    $params['avatar'] = $checkUpload;
                    
                    $is_resize = $this->resizePhoto($checkUpload, IMAGE_WIDTH_300, IMAGE_HEIGHT_300, IMAGE_NEWS_PATH);
                    if ($is_resize != TRUE) { // not resize
                        $error[] = 'Không xử lý được file ảnh <br/> vui lòng kiểm tra lại';
                    }    
                } else {
                    $error[] = 'File ảnh chưa được up <br/> vui lòng kiểm tra lại';
                }

                // check slug common
                if (empty($error)) {
                    if (!empty($params['txtSlug'])){
                        $slug = slug_convert($params['txtSlug']);
                    } else if (!empty($params['name'])) {
                        $slug = slug_convert($params['name']);
                    } else if (!empty($params['txtTitle'])) {
                        $slug = slug_convert($params['txtTitle']);
                    } else {
                        $slug = '';
                    }
                    
                    $is_check = $this->mcommon->checkSlug($slug);
                    
                    if ($is_check == TRUE) {
                        $error[] = 'Slugs đã tồn tại, trong hệ thống, <br /> Hãy kiểm tra lại name hoặc slug';
                    }
                }
                
                if (empty($error)) {
                    if ($this->mnews_saxa_everyday->save($params)) {
                        $slug_insert = !empty($params['txtSlug']) ? slug_convert($params['txtSlug']) : slug_convert($params['txtTitle']);
                        $this->mcommon->createSlug($slug_insert, 'd_news_saxa_everyday', 'saxaeveryday');
                        redirect(base_url('news_saxa_everyday'));
                    }
                }
            }
            $data['params'] = $params;
            $data['news_errors'] = $error;
        }
        
        $tpl["main_content"] = $this->load->view('news_saxa_everyday/add', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    /**
     * Edit news
     * @param type $newsId
     */
    public function edit($newsId = '')
    {
        if (!empty($newsId) && filter_var($newsId, FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
            $detailnews_saxa_everyday = $this->mnews_saxa_everyday->detail($newsId);
            
            if(empty($detailnews_saxa_everyday)) {
                redirect(base_url('news'));
            }
            
            // init param
            $old_avatar = $detailnews_saxa_everyday['avatar']; 
            $tpl = array(
                'breadcrumb' => array(
                    base_url() => 'home',
                    base_url('news') => 'Danh sách tin tức',
                    'javascript:;' => 'Cập nhật',
                    '#' => htmlspecialchars($detailnews_saxa_everyday['title'])),
            );
            $data = array(
                'title'         => $this->lang->line('NEWS_EDIT'),
                'language_type' => $this->_language,
                'detailnews_saxa_everyday'    => $detailnews_saxa_everyday,
                'news_id'       => $newsId,
                'listcategory'=> $this->msaxa_everyday->listAll(),
                'position'      => $this->config->item('position_news'),
            );
            $old_slug = $detailnews_saxa_everyday['slug'];
            
            if ($this->input->post()) {
                $error = array();
                $params = $this->input->post();
                $this->_validate($params, $erros);
                $params['news_id'] = $newsId;
                if(empty($error)) {
                    
                    // upload avatar
                    if (!empty($_FILES['avatar']['name'])) {
                        $checkUpload = $this->uploadPhoto($_FILES['avatar'], 'avatar', IMAGE_NEWS_PATH, TRUE, 1366, 768, $maxSize = 200000);
                        
                        if ($checkUpload) {
                            $params['avatar'] = $checkUpload; // Get logo name:
                            
                            $is_resize = $this->resizePhoto($checkUpload, 300, 300 , IMAGE_NEWS_PATH);
                            if ($is_resize != TRUE) { // not resize
                                $error[] = 'Không xử lý được file ảnh <br/> vui lòng kiểm tra lại';
                            } else {
                                unlink(IMAGE_NEWS_PATH.'/'.$old_avatar);
                            }
                        } else {
                            $error[] = 'File ảnh chưa được up <br/> vui lòng kiểm tra lại';
                        }

                    }
                    // Review upload new news:
                    if($this->input->post('is_review') && $this->input->post('avatar')) {
                        $filename = TEMP_PATH . trim($_POST['avatar']);
                        if(rename($filename, IMAGE_NEWS_PATH)){
                            if (file_exists($filename)) {
                                $fh = fopen($filename, "rb");
                                $imgData = fread($fh, filesize($filename));
                                fclose($fh);
                                // Remove temp file:
                                unlink($filename);
                            }
                        }
                    }
                
                    // check slug common    
                    if (empty($error)) {
                        if ($old_slug != $params['txtSlug']) {

                            if (!empty($params['txtSlug'])) {
                                $slug = slug_convert($params['txtSlug']);
                            } else if (!empty($params['name'])) {
                                $slug = slug_convert($param['name']);
                            } else if (!empty($params['txtTitle'])) {
                                $slug = slug_convert($params['txtTitle']);
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
                        if ($this->mnews_saxa_everyday->save($params)) {
                            if ($old_slug != $params['slug']) {
                                $this->mcommon->delete($old_slug);
                                $slug_insert = !empty($params['txtSlug']) ? slug_convert($params['txtSlug']) : slug_convert($params['txtTitle']);
                                $this->mcommon->createSlug($slug_insert, 'd_news_saxa_everyday', 'saxaeveryday');
                            }
                            redirect(base_url('news_saxa_everyday'));
                        }
                    }
                }
                $data['params'] = $params;
                $data['news_errors'] = $error;
            }
            
            $tpl["main_content"] = $this->load->view('news_saxa_everyday/edit', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        }
    }
    
    /**
     * Detail news
     * @param type $newsId
     */
    public function detail($newsId = '')
    {
        if (!empty($newsId) && filter_var($newsId, FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
            $detailnews_saxa_everyday = $this->mnews_saxa_everyday->detail($newsId);
            if (empty($detailnews_saxa_everyday)) {
                redirect(base_url('news'));
            }
            $tpl = array(
                'breadcrumb' => array(
                    base_url() => 'home',
                    base_url('news') => 'Danh sách tin tức',
                    'javascript:;' => htmlspecialchars($detailnews_saxa_everyday['title'])),
            );
            $data = array(
                'page_title' => $this->lang->line('NEWS_DETAIL'),
                'detailnews_saxa_everyday' => $detailnews_saxa_everyday,
                'news_id' => $newsId,
            );
            $tpl["main_content"] = $this->load->view('news_saxa_everyday/detail', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        }
    }
    
    /**
     * @author HoaHN<hoahn@vccvn.com>
     * @date 20150713
     * Review add news
     */
    public function review()
    {
        $data = array(
            'language_type' => $this->_language,
            'position'      => $this->config->item('position_news'),
        );
        $params = array();
        if($this->isPostMethod()) {
            $tpl = array(
                'breadcrumb' => array(
                    base_url() => 'home',
                    base_url('news') => 'Tin tức',
                    'javascript:;' => 'Xem trước'),
            );
            $params = $this->input->post();
            if(!empty($params['catnews_saxa_everyday'])) {
                $catnews_saxa_everydayId = (int)$params['catnews_saxa_everyday'];
                $data['catnews_saxa_everydayDetail'] =  $this->msaxa_everyday->getDetail($catnews_saxa_everydayId);
            }
            if(!empty($_FILES['avatar']) && $_FILES['avatar']['error'] == '0' ) {
                $checkUpload = $this->uploadPhoto($_FILES['avatar'], 'avatar', TEMP_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000);
                if ($checkUpload) {
                    $params['avatar'] = $checkUpload;
                }
            }
            $data['params'] = $params;
            $tpl["main_content"] = $this->load->view('news_saxa_everyday/review', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        } else {
            redirect(base_url('news'));
        }
    }
    
    /**
     * Delete news
     * @return type
     */
    public function delete()
    {
         if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])) {
             $id = (int)$_POST['id'];
            if ($this->mnews_saxa_everyday->del($id)) {
                $json_result = array(
                    'result' => 1,
                    'code'  => 202,
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
        $this->form_validation->set_rules("txtTitle","Nhập tiêu đề","required|trim|max_length[255]|callback__checkExistTitle");
        $this->form_validation->set_rules("description", 'Nhập mô tả', "required|trim|max_length[3000]");
        $this->form_validation->set_rules("content", 'Nhập nội dung ', "trim|required");
        $this->form_validation->set_rules("catnews_saxa_everyday", $this->lang->line('NEWS_CAT'),  "trim|integer|max_length[11]");
        $this->form_validation->set_rules("position", $this->lang->line('POSITION'),"trim");
        $this->form_validation->set_rules("language_type", $this->lang->line('CHOOSE_LANGUAGE'), "trim|max_length[255]");
        $this->form_validation->set_rules("txtKeySeo", $this->lang->line('KEYWORD_SEO'), "trim|max_length[255]");
        $this->form_validation->set_rules("txtDesSeo", $this->lang->line('DESCRIPTION_SEO'), "trim|max_length[255]");
         $this->form_validation->set_rules("txtSlug", $this->lang->line('MISSING_EMPTY_SLUG'), "trim|max_length[255]");
        // Set Message:
        $this->form_validation->set_message('required', '%s');
        //Validate
        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
        }
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/07/05
     * Check exist category name
     */
    public function _checkExistTitle()
    {
        if (empty($_POST['partners_id'])) {
            if ($this->mnews_saxa_everyday->checkExistTitle($_POST['txtTitle'])) {
                $this->form_validation->set_message('_checkExistTitle', 'Tiêu đề đã tồn tại');
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
}
