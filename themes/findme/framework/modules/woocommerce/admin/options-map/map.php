<?php

if ( ! function_exists('findme_elated_woocommerce_options_map') ) {

	/**
	 * Add Woocommerce options page
	 */
	function findme_elated_woocommerce_options_map() {

		findme_elated_add_admin_page(
			array(
				'slug' => '_woocommerce_page',
				'title' => esc_html__('Woocommerce', 'findme'),
				'icon' => 'fa fa-shopping-cart'
			)
		);

		/**
		 * Product List Settings
		 */
		$panel_product_list = findme_elated_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_product_list',
				'title' => esc_html__('Product List', 'findme')
			)
		);

		findme_elated_add_admin_field(array(
			'name'        	=> 'eltd_woo_product_list_columns',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Product List Columns', 'findme'),
			'default_value'	=> 'eltd-woocommerce-columns-4',
			'description' 	=> esc_html__('Choose number of columns for product listing and related products on single product', 'findme'),
			'options'		=> array(
				'eltd-woocommerce-columns-3' => esc_html__('3 Columns', 'findme'),
				'eltd-woocommerce-columns-4' => esc_html__('4 Columns', 'findme')
			),
			'parent'      	=> $panel_product_list,
		));
		
		findme_elated_add_admin_field(array(
			'name'        	=> 'eltd_woo_product_list_columns_space',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Space Between Products', 'findme'),
			'default_value'	=> 'eltd-woo-normal-space',
			'description' 	=> esc_html__('Select space between products for product listing and related products on single product', 'findme'),
			'options'		=> array(
				'eltd-woo-normal-space' => esc_html__('Normal', 'findme'),
				'eltd-woo-small-space'  => esc_html__('Small', 'findme'),
				'eltd-woo-no-space'     => esc_html__('No Space', 'findme')
			),
			'parent'      	=> $panel_product_list,
		));
		
		findme_elated_add_admin_field(array(
			'name'        	=> 'eltd_woo_product_list_info_position',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Product Info Position', 'findme'),
			'default_value'	=> 'info_below_image',
			'description' 	=> esc_html__('Select product info position for product listing and related products on single product', 'findme'),
			'options'		=> array(
				'info_below_image'    => esc_html__('Info Below Image', 'findme'),
				'info_on_image_hover' => esc_html__('Info On Image Hover', 'findme')
			),
			'parent'      	=> $panel_product_list,
		));

		findme_elated_add_admin_field(array(
			'name'        	=> 'eltd_woo_products_per_page',
			'type'        	=> 'text',
			'label'       	=> esc_html__('Number of products per page', 'findme'),
			'default_value'	=> '',
			'description' 	=> esc_html__('Set number of products on shop page', 'findme'),
			'parent'      	=> $panel_product_list,
			'args' 			=> array(
				'col_width' => 3
			)
		));

		findme_elated_add_admin_field(array(
			'name'        	=> 'eltd_products_list_title_tag',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Products Title Tag', 'findme'),
			'default_value'	=> 'h4',
			'description' 	=> '',
			'options'       => findme_elated_get_title_tag(),
			'parent'      	=> $panel_product_list,
		));

		/**
		 * Single Product Settings
		 */
		$panel_single_product = findme_elated_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_single_product',
				'title' => esc_html__('Single Product', 'findme')
			)
		);
		
			findme_elated_add_admin_field(array(
				'name'          => 'woo_set_thumb_images_position',
				'type'          => 'select',
				'label'         => esc_html__('Set Thumbnail Images Position', 'findme'),
				'default_value' => 'on-left-side',
				'options'		=> array(
					'below-image'  => esc_html__('Below Featured Image', 'findme'),
					'on-left-side' => esc_html__('On The Left Side Of Featured Image', 'findme')
				),
				'parent'        => $panel_single_product
			));

			findme_elated_add_admin_field(array(
				'name'        	=> 'eltd_single_product_title_tag',
				'type'        	=> 'select',
				'label'       	=> esc_html__('Single Product Title Tag', 'findme'),
				'default_value'	=> 'h2',
				'description' 	=> '',
				'options'       => findme_elated_get_title_tag(),
				'parent'      	=> $panel_single_product,
			));

            findme_elated_add_admin_field(
                array(
                    'type' => 'select',
                    'name' => 'show_title_area_woo',
                    'default_value' => '',
                    'label'       => esc_html__('Show Title Area', 'findme'),
                    'description' => esc_html__('Enabling this option will show title area on single post pages', 'findme'),
                    'parent'      => $panel_single_product,
                    'options'     => findme_elated_get_yes_no_select_array(),
                    'args' => array(
                        'col_width' => 3
                    )
                )
            );
	}

	add_action( 'findme_elated_options_map', 'findme_elated_woocommerce_options_map', 21);
}