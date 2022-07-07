<?php

if ( ! function_exists( 'findme_elated_meta_boxes_map_init' ) ) {
	function findme_elated_meta_boxes_map_init() {
		/**
		 * Loades all meta-boxes by going through all folders that are placed directly in meta-boxes folder
		 * and loads map.php file in each.
		 *
		 * @see http://php.net/manual/en/function.glob.php
		 */
		do_action( 'findme_elated_before_meta_boxes_map' );
		
		foreach ( glob( ELATED_FRAMEWORK_ROOT_DIR . '/admin/meta-boxes/*/map.php' ) as $meta_box_load ) {
			include_once $meta_box_load;
		}
		
		do_action( 'findme_elated_meta_boxes_map' );
		
		do_action( 'findme_elated_after_meta_boxes_map' );
	}
	
	add_action( 'after_setup_theme', 'findme_elated_meta_boxes_map_init', 1 );
}

if(!function_exists('findme_elated_wp_job_manager_meta_boxes_map_init')){
	/*
	 * Wp Job Manager plugin register their post type on 'init' action
	 * Our theme meta boxes loads on 'after_setup_theme' action and this is reason why we need to set meta box for WpJobManager on 'init' action
	 */
	function findme_elated_wp_job_manager_meta_boxes_map_init() {
		/**
		 * Loades all meta-boxes by going through all folders that are placed directly in meta-boxes folder
		 * and loads map.php file in each.
		 *
		 * @see http://php.net/manual/en/function.glob.php
		 */


		do_action('findme_elated_before_meta_boxes_map');

		do_action('findme_elated_meta_boxes_map_on_init_action');

		do_action('findme_elated_after_meta_boxes_map');

	}
	add_action('init', 'findme_elated_wp_job_manager_meta_boxes_map_init', 1);
}