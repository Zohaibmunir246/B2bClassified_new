<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require (FCPATH . 'enviornments.php');


if (!function_exists('volgo_get_ci_object')) {
	function volgo_get_ci_object()
	{
		$ci =& get_instance();
		return $ci;
	}
}
if (!function_exists('get_slug')) {
	function get_slug($slug)

	{
		$ci = volgo_get_ci_object();
		$ci->load->database();
		$ci->db->select('l.id , l.seo_description, l.seo_keywords, u.firstname,u.lastname');
		$ci->db->from('listings as l');
		$ci->db->where('l.slug', $slug);
		$ci->db->join('b2b_users u', 'u.id=l.uid', 'left');
		$query = $ci->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		} else {
			return false;
		}

	}
}
if (!function_exists('get_slug_post')) {
	function get_slug_post($slug)
	{
		$ci = volgo_get_ci_object();
		$ci->load->database();
		$ci->db->select('p.id ,p.seo_title, p.seo_description, u.firstname,u.lastname');
		$ci->db->from('posts as p');
		$ci->db->where('p.slug', $slug);
		$ci->db->join('b2b_users u', 'u.id=p.user_id', 'left');
		$query1 = $ci->db->get();
		if ($query1->num_rows() > 0) {
			$result = $query1->row();
			return $result;
		} else {
			return false;
		}
	}
}

if (!function_exists('volgo_do_settings')) {
	function volgo_do_settings()
	{
		/*----------- Some Constants that are not saved in Settings table ---------------*/
		define('VOLGO_COOKIE_USER_COUNTRY_INFO', 'volgo_user_country_info');
		define('VOLGO_COOKIE_USER_COUNTRY_NAME', 'volgo_user_country_name');
		define('VOLGO_COOKIE_BEFORE_PURCHASING_PACKAGE_INFO', 'before_purchasing_package_info');
		define('FACEBOOK_APP_API', '1945352365610145');
		define('FACEBOOK_APP_SECRET', '5ad736a374decd290135fa4c75e32d3b');
		define('GRAPH_API_VERSION', '2.8');
		define('BACKEND_URL', __BACKEND_URL__);
		define('BACKEND_PATH', __BACKEND_PATH__);
		define('IMG_BASE_URL', __IMG_BASE_URL__);
		define('RECAPTCHA_SITE_KEY', '6LdChZoUAAAAALpWvMcqELDBBvUBk6AL9nSM6atG');
		define('RECAPTCHA_SECRET_KEY', '6LdChZoUAAAAAAY5StMHKZkKfjFsx3qzmjcEo2Ry');
		define('VOLGO_CACHE_ENABLED', 'true');
		define('MAX_CACHE_TTL_VALUE', __MAX_CACHE_TIME__); // save for 72 hours
		define('IS_CACHE_ON', TRUE);
		define('ADMIN_EMAIL', __ADMIN_EMAIL__);
		define('G_REDIRECT_URI', 'https://www.volgoplus.com/users/google_login');
		define('G_CLIENT_ID', '1066237958031-otlpnc06t6run41oas6vm25n50fvdops.apps.googleusercontent.com');
		define('G_CLIENT_SECRET', 'Fq2MZm4dopcjkq5cm4iIa6fB');

		/* pakages */
		define('GOLD_PACKAGE_MAX',10);
		define('SILVER_PACKAGE_MAX',20);
		define('BRONZE_PACKAGE_MAX',30);
		
		
		$ci = volgo_get_ci_object();
		$ci->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		
		$cache_key = 'default_settings';

		// @todo: Trurn on cache again by doing 	if ( $settings = $ci->cache->get($cache_key)){

		// Get from Database
		$ci->load->database();

		$ci->db->select('*');
		$ci->db->from('settings');
		$ci->db->where('type', 'default');

		$block = $ci->db->get();
		$settings = $block->result();

		//$ci->cache->save($cache_key, $settings, MAX_CACHE_TTL_VALUE);
		

		foreach ($settings as $setting) {
			if ($setting->key === 'site_name')
				define('SITE_NAME', $setting->value);

			if ($setting->key === 'site_url')
				define('FRONT_END_SITE_URL', $setting->value);

			if ($setting->key === 'frontend_uploads_url')
				define('FRONT_END_UPLOADS_URL', $setting->value);

			if ($setting->key === 'currency_unit')
				define('B2B_CURRENCY_UNIT', $setting->value);

			if ($setting->key === 'header_logo')
				define('HEADER_LOGO', $setting->value);

			if ($setting->key === 'fav_icon')
				define('FAV_ICON', $setting->value);

			if ($setting->key === 'newsletter_from_email')
				define('NEWSLETTER_FROM_EMAIL', $setting->value);

			if ($setting->key === 'phpmailer_sender_host')
				define('PHPMAILER_SENDER_HOST', $setting->value);

			if ($setting->key === 'phpmailer_sender_smtpauth')
				define('PHPMAILER_SENDER_SMTPAUTH', $setting->value);

			if ($setting->key === 'phpmailer_sender_username')
				define('PHPMAILER_SENDER_USERNAME', $setting->value);

			if ($setting->key === 'phpmailer_sender_pass')
				define('PHPMAILER_SENDER_PASSWORD', $setting->value);

			if ($setting->key === 'phpmailer_sender_smtp_secure')
				define('PHPMAILER_SENDER_SMTP_SECURE', $setting->value);

			if ($setting->key === 'phpmailer_sender_port')
				define('PHPMAILER_SENDER_PORT', $setting->value);

			if ($setting->key === 'tiny_mce_api_key')
				define('TINY_MCE_API_KEY', $setting->value);

			if ($setting->key === 'geo_ip_location_api_key')
				define('GEO_IP_LOCATION_API_KEY', $setting->value);

			if ($setting->key === 'geo_ip_location_api_url')
				define('GEO_IP_LOCATION_API_URL', $setting->value);

			if ($setting->key === 'paypal_client_id')
				define('PAYPAL_CLIENT_ID', $setting->value);

			if ($setting->key === 'paypal_secret_id')
				define('PAYPAL_SECRET_ID', $setting->value);

			if ($setting->key === 'available_payment_methods')
				define('AVAILABLE_PAYMENT_METHODS', $setting->value);

			if ($setting->key === 'exchange_rate_api_key')
				define('EXCHANGE_RATE_API_ACCESS_KEY', $setting->value);

			if ($setting->key === 'exchange_rate_url')
				define('EXCHANGE_RATE_URL', $setting->value);

			if ($setting->key === 'uploads_url')
				define('UPLOADS_URL', $setting->value);

			if ($setting->key === 'facebook')
				define('B2B_FACEBOOK', $setting->value);

			if ($setting->key === 'twitter')
				define('B2B_TWITTER', $setting->value);

			if ($setting->key === 'google_plus')
				define('B2B_GOOGLE_PLUS', $setting->value);

			if ($setting->key === 'instagram')
				define('B2B_INSTAGRAM', $setting->value);

            if ($setting->key === 'linkedin')
                define('B2B_LINKEDIN', $setting->value);

			if ($setting->key === 'pinterest')
				define('B2B_PINTEREST', $setting->value);

			if ($setting->key === 'youtube')
				define('B2B_YOUTUBE', $setting->value);

			if ($setting->key === 'tumblr')
				define('B2B_TUMBLR', $setting->value);

			if ($setting->key === 'new_user_verify_email_link')
				define('EMAIL_NEW_USER_VERIFY_EMAIL', $setting->value);

			if ($setting->key === 'new_user_welcome_email')
				define('EMAIL_NEW_USER_WELCOME_EMAIL', $setting->value);

			if ($setting->key === 'password_reset_email')
				define('EMAIL_PASSWORD_RESET_EMAIL', $setting->value);

			if ($setting->key === 'password_reset_email_success')
				define('EMAIL_PASSWORD_RESET_SUCCESS_EMAIL', $setting->value);

			if ($setting->key === 'delete_account_request_email')
				define('EMAIL_DELETE_ACCOUNT_REQUEST_EMAIL', $setting->value);

			if ($setting->key === 'delete_account_request_success_email')
				define('EMAIL_DELETE_ACCOUNT_SUCCESS_EMAIL', $setting->value);

			if ($setting->key === 'delete_account_request_success_email_for_admin')
				define('EMAIL_DELETE_ACCOUNT_SUCCESS_EMAIL_FOR_ADMIN', $setting->value);

			if ($setting->key === 'listing_added_email')
				define('LISTING_ADDED_EMAIL', $setting->value);


			if ($setting->key === 'profile_updated_email')
				define('EMAIL_PROFILE_UPDATED', $setting->value);

			if ($setting->key === 'order_place_email')
				define('EMAIL_ORDER_PLACED', $setting->value);

			if ($setting->key === 'order_place_email_admin')
				define('EMAIL_ORDER_PLACED_FOR_ADMIN', $setting->value);

			if ($setting->key === 'order_cancel_email_user')
				define('EMAIL_ORDER_CANCEL_EMAIL_FOR_USER', $setting->value);

			if ($setting->key === 'order_cancel_email_admin')
				define('EMAIL_ORDER_CANCEL_EMAIL_ADMIN', $setting->value);

			if ($setting->key === 'order_charged_email_user')
				define('EMAIL_ORDER_CHARGED_FOR_USER', $setting->value);

			if ($setting->key === 'order_charged_email_admin')
				define('EMAIL_ORDER_CHARGED_FOR_ADMIN', $setting->value);

			if ($setting->key === 'invoice_paid_email_user')
				define('INVOICE_PAID_EMAIL_USER', $setting->value);

			if ($setting->key === 'invoice_paid_email_admin')
				define('EMAIL_INVOICE_PAID_FOR_ADMIN', $setting->value);

			if ($setting->key === 'invoice_due_email_user')
				define('EMAIL_INVOICE_DUE_FOR_USER', $setting->value);

			if ($setting->key === 'invoice_due_email_admin')
				define('EMAIL_INVOICE_DUE_FOR_ADMIN', $setting->value);

			if ($setting->key === 'flag_report_email_admin')
				define('EMAIL_FLAG_REPORT_FOR_ADMIN', $setting->value);

			if ($setting->key === 'flag_report_email_user_listing_flagged')
				define('EMAIL_FLAG_REPORT_FOR_USER_WHOM_LISTING', $setting->value);

			if ($setting->key === 'flag_report_email_user_report_listing')
				define('EMAIL_FLAG_REPORT_FOR_USER_WHO_REPORTED', $setting->value);

			if ($setting->key === 'new_contact_form_admin')
				define('EMAIL_NEW_CONTACT_FORM', $setting->value);

			if ($setting->key === 'subscription_end_reminder_email')
				define('EMAIL_SUBSCRIPTION_END_REMINDER_EMAIL_FOR_USER', $setting->value);

			if ($setting->key === 'subscription_end_reminder_days')
				define('EMAIL_SUBSCRIPTION_END_REMINDER_BEFORE_SOME_DAYS', $setting->value);

			if ($setting->key === 'listing_approved_email_user')
				define('EMAIL_LISTING_APPROVED_FOR_USER', $setting->value);

			if ($setting->key === 'email_for_new_follower')
				define('EMAIL_FOR_NEW_FOLLOWER', $setting->value);

			if ($setting->key === 'email_for_new_post_to_follower')
				define('EMAIL_FOR_NEW_POST_TO_FOLLOWER', $setting->value);
				
			if ($setting->key === 'related_post_img_w')
				define('RELATED_POST_IMG_w', $setting->value);

			if ($setting->key === 'related_post_img_h')
				define('RELATED_POST_IMG_H', $setting->value);

            if ($setting->key === 'detail_slider_thumbnail_h')
                define('DETAIL_SLIDER_THUMBNAIL_H', $setting->value);

            if ($setting->key === 'detail_slider_thumbnail_w')
                define('DETAIL_SLIDER_THUMBNAIL_W', $setting->value);

            if ($setting->key === 'detail_slider_img_h')
                define('DETAIL_SLIDER_IMG_H', $setting->value);

            if ($setting->key === 'detail_slider_img_w')
                define('DETAIL_SLIDER_IMG_W', $setting->value);

            if ($setting->key === 'prop_lis_recommended_img_h')
                define('PROP_LIS_RECOMMENDED_IMG_H', $setting->value);

            if ($setting->key === 'prop_lis_recommended_img_w')
                define('PROP_LIS_RECOMMENDED_IMG_W', $setting->value);

            if ($setting->key === 'prop_lis_featured_img_h')
                define('PROP_LIS_FEATURED_IMG_H', $setting->value);

            if ($setting->key === 'prop_lis_featured_img_w')
                define('PROP_LIS_FEATURED_IMG_W', $setting->value);

            if ($setting->key === 'lis_recommended_img_h')
                define('LIS_RECOMMENDED_IMG_H', $setting->value);

            if ($setting->key === 'lis_recommended_img_w')
                define('LIS_RECOMMENDED_IMG_W', $setting->value);

            if ($setting->key === 'lis_featured_img_h')
                define('LIS_FEATURED_IMG_H', $setting->value);

            if ($setting->key === 'lis_featured_img_w')
                define('LIS_FEATURED_IMG_W', $setting->value);

            if ($setting->key === 'trade_detail_img_h')
                define('TRADE_DETAIL_IMG_H', $setting->value);

            if ($setting->key === 'trade_detail_img_w')
                define('TRADE_DETAIL_IMG_W', $setting->value);

            if ($setting->key === 'home_trade_img_h')
                define('HOME_TRADE_IMG_H', $setting->value);

            if ($setting->key === 'home_trade_img_w')
                define('HOME_TRADE_IMG_W', $setting->value);
                
            if ($setting->key === 'send_reply_email_to_user')
		        define('SEND_REPLY_EMAIL_TO_USER', $setting->value);

		    if ($setting->key === 'send_reply_email_to_sender')
		        define('SEND_REPLY_EMAIL_TO_SENDER', $setting->value);

		    if ($setting->key === 'contact_email_buyer')
		        define('CONTACT_EMAIL_BUYER', $setting->value);

		    if ($setting->key === 'contact_email_seller')
		        define('CONTACT_EMAIL_SELLER', $setting->value);
		}
		if (defined('EXCHANGE_RATE_URL') && defined('EXCHANGE_RATE_API_ACCESS_KEY'))
			define('EXCHANGE_RATE_URL_WITH_KEY', EXCHANGE_RATE_URL . EXCHANGE_RATE_API_ACCESS_KEY);
	}

	volgo_do_settings();
}

if (!function_exists('volgo_get_random_string')) {
	function volgo_get_random_string($length)
	{

		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$input_length = strlen($permitted_chars);
		$random_string = '';
		for ($i = 0; $i < $length; $i++) {
			$random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}

		return $random_string;

	}
}

if (!function_exists('volgo_get_selected_parent_cat_id')) {
    function volgo_get_selected_parent_cat_id($find_deep_parent = false)
    {
        $ci = volgo_get_ci_object();
        //$is_cat_page = strtolower($ci->uri->segment(1)) === 'category' ? true : false;
        $jsonManipulation = (new \application\classes\JsonManipulation());
		$is_cat_page = $jsonManipulation->check_parent_cat_from_cat_slug(strtolower($ci->uri->segment(1)));

        if ($is_cat_page) {
            $cat_slug = strtolower($ci->uri->segment(2));

            $ci->db->select('id, parent_ids');
            $ci->db->from('categories');
            $ci->db->where('slug', $cat_slug);
            $result = $ci->db->get()->row();

            if (!empty($result) && is_object($result)) {
                if ($result->parent_ids === 'uncategorised')
                    $cat_id = $result->id;
                else {
                    $cat_id = $result->parent_ids;
                }
            }else {
                $cat_id = 0;
            }
        } else {
        	// This is not category page.

            $slug = $ci->uri->segment(1);

            unset($result);
            if (strtolower($slug) === 'seller-lead' || strtolower($slug) === 'buying-lead'){
            	// For seller-lead or for buying lead pages

				$slug2 = $ci->uri->segment(2);

				$cat_slug = '';
				if ($slug === 'seller-lead'){
					$cat_slug = 'seller_lead';
				}else if ($slug === 'buying-lead'){
					$cat_slug = 'buying_lead';
				}

				$result = $ci->db->select('*')->from('categories')->where('slug', $slug2)->where('category_type', $cat_slug)->get()->row();

				$ci->db->select('id, parent_ids, category_type');
				$ci->db->from('categories');
				$ci->db->where('id', $result->parent_ids);
				$result = $ci->db->get()->row();

				if(!empty($result) && $find_deep_parent && ($result->category_type === 'buying_lead' || $result->category_type === 'seller_lead')){
					// for buying lead or Seller Lead

					$ci->db->select('id, parent_ids, category_type');
					$ci->db->from('categories');
					$ci->db->where('id', $result->parent_ids);
					$result = $ci->db->get()->row();

				}


			}else {
            	// For all other pages
				$row = $ci->db->select('category_id,sub_category_id')->from('listings')->where('slug', $slug)->get()->row();

				if(!empty($row->sub_category_id)){
					$ci->db->select('id, parent_ids, category_type');
					$ci->db->from('categories');
					$ci->db->where('id', $row->sub_category_id);
					$result = $ci->db->get()->row();


					if(!empty($result) && $find_deep_parent && ($result->category_type === 'buying_lead' || $result->category_type === 'seller_lead')){
						// for buying lead or Seller Lead

						$ci->db->select('id, parent_ids, category_type');
						$ci->db->from('categories');
						$ci->db->where('id', $result->parent_ids);
						$result = $ci->db->get()->row();

					}


				}else{
					$result = false;
				}
			}


            if (!empty($result) && is_object($result)) {
                if ($result->parent_ids === 'uncategorised')
                    $cat_id = $result->id;
                else {
                    $cat_id = $result->parent_ids;
                }
            }else {
                $cat_id = 0;
            }
        }

        return $cat_id;
    }
}

if (!function_exists('volgo_get_current_category_id')) {
	function volgo_get_current_category_id()
	{
		$ci = volgo_get_ci_object();

		// $is_cat_page = isset(strtolower($ci->uri->segment(1))) ? true : false;
		$jsonManipulation = (new \application\classes\JsonManipulation());
		$is_cat_page = $jsonManipulation->check_parent_cat_from_cat_slug(strtolower($ci->uri->segment(1)));
		
		if ($is_cat_page) {
			if(!$ci->uri->segment(2)){
			$cat_slug = strtolower($ci->uri->segment(1));
			$cat_id = volgo_get_cat_id_by_slug($cat_slug);
			}elseif($ci->uri->segment(2)){
			if(is_numeric($ci->uri->segment(2))){
				$cat_slug = strtolower($ci->uri->segment(1));
				$cat_id = volgo_get_cat_id_by_slug($cat_slug);
			}else{
				$cat_slug = strtolower($ci->uri->segment(2));
				$cat_id = volgo_get_cat_id_by_slug($cat_slug);
			}
			}
		} else {
			$cat_id = !empty($ci->input->get('parent_cat_select')) ? $ci->input->get('parent_cat_select') : 0;
		}

		return $cat_id;
	}
}

if (!function_exists('volgo_get_current_sub_category_id')) {
	function volgo_get_current_sub_category_id()
	{
		$ci = volgo_get_ci_object();

        //$is_cat_page = strtolower($ci->uri->segment(1)) === 'category' ? true : false;
        $jsonManipulation = (new \application\classes\JsonManipulation());
		$is_cat_page = $jsonManipulation->check_parent_cat_from_cat_slug(strtolower($ci->uri->segment(1)));
        if ($is_cat_page){
            // check if this is category page.

            $sub_cat_id = !empty($ci->input->get('child_cats')) ? $ci->input->get('child_cats') : 0;
        }else if (strtolower($ci->uri->segment(1)) === 'listingsearch'){
            // this is search page

            $sub_cat_id = $ci->input->get('child_cats');

        }else if (strtolower($ci->uri->segment(1)) === 'buying-lead' || strtolower($ci->uri->segment(1)) === 'seller-lead'){
        	// this is buying-lead or seller-lead

			$current_lead_slug = $ci->uri->segment(2);
			if (! empty($current_lead_slug)){

				$cat_slug = '';
				if (strtolower($ci->uri->segment(1)) === 'seller-lead'){
					$cat_slug = 'seller_lead';
				}else if (strtolower($ci->uri->segment(1)) === 'buying-lead'){
					$cat_slug = 'buying_lead';
				}

				$row = $ci->db->select('id')->from('categories')->where('slug', $current_lead_slug)->where('category_type', $cat_slug)->get()->row();

				if (!empty($row)) return $row->id;
			}
		}else {
            // this is detail page.

            $slug = $ci->uri->segment(1);
            $row = $ci->db->select('sub_category_id')->from('listings')->where('slug', $slug)->get()->row();

            $sub_cat_id = $row->sub_category_id;
        }

		return $sub_cat_id;
	}
}

if (!function_exists('volgo_get_sidebar_search_form')) {
	function volgo_get_sidebar_search_form($sub_cat_id)
	{
		$ci = volgo_get_ci_object();

		$ci->load->model('Listingfilterquery_Model');

		$form = $ci->Listingfilterquery_Model->get_formdb_by_id($sub_cat_id);
		return $form;

	}
}

if (!function_exists('volgo_get_advance_sidebar_search_form')) {
	function volgo_get_advance_sidebar_search_form($sub_cat_id)
	{
		$ci = volgo_get_ci_object();

		$ci->load->model('Listingfilterquery_Model');

		$form = $ci->Listingfilterquery_Model->get_form_db_retrival_advance($sub_cat_id);


		return $form;

	}
}

if (! function_exists('volgo_get_count')){
	function volgo_get_count($all_counts, $sub_cat_ids, $type){
		$count = 0;

		$allowed_type = [
			'featured',
			'recommended'
		];

		if (! in_array($type, $allowed_type)){
			return $count;
		}

		if (! empty($sub_cat_ids)){
			foreach ($sub_cat_ids as $sub_cat_id){
				$key = 'cat_id_' . $sub_cat_id . '_total_count_' . $type;

				if (isset($all_counts[$key])){
					$count += $all_counts[$key];
				}
			}
		}else {
			$key = 'cat_id_' . volgo_get_current_category_id() . '_total_count_' . $type;
			if (in_array($key, $all_counts)){
				$count = $all_counts[$key];
			}
		}

		return number_format($count);
	}
}

if (!function_exists('volgo_get_sub_categories_by_parent_cat_id')) {
	function volgo_get_sub_categories_by_parent_cat_id($id = 0, $columns = 'id,name,slug')
	{
		if (intval($id) === 0) {
			$id = volgo_get_current_category_id();
		}

		$ci = volgo_get_ci_object();

		$sub_cats = $ci->db->select($columns)
			->from('categories')
			->where('parent_ids', intval($id))
			->order_by('name', 'asc')
			->get()->result();

		$slug = $ci->uri->segment(1);
		if (strtolower($slug) === 'seller-lead' || strtolower($slug) === 'buying-lead') {
			$cats = [];

			foreach ($sub_cats as $cat){
				$cats[] = $ci->db->select($columns)
					->from('categories')
					->where('parent_ids', intval($cat->id))
					->order_by('name', 'asc')
					->get()->result();
			}

			$sub_cats = $cats;

		}
		return $sub_cats;
	}
}

if (!function_exists('volgo_get_ip_address')) {
	function volgo_get_ip_address()
	{
		if (isset($_SERVER['HTTP_ALI_CDN_REAL_IP'])){
			$ip = $_SERVER['HTTP_ALI_CDN_REAL_IP'];
		}else if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
}

if (!function_exists('volgo_db_country_id_by_country_name')) {
	function volgo_db_country_id_by_country_name($country_name)
	{
		$ci = volgo_get_ci_object();
		$ci->load->database();
		
		//$ci->db->cache_on();
		$ci->db->select('id');
		$ci->db->from('b2b_countries');
		$ci->db->where('name', ucwords($country_name));
		$ci->db->limit(1);
		$country = $ci->db->get();
		//$ci->db->cache_off();

		return ($country->row()->id);
	}
}

if (!function_exists('volgo_db_country_id_by_country_name_code')) {
    function volgo_db_country_id_by_country_name_code($country_name,$country_code)
    {
        $ci = volgo_get_ci_object();
        $ci->load->database();

        //$ci->db->cache_on();
        $ci->db->select('id');
        $ci->db->from('b2b_countries');
        $ci->db->where('name', ucwords($country_name));
        $ci->db->or_where('shortname', $country_code);
        $ci->db->limit(1);
        $country = $ci->db->get();
        //$ci->db->cache_off();

        return ($country->row()->id);
    }
}

if (!function_exists('volgo_create_cookie')) {
	function volgo_create_cookie($cookie_name, $value, $expires = '172800', $domain = '', $prefix = '', $secure = null, $httponly = NULL)
	{
		$ci = volgo_get_ci_object();
		$ci->load->helper('cookie');


		$ci->session->set_userdata($cookie_name, $value);
		if($cookie_name != "volgo_user_country_info"){
		$ci->input->set_cookie($cookie_name, $value, $expires, $domain, $prefix, $secure, $httponly);
		}    
		return true;
	}
}

if (!function_exists('volgo_get_country_info_from_session')) {
	function volgo_get_country_info_from_session()
	{
		$ci = volgo_get_ci_object();

		$country_info = $ci->session->userdata(VOLGO_COOKIE_USER_COUNTRY_INFO);

		return (unserialize($country_info));
	}
}

if (!function_exists('volgo_update_user_location_by_force')) {
	function volgo_update_user_location_by_force($country_id)
	{
		$ci = volgo_get_ci_object();

		$country_info = volgo_get_country_info_from_session();

		$country_db_info = $ci->db->select('shortname,name')->from('b2b_countries')->where('id', intval($country_id))->get()->row();

		$info_arr = [
			'ip' => $country_info['ip'],
			'type' => 'ipv4',
			'country_code' => $country_db_info->shortname,
			'country_name' => $country_db_info->name,
			'country_id' => $country_id,
			'region_code' => '',
			'region_name' => '',
			'city' => '',
			'zip' => '',
			'by_force' => true
		];

		volgo_create_cookie(VOLGO_COOKIE_USER_COUNTRY_INFO, serialize($info_arr));
	}
}

if (!function_exists('volgo_get_user_country_id')) {
	function volgo_get_user_country_id()
	{
		$location = volgo_get_user_location();

		return isset($location['country_id']) ? $location['country_id'] : '';
	}
}


    function grabIpInfo($ip)
    {


        $curl = curl_init();



        curl_setopt($curl, CURLOPT_URL, "https://pro.ip-api.com/php/" . $ip.'?key=9PZWzYVCvaFAsvF');



        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);



        $returnData = curl_exec($curl);


        curl_close($curl);


        return $returnData;





    }


if (!function_exists('volgo_get_user_location')) {
    function volgo_get_user_location()
    {
    // set IP address and API access key
    // Test IP 1: 175.107.237.78 - Pakistan
    // Test IP 2: 161.185.160.93 - USA
    // if($_SERVER['HTTP_HOST']=='volgopoint.com'){
    //     echo "<script> window.location='https://www.".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."';</script>";
    // }
    $ci = volgo_get_ci_object();
    
    $ip = volgo_get_ip_address();


    $country_info = $ci->session->userdata(VOLGO_COOKIE_USER_COUNTRY_INFO);
    $country_info = unserialize($country_info);

	if ($country_info['ip'] !== NULL && is_array($country_info)){
        if($country_info['ip'] === $ip){
            if ($country_info !== NULL && is_array($country_info)){

                return $country_info;
            }
        } else {
            
    		$ci->load->helper('cookie');
    		$ci->session->unset_userdata(VOLGO_COOKIE_USER_COUNTRY_INFO);
    		$deleted_cookie_name = VOLGO_COOKIE_USER_COUNTRY_INFO;
    		delete_cookie($deleted_cookie_name);
    		unset($deleted_cookie_name);   
        }
	}

    if ($ip === '127.0.0.1' || $ip === '::1') {
    
        $info_arr = [
        'ip' => '127.0.0.1',
        'type' => 'ipv4',
        'country_code' => 'localhost',
        'country_name' => 'localhost',
        'country_id' => '166', // set Pakistan Country by default
        'region_code' => 'localhost',
        'region_name' => 'localhost',
        'city' => 'localhost',
        'zip' => 'localhost',
        'by_force' => false
        ];

        volgo_create_cookie(VOLGO_COOKIE_USER_COUNTRY_INFO, serialize($info_arr));
        return $info_arr;
    }

    // Output the "calling_code" object inside "location"
    //$api_result = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=" . $ip));
        //echo "https://api.snoopi.io/125.158.142";
    $api_result = json_decode(file_get_contents("https://pro.ip-api.com/json/" . $ip."?key=9PZWzYVCvaFAsvF"),true);
    //$api_result = json_decode(grabIpInfo($ip),true);



    if(is_array($api_result) && isset($api_result['status']) && $api_result['status'] == 'success'){
        $country_name = $api_result['country'];
        $country_code = $api_result['countryCode'];
    }else{
        $country_name = 'Pakistan';
        $country_code = 'PK';
    }



        $country_id = volgo_db_country_id_by_country_name_code(ucwords($country_name),$country_code);

        $info_arr = [
            'ip' => $ip,
            'type' => 'ipv4',
            'country_code' => $api_result['countryCode'],
            'country_name' => $country_name,
            'country_id' => $country_id,
            'region_code' => $api_result['region'],
            'region_name' => $api_result['regionName'],
            'city' => $api_result['city'],
            'zip' => $api_result['zip'],
            'by_force' => false
        ];

    /*if ($api_result['geoplugin_countryName'] === null || empty($api_result['geoplugin_countryName']))
    $country_name = 'Pakistan'; // Fall Back Name
    else
    $country_name = $api_result['geoplugin_countryName'];
    
    $country_id = volgo_db_country_id_by_country_name(ucwords($country_name));
    
    $info_arr = [
    'ip' => $api_result['geoplugin_request'],
    'type' => 'ipv4',
    'country_code' => $api_result['geoplugin_countryCode'],
    'country_name' => $country_name,
    'country_id' => $country_id,
    'region_code' => $api_result['geoplugin_regionCode'],
    'region_name' => $api_result['geoplugin_regionName'],
    'city' => $api_result['geoplugin_city'],
    'zip' => '',
    'by_force' => false
    ];*/
    
    

    volgo_create_cookie(VOLGO_COOKIE_USER_COUNTRY_INFO, serialize($info_arr));
    return $info_arr;

    }
}

if (!function_exists('volgo_get_countries')) {
	function volgo_get_countries()
	{
		$ci = volgo_get_ci_object();
		$ci->load->database();
		
		//$ci->db->cache_on();
		$ci->db->select('name,id,shortname');
		$ci->db->from('b2b_countries');
		$countries = $ci->db->get();
		$countries = $countries->result();
		//$ci->db->cache_off();
		
		return $countries;
	}
}

if (!function_exists('volgo_get_all_categories')) {
	function volgo_get_all_categories()
	{
		$ci = volgo_get_ci_object();
		//$ci->db->cache_on();
		$ci->db->select('a.id, a.description,a.name, b.name as parent_name , a.image_icon, a.parent_ids');
		$ci->db->from('categories a');

		$ci->db->order_by('id');
		$ci->db->join('categories b', 'a.parent_ids = b.id', 'left');

		$query = $ci->db->get();

		return ($query->result());
	}
}


if (!function_exists('volgo_front_is_logged_in')) {
	function volgo_front_is_logged_in()
	{

		if (!isset($_SESSION['volgo_user_login_data']))
			return false;

		$session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
		$session_data = explode(',', $session_data);

		if (($session_data[sizeof($session_data) - 1] + 86400) > time()) {
			return true;
		}

		return false;
	}
}

if (!function_exists('volgo_encrypt_message')) {
	function volgo_encrypt_message($message)
	{
		$secret_key = '$<)j[rTO:1W6({)[rGqHN+P2DVU~d0';
		$secret_iv = 'HGe"L+SCR?B6PcUATn#OEV9J,`-!c';
		$encrypt_method = 'aes-256-ctr';

		if (is_array($message))
			$message = implode(',', $message);

		// hash
		$key = hash('sha256', $secret_key);

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		$output = openssl_encrypt($message, $encrypt_method, $key, 0, $iv);
		return base64_encode($output);
	}
}


if (!function_exists('volgo_decrypt_message')) {
	function volgo_decrypt_message($enc_message)
	{
		$secret_key = '$<)j[rTO:1W6({)[rGqHN+P2DVU~d0';
		$secret_iv = 'HGe"L+SCR?B6PcUATn#OEV9J,`-!c';
		$encrypt_method = 'aes-256-ctr';

		//var_export(openssl_get_cipher_methods());
		//exit;

		// hash
		$key = hash('sha256', $secret_key);

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		return openssl_decrypt(base64_decode($enc_message), $encrypt_method, $key, 0, $iv);
	}
}

if (!function_exists('volgo_get_all_routes')) {
	function volgo_get_all_routes($return = true, $exit = false, $echo = false)
	{

		// @todo: restructure the functions helper and complete this function.
		//$ci->router->routes
	}
}

if (!function_exists('volgo_debug')) {
	function volgo_debug($value, $echo = true, $exit = true)
	{
		$value = '<pre>' . var_export($value, true) . '</pre>';

		if ($echo)
			echo $value;
		else
			return $value;

		if ($exit)
			exit('Exiting from volgo_debug method at line ' . __LINE__);

		return '';
	}
}

if (!function_exists('volgo_do_currency_exchange')) {
	function volgo_do_currency_exchange($amount, $from_currency = B2B_CURRENCY_UNIT, $to_currency = 'usd')
	{

		$response_json = file_get_contents((EXCHANGE_RATE_URL_WITH_KEY . '/' . $from_currency));

		// Continuing if we got a result
		if (false !== $response_json) {
			// Try/catch for json_decode operation
			try {
				// Decoding
				$response_object = json_decode($response_json);

				// Checking for errors
				if ('success' === $response_object->result) {
					$base_price = floatval($amount);

					$rates = $response_object->rates;
					$to_currency_rate = 0;
					foreach ($rates as $key => $rate) {

						if (strtolower($key) === strtolower($to_currency)) {
							$to_currency_rate = $rate;
							break;
						}

					}

					if ($to_currency_rate === 1) {
						return false;
					}


					$converted_price = round(($base_price * $to_currency_rate), 2);

					return [
						'base_price' => $amount,
						'converted_price' => $converted_price,
						'base_currency_unit' => $from_currency,
						'to_currency_unit' => $to_currency,
						'currency_rate' => $to_currency_rate
					];

				} else {
					// Handling different error conditions
					switch ($response_object->error) {
						case 'unknown-code':
							log_message('error', 'Exchange Rate Unknown Code.');
							break;
						case 'invalid-key':
							log_message('error', 'Exchange Rate Invalid Key.');
							break;
						case 'malformed-request':
							log_message('error', 'Exchange Rate Malformed Request.');
							break;
						case 'quota-reached':
							log_message('error', 'Exchange Rate Quota Reached.');
							break;
					}

					return false;
				}
			} catch (Exception $e) {
				log_message('error', $e->getMessage());
				return false;
			}

		} else {
			return false;
		}


	}
}



if (!function_exists('volgo_get_buying_lead_parent_cats')) {

	function volgo_get_buying_lead_parent_cats($order_by_column = '', $direction = "")
	{
		$ci = volgo_get_ci_object();

		$direction = empty($direction) ? 'asc' : $direction;
		if (!empty($order_by_column))
			$order_by = ' order by ' . $order_by_column . ' ' . $direction;
		else
			$order_by = '';

		$query = "select c.id as cat_id, c.parent_ids, c.name as cat_name, c.image_icon, c.slug
 				from categories c where c.parent_ids = 
				(	
					select id from categories c2 where c2.slug = 'buying-lead' limit 1
				) 
				{$order_by}";

		$result = $ci->db->query($query);
		return ($result->result());
	}
}

if (!function_exists('volgo_get_buying_leads')) {

	function volgo_get_buying_leads()
	{
		$ci = volgo_get_ci_object();

		$buying_leads_parents = volgo_get_buying_lead_parent_cats('name');


		$buying_leads = [];
		foreach ($buying_leads_parents as $buying_leads_parent) {
			$ci->db->select('c.id as cat_id, c.parent_ids, c.name as cat_name, c.image_icon, c.slug');
			$ci->db->from('categories as c');
			$ci->db->where('parent_ids', $buying_leads_parent->cat_id);
			$ci->db->order_by('name', 'asc');
			$child_buying_lead = $ci->db->get()->result();

			$buying_leads[] = [
				'child_data' => $child_buying_lead
			];
		}

		return $buying_leads;

	}
}

if (!function_exists('volgo_get_seller_lead_parent_cats')) {
	function volgo_get_seller_lead_parent_cats($order_by_column = '', $direction = "")
	{
		$ci = volgo_get_ci_object();

		$direction = empty($direction) ? 'asc' : $direction;
		if (!empty($order_by_column))
			$order_by = ' order by ' . $order_by_column . ' ' . $direction;
		else
			$order_by = '';

		$query = "select c.id as cat_id, c.parent_ids, c.name as cat_name, c.image_icon, c.slug
 				from categories c where c.parent_ids = 
				(	
					select id from categories c2 where c2.slug = 'seller-lead' limit 1
				) {$order_by}";

		$result = $ci->db->query($query);
		return ($result->result());
	}
}

if (!function_exists('volgo_get_selling_leads')) {
	function volgo_get_selling_leads()
	{
		$ci = volgo_get_ci_object();

		$selling_leads_parents = volgo_get_seller_lead_parent_cats('name');

		$selling_leads = [];
		foreach ($selling_leads_parents as $selling_leads_parent) {
			$ci->db->select('c.id as cat_id, c.parent_ids, c.name as cat_name, c.image_icon, c.slug');
			$ci->db->from('categories as c');
			$ci->db->where('parent_ids', $selling_leads_parent->cat_id);
			$ci->db->order_by('name', 'asc');
			$child_selling_lead = $ci->db->get()->result();

			$selling_leads[] = [
				'child_data' => $child_selling_lead
			];
		}

		return $selling_leads;
	}
}

if (!function_exists('volgo_get_listings_count')) {
	function volgo_get_listings_count($id = 0)
	{
		$ci = volgo_get_ci_object();

		//$ci->db->cache_on();

		$data = $ci->db->select('count(id) as total_rows')->from('listings l')->where('l.sub_category_id', intval($id))->where('l.status', 'enabled')->where('l.country_id', intval(volgo_get_user_country_id()))->get()->row();

		//$ci->db->cache_off();

		//echo $ci->db->last_query();

		return ($data->total_rows);
	}
}


if (!function_exists('volgo_get_header_cats')) {

	function volgo_get_header_cats()
	{

		$ci = volgo_get_ci_object();
		$ci->load->database();

		$ci->db->select('c1.id as cat_id, c1.parent_ids, c1.name as cat_name, c1.image_icon, c1.slug');
		$ci->db->from('categories as c1');
		$ci->db->where('c1.parent_ids', 'uncategorised');
		$ci->db->where('c1.category_type', 'category');
		$ci->db->order_by('cat_id', 'asc');


		$query = $ci->db->get();
		$parent_cats = $query->result();
		
		

		$header_cats = [];
		foreach ($parent_cats as $cat) {
			$ci->db->select('c1.id as cat_id, c1.parent_ids, c1.name as cat_name,  c1.image_icon, c1.slug');
			$ci->db->from('categories as c1');
			$ci->db->where('c1.parent_ids', $cat->cat_id);
			$query = $ci->db->get();

			$header_cats[] = [
				'parent' => $cat,
				'childs' => $query->result()
			];
		}

		//	print_r($header_cats);

		unset($query);
		unset($cat);
		unset($parent_cats);

		foreach ($header_cats as $header_cat) {
			$country_id = volgo_get_country_id_from_session();

			foreach ($header_cat['childs'] as $child_arr) {


				/*
				 * @can
				 * 	country_id_166_cat_id_6__total_count
				 * */
				$db_key = $cache_key = 'country_id_'.$country_id.'_cat_id_'.intval($child_arr->cat_id).'__total_count';
				
				// try to get from cache and if cache is not created then first we will look into categories meta table.
				//if (! $count = $ci->cache->get($cache_key)){
					// Query
					$count_meta = $ci->db->select('meta_value')
						->from('categories_meta')
						->where('categories_id', intval($child_arr->cat_id))
						->where('meta_key', $db_key)
						->limit(1)
						->get()->row();
					
					if (empty($count_meta)){
						// try to count the records, save into database (categories meta) and create cache after this if block -- Just here for backward compatibility
						
						//1) Count Records
						$ci->db->select('count(l.id) as count');
						$ci->db->from('listings l');
						$ci->db->where('l.sub_category_id', intval($child_arr->cat_id));
						$ci->db->where('country_id', $country_id);
						$ci->db->where('status', 'enabled');
						$ci->db->join('listings_meta lm', 'lm.listings_id = l.id AND meta_key = "listing_type" and (meta_value="featured" OR meta_value="recommended")', 'right');
						
						$query = $ci->db->get();
						$count = $query->row();
						$count = $count->count;
						
						//2) save into categories meta for next usage. // insert

						$db_key = 'country_id_' . $country_id . '_cat_id_' . intval($child_arr->cat_id) . '__total_count';

						$data = [
							'categories_id' => intval($child_arr->cat_id),
							'meta_key'	=> $db_key,
							'meta_value'	=> $count,
							'created_at' => date("Y-m-d H:i:s"),
						];
						$ci->db->set($data);
						
						$ci->db->insert(
							'categories_meta'
						);
					}else {
						$count = $count_meta->meta_value;
					}
					
					
					// Save Data
					//$ci->cache->save($cache_key, $count, MAX_CACHE_TTL_VALUE);
					
				//}
				
				$child_arr->count = $count;
			}
		}
		unset($header_cat);
		unset($child_arr);
		unset($count);
		unset($cache_key);
		unset($count_meta);
		unset($data);
		unset($query);
		unset($db_key);
		unset($country_id);

		return $header_cats;
	}
}

if (!function_exists('volgo_get_cookie')) {
	/**
	 * This function will try first to get session from server OR try to get cookie from user system.
	 *
	 * @since 1.0.0
	 * @param string $cookie_name Cookie Index OR Session Index that we want to get
	 * @return bool|mixed It will return null if session or cookie not found for the given index. OR it will return the cookie / session value
	 *
	 */
	function volgo_get_cookie($cookie_name)
	{
		$ci = volgo_get_ci_object();
		$ci->load->helper('cookie');

		// Try to get from session
		$cookie = $ci->session->userdata($cookie_name);
		if ($cookie !== null)
			return $cookie;

		// trying from user system
		return $ci->input->cookie($cookie_name);

	}
}

if (!function_exists('volgo_get_states_by_country_id')) {
	function volgo_get_states_by_country_id($country_id)
	{
		$ci = volgo_get_ci_object();
		$ci->load->database();

//		$ci->db->cache_on();

		$ci->db->select('id, name');
		$ci->db->from('b2b_states');
		$ci->db->where('country_id', $country_id);
		$ci->db->order_by('name', 'asc');

//		$ci->db->cache_off();

		$states = $ci->db->get()->result();
		return $states;
	}
}

if (!function_exists('volgo_get_cities_by_state_id')) {
	function volgo_get_cities_by_state_id($state_id, $columns = 'id, name')
	{
		$ci = volgo_get_ci_object();
		$ci->load->database();

//		$ci->db->cache_on();

		$ci->db->select($columns);
		$ci->db->from('b2b_cities');
		$ci->db->where('state_id', $state_id);
		$ci->db->order_by('name', 'asc');

		$states = $ci->db->get()->result();

//		$ci->db->cache_off();

		return $states;
	}
}


if (!function_exists('volgo_ajax__get_states_by_country_id')) {
	function volgo_ajax__get_states_by_country_id()
	{
		$ci = volgo_get_ci_object();
		$posted_data = filter_input_array(INPUT_POST);

		if (!$ci->input->is_ajax_request() || !isset($posted_data['country_id'])) {
			exit('No direct script access allowed');
		}

		if (!intval($posted_data['country_id'])) {
			echo json_encode(
				[
					'status' => 'error'
				]
			);
			exit;
		}

		$states = volgo_get_states_by_country_id($posted_data['country_id']);
		$states['status'] = 'success';

		echo json_encode($states);
		exit;
	}
}


if (!function_exists('volgo_get_country_states_by_session_country_id')) {
	function volgo_get_country_states_by_session_country_id()
	{
		return volgo_get_states_by_country_id(volgo_get_country_id_from_session());
	}
}

if (!function_exists('volgo_get_country_id_from_session')) {
	function volgo_get_country_id_from_session()
	{
		$info = volgo_get_country_info_from_session();
		return $info['country_id'];
	}
}

if (!function_exists('volgo_make_slug')) {
	function volgo_make_slug($string = '')
	{
		if (empty($string)) return '';
		return (preg_replace("/-$&/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($string))));
	}
}


if (!function_exists('volgo_get_block')) {
	function volgo_get_block($unique_key)
	{
		$ci = volgo_get_ci_object();
		$ci->load->database();

		//$ci->db->cache_on();

		$ci->db->from('blocks');
		$ci->db->where('unique_key', $unique_key);
		$result = $ci->db->get();

		//$ci->db->cache_off();
		return ($result->result());
	}
}

if (!function_exists('volgo_get_logged_in_user_id')) {
	function volgo_get_logged_in_user_id()
	{
		if (!volgo_front_is_logged_in())
			return 0;

		$ci = volgo_get_ci_object();
		$ci->load->database();

		$session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
		$session_data = explode(',', $session_data);

		if (!isset($session_data[0]))
			return 0;

		//$ci->db->cache_on();

		$ci->db->select('id');
		$ci->db->from('b2b_users');
		$ci->db->where('email', $session_data[0]);
		$ci->db->limit(1);

		//$ci->db->cache_off();

		$user_id = $ci->db->get()->row();
		return $user_id->id;
	}
}
if (!function_exists('volgo_get_logged_in_user_data')) {
	function volgo_get_logged_in_user_data()
	{
		if (!volgo_front_is_logged_in())
			return 0;

		$ci = volgo_get_ci_object();
		$ci->load->database();

		$session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
		$session_data = explode(',', $session_data);

		if (!isset($session_data[0]))
			return 0;

		//$ci->db->cache_on();

		$ci->db->select('firstname,lastname');
		$ci->db->from('b2b_users');
		$ci->db->where('email', $session_data[0]);
		$ci->db->limit(1);

		//$ci->db->cache_off();
		$user_data = $ci->db->get()->row();
		return $user_data->firstname;
	}
}

if (!function_exists('volgo_get_country_id_by_name')) {
	function volgo_get_country_id_by_name($name, $columns = '*')
	{
		$ci = volgo_get_ci_object();
		$ci->load->database();

		//$ci->db->cache_on();

		$country_row = $ci->db->select($columns)->from('b2b_countries')->where('name', $name)->limit(1)->get()->row();

		//$ci->db->cache_off();

		return $country_row;
	}
}

if (! function_exists('volgo_get_country_name_by_id')){
    function volgo_get_country_name_by_id($id, $columns = '*'){
        $ci = volgo_get_ci_object();
        $ci->load->database();

        //$ci->db->cache_on();

        $country_row = $ci->db->select($columns)->from('b2b_countries')->where('id', $id)->limit(1)->get()->row();

        //$ci->db->cache_off();

        return $country_row;
    }
}

if (! function_exists('volgo_get_no_image_url')){
	function volgo_get_no_image_url(){
		return base_url('uploads/general/no-image.jpg');
	}
}

if (! function_exists('volgo_get_job_wanted_image_url')){
    function volgo_get_job_wanted_image_url(){
        return base_url('uploads/general/job_wanted.png');
    }
}

if (!function_exists('volgo_get_ad_banners')) {
	function volgo_get_ad_banners($display_unit = 'after-listing', $columns = 'id, title, url, description, ad_code_image, ad_type', $limit = 2, $order_by = 'desc')
	{
		$ci = volgo_get_ci_object();
		$ci->load->database();

//		$ci->db->cache_on();
		$ci->db->select($columns);
		$ci->db->from('ad_banners');

		if (empty($display_unit))
			$ci->db->where('display_unit', 'after-listing');
		else
			$ci->db->where('display_unit', $display_unit);

		$ci->db->limit($limit);
		$ci->db->order_by('id', $order_by);
		$query = $ci->db->get();
//		$ci->db->cache_off();

		$banners = $query->result();
		return $banners;
	}
}

if (!function_exists('volgo_get_left_sidebar_ad_banners')) {
	function volgo_get_left_sidebar_ad_banners($display_unit = 'left-sidebar', $columns = 'id, ad_code_image, ad_type', $limit = 2, $order_by = 'desc')
	{
		$ci = volgo_get_ci_object();
		$ci->load->database();

		//$ci->db->cache_on();

		$ci->db->select($columns);
		$ci->db->from('ad_banners');

		if (!empty($display_unit))
			$ci->db->where('display_unit', 'left-sidebar');
		else
			$ci->db->where('display_unit', $display_unit);

		$ci->db->limit($limit);
		$ci->db->order_by('id', $order_by);
		$query = $ci->db->get();

		//$ci->db->cache_off();

		$banners = $query->result();
		return $banners;
	}
}

if (!function_exists('volgo_get_cat_id_by_slug')) {
	function volgo_get_cat_id_by_slug($slug = '')
	{
		$ci = volgo_get_ci_object();

		//$ci->db->cache_on();

		$ci->db->select('id');
		$ci->db->from('categories');
		$ci->db->where('slug', $slug);
		$result = $ci->db->get()->row();

		//$ci->db->cache_off();

		if (!empty($result) && is_object($result)) {
			return $result->id;
		}

		return '';
	}
}

if (! function_exists('volgo_is_serialized')){
    function volgo_is_serialized( $data, $strict = true ) {
        // if it isn't a string, it isn't serialized.
        if ( ! is_string( $data ) ) {
            return false;
        }
        $data = trim( $data );
        if ( 'N;' == $data ) {
            return true;
        }
        if ( strlen( $data ) < 4 ) {
            return false;
        }
        if ( ':' !== $data[1] ) {
            return false;
        }
        if ( $strict ) {
            $lastc = substr( $data, -1 );
            if ( ';' !== $lastc && '}' !== $lastc ) {
                return false;
            }
        } else {
            $semicolon = strpos( $data, ';' );
            $brace     = strpos( $data, '}' );
            // Either ; or } must exist.
            if ( false === $semicolon && false === $brace ) {
                return false;
            }
            // But neither must be in the first X characters.
            if ( false !== $semicolon && $semicolon < 3 ) {
                return false;
            }
            if ( false !== $brace && $brace < 4 ) {
                return false;
            }
        }
        $token = $data[0];
        switch ( $token ) {
            case 's':
                if ( $strict ) {
                    if ( '"' !== substr( $data, -2, 1 ) ) {
                        return false;
                    }
                } elseif ( false === strpos( $data, '"' ) ) {
                    return false;
                }
            // or else fall through
            case 'a':
            case 'O':
                return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
            case 'b':
            case 'i':
            case 'd':
                $end = $strict ? '$' : '';
                return (bool) preg_match( "/^{$token}:[0-9.E-]+;$end/", $data );
        }
        return false;
    }
}


if (! function_exists('volgo_maybe_unserialize')) {
    function volgo_maybe_unserialize($original)
    {
        if (volgo_is_serialized($original)) { // don't attempt to unserialize data that wasn't serialized going in
            return @unserialize($original);
        }
        return $original;
    }
}

if (! function_exists('volgo_get_currency_unit_by_country_id')) {
    function volgo_get_currency_unit_by_country_id($country_id = '')
    {
        $ci = volgo_get_ci_object();
        $ci->load->database();

        if (empty($country_id)){
            $country_id = volgo_get_country_id_from_session();
        }

        $result = $ci->db->select('unit')->from('currencies')->where('country_id', intval($country_id))->get()->row();

        if ($result === null || empty($result) || ! is_object($result)){
            return strtoupper(B2B_CURRENCY_UNIT);
        }

        return strtoupper($result->unit);
    }
}

// CHAT function - CHAT INTEGRATION
if (! function_exists('volgo_get_username_by_uid')){
    function volgo_get_username_by_uid ($uid = '')
    {
        if (empty($uid))
            $uid = volgo_get_logged_in_user_id();

        $ci = volgo_get_ci_object();

        $user_row = $ci->db->select('username,firstname,lastname')->from('b2b_users')->where('id', intval($uid))->get()->row();

        if (empty($user_row))
            return '';

        return $user_row->username;
    }
}
if (! function_exists('volgo_get_user_name_by_uid')){
    function volgo_get_user_name_by_uid ($uid = '')
    {
        if (empty($uid))
            $uid = volgo_get_logged_in_user_id();

        $ci = volgo_get_ci_object();

        $user_row = $ci->db->select('firstname,lastname')->from('b2b_users')->where('id', intval($uid))->get()->row();

        if (empty($user_row))
            return '';

        return $user_row->firstname .' '. $user_row->lastname;
    }
}
if (! function_exists('volgo_check_is_user_loggedin')){
    function volgo_check_is_user_loggedin ($username)
    {
        $ci = volgo_get_ci_object();
        $md5_hash = md5($username);

        $row = $ci->db->select('*')->from('users_list')->where('user_id', $md5_hash)->limit(1)->get()->row();

        if (empty($row))
            return false;

        return true;
    }
}

if (! function_exists('volgo_get_user_online_offline_html')){
     function volgo_get_user_online_offline_html($user_id, $user_since = ''){
         ob_start();
         $is_online = volgo_check_is_user_loggedin(volgo_get_username_by_uid((intval($user_id))));
         //var_export($is_online);
         ?>
        <li class="<?php echo $is_online ? 'on' : 'offline'; ?>"><span></span><?php echo $is_online ? 'Online' : 'Offline'; ?></li>
<!--        --><?php //if (isset($user_since) && $user_since !== '') { ?>
         <!--            <li>Member: --><?php //echo $user_since; ?><!--</li>-->
         <!--        --><?php //}

        return ob_get_clean();
     }
}

if (! function_exists('volgo_get_category_id_by_slug')){
    function volgo_get_category_id_by_slug($cat_name){
        $ci = volgo_get_ci_object();
        $row = $ci->db->select('id')->from('categories')->where('slug', $cat_name)->limit(1)->get()->row();

        return $row->id;
    }
}

if (! function_exists('volgo_get_category_slug_by_id')){
    function volgo_get_category_slug_by_id($id){
        $ci = volgo_get_ci_object();
        $row = $ci->db->select('slug')->from('categories')->where('id', $id)->limit(1)->get()->row();

        return $row->slug;
    }
}


if (!function_exists('volgo_get_logged_in_user_cv_data')) {
	function volgo_get_logged_in_user_cv_data()
	{
		if (!volgo_front_is_logged_in())
			return 0;

		$ci = volgo_get_ci_object();
		$ci->load->database();

		$session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
		$session_data = explode(',', $session_data);

		$user_loged = volgo_get_logged_in_user_id();

		if (!isset($session_data[0]))
			return 0;

		//$ci->db->cache_on();

		$ci->db->select('meta_value');
		$ci->db->from('b2b_user_meta');
		$ci->db->where('meta_key', 'user_cv');
		$ci->db->where('user_id', $user_loged);

		$result = $ci->db->get();
		$user_data = $result->row();

		return $user_data;
	}
}

if (!function_exists('volgo_get_logged_in_user_cv_data')) {
    function volgo_get_logged_in_user_cv_data()
    {
        if (!volgo_front_is_logged_in())
            return 0;

        $ci = volgo_get_ci_object();
        $ci->load->database();

        $session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
        $session_data = explode(',', $session_data);

        $user_loged = volgo_get_logged_in_user_id();

        if (!isset($session_data[0]))
            return 0;

        //$ci->db->cache_on();

        $ci->db->select('*');
        $ci->db->from('b2b_user_meta');
        $ci->db->where('meta_key', 'user_cv');
        $ci->db->where('user_id', $user_loged);

        $result = $ci->db->get();
        $user_data = $result->result();

        return $user_data;
    }
}
if (!function_exists('volgo_get_logged_in_user_meta')) {
    function volgo_get_logged_in_user_meta($userId = "")
    {
		if(empty($userId)){
			if (!volgo_front_is_logged_in())
            	return 0;

			$session_data = volgo_decrypt_message($_SESSION['volgo_user_login_data']);
			$session_data = explode(',', $session_data);
	
			$user_loged = volgo_get_logged_in_user_id();
	
			if (!isset($session_data[0]))
				return 0;
		
		}else{
			$user_loged = $userId;
		}
        
        $ci = volgo_get_ci_object();
        $ci->load->database();

        
        //$ci->db->cache_on();

        $ci->db->select('*');
        $ci->db->from('b2b_user_meta');
        $ci->db->where('user_id', $user_loged);

        $result = $ci->db->get();
        $user_data = $result->result();

        return $user_data;
    }
}

if (!function_exists('volgo_get_cat_image_for_mobile')) {
    function volgo_get_cat_image_for_mobile($cat_id)
    {
        $cat_id = intval($cat_id);

        if ($cat_id === 5) {
            // autos
            return base_url('assets/frontend-mobile/images/autos.png');
        } else if ($cat_id === 28) {
            // classified
            return base_url('assets/frontend-mobile/images/classified.png');
        } else if ($cat_id === 50) {
            //jobs
            return base_url('assets/frontend-mobile/images/jobs.png');
        } else if ($cat_id === 108) {
            //jobs wanted
            return base_url('assets/frontend-mobile/images/wanted.png');
        } else if ($cat_id === 17) {
            //property for rent
            return base_url('assets/frontend-mobile/images/rnt.png');
        } else if ($cat_id === 10) {
            //property for sale
            return base_url('assets/frontend-mobile/images/property.png');
        } else {
            //services
            return base_url('assets/frontend-mobile/images/service.png');
        }
    }
}
if (!function_exists('volgo_send_email')) {
    function volgo_send_email($msg,$subject,$emailto = '',$emailfrom = '',$data = '',$addBCC = false)
    {	
    		$mail = new \PHPMailer\PHPMailer\PHPMailer();
			// SMTP configuration
			try {
                //$mail->SMTPDebug = 1;
				$mail->isSMTP();
				//$mail->Host = PHPMAILER_SENDER_HOST;
				$mail->Host = "mail.volgopoint.com";
				$mail->SMTPAuth = true;
				//$mail->SMTPAuth = PHPMAILER_SENDER_SMTPAUTH;
				//$mail->Username = PHPMAILER_SENDER_USERNAME;
                //$mail->Password = PHPMAILER_SENDER_PASSWORD;
                //$mail->SMTPSecure = PHPMAILER_SENDER_SMTP_SECURE;
                //$mail->Username = "Info@volgopoint.com";
                $mail->Username = "no-reply@volgopoint.com";
                //$mail->Password = "Vol%info#786";
                $mail->Password = "HC;_KUpxZa(Z";
                $mail->SMTPAutoTLS = true;
                $mail->Timeout = 10;
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer'       => true,
                        'verify_peer_name'  => false,
                        'allow_self_signed' => true,
                    ),
                );
                //$mail->SMTPSecure = "tls";
				$mail->Port = 25;
				//$mail->Port = PHPMAILER_SENDER_PORT;

				if(!empty($emailfrom)){
                $mail->setFrom($emailfrom);
            	}else if(!empty($data['email']) && !empty($data['name'])){
            		$mail->setFrom($data['email'] , $data['name']);
            	}else {
            		$mail->setFrom(NEWSLETTER_FROM_EMAIL);
            	}
                
                    // Email subject
                $mail->Subject = $subject;
                    // Set email format to HTML
                $mail->isHTML(true);
                if(!empty($emailto))
                $mail->addAddress($emailto);
            	if($addBCC && !empty($data['email']) && !empty($data['name']))
            	$mail->addBCC($data['email'] , $data['name']);
                if(!empty($data['email']) && !empty($data['name']));
                $mail->addAddress($data['email'] ,  $data['name']);
            	
                $mail->Body = $msg;

				$mail->send();
				
				} catch (Exception $e) {
					log_message('error', $mail->ErrorInfo);
					redirect(404);
					return false;
				}  
    }
}
    if (!function_exists('volgo_db_country_id_by_country_code')) {
	function volgo_db_country_id_by_country_code($country_code)
	{
		$ci = volgo_get_ci_object();
		$ci->load->database();
		
		//$ci->db->cache_on();
		$ci->db->select('id');
		$ci->db->from('b2b_countries');
		$ci->db->where('shortname', ucwords($country_code));
		$ci->db->limit(1);
		$country = $ci->db->get();
		//$ci->db->cache_off();

		return ($country->row()->id);
	}
    }
    
if (!function_exists('volgo_is_user_deleted')) {
	function volgo_is_user_deleted($user_id)
	{
		$ci = volgo_get_ci_object();
		$ci->load->database();

		$ci->db->select('is_deleted');
		$ci->db->from('b2b_users');
		$ci->db->where('id', $user_id);
		$ci->db->limit(1);
		$user = $ci->db->get();

		if(intval($user->row()->is_deleted) === 1){
		 	return	true;
		}elseif(!$user->row()->is_deleted || intval($user->row()->is_deleted) === 0){
			return false;
		}
	}
}
if (!function_exists('volgo_get_seo_details')) {
	function volgo_get_seo_details($page_type = '',$category = '',$sub_category = '')
	{
		if($category === 'buying-leads'){
			$category = 'buying-lead';
		}
		if($category === 'seller-leads'){
			$category = 'seller-lead';
		}
		$ci = volgo_get_ci_object();
		$ci->load->database();

		$ci->db->select('id,seo_meta_keywords as seo_keywords,seo_meta_description as seo_description,seo_title');
		$ci->db->from('seo_settings');
		$ci->db->where('page_type', $page_type);
		if (!empty($category)) {
		    if($category === 'buying-lead' || $category === 'seller-lead'){
			$ci->db->where('sub_category', $sub_category);
		    }else{
		    $ci->db->where('category', $category);
		    }
		}
		if (!empty($sub_category)) {
			$ci->db->where('sub_category', $sub_category);    
		}else{
			$ci->db->where('sub_category =', null);
		}
		$ci->db->limit(1);
		$seo_settings = $ci->db->get();
		
		if($seo_settings->num_rows() > 0){
		return	$seo_settings->row();
		}else{
		$ci->db->select('id,seo_meta_keywords as seo_keywords,seo_meta_description as seo_description,seo_title');
		$ci->db->from('seo_settings');
		$ci->db->where('page_type', $page_type);
		if (!empty($category)) {
		    $ci->db->where('category', $category);
		}else{
			$ci->db->where('category =', null);
		}
		$ci->db->limit(1);
		$seo_settings = $ci->db->get();
		
		return	$seo_settings->row();
		}
		
	}
}

if (!function_exists('volgo_db_city_id_by_city_name')) {
	function volgo_db_city_id_by_city_name($city_name)
	{
		$ci = volgo_get_ci_object();
		$ci->load->database();
		
		//$ci->db->cache_on();
		$ci->db->select('id');
		$ci->db->from('b2b_cities');
		$ci->db->where('name', ucwords($city_name));
		$ci->db->limit(1);
		$city = $ci->db->get();
		//$ci->db->cache_off();

		return ($city->row()->id);
	}
}

if (!function_exists('volgo_db_city_name_by_city_id')) {
    function volgo_db_city_name_by_city_id($city_id)
    {
        $ci = volgo_get_ci_object();
        $ci->load->database();
        $ci->db->select('*');
        $ci->db->from('b2b_cities');
        $ci->db->where('id', $city_id);
        $ci->db->limit(1);
        $city = $ci->db->get();

        return ($city->row()->name);
    }
}
