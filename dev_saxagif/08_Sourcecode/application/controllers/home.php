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
        $this->load->model(array('mnews'));
    }
    
    public function index()
    {
        // Get category gift
        $this->data['cat_gift'] = $this->category_model->getCategoryByType($type = IS_GIFT,TRUE);
        // Get list slideshow
        $this->data['slideshow'] = $this->home_model->getSlideShow($this->langs);
        
        // Get news position right:
        $this->data['news_home'] = $this->home_model->getNewsByHome($this->langs);
        // get category news by footer
        $categoryFooter = $this->home_model->getNewsCategroyFooter(5,$this->langs);
        $categoryFooter2 = $this->mnews->listPartnerSaxa($this->langs,false, $total = 0);
        $categoryFooter3= $this->home_model->getNewsCategroyFooter(8,$this->langs);
        
        // get article by footer
        if (!empty($categoryFooter)){
            $articleFooter = $this->home_model->getArticleFooter($categoryFooter['id'], $this->langs);
            $this->data['articleFooter'] = $articleFooter ;
        }
        
//        if (!empty($categoryFooter2)){
//            $articleFooter = $this->home_model->getArticleFooter($categoryFooter2['id'], $this->langs);
//            $this->data['articleFooter2'] = $articleFooter ;
//        }
        $this->data['articleFooter2'] = $this->mnews->listPartnerSaxa($this->langs,false, $total = 0);
        
        if (!empty($categoryFooter3)){
            $articleFooter = $this->home_model->getArticleFooter($categoryFooter3['id'], $this->langs);
            $this->data['articleFooter3'] = $articleFooter ;
        }
        
        $this->data['categoryFooter'] = $categoryFooter;
        $this->data['categoryFooter2'] = $categoryFooter2;
        $this->data['categoryFooter3'] = $categoryFooter3;
         
        // menu left 1
        $this->data['menu_left_1'] = $this->home_model->getPositionHome($this->langs,2,1);
        // menu left 2
        $this->data['menu_left_2'] = $this->home_model->getPositionHome($this->langs, 4 , 3);
        
        // menu right
        
        //
        
        // render html
        $this->render('home/index_view'.$this->subfix_layout);
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
                echo '202';
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