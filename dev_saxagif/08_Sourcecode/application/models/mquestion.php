<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mquestion extends MY_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * get list qa
     * @param type $language
     * @return boolean
     */
    public function listQa($language = LANG_VN) {
        $this->db->select('customer_name,question,answer, logo');
        $this->db->where('del_flg', 0);
        $this->db->where('language_type', $language);
        $this->db->order_by('update_date', 'DESC');
        
        $query = $this->db->get('d_customer_question');
        
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        return FALSE;
    }
    
    /**
     * get list qa
     * @param type $language
     * @return boolean
     */
    public function listQaHaveAnwser($language = LANG_VN) {
        $sql = "SELECT
                        customer_name,question,answer, logo
                FROM
                        d_customer_question
                WHERE
                        answer <> ''
                AND language_type = ?
                AND del_flg = 0
                ORDER BY
                        update_date DESC";
        $query = $this->db->query($sql , array($language));
        
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        return FALSE;
    }
    
    /**
     * send mail
     * @param type $param
     * @return boolean
     */
    public function sendQuestion($param) {
        $data = array(
            'customer_name' => htmlspecialchars($param['customer_name']) ,
            'customer_email' => htmlspecialchars($param['customer_email']),
            'question' => htmlspecialchars($param['question'])
        );
        $this->db->insert('d_customer_question', $data);
        
        $this->db->trans_off();
        $this->db->trans_begin();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }
    /**
     * get CoOperate
     * @param type $language
     * @return boolean
     */
    public function getCoOperate($language = LANG_VN) {
        $sql = "SELECT
                        n.title , n.avatar , n.slug , n.description
                FROM
                        d_news AS n
                INNER JOIN d_news_category AS c ON c.id = n.id_news_cat
                AND c.slug = 'hop-tac'
                AND n.language_type = ? AND n.del_flg = 0
                ";
        
        $query = $this->db->query($sql, array($language));
        
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        return FALSE;
    }
}