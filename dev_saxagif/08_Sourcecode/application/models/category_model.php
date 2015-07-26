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
    
    public function getCategoryByType($type, $gift = FALSE, $language = LANG_VN)
    {
        $sql_str = "SELECT
                            c.id,
                            c.`name`,
                            c.parent,
                            c.slug,
                            c.logo,
                            c.bg_color,
                            c.price
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
        $sql_str .= " AND c.language_type = ? ORDER BY c.id ASC";
        $query = $this->db->query($sql_str, array($type, $language));
        if ($query->num_rows() == 0 ) {
            return FALSE;
        }
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    
    public function getCategoryProduct($type = IS_CATEGORY)
    {
        $sql = "SELECT
                        p. NAME AS parent_name,
                        p.id AS id_parent,
                        c.id AS id_child,
                        c. NAME AS child_name
                FROM
                        d_category AS c
                INNER JOIN d_category AS p ON p.id = c.parent
                WHERE
                        p.del_flg = 0
                AND c.del_flg = 0 AND p.type = ?";
        $query = $this->db->query($sql, array($type));
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/07/25
     * Get product by category
     */
    public function getProductByCategory($slug, &$rank)
    {
        //Get category parent:
        $result_cate = array();
        $sql = "SELECT c.id,c.level FROM d_category AS c WHERE c.slug = ? AND del_flg = 0 LIMIT 1";
        $query = $this->db->query($sql, array($slug));
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $result_cate = $query->row_array();
            $cat_id = $result_cate['id'];
            $level = $result_cate['level'];
            if ($level == 3) {
                // Set rank = 2: category last child
                $rank = CATEGORY_CHILD;
                
                $sql = "SELECT
                                c.id AS cat_id,
                                c.name AS cat_name,
                                c.note,
                                c.slug AS slug_cat,
                                p.id AS pro_id,
                                p.name AS pro_name,
                                p.slug AS slug_pro,
                                pi.name AS pro_img
                        FROM
                                d_category AS c
                        LEFT JOIN d_product AS p ON c.id = p.cat_id
                        LEFT JOIN d_product_image AS pi ON p.id = pi.product_id
                        WHERE
                                c.id = ?
                        GROUP BY
                                p.id
                        ORDER BY
                                p.update_date,
                                pi.create_date";
                $query = $this->db->query($sql, array($cat_id));
                
            } else {
                // Set rank = 1: Category parent:
                $rank = CATEGORY_PARENT;
                        
                $sql = 'SELECT p.name as parent_name,t_child.*, p.note
                        FROM d_category as p
                        INNER JOIN 
                        (
                        SELECT c.name as child_name, c.slug as child_slug, s.slug as product_slug , c.logo, c.parent,c.id AS child_id,pi.name AS product_img, s.name AS product_name
                        FROM  d_category as c 
                        INNER JOIN  d_product as s ON c.id  = s.cat_id AND s.del_flg = 0
                        INNER JOIN d_product_image AS pi ON s.id = pi.product_id
                        WHERE c.del_flg =0 AND c.parent = ?
                        GROUP BY s.id
                        ORDER BY c.update_date

                        ) as t_child ON t_child.parent = p.id
                        ORDER BY child_name ';
                $query = $this->db->query($sql, array($cat_id));
            }
        }
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
}