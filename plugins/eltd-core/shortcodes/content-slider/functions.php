<?php

if(!function_exists('eltd_core_add_content_slider_shortcodes')) {
	function eltd_core_add_content_slider_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'ElatedCore\CPT\Shortcodes\ContentSlider\ContentSliderHolder',
			'ElatedCore\CPT\Shortcodes\ContentSlider\ContentSlider',
		);

		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

		return $shortcodes_class_name;
	}

	add_filter('eltd_core_filter_add_vc_shortcode', 'eltd_core_add_content_slider_shortcodes');
}

if( !function_exists('eltd_core_set_content_slider_icon_class_name_for_vc_shortcodes') ) {
	/**
	 * Function that set custom icon class name for content slider shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function eltd_core_set_content_slider_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
		$shortcodes_icon_class_array[] = '.icon-wpb-content-slider';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter('eltd_core_filter_add_vc_shortcodes_custom_icon_class', 'eltd_core_set_content_slider_icon_class_name_for_vc_shortcodes');
}

if (class_exists('WPBakeryShortCodesContainer')) {

	class WPBakeryShortCode_Eltd_Content_Slider_Holder extends WPBakeryShortCodesContainer{}

}


if (class_exists('WPBakeryShortCode')) {

	class WPBakeryShortCode_Eltd_Content_Slider extends WPBakeryShortCode{}
}