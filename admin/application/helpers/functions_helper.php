<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require (FCPATH . 'enviornments.php');

$ci=& get_instance();
$ci->load->database();


$ci->db->select('*');
$ci->db->from('settings');
$ci->db->where('type', 'default');
$block = $ci->db->get();
$settings = $block->result();

foreach ($settings as $setting){
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

	if ($setting->key === 'geo_ip_location_api_key')
		define('GEO_IP_LOCATION_API_KEY', $setting->value);

	if ($setting->key === 'geo_ip_location_api_url')
		define('GEO_IP_LOCATION_API_URL', $setting->value);

	if ($setting->key === 'email_for_new_post_to_follower')
		define('EMAIL_FOR_NEW_POST_TO_FOLLOWER', $setting->value);

	if ($setting->key === 'email_for_new_follower')
		define('EMAIL_FOR_NEW_FOLLOWER', $setting->value);

    if ($setting->key === 'listing_approved_email_user')
        define('LISTING_APPROVED_EMAIL_USER', $setting->value);

    if ($setting->key === 'comment_approved_email_for_user')
        define('COMMENT_APPROVED_EMAIL_FOR_USER', $setting->value);
        
    if ($setting->key === 'contact_email_buyer')
		        define('CONTACT_EMAIL_BUYER', $setting->value);

    if ($setting->key === 'contact_email_seller')
        define('CONTACT_EMAIL_SELLER', $setting->value);

    if ($setting->key === 'invoice_paid_email_user')
        define('INVOICE_PAID_EMAIL_USER', $setting->value);

    if ($setting->key === 'listing_added_email')
        define('LISTING_ADDED_EMAIL', $setting->value);

}
if (defined('EXCHANGE_RATE_URL') && defined('EXCHANGE_RATE_API_ACCESS_KEY'))
	define('EXCHANGE_RATE_URL_WITH_KEY', EXCHANGE_RATE_URL . EXCHANGE_RATE_API_ACCESS_KEY);

/*define('FRONT_END_SITE_URL', 'http://b2bclassifiedlocal.test/');
define('SITE_NAME', 'B2B Classified');
define('TINY_MCE_API_KEY', 'ye1t8zb5avu7of7flio3dcgrtcjzdgkha6hc7er171sgpv3b');
define('GEO_IP_LOCATION_API_KEY', '38661a3a8e1466c48e0f45f10a04f7b1');
define('GEO_IP_LOCATION_API_URL', 'http://api.ipapi.com/');
define('B2B_CURRENCY_UNIT', 'aed');
define('NEWSLETTER_FROM_EMAIL', 'farhanvolgopoint@gmail.com');
define('PHPMAILER_SENDER_HOST', 'smtp.gmail.com');
define('PHPMAILER_SENDER_SMTPAUTH', true);
define('PHPMAILER_SENDER_USERNAME', 'farhanvolgopoint@gmail.com');
define('PHPMAILER_SENDER_PASSWORD', 'Volgopoint203');
define('PHPMAILER_SENDER_SMTP_SECURE', 'ssl');
define('PHPMAILER_SENDER_PORT', '465');
define('PAYPAL_CLIENT_ID', 'AX8_v3aiWJ0Mf4mhZcxQ-Bab_JyB9DPIBV8jZhv-JP8LI9riRcp9b6VgmyddgVpDbZaB0Dj63ot_kJvp');
define('PAYPAL_SECRET_ID', 'EKyo5b13XYUAR9ybQCtpKqaZMAbzYo8tuTNINTDPG1uZklmQljaiPqsewg9M4t1zKvLjkEq5R9IeUy-M');
define('AVAILABLE_PAYMENT_METHODS', 'paypal,network');
define('EXCHANGE_RATE_API_ACCESS_KEY', '42337bfc646f958606003851');
define('EXCHANGE_RATE_URL', 'https://v3.exchangerate-api.com/bulk/');
define('EXCHANGE_RATE_URL_WITH_KEY', 'https://v3.exchangerate-api.com/bulk/' . EXCHANGE_RATE_API_ACCESS_KEY);*/


if (! defined('VOLGO_FRONTEND_CACHE_PATH'))
	define('VOLGO_FRONTEND_CACHE_PATH', __FRONT_END_CACHE_PATH__);
	
if (! defined('IMG_BASE_URL'))
	define('IMG_BASE_URL', __IMG_BASE_URL__);

if (! defined('VOLGO_COOKIE_USER_COUNTRY_INFO'))
    define('VOLGO_COOKIE_USER_COUNTRY_INFO', 'volgo_user_country_info');

if (! defined('VOLGO_COOKIE_USER_COUNTRY_NAME'))
    define('VOLGO_COOKIE_USER_COUNTRY_NAME', 'volgo_user_country_name');

if (! defined('MAX_CACHE_TTL_VALUE'))
	define('MAX_CACHE_TTL_VALUE', __MAX_CACHE_TIME__); // save for 72 hours


date_default_timezone_set(__DEFAULT_TIMEZONE__);

if (!function_exists('volgo_get_ci_object')) {
	function volgo_get_ci_object()
	{
		$ci =& get_instance();
		return $ci;
	}
}

if (! function_exists('volgo_is_logged_in')){
	function volgo_is_logged_in(){

		if (! isset($_SESSION['volgo_admin_login_data']))
			return false;

		$session_data = volgo_decrypt_message($_SESSION['volgo_admin_login_data']);
		$session_data = explode(',', $session_data);

		if ( ( $session_data[ sizeof($session_data) -1 ] + 86400 ) > time() ){
			return true;
		}

		return false;
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


if (!function_exists('volgo_get_logged_in_user_id')) {
	function volgo_get_logged_in_user_id()
	{
		if (!volgo_is_logged_in())
			return 0;

		$ci = volgo_get_ci_object();
		$ci->load->database();

		$session_data = volgo_decrypt_message($_SESSION['volgo_admin_login_data']);
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

if (! function_exists('volgo_encrypt_message')){
	function volgo_encrypt_message($message){
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


if (! function_exists('volgo_decrypt_message')){
	function volgo_decrypt_message($enc_message){
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

if (! function_exists('volgo_debug')){
	function volgo_debug($value, $echo = true, $exit = true){
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

if (! function_exists('volgo_do_currency_exchange')){
	function volgo_do_currency_exchange($amount, $from_currency = B2B_CURRENCY_UNIT, $to_currency = 'usd'){

		$response_json = file_get_contents( (EXCHANGE_RATE_URL_WITH_KEY . '/' . $from_currency) );

		// Continuing if we got a result
		if(false !== $response_json) {
			// Try/catch for json_decode operation
			try {
				// Decoding
				$response_object = json_decode($response_json);

				// Checking for errors
				if('success' === $response_object->result) {
					$base_price = floatval($amount);

					$rates = $response_object->rates;
					$to_currency_rate = 0;
					foreach ($rates as $key => $rate){

						if (strtolower($key) === strtolower($to_currency)){
							$to_currency_rate = $rate;
							break;
						}

					}

					if ($to_currency_rate === 1){
						return false;
					}


					$converted_price = round(($base_price * $to_currency_rate), 2);

					return [
						'base_price'	=> $amount,
						'converted_price'	=> $converted_price,
						'base_currency_unit'	=> $from_currency,
						'to_currency_unit'	=> $to_currency,
						'currency_rate' =>	$to_currency_rate
					];

				} else {
					// Handling different error conditions
					switch($response_object->error) {
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
			}
			catch(Exception $e) {
				log_message('error', $e->getMessage());
				return false;
			}

		}else {
			return false;
		}


	}
}

if (! function_exists('volgo_make_slug')){
	function volgo_make_slug($string = ''){
		if (empty($string)) return '';
		return (preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($string))));
	}
}
if (! function_exists('get_category_slug_from_cat_id')){
	function get_category_slug_from_cat_id($cat_id)
	{
		$ci = volgo_get_ci_object();
        $row = $ci->db->select('slug')->from('categories')->where('id', $cat_id)->limit(1)->get()->row();

        return $row->slug;
	}
}
if (! function_exists('get_category_id_from_cat_slug')){
	function get_category_id_from_cat_slug($cat_slug , $type = '')
	{
		if(empty($cat_slug)) return '';
		$ci = volgo_get_ci_object();
		if(empty($type)  || !isset($type)){
			$row = $ci->db->select('id')->from('categories')->where('slug', $cat_slug)->limit(1)->get()->row();
		}else{
			$row = $ci->db->select('id')->from('categories')->where('slug', $cat_slug)->where('category_type', $type)->limit(1)->get()->row();
		}
        

        return $row->id;
	}
}

if (!function_exists('get_users')) {
    function get_users()
    {
        $ci = volgo_get_ci_object();

        $users_db_info = $ci->db->select('id,username,firstname,lastname')->from('b2b_users')->order_by('firstname', 'ASC')->get()->result();
        
        return $users_db_info;
    }
}


if (!function_exists('get_countries')) {
	function get_countries()
	{
		$ci = volgo_get_ci_object();
		$ci->load->database();
		
		$ci->db->cache_on();
		$ci->db->select('name,id,shortname');
		$ci->db->from('b2b_countries');
		$countries = $ci->db->get();
		$countries = $countries->result();
		$ci->db->cache_off();
		
		return $countries;
	}
}

if (! function_exists('volgo_get_user_name_by_user_id')) {
    function volgo_get_user_name_by_user_id($user_id = '')
    {
        $ci = volgo_get_ci_object();
        $ci->load->database();

        $result = $ci->db->select('firstname,lastname')->from('b2b_users')->where('id', intval($user_id))->get()->row();


        return $result->firstname . ' ' . $result->lastname;
    }
}

if (! function_exists('volgo_get_country_name_by_country_id')) {
    function volgo_get_country_name_by_country_id($country_id = '')
    {
        $ci = volgo_get_ci_object();
        $ci->load->database();

        if (empty($country_id)){
            $country_id = volgo_get_country_id_from_session();
        }

        $result = $ci->db->select('name')->from('b2b_countries')->where('id', intval($country_id))->get()->row();

        return $result->name;
    }
}

if (!function_exists('volgo_get_states')) {
	function volgo_get_states()
	{
		$ci = volgo_get_ci_object();
		$ci->load->database();

		$ci->db->cache_on();

		$ci->db->select('id, name,country_id');
		$ci->db->from('b2b_states');
		$ci->db->order_by('name', 'asc');

		$ci->db->cache_off();

		$states = $ci->db->get()->result();
		return $states;
	}
}
