<?php
use ElatedListing\Archive;
if(!function_exists('eltd_listing_is_wp_job_manager_installed')){
	/**
	 * check if is installed Wp Job Manager Plugin
	 */
	function eltd_listing_is_wp_job_manager_installed(){
		$flag = false;
		if(defined('JOB_MANAGER_VERSION')){
			$flag = true;
		}
		return $flag;
	}
}


if(!function_exists('eltd_listing_theme_installed')) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function eltd_listing_theme_installed() {
		return defined('ELATED_ROOT');
	}
}

if(!function_exists('eltd_listing_is_wc_paid_listings_installed')){
	/**
	 * check if is installed WC Paid Listings Plugin
	 */
	function eltd_listing_is_wc_paid_listings_installed(){
		$flag = false;
		if(defined('JOB_MANAGER_WCPL_VERSION')){
			$flag = true;
		}
		return $flag;
	}

}

if(!function_exists('eltd_listing_is_wp_job_manager_locations_installed')){
	/**
	 * check if is installed Wp Job Manager Regions Plugin
	 */
	function eltd_listing_is_wp_job_manager_locations_installed(){
		$flag = false;
		if(class_exists('Astoundify_Job_Manager_Regions') && eltd_listing_is_wp_job_manager_installed()){
			$flag = true;
		}
		return $flag;
	}

}

if(!function_exists('eltd_listing_is_wp_job_manager_tags_installed')){
	/**
	 * check if is installed Wp Job Manager Tags Plugin
	 */
	function eltd_listing_is_wp_job_manager_tags_installed(){
		$flag = false;
		if(defined('JOB_MANAGER_TAGS_VERSION')){
			$flag = true;
		}
		return $flag;
	}

}

if(!function_exists('eltd_listing_bookmark_plugin_installed')){
	/**
	 * check if is installed WP Job Manager - Bookmarks Plugin
	 */
	function eltd_listing_bookmark_plugin_installed(){
		$flag = false;
		if(defined('JOB_MANAGER_BOOKMARKS_VERSION')){
			$flag = true;
		}
		return $flag;
	}

}


if ( ! function_exists( 'eltd_listing_booking_plugin_installed' ) ) {
	/**
	 * Check if Elated Booking Plugin installed
	 *
	 * @return bool
	 */
	function eltd_listing_booking_plugin_installed() {
		return defined('ELATED_BOOKING_VERSION');
	}

}


if(!function_exists('eltd_listing_set_ajax_url')){
	/**
	 * load plugin ajax functionality
	 */
	function eltd_listing_set_ajax_url() {
		if(eltd_listing_theme_installed()){
			echo '<script type="application/javascript">var ElatedListingAjaxUrl = "'.admin_url('admin-ajax.php').'"</script>';
		}
	}

	add_action('wp_enqueue_scripts', 'eltd_listing_set_ajax_url');
}

if(!function_exists('eltd_listing_load_js_assets')){
	function eltd_listing_load_js_assets(){

		if(eltd_listing_theme_installed()){
			wp_enqueue_script( 'listing-handle-modules', ELATED_LISTING_URL_PATH.'assets/js/listing.min.js', array('jquery', 'underscore', 'jquery-ui-autocomplete','findme-elated-modules'), false, true );
		}

	}
	//set low priority because listing.min.js need to be loaded after modules.min.js and google api script
	add_action('wp_enqueue_scripts', 'eltd_listing_load_js_assets', 20);
}

if(!function_exists('eltd_listing_load_css_assets')){
	function eltd_listing_load_css_assets(){
		if(eltd_listing_theme_installed()){

			wp_enqueue_style('lisitng-handle-wp-job-manager', ELATED_LISTING_URL_PATH.'assets/css/css/listing.min.css');
			if (findme_elated_is_responsive_on()) {
				wp_enqueue_style('listing-handle-wp-job-manager-responsive', ELATED_LISTING_URL_PATH.'assets/css/css/listing-responsive.min.css');
			}

		}
	}
	add_action('wp_enqueue_scripts', 'eltd_listing_load_css_assets');
}

if(!function_exists('eltd_listing_remove_yoast_for_taxonomoies')) {
	function eltd_listing_remove_yoast_for_taxonomoies() {
		if(is_admin() && isset($GLOBALS) && isset($GLOBALS['_GET']) && isset($GLOBALS['_GET']['taxonomy'])) {
			$taxonomy = $GLOBALS['_GET']['taxonomy'];
			if($taxonomy == 'job_listing_type') {
				remove_action( 'plugins_loaded', 'wpseo_admin_init', 15 );
			}
		}
	}
	
	add_action( 'plugins_loaded', 'eltd_listing_remove_yoast_for_taxonomoies' );
}