<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('IS_MOBILE', false);

// ================= Dynamic Routes -- Started ================================================

/*
 * 	Dynamic Slugs for
 * 		->	Listings
 * 		->	Pages
 * 		->	Tradeshows
 * */

$db = getDBConnector();

/*
 * Listings Route with High Priority
 * */
$db->select('l.slug as listing_slug');
$db->from('listings_new as l');
$query = $db->get();
$listing_slugs_arr = $query->result();

foreach( $listing_slugs_arr as $listing_slug )
{
    //$route[ '(' . $listing_slug->listing_slug . ')' ] = 'checkslug/listing/$1';
    $route[ '(' . $listing_slug->listing_slug . ')' ] = 'listing/show_by_slug/$1';
}
unset($listing_slugs_arr);
unset($listing_slug);

/*
 * Categories
 * */
// require_once APPPATH . 'classes/JsonManipulation.php';
// $jsonManipulation = (new \application\classes\JsonManipulation());
// $slug = strtolower($this->uri->segment(1));
// $parent_id = $jsonManipulation->get_parent_cat_id_from_cat_slug($slug);
// $cat_slugs_arr = $jsonManipulation->get_sub_cats_by_parent_id($parent_id);
$is_lead_page = true;
$slug = strtolower($this->uri->segment(1)); 
$db->select('c.id');
$db->from('categories as c');
$db->where('c.category_type', 'category');
$db->where('c.slug', $slug);
$query = $db->get();
$cat_id = $query->row('id');

if($cat_id && !empty($cat_id)){
$is_lead_page = false;
}
if(!$is_lead_page){
if($this->uri->segment(2) !== null && is_numeric($this->uri->segment(2)) === false){
$db->select('c.id');
$db->from('categories as c');
$db->where('c.parent_ids', 'uncategorised');
$db->where('c.slug', $slug);
$query = $db->get();
$parent_id = $query->row('id');

$db->select('c.slug');
$db->from('categories as c');
$db->where('c.category_type', 'category');
$db->where('c.parent_ids', $parent_id);
$query = $db->get();
$cat_slugs_arr = $query->result();
foreach( $cat_slugs_arr as $cat_slug )
{
    $route[ '(' . $slug . ')/(' . $cat_slug->slug . ')' ] = 'listing/index/$1';
    $route[ '(' . $slug . ')/(' . $cat_slug->slug . ')/(:num)' ] = 'listing/index/$1/$2';
    $route[ '(' . $slug . ')/(' . $cat_slug->slug . ')/(:num)/(:num)' ] = 'listing/index/$1/$2/$3';
    $route[ '(' . $slug . ')/(' . $cat_slug->slug . ')/(:num)/(:num)/(:num)' ] = 'listing/index/$1/$2/$3/$4';
}  
}else{
    $route[ '(' . $slug . ')' ] = 'listing/index/$1';
    $route[ '(' . $slug . ')/(:num)' ] = 'listing/index/$1/$2';
    $route[ '(' . $slug . ')/(:num)/(:num)' ] = 'listing/index/$1/$2/$3';
    $route[ '(' . $slug . ')/(:num)/(:num)/(:num)' ] = 'listing/index/$1/$2/$3/$4';
}

unset($cat_slugs_arr);
unset($cat_slug);
unset($slug);
}
unset($is_lead_page);

/*
 * buying-lead cats
 * */
$db->select('c.slug');
$db->from('categories as c');
$db->where('c.category_type', 'buying_lead');
$query = $db->get();
$cat_slugs_arr = $query->result();

foreach( $cat_slugs_arr as $cat_slug )
{
    $route[ 'buying-leads/(' . $cat_slug->slug . ')' ] = 'categories/buying_lead_show_by_slug/$1';
    $route[ 'buying-leads/(' . $cat_slug->slug .  ')' . '/(:any)/(:any)' ] = 'categories/buying_lead_show_by_slug/$1/$2/$3';
    $route[ 'buying-leads/(' . $cat_slug->slug .  ')' . '/(:any)' ] = 'categories/buying_lead_show_by_slug/$1/$2';
}
unset($cat_slugs_arr);
unset($cat_slug);

/*
 * seller-lead cats
 * */
$db->select('c.slug');
$db->from('categories as c');
$db->where('c.category_type', 'seller_lead');
$query = $db->get();
$cat_slugs_arr = $query->result();

foreach( $cat_slugs_arr as $cat_slug )
{
    $route[ 'seller-leads/(' . $cat_slug->slug . ')' ] = 'categories/seller_lead_show_by_slug/$1';
    $route[ 'seller-leads/(' . $cat_slug->slug .  ')' . '/(:any)/(:any)' ] = 'categories/seller_lead_show_by_slug/$1/$2/$3';
    $route[ 'seller-leads/(' . $cat_slug->slug .  ')' . '/(:any)' ] = 'categories/seller_lead_show_by_slug/$1/$2';
}
unset($cat_slugs_arr);
unset($cat_slug);

/*
 * Pages
 * */
$db->select('p.slug as page_slug');
$db->from('posts as p');
$db->where('type', 'page');
$query = $db->get();
$pages_slugs_arr = $query->result();

foreach( $pages_slugs_arr as $page_slug )
{
    $route[ '(' . $page_slug->page_slug . ')' ] = 'pages/show_by_slug/$1';
}
unset($pages_slugs_arr);
unset($page_slug);



/*
 * Tradeshow
 * */
$db->select('p.slug as tradeshow_slug');
$db->from('posts as p');
$db->where('type', 'tradeshow');
$query = $db->get();
$tradeshow_slugs_arr = $query->result();

foreach( $tradeshow_slugs_arr as $tradeshow_slug )
{
    $route[ 'tradeshow/(' . $tradeshow_slug->tradeshow_slug . ')' ] = 'tradeshows/show_by_slug/$1';
}
unset($tradeshow_slugs_arr);
unset($tradeshow_slug);

// ================= Dynamic Routes -- Ends ================================================

$route['default_controller'] = 'home';
$route['signup'] = 'Users/create_user';
$route['login'] = 'Users/login';
$route['dashboard'] = 'dashboard';
$route['unfollow-dashboard'] = 'dashboard/unfollow_dashboard';
$route['flaglisting/(:any)/(:num)/(:any)'] = 'flagreports/index/$1/$2';
$route['about-us'] = 'Aboutus/index';
$route['advertise-with-us'] = 'Advertisewithus/index';
$route['privacy-policy'] = 'Privacypolicy/index';
$route['career'] = 'DesktopCareers/index';
$route['404_override'] = 'sorry';
$route['tradeshows/load_more_data'] = 'tradeshows/load_more_data';
// to get rows on load more button 
$route['tradeshows'] = 'tradeshows/index';
$route['jobslisting/(:any)'] = 'Jobslisting/index/$1';
$route['contact-us'] = 'Contactus/index';
$route['purchase/(:num)/(:any)'] = 'paymentplans/purchase/$1/$2';
    $route['ad-post'] = 'Users/add_post';
     $route['submit-ad-post'] = 'Users/submit_ad_post';
     $route['edit-ad-post/(:num)'] = 'Users/edit_ad_post/$1';
$route['payment-plans'] = 'Paymentplans/index';
$route['payment-details'] = 'Paymentplans/payment_details';
$route['translate_uri_dashes'] = FALSE;

/**
 * Listing Route with less priority
 */
$route['member/(:any)'] = 'dashboard/user_listing/$1';
$route['add-buying-lead'] = 'Users/add_buying_lead';
$route['submit-buying-lead'] = 'Users/submit_buying_lead';
$route['buying-leads'] = 'listing/buying_leads';
$route['add-seller-lead'] = 'Users/add_seller_lead';
$route['submit-seller-lead'] = 'Users/submit_seller_lead';
$route['seller-leads'] = 'listing/seller_leads';
$route['listing/search'] = 'listing/search';
$route['listing/propertysearch'] = 'listing/propertysearch';
$route['listing/savesearch'] = 'listing/savesearch';
$route['listing/removesearch'] = 'listing/removesearch';
$route['listing/reset_membership'] = 'listing/reset_membership';
$route['listing/user_membership_check'] = 'listing/user_membership_check';
$route['listing/get_state_ajax'] = 'listing/get_state_ajax/$1';
$route['listing/get_city_ajax'] = 'listing/get_city_ajax/$1';
$route['listing/get_subchild_ajax'] = 'listing/get_subchild_ajax/$1';

$route['listing/get_formdb_ajax'] = 'listing/get_formdb_ajax/$1';
$route['listing/get_formdb_ajax2'] = 'listing/get_formdb_ajax2/$1';
$route['listing/(:any)/(:num)/(:num)/(:num)'] = 'listing/view/$1/$2/$3/$4';
$route['listing/(:any)/(:num)/(:num)'] = 'listing/view/$1/$2/$3';
$route['listing/(:any)/(:num)'] = 'listing/view/$1/$2';
$route['listing/(:any)'] = 'listing/index/$1';
$route['message/(:num)/(:num)/(:any)/(:any)/(:any)'] = 'Listing/comments/$1/$2/$3/$4/$5';
$route['search-by-city'] = 'home/search_by_city';
$route['category-by-city'] = 'home/category_by_city';

////// Exchange Rates//////

$route['rates'] = 'Exchange/index';

$route['home-test'] = 'home/index_new';
//$route['home-json'] = 'home/make_home_json';
$route['home-json'] = 'home/make_all_countries_home_page_json';
$route['home-json2'] = 'home/make_all_countries_home_page_json2';
$route['home-json3'] = 'home/make_all_countries_home_page_json3';
$route['data_transfer'] = 'home/data_transfer';
$route['data_transfer'] = 'home/data_transfer';
$route['ajax_get_states_by_country_id'] = 'home/ajax_get_states_by_country_id';
