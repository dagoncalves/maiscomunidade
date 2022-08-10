<?php

if(!function_exists('eltd_core_map_portfolio_settings_meta')) {
    function eltd_core_map_portfolio_settings_meta() {
        $meta_box = findme_elated_create_meta_box(array(
            'scope' => 'portfolio-item',
            'title' => esc_html__('Portfolio Settings', 'eltd-core'),
            'name'  => 'portfolio_settings_meta_box'
        ));

        findme_elated_create_meta_box_field(array(
            'name'        => 'eltd_portfolio_single_template_meta',
            'type'        => 'select',
            'label'       => esc_html__('Portfolio Type', 'eltd-core'),
            'description' => esc_html__('Choose a default type for Single Project pages', 'eltd-core'),
            'parent'      => $meta_box,
            'options'     => array(
                ''                  => esc_html__('Default', 'eltd-core'),
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
		            ''                  => '',
	            	'huge-images'       => '',
		            'images'            => '',
		            'small-images'      => '',
		            'slider'            => '',
		            'small-slider'      => '',
		            'gallery'           => '#eltd_eltd_gallery_type_meta_container',
		            'small-gallery'     => '#eltd_eltd_gallery_type_meta_container',
		            'masonry'           => '#eltd_eltd_masonry_type_meta_container',
		            'small-masonry'     => '#eltd_eltd_masonry_type_meta_container',
		            'custom'            => '',
		            'full-width-custom' => ''
	            ),
	            'hide' => array(
		            ''                  => '#eltd_eltd_gallery_type_meta_container, #eltd_eltd_masonry_type_meta_container',
	            	'huge-images'       => '#eltd_eltd_gallery_type_meta_container, #eltd_eltd_masonry_type_meta_container',
		            'images'            => '#eltd_eltd_gallery_type_meta_container, #eltd_eltd_masonry_type_meta_container',
		            'small-images'      => '#eltd_eltd_gallery_type_meta_container, #eltd_eltd_masonry_type_meta_container',
		            'slider'            => '#eltd_eltd_gallery_type_meta_container, #eltd_eltd_masonry_type_meta_container',
		            'small-slider'      => '#eltd_eltd_gallery_type_meta_container, #eltd_eltd_masonry_type_meta_container',
		            'gallery'           => '#eltd_eltd_masonry_type_meta_container',
		            'small-gallery'     => '#eltd_eltd_masonry_type_meta_container',
		            'masonry'           => '#eltd_eltd_gallery_type_meta_container',
		            'small-masonry'     => '#eltd_eltd_gallery_type_meta_container',
		            'custom'            => '#eltd_eltd_gallery_type_meta_container, #eltd_eltd_masonry_type_meta_container',
		            'full-width-custom' => '#eltd_eltd_gallery_type_meta_container, #eltd_eltd_masonry_type_meta_container'
	            )
            )
        ));
	
	    /***************** Gallery Layout *****************/
	
	    $gallery_type_meta_container = findme_elated_add_admin_container(
		    array(
			    'parent' => $meta_box,
			    'name' => 'eltd_gallery_type_meta_container',
			    'hidden_property' => 'eltd_portfolio_single_template_meta',
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
		    )
	    );
	
	        findme_elated_create_meta_box_field(array(
			    'name'        => 'eltd_portfolio_single_gallery_columns_number_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Number of Columns', 'eltd-core'),
			    'default_value' => '',
			    'description' => esc_html__('Set number of columns for portfolio gallery type', 'eltd-core'),
			    'parent'      => $gallery_type_meta_container,
			    'options'     => array(
				    ''      => esc_html__('Default', 'eltd-core'),
				    'two'   => esc_html__('2 Columns', 'eltd-core'),
				    'three' => esc_html__('3 Columns', 'eltd-core'),
				    'four'  => esc_html__('4 Columns', 'eltd-core')
			    )
		    ));
	
	        findme_elated_create_meta_box_field(array(
			    'name'        => 'eltd_portfolio_single_gallery_space_between_items_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Space Between Items', 'eltd-core'),
			    'default_value' => '',
			    'description' => esc_html__('Set space size between columns for portfolio gallery type', 'eltd-core'),
			    'parent'      => $gallery_type_meta_container,
			    'options'     => array(
				    ''          => esc_html__('Default', 'eltd-core'),
				    'normal'    => esc_html__('Normal', 'eltd-core'),
				    'small'     => esc_html__('Small', 'eltd-core'),
				    'tiny'      => esc_html__('Tiny', 'eltd-core'),
				    'no'        => esc_html__('No Space', 'eltd-core')
			    )
		    ));
	
	    /***************** Gallery Layout *****************/
	
	    /***************** Masonry Layout *****************/
	
	    $masonry_type_meta_container = findme_elated_add_admin_container(
		    array(
			    'parent' => $meta_box,
			    'name' => 'eltd_masonry_type_meta_container',
			    'hidden_property' => 'eltd_portfolio_single_template_meta',
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
		    )
	    );
	
		    findme_elated_create_meta_box_field(array(
			    'name'        => 'eltd_portfolio_single_masonry_columns_number_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Number of Columns', 'eltd-core'),
			    'default_value' => '',
			    'description' => esc_html__('Set number of columns for portfolio masonry type', 'eltd-core'),
			    'parent'      => $masonry_type_meta_container,
			    'options'     => array(
				    ''      => esc_html__('Default', 'eltd-core'),
				    'two'   => esc_html__('2 Columns', 'eltd-core'),
				    'three' => esc_html__('3 Columns', 'eltd-core'),
				    'four'  => esc_html__('4 Columns', 'eltd-core')
			    )
		    ));
		
		    findme_elated_create_meta_box_field(array(
			    'name'        => 'eltd_portfolio_single_masonry_space_between_items_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Space Between Items', 'eltd-core'),
			    'default_value' => '',
			    'description' => esc_html__('Set space size between columns for portfolio masonry type', 'eltd-core'),
			    'parent'      => $masonry_type_meta_container,
			    'options'     => array(
				    ''          => esc_html__('Default', 'eltd-core'),
				    'normal'    => esc_html__('Normal', 'eltd-core'),
				    'small'     => esc_html__('Small', 'eltd-core'),
				    'tiny'      => esc_html__('Tiny', 'eltd-core'),
				    'no'        => esc_html__('No Space', 'eltd-core')
			    )
		    ));
	
	    /***************** Masonry Layout *****************/

        findme_elated_create_meta_box_field(
            array(
                'name' => 'eltd_show_title_area_portfolio_single_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Show Title Area', 'eltd-core'),
                'description' => esc_html__('Enabling this option will show title area on your single portfolio page', 'eltd-core'),
                'parent'      => $meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'eltd-core'),
                    'yes' => esc_html__('Yes', 'eltd-core'),
                    'no' => esc_html__('No', 'eltd-core')
                )
            )
        );

	    findme_elated_create_meta_box_field(array(
		    'name'        => 'portfolio_info_top_padding',
		    'type'        => 'text',
		    'label'       => esc_html__('Portfolio Info Top Padding', 'eltd-core'),
		    'description' => esc_html__('Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'eltd-core'),
		    'parent'      => $meta_box,
		    'args'        => array(
			    'col_width' => 3,
			    'suffix' => 'px'
		    )
	    ));

        $all_pages = array();
        $pages     = get_pages();
        foreach($pages as $page) {
            $all_pages[$page->ID] = $page->post_title;
        }

        findme_elated_create_meta_box_field(array(
            'name'        => 'portfolio_single_back_to_link',
            'type'        => 'select',
            'label'       => esc_html__('"Back To" Link', 'eltd-core'),
            'description' => esc_html__('Choose "Back To" page to link from portfolio Single Project page', 'eltd-core'),
            'parent'      => $meta_box,
            'options'     => $all_pages,
			'args' => array(
				'select2' => true
			)
        ));

        findme_elated_create_meta_box_field(array(
            'name'        => 'portfolio_external_link',
            'type'        => 'text',
            'label'       => esc_html__('Portfolio External Link', 'eltd-core'),
            'description' => esc_html__('Enter URL to link from Portfolio List page', 'eltd-core'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));
	
	    findme_elated_create_meta_box_field(
		    array(
			    'name' => 'eltd_portfolio_featured_image_meta',
			    'type' => 'image',
			    'label' => esc_html__('Featured Image', 'eltd-core'),
			    'description' => esc_html__('Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'eltd-core'),
			    'parent' => $meta_box
		    )
	    );
	
	    findme_elated_create_meta_box_field(array(
		    'name' => 'eltd_portfolio_masonry_fixed_dimensions_meta',
		    'type' => 'select',
		    'label' => esc_html__('Dimensions for Masonry - Image Fixed Proportion', 'eltd-core'),
		    'description' => esc_html__('Choose image layout when it appears in Masonry type portfolio lists whre image proportion is fixed', 'eltd-core'),
		    'default_value' => 'default',
		    'parent' => $meta_box,
		    'options' => array(
			    'default' => esc_html__('Default', 'eltd-core'),
			    'large-width' => esc_html__('Large Width', 'eltd-core'),
			    'large-height' => esc_html__('Large Height', 'eltd-core'),
			    'large-width-height' => esc_html__('Large Width/Height', 'eltd-core')
		    )
	    ));
	
	    findme_elated_create_meta_box_field(array(
		    'name' => 'eltd_portfolio_masonry_original_dimensions_meta',
		    'type' => 'select',
		    'label' => esc_html__('Dimensions for Masonry - Image Original Proportion', 'eltd-core'),
		    'description' => esc_html__('Choose image layout when it appears in Masonry type portfolio lists whre image proportion is original', 'eltd-core'),
		    'default_value' => 'default',
		    'parent' => $meta_box,
		    'options' => array(
			    'default' => esc_html__('Default', 'eltd-core'),
			    'large-width' => esc_html__('Large Width', 'eltd-core')
		    )
	    ));
    }

    add_action('findme_elated_meta_boxes_map', 'eltd_core_map_portfolio_settings_meta', 41);
}