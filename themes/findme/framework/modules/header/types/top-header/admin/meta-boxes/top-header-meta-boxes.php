<?php

if ( ! function_exists( 'findme_elated_get_hide_dep_for_top_header_area_meta_boxes' ) ) {
	function findme_elated_get_hide_dep_for_top_header_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'findme_elated_top_header_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'findme_elated_header_top_area_meta_options_map' ) ) {
	function findme_elated_header_top_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = findme_elated_get_hide_dep_for_top_header_area_meta_boxes();
		
		$top_header_container = findme_elated_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'top_header_container',
				'parent'          => $header_meta_box,
				'hidden_property' => 'eltd_header_type_meta',
				'hidden_values'   => $hide_dep_options
			)
		);
		
		findme_elated_add_admin_section_title(
			array(
				'parent' => $top_header_container,
				'name'   => 'top_area_style',
				'title'  => esc_html__( 'Top Area', 'findme' )
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_top_bar_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Header Top Bar', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will show header top bar area', 'findme' ),
				'parent'        => $top_header_container,
				'options'       => findme_elated_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#eltd_top_bar_container_no_style',
						'no'  => '#eltd_top_bar_container_no_style',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#eltd_top_bar_container_no_style'
					)
				)
			)
		);
		
		$top_bar_container = findme_elated_add_admin_container_no_style(
			array(
				'name'            => 'top_bar_container_no_style',
				'parent'          => $top_header_container,
				'hidden_property' => 'eltd_top_bar_meta',
				'hidden_value'    => 'no',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_top_bar_in_grid_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Top Bar In Grid', 'findme' ),
				'description'   => esc_html__( 'Set top bar content to be in grid', 'findme' ),
				'parent'        => $top_bar_container,
				'default_value' => '',
				'options'       => findme_elated_get_yes_no_select_array()
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'   => 'eltd_top_bar_background_color_meta',
				'type'   => 'color',
				'label'  => esc_html__( 'Top Bar Background Color', 'findme' ),
				'parent' => $top_bar_container
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_top_bar_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Top Bar Background Color Transparency', 'findme' ),
				'description' => esc_html__( 'Set top bar background color transparenct. Value should be between 0 and 1', 'findme' ),
				'parent'      => $top_bar_container,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_top_bar_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Top Bar Border', 'findme' ),
				'description'   => esc_html__( 'Set border on top bar', 'findme' ),
				'parent'        => $top_bar_container,
				'default_value' => '',
				'options'       => findme_elated_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#eltd_top_bar_border_container',
						'no'  => '#eltd_top_bar_border_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#eltd_top_bar_border_container'
					)
				)
			)
		);
		
		$top_bar_border_container = findme_elated_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'top_bar_border_container',
				'parent'          => $top_bar_container,
				'hidden_property' => 'eltd_top_bar_border_meta',
				'hidden_value'    => 'no',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_top_bar_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'findme' ),
				'description' => esc_html__( 'Choose color for top bar border', 'findme' ),
				'parent'      => $top_bar_border_container
			)
		);
	}
	
	add_action( 'findme_elated_additional_header_area_meta_boxes_map', 'findme_elated_header_top_area_meta_options_map', 10, 1 );
}