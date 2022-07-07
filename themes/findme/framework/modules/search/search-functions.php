<?php

if( !function_exists('findme_elated_load_search') ) {
    function findme_elated_load_search() {
        $search_type_meta = findme_elated_options()->getOptionValue('search_type');
	    $search_type = !empty($search_type_meta) ? $search_type_meta : 'fullscreen';
	    
        if ( findme_elated_active_widget( false, false, 'eltd_search_opener' ) ) {
            include_once ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/search/types/' . $search_type . '.php';
        }
    }

    add_action('init', 'findme_elated_load_search');
}