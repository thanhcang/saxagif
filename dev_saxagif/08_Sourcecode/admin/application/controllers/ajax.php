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

}
