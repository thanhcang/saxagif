<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/06/07
 */
class Mcommon extends MY_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * check slug
     * @param type $param
     */
    public function checkSlug($slug) {
        $this->db->select('id');
        $this->db->where('slug', $slug);
        $query = $this->db->get('d_slug');
        
        if ($query->num_rows() > 0 ){
            return TRUE;
        }
        return FALSE;
    }
    /**
     * insert slug common
     * @param stirng $slug
     * @param string $table
     * @param string $controller
     */
    
    public function createSlug($slug, $table , $controller) {
        $data = array(
            'slug'  =>  $slug,
            'table' =>  $table,
            'controller'    => $controller
        );
        $this->db->insert('d_slug', $data);
    }
    
    /**
     * delete slug
     * @param type $param
     */
    public function delete($slug) {
        $this->db->where('slug', $slug);
        $this->db->delete('d_slug');
    }

}