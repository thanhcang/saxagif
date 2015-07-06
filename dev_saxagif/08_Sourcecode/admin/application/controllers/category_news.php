<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/06/23
 * Screen category news management
 */
class Category_news extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->lang->load('category_news');
        
        // Load model:
        $this->load->model(array('mcategory_news'));
    }
    
    public function index()
    {
        $data = array(
            'page_title' => $this->lang->line(),
        );
        
        $tpl["main_content"] = $this->load->view('product/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    public function add()
    {
        $data = array(
            'page_title' => $this->lang->line(),
        );
        
        $tpl["main_content"] = $this->load->view('product/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    public function edit()
    {
        $data = array(
            'page_title' => $this->lang->line(),
        );
        
        $tpl["main_content"] = $this->load->view('product/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    public function detail()
    {
        $data = array(
            'page_title' => $this->lang->line(),
        );
        
        $tpl["main_content"] = $this->load->view('product/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
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
        $this->form_validation->set_rules("name", $this->lang->line('PRO_MISSING_EMPTY_NAME'), "required|trim|xss_clean|max_length[255]|callback__checkExistName");
        $this->form_validation->set_rules("slug", $this->lang->line('PRO_BOOK_LIMIT'), "required|trim|max_length[255]");
        $this->form_validation->set_rules("language_type", $this->lang->line('PRO_MISSING_PRICE_INVALID'), "required|trim|integer|max_length[1]");
        $this->form_validation->set_rules("keyword_seo", $this->lang->line('PRO_DESCRIPTION'),  "trim|max_length[255]");
        $this->form_validation->set_rules("des_seo", $this->lang->line('PRO_CONTENT'),"trim|max_length[255]");
       
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
    public function _checkExistName()
    {
        if (empty($_POST['category_news_id'])) {
            if ($this->mcategory_news->checkExistName($_POST['name'])) {
                $this->form_validation->set_message('_checkExistName', $this->lang->line('CAT_NEWS_MISSING_NAME_EXIST'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
}