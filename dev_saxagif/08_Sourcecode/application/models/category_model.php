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
    
    public function getCategoryByType($type, $gift = FALSE)
    {
        $sql_str = "SELECT
                            c.id,
                            c.`name`,
                            c.parent,
                            c.slug,
                            c.logo,
                            c.bg_color
                    FROM
                            d_category AS c
                    WHERE
                            c.del_flg = 0
                    AND c.type = ?";
        if($gift) {
            $sql_str .= " AND c.is_home = 1";
        } else {
            $sql_str .= " AND c.is_home = 0";
        }
        $sql_str .= " ORDER BY c.id ASC";
        $query = $this->db->query($sql_str, array($type));
        if ($query->num_rows() == 0 ) {
            return FALSE;
        }
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    
    
}