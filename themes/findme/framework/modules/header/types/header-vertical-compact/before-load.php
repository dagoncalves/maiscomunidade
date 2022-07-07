<?php

if ( ! function_exists( 'findme_elated_set_header_vertical_compact_type_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function findme_elated_set_header_vertical_compact_type_global_option( $header_types ) {
		$header_types['header-vertical-compact'] = array(
			'image' => ELATED_FRAMEWORK_HEADER_TYPES_ROOT . '/header-vertical-compact/assets/img/header-vertical-compact.png',
			'label' => esc_html__( 'Vertical - Compact', 'findme' )
		);
		
		return $header_types;
	}
	
	add_filter( 'findme_elated_header_type_global_option', 'findme_elated_set_header_vertical_compact_type_global_option' );
}

if ( ! function_exists( 'findme_elated_set_header_vertical_compact_type_meta_boxes_option' ) ) {
	/**
	 * This function set header type value for header meta boxes map
	 */
	function findme_elated_set_header_vertical_compact_type_meta_boxes_option( $header_type_options ) {
		$header_type_options['header-vertical-compact'] = esc_html__( 'Vertical - Compact', 'findme' );
		
		return $header_type_options;
	}
	
	add_filter( 'findme_elated_header_type_meta_boxes', 'findme_elated_set_header_vertical_compact_type_meta_boxes_option' );
}

if ( ! function_exists( 'findme_elated_set_show_dep_options_for_vertical_compact' ) ) {
	/**
	 * This function set show container values when this header type is selected for header type global option
	 */
	function findme_elated_set_show_dep_options_for_vertical_compact( $show_dep_options ) {
		$show_containers   = array();
		$show_containers[] = '#eltd_header_vertical_area_container';
		$show_containers[] = '#eltd_panel_vertical_main_menu';
		
		$show_containers = apply_filters( 'findme_elated_show_dep_options_for_header_vertical_compact', $show_containers );
		
		$show_dep_options['header-vertical-compact'] = implode( ',', $show_containers );
		
		return $show_dep_options;
	}
	
	add_filter( 'findme_elated_header_type_show_global_option', 'findme_elated_set_show_dep_options_for_vertical_compact' );
}

if ( ! function_exists( 'findme_elated_set_hide_dep_options_for_vertical_compact' ) ) {
	/**
	 * This function set hide container values when this header type is selected for header type global option
	 */
	function findme_elated_set_hide_dep_options_for_vertical_compact( $hide_dep_options ) {
		$hide_containers   = array();
		$hide_containers[] = '#eltd_header_behaviour';
		$hide_containers[] = '#eltd_menu_area_container';
		$hide_containers[] = '#eltd_logo_area_container';
		$hide_containers[] = '#eltd_panel_fullscreen_menu';
		$hide_containers[] = '#eltd_panel_main_menu';
		$hide_containers[] = '#eltd_panel_sticky_header';
		$hide_containers[] = '#eltd_panel_fixed_header';
		
		$hide_containers = apply_filters( 'findme_elated_hide_dep_options_for_header_vertical_compact', $hide_containers );
		
		$hide_dep_options['header-vertical-compact'] = implode( ',', $hide_containers );
		
		return $hide_dep_options;
	}
	
	add_filter( 'findme_elated_header_type_hide_global_option', 'findme_elated_set_hide_dep_options_for_vertical_compact' );
}

if ( ! function_exists( 'findme_elated_set_show_dep_options_for_header_vertical_compact_meta_boxes' ) ) {
	/**
	 * This function set show container values when this header type is selected for header type meta boxes map
	 */
	function findme_elated_set_show_dep_options_for_header_vertical_compact_meta_boxes( $show_dep_options ) {
		$show_containers   = array();
		$show_containers[] = '#eltd_header_vertical_area_container';
		
		$show_containers = apply_filters( 'findme_elated_show_dep_options_for_header_vertical_compact_meta_boxes', $show_containers );
		
		$show_dep_options['header-vertical-compact'] = implode( ',', $show_containers );
		
		return $show_dep_options;
	}
	
	add_filter( 'findme_elated_header_type_show_meta_boxes', 'findme_elated_set_show_dep_options_for_header_vertical_compact_meta_boxes' );
}

if ( ! function_exists( 'findme_elated_set_hide_dep_options_for_header_vertical_compact_meta_boxes' ) ) {
	/**
	 * This function set hide container values when this header type is selected for header type meta boxes map
	 */
	function findme_elated_set_hide_dep_options_for_header_vertical_compact_meta_boxes( $hide_dep_options ) {
		$hide_containers   = array();
		$hide_containers[] = '#eltd_logo_area_container';
		$hide_containers[] = '#eltd_menu_area_container';
		
		$hide_containers = apply_filters( 'findme_elated_hide_dep_options_for_header_vertical_compact_meta_boxes', $hide_containers );
		
		$hide_dep_options['header-vertical-compact'] = implode( ',', $hide_containers );
		
		return $hide_dep_options;
	}
	
	add_filter( 'findme_elated_header_type_hide_meta_boxes', 'findme_elated_set_hide_dep_options_for_header_vertical_compact_meta_boxes' );
}

if ( ! function_exists( 'findme_elated_set_hide_dep_options_header_vertical_compact' ) ) {
	/**
	 * This function is used to hide all containers/panels for admin options when this header type is selected
	 */
	function findme_elated_set_hide_dep_options_header_vertical_compact( $hide_dep_options ) {
		$hide_dep_options[] = 'header-vertical-compact';
		
		return $hide_dep_options;
	}
	
	// header global panel options
	add_filter( 'findme_elated_header_logo_area_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical_compact' );
	add_filter( 'findme_elated_header_menu_area_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical_compact' );
	add_filter( 'findme_elated_header_main_menu_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical_compact' );
	add_filter( 'findme_elated_top_header_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical_compact' );
	
	// header global panel meta boxes
	add_filter( 'findme_elated_header_logo_area_hide_meta_boxes', 'findme_elated_set_hide_dep_options_header_vertical_compact' );
	add_filter( 'findme_elated_header_menu_area_hide_meta_boxes', 'findme_elated_set_hide_dep_options_header_vertical_compact' );
	add_filter( 'findme_elated_top_header_hide_meta_boxes', 'findme_elated_set_hide_dep_options_header_vertical_compact' );
	
	// header behavior panel options
	add_filter( 'findme_elated_header_behavior_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical_compact' );
	add_filter( 'findme_elated_fixed_header_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical_compact' );
	add_filter( 'findme_elated_sticky_header_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical_compact' );
	
	// header behavior panel meta boxes
	add_filter( 'findme_elated_header_behavior_hide_meta_boxes', 'findme_elated_set_hide_dep_options_header_vertical_compact' );
	
	// header types panel options
	add_filter( 'findme_elated_header_centered_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical_compact' );
	add_filter( 'findme_elated_full_screen_menu_hide_global_option', 'findme_elated_set_hide_dep_options_header_vertical_compact' );
	
	// header types panel meta boxes
	add_filter( 'findme_elated_header_centered_hide_meta_boxes', 'findme_elated_set_hide_dep_options_header_vertical_compact' );
}