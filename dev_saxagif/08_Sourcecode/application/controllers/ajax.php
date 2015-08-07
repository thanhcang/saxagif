<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/27
 * Management ajax
 */
class Ajax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('category_model', 'product_model'));
        //$this->lang->load('contact');
    }
    
    public function index()
    {
        if($this->input->post('product_id')) {
            $product_id = (int)$this->input->post('product_id');
            $detailProduct = $this->product_model->getDetail($product_id);
            //echo $this->db->last_query();die;
            if($detailProduct) {
                $data = array();
                $data[] = $detailProduct;
                echo json_encode($data);
            } else {
                echo '';
            }
        }else {
            echo '';
        }
    }

    public function detailProduct()
    {
        if($this->input->post('product_id')) {
            $product_id = (int)$this->input->post('product_id');
            $detailProduct = $this->product_model->getDetail($product_id);
            $customerChoosePro = $this->product_model->getCustomerChooseProduct($product_id);
            //echo $this->db->last_query();die;
            if($detailProduct) {
                if($customerChoosePro) {
                    $detailProduct['customer'] = $customerChoosePro;
                }
                echo json_encode($detailProduct);
            } else {
                echo '';
            }
        }else {
            echo '';
        }
    }
}