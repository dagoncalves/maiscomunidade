<?php

if ( ! function_exists( 'findme_elated_fixed_header_styles' ) ) {
	/**
	 * Generates styles for fixed haeder
	 */
	function findme_elated_fixed_header_styles() {
		$background_color        = findme_elated_options()->getOptionValue( 'fixed_header_background_color' );
		$background_transparency = findme_elated_options()->getOptionValue( 'fixed_header_transparency' );
		$border_color            = findme_elated_options()->getOptionValue( 'fixed_header_border_bottom_color' );
		
		$fixed_area_styles = array();
		if ( ! empty( $background_color ) ) {
			$fixed_header_background_color              = $background_color;
			$fixed_header_background_color_transparency = 1;
			
			if ( $background_transparency !== '' ) {
				$fixed_header_background_color_transparency = $background_transparency;
			}
			
			$fixed_area_styles['background-color'] = findme_elated_rgba_color( $fixed_header_background_color, $fixed_header_background_color_transparency ) . '!important';
		}
		
		if ( empty( $background_color ) && $background_transparency !== '' ) {
			$fixed_header_background_color              = '#fff';
			$fixed_header_background_color_transparency = $background_transparency;
			
			$fixed_area_styles['background-color'] = findme_elated_rgba_color( $fixed_header_background_color, $fixed_header_background_color_transparency ) . '!important';
		}
		
		$selector = array(
			'.eltd-page-header .eltd-fixed-wrapper.fixed .eltd-menu-area'
		);
		
		echo findme_elated_dynamic_css( $selector, $fixed_area_styles );
		
		$fixed_area_holder_styles = array();
		
		if ( ! empty( $border_color ) ) {
			$fixed_area_holder_styles['border-bottom-color'] = $border_color;
		}
		
		$selector_holder = array(
			'.eltd-page-header .eltd-fixed-wrapper.fixed'
		);
		
		echo findme_elated_dynamic_css( $selector_holder, $fixed_area_holder_styles );
		
		// fixed menu style
		
		$menu_item_styles = findme_elated_get_typography_styles( 'fixed' );
		
		$menu_item_selector = array(
			'.eltd-fixed-wrapper.fixed .eltd-main-menu > ul > li > a'
		);
		
		echo findme_elated_dynamic_css( $menu_item_selector, $menu_item_styles );
		
		
		$hover_color = findme_elated_options()->getOptionValue( 'fixed_hovercolor' );
		
		$menu_item_hover_styles = array();
		if ( ! empty( $hover_color ) ) {
			$menu_item_hover_styles['color'] = $hover_color;
		}
		
		$menu_item_hover_selector = array(
			'.eltd-fixed-wrapper.fixed .eltd-main-menu > ul > li:hover > a',
			'.eltd-fixed-wrapper.fixed .eltd-main-menu > ul > li.eltd-active-item > a'
		);
		
		echo findme_elated_dynamic_css( $menu_item_hover_selector, $menu_item_hover_styles );
	}
	
	add_action( 'findme_elated_style_dynamic', 'findme_elated_fixed_header_styles' );
}