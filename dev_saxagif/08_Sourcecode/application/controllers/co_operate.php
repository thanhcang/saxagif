<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management category
 */
class Co_operate extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model(array('home_model', 'category_news_model'));
        $this->lang->load('contact');
    }
    
    public function index()
    {
        
        $this->render('co_operate/index_view');
    }
}
    