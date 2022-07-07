<?php

if(!function_exists('findme_elated_sticky_header_global_js_var')) {
	function findme_elated_sticky_header_global_js_var($global_variables) {
		$global_variables['eltdStickyHeaderHeight'] = findme_elated_get_sticky_header_height();
		$global_variables['eltdStickyHeaderTransparencyHeight'] = findme_elated_get_sticky_header_height_of_complete_transparency();
		
		return $global_variables;
	}
	
	add_filter('findme_elated_js_global_variables', 'findme_elated_sticky_header_global_js_var');
}

if(!function_exists('findme_elated_sticky_header_per_page_js_var')) {
	function findme_elated_sticky_header_per_page_js_var($perPageVars) {
		$perPageVars['eltdStickyScrollAmount'] = findme_elated_get_sticky_scroll_amount();
		
		return $perPageVars;
	}
	
	add_filter('findme_elated_per_page_js_vars', 'findme_elated_sticky_header_per_page_js_var');
}

if ( ! function_exists( 'findme_elated_register_sticky_header_areas' ) ) {
	/**
	 * Registers widget area for sticky header
	 */
	function findme_elated_register_sticky_header_areas() {
		$id              = findme_elated_get_page_id();
		$header_behavior = findme_elated_get_meta_field_intersect( 'header_behaviour', $id );
		
		if ( in_array( $header_behavior, array( 'sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up' ) ) ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Sticky Header Widget Area', 'findme' ),
					'id'            => 'eltd-sticky-right',
					'before_widget' => '<div id="%1$s" class="widget %2$s eltd-sticky-right">',
					'after_widget'  => '</div>',
					'description'   => esc_html__( 'Widgets added here will appear on the right hand side from the sticky menu', 'findme' )
				)
			);
		}
	}
	
	add_action( 'widgets_init', 'findme_elated_register_sticky_header_areas' );
}

if ( ! function_exists( 'findme_elated_get_sticky_menu' ) ) {
	/**
	 * Loads sticky menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function findme_elated_get_sticky_menu( $additional_class = 'eltd-default-nav' ) {
		findme_elated_get_module_template_part( 'templates/sticky-navigation', 'header/types/sticky-header', '', array( 'additional_class' => $additional_class ) );
	}
}

if ( ! function_exists( 'findme_elated_get_sticky_header' ) ) {
	/**
	 * Loads sticky header behavior HTML
	 */
	function findme_elated_get_sticky_header( $slug = '', $module = '' ) {
		$parameters = array(
			'hide_logo'             => findme_elated_options()->getOptionValue( 'hide_logo' ) == 'yes' ? true : false,
			'sticky_header_in_grid' => findme_elated_options()->getOptionValue( 'sticky_header_in_grid' ) == 'yes' ? true : false
		);
		
		$module = ! empty( $module ) ? $module : 'header/types/sticky-header';
		
		findme_elated_get_module_template_part( 'templates/sticky-header', $module, $slug, $parameters );
	}
}

if ( ! function_exists( 'findme_elated_get_sticky_header_height' ) ) {
	/**
	 * Returns top sticky header height
	 *
	 * @return bool|int|void
	 */
	function findme_elated_get_sticky_header_height() {
		$allow_sticky_behavior = true;
		$allow_sticky_behavior = apply_filters( 'findme_elated_allow_sticky_header_behavior', $allow_sticky_behavior );
		$header_behaviour      = findme_elated_get_meta_field_intersect( 'header_behaviour' );
		
		//sticky menu height, needed only for sticky header on scroll up
		if ( $allow_sticky_behavior && in_array( $header_behaviour, array( 'sticky-header-on-scroll-up' ) ) ) {
			$sticky_header_height = findme_elated_filter_px( findme_elated_options()->getOptionValue( 'sticky_header_height' ) );
			
			return $sticky_header_height !== '' ? intval( $sticky_header_height ) : 70;
		} else {
			return 0;
		}
	}
}

if ( ! function_exists( 'findme_elated_get_sticky_header_height_of_complete_transparency' ) ) {
	/**
	 * Returns top sticky header height it is fully transparent. used in anchor logic
	 *
	 * @return bool|int|void
	 */
	function findme_elated_get_sticky_header_height_of_complete_transparency() {
		$allow_sticky_behavior = true;
		$allow_sticky_behavior = apply_filters( 'findme_elated_allow_sticky_header_behavior', $allow_sticky_behavior );
		
		if ( $allow_sticky_behavior ) {
			$stickyHeaderTransparent = findme_elated_options()->getOptionValue( 'sticky_header_background_color' ) !== '' && findme_elated_options()->getOptionValue( 'sticky_header_transparency' ) === '0';
			
			if ( $stickyHeaderTransparent ) {
				return 0;
			} else {
				$sticky_header_height = findme_elated_filter_px( findme_elated_options()->getOptionValue( 'sticky_header_height' ) );
				
				return $sticky_header_height !== '' ? intval( $sticky_header_height ) : 70;
			}
		} else {
			return 0;
		}
	}
}

if ( ! function_exists( 'findme_elated_get_sticky_scroll_amount' ) ) {
	/**
	 * Returns top sticky scroll amount
	 *
	 * @return bool|int|void
	 */
	function findme_elated_get_sticky_scroll_amount() {
		$allow_sticky_behavior = true;
		$allow_sticky_behavior = apply_filters( 'findme_elated_allow_sticky_header_behavior', $allow_sticky_behavior );
		$header_behaviour      = findme_elated_get_meta_field_intersect( 'header_behaviour' );
		
		//sticky menu scroll amount
		if ( $allow_sticky_behavior && in_array( $header_behaviour, array( 'sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up' ) ) ) {
			$sticky_scroll_amount = findme_elated_filter_px( findme_elated_get_meta_field_intersect( 'scroll_amount_for_sticky' ) );
			
			return $sticky_scroll_amount !== '' ? intval( $sticky_scroll_amount ) : 0;
		} else {
			return 0;
		}
	}
}