<?php

/*** Post Settings ***/

if ( ! function_exists( 'findme_elated_map_post_meta' ) ) {
	function findme_elated_map_post_meta() {
		
		$post_meta_box = findme_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'findme' ),
				'name'  => 'post-meta'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_blog_single_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Blog Layout for Single Post Pages', 'findme' ),
				'description'   => esc_html__( 'Choose a default blog layout for single post pages', 'findme' ),
				'default_value' => 'standard',
				'parent'        => $post_meta_box,
				'options'       => array(
					''                 => esc_html__( 'Default', 'findme' ),
					'standard'         => esc_html__( 'Standard', 'findme' ),
					'title-area-empty' => esc_html__( 'Title Area Empty', 'findme' ),
					'title-area-info'  => esc_html__( 'Title Area Info', 'findme' )
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'findme' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'findme' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
				'options'       => array(
					''                 => esc_html__( 'Default', 'findme' ),
					'no-sidebar'       => esc_html__( 'No Sidebar', 'findme' ),
					'sidebar-33-right' => esc_html__( 'Sidebar 1/3 Right', 'findme' ),
					'sidebar-25-right' => esc_html__( 'Sidebar 1/4 Right', 'findme' ),
					'sidebar-33-left'  => esc_html__( 'Sidebar 1/3 Left', 'findme' ),
					'sidebar-25-left'  => esc_html__( 'Sidebar 1/4 Left', 'findme' )
				)
			)
		);
		
		$findme_custom_sidebars = findme_elated_get_custom_sidebars();
		if ( count( $findme_custom_sidebars ) > 0 ) {
			findme_elated_create_meta_box_field( array(
				'name'        => 'eltd_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'findme' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'findme' ),
				'parent'      => $post_meta_box,
				'options'     => findme_elated_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'findme' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'findme' ),
				'parent'      => $post_meta_box
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_blog_masonry_gallery_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Fixed Proportion', 'findme' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry lists in fixed proportion', 'findme' ),
				'default_value' => 'default',
				'parent'        => $post_meta_box,
				'options'       => array(
					'default'            => esc_html__( 'Default', 'findme' ),
					'large-width'        => esc_html__( 'Large Width', 'findme' ),
					'large-height'       => esc_html__( 'Large Height', 'findme' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'findme' )
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_blog_masonry_gallery_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Original Proportion', 'findme' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry lists in original proportion', 'findme' ),
				'default_value' => 'default',
				'parent'        => $post_meta_box,
				'options'       => array(
					'default'     => esc_html__( 'Default', 'findme' ),
					'large-width' => esc_html__( 'Large Width', 'findme' )
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'findme' ),
				'parent'        => $post_meta_box,
				'options'       => findme_elated_get_yes_no_select_array()
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_full_height_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Full Height Title', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will show title area in full height on your single post page standard title', 'findme' ),
				'parent'        => $post_meta_box,
				'options'       => findme_elated_get_yes_no_select_array()
			)
		);
	}
	
	add_action( 'findme_elated_meta_boxes_map', 'findme_elated_map_post_meta', 20 );
}
