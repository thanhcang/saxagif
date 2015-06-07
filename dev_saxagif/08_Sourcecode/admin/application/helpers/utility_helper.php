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