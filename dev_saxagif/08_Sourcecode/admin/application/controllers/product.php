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
    }
    
    public function index()
    {
        $data = array(
            'page_title' => $this->lang->line('PRO_TITLE'),
            
        );
        
        // Add and edit product
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
        }
        
        
        $tpl["main_content"] = $this->load->view('product/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    public function detail($proId = '')
    {
        
    }
    
    public function  delete()
    {
        
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
        //Validate
        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
        }
    }
}

