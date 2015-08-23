<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Minspirational extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * get list parent 
     * @return boolean
     */
    public function listParent($language = LANG_VN) {
        $sql = "
                SELECT c.id , c.name as child_name , p.name as parent_name, p.id as parent_id , slug
                FROM 
                (
                SELECT id, `name` , parent , slug
                FROM d_saxa_everyday as e
                WHERE e.del_flg = 0
                AND e.`level` = 2
                AND e.language_type = ?
                ) as c
                INNER JOIN
                ( 
                SELECT id, `name`  
                FROM d_saxa_everyday as e
                WHERE e.del_flg = 0
                AND inspire = 1 
                AND e.language_type = ?
                ORDER BY update_date ASC 
                LIMIT 1
                ) as p
                ON c.parent = p.id ";
        
        $query = $this->db->query($sql, array($language, $language));
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }
    
    /**
     * get list aricle 
     * @param type $param
     */
    public function listChildAricle( $language = LANG_VN, $child_name = '' ) {
        $sql = "SELECT
                        e.title,
                        e.id,
                        e.avatar,
                        e.description,
                        e.content,
                        e.slug,
                        d.slug as parent_slug
                FROM
                        d_news_saxa_everyday AS e
                INNER JOIN d_saxa_everyday as d ON d.id = e.id_news_cat
                WHERE
                        e.language_type = ?
                AND e.id_news_cat = 
                (
                SELECT
                        id
                FROM
                        d_saxa_everyday
                WHERE
                        slug = ?
                )";
        $query = $this->db->query($sql, array($language, $child_name));
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }
    
    /**
     * get detail 
     * @param type $language
     * @param type $child_name
     * @return boolean
     */
    public function detail( $language = LANG_VN, $child_name = '' ) {
        $sql = "SELECT
                        e.title,
                        e.id,
                        e.avatar,
                        e.description,
                        e.content,
                        e.slug
                FROM
                        d_news_saxa_everyday AS e
                WHERE
                        e.language_type = ?
                AND 
                slug = ?";
        $query = $this->db->query($sql, array($language, $child_name));
        
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return FALSE;
    }
}