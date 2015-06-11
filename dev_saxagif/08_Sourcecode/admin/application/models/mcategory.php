<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/06/07
 */
class Mcategory extends MY_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function search($params, &$total, $offset = 0, $limit = 0)
    {
        $arr_where = array();
        $sql = "SELECT
                        c.id,
                        c.name,
                        c.logo,
                        c.bg_color,
                        c.language_type,
                        c.parent,
                        c.keyword_seo,
                        c.des_seo
                FROM " . $this->_tbl_category . "
                AS c WHERE 
                        c.del_flg = 0 
                        AND c.parent = 0";
        if (!empty($params['name'])) {
            $sql .= " AND name LIKE ?";
            $arr_where[] = '%' . $params['name'] . '%';
        }
        $total = MY_Model::get_total_result($sql, $arr_where);
        if ($limit > 0) {
            $sql .= ' LIMIT ' . $offset . ',' . $limit;
        }
        $query = $this->db->query($sql, $arr_where);
        //echo $this->db->last_query();die;
        if($query->num_rows() == 0) {
            return FALSE;
        }
        $list_cat = $query->result_array();
        
        return $list_cat;
    }
    
    public function listAll()
    {
        
    }
    
    public function listParent()
    {
        $sql = "SELECT id, name FROM " .$this->_tbl_category ." AS c WHERE del_flg = 0 AND c.parent = 0";
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    public function create($params)
    {
        $data = array(
            'name'          => $params['name'],
            'bg_color'      => str_replace('#', '', $params['bg_color']),
            'language_type' => (int)$params['language_type'],
            'parent'        => (!empty($params['parent'])) ? $params['parent'] : 0,
        );
        
        if(!empty($params['logo'])) {
            $data['logo'] = $params['logo'];
        }
        
        if(!empty($params['keyword_seo'])) {
            $data['keyword_seo'] = $params['keyword_seo'];
        }
        
        if(!empty($params['des_seo'])) {
            $data['des_seo'] = $params['des_seo'];
        }
        
        if (!empty($params['category_id'])) {
            $data['update_user'] = $this->session->userdata('ses_user_id');
            $data['update_date'] = date('Y-m-d H:i:s');
            $this->db->where('id', $params['category_id']);
            
            return $this->db->update($this->_tbl_category, $data);
        } else {
            $data['create_user'] = $this->session->userdata('ses_user_id');
            $data['create_date'] = date('Y-m-d H:i:s');
            
            return $this->db->insert($this->_tbl_category, $data);
        }
            
    }
    
    public function getDetail($cat_id, $parent = FALSE)
    {
        $data = array();
        $q = $this->db->select('*')
                ->where('id', $cat_id)
                ->get($this->_tbl_category);
        if ($q->num_rows() == 0) {
            return FALSE;
        }
        $data = $q->row_array();
        if ($parent) {
            $this->db->where('parent', $cat_id)
                    ->where('del_flg', 0);
            $q = $this->db->get($this->_tbl_category);
            if (count($q) > 0 ) {
                $data['cat_parent'] = $q->result_array();
            }
        }
        return $data;
    }
    
    public function delCat($cat_id)
    {
        $this->db->where('id', $cat_id);
        return $this->db->update($this->_tbl_category,array('del_flg' => 1));
    }
}


