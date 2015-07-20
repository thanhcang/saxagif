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
        echo "var URL_SET_LANGUAGE = '" . base_url('home/setLanguage') . "';" . PHP_EOL;
        
        // Contact:
        echo "var CT_MISSING_EMPTY_NAME = '" . $this->lang->line('ct_missing_empty_name') . "';" . PHP_EOL;
        echo "var  CT_MISSING_EMPTY_EMAIL= '" . $this->lang->line('ct_missing_empty_email') . "';" . PHP_EOL;
        echo "var  CT_MISSING_EMAIL_INVALID = '" . $this->lang->line('ct_missing_email_invalid') . "';" . PHP_EOL;
    }
}