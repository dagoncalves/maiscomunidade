<?php

if(!function_exists('eltd_core_include_portfolio_shortcodes')) {
	function eltd_core_include_portfolio_shortcodes() {
		include_once ELATED_CORE_CPT_PATH.'/portfolio/shortcodes/portfolio-list.php';
		include_once ELATED_CORE_CPT_PATH.'/portfolio/shortcodes/portfolio-project-info.php';
		include_once ELATED_CORE_CPT_PATH.'/portfolio/shortcodes/portfolio-slider.php';
	}
	
	add_action('eltd_core_action_include_shortcodes_file', 'eltd_core_include_portfolio_shortcodes');
}

if(!function_exists('eltd_core_add_portfolio_shortcodes')) {
	function eltd_core_add_portfolio_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'ElatedCore\CPT\Shortcodes\Portfolio\PortfolioList',
			'ElatedCore\CPT\Shortcodes\Portfolio\PortfolioProjectInfo',
			'ElatedCore\CPT\Shortcodes\Portfolio\PortfolioSlider'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('eltd_core_filter_add_vc_shortcode', 'eltd_core_add_portfolio_shortcodes');
}

if( !function_exists('eltd_core_set_portfolio_list_icon_class_name_for_vc_shortcodes') ) {
	/**
	 * Function that set custom icon class name for portfolio list shortcodes to set our icon for Visual Composer shortcodes panel
	 */
	function eltd_core_set_portfolio_list_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
		$shortcodes_icon_class_array[] = '.icon-wpb-portfolio';
		$shortcodes_icon_class_array[] = '.icon-wpb-portfolio-project-info';
		$shortcodes_icon_class_array[] = '.icon-wpb-portfolio-slider';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter('eltd_core_filter_add_vc_shortcodes_custom_icon_class', 'eltd_core_set_portfolio_list_icon_class_name_for_vc_shortcodes');
}