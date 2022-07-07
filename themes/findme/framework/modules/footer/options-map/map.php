<?php

if ( ! function_exists('findme_elated_footer_options_map') ) {
	/**
	 * Add footer options
	 */
	function findme_elated_footer_options_map() {

		findme_elated_add_admin_page(
			array(
				'slug' => '_footer_page',
				'title' => esc_html__('Footer', 'findme'),
				'icon' => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = findme_elated_add_admin_panel(
			array(
				'title' => esc_html__('Footer', 'findme'),
				'name' => 'footer',
				'page' => '_footer_page'
			)
		);

        findme_elated_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'show_footer_image',
                'default_value' => 'yes',
                'label' => esc_html__('Show Footer Background Image', 'findme'),
                'description' => esc_html__('Disabling this option will hide footer background image', 'findme'),
                'parent' => $footer_panel,
                'args' => array(
                    'dependence' => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#eltd_show_footer_bg_image'
                ),
            )
        );

        $show_footer_bg_image = findme_elated_add_admin_container(
            array(
                'name' => 'show_footer_bg_image',
                'hidden_property' => 'show_footer_image',
                'hidden_value' => 'no',
                'parent' => $footer_panel
            )
        );

        findme_elated_add_admin_field(
            array(
                'type' => 'image',
                'parent' => $show_footer_bg_image,
                'name' => 'footer_background_image',
                'default_value' => '',
                'label' => esc_html__('Footer Background Image', 'findme'),
                'description' => '',
            )
        );

		findme_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'footer_in_grid',
				'default_value' => 'yes',
				'label' => esc_html__('Footer in Grid', 'findme'),
				'description' => esc_html__('Enabling this option will place Footer content in grid', 'findme'),
				'parent' => $footer_panel,
			)
		);

		findme_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_top',
				'default_value' => 'yes',
				'label' => esc_html__('Show Footer Top', 'findme'),
				'description' => esc_html__('Enabling this option will show Footer Top area', 'findme'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_show_footer_top_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_top_container = findme_elated_add_admin_container(
			array(
				'name' => 'show_footer_top_container',
				'hidden_property' => 'show_footer_top',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);

		findme_elated_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns',
				'parent' => $show_footer_top_container,
				'default_value' => '4',
				'label' => esc_html__('Footer Top Columns', 'findme'),
				'description' => esc_html__('Choose number of columns for Footer Top area', 'findme'),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'
				)
			)
		);

		findme_elated_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label' => esc_html__('Footer Top Columns Alignment', 'findme'),
				'description' => esc_html__('Text Alignment in Footer Columns', 'findme'),
				'options' => array(
					''       => esc_html__('Default', 'findme'),
					'left'   => esc_html__('Left', 'findme'),
					'center' => esc_html__('Center', 'findme'),
					'right'  => esc_html__('Right', 'findme')
				),
				'parent' => $show_footer_top_container,
			)
		);

		findme_elated_add_admin_field(array(
			'name' => 'footer_top_background_color',
			'type' => 'color',
			'label' => esc_html__('Background Color', 'findme'),
			'description' => esc_html__('Set background color for top footer area', 'findme'),
			'parent' => $show_footer_top_container
		));

		findme_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_bottom',
				'default_value' => 'yes',
				'label' => esc_html__('Show Footer Bottom', 'findme'),
				'description' => esc_html__('Enabling this option will show Footer Bottom area', 'findme'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_show_footer_bottom_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_bottom_container = findme_elated_add_admin_container(
			array(
				'name' => 'show_footer_bottom_container',
				'hidden_property' => 'show_footer_bottom',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);

		findme_elated_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_bottom_columns',
				'default_value' => '4',
				'label' => esc_html__('Footer Bottom Columns', 'findme'),
				'description' => esc_html__('Choose number of columns for Footer Bottom area', 'findme'),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3'
				),
				'parent' => $show_footer_bottom_container,
			)
		);

		findme_elated_add_admin_field(array(
			'name' => 'footer_bottom_background_color',
			'type' => 'color',
			'label' => esc_html__('Background Color', 'findme'),
			'description' => esc_html__('Set background color for bottom footer area', 'findme'),
			'parent' => $show_footer_bottom_container
		));
	}

	add_action( 'findme_elated_options_map', 'findme_elated_footer_options_map', 11);
}