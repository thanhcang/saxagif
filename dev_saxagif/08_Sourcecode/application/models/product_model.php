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
     * Get product by category
     */
    public function getProductByCategory($slug)
    {
        $sql = 'SELECT p.name as parent_name,t_child.*, p.note
                FROM d_category as p
                INNER JOIN 
                (
                SELECT c.name as child_name, c.slug as child_slug, s.slug as product_slug , c.logo, c.parent,c.id AS child_id,pi.name AS product_img, s.name AS product_name
                FROM  d_category as c 
                INNER JOIN  d_product as s ON c.id  = s.cat_id AND s.del_flg = 0
                INNER JOIN d_product_image AS pi ON s.id = pi.product_id
                WHERE c.del_flg =0 AND c.parent = 15
                GROUP BY s.id
                ORDER BY c.update_date

                ) as t_child ON t_child.parent = p.id
                ORDER BY child_name ';
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
}