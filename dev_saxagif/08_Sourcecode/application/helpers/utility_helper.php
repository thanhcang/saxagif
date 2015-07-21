<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
    }
}

if ((!function_exists("url_img"))) {
    function url_img($url,$img) {
        return base_url($url.$img);
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