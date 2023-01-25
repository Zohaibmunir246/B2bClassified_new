<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/31/2019
 * Time: 4:57 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'classes/JsonManipulation.php';

class Listingquery_Model extends CI_Model
{

    private $country_info = null;

    public function __construct()
    {
        parent::__construct();

        // Run Explicitly
        volgo_get_user_location();

        $this->country_info = volgo_get_country_info_from_session();
    }

    public function sub_child_cats($id)
    {
        // $this->db->cache_on();

        $this->db->select('c.id, c.name , c.slug');
        $this->db->from('categories as c');
        $this->db->where('c.parent_ids', $id);
        $result = $this->db->get();

        // $this->db->cache_off();

        $return_sub_cats_by_id = $result->result();

        return $return_sub_cats_by_id;
    }

    public function total_listing_get($category_id, $country_id)
    {
        $cache_key = 'json_categories_1';
        //if (! $all_cats = $this->cache->get($cache_key)){
            $jsonManipulation = (new \application\classes\JsonManipulation());
            $all_cats = $jsonManipulation->get_categories(null);

            /*if (IS_CACHE_ON === true)
                $this->cache->save($cache_key, $all_cats, MAX_CACHE_TTL_VALUE);
        }*/

        $total_count_key = 'country_id_' . $country_id;

//        $jsonManipulation = (new \application\classes\JsonManipulation());
//        $all_cats = $jsonManipulation->get_categories(null);

        foreach ($all_cats as $key => $cat){
            if (intval($cat->id) === intval($category_id)){
                if (isset($cat->count, $cat->count->$total_count_key)){
                    $count = $cat->count->$total_count_key;
                }else {
                    $count = 0;
                }
                break;
            }

        }

        return $count;
    }

    public function get_category_name($id)
    {
        // $this->db->cache_on();

        $this->db->select('c.id, c.name');
        $this->db->from('categories as c');

        $this->db->where('id', $id);

        $result = $this->db->get();
        $return_cats_by_id = $result->result();

        // $this->db->cache_off();

        if (!empty($return_cats_by_id)) {
            return volgo_make_slug($return_cats_by_id[0]->name);
        } else {
            return $return_cats_by_id;
        }

    }

    public function get_name_of_paent_cat($id)
    {

        // $this->db->cache_on();

        $this->db->select('c.id, c.name , c.parent_ids');
        $this->db->from('categories as c');

        $this->db->where('id', $id);

        $result = $this->db->get();

        $return_cats_by_id = $result->result();
        if (!empty($return_cats_by_id)) {

            $parent_id = $return_cats_by_id[0]->parent_ids;

            if ($parent_id === 'uncategorised') {
                return '';
            } else {
                $parent_id = $parent_id;
            }
        } else {
            $parent_id = '';
        }


        if ($parent_id != 0) {


            $this->db->select('c.id, c.name ');
            $this->db->from('categories as c');

            $this->db->where('id', $parent_id);

            $result = $this->db->get();

            $parent_cat_id = $result->result();
        } else {
            $parent_cat_id = '';
        }



        if (!empty($parent_cat_id)) {
            return volgo_make_slug($parent_cat_id[0]->name);
        } else {
            return $parent_cat_id;
        }

    }


    public function get_parent_category_name($id)
    {
        // $this->db->cache_on();

        $this->db->select('parent_ids');
        $this->db->from('categories as c');
        $this->db->where('id', $id);
        $this->db->limit(1);

        $result = $this->db->get();
        $parent_cat = $result->row();

        // $this->db->cache_off();

        // $this->db->cache_on();

        $parent_name = $this->db
            ->select('c.name')
            ->from('categories as c')
            ->where('id', $parent_cat->parent_ids)
            ->limit(1)
            ->get()
            ->row();

        // $this->db->cache_off();

        if (empty($parent_name))
            return '';

        return volgo_make_slug(strtolower(trim($parent_name->name)));
    }
    public function get_parent_category_id($id)
    {
        // $this->db->cache_on();

        $this->db->select('parent_ids');
        $this->db->from('categories as c');
        $this->db->where('id', $id);
        $this->db->limit(1);

        $result = $this->db->get();
        $parent_cat = $result->row();

        // $this->db->cache_off();

        if (empty($parent_cat->parent_ids) || $parent_cat->parent_ids == 'uncategorised')
            return '';

        return $parent_cat->parent_ids;
    }

    public function get_id_of_cat($cat_name)
    {
        $cat_name = volgo_make_slug($cat_name);

        // $this->db->cache_on();

        $this->db->select('c.id, c.name');
        $this->db->from('categories as c');

        $this->db->where('slug', $cat_name);

        $result = $this->db->get();
        $return_cats_by_id = $result->result();

        // $this->db->cache_off();


        return $return_cats_by_id;
    }
    public function record_count_listing($id, $country_id)
    {
        $jsonManipulation = (new \application\classes\JsonManipulation());
        //1) Count Records
        $make = $this->input->get('select_make');
        $model = $this->input->get('select_model');
        $make_and_model_query = '';

        if (!isset($make) && empty($make)){
        $make = $this->input->get('make');
        }

        if (!isset($model) && empty($model)){
        $model = $this->input->get('model');
        }

        $make_id = $jsonManipulation->get_make_id_from_make_name($make);
        $model_id = $jsonManipulation->get_model_id_from_model_name($model);
        
        if (isset($make_id, $model_id) && ! empty($make_id) && !empty($model_id)){
            $make_and_model_query = 'and l.make_id=' . $make_id . ' and l.model_id=' . $model_id . ' ';
            }else if (isset($make_id) && ! empty($make_id)){
            $make_and_model_query = 'and l.make_id=' . $make_id . ' '; 
        }


            // try to count the records, save into database (categories meta) and create cache after this if block -- Just here for backward compatibility

        $query = $this->db->query("
                                SELECT COUNT(*) as total FROM listings_new l
                                where l.listing_type = 'featured'
                                 and  l.country_id = {$country_id}
                                  and  l.status = 'enabled' {$make_and_model_query}
                                   and (l.category_id =  {$id}
                                     or l.sub_category_id =  {$id} )
                            ");
        $totalrows = $query->row();
        $count = $totalrows->total;







        
        return $count;

    }
    public function record_count_listing1($id, $country_id)
    {
        $cache_key = 'country_id_'.$country_id.'_cat_id_'.intval($id).'__total_count_featured';

        // try to get from cache and if cache is not created then first we will look into categories meta table.
        //if (! $count = $this->cache->get($cache_key)){
            // Query
            $count_meta = $this->db->select('meta_value')
                ->from('categories_meta')
                ->where('categories_id', intval($id))
                ->where('meta_key', $cache_key)
                ->limit(1)
                ->get()->row();


            if (empty($count_meta)){
                // try to count the records, save into database (categories meta) and create cache after this if block -- Just here for backward compatibility

                $jsonManipulation = (new \application\classes\JsonManipulation());
                //1) Count Records
                $make = $this->input->get('select_make');
                $model = $this->input->get('select_model');
                $make_and_model_query = '';
        
                if (!isset($make) && empty($make)){
                $make = $this->input->get('make');
                }
        
                if (!isset($model) && empty($model)){
                $model = $this->input->get('model');
                }
        
                $make_id = $jsonManipulation->get_make_id_from_make_name($make);
                $model_id = $jsonManipulation->get_model_id_from_model_name($model);
                
                if (isset($make_id, $model_id) && ! empty($make_id) && !empty($model_id)){
                    $make_and_model_query = 'and l.make_id=' . $make_id . ' and l.model_id=' . $model_id . ' ';
                    }else if (isset($make_id) && ! empty($make_id)){
                    $make_and_model_query = 'and l.make_id=' . $make_id . ' '; 
                }

                $query = $this->db->query("
										SELECT COUNT(*) as total FROM listings l
										inner join (
										  select
											distinct listings_id
										  from listings_meta lm
										  where (lm.meta_key = 'listing_type' and lm.meta_value  = 'featured')
									  ) lm on lm.listings_id = l.id
									  where l.country_id = {$country_id} and  l.status = 'enabled' {$make_and_model_query} and (l.category_id =  {$id}  or l.sub_category_id =  {$id} )
									");
                $totalrows = $query->row();
                $count = $totalrows->total;


                //2) save into categories meta for next usage. // insert

                $data = [
                    'categories_id' => intval($id),
                    'meta_key'	=> $cache_key,
                    'meta_value'	=> $count,
                    'created_at' => date("Y-m-d H:i:s"),
                ];
                $this->db->set($data);

                $this->db->insert(
                    'categories_meta'
                );
            }else {
                $count = $count_meta->meta_value;
            }


            // Save Data
            /*if (IS_CACHE_ON === true)
               $this->cache->save($cache_key, $count, MAX_CACHE_TTL_VALUE);

        }*/

        return $count;

    }

    public function record_count_listing2($id, $country_id)
    {
        $jsonManipulation = (new \application\classes\JsonManipulation());
        //1) Get Make and Model query
        $make = $this->input->get('select_make');
        $model = $this->input->get('select_model');
        $make_and_model_query = '';

        if (!isset($make) && empty($make)){
        $make = $this->input->get('make');
        }

        if (!isset($model) && empty($model)){
        $model = $this->input->get('model');
        }

        $make_id = $jsonManipulation->get_make_id_from_make_name($make);
        $model_id = $jsonManipulation->get_model_id_from_model_name($model);
        
        if (isset($make_id, $model_id) && ! empty($make_id) && !empty($model_id)){
            $make_and_model_query = 'and l.make_id=' . $make_id . ' and l.model_id=' . $model_id . ' ';
            }else if (isset($make_id) && ! empty($make_id)){
            $make_and_model_query = 'and l.make_id=' . $make_id . ' '; 
        }

        if($make_and_model_query && !empty($make_and_model_query)){
         $cache_key = 'country_id_'.$country_id.'_cat_id_'.intval($id).'_'.str_replace([" ","=","."],"_",$make_and_model_query).'__total_count_recommended';   
        }else{
         $cache_key = 'country_id_'.$country_id.'_cat_id_'.intval($id).'__total_count_recommended';  
        }
        
        $country_id_key  = 'country_id_'.$country_id.'_count';
        $cat_id_key = 'cat_id_'.intval($id).'_total_count_recommended';
        //$count = $this->cache->get($cache_key);
        //echo $count;die;
        // try to get from cache and if cache is not created then first we will look into categories meta table.
        //if (!$count = $this->cache->get($cache_key)){
            // Query
            if(!$make_and_model_query && empty($make_and_model_query)){
            $json_data = $this->db->select('data')
            ->from('json_data')
            ->where('key', $country_id_key)
            ->limit(1)
            ->get()->row();
            $count_meta = json_decode($json_data->data);  
            foreach ($count_meta as $key => $value) {
                if($cat_id_key === $key){
                $count_json = $value;
            }
            }
            }else{
                $count_json = '';
            }
              
            if (empty($count_json)){
                // try to count the records, save into database (categories meta) and create cache after this if block -- Just here for backward compatibility

                $query = $this->db->query("
                                        SELECT COUNT(*) as total FROM listings l
                                        inner join (
                                          select
                                            distinct listings_id
                                          from listings_meta lm
                                          where (lm.meta_key = 'listing_type' and lm.meta_value  = 'recommended')
                                      ) lm on lm.listings_id = l.id
                                      where l.country_id = {$country_id} and  l.status = 'enabled' {$make_and_model_query} and (l.category_id =  {$id}  or l.sub_category_id =  {$id} )
                                    ");
                $totalrows = $query->row();
                $count = $totalrows->total;


                //2) save into categories meta for next usage. // insert
                // foreach ($json_data as $key => $value) {
                // if($cat_id_key === $key){
                // $json_data->$cat_id_key = '25';
                // }elseif($cat_id_key !== $key){
                // $json_data->$cat_id_key = '25';    
                // }
                // }
                // echo "<pre>";print_r(json_encode($json_data));die;
                // $data = [
                //     'data'    => $json_data,
                // ];
                // $this->db->where('key', $country_id_key);
                // $this->db->set($data);

                // $this->db->update(
                //     'json_data'
                // );


                // $data = [
                //     'categories_id' => intval($id),
                //     'meta_key'   => $cache_key,
                //     'meta_value' => $count,
                //     'created_at' => date("Y-m-d H:i:s"),
                // ];
                // $this->db->set($data);

                // $this->db->insert(
                //     'categories_meta'
                // );
            }else {
                
                //$count = $count_meta->meta_value;
                $count = $count_json;
            }


            // Save Data
            /*if (IS_CACHE_ON === true)
               $this->cache->save($cache_key, $count, MAX_CACHE_TTL_VALUE);

        }*/
        
        return $count;
    }

    public function listing_makes_count($id, $country_id)
    {
    // $query = "select
    // distinct lm.listings_id
    // from listings_meta lm
    // join listings l on l.id = lm.listings_id
    // where l.country_id = {$country_id} and l.status = 'enabled' and (l.category_id = {$id} or l.sub_category_id = {$id})
    // order by lm.listings_id";
    
    // $result_data = $this->db->query($query);
    
    // $ids_arr = $result_data->result();
    
    // $ids = [];
    // foreach ($ids_arr as $id_arr){
    // $ids[] = $id_arr->listings_id;
    // }
    // $listing_ids = implode(',', $ids);
    $makes = array();
    
    //if(intval($id) === 6 && !isset($_GET['make_id'])){
    $query_q = "select make_id, count(make_id) as makecount from listings_new
    where (make_id != null OR make_id != 0) AND country_id = {$country_id} and status = 'enabled' and listing_type = 'featured' and (category_id = {$id} or sub_category_id = {$id}) group by make_id";
    
    $result = $this->db->query($query_q);
    //echo $this->db->last_query();exit;
    $makes = $result->result();
    return $makes;
    //}
    }
    
    public function listing_models_count($id, $country_id)
    {


    $jsonManipulation = (new \application\classes\JsonManipulation());    
    if (isset($_GET['make'])) {
    $make = $_GET['make'];
    }elseif (isset($_GET['select_make'])) {
    $make = $_GET['select_make'];
    }elseif ($this->input->post('make')) {
    $make = $this->input->post('make');
    }

    if(isset($make)){

        $make_id = $jsonManipulation->get_make_id_from_make_slug_by_id(volgo_make_slug($make),$id);


    }else{
        $make_id = 0;

    }
        /*echo $make_id;
        exit();*/

    // $query = "select
    // distinct lm.listings_id
    // from listings_meta lm
    // join listings l on l.id = lm.listings_id
    // where l.country_id = {$country_id} and l.status = 'enabled' and (l.category_id = {$id} or l.sub_category_id = {$id})
    // order by lm.listings_id";
    
    // $result_data = $this->db->query($query);
    
    // $ids_arr = $result_data->result();
    
    // $ids = [];
    // foreach ($ids_arr as $id_arr){
    // $ids[] = $id_arr->listings_id;
    // }
    // $listing_ids = implode(',', $ids);
    // $models = array();
    //if(intval($id) === 6 && isset($_GET['make_id']) && !empty($_GET['make_id'])){
    $query_q = "select model_id as model_id, count(model_id) as modelcount from listings_new
    where make_id = {$make_id} AND (make_id != null OR make_id != 0) AND country_id = {$country_id} and status = 'enabled' and listing_type = 'featured' and (category_id = {$id} or sub_category_id = {$id}) group by model_id";
    $result = $this->db->query($query_q);
    if($result->num_rows() > 0){
        $models = $result->result();
    }else{
        $models = array();
    }

    //}
    return $models;
    }

   public function listing_by_cat_id_and_listing_type($id, $per_page_limit = 10, $page, $country_id, $type = 'featured')
    {

        $jsonManipulation = (new \application\classes\JsonManipulation());
        $meta_direction = '';
        $direction = 'desc';

        if ($this->input->get('sort') !== NULL){

            // price-desc, price-asc, asc, desc

            $direction = $this->input->get('sort');

            if (strtolower($direction) === 'price-asc' || strtolower($direction) === 'price-desc'){

                if (strtolower($direction) === 'price-asc')
                    $meta_direction = 'asc';
                else if (strtolower($direction) === 'price-desc')
                    $meta_direction = 'desc';

                // setting to default for main listing.
                $direction = $meta_direction;

            }

        }

        $make_by_get_req = $this->input->get('select_make');
        $model_by_get_req = $this->input->get('select_model');
        $make_and_model_query = '';

        if (!isset($make_by_get_req) && empty($make_by_get_req)){
            $make_by_get_req = $this->input->get('make');
        }
        if (!isset($model_by_get_req) && empty($model_by_get_req)){
            $model_by_get_req = $this->input->get('model');
        }
        //echo $make_by_get_req;exit;
        $make_id = $jsonManipulation->get_make_id_from_make_name_by_category($make_by_get_req,$id);
        $model_id = $jsonManipulation->get_model_id_from_model_name_by_make_id($model_by_get_req,$make_id);

        if (isset($make_id, $model_id) && ! empty($make_id) && !empty($model_id)){
            $make_and_model_query = 'and l.make_id=' . $make_id . ' and l.model_id=' . $model_id . ' ';
        }else if (isset($make_id) && ! empty($make_id)){
            $make_and_model_query = 'and l.make_id=' . $make_id . ' ';
        }



        $limit = $per_page_limit;

        $offset = ($page - 1) * $per_page_limit;

        if ($per_page_limit === 0)
            $per_page_limit = 10;

        if ($per_page_limit > 0) {
            $per_page_limit = " limit " . $per_page_limit . " offset " . $offset;
        } else {
            $per_page_limit = "";
        }
        if (intval($limit) < 1)
            $limit = 1;


        if (! empty($meta_direction)){
            $order_by  = "order by l.meta_values->>'$.price' {$direction}";
        }else {
            $order_by  = "order by l.created_at {$direction}";
        }

        // Query
        $query_q = "select l.id, l.uid, l.title ,l.description,l.make_id , l.created_at , l.category_id, l.sub_category_id , l.make_id, l.model_id,
                    l.country_id , l.make_id, l.model_id, l.state_id , l.city_id, l.slug ,cat.id as listingcatid, cat.name as catgory_name,
                    l.sub_category_id as listingsubcatid,  sub_cat.name as subcategoryname ,
                    cntry.name as country_name, cntry.id as country_id ,
                    cites.name as city_name, cites.id as city_id ,
                    stats.name as state_name, stats.id as state_id ,
                    userinfo.email as user_email, userinfo.id as userinfo_id,
                    l.listing_type,l.meta_values
        from listings_new l

            inner join b2b_countries cntry on cntry.id = l.country_id
            LEFT JOIN b2b_cities cites on cites.id = l.city_id

            LEFT JOIN categories sub_cat on sub_cat.id = l.sub_category_id
            LEFT join categories cat on cat.id = l.category_id
            LEFT join b2b_states stats on stats.id = l.state_id
            LEFT join b2b_users userinfo on userinfo.id = l.uid

        where l.country_id = {$country_id} and  l.status = 'enabled' and  l.listing_type = '$type' {$make_and_model_query} and (l.category_id =  {$id} or l.sub_category_id = {$id})
        {$order_by}
        {$per_page_limit}";
        //echo $query_q;exit;
        $result = $this->db->query($query_q);
        $listing_data = $result->result();

        return $listing_data;


    }
   public function listing_by_cat_id_featured($id, $per_page_limit = 10, $page, $country_id, $type = 'featured')
    {
        
        $jsonManipulation = (new \application\classes\JsonManipulation());
        $meta_direction = '';
        $direction = 'desc';

        if ($this->input->get('sort') !== NULL){

            // price-desc, price-asc, asc, desc

            $direction = $this->input->get('sort');

            if (strtolower($direction) === 'price-asc' || strtolower($direction) === 'price-desc'){

                if (strtolower($direction) === 'price-asc')
                    $meta_direction = 'asc';
                else if (strtolower($direction) === 'price-desc')
                    $meta_direction = 'desc';

                // setting to default for main listing.
                $direction = $meta_direction;

            }

        }

        $make_by_get_req = $this->input->get('select_make');
        $model_by_get_req = $this->input->get('select_model');
        $make_and_model_query = '';
        
        if (!isset($make_by_get_req) && empty($make_by_get_req)){
            $make_by_get_req = $this->input->get('make');
        }
        if (!isset($model_by_get_req) && empty($model_by_get_req)){
            $model_by_get_req = $this->input->get('model');
        }

        $make_id = $jsonManipulation->get_make_id_from_make_name($make_by_get_req);
        $model_id = $jsonManipulation->get_model_id_from_model_name($model_by_get_req);

        if (isset($make_id, $model_id) && ! empty($make_id) && !empty($model_id)){
            $make_and_model_query = 'and l.make_id=' . $make_id . ' and l.model_id=' . $model_id . ' ';
        }else if (isset($make_id) && ! empty($make_id)){
            $make_and_model_query = 'and l.make_id=' . $make_id . ' '; 
        }
        


        $limit = $per_page_limit;
        
        $offset = ($page - 1) * $per_page_limit;

        if ($per_page_limit === 0)
            $per_page_limit = 10;

        if ($per_page_limit > 0) {
            $per_page_limit = " limit " . $per_page_limit . " offset " . $offset;
        } else {
            $per_page_limit = "";
        }
        if (intval($limit) < 1)
            $limit = 1;
        

        if (! empty($meta_direction)){
            $order_by  = "order by l.meta_values->>'price' {$direction}";
        }else {
            $order_by  = "order by l.created_at {$direction}";
        }

        // Query
        $query_q = "select l.id, l.uid, l.title ,l.description , l.created_at , l.category_id, l.sub_category_id , l.make_id, l.model_id,
                    l.country_id , l.make_id, l.model_id, l.state_id , l.city_id, l.slug ,cat.id as listingcatid, cat.name as catgory_name,
                    l.sub_category_id as listingsubcatid,  sub_cat.name as subcategoryname ,
                    cntry.name as country_name, cntry.id as country_id ,
                    cites.name as city_name, cites.id as city_id ,
                    stats.name as state_name, stats.id as state_id ,
                    userinfo.email as user_email, userinfo.id as userinfo_id,
                    l.listing_type,l.meta_values
        from listings_new l

            inner join b2b_countries cntry on cntry.id = l.country_id
            LEFT JOIN b2b_cities cites on cites.id = l.city_id

            LEFT JOIN categories sub_cat on sub_cat.id = l.sub_category_id
            LEFT join categories cat on cat.id = l.category_id
            LEFT join b2b_states stats on stats.id = l.state_id
            LEFT join b2b_users userinfo on userinfo.id = l.uid

        where l.country_id = {$country_id} and  l.status = 'enabled' and  l.listing_type = '$type' {$make_and_model_query} and (l.category_id =  {$id} or l.sub_category_id = {$id})
        {$order_by}
        {$per_page_limit}";

        $result = $this->db->query($query_q);
        $listing_data = $result->result();

        return $listing_data;


    }

    public function listing_by_cat_id_recommended($id, $per_page_limit = 0, $page, $country_id, $type = 'recommended')
    {
        $jsonManipulation = (new \application\classes\JsonManipulation());
        $meta_direction = '';
        $direction = 'desc';

        if ($this->input->get('sort') !== NULL){

            // price-desc, price-asc, asc, desc

            $direction = $this->input->get('sort');

            if (strtolower($direction) === 'price-asc' || strtolower($direction) === 'price-desc'){

                if (strtolower($direction) === 'price-asc')
                    $meta_direction = 'asc';
                else if (strtolower($direction) === 'price-desc')
                    $meta_direction = 'desc';

                // setting to default for main listing.
                $direction = $meta_direction;

            }

        }

        $make_by_get_req = $this->input->get('select_make');
        $model_by_get_req = $this->input->get('select_model');
        $make_and_model_query = '';
        
        if (!isset($make_by_get_req) && empty($make_by_get_req)){
            $make_by_get_req = $this->input->get('make');
        }
        if (!isset($model_by_get_req) && empty($model_by_get_req)){
            $model_by_get_req = $this->input->get('model');
        }

        $make_id = $jsonManipulation->get_make_id_from_make_name($make_by_get_req);
        $model_id = $jsonManipulation->get_model_id_from_model_name($model_by_get_req);

        if (isset($make_id, $model_id) && ! empty($make_id) && !empty($model_id)){
            $make_and_model_query = 'and l.make_id=' . $make_id . ' and l.model_id=' . $model_id . ' ';
        }else if (isset($make_id) && ! empty($make_id)){
            $make_and_model_query = 'and l.make_id=' . $make_id . ' '; 
        }

        $is_this_parent_category = false;
        $parent_ids = $this->db->select('id')->from('categories')->where('category_type', 'category')->where('parent_ids', 'uncategorised')->get()->result_object();
        foreach ($parent_ids as $id_obj){
            if (intval($id_obj->id) === intval($id)){
                $is_this_parent_category = true;
                break;
            }
        }


        $limit = $per_page_limit;
        $offset = ($page - 1) * $per_page_limit;

        if ($per_page_limit === 0)
            $meta_limit = 10;
        else
            $meta_limit = $per_page_limit;

        if ($per_page_limit > 0) {
            $per_page_limit = " limit " . $per_page_limit . " offset " . $offset;
        } else {
            $per_page_limit = "";
        }

        if (intval($limit) < 1)
            $limit = 1;


        // ---- Get Listings IDS ---
        
        if (!$is_this_parent_category){

            if (!empty($meta_direction)){
                // Query
                $query = "select
					 lm.listings_id,l.created_at
				from listings_meta lm
					join listings l on l.id = lm.listings_id
				where (
					lm.meta_key = 'listing_type' and lm.meta_value  = 'recommended' 
				)
				and l.country_id = {$country_id} and  l.status = 'enabled' and (l.category_id =  {$id} or l.sub_category_id = {$id})
				
				order by l.created_at {$meta_direction} ,l.created_at {$direction}
                {$per_page_limit}";
                /*#order by RAND() {$meta_direction} , RAND() {$direction}*/
            }else {
                // Query
                $query = "select
					distinct (lm.listings_id),l.created_at
				from listings_meta lm
					join listings l on l.id = lm.listings_id
				where (
					lm.meta_key = 'listing_type' and lm.meta_value  = 'recommended'
				)
				and l.country_id = {$country_id} and  l.status = 'enabled' and (l.category_id =  {$id} or l.sub_category_id = {$id})
				
				order by l.created_at {$direction}
				{$per_page_limit}";
                /*#order by RAND() {$direction}*/
            }
            // Query

            $result_data = $this->db->query($query);

            $ids_arr = $result_data->result();

            $ids = [];
            foreach ($ids_arr as $id_arr){
                $ids[] = $id_arr->listings_id;
            }
            $listing_ids = implode(',', $ids);

        }else {
            // Query
            if (!empty($meta_direction)){
                // Query
                $query = "select
					 lm.listings_id,l.created_at
				from listings_meta lm
					join listings l on l.id = lm.listings_id
				where (
					lm.meta_key = 'price'  
				)
				and l.country_id = {$country_id} and  l.status = 'enabled' and (l.category_id =  {$id} or l.sub_category_id = {$id})
				
				order by l.created_at {$meta_direction}
				{$per_page_limit}";
                /*#order by RAND() {$meta_direction}*/
            }else {

                // Query
                $query = "select
					distinct (lm.listings_id),l.created_at
				from listings_meta lm
					join listings l on l.id = lm.listings_id
				where (
					lm.meta_key = 'listing_type' and lm.meta_value  = 'recommended'
				)
				and l.country_id = {$country_id} and  l.status = 'enabled' and (l.category_id =  {$id} or l.sub_category_id = {$id})
				
				order by l.created_at {$direction}
				{$per_page_limit}";
                /*#order by RAND() {$direction}*/
            }

            $result_data = $this->db->query($query);

            $ids_arr = $result_data->result();

            $ids = [];
            foreach ($ids_arr as $id_arr){
                $ids[] = $id_arr->listings_id;
            }
            $listing_ids = implode(',', $ids);
            
        }
        
        if(empty($listing_ids))
            $listing_ids = 0;


        if (! empty($meta_direction)){
            $order_by  = "order by field(l.id, {$listing_ids}) asc";
        }else {
            $order_by  = "order by l.created_at {$direction}";
        }

        if (!$is_this_parent_category){
         
            // Query
            $query_q = "select l.id, l.uid, l.uid, l.title , l.created_at , l.category_id, l.sub_category_id , l.make_id, l.model_id,
						l.country_id , l.make_id, l.model_id, l.state_id , l.city_id, l.slug ,cat.id as listingcatid, cat.name as catgory_name,
						l.sub_category_id as listingsubcatid,  sub_cat.name as subcategoryname ,
						cntry.name as country_name, cntry.id as country_id ,
						cites.name as city_name, cites.id as city_id ,
						stats.name as state_name, stats.id as state_id ,
						userinfo.email as user_email, userinfo.id as userinfo_id
			from listings l

				inner join b2b_countries cntry on cntry.id = l.country_id
				LEFT JOIN b2b_cities cites on cites.id = l.city_id

				LEFT JOIN categories sub_cat on sub_cat.id = l.sub_category_id
				LEFT join categories cat on cat.id = l.category_id
				LEFT join b2b_states stats on stats.id = l.state_id
				LEFT join b2b_users userinfo on userinfo.id = l.uid

			where l.country_id = {$country_id} and  l.status = 'enabled' {$make_and_model_query} and (l.category_id =  {$id} or l.sub_category_id = {$id})
			AND l.id in ({$listing_ids})
			{$order_by}
			limit 10";

            $result = $this->db->query($query_q);
            $listing_data = $result->result();
            
          
        }else {

            if (! empty($meta_direction)){
                $order_by  = "order by field(l.created_at, {$listing_ids}) asc";
            }else {
                $order_by  = "order by l.created_at {$direction}";
            }
            // Query
            $query_q = "select l.id, l.title , l.created_at , l.category_id, l.sub_category_id , l.make_id, l.model_id,
						l.country_id , l.state_id , l.city_id, l.slug ,cat.id as listingcatid, cat.name as catgory_name,
						l.sub_category_id as listingsubcatid,  sub_cat.name as subcategoryname ,
						cntry.name as country_name, cntry.id as country_id ,
						cites.name as city_name, cites.id as city_id ,
						stats.name as state_name, stats.id as state_id
			from listings l

				inner join b2b_countries cntry on cntry.id = l.country_id
				LEFT JOIN b2b_cities cites on cites.id = l.city_id

				LEFT JOIN categories sub_cat on sub_cat.id = l.sub_category_id
				LEFT join categories cat on cat.id = l.category_id
				LEFT join b2b_states stats on stats.id = l.state_id

			where l.country_id = {$country_id} and  l.status = 'enabled' {$make_and_model_query} and (l.category_id =  {$id} or l.sub_category_id = {$id})
			AND l.id in ({$listing_ids})
			{$order_by}
			limit 10";


            $result = $this->db->query($query_q);
            $listing_data = $result->result();
        }

        $anewarr = [];
        foreach ($listing_data as $single_cat_id) {

            /*$cache_key = get_mobile_listing_meta_data_cache_key(intval($single_cat_id->id));
            
            if (! $meta_data = $this->cache->get($cache_key)){*/
                // Query
                $this->db->select('meta_key , meta_value');
                $this->db->from('listings_meta');
                $this->db->where('listings_id', intval($single_cat_id->id));
                $result = $this->db->get();
                $meta_data = $result->result();

                // Save Data
                /*if (IS_CACHE_ON === true)
                    $this->cache->save($cache_key, $meta_data, MAX_CACHE_TTL_VALUE); // save for 72 hours

            }*/
            $anewarr[] = [
                'lisitng_info' => $single_cat_id,
                'meta_info' => $meta_data
            ];
        }

        return $anewarr;


    }
    public function get_total_lstings_counts_by_category_and_country($type = null,$category_id = 0,$country_id = 0){

        $condition = "";
        if(!empty($type)){
            $condition .= " AND l.listing_type = '$type' ";
        }

        if(!empty($category_id) && $category_id > 0){
            $condition .= " AND (l.sub_category_id = $category_id OR category_id = $category_id) ";
        }

        if(!empty($country_id) && $country_id > 0){
            $condition .= " AND l.country_id = $country_id ";
        }

        $query = "
            SELECT COUNT(id) as total
            FROM listings_new l 
            WHERE status = 'enabled'$condition
        ";

        $result = $this->db->query($query);
        return $result->row()->total;
    }
}

