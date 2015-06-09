<?php

class MY_Model extends CI_Model {
    
    protected $_tbl_category = 'd_category';
    
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
}