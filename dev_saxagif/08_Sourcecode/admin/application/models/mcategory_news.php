<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/07/11
 */
class Mcategory_news extends MY_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function search($params, &$total, $offset = 0, $limit = 0, $catType = '')
    {
        $result = array();
        $arr_where = array();
        $sql = "SELECT
                        cn.id,
                        cn.name,
                        cn.slug,
                        cn.position,
                        cn.language_type,
                        cn.keyword_seo,
                        cn.des_seo
                FROM " . $this->_tbl_category_news . "
                AS cn WHERE 
                        cn.del_flg = 0";
        if (!empty($params['name'])) {
            $sql .= " AND name LIKE ?";
            $arr_where[] = '%' . $params['name'] . '%';
        }
        if (!empty($params['language_type'])) {
            $language = (int)$params['language_type'];
            $sql .= " AND cn.language_type = ?";
            $arr_where[] = $language;
        }
        if(!empty($params['cat_news_id'])) {
            $cat_news_id = (int)$params['cat_news_id'];
            $sql .= " AND cn.id = ?";
            $arr_where[] = $cat_news_id;
        }
        $sql .= " ORDER BY cn.id DESC";
        $total = MY_Model::get_total_result($sql, $arr_where);
        if ($limit > 0) {
            $sql .= ' LIMIT ' . $offset . ',' . $limit;
        }
        
        $query = $this->db->query($sql, $arr_where);
        //echo $this->db->last_query();die;
        if($query->num_rows() == 0) {
            return FALSE;
        }
        $result = $query->result_array();
        
        return $result;
    }
    
    public function listAll()
    {
        $this->db->select('id, name')
                ->where('del_flg', 0);
        $query = $this->db->get($this->_tbl_category_news);
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    public function save($params)
    {
        $data = array(
            'name'          => $params['name'],
            'language_type' => (int)$params['language_type'],
            'page_title' => (!empty($params['page_title'])) ? $params['page_title'] : $params['name']
        );
        
        if(!empty($params['slug'])) {
            $data['slug']  = slug_convert($params['slug']);
        } else {
            $data['slug'] = slug_convert($params['name']);
        }
        
        if(!empty($params['keyword_seo'])) {
            $data['keyword_seo'] = $params['keyword_seo'];
        }
            
        if(!empty($params['position'])) {
            $data['position'] = $params['position'];
        }
        
        if(!empty($params['des_seo'])) {
            $data['des_seo'] = $params['des_seo'];
        }
        
        if(!empty($params['avatar'])) {
            $data['avatar'] = $params['avatar'];
        }
        
        if(!empty($params['title'])) {
            $data['title'] = $params['title'];
        }
        
        if (!empty($params['cat_news_id'])) {
            $data['update_user'] = $this->session->userdata('user_id');
            $data['update_date'] = date('Y-m-d H:i:s');
            $this->db->where('id', $params['cat_news_id']);
            
            return $this->db->update($this->_tbl_category_news, $data);
        } else {
            $data['create_user'] = $this->session->userdata('user_id');
            $data['create_date'] = date('Y-m-d H:i:s');
            $data['update_date'] = date('Y-m-d H:i:s');
            
            return $this->db->insert($this->_tbl_category_news, $data);
        }
            
    }
    
    public function getDetail($cat_news_id)
    {
        $data = array();
        $q = $this->db->select('*')
                ->where('id', $cat_news_id)
                ->get($this->_tbl_category_news);
        if ($q->num_rows() == 0) {
            return FALSE;
        }
        $data = $q->row_array();
        return $data;
    }
    
    public function del($cat_news_id)
    {
        $this->db->where('id', $cat_news_id);
        return $this->db->update($this->_tbl_category_news,array('del_flg' => 1));
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/14
     * check name category exist
     */
    public function checkExistName($name)
    {
        $this->db->select('id')
                ->where('name', $name)
                ->where('del_flg', 0);
        $query = $this->db->get($this->_tbl_category_news);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }    
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/14
     * check slug category exist
     */
    public function checkExistSlug($slug)
    {
        $this->db->select('id')
                ->where('slug', $slug)
                ->where('del_flg', 0);
        $query = $this->db->get($this->_tbl_category_news);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
        
    }
}


