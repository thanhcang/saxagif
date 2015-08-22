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
        $this->data['parent_category'] = $this->uri->segment(1);
        
        $listCategory = $this->category_model->getProductByCategory($slug, $rank);
        $positionCategory = $this->category_model->getPositionCategory($this->uri->segment(1));
        
        if (!empty($positionCategory)){
            $this->data['positionCategory'] = intval($positionCategory['rank'] ) - 1;
        } else {
            $this->data['positionCategory'] = 0;
        }
        
        if($rank == CATEGORY_PARENT) {
            $this->data['list_category'] = $listCategory[0];
            $this->data['listCategory'] = $this->processCategoryList($listCategory);
            //echo '<pre>';print_r($this->data['listCategory']);die;
            $this->data['page_title'] = 'Product';
            $this->render('category/index_view'.$this->subfix_layout);
        } elseif($rank == CATEGORY_CHILD) {
            $this->data['listCategory'] = $listCategory;
            $this->data['page_title'] = 'Category detail';
            $this->render('category/detail_view'.$this->subfix_layout);
        }elseif($rank == IS_GIFT) {
            $this->data['listPresent'] = $this->category_model->getCategoryByType($type = IS_GIFT,TRUE, $this->langs);
            $this->data['detailPresent'] = $this->category_model->getDetailPresent($this->uri->segment(2),$this->langs);
            $this->data['listGift'] = $listCategory;
            $this->data['giftName'] = $this->getNameGift($listCategory);
            //echo '<pre>';            print_r($listCategory);exit;
             $this->data['page_title'] = 'Choose gifts';
            $this->render('category/gift_view'.$this->subfix_layout);
        }else {
            redirect();
        }
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