<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class MY_Controller extends CI_Controller
{
    protected $data = array();
    protected $langs = array();
            
    function __construct()
    {
        parent::__construct();
        
        // Set language:
        if ($this->session->userdata('ses_language')) {
            $this->langs = $this->session->userdata('ses_language');
        } else {
            $this->langs = LANG_VN;
        }
        $language = $this->langs;
        $this->data['language'] = $language;
        $this->settingLanguage($language);
        
        $this->data['page_title'] = 'Saxagifts';
        
        $this->data['cat_menu'] = $this->category_model->getCategoryByType($type = IS_CATEGORY);
        //Get Category Product:
        $this->data['cat_product'] = $this->category_model->getCategoryProduct();
        // Get news category show position page:
        $this->data['news_cat_position'] = $this->category_news_model->getCatNewsShowPage($lang = LANG_VN);
        // Show setting footet
        $this->data['setting_footer'] = $this->home_model->getSettingFooter($lang = LANG_VN);
        // Get gift saxa:
        $this->data['list_gift'] = $this->home_model->getGift();
        
        $this->lang->load('common');
        
        // Get class and method controllers:
        $this->data['class'] = $this->router->class;
        $this->data['method'] = $this->router->method;

        
    }
 
    protected function render($the_view = NULL, $template = 'master')
    {
        if($template == 'json' || $this->input->is_ajax_request())
        {
          header('Content-Type: application/json');
          echo json_encode($this->data);
        }
        elseif(is_null($template))
        {
          $this->load->view($the_view,$this->data);
        }
        else
        {
          $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view,$this->data, TRUE);;
          $this->load->view('templates/'.$template.'_view', $this->data);
        }
    }
    
    // setting language

    public function settingLanguage($language)
    {
        $lang_default = '';
        switch ($language) {
            case LANG_EN:
                $lang_default = 'english';
                break;
            default :
                $lang_default = 'vietnam';
                break;
        }
        //Load lang files
        $this->lang->load('common', $lang_default);
        $this->lang->load('contact', $lang_default);
    }
}