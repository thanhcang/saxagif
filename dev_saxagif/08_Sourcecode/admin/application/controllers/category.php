<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/06/07
 * Management category
 */
class Category extends MY_Controller
{
    public function __contruct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        
    }
    
    public function create()
    {
        $data = array();
        $tpl["main_content"] = $this->load->view('category/create', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    public function edit()
    {
        
    }
    
    public function delete()
    {
        
    }
}


