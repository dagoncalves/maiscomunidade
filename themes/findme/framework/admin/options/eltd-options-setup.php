<?php

if ( ! function_exists( 'findme_elated_admin_map_init' ) ) {
	function findme_elated_admin_map_init() {
		do_action( 'findme_elated_before_options_map' );
		
		require_once ELATED_FRAMEWORK_ROOT_DIR . '/admin/options/fonts/map.php';
		require_once ELATED_FRAMEWORK_ROOT_DIR . '/admin/options/general/map.php';
		require_once ELATED_FRAMEWORK_ROOT_DIR . '/admin/options/page/map.php';
		require_once ELATED_FRAMEWORK_ROOT_DIR . '/admin/options/reset/map.php';
		require_once ELATED_FRAMEWORK_ROOT_DIR . '/admin/options/content-bottom/map.php';

		do_action( 'findme_elated_options_map' );
		
		do_action( 'findme_elated_after_options_map' );
	}
	
	add_action( 'after_setup_theme', 'findme_elated_admin_map_init', 1 );
}