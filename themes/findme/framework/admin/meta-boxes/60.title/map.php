<?php

if ( ! function_exists( 'findme_elated_map_title_meta' ) ) {
	function findme_elated_map_title_meta() {
		$title_meta_box = findme_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'findme_elated_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Title', 'findme' ),
				'name'  => 'title_meta'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'findme' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'findme' ),
				'parent'        => $title_meta_box,
				'options'       => findme_elated_get_yes_no_select_array(),
				'args'          => array(
					"dependence" => true,
					"hide"       => array(
						""    => "",
						"no"  => "#eltd_eltd_show_title_area_meta_container",
						"yes" => ""
					),
					"show"       => array(
						""    => "#eltd_eltd_show_title_area_meta_container",
						"no"  => "",
						"yes" => "#eltd_eltd_show_title_area_meta_container"
					)
				)
			)
		);
		
		$show_title_area_meta_container = findme_elated_add_admin_container(
			array(
				'parent'          => $title_meta_box,
				'name'            => 'eltd_show_title_area_meta_container',
				'hidden_property' => 'eltd_show_title_area_meta',
				'hidden_value'    => 'no'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_title_area_type_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Title Area Type', 'findme' ),
				'description'   => esc_html__( 'Choose title type', 'findme' ),
				'parent'        => $show_title_area_meta_container,
				'options'       => array(
					''           => esc_html__( 'Default', 'findme' ),
					'standard'   => esc_html__( 'Standard', 'findme' ),
					'breadcrumb' => esc_html__( 'Breadcrumb', 'findme' )
				),
				'args'          => array(
					"dependence" => true,
					"hide"       => array(
						"standard"   => "",
						"breadcrumb" => "#eltd_eltd_title_area_type_meta_container"
					),
					"show"       => array(
						""           => "#eltd_eltd_title_area_type_meta_container",
						"standard"   => "#eltd_eltd_title_area_type_meta_container",
						"breadcrumb" => ""
					)
				)
			)
		);
		
		$title_area_type_meta_container = findme_elated_add_admin_container(
			array(
				'parent'          => $show_title_area_meta_container,
				'name'            => 'eltd_title_area_type_meta_container',
				'hidden_property' => 'eltd_title_area_type_meta',
				'hidden_value'    => 'breadcrumb'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_title_area_enable_breadcrumbs_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Breadcrumbs', 'findme' ),
				'description'   => esc_html__( 'This option will display Breadcrumbs in Title Area', 'findme' ),
				'parent'        => $title_area_type_meta_container,
				'options'       => findme_elated_get_yes_no_select_array()
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_title_area_vertical_alignment_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Vertical Alignment', 'findme' ),
				'description'   => esc_html__( 'Specify title vertical alignment', 'findme' ),
				'parent'        => $show_title_area_meta_container,
				'options'       => array(
					''              => esc_html__( 'Default', 'findme' ),
					'header_bottom' => esc_html__( 'From Bottom of Header', 'findme' ),
					'window_top'    => esc_html__( 'From Window Top', 'findme' )
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_title_area_content_alignment_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Horizontal Alignment', 'findme' ),
				'description'   => esc_html__( 'Specify title horizontal alignment', 'findme' ),
				'parent'        => $show_title_area_meta_container,
				'options'       => array(
					''       => esc_html__( 'Default', 'findme' ),
					'left'   => esc_html__( 'Left', 'findme' ),
					'center' => esc_html__( 'Center', 'findme' ),
					'right'  => esc_html__( 'Right', 'findme' )
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_title_area_title_tag_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Title Tag', 'findme' ),
				'parent'        => $title_area_type_meta_container,
				'options'       => findme_elated_get_title_tag( true )
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_title_text_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Title Color', 'findme' ),
				'description' => esc_html__( 'Choose a color for title text', 'findme' ),
				'parent'      => $show_title_area_meta_container
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_title_area_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'findme' ),
				'description' => esc_html__( 'Choose a background color for title area', 'findme' ),
				'parent'      => $show_title_area_meta_container
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_hide_background_image_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Background Image', 'findme' ),
				'description'   => esc_html__( 'Enable this option to hide background image in title area', 'findme' ),
				'parent'        => $show_title_area_meta_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "#eltd_eltd_hide_background_image_meta_container",
					"dependence_show_on_yes" => ""
				)
			)
		);
		
		$hide_background_image_meta_container = findme_elated_add_admin_container(
			array(
				'parent'          => $show_title_area_meta_container,
				'name'            => 'eltd_hide_background_image_meta_container',
				'hidden_property' => 'eltd_hide_background_image_meta',
				'hidden_value'    => 'yes'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_title_area_background_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Background Image', 'findme' ),
				'description' => esc_html__( 'Choose an Image for title area', 'findme' ),
				'parent'      => $hide_background_image_meta_container
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_title_area_background_image_responsive_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Background Responsive Image', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will make Title background image responsive', 'findme' ),
				'parent'        => $hide_background_image_meta_container,
				'options'       => findme_elated_get_yes_no_select_array(),
				'args'          => array(
					"dependence" => true,
					"hide"       => array(
						""    => "",
						"no"  => "",
						"yes" => "#eltd_eltd_title_area_background_image_responsive_meta_container, #eltd_eltd_title_area_height_meta"
					),
					"show"       => array(
						""    => "#eltd_eltd_title_area_background_image_responsive_meta_container, #eltd_eltd_title_area_height_meta",
						"no"  => "#eltd_eltd_title_area_background_image_responsive_meta_container, #eltd_eltd_title_area_height_meta",
						"yes" => ""
					)
				)
			)
		);
		
		$title_area_background_image_responsive_meta_container = findme_elated_add_admin_container(
			array(
				'parent'          => $hide_background_image_meta_container,
				'name'            => 'eltd_title_area_background_image_responsive_meta_container',
				'hidden_property' => 'eltd_title_area_background_image_responsive_meta',
				'hidden_value'    => 'yes'
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_title_area_background_image_parallax_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image in Parallax', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will make Title background image parallax', 'findme' ),
				'parent'        => $title_area_background_image_responsive_meta_container,
				'options'       => array(
					''         => esc_html__( 'Default', 'findme' ),
					'no'       => esc_html__( 'No', 'findme' ),
					'yes'      => esc_html__( 'Yes', 'findme' ),
					'yes_zoom' => esc_html__( 'Yes, with zoom out', 'findme' )
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_title_area_height_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Height', 'findme' ),
				'description' => esc_html__( 'Set a height for Title Area', 'findme' ),
				'parent'      => $show_title_area_meta_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'          => 'eltd_title_area_subtitle_meta',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__( 'Subtitle Text', 'findme' ),
				'description'   => esc_html__( 'Enter your subtitle text', 'findme' ),
				'parent'        => $show_title_area_meta_container,
				'args'          => array(
					'col_width' => 6
				)
			)
		);
		
		findme_elated_create_meta_box_field(
			array(
				'name'        => 'eltd_subtitle_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Subtitle Color', 'findme' ),
				'description' => esc_html__( 'Choose a color for subtitle text', 'findme' ),
				'parent'      => $show_title_area_meta_container
			)
		);
	}
	
	add_action( 'findme_elated_meta_boxes_map', 'findme_elated_map_title_meta', 60 );
}