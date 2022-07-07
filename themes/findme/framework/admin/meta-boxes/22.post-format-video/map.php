<?php

if ( ! function_exists( 'findme_elated_map_post_video_meta' ) ) {
	function findme_elated_map_post_video_meta() {
		$video_post_format_meta_box = findme_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'findme' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'findme' ),
				'description'   => esc_html__( 'Choose video type', 'findme' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'findme' ),
					'self'            => esc_html__( 'Self Hosted', 'findme' )
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'social_networks' => '#eltd_eltd_video_self_hosted_container',
						'self'            => '#eltd_eltd_video_embedded_container'
					),
					'show'       => array(
						'social_networks' => '#eltd_eltd_video_embedded_container',
						'self'            => '#eltd_eltd_video_self_hosted_container'
					)
				)
			)
		);
		
		$eltd_video_embedded_container = findme_elated_add_admin_container(
			array(
				'parent'          => $video_post_format_meta_box,
				'name'            => 'eltd_video_embedded_container',
				'hidden_property' => 'eltd_video_type_meta',
				'hidden_value'    => 'self'
			)
		);
		
		$eltd_video_self_hosted_container = findme_elated_add_admin_container(
			array(
				'parent'          => $video_post_format_meta_box,
				'name'            => 'eltd_video_self_hosted_container',
				'hidden_property' => 'eltd_video_type_meta',
				'hidden_value'    => 'social_networks'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'findme' ),
				'description' => esc_html__( 'Enter Video URL', 'findme' ),
				'parent'      => $eltd_video_embedded_container,
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'findme' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'findme' ),
				'parent'      => $eltd_video_self_hosted_container,
			)
		);
	}
	
	add_action( 'findme_elated_meta_boxes_map', 'findme_elated_map_post_video_meta', 22 );
}