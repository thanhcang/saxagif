<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management category
 */
class Story_saxa extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('mnews'));
        $this->lang->load('contact');
    }
    
    /**
     * show list join all saxa
     */
    public function index()
    {
        $this->data['listData'] = $this->mnews->listStorySaxa($this->langs);
        $this->data['yourSayPer'] = $this->mnews->listYourSay(1,$this->langs);
        $this->data['yourSayGroup'] = $this->mnews->listYourSay(2,$this->langs);
        
        $this->render('story_saxa/index_view'.$this->subfix_layout);
    }
    
    /**
     * show detail yours say
     * @param type $slug
     */
    public function detail()
    {
        $param = $this->input->post();
        $detailYourSay = $this->mnews->detailYourSay($param['id']);
        $anotherSay = $this->mnews->anotherSay($param['id']);
        
        if (!empty($detailYourSay)){
            $detailYourSay['comment'] = htmlspecialchars_decode($detailYourSay['comment']);
            $json_result = array(
                'code' => 202,
                'data' => $detailYourSay,
                'anotherSay' => $anotherSay   
            );
            echo json_encode($json_result, TRUE);
            return;
        }
        return;
        
    }
    
}
    
