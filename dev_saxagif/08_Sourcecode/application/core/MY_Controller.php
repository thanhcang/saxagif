<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class MY_Controller extends CI_Controller
{
    protected $data = array();
    protected $langs = array();
    private $_ajax = false;
    var $_className = array();
    public $subfix_layout = '';
            
    function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
        //check ajax request?
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->_ajax = true;
        }
        // Set language:
        if ($this->session->userdata('ses_language')) {
            $this->langs = $this->session->userdata('ses_language');
        } else {
            $this->langs = LANG_VN;
        }
        //$this->langs = LANG_VN;
        $language = $this->langs;
        $this->data['language'] = $language;
        $this->settingLanguage($language);
        
        $this->data['page_title'] = 'Saxagifts';
        
        $this->data['cat_menu'] = $this->category_model->getCategoryByType($type = IS_CATEGORY);
        //Get Category Product:
        $this->data['cat_product'] = $this->category_model->getCategoryProduct();
        // Get news category show position page:
        $this->data['news_cat_position'] = $this->category_news_model->getCatNewsShowPage($lang = LANG_VN);
        // Show setting footer
        $this->data['setting_footer'] = $this->home_model->getSettingFooter($lang = LANG_VN);
        // Get gift saxa:
        $this->data['list_gift'] = $this->home_model->getGift();
        
        $this->lang->load('common');
        
        // Get class and method controllers:
        $this->data['class'] = $this->router->class;
        $this->data['method'] = $this->router->method;
        
        //echo $this->router->class; die;
        // get controller : class name
        $array_ex = array('home', 'contact' , 'contants' ,'question_answer' ,'co_operate','join_saxa','story_saxa','wearedo','weexpectfromyou');
        if (!in_array($this->router->class , $array_ex) && !$this->input->is_ajax_request()){
            $this->_className = $this->checkSlug();
        }
        $this->is_mobile();
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
          $this->load->view('templates/'.$template.'_view'.$this->subfix_layout, $this->data);
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
    
    /**
     * check exits slug
     * @return boolean
     */
    public function checkSlug() {
        $slug = end($this->uri->segment_array());
        $this->db->where('slug', $slug);
        $query = $this->db->get('d_slug');
        
        if ($query->num_rows() > 0 ){
            return $query->row_array();
        } else {
            redirect(base_url('404'));
        }
    }
    
    public function is_mobile() {
        if ($this->agent->is_mobile()) {
            $this->subfix_layout = '_sm';
        }
    }
    
}