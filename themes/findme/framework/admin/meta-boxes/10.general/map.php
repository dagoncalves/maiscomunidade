<?php

if ( ! function_exists( 'findme_elated_map_general_meta' ) ) {
	function findme_elated_map_general_meta() {
		
		$general_meta_box = findme_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'findme_elated_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'General', 'findme' ),
				'name'  => 'general_meta'
			)
		);

		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'findme' ),
				'parent'        => $general_meta_box,
				'options'     => findme_elated_get_yes_no_select_array(),
				'args'          => array(
					"dependence"             => true,
					"hide"       => array(
						""    => "#eltd_page_transitions_container_meta",
						"no"  => "#eltd_page_transitions_container_meta",
						"yes" => ""
					),
					"show"       => array(
						""    => "",
						"no"  => "",
						"yes" => "#eltd_page_transitions_container_meta"
					)
				)
			)
		);

		$page_transitions_container_meta = findme_elated_add_admin_container(
			array(
				'parent'          => $general_meta_box,
				'name'            => 'page_transitions_container_meta',
				'hidden_property' => 'eltd_smooth_page_transitions_meta',
				'hidden_values'   => array('','no')
			)
		);

		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_page_transition_preloader_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Preloading Animation', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'findme' ),
				'parent'        => $page_transitions_container_meta,
				'options'     => findme_elated_get_yes_no_select_array(),
				'args'          => array(
					"dependence"             => true,
					"hide"       => array(
						""    => "#eltd_page_transition_preloader_container_meta",
						"no"  => "#eltd_page_transition_preloader_container_meta",
						"yes" => ""
					),
					"show"       => array(
						""    => "",
						"no"  => "",
						"yes" => "#eltd_page_transition_preloader_container_meta"
					)
				)
			)
		);

		$page_transition_preloader_container_meta = findme_elated_add_admin_container(
			array(
				'parent'          => $page_transitions_container_meta,
				'name'            => 'page_transition_preloader_container_meta',
				'hidden_property' => 'eltd_page_transition_preloader_meta',
				'hidden_values'   => array('','no')
			)
		);

		findme_elated_create_meta_box_field(
			array(
				'name'   => 'eltd_smooth_pt_bgnd_color_meta',
				'type'   => 'color',
				'label'  => esc_html__( 'Page Loader Background Color', 'findme' ),
				'parent' => $page_transition_preloader_container_meta
			)
		);

		$group_pt_spinner_animation_meta = findme_elated_add_admin_group(
			array(
				'name'        => 'group_pt_spinner_animation_meta',
				'title'       => esc_html__( 'Loader Style', 'findme' ),
				'description' => esc_html__( 'Define styles for loader spinner animation', 'findme' ),
				'parent'      => $page_transition_preloader_container_meta
			)
		);

		$row_pt_spinner_animation_meta = findme_elated_add_admin_row(
			array(
				'name'   => 'row_pt_spinner_animation_meta',
				'parent' => $group_pt_spinner_animation_meta
			)
		);

		findme_elated_create_meta_box_field(
			array(
				'type'          => 'selectsimple',
				'name'          => 'eltd_smooth_pt_spinner_type_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Type', 'findme' ),
				'parent'        => $row_pt_spinner_animation_meta,
				'options'       => array(
					'rotate_circles'        => esc_html__( 'Rotate Circles', 'findme' ),
					'pulse'                 => esc_html__( 'Pulse', 'findme' ),
					'double_pulse'          => esc_html__( 'Double Pulse', 'findme' ),
					'cube'                  => esc_html__( 'Cube', 'findme' ),
					'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'findme' ),
					'stripes'               => esc_html__( 'Stripes', 'findme' ),
					'wave'                  => esc_html__( 'Wave', 'findme' ),
					'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'findme' ),
					'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'findme' ),
					'atom'                  => esc_html__( 'Atom', 'findme' ),
					'clock'                 => esc_html__( 'Clock', 'findme' ),
					'mitosis'               => esc_html__( 'Mitosis', 'findme' ),
					'lines'                 => esc_html__( 'Lines', 'findme' ),
					'fussion'               => esc_html__( 'Fussion', 'findme' ),
					'wave_circles'          => esc_html__( 'Wave Circles', 'findme' ),
					'pulse_circles'         => esc_html__( 'Pulse Circles', 'findme' )
				)
			)
		);

		findme_elated_create_meta_box_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'eltd_smooth_pt_spinner_color_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Color', 'findme' ),
				'parent'        => $row_pt_spinner_animation_meta
			)
		);

		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_page_transition_fadeout_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Fade Out Animation', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'findme' ),
				'options'     => findme_elated_get_yes_no_select_array(),
				'parent'        => $page_transitions_container_meta

			)
		);

		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'findme' ),
				'parent'        => $general_meta_box,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_page_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'findme' ),
				'description' => esc_html__( 'Choose background color for page content', 'findme' ),
				'parent'      => $general_meta_box
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_page_slider_meta',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__( 'Slider Shortcode', 'findme' ),
				'description'   => esc_html__( 'Paste your slider shortcode here', 'findme' ),
				'parent'        => $general_meta_box
			)
		);
		
		$eltd_content_padding_group = findme_elated_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Style', 'findme' ),
				'description' => esc_html__( 'Define styles for Content area', 'findme' ),
				'parent'      => $general_meta_box
			)
		);
		
		$eltd_content_padding_row = findme_elated_add_admin_row(
			array(
				'name'   => 'eltd_content_padding_row',
				'next'   => true,
				'parent' => $eltd_content_padding_group
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_page_content_top_padding',
				'type'          => 'textsimple',
				'default_value' => '',
				'label'         => esc_html__( 'Content Top Padding', 'findme' ),
				'parent'        => $eltd_content_padding_row,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'    => 'eltd_page_content_top_padding_mobile',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Set this top padding for mobile header', 'findme' ),
				'parent'  => $eltd_content_padding_row,
				'options' => findme_elated_get_yes_no_select_array( false )
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'findme' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'findme' ),
				'parent'      => $general_meta_box,
				'options'     => findme_elated_get_yes_no_select_array()
			)
		);
	}
	
	add_action( 'findme_elated_meta_boxes_map', 'findme_elated_map_general_meta', 10 );
}