<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/06/23
 * Screen category news management
 */
class Category_news extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->lang->load('category_news');
        
        // Load model:
        $this->load->model(array('mcategory_news'));
    }
    
    public function index()
    {
        $params = array();
        $errors = array();
        $items = array();
        $tpl = array(
            'breadcrumb' => array(
                base_url() => 'home',
                base_url('category_news') => 'Danh mục tin tức'),
        );
        if (!empty($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $data = array(
            'page_title' => $this->lang->line(),
            'language_type' => $this->_language,
            'listAll' => $this->mcategory_news->listAll(),
            'position' => $this->config->item('position'),
        );
        
        if($this->input->post()) {
            $params = $this->input->post();
            // Set rules:
            $this->_validate($params, $error);
            if (empty($error)) {
                $isInsert = $this->mcategory_news->save($params);
                if($isInsert) {
                    $params = array();
                }
            }
            $data['params'] = $params;
            $data['cat_news_errors'] = $error;
        }
        $items = $this->input->get();
        // Config pagination:
        $parmameter_page = 'page';
        $queryString = $this->input->server('QUERY_STRING');
        //remove parameter page

        $queryString = preg_replace('/(\&|)page=[0-9]$/is', '', $queryString);
        $queryString = preg_replace('/(\&|)page=$/is', '', $queryString);
        
        $page_config = array(
            'base_url'    => base_url('category_news/?' . $queryString),
            'per_page' => NUMBER_PAGE,
            'use_page_numbers' => TRUE,
            'page_query_string' => TRUE,
            'query_string_segment' => $parmameter_page,
            'next_link'      => BUTTON_NEXT,
            'prev_link'      => BUTTON_PRE,
            'first_link'     => BUTTON_FIRST,
            'last_link'      => BUTTON_LAST,
            'cur_tag_open'   => '<li class="active"><a href="#">',
            'cur_tag_close'  => '</li></a>',
            'prev_tag_open'  => '<li>',
            'prev_tag_close' => '</li>',
            'next_tag_open'  => '<li>',
            'next_tag_close' => '</li>',
            'num_tag_open'   => '<li>',
            'num_tag_close'  => '</li>',
            'full_tag_open'  => '<ul class="pagination pagination-centered">',
            'full_tag_close' => '</ul>',
        );
        
        $offset = max(($page - 1), 0) * $page_config['per_page'];
        $total_records = 0;
        $data['list_data'] = $this->mcategory_news->search($items, $total_records, $offset, $page_config['per_page']);
        if(!empty($data['list_data'])){
            // Pagination
            $this->load->library('pagination');
            $page_config["total_rows"] = $total_records;
            $this->pagination->initialize($page_config);
            $data["pagination"] = $this->pagination->create_links();
        }
        $data['offset'] = $offset;
        $data['items']=  $items;
        $tpl["main_content"] = $this->load->view('category_news/index', $data, TRUE);
        $this->load->view(TEMPLATE, $tpl);
    }
    
    /**
     * 
     * @param type $id
     * Edit category news
     */
    public function edit($id = '')
    {
        if(!empty($id) && filter_var($id, FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $params = array();
            $error = array();
            $detailCatNews = $this->mcategory_news->getDetail($id);
            
            //Check exist category news by Id:
            if(empty($detailCatNews)) {
                redirect(base_url('category_news'));
            }
            $data = array(
                'page_title' => $this->lang->line('CAT_NEWS_EDIT'),
                'language_type' => $this->_language,
                'detailCatNews' => $detailCatNews,
                'position' => $this->config->item('position'),
            );
            $tpl = array(
                'breadcrumb' => array(
                    base_url() => 'home',
                    base_url('category_news') => 'Danh mục tin tức',
                    'javascript:;' => 'Cập nhật',
                    '#' => $detailCatNews['name']),
            );
            
            if ($this->input->post()) {
                $params = $this->input->post();
                $this->_validate($params, $error);
                
                if (empty($error)) {
                    $params['cat_news_id'] = $id;
                    if($this->mcategory_news->save($params)) {
                        redirect(base_url('category_news'));
                    }
                }
                $data['params'] = $params;
                $data['cat_news_errors'] = $error;
            }
            
            $tpl["main_content"] = $this->load->view('category_news/edit', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        } else {
            
            redirect(base_url('category_news'));
        }
    }
    
    public function detail($id = '')
    {
        if(!empty($id) && filter_var($id, FILTER_VALIDATE_INT, array('min_range' => 1))) {
            
            $detailCatNews = $this->mcategory_news->getDetail($id);
            //echo '<pre>';            print_r($detailCatNews);exit;
            //Check exist category news by Id:
            if(empty($detailCatNews)) {
                redirect(base_url('category_news'));
            }
            
            $tpl = array(
                'breadcrumb' => array(
                    base_url() => 'home',
                    base_url('category_news') => 'Danh mục tin tức',
                    'javascript:;' => 'Chi tiết',
                    '#' => $detailCatNews['name']),
            );
            
            $data = array(
                'page_title' => $this->lang->line('CAT_NEWS_DETAIL'),
                'detailCatNews' => $detailCatNews,
                'position' => $this->config->item('position'),
            );

            $tpl["main_content"] = $this->load->view('category_news/detail', $data, TRUE);
            $this->load->view(TEMPLATE, $tpl);
        } else {
            redirect(base_url('category_news'));
        }
    }
    
    //Category news detail popup
    public function detailCatNews()
    {
        $input = $this->input->post();
        if ($this->isPostMethod() && !empty($input) && !empty($input['is_ajax']) && ($input['is_ajax'] == 'ajax')) { // view detail category news
            $is_detailCat = $this->mcategory_news->getDetail($input['catNewsId']);
            if ($is_detailCat) {
                $positions = $this->config->item('position');
                $is_detailCat['position_name'] = $positions[$is_detailCat['position']];
                $json_result = array(
                    'result' => 1,
                    'code'  => 202,
                    'data' => $is_detailCat,
                );
                echo json_encode($json_result);
                return;
            } else { // not find profile
                $json_result = array(
                    'result' => 1,
                    'code'   => 400,
                    'data'   => 'không tìm thấy danh mục tin tức này' ,
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
     * Delete Category news
     * @return type
     */

    public function delete()
    {
         if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])) {
             $cat_news_id = (int)$_POST['id'];
            if ($this->mcategory_news->del($cat_news_id)) {
                $json_result = array(
                    'result' => 1,
                    'code'  => 202,
                    'data' => 'success',
                );
                echo json_encode($json_result);
                return;
            } else {
                echo '';
            }
         } else {
             echo '';
         }
    }
    
    private function _validate(&$data, &$errors) {
        //Trim
        foreach ($data as $k => $item) {
            if (is_string($item)) {
                $data[$k] = trim($item);
            }
        }
        //Load
        $this->load->library('form_validation');

        // Set rules:
        $this->form_validation->set_rules("name", $this->lang->line('CAT_NEWS_MISSING_NAME_EMPTY'), "required|trim|xss_clean|max_length[255]|callback__checkExistName");
        $this->form_validation->set_rules("slug", $this->lang->line('MISSING_EMPTY_SLUG'), "trim|max_length[255]|callback__checkExistSlug");
        $this->form_validation->set_rules("language_type", $this->lang->line('PRO_MISSING_PRICE_INVALID'), "required|trim|integer|max_length[1]");
        $this->form_validation->set_rules("keyword_seo", $this->lang->line('PRO_DESCRIPTION'),  "trim|max_length[255]");
        $this->form_validation->set_rules("des_seo", $this->lang->line('PRO_CONTENT'),"trim|max_length[255]");
        $this->form_validation->set_rules("position", $this->lang->line('CAT_NEWS_MISSING_POSITION_EMPTY'),  "trim|max_length[2]|integer|required");
        // Set Message:
        $this->form_validation->set_message('required', '%s');
        //Validate
        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
        }
    }
    
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/22
     * Check exist product name
     */
    public function _checkExistName()
    {
        if (empty($_POST['category_news_id'])) {
            if ($this->mcategory_news->checkExistName($_POST['name'])) {
                $this->form_validation->set_message('_checkExistName', $this->lang->line('CAT_NEWS_MISSING_NAME_EXIST'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
    /**
     * @author hnguyen0110@gmail.com
     * @date 2015/06/14
     * Check exist category slug
     */
    public function _checkExistSlug()
    {
        if (empty($_POST['category_news_id'])) {
            $slugName = slug_convert($_POST['slug']);
            if (!empty($_POST['slug']) && $this->mcategory_news->checkExistSlug($slugName)) {
                $this->form_validation->set_message('_checkExistSlug', $this->lang->line('CAT_NEWS_MISSING_SLUG_EXIST'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
}