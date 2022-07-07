<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = ELATED_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'findme_elated_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function findme_elated_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}

	}
	
	add_action( 'vc_after_init', 'findme_elated_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'findme_elated_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function findme_elated_vc_row_map() {
		
		vc_add_param( 'vc_row', array(
			'type'       => 'dropdown',
			'param_name' => 'row_content_width',
			'heading'    => esc_html__( 'Elated Row Content Width', 'findme' ),
			'value'      => array(
				esc_html__( 'Full Width', 'findme' ) => 'full-width',
				esc_html__( 'In Grid', 'findme' )    => 'grid'
			)
		) );
		
		vc_add_param( 'vc_row', array(
			'type'        => 'textfield',
			'param_name'  => 'anchor',
			'heading'     => esc_html__( 'Elated Anchor ID', 'findme' ),
			'description' => esc_html__( 'For example "home"', 'findme' )
		) );
		
		vc_add_param( 'vc_row', array(
			'type'       => 'dropdown',
			'param_name' => 'content_text_aligment',
			'heading'    => esc_html__( 'Elated Content Aligment', 'findme' ),
			'value'      => array(
				esc_html__( 'Default', 'findme' ) => '',
				esc_html__( 'Left', 'findme' )    => 'left',
				esc_html__( 'Center', 'findme' )  => 'center',
				esc_html__( 'Right', 'findme' )   => 'right'
			)
		) );
		
		/*** Row Inner ***/
		
		vc_add_param( 'vc_row_inner', array(
			'type'       => 'dropdown',
			'param_name' => 'row_content_width',
			'heading'    => esc_html__( 'Elated Row Content Width', 'findme' ),
			'value'      => array(
				esc_html__( 'Full Width', 'findme' ) => 'full-width',
				esc_html__( 'In Grid', 'findme' )    => 'grid'
			)
		) );
		
		vc_add_param( 'vc_row_inner', array(
			'type'       => 'dropdown',
			'param_name' => 'content_text_aligment',
			'heading'    => esc_html__( 'Elated Content Aligment', 'findme' ),
			'value'      => array(
				esc_html__( 'Default', 'findme' ) => '',
				esc_html__( 'Left', 'findme' )    => 'left',
				esc_html__( 'Center', 'findme' )  => 'center',
				esc_html__( 'Right', 'findme' )   => 'right'
			)
		) );
	}
	
	add_action( 'vc_after_init', 'findme_elated_vc_row_map' );
}