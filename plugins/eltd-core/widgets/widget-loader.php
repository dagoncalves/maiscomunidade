<?php

if (!function_exists('findme_elated_register_widgets')) {
	function findme_elated_register_widgets() {
		$widgets = array(
			'FindmeElatedBlogListWidget',
			'FindmeElatedButtonWidget',
			'FindmeElatedIconWidget',
			'FindmeElatedImageWidget',
			'FindmeElatedImageSliderWidget',
			'FindmeElatedRawHTMLWidget',
			'FindmeElatedSearchOpener',
			'FindmeElatedSeparatorWidget',
			'FindmeElatedSideAreaOpener',
			'FindmeElatedSocialIconWidget'
		);

		if ( eltd_core_is_woocommerce_installed() ){
			$widgets[] = 'FindmeElatedWoocommerceDropdownCart';
		}

		foreach ($widgets as $widget) {
			register_widget($widget);
		}
	}
	
	add_action('widgets_init', 'findme_elated_register_widgets');
}