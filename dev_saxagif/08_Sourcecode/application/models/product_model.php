<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author hnguyen0110@gmail.com
 * @date 2015/0đuc
 * Home model
 */
class Product_model extends MY_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/07/25
     */
    public function getDetail($product_id = '', $slug = '')
    {
        $arr_where = array();
        $sql = "
                SELECT
                        id,name, price, description, content , book_limit , delivery_days
                FROM
                        d_product AS p
                WHERE p.del_flg = 0
                ";
        if (!empty($product_id)) {
            $sql .= " AND p.id = ? ";
            $arr_where[] = $product_id;
        }
        if (!empty($slug)) {
            $sql .= " AND p.slug = ? ";
            $arr_where[] = $slug;
        }
        $query = $this->db->query($sql, $arr_where);
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->row_array();
    }
    
    /**
     * Get customer choose product
     */
    public function getCustomerChooseProduct($product_id)
    {
        $sql ="SELECT
                    c.logo, c.url
            FROM
                    d_partners AS c
            INNER JOIN d_product_customer AS pc ON pc.customer_id = c.id
            AND pc.product_id = ? WHERE c.del_flg = 0 LIMIT 5";
        $query = $this->db->query($sql, array($product_id));
        if($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    /**
     * get Product Coordinator
     * @param type $product_id
     * @return boolean
     */
    public function getProductCoordinator($product_id)
    {
        $sql ="SELECT
                        i.`name`, c.id,c.slug
                FROM
                        (
                                SELECT
                                        p.id, p.slug
                                FROM
                                        d_product_coordinator AS c
                                INNER JOIN d_product AS p ON c.product_code = p.product_code
                                AND c.product_id = 3
                                AND p.del_flg = 0
                        ) AS c
                INNER JOIN (
                        SELECT
                                i.`name`,
                                i.product_id
                        FROM
                                d_product_image AS i
                        GROUP BY
                                i.product_id
                ) AS i ON i.product_id = c.id
                LIMIT 5
                ";
        $query = $this->db->query($sql, array($product_id));
        if($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    /**
     * get Product Coordinator
     * @param type $product_id
     * @return boolean
     */
    public function getImageProduct($product_id)
    {
        $sql ="SELECT
                        i.name
                FROM
                        d_product_image AS i
                INNER JOIN d_product AS p ON i.product_id = p.id
                WHERE
                    p.del_flg = 0 AND i.product_id = ? 
                    LIMIT 3";
        $query = $this->db->query($sql, array($product_id));
        if($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
}