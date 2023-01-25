<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require (FCPATH . 'enviornments.php');
global $customCache;

if (! class_exists('CustomCache')){
	class CustomCache{

		// ============================================================================================

						/*   PROPERTIES  */

		// =============================================================================================

		private $cache_expire_time = 604800; // seconds of 7 days // Save for 7 days
		private $cache_table_name = 'custom_cache';

		private $single_post_cache_key;
		private $user_cache_key;

		// Homepage - Keys
		private $latest_featured_posts_cache_key;
		private $latest_recommended_posts_cache_key;
		private $latest_buying_leads_cache_key;
		private $banners_cache_key;
		private $latest_news_cache_key;
		private $latest_tradeshow_cache_key;

		// General
		private $volgo_settings_cache_key;

		// Categories
		private $volgo_categories_cache_key;
		private $volgo_makes_cache_key;
		private $volgo_models_cache_key;
		private $volgo_category_total_listing_counts_cache_key;
		private $volgo_category_total_featured_counts_cache_key;
		private $volgo_category_total_recommended_counts_cache_key;
		private $volgo_parent_total_count_cache_key;
		private $volgo_parent_featured_count_cache_key;
		private $volgo_parent_recommended_count_cache_key;


		// ============================================================================================

						/*   LOGIC  */

		// =============================================================================================

		public function __construct()
		{
			$this->check_cache_folder();
		}

		public function make_cache(){

		}

		public function purge_cache(){

		}




		// ============================================================================================

					/*   PRIVATE FUNCTIONS  */

		// =============================================================================================

		private function check_cache_folder(){
			if (!is_dir(__CACHE_PATH__)){
				@mkdir(__CACHE_PATH__, 0777);
			}
		}









		// ============================================================================================

								/*   SETTERS & GETTERS  */

		// =============================================================================================

		/**
		 * @return mixed
		 */
		public function getSinglePostCacheKey()
		{
			return $this->single_post_cache_key;
		}

		/**
		 * @param mixed $single_post_cache_key
		 */
		private function setSinglePostCacheKey($single_post_cache_key)
		{
			$this->single_post_cache_key = $single_post_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getUserCacheKey()
		{
			return $this->user_cache_key;
		}

		/**
		 * @param mixed $user_cache_key
		 */
		private function setUserCacheKey($user_cache_key)
		{
			$this->user_cache_key = $user_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getLatestFeaturedPostsCacheKey()
		{
			return $this->latest_featured_posts_cache_key;
		}

		/**
		 * @param mixed $latest_featured_posts_cache_key
		 */
		private function setLatestFeaturedPostsCacheKey($latest_featured_posts_cache_key)
		{
			$this->latest_featured_posts_cache_key = $latest_featured_posts_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getLatestRecommendedPostsCacheKey()
		{
			return $this->latest_recommended_posts_cache_key;
		}

		/**
		 * @param mixed $latest_recommended_posts_cache_key
		 */
		private function setLatestRecommendedPostsCacheKey($latest_recommended_posts_cache_key)
		{
			$this->latest_recommended_posts_cache_key = $latest_recommended_posts_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getLatestBuyingLeadsCacheKey()
		{
			return $this->latest_buying_leads_cache_key;
		}

		/**
		 * @param mixed $latest_buying_leads_cache_key
		 */
		private function setLatestBuyingLeadsCacheKey($latest_buying_leads_cache_key)
		{
			$this->latest_buying_leads_cache_key = $latest_buying_leads_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getBannersCacheKey()
		{
			return $this->banners_cache_key;
		}

		/**
		 * @param mixed $banners_cache_key
		 */
		private function setBannersCacheKey($banners_cache_key)
		{
			$this->banners_cache_key = $banners_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getLatestNewsCacheKey()
		{
			return $this->latest_news_cache_key;
		}

		/**
		 * @param mixed $latest_news_cache_key
		 */
		private function setLatestNewsCacheKey($latest_news_cache_key)
		{
			$this->latest_news_cache_key = $latest_news_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getLatestTradeshowCacheKey()
		{
			return $this->latest_tradeshow_cache_key;
		}

		/**
		 * @param mixed $latest_tradeshow_cache_key
		 */
		private function setLatestTradeshowCacheKey($latest_tradeshow_cache_key)
		{
			$this->latest_tradeshow_cache_key = $latest_tradeshow_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getVolgoSettingsCacheKey()
		{
			return $this->volgo_settings_cache_key;
		}

		/**
		 * @param mixed $volgo_settings_cache_key
		 */
		private function setVolgoSettingsCacheKey($volgo_settings_cache_key)
		{
			$this->volgo_settings_cache_key = $volgo_settings_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getVolgoCategoriesCacheKey()
		{
			return $this->volgo_categories_cache_key;
		}

		/**
		 * @param mixed $volgo_categories_cache_key
		 */
		private function setVolgoCategoriesCacheKey($volgo_categories_cache_key)
		{
			$this->volgo_categories_cache_key = $volgo_categories_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getVolgoMakesCacheKey()
		{
			return $this->volgo_makes_cache_key;
		}

		/**
		 * @param mixed $volgo_makes_cache_key
		 */
		private function setVolgoMakesCacheKey($volgo_makes_cache_key)
		{
			$this->volgo_makes_cache_key = $volgo_makes_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getVolgoModelsCacheKey()
		{
			return $this->volgo_models_cache_key;
		}

		/**
		 * @param mixed $volgo_models_cache_key
		 */
		private function setVolgoModelsCacheKey($volgo_models_cache_key)
		{
			$this->volgo_models_cache_key = $volgo_models_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getVolgoCategoryTotalListingCountsCacheKey()
		{
			return $this->volgo_category_total_listing_counts_cache_key;
		}

		/**
		 * @param mixed $volgo_category_total_listing_counts_cache_key
		 */
		private function setVolgoCategoryTotalListingCountsCacheKey($volgo_category_total_listing_counts_cache_key)
		{
			$this->volgo_category_total_listing_counts_cache_key = $volgo_category_total_listing_counts_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getVolgoCategoryTotalFeaturedCountsCacheKey()
		{
			return $this->volgo_category_total_featured_counts_cache_key;
		}

		/**
		 * @param mixed $volgo_category_total_featured_counts_cache_key
		 */
		private function setVolgoCategoryTotalFeaturedCountsCacheKey($volgo_category_total_featured_counts_cache_key)
		{
			$this->volgo_category_total_featured_counts_cache_key = $volgo_category_total_featured_counts_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getVolgoCategoryTotalRecommendedCountsCacheKey()
		{
			return $this->volgo_category_total_recommended_counts_cache_key;
		}

		/**
		 * @param mixed $volgo_category_total_recommended_counts_cache_key
		 */
		private function setVolgoCategoryTotalRecommendedCountsCacheKey($volgo_category_total_recommended_counts_cache_key)
		{
			$this->volgo_category_total_recommended_counts_cache_key = $volgo_category_total_recommended_counts_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getVolgoParentTotalCountCacheKey()
		{
			return $this->volgo_parent_total_count_cache_key;
		}

		/**
		 * @param mixed $volgo_parent_total_count_cache_key
		 */
		private function setVolgoParentTotalCountCacheKey($volgo_parent_total_count_cache_key)
		{
			$this->volgo_parent_total_count_cache_key = $volgo_parent_total_count_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getVolgoParentFeaturedCountCacheKey()
		{
			return $this->volgo_parent_featured_count_cache_key;
		}

		/**
		 * @param mixed $volgo_parent_featured_count_cache_key
		 */
		private function setVolgoParentFeaturedCountCacheKey($volgo_parent_featured_count_cache_key)
		{
			$this->volgo_parent_featured_count_cache_key = $volgo_parent_featured_count_cache_key;
		}

		/**
		 * @return mixed
		 */
		public function getVolgoParentRecommendedCountCacheKey()
		{
			return $this->volgo_parent_recommended_count_cache_key;
		}

		/**
		 * @param mixed $volgo_parent_recommended_count_cache_key
		 */
		private function setVolgoParentRecommendedCountCacheKey($volgo_parent_recommended_count_cache_key)
		{
			$this->volgo_parent_recommended_count_cache_key = $volgo_parent_recommended_count_cache_key;
		}





	}

	$customCache = new CustomCache();
}
