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
                        c.title
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
                        s.id,
                        s.sitename,
                        s.shortcut,
                        s.logo,
                        s.key_google,
                        s.des_google,
                        s.phone,
                        s.fax,
                        s.email,
                        s.address,
                        s.slogan,
                        s.language_type
                FROM
                        m_setting AS s
                WHERE
                        s.language_type = 1";
        $query = $this->db->query($sql, array($language));
        if ($query->num_rows() == 0 ) {
            return FALSE;
        }
        return $query->row_array();
    }
    
    public function getGift()
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
                GROUP BY
                        p.id";
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0 ) {
            return FALSE;
        }
        return $query->result_array();
    }
    
    public function getNewsByHome($position = '')
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
                AND n.is_home = 1";
        $query = $this->db->query($sql);
        if($query->num_rows() == 0) {
            return FALSE;
        }
        return $query->result_array();
    }
}