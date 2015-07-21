<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    private $_request_params;
    private $_ajax = false;
    protected $_language = array();
    public function __construct()
    {
        parent::__construct();
        //check ajax request?
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->_ajax = true;
        }

        $this->init();
        $this->_language = $this->config->item('language_type');
        $this->lang->load('common');
        $this->session->set_userdata('ses_user_id', 1);
    }

    private function init()
    {
        $this->set_request();
    }

    public function get_request()
    {
        return $this->request_params;
    }

    private function set_request()
    {
        $get_params = array();

        $get_params = $this->input->post();
        if ( ! $get_params) {
            $get_params = $this->input->get();
        }

        $this->request_params = $get_params;
    }
    
    public function isPostMethod() {
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ){
            return TRUE;
        }
        return FALSE;
    }
    
    /**
     * Check user has logged-in or not
     * @return boolean
     */
    function is_logged_in() {
        $session_data = $this->session->all_userdata();
        if (empty($session_data['username'])) {
            // Not logged-in
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * set session user
     * @param type $data
     */
    function set_login($data) {
        $session_data = array(
            'user_id'      => $data['id'],
            'username'      => $data['username'],
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'level'         => $data['level'],
            'available_time'=> $data['available_time'],
        );
        $this->session->set_userdata($session_data);
    }
 
    /**
     * Auto redirect to login page if not logged-in
     */
    function check_login() {
        if (!$this->is_logged_in()) {
            redirect(base_url('login'));
        }
    }
    
    /**
     * Send mail
     * @param string $to
     * @param string $subject
     * @param string $message
     * @param string $bcc
     * @return boolean
     */
    function send_mail($to, $subject, $message, $bcc = '') {
        try {
            /*
              // User SMTP
              $config = config_item('send_mail');
              $this->load->library('email', $config);
              $this->email->from($config['smtp_user']);
             */

            // User mailserver
            $this->load->library('email');
            $this->email->from(CONTACT_MAIL);
            $this->email->set_newline("\r\n");
            $this->email->to($to);
            if (!empty($bcc)) {
                $this->email->bcc($bcc);
            }
            $this->email->subject($subject);
            $this->email->message($message);
            if ($this->email->send() == FALSE) {
                throw new Exception;
            }
            return TRUE;
        } catch (Exception $ex) {
            return $ex->print_debugger();
        }
    }
    
    /**
     * get teamplate mail
     * @param type $temp
     * @return boolean
     */
    public function getTeamplateMail($temp) {
        $filename = COMMON_PATH . 'temp/'.$temp.'.txt';
        $template = '';
        if (is_file($filename)) {
            try {
                $template = file_get_contents($filename);
            } catch (Exception $ex) {
                $template = '';
            }
        }
        if ($template) {
            $template = mb_ereg_replace('(\r)', "\n", $template);
            $template = mb_ereg_replace('(\n\n)', "\n", $template);
            $pos = mb_strpos($template, "\n");
            $subject = mb_substr($template, 0, $pos);
            $body = mb_substr($template, $pos + 1);
            $data['subject'] = $subject;
            $data['body'] = $body;
            return $data;
        }
        return FALSE;
    }
	
	/**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/13
     * Upload photo
     */
    
    public function uploadPhoto($file, $name,$uploadPath = IMAGE_PATH, $isImage = TRUE, $maxWidth = '', $maxHeight = '', $maxSize = '')
    {
        $config = array();
        
        if (empty($file) || empty($name) ) {
            return;
        }
        
        $config['upload_path'] = $uploadPath;
        if ($isImage) {
            $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp|tiff|raw';
//            $fileTmpName = explode('.',$file['name']);
//            $fileName = $this->rd_letter().'.'.end($fileTmpName);
//            $config['file_name'] = $fileName;
        } else {
            $config['allowed_types'] = '*';
        }
        if ($maxWidth) {
            $config['max_width'] = $maxWidth;
        }
        if ($maxHeight) {
            $config['max_height'] = $maxHeight;
        }
        if ($maxSize) {
            $config['max_size'] = $maxSize;
        }
        
//        $config['overwrite'] = TRUE;
        
        $this->load->library('upload');
        $this->upload->initialize($config);
        $is_upload = $this->upload->do_upload($name);
        if(!$is_upload) {
            return FALSE;
        } else {
            $upload_logo = $this->upload->data();
            return $upload_logo['file_name'];
        }
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @param type $name
     * @param type $width
     * @param type $height
     * @param type $imgPath
     * @param type $imgThumb
     * Resize photo
     */
    public function resizePhoto($name, $width, $height, $imgPath = IMAGE_PATH, $imgPathThumb = '')
    {
        // Get size image upload
        $sizeImage = getimagesize($imgPath . $name);
        $widthImageCurrent = $sizeImage[0];
        $heightImageCurrent = $sizeImage[1];
        // Set resize image
        if ($widthImageCurrent > $width) {
            $widthImage = $width;
            $heightImage = ($width / $widthImageCurrent) * $heightImageCurrent;
        } elseif ($heightImageCurrent > $height) {
            $heightImage = $height;
            $widthImage = ($height / $heightImageCurrent) * $widthImageCurrent;
        } else {
            $widthImage = $widthImageCurrent;
            $heightImage = $heightImageCurrent;
        }
        try {
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = $imgPath . $name;
            //$config['create_thumb'] = TRUE;
            //$config['maintain_ratio'] = TRUE;
            $config['width'] = $widthImage;
            $config['height'] = $heightImage;
            if ($imgPathThumb) {
                $config['create_thumb'] = TRUE;
                $config['new_image'] = $imgPathThumb;
            }
            $config['quality'] = 100;
            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            if ( ! $this->image_lib->resize()) {
                throw new Exception($this->image_lib->display_errors());
            }           
            return TRUE;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    /**
     * @hnguyen0110@gmail.com
     * @date 2015/06/20
     * Wartermarking Photo
     */
    public function watermarkingPhoto($path, $imageName, $size = 16, $color = '000000', $vrt_align = 'bottom', $hor_align = 'right', $padding = 50) {
        $config['source_image']	= $path . $imageName;
        $config['wm_text'] = SITE_NAME;
        $config['wm_type'] = 'text';
        $config['wm_font_path'] = './system/fonts/texb.ttf';
        $config['wm_font_size']	= $size;
        $config['wm_font_color'] = $color;
        $config['wm_vrt_alignment'] = $vrt_align;
        $config['wm_hor_alignment'] = $hor_align;
        $config['wm_padding'] = $padding;

        $this->image_lib->initialize($config); 

        $this->image_lib->watermark();
    }

    private function rd_letter()
    {
        return date('YmdHis') . '_' . chr(97 + mt_rand(0, 25));
    }

}