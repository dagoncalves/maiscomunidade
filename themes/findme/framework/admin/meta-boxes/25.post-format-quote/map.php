<?php

if ( ! function_exists( 'findme_elated_map_post_quote_meta' ) ) {
	function findme_elated_map_post_quote_meta() {
		$quote_post_format_meta_box = findme_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'findme' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'findme' ),
				'description' => esc_html__( 'Enter Quote text', 'findme' ),
				'parent'      => $quote_post_format_meta_box,
			
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'findme' ),
				'description' => esc_html__( 'Enter Quote author', 'findme' ),
				'parent'      => $quote_post_format_meta_box,
			)
		);
	}
	
	add_action( 'findme_elated_meta_boxes_map', 'findme_elated_map_post_quote_meta', 25 );
}