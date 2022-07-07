<?php

if ( ! function_exists( 'findme_elated_header_top_menu_logo_area_styles' ) ) {
	/**
	 * Generates styles for menu area
	 */
	function findme_elated_header_top_menu_logo_area_styles() {
		$menu_area_height = findme_elated_options()->getOptionValue( 'menu_area_height' );
		
		if ( ! empty( $menu_area_height ) ) {
			echo findme_elated_dynamic_css( '.eltd-header-top-menu .eltd-page-header .eltd-logo-area', array( 'margin-top' => $menu_area_height . 'px' ) );
		}
	}
	
	add_action( 'findme_elated_style_dynamic', 'findme_elated_header_top_menu_logo_area_styles' );
}