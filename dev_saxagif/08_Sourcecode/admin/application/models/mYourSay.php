<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mYourSay extends MY_Model
{
    var $_login_user;
    public function __construct() {
        parent::__construct();
        $this->_login_user = $this->session->userdata('user_id');
    }
    
    /**
     * add
     * @param type $param
     */
    public function add($param) {
        $data = array(
            'name' => htmlspecialchars($param['name']),
            'comment' => $param['comment'],
            'logo'  =>  $param['logo'],
            'language_type' => $param['language_type'],
            'type' => $param['type'],
            'create_user'   => $this->_login_user,
            'create_date'   => date('Y-m-d H:i:s'),
            'update_user'   => $this->_login_user,
            'update_date'   => date('Y-m-d H:i:s'),
        );
        
        $this->db->insert('d_yoursay', $data);
    }
    
    /**
     * add salse
     * @param type $param
     */
    public function addSalse($param) {
        $data = array(
            'name' => htmlspecialchars($param['name']),
            'phone' => $param['phone'],
            'avatar'  =>  $param['avatar']
        );
        
        $this->db->insert('d_sale_service', $data);
    }
    
    /**
     * edit
     * @param type $param
     */
    public function edit($param, $id) {
        $data = array(
            'name' => htmlspecialchars($param['name']),
            'comment' => $param['comment'],
            'language_type' => $param['language_type'],
            'type' => $param['type'],
            'update_user'   => $this->_login_user,
            'update_date'   => date('Y-m-d H:i:s'),
        );
        
        if ($param['logo']){
            $data['logo'] = $param['logo'];
        }
        
        $this->db->where('id', $id);
        $this->db->update('d_yoursay', $data);
    }
    
    /**
     * edit slase
     * @param type $param
     */
    public function editSalse($param, $id) {
        $data = array(
            'name' => htmlspecialchars($param['name']),
            'phone' => $param['phone'],
        );
        
        if (!empty($param['avatar'])){
            $data['avatar'] = $param['avatar'];
        }
        
        $this->db->where('id', $id);
        $this->db->update('d_sale_service', $data);
    }
    
    /**
     * get all data
     * @param array $param
     * @param int $total
     * @param int $offset
     * @param int $limit
     * @return boolean
     */
    public function listAll($param, &$total, $offset = 0, $limit = 0) {
        $arr_where = array();
        $sql = "SELECT
                *
                FROM d_yoursay
                WHERE 
                    1=1 ";

        if (!empty($param['sLanguageType'])) {
            $sql .= " AND c.language_type = ?";
            $arr_where[] = $param['sLanguageType'];
        }

        $total = MY_Model::get_total_result($sql, $arr_where);
        if ($limit > 0) {
            $sql .= ' LIMIT ' . $offset . ',' . $limit;
        }
        $query = $this->db->query($sql, $arr_where);

        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    /**
     * get all data
     * @param array $param
     * @param int $total
     * @param int $offset
     * @param int $limit
     * @return boolean
     */
    public function listSalesAll($param, &$total, $offset = 0, $limit = 0) {
        $arr_where = array();
        $sql = "SELECT
                *
                FROM d_sale_service";

        $total = MY_Model::get_total_result($sql, $arr_where);
        if ($limit > 0) {
            $sql .= ' LIMIT ' . $offset . ',' . $limit;
        }
        $query = $this->db->query($sql, $arr_where);

        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    /**
     * get row by id
     * @param type $id
     */
    public function getRowById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('d_yoursay');
        
        if ($query->num_rows() > 0 ){
            return $query->row_array();
        }
        return FALSE;
    }
    
    /**
     * get row by id
     * @param type $id
     */
    public function getSalseRowById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('d_sale_service');
        
        if ($query->num_rows() > 0 ){
            return $query->row_array();
        }
        return FALSE;
    }

}
