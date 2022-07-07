<?php

if ( ! function_exists( 'findme_elated_get_hide_dep_for_header_centered_meta_boxes' ) ) {
	function findme_elated_get_hide_dep_for_header_centered_meta_boxes() {
		$hide_dep_options = apply_filters( 'findme_elated_header_centered_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'findme_elated_header_centered_meta_map' ) ) {
	function findme_elated_header_centered_meta_map( $parent ) {
		$hide_dep_options = findme_elated_get_hide_dep_for_header_centered_meta_boxes();
		
		findme_elated_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'text',
				'name'            => 'logo_wrapper_padding_header_centered',
				'default_value'   => '',
				'label'           => esc_html__( 'Logo Padding', 'findme' ),
				'description'     => esc_html__( 'Insert padding in format: 0px 0px 1px 0px', 'findme' ),
				'args'            => array(
					'col_width' => 3
				),
				'hidden_property' => 'eltd_header_type_meta',
				'hidden_values'   => $hide_dep_options
			)
		);
	}
	
	add_action( 'findme_elated_header_logo_area_additional_meta_boxes_map', 'findme_elated_header_centered_meta_map', 10, 1 );
}