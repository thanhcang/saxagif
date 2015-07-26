<?php

class MY_Model extends CI_Model {
    
    protected $_tbl_category = 'd_category';
    protected $_tbl_product = 'd_product';
    protected $_tbl_product_image = 'd_product_image';
    protected $_tbl_partners = 'd_partners';
    protected $_tbl_customer = 'd_customer';
    protected $_tbl_category_news = 'd_news_category';
    protected $_tbl_news = 'd_news';
    protected $_table_send_mail = 'd_send_mail';
    protected $_table_setting = 'm_setting';
            
    function __construct()
    {
        parent::__construct();
    }
    
    public function get_field_length($table_name){
        $data = array();

        if(!empty($table_name)){
                $sql  = 'SELECT COLUMN_NAME, CHARACTER_MAXIMUM_LENGTH
             FROM information_schema.columns
             WHERE table_schema = DATABASE()
             AND table_name = ?';

                $query = $this->db->query($sql, array($table_name));

                if ($query->num_rows() > 0){
                        foreach($query->result_array() as $key => $value){
                                $data[$value['COLUMN_NAME']] = $value['CHARACTER_MAXIMUM_LENGTH'];
                        }
        }
        }

        return $data;
    }
    
    function get_total_result($sql, $where = NULL){
        $total = 0;
        try {
            if($where){
                $query = $this->db->query($sql, $where);
            }else{
                $query = $this->db->query($sql);
            }
            if($query->num_rows() > 0){
                $total = $query->num_rows();
            }
        } catch (Exception $ex) {
            $total = 0;
        }
        return $total;
    }
    
    /**
     * check exits slug
     * @return boolean
     */
    public function checkSlug() {
        $slug = end($this->uri->segment_array());
        $this->db->where('slug', $slug);
        $query = $this->db->get('d_slug');
        
        if ($query->num_rows() > 0 ){
            return $query->row_array();
        }
        return FALSE;
    }
}