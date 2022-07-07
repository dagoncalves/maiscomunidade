<?php

if(!function_exists('findme_elated_register_icon_widget')) {
	/**
	 * Function that register icon widget
	 */
	function findme_elated_register_icon_widget($widgets) {
		$widgets[] = 'FindmeElatedIconWidget';
		
		return $widgets;
	}
	
	add_filter('findme_elated_filter_register_widgets', 'findme_elated_register_icon_widget');
}