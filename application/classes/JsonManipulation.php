<?php


namespace application\classes;

/**
 * Class JsonManipulation
 * @package application\classes
 */
class JsonManipulation
{
	/**
	 * @var \CI_Controller|null
	 */
	private $CI = null;
	/**
	 * JsonManipulation constructor.
	 */
	public function __construct()
	{
		$this->CI = volgo_get_ci_object();
		$this->CI->load->model('Json_Categories_Model');
	}

	/**
	 * @param string $db_key - This is the database column key.
	 * @param string | null $specific_data - As we may have multi dimensional json array. So, if we need to get specific part of json then we need to tell the key of that array.
	 * @return array - Empty array or filled array that contains the data
	 */
	public function get_json_data($db_key, $cols = '*')
	{
		return $this->CI->Json_Categories_Model->get_json_data($db_key, $cols);
	}

	/**
	 * @param string $type - Specify the type that you want to get! For example 1) Category 2) buying-lead 3) seller-lead
	 * System will truncate the data and return only data that has specific key.
	 *
	 * @return array
	 */
	public function get_categories($sort = true)
	{
		$cats = $this->get_json_data('categories');

		if (empty($cats)){
			return [];
		}

		$cats = isset($cats->data) ? $cats->data : [];
		if (empty($cats)){
			return [];
		}
		// add parent_name on run time.
		$this->add_parent_names_in_cats($cats);

		// Add counter
		//$this->add_counter_in_cats($cats);

		if ($sort){
			// Sorting
			$cats = (array)$cats;
			return array_values( (array) $this->sort_categories($cats)); // sorting, converting into array then refreshing the index and returning the array
		}
		
		return array_values( (array) $cats); // converting into array then refreshing the index and returning the array

	}

	public function get_single_record($id, $field = null, $type = 'categories')
	{
		switch ($type){
			case 'categories':
				$items_arr = $this->get_categories();
				break;
			case 'models':
				$items_arr = $this->get_models();
				break;
			case 'makes':
				$items_arr = $this->get_makes();
				break;
			case 'count':
				$items_arr = $this->get_counts();
				break;
			default:
				$items_arr = [];
		}

		$requested_item = [];
		foreach ($items_arr as $item) {
			if (intval($item->id) === intval($id)){
				$requested_item = $item;
				break;
			}
		}

		if ($field)
			return $requested_item->slug;

		return $requested_item;
	}

	public function get_counts($db_key = 'country_id_1_count')
	{
		$counts = $this->get_json_data($db_key);

		if (! isset($counts->data) || empty($counts->data)){
			return [];
		}

		return (array)$counts->data;
	}

	public function get_auto_incremental_id($db_key, array $records = [])
	{
		if (empty($records)){
			$starting = 1;
		}else {
			$starting = ($records[count($records) -1]->id) + 1;
		}

		return $this->CI->Json_Categories_Model->get_incremental_number($db_key, $starting);

	}

	/**
	 * Get the makes array
	 *
	 * @return array
	 */

	public function get_makes()
    {
        
		$makes = $this->get_json_data('makes');

		$categories = $this->get_categories();

		if (! isset($makes->data) || empty($makes->data)){
			return [];
		}
        usort($makes->data, function($a, $b)
        {
            return strcmp($a->name, $b->name);
        });
		foreach ($makes->data as $make){

			foreach ($categories as $category){
				if (intval($make->sub_category_id) == intval($category->id)){
					$make->sub_category_name = $category->name;
					$make->parent_name = $category->parent_name;
				}
			}
		}

		return array_values((array)$makes->data); // converting into array then refreshing the index and returning the array
	}

	public function update_array_items(array $values, $db_column = 'categories')
	{
		return $this->CI->Json_Categories_Model->add_json_data($db_column, $values);
	}

	/**
	 * Get the Model Array
	 *
	 * @return array
	 */
	public function get_models()
	{
		$models = $this->get_json_data('models');
		$makes = $this->get_makes();

		if (! isset($models->data) || empty($models->data)){
			return [];
		}

        usort($models->data, function($a, $b)
        {
            return strcmp($a->name, $b->name);
        });

		foreach ($models->data as $model){
			foreach ($makes as $make){
				if (intval($model->make_id) === intval($make->id)){
					$model->parent_name = $make->name;
				}
			}
		}

		return array_values((array) $models->data); // converting into array then refreshing the index and returning the array
	}

	/**
	 * @param array $cat_data
	 * @return mixed
	 */
	public function add_category(array $cat_data)
	{
		$db_data = $this->get_categories(null);

		$db_data = is_object($db_data) ? (array)$db_data : $db_data;
		array_push($db_data, $cat_data);

		return $this->CI->Json_Categories_Model->add_json_data('categories', $db_data);
	}

	public function add_count(array $count_data, $db_key, bool $get_db_data = true)
	{
		if ($get_db_data){
			$db_data = $this->get_counts($db_key);

			$db_data = is_object($db_data) ? (array)$db_data : $db_data;
			array_push($db_data, $count_data);
		}else {
			$db_data = $count_data;
		}

		return $this->CI->Json_Categories_Model->add_json_data($db_key, $db_data);
	}

	public function add_make(array $make_data)
	{
		$db_make_data = $this->get_makes();
		$db_make_data = is_object($db_make_data) ? (array) $db_make_data : $db_make_data;
		array_push($db_make_data, $make_data);
		return $this->CI->Json_Categories_Model->add_json_data('makes', $db_make_data);
	}

	public function add_model(array $models_data)
	{
		$db_models_data = $this->get_models();
		$db_models_data = is_object($db_models_data) ? (array) $db_models_data : $db_models_data;
		array_push($db_models_data, $models_data);
		return $this->CI->Json_Categories_Model->add_json_data('models', $db_models_data);
	}

	public function add_update_dynamic_forms($data)
	{
		$dynamic_db_forms = $this->get_dynamic_form();
		$dynamic_db_forms = is_object($dynamic_db_forms) ? (array) $dynamic_db_forms : $dynamic_db_forms;

		$need_to_update = false;
		$index_val = null;
		foreach ($dynamic_db_forms as $index => $form){
			if (intval($form->parent_cat_id) === intval($data['parent_cat_id']) && intval($form->child_cat_id) === intval($data['child_cat_id'])){
				$need_to_update = true;
				$index_val = $index;
			}
		}

		if ($need_to_update && $index_val !== null){
			unset($dynamic_db_forms[$index_val]);
			array_push($dynamic_db_forms, $data);
		}else {
			array_push($dynamic_db_forms, $data);
		}

		$dynamic_db_forms = array_values($dynamic_db_forms);

		return $this->CI->Json_Categories_Model->add_update_json_data('dynamic_form', $dynamic_db_forms);
	}

	public function get_sub_cats_by_parent_id($parent_id, $is_buying_or_seller_lead = false)
	{
		$categories = $this->get_categories(null);
		$sub_cats = [];

		foreach ($categories as $category){
			if (intval($category->parent_ids) === intval($parent_id)){
				$sub_cats[] = $category;
			}
		}

		// if this is seller or buying lead
		/*if ($is_buying_or_seller_lead){
			$buying_lead_cats = [];
			foreach ($sub_cats as $cat){
				foreach ($categories as $category){
					if ($cat->id == $category->parent_ids){
						$buying_lead_cats[] = $category;
					}
				}
			}

			$sub_cats = $buying_lead_cats;
		}*/
		return $sub_cats;
	}

	public function get_buying_lead_seller_lead_cat_id_from_cat_slug($slug, $type = 'seller_lead')
	{
		$categories = $this->get_categories(null);
		$cat_id = 0;
		foreach ($categories as $category){
			if (strtolower($category->slug) === strtolower($slug) && $category->category_type === $type){
				if ($category->parent_ids === 'uncategorised')
					$cat_id = $category->id;
				else
					$cat_id = $category->parent_ids;
				break;
			}
		}

		return $cat_id;
	}

	public function get_parent_cat_id_from_cat_slug($slug, $type = 'category')
	{
		$categories = $this->get_categories(null);
		$cat_id = 0;
		foreach ($categories as $category){
			if (strtolower($category->slug) === strtolower($slug) && strtolower($category->category_type) === strtolower($type)){
				if ($category->parent_ids === 'uncategorised')
					$cat_id = $category->id;
				else
					$cat_id = $category->parent_ids;

				break;
			}
		}

		if (strtolower($type) === 'buying_lead' || strtolower($type) === 'seller_lead'){

			foreach ($categories as $category){
				if ($category->id === $cat_id){
					if ($category->parent_ids === 'uncategorised' && (strtolower($category->category_type) === 'buying_lead' || strtolower($category->category_type) === 'seller_lead') || strtolower($category->category_type) === ' ')
						$cat_id = $category->id;
					else
						$cat_id = $category->parent_ids;

					break;
				}
			}
		}
		return $cat_id;
	}

	public function get_parent_cat_name_from_cat_id($id)
	{
		$categories = $this->get_categories(null);
		$parent_name = '';
		foreach ($categories as $category){
			if (intval($category->id) === intval($id)){
				$parent_name = $category->parent_name;
				break;
			}
		}

		return $parent_name;
	}


	public function get_category_id_from_cat_slug($slug, $type = 'category', $is_lead_page = false)
	{
		$categories = $this->get_categories(null);
		$cat_id = 0;
		foreach ($categories as $category){
			if (strtolower($category->slug) === strtolower($slug) && strtolower($category->category_type) === strtolower($type)){
				if (strtolower($type) === 'buying_lead' || strtolower($type) === 'seller_lead'){
					if ($category->parent_ids === 'uncategorised')
						$cat_id = $category->id;
					else
						$cat_id = $category->parent_ids;
				}else {
					$cat_id = $category->id;

				}

				break;
			}
		}

		if ($is_lead_page){
			foreach ($categories as $category) {
				if ($category->id == $cat_id){
					$cat_id = $category->parent_ids;
					break;
				}
			}
		}

		return $cat_id;
	}
    
    public function get_category_type_from_cat_slug($slug)
	{
		$categories = $this->get_categories(null);
		$category_type = '';
		foreach ($categories as $category){
			if (strtolower($category->slug) === strtolower($slug) && $category->category_type === 'category'){
					$category_type = $category->category_type;
			break;		
			}
			
		}
		return $category_type;
	}
    
	/**
	 * Get the Model Array
	 *
	 * @return array
	 */
	public function get_dynamic_form()
	{
		$forms = $this->get_json_data('dynamic_form');

		return $forms; // converting into array then refreshing the index and returning the array
	}

	/**
	 * This functions takes slug and check with the available categories. If slug is available then add number in the end of the slug.
	 * And returns the slug
	 *
	 * @param $slug string
	 * @return string
	 */
	public function check_slug($slug)
	{
		$row = $this->get_json_data('categories');
		$data = isset($row->data) ? $row->data : [];

		$cat_str = '';
		foreach ((array)$data as $item) {
			$cat_str .= $item->slug . ' ';
		}
		$pattern = '/' . $slug . '/i';
		preg_match_all($pattern, $cat_str, $matches);

		if (isset($matches[0]) && !empty($matches[0])) {
			$s = $slug;
			$s = explode('-', $s);

			if (count($s) > 2)
				unset($s[sizeof($s) - 1]);

			$s = implode(' ', $s);
			$s = volgo_make_slug($s);
			$s .= '-' . (count($matches[0]) + 1);

			$slug = $s;
			return $slug;
		}

		return $slug;
	}

	public function recreate_array($json_arr, $db_key)
	{
		return $this->CI->Json_Categories_Model->recreate_json_arr($db_key, $json_arr);
	}


	/* ------------------------------------------------------------------------------------------------------------ */
	// 		PRIVATE FUNCTIONS	//
	/* ------------------------------------------------------------------------------------------------------------ */

	/**
	 * @param $cats
	 * @param string $type
	 */
	private function get_only_specific_categories(&$cats, $type = 'category')
	{
		foreach ($cats as $i => $cat) {
			if (strtolower($cat->category_type) !== strtolower($type))
				if (is_object($cats))
					unset($cats->$i);
				else
					unset($cats[$i]);
		}
	}

	/**
	 * @param $cats
	 */
	private function add_parent_names_in_cats(&$cats){
		foreach ((array)$cats as $index => $cat) {
			if ($cat->parent_ids === 'uncategorised') {
				$cat->parent_name = '';

				continue;
			}
			$id = intval($cat->parent_ids) ;

			foreach ($cats as $i => $c){
				if (intval($c->id) === $id){
					$cat->parent_name = $c->name;
					break;
				}
			}
		}
	}

	private function add_counter_in_cats(&$cats)
	{
		$country_id = volgo_get_country_id_from_session();
		foreach ($cats as $cat){
			if ($cat->parent_ids === 'uncategorised')
				continue;

			/*
			 * @can
			 * 	country_id_166_cat_id_6__total_count
			 * */
			$db_key = $cache_key = 'country_id_'.$country_id.'_cat_id_'.intval($cat->id).'__total_count';

			// try to get from cache and if cache is not created then first we will look into categories meta table.
			if (! $count = $this->CI->cache->get($cache_key)){
				// Query
				$count_meta = $this->CI->db->select('meta_value')
					->from('categories_meta')
					->where('categories_id', intval($cat->id))
					->where('meta_key', $db_key)
					->limit(1)
					->get()->row();

				if (empty($count_meta)){
					// try to count the records, save into database (categories meta) and create cache after this if block -- Just here for backward compatibility

					//1) Count Records
					$this->CI->db->select('count(l.id) as count');
					$this->CI->db->from('listings l');
					$this->CI->db->where('l.sub_category_id', intval($cat->id));
					$this->CI->db->where('country_id', $country_id);
					$this->CI->db->where('status', 'enabled');
					$this->CI->db->join('listings_meta lm', 'lm.listings_id = l.id AND meta_key = "listing_type" and (meta_value="featured" OR meta_value="recommended")', 'right');

					$query = $this->CI->db->get();
					$count = $query->row();
					$count = $count->count;

					//2) save into categories meta for next usage. // insert

					$db_key = 'country_id_' . $country_id . '_cat_id_' . intval($cat->id) . '__total_count';

					$data = [
						'categories_id' => intval($cat->id),
						'meta_key'	=> $db_key,
						'meta_value'	=> $count,
						'created_at' => date("Y-m-d H:i:s"),
					];
					$this->CI->db->set($data);

					$this->CI->db->insert(
						'categories_meta'
					);
				}else {
					$count = $count_meta->meta_value;
				}


				// Save Data
				$this->CI->cache->save($cache_key, $count, MAX_CACHE_TTL_VALUE);
			}

			$cat->count = $count;
		}
	}

	/**
	 * @param array $cats
	 * @return array
	 */
	private function sort_categories(array $cats)
	{
		$final_array = [];
		$operations_name = [];
		foreach ($cats as $index => $cat){
			$name = $cat->name;

			if (in_array($name, $operations_name))
				continue;

			$operations_name[] = $name;


			$found = false;
			foreach ($final_array as $ii => $cc){
				if ($cc->name === $name){
					$found = true;
				}
			}

			if (! $found){
				$final_array[] = $cat;
			}

			foreach ($cats as $i => $c){
				if ($index === $i)
					continue;

				if (isset($c->parent_name) && $c->parent_name === $name){
					array_push($final_array, $c);
				}
			}
		}

		return $final_array;
	}
	
	public function check_parent_cat_from_cat_slug($slug)
    {
        $categories = $this->get_categories(null);
        $is_cat_page = false;
        foreach ($categories as $category){
            if ($category->category_type === 'category' && strtolower($category->slug) === strtolower($slug)){
                if ($category->parent_ids === 'uncategorised')
                 $is_cat_page = true;
                 break;
                }
        }
        return $is_cat_page;
    }
    
    public function get_make_id_from_make_name($make_name,$cat = null)
    {
        $all_makes = $this->get_makes(null);
        $make_id = '';

        foreach ($all_makes as $makes) {

            if(!empty($cat)){
                if(strtolower(trim($makes->name)) === strtolower(trim($make_name)) && $makes->sub_category_id == $cat){
                    $make_id = $makes->id;
                    break;
                }
            }else{
                if(strtolower(trim($makes->name)) === strtolower(trim($make_name))){
                    $make_id = $makes->id;
                    break;
                }
            }

        }
        
        return $make_id;
    }

    public function get_make_id_from_make_name_by_category($make_name,$cat_id = null)
    {
        $all_makes = $this->get_makes(null);
        $make_id = '';
        foreach ($all_makes as $makes) {
            if(strtolower(trim($makes->name)) === strtolower(trim($make_name)) && $cat_id === $makes->sub_category_id){
                $make_id = $makes->id;
                break;
            }
        }

        return $make_id;
    }
    
    public function get_model_id_from_model_name($model_name,$cat=null)
    {
        $all_models = $this->get_models(null);
        $model_id = '';
        foreach ($all_models as $models) {

            if(!empty($cat)){
                if(strtolower(trim(str_replace([':', '\\', '/', '*', '/g'], '',$models->name))) === strtolower(trim($model_name)) && $models->sub_category_id == $cat){
                    $model_id = $models->id;
                    break;
                }
            }else{
                if(strtolower(trim(str_replace([':', '\\', '/', '*', '/g'], '',$models->name))) === strtolower(trim($model_name)) ){
                    $model_id = $models->id;
                    break;
                }
            }

        }
        return $model_id;
    }
    public function get_model_id_from_model_name_by_make_id($model_name,$make_id)
    {
        $all_models = $this->get_models(null);
        $model_id = '';
        foreach ($all_models as $models) {
        if(strtolower(trim(str_replace([':', '\\', '/', '*', '/g'], '',$models->name))) === strtolower(trim($model_name)) && $models->make_id == $make_id){
        $model_id = $models->id;
        break;
        }
        }
        return $model_id;
    }
    
    public function get_category_name_from_cat_id($id)
    {
       $categories = $this->get_categories(null);
       $category_name = '';
       foreach ($categories as $category){
               if (intval($category->id) === intval($id)){
                 $category_name = $category->name;
               break;
               }
       }
       return $category_name;
   }
    
    public function get_make_id_from_make_slug($make_slug)
	{
		$all_makes = $this->get_makes(null);
		if($make_slug === "mini"){
		  $make_slug = "mini-2";  
		}
		$make_id = '';
		foreach ($all_makes as $makes) {
            if(strtolower(trim($makes->slug)) === strtolower(trim($make_slug))){	
             $make_id = $makes->id;   
            break;
            }
        }

		return $make_id;
	}

    public function get_make_id_from_make_slug_by_id($make_slug,$cat_id)
    {
      if($cat_id==5){
          $cat_id=6;
      }

        $all_makes = $this->get_makes(null);


        if($make_slug == "mini"){
            $make_slug = "mini-2";
        }
        $make_id = '';

        foreach ($all_makes as $makes) {
            //echo strtolower(trim($makes->slug)).'>>>>>'.strtolower(trim($make_slug)).'>>>>>>>>'.$makes->sub_category_id.'>>>>'.$cat_id.'<br>';
            if(strtolower(trim($makes->slug)) == strtolower(trim($make_slug)) && $makes->sub_category_id == $cat_id){
                $make_id = $makes->id;
                break;
            }
        }
        //exit();
        return $make_id;
    }

	public function get_model_id_from_model_slug($model_slug)
	{
		$all_models = $this->get_models(null);
		$model_id = '';
		foreach ($all_models as $models) {
            if(strtolower(trim($models->slug)) === strtolower(trim($model_slug))){	
             $model_id = $models->id;
            break;
            }
        }
		return $model_id;
	}


	public function get_buying_or_seller_cat_id_from_cat_slug($slug)
	{
		$categories = $this->get_categories(null);
		$category_id = '';
		foreach ($categories as $category){
			if (strtolower($category->slug) === strtolower($slug) && (strtolower($category->category_type) === 'buying_lead' || strtolower($category->category_type) === 'seller_lead')){
					$category_id = $category->id;
			break;		
			}
			
		}
		return $category_id;
	}

	public function get_buying_leads()
	{
		
		$buying_leads = [];
		$categories = $this->get_categories(null);
		$buying_leads_parents = $this->get_cat_parent_cats(130);
		foreach ($buying_leads_parents as $buying_leads_parent){
			$buying_leads[] = [
					'parent_data'	=> $this->get_single_record($buying_leads_parent->id, null, 'categories'),
					'child_data'	=> $this->get_cat_child_cats($buying_leads_parent->id)
				];
		}
		return $buying_leads;
	}

	public function get_seller_leads()
	{
		
		$seller_leads = [];
		$categories = $this->get_categories(null);
		$seller_leads_parents  = $this->get_cat_parent_cats(131);

		foreach ($seller_leads_parents as $seller_leads_parent){
			$seller_leads[] = [
					'parent_data'	=> $this->get_single_record($seller_leads_parent->id, null, 'categories'),
					'child_data'	=> $this->get_cat_child_cats($seller_leads_parent->id)
				];
		}

		return $seller_leads;
	}
	
	public function get_cat_parent_cats($parent_id)
	{
		$categories = $this->get_categories(null);
		$parent_cat_id = $this->get_buying_or_seller_cat_id_from_cat_slug('seller-lead');
		$seller_lead = [];
		foreach ($categories as $category){
			if (intval($category->parent_ids) === intval($parent_id) && (strtolower($category->category_type) === 'category' || strtolower($category->category_type) === 'buying_lead' || strtolower($category->category_type) === 'seller_lead')){
					$seller_lead[] = $category;
			}
			
		}
		return $seller_lead;
	}

	public function get_cat_child_cats($parent_id)
	{
		$categories = $this->get_categories(null);

		$cat_child_cats = [];
		foreach ($categories as $category){
			if (intval($category->parent_ids) === intval($parent_id) && (strtolower($category->category_type) === 'category' || strtolower($category->category_type) === 'buying_lead' || strtolower($category->category_type) === 'seller_lead')){
					$cat_child_cats[] = $category;
			}
			
		}
		return $cat_child_cats;
	}

	public function is_lead_parent_cat($slug)
	{
		$categories = $this->get_categories(null);

		$is_lead_parent_cat = false;
		foreach ($categories as $category){
			if ($category->slug === $slug && (intval($category->parent_ids) == 130 || intval($category->parent_ids) == 131)){
					$is_lead_parent_cat = true;
					break;
			}
			
		}
		return $is_lead_parent_cat;
	}

	

}

/**
 * End of JsonManipulation class
 */
