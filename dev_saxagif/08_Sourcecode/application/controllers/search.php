<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/08/16
 * Management search
 */
class Search extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('home_model'));
    }
    
    public function index()
    {
        $arr_type = array(TYPE_PRODUCT, TYPE_ARTICLE);
        $this->data['page_title'] = 'Search';
        $keyword = (isset($_GET['keyword'])) ? trim($_GET['keyword']) : '';
        $type = (isset($_GET['type'])) ? trim($_GET['type']) : '';
        if (!empty($type) && in_array($type, $arr_type)) {
            $typeResult = $type;
        }else {
            $typeResult = TYPE_PRODUCT;
        }
        $result = $this->home_model->search($keyword, $typeResult);
        //echo '<pre>'; print_r($result);die;
        if($result) {
            $this->data['search_result'] = $result;
        }
        $this->data['type_search'] = $typeResult;
        $this->render('search/index_view'.$this->subfix_layout);
    }
}