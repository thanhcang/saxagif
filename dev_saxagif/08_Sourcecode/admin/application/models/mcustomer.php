<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/06/22
 */
class Mcustomer extends MY_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function search()
    {
        $sql = "SELECT
                        c.id,
                        c.name,
                        c.email_address,
                        c.phone_number,
                        c.birthday,
                        c.sex,
                        c.address,
                        c.company_name
                FROM
                        " . $this->_tbl_customer . " AS c
                WHERE
                        c.del_flg = 0";
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    public function save($params)
    {
        $data = array(
            'name'          => $params['name'],
            'email_address' => $params['email_address'],
            'phone_number'  => (!empty($params['phone_number'])) ? $params['phone_number'] : '',
            'birthday'      => (!empty($params['birthday'])) ? $params['birthday'] : '',
            'sex'           => (!empty($params['sex'])) ? $params['sex'] : '',
            'address'       => (!empty($params['address'])) ? $params['address'] : '',
            'company_name'  => (!empty($params['company_name'])) ? $params['company_name'] : '',
        );
        
        // Update customer:
        if (!empty($params['customer_id'])) {
            $data['update_date'] = date('Y-m-d H:i:s');
            $data['update_user'] = $this->session->userdata('ses_user_id');
            $this->db->where('id', $params['customer_id']);
            return $this->db->update($this->_tbl_customer, $data);
        } else { // Insert customer:
            $data['create_date'] = date('Y-m-d H:i:s');
            $data['create_user'] = $this->session->userdata('ses_user_id');
            return $this->db->insert($this->_tbl_customer, $data);
        }
        
    }
    
    public function detail($cusId = '')
    {
        $cusId = intval($cusId);
        if (empty($cusId)) {
            return FALSE;
        }
        $sql = "SELECT
                        c.id,
                        c.name,
                        c.email_address,
                        c.phone_number,
                        c.birthday,
                        c.sex,
                        c.address,
                        c.company_name
                FROM
                        " . $this->_tbl_customer . " AS c
                WHERE
                        c.del_flg = 0
                        AND c.id = ? LIMIT 1";
        $query = $this->db->query($sql, array($cusId));
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->row_array();
    }
    
     public function delCustomer($cusId)
    {
        $this->db->where('id', $cusId);
        return $this->db->update($this->_tbl_category,array('del_flg' => 1));
    }
    
    public function checkExistName($name)
    {
        $this->db->select('id')
                ->where('name', $name);
        $query = $this->db->get($this->_tbl_customer);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }   
    }
}