<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management contact
 */
class About extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('contact_model'));
        $this->lang->load('contact');
    }
    // Mission page
    public function index()
    {
        $this->data['page_title'] = 'Mission';
        $this->render('about/index_view');
    }
    
    //Who we are page
    public function who_we_are()
    {
        $this->data['page_title'] = 'Mission';
        $this->render('about/who_we_are_view');
    }
    
    // We do for you page
    public function we_do_for_you()
    {
        $this->data['page_title'] = 'We do for you';
        $this->render('about/we_do_for_you');
    }
    
    // we_expect_from_you page
    public function we_expect_from_you()
    {
        $this->data['page_title'] = 'We do for you';
        $this->render('about/we_expect_from_you');
    }
    
}