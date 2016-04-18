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
|	http://codeigniter.com/user_guide/general/routing.html
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
// custom uri
$route['search'] = 'home_page/search';
$route['view/(:num)'] = 'home_page/view/$1';
//
$route['news'] = 'home_page/news';
$route['news/page'] = 'home_page/news/page';
$route['news/page/(:num)'] = 'home_page/news/page/$1';

$route['news/(:num)']    = 'home_page/news/$1';
$route['news/(:num)/page']    = 'home_page/news/$1/page';
$route['news/(:num)/page/(:num)']    = 'home_page/news/$1/page/$2';

$route['techniques'] = 'home_page/techniques';
$route['techniques/page'] = 'home_page/techniques/page';
$route['techniques/page/(:num)'] = 'home_page/techniques/page/$1';

$route['techniques/(:num)']    = 'home_page/techniques/$1';
$route['techniques/(:num)/page']    = 'home_page/techniques/$1/page';
$route['techniques/(:num)/page/(:num)']    = 'home_page/techniques/$1/page/$2';

$route['publications'] = 'home_page/publications';
$route['publications/page'] = 'home_page/publications/page';
$route['publications/page/(:num)'] = 'home_page/publications/page/$1';

$route['publications/(:num)']    = 'home_page/publications/$1';
$route['publications/(:num)/page']    = 'home_page/publications/$1/page';
$route['publications/(:num)/page/(:num)']    = 'home_page/publications/$1/page/$2';

//$route['policy-regulation'] = 'home_page/policy_regulation';
//$route['policy-regulation/page'] = 'home_page/policy_regulation/page';
//$route['policy-regulation/page/(:num)'] = 'home_page/policy_regulation/page/$1';
//
//$route['policy-regulation/(:num)']    = 'home_page/policy_regulation/$1';
//$route['policy-regulation/(:num)/page']    = 'home_page/policy_regulation/$1/page';
//$route['policy-regulation/(:num)/page/(:num)']    = 'home_page/policy_regulation/$1/page/$2';
//
//$route['books'] = 'home_page/books';
//$route['books/page'] = 'home_page/books/page';
//$route['books/page/(:num)'] = 'home_page/books/page/$1';
//
//$route['books/(:num)']    = 'home_page/books/$1';
//$route['books/(:num)/page']    = 'home_page/books/$1/page';
//$route['books/(:num)/page/(:num)']    = 'home_page/books/$1/page/$2';

$route['product-sale-rent'] = 'home_page/product_sale_rent';
$route['product-sale-rent/page'] = 'home_page/product_sale_rent/page';
$route['product-sale-rent/page/(:num)'] = 'home_page/product_sale_rent/page/$1';

$route['product-sale-rent/(:num)']    = 'home_page/product_sale_rent/$1';
$route['product-sale-rent/(:num)/page']    = 'home_page/product_sale_rent/$1/page';
$route['product-sale-rent/(:num)/page/(:num)']    = 'home_page/product_sale_rent/$1/page/$2';

$route['product-detail/(:num)'] = 'home_page/product_detail/$1';

$route['land-sale-rent'] = 'home_page/land_sale_rent';
$route['land-sale-rent/page'] = 'home_page/land_sale_rent/page';
$route['land-sale-rent/page/(:num)'] = 'home_page/land_sale_rent/page/$1';

$route['land-sale-rent/(:num)']    = 'home_page/land_sale_rent/$1';
$route['land-sale-rent/(:num)/page']    = 'home_page/land_sale_rent/$1/page';
$route['land-sale-rent/(:num)/page/(:num)']    = 'home_page/land_sale_rent/$1/page/$2';

$route['land-detail/(:num)'] = 'home_page/land_detail/$1';

$route['job'] = 'home_page/job';
$route['job/page'] = 'home_page/job/page';
$route['job/page/(:num)'] = 'home_page/job/page/$1';

$route['job/(:num)']    = 'home_page/job/$1';
$route['job/(:num)/page']    = 'home_page/job/$1/page';
$route['job/(:num)/page/(:num)']    = 'home_page/job/$1/page/$2';

$route['filter-location/(:num)'] = 'home_page/filter_location/$1';

$route['job-detail/(:num)']    = 'home_page/job_detail/$1';

$route['video'] = 'home_page/video';
$route['video/page'] = 'home_page/video/page';
$route['video/page/(:num)'] = 'home_page/video/page/$1';

$route['video/(:num)']    = 'home_page/video/$1';
$route['video/(:num)/page']    = 'home_page/video/$1/page';
$route['video/(:num)/page/(:num)']    = 'home_page/video/$1/page/$2';

$route['video-detail/(:num)'] = 'home_page/video_detail/$1';

//
//$route['more/(:num)/(:num)']    = 'home_page/more/$1/$2';
//$route['more/(:num)/(:num)/page']    = 'home_page/more/$1/$2/page';
//$route['more/(:num)/(:num)/page/(:num)']    = 'home_page/more/$1/$2/page/$3';
//
//$route['buy-sell/(:num)']    = 'home_page/buy_sell/$1';
//$route['buy-sell/(:num)/page']    = 'home_page/buy_sell/$1/page';
//$route['buy-sell/(:num)/page/(:num)']    = 'home_page/buy_sell/$1/page/$2';
//
//$route['classified-detail/(:num)'] = 'home_page/classified_detail/$1';
//
//$route['real-estate/(:num)']    = 'home_page/real_estate/$1';
//$route['real-estate/(:num)/page']    = 'home_page/real_estate/$1/page';
//$route['real-estate/(:num)/page/(:num)']    = 'home_page/real_estate/$1/page/$2';
//
//$route['real-estate-detail/(:num)'] = 'home_page/real_estate_detail/$1';
//
$route['about-us'] = 'home_page/about_us';
$route['contact-us'] = 'home_page/contact_us';
$route['register'] = 'home_page/register';
//$route['policy'] = 'home_page/policy';
//$route['condition'] = 'home_page/condition';
//$route['login'] = 'home_page/login';
//$route['signup'] = 'home_page/signup';
//$route['signup-company'] = 'home_page/signup_company';
//$route['signup-personal'] = 'home_page/signup_personal';
//$route['weather'] = 'home_page/weather';
//$route['search'] = 'home_page/search';
//
//$route['member/(:num)'] = 'home_page/member/$1';

//$route['([a-zA-Z-]+)'] = 'home_page/member/$1';

$route['default_controller'] = 'home_page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
