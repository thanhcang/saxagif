<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/06/07
 */
class Mcategory extends MY_Model
{
    var $_login_user;
    public function __construct() {
        parent::__construct();
        $this->_login_user = $this->session->userdata('user_id');
    }
    
    public function search($params, &$total, $offset = 0, $limit = 0, $catType = '')
    {
        $arr_where = array();
        $sql = "SELECT
                        c.id,
                        c.name,
                        c.logo,
                        c.slug,
                        c.bg_color,
                        c.language_type,
                        c.parent,
                        c.keyword_seo,
                        c.des_seo
                FROM " . $this->_tbl_category . "
                AS c WHERE 
                        c.del_flg = 0 
                        AND c.parent = 0";
        
        if(isset($catType)) {
            $sql .= " AND c.is_gift = ?";
            $arr_where[] = $catType;
        }
        
        if(!empty($params['language_type'])) {
            $language = (int)$params['language_type'];
            $sql .= " AND c.language_type = ?";
            $arr_where[] = $language;
        }
        
        if (!empty($params['cat_id'])) {
            $catId = $params['cat_id'];
            $sql .= " AND c.id = ?";
            $arr_where[] = $catId;
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
        $this->db->select('id, name, parent')
                ->where('del_flg', 0);
        $query = $this->db->get($this->_tbl_category);
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
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
    
    /**
     * add children category
     * @param type $params
     * @return type
     */
    public function create($params , $parent)
    {
        $data = array(
            'name'          => $params['name'],
            'slug'          => !empty($params['slug']) ? slug_convert($params['slug']) : slug_convert($params['name']) ,
            'bg_color'      => !empty($params['bg_color']) ? $params['bg_color'] : '' ,
            'language_type' => (int)$params['language_type'],
            'parent'        => $parent,
            'create_user'   => $this->_login_user,
            'create_date'   => date('Y-m-d H:i:s'),
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
        return $this->db->insert($this->_tbl_category, $data);   
    }
    
    /**
     * get detail category
     * @param type $cat_id
     * @param type $parent
     * @return boolean
     */
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
    
    /**
     * delete catetegory
     * @param type $cat_id
     * @return type
     */
    public function delCat($cat_id)
    {
        $this->db->where('id', $cat_id);
        return $this->db->update($this->_tbl_category,array('del_flg' => 1));
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/14
     * @param string $name
     * @param int $catId
     * @return boolean
     */
    public function checkExistName($name , $catId = FALSE)
    {
        $this->db->select('id')
                ->where('name', $name);
        if (!empty($catId)){
            $this->db->where('id <> ',$catId);
        }
        $query = $this->db->get($this->_tbl_category);
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
    public function checkExistSlug($slug, $catId = FALSE)
    {
        $this->db->select('id')
                ->where('slug', $slug);
        if (!empty($catId)){
            $this->db->where('id <> ',$catId);
        }
        $query = $this->db->get($this->_tbl_category);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
        
    }
    
    /**
     * get all list category
     * @param array $param
     * @param int $total
     * @param int $offset
     * @param int $limit
     * @return boolean
     */
    public function listAllCategory($param, &$total, $offset = 0, $limit = 0) {
        $arr_where = array();
        $sql = "SELECT
                        c.id,
                        c.name,
                        c.logo,
                        c.slug,
                        c.bg_color,
                        c.language_type,
                        c.parent,
                        c.keyword_seo,
                        c.des_seo,
                        c.type,
                        is_home
                FROM " . $this->_tbl_category . "
                AS c WHERE 
                        c.del_flg = 0 
                        AND c.parent = 0";
        if (!empty($param['sLanguageType'])) {
            $language = (int) $param['sLanguageType'];
            $sql .= " AND c.language_type = ?";
            $arr_where[] = $language;
        }
        if (!empty($param['sCatId'])) {
            $catId = $param['sCatId'];
            $sql .= " AND c.id = ?";
            $arr_where[] = $catId;
        }
        if (!empty($param['sType'])) {
            $type = $param['sType'];
            $sql .= " AND c.type = ?";
            $arr_where[] = $type;
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
    
    /**
     * getl all children category
     * @param array $param
     * @param int $total
     * @param int $offset
     * @param int $limit
     * @param int $parent
     * @return boolean
     */
    public function listAllChildrenCategory($param, &$total, $offset = 0, $limit = 0, $parent) {
        $arr_where = array(
            $parent,
        );
        $sql = "SELECT
                        c.id,
                        c.name,
                        c.logo,
                        c.slug,
                        c.bg_color,
                        c.language_type,
                        c.parent,
                        c.keyword_seo,
                        c.des_seo,
                        c.type,
                        is_home
                FROM " . $this->_tbl_category . "
                AS c WHERE 
                        c.del_flg = 0 
                        AND c.parent <> 0
                        AND parent = ?
                        ";
        $total = MY_Model::get_total_result($sql, $arr_where);
        if ($limit > 0) {
            $sql .= ' LIMIT ' . $offset . ',' . $limit;
        }
        $query = $this->db->query($sql, $arr_where);
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    /**
     * 
     * @param type $param
     */
    public function addParentCategory($param) {
        $data = array(
            'language_type' => $param['language_type'],
            'name' => html_escape($param['name']),
            'type' => $param['type'],
            'is_home' => !empty($param['is_home']) ? $param['is_home'] : 0 ,
            'slug' => !empty($param['slug']) ? slug_convert($param['slug']) : slug_convert($param['name']) ,
            'keyword_seo' => !empty($param['keyword_seo']) ? html_escape($param['keyword_seo']) : '',
            'des_seo' => !empty($param['des_seo']) ? html_escape($param['des_seo']) : '',
            'create_user' => $this->_login_user,
            'create_date' => date('Y-m-d H:i:s'),
        );
        $this->db->insert($this->_tbl_category, $data);
    }
    
    /**
     * update category
     * @param type $param
     */
    public function updateCategory($param) {
        $where = array(
            'id' => $param['id'],
        );
        $data = array(
          'name' => $param['name'],  
          'keyword_seo' => $param['keyword_seo'],  
          'des_seo' => $param['des_seo'],  
          'is_home' => !empty($param['is_home']) ? $param['is_home'] : 0,  
          'slug' => !empty($param['name']) ? slug_convert($param['slug']) : slug_convert($param['name']),  
        );
        $this->db->where($where);
        $this->db->update($this->_tbl_category, $data);
    }

}


