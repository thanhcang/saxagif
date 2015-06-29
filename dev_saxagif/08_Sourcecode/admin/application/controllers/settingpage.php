<?php

/**
 * @author vtcanglt@gmail.com
 * @date 20152306
 * Management Login
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settingpage extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('msetting'));
        $this->load->helper(array('setting'));
        //$this->lang->load('login');
    }

    /**
     *  show view page setting
     */
    public function index() {
        $data = array();
        $tpl = array(
            'breadcrumb' => array(base_url('home') => 'home',
                base_url('settingpage') => 'cài đặt chung'),
        );
        // update infomation company
        if ($this->isPostMethod()) {
            $error = array();
            $path = array();
            $input = $this->input->post();
            $this->_checkImageIsAccept($input, $error, 'shortcut', $path);
            $this->_checkImageIsAccept($input, $error, 'logo', $path);
            if (empty($error)) { 
                $input['shortcut'] = !empty($path['full_path_shortcut']) ? createBinaryFile($path['full_path_shortcut']) : '';
                $input['logo'] = !empty($path['full_path_logo']) ? createBinaryFile($path['full_path_logo']) : '';
                $is_update = $this->msetting->update($input);
                if ($is_update == FALSE) { // update fail
                    $data['is_update_fail'] = ' Quá trình cập nhật có sự cố, vui lòng kiểm tra lại';
                }
            } else { // error form
                $data['error'] = $error;
            }
        }
        $setting = $this->msetting->selectCompanyInfo();
        $data['deault_setting'] = defaultInfoCompany();
        $data['list'] = $setting;
        $tpl["main_content"] = $this->load->view('setting/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }

    /**
     * 
     * @param array $data
     * @param array $errors
     */
    private function _validateForm(&$data, &$errors) {
        //Trim
        foreach ($data as $k => $item) {
            if (is_string($item)) {
                $data[$k] = trim($item);
            }
        }
        //Load
        $this->load->library('form_validation');
        // Set rules:
        $this->form_validation->set_rules("log", $this->lang->line('CAT_MISSING_EMPTY_NAME'), "required|trim|xss_clean|max_length[255]|callback__checkExistName");
        $this->form_validation->set_rules("image", $this->lang->line('MISSING_EMPTY_SLUG'), "required|trim|max_length[255]|callback__checkExistSlug");
        // Set Message:
        $this->form_validation->set_message('required', '%s');
        //Validate
        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
        }
    }

    /**
     * 
     * @param array $data
     * @param array $error
     * @param string $option ( logo || image )
     * @return boolean
     */
    public function _checkImageIsAccept($data, &$error, $option, &$path) {
        $this->load->library('upload');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = CONST_MAXBYTE_IMAGE;
        $config['upload_path'] = TEMP_PATH;
        if ($option == 'logo' && !empty ($_FILES[$option]['name'])) {
            $config['max_width'] = CONST_MAXWIDTH_LOGO;
            $config['max_height'] = CONST_MAXHEIGHT_LOGO;
            $this->upload->initialize($config);
            $upload = $this->upload->do_upload('logo');
            if ($upload) {
                $data = $this->upload->data();
                $path['full_path_logo'] = $data['full_path'];
            } else {
                $error['error_logo'] = 'Vui lòng chọn logo và có kích thước nhỏ hơn 1336x768';
            }
        } else if ($option == 'shortcut' && !empty ($_FILES[$option]['name'])) {
            $config['max_width'] = CONST_MAXWIDTH_SHORTCUT;
            $config['max_height'] = CONST_MAXHEIGHT_SHORTCUT;
            $this->upload->initialize($config);
            $upload = $this->upload->do_upload('shortcut');
            if ($upload) {
                $data = $this->upload->data();
                $path['full_path_shortcut'] = $data['full_path'];
            } else {
                $error['error_shortcut'] = 'Vui lòng chọn shortcut và có kích thước 32x32';
            }
        } else {
            // nothing
        }
        return TRUE;
    }

}
