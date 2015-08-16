<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/27
 * Management ajax
 */
class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('category_model', 'product_model' , 'msaxa_everyday'));
        //$this->lang->load('contact');
    }

    public function index() {
        if ($this->input->post('product_id')) {
            $product_id = (int) $this->input->post('product_id');
            $detailProduct = $this->product_model->getDetail($product_id);
            //echo $this->db->last_query();die;
            if ($detailProduct) {
                $data = array();
                $data[] = $detailProduct;
                echo json_encode($data);
            } else {
                echo '';
            }
        } else {
            echo '';
        }
    }

    /**
     * show ajax detail product
     */
    public function detailProduct() {
        if ($this->input->post('product_id')) {
            $product_id = (int) $this->input->post('product_id');

            $detailProduct = $this->product_model->getDetail($product_id);
            $detailImage = $this->product_model->getImageProduct($product_id);
            $customerChoosePro = $this->product_model->getCustomerChooseProduct($product_id);
            $product_coordinator = $this->product_model->getProductCoordinator($product_id);
            
            if ($detailProduct) {
                $json_result = array(
                    'code' => 200,
                    'detail' => $detailProduct,
                    'image' => $detailImage,
                    'customer' => $customerChoosePro,
                    'coordinator' => $product_coordinator,
                );
                echo json_encode($json_result);
                return;
            } else {
                $json_result = array(
                    'code' => 300
                );
                echo json_encode($detailProduct);
                return;
            }
        } else {
            $json_result = array(
                'code' => 404
            );
            echo json_encode($detailProduct);
            return;
        }
    }
    
    /**
     * get detail saxa every day
     * @param type $param
     * @return type
     */
    public function detailSaxaEveryday() {
        $param = $this->input->post();
        $detailEvent = $this->msaxa_everyday->detailSaxaEveryday($param['id']);
        $anotherPost = $this->msaxa_everyday->anotherSaxaEveryday($param['id']);

        if (!empty($detailEvent)) {
            $detailEvent['content'] = htmlspecialchars_decode($detailEvent['content']);
            $json_result = array(
                'code' => 202,
                'detail' => $detailEvent,
                'more' => $anotherPost
            );
            echo json_encode($json_result, TRUE);
            return;
        }
        return;
    }

}
