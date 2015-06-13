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
    }
}