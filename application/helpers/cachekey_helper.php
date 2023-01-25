<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require (FCPATH . 'enviornments.php');
 
if (!function_exists('get_followers_of_user_id_cache_key')) {
	function get_followers_of_user_id_cache_key($user_id)
	{
		if (!defined('__GET_FOLLOWERS_OF_USER_ID_'. $user_id .'__'))
        define('__GET_FOLLOWERS_OF_USER_ID_'. $user_id .'__', 'get_followers_of_user_id_' . $user_id);

		return '__GET_FOLLOWERS_OF_USER_ID_'. $user_id .'__';
	}
}

if (!function_exists('get_followings_of_user_id_cache_key')) {
	function get_followings_of_user_id_cache_key($user_id)
	{
		if (!defined('__GET_FOLLOWINGS_OF_USER_ID_'. $user_id .'__'))
		define('__GET_FOLLOWINGS_OF_USER_ID_'. $user_id .'__', 'get_followings_of_user_id_' . $user_id);

		return '__GET_FOLLOWINGS_OF_USER_ID_'. $user_id .'__';
	}
}

if (!function_exists('get_id_of_follower_cache_key')) {
	function get_id_of_follower_cache_key($follower_id)
	{
		if (!defined('__GET_ID_OF_FOLLOWER__'. $follower_id .'__'))
        define('__GET_ID_OF_FOLLOWER__'. $follower_id .'__', 'get_id_of_follower_' . $follower_id);

		return '__GET_ID_OF_FOLLOWER__'. $follower_id .'__';
	}
}

if (!function_exists('get_id_of_following_cache_key')) {
	function get_id_of_following_cache_key($following_id)
	{
		if (!defined('__GET_ID_OF_FOLLOWING__'. $following_id .'__'))
        define('__GET_ID_OF_FOLLOWING__'. $following_id .'__', 'get_id_of_following_' . $following_id);

		return '__GET_ID_OF_FOLLOWING__'. $following_id .'__';
	}
}

if (!function_exists('get_user_meta_data_cache_key')) {
	function get_user_meta_data_cache_key($user_id)
	{
		if (!defined('__GET_USER_META_DATA_OF_USER_ID'. $user_id .'__'))
		define('__GET_USER_META_DATA_OF_USER_ID'. $user_id .'__', 'get_user_meta_data_of_' . $user_id);
		return '__GET_USER_META_DATA_OF_USER_ID'. $user_id .'__';
	}
}

if (!function_exists('get_user_data_cache_key')) {
	function get_user_data_cache_key($user_id)
	{
		if (!defined('__GET_USER_DATA_OF_USER_ID'. $user_id .'__'))
		define('__GET_USER_DATA_OF_USER_ID'. $user_id .'__', 'get_user_data_of_' . $user_id);
		return '__GET_USER_DATA_OF_USER_ID'. $user_id .'__';
	}
}

if (!function_exists('get_save_favourite_listing_id_cache_key')) {
	function get_save_favourite_listing_id_cache_key($listing_meta_id,$search_query = '',$parent_cat = '')
	{
		if (!defined('__GET_SAVE_FAVOURITE_LISTING_ID_OF_LISTING_META_ID_'. $listing_meta_id .'AND_SEARCH_QUERY'. $search_query .'AND_PARENT_CAT_'.$parent_cat.'__'))
		define('__GET_SAVE_FAVOURITE_LISTING_ID_OF_LISTING_META_ID_'. $listing_meta_id .'AND_SEARCH_QUERY'. $search_query .'AND_PARENT_CAT_'.$parent_cat.'__', 'get_save_favourite_listing_id_by_listing_meta_id' . $listing_meta_id .'and_search_query'. $search_query.'and_parent_cat_'.$parent_cat);
		return '__GET_SAVE_FAVOURITE_LISTING_ID_OF_LISTING_META_ID_'. $listing_meta_id .'AND_SEARCH_QUERY'. $search_query .'AND_PARENT_CAT_'.$parent_cat.'__';
	}
}

if (!function_exists('get_listing_data_cache_key')) {
	function get_listing_data_cache_key($listing_id,$search_query = '',$parent_cat = '',$status = '')
	{
		if (!defined('__GET_LISTING_DATA_OF_LISTING_ID_'. $listing_id .'AND_SEARCH_QUERY'. $search_query .'AND_PARENT_CAT_'.$parent_cat.'AND_STATUS'.$status.'__'))

		define('__GET_LISTING_DATA_OF_LISTING_ID_'. $listing_id .'AND_SEARCH_QUERY'. $search_query .'AND_PARENT_CAT_'.$parent_cat.'AND_STATUS'.$status.'__', 'get_listings_data_of_listing_id_'. $listing_id .  'and_search_query'. $search_query.'and_parent_cat'. $parent_cat . 'and_status'. $status);

		return '__GET_LISTING_DATA_OF_LISTING_ID_'. $listing_id .'AND_SEARCH_QUERY'. $search_query .'AND_PARENT_CAT_'.$parent_cat.'AND_STATUS'.$status.'__';
	}
}

if (!function_exists('get_city_name_cache_key')) {
	function get_city_name_cache_key($city_id)
	{
		if (!defined('__GET_CITY_NAME_BY_ID'. $city_id .'__'))
		define('__GET_CITY_NAME_BY_ID'. $city_id .'__', 'get_city_name_by_' . $city_id);
		return '__GET_CITY_NAME_BY_ID'. $city_id .'__';
	}
}

if (!function_exists('get_country_name_cache_key')) {
	function get_country_name_cache_key($country_id)
	{
		if (!defined('__GET_COUNTRY_NAME_BY_ID'. $country_id .'__'))
		define('__GET_COUNTRY_NAME_BY_ID'. $country_id .'__', 'get_country_name_by_' . $country_id);
		return '__GET_COUNTRY_NAME_BY_ID'. $country_id .'__';
	}
}

if (!function_exists('get_state_name_cache_key')) {
	function get_state_name_cache_key($state_id)
	{
		if (!defined('__GET_STATE_NAME_BY_ID_'. $state_id .'__'))
		define('__GET_STATE_NAME_BY_ID_'. $state_id .'__', 'get_state_name_by_id_' . $state_id);
		return '__GET_STATE_NAME_BY_ID_'. $state_id .'__';
	}
}
if (!function_exists('get_category_name_cache_key')) {
	function get_category_name_cache_key($category_id)
	{
		if (!defined('__GET_CATEGORY_NAME_BY_ID_'. $category_id .'__'))
		define('__GET_CATEGORY_NAME_BY_ID_'. $category_id .'__', 'get_category_name_by_id_' . $category_id);
		return '__GET_CATEGORY_NAME_BY_ID_'. $category_id .'__';
	}
}
if (!function_exists('get_sub_category_name_cache_key')) {
	function get_sub_category_name_cache_key($sub_category_id)
	{
		if (!defined('__GET_SUB_CATEGORY_NAME_BY_ID_'. $sub_category_id .'__'))
		define('__GET_SUB_CATEGORY_NAME_BY_ID_'. $category_id .'__', 'get_sub_category_name_by_id_' . $sub_category_id);
		return '__GET_SUB_CATEGORY_NAME_BY_ID_'. $sub_category_id .'__';
	}
}
if (!function_exists('get_saved_listings_cache_key')) {
	function get_saved_listings_cache_key($listing_id)
	{
		if (!defined('__GET_SAVED_LISTINGS_BY_ID'. $listing_id .'__'))
		define('__GET_SAVED_LISTINGS_BY_ID'. $listing_id .'__', 'get_saved_listings_of_' . $listing_id);
		return '__GET_SAVED_LISTINGS_BY_ID'. $listing_id .'__';
	}
}
if (!function_exists('get_saved_listings_cache_key')) {
	function get_saved_listings_meta_cache_key($listing_id)
	{
		if (!defined('__GET_SAVED_LISTINGS_META_BY_ID'. $listing_id .'__'))
		define('__GET_SAVED_LISTINGS_META_BY_ID'. $listing_id .'__', 'get_saved_listings_meta_of_' . $listing_id);
		return '__GET_SAVED_LISTINGS_META_BY_ID'. $listing_id .'__';
	}
}
if (!function_exists('get_total_posts_cache_key')) {
	function get_total_posts_cache_key($user_id)
	{
		if (!defined('__GET_TOTAL_POSTS_BY_USER_ID'. $user_id .'__'))
		define('__GET_TOTAL_POSTS_BY_USER_ID'. $user_id .'__', 'get_total_post_of_user_id_' . $user_id);
		return '__GET_TOTAL_POSTS_BY_USER_ID'. $user_id .'__';
	}
}
if (!function_exists('get_user_meta_value_cache_key')) {
	function get_user_meta_value_cache_key($user_id)
	{
		if (!defined('__GET_USER_META_VALUE_OF_USER_ID_'. $user_id .'__'))
		define('__GET_USER_META_VALUE_OF_USER_ID_'. $user_id .'__', 'get_user_meta_value_of_user_id_' . $user_id);
		return '__GET_USER_META_VALUE_OF_USER_ID_'. $user_id .'__';
	}
}
if (!function_exists('get_basic_search_cache_key')) {
	function get_basic_search_cache_key($col_name)
	{
		if (!defined('__GET_BASIC_SEARCH_BY'. $col_name .'__'))
		define('__GET_BASIC_SEARCH_BY'. $col_name .'__', 'get_basic_search_by_' . $user_id);
		return '__GET_BASIC_SEARCH_BY'. $col_name .'__';
	}
}
if (!function_exists('get_main_cat_details_cache_key')) {
	function get_main_cat_details_cache_key($category_id)
	{
		if (!defined('__GET_MAIN_CATS_FOR_DASHBOARD_BY_ID_'.$category_id.'__'))
		define('__GET_MAIN_CATS_FOR_DASHBOARD_BY_ID_'.$category_id.'__', 'get_main_cat_details_for_dashboard_by_' . $category_id);
		return '__GET_MAIN_CATS_FOR_DASHBOARD_BY_ID_'.$category_id.'__';
	}
}
if (!function_exists('get_main_cat_details_cache_key')) {
	function get_main_cat_details_cache_key($category_id)
	{
		if (!defined('__GET_CATEGORY_BY_ID_'.$category_id.'__'))
		define('__GET_CATEGORY_BY_ID_'.$category_id.'__', 'get_category_by_id_' . $category_id);
		return '__GET_CATEGORY_BY_ID_'.$category_id.'__';
	}
}

if (!defined('__GET_BASIC_SEARCH_OF__'))
    define('__GET_MAIN_CATS_FOR_DASHBOARD_OF__', 'get_main_cats_for_dashboard');

//Desktop Home Page Cache
if (!function_exists('get_meta_listing_ids_cache_key')) {
	function get_meta_listing_ids_cache_key($type,$limit,$country_id)
	{
		if (!defined('__GET_META_LISTING_IDS_OF_'.$type.'_LIMIT_'.$limit .'_RECORD_COUNTRY_ID_'.$country_id.'__'))
		define('__GET_META_LISTING_IDS_OF_'.$type.'_LIMIT_'.$limit .'_RECORD_COUNTRY_ID_'.$country_id.'__', 'listings_ids_of_' . $type . '_limit_' . $limit . '_records_country_id_'. intval($country_id));
		return '__GET_META_LISTING_IDS_OF_'.$type.'_LIMIT_'.$limit .'_RECORD_COUNTRY_ID_'.$country_id.'__';
	}
}
if (!function_exists('get_latest_listings_cache_key')) {
	function get_latest_listings_cache_key($type,$limit,$country_id)
	{
		if (!defined('__GET_LATEST_LISTINGS_OF_'.$type.'_LIMIT_'.$limit .'_RECORD_COUNTRY_ID_'.$country_id.'__'))
		define('__GET_LATEST_LISTINGS_OF_'.$type.'_LIMIT_'.$limit .'_RECORD_COUNTRY_ID_'.$country_id.'__', 'latest_listings_of_' . $type . '_limit_' . $limit . '_records_country_id_' . intval($country_id));
		return '__GET_LATEST_LISTINGS_OF_'.$type.'_LIMIT_'.$limit .'_RECORD_COUNTRY_ID_'.$country_id.'__';
	}
}
if (!defined('__GET_LATEST_TRADE_SHOWS__'))
    define('__GET_LATEST_TRADE_SHOWS__', 'get_letest_trade_shows');

//Mobile Home Page Cache
if (!function_exists('get_mobile_meta_listing_ids_cache_key')) {
	function get_mobile_meta_listing_ids_cache_key($limit,$country_id)
	{
		if (!defined('__GET_META_LISTING_IDS_OF_LISTINGS_10_0_RECORD_COUNTRY_ID_'.$country_id.'__'))
		define('__GET_META_LISTING_IDS_OF_LISTINGS_10_0_RECORD_COUNTRY_ID_'.$country_id.'__', 'listings_ids_of_listings_10_0_records_country_id_'. intval($country_id));
		return '__GET_META_LISTING_IDS_OF_LISTINGS_10_0_RECORD_COUNTRY_ID_'.$country_id.'__';
	}
}
if (!function_exists('get_mobile_listing_meta_data_cache_key')) {
	function get_mobile_listing_meta_data_cache_key($listing_id)
	{
		if (!defined('__GET_MOBILE_LISTING_META_DATA_OF_'.$listing_id.'__'))
		define('__GET_MOBILE_LISTING_META_DATA_OF_'.$listing_id.'__', 'mobile_listing_meta_data_' . $listing_id);
		return '__GET_MOBILE_LISTING_META_DATA_OF_'.$listing_id.'__';
	}
}
if (!function_exists('get_mobile_latest_listings_cache_key')) {
	function get_mobile_latest_listings_cache_key($limit,$country_id)
	{
		if (!defined('__GET_MOBILE_LATEST_LISTINGS_LIMIT_10_0_RECORD_COUNTRY_ID_'.$country_id.'__'))
		define('__GET_MOBILE_LATEST_LISTINGS_LIMIT_10_0_RECORD_COUNTRY_ID_'.$country_id.'__', 'latest_mobile_listings_limit_10_0_records_country_id_' . intval($country_id));
		return '__GET_MOBILE_LATEST_LISTINGS_LIMIT_10_0_RECORD_COUNTRY_ID_'.$country_id.'__';
	}
}

// listing pages cache key
if (!function_exists('get_listing_ids_cache_key')) {
	function get_listing_ids_cache_key($type,$limit,$meta_direction = '',$page = 1,$category_id,$country_id)
	{ 	
		if(!$meta_direction)
		$meta_direction = "DESC";
		if (!defined('__GET_LISTING_IDS_OF_TYPE_'.$type.'_LIMIT_'.$limit . '_DIRECTION_'.strtoupper($meta_direction).'_PAGE_' . $page . '_RECORD_CAT_ID_'.$category_id.'_RECORD_COUNTRY_ID_'.$country_id.'__'))

		define('__GET_LISTING_IDS_OF_TYPE_'.$type.'_LIMIT_'.$limit . '_DIRECTION_'.strtoupper($meta_direction).'_PAGE_' . $page . '_RECORD_CAT_ID_'.$category_id.'_RECORD_COUNTRY_ID_'.$country_id.'__',

			'listing_ids_of_type_' . $type . '_limit_' . $limit .'_direction_' . $meta_direction . '_page_' . $page . '_records_cat_id_' . $category_id . '_record_country_id_' . intval($country_id));

		return '__GET_LISTING_IDS_OF_TYPE_'.$type.'_LIMIT_'.$limit . '_DIRECTION_'.strtoupper($meta_direction).'_PAGE_' . $page . '_RECORD_CAT_ID_'.$category_id.'_RECORD_COUNTRY_ID_'.$country_id.'__';
	}
}

if (!function_exists('get_single_listing_data_cache_key')) {
	function get_single_listing_data_cache_key($type,$makes_and_models_where = '',$country_id,$extra_where = '',$limit)
	{
		if (!defined('__GET_LISTING_DATA_OF_TYPE_'.$type.'_LIMIT_'.$limit . '_WHERE_'.$makes_and_models_where . '_AND_' . $extra_where . '_RECORD_COUNTRY_ID_'.intval($country_id).'__'))

		define('__GET_LISTING_DATA_OF_TYPE_'.$type.'_LIMIT_'.$limit . '_WHERE_'.$makes_and_models_where . '_AND_' . $extra_where . '_RECORD_COUNTRY_ID_'.intval($country_id).'__','total_listing_counts_of_type_' . $type . 'LIMIT'. $limit .'_where_' . $makes_and_models_where . '_and_' . $extra_where . '_record_country_id_' . intval($country_id));

		return '__GET_LISTING_DATA_OF_TYPE_'.$type.'_LIMIT_'.$limit . '_WHERE_'.$makes_and_models_where . '_AND_' . $extra_where . '_RECORD_COUNTRY_ID_'.intval($country_id).'__';
	}
}

if (!function_exists('get_total_listing_counts_cache_key')) {
	function get_total_listing_counts_cache_key($type,$makes_and_models_where = '',$country_id,$extra_where = '')
	{
		if (!defined('__GET_LISTING_COUNTS_OF_TYPE_'.$type.'_WHERE_'.$makes_and_models_where . '_AND_' . $extra_where . '_RECORD_COUNTRY_ID_'.$country_id.'__'))

		define('__GET_LISTING_COUNTS_OF_TYPE_'.$type.'_WHERE_'.$makes_and_models_where . '_AND_' . $extra_where . '_RECORD_COUNTRY_ID_'.$country_id.'__','total_listing_counts_of_type_' . $type . '_where_' . $makes_and_models_where . '_and_' . $extra_where . '_country_id_' . intval($country_id));

		return '__GET_LISTING_COUNTS_OF_TYPE_'.$type.'_WHERE_'.$makes_and_models_where . '_AND_' . $extra_where . '_RECORD_COUNTRY_ID_'.$country_id.'__';
	}
}

if (!function_exists('get_listing_data_by_slug_cache_key')) {
       function get_listing_data_by_slug_cache_key($slug)
       {
               if (!defined('__GET_LISTING_DATA_BY_SLUG_'.$slug.'__'))
               define('__GET_LISTING_DATA_BY_SLUG_'.$slug.'__', 'listing_data_by_slug_' . $slug);
               return '__GET_LISTING_DATA_BY_SLUG_'.$slug.'__';
       }
}

// if (!defined('__GET_SAVED__FAVOURITE_LISTING_IDS_BY_ID_AND_SEARCH_QUERY__'))
// define('__GET_SAVED__FAVOURITE_LISTING_IDS_BY_ID_AND_SEARCH_QUERY__', 'get_save_favourite_listing_ids__by_id'. $listing_id.'and_search_query'.$search_query);

// if (!defined('__GET_SAVED__FAVOURITE_LISTING_IDS_BY_ID__'))
// define('__GET_SAVED__FAVOURITE_LISTING_IDS_BY_ID__', 'get_save_favourite_listing_ids__by_id'. $listing_id);


