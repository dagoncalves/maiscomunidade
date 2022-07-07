<?php

if ( ! function_exists( 'findme_elated_register_header_vertical_compact_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function findme_elated_register_header_vertical_compact_type( $header_types ) {
		$header_type = array(
			'header-vertical-compact' => 'FindmeElated\Modules\Header\Types\HeaderVerticalCompact'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'findme_elated_init_register_header_vertical_compact_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function findme_elated_init_register_header_vertical_compact_type() {
		add_filter( 'findme_elated_register_header_type_class', 'findme_elated_register_header_vertical_compact_type' );
	}
	
	add_action( 'findme_elated_before_header_function_init', 'findme_elated_init_register_header_vertical_compact_type' );
}

if ( ! function_exists( 'findme_elated_include_header_vertical_compact_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function findme_elated_include_header_vertical_compact_menu( $menus ) {
		$menus['vertical-compact-navigation'] = esc_html__( 'Vertical Compact Navigation', 'findme' );
		
		return $menus;
	}
	
	add_filter( 'findme_elated_register_headers_menu', 'findme_elated_include_header_vertical_compact_menu' );
}

if ( ! function_exists( 'findme_elated_check_is_header_vertical_compact_type_enabled' ) ) {
	/**
	 * This function check is header vertical compact type enabled in global option or meta boxes option
	 */
	function findme_elated_check_is_header_vertical_compact_type_enabled() {
		return findme_elated_get_meta_field_intersect( 'header_type', findme_elated_get_page_id() ) === 'header-vertical-compact';
	}
}

if ( ! function_exists( 'findme_elated_disable_behaviors_for_header_vertical_compact' ) ) {
	/**
	 * This function is used to disable sticky header functions that perform processing variables their used in js for this header type
	 */
	function findme_elated_disable_behaviors_for_header_vertical_compact( $allow_behavior ) {
		if(findme_elated_check_is_header_vertical_compact_type_enabled()) {
			$allow_behavior = false;
		}
		
		return $allow_behavior;
	}
	
	add_filter( 'findme_elated_allow_sticky_header_behavior', 'findme_elated_disable_behaviors_for_header_vertical_compact' );
	add_filter( 'findme_elated_allow_content_boxed_layout', 'findme_elated_disable_behaviors_for_header_vertical_compact' );
}

if ( ! function_exists( 'findme_elated_register_header_vertical_compact_widget_areas' ) ) {
	/**
	 * Registers additional widget areas for this header type
	 */
	function findme_elated_register_header_vertical_compact_widget_areas() {
		if(findme_elated_check_is_header_vertical_compact_type_enabled()) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Header Vertical Compact Widget Area', 'findme' ),
					'id'            => 'eltd-vertical-compact-area',
					'before_widget' => '<div id="%1$s" class="widget %2$s eltd-vertical-area-widget">',
					'after_widget'  => '</div>',
					'description'   => esc_html__( 'Widgets added here will appear on the bottom of header vertical menu', 'findme' )
				)
			);
		}
	}
	
	add_action( 'widgets_init', 'findme_elated_register_header_vertical_compact_widget_areas' );
}

if ( ! function_exists( 'findme_elated_get_header_vertical_compact_widget_areas' ) ) {
	/**
	 * Loads header widgets area HTML
	 */
	function findme_elated_get_header_vertical_compact_widget_areas() {
		$page_id                            = findme_elated_get_page_id();
		$custom_vertical_header_widget_area = get_post_meta( $page_id, 'eltd_custom_vertical_area_sidebar_meta', true );
		
		if ( is_active_sidebar( 'eltd-vertical-compact-area' ) && empty( $custom_vertical_header_widget_area ) ) {
			dynamic_sidebar( 'eltd-vertical-compact-area' );
		} else if ( ! empty( $custom_vertical_header_widget_area ) && is_active_sidebar( $custom_vertical_header_widget_area ) ) {
			dynamic_sidebar( $custom_vertical_header_widget_area );
		}
	}
}

if ( ! function_exists( 'findme_elated_get_header_vertical_compact_main_menu' ) ) {
	/**
	 * Loads vertical menu HTML
	 */
	function findme_elated_get_header_vertical_compact_main_menu() {
		findme_elated_get_module_template_part( 'templates/vertical-compact-navigation', 'header/types/header-vertical-compact' );
	}
}