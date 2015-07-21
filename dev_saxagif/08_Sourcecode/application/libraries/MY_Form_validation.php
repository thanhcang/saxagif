<?php
class MY_Form_validation extends CI_Form_validation
{
    function __construct($config = array())
    {
        parent::__construct($config);
    }

    /**
     * Error Array
     *
     * Returns the error messages as an array
     *
     * @return  array
     */
    function error_array()
    {
        if (count($this->_error_array) === 0) {
            return FALSE;
        } else
            return $this->_error_array;

    }

    /**
     * Validate URL
     *
     * @access    public
     * @param    string
     * @return    string
     */
    public function valid_url($url)
    {
        $pattern = "/^(http(?:s)?\:\/\/[a-zA-Z0-9\-]+(?:\.[a-zA-Z0-9\-]+)*\.[a-zA-Z]{2,6}(?:\/?|(?:\/[\w\-]+)*)(?:\/?|\/\w+\.[a-zA-Z]{2,4}(?:\?[\w]+\=[\w\-]+)?)?(?:\&[\w]+\=[\w\-]+)*)$/";
        if (!preg_match($pattern, $url)) {
            return FALSE;
        }

        return TRUE;
    }
    
    /**
     * Check email format
     * @param type $email
     * @return boolean
     */
    public function valid_email($email){
        $pattern = "/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/";
        if (!preg_match($pattern, $email)) {
            return FALSE;
        }

        return TRUE;
    }
    
    /**
     * Check date format
     * @param type $date
     * @return boolean
     */
    public function valid_date($date){
        $pattern = "/^(\d{4})-(\d{1,2})-(\d{1,2})$/";
        if (!preg_match($pattern, $date)) {
            return FALSE;
        }

        return TRUE;
    }
    
     /*
     * linhttn@vccvn.com
     * 2015-02-09
     * check date 
     * param: date
     * return: boolean
     */
      public function valid_dateTime($date){
        $pattern = "/^(\d{4})-(\d{1,2})-(\d{1,2}) (\d{1,2}):(\d{1,2})$/";
        if (!preg_match($pattern, $date)) {
            return FALSE;
        }

        return TRUE;
    }
}