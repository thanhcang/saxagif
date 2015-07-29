<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/06/22
 * Screen product management
 */
class Customer extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->lang->load('customer');
        
        // Load model:
        $this->load->model(array('mcustomer'));
    }
    
    public function index()
    {
        $data = array(
            'page_title' => 'SAXA Gifts - Quản lý danh mục',
            'typeCategory' => $this->config->item('typeCategory'),
            'language_type' => $this->config->item('language_type'),
        );
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'Home',
                base_url('customer') => 'Khách hàng'),
        );
        
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
        $data['listCustomer'] = $this->mcustomer->search($total_records, $offset, $page_config['per_page']);
        if (!empty($data['list_data'])) { // pagination
            $this->load->library('pagination');
            $page_config["total_rows"] = $total_records;
            $this->pagination->initialize($page_config);
            $data["pagination"] = $this->pagination->create_links();
        }
        
        $tpl["main_content"] = $this->load->view('customer/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    public function edit($cusId = '')
    {
        if(!empty($cusId) && filter_var($cusId, FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $error  = $params = array();
            $data = array(
                'page_title' => $this->lang->line('CUS_CREATE'),
                'detailCus' => $this->mcustomer->detail($cusId),
            );
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $params = $this->input->post();
                $this->_validate($params, $error);
                if (empty($error)) {
                    if (!empty($params['birthday'])) {
                        $params['birthday'] = convertDateFormat($params['birthday']);
                    }
                    if ($this->mcustomer->save($params)) {
                        redirect(base_url('customer'));
                    }
                }
                $data['params'] = $params;
                $data['cus_errors'] = $error;
            }

            $tpl["main_content"] = $this->load->view('customer/edit', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        } else {
            redirect(base_url('customer'));
        }
    }
    
    public function detail($cusId = '')
    {
        if(!empty($cusId) && filter_var($cusId, FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $data = array(
                'page_title' => $this->lang->line('CUS_DETAIL'),
                'detailCus' => $this->mcustomer->detail($cusId),
            );

            $tpl["main_content"] = $this->load->view('customer/index', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        } else {
            redirect(base_url('customer'));
        }
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
        $this->form_validation->set_rules("name", $this->lang->line('PRO_MISSING_EMPTY_NAME'), "required|trim|xss_clean|max_length[255]|callback__checkExistName");
        $this->form_validation->set_rules("email_address", $this->lang->line('PRO_MISSING_PRICE_INVALID'), "required|trim|valid_email|max_length[255]");
        $this->form_validation->set_rules("phone_number", $this->lang->line('PRO_DESCRIPTION'),  "trim|numeric|max_length[11]");
        $this->form_validation->set_rules("birthday", $this->lang->line('PRO_CONTENT'),"trim|callback__check_datetime");
        $this->form_validation->set_rules("sex", $this->lang->line('PRO_BOOK_LIMIT'), "integer|trim|max_length[1]");
        $this->form_validation->set_rules("address", $this->lang->line('PRO_DELIVERY_DAYS'), "trim|max_length[255]");
        $this->form_validation->set_rules("company_name", $this->lang->line('PRO_MISSING_CAT_EMPTY'), "trim|max_length[255]");
        
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
        if (empty($_POST['customer_id'])) {
            if ($this->mcustomer->checkExistName($_POST['name'])) {
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
     * Validate datetime
     * @return boolean
     */
    public function _check_datetime(){
        $pattern = "/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/";

        // Check time begin
        if(!empty($_POST['birthday'])){
            if (!preg_match($pattern, $_POST['birthday'])) {
                $this->form_validation->set_message('_check_datetime', $this->lang->line('CUS_MISSING_BIRTHDAY_INVALID'));
                return FALSE;
            }
        }
        return TRUE;
    }
    
}
