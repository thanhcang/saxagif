<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Category_model extends MY_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function listAll()
    {
        $this->db->select('id, name, parent')
                ->where('del_flg', 0);
        $query = $this->db->get($this->_tbl_category);
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
}