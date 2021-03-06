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
        echo "var URL_VIEW_CHILD_CATEGORY = '" . base_url('ajax/viewChildCategory') . "';" . PHP_EOL;
        
        // Product
        echo "var URL_DEL_PRO = '" . base_url('product/delete') . "';" . PHP_EOL;
        echo "var URL_EDIT_PRO = '" . base_url('product/editPro') . "';" . PHP_EOL;
        echo "var URL_AUTO_GIFTSET = '" . base_url('product/showAutoGiftset') . "';" . PHP_EOL;
        echo "var URL_CATEGORY_IMAGE = '" . base_url('common/multidata/cat_logo') . "';" . PHP_EOL;
        echo "var URL_GET_CHILD_CATEGORY = '" . base_url('ajax/getChildCategory') . "';" . PHP_EOL;
        echo "var URL_GET_PRODUCT = '" . base_url('ajax/getProductByName') . "';" . PHP_EOL;
        echo "var URL_CHECK_PRODUCT = '" . base_url('ajax/checkProduct') . "';" . PHP_EOL;
        echo "var URL_DELETE_PRODUCT = '" . base_url('ajax/deleteProduct') . "';" . PHP_EOL;
        echo "var URL_GET_PARTNER = '" . base_url('ajax/getpartnerByName') . "';" . PHP_EOL;
        
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
        
        //Category news
         echo "var URL_DEL_CAT_NEWS = '" . base_url('category_news/delete') . "';" . PHP_EOL;
         echo "var URL_DEL_CAT_NEWS_ = '" . base_url('saxa_everyday/delete') . "';" . PHP_EOL;
         echo "var URL_DETAIL_CAT_NEWS = '" . base_url('category_news/detailCatNews') . "';" . PHP_EOL;
         echo "var URL_DETAIL_CAT_NEWS_ = '" . base_url('saxa_everyday/detailCatNews') . "';" . PHP_EOL;
        
        // News URL_DEL_NEWS
        echo "var URL_DEL_NEWS = '" . base_url('news/delete') . "';" . PHP_EOL;
        echo "var URL_REVIEW_NEWS = '" . base_url('news/review') . "';" . PHP_EOL;
        
        // join saxa
        echo "var URL_DEL_JOINXA = '" . base_url('ajax/deleteJoinSaxa') . "';" . PHP_EOL;
        echo "var URL_ON_JOINXA = '" . base_url('ajax/onJoinSaxa') . "';" . PHP_EOL;
        echo "var URL_OFF_JOINXA = '" . base_url('ajax/offJoinSaxa') . "';" . PHP_EOL;
    }
}