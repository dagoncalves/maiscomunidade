<?php

if ( ! function_exists( 'findme_elated_map_sidebar_meta' ) ) {
	function findme_elated_map_sidebar_meta() {
		$eltd_sidebar_meta_box = findme_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'findme_elated_set_scope_for_meta_boxes', array( 'page' ) ),
				'title' => esc_html__( 'Sidebar', 'findme' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Layout', 'findme' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'findme' ),
				'parent'      => $eltd_sidebar_meta_box,
				'options'     => array(
					''                 => esc_html__( 'Default', 'findme' ),
					'no-sidebar'       => esc_html__( 'No Sidebar', 'findme' ),
					'sidebar-33-right' => esc_html__( 'Sidebar 1/3 Right', 'findme' ),
					'sidebar-25-right' => esc_html__( 'Sidebar 1/4 Right', 'findme' ),
					'sidebar-33-left'  => esc_html__( 'Sidebar 1/3 Left', 'findme' ),
					'sidebar-25-left'  => esc_html__( 'Sidebar 1/4 Left', 'findme' )
				)
			)
		);
		
		$eltd_custom_sidebars = findme_elated_get_custom_sidebars();
		if ( count( $eltd_custom_sidebars ) > 0 ) {
			findme_elated_create_meta_box_field(
				array(
					'name'        => 'eltd_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'findme' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'findme' ),
					'parent'      => $eltd_sidebar_meta_box,
					'options'     => $eltd_custom_sidebars,
					'args'        => array(
						'select2'	=> true
					)
				)
			);
		}
	}
	
	add_action( 'findme_elated_meta_boxes_map', 'findme_elated_map_sidebar_meta', 31 );
}