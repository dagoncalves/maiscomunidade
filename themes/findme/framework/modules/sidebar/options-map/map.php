<?php

if ( ! function_exists('findme_elated_sidebar_options_map') ) {

	function findme_elated_sidebar_options_map() {

		findme_elated_add_admin_page(
			array(
				'slug' => '_sidebar_page',
				'title' => esc_html__('Sidebar', 'findme'),
				'icon' => 'fa fa-indent'
			)
		);

		$sidebar_panel = findme_elated_add_admin_panel(
			array(
				'title' => esc_html__('Sidebar Area', 'findme'),
				'name' => 'sidebar',
				'page' => '_sidebar_page'
			)
		);
		
		findme_elated_add_admin_field(array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__('Sidebar Layout', 'findme'),
			'description'   => esc_html__('Choose a sidebar layout for pages', 'findme'),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
			'options'       => array(
				'no-sidebar'        => esc_html__('No Sidebar', 'findme'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'findme'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'findme'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'findme'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'findme')
			)
		));
		
		$findme_custom_sidebars = findme_elated_get_custom_sidebars();
		if(count($findme_custom_sidebars) > 0) {
			findme_elated_add_admin_field(array(
				'name' => 'custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display', 'findme'),
				'description' => esc_html__('Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'findme'),
				'parent' => $sidebar_panel,
				'options' => $findme_custom_sidebars,
				'args'        => array(
					'select2'	=> true
				)
			));
		}
	}

	add_action('findme_elated_options_map', 'findme_elated_sidebar_options_map', 9);
}