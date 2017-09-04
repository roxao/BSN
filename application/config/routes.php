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
$route['admin'] = 'SipinHome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



$route['login_admin']= 'SipinAdmin/login_admin';
$route['proses_login_admin']= 'SipinAdmin/proses_login';
$route['logout_admin'] = 'SipinAdmin/logout_admin';
$route['insert_admin'] = 'SipinAdmin/insert_admin';
$route['insert_admin_proses'] = 'SipinAdmin/insert_admin_proses';

$route['insert_assesment_admin'] = 'SipinAdmin/insert_tim_asesment';
$route['insert_assesment_admin_proses'] = 'SipinAdmin/insert_tim_asesment_proses';
$route['data_asesment'] = 'SipinAdmin/read_tim_asesment';

$route['data_user'] = 'SipinAdmin/read_user';

$route['inbox'] = 'SipinAdmin/read_applications';
$route['inbox_edit_proses'] = 'SipinAdmin/edit_aplication_proses';

$route['inbox_setujui_proses_permohonan'] = 'Admin_Verifikasi_Controller/VERIF_NEW_REQ_PROSES';
$route['inbox_setujui_proses_dokumen'] = 'Admin_Verifikasi_Controller/VERIF_UPLDOC_REQ_PROSES_SUCCEST';
$route['inbox_setujui_proses_upload_billing'] = 'Admin_Verifikasi_Controller/UPL_BILL_REQ_SUCCEST';
$route['inbox_proses_konfirmasi_assessment_lapangan'] = 'Admin_Verifikasi_Controller/VERIF_PAY_REQ_SUCCEST';
$route['inbox_hasil_assessment_lapangan'] = 'Admin_Verifikasi_Controller/FIELD_ASSESS_REQ_SUCCEST';

$route['asesmen_input_for_user'] = 'SipinAdmin/tim_ases_user';