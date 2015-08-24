<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";

$route['gia-nhap-cung-saxa/(:any)'] = 'join_saxa/detail';
$route['hop-tac/detail'] = 'co_operate/detail';
$route['thac-mac-va-huong-dan/sendQuestion'] = 'question_answer/sendQuestion';
$route['thac-mac-va-huong-dan'] = 'question_answer';
$route['chung-toi-mong-doi-gi-o-ban'] = 'about/we_expect_from_you';
$route['truyen-cam-hung/(:any)'] = 'inspirational';

$route['((?!home|ajax|contants|search)(:any))'] = 'common';
$route['((?!home|ajax|contants|search)(:any))/(:any)'] = 'common';
$route['404'] = 'My404';
$route['contants'] = 'contants';
$route['contact'] = 'contact';
$route['contact/addCustomer'] = 'contact/addCustomer';
$route['hop-tac'] = 'co_operate';
$route['gia-nhap-cung-saxa'] = 'join_saxa';
$route['chung-toi-la-ai-cau-chuyen-ve-saxa'] = 'story_saxa';
$route['chung-toi-la-ai-cau-chuyen-ve-saxa/detail'] = 'story_saxa/detail';
$route['chung-toi-lam-duoc-gi-cho-ban'] = 'wearedo';
$route['chung-toi-lam-duoc-gi-cho-ban/detail'] = 'wearedo/detail';
$route['chung-toi-mong-doi-gi-o-ban'] = 'weexpectfromyou';
$route['chung-toi-da-lam-duoc-gi'] = 'wearedone';
$route['chung-toi-da-lam-duoc-gi/detailEvent'] = 'wearedone/detailEvent';
$route['truyen-cam-hung'] = 'inspirational';
$route['ly-do-saxa-co-mat'] = 'story_saxa/reason';

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */