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
|    example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|    http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|    $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|    $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
 //echo "<br>REQUEST_URI = ".$_SERVER['REQUEST_URI']; 
$route['default_controller'] = "page";
$route['(ru|en|ua)'] = $route['default_controller']; 
$route['404_override'] = 'page/error_404';   
//payment_done

$route['payment/answer'] = 'payment/answer';   
$route['payment/check_ready_receipts'] = 'payment/check_ready_receipts'; 
 
$route['(ru|en|ua)/payment_done'] = 'page/payment_done';   
$route['(ru|en|ua)/payment/(:any)'] = '/payment/$2';   
$route['(ru|en|ua)/payment/(:any)/(:any)'] = '/payment/$1/$2';   
 
$route['(ru|en|ua)/shop/order_list/(:num)']  = 'shop/order_list/$2';
$route['(ru|en|ua)/shop/order_print/(:num)'] = 'shop/order_print/$2';

$route['(ru|en|ua)/(:any)/(:any)/(:num)'] = 'shop/routing2/$2/$3/$4'; 
$route['(ru|en|ua)/(:any)/(:any)/(:any)'] = 'shop/routing3/$2/$3/$4'; 

$route['(ru|en|ua)/shop/data_load_tour_dates'] = 'shop/data_load_tour_dates';  
//order_print
$route['(ru|en|ua)/order_print/(:num)']     = 'user/order_print/$2';  
$route['(ru|en|ua)/user/(:any)']     = 'user/$2';       
$route['(ru|en|ua)/user/(:any)/(:any)']     = 'user/$1/$2';       
$route['(ru|en|ua)/tmk_ch/(:any)']     = 'user/tmk_ch/$2';   
$route['(ru|en|ua)/tmk/(:any)']     = 'user/take_my_komission/$2';   
$route['(ru|en|ua)/rl/(:num)']     = 'page/rl/$2';         

$route['(ru|en|ua)/comments/(:any)']     = 'shop/comments/$2';  
//$route['(ru|en|ua)/login/loginSubmit']      = 'login/loginSubmit';   
$route['(ru|en|ua)/shop/order_done'] = 'shop/order_done'; 
$route['(ru|en|ua)/page/set_lang'] = 'page/set_lang'; 

$route['(ru|en|ua)/page/feed']       = 'page/feed';
$route['(ru|en|ua)/page/get_komission']       = 'page/get_komission';
// 
$route['(ru|en|ua)/page/partners_feed']      = 'page/partners_feed';
$route['(ru|en|ua)/news/(:num)']     = 'page/news/$2';

$route['(ru|en|ua)/gallery/(:num)']  = 'gallery/index/$2';

$route['(ru|en|ua)/(:any)/(:num)']   = 'shop/routing1/$2/$3'; 
$route['(ru|en|ua)/(:any)/(:any)']   = 'shop/routing2/$2/$3';

$route['(ru|en|ua)/reviews']      = 'page/reviews';
$route['(ru|en|ua)/news']      = 'page/news';
$route['(ru|en|ua)/all-news']  = 'page/all_news';
$route['(ru|en|ua)/gallery']   = 'gallery'; 
$route['(ru|en|ua)/user']      = 'user';  

$route['(ru|en|ua)/logout']      = 'login/logout';  

$route['(ru|en|ua)/404']   = 'shop/error_404';  
  
$route['(ru|en|ua)/(:any)']    = 'shop/routing1/$2';   

     

 
 // ([a-zA-Z0-9]+)
  
 // **************************************88 
 //*****************************************
 


/* End of file routes.php */      
/* Location: ./application/config/routes.php */