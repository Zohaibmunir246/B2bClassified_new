<?php
	/**
	 * Created by PhpStorm.
	 * User: Ali Shan
	 * Date: 27-Apr-19
	 * Time: 5:22 PM
	 */
	
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class General extends CI_Controller
	{
		
		function __construct ()
		{
			parent::__construct();
		}
		
		
		public function index ()
		{
			
			/**
			
			 This function is used to add categories_meta after counting the total listings in the specific country with status enabled and for specific category id.
			 
			 */
			
			$sub_cat_ids_list = [
/*				6,
				7,
				8,
				9,*/
				/*11,
				12,
				13,
				14,
				15,
				16,
				18,
				19,
				20,*/
				/*21,
				22,
				23,
				24,
				25,
				26,
				27,
				29,
				30,
				31,
				32,
				33,
				34,
				35,
				36,
				37,
				38,
				39,
				40,
				41,*/
				/*42,
				43,
				44,
				45,
				46,
				47,
				48,
				49,
				51,
				52,
				53,
				54,
				55,
				56,
				57,
				58,
				59,
				60,
				61,
				62,
				63,
				64,
				65,
				66,
				67,*/
				/*68,
				69,
				70,
				71,
				72,
				73,
				74,
				75,
				76,
				77,
				78,
				79,
				80,
				81,
				82,
				83,
				84,
				85,
				86,
				87,
				88,
				89,
				90,
				91,
				92,*/
				/*93,
				94,
				95,
				96,
				97,
				98,
				99,
				100,
				101,
				102,
				103,
				104,
				105,
				106,
				107,
				109,
				111,
				112,
				113,
				114,
				115,
				116,
				117,
				118,
				119,*/
				/*120,
				121,
				122,
				123,
				124,
				125,
				126,
				127,
				128,
				129,
				347,
				348,
				349,
				351,
				352,*/
			];
			
			if (empty($sub_cat_ids_list))
				exit('already done');
			
			
			exit('already done');
			
			$counter = 1;
			$max_counter = 25;
			foreach ($sub_cat_ids_list as $sub_cat_id){
				
				if ($counter > $max_counter){
					exit('all done');
				}
				
				for ($country_id = 1; $country_id <= 246; $country_id++) {
					$query = "SELECT count(l.id) as count
						FROM `listings` `l`
						  JOIN `listings_meta` `lm` ON `lm`.`listings_id` = `l`.`id` AND `meta_key` = 'listing_type' and (`meta_value`='featured' OR `meta_value`='recommended')
						WHERE `l`.`sub_category_id` = {$sub_cat_id}
							  AND `country_id` = '{$country_id}'
      					AND `status` = 'enabled'";
					
					$result = $this->db->query($query)->result();
					
					$count = $result[0]->count;

					$db_key = 'country_id_' . $country_id . '_cat_id_' . intval($sub_cat_id) . '__total_count';

					// insert
					$data = [
						'categories_id' => $sub_cat_id,
						'meta_key'	=> $db_key,
						'meta_value'	=> $count,
						'created_at' => date("Y-m-d H:i:s"),
					];
					$this->db->set($data);
					
					$is_inserted = $this->db->insert(
						'categories_meta'
					);
					
					echo 'Country ID: ' . $country_id . ' is done <br />';
					echo 'Sub Cat ID: ' . $sub_cat_id . ' is ongoing <br />';
					
					
				}
				$counter ++;
				
				echo $sub_cat_id . ' is done <br />';
				echo '<hr />';
			}
			
		}
		
		
	}
