<?php
use ElatedListing\Lib\Shortcodes;
if(!function_exists('eltd_listing_package_shortcode_helper')) {
	function eltd_listing_package_shortcode_helper($shortcodes_class_name) {

		$shortcodes = array(
			'ElatedListing\Lib\Shortcodes\ListingPackage'
		);

		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

		return $shortcodes_class_name;
	}

	add_filter('eltd_listing_filter_add_vc_shortcode', 'eltd_listing_package_shortcode_helper');
}


if(!function_exists('eltd_listing_package_class_instance')){

	function eltd_listing_package_class_instance(){
		return Shortcodes\ListingPackage::getInstance();
	}

}

if( !function_exists('eltd_listing_set_ls_package_icon_class_name_for_vc_shortcodes') ) {
	/**
	 * Function that set custom icon class name for button shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function eltd_listing_set_ls_package_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
		$shortcodes_icon_class_array[] = '.icon-wpb-ls-package';

		return $shortcodes_icon_class_array;
	}

	add_filter('eltd_core_filter_add_vc_shortcodes_custom_icon_class', 'eltd_listing_set_ls_package_icon_class_name_for_vc_shortcodes');
}

if(!function_exists('eltd_listing_get_listing_packages')){
    
    function eltd_listing_get_listing_packages($atts = array()){
	
	$package_params = array(
		'post_type'        => 'product',
		'posts_per_page'   => -1,
		'order'            => 'asc',
		'orderby'          => 'menu_order',
		'suppress_filters' => false,
		'tax_query'        => array(
		    array(
				'taxonomy' => 'product_type',
				'field'    => 'slug',
				'terms'    => array( 'job_package', 'job_package_subscription' )
			)
		)

	);

	$params = array_merge($package_params,$atts );
	$packages = get_posts($params);
	return $packages;

    }
}