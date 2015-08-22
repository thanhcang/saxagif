<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management category
 */
class Wearedone extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('mnews'));
        $this->lang->load('contact');
    }

    /**
     * show list we are do
     */
    public function index() {
        $total =  0;
        $this->data['idealCustomer'] = $this->mnews->listIdeaCustomer($this->langs);
        $this->data['eventSaxa'] = $this->mnews->listEventSaxa($this->langs);
        $this->data['partnerSaxa'] = $this->mnews->listPartnerSaxa($this->langs,true, $total);
        
        if ($total > 21){
            $this->data['numberPagination'] = ceil($total / 21) ;
        }
        
        
        $this->render('wearedone/index_view'.$this->subfix_layout);
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
    
    public function detail()
    {
       $this->render('wearedone/index_view'.$this->subfix_layout);
    }

}
