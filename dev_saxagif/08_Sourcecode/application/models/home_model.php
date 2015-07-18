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
    
    
}