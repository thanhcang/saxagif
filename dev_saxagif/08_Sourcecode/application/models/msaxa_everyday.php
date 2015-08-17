<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Msaxa_everyday extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * list data
     * @param type $slug
     * @return boolean
     */
    public function listData($slug) {
        $sql = "SELECT
                    n.*
            FROM
                    d_news_saxa_everyday AS n
            INNER JOIN d_saxa_everyday AS c ON n.id_news_cat = c.id
            AND c.slug = ?";

        $query = $this->db->query($sql, array($slug));

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }

    
    /**
     * list data
     * @param type $slug
     * @return boolean
     */
    public function listCategory($slug) {
        $sql = "
            SELECT
                    n.name, n.slug
            FROM
                    d_saxa_everyday AS n
            WHERE
            n.parent = 
            ( select parent from d_saxa_everyday  as c where c.slug = ?)
            ";

        $query = $this->db->query($sql, array($slug));

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }
    
    /**
     * list data
     * @param type $slug
     * @return boolean
     */
    public function listParent($slug) {
        $sql = "
            SELECT
                    n.name, n.slug , n.id
            FROM
                    d_saxa_everyday AS n
            WHERE
            n.id = 
            ( select parent from d_saxa_everyday  as c where c.slug = ?)
            ";

        $query = $this->db->query($sql, array($slug));

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return FALSE;
    }
    
    /**
     * list data
     * @param type $slug
     * @return boolean
     */
    public function detailSaxaEveryday($id) {
        $sql = "
            SELECT
                    n.title, n.slug , n.id , n.content
            FROM
                    d_news_saxa_everyday AS n
            WHERE n.id = ?
            ";

        $query = $this->db->query($sql, array($id));

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return FALSE;
    }
    
    /**
     * list data
     * @param type $slug
     * @return boolean
     */
    public function anotherSaxaEveryday($id) {
        $sql = "
            SELECT
                    n.title, n.id
            FROM
                    d_news_saxa_everyday AS n
            WHERE n.id <> ?
            ";

        $query = $this->db->query($sql, array($id));

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }
    
}
