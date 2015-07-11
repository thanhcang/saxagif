<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/06/22
 */
class Mnews extends MY_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function search($params = '')
    {
        $result = array();
        $arr_where = array();
        $sql = "SELECT
                        n.id,
                        n.title,
                        n.description,
                        n.content,
                        n.id_news_cat,
                        n.position,
                        n.view,
                        n.language_type,
                        n.keyword_seo,
                        n.des_seo,
                        n.slug,
                        n.avatar
                FROM
                        " . $this->_tbl_news . " AS n
                WHERE
                        n.del_flg = 0";
        $query = $this->db->query($sql, $arr_where);
        if($query->num_rows() > 0) {
            $result = $query->result_array();
        }
        return $result;
        
    }
    
    public function save($params)
    {
        $data = array(
            'title' => (!empty($params['txtTitle'])) ? $params['txtTitle'] : '',
            'description' => (!empty($params['description'])) ? $params['description'] : '',
            'content' => (!empty($params['content'])) ? $params['content'] : '',
            'id_news_cat' => (!empty($params['catNews'])) ? $params['catNews'] : '',
            'position' => (!empty($params['position'])) ? $params['position'] : '',
            'language_type' => (!empty($params['language_type'])) ? $params['language_type'] : '',
            'keyword_seo' => (!empty($params['txtKeySeo'])) ? $params['txtKeySeo'] : '',
            'des_seo' => (!empty($params['txtDesSeo'])) ? $params['txtDesSeo'] : '',
            'slug' => (!empty($params['txtSlug'])) ? $params['txtSlug'] : '',
            'avatar' => (!empty($params['avatar'])) ? $params['avatar'] : '',
        );
        if (!empty($params['news_id'])) {
            $this->db->where('id', $params['news_id']);
            $data['update_user'] = $this->session->userdata('ses_user_id');
            $data['update_date'] = date('Y-m-d H:i:s');
            return $this->db->update($this->_tbl_news, $data);
        } else {
            $data['create_user'] = $this->session->userdata('ses_user_id');
            $data['create_date'] = date('Y-m-d H:i:s');
            return $this->db->insert($this->_tbl_news, $data);
        }
    }
    
    public function detail($newsId = '')
    {
        $newsId = (int)$newsId;
        if(empty($newsId)) {
            return FALSE;
        }
        $result = array();
        $arr_where = array();
        $sql = "SELECT
                        n.id,
                        n.title,
                        n.description,
                        n.content,
                        n.id_news_cat,
                        n.position,
                        n.view,
                        n.language_type,
                        n.keyword_seo,
                        n.des_seo,
                        n.slug,
                        n.avatar
                FROM
                        " . $this->_tbl_news . " AS n
                WHERE
                        n.del_flg = 0 AND id = ? LIMIT 1";
        $arr_where[] = $newsId;
        $query = $this->db->query($sql, $arr_where);
        if($query->num_rows() > 0) {
            $result = $query->row_array();
        }
        return $result;
    }
    public function del($newsId)
    {
        $this->db->where('id', $newsId);
        return $this->db->update($this->_tbl_news, array('del_flg' => 1));
    }
    
    public function checkExistTitle($title)
    {
        $this->db->select('id')
                ->where('title', $title);
        $query = $this->db->get($this->_tbl_news);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }   
    }
}