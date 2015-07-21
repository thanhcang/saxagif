<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/06/14
 */
class Mproduct extends MY_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 
     * @author hnguyen0110@gmail.com
     * @date 2015/06/14
     * List all product
     */
    public function listAll($params, &$total, $offset = 0, $limit = 0)
    {
        $arrWhere = array();
        $sql = "SELECT 
                    p.id,
                    p.product_code,
                    p.name,
                    p.price,
                    p.description,
                    p.content,
                    p.book_limit,
                    p.delivery_days,
                    p.cat_id,
                    p.language_type,
                    p.keyword_seo,
                    p.des_seo,
                    p.slug,
                    p.view,
                    p.promotion,
                    c.name AS category_name
                FROM " . $this->_tbl_product . " AS p
                INNER JOIN " . $this->_tbl_category . " AS c ON p.cat_id = c.id
                WHERE p.del_flg = 0
                ORDER BY p.id DESC";
        
        $total = MY_Model::get_total_result($sql);
        
        if ($limit > 0) {
            $sql .= " LIMIT " . $offset . ',' . $limit;
        }
        $query = $this->db->query($sql, $arrWhere);
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/14
     * @param type $params
     * @return type
     * Create new and update product
     */
    public function create($params)
    {
        $this->db->trans_start();
        $proId = '';
        $data = array(
            'product_code'      => htmlspecialchars($params['product_code']),
            'name'              => htmlspecialchars($params['name']),
            'price'             => (!empty($params['price'])) ? $params['price'] : 0,
            'description'       => (!empty($params['description'])) ? $params['description'] : '',
            'content'           => (!empty($params['content'])) ? $params['content'] : '',
            'book_limit'        => (!empty($params['book_limit'])) ? $params['book_limit'] : '',
            'delivery_days'     => (!empty($params['delivery_days'])) ? $params['delivery_days'] : '',
            'slug'              => !empty($params['slug']) ? slug_convert($params['slug']) : slug_convert($params['name']) ,
            'cat_id'            => $params['catname'],
            'language_type'     => (int)$params['language_type'],
            'keyword_seo'       => (!empty($params['keyword_seo'])) ? $params['keyword_seo'] : '',
            'des_seo'           => (!empty($params['des_seo'])) ? $params['des_seo'] : '',  
        );
        if (!empty($params['promotion'])) {
            $data['promotion'] = $params['promotion'];
        }
        
        if (!empty($params['product_id'])) {
            $data['update_user'] = $this->session->userdata('ses_user_id');
            $data['update_date'] = date('Y-m-d H:i:s');
            $this->db->where('id', (int)$params['product_id']);
            if($this->db->update($this->_tbl_product, $data)) {
                $proId = (int)$params['product_id']; 
            }
            
        } else {
            $data['create_user'] = $this->session->userdata('ses_user_id');
            $data['create_date'] = date('Y-m-d H:i:s');
            if($this->db->insert($this->_tbl_product, $data)){
                $proId = $this->db->insert_id();
            }
        }
        
        // insert image product
        if (!empty($proId)) {
            if(!empty($params['name_image'])) {
                foreach ($params['name_image'] as $imageName) {
                    $data = array(
                        'name' => $imageName,
                        'product_id' => $proId,
                        'create_user' => $this->session->userdata('ses_user_id'),
                        'create_date' => date('Y-m-d H:i:s'),
                    );
                    $this->db->insert($this->_tbl_product_image, $data);
                }
            }
        }
        
        // insert d_product_coordinator
        if (!empty($proId)) {
            if(!empty($params['pro_distribution'])) {
                foreach ($params['pro_distribution']  as $value) {
                    $data = array(
                        'product_id' => $proId,
                        'product_code' => $value,
                        'create_user' => $this->session->userdata('ses_user_id'),
                        'create_date' => date('Y-m-d H:i:s'),
                    );
                    $this->db->insert('d_product_coordinator', $data);
                }
            }
        }
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_complete();
            return TRUE;
        }
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/14
     * @param type $proId
     * Detail product
     */
    public function detail($proId)
    {
        $data = array();
        $arrWhere = array();
        $sql = "SELECT 
                    p.id,
                    p.product_code,
                    p.name,
                    p.price,
                    p.description,
                    p.content,
                    p.book_limit,
                    p.delivery_days,
                    p.cat_id,
                    p.language_type,
                    p.keyword_seo,
                    p.des_seo,
                    p.slug,
                    p.view,
                    p.pro_distribution,
                    p.promotion,
                    c.name AS category_name
                FROM " . $this->_tbl_product . " AS p
                INNER JOIN " . $this->_tbl_category . " AS c ON p.cat_id = c.id
                WHERE p.del_flg = 0 AND p.id = ?
                LIMIT 1";
        $arrWhere[] = $proId;
        $query = $this->db->query($sql, $arrWhere);
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        $data = $query->row_array();
        if (!empty($data)) {
            
            // Get images product
            $sql = "SELECT
                            pi.name
                    FROM
                            " . $this->_tbl_product_image . " AS pi
                    WHERE
                            pi.del_flg = 0
                    AND pi.product_id = ?";
            $query = $this->db->query($sql, array($proId));
            if($query->num_rows() > 0 ) {
                $data['product_image'] = $query->result_array();
            }
            
            // get giftset product
            if (!empty($data['pro_distribution'])) {
                $proCodes = "'" . $data['pro_distribution'] . "'";
                $proCodes = str_replace(',', "','", $proCodes);
                //$proCodes = str_replace(' ', '', $proCodes);
                $sql = "SELECT
                                p.id,
                                p.product_code,
                                p.name,
                                pi.name AS product_img
                        FROM
                                " . $this->_tbl_product . " AS p
                        LEFT JOIN " . $this->_tbl_product_image . " AS pi ON p.id = pi.product_id
                        WHERE
                                p.del_flg = 0
                        AND p.product_code IN ($proCodes)
                        AND p.id != ?
                        GROUP BY
                                p.id";
                $query = $this->db->query($sql, array($proId));
                //echo $this->db->last_query();
                if ($query->num_rows() > 0 ) {
                    $data['giftset'] = $query->result_array();
                }
                
            }
        }
        return $data;        
    }
    
    public function delPro($proId)
    {
        $this->db->where('id', $proId);
        return $this->db->update($this->_tbl_product, array('del_flg' => 1));
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/20
     * List promotion
     */
    public function listPromotion($proCode)
    {
        $arr_where = array();
        $sql = "SELECT
                        p.id,
                        p.product_code,
                        p.name
                FROM
                        " . $this->_tbl_product . " AS p
                WHERE
                        p.del_flg = 0
                AND p.product_code LIKE ?";
        $arr_where[] = '%' . trim($proCode) . '%';
        $query = $this->db->query($sql, $arr_where);
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->row_array();
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/14
     * check product code exist
     */
    public function checkExistCode($code)
    {
        $this->db->select('id')
                ->where('product_code', $code);
        $query = $this->db->get($this->_tbl_product);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }  
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/14
     * check name product exist
     */
    public function checkExistName($name)
    {
        $this->db->select('id')
                ->where('name', $name);
        $query = $this->db->get($this->_tbl_product);
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
                ->where('slug', $slug);
        $query = $this->db->get($this->_tbl_product);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
        
    }
    
    /**
     * get all product by name
     * @param string $name
     * @return boolean
     */
    public function getProductByName($name='') {
        $this->db->where('del_flg', 0);
        if (!empty($name)){
            $this->db->like('product_code', $name, 'after');
        }
        $query = $this->db->get($this->_tbl_product);
        
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        return FALSE;
    }
    
}