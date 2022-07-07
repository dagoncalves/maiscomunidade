<?php

if(!function_exists('findme_elated_title_classes')) {
    /**
     * Function that adds classes to title div.
     * All other functions are tied to it with add_filter function
     * @param array $classes array of classes
     * @param string $module name of module calling title
     */
    function findme_elated_title_classes($classes = array()) {
        $classes = array();
        $classes = apply_filters('findme_elated_title_classes', $classes);

        if(is_array($classes) && count($classes)) {
            echo implode(' ', $classes);
        }
    }
}

if(!function_exists('findme_elated_title_type_class')) {
    /**
     * Function that adds class on title based on title type option
     * @param $classes original array of classes
     * @return array changed array of classes
     */
    function findme_elated_title_type_class($classes) {
        $title_type = findme_elated_get_meta_field_intersect('title_area_type');

	    if(!empty($title_type)) {
		    $classes[] = 'eltd-'.$title_type.'-type';
	    }

        return $classes;
    }

    add_filter('findme_elated_title_classes', 'findme_elated_title_type_class');
}

if(!function_exists('findme_elated_title_content_alignment_class')) {
	/**
	 * Function that adds class on title based on title content alignmnt option
	 * Could be left, centered or right
	 * @param $classes original array of classes
	 * @return array changed array of classes
	 */
	function findme_elated_title_content_alignment_class($classes) {
		$title_content_alignment = findme_elated_get_meta_field_intersect('title_area_content_alignment');
		
		if(!empty($title_content_alignment)) {
			$classes[] = 'eltd-content-'.$title_content_alignment.'-alignment';
		}
		
		return $classes;
	}
	
	add_filter('findme_elated_title_classes', 'findme_elated_title_content_alignment_class');
}

if(!function_exists('findme_elated_title_background_image_classes')) {
    function findme_elated_title_background_image_classes($classes) {
        //init variables
        $id                      = findme_elated_get_page_id();
	    $title_img				 = apply_filters('findme_elated_title_image_exists', findme_elated_get_meta_field_intersect('title_area_background_image'));
	    $is_img_responsive 		 = findme_elated_get_meta_field_intersect('title_area_background_image_responsive');
	    $is_image_parallax		 = findme_elated_get_meta_field_intersect('title_area_background_image_parallax');
	    $is_image_parallax_array = array('yes', 'yes_zoom');
	    $hide_title_img			 = get_post_meta($id, "eltd_hide_background_image_meta", true) == 'yes' ? true : false;

        // Is title image visible and responsive?
        // Removed check for is title image set because of blog single module title (featured image used as title image). Added css for container auto heihgt.
        if($title_img != '' && !$hide_title_img) {
            //is image not responsive and parallax title is set?
            $classes[] = 'eltd-preload-background';
            $classes[] = 'eltd-has-background';

            if($is_img_responsive == 'no' && in_array($is_image_parallax, $is_image_parallax_array)) {
                $classes[] = 'eltd-has-parallax-background';

                if($is_image_parallax == 'yes_zoom') {
                    $classes[] = 'eltd-zoom-out';
                }
            }

            //is image not responsive
            elseif($is_img_responsive == 'yes'){
                $classes[] = 'eltd-has-responsive-background';
            }
        }

        return $classes;
    }

    add_filter('findme_elated_title_classes', 'findme_elated_title_background_image_classes');
}

if(!function_exists('findme_elated_title_background_image_div_classes')) {
	function findme_elated_title_background_image_div_classes($classes) {
		//init variables
		$id                 = findme_elated_get_page_id();
        $title_img			= apply_filters('findme_elated_title_image_exists', findme_elated_get_meta_field_intersect('title_area_background_image'));
		$is_img_responsive 	= findme_elated_get_meta_field_intersect('title_area_background_image_responsive');
        $hide_title_img			 = get_post_meta($id, "eltd_hide_background_image_meta", true) == 'yes' ? true : false;
		
		// Is title image visible and responsive?
        // Removed check for is title image set because of blog single module title (featured image used as title image). Added css for container auto heihgt.
        if($title_img != '' && !$hide_title_img) {
			
			//is image responsive?
			if($is_img_responsive == 'yes') {
				$classes[] = 'eltd-title-image-responsive';
			}
			//is image not responsive?
			elseif($is_img_responsive == 'no') {
				$classes[] = 'eltd-title-image-not-responsive';
			}
		}
		
		return $classes;
	}
	
	add_filter('findme_elated_title_classes', 'findme_elated_title_background_image_div_classes');
}