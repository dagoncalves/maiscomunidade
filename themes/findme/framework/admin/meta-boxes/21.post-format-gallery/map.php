<?php

if ( ! function_exists( 'findme_elated_map_post_gallery_meta' ) ) {
	
	function findme_elated_map_post_gallery_meta() {
		$gallery_post_format_meta_box = findme_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'findme' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		findme_elated_add_multiple_images_field(
			array(
				'name'        => 'eltd_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'findme' ),
				'description' => esc_html__( 'Choose your gallery images', 'findme' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'findme_elated_meta_boxes_map', 'findme_elated_map_post_gallery_meta', 21 );
}
