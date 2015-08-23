<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management category
 */
class Inspirational extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('minspirational'));
        $this->lang->load('contact');
    }

    /**
     * show list we are do
     */
    public function index() {
        // category parent
        $parent = $this->minspirational->listParent($this->langs);
        $t_parent = 0;
        $result = array();
        foreach ($parent as $key) {
            if ($key['parent_id'] == $t_parent) {
                $t_child_array = array(
                    'id' => $key['id'],
                    'name' => $key['child_name'],
                    'slug' => $key['slug']    
                    );
                array_push($result[$key['parent_name']], $t_child_array);
            } else {
                $result[$key['parent_name']][] = array(
                    'id' => $key['id'],
                    'name' => $key['child_name'],
                    'slug' => $key['slug']    
                );
                $t_parent = $key['parent_id'];
            }
        }
        
        $this->data['parent'] = $result;
        $this->render('inspirational/index_view' . $this->subfix_layout);
    }

    /**
     * show detail yours say
     * @param type $slug
     */
    public function detailEvent($saxa_id) {
        $result = $this->minspirational->listChildAricle($this->langs, $saxa_id);
        return $result;
    }
    
    /**
     * show detail yours say
     * @param type $slug
     */
    public function detail($saxa_id) {
        $result = $this->minspirational->detail($this->langs, $saxa_id);
        return $result;
    }

}
