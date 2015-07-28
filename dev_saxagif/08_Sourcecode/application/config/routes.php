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
$route['contact.html'] = 'contact';
$route['join-saxa.html'] = 'join_saxa';
$route['co-operate.html'] = 'co_operate';
$route['QA.html'] = 'question_answer';
$route['mission.html'] = 'about/index';
$route['who-we-are.html'] = 'about/who_we_are';
$route['we-do-for-you.html'] = 'about/we_do_for_you';
$route['we-expect-from-you.html'] = 'about/we_expect_from_you';
$route['default_controller'] = "home";

$default_controller = 'home';
$route['((?!home|ajax|contants)(:any))'] = 'common';
//$route['(:any)'] = 'common';
$route['((?!home|ajax|contants)(:any))/(:any)'] = 'common';
$route['404'] = 'My404';

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */