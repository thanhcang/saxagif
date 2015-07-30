<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management contact
 */
class Category extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('category_model', 'product_model'));
        //$this->lang->load('contact');
    }
    // Mission page
    public function index()
    {
       
        $data = array();
        // Set page parent or child:
        $rank = 0;
        $slug = end($this->uri->segment_array());
        $listCategory = $this->category_model->getProductByCategory($slug, $rank);
        //echo $rank;exit;
        if($rank == CATEGORY_PARENT) {
            $this->data['list_category'] = $listCategory[0];
            $this->data['listCategory'] = $this->processCategoryList($listCategory);
            $this->data['page_title'] = 'Product';
            $this->render('category/index_view');
        } elseif($rank == CATEGORY_CHILD) {
            $this->data['listCategory'] = $listCategory;
            $this->data['page_title'] = 'Category detail';
            $this->render('category/detail_view');
        }else {
            redirect();
        }
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
                        'cat_slug' => $key['child_slug'],
                        'product_slug' => $key['product_slug'],
                        'logo' => $key['logo'],
                        'product_img' => $key['product_img'],
                        'product_name' => $key['product_name']
                    ));
                }
            } else {
                // create array
                $temp_data[$key['child_name']][] = array(
                    'cat_slug' => $key['child_slug'],
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