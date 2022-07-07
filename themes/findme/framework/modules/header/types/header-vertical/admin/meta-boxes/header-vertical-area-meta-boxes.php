<?php

if ( ! function_exists( 'findme_elated_get_hide_dep_for_header_vertical_area_meta_boxes' ) ) {
	function findme_elated_get_hide_dep_for_header_vertical_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'findme_elated_header_vertical_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'findme_elated_header_vertical_area_meta_options_map' ) ) {
	function findme_elated_header_vertical_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = findme_elated_get_hide_dep_for_header_vertical_area_meta_boxes();
		
		$header_vertical_area_meta_container = findme_elated_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'header_vertical_area_container',
				'hidden_property' => 'eltd_header_type_meta',
				'hidden_values'   => $hide_dep_options
			)
		);
		
		findme_elated_add_admin_section_title(
			array(
				'parent' => $header_vertical_area_meta_container,
				'name'   => 'vertical_area_style',
				'title'  => esc_html__( 'Vertical Area Style', 'findme' )
			)
		);
		
		$findme_custom_sidebars = findme_elated_get_custom_sidebars();
		if ( count( $findme_custom_sidebars ) > 0 ) {
			findme_elated_create_meta_box_field(
				array(
					'name'        => 'eltd_custom_vertical_area_sidebar_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Widget Area in Vertical area', 'findme' ),
					'description' => esc_html__( 'Choose custom widget area to display in vertical menu"', 'findme' ),
					'parent'      => $header_vertical_area_meta_container,
					'options'     => $findme_custom_sidebars
				)
			);
		}
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_vertical_header_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'findme' ),
				'description' => esc_html__( 'Set background color for vertical menu', 'findme' ),
				'parent'      => $header_vertical_area_meta_container
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_vertical_header_background_image_meta',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image', 'findme' ),
				'description'   => esc_html__( 'Set background image for vertical menu', 'findme' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_disable_vertical_header_background_image_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Background Image', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will hide background image in Vertical Menu', 'findme' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_vertical_header_shadow_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Shadow', 'findme' ),
				'description'   => esc_html__( 'Set shadow on vertical menu', 'findme' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => findme_elated_get_yes_no_select_array()
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_vertical_header_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Vertical Area Border', 'findme' ),
				'description'   => esc_html__( 'Set border on vertical area', 'findme' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => findme_elated_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#eltd_vertical_header_border_container',
						'no'  => '#eltd_vertical_header_border_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#eltd_vertical_header_border_container'
					)
				)
			)
		);
		
		$vertical_header_border_container = findme_elated_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'vertical_header_border_container',
				'parent'          => $header_vertical_area_meta_container,
				'hidden_property' => 'eltd_vertical_header_border_meta',
				'hidden_value'    => 'no',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_vertical_header_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'findme' ),
				'description' => esc_html__( 'Choose color of border', 'findme' ),
				'parent'      => $vertical_header_border_container
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_vertical_header_center_content_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Center Content', 'findme' ),
				'description'   => esc_html__( 'Set content in vertical center', 'findme' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => findme_elated_get_yes_no_select_array()
			)
		);
	}
	
	add_action( 'findme_elated_additional_header_area_meta_boxes_map', 'findme_elated_header_vertical_area_meta_options_map', 10, 1 );
}