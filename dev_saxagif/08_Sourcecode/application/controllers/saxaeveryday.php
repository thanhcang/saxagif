<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management contact
 */
class Saxaeveryday extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('msaxa_everyday'));
    }
    // Mission page
    public function index() {
        $data = array();

        $this->data['listData'] = $this->msaxa_everyday->listData($this->uri->segment(1));
        $this->data['listCategory'] = $this->msaxa_everyday->listCategory($this->uri->segment(1));
        $this->data['listParent'] = $this->msaxa_everyday->listParent($this->uri->segment(1));
        
        $this->render('saxa_everyday/index_view' . $this->subfix_layout);
    }

    /**
     * genaral list category 
     * @param array $list_product
     * @return boolean
     */
    function processCategoryList($list_product) {
        // check emtpy list product
        if (empty($list_product)){
            return FALSE;
        }
        
        $temp = '';
        $temp_data = array();
        $count = 1;

        foreach ($list_product as $key) {
            // add element into array
            if ($key['child_name'] == $temp) {
                $count++;
                if ($count < 5) {
                    array_push($temp_data[$key['child_name']], array(
                        'cat_slug' => $key['child_slug'],
                        'product_slug' => $key['product_slug'],
                        'logo' => $key['logo'],
                        'product_img' => $key['product_img'],
                        'product_name' => $key['product_name'],
                        'pro_id' => $key['pro_id'],
                    ));
                }
            } else {
                // create array
                $temp_data[$key['child_name']][] = array(
                    'cat_slug' => $key['child_slug'],
                    'product_slug' => $key['product_slug'],
                    'logo' => $key['logo'],
                    'product_img' => $key['product_img'],
                    'product_name' => $key['product_name'],
                    'pro_id' => $key['pro_id'],
                );
                $count = 1;
            }

            $temp = $key['child_name'];
        }
        
        return $temp_data;
    }
    
    /**
     * Get name gift category
     */
    public function getNameGift($list_category)
    {
        // check emtpy list category
        if (empty($list_category)){
            return FALSE;
        }
        
        $temp = '';
        $temp_data = array();
        $count = 0;
        foreach ($list_category as $key) {
            // add element into array
            if ($key['category_name'] == $temp) {
                $count++;
                if ($count < 2) {
                    array_push($temp_data[$key['category_name']], array(
                        'category_name' => $key['category_name'],
                        'category_id' => $key['category_id'],
                        'category_slug' => $key['category_slug'],

                    ));
                }
            } else {
                // create array
               $temp_data[$key['category_name']] = array(
                    'category_name' => $key['category_name'],
                    'category_id' => $key['category_id'],
                   'category_slug' => $key['category_slug'],
                );
                $count = 1;
            }

            $temp = $key['category_name'];
        }
        
        return $temp_data;
    }

}