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
    public function getDetail($product_id)
    {
        $sql = "(
                    SELECT
                            p.*,
                            pi. NAME AS pro_img,CASE WHEN p.id THEN '1' END AS p_product
                    FROM
                            d_product AS p
                    LEFT JOIN d_product_image AS pi ON p.id = pi.product_id
                    LEFT JOIN d_product_customer AS pcus ON pcus.product_id = p.id
                    WHERE
                            p.id = ?
                    AND p.del_flg = 0
                )
                UNION ALL
                (
                    SELECT
                            p.*,
                            pi. NAME AS pro_img,NULL
                    FROM
                            d_product_coordinator AS pc
                    INNER JOIN d_product AS p ON p.product_code = pc.product_code
                    LEFT JOIN d_product_image AS pi ON p.id = pi.product_id
                    WHERE
                            pc.product_id = ?
                    AND p.del_flg = 0
                )";
        $query = $this->db->query($sql, array($product_id, $product_id));
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    /**
     * Get customer choose product
     */
    public function getCustomerChooseProduct($product_id)
    {
        $sql ="SELECT
                    c.logo,
                    c.url,
                    c.`name`
            FROM
                    d_partners AS c
            INNER JOIN d_product_customer AS pc ON pc.customer_id = c.id
            AND pc.product_id = ? WHERE c.del_flg = 0";
        $query = $this->db->query($sql, array($product_id));
        if($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
}