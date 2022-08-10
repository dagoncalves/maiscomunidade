<?php

if ( ! function_exists('findme_elated_portfolio_options_map') ) {
	function findme_elated_portfolio_options_map() {

		findme_elated_add_admin_page(array(
			'slug'  => '_portfolio',
			'title' => esc_html__('Portfolio', 'eltd-core'),
			'icon'  => 'fa fa-camera-retro'
		));

		$panel_archive = findme_elated_add_admin_panel(array(
			'title' => esc_html__('Portfolio Archive', 'eltd-core'),
			'name'  => 'panel_portfolio_archive',
			'page'  => '_portfolio'
		));

		findme_elated_add_admin_field(array(
			'name'        => 'portfolio_archive_number_of_items',
			'type'        => 'text',
			'label'       => esc_html__('Number of Items', 'eltd-core'),
			'description' => esc_html__('Set number of items for your portfolio list on archive pages. Default value is 12', 'eltd-core'),
			'parent'      => $panel_archive,
			'args'        => array(
				'col_width' => 3
			)
		));

		findme_elated_add_admin_field(array(
			'name'        => 'portfolio_archive_number_of_columns',
			'type'        => 'select',
			'label'       => esc_html__('Number of Columns', 'eltd-core'),
			'default_value' => '4',
			'description' => esc_html__('Set number of columns for your portfolio list on archive pages. Default value is 4 columns', 'eltd-core'),
			'parent'      => $panel_archive,
			'options'     => array(
				'2' => esc_html__('2 Columns', 'eltd-core'),
				'3' => esc_html__('3 Columns', 'eltd-core'),
				'4' => esc_html__('4 Columns', 'eltd-core'),
				'5' => esc_html__('5 Columns', 'eltd-core')
			)
		));

		findme_elated_add_admin_field(array(
			'name'        => 'portfolio_archive_space_between_items',
			'type'        => 'select',
			'label'       => esc_html__('Space Between Items', 'eltd-core'),
			'default_value' => 'normal',
			'description' => esc_html__('Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'eltd-core'),
			'parent'      => $panel_archive,
			'options'     => array(
				'normal'    => esc_html__('Normal', 'eltd-core'),
				'small'     => esc_html__('Small', 'eltd-core'),
				'tiny'      => esc_html__('Tiny', 'eltd-core'),
				'no'        => esc_html__('No Space', 'eltd-core')
			)
		));

		findme_elated_add_admin_field(array(
			'name'        => 'portfolio_archive_image_size',
			'type'        => 'select',
			'label'       => esc_html__('Image Proportions', 'eltd-core'),
			'default_value' => 'landscape',
			'description' => esc_html__('Set image proportions for your portfolio list on archive pages. Default value is landscape', 'eltd-core'),
			'parent'      => $panel_archive,
			'options'     => array(
				'full'      => esc_html__('Original', 'eltd-core'),
				'landscape' => esc_html__('Landscape', 'eltd-core'),
				'portrait'  => esc_html__('Portrait', 'eltd-core'),
				'square'    => esc_html__('Square', 'eltd-core')
			)
		));
		
		findme_elated_add_admin_field(array(
			'name'        => 'portfolio_archive_item_layout',
			'type'        => 'select',
			'label'       => esc_html__('Item Style', 'eltd-core'),
			'default_value' => 'standard-shader',
			'description' => esc_html__('Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'eltd-core'),
			'parent'      => $panel_archive,
			'options'     => array(
				'standard-shader' => esc_html__('Standard - Shader', 'eltd-core'),
				'gallery-overlay' => esc_html__('Gallery - Overlay', 'eltd-core')
			)
		));

		$panel = findme_elated_add_admin_panel(array(
			'title' => esc_html__('Portfolio Single', 'eltd-core'),
			'name'  => 'panel_portfolio_single',
			'page'  => '_portfolio'
		));

		findme_elated_add_admin_field(array(
			'name'          => 'portfolio_single_template',
			'type'          => 'select',
			'label'         => esc_html__('Portfolio Type', 'eltd-core'),
			'default_value'	=> 'small-images',
			'description'   => esc_html__('Choose a default type for Single Project pages', 'eltd-core'),
			'parent'        => $panel,
			'options'       => array(
				'huge-images'       => esc_html__('Portfolio Full Width Images', 'eltd-core'),
				'images'            => esc_html__('Portfolio Images', 'eltd-core'),
				'small-images'      => esc_html__('Portfolio Small Images', 'eltd-core'),
				'slider'            => esc_html__('Portfolio Slider', 'eltd-core'),
				'small-slider'      => esc_html__('Portfolio Small Slider', 'eltd-core'),
				'gallery'           => esc_html__('Portfolio Gallery', 'eltd-core'),
				'small-gallery'     => esc_html__('Portfolio Small Gallery', 'eltd-core'),
				'masonry'           => esc_html__('Portfolio Masonry', 'eltd-core'),
				'small-masonry'     => esc_html__('Portfolio Small Masonry', 'eltd-core'),
				'custom'            => esc_html__('Portfolio Custom', 'eltd-core'),
				'full-width-custom' => esc_html__('Portfolio Full Width Custom', 'eltd-core')
			),
			'args' => array(
				'dependence' => true,
				'show' => array(
					'huge-images'       => '',
					'images'            => '',
					'small-images'      => '',
					'slider'            => '',
					'small-slider'      => '',
					'gallery'           => '#eltd_portfolio_gallery_container',
					'small-gallery'     => '#eltd_portfolio_gallery_container',
					'masonry'           => '#eltd_portfolio_masonry_container',
					'small-masonry'     => '#eltd_portfolio_masonry_container',
					'custom'            => '',
					'full-width-custom' => ''
				),
				'hide' => array(
					'huge-images'       => '#eltd_portfolio_gallery_container, #eltd_portfolio_masonry_container',
					'images'            => '#eltd_portfolio_gallery_container, #eltd_portfolio_masonry_container',
					'small-images'      => '#eltd_portfolio_gallery_container, #eltd_portfolio_masonry_container',
					'slider'            => '#eltd_portfolio_gallery_container, #eltd_portfolio_masonry_container',
					'small-slider'      => '#eltd_portfolio_gallery_container, #eltd_portfolio_masonry_container',
					'gallery'           => '#eltd_portfolio_masonry_container',
					'small-gallery'     => '#eltd_portfolio_masonry_container',
					'masonry'           => '#eltd_portfolio_gallery_container',
					'small-masonry'     => '#eltd_portfolio_gallery_container',
					'custom'            => '#eltd_portfolio_gallery_container, #eltd_portfolio_masonry_container',
					'full-width-custom' => '#eltd_portfolio_gallery_container, #eltd_portfolio_masonry_container'
				)
			)
		));
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = findme_elated_add_admin_container(array(
			'parent'          => $panel,
			'name'            => 'portfolio_gallery_container',
			'hidden_property' => 'portfolio_single_template',
			'hidden_values' => array(
				'huge-images',
				'images',
				'small-images',
				'slider',
				'small-slider',
				'masonry',
				'small-masonry',
				'custom',
				'full-width-custom'
			)
		));
		
			findme_elated_add_admin_field(array(
				'name'        => 'portfolio_single_gallery_columns_number',
				'type'        => 'select',
				'label'       => esc_html__('Number of Columns', 'eltd-core'),
				'default_value' => 'three',
				'description' => esc_html__('Set number of columns for portfolio gallery type', 'eltd-core'),
				'parent'      => $portfolio_gallery_container,
				'options'     => array(
					'two'   => esc_html__('2 Columns', 'eltd-core'),
					'three' => esc_html__('3 Columns', 'eltd-core'),
					'four'  => esc_html__('4 Columns', 'eltd-core')
				)
			));
		
			findme_elated_add_admin_field(array(
				'name'        => 'portfolio_single_gallery_space_between_items',
				'type'        => 'select',
				'label'       => esc_html__('Space Between Items', 'eltd-core'),
				'default_value' => 'normal',
				'description' => esc_html__('Set space size between columns for portfolio gallery type', 'eltd-core'),
				'parent'      => $portfolio_gallery_container,
				'options'     => array(
					'normal'    => esc_html__('Normal', 'eltd-core'),
					'small'     => esc_html__('Small', 'eltd-core'),
					'tiny'      => esc_html__('Tiny', 'eltd-core'),
					'no'        => esc_html__('No Space', 'eltd-core')
				)
			));
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = findme_elated_add_admin_container(array(
			'parent'          => $panel,
			'name'            => 'portfolio_masonry_container',
			'hidden_property' => 'portfolio_single_template',
			'hidden_values' => array(
				'huge-images',
				'images',
				'small-images',
				'slider',
				'small-slider',
				'gallery',
				'small-gallery',
				'custom',
				'full-width-custom'
			)
		));
		
			findme_elated_add_admin_field(array(
				'name'        => 'portfolio_single_masonry_columns_number',
				'type'        => 'select',
				'label'       => esc_html__('Number of Columns', 'eltd-core'),
				'default_value' => 'three',
				'description' => esc_html__('Set number of columns for portfolio masonry type', 'eltd-core'),
				'parent'      => $portfolio_masonry_container,
				'options'     => array(
					'two'   => esc_html__('2 Columns', 'eltd-core'),
					'three' => esc_html__('3 Columns', 'eltd-core'),
					'four'  => esc_html__('4 Columns', 'eltd-core')
				)
			));
			
			findme_elated_add_admin_field(array(
				'name'        => 'portfolio_single_masonry_space_between_items',
				'type'        => 'select',
				'label'       => esc_html__('Space Between Items', 'eltd-core'),
				'default_value' => 'normal',
				'description' => esc_html__('Set space size between columns for portfolio masonry type', 'eltd-core'),
				'parent'      => $portfolio_masonry_container,
				'options'     => array(
					'normal'    => esc_html__('Normal', 'eltd-core'),
					'small'     => esc_html__('Small', 'eltd-core'),
					'tiny'      => esc_html__('Tiny', 'eltd-core'),
					'no'        => esc_html__('No Space', 'eltd-core')
				)
			));
		
		/***************** Masonry Layout *****************/
		
		findme_elated_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'       => esc_html__('Show Title Area', 'eltd-core'),
				'description' => esc_html__('Enabling this option will show title area on single projects', 'eltd-core'),
				'parent'      => $panel,
                'options' => array(
                    '' => esc_html__('Default', 'eltd-core'),
                    'yes' => esc_html__('Yes', 'eltd-core'),
                    'no' => esc_html__('No', 'eltd-core')
                ),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		findme_elated_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_images',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Lightbox for Images', 'eltd-core'),
			'description'   => esc_html__('Enabling this option will turn on lightbox functionality for projects with images', 'eltd-core'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		findme_elated_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_videos',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Lightbox for Videos', 'eltd-core'),
			'description'   => esc_html__('Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'eltd-core'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		findme_elated_add_admin_field(array(
			'name'          => 'portfolio_single_enable_categories',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Categories', 'eltd-core'),
			'description'   => esc_html__('Enabling this option will enable category meta description on single projects', 'eltd-core'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		findme_elated_add_admin_field(array(
			'name'          => 'portfolio_single_hide_date',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Date', 'eltd-core'),
			'description'   => esc_html__('Enabling this option will enable date meta on single projects', 'eltd-core'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));
		
		findme_elated_add_admin_field(array(
			'name'          => 'portfolio_single_sticky_sidebar',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Sticky Side Text', 'eltd-core'),
			'description'   => esc_html__('Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'eltd-core'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		findme_elated_add_admin_field(array(
			'name'          => 'portfolio_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments', 'eltd-core'),
			'description'   => esc_html__('Enabling this option will show comments on your page', 'eltd-core'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		findme_elated_add_admin_field(array(
			'name'          => 'portfolio_single_hide_pagination',
			'type'          => 'yesno',
			'label'         => esc_html__('Hide Pagination', 'eltd-core'),
			'description'   => esc_html__('Enabling this option will turn off portfolio pagination functionality', 'eltd-core'),
			'parent'        => $panel,
			'default_value' => 'no',
			'args' => array(
				'dependence' => true,
				'dependence_hide_on_yes' => '#eltd_navigate_same_category_container'
			)
		));

			$container_navigate_category = findme_elated_add_admin_container(array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'hidden_property' => 'portfolio_single_hide_pagination',
				'hidden_value'    => 'yes'
			));
	
				findme_elated_add_admin_field(array(
					'name'            => 'portfolio_single_nav_same_category',
					'type'            => 'yesno',
					'label'           => esc_html__('Enable Pagination Through Same Category', 'eltd-core'),
					'description'     => esc_html__('Enabling this option will make portfolio pagination sort through current category', 'eltd-core'),
					'parent'          => $container_navigate_category,
					'default_value'   => 'no'
				));

		findme_elated_add_admin_field(array(
			'name'        => 'portfolio_single_slug',
			'type'        => 'text',
			'label'       => esc_html__('Portfolio Single Slug', 'eltd-core'),
			'description' => esc_html__('Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'eltd-core'),
			'parent'      => $panel,
			'args'        => array(
				'col_width' => 3
			)
		));
	}

	add_action( 'findme_elated_options_map', 'findme_elated_portfolio_options_map', 14);
}