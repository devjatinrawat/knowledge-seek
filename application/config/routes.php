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
$route['default_controller'] = 'home';
$route['404_override'] = 'home/error404';
$route['translate_uri_dashes'] = FALSE;


//users Routes
$route['notes'] = 'users/notes';
$route['syllabus/(:num)'] = 'users/notes/showNotes/$1';
$route['papers'] = 'users/papers';
$route['books'] = 'users/books';
$route['about'] = 'users/Pages/aboutUs';
$route['contact']='users/Pages/contactUs';
$route['blogs'] = 'users/blogs';
$route['blogpost/(:num)'] =  'users/blogs2/index/$1';
$route['blogcomment/(:num)'] =  'users/blogs2/blogComment/$1';

// admin
$route['kSeek/control_panel/unlock'] = 'admin/Admin_login';
$route['dashboard'] = 'admin/admin';
$route['contact_detail'] = 'admin/Contact';
$route['programe'] = 'admin/Programe';
$route['branch'] = 'admin/Branch';
$route['subjects'] = 'admin/Subject';
$route['syllabus'] = 'admin/Syllabus';
$route['admin_notes'] = 'admin/Notes';
$route['admin_papers'] = 'admin/Papers';
$route['admin_books']='admin/Books';
$route['category'] = 'admin/Category';
$route['create_category'] = 'admin/Category/create';
$route['category_edit/(:num)']='admin/category/edit/$1';

$route['article'] = 'admin/Article';
$route['create_article'] = 'admin/Article/create';
$route['article_edit/(:num)']='admin/article/edit/$1';

$route['comments/(:num)']='admin/comment/index/$1';

$route['change_password'] = 'admin/Admin_login/changePassword';
$route['forgot_password'] = 'admin/Admin_login/forgotPass';
$route['admin_change_password/(:num)'] = 'admin/admin/logedin_pass_change/$1';