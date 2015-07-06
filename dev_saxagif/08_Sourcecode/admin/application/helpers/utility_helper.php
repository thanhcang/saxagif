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