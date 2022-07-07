<?php

if ( ! function_exists( 'findme_elated_map_footer_meta' ) ) {
	function findme_elated_map_footer_meta() {
		$footer_meta_box = findme_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'findme_elated_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Footer', 'findme' ),
				'name'  => 'footer_meta'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_disable_footer_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Footer for this Page', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'findme' ),
				'parent'        => $footer_meta_box
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_show_footer_top_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Footer Top', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'findme' ),
				'parent'        => $footer_meta_box,
				'options'       => findme_elated_get_yes_no_select_array()
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_show_footer_bottom_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Footer Bottom', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'findme' ),
				'parent'        => $footer_meta_box,
				'options'       => findme_elated_get_yes_no_select_array()
			)
		);
        findme_elated_create_meta_box_field(
            array(
                'name' => 'eltd_show_footer_image_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Footer Background Image For This Page', 'findme'),
                'description' => esc_html__('Enabling this option will show footer background image for this page', 'findme'),
                'parent' => $footer_meta_box,
                'options' => array(
                    '' => '',
                    'no' => esc_html__('No', 'findme'),
                    'yes' => esc_html__('Yes', 'findme')
                )
            )
        );
        findme_elated_create_meta_box_field(
            array(
                'name' => 'eltd_footer_background_image_meta',
                'type' => 'image',
                'default_value' => '',
                'label' => esc_html__('Footer Background Image for this Page', 'findme'),
                'parent' => $footer_meta_box,
            )
        );
	}
	
	add_action( 'findme_elated_meta_boxes_map', 'findme_elated_map_footer_meta', 70 );
}