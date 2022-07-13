<?php
require_once 'const.php';
require_once 'helpers.php';

/*
Plugin Name: Elated Listing
Description: Plugin that extends wp_job_manager functionality
Author: Elated Themes
Version: 1.4.2
*/



if(!function_exists('eltd_listing_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function eltd_listing_text_domain() {
        load_plugin_textdomain('eltd-listing', false, ELATED_LISTING_REL_PATH.'/languages');
    }

    add_action('plugins_loaded', 'eltd_listing_text_domain');
}

if(!function_exists('eltd_listing_version_class')) {
	/**
	 * Adds plugins version class to body
	 * @param $classes
	 * @return array
	 */
	function eltd_listing_version_class($classes) {
		$classes[] = 'eltd-listing-'.ELATED_LISTING_VERSION;
		
		return $classes;
	}
	
	add_filter('body_class', 'eltd_listing_version_class');
}

if(!function_exists('eltd_listing_load_files')) {
	/**
	 * load plugin files on init action
	 */
	function eltd_listing_load_files() {
		require_once 'load.php';
	}

	add_action( 'plugins_loaded', 'eltd_listing_load_files' );
}