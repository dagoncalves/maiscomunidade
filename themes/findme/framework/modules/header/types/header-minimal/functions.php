<?php

if ( ! function_exists( 'findme_elated_register_header_minimal_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function findme_elated_register_header_minimal_type( $header_types ) {
		$header_type = array(
			'header-minimal' => 'FindmeElated\Modules\Header\Types\HeaderMinimal'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'findme_elated_init_register_header_minimal_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function findme_elated_init_register_header_minimal_type() {
		add_filter( 'findme_elated_register_header_type_class', 'findme_elated_register_header_minimal_type' );
	}
	
	add_action( 'findme_elated_before_header_function_init', 'findme_elated_init_register_header_minimal_type' );
}

if ( ! function_exists( 'findme_elated_register_header_minimal_full_screen_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function findme_elated_register_header_minimal_full_screen_menu() {
		register_nav_menus( array( 'popup-navigation' => esc_html__( 'Full Screen Navigation', 'findme' ) ) );
	}
	
	add_action( 'init', 'findme_elated_register_header_minimal_full_screen_menu' );
}

if ( ! function_exists( 'findme_elated_register_header_minimal_full_screen_menu_widgets' ) ) {
	/**
	 * Registers additional widget areas for this header type
	 */
	function findme_elated_register_header_minimal_full_screen_menu_widgets() {
		if ( findme_elated_check_is_header_minimal_type_enabled() ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Fullscreen Menu Top', 'findme' ),
					'id'            => 'fullscreen_menu_above',
					'description'   => esc_html__( 'This widget area is rendered above full screen menu', 'findme' ),
					'before_widget' => '<div class="%2$s eltd-fullscreen-menu-above-widget">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="eltd-fullscreen-widget-title">',
					'after_title'   => '</h4>'
				)
			);
			
			register_sidebar(
				array(
					'name'          => esc_html__( 'Fullscreen Menu Bottom', 'findme' ),
					'id'            => 'fullscreen_menu_below',
					'description'   => esc_html__( 'This widget area is rendered below full screen menu', 'findme' ),
					'before_widget' => '<div class="%2$s eltd-fullscreen-menu-below-widget">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="eltd-fullscreen-widget-title">',
					'after_title'   => '</h4>'
				)
			);
		}
	}
	
	add_action( 'widgets_init', 'findme_elated_register_header_minimal_full_screen_menu_widgets' );
}

if ( ! function_exists( 'findme_elated_check_is_header_minimal_type_enabled' ) ) {
	/**
	 * This function check is header minimal type enabled in global option or meta boxes option
	 */
	function findme_elated_check_is_header_minimal_type_enabled() {
		return findme_elated_get_meta_field_intersect( 'header_type', findme_elated_get_page_id() ) === 'header-minimal';
	}
}

if ( ! function_exists( 'findme_elated_header_minimal_full_screen_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different full screen menu types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function findme_elated_header_minimal_full_screen_menu_body_class( $classes ) {
		if ( findme_elated_check_is_header_minimal_type_enabled() ) {
			$classes[] = 'eltd-' . findme_elated_options()->getOptionValue( 'fullscreen_menu_animation_style' );
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'findme_elated_header_minimal_full_screen_menu_body_class' );
}

if ( ! function_exists( 'findme_elated_get_header_minimal_full_screen_menu' ) ) {
	/**
	 * Loads fullscreen menu HTML template
	 */
	function findme_elated_get_header_minimal_full_screen_menu() {
		if ( findme_elated_check_is_header_minimal_type_enabled() ) {
			$parameters = array(
				'fullscreen_menu_in_grid' => findme_elated_options()->getOptionValue( 'fullscreen_in_grid' ) === 'yes' ? true : false
			);
			
			findme_elated_get_module_template_part( 'templates/full-screen-menu', 'header/types/header-minimal', '', $parameters );
		}
	}
	
	add_action( 'findme_elated_after_header_area', 'findme_elated_get_header_minimal_full_screen_menu', 10 );
}