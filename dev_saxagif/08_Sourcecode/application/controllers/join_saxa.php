<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management category
 */
class Join_saxa extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('home_model'));
        $this->lang->load('contact');
    }
    
    /**
     * show list join all saxa
     */
    public function index()
    {
        $this->data['listData'] = $this->home_model->join_saxa($this->langs);
        $this->render('join_saxa/index_view');
    }
    
    /**
     * show detail join saxa
     * @param type $slug
     */
    public function detail()
    {
        $this->data['listData'] = $this->home_model->join_saxa($this->langs);
        $this->render('join_saxa/detail');
    }
    
}
    