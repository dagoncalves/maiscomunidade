<?php

if ( ! function_exists( 'findme_elated_get_hide_dep_for_top_header_options' ) ) {
	function findme_elated_get_hide_dep_for_top_header_options() {
		$hide_dep_options = apply_filters( 'findme_elated_top_header_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'findme_elated_header_top_options_map' ) ) {
	function findme_elated_header_top_options_map( $panel_header ) {
		$hide_dep_options = findme_elated_get_hide_dep_for_top_header_options();
		
		$top_header_container = findme_elated_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'top_header_container',
				'parent'          => $panel_header,
				'hidden_property' => 'header_type',
				'hidden_values'   => $hide_dep_options
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'top_bar',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Top Bar', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will show top bar area', 'findme' ),
				'parent'        => $top_header_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_top_bar_container"
				)
			)
		);
		
		$top_bar_container = findme_elated_add_admin_container(
			array(
				'name'            => 'top_bar_container',
				'parent'          => $top_header_container,
				'hidden_property' => 'top_bar',
				'hidden_value'    => 'no'
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'top_bar_in_grid',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Top Bar in Grid', 'findme' ),
				'description'   => esc_html__( 'Set top bar content to be in grid', 'findme' ),
				'parent'        => $top_bar_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_top_bar_in_grid_container"
				)
			)
		);
		
		$top_bar_in_grid_container = findme_elated_add_admin_container(
			array(
				'name'            => 'top_bar_in_grid_container',
				'parent'          => $top_bar_container,
				'hidden_property' => 'top_bar_in_grid',
				'hidden_value'    => 'no'
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'top_bar_grid_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Grid Background Color', 'findme' ),
				'description' => esc_html__( 'Set grid background color for top bar', 'findme' ),
				'parent'      => $top_bar_in_grid_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'top_bar_grid_background_transparency',
				'type'        => 'text',
				'label'       => esc_html__( 'Grid Background Transparency', 'findme' ),
				'description' => esc_html__( 'Set grid background transparency for top bar', 'findme' ),
				'parent'      => $top_bar_in_grid_container,
				'args'        => array( 'col_width' => 3 )
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'top_bar_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'findme' ),
				'description' => esc_html__( 'Set background color for top bar', 'findme' ),
				'parent'      => $top_bar_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'top_bar_background_transparency',
				'type'        => 'text',
				'label'       => esc_html__( 'Background Transparency', 'findme' ),
				'description' => esc_html__( 'Set background transparency for top bar', 'findme' ),
				'parent'      => $top_bar_container,
				'args'        => array( 'col_width' => 3 )
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'top_bar_border',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Top Bar Border', 'findme' ),
				'description'   => esc_html__( 'Set top bar border', 'findme' ),
				'parent'        => $top_bar_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_top_bar_border_container"
				)
			)
		);
		
		$top_bar_border_container = findme_elated_add_admin_container(
			array(
				'name'            => 'top_bar_border_container',
				'parent'          => $top_bar_container,
				'hidden_property' => 'top_bar_border',
				'hidden_value'    => 'no'
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'top_bar_border_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Top Bar Border', 'findme' ),
				'description' => esc_html__( 'Set border color for top bar', 'findme' ),
				'parent'      => $top_bar_border_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'top_bar_height',
				'type'        => 'text',
				'label'       => esc_html__( 'Top Bar Height', 'findme' ),
				'description' => esc_html__( 'Enter top bar height (Default is 37px)', 'findme' ),
				'parent'      => $top_bar_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
	}
	
	add_action( 'findme_elated_header_top_options_map', 'findme_elated_header_top_options_map', 10, 1 );
}