<?php

if( !function_exists('findme_elated_get_blog_holder_params') ) {
    /**
     * Function that generates params for holders on blog templates
     */
    function findme_elated_get_blog_holder_params($params) {
        $params_list = array();

        $params_list['holder'] = 'eltd-container';
        $params_list['inner'] = 'eltd-container-inner clearfix';

        return $params_list;
    }

    add_filter( 'findme_elated_blog_holder_params', 'findme_elated_get_blog_holder_params' );
}

if( !function_exists('findme_elated_blog_part_params') ) {
    function findme_elated_blog_part_params($params) {

        $part_params = array();
        $part_params['title_tag'] = 'h2';

        return array_merge($params, $part_params);
    }

    add_filter( 'findme_elated_blog_part_params', 'findme_elated_blog_part_params' );
}