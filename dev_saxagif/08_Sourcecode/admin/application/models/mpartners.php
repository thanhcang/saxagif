<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/06/21
 */
class Mpartners extends MY_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/21
     * List all partners
     */
    public function listAll($param, &$total, $offset = 0, $limit = 0)
    {
        $sql = "SELECT
                        pn.id,
                        pn.name,
                        pn.address,
                        pn.email,
                        pn.phone,
                        pn.logo,
                        pn.url,
                        pn.note,
                        pn.language_type
                FROM
                        " . $this->_tbl_partners . " AS pn
                WHERE
                        pn.del_flg = 0";
        $where = array(
            'del_flg' => 0,
        );
        $total = MY_Model::get_total_result($sql, $where);
        if ($limit > 0) {
            $sql .= ' LIMIT ' . $offset . ',' . $limit;
        }
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/21
     * Save partners
     */
    public function save($params)
    {
        $data = array(
            'name'          => $params['name'],
            'address'       => (!empty($params['address'])) ? $params['address'] : '',
            'email'         => (!empty($params['email'])) ? $params['email'] : '',
            'phone'         => (!empty($params['phone'])) ? $params['phone'] : '',
            'url'           => (!empty($params['url'])) ? $params['url'] : '',
            'note'          => (!empty($params['note'])) ? $params['note'] : '',
            'language_type' => (!empty($params['language_type'])) ? $params['language_type'] : '',
        );
        if (!empty($params['logo'])) {
            $data['logo'] = $params['logo'];
        }
        if (!empty($params['partners_id'])) {
             $data['update_date'] = date('Y-m-d H:i:s');
             $data['update_user'] = $this->session->userdata('ses_user_id');
             $this->db->where('id', $params['partners_id']);
             return $this->db->update($this->_tbl_partners, $data);
        } else {
            $data['create_date'] = date('Y-m-d H:i:s');
            $data['create_user'] = $this->session->userdata('ses_user_id');
            return $this->db->insert($this->_tbl_partners, $data);
        }
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/21
     * Detail partners
     */
    public function detail($id)
    {
        $sql = "SELECT
                        pn.id,
                        pn.name,
                        pn.address,
                        pn.email,
                        pn.phone,
                        pn.logo,
                        pn.url,
                        pn.note,
                        pn.language_type
                FROM
                        " . $this->_tbl_partners . " AS pn
                WHERE
                        pn.del_flg = 0 AND pn.id = ? LIMIT 1";
        $query = $this->db->query($sql, array($id));
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->row_array();
    }
    
    /**
     * delete partners
     * @param type $id
     * @return type
     */
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->_tbl_partners, array('del_flg' => 1));
    }

    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/21
     * check name partners exist
     */
    public function checkExistName($name)
    {
        $this->db->select('id')
                ->where('name', $name);
        $query = $this->db->get($this->_tbl_partners);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }    
    }
    
    /**
     * get all partners by name
     * @param string $name
     * @return boolean
     */
    public function getpartnerByName($name='') {
        $this->db->select('name,
                        id, 
                        CASE
                        WHEN note <> "" THEN CONCAT(SUBSTR(note,1,50),"...") 
                        WHEN note = "" THEN "" 
                        END as note', FALSE);
        $this->db->where('del_flg', 0);
        if (!empty($name)){
            $this->db->like('name', $name, 'after');
        }
        $query = $this->db->get($this->_tbl_partners);
        
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        return FALSE;
    }
}