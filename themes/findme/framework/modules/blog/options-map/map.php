<?php

if ( ! function_exists('findme_elated_blog_options_map') ) {

	function findme_elated_blog_options_map() {

		findme_elated_add_admin_page(
			array(
				'slug' => '_blog_page',
				'title' => esc_html__('Blog', 'findme'),
				'icon' => 'fa fa-files-o'
			)
		);

		/**
		 * Blog Lists
		 */
		$panel_blog_lists = findme_elated_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_lists',
				'title' => esc_html__('Blog Lists', 'findme')
			)
		);

		findme_elated_add_admin_field(array(
			'name'        => 'blog_list_type',
			'type'        => 'select',
			'label'       => esc_html__('Blog Layout for Archive Pages', 'findme'),
			'description' => esc_html__('Choose a default blog layout for archived blog post lists', 'findme'),
			'default_value' => 'standard',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'centered'			    => esc_html__('Blog: Centered', 'findme'),
				'chequered' 		    => esc_html__('Blog: Chequered', 'findme'),
				'masonry'               => esc_html__('Blog: Masonry', 'findme'),
				'masonry-gallery'       => esc_html__('Blog: Masonry Gallery', 'findme'),
                'metro'                 => esc_html__('Blog: Metro', 'findme'),
                'narrow'                => esc_html__('Blog: Narrow', 'findme'),
                'split-column'          => esc_html__('Blog: Split Column', 'findme'),
                'standard'              => esc_html__('Blog: Standard', 'findme'),
                'standard-date-on-side' => esc_html__('Blog: Standard - Date on Side', 'findme'),
			)
		));

		findme_elated_add_admin_field(array(
			'name'        => 'archive_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout for Archive Pages', 'findme'),
			'description' => esc_html__('Choose a sidebar layout for archived blog post lists', 'findme'),
			'default_value' => '',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				''		            => esc_html__('Default', 'findme'),
				'no-sidebar'		=> esc_html__('No Sidebar', 'findme'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'findme'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'findme'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'findme'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'findme')
			)
		));
		
		$findme_custom_sidebars = findme_elated_get_custom_sidebars();
		if(count($findme_custom_sidebars) > 0) {
			findme_elated_add_admin_field(array(
				'name' => 'archive_custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display for Archive Pages', 'findme'),
				'description' => esc_html__('Choose a sidebar to display on archived blog post lists. Default sidebar is "Sidebar Page"', 'findme'),
				'parent' => $panel_blog_lists,
				'options' => findme_elated_get_custom_sidebars(),
				'args'        => array(
					'select2'	=> true
				)
			));
		}

        findme_elated_add_admin_field(array(
            'name'        => 'blog_masonry_layout',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Layout', 'findme'),
            'default_value' => 'in-grid',
            'description' => esc_html__('Set masonry layout. Default is in grid.', 'findme'),
            'parent'      => $panel_blog_lists,
            'options'     => array(
                'in-grid'    => esc_html__('In Grid', 'findme'),
                'full-width' => esc_html__('Full Width', 'findme')
            )
        ));
		
		findme_elated_add_admin_field(array(
			'name'        => 'blog_masonry_number_of_columns',
			'type'        => 'select',
			'label'       => esc_html__('Masonry - Number of Columns', 'findme'),
			'default_value' => 'four',
			'description' => esc_html__('Set number of columns for your masonry blog lists. Default value is 4 columns', 'findme'),
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'two'   => esc_html__('2 Columns', 'findme'),
				'three' => esc_html__('3 Columns', 'findme'),
				'four'  => esc_html__('4 Columns', 'findme'),
				'five'  => esc_html__('5 Columns', 'findme')
			)
		));
		
		findme_elated_add_admin_field(array(
			'name'        => 'blog_masonry_space_between_items',
			'type'        => 'select',
			'label'       => esc_html__('Masonry - Space Between Items', 'findme'),
			'default_value' => 'normal',
			'description' => esc_html__('Set space size between posts for your masonry blog lists. Default value is normal', 'findme'),
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'normal'  => esc_html__('Normal', 'findme'),
				'small'   => esc_html__('Small', 'findme'),
				'tiny'    => esc_html__('Tiny', 'findme'),
				'no'      => esc_html__('No Space', 'findme')
			)
		));

        findme_elated_add_admin_field(array(
            'name'        => 'blog_list_featured_image_proportion',
            'type'        => 'select',
            'label'       => esc_html__('Featured Image Proportion', 'findme'),
            'default_value' => 'fixed',
            'description' => esc_html__('Choose type of proportions you want to use for featured images on blog lists.', 'findme'),
            'parent'      => $panel_blog_lists,
            'options'     => array(
                'fixed'    => esc_html__('Fixed', 'findme'),
                'original' => esc_html__('Original', 'findme')
            )
        ));

		findme_elated_add_admin_field(array(
			'name'        => 'blog_pagination_type',
			'type'        => 'select',
			'label'       => esc_html__('Pagination Type', 'findme'),
			'description' => esc_html__('Choose a pagination layout for Blog Lists', 'findme'),
			'parent'      => $panel_blog_lists,
			'default_value' => 'standard',
			'options'     => array(
				'standard'		  => esc_html__('Standard', 'findme'),
				'load-more'		  => esc_html__('Load More', 'findme'),
				'infinite-scroll' => esc_html__('Infinite Scroll', 'findme'),
				'no-pagination'   => esc_html__('No Pagination', 'findme')
			)
		));
	
		findme_elated_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'number_of_chars',
				'default_value' => '40',
				'label' => esc_html__('Number of Words in Excerpt', 'findme'),
				'description' => esc_html__('Enter a number of words in excerpt (article summary). Default value is 40', 'findme'),
				'parent' => $panel_blog_lists,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'      => 'select',
				'name'      => 'blog_order',
				'label'     => esc_html__('Order', 'findme'),
				'parent'    => $panel_blog_lists,
				'default_value' => 'desc',
				'description' => esc_html__('Define post order. Default value is descending', 'findme'),
				'options'   => array(
					'desc'      => esc_html__('Descending', 'findme'),
					'asc'       => esc_html__('Ascending', 'findme')
				)
			)
		);

		/**
		 * Blog Single
		 */
		$panel_blog_single = findme_elated_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_single',
				'title' => esc_html__('Blog Single', 'findme')
			)
		);

        findme_elated_add_admin_field(array(
            'name'        => 'blog_single_type',
            'type'        => 'select',
            'label'       => esc_html__('Blog Layout for Single Post Pages', 'findme'),
            'description' => esc_html__('Choose a default blog layout for single post pages', 'findme'),
            'default_value' => 'standard',
            'parent'      => $panel_blog_single,
            'options'     => array(
                'standard'              => esc_html__('Standard', 'findme'),
                'title-area-empty'		=> esc_html__('Title Area Empty', 'findme'),
                'title-area-info' 		=> esc_html__('Title Area Info', 'findme')
            )
        ));

		findme_elated_add_admin_field(array(
			'name'        => 'blog_single_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout', 'findme'),
			'description' => esc_html__('Choose a sidebar layout for Blog Single pages', 'findme'),
			'default_value'	=> '',
			'parent'      => $panel_blog_single,
			'options'     => array(
				''		            => esc_html__('Default', 'findme'),
				'no-sidebar'		=> esc_html__('No Sidebar', 'findme'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'findme'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'findme'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'findme'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'findme')
			)
		));

		if(count($findme_custom_sidebars) > 0) {
			findme_elated_add_admin_field(array(
				'name' => 'blog_single_custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display', 'findme'),
				'description' => esc_html__('Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'findme'),
				'parent' => $panel_blog_single,
				'options' => findme_elated_get_custom_sidebars(),
				'args'        => array(
					'select2'	=> true
				)
			));
		}
		
		findme_elated_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'show_title_area_blog',
				'default_value' => '',
				'label'       => esc_html__('Show Title Area', 'findme'),
				'description' => esc_html__('Enabling this option will show title area on single post pages', 'findme'),
				'parent'      => $panel_blog_single,
				'options'     => findme_elated_get_yes_no_select_array(),
				'args' => array(
					'col_width' => 3
				)
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'full_height_title_area_blog',
				'default_value' => 'no',
				'label'       => esc_html__('Full Height Title', 'findme'),
				'description' => esc_html__('Enabling this option will show standard title area in full height on single post pages', 'findme'),
				'parent'      => $panel_blog_single,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		findme_elated_add_admin_field(array(
			'name'          => 'blog_single_title_in_title_area',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Post Title in Title Area', 'findme'),
			'description'   => esc_html__('Enabling this option will show post title in title area on single post pages', 'findme'),
			'parent'        => $panel_blog_single,
			'default_value' => 'no'
		));

		findme_elated_add_admin_field(array(
			'name'			=> 'blog_single_related_posts',
			'type'			=> 'yesno',
			'label'			=> esc_html__('Show Related Posts', 'findme'),
			'description'   => esc_html__('Enabling this option will show related posts on single post pages', 'findme'),
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		findme_elated_add_admin_field(array(
			'name'          => 'blog_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments Form', 'findme'),
			'description'   => esc_html__('Enabling this option will show comments form on single post pages', 'findme'),
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		findme_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_navigation',
				'default_value' => 'no',
				'label' => esc_html__('Enable Prev/Next Single Post Navigation Links', 'findme'),
				'description' => esc_html__('Enable navigation links through the blog posts (left and right arrows will appear)', 'findme'),
				'parent' => $panel_blog_single,
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_eltd_blog_single_navigation_container'
				)
			)
		);

		$blog_single_navigation_container = findme_elated_add_admin_container(
			array(
				'name' => 'eltd_blog_single_navigation_container',
				'hidden_property' => 'blog_single_navigation',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		findme_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'       => esc_html__('Enable Navigation Only in Current Category', 'findme'),
				'description' => esc_html__('Limit your navigation only through current category', 'findme'),
				'parent'      => $blog_single_navigation_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		findme_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_author_info',
				'default_value' => 'yes',
				'label' => esc_html__('Show Author Info Box', 'findme'),
				'description' => esc_html__('Enabling this option will display author name and descriptions on single post pages', 'findme'),
				'parent' => $panel_blog_single,
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_eltd_blog_single_author_info_container'
				)
			)
		);

		$blog_single_author_info_container = findme_elated_add_admin_container(
			array(
				'name' => 'eltd_blog_single_author_info_container',
				'hidden_property' => 'blog_author_info',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_author_info_email',
				'default_value' => 'no',
				'label'       => esc_html__('Show Author Email', 'findme'),
				'description' => esc_html__('Enabling this option will show author email', 'findme'),
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		findme_elated_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_author_social',
				'default_value' => 'yes',
				'label'       => esc_html__('Show Author Social Icons', 'findme'),
				'description' => esc_html__('Enabling this option will show author social icons on single post pages', 'findme'),
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);
	}

	add_action( 'findme_elated_options_map', 'findme_elated_blog_options_map', 13);
}