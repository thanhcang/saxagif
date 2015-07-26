<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  class customer comment
 */
class CommentCustomer extends MY_Controller {

    var $_user_login;
    public function __construct() {
        parent::__construct();
        $this->check_login();
        $this->_user_login = $this->session->userdata('user_id');
    }
    
}

