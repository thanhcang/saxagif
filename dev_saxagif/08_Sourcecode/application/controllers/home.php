<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/06/07
 * Management category
 */
class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model(array('home_model', 'category_news_model'));
    }
    
    public function index()
    {
        // Get category gift
        $this->data['cat_gift'] = $this->category_model->getCategoryByType($type = IS_GIFT,TRUE);
        // Get list slideshow
        $this->data['slideshow'] = $this->home_model->getSlideShow($this->langs);
        
        // Get news position right:
        $this->data['news_home'] = $this->home_model->getNewsByHome($this->langs);
        // Get customer slide home:
        $this->data['customers'] = $this->home_model->getCustomer($this->langs);
        //echo '<pre>';        print_r($this->data['news_cat_position']);exit;
        $this->render('home/index_view');
    }
    
    /**
     * Send mail customer
     */
    public function sendMailCustomer()
    {
        if($this->input->post('email') && $this->input->post('name')) {
            $email = $this->input->post('email');
            $name = $this->input->post('name');
            if ($this->home_model->setSendMail($email, $name)) {
                echo '1';
            } else {
                echo '';
            }
        } else {
            echo '';
        }
    }
    /**
     * Set language 
     */
    public function setLanguage()
    {
        if ($this->input->post('language')) {
            $language_type = (int)$this->input->post('language');
            $this->session->set_userdata('ses_language',$language_type);
            echo 1;
        } else {
            echo '';
        }
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/07/25
     * Show slide customer home page
     */
    public function slideCustomer()
    {
        if($this->input->post('num_position') && $this->input->post('act_click')) {
            $data = array();
            $num_position = (int)$this->input->post('num_position');
            $act_click = $this->input->post('act_click');
            $data = $this->home_model->getCustomer($num_position, $act_click);
            if ($data) {
                echo json_encode($data);
            }else {
                echo '';
            }
        }else {
            echo '';
        }
    }
}