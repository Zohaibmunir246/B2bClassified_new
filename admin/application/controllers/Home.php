<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/30/2019
 * Time: 1:40 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (! volgo_is_logged_in()){
			header('Location: ' . base_url('login'));
		}

		$this->load->model('Home_Model');
	}

	public function index()
	{
        ini_set('max_execution_time', 320);
        ini_set('memory_limit', '500M');
		$income_usd = $this->Home_Model->get_total_income('usd');
		$income_usd = isset($income_usd[0]) ? $income_usd[0]->amount : $income_usd;

		$income_aed = $this->Home_Model->get_total_income('aed');
		$income_aed = isset($income_aed[0]) ? $income_aed[0]->amount : $income_aed;

		$total_orders = $this->Home_Model->get_total_orders();
		$total_orders = isset($total_orders[0]) ? $total_orders[0]->total_orders : $total_orders;

		$total_users = $this->Home_Model->get_total_users();
        $total_users = isset($total_users[0]) ? $total_users[0]->total_users : $total_users;

        $total_posts = $this->Home_Model->get_total_posts();
        $total_posts = isset($total_posts[0]) ? $total_posts[0]->total_posts : $total_posts;

        $total_pak_posts = $this->Home_Model->get_total_pak_posts();
        $total_pak_posts = isset($total_pak_posts[0]) ? $total_pak_posts[0]->total_posts : $total_pak_posts;

        $total_uae_posts = $this->Home_Model->get_total_uae_posts();
        $total_uae_posts = isset($total_uae_posts[0]) ? $total_uae_posts[0]->total_posts : $total_uae_posts;

        $total_usa_posts = $this->Home_Model->get_total_usa_posts();
        $total_usa_posts = isset($total_usa_posts[0]) ? $total_usa_posts[0]->total_posts : $total_usa_posts;

        $total_active_posts = $this->Home_Model->get_total_active_posts();
        $total_active_posts = isset($total_active_posts[0]) ? $total_active_posts[0]->total_active_posts : $total_active_posts;

        $total_pak_active_posts = $this->Home_Model->get_total_pak_active_posts();
        $total_pak_active_posts = isset($total_pak_active_posts[0]) ? $total_pak_active_posts[0]->total_active_posts : $total_pak_active_posts;

        $total_uae_active_posts = $this->Home_Model->get_total_uae_active_posts();
        $total_uae_active_posts = isset($total_uae_active_posts[0]) ? $total_uae_active_posts[0]->total_active_posts : $total_uae_active_posts;

        $total_usa_active_posts = $this->Home_Model->get_total_usa_active_posts();
        $total_usa_active_posts = isset($total_usa_active_posts[0]) ? $total_usa_active_posts[0]->total_active_posts : $total_usa_active_posts;

        $total_disable_posts = $this->Home_Model->get_total_disable_posts();
        $total_disable_posts = isset($total_disable_posts[0]) ? $total_disable_posts[0]->total_disable_posts : $total_disable_posts;

        $total_pak_disable_posts = $this->Home_Model->get_total_pak_disable_posts();
        $total_pak_disable_posts = isset($total_pak_disable_posts[0]) ? $total_pak_disable_posts[0]->total_disable_posts : $total_pak_disable_posts;

        $total_uae_disable_posts = $this->Home_Model->get_total_uae_disable_posts();
        $total_uae_disable_posts = isset($total_uae_disable_posts[0]) ? $total_uae_disable_posts[0]->total_disable_posts : $total_uae_disable_posts;

        $total_usa_disable_posts = $this->Home_Model->get_total_usa_disable_posts();
        $total_usa_disable_posts = isset($total_usa_disable_posts[0]) ? $total_usa_disable_posts[0]->total_disable_posts : $total_usa_disable_posts;

        $data = [
			'income_usd' => $income_usd,
			'income_aed' => $income_aed,
			'total_orders'	=> $total_orders,
			'total_users'	=> $total_users,
			'total_posts'	=> $total_posts,
			'total_pak_posts'	=> $total_pak_posts,
			'total_uae_posts'	=> $total_uae_posts,
			'total_usa_posts'	=> $total_usa_posts,
			'total_active_posts'	=> $total_active_posts,
			'total_pak_active_posts'	=> $total_pak_active_posts,
			'total_uae_active_posts'	=> $total_uae_active_posts,
			'total_usa_active_posts'	=> $total_usa_active_posts,
			'total_disable_posts'	=> $total_disable_posts,
			'total_pak_disable_posts'	=> $total_pak_disable_posts,
			'total_uae_disable_posts'	=> $total_uae_disable_posts,
			'total_usa_disable_posts'	=> $total_usa_disable_posts,
		];

		$this->load->view('admin/index', $data);
	}

	public function todayStats(){

        $total_today_posts = $this->Home_Model->get_total_today_posts();

        $data = [
			'total_today_posts'     => $total_today_posts,
        ];

        $html = $this->load->view('admin/reports/todaystats',$data,true);
        $response['html'] = $html;
        $response['msg'] = 'Success';

        echo json_encode($response);
        exit;

    }

    public function weeklyStats(){

	    $total_weekly_posts = $this->Home_Model->get_total_weekly_posts();

        $data = [
            'total_weekly_posts'	=> $total_weekly_posts
        ];

        $html = $this->load->view('admin/reports/weeklystats',$data,true);
        $response['html'] = $html;
        $response['msg'] = 'Success';

        echo json_encode($response);
        exit;

    }

    public function monthlyStats(){

	    $total_monthly_posts = $this->Home_Model->get_total_monthly_posts();

        $data = [
            'total_monthly_posts'	=> $total_monthly_posts
        ];

        $html = $this->load->view('admin/reports/monthlystats',$data,true);
        $response['html'] = $html;
        $response['msg'] = 'Success';

        echo json_encode($response);
        exit;

    }
}
