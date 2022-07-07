<?php

if ( ! function_exists( 'findme_elated_logo_meta_box_map' ) ) {
	function findme_elated_logo_meta_box_map() {
		
		$logo_meta_box = findme_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'findme_elated_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Logo', 'findme' ),
				'name'  => 'logo_meta'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'findme' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'findme' ),
				'parent'      => $logo_meta_box
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'findme' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'findme' ),
				'parent'      => $logo_meta_box
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'findme' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'findme' ),
				'parent'      => $logo_meta_box
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'findme' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'findme' ),
				'parent'      => $logo_meta_box
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'findme' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'findme' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'findme_elated_meta_boxes_map', 'findme_elated_logo_meta_box_map', 47 );
}