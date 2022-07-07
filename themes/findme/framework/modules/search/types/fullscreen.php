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
        $classes[] = 'eltd-fullscreen-search';
        $classes[] = 'eltd-search-fade';

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

    add_action('findme_elated_before_page_header', 'findme_elated_get_search');
}

if ( ! function_exists('findme_elated_load_search_template') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function findme_elated_load_search_template() {
        findme_elated_get_module_template_part('templates/types/fullscreen', 'search');
    }
}