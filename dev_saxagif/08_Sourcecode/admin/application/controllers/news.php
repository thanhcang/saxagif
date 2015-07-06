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
        $this->load->model(array('mnews'));
    }
    
    public function index()
    {
        $params = array();
        $data = array(
            'page_title'    => $this->lang->line('PAR_TITLE'),
            'language_type' => $this->_language,
        );
        $data['list_news'] = $this->mnews->search();
        
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
        
        $tpl["main_content"] = $this->load->view('news/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    public function edit($newsId = '')
    {
        if (!empty($newsId) && filter_var($newsId, FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
            $data = array(
                'title' => $this->lang->line('NEWS_EDIT'),
                'language_type' => $this->_language,
                'detailNews' => $this->mnews->detail($newsId),
                'news_id' => $newsId,
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
                    if ($this->mnews->save($params)) {
                        redirect(base_url('news'));
                    }
                }
                $data['params'] = $params;
                $data['news_errors'] = $error;
            }
            //echo '<pre>';            print_r($data['detailNews']);exit;
            $tpl["main_content"] = $this->load->view('news/edit', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        }
    }
    
    public function detail($newsId = '')
    {
        if (!empty($newsId) && filter_var($newsId, FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
            $data = array(
                'page_title' => $this->lang->line('NEWS_DETAIL'),
                'detailNews' => $this->mnews->detail($newsId),
                'news_id' => $newsId,
            );
            $tpl["main_content"] = $this->load->view('news/detail', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        }
    }
    
    public function delete()
    {
        if($this->input->post('id')) {
            $newsId = base64_decode($_POST['id']);
            if ($this->mnews->del($newsId)) {
                echo '1';
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
        $this->form_validation->set_rules("description", $this->lang->line('NEWS_DESCRIPTION'), "trim|max_length[300]");
        $this->form_validation->set_rules("content", $this->lang->line('NEWS_CONTENT'), "trim|");
        $this->form_validation->set_rules("catNews", $this->lang->line('NEWS_CAT'),  "trim|integer|max_length[11]");
        $this->form_validation->set_rules("position", $this->lang->line('POSITION'),"trim");
        $this->form_validation->set_rules("language_type", $this->lang->line('CHOOSE_LANGUAGE'), "trim|max_length[255]");
        $this->form_validation->set_rules("txtKeySeo", $this->lang->line('KEYWORD_SEO'), "trim|max_length[255]");
        $this->form_validation->set_rules("txtDesSeo", $this->lang->line('DESCRIPTION_SEO'), "trim|max_length[255]");
         $this->form_validation->set_rules("txtSlug", $this->lang->line('MISSING_EMPTY_SLUG'), "required|trim|max_length[255]");
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

