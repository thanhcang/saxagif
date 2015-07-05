<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author vtcanglt@gmail.com
 * @date 20150626
 */
class Msetting extends MY_Model {

    var $_table;

    public function __construct() {
        parent::__construct();
        $this->_table = 'm_setting';
    }

    /**
     * get all data setting page
     * @param int $language
     * @return boolean
     */
    public function selectCompanyInfo($language) {
        $this->db->where('language_type', $language);
        $query = $this->db->get($this->_table);
        if ($query->num_rows > 0) {
            return $query->row_array();
        }
        return FALSE;
    }

    /**
     * update setting page
     * @param type $param
     */
    public function update($param) {
        $data = array();
        $data['sitename'] = !empty($param['sitename']) ? $param['sitename'] : '';
        if ( !empty($param['shortcut'])){
            $data['shortcut'] = $param['shortcut'];
        }
        if ( !empty($param['logo'])){
            $data['logo'] = $param['logo'];
        }
        $data['key_google'] = !empty($param['key_google']) ? $param['key_google'] : '';
        $data['des_google'] = !empty($param['des_google']) ? $param['des_google'] : '';
        $data['phone'] = !empty($param['phone']) ? $param['phone'] : '';
        $data['fax'] = !empty($param['fax']) ? $param['fax'] : '';
        $data['email'] = !empty($param['email']) ? $param['email'] : '';
        $data['address'] = !empty($param['address']) ? $param['address'] : '';
        $data['slogan'] = !empty($param['slogan']) ? $param['slogan'] : '';
        $this->db->trans_begin();
        if ($param['language_type'] == 1){
            $this->db->where('id', 1);
        } else {
            $this->db->where('id', 2);
        }
        $this->db->update($this->_table, $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

}
