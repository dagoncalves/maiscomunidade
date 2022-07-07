<?php

if ( ! function_exists( 'findme_elated_map_blog_meta' ) ) {
	function findme_elated_map_blog_meta() {
		$eltd_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$eltd_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = findme_elated_create_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'findme' ),
				'name'  => 'blog_meta'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'findme' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'findme' ),
				'parent'      => $blog_meta_box,
				'options'     => $eltd_blog_categories
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'findme' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'findme' ),
				'parent'      => $blog_meta_box,
				'options'     => $eltd_blog_categories,
				'args'        => array( "col_width" => 3 )
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_blog_masonry_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Layout', 'findme' ),
				'description' => esc_html__( 'Set masonry layout. Default is in grid.', 'findme' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''           => esc_html__( 'Default', 'findme' ),
					'in-grid'    => esc_html__( 'In Grid', 'findme' ),
					'full-width' => esc_html__( 'Full Width', 'findme' )
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_blog_masonry_number_of_columns_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Number of Columns', 'findme' ),
				'description' => esc_html__( 'Set number of columns for your masonry blog lists', 'findme' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''      => esc_html__( 'Default', 'findme' ),
					'two'   => esc_html__( '2 Columns', 'findme' ),
					'three' => esc_html__( '3 Columns', 'findme' ),
					'four'  => esc_html__( '4 Columns', 'findme' ),
					'five'  => esc_html__( '5 Columns', 'findme' )
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_blog_masonry_space_between_items_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Space Between Items', 'findme' ),
				'description' => esc_html__( 'Set space size between posts for your masonry blog lists', 'findme' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''       => esc_html__( 'Default', 'findme' ),
					'normal' => esc_html__( 'Normal', 'findme' ),
					'small'  => esc_html__( 'Small', 'findme' ),
					'tiny'   => esc_html__( 'Tiny', 'findme' ),
					'no'     => esc_html__( 'No Space', 'findme' )
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_blog_list_featured_image_proportion_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Featured Image Proportion', 'findme' ),
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on blog lists.', 'findme' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'findme' ),
					'fixed'    => esc_html__( 'Fixed', 'findme' ),
					'original' => esc_html__( 'Original', 'findme' )
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'findme' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'findme' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'findme' ),
					'standard'        => esc_html__( 'Standard', 'findme' ),
					'load-more'       => esc_html__( 'Load More', 'findme' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'findme' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'findme' )
				)
			)
		);

		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_blog_order_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Order', 'findme' ),
				'parent'        => $blog_meta_box,
				'description'   => esc_html__( 'Define post order', 'findme' ),
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'findme' ),
					'desc'        => esc_html__( 'Descending', 'findme' ),
					'asc'       => esc_html__( 'Ascending', 'findme' )
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'eltd_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'findme' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'findme' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'findme_elated_meta_boxes_map', 'findme_elated_map_blog_meta', 30 );
}