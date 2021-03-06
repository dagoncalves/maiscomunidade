<?php

if ( ! function_exists( 'findme_elated_header_types_meta_boxes' ) ) {
	function findme_elated_header_types_meta_boxes() {
		$header_type_options = apply_filters( 'findme_elated_header_type_meta_boxes', $header_type_options = array( '' => esc_html__( 'Default', 'findme' ) ) );
		
		return $header_type_options;
	}
}

if ( ! function_exists( 'findme_elated_get_show_dep_for_header_types_meta_boxes' ) ) {
	function findme_elated_get_show_dep_for_header_types_meta_boxes() {
		$show_dep_options = apply_filters( 'findme_elated_header_type_show_meta_boxes', $show_dep_options = array() );
		
		return $show_dep_options;
	}
}

if ( ! function_exists( 'findme_elated_get_hide_dep_for_header_types_meta_boxes' ) ) {
	function findme_elated_get_hide_dep_for_header_types_meta_boxes() {
		$hide_dep_options = apply_filters( 'findme_elated_header_type_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'findme_elated_get_hide_dep_for_header_behavior_meta_boxes' ) ) {
	function findme_elated_get_hide_dep_for_header_behavior_meta_boxes() {
		$hide_dep_options = apply_filters( 'findme_elated_header_behavior_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

foreach ( glob( ELATED_FRAMEWORK_HEADER_ROOT_DIR . '/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

foreach ( glob( ELATED_FRAMEWORK_HEADER_TYPES_ROOT_DIR . '/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'findme_elated_map_header_meta' ) ) {
	function findme_elated_map_header_meta() {
		$header_type_meta_boxes = findme_elated_header_types_meta_boxes();
		
		$set_active_global_containers_for_default_value = '#eltd_menu_area_container';
		
		$header_type_meta_boxes_show_dep = array_merge( array( '' => $set_active_global_containers_for_default_value ), findme_elated_get_show_dep_for_header_types_meta_boxes() );
		
		$get_all_containers_arrays = array_unique( explode( ' ', str_replace( ',', ' ', implode( ' ', array_values( $header_type_meta_boxes_show_dep ) ) ) ) );
		foreach ( $get_all_containers_arrays as $key => $value ) {
			if ( $value == $set_active_global_containers_for_default_value ) {
				unset( $get_all_containers_arrays[ $key ] );
			}
		}
		$get_all_containers_except_global_for_default_value = array( '' => implode( ',', $get_all_containers_arrays ) );
		
		$header_type_meta_boxes_hide_dep     = array_merge( $get_all_containers_except_global_for_default_value, findme_elated_get_hide_dep_for_header_types_meta_boxes() );
		$header_behavior_meta_boxes_hide_dep = findme_elated_get_hide_dep_for_header_behavior_meta_boxes();
		
		$header_meta_box = findme_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'findme_elated_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Header', 'findme' ),
				'name'  => 'header_meta'
			)
		);
		
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_header_type_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Choose Header Type', 'findme' ),
				'description'   => esc_html__( 'Select header type layout', 'findme' ),
				'parent'        => $header_meta_box,
				'options'       => $header_type_meta_boxes,
				'args'          => array(
					"dependence" => true,
					'show'       => $header_type_meta_boxes_show_dep,
					'hide'       => $header_type_meta_boxes_hide_dep
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_header_style_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Header Skin', 'findme' ),
				'description'   => esc_html__( 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'findme' ),
				'parent'        => $header_meta_box,
				'options'       => array(
					''             => esc_html__( 'Default', 'findme' ),
					'light-header' => esc_html__( 'Light', 'findme' ),
					'dark-header'  => esc_html__( 'Dark', 'findme' )
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'parent'          => $header_meta_box,
				'type'            => 'select',
				'name'            => 'eltd_header_behaviour_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Header Behaviour', 'findme' ),
				'description'     => esc_html__( 'Select the behaviour of header when you scroll down to page', 'findme' ),
				'options'         => array(
					''                                => esc_html__( 'Default', 'findme' ),
					'fixed-on-scroll'                 => esc_html__( 'Fixed on scroll', 'findme' ),
					'no-behavior'                     => esc_html__( 'No Behavior', 'findme' ),
					'sticky-header-on-scroll-up'      => esc_html__( 'Sticky on scroll up', 'findme' ),
					'sticky-header-on-scroll-down-up' => esc_html__( 'Sticky on scroll up/down', 'findme' )
				),
				'hidden_property' => 'eltd_header_type_meta',
				'hidden_values'   => $header_behavior_meta_boxes_hide_dep,
				'args'            => array(
					'dependence' => true,
					'show'       => array(
						''                                => '',
						'fixed-on-scroll'                 => '',
						'no-behavior'                     => '',
						'sticky-header-on-scroll-up'      => '',
						'sticky-header-on-scroll-down-up' => '#eltd_sticky_amount_container_meta_container'
					),
					'hide'       => array(
						''                                => '#eltd_sticky_amount_container_meta_container',
						'fixed-on-scroll'                 => '#eltd_sticky_amount_container_meta_container',
						'no-behavior'                     => '#eltd_sticky_amount_container_meta_container',
						'sticky-header-on-scroll-up'      => '#eltd_sticky_amount_container_meta_container',
						'sticky-header-on-scroll-down-up' => ''
					)
				)
			)
		);
		
		//additional area
		do_action( 'findme_elated_additional_header_area_meta_boxes_map', $header_meta_box );
		
		//top area
		do_action( 'findme_elated_header_top_area_meta_boxes_map', $header_meta_box );
		
		//logo area
		do_action( 'findme_elated_header_logo_area_meta_boxes_map', $header_meta_box );
		
		//menu area
		do_action( 'findme_elated_header_menu_area_meta_boxes_map', $header_meta_box );
	}
	
	add_action( 'findme_elated_meta_boxes_map', 'findme_elated_map_header_meta', 50 );
}