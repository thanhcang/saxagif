<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Common function define here
 * User: hnguyen0110@gmail.com
 * Date: 2015/06/06
 */


/* @author : hnguyen0110@gmail
 * @date : 2015/06/06
 * @function : return password for hash_hmac
 */
if ((!function_exists("pass_hash"))) {

    function pass_hash($p) {
        return hash_hmac('sha256', $p, SALT, TRUE);
        //return hash('sha256', $p);
    }

}

if ((!function_exists("createBinaryFile"))) {

    /**
     * 
     * @param string $file (path file)
     * @return type
     */
    function createBinaryFile($file) {
        if (file_exists($file)) {
            $fh = fopen($file,FOPEN_READ);
            $file_data = fread($fh, filesize($file));
            fclose($fh);
            unlink($file);
            return $file_data;
        }
    }

}

if ((!function_exists("trimStringArray"))) {

    /**
     * trim string
     * @param type $data
     */
    function trimStringArray(&$data) {
        if (!empty($data) && is_string($data)) {
            $data = trim($data);
        } else if (!empty($data) && is_array($data)) {
            foreach ($data as $k => $item) {
                if (is_string($item)) {
                    $data[$k] = trim($item);
                }
            }
        } else {
            // nothing
        }
    }

}

/*
 *  input : formate date d/m/Y
 *  output : formate date : Y-m-d
 *  cause : don't change format datetime from datepicker to php
 */
if (!function_exists('convertDateFormat')) {

    function convertDateFormat($datetime, $format_input = 'd/m/Y', $format_output = 'Y-m-d') {
        if (empty($datetime)) {
            return '';
        }
        if(empty($format_input)) $format_input = 'd/m/Y';

        $datetime = date_create_from_format($format_input, $datetime); 
        if ($datetime) {
            return $datetime->format($format_output);
        }

        return '';
    }

}

 /**
  * HoaHN: 20141024
  * Create substring in string
 **/
if ((!function_exists("_substr"))) {
    function _substr($str, $length, $minword = 3)
    {
        $sub = '';
        $len = 0;
        foreach (explode(' ', $str) as $word)
        {
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $len += strlen($part);
        if (strlen($word) > $minword && strlen($sub) >= $length)
        {
        break;
        }
        }
        return $sub . (($len < strlen($str)) ? '...' : '');
    }
}

 /**
  * HoaHN: 20141024
  * Create substring in string
 **/
if ((!function_exists("slug_convert"))) {
    function slug_convert($str){
        if(!$str) return false;
        $unicode = array(
                    'a'=>array('á','à','ả','ã','ạ','ă','ắ','ặ','ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ'),
            'A'=>array('Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ','Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ'),
            'd'=>array('đ'),
            'D'=>array('Đ'),
            'e'=>array('é','è','ẻ','ẽ','ẹ','ê','ế','ề','ể','ễ','ệ'),
            'E'=>array('É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề','Ể','Ễ','Ệ'),
            'i'=>array('í','ì','ỉ','ĩ','ị'),
            'I'=>array('Í','Ì','Ỉ','Ĩ','Ị'),
            'o'=>array('ó','ò','ỏ','õ','ọ','ô','ố','ồ','ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','ợ'),
            '0'=>array('Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ','Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','Ợ'),
            'u'=>array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ','ử','ữ','ự'),
            'U'=>array('Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ','Ử','Ữ','Ự'),
            'y'=>array('ý','ỳ','ỷ','ỹ','ỵ'),
            'Y'=>array('Ý','Ỳ','Ỷ','Ỹ','Ỵ'),
            '-'=>array(' ','&quot;','.')
        );
        foreach($unicode as $nonUnicode=>$uni){
                foreach($uni as $value)
                            $str = str_replace($value,$nonUnicode,$str);
        }
            return $str;
    }
}
