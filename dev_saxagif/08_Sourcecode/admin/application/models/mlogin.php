<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author vtcanglt@gmail.com
 * @date 20150630
 */
class Mlogin extends MY_Model {

    var $_table;
    
    public function __construct() {
        parent::__construct();
        $this->_table = 'd_user';
    }
    
    public function checkLogin($param) {
        $data = array(
            'username' => $param['username'],
            'password' => pass_hash($param['password']),  
        );
        $this->db->where($data);
        $query = $this->db->get($this->_table);
        if($query->num_rows() > 0 ){
            return $query->row_array();
        }
        return FALSE;
    }

}
