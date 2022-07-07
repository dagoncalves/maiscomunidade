<?php

if ( ! function_exists( 'findme_elated_set_header_vertical_type_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function findme_elated_set_header_vertical_type_global_option( $header_types ) {
		$header_types['header-vertical'] = array(
			'image' => ELATED_FRAMEWORK_HEADER_TYPES_ROOT . '/header-vertical/assets/img/header-vertical.png',
			'label' => esc_html__( 'Vertical', 'findme' )
		);
		
		return $header_types;
	}
	
	add_filter( 'findme_elated_header_type_global_option', 'findme_elated_set_header_vertical_type_global_option' );
}

if ( ! function_exists( 'findme_elated_set_header_vertical_type_meta_boxes_option' ) ) {
	/**
	 * This function set header type value for header meta boxes map
	 */
	function findme_elated_set_header_vertical_type_meta_boxes_option( $header_type_options ) {
		$header_type_options['header-vertical'] = esc_html__( 'Vertical', 'findme' );
		
		return $header_type_options;
	}
	
	add_filter( 'findme_elated_header_type_meta_boxes', 'findme_elated_set_header_vertical_type_meta_boxes_option' );
}

if ( ! function_exists( 'findme_elated_set_show_dep_options_for_header_vertical' ) ) {
	/**
	 * This function set show container values when this header type is selected for header type global option
	 */
	function findme_elated_set_show_dep_options_for_header_vertical( $show_dep_options ) {
		$show_containers   = array();
		$show_containers[] = '#eltd_header_vertical_area_container';
		$show_containers[] = '#eltd_panel_vertical_main_menu';
		
		$show_containers = apply_filters( 'findme_elated_show_dep_options_for_header_vertical', $show_containers );
		
		$show_dep_options['header-vertical'] = implode( ',', $show_containers );
		
		return $show_dep_options;
	}
	
	add_filter( 'findme_elated_header_type_show_global_option', 'findme_elated_set_show_dep_options_for_header_vertical' );
}

if ( ! function_exists( 'findme_elated_set_hide_dep_options_for_header_vertical' ) ) {
	/**
	 * This function set hide container values when this header type is selected for header type global option
	 */
	function findme_elated_set_hide_dep_options_for_header_vertical( $hide_dep_options ) {
		$hide_containers   = array();
		$hide_containers[] = '#eltd_header_behaviour';
		$hide_containers[] = '#eltd_menu_area_container';
		$hide_containers[] = '#eltd_logo_area_container';
		$hide_containers[] = '#eltd_panel_fullscreen_menu';
		$hide_containers[] = '#eltd_panel_main_menu';
		$hide_containers[] = '#eltd_panel_sticky_header';
		$hide_containers[] = '#eltd_panel_fixed_header';
		
		$hide_containers = apply_filters( 'findme_elated_hide_dep_options_for_header_vertical', $hide_containers );
		
		$hide_dep_options['header-vertical'] = implode( ',', $hide_containers );
		
		return $hide_dep_options;
	}
	
	add_filter( 'findme_elated_header_type_hide_global_option', 'findme_elated_set_hide_dep_options_for_header_vertical' );
}

if ( ! function_exists( 'findme_elated_set_show_dep_options_for_header_vertical_meta_boxes' ) ) {
	/**
	 * This function set show container values when this header type is selected for header type meta boxes map
	 */
	function findme_elated_set_show_dep_options_for_header_vertical_meta_boxes( $show_dep_options ) {
		$show_containers   = array();
		$show_containers[] = '#eltd_header_vertical_area_container';
		
		$show_containers = apply_filters( 'findme_elated_show_dep_options_for_header_vertical_meta_boxes', $show_containers );
		
		$show_dep_options['header-vertical'] = implode( ',', $show_containers );
		
		return $show_dep_options;
	}
	
	add_filter( 'findme_elated_header_type_show_meta_boxes', 'findme_elated_set_show_dep_options_for_header_vertical_meta_boxes' );
}

if ( ! function_exists( 'findme_elated_set_hide_dep_options_for_header_vertical_meta_boxes' ) ) {
	/**
	 * This function set hide container values when this header type is selected for header type meta boxes map
	 */
	function findme_elated_set_hide_dep_options_for_header_vertical_meta_boxes( $hide_dep_options ) {
		$hide_containers   = array();
		$hide_containers[] = '#eltd_logo_area_container';
		$hide_containers[] = '#eltd_menu_area_container';
		
		$hide_containers = apply_filters( 'findme_elated_hide_dep_options_for_header_vertical_meta_boxes', $hide_containers );
		
		$hide_dep_options['header-vertical'] = implode( ',', $hide_containers );
		
		return $hide_dep_options;
	}
	
	add_filter( 'findme_elated_header_type_hide_meta_boxes', 'findme_elated_set_hide_dep_options_for_header_vertical_meta_boxes' );
}

if ( ! function_exists( 'findme_elated_set_vertical_hide_dep_options_for_header_types' ) ) {
	/**
	 * This function is used to disable this header type specific containers/panels for admin options when another header type is selected.
	 */
	function findme_elated_set_vertical_hide_dep_options_for_header_types( $hide_containers_dep_options ) {
		$hide_containers_dep_options[] = '#eltd_header_vertical_area_container';
		$hide_containers_dep_options[] = '#eltd_panel_vertical_main_menu';
		
		return $hide_containers_dep_options;
	}
	
	// hide header vertical container for global options
	add_filter( 'findme_elated_hide_dep_options_for_header_box', 'findme_elated_set_vertical_hide_dep_options_for_header_types' );
	add_filter( 'findme_elated_hide_dep_options_for_header_centered', 'findme_elated_set_vertical_hide_dep_options_for_header_types' );
	add_filter( 'findme_elated_hide_dep_options_for_header_divided', 'findme_elated_set_vertical_hide_dep_options_for_header_types' );
	add_filter( 'findme_elated_hide_dep_options_for_header_minimal', 'findme_elated_set_vertical_hide_dep_options_for_header_types' );
	add_filter( 'findme_elated_hide_dep_options_for_header_standard', 'findme_elated_set_vertical_hide_dep_options_for_header_types' );
	add_filter( 'findme_elated_hide_dep_options_for_header_standard_extended', 'findme_elated_set_vertical_hide_dep_options_for_header_types' );
	add_filter( 'findme_elated_hide_dep_options_for_header_tabbed', 'findme_elated_set_vertical_hide_dep_options_for_header_types' );
	add_filter( 'findme_elated_hide_dep_options_for_header_top_menu', 'findme_elated_set_vertical_hide_dep_options_for_header_types' );
	
	// hide header vertical container for meta boxes
	add_filter( 'findme_elated_hide_dep_options_for_header_box_meta_boxes', 'findme_elated_set_vertical_hide_dep_options_for_header_types' );
	add_filter( 'findme_elated_hide_dep_options_for_header_centered_meta_boxes', 'findme_elated_set_vertical_hide_dep_options_for_header_types' );
	add_filter( 'findme_elated_hide_dep_options_for_header_divided_meta_boxes', 'findme_elated_set_vertical_hide_dep_options_for_header_types' );
	add_filter( 'findme_elated_hide_dep_options_for_header_minimal_meta_boxes', 'findme_elated_set_vertical_hide_dep_options_for_header_types' );
	add_filter( 'findme_elated_hide_dep_options_for_header_standard_meta_boxes', 'findme_elated_set_vertical_hide_dep_options_for_header_types' );
	add_filter( 'findme_elated_hide_dep_options_for_header_standard_extended_meta_boxes', 'findme_elated_set_vertical_hide_dep_options_for_header_types' );
	add_filter( 'findme_elated_hide_dep_options_for_header_tabbed_meta_boxes', 'findme_elated_set_vertical_hide_dep_options_for_header_types' );
	add_filter( 'findme_elated_hide_dep_options_for_header_top_menu_meta_boxes', 'findme_elated_set_vertical_hide_dep_options_for_header_types' );
}

if ( ! function_exists( 'findme_elated_set_hide_dep_options_header_vertical' ) ) {
	/**
	 * This function is used to hide all containers/panels for admin options when this header type is selected
	 */
	function findme_elated_set_hide_dep_options_header_vertical( $hide_dep_options ) {
		$hide_dep_options[] = 'header-vertical';
		
		return $hide_dep_options;
	}
	
	// header global panel options
	add_filter( 'findme_elated_header_logo_area_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical' );
	add_filter( 'findme_elated_header_menu_area_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical' );
	add_filter( 'findme_elated_header_main_menu_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical' );
	add_filter( 'findme_elated_top_header_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical' );
	
	// header global panel meta boxes
	add_filter( 'findme_elated_header_logo_area_hide_meta_boxes', 'findme_elated_set_hide_dep_options_header_vertical' );
	add_filter( 'findme_elated_header_menu_area_hide_meta_boxes', 'findme_elated_set_hide_dep_options_header_vertical' );
	add_filter( 'findme_elated_top_header_hide_meta_boxes', 'findme_elated_set_hide_dep_options_header_vertical' );
	
	// header behavior panel options
	add_filter( 'findme_elated_header_behavior_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical' );
	add_filter( 'findme_elated_fixed_header_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical' );
	add_filter( 'findme_elated_sticky_header_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical' );
	
	// header behavior panel meta boxes
	add_filter( 'findme_elated_header_behavior_hide_meta_boxes', 'findme_elated_set_hide_dep_options_header_vertical' );
	
	// header types panel options
	add_filter( 'findme_elated_header_centered_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical' );
	add_filter( 'findme_elated_full_screen_menu_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical' );
	
	// header types panel meta boxes
	add_filter( 'findme_elated_header_centered_hide_meta_boxes', 'findme_elated_set_hide_dep_options_header_vertical' );
}