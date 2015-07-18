<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contants extends MY_Controller {
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        Header("content-type: application/x-javascript; charset=utf-8");
        echo "var BASE_URL = '" . base_url() . "';" . PHP_EOL;
        // Home
        echo "var URL_SEND_MAIL_CUSTOMER = '" . base_url('home/sendMailCustomer') . "';" . PHP_EOL;
        
    }
}