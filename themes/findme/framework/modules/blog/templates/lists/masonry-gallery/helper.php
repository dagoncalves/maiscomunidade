<?php

if( !function_exists('findme_elated_get_blog_holder_params') ) {
    /**
     * Function that generates params for holders on blog templates
     */
    function findme_elated_get_blog_holder_params($params) {
        $params_list = array();

        $masonry_layout = findme_elated_get_meta_field_intersect('blog_masonry_layout');
        if($masonry_layout === 'in-grid') {
            $params_list['holder'] = 'eltd-container';
            $params_list['inner'] = 'eltd-container-inner clearfix';
        }
        else {
            $params_list['holder'] = 'eltd-full-width';
            $params_list['inner'] = 'eltd-full-width-inner';
        }

        return $params_list;
    }

    add_filter( 'findme_elated_blog_holder_params', 'findme_elated_get_blog_holder_params' );
}

if( !function_exists('findme_elated_get_blog_list_classes') ) {
	/**
	 * Function that generates blog list holder classes for blog list templates
	 */
	function findme_elated_get_blog_list_classes($classes) {
		$list_classes   = array();
		$list_classes[] = 'eltd-blog-type-masonry';
		
		$number_of_columns = findme_elated_get_meta_field_intersect('blog_masonry_number_of_columns');
		if(!empty($number_of_columns)) {
			$list_classes[] = 'eltd-blog-' . $number_of_columns . '-columns';
		}
		
		$space_between_items = findme_elated_get_meta_field_intersect('blog_masonry_space_between_items');
		if(!empty($space_between_items)) {
			$list_classes[] = 'eltd-blog-' . $space_between_items . '-space';
		}

        $masonry_layout = findme_elated_get_meta_field_intersect('blog_masonry_layout');
        $list_classes[] = 'eltd-blog-masonry-' . $masonry_layout;
		
		$classes = array_merge($classes, $list_classes);
		
		return $classes;
	}
	
	add_filter( 'findme_elated_blog_list_classes', 'findme_elated_get_blog_list_classes' );
}

if( !function_exists('findme_elated_blog_part_params') ) {
    function findme_elated_blog_part_params($params) {

        $part_params = array();
        $part_params['title_tag'] = 'h3';
        $part_params['link_tag'] = 'h5';
        $part_params['quote_tag'] = 'h5';

        return array_merge($params, $part_params);
    }

    add_filter( 'findme_elated_blog_part_params', 'findme_elated_blog_part_params' );
}