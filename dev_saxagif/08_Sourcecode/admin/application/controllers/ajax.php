<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Description: Processing for Ajax request
 * Author     : cangtv
 * Date       : 20150607
 */

class Ajax extends MY_Controller {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        if ($this->is_logged_in() == FALSE) {
            $this->_return_session_timeout();
        }
        $this->load->model(array('muser','mpartners','mcategory','mproduct', 'mjoinsaxa'));
    }

    /**
     * Return ajax error: Session timeout
     */
    private function _return_session_timeout() {
        header('Content-Type: application/json');
        $result = array(
            'result' => 0,
            'code'  => 500,
            'href'  => base_url('login'),
        );
        echo json_encode($result);
        exit;
    }
    
    /**
     * show profile member
     * @return type
     */
    public function profileUser() {
        $input = $this->input->post();
        if ($this->isPostMethod() && !empty($input) && !empty($input['is_ajax']) && ($input['is_ajax'] == 'ajax')) { // view profile
            $is_profile = $this->muser->profile($input);
            if ($is_profile) {
                $json_result = array(
                    'result' => 1,
                    'code'  => 202,
                    'data' => $is_profile,
                );
                echo json_encode($json_result);
                return;
            } else { // not find profile
                $json_result = array(
                    'result' => 1,
                    'code'   => 400,
                    'data'   => 'không tìm thấy thành viên này' ,
                );
                echo json_encode($json_result);
                return;
            }
        } else { // is hack
            $json_result = array(
                'result' => 1,
                'code'   => 500,
                'data'   => 'is hack',
            );
            echo json_encode($json_result);
            return;
        }
    }
    
    /**
     * delete user
     * @return type
     */
    public function deleteUser() {
        $input = $this->input->post();
        if ($this->isPostMethod() && !empty($input) && !empty($input['is_ajax']) && ($input['is_ajax'] == 'ajax')) { // view profile
            $this->db->trans_off();
            $this->db->trans_begin();
            $this->muser->deleteUser($input);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $json_result = array(
                    'result' => 0,
                    'code'   => 304,
                    'data'   => 'Hệ thống chưa cập nhật được <br/> vui lòng thực hiện lại' ,
                );
                echo json_encode($json_result);
                return;
            } else {
                $this->db->trans_commit();
                $json_result = array(
                    'result' => 1,
                    'code'  => 202,
                    'data' => 'success',
                    'href'  => base_url('user'),
                );
                echo json_encode($json_result);
                return;
            }
        } else { // is hack
            $json_result = array(
                'result' => 1,
                'code'   => 500,
                'data'   => 'is hack',
            );
            echo json_encode($json_result);
            return;
        }
    }
    
    /**
     * delete parters
     * @return type
     */
    public function deleteParters() {
        $input = $this->input->post();
        if ($this->isPostMethod() && !empty($input) && !empty($input['is_ajax']) && ($input['is_ajax'] == 'ajax')) { // view profile
            $this->db->trans_off();
            $this->db->trans_begin();
            $this->mpartners->delete($input['id']);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $json_result = array(
                    'result' => 0,
                    'code'   => 304,
                    'data'   => 'Hệ thống chưa cập nhật được <br/> vui lòng thực hiện lại' ,
                );
                echo json_encode($json_result);
                return;
            } else {
                $this->db->trans_commit();
                $json_result = array(
                    'result' => 1,
                    'code'  => 202,
                    'data' => 'success',
                    'href'  => base_url('partners'),
                );
                echo json_encode($json_result);
                return;
            }
        } else { // is hack
            $json_result = array(
                'result' => 1,
                'code'   => 500,
                'data'   => 'is hack',
            );
            echo json_encode($json_result);
            return;
        }
    }
    
    /**
     * delete category
     * @return type
     */
    public function deleteCategory() {
        $input = $this->input->post();
        if ($this->isPostMethod() && !empty($input) && !empty($input['is_ajax']) && ($input['is_ajax'] == 'ajax')) { 
            $this->db->trans_off();
            $this->db->trans_begin();
            $this->mcategory->delCat($input['id']);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $json_result = array(
                    'result' => 0,
                    'code'   => 304,
                    'data'   => 'Hệ thống chưa cập nhật được <br/> vui lòng thực hiện lại' ,
                );
                echo json_encode($json_result);
                return;
            } else {
                $this->db->trans_commit();
                $json_result = array(
                    'result' => 1,
                    'code'  => 202,
                    'data' => 'success',
                    'href'  => base_url('partners'),
                );
                echo json_encode($json_result);
                return;
            }
        } else { // is hack
            $json_result = array(
                'result' => 1,
                'code'   => 500,
                'data'   => 'is hack',
            );
            echo json_encode($json_result);
            return;
        }
    }
    
    /**
     * view child category
     * @return type
     */
    public function viewChildCategory() {
        $input = $this->input->post();
        if ($this->isPostMethod() && !empty($input) && !empty($input['is_ajax']) && ($input['is_ajax'] == 'ajax')) { // view profile
            $category = $this->mcategory->viewChildCategory($input['id']);
            if (!empty($category)) {
                $json_result = array(
                    'result' => 1,
                    'code' => 202,
                    'data' => $category,
                );
                echo json_encode($json_result);
                return;
            } else {
                $json_result = array(
                    'result' => 0,
                    'code' => 404,
                );
                echo json_encode($json_result);
                return;
            }
        }
    }
    
    
    /**
     * get child category 
     * @return type
     */
    public function getChildCategory() {
        $input = $this->input->post();
        if ($this->isPostMethod() && !empty($input) && !empty($input['is_ajax']) && ($input['is_ajax'] == 'ajax')) {
            $category = $this->mcategory->getChildCategoryByType($input['id']);
            if (!empty($category)) {
                
                if ($input['id'] == 1){
                    $temp = '';
                    foreach ($category as $key){
                        if ($temp == $key['name']){
                            array_push($result[$key['name']], array('child_name' => $key['child_name'] ,  'id' => $key['id'] , 'level'=>$key['level']));                            
                        } else {
                            $result[$key['name']][] = array('child_name' => $key['child_name'] ,  'id' => $key['id'] , 'level'=>$key['level']);  
                        }
                        $temp = $key['name'];
                    }
                    $json_result = array(
                        'result' => 1,
                        'code' => 202,
                        'data' => $result,
                    );
                    echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
                } else {
                    $json_result = array(
                        'result' => 1,
                        'code' => 202,
                        'data' => $category,
                    );
                    echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
                }
                return;
            } else {
                $json_result = array(
                    'result' => 0,
                    'code' => 404,
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
            }
        }
    }
    
    /**
     * get all product by name 
     * @param type $param
     */
    public function getProductByName() {
        $input = $this->input->post();
        if ($this->isPostMethod() && !empty($input) && !empty($input['is_ajax']) && ($input['is_ajax'] == 'ajax')) {
            $product = $this->mproduct->getProductByName($input['name']);
            if (!empty($product)) {
                $json_result = array(
                    'result' => 1,
                    'code' => 202,
                    'data' => $product,
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
                return;
            } else {
                $json_result = array(
                    'result' => 0,
                    'code' => 404,
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
                return;
            }
        }
    }
    
    /**
     * get all customer by name 
     * @param type $param
     */
    public function getpartnerByName() {
        $input = $this->input->post();
        if ($this->isPostMethod() && !empty($input) && !empty($input['is_ajax']) && ($input['is_ajax'] == 'ajax')) {
            $product = $this->mpartners->getpartnerByName($input['name']);
            if (!empty($product)) {
                $json_result = array(
                    'result' => 1,
                    'code' => 200,
                    'data' => $product,
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
                return;
            } else {
                $json_result = array(
                    'result' => 0,
                    'code' => 404,
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
                return;
            }
        }
    }
   
   /**
    * procee choose product
    * @return type
    */
   public function processChooseProduct() {
        
        if ($this->isPostMethod()) {
            $input = $this->input->post();
            
            if (!empty($input)) {
                foreach ($input['sProductCode'] as $key => $value) {
                    list($code,$name) = explode(',', $value);
                    $result[] = array(
                    'product_code' => $code,
                    'name' => $name,
                    );
                }
                $json_result = array(
                    'result' => 1,
                    'code' => 200,
                    'data' => $result,
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
                return;
            } else {
                $json_result = array(
                    'result' => 0,
                    'code' => 404,
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
                return;
            }
        }
    }
    
   /**
    * procee choose product
    * @return type
    */
   public function processChoosePartner() {
        
        if ($this->isPostMethod()) {
            $input = $this->input->post();
            
            if (!empty($input)) {                
                foreach ($input['sidpartner'] as $key => $value) {
                    list($id,$name) = explode(',', $value);
                    $result[] = array(
                    'id' => $id,
                    'name' => $name,
                    );
                }
                $json_result = array(
                    'result' => 1,
                    'code' => 200,
                    'data' => $result,
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
                return;
            } else {
                $json_result = array(
                    'result' => 0,
                    'code' => 404,
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
                return;
            }
        }
    }
    
   /**
    * check product
    * @return type
    */
   public function checkProduct() {
        
        if ($this->isPostMethod()) {
            $input = $this->input->post();
            $product = $this->mproduct->checkProduct($input);
            
            if (!empty($product)) {
                $json_result = array(
                    'result' => 1,
                    'code' => 200,
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
            } else {
                $json_result = array(
                    'result' => 0,
                    'code' => 404,
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
                return;
            }
        }
    }
    
   /**
    * delete product
    * @return type
    */
   public function deleteProduct() {
        
        if ($this->isPostMethod()) {
            $input = $this->input->post();
            
            $this->db->trans_off();
            $this->db->trans_begin();

            $this->mproduct->delPro($input['id']);
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $json_result = array(
                    'result' => 0,
                    'code' => 404,
                    'error'=> 'Product chưa được xóa</br> Vui lòng thử lại'
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
                return;
            } else {
                $this->db->trans_commit();
                $json_result = array(
                    'result' => 1,
                    'code' => 200,
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
            }
        }
    }
    
   /**
    * delete join saxa
    * @return type
    */
   public function deleteJoinSaxa() {
        
        if ($this->isPostMethod()) {
            $input = $this->input->post();
            
            $this->db->trans_off();
            $this->db->trans_begin();

            $this->mjoinsaxa->deleteJoinSaxa($input['id']);
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $json_result = array(
                    'result' => 0,
                    'code' => 404,
                    'error'=> 'Product chưa được xóa</br> Vui lòng thử lại'
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
                return;
            } else {
                $this->db->trans_commit();
                $json_result = array(
                    'result' => 1,
                    'code' => 200,
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
            }
        }
    }
    
   /**
    * delete join saxa
    * @return type
    */
   public function onJoinSaxa() {
        
        if ($this->isPostMethod()) {
            $input = $this->input->post();
            
            $this->db->trans_off();
            $this->db->trans_begin();

            $this->mjoinsaxa->onJoinSaxa($input['id']);
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $json_result = array(
                    'result' => 0,
                    'code' => 404,
                    'error'=> 'Product chưa được xóa</br> Vui lòng thử lại'
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
                return;
            } else {
                $this->db->trans_commit();
                $json_result = array(
                    'result' => 1,
                    'code' => 200,
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
            }
        }
    }
    
   /**
    * delete join saxa
    * @return type
    */
   public function offJoinSaxa() {
        
        if ($this->isPostMethod()) {
            $input = $this->input->post();
            
            $this->db->trans_off();
            $this->db->trans_begin();

            $this->mjoinsaxa->offJoinSaxa($input['id']);
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $json_result = array(
                    'result' => 0,
                    'code' => 404,
                    'error'=> 'Product chưa được xóa</br> Vui lòng thử lại'
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
                return;
            } else {
                $this->db->trans_commit();
                $json_result = array(
                    'result' => 1,
                    'code' => 200,
                );
                echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
            }
        }
    }

}
