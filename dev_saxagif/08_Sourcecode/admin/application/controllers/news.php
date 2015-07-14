<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/07/05
 * Screen product management
 */
class News extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->lang->load('news');
        
        // Load model:
        $this->load->model(array('mnews', 'mcategory_news'));
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
            'listAllCatNews'=> $this->mcategory_news->listAll(),
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
            'base_url'    => base_url('news/?' . $queryString),
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
        $data['list_news'] = $this->mnews->search($filter, $total_records, $offset, $page_config['per_page']);
        if(!empty($data['list_news'])){
            // Pagination
            $this->load->library('pagination');
            $page_config["total_rows"] = $total_records;
            $this->pagination->initialize($page_config);
            $data["pagination"] = $this->pagination->create_links();
        }
        $data['offset'] = $offset;
        $data['filter']=  $filter;
        
        $tpl["main_content"] = $this->load->view('news/index', $data, TRUE);
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
            'listAllCatNews'=> $this->mcategory_news->listAll(),
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
                
                $checkUpload = $this->uploadPhoto($_FILES['avatar'], 'avatar', TEMP_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000 );
                if ($checkUpload) {
                    // Get logo name:
                    $params['avatar'] = $checkUpload;
                    if ($this->resizePhoto($checkUpload, $width = IMAGE_WIDTH_300, $height = IMAGE_HEIGHT_300, TEMP_PATH, IMAGE_NEWS_PATH)) {
                        // Remove tmp file:
                        $tmpFile = TEMP_PATH . $checkUpload;
                        if (file_exists($tmpFile)) {
                            $fh = fopen($tmpFile, "rb");
                            $imgData = fread($fh, filesize($tmpFile));
                            fclose($fh);
                            unlink($tmpFile);
                        }
                    }    
                }
                if($this->mnews->save($params)) {
                    redirect(base_url('news'));
                }
            }
            $data['params'] = $params;
            $data['news_errors'] = $error;
        }
        
        $tpl["main_content"] = $this->load->view('news/add', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    /**
     * Edit news
     * @param type $newsId
     */
    public function edit($newsId = '')
    {
        if (!empty($newsId) && filter_var($newsId, FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
            $detailNews = $this->mnews->detail($newsId);
            if(empty($detailNews)) {
                redirect(base_url('news'));
            }
            $tpl = array(
                'breadcrumb' => array(
                    base_url() => 'home',
                    base_url('news') => 'Danh sách tin tức',
                    'javascript:;' => 'Cập nhật',
                    '#' => htmlspecialchars($detailNews['title'])),
            );
            $data = array(
                'title'         => $this->lang->line('NEWS_EDIT'),
                'language_type' => $this->_language,
                'detailNews'    => $detailNews,
                'news_id'       => $newsId,
                'listAllCatNews'=> $this->mcategory_news->listAll(),
                'position'      => $this->config->item('position_news'),
            );
            if ($this->input->post()) {
                $error = array();
                $params = $this->input->post();
                $this->_validate($params, $erros);
                $params['news_id'] = $newsId;
                if(empty($error)) {
                    
                    $checkUpload = $this->uploadPhoto($_FILES['avatar'], 'avatar', TEMP_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000 );
                    if ($checkUpload) {
                        // Get logo name:
                        $params['avatar'] = $checkUpload;
                        if ($this->resizePhoto($checkUpload, $width = IMAGE_WIDTH_300, $height = IMAGE_HEIGHT_300, TEMP_PATH, IMAGE_NEWS_PATH)) {
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
                        $detailNews = $this->mnews->detail($newsId);
                        if ($detailNews) {
                            if(!empty($detailCat['avatar'])) {
                                $imgFile = IMAGE_NEWS_PATH . $detailCat['avatar'];
                                if (file_exists($imgFile)) {
                                    $fh = fopen($imgFile, "rb");
                                    $imgData = fread($fh, filesize($imgFile));
                                    fclose($fh);
                                    unlink($imgFile);
                                }
                            }
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
                    if ($this->mnews->save($params)) {
                        redirect(base_url('news'));
                    }
                }
                $data['params'] = $params;
                $data['news_errors'] = $error;
            }
            $tpl["main_content"] = $this->load->view('news/edit', $data, TRUE);
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
            $detailNews = $this->mnews->detail($newsId);
            if (empty($detailNews)) {
                redirect(base_url('news'));
            }
            $tpl = array(
                'breadcrumb' => array(
                    base_url() => 'home',
                    base_url('news') => 'Danh sách tin tức',
                    'javascript:;' => htmlspecialchars($detailNews['title'])),
            );
            $data = array(
                'page_title' => $this->lang->line('NEWS_DETAIL'),
                'detailNews' => $detailNews,
                'news_id' => $newsId,
            );
            $tpl["main_content"] = $this->load->view('news/detail', $data, TRUE);
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
            if(!empty($params['catNews'])) {
                $catNewsId = (int)$params['catNews'];
                $data['catNewsDetail'] =  $this->mcategory_news->getDetail($catNewsId);
            }
            if(!empty($_FILES['avatar']) && $_FILES['avatar']['error'] == '0' ) {
                $checkUpload = $this->uploadPhoto($_FILES['avatar'], 'avatar', TEMP_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000);
                if ($checkUpload) {
                    $params['avatar'] = $checkUpload;
                }
            }
            $data['params'] = $params;
            $tpl["main_content"] = $this->load->view('news/review', $data, TRUE);
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
            if ($this->mnews->del($id)) {
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
        $this->form_validation->set_rules("txtTitle", $this->lang->line('NEWS_MISSING_TITLE_EMPTY'),"required|trim|max_length[255]|callback__checkExistTitle");
        $this->form_validation->set_rules("description", $this->lang->line('NEWS_DESCRIPTION'), "trim|max_length[3000]");
        $this->form_validation->set_rules("content", $this->lang->line('NEWS_CONTENT'), "trim|");
        $this->form_validation->set_rules("catNews", $this->lang->line('NEWS_CAT'),  "trim|integer|max_length[11]");
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
            if ($this->mnews->checkExistTitle($_POST['txtTitle'])) {
                $this->form_validation->set_message('_checkExistTitle', $this->lang->line('PAR_MISSING_EXIST_NAME'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
}

