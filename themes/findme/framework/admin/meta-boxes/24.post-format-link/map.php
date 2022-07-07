<?php

if ( ! function_exists( 'findme_elated_map_post_link_meta' ) ) {
	function findme_elated_map_post_link_meta() {
		$link_post_format_meta_box = findme_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'findme' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'findme' ),
				'description' => esc_html__( 'Enter link', 'findme' ),
				'parent'      => $link_post_format_meta_box,
			
			)
		);
	}
	
	add_action( 'findme_elated_meta_boxes_map', 'findme_elated_map_post_link_meta', 24 );
}