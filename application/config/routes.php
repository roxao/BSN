<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'SipinHome';
$route['submit-iin'] = 'submit_iin';
// $route['dashboard'] = 'dashboard/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['user/(:any)'] = 'SipinHome/user/$1';

$route['index_admin'] = 'SipinAdmin/index';
$route['login_admin'] = 'SipinAdmin/login_admin';
$route['get_admin'] = 'SipinAdmin/get_admin';
$route['insert_admin'] = 'SipinAdmin/insert_admin';
$route['insert_admin_proses'] = 'SipinAdmin/insert_admin_proses';


$route['inbox_admin'] = 'sipinAdmin/read_applications';
$route['inbox_tes'] = 'sipinAdmin/read_applications2';

$route['document_config'] = 'sipinAdmin/get_document_config';
$route['edit_document_config/(:any)'] = 'sipinAdmin/document_config_edit/$1';
$route['edit_proses_document_config'] = 'sipinAdmin/edit_document_config_proses';

$route['survey'] = 'sipinAdmin/get_survey';

$route['historical_data_entry'] = 'sipinAdmin/get_iin_data';
$route['edit_iin/(:any)'] = 'sipinAdmin/edit_iin/$1';

$route['cms']  = 'sipinAdmin/get_data_cms';
$route['edit_cms/(:any)'] ='sipinAdmin/edit_data_cms/$1';

$route['user_data'] = 'sipinAdmin/get_data_user';
$route['edit_user/(:any)'] ='sipinAdmin/edit_data_user/$1';


$route['proses_login_admin'] = 'dashboard/proses_login';

$route['contact-us'] = 'SipinHome/contact_us';
$route['post/(:any)'] = 'SipinHome/cms_post/$1';
