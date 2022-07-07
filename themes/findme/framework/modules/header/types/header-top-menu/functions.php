<?php

if ( ! function_exists( 'findme_elated_register_header_top_menu_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function findme_elated_register_header_top_menu_type( $header_types ) {
		$header_type = array(
			'header-top-menu' => 'FindmeElated\Modules\Header\Types\HeaderTopMenu'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'findme_elated_init_register_header_top_menu_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function findme_elated_init_register_header_top_menu_type() {
		add_filter( 'findme_elated_register_header_type_class', 'findme_elated_register_header_top_menu_type' );
	}
	
	add_action( 'findme_elated_before_header_function_init', 'findme_elated_init_register_header_top_menu_type' );
}

if ( ! function_exists( 'findme_elated_check_is_header_top_menu_type_enabled' ) ) {
	/**
	 * This function check is header top_menu type enabled in global option or meta boxes option
	 */
	function findme_elated_check_is_header_top_menu_type_enabled() {
		return findme_elated_get_meta_field_intersect( 'header_type', findme_elated_get_page_id() ) === 'header-top-menu';
	}
}

if ( ! function_exists( 'findme_elated_disable_behaviors_for_header_top_menu' ) ) {
	/**
	 * This function is used to disable sticky header functions that perform processing variables their used in js for this header type
	 */
	function findme_elated_disable_behaviors_for_header_top_menu( $allow_behavior ) {
		if(findme_elated_check_is_header_top_menu_type_enabled()) {
			$allow_behavior = false;
		}
		
		return $allow_behavior;
	}
	
	add_filter( 'findme_elated_allow_sticky_header_behavior', 'findme_elated_disable_behaviors_for_header_top_menu' );
	add_filter( 'findme_elated_allow_content_boxed_layout', 'findme_elated_disable_behaviors_for_header_top_menu' );
}