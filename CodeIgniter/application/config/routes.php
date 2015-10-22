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
//$route['email/send'] = 'email/send';
//$route['email'] = 'email';
//$route['login/offCredentials'] = 'login/offCredentials';
//$route['login/signup'] = 'login/signup';
//$route['login/addCredentials'] = 'login/addCredentials';
//$route['login/validateCredentials'] = 'login/validateCredentials';
//$route['login'] = 'login';
//$route['qms_struc/nav/laydown'] = 'qms_struc/nav/laydown';
//$route['qms_struc/nav/manage'] = 'qms_struc/nav/manage';
//$route['qms_struc/pub/navLayDown'] = 'qms_struc/pub/navLayDown';
//$route['qms_struc/pub'] = 'qms_struc/pub';
//$route['qms_struc/admin/navManage'] = 'qms_struc/admin/navManage';
//$route['qms_struc/admin'] = 'qms_struc/admin';
//$route['qms_struc/nav'] = 'qms_struc/nav';
//$route['news/create'] = 'news/create';
//$route['news/(:any)'] = 'news/view/$1';
//$route['news'] = 'news';
//$route['(:any)'] = 'pages/view/$1';
//$route['default_controller'] = 'pages/view';

//$route['webapps/userAccounts'] = 'webapps/userAccounts/index';
//$route['default_controller'] = "welcome";

 // if (ENVIRONMENT == "development")
	 // $route['portal'] = 'portal/index';
 // else {
	 // if(SUBDOMAIN === FALSE) {
		// $route['default_controller'] = "welcome"; 	     
	 // } else {
	     // $route['default_controller'] = SUBDOMAIN;
	     // $route['index/(:any)/(:any)/(:any)'] = SUBDOMAIN . "/index/$1/$2/$3";
	     // $route['index/(:any)/(:any)'] = SUBDOMAIN . "/index/$1/$2";
	     // $route['index/(:any)'] = SUBDOMAIN . "/index/$1";
	     // $route['templateLoader/(:any)/(:any)/(:any)'] = SUBDOMAIN . "/templateLoader/$1/$2/$3";
	     // $route['templateLoader/(:any)/(:any)'] = SUBDOMAIN . "/templateLoader/$1/$2";
	     // $route['templateLoader/(:any)'] = SUBDOMAIN . "/templateLoader/$1";
	     // $route['email/(:any)/(:any)/(:any)'] = SUBDOMAIN . "/email/$1/$2/$3";
	     // $route['email/(:any)/(:any)'] = SUBDOMAIN . "/email/$1/$2";
	     // $route['email/(:any)'] = SUBDOMAIN . "/email/$1";
	 // }
 // }
// $route['webapps/templateLoader/(:any)'] = 'webapps/templateLoader/index/$1';
$route['webapps/templateLoader/(:any)'] = 'portal/templateLoader/index/';
$route['default_controller'] = "welcome"; 	
$route['webapps'] = 'webapps/index';
$route['portal'] = 'portal/index';
$route['404_override'] = 'my404';


/* End of file routes.php */
/* Location: ./application/config/routes.php */