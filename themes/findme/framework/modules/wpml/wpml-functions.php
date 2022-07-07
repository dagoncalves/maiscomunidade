<?php

if(!function_exists('findme_elated_disable_wpml_css')) {
    function findme_elated_disable_wpml_css() {
	    define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
    }

	add_action('after_setup_theme', 'findme_elated_disable_wpml_css');
}