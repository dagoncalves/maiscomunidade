<?php

if ( ! function_exists( 'findme_elated_header_top_bar_styles' ) ) {
	/**
	 * Generates styles for header top bar
	 */
	function findme_elated_header_top_bar_styles() {
		$top_header_height = findme_elated_options()->getOptionValue( 'top_bar_height' );
		
		if ( ! empty( $top_header_height ) ) {
			echo findme_elated_dynamic_css( '.eltd-top-bar', array( 'height' => findme_elated_filter_px( $top_header_height ) . 'px' ) );
			echo findme_elated_dynamic_css( '.eltd-top-bar .eltd-logo-wrapper a', array( 'max-height' => findme_elated_filter_px( $top_header_height ) . 'px' ) );
		}
		
		echo findme_elated_dynamic_css( '.eltd-top-bar-background', array( 'height' => findme_elated_get_top_bar_background_height() . 'px' ) );
		
		if ( findme_elated_options()->getOptionValue( 'top_bar_in_grid' ) == 'yes' ) {
			$top_bar_grid_selector                = '.eltd-top-bar .eltd-grid .eltd-vertical-align-containers';
			$top_bar_grid_styles                  = array();
			$top_bar_grid_background_color        = findme_elated_options()->getOptionValue( 'top_bar_grid_background_color' );
			$top_bar_grid_background_transparency = findme_elated_options()->getOptionValue( 'top_bar_grid_background_transparency' );
			
			if ( !empty($top_bar_grid_background_color) ) {
				$grid_background_color        = $top_bar_grid_background_color;
				$grid_background_transparency = 1;
				
				if ( $top_bar_grid_background_transparency !== '' ) {
					$grid_background_transparency = $top_bar_grid_background_transparency;
				}
				
				$grid_background_color                   = findme_elated_rgba_color( $grid_background_color, $grid_background_transparency );
				$top_bar_grid_styles['background-color'] = $grid_background_color;
			}
			
			echo findme_elated_dynamic_css( $top_bar_grid_selector, $top_bar_grid_styles );
		}
		
		$top_bar_styles   = array();
		$background_color = findme_elated_options()->getOptionValue( 'top_bar_background_color' );
		$border_color     = findme_elated_options()->getOptionValue( 'top_bar_border_color' );
		
		if ( $background_color !== '' ) {
			$background_transparency = 1;
			if ( findme_elated_options()->getOptionValue( 'top_bar_background_transparency' ) !== '' ) {
				$background_transparency = findme_elated_options()->getOptionValue( 'top_bar_background_transparency' );
			}
			
			$background_color                   = findme_elated_rgba_color( $background_color, $background_transparency );
			$top_bar_styles['background-color'] = $background_color;
			
			echo findme_elated_dynamic_css( '.eltd-top-bar-background', array( 'background-color' => $background_color ) );
		}
		
		if ( findme_elated_options()->getOptionValue( 'top_bar_border' ) == 'yes' && $border_color != '' ) {
			$top_bar_styles['border-bottom'] = '1px solid ' . $border_color;
		}
		
		echo findme_elated_dynamic_css( '.eltd-top-bar', $top_bar_styles );
	}
	
	add_action( 'findme_elated_style_dynamic', 'findme_elated_header_top_bar_styles' );
}