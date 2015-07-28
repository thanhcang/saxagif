<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends MY_Controller {
    var $_privateClasName;
    
    function __construct()
    {
        parent::__construct();
        $common = $this->_className;
        require_once(APPPATH.'controllers/'.$common['controller'].'.php');
        $this->_privateClasName = new $common['controller'];
    }

    public function index() {
        $this->_privateClasName->index(); 
    }
}

