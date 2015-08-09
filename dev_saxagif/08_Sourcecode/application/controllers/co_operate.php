<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management category
 */
class Co_operate extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('mquestion');
        $this->lang->load('contact');
    }
    
    /**
     *  show list co-operate
     */
    public function index()
    {
        $this->data['listData'] = $this->mquestion->getCoOperate();
        $this->render('co_operate/index_view');
    }
    
    /**
     * detail co-operate
     * @param type $param
     */
    public function detail() {
        if( $_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $this->input->post('id');
            $detail =  $this->mquestion->getDetailCoOperate($id, $this->langs);
            
            if (empty($detail)){
                redirect(base_url('404'));
            }
            $relationship = $this->mquestion->postRelationship($id, $this->langs);
            $json_result = array(
                'result' => 1,
                'code' => 202,
                'description' => htmlspecialchars_decode($detail['content']),
                'title' =>$detail['title'],
                'more'  => $relationship
            );
            echo json_encode($json_result);
            return;
        } else {
            redirect(base_url('404'));
        }
    }
}
    