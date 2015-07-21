<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author hnguyen0110@gmail.com
 * @date 2015/07/18
 * Home model
 */
class Category_news_model extends MY_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getCatNewsShowPage($language = LANG_VN)
    {
        $sql = "SELECT
                        nc.`name`,
                        nc.slug,
                        nc.position,
                        nc.title
                FROM
                        d_news_category AS nc
                WHERE
                        nc.del_flg = 0
                AND nc.language_type = ?";
        $query = $this->db->query($sql, array($language));
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
}