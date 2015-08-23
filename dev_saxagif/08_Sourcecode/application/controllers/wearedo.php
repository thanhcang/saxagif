<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management category
 */
class Wearedo extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('mnews'));
        $this->lang->load('contact');
    }

    /**
     * show list we are do
     */
    public function index() {
        
        $slug = end($this->uri->segment_array());
        if($slug == "chung-toi-lam-duoc-gi-cho-ban") {
        $this->data['listData'] = $this->mnews->listWeareDo($this->langs);
        $this->data['detailMaster'] = $this->mnews->detailMasterWeareDo($this->langs);
        $this->render('wearedo/index_view'.$this->subfix_layout);
        // hnguyen0110@gmail.com : add show detail news
        }else {
            $this->data['detailWearedo'] = $this->mnews->detailWearedo($slug);
            
            //$this->data['anotherPost'] = $this->mnews->anotherWearedo($param['id'], $this->langs);
            $this->render('wearedo/detail_view'.$this->subfix_layout);
        }
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
            $detailWearedo['content'] = htmlspecialchars_decode($detailWearedo['content']);
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
