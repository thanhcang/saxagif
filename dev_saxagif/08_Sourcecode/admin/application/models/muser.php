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
    
    /**
     * show all user
     * @return boolean
     */
    public function listAccount() {
        $where = array(
            'active' => 1,
            'del_flg'=>0
        );
        $this->db->select('id , username,first_name,last_name,level,email,image');
        $this->db->where($where);
        $query = $this->db->get($this->_table);
        if ($query->num_rows() > 0 ){
            return $query->result_array();
        }
        return FALSE;
    }
    
    /**
     * check field is exists
     * @param string $field_name
     * @param string $value
     * @param int $user_id
     * @return boolean
     */
    public function checkFieldExist($field_name, $value, $user_id='') {
        $where = array(
            $field_name => $value,
        );
        if (!empty($user_id)) {
            $where['id'] = $user_id;
        }
        $this->db->select('id');
        $this->db->where($where);
        $query = $this->db->get($this->_table);
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }
    
    /**
     * create new user
     * @param type $param
     */
    public function add($param) {
        $this->db->insert($this->_table,$param);
    }

}
