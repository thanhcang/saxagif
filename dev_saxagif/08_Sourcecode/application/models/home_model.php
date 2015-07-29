<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author hnguyen0110@gmail.com
 * @date 2015/07/18
 * Home model
 */
class Home_model extends MY_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function setSendMail($mail, $customer_name)
    {
        $data = array(
            'email_address' => $mail,
            'customer_name' => $customer_name,
        );
        $checkEmail = $this->checkExistMail($mail);
        if($checkEmail) return FALSE;
        return $this->db->insert($this->_table_send_mail, $data);
    }
    
    public function checkExistMail($mail)
    {
        $this->db->select('id')
                ->where('email_address');
        $query = $this->db->get($this->_table_send_mail);
        if($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function getSlideShow($language = LANG_VN)
    {
        $sql = "(SELECT
                        c.id,
                        c.`name`,
                        c.slug,
                        c.event_img AS avatar,
                        c.note as title
                FROM
                        d_category AS c
                WHERE
                        c.del_flg = 0
                AND c.is_home = 1
                AND c.type = 2 AND c.language_type = ?)
                UNION
                (SELECT
                        nc.id,
                        nc.`name`,
                        nc.slug,
                        nc.avatar,
                        nc.title
                FROM
                        d_news_category AS nc
                WHERE
                        nc.del_flg = 0
                AND nc.position = 1 AND nc.language_type = ?) ORDER BY name";
        
        $query = $this->db->query($sql, array($language, $language));
        if ($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    /**
     * @author HoaHN<hnguyen0110@gmail.com>
     * @date 2015/07/19
     * Get setting show footer
     */
    public function getSettingFooter($language = LANG_VN)
    {
        $sql = "SELECT
                    s.*
                FROM
                        m_setting AS s
                WHERE
                        s.language_type = ?";
        $query = $this->db->query($sql, array($language));
        if ($query->num_rows() == 0 ) {
            return FALSE;
        }
        return $query->row_array();
    }
    
    public function getGift($language = LANG_VN)
    {
        $sql = "SELECT
                        p.id,
                        p.name AS product_name,
                        p.slug,
                        pi.name AS image_name
                FROM
                        d_product AS p
                INNER JOIN d_product_image AS pi ON p.id = pi.product_id
                WHERE
                        p.promotion = 1
                    AND p.language_type = ?
                GROUP BY
                        p.id";
        $query = $this->db->query($sql, array($language));
        if ($query->num_rows() == 0 ) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    public function getNewsByHome($position = '', $language = LANG_VN)
    {
        $sql = "SELECT
                        n.title,
                        n.description,
                        n.avatar,
                        n.id_news_cat,
                        n.language_type
                FROM
                        d_news AS n
                WHERE
                        n.del_flg = 0
                AND n.is_home = 1 AND language_type = ? AND n.id_news_cat = 20 ORDER BY n.id ASC";
        $query = $this->db->query($sql, array($language));
        if($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/07/24
     * get customer slide
     */
    public function getCustomer($language = LANG_VN)
    {
        $sql = "SELECT n.title,n.description,n.avatar,n.slug,n.id_news_cat
                FROM d_news AS n WHERE (n.id_news_cat = 21 || n.id_news_cat = 22 || n.id_news_cat = 17 )
                AND del_flg = 0 AND n.language_type = ? AND is_home = 1 ORDER BY n.id DESC";
        $query = $this->db->query($sql, array($language));
        if($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    /**
     * get category new by postiong
     * @param int $position
     * @param int $limit
     * @return boolean
     */
    public function getMenuPosition($position, $limit , $language = LANG_VN) {
        $this->db->where('position', $position);
        $this->db->where('language_type', $language);
        $this->db->select('title, name, avatar');
        $this->db->order_by('id','DESC');
        $this->db->limit($limit);
        
        $query = $this->db->get('d_news_category');
        
        if($query->num_rows() > 0 && $limit == 1) {
            return $query->row_array();
        } else if ($query->num_rows() > 0 && $limit > 1){
            return $query->result_array();
        }
        return FALSE ;
    }
    
    /**
     * get news by footer
     * @param type $cat_id
     * @param type $language
     * @return boolean
     */
    public function getArticleFooter($cat_id,$language = LANG_VN) {
        $where = array($cat_id , $language, $language);
        $sql = "SELECT
                        n.avatar, n.description , n.slug as slug , c.slug as category_slug
                FROM
                        d_news AS n
                INNER JOIN d_news_category AS c ON c.del_flg = 0
                AND c.id = n.id_news_cat
                AND c.id = ? AND c.language_type = ?
                WHERE n.language_type = ? AND n.avatar IS NOT NULL 
                ORDER BY
                        c.update_date
                " ;
        
        $query = $this->db->query($sql, $where);
        
        if($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE ;
    }
    
    /**
     * get new category by footer
     * @param type $language
     * @return boolean
     */
    public function getNewsCategroyFooter($position = 5, $language = LANG_VN) {
        $this->db->where('position', $position);
        $this->db->where('language_type', $language);
        $this->db->select('id,name,slug');
        $this->db->order_by('update_date','DESC');
        $this->db->limit(1);
        
        $query = $this->db->get('d_news_category');
        
        if($query->num_rows() > 0) {
            return $query->row_array();
        } 
        return FALSE ;
    }
}