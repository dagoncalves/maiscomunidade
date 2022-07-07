<?php

if ( ! function_exists( 'findme_elated_map_post_audio_meta' ) ) {
	function findme_elated_map_post_audio_meta() {
		$audio_post_format_meta_box = findme_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'findme' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'findme' ),
				'description'   => esc_html__( 'Choose audio type', 'findme' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'findme' ),
					'self'            => esc_html__( 'Self Hosted', 'findme' )
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'social_networks' => '#eltd_eltd_audio_self_hosted_container',
						'self'            => '#eltd_eltd_audio_embedded_container'
					),
					'show'       => array(
						'social_networks' => '#eltd_eltd_audio_embedded_container',
						'self'            => '#eltd_eltd_audio_self_hosted_container'
					)
				)
			)
		);
		
		$eltd_audio_embedded_container = findme_elated_add_admin_container(
			array(
				'parent'          => $audio_post_format_meta_box,
				'name'            => 'eltd_audio_embedded_container',
				'hidden_property' => 'eltd_audio_type_meta',
				'hidden_value'    => 'self'
			)
		);
		
		$eltd_audio_self_hosted_container = findme_elated_add_admin_container(
			array(
				'parent'          => $audio_post_format_meta_box,
				'name'            => 'eltd_audio_self_hosted_container',
				'hidden_property' => 'eltd_audio_type_meta',
				'hidden_value'    => 'social_networks'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'findme' ),
				'description' => esc_html__( 'Enter audio URL', 'findme' ),
				'parent'      => $eltd_audio_embedded_container,
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'findme' ),
				'description' => esc_html__( 'Enter audio link', 'findme' ),
				'parent'      => $eltd_audio_self_hosted_container,
			)
		);
	}
	
	add_action( 'findme_elated_meta_boxes_map', 'findme_elated_map_post_audio_meta', 23 );
}