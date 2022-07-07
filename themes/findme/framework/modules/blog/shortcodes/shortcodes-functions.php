<?php

if(!function_exists('findme_elated_include_blog_shortcodes')) {
	function findme_elated_include_blog_shortcodes() {
		include_once ELATED_FRAMEWORK_MODULES_ROOT_DIR.'/blog/shortcodes/blog-list/blog-list.php';
		include_once ELATED_FRAMEWORK_MODULES_ROOT_DIR.'/blog/shortcodes/blog-slider/blog-slider.php';
        include_once ELATED_FRAMEWORK_MODULES_ROOT_DIR.'/blog/shortcodes/blog-carousel/blog-carousel.php';
	}
	
	if(findme_elated_core_plugin_installed()) {
		add_action('eltd_core_action_include_shortcodes_file', 'findme_elated_include_blog_shortcodes');
	}
}

if(!function_exists('findme_elated_add_blog_shortcodes')) {
	function findme_elated_add_blog_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'ElatedCore\CPT\Shortcodes\BlogList\BlogList',
			'ElatedCore\CPT\Shortcodes\BlogSlider\BlogSlider',
            'ElatedCore\CPT\Shortcodes\BlogCarousel\BlogCarousel'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	if(findme_elated_core_plugin_installed()) {
		add_filter('eltd_core_filter_add_vc_shortcode', 'findme_elated_add_blog_shortcodes');
	}
}

if ( ! function_exists( 'findme_elated_set_blog_list_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for blog shortcodes to set our icon for Visual Composer shortcodes panel
	 */
	function findme_elated_set_blog_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-blog-list';
		$shortcodes_icon_class_array[] = '.icon-wpb-blog-slider';
        $shortcodes_icon_class_array[] = '.icon-wpb-blog-carousel';
		
		return $shortcodes_icon_class_array;
	}
	
	if ( findme_elated_core_plugin_installed() ) {
		add_filter( 'eltd_core_filter_add_vc_shortcodes_custom_icon_class', 'findme_elated_set_blog_list_icon_class_name_for_vc_shortcodes' );
	}
}