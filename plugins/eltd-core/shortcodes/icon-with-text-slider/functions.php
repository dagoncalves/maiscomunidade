<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Eltd_Icon_With_Text_Slider extends WPBakeryShortCodesContainer {}
}

if(!function_exists('eltd_core_add_iwt_slider_shortcodes')) {
	function eltd_core_add_iwt_slider_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'ElatedCore\CPT\Shortcodes\IconWithTextSlider\IconWithTextSlider'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('eltd_core_filter_add_vc_shortcode', 'eltd_core_add_iwt_slider_shortcodes');
}

if( !function_exists('eltd_core_set_iwt_custom_style_for_vc_shortcodes') ) {
	/**
	 * Function that set custom css style for accordion shortcode
	 */
	function eltd_core_set_iwt_custom_style_for_vc_shortcodes($style) {
		$current_style = '.vc_shortcodes_container .wpb_eltd_icon_with_text .wpb_element_wrapper { 
			background-color: #f4f4f4; 
		}';
		
		$style = $style . $current_style;
		
		return $style;
	}
	
	add_filter('eltd_core_filter_add_vc_shortcodes_custom_style', 'eltd_core_set_iwt_custom_style_for_vc_shortcodes');
}

if( !function_exists('eltd_core_set_icon_with_text_icon_class_name_for_vc_shortcodes') ) {
	/**
	 * Function that set custom icon class name for icon with text shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function eltd_core_set_icon_with_text_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
		$shortcodes_icon_class_array[] = '.icon-wpb-icon-with-text';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter('eltd_core_filter_add_vc_shortcodes_custom_icon_class', 'eltd_core_set_icon_with_text_icon_class_name_for_vc_shortcodes');
}