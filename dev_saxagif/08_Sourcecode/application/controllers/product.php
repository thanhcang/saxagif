<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management contact
 */
class Product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('product_model'));
        //$this->lang->load('contact');
    }
    // Mission page
    public function index()
    {
       
        $data = array();
        $slug = end($this->uri->segment_array());
        
        $listCategory = $this->product_model->getProductByCategory($slug);
        $this->data['listCategory'] = $this->processCategoryList($listCategory);
        $this->data['page_title'] = 'Product';
        $this->render('product/index_view');
    }
    
    public function test() {
        echo 'chuyen nho';
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
                        'product_slug' => $key['product_slug'],
                        'logo' => $key['logo'],
                        'product_img' => $key['product_img'],
                        'product_name' => $key['product_name']
                    ));
                }
            } else {
                // create array
                $temp_data[$key['child_name']][] = array(
                    'product_slug' => $key['product_slug'],
                    'logo' => $key['logo'],
                    'product_img' => $key['product_img'],
                    'product_name' => $key['product_name']
                );
                $count = 1;
            }

            $temp = $key['child_name'];
        }
        
        return $temp_data;
    }

}