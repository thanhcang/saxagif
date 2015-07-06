<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author vtcanglt@gmail.com
 * @date 20150706
 */
class Muser extends MY_Model {

    var $_table;

    public function __construct() {
        parent::__construct();
        $this->_table = 'd_user';
    }
    
    /**
     * get profile member 
     * @param array $param
     * @return boolean
     */
    public function profile($param) {
        $where = array(
            'id' => $param['user_id'],
            'active'=> 1,
            'del_flg'=>0,
        );
        $this->db->select('id , username , first_name, last_name, level, email,image');
        $this->db->where($where);
        $query = $this->db->get($this->_table);
        if ($query->num_rows() > 0 ){
            return $query->row_array();
        }
        return FALSE;
    }

}
