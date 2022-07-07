<?php

if ( ! function_exists( 'findme_elated_map_content_bottom_meta' ) ) {
	function findme_elated_map_content_bottom_meta() {
		$content_bottom_meta_box = findme_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'findme_elated_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Content Bottom', 'findme' ),
				'name'  => 'content_bottom_meta'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_enable_content_bottom_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'findme' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'findme' ),
				'parent'        => $content_bottom_meta_box,
				'options'       => findme_elated_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''   => '#eltd_eltd_show_content_bottom_meta_container',
						'no' => '#eltd_eltd_show_content_bottom_meta_container'
					),
					'show'       => array(
						'yes' => '#eltd_eltd_show_content_bottom_meta_container'
					)
				)
			)
		);
		
		$show_content_bottom_meta_container = findme_elated_add_admin_container(
			array(
				'parent'          => $content_bottom_meta_box,
				'name'            => 'eltd_show_content_bottom_meta_container',
				'hidden_property' => 'eltd_enable_content_bottom_area_meta',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_content_bottom_sidebar_custom_display_meta',
				'type'          => 'selectblank',
				'default_value' => '',
				'label'         => esc_html__( 'Sidebar to Display', 'findme' ),
				'description'   => esc_html__( 'Choose a content bottom sidebar to display', 'findme' ),
				'options'       => findme_elated_get_custom_sidebars(),
				'parent'        => $show_content_bottom_meta_container,
				'args' => array(
					'select2' => true
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'type'          => 'select',
				'name'          => 'eltd_content_bottom_in_grid_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Display in Grid', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will place content bottom in grid', 'findme' ),
				'options'       => findme_elated_get_yes_no_select_array(),
				'parent'        => $show_content_bottom_meta_container
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'type'        => 'color',
				'name'        => 'eltd_content_bottom_background_color_meta',
				'label'       => esc_html__( 'Background Color', 'findme' ),
				'description' => esc_html__( 'Choose a background color for content bottom area', 'findme' ),
				'parent'      => $show_content_bottom_meta_container
			)
		);
	}
	
	add_action( 'findme_elated_meta_boxes_map', 'findme_elated_map_content_bottom_meta', 71 );
}