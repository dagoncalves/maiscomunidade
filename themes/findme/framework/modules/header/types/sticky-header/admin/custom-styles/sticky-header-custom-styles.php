<?php

if ( ! function_exists( 'findme_elated_sticky_header_styles' ) ) {
	/**
	 * Generates styles for sticky haeder
	 */
	function findme_elated_sticky_header_styles() {
		$background_color        = findme_elated_options()->getOptionValue( 'sticky_header_background_color' );
		$background_transparency = findme_elated_options()->getOptionValue( 'sticky_header_transparency' );
		$border_color            = findme_elated_options()->getOptionValue( 'sticky_header_border_color' );
		$header_height           = findme_elated_options()->getOptionValue( 'sticky_header_height' );
		
		if ( ! empty( $background_color ) ) {
			$header_background_color              = $background_color;
			$header_background_color_transparency = 1;
			
			if ( $background_transparency !== '' ) {
				$header_background_color_transparency = $background_transparency;
			}
			
			echo findme_elated_dynamic_css( '.eltd-page-header .eltd-sticky-header .eltd-sticky-holder', array( 'background-color' => findme_elated_rgba_color( $header_background_color, $header_background_color_transparency ) ) );
		}
		
		if ( ! empty( $border_color ) ) {
			echo findme_elated_dynamic_css( '.eltd-page-header .eltd-sticky-header .eltd-sticky-holder', array( 'border-color' => $border_color ) );
		}
		
		if ( ! empty( $header_height ) ) {
			$height = findme_elated_filter_px( $header_height ) . 'px';
			
			echo findme_elated_dynamic_css( '.eltd-page-header .eltd-sticky-header', array( 'height' => $height ) );
			echo findme_elated_dynamic_css( '.eltd-page-header .eltd-sticky-header .eltd-logo-wrapper a', array( 'max-height' => $height ) );
		}
		
		// sticky menu style
		
		$menu_item_styles = findme_elated_get_typography_styles( 'sticky' );
		
		$menu_item_selector = array(
			'.eltd-main-menu.eltd-sticky-nav > ul > li > a'
		);
		
		echo findme_elated_dynamic_css( $menu_item_selector, $menu_item_styles );
		
		
		$hover_color = findme_elated_options()->getOptionValue( 'sticky_hovercolor' );
		
		$menu_item_hover_styles = array();
		if ( ! empty( $hover_color ) ) {
			$menu_item_hover_styles['color'] = $hover_color;
		}
		
		$menu_item_hover_selector = array(
			'.eltd-main-menu.eltd-sticky-nav > ul > li:hover > a',
			'.eltd-main-menu.eltd-sticky-nav > ul > li.eltd-active-item > a'
		);
		
		echo findme_elated_dynamic_css( $menu_item_hover_selector, $menu_item_hover_styles );
	}
	
	add_action( 'findme_elated_style_dynamic', 'findme_elated_sticky_header_styles' );
}