<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management category
 */
class Weexpectfromyou extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('mnews'));
        $this->lang->load('contact');
    }

    /**
     * show list we are do
     */
    public function index() {
        $this->data['listData'] = $this->mnews->listWeaExpect($this->langs);
        $this->data['salse'] = $this->mnews->listSalse();
        
        $this->render('weexpectfromyou/index_view');
    }

    /**
     * show detail yours say
     * @param type $slug
     */
    public function detail() {
        $param = $this->input->post();
        $detailWearedo = $this->mnews->detailWearedo($param['id']);
        $anotherPost = $this->mnews->anotherWearedo($param['id'], $this->langs);

        if (!empty($detailWearedo)) {
            $detailYourSay['content'] = htmlspecialchars_decode($detailWearedo['content']);
            $json_result = array(
                'code' => 202,
                'detail' => $detailWearedo,
                'more' => $anotherPost
            );
            echo json_encode($json_result, TRUE);
            return;
        }
        return;
    }

}

