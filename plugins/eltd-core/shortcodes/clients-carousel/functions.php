<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Eltd_Clients_Carousel extends WPBakeryShortCodesContainer {}
}

if(!function_exists('eltd_core_add_clients_carousel_shortcodes')) {
	function eltd_core_add_clients_carousel_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'ElatedCore\CPT\Shortcodes\ClientsCarousel\ClientsCarousel',
			'ElatedCore\CPT\Shortcodes\ClientsCarouselItem\ClientsCarouselItem'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('eltd_core_filter_add_vc_shortcode', 'eltd_core_add_clients_carousel_shortcodes');
}

if( !function_exists('eltd_core_set_clients_carousel_custom_style_for_vc_shortcodes') ) {
	/**
	 * Function that set custom css style for clients carousel shortcode
	 */
	function eltd_core_set_clients_carousel_custom_style_for_vc_shortcodes($style) {
		$current_style = '.wpb_content_element.wpb_eltd_clients_carousel_item > .wpb_element_wrapper { 
			background-color: #f4f4f4; 
		}';
		
		$style = $style . $current_style;
		
		return $style;
	}
	
	add_filter('eltd_core_filter_add_vc_shortcodes_custom_style', 'eltd_core_set_clients_carousel_custom_style_for_vc_shortcodes');
}

if( !function_exists('eltd_core_set_clients_carousel_icon_class_name_for_vc_shortcodes') ) {
	/**
	 * Function that set custom icon class name for clients carousel shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function eltd_core_set_clients_carousel_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
		$shortcodes_icon_class_array[] = '.icon-wpb-clients-carousel';
		$shortcodes_icon_class_array[] = '.icon-wpb-clients-carousel-item';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter('eltd_core_filter_add_vc_shortcodes_custom_icon_class', 'eltd_core_set_clients_carousel_icon_class_name_for_vc_shortcodes');
}