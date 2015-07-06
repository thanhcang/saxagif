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
        //$this->load->model('mcategory');
        //$this->lang->load('category');   
    }
    
    public function index()
    {
        $this->render('home/index_view');
    }
}