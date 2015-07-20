<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management contact
 */
class Mission extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('contact_model'));
        $this->lang->load('contact');
    }
    
    public function index()
    {
        $this->data['page_title'] = 'Mission';
        $this->render('mission/index_view');
    }
}