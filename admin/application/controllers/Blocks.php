<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/15/2019
 * Time: 4:16 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Blocks extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if (!volgo_is_logged_in()) {
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Block_Model');
	}

	public function index()
	{
		$blocks = $this->Block_Model->get_all();
		$data = [
			'blocks'	=> $blocks
		];

		$this->load->view('admin/blocks/showall.php', $data);
	}

	public function edit($block_id)
	{
		$input_data = filter_input_array(INPUT_POST);
		$block = $this->Block_Model->get_block($block_id);

		if (! empty($input_data)){

			$this->form_validation->set_rules('block_title', 'Block Title', 'required|min_length[3]|max_length[255]');

			if ($this->form_validation->run() !== false) {

				$is_updated = $this->Block_Model
					->update(
						$block_id,
						$this->input->post('block_title'),
						$this->input->post('block_description'),
						$this->input->post('block_code')
					);

				if ($is_updated){

					$this->session->set_flashdata('success_msg', 'Block has been successfully updated.');

					redirect('blocks');

				}else {
					$data['validation_errors']	= '<strong>Sorry! </strong>Unable to update record.';
					$data['block']	= $block;

					$this->load->view('admin/blocks/editblock', $data);
				}
			}else {
				$data['validation_errors']	= validation_errors();
				$data['block']	= $block;

				$this->load->view('admin/blocks/editblock', $data);
			}
		}else {

			$data = [
				'block' => $block
			];

			$this->load->view('admin/blocks/editblock', $data);
		}
	}
}
