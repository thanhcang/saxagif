<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management contact
 */
class Product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('product_model'));
        //$this->lang->load('contact');
    }
    // Mission page
    public function index()
    {
        $this->data['page_title'] = 'Product';
        $this->render('product/index_view');
    }
}