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
//            /'level' =>  1,
            'active'=> 1,
            'del_flg'=>0,
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
            'active'=> 1,
            'del_flg'=>0,
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
        $where = array(
            'email'  => $email,
            'active' => 1,
            'del_flg'=> 0,
        );
        $this->db->where($where);
        $query = $this->db->get($this->_table);
        if ($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return FALSE;
        }
    }
    
    /**
     * check token when update password
     * @param type $param
     * @return boolean
     */
    public function checkToken($param) {
        $this->db->where('forgot_password', $param);
        $query = $this->db->get($this->_table);
        if ($query->num_rows() > 0){
            return $query->row_array();
        }
        return FALSE;
    }
    
    /**
     * update password for usser
     * @param type $param
     */
    public function updatePassword($param) {
        $data = array(
            'password'  => pass_hash(trim($param['password'])),
        );
        $where = array(
            'forgot_password'  => $param['forgot_password'],
        );
        $this->db->where($where);
        $this->db->update($this->_table,$data);
    }
   
    /**
     * remove token password
     * @param array $param
     */
    public function removeTokenPasswordReset($param) {
        $data = array(
            'forgot_password'  => NULL,
        );
        $where = array(
            'forgot_password'  => $param['forgot_password'],
        );
        $this->db->where($where);
        $this->db->update($this->_table,$data);
    }
}
