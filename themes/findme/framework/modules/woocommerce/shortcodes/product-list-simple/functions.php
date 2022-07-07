<?php
if(!function_exists('findme_elated_add_product_list_simple_shortcode')) {
	function findme_elated_add_product_list_simple_shortcode($shortcodes_class_name) {
		$shortcodes = array(
			'ElatedCore\CPT\Shortcodes\ProductListSimple\ProductListSimple',
		);

		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

		return $shortcodes_class_name;
	}

	if(findme_elated_core_plugin_installed()) {
		add_filter('eltd_core_filter_add_vc_shortcode', 'findme_elated_add_product_list_simple_shortcode');
	}
}