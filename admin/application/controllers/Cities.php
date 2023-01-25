<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/15/2019
 * Time: 4:16 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Cities extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if (!volgo_is_logged_in()) {
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->model('City_Model');
	}

	public function index()
	{
		$config = array();
		$config["base_url"] = base_url() . "cities";
		$config["total_rows"] = $this->City_Model->get_count();
		$config["per_page"] = 100;
		$config["uri_segment"] = 2;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

		if ($this->input->get('s')){
			$data['cities'] = $this->City_Model->get_city_from_db($this->input->get('s'));
		}else {
			$data["links"] = $this->pagination->create_links();
			$data['cities'] = $this->City_Model->get_cities($config['per_page'],  $page);
		}

		$this->load->view('admin/extras/cities/index', $data);
	}

	public function addnew()
	{
		$data = [
			'countries' => $this->db->select('*')->from('b2b_countries')->get()->result_object(),
			'states' => $this->db->select('*')->from('b2b_states')->get()->result_object()
		];


		if (! empty($this->input->post())){

			$input_data = filter_input_array(INPUT_POST);
			$this->form_validation->set_rules('country_id', 'Country ID', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('state_id', 'State ID', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('city_name', 'City Name', 'required|min_length[1]|max_length[255]');

			if ($this->form_validation->run() !== false) {

				$this->City_Model->create(
					$data = [
						'name' => $this->input->post('city_name'),
						'state_id' => intval($this->input->post('state_id'))
					]
				);

				$this->session->set_flashdata('success_msg', "City with title " . $this->input->post('city_name') . " has been added");
				redirect(base_url('cities'));

			}else {
				$data['validation_errors'] = validation_errors();
				$this->load->view('admin/extras/cities/add-city', $data);
			}
		}else {
			$this->load->view('admin/extras/cities/add-city', $data);
		}
	}

    public function edit_city($city_id = '')
    {
        if (empty($city_id) || ! intval($city_id))
            redirect('sorry');

        $input_data = filter_input_array(INPUT_POST);
        if (! empty($input_data)){

            $this->form_validation->set_rules('city_name', 'City Name', 'required');
            if ($this->form_validation->run() !== false){


                $city_name = $this->input->post('city_name');

                $is_updated = $this->City_Model->update_city($city_id, $city_name);

                if ($is_updated){
                    $this->session->set_flashdata('success_msg', 'City successfully updated.');
                    redirect('cities');
                }else {
                    $city_data = $this->City_Model->get_city_by_id($city_id);

                    $data = array(
                        'states' => $this->db->select('*')->from('b2b_states')->get()->result_object(),
                        'validation_errors' =>'<strong>Sorry!</strong><br />' . 'Unable to Edit City. Some error occurred.',
                        'city_data'=> $city_data
                    );

                    $this->load->view('admin/cities/edit-city', $data);
                }
            }else {
                $city_data = $this->City_Model->get_city_by_id($city_id);

                $data = array(
                    'states' => $this->db->select('*')->from('b2b_states')->get()->result_object(),
                    'validation_errors' => validation_errors(),
                    'success_msg'	=> '',
                    'city_data'=> $city_data
                );

                $this->load->view('admin/extras/cities/edit-city', $data);
            }

        }else {
            $city_data = $this->City_Model->get_city_by_id($city_id);

            $data = array(
                'states' => $this->db->select('*')->from('b2b_states')->get()->result_object(),
                'validation_errors' => '',
                'success_msg'	=> '',
                'city_data'=> $city_data
            );
            $this->load->view('admin/extras/cities/edit-city', $data);
        }
    }

	public function get_states()
	{
		if (! $this->input->post('country_id')){
			echo json_encode([]);
			exit;
		}

		$country_id = $this->input->post('country_id');

		$states = $this->db->select('*')->from('b2b_states')->where('country_id', intval($country_id))->get()->result_object();

		echo json_encode($states);
		exit;
	}


}
