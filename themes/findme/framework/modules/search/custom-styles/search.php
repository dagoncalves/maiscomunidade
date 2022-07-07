<?php

if (!function_exists('findme_elated_search_opener_icon_size')) {
	function findme_elated_search_opener_icon_size() {
		$icon_size = findme_elated_options()->getOptionValue('header_search_icon_size');
		
		if (!empty($icon_size)) {
			echo findme_elated_dynamic_css('.eltd-search-opener', array(
				'font-size' => findme_elated_filter_px($icon_size) . 'px'
			));
		}
	}

	add_action('findme_elated_style_dynamic', 'findme_elated_search_opener_icon_size');
}

if (!function_exists('findme_elated_search_opener_icon_colors')) {
	function findme_elated_search_opener_icon_colors() {
		$icon_color       = findme_elated_options()->getOptionValue('header_search_icon_color');
		$icon_hover_color = findme_elated_options()->getOptionValue('header_search_icon_hover_color');
		
		if (!empty($icon_color)) {
			echo findme_elated_dynamic_css('.eltd-search-opener', array(
				'color' => $icon_color
			));
		}

		if (!empty($icon_hover_color)) {
			echo findme_elated_dynamic_css('.eltd-search-opener:hover', array(
				'color' => $icon_hover_color
			));
		}
	}

	add_action('findme_elated_style_dynamic', 'findme_elated_search_opener_icon_colors');
}

if (!function_exists('findme_elated_search_opener_text_styles')) {
	function findme_elated_search_opener_text_styles() {
		$item_styles = findme_elated_get_typography_styles('search_icon_text');
		
		$item_selector = array(
			'.eltd-search-icon-text'
		);
		
		echo findme_elated_dynamic_css($item_selector, $item_styles);
		
		$text_hover_color = findme_elated_options()->getOptionValue('search_icon_text_color_hover');
		
		if (!empty($text_hover_color)) {
			echo findme_elated_dynamic_css('.eltd-search-opener:hover .eltd-search-icon-text', array(
				'color' => $text_hover_color
			));
		}
	}

	add_action('findme_elated_style_dynamic', 'findme_elated_search_opener_text_styles');
}