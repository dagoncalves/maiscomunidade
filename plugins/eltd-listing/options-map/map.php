<?php

if ( ! function_exists('eltd_listing_options_map') ) {

	function eltd_listing_options_map() {

		findme_elated_add_admin_page( array(
			'slug'  => '_listing',
			'title' =>  esc_html__('Listing', 'eltd-listing'),
			'icon'  => 'fa fa-camera-retro'
		) );

		$panel_archive = findme_elated_add_admin_panel( array(
			'title' => esc_html__('Archive', 'eltd-listing'),
			'name'  => 'panel_archive',
			'page'  => '_listing'
		) );

		findme_elated_add_admin_field(
			array(
				'parent'		=> $panel_archive,
				'type'			=> 'text',
				'name'			=> 'listings_per_page',
				'default_value'	=> '',
				'label'			=> esc_html__('Number of listings per page', 'eltd-listing'),
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		findme_elated_add_admin_field(
			array(
				'parent'		=> $panel_archive,
				'type'			=> 'yesno',
				'name'			=> 'listings_archive_load_more',
				'default_value'	=> 'yes',
				'label'			=> esc_html__('Load More on Archive Pages', 'eltd-listing'),
				'description'	=> '',
			)
		);

        $panel_single = findme_elated_add_admin_panel( array(
            'title' => esc_html__('Single', 'eltd-listing'),
            'name'  => 'panel_single',
            'page'  => '_listing'
        ) );

        findme_elated_add_admin_field(
            array(
                'parent'		=> $panel_single,
                'type'			=> 'text',
                'name'			=> 'listing_item_single_slug',
                'default_value'	=> '',
                'label'			=> esc_html__('Listing Single Slug', 'eltd-listing'),
                'description'   => esc_html__('Enter if you wish to use a different Single Listing slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)','eltd-listing'),
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

        findme_elated_add_admin_field(
            array(
                'parent'		=> $panel_single,
                'type'			=> 'yesno',
                'name'			=> 'listing_content_bottom',
                'default_value'	=> 'yes',
                'label'			=> esc_html__('Enable content bottom area', 'eltd-listing'),
                'description'	=> '',
            )
        );

		findme_elated_add_admin_field(
			array(
				'parent'		=> $panel_single,
				'type'			=> 'select',
				'name'			=> 'listing_website_target',
				'default_value'	=> '_self',
				'label'			=> esc_html__('Website Link Target', 'eltd-listing'),
				'options'		=> array(
					'_self'		=> esc_html__('Same Window', 'eltd-listing'),
					'_blank'	=> esc_html__('New Window', 'eltd-listing')
				),
				'description'	=> '',
			)
		);

		$panel_maps = findme_elated_add_admin_panel( array(
			'title' => 'Maps',
			'name'  => 'panel_maps',
			'page'  => '_listing'
		) );

		findme_elated_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'textarea',
				'name'			=> 'listing_map_style',
				'default_value'	=> '',
				'label'			=> esc_html__('Maps Style', 'eltd-listing'),
				'description'	=> esc_html__('Insert map style json', 'eltd-listing'),
			)
		);

		findme_elated_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'yesno',
				'name'			=> 'listing_maps_scrollable',
				'default_value'	=> 'yes',
				'label'			=> esc_html__('Scrollable Maps', 'eltd-listing'),
				'description'	=> '',
			)
		);

		findme_elated_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'yesno',
				'name'			=> 'listing_maps_draggable',
				'default_value'	=> 'yes',
				'label'			=> esc_html__('Draggable Maps', 'eltd-listing'),
				'description'	=> '',
			)
		);

		findme_elated_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'yesno',
				'name'			=> 'listing_maps_street_view_control',
				'default_value'	=> 'yes',
				'label'			=> esc_html__('Maps Street View Controls', 'eltd-listing'),
				'description'	=> '',
			)
		);

		findme_elated_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'yesno',
				'name'			=> 'listing_maps_zoom_control',
				'default_value'	=> 'yes',
				'label'			=> esc_html__('Maps Zoom Control', 'eltd-listing'),
				'description'	=> '',
			)
		);

		findme_elated_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'yesno',
				'name'			=> 'listing_maps_type_control',
				'default_value'	=> 'yes',
				'label'			=> esc_html__('Maps Type Control', 'eltd-listing'),
				'description'	=> '',
			)
		);

        $panel_terms = findme_elated_add_admin_panel( array(
            'title' => 'Terms And Conditions',
            'name'  => 'panel_terms',
            'page'  => '_listing'
        ) );

        findme_elated_add_admin_field(
            array(
                'parent'		=> $panel_terms,
                'type'			=> 'text',
                'name'			=> 'listing_item_terms_link',
                'default_value'	=> '',
                'label'			=> esc_html__('Terms And Conditions Page URL', 'eltd-listing'),
                'description'   => esc_html__('Enter the page URL with terms and conditions.','eltd-listing')
            )
        );


	}
	add_action( 'findme_elated_options_map', 'eltd_listing_options_map', 13);
}