<?php

if( !function_exists('findme_elated_search_body_class') ) {
    /**
     * Function that adds body classes for different search types
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */
    function findme_elated_search_body_class($classes) {
        $classes[] = 'eltd-search-slides-from-window-top';

        return $classes;
    }

    add_filter('body_class', 'findme_elated_search_body_class');
}

if ( ! function_exists('findme_elated_get_search') ) {
    /**
     * Loads search HTML based on search type option.
     */
	function findme_elated_get_search() {
		findme_elated_load_search_template();
	}
	
	add_action( 'findme_elated_before_page_header', 'findme_elated_get_search');
}

if ( ! function_exists('findme_elated_load_search_template') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function findme_elated_load_search_template() {
        $search_in_grid = findme_elated_options()->getOptionValue('search_in_grid') == 'yes' ? true : false;
        $search_icon = '';
        $search_icon_close = '';
        
        if ( findme_elated_options()->getOptionValue('search_icon_pack') !== '' ) {
            $search_icon .= findme_elated_icon_collections()->getSearchIcon( findme_elated_options()->getOptionValue('search_icon_pack'), true );
            $search_icon_close .= findme_elated_icon_collections()->getSearchClose( findme_elated_options()->getOptionValue('search_icon_pack'), true );
        }

        $parameters = array(
            'search_in_grid'		=> $search_in_grid,
            'search_icon'			=> $search_icon,
            'search_icon_close'		=> $search_icon_close
        );
	    
        findme_elated_get_module_template_part('templates/types/slide-from-window-top', 'search', '', $parameters);
    }
}