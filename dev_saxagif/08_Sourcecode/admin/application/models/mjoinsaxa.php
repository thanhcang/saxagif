<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/06/07
 */
class Mjoinsaxa extends MY_Model
{
    var $_login_user;
    public function __construct() {
        parent::__construct();
        $this->_login_user = $this->session->userdata('user_id');
    }
   
    /**
     * add join saxa
     * @param type $param
     */
    public function add($param) {
        if (empty($param)){
            return FALSE;
        }
        $data = array(
            'name'  => htmlspecialchars($param['name']),
            'des'  => htmlspecialchars($param['des']),
            'work'  => htmlspecialchars($param['work']),
            'content'  => htmlspecialchars($param['content']),
            'issue'  => htmlspecialchars($param['issue']),
            'right'  => htmlspecialchars($param['right']),
            'status'  => 1,
            'number'  => htmlspecialchars($param['number']),
            'logo'  => $param['logo'],
            'slug'  => slug_convert($param['name']),
            'update_date'  => date('Y-m-d H:i:s'),
        );
        
        $this->db->insert('d_joinsaxa', $data);
        
        $this->db->trans_off();
        $this->db->trans_begin();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }
    
    /**
     * get all join saxa
     * @param type $params
     * @param type $total
     * @param type $offset
     * @param type $limit
     * @param type $catType
     * @return boolean
     */
    public function search(&$total, $offset = 0, $limit = 0)
    {
        $arr_where = array();
        $sql = "SELECT
                    *
                FROM d_joinsaxa AS c 
                WHERE  c.del_flg = 0 ";

        $total = MY_Model::get_total_result($sql, $arr_where);
        if ($limit > 0) {
            $sql .= ' LIMIT ' . $offset . ',' . $limit;
        }
        $query = $this->db->query($sql, $arr_where);
        //echo $this->db->last_query();die;
        if($query->num_rows() == 0) {
            return FALSE;
        }
        return  $query->result_array();
        
    }
    
    /**
     * delete join saxa
     * @param int id
     */
    public function deleteJoinSaxa($id) {
        $this->db->where('id' , $id);
        $this->db->delete('d_joinsaxa');
    }
    
    /**
     * delete join saxa
     * @param int id
     */
    public function onJoinSaxa($id) {
        $this->db->where('id' , $id);
        $this->db->update('d_joinsaxa', array('status' => '1'));
    }
    
    /**
     * delete join saxa
     * @param int id
     */
    public function offJoinSaxa($id) {
        $this->db->where('id' , $id);
        $this->db->update('d_joinsaxa', array('status' => '0'));    }
}