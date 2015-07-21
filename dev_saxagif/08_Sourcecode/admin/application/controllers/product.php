<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/06/13
 * Screen product management
 */
class Product extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->lang->load('product');
        
        // Load model:
        $this->load->model(array('mcategory', 'mproduct'));
    }
    
    public function index()
    {
        $params = array();
        $error = array();
        
        if (!empty($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        
        $data = array(
            'page_title'    => $this->lang->line('PRO_TITLE'),
            'language_type' => $this->_language,
            'listCat'       => $this->mcategory->listAll(),
        );
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'Home',
                base_url('product') => 'Sản phẩm'),
        );
        
        // Config pagination:
        $parmameter_page = 'page';
        $queryString = $this->input->server('QUERY_STRING');
        //remove parameter page

        $queryString = preg_replace('/(\&|)page=[0-9]$/is', '', $queryString);
        $queryString = preg_replace('/(\&|)page=$/is', '', $queryString);
        
        $page_config = array(
            'base_url'    => base_url('product?' . $queryString),
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
        $data['listProduct'] = $this->mproduct->listAll($params, $total_records, $offset, $page_config['per_page']);
        if(!empty($data['listProduct'])){
            $this->load->library('pagination');
            // Pagination
            $page_config["total_rows"] = $total_records;
            $this->pagination->initialize($page_config);
            $data["pagination"] = $this->pagination->create_links();
        }
        
        // Add and edit product
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $params = $this->input->post();
            
            //echo '<pre>';            print_r($params);exit;
            $this->_validate($params, $error);
            //echo '<pre>';            print_r($error);exit;
            if (empty($error)) {
                
                // we retrieve the number of files that were uploaded
                $numberOfFiles = sizeof($_FILES['image']['tmp_name']);
                $files = $_FILES['image'];
                for($i = 0; $i < $numberOfFiles; $i++) {
                    if($_FILES['image']['error'][$i] != 0) {
                        $error[] = 'Could\'t upload the file(s)';
                    }
                    $_FILES['image']['name'] = $files['name'][$i];
                    $_FILES['image']['type'] = $files['type'][$i];
                    $_FILES['image']['tmp_name'] = $files['tmp_name'][$i];
                    $_FILES['image']['error'] = $files['error'][$i];
                    $_FILES['image']['size'] = $files['size'][$i];
                    $checkUpload = $this->uploadPhoto($_FILES['image'], 'image', IMAGE_PRODUCT_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000 );
                    if($checkUpload) {
                        // Create thumbnail image product:
                        $this->resizePhoto($checkUpload, $width = IMAGE_WIDTH_300, $height = IMAGE_HEIGHT_300, IMAGE_PRODUCT_PATH, IMAGE_THUMB_PRODUCT_PATH);
                        $params['name_image'][] = $checkUpload;
                    }
                }
                
                if ($this->mproduct->create($params)) {
                    $this->session->set_flashdata('msg-success', $this->lang->line('PRO_CREATE_SUCCESS'));
                    redirect(base_url('product'));
                }
            }
            
            $data['params'] = $params;
            $data['pro_errors'] = $error;
        }
        
        $tpl["main_content"] = $this->load->view('product/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    public function detail($proId = '')
    {
        if(!empty($proId) && filter_var($proId, FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $data = array(
                'page_title'    => $this->lang->line('PRO_TITLE_DETAIL'),
                'detailPro'     => $this->mproduct->detail($proId),
                'listCat'       => $this->mcategory->listAll(),
            );
            //echo '<pre>';            print_r($data['detailPro']);exit;
            
            $tpl["main_content"] = $this->load->view('product/detail', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        } else {
            redirect(base_url('product'));
        }
        
    }
    
    public function  delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])) {
            $proId = base64_decode($_POST['id']);
            if ($this->mproduct->delPro($proId)) {
                echo 1;
            } else {
                echo '';
            }
        } else {
            echo '';
        }
    }
    
    /**
     * 
     * @param type $param
     */
    public function add() {
        // init param
        $params = array();
        $data = array(
            'page_title'    => $this->lang->line('PRO_TITLE'),
            'language_type' => $this->_language,
            'listCat'       => $this->mcategory->listAll(),
            'typeCategory'  => $this->config->item('typeCategory'),
        );
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'Home',
                base_url('product') => 'Sản phẩm',
                'javascript:;' => 'Thêm mới',
                ),
        );
                
        // Add product
        if ($this->isPostMethod()){
            $params = $this->input->post();
            
            $this->_validate($params, $error);
            if (empty($error)) {
                // we retrieve the number of files that were uploaded
                $numberOfFiles = sizeof($_FILES['image']['tmp_name']);
                $files = $_FILES['image'];
                for($i = 0; $i < $numberOfFiles; $i++) {
                    $_FILES['image']['name'] = $files['name'][$i];
                    $_FILES['image']['type'] = $files['type'][$i];
                    $_FILES['image']['tmp_name'] = $files['tmp_name'][$i];
                    $_FILES['image']['error'] = $files['error'][$i];
                    $_FILES['image']['size'] = $files['size'][$i];
                    $checkUpload = $this->uploadPhoto($_FILES['image'], 'image', IMAGE_PRODUCT_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000 );
                    if (!$checkUpload){
                        $error[] = 'hình chưa được up, vui lòng kiểm tra lại';
                        break;
                    } else {
                        // Create thumbnail image product:
                        $this->resizePhoto($checkUpload, $width = IMAGE_WIDTH_300, $height = IMAGE_HEIGHT_300, IMAGE_PRODUCT_PATH, IMAGE_THUMB_PRODUCT_PATH);
                        $params['name_image'][] = $checkUpload;
                    }
                }
                
                // create product
                if ($this->mproduct->create($params)) {
                    redirect(base_url('product'));
                }
            }
            
            $data['params'] = $params;
            $data['pro_errors'] = $error;
        }
        
        $tpl["main_content"] = $this->load->view('product/new', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    /**
     * edit product
     * @param type $proId
     */
    public function edit($proId = '')
    {
        if (!empty($proId) && filter_var($proId, FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
            $data = array(
                'page_title' => $this->lang->line('PRO_EIDT'),
                'detailPro'     => $this->mproduct->detail($proId),
                'listCat'       => $this->mcategory->listAll(),
            );
            $tpl = array(
                'breadcrumb' => array(
                    base_url() => 'Home',
                    base_url('product') => 'Sản phẩm',
                    'javascript:;' => 'Thêm mới',
                ),
            );

            // Edit product
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $params = $this->input->post();
                //secho '<pre>';                print_r($params);exit;
                $this->_validate($params, $error);
                if (empty($error)) {
                    if (!empty($_FILES['image'])) {
                        // we retrieve the number of files that were uploaded
                        $numberOfFiles = sizeof($_FILES['image']['tmp_name']);
                        $files = $_FILES['image'];
                        for($i = 0; $i < $numberOfFiles; $i++) {
                            $_FILES['image']['name'] = $files['name'][$i];
                            $_FILES['image']['type'] = $files['type'][$i];
                            $_FILES['image']['tmp_name'] = $files['tmp_name'][$i];
                            $_FILES['image']['error'] = $files['error'][$i];
                            $_FILES['image']['size'] = $files['size'][$i];
                            $checkUpload = $this->uploadPhoto($_FILES['image'], 'image', IMAGE_PRODUCT_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000 );
                            if (!$checkUpload){
                                $error[] = 'hình chưa được upload.<br> vui lòng kiểm tra lại file hình';
                            } else
                            if($checkUpload) {
                                // Create thumbnail image product:
                                $this->resizePhoto($checkUpload,IMAGE_WIDTH_300,IMAGE_HEIGHT_300, IMAGE_PRODUCT_PATH, IMAGE_THUMB_PRODUCT_PATH);
                                $params['name_image'][] = $checkUpload;
                            }
                        }
                    }
                    
                    if ($this->mproduct->create($params)) {
                        $this->session->set_flashdata('msg-success', $this->lang->line('PRO_EDIT_SUCCESS'));
                        redirect(base_url('product'));
                    }
                    
                }
                
                $data['params'] = $params;
                $data['pro_errors'] = $error;
            }

            $tpl["main_content"] = $this->load->view('product/edit', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
            
        } else {
            redirect(base_url('product'));
        }
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @param type $data
     * Show auto giftset
     */
    public function showAutoGiftset()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['proCode']) ) {
            $proCode = trim($_POST['proCode']);
            $result = $this->mproduct->listPromotion($proCode);
            //echo '<pre>';            print_r($result);exit
            if($result) {
                die(json_encode($result));
            } else {
                die();
            }
        } else {
            return;
        }
    }
    
    private function _validate(&$data, &$errors) {
        //Trim
        foreach ($data as $k => $item) {
            if (is_string($item)) {
                $data[$k] = trim(htmlspecialchars($item));
            }
        }
        //Load
        $this->load->library('form_validation');

        // Set rules:
        $this->form_validation->set_rules("product_code", $this->lang->line('PRO_MISSING_CODE_EMPTY'),"required|trim|xss_clean|max_length[255]|callback__checkExistCode");
        $this->form_validation->set_rules("name", $this->lang->line('PRO_MISSING_EMPTY_NAME'), "required|trim|xss_clean|max_length[255]|callback__checkExistName");
        $this->form_validation->set_rules("price", $this->lang->line('PRO_MISSING_PRICE_INVALID'), "trim");
        $this->form_validation->set_rules("description", $this->lang->line('PRO_DESCRIPTION'),  "trim|xss_clean");
        $this->form_validation->set_rules("content", $this->lang->line('PRO_CONTENT'),"trim|xss_clean");
        $this->form_validation->set_rules("book_limit", $this->lang->line('PRO_BOOK_LIMIT'), "trim|xss_clean");
        $this->form_validation->set_rules("delivery_days", $this->lang->line('PRO_DELIVERY_DAYS'), "trim|max_length[255]");
//        $this->form_validation->set_rules("cat_id", $this->lang->line('PRO_MISSING_CAT_EMPTY'), "required|trim|max_length[11]|integer");
        $this->form_validation->set_rules("language_type", $this->lang->line('CHOOSE_LANGUAGE'), "integer|trim|xss_clean|max_length[2]");
        $this->form_validation->set_rules("keyword_seo", $this->lang->line('PRO_KEYWORD_SEO'), "trim|max_length[255]");
        $this->form_validation->set_rules("des_seo", $this->lang->line('PRO_DES_SEO'), "trim|max_length[255]");
        $this->form_validation->set_rules("slug", $this->lang->line('PRO_MISSING_SLUG_EMPTY'), "trim|max_length[255]|callback__checkExistSlug");
        $this->form_validation->set_rules("pro_distribution", $this->lang->line('PRO_DISTRIBUTION'), "trim|max_length[255]");
        $this->form_validation->set_rules("promotion", $this->lang->line('PRO_MISSING_PROMOTION_INVALID'), "trim|max_length[1]|min_length[1]|integer");
        $this->form_validation->set_rules("type", 'Chọn loại danh mục', "required|trim");
        $this->form_validation->set_rules("catname", 'Chọn danh mục', "required|trim");
        
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
     * Check exist product name
     */
    public function _checkExistCode()
    {
        if (empty($_POST['product_id'])) {
            if ($this->mproduct->checkExistCode($_POST['product_code'])) {
                $this->form_validation->set_message('_checkExistCode', $this->lang->line('PRO_MISSING_CODE_EXIST'));
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
     * Check exist product name
     */
    public function _checkExistName()
    {
        if (empty($_POST['product_id'])) {
            if ($this->mcategory->checkExistName($_POST['name'])) {
                $this->form_validation->set_message('_checkExistName', $this->lang->line('PRO_MISSING_NAME_EXIST'));
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
     * Check exist product slug
     */
    public function _checkExistSlug()
    {
        if (empty($_POST['category_id'])) {
            if ($this->mcategory->checkExistSlug($_POST['slug'])) {
                $this->form_validation->set_message('_checkExistSlug', $this->lang->line('PRO_MISSING_SLUG_EXIST'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
    
}

