<?php
//enable listing archive template
add_theme_support( 'job-manager-templates' );
use ElatedListing\Lib\FieldCreator;
use ElatedListing\Lib\Core;

if(!function_exists('eltd_listing_add_listing_field')){
	/**
	 * Function that add new field for job post item
	 *
	 * @param $params
	 *
	 */
	function eltd_listing_add_listing_field($params){

		$id = '';
		$type = '';
		$label = '';
		$options = '';
		$required = '';
		$placeholder = '';
		$priority = '';
		$description = '';
		$multiple = false;
		$front_end_field = true;
		$back_end_field = true;

		extract($params);
		new FieldCreator\ListingFieldCreator($id, $type, $label, $options, $required, $placeholder, $priority, $description,$multiple, $front_end_field, $back_end_field);
	}
}

if(!function_exists('eltd_listing_get_listing_query_results')){
	/**
	 * Generates query results based on params
	 * $attributes can contain:
	 *      $listing_type_id - listing type taxonomy term id
	 *      $post_number - number of post per page. $post number can be set in Theme Options(Listings Section), then in wp_job_manager options and also in native WordPress Options
	 *      $category_array - array of listing category slugs. We need to have array because we have cases where need to get listing from multiple categoriess
	 *      $meta_query_flag - boolean value to enable meta query flag
	 *      $checkbox_meta_params - custom listing meta fields(checkboxes) should be placed here.Note that this array will be filtered just if $meta_query_flag is true
	 *      $default_meta_params - custom listing meta fields(without checkboxes) should be placed here.Note that this array will be filtered just if $meta_query_flag is true
	 *      $next_page - next_page param is used for paginations
	 *      $user_id - get users listingss
	 *      $post_status - array or string of defined post statuses
	 *      $keyword - filter listings by keyword
	 *      $post_in - array of listing ids to get
	 *      $post_not_in - array of listing ids to exclude
	 *      $tag - filter listings by tag
	 *      $location - filter listings by location
	 *
	 * @param $attributes
	 *
	 * @return WP_Query object
	 */
	function eltd_listing_get_listing_query_results($attributes = array(), $return_type = 'query'){

		$type = '';
		$tag = '';
		$location = '';
		$category_array = array();
		$tax_array = array();
		$user_id = '';
		$keyword = '';
		$post_number = '-1';
		$post_status = 'publish';
		$post_in = array();
		$post_not_in = array();
		$meta_query_flag = false;
		$checkbox_meta_params = array();
		$default_meta_params = array();
		$next_page = '';
		$location_object = array();
		$sort_param = '';

		extract($attributes);
		$query_object = new Core\ListingQuery($type, $post_number, $category_array, $meta_query_flag ,$checkbox_meta_params, $default_meta_params, $next_page, $user_id, $post_status, $keyword, $post_in, $post_not_in, $tag, $location, $tax_array, $location_object, $sort_param);

		if($return_type === 'query'){
			return $query_object->getQueryResults();
		}
		if($return_type === 'array'){
			return $query_object->getQueryResultsArray();
		}

	}

}

if ( ! function_exists( 'eltd_listing_enqueue_scripts' ) ) {
	/**
	 * Enqueue media upload on taxonomy pages
	 */
	function eltd_listing_enqueue_scripts() {

		if(isset($_GET['taxonomy'])) {

			wp_enqueue_media();
			wp_enqueue_script('eltd-listing-taxonomy-upload-script', ELATED_LISTING_URL_PATH.'assets/js/admin/eltd-taxonomy.js');
			wp_enqueue_style('eltd-listing-taxonomy-style', ELATED_LISTING_URL_PATH.'assets/css/admin/eltd-taxonomy.css');

		}

		wp_enqueue_script('eltd-listing-repeater-script', ELATED_LISTING_URL_PATH.'/assets/js/admin/eltd-repeater.js');
		echo '<script type="application/javascript">var ElatedAdminAjaxUrl = "'.admin_url('admin-ajax.php').'"</script>';
	}
	add_action( 'admin_enqueue_scripts', 'eltd_listing_enqueue_scripts' );

}
if(!function_exists('eltd_listing_item_save_custom_fields')){
	/**
	 * Save custom fields for current job(front end submit job)
	 * @param  $post_id, $post
	 */
	function eltd_listing_item_save_custom_fields($post_id, $post){

		if($post && $post !== null && $post->post_type !== 'job_listing'){
			return;
		}
		$enable_multi_listing = job_manager_multi_job_type();

		if(isset($_POST)){

			// set discount price to be equal regular price.
			// disc price need to be set if regular price is set because of search engines which always check disc price

			if(isset($_POST['_listing_price']) && $_POST['_listing_price'] !== ''){

				//regular price is set and disc price is not set or is empty string
				if( !isset($_POST['_listing_disc_price']) || (isset($_POST['_listing_disc_price']) && $_POST['_listing_disc_price'] === '')){
					//in this case, set disc price to be equal regular price
					update_post_meta($post_id, '_listing_disc_price', $_POST['_listing_price']);
				}

			}
			if(isset($_POST['eltd_listing_item_multi_type']) || isset($_POST['eltd_listing_item_type'])){


				$ls_types_ids = array();
				$ls_types_save_array = array();

				if($enable_multi_listing){
					if($_POST['eltd_listing_item_multi_type']){
						$ls_types = $_POST['eltd_listing_item_multi_type'];
						if(is_array($ls_types) && count($ls_types)){
							//get array of all job listing types set for current job listing
							foreach($ls_types as $ls_type_key => $ls_type_id_value){
								if($ls_type_id_value !== ''){
									$ls_types_ids[] = $ls_type_id_value;
								}
							}
						}
					}
				}else{
					if($_POST['eltd_listing_item_type']){
						$ls_type = $_POST['eltd_listing_item_type'];
						if($ls_type !== ''){
							$ls_types_ids[] = $ls_type;
						}
					}
				}
				if(count($ls_types_ids)){
					foreach($ls_types_ids as $id){
						$type = eltd_listing_get_listing_type_by_id($id);
						$ls_types_save_array[] = $type->slug;
					}
				}

				if(count($ls_types_save_array)){
					wp_set_object_terms($post_id, $ls_types_save_array, 'job_listing_type');
				}else{
					wp_delete_object_term_relationships($post_id, 'job_listing_type');
				}

				$ls_categories = $_POST['eltd_listing_type_categories'];

				if(isset($ls_categories) && is_array($ls_categories)){

					$ls_cats_save_array = array();

					if(count($ls_types_ids)){

						//get all job listing categories related to job listing types(which are set for current job listing)
						$cats = eltd_listing_get_current_listing_types_categories($ls_types_ids);

						if(is_array($ls_categories) && count($ls_categories)){
							foreach($ls_categories as $key => $value){

								if($value !==''){
									//if category(which is set in $_POST) is related with some of job listing types set for current job listing, put in $categories_save_array
									if(array_key_exists($value, $cats)){
										$ls_cats_save_array[] = $value;
									}
								}

							}
						}

						//save values in database
						if(is_array($ls_cats_save_array) && count($ls_cats_save_array)){
							wp_set_object_terms($post_id, $ls_cats_save_array, 'job_listing_category');
						}else{
							wp_delete_object_term_relationships($post_id, 'job_listing_category');
						}
					}

				}
			}

			//this part of code is just for saving from front end
			if(is_admin()){
				return;
			}

			if(isset($_POST['current_listing_feature_image']) && ($_POST['current_listing_feature_image']) !== ''){
				$attachment_id = attachment_url_to_postid($_POST['current_listing_feature_image']);
				if($attachment_id){
					set_post_thumbnail( $post_id, $attachment_id );
				}
			}

			if(isset($_POST['job_type']) && ($_POST['job_type']) !== ''){
				if(is_array($_POST['job_type'])){
					$listing_types = $_POST['job_type'];
				}
				else{
					$listing_types = array($_POST['job_type']);
				}

				if($enable_multi_listing){
					update_post_meta($post_id, 'eltd_listing_item_multi_type', $listing_types);
				}else{
					update_post_meta($post_id, 'eltd_listing_item_type', $listing_types[0]);
				}

				$ls_types_save_array = array();
				if(count($listing_types)){
					foreach($listing_types as $id){
						$type = eltd_listing_get_listing_type_by_id($id);
						$ls_types_save_array[] = $type->slug;
					}
				}

				if(count($ls_types_save_array)){
					wp_set_object_terms($post_id, $ls_types_save_array, 'job_listing_type');
				}else{
					wp_delete_object_term_relationships($post_id, 'job_listing_type');
				}

				$ls_cats_save_array = array();
				if(isset($_POST['job_type_categories'])){
					$selected_cats = $_POST['job_type_categories'];

					if(is_array($selected_cats) && count($selected_cats)){
						foreach($selected_cats as $cat_id => $cat_value){
							if($cat_value !== ''){
								$ls_cats_save_array[] = $cat_value;
							}
						}
					}

				}

				if(is_array($ls_cats_save_array) && count($ls_cats_save_array)){
					wp_set_object_terms($post_id, $ls_cats_save_array, 'job_listing_category');
					update_post_meta($post_id, 'eltd_listing_type_categories', $ls_cats_save_array);

				}else{
					delete_post_meta($post_id, 'eltd_listing_type_categories');
				}


				if(is_array($listing_types) && count($listing_types)){
					foreach($listing_types as $listing_type_id){

						$custom_fields = eltd_listing_get_listing_type_custom_fields($listing_type_id);
						if(is_array($custom_fields) && count($custom_fields)){
							foreach($custom_fields as $field){
								if(isset($_POST[$field['meta_key']])){
									if($field['field_type'] === 'checkbox'){
										update_post_meta($post_id, $field['meta_key'], '1');
									}
									else{
										update_post_meta($post_id, $field['meta_key'], $_POST[$field['meta_key']]);
									}
								}
							}
						}
						$amenities = eltd_listing_get_listing_type_amenities($listing_type_id);

						if(is_array($amenities) && count($amenities)){
							foreach($amenities as $key => $amenity){
								$amenity_name = eltd_listing_get_listing_type_amenity_field_name_refactored($listing_type_id, $key);
								if(isset($_POST[$amenity_name])){
									update_post_meta($post_id, $amenity_name, '1');
								}else{
									update_post_meta($post_id, $amenity_name, '0');
								}
							}
						}
					}
				}

			}
		}
	}
	add_action('save_post', 'eltd_listing_item_save_custom_fields', 25, 2);
}

if(!function_exists('eltd_listing_check_distance')){

	/**
	 * Generates the string for the Haversine function. We assume that the `zipcode`, `latitude`,
	 * and `longitude` columns are named accordingly. We are also not doing much error-checking
	 * here; this is a simple text cruncher to make things prettier.
	 * We may also be integrating some extra SQL in, passed in via the $extra parameter
	 *
	 * @param   string      $table      The table to search in
	 * @param   float       $lat        The latitude part of the reference coordinates
	 * @param   float       $lng        The longitude part of the reference coordinates
	 * @param   int         $radius     The radius to search within
	 * @param   string      $extra      Some extra SQL for the city/state part of the search
	 *
	 * @return  string      Returns an SQL query as a string
	 *
	 **/

	function eltd_listing_check_distance( $lat, $long, $radius, $posts = array()){

		$listings_array = $posts;

		$current_lat = $current_long = $miles = '' ;
		$return_array = array();
		if(count($listings_array)){
			foreach($listings_array as $listing_key => $listing_title){

				$current_lat = get_post_meta($listing_key, 'geolocation_lat', true);
				$current_long = get_post_meta($listing_key, 'geolocation_long', true);

				if($current_lat !== '' && $current_long !== ''){

					$theta = $long - $current_long;
					$dist = sin(deg2rad($lat)) * sin(deg2rad($current_lat)) +  cos(deg2rad($lat)) * cos(deg2rad($current_lat)) * cos(deg2rad($theta));
					$dist = acos($dist);
					$dist = rad2deg($dist);
					$miles = $dist * 60 * 1.1515;
					$km = 1.609344*$miles;

					if($km <= $radius){
						$return_array['show_items'][] = $listing_key;
					}else{
						$return_array['hide_items'][] = $listing_key;
					}
				}else{
					$return_array['hide_items'][]  = $listing_key;
				}

			}
		}

		return $return_array;
	}

}

if(!function_exists('eltd_listing_check_listing_location')){

	function eltd_listing_check_listing_location($id, $location_array){

		$current_lat = get_post_meta($id, 'geolocation_lat', true);
		$current_long = get_post_meta($id, 'geolocation_long', true);
		$show_item = false;

		$lat = $location_array['lat'];
		$long = $location_array['long'];
		$distance = $location_array['distance'];

		if($current_lat !== '' && $current_long !== ''){

			$theta = $long - $current_long;
			$dist = sin(deg2rad($lat)) * sin(deg2rad($current_lat)) +  cos(deg2rad($lat)) * cos(deg2rad($current_lat)) * cos(deg2rad($theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$miles = $dist * 60 * 1.1515;

			if($miles <= $distance){
				$show_item = true;
			}

		}

		return $show_item;

	}

}