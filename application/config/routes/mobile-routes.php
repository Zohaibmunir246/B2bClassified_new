<?php

defined('BASEPATH') OR exit('No direct script access allowed');

define('IS_MOBILE', true);

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
	$route[ '(' . $listing_slug->listing_slug . ')' ] = 'MobileListing/show_by_slug/$1';
}
unset($listing_slugs_arr);
unset($listing_slug);


/*
 * Categories
 * */
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
    $route[ '(' . $slug . ')/(' . $cat_slug->slug . ')' ] = 'MobileListing/index/$1';
    $route[ '(' . $slug . ')/(' . $cat_slug->slug . ')/(:num)' ] = 'MobileListing/index/$1/$2';
    $route[ '(' . $slug . ')/(' . $cat_slug->slug . ')/(:num)/(:num)' ] = 'MobileListing/index/$1/$2/$3';
    $route[ '(' . $slug . ')/(' . $cat_slug->slug . ')/(:num)/(:num)/(:num)' ] = 'MobileListing/index/$1/$2/$3/$4';
}  
}else{
    $route[ '(' . $slug . ')' ] = 'MobileListing/index/$1';
    $route[ '(' . $slug . ')/(:num)' ] = 'MobileListing/index/$1/$2';
    $route[ '(' . $slug . ')/(:num)/(:num)' ] = 'MobileListing/index/$1/$2/$3';
    $route[ '(' . $slug . ')/(:num)/(:num)/(:num)' ] = 'MobileListing/index/$1/$2/$3/$4';
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
	$route[ 'buying-lead/(' . $cat_slug->slug . ')' ] = 'MobileCategories/buying_lead_show_by_slug/$1';
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
	$route[ 'seller-lead/(' . $cat_slug->slug . ')' ] = 'MobileCategories/seller_lead_show_by_slug/$1';
}
unset($cat_slugs_arr);
unset($cat_slug);


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
	$route[ 'tradeshow/(' . $tradeshow_slug->tradeshow_slug . ')' ] = 'MobileTradeshows/show_by_slug/$1';
}
unset($tradeshow_slugs_arr);
unset($tradeshow_slug);



// ================= Dynamic Routes -- Ends ================================================

$route['default_controller'] = 'MobileHome';
$route['mobilehome'] = 'MobileHome';
$route['search'] = 'MobileListing/mobile_search';
$route['child-cats'] = 'MobileListing/get_subchild_ajax';
$route['listing/search'] = 'MobileListing/search';
$route['listingsearch/sidebar'] = 'MobileListing/search';
$route['ajax__get_cities_by_state_id'] = 'Users/ajax__get_cities_by_state_id';
// user dashboards
$route['dashboard'] = 'MobileDashboard';
$route['member/(:any)'] = 'MobileDashboard/user_listing/$1';
$route['dashboard/my-ads'] = 'MobileDashboard/my_ads';
$route['dashboard/del-my-ads'] = 'MobileDashboard/del_my_ads';
$route['dashboard/favourite-ads'] = 'MobileDashboard/favourite_ads';
$route['dashboard/followings'] = 'MobileDashboard/followings';
$route['dashboard/un-followings'] = 'MobileDashboard/unfollowing_dashboard';
$route['dashboard/followers'] = 'MobileDashboard/followers';

$route['un-followers'] = 'MobileDashboard/unfollow_dashboard';
$route['dashboard/edit-profile'] = 'MobileDashboard/edit_profile';
$route['dashboard/my-plan'] = 'MobileDashboard/my_plan';
$route['dashboard/insert'] = 'MobileDashboard/insert';

$route['add-buying-lead'] = 'MobileUsers/add_buying_lead';
$route['submit-buying-lead'] = 'MobileUsers/submit_buying_lead';
$route['buying-leads'] = 'MobileListing/buying_leads';
$route['add-seller-lead'] = 'MobileUsers/add_seller_lead';
$route['submit-seller-lead'] = 'MobileUsers/submit_seller_lead';
$route['seller-leads'] = 'MobileListing/seller_leads';

$route['ad-post'] = 'MobileUsers/add_post';
$route['submit-ad-post'] = 'MobileUsers/submit_ad_post';
$route['edit-ad-post/(:num)'] = 'MobileUsers/edit_ad_post/$1';
$route['ad-post-cat'] = 'MobileUsers/add_cat';
$route['payment-plans'] = 'MobilePaymentPlans/index';
$route['payment-details'] = 'MobilePaymentPlans/payment_details';
$route['career'] = 'MobileCareers/index';
$route['faqs'] = 'MobileFaqs/index';
$route['terms'] = 'MobileTerms/index';
$route['about-us'] = 'MobileAboutus/index';
$route['privacy-policy'] = 'MobilePrivacypolicy/index';
$route['flaglisting/(:any)/(:num)/(:any)'] = 'MobileFlagreports/index/$1/$2';

$route['purchase/(:num)/(:any)'] = 'MobilePaymentPlans/purchase/$1/$2';
$route['contact-us'] = 'MobileContactus';
$route['tradeshows'] = 'MobileTradeshows/index';
$route['tradeshows/load_more_data'] = 'MobileTradeshows/load_more_data';
$route['advertise-with-us'] = 'MobileAdvertisewithus/index';
$route['404_override'] = 'MobileSorry/index';
$route['login'] = 'MobileUsers/login';
$route['signup'] = 'MobileUsers/create_user';
$route['translate_uri_dashes'] = FALSE;
$route['message/(:num)/(:num)/(:any)/(:any)/(:any)'] = 'MobileListing/comments/$1/$2/$3/$4/$5';
$route['Listing/send_reply/(:num)/(:any)'] = 'MobileListing/send_reply/$1/$2';

////// Exchange Rates//////

$route['rates'] = 'Exchange/index';
