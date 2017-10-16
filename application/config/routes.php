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
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//route for login
$route['login'] = 'auth';
$route['login/(:any)'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['admin'] = 'auth';
$route['administrator'] = 'auth';
$route['sigin'] = 'auth';
$route['sigout'] = 'auth/logout';

//route for identitas
$route['data/identitas/(:num)'] = 'data/identitas';
$route['data/cpns/(:num)'] = 'data/cpns';
$route['data/cpns/updated/(:num)'] = 'data/cpns/updated';
$route['data/cpns/created/(:num)'] = 'data/cpns/created';

$route['data/pns/(:num)'] = 'data/pns';
$route['data/pns/created/(:num)'] = 'data/pns/created';
$route['data/pns/updated/(:num)'] = 'data/pns/updated';

$route['data/pangkat/(:num)'] = 'data/pangkat';
$route['data/pangkat/created/(:num)'] = 'data/pangkat/created';
$route['data/pangkat/updated/(:num)'] = 'data/pangkat/updated';

$route['data/jabatan/(:num)'] = 'data/jabatan';
$route['data/jabatan/created/(:num)'] = 'data/jabatan/created';
$route['data/jabatan/updated/(:num)'] = 'data/jabatan/updated';

$route['data/pendidikan/(:num)'] = 'data/pendidikan';
$route['data/pendidikan/created/(:num)'] = 'data/pendidikan/created';
$route['data/pendidikan/updated/(:num)'] = 'data/pendidikan/updated';

$route['data/diklat/(:num)'] = 'data/diklat';
$route['data/diklat/created/(:num)'] = 'data/diklat/created';
$route['data/diklat/updated/(:num)'] = 'data/diklat/updated';

$route['report/biodata/(:num)'] = 'report/biodata';