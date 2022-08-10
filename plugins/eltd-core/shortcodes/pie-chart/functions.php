<?php

if(!function_exists('eltd_core_add_pie_chart_shortcodes')) {
	function eltd_core_add_pie_chart_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'ElatedCore\CPT\Shortcodes\PieChart\PieChart'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('eltd_core_filter_add_vc_shortcode', 'eltd_core_add_pie_chart_shortcodes');
}

if( !function_exists('eltd_core_set_pie_chart_icon_class_name_for_vc_shortcodes') ) {
	/**
	 * Function that set custom icon class name for pie chart shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function eltd_core_set_pie_chart_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
		$shortcodes_icon_class_array[] = '.icon-wpb-pie-chart';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter('eltd_core_filter_add_vc_shortcodes_custom_icon_class', 'eltd_core_set_pie_chart_icon_class_name_for_vc_shortcodes');
}