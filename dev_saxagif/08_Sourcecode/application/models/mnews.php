<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mnews extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * list story saxa
     * @param int $language
     * @return boolean
     */
    public function listStorySaxa($language = LANG_VN) {
        $sql = "SELECT
                        n.id,n.title, n.content, n.keyword_seo , n.des_seo
                FROM
                        d_news AS n
                INNER JOIN d_news_category AS c ON n.id_news_cat = c.id
                AND c.slug LIKE '%chung-toi-la-ai-cau-chuyen-ve-saxa%'
                WHERE n.language_type = ?
                ORDER BY n.update_date ASC";

        $query = $this->db->query($sql, array($language));

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return FALSE;
    }

    /**
     * list story saxa
     * @param int $language
     * @return boolean
     */
    public function listYourSay($type, $language = LANG_VN) {
        $sql = "SELECT
                    n.id, n.name,n.comment, n.logo
                FROM
                    d_yoursay AS n
                WHERE n.language_type = ?
                AND type = ?
                ";

        $sql .= " ORDER BY n.update_date ASC";

        if ($type == 1) {
            $sql .= ' LIMIT 4 ';
        } else {
            $sql .= ' LIMIT 3 ';
        }

        $query = $this->db->query($sql, array($language, $type));

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }

    /**
     * detail story saxa
     * @param int $language
     * @return boolean
     */
    public function detailYourSay($id) {
        $sql = "SELECT
                    n.name,n.comment, n.logo
                FROM
                    d_yoursay AS n
                WHERE id = ?
                ";

        $query = $this->db->query($sql, array($id));

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return FALSE;
    }
    
    /**
     * list another say
     * @param int $language
     * @return boolean
     */
    public function anotherSay($id) {
        $sql = "SELECT
                    n.id , n.logo
                FROM
                    d_yoursay AS n
                WHERE id <> ?
                ORDER BY rand()
                LIMIT 4
                ";

        $query = $this->db->query($sql, array($id));

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }
    
    /**
     * list we are do
     * @param int $language
     * @return boolean
     */
    public function listWeareDo($language = LANG_VN) {
        $sql = "SELECT
                    n.id,
                    n.title ,
                    n.slug,
                    n.avatar, 
                    n.description
                FROM
                    d_news AS n
                INNER JOIN d_news_category AS c ON n.id_news_cat = c.id
                AND c.del_flg = 0
                AND c.slug LIKE '%chung-toi-lam-duoc-gi-cho-ban'
                AND c.language_type = ? 
                WHERE
                    n.del_flg = 0 
                ";

        $query = $this->db->query($sql, array($language));

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }
    
    /**
     * detai master news category
     * @param int $language
     * @return boolean
     */
    public function detailMasterWeareDo($language = LANG_VN) {
        $sql = "SELECT
                        title,
                        des_seo,
                        keyword_seo
                FROM
                        d_news_category
                WHERE
                        slug LIKE '%chung-toi-lam-duoc-gi-cho-ban'
                AND language_type = ? 
                AND del_flg = 0 ";

        $query = $this->db->query($sql, array($language));

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return FALSE;
    }
    
    /**
     * detail we are do
     * @param int $language
     * @return boolean
     */
    public function detailWearedo($id) {
        $sql = "SELECT
                        n.id,
                        n.slug,
                        n.title,
                        n.content
                FROM
                        d_news AS n
                WHERE   (n.id = ? OR n.slug = ?)
                ";

        $query = $this->db->query($sql, array($id, $id));

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return FALSE;
    }
    
    /**
     * another we are do
     * @param int $language
     * @return boolean
     */
    public function anotherWearedo($id , $language = LANG_VN) {
        $sql = "
                SELECT
                    n.id,
                    n.title                    
                FROM
                    d_news AS n
                INNER JOIN d_news_category AS c ON n.id_news_cat = c.id
                AND c.del_flg = 0
                AND c.slug LIKE '%chung-toi-lam-duoc-gi-cho-ban'
                AND c.language_type = ? 
                WHERE
                    n.del_flg = 0
                    AND n.id <> ?
                ORDER BY rand()
                LIMIT 10
                ";

        $query = $this->db->query($sql, array( $language,$id ));

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }
    
    /**
     * list we expect from you
     * @param int $language
     * @return boolean
     */
    public function listWeaExpect($language = LANG_VN) {
        $sql = "SELECT
                    n.id,
                    n.title , 
                    n.content
                FROM
                    d_news AS n
                INNER JOIN d_news_category AS c ON n.id_news_cat = c.id
                AND c.del_flg = 0
                AND c.slug LIKE '%chung-toi-mong-doi-gi-o-ban'
                AND c.language_type = ? 
                WHERE
                    n.del_flg = 0
                ORDER BY n.update_date DESC
                LIMIT 1    
                ";

        $query = $this->db->query($sql, array($language));

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return FALSE;
    }
    
    /**
     * get all list salse
     * @param type $param
     * @return boolean
     */
    public function listSalse() {
        $query = $this->db->get('d_sale_service');
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }
    
    /**
     * show list idea customer
     * @param type $language
     */
    public function listIdeaCustomer($language = LANG_VN) {
        $this->db->where('language_type' , $language);
        $query = $this->db->get('d_idea_customer');
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
        
    }
    
    /**
     * get event saxa
     * @param type $language
     */
    public function listEventSaxa($language = LANG_VN) {
        $sql = 'SELECT
                        n.id,
                        n.description,
                        n.content,
                        n.avatar,
                        n.keyword_seo,
                        n.des_seo,
                        n.title,
                        n.slug
                FROM
                        d_news AS n
                INNER JOIN d_news_category AS c ON c.id = n.id_news_cat
                AND c.slug = "chuong-trinh-cua-saxa" AND c.del_flg = 0
                WHERE n.del_flg = 0
                AND n.language_type = ?
                ORDER BY
                        n.update_date DESC
                ';
        
        $query = $this->db->query($sql, $language);
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }

    /**
     * get partner saxa
     * @param int $language
     * @param int $limit
     * @param int $total
     * @return boolean
     */
    public function listPartnerSaxa($language = LANG_VN, $limit = true, &$total) {
        $this->db->where('language_type' , $language);
        $this->db->where('del_flg' , 0);
        
        if ($limit == TRUE){
            $this->db->limit(21 , 0);
        }
        
        $query = $this->db->get('d_partners');
        $total = $this->db->count_all_results();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }
    
    /**
     * another event saxa
     * @param int $language
     * @return boolean
     */
    public function anotherEventSaxa($id , $language = LANG_VN) {
        $sql = "
                SELECT
                    n.id,
                    n.title                    
                FROM
                    d_news AS n
                INNER JOIN d_news_category AS c ON n.id_news_cat = c.id
                AND c.del_flg = 0
                AND c.slug LIKE '%chuong-trinh-cua-saxa'
                AND c.language_type = ? 
                WHERE
                    n.del_flg = 0
                    AND n.id <> ?
                ORDER BY rand()
                LIMIT 10
                ";

        $query = $this->db->query($sql, array( $language,$id ));

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }
}
