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
		$this->CI->load->model('Categories_Model');
	}

	/**
	 * @param string $db_key - This is the database column key.
	 * @param string | null $specific_data - As we may have multi dimensional json array. So, if we need to get specific part of json then we need to tell the key of that array.
	 * @return array - Empty array or filled array that contains the data
	 */
	public function get_json_data($db_key, $cols = '*')
	{
		return $this->CI->Categories_Model->get_json_data($db_key, $cols);
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

	public function get_counts($db_key = 'cat_id_1_count')
	{
		$counts = $this->get_json_data($db_key);

		if (! isset($counts->data) || empty($counts->data)){
			return [];
		}

		return array_values((array)$counts->data);
	}

	public function get_auto_incremental_id($db_key, array $records = [])
	{
		if (empty($records)){
			$starting = 1;
		}else {
			$starting = ($records[count($records) -1]->id) + 1;
		}

		return $this->CI->Categories_Model->get_incremental_number($db_key, $starting);
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

		foreach ($makes->data as $make){
			foreach ($categories as $category){
				if (intval($make->sub_category_id) === intval($category->id)){
					$make->sub_category_name = $category->name;
					$make->parent_name = $category->parent_name;
				}
			}
		}

		return array_values((array)$makes->data); // converting into array then refreshing the index and returning the array
	}

	public function update_array_items(array $values, $db_column = 'categories')
	{
		return $this->CI->Categories_Model->add_json_data($db_column, $values);
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

		return $this->CI->Categories_Model->add_json_data('categories', $db_data);
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

		return $this->CI->Categories_Model->add_json_data($db_key, $db_data);
	}

	public function add_make(array $make_data)
	{
		$db_make_data = $this->get_makes();
		$db_make_data = is_object($db_make_data) ? (array) $db_make_data : $db_make_data;
		array_push($db_make_data, $make_data);
		return $this->CI->Categories_Model->add_json_data('makes', $db_make_data);
	}

	public function add_model(array $models_data)
	{
		$db_models_data = $this->get_models();
		$db_models_data = is_object($db_models_data) ? (array) $db_models_data : $db_models_data;
		array_push($db_models_data, $models_data);
		return $this->CI->Categories_Model->add_json_data('models', $db_models_data);
	}

	public function add_update_dynamic_forms($data)
	{
		$dynamic_db_forms = $this->get_dynamic_form();
		$dynamic_db_forms = is_object($dynamic_db_forms) ? (array) $dynamic_db_forms : $dynamic_db_forms;

		$need_to_update = false;
		$index_val = null;

        $udated_dynamic_form = $dynamic_db_forms['data'];
        foreach ($udated_dynamic_form as $index => $form){
            if (intval($form->parent_cat_id) === intval($data['parent_cat_id']) && intval($form->child_cat_id) === intval($data['child_cat_id'])){
                $need_to_update = true;
                $index_val = $index;

            }
        }

		if ($need_to_update && $index_val !== null){
			unset($udated_dynamic_form[$index_val]);
			array_push($udated_dynamic_form, $data);
		}else {
			array_push($udated_dynamic_form, $data);
		}

		$udated_dynamic_form = array_values($udated_dynamic_form);

		return $this->CI->Categories_Model->add_update_json_data('dynamic_form', $udated_dynamic_form);
	}

	public function get_sub_cats_by_parent_id($parent_id)
	{
		$categories = $this->get_categories(null);
		$sub_cats = [];

		foreach ($categories as $category){
			if (intval($category->parent_ids) === intval($parent_id)){
				$sub_cats[] = $category;
			}
		}

		return $sub_cats;
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
					if ($category->parent_ids === 'uncategorised')
						$cat_id = $category->id;
					else
						$cat_id = $category->parent_ids;
						echo $cat_id;die;
					break;
				}
			}
		}

		return $cat_id;
	}

	public function get_category_id_from_cat_slug($slug, $type = 'category')
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

		return $cat_id;
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
		return $this->CI->Categories_Model->recreate_json_arr($db_key, $json_arr);
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

	public function get_lead_parent_cat_id_from_cat_slug($slug, $type = 'buying_lead')
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

		return $cat_id;
	}


	public function get_lead_parent_cat_id_from_cat_name($name, $type = 'buying_lead')
	{
		$categories = $this->get_categories(null);
		$cat_id = 0;
		foreach ($categories as $category){
			if ($category->name === $name && strtolower($category->category_type) === strtolower($type)){
				if ($category->parent_ids === 'uncategorised')
					$cat_id = $category->id;
				else
					$cat_id = $category->parent_ids;

				break;
			}
		}

		return $cat_id;
	}

}

/**
 * End of JsonManipulation class
 */
