<?php

if ( ! function_exists( 'findme_elated_general_options_map' ) ) {
	/**
	 * General options page
	 */
	function findme_elated_general_options_map() {
		
		findme_elated_add_admin_page(
			array(
				'slug'  => '',
				'title' => esc_html__( 'General', 'findme' ),
				'icon'  => 'fa fa-institution'
			)
		);
		
		$panel_design_style = findme_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_design_style',
				'title' => esc_html__( 'Design Style', 'findme' )
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'google_fonts',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Google Font Family', 'findme' ),
				'description'   => esc_html__( 'Choose a default Google font for your site', 'findme' ),
				'parent'        => $panel_design_style
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'additional_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Additional Google Fonts', 'findme' ),
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_additional_google_fonts_container"
				)
			)
		);
		
		$additional_google_fonts_container = findme_elated_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'additional_google_fonts_container',
				'hidden_property' => 'additional_google_fonts',
				'hidden_value'    => 'no'
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font1',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'findme' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'findme' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font2',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'findme' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'findme' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font3',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'findme' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'findme' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font4',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'findme' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'findme' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font5',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'findme' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'findme' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'google_font_weight',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Style & Weight', 'findme' ),
				'description'   => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'findme' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'100'       => esc_html__( '100 Thin', 'findme' ),
					'100italic' => esc_html__( '100 Thin Italic', 'findme' ),
					'200'       => esc_html__( '200 Extra-Light', 'findme' ),
					'200italic' => esc_html__( '200 Extra-Light Italic', 'findme' ),
					'300'       => esc_html__( '300 Light', 'findme' ),
					'300italic' => esc_html__( '300 Light Italic', 'findme' ),
					'400'       => esc_html__( '400 Regular', 'findme' ),
					'400italic' => esc_html__( '400 Regular Italic', 'findme' ),
					'500'       => esc_html__( '500 Medium', 'findme' ),
					'500italic' => esc_html__( '500 Medium Italic', 'findme' ),
					'600'       => esc_html__( '600 Semi-Bold', 'findme' ),
					'600italic' => esc_html__( '600 Semi-Bold Italic', 'findme' ),
					'700'       => esc_html__( '700 Bold', 'findme' ),
					'700italic' => esc_html__( '700 Bold Italic', 'findme' ),
					'800'       => esc_html__( '800 Extra-Bold', 'findme' ),
					'800italic' => esc_html__( '800 Extra-Bold Italic', 'findme' ),
					'900'       => esc_html__( '900 Ultra-Bold', 'findme' ),
					'900italic' => esc_html__( '900 Ultra-Bold Italic', 'findme' )
				)
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'google_font_subset',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Subset', 'findme' ),
				'description'   => esc_html__( 'Choose a default Google font subsets for your site', 'findme' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'latin'        => esc_html__( 'Latin', 'findme' ),
					'latin-ext'    => esc_html__( 'Latin Extended', 'findme' ),
					'cyrillic'     => esc_html__( 'Cyrillic', 'findme' ),
					'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'findme' ),
					'greek'        => esc_html__( 'Greek', 'findme' ),
					'greek-ext'    => esc_html__( 'Greek Extended', 'findme' ),
					'vietnamese'   => esc_html__( 'Vietnamese', 'findme' )
				)
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'first_color',
				'type'        => 'color',
				'label'       => esc_html__( 'First Main Color', 'findme' ),
				'description' => esc_html__( 'Choose the most dominant theme color. Default color is #ff4d30', 'findme' ),
				'parent'      => $panel_design_style
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'page_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'findme' ),
				'description' => esc_html__( 'Choose the background color for page content. Default color is #ffffff', 'findme' ),
				'parent'      => $panel_design_style
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'selection_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Text Selection Color', 'findme' ),
				'description' => esc_html__( 'Choose the color users see when selecting text', 'findme' ),
				'parent'      => $panel_design_style
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'boxed',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Boxed Layout', 'findme' ),
				'description'   => '',
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_boxed_container"
				)
			)
		);
		
		$boxed_container = findme_elated_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'boxed_container',
				'hidden_property' => 'boxed',
				'hidden_value'    => 'no'
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'page_background_color_in_box',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'findme' ),
				'description' => esc_html__( 'Choose the page background color outside box', 'findme' ),
				'parent'      => $boxed_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'boxed_background_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Background Image', 'findme' ),
				'description' => esc_html__( 'Choose an image to be displayed in background', 'findme' ),
				'parent'      => $boxed_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'boxed_pattern_background_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Background Pattern', 'findme' ),
				'description' => esc_html__( 'Choose an image to be used as background pattern', 'findme' ),
				'parent'      => $boxed_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'boxed_background_image_attachment',
				'type'          => 'select',
				'default_value' => 'fixed',
				'label'         => esc_html__( 'Background Image Attachment', 'findme' ),
				'description'   => esc_html__( 'Choose background image attachment', 'findme' ),
				'parent'        => $boxed_container,
				'options'       => array(
					'fixed'  => esc_html__( 'Fixed', 'findme' ),
					'scroll' => esc_html__( 'Scroll', 'findme' )
				)
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'paspartu',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Passepartout', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'findme' ),
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_paspartu_container"
				)
			)
		);
		
		$paspartu_container = findme_elated_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'paspartu_container',
				'hidden_property' => 'paspartu',
				'hidden_value'    => 'no'
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'paspartu_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Passepartout Color', 'findme' ),
				'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'findme' ),
				'parent'      => $paspartu_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'paspartu_width',
				'type'        => 'text',
				'label'       => esc_html__( 'Passepartout Size', 'findme' ),
				'description' => esc_html__( 'Enter size amount for passepartout', 'findme' ),
				'parent'      => $paspartu_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => '%'
				)
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'parent'        => $paspartu_container,
				'type'          => 'yesno',
				'default_value' => 'no',
				'name'          => 'disable_top_paspartu',
				'label'         => esc_html__( 'Disable Top Passepartout', 'findme' )
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'initial_content_width',
				'type'          => 'select',
				'default_value' => 'eltd-grid-1200',
				'label'         => esc_html__( 'Initial Width of Content', 'findme' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'findme' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'eltd-grid-1100' => esc_html__( '1100px - default', 'findme' ),
					'eltd-grid-1300' => esc_html__( '1300px', 'findme' ),
					'eltd-grid-1200' => esc_html__( '1200px', 'findme' ),
					'eltd-grid-1000' => esc_html__( '1000px', 'findme' ),
					'eltd-grid-800'  => esc_html__( '800px', 'findme' )
				)
			)
		);
		
		$panel_settings = findme_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_settings',
				'title' => esc_html__( 'Settings', 'findme' )
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'findme' ),
				'parent'        => $panel_settings,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_page_transitions_container"
				)
			)
		);
		
		$page_transitions_container = findme_elated_add_admin_container(
			array(
				'parent'          => $panel_settings,
				'name'            => 'page_transitions_container',
				'hidden_property' => 'smooth_page_transitions',
				'hidden_value'    => 'no'
			)
		);

		findme_elated_add_admin_field(
			array(
				'name'          => 'page_transition_preloader',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Preloading Animation', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'findme' ),
				'parent'        => $page_transitions_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_page_transition_preloader_container"
				)
			)
		);

		$page_transition_preloader_container = findme_elated_add_admin_container(
			array(
				'parent'          => $page_transitions_container,
				'name'            => 'page_transition_preloader_container',
				'hidden_property' => 'page_transition_preloader',
				'hidden_value'    => 'no'
			)
		);

		
		findme_elated_add_admin_field(
			array(
				'name'   => 'smooth_pt_bgnd_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Page Loader Background Color', 'findme' ),
				'parent' => $page_transition_preloader_container
			)
		);
		
		$group_pt_spinner_animation = findme_elated_add_admin_group(
			array(
				'name'        => 'group_pt_spinner_animation',
				'title'       => esc_html__( 'Loader Style', 'findme' ),
				'description' => esc_html__( 'Define styles for loader spinner animation', 'findme' ),
				'parent'      => $page_transition_preloader_container
			)
		);
		
		$row_pt_spinner_animation = findme_elated_add_admin_row(
			array(
				'name'   => 'row_pt_spinner_animation',
				'parent' => $group_pt_spinner_animation
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'type'          => 'selectsimple',
				'name'          => 'smooth_pt_spinner_type',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Type', 'findme' ),
				'parent'        => $row_pt_spinner_animation,
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
		
		findme_elated_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'smooth_pt_spinner_color',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Color', 'findme' ),
				'parent'        => $row_pt_spinner_animation
			)
		);

		findme_elated_add_admin_field(
			array(
				'name'          => 'page_transition_fadeout',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Fade Out Animation', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'findme' ),
				'parent'        => $page_transitions_container
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'show_back_button',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show "Back To Top Button"', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will display a Back to Top button on every page', 'findme' ),
				'parent'        => $panel_settings
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'          => 'responsiveness',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Responsiveness', 'findme' ),
				'description'   => esc_html__( 'Enabling this option will make all pages responsive', 'findme' ),
				'parent'        => $panel_settings
			)
		);
		
		$panel_custom_code = findme_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_custom_code',
				'title' => esc_html__( 'Custom Code', 'findme' )
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'custom_css',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom CSS', 'findme' ),
				'description' => esc_html__( 'Enter your custom CSS here', 'findme' ),
				'parent'      => $panel_custom_code
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'custom_js',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom JS', 'findme' ),
				'description' => esc_html__( 'Enter your custom Javascript here', 'findme' ),
				'parent'      => $panel_custom_code
			)
		);
		
		$panel_google_api = findme_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => esc_html__( 'Google API', 'findme' )
			)
		);
		
		findme_elated_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => esc_html__( 'Google Maps Api Key', 'findme' ),
				'description' => esc_html__( 'Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'findme' ),
				'parent'      => $panel_google_api
			)
		);
	}
	
	add_action( 'findme_elated_options_map', 'findme_elated_general_options_map', 1 );
}