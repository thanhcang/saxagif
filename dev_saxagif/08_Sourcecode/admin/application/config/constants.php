<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

//Number Paging On All Page
define('NUMBER_PAGING', 10);
define('DOUBLE_NUMBER_PAGGING', 200);
define('NUMBER_PAGE', 20);

#HoaHN 2015/06/06
define('MAIL_ADDR', 'hnguyen0110@gmail.com');

define('START_YEAR', 2015);
define('END_YEAR', date('Y'));
define('DEFAULT_TITLE', 'SAXA Gifts - Công ty quà tặng doanh nghiệp cao cấp');
define('DEFAULT_DES_SEO', 'Quả tặng doanh nghiệp, Quà tặng cao cấp, quà tặng');
define('DEFAULT_KEYWORD_SEO', 'Quả tặng doanh nghiệp, Quà tặng cao cấp, quà tặng');
define('TEMPLATE', 'templates/main');
define('TEMP_ADMIN', 'admin/main');

/*
  |--------------------------------------------------------------------------
  | Pagination numbers
  |--------------------------------------------------------------------------
 */
define('OFFSET', 10);
define('OFFSET_LISTTENNING', 60);

/*
  |--------------------------------------------------------------------------
  | Upload folders
  |--------------------------------------------------------------------------
  |
  |
 */
$root_path = dirname(BASEPATH);

define('COMMON_PATH', FCPATH.'/common/');
define('VIEW_PATH', APPPATH.'/views/');
define('TEMP_PATH', COMMON_PATH . 'temp/');
define('IMAGE_PATH', COMMON_PATH . 'img/');
define('IMAGE_PARTNERS_PATH', COMMON_PATH . 'img/partners/');
define('IMG_PRODUCT_PATH', COMMON_PATH . '/multidata/product_img/');
define('IMAGE_CATEGORY_PATH', COMMON_PATH . '/multidata/cat_logo/');
define('IMAGE_NEWS_PATH', COMMON_PATH . '/multidata/news/');
define('URL_IMAGE_SLIDE_CATEGORY',COMMON_PATH .'multidata/slide/');
// No change
define('SALT', 'saxagifts!$23');


/* End of file constants.php */
/* Location: ./application/config/constants.php */

define('CONST_MAXBYTE_IMAGE', 200000);
define('CONST_MAXWIDTH_SHORTCUT', 32);
define('CONST_MAXHEIGHT_SHORTCUT', 32);
define('CONST_MAXWIDTH_LOGO', 768);
define('CONST_MAXHEIGHT_LOGO', 1336);
define('LOGIN_COOKIE_REMEMBER_HOUR',             60 * 60); //1: a hour
define('LOGIN_COOKIE_REMEMBER_WEEK',             7 * 24); //a week
define('LOGIN_COOKIE_REMEMBER_TIME_DEFAULT',     365 * 24); //a year
define('LOGIN_COOKIE_REMEMBER_NAME',             'logincookie');
define('CONTACT_MAIL',                           'vtcanglt@gmail.com');
define('CONST_MAXHEIGHT_LOGO_USER',100);
define('BUTTON_NEXT','next');
define('BUTTON_PRE','pre');
define('BUTTON_FIRST','first');
define('BUTTON_LAST','last');
define('IMAGE_HEIGHT_400',400);
define('IMAGE_WIDTH_400',400);
define('IMAGE_HEIGHT_300',300);
define('IMAGE_WIDTH_300',300);
define('IMAGE_HEIGHT_150',150);
define('IMAGE_WIDTH_150',150);
define('IMAGE_HEIGHT_250',250);
define('IMAGE_WIDTH_250',250);
define('NUMBER_PAGE_PARTNERS',5);
define('URL_IMAGE_CHILDREN_CATEGORY','common/multidata/cat_logo');

