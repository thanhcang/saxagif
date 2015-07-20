<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author hnguyen0110@gmail.com
 * @date 2015/07/18
 * Home model
 */
class Contact_model extends MY_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function save($params)
    {
        $data = array(
            'name' => $params['cus_name'],
            'email_address' => $params['cus_email'],
            'phone_number'  => (!empty($params['cus_phone'])) ? $params['cus_phone'] : '',
            'company_name'  => (!empty($params['cus_company'])) ? $params['cus_company'] : '',
            'feeback'       => (!empty($params['cus_feeback'])) ? $params['cus_feeback'] : '',
            'create_date'   => date('Y-m-d H:i:s'),
        );
        
        return $this->db->insert($this->_tbl_customer, $data);
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/07/19
     * Check exist email
     */
    public function checkExistEmail($email)
    {
        $this->db->select('id')
                ->where('email_address', $email)
                ->where('del_flg', 0);
        $query = $this->db->get($this->_tbl_customer);
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }
}