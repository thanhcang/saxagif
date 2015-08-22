<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management category
 */
class Inspirational extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('mnews'));
        $this->lang->load('contact');
    }

    /**
     * show list we are do
     */
    public function index() {
        
        $this->render('inspirational/index_view'.$this->subfix_layout);
    }

    /**
     * show detail yours say
     * @param type $slug
     */
    public function detailEvent() {
        $param = $this->input->post();
        $detailEvent = $this->mnews->detailWearedo($param['id']);
        $anotherPost = $this->mnews->anotherEventSaxa($param['id'], $this->langs);

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
