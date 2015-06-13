<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/06/07
 * Management category
 */
class Category extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mcategory');
        $this->lang->load('category');
        $this->load->library('upload');
        
    }
    
    public function index()
    {
        if (!empty($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $data = array(
            'language_type' => $this->_language,
        );
        $params = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $params = $this->input->get();
        }
        $data['params'] = $params;
        // Config pagination:
        $parmameter_page = 'page';
        $queryString = $this->input->server('QUERY_STRING');
        //remove parameter page

        $queryString = preg_replace('/(\&|)page=[0-9]$/is', '', $queryString);
        $queryString = preg_replace('/(\&|)page=$/is', '', $queryString);
        
        $page_config = array(
            'base_url'    => base_url('category/?' . $queryString),
            'per_page'    => NUMBER_PAGE,
            'use_page_numbers' => TRUE,
            'page_query_string' => TRUE,
            'query_string_segment' => $parmameter_page,
            'next_link'   => 'Next',
            'prev_link'   => 'Pre',
            'first_link'  => 'First',
            'last_link'   => 'Last',
            'full_tag_open' => '<ul class="pagination">',
            'full_tag_close' => '</ul>',
        );
        
        $offset = max(($page - 1), 0) * $page_config['per_page'];
        $total_records = 0;
        $data['list_data'] = $this->mcategory->search($params, $total_records, $offset, $page_config['per_page']);
        if(!empty($data['list_data'])){
            // Pagination
            $page_config["total_rows"] = $total_records;
            $this->pagination->initialize($page_config);
            $data["pagination"] = $this->pagination->create_links();
        }
        
        /**
         * Insert category
         */
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = array();
            $params = $this->input->post();
            if(!empty($_FILES['logo'])) {
                //echo '<pre>';                print_r($_FILES['logo']);
                $config_upload = array(
                    'upload_path'   => './common/multidata/cat_logo/',
                    'allowed_types' => 'png|jpg|jpeg|gif|bmp|tiff|raw',
                    'max_size'      => 192600,
                    'max_width'     => 1450,
                    'max_height'    => 1400,
                    'overwrite'     => TRUE,
                    'file_name'     => date('His').'_logo.png',
                );
                
                $this->upload->initialize($config_upload);
                if(!$this->upload->do_upload('logo')) {
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
        //echo '<pre>';        print_r($data['list_data']);exit;
        $tpl["main_content"] = $this->load->view('category/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    public function create()
    {
        $data = array(
            'page_title' => $this->lang->line('CAT_TITLE_CREATE'),
            'language_type' => $this->_language,
            'parent' => $this->mcategory->listParent(),
        );
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = array();
            $params = $this->input->post();
            if(!empty($_FILES['logo'])) {
                //echo '<pre>';                print_r($_FILES['logo']);
                $config_upload = array(
                    'upload_path'   => './common/multidata/cat_logo/',
                    'allowed_types' => 'png|jpg|jpeg|gif|bmp|tiff|raw',
                    'max_size'      => 192600,
                    'max_width'     => 1450,
                    'max_height'    => 1400,
                    'overwrite'     => TRUE,
                    'file_name'     => date('His').'_logo.png',
                );
                
                $this->upload->initialize($config_upload);
                if(!$this->upload->do_upload('logo')) {
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
    
    public function edit($cat_id = '')
    {
        $cat_id = (int)$cat_id;
        if (empty($cat_id)) {
            redirect(base_url('category/create'));
        }
        $detail_cat = $this->mcategory->getDetail($cat_id);
        $data = array(
            'page_title' => $this->lang->line('CAT_TITLE_EDIT'),
            'language_type' => $this->_language,
            'parent' => $this->mcategory->listParent(),
        );
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = array();
            $params = $this->input->post();
            if(!empty($_FILES['logo'])) {
                //echo '<pre>';                print_r($_FILES['logo']);
                $config_upload = array(
                    'upload_path'   => './common/multidata/cat_logo/',
                    'allowed_types' => 'png|jpg|jpeg|gif|bmp|tiff|raw',
                    'max_size'      => 192600,
                    'max_width'     => 1450,
                    'max_height'    => 1400,
                    'overwrite'     => TRUE,
                    'file_name'     => date('His').'_logo.png',
                );
                
                $this->upload->initialize($config_upload);
                if(!$this->upload->do_upload('logo')) {
                    //$error[] = $this->lang->line('CAT_MISSING_UPLOAD_ERR');
                } else {
                    if(!empty($detail_cat['logo'])) {
                        $imgFile = COMMON_PATH . 'multidata/cat_logo/' . $detail_cat['logo'];
                        $fh = fopen($imgFile, "rb");
                        $imgData = fread($fh, filesize($imgFile));
                        fclose($fh);
                        unlink($imgFile);
                    }
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
        $data['detail_cat'] = $detail_cat;
        //echo '<pre>';        print_r($data['detail_cat']);exit;
        $tpl["main_content"] = $this->load->view('category/edit', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    public function detail($cat_id = '')
    {
        if(!empty($cat_id) && filter_var($cat_id, FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $data = array(
                'page_title'    => $this->lang->line('CAT_DETAIL'),
                'catDetail'     => $this->mcategory->getDetail($cat_id, $parent = TRUE),
            );
            $tpl["main_content"] = $this->load->view('category/detail', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
            
        } else {
            redirect(base_url('category'));
        }
    }
    
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])) {
            $cat_id = base64_decode($_POST['id']);
            if ($this->mcategory->delCat($cat_id)) {
                echo 1;
            } else {
                echo '';
            }
        } else {
            echo '';
        }
    }
    
    public function editCat()
    {
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
        $this->form_validation->set_rules("name", $this->lang->line('CAT_MISSING_EMPTY_NAME'),  "required|trim|xss_clean");
        $this->form_validation->set_rules("bg_color", $this->lang->line('CAT_MISSING_INVALID_BG_COLOR'),"trim|xss_clean");
        $this->form_validation->set_rules("language_type", 'Language type', "integer|trim|xss_clean");
        $this->form_validation->set_rules("parent", 'Parent', "trim|integer");
        $this->form_validation->set_rules("keyword_seo", 'Keyword seo', "trim|max_length[255]");
        $this->form_validation->set_rules("des_seo", 'Description seo', "trim|max_length[255]");

        // Set Message:
        $this->form_validation->set_message('required', '%s');
//        $this->form_validation->set_message('min_length', '%s');
        //Validate
        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
        }
    }
    
}


