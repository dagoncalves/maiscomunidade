<?php
use ElatedListing\Archive;

if(!function_exists('eltd_listing_generate_listing_map_archive_vars')){

	/**
	 * Generates archive map variables based on sent attributes
	 * $attributes can contain:
	 *      $posts_per_page - number of post per page. $post number can be set in Theme Options(Listings Section), then in wp_job_manager options and also in native WordPress Options
	 *      $max_num_pages - value from Wp_Query object. Needed for pagination params(for example, show/hide load more button)
	 *      $found_posts - value from Wp_Query object. Shows how many items are in current query
	 *      $type - listing type taxonomy term id
	 *      $cat - listing category taxonomy term slug
	 *      $keyword - keyword search param
	 *      $next_page - next page param
	 *      $custom_fields - listing post meta params set in search
	 * @param $attributes
	 *
	 */

	function eltd_listing_generate_listing_map_archive_vars($attributes){

		$posts_per_page = '-1';
		$max_num_pages = '';
		$found_posts = '';
		$type = '';
		$cat = '';
		$keyword = '';
		$next_page = '';
		$custom_fields = array();
		$tag = '';
		$location = '';

		extract($attributes);

		new Archive\ArchiveGlobalVar($posts_per_page, $max_num_pages, $found_posts, $type, $cat, $keyword, $next_page, $custom_fields, $tag, $location );

	}

}

if(!function_exists('eltd_listing_get_listing_archive_pages')){

	function eltd_listing_get_listing_archive_pages(){

		$params = eltd_listing_get_listing_archive_search_params();
		extract($params);

		$meta_query_flag = false;
		if(count($custom_fields)){
			$meta_query_flag = true;
		}

		$query_params = array(
			'type' => $type,
			'location' => $location,
			'tag' => $tag,
			'keyword' => $keyword,
			'user_id'  => $user_id,
			'post_number' => $post_per_page,
			'category_array' => $cat_array,
			'meta_query_flag' => $meta_query_flag,
			'default_meta_params' => $custom_fields
		);

		$featured_job_ids = get_featured_job_ids();
		if( ! empty( $featured_job_ids ) ) {
            $featured_query_params = array(
                'type' => $type,
                'location' => $location,
                'tag' => $tag,
                'keyword' => $keyword,
                'user_id' => $user_id,
                'post_number' => $post_per_page,
                'category_array' => $cat_array,
                'meta_query_flag' => $meta_query_flag,
                'default_meta_params' => $custom_fields,
                'post_in' => $featured_job_ids
            );

            $params['featured_query_results'] = eltd_listing_get_listing_query_results($featured_query_params, 'query');
        } else {
            $params['featured_query_results'] = new WP_Query();
        }

		$post_per_page_without_featured = $params['featured_query_results']->post_count >= $post_per_page ? 0 : $post_per_page - $params['featured_query_results']->post_count;

		$no_featured_query_params = array(
			'type' => $type,
			'location' => $location,
			'tag' => $tag,
			'keyword' => $keyword,
			'user_id'  => $user_id,
			'post_number' => $post_per_page_without_featured,
			'category_array' => $cat_array,
			'meta_query_flag' => $meta_query_flag,
			'default_meta_params' => $custom_fields,
			'post_not_in'		  => get_featured_job_ids()
		);

		$params['query_results'] = eltd_listing_get_listing_query_results($query_params);
		$params['no_featured_query_results'] = eltd_listing_get_listing_query_results($no_featured_query_params);

		//generate multiple map global vars from current query results
		$map_array = array(
			'type' => 'multiple',
			'query' => $params['query_results'],
			'init_multiple_map' => true
		);
		eltd_listing_generate_listing_map_vars($map_array);

		//generate archive search vars from current query results
		$archive_var_array = array(
			'posts_per_page' => $post_per_page,
			'max_num_pages' => $params['query_results']->max_num_pages,
			'found_posts' => $params['query_results']->found_posts,
			'type' => $type,
			'cat' => $cat_slug,
			'location' => $location,
			'tag' => $tag,
			'keyword' => $keyword,
			'next_page' => '2',
			'custom_fields' => $custom_fields
		);
		eltd_listing_generate_listing_map_archive_vars($archive_var_array);
		
		//generate html for current query_results
		eltd_listing_get_archive_module_template_part('holder', '', $params);

	}

}

if(!function_exists('eltd_listing_get_listing_archive_search_params')){

	function eltd_listing_get_listing_archive_search_params(){
		$params = array();
		//post per page param
		$params['post_per_page'] = $post_per_page = eltd_listing_get_listing_number_per_page();

		//type param
		$params['type'] = '';

		$params['user_id'] = '';
		if(isset($_GET['eltd-ls-user-id']) && $_GET['eltd-ls-user-id'] !== ''){
			$params['user_id'] = $_GET['eltd-ls-user-id'];
		}

		if(isset($_GET['eltd-ls-main-search-listing-type']) && $_GET['eltd-ls-main-search-listing-type'] !== ''){
			if($_GET['eltd-ls-main-search-listing-type'] === 'all'){
				$_GET['eltd-ls-main-search-listing-type'] = '';
			}
			$params['type'] = $_GET['eltd-ls-main-search-listing-type'];
		}
		elseif(is_tax( 'job_listing_type' )){
			$params['type'] = get_queried_object_id();
		}

		$params['location'] = '';
        if(isset($_GET['eltd-ls-main-search-listing-region']) && $_GET['eltd-ls-main-search-listing-region'] !== ''){
	        if($_GET['eltd-ls-main-search-listing-region'] === 'all'){
		        $_GET['eltd-ls-main-search-listing-region'] = '';
	        }
			$params['location'] = $_GET['eltd-ls-main-search-listing-region'];
		}
		elseif(is_tax( 'job_listing_region' )){
			$params['location'] = get_queried_object_id();
		}
        
		$params['tag'] = '';
		if(is_tax( 'job_listing_tag' )){
			$params['tag'] = get_queried_object_id();
		}

		//keyword param
		$params['keyword'] = '';
		if(isset($_GET['eltd-ls-main-search-keyword']) && $_GET['eltd-ls-main-search-keyword'] !== ''){
			$params['keyword'] = $_GET['eltd-ls-main-search-keyword'];
		}

		//category param
		$params['cat_slug'] = '';
		$params['cat_array'] = array();
		
		if(isset($_GET['eltd-ls-main-search-listing-cat']) && $_GET['eltd-ls-main-search-listing-cat'] !== ''){
			if($_GET['eltd-ls-main-search-listing-cat'] !== 'all'){
				$cat = get_term_by( 'id', $_GET['eltd-ls-main-search-listing-cat'], 'job_listing_category');
				$params['cat_array'][] = $cat->slug;
				$params['cat_slug'] = $cat->slug;
			}
		}
		elseif(is_tax( 'job_listing_category' )){
			$cat = get_term_by( 'id', get_queried_object_id(), 'job_listing_category');
			$params['cat_array'][] = $cat->slug;
			$params['cat_slug'] = $cat->slug;
		}

		$params['custom_fields'] = array();

		$max_price = $min_price = '';
		if(isset($_GET['eltd-ls-main-search-price-max'])){
			$max_price = $_GET['eltd-ls-main-search-price-max'];
		}
		if(isset($_GET['eltd-ls-main-search-price-min'])){
			$min_price = $_GET['eltd-ls-main-search-price-min'];
		}

		if($max_price !== '' && $min_price !== ''){
			$params['custom_fields']['price_both_values']['min'] = $min_price;
			$params['custom_fields']['price_both_values']['max'] = $max_price;
		}
		if($max_price !== '' && $min_price === ''){
			$params['custom_fields']['price_max'] = $max_price;
		}
		if($min_price !== '' && $max_price === ''){
			$params['custom_fields']['price_min'] = $min_price;
		}



		return $params;
	}

}

if(!function_exists('findme_elated_check_listing_item_rating')){

	/**
	 * @return int
	 */
	function findme_elated_check_listing_item_rating(){
		$args = array(
			'post_type' => 'job_listing',
			'post_status' => 'publish',
			'posts_per_page' => '-1',
			'suppress_filters' => 0
		);
		$listing_items = get_posts($args);
		$ratingCount = 0;

		if(is_array($listing_items) && count($listing_items)){

			foreach ($listing_items as $item){

				$post_meta = get_post_meta($item->ID, 'eltd_post_rating_value', true);
				if(isset($post_meta) && $post_meta !== ''){
					$ratingCount++;
				}

			}

		}

		return $ratingCount;

	}
}