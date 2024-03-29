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
$route['default_controller'] 		= 'home';
$route['404_override'] 				= 'my404';
$route['translate_uri_dashes'] 		= FALSE;
$route['hidesignup']				= 'admin/signup';
$route['dashboard']					= 'admin/dashboard';
$route['profile/(:any)'] 			= 'admin/users/userDetail/$1';
$route['change_password/(:any)'] 	= 'admin/users/changePassword/$1';
$route['institute-all']				= 'admin/institute/index';
$route['institute-detail/(:any)']	= 'admin/institute/detail/$1';
$route['teacher-detail/(:any)']		= 'admin/teacher/detail/$1';
$route['teacher-all']			    = 'admin/teacher/index';
$route['student-all']			    = 'admin/student/index';
$route['student-detail/(:any)'] 	= 'admin/student/detail/$1';
$route['pages']			    		= 'admin/page/index';
$route['all-blogs']			    		= 'admin/blog/index';
$route['membership-plan']			    		= 'admin/plan/index';
$route['payment-history']			    		= 'admin/payment/index';
$route['instrument-all']			    		= 'admin/instrument/index';
$route['support-all']			    		= 'admin/support/index';
$route['tutorial-all']			    		= 'admin/tutorial/index';
$route['support-detail/(:any)']			    		= 'admin/support/detail/$1';

//User
$route['institute']					= 'home/institute';
$route['institute-class']					= 'home/instituteclass';

$route['user_profile/(:any)'] 			= 'home/users/userDetail/$1';
$route['user_change_password/(:any)'] 	= 'home/users/changePassword/$1';
$route['instituteInfo'] 				= 'home/users/instituteInfo';
$route['teachers'] 						= 'home/teacher/index';
$route['staff'] 						= 'home/staff/index';
$route['students'] 						= 'home/student/index';
$route['parents'] 						= 'home/parents/index';
$route['all-detail/(:any)'] 	    	= 'home/users/detail/$1';
$route['institute-student-detail/(:any)'] 		= 'home/student/detail/$1';
$route['institute-teacher-detail/(:any)'] 		= 'home/teacher/detail/$1';
$route['institute-staff-detail/(:any)'] 		= 'home/staff/detail/$1';
$route['info-page/(:any)'] 		= 'info/index/$1';

$route['all-blogs-institute']			    		= 'home/blog/index';
$route['membership-plan-institute']			    		= 'home/plan/index';
$route['payment-history-institute']			    		= 'home/payment/index';

$route['support-institute']			    		= 'home/support/index';

$route['support-detail-institute/(:any)']			    		= 'home/support/detail/$1';
