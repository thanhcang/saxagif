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
        $this->load->model(array('muser'));
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

}
