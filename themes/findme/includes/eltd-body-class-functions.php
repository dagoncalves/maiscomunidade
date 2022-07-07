<?php

if(!function_exists('findme_elated_theme_version_class')) {
    /**
     * Function that adds classes on body for version of theme
     */
    function findme_elated_theme_version_class($classes) {
        $current_theme = wp_get_theme();

        //is child theme activated?
        if($current_theme->parent()) {
            //add child theme version
            $classes[] = strtolower($current_theme->get('Name')).'-child-ver-'.$current_theme->get('Version');

            //get parent theme
            $current_theme = $current_theme->parent();
        }

        if($current_theme->exists() && $current_theme->get('Version') != '') {
            $classes[] = strtolower($current_theme->get('Name')).'-ver-'.$current_theme->get('Version');
        }

        return $classes;
    }

    add_filter('body_class', 'findme_elated_theme_version_class');
}

if(!function_exists('findme_elated_boxed_class')) {
    /**
     * Function that adds classes on body for boxed layout
     */
    function findme_elated_boxed_class($classes) {
	    $allow_boxed_layout = true;
	    $allow_boxed_layout = apply_filters('findme_elated_allow_content_boxed_layout', $allow_boxed_layout);
	    
        if($allow_boxed_layout && findme_elated_options()->getOptionValue('boxed') == 'yes') {
            $classes[] = 'eltd-boxed';
        }

        return $classes;
    }

    add_filter('body_class', 'findme_elated_boxed_class');
}

if(!function_exists('findme_elated_paspartu_class')) {
    /**
     * Function that adds classes on body for paspartu layout
     */
    function findme_elated_paspartu_class($classes) {

        //is paspartu layout turned on?
        if(findme_elated_get_meta_field_intersect('paspartu') === 'yes') {
            $classes[] = 'eltd-paspartu-enabled';

            if(findme_elated_get_meta_field_intersect('disable_top_paspartu') === 'yes') {
                $classes[] = 'eltd-top-paspartu-disabled';
            }
        }

        return $classes;
    }

    add_filter('body_class', 'findme_elated_paspartu_class');
}

if(!function_exists('findme_elated_smooth_page_transitions_class')) {
    /**
     * Function that adds classes on body for smooth page transitions
     */
    function findme_elated_smooth_page_transitions_class($classes) {
		$id = findme_elated_get_page_id();

        if(findme_elated_get_meta_field_intersect('smooth_page_transitions',$id) == 'yes') {
            $classes[] = 'eltd-smooth-page-transitions';

			if(findme_elated_get_meta_field_intersect('page_transition_preloader',$id) == 'yes') {
				$classes[] = 'eltd-smooth-page-transitions-preloader';
			}

			if(findme_elated_get_meta_field_intersect('page_transition_fadeout',$id) == 'yes') {
				$classes[] = 'eltd-smooth-page-transitions-fadeout';
			}

        }

        return $classes;
    }

    add_filter('body_class', 'findme_elated_smooth_page_transitions_class');
}

if(!function_exists('findme_elated_content_initial_width_body_class')) {
    /**
     * Function that adds transparent content class to body.
     *
     * @param $classes array of body classes
     *
     * @return array with transparent content body class added
     */
    function findme_elated_content_initial_width_body_class($classes) {
		$initial_content_width = findme_elated_options()->getOptionValue('initial_content_width');
		
        if(!empty($initial_content_width)) {
            $classes[] = $initial_content_width;
        }

        return $classes;
    }

    add_filter('body_class', 'findme_elated_content_initial_width_body_class');
}