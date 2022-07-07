<?php

if ( ! function_exists( 'findme_elated_content_bottom_options_map' ) ) {
	function findme_elated_content_bottom_options_map() {

		findme_elated_add_admin_page(
			array(
				'slug'  => '_content_bottom_page',
				'title' => esc_html__( 'Content Bottom', 'findme' ),
				'icon'  => 'fa fa-file-text-o'
			)
		);


		/***************** Content Bottom Layout - begin **********************/

		$panel_content_bottom = findme_elated_add_admin_panel(
			array(
				'page'  => '_content_bottom_page',
				'name'  => 'panel_content_bottom',
				'title' => esc_html__( 'Content Bottom Area Style', 'findme' )
			)
		);

		findme_elated_add_admin_field(
			array(
				'name'          => 'enable_content_bottom_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'findme' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'findme' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_enable_content_bottom_area_container'
				),
				'parent'        => $panel_content_bottom
			)
		);

		$enable_content_bottom_area_container = findme_elated_add_admin_container(
			array(
				'parent'          => $panel_content_bottom,
				'name'            => 'enable_content_bottom_area_container',
				'hidden_property' => 'enable_content_bottom_area',
				'hidden_value'    => 'no'
			)
		);

		$findme_custom_sidebars = findme_elated_get_custom_sidebars();

		findme_elated_add_admin_field(
			array(
				'type'          => 'selectblank',
				'name'          => 'content_bottom_sidebar_custom_display',
				'default_value' => '',
				'label'         => esc_html__( 'Widget Area to Display', 'findme' ),
				'description'   => esc_html__( 'Choose a Content Bottom widget area to display', 'findme' ),
				'options'       => $findme_custom_sidebars,
				'parent'        => $enable_content_bottom_area_container
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'content_bottom_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Display in Grid', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will place Content Bottom in grid', 'findme' ),
				'parent'        => $enable_content_bottom_area_container
			)
		);

		findme_elated_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'content_bottom_background_color',
				'label'       => esc_html__( 'Background Color', 'findme' ),
				'description' => esc_html__( 'Choose a background color for Content Bottom area', 'findme' ),
				'parent'      => $enable_content_bottom_area_container
			)
		);

		/***************** Content Bottom Layout - end **********************/
	}

	add_action( 'findme_elated_options_map', 'findme_elated_content_bottom_options_map', 7 );
}