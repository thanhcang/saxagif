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
        $params = array();
        $data = array(
            'page_title'    => $this->lang->line('PAR_TITLE'),
            'language_type' => $this->_language,
        );
        $data['list_partners'] = $this->mpartners->listAll();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = array();
            $params = $this->input->post();
            
            // Check validation input
            $this->_validate($params, $error);
            //echo '<pre>';            print_r($_FILES['logo']);exit;
            if (empty($error)) {
                
                $checkUpload = $this->uploadPhoto($_FILES['logo'], 'logo', TEMP_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000 );
                if ($checkUpload) {
                    // Get logo name:
                    $params['logo'] = $checkUpload;
                    if ($this->resizePhoto($checkUpload, $width = IMAGE_WIDTH_300, $height = IMAGE_HEIGHT_300, TEMP_PATH, IMAGE_PARTNERS_PATH)) {
                        // Add watermarking photo:
                        //$this->watermarkingPhoto(IMAGE_CATEGORY_PATH, $checkUpload);
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
                
                if ($this->mpartners->save($params)) {
                    $this->session->set_flashdata('msg-success', $this->lang->line('PAR_ADD_SUCCESS'));
                    redirect(base_url('partners'));
                }
            }
            $data['params'] = $params;
            $data['par_errors'] = $error;
            
        }
        
        $tpl["main_content"] = $this->load->view('partners/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    public function detail($id = '')
    {
        if (!empty($id) && filter_var($id, FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
            $data = array(
                'page_title' => $this->lang->line('PAR_EDIT'),
                'detailPar'  => $this->mpartners->detail($id),   
            );
            

            $tpl["main_content"] = $this->load->view('partners/detail', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        } else {
            redirect(base_url('partners'));
        }
    }
    
    public function edit($id = '')
    {
         if (!empty($id) && filter_var($id, FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
            $data = array(
                'page_title' => $this->lang->line('PAR_DETAIL'),
                'detailPar'  => $this->mpartners->detail($id),
                'language_type' => $this->_language,
            );
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $error = array();
                $params = $this->input->post();
                
                // Check validation input
                $this->_validate($params, $error);
                //echo '<pre>';            print_r($error);exit;
                if (empty($error)) {

                    $checkUpload = $this->uploadPhoto($_FILES['logo'], 'logo', TEMP_PATH, TRUE, $maxWidth = 1366, $maxHeight = 768, $maxSize = 200000 );
                    if ($checkUpload) {
                        // Get logo name:
                        $params['logo'] = $checkUpload;
                        if ($this->resizePhoto($checkUpload, $width = IMAGE_WIDTH_300, $height = IMAGE_HEIGHT_300, TEMP_PATH, IMAGE_PARTNERS_PATH)) {
                            // Add watermarking photo:
                            //$this->watermarkingPhoto(IMAGE_CATEGORY_PATH, $checkUpload);
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

                    if ($this->mpartners->save($params)) {
                        //echo 1;exit;
                        $this->session->set_flashdata('msg-success', $this->lang->line('PAR_EDIT_SUCCESS'));
                        redirect(base_url('partners'));
                    }
                }
                $data['params'] = $params;
                $data['par_errors'] = $error;

            }

            $tpl["main_content"] = $this->load->view('partners/edit', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        } else {
            redirect(base_url('partners'));
        }
    }
    
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])) {
            $par_id = base64_decode($_POST['id']);
            if ($this->mpartners->delete($par_id)) {
                echo 1;
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
        $this->form_validation->set_rules("name", $this->lang->line('PAR_MISSING_NAME_EMPTY'),"required|trim|max_length[255]|callback__checkExistName");
        $this->form_validation->set_rules("address", $this->lang->line('ADDRESS'), "trim|max_length[255]");
        $this->form_validation->set_rules("email", $this->lang->line('EMAIL_INVALID'), "trim|valid_email");
        $this->form_validation->set_rules("phone", $this->lang->line('PHONE'),  "trim|integer|max_length[20]");
        $this->form_validation->set_rules("logo", $this->lang->line('LOGO'),"trim|max_length[255]");
        $this->form_validation->set_rules("url", $this->lang->line('URL'), "trim|max_length[255]");
        $this->form_validation->set_rules("note", $this->lang->line('NOTE'), "trim|max_length[300]");
        $this->form_validation->set_rules("language_type", $this->lang->line('LANGUAGE_MISSING_EMPTY'), "required|integer|trim|max_length[2]");
        
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
     * Check exist category name
     */
    public function _checkExistName()
    {
        if (empty($_POST['partners_id'])) {
            if ($this->mpartners->checkExistName($_POST['name'])) {
                $this->form_validation->set_message('_checkExistName', $this->lang->line('PAR_MISSING_EXIST_NAME'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
}
