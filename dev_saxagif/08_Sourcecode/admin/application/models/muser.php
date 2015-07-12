<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author vtcanglt@gmail.com
 * @date 20150706
 */
class Muser extends MY_Model {

    var $_table;
    var $_login_user;
    public function __construct() {
        parent::__construct();
        $this->_table = 'd_user';
        $this->_login_user = $this->session->userdata('user_id');
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
     * show all user by condition
     * @param array $param
     * @param int $total
     * @param int $offset
     * @param int $limit
     * @return boolean
     */
    public function listAccount($param, &$total, $offset = 0, $limit = 0) {
        $sql = 'SELECT
                        id,
                        username,
                        first_name,
                        last_name,
                        LEVEL,
                        email,
                        image
                FROM
                        d_user
                WHERE
                        active = ?
                AND     del_flg = ?';
        $where = array(
            'active' => 1,
            'del_flg' => 0
        );
        if (!empty($param['fLevel'])) {
            $where[] = trim($param['fLevel']);
        }
        if (!empty($param['fName'])) {
            $where[] = trim($param['fName']);
        }
        $total = MY_Model::get_total_result($sql, $where);
        if ($limit > 0) {
            $sql .= ' LIMIT ' . $offset . ',' . $limit;
        }
        $query = $this->db->query($sql, $where);
        if ($query->num_rows() > 0) {
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
            $where['id <> '] = $user_id;
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
    
    /**
     * update infomation for user
     * @param array $where
     * @param array $param
     */
    public function update($where,$param) {
        $this->db->where($where);
        $this->db->update($this->_table,$param);
    }
    
    /**
     * create new user
     * @param type $param
     */
    public function deleteUser($param) {
        $where = array(
            'id' => $param['user_id']
        );
        $data = array(
            'active' => 0,
            'del_flg' => 1,
            'update_user'=> $this->_login_user,
            'update_date'=> date('Y-m-d H:i:s'),
        );
        $this->db->where($where);
        $this->db->update($this->_table,$data);
    }
    
    /**
     * get user by id
     * @param int $user_id
     * @return boolean
     */
    public function getUserById($user_id) {
        $where = array(
            'id' => $user_id,
            'del_flg' => 0,
            'active' => 1,
        );
        $this->db->select('id,
                        username,
                        first_name,
                        last_name,
                        LEVEL,
                        email,
                        image');
        $this->db->where($where);
        $query = $this->db->get($this->_table);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return FALSE;
    }

}
