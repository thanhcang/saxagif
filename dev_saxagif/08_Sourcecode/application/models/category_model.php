<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    public function listAll() {
        $this->db->select('id, name, parent')
                ->where('del_flg', 0);
        $query = $this->db->get($this->_tbl_category);
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }

    /**
     * get category by type
     * @param type $type
     * @param type $gift
     * @param type $language
     * @return boolean
     */
    public function getCategoryByType($type, $gift = FALSE, $language = LANG_VN) {
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

        if ($gift) {
            $sql_str .= " AND c.is_home = 1";
            $sql_str .= " AND c.language_type = ? ORDER BY c.update_date DESC";
        } else {
            $sql_str .= " AND c.is_home = 0";
            $sql_str .= " AND c.language_type = ? ORDER BY c.id ASC";
        }

        if ($gift) {
            $sql_str .= " LIMIT 4 ";
        }
        $query = $this->db->query($sql_str, array($type, $language));
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    public function getCategoryProduct($type = IS_CATEGORY) {
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
    public function getProductByCategory($slug, &$rank, $language = LANG_VN) {
        //Get category parent:
        $result_cate = array();
        $sql = "SELECT c.id,c.level, c.type FROM d_category AS c WHERE c.slug = ? AND del_flg = 0 LIMIT 1";
        $query = $this->db->query($sql, array($slug));
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $result_cate = $query->row_array();
            $cat_id = $result_cate['id'];
            $level = $result_cate['level'];
            $type = $result_cate['type'];
            if ($level == 3 && $type == IS_CATEGORY) {
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
                                c.id = ? AND c.language_type = ?
                        GROUP BY
                                p.id
                        ORDER BY
                                p.update_date,
                                pi.create_date";
                $query = $this->db->query($sql, array($cat_id, $language));
            } elseif ($level != 3 && $type == IS_CATEGORY) {
                // Set rank = 1: Category parent:
                $rank = CATEGORY_PARENT;

                $sql = 'SELECT p.name as parent_name,t_child.*, p.note
                        FROM d_category as p
                        INNER JOIN 
                        (
                        SELECT c.name as child_name, c.slug as child_slug, s.slug as product_slug ,s.id as pro_id , c.logo, c.parent,c.id AS child_id,pi.name AS product_img, s.name AS product_name
                        FROM  d_category as c 
                        INNER JOIN  d_product as s ON c.id  = s.cat_id AND s.del_flg = 0
                        INNER JOIN d_product_image AS pi ON s.id = pi.product_id
                        WHERE c.del_flg =0 AND c.parent = ? AND c.language_type = ?
                        GROUP BY s.id
                        ORDER BY c.update_date

                        ) as t_child ON t_child.parent = p.id
                        ORDER BY child_name ';
                $query = $this->db->query($sql, array($cat_id, $language));
            } elseif ($type == IS_GIFT) {
                $rank = IS_GIFT;
                $sql = "SELECT
                                p.*, c.id AS category_id, c.type, c.name AS category_name, c.slug as category_slug, pi.name AS product_img
                        FROM
                                d_product AS p
                        INNER JOIN d_product_image AS pi ON p.id = pi.product_id
                        INNER JOIN d_category AS c ON c.id = p.cat_id
                        AND c.type = ?
                        AND c.del_flg = 0
                        AND c.slug = ?
                        WHERE
                            p.del_flg = 0 AND c.language_type = ?
                        GROUP BY p.id
                        ORDER BY c.id ASC";
                $query = $this->db->query($sql, array($type, $slug, $language));
            }
            // cangtv add code 20150822
            // process event 
            // @type = 2
            // @parent = 0
            // @level = 1
            else if ($type == 2) {
                $rank = 4;
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
                        INNER JOIN d_product AS p ON c.id = p.cat_id
                        INNER JOIN d_product_image AS pi ON p.id = pi.product_id
                        WHERE
                                c.id = ? AND c.language_type = ?
                        GROUP BY
                                p.id
                        ORDER BY
                                p.update_date,
                                pi.create_date";
                $query = $this->db->query($sql, array($cat_id, $language));
            }
        }
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }

    /**
     * get position category
     * @param type $slug
     * @return boolean
     */
    public function getPositionCategory($slug) {
        $sql = "SELECT z.rank FROM (
                    SELECT c.slug , @rownum := @rownum + 1 AS rank
                    FROM d_category AS c, (SELECT @rownum := 0) r
                                WHERE c.parent = 0 AND c.type = 1
                    ORDER BY c.id
                ) as z
                WHERE
                z.slug = ?";

        $query = $this->db->query($sql, array($slug));

        if ($query->num_rows() == 0) {
            return FALSE;
        }

        return $query->row_array();
    }

    /**
     * get detail present
     * @param type $slug
     * @param type $language
     * @return boolean
     */
    public function getDetailPresent($slug, $language = LANG_VN) {
        $this->db->select('note, des_seo, keyword_seo');
        $query = $this->db->where('slug', $slug);
        $query = $this->db->where('language_type', $language);
        $query = $this->db->get('d_category');

        if ($query->num_rows() == 0) {
            return FALSE;
        }

        return $query->row_array();
    }

}
