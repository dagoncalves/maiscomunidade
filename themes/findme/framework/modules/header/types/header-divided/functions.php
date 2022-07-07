<?php

if ( ! function_exists( 'findme_elated_register_header_divided_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function findme_elated_register_header_divided_type( $header_types ) {
		$header_type = array(
			'header-divided' => 'FindmeElated\Modules\Header\Types\HeaderDivided'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'findme_elated_init_register_header_divided_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function findme_elated_init_register_header_divided_type() {
		add_filter( 'findme_elated_register_header_type_class', 'findme_elated_register_header_divided_type' );
	}
	
	add_action( 'findme_elated_before_header_function_init', 'findme_elated_init_register_header_divided_type' );
}

if ( ! function_exists( 'findme_elated_include_header_divided_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function findme_elated_include_header_divided_menu( $menus ) {
		$menus['divided-left-navigation']  = esc_html__( 'Divided Left Navigation', 'findme' );
		$menus['divided-right-navigation'] = esc_html__( 'Divided Right Navigation', 'findme' );
		
		return $menus;
	}
	
	add_filter( 'findme_elated_register_headers_menu', 'findme_elated_include_header_divided_menu' );
}

if ( ! function_exists( 'findme_elated_get_divided_left_main_menu' ) ) {
	/**
	 * Loads main menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function findme_elated_get_divided_left_main_menu( $additional_class = 'eltd-default-nav' ) {
		findme_elated_get_module_template_part( 'templates/divided-left-navigation', 'header/types/header-divided', '', array( 'additional_class' => $additional_class ) );
	}
}

if ( ! function_exists( 'findme_elated_get_sticky_divided_left_main_menu' ) ) {
	/**
	 * Loads main menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function findme_elated_get_sticky_divided_left_main_menu( $additional_class = 'eltd-default-nav' ) {
		findme_elated_get_module_template_part( 'templates/sticky-divided-left-navigation', 'header/types/header-divided', '', array( 'additional_class' => $additional_class ) );
	}
}

if ( ! function_exists( 'findme_elated_get_divided_right_main_menu' ) ) {
	/**
	 * Loads main menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function findme_elated_get_divided_right_main_menu( $additional_class = 'eltd-default-nav' ) {
		findme_elated_get_module_template_part( 'templates/divided-right-navigation', 'header/types/header-divided', '', array( 'additional_class' => $additional_class ) );
	}
}

if ( ! function_exists( 'findme_elated_get_sticky_divided_right_main_menu' ) ) {
	/**
	 * Loads main menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function findme_elated_get_sticky_divided_right_main_menu( $additional_class = 'eltd-default-nav' ) {
		findme_elated_get_module_template_part( 'templates/sticky-divided-right-navigation', 'header/types/header-divided', '', array( 'additional_class' => $additional_class ) );
	}
}