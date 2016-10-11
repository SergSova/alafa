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
 $route['default_controller'] = "page";
 
 $route['404_override'] = 'page/error_404'; 
 
  
 $route['authorization/(.+)'] = 'authorization/$1';
 $route['admin/(.+)'] = 'admin/$1';   
 $route['managment'] = 'managment';
 $route['managment/(.+)'] = 'managment/$1';
 $route['admin'] = 'admin';   
 $route['authorization'] = 'authorization';              
  $route['manage_pages/(.+)'] = 'manage_pages/$1';
  $route['manage_news/(.+)'] = 'manage_news/$1'; 
  $route['manage_offer/(.+)'] = 'manage_offer/$1';
  $route['manage_ban'] = 'manage_ban';  
  $route['manage_converter'] = 'manage_converter';
  $route['manage_ban/(.+)'] = 'manage_ban/$1';      
  $route['manage_blocks/(.+)'] = 'manage_blocks/$1';   
  $route['manage_converter/(.+)'] = 'manage_converter/$1';
  $route['manage_customers/(.+)'] = 'manage_customers/$1';  
  $route['manage_settings/(.+)'] = 'manage_settings/$1';     
  $route['manage_statistic/(.+)'] = 'manage_statistic/$1'; 
  $route['subscribe/(.+)'] = 'subscribe/$1';                                                      
   $route['manage_statistic'] = 'manage_statistic'; 
  //manage_statistic
  $route['login/(.+)'] = 'login/$1';
  
  
$route['page/(.+)'] = 'page/$1';
  
         
$route['(:any)/(:any)/(:num)'] = 'page/routing2/$1/$2/$3'; 
$route['(:any)/(:any)/(:any)'] = 'page/routing3/$1/$2/$3'; 
      
$route['news/(:num)']      = 'page/news/$1';                 

$route['(:any)/(:num)']    = 'page/routing1/$1/$2'; 
$route['(:any)/(:any)']    = 'page/routing2/$1/$2';


                                       
$route['news']      = 'page/news';
$route['gallery']   = 'gallery/gallery'; 
$route['user']      = 'user';  
 
$route['(:any)']    = 'page/routing1/$1';   

           
// $route['(en|ru)/(.+)'] = '$2';

/* End of file routes.php */      
/* Location: ./application/config/routes.php */