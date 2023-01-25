<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/25/2019
 * Time: 4:19 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

use OSS\OssClient;
use OSS\Core\OssException;

class Tradeshow extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		if (! volgo_is_logged_in()){
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('TradeShow_Model');
	}


	public function index()
	{
		$data = [
			'tradeshows' => $this->TradeShow_Model->get_latest()
		];

		$this->load
			->view('admin/tradeshows/index', $data);

	}

	public function add_new()
	{
		$input_data = filter_input_array(INPUT_POST);
		$this->load->library('upload');

		if (! empty($input_data)){

			$this->form_validation->set_rules('ts_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('ts_content', 'Content', 'required');
			$this->form_validation->set_rules('started_date', 'Starting Date', 'required');
			$this->form_validation->set_rules('ended_date', 'End Date', 'required');


			if (! empty($_FILES['featured_image']['name'])){
                $config = array();
                $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/b2bclassified/admin/uploads/tradeshows/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite']     = false;
                $this->upload->initialize($config);
                $this->upload->do_upload('featured_image');

				if ( ! $this->upload->do_upload('featured_image'))
				{
					$data = array(
						'validation_errors' =>'<strong>Sorry!</strong><br />' . 'Unable to upload featured image.<br />Possible Reasons:<br />' . $this->upload->display_errors()
					);
					$unable_to_upload = true;

					$this->load->view('admin/tradeshows/add', $data);
				}
				else
				{
					$upload_img_data = $this->upload->data();
                    $this->upload_to_bucket($upload_img_data['full_path'] , 'tradeshows/'. $upload_img_data['file_name']);
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/admin/uploads/tradeshows/' . $upload_img_data['file_name']);
				}
			}

			if (isset($unable_to_upload))
				return;

			if ($this->form_validation->run() !== false){

				$posted_data = $this->input->post();
				if (isset($upload_img_data, $upload_img_data['file_name'])){
					$posted_data['featured_image']	= $upload_img_data['file_name'];
				}

				$is_inserted = $this->TradeShow_Model
					->add(
						$posted_data
					);

				if ($is_inserted){
					$this->session->set_flashdata('success_msg', 'TradeShow created successfully.');

					redirect('tradeshow');

				}else {
					$data['validation_errors']	= '<strong>Sorry</strong> Unable to insert the data. Kindly retry.';
					$this->load->view('admin/tradeshows/add', $data);
				}
			} else {
				$data['validation_errors']	= validation_errors();
				$this->load->view('admin/tradeshows/add', $data);
			}
		}else {
			$this->load->view('admin/tradeshows/add');
		}
	}

	public function edit($tradeshow_id)
	{
		$input_data = filter_input_array(INPUT_POST);
        $this->load->library('upload');

		$tradeshow = $this->TradeShow_Model->get(intval($tradeshow_id));
		$tradeshow = isset($tradeshow[0]) ? $tradeshow[0] : $tradeshow;

		$starting_date = $this->TradeShow_Model->get_post_meta(intval($tradeshow_id), 'starting_date');
		$starting_date = isset($starting_date[0]) ? $starting_date[0] : $starting_date;

		$ending_date = $this->TradeShow_Model->get_post_meta(intval($tradeshow_id), 'ending_date');
		$ending_date = isset($ending_date[0]) ? $ending_date[0] : $ending_date;

		$venue = $this->TradeShow_Model->get_post_meta(intval($tradeshow_id), 'ts_venue');
		$venue = isset($venue[0]) ? $venue[0] : $venue;

		if (! empty($input_data)){

			$this->form_validation->set_rules('ts_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('ts_content', 'Content', 'required');
			$this->form_validation->set_rules('started_date', 'Starting Date', 'required');
			$this->form_validation->set_rules('ended_date', 'End Date', 'required');


			if (! empty($_FILES['featured_image']['name'])){
                $config = array();
                $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/b2bclassified/admin/uploads/tradeshows/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite']     = false;
                $this->upload->initialize($config);
                $this->upload->do_upload('featured_image');

				if ( ! $this->upload->do_upload('featured_image'))
				{
					$data = array(
						'validation_errors' =>'<strong>Sorry!</strong><br />' . 'Unable to upload featured image.<br />Possible Reasons:<br />' . $this->upload->display_errors(),
						'tradeshow'	=> $tradeshow,
						'starting_date'	=> $starting_date,
						'ending_date'	=> $ending_date,
						'venue' => $venue
					);
					$unable_to_upload = true;

					$this->load->view('admin/tradeshows/edit/', $data);
				}
				else
				{
					$upload_img_data = $this->upload->data();
                    $this->upload_to_bucket($upload_img_data['full_path'] , 'tradeshows/'. $upload_img_data['file_name']);
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/b2bclassified/admin/uploads/tradeshows/' . $upload_img_data['file_name']);
				}
			}

			if (isset($unable_to_upload))
				return;

			if ($this->form_validation->run() !== false){

				$posted_data = $this->input->post();
				if (isset($upload_img_data, $upload_img_data['file_name'])){
					$posted_data['featured_image']	= $upload_img_data['file_name'];
				}

				$is_updated = $this->TradeShow_Model
					->update(
						$tradeshow_id,
						$posted_data
					);

				if ($is_updated){
					$this->session->set_flashdata('success_msg', 'Record successfully updated.');

					redirect('tradeshow');

				}else {
					$data['validation_errors']	= '<strong>Sorry</strong> Unable to update the data. Kindly retry.';
					$data['tradeshow']	= $tradeshow;
					$data['starting_date']	= $starting_date;
					$data['ending_date']	= $ending_date;
					$data['venue']	= $venue;


					$this->load->view('admin/tradeshows/edit', $data);
				}
			} else {
				$data['validation_errors']	= validation_errors();
				$data['tradeshow']	= $tradeshow;
				$data['starting_date']	= $starting_date;
				$data['ending_date']	= $ending_date;
				$data['venue']	= $venue;

				$this->load->view('admin/tradeshows/edit', $data);
			}
		}else {
			$data['starting_date']	= $starting_date;
			$data['ending_date']	= $ending_date;
			$data['venue']	= $venue;
			$data['tradeshow']	= $tradeshow;
			$this->load->view('admin/tradeshows/edit',$data);
		}
	}



	public function remove($ts_id = '')
	{
		if (empty($ts_id) || ! intval($ts_id))
			redirect('sorry');

		if ($this->TradeShow_Model->remove($ts_id)){
			$this->session->set_flashdata('removed','success');
			redirect('tradeshow');
		}else {
			redirect('tradeshow');
		}
	}

	private function delete_and_create_cache(){
		$this->load->helper('file');
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		
		if(file_exists((VOLGO_FRONTEND_CACHE_PATH . '/get_letest_trade_shows'))){
		unlink((VOLGO_FRONTEND_CACHE_PATH . '/get_letest_trade_shows'));	
		}
		
		$cache_key = 'get_letest_trade_shows';
		$this->db->select('p_te.id ,p_te.title, p_te.content, p_te.featured_image, p_te.slug');
		$this->db->select('pm_te.meta_value ,pm_te.meta_key');
		$this->db->from('posts as p_te');
		$this->db->join('posts_meta as pm_te', 'pm_te.post_id = p_te.id', 'left');
		$this->db->where('type', 'tradeshow');
		$this->db->order_by("id", "desc");

		$result = $this->db->get();
		$letest_trade_show = $result->result();

		//$this->db->cache_off();
		// Save Data
		if (IS_CACHE_ON === true)
		$this->cache->save($cache_key, $letest_trade_show, MAX_CACHE_TTL_VALUE); // save for 72 hours
	}

    private function upload_to_bucket($source, $destination){
        $accessKeyId = "LTAI4Fk9Aprhpyv3CQr1VEZY";
        $accessKeySecret = "chSkxoFoS2wKVdDYfpqjY64PU4fKvJ";
        // This example uses endpoint China (Hangzhou). Specify the actual endpoint based on your requirements.
        $endpoint = "http://oss-me-east-1.aliyuncs.com";
        // Bucket name
        $bucket= "volgopoint";
        // Object name

        try {
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
            $response = $ossClient->putObject($bucket, $destination, file_get_contents($source));
            return $response;
        } catch (OssException $e) {
            print $e->getMessage();
        }
    }

}
