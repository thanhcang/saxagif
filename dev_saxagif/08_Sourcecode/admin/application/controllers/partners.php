<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/06/15
 * Screen partners management
 */
class Partners extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->lang->load('partners');
        
        // Load model:
        $this->load->model(array('mpartners'));
    }
    
    public function index()
    {
        $data = array();
        $params = array();
        
        $tpl["main_content"] = $this->load->view('product/detail', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    public function detail($id = '')
    {
        $data = array();
        
        $tpl["main_content"] = $this->load->view('product/detail', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    public function delete()
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
        $this->form_validation->set_rules("product_code", $this->lang->line('PRO_MISSING_CODE_EMPTY'),"required|trim|xss_clean|max_length[255]|callback__checkExistCode");
        $this->form_validation->set_rules("name", $this->lang->line('PRO_MISSING_EMPTY_NAME'), "required|trim|xss_clean|max_length[255]|callback__checkExistName");
        $this->form_validation->set_rules("price", $this->lang->line('PRO_MISSING_PRICE_INVALID'), "trim|numeric");
        $this->form_validation->set_rules("description", $this->lang->line('PRO_DESCRIPTION'),  "trim|xss_clean");
        $this->form_validation->set_rules("content", $this->lang->line('PRO_CONTENT'),"trim|xss_clean");
        $this->form_validation->set_rules("book_limit", $this->lang->line('PRO_BOOK_LIMIT'), "integer|trim|xss_clean|max_length[11]");
        
        // Set Message:
        $this->form_validation->set_message('required', '%s');
        //Validate
        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
        }
    }
}
