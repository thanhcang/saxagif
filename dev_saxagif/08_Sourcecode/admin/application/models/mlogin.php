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
            'level' =>  1,
        );
        $this->db->where($data);
        $query = $this->db->get($this->_table);
        if($query->num_rows() > 0 ){
            return $query->row_array();
        }
        return FALSE;
    }
    
    /**
     * get data of user from cookie
     * @param Array $param
     * @return boolean
     */
    public function getLoginFromCookie($param) {
        $data = array(
            'id'    =>  $param['id'],
        );
        $this->db->where($data);
        $query = $this->db->get($this->_table);
        if ($query->num_rows > 0){
            return $query->row_array();
        }
        return FALSE;
    }
    
    /**
     * reset password
     * @param type $param
     */
    public function resetPassword($param) {
        $data = array(
            'forgot_password' => $param['forgot_password']
        );
        $where = array(
            'email' =>  $param['email']
        );
        $this->db->where($where);
        $this->db->update($this->_table,$data);
    }
    
    /**
     * check email have exists
     * @param String || Array $param
     * @return boolean
     */
    public function checkEmail($param) {
        if (!empty($param) && !is_array($param)){
            $email = $param;
        } elseif (!empty($param) && is_array($param) && !empty($param['email'])){
            $email = $param['email'];
        }else{
            return FALSE;
        }
        $this->db->where('email',$email);
        $query = $this->db->get($this->_table);
        if ($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return FALSE;
        }
    }
    
    
}
