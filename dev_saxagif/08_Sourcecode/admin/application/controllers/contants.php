<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contants extends MY_Controller {
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        Header("content-type: application/x-javascript; charset=utf-8");
        echo "var BASE_URL = '" . base_url() . "';" . PHP_EOL;
        // Category
        echo "var URL_DEL_CAT = '" . base_url('category/delete') . "';" . PHP_EOL;
        echo "var URL_EDIT_CAT = '" . base_url('category/editCat') . "';" . PHP_EOL;
        
        // Product
        echo "var URL_DEL_PRO = '" . base_url('product/delete') . "';" . PHP_EOL;
        echo "var URL_EDIT_PRO = '" . base_url('product/editPro') . "';" . PHP_EOL;
        echo "var URL_AUTO_GIFTSET = '" . base_url('product/showAutoGiftset') . "';" . PHP_EOL;
        
        // Partners
        echo "var URL_DEL_PAR = '" . base_url('partners/delete') . "';" . PHP_EOL;
        
        // News
        echo "var URL_DEL_NEWS = '" . base_url('news/delete') . "';" . PHP_EOL;
        // ajax
        echo "var URL_AJAX_PROFILE = '" . base_url('ajax/profileUser') . "';" . PHP_EOL;
        echo "var CURRENT_LOGIN = '" . $this->session->userdata('user_id') . "';" . PHP_EOL;
        echo "var PATH_COMMON = '" . COMMON_PATH . "';" . PHP_EOL;
        echo "var URL_AJAX_DELETE_USER = '" . base_url('ajax/deleteUser') . "';" . PHP_EOL;
        echo "var URL_AJAX_DELETE_PARTERS = '" . base_url('ajax/deleteParters') . "';" . PHP_EOL;
    }
}