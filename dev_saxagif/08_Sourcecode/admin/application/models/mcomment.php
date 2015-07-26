<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mcomment extends MY_Model
{
    var $_login_user;
    public function __construct() {
        parent::__construct();
        $this->_login_user = $this->session->userdata('user_id');
    }
    
    /**
     * add comment
     * @param type $param
     */
    public function addComment($param) {
        $data = array(
            'customer_name' => htmlspecialchars($param['customer_name']),
            'question' => htmlspecialchars($param['question']),
            'answer' => !empty($param['answer'] ) ? htmlspecialchars($param['answer']) : '',
            'language_type' => !empty($param['answer'] ) ? $param['answer'] : 1 ,
            'logo'  =>  $param['logo'],
            'create_user'   => $this->_login_user,
            'create_date'   => date('Y-m-d H:i:s'),
            'update_user'   => $this->_login_user,
            'update_date'   => date('Y-m-d H:i:s'),
        );
        
        $this->db->insert('d_customer_question', $data);
    }
    
    /**
     * get all comment
     * @param array $param
     * @param int $total
     * @param int $offset
     * @param int $limit
     * @return boolean
     */
    public function listAllComment($param, &$total, $offset = 0, $limit = 0) {
        $arr_where = array();
        $sql = "SELECT
                *
                FROM d_customer_question
                WHERE 
                    del_flg = 0 
                    ";
        
        if (!empty($param['sLanguageType'])) {
            $sql .= " AND c.language_type = ?";
            $arr_where[] = $param['sLanguageType'];
        }
        
        if (!empty($param['sAnswer'])) {
            if ($param['sAnswer'] == 1){
                $sql .= " answer IS NULL ";
            } else {
                $sql .= " answer IS NOT NULL ";
            }
            $arr_where[] = $param['sAnswer'];
        }
        
        $total = MY_Model::get_total_result($sql, $arr_where);
        if ($limit > 0) {
            $sql .= ' LIMIT ' . $offset . ',' . $limit;
        }
        $query = $this->db->query($sql, $arr_where);
        //echo $this->db->last_query();die;
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
}
