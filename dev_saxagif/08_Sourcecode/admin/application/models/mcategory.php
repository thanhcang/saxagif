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
    
    /**
     * get lisst category 
     * @return boolean
     */
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
    
    /**
     * get list category parent
     * @return boolean
     */
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
    public function addChildCategory($params , $parent)
    {
        $data = array(
            'name'          => $params['name'],
            'is_home'       => !empty($params['is_home']) ? 1 : 0 ,
            'slug'          => !empty($params['slug']) ? slug_convert($params['slug']) : slug_convert($params['name']) ,
            'bg_color'      => !empty($params['bg_color']) ? $params['bg_color'] : '' ,
            'language_type' => (int)$params['language_type'],
            'parent'        => $parent,
            'note'          => !empty($params['note']) ? $params['note'] : '' ,
            'create_user'   => $this->_login_user,
            'create_date'   => date('Y-m-d H:i:s'),
            'level'         =>  $params['parent_level'] +1,
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
                ->where('del_flg', 0)
                ->get($this->_tbl_category);
        if ($q->num_rows() == 0) {
            return FALSE;
        }
        $data = $q->row_array();
        return $data;
    }
    
    /**
     * get detail category
     * @param type $cat_id
     * @param type $parent
     * @return boolean
     */
    public function getDetailTypeCategory($cat_id)
    {
        $where = array($cat_id);
        $sql =  "SELECT
                        *
                FROM
                        d_category AS c
                WHERE
                        c.del_flg = 0
                AND (c.type = 1 )
                AND ( id = ?)
                ";
        $query = $this->db->query($sql, $where);
        
        if ( $query->num_rows() > 0 ){
            return $query->row_array();
        }
        return FALSE;
    }
    
    /**
     * delete catetegory
     * @param type $cat_id
     * @return type
     */
    public function delCat($cat_id)
    {
        if (empty($cat_id)){
            return FALSE;
        }
        
        $where = array($cat_id, $cat_id);

        $sql = "UPDATE
                    d_category
                SET del_flg = 1
                WHERE
                   parent = ?
                OR id = ?";
        $this->db->query($sql, $where);
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
     * @author hnguyen0110@gmail.com
     * @date 2015/06/14
     * @param string $name
     * @param int $catId
     * @return boolean
     */
    public function checkExistName($name , $catId = FALSE)
    {
        $this->db->select('id')
                ->where('name', $name)
                ->where('del_flg', 0);
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
                ->where('slug', $slug)
                ->where('del_flg', 0);
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
                AS c 
                WHERE 
                        c.del_flg = 0 
                        AND c.parent <> 0
                        AND parent = ?
                        ";
        if (!empty($param['language_type'])){
            $sql .= " AND language_type = ?";
            $arr_where[] = $param['language_type'];
        } else {
            $sql .= " AND language_type = 1" ;            
        }
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
     * add parent category
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
            'event_img' => !empty($param['event_img']) ? $param['event_img'] : '' ,
            'note' => !empty($param['note']) ? $param['note'] : '' ,
            'price' => !empty($param['price']) ? $param['price'] : '' ,
            'level' => 1,
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
          'keyword_seo' => htmlspecialchars($param['keyword_seo']),  
          'des_seo' => htmlspecialchars(($param['des_seo'])),  
          'is_home' => !empty($param['is_home']) ? $param['is_home'] : 0,  
          'slug' => !empty($param['name']) ? slug_convert($param['slug']) : slug_convert($param['name']),  
          'note' => !empty($param['note']) ? htmlspecialchars($param['note']) : '',  
        );
        if (!empty($param['event_img'])){
            $data['event_img'] = $param['event_img'];
        }
        $this->db->where($where);
        $this->db->update($this->_tbl_category, $data);
    }
    
    /**
     * get data child category
     * @param type $id
     * @return boolean
     */
    public function viewChildCategory($id) {
        $this->db->select('p.id,p.name,p.logo,p.bg_color,p.language_type,p.keyword_seo,p.des_seo,p.position,t.name as parent_name');
        $this->db->where('p.id', $id);
        $this->db->join('d_category as t', 'p.parent = t.id', 'inner');
        $query =$this->db->get('d_category as p');
        
        if ($query->num_rows() > 0){
            return $query->row_array();
        }
        return FALSE;
    }
    
    /**
     * update child category
     * @param type $param
     * 
     */
    public function updateChildCategory($param) {
        $where = array(
            'id' => $param['id']
        );
        
        $data = array(
            'name' => htmlspecialchars($param['name']),
            'slug' => !empty($param['slug']) ? slug_convert($param['slug']) : slug_convert($param['name']),
            'bg_color' => htmlspecialchars($param['bg_color']),
            'keyword_seo' => htmlspecialchars($param['keyword_seo']),
            'des_seo' => htmlspecialchars($param['des_seo']),
            'note' => htmlspecialchars($param['note']),
            'is_home' => !empty($param['is_home']) ? $param['is_home'] : 0,
//            'parent' => $param['parent'],
        );
        if (!empty($param['logo'])){
            $data['logo'] = htmlspecialchars($param['logo']);
        }
        
        $this->db->where($where);
        $this->db->update('d_category', $data);
    }
    
    /**
     * get data child category by type
     * @param int $type
     * @return boolean
     */
    public function getChildCategoryByType($type) {
        $where = array();
        if ($type == 1){
            $sql = "SELECT
                        p.`name`,
                        c.`name` AS child_name,
                        c.id ,
                        c.level 
                    FROM
                          d_category c
                    INNER JOIN d_category AS p ON c.parent = p.id
                    where c.del_flg = 0 and p.del_flg = 0
                    ";
        } else {
            $sql = "SELECT
                        c.`name`,
                        c.id ,
                        c.level
                    FROM
                       d_category c
                       where c.type = ? and c.del_flg = 0   
                    ";
            $where[] = $type;
        } 
        
        if ( !empty($sql)){
            $query= $this->db->query($sql, $where);
            if ($query->num_rows() > 0){
                return $query->result_array();
            }
        }
        
        return FALSE;
    }

}
