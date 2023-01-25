<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/27/2019
 * Time: 11:26 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Model extends CI_Model{

	private $tablename = 'orders';

	public function get_total_income($currency_unit = 'usd')
	{
		$this->db->select_sum('amount');
		$this->db->from($this->tablename);
		$this->db->where('status', 'paid');
		$this->db->where('currency_unit', $currency_unit);
		$result = $this->db->get();

		return $result->result();
	}

	public function get_total_orders($status = '')
	{
		$this->db->select('count(id) as total_orders');
		$this->db->from($this->tablename);
		if (! empty($status))
			$this->db->where('status', $status);

		$result = $this->db->get();

		return $result->result();
	}

    public function get_total_users()
    {
        $this->db->select('count(id) as total_users');
        $this->db->from('b2b_users');
        $result = $this->db->get();
        return $result->result();
    }

    public function get_total_posts()
    {
        $this->db->select('count(id) as total_posts');
        $this->db->from('listings');
        $result = $this->db->get();
        return $result->result();
    }

    public function get_total_pak_posts($country_id = '166')
    {
        $this->db->select('count(id) as total_posts');
        $this->db->from('listings');
        if (! empty($country_id))
            $this->db->where('country_id', $country_id);
        $result = $this->db->get();
        return $result->result();
    }

    public function get_total_uae_posts($country_id = '229')
    {
        $this->db->select('count(id) as total_posts');
        $this->db->from('listings');
        if (! empty($country_id))
            $this->db->where('country_id', $country_id);
        $result = $this->db->get();
        return $result->result();
    }

    public function get_total_usa_posts($country_id = '231')
    {
        $this->db->select('count(id) as total_posts');
        $this->db->from('listings');
        if (! empty($country_id))
            $this->db->where('country_id', $country_id);
        $result = $this->db->get();
        return $result->result();
    }

    public function get_total_active_posts($status = 'enabled')
    {
        $this->db->select('count(id) as total_active_posts');
        $this->db->from('listings');
        if (! empty($status))
            $this->db->where('status', $status);
        $result = $this->db->get();
        return $result->result();
    }

    public function get_total_pak_active_posts($status = 'enabled', $country_id = '166')
    {
        $this->db->select('count(id) as total_active_posts');
        $this->db->from('listings');
        if (! empty($status) && !empty($country_id))
            $this->db->where('status', $status);
            $this->db->where('country_id', $country_id);
        $result = $this->db->get();
        return $result->result();
    }

    public function get_total_uae_active_posts($status = 'enabled', $country_id = '229')
    {
        $this->db->select('count(id) as total_active_posts');
        $this->db->from('listings');
        if (! empty($status) && !empty($country_id))
            $this->db->where('status', $status);
        $this->db->where('country_id', $country_id);
        $result = $this->db->get();
        return $result->result();
    }

    public function get_total_usa_active_posts($status = 'enabled', $country_id = '231')
    {
        $this->db->select('count(id) as total_active_posts');
        $this->db->from('listings');
        if (! empty($status) && !empty($country_id))
            $this->db->where('status', $status);
        $this->db->where('country_id', $country_id);
        $result = $this->db->get();
        return $result->result();
    }

    public function get_total_disable_posts($status = 'disabled')
    {
        $this->db->select('count(id) as total_disable_posts');
        $this->db->from('listings');
        if (! empty($status))
            $this->db->where('status', $status);
        $result = $this->db->get();
        return $result->result();
    }

    public function get_total_pak_disable_posts($status = 'disabled', $country_id = '166')
    {
        $this->db->select('count(id) as total_disable_posts');
        $this->db->from('listings');
        if (! empty($status) && !empty($country_id))
            $this->db->where('status', $status);
        $this->db->where('country_id', $country_id);
        $result = $this->db->get();
        return $result->result();
    }

    public function get_total_uae_disable_posts($status = 'disabled', $country_id = '229')
    {
        $this->db->select('count(id) as total_disable_posts');
        $this->db->from('listings');
        if (! empty($status) && !empty($country_id))
            $this->db->where('status', $status);
        $this->db->where('country_id', $country_id);
        $result = $this->db->get();
        return $result->result();
    }

    public function get_total_usa_disable_posts($status = 'disabled', $country_id = '231')
    {
        $this->db->select('count(id) as total_disable_posts');
        $this->db->from('listings');
        if (! empty($status) && !empty($country_id))
            $this->db->where('status', $status);
        $this->db->where('country_id', $country_id);
        $result = $this->db->get();
        return $result->result();
    }

    public function get_total_usa_today_enabled_posts($status = 'enabled', $country_id = '231')
    {
        $this->db->select('count(id) as total_active_posts');
        $this->db->from('listings');
        if (! empty($status) && !empty($country_id))
            $this->db->where('status', $status);
        $this->db->where('country_id', $country_id);
        $this->db->where('created_at', date("Y-m-d H:i:s"));
        $result = $this->db->get();
        return $result->result();
    }

    public function get_total_today_posts(){
	    $query = 'SELECT c.id,c.name,
        (
        SELECT COUNT(u.id)
            FROM b2b_users u
            JOIN b2b_user_meta um
            ON u.id = um.user_id
            WHERE 1 = 1
        
                AND(
                (um.meta_key = "nationality" AND um.meta_value IS NOT NULL AND um.meta_value = c.id)
                OR (um.meta_key = "Selected_country" AND um.meta_value IS NOT NULL AND um.meta_value = c.id)
                OR (um.meta_key = "user_country" AND um.meta_value IS NOT NULL AND um.meta_value = c.id)
            )
            AND DATE(u.created_at) = CURDATE()
        ) AS reg_users,
        (
        SELECT COUNT(l.id) 
            FROM listings l
            WHERE DATE(l.created_at) = CURDATE()
                AND l.country_id = c.id
        )as posts,
        (
        SELECT COUNT(l.id) 
            FROM listings l
            WHERE DATE(l.created_at) = CURDATE()
                AND l.country_id = c.id
                AND l.status = "enabled"
        )as active_posts,
        (
        SELECT COUNT(l.id) 
            FROM listings l
            WHERE DATE(l.created_at) = CURDATE()
                AND l.country_id = c.id
                AND l.status = "disabled"
        )as inactive_posts
        FROM b2b_countries c
        HAVING reg_users > 0
                OR posts > 0
                OR active_posts > 0
                OR inactive_posts > 0';
        $today_stats = $this->db->query($query);
        return  $today_stats->result();
	}

    public function get_total_weekly_posts(){

        $query = 'SELECT c.id,c.name,
        (
        SELECT COUNT(u.id)
            FROM b2b_users u
            JOIN b2b_user_meta um
            ON u.id = um.user_id
            WHERE 1 = 1
        
                AND(
                (um.meta_key = "nationality" AND um.meta_value IS NOT NULL AND um.meta_value = c.id)
                OR (um.meta_key = "Selected_country" AND um.meta_value IS NOT NULL AND um.meta_value = c.id)
                OR (um.meta_key = "user_country" AND um.meta_value IS NOT NULL AND um.meta_value = c.id)
            )
            AND YEARWEEK(u.created_at) = YEARWEEK(NOW())
        ) AS reg_users,
        (
        SELECT COUNT(l.id) 
            FROM listings l
            WHERE YEARWEEK(l.created_at) = YEARWEEK(NOW())
                AND l.country_id = c.id
        )as posts,
        (
        SELECT COUNT(l.id) 
            FROM listings l
            WHERE YEARWEEK(l.created_at) = YEARWEEK(NOW())
                AND l.country_id = c.id
                AND l.status = "enabled"
        )as active_posts,
        (
        SELECT COUNT(l.id) 
            FROM listings l
            WHERE YEARWEEK(l.created_at) = YEARWEEK(NOW())
                AND l.country_id = c.id
                AND l.status = "disabled"
        )as inactive_posts
        FROM b2b_countries c
        HAVING reg_users > 0
                OR posts > 0
                OR active_posts > 0
                OR inactive_posts > 0';
        $weekly_stats = $this->db->query($query);
        return  $weekly_stats->result();

	}

    public function get_total_monthly_posts(){

        $query = 'SELECT c.id,c.name,
        (
        SELECT COUNT(u.id)
            FROM b2b_users u
            JOIN b2b_user_meta um
            ON u.id = um.user_id
            WHERE 1 = 1
        
                AND(
                (um.meta_key = "nationality" AND um.meta_value IS NOT NULL AND um.meta_value = c.id)
                OR (um.meta_key = "Selected_country" AND um.meta_value IS NOT NULL AND um.meta_value = c.id)
                OR (um.meta_key = "user_country" AND um.meta_value IS NOT NULL AND um.meta_value = c.id)
            )
            AND MONTH(u.created_at) = MONTH(CURRENT_DATE())
                AND YEAR(u.created_at) = YEAR(CURRENT_DATE())
        ) AS reg_users,
        (
        SELECT COUNT(l.id) 
            FROM listings l
            WHERE MONTH(l.created_at) = MONTH(CURRENT_DATE())
                AND YEAR(l.created_at) = YEAR(CURRENT_DATE())
                AND l.country_id = c.id
        )as posts,
        (
        SELECT COUNT(l.id) 
            FROM listings l
            WHERE MONTH(l.created_at) = MONTH(CURRENT_DATE())
                AND YEAR(l.created_at) = YEAR(CURRENT_DATE())
                AND l.country_id = c.id
                AND l.status = "enabled"
        )as active_posts,
        (
        SELECT COUNT(l.id) 
            FROM listings l
            WHERE MONTH(l.created_at) = MONTH(CURRENT_DATE())
                AND YEAR(l.created_at) = YEAR(CURRENT_DATE())
                AND l.country_id = c.id
                AND l.status = "disabled"
        )as inactive_posts
        FROM b2b_countries c
        HAVING reg_users > 0
                OR posts > 0
                OR active_posts > 0
                OR inactive_posts > 0';
        $monthly_stats = $this->db->query($query);
        return  $monthly_stats->result();
    }

    public function get_total_today_disable_posts()
    {
        $today_disable_posts_data = array();
        $data = array();
        $this->db->select('id as country_id,name as country_name');
        $this->db->from('b2b_countries');
        $result = $this->db->get();
        $countries_data = $result->result();
        foreach ($countries_data as $country){
            $this->db->select('count(l.id) as total_enable_posts');
            $this->db->from('listings l');
            $this->db->where('DATE(l.created_at)', date('Y-m-d'));
            $this->db->where('l.status', 'disabled');
            $this->db->where('country_id', $country->country_id);
            $this->db->group_by('l.id');
            $result1 = $this->db->get();
            $counts = $result1->row();
            $data['counts'] = !isset($counts->total_enable_posts) ? '0' : $counts->total_enable_posts;
            $data['country_id'] = $country->country_id;
            $data['country_name'] = $country->country_name;
            array_push($today_disable_posts_data, $data);
        }
        return $today_disable_posts_data;
    }

}
