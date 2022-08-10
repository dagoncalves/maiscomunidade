<?php

if(!function_exists('findme_elated_load_widget_files')) {
	/**
	 * Loades widget class file.
	 */
	function findme_elated_load_widget_files(){
		include_once 'widget-class.php';
		include_once 'widget-functions.php';
	}

	add_action('findme_elated_before_options_map', 'findme_elated_load_widget_files');
}

if(!function_exists('findme_elated_load_widgets')) {
	/**
	 * Loades all widgets by going through all folders that are placed directly in widgets folder
	 * and loads load.php file in each. Hooks to findme_elated_after_options_map action
	 */
	function findme_elated_load_widgets() {

		if ( eltd_core_theme_installed() ) {
			foreach (glob(ELATED_FRAMEWORK_ROOT_DIR . '/modules/widgets/*/load.php') as $widget_load) {
				include_once $widget_load;
			}
		}

		include_once 'widget-loader.php';
	}

	add_action('findme_elated_before_options_map', 'findme_elated_load_widgets');
}