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
        
        $this->load->model('mquestion');
        $this->lang->load('contact');
    }
    
    public function index()
    {
        $this->data['listData'] = $this->mquestion->getCoOperate();
        $this->render('co_operate/index_view');
    }
}
    