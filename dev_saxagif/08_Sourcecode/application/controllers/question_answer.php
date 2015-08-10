<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author hgnuyen0110@gmail.com
 * @date 2015/07/19
 * Management category
 */
class Question_answer extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('mquestion'));
        $this->lang->load('contact');
    }
    
    /**
     * render html
     */
    public function index()
    {
        $this->data['question'] = $this->mquestion->listQa($this->langs);
        $this->data['answer'] = $this->mquestion->listQaHaveAnwser($this->langs);
        $this->render('question_answer/index_view'.$this->subfix_layout);
    }
    
    /**
     *  send question
     */
    public function sendQuestion() {
        if( $_SERVER['REQUEST_METHOD'] === 'POST'){
            $input = $this->input->post();
            if ($input['formname'] == 1 ){
                $is_insert = $this->mquestion->sendQuestion($input); 
                if ($is_insert == TRUE){
                    echo 'okie';
                }
            }
        }
    }
}
    