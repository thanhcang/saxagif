<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management contact
 */
class Contact extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('contact_model'));
        $this->lang->load('contact');
    }
    
    public function index()
    {
        $this->render('contact/index_view');
    }
    
    
    
    /**
     * validate form
     * @param type $data
     * @param type $errors
     */
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
        $this->form_validation->set_rules("cus_name", $this->lang->line('ct_missing_empty_name'), "required|trim|max_length[255]");
        $this->form_validation->set_rules("cus_email", $this->lang->line('ct_missing_empty_email'), "required|trim|max_length[255]|valid_email|callback__checkExistEmail");
        $this->form_validation->set_rules("cus_phone", $this->lang->line('ct_missing_phone_invalid'), "trim|integer|max_length[11]");
        $this->form_validation->set_rules("cus_company", $this->lang->line('ct_missing_company_invalid'), "trim|max_length[255]");
        $this->form_validation->set_rules("cus_feeback", $this->lang->line('ct_missing_feeback_invalid'), "trim|max_length[255]");
        // Set Message:
        $this->form_validation->set_message('required', '%s');
        $this->form_validation->set_message('valid_email', '%s');
        $this->form_validation->set_message('max_length', '%s');
        //Validate
        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
        }
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/14
     * Check exist category name
     */
    public function _checkExistEmail() {
        if ($this->contact_model->checkExistEmail($_POST['cus_email'])) {
            $this->form_validation->set_message('_checkExistEmail', $this->lang->line('ct_missing_email_exist'));
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    /**
     * add customer
     * @param type $param
     */
    public function addCustomer() {
        if ($this->input->post()) {
            $params = $this->input->post();
            
            $this->contact_model->save($params);
            
            echo 'okie';
        }
    }

}
    