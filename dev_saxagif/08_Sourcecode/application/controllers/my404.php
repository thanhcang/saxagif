<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management contact
 */
class My404 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->view('404_view'.$this->session->userdata('ses_mobile'));
    }

}