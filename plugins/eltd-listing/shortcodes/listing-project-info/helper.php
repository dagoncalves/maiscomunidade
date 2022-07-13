<?php
use ElatedListing\Lib\Shortcodes;
if(!function_exists('eltd_listing_project_info_shortcode_helper')) {
	function eltd_listing_project_info_shortcode_helper($shortcodes_class_name) {

		$shortcodes = array(
			'ElatedListing\Lib\Shortcodes\ListingProjectInfo'
		);

		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

		return $shortcodes_class_name;
	}

	add_filter('eltd_listing_filter_add_vc_shortcode', 'eltd_listing_project_info_shortcode_helper');
}


if(!function_exists('eltd_listing_project_info_instance')){

	function eltd_listing_project_info_instance(){
		return Shortcodes\ListingProjectInfo::getInstance();
	}

}

if( !function_exists('eltd_listing_set_ls_project_info_icon_class_name_for_vc_shortcodes') ) {
	/**
	 * Function that set custom icon class name for button shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function eltd_listing_set_ls_project_info_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
		$shortcodes_icon_class_array[] = '.icon-wpb-ls-project-info';

		return $shortcodes_icon_class_array;
	}

	add_filter('eltd_core_filter_add_vc_shortcodes_custom_icon_class', 'eltd_listing_set_ls_project_info_icon_class_name_for_vc_shortcodes');
}