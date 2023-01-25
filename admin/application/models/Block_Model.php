<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/15/2019
 * Time: 4:26 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Block_Model extends CI_Model{

	private $table_name = 'blocks';

	public function get_all()
	{

		$this->db->select('id,description,title');
		$this->db->from($this->table_name);

		$blocks = $this->db->get();

		return $blocks->result();

	}

	public function update($block_id, $title, $description, $code){

		$data = array(
			'title'	=> $title,
			'description'	=> $description,
			'code'	=> $code,
			'updated_at'	=> date("Y-m-d H:i:s")
		);

		$this->db->set($data);
		$this->db->where('id', $block_id);

		return $this->db->update(
			$this->table_name
		);

	}

	public function get_block($block_id)
	{
		$this->db->select('id,description,title,code');
		$this->db->from($this->table_name);
		$this->db->where('id', intval($block_id));

		$block = $this->db->get();

		return $block->result();
	}

}
